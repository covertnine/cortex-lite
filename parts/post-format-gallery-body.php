<?php
$cortex_gallery_type    = get_field( 'gallery_type' );
$cortex_images      	= get_field( 'gallery_photos' );
$cortex_the_content     = get_the_content();
if ( empty( $cortex_images ) ) {$cortex_images = get_field( 'images' );}
$cortex_columns     	= get_field( 'columns' );

if ( ( ! empty( $cortex_images )) || ( ! empty( $cortex_the_content )) ) { ?>


<div class="entry-content-gallery-container<?php if ( ($post->post_content == '' ) && ($cortex_gallery_type == 'flex-slider') ) { echo ' hide'; }?>">

	<?php
	switch ( $cortex_gallery_type ) {

		case 'grid':
	?>
		<div class="entry-content-gallery"><?php the_content(); ?></div>
		<div class="entry-content-gallery-grid mar20T">
			<div class="grid-tiles isotope">
				<div class="gutter-sizer <?php echo $cortex_columns; ?>"></div>
				<?php
				if ( ! empty( $cortex_images ) ) {
					foreach ( $cortex_images as $cortex_image ) :  ?>
						<div class="tile isotope-item <?php echo $cortex_columns; ?>">
							<figure class="img_container">
							<a href="<?php echo esc_url($cortex_image['url']); ?>" class="entry-link" title="<?php echo esc_html($cortex_image['caption']); ?>">
							<img src="<?php echo esc_url($cortex_image['sizes']['large']); ?>" alt="<?php echo esc_html($cortex_image['alt']); ?>" data-no-retina /></a>
							</figure>
						</div>
						<?php endforeach;
				} //endforeach
	?>
			</div>
		</div><!--end entry-content-gallery-grid-->
	<?php
		break;

		case 'masonry':
	?>
		<div class="entry-content-gallery"><?php the_content(); ?></div><!--end entry-content-gallery-->
		<div class="entry-content-gallery-grid masonry mar20T">
			<div class="grid-tiles isotope">
				<div class="gutter-sizer <?php echo $cortex_columns; ?>"></div>
				<?php
				if ( ! empty( $cortex_images ) ) {
					foreach ( $cortex_images as $cortex_image ) :  ?>
						<div class="tile isotope-item <?php echo $cortex_columns; ?>">
							<figure class="img_container">
							<a href="<?php echo esc_url($cortex_image['url']); ?>" class="entry-link" title="<?php echo esc_html($cortex_image['caption']); ?>">
							<img src="<?php echo esc_url($cortex_image['sizes']['large']); ?>" alt="<?php echo esc_html($cortex_image['alt']); ?>"  data-no-retina /></a>
							</figure>
						</div>
						<?php endforeach;
				} //end if empty images
	?>
			</div>
		</div><!--end entry-content-gallery-grid-->
	<?php
		break;

		case 'inline':

	?>
		<div class="entry-content-gallery"><?php the_content(); ?></div>
		<div class="entry-content-inline">
			<?php
			if ( ! empty( $cortex_images ) ) {
				foreach ( $cortex_images as $cortex_image ) :  ?>
					<div class="entry-content-image">
					<img src="<?php echo esc_url($cortex_image['url']); ?>" alt="<?php echo esc_html($cortex_image['alt']); ?>" data-no-retina class="mar10B" />
					</div>
				<?php endforeach;
			} //endifempty
	?>
		</div><!--end of entry-content-->
	<?php
		break;

		case 'inline-text':
	?>
		<div class="entry-content-gallery"><?php the_content(); ?></div><!--end entry-content-gallery-->
		<div class="entry-content-inline-text mar20T">
			<?php
			if ( ! empty( $cortex_images ) ) {
				foreach ( $cortex_images as $cortex_image ) :  ?>
				<div class="entry-content-image">
					<img src="<?php echo esc_url($cortex_image['url']); ?>" alt="<?php echo esc_html($cortex_image['alt']); ?>" data-no-retina class="mar10B" />
					<p class="h6 mar30B"><?php echo esc_html($cortex_image['caption']); ?></p>
				</div>
				<?php endforeach;
			} //endifempty images
	?>
		</div><!--end of entry-content-->
		<?php
		break;
		case 'flex-slider':
	?>
		<div class="entry-content-gallery mar20B">
			<?php the_content(); ?>
		</div><!--end entry-content-gallery-->
		<?php
		break;
		default:
	?>
		<div class="entry-content-gallery">
			<?php the_content(); ?>
		</div>
		<?php
		break;

	}
?>
</div><!--end entry-content-->
<?php
}
?>
