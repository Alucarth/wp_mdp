<?php
/**
 * The template display blog navigation.
 *
 * @package Lincoln
 * @author  LunarTheme
 * @link	http://www.lunartheme.com
 */

global $wp_query, $wp_rewrite, $smof_data;

$nav_query = $nav = '';

// Prepare variables
$query        = $nav_query ? $nav_query : $wp_query;
if ( isset( $ld_pt ) ) {
	$pt = str_replace( 'sfwd-', '', $ld_pt );
	$query = ${$pt};
}
$max          = $query->max_num_pages;
$big          = 99999;
$current     = max( 1, $_GET['ld-paged'] );
$current_url = "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$current_url = remove_query_arg( 'ld-paged', $current_url ); 

// Get type of page navigation if necessary

if ( $max > 1 ) : ?>
	<div class="k2t-navigation">
		<ul class="page-numbers">
			<?php 
				for ($i=1; $i <= $max ; $i++) { 
					$link  = add_query_arg( 'ld-paged', $i , $current_url );
					$classes = ( $i == $current ) ? 'page-numbers current' : 'page-numbers';
					echo '<li><a class="' . $classes . '" href="' . esc_url( $link ) . '">' . $i . '</a></li>';
				}
			?>
		</ul>
	</div>
	<?php
endif;
