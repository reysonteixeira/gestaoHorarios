<?php
$app->post('/admin/turmas/:id', function ($id) {
     User::verifyLoginAdmin();
     $turma = new Turma();
     $turma->setIdTurma($id);
     $turma->setDadosForm($_POST);

     $turma->update();
     header("location: /admin/turmas");
     exit;
});

$app->get('/admin/turmas/:id', function ($id) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $turma = new Turma();
     $secretaria = Secretaria::getSecretaria();
     $turma->setIdTurma($id);
     $page->setTpl("edit-turmas", array (
          "turma" => $turma->get(),
          "secretaria" => $secretaria,
          "professores" => $turma->listProfessoresTurma(),
          "alunos" => $turma->listAlunosOfTurma(),
          "escolas" => Escola::listAllEscolas(),
          "permissao" => $_SESSION["admin"]["permissao"]
     )
     );
     exit;
});


$app->get('/admin/relatorioTurmas', function () {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $escola = new Escola();
     $turma = new Turma();

     $listEscolas = $escola->listAllEscolas();

     $turmas = [];
     for ($i = 0; $i < count($listEscolas); $i++) {
          $turma->setFkEscola($listEscolas[$i]["idEscola"]);
          $turma->setTxtAnoTurma(date("Y"));
          $listTurmas = $turma->listTurmasEscola();

          $turmaInfo = [
               "nomeEscola" => $listEscolas[$i]["txtNome"],
               "turmas" => $listTurmas
          ];

          array_push($turmas, $turmaInfo);
     }



     $page->setTpl("list-turmas-relatorios", array ("turma" => $turmas));
     exit;
});

$app->get('/admin/cadastroDisciplinasTurma/:id', function ($id) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $turma = new Turma();
     $turma->setIdTurma($id);
     $disciplinas = Disciplinas::listAll();
     $arrayDisciplina = [];
     for ($i = 0; $i < count($disciplinas); $i++) {
          $turma->setDisciplina($disciplinas[$i]["idDisciplina"]);
          $disciplinaTurma = $turma->getDisciplinaTurma();
          $boolDisciplina = count($disciplinaTurma) > 0 ? true : false;
          $disciplina = [
               "name" => $disciplinas[$i]["txtNomeDisciplina"],
               "id" => $disciplinas[$i]["idDisciplina"],
               "status" => $boolDisciplina
          ];
          array_push($arrayDisciplina, $disciplina);
     }

     $page->setTpl("cadastro-DisciplinaTurmas", array (
          "disciplinas" => $arrayDisciplina,
          "turma" => $id
     )
     );
     exit;
});

$app->post('/admin/cadastroDisciplinasTurma/:id', function ($id) {
     $turma = new Turma();
     $turma->setIdTurma($id);
     for ($i = 0; $i < count($_POST["disciplinas"]); $i++) {
          $turma->setDisciplina($_POST["disciplinas"][$i]);

          $disciplinaTurma = $turma->getDisciplinaTurma();
          $boolDisciplina = count($disciplinaTurma) > 0 ? true : false;
          if (!$boolDisciplina)
               $turma->cadastrarDisciplinaTurma();
     }
     header("location: /admin/configuracoes/$id");
     exit;
});


$app->get('/admin/removerDisciplinasTurma/:idTurma/:idDisciplina', function ($idTurma, $idDisciplina) {
     $turma = new Turma();
     $turma->setIdTurma($idTurma);
     $turma->setDisciplina($idDisciplina);
     $turma->removerDisciplinaTurma();


   
     header("location: /admin/configuracoes/$idTurma");
     exit;
});


$app->post('/admin/alunosturma/:id', function ($id) {
     User::verifyLoginAdmin();
     $turma = new Turma();
     $turma->setIdTurma($id);

     $alunos = Aluno::listAllAlunos();

     if (isset ($_POST["destaques"])) {
          for ($i = 0; $i < count($_POST["destaques"]); $i++) {
               $turma->setAluno($_POST["destaques"][$i]);
               $turma->setIdTurma($id);
               $turma->insereAlunoTurma();
          }
     }

     header("location: /admin/turmas/$id");

     exit;
});



