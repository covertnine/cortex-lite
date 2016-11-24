<?php
global $cortex_options;

// get any color customizations
$cortex_colors = array();
$cortex_colors['accent_color']   			 = $cortex_options['c9-accent-color'];
$cortex_colors['headline_color']    		 = $cortex_options['c9-first-color'];
$cortex_colors['body_color']    			 = $cortex_options['c9-body-color'];
$cortex_colors['body_link_color']   		 = $cortex_options['c9-body-link-color'];
$cortex_colors['secondary_color']    		 = $cortex_options['c9-second-color'];
$cortex_colors['third_color']    			 = $cortex_options['c9-third-color'];
$cortex_colors['dark_color']    			 = $cortex_options['c9-dark-color'];
$cortex_colors['light_color']    			 = $cortex_options['c9-light-color'];
$cortex_colors['cortex_nav_bg']  			 = $cortex_options['c9-nav-bg']['rgba'];
$cortex_colors['cortex_nav_dropdown_bg']  	 = $cortex_options['c9-nav-dropdown-bg']['rgba'];
$cortex_colors['cortex_nav_link']  			 = $cortex_options['c9-nav-link'];
$cortex_colors['cortex_nav_dropdown_link']   = $cortex_options['c9-nav-dropdown-link'];
$cortex_colors['c9-topnav-bg']				 = $cortex_options['c9-topnav-bg']['rgba'];

$cortex_theme_options = $cortex_options;

