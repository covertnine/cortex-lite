<?php
$cortex_customClass  = esc_html( get_sub_field( 'custom_class' ) );
?>
<section id="section-<?php echo $cortex_counter;
$cortex_counter++; ?>" class="full_width_slider<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">

		<?php the_sub_field( 'cortex_slider' ); ?>

		<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
</section><!-- #section-## -->
<?php unset($cortex_customClass); ?>
