<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Aulas Cadastradas</h1>
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

        <div class="col-sm-1">
          <a href="/admin/turmas/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success form-control">Voltar</a>
        </div>
        <div class="col-sm-2">
          <a href="/admin/cadastrar-aulas/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success form-control">Cadastrar Aulas</a>
        </div>

        <div class="col-sm-2">
          <a href="/admin/listaPresenca/turma/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success form-control">Presenças</a>
        </div>

        <div class="col-sm-6">
          <form action="/admin/aulas/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="get" class="row">
            <div class="col-md-4 form-group">
              <label for="">Bimestres</label>
              <select name="bimestres" id="" class="form-control">
                <?php $counter1=-1;  if( isset($bimestres) && ( is_array($bimestres) || $bimestres instanceof Traversable ) && sizeof($bimestres) ) foreach( $bimestres as $key1 => $value1 ){ $counter1++; ?>
                  <option value="<?php echo htmlspecialchars( $value1["idBimestre"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" 
                  <?php if( $bimestreSelecionado == $value1["idBimestre"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["nomeBimestre"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>
              </select>
              
            </div>
           
            <div class="col-md-3 form-group">
              <label for=""></label>
              <input type="submit" class="form-control btn btn-info" value="FILTRAR">
            </div>
          </form>
      </div>

        <?php if( $aulas ){ ?>

        <table class="table mt-3">
          <thead>
            <tr>
              <th scope="col">Data da Aula</th>

              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $counter1=-1;  if( isset($aulas) && ( is_array($aulas) || $aulas instanceof Traversable ) && sizeof($aulas) ) foreach( $aulas as $key1 => $value1 ){ $counter1++; ?>

            <tr>
              <td><?php echo date('d/m/Y', strtotime($value1["dtData"])); ?></td>

              <td class="botao"><a href="/admin/listaPresenca/<?php echo htmlspecialchars( $value1["idAulas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button
                    class="btn btn-success btn-sm">Controle de Presenças <i class="fas fa-check"></i></button></a></td>
              <td class="botao"><a href="/admin/editar-aulas/<?php echo htmlspecialchars( $value1["idAulas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button
                    class="btn btn-primary btn-sm">Acessar <i class="fas fa-edit"></i></button></a></td>
              <td class="botao"><a href="/admin/deletar-aula/<?php echo htmlspecialchars( $value1["idAulas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button
                    class="btn btn-danger btn-sm">Deletar <i class="fas fa-trash"></i></button></a></td>
            </tr>


            <?php } ?>



          </tbody>
        </table>
        <?php }else{ ?>
        <div class="col-12">
          <br>
          <h1>Não foram encontradas aulas cadastradas!</h1>
        </div>

        <?php } ?>

        <!-- ./col -->
      </div>

    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->