// check to see if colors have been customized, if so, print CSS
if ( array_filter($cortex_colors) ) {

	$cortex_custom_css = '
/****************************************
dark cortex color styling
****************************************/';

	if ( ! empty( $cortex_colors['accent_color'] ) ) {

		$cortex_custom_css .= "
/****************************************
accent color styling
****************************************/
.btn.btn-default, .alternate:after, hr, .btn-default, input[type=\"submit\"], #submit, .accent-color, button, input[type=\"button\"], input[type=\"reset\"], .widget_search .search-submit, .nav-links .page-numbers, .single-social-share li a, .comment-list .comment article .reply a:after, .tp-button.red, .accent-color-bg, .tp-button, .flex-control-paging li a:hover, .flex-control-paging li a.flex-active, .btn.light-color-text.cortex_the_excerpt, .entry-content .btn.light-color-text.cortex_the_excerpt:visited, .entry-content .btn.light-color-text.cortex_the_excerpt, .woocommerce .button.add_to_cart_button, .woocommerce .buttons .button, .woocommerce-message .button.wc-forward, mark, ins, .dropdown-menu .divider, button, .button.button.alt, .woocommerce div.product form.cart .button, .woocommerce #content .button, .search-submit, .woocommerce nav.woocommerce-pagination .page-numbers a.page-numbers, .woocommerce input.button, .woocommerce a.button.alt, .woocommerce .form-row.place-order .button, .cortex .tp-bullet.active,.cortex .tp-bullet.selected,.cortex .tp-bullet:hover,.cortex .tp-bullet:focus, .woocommerce .button, .woocommerce a.button, input[type=\"checkbox\"]:checked, input[type=\"radio\"]:checked, button {
background-color: {$cortex_colors['accent_color']};
}

.tp-caption .tp-button:hover {
background-color: {$cortex_colors['accent_color']};
}

.entry-content ul li:before,.widget_archive ul li:before,.widget_categories ul li:before,.widget_pages ul li:before,.widget_meta ul li:before,.widget_recent_comments ul li:before,.widget_recent_entries ul li:before,.widget_rss ul li:before,.widget_text ul li:before,.widget_nav_menu ul li:before, .widget_calendar #wp-calendar caption, a:hover, a:focus, a:active, #secondary-top .widget-cortex-mailchimp h3:before, .entry-meta .cat-links:before, .entry-meta .tags-links:before, .entry-meta a:hover, .nav-links .nav-previous:hover, .nav-links .nav-next:hover, .nav-links .prev:before, .nav-links .nav-previous:before, .nav-links .next:before, .nav-links .nav-next:before, .content-single .entry-header .entry-header-standard-wrapper .entry-header-standard .entry-header-standard-inner .h5 .posted-on a, blockquote:before, .author-social li a:hover, .author-social li a:before, .site-info a:hover, .navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus, .navbar-default .navbar-brand:active, .navbar-default .navbar-brand.active, .navbar-default .navbar-collapse .nav li a:hover, .navbar-default .navbar-collapse .nav li a:focus, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus, .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .full_page_slider .tp-caption h2, .content-area .site-main .masonry_portfolio .container .isotope-item .masonry_portfolio_sub_heading, .blog_latest a:hover, .small-link:hover, .comment-reply-link:hover, .comment-author .fn .url:hover, .comment-metadata a:hover, .blog_latest .blog_latest_title .subtitle, .twitter-tweet ul li:before, .action-link:after, .project_masonry_description, .subtitle, .widget-cortex-contact .email:before, .widget-cortex-contact .tel:before, .widget-cortex-contact .street-address:before, .widget_cortex_twitter_widget ul li:before, .masonry_project_sub_heading, .isotope-item h3 .masonry_project_heading:hover, .events_description .accent-color-text, .accent-color-text, .tp-caption.-cortex-h2, .-cortex-h2, .content-area .site-main .masonry_project .isotope-item .masonry_project_sub_heading, .content-area .site-main .masonry_project .isotope-item .masonry_project_heading:hover, .content-area .site-main .masonry_portfolio .container .isotope-item .masonry_portfolio_heading:hover, a:hover span, .entry-content ul li:after, .widget_archive ul li:after, .widget_categories ul li:after, .widget_pages ul li:after, .widget_meta ul li:after, .widget_recent_comments ul li:after, .widget_recent_entries ul li:after, .widget_rss ul li:after, .widget_text ul li:after, .widget_nav_menu ul li:after, .widget_product_categories ul li:after, .nav-links .next:after, .nav-links .nav-next:after, .widget_cortex_twitter_widget .date a:hover, .widget_cortex_twitter_widget ul li a:hover, .events-header-text.next-event h5:first-child, .event-single header .events-header-text .light.secondary-font, .navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu .dropdown-submenu .dropdown-menu .active a, .widget_product_categories ul li:before, .woocommerce nav.woocommerce-pagination .page-numbers a.page-numbers:hover, .woocommerce nav.woocommerce-pagination .page-numbers a.page-numbers.next:hover, .accent-color-text.h1, .accent-color-text.h2, .accent-color-text.h3, .accent-color-text.h4, .accent-color-text.h5, .accent-color-text.h6, .entry-tags .entry-meta .tags-links a:before, .nav2.navbar-default .navbar-collapse .nav li a:hover, .entry-content ol li:before, .sticky .entry-meta:before, .panel-group .panel-heading .panel-title .accordion-toggle.collapsed:hover, a:hover i:before, .c9-footer-full-width .widget_cortex_twitter_widget .big.dark ul li:before, .c9-footer-full-width .widget_cortex_twitter_widget .big.light ul li:before, .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-collapse .nav .active a, .bright .nav1.navbar-small.navbar-default .navbar-collapse > .nav > .active > a, .nav2.navbar-default .navbar-collapse .nav .active a, .nav2.navbar-default .navbar-collapse .nav .active.current_page_item a {
color: {$cortex_colors['accent_color']};
}

.-cortex-h2, .tp-caption.-cortex-h2 {
color: {$cortex_colors['accent_color']} !important;
}

@media (max-width: 767px) {
	.bright .nav1.navbar-default .navbar-collapse .nav li a:hover {
	color: {$cortex_colors['accent_color']};
	}
}

textarea, select, textarea, input[type=\"number\"], .input-text, .woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea, select, .woocommerce form .form-row select, .wpcf7-form input[type=\"text\"], .wpcf7-form input[type=\"password\"], .wpcf7-form input[type=\"number\"], .wpcf7-form input[type=\"email\"], .wpcf7-form input[type=\"tel\"], .wpcf7-form select, .cortex-woocommerce .product input[type=\"text\"], .woocommerce-page #content .shop_table tr .actions .coupon .input-text, .select2-container .select2-choice, input[type=\"checkbox\"], input[type=\"radio\"],.select2-container .select2-choice {
border: 1px solid {$cortex_colors['accent_color']};
}

.input__label--cortex:before,
.input__label--cortex:after {
border-bottom: 1px solid {$cortex_colors['accent_color']};
}

.input__label--cortex:after, .widget .widget-title:after, .entry-meta:after, .content-single .entry-header .entry-header-standard-wrapper .entry-header-standard .entry-header-standard-inner h1:after, .author-about-title h5:after, #comments h3:after, .content-single .entry-header .entry-header-standard-wrapper .entry-header-standard .entry-header-standard-inner h1:after, .blog-latest-header .entry-header-standard .blog_latest_title:after, .cortex-woocommerce .page-title:after, .widget .widget-title:after, .widget .widgettitle:after {
border-bottom: 2px solid {$cortex_colors['accent_color']};
}
.input__label--cortex-color-1:after {
border-color: {$cortex_colors['accent_color']};
}

