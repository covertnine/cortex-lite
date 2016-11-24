<?php
if ( $cortex_enable_big_header == 'disable' ) {
?>
<div class="small-header">
	<?php the_post_thumbnail( 'cortex-featured',array( 'class' => 'img-responsive mar20B' ) ); ?>
	<h1 class="h4"><?php the_title(); ?></h1>
</div>
<?php
}
$cortex_format = get_post_format();
switch ( $cortex_format ) {
	case 'gallery' :
		include( locate_template( 'parts/post-format-gallery-body.php' ) );
	break;
	case 'quote' :
		include( locate_template( 'parts/post-format-quote-body.php' ) );
	break;
	default:
		the_content();
	break;
}
?>
