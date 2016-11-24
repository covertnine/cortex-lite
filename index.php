<?php
/*
	Template Name: Blog Posts
 *
 * @package cortex
 */

get_header();

global $cortex_options;
$cortex_theme_options = $cortex_options;
$cortex_navigation_type      = sanitize_html_class( $cortex_theme_options['c9-navigation-type'] );
$cortex_sidebar     = $cortex_theme_options['c9-page-sidebar'];
$cortex_featured_header   = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'cortex-featured-header' );

?>
	<div id="primary" class="content-area page-content<?php echo ' '.$cortex_navigation_type; ?>">
		<main id="main" class="site-main" role="main">
			<section id="home" class="page-home">


			<header class="entry-header entry-header-page mar30B blog-latest-header">
				<div class="entry-header-standard-wrapper center">
					<div class="entry-header-standard">
						<div class="entry-header-standard-inner">
							<div class="container">
								<h1 class="entry-title blog_latest_title center<?php if ($cortex_theme_options['c9-theme-style'] == 'dark') { echo ' light-color-text';
} else { echo ' dark-color-text'; } ?>"><?php if ( is_home() && get_option( 'page_for_posts' ) ) { echo get_the_title( get_option( 'page_for_posts' ) ); } ?></h1>
							</div><!--end container-->
						</div><!--end entry-header-standard-inner-->
					</div><!--end entry-header-standard-->
				</div><!--entry-header-standard-wrapper-->
			</header><!-- .entry-header -->


			<div class="container">

				<div class="row">
				<?php
				if ( have_posts() ) {

					switch ( $cortex_sidebar ) {
						case 'sidebar-right' :
					?>

					<div class="col-xs-12 col-sm-7 col-md-9 blog_latest_content" id="blog-latest" data-center-bottom="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".blog_latest_content">

					<?php
					while ( have_posts() ) {

						the_post();

						$cortex_format = get_post_format();
						if ( ($cortex_format === false) || ($cortex_format == 'image') ) { $cortex_format = 'standard'; }

						get_template_part( 'page-builder/format', $cortex_format );

					} //endwhile

					?>

					</div>

					<div class="col-xs-12 col-sm-5 col-md-3 sidebar" id="sidebar-right">
					<?php
						if ( is_active_sidebar( 'sidebar-1' ) ) {
							get_sidebar('sidebar-1');
						} else {
							esc_html__('Sidebar must have widgets assigned to it', 'cortex');
						}
					?>
				</div>

				<?php

						break;
						case 'sidebar-left' :
					?>

					<div class="col-xs-12 col-sm-5 col-md-3 sidebar" id="sidebar-left">
					<?php
						if ( is_active_sidebar( 'sidebar-1' ) ) {
							get_sidebar('sidebar-1');
						} else {
							esc_html__('Sidebar must have widgets assigned to it', 'cortex');
						}
					?>
				</div>

				<div class="col-xs-12 col-sm-7 col-md-9 blog_latest_content" id="blog-latest" data-center-bottom="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".blog_latest_content">

					<?php

					while ( have_posts() ) {

						the_post();

						$cortex_format = get_post_format();
						if ( ($cortex_format === false) || ($cortex_format == 'image') ) { $cortex_format = 'standard';}

						get_template_part( 'page-builder/format', $cortex_format );

					} //end while
					?>

					</div>

					<?php

						break;
						case 'sidebar-none' :
					?>

					<div class="col-md-12 blog_latest_content" id="blog-latest" data-center-bottom="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".blog_latest_content">

					<?php

					while ( have_posts() ) {

						the_post();

						$cortex_format = get_post_format();
						if ( ( $cortex_format === false ) || ( $cortex_format == 'image') ) { $cortex_format = 'standard';}

						get_template_part( 'page-builder/format', $cortex_format );
					} //end while
					?>

					</div>

					<?php
						break;
						default:
						break;
					}
				} else { // no posts were found

					get_template_part( 'content', 'none' );

				} //endif posts


				wp_reset_query();

?>
				</div><!-- end row-->
				<div class="row">

				<?php
				$cortex_navargs = array(
				'prev_text' => __( 'Previous', 'cortex' ),
				'next_text' => __( 'Next', 'cortex' ),
				);
				the_posts_pagination( $cortex_navargs );
?>

				</div><!--end row-->
			</div><!-- end container-->
			</section><!--end home-->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