$app->get('/admin/adicionarAlunosTurma/:id', function ($id) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();

     $turma = new Turma();
     $listAlunos = Aluno::listAllAlunos();



     $turma->setIdTurma($id);
     $infoTurma = $turma->get();

     $alunosTurma = $turma->listAlunosOfTurma();


     $alunosCadastraveis = [];
     foreach ($listAlunos as $item) {
          $valido = true;
          foreach ($alunosTurma as $aluno) {
               if ($aluno["fkAluno"] == $item["idAlunos"] && !$aluno["dataSaida"]) {
                    $valido = false;
                    break;
               }

          }
          if ($valido) {
               array_push($alunosCadastraveis, $item);
          }
     }

     $page->setTpl("adicionar-alunoTurma", array ("turma" => $turma->get(), "alunos" => $alunosCadastraveis));
     exit;
});


$app->post('/admin/adicionarAlunosTurma/:id', function ($id) {
     User::verifyLoginAdmin();
     $turma = new Turma();
     $sql = new Sql();
     $turma->setDataMatricula($_POST["dtDataInicio"]);
     $turma->setAluno($_POST["aluno"]);
     $turma->setIdTurma($id);



      $turma->cadastraAlunoTurma();
     $dataFinal = "2024-12-25";
     $listAulas = $sql->select(
          "SELECT * from tblAulas where fkTurma = :ATRIBUTO and dtData between :ATRIBUTO1 and :ATRIBUTO2",
          array (":ATRIBUTO" => $id, ":ATRIBUTO1" => $_POST["dtDataInicio"], ":ATRIBUTO2" => $dataFinal)
     );


     for ($j = 0; $j < count($listAulas); $j++) {
          $sql->select("INSERT INTO  tblPresencaAulas(fkAula, fkAluno, boolPresenca)
                              values (:ATRIBUTO1, :ATRIBUTO2, true);",
               array (":ATRIBUTO1" => $listAulas[$j]["idAulas"], ":ATRIBUTO2" => $_POST["aluno"])
          );
     }


     $listAulas = $sql->select(
          "SELECT * from tblAulaInfantil ai inner join tblSemanaInfantil
          on idSemana = ai.fkSemana inner join tblDiaSemanaInfantil ds on  ds.fkSemana = idSemana
           where fkTurma = :ATRIBUTO and dtDataAula between :ATRIBUTO1 and :ATRIBUTO2",
          array (":ATRIBUTO" => $id, ":ATRIBUTO1" => $_POST["dtDataInicio"], ":ATRIBUTO2" => $dataFinal)
     );

     for($j=0; $j<count($listAulas); $j++){
          $sql->select("INSERT INTO  tblPresencasAulasInfantil
          (fkDiaAula, fkAluno, boolPresenca, fkTurma, fkProfessor)
          values (:ATRIBUTO1, :ATRIBUTO2, true, :ATRIBUTO3, :ATRIBUTO4);",
          array (":ATRIBUTO1" => $listAulas[$j]["idAulaInfantil"], ":ATRIBUTO2" => $_POST["aluno"], ":ATRIBUTO3"=> $listAulas[$j]["fkTurma"], ":ATRIBUTO4"=> $listAulas[$j]["fkProfessor"])
          );
     }
    

     header("location: /admin/alunosturma/$id");
     exit;

});

$app->get('/admin/alunosturma/:id', function ($id) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $turma = new Turma();
     $turma->setIdTurma($id);

     $bimestre = new Bimestres();


     $infoTurma = $turma->get();
     $ano = $infoTurma["txtAnoTurma"];
     $bimestre->setAnoLetivo($ano);

     $inicio = $bimestre->getInicioAno();
     $fim = $bimestre->getFimAno();


     $page->setTpl("cadastro-alunosturma", 
          array ("turma" => $infoTurma, "alunos" => $turma->listAlunosTurma(),
           "inicioAnoLetivo" => $inicio["dataInicio"],
           "fimAnoLetivo" => $fim["dataFim"]
          ));
     exit;
});

