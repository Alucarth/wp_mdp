<?php
/**
 * The top header for theme.
 *
 * @package Lincoln
 * @author  LunarTheme
 * @link	http://www.lunartheme.com
 */

if ( $smof_data['header_section_1'] != '' ) :
	// Get all data of top header
	$data = json_decode ( $smof_data[ 'header_section_1' ], true );

	// Get number of column display
	$col = $data['columns_num'];
	// Get section properties
	$class 				= array();
	$style    			= array();
	$fullwidth			= isset( $smof_data['fullwidth_setting_header_section_1'  ] ) ? $smof_data['fullwidth_setting_header_section_1'  ] : '';
	$header_height      = isset( $smof_data['header_height_setting_header_section_1'  ] ) ? $smof_data['header_height_setting_header_section_1'  ] : '' ;
	$hex      			= isset( $smof_data['bg_color_setting_header_section_1'   ] ) ? $smof_data['bg_color_setting_header_section_1'  ] : '';
	$bg_image 			= isset( $smof_data['bg_image_setting_header_section_1_upload' ] ) ? $smof_data['bg_image_setting_header_section_1_upload' ] : '' ;
	$opacity  			= isset( $smof_data['opacity_setting_header_section_1' ] ) ?  $smof_data['opacity_setting_header_section_1'  ] : '' ;
	$css      			= isset( $smof_data['custom_css_setting_header_section_1' ] ) ? $smof_data['custom_css_setting_header_section_1'  ] : '' ;
	$rgb      			= k2t_hex2rgb( $hex );
	if ( $opacity < 100 ) {
		$a = ', 0.' . $opacity;
	} else {
		$a = ', 1';
	}
	if ( $hex ) {
		$style[] = 'background-color: rgba(' . $rgb['0'] . ',' . $rgb['1'] . ',' . $rgb['2'] . $a .');';
	}
	if ( $bg_image ) {
		$style[] = 'background-image: url( ' . $bg_image . ' );';
		if ( $hex == '' &&  $opacity != '' ) {
			$style[] = 'opacity: ' . $opacity . ';';
		}
	}
	if ( $header_height ) {
		if ( is_numeric( $header_height ) ) {
			$style[] = 'height: ' . $header_height . 'px;';
		} else {
			$style[] = 'height: ' . $header_height . ';';
		}
	}
	
	if ( ! empty( $css )  ) {
		echo '<style>' . $css . '</style>';
	}
	/**
	 * Top header output.
	 *
	 * @since  1.0
	 */
	function k2t_top_header_value( $data, $id, $section ) {
		$values = $data['columns'][$id]['value'];
		$i = 0;
		foreach ( $values as $val ) {
			if ( function_exists( 'k2t_data' ) ) {
				k2t_data( $id, $i, $section );
			}
			$i++;
		}
	}
	?>
	<div class="k2t-header-top <?php echo implode( ' ', $class ); ?>" style="<?php echo esc_attr( implode( ' ', $style ) ); ?>">
		<div class="k2t-wrap">
			<div class="k2t-row">
				<?php
					$section = 'header_section_1';
					for ( $i = 0; $i < $col; $i++ ) {
						echo '<div class="col-' . esc_attr( $data['columns'][$i]['percent'] ) . '">';
							k2t_top_header_value( $data, $i, $section );
						echo '</div>';
					}
				?>
			</div><!-- .row -->
		</div><!-- .k2t-wrap -->
	</div><!-- .k2t-header-top -->
<?php endif; ?>
