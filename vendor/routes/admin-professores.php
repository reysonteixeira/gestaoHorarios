<?php

$app->get('/admin/professores', function () {
    Usuario::verifyLoginEscola();
    $page = new PageAdmin();
    $professores = new Professores();
    $professores->setFkEscola($_SESSION['fkEscola']);
    if(isset($_GET["busca"])){
        $professores->setNomeProfessor($_GET["busca"]);
        $listaProfessores = $professores->searchProfessor();
        $page->setTpl("list-professores", array("professores" => $listaProfessores));
        exit;
    }
    $listaProfessores = $professores->listProfessorEscola();
    $page->setTpl("list-professores", array("professores" => $listaProfessores));

    exit;
});

$app->get('/admin/professores/:id', function ($id) {
    Usuario::verifyLoginEscola();
    $page = new PageAdmin();
    $professores = new Professores();
    $professores->setFkEscola($_SESSION['fkEscola']);
    $professores->setIdProfessor($id);
    $infoProfessor = $professores->getProfessor();
    if(count($infoProfessor) == 0){
        header("location: /admin/professores");
        exit;
    }
    $page->setTpl("edit-professores", array("professor" => $infoProfessor[0]));
    exit;
});

$app->post('/admin/professores/:id', function ($id) {
    Usuario::verifyLoginEscola();
    $professores = new Professores();
    $professores->setFkEscola($_SESSION['fkEscola']);
    $professores->setIdProfessor($id);
    $professores->setDados($_POST);
    $professores->update();
    header("location: /admin/professores");
    exit;
});

$app->get('/admin/cadastrar-professores', function () {
    Usuario::verifyLoginEscola();
    $page = new PageAdmin();
    $page->setTpl("cadastra-professores", array());
    exit;
});

$app->post('/admin/cadastrar-professores', function () {
    Usuario::verifyLoginEscola();
    $professores = new Professores();
    $professores->setFkEscola($_SESSION['fkEscola']);
    $professores->setDados($_POST);
    $professores->save();
    header("location: /admin/professores");
    exit;
});