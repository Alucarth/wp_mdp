<?php

Class K2T_Register{
	public $custom_fields = array();
	public $custom_fields_types = array();
	public $taxonomies = array();
	public $terms = array();
	public $post_types = array();
	
	public function __construct(){

		// Register hook action
		$this->hook();
	}
	
	protected function hook(){
		add_action( 'init', array($this, '_register_post_type'), 0 );
		add_action( 'init', array($this, '_register_taxonomy'), 0 );
	}

	/**
	 *  Function to add more terms 
	 */
	public function add_term($term, $taxonomy = '', $args = array()){
		if( is_array( $term ) ){
			foreach($term as $regis){
				@$this->add_term( (string)current($regis), (string)next($regis), (array)next($regis) );
			}
			return $this;
		}
		
		// If the taxonomy is not existed, register it first
		$this->register_taxonomy($taxonomy, $args);
		
		$this->terms[] = array(
			'term' => (string)$term,
			'taxonomy' => (string)$taxonomy,
			'args' => (array)$args
		);
		
		return $this;
	}
	
	public function _add_term(){
		foreach($this->terms as $term){
			$term_exists = term_exists( $term['term'], $term['taxonomy'] );
			if( $term_exists !== 0 && $term_exists !== null  ){
				return $term_exists;
			}
			//
			return wp_insert_term( $term['term'], $term['taxonomy'], $term['args'] );
		}
	}
	
	/**
	 *  Register taxonomy
	 */
	 
	 public function register_taxonomy($taxonomy, $args = array()){
	 	if( is_array($taxonomy) ){
	 		foreach($taxonomy as $tax){
	 			if( !isset($tax['taxonomy']) ) continue;
				else{
					$tax['taxonomy'] = strtolower( trim( (string)$tax['taxonomy'] ) );
					if( empty($tax['args']) )  $tax['args'] = array();
				}
				
	 			$this->register_taxonomy($tax['taxonomy'], $tax['args']);
	 		}
			// always return true;
			return $this;
	 	}
		
	 	if( !taxonomy_exists($taxonomy) ){
			$args_default = array(
				'public' => true,
				'rewrite' => false,
				'hierarchical' => true,
				'show_ui'             => true,
				'show_admin_column'   => true,
				'query_var'           => true,
			);
			
			$this->taxonomies[] = array(
				'taxonomy' => (string)$taxonomy, 
				'post-type' => !empty($args['post-type']) ? (array)$args['post-type'] : array('post', 'page'), 
				'args' => array_merge($args_default, (array)$args)); 
		}
		
		// always return true;
		return $this;
	 }
	
	public function _register_taxonomy(){
		//ilogs($this->taxonomies);
		foreach($this->taxonomies as $tax){
			register_taxonomy(
				$tax['taxonomy'], // taxonomy
				$tax['post-type'], // post type
				$tax['args'] // args
			);
		}
		return $this;
	}
	
	/**
	 * Register post type
	 */
	public function register_post_type($post_type, $args = array()){
		if( is_array($post_type) ){
			foreach($post_type as $ptype){
				if( !isset($ptype['post-type']) ){
					continue;
				}
				else{
					$ptype['post-type'] = strtolower( trim( (string)$ptype['post-type'] ) );
					if( empty($ptype['args']) ) $ptype['args'] = array();
					$this->register_post_type( $ptype['post-type'], $ptype['args'] );
				}
			}
			
			// always return true;\
			return $this->post_types;
		}
		
		$args_default = array(  
			'labels' 				=> array(),  
			'menu_position' 		=> 5, 
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'has_archive' 			=> true,
			'hierarchical' 			=> false,
			'supports' 				=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);
		
		$args = array_merge($args_default, (array)$args);
		$this->post_types[$post_type] = array(
			'post-type' => $post_type,
			'args' => $args
		);
		
		// always return true;
		return $this->post_types;
	}
	
	public function _register_post_type(){
		foreach($this->post_types as $ptype){
			register_post_type($ptype['post-type'], $ptype['args']);
		}
		flush_rewrite_rules();
		
		return $this;
	}
	
}