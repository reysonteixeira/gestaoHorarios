<?php if(!class_exists('Rain\Tpl')){exit;}?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro Servidores</h1>
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
              <form method="POST" action="/admin/servidores/<?php echo htmlspecialchars( $servidor["idServidores"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="card-body row">

                  <div class="form-group col-md-5">
                    <label for="exampleInputName">Nome Completo</label>
                    <input type="text" class="form-control" id="exampleInputName" name="txtNome" value="<?php echo htmlspecialchars( $servidor["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Nome Completo">
                  </div>

                  <div class="form-group col-md-2">
                    <label for="exampleInputTelefone">Telefone</label>
                    <input type="tel" class="form-control" id="exampleInputTelefone" name="txtTelefone" value="<?php echo htmlspecialchars( $servidor["txtTelefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="(37) 9999 - 9999">
                  </div>

                  <div class="form-group col-md-5">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" readonly id="exampleInputEmail1" name="txtEmail" value="<?php echo htmlspecialchars( $servidor["txtEmail"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="servidor@gmail.com">
                  </div>

               

                  <div class="form-group col-md-2">
                    <label for="exampleInputTipoAcesso">Tipo de Acesso</label>

                    <select name="intTipoAcesso" class="form-control">
                      <option value="">SELECIONE</option>
                      <option value="1" <?php if( $servidor["intTipoAcesso"] ==1 ){ ?>selected<?php } ?>>Secretaria de Educação</option>
                      <option value="2" <?php if( $servidor["intTipoAcesso"] ==2 ){ ?>selected<?php } ?>>Secretários Escola</option>
                      <option value="3" <?php if( $servidor["intTipoAcesso"] ==3 ){ ?>selected<?php } ?>>Professores</option>
                      <option value="4" <?php if( $servidor["intTipoAcesso"] ==4 ){ ?>selected<?php } ?>>Supervisores</option>
                      <option value="5" <?php if( $servidor["intTipoAcesso"] ==5 ){ ?>selected<?php } ?>>Direção</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for=""></label>
                    <input type="submit" value="ATUALIZAR" class="btn btn-primary form-control">
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


