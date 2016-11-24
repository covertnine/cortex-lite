<?php

/** add a link to the menu for documentation */
function cortex_doc_menu() {
	add_theme_page( 'themes.php', 'Cortex Support', 'manage_options', 'cortex-documentation', 'cortex_documentation_options');
}
add_action( 'admin_menu', 'cortex_doc_menu' );


function cortex_documentation_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'cortex' ) );
	}
	echo '<div class="wrap">';
	include( get_template_directory() . '/documentation/docs.php' );
	echo '</div>';
}

/* functions for dynamic CSS */
function cortex_get_css_path () {
	// Get upload dir data
	$wp_upload_dir = wp_upload_dir();

	// Get theme data
	$theme = wp_get_theme();

	// Get theme name
	$theme_name    = strtolower( $theme->get( 'Name' ) );

	// Create full path to theme name dir in upload dir
	$upload_dir = $wp_upload_dir['basedir'] . '/' . $theme_name;

	// Make dir if it does not exists
	wp_mkdir_p( $upload_dir );
	// Create path to actual CSS file
	$css_file = $upload_dir . '/typography.css';
	return $css_file;
}
