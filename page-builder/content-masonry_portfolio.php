<?php
$cortex_title      = get_sub_field( 'title' );
$cortex_background    = get_sub_field( 'custom_background' );
$cortex_backgroundColor   = get_sub_field( 'background_color' );
$cortex_backgroundImage  = esc_url( get_sub_field( 'background_image' ) );
$cortex_category     = get_sub_field( 'portfolio_category' );
$cortex_limit     = get_sub_field( 'limit_by_category' );
$cortex_num_posts = get_sub_field( 'num_posts' );
$cortex_orderBy    = get_sub_field( 'order_by' );
$cortex_backgroundPattern  = esc_url( get_sub_field( 'background_pattern' ) );
$cortex_backgroundRepeat  = get_sub_field( 'background_pattern_repeat' );
$cortex_backgroundParallax  = get_sub_field( 'background_image_parallax' );
$cortex_customClass    = esc_html( get_sub_field( 'custom_class' ) );

/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
if ( $cortex_background != 'none' ) {

	if ( ( $cortex_backgroundColor != '' ) || ( $cortex_backgroundImage != '' ) || ( $cortex_backgroundPattern != '' ) ) {
		$cortex_style    = 'style="';
	}
	if ( $cortex_backgroundColor != '' ) {
		$cortex_style  .= "background-color: $cortex_backgroundColor; ";
	}
	if ( ( $cortex_backgroundImage != '' ) && ( $cortex_background == 'image' ) ) {
		$cortex_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat; background-position: center center;";
	}
	if ( ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'pattern' ) ) || ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'color_pattern' ) ) ) {
		$cortex_style  .= "background-image: url($cortex_backgroundPattern); background-repeat: $cortex_backgroundRepeat;";
	}
} //end checking for custom background
?>
<section id="section-<?php echo $cortex_counter; ?>" class="masonry_portfolio<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg" <?php if ( $cortex_backgroundParallax == 'yes' ) { echo "data-bottom-top=\"background-position: 0px 0px;\" data-top-bottom=\"background-position: 0% -200%;\" data-anchor-target=\"#section-$cortex_counter\""; } ?> <?php if ( ! empty( $cortex_style ) ) { echo $cortex_style.'"'; } ?>>
		<div class="container">
			<?php if ( !empty($cortex_title) ) { ?><h3><?php echo $cortex_title; ?></h3><?php } ?>
			<?php
			//set default for num posts
			if ( empty($cortex_num_posts) ) { 
				$cortex_num_posts = '10';
			}
			
			// WP_Query arguments
			if ( $cortex_limit == '0' ) { // query all portfolios
				$args = array(
					'post_type'              => 'portfolio',
					'post_status'    => 'publish',
					'order'                  => 'DESC',
					'orderby'                => $cortex_orderBy,
					'posts_per_page'		 => $cortex_num_posts,
				);
			} else { // a specific category is needed
				$i = 0;
				$cortex_catID = '';
				foreach ( $cortex_category as $cortex_cat ) { // loop through category array and assign cat id for query
					$cortex_catID .= $cortex_cat . ',';
				}

				$args = array(
					'post_type'              => 'portfolio',
					'post_status'    => 'publish',
					'tax_query' => array(
						array(
				'taxonomy' => 'portfolios-category',
				'terms'		=> $cortex_catID,
						),
					),
					'order'                  => 'DESC',
					'orderby'                => $cortex_orderBy,
					'posts_per_page'		 => $cortex_num_posts,
				);
			}

			// The Query
			$cortex_query = new WP_Query( $args );

			if ( $cortex_query->have_posts() ) { ?>

							<div class="grid-tiles isotope">
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

						<article id="post-<?php the_ID(); ?>" class="tile isotope-item <?php sanitize_html_class( the_field( 'masonry_width' ) ); ?>">

							<?php if ( ! empty( $cortex_image ) ) { ?>
							<figure class="img_container">
								<a href="<?php the_permalink(); ?>" class="entry-link" title="<?php the_title_attribute(); ?>"></a>
								<?php echo $cortex_image; ?>
							</figure>
							<?php } else { ?>
							<figure class="img_container">
								<a href="<?php the_permalink(); ?>" class="entry-link"></a>
								<img src="http://placehold.it/720x480" alt="" />
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

						<article id="post-<?php the_ID(); ?>" class="tile isotope-item <?php sanitize_html_class( the_field( 'masonry_width' ) ); ?>">

							<?php if ( ! empty( $cortex_image ) ) { ?>
							<figure class="img_container">
								<a href="<?php the_permalink(); ?>" class="entry-link" title="<?php the_title_attribute(); ?>"></a>
								<?php echo $cortex_image; ?>
							</figure>
							<?php } else { ?>
							<figure class="img_container">
								<a href="<?php the_permalink(); ?>" class="entry-link"></a>
								<img src="http://placehold.it/720x480" />
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

			<?php } //endif ?>

		</div><!-- #container -->
	</div><!--end section-bg-->
</section>
<div class="clearfix"></div>
<?php $cortex_counter++;
unset( $cortex_backgroundImage, $cortex_backgroundColor, $cortex_backgroundPattern, $cortex_style, $cortex_customClass ); ?>
