<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "cortex_options";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'cortex_options',
        'disable_tracking' => true,
        'customizer_only'	=> true,
        'database'		=> 'theme_mods',
        'dev_mode' => false,
        'use_cdn' => FALSE,
        'display_name' => 'Cortex Lite Options',
        'display_version' => '1.0',
        'page_slug' => 'cortex-options',
        'page_title' => 'Cortex Options',
        'update_notice' => FALSE,
        'intro_text' => 'Options to customize the Cortex Lite WordPress theme. Ready to go big time? Get the premium version at http://cortex.covertnine.com',
        'footer_text' => '',
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'Cortex Lite Options',
        'allow_sub_menu' => TRUE,
        'page_parent' => 'themes.php',
        'customizer' => TRUE,
        'default_mark' => '*',
        'class' => 'cortex-redux',
        'google_api_key'	=> 'AIzaSyD91mWMwbsSdu-kQtQdYT1xDwEV2goiCcE',
        'google_update_weekly'	=> TRUE,
        'async_typography'	=> TRUE,
        'hints' => array(
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'menu_icon' => get_template_directory_uri() . '/img/cortex-logo-icon-wp-menu-nav.png',
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => false,
        'show_import_export' => TRUE,
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/covertnine',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/covertnine',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/covertnine',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Cortex Defaults', 'cortex' ),
        'id'         => 'c9-cortex-defaults-subsection',
        'icon'  => 'el el-dashboard',
        'fields'     => array(
            array(
                'id'       => 'c9-theme-style',
                'type'     => 'radio',
                'title'    => __( 'Theme Base Style', 'cortex' ),
                'options'  => array(
	                'dark' => 'Dark',
	                'light' => 'Light',
                ),
                'default' => 'dark'
            ),
            array(
                'id'       => 'c9-page-sidebar',
                'type'     => 'image_select',
                'title'    => __( 'Default Page Sidebar Location', 'cortex' ),
                'options'  => array(
	                'sidebar-left' => array(
	                	'alt'		=>		'Left',
	                	'img'		=>		ReduxFramework::$_url . 'assets/img/sidebar-left.png',
	                ),
	                'sidebar-right' => array(
	                	'alt'		=>		'Right',
	                	'img'		=>		ReduxFramework::$_url . 'assets/img/sidebar-right.png',
	                ),
	                'sidebar-none' => array(
	                	'alt'		=>		'No sidebar',
	                	'img'		=>		ReduxFramework::$_url . 'assets/img/sidebar-none.png',
	                )
                ),
                'default' => 'sidebar-right'
            ),
            array(
                'id'       => 'c9-post-sidebar',
                'type'     => 'image_select',
                'title'    => __( 'Default Post Sidebar Location', 'cortex' ),
                'options'  => array(
	                'sidebar-left' => array(
	                	'alt'		=>		'Left',
	                	'img'		=>		ReduxFramework::$_url . 'assets/img/sidebar-left.png',
	                ),
	                'sidebar-right' => array(
	                	'alt'		=>		'Right',
	                	'img'		=>		ReduxFramework::$_url . 'assets/img/sidebar-right.png',
	                ),
	                'sidebar-none' => array(
	                	'alt'		=>		'No sidebar',
	                	'img'		=>		ReduxFramework::$_url . 'assets/img/sidebar-none.png',
	                )
                ),
                'default' => 'sidebar-right'
            ),
            array(
	        	'id'		=> 'c9-enable-search',
	        	'type'		=> 'switch',
	        	'title'		=> __('Enable the search on the main navigation?', 'cortex'),
	        	'default'	=> true,
            ),
	        array(
		    	'id'		=> 'c9-enable-shop-nav',
		    	'type'		=> 'switch',
		    	'title'		=> __('Enable WooCommerce shop icon on the main navigation?', 'cortex'),
		    	'default'	=> false
	        ),
            array(
                'id'       => 'c9-author-info',
                'type'     => 'switch',
                'title'    => __( 'Enable the author box on single posts?', 'cortex' ),
                'default' => true,
            ),
            array(
                'id'       => 'c9-rtl-support',
                'type'     => 'switch',
                'title'    => __( 'Enable right to left text support?', 'cortex' ),
                'default' => false
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Branding', 'cortex' ),
        'id'         => 'c9-branding-subsection',
        'icon'   => 'el el-cogs',
        'fields'     => array(
            array(
                'id'       => 'c9-logo',
                'type'     => 'media',
                'title'    => __( 'Logo', 'cortex' ),
                'url'		=> true,
                'subtitle' => __( 'Displayed at the top of every page.', 'cortex' ),
                'desc'     => __( 'Recommended 50 pixels high by any width at 144dpi', 'cortex' ),
                'default'  => array(
	                'url'		=> get_template_directory_uri() . '/img/cortex@2x.png'
                ),
            ),
            array(
                'id'       => 'c9-touch-icon',
                'type'     => 'media',
                'title'    => __( 'Apple Touch Icon', 'cortex' ),
                'url'		=> true,
                'subtitle' => __( '180x180 pixels at 144dpi', 'cortex' ),
                'default'  => array(
	                'url'		=> ''
                ),
            ),
            array(
	        	'id'		=> 'c9-enable-preloader',
	        	'type'		=> 'switch',
	        	'title'		=> __( 'Enable the preloading screen?', 'cortex'),
	        	'subtitle'	=> __( 'Covers the site content while images and fonts are loading', 'cortex'),
	        	'default'	=> true
            ),
            array(
                'id'        => 'c9-loading-image',
                'type'      => 'media',
                'title'     => __( 'Preloading Logo Image', 'cortex' ),
                'url'		=> true,
                'subtitle'  => __( '144dpi recommended', 'cortex' ),
                'required'	=> array('c9-enable-preloader', '=', true),
                'default'   => array(
	                'url'		=> get_template_directory_uri() . '/img/cortex@2x.png'
                ),
            ),
            array(
                'id'       => 'c9-loading-animation',
                'type'     => 'media',
                'title'    => __( 'Preloading Animation', 'cortex' ),
                'url'		=> true,
                'required'	=> array('c9-enable-preloader', '=', true),
                'default'  => array(
	                'url'		=> get_template_directory_uri() . '/img/ajax-loader.gif'
                ),
            ),

            array(
                'id'       => 'c9-animation',
                'type'     => 'switch',
                'title'    => __( 'Enable animation.css?', 'cortex' ),
                'default' => true
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Colors', 'cortex' ),
        'desc'   => __( 'Cortex has default colors setup already, but you can overwrite all of them with the following settings, or you can use a child theme and overwrite them that way.', 'cortex' ),
        'id'         => 'c9-colors-subsection',
        'icon'		 => 'el el-brush',
        'fields'     => array(
            array(
                'id'       => 'c9-accent-color',
                'type'     => 'color',
                'title'    => __( 'Accent Color', 'cortex' ),
                'subtitle' => __( 'Headline decorations, hovers, bullets, icons, background overlays, subheadings, button text hovers', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-body-color',
                'type'     => 'color',
                'title'    => __( 'Body Text Color', 'cortex' ),
                'subtitle' => __( 'Color for text within the body', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-body-link-color',
                'type'     => 'color',
                'title'    => __( 'Body Text Link Color', 'cortex' ),
                'subtitle' => __( 'Color for text links within the body', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-nav-link',
                'type'     => 'color',
                'title'    => __( 'Navigation Link Color', 'cortex' ),
                'subtitle' => __( 'Text link colors in main navigation', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-nav-dropdown-link',
                'type'     => 'color',
                'title'    => __( 'Navigation Dropdown Link Color', 'cortex' ),
                'subtitle' => __( 'Text link colors in main navigation dropdown menus', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-first-color',
                'type'     => 'color',
                'title'    => __( 'First Color', 'cortex' ),
                'subtitle' => __( 'Meta links under posts', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-second-color',
                'type'     => 'color',
                'title'    => __( 'Second Color', 'cortex' ),
                'subtitle' => __( 'Form field labels, Twitter widget date links, single page event dates, addresses, and headliners', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-third-color',
                'type'     => 'color',
                'title'    => __( 'Third Color', 'cortex' ),
                'subtitle' => __( 'Table headings, table borders, Twitter widget text color, footer links, main navigation labels, post meta type accents, previous events link', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-dark-color',
                'type'     => 'color',
                'title'    => __( 'Dark Color', 'cortex' ),
                'subtitle' => __( 'Button Hover Color, dark color for use in WP Editor', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-light-color',
                'type'     => 'color',
                'title'    => __( 'Light Color', 'cortex' ),
                'subtitle' => __( 'Subscribe widget icon color, light color for use in WP Editor', 'cortex' ),
                'default'  => '',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Typography', 'cortex' ),
        'id'         => 'c9-typography-subsection',
        'icon'		 => 'el el-fontsize',
        'fields'     => array(
	        array(
            'id'      		 => 'c9-headline-font',
            'type'    		 => 'typography',
            'title'   		 => __( 'Heading Font', 'cortex' ),
            'subtitle'		 => __( 'Google Font to be used for headlines', 'cortex' ),
            'google'		 => true,
            'font-backup'	 => true,
            'units'			=> 'px',
            'text-transform'	=> true,
            'letter-spacing'	=> true,
            'word-spacing'		=> true,
            'color'				=> false,
			'text-align'		=> false,
            'font-size'			=> false,
            'line-height'		=> false,
            'all_styles'		=> true,
            'preview'			=> array(
	            'text'				=> __('The quick brown fox jumped over the big doggy woggy', 'cortex'),
	            'font-size'			=> '24px',
	            'always_display'	=> true
            ),
            'compiler'			=> array('.headline-font,.widget_calendar #wp-calendar tr th,.shop_table tr th,h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,.widget_calendar #wp-calendar tr td,.widget_calendar #wp-calendar caption,.widget_cortex_twitter_widget .twitter-tweet ul li,.widget h1,.widget h2,.widget h3,.widget-cortex-instagram .clear a,.small-link,.comment-reply-link,.comment-author .fn,.comment-author .fn .url,.comment-metadata a,.author-social li a,.nav-links .page-numbers,.nav-links .nav-previous,.nav-links .nav-next,.woocommerce nav.woocommerce-pagination .page-numbers,.content-single .entry-header .entry-header-standard-wrapper .entry-header-standard .entry-header-standard-inner h1,blockquote:before,.site-info,.caption-bottom .tp-caption a,.content-area .site-main .masonry_portfolio .container .isotope-item .masonry_portfolio_sub_heading,.blog_latest .blog_latest_title h3,.content-area .site-main .masonry_project .isotope-item .masonry_project_sub_heading,.action-link, table tr th, -cortex-h1, .footer-container .widget_nav_menu ul li a, #footer-top .widget_nav_menu ul li a,.c9-footer-full-width .widget_nav_menu ul li a'),
			'default' 			=> array(
				'font-style'		=> '700',
				'font-family' 		=> 'Montserrat',
				'google'			=> true,
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1'
				),
			), //end headline font option
	        array(
            'id'     	  	 => 'c9-subheading-font',
            'type'   		 => 'typography',
            'title'  	 	 => __( 'Subheading Font', 'cortex' ),
            'subtitle'	 	 => __( 'Google Font to be used for subheadings, main navigation, and buttons', 'cortex' ),
            'google'	 	 => true,
            'font-backup'	 => true,
            'units'			 => 'px',
           	'text-align'		=> false,
            'text-transform'	=> true,
            'letter-spacing'	=> true,
            'word-spacing'		=> true,
            'color'				=> false,
            'font-size'			=> false,
            'line-height'		=> false,
            'all_styles'		=> true,
            'preview'			=> array(
	            'text'				=> __('The quick brown fox jumped over the big doggy woggy', 'cortex'),
	            'font-size'			=> '24px',
	            'always_display'	=> true
            ),
			'compiler'			=> array('.secondary-font,input[type="submit"],#submit,.woocommerce .button.add_to_cart_button,.woocommerce #content button,.entry-content .btn.light-color-text.cortex_the_excerpt:visited,.entry-content .btn.light-color-text.cortex_the_excerpt,.cortex-woocommerce .woocommerce-tabs .tabs > li a,button,input[type="button"],input[type="reset"],input[type="submit"],.button.button.alt,.woocommerce div.product form.cart .button,.woocommerce #content .button,.widget_search .search-submit,.content-single .entry-header .entry-header-standard-wrapper .entry-header-standard .entry-header-standard-inner .h5 .posted-on a,.navbar-default .navbar-collapse .nav li a,.tp-button,.category .masonry_posts .isotope-item .masonry_portfolio_heading,.blog_latest .blog_latest_title .subtitle,.subtitle,.project_masonry_description,.events_description,.content-area .site-main .masonry_project .isotope-item h3 .masonry_project_heading,.woocommerce .buttons .button,.woocommerce .sidebar .buttons .button,.woocommerce .sidebar .buttons .button,.woocommerce form .button,.woocommerce .buttons .button.wc-forward,.woocommerce .sidebar .button.wc-forward,.woocommerce .sidebar .button.wc-forward,.content-area .site-main .masonry_portfolio .container .isotope-item .masonry_portfolio_heading, .category .masonry_posts .isotope-item .masonry_portfolio_heading,.entry-content .nav-tabs > li a, .cortex-woocommerce .woocommerce-tabs .tabs > li a,.entry-content .nav-tabs > li a, .cortex-woocommerce .woocommerce-tabs .tabs > li a, .dropdown-header, .woocommerce #review_form #respond .form-submit #submit, .woocommerce a.button, .woocommerce .button, .subheading.h1, .subheading.h2, .subheading.h3, .subheading.h4, .subheading.h5, .subheading.h6, .navbar .dropdown-header, .dropdown-header, .navbar-default .navbar-collapse .nav.center .dropdown-header, .-cortex-h2,.-cortex-h3,.-cortex-h4,.-cortex-h5,.-cortex-h6, .btn'),
				'default' => array(
				'font-weight'		=> '300',
				'font-family' 		=> 'Oswald',
				'google'			=> true,
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1'
				),
			), //end subheading font option
	        array(
            'id'       		=> 'c9-body-font',
            'type'     		=> 'typography',
            'title'    		=> __( 'Body Font', 'cortex' ),
            'subtitle' 		=> __( 'Google Font to be used for body text', 'cortex' ),
            'google'		=> true,
            'font-backup'	=> true,
            'units'			=> 'px',
            'text-transform'	=> true,
            'letter-spacing'	=> true,
            'word-spacing'		=> true,
			'text-align'		=> false,
            'color'				=> false,
            'font-size'			=> false,
            'line-height'		=> false,
            'all_styles'		=> true,
            'preview'			=> array(
	            'text'				=> __('The quick brown fox jumped over the big doggy woggy', 'cortex'),
	            'font-size'			=> '16px',
	            'always_display'	=> true
            ),
            'compiler'			=> array('body, input, select, textarea, .input__field, .widget-cortex-about p, .entry-meta, .entry-content blockquote p, blockquote p'),
			'default' => array(
				'font-style'		=> '400',
				'font-family' 		=> 'Roboto Slab',
				'google'			=> true,
				'text-transform'	=> 'none'
				),
			), //end body font option
		) //end fields array
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Background', 'cortex' ),
        'id'         => 'c9-background-subsection',
        'icon'		 => 'el el-website',
        'fields'     => array(
            array(
                'id'       => 'c9-background',
                'type'     => 'background',
                'title'    => __( 'Background', 'cortex' ),
                'subtitle' => __( 'Select a color, image, or pattern to be used as the universal site background. This can be overwritten on some pages.', 'cortex' ),
                'default'  => '',
				'output'	=>	array ( 'body' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header', 'cortex' ),
        'id'         => 'c9-header-subsection',
        'icon'		 => 'el el-website',
        'fields'     => array(
            array(
                'id'       => 'c9-navigation-type',
                'type'     => 'radio',
                'title'    => __( 'Navigation Type', 'cortex' ),
                'subtitle' => __( 'Select the default navigation type. Can be overwritten on some pages.', 'cortex' ),
                'options'	=> array(
	                'nav1'	=> __('Transparent Background', 'cortex'),
	                'nav2'	=> __('Opaque Background', 'cortex'),
                ),
                'default'	=> 'nav1'
            ),
            array(
                'id'       => 'c9-nav-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Main Navigation Background Color', 'cortex' ),
                'subtitle' => __( 'For the opaque navigation background and the transparent navigation after scrolling down', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-nav-dropdown-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Main Navigation Dropdown Background Color', 'cortex' ),
                'subtitle' => __( 'For the dropdown menus', 'cortex' ),
                'default'  => '',
            ),
            array(
	            'id'				=> 'c9-navigation-layout',
	            'type'				=> 'image_select',
	            'title'				=> __('Navigation Layout', 'cortex'),
	            'subtitle'			=> __('Choose the header navigation layout', 'cortex'),
	            'options'			=> array(
					'logo-left' 	=> array(
						'alt'		=> __('Logo Left', 'cortex'),
						'img'		=> ReduxFramework::$_url . 'assets/img/logo-left.png',
					),
					'logo-right'	=> array(
						'alt'		=> __('Logo Right', 'cortex'),
						'img'		=> ReduxFramework::$_url . 'assets/img/logo-right.png',
					),
					'logo-center'	=> array(
						'alt'		=> __('Logo Center', 'cortex'),
						'img'		=> ReduxFramework::$_url . 'assets/img/logo-center.png',
					)
				),
				'default'			=> 'logo-left'
			), //end single field
			array(
				'id'				=> 'c9-enable-topnav',
				'type'				=> 'switch',
				'title'				=> __('Enable top row?', 'cortex'),
				'subtitle'			=> __('Have a second row above the main navigation and logo for additional contact information?', 'cortex'),
				'default'			=> false
			),
			array(
				'id'				=> 'c9-enable-topnav-mobile',
				'type'				=> 'switch',
				'title'				=> __('Enable top row on mobile?', 'cortex'),
				'default'			=> false,
	            'required'			=> array('c9-enable-topnav', 'equals', true),
			),
            array(
	            'id'		=> 'c9-topnav-text-color',
	            'type'		=> 'radio',
	            'title'		=> __('Top row text color', 'cortex'),
	            'options'	=> array(
		            'dark-color-text'	=> __('Dark', 'cortex'),
		            'light-color-text'	=> __('Light', 'cortex'),
	            ),
	            'required'	=> array('c9-enable-topnav', 'equals', true),
	            'default'	=> 'light-color-text'
            ),
            array(
                'id'       => 'c9-topnav-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Top row background color', 'cortex' ),
                'subtitle' => __( 'For the opaque top row background and the transparent navigation after scrolling down', 'cortex' ),
	            'required'			=> array('c9-enable-topnav', 'equals', true),
                'default'  => '',
            ),
            array(
	            'id'		=> 'c9-topnav-address',
	            'type'		=> 'text',
	            'title'		=> __('Address', 'cortex'),
	            'subtitle'	=> __('Enter in address to appear in top row', 'cortex'),
	            'default'	=> __('200 S. State St. Chicago, IL', 'cortex'),
	            'required'			=> array('c9-enable-topnav', 'equals', true),
            ),
            array(
	            'id'		=> 'c9-topnav-map-link',
	            'type'		=> 'text',
	            'title'		=> __('Maps link', 'cortex'),
	            'subtitle'	=> __('Enter the Google Maps link for your address', 'cortex'),
	            'default'	=> __('https://www.google.com/maps/place/200+S+State+St,+Chicago,+IL+60604/data=!4m2!3m1!1s0x880e2ed6f74e2b29:0x583da66a59297dae?sa=X&ved=0ahUKEwiz1u-a6dXOAhVCymMKHRulA1cQ8gEIGzAA', 'cortex'),
	            'required'			=> array('c9-enable-topnav', 'equals', true),
            ),
            array(
	            'id'		=> 'c9-topnav-phone',
	            'type'		=> 'text',
	            'title'		=> __('Phone', 'cortex'),
	            'subtitle'	=> __('Enter in the contact phone number to appear in top row.', 'cortex'),
	            'default'	=> __('312.970.0000', 'cortex'),
	            'required'			=> array('c9-enable-topnav', 'equals', true),
            ),
            array(
	            'id'		=> 'c9-topnav-email',
	            'type'		=> 'text',
	            'title'		=> __('Email', 'cortex'),
	            'subtitle'	=> __('Enter in the contact email if you\'d like one to appear in the top row.', 'cortex'),
	            'default'	=> __('contact@gmail.com', 'cortex'),
	            'required'			=> array('c9-enable-topnav', 'equals', true),
            ),
   		) //end fields
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Footer', 'cortex' ),
        'id'         => 'c9-footer-subsection',
        'icon'		 => 'el el-website',
        'fields'     => array(
            array(
                'id'       => 'c9-footer-background',
                'type'     => 'background',
                'title'    => __( 'Footer Background', 'cortex' ),
                'subtitle' => __( 'Select a color, image, or pattern for the background to the footer.', 'cortex' ),
                'default'  => '',
                'output'	=> '.footer-container'
            ),
            array(
	            'id'		=> 'c9-footer-layout',
	            'type'		=> 'image_select',
	            'title'		=> __( 'Footer Layout', 'cortex' ),
	            'subtitle'	=> __( 'Choose the footer layout you\'d prefer. Depending on your selection, widgets can be assigned to any of the 4 widget areas. There is also one widget area for just above the footer.', 'cortex' ),
	            'options'			=> array(
					'layout1' 	=> array(
						'alt'		=> __('Footer Layout 1', 'cortex'),
						'img'		=> ReduxFramework::$_url . 'assets/img/3x1.png',
					),
					'layout2'	=> array(
						'alt'		=> __('Footer Layout 2', 'cortex'),
						'img'		=> ReduxFramework::$_url . 'assets/img/4x1.png',
					),
					'layout3'	=> array(
						'alt'		=> __('Footer Layout 3', 'cortex'),
						'img'		=> ReduxFramework::$_url . 'assets/img/2x2.png',
					)
				),
	            'default'	=> 'layout1',
            ),
            array(
	            'id'		=> 'c9-footer-headings',
	            'type'		=> 'switch',
	            'title'		=> __( 'Enable headings for each widget?', 'cortex' ),
	            'subtitle'	=> __( 'By default, titles you choose for each widget from the Appearance > Widgets part of the admin will display above the widgets. You can disable these if you prefer.', 'cortex' ),
	            'default'	=> true,
            ),
            array(
	            'id'		=> 'c9-footer-copyright',
	            'type'		=> 'text',
	            'title'		=> __('Copyright', 'cortex'),
	            'subtitle'	=> __('Enter in the copyright text. Supports some HTML. This goes below the footer widget area and has the same background as the footer you set above.', 'cortex'),
	            'default'	=> __('&copy; 2016 COVERT NINE. All Rights Reserved', 'cortex'),
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Social Icons', 'cortex' ),
        'id'         => 'c9-social-icons-subsection',
        'icon'   => 'el el-group',
        'fields'     => array(
            array(
                'id'       => 'c9-enable-social',
                'type'     => 'switch',
                'title'    => __( 'Enable Fixed Social Icons?', 'cortex' ),
                'default'  => false,
            ),
            array(
	        	'id'		=> 'c9-icon-type',
	        	'type'		=> 'radio',
	        	'title'		=> __('Select Icon Type', 'cortex'),
	        	'options'	=> array(
		        	'normal'	=> __('Normal', 'cortex'),
		        	'square'	=> __('Square', 'cortex'),
	        	),
	        	'required'	=> array('c9-enable-social', 'equals', true),
	        	'default'	=> 'normal'
            ),
            array(
	            'id'		=> 'c9-icon-color',
	            'type'		=> 'radio',
	            'title'		=> __('Select Icon Color', 'cortex'),
	            'options'	=> array(
		            'dark'	=> __('Dark', 'cortex'),
		            'light'	=> __('Light', 'cortex'),
	            ),
	            'required'	=> array('c9-enable-social', 'equals', true),
	            'default'	=> 'light'
            ),
            array(
	            'id'		=> 'c9-icon-position',
	            'type'		=> 'image_select',
	            'title'		=> __('Select the icon position on screen', 'cortex'),
	            'subtitle'	=> __('Icons are hidden on mobile', 'cortex'),
	            'options'	=> array(
		            'upper-left' => array(
			            	'alt'	=> __('Upper Left', 'cortex'),
							'img'	=> ReduxFramework::$_url . 'assets/img/social-upper-left.png'
							),
					'upper-right' => array(
							'alt'	=> __('Upper Right', 'cortex'),
							'img'	=> ReduxFramework::$_url . 'assets/img/social-upper-right.png'
							),
					'lower-left' => array(
							'alt'	=> __('Lower Left', 'cortex'),
							'img'	=> ReduxFramework::$_url . 'assets/img/social-lower-left.png'
							),
					'lower-right' => array(
							'alt'	=> __('Lower Right', 'cortex'),
							'img'	=> ReduxFramework::$_url . 'assets/img/social-lower-right.png'
							),
	            ),
	            'required'	=> array('c9-enable-social', 'equals', true),
	            'default'	=> 'lower-left'
            ), //end icon position
            array(
	            'id'	=> 'c9-icon-facebook',
	            'type'	=> 'text',
	            'title' => __('Facebook Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-twitter',
	            'type'	=> 'text',
	            'title' => __('Twitter Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-instagram',
	            'type'	=> 'text',
	            'title' => __('Instagram Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-googleplus',
	            'type'	=> 'text',
	            'title' => __('Google+ Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-flickr',
	            'type'	=> 'text',
	            'title' => __('Flickr Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-mailchimp',
	            'type'	=> 'text',
	            'title' => __('MailChimp Form Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-youtube',
	            'type'	=> 'text',
	            'title' => __('YouTube Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-tumblr',
	            'type'	=> 'text',
	            'title' => __('Tumblr Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-yelp',
	            'type'	=> 'text',
	            'title' => __('Yelp Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-lastfm',
	            'type'	=> 'text',
	            'title' => __('Last.fm Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-pinterest',
	            'type'	=> 'text',
	            'title' => __('Pinterest Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-reddit',
	            'type'	=> 'text',
	            'title' => __('Reddit Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-linkedin',
	            'type'	=> 'text',
	            'title' => __('LinkedIn Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-googlemaps',
	            'type'	=> 'text',
	            'title' => __('Google Maps Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-github',
	            'type'	=> 'text',
	            'title' => __('GitHub Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-soundcloud',
	            'type'	=> 'text',
	            'title' => __('SoundCloud Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
            array(
	            'id'	=> 'c9-icon-deviantart',
	            'type'	=> 'text',
	            'title' => __('DeviantArt Link', 'cortex'),
	            'required'	=> array('c9-enable-social', 'equals', true),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'E-Commerce', 'cortex' ),
        'id'         => 'c9-e-commerce-subsection',
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
            array(
                'id'       => 'c9-shop-sidebar',
                'type'     => 'image_select',
                'title'    => __( 'Default Shop Sidebar Location', 'cortex' ),
                'options'  => array(
	                'sidebar-left' => array(
	                	'alt'		=>		'Left',
	                	'img'		=>		ReduxFramework::$_url . 'assets/img/sidebar-left.png',
	                ),
	                'sidebar-right' => array(
	                	'alt'		=>		'Right',
	                	'img'		=>		ReduxFramework::$_url . 'assets/img/sidebar-right.png',
	                ),
	                'sidebar-none' => array(
	                	'alt'		=>		'No sidebar',
	                	'img'		=>		ReduxFramework::$_url . 'assets/img/sidebar-none.png',
	                )
                )
            ),
            'default' => 'sidebar-right'
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => __( 'Analytics', 'cortex' ),
        'id'     => 'c9-analytics',
        'desc'   => __( 'Add Google Analytics Tracking.', 'cortex' ),
        'icon'   => 'el el-graph',
        'fields' => array(
            array(
                'id'       => 'c9-analytics-js',
                'type'     => 'ace_editor',
                'title'    => __( 'Google Analytics', 'cortex' ),
                'desc'     => __( 'Copy/paste the full Google Analytics tracking code.', 'cortex' ),
                'mode'		=> 'javascript'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Advanced', 'cortex' ),
        'id'     => 'c9-advanced',
        'desc'   => __( 'Customize the look and feel with basic Javascript or CSS.', 'cortex' ),
        'icon'   => 'el el-asterisk',
        'fields' => array(
            array(
                'id'       => 'c9-custom-js',
                'type'     => 'ace_editor',
                'title'    => __( 'Custom Javascript', 'cortex' ),
                'desc'     => __( 'No need to enter the &lt;script type="text/javascript"&gt; and &lt;/script&gt; tags.', 'cortex' ),
                'mode'		=> 'javascript'
            ),
            array(
                'id'       => 'c9-custom-css',
                'type'     => 'ace_editor',
                'title'    => __( 'Custom CSS', 'cortex' ),
                'desc'     => __( 'No need to enter any &lt;style type="text/css"&gt; or &lt;/style&gt; tags.', 'cortex' ),
                'mode'		=> 'css'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'API Integrations', 'cortex' ),
        'id'    => 'c9-api-integrations',
        'desc'  => __( 'Enter in API Keys to plug in to your Twitter timeline and Mail Chimp email lists.', 'cortex' ),
        'icon'  => 'el el-key'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Twitter API', 'cortex' ),
        'desc'       => __( 'Get your own Twitter API key by signing up for an account at <a href="http://dev.twitter.com">dev.twitter.com</a>.', 'cortex'),
        'id'         => 'c9-api-subsection-twitter',
        'icon'		 => 'el el-twitter',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'c9-consumer-key',
                'type'     => 'text',
                'title'    => __( 'Twitter Consumer Key', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-consumer-secret',
                'type'     => 'text',
                'title'    => __( 'Twitter Consumer Secret', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-access-token',
                'type'     => 'text',
                'title'    => __( 'Twitter Access Token', 'cortex' ),
                'default'  => '',
            ),
            array(
                'id'       => 'c9-access-token-secret',
                'type'     => 'text',
                'title'    => __( 'Twitter Token Secret', 'cortex' ),
                'default'  => '',
            ),
        )
    ));
    Redux::setSection( $opt_name, array(
        'title'      => __( 'MailChimp API', 'cortex' ),
        'desc'       => __( 'Get your MailChimp API key under Profile > Extras > API Keys after logging in on <a href="http://www.mailchimp.com">MailChimp.com</a>.', 'cortex'),
        'id'         => 'c9-api-subsection-mailchimp',
        'icon'		 => 'el el-envelope',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'c9-mailchimp-api-key',
                'type'     => 'text',
                'title'    => __( 'MailChimp Key', 'cortex' ),
                'default'  => '',
            ),
        )
    ));

    /*
     * <--- END SECTIONS
     */

function cortex_css_compiler_action($options, $css, $changed_values) {

    $css_file = cortex_get_css_path();

    // Get current Redux instance so we have access to the filesystem object
    $instance = ReduxFrameworkInstances::get_instance('cortex_options');

    // Write the CSS returned in the compiler to the file.
    $instance->filesystem->execute('put_contents', $css_file, array('content' => $css));

}
add_filter('redux/options/' .$args['opt_name']. '/compiler', 'cortex_css_compiler_action', 10, 3);

function cortex_removeDemoModeLink() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action('init', 'cortex_removeDemoModeLink');

/** remove redux menu under the tools **/
function cortex_remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}
add_action( 'admin_menu', 'cortex_remove_redux_menu', 12 );