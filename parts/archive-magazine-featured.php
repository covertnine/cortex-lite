<?php
/*
 * The template for displaying archive pages in the magazine style with one or two featured latest posts
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cortex 1.0
 */

// vars for proper oembed display
$cortex_queried_object = get_queried_object();
$cortex_taxonomy = $cortex_queried_object->taxonomy;
$cortex_term_id = $cortex_queried_object->term_id;

$GLOBALS['wp_embed']->post_ID = $cortex_taxonomy . '_' . $cortex_term_id;

?>
<div class="row mar20T">
<div class="col-xs-12 col-sm-6 col-md-8">
<?php
// create a new query to pull the most recent post from the category to feature it
$args = array(
	'post_type'              => 'post',
	'post_status'    => 'publish',
	'category__in'    => $cortex_term_id, // defined on archive.php
	'posts_per_page'   => 2,
	'paged'      => get_query_var( 'page' ),
);
$cortex_featured_query = new WP_Query( $args );

// save the original category query so we can restore it after we pull the latest post and feature that
global $query_string;
$wp_query = $query_string;
$temp_query = $wp_query;
$wp_query   = null;
$wp_query   = $cortex_featured_query;

if ( $wp_query->have_posts() ) { // see if there are posts in this category--there should be.

	while ( $wp_query->have_posts() ) { // while there is posts, loop through the 1 featured item

		$wp_query->the_post();


		$cortex_format = get_post_format();
		if ( ($cortex_format === false) || ($cortex_format == 'image') ) { $cortex_format = 'standard';}

?>
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


							// add extra attributes to iframe html
							$attributes = '';

							$cortex_iframe = str_replace( '></iframe>', ' ' . $attributes . '></iframe>', $cortex_iframe );
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

							<?php if ( has_post_thumbnail() ) { ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?></a><?php } ?>
							<div class="audio-embed-container mar20B"><?php echo $cortex_iframe; ?></div>
				<?php
					break;
					case 'quote':
						$cortex_person    = get_field( 'person' );
						$cortex_quote_text   = get_field( 'quote_text' );
						$cortex_quote_source = get_field( 'quote_source' );
						$cortex_quote_link   = esc_url( get_field( 'quote_link' ) );

			?>
						<?php if ( has_post_thumbnail() ) { ?><div class="dark-overlay"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?></a><span class="h6 quote-source"><strong><?php echo $cortex_person; ?></strong></span></div><?php } ?>

				<?php
					break;
					default:
			?>
						<?php if ( has_post_thumbnail() ) { ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?></a><?php } ?>
				<?php
					break;
				} //end format switch
?>
			</figure>
			<header class="archive-magazine-featured-entry-header">
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
					<?php echo cortex_the_excerpt( 'Read more', 45, 1 ); ?>
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
	<?php } //end of while post for featured ?>
	</div><!--end column-->
	<?php
} else { // no posts were found

	get_template_part( 'content', 'none' );

} //endif

wp_reset_query();
?>
	<div class="col-xs-12 col-sm-6 col-md-4 magazine-recent-posts">

<?php

if ( have_posts() ) { // now back to the original query for the archive page


	while ( have_posts() ) {

		the_post();
?>
		<div class="single-article-container">
			<article class="wow animated fadeInUp single-article mar20B">
				<?php if ( has_post_thumbnail() ) { ?>
				<figure class="single-article-image entry-image alignleft">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured-audio', array( 'class' => 'img-responsive' ) ); ?></a>
				</figure>
				<?php } ?>
				<header class="single-article-title alignleft">
					<div class="magazine-article-date"><span class="h6 alternate"><?php cortex_posted_on(); ?></span></div>
					<h4 class="entry-title mar5T mar5B"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="mar0T"><?php the_title();?></span></a></h4>
				</header>
				<div class="clearfix"></div>
			</article>
		</div>
<?php
	} //endwhile
} else { // no posts were found in this category so an error will show

	get_template_part( 'content', 'none' );

} //end of error of not finding entries
wp_reset_query();
?>


	</div><!--end column-->
</div><!--end of nested row-->
