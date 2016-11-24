<?php
/**
 * Template Name: WooCommerce
 *
 * @package cortex
 */

get_header();
global $cortex_options;
$cortex_sidebar     = $cortex_options['c9-shop-sidebar'];

?>
	<div id="primary" class="content-area page-content<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>">
		<main id="main" class="site-main" role="main">
			<section class="cortex-woocommerce">

				<div class="container">
					<div class="row">
					<?php

					switch ( $cortex_sidebar ) {
						case 'sidebar-none' :

							woocommerce_content();

						break;
						case 'sidebar-left' :
						?>


						<div class="col-xs-12 col-sm-5 col-md-3 wow animated fadeInUp" id="sidebar-left">

							<?php
							if ( is_active_sidebar( 'sidebar-woo' ) ) {
								dynamic_sidebar( 'sidebar-woo' );
							} else {
								esc_html__( 'Woo Commerce Sidebar must have widgets assigned', 'cortex' );
							}
						?>

						</div>

						<div class="col-xs-12 col-sm-7 col-md-9 wow animated fadeInUp" id="woo-products">
							<?php woocommerce_content(); ?>
						</div>


					<?php
						break;
						case 'sidebar-right' :
						?>


						<div class="col-xs-12 col-sm-7 col-md-9 wow animated fadeInUp" id="woo-products">

							<?php woocommerce_content(); ?>

						</div>

						<div class="col-xs-12 col-sm-5 col-md-3 wow animated fadeInUp" id="sidebar-right">
							<?php
							if ( is_active_sidebar( 'sidebar-woo' ) ) {
								dynamic_sidebar( 'sidebar-woo' );
							} else {
								esc_html__( 'Woo Commerce Sidebar must have widgets assigned', 'cortex' );
							}
						?>
						</div>

						<?php
						break;
						default:
						?>


						<div class="col-xs-12 col-sm-7 col-md-9" id="woo-products">

							<?php woocommerce_content(); ?>

						</div>

						<div class="col-xs-12 col-sm-5 col-md-3 sidebar wow animated fadeInUp" id="sidebar-right">
							<?php
							if ( is_active_sidebar( 'sidebar-woo' ) ) {
								dynamic_sidebar( 'sidebar-woo' );
							} else {
								esc_html__( 'Woo Commerce Sidebar must have widgets assigned', 'cortex' );
							}
						?>
						</div>

						<?php
						break;
					}
?>
					</div><!--end row-->
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
