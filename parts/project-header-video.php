<?php
$cortex_theme_style   = $cortex_theme_options['c9-theme-style'];

//switch the heading colors if it's a light theme and there's no background
if ( ( empty( $cortex_video_background_still_image ) ) && ( $cortex_theme_style == 'light') ) {
	$cortex_color_switch = ' dark-color-text';
} else {
	$cortex_color_switch = ' light-color-text';
}
?>
<header class="entry-header entry-header-default<?php if ( $cortex_project_header_type == 'video-background' ) { echo ' video-background'; } elseif ( $cortex_project_header_type == 'video' ) {echo ' video-hero'; } if  ($cortex_background_image_overlay == true ) { echo " dark-overlay"; } ?>">
	<?php if ( $cortex_project_header_type == 'video-background' ) { ?>
	<?php if ( $cortex_video_background_source == 'upload' ) { ?>

	<video id="cortex-video-bg" class="video-bg hidden-xs hidden-sm" autoplay muted loop>
		<?php if ( ! empty( $cortex_video_background_mp4_file ) ) { ?><source src="<?php echo $cortex_video_background_mp4_file; ?>" type="video/mp4"><?php } ?>
		<?php if ( ! empty( $cortex_video_background_ogg_file ) ) { ?><source src="<?php echo $cortex_video_background_ogg_file; ?>" type="video/ogg"><?php } ?>
		<?php if ( ! empty( $cortex_video_background_webm_file ) ) { ?><source src="<?php echo $cortex_video_background_webm_file; ?>" type="video/webm"><?php } ?>
	</video>

	<?php } elseif ( $cortex_video_background_source == 'link' ) { ?>

	<video id="cortex-video-bg" class="video-bg hidden-xs hidden-sm" autoplay muted loop>
		<?php if ( ! empty( $cortex_video_background_mp4_file_link ) ) { ?><source src="<?php echo $cortex_video_background_mp4_file_link; ?>" type="video/mp4"><?php } ?>
		<?php if ( ! empty( $cortex_video_background_ogg_file_link ) ) { ?><source src="<?php echo $cortex_video_background_ogg_file_link; ?>" type="video/ogg"><?php } ?>
		<?php if ( ! empty( $cortex_video_background_webm_file_link ) ) { ?><source src="<?php echo $cortex_video_background_webm_file_link; ?>" type="video/webm"><?php } ?>
	</video>

	<?php } elseif ( $cortex_video_background_source == 'embed' ) { ?>
	<div class="video-bg hidden-xs hidden-sm">
		<div class="embed-container">
			<div id="cortex-video-bg-embed"></div>
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
			        player = new YT.Player('cortex-video-bg-embed', {
				          playerVars: { 'autoplay': 1, 'controls': 0,'autohide':1,'wmode':'opaque','hd':1,'enablejsapi':1,'loop':1,'showinfo':0,'iv_load_policy':3,'rel':0, 'playlist': '<?php echo $cortex_video_background_embed; ?>' },
			          videoId: '<?php echo $cortex_video_background_embed; ?>',
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
	<?php } //end of "is this a video backgrond? header type ?>
	<?php if ( ! empty( $cortex_video_background_still_image ) ) { ?>
	<figure class="entry-image entry-video<?php if ( ( $cortex_background_image_overlay == true ) || ( $cortex_background_image_overlay != false ) ) { echo " dark-overlay"; } ?>" <?php if ( ! empty( $cortex_video_background_still_image ) ) { echo 'style="background: url('.esc_url($cortex_video_background_still_image).') center fixed no-repeat; background-size: cover;"';}?>></figure>
	<?php } ?>
	<?php if ( $cortex_project_header_type != 'video' ) { ?>
	<div class="entry-header-standard-wrapper">
		<div class="entry-header-standard">
			<div class="entry-header-standard-inner" data-100-top="opacity: 1" data--75-top="opacity: 0" data-anchor-target=".entry-header-standard-inner .container" <?php if ( $cortex_project_header_type == 'color-background' ) { echo 'style="background-color: '. $cortex_hero_background_color .';"'; } ?>>
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
	<?php } else { // the project header type is a hero video ?>
	<div class="entry-header-standard-wrapper">
		<div class="entry-header-standard">

			<div class="entry-header-standard-inner" data--100-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
				<div class="container">
					<div class="video">
						<div class="row">
							<div class="col-xs-12 col-md-7">
								<div class="embed-container">
									<?php
									// use preg_match to find iframe src
									preg_match( '/src="(.+?)"/', $cortex_video_embed_link, $matches );
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

									$cortex_video_embed_link = str_replace( $src, $new_src, $cortex_video_embed_link );


									// add extra attributes to iframe html
									$attributes = '';

									$cortex_video_embed_link = str_replace( '></iframe>', ' ' . $attributes . '></iframe>', $cortex_video_embed_link );

									// check for SSL and appropriately re-embed the iframe with the proper source being http or https
									if ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) {
										// ssl connection
										$cortex_video_embed_link = str_replace( 'http:', 'https:', $cortex_video_embed_link );
									} else {
										// non-ssl connection
										$cortex_video_embed_link = str_replace( 'https:', 'http:', $cortex_video_embed_link );
									}


									// echo the new embed code
									echo $cortex_video_embed_link;


?>
								</div><!-- .embed-container-->
							</div><!-- end column-->
							<div class="col-xs-12 col-md-5">

								<div id="section-project-header-text" class="content-project-header-text image-only">
									<h1 class="entry-title mar0T<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php echo $cortex_project_name; ?></h1>
									<span class="h5 accent-color-text"><?php echo $cortex_project_sub_heading; ?></span>
									<?php if ( ! empty( $cortex_video_embed_description ) ) { ?>
									<div class="video-description mar20T hidden-xs">
										<?php echo do_shortcode( $cortex_video_embed_description ); ?>
									</div>
									<?php } ?>
								</div>

							</div><!-- end column-->
						</div><!-- end .row-->
					</div><!-- end .video-->
				</div><!--end container-->
			</div><!-- end .entry-header-standard-inner -->


		</div><!--end entry-header-standard-->
	</div><!--entry-header-standard-wrapper-->
	<?php } //end of video hero header type ?>
</header><!-- .entry-header -->
