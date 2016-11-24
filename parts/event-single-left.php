<?php
$cortex_event_sidebar_display   = get_field( 'event_sidebar_display' );
$cortex_share_buttons    		= get_field( 'share_buttons' );
$cortex_start      				= get_field( 'date_and_time' );
$cortex_day      				= date( 'l', strtotime($cortex_start) );
$cortex_date      				= date( 'm.j.y', strtotime($cortex_start) );
$cortex_time      				= date( 'g:iA', strtotime($cortex_start) );
$cortex_location_address   		= get_field( 'location_address' );
$cortex_opener_1     			= get_field( 'opener_1' );
$cortex_opener_2    			= get_field( 'opener_2' );
$cortex_opener_3     			= get_field( 'opener_3' );
$cortex_opener_4     			= get_field( 'opener_4' );
$cortex_opener_5     			= get_field( 'opener_5' );

// check to see what the event sidebar display was set to for the post, if it's empty, use the default
if ( empty( $cortex_event_sidebar_display ) ) { $cortex_event_sidebar_display = $cortex_theme_options['c9-post-sidebar']; }

?>
<section id="event-single" class="content-single event-single event-<?php the_ID(); ?>">

	<?php include( locate_template( 'parts/event-header.php' ) ); ?>

	<div class="container">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="row">

				<?php if ( $cortex_event_sidebar_display != 'sidebar-none' ) { // check to see if the sidebar has widgets in it. ?>
				<div class="col-xs-12 col-sm-5 col-md-3 sidebar wow animated slideInUp" id="event-sidebar-right">
					<?php
					if ( is_active_sidebar( 'sidebar-events' ) ) {
						dynamic_sidebar( 'sidebar-events' );
					} else {
						esc_html_e( 'Events Sidebar must have widgets assigned to them!', 'cortex' );
					}
					?>
				</div>
				<?php } //end sidebar if ?>

				<div class="col-xs-12<?php if ( $cortex_event_sidebar_display == 'sidebar-none' ) { echo ' col-sm-12 col-md-12';
} else { echo ' col-sm-7 col-md-9'; } ?>">

					<div class="entry-content wow animated fadeInUp">

						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-9">
								<div class="mar10T">
									<?php the_content(); ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 mar5T">

								<div class="event-date-container accent-color-bg pull-left clearfix wow animated fadeInUp">
									<div class="event-location-box secondary-color-text text-left">
										<?php if ( ! empty( $cortex_date ) ) { ?><span class="event-date h6 light-color-text mar0T"><?php echo $cortex_day; ?><br /><?php echo $cortex_date; ?><br /><?php echo $cortex_time; ?></span><?php } ?>
									</div><!--end event date-->
								</div><!--end date container-->

								<div class="clearme">&nbsp;</div>
								<?php if ( ! empty( $cortex_event_headline ) ) { ?><span class="event-headline h5 text-left mar30T"><?php echo $cortex_event_headline; ?></span> <?php } ?>
								<?php if ( ! empty( $cortex_opener_1 ) ) { ?><span class="event-opener secondary-color-text h6 text-left"><?php echo $cortex_opener_1; ?></span> <?php } ?>
								<?php if ( ! empty( $cortex_opener_2 ) ) { ?><span class="event-opener secondary-color-text h6 text-left"><?php echo $cortex_opener_2; ?></span> <?php } ?>
								<?php if ( ! empty( $cortex_opener_3 ) ) { ?><span class="event-opener secondary-color-text h6 text-left"><?php echo $cortex_opener_3; ?></span> <?php } ?>
								<?php if ( ! empty( $cortex_opener_4 ) ) { ?><span class="event-opener secondary-color-text h6 text-left"><?php echo $cortex_opener_4; ?></span> <?php } ?>
								<?php if ( ! empty( $cortex_opener_5 ) ) { ?><span class="event-opener secondary-color-text h6 text-left"><?php echo $cortex_opener_5; ?></span> <?php } ?>
								<div class="event-location-container">
									<h5 class="text-left"><?php esc_html_e( 'Location', 'cortex' ); ?></h5>
									<div class="event-location secondary-color-text text-left">
										<address class="mar20B">
										<?php if ( ! empty( $cortex_u_location_name ) ) { ?><span class="event-location-name h6 mar5B"><?php echo $cortex_u_location_name; ?></span><?php } ?>
										<?php if ( ! empty( $cortex_location_address ) ) { ?><span class="event-location-address"><?php echo $cortex_location_address; ?></span><br /><?php } ?>
										<?php if ( ! empty( $cortex_u_location_city_country ) ) { ?><span class="event-location-city"><?php echo $cortex_u_location_city_country; ?></span><br /><?php } ?>
										</address>
										<?php if ( ! empty( $cortex_u_location_map_link ) ) { ?><a href="<?php echo $cortex_u_location_map_link; ?>" target="_blank" class="action-link h6"><span class="event-location-link"><?php _e( 'View Map', 'cortex' ); ?></span></a><?php } ?>

									</div><!--end location info-->
								</div><!--end event location container-->
							</div><!--end column-->

						</div><!--end row-->
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php cortex_entry_footer(); ?>
					</footer><!-- .entry-footer -->

					<?php
					if ( $cortex_share_buttons == true ) {
						include( locate_template( 'inc/single-social.php' ) );
					}
?>


					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
endif;
?>

				</div><!-- .col-md-9 or 12-->
			</div><!-- end row-->
		</article><!-- #post-## -->
	</div><!--.container -->

</section><!--end setion-->
