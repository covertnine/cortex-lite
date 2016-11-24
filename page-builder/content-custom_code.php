<?php
$cortex_customClassCode    = esc_html( get_sub_field( 'custom_class' ) );
?>
<section id="section-<?php echo $cortex_counter; ?>" class="custom_code<?php if ( ! empty( $cortex_customClassCode ) ) { echo ' ' . $cortex_customClassCode; } ?>">

				<?php the_sub_field( 'custom_code' ); ?>

				<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>

</section>
<?php $cortex_counter++;
unset( $cortex_customClassCode );
?>
