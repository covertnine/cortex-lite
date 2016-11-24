<?php
$cortex_background      			= get_sub_field( 'custom_background' );
$cortex_backgroundColor     		= get_sub_field( 'background_color' );
$cortex_backgroundImage     		= esc_url( get_sub_field( 'background_image' ) );
$cortex_backgroundPattern    		= esc_url( get_sub_field( 'background_pattern' ) );
$cortex_backgroundRepeat    		= get_sub_field( 'background_pattern_repeat' );
$cortex_backgroundParallax    		= get_sub_field( 'background_image_parallax' );
$cortex_product_sorting_options  	= get_sub_field( 'product_sorting_options' );
$cortex_content_above_product_grid  = get_sub_field( 'content_above_product_grid' );
$cortex_product_category    		= get_sub_field( 'product_category' );
$cortex_product_tag     			= get_sub_field( 'product_tag' );
$cortex_number_of_products    		= get_sub_field( 'number_of_products' );
$cortex_orderBy      				= get_sub_field( 'order_by' );
$cortex_view_more_btn     			= get_sub_field( 'view_more_btn' );
$cortex_view_more_button_link   	= esc_url( get_sub_field( 'view_more_button_link' ) );
$cortex_customClass     			= esc_html( get_sub_field( 'custom_class' ) );

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
<section id="section-<?php echo $cortex_counter; ?>"  class="woocommerce<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg" <?php if ( $cortex_backgroundParallax == 'yes' ) { echo "data-bottom-top=\"background-position: 0px 0px;\" data-top-bottom=\"background-position: 0% -200%;\" data-anchor-target=\"#section-$cortex_counter\""; } ?> <?php if ( ! empty( $cortex_style ) ) { echo $cortex_style.'"'; } ?>>
		<div class="container">

			<div class="row">
				<article class="post-content woocommerce-page" id="shop-article">

					<div class="col-md-12">

						<?php if ( ! empty( $cortex_content_above_product_grid ) ) { ?>

						<div class="entry-content wow animated fadeInUp">
						<?php echo $cortex_content_above_product_grid; ?>
						</div>
						<?php } ?>


						<?php

						// build the query based on custom fields
						if ( ( ! empty( $cortex_product_tag ) ) && ( $cortex_product_sorting_options == 'tag' ) ) {
							$cortex_tag = get_object_vars( $cortex_product_tag );
							$args = array(
								'post_status'     => 'publish',
								'post_type'      => 'product',
								'tax_query'      => array(
									array(
										'taxonomy'    => 'product_tag',
										'field'     => 'slug',
										'terms'     => $cortex_tag['slug'],
									),
								),
								'orderby'       => $cortex_orderBy,
								'posts_per_page'    => $cortex_number_of_products,
							);
						}

						if ( ( ! empty( $cortex_product_category ) ) && ( $cortex_product_sorting_options == 'category' ) ) {
							$cortex_cat = get_object_vars( $cortex_product_category );
							$args = array(
								'post_status'     => 'publish',
								'post_type'      => 'product',
								'tag_ID'      => $cortex_cat['slug'],
								'orderby'       => $cortex_orderBy,
								'posts_per_page'    => $cortex_number_of_products,
							);
						}

						if ( $cortex_product_sorting_options == 'none' ) {
							$args = array(
								'post_status'     => 'publish',
								'post_type'      => 'product',
								'orderby'       => $cortex_orderBy,
								'posts_per_page'    => $cortex_number_of_products,
							);
						}

						$cortex_product_query = new WP_Query( $args );

						if ( $cortex_product_query->have_posts() ) { ?>

												<?php woocommerce_product_loop_start(); ?>

												<?php

												while ( $cortex_product_query->have_posts() ) {

													$cortex_product_query->the_post();

													global $product, $woocommerce_loop;

													// Store loop count we're currently on
													if ( empty( $woocommerce_loop['loop'] ) ) {
														$woocommerce_loop['loop'] = 0;
													}

													// Store column count for displaying the grid
													if ( empty( $woocommerce_loop['columns'] ) ) {
														$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
													}

													// Ensure visibility
													if ( ! $product || ! $product->is_visible() ) {
														return;
													}

													// Extra post classes
													$classes = array();
													$classes[] = 'wow';
													$classes[] = 'animated';
													$classes[] = 'fadeInLeft';

											?>
												<li <?php post_class( $classes ); ?>>
								<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

									<?php
													/**
													 * woocommerce_before_shop_loop_item_title hook
													 *
													 * @hooked woocommerce_show_product_loop_sale_flash - 10
													 * @hooked woocommerce_template_loop_product_thumbnail - 10
													 */
													do_action( 'woocommerce_before_shop_loop_item_title' );
											?>

														<h3><?php the_title(); ?></h3>

									<?php
													/**
													 * woocommerce_after_shop_loop_item_title hook
													 *
													 * @hooked woocommerce_template_loop_rating - 5
													 * @hooked woocommerce_template_loop_price - 10
													 */
													do_action( 'woocommerce_after_shop_loop_item_title' );


													/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
													do_action( 'woocommerce_after_shop_loop_item' );

											?>
												</li>

											<?php
												} //endwhile;
												wp_reset_postdata();
						?>
						<?php
						} else {
							esc_html_e( 'No products were found', 'cortex' );
						} //endif;
						wp_reset_postdata();

?>

						<?php woocommerce_product_loop_end(); ?>

						<?php if ( $cortex_view_more_btn == true ) { ?>
						<div class="view-more-btn center wow animated fadeInUp">
							<a class="btn btn-md btn-default secondary-color-bg" href="<?php echo $cortex_view_more_button_link; ?>"><?php esc_html_e( 'View More', 'cortex' ); ?></a>
						</div><!--end view-more-bt-->
						<?php } ?>

					</div><!--end column-->

					<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>

				</article><!-- #post-## -->
			</div><!-- #row -->

		</div><!-- #container -->
	</div><!--end section-bg-->
</section>
<?php $cortex_counter++;
unset( $cortex_backgroundImage, $cortex_backgroundColor, $cortex_backgroundPattern, $cortex_style, $cortex_product_sorting_options, $cortex_content_above_product_grid, $cortex_product_category, $cortex_product_tag, $cortex_number_of_products, $cortex_orderBy, $cortex_view_more_btn, $cortex_view_more_button_link, $cortex_customClass ); ?>