$app->get('/admin/apagarAluno/:turma/:aluno', function ($turma, $aluno) {
     User::verifyLoginAdmin();
     $turmaEditar = new Turma();
     $sql = new Sql();

     $turmaEditar->setIdTurma($turma);
     $turmaEditar->setAluno($aluno);

     $dataFinal = "2024-12-25";
     $listAulas = $sql->select(
          "SELECT * from tblAulas where fkTurma = :ATRIBUTO;",
          array (":ATRIBUTO" => $turma)
     );

     $listAvaliacoes = $sql->select(
          "SELECT * from tblAvaliacoes where fkTurma = :ATRIBUTO;",
          array (":ATRIBUTO" => $turma)
     );

     for ($j = 0; $j < count($listAulas); $j++) {
          $sql->select(
               "DELETE from tblPresencaAulas where fkAula = :ATRIBUTO and fkAluno = :ATRIBUTO1",
               array (":ATRIBUTO" => $listAulas[$j]["idAulas"], ":ATRIBUTO1" => $aluno)
          );
     }

     for ($j = 0; $j < count($listAvaliacoes); $j++) {
          $sql->select(
               "DELETE from tblNotas where fkAvaliacao = :ATRIBUTO and fkAluno = :ATRIBUTO1",
               array (":ATRIBUTO" => $listAvaliacoes[$j]["idAvaliacao"], ":ATRIBUTO1" => $aluno)
          );
     }

     $turmaEditar->apagaAlunoTurma();
     header("location: /admin/alunosturma/$turma");
     exit;
});




$app->post('/admin/desligarAluno/:turma/:aluno', function ($turma, $aluno) {
     User::verifyLoginAdmin();

     switch ($_POST["situacao"]) {
          
          case "Transferência": {
               if (headers_sent($file, $line)) {
                    die("Headers already sent in $file on line $line");
                }
               header("location: /admin/transferirAluno/$turma/$aluno");
               exit;
          }
          case "Deletar": {
               header("location: /admin/deletarAluno/$turma/$aluno");
               exit;
          }
          case "Remanejamento": {
               header("location: /admin/remanejarAluno/$turma/$aluno");
               exit;
          }
          case "Reclassificar": {
               header("location: /admin/reclassificarAluno/$turma/$aluno");
               exit;
          }
          case "Alcancaram": {
               header("location: /admin/finalizarAluno/$turma/$aluno");
               exit;
          }
          case "Desistencia": {
               header("location: /admin/desistenciaAluno/$turma/$aluno");
               exit;
          }

          case "Óbito": {
               header("location: /admin/obitoAluno/$turma/$aluno");
               exit;
          }
     }
     exit;
});


$app->get('/admin/desligarAluno/:turma/:aluno', function ($turma, $aluno) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $alunoSelecionado = new Aluno();
     $alunoSelecionado->setIdAlunos($aluno);
     $infoAluno = $alunoSelecionado->get();

     $page->setTpl(
          "desligar-alunos",
          array ("turma" => $turma, "aluno" => $aluno, "infoAluno" => $infoAluno)
     );

     // $page->setTpl("desligar-alunosturma", 
     //      array("turma"=>$turma, "aluno"=>$aluno, "infoAluno"=>$infoAluno));
     exit;
});


$app->get('/admin/transferirAluno/:turma/:aluno', function ($turma, $aluno) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $alunoSelecionado = new Aluno();
     $alunoSelecionado->setIdAlunos($aluno);
     $infoAluno = $alunoSelecionado->get();

     $page->setTpl(
          "desligar-alunosturma",
          array ("turma" => $turma, "aluno" => $aluno, "infoAluno" => $infoAluno)
     );
     exit;
});

$app->get('/admin/deletarAluno/:turma/:aluno', function ($turma, $aluno) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $alunoSelecionado = new Aluno();
     $turmaSeleciona = new Turma();

     $turmaSeleciona->setIdTurma($turma);
     $alunoSelecionado->setIdAlunos($aluno);
     $infoAluno = $alunoSelecionado->get();
     $infoTurma = $turmaSeleciona->get();

     $page->setTpl(
          "deletar-alunosturma",
          array (
               "turma" => $turma,
               "aluno" => $aluno,
               "infoAluno" => $infoAluno,
               "infoTurma" => $infoTurma
          )
     );
     exit;
});






$app->post('/admin/professoresturma/:id', function ($id) {
     $turma = new Turma();
     $turma->setIdTurma($id);

     if (isset ($_POST["destaques"])) {
          $turma->removeProfessores();
          for ($i = 0; $i < count($_POST["destaques"]); $i++) {
               $turma->setProfessor($_POST["destaques"][$i]);
               $turma->insereProfessores();
          }
     }
     header("location: /admin/configuracoes/$id");
     exit;
});

