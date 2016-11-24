<?php
// fields renamed to use below
$cortex_u_start     			 = get_field( 'date_and_time' );
$cortex_u_date      			 = date( 'l, F j, Y', strtotime($cortex_u_start) );
$cortex_u_featured_image   		 = get_the_post_thumbnail( get_the_id(), 'large', array( 'class' => 'center-block' ) );
$cortex_u_featured_image_link	 = wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ) );
$cortex_u_featured_image_bg  	 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'cortex-featured-header' );
$cortex_u_location_name   		 = get_field( 'location_name' );
$cortex_u_location_city_country  = get_field( 'location_city_country' );
$cortex_u_location_map_link  	 = esc_url( get_field( 'location_map_link' ) );
$cortex_u_event_ticket_link  	 = esc_url( get_field( 'event_ticket_link' ) );
$cortex_u_rsvp_link    			 = esc_url( get_field( 'rsvp_link' ) );
$cortex_show_next_event_featured = get_field( 'show_next_event_featured' );
$cortex_featured_image_display   = get_field( 'featured_image_display' );
$cortex_event_headline    		 = get_field( 'event_headline' );
$cortex_enable_overlay			 = get_field( 'enable_overlay' );
global $cortex_options;
$cortex_theme_options			 = $cortex_options;
$cortex_theme_style  			 = $cortex_theme_options['c9-theme-style'];

if ( ( empty( $cortex_featured_header ) ) && ( $cortex_theme_options['c9-theme-style'] == 'light') ) {$cortex_color_switch = ' dark-color-text';}

/*build the event post heading style */
if ( ! empty( $cortex_u_featured_image_bg ) ) {
	$cortex_heading_style    = 'style="';
	$cortex_heading_style   .= "background-image: url(".esc_url($cortex_u_featured_image_bg[0])."); background-repeat: no-repeat; background-size: cover; background-position: fixed;";
}

//if enable overlay isn't set, set it to true by default
if ( empty($cortex_enable_overlay) ) {$cortex_enable_overlay = 'default';}

//overlay logic
if ( $cortex_enable_overlay == 'default' ) {
	if ( ! empty($cortex_u_featured_image_bg) ) {
		$cortex_enable_overlay = ' dark-overlay';
	} else {
		$cortex_enable_overlay = ' no-overlay';
	}
} elseif ( $cortex_enable_overlay == 'dark-overlay' ) {
	$cortex_enable_overlay = ' dark-overlay';
} else {
	$cortex_enable_overlay = ' no-overlay';
}

?>
<header id="section-events-heading" class="events-page-header" data-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target="#section-events-heading">
	<div class="container">
		<div class="row">
			<?php if ( $cortex_show_next_event_featured == true ) { ?>
			<div class="events-header-featured-image col-xs-12<?php if ( $cortex_featured_image_display == 'alignright' ) { echo ' col-md-6 col-md-push-6';
} else { echo ' col-md-6';} ?>">
				<a href="<?php echo $cortex_u_featured_image_link; ?>" title="<?php the_title_attribute(); ?>" class="cortex-popup">
				<?php echo $cortex_u_featured_image; ?>
				</a>
			</div><!--end column-->
			<div class="col-xs-12<?php if ( $cortex_featured_image_display == 'alignright' ) { echo ' col-md-6 col-md-pull-6';
} else { echo ' col-md-6';} ?>">
			<?php } ?>
				<div class="events-header-text next-event">
					<?php if ( ! empty( $cortex_event_headline ) ) { ?><h1 class="h5 center secondary-font light<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php echo $cortex_event_headline;?></h1><?php } ?>
					<h3 class="h3 center subheading mar20T mar20B"><?php echo $cortex_u_location_name; ?></h3>

					<?php if ( ! empty( $cortex_u_location_city_country ) ) { ?>
					<h5 class="center mar30B secondary-font">
						<?php if ( ! empty( $cortex_u_date ) ) { ?><span class="u-date accent-color-text light"><?php echo $cortex_u_date; ?><span class="dot headline-color-text"> &middot; </span></span><?php } ?>
						<?php if ( ! empty( $cortex_u_location_map_link ) ) { ?><a href="<?php echo $cortex_u_location_map_link; ?>" target="_blank"><?php } ?>
						<span class="u_location"><?php echo $cortex_u_location_city_country;?></span>
						<?php if ( ! empty( $cortex_u_location_map_link ) ) { ?></a><?php } ?>
					</h5>
					<?php } ?>

					<?php if ( ( ! empty( $cortex_u_rsvp_link ) ) || ( ! empty( $cortex_u_event_ticket_link ) ) ) { ?>
					<div class="center u-event-buttons">
						<?php if ( ! empty( $cortex_u_rsvp_link ) ) { ?><div class="rsvp-link"><a class="btn btn-md btn-link" href="<?php echo $cortex_u_rsvp_link; ?>" target="_blank"><?php _e( 'RSVP', 'cortex' ); ?></a></div><?php } ?>
						<?php if ( ! empty( $cortex_u_event_ticket_link ) ) { ?><div class="event-link"><a class="btn btn-md btn-default" href="<?php echo $cortex_u_event_ticket_link; ?>" target="_blank"><?php _e( 'Get Tickets', 'cortex' ); ?></a></div><?php } ?>
					</div>
				<?php } ?>

				</div><!--end events-header-text next-event-->
			<?php if ( $cortex_show_next_event_featured == true ) { ?>
			</div><!--end column-->
			<?php } ?>
		</div><!--end row -->
	</div><!--end container-->
	<figure class="events-page-header-bg<?php if ( ! empty($cortex_enable_overlay) ) { echo $cortex_enable_overlay; } ?>" <?php if ( ! empty( $cortex_heading_style ) ) { echo $cortex_heading_style.'"'; } ?>></figure>
</header>
