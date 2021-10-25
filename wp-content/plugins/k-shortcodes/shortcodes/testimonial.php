<?php
/**
 * Shortcode testimonial.
 *
 * @since  1.0
 * @author LunarTheme
 * @link   http://www.lunartheme.com
 */

if ( ! function_exists( 'k2t_testimonial_shortcode' ) ) {
	function k2t_testimonial_shortcode( $atts, $content ) {
		$html = $style = $image_html = $enable_pagination = $position_author = '';
		extract( shortcode_atts( array(
			'items'	        => '3',
			'items_desktop' => '3',
			'items_tablet'  => '3',
			'items_mobile'  => '3',
			'style'			=> 'style-1',
			'item_margin'	=> '0',
			'enable_pagination' => 'false',
			'position_author' => 'top',
			'navigation'    => '',
			'pagination'    => '',
			'id'		    => '',
			'class'         => '',
		), $atts));
		wp_enqueue_script( 'k2t-owlcarousel' );

		$content = str_replace( '»','"', $content);
		// Generate random id
		$length = 10;
		$id     = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, $length );
		switch ( $style ) {
			case 'style-1':
				$html .= '<div class="k2t-testimonial k2t-itesti ' . $style . ' "><div id="' . $id . '" class="owl-carousel ' . $class . '" data-items="1" data-autoPlay="true" data-margin="0" data-loop="true" data-nav="false"	data-dots="' . $enable_pagination . '" data-mobile="1" data-tablet="1" data-desktop="1" data-URLhashListener="true">';

				if (!preg_match_all("/(.?)\[(testi)\b(.*?)(?:(\/))?\](?:(.+?)\[\/testi\])/s", $content, $matches)) :
					return do_shortcode($content);
				else :
					for($i = 0; $i < count($matches[0]); $i++):
						$shortcode_str     = preg_replace( '/&#[^;]*;/', '"', $matches[3][$i] );
						$testi_obj         = shortcode_parse_atts( $shortcode_str );
						$testi_content     = $matches[5][$i];
						$image             = isset($testi_obj['image']) ? $testi_obj['image'] : '' ;
						$testi_obj['name'] = isset( $testi_obj['name'] ) ? preg_replace( '/([^\d])[^;]*;/', '', $testi_obj['name'] ) : '';
						if( $position_author == 'top'){
							$html .= '<div data-hash="testi-'. esc_attr( $i ) .'"><div class="testimonial-info"><div class="testimonial-meta">'. esc_html( $testi_obj['name'] ) . '</div>';

							if ( isset( $testi_obj['position_teacher'] ) && $testi_obj['position_teacher'] ) {
								$html .= '<div class="testimonial-position">' . esc_html__(' - ', 'k2t-shortcodes' ) .  $testi_obj['position_teacher'] . '</div>';
							}
							$html .='</div><div class="testimonial-content"><div class="speech">' . do_shortcode( $testi_content ) . '</div></div></div>';
						}
						else 
							$html .= '<div data-hash="testi-'. esc_attr( $i ) .'"><div class="testimonial-content"><div class="speech">' . do_shortcode( $testi_content ) . '</div></div><div class="testimonial-info"><div class="testimonial-meta bottom">'. esc_html( $testi_obj['name'] ) .'</div></div></div>';
						if ( !empty( $image ) ){
							$img_id = preg_replace( '/\s/', '', $image );
							$img_id = preg_replace( '/([^\d])[^;]*;/', '', $img_id  );
							$img_id = preg_replace( '/[^\d]/', '', $img_id  );
				
							$img_html = wp_get_attachment_image( $img_id, 'full' );
							
							$image_html .= '<a href="#testi-'. esc_attr( $i ) .'">' . $img_html . '</a>';
						}
					endfor;
					$html .= '</div>';

					// 
					if ( ! empty( $image_html ) ) {
						$html .= '<div class="testimonial-image">'. $image_html .'</div>';
					}

				endif;
				$html .= '</div>';
				break;
			
			default:
				$html .= '<div class="k2t-testimonial k2t-itesti ' . $style . '"><div id="' . $id . '" class="owl-carousel ' . $class . '" data-items="'.$items.'" data-autoPlay="true" data-margin="30" data-loop="true" data-nav="false"	data-dots="' . $enable_pagination . '" data-mobile="'.$items_mobile.'" data-tablet="'.$items_tablet.'" data-desktop="'.$items_desktop.'" data-URLhashListener="true">';
				if (!preg_match_all("/(.?)\[(testi)\b(.*?)(?:(\/))?\](?:(.+?)\[\/testi\])/s", $content, $matches)) :
					return do_shortcode($content);
				else :
					for($i = 0; $i < count($matches[0]); $i++):
						$shortcode_str     = preg_replace( '/&#[^;]*;/', '"', $matches[3][$i] );
						$testi_obj         = shortcode_parse_atts( $shortcode_str );
						$testi_content 			= $matches[5][$i];
						$image 					= $testi_obj['image'];
						$testi_obj['name'] = preg_replace( '/([^\d])[^;]*;/', '', $testi_obj['name'] );
						if ( !empty( $image ) ){
							$img_id = preg_replace( '/\s/', '', $image );
							$img_id = preg_replace( '/([^\d])[^;]*;/', '', $img_id  );
							$img_id = preg_replace( '/[^\d]/', '', $img_id  );
				
							$img_html = wp_get_attachment_image( $img_id, 'full' );
							
							$image_html .= '<a href="#">' . $img_html . '</a>';
						}
						$html .= '<div class="k-item k2t-element-hover" data-hash="testi-'. esc_attr( $i ) .'"><div class="testimonial-info"><div class="testimonial-image">'. $image_html .'</div><div class="testimonial-meta"><div class="testimonial-name">'. esc_html( $testi_obj['name'] ) .'</div><div class="testimonial-position">' . esc_html($testi_obj['position_teacher']) . '</div></div></div><div class="testimonial-content"><div class="speech">"' . do_shortcode( $testi_content ) . '"</div></div></div>';
					endfor;
					$html .= '</div>';
				endif;
				$html .= '</div>';
				break;
		}
		//Apply filters return
		$html = apply_filters( 'k2t_k2t_slider_return', $html );

		return $html;
	}
}
