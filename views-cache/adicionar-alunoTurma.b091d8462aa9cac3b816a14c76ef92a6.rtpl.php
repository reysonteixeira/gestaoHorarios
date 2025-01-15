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
                <form action="/admin/adicionarAlunosTurma/<?php echo htmlspecialchars( $turma["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                  <div class="card-body row">
  
  
  
                    <div class="form-group col-md-7">
                        <label for="">Aluno</label>
                        <select name="aluno" id="" class="form-control">
                            <?php $counter1=-1;  if( isset($alunos) && ( is_array($alunos) || $alunos instanceof Traversable ) && sizeof($alunos) ) foreach( $alunos as $key1 => $value1 ){ $counter1++; ?>
                                <option value="<?php echo htmlspecialchars( $value1["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                            <?php } ?>
                           
                        </select>
                      
                    </div>

                    <div class="form-group col-md-4">
                        <label for="">Data de Início</label>
                        <input type="date" class="form-control" name="dtDataInicio" id="">
                      
                    </div>
                  </div>

                  <!-- /.card-body -->
  
                  <div class="card-footer col-md-12 form-group">
                    <button type="submit" class="btn btn-primary form-control">Adicionar novo aluno</button>
                  </div>
               </form>
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
  
  