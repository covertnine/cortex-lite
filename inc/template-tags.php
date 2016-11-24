<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cortex
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function the_posts_navigation() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation posts-navigation wow animated fadeInUp" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'cortex' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'cortex' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'cortex' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
	}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function the_post_navigation() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation wow animated fadeInUp" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'cortex' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'cortex_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date.
	 */
	function cortex_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( '%s', 'post date', 'cortex' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>';

	}
endif;

if ( ! function_exists( 'cortex_author' ) ) :
	/**
	 * Prints HTML with meta information for the author
	 */
	function cortex_author() {
		$byline = sprintf(
			_x( 'By %s', 'post author', 'cortex' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		echo '<span class="byline"> ' . $byline . '</span>';
	}
endif;

if ( ! function_exists( 'cortex_the_excerpt' ) ) :
	/**
	 * Prints customizeable excerpt of varying length if needed. Must be within the_loop
usage: echo cortex_excerpt('Read more &raquo;', 75, 1);
read more text, length, elipses true or false, true by default
	 */
	function cortex_the_excerpt( $postID = 0, $more = 0, $length = 55, $hellip = 0 ) {
		if ( $postID && is_int( $postID ) ) {
			$the_post = get_post( $postID );
		} else {
			if ( $postID != 0 || is_string( $postID ) ) {
				if ( $length == 0 || $length == 1 ) {
					$hellip = $length;
				} else {
					$hellip = false;
				}

				if ( is_int( $more ) ) {
					$length = $more;
				} else {
					$length = 55;
				}

				$more = $postID;
			}
			$postID = get_the_ID();
			$the_post = get_post( $postID );
		}

		if ( $the_post->post_excerpt ) {
			$string = strip_tags( strip_shortcodes( $the_post->post_excerpt ), '' );
		} else {
			$string = strip_tags( strip_shortcodes( $the_post->post_content ), '' );
		}

		$string = string_limit_words( $string, $length );

		if ( $hellip ) {
			if ( $string[1] == 1 ) {
				$string[0] .= '&hellip; ';
			}
		}

		if ( isset( $more ) && $more != '' ) {
			$string[0] .= ' <div class="clearfix"></div><a class="btn light-color-text cortex_the_excerpt" href="' . get_permalink( $postID ) . '">' . $more . '</a>';
		}

		return $string[0];
	}

	// Text limiter by words
	function string_limit_words( $string, $word_limit ) {
		$limited[0] = $string;
		$limited[1] = 0;
		$words = explode( ' ', $string, ($word_limit + 1) );
		if ( count( $words ) > $word_limit ) {
			array_pop( $words );
			$limited[0] = implode( ' ', $words );
			$limited[1] = 1;
		}
		return $limited;
	}

endif;

if ( ! function_exists( 'cortex_post_categories' ) ) :
	/**
	 * Prints HTML for categories on posts
	 */
	function cortex_post_categories() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'cortex' ) );
			if ( $categories_list ) { // changed from if ( $categories_list && cortex_categorized_blog() ) { because it won't show if there's only 1 category
				printf( '<span class="cat-links">' . __( '%1$s', 'cortex' ) . '</span>', $categories_list );
			}
		}
	}
endif;

if ( ! function_exists( 'cortex_post_tags' ) ) :
	/**
	 * Prints HTML for tags on posts
	 */
	function cortex_post_tags() {
		if ( 'post' == get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$args = array(
			'orderby'	=> 'count',
			'order'		=> 'DESC',
			);
			$tags = wp_get_post_tags( get_the_id(), $args );
			if ( ! empty( $tags ) ) { // post has tags echo 3 of the popular ones
				$html = '/ <span class="tags-links">';
				$count = 0;
				foreach ( $tags as $tag ) {
					$count++;
					$tag_link = get_tag_link( $tag->term_id );

					$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
					$html .= "{$tag->name}</a>, ";
					if ( $count == 3 ) { break; }
				}
				$html = rtrim( $html, ', ' );
				$html .= '</span>';
				echo $html;
			} else {
				return false;
			} //end check for empty tags in post
		}
	}
endif;