.widget_search .search-field, .search-form .search-field, .widget_search .search-field, .widget_product_search .search-field {
border: 3px solid {$cortex_colors['accent_color']};
}

blockquote, .comment.bypostauthor {
border-left: 3px solid {$cortex_colors['accent_color']};
}

.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:hover {
border-bottom: 1px solid {$cortex_colors['accent_color']};
}";
	} //end accent color


	if ( ! empty( $cortex_colors['headline_color'] ) ) {

		$cortex_custom_css .= "
/****************************************
headline color styling
****************************************/
button, input, select, textarea, h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6, .btn,input[type=\"submit\"],#submit, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"text\"], input[type=\"email\"], input[type=\"url\"], input[type=\"password\"], input[type=\"search\"], textarea, .entry-title a, .entry-title a:visited, .widget h1, .widget h2, .widget h3, .widget-cortex-instagram .clear a, .comment-reply-link, .comment-author .fn, .comment-metadata a, .entry-header .alternate .posted-on a:hover, .entry-meta a, .nav-links .page-numbers, .nav-links .nav-previous, .nav-links .nav-next, .content-single .entry-header .entry-header-standard-wrapper .entry-header-standard .entry-header-standard-inner h1, .single-social-share li a i:before, .full_page_slider .tp-caption h1, .full_width_slider .tp-caption a, .tp-rightarrow.default:hover:after, .tp-leftarrow.default:hover:after, .tp-button, .content-area .site-main .masonry_portfolio .container .isotope-item .masonry_portfolio_heading, .blog_latest .blog_latest_title h3, .headline-color-text, .content-single .entry-header.dark-overlay .entry-header-standard-wrapper .entry-header-standard .entry-header-standard-inner .dark-color-text, .content-single .entry-header .entry-header-standard-wrapper .entry-header-standard .entry-header-standard-inner .dark-color-text {
color: {$cortex_colors['headline_color']};
}

.btn:hover, #submit:hover, .nav-links .page-numbers:hover, .single-social-share li a:hover, .comment-list .comment article .reply a:hover:after {
background-color:  {$cortex_colors['headline_color']};
}

.tp-rightarrow.default:hover, .tp-leftarrow.default:hover, .border-standard-hover {
border: 3px solid {$cortex_colors['headline_color']};
}

