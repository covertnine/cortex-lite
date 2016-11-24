<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cortex
 */

get_header();
global $cortex_options;
$cortex_theme_options     = $cortex_options;
$cortex_sidebar           = $cortex_theme_options['c9-page-sidebar'];

// vars
$cortex_queried_object    = get_queried_object();
$cortex_taxonomy          = $cortex_queried_object->taxonomy;
$cortex_term_id           = $cortex_queried_object->term_id;

// use the post id to pull the navigation_type_override variable
$cortex_navigation_type_override     = sanitize_html_class( get_field( 'navigation_type_override', $cortex_taxonomy . '_' . $cortex_term_id ) );

// load header for this taxonomy term (term object)
$cortex_featured_image         = get_field( 'category_image', $cortex_queried_object );
$cortex_featured_header        = esc_url( $cortex_featured_image['sizes']['cortex-featured-header'] );
$cortex_featured_image_overlay = get_field( 'enable_overlay', $cortex_taxonomy . '_' . $cortex_term_id );
$cortex_category_height 	   = get_field( 'category_header_height', $cortex_taxonomy . '_' . $cortex_term_id );

$GLOBALS['wp_embed']->post_ID  = $cortex_taxonomy . '_' . $cortex_term_id;

// load sidebar for this taxonomy term (term string)
$cortex_sidebar_enable         = get_field( 'sidebar', $cortex_taxonomy . '_' . $cortex_term_id );

// load posts layout
$cortex_posts_layout      	   = get_field( 'posts_layout', $cortex_taxonomy . '_' . $cortex_term_id );

if ( empty( $cortex_sidebar_enable ) ) {
	$cortex_sidebar_enable = 'sidebar-default';
}

if ( empty( $cortex_posts_layout ) ) {
	$cortex_posts_layout = 'magazine';
}

// if the navigation type has been changed, change the navigation type variable
if ( ($cortex_navigation_type_override != 'default' ) && ( $cortex_navigation_type_override != '' ) ) {
	$GLOBALS['cortex_navigation_type'] = sanitize_html_class( $cortex_navigation_type_override );
}
?>

	<div id="primary" class="content-area<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>">
		<main id="main" class="site-main" role="main">
			<section id="section-category" class="content-single content-category">

			<?php if ( have_posts() ) { ?>

				<header class="entry-header entry-header-page entry-header-category mar20B<?php if ( ( ! empty($cortex_featured_header) ) && ( $cortex_featured_image_overlay === true ) ) { echo ' dark-overlay';} if ( ! empty( $cortex_category_height ) ) { echo ' ' . sanitize_html_class($cortex_category_height); } ?>">
					<div class="entry-header-standard-wrapper">
						<div class="entry-header-standard">
							<div class="entry-header-standard-inner" data-130-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
								<div class="container">
									<?php the_archive_title( '<h1 class="entry-title center">', '</h1>' ); ?>

									<?php if ( the_archive_description() ) { ?>
										<hr class="center" />
										<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
									<?php } ?>
								</div><!--end container-->
							</div><!--end entry-header-standard-inner-->
						</div><!--end entry-header-standard-->
					</div><!--entry-header-standard-wrapper-->
					<?php if ( ! empty( $cortex_featured_header ) ) { ?>
					<figure class="entry-image" <?php if ( ! empty( $cortex_featured_header ) ) { echo 'style="background: url('.$cortex_featured_header.') center fixed no-repeat; background-size: cover;"'; } ?>></figure>
					<?php } ?>
				</header><!-- .entry-header -->

				<div class="container">
					<?php
					switch ( $cortex_sidebar ) {
						case 'sidebar-none':
							include( locate_template( 'parts/archive-sidebar-none.php' ) );
						break;
						case 'sidebar-right':
							include( locate_template( 'parts/archive-sidebar-right.php' ) );
						break;
						case 'sidebar-left':
							include( locate_template( 'parts/archive-sidebar-left.php' ) );
						break;
						default:
							include( locate_template( 'parts/archive-sidebar-none.php' ) );
						break;
					} //end sidebar layout switch

?>
				</div>

			<?php } else { // didn't find any posts ?>

				<div class="container">

				<?php get_template_part( 'parts/content', 'none' ); ?>

				</div>

			<?php } //end of the if have posts statement ?>

			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
