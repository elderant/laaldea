<?php 
  $image_gallery = $laaldea_args['image_gallery'];

  $allies = array(
    'unicef' => array(
      'src' => '/wp-content/uploads/aldea-ally-unicef.png',
      'class' => 'tall unicef',
      'alt' => __('Logo Unicef','laaldea'),
    ),
    'espectador' => array(
      'src' => '/wp-content/uploads/aldea-ally-espectador.png',
      'class' => 'short espectador',
      'alt' => __('Logo El Espectador','laaldea'),
    ),
    'mineducacion' => array(
      'src' => '/wp-content/uploads/aldea-ally-mineducacion.png',
      'class' => 'short mineducacion',
      'alt' => __('Logo Mineducacion','laaldea'),
    ),
    'nrc' => array(
      'src' => '/wp-content/uploads/aldea-ally-nrc.jpg',
      'class' => 'tall nrc',
      'alt' => __('Logo nrc','laaldea'),
    ),
    'rescue' => array(
      'src' => '/wp-content/uploads/aldea-ally-rescue.png',
      'class' => 'tall rescue',
      'alt' => __('Logo International rescue committee','laaldea'),
    ),
    'children' => array(
      'src' => '/wp-content/uploads/aldea-ally-children.png',
      'class' => 'short children',
      'alt' => __('Logo Save the children','laaldea'),
    ),
    'lego' => array(
      'src' => '/wp-content/uploads/aldea-ally-lego.png',
      'class' => 'short lego',
      'alt' => __('Logo The lego foundation','laaldea'),
    ),
    'aprender' => array(
      'src' => '/wp-content/uploads/aldea-ally-aprender.png',
      'class' => 'tall aprender',
      'alt' => __('Logo todos a aprender','laaldea'),
    ),
    'blue' => array(
      'src' => '/wp-content/uploads/aldea-ally-blue.jpg',
      'class' => 'tall blue',
      'alt' => __('Logo Unión Europea','laaldea'),
    ),
    'corpoeducacion' => array(
      'src' => '/wp-content/uploads/aldea-ally-corpoeducacion.png',
      'class' => 'short corpoeducacion',
      'alt' => __('Logo Corpoeducación','laaldea'),
    ),
    'barranquilla' => array(
      'src' => '/wp-content/uploads/aldea-ally-barranquilla.jpg',
      'class' => 'short barranquilla',
      'alt' => __('Logo Secretaría de Educación de Barranquilla','laaldea'),
    ),
    'narino' => array(
      'src' => '/wp-content/uploads/aldea-ally-narino.jpg',
      'class' => 'tall narino',
      'alt' => __('Logo Secretaría de Educación de Nariño','laaldea'),
    ),
  );
?>

