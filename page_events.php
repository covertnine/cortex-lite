<?php
/**
 * Template Name: Events Page
 *
 * @package cortex
 */

get_header();

?>
	<div id="primary" class="content-area page-content page-events<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

					// get page options
					$cortex_customBackground    		= get_field( 'custom_background' );
					$cortex_backgroundColor     		= get_field( 'background_color' );
					$cortex_backgroundImage     		= esc_url( get_field( 'background_image' ) );
					$cortex_backgroundPattern    		= esc_url( get_field( 'background_pattern' ) );
					$cortex_backgroundRepeat    		= get_field( 'background_pattern_repeat' );
					$cortex_backgroundParallax    		= get_field( 'background_image_parallax' );
					$cortex_events_display_type   		= get_field( 'events_display_type' );
					$cortex_limit_by_category    		= get_field( 'limit_by_category' ); // for the single upcoming event at top
					$cortex_limit_by_category_listing   = get_field( 'limit_by_category' ); // for the full listing
					$cortex_upcoming_events_heading   	= get_field( 'upcoming_events_heading' );
					$cortex_show_past_events    		= get_field( 'show_past_events' );
					$cortex_past_events_heading   		= get_field( 'past_events_heading' );

					// get page header options
					$cortex_events_page_header_type     = get_field( 'events_page_header_type' );
					$cortex_next_event_heading        	= get_field( 'next_event_heading' );
					$cortex_show_next_event_featured    = get_field( 'show_next_event_featured_image' );
					$cortex_featured_image_display      = get_field( 'featured_image_display' );
					$cortex_events_page_heading      	= get_field( 'events_page_heading' );
					$cortex_events_page_sub_heading     = get_field( 'events_page_sub_heading' );
					$cortex_heading_backgroundImage     = esc_url( get_field( 'heading_background_image' ) );
					$cortex_heading_backgroundColor     = get_field( 'heading_background_color' );
					$cortex_heading_backgroundPattern   = esc_url( get_field( 'heading_background_pattern' ) );
					$cortex_heading_backgroundRepeat    = get_field( 'heading_background_pattern_repeat' );

					/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
					if ( $cortex_customBackground != 'none' ) {

						$cortex_style    = 'style="';

						if ( $cortex_backgroundColor != '' ) {
							$cortex_style  .= "background-color: $cortex_backgroundColor; ";
						}
						if ( $cortex_backgroundImage != '' ) {
							$cortex_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat;";
						}
						if ( $cortex_backgroundPattern != '' ) {
							$cortex_style  .= "background-image: url($cortex_backgroundPattern); background-repeat: $cortex_backgroundRepeat;";
						}
					}
			?>

			<section id="section-events" class="event-listing">
				<div class="section-bg"<?php if ( $cortex_backgroundParallax == 'yes' ) { echo ' data-bottom-top="background-position: 0% 0%;" data-top-bottom="background-position: 0% -200%;" data-anchor-target="#section-events"'; } ?><?php if ( ! empty( $cortex_style ) ) { echo ' '.$cortex_style.'"'; } ?>>

				<?php
					/*check for page heading options */
				if ( ! empty( $cortex_events_page_header_type ) ) {
					$cortex_heading_style    = 'style="';
				}
				if ( ($cortex_heading_backgroundColor != '') && ($cortex_events_page_header_type == 'background-color') ) {
					$cortex_heading_style  .= "background-color: $cortex_heading_backgroundColor; ";
				}
				if ( ($cortex_heading_backgroundColor != '') && ($cortex_events_page_header_type == 'background-pattern') ) {
					$cortex_heading_style  .= "background-color: $cortex_heading_backgroundColor; ";
				}
				if ( ($cortex_heading_backgroundPattern != '') && ($cortex_events_page_header_type == 'background-pattern') ) {
					$cortex_heading_style  .= "background-image: url($cortex_heading_backgroundPattern); background-repeat: $cortex_heading_backgroundRepeat;";
				}
				if ( ($cortex_heading_backgroundImage != '') && ($cortex_events_page_header_type == 'background-image-text') ) {
					$cortex_heading_style   .= "background-image: url($cortex_heading_backgroundImage); background-size: cover; background-repeat: no-repeat;";
				}
				if ( ($cortex_heading_backgroundImage != '') && ($cortex_events_page_header_type == 'background-image') ) {
					$cortex_heading_style   .= "background-image: url($cortex_heading_backgroundImage); background-size: cover; background-repeat: no-repeat;";
				}
				if ( ($cortex_heading_backgroundImage != '') && ($cortex_events_page_header_type == 'background-next-event') ) {
					$cortex_heading_style   .= "background-image: url($cortex_heading_backgroundImage); background-size: cover; background-repeat: no-repeat;";
				}

				if ( $cortex_events_page_header_type == 'background-next-event' ) { // the heading is made up of fields from the next upcoming event
					$cortex_time = current_time( 'timestamp' );

					// WP_Query arguments
					if ( empty( $cortex_limit_by_category ) ) { // query all events
						$args = array(
							'post_type'              => 'event',
							'post_status'            => 'publish', // only show published events
							'orderby'                => 'meta_value', // order by date
							'meta_key'               => 'date_and_time', // your ACF Date & Time Picker field
							'meta_value'             => $cortex_time, // Use the current time from above
							'meta_compare'           => '>=', // Compare today's datetime with our event datetime
							'order'                  => 'ASC', // Show earlier events first
							'posts_per_page'   => 1,
						);
					} else { // a specific category is needed

						$args = array(
							'post_type'              => 'event',
							'tax_query' => array(
								array(
						'taxonomy' => 'events-category',
						'terms'  => $cortex_limit_by_category,
								),
							),
							'post_status'            => 'publish', // only show published events
							'orderby'                => 'meta_value', // order by date
							'meta_key'               => 'date_and_time', // your ACF Date & Time Picker field
							'meta_value'             => $cortex_time, // Use the current time from above
							'meta_compare'           => '>=', // Compare today's datetime with our event datetime
							'order'                  => 'ASC', // Show earlier events first
							'posts_per_page'   => 1,
						);
					}

						// The Query for the next upcoming event
						$cortex_query = new WP_Query( $args );

					if ( $cortex_query->have_posts() ) {
						while ( $cortex_query->have_posts() ) {
							$cortex_query->the_post();

							// fields renamed to use below
							$cortex_u_start      			= get_field( 'date_and_time' );
							$cortex_u_date       			= get_field( 'date_and_time' );
							$cortex_u_featured_image    	= get_the_post_thumbnail( get_the_id(), 'featured', array( 'class' => 'center-block' ) );
							$cortex_u_location_name   		= get_field( 'location_name' );
							$cortex_u_location_city_country = get_field( 'location_city_country' );
							$cortex_u_location_map_link   	= esc_url( get_field( 'location_map_link' ) );
							$cortex_u_event_ticket_link   	= esc_url( get_field( 'event_ticket_link' ) );
							$cortex_u_rsvp_link     		= esc_url( get_field( 'rsvp_link' ) );
			?>

			<header id="section-events-heading" class="events-page-header" data-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target="#section-events-heading">
				<div class="container">
					<div class="row wow animated fadeInUp">
						<?php if ( $cortex_show_next_event_featured == true ) { ?>
							<div class="events-header-featured-image col-xs-12<?php if ( $cortex_featured_image_display == 'alignright' ) { echo ' col-md-6 col-md-push-6';
} else { echo ' col-md-6';} ?>">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $cortex_u_featured_image; ?></a>
							</div><!--end column-->
							<div class="col-xs-12<?php if ( $cortex_featured_image_display == 'alignright' ) { echo ' col-md-6 col-md-pull-6';
} else { echo ' col-md-6';} ?>">
							<?php } ?>
							<div class="events-header-text next-event">
								<?php if ( ! empty( $cortex_next_event_heading ) ) { ?><h5 class="center secondary-font light"><?php echo $cortex_next_event_heading;?></h5><?php } ?>

								<h1 class="h3 center subheading mar20T mar20B"><?php echo $cortex_u_location_name; ?></h1>

								<?php if ( ! empty( $cortex_u_location_city_country ) ) { ?>
									<h5 class="center mar30B secondary-font">
										<?php if ( ! empty( $cortex_u_date ) ) { ?><span class="u-date accent-color-text light"><?php echo $cortex_u_date; ?><span class="dot headline-color-text"> &middot; </span></span><?php } ?>
										<?php if ( ! empty( $cortex_u_location_map_link ) ) { ?><a href="<?php echo $cortex_u_location_map_link; ?>" target="_blank"><?php } ?>
										<span class="u_location secondary-color-text light"><?php echo $cortex_u_location_city_country;?></span>
										<?php if ( ! empty( $cortex_u_location_map_link ) ) { ?></a><?php } ?>
									</h5>
										<div class="center u-event-buttons">
											<?php if ( ! empty( $cortex_u_rsvp_link ) ) { ?><div class="rsvp-link"><a class="btn btn-md btn-link" href="<?php echo $cortex_u_rsvp_link; ?>" target="_blank"><?php _e( 'RSVP', 'cortex' ); ?></a></div><?php } ?>
											<?php if ( ! empty( $cortex_u_event_ticket_link ) ) { ?><div class="event-link"><a class="btn btn-md btn-default" href="<?php echo $cortex_u_event_ticket_link; ?>" target="_blank"><?php _e( 'Get Tickets', 'cortex' ); ?></a></div><?php } ?>
											<div class="event-details"><a class="btn btn-md btn-primary" href="<?php the_permalink(); ?>"><?php _e( 'Details', 'cortex' ); ?></a></div>
										</div>
									<?php } ?>

							</div>
							<?php if ( $cortex_show_next_event_featured == true ) { ?>
							</div><!--end column-->
							<?php } ?>
						</div><!--end row -->
					</div><!--end container-->
					<figure class="events-page-header-bg dark-overlay" <?php if ( ! empty( $cortex_heading_style ) ) { echo $cortex_heading_style.'"'; } ?>></figure>
				</header>

					<?php
						} //end of next upcoming event loop
						wp_reset_postdata();
					} else { // no upcoming events
			?>
				<header id="section-events-heading" class="events-page-header" data-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target="#section-events-heading">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<p><?php
									_e( 'No upcoming events at this time', 'cortex' );
							?></p>
							</div>
							</div>
								</div>
							</header>
							<?php } //end of no events found ?>
				<?php } else { // the heading for the page is not the next upcoming event ?>

				<header id="section-events-heading" class="events-page-header<?php echo ' '.$GLOBALS['cortex_navigation_type']; ?>" data-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target="#section-events-heading">
					<?php if ( $cortex_events_page_header_type != 'background-image' ) { // heading is not just an image so show the header text ?>
					<div class="events-header-text">
						<h1 class="center mar30B"><?php if ( ! empty( $cortex_events_page_heading ) ) { echo $cortex_events_page_heading ;
} else { the_title(); } ?></h1>

						<?php if ( ! empty( $cortex_events_page_sub_heading ) ) { echo '<hr /><h2 class="h5 center subheading mar30T"><span class="secondary-font light">' . $cortex_events_page_sub_heading . '</span></h2>';} ?>
					</div>
					<?php } else { ?>
						<div class="events-page-header-spacer">
							<span class="hide"></span>
						</div>
					<?php } ?>
					<figure class="events-page-header-bg<?php if ( $cortex_events_page_header_type == 'background-image-text' ) { echo ' dark-overlay'; } ?>" <?php if ( ! empty( $cortex_heading_style ) ) { echo $cortex_heading_style.'"'; } ?>></figure>
				</header>

				<?php } //end of event header choices ?>

					<div class="container">

					<div class="events-content"><?php the_content(); ?></div>

					<?php
				} //endwhile
			} //end of events page loop, next up comes the events listing with some options
			wp_reset_postdata();


			$cortex_time = current_time( 'timestamp' );

			// WP_Query arguments
			if ( empty( $cortex_limit_by_category_listing ) ) { // query all events
				$listing_args = array(
					'post_type'              => 'event',
					'post_status'            => 'publish', // only show published events
					'orderby'                => 'meta_value', // order by date
					'meta_key'               => 'date_and_time', // your ACF Date & Time Picker field
					'meta_value'             => $cortex_time, // Use the current time from above
					'meta_compare'           => '>=', // Compare today's datetime with our event datetime
					'order'                  => 'ASC', // Show earlier events first
					'posts_per_page'   => -1,
				);
				if ( $cortex_show_past_events == true ) {
					$old_listing_args = array(
						'post_type'              => 'event',
						'post_status'            => 'publish', // only show published events
						'orderby'                => 'meta_value', // order by date
						'meta_key'               => 'date_and_time', // your ACF Date & Time Picker field
						'meta_value'             => $cortex_time, // Use the current time from above
						'meta_compare'           => '<=', // Compare today's datetime with our event datetime
						'order'                  => 'ASC', // Show earlier events first
						'posts_per_page'   => -1,
					);
				} //end of getting past events query built
			} else { // a specific category is needed

				$listing_args = array(
					'post_type'              => 'event',
					'tax_query' => array(
						array(
				'taxonomy' => 'events-category',
				'terms'  => $cortex_limit_by_category,
						),
					),
					'post_status'            => 'publish', // only show published events
					'orderby'                => 'meta_value', // order by date
					'meta_key'               => 'date_and_time', // your ACF Date & Time Picker field
					'meta_value'             => $cortex_time, // Use the current time from above
					'meta_compare'           => '>=', // Compare today's datetime with our event datetime
					'order'                  => 'ASC', // Show earlier events first
					'posts_per_page'   => -1,
				);
				if ( $cortex_show_past_events == true ) {
					$old_listing_args = array(
						'post_type'              => 'event',
						'tax_query' => array(
							array(
					'taxonomy' => 'events-category',
					'terms'  => $cortex_limit_by_category,
							),
						),
						'post_status'            => 'publish', // only show published events
						'orderby'                => 'meta_value', // order by date
						'meta_key'               => 'date_and_time', // your ACF Date & Time Picker field
						'meta_value'             => $cortex_time, // Use the current time from above
						'meta_compare'           => '<=', // Compare today's datetime with our event datetime
						'order'                  => 'ASC', // Show earlier events first
						'posts_per_page'   => -1,
					);
				} //end of getting past events query built
			} //end specific category query build
