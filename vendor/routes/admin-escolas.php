<?php

$app->post('/admin/escolas/:id', function ($id) {
     Usuario::verifyLoginAdmin();
     $escola = new Escola();
     $escola->setIdEscola($id);
     $escola->setDadosForm($_POST);
     $escola->save();
     header("location: /admin/escolas");
     exit;
});

$app->get('/admin/escolas/:id', function ($id) {
     Usuario::verifyLoginAdmin();
     $page = new PageAdmin();
     $escola = new Escola();
     $page->setTpl("edit-escolas", array("escola" => $escola->get($id)));
     exit;
});

$app->get('/admin/escolas', function () {
     Usuario::verifyLoginAdmin();
     $page = new PageAdmin();
     $page->setTpl("list-escolas", array("escolas" => Escola::listAll()));
     exit;
});

$app->post('/admin/cadastrar-escolas', function () {
     Usuario::verifyLoginAdmin();
     $escola = new Escola();
     $escola->setIdEscola(0);
     $escola->setDadosForm($_POST);
     $escola->save();
     header("location: /admin/escolas");
     exit;
});


//Rota de cadastro
$app->get('/admin/cadastrar-escolas', function () {
     Usuario::verifyLoginAdmin();
     $page = new PageAdmin();
     $page->setTpl("cadastro-escolas");
     exit;
});

//Rota DELETE
$app->get('/admin/deletarEscola/:id', function ($id) {
     Usuario::verifyLoginAdmin();
     $business = new Escola();
     $business->delete($id);
     header('location: /admin/escolas');
     exit;
});


