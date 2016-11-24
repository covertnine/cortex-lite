<?php
$cortex_featured_header			 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'featured-header' );
$cortex_sidebar 					 = get_field( 'sidebar' );
$cortex_enable_big_header 	= get_field( 'c9_enable_big_header' );

if ( empty( $cortex_sidebar ) ) { $cortex_sidebar = $cortex_theme_options['c9-page-sidebar']; }

?>
<section id="section-single" class="content-single">

	<?php include( locate_template( 'parts/content-page-header.php' ) ); ?>

	<div class="container">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="row">
				<div class="col-xs-12<?php if ( $cortex_sidebar == 'sidebar-none' ) { echo ' col-sm-12 col-md-12';
} else { echo ' col-sm-7 col-md-9'; } ?>">
	
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

					<?php if ( is_single() ) { ?>
					<?php include( locate_template( 'inc/single-social.php' ) ); ?>

					<div class="single-post-navigation">
						<?php the_post_navigation(); ?>
					</div>

					<?php include( locate_template( 'inc/single-author.php' ) ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
						endif;
					?>
					<?php } ?>

				</div><!-- .col-md-9-->
				<?php if ( $cortex_sidebar != 'sidebar-none' ) { // check to see if the sidebar has widgets in it. ?>
				<div class="col-xs-12 col-sm-5 col-md-3 sidebar wow animated slideInUp" id="sidebar-right">
					
					<?php 
					if ( is_active_sidebar( 'sidebar-1' ) ) {
						dynamic_sidebar( 'sidebar-1' ); 
					} else {
						esc_html__( 'Sidebar must have widgets assigned to them!', 'cortex' );
					}
					?>
					
				</div>
				<?php
}
				?>
			</div><!-- end row-->
		</article><!-- #post-## -->
	</div><!--.container -->

</section><!--end setion-->
