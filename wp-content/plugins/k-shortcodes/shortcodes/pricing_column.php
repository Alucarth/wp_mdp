<?php
/**
 * Shortcode pricing.
 *
 * @since  1.0
 * @author LunarTheme
 * @link   http://www.lunartheme.com
 */

if ( ! function_exists( 'k2t_pricing_column_shortcode' ) ) {
	function k2t_pricing_column_shortcode( $atts, $content ) {
		$html = $title = $sub_title = $image = $price = $price_per = $unit = $link = $link_text = $link_target = $featured = $class = '';
		extract( shortcode_atts( array(
			'title' 			=> '',
			'sub_title'       	=> '',
			'image'  			=> '',
			'price' 			=> '',
			'price_per' 		=> '',
			'unit' 				=> '',
			'link' 				=> '',
			'link_text' 		=> 'SIGN UP NOW',
			'link_target' 		=> '_blank',
			'featured' 			=> 'false',
			'class'     		=> '',
		), $atts ) );
		//Global $cl
		$cl = array( 'k2t-pricing' );

		$image_html = '';
		if ( !empty( $image ) ){
			$img_id = preg_replace( '/\s/', '', $image );
			$img_id = preg_replace( '/([^\d])[^;]*;/', '', $img_id  );
			$img_id = preg_replace( '/[^\d]/', '', $img_id  );
			$image_html = wp_get_attachment_image( $img_id, 'full' );
		}

		// Convert to Html data
		$price_html = !empty( $price ) ? '<span>'. $price .'</span>' : '';
		$unit_html = !empty( $unit ) ? '<sup>'. $unit .'</sup>' : '';
		$price_per_html = !empty( $price_per ) ? '/'. $price_per : '';
		$button_html = !empty( $link ) ? do_shortcode( '[button target="'. $link_target .'" link="'. $link .'" icon_position="right" size="medium" align="center" anm_name="bounce" button_style="green" title="'. $link_text .'"]' ) : '';

		// Class
		$column_class = '';

		if ( $featured == 'true' ){
			$column_class .= ' pricing-special ';
		}

        $html .= '<div class="pricing-column '. $column_class .'">
            <div class="k2t-element-hover">
                <div class="pricing-header">
                	<div class="pricing-image">' . $image_html . '</div>
                    <h3 class="pricing-title">'.$title.'</h3>
                    <p class="pricing-sub_title">'.$sub_title.'</p></div>
                <div class="price">'. $unit_html . $price_html . $price_per_html .'</div>
                <div class="description">'. $content .'</div>
                <div class="pricing-footer">'. $button_html .'</div>
            </div>			
        </div>';

        //Apply filters return
		$html = apply_filters( 'k2t_pricing_column_shortcode', $html );
		return $html;
	}
}
