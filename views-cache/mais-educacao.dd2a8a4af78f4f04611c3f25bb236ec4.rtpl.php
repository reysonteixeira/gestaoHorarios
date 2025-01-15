<?php if(!class_exists('Rain\Tpl')){exit;}?><main>
    <section class="container mais-educacao-titulo">
        <h2>MAIS EDUCAÇÃO</h2>
        <p>O aprendizado é um processo que envolve sala de aula, dedicação
            e curiosidade.</p>
    </section>
    <section class="literario container">
    <div class="row">
        <div class="col-md-6">
            <div class="card-educacao">
                <div class="card-head">
                    <i class="fas fa-book-open"></i><span> INDICAÇÕES LITERÁRIAS</span>
                </div>
                <div class="card-body">

                    <?php $counter1=-1;  if( isset($maisEducacao) && ( is_array($maisEducacao) || $maisEducacao instanceof Traversable ) && sizeof($maisEducacao) ) foreach( $maisEducacao as $key1 => $value1 ){ $counter1++; ?>
                    <?php if( $value1["intTipo"]==1 ){ ?>
                    <div class="item">
                        <img src="/res/_img/maiseducacao/<?php echo htmlspecialchars( $value1["txtImagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="width: 100px">
                        <div>
                            <h4><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
                            <?php if( $value1["txtAutor"] ){ ?><span class="negrito">Autor: </span><span><?php echo htmlspecialchars( $value1["txtAutor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><br><?php } ?>
                            <?php if( $value1["txtAno"] ){ ?><span class="negrito">Publicação: </span><span><?php echo htmlspecialchars( $value1["txtAno"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><?php } ?>
                            <br>
                            <a href="<?php echo htmlspecialchars( $value1["txtLink"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="_blank"><button>ACESSE AQUI</button></a>
                        </div>
                    </div>
                    <hr>
                    <?php } ?>
                    <?php } ?>
                  
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-educacao">
                <div class="card-head">
                    <i class="fas fa-gamepad"></i><span> INDICAÇÕES DE JOGOS</span>
                </div>
                <div class="card-body">
                    
                    <?php $counter1=-1;  if( isset($maisEducacao) && ( is_array($maisEducacao) || $maisEducacao instanceof Traversable ) && sizeof($maisEducacao) ) foreach( $maisEducacao as $key1 => $value1 ){ $counter1++; ?>
                    <?php if( $value1["intTipo"]==2 ){ ?>
                    <div class="item">
                        <img src="/res/_img/maiseducacao/<?php echo htmlspecialchars( $value1["txtImagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="width: 100px">
                        <div>
                            <h4><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?><span> <?php if( $value1["intIdadeSugerida"] ){ ?> <?php echo htmlspecialchars( $value1["intIdadeSugerida"], ENT_COMPAT, 'UTF-8', FALSE ); ?> anos</span><?php } ?></h4>
                            <span><?php echo htmlspecialchars( $value1["txtDescricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                            <br>
                            <a href="<?php echo htmlspecialchars( $value1["txtLink"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="_blank"><button>ACESSE AQUI</button></a>
                        </div>
                    </div>
                    <hr>
                    <?php } ?>
                    <?php } ?>
                  
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-educacao">
                <div class="card-head">
                    <i class="fas fa-video"></i><span> INDICAÇÕES DE FILMES</span>
                </div>
                <div class="card-body">
                    
                    <?php $counter1=-1;  if( isset($maisEducacao) && ( is_array($maisEducacao) || $maisEducacao instanceof Traversable ) && sizeof($maisEducacao) ) foreach( $maisEducacao as $key1 => $value1 ){ $counter1++; ?>
                    <?php if( $value1["intTipo"]==3 ){ ?>
                    <div class="item">
                        <img src="/res/_img/maiseducacao/<?php echo htmlspecialchars( $value1["txtImagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="width: 100px">
                        <div>
                            <h4><?php echo htmlspecialchars( $value1["txtNome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
                            <?php if( $value1["txtAutor"] ){ ?><span class="negrito">Autor: </span><span><?php echo htmlspecialchars( $value1["txtAutor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><br><?php } ?>
                            <?php if( $value1["txtAno"] ){ ?><span class="negrito">Publicação: </span><span><?php echo htmlspecialchars( $value1["txtAno"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><?php } ?>
                            <br>
                            <a href="<?php echo htmlspecialchars( $value1["txtLink"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="_blank"><button>ACESSE AQUI</button></a>
                        </div>
                    </div>
                    <hr>
                    <?php } ?>
                    <?php } ?>
                  
                </div>
            </div>
        </div>
    </div>
    </section>
   
</main>