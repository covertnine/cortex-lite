<?php
/**
 * The template for displaying all single posts.
 *
 * @package cortex
 */

get_header();

global $cortex_options;
$cortex_theme_options = $cortex_options;
$cortex_sidebar      = $cortex_theme_options['c9-post-sidebar'];
?>
	<div id="primary" class="content-area post-content<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) {
			the_post();

			switch ( $cortex_sidebar ) {
				case 'sidebar-none' :

					include( locate_template( 'parts/content-single-none.php' ) );
					wp_reset_query();

				break;
				case 'sidebar-left' :

					include( locate_template( 'parts/content-single-left.php' ) );
					wp_reset_query();

				break;
				case 'sidebar-right' :

					include( locate_template( 'parts/content-single-right.php' ) );
					wp_reset_query();

				break;
				default:

					include( locate_template( 'parts/content-single-right.php' ) );
					wp_reset_query();

				break;
			}
		} // end of the loop.
?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
