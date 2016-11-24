<div class="<?php if ( (empty($cortex_posts_layout)) || ($cortex_posts_layout == 'blog') ) { echo "col-xs-12 col-sm-12 col-md-8 col-md-offset-2"; } else { echo "col-xs-12"; } ?>>

<?php
switch ( $cortex_posts_layout ) {

	case 'magazine':
		include( locate_template( 'parts/archive-magazine.php' ) );
	break;

	case 'latest-featured':
		include( locate_template( 'parts/archive-magazine-featured.php' ) );
	break;

	case 'masonry':
		include( locate_template( 'parts/archive-masonry.php' ) );
	break;

	case 'blog':
		include( locate_template( 'parts/archive-blog.php' ) );
	break;

	default:
		include( locate_template( 'parts/archive-blog.php' ) );
	break;

} //end switch
?>

	<?php
		$navargs = array(
			'prev_text' => __( 'Previous', 'cortex' ),
			'next_text' => __( 'Next', 'cortex' ),
		);
		the_posts_pagination( $navargs );
	?>

</div><!--end content column-->
