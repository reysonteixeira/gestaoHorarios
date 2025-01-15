<?php if(!class_exists('Rain\Tpl')){exit;}?> <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Disciplinas - Cadastradas</h1>
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
          
            <div class="col-sm-2">
                <a href="/admin/cadastrar-disciplinas" class="btn btn-success">Cadastrar Disciplinas</a> 
                        </div>

            <?php if( $disciplinas ){ ?>
            <table class="table mt-3">
              <thead>
                <tr>
                  <th scope="col">Nome</th>
                  
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($disciplinas) && ( is_array($disciplinas) || $disciplinas instanceof Traversable ) && sizeof($disciplinas) ) foreach( $disciplinas as $key1 => $value1 ){ $counter1++; ?>
             
                <tr>
                  <td><?php echo htmlspecialchars( $value1["txtNomeDisciplina"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              
                  <td class="botao"><a href="/admin/disciplinas/<?php echo htmlspecialchars( $value1["idDisciplina"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button class="btn btn-primary btn-sm">Acessar <i class="fas fa-edit"></i></button></a></td>
                  <td class="botao"><a href="/admin/deletarDisciplina/<?php echo htmlspecialchars( $value1["idDisciplina"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button class="btn btn-danger btn-sm">Deletar <i class="fas fa-trash"></i></button></a></td>
                </tr>
               
                <?php } ?>
               


        
              </tbody>
            </table>
            <?php }else{ ?>
            <div class="col-12">
              <br>
              <h1>Não foram encontradas semanas cadastradas!</h1>
            </div>
          
            <?php } ?>
            
          <!-- ./col -->
        </div>
 
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->