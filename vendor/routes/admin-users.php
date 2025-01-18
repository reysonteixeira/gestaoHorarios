<?php


$app->get('/admin/users', function () {
    $usuario = new Usuario();
    $page = new PageAdmin();
    $usuario->listAll();
    $page->setTpl("list-users", array("usuarios" => $usuario->listAll()));
    exit;
});

$app->get('/admin/users/:id', function ($id) {
    $usuario = new Usuario();
    $page = new PageAdmin();
    $usuario->setIdUsuario($id);
    $page->setTpl("edit-users", array("usuario" => $usuario->getUserById()));
    exit;
});

$app->post('/admin/users/:id', function ($id) {
    $usuario = new Usuario();
    $usuario->setIdUsuario($id);
    $usuario->setDados($_POST);
    $usuario->save();
    header("location: /admin/users");
    exit;
});

$app->post('/admin/cadastrar-users', function () {
    $usuario = new Usuario();
    $usuario->setIdUsuario(0);
    $usuario->setDados($_POST);
    $usuario->save();
    header("location: /admin/users");
    exit;
});

$app->get('/admin/cadastrar-users', function () {
    $page = new PageAdmin();
    $page->setTpl("cadastro-usuarios");
    exit;
});