<?php
$app->get('/admin/turmas', function(){
     Usuario::verifyLoginEscola();
     $page = new PageAdmin();
     $turma = new Turma();
     $turma->setFkEscola($_SESSION['fkEscola']);
     $listaTurmas = $turma->listAll();
     $page->setTpl("list-turmas", array("turmas" => $listaTurmas));
     exit;
});


$app->get('/admin/testeExport', function(){

    $outputFile = __DIR__ . '/backup_' . date('Y-m-d_H-i-s') . '.sql';

    try {
        // Instância da classe Sql
        $sql = new Sql();

        // Nome do banco de dados
        $dbName = Sql::DBNAME;

        // Obter todas as tabelas do banco
        $tables = $sql->select("SHOW TABLES");

        // Abrir arquivo para escrita
        $fp = fopen($outputFile, 'w');

        if (!$fp) {
            throw new Exception("Não foi possível criar o arquivo de backup.");
        }

        // Iterar sobre as tabelas
        foreach ($tables as $table) {
            $tableName = $table["Tables_in_" . $dbName];

            // Obter o comando CREATE TABLE
            $createTable = $sql->select("SHOW CREATE TABLE $tableName")[0]["Create Table"];
            fwrite($fp, "-- Estrutura da tabela $tableName\n");
            fwrite($fp, $createTable . ";\n\n");

            // Obter os dados da tabela
            $rows = $sql->select("SELECT * FROM $tableName");

            if (!empty($rows)) {
                fwrite($fp, "-- Dados da tabela $tableName\n");

                foreach ($rows as $row) {
                    $values = array_map(function ($value) {
                        return isset($value) ? "'" . addslashes($value) . "'" : "NULL";
                    }, $row);

                    fwrite($fp, "INSERT INTO `$tableName` VALUES (" . implode(", ", $values) . ");\n");
                }

                fwrite($fp, "\n");
            }
        }

        fclose($fp);

        echo "Backup criado com sucesso: $outputFile";
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
});



$app->get('/admin/turmas/:id', function($id){
    Usuario::verifyLoginEscola();
    $page = new PageAdmin();
    $turma = new Turma();
    $turma->setIdTurma($id);
    $turma->setFkEscola($_SESSION['fkEscola']);
    $infoTurma = $turma->get($id);
    $horarios = new Horarios();
    $horarios->setFkEscola($_SESSION['fkEscola']);
    $listaHorarios = $horarios->listAll();

    if(count($infoTurma) == 0){
        header("location: /admin/turmas");
        exit;
    }
    $page->setTpl("edita-turmas", array("turma" => $infoTurma[0], "horarios"=> $listaHorarios));
    exit;
});

$app->get('/admin/cadastrar-turmas', function(){
    Usuario::verifyLoginEscola();
     $horarios = new Horarios();
     $horarios->setFkEscola($_SESSION['fkEscola']);
     $listaHorarios = $horarios->listAll();

    $page = new PageAdmin();
    $page->setTpl("cadastra-turmas", array("horarios" => $listaHorarios));
    exit;
});

$app->post('/admin/cadastrar-turmas', function(){
    Usuario::verifyLoginEscola();
    $turma = new Turma();
    $turma->setIdTurma(0);
    $turma->setFkEscola($_SESSION['fkEscola']);
    $turma->setDadosForm($_POST);
    $turma->save();
    header("location: /admin/turmas");
    exit;
});

$app->post('/admin/turmas/:id', function($id){
    Usuario::verifyLoginEscola();
    $turma = new Turma();
    $turma->setIdTurma($id);
    $turma->setFkEscola($_SESSION['fkEscola']);
    $turma->setDadosForm($_POST);
    $turma->save();
    header("location: /admin/turmas");
    exit;
});

$app->get('/admin/turmas/delete/:id', function($id){
    Usuario::verifyLoginEscola();
    $turma = new Turma();
    $turma->setIdTurma($id);
    $turma->setFkEscola($_SESSION['fkEscola']);
    $turma->delete($id);
    header("location: /admin/turmas");
    exit;
});




//----------------------------------------------

$app->get('/admin/disciplinasTurma/:id', function($id){
    Usuario::verifyLoginEscola();
    $page = new PageAdmin();
    $disciplina = new DisciplinaTurma();
    $disciplina->setFkTurma($id);
    $disciplina->setFkEscola($_SESSION['fkEscola']);

    $listaDisciplinasTurma = $disciplina->listaDisciplinasTurma();

    $page->setTpl("list-disciplinas-turma", array("disciplinas" => $listaDisciplinasTurma, "idTurma"=> $id));
    exit;
});



$app->get('/admin/cadastraDisciplinasTurma/:id', function($id){
    Usuario::verifyLoginEscola();
    $page = new PageAdmin();
    $disciplina = new Disciplinas();
    $disciplina->setFkEscola($_SESSION['fkEscola']);
    $professor = new Professores();
    $professor->setFkEscola($_SESSION['fkEscola']);
    $listaDisciplinas = $disciplina->listAll();
    $page->setTpl("cadastra-disciplinas-turma", array("disciplinas" => $listaDisciplinas, "professores"=> $professor->listProfessorEscola(), "turma" => $id));
    exit;
});

$app->get('/admin/deletarDisciplinasTurma/:idTurma/:idDisciplinaTurma', function($idTurma, $idDisciplinaTurma){
    Usuario::verifyLoginEscola();
    $disciplina = new DisciplinaTurma();
    
    $disciplina->setIdDisciplinaTurma($idDisciplinaTurma);
    $disciplina->setFkTurma($idTurma);
    $disciplina->deleteDisciplinaTurma();
    header("location: /admin/disciplinasTurma/".$idTurma);

    exit;
});


$app->post('/admin/cadastraDisciplinasTurma/:id', function($id){
    Usuario::verifyLoginEscola();
    $disciplina = new DisciplinaTurma();
    $disciplina->setFkEscola($_SESSION['fkEscola']);
    $disciplina->setFkTurma($id);
    $disciplina->setIdDisciplinaTurma(0);
    $disciplina->setDados($_POST);
    $disciplina->save();
    header("location: /admin/disciplinasTurma/".$id);
    exit;
});





$app->post("/admin/editaDisciplinasTurma/:idTurma/:idDisciplinaTurma", function($idTurma, $idDisciplinaTurma){
    Usuario::verifyLoginEscola();
    $page = new PageAdmin();
    $disciplina = new DisciplinaTurma();
    $disciplina->setIdDisciplinaTurma($idDisciplinaTurma);
    $disciplina->setFkTurma($idTurma);
    $disciplina->setDados($_POST);

    $disciplina->save();
    header("location: /admin/disciplinasTurma/".$idTurma);
   
    exit;
});


$app->get("/admin/editaDisciplinasTurma/:idTurma/:idDisciplinaTurma", function($idTurma, $idDisciplinaTurma){
    Usuario::verifyLoginEscola();
    $page = new PageAdmin();
    $disciplina = new DisciplinaTurma();
    $disciplina->setIdDisciplinaTurma($idDisciplinaTurma);
    $disciplina->setFkTurma($idTurma);
    $disciplina->setFkEscola($_SESSION['fkEscola']);

    $disciplinas = new Disciplinas();
    $disciplinas->setFkEscola($_SESSION['fkEscola']);
    $professor = new Professores();
    $professor->setFkEscola($_SESSION['fkEscola']);

    $infoDisciplinaTurma = $disciplina->get();

    $listaDisciplinas = $disciplinas->listAll();

    if(count($infoDisciplinaTurma) == 0){
        header("location: /admin/disciplinasTurma/".$idTurma);
        exit;
    }

    $page->setTpl("edita-disciplinas-turma", array("disciplinas" => $listaDisciplinas, 
        "professores"=> $professor->listProfessorEscola(), "turma" => $idTurma, 
        "infoDisciplinaTurma" => $infoDisciplinaTurma[0]));
    exit;
});


