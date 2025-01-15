<?php if(!class_exists('Rain\Tpl')){exit;}?> <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Supervisionar - Escolas</h1>
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
      

            <?php if( $escolaSupervisor ){ ?>
            <table class="table mt-3">
              <thead>
                <tr>
                  <th scope="col">Escola</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($escolaSupervisor) && ( is_array($escolaSupervisor) || $escolaSupervisor instanceof Traversable ) && sizeof($escolaSupervisor) ) foreach( $escolaSupervisor as $key1 => $value1 ){ $counter1++; ?>
             
                <tr>
                  <td><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td></td>
                  <td></td>
                  <td class="botao"><a href="/admin/supervisionarTurmas/escolas/<?php echo htmlspecialchars( $value1["fkEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button class="btn btn-primary btn-sm">Acessar <i class="fas fa-edit"></i></button></a></td>
                </tr>
               
                <?php } ?>
               

        
              </tbody>
            </table>
            <?php }else{ ?>
            <div class="col-12">
              <br>
              <h1>Não foram encontrados servidores cadastrados!</h1>
            </div>
          
            <?php } ?>
            
          <!-- ./col -->
        </div>
 
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->