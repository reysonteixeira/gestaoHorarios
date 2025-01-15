<?php if(!class_exists('Rain\Tpl')){exit;}?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Escolas</h1>
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
              <form method="POST" action="/admin/escolas/<?php echo htmlspecialchars( $escola["idEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">
                  
                  <div class="form-group col-md-6">
                    <label for="exampleInputName">Nome da Escola</label>
                    <input type="text" class="form-control" id="exampleInputName" name="txtNome" value="<?php echo htmlspecialchars( $escola["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Escola">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputName">Endereço</label>
                    <input type="text" class="form-control" id="exampleInputName" value="<?php echo htmlspecialchars( $escola["txtEndereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="txtEndereco" placeholder="Rua , nº">
                  </div>

                  <div class="form-group col-md-5">
                    <label for="exampleInputName">Cidade</label>
                    <input type="text" class="form-control" id="exampleInputName" value="<?php echo htmlspecialchars( $escola["txtCidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="txtCidade" placeholder="Cidade">
                  </div>

                  <div class="form-group col-md-1">
                    <label for="exampleInputName">UF</label>
                    <input type="text" class="form-control" id="exampleInputName" value="<?php echo htmlspecialchars( $escola["txtEstado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="txtEstado" placeholder="UF">
                  </div>


                  <div class="form-group col-md-3">
                    <label for="exampleInputName">Telefone</label>
                    <input type="text" class="form-control" id="exampleInputName" value="<?php echo htmlspecialchars( $escola["txtTelefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="txtTelefone" placeholder="Telefone">
                  </div>

                  
                  <div class="col-md-2 form-group">
                    <label for=""></label>
                    <input type="submit" value="ATUALIZAR" class="btn btn-primary form-control">
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
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

