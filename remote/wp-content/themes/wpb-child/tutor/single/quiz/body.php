<?php
/**
 * @package TutorLMS/Templates
 * @version 1.5.7
 */


global $post;
$currentPost = $post;

$quiz_id = get_the_ID();
$is_started_quiz = tutor_utils()->is_started_quiz();

$previous_attempts = tutor_utils()->quiz_attempts();
$attempted_count = is_array($previous_attempts) ? count($previous_attempts) : 0;
$questions_order = tutor_utils()->get_quiz_option($quiz_id, 'questions_order', 'rand');
$attempts_allowed = tutor_utils()->get_quiz_option($quiz_id, 'attempts_allowed', 0);
$passing_grade = tutor_utils()->get_quiz_option($quiz_id, 'passing_grade', 0);
$feedback_mode = tutor_utils()->get_quiz_option($quiz_id, 'feedback_mode', 0);

$attempt_remaining = $attempts_allowed - $attempted_count;
?>

<div id="tutor-quiz-body" class="tutor-quiz-body tutor-quiz-body-<?php the_ID(); ?>">
	<?php

    do_action('tutor_quiz/body/before', $quiz_id);

	if ($is_started_quiz){
		$quiz_attempt_info = tutor_utils()->quiz_attempt_info($is_started_quiz->attempt_info);
		$quiz_attempt_info['date_time_now'] = date("Y-m-d H:i:s", tutor_time());

		$time_limit_seconds = tutor_utils()->avalue_dot('time_limit.time_limit_seconds', $quiz_attempt_info);
		$question_layout_view = tutor_utils()->avalue_dot('question_layout_view', $quiz_attempt_info);

		$hide_quiz_time_display = (bool) tutor_utils()->avalue_dot('hide_quiz_time_display', $quiz_attempt_info);
		$hide_question_number_overview = (bool) tutor_utils()->avalue_dot('hide_question_number_overview', $quiz_attempt_info);

		$remaining_time_secs = (strtotime($is_started_quiz->attempt_started_at) + $time_limit_seconds ) - strtotime($quiz_attempt_info['date_time_now']);

		$remaining_time_context = tutor_utils()->seconds_to_time_context($remaining_time_secs);
		$questions = tutor_utils()->get_random_questions_by_quiz();
		?>

        <div class="quiz-head-meta-info">
			<?php
			if ( ! $hide_quiz_time_display){
				?>
                <div class="time-remaining">
					<?php _e('Time remaining : '); ?> <span id="tutor-quiz-time-update" data-attempt-settings="<?php echo esc_attr(json_encode($is_started_quiz)) ?>" data-attempt-meta="<?php echo esc_attr(json_encode($quiz_attempt_info)) ?>"><?php echo $remaining_time_context; ?></span>
                </div>
			<?php } ?>
        </div>

		<?php
		if (is_array($questions) && count($questions)) {
			?>
            <div id="tutor-quiz-attempt-questions-wrap" data-question-layout-view="<?php echo $question_layout_view; ?>">

				<?php
				if ($question_layout_view === 'question_pagination'){
					$question_i = 0;
					?>
                    <div class="tutor-quiz-questions-pagination">
                        <ul>
							<?php
							foreach ($questions as $question) {
                $question_i++;
                $pagination_extra_class = $question_i == 1?'active':'';
								echo "<li><a href='#quiz-attempt-single-question-{$question->question_id}' class='tutor-quiz-question-paginate-item {$pagination_extra_class}'>{$question_i}</a> </li>";
							}
							?>
                        </ul>
                    </div>
					<?php
				}
				?>

                <form id="tutor-answering-quiz" method="post">
					<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>
                    <input type="hidden" value="<?php echo $is_started_quiz->attempt_id; ?>" name="attempt_id"/>
                    <input type="hidden" value="tutor_answering_quiz_question" name="tutor_action"/>
					<?php
					$question_i = 0;
					foreach ($questions as $question) {
						$question_i++;
						$question_settings = maybe_unserialize($question->question_settings);

						$style_display = ($question_layout_view !== 'question_below_each_other' && $question_i == 1) ? 'block' : 'none';
						if ($question_layout_view === 'question_below_each_other'){
							$style_display = 'block';
						}

						$next_question = isset($questions[$question_i]) ? $questions[$question_i] : false;
						?>
              <div id="quiz-attempt-single-question-<?php echo $question->question_id; ?>" class="quiz-attempt-single-question quiz-attempt-single-question-<?php echo $question_i; ?>" style="display: <?php echo $style_display; ?> ;" <?php echo $next_question ? "data-next-question-id='#quiz-attempt-single-question-{$next_question->question_id}'" : '' ; ?> data-quiz-feedback-mode="<?php echo $feedback_mode; ?>" >

							<?php echo "<input type='hidden' name='attempt[{$is_started_quiz->attempt_id}][quiz_question_ids][]' value='{$question->question_id}' />";


							$question_type = $question->question_type;

							$rand_choice = false;
							if($question_type == 'single_choice' || $question_type == 'multiple_choice'){
								$choice = maybe_unserialize($question->question_settings);
								if(isset($choice['randomize_question'])){
									$rand_choice = $choice['randomize_question'] == 1 ? true : false;
								}
							}

							$answers = tutor_utils()->get_answers_by_quiz_question($question->question_id, $rand_choice);
							$show_question_mark = (bool) tutor_utils()->avalue_dot('show_question_mark', $question_settings);
							$answer_required = (bool) tutils()->array_get('answer_required', $question_settings);

              // Description over title
              $question_description = stripslashes($question->question_description);
							if ($question_description){
                echo "<p class='question-description color-cyan'>{$question_description}</p>";
              }

							echo '<h6 class="question-text color-gray px-0">';
							if ( ! $hide_question_number_overview){
								echo $question_i. ". ";
							}
							echo stripslashes($question->question_title);
							echo '</h6>';

              $custom_html = '<p class="question-explanation pl-4 pb-3 color-cyan">';
              switch ($question_type) {
                case 'true_false' :
                  $custom_html .= __('Pregunta tipo verdadero o falso, escoja la opción correcta.','wpb_child');
                  break;
                case 'single_choice' :
                  $custom_html .= __('Pregunta tipo selección única, escoja la opción correcta.','wpb_child');
                  break;
                case 'multiple_choice' :
                  $custom_html .= __('Pregunta tipo selección múltiple, escoja <strong class="uppercase">todas</strong> las opciones correctas.','wpb_child');
                  break;
                case 'fill_in_the_blank' :
                  $custom_html .= __('Llene los espacios en blanco del siguiente párrafo con el texto más apropiado.','wpb_child');
                  break;
                case 'ordering' :
                  $custom_html .= __('Ordene los contenedores mostrados a continuación, haciendo click sostenido sobre las tres rayas y desplazando el mouse a la posición deseada.','wpb_child');
                  break;
                case 'matching' :
                case 'image_matching' :
                  $custom_html .= __('Arrastre los bloques de texto, haciendo click sostenido sobre las tres rayas y desplazando el mouse, al área punteada correspondiente a la mejor respuesta.','wpb_child');
                  break;
                case 'image_answering' :
                  $custom_html .= __('Escriba en cada área en blanco, el texto más apropiado, a la imagen mostrada. correspondiente. El texto debe estar en <strong>minúsculas</strong>.','wpb_child');
                  break;
                case 'open_ended' :
                case 'short_answer' :
                  $custom_html .= __('Escriba en el espacio a continuación la respuesta más apropiada, esta pregunta será evaluada manualmente en el menor tiempo posible.','wpb_child');
                  break;
                default :
                  $custom_html .= __('Tipo de pregunta no reconocido. Buena suerte.','wpb_child');
                  break;
              }
              $custom_html .= '</p>';

              echo $custom_html;

							if ($show_question_mark){
								echo '<p class="question-marks"> '.__('Marks : ', 'tutor').$question->question_mark.' </p>';
							}
              // description moved
							?>

                            <div class="tutor-quiz-answers-wrap question-type-<?php echo $question_type; ?> <?php echo $answer_required? 'quiz-answer-required':''; ?> ">
								<?php
								if ( is_array($answers) && count($answers) ) {
									foreach ($answers as $answer){
									    $answer_title = stripslashes($answer->answer_title);

										if ( $question_type === 'true_false' || $question_type === 'single_choice' ) {
											?>
                          <label class="answer-view-<?php echo $answer->answer_view_format; ?>">
                            <div class="quiz-answer-input-body">
                                <div class="quiz-answer-input-bottom">
                                  <div class="quiz-answer-input-field">
                                    <input name="attempt[<?php echo $is_started_quiz->attempt_id; ?>][quiz_question][<?php echo $question->question_id; ?>]" type="radio" value="<?php echo $answer->answer_id; ?>" data-is-correct="<?php echo $answer->is_correct ?>" >
                                    <span>&nbsp;</span>
                                    <div class="answer-container">
                                      <?php if ($answer->answer_view_format === 'image' || $answer->answer_view_format === 'text_image'): ?>
                                        <div class="quiz-answer-image-wrap">
                                          <img src="<?php echo wp_get_attachment_image_url($answer->image_id, 'full') ?>" />
                                        </div>
                                      <?php endif;?>
                                      <span class="answer-text"><?php
                                          if ($answer->answer_view_format !== 'image'){ echo $answer_title;}
                                      ?></span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </label>
											<?php
										}elseif ($question_type === 'multiple_choice'){
											?>
                          <label class="answer-view-<?php echo $answer->answer_view_format; ?>">
                            <div class="quiz-answer-input-body">
                                <div class="quiz-answer-input-bottom">
                                    <div class="quiz-answer-input-field">
                                        <input name="attempt[<?php echo $is_started_quiz->attempt_id; ?>][quiz_question][<?php echo $question->question_id; ?>][]" type="checkbox" data-is-correct="<?php echo $answer->is_correct ?>" value="<?php echo $answer->answer_id; ?>">
                                        <span>&nbsp;</span>
                                        <div class="answer-container">
                                          <?php if ($answer->answer_view_format === 'image' || $answer->answer_view_format === 'text_image'){ ?>
                                            <div class="quiz-answer-image-wrap">
                                              <img src="<?php echo wp_get_attachment_image_url($answer->image_id, 'full') ?>" />
                                            </div>
                                          <?php } ?>
                                          <span class="answer-text">
                                            <?php if ($answer->answer_view_format !== 'image') {
                                              echo $answer_title;
                                            } ?>
                                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </label>
											<?php
										}elseif ($question_type === 'fill_in_the_blank'){
											?>
                                            <p class="fill-in-the-blank-field">
												<?php
												$count_dash_fields = substr_count($answer_title, '{dash}');
												if ($count_dash_fields){

													$dash_string = array();
													$input_data = array();
													for($i=1; $i <=$count_dash_fields; $i ++){
														$dash_string[] = '{dash}';
														$input_data[] = "<input type='text' name='attempt[{$is_started_quiz->attempt_id}][quiz_question][{$question->question_id}][]' class='fill-in-the-blank-text-input' />";
													}
													echo str_replace($dash_string, $input_data, $answer_title);
												}
												?>
                                            </p>
											<?php
										}elseif ($question_type === 'ordering'){
											?>
                                            <div class="question-type-ordering-item">
                                                <div class="answer-title">
													<?php
													if ($answer->answer_view_format !== 'image'){
														echo "<p class='tutor-quiz-answer-title'>{$answer_title}</p>";
													}
													if ($answer->answer_view_format === 'image' || $answer->answer_view_format === 'text_image'){
														?>
                                                        <div class="quiz-answer-image-wrap">
                                                            <img src="<?php echo wp_get_attachment_image_url($answer->image_id, 'full') ?>" />
                                                        </div>
														<?php
													}
													?>
                                                </div>
                                                <span class="answer-sorting-bar"><i class="tutor-icon-menu-2"></i> </span>
                                                <input type="hidden" name="attempt[<?php echo $is_started_quiz->attempt_id; ?>][quiz_question][<?php echo $question->question_id; ?>][answers][]" value="<?php echo $answer->answer_id; ?>" >
                                            </div>
											<?php
										}
									}

									/**
									 * Question type matchind and image matching
									 */
									if ($question_type === 'matching' || $question_type === 'image_matching'){
										?>
                                        <div class="quiz-answers-type-matching-wrap <?php echo 'answer-type-'.$question_type ?> ">
                                            <div class="quiz-draggable-rand-answers">
												<?php
												$rand_answers = tutor_utils()->get_answers_by_quiz_question($question->question_id, true);
												foreach ($rand_answers as $rand_answer){
													?>
                                                    <div class="quiz-draggable-answer-item">
														<?php
														if ($question_type === 'matching'){
															echo "<span class='draggable-answer-title'>{$rand_answer->answer_two_gap_match}</span>";
														}else{
															echo "<span class='draggable-answer-title'>{$rand_answer->answer_title}</span>";
														}
														?>
                                                        <span class="draggable-answer-icon"> <i class="tutor-icon-menu-2"></i> </span>
                                                        <input type="hidden" name="attempt[<?php echo $is_started_quiz->attempt_id; ?>][quiz_question][<?php echo $question->question_id; ?>][answers][]" value="<?php echo $rand_answer->answer_id; ?>" >
                                                    </div>
													<?php
												}
												?>
                                            </div>

                                            <div class="quiz-answer-matching-items-wrap">
												<?php
												foreach ($answers as $answer){
													?>
                                                    <div class="quiz-answer-item-matching">
                                                        <div class="quiz-answer-matching-title">
															<?php
															if ($question_type === 'matching') {

																if ($answer->answer_view_format !== 'image'){
																	echo "<p class='tutor-quiz-answer-title'>{$answer->answer_title}</p>";
																}
																if ($answer->answer_view_format === 'image' || $answer->answer_view_format === 'text_image'){
																	?>
                                                                    <div class="quiz-answer-image-wrap">
                                                                        <img src="<?php echo wp_get_attachment_image_url($answer->image_id, 'full') ?>" />
                                                                    </div>
																	<?php
																}
															}elseif (intval($answer->image_id)){
																echo '<img src="'.wp_get_attachment_image_url($answer->image_id, 'full').'" />';
															}
															?>
                                                        </div>
                                                        <div class="quiz-answer-matching-droppable"></div>
                                                    </div>
													<?php
												}
												?>

                                            </div>
                                        </div>
										<?php
									}
								}

								/**
								 * For Open Ended Question Type
								 */
								if ($question_type === 'open_ended' || $question_type === 'short_answer'){
									?>
                                    <textarea class="question_type_<?php echo $question_type; ?>" name="attempt[<?php echo
									$is_started_quiz->attempt_id; ?>][quiz_question][<?php echo $question->question_id; ?>]"></textarea>
									<?php
									if ($question_type === 'short_answer') {
										$get_option_meta = tutor_utils()->get_quiz_option($quiz_id);
										if(isset($get_option_meta['short_answer_characters_limit'])){
											if($get_option_meta['short_answer_characters_limit'] != "" ){
												$characters_limit = tutor_utils()->avalue_dot('short_answer_characters_limit', $quiz_attempt_info);
												echo '<p class="answer_limit_desc">'. __('characters remaining', 'tutor' ) .' :<span class="characters_remaining">'.$characters_limit.'</span> </p>';
											}
										}
									}
									if ($question_type === 'open_ended') {
										$get_option_meta = tutor_utils()->get_quiz_option($quiz_id);
										if(isset($get_option_meta['open_ended_answer_characters_limit'])){
											if($get_option_meta['open_ended_answer_characters_limit'] != "" ){
												$characters_limit = $get_option_meta['open_ended_answer_characters_limit'];
												echo '<p class="answer_limit_desc">'. __('characters remaining', 'tutor' ) .' :<span class="characters_remaining">'.$characters_limit.'</span> </p>';
											}
										}
									}
								}


								if ($question_type === 'image_answering'){
									?>
                                    <div class="quiz-image-answering-wrap">
										<?php
										foreach ($answers as $answer){
											?>
                                            <div class="quiz-image-answering-answer">
												<?php
												if (intval($answer->image_id)){
													?>
                                                    <div class="quiz-image-answering-image-wrap">
														<?php echo '<img src="'.wp_get_attachment_image_url($answer->image_id, 'full').'" />'; ?>
                                                    </div>

                                                    <div class="quiz-image-answering-input-field-wrap">
                                                        <input type="text"  name="attempt[<?php echo $is_started_quiz->attempt_id; ?>][quiz_question][<?php echo $question->question_id; ?>][answer_id][<?php echo $answer->answer_id; ?>]" >
                                                    </div>
													<?php
												}
												?>
                                            </div>
											<?php
										}
										?>
                                    </div>
									<?php
								}
								?>

                                <div class="answer-help-block"></div>

                            </div>

							<?php
							if ($question_layout_view !== 'question_below_each_other'){
								if ($next_question){
									?>
                      <div class="quiz-answer-footer-bar">
                          <div class="quiz-footer-button">
                              <button type="button" value="quiz_answer_submit" class="button learning-button tutor-button tutor-success tutor-quiz-answer-next-btn">
                                <?php _e( 'Answer &amp; Next Question', 'tutor' ); ?></button>
                          </div>
                      </div>
									<?php
								} else{
									?>
                      <div class="quiz-answer-footer-bar">
                          <div class="quiz-footer-button">
                              <button type="submit" name="quiz_answer_submit_btn" value="quiz_answer_submit" class="button learning-button tutor-button tutor-success">
                                <?php _e( 'Submit Quiz', 'tutor' ); ?></button>
                          </div>
                      </div>
									<?php
								}
							}
							?>
                    </div>

						<?php
					}

					if ($question_layout_view === 'question_below_each_other'){
						?>
                    <div class="quiz-answer-footer-bar">
                        <div class="quiz-footer-button">
                            <button type="submit" name="quiz_answer_submit_btn" value="quiz_answer_submit" class="button learning-button tutor-button tutor-success">
                              <?php _e( 'Submit Quiz', 'tutor' ); ?></button>
                        </div>
                    </div>
					<?php } ?>

                </form>
            </div>

			<?php

		}else{
			?>
            <div class="start-quiz-wrap">
                <form id="tutor-finish-quiz" method="post">
					<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>

                    <input type="hidden" value="<?php echo $quiz_id; ?>" name="quiz_id"/>
                    <input type="hidden" value="tutor_finish_quiz_attempt" name="tutor_action"/>

                    <button type="submit" class="tutor-button" name="finish_quiz_btn" value="finish_quiz">
                        <i class="icon-floppy"></i> <?php _e( 'Finish', 'tutor' ); ?>
                    </button>
                </form>
            </div>

			<?php
		}
	}else{
		if ($attempt_remaining > 0 || $attempts_allowed == 0) {
			do_action('tuotr_quiz/start_form/before', $quiz_id);
			?>
            <div class="start-quiz-wrap">
                <form id="tutor-start-quiz" method="post">
					<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>

                    <input type="hidden" value="<?php echo $quiz_id; ?>" name="quiz_id"/>
                    <input type="hidden" value="tutor_start_quiz" name="tutor_action"/>

                    <button type="submit" class="tutor-button" name="start_quiz_btn" value="start_quiz">
                        <i class="icon-hourglass-1"></i> <?php _e( 'Start Quiz', 'tutor' ); ?>
                    </button>
                </form>
            </div>

			<?php
            do_action('tuotr_quiz/start_form/after', $quiz_id);
		}



		if ($previous_attempts){
			do_action('tutor_quiz/previous_attempts_html/before', $previous_attempts, $quiz_id);

			ob_start();
			tutor_load_template('single.quiz.previous-attempts', compact('previous_attempts', 'quiz_id'));
			$previous_attempts_html = ob_get_clean();
            echo apply_filters('tutor_quiz/previous_attempts_html', $previous_attempts_html, $previous_attempts, $quiz_id);

			do_action('tutor_quiz/previous_attempts/after', $previous_attempts, $quiz_id);
		}
	}

  $course = tutor_utils()->get_course_by_quiz(get_the_ID());
  $course_id = $course -> ID;
  $user_id = tutor_utils()->get_user_id();
  $completed_percent = tutor_utils()->get_course_completed_percent($course_id, $user_id);
  if (100 == $completed_percent) {
    laaldea_tutor_course_mark_complete_html_quiz();
  }

	tutor_next_previous_pagination();

    do_action('tutor_quiz/body/after', $quiz_id);
	?>
</div>