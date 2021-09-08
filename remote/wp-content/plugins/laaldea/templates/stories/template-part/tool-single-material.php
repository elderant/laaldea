<?php 
  $post_id = $laaldea_args['post_id'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  $container_class = $laaldea_args['container_class'];
  $tool = $laaldea_args['tool'];
  $tool_youtube_id = $laaldea_args['tool_youtube_id'];
  $term_id = $laaldea_args['term_id'];
?>

<div class="<?php echo $container_class; ?>" data-postId="<?php echo $post_id?>" data-termId="<?php echo $term_id;?>" data-youtubeId="<?php echo $tool_youtube_id;?>">
  <div class="row mb-3">
    <div class="col-12 thumbnail-column">
      <div class="iframe-container">
        <iframe src="https://www.youtube.com/embed/<?php echo $tool_youtube_id?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>