<div id="aldea">
  <section class="container-fluid">
    <div class="row header-row mb-7">
      <div class="col-12 position-relative p-0 header-container">
        <img class="main-background" src="/wp-content/uploads/aldea-header-background.jpg" alt="<?php _e('Que es La Aldea header background image','laaldea')?>">
        <img class="background-image" src="/wp-content/uploads/aldea-header-background-image.png" alt="<?php _e('Que es La Aldea header background image','laaldea')?>">
        <div class="content-container">
          <h1 class="title color-white">
            <div><?php _e('¿Qué es','laaldea');?></div>
            <div><?php _e('La Aldea?','laaldea');?></div>
          </h1>
        </div>
      </div>
    </div>
    <div class="row intro-row mb-7">
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 intro-text">
        <p class="h5 font-sassoon mb-5">
          <?php _e('La Aldea es una estrategia de educación multiplataforma que permite que niños ' . 
            'hasta los 14 años puedan aprender sobre sí mismos y sobre el mundo que los rodea. ' . 
            'A través de un universo de personajes, inspirado en nosotros mismos; de divertidas ' . 
            'historias, que son metáforas de la vida real, y de actividades, los niños juegan mientras ' . 
            'fortalecen sus habilidades lecto-escritoras, matemáticas, científicas, artísticas y ' . 
            'socioemocionales.', 'laaldea'); ?>
        </p>
      </div>
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 intro-text">
        <p class="h5 font-sassoon mb-5">
          <?php _e('La Aldea busca acompañar a familias, docentes e instituciones en la ' . 
            'implementación de procesos de educación flexibles, profundos y transformadores. ' . 
            'Los contenidos de La Aldea están diseñados para llegar a niños en todas partes y ' . 
            'son una estrategia para el mejoramiento de la calidad educativa.', 'laaldea'); ?>
        </p>
      </div>
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 intro-text">
        <p class="h5 font-sassoon mb-7">
          <?php _e('La Aldea está diseñada para que, a medida que los niños ingresan a un mundo ' . 
            'de fantasía seguro, despierten su curiosidad innata. Es un lugar donde se plantean ' . 
            'esas preguntas fundamentales, universales, tradicionales y atemporales que todos nos ' . 
            'hacemos más de una vez, mientras vamos aprendiendo a llevar una vida libre, consciente, ' . 
            'respetuosa y alegre.', 'laaldea'); ?>
        </p>
      </div>
      <div class="icons-container d-flex flex-wrap justify-content-center align-items-center">
        <div class="icon-container libros d-flex justify-content-around align-items-center">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-book.svg';?>
          <div class="name font-titan capitalized h4">
            <?php _e('Libros','laaldea')?>
          </div>
        </div>
        <div class="icon-container videos d-flex justify-content-around align-items-center">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-video.svg';?>
          <div class="name font-titan capitalized h4">
            <?php _e('Videos','laaldea')?>
          </div>
        </div> 
        <div class="flex-break"></div>
        <div class="icon-container radio d-flex justify-content-around align-items-center">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-radio.svg';?>
          <div class="name font-titan capitalized h4">
            <?php _e('Radio','laaldea')?>
          </div>
        </div>
        <div class="icon-container digital d-flex justify-content-around align-items-center">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-digital.svg';?>
          <div class="name font-titan capitalized h4">
            <?php _e('Digital','laaldea')?>
          </div>
        </div>
        <div class="flex-break"></div>
        <div class="icon-container canciones d-flex justify-content-around align-items-center">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-song.svg';?>
          <div class="name font-titan capitalized h4">
            <?php _e('Canciones','laaldea')?>
          </div>
        </div>
        <div class="icon-container tv d-flex justify-content-around align-items-center">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-tv.svg';?>
          <div class="name font-titan capitalized h4">
            <?php _e('T.V.','laaldea')?>
          </div>
        </div>
      </div>
    </div>
    <div class="row awards-row mb-7">
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 section-title mb-4">
        <div class="title-container position-relative">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-awards.svg';?>
          <h2 class="title-text color-orange h3"><?php _e('Premios', 'laaldea');?></span>
        </div>
      </div>
      <ul class="col-12 offset-0 px-5 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 award-texts mb-5">
        <li class="award-text mb-1">
          <?php _e('Ganadores del <span class="medium">Academic’s Choice Award - Smartbook</span> con <span class="medium">La Aldea</span> como la mejor estrategia transmedia de educación 2019.','laaldea')?>
        </li>
        <li class="award-text mb-1">
          <?php _e('Ganadores del <span class="medium">Latino Book Awards 2020</span> con La <span class="medium">Aldea: Historias para pensar el país</span> como el mejor libro capitulado juvenil.','laaldea')?>
        </li>
        <li class="award-text mb-1">
          <?php _e('Ganadores del <span class="medium">Latino Book Awards 2020</span> con La <span class="medium">Aldea: Historias para pensar el país</span> como el mejor audiolibro.','laaldea')?>
        </li>
        <li class="award-text mb-1">
          <?php _e('Ganadores <span class="medium">CREA DIGITAL 2020</span> con <span class="medium">La Aldea: Historias para estar en casa - Plataforma E-learning</span> como la mejor estrategia transmedia.','laaldea')?>
        </li>
        <li class="award-text mb-1">
          <?php _e('Premiados en HundrED y el BID (Banco Interamericano de Desarrollo) con <span class="medium">La Aldea: Historias para estar en casa</span> como una de las 15 mejores estrategias del siglo XXI en América Latina y el Caribe.','laaldea')?>
        </li>
      </ul>
      <div class="col-12 offset-0 px-3 col-sm-8 offset-sm-2 col-md-6 offset-md-3 px-sm-0 d-flex flex-wrap flex-sm-nowrap align-items-center justify-content-center justify-content-sm-between award-icons">
        <div class="px-3 my-3 my-sm-0"><img class="award-icon smart" src="/wp-content/uploads/aldea-premios-smart.jpg" alt="<?php _e('Imagen Smart Book award','laaldea');?>"></div>
        <div class="px-3 my-3 my-sm-0"><img class="award-icon hundred" src="/wp-content/uploads/aldea-premios-hundred.jpg" alt="<?php _e('Imagen hundrED award','laaldea');?>"></div>
        <div class="px-3 my-3 my-sm-0"><img class="award-icon latino" src="/wp-content/uploads/aldea-premios-latino.png" alt="<?php _e('Imagen Latino Book awards','laaldea');?>"></div>
        <div class="px-3 my-3 my-sm-0"><img class="award-icon idb" src="/wp-content/uploads/aldea-premios-idb.png" alt="<?php _e('Imagen IDB award','laaldea');?>"></div>
        <div class="px-3 my-3 my-sm-0"><img class="award-icon crea" src="/wp-content/uploads/aldea-premios-crea.png" alt="<?php _e('Imagen Crea Digital award','laaldea');?>"></div>
      </div>
    </div>
    <div class="row numeros-row mb-7">
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 section-title mb-5">
        <div class="title-container position-relative">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-numbers.svg';?>
          <h2 class="title-text color-orange h3"><?php _e('La Aldea en números', 'laaldea');?></span>
        </div>
      </div>
      <div class="col-12 section-content p-0">
        <img src="/wp-content/uploads/aldea-numeros-background.png" alt="<?php _e('La aldea en numeros background image', 'laaldea');?>">
        <div class="content-container h4 color-green text-center students">
          <div class="text-intro font-sassoon"><?php _e('Más de', 'laaldea');?></div>
          <div class="text-number"><?php _e('150.000', 'laaldea');?></div>
          <div class="text-about font-sassoon medium"><?php _e('Estudiantes', 'laaldea');?></div>
        </div>
        <div class="content-container h4 color-green text-center listeners">
          <div class="text-intro font-sassoon"><?php _e('Más de', 'laaldea');?></div>
          <div class="text-number"><?php _e('900.000', 'laaldea');?></div>
          <div class="text-about font-sassoon medium"><?php _e('Radioescuchas', 'laaldea');?></div>
        </div>
        <div class="content-container h4 color-green text-center teachers">
          <div class="text-intro font-sassoon"><?php _e('Más de', 'laaldea');?></div>
          <div class="text-number"><?php _e('5.000', 'laaldea');?></div>
          <div class="text-about font-sassoon medium"><?php _e('Docentes', 'laaldea');?></div>
        </div>
        <div class="content-container h4 color-green text-center institutions">
          <div class="text-intro font-sassoon"><?php _e('Más de', 'laaldea');?></div>
          <div class="text-number"><?php _e('550', 'laaldea');?></div>
          <div class="text-about font-sassoon medium"><?php _e('Instituciones</br>educativas', 'laaldea');?></div>
        </div>
      </div>
    </div>
    <div class="row map-row mb-7 d-none">
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 section-title mb-4">
        <div class="title-container position-relative">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-map.svg';?>
          <h2 class="title-text color-orange h3"><?php _e('¿Donde se implementa La Aldea?', 'laaldea');?></span>
        </div>
      </div>
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-8 offset-lg-2 section-content text-center p-0">
        <img src="/wp-content/uploads/aldea-map-image.jpg" alt="<?php _e('Donde se implementa La Aldea image', 'laaldea');?>">
      </div>
    </div>
    <div class="row allies-row mb-7">
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 section-title mb-4">
        <div class="title-container position-relative">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-allies.svg';?>
          <h2 class="title-text color-orange h3"><?php _e('Socios y aliados', 'laaldea');?></span>
        </div>
      </div>
      <div class="col-12 offset-0 px-3 col-lg-10 offset-lg-1 px-lg-0 d-flex flex-wrap align-items-center justify-content-between award-icons">
        <div class="slick-prev arrow">
          <i class="fas fa-angle-left"></i>
        </div>
        <div class="slick-next arrow">
          <i class="fas fa-angle-right"></i>
        </div>
        <div class="allies-carousel slider-container">
          <?php foreach($allies as $ally) :?>
            <div class="slide-container <?php echo $ally['class'];?> d-flex justify-content-center align-items-center">
              <img 
                class="ally-icon <?php echo $ally['class']?>" 
                src="<?php echo $ally['src']?>" 
                alt="<?php echo $ally['alt']?>">      
            </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
    <div class="row happens-row mb-3">
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 section-title mb-5">
        <div class="title-container position-relative">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-happens.svg';?>
          <h2 class="title-text color-orange h3"><?php _e('¿Qué sucede con La Aldea?', 'laaldea');?></span>
        </div>
      </div>
      <div class="col-12 section-content p-0">
        <img class="d-none d-md-block" src="/wp-content/uploads/aldea-happens-background.png" alt="<?php _e('Qué sucede con La Aldea background image', 'laaldea');?>">
        <img class="d-block d-md-none" src="/wp-content/uploads/aldea-happens-background-mobile.jpg" alt="<?php _e('Qué sucede con La Aldea background image', 'laaldea');?>">
        <ul class="content-container h3 d-flex flex-wrap d-md-block">
          <li class="kids mb-2 px-3 mb-xl-3 px-md-0">
            <div class="subtitle font-titan uppercase mb-2">
              <?php _e('Niños:', 'laaldea')?>
            </div>
            <ul class="inner-list">
              <li>
                <p><?php _e('Se divierten mientras aprenden y se empoderan de su proceso de aprendizaje.','laaldea');?></p>
              </li>
              <li>
                <p><?php _e('Conectan lo que aprenden con su cotidiano.','laaldea');?></p>
              </li>
              <li>
                <p><?php _e('Desarrollan habilidades lecto-escritoras, matemáticas, científicas, artísticas y socioemocionales.','laaldea');?></p>
              </li>
            </ul>
          </li>
          <li class="parents mb-2 px-3 mb-xl-3 px-md-0">
            <div class="subtitle font-titan uppercase mb-2">
              <?php _e('Padres de familia y cuidadores:', 'laaldea')?>
            </div>
            <ul class="inner-list">
              <li>
                <p><?php _e('Tienen una guía para desarrollar procesos de aprendizaje en casa.','laaldea');?></p>
              </li>
              <li>
                <p><?php _e('Se involucran en el aprendizaje de los niños.','laaldea');?></p>
              </li>
              <li>
                <p><?php _e('Entablan conversaciones significativas con sus hijos.','laaldea');?></p>
              </li>
            </ul>
          </li>
          <li class="teachers mb-2 px-3 mb-xl-3 px-md-0">
            <div class="subtitle font-titan uppercase mb-2">
              <?php _e('Docentes:', 'laaldea')?>
            </div>
            <ul class="inner-list">
              <li>
                <p><?php _e('Desarrollan su imaginación para la creación de clases significativas y divertidas.','laaldea');?></p>
              </li>
              <li>
                <p><?php _e('Aplican los estándares del Ministerio de Educación Nacional.','laaldea');?></p>
              </li>
              <li>
                <p><?php _e('Impulsan el aprendizaje transversal.','laaldea');?></p>
              </li>
            </ul>
          </li>
          <li class="organizations mb-2 px-3 mb-xl-3 px-md-0">
            <div class="subtitle font-titan uppercase mb-2">
              <?php _e('Organizaciones de cooperación, ONGS y Gobierno:', 'laaldea');?>
            </div>
            <ul class="inner-list">
              <li>
                <p><?php _e('Despliegan estrategias de educación a gran escala que impactan a docentes, niños y cuidadores.','laaldea');?></p>
              </li>
              <li>
                <p><?php _e('Responden a emergencias migratorias, sanitarias o desastres naturales a través de currículos flexibles y adaptados.','laaldea');?></p>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <div class="row gallery-row mb-7">
      <div class="col-12 section-content p-0 d-flex align-items-center justify-content-center">
        <div class="slick-prev arrow">
          <i class="fas fa-angle-left"></i>
        </div>
        <div class="slick-next arrow">
          <i class="fas fa-angle-right"></i>
        </div>
        <div class="carousel-container">
          <?php if( $image_gallery -> have_posts() ) : ?>
            <?php while ($image_gallery -> have_posts()) : ?>
              <?php 
                $image_gallery -> the_post();
                $post_id = get_the_ID();
              ?>
              <div class="figure-container">
                <figure>
                  <?php the_post_thumbnail( 'full');?>
                </figure>
              </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="row history-row mb-7">
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 section-title mb-4">
        <div class="title-container position-relative">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-history.svg';?>
          <h2 class="title-text color-orange h3"><?php _e('Historia de La Aldea', 'laaldea');?></span>
        </div>
      </div>
      <div class="col-12 offset-0 px-3 col-md-10 offset-md-1 col-xl-8 offset-xl-2 p-md-0 section-content mb-3">
        <img src="/wp-content/uploads/aldea-history-image.png" alt="<?php _e('Historia de La Aldea image', 'laaldea');?>">
      </div>
      <div class="col-12 text-center">
        <button class="load-more-button uppercase medium">
          <div><?php _e('Ver más')?></div>
          <div><i class="fas fa-chevron-down"></i></div>
        </button>
      </div>
    </div>
    <div class="row media-row mb-7">
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 section-title mb-4">
        <div class="title-container position-relative">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-media.svg';?>
          <h2 class="title-text color-orange h3"><?php _e('La Aldea en medios', 'laaldea');?></span>
        </div>
      </div>
      <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 section-quote h5 font-sassoon mb-7">
        <blockquote  class="quotation-text">
          <?php _e('“Usando los mismos recursos que implementó George Orwell en su obra ' . 
            '<em>La rebelión en la granja</em>, <em>La Aldea</em> se vale de los animales para contar ' . 
            'historias que den la oportunidad para pensar el país y sus desafíos. En síntesis, ' . 
            'es una metáfora de Colombia...”', 'laaldea');?>
        </blockquote >
        
        <div class="attribution-text bold text-right">
          <?php _e('PACIFISTA', 'laaldea');?>
        </div>
      </div>
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-xl-8 offset-xl-2 section-content d-flex flex-wrap align-items-center justify-content-around">
        <div class="slick-prev arrow">
          <i class="fas fa-angle-left"></i>
        </div>
        <div class="slick-next arrow">
          <i class="fas fa-angle-right"></i>
        </div>
        <?php laaldea_build_media_loop_html() ?>
      </div>
    </div>
    <div class="row click-row">
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 section-title mb-4">
        <div class="title-container position-relative">
          <?php include ABSPATH . '/wp-content/uploads/aldea-icons-intro-click.svg';?>
          <h2 class="title-text color-orange h3"><?php _e('¿Quién está detrás de La Aldea?', 'laaldea');?></span>
        </div>
      </div>
      <div class="col-12 offset-0 px-3 col-sm-10 offset-sm-1 px-sm-0 col-lg-6 offset-lg-3 section-intro">
        <p><?php _e('ClickArte es una agencia de pedagogía dedicada a imaginar nuevas formas de ' . 
          'aprender e implementar proyectos de educación. A través del arte, el diseño y la ' . 
          'pedagogía, nuestros productos y herramientas abren conversaciones para que niños y ' . 
          'adultos puedan indagar sobre ellos mismos y reflexionar sobre el mundo que ' . 
          'los rodea.', 'laaldea');?></p>
        <p><?php _e('A través de nuestros libros, juegos y recursos digitales, hemos impactado ' . 
          'a más de 150.000 estudiantes e inspirado a 5.000 docentes, en más de 500 ' . 
          'instituciones educativas en México y Colombia.','laaldea');?></p>
        <a href="http://clickarte.co/" target="_blank" rel="noopener noreferrer external">www.clickarte.co</a>
      </div>
    </div>
  </section>
</div>