<?php
	global $wp_embed, $blog_arr;
	
	// Check post thumb
	$thumbnail = (has_post_thumbnail(get_the_ID())) ? true : false;
	
	// Get category of post
	$categories = get_the_terms(get_the_ID(), 'album-category');
	
	// Get HTML 
	$title 				= get_the_title();
	$post_link 			= get_permalink( get_the_ID() );
	$date 				= get_the_date();
	$post_thumb_size 	= 'thumb_600x600';
	$post_thumb 		= get_the_post_thumbnail( get_the_ID(), $post_thumb_size, array( 'alt' => trim( get_the_title() ) ) );
	$post_thumb_url 	= wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

	$video_url = ( function_exists('get_field')) ? get_field( 'gallery_url', get_the_ID() ) : '';
	preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match);
	$youtube_id = $match[1];

	// Post Class
	$post_classes = array('article','post','project','isotope-selector');	
	if($thumbnail) $post_classes[] = 'has-post-thumbnail'; else $post_classes[] = 'no-post-thumbnail';
	$post_classes[] = 'has-hover';
	//
	if(count($categories) > 0 && is_array($categories)){
		foreach ($categories as $key => $category) {
			$post_classes[] = 'k2t-cat-'.$category->slug;
		}
	}
	$post_classes = implode(' ',$post_classes);
	
?>
<?php //if (!empty($video_url)) : ?>
<article class="gallery-video masonry-item masonry-it <?php echo ($post_classes) ;?>">
	<div class="inner k2t-element-hover">
		<?php if (!empty($post_thumb)) {
			echo ($post_thumb);
		} else { 
			$name_plugin_folder = basename( plugin_dir_path( dirname( __FILE__ , 2 ) ) );
			if (!empty($youtube_id)) {
			?>
			<img src="<?php echo "https://img.youtube.com/vi/".$youtube_id."/0.jpg"; ?>" alt="<?php the_title();?>" />
			<?php
			} else {
			?>
			<img src="<?php echo plugins_url("/") . $name_plugin_folder . '/assets/images/thumb-700x700.png' ?>" alt="<?php the_title();?>" />
			<?php
			}
		} 
		?>
		<div class="info">
			<a class="read-more k2t-video-popup-link" href="<?php echo $video_url;?>" title="Play the video"><i class="zmdi zmdi-play"></i></a>
			<?php if(!empty($title)) : ?>
				<h3 class="title">
					<a class="k2t-video-popup-link" href="<?php echo $video_url;?>" title="<?php echo esc_attr( $title );?>">
						<?php echo esc_html($title);?>
					</a>
				</h3>
			<?php endif; ?>
			<?php do_action( 'k_event_grid_after_title' ); ?>
			<div class="event-meta">
				<span class="date">
					<i class="zmdi zmdi-calendar-note"></i>
					<?php if ( !empty( $date ) ) :?>
					<time data-time="<?php echo get_the_date('c'); ?>" class="entry-date"><?php echo ($date); ?></time>
					<?php endif;?>
				</span>
			</div>
		</div>
	</div>
</article>
<?php //endif; ?>