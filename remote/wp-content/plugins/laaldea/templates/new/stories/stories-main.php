<?php 
  $tools_template = $laaldea_args['tools_template'];
  $tools_class = $laaldea_args['tools_class'];

  $character_array = array(
    'opossum' => array(
      'class' => 'opossum disabled',
      'src' => '/wp-content/uploads/stories-header-opossum.png',
      'img_alt' => __('Blue opossum image','laaldea'),
      'greet_text' => '',
      'text' => '',
    ),
    'owl' => array(
      'class' => 'owl',
      'src' => '/wp-content/uploads/stories-header-owl.png',
      'img_alt' => __('The owls image','laaldea'),
      'greet_text' => __('Los búhos','laaldea'),
      'text' => __('¡Hola! Somos los búhos y tenemos varias labores dentro de La Aldea. Estamos encargados de la educación de los más chicos, uno de los trabajos más importantes en la comunidad, y nos encargamos de las labores de investigación científica.','laaldea'),
    ),
    'ant' => array(
      'class' => 'ant',
      'src' => '/wp-content/uploads/stories-header-ant.png',
      'img_alt' => __('The ants image','laaldea'),
      'greet_text' => __('Las hormigas','laaldea'),
      'text' => __('Buenos días, no tenemos mucho tiempo porque estamos trabajando. Nos presentamos: somos las hormigas, seguimos las órdenes al pie de la letra. ¡Sí, señor! Somos muy organizadas y eficientes. ¡A marchar! Y uno y dos y tres.','laaldea'),
    ),
    'lucy' => array(
      'class' => 'lucy',
      'src' => '/wp-content/uploads/stories-header-lucy.png',
      'img_alt' => __('Lucy image','laaldea'),
      'greet_text' => __('Lorena, la tortuga','laaldea'),
      'text' => __('Me llamo Lorena y soy la tortuga líder de La Aldea. Mi labor me exige tomar las decisiones más importantes y considerar el bienestar de todos los animales. Mi interés es que siempre actuemos como una comunidad y permanezcamos juntos.','laaldea'),
    ),
    'ernest' => array(
      'class' => 'ernest',
      'src' => '/wp-content/uploads/stories-header-ernest.png',
      'img_alt' => __('Ernest image','laaldea'),
      'greet_text' => __('Efrén el tapir','laaldea'),
      'text' => __('Me llamo Efrén, soy un tapir guapo y poderoso. Mi padre fue uno de los grandes fundadores de La Aldea. Gracias a él y a nuestro linaje de tapires, este lugar está en pie. ¡Me siento muy orgulloso de eso y de todo lo que hago para que La Aldea vuelva a ser tan grandiosa como lo era antes!','laaldea'),
    ),
    'arnold' => array(
      'class' => 'arnold',
      'src' => '/wp-content/uploads/stories-header-arnold.png',
      'img_alt' => __('Arnold image','laaldea'),
      'greet_text' => __('Arnulfo, la zarigüeya','laaldea'),
      'text' => __('¡Hola! Soy Arnulfo, una zarigüeya ágil e inteligente. Me gusta llevar siempre la ventaja y por eso a veces, solo a veces, rompo las reglas. Pero ¡sshhh! No le digan a nadie.','laaldea'),
    ),
    'bee' => array(
      'class' => 'bee',
      'src' => '/wp-content/uploads/stories-header-bee.png',
      'img_alt' => __('The bees image','laaldea'),
      'greet_text' => __('Las abejas','laaldea'),
      'text' => __('¡Buen día! Somos las abejas, meteorólogas de La Aldea. Nuestro interés principal es la protección del medioambiente y la producción de nuestra deliciosa miel. ¡Se dice que la miel de La Aldea es la mejor del mundo!','laaldea'),
    ),
    'lia' => array(
      'class' => 'lia',
      'src' => '/wp-content/uploads/stories-header-lia.png',
      'img_alt' => __('Lia image','laaldea'),
      'greet_text' => __('Inés, la jaiba','laaldea'),
      'text' => __('¡Ajá! Me llamo Inés y soy una jaiba. No me gusta mucho estar con los demás, prefiero andar sola y hacer las cosas como a mí me parece. La verdad es que ni sé qué hago aquí, hablándoles a ustedes… ¡Chao!','laaldea'),
    ),
    'harry' => array(
      'class' => 'harry',
      'src' => '/wp-content/uploads/stories-header-harry.png',
      'img_alt' => __('Harry image','laaldea'),
      'greet_text' => __('Enrique, el camaleón','laaldea'),
      'text' => __('Soy Enrique, el camaleón. Llegué a La Aldea hace poco, después de perder mi hogar por un derrumbe. Mi color normal es verde, cuando me siento feliz me pongo amarillo y cuando tengo miedo, me pongo morado.','laaldea'),
    ),
    'moorhen' => array(
      'class' => 'moorhen',
      'src' => '/wp-content/uploads/stories-header-moorhen.png',
      'img_alt' => __('The moorhens image','laaldea'),
      'greet_text' => __('Las gallinetas','laaldea'),
      'text' => __('Somos las gallinetas. Siempre andamos juntas y preferimos meter la cabeza en la tierra, antes que ponernos en situaciones de peligro. ¿Ya terminamos? ¿Podemos escondernos? ¡Hasta luego!','laaldea'),
    ),
    'carol' => array(
      'class' => 'carol',
      'src' => '/wp-content/uploads/stories-header-carol.png',
      'img_alt' => __('Carol image','laaldea'),
      'greet_text' => __('Carmen, la osa de anteojos','laaldea'),
      'text' => __('Hola, soy Carmen, la única osa de anteojos que hay en La Aldea, también soy la más grande de todos los animales de aquí. Creo que lo más importante es ser respetuosos con las opiniones y pensamientos de los demás y no pasar nunca por encima de otros.','laaldea'),
    ),
    'peter' => array(
      'class' => 'peter',
      'src' => '/wp-content/uploads/stories-header-peter.png',
      'img_alt' => __('Peter image','laaldea'),
      'greet_text' => __('Paco, el puercoespín','laaldea'),
      'text' => __('¡Hola! Soy Paco, un puercoespín justo y responsable. Lo que más me interesa es que las cosas en La Aldea se hagan de forma transparente y equitativa. Por eso, me enojo con mucha facilidad cuando hacen trampa o cuando benefician a unos por encima de otros. ¡Eso no es lo correcto!','laaldea'),
    ),
    'macaw' => array(
      'class' => 'macaw',
      'src' => '/wp-content/uploads/stories-header-macaw.png',
      'img_alt' => __('The macaws image','laaldea'),
      'greet_text' => __('Las guacamayas','laaldea'),
      'text' => __('¡Pruaaa, pruaaa! Somos las guacamayas, las reporteras de La Aldea. Nos gusta meter el pico en todo lo que pasa alrededor para mantener informados a los aldeanos. ¡Si no hay noticias, las buscamos hasta que las encontramos!','laaldea'),
    ),
    'mouse' => array(
      'class' => 'mouse',
      'src' => '/wp-content/uploads/stories-header-mouse.png',
      'img_alt' => __('Mouse image','laaldea'),
      'greet_text' => __('Los ratones','laaldea'),
      'text' => __('¡Hola!, por fin nos conocemos... Los ratones somos los encargados de la limpieza en La Aldea y, aunque llevemos haciendo esto por mucho tiempo, nadie se daba cuenta. Algunos animales creen que somos sucios, pero en realidad somos de los habitantes más limpios y ordenados en La Aldea. Quizás, si se dieran la oportunidad de conocernos, se sorprenderían mucho.','laaldea'),
    ),
  );
