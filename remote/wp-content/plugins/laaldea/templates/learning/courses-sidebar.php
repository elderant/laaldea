<div class="title-container d-flex align-items-center">
  <div class="icon-container"></div>
  <h4>Filtro</h4>
</div>
<div class="filters-container status-filter d-flex flex-column justify-content-between align-items-start">
  <button class="pending-status-filter-button py-3" data-filter="state-started">
    <img class="filter-image pending" src="/wp-content/uploads/courses-filter-pending.png" alt="<?php _e('Imagen filtrar por cursos pendientes','laaldea')?>">
    <span class="text-container h5 m-0 uppercase"><?php _e('En proceso','laaldea');?></span>
  </button>
  <button class="completed-status-filter-button pb-3" data-filter="state-completed">
    <span class="text-container h5 m-0 uppercase"><?php _e('Finalizados','laaldea');?></span>
  </button>
  <button class="completed-status-filter-button pb-3" data-filter="state-new">
    <span class="text-container h5 m-0 uppercase"><?php _e('Otros cursos','laaldea');?></span>
  </button>
</div>

<?php 
  $course_query = $laaldea_args['course_query'];
?>