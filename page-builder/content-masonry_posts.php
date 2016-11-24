<?php
$cortex_title        = get_sub_field( 'title' );
$cortex_subtitle      = get_sub_field( 'sub_title' );
$cortex_background      = get_sub_field( 'custom_background' );
$cortex_backgroundColor     = get_sub_field( 'background_color' );
$cortex_backgroundImage     = esc_url( get_sub_field( 'background_image' ) );
$cortex_category       = get_sub_field( 'post_category' );
$cortex_limit       = get_sub_field( 'limit_by_category' );
$cortex_orderBy      = get_sub_field( 'order_by' );
$cortex_columns      = get_sub_field( 'columns' );
$cortex_show_meta      = get_sub_field( 'show_meta' );
$cortex_backgroundPattern    = esc_url( get_sub_field( 'background_pattern' ) );
$cortex_backgroundRepeat    = get_sub_field( 'background_pattern_repeat' );
$cortex_backgroundParallax     = get_sub_field( 'background_image_parallax' );
$cortex_number_of_posts_to_display  = get_sub_field( 'number_of_posts_to_display' );
$cortex_view_more_btn     = get_sub_field( 'view_more_btn' );
$cortex_view_more_button_link   = esc_url( get_sub_field( 'view_more_button_link' ) );
$cortex_customClass      = esc_html( get_sub_field( 'custom_class' ) );

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
<section id="section-<?php echo $cortex_counter; ?>" class="masonry_portfolio masonry_posts<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg" <?php if ( $cortex_backgroundParallax == 'yes' ) { echo "data-bottom-top=\"background-position: 0px 0px;\" data-top-bottom=\"background-position: 0% -200%;\" data-anchor-target=\"#section-$cortex_counter\""; } ?> <?php if ( ! empty( $cortex_style ) ) { echo $cortex_style.'"'; } ?>>
		<div class="container">
			<?php if ( ! empty( $cortex_title ) ) { ?><h3><?php echo $cortex_title; ?></h3><?php } ?>
			<?php if ( ! empty( $cortex_subtitle ) ) { ?><span class="subtitle center mar40B"><?php echo $cortex_subtitle; ?></span><?php } ?>
			<?php

			// WP_Query arguments
			if ( $cortex_limit == '0' ) { // query all posts
				$args = array(
					'post_type'              => 'post',
					'post_status'    => 'publish',
					'order'                  => 'DESC',
					'posts_per_page'   => $cortex_number_of_posts_to_display,
					'orderby'                => $cortex_orderBy,
				);
			} else { // a specific category is needed
				$i = 0;
				$cortex_catID = '';
				foreach ( $cortex_category as $cortex_cat ) { // loop through category array and assign cat id for query
					$cortex_catID .= $cortex_cat . ',';
				}

				$args = array(
					'post_type'              => 'post',
					'post_status'    => 'publish',
					'cat'                    => $cortex_catID,
					'order'                  => 'DESC',
					'posts_per_page'   => $cortex_number_of_posts_to_display,
					'orderby'                => $cortex_orderBy,
				);
			}

			// The Query
			$cortex_query = new WP_Query( $args );

			if ( $cortex_query->have_posts() ) { ?>

							<div class="grid-tiles isotope">

							<?php
							while ( $cortex_query->have_posts() ) {

								$cortex_query->the_post();
								$cortex_image   = get_the_post_thumbnail( get_the_id(), 'large' );

						?>

						<article id="post-<?php the_ID(); ?>" class="tile isotope-item <?php echo sanitize_html_class($cortex_columns); ?>">

							<?php if ( ! empty( $cortex_image ) ) { ?>
							<figure class="img_container">
								<a href="<?php the_permalink(); ?>" class="entry-link" title="<?php the_title_attribute(); ?>"></a>
								<?php echo $cortex_image; ?>
							</figure>
							<?php } else { ?>
							<figure class="img_container">
								<a href="<?php the_permalink(); ?>" class="entry-link" title="<?php the_title_attribute(); ?>"></a>
								<img src="http://placehold.it/720x480" alt="" />
							</figure>
							<?php } ?>

							<div class="masonry_portfolio_meta">
								<div class="masonry_portfolio_meta_inner">

									<?php if ( ( $cortex_show_meta == true ) && ( $cortex_columns != 'five' ) && ( $cortex_columns != 'six' ) ) { ?>
									<div class="entry-meta">
										<span class="masonry_portfolio_sub_heading accent-color-text"><?php cortex_posted_on(); ?></span>
										<?php if ( $cortex_columns != 'four' ) { ?>
										<span class="cortex_post_categories"><?php cortex_post_categories(); ?></span> <span class="cortex_post_tags"><?php cortex_post_tags(); ?></span>
										<?php } ?>
									</div>
									<?php } ?>
									<?php if ( $cortex_columns != 'six' ) { ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="masonry_portfolio_heading"><?php the_title(); ?></span></a>
									<?php } ?>

									<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
								</div><!-- #inner end-->
							</div><!-- #meta end-->

							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="tp-rightarrow default gallery-arrow"></span></a>

						</article><!-- #post-## -->
			<?php
							} //endwhile

							wp_reset_postdata();
			?>

			</div><!-- grid-tiles isotope-->

			<?php if ( $cortex_view_more_btn == true ) { ?>
				<div class="clearfix mar30B mar30T"></div>
				<div class="view-more-btn center">
					<a class="btn btn-md btn-default secondary-color-bg" href="<?php echo $cortex_view_more_button_link; ?>"><?php esc_html_e( 'View More', 'cortex' ); ?></a>
				</div>
			<?php } ?>

			<?php } else { ?>

	      	<div class="grid-tiles">
				<?php esc_html_e( 'No posts were found.', 'cortex' ); ?>
			</div>

			<?php } //endif ?>

		</div><!-- #container -->
	</div><!--end section-bg-->
</section>
<?php $cortex_counter++;
unset( $cortex_backgroundImage, $cortex_backgroundColor, $cortex_backgroundPattern, $cortex_style ); ?>
