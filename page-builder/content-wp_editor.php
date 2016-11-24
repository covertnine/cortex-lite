<?php
$cortex_backgroundColor  = get_sub_field( 'background_color' );
$cortex_backgroundImage   = esc_url( get_sub_field( 'background_image' ) );
$cortex_backgroundPattern  = esc_url( get_sub_field( 'background_pattern' ) );
$cortex_backgroundRepeat  = get_sub_field( 'background_pattern_repeat' );
$cortex_backgroundParallax  = get_sub_field( 'background_image_parallax' );
$cortex_background    = get_sub_field( 'custom_background' );
$cortex_customClass   = esc_html( get_sub_field( 'custom_class' ) );

/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
if ( $cortex_background != 'none' ) {

	if ( ( $cortex_backgroundColor != '' ) || ( $cortex_backgroundImage != '' ) || ( $cortex_backgroundPattern != '' ) ) {
		$cortex_style    = 'style="';
	}
	if ( $cortex_backgroundColor != '' ) {
		$cortex_style  .= "background-color: $cortex_backgroundColor; ";
	}
	if ( ( $cortex_backgroundImage != '' ) && ( $cortex_background == 'image' ) ) {
		$cortex_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat; background-position: 0% 0%;";
	}
	if ( ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'pattern' ) ) || ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'color_pattern' ) ) ) {
		$cortex_style  .= "background-image: url($cortex_backgroundPattern); background-repeat: $cortex_backgroundRepeat;";
	}
} //end checking for custom background
?>
<section id="section-<?php echo $cortex_counter; ?>"  class="wp_editor<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg" <?php if ( $cortex_backgroundParallax == 'yes' ) { echo "data-start=\"background-position: 0% 100%;\" data-top-bottom=\"background-position: 0% 0%;\" data-anchor-target=\"#section-$cortex_counter\""; } ?> <?php if ( ! empty( $cortex_style ) ) { echo $cortex_style.'"'; } ?>>
		<div class="container">

			<article class="post-content">

				<div class="entry-content">
					<?php the_sub_field( 'content' ); ?>
				</div>

				<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>

			</article><!-- #post-## -->

		</div><!-- #container -->
	</div><!--end section-bg-->
</section>
<?php $cortex_counter++;
unset( $cortex_backgroundImage, $cortex_backgroundColor, $cortex_backgroundPattern, $cortex_style ); ?>
