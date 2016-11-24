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
$cortex_theme_options = $cortex_options;
$cortex_navigation_type   = sanitize_html_class( $cortex_theme_options['c9-navigation-type'] );

// vars
$cortex_queried_object = get_queried_object();
$cortex_taxonomy = $cortex_queried_object->taxonomy;
$cortex_term_id = $cortex_queried_object->term_id;

$cortex_posts_layout = 'magazine';

?>

	<div id="primary" class="content-area<?php echo ' '.$cortex_navigation_type; ?>">
		<main id="main" class="site-main" role="main">
			<section id="section-category" class="content-single content-category">

			<?php if ( have_posts() ) { ?>

				<header class="entry-header entry-header-page entry-header-category mar20B<?php if ( ! empty( $cortex_featured_header ) ) { echo ' dark-overlay';} ?>">
					<?php if ( ! empty( $cortex_featured_header ) ) { ?>
					<figure class="entry-image" data-center="background-position: 0px 0px;" data-top-bottom="background-position: 0px -100px;" data-anchor-target=".entry-header" <?php if ( ! empty( $cortex_featured_header ) ) { echo 'style="background: url('.esc_url( $cortex_featured_header['sizes']['featured-header'] ).') top left fixed no-repeat; background-size: cover; background-position: center center;"'; } ?>></figure>
					<?php } ?>
					<div class="entry-header-standard-wrapper">
						<div class="entry-header-standard">
							<div class="entry-header-standard-inner" data-130-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
								<div class="container">
									<div class="row author-info">
										<div class="col-xs-2 col-sm-3">
											<div class="avatar">
												<?php echo get_avatar( get_the_author_meta( 'email' ), '210' ); ?>
											</div><!-- .avatar -->
										</div><!--end row-->
										<div class="col-xs-10 col-sm-9">
											<?php the_archive_title( '<h1 class="entry-title center">', '</h1>' ); ?>
											<p class="description">
												<?php the_author_meta( 'description' ); ?>
											</p>
											<div class="author-social">
												<ul class="author-social">
													<?php if ( get_the_author_meta( 'user_url' ) != '' ) { ?>
														<li>
															<a class="user-url" href="<?php echo wp_kses( get_the_author_meta( 'user_url' ), null ); ?>">
																<?php printf( esc_attr__( 'Website', 'cortex' ), get_the_author() ); ?>
															</a>
														</li>
													<?php } ?>

													<?php if ( get_the_author_meta( 'c9twitter' ) != '' ) { ?>
														<li>
															<a class="twitter-link" href="<?php echo wp_kses( get_the_author_meta( 'c9twitter' ), null ); ?>">
																<?php printf( esc_attr__( 'Twitter', 'cortex' ), get_the_author() ); ?>
															</a>
														</li>
													<?php } ?>

													<?php if ( get_the_author_meta( 'c9facebook' ) != '' ) { ?>
														<li>
															<a class="facebook-link" href="<?php echo wp_kses( get_the_author_meta( 'c9facebook' ), null ); ?>">
																<?php printf( esc_attr__( 'Facebook', 'cortex' ), get_the_author() ); ?>
															</a>
														</li>
													<?php } ?>

													<?php if ( get_the_author_meta( 'c9google' ) != '' ) { ?>
														<li>
															<a class="google-link" href="<?php echo wp_kses( get_the_author_meta( 'c9google' ), null ); ?>?rel=author">
																<?php printf( esc_attr__( 'Google+', 'cortex' ), get_the_author() ); ?>
															</a>
														</li>
													<?php } ?>

													<?php if ( get_the_author_meta( 'c9pinterest' ) != '' ) { ?>
														<li>
															<a class="pinterest-link" href="<?php echo wp_kses( get_the_author_meta( 'c9pinterest' ), null ); ?>">
																<?php printf( esc_attr__( 'Pinterest', 'cortex' ), get_the_author() ); ?>
															</a>
														 </li>
													<?php } ?>

													<?php if ( get_the_author_meta( 'c9linkedin' ) != '' ) { ?>
														<li>
															<a class="linkedin-link" href="<?php echo wp_kses( get_the_author_meta( 'c9linkedin' ), null ); ?>">
																<?php printf( esc_attr__( 'LinkedIn', 'cortex' ), get_the_author() ); ?>
															</a>
														 </li>
													<?php } ?>

													<?php if ( get_the_author_meta( 'c9instagram' ) != '' ) { ?>
														<li>
															<a class="instagram-link" href="<?php echo wp_kses( get_the_author_meta( 'c9instagram' ), null ); ?>">
																<?php printf( esc_attr__( 'Instagram', 'cortex' ), get_the_author() ); ?>
															</a>
														 </li>
													<?php } ?>
												</ul><!-- .author-social -->
											</div><!-- .author-social-->
										</div><!--end col-->
									</div><!--end row-->
								</div><!--end container-->
							</div><!--end entry-header-standard-inner-->
						</div><!--end entry-header-standard-->
					</div><!--entry-header-standard-wrapper-->
				</header><!-- .entry-header -->

				<div class="container">


<?php

if ( have_posts() ) {

	$i = 1; // setup for clearing the articles

?>
<div class="row mar20T">
<?php
while ( have_posts() ) {

	the_post();

	$cortex_format = get_post_format();
	if ( ( $cortex_format === false ) || ( $cortex_format == 'image' ) ) { $cortex_format = 'standard';}

	// get_template_part( 'page-builder/format', $cortex_format );*/
?>
<div class="col-xs-12 col-sm-6 col-md-4">

<article class="magazine-article mar50B <?php echo $cortex_format; ?>">
	<figure class="magazine-image entry-image">
		<?php

		switch ( $cortex_format ) {
			case 'video':
				$cortex_iframe = get_field( 'video_link' );

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
						'title'     => 0,
						'byline'    => 0,
						'portrait'    => 0,
						);

						$new_src = add_query_arg( $params, $src );

						$cortex_iframe = str_replace( $src, $new_src, $cortex_iframe );

						$cortex_iframe = str_replace( 'frameborder="0"', '', $cortex_iframe );

				}
	?>
							<div class="embed-container"><?php echo $cortex_iframe; ?></div>
				<?php
				break;
			case 'audio':

				// get iframe HTML
				$cortex_iframe = get_field( 'audio_link' );

				$cortex_iframe = str_replace( 'frameborder="0"', '', $cortex_iframe );

	?>
						<?php if ( has_post_thumbnail() ) { ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured-audio', array( 'class' => 'img-responsive' ) ); ?></a><?php } ?>
						<div class="audio-embed-container mar20B"><?php echo $cortex_iframe; ?></div>
			<?php
				break;
			case 'quote':
				$person    = get_field( 'person' );
				$quote_text   = get_field( 'quote_text' );
				$quote_source = get_field( 'quote_source' );
				$quote_link   = esc_url( get_field( 'quote_link' ) );

	?>
					<?php if ( has_post_thumbnail() ) { ?><div class="dark-overlay"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured', array( 'class' => 'img-responsive' ) ); ?></a><span class="h6 quote-source"><strong><?php echo $person; ?></strong></span></div><?php } ?>

			<?php
				break;
			default:
	?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured', array( 'class' => 'img-responsive' ) ); ?></a>
			<?php
				break;
		} //end format switch
?>
		</figure>
		<header class="archive-magazine-entry-header">
			<?php
			if ( $cortex_format != 'quote' ) {
?>
				<div class="magazine-article-header">
					<div class="magazine-article-date"><span class="h5 alternate"><?php cortex_posted_on(); ?></span></div>
					<h5 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
					<div class="entry-meta">
						<?php cortex_author(); ?> / <?php cortex_post_categories(); ?> <?php cortex_post_tags(); ?>
					</div><!-- .entry-meta -->
				</div><!--end magazine-article-header-->
				<?php
			} else {
?>
				<div class="magazine-article-header">
					<h5 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
				</div>
				<?php
			}
?>
		</header><!-- .entry-header -->

		<?php if ( $cortex_format != 'quote' ) { // check for post quote type ?>

				<div class="entry-content magazine-article-content">
					<?php echo cortex_the_excerpt( 'Read more', 25, 1 ); ?>
				</div>

			<?php } else { // it is a post quote so show the quote ?>

				<blockquote><?php echo $quote_text; ?></blockquote>
				<?php if ( $quote_source != '' ) { ?>

					<?php if ( $quote_link == '' ) { ?>
						<small><?php echo $quote_source; ?></small>
					<?php } else { ?>
						<a href="<?php echo $quote_link; ?>" target="_blank" title="<?php the_title_attribute(); ?>"><span class="small-link"><?php echo $quote_source; ?></span></a>
					<?php } ?>

				<?php } ?>
			<?php
} //end of checking to see if it's a quote type
?>
	</article>
</div>
<?php
if ( $i % 3 == 0 ) { // check for the article count to clear appropriately
?>
<div class="clearfix visible-md-block visible-lg-block"></div>
<?php
} //end checking article # for md column layouts
if ( $i % 2 == 0 ) { // now check for the sm column layouts
?>
<div class="clearfix visible-sm-block"></div>
<?php
}
		$i++;
} //end while loop
?>

</div><!--end row-->
<?php

} else {

	get_template_part( 'content', 'none' );

} //endif

	wp_reset_query();
?>

		<?php
		$cortex_navargs = array(
		'prev_text' => 'Previous page',
		'next_text' => 'Next page',
		);
		the_posts_pagination( $cortex_navargs );
?>

				</div>

			<?php } else { // didn't find any posts ?>

				<div class="container">

				<?php get_template_part( 'content', 'none' ); ?>

				</div>

			<?php } //end of the if have posts statement ?>

			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