?>

<div id="stories" class="waiting-yt <?php echo $tools_class;?>">
  <section class="container-fluid">
    <div class="row header-row mb-5">
      <div class="col-12 position-relative p-0 characters-container">
        <img class="main-background" src="/wp-content/uploads/stories-header-background.jpg" alt="<?php _e('Background image','laaldea')?>">
        <div class="background-images-container">
          <img class="story-header-image plant plant1" src="/wp-content/uploads/stories-header-plant1.png" alt="<?php _e('Plant 4 image','laaldea')?>">
          <img class="story-header-image plant plant2" src="/wp-content/uploads/stories-header-plant2.png" alt="<?php _e('Plant 3 image','laaldea')?>">
          <img class="story-header-image plant plant3" src="/wp-content/uploads/stories-header-plant3.png" alt="<?php _e('Plant 4 image','laaldea')?>">
          <img class="story-header-image plant plant4" src="/wp-content/uploads/stories-header-plant4.png" alt="<?php _e('Plant 3 image','laaldea')?>">      
        </div>
        <div class="slick-prev arrow d-block d-lg-none">
          <i class="fas fa-angle-left"></i>
        </div>
        <div class="slick-next arrow d-block d-lg-none">
          <i class="fas fa-angle-right"></i>
        </div>
        <div class="single-characters-container slider-container">
          <?php foreach($character_array as $character) : ?>
            <div class="character-container container-<?php echo $character['class']?>">
              <div class="character-text-container color-white text-left">
                <div class="text-container <?php echo $character['class']?>">
                  <div class="greet font-titan"><?php echo $character['greet_text']?></div>
                  <div class="text"><?php echo $character['text']?></div>
                </div>
              </div>
              <img class="story-header-image char <?php echo $character['class']?>" 
                src="<?php echo $character['src']?>" 
                alt="<?php echo $character['img_alt']?>" 
                data-text="<?php echo $character['class']?>">
            </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
 
    <div class="row main-row">
      <div class="col-12 offset-0 order-2 col-lg-3 offset-lg-0 order-lg-1 col-xl1-3 offset-xl1-0 col-xl-2 offset-xl-1 filters-column">
        <div class="tools-sidebar-container" data-top="240">
          <div class="title-container d-flex align-items-center justify-content-center justify-content-lg-start uppercase color-green mb-3">
            <h5><?php _e('Recursos','laaldea');?></h5>
          </div>
          <div class="filters-container topic d-flex flex-column justify-content-between align-items-center align-items-lg-start pb-3">
            <?php foreach($laaldea_args['topic_terms'] as $topic_terms) : ?>
              <div class="term-container pb-1 term-<?php echo $topic_terms -> term_id?>">
                <button class="" data-termId="<?php echo $topic_terms -> term_id?>">
                  <span class="term-name"><?php echo $topic_terms -> name?></span>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="col-12 offset-0 mb-3 pb-3 order-1 col-lg-9 offset-lg-0 order-lg-2 mb-lg-0 pb-lg-0 col-xl1-9 offset-xl1-0 col-xl-8 content-column">
        <div class="title-container color-green mb-5">  
          <h1 class="title mb-2"><?php _e('Historias y recursos','laaldea');?></h1>
        </div>

        <div class="type-filter-container">
          <div class="type-filters-section d-flex align-items-center justify-content-start">
            <div class="filter-label h5 font-titan color-green m-0"><?php _e('¿Qué quieres ', 'laaldea');?></div>
            <select class="type-select color-green m-0">
              <option class="" value="libro"<?php echo $tools_template == 'libro'? ' selected': '';?>>Leer</option>
              <option class="" value="video"<?php echo $tools_template == 'video'? ' selected': '';?>>Ver</option>
              <option class="" value="audio"<?php echo $tools_template == 'audio'? ' selected': '';?>>Escuchar</option>
            </select>
            <div class="filter-label h5 font-titan color-green m-0"><?php _e(' ?', 'laaldea');?></div>
          </div>
        </div>
        
        <?php laaldea_build_stories_loop_html($tools_template, true);?>
      </div>
    </div>
  </section>
</div>