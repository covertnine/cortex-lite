<?php
$cortex_customClass     = esc_html( get_sub_field( 'custom_class' ) );

if ( in_array( 'heading', get_sub_field( 'select_elements' ) ) ) {
	$cortex_title       = get_sub_field( 'heading' );
	$cortex_title_size      = get_sub_field( 'heading_size' );
}

if ( in_array( 'subheading', get_sub_field( 'select_elements' ) ) ) {
	$cortex_sub_title      = get_sub_field( 'sub_heading' );
	$cortex_sub_title_size     = get_sub_field( 'sub_heading_size' );
}

if ( in_array( 'text', get_sub_field( 'select_elements' ) ) ) {
	$cortex_basic_text      = get_sub_field( 'basic_text' );
}


if ( in_array( 'line-break', get_sub_field( 'select_elements' ) ) ) {
	$cortex_line_active     = true;
	$cortex_line_width      = get_sub_field( 'line_break_width' );

	// set proper class
	if ( $cortex_line_width == '25%' ) {

		$cortex_line_width = 'c9-25';

	} elseif ( $cortex_line_width == '50%' ) {

		$cortex_line_width = 'c9-50';

	} elseif ( $cortex_line_width == '75%' ) {

		$cortex_line_width = 'c9-75';

	} else {

		$cortex_line_width = 'c9-100';

	}
}

?>
<section id="section-<?php echo $cortex_counter;
$cortex_counter++; ?>" class="basic_title_text<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">

			<?php if ( ( ! empty( $cortex_title ) ) || ( ! empty( $cortex_sub_title ) ) || ( ! empty( $cortex_line_active ) ) ) { ?>

			<div class="row wow animated fadeInUp">
				<div class="col-xs-12">
					<header class="basic-title-text-header">
						<div class="basic-title-heading mar30B">
							<?php if ( ( ! empty( $cortex_title ) ) && ( in_array( 'heading', get_sub_field( 'select_elements' ) ) ) ) { ?>
								<<?php echo $cortex_title_size; ?> class="center <?php if ( ($cortex_title_size == 'h6') || ($cortex_title_size == 'h5') ) { echo 'mar20B';
} else { echo 'mar10B'; } ?>"><?php echo $cortex_title; ?></<?php echo $cortex_title_size; ?>>
							<?php } ?>
							<?php if ( ( ! empty( $cortex_sub_title )) && ( in_array( 'subheading', get_sub_field( 'select_elements' ) )) ) { ?>
								<span class="subtitle center <?php echo $cortex_sub_title_size; ?>"><?php echo $cortex_sub_title; ?></span>
							<?php } ?>
						</div>
					</header>
				</div><!--end col-->
			</div>
			<?php if ( ! empty( $cortex_line_active ) ) { ?>
			<div class="center wow animated fadeInLeft"><hr width="<?php echo $cortex_line_width; ?>" /></div>
			<?php } //end line break check ?>

			<?php } //end of empty title/subtitle check ?>

			<?php if ( ! empty( $cortex_basic_text ) ) { ?>
			<div class="row wow animated fadeInUp">
				<div class="col-xs-12">
					<div class="basic-title-text-body mar30T entry-content">
						<?php echo $cortex_basic_text; ?>
					</div>
				</div><!--end col-->
			</div>
			<?php } ?>

		<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
</section><!-- #section-## -->
<?php unset( $cortex_customClass, $cortex_title, $cortex_title_size, $cortex_sub_title, $cortex_sub_title_size, $cortex_basic_text, $cortex_line_width, $cortex_line_active ); ?>
