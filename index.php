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


 


   

  

   $app->run();
?>