<?php
/**
 * The template for displaying all single posts.
 *
 * @package cortex
 */

get_header();
global $cortex_options;
$cortex_theme_options = $cortex_options;
$cortex_theme_style   = $cortex_theme_options['c9-theme-style'];

?>
	<div id="primary" class="content-area post-content<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) {
			the_post();

			$cortex_gallery_type  = get_field( 'gallery_type' );
			$cortex_featured_header = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
			$cortex_heading   = get_field( 'heading' );
			$cortex_sub_heading  = get_field( 'sub_heading' );
			$cortex_enable_overlay = sanitize_html_class( get_field( 'enable_overlay' ) );
			$cortex_heading_font_color = sanitize_html_class( get_field( 'heading_font_color' ) );


			//if enable overlay isn't set, set it to true by default
			if ( empty($cortex_enable_overlay) ) {$cortex_enable_overlay = 'default';}

			//overlay logic
			if ( $cortex_enable_overlay == 'default' ) {
				if ( has_post_thumbnail() ) {
					$cortex_enable_overlay = ' dark-overlay';
				} else {
					$cortex_enable_overlay = ' no-overlay';
				}
			} elseif ( $cortex_enable_overlay == 'dark-overlay' ) {
				$cortex_enable_overlay = ' dark-overlay';
			} else {
				$cortex_enable_overlay = ' no-overlay';
			}

			//if the heading font color hasn't been picked, set it to default
			if ( empty($cortex_heading_font_color) ) {$cortex_heading_font_color = 'default';}

			//heading font color logic
			if ( $cortex_heading_font_color == 'default' ) {

				if ( ($cortex_theme_style == 'light') && ( ! has_post_thumbnail() ) ) {
					$cortex_color_switch = ' dark-color-text';
				} else {
					if ( $cortex_gallery_type == 'flex-slider' ) {
						$cortex_color_switch = ' dark-color-text';
					} else {
						$cortex_color_switch = ' light-color-text';
					}
				}

			} elseif ( $cortex_heading_font_color == 'light-color-text' ) {
					$cortex_color_switch = ' light-color-text';
			} else {
					$cortex_color_switch = ' dark-color-text';
			}

		?>

			<section id="section-portfolio-header" class="content-single content-porfolio">
			<?php
			if ( $cortex_gallery_type == 'flex-slider' ) {
				include( locate_template( 'parts/post-format-gallery-flex.php' ) );
			} else {
				include( locate_template( 'parts/post-format-default-header.php' ) );
			}
		?>
			</section>
			<section id="section-porfolio-body" class="content-portfolio-body<?php if ( $post->post_content !== '' ) {  echo ' mar20T'; }?>">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<?php include( locate_template( 'parts/post-format-gallery-body.php' ) ); ?>
						</div><!--end col-->
					</div>
				</div><!--end contaienr-->
			</section>
			<?php
		} // end of the loop ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
