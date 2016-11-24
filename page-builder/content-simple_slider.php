<?php
$cortex_customClass  = esc_html( get_sub_field( 'custom_class' ) );
$cortex_set_width   = sanitize_html_class( get_sub_field( 'width' ) );
?>
<section id="section-<?php echo $cortex_counter;
$cortex_counter++; ?>" class="simple_slider<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="<?php if ( ! empty( $cortex_set_width ) ) { echo $cortex_set_width;
} else { echo 'container'; } ?>">

		<?php if ( have_rows( 'slides' ) ) { ?>
		<div class="flexslider">
		<ul class="slides">

		<?php
		while ( have_rows( 'slides' ) ) {
			the_row();

			// vars for slides
			$cortex_image     = get_sub_field( 'image' );
			$cortex_content    = get_sub_field( 'content' );
			$cortex_link     = get_sub_field( 'link' );
			$cortex_external_link = get_sub_field( 'external_link' );

	?>

			<li class="slide img_slide_container">
				<div class="slide-img">
				<?php if ( ( ! empty( $cortex_link ) ) || ( ! empty( $cortex_external_link ) ) ) { ?>
					<a href="<?php if ( ! empty( $cortex_external_link ) ) { echo esc_url( $cortex_external_link );
} else { echo esc_url( $cortex_link ); } ?>"<?php if ( ! empty( $cortex_external_link ) ) { echo ' target="_blank"'; }?>>
				<?php } ?>

					<img src="<?php echo esc_url( $cortex_image['url'] ); ?>" alt="<?php echo esc_html( $cortex_image['alt'] ); ?>" />

				<?php if ( ( ! empty( $cortex_link ) ) || ( ! empty( $cortex_external_link ) ) ) { ?>
					</a>
				<?php } ?>
				</div><!--end slide-img-->

				<?php if ( ! empty( $cortex_content ) ) { ?>
				<div class="flexslider-slide-content">
					<div class="flex-content-container entry-content">
			    	<?php echo $cortex_content; ?>
					</div>
				</div>
			    <?php } ?>

			</li>

		<?php } //endwhile; ?>

		</ul>
		</div><!--end flexslider-->

	<?php } //endif; ?>

		<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
</section><!-- #section-## -->
<?php unset( $cortex_customClass, $cortex_set_width, $cortex_image, $cortex_content, $cortex_link, $cortex_external_link ); ?>
