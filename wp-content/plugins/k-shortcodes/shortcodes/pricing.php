<?php
/**
 * Shortcode pricing.
 *
 * @since  1.0
 * @author LunarTheme
 * @link   http://www.lunartheme.com
 */

if ( ! function_exists( 'k2t_pricing_shortcode' ) ) {
	function k2t_pricing_shortcode( $atts, $content ) {
		$html = $separated = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = '';
		extract( shortcode_atts( array(
			'separated' 		=> 'false',
			'anm'       		=> '',
			'anm_name'  		=> '',
			'anm_delay' 		=> '',
			'id'        		=> '',
			'class'     		=> '',
			'pricing_content' 	=> '',
		), $atts ) );
		//Global $cl
		$cl = array( 'k2t-pricing' );

		if ( $anm ) {
			$anm        = ' animated';
			$data_name  = ' data-animation="' . $anm_name . '"';
			$data_delay = ' data-animation-delay="' . $anm_delay . '"';
		}
		$id    = ( $id != '' ) ? ' id="' . $id . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';
	
		preg_match_all( "/(.?)\[(pricing_column)\b(.*?)(?:(\/))?\]/s", $content, $matches );

		$number_pricing_column = count( $matches[0] );
		//Add class number process
		$cl[] = 'pricing-'.$number_pricing_column;
		//Check has-del
		if ( trim( $old_price_check ) == '' ) { $cl[] = 'no-del';} else {$cl[] = 'has-del';}

		//Check separated true or false
		if ( trim( $separated ) == 'true' ) { $cl[] = 'separated';}

		//Apply filters to cl
		$cl = apply_filters( 'k2t_pricing_classes', $cl );

		//Join cl class
		$cl = join( ' ', $cl );

		$columns = count( $matches[0] );
		if ( $columns > 5 ) $columns = 5;

		$html = '<section class="table-'. $columns .'col clearfix '.trim( $cl ) .'">';
		$html .= do_action( 'k2t_pricing_open' );
		ob_start();
		echo do_shortcode( $content );
		$html .= ob_get_clean();

        $html .= do_action( 'k2t_pricing_close' );              
        $html .= '</section>';
        //Apply filters return
		$html = apply_filters( 'k2t_pricing_return', $html );
		return $html;
	}
}