$app->get('/admin/professoresturma/:id', function ($id) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $turma = new Turma();
     $turma->setIdTurma($id);
     $page->setTpl("cadastro-professoresturma", array ("turma" => $turma->get(), "professores" => Servidores::listProfessores()));
     exit;
});


$app->get('/admin/configuracoes/:id', function ($id) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $turma = new Turma();
     
     $turma->setIdTurma($id);
    $disciplinasTurma = $turma->getAllDisciplinaTurma();
    $professores= $turma->listProfessoresTurma();
 
     $turma->setIdTurma($id);
     $page->setTpl("configuracoesTurma", array ("professores" =>$professores ,"disciplinas"=> $disciplinasTurma,"turma"=>$id));
     exit;
});


$app->get('/admin/disciplinaProfessor/:fkTurma/:fkProfessor', function ($fkTurma, $fkProfessor) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $turma = new Turma();

     $turma->setIdTurma($fkTurma);
     $turma->setProfessor($fkProfessor);
     $disciplinasTurma = $turma->listarDisciplinasProfessorTurma();
     

     $page->setTpl("disciplinasProfessorTurma", 
          array ("professor" =>$fkProfessor ,"disciplinas"=> $disciplinasTurma,"turma"=>$fkTurma));
     exit;
});


$app->get('/admin/removerDisciplinaTurmaProfessor/:fkTurma/:fkProfessor/:disciplina', 
     function ($fkTurma, $fkProfessor, $fkDisciplina) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $turma = new Turma();

     $turma->setIdTurma($fkTurma);
     $turma->setProfessor($fkProfessor);
     $turma->setDisciplina($fkDisciplina);

     $disciplinasTurma = $turma->deleteDisciplinaProfessorTurma();
     

     header("location: /admin/disciplinaProfessor/$fkTurma/$fkProfessor");
     exit;
});


$app->get('/admin/cadastrarDisciplinaProfessor/:fkTurma/:fkProfessor', function ($fkTurma, $fkProfessor) {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $turma = new Turma();

     $turma->setIdTurma($fkTurma);
     $turma->setProfessor($fkProfessor);
     $disciplinasTurma = $turma->getAllDisciplinaTurma();
     
     $disciplinas = [];
     for($i=0; $i<count($disciplinasTurma); $i++){
          $turma->setDisciplina($disciplinasTurma[$i]["idDisciplina"]);
          $infoDisciplina = $turma->getDisciplinasProfessorTurma();

          $disciplina = [
               "txtNomeDisciplina" => $disciplinasTurma[$i]["txtNomeDisciplina"],
               "fkDisciplina" => $disciplinasTurma[$i]["fkDisciplina"],
               "status" => count($infoDisciplina) > 0 ? true : false
          ];
          array_push($disciplinas, $disciplina);
     }

     $page->setTpl("cadastrarDisciplinasProfessorTurma", 
          array ("professor" =>$fkProfessor ,"disciplinas"=> $disciplinas,"turma"=>$fkTurma));
     exit;
});


$app->post('/admin/cadastrarDisciplinaProfessor/:fkTurma/:fkProfessor', function ($fkTurma, $fkProfessor) {
     User::verifyLoginAdmin();

     $turma = new Turma();

     $turma->setIdTurma($fkTurma);
     $turma->setProfessor($fkProfessor);
     $disciplinasTurma = $turma->deleteAllDisciplinasProfessorTurma();
     
     $disciplinas = $_POST["disciplinas"];
    
     for($i=0; $i<count($disciplinas); $i++){
          echo($disciplinas[$i]);
          $turma->setDisciplina($disciplinas[$i]);
        
          $turma->cadastrarDisciplinaProfessorTurma();
     }
     

     header("location: /admin/disciplinaProfessor/$fkTurma/$fkProfessor");
     exit;
});






