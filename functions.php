<?php
/**********************************************************************
* CORTEX FUNCTIONS TABLE OF CONTENTS
***********************************************************************
1.0 Set content width
2.0 Setup Wordpress defaults & features
3.0 Register Widget Areas
4.0 Customizer additions
5.0 Custom Fields Additions, Settings, Sanitization
6.0 Include Custom Fields Array
7.0 Admin specific functions
8.0 Enqueue scripts, styles, & fonts based on Customizer options
9.0 Customizations for theme style color & custom CSS
9.1 Custom template tags
9.2 Custom functions that act independently of the theme templates and widgets
10.0 Load Jetpack compatibility file
***********************************************************************/

/***********************************************************************
* 1.0 Set the content width based on the theme's design and stylesheet.
/**********************************************************************/
if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
}


/***********************************************************************
 * 2.0 Sets up theme defaults and registers support for various WordPress features.
/**********************************************************************/
if ( ! function_exists( 'cortex_setup' ) ) {
	function cortex_setup() {

		global $cortex_options;
		$cortex_theme_options = $cortex_options;

		// Make theme available for translation.
		load_theme_textdomain( 'cortex-lite', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'cortex-featured', 850, 567, array( 'center', 'center' ) );
		add_image_size( 'cortex-featured-header', 2000, 1125, array( 'center', 'center' ) );
		add_image_size( 'cortex-featured-audio', 850, 400, array( 'center', 'center' ) );
		set_post_thumbnail_size( 360, 240, false );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Main Menu', 'cortex' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Enable support for Post Formats. See http://codex.wordpress.org/Post_Formats
		add_theme_support( 'post-formats', array(
			'standard',
			'audio',
			'gallery',
			'video',
			'quote',
		) );

	}
} // endif cortex_setup
add_action( 'after_setup_theme', 'cortex_setup' );


