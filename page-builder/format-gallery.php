<?php
/**
 * @package cortex
 */
$cortex_posts_layout = get_sub_field( 'c9_posts_layout' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row wow animated fadeInUp">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="col-xs-12<?php if ( is_sticky() || ($cortex_posts_layout == 'c9-full') ) { echo " col-md-12"; } else { echo " col-md-4"; } ?>">
			<figure class="entry-image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured',array( 'class' => 'img-responsive' ) ); ?></a>
			</figure>
		</div>
		<?php } ?>
		<div class="col-xs-12<?php if ( ( ! has_post_thumbnail() ) || ( is_sticky() || ($cortex_posts_layout == 'c9-full') ) ) { echo ' col-md-12';
} else { echo ' col-md-8'; } ?>">
			<header class="entry-header">
				<span class="h5 alternate"><?php cortex_posted_on(); ?></span>
				<h5 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
				<div class="entry-meta">
					<?php cortex_author(); ?> / <?php cortex_post_categories(); ?> <?php cortex_post_tags(); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php echo cortex_the_excerpt( 'Read more', 45, 1 ); ?>
				<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'cortex' ),
					'after'  => '</div>',
				) );
?>
			</div><!-- .entry-content -->
		</div><!-- .col-md-7-->

		<footer class="entry-footer">
			<?php cortex_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- end row-->
</article><!-- #post-## -->
