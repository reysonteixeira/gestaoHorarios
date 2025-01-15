<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Atividade Avaliativa</h1>
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
                <input type="hidden" name="fkTurma" value="<?php echo htmlspecialchars( $avaliacao["fkTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">
                  <div class="form-group col-md-3">
                    <label for="exampleInputPostagem">Nome Atividade</label>
                    <input type="text" class="form-control" disabled value="<?php echo htmlspecialchars( $avaliacao["txtNomeAvaliacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" id="exampleInputPostagem" name="txtNomeAvaliacao">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputPostagem">Disciplina</label>
                    <select name="fkDisciplina" id="" disabled class="form-control">
                      <option value="">SELECIONE</option>
                      <?php $counter1=-1;  if( isset($disciplinas) && ( is_array($disciplinas) || $disciplinas instanceof Traversable ) && sizeof($disciplinas) ) foreach( $disciplinas as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["idDisciplina"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $value1["idDisciplina"] == $avaliacao["fkDisciplina"] ){ ?>selected<?php } ?>>
                        <?php echo htmlspecialchars( $value1["txtNomeDisciplina"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                      
                    </select>
                   
                  </div>
                  <div class="form-group col-md-2">
                    <label for="exampleInputPostagem">Data da Atividade</label>
                    <input type="date" disabled value="<?php echo htmlspecialchars( $avaliacao["dtData"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" id="exampleInputPostagem" name="dtDataAvaliacao">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="exampleInputPostagem">Valor</label>
                    <input type="text" disabled value="<?php echo htmlspecialchars( $avaliacao["intPontos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" name="intPontos">
                  </div>

                  <div class="form-group col-md-12">
                    <label for="exampleInputDescricao">Decrição da atividade</label>
                    <textarea disabled class="form-control" name="txtDescricao" rows="3"><?php echo htmlspecialchars( $avaliacao["txtDescription"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
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
