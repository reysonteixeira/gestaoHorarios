<?php if(!class_exists('Rain\Tpl')){exit;}?><main>
    <section class="aulas-remotas-titulo container">
        <h2>ATIVIDADES REMOTAS</h2>
        <p>Agora você tem um canal oficial com acesso a todas atividades do ensino remoto das escolas municipais em um só lugar!</p>
    </section>
    
   


    <section class="atividade container">
        <div class="row">
            <div class="col-12">
                <?php $counter1=-1;  if( isset($atividades) && ( is_array($atividades) || $atividades instanceof Traversable ) && sizeof($atividades) ) foreach( $atividades as $key1 => $value1 ){ $counter1++; ?>
                    <?php if( $value1["intTipo"] == 1 ){ ?>
                        <h2><i class="fas fa-book-reader"></i> HISTÓRIA</h2>
                        <span>Nome da História: </span><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br>
                        <?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    <?php } ?>
                    <?php if( $value1["intTipo"] == 2 ){ ?>
                        <h2><i class="fas fa-pencil-alt"></i> LIVRO</h2>
                        <span>Livro: </span><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br>
                        <span>Páginas: </span><?php echo htmlspecialchars( $value1["txtPagina"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <br>
                        <?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    <?php } ?>
                    <?php if( $value1["intTipo"] == 3 ){ ?>
                        <h2><i class="fas fa-music"></i> MÚSICA</h2>
                        <span>Nome: </span><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br>
                        <?php if( $value1["txtLink"] ){ ?><a href="<?php echo htmlspecialchars( $value1["txtLink"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="blank"><span>Link de Acesso</span></a><br><?php } ?>
                        <?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    <?php } ?>
                    <?php if( $value1["intTipo"] == 4 ){ ?>
                        <h2><i class="fas fa-video"></i> VÍDEO</h2>
                        <span>Nome: </span><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br>
                        <?php if( $value1["txtLink"] ){ ?><a href="<?php echo htmlspecialchars( $value1["txtLink"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="blank"><span>Link de Acesso</span></a><br><?php } ?>
                        <?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    <?php } ?>
                    <?php if( $value1["intTipo"] == 5 ){ ?>
                        <h2><i class="fas fa-user-edit"></i> FAZER NO CADERNO</h2>
                    <?php } ?>
                    <?php if( $value1["intTipo"] == 6 ){ ?>
                        <h2><i class="fas fa-file-alt"></i> ARQUIVOS</h2>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>