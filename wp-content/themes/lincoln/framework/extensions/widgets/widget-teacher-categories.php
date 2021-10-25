<?php
/**
 * Teacher cateogry 
 *
 * @package Lincoln
 * @author  LunarTheme
 * @link http://www.lunartheme.com
 */

add_action( 'widgets_init', 'k2t_teacher_category_load_widgets' );
function k2t_teacher_category_load_widgets() {
	register_widget( 'k2t_Widget_Teacher_Category' );
}
class k2t_Widget_Teacher_Category extends WP_Widget {

	function __construct() {
		$widget_ops  = array( 'classname' => 'k2t_Widget_Teacher_Category', 'description' => '' );
		$control_ops = array( 'width' => 250, 'height' => 350 );
		parent::__construct( 'k2t_teacher_category', __( 'Lincoln - Teacher Category', 'k2t' ), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo ( $args['before_widget'] );
        if ($title) {
            echo ( $args['before_title'] . $title . $args['after_title'] );
        }

		
		// Load parameter
		$count      = !empty($instance['count']) ? '1' : '0';
		$hide_empty = !empty($instance['hide_empty']) ? true : false;

		$terms = get_terms( 'k-teacher-category', array( 'hide_empty' => $hide_empty ) );

		echo '<div class="widget widget_categories">';
		echo '<ul>';

		foreach ( (array)$terms as $key => $term ) {
			echo '<li class="cat-item cat-item' . $term_id . '">';
			echo '<a href="' . get_term_link( $term->term_id, 'k-teacher-category' ) . '">' . $term->name . '</a>';
			if ( $count ) {
				$post = get_term( $term->term_id, 'k-teacher-category' );
				echo '<span class="count">' . $post->count . '</span>';
			}
			echo '</li>';
		}

		echo '</ul>';
		echo '</div>';

		echo ( $args['after_widget'] );

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']      = strip_tags($new_instance['title']);
		$instance['count']      = !empty( $new_instance['count'] ) ? 1 : 0;
		$instance['hide_empty'] = !empty( $new_instance['hide_empty'] ) ? 1 : 0;
		return $instance;
	}

	function form( $instance ) {
		$defaults   = array( 'title' => __( 'Teacher Categories', 'k2t' ), 'hide_empty' => 0, 'count' => 0 );
		$instance   = wp_parse_args( (array) $instance, $defaults );
		$count      = isset($instance['count']) ? (bool)$instance['count'] : false;
		$hide_empty = isset($instance['hide_empty']) ? (bool)$instance['hide_empty'] : false;
        ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'k2t' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
            <input type="checkbox" class="checkbox" id="<?php echo ( $this->get_field_id('count') ); ?>"
                   name="<?php echo ( $this->get_field_name('count') ); ?>"<?php checked($count); ?> />
            <label for="<?php echo ( $this->get_field_id('count') ); ?>"><?php _e('Show teacher counts', 'k2t'); ?></label><br/>

            <input type="checkbox" class="checkbox" id="<?php echo ( $this->get_field_id('hide_empty') ); ?>"
                   name="<?php echo ( $this->get_field_name('hide_empty') ); ?>"<?php checked( $hide_empty ); ?> />
            <label for="<?php echo ( $this->get_field_id('hide_empty') ); ?>"><?php _e('Hide empty', 'k2t'); ?></label>
        </p>
		<?php
	}
}
?>
