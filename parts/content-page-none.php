<?php
$cortex_featured_header			 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'featured-header' );
$cortex_enable_big_header 		 = get_field( 'c9_enable_big_header' );
?>
<section id="section-single" class="content-single">

	<?php include( locate_template( 'parts/content-page-header.php' ) ); ?>

	<div class="container">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="row">

				<div class="col-xs-12 col-md-12">
					
					<?php
					if ( $cortex_enable_big_header == 'disable' ) {
					?>
					<div class="small-header">
						<?php the_post_thumbnail( 'cortex-featured',array( 'class' => 'img-responsive mar20B' ) ); ?>
						<h1 class="h4"><?php the_title(); ?></h1>
					</div>
					<?php
					}
					?>

					<div class="entry-content mar20T">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'cortex' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php cortex_entry_footer(); ?>
					</footer><!-- .entry-footer -->

					<?php the_post_navigation(); ?>
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
</section><!--end setion-->
