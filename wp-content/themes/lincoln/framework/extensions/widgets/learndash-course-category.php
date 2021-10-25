<?php

add_action('widgets_init', 'k2t_learndash_category_course_load_widgets');
function k2t_learndash_category_course_load_widgets()
{
    register_widget('WP_Widget_Learndash_Categories_Course');
}

class WP_Widget_Learndash_Categories_Course extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array('classname' => 'widget_categories widget_categories_course', 'description' => __("A list or dropdown of learndash course categories.", 'k2t'));
        parent::__construct('categories_course', __('Leanrdash Categories Course', 'k2t'), $widget_ops);
    }

    public function widget($args, $instance)
    {

        /** This filter is documented in wp-includes/default-widgets.php */
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Categories', 'k2t') : $instance['title'], $instance, $this->id_base);

        $c = !empty($instance['count']) ? '1' : '0';
        $h = !empty($instance['hierarchical']) ? '1' : '0';
        $d = !empty($instance['dropdown']) ? '1' : '0';

        echo ( $args['before_widget'] );
        if ($title) {
            echo ( $args['before_title'] . $title . $args['after_title'] );
        }

        $cat_args = array(
            'orderby' => 'name',
            'show_count' => $c,
            'hierarchical' => $h,
            'taxonomy' => 'k-course-category',

        );
        ?>
        <ul>
            <?php
            $cat_args['title_li'] = '';
            $terms = get_terms( 'category' );
            if ( is_array( $terms ) && count( $terms ) ) :
                foreach ($terms as $key => $term) {
                    $args = array(
                        'post_type' => 'sfwd-courses',
                        'cat'       => $term->term_id,
                        );
                    $query = new WP_Query( $args );
                    if ( $query->posts ) {
                        $link = get_term_link( $term->term_id, 'category' );
                        $link = add_query_arg( 'ld-pt', 'sfwd-courses' , $link );
                        echo '<li class="cat-item"><a href="' . esc_url( $link ) . '">' . $term->name . '</a></li>';
                    }
                    wp_reset_postdata();
                }
            endif;
            /**
             * Filter the arguments for the Categories widget.
             *
             * @since 2.8.0
             *
             * @param array $cat_args An array of Categories widget options.
             */
            // wp_list_categories(apply_filters('widget_categories_args', $cat_args));
            ?>
        </ul>
        <?php

        echo ( $args['after_widget'] );
    }


    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = !empty($new_instance['count']) ? 1 : 0;
        $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
        $instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

        return $instance;
    }

    public function form($instance)
    {
        //Defaults
        $instance = wp_parse_args((array)$instance, array('title' => ''));
        $title = esc_attr($instance['title']);
        $count = isset($instance['count']) ? (bool)$instance['count'] : false;
        $hierarchical = isset($instance['hierarchical']) ? (bool)$instance['hierarchical'] : false;
        $dropdown = isset($instance['dropdown']) ? (bool)$instance['dropdown'] : false;
        ?>
        <p><label for="<?php echo ( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'k2t'); ?></label>
            <input class="widefat" id="<?php echo ( $this->get_field_id('title') ); ?>"
                   name="<?php echo ( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/></p>

        <p>
            <input type="checkbox" class="checkbox" id="<?php echo ( $this->get_field_id('count') ); ?>"
                   name="<?php echo ( $this->get_field_name('count') ); ?>"<?php checked($count); ?> />
            <label for="<?php echo ( $this->get_field_id('count') ); ?>"><?php _e('Show post counts', 'k2t'); ?></label><br/>
        </p>
        <?php
    }

}