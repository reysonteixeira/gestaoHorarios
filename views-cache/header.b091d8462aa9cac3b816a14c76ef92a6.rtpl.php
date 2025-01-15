<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Diário Escolar Eletrônico - Capitólio</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/res/Admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="/res/Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/res/Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/res/Admin/plugins/jqvmap/jqvmap.min.css">

  <link rel="stylesheet" href="/res/Admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/res/Admin/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="/res/Admin/dist/css/admin.css">

  <link rel="stylesheet" href="/res/Admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/res/Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/res/Admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/res/Admin/plugins/summernote/summernote-bs4.css">

  <link rel="stylesheet" href="/res/styleCadastro.css">
  <link rel="stylesheet" href="/res/styleAdmin.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
    
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item ">
        <a class="nav-link"  href="/admin/logout">
          <i class="fas fa-door-open"></i>
          
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if( $permissaoCovid ){ ?>
          <li class="nav-item">
            <a href="/monitoramento-covid/casosMonitorados" class="nav-link">
             
              <i class="nav-icon fas fa-virus"></i>
              <p>Monitoramento
              </p>
            </a>
          
          </li>
          <?php } ?>


          <?php if( $permissaoMenu ){ ?>

          <?php if( $permissaoMenu < 3 ){ ?>
          <li class="nav-item">
            <a href="/admin/alunos" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>Alunos</p>
            </a>
          </li>
          <?php } ?>

          <?php if( $permissaoMenu < 3 ){ ?>
          <li class="nav-item">
            <a href="/admin/servidores" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>Servidores</p>
            </a>
          </li>
          <?php } ?>
         
          <?php if( $permissaoMenu < 3 ){ ?>
          <li class="nav-item">
            <a href="/admin/escolas" class="nav-link">
              <i class="nav-icon fas fa-school"></i>
              <p>Escolas</p>
            </a>
          </li>
          <?php } ?>

          <?php if( $permissaoMenu < 3 ){ ?>
          <li class="nav-item">
            <a href="/admin/supervisores" class="nav-link">
              <i class="nav-icon fas fa-school"></i>
              <p>Supervisores</p>
            </a>
          </li>
          <?php } ?>

        



          <li class="nav-item">
            <a href="/admin/turmas" class="nav-link">
              <i class="nav-icon fas fas fa-chalkboard"></i>
              <p>Turmas</p>
            </a>
          </li>
          <?php if( $permissaoMenu == 1 ){ ?>
          <li class="nav-item">
            <a href="/admin/disciplinas" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>Disciplinas</p>
            </a>
          </li>
          <?php } ?>
   
          <?php if( $permissaoMenu == 1 ){ ?>
          <li class="nav-item">
            <a href="/admin/maisEducacao" class="nav-link">
              <i class="nav-icon  fas fa-copy"></i>
              <p>Mais Educação</p>
            </a>
          </li>
          <?php } ?>

          <?php if( $permissaoMenu == 1 ){ ?>
          <li class="nav-item">
            <a href="/admin/blog" class="nav-link">
              <i class="nav-icon fas fa-blog"></i>
              <p>Blog</p>
            </a>
          </li>
          <?php } ?>

          <?php if( $permissaoMenu == 1 ){ ?>
          <li class="nav-item">
            <a href="/admin/bimestres" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>Bimestres</p>
            </a>
          </li>
          <?php } ?>
         
          <?php if( $permissaoMenu == 1 ){ ?>
          <li class="nav-item">
            <a href="/admin/requisicaoServico" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>Solicitação de Serviços</p>
            </a>
          </li>
          <?php } ?>
         
          <?php if( $permissaoSupervisor ){ ?>
          <li class="nav-item">
            <a href="/admin/supervisionarTurmas/escolas" class="nav-link">
              <i class="nav-icon fas fa-school"></i>
              <p>Supervisionar</p>
            </a>
          </li>
          <?php } ?>
          <li class="nav-header">ACESSO PESSOAL</li>

          <?php if( $permissaoMenu ){ ?>
          <li class="nav-item">
            <a href="/admin/dados-pessoais" class="nav-link">
              <i class="nav-icon fas fa-user"></i><p>Minha Conta</p>
            </a>

          </li>
          <?php } ?>
          <li class="nav-item">
            <a href="/admin/logout" class="nav-link">
              <i class="nav-icon fas fa-door-open"></i>
              <p>Sair do Sistema</p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
