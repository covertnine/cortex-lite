<?php
$cortex_featured_header     = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'cortex-featured-header' );
$cortex_sidebar      	    = get_field( 'sidebar' );
$cortex_customBackground    = get_field( 'custom_background' );
$cortex_backgroundColor     = get_field( 'background_color' );
$cortex_backgroundImage     = esc_url( get_field( 'background_image' ) );
$cortex_backgroundPattern   = esc_url( get_field( 'background_pattern' ) );
$cortex_backgroundRepeat    = get_field( 'background_pattern_repeat' );
$cortex_enable_big_header 	= get_field( 'c9_enable_big_header' );

/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
if ( $cortex_customBackground != 'none' ) {

	$cortex_style    = 'style="';

	if ( $cortex_backgroundColor != '' ) {
		$cortex_style  .= "background-color: $cortex_backgroundColor; ";
	}
	if ( $cortex_backgroundImage != '' ) {
		$cortex_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat;";
	}
	if ( $cortex_backgroundPattern != '' ) {
		$cortex_style  .= "background-image: url($cortex_backgroundPattern); background-repeat: $cortex_backgroundRepeat;";
	}
	$cortex_style   .= '"';
}
?>
<section id="section-single" class="content-single" <?php if ( ! empty( $cortex_style ) ) { echo ' '.$cortex_style; } ?>>

	<?php include( locate_template( 'parts/content-single-header.php' ) ); ?>

	<div class="container">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
			<div class="row">

				<div class="col-xs-12 col-md-12">

					<div class="entry-content">
						<?php the_content(); ?>
						<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'cortex' ),
							'after'  => '</div>',
						) );
?>

						<div class="entry-meta">
						<?php the_tags( '<div class="tags-links"><span>', '</span> <span>', '</span></div>' ); ?>
						</div>

					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php cortex_entry_footer(); ?>
					</footer><!-- .entry-footer -->

					<?php
					if ( get_post_format() != 'video' ) {
						include( locate_template( 'inc/single-social.php' ) );
					}
?>

					<?php if ( get_the_tag_list() ) { // check to see if there are tags ?>
					<div class="entry-tags wow fadeIn animated">
						<div class="entry-meta">
							<?php the_tags( '<div class="tags-links">', '', '</div>' ); ?>
						</div>
					</div>
					<?php } ?>

					<div class="single-post-navigation">
						<?php 
						the_post_navigation(array(
							'prev_text' => __('Older Post', 'cortex'),
							'next_text' => __('Newer Post', 'cortex')
						)); 
						?>
					</div>

					<?php
					if ( get_post_format() != 'video' ) {
						include( locate_template( 'inc/single-social.php' ) );
					}
?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
endif;
?>

				</div><!-- .col-md-12-->
			</div><!-- end row-->
		</article><!-- #post-## -->
	</div><!--.container -->
</section><!--end section-->
