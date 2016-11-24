<?php
/**
 * Template Name: Page Builder Sidebar
 *
 * @package cortex
 */
get_header();

global $cortex_options;
$cortex_theme_options     = $cortex_options;
$cortex_sidebar       	  = $cortex_theme_options['c9-page-sidebar'];
$cortex_select_sidebar    = get_field( 'select_sidebar' );
$cortex_sidebar_display   = get_field( 'sidebar' );
$cortex_background		  = get_field( 'custom_background' );
$cortex_backgroundColor	  = get_field( 'background_color' );
$cortex_backgroundImage	  = esc_url( get_field( 'background_image' ) );
$cortex_backgroundPattern = esc_url( get_field( 'background_pattern' ) );
$cortex_backgroundRepeat  = get_field( 'background_pattern_repeat' );

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

/* sidebar logic for main body */
if ( ($cortex_sidebar == 'sidebar-none') || ( empty( $cortex_sidebar_display ) ) || ( $cortex_sidebar_display == 'sidebar-none' ) ) {

	$cortex_sidebar_logic = ' col-sm-12 col-md-12';
	$cortex_sidebar_enabled = false;

} elseif ( ($cortex_sidebar == 'sidebar-right') && ($cortex_sidebar_display == 'sidebar-default') ) {

	$cortex_sidebar_logic = ' col-sm-8 col-md-9';
	$cortex_sidebar_enabled = true;

} elseif ( ($cortex_sidebar == 'sidebar-left') && ($cortex_sidebar_display == 'sidebar-default') ) {

	$cortex_sidebar_logic = ' col-sm-8 col-sm-push-4 col-md-9 col-md-push-3';
	$cortex_sidebar_enabled = true;

} else {

	$cortex_sidebar_logic = ' col-sm-12 col-md-12';
	$cortex_sidebar_enabled = false;

}
?>

	<div id="primary" class="content-area page-builder<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?> page-builder-sidebar" <?php if ( ! empty( $cortex_page_style ) ) { echo ' '.$cortex_page_style . '"'; } ?>>
		<main id="main" class="site-main" role="main">
			<header class="page-builder-sidebar-header">
        <?php
		/**
		 * Cortex Header Builder
		 **/
		if ( have_rows( 'cortex_header_builder' ) ) {

			$cortex_counter = 0;

			while ( have_rows( 'cortex_header_builder' ) ) {
				the_row();

				// revolution slider
				if ( get_row_layout() == 'full_page_slider' ) {

					include( locate_template( 'page-builder/content-full_page_slider.php' ) );

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

					// insert custom code
				} elseif ( get_row_layout() == 'custom_code' ) {

					include( locate_template( 'page-builder/content-custom_code.php' ) );

					// insert posts slider
				} elseif ( get_row_layout() == 'blog_latest_slider_top' ) {

					include( locate_template( 'page-builder/content-blog_latest_slider-top-ns.php' ) );

					// hero
				} elseif ( get_row_layout() == 'hero' ) {

					include( locate_template( 'page-builder/content-hero.php' ) );

				} else {

				}
			}
		} //endif;
?>
			</header>

			<section class="cortex-page-builder-sidebar" id="page-<?php the_ID(); ?>">
				<div class="container">
					<div class="row">
						<div class="col-xs-12<?php echo $cortex_sidebar_logic; ?> cortex-page-builder-sidebar-main">

		        <?php
				/**
				 * Cortex Page Builder Full Sidebar
				 **/
				if ( have_rows( 'cortex_page_builder_sidebar' ) ) {



					$cortex_counter = 100;

					while ( have_rows( 'cortex_page_builder_sidebar' ) ) {
						the_row();

						// blog latest
						if ( get_row_layout() == 'blog_latest' ) {

							include( locate_template( 'page-builder/content-blog_latest-ns.php' ) );

							// magazine latest posts
						} elseif ( get_row_layout() == 'magazine_latest' ) {

							include( locate_template( 'page-builder/content-blog_magazine-ns.php' ) );

							// magazine latest posts with most recent featured
						} elseif ( get_row_layout() == 'magazine_latest_featured' ) {

							include( locate_template( 'page-builder/content-blog_magazine_featured-ns.php' ) );

							// revolution slider wide format
						} elseif ( get_row_layout() == 'full_width_slider' ) {

							include( locate_template( 'page-builder/content-full_width_slider-ns.php' ) );

							// insert posts slider
						} elseif ( get_row_layout() == 'blog_latest_slider' ) {

							include( locate_template( 'page-builder/content-blog_latest_slider-ns.php' ) );

							// flex slider
						} elseif ( get_row_layout() == 'simple_slider' ) {

							include( locate_template( 'page-builder/content-simple_slider-ns.php' ) );

							// basic_title_text
						} elseif ( get_row_layout() == 'basic_title_text' ) {

							include( locate_template( 'page-builder/content-basic_title_text-ns.php' ) );

							// full width image
						} elseif ( get_row_layout() == 'full_width_image' ) {

							include( locate_template( 'page-builder/content-full_width_image-ns.php' ) );

							// normal wp editor
						} elseif ( get_row_layout() == 'wp_editor' ) {

							include( locate_template( 'page-builder/content-wp_editor-ns.php' ) );

							// events
						} elseif ( get_row_layout() == 'events_listing' ) {

							include( locate_template( 'page-builder/content-events_listing-ns.php' ) );

							// contact
						} elseif ( get_row_layout() == 'contact_form' ) {

							include( locate_template( 'page-builder/content-contact_form-ns.php' ) );

							// insert custom code
						} elseif ( get_row_layout() == 'custom_code' ) {

							include( locate_template( 'page-builder/content-custom_code.php' ) );

							// woocommerce
						} elseif ( get_row_layout() == 'woocommerce_products_grid' ) {

							include( locate_template( 'page-builder/content-woocommerce-grid-ns.php' ) );

						} else {

						}
					}
				} //endif;
?>

						</div><!--end column-->

						<?php
							if ( $cortex_sidebar_enabled == true ) {
								if ( ! empty( $cortex_select_sidebar ) ) {
						?>
							<div class="sidebar wow animated slideInUp<?php if ( $cortex_sidebar == 'sidebar-right' ) { echo ' col-xs-12 col-sm-4 col-md-3';
} elseif ( $cortex_sidebar == 'sidebar-left' ) { echo ' col-xs-12 col-sm-4 col-sm-pull-8 col-md-pull-9';} ?>">
								<?php
									if ( is_active_sidebar($cortex_select_sidebar) ) {
										dynamic_sidebar($cortex_select_sidebar);
									} else {
										esc_html_e( 'You must select a sidebar for the page and assign widgets to it.', 'cortex' );
									}
								?>
							</div><!--end column-->
							<?php
							} // End of sidebar selected?
								 } //end of sidebar enabled
								 ?>

					</div><!--end row-->
				</div><!--end container-->
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
