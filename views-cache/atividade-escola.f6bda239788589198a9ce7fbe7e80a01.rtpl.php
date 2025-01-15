<?php if(!class_exists('Rain\Tpl')){exit;}?><main>
    <section class="aulas-remotas-titulo container">
        <h2>ATIVIDADES REMOTAS</h2>
        <p>Agora você tem um canal oficial com acesso a todas atividades do ensino remoto das escolas municipais em um só lugar!</p>
    </section>
    
  

    <section class="escolas container">
        <div class="row">
          
            
            <?php $counter1=-1;  if( isset($escolas) && ( is_array($escolas) || $escolas instanceof Traversable ) && sizeof($escolas) ) foreach( $escolas as $key1 => $value1 ){ $counter1++; ?>
            <div class="col-md-3">
                <div class="card">
                <a class="" href="/atividades/<?php echo htmlspecialchars( $value1["idEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    <img src="/res/_img/escolas/<?php echo htmlspecialchars( $value1["txtLogo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="img-fluid">
                    <div class="nome-turmas">
                        <p><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                    </div>
                </a>
            </div>
            </div>
            <?php } ?>
            
            
            
           
        

        </div>
    </section>
    
</main>
