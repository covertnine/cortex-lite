<?php
$cortex_video_embed_link      = get_field( 'video_link' );
?>
<header class="entry-header entry-header-default entry-header-video<?php if ( ! empty($cortex_enable_overlay) ) { echo $cortex_enable_overlay; } ?>">
	<div class="entry-header-standard-wrapper">
		<div class="entry-header-standard">
			<div class="entry-header-standard-inner" data--100-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="video">
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
									$cortex_video_embed_link = str_replace( 'frameborder="0"', '', $cortex_video_embed_link );


									// echo the new embed code
									echo $cortex_video_embed_link;


?>
								</div><!-- .embed-container-->
							</div><!--end video-->
							</div><!--end column-->
							<div class="col-xs-12 col-sm-6 col-md-6">
								<span class="h5 accent-color-text video-date"><?php cortex_posted_on(); ?></span>
								<h1 class="entry-title entry-video-title<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php the_title(); ?></h1>

								<div class="entry-meta">
									<?php cortex_author(); ?> / <?php cortex_post_categories(); ?>
								</div><!-- .entry-meta -->

								<div class="entry-share mar30T">
									<?php include( locate_template( 'inc/single-social.php' ) ); ?>
								</div>

						</div><!--end columns-->
					</div><!-- end .row-->
				</div><!--end container-->
			</div><!--end entry-header-standard-inner-->
		</div><!--end entry-header-standard-->
	</div><!--entry-header-standard-wrapper-->
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="entry-image" <?php if ( ! empty( $cortex_featured_header ) ) { echo 'style="background: url('.esc_url($cortex_featured_header[0]).') center fixed no-repeat; background-size: cover;"'; } ?>></figure>
	<?php } ?>
</header><!-- .entry-header -->
