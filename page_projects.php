<?php
/**
 * Template Name: Projects Page
 *
 * @package cortex
 */

get_header();

global $cortex_options;
$cortex_theme_options = $cortex_options;
$cortex_theme_style   = $cortex_theme_options['c9-theme-style'];

?>
	<div id="primary" class="content-area page-content page-project<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>">
		<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();

						$cortex_backgroundColor     = get_field( 'background_color' );
						$cortex_backgroundImage    = esc_url( get_field( 'background_image' ) );
						$cortex_category       = get_field( 'project_category' );
						$cortex_orderBy      = get_field( 'order_by' );
						$cortex_custom_background = get_field( 'custom_background' );
						$cortex_backgroundPattern    = esc_url( get_field( 'background_pattern' ) );
						$cortex_backgroundRepeat    = get_field( 'background_pattern_repeat' );
						$cortex_backgroundParallax    = get_field( 'background_image_parallax' );
						$cortex_project_page_heading    = get_field( 'project_page_heading' );
						$cortex_project_page_sub_heading  = get_field( 'project_page_sub_heading' );
						$cortex_heading_custom_background  = get_field( 'heading_custom_background' );
						$cortex_heading_backgroundColor   = get_field( 'heading_background_color' );
						$cortex_heading_backgroundImage  = esc_url( get_field( 'heading_background_image' ) );
						$cortex_heading_backgroundPattern  = esc_url( get_field( 'heading_background_pattern' ) );
						$cortex_heading_backgroundRepeat  = get_field( 'heading_background_pattern_repeat' );
						$cortex_project_page_width    = get_field( 'width' );
						$cortex_columns      = get_field( 'columns' );
						$cortex_enable_overlay = sanitize_html_class( get_field( 'enable_overlay' ) );
						$cortex_heading_font_color = sanitize_html_class( get_field( 'heading_font_color' ) );

						/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
						if ( $cortex_custom_background != 'none' ) {

							if ( ( $cortex_backgroundColor != '' ) || ( $cortex_backgroundImage != '' ) || ( $cortex_backgroundPattern != '' ) ) {
								$cortex_style    = 'style="';
							}
							if ( $cortex_backgroundColor != '' ) {
								$cortex_style  .= "background-color: $cortex_backgroundColor; ";
							}
							if ( ( $cortex_backgroundImage != '' ) && ( $cortex_custom_background == 'image' ) ) {
								$cortex_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat; background-position: center center;";
							}
							if ( ( ( $cortex_backgroundPattern != '' ) && ( $cortex_custom_background == 'pattern' ) ) || ( ( $cortex_backgroundPattern != '' ) && ( $cortex_custom_background == 'color_pattern' ) ) ) {
								$cortex_style  .= "background-image: url($cortex_backgroundPattern); background-repeat: $cortex_backgroundRepeat;";
							}
						} //end checking for custom background

				?>

							<section id="section-project-listing" class="project-listing section-bg masonry_project" <?php if ( $cortex_backgroundParallax == 'yes' ) { echo 'data-bottom-top="background-position: 0px 0px;" data-top-bottom="background-position: 0% -200%;" data-anchor-target="#section-project-listing"'; } ?> <?php if ( ! empty( $cortex_style ) ) { echo $cortex_style.'"'; } ?>>

				<?php
						/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
				if ( $cortex_heading_custom_background != 'none' ) {

					if ( ( $cortex_heading_backgroundColor != '' ) || ( $cortex_heading_backgroundImage != '' ) || ( $cortex_heading_backgroundPattern != '' ) ) {
						$cortex_heading_style    = 'style="';
					}
					if ( $cortex_heading_backgroundColor != '' ) {
						$cortex_heading_style  .= "background-color: $cortex_heading_backgroundColor; ";
					}
					if ( ( $cortex_heading_backgroundImage != '' ) && ( $cortex_heading_custom_background == 'image' ) ) {
						$cortex_heading_style  .= "background-image: url($cortex_heading_backgroundImage); background-size: cover; background-repeat: no-repeat; background-position: center center;";
					}
					if ( ( ( $cortex_heading_backgroundPattern != '' ) && ( $cortex_heading_custom_background == 'pattern' ) ) || ( ( $cortex_heading_backgroundPattern != '' ) && ( $cortex_heading_custom_background == 'color_pattern' ) ) ) {
						$cortex_heading_style  .= "background-image: url($cortex_heading_backgroundPattern); background-repeat: $cortex_heading_backgroundRepeat;";
					}
				} //end checking for custom background

				//if enable overlay isn't set, set it to true by default
				if ( empty($cortex_enable_overlay) ) {$cortex_enable_overlay = 'default';}

				//overlay logic
				if ( $cortex_enable_overlay == 'default' ) {
					if ( ! empty($cortex_heading_backgroundImage) ) {
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

					if ( ($cortex_theme_style == 'light') && ( empty($cortex_heading_backgroundImage) ) && ( empty($cortex_heading_backgroundPattern) ) ) {
						$cortex_color_switch = ' dark-color-text';
					}

				} elseif ( $cortex_heading_font_color == 'light-color-text' ) {
						$cortex_color_switch = ' light-color-text';
				} else {
						$cortex_color_switch = ' dark-color-text';
				}
				?>

				<header id="section-project-heading" class="project-page-header">
					<div class="project-header-text" data-130-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".project-header-text h1">
						<h1 class="center mar30B<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php if ( ! empty( $cortex_project_page_heading ) ) { echo $cortex_project_page_heading;
} else { the_title(); } ?></h1>

						<?php if ( ! empty( $cortex_project_page_sub_heading ) ) { ?>
						<hr />
						<h2 class="h4 center subheading mar30T<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} else { echo ' accent-color-text'; } ?>"><?php echo $cortex_project_page_sub_heading; ?></h2>
						<?php } ?>
					</div>
					<figure class="project-page-header-bg<?php if ( ! empty($cortex_enable_overlay) ) { echo $cortex_enable_overlay; } ?>" <?php if ( ! empty( $cortex_heading_style ) ) { echo $cortex_heading_style.'"'; } ?>></figure>
				</header>

				<div class="<?php if ( ! empty( $cortex_project_page_width ) ) { echo $cortex_project_page_width;
} else { echo 'container'; } ?>">

					<div class="project-contents"><?php the_content(); ?></div>

					<?php
					} //endwhile;
				} //endif; //end of project page loop
				wp_reset_postdata();
