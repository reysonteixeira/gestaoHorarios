<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <!-- /.content-header -->

  <!-- Main content -->
  <section>
    <div class="container-fluid">


      <!-- /.card-body -->
      <div class="card-body row col-sm-12 d-flex align-items-end">

        <div class="col-sm-1">
          <a href="/admin/turmas/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success form-control">Voltar</a>
        </div>
        <br><br>
        <div class="titulo col-12">
          <span style="font-size: 26px; font-weight: bold; margin-top: 10px;"><?php echo htmlspecialchars( $aluno["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
        </div>

    
        <?php $counter1=-1;  if( isset($bimestresFinalizados) && ( is_array($bimestresFinalizados) || $bimestresFinalizados instanceof Traversable ) && sizeof($bimestresFinalizados) ) foreach( $bimestresFinalizados as $key1 => $value1 ){ $counter1++; ?>
          <div class="col-12" style="margin-top: 30px;">
            <?php $counter2=-1;  if( isset($value1) && ( is_array($value1) || $value1 instanceof Traversable ) && sizeof($value1) ) foreach( $value1 as $key2 => $value2 ){ $counter2++; ?>
            <?php if( $counter2 == 0 ){ ?>
              <h4><?php echo htmlspecialchars( $value2, ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
              <?php }else{ ?>
              <span><?php echo htmlspecialchars( $value2, ENT_COMPAT, 'UTF-8', FALSE ); ?></span><br>
            <?php } ?>

            <?php } ?>
          </div>
        <?php } ?>

        <?php if( $bimestreAtual ){ ?>
        <div class="col-12" style="margin-top: 30px;">
        <h4>Bimestre Atual</h4>
        <?php $counter1=-1;  if( isset($bimestreAtual) && ( is_array($bimestreAtual) || $bimestreAtual instanceof Traversable ) && sizeof($bimestreAtual) ) foreach( $bimestreAtual as $key1 => $value1 ){ $counter1++; ?>
        
          <?php $counter2=-1;  if( isset($value1) && ( is_array($value1) || $value1 instanceof Traversable ) && sizeof($value1) ) foreach( $value1 as $key2 => $value2 ){ $counter2++; ?>
            <span><?php echo htmlspecialchars( $value2, ENT_COMPAT, 'UTF-8', FALSE ); ?></span><br>
          <?php } ?>
        </div>
      <?php } ?>
        <?php } ?>
        <!-- ./col -->
      </div>

    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->