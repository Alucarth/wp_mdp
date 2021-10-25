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
	//$post_thumb 		= get_the_post_thumbnail( get_the_ID(), $post_thumb_size, array( 'alt' => trim( get_the_title() ) ) );
	$post_thumb 		= '<a href="'. esc_url( $post_link ) .'" title="'. esc_attr( $title ) .'">' . get_the_post_thumbnail(get_the_ID(), $post_thumb_size, array('alt' => trim(get_the_title()))) . '</a>';
	$post_thumb_url 	= wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

	$content = get_the_content();

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


   		
<article class="album-item element hentry post-item <?php echo esc_attr( $post_classes );?>">
	<div class="article-inner k2t-element-hover">
        <div class="post-thumbnail thumbnail-image <?php if($format=='gallery') echo 'k2t-popup-gallery'?>">

            <div class="layer-table">
                <h2 class="title">
                    <a href="<?php echo esc_url( $post_link );?>" title="<?php echo esc_attr( $title );?>">
                        <?php echo esc_html($title);?>
                    </a>
                </h2>
                <span class="categoryNO"><b>
                	Fecha:
                    <?php                    	
                    	$dtf = get_field('album_start_date');                    	
                        //$cat_name = $categories[0]->name;
                        echo esc_html($dtf);
                    ?>
                </b></span>
                <p class="content">
                    <?php 
                        $short_content = substr($content,0,200);
                        echo ($short_content );
                    ?>
                </p>
            </div><!-- .layer-table -->

            <?php if ( $thumbnail ): echo ( $post_thumb ); else:?>
            <img src="<?php echo plugin_dir_url( __FILE__ );?>../images/thumb-500x333.png" alt="<?php the_title();?>" />
            <?php endif;?>
            <div class="infobox"><!----></div><!-- .infobox -->
                
            <?php if($format=='gallery'):?>
            <?php if(count($project_gallery) > 0 && is_array($project_gallery)):?>
                <?php foreach ( $project_gallery as $image ): ?>
                        
                    <?php if(is_array($image) && !empty($image['ID'])):?>
                    <a href="<?php echo ( $image['url'] );?>" style="display:none;"></a>
                    <?php elseif(!empty($image)):?>
                    <?php $img = wp_get_attachment_url($image);?>
                    <a href="<?php echo ( $image );?>" style="display:none;"></a>
                    <?php endif;?>
                
                <?php endforeach; ?>
            <?php endif;?>
            <?php endif;?>

        </div><!-- .post-thumbnail -->
	</div>
</article>


<!--<article class="gallery-video masonry-item masonry-it <?php echo ($post_classes) ;?>">
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
</article>-->
