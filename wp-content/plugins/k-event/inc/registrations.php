<?php
// Register event post type
add_action( 'init', 'k2t_event_register_ct', 0 );

function k2t_event_register_ct() {
	$slug = ( get_option( 'k2t-event-slug' ) != '' ) ?  get_option( 'k2t-event-slug' ) : esc_html__( 'k-event', 'k2t-event' );

	$slug_cat = ( get_option( 'k2t_event_category_slug' ) != '' ) ?  get_option( 'k2t_event_category_slug' ) : esc_html__( 'k-event-category', 'k2t-event' );
	$slug_tag = ( get_option( 'k2t_event_tag_slug' ) != '' ) ?  get_option( 'k2t_event_tag_slug' ) : esc_html__( 'k-event-tag', 'k2t-event' );

	$labels = array(
		'name'               => __('Eventos', 'k2t-event'),  
		'singular_name'      => __('K-Event', 'k2t-event'),  
		'add_new'            => __('Add New Event', 'k2t-event'),  
		'add_new_item'       => __('Add New Event', 'k2t-event'),  
		'edit_item'          => __('Edit Event', 'k2t-event'),  
		'new_item'           => __('New Event', 'k2t-event'),  
		'view_item'          => __('View Event', 'k2t-event'),  
		'all_items'          => __('All Events', 'k2t-event'),
		'search_items'       => __('Search Event', 'k2t-event'),  
		'not_found'          => __('No Event found', 'k2t-event'),  
		'not_found_in_trash' => __('No Event found in Trash', 'k2t-event'),  
		'parent_item_colon'  => ''
	);

	$args = array (
		'labels'             => $labels,
        'description'        => __( 'Description.', 'k2t-event' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		//'capability_type'    => 'post',
		'capability_type'     => array('post-k-event','post-k-events'),
		'map_meta_cap'        => true,

		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
		'rewrite' 			 => array( 'slug' => $slug, 'with_front' => FALSE )
	);

	register_post_type( 'post-k-event' , $args );

	// EVENT CATEGORY

	$args = array(
		'labels' => array(
			'name'                => __( 'Event Categories','k2t-event'),
			'singular_name'       => __( 'K-Event Category','k2t-event'),
			'search_items'        => __( 'Search K-Event Categories','k2t-event'),
			'all_items'           => __( 'All K-Event Categories','k2t-event'),
			'parent_item'         => __( 'Parent K-Event Category','k2t-event'),
			'parent_item_colon'   => __( 'Parent K-Event Category:','k2t-event'),
			'edit_item'           => __( 'Edit K-Event Category','k2t-event'), 
			'update_item'         => __( 'Update K-Event Category','k2t-event'),
			'add_new_item'        => __( 'Add New K-Event Category','k2t-event'),
			'new_item_name'       => __( 'New K-Event Category Name','k2t-event'),
			'menu_name'           => __( 'K-Event Categories','k2t-event')
		),
		'rewrite' => array('slug' => $slug_cat ),
	);

	register_taxonomy( 'k-event-category', 'post-k-event' , $args );

	// EVENT TAG

	$args = array(
		'labels' => array(
			'name'                => __( 'K-Event Tags', 'taxonomy general name','k2t-event'),
			'singular_name'       => __( 'K-Event Tag', 'taxonomy singular name','k2t-event'),
			'search_items'        => __( 'Search K-Event Tags','k2t-event'),
			'all_items'           => __( 'All K-Event Tags','k2t-event'),
			'parent_item'         => __( 'Parent K-Event Tag','k2t-event'),
			'parent_item_colon'   => __( 'Parent K-Event Tag:','k2t-event'),
			'edit_item'           => __( 'Edit K-Event Tag','k2t-event'), 
			'update_item'         => __( 'Update K-Event Tag','k2t-event'),
			'add_new_item'        => __( 'Add New K-Event Tag','k2t-event'),
			'new_item_name'       => __( 'New K-Event Tag Name','k2t-event'),
			'menu_name'           => __( 'K-Event Tags','k2t-event')
		),
		'rewrite' => array('slug' => $slug_tag ),
	);

	register_taxonomy( 'k-event-tag', 'post-k-event' , $args );
}


