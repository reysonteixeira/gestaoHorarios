<?php
    $app->get('/admin/horarios', function () {
        Usuario::verifyLoginEscola();
        $page = new PageAdmin();
        $horarios = new Horarios();
        $horarios->setFkEscola($_SESSION['fkEscola']);
        $listaHorarios = $horarios->listAll();
        $page->setTpl("list-horarios", array("horarios" => $listaHorarios));
        exit;
    });

    $app->get('/admin/horarios/:id', function ($id) {
        Usuario::verifyLoginEscola();
        $page = new PageAdmin();
        $horarios = new Horarios();
        $horarios->setFkEscola($_SESSION['fkEscola']);
        $horarios->setIdHorario($id);
        $infoHorario = $horarios->get($id);
        if(count($infoHorario) == 0){
            header("location: /admin/horarios");
            exit;
        }
        var_dump($infoHorario[0]);
        $page->setTpl("edit-horarios", array("horario" => $infoHorario[0]));
        exit;
    });


    $app->get('/admin/cadastrar-horarios', function () {
        Usuario::verifyLoginEscola();
        $page = new PageAdmin();
        $page->setTpl("cadastra-horarios", array());
        exit;
    });

    $app->post('/admin/cadastrar-horarios', function () {
        Usuario::verifyLoginEscola();
        $horarios = new Horarios();
        $horarios->setIdHorario(0);
        $horarios->setFkEscola($_SESSION['fkEscola']);
        $horarios->setDados($_POST);
        $horarios->save();
        header("location: /admin/horarios");
        exit;
    });

    $app->post('/admin/horarios/:id', function ($id) {
        Usuario::verifyLoginEscola();
        $horarios = new Horarios();
        $horarios->setFkEscola($_SESSION['fkEscola']);
        $horarios->setIdHorario($id);
        $horarios->setDados($_POST);
        $horarios->save();
        header("location: /admin/horarios");
        exit;
    });
