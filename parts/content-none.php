<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cortex
 */
?>

<section id="section-single" class="content-single content-none">
	<header class="entry-header entry-header-page mar20B<?php if ( ! empty( $cortex_featured_header ) ) { echo ' dark-overlay';} ?>">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="entry-image" data-center="background-position: 0px 0px;" data-top-bottom="background-position: 0px -100px;" data-anchor-target=".entry-header" <?php if ( ! empty( $cortex_featured_header ) ) { echo 'style="background: url('.esc_url($cortex_featured_header[0]).') center center no-repeat; background-size: cover; background-position: center center;"'; } ?>></figure>
		<?php } ?>
		<div class="entry-header-standard-wrapper">
			<div class="entry-header-standard">
				<div class="entry-header-standard-inner" data-130-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
					<div class="container">
						<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'cortex' ); ?></h1>
					</div><!--end container-->
				</div><!--end entry-header-standard-inner-->
			</div><!--end entry-header-standard-->
		</div><!--entry-header-standard-wrapper-->
	</header><!-- .entry-header -->

	<div class="container">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<div class="mar50B">
				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cortex' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
			</div>

		<?php elseif ( is_search() ) : ?>

			<div class="mar50B">
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cortex' ); ?></p>
				<?php get_search_form(); ?>
			</div>

		<?php else : ?>

			<div class="mar50B">
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cortex' ); ?></p>
				<?php get_search_form(); ?>
			</div>

		<?php endif; ?>
	</div><!-- .container-->
</section><!-- .no-results -->
