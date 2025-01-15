<?php if(!class_exists('Rain\Tpl')){exit;}?><main>
    <section class="container mais-educacao-titulo">
        <h2>BLOG</h2>
    </section> 

    <section class="container">
        <div class="postagens-pricipais">
        <a class="post-a" href="/blog/<?php echo htmlspecialchars( $principais["0"]["idBlog"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="background-image: url(/res/_img/blog/<?php echo htmlspecialchars( $principais["0"]["txtImagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>);">
            <div class="titulo" >
                <h3><?php echo htmlspecialchars( $principais["0"]["txtTitulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                <span><i class="fas fa-calendar-alt"></i><b><?php echo date('d/m/Y', strtotime($principais["0"]["dtDataPostagem"])); ?></b></span>
            </div>
        </a>
        <?php if( count($principais) > 1 ){ ?>
        <a class="post-b" href="/blog/<?php echo htmlspecialchars( $principais["1"]["idBlog"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="background-image: url(/res/_img/blog/<?php echo htmlspecialchars( $principais["1"]["txtImagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>);">
            <div class="titulo" >
                <h3><?php echo htmlspecialchars( $principais["1"]["txtTitulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                <span><i class="fas fa-calendar-alt"></i><b><?php echo date('d/m/Y', strtotime($principais["1"]["dtDataPostagem"])); ?></b></span>
            </div>
    
         </a>
        <?php } ?>
        <?php if( count($principais) > 2 ){ ?>
        <a class="post-c" href="/blog/<?php echo htmlspecialchars( $principais["2"]["idBlog"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="background-image: url(/res/_img/blog/<?php echo htmlspecialchars( $principais["2"]["txtImagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>);">
            <div class="titulo" >
                <h3><?php echo htmlspecialchars( $principais["2"]["txtTitulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                <span><i class="fas fa-calendar-alt"></i><b><?php echo date('d/m/Y', strtotime($principais["2"]["dtDataPostagem"])); ?></b></span>
            </div>
        </a>
        <?php } ?>
    </div>
    </section>
   
    <section class="blog container">
    <br><br>
        <div class="row">

            <?php $counter1=-1;  if( isset($secundarios) && ( is_array($secundarios) || $secundarios instanceof Traversable ) && sizeof($secundarios) ) foreach( $secundarios as $key1 => $value1 ){ $counter1++; ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="/res/_img/blog/<?php echo htmlspecialchars( $value1["txtImagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="">
                    <div class="info">
                        <h6><?php echo htmlspecialchars( $value1["txtTitulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h6>
                        <span><i class="fas fa-calendar-alt"></i><b><?php echo date('d/m/Y', strtotime($value1["dtDataPostagem"])); ?></b></span>
                        <p><?php echo htmlspecialchars( $value1["txtResumo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                        <a href="/blog/<?php echo htmlspecialchars( $value1["idBlog"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button>MATÉRIA COMPLETA</button></a>
                    </div>
                </div>
            </div>
            <?php } ?>
          
           
        
        </div>
    </section>
    <section class="paginacao">
        <a href=""><button><<</button></a>
        <?php $counter1=-1;  if( isset($pagination) && ( is_array($pagination) || $pagination instanceof Traversable ) && sizeof($pagination) ) foreach( $pagination as $key1 => $value1 ){ $counter1++; ?>
            <a href="/blog?pagina=<?php echo htmlspecialchars( $value1, ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button><?php echo htmlspecialchars( $value1, ENT_COMPAT, 'UTF-8', FALSE ); ?></button></a>
        <?php } ?>
        <a href=""><button>>></button></a>
    </section>

    </main>
  