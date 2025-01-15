<?php if(!class_exists('Rain\Tpl')){exit;}?>
    <main>
        <section class="aulas-remotas-titulo container">
            <h2>ATIVIDADES REMOTAS</h2>
            <p>Agora você tem um canal oficial com acesso a todas atividades do ensino remoto das escolas municipais em um só lugar!</p>
        </section>
        
       


        <section class="turmas container">
            <div class="row">
               
           
                <?php $counter1=-1;  if( isset($semana) && ( is_array($semana) || $semana instanceof Traversable ) && sizeof($semana) ) foreach( $semana as $key1 => $value1 ){ $counter1++; ?>
                <div class="col-md-3">
                    <a class="item" href="/atividades/<?php echo htmlspecialchars( $escola, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $turma, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idSemana"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <i class="fas fa-calendar-alt"></i>
                        <div class="nome-turmas">
                            <span class="turma"><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                            <span><?php echo date('d/m/Y', strtotime($value1["dtDataInicio"])); ?> a <?php echo date('d/m/Y', strtotime($value1["dtDataFim"])); ?></span>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </section>
        
    </main>
    <br><br><br><br><br><br><br><br><br><br><br>