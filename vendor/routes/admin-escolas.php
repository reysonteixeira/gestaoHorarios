<?php

$app->post('/admin/escolas/:id', function ($id) {
     // User::verifyLoginAdmin();
     $escola = new Escola();
     $escola->setIdEscola($id);
     $escola->setDadosForm($_POST);
     $escola->save();
     header("location: /admin/escolas");
     exit;
});

$app->get('/admin/escolas/:id', function ($id) {
     // User::verifyLoginAdmin();
     $page = new PageAdmin();
     $escola = new Escola();
     $page->setTpl("edit-escolas", array("escola" => $escola->get($id)));
     exit;
});

$app->get('/admin/escolas', function () {
     // User::verifyLoginAdmin();
     $page = new PageAdmin();
     $page->setTpl("list-escolas", array("escolas" => Escola::listAll()));
     exit;
});

$app->post('/admin/cadastrar-escolas', function () {
     // User::verifyLoginAdmin();
     $escola = new Escola();
     $escola->setIdEscola(0);
     $escola->setDadosForm($_POST);
     $escola->save();
     header("location: /admin/escolas");
     exit;
});


//Rota de cadastro
$app->get('/admin/cadastrar-escolas', function () {
     // User::verifyLoginAdmin();
     $page = new PageAdmin();
     $page->setTpl("cadastro-escolas");
     exit;
});

//Rota DELETE
$app->get('/admin/deletarEscola/:id', function ($id) {
     // User::verifyLoginAdmin();
     $business = new Escola();
     $business->delete($id);
     header('location: /admin/escolas');
     exit;
});


