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
                    <input type="text" class="form-control"  <?php if( $permissaoMenu == 3 ){ ?>disabled<?php } ?> value="<?php echo htmlspecialchars( $turma["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" id="exampleInputName" name="txtNome" placeholder=" Nome">
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputAnoTurma">Ano da turma</label>
                    <input type="text" class="form-control" <?php if( $permissaoMenu == 3 ){ ?>disabled<?php } ?> value="<?php echo htmlspecialchars( $turma["txtAnoTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  id="exampleInputAnoTurma" name="txtAnoTurma" placeholder="Ano">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputAnoTurma">Escola</label>
                    <select name="fkEscola" <?php if( $permissaoMenu == 3 ){ ?>disabled<?php } ?> class="form-control">
                      <?php $counter1=-1;  if( isset($escolas) && ( is_array($escolas) || $escolas instanceof Traversable ) && sizeof($escolas) ) foreach( $escolas as $key1 => $value1 ){ $counter1++; ?>

                      <option value="<?php echo htmlspecialchars( $value1["idEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $value1["idEscola"] == $turma["fkEscola"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>

                    </select>


                  
                    
                  </div>
                 
                  
                  <div class="form-group col-md-2">
                    <label for="exampleInputAnoTurma">Turno</label>
                    <select name="txtTurno" id=" " <?php if( $permissaoMenu == 3 ){ ?>disabled<?php } ?> class="form-control">
                      <option value="Manhã" <?php if( $turma["txtTurno"] == 'Manhã' ){ ?>selected<?php } ?>>Manhã</option>
                      <option value="Tarde" <?php if( $turma["txtTurno"] == 'Tarde' ){ ?>selected<?php } ?>>Tarde</option>
                      <option value="Noite" <?php if( $turma["txtTurno"] == 'Noite' ){ ?>selected<?php } ?>>Noite</option>
                    </select>

                  
                    
                  </div>

                    
             
                  <div class="form-group col-md-2">
                    <label for="exampleInputAnoTurma">Etapa</label>
                    <select name="txtEtapa" id=" " <?php if( $permissaoMenu == 3 ){ ?>disabled<?php } ?> class="form-control">
                  
                      <option value="1º Período" <?php if( $turma["txtEtapa"] == '1º Período' ){ ?>selected<?php } ?>>1º Período</option>
                      <option value="2º Período" <?php if( $turma["txtEtapa"] == '2º Período' ){ ?>selected<?php } ?>>2º Período</option>      
                      <option value="1º ANO" <?php if( $turma["txtEtapa"] == '1º ANO' ){ ?>selected<?php } ?>>1º ANO</option>
                      <option value="2º ANO" <?php if( $turma["txtEtapa"] == '2º ANO' ){ ?>selected<?php } ?>>2º ANO</option>                     
                      <option value="3º ANO" <?php if( $turma["txtEtapa"] == '3º ANO' ){ ?>selected<?php } ?>>3º ANO</option>
                      <option value="4º ANO" <?php if( $turma["txtEtapa"] == '4º ANO' ){ ?>selected<?php } ?>>4º ANO</option>
                      <option value="5º ANO" <?php if( $turma["txtEtapa"] == '5º ANO' ){ ?>selected<?php } ?>>5º ANO</option>
                      <option value="6º ANO" <?php if( $turma["txtEtapa"] == '6º ANO' ){ ?>selected<?php } ?>>6º ANO</option>
                      <option value="7º ANO" <?php if( $turma["txtEtapa"] == '7º ANO' ){ ?>selected<?php } ?>>7º ANO</option>
                      <option value="8º ANO" <?php if( $turma["txtEtapa"] == '8º ANO' ){ ?>selected<?php } ?>>8º ANO</option>
                      <option value="9º ANO" <?php if( $turma["txtEtapa"] == '9º ANO' ){ ?>selected<?php } ?>>9º ANO</option>

                    </select>
                  </div>
                  
                  <div class="form-group col-md-3">
                    <label for="exampleInputAnoTurma">Nível de Ensino</label>
                    <select name="txtNivelEnsino" id=" " <?php if( $permissaoMenu == 3 ){ ?>disabled<?php } ?> class="form-control">
                  
                      <option value="Educação Infantil" <?php if( $turma["txtNivelEnsino"] == 'Educação Infantil' ){ ?>selected<?php } ?>>Educação Infantil</option>
                      <option value="Ensino Fundamental I" <?php if( $turma["txtNivelEnsino"] == 'Ensino Fundamental I' ){ ?>selected<?php } ?>>Ensino Fundamental I</option>      
                    
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputAnoTurma">Ensino</label>
                    <select name="txtEnsino" id=" " <?php if( $permissaoMenu == 3 ){ ?>disabled<?php } ?> class="form-control">
                  
                      <option value="1" <?php if( $turma["txtEnsino"] == '1' ){ ?>selected<?php } ?>>Regular</option>
                      <option value="2" <?php if( $turma["txtEnsino"] == '2' ){ ?>selected<?php } ?>>Integral</option>      
                    
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputAnoTurma">Professor Responsável</label>
                    <select name="professorResponsavel" id=" " <?php if( $permissaoMenu == 3 ){ ?>disabled<?php } ?> class="form-control">
                      <option>SELECIONE</option>
                      <?php $counter1=-1;  if( isset($professores) && ( is_array($professores) || $professores instanceof Traversable ) && sizeof($professores) ) foreach( $professores as $key1 => $value1 ){ $counter1++; ?>

                      <option value="<?php echo htmlspecialchars( $value1["idServidores"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $value1["idServidores"] == $turma["professorRegente"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
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
                    <a href="/admin/turmas" class="btn btn-success form-control">Voltar</a>
                  </div>
                  <?php if( $permissao< 3 ){ ?>

                  <div class="col-2">
                    <a href="/admin/professoresturma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info form-control">Professores</a>
                  </div>
                  <?php } ?>

                  <?php if( $permissao< 3 ){ ?>

                  <div class="col-1">
                    <a href="/admin/alunosturma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info form-control">Alunos</a>
                  </div>
                  <?php } ?>

                
                  <div class="col-2">
                    <a href="/admin/avaliacoes/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info form-control">Atividades</a>
                  </div>
                  

                  <?php if( $permissao< 3 ){ ?>

                  <div class="col-2">
                    <a href="/admin/cadastroDisciplinasTurma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info form-control">Disciplinas</a>
                  </div>
                  <?php } ?>


                     <?php if( $permissao< 3 ){ ?>

                  <div class="col-2">
                    <a href="/admin/fichaIndividualAluno/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info form-control">Ficha Individual</a>
                  </div>
                  <?php } ?>

                
                  <div class="col-2">
                    <a href="/admin/aulas/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info form-control">Aulas</a>
                  </div>

                  <?php if( $permissao == 3 ){ ?>

                  <div class="col-3">
                    <a href="/admin/consolidado-aulas/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info form-control">Consolidado de conteúdo</a>
                  </div>
                  <?php } ?>


                 




              
                </div>
              </form>
            </div>

            <!-- /.card -->

         

       

          </div>

        

          <div class="col-md-12">
            <div style="display: flex; justify-content: space-between;">

              <h2>Alunos</h2>

              <?php if( $permissao < 3 ){ ?>

              <div class="col-3">
                <a href="/admin/folhaRosto/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-info form-control">Folha de rosto</a>
              </div>
              <?php } ?>

            </div>
            
          
            
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
                  <td><?php echo date('d/m/Y', strtotime($value1["dtDataNascimento"])); ?></td>
                  <td><?php echo htmlspecialchars( $value1["txtNomeMae"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["txtTelefoneResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><a <?php if( $permissao != 2 ){ ?>href="/admin/notas/aluno/<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"<?php }else{ ?>

                        href="/admin/notas/turma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/aluno/<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                      <?php } ?>

                     class="btn btn-info">Notas</a></td>
                  <td><?php if( $permissao !=2 ){ ?><a href="/admin/presencas/aluno/<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"<?php }else{ ?>

                    <a href="/admin/presencas/turma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/aluno/<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                    <?php } ?>

                    class="btn btn-info">Presenças</a></td>
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

