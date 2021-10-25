<?php
/**
 * This file contains the code that displays the course list.
 * 
 * @since 2.1.0
 * 
 * @package LearnDash\Course
 */

$course_image_size = apply_filters( 'learndash_course_listing_size', 'thumb_600x340' );

global $smof_data;


$display = isset( $smof_data['sfwd-course-list-content'] )  ? $smof_data['sfwd-course-list-content'] : 'excerpt';
$words   = isset( $smof_data['sfwd-course-list-words'] ) 	? $smof_data['sfwd-course-list-words'] 	 : '25';

if ( taxonomy_exists('ld_course_category') ) {
	$categories = wp_get_post_terms( get_the_ID(), 'ld_course_category' );
} else {
	$categories = wp_get_post_categories( get_the_ID() );
}

// 4 learndash grid add-on

$user_id      = get_current_user_id();
$course_id    = get_the_ID();
$has_access   = sfwd_lms_has_access( $course_id, $user_id );
$is_completed = learndash_course_completed( $user_id, $course_id );

$course_meta_option = get_post_meta( get_the_ID(), "_sfwd-courses", true );
$price              = $course_meta_option && isset($course_meta_option['sfwd-courses_course_price']) ? $course_meta_option['sfwd-courses_course_price'] : __( 'Free', 'k2t' );

// price unit
$options  = get_option('sfwd_cpt_options');
$currency = null;

if ( ! is_null( $options ) ) {
	if ( isset($options['modules'] ) && isset( $options['modules']['sfwd-courses_options'] ) && isset( $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'] ) )
	$currency = $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'];
}

if( is_null( $currency ) )
	$currency = 'USD';


if( $price == '' )
	$price .= __( 'Free', 'k2t' );

if ( is_numeric( $price ) ) {
	if ( $currency == "USD" )
		$price = '$' . $price;
	else
		$price .= ' ' . $currency;
}

$class       = '';
$ribbon_text = '';

if ( $has_access && ! $is_completed ) {
	$class = 'ld_course_grid_price ribbon-enrolled';
	$ribbon_text = __( 'Enrolled', 'k2t' );
} elseif ( $has_access && $is_completed ) {
	$class = 'ld_course_grid_price';
	$ribbon_text = __( 'Completed', 'k2t' );
} else {
	$class = ! empty( $course_options['sfwd-courses_course_price'] ) ? 'ld_course_grid_price price_' . $currency : 'ld_course_grid_price free';
	$ribbon_text = $price;
}

// Embed code 

$enable_video = get_post_meta( get_the_ID(), '_learndash_course_grid_enable_video_preview', true );
$embed_code   = get_post_meta( get_the_ID(), '_learndash_course_grid_video_embed_code', true );

?>
<div class="ld-grid-item hentry">
	<div class="ld-inner-item k2t-element-hover">
		<div class="ld-entry-content entry-content">
			
			<?php if ( ! isset( $smof_data['sfwd-course-ribbon'] ) || $smof_data['sfwd-course-ribbon'] ) : ?>
				<div class="<?php echo esc_attr( $class ); ?>">
					<?php echo esc_attr( $ribbon_text ); ?>
				</div>
			<?php endif;?>
			<!-- Video or Thumbnail -->
			<?php 
			if ( 1 == $enable_video && ! empty( $embed_code ) ) :
				echo '<div class="ld_course_grid_video_embed">';
					if ( preg_match('/iframe/', $embed_code) ) {
						echo $embed_code; 
					} else {
						if ( shortcode_exists( 'vc_video' ) ) {
							echo do_shortcode( '[vc_video link="' . esc_url( $embed_code ) . '"/]' );
						} else {
							echo $embed_code;
						}
					}
				echo '</div>';
			else : 
				the_post_thumbnail( $course_image_size );
			endif;
			?>

			<div class="ld-entry-item">
				<?php 
					if ( count( $categories ) > 0 && $smof_data['sfwd-course-list-cat'] ) {
						foreach ( (array)$categories as $key => $cat_id ) {
							if ( is_object( $cat_id ) ) { $cat_id = $cat_id->term_id; }
							$color = function_exists( 'get_field' ) ? get_field('category_color', 'category_' . $cat_id ) : '';
							$style = 'style="color: ' . $color . '"';
							$icon  = function_exists( 'get_field' ) ? get_field('category_icon', 'category_' . $cat_id ) : '<i class="zmdi zmdi-folder-outline"></i>';
							$link  = add_query_arg( 'ld-pt', 'sfwd-courses', get_category_link( $cat_id ) );
							echo '<a href="' . $link .'" class="cat-icon" ' . $style . ' >' . $icon . '</a>' ;
						}
					} 
				?>
				<div class="item-date"><i class="zmdi zmdi-calendar-note"></i><?php echo date_i18n( get_option('date_format'), strtotime( get_post_time() ) );?></div>
				<?php the_title( '<h2 class="ld-entry-title entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); ?>
				<?php global $more; $more = 0; ?>
				<div class="item-content">
				<?php 
					if ( isset( $course_meta_option['sfwd-courses_course_short_description'] ) &&  $course_meta_option['sfwd-courses_course_short_description'] ) {
						echo $course_meta_option['sfwd-courses_course_short_description'];
					} else {
						if ( $display == 'content' ){
							the_content( __( 'Read more.', 'k2t' ) ); 
						}else {
							$content = wp_trim_words( get_the_content(), $words, esc_html__( '..', 'k2t' ) );
							echo $content;
						}
					}
				?>
				</div>
	
				<?php if ( ! isset( $smof_data['sfwd-course-list-readmore'] ) || $smof_data['sfwd-course-list-readmore'] ) : ?>
					<div class="footer">
						<a class="more-link btn-ripple" href="<?php echo get_permalink(); ?>"> <?php echo esc_html_e( 'Read more', 'k2t' );?><i class="zmdi zmdi-chevron-right"></i></a>
					</div>
				<?php endif;?>

			</div>
		</div>
	</div>
</div>