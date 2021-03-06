<?php
/**
 * Displays course information for a user
 *
 * Available:
 * $user_id
 * $courses_registered: course
 * $course_progress: Progress in courses
 * $quizzes
 * 
 * @since 2.1.0
 * 
 * @package LearnDash\Course
 */

/**
 * Course registered
 */
?>
<div id='ld_course_info'>

	<!-- Course info shortcode -->
	<?php if ( $courses_registered ) : ?>
		<div id='ld_course_info_mycourses_list'>
			<h4><span><?php _e( 'registered courses', 'k2t' ); ?></span></h4>
			<?php foreach ( $courses_registered as $c ) : ?>
					<?php if ( has_post_thumbnail( $c ) ) :?>
					<div class='ld-course-info-my-courses'><?php echo get_the_post_thumbnail( $c, 'thumb_80x80' ); ?>
					<?php else :?>
					<div class='ld-course-info-my-courses'>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/placeholder/80x80.png'?>" alt="p_holder"/>
					<?php endif;?>
						<h2 class="ld-entry-title entry-title"><a href="<?php echo get_permalink( $c );?>"  rel=""><?php echo get_the_title( $c ) ;?></a></h2>
						<span class="date">
									<i class="zmdi zmdi-calendar-note"></i>
									<?php
										echo get_the_date( 'F j, Y', $c );
									?>
						</span>
					</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php /* Course progress */ ?>
	<?php if ( $course_progress ) : ?>
		<div id='course_progress_details'>
			<h4><?php _e( 'Course progress details:', 'k2t' ); ?></h4>
			<?php foreach ( $course_progress as $course_id => $coursep ) : ?>
				<?php $course = get_post( $course_id ); ?>
				<?php if ( empty( $course->post_title ) ) : continue; endif; ?>
				<strong><?php echo $course->post_title ?></strong>: <?php _e( 'Completed', 'k2t' ); ?> <strong><?php echo $coursep['completed']; ?></strong> <?php _e( 'out of', 'k2t' ); ?> <strong> <?php echo $coursep['total']; ?> </strong> <?php _e( 'steps', 'k2t' ); ?><br/>
			<?php endforeach ?>
		</div>
		<br>
	<?php endif; ?>

	<?php /* Quizzes */ ?>
	<?php if ( $quizzes ) : ?>
		<h4><?php _e( 'You have taken the following quizzes', 'k2t' ); ?></h4>

		<?php foreach ( $quizzes as $k => $v ) : ?>
			<?php $quiz = get_post( $v['quiz'] ); ?>
			<?php $passstatus = isset( $v['pass'] ) ? ( ( $v['pass'] == 1 ) ? 'green' : 'red' ) : ''; ?>
			<?php $c = learndash_certificate_details( $v['quiz'], $user_id ); ?>
			<?php $certificateLink = $c['certificateLink']; ?>
			<?php $certificate_threshold = $c['certificate_threshold']; ?>
			<?php $quiz_title = ! empty( $quiz->post_title ) ? $quiz->post_title : @$v['quiz_title']; ?>

			<?php if ( ! empty( $quiz_title ) ) : ?>
				<p>
					<span style='color:<?php echo $passstatus ?>'><strong><?php echo __( 'Quiz', 'k2t' ); ?></strong>: <?php echo $quiz_title ?></span> 
					<?php echo isset( $v['percentage'] ) ? " - {$v['percentage']}%" : '' ?>

					<?php if ( $user_id == get_current_user_id() && ! empty( $certificateLink ) && ( ( isset( $v['percentage'] ) && $v['percentage'] >= $certificate_threshold * 100) || ( isset( $v['count'] ) && $v['score']/$v['count'] >= $certificate_threshold ) ) ) : ?>
						- <a href='<?php echo $certificateLink ?>&time=<?php echo $v['time']; ?>' target='_blank'><?php echo __( 'Print Certificate', 'k2t' ); ?></a>
					<?php endif; ?>
					<br/>
					
					<?php if ( isset( $v['rank'] ) && is_numeric( $v['rank'] ) ) : ?>
						<?php echo __( 'Rank: ', 'k2t' ); ?> <?php echo $v['rank']; ?>, 
					<?php endif; ?>

					<?php echo __( 'Score ', 'k2t' ); ?><?php echo $v['score']; ?> <?php echo __( ' out of ', 'k2t' ); ?> <?php echo $v['count']; ?> <?php echo __( ' question(s)', 'k2t' ); ?>
					
					<?php if ( isset( $v['points'] ) && isset( $v['total_points'] ) ) : ?>
						<?php echo __( ' . Points: ', 'k2t' ); ?> <?php echo $v['points']; ?>/<?php echo $v['total_points']; ?>
					<?php endif; ?>

					<?php echo __( ' on ', 'k2t' ); ?> <?php echo date_i18n( DATE_RSS, $v['time'] ); ?>
					
					<?php
					/**
					 * 'course_info_shortcode_after_item' filter
					 *
					 * @todo filter doesn't make sense, change to action?
					 * 
					 * @since 2.1.0
					 */
					?>
					<?php echo apply_filters( 'course_info_shortcode_after_item', '', $quiz, $v, $user_id ); ?>
				</p>
			<?php endif; ?>	
		<?php endforeach; ?>

	<?php endif; ?>
	<!-- End Course info shortcode -->
</div>
