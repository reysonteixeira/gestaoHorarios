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
        if($usuario->getTipoAcesso() == 1){
            header("location: /admin/escolas");
            exit;
        }else{
            header("location: /admin/grades");
            exit;
        }
        exit;
    }else{
        header("location: /login");
        exit;
    }
});

$app->get('/admin/usuarios', function () {
    Usuario::verifyLoginEscola();
    $usuario = new Usuario();
    $page = new PageAdmin();
    $listaUsuarios = [];
    if($_SESSION['tipoAcesso'] == 1){
        $listaUsuarios = $usuario->listAll();
    }else{
        $usuario->setFkEscola($_SESSION['fkEscola']);
        $listaUsuarios = $usuario->listByEscola();
    }
    $usuario->listAll();
    $page->setTpl("list-usuarios", array("usuarios" => $listaUsuarios));
    exit;
});

$app->get('/admin/usuarios/:id', function ($id) {
    Usuario::verifyLoginEscola();
    $usuario = new Usuario();
    $page = new PageAdmin();
    $usuario->setIdUsuario($id);
    $page->setTpl("edit-usuarios", array("usuario" => $usuario->getUserById()));
    exit;
});

$app->post('/admin/usuarios/:id', function ($id) {
    Usuario::verifyLoginEscola();
    $usuario = new Usuario();
    $usuario->setIdUsuario($id);
    $usuario->setDados($_POST);
    $usuario->save();
    header("location: /admin/usuarios");
    exit;
});

$app->post('/admin/cadastrar-usuarios', function () {
    Usuario::verifyLoginEscola();
    $usuario = new Usuario();
    $usuario->setIdUsuario(0);
    $usuario->setDados($_POST);
    var_dump($usuario);
    $usuario->save();
    header("location: /admin/usuarios");
    exit;
});

$app->get('/admin/cadastrar-usuarios', function () {
    Usuario::verifyLoginEscola();
    $page = new PageAdmin();

    $escolas = [];
    if($_SESSION['tipoAcesso'] == 1){
        $escolas = Escola::listAll();
    }
    $page->setTpl("cadastro-usuarios", array("escolas"=>$escolas, "tipoAcesso"=>$_SESSION['tipoAcesso']));
    exit;
});