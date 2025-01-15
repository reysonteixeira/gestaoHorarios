<?php if(!class_exists('Rain\Tpl')){exit;}?>
<!-- Content Wrapper. Contains page content -->
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
        <div class="card-body row col-sm-12">
  
          <div class="col-sm-1 no-print">
            <a href="/admin/supervisionarTurmas/escolas/<?php echo htmlspecialchars( $escola["idEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/turma/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>/professor/<?php echo htmlspecialchars( $professor["idServidores"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success form-control">Voltar</a>
          </div>
        
  
          <div class="col-sm-6 no-print">
            <form action="/admin/supervisionarTurmas/escolas/<?php echo htmlspecialchars( $escola["idEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/turma/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>/professor/<?php echo htmlspecialchars( $professor["idServidores"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/consolidadoConteudo" method="get" class="row">
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

        <div class="col-sm-2 no-print">
            <button class="btn btn-info form-control" onclick="window.print()">Imprimir</button>
          </div> 
        
  
          <?php if( $aulas ){ ?>
          <div class="cabecalho">
            <h5>Consolidado de Conteúdo Lecionado por Bimestre</h5>
            <p class="escola"><?php echo htmlspecialchars( $escola["nomeEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="escola mb-20"><?php echo htmlspecialchars( $escola["txtEndereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $escola["txtCidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $escola["txtEstado"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - Telefone: <?php echo htmlspecialchars( $escola["txtTelefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <div class="row">
                <div class="col-5">
                    <span><b>Professor(a): </b><?php echo htmlspecialchars( $professor["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span> <br>
                    <span><b>Tipo de Ensino: </b>ENSINO FUNDAMENTAL</span>

                    
                </div>
              
                <div class="col-3">
                    <span><b>Ano/Série/Etapa: </b><?php echo htmlspecialchars( $infoTurma["txtEtapa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><br>
                    <span><b>Turma: </b><?php echo htmlspecialchars( $infoTurma["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                </div>

                
                <div class="col-3">
                    <span><b>Turno: </b><?php echo htmlspecialchars( $infoTurma["txtTurno"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><br>
                    <span><b>Bimestre: </b><?php echo htmlspecialchars( $bimestre["nomeBimestre"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                </div>
            </div>
          </div>
          <div class="title">
            <p>CONTEÚDO LECIONADO</p>
        </div>
          <table class="table1">
           
            <thead>
               
              <tr>
                <th class="data center">Data</th>
                <th>CONTEÚDO</th>
                
              </tr>
            </thead>
            <tbody>
              <?php $counter1=-1;  if( isset($aulas) && ( is_array($aulas) || $aulas instanceof Traversable ) && sizeof($aulas) ) foreach( $aulas as $key1 => $value1 ){ $counter1++; ?>
  
              <tr>
                <td class="center data"><?php echo date('d/m/Y', strtotime($value1["dtData"])); ?></td>
  
                <td><?php echo htmlspecialchars( $value1["txtDescricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              
              </tr>
  
  
              <?php } ?>
  
  
  
            </tbody>
          </table> 
          <br/><br/>
          <div class="rodape row col-12">
           
                <div class="col-12 line">
                    <span>Obs.: </span>
                </div>
                <div class="col-3 line d-center">
                    <p>Encerrado em:</p>
                    <p>___/___/_____</p>
                </div>

                <div class="col-9 line d-end">
                    
                    <p>Assinatura</p>
                </div>
          
            

          </div>
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