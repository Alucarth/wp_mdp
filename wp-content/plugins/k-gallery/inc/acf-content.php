<?php 
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_55acc8d4c845678h',
	'title' => 'Información',
	'fields' => array (				
		array (
			'key' => 'field_55baecr430fb6a38',
			'label' => __('URL Video Youtube', 'k2t-gallery'),
			'name' => 'gallery_url',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_55baea9g65751c2c',
			'label' => __('Video ID', 'k2t-gallery'),
			'name' => 'gallery_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),		
		array(
			'key'               => 'field_53df40ddg4593a7',
			'label'             => __('Video layout', 'k2t-gallery'),
			'name'              => 'gallery_layout',
			'prefix'            => '',
			'type'              => 'select',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'choices' => array(
				'default'       => __('Default', 'k2t-gallery'),
				'right_sidebar' => __('Right Sidebar', 'k2t-gallery'),
				'left_sidebar'  => __('Left Sidebar', 'k2t-gallery'),
				'no_sidebar'    => __('No Sidebar', 'k2t-gallery'),
			),
			'default_value' => array(),
			'allow_null'    => 0,
			'multiple'      => 0,
			'ui'            => 0,
			'ajax'          => 0,
			'placeholder'   => '',
			'disabled'      => 0,
			'readonly'      => 0,
		),
		array(
			'key'               => 'field_53df4176cgs4939b',
			'label'             => __('Custom sidebar name', 'k2t-gallery'),
			'name'              => 'gallery_custom_sidebar',
			'prefix'            => '',
			'type'              => 'text',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'default_value'     => '',
			'placeholder'       => '',
			'prepend'           => '',
			'prepend'           => '',
			'maxlength'         => '',
			'readonly'          => 0,
			'disabled'          => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post-gallery',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
));

endif;