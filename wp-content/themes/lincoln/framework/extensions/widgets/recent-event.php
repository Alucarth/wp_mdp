<?php
/**
 * Recent Event widget.
 *
 * @package Lincoln
 * @author  LunarTheme
 * @link http://www.lunartheme.com
 */

add_action( 'widgets_init', 'k2t_recent_event_load_widgets' );
function k2t_recent_event_load_widgets() {
	register_widget( 'k2t_Widget_Recent_Event' );
}
class k2t_Widget_Recent_Event extends WP_Widget {

	function __construct() {
		$widget_ops  = array( 'classname' => 'k2t_widget_recent_event', 'description' => '' );
		$control_ops = array( 'width' => 250, 'height' => 350 );
		parent::__construct( 'k2t_recent_event', __( 'Lincoln - Recent Event', 'k2t' ), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		global $post;
		echo ( $before_widget );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( ! empty( $title ) ) {
			echo ( $before_title );
			echo esc_html($title) ;
			echo ( $after_title );
		}
		
		// Load parameter
		$order                = isset( $instance['order'] ) ? $instance['order'] : '';
		$display_date         = isset( $instance['display_date'] ) ? $instance['display_date'] : '';
		$display_location     = isset( $instance['display_location'] ) ? $instance['display_location'] : '';
		$display_button       = isset( $instance['display_button'] ) ? $instance['display_button'] : '';
		$include_ongoing      = isset( $instance['include_ongoing_event'] ) ? $instance['include_ongoing_event'] : '';
		$include_fished_event = isset( $instance['include_fished_event'] ) ? $instance['include_fished_event'] : '';
		$limit                = isset( $instance['limit'] ) ? $instance['limit'] : '5';



		// Enqueue
		wp_enqueue_script( 'k-event' );
		wp_enqueue_script( 'k-countdown' );
		wp_enqueue_script( 'k-lodash' );
		// Load data
		$today = date('Y-m-d H:i:s');

		$has_recent_event = false;

		$on_going = true;

		// ONGOING EVENT

		if ( $include_ongoing == 'show' ) : 

			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'post_type'      => 'post-k-event',
				'orderby'        => 'post_date',
				'order'          => 'ASC',
				'posts_per_page' => intval( $limit ),
				'orderby'        => 'meta_value',
				'meta_key'       => 'event_start_date',
				'meta_query'		=> array(
					'relation' 			=> 'AND',
					array(
						'key'	 	=> 'event_start_date',
						'value'	  	=> $today,
						'compare' 	=> '<=',
						'type'      => 'DATETIME'
					),
					array(
						'key'	 	=> 'event_end_date',
						'value'	  	=> $today,
						'compare' 	=> '>=',
						'type'      => 'DATETIME'
					),
				),
			);

			$query = new WP_Query( $args );

			$limit -= $query->found_posts;

			if ( $query->have_posts() ) {
				echo '<h4>' . __('Ongoing Events', 'k2t' ) . '</h4>';
			}

			include 'recent_event_content.php';

			$on_going = false;

		endif;

		// UPCOMMING EVENTS

		if ( true ) {

			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'post_type'      => 'post-k-event',
				'orderby'        => 'post_date',
				'order'          => 'ASC',
				'posts_per_page' => intval( $limit ),
				'orderby'        => 'meta_value',
				'meta_key'       => 'event_start_date',
				'meta_query'		=> array(
					array(
						'key'	 	=> 'event_start_date',
						'value'	  	=> $today,
						'compare' 	=> '>',
						'type'      => 'DATETIME'
					),
				),
			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				echo '<h4>' . __('Upcoming Events', 'k2t' ) . '</h4>';
			}

			include 'recent_event_content.php';
		}

		// FINISHED EVENTES

		if ( ! $has_recent_event && $include_fished_event ) {
			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'post_type'      => 'post-k-event',
				'orderby'        => 'post_date',
				'order'          => 'DESC',
				'posts_per_page' => intval( $limit ),
				'orderby'        => 'meta_value',
				'meta_key'       => 'event_end_date',
				'meta_query'		=> array(
					'relation' 			=> 'AND',
					array(
						'key'	 	=> 'event_end_date',
						'value'	  	=> $today,
						'compare' 	=> '<',
						'type'      => 'DATETIME'
					),
				),
			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				echo '<h4>' . __('Finised Events', 'k2t' ) . '</h4>';
			}

			include 'recent_event_content.php';
		}

		echo ( $after_widget );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		return $new_instance;
	}

	function form( $instance ) {
		$defaults = array( 
			'title'                 => __( 'Recent Event', 'k2t' ), 
			'order'                 => 'desc', 
			'display_date'          => 'show', 
			'include_ongoing_event' => 'show', 
			'include_fished_event'  => 'hided',
			'limit'					=> '5',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'k2t' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
    
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'display_date' ) ); ?>"><?php _e( 'Display Date:', 'k2t' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'display_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_date' ) ); ?>">
                <option <?php selected( $instance['display_date'], 'show' ) ?> value="show"><?php _e( 'Show', 'k2t' );?></option>
                <option <?php selected( $instance['display_date'], 'hided' ) ?> value="hided"><?php _e( 'Hide', 'k2t' );?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'display_location' ) ); ?>"><?php _e( 'Display Location:', 'k2t' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'display_location' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_location' ) ); ?>">
                <option <?php selected( $instance['display_location'], 'show' ) ?> value="show"><?php _e( 'Show', 'k2t' );?></option>
                <option <?php selected( $instance['display_location'], 'hided' ) ?> value="hided"><?php _e( 'Hide', 'k2t' );?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'display_button' ) ); ?>"><?php _e( 'Display Button:', 'k2t' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'display_button' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_button' ) ); ?>">
                <option <?php selected( $instance['display_button'], 'show' ) ?> value="show"><?php _e( 'Show', 'k2t' );?></option>
                <option <?php selected( $instance['display_button'], 'hided' ) ?> value="hided"><?php _e( 'Hide', 'k2t' );?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'include_ongoing_event' ) ); ?>"><?php _e( 'Include Ongoing Events:', 'k2t' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'include_ongoing_event' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'include_ongoing_event' ) ); ?>">
                <option <?php selected( $instance['include_ongoing_event'], 'show' ) ?> value="show"><?php _e( 'Show', 'k2t' );?></option>
                <option <?php selected( $instance['include_ongoing_event'], 'hided' ) ?> value="hided"><?php _e( 'Hide', 'k2t' );?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'include_fished_event' ) ); ?>"><?php _e( 'Include finised Events when no events to display:', 'k2t' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'include_fished_event' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'include_fished_event' ) ); ?>">
                <option <?php selected( $instance['include_fished_event'], 'show' ) ?> value="show"><?php _e( 'Show', 'k2t' );?></option>
                <option <?php selected( $instance['include_fished_event'], 'hided' ) ?> value="hided"><?php _e( 'Hide', 'k2t' );?></option>
            </select>
        </p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Limit Events to show:', 'k2t' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['limit'] ); ?>" />
		</p>
		<?php
	}
}
?>
