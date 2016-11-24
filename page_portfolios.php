<?php
/**
 * Template Name: Portfolio Page
 *
 * @package cortex
 */

get_header();
$cortex_customBackground  		= get_field( 'custom_background' );
$cortex_backgroundColor   		= get_field( 'background_color' );
$cortex_backgroundImage  		= esc_url( get_field( 'background_image' ) );
$cortex_category     			= get_field( 'portfolio_category' );
$cortex_orderBy    				= get_field( 'order_by' );
$cortex_backgroundPattern  		= esc_url( get_field( 'background_pattern' ) );
$cortex_backgroundRepeat  		= get_field( 'background_pattern_repeat' );
$cortex_featured_header_height  = get_field( 'featured_header_height' );
$cortex_header_display_overlay  = get_field( 'display_overlay' );

/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
if ( $cortex_customBackground != 'none' ) {

	$cortex_bg_style    = 'style="';

	if ( $cortex_backgroundColor != '' ) {
		$cortex_bg_style  .= "background-color: $cortex_backgroundColor; ";
	}
	if ( ( $cortex_backgroundImage != '' ) && ( $cortex_customBackground == 'image' ) ) {
		$cortex_bg_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat; background-position: 0% 0%;";
	}
	if ( ( ( $cortex_backgroundPattern != '' ) && ( $cortex_customBackground == 'pattern' ) ) || ( ( $cortex_backgroundPattern != '' ) && ( $cortex_customBackground == 'color_pattern' ) ) ) {
		$cortex_bg_style  .= "background-image: url($cortex_backgroundPattern); background-repeat: $cortex_backgroundRepeat;";
	}
}
?>
	<div id="primary" class="content-area page-content page-portfolio<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>">
		<main id="main" class="site-main" role="main">

			<section id="section-portfolio" class="masonry_portfolio">
				<div class="section-bg">

					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
					?>

					<header class="entry-header entry-header-portfolio mar30B<?php if ( ! empty( $cortex_featured_header_height ) ) { echo ' '. $cortex_featured_header_height; } ?><?php if ( $cortex_header_display_overlay == true ) { echo ' dark-overlay';} ?>">
						<?php if ( ! empty( $cortex_bg_style ) ) { ?>

						<figure class="entry-image" data-start="background-position: 0% 0%;" data-top-bottom="background-position: 0% -100%;" data-anchor-target=".entry-image" <?php echo $cortex_bg_style.'"'; ?>></figure>
						<?php } ?>

						<div class="entry-header-standard-wrapper">
							<div class="entry-header-standard">
								<div class="entry-header-standard-inner" data-130-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
									<div class="container">
										<h1 class="entry-title center<?php if ( ! empty( $cortex_bg_style ) ) { echo ' light-color-text'; } ?>"><?php the_title(); ?></h1>


										<div class="portfolio-content">
											<?php the_content(); ?>
										</div>


									</div><!--end container-->
								</div><!--end entry-header-standard-inner-->
							</div><!--end entry-header-standard-->
						</div><!--entry-header-standard-wrapper-->
					</header><!-- .entry-header -->

				<?php
						} //endwhile;
					} //endif;
