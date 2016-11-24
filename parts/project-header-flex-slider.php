<?php
$cortex_images      = get_field( 'gallery_photos' );
$cortex_theme_style   = $cortex_theme_options['c9-theme-style'];

//switch the heading colors if it's a light theme and there's no background
if ( ( empty( $cortex_video_background_still_image ) ) && ( $cortex_theme_style == 'light') ) {
	$cortex_color_switch = ' dark-color-text';
} else {
	$cortex_color_switch = ' accent-color-text';
}
?>
	<header class="entry-header entry-header-default entry-header-flex-gallery<?php if ( ( $cortex_background_image_overlay == true ) || ( $cortex_background_image_overlay != false ) ) { echo " dark-overlay"; } ?>">
		<?php if ( ! empty( $cortex_video_background_still_image ) ) { ?>
		<figure class="entry-image" <?php echo 'style="background: url('.esc_url($cortex_video_background_still_image).') center fixed no-repeat; background-size: cover;"'; ?>></figure>
		<?php } ?>
		<div class="entry-header-standard-wrapper">
			<div class="entry-header-standard">
				<div class="entry-header-standard-inner" data--100-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
					<div class="container">
						<?php if ( $cortex_images ) { ?>

						<div class="flexslider">
						  <ul class="slides">
							<?php foreach ( $cortex_images as $cortex_image ) :  ?>
						    <li class="img_container">
						    	<a href="<?php echo esc_url($cortex_image['url']); ?>">
									<img src="<?php echo esc_url($cortex_image['sizes']['large']); ?>" alt="<?php echo esc_html($cortex_image['alt']); ?>" data-no-retina />
						    	</a>
						    </li>
							<?php endforeach; ?>
						  </ul>
						</div>

						<?php } ?>

						<h1 class="entry-title h3<?php if ( ! empty($cortex_color_switch) ) { echo $cortex_color_switch; } ?>"><?php echo $cortex_project_name; ?></h1>
						<span class="h5<?php if ( ! empty($cortex_color_switch) ) { echo $cortex_color_switch; } ?>"><?php echo $cortex_project_sub_heading; ?></span>
					</div><!--end container-->
				</div><!--end entry-header-standard-inner-->
			</div><!--end entry-header-standard-->
		</div><!--entry-header-standard-wrapper-->
	</header><!-- .entry-header -->
