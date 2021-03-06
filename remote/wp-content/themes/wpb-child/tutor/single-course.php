<?php
/**
 * Template for displaying single course
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

get_header('learning');
$course_duration = get_tutor_course_duration_context();
$count = laaldea_tutor_get_topic_count();
$course_modules = sprintf( _n( '%s Módulo', '%s Módulos', $count, 'laaldea' ), number_format_i18n( $count ) );

$title_html = get_field( 'title_html' );
$title = empty($title_html) ? get_the_title() : $title_html;
?>

<div id="sidebar-main" class="col-12 offset-0 order-2 col-sm-10 offset-sm-1 col-lg-4 offset-lg-0 order-lg-1 col-xl1-4 offset-xl1-0 col-xl-3 offset-xl-1 course-sidebar">
  <div class="tutor-container">
    <div class="tutor-row">
      <div class="tutor-col-12 course-container">
        <div class="tutor-single-course-segment tutor-course-thumbnail">
          <?php get_tutor_course_thumbnail( 'medium' );?>
        </div>
        <div class="tutor-single-course-segment tutor-course-loop-meta">
          <div class="row">
            <?php if(!empty($course_duration)) : ?>
              <div class="col-6 col-xl1-12 col-xl-6 meta-container duration-container p m-0">
                <div class="tutor-single-loop-meta font-titan">
                  <img src="/wp-content/uploads/courses-duration-image.png" alt="<?php _e('Imagen indicador duración','laaldea')?>"><span><?php echo $course_duration;?></span>
                </div>
              </div>
            <?php endif; ?>
            <div class="col-6 col-xl1-12 col-xl-6 meta-container modulos-container p m-0">
              <div class="tutor-single-loop-meta font-titan">
                <img src="/wp-content/uploads/courses-modules-image.png" alt="<?php _e('Imagen indicador modulos','laaldea')?>"><span><?php echo '$course_modules'; ?></span>
              </div>
            </div>  
          </div>
        </div>
        <?php /*tutor_course_content();*/ ?>
        <?php tutor_course_topics();?>
      </div>
    </div>
  </div>
</div>

<?php do_action('tutor_course/single/before/wrap'); ?>
<div <?php tutor_post_class('col-12 offset-0 order-1 col-sm-10 offset-sm-1 col-lg-8 offset-lg-0 order-lg-2 col-xl1-8 offset-xl1-0 col-xl-7 tutor-full-width-course-top tutor-course-top-info tutor-page-wrap course-section'); ?>>
    <div class="tutor-container">
        <div class="tutor-row">
            <div class="tutor-col-12 tutor-col-md-100">
	            <?php do_action('tutor_course/single/before/inner-wrap'); ?>
              
              <div class="tutor-single-course-title mb-5">
                <?php do_action('tutor_course/single/title/before'); ?>
                <div class="before-title font-titan h2 m-0"><?php _e('Curso: ','laaldea');?></div>
                <h2 class="color-cyan"><?php echo $title; ?></h2>
                <?php do_action('tutor_course/single/title/after'); ?>
              </div>
              
              <div class="tutor-single-course-body mb-5">
                <img class="tutor-single-course-background-image" src="/wp-content/uploads/tools-single-background.png" alt="<?php _e('Tool item background','laaldea')?>">
                <div class="row">
                  <div class="col-5">
                    <?php
                      $disable_course_author = get_tutor_option('disable_course_author');
                      $disable_course_level = get_tutor_option('disable_course_level');
                      $disable_course_share = get_tutor_option('disable_course_share');
                    ?>
                    <?php if ( !$disable_course_author) : ?>
                      <div class="tutor-single-course-author-meta pb-4">
                        <div class="tutor-single-course-author-name">
                          <span><?php _e('Profesor: ', 'tutor'); ?></span>
                          <a href="<?php echo tutor_utils()->profile_url($authordata->ID); ?>"><?php echo get_the_author(); ?></a>
                        </div>
                      </div>
                    <?php endif; ?>
    
                    <?php if ( !$disable_course_level) : ?>
                      <div class="tutor-course-level pb-4">
                        <strong><?php _e('Course level:', 'tutor'); ?></strong>
                        <?php echo get_tutor_course_level(); ?>
                      </div>
                    <?php endif; ?>
    
                    <?php laaldea_course_benefits_html(); ?>
                  </div>
  
                  <div class="col-12 intro-video-column">
                    <div class="tutor-price-box-thumbnail">
                      <?php
                      if(tutor_utils()->has_video_in_single()){
                        tutor_course_video();
                      } else{
                        get_tutor_course_thumbnail();
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="tutor-single-course-body">
                <?php
                  $excerpt = tutor_get_the_excerpt();
                    $disable_about = get_tutor_option('disable_course_about');
                  if (! empty($excerpt) && ! $disable_about){
                    ?>
                        <div class="tutor-course-summery">
                            <h4  class="tutor-segment-title"><?php esc_html_e('About Course', 'tutor') ?></h4>
                      <?php echo $excerpt; ?>
                        </div>
                    <?php
                  }
                ?>
                <?php tutor_course_content(); ?>
                <?php tutor_course_requirements_html(); ?>
                <?php tutor_course_tags_html(); ?>
                <?php tutor_course_target_audience_html(); ?>
                <?php tutor_course_material_includes_html(); ?>
              </div>

              <?php laaldea_course_enroll_button(); ?>
            </div>
        </div>
    </div>
</div>

<?php do_action('tutor_course/single/after/wrap'); ?>

<?php
get_footer('learning');
