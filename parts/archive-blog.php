<?php
/*
 * The template for displaying archive pages in the blog style
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
<?php if ( have_posts() ) { ?>
<div class="category-blog">
	<?php
	while ( have_posts() ) {

		the_post();

		$cortex_format = get_post_format();
		if ( ($cortex_format === false) || ($cortex_format == 'image') ) { $cortex_format = 'standard'; }

		get_template_part( 'page-builder/format', $cortex_format );

	} //endwhile
	?>
</div>
	<?php
} else { ?>

	<?php esc_html_e( 'No posts were found.', 'cortex' ); ?>

	<?php
} //endif
	wp_reset_postdata();
	?>
