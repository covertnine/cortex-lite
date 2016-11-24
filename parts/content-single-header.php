<?php
global $cortex_options;
$cortex_theme_options 		= $cortex_options;
$cortex_theme_style   		= $cortex_theme_options['c9-theme-style'];
$cortex_format    			= get_post_format();
$cortex_gallery_type  		= get_field( 'gallery_type' );
$cortex_enable_overlay 		= sanitize_html_class( get_field( 'enable_overlay' ) );
$cortex_heading_font_color  = sanitize_html_class( get_field( 'heading_font_color' ) );
$cortex_enable_big_header 	= get_field( 'c9_enable_big_header' );

if ( ($cortex_enable_big_header == 'enable') || ($cortex_enable_big_header == '') || ($cortex_enable_big_header == 'default') ) { //see if big header is enabled, if not skip it all


	//if enable overlay isn't set, set it to true by default
	if ( empty($cortex_enable_overlay) ) {$cortex_enable_overlay = 'default';}

	//overlay logic
	if ( $cortex_enable_overlay == 'default' ) {
		if ( has_post_thumbnail() ) {
			$cortex_enable_overlay = ' dark-overlay';
		} else {
			$cortex_enable_overlay = ' no-overlay';
		}
	} elseif ( $cortex_enable_overlay == 'dark-overlay' ) {
		$cortex_enable_overlay = ' dark-overlay';
	} else {
		$cortex_enable_overlay = ' no-overlay';
	}

	//if the heading font color hasn't been picked, set it to default
	if ( empty($cortex_heading_font_color) ) {$cortex_heading_font_color = 'default';}

	//heading font color logic
	if ( $cortex_heading_font_color == 'default' ) {

		if ( ($cortex_theme_style == 'light') && ( ! has_post_thumbnail() ) ) {
			$cortex_color_switch = ' dark-color-text';
		} else {
			if ( $cortex_gallery_type == 'flex-slider' ) {
				$cortex_color_switch = ' dark-color-text';
			} else {
				$cortex_color_switch = ' light-color-text';
			}
		}

	} elseif ( $cortex_heading_font_color == 'light-color-text' ) {
			$cortex_color_switch = ' light-color-text';
	} else {
			$cortex_color_switch = ' dark-color-text';
	}

	switch ( $cortex_format ) {
		case 'audio' :
			include( locate_template( 'parts/post-format-audio-header.php' ) );
		break;
		case 'video' :
			include( locate_template( 'parts/post-format-video-header.php' ) );
		break;
		case 'quote' :
			include( locate_template( 'parts/post-format-quote-header.php' ) );
		break;
		case 'gallery' :
			if ( $cortex_gallery_type == 'flex-slider' ) {
				include( locate_template( 'parts/post-format-gallery-flex.php' ) );
			} else {
				include( locate_template( 'parts/post-format-default-header.php' ) );
			}
		break;
		default :
			include( locate_template( 'parts/post-format-default-header.php' ) );
		break;
	}

} //big header is disabled, so don't show that big header ?>