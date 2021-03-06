<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

global $post;
$currentPost = $post;

$course = tutor_utils()->get_course_by_quiz(get_the_ID());
$previous_attempts = tutor_utils()->quiz_attempts();
$attempted_count = is_array($previous_attempts) ? count($previous_attempts) : 0;

$attempts_allowed = tutor_utils()->get_quiz_option(get_the_ID(), 'attempts_allowed', 0);
$passing_grade = tutor_utils()->get_quiz_option(get_the_ID(), 'passing_grade', 0);

$attempt_remaining = $attempts_allowed - $attempted_count;

do_action('tutor_quiz/single/before/top');

?>

<div class="tutor-quiz-header">
    <ul class="tutor-quiz-meta">

      <?php 
        $total_questions = tutor_utils()->total_questions_for_student_by_quiz(get_the_ID());
        if($total_questions): 
      ?>
        <li>
          <strong><?php _e('Questions', 'tutor'); ?> :</strong>
          <?php echo $total_questions; ?>
        </li>
      <?php endif; ?>

      <?php
        $time_limit = tutor_utils()->get_quiz_option(get_the_ID(), 'time_limit.time_value');
        if ($time_limit) :
          $time_type = tutor_utils()->get_quiz_option(get_the_ID(), 'time_limit.time_type'); 
          switch ($time_type){
            case 'seconds':
              $time_type_label = __('segundos', 'laaldea');
              break;
            case 'minutes':
              $time_type_label = __('minutos', 'laaldea');
              break;
            case 'hours':
              $time_type_label = __('horas', 'laaldea');
              break;
            case 'days':
              $time_type_label = __('dias', 'laaldea');
              break;
            case 'weeks':
              $time_type_label = __('semanas', 'laaldea');
              break;
          }
      ?>
        <li>
          <strong><?php _e('Time', 'tutor'); ?> :</strong>
          <?php echo $time_limit.' '.$time_type_label; ?>
        </li>
      <?php endif; ?>

      <li>
        <strong><?php _e('Attempts Allowed', 'tutor'); ?> :</strong>
        <?php echo $attempts_allowed == 0 ? __('No limit', 'tutor') : $attempts_allowed; ?>
      </li>

	    <?php if($attempted_count) :?>
        <li>
          <strong><?php _e('Attempted', 'tutor'); ?> :</strong>
          <?php echo $attempted_count; ?>
        </li>
      <?php endif; ?>

      <li>
        <strong><?php _e('Attempts Remaining', 'tutor'); ?> :</strong>
        <?php echo $attempts_allowed == 0 ? __('No limit', 'tutor') : $attempt_remaining; ?>
      </li>
      
      <?php if($passing_grade) :?>
        <li>
          <strong><?php _e('Passing Grade', 'tutor'); ?> :</strong>
          <?php echo $passing_grade . '%'; ?>
        </li>
			<?php endif;?>
    </ul>
</div>

<?php do_action('tutor_quiz/single/after/top'); ?>