.tp-button.alt {
border-bottom: 1px solid {$cortex_colors['headline_color']};
}";
	} //end headline color styling

	if ( ! empty( $cortex_colors['secondary_color'] ) ) {

		$cortex_custom_css .= "
/****************************************
secondary color styling
****************************************/
code, .widget_calendar #wp-calendar tr th, .input__field, label, .input__label, .input__field--cortex, .nav-links .page-numbers.current, .nav-links .page-numbers.current:hover, blockquote p, blockquote .quote-source strong, .navbar-default .navbar-collapse .nav li a, .navbar-default .navbar-nav .open .dropdown-menu > li > a, .full_page_slider .tp-caption h3, .tp-caption h4, .full_page_slider .tp-caption h5, .secondary-color-text {
color:  {$cortex_colors['secondary_color']};
}
.tp-button:hover.red, .purchase:hover.red {
background-color: {$cortex_colors['secondary_color']} !important;
}

.input__label--cortex-color-2::after {
border-color: {$cortex_colors['secondary_color']};
}";
	} //end secondary_color


	if ( ! empty( $cortex_colors['third_color'] ) ) {

		$cortex_custom_css .= "
/****************************************
third color styling
****************************************/
.widget_calendar #wp-calendar tr td, input[type=\"text\"]:focus, input[type=\"email\"]:focus, input[type=\"url\"]:focus, input[type=\"password\"]:focus, input[type=\"search\"]:focus, textarea:focus, .entry-meta, .comment-metadata a, .comment-notes, .form-allowed-tags, site-info, .site-info a, .twitter-tweet ul li, .third-color-text, .dropdown-header, .event-single header a .u_location {
color:  {$cortex_colors['third_color']};
}

.event-big:nth-child(odd) {
background-color: {$cortex_colors['third_color']};
}

