<?php
   session_start();
   ini_set('pcre.jit', '0');
   require_once("vendor/autoload.php");
   header('Content-Type: text/html; charset=utf-8');
   use \Slim\Slim;
   use Dompdf\Dompdf;
   use Dompdf\Options;

   
   $app = new Slim();
   require_once('vendor/classes/classes.php');
   require_once('vendor/routes/rotas.php');
   require_once('vendor/services/services.php');




   $app->get('/admin/print',function(){
      $options = new Options();
$options->set('isRemoteEnabled', TRUE);

    // instantiate and use the dompdf class
$dompdf = new Dompdf($options);

$html = file_get_contents('views/relatorios/boletim.html');
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
      exit;
   });


    $app->get('/admin/login',function(){
    
       $page = new PageAdmin(["header"=>false,"footer"=>false]);//Intancia de nova página administrativa
        $page->setTpl("login-educacional", array("erro"=>false, "secretaria"=> Secretaria::getSecretaria()));
          exit;
    });

   $app->get('/admin/secretaria/login',function(){
    
       $page = new PageAdmin(["header"=>false,"footer"=>false]);//Intancia de nova página administrativa
       $page->setTpl("login-educacional", array("erro"=>false, "secretaria"=> Secretaria::getSecretaria()));
       exit;
   });


   $app->post('/loginBoletim', function(){
      $aluno = new Aluno();
      $aluno->setDtDataNacimento($_POST["txtDataNascimento"]);
      $aluno->setTxtCpf($_POST["txtSenha"]);

      $login = $aluno->loginBoletim();
      if(count($login)>0){
         $_SESSION["responsavel"]["idAluno"] = $login[0]["idAlunos"];
         header("location: /boletimResponsavel");
      }else{
         $page = new PageAdmin(["header"=>false,"footer"=>false]);//Intancia de nova página administrativa
         $page->setTpl("login-responsavel", array("erro"=>true, "secretaria"=> Secretaria::getSecretaria()));
      }


      exit;
   

   });


   $app->get('/boletimResponsavel',function(){
    
      if(isset($_SESSION["responsavel"]["idAluno"])){
         $page = new PageAdmin(["header"=>false,"footer"=>false]);//Intancia de nova página administrativa
         $aluno = new Aluno();
         $aluno->setIdAlunos($_SESSION["responsavel"]["idAluno"]);
         $infoAluno = $aluno->get();
         $page->setTpl("boletimResponsavel", array("aluno"=>$infoAluno));

      }else{
         $page = new PageAdmin(["header"=>false,"footer"=>false]);//Intancia de nova página administrativa
         $page->setTpl("login-responsavel", array("erro"=>false, "secretaria"=> Secretaria::getSecretaria()));
      }
      
     
      exit;
  });

  
 
    $app->get('/admin/loginSecretaria',function(){
    
      $page = new PageAdmin(["header"=>false,"footer"=>false]);//Intancia de nova página administrativa
      $page->setTpl("login-educacional", array("erro"=>false, "secretaria"=> Secretaria::getSecretaria()));
      exit;
   });



   $app->get('/admin/logout',function(){
      session_unset();
      header("location: /admin/login");   
      exit;
   });

   $app->post('/admin/login',function(){
      
      $user = new User();//Instancia da classe usuário
      $supervisor = new Servidores();
      $log = new Log();


      $login = $user->loginAdmin($_POST["txtEmail"],$_POST["txtPassword"]);//Função que busca dados de login
      if(isset($login["idServidores"]) && $login["idServidores"] >0){//Verificação se o usuário foi encontrado
       //Atribuição de valores a variáveis de sessão
       $_SESSION["admin"]["id"] = $login["idServidores"];
       $_SESSION["admin"]["permissao"] = $login["intTipoAcesso"];


        $supervisor->setIdServidores($login["idServidores"]);
        $eSupervisor = $supervisor->getUserSupervisor();
         
         $_SESSION["admin"]["supervisor"] =count($eSupervisor)>0 ? true : false;

      $log->saveLog("login");
         
       header("location: /admin/turmas");   
    }
    else{
      $page = new PageAdmin(["header"=>false,"footer"=>false]);//Intancia de nova página administrativa
      $page->setTpl("login-educacional", array("erro"=>true, "secretaria"=> Secretaria::getSecretaria()));

    }

  
    exit;



      $page = new PageAdmin(["header"=>false,"footer"=>false]);//Intancia de nova página administrativa
      $page->setTpl("login", array("erro"=>false));
      exit;
   });


  /* $app->get('/monitoramento-covid/login',function(){
    
      $page = new PageAdmin(["header"=>false,"footer"=>false]);//Intancia de nova página administrativa
      $page->setTpl("login", array("erro"=>false));
      exit;
   });

   $app->post('/monitoramento-covid/login',function(){
      
      $user = new User();//Instancia da classe usuário
      $login = $user->loginCovid($_POST["txtEmail"],$_POST["txtPassword"]);//Função que busca dados de login
      if(isset($login["idProfissional"]) && $login["idProfissional"] >0){//Verificação se o usuário foi encontrado
       //Atribuição de valores a variáveis de sessão
       $_SESSION["acessoCovid"]["id"] = $login["idProfissional"];
       $_SESSION["acessoCovid"]["permissao"] = $login["intTipo"];
       $_SESSION["acessoCovid"]["local"] = $login["fkLocalTrabalho"];
       header("location: /monitoramento-covid/casosMonitorados");   
    }

  
    exit;



      $page = new PageAdmin(["header"=>false,"footer"=>false]);//Intancia de nova página administrativa
      $page->setTpl("login", array("erro"=>false));
      exit;
   });
   

   $app->get('/monitoramento-covid/casosMonitorados/:id',function($id){
      User::verifyLoginCovid();//Verifica se usuário admin já está conectado ao sistema
      $page = new PageAdmin();//Intancia de nova página administrativa
      $caso = new Covid();
      $caso->setId($id);
      $result = $caso->get();
      $responsavel = $caso->getDadosCadastro();
      $page->setTpl('view-contato', array("caso"=>$result, "responsavel"=>$responsavel));
   });

   $app->post('/monitoramento-covid/casosMonitorados/:id',function($id){
      User::verifyLoginCovid();//Verifica se usuário admin já está conectado ao sistema
      $page = new PageAdmin();//Intancia de nova página administrativa
      $caso = new Covid();
      
      $caso->setId($id);
      $caso->setDadosForm($_POST);
      $caso->update();

      header("location: /monitoramento-covid/casosMonitorados/$id");
      exit;
   });

   $app->get('/monitoramento-covid/casosMonitorados',function(){
      User::verifyLoginCovid();//Verifica se usuário admin já está conectado ao sistema
      $page = new PageAdmin();//Intancia de nova página administrativa
      
      $casos = Covid::listAtivos($_SESSION["acessoCovid"]["permissao"]);

      
      $page->setTpl('list-casos', array("casos"=>$casos));
   });


   $app->get('/finalizarMonitoramento/:id',function($id){
      User::verifyLoginCovid();//Verifica se usuário admin já está conectado ao sistema
      $page = new PageAdmin();//Intancia de nova página administrativa
      $covid = new Covid();
      
      $covid->setId($id);
      $covid->finalizarMonitoramento();
      
      header("location: /monitoramento-covid/casosMonitorados/$id");
      exit;
   });
    


   $app->get('/reativarMonitoramento/:id',function($id){
      User::verifyLoginCovid();//Verifica se usuário admin já está conectado ao sistema
      $page = new PageAdmin();//Intancia de nova página administrativa
      $covid = new Covid();
      
      $covid->setId($id);
      $covid->reativarMonitoramento();
      
      header("location: /monitoramento-covid/casosMonitorados/$id");
      exit;
   });


   //ROTA DE PÁGINA ADMIN
   $app->get('/monitoramento-covid',function(){
      User::verifyLoginCovid();//Verifica se usuário admin já está conectado ao sistema
      $page = new PageAdmin();//Intancia de nova página administrativa
      $page->setTpl("cadastro-contato");
   });
   

    //ROTA DE PÁGINA ADMIN
    $app->post('/monitoramento-covid',function(){
      User::verifyLoginCovid();//Verifica se usuário admin já está conectado ao sistema
      $monitoramento = new Covid();
      $monitoramento->setDadosForm($_POST);
      $monitoramento->setResponsavel($_SESSION["acessoCovid"]["id"]);
      $monitoramento->save();
      header('location: /monitoramento-covid/casosMonitorados');
      exit;
   });


   $app->get('/monitoramento-covid',function(){
      User::verifyLoginCovid();//Verifica se usuário admin já está conectado ao sistema
      $page = new PageAdmin();//Intancia de nova página administrativa
      $page->setTpl("cadastro-contato");
   });


   $app->get('/monitoramento-covid/cadastrar-usuarios',function(){
      User::verifyLoginCovid();//Verifica se usuário admin já está conectado ao sistema
      $page = new PageAdmin();//Intancia de nova página administrativa

      $page->setTpl("cadastro-usuarios", array("local"=>LocalTrabalho::list()));
   });


   $app->post('/monitoramento-covid/cadastrar-usuarios',function(){
      User::verifyLoginCovid();//Verifica se usuário admin já está conectado ao sistema
      $user = new User();
      $user->setDadosForm($_POST);
      $user->save();

      exit;
   });*/

   $app->get('/',function(){
      $page = new Page();//Intancia de nova página administrativa
      $page->setTpl("index", array("escolas"=>Escola::listAllEscolas(), "blog"=>[]));
     // header('location: /admin/login');
      exit;
     
   });

 /*  $app->get('/mais-educacao',function(){
      $page = new Page();//Intancia de nova página administrativa
      $page->setTpl("mais-educacao", array("maisEducacao"=>MaisEducacao::listAllMaisEducacao()));
   });

   $app->get('/atividades/:escola/:turma/:semana',function($escola, $turma, $semana){
      $page = new Page();//Intancia de nova página administrativa
      $atividades = new Atividades();
      $atividades->setFkSemana($semana);
      $atividades->setFkTurma($turma);

      $page->setTpl("listaatividades-semana", array("atividades"=>$atividades->getAtividadesSemana()));
   });

   $app->get('/atividades/:escola/:turma',function($escola, $turma){
      $page = new Page();//Intancia de nova página administrativa
      $page->setTpl("atividade-semana", array("semana"=>Semana::listAllSemanas(), "escola"=>$escola,"turma"=>$turma));
   });

   $app->get('/atividades/:escola',function($escola){
      $page = new Page();//Intancia de nova página administrativa
      $turma = new Turma();
      $turma->setFkEscola($escola);
      $page->setTpl("atividade-turmas", array("turmas"=>$turma->getTurmaEscola()));
   });


   $app->get('/atividade/:id',function($id){
      $page = new Page();//Intancia de nova página administrativa
      $atividade = new Atividades();
      $atividade->setIdAtividades($id);
      $page->setTpl("atividade", array("atividades"=> $atividade->listAtividades()));
   });

   $app->get('/atividades',function(){
      $page = new Page();//Intancia de nova página administrativa
      $page->setTpl("atividade-escola", array("escolas"=>Escola::listAllEscolas()));
   });




   $app->get('/aula-remota/:escola',function($escola){
      $page = new Page();//Intancia de nova página administrativa
      $page->setTpl("salas-remoto");
   });


   $app->get('/blog/:id',function($id){
      $page = new Page();//Intancia de nova página administrativa
      $post= new Blog();
      $post->setIdBlog($id);
      $page->setTpl("post", array("postagem"=>$post->get(), "principais"=>Blog::listPrincipais()));
   });

   $app->get('/blog',function(){
      $page = new Page();//Intancia de nova página administrativa
  
      if(isset($_GET["pagina"])){
         $primeiro = 3 + 9 * ($_GET["pagina"] - 1);
         $segundo = 9 + $primeiro;
      }else{
         $primeiro = 3;
         $segundo = 9;
      }

      $qtde = ceil((Blog::getCountPosts()[0]["qtde"] / 9));
      $pages = [];

      for($i=0; $i<$qtde; $i++){
         array_push($pages, $i+1);
      }
      $page->setTpl("blog", array("pagination"=>$pages,"principais"=>Blog::listPrincipais(), "secundarios"=>Blog::listSecundarios($primeiro, $segundo)));

   });*/


  

   $app->run();
?>