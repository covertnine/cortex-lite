<?php
/**
 * Post type project
 *
 * @package cortex
 */
get_header();

global $cortex_options;
$cortex_theme_options = $cortex_options;
$cortex_backgroundColor   = get_field( 'background_color' );
$cortex_backgroundImage   = esc_url( get_field( 'background_image' ) );

// needs to change for theme setting
if ( empty( $cortex_sidebar ) ) { $cortex_sidebar = 'sidebar-default'; }

/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
if ( ($cortex_backgroundColor != '') || ($cortex_backgroundImage != '') ) {
	$cortex_style    = 'style="';
}
if ( $cortex_backgroundColor != '' ) {
	$cortex_style  .= "background-color: $cortex_backgroundColor;";
}
if ( $cortex_backgroundImage != '' ) {
	$cortex_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat;";
}
if ( ($cortex_backgroundColor != '' ) || ($cortex_backgroundImage != '') ) {
	$cortex_style    .= '"';
}

?>

	<div id="primary" class="content-area<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>">
		<main id="main" class="site-main content-project" role="main">

			<section id="section-project-header" class="content-single" <?php if ( ! empty( $cortex_style ) ) { echo ' '.$cortex_style; } ?>>
				<?php include( locate_template( 'parts/project-header.php' ) ); ?>
			</section>

        <?php
		/**
		 * Cortex Page Builder
		 **/
		if ( have_rows( 'cortex_page_builder' ) ) {

			$cortex_counter = 0;

			while ( have_rows( 'cortex_page_builder' ) ) {
				the_row();

				// revolution slider
				if ( get_row_layout() == 'full_page_slider' ) {

					include( locate_template( 'page-builder/content-full_page_slider.php' ) );

					// blog or latest posts
				} elseif ( get_row_layout() == 'blog_latest' ) {

					include( locate_template( 'page-builder/content-blog_latest.php' ) );

					// blog or latest posts slider
				} elseif ( get_row_layout() == 'blog_latest_slider' ) {

					include( locate_template( 'page-builder/content-blog_latest_slider.php' ) );

					// magazine latest posts
				} elseif ( get_row_layout() == 'magazine_latest' ) {

					include( locate_template( 'page-builder/content-blog_magazine.php' ) );

					// magazine latest posts with most recent featured
				} elseif ( get_row_layout() == 'magazine_latest_featured' ) {

					include( locate_template( 'page-builder/content-blog_magazine_featured.php' ) );

					// revolution slider wide format
				} elseif ( get_row_layout() == 'full_width_slider' ) {

					include( locate_template( 'page-builder/content-full_width_slider.php' ) );

					// flex slider
				} elseif ( get_row_layout() == 'simple_slider' ) {

					include( locate_template( 'page-builder/content-simple_slider.php' ) );

					// basic_title_text
				} elseif ( get_row_layout() == 'basic_title_text' ) {

					include( locate_template( 'page-builder/content-basic_title_text.php' ) );

					// full width image
				} elseif ( get_row_layout() == 'full_width_image' ) {

					include( locate_template( 'page-builder/content-full_width_image.php' ) );

					// normal wp editor
				} elseif ( get_row_layout() == 'wp_editor' ) {

					include( locate_template( 'page-builder/content-wp_editor.php' ) );

					// masonry portfolio
				} elseif ( get_row_layout() == 'masonry_portfolio' ) {

					include( locate_template( 'page-builder/content-masonry_portfolio.php' ) );

					// masonry posts
				} elseif ( get_row_layout() == 'masonry_posts' ) {

					include( locate_template( 'page-builder/content-masonry_posts.php' ) );

					// masonry projects
				} elseif ( get_row_layout() == 'masonry_projects' ) {

					include( locate_template( 'page-builder/content-masonry_projects.php' ) );

					// events
				} elseif ( get_row_layout() == 'events_listing' ) {

					include( locate_template( 'page-builder/content-events_listing.php' ) );

					// contact
				} elseif ( get_row_layout() == 'contact_form' ) {

					include( locate_template( 'page-builder/content-contact_form.php' ) );

					// insert custom code
				} elseif ( get_row_layout() == 'custom_code' ) {

					include( locate_template( 'page-builder/content-custom_code.php' ) );

					// hero
				} elseif ( get_row_layout() == 'hero' ) {

					include( locate_template( 'page-builder/content-hero.php' ) );

					// woocommerce
				} elseif ( get_row_layout() == 'woocommerce_products_grid' ) {

					include( locate_template( 'page-builder/content-woocommerce-grid.php' ) );

					// woocommerce slider
				} elseif ( get_row_layout() == 'woocommerce_products_slider' ) {

					include( locate_template( 'page-builder/content-woocommerce-slider.php' ) );

				} else {

				}
			}
		} //endif;
?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
