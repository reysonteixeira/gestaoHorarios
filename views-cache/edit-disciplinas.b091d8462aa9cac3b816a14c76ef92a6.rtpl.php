<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Disciplinas</h1>
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
              <form method="POST" action="/admin/disciplinas/<?php echo htmlspecialchars( $disciplina["idDisciplina"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">


                  <div class="form-group col-md-5">
                    <label for="exampleInputName">Nome da Disciplina</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars( $disciplina["txtNomeDisciplina"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  id="exampleInputName" name="txtNomeDisciplinas" placeholder=" Nome">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputName">Método de Avaliação</label>
                    <select name="intTipoAvaliacao" class="form-control" id="">
                      <option value="1" <?php if( $disciplina["intTipoAvaliacao"]==1 ){ ?>selected<?php } ?>>Pontos</option>
                      <option value="3" <?php if( $disciplina["intTipoAvaliacao"]==3 ){ ?>selected<?php } ?>>Conceitos (Correspondente aos pontos)</option>
                      <option value="2" <?php if( $disciplina["intTipoAvaliacao"]==2 ){ ?>selected<?php } ?>>Conceitos (Atingiu, parcial, não atingiu)</option>
                      
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputName">Estrutura Curricular</label>
                    <select class="form-control" name="matrizCurricular">
                      <option value="1" <?php if( $disciplina["intEstruturaCurricular"]==1 ){ ?>selected<?php } ?>>Base Nacional Comum</option>
                      <option value="2" <?php if( $disciplina["intEstruturaCurricular"]==2 ){ ?>selected<?php } ?>>Parte Diversificada</option>
                    </select>
                  </div>

          
                  <div class="form-group col-md-3">
                    <label for=""></label>
                    <button type="submit" class="btn btn-success form-control">Cadastrar</button>
                  </div>
                </div>
                <!-- /.card-body -->

          
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

