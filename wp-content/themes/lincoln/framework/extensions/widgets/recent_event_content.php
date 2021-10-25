<?php
/**
 * Recent Event content.
 *
 * @package Lincoln
 * @author  LunarTheme
 * @link http://www.lunartheme.com
 */

if ( $query->have_posts() ) : 

	$has_recent_event = true;

	echo '<div class="recent-event">';
	while ( $query->have_posts() ) : $query->the_post();

		$event_start_date = (function_exists('get_field')) ? get_field('event_start_date', get_the_ID()) : ''; 
		$event_start_date = empty($event_start_date) ? '' : $event_start_date;

		$event_end_date = (function_exists('get_field')) ? get_field('event_end_date', get_the_ID()) : ''; 
		$event_end_date = empty($event_end_date) ? '' : $event_end_date;

		$event_address = (function_exists('get_field')) ? get_field('event_address', get_the_ID()) : ''; $event_address = empty($event_address) ? '' : $event_address;
		$event_info = array();
		$new_date = strtotime($event_start_date);
		$new_date = date_i18n('Y-m-d H:i', $new_date);
		$new_end_date =  strtotime($event_end_date);
		$new_end_date =  date_i18n('Y-m-d H:i', $new_end_date);
		$event_info['start_date'] = $new_date;

		setup_postdata( $post );

		$cd_to_date = $on_going ? $new_end_date : $new_date;
		
		?>	<div class="event-countdown-container">
				<div class="countdown-container recent-event-countdown"></div>
			</div>
			<article class="event-item recent-event-item">
				<<?php echo 'scr'.'ipt';?> type="text/template" class="countdown-template" data-startdate="<?php echo esc_attr($cd_to_date)?>">
					<div class="time <%= label %>">
					  <span class="count curr top"><%= curr %></span>
					  <span class="count next top"><%= next %></span>
					  <span class="count next bottom"><%= next %></span>
					  <span class="count curr bottom"><%= curr %></span>
					  <span class="label"><%= label.length < 6 ? label : label.substr(0, 3)  %></span>
					</div>
				</<?php echo 'scr'.'ipt';?>>
				
				
				<h4 class="event-title"><a href="<?php echo get_permalink( get_the_ID() ); ?>" title="<?php echo get_the_title() ?>"><?php echo get_the_title(); ?></a></h4>
				<div class="post-meta">
					<?php if ( $display_date == 'show' && !empty($event_start_date)) : ?>
						<span><i class="zmdi zmdi-calendar-note"></i><?= esc_html( date_i18n( 'F d, Y - H:i', strtotime( $event_start_date ) ) ); ?> </span>
					<?php endif;?>
					<?php if ( $display_location == 'show' && !empty($event_address) ) : ?>
						<span><i class="zmdi zmdi-pin"></i><?php echo esc_html($event_address) ?></span>
					<?php endif;?>
				</div>
				<?php if ( $display_button == 'show' ) : ?>
					<a class="join-event k2t-element-hover btn-ripple" href="<?php echo get_permalink( get_the_ID() ); ?>" title="<?php echo get_the_title() ?>"><?php  _e( 'Join This Event', 'k2t'); ?></a>
				<?php endif;?>

			</article>
		<?php
	endwhile;
	echo '</div>';
endif;
wp_reset_postdata();