$app->get('/admin/corrigePresencas', function () {
     // User::verifyLoginAdmin();
     $sql = new Sql();
     //$page = new PageAdmin();
     $turma = new Turma();
     $listaTurmas = $turma->listAllTurma();
     $aulas = new Aulas();
     for ($i = 0; $i < count($listaTurmas); $i++) {

          $listAulas = $sql->select(
               "SELECT * from tblAulas where fkTurma = :ATRIBUTO",
               array (":ATRIBUTO" => $listaTurmas[$i]["idTurma"])
          );

          if (count($listAulas) > 0) {
               for ($j = 0; $j < count($listAulas); $j++) {
                    $listPresencas = $sql->select(
                         "SELECT * from tblPresencaAulas where fkAula = :ATRIBUTO1",
                         array (":ATRIBUTO1" => $listAulas[$j]["idAulas"])
                    );

                    if (count($listPresencas) == 0) {
                         $turma->setIdTurma($listaTurmas[$i]["idTurma"]);
                         $alunosTurma = $turma->listAlunosTurma();

                         for ($k = 0; $k < count($alunosTurma); $k++) {
                              $sql->select("INSERT INTO  tblPresencaAulas(fkAula, fkAluno, boolPresenca)
                               values (:ATRIBUTO1, :ATRIBUTO2, true);",
                                   array (":ATRIBUTO1" => $listAulas[$j]["idAulas"], ":ATRIBUTO2" => $alunosTurma[$k]["idAlunos"])
                              );
                         }
                    }
               }
          }

     }


     //  $page->setTpl("cadastro-aulas", array("turma" => $id, "listaTurmas" => $turmasEscola));
     exit;
});


