<?php
global $cortex_options;

if ( $cortex_options['c9-enable-topnav'] == true ) {

	$cortex_color_text 		= $cortex_options['c9-topnav-text-color'];
	$cortex_topnav_email 	= antispambot($cortex_options['c9-topnav-email']);
	$cortex_topnav_address	= esc_attr($cortex_options['c9-topnav-address']);
	$cortex_topnav_phone	= esc_attr($cortex_options['c9-topnav-phone']);
	$cortex_topnav_map_link	= esc_html($cortex_options['c9-topnav-map-link']);
?>

	    <div class="navbar-top<?php if ($cortex_options['c9-enable-topnav-mobile'] == false) { echo ' hidden-xs'; } echo ' ' . $GLOBALS['cortex_navigation_type']; ?>" id="topnav">

		    <div class="container">
			    <div class="row">
				    <div class="col-xs-8 col-sm-6 text-left">

						<?php if ( (!empty($cortex_topnav_map_link)) || (!empty($cortex_topnav_address)) ) { ?>
							
							<?php if ( !empty($cortex_topnav_map_link) ) { ?>

								<a href="<?php echo $cortex_topnav_map_link; ?>" target="_blank"><span class="-cortex-h6 address<?php if ( !empty($cortex_color_text) ) { echo ' ' . $cortex_color_text; } ?>"><i class="fa fa-map-marker"></i> <span class="hidden-xs<?php if ( !empty($cortex_color_text) ) { echo ' ' . $cortex_color_text; } ?>"><?php echo $cortex_topnav_address; ?></span></span></a>

							<?php } else { ?>

								<span class="-cortex-h6 address<?php if ( !empty($cortex_color_text) ) { echo ' ' . $cortex_color_text; } ?>"><i class="fa fa-map-marker"></i> <span class="hidden-xs"><?php echo $cortex_topnav_address; ?></span></span>

							<?php } ?>

						<?php } ?>

						<?php if ( !empty($cortex_topnav_phone) ) { ?>
					    <span class="-cortex-h6 phone<?php if ( !empty($cortex_color_text) ) { echo ' ' . $cortex_color_text; } ?>"><i class="fa fa-phone"></i> <?php echo $cortex_topnav_phone; ?></span>
					    <?php } ?>

				    </div><!--end col-->
				    <div class="col-xs-4 col-sm-6 text-right">
					    
					    <?php if ( !empty($cortex_topnav_email) ) { ?>
					    
					    <a href="mailto:<?php echo $cortex_topnav_email; ?>"<?php if ( !empty($cortex_color_text) ) { echo ' class="' . $cortex_color_text . '"'; } ?>><span class="-cortex-h6 info"><i class="fa fa-envelope<?php if ( !empty($cortex_color_text) ) { echo ' ' . $cortex_color_text; } ?>"></i><span class="hidden-xs<?php if ( !empty($cortex_color_text) ) { echo ' ' . $cortex_color_text; } ?>"> <?php echo $cortex_topnav_email; ?></span></span></a>
					    
					    <?php } ?>
					    
				    </div><!--end col-->
			    </div>
		    </div>

            <?php
            // add a navbar bg depending on which type was selected
            if ( $GLOBALS['cortex_navigation_type'] == 'nav1' ) { //initially transparent ?>

            <div class="navbar-bg" data-90-start="opacity: 0;" data-120-start="opacity: .8;"></div>

            <?php } elseif ( $GLOBALS['cortex_navigation_type'] == 'nav2' ) { //opaque ?>

            <div class="navbar-bg-solid"></div>
            <?php } ?>

	    </div>
<?php } ?>
