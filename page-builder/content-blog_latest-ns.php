<?php
$cortex_customClass     			= esc_html( get_sub_field( 'custom_class' ) );
$cortex_title       				= get_sub_field( 'title' );
$cortex_sub_title      		  		= get_sub_field( 'sub_title' );
$cortex_filter_by_category    		= get_sub_field( 'filter_by_category' );
$cortex_filter_by_format    		= get_sub_field( 'filter_by_format' );
$cortex_number_of_posts_to_display  = get_sub_field( 'number_of_posts_to_display' );
$cortex_view_more_btn     			= get_sub_field( 'view_more_btn' );
$cortex_view_more_button_link   	= esc_url( get_sub_field( 'view_more_button_link' ) );
?>
<section id="section-<?php echo $cortex_counter; ?>" class="blog_latest<?php if ( ! empty( $cortex_customClass ) ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg">

			<?php if ( ( ! empty( $cortex_title ) ) || ( ! empty( $cortex_sub_title ) ) ) { ?>
			<div class="row">
				<div class="blog_latest_title col-md-12" data-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target="#section-<?php echo $cortex_counter; ?> .blog_latest_title">
					<?php if ( $cortex_title != '' ) { echo '<h3>' . $cortex_title . '</h3>';} ?>
					<?php if ( $cortex_sub_title != '' ) { echo '<span class="subtitle">' . $cortex_sub_title . '</span>';} ?>
				</div>
			</div>
			<?php } ?>

			<div class="row">
				<?php
				if ( ( empty( $cortex_filter_by_category ) ) && ( empty( $cortex_filter_by_format ) ) ) { // no filtering, output everything

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'posts_per_page'   => $cortex_number_of_posts_to_display,
						'pagination'             => true,
					);

				} elseif ( ( ! empty( $cortex_filter_by_category ) ) && ( empty( $cortex_filter_by_format ) ) ) { // filter by category

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'posts_per_page'   => $cortex_number_of_posts_to_display,
						'category__in'    => $cortex_filter_by_category,
						'pagination'             => true,
					);

				} elseif ( ( empty( $cortex_filter_by_category ) ) && ( ! empty( $cortex_filter_by_format ) ) ) { // filter by format

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'posts_per_page'   => $cortex_number_of_posts_to_display,
						'tax_query'     => array(
							array(
								'taxonomy'   => 'post_format',
								'terms'   => $cortex_filter_by_format,
								'operator'   => 'IN',
							),
						),
						'pagination'             => true,
					);

				} elseif ( ( ! empty( $cortex_filter_by_category ) ) && ( ! empty( $cortex_filter_by_format ) ) ) { // filter by category and format

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'posts_per_page'   => $cortex_number_of_posts_to_display,
						'category__in'      => $cortex_filter_by_category,
						'tax_query'     => array(
							array(
								'taxonomy' => 'post_format',
								'field'    => 'term_id',
								'terms'    => $cortex_filter_by_format,
								'operator' => 'IN',
							),
						),
						'pagination'             => true,
					);

				}


				// Get current page and append to custom query parameters array
				if ( is_front_page() ) {
					$args['paged'] = get_query_var( 'page' )  ? get_query_var( 'page' ) : 1;
				} else {
					$args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				}

				// The Query
				$cortex_query = new WP_Query( $args );

				// Pagination fix
				$temp_query = $wp_query;
				$cortex_wp_query   = null;
				$cortex_wp_query   = $cortex_query;
?>

				<div class="<?php if (($cortex_sidebar == 'sidebar-none') || ( empty( $cortex_sidebar_display ) ) || ( $cortex_sidebar_display == 'sidebar-none' )) { echo "col-xs-12 col-md-8 col-md-offset-2"; } else { echo "col-xs-12";} ?> blog_latest_content" id="blog-latest-<?php echo $cortex_counter; ?>" data-center-bottom="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target="#section-<?php echo $cortex_counter; ?> .blog_latest_content">

					<?php

					if ( $cortex_wp_query->have_posts() ) {

						while ( $cortex_wp_query->have_posts() ) {

							$cortex_wp_query->the_post();

							$cortex_format = get_post_format();
							if ( ( $cortex_format === false ) || ( $cortex_format == 'image') ) { $cortex_format = 'standard';}

							get_template_part( 'page-builder/format', $cortex_format );

						}

						if ( $cortex_view_more_btn == true ) { ?>
											<div class="view-more-btn center mar30B">
												<a class="btn btn-md btn-default secondary-color-bg" href="<?php echo $cortex_view_more_button_link; ?>"><?php esc_html_e( 'View All', 'cortex' ); ?></a>
											</div>
											<?php } ?>

											<?php

											$cortex_navargs = array(
											'prev_text' => __( 'Previous', 'cortex' ),
											'next_text' => __( 'Next', 'cortex' ),
											);
											the_posts_pagination( $cortex_navargs );

					} else {

						get_template_part( 'parts/content', 'none' );

					} //endif

					wp_reset_query();
?>

				</div>

				<?php

				// Reset main query object
				$cortex_wp_query = null;
				$cortex_wp_query = $temp_query;
?>
			</div><!-- #row -->

	</div><!--section-bg-->
</section>
<?php $cortex_counter++;
unset( $cortex_customClass, $cortex_title, $cortex_sub_title, $cortex_filter_by_category, $cortex_filter_by_format, $cortex_number_of_posts_to_display, $cortex_view_more_btn, $cortex_view_more_button_link ); ?>
