<?php
/*
 * The template for displaying archive pages in the masonry style
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cortex 1.0
 */
?>
<div class="row masonry_posts mar30B mar20T">
<?php
if ( have_posts() ) { ?>

 	<div class="grid-tiles isotope">

	<?php
	while ( have_posts() ) {
		the_post();

		$cortex_image		 = get_the_post_thumbnail( get_the_id(), 'large' );

	?>

			<article id="post-<?php the_ID(); ?>" class="tile isotope-item three">

				<?php if ( ! empty( $cortex_image ) ) { ?>
				<figure class="img_container">
					<a href="<?php the_permalink(); ?>" class="entry-link" title="<?php the_title_attribute(); ?>"></a>
					<?php echo $cortex_image; ?>
				</figure>
				<?php } else { ?>
				<figure class="img_container">
					<a href="<?php the_permalink(); ?>" class="entry-link" title="<?php the_title_attribute(); ?>"></a>
					<img src="http://placehold.it/720x480" alt="" />
				</figure>
				<?php } ?>

				<div class="masonry_portfolio_meta">
					<div class="masonry_portfolio_meta_inner">

						<div class="entry-meta">
							<span class="masonry_portfolio_sub_heading"><?php cortex_posted_on(); ?></span>
							<span class="cortex_post_categories visible-xs hidden-sm"><?php cortex_post_categories(); ?></span>
						</div>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="masonry_portfolio_heading"><?php the_title(); ?></span></a>

						<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- #inner end-->
				</div><!-- #meta end-->

			</article><!-- #post-## -->
	<?php
	} //endwhile

	wp_reset_postdata();
	?>

	</div><!-- grid-tiles isotope-->

	<?php } else { ?>

	<div class="grid-tiles">
	<?php esc_html_e( 'No posts were found.', 'cortex' ); ?>
	</div>

	<?php } //endif ?>
</div><!--end row-->
