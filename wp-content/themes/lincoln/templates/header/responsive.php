<?php
/**
 * The template for displaying menu responsive.
 *
 * @package Lincoln
 * @author  LunarTheme
 * @link	http://www.lunartheme.com
 */

// Get theme options
global $smof_data;

// Get logo type
$logo = isset ( $smof_data['logo'] ) ? trim( $smof_data['logo'] ) : '';
$header_style = empty( $smof_data['header_style'] ) ? '' : $smof_data['header_style'];
?>
<div class="k2t-header-m">
	
	<!-- top menu mobile -->

	<?php if ( isset( $smof_data['show_mm_top'] ) && $smof_data['show_mm_top'] ) : ?>

		<?php 
			$style_inline = '';
			if ( $smof_data['top-section-color'] ) $style_inline = 'style="background-color: ' . $smof_data['top-section-color'] . ';"';
		?>

		<div class="top-main-menu-mobile" <?php echo $style_inline; ?> >

			<!-- top menu mobile -->

			<div class="top-m-info">
				<?php echo wp_kses_post( do_shortcode( $smof_data['top_mm_desc'] ) );?>
			</div>

			<!-- social -->
			
			<?php if ( $smof_data['top_mm_social'] || $smof_data['top_mm_cart'] ) : ?>

			<div class="top-mm-right">

				<?php if ( $smof_data['top_mm_social'] ) : ?>

					<div class="top-m-social">
						<i class="zmdi zmdi-share"></i><?php if ( function_exists( 'aslan_social_share' ) ) { k2t_social_share( 'had-shadow',true, '40', '10' ); }?>
					</div>

				<?php endif;?>
				<?php 
 					if ( $smof_data['top_mm_cart'] ) k2t_cart('','','');
				?>
			</div>

			<?php endif;?>

		</div><!-- top menu mobile -->

	<?php endif;?>

	<div class="main-menu-m">
		<div class="k2t-menu-m">
			<a class="m-trigger mobile-menu-toggle">
				<div class="main-mm-trigger hamburger hamburger--slider js-hamburger">
	        		<div class="hamburger-box">
	          		<div class="hamburger-inner"></div>
	        		</div>
	      		</div>
	      	</a>

			<div class="mobile-menu-wrap dark-div">

				<a class="m-trigger">
					<div class="hamburger hamburger--slider js-hamburger">
		        		<div class="hamburger-box">
		          		<div class="hamburger-inner"></div>
		        		</div>
		      		</div>
		      	</a>

				<div class="top-mobile-menu">

		      	<!-- Login -->

		      	<?php
		      		if ( isset( $smof_data['toggle_mm_login'] ) && $smof_data['toggle_mm_login'] ) : 
		      			if ( is_user_logged_in() ) : 
		      				$current_user = wp_get_current_user();
				      		echo '<div class="mobi-menu-login logged">';
				      		if ( class_exists('WooCommerce') ) :
				      			echo '<a href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '" title="' . esc_html__('My Account','k2t') . '">' . esc_html__('Hi ','k2t') . $current_user->display_name . '</a>';
				      		else :
				      			echo '<span>' . esc_html__('Hi! ','k2t') . $current_user->display_name . '</span>';
				      		endif;
				      		echo '</div>';
				      	else : 
				      		echo '<div class="mobi-menu-login">';
				      		if ( class_exists('WooCommerce') ) :
				      			echo '<a href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '" title="' . esc_html__('My Account','k2t') . '">' . esc_html__('Login','k2t') . '</a>';
				      		else :
				      			echo '<a href="' . wp_login_url( get_permalink() ) . '" title="Login">' . esc_html__( 'Login', 'k2t' ) . '</a>';
				      		endif;
				      		echo '</div>';
				      	endif;

				    else : 

				    	k2t_logo( '', '', '' );

		      		endif;
		      	?>

		      	</div><!-- End top mobile menu -->

				<ul class="mobile-menu">
					<?php
						wp_nav_menu(array(
							'theme_location'  => 'mobile',
							'container' => false,
							'items_wrap' => '%3$s',
							'before'	 => '<div class="wrap-link-item">',
							'after'		 => '<span class="open-sub-menu"></span></div>',
						));
					?>
				</ul>
			</div>
		</div>

		<div class="k2t-logo-m">
			<?php if ( $logo == '' || ( isset( $smof_data[ $header_style . 'text_logo'] ) && $smof_data[ $header_style . 'use_text_logo'] ) ) : ?>
				<h1 class="logo-text">
					<a class="k2t-logo" rel="home" href="<?php echo esc_url( home_url( "/" ) ); ?>">
						<?php
							if ( ! isset( $smof_data[ $header_style . 'text_logo'] ) || empty( $smof_data[ $header_style . 'text_logo'] ) ) {
								echo esc_html( bloginfo( 'name' ) );
							} else {
								echo esc_html( $smof_data[ $header_style . 'text_logo'] );
							}
						?>
					</a><!-- .k2t-logo -->
				</h1><!-- .logo-text -->
			<?php else : ?>
				<a class="k2t-logo" rel="home" href="<?php echo esc_url( home_url( "/" ) ); ?>">
					<img src="<?php echo esc_url( $logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) );?>" />
				</a><!-- .k2t-logo -->
			<?php endif; ?>
		</div><!-- .k2t-logo-m -->

		<div class="k2t-right-m">
			<div class="search-box">
				<span> <i class="fa fa-search"></i> </span>
			</div><!-- .search-box -->
		</div><!-- .k2t-right-m -->
	</div><!-- main menu mobile -->
</div><!-- .k2t-header-m -->