$app->get('/admin/corrigePresencasAdicao/:idTurma', function ($idTurma) {
     // User::verifyLoginAdmin();
     $sql = new Sql();
     //$page = new PageAdmin();
     $turma = new Turma();

     $aulas = new Aulas();


     $turma->setIdTurma($idTurma);
     $alunosTurma = $turma->listAlunosTurma();

     for ($k = 0; $k < count($alunosTurma); $k++) {
          if (
               $alunosTurma[$k]["dataMatricula"] != "2022-02-07" ||
               !is_null($alunosTurma[$k]["dataSaida"])
          ) {
               $dataFinal = is_null($alunosTurma[$k]["dataSaida"]) ? "2023-12-15" : $alunosTurma[$k]["dataSaida"];
               $listAulas = $sql->select(
                    "SELECT * from tblAulas inner join tblPresencaAulas on fkAula = idAulas where fkTurma = :ATRIBUTO and dtData between :ATRIBUTO1 and :ATRIBUTO2",
                    array (":ATRIBUTO" => $idTurma, ":ATRIBUTO1" => $alunosTurma[$k]["dataMatricula"], ":ATRIBUTO2" => $dataFinal)
               );



               $listAvaliacoes = $sql->select("SELECT * from tblAvaliacoes  inner join tblNotas on fkAvaliacao = idAvaliacao
                           where fkTurma = :ATRIBUTO and dtData between :ATRIBUTO1 and :ATRIBUTO2",
                    array (":ATRIBUTO" => $idTurma, ":ATRIBUTO1" => $alunosTurma[$k]["dataMatricula"], ":ATRIBUTO2" => $dataFinal)
               );

               for ($j = 0; $j < count($listAulas); $j++) {
                    $presencas = $sql->select(
                         "SELECT * FROM tblPresencaAulas WHERE fkAula = :ATRIBUTO1 and fkAluno = :ATRIBUTO2;",
                         array (":ATRIBUTO1" => $listAulas[$j]["idAulas"], ":ATRIBUTO2" => $alunosTurma[$k]["idAlunos"])
                    );

                    if (count($presencas) == 0) {

                         $sql->select("INSERT INTO  tblPresencaAulas(fkAula, fkAluno, boolPresenca)
                              values (:ATRIBUTO1, :ATRIBUTO2, true);",
                              array (":ATRIBUTO1" => $listAulas[$j]["idAulas"], ":ATRIBUTO2" => $alunosTurma[$k]["idAlunos"])
                         );
                    }

               }



               for ($j = 0; $j < count($listAvaliacoes); $j++) {
                    $notas = $sql->select(
                         "SELECT * FROM tblNotas WHERE fkAvaliacao = :ATRIBUTO1 and fkAluno = :ATRIBUTO2;",
                         array (":ATRIBUTO1" => $listAvaliacoes[$j]["idAvaliacoes"], ":ATRIBUTO2" => $alunosTurma[$k]["idAlunos"])
                    );

                    if (count($notas) == 0) {

                         $sql->select("INSERT INTO  tblNotas(fkAvaliacao, fkAluno, intNota)
                               values (:ATRIBUTO1, :ATRIBUTO2, 0);",
                              array (":ATRIBUTO1" => $listAvaliacoes[$j]["idAvaliacao"], ":ATRIBUTO2" => $alunosTurma[$k]["idAlunos"])
                         );
                    }

               }

               if ($alunosTurma[$k]["dataMatricula"] != "2022-02-07") {
                    $listAulas = $sql->select("SELECT * from tblAulas inner join tblPresencaAulas on fkAula = idAulas where fkTurma = :ATRIBUTO 
                         and dtData between :ATRIBUTO1 and :ATRIBUTO2",
                         array (
                              ":ATRIBUTO" => $idTurma,
                              ":ATRIBUTO1" => date("2022-02-07"),
                              ":ATRIBUTO2" => date('Y-m-d', strtotime("-1 day", strtotime($alunosTurma[$k]["dataMatricula"])))
                         )
                    );

                    $listAvaliacoes = $sql->select("SELECT * from tblAvaliacoes  inner join tblAvaliacao on fkAvaliacao = idAvaliacao
                         where fkTurma = :ATRIBUTO and dtData between :ATRIBUTO1 and :ATRIBUTO2",
                         array (
                              ":ATRIBUTO" => $idTurma,
                              ":ATRIBUTO1" => date("2022-02-07"),
                              ":ATRIBUTO2" => date('Y-m-d', strtotime("-1 day", strtotime($alunosTurma[$k]["dataMatricula"])))
                         )
                    );


                    for ($aul = 0; $aul < count($listAulas); $aul++) {
                         $sql->select(
                              "DELETE from tblPresencaAulas where fkAula = :ATRIBUTO and fkAluno = :ATRIBUTO1",
                              array (":ATRIBUTO" => $listAulas[$aul]["idAulas"], ":ATRIBUTO1" => $alunosTurma[$k]["idAlunos"])
                         );

                    }

                    for ($aul = 0; $aul < count($listAvaliacoes); $aul++) {
                         $sql->select(
                              "DELETE from tblNotas where fkAula = :ATRIBUTO and fkAluno = :ATRIBUTO1",
                              array (":ATRIBUTO" => $listAvaliacoes[$aul]["idAvaliacao"], ":ATRIBUTO1" => $alunosTurma[$k]["idAlunos"])
                         );

                    }
               }
               if (!is_null($alunosTurma[$k]["dataSaida"])) {

                    $listAulas = $sql->select(
                         "SELECT * from tblAulas inner join tblPresencaAulas on fkAula = idAulas where fkTurma = :ATRIBUTO and dtData between :ATRIBUTO1 and :ATRIBUTO2",
                         array (":ATRIBUTO" => $idTurma, ":ATRIBUTO1" => date('Y-m-d', strtotime("+1 day", strtotime($alunosTurma[$k]["dataSaida"]))), ":ATRIBUTO2" => date("2023-12-15"))
                    );

                    $listAvaliacoes = $sql->select("SELECT * from tblAvaliacoes  inner join tblAvaliacao on fkAvaliacao = idAvaliacao
                          where fkTurma = :ATRIBUTO and dtData between :ATRIBUTO1 and :ATRIBUTO2",
                         array (":ATRIBUTO" => $idTurma, ":ATRIBUTO1" => date('Y-m-d', strtotime("+1 day", strtotime($alunosTurma[$k]["dataSaida"]))), ":ATRIBUTO2" => date("2023-12-15"))
                    );


                    for ($aul = 0; $aul < count($listAulas); $aul++) {
                         $sql->select(
                              "DELETE from tblPresencaAulas where fkAula = :ATRIBUTO and fkAluno = :ATRIBUTO1",
                              array (":ATRIBUTO" => $listAulas[$aul]["idAulas"], ":ATRIBUTO1" => $alunosTurma[$k]["idAlunos"])
                         );

                    }

                    for ($aul = 0; $aul < count($listAvaliacoes); $aul++) {
                         $sql->select(
                              "DELETE from tblNotas where fkAvaliacao = :ATRIBUTO and fkAluno = :ATRIBUTO1",
                              array (":ATRIBUTO" => $listAvaliacoes[$aul]["idAvaliacao"], ":ATRIBUTO1" => $alunosTurma[$k]["idAlunos"])
                         );

                    }


               }

               if ($alunosTurma[$k]["dataMatricula"] == "2022-02-07" && is_null($alunosTurma[$k]["dataSaida"])) {
                    $listAulas = $sql->select(
                         "SELECT * from tblAulas where fkTurma = :ATRIBUTO and dtData between :ATRIBUTO1 and :ATRIBUTO2",
                         array (
                              ":ATRIBUTO" => $idTurma,
                              ":ATRIBUTO1" => date('2023-02-06'),
                              ":ATRIBUTO2" => date('Y-m-d', strtotime("-1 day", strtotime($alunosTurma[$k]["dataMatricula"])))
                         )
                    );

                    for ($aul = 0; $aul < count($listAulas); $aul++) {
                         $sql->select(
                              "DELETE from tblPresencaAulas where fkAula = :ATRIBUTO and fkAluno = :ATRIBUTO1",
                              array (":ATRIBUTO" => $listAulas[$aul]["idAulas"], ":ATRIBUTO1" => $alunosTurma[$k]["idAlunos"])
                         );

                    }
               }

          }
     }




     //  $page->setTpl("cadastro-aulas", array("turma" => $id, "listaTurmas" => $turmasEscola));
     exit;
});




