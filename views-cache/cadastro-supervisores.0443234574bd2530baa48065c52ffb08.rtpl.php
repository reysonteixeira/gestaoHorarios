<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro Supervisores</h1>
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
              <form method="POST" action="/admin/cadastrarSupervisores">
                <div class="card-body row">

                  <div class="form-group col-md-5">
                    <label for="exampleInputName">Nome</label>
                    <select name="idServidor" id=" " class="form-control">
                      <?php $counter1=-1;  if( isset($servidores) && ( is_array($servidores) || $servidores instanceof Traversable ) && sizeof($servidores) ) foreach( $servidores as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["idServidores"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputAnoTurma">Ano Letivo</label>
                    <input type="text" class="form-control" id="exampleInputAnoTurma" name="txtAnoLetivo" placeholder="Ano">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputAnoTurma">Escola</label>
                    <select name="fkEscola" id=" " class="form-control">
                      <?php $counter1=-1;  if( isset($escolas) && ( is_array($escolas) || $escolas instanceof Traversable ) && sizeof($escolas) ) foreach( $escolas as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["idEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer col-md-12 form-group">
                  <button type="submit" class="btn btn-primary form-control">Cadastrar</button>
                </div>
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

