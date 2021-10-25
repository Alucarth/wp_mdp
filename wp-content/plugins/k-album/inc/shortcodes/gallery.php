<?php
/* ------------------------------------------------------- */
/* Portfolio
/* ------------------------------------------------------- */
if ( ! function_exists( 'k2t_album_shortcode' ) ) {
	function k2t_album_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'title'			=>	'',
			'categories'	=>  '',
			'number'		=>	'-1',
			'column'		=> 	'5',
			'filter'		=>	'true',
			'filter_style'  =>	'dropdown',
			'text_align'	=>	'left',
		), $atts ) );
		// Enqueue script
		/*wp_enqueue_script( 'jquery-isotope' );
		wp_enqueue_script( 'jquery-imagesloaded' );
		wp_enqueue_script( 'cd-dropdown' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_script( 'k2t-portfolio' );
		wp_enqueue_script( 'k2t-ajax' );
		wp_enqueue_script( 'modernizr' );*/

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
		
		global $smof_data, $wp_query; //
		//$wp_query = '';

		?>

	<div class="k2t-contentNO right-sidebar b-grid <?php echo esc_attr($classes);?>">

	<div class="k2t-wrap">



		<div class="container" style="margin-bottom:40px !important">
			<div class="k2t-gallery-heading">
				<?php if ( !empty( $title ) ) : ?><h3 class="gallery-title-h2"><?php esc_html_e( $title );?></h3><?php endif;?>
			</div>
		</div>

		<main class="k2t-blog" role="main" style="width:100% !important">
			<div class="grid-layout column-<?php echo esc_attr( $column );?> clearfix">

				<?php
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
					$args = array(
						'post_type'      => 'post-album',
						'posts_per_page' => get_option('posts_per_page '),
						'order'			 => 'DESC',
						'post_status'	 => 'publish',
						'paged'			 => $paged,
						'orderby'		 => 'date',
					);
					if ( count( $arr_term_id ) > 0 ){
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'album-category',
								'field'    => 'term_id',
								'terms'    => $arr_term_id,
							)
						);
					}
					$query = new WP_query( $args );
					$i = $j = 0;
					if( count( $query->posts ) > 0 ):
						while ( $query->have_posts() ) : $query->the_post(); 
							//get_template_part( 'templates/blog/content', 'grid' );
							//include( 'gallery-grid.php' );
							include( 'album-grid.php' );
							$i++;
						endwhile;
						include( 'navigation.php' );
					endif;
				?>
				
			</div>
		</main><!-- .k2t-main -->

	</div><!-- .k2t-wrap -->
	</div><!-- .k2t-content -->

		
	<?php
		$return = ob_get_clean();
		wp_reset_postdata();
		$return = apply_filters( 'k2t_album_return', $return ); //
		return $return;
	}
}
add_shortcode( 'k2t-album', 'k2t_album_shortcode' );
?>