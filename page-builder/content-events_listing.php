<?php
$cortex_background    				= get_sub_field( 'custom_background' );
$cortex_backgroundColor    			= get_sub_field( 'background_color' );
$cortex_customClass      			= esc_html( get_sub_field( 'custom_class' ) );
$cortex_backgroundImage    			= esc_url( get_sub_field( 'background_image' ) );
$cortex_backgroundPattern    		= esc_url( get_sub_field( 'background_pattern' ) );
$cortex_backgroundRepeat    		= get_sub_field( 'background_pattern_repeat' );
$cortex_backgroundParallax    		= get_sub_field( 'background_image_parallax' );
$cortex_events_title     			= get_sub_field( 'title' );
$cortex_events_sub_title    		= get_sub_field( 'sub_title' );
$cortex_events_display_type   		= get_sub_field( 'event_display_type' );
$cortex_limit_by_category    		= get_sub_field( 'limit_by_category' );
$cortex_number_of_events_to_display = get_sub_field( 'number_of_events_to_display' );
$cortex_view_more_btn     			= get_sub_field( 'view_more_btn' );
$cortex_view_more_button_link   	= esc_url( get_sub_field( 'view_more_button_link' ) );

/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
if ( $cortex_background != 'none' ) {

	if ( ( $cortex_backgroundColor != '' ) || ( $cortex_backgroundImage != '' ) || ( $cortex_backgroundPattern != '' ) ) {
		$cortex_style    = 'style="';
	}
	if ( $cortex_backgroundColor != '' ) {
		$cortex_style  .= "background-color: $cortex_backgroundColor; ";
	}
	if ( ( $cortex_backgroundImage != '' ) && ( $cortex_background == 'image' ) ) {
		$cortex_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat; background-position: center center;";
	}
	if ( ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'pattern' ) ) || ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'color_pattern' ) ) ) {
		$cortex_style  .= "background-image: url($cortex_backgroundPattern); background-repeat: $cortex_backgroundRepeat;";
	}
} //end checking for custom background
?>
<section id="section-<?php echo $cortex_counter; ?>" class="event-listing<?php if ( $cortex_customClass != '' ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg"<?php if ( $cortex_backgroundParallax == 'yes' ) { echo " data-bottom-top=\"background-position: 0% 0%;\" data-top-bottom=\"background-position: 0% -200%;\" data-anchor-target=\"#section-$cortex_counter\"";
} if ( ! empty( $cortex_style ) ) { echo $cortex_style.'"'; } ?>>
		<div class="container">

			<?php if ( ( ! empty($cortex_events_title) ) || ( ! empty($cortex_events_sub_title) ) ) { ?>
			<header class="events-heading wow animated fadeInUp">
				<span class="h1 center mar20B">
				<?php echo $cortex_events_title; ?>
				</span>
				<span class="center events_description subtitle mar30B"><?php echo $cortex_events_sub_title; ?></span>
			</header>
			<?php } ?>

		<?php
		$cortex_time = current_time( 'timestamp' );

		// WP_Query arguments
		if ( $cortex_limit_by_category == false ) { // query all events
			$args = array(
				'post_type'              => 'event',
				'post_status'            => 'publish', // only show published events
				'orderby'                => 'meta_value', // order by date
				'meta_key'               => 'date_and_time', // your ACF Date & Time Picker field
				'meta_value'             => $cortex_time, // Use the current time from above
				'meta_compare'           => '>=', // Compare today's datetime with our event datetime
				'order'                  => 'ASC', // Show earlier events first
				'posts_per_page'   		 => $cortex_number_of_events_to_display,
			);
		} else { // a specific category is needed

			$args = array(
				'post_type'              => 'event',
				'tax_query' => array(
			array(
				'taxonomy' => 'events-category',
				'terms'		=> $cortex_limit_by_category,
			),
				),
				'post_status'            => 'publish', // only show published events
				'orderby'                => 'meta_value', // order by date
				'meta_key'               => 'date_and_time', // your ACF Date & Time Picker field
				'meta_value'             => $cortex_time, // Use the current time from above
				'meta_compare'           => '>=', // Compare today's datetime with our event datetime
				'order'                  => 'ASC', // Show earlier events first
				'posts_per_page'   		 => $cortex_number_of_events_to_display,
			);
		}

		// The Query
		$cortex_query = new WP_Query( $args );

		if ( $cortex_query->have_posts() ) {

			// two layout options
			switch ( $cortex_events_display_type ) {

				case 'big':
			?>
				<div class="event-big-images mar30B">
			<?php
			while ( $cortex_query->have_posts() ) {
				$cortex_query->the_post();

				$cortex_start      				= get_field( 'date_and_time' );
				$cortex_date      				= date( 'l, F j, Y g:iA', strtotime($cortex_start) );
				$cortex_featured_image   		= get_the_post_thumbnail( get_the_id(), 'full' );
				$cortex_event_headline   		= get_field( 'event_headline' );
				$cortex_location_name    		= get_field( 'location_name' );
				$cortex_location_city_country   = get_field( 'location_city_country' );
				$cortex_location_address   		= get_field( 'location_address' );
				$cortex_location_map_link   	= esc_url( get_field( 'location_map_link' ) );
				$cortex_event_ticket_link   	= esc_url(  get_field( 'event_ticket_link' ) );
				$cortex_rsvp_link     			= esc_url(  get_field( 'rsvp_link' ) );
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
							<?php if ( ! empty( $cortex_rsvp_link ) ) { ?><div class="rsvp-link"><a class="btn btn-sm btn-link" href="<?php echo $cortex_rsvp_link; ?>" target="_blank"><?php _e( 'RSVP', 'cortex' ); ?></a></div><?php } ?>
							<?php if ( ! empty( $cortex_event_ticket_link ) ) { ?><div class="event-link"><a class="btn btn-sm btn-default" href="<?php echo $cortex_event_ticket_link; ?>" target="_blank"><?php _e( 'Get Tickets', 'cortex' ); ?></a></div><?php } ?>
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
								<?php if ( ! empty( $cortex_location_name ) ) { ?><span class="secondary-font headline-color-text"><?php echo $cortex_location_name; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_location_address ) ) { ?> <span class="secondary-font light-color-text"><?php echo $cortex_location_address; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_location_city_country ) ) { ?> <span class="secondary-font light-color-text"><?php echo $cortex_location_city_country; ?></span><?php } ?>
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

						<?php if ( $cortex_share_buttons == true ) { ?>
							<div class="event-share mar20T">
								<?php include( locate_template( 'inc/single-social.php' ) ); ?>
							</div>
						<?php } //end checking for share buttons ?>

						<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!--end event-big-content-->
						</div><!-- end md-12 or md-10-->
					</div><!-- #row -->

				</article><!-- #post-## -->
				<?php
			} //endwhile; end of events loop
			wp_reset_postdata();
			?>
					<?php if ( $cortex_view_more_btn == true ) { ?>
					<div class="view-more-btn center">
						<a class="btn btn-md btn-default accent-color-bg" href="<?php echo $cortex_view_more_button_link; ?>"><?php esc_html_e( 'View More', 'cortex' ); ?></a>
					</div>
					<?php } ?>
				</div><!--end big-event-images-->
				<?php
				break;
				case 'basic':
			?>
					<div class="event-basic mar20B">
					<table class="cortex-table">
						<tbody>
				<?php
				while ( $cortex_query->have_posts() ) {
					$cortex_query->the_post();

					$cortex_start      				= get_field( 'date_and_time' );
					$cortex_day      				= date( 'l', strtotime($cortex_start) );
					$cortex_date     				= date( 'm.j.y', strtotime($cortex_start) );
					$cortex_time      				= date( 'g:iA', strtotime($cortex_start) );
					$cortex_event_headline   		= get_field( 'event_headline' );
					$cortex_location_name    		= get_field( 'location_name' );
					$cortex_location_city_country   = get_field( 'location_city_country' );
					$cortex_location_address   		= get_field( 'location_address' );
					$cortex_location_map_link   	= esc_url( get_field( 'location_map_link' ) );
					$cortex_event_ticket_link   	= esc_url(  get_field( 'event_ticket_link' ) );
					$cortex_rsvp_link     			= esc_url(  get_field( 'rsvp_link' ) );
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
								<?php if ( ! empty( $cortex_opener_2 ) ) { ?><span class="h6"><?php echo ', ' . $cortex_opener_2; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_opener_3 ) ) { ?><span class="h6"><?php echo ', ' . $cortex_opener_3; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_opener_4 ) ) { ?><span class="h6"><?php echo ', ' . $cortex_opener_4; ?></span><?php } ?>
								<?php if ( ! empty( $cortex_opener_5 ) ) { ?><span class="h6"><?php echo ', ' . $cortex_opener_5; ?></span><?php } ?>
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
							<td class="event-basic-cell button_links hidden-sm">
								<?php if ( ! empty( $cortex_rsvp_link ) ) { ?><div class="rsvp-link"><a class="btn btn-sm btn-link" href="<?php echo $cortex_rsvp_link; ?>" target="_blank"><?php _e( 'RSVP', 'cortex' ); ?></a></div><?php } ?>
								<?php if ( ! empty( $cortex_event_ticket_link ) ) { ?><div class="event-link"><a class="btn btn-sm btn-default" href="<?php echo $cortex_event_ticket_link; ?>" target="_blank"><?php _e( 'Get Tickets', 'cortex' ); ?></a></div><?php } ?>
								<a class="btn btn-sm btn-primary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Details', 'cortex' ); ?></a>
							</td>
						</tr>
				<?php
				} //endwhile; end of events loop
				wp_reset_postdata();
			?>
					</tbody>
				</table>
				<?php if ( $cortex_view_more_btn == true ) { ?>
				<div class="view-more-btn center wow animated fadeInUp">
					<a class="btn btn-md btn-default accent-color-bg" href="<?php echo $cortex_view_more_button_link; ?>"><?php esc_html_e( 'View More', 'cortex' ); ?></a>
				</div><!--end view-more-bt-->
				<?php } ?>
				</div><!--end event basic-->
				<?php
				break;
			} //end switch
		}	else {
				esc_html_e( 'No events were found', 'cortex' );
} // endif
?>

		</div><!-- #container -->
	</div><!--end section-bg-->
</section>
<?php $cortex_counter++;
unset( $cortex_events_title, $cortex_events_sub_title, $cortex_customClass, $cortex_events_display_type, $cortex_limit_by_category, $cortex_number_of_events_to_display, $cortex_view_more_btn, $cortex_view_more_btn_link );?>
