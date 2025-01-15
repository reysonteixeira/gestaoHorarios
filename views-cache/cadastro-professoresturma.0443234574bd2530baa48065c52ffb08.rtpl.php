<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro Turma</h1>
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
              <form method="POST" action="/admin/professoresturma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">

                


                  <div class="form-group col-md-12">
                    <select class="duallistbox" multiple="multiple" name="destaques[]">
                      <?php $counter1=-1;  if( isset($professores) && ( is_array($professores) || $professores instanceof Traversable ) && sizeof($professores) ) foreach( $professores as $key1 => $value1 ){ $counter1++; ?>
                       
                       
                        <option value="<?php echo htmlspecialchars( $value1["idServidores"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $value1["fkTurma"] == $turma["idTurma"] ){ ?> selected <?php } ?>>
                          <?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </option>
                        
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
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

