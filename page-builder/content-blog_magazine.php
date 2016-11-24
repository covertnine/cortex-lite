<?php
$cortex_background      = get_sub_field( 'custom_background' );
$cortex_backgroundColor    = get_sub_field( 'background_color' );
$cortex_backgroundImage    = esc_url( get_sub_field( 'background_image' ) );
$cortex_backgroundPattern    = esc_url( get_sub_field( 'background_pattern' ) );
$cortex_backgroundRepeat    = get_sub_field( 'background_pattern_repeat' );
$cortex_customClass     = esc_html( get_sub_field( 'custom_class' ) );
$cortex_sidebar      = get_sub_field( 'sidebar' );
$cortex_select_sidebar     = get_sub_field( 'select_sidebar' );
$cortex_title       = get_sub_field( 'title' );
$cortex_sub_title      = get_sub_field( 'sub_title' );
$cortex_filter_by_category    = get_sub_field( 'filter_by_category' );
$cortex_filter_by_format    = get_sub_field( 'filter_by_format' );
$cortex_number_of_posts    = get_sub_field( 'number_of_posts_to_display' );
$cortex_view_more_btn     = get_sub_field( 'view_more_btn' );
$cortex_view_more_button_link   = esc_url( get_sub_field( 'view_more_button_link' ) );
$cortex_display_date     = get_sub_field( 'display_date' );
$cortex_display_post_meta    = get_sub_field( 'display_post_meta' );
$cortex_display_post_excerpt   = get_sub_field( 'display_post_excerpt' );
$cortex_number_of_posts_to_display  = $cortex_number_of_posts;

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
<section id="section-<?php echo $cortex_counter; ?>" class="magazine_latest<?php if ( ! empty( $cortex_customClass ) ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg" <?php if ( ! empty( $cortex_style ) ) { echo $cortex_style.'"'; } ?>>
		<div class="container">

			<?php if ( ( ! empty( $cortex_title ) ) || ( ! empty( $cortex_sub_title ) ) ) { ?>
			<div class="row wow animated fadeInUp">
				<div class="magazine_latest_title col-md-12 mar30B">
					<?php if ( $cortex_title != '' ) { echo '<span class="h1 center mar10B">' . $cortex_title . '</span>';} ?>
					<?php if ( $cortex_sub_title != '' ) { echo '<span class="subtitle center mar10B">' . $cortex_sub_title . '</span>';} ?>
				</div>
			</div>
			<?php } ?>

			<div class="row">

				<?php
				if ( ( empty( $cortex_filter_by_category ) ) && ( empty( $cortex_filter_by_format ) ) ) { // no filtering, output everything

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'pagination'             => false,
						'orderby'     => 'date',
						'order'      => 'DESC',
						'posts_per_page'   => $cortex_number_of_posts_to_display,
					);

				} elseif ( ( ! empty( $cortex_filter_by_category ) ) && ( empty( $cortex_filter_by_format ) ) ) { // filter by category

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'category__in'    => $cortex_filter_by_category,
						'order'      => 'DESC',
						'orderby'     => 'date',
						'pagination'             => false,
						'posts_per_page'   => $cortex_number_of_posts_to_display,
					);

				} elseif ( ( empty( $cortex_filter_by_category ) ) && ( ! empty( $cortex_filter_by_format ) ) ) { // filter by format

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'tax_query'     => array(
							array(
								'taxonomy'   => 'post_format',
								'terms'   => $cortex_filter_by_format,
								'operator'   => 'IN',
							),
						),
						'order'      => 'DESC',
						'orderby'     => 'date',
						'pagination'             => false,
						'posts_per_page'   => $cortex_number_of_posts_to_display,
					);

				} elseif ( ( ! empty( $cortex_filter_by_category ) ) && ( ! empty( $cortex_filter_by_format ) ) ) { // filter by category and format

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'category__in'    => $cortex_filter_by_category,
						'tax_query'     => array(
							array(
								'taxonomy' => 'post_format',
								'field'    => 'term_id',
								'terms'    => $cortex_filter_by_format,
								'operator' => 'IN',
							),
						),
						'order'      => 'DESC',
						'pagination'             => false,
						'posts_per_page'   => $cortex_number_of_posts_to_display,
					);

				}


				// The Query
				$cortex_wp_query = new WP_Query( $args );
