<?php
/**
 * Additional Information tab
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'k2t' ) );

?>

<?php if ( $heading ): ?>
	<h2><?php echo esc_html( $heading ); ?></h2>
<?php endif; ?>

<?php wc_display_product_attributes( $product ); ?>
