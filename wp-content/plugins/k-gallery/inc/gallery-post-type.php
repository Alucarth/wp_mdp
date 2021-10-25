<?php
// Register custom post type "Page Section"
add_action( 'init', 'k2t_register_gallery', 0 ); 

function k2t_register_gallery ()  { 

	// global $smof_data;

	// $gallery_slug = isset( $smof_data['gallery-slug'] ) && $smof_data['gallery-slug'] ? $smof_data['gallery-slug'] : 'post-gallery';

	$labels = array(
		'name'               => __('Videos', 'k2t-gallery'), 
		'singular_name'      => __('K-Gallery', 'k2t-gallery'),
		'add_new'            => __('Add New Gallery', 'k2t-gallery'), 
		'add_new_item'       => __('Add New Gallery', 'k2t-gallery'),  
		'edit_item'          => __('Edit Gallery', 'k2t-gallery'),
		'new_item'           => __('New Gallery', 'k2t-gallery'), 
		'view_item'          => __('View Gallery', 'k2t-gallery'), 
		'all_items'          => __('All Gallery', 'k2t-gallery'),
		'search_items'       => __('Search Gallery', 'k2t-gallery'), 
		'not_found'          => __('No Gallery found', 'k2t-gallery'),  
		'not_found_in_trash' => __('No Gallery found in Trash', 'k2t-gallery'),  
		'parent_item_colon'  => ''
	);
	
	$args = array (
		'labels'             => $labels,
        'description'        => __( 'Description.', 'k2t-gallery' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon'          => 'dashicons-format-video',
		//'capability_type'    => 'post',
		'capability_type'     => array('post-gallery','post-gallerys'),
		'map_meta_cap'        => true,

		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'excerpt' ),
		'rewrite' 			 => array( 'slug' => 'videos', 'with_front' => FALSE )
	);

	register_post_type( 'post-gallery' , $args );

		// GALLERY CATEGORY 
	$labels = array(
		'name'              => __( 'K-Gallery Categories','k2t-gallery'),
		'singular_name'     => __( 'K-Gallery Category','k2t-gallery'),
		'search_items'      => __( 'Search K-Gallery Categories','k2t-gallery'),
		'all_items'         => __( 'All K-Gallery Categories','k2t-gallery'),
		'parent_item'       => __( 'Parent K-Gallery Category','k2t-gallery'),
		'parent_item_colon' => __( 'Parent K-Gallery Category:','k2t-gallery'),
		'edit_item'         => __( 'Edit K-Gallery Category','k2t-gallery'), 
		'update_item'       => __( 'Update K-Gallery Category','k2t-gallery'),
		'add_new_item'      => __( 'Add New K-Gallery Category','k2t-gallery'),
		'new_item_name'     => __( 'New K-Gallery Category Name','k2t-gallery'),
		'menu_name'         => __( 'K-Gallery Category','k2t-gallery')
	); 	
	
	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
	);

	$args['rewrite'] = array('slug' => 'gallery-category');
	register_taxonomy( 'gallery-category', array('post-gallery'), $args );

}
?>