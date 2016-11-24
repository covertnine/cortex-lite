<div class="row">
	<header class="entry-header entry-header-default<?php if ( $cortex_project_header_type == 'image-only' ) { echo ' image-only'; } ?>">
		<?php if ( ( ! empty($cortex_video_background_still_image) ) && ($cortex_project_header_type != 'color-background') ) { ?>
		<figure class="entry-image<?php if ( ( $cortex_background_image_overlay == true ) || ( $cortex_background_image_overlay != false ) ) { echo " dark-overlay"; } ?>" <?php if ( ! empty( $cortex_video_background_still_image ) ) { echo 'style="background: url('.esc_url($cortex_video_background_still_image).') center fixed no-repeat; background-size: cover;"'; } ?>></figure>
		<?php } ?>
		<?php if ( $cortex_project_header_type != 'image-only' ) { ?>
		<div class="entry-header-standard-wrapper">
			<div class="entry-header-standard">
				<div class="entry-header-standard-inner" data-100-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header .entry-header-standard" <?php if ( $cortex_project_header_type == 'color-background' ) { echo 'style="background-color: '. $cortex_hero_background_color .';"'; } ?>>
					<div class="container">
						<h1 class="entry-title"><?php echo $cortex_project_name; ?></h1>
						<span class="h5 accent-color-text"><?php echo $cortex_project_sub_heading; ?></span>
						<div class="entry-meta">
							<?php cortex_post_categories(); ?>
						</div><!-- .entry-meta -->
					</div><!--end container-->
				</div><!--end entry-header-standard-inner-->
			</div><!--end entry-header-standard-->
		</div><!--entry-header-standard-wrapper-->
		<?php } ?>
	</header><!-- .entry-header -->
</div>

<?php if ( $cortex_project_header_type == 'image-only' ) { ?>
<div class="row">
	<div id="section-project-header-text" class="content-project-header-text image-only">
		<h1 class="entry-title"><?php echo $cortex_project_name; ?></h1>
		<hr>
		<span class="h5 accent-color-text"><?php echo $cortex_project_sub_heading; ?></span>
	</div>
</div>
<?php } ?>
