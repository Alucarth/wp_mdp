<?php global $smof_data, $wp_embed;
get_header();

// Register variables
$classes 						= array();
$single_pre 					= 'album_';

// Get metadata of album in single
$arr_album_meta_val  	= array();
$arr_album_meta 		= array( 
	// Layout
    'layout'						=> 'right_sidebar', 
	'custom_sidebar' 				=> '',

    // Infomation
    'gallery'                       => '',
	'start_date'					=> '',
	'id'						    => '', 
	'format_date_time'				=> 'F d, Y',
);

foreach ( $arr_album_meta as $meta => $val ) {
	if ( function_exists( 'get_field' ) ) {
		if ( get_field( $single_pre . $meta, $id ) ) {
			$arr_album_meta_val[$meta] = get_field( $single_pre . $meta, $id );
		}
	}
}
extract( shortcode_atts( $arr_album_meta, $arr_album_meta_val ) );

$album_info = array();

$new_date = strtotime( $start_date );
$new_date = date_i18n('Y-m-d H:i', $new_date); 
$album_info['start_date'] = $new_date;

/*wp_enqueue_script( 'k-event' );
wp_localize_script( 'k-event', 'event_info', $event_info );
wp_enqueue_script( 'k-countdown' );
wp_enqueue_script( 'k-lodash' );*/

// Enqueue script
wp_enqueue_script( 'jquery-isotope' );
wp_enqueue_script( 'jquery-imagesloaded' );
wp_enqueue_script( 'cd-dropdown' );
wp_enqueue_script( 'magnific-popup' );
wp_enqueue_script( 'k2t-portfolio' );
wp_enqueue_script( 'k2t-ajax' );
wp_enqueue_script( 'modernizr' );

$number = empty( $number ) ? -1 : $number;
$arr_term_id = $arr_term = array();
if ( !empty( $categories ) ){
    $arr_categories = explode( ',', $categories );
    foreach ( $arr_categories as $category_id ){
        $category_id = trim( $category_id );
        if ( !empty( $category_id ) ){
            if ( is_numeric( $category_id ) ){
                $term = get_term_by( 'id', $category_id, 'gallery-category' );
            }else{
                $term = get_term_by( 'slug', $category_id, 'gallery-category' );
            }
            if ( $term ){
                $arr_term[] = $term;
                $arr_term_id[] = $term->term_id;
            }	
        }
    }
}


if ( !in_array( $column, array( '2','3','4','5', '6' ) ) ) $column = 3;

ob_start();
$portfolio_class = '';
        


// Layout of single event
if ( ( empty( $layout ) || $layout == 'default' ) && ! empty( $smof_data['event-layout'] ) ) {
	if( isset( $smof_data['rtl_lang'] ) && $smof_data['rtl_lang'] == '1' ){
		$layout = 'left_sidebar';
	}
	else
		$layout = $smof_data['event-layout'];
} else if ( empty( $smof_data['event-layout'] ) ) {
	$layout = 'right_sidebar';
}
if ( 'right_sidebar' == $layout ){	
	$classes[] = 'right-sidebar';
} elseif ( 'left_sidebar' == $layout ) {
	$classes[] = 'left-sidebar';
} elseif ( 'no_sidebar' == $layout ) {
	$classes[] = 'no-sidebar';
}