?>

				<div class="container">

					<?php

					// WP_Query arguments
					$i = 0;
					$catID = '';

					if ( ! empty( $cortex_category ) ) { // filter portfolios by category

						foreach ( $cortex_category as $cat ) { // loop through category array and assign cat id for query
							$catID .= $cat . ',';
						}

						$args = array(
							'post_type'              => 'portfolio',
							'tax_query' => array(
								array(
									'taxonomy' => 'portfolios-category',
									'terms'		=> $catID,
								),
							),
							'order'                  => 'DESC',
							'orderby'                => $cortex_orderBy,
							'posts_per_page'   => -1,
						);


					} else { // don't filter by category and display all
						$catID == '';

						$args = array(
							'post_type'              => 'portfolio',
							'order'                  => 'DESC',
							'orderby'                => $cortex_orderBy,
							'posts_per_page'   => -1,
						);

					}


					// The Query
					$cortex_query = new WP_Query( $args );

					if ( $cortex_query->have_posts() ) { ?>

											<div class="portfolio-listing grid-tiles isotope mar40B">
												<article id="post-column-spacer" class="tile isotope-item cm25"></article>

											<?php
											while ( $cortex_query->have_posts() ) {
												$cortex_query->the_post();
												$cortex_image   = get_the_post_thumbnail( get_the_id(), 'large' );
												$cortex_heading  = get_field( 'heading' );
												$cortex_sub_heading = get_field( 'sub_heading' );
												$cortex_images   = get_field( 'images' );
												$cortex_type   = get_field( 'portfolio_type' );

												// stand-alone gallery so go to a new page
												if ( $cortex_type == 'stand-alone' ) {
										?>

													<article id="post-<?php the_ID(); ?>" class="tile isotope-item <?php the_field( 'masonry_width' ); ?>">

									<?php if ( ! empty( $cortex_image ) ) { ?>
									<figure class="img_container">
										<a href="<?php the_permalink(); ?>" class="entry-link" title="<?php the_title_attribute(); ?>"></a>
										<?php echo $cortex_image; ?>
									</figure>
									<?php } else { ?>
									<figure class="img_container">
										<a href="<?php the_permalink(); ?>" class="entry-link" title="<?php the_title_attribute(); ?>"></a>
										<img src="http://placehold.it/720x480" />
									</figure>
									<?php } ?>

									<div class="masonry_portfolio_meta">
										<div class="masonry_portfolio_meta_inner">

											<?php if ( ! empty( $cortex_sub_heading ) ) { ?>
											<span class="masonry_portfolio_sub_heading"><?php echo $cortex_sub_heading; ?></span>
											<?php } ?>

											<?php if ( ! empty( $cortex_heading ) ) { ?>
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="masonry_portfolio_heading"><?php echo $cortex_heading; ?></span></a>
											<?php } ?>

											<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
										</div><!-- #inner end-->
									</div><!-- #meta end-->

									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="tp-rightarrow default gallery-arrow"></span></a>

								</article><!-- #post-## -->

							<?php
												} elseif ( $cortex_type == 'lightbox' ) { // it's a post that needs to be a popup
										?>

													<article id="post-<?php the_ID(); ?>" class="tile isotope-item <?php the_field( 'masonry_width' ); ?>">

									<?php if ( ! empty( $cortex_image ) ) { ?>
									<figure class="img_container">
										<a href="<?php the_permalink(); ?>" class="entry-link" title="<?php the_title_attribute(); ?>"></a>
										<?php echo $cortex_image; ?>
									</figure>
									<?php } else { ?>
									<figure class="img_container">
										<a href="<?php the_permalink(); ?>" class="entry-link" title="<?php the_title_attribute(); ?>"></a>
										<img src="http://placehold.it/720x480" alt="placeholder" />
									</figure>
									<?php } ?>

									<div class="masonry_portfolio_meta">
										<div class="masonry_portfolio_meta_inner">

											<?php if ( ! empty( $cortex_sub_heading ) ) { ?>
												<span class="masonry_portfolio_sub_heading"><?php echo $cortex_sub_heading; ?></span>
											<?php } ?>

											<?php if ( ! empty( $cortex_heading ) ) { ?>
												<a href="#" title="<?php the_title_attribute(); ?>" class="gallery-link"><span class="masonry_portfolio_heading"><?php echo $cortex_heading; ?></span></a>
											<?php } ?>

											<?php if ( $cortex_images ) { ?>
												<div class="cm-gallery hide">
													<?php foreach ( $cortex_images as $cortex_image ) :  ?>
														<a href="<?php echo esc_url( $cortex_image['url'] ); ?>"></a>
													<?php endforeach; ?>
												</div>
											<?php } //end get gallery images ?>

											<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>

										</div><!-- #inner end-->
									</div><!-- #meta end-->

									<a href="#" title="<?php the_title_attribute(); ?>" class="gallery-link"><span class="tp-rightarrow default gallery-arrow"></span></a>

								</article><!-- #post-## -->
								
							<?php
												} else { // neither a lightbox or gallery (so nothing)
										?>

												<?php esc_html_e( 'Not a gallery or a lightbox type', 'cortex' ); ?>

							<?php
												} //end gallery type
											} //endwhile

											wp_reset_postdata();
					?>

					</div><!-- grid-tiles isotope-->
					<?php } else { ?>

			      	<div class="grid-tiles">
						<?php esc_html_e( 'No posts were found.', 'cortex' ); ?>
					</div>

					<?php } //endif
wp_reset_query();
?>


				</div><!-- #container -->
				</div><!--end section-bg-->
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
