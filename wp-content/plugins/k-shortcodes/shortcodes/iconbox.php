<?php
/**
 * Shortcode icon box.
 *
 * @since  1.0
 * @author LunarTheme
 * @link   http://www.lunartheme.com
 */

if ( ! function_exists( 'k2t_iconbox_shortcode' ) ) {
	function k2t_iconbox_shortcode( $atts, $content ) {
		$html =  $target = $icon_html = $image_link = $bgelement = $data_name = $data_delay = '';
		extract( shortcode_atts( array(
			'layout'             		=> '1',
			'bgcolor'					=> '',
			'title'              		=> '',
			'title_link'              	=> '',
			'target'	              	=> '_self',
			'fontsize'           		=> '',
			'color'              		=> '',
			'color_hover'              	=> '',
			'title_margin_bottom'		=> '',
			'text_transform'     		=> 'inherit',
			'icon_type'          		=> 'icon_fonts',
			'graphic'            		=> '',
			'icon'               		=> '',
			'icon_font_size'     		=> '',
			'icon_color'         		=> '',
			'link'               		=> '',
			'link_text'          		=> 'Learn more &rarr;',
			'mgt'                		=> '',
			'mgr'                		=> '',
			'mgb'                		=> '',
			'mgl'                		=> '',
			'anm'                		=> '',
			'anm_name'           		=> '',
			'anm_delay'          		=> '',
			'id'                 		=> '',
			'class'              		=> '',
		), $atts ) );

		//Global $cl
		$cl = array( 'k2t-iconbox' );

		// Animation
		if ( $anm ) {
			$anm        				= ' animated';
			$data_name  				= ' data-animation="' . $anm_name . '"';
			$data_delay 				= ' data-animation-delay="' . $anm_delay . '"';
		}
		$id    							= ( $id != '' ) ? ' id="' . $id . '"' : '';
		$class 							= ( $class != '' ) ? ' ' . $class . '' : '';
		$mgt   							= ( $mgt != '' ) ? 'margin-top: ' . $mgt . 'px;' : '';
		$mgr   							= ( $mgr != '' ) ? 'margin-right: ' . $mgr . 'px;' : '';
		$mgb   							= ( $mgb != '' ) ? 'margin-bottom: ' . $mgb . 'px;' : '';
		$mgl   							= ( $mgl != '' ) ? 'margin-left: ' . $mgl . 'px;' : '';

		$iconbox_id = uniqid( 'icb-' );

		// Background
		if ( ! empty( $bgcolor ) && $layout == '1' ) {
			$cl[] = 'has-background';
			$bgelement 					= ! empty( $bgcolor ) ? 'background-color: ' . $bgcolor : '';
		}

		// Get icon graphics
		$graphic_id  					= preg_replace( '/[^\d]/', '', $graphic );
		$img         					= wpb_getImageBySize( array( 'attach_id' => $graphic_id, 'thumb_size' => '' ) );
		$image_link  					= $img['p_img_large'][0];
		$data       					= ( file_exists( $image_link ) && isset( $image_link ) ) ? getimagesize( $image_link ) : array( 'auto', 'auto' );
		$width      					= isset( $data[0] ) ? $data[0] : '';
		$height     					= isset( $data[1] ) ? $data[1] : '';

		// Layout
		if ( ! empty( $layout ) ) { $cl[] = 'layout-' . trim( $layout ); } else { $cl[] = 'layout-1'; }
		if ( ! empty( $layout ) && in_array( $layout, array( '1', '2' ) ) ) { $cl[] = 'k2t-element-hover'; } 

		// Select icon type
		if ( 'graphics' == $icon_type ) {
			$icon_html .= '<div class="iconbox-image"><img width="' . $width . '" height="' . $height . '" src="' . $image_link . '" alt="' . $title . '" /></div>';
		} elseif ( 'graphics' != $icon_type ) {
			$icon_css = array();

			// Icon font size
			$icon_font_size = ( $icon_font_size != '' ) ? 'font-size: ' . $icon_font_size . 'px;' : '';

			// Icon color
			if ( $icon_color ) { $icon_css[] = 'color: ' . trim( $icon_color ); }

			// HTML output of icon
			$icon_html = '<div class="iconbox-icon" style="' . implode( ';', $icon_css ) . '"><i style="'. $icon_font_size . implode( ';', $icon_css ) .'" class="' . trim( $icon ) . '"></i></div>';
		}
		
		// Text link
		if ( trim( $link_text ) == '' ) { $link_text = 'Learn more &rarr;'; } else { $link_text = trim( $link_text ); }

		$link_html = ! empty( $link ) ? '<div class="learnmore"><a href="' . esc_url( trim( $link ) ) . '">' . $link_text . ' &rarr;</a></div>' : '';

		// Title
		$color 					= ! empty( $color ) ? 'color: ' . $color . ';' : '';
		$fontsize 				= ! empty( $fontsize ) ? 'font-size: ' . $fontsize . 'px;' : '';
		$text_transform 		= ! empty( $text_transform ) ? 'text-transform: ' . $text_transform . ';' : '';
		$title_margin_bottom 	= ! empty( $title_margin_bottom ) ? ( is_numeric( $title_margin_bottom ) ? 'margin-bottom: ' . $title_margin_bottom . 'px;' : 'margin-bottom: ' . $title_margin_bottom . ';' ) : '';
		if ( trim( $title ) == '' ) { $title_html = ''; } else { $title_html = '<div class="title"><h3 style="' . $color . $text_transform . $fontsize . $title_margin_bottom . '" class="h">' . trim( $title ) . '</h3></div>'; }
		if (  ! empty( $title_link ) )  { 
			$title_html = '<div class="title"><h3 style="' . $color . $text_transform . $fontsize . $title_margin_bottom . '" class="h"><a href="' . esc_url( trim( $title_link ) ) . '" target="' . $target . '">' . trim( $title ) . '</a></h3></div>'; 
		}


		// Apply filters to cl
		$cl = apply_filters( 'k2t_iconbox_classes', $cl );

		// Join cl class
		$cl = join( ' ', $cl );

		$html = '<div id=' . $iconbox_id . ' class="' . trim( $cl ). $anm . $class . '" ' . $data_name . $data_delay . $id . ' style="' . $mgt . $mgr . $mgb . $mgl . $bgelement . '">';
		$html .= do_action( 'k2t_iconbox_open' );
		$html .= $icon_html . '<div class="iconbox-text">' . $title_html . '<div class="desc">' . do_shortcode( $content ) . '</div>' . $link_html . '</div>';
		$html .= do_action( 'k2t_iconbox_close' );
		$html .= '</div>';

		$style  = '<style>';
		$iconbox_id = '#' . $iconbox_id;
		if ( $bgcolor ) {
			switch ($layout) {
				case '1':
					# code...
					break;
				case '2':
					$style .= $iconbox_id . '.layout-2:hover { background-color: ' . $bgcolor . ';}'; 
					break;
				case '3':
					$style .= $iconbox_id . '.layout-3 .iconbox-icon i { background-color: ' . $bgcolor . ';}'; 
					$style .= $iconbox_id . '.layout-3:hover .iconbox-icon i { border-color: ' . $bgcolor . ';background-color: transparent; color: ' . $bgcolor . ' !important }'; 
					break;
			}
		}
		if ( $color ) {
			$style .= $iconbox_id . ' .title h3,' . $iconbox_id . ' .title a {' . $color . '}';
		}
		if ( $color_hover ) {
			$style .= $iconbox_id . ' .title a:hover {color: ' . $color_hover . '}';
		}
		$style .= '</style>';

		// var_dump( $style );

		$html .= $style;
		// Apply filters return
		$html = apply_filters( 'k2t_iconbox_return', $html );

		return $html;
	}
}
