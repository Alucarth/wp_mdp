<?php
/**
 * Register widget.
 *
 * @package Lincoln
 * @author  LunarTheme
 * @link http://www.lunartheme.com
 */

include_once K2T_FRAMEWORK_PATH . 'extensions/widgets/recent-post.php';
include_once K2T_FRAMEWORK_PATH . 'extensions/widgets/recent-event.php';
include_once K2T_FRAMEWORK_PATH . 'extensions/widgets/category-event.php';
include_once K2T_FRAMEWORK_PATH . 'extensions/widgets/category-course.php';
include_once K2T_FRAMEWORK_PATH . 'extensions/widgets/widget-teacher.php';
include_once K2T_FRAMEWORK_PATH . 'extensions/widgets/widget-teacher-categories.php';
include_once K2T_FRAMEWORK_PATH . 'extensions/widgets/social.php';

if ( is_plugin_active( 'sfwd-lms/sfwd_lms.php') ) {
	include_once K2T_FRAMEWORK_PATH . 'extensions/widgets/learndash-course-category.php';
}
?>
