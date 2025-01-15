<?php

use Dompdf\Dompdf;
use Dompdf\Options;

$app->post('/admin/escolas/:id', function ($id) {
     // User::verifyLoginAdmin();
     $escola = new Escola();
     $escola->setIdEscola($id);
     $escola->setDadosForm($_POST);
     $escola->update();
     header("location: /admin/escolas");
     exit;
});











$app->get('/admin/escolas/:id', function ($id) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $escola = new Escola();
     $escola->setIdEscola($id);
     $page->setTpl("edit-escolas", array("escola" => $escola->get()));
     exit;
});


$app->get('/admin/minhaEscola', function () {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $servidor = new Servidores();
     $turmas = new Turma();
     $escola = new Escola();

     $servidor->setIdServidores($_SESSION["admin"]["id"]);

     $secretario = $servidor->getUserSecretario();

     $escola->setIdEscola($secretario["fkEscola"]);

     $page->setTpl("edit-escolas", array("escola" => $escola->get(), "completo" => true));
     exit;
});


$app->get('/admin/escolas', function () {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $page->setTpl("list-escolas", array("escolas" => Escola::listAllEscolas()));
     exit;
});

$app->post('/admin/cadastrar-escolas', function () {
     User::verifyLoginAdmin();
     $escola = new Escola();
     $escola->setDadosForm($_POST);

     $escola->setTxtLogo($_FILES["fotos"]["name"]);
     $escola->uploadLogo($_FILES);
     $escola->save();
     header("location: /admin/escolas");
     exit;
});


//Rota de cadastro
$app->get('/admin/cadastrar-escolas', function () {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $page->setTpl("cadastro-escolas");
     exit;
});

//Rota DELETE
$app->get('/admin/deletarEscola/:id', function ($id) {
     User::verifyLoginAdmin();
     $business = new Escola();
     $business->setIdEscola($id);
     $business->delete();
     header('location: /admin/escolas');
     exit;
});


$app->get('/admin/escolasRelatorios/frequenciaAuxilio', function () {
     User::verifyLoginAdmin();
     $turma = new Turma();
     $aulas = new Aulas();
     $relatorio = new FaltasAlunosComAuxilio();
     $escola = new Escola();

     $secretario = new Servidores();
     $secretario->setIdServidores($_SESSION["admin"]["id"]);
     $listEscolas = $secretario->getUserSecretario();
     $options = new Options();
     $options->set('isRemoteEnabled', TRUE);
     $dompdf = new Dompdf($options);


     $mes_extenso = array(
          'Jan' => 'Janeiro',
          'Feb' => 'Fevereiro',
          'Mar' => 'Marco',
          'Apr' => 'Abril',
          'May' => 'Maio',
          'Jun' => 'Junho',
          'Jul' => 'Julho',
          'Aug' => 'Agosto',
          'Nov' => 'Novembro',
          'Sep' => 'Setembro',
          'Oct' => 'Outubro',
          'Dec' => 'Dezembro'
     );

     $turma->setFkEscola($listEscolas["fkEscola"]);
     $escola->setIdEscola($listEscolas["fkEscola"]);

     if (isset($_GET["dataInicial"]) && isset($_GET["dataFinal"])) {
          $infoEscola = $escola->get();
          $ano = substr($_GET["dataInicial"], 0, 4);
          $turma->setTxtAnoTurma($ano);
          $aulas->setDataInicio($_GET["dataInicial"]);
          $aulas->setDataFim($_GET["dataFinal"]);


          $listTurmas = $turma->getTurmaRegularEscolaAno();
          $arrayTurmas = [];

          for ($i = 0; $i < count($listTurmas); $i++) {
               $alunosBeneficios = [];

               $aulas->setTurma($listTurmas[$i]["idTurma"]);
               $aulas->setProfessor($listTurmas[$i]["professorRegente"]);

               $turma->setIdTurma($listTurmas[$i]["idTurma"]);
               $alunos = $turma->getAlunosTurmaComAuxilio();

               for ($j = 0; $j < count($alunos); $j++) {


                    $aulas->setAluno($alunos[$j]["idAlunos"]);
                    $faltas = $aulas->totalFaltas()[0]["faltas"];
                    $totalAulas = $aulas->totalAulas()[0]["presencas"];

                    $objeto = [
                         "aluno" => $alunos[$j]["txtNome"],
                         "dataNascimento" => $alunos[$j]["dtDataNascimento"],
                         "faltas" => $faltas,
                         "aulas" => $totalAulas >  0 ? $totalAulas : 1
                    ];
                    array_push($alunosBeneficios, $objeto);
               }
               $turmaObjeto = [
                    'turma' => $listTurmas[$i]['nomeTurma'],
                    'turno' => $listTurmas[$i]['txtTurno'],
                    'alunos' => $alunosBeneficios
               ];
               if (count($alunos) > 0) {
                    array_push($arrayTurmas, $turmaObjeto);
               }
          }

          $html = $relatorio->gerarRelatorio($infoEscola, $arrayTurmas, $infoEscola["txtCidade"], (date("d") . " de " . $mes_extenso[date("M")] . " " . date("Y")), $_GET["dataInicial"], $_GET["dataFinal"]);

          $dompdf->loadHtml($html);

          // (Optional) Setup the paper size and orientation
          $dompdf->setPaper('A4');

          // Render the HTML as PDF
          $dompdf->render();

          // Output the generated PDF to Browser
          $dompdf->stream('frequenciaAuxilio.pdf', array('Attachment' => 0));
          // $dompdf->stream();


     }

     exit;
});



$app->get('/admin/relatorio-auxilio', function () {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $page->setTpl("consultaAlunosAuxlio");
     exit;
});



$app->get('/admin/lista-presencas', function () {
     User::verifyLoginAdmin();

     $turma = new Turma();
     $presencas = new ListaPresenca();

     $secretario = new Servidores();

     $options = new Options();
     $options->set('isRemoteEnabled', TRUE);
     $dompdf = new Dompdf($options);


     $secretario->setIdServidores($_SESSION["admin"]["id"]);
     $listEscolas = $secretario->getUserSecretario();



     $turma->setFkEscola($listEscolas["fkEscola"]);

     $turma->setTxtAnoTurma(date('Y'));

     $listTurmas = $turma->getTurmaRegularEscolaAno();
     $arrayTurmas = [];


     for ($i = 0; $i < count($listTurmas); $i++) {
          $turma->setIdTurma($listTurmas[$i]['idTurma']);
          $turma->setDataPesquisada(date("Y-m-d"));
          

          $listaAlunos = $turma->listAlunosAtivosTurma();

          $objeto = [
               "nomeTurma" => $listTurmas[$i]["nomeTurma"],
               "professorRegente" => $listTurmas[$i]["professorRegente"],
               "turno" => $listTurmas[$i]["txtTurno"],
               "alunos" => $listaAlunos
          ];

          array_push($arrayTurmas, $objeto);
     }




     $html = $presencas->gerarLista($arrayTurmas);


     $dompdf->loadHtml($html);

     // (Optional) Setup the paper size and orientation
     $dompdf->setPaper('A4', 'landscape');

     // Render the HTML as PDF
     $dompdf->render();

     // Output the generated PDF to Browser$dompdf->stream('boletim.pdf', array( 'Attachment' => 0 ));
     $dompdf->stream();

     exit;
});
