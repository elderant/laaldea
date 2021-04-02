<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

?>

<h3><?php _e('Certificados de cursos', 'wpb_child'); ?></h3>

<div class="tutor-dashboard-content-inner">

	<?php
	$completed_courses = tutor_utils()->get_courses_by_user();

	if ($completed_courses && $completed_courses->have_posts()):
		while ($completed_courses->have_posts()):
			$completed_courses->the_post();

            $avg_rating = tutor_utils()->get_course_rating()->rating_avg;
            $tutor_course_img = get_tutor_course_thumbnail_src();
            ?>
            <div class="tutor-mycourse-wrap tutor-mycourse-<?php the_ID(); ?>">
                <img class="course-background-image" src="/wp-content/uploads/tools-single-background.png" alt="<?php _e('Course item background','wpb_child')?>">
                <div class="tutor-mycourse-thumbnail">
                  <img src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php _e('Imagen del curso', 'wpb_child')?>">
                </div>

                <div class="tutor-mycourse-content">
                    <div class="tutor-mycourse-rating"></div>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="tutor-mycourse-certificate-download h5 d-inline-block">
                      <?php laaldea_certificate_download_btn(); ?>
                    </div>
                </div>

            </div>

			<?php
		endwhile;

		wp_reset_postdata();

	else:
        echo "<div class='tutor-mycourse-wrap'><div class='tutor-mycourse-content'>".__('There\'s no completed course', 'tutor')."</div></div>";
	endif;

	?>
</div>
