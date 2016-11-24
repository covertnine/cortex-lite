<?php
/**
 * @package cortex
 */

// get iframe HTML
$cortex_iframe 		 = get_field( 'video_link' );
$cortex_posts_layout = get_sub_field( 'c9_posts_layout' );

if ( $cortex_iframe !== '' ) {
	// use preg_match to find iframe src
	preg_match( '/src="(.+?)"/', $cortex_iframe, $matches );
	$src = $matches[1];


	// add extra params to iframe src
	$params = array(
		'controls'     => 1,
		'hd'           => 1,
		'autohide'     => 1,
		'showinfo'    => 0,
		'iv_load_policy'  => 3,
		'modestbranding'  => 1,
		'rel'     => 0,
		'byline'    => 0,
		'portrait'    => 0,
		'title'     => 0,
	);

	$new_src = add_query_arg( $params, $src );

	$cortex_iframe = str_replace( $src, $new_src, $cortex_iframe );
	$cortex_iframe = str_replace( 'frameborder="0"', '', $cortex_iframe );

	// check for SSL and appropriately re-embed the iframe with the proper source being http or https
	if ( ( ! empty( $_SERVER['HTTPS'] ) ) && ( $_SERVER['HTTPS'] != 'off' ) ) {

		// ssl connection
		$cortex_iframe = str_replace( 'http:', 'https:', $cortex_iframe );

	} else {

		// non-ssl connection
		$cortex_iframe = str_replace( 'https:', 'http:', $cortex_iframe );

	}
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row wow animated fadeInUp">
		<?php if ( $cortex_iframe !== '' ) { ?>
		<div class="col-xs-12<?php if ( (is_sticky()) || ($cortex_posts_layout == 'c9-full') ) { echo " col-md-12"; } else { echo " col-md-4"; } ?>">
			<figure class="entry-image">
				<div class="embed-container"><?php echo $cortex_iframe; ?></div>
			</figure>
		</div>
		<?php } ?>
		<div class="col-xs-12 <?php if ( ( $cortex_iframe == '' ) || (is_sticky()) || ($cortex_posts_layout == 'c9-full') ) { echo 'col-md-12';
} else { echo 'col-md-8'; } ?>">
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
		</div><!-- .col-md-4-->

		<footer class="entry-footer">
			<?php cortex_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- end row-->
</article><!-- #post-## -->
