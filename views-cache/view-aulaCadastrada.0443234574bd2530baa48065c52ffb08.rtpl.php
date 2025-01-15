<?php if(!class_exists('Rain\Tpl')){exit;}?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Aula</h1>
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
              <form>
                <div class="card-body row">
                  <div class="form-group col-md-3">
                    <label for="exampleInputPostagem">Data da Aula</label>
                    <input type="date" class="form-control" disabled id="exampleInputPostagem" value="<?php echo htmlspecialchars( $aula["dtData"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="dtDataAula">
                  </div>



                  <div class="form-group col-md-12">
                    <label for="exampleInputDescricao">Descrição da aula</label>
                    <textarea  class="form-control" disabled name="txtDescricao" rows="5"><?php echo htmlspecialchars( $aula["txtDescricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                  </div>
                <!-- /.card-body -->

              </form>
              <div class="col-md-2">
                <a href="/admin/supervisionarTurmas/escolas/<?php echo htmlspecialchars( $escola, ENT_COMPAT, 'UTF-8', FALSE ); ?>/turma/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>/professor/<?php echo htmlspecialchars( $professor, ENT_COMPAT, 'UTF-8', FALSE ); ?>/aulas" class="btn btn-info form-control">Voltar</a> 
              </div>
             
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
