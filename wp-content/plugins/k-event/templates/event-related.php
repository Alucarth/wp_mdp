<?php global $smof_data, $single_layout_class; $post;?>		

<?php
	
	$related_by = isset( $smof_data['event-related-by'] ) && $smof_data['event-related-by'] ? $smof_data['event-related-by'] : 'k-event-category' ;
	$related = get_related_tag_posts_ids( get_the_ID(), $smof_data['event-related-number'], $related_by, 'post-k-event');

	$today = date('Y-m-d H:i:s');
	$args = array(
		'post__in'      => $related,
		'post__not_in'  => array($post->ID),
		'orderby'       => 'post__in',
		'no_found_rows' => true,
		'post_type'		=> 'post-k-event',
		'order'          => 'ASC',
		'orderby'        => 'meta_value',
	);
	$only_upcomming = isset( $smof_data['event-related-upcomming-only'] ) && $smof_data['event-related-upcomming-only'] ? $smof_data['event-related-upcomming-only'] : false;
	if ( $only_upcomming ) {
		$args['meta_key'] 	= 'event_start_date';
		$args['meta_query']	= 	array(
									array(
										'key'	 	=> 'event_end_date',
										'value'	  	=> $today,
										'compare' 	=> '>',
										'type'      => 'DATETIME'
									),
								);
	} 

	$related_posts = new WP_Query( $args );

	if ( ! count( $related_posts->posts ) ) return;

?>
<div class="k2t-related-event k2t-element-hover">
	<?php 
		$related_post_title = $smof_data['event-related-title'];
		if(!empty($related_post_title)) :
	?>
		<h3 class="related-title"><?php echo esc_html($related_post_title);?></h3>
	<?php endif;?>
	
	<div class="related-event-inner clearfix">
		
			<?php
				

				while ( $related_posts->have_posts() ): $related_posts->the_post();
					$thumb_html = '';
					if(has_post_thumbnail(get_the_ID())){
						$thumb_html = get_the_post_thumbnail(get_the_ID(), 'thumb_600x600', array('alt' => trim(get_the_title())));
					}else{
						$thumb_html = '<img src="' . plugin_dir_url( __FILE__ ) . 'images/thumb-400x256.png" alt="'.trim(get_the_title()).'" />';
					}
					$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post' );
			?>
			<article class="related-event">
				<div class="related-inner">
					<div class="related-thumb">
						<a class="image-link" href="<?php the_permalink(get_the_ID())?>"><?php echo ( $thumb_html );?></a>
					</div>
					<div class="related-text">
						<h5><a href="<?php the_permalink(get_the_ID())?>" title="<?php the_title()?>"><?php the_title();?></a></h5>
						<div class="related-meta">
							<span class="date">
								<i class="zmdi zmdi-calendar-note"></i>
								<?php
									echo get_the_date();
								?>
							</span>
						</div><!-- .related-meta -->
					</div><!-- .related-text -->	
				</div><!-- .related-inner -->		
			</article><!-- .related-post -->
			<?php 	
					endwhile;
				wp_reset_postdata();
			?>

	</div><!-- .related-event-inner -->
	
</div><!-- .k2t-related-posts -->



