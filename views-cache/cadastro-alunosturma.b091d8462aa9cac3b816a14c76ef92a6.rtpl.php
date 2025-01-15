<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro Aluno em Turma</h1>
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
              
                <div class="card-body row">

                  <table class="table mt-3">
                    <thead>
                      <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Data de Matrícula</th>
                        <th scope="col">Saída</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $counter1=-1;  if( isset($alunos) && ( is_array($alunos) || $alunos instanceof Traversable ) && sizeof($alunos) ) foreach( $alunos as $key1 => $value1 ){ $counter1++; ?>
                   
                      <tr>
                        <td><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><?php if( $value1["boolStatus"]==true ){ ?>Ativo<?php }else{ ?><?php echo htmlspecialchars( $value1["txtMotivo"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?></td>
                        <td><?php echo date('d/m/Y', strtotime($value1["dataMatricula"])); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($value1["dataSaida"])); ?></td>

                    
                        
                        <td class="botao"><a href="/admin/alunos/<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button class="btn btn-primary btn-sm">Acessar <i class="fas fa-edit"></i></button></a></td>
                        <?php if( $value1["boolStatus"]==true ){ ?>
                        <td class="botao"><a href="/admin/desligarAluno/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button class="btn btn-danger btn-sm">Desligar da Turma <i class="fas fa-trash"></i></button></a></td>
                        <td class="botao"><a href="/admin/apagarAluno/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button  onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-sm">Apagar da Turma <i class="fas fa-trash"></i></button></a></td>
                        <?php } ?>
                      </tr>
                     
                      <?php } ?>
                     
      
              
                    </tbody>
                  </table>
                


                  <!-- <div class="form-group col-md-12">
                    <select class="duallistbox" multiple="multiple" name="destaques[]">
                      <?php $counter1=-1;  if( isset($alunos) && ( is_array($alunos) || $alunos instanceof Traversable ) && sizeof($alunos) ) foreach( $alunos as $key1 => $value1 ){ $counter1++; ?>
                        
                        <?php if( $value1["fkTurma"]==$turma["idTurma"] ){ ?>
                        <option value="<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected>
                          <?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </option>
                        <?php }else{ ?>
                        <option value="<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                          <?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </option>
                        <?php } ?>
                      <?php } ?>
                      
                    
                    </select>
                   
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer col-md-12 form-group">
                  <a href="/admin/adicionarAlunosTurma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button class="btn btn-primary form-control">Adicionar novo aluno</button></a>
                </div>
             
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
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

