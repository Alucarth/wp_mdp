<?php
/**
 * Teacher
 *
 * @package Lincoln
 * @author  LunarTheme
 * @link http://www.lunartheme.com
 */

add_action( 'widgets_init', 'k2t_teacher_load_widgets' );
function k2t_teacher_load_widgets() {
	register_widget( 'k2t_Widget_Teacher' );
}
class k2t_Widget_Teacher extends WP_Widget {

	function __construct() {
		$widget_ops  = array( 'classname' => 'k2t_widget_teacher', 'description' => '' );
		$control_ops = array( 'width' => 250, 'height' => 350 );
		parent::__construct( 'k2t_teacher', __( 'Lincoln - Teacher', 'k2t' ), $widget_ops, $control_ops );
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
		$limit    = isset( $instance['limit'] ) ? $instance['limit'] : '';
		$cat_ids  = isset( $instance['cat_ids'] ) ? $instance['cat_ids'] : '';
		$featured = isset( $instance['featured'] ) ? $instance['featured'] : '';
		// Load data
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'post_type'   => 'post-k-teacher',
			'orderby'     => 'post_date'
		);
		if ( ! empty( $limit ) ) $args['posts_per_page'] = $limit;

		if ( !empty( $cat_ids ) ) {
			$args['tax_query'] = array(
					array(
						'taxonomy' => 'k-teacher-category',
						'field'    => 'id',
						'terms'    => $cat_ids,
					)
				);
		}

		if ( $featured ) {
			$args['meta_key']  = 'teacher-featured';
		}

		$recent_posts = get_posts( $args );
		
		if ( count( $recent_posts ) > 0 ) {
			echo '<ul class="listing-teacher">';
			foreach ( $recent_posts as $post ) {
				$thumbnail_link = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
				$image = aq_resize( $thumbnail_link, 180, 180, true );
				$teacher_position = (function_exists('get_field')) ? get_field('teacher_position', get_the_ID()) : ''; $teacher_position = empty($teacher_position) ? '' : $teacher_position;
				setup_postdata( $post );

				if ( has_post_thumbnail( get_the_ID() ) ) {
					$thumb = '<img src="' . $image . '" width="80" height="80" alt="' . trim( get_the_title() ) . '" />';
				} else {
					$thumb = '<img src="' . get_template_directory_uri() . '/assets/img/placeholder/80x80.png" alt="' . trim( get_the_title() ) . '" />';
				}
				
				?>	
					<li>
						<a class="teacher-thumb" href="<?php echo get_permalink( get_the_ID() ); ?>" title="<?php echo get_the_title();?>"> <?php echo ($thumb); ?></a>
						<h4><a href="<?php echo get_permalink( get_the_ID() ); ?>" title="<?php echo get_the_title();?>"> <?php echo get_the_title(); ?></a></h4>
						<?php if(!empty($teacher_position)) : ?>
                            <span class="position"><?php echo esc_html($teacher_position); ?></span>
                        <?php endif; ?>
					</li>
				<?php
			}
			echo '</ul>';
		}
		echo ( $after_widget );
		wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['featured'] = !empty($new_instance['featured']) ? 1 : 0;
		$instance['cat_ids'] = !empty($new_instance['cat_ids']) ? $new_instance['cat_ids'] : '';
		$instance['limit']    = !empty($new_instance['limit']) ? $new_instance['limit'] : '';
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __( 'Browse by Teacher', 'k2t' ), 'limit' => 3, 'featured' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$featured = isset($instance['featured']) ? (bool)$instance['featured'] : false;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'k2t' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
    
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Limit:', 'k2t' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['limit'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cat_ids' ) ); ?>"><?php _e( 'Filter by Category IDs (seperate by , ):', 'k2t' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cat_ids' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cat_ids' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['cat_ids'] ); ?>" />
		</p>
		
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo ( $this->get_field_id('featured') ); ?>"
                  name="<?php echo ( $this->get_field_name('featured') ); ?>"<?php checked($featured); ?> />
            <label for="<?php echo ( $this->get_field_id('featured') ); ?>"><?php _e('Display only featured teacher', 'k2t'); ?></label>
        </p>

		<?php
	}
}
?>
