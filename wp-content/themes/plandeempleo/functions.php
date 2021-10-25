<?php 

	/*
	function child_theme_styles() {
		wp_dequeue_style( 'parent-theme-style' );
		wp_enqueue_style( 'child-theme-style', get_stylesheet_uri() );
   	}
	add_action( 'wp_enqueue_scripts', 'child_theme_styles' );
	   */
	
	function plan_generacion_de_empleo_enqueue_styles() {
		   
		$parent_style = 'lincoln';
		
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array(), '0.1', 'all' ); 
		
		wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( $parent_style ),
			wp_get_theme()->get('Version')
		);
	} 
	add_action( 'wp_enqueue_scripts', 'plan_generacion_de_empleo_enqueue_styles' );

	function register_prefooter_widget() {

		register_sidebar( array(
			'name'          => 'Prefooter',
			'id'            => 'widget_prefooter',
			'description'   => 'Content of pre footer zone',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		
	}
	
	add_action( 'widgets_init', 'register_prefooter_widget' );

	function register_pages_widget() {

		register_sidebar( array(
			'name'          => 'Páginas Internas - Sidebar',
			'id'            => 'widget_pages_sidebar',
			'description'   => 'Content of Widget zone',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		
	}
	
	add_action( 'widgets_init', 'register_pages_widget' );


	function register_institutional_widget() {

		register_sidebar( array(
			'name'          => 'Institucional - Sidebar',
			'id'            => 'widget_institution_sidebar',
			'description'   => 'Content of Widget zone',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		
	}	
	add_action( 'widgets_init', 'register_institutional_widget' );
	 



	function register_ovocational_widget() {

		register_sidebar( array(
			'name'          => 'Orientación Vocacional - Sidebar',
			'id'            => 'widget_ovocational_sidebar',
			'description'   => 'Content of Widget zone',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		
	}	
	add_action( 'widgets_init', 'register_ovocational_widget' );



	function register_laboralinsertion_widget() {

		register_sidebar( array(
			'name'          => 'Inserción Laboral - Sidebar',
			'id'            => 'widget_laboralinsertion_sidebar',
			'description'   => 'Content of Widget zone',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		
	}	
	add_action( 'widgets_init', 'register_laboralinsertion_widget' );



	function register_infopostulant_widget() {

		register_sidebar( array(
			'name'          => 'Información Jóvenes - Sidebar',
			'id'            => 'widget_infopostulant_sidebar',
			'description'   => 'Content of Widget zone',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		
	}	
	add_action( 'widgets_init', 'register_infopostulant_widget' );



	function register_infobusiness_widget() {

		register_sidebar( array(
			'name'          => 'Información Empresas - Sidebar',
			'id'            => 'widget_infobusiness_sidebar',
			'description'   => 'Content of Widget zone',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		
	}	
	add_action( 'widgets_init', 'register_infobusiness_widget' );
	
	
 ?>