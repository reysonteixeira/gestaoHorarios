<?php if(!class_exists('Rain\Tpl')){exit;}?><div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="/res/_img/escola.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>



<main>
    
    <section class="volta-aulas container">
        <h1>VOLTA DO ENSINO PRESENCIAL</h1>
        <div class="protocolos">
            <div class="protocolo">
                <img src="/res/_img/protocolos/mascara.svg">
                <p>USO DE MÁSCARA<br>OBRIGATÓRIO</p>
            </div>
            <div class="protocolo">
                <img src="/res/_img/protocolos/distanciamento-social.svg">
                <p>SALAS COM<br>DISTANCIAMENTO</p>
            </div>
            <div class="protocolo">
                <img src="/res/_img/protocolos/calendario-de-primavera.svg">
                <p>REVEZAMENTO<br>DE TURMAS</p>
            </div>
            <div class="protocolo">
                <img src="/res/_img/protocolos/monitoramento.svg">
                <p>MONITORAMENTO<br>CONSTANTE</p>
            </div>
        </div>
    </section>

    <section class="ensino-remoto">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="/res/_img/meet.png" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2>ENSINO REMOTO</h2>
                    <p>O ensino remoto continua com aulas ao vivo com o mesmo planejamento do ensino presencial. </p>
                    <a href=""><button>ACESSAR</button></a>
                </div>                  
            </div>
        </div>
    </section>
    <section class="atividades-remoto">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="/res/_img/alunos.svg" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2>ATIVIDADES REMOTAS</h2>
                    <p>Agora você tem um canal oficial com acesso a todas atividades do ensino remoto em um só lugar!</p>
                    <a href="/atividades"><button>ACESSAR</button></a>
                </div>
            </div>
        </div>
    </section>
    <section class="mais-educacao container">
        <h1>MAIS EDUCAÇÃO</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="/res/_img/notebook.svg" class="img-fluid">
            </div>
            <div class="col-md-6 texto">
                <p>O aprendizado é um processo que envolve sala de aula, dedicação e curiosidade.</p>
                <p>Pensando nisso separamos alguns materiais extra curriculares para você aprender com sites, jogos e filmes educativos.</p>
                <a href=""><button>ACESSAR</button></a>
            </div>
        </div>
    </section>
    <section class="blog container">
        <h1>BLOG</h1>
        <div class="row">

            <?php $counter1=-1;  if( isset($blog) && ( is_array($blog) || $blog instanceof Traversable ) && sizeof($blog) ) foreach( $blog as $key1 => $value1 ){ $counter1++; ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="/res/_img/blog/<?php echo htmlspecialchars( $value1["txtImagem"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="">
                    <div class="info">
                        <h6><?php echo htmlspecialchars( $value1["txtTitulo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h6>
                        <span><i class="fas fa-calendar-alt"></i> <b><?php echo date('d/m/Y', strtotime($value1["dtDataPostagem"])); ?></b></span>
                        <p><?php echo htmlspecialchars( $value1["txtResumo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                        <a href="/blog/<?php echo htmlspecialchars( $value1["idBlog"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><button>MATÉRIA COMPLETA</button></a>
                    </div>
                </div>
            </div>
            <?php } ?>
       

        </div>
    </section>
</main>