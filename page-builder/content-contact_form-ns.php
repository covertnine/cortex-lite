<?php
$cortex_title      = get_sub_field( 'title' );
$cortex_subtitle    = get_sub_field( 'sub_title' );
$cortex_customClass    = esc_html( get_sub_field( 'custom_class' ) );


?>
<section id="section-<?php echo $cortex_counter;
$cortex_counter++; ?>" class="contact_form <?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg">

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
	</div><!--end section-bg-->
</section><!-- #section-## -->
<?php unset( $cortex_title, $cortex_subtitle, $cortex_customClass ); ?>
