<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro Turmas</h1>
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
              <form method="POST" action="/admin/turmas/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">

                  <div class="form-group col-md-4">
                    <label for="exampleInputName">Nome</label>
                    <input type="text" class="form-control" disabled value="<?php echo htmlspecialchars( $turma["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" id="exampleInputName" name="txtNome" placeholder=" Nome">
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputAnoTurma">Ano da turma</label>
                    <input type="text" class="form-control" disabled value="<?php echo htmlspecialchars( $turma["txtAnoTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  id="exampleInputAnoTurma" name="txtAnoTurma" placeholder="Ano">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputAnoTurma">Escola</label>
                    <select name="fkEscola" disabled class="form-control">
                      <?php $counter1=-1;  if( isset($escolas) && ( is_array($escolas) || $escolas instanceof Traversable ) && sizeof($escolas) ) foreach( $escolas as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["idEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $value1["idEscola"] == $turma["fkEscola"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>


                  
                    
                  </div>
                  
                  <?php if( $permissaoMenu < 3 ){ ?>
                  <div class="col-md-2"><label for=""></label>
                    <input type="submit" value="ENVIAR" class="btn btn-success form-control" style="margin-bottom: 0;">
                  </div>
                  <?php } ?>
                </div>
                <!-- /.card-body -->

                <div class="card-footer col-md-12 row">
              
                  <div class="col-1">
                    <a href="/admin/supervisionarTurmas/escolas/<?php echo htmlspecialchars( $escola, ENT_COMPAT, 'UTF-8', FALSE ); ?>/turma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success form-control">Voltar</a>
                  </div>
                 
                  
                
                  <div class="col-2">
                    <a href="/admin/supervisionarTurmas/escolas/<?php echo htmlspecialchars( $escola, ENT_COMPAT, 'UTF-8', FALSE ); ?>/turma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/professor/<?php echo htmlspecialchars( $professor, ENT_COMPAT, 'UTF-8', FALSE ); ?>/avaliacoes" class="btn btn-info form-control">Atividades</a>
                  </div>
                  
                
                  <div class="col-2">
                    <a href="/admin/supervisionarTurmas/escolas/<?php echo htmlspecialchars( $escola, ENT_COMPAT, 'UTF-8', FALSE ); ?>/turma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/professor/<?php echo htmlspecialchars( $professor, ENT_COMPAT, 'UTF-8', FALSE ); ?>/aulas" class="btn btn-info form-control">Aulas</a>
                  </div>


              
                </div>
              </form>
            </div>

            <!-- /.card -->

         

       

          </div>

        

          <div class="col-md-12">
            <h2>Alunos</h2>
            <table class="table mt-3">
              <thead>
                <tr>
                  <th >Aluno</th>
                  <th scope="col">Data de Nascimento</th>
                 
                  <th>Nome da Mãe</th>
                  <th>Telefone do Responsável</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($alunos) && ( is_array($alunos) || $alunos instanceof Traversable ) && sizeof($alunos) ) foreach( $alunos as $key1 => $value1 ){ $counter1++; ?>
             
                <tr>
                  <td><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["dtDataNascimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["txtNomeMae"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["txtTelefoneResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><a href="/admin/notas/turma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/aluno/<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info">Notas</a></td>
              <td><a href="/admin/presencas/turma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/aluno/<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info">Presenças</a></td>
                </tr>
               
                <?php } ?>
               

        
              </tbody>
            </table>
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
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

