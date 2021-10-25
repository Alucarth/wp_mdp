<?php
/**
 * The template for displaying search results pages.
 *
 * @package Lincoln
 * @author  LunarTheme
 * @link	http://www.lunartheme.com
 */

get_header(); ?>

	<section class="k2t-content right-sidebar page-search-custom">
		<div class="k2t-wrap">
			<main class="k2t-main entry-box k2t-element-hover" role="main" style="padding: 30px">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Buscando resultados para: %s', 'k2t' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'search' );
				endwhile;
				else :
					get_template_part( 'content', 'none' );
				endif;

				include_once K2T_TEMPLATE_PATH . 'navigation.php';
			?>

			</main><!-- #main -->

			<?php get_sidebar(); ?>
		</div><!-- .k2t-wrap -->
	</section><!-- .k2t-content -->

<?php get_footer(); ?>
