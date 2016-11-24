<?php
$cortex_project_header_type   			 = get_field( 'project_hero_heading_type' );
$cortex_hero_background_color   		 = get_field( 'hero_background_color' );
$cortex_project_name     				 = get_field( 'project_name' );
$cortex_project_sub_heading   			 = get_field( 'project_sub_heading' );
$cortex_hero_background_color   		 = get_field( 'hero_background_color' );
$cortex_video_embed_link   				 = get_field( 'video_embed_link' );
$cortex_video_embed_description 		 = get_field( 'video_embed_description' );
$cortex_video_background_source 		 = get_field( 'video_background_source' );
$cortex_video_background_embed   		 = get_field( 'video_background_embed' );
$cortex_video_background_still_image	 = get_field( 'video_background_still_image' );
$cortex_background_image_overlay		 = get_field( 'background_image_overlay' );
$cortex_video_background_mp4_file  		 = esc_url( get_field( 'video_background_mp4_file' ) );
$cortex_video_background_mp4_file_link	 = esc_url( get_field( 'video_background_mp4_file_link' ) );
$cortex_video_background_webm_file 		 = esc_url( get_field( 'video_background_webm_file' ) );
$cortex_video_background_webm_file_link	 = esc_url( get_field( 'video_background_webm_file_link' ) );
$cortex_video_background_ogg_file 		 = esc_url( get_field( 'video_background_ogg_file' ) );
$cortex_video_background_ogg_file_link	 = esc_url( get_field( 'video_background_ogg_file_link' ) );
$cortex_revolution_slider   			 = get_field( 'revolution_slider' );
$cortex_gallery_photos    				 = get_field( 'gallery_photos' );
$cortex_featured_header   				 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'cortex-featured-header' );

switch ( $cortex_project_header_type ) {
	case 'image-background' :
		include( locate_template( 'parts/project-header-default.php' ) );
	break;
	case 'image-only' :
		include( locate_template( 'parts/project-header-default.php' ) );
	break;
	case 'color-background' :
		include( locate_template( 'parts/project-header-default.php' ) );
	break;
	case 'video-background' :
		include( locate_template( 'parts/project-header-video.php' ) );
	break;
	case 'flex-slider' :
		include( locate_template( 'parts/project-header-flex-slider.php' ) );
	break;
	case 'video' :
		include( locate_template( 'parts/project-header-video.php' ) );
	break;
	case 'revolution-slider':
		include( locate_template( 'parts/project-header-revolution.php' ) );
	break;
	default :
		include( locate_template( 'parts/project-header-default.php' ) );
	break;
} ?>
