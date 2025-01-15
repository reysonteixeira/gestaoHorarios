<?php if(!class_exists('Rain\Tpl')){exit;}?> <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Turmas - Cadastradas</h1>
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
            <!-- <div class="busca col-sm-10">
              <form action="/admin/produtos" class="form d-flex align-items-end">
                <div class="form-group">
                  <label>Busca</label>
                  <input type="text" name="busca" class="form-control">
                </div>
                <div>
                <input type="submit" value="Buscar" class="btn btn-primary">
              </div>
              </form>
            </div> -->
            <?php if( $permissaoMenu < 3 ){ ?>
            <div class="col-sm-2">
                <a href="/admin/cadastrar-turmas" class="btn btn-success">Cadastrar Turmas</a> 
            </div>
            <?php } ?>


            <div class="col-sm-4">
              <form action="/admin/turmas" method="get" class="row">
                <div class="col-md-8 form-group">
                  <label for="">Ano</label>
                  <select name="txtAno" id="" class="form-control">
                    <option value="">SELECIONE</option>
                    <?php $counter1=-1;  if( isset($anos) && ( is_array($anos) || $anos instanceof Traversable ) && sizeof($anos) ) foreach( $anos as $key1 => $value1 ){ $counter1++; ?>
                  
                    <option value="<?php echo htmlspecialchars( $value1["txtAnoTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["txtAnoTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <input type="submit" style="margin-top: 30px;" value="Filtrar" class="form-control btn-info"> 
                </div>
              </form>
              
          </div>

            <?php if( $turma ){ ?>
            <table class="table mt-3">
              <thead>
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Escola</th>
                  <th scope="col">Ano</th>
                  <th></th>
                  <?php if( $permissaoMenu == 2 ){ ?> <th></th><?php } ?>
                </tr>
                
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($turma) && ( is_array($turma) || $turma instanceof Traversable ) && sizeof($turma) ) foreach( $turma as $key1 => $value1 ){ $counter1++; ?>
             
                <tr>
                  <td><?php echo htmlspecialchars( $value1["nomeTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["nomeEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["txtAnoTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td class="botao"><a href="/admin/turmas/<?php echo htmlspecialchars( $value1["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button class="btn btn-primary btn-sm">Acessar <i class="fas fa-edit"></i></button></a></td>
                  <?php if( $permissaoMenu == 2 ){ ?><td class="botao"><a href="/SSBordados-admin/ofertas/delete/"><button class="btn btn-danger btn-sm">Deletar <i class="fas fa-trash"></i></button></a></td><?php } ?>
                </tr>
               
                <?php } ?>
               

        
              </tbody>
            </table>
            <?php }else{ ?>
            <div class="col-12">
              <br>
              <h1>Não foram encontradas turmas cadastradas!</h1>
            </div>
          
            <?php } ?>
            
          <!-- ./col -->
        </div>
 
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->