if ( ! function_exists( 'cortex_comment' ) ) :
	/**
	 * Prints HTML for leave a comment link
	 */
	function cortex_comment() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( __( 'Leave a comment', 'cortex' ), __( '1 Comment', 'cortex' ), __( '% Comments', 'cortex' ) );
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'cortex_entry_footer' ) ) :
	/**
	 * Prints HTML to edit post and anything else for the post footer
	 */
	function cortex_entry_footer() {

		edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' );
	}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function the_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( __( 'Category: %s', 'cortex' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( __( 'Tag: %s', 'cortex' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( __( 'Author: %s', 'cortex' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( __( 'Year: %s', 'cortex' ), get_the_date( _x( 'Y', 'yearly archives date format', 'cortex' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( __( 'Month: %s', 'cortex' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'cortex' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( __( 'Day: %s', 'cortex' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'cortex' ) ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title', 'cortex' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title', 'cortex' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title', 'cortex' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title', 'cortex' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title', 'cortex' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title', 'cortex' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title', 'cortex' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title', 'cortex' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title', 'cortex' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( __( 'Archives: %s', 'cortex' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s', 'cortex' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = __( 'Archives', 'cortex' );
		}

		/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo $before . $title . $after;
		}
	}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after  Optional. Content to append to the description. Default empty.
	 */
	function the_archive_description( $before = '', $after = '' ) {
		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( ! empty( $description ) ) {
			/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
			echo $before . $description . $after;
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function cortex_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'cortex_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'cortex_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so cortex_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so cortex_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in cortex_categorized_blog.
 */
function cortex_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'cortex_categories' );
}
add_action( 'edit_category', 'cortex_category_transient_flusher' );
add_action( 'save_post',     'cortex_category_transient_flusher' );

/**
sets proper classes for navigation depending on theme options and navigation options
*/
if ( ! function_exists( 'cortex_navigation_layout' ) ) :
	function cortex_navigation_layout($classes = '') {

		global $cortex_options;

		$classes = ' ';

		if ( $GLOBALS['cortex_navigation_type'] == 'nav1' ) {
			$classes .= 'nav1';
		} else {
			$classes .= 'nav2';
		}
		if ( $cortex_options['c9-navigation-layout'] == 'logo-center' ) {
			$classes .= ' navbar-logo-center';
		}
		if ( $cortex_options['c9-enable-topnav'] == true ) {
			$classes .= ' with-topnav';
		}
		if ( $cortex_options['c9-enable-topnav-mobile'] == false ) {
			$classes .= ' hidden-topnav-xs';
		}

		echo $classes;
	}
endif;

/**
 * adds correct skrollr data for a taller nav if there's a top row or if the logo is centered
 */
if ( ! function_exists( 'cortex_navigation_padding' ) ) :
	function cortex_navigation_padding($data = '') {
		global $cortex_options;

		$data = ' ';

		if ( $cortex_options['c9-navigation-layout'] != 'logo-center' ) { // nav is aligned to the right or left

			if ( $cortex_options['c9-enable-topnav'] == true ) { //there is a top nav so add extra padding

				$data .= 'data-start="height: 90px; padding-top: 20px;" data-90-start="height: 50px; padding-top: 0px;"';

			} else { //no top nav

				$data .= 'data-start="height: 90px; padding-top: 20px;" data-90-start="height: 50px; padding-top: 0px;"';

			} //end top nav check

		} else { //nav has a centered logo

			if ( $cortex_options['c9-enable-topnav'] == true ) { //there is a top nav so add extra padding

				$data .= 'data-start="height: 105px; padding-top: 15px;" data-90-start="height: 65px; padding-top: 5px;"';

			} else { //no top nav

				$data .= 'data-start="height: 105px; padding-top: 20px;" data-90-start="height: 65px; padding-top: 5px;"';

			}
		}

		echo $data;
	}
endif;

/**
 * adds classes to #page depending on navigation choices
 */
if ( ! function_exists( 'cortex_page_class' ) ) :
	function cortex_page_class($data = 'hfeed site') {

		global $cortex_options;

		if ( $cortex_options['c9-theme-style'] != 'dark' ) {  //add bright class if its a light theme
			$data .= ' bright';
		}

		if ( $cortex_options['c9-navigation-layout'] == 'logo-center' ) { //adds logo center to adjust height slightly for some components
			$data .= ' navbar-logo-center';
		} else {  //just add navigation layout since its not centered
			$data .= ' '.sanitize_html_class( $cortex_options['c9-navigation-layout'] );
		}

		if ( $cortex_options['c9-navigation-type'] == 'nav1' ) { //add the navigation type so components know how to change if they're first on page
			$data .= ' nav1';
		} else {
			$data .= ' nav2';
		}

		if ( $cortex_options['c9-enable-topnav'] == true ) {
			$data .= ' with-topnav';
		}

		echo 'class="' . $data . '"';

	} //end cortex_page_class
endif;
