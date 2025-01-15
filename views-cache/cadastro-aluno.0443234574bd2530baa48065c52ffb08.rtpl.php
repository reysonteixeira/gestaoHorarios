<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro de Aluno</h1>
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
              <form method="POST" action="/admin/cadastrar-alunos">
                <div class="card-body row">

                  <div class="form-group col-md-5">
                    <label for="exampleInputName">Nome Completo</label>
                    <input type="text" class="form-control" id="exampleInputName" name="txtNome" placeholder="Nome Completo">
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputDataNacimento">Data de Nacimento</label>
                    <input type="date" class="form-control" id="exampleInputDataNacimento" name="dtDataNacimento">
                  </div>

                  <div class="form-group col-md-5">
                    <label for="exampleInputNameMom">Nome da Mãe</label>
                    <input type="text" class="form-control" id="exampleInputNameMom" name="txtNomeMae" placeholder="Nome da Mãe">
                  </div>

                  <div class="form-group col-md-5">
                    <label for="exampleInputNameDad">Nome do Pai</label>
                    <input type="text" class="form-control" id="exampleInputNameDad" name="txtNomePai" placeholder="Nome do Pai">
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputTelefone">Telefone</label>
                    <input type="tel" class="form-control" id="exampleInputTelefone" name="txtTelefone" >
                  </div>

  

                  <div class="form-group col-md-3">
                    <label for="exampleInputRg">RG</label>
                    <input type="text" class="form-control" id="exampleInputRg" name="txtRg" placeholder="RG">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputRua">Logradouro</label>
                    <input type="text" class="form-control" id="exampleInputRua" name="txtRua" placeholder="Logradouro">
                  </div>

                  <div class="form-group col-md-1">
                    <label for="exampleInputNumeroCasa">Nº</label>
                    <input type="text" class="form-control" id="exampleInputNumeroCasa" name="intNumeroCasa" placeholder="Numero">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputBairro">Bairro</label>
                    <input type="text" class="form-control" id="exampleInputBairro" name="txtBairro" placeholder="Bairro">
                  </div>
                 
                  <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-primary form-control" value="ENVIAR">
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
 

 
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
