<?php
$cortex_customClass   = esc_html( get_sub_field( 'custom_class' ) );

?>
<section id="section-<?php echo $cortex_counter; ?>"  class="wp_editor<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg">

			<article class="post-content">

				<div class="entry-content">
					<?php the_sub_field( 'content' ); ?>
				</div>

				<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>

			</article><!-- #post-## -->
	</div><!--end section-bg-->
</section>
<?php $cortex_counter++;
unset( $cortex_customClass ); ?>