.input__label--cortex-color-3::after {
border-color: {$cortex_colors['third_color']};
}
table thead {
background-color: {$cortex_colors['third_color']};
}
table {
border-left: 1px solid {$cortex_colors['third_color']};
border-right: 1px solid {$cortex_colors['third_color']};
border-bottom: 1px solid {$cortex_colors['third_color']};
}";
	} //end third color


	if ( ! empty( $cortex_colors['cortex_nav_bg'] ) ) {

		$cortex_custom_css .= "
/****************************************
cortex nav bg when scrolled, mobile, or opaque setting
****************************************/
.navbar-bg-solid {
	background-color: {$cortex_colors['cortex_nav_bg']};
}

@media (max-width: 767px) {
	.navbar-default, .navbar-default.navbar-small {
		background-color: {$cortex_colors['cortex_nav_bg']} !important;
	}
}";

	} //end body nav bg


	if ( ! empty( $cortex_colors['cortex_nav_dropdown_bg'] ) ) {

		$cortex_custom_css .= "
/****************************************
cortex dropdown menus bg when scrolled, mobile, or opaque setting
****************************************/
.navbar-collapse .nav .dropdown .dropdown-menu,
.navbar .navbar-collapse .nav .dropdown .dropdown-menu,
.navbar-collapse .nav .dropdown > .dropdown-menu .dropdown-submenu .dropdown-menu {
	background-color: {$cortex_colors['cortex_nav_dropdown_bg']};
}

@media screen and (max-width: 767px) {
.navbar-collapse {
	background-color: {$cortex_colors['cortex_nav_dropdown_bg']};
}
}";

	} //end cortex_nav_dropdown_bg


	if ( ! empty( $cortex_colors['cortex_nav_link'] ) ) {

		$cortex_custom_css .= "
/****************************************
cortex nav links (top level)
****************************************/
.navbar-default .navbar-collapse .nav li a,
.bright .nav1.navbar-small.navbar-default .navbar-collapse > .nav > li > a {
	color: {$cortex_colors['cortex_nav_link']};
}";

	} //end cortex_nav_link


	if ( ! empty( $cortex_colors['cortex_nav_dropdown_link'] ) ) {

		$cortex_custom_css .= "
/****************************************
cortex secondary nav links (second and third level)
****************************************/
.navbar-default .navbar-collapse .nav li .dropdown-menu li a {
	color: {$cortex_colors['cortex_nav_dropdown_link']};
}";

	} //end cortex_nav_link


	if ( ! empty( $cortex_colors['body_color'] ) ) {

		$cortex_custom_css .= "
/****************************************
body color styling
****************************************/
body, .entry-content, .entry-content p, .comment p, p, code {
color: {$cortex_colors['body_color']};
}

.entry-content .btn.body-color-text {
color: {$cortex_colors['body_color']};
}

.entry-content a:hover, .entry-content p a:hover {
color: {$cortex_colors['accent_color']};
}";
	} //end body_color


	if ( ! empty( $cortex_colors['body_link_color'] ) ) {

		$cortex_custom_css .= "
/****************************************
body link color styling
****************************************/

.entry-content a, .entry-content p a,
.entry-content a:visited,
.entry-content p a:visited {
color: {$cortex_colors['body_link_color']};
}";
	} //end body link color


	if ( ! empty( $cortex_colors['dark_color'] ) ) {

		$cortex_custom_css .= "
/****************************************
dark color styling
****************************************/
.dark-color, .content-area .site-main .masonry_portfolio .container .isotope-item figure:before {
background: {$cortex_colors['dark_color']};
}
.twitter-tweet.dark, .twitter-tweet.big.dark {
background-color: {$cortex_colors['dark_color']};
}
.dark-color-text, .twitter-tweet, .twitter-tweet ul li a, .twitter-tweet a, .entry-content .btn.body-color-text:hover, .entry-content .btn.body-color-text.btn-info, .widget-cortex-mailchimpinput[type=\"submit\"]:hover, input[type=\"submit\"]:hover, button:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,.button.button.alt:hover,.woocommerce div.product form.cart .button:hover {
color: {$cortex_colors['dark_color']};
}";
	} //end dark color


	if ( ! empty( $cortex_colors['light_color'] ) ) {

		$cortex_custom_css .= "
/****************************************
light color styling
****************************************/
.twitter-tweet,
.btn.light-color-text.cortex_the_excerpt:hover, .btn.light-color-text.cortex_the_excerpt:visited:hover, .entry-content .btn.light-color-text.cortex_the_excerpt:hover, .entry-content .btn.light-color-text.cortex_the_excerpt:visited:hover, .widget-cortex-mailchimp input[type=\"submit\"]:hover, input[type=\"submit\"]:hover, input[type=\"button\"]:hover, button:hover, input[type=\"button\"]:hover, input[type=\"reset\"]:hover, input[type=\"submit\"]:hover, .button.button.alt:hover, .woocommerce div.product form.cart .button:hover {
background-color:  {$cortex_colors['light_color']};
}
.twitter-tweet.dark, .twitter-tweet.dark .action-link, .twitter-tweet.dark ul li a, .twitter-tweet.big.dark, .entry-content .btn.light-color-text.cortex_the_excerpt:visited, .entry-content .btn.light-color-text.cortex_the_excerpt, .widget_cortex_subscribe_widget ul li a:before, .panel-group .panel-heading .panel-title .accordion-toggle.collapsed {
color:  {$cortex_colors['light_color']};
}";
	} //end if light_color is blank


	if ( ! empty( $cortex_colors['c9-topnav-bg'] ) ) {

		$cortex_custom_css .= "
/****************************************
top navbar bg color styling
****************************************/
.navbar-top .navbar-bg-solid {
	background-color: {$cortex_colors['c9-topnav-bg']};
}

@media (max-width: 767px) {
.navbar-top .navbar-bg, .navbar-top .navbar-bg-solid {
		background-color: {$cortex_colors['c9-topnav-bg']};
	}
}";

	} //end if top navbar bg isn't blank


	// some custom colors were picked, so add the inline style to wp_head
	if ( ! empty( $cortex_custom_css ) ) {
		$cortex_custom_css_min = preg_replace("/\s+/S", " ", $cortex_custom_css);
		wp_add_inline_style( 'cortex-typography', $cortex_custom_css_min );
	}

	// add any custom css from Cortex Options
	if ( ! empty( $cortex_theme_options['c9-custom-css'] ) ) {
		wp_add_inline_style( 'cortex-typography', $cortex_theme_options['c9-custom-css'] );
	}

} //end if colors are empty
