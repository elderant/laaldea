<?php 
  $tools_template = $laaldea_args['tools_template'];
  $tools_class = $laaldea_args['tools_class'];

  $character_array = array(
    'opossum' => array(
      'class' => 'opossum',
      'src' => '/wp-content/uploads/stories-header-opossum.png',
      'img_alt' => __('Blue opossum image','laaldea'),
      'greet_text' => __('Hola soy la zariguiella azul','laaldea'),
      'text' => __('Soy la encargada de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'owl' => array(
      'class' => 'owl',
      'src' => '/wp-content/uploads/stories-header-owl.png',
      'img_alt' => __('The owls image','laaldea'),
      'greet_text' => __('Hola soy uno de los buhos','laaldea'),
      'text' => __('Somos los encargados de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'ant' => array(
      'class' => 'ant',
      'src' => '/wp-content/uploads/stories-header-ant.png',
      'img_alt' => __('The ants image','laaldea'),
      'greet_text' => __('Hola soy una de las hormigas','laaldea'),
      'text' => __('Somos las encargadas de de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'lucy' => array(
      'class' => 'lucy',
      'src' => '/wp-content/uploads/stories-header-lucy.png',
      'img_alt' => __('Lucy image','laaldea'),
      'greet_text' => __('Hola soy Lorena','laaldea'),
      'text' => __('Soy la encargada de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'ernest' => array(
      'class' => 'ernest',
      'src' => '/wp-content/uploads/stories-header-ernest.png',
      'img_alt' => __('Ernest image','laaldea'),
      'greet_text' => __('Hola soy Efren','laaldea'),
      'text' => __('Soy la encargada de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'arnold' => array(
      'class' => 'arnold',
      'src' => '/wp-content/uploads/stories-header-arnold.png',
      'img_alt' => __('Arnold image','laaldea'),
      'greet_text' => __('Hola soy Arnulfo','laaldea'),
      'text' => __('Soy la encargada de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'bee' => array(
      'class' => 'bee',
      'src' => '/wp-content/uploads/stories-header-bee.png',
      'img_alt' => __('The bees image','laaldea'),
      'greet_text' => __('Hola soy una de las abejas','laaldea'),
      'text' => __('Somos las encargadas de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'lia' => array(
      'class' => 'lia',
      'src' => '/wp-content/uploads/stories-header-lia.png',
      'img_alt' => __('Lia image','laaldea'),
      'greet_text' => __('Hola soy Inez','laaldea'),
      'text' => __('Soy la encargada de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'harry' => array(
      'class' => 'harry',
      'src' => '/wp-content/uploads/stories-header-harry.png',
      'img_alt' => __('Harry image','laaldea'),
      'greet_text' => __('Hola soy Enrique','laaldea'),
      'text' => __('Soy la encargada de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'moorhen' => array(
      'class' => 'moorhen',
      'src' => '/wp-content/uploads/stories-header-moorhen.png',
      'img_alt' => __('The moorhens image','laaldea'),
      'greet_text' => __('Hola soy una de las gallinetas','laaldea'),
      'text' => __('Somos las encargadas de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'carol' => array(
      'class' => 'carol',
      'src' => '/wp-content/uploads/stories-header-carol.png',
      'img_alt' => __('Carol image','laaldea'),
      'greet_text' => __('Hola soy Carmen','laaldea'),
      'text' => __('Soy la encargada de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'peter' => array(
      'class' => 'peter',
      'src' => '/wp-content/uploads/stories-header-peter.png',
      'img_alt' => __('Peter image','laaldea'),
      'greet_text' => __('Hola soy Paco','laaldea'),
      'text' => __('Soy la encargada de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'macaw' => array(
      'class' => 'macaw',
      'src' => '/wp-content/uploads/stories-header-macaw.png',
      'img_alt' => __('The macaws image','laaldea'),
      'greet_text' => __('Hola soy una de las guacamallas','laaldea'),
      'text' => __('Somos las encargadas de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
    'mouse' => array(
      'class' => 'mouse',
      'src' => '/wp-content/uploads/stories-header-mouse.png',
      'img_alt' => __('Mouse image','laaldea'),
      'greet_text' => __('Hola soy la el raton','laaldea'),
      'text' => __('Soy la encargada de sit amet consectetur adipisicing elit. Inventore est aperiam dolor id amet officiis hic impedit architecto beatae. Totam amet nam, veritatis natus quisquam doloribus atque deleniti dolorem voluptatem.','laaldea'),
    ),
  );
?>

<div id="stories" class="waiting-yt <?php echo $tools_class;?>">
  <section class="container-fluid">
    <div class="row header-row">
      <div class="col-12 position-relative p-0 characters-container">
        <img class="main-background" src="/wp-content/uploads/stories-header-background.png" alt="<?php _e('Background image','laaldea')?>">
        <div class="content-container color-white">
          <h2 class="title">
            <?php _e('¿Quiénes son los habitantes de La Aldea?','laaldea');?>
          </h2>
          <div class="subtitle uppercase">
            <?php _e('Pasa el cursor sobre cada personaje para averiguarlo','laaldea');?>
          </div>
        </div>
        <div class="character-texts-container color-white text-center">
          <?php foreach($character_array as $character) : ?>
            <div class="text-container <?php echo $character['class']?>">
              <div class="greet font-titan"><?php echo $character['greet_text']?></div>
              <div class="text"><?php echo $character['text']?></div>
            </div>
          <?php endforeach;?>
        </div>
        <div class="character-images">
          <img class="story-header-image plant plant1" src="/wp-content/uploads/stories-header-plant1.png" alt="<?php _e('Plant 4 image','laaldea')?>">
          <img class="story-header-image plant plant2" src="/wp-content/uploads/stories-header-plant2.png" alt="<?php _e('Plant 3 image','laaldea')?>">
          <img class="story-header-image plant plant3" src="/wp-content/uploads/stories-header-plant3.png" alt="<?php _e('Plant 4 image','laaldea')?>">
          <img class="story-header-image plant plant4" src="/wp-content/uploads/stories-header-plant4.png" alt="<?php _e('Plant 3 image','laaldea')?>">  
          <?php foreach($character_array as $character) : ?>
            <img class="story-header-image char <?php echo $character['class']?>" 
              src="<?php echo $character['src']?>" 
              alt="<?php echo $character['img_alt']?>" 
              data-text="<?php echo $character['class']?>">
          <?php endforeach;?>
        </div>
      </div>
    </div>
 
    <div class="row main-row">
      <div class="col-12 offset-0 order-2 col-lg-3 offset-lg-0 order-lg-1 col-xl1-3 offset-xl1-0 col-xl-2 offset-xl-1 filters-column">
        <div class="tools-sidebar-container" data-top="240">
          <div class="title-container d-flex align-items-center color-green mb-3">
            <h4><?php _e('Recursos','laaldea');?></h4>
          </div>
          <div class="filters-container book d-flex flex-column justify-content-between align-items-start py-3">
            <div class="filter-title">
              <button class="filter-control d-flex align-items-center justify-content-start color-green">
                <div class="filter-text d-flex align-items-center">
                  <span class="h6 m-0 uppercase color-cyan font-sassoon filter-control-name"><?php _e('Por libro','laaldea');?></span>
                </div>
                <div class="filter-icon h6 m-0 color-cyan font-sassoon">
                  <span class="icon">+</span>
                  <span class="icon hidden">-</span>
                </div>
              </button>
            </div>
            <?php foreach($laaldea_args['book_terms'] as $book_term) : ?>
              <div class="term-container hidden pb-1 term-<?php echo $book_term -> term_id; ?>">
                <button class="" data-termId="<?php echo $book_term -> term_id?>">
                  <span class="term-name font-sassoon"><?php echo $book_term -> name?></span>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="filters-container topic d-flex flex-column justify-content-between align-items-start py-3">
            <div class="filter-title d-flex align-items-center">
              <button class="filter-control d-flex align-items-center justify-content-start color-green">
                <div class="filter-text d-flex align-items-center">
                  <span class="h6 m-0 uppercase color-cyan font-sassoon filter-control-name"><?php _e('Por recurso','laaldea');?></span>
                </div>
                <div class="filter-icon h6 m-0 color-cyan font-sassoon">
                  <span class="icon">+</span>
                  <span class="icon hidden">-</span>
                </div>
              </button>
            </div>
            <?php foreach($laaldea_args['topic_terms'] as $topic_terms) : ?>
              <div class="term-container hidden pb-1 term-<?php echo $topic_terms -> term_id?>">
                <button class="" data-termId="<?php echo $topic_terms -> term_id?>">
                  <span class="term-name"><?php echo $topic_terms -> name?></span>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="filters-container tags tag-cloud-container py-3">
            <div class="filter-title d-flex align-items-center">
              <button class="filter-control d-flex align-items-center justify-content-start color-green mb-3">
                <div class="filter-text d-flex align-items-center">
                  <span class="h4 m-0 uppercase color-cyan filter-control-name"><?php _e('Etiquetas','laaldea');?></span>
                </div>
              </button>
            </div>
            <div class="tag-container term-container pt-3">
              <?php 
                $args = array('taxonomy' => array( 'aldea_tool_tag' )); 
                wp_tag_cloud( $args );
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 offset-0 order-1 col-lg-9 offset-lg-0 order-lg-2 col-xl1-9 offset-xl1-0 col-xl-8 content-column">
        <div class="type-filter-container">
          <div class="type-filters-section d-flex align-items-center justify-content-start">
            <div class="filter-label h5 uppercase font-titan color-green m-0"><?php _e('¿Qué quieres ', 'laaldea');?></div>
            <select class="type-select color-green uppercase m-0">
              <option class="uppercase" value="libro">Leer</option>
              <option class="uppercase" value="video">Ver</option>
              <option class="uppercase" value="audio">Escuchar</option>
            </select>
            <div class="filter-label h5 uppercase font-titan color-green m-0"><?php _e(' ?', 'laaldea');?></div>
          </div>
        </div>
        
        <div class="main-container mt-5">
          <?php laaldea_build_stories_loop_html($tools_template, true);?>
        </div>
      </div>
    </div>
  </section>
</div>