<?php
/**
 * @package K-Roles-Users
 * @version 1.0
 */
/*
Plugin Name: K-Roles Users
Plugin URI: http://wordpress.org/extend/plugins/#
Description: This is an plugin for add new Role exclusive for PGDE
Author: Carlos Alejo
Version: 1.0
Author URI: http://carlodaniele.it/en/
*/


	function pgde_add_roles() {

		add_role( 'comunicacion', 'Comunicación', array( 

			'read' => true, 

			//posts
			'edit_posts'   => true, 
			'delete_posts' => true,
			'delete_published_posts' => true,
			'publish_posts' => true,
			'edit_published_posts' => true,

			//manage files
			'upload_files' => true,

			//pages
			'edit_pages' => true,
			'edit_others_pages' => true,
			'publish_pages' => true,
			'edit_published_pages' => true,

			//categories
			//'manage_categories' => true,
			
			//comments
			//'moderate_comments' =>false,
			//'edit_comment' => false,

		));
	}
	register_activation_hook( __FILE__, 'pgde_add_roles' );


	function kinsta_add_caps(){

		$role = get_role( 'comunicacion' );

		$role->add_cap( 'edit_post-album');
		$role->add_cap( 'read_post-album');
		$role->add_cap( 'delete_post-album');
		$role->add_cap( 'edit_post-albums');
		$role->add_cap( 'edit_others_post-albums');
		$role->add_cap( 'publish_post-albums');
		$role->add_cap( 'read_private_post-albums');
		$role->add_cap( 'delete_post-albums');
		$role->add_cap( 'delete_private_post-albums');
		$role->add_cap( 'delete_published_post-albums');
		$role->add_cap( 'delete_others_post-albums');
		$role->add_cap( 'read_private_post-albums');
		$role->add_cap( 'edit_published_post-albums');
		$role->add_cap( 'edit_post-albums');
		//$role->add_cap( 'moderate_post-album_comments');

		$role->add_cap( 'edit_post-gallery');
		$role->add_cap( 'read_post-gallery');
		$role->add_cap( 'delete_post-gallery');
		$role->add_cap( 'edit_post-gallerys');
		$role->add_cap( 'edit_others_post-gallerys');
		$role->add_cap( 'publish_post-gallerys');
		$role->add_cap( 'read_private_post-gallerys');
		$role->add_cap( 'delete_post-gallerys');
		$role->add_cap( 'delete_private_post-gallerys');
		$role->add_cap( 'delete_published_post-gallerys');
		$role->add_cap( 'delete_others_post-gallerys');
		$role->add_cap( 'read_private_post-gallerys');
		$role->add_cap( 'edit_published_post-gallerys');
		$role->add_cap( 'edit_post-gallerys');
		//$role->add_cap( 'moderate_post-album_comments');

		$role->add_cap( 'edit_post-k-event');
		$role->add_cap( 'read_post-k-event');
		$role->add_cap( 'delete_post-k-event');
		$role->add_cap( 'edit_post-k-events');
		$role->add_cap( 'edit_others_post-k-events');
		$role->add_cap( 'publish_post-k-events');
		$role->add_cap( 'read_private_post-k-events');
		$role->add_cap( 'delete_post-k-events');
		$role->add_cap( 'delete_private_post-k-events');
		$role->add_cap( 'delete_published_post-k-events');
		$role->add_cap( 'delete_others_post-k-events');
		$role->add_cap( 'read_private_post-k-events');
		$role->add_cap( 'edit_published_post-k-events');
		$role->add_cap( 'edit_post-k-events');
		//$role->add_cap( 'moderate_post-album_comments');

		$roleAdmin = get_role( 'administrator' );

		$roleAdmin->add_cap( 'edit_post-album');
		$roleAdmin->add_cap( 'read_post-album');
		$roleAdmin->add_cap( 'delete_post-album');
		$roleAdmin->add_cap( 'edit_post-albums');
		$roleAdmin->add_cap( 'edit_others_post-albums');
		$roleAdmin->add_cap( 'publish_post-albums');
		$roleAdmin->add_cap( 'read_private_post-albums');
		$roleAdmin->add_cap( 'delete_post-albums');
		$roleAdmin->add_cap( 'delete_private_post-albums');
		$roleAdmin->add_cap( 'delete_published_post-albums');
		$roleAdmin->add_cap( 'delete_others_post-albums');
		$roleAdmin->add_cap( 'read_private_post-albums');
		$roleAdmin->add_cap( 'edit_published_post-albums');
		$roleAdmin->add_cap( 'edit_post-albums');
		//$roleAdmin->add_cap( 'moderate_post-album_comments');

		$roleAdmin->add_cap( 'edit_post-gallery');
		$roleAdmin->add_cap( 'read_post-gallery');
		$roleAdmin->add_cap( 'delete_post-gallery');
		$roleAdmin->add_cap( 'edit_post-gallerys');
		$roleAdmin->add_cap( 'edit_others_post-gallerys');
		$roleAdmin->add_cap( 'publish_post-gallerys');
		$roleAdmin->add_cap( 'read_private_post-gallerys');
		$roleAdmin->add_cap( 'delete_post-gallerys');
		$roleAdmin->add_cap( 'delete_private_post-gallerys');
		$roleAdmin->add_cap( 'delete_published_post-gallerys');
		$roleAdmin->add_cap( 'delete_others_post-gallerys');
		$roleAdmin->add_cap( 'read_private_post-gallerys');
		$roleAdmin->add_cap( 'edit_published_post-gallerys');
		$roleAdmin->add_cap( 'edit_post-gallerys');
		//$roleAdmin->add_cap( 'moderate_post-album_comments');

		$roleAdmin->add_cap( 'edit_post-k-event');
		$roleAdmin->add_cap( 'read_post-k-event');
		$roleAdmin->add_cap( 'delete_post-k-event');
		$roleAdmin->add_cap( 'edit_post-k-events');
		$roleAdmin->add_cap( 'edit_others_post-k-events');
		$roleAdmin->add_cap( 'publish_post-k-events');
		$roleAdmin->add_cap( 'read_private_post-k-events');
		$roleAdmin->add_cap( 'delete_post-k-events');
		$roleAdmin->add_cap( 'delete_private_post-k-events');
		$roleAdmin->add_cap( 'delete_published_post-k-events');
		$roleAdmin->add_cap( 'delete_others_post-k-events');
		$roleAdmin->add_cap( 'read_private_post-k-events');
		$roleAdmin->add_cap( 'edit_published_post-k-events');
		$roleAdmin->add_cap( 'edit_post-k-events');
		//$roleAdmin->add_cap( 'moderate_post-album_comments');

	}
	add_action( 'admin_init', 'kinsta_add_caps');

	
	function rolcom_remove_menu_pages() {		 
		global $user_ID;			 
		if ( current_user_can( 'comunicacion' ) ) {
			remove_menu_page('tools.php', 'tools.php' );
	    	remove_menu_page('edit-comments.php', 'edit-comments.php' );
	    	remove_menu_page('vc-welcome');
	    	remove_menu_page('wpcf7');


		}
	}
	add_action( 'admin_init', 'rolcom_remove_menu_pages' ); //admin_menu


	function disable_plugin_remove_roles(){

		if( get_role('comunicacion') ){
			remove_role( 'comunicacion' );
		}		
	}
	register_deactivation_hook( __FILE__, 'disable_plugin_remove_roles' );



	/** Change Label News*/
	function modify_post_label() {
	    global $menu;
	    global $submenu;
	    $menu[5][0] = 'Noticias';
	    $submenu['edit.php'][5][0] = 'Noticias';
	    $submenu['edit.php'][10][0] = 'A&ntilde;adir Noticias';	   
	    echo '';
	}
	add_action( 'admin_menu', 'modify_post_label' );
	 
	 
	function modify_post_object() {
	    global $wp_post_types;
	    $labels = &$wp_post_types['post']->labels;
	    $labels->name = 'Noticias';
	    $labels->singular_name = 'Noticia';
	    $labels->add_new = 'A&ntilde;adir Nueva';
	    $labels->add_new_item = 'A&ntilde;adir Nueva Noticia';
	    $labels->edit_item = 'Editar Noticia';
	    $labels->new_item = 'Nueva Noticia';
	    $labels->view_item = 'Ver Noticia';
	    $labels->search_items = 'Buscar Noticias';
	    $labels->not_found = 'No se han encontrado Noticias';
	    $labels->not_found_in_trash = 'No se han encontrado Noticias en la papelera';
	    $labels->all_items = 'Todas las Noticias';
	    $labels->menu_name = 'Noticias';
	    $labels->name_admin_bar = 'Noticias';
	}	 
	add_action( 'init', 'modify_post_object' );



	function gowp_admin_menu() {
	  	global $menu;
	  	foreach ( $menu as $key => $val ) {	  		
	    	if ( 'Noticias' == $val[0] ) {
	      		$menu[$key][6] = 'dashicons-welcome-widgets-menus';
	    	}
	    	if ( 'Páginas' == $val[0] ) {
	      		$menu[$key][6] = 'dashicons-media-document';
	    	}
		}
	}
	add_action( 'admin_menu', 'gowp_admin_menu' );
