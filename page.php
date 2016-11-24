<?php
/**
 * The template for displaying pages
 *
 * @package cortex
 */

get_header();

global $cortex_options;
$cortex_theme_options = $cortex_options;
$cortex_sidebar     = $cortex_theme_options['c9-page-sidebar'];

while ( have_posts() ) {
	the_post();


	$cortex_background			 = get_field( 'custom_background' );
	$cortex_backgroundColor		 	 = get_field( 'background_color' );
	$cortex_backgroundImage		 	 = esc_url( get_field( 'background_image' ) );
	$cortex_backgroundPattern			 = esc_url( get_field( 'background_pattern' ) );
	$cortex_backgroundRepeat			 = get_field( 'background_pattern_repeat' );

	/*check to see if the background color or background images are set and add in any css to a $cortex_page_style variable*/
	if ( $cortex_background != 'none' ) {

		if ( ( $cortex_backgroundColor != '' ) || ( $cortex_backgroundImage != '' ) || ( $cortex_backgroundPattern != '' ) ) {
			$cortex_page_style    = 'style="';
		}
		if ( $cortex_backgroundColor != '' ) {
			$cortex_page_style  .= "background-color: $cortex_backgroundColor; ";
		}
		if ( ( $cortex_backgroundImage != '' ) && ( $cortex_background == 'image' ) ) {
			$cortex_page_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat; background-position: 0% 0%;";
		}
		if ( ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'pattern' ) ) || ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'color_pattern' ) ) ) {
			$cortex_page_style  .= "background-image: url($cortex_backgroundPattern); background-repeat: $cortex_backgroundRepeat;";
		}
	} //end checking for custom background
?>
	<div id="primary" class="content-area page-content<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>" <?php if ( ! empty( $cortex_page_style ) ) { echo ' '.$cortex_page_style . '"'; } ?>>
		<main id="main" class="site-main" role="main">

		<?php
		switch ( $cortex_sidebar ) {
			case 'sidebar-none' :

				include( locate_template( 'parts/content-page-none.php' ) );
				wp_reset_query();

			break;
			case 'sidebar-left' :

				include( locate_template( 'parts/content-page-left.php' ) );
				wp_reset_query();

			break;
			case 'sidebar-right' :

				include( locate_template( 'parts/content-page-right.php' ) );
				wp_reset_query();

			break;
			default:

				include( locate_template( 'parts/content-page-right.php' ) );
				wp_reset_query();

			break;
		}

?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php

} //endwhile;  end of the loop.
?>
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
