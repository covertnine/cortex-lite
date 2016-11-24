<?php
$cortex_title      = get_sub_field( 'title' );
$cortex_subtitle    = get_sub_field( 'sub_title' );
$cortex_background    = get_sub_field( 'custom_background' );
$cortex_backgroundColor   = get_sub_field( 'background_color' );
$cortex_backgroundImage  = esc_url( get_sub_field( 'background_image' ) );
$cortex_backgroundPattern  = esc_url( get_sub_field( 'background_pattern' ) );
$cortex_backgroundRepeat  = get_sub_field( 'background_pattern_repeat' );
$cortex_backgroundParallax  = get_sub_field( 'background_image_parallax' );
$cortex_customClass    = esc_html( get_sub_field( 'custom_class' ) );

/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
if ( $cortex_background != 'none' ) {

	if ( ( $cortex_backgroundColor != '' ) || ( $cortex_backgroundImage != '' ) || ( $cortex_backgroundPattern != '' ) ) {
		$cortex_style    = 'style="';
	}
	if ( $cortex_backgroundColor != '' ) {
		$cortex_style  .= "background-color: $cortex_backgroundColor; ";
	}
	if ( ( $cortex_backgroundImage != '' ) && ( $cortex_background == 'image' ) ) {
		$cortex_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat; background-position: center center;";
	}
	if ( ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'pattern' ) ) || ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'color_pattern' ) ) ) {
		$cortex_style  .= "background-image: url($cortex_backgroundPattern); background-repeat: $cortex_backgroundRepeat;";
	}
} //end checking for custom background

?>
<section id="section-<?php echo $cortex_counter; ?>" class="contact_form<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg" <?php if ( $cortex_backgroundParallax == 'yes' ) { echo "data-bottom-top=\"background-position: 0px 0px;\" data-top-bottom=\"background-position: 0% -200%;\" data-anchor-target=\"#section-$cortex_counter\""; } ?> <?php if ( ! empty( $cortex_style ) ) { echo $cortex_style.'"'; } ?>>
	<div class="container">

		<?php if ( ( ! empty( $cortex_title ) ) || ( ! empty( $cortex_subtitle ) ) ) { ?>
		<header class="contact-heading wow animated fadeInUp">
			<span class="h1 center mar20B">
			<?php echo $cortex_title; ?>
			</span>
			<span class="center events_description subtitle mar30B"><?php echo $cortex_subtitle; ?></span>
		</header>
		<?php } ?>

		<div class="wow animated fadeInUp">
			<?php the_sub_field( 'select_contact_form' ); ?>
		</div>
		<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!--end container-->
	</div><!--end section-bg-->
</section><!-- #section-## -->
<?php $cortex_counter++;
unset( $cortex_style, $cortex_title, $cortex_subtitle, $cortex_background, $cortex_backgroundColor, $cortex_backgroundImage, $cortex_backgroundPattern, $cortex_backgroundRepeat, $cortex_backgroundParallax, $cortex_customClass ); ?>
