<?php if(!class_exists('Rain\Tpl')){exit;}?> <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Presenças</h1>
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
            <div class="col-md-2">
                <a href="/admin/aulas/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success">Voltar</a> 
            </div>

            <div class="col-md-6 row">
            <div class="col-sm-12">
              
              <form action="/admin/listaPresenca/turma/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="row">
                <div class="col-md-4 form-group">
                  <label for="">Bimestres</label>
                  <select name="bimestres" id="" class="form-control">
                    <?php $counter1=-1;  if( isset($bimestres) && ( is_array($bimestres) || $bimestres instanceof Traversable ) && sizeof($bimestres) ) foreach( $bimestres as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["idBimestre"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" 
                      <?php if( $bimestreSelecionado == $value1["idBimestre"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["nomeBimestre"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    <?php } ?>
                  </select>
                  
                </div>
            
                <div class="form-group col-4">
                  <label for=""></label>
                  <input type="submit" class="form-control btn btn-primary" value="Filtrar">
                </div>
              </form>
            </div>
          </div>


        

            <?php if( $presencas ){ ?>
            <div class="table-responsive">
            <table class="table mt-3">
              <thead>
                <tr>
                  <?php $counter1=-1;  if( isset($cabecalho) && ( is_array($cabecalho) || $cabecalho instanceof Traversable ) && sizeof($cabecalho) ) foreach( $cabecalho as $key1 => $value1 ){ $counter1++; ?>
                  
                  <th scope="col"><?php echo htmlspecialchars( $value1, ENT_COMPAT, 'UTF-8', FALSE ); ?></th>
                 
                  <?php } ?>
                  <th>Faltas</th>
                  <th>Frequencia</th>
                </tr>
              </thead>
              <tbody>
             
                <?php $counter1=-1;  if( isset($presencas) && ( is_array($presencas) || $presencas instanceof Traversable ) && sizeof($presencas) ) foreach( $presencas as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <?php $counter2=-1;  if( isset($value1) && ( is_array($value1) || $value1 instanceof Traversable ) && sizeof($value1) ) foreach( $value1 as $key2 => $value2 ){ $counter2++; ?>
                  <td><?php echo htmlspecialchars( $value2, ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <?php } ?>
                </tr>
                <?php } ?>
        
              </tbody>
            </table>
          
          </div>
          <?php }else{ ?>
            <div class="col-12">
              <br>
              <h1>Não foram aulas cadastradas no período pesquisado!</h1>
            </div>
          <?php } ?>
         
            
          <!-- ./col -->
        </div>
 
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->