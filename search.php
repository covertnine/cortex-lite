<?php
/**
 * The template for displaying search results pages.
 *
 * @package cortex
 */

get_header();
global $cortex_options;
$cortex_theme_options 		 = $cortex_options;
$cortex_navigation_type      = sanitize_html_class( $cortex_theme_options['c9-navigation-type'] );
?>

	<section id="primary" class="content-area page-home page-search<?php echo ' '.$cortex_navigation_type; ?>">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) { ?>

			<header class="entry-header entry-header-page mar30B blog-latest-header">
				<div class="entry-header-standard-wrapper center">
					<div class="entry-header-standard">
						<div class="entry-header-standard-inner" data-130-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
							<div class="container">
								<h1 class="entry-title blog_latest_title center"><?php printf( __( 'Search Results for: %s', 'cortex' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
							</div><!--end container-->
						</div><!--end entry-header-standard-inner-->
					</div><!--end entry-header-standard-->
				</div><!--entry-header-standard-wrapper-->
			</header><!-- .entry-header -->

			<?php /* Start the Loop */ ?>
			<div class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 article-container">
			<?php
			while ( have_posts() ) {
				the_post();

				get_template_part( 'parts/content', 'search' );

			} //endwhile;

			the_posts_navigation();

} else {

	get_template_part( 'parts/content', 'none' );

}
?>
					</div><!--end column-->
				</div><!--end row-->
			</div><!--end container-->

		</main><!-- #main -->
	</section><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
