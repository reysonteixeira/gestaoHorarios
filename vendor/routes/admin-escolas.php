<?php

use Dompdf\Dompdf;
use Dompdf\Options;

$app->post('/admin/escolas/:id', function ($id) {
     // User::verifyLoginAdmin();
     $escola = new Escola();
     $escola->setIdEscola($id);
     $escola->setDadosForm($_POST);
     $escola->update();
     header("location: /admin/escolas");
     exit;
});





$app->get('/admin/escolas/:id', function ($id) {
     // User::verifyLoginAdmin();
     $page = new PageAdmin();
     $escola = new Escola();
     $escola->setIdEscola($id);
     $page->setTpl("edit-escolas", array("escola" => $escola->get()));
     exit;
});


$app->get('/admin/minhaEscola', function () {
     // User::verifyLoginAdmin();
     $page = new PageAdmin();
     $servidor = new Servidores();
     $turmas = new Turma();
     $escola = new Escola();

     $servidor->setIdServidores($_SESSION["admin"]["id"]);

     $secretario = $servidor->getUserSecretario();

     $escola->setIdEscola($secretario["fkEscola"]);

     $page->setTpl("edit-escolas", array("escola" => $escola->get(), "completo" => true));
     exit;
});


$app->get('/admin/escolas', function () {
     // User::verifyLoginAdmin();
     $page = new PageAdmin();
     $page->setTpl("list-escolas", array("escolas" => Escola::listAllEscolas()));
     exit;
});

$app->post('/admin/cadastrar-escolas', function () {
     // User::verifyLoginAdmin();
     $escola = new Escola();
     $escola->setDadosForm($_POST);

     $escola->setTxtLogo($_FILES["fotos"]["name"]);
     $escola->uploadLogo($_FILES);
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
     $business->setIdEscola($id);
     $business->delete();
     header('location: /admin/escolas');
     exit;
});


