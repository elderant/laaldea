<?php 
  $tools_template = $laaldea_args['tools_template'];
  $filterStr = $laaldea_args['filterStr'];
  $tools_template_str = laaldea_tools_get_tools_template_str($tools_template);
?>
<div class="tool-notice">
  <?php 
    printf( wp_kses( 
      __( 'No tenemos <span class="color-green medium uppercase">%s</span> de <span class="color-green medium uppercase">%s</span>', 'laaldea' ), 
      array( 'span' => array( 'class' => array() ) ) ), 
      $tools_template_str,$filterStr);
  ?>
</div>