?>

					<?php

					// WP_Query arguments for projects listing that may be sorted differently and/or limited to one category
					$catID = '';

					if ( ! empty( $cortex_category ) ) {

						foreach ( $cortex_category as $cat ) { // loop through category array and assign cat id for query
							$catID .= $cat . ',';
						}

						// query only selected categories
						$args = array(
							'post_status'    => 'publish',
							'post_type'              => 'project',
							'tax_query' => array(
								array(
									'taxonomy' => 'projects-category',
									'terms'		=> $catID,
								),
							),
							'order'                  => 'ASC',
							'orderby'                => $cortex_orderBy,
						);

					} else {
						// query all categories
						$args = array(
							'post_status'    => 'publish',
							'post_type'              => 'project',
							'order'                  => 'ASC',
							'orderby'                => $cortex_orderBy,
						);
					}


					// The Query
					$cortex_query = new WP_Query( $args );

					if ( $cortex_query->have_posts() ) { ?>
										<div class="masonry_projects<?php if ( $cortex_project_page_width == 'container' ) { echo ' mar30T mar30B'; } ?>">
											<div class="project-listing grid-tiles isotope c9-project-caption">

											<?php
											while ( $cortex_query->have_posts() ) { // get project fields
												$cortex_query->the_post();
												$cortex_image   = get_the_post_thumbnail( get_the_id(), 'large' );
												$cortex_heading  = get_field( 'project_name' );
												$cortex_sub_heading = get_field( 'project_sub_heading' );

										?>

												<article id="post-<?php the_ID(); ?>" class="project-listing-single tile isotope-item <?php if ( ! empty( $cortex_columns ) ) { echo $cortex_columns;
} else { echo 'cm50'; } ?>">

								<?php if ( ! empty( $cortex_image ) ) { ?>
								<figure class="img_project">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php echo $cortex_image; ?>
									</a>
									<figcaption>

												<?php if ( ! empty( $cortex_sub_heading ) ) { ?>
												<span class="masonry_project_sub_heading"><?php echo $cortex_sub_heading; ?></span>
												<?php } ?>

												<?php if ( ! empty( $cortex_heading ) ) { ?>
												<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="masonry_project_heading"><?php echo $cortex_heading; ?></span></a></h3>
												<?php } ?>
												<?php if ( ($cortex_columns == 'cm50') || ($cortex_columns == 'cm100') ) { ?>
												<div class="project-description"><?php the_excerpt();?></div>
												<?php } ?>
												<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>

									</figcaption>
								</figure>
								<?php } else { ?>
								<figure class="img_container">
									<img src="http://placehold.it/720x480" alt="" />
								</figure>
								<?php } ?>

							</article><!-- #post-## -->

							<?php
											} //endwhile

											wp_reset_postdata();
					?>

						</div><!-- .project-listing -->
					</div><!--end .masonry_projects-->
						<?php } else { ?>

				      	<div class="project-listing grid-tiles">
							<?php esc_html_e( 'No projects were found.', 'cortex' ); ?>
						</div>

						<?php } //endif ?>

					</div><!-- #container -->
			</section><!--end section-bg-->

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
