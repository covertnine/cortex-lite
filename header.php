<?php
/**
 * The header for Cortex theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cortex
 */
global $cortex_options;
$cortex_theme_options         		= $cortex_options;
$cortex_theme_style           		= sanitize_html_class( $cortex_theme_options['c9-theme-style'] );
$GLOBALS['cortex_navigation_type']  = sanitize_html_class( $cortex_theme_options['c9-navigation-type'] );
$cortex_protocol 					= (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:" : "http:";
$cortex_loading_image 				= $cortex_protocol. str_replace(array('http:', 'https:'), '', $cortex_theme_options['c9-loading-image']['url']);
$cortex_loading_animation        	= $cortex_protocol. str_replace(array('http:', 'https:'), '', $cortex_theme_options['c9-loading-animation']['url']);

// get the post ID or category ID to pull nav variables
if ( ! is_category() ) { // current request is for a page or post

    $cortex_current_post_id   = cortex_get_the_ID();

} else { // current request is for a category

    $cortex_queried_object    = get_queried_object();
    $cortex_taxonomy          = $cortex_queried_object->taxonomy;
    $cortex_term_id           = $cortex_queried_object->term_id;
    $cortex_current_post_id   = $cortex_taxonomy . '_' . $cortex_term_id;
}

// pull the navigation_type_override variable
$cortex_navigation_type_override    = get_field( 'navigation_type_override', $cortex_current_post_id );

// if the navigation type has been changed, change the navigation type variable
if ( ($cortex_navigation_type_override != 'default') && ($cortex_navigation_type_override != '') && ($cortex_current_post_id != '0') ) {

    $GLOBALS['cortex_navigation_type'] = sanitize_html_class( $cortex_navigation_type_override );

} else { // navigation option hasn't been set (search results & other places)

	$GLOBALS['cortex_navigation_type'] = sanitize_html_class( $cortex_theme_options['c9-navigation-type'] );

}
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php if ( ! empty( $cortex_theme_options['apple_touch_icon_field'] ) ) { echo esc_url( $cortex_theme_options['apple_touch_icon_field'] );
} else { echo get_template_directory_uri() . '/img/apple-touch-icon.png'; } ?>">
<noscript>
<style type="text/css">
.no-js body {opacity: 1 !important;}
</style>
</noscript>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="page-top" style="opacity: 0;">
	<!--[if lt IE 8]>
	<p class="browserupgrade">
	    <?php __( 'You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience.', 'cortex' ); ?>
	</p>
	<![endif]-->
	<!--[if lt IE 10]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" type="text/css" media="screen" />
	<![endif]-->
    <?php if ( $cortex_theme_options['c9-enable-preloader'] == true ) { ?>

    <div class="c9-loader-overlay<?php if ( $cortex_theme_style == 'dark' ) { echo ' dark'; } ?>">
        <div class="loading_image">
	        <img src="<?php if ( empty( $cortex_loading_image ) ) { echo get_template_directory_uri() . '/img/cortex-logo.png'; } else { echo $cortex_loading_image; } ?>" alt="<?php esc_html_e( 'Loading...', 'cortex' ); ?>" class="loading_logo">
    		<img src="<?php if ( empty( $cortex_loading_animation ) ) { echo get_template_directory_uri() . '/img/ajax-loader.gif'; } else { echo $cortex_loading_animation; } ?>" class="ajax_loader" data-no-retina="" alt="<?php esc_html_e( 'Loading...', 'cortex' ); ?>">
    	</div>
    </div>

    <?php } ?>

    <div id="page" <?php cortex_page_class(); ?>>

		<div class="header">

			<?php include( get_template_directory() . '/inc/topnav.php' ); ?>

	        <nav class="navbar navbar-default navbar-fixed-top<?php cortex_navigation_layout(); ?>" role="navigation" id="mainnav">
		    	<div class="nav-contain"<?php cortex_navigation_padding(); ?>>
	                <?php

	                if ( $cortex_theme_options['c9-navigation-layout'] == 'logo-left' ) {

	                    $cortex_navbar_layout = 'nav navbar-nav navbar-right';

	                } elseif ( $cortex_theme_options['c9-navigation-layout'] == 'logo-right' ) {

	                    $cortex_navbar_layout = 'nav navbar-nav navbar-left';

	                } elseif ( $cortex_theme_options['c9-navigation-layout'] == 'logo-center' ) {

	                    $cortex_navbar_layout = 'nav navbar-nav center';

	                }
	                ?>

	                <div class="container">

	                    <div class="navbar-header<?php if ( $cortex_theme_options['c9-navigation-layout'] == 'logo-right' ) { echo ' navbar-header-right'; } elseif ( $cortex_theme_options['c9-navigation-layout'] == 'logo-center' ) {echo ' navbar-header-center center';} ?>">

	                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
	                        	<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'cortex' ); ?></span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
	                        </button>

	 <?php
			// append shopping cart if enabled
			if ( $cortex_options['c9-enable-shop-nav'] == true ) {

				$count = WC()->cart->get_cart_contents_count();

				//if there are items in the cart, put a number in front of the icon
				if ( $count != 0 ) {
					echo '<div class="navbar-toggle nav-woocommerce visible-xs"><a href="' . WC()->cart->get_cart_url() . '"><span class="count">' . $count . '</span><i class="fa fa-shopping-cart fa-md"></i> <span class="sr-only">' . __('View Cart', 'cortex') . '</span></a></div>';
				} else { //if not just put in an icon
					echo '<div class="navbar-toggle nav-woocommerce visible-xs"><a href="' . WC()->cart->get_cart_url() . '"><i class="fa fa-shopping-cart fa-md"></i> <span class="sr-only">' . __('View Cart', 'cortex') . '</span></a></div>';
				} //end count check

			} //end if icons are enabled

			//append site search if enabled
			if ( $cortex_options['c9-enable-search'] == true ) {
				echo '<div class="navbar-toggle nav-search visible-xs"><a href="#" class="btn-nav-search"><i class="fa fa-search fa-md"></i> <span class="sr-only">' . __('Search', 'cortex') . '</span></a></div>';
			}
	?>
	                        <div class="logo-header">

	                            <?php
		                        $home_url =  esc_url( home_url( '/' ) );

	                            if ( ! empty( $cortex_theme_options['c9-logo'] ) ) { //logo has been uploaded
									$cortex_logo_image = $cortex_protocol. str_replace(array('http:', 'https:'), '', $cortex_theme_options['c9-logo']['url']);
	                            ?>

	                            <a class="header-image" href="<?php echo $home_url; ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" id="logo"><img src="<?php echo esc_url( $cortex_logo_image ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" <?php if ( $cortex_theme_options['c9-navigation-layout'] != 'logo-center' ) { ?> <?php } else {?> data-start="height: 50px;" data-90-start="height: 35px;" <?php } ?>></a>

	                            <?php
		                        } else { //use plain text cause no logo has been uploaded
	                            ?>

	                            <a class="header-image h4 <?php echo $cortex_theme_style; ?> mar5T" href="<?php echo $home_url; ?>" rel="home" id="logo"><?php echo esc_attr( get_bloginfo( 'name') ); ?></a>

								<?php
	                            } //end of logo
	                        	?>

	                        </div>
	                    </div><?php
	                    wp_nav_menu( array(
	                            'theme_location' 	=> 'primary',
	                            'container'      	=> 'div',
	                            'container_class'   => 'collapse navbar-collapse',
	                            'container_id'  	=> 'navbar-collapse-1',
	                            'menu_class'  		=> $cortex_navbar_layout,
	                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	                            'walker'   			=> new wp_bootstrap_navwalker(),
	                            'items_wrap' 		=> cortex_nav_end()
	                        ));
	                    ?>
	                </div><!-- /.container -->
	                <?php
	                // add a navbar bg depending on which type was selected
	                if ( $GLOBALS['cortex_navigation_type'] == 'nav1' ) { //initially transparent ?>

	                <div class="navbar-bg" data-90-start="opacity: 0;" data-120-start="opacity: .8;"></div>

	                <?php } elseif ( $GLOBALS['cortex_navigation_type'] == 'nav2' ) { //opaque ?>

	                <div class="navbar-bg-solid"></div>
	                <?php } ?>
	            </div><!--end nav-contain-->
	        </nav>

		</div><!--end header-->

        <div id="skrollr-body">
            <div id="content" class="site-content">