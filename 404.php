<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package cortex
 */

get_header();
global $cortex_options;
$cortex_theme_options = $cortex_options;
$cortex_navigation_type      = sanitize_html_class( $cortex_theme_options['c9-navigation-type'] );
?>

	<div id="primary" class="content-area page-home page-search page-404<?php echo ' '.$cortex_navigation_type; ?>">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<header class="entry-header entry-header-page mar30B blog-latest-header">
					<div class="entry-header-standard-wrapper center">
						<div class="entry-header-standard">
							<div class="entry-header-standard-inner" data-130-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
								<div class="container">
									<h1 class="entry-title blog_latest_title center"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'cortex' ); ?></h1>
								</div><!--end container-->
							</div><!--end entry-header-standard-inner-->
						</div><!--end entry-header-standard-->
					</div><!--entry-header-standard-wrapper-->
				</header><!-- .entry-header -->

				<div class="container">


						<div class="page-content">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'cortex' ); ?></p>
							<div class="search-form-404 mar50B">
								<?php get_search_form(); ?>
							</div>
							<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

							<?php if ( cortex_categorized_blog() ) { // Only show the widget if site has multiple categories. ?>
							<div class="widget widget_categories">
								<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'cortex' ); ?></h2>
								<ul>
								<?php
									wp_list_categories( array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									) );
								?>
								</ul>
							</div><!-- .widget -->
							<?php } //endif ?>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">

							<?php
								/* translators: %1$s: smiley */
								$cortex_archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'cortex' ), convert_smilies( ':)' ) ) . '</p>';
								the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$cortex_archive_content" );
							?>

							<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
							</div>
							</div>

						</div><!-- .page-content -->
				</div><!--end container-->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
