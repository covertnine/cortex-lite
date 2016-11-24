<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package cortex
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title h5 center">
			<?php
				printf( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'cortex' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'cortex' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'cortex' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'cortex' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      	=> 'ol',
					'short_ping' 	=> true,
					'avatar_size'	=> 80,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'cortex' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'cortex' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'cortex' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'cortex' ); ?></p>
	<?php endif; ?>

	<?php
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields = array(
	  'author' =>
		'<p class="comment-form-author input input--cortex">
		<input id="author" class="input__field input__field--cortex" name="author" type="text" size="30"' . $aria_req . ' />' .
		'<label for="author" class="input__label input__label--cortex input__label--cortex-color-1"><span class="input__label-content--cortex">' . __( 'Name *', 'cortex' ) . '</span></label></p>',

	  'email' =>
		'<p class="comment-form-email input input--cortex">
		<input id="email" class="input__field input__field--cortex" name="email" type="text" size="30"' . $aria_req . ' />
		<label for="email" class="input__label input__label--cortex input__label--cortex-color-1"><span class="input__label-content--cortex">' . __( 'Email *', 'cortex' ) . '</span></label></p>',

	  'url' =>
		'<p class="comment-form-url input input--cortex">' .
		'<input id="url" class="input__field input__field--cortex" name="url" type="text" size="30" />
		<label for="url" class="input__label input__label--cortex input__label--cortex-color-1"><span class="input__label-content--cortex">' . __( 'Website', 'cortex' ) . '</span></label></p>',
	);

	$args = array(
		'fields' => $fields,
	);

	comment_form( $args );

	?>

</div><!-- #comments -->
