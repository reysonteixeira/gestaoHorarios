<?php if(!class_exists('Rain\Tpl')){exit;}?>
    <main>
        <section class="aulas-remotas-titulo container">
            <h2>ATIVIDADES REMOTAS</h2>
            <p>Agora você tem um canal oficial com acesso a todas atividades do ensino remoto das escolas municipais em um só lugar!</p>
        </section>
        
       


        <section class="turmas container">
            <div class="row">
                <!-- <div class="breadcumb">
                    <a href="">Escola Municipal Elias Teodoro</a><span> / 1º ANO</span>
                </div> -->
           
                <?php $counter1=-1;  if( isset($atividades) && ( is_array($atividades) || $atividades instanceof Traversable ) && sizeof($atividades) ) foreach( $atividades as $key1 => $value1 ){ $counter1++; ?>
                <div class="col-md-3">
                    <a class="item" href="/atividade/<?php echo htmlspecialchars( $value1["idAtividades"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" >
                        <div class="nome-turmas">
                            <i class="fas fa-calendar" style="color: #fff; font-size: 48px;"></i>
                            <span class="turma"><?php echo date('d/m/Y', strtotime($value1["dtAtividade"])); ?></span>
                            
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </section>
        
    </main>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>