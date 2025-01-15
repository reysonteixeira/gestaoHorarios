<?php if(!class_exists('Rain\Tpl')){exit;}?> <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Atribuir Nota</h1>
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
            <table class="table mt-3">
              <form >
                <input type="hidden" name="turma" value="<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <input type="hidden" name="alunos" value="<?php echo htmlspecialchars( $alunos, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <thead>
                <tr>
                  <th scope="col">Aluno</th>
                  <th scope="col"></th>
                 
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($notas) && ( is_array($notas) || $notas instanceof Traversable ) && sizeof($notas) ) foreach( $notas as $key1 => $value1 ){ $counter1++; ?>
                
                <tr>
                  <td><label> <?php echo htmlspecialchars( $value1["nomeAluno"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label></td>
                  <?php if( $disciplina["intTipoAvaliacao"] == 1 ){ ?>
                  <td><div class="row"><div class="col-3">
                    <input type="number" disabled class="form-control" pattern="[0-9]+([,\.][0-9]+)?" step="any" style="width: 100px" min="0" max="<?php echo htmlspecialchars( $value1["notaProva"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["nota"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="notas[]" id="">
                  </div></div></td>
                  <?php }else{ ?>
                  <td><div class="row"><div class="col-3">
                    <select name="conceitos:<?php echo htmlspecialchars( $value1["idAluno"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled class="form-control" style="width: 300px;" id="">
                      <option value="1"  <?php if( $value1["conceito"] == 1 ){ ?>selected<?php } ?>>Atingiu os objetivos</option>
                      <option value="2" <?php if( $value1["conceito"] == 2 ){ ?>selected<?php } ?>>Atingiu parcialmente os objetivos</option>
                      <option value="3" <?php if( $value1["conceito"] == 3 ){ ?>selected<?php } ?>>Não atingiu os objetivos</option>
                    </select>
                  </div></div></td>
                  <?php } ?>
                 <td></td>
                 <td></td>
                </tr>
               
                <?php } ?>
               

        
              </tbody>
              <div class="col-md-1">
                <a href="/admin/supervisionarTurmas/escolas/<?php echo htmlspecialchars( $escola, ENT_COMPAT, 'UTF-8', FALSE ); ?>/turma/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>/professor/<?php echo htmlspecialchars( $professor, ENT_COMPAT, 'UTF-8', FALSE ); ?>/avaliacoes" class="btn btn-info">Voltar</a>
              </div>
              

              
              
            
            </table>
          
          
          <!-- ./col -->
        </div>
       
      </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->