<?php if(!class_exists('Rain\Tpl')){exit;}?> <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Presença Aula</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section>
      <div class="container-fluid">
        
        
          <!-- /.card-body -->
          <div class="card-body row col-sm-12 d-flex align-items-end">
            <!-- <div class="busca col-sm-10">
              <form action="/admin/produtos" class="form d-flex align-items-end">
                <div class="form-group">
                  <label>Busca</label>
                  <input type="text" name="busca" class="form-control">
                </div>
                <div>
                <input type="submit" value="Buscar" class="btn btn-primary">
              </div>
              </form>
            </div> -->
         


        
            <table class="table mt-3">
              <form action="/admin/listaPresenca/<?php echo htmlspecialchars( $id, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="POST">
              <thead>
                <tr>
                  <th scope="col">Aluno</th>
                  <th scope="col"></th>
                 
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($presencas) && ( is_array($presencas) || $presencas instanceof Traversable ) && sizeof($presencas) ) foreach( $presencas as $key1 => $value1 ){ $counter1++; ?>
             
                <tr>
                  <td><label for="<?php echo htmlspecialchars( $value1["fkAluno"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"> <?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label></td>
                  <td><label class="switch">
                    <input type="checkbox" name="cbPresenca[]" id="<?php echo htmlspecialchars( $value1["fkAluno"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["fkAluno"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $value1["boolPresenca"] ){ ?>checked<?php } ?>>
                    <span class="slider round"></span>
                  </label></td>
                 <td></td>
                 <td></td>
                </tr>
               
                <?php } ?>
               

        
              </tbody>
              <div class="col-md-1">
                <a href="/admin/editar-aulas/<?php echo htmlspecialchars( $id, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info">Voltar</a>
              </div>
              

              
              
            
            </table>
          
          
          <!-- ./col -->
        </div>
        <div class="col-12">
          <input type="submit" value="ENVIAR" class="btn btn-success form-control">
        </div>
      </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->