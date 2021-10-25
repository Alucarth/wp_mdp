<?php
/**
 * Shortcode clear.
 *
 * @since  1.0
 * @author LunarTheme
 * @link   http://www.lunartheme.com
 */

if ( ! function_exists( 'k2t_fake_instagram_shortcode' ) ) {
	function k2t_fake_instagram_shortcode( $atts, $content = null ) {

		$html = $images = $user = $id = $class = '';

		extract( shortcode_atts( array(
			'images'		=> '',
			'user'			=> '',
			'id'        	=> '',
			'class'     	=> '',
		), $atts ) );

		$imgs = explode( ',', $images );

		$html = '<div class="k2t-Instagram columns-3">';

		foreach ($imgs as $key => $id ) {

			$obj_img = get_post( $id );

			$html .= '<div class="instagram-item">';
			$html .= '<a href="' . $obj_img->post_content . '">' . wp_get_attachment_image( $id, 'full' ) .  '</a>';
			$html .= '</div>';
			
		}

		$html .= '<p class="follow"><a href="' . 'https://www.instagram.com/' . $user . '" ><i class="fa fa-instagram"></i>@' . $user . '</a></p>' ;

		$html .= '</div>';

		//Apply filters return
		$html = apply_filters( 'k2t_fake_instagram_shortcode', $html );

		return $html;
	}
}
