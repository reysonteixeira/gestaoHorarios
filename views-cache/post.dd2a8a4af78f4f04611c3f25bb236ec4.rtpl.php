<?php if(!class_exists('Rain\Tpl')){exit;}?><main>
    <section class="container">
        <div class="row">
            <div class="col-md-8 postagem">
                <img src="/res/_img/blog/<?php echo htmlspecialchars( $postagem["txtImagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="img-post" alt="">
                <h2><?php echo htmlspecialchars( $postagem["txtTitulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h2>
                <span><i class="fas fa-calendar-alt"></i><b><?php echo date('d/m/Y', strtotime($postagem["dtDataPostagem"])); ?></b></span>
                <br><br>

                <?php echo htmlspecialchars( $postagem["txtPostagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                    <div class="cabecalho-ultimas">
                        <span>ÚLTIMAS POSTAGENS</span>
                    </div>
                    </div>

                    <?php $counter1=-1;  if( isset($principais) && ( is_array($principais) || $principais instanceof Traversable ) && sizeof($principais) ) foreach( $principais as $key1 => $value1 ){ $counter1++; ?>
                    <div class="col-12">
                        
                        <a class="posts-lateral" href="/blog/<?php echo htmlspecialchars( $value1["idBlog"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="background-image: url(/res/_img/blog/<?php echo htmlspecialchars( $value1["txtImagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>);">
                            <div class="titulo" >
                                <h3><?php echo htmlspecialchars( $value1["txtTitulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                                <span><i class="fas fa-calendar-alt"></i><b><?php echo date('d/m/Y', strtotime($value1["dtDataPostagem"])); ?></b></span>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                   
                    
                </div>
                

                
            </div>
        </div>
    </section>
   
 
    
    </main>