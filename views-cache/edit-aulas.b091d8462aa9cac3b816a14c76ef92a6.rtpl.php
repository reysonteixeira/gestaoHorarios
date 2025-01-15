<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro de Aulas</h1>
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
              <form method="POST" action="/admin/editar-aulas/<?php echo htmlspecialchars( $aula["idAulas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">
                  <div class="form-group col-md-3">
                    <label for="exampleInputPostagem">Data da Aula</label>
                    <input type="date" class="form-control" id="exampleInputPostagem" value="<?php echo htmlspecialchars( $aula["dtData"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="dtDataAula">
                  </div>



                  <div class="form-group col-md-12">
                    <label for="exampleInputDescricao">Descrição da aula</label>
                    <textarea  class="form-control" name="txtDescricao" rows="5"><?php echo htmlspecialchars( $aula["txtDescricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                  </div>
                <!-- /.card-body -->

                <div class="card-footer col-md-12 form-group">
                  <button type="submit" class="btn btn-primary form-control">ATUALIZAR</button>
                </div>
              </form>
              <div class="col-md-2">
                <a href="/admin/aulas/<?php echo htmlspecialchars( $aula["fkTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info form-control">Voltar</a> 
              </div>
              <div class="col-md-3">
              <a href="/admin/listaPresenca/<?php echo htmlspecialchars( $aula["idAulas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info form-control">Incluir Presenças</a>
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