/***********************************************************************
 * 3.0 Register Widget Areas
/**********************************************************************/
if ( ! function_exists( 'cortex_widgets_init' ) ) {
	function cortex_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Default Sidebar', 'cortex' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'The default sidebar on most templates', 'cortex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Category Sidebar', 'cortex' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'A sidebar that displays on category archives', 'cortex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Events Sidebar', 'cortex' ),
			'id'            => 'sidebar-events',
			'description'   => __( 'A sidebar that displays on single event pages', 'cortex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Short Sidebar', 'cortex' ),
			'id'            => 'cortex-short-sidebar',
			'description'   => __( 'A sidebar for a single widget to use in page builder layouts.', 'cortex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Woo Commerce Sidebar', 'cortex' ),
			'id'            => 'sidebar-woo',
			'description'   => __( 'Woo Commerce template page sidebar', 'cortex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Footer Top', 'cortex' ),
			'id'            => 'footer-top',
			'description'   => __( 'The full width widgetized area above the footer', 'cortex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Footer A', 'cortex' ),
			'id'            => 'cortex-footer-a',
			'description'   => __( 'One of four possible footer widget areas.', 'cortex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Footer B', 'cortex' ),
			'id'            => 'cortex-footer-b',
			'description'   => __( 'One of four possible footer widget areas.', 'cortex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Footer C', 'cortex' ),
			'id'            => 'cortex-footer-c',
			'description'   => __( 'One of four possible footer widget areas.', 'cortex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Footer D', 'cortex' ),
			'id'            => 'cortex-footer-d',
			'description'   => __( 'One of four possible footer widget areas.', 'cortex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	} //end function
} //end function exists?
add_action( 'widgets_init', 'cortex_widgets_init' );


/***********************************************************************
 * 4.0 Customizer Redux Framework
/**********************************************************************/
require get_template_directory() . '/admin/admin-init.php';


/***********************************************************************
* 7.0 Admin specific functions
/**********************************************************************/
require( get_template_directory() . '/admin/admin.php' );

if ( is_admin() ) {
	require( get_template_directory() . '/admin/admin-editor.php' );
	require_once( get_template_directory() . '/admin/tgm/tgm-init.php' );
}

/***********************************************************************
* 8.0 Enqueue scripts and styles. (and google fonts)
/**********************************************************************/
global $cortex_options;
$cortex_theme_options = $cortex_options;

if ( ! function_exists( 'cortex_scripts' ) ) {
	function cortex_scripts() {

		global $cortex_options;

		// grab theme options
		$cortex_theme_options   = $cortex_options;

		// check for rtl support include regular bootstrap by default
		if ( $cortex_theme_options['c9-rtl-support'] === true ) {
			wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/css/bootstrap.rtl.min.css' );
		} else {
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
		}

		// queue stylesheets, font-specific styles, & custom CSS into header
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
		wp_enqueue_style( 'jquery-flexslider', get_template_directory_uri() . '/css/flexslider.css' );
		wp_enqueue_style( 'cortex-style', get_template_directory_uri() . '/style.css' );

		// queue animation CSS if enabled
		if ( $cortex_theme_options['c9-animation'] == true ) {
			wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array(), '', true );
			wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css' );
		}

		// queue light or dark style
		if ( $cortex_theme_options['c9-theme-style'] == 'light' ) {
			wp_enqueue_style( 'cortex-style-light', get_template_directory_uri() . '/css/style-light.css', array( 'cortex-style' ) );
			add_editor_style( get_template_directory_uri() . '/css/style-light.css' );

		} else { //dark style

			wp_enqueue_style( 'cortex-style-dark', get_template_directory_uri() . '/css/style-dark.css', array( 'cortex-style' ) );
			add_editor_style( get_template_directory_uri() . '/css/style-dark.css' );

		}

		// check for rtl support include rtl css
		if ( $cortex_theme_options['c9-rtl-support'] == true ) {
			wp_enqueue_style( 'cortex-rtl', get_template_directory_uri() . '/rtl.css', array( 'cortex-style' ) );
			add_editor_style( get_template_directory_uri() . '/rtl.css' );
		}

		// add user typography CSS style based on theme options, or use a default
		$css_file = cortex_get_css_path();
		if (file_exists($css_file)) { //user generated css

			/* bulid the proper url */
			$upload_url     = content_url() . '/uploads/';
			$theme 			= wp_get_theme();
			$theme_name     = strtolower( $theme->get( 'Name' ) );

		    wp_enqueue_style ( 'cortex-typography', $upload_url . $theme_name . '/typography.css', array( 'cortex-style' ) );

		} else { //default css

		    // enqueue the default file included with your theme.
		    wp_enqueue_style ( 'cortex-typography', get_template_directory_uri() . '/css/typography.css', array ( 'cortex-style' ) );

		}

		// queue JS
		wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), '', true );
		wp_enqueue_script( 'cortex-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '', true );
		wp_enqueue_script( 'boostrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '', true );
		wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), '', true );
		wp_enqueue_script( 'imagesloaded-js', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), '', true );
		wp_enqueue_script( 'magnific-js', get_template_directory_uri() . '/js/magnific.js', array(), '', true );
		wp_enqueue_script( 'skrollr-js', get_template_directory_uri() . '/js/skrollr.min.js', array(), '', true );
		wp_enqueue_script( 'classie-js', get_template_directory_uri() . '/js/classie.js', array(), '', true );
		wp_enqueue_script( 'modernizr-js', get_template_directory_uri() . '/js/modernizr.min.js', array(), '', true );
		wp_enqueue_script( 'cortex-js', get_template_directory_uri() . '/js/main.js', array(), '', true );
		wp_enqueue_script( 'skrollr-init-js', get_template_directory_uri() . '/js/skrollr-init.js', array(), '', true );

		// add required comment reply js
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'cortex_scripts', 30 );


/***********************************************************************
* 9.0 Customizations for theme style color & custom CSS
/**********************************************************************/
if ( ! function_exists( 'cortex_user_custom_css' ) ) {
	function cortex_user_custom_css() {

		// grab theme options
		global $cortex_options;
		$cortex_theme_options		  = $cortex_options;
		$cortex_options_custom_css    = $cortex_options['c9-custom-css'];

		// queue light or dark style custom CSS
		if ( $cortex_theme_options['c9-theme-style'] == 'light' ) {

			// Sets any Cortex custom colors from the customizer if they've been set and load them after everything
			include( get_template_directory() . '/inc/cortex-colors-light.php' );

		} else {

			// Sets any Cortex custom colors from the customizer if they've been set and load them after everything
			include( get_template_directory() . '/inc/cortex-colors-dark.php' );

		} //endif dark or light style
	} //end cortex_user_custom_css
} //end if function exists
add_action( 'wp_enqueue_scripts', 'cortex_user_custom_css', 30 );


/***********************************************************************
* 9.1 Custom template tags
/**********************************************************************/
require( get_template_directory() . '/inc/template-tags.php' );


/***********************************************************************
* 9.2 Custom functions that act independently of the theme templates and widgets
/**********************************************************************/
require( get_template_directory() . '/inc/extras.php' );
require( get_template_directory() . '/inc/wp_bootstrap_navwalker.php' );


/***********************************************************************
* 10.0 Load Jetpack compatibility file
/**********************************************************************/
require( get_template_directory() . '/inc/jetpack.php' );
