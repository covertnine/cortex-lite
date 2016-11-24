<header class="entry-header mar50B <?php echo 'entry-header-'.sanitize_html_class($cortex_format);
	if ( ! empty($cortex_enable_overlay) ) { echo $cortex_enable_overlay; } ?>">
		<div class="entry-header-standard-wrapper">
			<div class="entry-header-standard">
				<div class="entry-header-standard-inner" data-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
					<div class="container">
						<span class="h5 accent-color-text"><?php cortex_posted_on(); ?></span>
						<h1 class="entry-title<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php the_title(); ?></h1>
						<div class="entry-meta">
							<?php cortex_author(); ?> / <?php cortex_post_categories(); ?>
						</div><!-- .entry-meta -->
					</div><!--end container-->
				</div><!--end entry-header-standard-inner-->
			</div><!--end entry-header-standard-->
		</div><!--entry-header-standard-wrapper-->
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="entry-image" <?php if ( ! empty( $cortex_featured_header ) ) { echo 'style="background: url('.esc_url($cortex_featured_header[0]).') center fixed no-repeat; background-size: cover;"'; } ?>></figure>
		<?php } ?>
</header><!-- .entry-header -->
