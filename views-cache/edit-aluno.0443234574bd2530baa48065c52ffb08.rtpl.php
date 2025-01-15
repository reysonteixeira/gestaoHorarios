<?php if(!class_exists('Rain\Tpl')){exit;}?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro de Aluno</h1>
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
              <form method="POST" action="/admin/alunos/<?php echo htmlspecialchars( $aluno["idAlunos"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">

                  <div class="form-group col-md-5">
                    <label for="exampleInputName">Nome Completo</label>
                    <input type="text" class="form-control" id="exampleInputName" name="txtNome" value="<?php echo htmlspecialchars( $aluno["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Nome Completo">
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputDataNacimento">Data de Nacimento</label>
                    <input type="date" class="form-control" id="exampleInputDataNacimento" name="dtDataNacimento" value="<?php echo htmlspecialchars( $aluno["dtDataNascimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" >
                  </div>

                  <div class="form-group col-md-5">
                    <label for="exampleInputNameMom">Nome da Mãe</label>
                    <input type="text" class="form-control" id="exampleInputNameMom" name="txtNomeMae" value="<?php echo htmlspecialchars( $aluno["txtNomeMae"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  placeholder="Nome da Mãe">
                  </div>

                  <div class="form-group col-md-5">
                    <label for="exampleInputNameDad">Nome do Pai</label>
                    <input type="text" class="form-control" id="exampleInputNameDad" name="txtNomePai" value="<?php echo htmlspecialchars( $aluno["txtNomePai"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Nome do Pai">
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputTelefone">Telefone</label>
                    <input type="tel" class="form-control" id="exampleInputTelefone" name="txtTelefone" value="<?php echo htmlspecialchars( $aluno["txtTelefoneResponsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>

                  <div class="form-group col-md-5">
                    <label for="exampleInputTurmaAtual">Turma Atual</label>
            
                    <select name="intTurmaAtual" class="form-control">
                      <option value="">Selecione</option>
                      <?php $counter1=-1;  if( isset($turmas) && ( is_array($turmas) || $turmas instanceof Traversable ) && sizeof($turmas) ) foreach( $turmas as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo htmlspecialchars( $value1["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $value1["idTurma"] == $aluno["intTurmaAtual"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["nomeEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["nomeTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>

                  </select>
                  
                  </div>

                  <div class="form-group col-md-1">
                    <label for="exampleInputRg">RG</label>
                    <input type="text" class="form-control" id="exampleInputRg" name="txtRg" value="<?php echo htmlspecialchars( $aluno["txtRg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="RG">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputRua">Logradouro</label>
                    <input type="text" class="form-control" id="exampleInputRua" name="txtRua" value="<?php echo htmlspecialchars( $aluno["txtRua"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Rua">
                  </div>

                  <div class="form-group col-md-1">
                    <label for="exampleInputNumeroCasa">Nº</label>
                    <input type="text" class="form-control" id="exampleInputNumeroCasa" name="intNumeroCasa" value="<?php echo htmlspecialchars( $aluno["intNumeroCasa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Numero">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputBairro">Bairro</label>
                    <input type="text" class="form-control" id="exampleInputBairro" name="txtBairro" value="<?php echo htmlspecialchars( $aluno["txtBairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Bairro">
                  </div>
              
                </div>
                <!-- /.card-body -->

                <div class="card-footer col-md-12 form-group">
                  <button type="submit" class="btn btn-primary form-control">ATUALIZAR</button>
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