?>

				<div class="tab_wrap event_tabs mar30T mar30B">
					<div class="col-xs-12 col-md-6 col-md-offset-3">
					<ul class="nav nav-tabs nav-justified mar30B mar30T" role="tablist">
						<li class="active">
						<?php if ( ! empty( $cortex_upcoming_events_heading ) ) { ?><h2 class="h5 center"><a href="#upcomingEventsTab" data-toggle="tab"><?php echo $cortex_upcoming_events_heading; ?></a></h2><?php } else { ?><h2 class="h5 center"><a href="#upcomingEventsTab" data-toggle="tab"><?php the_title(); ?></a></h2><?php } ?>
						</li>
						<?php if ( $cortex_show_past_events == true ) { ?>
						<li>
						<?php if ( ! empty( $cortex_past_events_heading ) ) { ?><h2 class="h5 center"><a href="#pastEventsTab" data-toggle="tab" class="third-color-text"><?php echo $cortex_past_events_heading; ?></a></h2><?php } else { ?><h2 class="h5 center"><a href="#pastEventsTab" data-toggle="tab" class="third-color-text"><?php esc_html_e( 'Past Events', 'cortex' ); ?></a></h2><?php } ?>
						</li>
						<?php } ?>
					</ul>
					</div><!--end of nav center-->
					<div class="clearfix"> </div>
					<div class="tab-content mar30T">

		<?php
		// The Query for upcoming events
		$cortex_query = new WP_Query( $listing_args );

		if ( $cortex_query->have_posts() ) {

			// two layout options
			switch ( $cortex_events_display_type ) {

				case 'big':

			?>
						<div class="tab-pane fade active in" role="tabpanel" id="upcomingEventsTab">
				<?php while ( $cortex_query->have_posts() ) {
					$cortex_query->the_post();

					$cortex_start      		 		= get_field( 'date_and_time' ); //can be used for formatting
					$cortex_date       		 		= get_field( 'date_and_time' ); //raw date from db is already displayed correctly
					$cortex_featured_image   		= get_the_post_thumbnail( get_the_id(), 'full' );
					$cortex_event_headline   		= get_field( 'event_headline' );
					$cortex_location_name    		= get_field( 'location_name' );
					$cortex_location_city_country   = get_field( 'location_city_country' );
					$cortex_location_address   		= get_field( 'location_address' );
					$cortex_location_map_link   	= esc_url( get_field( 'location_map_link' ) );
					$cortex_event_ticket_link   	= esc_url( get_field( 'event_ticket_link' ) );
					$cortex_rsvp_link     			= esc_url( get_field( 'rsvp_link' ) );
					$cortex_share_buttons    		= get_field( 'share_buttons' );
					$cortex_opener_1     			= get_field( 'opener_1' );
					$cortex_opener_2     			= get_field( 'opener_2' );
					$cortex_opener_3     			= get_field( 'opener_3' );
					$cortex_opener_4     			= get_field( 'opener_4' );
					$cortex_opener_5     			= get_field( 'opener_5' );

?>
				<article id="post-<?php the_ID(); ?>" class="event-big mar30B wow animated fadeInUp">
					<div class="row">

						<div class="event-buttons">
							<?php if ( ! empty( $cortex_rsvp_link ) ) { ?><div class="rsvp-link"><a class="btn btn-sm btn-link" href="<?php echo $cortex_rsvp_link; ?>" target="_blank"><?php esc_html_e( 'RSVP', 'cortex' ); ?></a></div><?php } ?>
							<?php if ( ! empty( $cortex_event_ticket_link ) ) { ?><div class="event-link"><a class="btn btn-sm btn-default" href="<?php echo $cortex_event_ticket_link; ?>" target="_blank"><?php esc_html_e( 'Get Tickets', 'cortex' ); ?></a></div><?php } ?>
							<a class="btn btn-sm btn-primary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Details', 'cortex' ); ?></a>
						</div>

						<?php if ( ! empty( $cortex_featured_image ) ) { ?>

						<div class="col-xs-12 col-md-3 event-image-container">
							<figure class="event-image img_container mar0B">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $cortex_featured_image; ?></a>
							</figure>
						</div>
						<div class="col-xs-12 col-md-9">
						<?php } else { ?>
						<div class="col-xs-12 col-md-12 event-info">
						<?php } ?>

						<header class="event-header">
							<div class="date">
								<span class="h6 accent-color-bg"><span class="alt headline-color-text headline-font"><?php echo $cortex_date; ?></span></span>
							</div>
							<div class="venue">
								<?php if ( ! empty( $cortex_location_map_link ) ) { ?>
								<a href="<?php echo $cortex_location_map_link; ?>" target="_blank">
								<?php } ?>
								<?php if ( ! empty( $cortex_location_name ) ) { ?><span class="secondary-font"><?php echo $cortex_location_name; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_location_address ) ) { ?> <span class="secondary-font secondary-color-text"><?php echo $cortex_location_address; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_location_city_country ) ) { ?> <span class="secondary-font secondary-color-text"><?php echo $cortex_location_city_country; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_location_map_link ) ) { ?></a><?php } ?>
							</div>
						</header>
						<div class="event-big-content">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="h3 headliner headline-font"><?php the_title(); ?></a>
							<hr />
							<div class="event-act">
							<?php if ( ! empty( $cortex_event_headline ) ) { ?><span class="h3 opener headline-font"><?php echo $cortex_event_headline; ?></span><?php } ?>
							<?php if ( ! empty( $cortex_opener_1 ) ) { ?><span class="h5 opener headline-font"><?php echo $cortex_opener_1; ?></span><?php } ?>
							<?php if ( ! empty( $cortex_opener_2 ) ) { ?><span class="h5 opener headline-font"><?php echo $cortex_opener_2; ?></span><?php } ?>
							<?php if ( ! empty( $cortex_opener_3 ) ) { ?><span class="h5 opener headline-font"><?php echo $cortex_opener_3; ?></span><?php } ?>
							<?php if ( ! empty( $cortex_opener_4 ) ) { ?><span class="h5 opener headline-font"><?php echo $cortex_opener_4; ?></span><?php } ?>
							<?php if ( ! empty( $cortex_opener_5 ) ) { ?><span class="h5 opener headline-font"><?php echo $cortex_opener_5; ?></span><?php } ?>
							</div>
						</div><!--end content of event-->
						<?php if ( $cortex_share_buttons == true ) { ?>
							<div class="event-share">
								<?php include( locate_template( 'inc/single-social.php' ) ); ?>
							</div>
						<?php } //end checking for share buttons ?>

						<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- end md-12 or md-10-->
					</div><!-- #row -->

				</article><!-- #post-## -->
				<?php
} //end of events loop
		wp_reset_postdata();
