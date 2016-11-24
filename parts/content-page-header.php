<?php
global $cortex_options;
$cortex_theme_options 		= $cortex_options;
$cortex_theme_style   		= $cortex_theme_options['c9-theme-style'];
$cortex_enable_overlay 		= sanitize_html_class( get_field( 'enable_overlay' ) );
$cortex_heading_font_color  = sanitize_html_class( get_field( 'heading_font_color' ) );
$cortex_enable_big_header 	= get_field( 'c9_enable_big_header' );


if ( ($cortex_enable_big_header == 'enable') || (!empty($cortex_enable_big_header)) ) { //see if big header is enabled, if not skip it all


	//if enable overlay isn't set, set it to true by default
	if ( empty($cortex_enable_overlay) ) {$cortex_enable_overlay = 'default';}

	//overlay logic
	if ($cortex_enable_overlay == 'default' ) {
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
			$cortex_color_switch = ' light-color-text';
		}

	} elseif ( $cortex_heading_font_color == 'light-color-text' ) {
			$cortex_color_switch = ' light-color-text';
	} else {
			$cortex_color_switch = ' dark-color-text';
	}
	?>
	<header class="entry-header entry-header-page mar20B<?php if ( ! empty($cortex_enable_overlay) ) { echo $cortex_enable_overlay; } ?>">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="entry-image" <?php if ( ! empty( $cortex_featured_header ) ) { echo 'style="background: url('.esc_url($cortex_featured_header[0]).') center fixed no-repeat; background-size: cover;"'; } ?>></figure>
		<?php } ?>
		<div class="entry-header-standard-wrapper">
			<div class="entry-header-standard">
				<div class="entry-header-standard-inner" data-130-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
					<div class="container">
						<h1 class="entry-title<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php the_title(); ?></h1>
					</div><!--end container-->
				</div><!--end entry-header-standard-inner-->
			</div><!--end entry-header-standard-->
		</div><!--entry-header-standard-wrapper-->
	</header><!-- .entry-header -->

<?php
} //end checking for big header
?>