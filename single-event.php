<?php
/**
 * Post type project
 *
 * @package cortex
 */
get_header();

global $cortex_options;
$cortex_theme_options 	= $cortex_options;
$cortex_sidebar     	= $cortex_theme_options['c9-post-sidebar'];

?>

	<div id="primary" class="content-area<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>">
		<main id="main" class="site-main content-project" role="main">
			<?php
			while ( have_posts() ) {
				the_post();
				switch ( $cortex_sidebar ) {
					case 'sidebar-none' :

						include( locate_template( 'parts/event-single-none.php' ) );
						wp_reset_query();

					break;
					case 'sidebar-left' :

						include( locate_template( 'parts/event-single-left.php' ) );
						wp_reset_query();

					break;
					case 'sidebar-right' :

						include( locate_template( 'parts/event-single-right.php' ) );
						wp_reset_query();

					break;
					default:

						include( locate_template( 'parts/event-single-right.php' ) );
						wp_reset_query();

					break;
				}
			} //endwhile; end of the loop.
?>


		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