?>
				</div><!--end of tab-pane for upcoming events-->
				<?php
				break;
				case 'basic':
					?><div class="tab-pane fade active in" role="tabpanel" id="upcomingEventsTab">

					<div class="event-basic mar20B">
					<table class="cortex-table">
						<tbody>
					<?php
					while ( $cortex_query->have_posts() ) :
						$cortex_query->the_post();

						$cortex_start      				= get_field( 'date_and_time' );
						$cortex_day      				= date( 'l', strtotime($cortex_start) );
						$cortex_date      				= date( 'm.j.y', strtotime($cortex_start) );
						$cortex_time      				= date( 'g:iA', strtotime($cortex_start) );
						$cortex_event_headline   		= get_field( 'event_headline' );
						$cortex_location_name    		= get_field( 'location_name' );
						$cortex_location_city_country   = get_field( 'location_city_country' );
						$cortex_location_address   		= get_field( 'location_address' );
						$cortex_location_map_link   	= esc_url( get_field( 'location_map_link' ) );
						$cortex_event_ticket_link   	= esc_url( get_field( 'event_ticket_link' ) );
						$cortex_rsvp_link     			= esc_url( get_field( 'rsvp_link' ) );
						$cortex_opener_1     			= get_field( 'opener_1' );
						$cortex_opener_2     			= get_field( 'opener_2' );
						$cortex_opener_3     			= get_field( 'opener_3' );
						$cortex_opener_4     			= get_field( 'opener_4' );
						$cortex_opener_5     			= get_field( 'opener_5' );
			?>
						<tr class="event-basic-row wow animated fadeInUp">
							<td class="event-basic-cell date h6 headline-font accent-color-bg"><span class="day secondary-font"><?php echo $cortex_day; ?></span><span class="date-number"><?php echo $cortex_date; ?></span><span class="time"><?php echo $cortex_time; ?></span></td>
							<td class="event-basic-cell headline h5 headline-font">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><em><?php the_title(); ?></em></a>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $cortex_event_headline; ?></a><br />
								<?php if ( ! empty( $cortex_opener_1 ) ) { ?><span class="h6"><?php echo $cortex_opener_1; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_opener_2 ) ) { ?><span class="h6">&middot; <?php echo $cortex_opener_2; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_opener_3 ) ) { ?><span class="h6">&middot; <?php echo $cortex_opener_3; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_opener_4 ) ) { ?><span class="h6">&middot; <?php echo $cortex_opener_4; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_opener_5 ) ) { ?><span class="h6">&middot; <?php echo $cortex_opener_5; ?></span><?php } ?>
							</td>
							<td class="event-basic-cell location">
								<?php if ( ! empty( $cortex_location_name ) ) { ?>
									<?php if ( ! empty( $cortex_location_map_link ) ) { ?><a href="<?php echo $cortex_location_map_link; ?>" target="_blank"><?php } ?>
									<?php echo $cortex_location_name;?><br />
									<?php if ( ! empty( $cortex_location_map_link ) ) { ?></a><?php } ?>
									<?php if ( ! empty( $cortex_location_city_country ) ) { ?>
										<span class="city_country"><?php echo $cortex_location_city_country; ?></span>
									<?php } //end checking for location city ?>
								<?php } //end checking for location name ?>
							</td>
							<td class="event-basic-cell button_links">
								<?php if ( ! empty( $cortex_rsvp_link ) ) { ?><div class="rsvp-link"><a class="btn btn-sm btn-link" href="<?php echo $cortex_rsvp_link; ?>" target="_blank"><?php esc_html_e( 'RSVP', 'cortex' ); ?></a></div><?php } ?>
								<?php if ( ! empty( $cortex_event_ticket_link ) ) { ?><div class="event-link"><a class="btn btn-sm btn-default" href="<?php echo $cortex_event_ticket_link; ?>" target="_blank"><?php _e( 'Get Tickets', 'cortex' ); ?></a></div><?php } ?>
								<a class="btn btn-sm btn-primary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Details', 'cortex' ); ?></a>
							</td>
						</tr>
				<?php
				endwhile; // end of events loop
					wp_reset_postdata();
			?>
					</tbody>
				</table>
				</div><!--end event-basic-->
				</div><!--end of tab-pane-->
				<?php
				break;
			}
		} else {
		?>
		<div class="tab-pane fade active in" id="upcomingEventsTab">
		<p><?php
			esc_html_e( 'No upcoming events at this time.', 'cortex' );
			?></p>
				</div><!--end of tab-pane-->
				<?php
		} //end of if have posts

		// show past events is set to true
		if ( $cortex_show_past_events == true ) {
			// The Query for past events events
			$cortex_old_query = new WP_Query( $old_listing_args );

			if ( $cortex_old_query->have_posts() ) {
		?>
            <div class="tab-pane fade" role="tabpanel" id="pastEventsTab">
	            <div class="event-basic mar20B">
					<table class="cortex-table">
						<tbody>

            <?php
			while ( $cortex_old_query->have_posts() ) {
				$cortex_old_query->the_post();

				$cortex_o_start                     = get_field( 'date_and_time' );
				$cortex_o_day        				= date( 'l', strtotime($cortex_o_start) );
				$cortex_o_date      				= date( 'm.j.y', strtotime($cortex_o_start) );
				$cortex_o_event_headline            = get_field( 'event_headline' );
				$cortex_o_location_name             = get_field( 'location_name' );
				$cortex_o_location_city_country     = get_field( 'location_city_country' );
				$cortex_o_location_address          = get_field( 'location_address' );
				$cortex_o_location_map_link         = esc_url( get_field( 'location_map_link' ) );
				$cortex_o_opener_1                  = get_field( 'opener_1' );
				$cortex_o_opener_2                  = get_field( 'opener_2' );
				$cortex_o_opener_3                  = get_field( 'opener_3' );
				$cortex_o_opener_4                  = get_field( 'opener_4' );
				$cortex_o_opener_5                  = get_field( 'opener_5' );

				// begin archived events display
		?>


					<tr class="event-basic-row wow animated fadeInUp">
						<td class="event-basic-cell date h6 headline-font accent-color-bg" ><span class="day secondary-font"><?php echo $cortex_o_day; ?></span><span class="date-number"><?php echo $cortex_o_date; ?></span></td>
						<td class="event-basic-cell headline h5 headline-font">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><em><?php the_title(); ?></em></a>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $cortex_o_event_headline; ?></a><br />
							<?php if ( ! empty( $cortex_o_opener_1 ) ) { ?><span class="h6"><?php echo $cortex_o_opener_1; ?></span><?php } ?>
							<?php if ( ! empty( $cortex_o_opener_2 ) ) { ?><span class="h6">&middot; <?php echo $cortex_o_opener_2; ?></span><?php } ?>
							<?php if ( ! empty( $cortex_o_opener_3 ) ) { ?><span class="h6">&middot; <?php echo $cortex_o_opener_3; ?></span><?php } ?>
							<?php if ( ! empty( $cortex_o_opener_4 ) ) { ?><span class="h6">&middot; <?php echo $cortex_o_opener_4; ?></span><?php } ?>
							<?php if ( ! empty( $cortex_o_opener_5 ) ) { ?><span class="h6">&middot; <?php echo $cortex_o_opener_5; ?></span><?php } ?>
						</td>
						<td class="event-basic-cell location">
							<?php if ( ! empty( $cortex_o_location_name ) ) { ?>
									<?php if ( ! empty( $cortex_o_location_map_link ) ) { ?><a href="<?php echo $cortex_o_location_map_link; ?>" target="_blank"><?php } ?>
									<?php echo $cortex_o_location_name;?><br />
									<?php if ( ! empty( $cortex_o_location_map_link ) ) { ?></a><?php } ?>
									<?php if ( ! empty( $cortex_o_location_city_country ) ) { ?>
										<span class="city_country"><?php echo $cortex_o_location_city_country; ?></span>
									<?php } //end checking for location city ?>
								<?php } //end checking for location name ?>
						</td>
						<td class="event-basic-cell button_links">
							<a class="btn btn-sm btn-primary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Details', 'cortex' ); ?></a>
						</td>
					</tr>


		<?php
		// end of archived events display
			} //end of events loop
				wp_reset_postdata();
		?>
						</tbody>
					</table>
	            </div><!--end of event-basic-->
            </div><!--end of .tab-pane #pastEventsTab-->

        <?php

			} else {
		?>
		<div class="tab-pane" id="pastEventsTab">
		<p><?php
		esc_html_e( 'No past events were found', 'cortex' );
		?></p>
		</div><!--end of tab-pane-->
		<?php
			} //end of if have posts
		} //end of checking for old events
?>

						</div><!--end .tab-content upcoming/archive events tabs-->

						</div><!--end of tab wrap-->

					</div><!-- #container -->
				</div><!--end section-bg-->
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'footer-top' ); ?>
<?php get_footer(); ?>
