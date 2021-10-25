<?php
/**
 * Displays a user's profile.
 * 
 * Available Variables:
 * 
 * $user_id 		: Current User ID
 * $current_user 	: (object) Currently logged in user object
 * $user_courses 	: Array of course ID's of the current user
 * $quiz_attempts 	: Array of quiz attempts of the current user
 * 
 * @since 2.1.0
 * 
 * @package LearnDash\User
 */
?>

<div id="learndash_profile" class="k2t-element-hover">
	
	<div class="profile_info clear_both">
		<div class="profile_avatar k2t-element-hover">
			<?php echo get_avatar( $current_user->user_email, 270 ); ?>
			<div class="profile_edit_profile" align="center">
                <a href='<?php echo get_edit_user_link(); ?>'><?php _e( 'Edit profile', 'k2t' ); ?></a>
            </div>
        </div>

		<div class="learndash_profile_details">
			<?php if ( ( ! empty( $current_user->user_lastname) ) || ( ! empty( $current_user->user_firstname ) ) ): ?>
				<div class="user-nicename"><?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?></div>
			<?php endif; ?>
			<div class="user-name"><?php echo $current_user->user_login; ?></div>
			<div class="user-email"><?php echo $current_user->user_email; ?></div>

			<?php
				$crr_user =  wp_get_current_user();
				$user_meta = get_user_meta( $crr_user->ID );
				echo '<div class="user-info-right">';
					echo '<p class="profile"><i class="zmdi zmdi-account"></i><span class="s-title">' . esc_html__( 'Profile', 'k2t' ) . '</span>';
					if ( isset( $user_meta['description'][0] ) && !empty( $user_meta['description'][0] ) )
						echo '<span class="p-content">' . $user_meta['description'][0] . "</span></p>";
					echo '<p class="user-location"><i class="zmdi zmdi-layers"></i><span class="s-title">' . esc_html__( 'Location', 'k2t' ) . '</span>';
					if ( isset( $user_meta['user-location'][0] ) && !empty( $user_meta['user-location'][0] ) )
						echo '<span class="u-location">' . $user_meta['user-location'][0] . "</span></p>";
				echo '</div>';
			?>
			
			<?php if ( ( isset( $shortcode_atts['course_points_user'] ) ) && ( $shortcode_atts['course_points_user'] == 'yes' ) ) { ?>
				<?php echo '<i class="zmdi zmdi-collection-text"></i>' . do_shortcode('[ld_user_course_points user_id="'. $current_user->ID .'" context="ld_profile"]'); ?>
			<?php } ?>
		</div>
	</div>

	<div class="learndash_profile_heading no_radius clear_both">
			<span><?php _e( 'Registered Courses', 'k2t' ); ?></span>
			<span class="ld_profile_status"><?php _e( 'Status', 'k2t' ); ?></span>
	</div>

	<div id="course_list">

		<?php if ( ! empty( $user_courses ) ) : ?>
			<?php foreach ( $user_courses as $course_id ) : ?>
				<?php
                    $course = get_post( $course_id);

                    $course_link = get_permalink( $course_id);

                    $progress = learndash_course_progress( array(
                        'user_id'   => $user_id,
                        'course_id' => $course_id,
                        'array'     => true
                    ) );

                    $status = ( $progress['percentage'] == 100 ) ? 'completed' : 'notcompleted';
                    if ( $progress['percentage'] == 0 ) $status = 'not-start';
				?>
				<div id='course-<?php echo esc_attr( $user_id ) . '-' . esc_attr( $course->ID ); ?>'>
					<div class="list_arrow collapse flippable"  onClick='return flip_expand_collapse("#course-<?php echo esc_attr( $user_id ); ?>", <?php echo esc_attr( $course->ID ); ?>);'></div>


                    <?php
                    /**
                     * @todo Remove h4 container.
                     */
                    ?>
					<h4>
						<div class="course-title">
							<a class='<?php echo esc_attr( $status ); ?>' href='<?php echo esc_attr( $course_link ); ?>'><?php echo $course->post_title; ?></a>
							<div>
								<dd class="course_progress" title='<?php echo sprintf( __( '%s out of %s steps completed', 'k2t' ), $progress['completed'], $progress['total'] ); ?>'>
									<div class="course_progress_blue" style='width: <?php echo esc_attr( $progress['percentage'] ); ?>%;'>
								</dd>
							</div>
						</div>
						<div class="course-status">
							<div class="wrap-inner">
								<span class="complete-percent <?php echo esc_attr( $status ); ?>">
									<?php echo sprintf( __( '%s%%', 'k2t' ), $progress['percentage'] ); ?>
								</span>
								<span>
									<?php echo esc_html__( 'Complete', 'k2t' ) ;?>
								</span>
							</div>
						</div>

						<div class="flip" style="display:none;">

							<?php if ( ! empty( $quiz_attempts[ $course_id ] ) ) : ?>
								<div class="learndash_profile_quizzes clear_both">

									<div class="learndash_profile_quiz_heading">
										<div class="quiz_title"><?php _e( 'Quizzes', 'k2t' ); ?></div>
										<div class="certificate"><?php _e( 'Certificate', 'k2t' ); ?></div>
										<div class="scores"><?php _e( 'Score', 'k2t' ); ?></div>
										<div class="quiz_date"><?php _e( 'Date', 'k2t' ); ?></div>
									</div>

									<?php foreach ( $quiz_attempts[ $course_id ] as $k => $quiz_attempt ) : ?>
										<?php
										    $certificateLink = @$quiz_attempt['certificate']['certificateLink'];

										    $status = empty( $quiz_attempt['pass'] ) ? 'failed' : 'passed';

										    $quiz_title = ! empty( $quiz_attempt['post']->post_title) ? $quiz_attempt['post']->post_title : @$quiz_attempt['quiz_title'];

										    $quiz_link = ! empty( $quiz_attempt['post']->ID) ? get_permalink( $quiz_attempt['post']->ID ) : '#';
										?>
										<?php if ( ! empty( $quiz_title ) ) : ?>
											<div class='<?php echo esc_attr( $status ); ?>'>

												<div class="quiz_title">
													<span class='<?php echo esc_attr( $status ); ?>_icon'></span>
													<a href='<?php echo esc_attr( $quiz_link ); ?>'><?php echo esc_attr( $quiz_title ); ?></a>
												</div>

												<div class="certificate">
													<?php if ( ! empty( $certificateLink ) ) : ?>
														<a href='<?php echo esc_attr( $certificateLink ); ?>&time=<?php echo esc_attr( $quiz_attempt['time'] ) ?>' target="_blank">
														<div class="certificate_icon"></div></a>
													<?php else : ?>
														<?php echo '-';	?>
													<?php endif; ?>
												</div>

												<div class="scores"><?php echo round( $quiz_attempt['percentage'], 2 ); ?>%</div>

												<div class="quiz_date"><?php echo date_i18n( 'd-M-Y', $quiz_attempt['time'] ); ?></div>

											</div>
										<?php endif; ?>
									<?php endforeach; ?>

								</div>
							<?php endif; ?>

						</div>
					</h4>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>

	</div>
</div>
