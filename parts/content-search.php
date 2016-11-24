<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cortex
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php cortex_posted_on(); ?> / <?php cortex_author(); ?> / <?php cortex_post_categories(); ?> <?php cortex_post_tags(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php echo cortex_the_excerpt( 'Read more', 45, 1 ); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php cortex_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
