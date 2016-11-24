<?php
$cortex_customClass  = esc_html( get_sub_field( 'custom_class' ) );
$cortex_set_width   = get_sub_field( 'set_width' );
?>
<section id="section-<?php echo $cortex_counter;
$cortex_counter++; ?>" class="full_width_slider<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="<?php if ( $cortex_set_width == 'boxed' ) { echo 'container';
} else { echo 'container-fluid'; } ?>">

		<?php the_sub_field( 'cortex_slider' ); ?>

		<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
</section><!-- #section-## -->
<?php unset($cortex_set_width, $cortex_customClass); ?>
