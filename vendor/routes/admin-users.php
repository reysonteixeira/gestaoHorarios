<?php

$app->get("/login", function(){
    $page = new PageAdmin(
        array(
            "header"=>false,
            "footer"=>false
        )
    );
    $page->setTpl("login");
    exit;
});

$app->post("/login", function(){
    $usuario = new Usuario();
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    $usuario->login();

    if($usuario->getIdUsuario() > 0){
    
        $_SESSION['idUsuario'] = $usuario->getIdUsuario();
        $_SESSION['nomeUsuario'] = $usuario->getNomeUsuario();
        $_SESSION['tipoAcesso'] = $usuario->getTipoAcesso();
        $_SESSION['fkEscola'] = $usuario->getFkEscola();
        header("location: /admin");
        exit;
    }else{
        header("location: /login");
        exit;
    }
});

$app->get('/admin/usuarios', function () {
    $usuario = new Usuario();
    $page = new PageAdmin();
    $usuario->listAll();
    $page->setTpl("list-usuarios", array("usuarios" => $usuario->listAll()));
    exit;
});

$app->get('/admin/usuarios/:id', function ($id) {
    $usuario = new Usuario();
    $page = new PageAdmin();
    $usuario->setIdUsuario($id);
    $page->setTpl("edit-usuarios", array("usuario" => $usuario->getUserById()));
    exit;
});

$app->post('/admin/usuarios/:id', function ($id) {
    $usuario = new Usuario();
    $usuario->setIdUsuario($id);
    $usuario->setDados($_POST);
    $usuario->save();
    header("location: /admin/usuarios");
    exit;
});

$app->post('/admin/cadastrar-usuarios', function () {
    $usuario = new Usuario();
    $usuario->setIdUsuario(0);
    $usuario->setDados($_POST);
    var_dump($usuario);
    $usuario->save();
    header("location: /admin/usuarios");
    exit;
});

$app->get('/admin/cadastrar-usuarios', function () {
    $page = new PageAdmin();
    $page->setTpl("cadastro-usuarios");
    exit;
});