<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro de Servidores</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="/admin/cadastrar-servidores">
                <div class="card-body row">

                  <div class="form-group col-md-5">
                    <label for="exampleInputName">Nome Completo</label>
                    <input type="text" class="form-control" id="exampleInputName" name="txtNome" placeholder="Nome Completo">
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputTelefone">Telefone</label>
                    <input type="tel" class="form-control" id="exampleInputTelefone" name="txtTelefone">
                  </div>

                  <div class="form-group col-md-5">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="txtEmail">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="txtSenha" >
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputTipoAcesso">Tipo de Acesso</label>
                    <select name="intTipoAcesso" class="form-control">
                      <option value="">SELECIONE</option>
                      <option value="1">Secretaria de Educação</option>
                      <option value="2">Secretários Escola</option>
                      <option value="3">Professores</option>
                      <option value="4">Supervisores</option>
                      <option value="5">Direção</option>
                    </select>
                    
                  </div>
                  <div class="form-group col-md-2">
                    <label for=""></label>
                    <input type="submit" value="ENVIAR" class="btn btn-primary form-control">
                  </div>
                  
                </div>
                <!-- /.card-body -->

               
              </form>
            </div>
            <!-- /.card -->

         

       

          </div>
          <!--/.col (left) -->
          <!-- right column -->
        
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  