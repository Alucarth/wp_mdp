<?php
/*
Plugin Name: K Album
Plugin URI: http://lunartheme.com
Description: This is plugin for setting up Album on Lunartheme's item
Version: 4.2.8
Author: LunarTheme
Author URI: http:/lunartheme.com
*/


add_action( 'wp_enqueue_scripts', 'k2t_enqueue_plugin2' );

add_action( 'plugins_loaded','k_album_textdomain_plugin' );

function k_album_textdomain_plugin(){
	load_plugin_textdomain( 'k2t-album', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

if ( !function_exists('k2t_enqueue_plugin2') ) {
function k2t_enqueue_plugin2(){

	/* Magnific Popup
	---------------------- */
	wp_enqueue_style( 'magnific-popup', plugin_dir_url( __FILE__ ). 'assets/css/magnific-popup.css' );
	/* Portfolio
	---------------------- */
	wp_enqueue_style( 'K-allery2', plugin_dir_url( __FILE__ ) . 'assets/css/gallery.css' );

	if( wp_script_is( 'jquery' ) ){
		wp_enqueue_script( 'jquery' );
	}
	/* Jquery Library: Isotope
	---------------------- */
	wp_register_script( 'jquery-isotope', plugin_dir_url( __FILE__ ). 'assets/js/isotope.pkgd.min.js', array( 'jquery' ), '1.0', true );
	/* Jquery Library: Imagesloaded
	---------------------- */
	wp_register_script( 'jquery-imagesloaded', plugin_dir_url( __FILE__ ). 'assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '3.1.6', true );
	/* Jquery Library: Imagesloaded
	---------------------- */
	wp_register_script( 'jquery-hoverdir', plugin_dir_url( __FILE__ ). 'assets/js/jquery.hoverdir.js', array( 'jquery' ), '1.1.0', true );
	/* Jquery Library: magnific-popup
	---------------------- */
	wp_register_script( 'magnific-popup', plugin_dir_url( __FILE__ ) . 'assets/js/magnific-popup.js', array( 'jquery' ), '1.0', true );
	/* K2T Lincoln Portfolio 
	---------------------- */
	wp_register_script( 'k2t-portfolio', plugin_dir_url( __FILE__ ). 'assets/js/gallery.js', array( 'jquery' ), '1.0', true );

	wp_register_script( 'cd-dropdown', plugin_dir_url( __FILE__ ). 'assets/js/jquery.dropdown.js', array('jquery'), '1.0', true );
	
	/* Ajax load
	---------------------- */
	wp_register_script( 'k2t-ajax', plugin_dir_url( __FILE__ ). 'assets/js/ajax.js', array( 'jquery' ), '1.0', true );
	wp_localize_script('k2t-ajax', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}
}

//Enqueue Script and Css in Backend
if ( ! function_exists ( 'k2t_portfolio_backend_scripts' ) ) :
	function k2t_portfolio_backend_scripts() {
		wp_enqueue_style( 'k2t-portfolio-backend', plugin_dir_url( __FILE__ ) . 'assets/css/k2t-backend.css' );
	}
	add_action( 'admin_enqueue_scripts', 'k2t_portfolio_backend_scripts' );
endif;

if ( !function_exists( 'k2t_add_new_image_size_album' ) ) {
	add_action( 'init', 'k2t_add_new_image_size_album' );
	function k2t_add_new_image_size_album() {
		add_image_size( 'thumb_600x600', 600, 600, true ); // K Album Default
	}
}

//Include single and taxonomy to portfolio plugin
if ( !function_exists( 'k2t_include_single_template_album' ) ) {
	function k2t_include_single_template_album ( $single_template ) {
		global $post;
		if ( $post->post_type == 'post-album' ) {
			//$single_template = dirname(__FILE__) . '/inc/single-post-album.php';
		}
		return $single_template;
	}
	add_filter( 'single_template', 'k2t_include_single_template_album' );
}

//Taxonomy file
if(!function_exists('k2t_include_taxonomy_template_album')){
	function k2t_include_taxonomy_template_album( $template ){
		if( is_tax('album-category') ){
			$template = dirname(__FILE__). '/inc/taxonomy-portfolio-category.php';
		}
		return $template;
	}
	add_filter('template_include', 'k2t_include_taxonomy_template_album');
}

//Use single item template file to display post with type of k-plugin
if ( !function_exists( 'k2t_include_album_single_template' ) ) {
	function k2t_include_album_single_template ( $single_template ) {
		global $post;
		if ( is_singular('post-album') ){
			$single_template = k_album_include_template( 'album-single.php', false );
		}
		return $single_template;
	}
	add_filter( 'single_template', 'k2t_include_album_single_template' );
}

// replace template 
function k_album_include_template( $template = '', $include = true ){
	$child_path = get_stylesheet_directory();
	$template_path = locate_template( array( 'k-album/' . $template ) );
	if ( ! $template_path ) {
		$template_path = dirname( __FILE__ ) . '/templates/' . $template;
	}
	if ( ! file_exists( $template_path ) ) return false;
	if ( $include ) include ( $template_path );
	else return $template_path;
}

/* Include functions */
require_once( dirname(__FILE__) . '/inc/album-post-type.php' ); // Register gallery and category
require_once( dirname(__FILE__) . '/inc/mce/mce.php'); // Add mce buttons to post editor
require_once( dirname(__FILE__) . '/inc/shortcodes/gallery.php'); // Add mce buttons to post editor

require_once( dirname(__FILE__) . '/inc/acf-content2.php' ); // Add metadata of gallery





