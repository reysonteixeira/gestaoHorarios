<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Apuração de Presenças</h1>
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
              <form method="get" action="/admin/consolidadoPresencas/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">
                 
                  <div class="col-md-4 form-group">
                    <label for="">Bimestres</label>
                    <select name="idBimestre" id="" class="form-control">
                      <?php $counter1=-1;  if( isset($bimestres) && ( is_array($bimestres) || $bimestres instanceof Traversable ) && sizeof($bimestres) ) foreach( $bimestres as $key1 => $value1 ){ $counter1++; ?>
                        <option value="<?php echo htmlspecialchars( $value1["idBimestre"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomeBimestre"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                    
                  </div>




                <!-- /.card-body -->

                <div class="card-footer col-md-12 form-group">
                  <button type="submit" class="btn btn-primary form-control">GERAR RELATÓRIO</button>
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
