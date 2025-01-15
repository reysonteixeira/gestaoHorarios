<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro Turma</h1>
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
              <form method="POST" action="/admin/cadastrar-turmas">
                <div class="card-body row">

                  <div class="form-group col-md-5">
                    <label for="exampleInputName">Nome</label>
                    <input type="text" class="form-control" id="exampleInputName" name="txtNome" placeholder=" Nome">
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputAnoTurma">Ano da turma</label>
                    <input type="text" class="form-control" id="exampleInputAnoTurma" name="txtAnoTurma" placeholder="Ano">
                  </div>
                  <div class="form-group col-md-5">
                    <label for="exampleInputAnoTurma">Escola</label>
                    <select name="fkEscola" id=" " class="form-control">
                      <?php $counter1=-1;  if( isset($escolas) && ( is_array($escolas) || $escolas instanceof Traversable ) && sizeof($escolas) ) foreach( $escolas as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["idEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputAnoTurma">Etapa</label>
                    <select name="txtEtapa" id=" " class="form-control">
                  
                      <option value="1º Período">1º Período</option>
                      <option value="2º Período">2º Período</option>      
                      <option value="1º ANO">1º ANO</option>
                      <option value="2º ANO">2º ANO</option>                     
                      <option value="3º ANO">3º ANO</option>
                      <option value="4º ANO">4º ANO</option>
                      <option value="5º ANO">5º ANO</option>
                      <option value="6º ANO">6º ANO</option>
                      <option value="7º ANO">7º ANO</option>
                      <option value="8º ANO">8º ANO</option>
                      <option value="9º ANO">9º ANO</option>

                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="exampleInputAnoTurma">Turno</label>
                    <select name="txtTurno" id=" " class="form-control">
                      <option value="Manhã">Manhã</option>
                      <option value="Tarde">Tarde</option>
                      <option value="Noite">Noite</option>
                    </select>
                  </div>



                  <div class="form-group col-md-3">
                    <label for="exampleInputAnoTurma">Nível de Ensino</label>
                    <select name="txtNivelEnsino" id=" " class="form-control">
                  
                      <option value="Educação Infantil">Educação Infantil</option>
                      <option value="Ensino Fundamental I">Ensino Fundamental I</option>      
                    
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputAnoTurma">Ensino</label>
                    <select name="txtEnsino" id=" " class="form-control">
                  
                      <option value="1">Regular</option>
                      <option value="2">Integral</option>      
                    
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer col-md-12 form-group">
                  <button type="submit" class="btn btn-primary form-control">Cadastrar</button>
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

