<?php
$cortex_customClass  = esc_html( get_sub_field( 'custom_class' ) );
$cortex_set_width    = get_sub_field( 'width' );

// vars for image
$cortex_image      	 = get_sub_field( 'image' );
$cortex_content    	 = get_sub_field( 'content' );
$cortex_overlay    	 = get_sub_field( 'display_overlay' );
?>
<section id="section-<?php echo $cortex_counter; $cortex_counter++; ?>" class="full_width_image<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="<?php if ( ! empty( $cortex_set_width ) ) { echo $cortex_set_width;
} else { echo 'container'; } ?>">

		<div class="slide-header wow animated fadeInUp">
			<div class="slide-img<?php if ( $cortex_overlay == true ) { echo ' dark-overlay'; } ?>" <?php if ( ! empty($cortex_image) ) { ?>style="background-image: url(<?php echo esc_url( $cortex_image['url'] ); ?>);"<?php } ?>>

			<?php if ( ! empty( $cortex_content ) ) { ?>
			<div class="flexslider-slide-content">
				<div class="flex-content-container center entry-content">
		    	<?php echo $cortex_content; ?>
				</div>
			</div>
		    <?php } ?>

			</div><!--end slide-img-->
		</div>

		<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
</section><!-- #section-## -->
<?php unset( $cortex_set_width, $cortex_customClass, $cortex_image, $cortex_content, $cortex_overlay ); ?>
