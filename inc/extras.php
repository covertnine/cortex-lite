<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package cortex
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'cortex_body_classes' ) ) {
	function cortex_body_classes( $classes ) {
		global $cortex_options;
		$cortex_theme_options = $cortex_options;

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Add specific CSS class for rtl
		if ( $cortex_theme_options['c9-rtl-support'] === true ) {
			$classes[] = 'rtl';
		}

		return $classes;
	}
} //endif
add_filter( 'body_class', 'cortex_body_classes' );



/**
 * Prevents editor from adding p tags to shortcodes
 */
if ( ! function_exists( 'cortex_strip_paragraphs' ) ) {
	function cortex_strip_paragraphs( $content ) {

		$array = array(
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']',
			'<p></p>' => '',
	    );

	    $content = strtr( $content, $array );

	    return $content;
	}
}
add_filter( 'the_content', 'cortex_strip_paragraphs' );
add_filter( 'widget_text', 'cortex_strip_paragraphs' );



/**
 * Prevents editor from adding p tags to shortcodes for page builders
 */
if ( ! function_exists( 'cortex_strip_paragraphs_acf' ) ) {
	function cortex_strip_paragraphs_acf( $value, $post_id, $field ) {

		$array = array(
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']',
			'<p></p>' => '',
	    );

	    $value = strtr( $value, $array );

	    return $value;
	}
}
add_filter( 'acf/format_value/type=wysiwyg', 'cortex_strip_paragraphs_acf', 20, 3 );



/**
 * Gets the ID of the post, even if it's not inside the loop.
 *
 * @uses WP_Query
 * @uses get_queried_object()
 * @extends get_the_ID()
 * @see get_the_ID()
 *
 * @return int
 */
function cortex_get_the_ID() {
	if ( in_the_loop() ) {
		$post_id = get_the_ID();
	} else {
		/** @var $wp_query wp_query */
		global $wp_query;
		$post_id = $wp_query->get_queried_object_id();
	}
	return $post_id;
}


/**
 * Passes custom typography classes to Tiny MCE editor
 *
 * @param $thsp_mceInit      array
 * @return $thsp_mceInit      array
 * @since Cortex 1.0
 */
if ( ! function_exists( 'cortex_tiny_mce_classes' ) ) {
	function cortex_tiny_mce_classes( $thsp_mceInit ) {

		// Get theme options
		global $cortex_options;
		$cortex_theme_options = $cortex_options;
		$thsp_mceInit['body_class'] .= ' body-' . $cortex_theme_options['c9-body-font']['font-family'] . ' heading-' . $cortex_theme_options['c9-headline-font']['font-family'];

		return $thsp_mceInit;
	}
} //endif
add_filter( 'tiny_mce_before_init', 'cortex_tiny_mce_classes' );
add_filter( 'teeny_mce_before_init', 'cortex_tiny_mce_classes' );



/**
 * add custom fonts to editor
 * since Cortex v1.0
 */
if ( ! function_exists( 'cortex_add_editor_styles' ) ) {

	function cortex_add_editor_styles() {

		global $cortex_options;
		$cortex_theme_options    = $cortex_options;

		$protocol = is_ssl() ? 'https' : 'http';

		if (empty($cortex_theme_options['c9-body-font']['font-family'])) { $cortex_theme_options['c9-body-font']['font-family'] = 'roboto slab'; }

		if (empty($cortex_theme_options['c9-headline-font']['font-family'])) { $cortex_theme_options['c9-headline-font']['font-family'] = 'montserrat'; }

		if (empty($cortex_theme_options['c9-subheading-font']['font-family'])) { $cortex_theme_options['c9-subheading-font']['font-family'] = 'oswald'; }


		$body_font 	 		 = $protocol . '://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $cortex_theme_options['c9-body-font']['font-family']) . ':300&#44;400&#44;700&#44;400italic&#44;700italic';
		$headline_font  	 = $protocol . '://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $cortex_theme_options['c9-headline-font']['font-family']) . ':300&#44;400&#44;700&#44;400italic&#44;700italic';
		$subheading_font  	 = $protocol . '://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $cortex_theme_options['c9-subheading-font']['font-family']) . ':300&#44;400&#44;700&#44;400italic&#44;700italic';


		add_editor_style($body_font);
		add_editor_style($headline_font);
		add_editor_style($subheading_font);

		// first check to make sure the user is an admin
		if ( is_admin() ) {

			//see if theme style has been chosen, if not set a default
			if (empty($cortex_theme_options['c9-theme-style'])) { $cortex_theme_options['c9-theme-style'] = 'light'; }

			// add light or dark style based on theme options choice
			if ( $cortex_theme_options['c9-theme-style'] == 'light' ) {
				add_editor_style( get_template_directory_uri() . '/css/style-light.css' );
			} else {
				add_editor_style( get_template_directory_uri() . '/css/style-dark.css' );
			}


		} //end checking if user is an admin

		$css_file = cortex_get_css_path();
		if (file_exists($css_file)) { //user generated css

			/* bulid the proper url */
			$upload_url     = content_url() . '/uploads/';
			$theme 			= wp_get_theme();
			$theme_name     = strtolower( $theme->get( 'Name' ) );

		    wp_enqueue_style ( 'cortex-typography', $upload_url . $theme_name . '/typography.css', array( 'cortex-style' ) );
			add_editor_style($upload_url . $theme_name . '/typography.css');
			add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );

		} else { //default css

		    // enqueue the default file included with your theme.
		    wp_enqueue_style ( 'cortex-typography', get_template_directory_uri() . '/css/typography.css', array ( 'cortex-style' ) );
			add_editor_style(get_template_directory_uri() . '/css/typography.css');
			add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );

		}




	}//end cortex_add_editor_styles()
}
add_action( 'admin_init', 'cortex_add_editor_styles' );



