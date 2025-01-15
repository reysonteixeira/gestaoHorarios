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
              <form method="POST" action="/admin/cadastrar-aulas/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">
                  <div class="form-group col-md-3">
                    <label for="exampleInputPostagem">Data da Aula</label>
                    <input type="date" class="form-control" id="exampleInputPostagem" name="dtDataAula">
                  </div>



                  <div class="form-group col-md-12">
                    <label for="exampleInputDescricao">Descrição da aula</label>
                    <textarea  class="form-control" name="txtDescricao" rows="5"></textarea>
                  </div>
                <!-- /.card-body -->
                <div class="col-12">
                  <h6>Inserir em mais turmas</h6>
                  <?php $counter1=-1;  if( isset($listaTurmas) && ( is_array($listaTurmas) || $listaTurmas instanceof Traversable ) && sizeof($listaTurmas) ) foreach( $listaTurmas as $key1 => $value1 ){ $counter1++; ?> 
                    <input type="checkbox" name="maisTurmas[]" id="<?php echo htmlspecialchars( $value1["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"> <label for="<?php echo htmlspecialchars( $value1["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label> <br>
                  <?php } ?>
                </div>
                <div class="card-footer col-md-12 form-group">
                  <button type="submit" class="btn btn-primary form-control">CADASTRAR</button>
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
