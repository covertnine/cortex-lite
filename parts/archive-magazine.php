<?php
/*
 * The template for displaying archive pages in the magazine style
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cortex 1.0
 */
?>
<?php

if ( have_posts() ) {

	$i = 1; // setup for clearing the articles

?>
<div class="row mar20T">
<?php
while ( have_posts() ) {

	the_post();

	$cortex_format = get_post_format();
	if ( ($cortex_format === false) || ($cortex_format == 'image') ) { $cortex_format = 'standard';}

	?>
	<div class="col-xs-12 col-sm-6 col-md-4">
		<article class="wow animated fadeInUp magazine-article mar50B <?php echo sanitize_html_class($cortex_format); ?>">
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
								'controls'  	  => 1,
								'hd'        	  => 1,
								'autohide'  	  => 1,
								'showinfo'		  => 0,
								'iv_load_policy'  => 3,
								'modestbranding'  => 1,
								'rel'			  => 0,
								'byline'		  => 0,
								'portrait'		  => 0,
								'title'			  => 0,
							);

							$new_src = add_query_arg( $params, $src );

							$cortex_iframe = str_replace( $src, $new_src, $cortex_iframe );

							// add extra attributes to iframe html
							$cortex_badattributes = 'frameborder="0"';

							$cortex_iframe = str_replace( $cortex_badattributes, '', $cortex_iframe );

						}
						?>
						<div class="embed-container"><?php echo $cortex_iframe; ?></div>
				<?php
					break;
					case 'audio':

						// get iframe HTML
						$cortex_iframe = get_field( 'audio_link' );

						// add extra attributes to iframe html
						$attributes = '';

						$cortex_iframe = str_replace( '></iframe>', ' ' . $attributes . '></iframe>', $cortex_iframe );

				?>
						<?php if ( has_post_thumbnail() ) { ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured-audio', array( 'class' => 'img-responsive' ) ); ?></a><?php } ?>
						<div class="audio-embed-container mar20B"><?php echo $cortex_iframe; ?></div>
				<?php
					break;
					case 'quote':
						$cortex_person		  = get_field( 'person' );
						$cortex_quote_text	  = get_field( 'quote_text' );
						$cortex_quote_source = get_field( 'quote_source' );
						$cortex_quote_link	  = esc_url( get_field( 'quote_link' ) );

				?>
					<?php if ( has_post_thumbnail() ) { ?><div class="dark-overlay"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured', array( 'class' => 'img-responsive' ) ); ?></a><span class="h6 quote-source"><strong><?php echo $cortex_person; ?></strong></span></div><?php } ?>

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

				<blockquote><?php echo $cortex_quote_text; ?></blockquote>
				<?php if ( $cortex_quote_source != '' ) { ?>

					<?php if ( $cortex_quote_link == '' ) { ?>
						<small><?php echo $cortex_quote_source; ?></small>
					<?php } else { ?>
						<a href="<?php echo $cortex_quote_link; ?>" target="_blank" title="<?php the_title_attribute(); ?>"><span class="small-link"><?php echo $cortex_quote_source; ?></span></a>
					<?php } ?>

				<?php } ?>
			<?php
} //end of checking to see if it's a quote type
			?>
		</article>
	</div><!--end column-->
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

	get_template_part( 'parts/content', 'none' );

} //endif

wp_reset_query();
?>
