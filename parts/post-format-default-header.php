<?php
$cortex_subheading      = get_field( 'subheading' );
$cortex_heading   	    = get_field( 'heading' );
?>
	<header class="entry-header entry-header-default<?php if ( ! empty($cortex_enable_overlay) ) { echo $cortex_enable_overlay; } ?>">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="entry-image" <?php if ( ! empty( $cortex_featured_header ) ) { echo 'style="background: url('.esc_url( $cortex_featured_header[0] ).') center fixed no-repeat; background-size: cover;"'; } ?>></figure>
		<?php } ?>
		<div class="entry-header-standard-wrapper">
			<div class="entry-header-standard">
				<div class="entry-header-standard-inner" data-100-top="opacity: 1" data--75-top="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
					<div class="container">
						<?php
						// look for custom post type to disable some options
						if ( get_post_type() != 'portfolio' ) { ?>
													<span class="h5 accent-color-text"><?php cortex_posted_on(); ?></span>
												<?php
						}
?>
						<h1 class="entry-title<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>">
							<?php

							// check if it's a portfolio, or if it's a gallery post format
							if ( ( get_post_type() == 'portfolio' ) || ( get_post_format() == 'gallery' ) ) {

								// check if the heading variable is set, if it's not just use the post title
								if ( ! empty( $cortex_heading ) ) {

									echo $cortex_heading;

								} else {

									the_title();

								}
							} else { // it's not a portfolio or gallery so just show the title
									the_title();
							} //end
?>
						</h1>

						<?php if ( ! empty($cortex_subheading) ) { ?>
						<h2 class="subheading h5 mar30B<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php echo $cortex_subheading; ?></h2>
						<?php } ?>

						<?php
						// look for custom post type to disable some options
						if ( get_post_type() != 'portfolio' ) { ?>

												<div class="entry-meta">
													<?php cortex_author(); ?> / <?php cortex_post_categories(); ?>
												</div><!-- .entry-meta -->

												<?php
						} else { // the post is a portfolio so show the sub title if it's not empty
							if ( ! empty( $cortex_sub_heading ) ) { ?>
						<h2 class="h5 subheading"><?php echo $cortex_sub_heading; ?></h2>
						<?php
							} //end if empty
						} //end looking if it is a custom post type
?>

					</div><!--end container-->
				</div><!--end entry-header-standard-inner-->
			</div><!--end entry-header-standard-->
		</div><!--entry-header-standard-wrapper-->
	</header><!-- .entry-header -->
