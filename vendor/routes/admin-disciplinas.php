<?php

    $app->post('/admin/cadastrar-disciplinas', function(){
        // User::verifyLoginAdmin();
        $disciplinas = new Disciplinas();
        $disciplinas->setIdDisciplina(0);
        $disciplinas->setDadosForm($_POST);

        $disciplinas->save();
        header('location: /admin/disciplinas');
        exit;
    });

    $app->get('/admin/cadastrar-disciplinas', function()
    {
        // User::verifyLoginAdmin();
        $page = new PageAdmin();
        $page->setTpl("cadastro-disciplinas");
        exit;
    });

    $app->post('/admin/disciplinas/:id', function($id)
    {
        // User::verifyLoginAdmin();
        $disciplina = new Disciplinas();
        $disciplina->setIdDisciplina($id);
        $disciplina->setDadosForm($_POST);
        $disciplina->save();
        header("location: /admin/disciplinas");
        exit;
    });

    $app->get('/admin/disciplinas/:id', function($id)
    {
        // User::verifyLoginAdmin();
        $page = new PageAdmin();
        $disciplina = new Disciplinas();
        $disciplinaInfo = $disciplina->get($id);
        $page->setTpl("edit-disciplinas", array("disciplina"=>$disciplinaInfo));
        exit;
    });

    $app->get('/admin/disciplinas', function()
    {
        // User::verifyLoginAdmin();
        $page = new PageAdmin();
        
        $page->setTpl("list-Disciplinas", array("disciplinas"=>Disciplinas::listAll()));
        exit;
    });

    $app->get('/admin/deletarDisciplina/:id', function($id)
    {
        // User::verifyLoginAdmin();
        $disciplina = new Disciplinas();
        $disciplina->delete($id);
        header('location: /admin/disciplinas');
        exit;
    });

?>