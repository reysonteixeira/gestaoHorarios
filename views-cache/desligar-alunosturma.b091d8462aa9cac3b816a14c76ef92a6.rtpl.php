<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Desligar Aluno em Turma</h1>
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
              <form method="POST" action="/admin/desligarAluno/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $aluno, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">

                <div class="col-3 form-group">
                  <label for="">Data de Saída</label>
                  <input type="date" class="form-control" name="dataSaida">
                </div>

                <div class="col-7 form-group">
                  <label for="">Motivo da Saída</label>
                  <textarea name="txtMotivoSaida" rows="2" class="form-control"></textarea>
                </div>
                <div class="col-md-2 form-group">
                  <label for=""></label>
                  <button type="submit" class="btn btn-primary form-control">Remover Aluno</button>
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

