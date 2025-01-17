<?php

$app->get('/admin/professores', function () {
    // User::verifyLoginAdmin();
    $page = new PageAdmin();
    $professores = new Professores();
    $professores->setFkEscola(1);
    if(isset($_GET["busca"])){
        $professores->setNomeProfessor($_GET["busca"]);
        $listaProfessores = $professores->searchProfessor();
        $page->setTpl("list-professores", array("professores" => $listaProfessores));
        exit;
    }
    $listaProfessores = $professores->listAll();
    $page->setTpl("list-professores", array("professores" => $listaProfessores));

    exit;
});

$app->get('/admin/professores/:id', function ($id) {
    // User::verifyLoginAdmin();
    $page = new PageAdmin();
    $professores = new Professores();
    $professores->setFkEscola(1);
    $professores->setIdProfessor($id);
    $getProfessor = $professores->getProfessor();
    var_dump($getProfessor);
    $page->setTpl("edit-professores", array("professor" => $professores->getProfessor()));
    exit;
});

$app->post('/admin/professores/:id', function ($id) {
    // User::verifyLoginAdmin();
    $professores = new Professores();
    $professores->setFkEscola(1);
    $professores->setIdProfessor($id);
    $professores->setDados($_POST);
    $professores->update();
    header("location: /admin/professores");
    exit;
});

$app->get('/admin/cadastrar-professores', function () {
    // User::verifyLoginAdmin();
    $page = new PageAdmin();
    $page->setTpl("cadastra-professores", array());
    exit;
});

$app->post('/admin/cadastrar-professores', function () {
    // User::verifyLoginAdmin();
    $professores = new Professores();
    $professores->setDados($_POST);
    $professores->save();
    header("location: /admin/professores");
    exit;
});