//
$filter_style = 'list';
$column = '4';
$text_align = 'center';
$filter = 'true';
?>

	<div class="k2t-content <?php echo implode( ' ', $classes ) ?>" style="padding-top: 50px !important">
		<div class="k2t-wrap">
			<main class="k2t-main" role="main">


                <?php while ( have_posts() ) : the_post(); ?>

                    <h5 class="" style="margin-top: -30px; margin-bottom: 40px;"><?php echo get_the_content(); ?></h5>

					<div id="main-col" <?php post_class(); ?>>

                        <div class="k2t-gallery-shortcode filter-style-<?php echo esc_attr( $filter_style );?> text-align-<?php echo esc_attr( $text_align );?>">
                            <div class=" portfolio-grid isotope-fullwidth isotope-<?php echo esc_attr( $column );?> pf-<?php echo esc_attr( $column );?>col">
                            
                                <div class="k2t-isotope-wrapper <?php echo esc_attr( $portfolio_class ); ?> isotope-<?php echo esc_attr( $column );?>-columns isotope-gallery isotope-grid">
                                    <?php 
                                        if(!function_exists("isMobile")){
                                            function isMobile() {
                                                return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
                                            }
                                        }
                                    ?>
                                    <?php if ( !empty( $title ) || $filter == 'true' ): ?>
                                        <div class="container">
                                            <div class="k2t-gallery-heading">
                                                <?php if ( !empty( $title ) ) : ?><h2 class="gallery-title"><?php esc_html_e( $title );?></h2><?php endif;?>
                                                <?php
                                                if ( count( $arr_term ) > 0 ){ // >=0
                                                    $categories = $arr_term;
                                                }else{
                                                    $categories = get_categories(array('taxonomy' => 'album-category-NO'));
                                                    if( count( $categories ) > 0 ):
                                                ?>
                                                    <ul class="k2t-isotope-filter filter-list">
                                                        <li class="*"><?php _e( 'All', 'k2t-album' );?></li>
                                                        <?php foreach($categories as $category):?>
                                                        <li class=".k2t-cat-<?php echo $category->slug; ?>">
                                                            <?php echo $category->name; ?></li>
                                                        <?php endforeach;?>
                                                    </ul>
                                                    <?php endif; ?>
                                                <?php }?>
                                                <!---->
                                                
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                
                                    <div class="article-loop k2t-isotope-container">
                                        <div class="gutter-sizer"></div>
                                        <?php 

                                            //$images = get_field('gallery');
                                            $images = $gallery;
                                            $sizemd = 'medium';
                                            $sizelg = 'full';


                                            // Post Class
                                            $post_classes = array('article','post','project','isotope-selector');	
                                            if($thumbnail) $post_classes[] = 'has-post-thumbnail'; else $post_classes[] = 'no-post-thumbnail';
                                            $post_classes[] = 'has-hover';

                                            if(count($categories) > 0 && is_array($categories)){
                                                foreach ($categories as $key => $category) {
                                                    $post_classes[] = 'k2t-cat-'.$category->slug;
                                                }
                                            }
                                            $post_classes = implode(' ',$post_classes);


                                            if( $images ):

                                                //var_dump($images);

                                                foreach( $images as $image ):
                                                    
                                                    $imageT = wp_get_attachment_image( $image['ID'], array('400', '400') );
                                                ?>
                                                <article class="item-custom <?php echo esc_attr( $post_classes ) ;?>">
                                                    <div class="article-inner">
                                                    <div class="view view-first">

                                                        <!--<img src="<?php //echo $image['sizes']['thumbnail']; ?>" alt="<?php //echo $image['alt']; ?>" />-->
                                                        <?php echo $imageT; ?>

                                                        <div class="mask">
                                                            <div class="pf-lightbox"><a href="<?php echo $image['url']; ?>" class="k2t-popup-link"><?php _e( '+', 'k2t-gallery' ); ?></a></div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </article><!-- .article -->
                                                <?php
                                                endforeach;
                                            endif;                                                                                 
                                                                                        
                                        ?>

                                        <div class="bubblingG">
                                            <span id="bubblingG_1"></span>
                                            <span id="bubblingG_2"></span>
                                            <span id="bubblingG_3"></span>
                                        </div>
                                    </div><!-- .article-loop -->
                                </div><!-- .k2t-isotope-wrapper -->
                            </div><!-- .portfolio-grid -->
                        </div><!-- .k2t-gallery-shortcode -->
						
					</div><!-- #main-col -->

				<?php endwhile; ?>
				
				<div class="clear"></div>
				
				
			</main><!-- .k2t-blog -->

			<?php
				if ( 'right_sidebar' == $layout || 'left_sidebar' == $layout ) {
					get_sidebar();	
				}
			?>

		</div><!-- .k2t-wrap -->
	</div><!-- .k2t-content -->

<?php get_footer(); ?>