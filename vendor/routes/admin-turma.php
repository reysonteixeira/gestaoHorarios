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


