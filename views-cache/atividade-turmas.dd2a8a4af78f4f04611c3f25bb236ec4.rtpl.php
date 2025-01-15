<?php if(!class_exists('Rain\Tpl')){exit;}?><main>
    <section class="aulas-remotas-titulo container">
        <h2>ATIVIDADES REMOTAS</h2>
        <p>Agora você tem um canal oficial com acesso a todas atividades do ensino remoto das escolas municipais em um só lugar!</p>
    </section>
    
 


    <section class="turmas container">
        <div class="row">
          
            
            <?php $counter1=-1;  if( isset($turmas) && ( is_array($turmas) || $turmas instanceof Traversable ) && sizeof($turmas) ) foreach( $turmas as $key1 => $value1 ){ $counter1++; ?>
            <div class="col-md-3">
                <a class="item" href="/atividades/<?php echo htmlspecialchars( $value1["idEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    <img src="/res/_img/escolas/<?php echo htmlspecialchars( $value1["txtLogo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    <div class="nome-turmas">
                        <span class="turma"><?php echo htmlspecialchars( $value1["nomeTurma"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                        <span><?php echo htmlspecialchars( $value1["nomeEscola"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                    </div>
                </a>
            </div>
            <?php } ?>
          
           
           

        </div>
    </section>
    
</main>
<br><br><br><br><br><br><br><br><br>
