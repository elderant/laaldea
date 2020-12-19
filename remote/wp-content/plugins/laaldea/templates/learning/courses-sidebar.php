<div class="filters-container status-filter d-flex flex-column justify-content-between align-items-start">
  <button class="pending-status-filter-button py-3" data-filter="state-started">
    <img class="filter-image pending" src="/wp-content/uploads/courses-filter-pending.png" alt="<?php _e('Imagen filtrar por cursos pendientes','laaldea')?>">
    <span class="text-container h6 font-titan"><?php _e('En proceso','laaldea');?></span>
  </button>
  <button class="completed-status-filter-button pb-3" data-filter="state-completed">
    <img class="filter-image completed" src="/wp-content/uploads/courses-filter-completed.png" alt="<?php _e('Imagen filtrar por cursos competados','laaldea')?>">
    <span class="text-container h6 font-titan"><?php _e('Finalizados','laaldea');?></span>
  </button>
  <button class="completed-status-filter-button pb-3" data-filter="state-new">
    <img style="width: 50px; height: 50px;" class="filter-image completed" src="/wp-content/uploads/tools-filter-pdf.png" alt="<?php _e('Imagen filtrar por cursos no empezados','laaldea')?>">
    <span class="text-container h6 font-titan"><?php _e('Otros cursos','laaldea');?></span>
  </button>
</div>

<?php 
  $course_query = $laaldea_args['course_query'];
?>