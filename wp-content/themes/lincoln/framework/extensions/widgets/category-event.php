<?php

add_action('widgets_init', 'k2t_category_event_load_widgets');
function k2t_category_event_load_widgets()
{
    register_widget('WP_Widget_Categories_Event');
}

class WP_Widget_Categories_Event extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array('classname' => 'widget_categories widget_categories_event', 'description' => __("A list or dropdown of categories.", 'k2t'));
        parent::__construct('categories_event', __('Categories Event', 'k2t'), $widget_ops);
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
            'taxonomy' => 'k-event-category',

        );

        if ($d) {
            static $first_dropdown = true;

            $dropdown_id = ($first_dropdown) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
            $first_dropdown = false;

            echo '<label class="screen-reader-text" for="' . esc_attr($dropdown_id) . '">' . $title . '</label>';

            $cat_args['show_option_none'] = __('Select Category', 'k2t');
            $cat_args['id'] = $dropdown_id;

            /**
             * Filter the arguments for the Categories widget drop-down.
             *
             * @since 2.8.0
             *
             * @see wp_dropdown_categories()
             *
             * @param array $cat_args An array of Categories widget drop-down arguments.
             */
            wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args));
            ?>

            <script type='text/javascript'>
                /* <![CDATA[ */
                (function () {
                    var dropdown = document.getElementById("<?php echo esc_js( $dropdown_id ); ?>");

                    function onCatChange() {
                        if (dropdown.options[dropdown.selectedIndex].value > 0) {
                            location.href = "<?php echo home_url(); ?>/?cat=" + dropdown.options[dropdown.selectedIndex].value;
                        }
                    }

                    dropdown.onchange = onCatChange;
                })();
                /* ]]> */
            </script>

            <?php
        } else {
            ?>
            <ul>
                <?php
                $cat_args['title_li'] = '';

                /**
                 * Filter the arguments for the Categories widget.
                 *
                 * @since 2.8.0
                 *
                 * @param array $cat_args An array of Categories widget options.
                 */
                wp_list_categories(apply_filters('widget_categories_args', $cat_args));
                ?>
            </ul>
            <?php
        }

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

        <p><input type="checkbox" class="checkbox" id="<?php echo ( $this->get_field_id('dropdown') ); ?>"
                  name="<?php echo ( $this->get_field_name('dropdown') ); ?>"<?php checked($dropdown); ?> />
            <label for="<?php echo ( $this->get_field_id('dropdown') ); ?>"><?php _e('Display as dropdown', 'k2t'); ?></label><br/>

            <input type="checkbox" class="checkbox" id="<?php echo ( $this->get_field_id('count') ); ?>"
                   name="<?php echo ( $this->get_field_name('count') ); ?>"<?php checked($count); ?> />
            <label for="<?php echo ( $this->get_field_id('count') ); ?>"><?php _e('Show post counts', 'k2t'); ?></label><br/>

            <input type="checkbox" class="checkbox" id="<?php echo ( $this->get_field_id('hierarchical') ); ?>"
                   name="<?php echo ( $this->get_field_name('hierarchical') ); ?>"<?php checked($hierarchical); ?> />
            <label for="<?php echo ( $this->get_field_id('hierarchical') ); ?>"><?php _e('Show hierarchy', 'k2t'); ?></label></p>
        <?php
    }

}