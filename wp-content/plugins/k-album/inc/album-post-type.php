<?php
// Register custom post type "Page Section"
add_action( 'init', 'k2t_register_album', 0 ); 

function k2t_register_album ()  { 

	// global $smof_data;

	// $gallery_slug = isset( $smof_data['gallery-slug'] ) && $smof_data['gallery-slug'] ? $smof_data['gallery-slug'] : 'post-gallery';

	$labels = array(
		'name'               => __('K-Gallery', 'k2t-album'), 
		'singular_name'      => __('K-Gallery', 'k2t-album'),
		'add_new'            => __('Add New Gallery', 'k2t-album'), 
		'add_new_item'       => __('Add New Gallery', 'k2t-album'),  
		'edit_item'          => __('Edit Gallery', 'k2t-album'),
		'new_item'           => __('New Gallery', 'k2t-album'), 
		'view_item'          => __('View Gallery', 'k2t-album'), 
		'all_items'          => __('All Gallery', 'k2t-album'),
		'search_items'       => __('Search Gallery', 'k2t-album'), 
		'not_found'          => __('No Gallery found', 'k2t-album'),  
		'not_found_in_trash' => __('No Gallery found in Trash', 'k2t-album'),  
		'parent_item_colon'  => ''
	);
	
	$args = array (
		'labels'             => $labels,
        'description'        => __( 'Description.', 'k2t-album' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon'          => 'dashicons-format-gallery',

		//'capability_type'    => 'post-album',		
		'capability_type'     => array('post-album','post-albums'),
		'map_meta_cap'        => true,
        /*'capabilities' => array(
        	// Meta capabilities
			'edit_post'					=> 'edit_post-album',
			'read_post'					=> 'read_post-album',
			'delete_post'				=> 'delete_post-album',
			// Primitive capabilities used outside of map_meta_cap():
			'edit_posts'				=> 'edit_post-albums',
			'edit_others_posts'			=> 'edit_others_post-albums',
			'publish_posts'				=> 'publish_post-albums',
			'read_private_posts' 		=> 'read_private_post-albums',
			// Primitive capabilities used within map_meta_cap():
			'read'						=> 'read',
			'delete_posts'				=> 'delete_post-albums',
			'delete_private_posts'		=> 'delete_private_post-albums',
			'delete_published_posts'	=> 'delete_published_post-albums',
			'delete_others_posts'		=> 'delete_others_post-albums',
			'edit_private_posts' 		=> 'read_private_post-albums',			
			'edit_published_posts'		=> 'edit_published_post-albums',
			'create_posts'				=> 'edit_post-albums'
			//others
			'moderate_comments'			=> 'moderate_post-album_comments',

		),*/	

		'has_archive'        => true,		
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'custom-fields','thumbnail', 'excerpt', 'comments' ),
		'rewrite' 			 => array( 'slug' => 'galeria', 'with_front' => FALSE )
	);

	register_post_type( 'post-album' , $args );

	// GALLERY CATEGORY 
	$labels = array(
		'name'              => __( 'K-Gallery Categories','k2t-album'),
		'singular_name'     => __( 'K-Gallery Category','k2t-album'),
		'search_items'      => __( 'Search K-Gallery Categories','k2t-album'),
		'all_items'         => __( 'All K-Gallery Categories','k2t-album'),
		'parent_item'       => __( 'Parent K-Gallery Category','k2t-album'),
		'parent_item_colon' => __( 'Parent K-Gallery Category:','k2t-album'),
		'edit_item'         => __( 'Edit K-Gallery Category','k2t-album'), 
		'update_item'       => __( 'Update K-Gallery Category','k2t-album'),
		'add_new_item'      => __( 'Add New K-Gallery Category','k2t-album'),
		'new_item_name'     => __( 'New K-Gallery Category Name','k2t-album'),
		'menu_name'         => __( 'K-Gallery Category','k2t-album')
	); 	
	
	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'rewrite'			  => array('slug' => 'album-category')
	);

	$args['rewrite'] = array('slug' => 'album-category');
	register_taxonomy( 'album-category', array('post-album'), $args );

}
?>