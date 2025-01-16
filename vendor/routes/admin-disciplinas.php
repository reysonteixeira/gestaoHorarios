<?php

    $app->post('/admin/cadastrar-disciplinas', function(){
        // User::verifyLoginAdmin();
        $disciplinas = new Disciplinas();
        $disciplinas->setTxtNomeDisciplina($_POST["txtNomeDisciplinas"]);
        $disciplinas->setIntTipoAvaliacao($_POST["intTipoAvaliacao"]);
        $disciplinas->setMatrizCurricular($_POST["matrizCurricular"]);

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
        $disciplina->setIdDisciplinas($id);
        $disciplina->setTxtNomeDisciplina($_POST["txtNomeDisciplinas"]);
        $disciplina->setIntTipoAvaliacao($_POST["intTipoAvaliacao"]);
        $disciplina->setMatrizCurricular($_POST["matrizCurricular"]);
        $disciplina->update();
        header("location: /admin/disciplinas");
        exit;
    });

    $app->get('/admin/disciplinas/:id', function($id)
    {
        // User::verifyLoginAdmin();
        $page = new PageAdmin();
        $disciplina = new Disciplinas();
        $disciplina->setIdDisciplinas($id);
        $disciplinaInfo = $disciplina->get();
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
        $disciplina->setIdDisciplinas($id);
        $disciplina->delete();
        header('location: /admin/disciplinas');
        exit;
    });

?>