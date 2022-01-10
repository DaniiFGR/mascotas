<!DOCTYPE html>
<!--
 * A Design by GraphBerry
 * Author: GraphBerry
 * Author URL: http://graphberry.com
 * License: http://graphberry.com/pages/license
-->
<html lang="en">

<head>
  <meta charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Firulais's Friends</title>
  <!-- Load Roboto font -->
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <!-- Load css styles -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/pluton.css" />

  <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
  <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
  <link rel="stylesheet" type="text/css" href="css/animate.css" />
  <link rel="shortcut icon" href="images/ico/icon1.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>

<body>
  <?php
    include 'procesar.php';
    $mascotasObj = new Mascotas();
    $mascotas = $mascotasObj->mostrar();
    $contador= $mascotasObj->contar();
  ?>
  <div class="navbar navbar-fixed-top animated fadeInDown row">
    <div class="navbar-inner">
      <div class="container">
        <a href="#" class="brand">
          <img src="images/img1.png" alt="Logo" />
          <!-- This is website logo -->
        </a>
        <!-- Navigation button, visible on small resolution -->
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <i class="icon-menu"></i>
        </button>
        <!-- Main navigation -->
        <div class="nav-collapses pull-right">
          <ul class="nav" id="top-navigation">
            <li class="active"><a href="#home">Inicio</a></li>
            <li><a href="#service">Servicios</a></li>
            <li><a href="#portfolio">Conocelos</a></li>
            <li><a href="#about">Equipo</a></li>
            <li><a href="#clients">Patrocinadores</a></li>
            <li><a href="#price">Padrinos</a></li>
            <li><a href="#contact">Contactenos</a></li>
            <li><a href="formularios/form-mascotas.php">Agregar mascota</a></li>
          </ul>
        </div>
        <!-- End main navigation -->
      </div>
    </div>
  </div>
  <!-- Start home section -->
  <div id="home">
    <!-- Start cSlider -->
    <div id="da-slider" class="da-slider">
      <div class="triangle"></div>
      <!-- mask elemet use for masking background image -->
      <div class="mask"></div>
      <!-- All slides centred in container element -->
      <div class="container">
        <!-- Start first slide -->
        <div class="da-slide">
          <h2 class="fittext2">Bienvenido a Firulais's Friends</h2>
          <h4>Adopta Una Sonrisa</h4>
          <p> Firulais's Friends es una organización sin fines de lucro compuesta por un grupo de voluntarios unidos
            por el amor hacia los animales y la convicción de que, juntos, podemos hacer mucho por ellos.</p>
          <div class="da-img">
            <img src="images/img3.png" alt="image01" width="320">
          </div>
        </div>
        <!-- End first slide -->
        <!-- Start second slide -->
        <div class="da-slide">
          <h2>Proteccion Animal</h2>
          <h4>¿Qué es y qué hace?</h4>
          <p>Con nuestra labor buscamos atacar el problema de los animales abandonados y maltratados desde dos
            frentes: por un lado, ayudando a rescatar perros y gatos para después buscarles hogares adoptivos
            responsables y, por el otro, sensibilizando a las personas y haciéndoles ver que todos somos parte
            de la solución. Parte importante de nuestra tarea concientizadora consiste en organizar campañas de
            esterilización y difundir las ventajas de este procedimiento para nuestros animales de compañía.</p>
          <div class="da-img">
            <img src="images/img4.png" width="320" alt="image02">
          </div>
        </div>
        <!-- End second slide -->
        <!-- Start third slide -->
        <div class="da-slide">
          <h2>Porque Ellos lo Merecen</h2>
          <h4>¿Cómo funciona Rescate Animal?</h4>
          <p>Rescate Animal funda su labor en tres pilares básicos: los voluntarios, los ciudadanos y las donaciones.
            Entre otras cosas, los voluntarios atienden y orientan a los interesados en adoptar y a las personas
            que piden ayuda, y difunden a los perros y gatos en las redes sociales para encontrarles hogares
            definitivos. También realizan una labor constante de sensibilización para que la gente tome conciencia
            de que el problema de la sobrepoblación canina y felina es un problema de todos y que, por lo tanto,
            la solución está en manos de todos. </p>
          <div class="da-img">
            <img src="images/img5.png" width="320" alt="image03">
          </div>
        </div>
        <!-- Start third slide -->
        <!-- Start cSlide navigation arrows -->
        <div class="da-arrows">
          <span class="da-arrows-prev"></span>
          <span class="da-arrows-next"></span>
        </div>
        <!-- End cSlide navigation arrows -->
      </div>
    </div>
  </div>
  <!-- End home section -->
  <!-- Service section start -->
  <div class="section primary-section" id="service">
    <div class="container">
      <!-- Start title section -->
      <div class="title">
        <h1>¿Que Hacemos?</h1>
        <!-- Section's title goes here -->
        <p>Trae a tu mascota y dejala en las mejores manos para que sea feliz!</p>
        <!--Simple description for section goes here. -->
      </div>
      <div class="row-fluid">
        <div class="span4">
          <div class="centered service">
            <div class="circle-border zoom-in">
              <img class="img-circle" src="images/img6.jpg" alt="service 1">
            </div>
            <h3>Accesorios</h3>
            <p>Contamos con un amplio portafolio en accesorios para tu cachorro, camas para perros, pañitos y
              pañales para cachorros, correas, juguetes, alimento de cachorros y perros adultos, croquetas,
              etc.</p>
          </div>
        </div>
        <div class="span4">
          <div class="centered service">
            <div class="circle-border zoom-in">
              <img class="img-circle" src="images/img7.jpg" alt="service 2" />
            </div>
            <h3>Peluqueria</h3>
            <p>Peluquería canina y Grooming para perros, gatos, productos especiales de baño de acuerdo con el
              tipo de pelaje, corte de uñas, limpieza de orejas, cepillado del pelaje</p>
          </div>
        </div>
        <div class="span4">
          <div class="centered service">
            <div class="circle-border zoom-in">
              <img class="img-circle" src="images/img8.jpg" alt="service 3">
            </div>
            <h3>Veterinaria</h3>
            <p>Clínica Veterinaria Huellitas brinda atención a animales, en consulta y cirugía
              general y especializada, considerada como una de las clínicas veterinarias mas modernas de ipiales.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Service section end -->
  <!-- Portfolio section start -->
  <div class="section primera-seccion" id="portfolio">
    <div class="triangle"></div>
    <div class="container">
      <div class=" title">
        <h1>Conocelos</h1>
        <p>Ellos También Merecen un Hogar</p>
      </div>
      <ul class="nav nav-pills categorias" >
        <li class="filter" data-filter="all">
          <a href="#noAction">Todos</a>
        </li>
        <li class="filter" data-filter="Caninos">
          <a href="#noAction">Perritos</a>
        </li>
        <li class="filter" data-filter="Felinos">
          <a href="#noAction">Gatitos</a>
        </li>
      </ul>
      <!-- Start details for portfolio project 1 -->
      <div id="single-project" class="row">
        <?php
          foreach ($mascotas as $reg) {
            $band = 0;
            foreach($contador as $cont){
              if($cont['mascota_id'] == $reg['id_mas']){
                $band = $cont['num'];

              }
            }
        ?>
          <div id="<?php echo $reg["id_mas"]?>" class="toggleDiv row-fluid single-project listado">
            <div class="span6">
            <img class="img-info" alt="..." src="data:<?php echo $reg['tipo']; ?>;base64,<?php echo  base64_encode($reg['imagen']); ?>">
            </div>
            <div class="span6">
              <div class="project-description">
                <div class="project-title clearfix contenido-p-s">
                  <h1><?php echo $reg["nombre"]?></h1>
                  <span class="show_hide close">
                    <i class="icon-cancel"></i>
                  </span>
                </div>
                <div class="project-info">
                  <div>
                    <span><h4>Edad</h4></span>
                    <?php
                    echo floor(($reg['edad'] / 12))." Años y ".($reg['edad'] % 12)." meses";
                    ?>
                  </div>
                  <div class="espacio">
                    <span><h4>Raza</h4></span><?php echo $reg['raza']?>
                  </div>
                  <div class="espacio">
                    <span><h4>Solicitudes</h4></span><?php if($band != 0) echo "$band <i class='bi bi-suit-heart'></i>"?>
                  </div>
                  <div class="espacio">
                    <span><h4>Comentarios</h4></span>
                    <textarea name="comentarios" id="comentarios" class="comentarios" disabled><?php echo $reg['comentarios']?></textarea>
                  </div>
                  <div class="btn-adopcion">
                    <button class="btn btn-warning btn-informacion" id="btn-info" data-direc="<?php echo $reg['url_raza']?>">Información</button>
                    <button class="btn btn-info btn-adop" data-id="<?php echo $reg['id_mas']?>" data-nombre="<?php echo $reg['nombre']?>"  data-edad="<?php echo $reg['edad']?>" data-raza="<?php echo $reg['raza']?>" data-cmt="<?php echo $reg['comentarios']?>" data-img="<?php echo $reg['imagen_id']?>" data-direc="<?php echo $reg['url_raza']?>">Adoptar</button>
                  </div>
                </div>
                <p></p>
              </div>
            </div>
          </div>
        <?php }?>
          <ul id="portfolio-grid" class="thumbnails row">
          <?php
              foreach ($mascotas as $reg) {
                if($reg['estado'] == 'Activo'){
                  $band = 0;
                  foreach($contador as $cont){
                    if($cont['mascota_id'] == $reg['id_mas']){
                      $band = $cont['num'];

                    }
                  }
            ?>
              <li class="span4 mix altura <?php echo $reg['especie']?>">
                <div class="thumbnail">
                <img class="img-afuera" alt="..." src="data:<?php echo $reg['tipo']; ?>;base64,<?php echo  base64_encode($reg['imagen']); ?>">
                  <a href="#single-project" class="more show_hide" rel="#<?php echo $reg["id_mas"]?>">
                    <i class="icon-plus"></i>
                  </a>
                  <span></span>
                  <h3><?php echo $reg["nombre"]?><?php if($band != 0) echo "<span style='margin-left: 80px'> $band <i class='bi bi-suit-heart'></i></span>"?></h3>
                  <div class="mask"></div>
                </div>
              </li>
            <?php }}?>
          </ul>
      </div>
    </div>
  </div>
  <!-- Portfolio section end -->
  <!-- About us section start -->
  <div class="section primary-section" id="about">
    <div class="triangle"></div>
    <div class="container">
      <div class="title">
        <h1>¿Quienes Somos?</h1>
        <p>Nuestro Equipo de trabajo esta conformado por voluntarios bajo la coordinación de </p>
      </div>
      <div class="row-fluid team" style="margin-left: 18%;">
        <div class="span4 " id="first-person">
          <div class="thumbnail">
            <img src="images/dise1.jpg" alt="...">
            <h3>Daniela Garrido</h3>
            <ul class="social">
              <li>
                <a href="">
                  <span class="icon-facebook-circled"></span>
                </a>
              </li>
              <li>
                <a href="">
                  <span class="icon-twitter-circled"></span>
                </a>
              </li>
              <li>
                <a href="">
                  <span class="icon-linkedin-circled"></span>
                </a>
              </li>
            </ul>
            <div class="mask">
              <h2>Coordinadora de relaciones publicas</h2>
              <p>Se encarga de adelantar los procesos de contactos y presentación de la fundacón y sus proyectos, para la consecución
                de recursos para la ejecución.
              </p>
            </div>
          </div>
        </div>
        <div class="span4" id="second-person">
          <div class="thumbnail">
            <img src="images/dise2.jpg" alt="...">
            <h3>Anndony Quemag</h3>
            <ul class="social">
              <li>
                <a href="">
                  <span class="icon-facebook-circled"></span>
                </a>
              </li>
              <li>
                <a href="">
                  <span class="icon-twitter-circled"></span>
                </a>
              </li>
              <li>
                <a href="">
                  <span class="icon-linkedin-circled"></span>
                </a>
              </li>
            </ul>
            <div class="mask">
              <h2>Director</h2>
              <p>Dirigir, coordinar y supervisar las actividades administrativas y de apoyo para garantizar el normal
                funcionamiento de la Fundación y actuar en representación legal de la misma en todos los eventos y actos
                que lo requieran.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="clients">
    <div class="section primary-section">
      <div class="triangle"></div>
      <div class="container">
        <div class="title">
          <h1>Nuestros Patrocinadores</h1>
          <p>Los Patrocinadores nos ayudan para poder seguir haciendo realidad este sueño</p>
        </div>
        <div class="row justify-content-center">
          <div class="span4">
            <div class="testimonial">
              <p>"Si tener alma significa ser capaces de sentir amor, lealtad y gratitud entonces los animales tienen más alma que muchos humanos"</p>
              <div class="whopic">
                <div class="arrow"></div>
                <img src="images/patro1.jpg" class="centered">
                <strong>Centro Comercial Estrella</strong>
              </div>
            </div>
          </div>
          <div class="span4">
            <div class="testimonial">
              <p>"Para comprar una mascota, basta con tener dinero ... Para adoptar una mascota, basta con tener Corazón "</p>
              <div class="whopic">
                <div class="arrow"></div>
                <img src="images/patro2.png" class="centered">
                <strong>Gran Plaza - Ipiales</strong>
              </div>
            </div>
          </div>
          <div class="span4">
            <div class="testimonial">
              <p>"Mientras Ellos no tengan voz, no dejarás de escuchar la mía"<br><br></p>
              <div class="whopic">
                <div class="arrow"></div>
                <img src="images/patro3.jpg" class="centered">
                <strong>Alkosto</strong>
              </div>
            </div>
          </div>
        </div>
        <p class="testimonial-text">
          "El Amor Es Una Palabra De Cuatro Patas"
        </p>
      </div>
    </div>
  </div>
  <div class="tercera-seccion">
    <div id="price" class="section">
      <div class="container">
        <div class="title">
          <h1>Apadrínalos</h1>
          <p>Apadrínalos para hacerlos felices, realiza tu donación mensual en cualquiera de los siguientes planes</p>
        </div>
        <div class="price-table row-fluid">
          <div class="span4 price-column">
            <h3>basico</h3>
            <ul class="list">
              <li class="price">$30.000</li>
              <li><strong>10Kg</strong> alimento</li>
              <li><strong></strong> Accesorios</li>
            </ul>

            <a href="#" class="button button-ps donar">Donar</a>
          </div>
          <div class="span4 price-column">
            <h3>Pro</h3>
            <ul class="list">
              <li class="price">$50.000</li>
              <li><strong>20Kg</strong> alimento</li>
              <li><strong></strong> accesorios</li>
              <li><strong>cobijas</strong></li>
            </ul>
            <a href="#" class="button button-ps">Donar</a>
          </div>
          <div class="span4 price-column">
            <h3>Premium</h3>
            <ul class="list">
              <li class="price">$100.000</li>
              <li><strong>40Kg</strong> alimento</li>
              <li><strong></strong> Accesorios</li>
              <li><strong>Cobijas y ropa </strong></li>
            </ul>
            <a href="#" class="button button-ps">Donar</a>
          </div>
        </div>
      </div>
    </div>
    <div id="contact" class="cuarta-seccion">
      <div class="section">
        <div class="container">
          <div class="title">
            <h1>Contacta con nosotros</h1>
            <p>Escribenos si tienes alguna duda o quieres ser parte de nuestro equipo</p>
          </div>
        </div>
        <div class="map-wrapper formulario">
          <div class="container">
            <div class="row-fluid">
              <div class="span5 contact-form centered">
                <h3>HOLA</h3>
                <form id="contact-forms" action="" method="post">
                  <div class="control-group">
                    <div class="controls">
                      <input class="span12" type="text" id="name" name="name" placeholder="Nombres" />
                      <div class="error left-align" id="err-name">Escriba su Nombre</div>
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                      <input class="span12" type="email" name="email" id="email" placeholder="Correo" />
                      <div class="error left-align" id="err-email">Escriba su correo.</div>
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                      <textarea class="span12" name="comment" id="comment" placeholder="Mensaje"></textarea>
                      <div class="error left-align" id="err-comment">Escriba un Mensaje</div>
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                      <button id="send-mail" class="message-btn">Enviar Mensaje</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
      <div class="scrollup">
        <a href="#">
          <i class="icon-up-open"></i>
        </a>
      </div>

      <script src="js/jquery.js"></script>
      <script type="text/javascript" src="js/jquery.mixitup.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <script type="text/javascript" src="js/modernizr.custom.js"></script>
      <script type="text/javascript" src="js/jquery.bxslider.js"></script>
      <script type="text/javascript" src="js/jquery.cslider.js"></script>
      <script type="text/javascript" src="js/jquery.placeholder.js"></script>
      <script type="text/javascript" src="js/jquery.inview.js"></script>
      <script type="text/javascript" src="js/app.js"></script>
      <script src="./js/funciones.js"></script>
</body>

</html>