$app->get('/admin/turmas', function () {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $turma = new Turma();
   
     if (isset ($_GET["txtAno"])) {
          $turma->setTxtAnoTurma($_GET["txtAno"]);
     } else {
          $turma->setTxtAnoTurma(date("Y"));
     }


     if ($_SESSION["admin"]["permissao"] == 3) {
          $turma->setProfessor($_SESSION["admin"]["id"]);
          $page->setTpl("list-turmas", array ("turma" => $turma->listTurmaProfessor(), "anos" => Turma::listAnos()));
     } else if ($_SESSION["admin"]["permissao"] == 2) {

          $secretario = new Servidores();
          $secretario->setIdServidores($_SESSION["admin"]["id"]);
          $listEscolas = $secretario->getUserSecretarioTurmas();
          $turma->setProfessor($_SESSION["admin"]["id"]);
          $listTurmas = [];

          for($i=0; $i<count($listEscolas); $i++){
               $turma->setFkEscola($listEscolas[$i]["fkEscola"]);
               $listTurmasEscola = $turma->getTurmaEscolaAno();

               for($j=0; $j<count($listTurmasEscola); $j++){
                    array_push($listTurmas, $listTurmasEscola[$j]);
               }
             
          }


        
          $page->setTpl("list-turmas", array ("turma" => $listTurmas, "anos" => Turma::listAnos()));
     } else {
          $page->setTpl("list-turmas", array ("turma" => $turma->listAllTurma(), "anos" => Turma::listAnos()));
     }
     exit;
});

$app->post('/admin/cadastrar-turmas', function () {
     User::verifyLoginAdmin();
     $turma = new Turma();
     $turma->setDadosForm($_POST);
     $turma->save();
     header("location: /admin/turmas");
     exit;
});



//Rota de cadastro
$app->get('/admin/cadastrar-turmas', function () {
     User::verifyLoginAdmin();
     $page = new PageAdmin();
     $page->setTpl("cadastro-turmas", array ("escolas" => Escola::listAllEscolas()));
     exit;
});


$app->get('/admin/uploadAlunosTurma/:idEscola', function ($idEscola) {
     User::verifyLoginAdmin();

     $matricula = new Matricula();
     $turma = new Turma();
     $turma->setFkEscola($idEscola);
     $turma->setTxtAnoTurma('2024');

     $turnos = [
          "Manhã",
          "Tarde",
          "Noite",
          "Integral"
     ];

     $matricula->setFkEscola($idEscola);
     $listaMatricula = $matricula->listMatriculasEscola();

     for ($i = 0; $i < count($listaMatricula); $i++) {
          $turma->setEtapa($listaMatricula[$i]["txtAnoCiclo"]);
          $turma->setTurno($turnos[$listaMatricula[$i]["txtTurno"] - 1]);
          $infoTurma = $turma->getTurmaEscolaAnoEnsinoTurno();

          $turma->setIdTurma($infoTurma[0]["idTurma"]);
          $turma->setAluno($listaMatricula[$i]["fkAluno"]);
          $turma->setDataMatricula("2024-02-05");


          $turma->cadastraAlunoTurma();
     }
     exit;
});