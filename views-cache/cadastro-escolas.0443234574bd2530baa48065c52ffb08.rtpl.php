<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastrar Escola</h1>
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
              <form method="POST" action="/admin/cadastrar-escolas" enctype="multipart/form-data">
                <div class="card-body row">
                  
                  <div class="form-group col-md-6">
                    <label for="exampleInputName">Nome da Escola</label>
                    <input type="text" class="form-control" id="exampleInputName" name="txtNome" placeholder="Escola">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputName">Logo</label><br>
                    <input type="file"  id="exampleInputName" name="fotos" placeholder="Escola">
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
