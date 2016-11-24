<?php
$cortex_hero_heading       						= get_sub_field( 'heading' );
$cortex_hero_sub_heading      					= get_sub_field( 'sub_heading' );
$cortex_hero_description      					= get_sub_field( 'description' );
$cortex_hero_heroHeight      					= get_sub_field( 'hero_height' );
$cortex_hero_backgroundType     				= get_sub_field( 'hero_background_type' );
$cortex_hero_backgroundColor     				= get_sub_field( 'hero_background_color' );
$cortex_hero_backgroundImage     				= esc_url( get_sub_field( 'hero_background_image' ) );
$cortex_hero_backgroundPattern     				= esc_url( get_sub_field( 'hero_background_pattern' ) );
$cortex_hero_backgroundRepeat     				= get_sub_field( 'hero_pattern_repeat' );

/* video bg variables*/
$cortex_hero_video_background_source   			= get_sub_field( 'video_background_source' );
$cortex_hero_video_background_embed   			= get_sub_field( 'video_background_embed' );
$cortex_hero_video_background_still_image  		= esc_url( get_sub_field( 'video_background_still_image' ) );
$cortex_hero_video_background_mp4_file    		= esc_url( get_sub_field( 'video_background_mp4_file' ) );
$cortex_hero_video_background_mp4_file_link 	= esc_url( get_sub_field( 'video_background_mp4_file_link' ) );
$cortex_hero_video_background_webm_file  		= esc_url( get_sub_field( 'video_background_webm_file' ) );
$cortex_hero_video_background_webm_file_link 	= esc_url( get_sub_field( 'video_background_webm_file_link' ) );
$cortex_hero_video_background_ogg_file   		= esc_url( get_sub_field( 'video_background_ogg_file' ) );
$cortex_hero_video_background_ogg_file_link 	= esc_url( get_sub_field( 'video_background_ogg_file_link' ) );
$cortex_hero_display_overlay     				= get_sub_field( 'display_overlay' );

/*additional hero content */
$cortex_hero_content       						= get_sub_field( 'hero_content' );
$cortex_hero_wp_editor       					= get_sub_field( 'hero_wp_editor' );
$cortex_hero_video_embed_link     				= get_sub_field( 'video_embed_link' );
$cortex_hero_gallery_photos     				= get_sub_field( 'gallery_photos' );
$cortex_hero_content_image      				= get_sub_field( 'hero_content_image' );
$cortex_hero_content_align      				= get_sub_field( 'hero_content_align' );

$cortex_customClass       						= esc_html( get_sub_field( 'custom_class' ) );

