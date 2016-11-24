<div class="col-xs-12<?php if ( $cortex_sidebar_enable == 'sidebar-default' ) { echo ' col-sm-7 col-md-9 '; } elseif ( $cortex_posts_layout == 'blog' ) { echo ' col-sm-12 col-md-8 col-md-offset-2'; } elseif ( $cortex_posts_layout == '' ) { echo ' col-sm-12 col-md-8 col-md-offset-2'; } else { echo ' col-sm-12'; }?>">

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

<?php if ( $cortex_sidebar_enable == 'sidebar-default' ) { // check to see if the sidebar has widgets in it next ?>
<div class="col-xs-12 col-sm-5 col-md-3 sidebar wow animated slideInUp" id="sidebar-right">
	<?php
	if ( is_active_sidebar( 'sidebar-2' ) ) {
		dynamic_sidebar( 'sidebar-2' );
	} else {
		esc_html__( 'Sidebar must have widgets assigned to them!', 'cortex' );
	}
	?>
</div>
<?php } ?>
