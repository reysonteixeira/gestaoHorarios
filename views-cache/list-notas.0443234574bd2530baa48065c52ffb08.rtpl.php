<?php if(!class_exists('Rain\Tpl')){exit;}?> <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Notas</h1>
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
                <a href="/admin/avaliacoes/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success">Voltar</a> 
            </div>

            <div class="col-sm-6">
              <form action="/admin/listaNotas/turma/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="get" class="row">
                <div class="col-md-4 form-group">
                  <label for="">Bimestres</label>
                  <select name="bimestres" id="" class="form-control">
                    <?php $counter1=-1;  if( isset($bimestres) && ( is_array($bimestres) || $bimestres instanceof Traversable ) && sizeof($bimestres) ) foreach( $bimestres as $key1 => $value1 ){ $counter1++; ?>
                      <option  <?php if( $bimestreSelecionado == $value1["idBimestre"] ){ ?>selected<?php } ?> value="<?php echo htmlspecialchars( $value1["idBimestre"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" 
                    ><?php echo htmlspecialchars( $value1["nomeBimestre"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    <?php } ?>
                  </select>
                  
                </div>
                <div class="col-md-5 form-group">
                  <label for="">Disciplina</label>
                  <select name="disciplinas" id="" class="form-control">
                  
                    <option value="" <?php if( !$disciplinaSelecionada ){ ?>selected<?php } ?>>TODAS</option>
                  <?php $counter1=-1;  if( isset($disciplinas) && ( is_array($disciplinas) || $disciplinas instanceof Traversable ) && sizeof($disciplinas) ) foreach( $disciplinas as $key1 => $value1 ){ $counter1++; ?>
                  <option value="<?php echo htmlspecialchars( $value1["idDisciplina"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $disciplinaSelecionada==$value1["idDisciplina"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["txtNomeDisciplina"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="col-md-3 form-group">
                  <label for=""></label>
                  <input type="submit" class="form-control btn btn-info" value="FILTRAR">
                </div>
              </form>
          </div>

        


            <?php if( $notas ){ ?>
            <div class="table-responsive">
            <table class="table mt-3">
              <thead>
                <tr>
                  <?php $counter1=-1;  if( isset($cabecalho) && ( is_array($cabecalho) || $cabecalho instanceof Traversable ) && sizeof($cabecalho) ) foreach( $cabecalho as $key1 => $value1 ){ $counter1++; ?>
                  
                  <th scope="col"><?php echo htmlspecialchars( $value1, ENT_COMPAT, 'UTF-8', FALSE ); ?></th>
                 
                  <?php } ?>
                  <th>Total Alcançado</th>
                  <th>Total</th>
                  <th>%</th>
                </tr>
              </thead>
              <tbody>
             
                <?php $counter1=-1;  if( isset($notas) && ( is_array($notas) || $notas instanceof Traversable ) && sizeof($notas) ) foreach( $notas as $key1 => $value1 ){ $counter1++; ?>
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