/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
if ( $cortex_hero_backgroundType !== 'none' ) {
	$cortex_hero_bg_style    = 'style="';
}
if ( ($cortex_hero_backgroundColor != '' ) && ( $cortex_hero_backgroundType == 'hero-color-background' ) ) {
	$cortex_hero_bg_style  .= "background-color: $cortex_hero_backgroundColor; ";
}
if ( ( $cortex_hero_backgroundImage != '' ) && ( $cortex_hero_backgroundType == 'hero-image-background' ) ) {
	$cortex_hero_bg_style  .= "background-color: $cortex_hero_backgroundColor; ";
	$cortex_hero_bg_style  .= "background: url($cortex_hero_backgroundImage) center fixed no-repeat; background-size: cover; position: relative; top: 0; left: 0; transform: none; -webkit-transform: none;";
}
if ( ( $cortex_hero_backgroundPattern != '' ) && ( $cortex_hero_backgroundType == 'hero-pattern-background' ) ) {
	$cortex_hero_bg_style  .= "background-color: transparent; ";
	$cortex_hero_bg_style  .= "background: $cortex_hero_backgroundColor url($cortex_hero_backgroundPattern); background-repeat: $cortex_hero_backgroundRepeat;";
}
?>
<section id="section-<?php echo $cortex_counter; ?>" class="hero_builder<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="container-fluid">
	<div class="hero-holder<?php if ( $cortex_hero_backgroundType == 'hero-pattern-background' ) { echo " hero-pattern-bg"; } if ( ! empty( $cortex_hero_heroHeight ) ) { echo ' ' . $cortex_hero_heroHeight; } ?>">


		<?php if ( $cortex_hero_backgroundType == 'hero-video-background' ) { ?>
		<div class="video-holder">
		<?php if ( $cortex_hero_video_background_source == 'upload' ) { ?>

		<video id="cortex-video-bg" class="video-bg hidden-xs hidden-sm" autoplay muted loop>
			<?php if ( ! empty( $cortex_hero_video_background_mp4_file ) ) { ?><source src="<?php echo $cortex_hero_video_background_mp4_file; ?>" type="video/mp4"><?php } ?>
			<?php if ( ! empty( $cortex_hero_video_background_ogg_file ) ) { ?><source src="<?php echo $cortex_hero_video_background_ogg_file; ?>" type="video/ogg"><?php } ?>
			<?php if ( ! empty( $cortex_hero_video_background_webm_file ) ) { ?><source src="<?php echo $cortex_hero_video_background_webm_file; ?>" type="video/webm"><?php } ?>
		</video>

		<?php } elseif ( $cortex_hero_video_background_source == 'link' ) { ?>

		<video id="cortex-video-bg" class="video-bg hidden-xs hidden-sm" autoplay muted loop>
			<?php if ( ! empty( $cortex_hero_video_background_mp4_file_link ) ) { ?><source src="<?php echo $cortex_hero_video_background_mp4_file_link; ?>" type="video/mp4"><?php } ?>
			<?php if ( ! empty( $cortex_hero_video_background_ogg_file_link ) ) { ?><source src="<?php echo $cortex_hero_video_background_ogg_file_link; ?>" type="video/ogg"><?php } ?>
			<?php if ( ! empty( $cortex_hero_video_background_webm_file_link ) ) { ?><source src="<?php echo $cortex_hero_video_background_webm_file_link; ?>" type="video/webm"><?php } ?>
		</video>

		<?php } elseif ( $cortex_hero_video_background_source == 'embed' ) { ?>
		<div class="video-bg hidden-xs hidden-sm">
			<div class="embed-container">
				<div id="cortex-video-bg"></div>
					<script>      // 2. This code loads the IFrame Player API code asynchronously.
				      var tag = document.createElement('script');
					  if (window.location.protocol != "https:") {
				      	tag.src = "http://www.youtube.com/player_api";
				      } else {
						tag.src = "https://www.youtube.com/player_api";
				      }
				      var firstScriptTag = document.getElementsByTagName('script')[0];
				      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

				      // 3. This function creates an <iframe> (and YouTube player)
				      //    after the API code downloads.
				      var player;
				      function onYouTubePlayerAPIReady() {
				        player = new YT.Player('cortex-video-bg', {
				          playerVars: { 'autoplay': 1, 'controls': 0,'autohide':1,'wmode':'opaque','hd':1,'enablejsapi':1,'loop':1,'showinfo':0,'iv_load_policy':3,'rel':0, 'playlist': '<?php echo $cortex_hero_video_background_embed; ?>' },
				          videoId: '<?php echo $cortex_hero_video_background_embed; ?>',
				          events: {
				            'onReady': onPlayerReady}
				        });
				      }

				      // 4. The API will call this function when the video player is ready.
				      function onPlayerReady(event) {
				        event.target.mute();
				      }
				</script>
			</div>
		</div>
		<?php } //end checking video background type ?>
		<div class="video-bg-fallback visible-sm-block visible-xs-block"<?php if ( ! empty( $cortex_hero_video_background_still_image ) ) { echo ' style="background: transparent url('. $cortex_hero_video_background_still_image .') center fixed no-repeat; background-size: cover;"';} ?>></div><!--end of still image fallback-->
		</div><!--end video holder-->
		<?php } //end of "is this a video backgrond? header type ?>

		<div class="hero-inner<?php if ( $cortex_hero_display_overlay == true ) { echo ' dark-overlay'; }?>">
		<div class="hero center">
			<div class="inner">
				<div class="container" data-100-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target="#section-<?php echo $cortex_counter; ?> .container">
					<div class="row">

						<?php if ( $cortex_hero_content != 'none' ) { ?>
						<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6<?php if ( $cortex_hero_content_align == 'alignright' ) { echo ' col-md-push-6 '; } ?> col-md-offset-0">
							<div class="hero-inner-holder">
							<?php
	switch ( $cortex_hero_content ) {

	case 'flex-slider':
?>

							<?php if ( $cortex_hero_gallery_photos ) { ?>
							<div class="hero-content">
							<div class="flexslider">
							  <ul class="slides">
								<?php foreach ( $cortex_hero_gallery_photos as $cortex_image ) :  ?>
							    <li class="img_container">
							    	<a href="<?php echo esc_url( $cortex_image['url'] ); ?>">
										<img src="<?php echo esc_url( $cortex_image['sizes']['large'] ); ?>" alt="<?php echo esc_html( $cortex_image['alt'] ); ?>" data-no-retina />
							    	</a>
							    </li>
								<?php endforeach; ?>
							  </ul>
							</div>
							</div><!--end hero-content-->
							<?php
		}


		break;
	case 'video':
?>
							<div class="hero-content-video">
							<div class="embed-container">
								<?php
		// use preg_match to find iframe src
		preg_match( '/src="(.+?)"/', $cortex_hero_video_embed_link, $matches );
		$src = $matches[1];


		// add extra params to iframe src
		$params = array(
			'controls'       => 1,
			'hd'             => 1,
			'rel'       => 0,
			'iv_load_policy'  => 3,
			'modestbranding'  => 1,
			'showinfo'    => 0,
			'autohide'      => 1,
			'byline'    => 0,
			'portrait'    => 0,
			'title'     => 0,
		);

		$new_src = add_query_arg( $params, $src );

		$cortex_hero_video_embed_link = str_replace( $src, $new_src, $cortex_hero_video_embed_link );


		// add extra attributes to iframe html
		$attributes = '';

		$cortex_hero_video_embed_link = str_replace( '></iframe>', ' ' . $attributes . '></iframe>', $cortex_hero_video_embed_link );

		// check for SSL and appropriately re-embed the iframe with the proper source being http or https
		if ( ( ! empty( $_SERVER['HTTPS'] ) ) && ( $_SERVER['HTTPS'] != 'off' ) ) {

			// ssl connection
			$cortex_hero_video_embed_link = str_replace( 'http:', 'https:', $cortex_hero_video_embed_link );

		} else {

			// non-ssl connection
			$cortex_hero_video_embed_link = str_replace( 'https:', 'http:', $cortex_hero_video_embed_link );

		}

		// echo the new embed code
		echo $cortex_hero_video_embed_link;

?>
							</div><!-- .embed-container-->
							</div><!-- .hero-content-->
							<?php

		break;
	case 'hero-image':

?>
								<div class="hero-content">
								<?php if ( ! empty( $cortex_hero_content_image ) ) { ?><img src="<?php echo $cortex_hero_content_image['url']; ?>" alt="<?php echo $cortex_hero_content_image['alt']; ?>" class="img-responsive center" data-no-retina /><?php } else { esc_html_e( 'You must set a hero image', 'cortex' ); } ?>
								</div><!--.hero-content-->
							<?php
		break;
	case 'wp-editor':
?>
								<div class="hero-content">
								<div class="hero-wp-editor entry-content text-left">
									<?php echo $cortex_hero_wp_editor; ?>
								</div>
								</div><!--.hero-content-->
								<?php
		break;
	}
?>
							</div><!--end hero-inner-holder-->
						</div><!--end column-->
						<?php } ?>

						<div class="col-xs-12<?php if ( $cortex_hero_content == 'none' ) { echo ' col-sm-12 col-md-12'; } else { echo ' col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0'; } ?><?php if ( ($cortex_hero_content != 'none') && ($cortex_hero_content_align == 'alignright') ) { echo ' col-md-pull-6'; } ?>">
							<div class="entry-header entry-header-page mar30B hero-builder-header">
								<div class="entry-header-standard-wrapper center">
									<div class="entry-header-standard">
										<div class="entry-header-standard-inner">
											<div class="heading<?php if ( ($cortex_counter == 0) && ($GLOBALS['cortex_navigation_type'] == "nav1") ) { echo ' pulldown'; } //pulls content down slightly to accommodate nav ?>">
											<?php if ( ! empty( $cortex_hero_heading ) ) { ?><span class="h2 headine-font entry-title hero-title center"><?php echo $cortex_hero_heading; ?></span><?php } ?>
											<?php if ( ! empty( $cortex_hero_sub_heading ) ) { ?><span class="secondary-font accent-color-text hero-sub-title center mar10T mar15B"><?php echo $cortex_hero_sub_heading; ?></span><?php } ?>
											<?php if ( ! empty( $cortex_hero_description ) ) { ?><div class="hero-description entry-content"><?php echo $cortex_hero_description; ?></div><?php } ?>
											</div><!--end heading-->
										</div><!--end entry-header-standard-inner-->
									</div><!--end entry-header-standard-->
								</div><!--entry-header-standard-wrapper-->
							</div><!--end of basic hero content-->
						</div><!--end of column-->

					</div><!--end row-->
				</div><!--end container-->
			</div><!--end inner-->

		<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!--end hero-->
	</div><!--end hero-inner-->


		<?php if ( ($cortex_hero_backgroundType == 'hero-video-background') && ( ! empty( $cortex_hero_video_background_still_image ) ) ) { ?>
		<figure class="hero-bg entry-image entry-video" <?php if ( ! empty( $cortex_hero_bg_style ) ) { echo $cortex_hero_bg_style. '"'; } ?>>
		</figure>
		<?php } ?>

		<?php if ( ( $cortex_hero_backgroundType != 'none' ) && ( $cortex_hero_backgroundType != 'hero-video-background' ) ) { ?>
		<figure class="hero-bg entry-image" <?php if ( ! empty( $cortex_hero_bg_style ) ) { echo $cortex_hero_bg_style. '"'; } ?>>
		</figure>
		<?php } ?>

	</div><!--end hero holder-->
	<div class="clearfix"></div>
	</div><!--end container-fluid-->
</section><!-- #section-## -->

<?php $cortex_counter++;
unset( $cortex_hero_bg_style, $cortex_hero_backgroundImage, $cortex_hero_backgroundColor, $cortex_hero_backgroundPattern, $cortex_hero_backgroundRepeat, $cortex_hero_heading, $cortex_hero_sub_heading, $cortex_hero_description, $cortex_hero_heroHeight, $cortex_hero_video_background_source, $cortex_hero_video_background_embed, $cortex_hero_video_background_still_image, $cortex_hero_video_background_mp4_file, $cortex_hero_video_background_mp4_file_link, $cortex_hero_video_background_webm_file, $cortex_hero_video_background_webm_file_link, $cortex_hero_video_background_ogg_file, $cortex_hero_video_background_ogg_file_link, $cortex_hero_content, $cortex_hero_wp_editor, $cortex_hero_video_embed_link, $cortex_hero_gallery_photos, $cortex_hero_content_image, $cortex_hero_content_align, $cortex_customClass ); ?>