/**
 * Get The First Image From a Post
 */
if ( ! function_exists( 'cortex_first_post_image' ) ) {
	function cortex_first_post_image() {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		if ( preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches ) ) {
			$first_img = $matches[1][0];
			return $first_img;
		}
	}
} //endif

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function cortex_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'cortex' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'cortex_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function cortex_render_title() {
	?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'cortex_render_title' );
endif;


/**
 * Additional user profile fields
 *
 * @package SimpleMag
 * @since  SimpleMag 1.0
 */

/* User Profile Settings */
if ( ! function_exists( 'cortex_user_social_profile_fields' ) ) {
	function cortex_user_social_profile_fields( $user ) {
?>
	    <h3><?php _e( 'Social Profiles', 'cortex' ); ?></h3>

	    <table class="form-table">
	        <tr>
	            <th>
	            	<label for="c9twitter"><?php _e( 'Twitter', 'cortex' ); ?>
	            	</label>
	            </th>
	            <td>
	                <input type="text" name="c9twitter" id="c9twitter" value="<?php echo get_the_author_meta( 'c9twitter', $user->ID ); ?>" class="regular-text" />
	            </td>
	        </tr>
	        <tr>
	            <th>
	            	<label for="c9facebook"><?php _e( 'Facebook', 'cortex' ); ?>
	            	</label>
	            </th>
	            <td>
	                <input type="text" name="c9facebook" id="c9facebook" value="<?php echo get_the_author_meta( 'c9facebook', $user->ID ); ?>" class="regular-text" />
	            </td>
	        </tr>
	        <tr>
	            <th>
	            	<label for="c9google"><?php _e( 'Google+', 'cortex' ); ?>
	            	</label>
	            </th>
	            <td>
	                <input type="text" name="c9google" id="c9google" value="<?php echo get_the_author_meta( 'c9google', $user->ID ); ?>" class="regular-text" />
	            </td>
	        </tr>
	        <tr>
	            <th>
	            	<label for="c9pinterest"><?php _e( 'Pinterest', 'cortex' ); ?>
	            	</label>
	            </th>
	            <td>
	                <input type="text" name="c9pinterest" id="c9pinterest" value="<?php echo get_the_author_meta( 'c9pinterest', $user->ID ); ?>" class="regular-text" />
	            </td>
	        </tr>
	        <tr>
	            <th>
	            	<label for="c9linkedin"><?php _e( 'LinkedIn', 'cortex' ); ?>
	            	</label>
	            </th>
	            <td>
	                <input type="text" name="c9linkedin" id="c9linkedin" value="<?php echo get_the_author_meta( 'c9linkedin', $user->ID ); ?>" class="regular-text" />
	            </td>
	        </tr>
	        <tr>
	            <th>
	                <label for="c9instagram"><?php _e( 'Instagram', 'cortex' ); ?>
	                </label>
	            </th>
	            <td>
	                <input type="text" name="c9instagram" id="c9instagram" value="<?php echo get_the_author_meta( 'c9instagram', $user->ID ); ?>" class="regular-text" />
	            </td>
	        </tr>
	    </table>
	<?php }
} //endif

if ( ! function_exists( 'cortex_save_user_social_profile_fields' ) ) {
	function cortex_save_user_social_profile_fields( $user_id ) {

		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false; }

		update_user_meta( $user_id, 'c9twitter', $_POST['c9twitter'] );
		update_user_meta( $user_id, 'c9facebook', $_POST['c9facebook'] );
		update_user_meta( $user_id, 'c9google', $_POST['c9google'] );
		update_user_meta( $user_id, 'c9pinterest', $_POST['c9pinterest'] );
		update_user_meta( $user_id, 'c9linkedin', $_POST['c9linkedin'] );
		update_user_meta( $user_id, 'c9instagram', $_POST['c9instagram'] );
	}
} //endif

add_action( 'show_user_profile', 'cortex_user_social_profile_fields' );
add_action( 'edit_user_profile', 'cortex_user_social_profile_fields' );

add_action( 'personal_options_update', 'cortex_save_user_social_profile_fields' );
add_action( 'edit_user_profile_update', 'cortex_save_user_social_profile_fields' );
