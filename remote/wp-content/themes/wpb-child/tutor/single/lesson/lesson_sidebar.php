
<?php
/**
 * Display Topics and Lesson lists for learn
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

global $post;

$currentPost = $post;

$course_id = 0;
if ($post->post_type === 'tutor_quiz'){
	$course = tutor_utils()->get_course_by_quiz(get_the_ID());
	$course_id = $course->ID;
} elseif ($post->post_type === 'tutor_assignments'){
	$course_id = get_post_meta($post->ID, '_tutor_course_id_for_assignments', true);
} elseif ($post->post_type === 'tutor_zoom_meeting'){
	$course_id = get_post_meta($post->ID, '_tutor_zm_for_course', true);
} else {
	$course_id = get_post_meta($post->ID, '_tutor_course_id_for_lesson', true);
}
$disable_qa_for_this_course = get_post_meta($course_id, '_tutor_disable_qa', true);
$enable_q_and_a_on_course = tutor_utils()->get_option('enable_q_and_a_on_course') && $disable_qa_for_this_course != 'yes';

$completed_count = tutor_utils()->get_course_completed_percent($course_id);

$course_duration = get_tutor_course_duration_context($course_id);
$count = laaldea_tutor_get_topic_count($course_id);
$course_modules = sprintf( _n( '%s Módulo', '%s Módulos', $count, 'laaldea' ), number_format_i18n( $count ) );
?>

<?php do_action('tutor_lesson/single/before/lesson_sidebar'); ?>

  <div class="lesson-container">
    <div class="tutor-single-lesson-segment tutor-lesson-thumbnail">
      <a href="<?php echo get_the_permalink($course_id); ?>" class="tutor-sidebar-home-btn">
        <?php laaldea_get_tutor_course_thumbnail( 'medium', false, $course_id );?>
      </a>
    </div>
    <div class="tutor-single-lesson-segment tutor-lesson-loop-meta">
      <div class="row">
        <?php if(!empty($course_duration)) : ?>
          <div class="col-6 meta-container duration-container">
            <div class="tutor-single-loop-meta font-titan">
              <img src="/wp-content/uploads/courses-duration-image.png" alt="<?php _e('Imagen indicador duración','laaldea')?>"><span><?php echo $course_duration;?></span>
            </div>
          </div>
        <?php endif; ?>
        <div class="col-6 meta-container modulos-container">
          <div class="tutor-single-loop-meta font-titan">
            <img src="/wp-content/uploads/courses-modules-image.png" alt="<?php _e('Imagen indicador modulos','laaldea')?>"><span><?php echo $course_modules; ?></span>
          </div>
        </div>  
      </div>
    </div>

    <div class="tutor-single-lesson-segment tutor-sidebar-tabs-wrap tutor-lesson-list">
      <div class="tutor-tabs-btn-group list-header">
        <a href="#tutor-lesson-sidebar-tab-content" class="h5 color-cyan <?php echo $enable_q_and_a_on_course ? "active" : ""; ?>">
          <span><?php esc_html_e('Estructura del curso', 'laaldea'); ?></span>
        </a>
        <?php if($enable_q_and_a_on_course) : ?>
          <a href="#tutor-lesson-sidebar-qa-tab-content" class="h5 color-cyan"> 
            <span><?php esc_html_e('FAQ', 'tutor'); ?></span>
          </a>
        <?php endif;?>
      </div>
  
      <div class="tutor-sidebar-tabs-content">
        <div id="tutor-lesson-sidebar-tab-content" class="tutor-lesson-sidebar-tab-item list-content">
          <?php
          $topics = tutor_utils()->get_topics($course_id);
          if ($topics->have_posts()){
            while ($topics->have_posts()){ $topics->the_post();
              $topic_id = get_the_ID();
              $topic_summery = get_the_content();
              ?>
              <div class="tutor-topics-in-single-lesson tutor-topics-<?php echo $topic_id; ?>">
                <div class="tutor-topics-title <?php echo $topic_summery ? 'has-summery' : ''; ?>">
                  <h3>
                    <?php 
                      the_title();
                      if($topic_summery) {
                        echo "<span class='toogle-informaiton-icon'>&quest;</span>";
                      }
                    ?>
                  </h3>
                  <button class="tutor-single-lesson-topic-toggle"><i class="tutor-icon-plus"></i></button>
                </div>
                <?php if ($topic_summery) : ?>
                  <div class="tutor-topics-summery">
                    <?php echo $topic_summery; ?>
                  </div>
                <?php endif; ?>
      
                <div class="tutor-lessons-under-topic" style="display: none">
                  <?php
                    do_action('tutor/lesson_list/before/topic', $topic_id);
        
                    $lessons = tutor_utils()->get_course_contents_by_topic(get_the_ID(), -1);
                    if ($lessons->have_posts()){
                      while ($lessons->have_posts()){
                        $lessons->the_post();
        
                        if ($post->post_type === 'tutor_quiz') {
                          $quiz = $post;
                          ?>
                          <div class="tutor-single-lesson-items quiz-single-item quiz-single-item-<?php echo $quiz->ID; ?> <?php echo ( $currentPost->ID === get_the_ID() ) ? 'active' : ''; ?>" data-quiz-id="<?php echo $quiz->ID; ?>">
                              <a href="<?php echo get_permalink($quiz->ID); ?>" class="sidebar-single-quiz-a" data-quiz-id="<?php echo $quiz->ID; ?>">
                                  <i class="tutor-icon-doubt"></i>
                                  <span class="lesson_title"><?php echo $quiz->post_title; ?></span>
                                  <span class="tutor-lesson-right-icons">
                                  <?php
                                  do_action('tutor/lesson_list/right_icon_area', $post);
        
                                  $time_limit = tutor_utils()->get_quiz_option($quiz->ID, 'time_limit.time_value');
                                  if ($time_limit){
                                    $time_type = tutor_utils()->get_quiz_option($quiz->ID, 'time_limit.time_type');
                                    //echo "<span class='quiz-time-limit'>{$time_limit} {$time_type}</span>";
                                  }
                                  ?>
                                  </span>
                              </a>
                          </div>
                          <?php
                        }elseif($post->post_type === 'tutor_assignments'){
                          /**
                           * Assignments
                           * @since this block v.1.3.3
                           */
        
                          ?>
                            <div class="tutor-single-lesson-items assignments-single-item assignment-single-item-<?php echo $post->ID; ?> <?php echo ( $currentPost->ID === get_the_ID() ) ? 'active' : ''; ?>"
                                  data-assignment-id="<?php echo $post->ID; ?>">
                                <a href="<?php echo get_permalink($post->ID); ?>" class="sidebar-single-assignment-a" data-assignment-id="<?php echo $post->ID; ?>">
                                    <i class="tutor-icon-clipboard"></i>
                                    <span class="lesson_title"> <?php echo $post->post_title; ?> </span>
                                    <span class="tutor-lesson-right-icons">
                                        <?php do_action('tutor/lesson_list/right_icon_area', $post); ?>
                                    </span>
                                </a>
                            </div>
                          <?php
        
                        }elseif($post->post_type === 'tutor_zoom_meeting'){
                          /**
                           * Zoom Meeting
                           * @since this block v.1.7.1
                           */
        
                          ?>
                          <div class="tutor-single-lesson-items zoom-meeting-single-item zoom-meeting-single-item-<?php echo $post->ID; ?> <?php echo ( $currentPost->ID === get_the_ID() ) ? 'active' : ''; ?>"
                                data-assignment-id="<?php echo $post->ID; ?>">
                              <a href="<?php echo get_permalink($post->ID); ?>" class="sidebar-single-zoom-meeting-a">
                              <i class="zoom-icon"><img src="<?php echo TUTOR_ZOOM()->url; ?>assets/images/zoom-icon-grey.svg"></i>
                                  <span class="lesson_title"> <?php echo $post->post_title; ?> </span>
                                  <span class="tutor-lesson-right-icons">
                                      <?php do_action('tutor/lesson_list/right_icon_area', $post); ?>
                                  </span>
                              </a>
                          </div>
                          
                          <?php
        
                        } else {
        
                          /**
                           * Lesson
                           */
        
                          $video = tutor_utils()->get_video_info();
        
                          $play_time = false;
                          if ( $video ) {
                            $play_time = $video -> playtime;
                          }
                          $is_completed_lesson = tutor_utils()->is_completed_lesson();
                          ?>
        
                          <div class="tutor-single-lesson-items <?php echo ( $currentPost->ID === get_the_ID() ) ? 'active' : ''; ?>">
                              <a href="<?php the_permalink(); ?>" class="tutor-single-lesson-a" data-lesson-id="<?php the_ID(); ?>">
                                <?php
                                  $tutor_lesson_type_icon = $play_time ? 'youtube' : 'document';
                                  echo "<i class='tutor-icon-$tutor_lesson_type_icon'></i>";
                                ?>
                                <span class="lesson_title"><?php the_title(); ?></span>
                                <span class="tutor-lesson-right-icons">
                                  <?php
                                  do_action('tutor/lesson_list/right_icon_area', $post);
                                  if ( $play_time ) {
                                    //echo "<i class='tutor-play-duration'>".tutor_utils()->get_optimized_duration($play_time)."</i>";
                                  }
                                  $lesson_complete_icon = $is_completed_lesson ? 'tutor-icon-mark tutor-done' : '';
                                  echo "<i class='tutor-lesson-complete $lesson_complete_icon'></i>";
                                  ?>
                                </span>
                              </a>
                          </div>
        
                        <?php
                        }
                      }
                    $lessons->reset_postdata();
                    } 
                  ?>
      
                  <?php do_action('tutor/lesson_list/after/topic', $topic_id); ?>
                </div>
              </div>
      
          <?php
            }
            $topics->reset_postdata();
            wp_reset_postdata();
          } 
          ?>
        </div>
    
        <div id="tutor-lesson-sidebar-qa-tab-content" class="tutor-lesson-sidebar-tab-item" style="display: none;">
          <?php
            tutor_lesson_sidebar_question_and_answer();
          ?>
        </div>
      </div>
    </div>
    
    <?php if($completed_count > 0) : ?>
      <div class="tutor-single-lesson-segment tutor-course-completion-percent">
        <label class="font-titan color-cyan">
          <?php _e('Avance','laaldea');?>
        </label>
        <div class="percent-container font-titan">
          <?php echo sprintf("%s%%", $completed_count )?>
        </div> 
      </div>
    <?php endif; ?>
  </div>

<?php do_action('tutor_lesson/single/after/lesson_sidebar'); ?>