?>

				<div class="<?php if ( $cortex_sidebar == 'sidebar-none' ) { echo 'col-md-12 ';
} else { echo 'col-xs-12 col-sm-12 col-md-9 '; } ?><?php if ( $cortex_sidebar == 'sidebar-left' ) { echo ' col-md-push-3'; } ?> magazine_latest_content" id="magazine-latest-<?php echo $cortex_counter; ?>" data-center-bottom="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target="#section-<?php echo $cortex_counter; ?> .magazine_latest_content">

					<?php

					if ( $cortex_wp_query->have_posts() ) {

						$i = 1; // setup for clearing the articles

					?>
						<div class="row">
					<?php
					while ( $cortex_wp_query->have_posts() ) {

						$cortex_wp_query->the_post();

						$cortex_format = get_post_format();
						if ( ( $cortex_format === false) || ($cortex_format == 'image') ) { $cortex_format = 'standard';}


					?>
						<div class="col-xs-12 col-sm-4 col-md-4">
							<article class="magazine-article mar50B wow animated fadeInUp <?php echo $cortex_format; ?>">
								<figure class="magazine-image entry-image">
									<?php

									switch ( $cortex_format ) {
										case 'video':
											$cortex_iframe = get_field( 'video_link' );

											if ( $cortex_iframe !== '' ) {
												// use preg_match to find iframe src
												preg_match( '/src="(.+?)"/', $cortex_iframe, $matches );
												$src = $matches[1];


												// add extra params to iframe src
												$params = array(
												'controls'     => 1,
												'hd'           => 1,
												'autohide'     => 1,
												'showinfo'    => 0,
												'iv_load_policy'  => 3,
												'modestbranding'  => 1,
												'rel'     => 0,
												'title'     => 0,
												'byline'    => 0,
												'portrait'    => 0,
												);

												$new_src = add_query_arg( $params, $src );

												$cortex_iframe = str_replace( $src, $new_src, $cortex_iframe );
												$cortex_iframe = str_replace( 'frameborder="0"', '', $cortex_iframe );


												// check for SSL and appropriately re-embed the iframe with the proper source being http or https
												if ( ( ! empty( $_SERVER['HTTPS'] ) ) && ( $_SERVER['HTTPS'] != 'off' ) ) {

													// ssl connection
													$cortex_iframe = str_replace( 'http:', 'https:', $cortex_iframe );

												} else {

													// non-ssl connection
													$cortex_iframe = str_replace( 'https:', 'http:', $cortex_iframe );

												}
											}
								?>
											<div class="embed-container"><?php echo $cortex_iframe; ?></div>
										<?php
										break;
										case 'audio':

											// get iframe HTML
											$cortex_iframe = get_field( 'audio_link' );

											// add extra attributes to iframe html
											$attributes = '';

											$cortex_iframe = str_replace( '></iframe>', ' ' . $attributes . '></iframe>', $cortex_iframe );


											if ( has_post_thumbnail() ) {
												?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured-audio', array( 'class' => 'img-responsive' ) ); ?></a>
										<?php
											}
								?>
										<div class="audio-embed-container mar20B"><?php echo $cortex_iframe; ?></div>
										<?php
										break;
										case 'quote':
											$cortex_person    = get_field( 'person' );
											$cortex_quote_text   = get_field( 'quote_text' );
											$cortex_quote_source = get_field( 'quote_source' );
											$cortex_quote_link   = esc_url( get_field( 'quote_link' ) );


											if ( has_post_thumbnail() ) {
												?><div class="dark-overlay"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured', array( 'class' => 'img-responsive' ) ); ?></a><span class="h6 quote-source"><strong><?php echo $cortex_person; ?></strong></span></div>
									<?php
											}
								?>

										<?php
										break;
										default:
								?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured', array( 'class' => 'img-responsive' ) ); ?></a>
										<?php
										break;
									} //end format switch
					?>
								</figure>
								<header class="entry-header">
									<?php
									if ( $cortex_format != 'quote' ) {
							?>
										<div class="magazine-article-header">
											<?php if ( $cortex_display_date == true ) { ?><div class="magazine-article-date"><span class="h5 alternate"><?php cortex_posted_on(); ?></span></div><?php } ?>
											<h5 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
											<?php if ( $cortex_display_post_meta == true ) { ?>
											<div class="entry-meta">
												<?php cortex_author(); ?> / <?php cortex_post_categories(); ?> <?php cortex_post_tags(); ?>
											</div><!-- .entry-meta -->
											<?php } ?>
										</div><!--end magazine-article-header-->
											<?php

									} else {
							?>
										<div class="magazine-article-header">
											<h5 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
										</div>
										<?php
									}
					?>
								</header><!-- .entry-header -->

								<?php
								if ( $cortex_format != 'quote' ) { // check for post quote type

									if ( $cortex_display_post_excerpt == true ) { // check if excerpt is to be displayed

						?>

										<div class="entry-content magazine-article-content">
											<?php echo cortex_the_excerpt( 'Read more', 25, 1 ); ?>
										</div>

										<?php
									}
								} else { // it is a post quote so show the quote

									if ( $cortex_display_post_excerpt == true ) { // check if excerpt is to be displayed
						?>
										<blockquote><?php echo $cortex_quote_text; ?></blockquote>
										<?php
										if ( $cortex_quote_source != '' ) {
											if ( $cortex_quote_link == '' ) {

						?>
												<small><?php echo $cortex_quote_source; ?></small>
											<?php } else { ?>
												<a href="<?php echo $cortex_quote_link; ?>" target="_blank" title="<?php the_title_attribute(); ?>"><span class="small-link"><?php echo $cortex_quote_source; ?></span></a>
											<?php } ?>

										<?php } ?>
									<?php
									}
								} //end of checking to see if it's a quote type
					?>
							</article>
						</div>
					<?php
					if ( $i % 3 == 0 ) { // check for the article count to clear appropriately
					?>
					<div class="clearfix visible-sm-block visible-md-block visible-lg-block"></div>
					<?php
					} //end checking article # for md column layouts
					if ( $i % 2 == 0 ) { // now check for the sm column layouts

						// for any separating necessary for mobile queries
					}
						$i++;
					} //end while loop
					?>

						</div><!--end row-->

						<?php if ( $cortex_view_more_btn == true ) { ?>
						<div class="row wow animated fadeInUp">
							<div class="col-md-12">
							<div class="view-more-btn center mar30B">
								<a class="btn btn-md btn-default secondary-color-bg" href="<?php echo $cortex_view_more_button_link; ?>"><?php esc_html_e( 'View All', 'cortex' ); ?></a>
							</div>
							</div>
						</div><!--end row-->
						<?php
}
					} else {

						get_template_part( 'content', 'none' );

					} //endif

					wp_reset_query();
?>
				</div><!--end col-->
				<?php if ( $cortex_sidebar != 'sidebar-none' ) { ?>
				<div class="col-xs-12 col-sm-12 col-md-3 wow animated fadeInUp<?php if ( $cortex_sidebar == 'sidebar-left' ) { echo ' col-md-pull-9'; } ?>">
					<div id="<?php echo $cortex_sidebar; ?>" class="magazine_latest_sidebar sidebar">
						<?php
						if ( is_active_sidebar( $cortex_select_sidebar ) ) {
							dynamic_sidebar( $cortex_select_sidebar );
						} else {
							esc_html__( 'Sidebar must have widgets assigned to them!', 'cortex' );
						}
						?>
					</div>
				</div>
				<?php } ?>

			</div><!-- #row -->

		</div><!-- #container -->
	</div><!--section-bg-->
</section>
<?php $cortex_counter++;
unset( $cortex_title, $cortex_sub_title, $cortex_filter_by_category, $cortex_filter_by_format, $cortex_number_of_posts, $cortex_view_more_btn, $cortex_view_more_button_link, $cortex_customClass, $cortex_display_date, $cortex_display_post_meta, $cortex_display_post_excerpt, $cortex_number_of_posts_to_display ); ?>
