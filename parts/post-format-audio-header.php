<?php
// get iframe HTML
$cortex_iframe = get_field( 'audio_link' );
// display above or below
$cortex_display = get_field( 'display' );
// add extra attributes to iframe html
$cortex_attributes = '';
$cortex_iframe = str_replace( '></iframe>', ' ' . $cortex_attributes . '></iframe>', $cortex_iframe );
?>
	<header class="entry-header <?php echo 'entry-header-'.sanitize_html_class($format); ?>">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="entry-image<?php if ( ! empty($cortex_enable_overlay) ) { echo $cortex_enable_overlay; } ?>" <?php if ( ! empty( $cortex_featured_header ) ) { echo 'style="background: url('.esc_url($cortex_featured_header[0]).') center fixed no-repeat; background-size: cover;"'; } ?>></figure>
		<?php } ?>
		<div class="entry-header-standard-wrapper">
			<div class="entry-header-standard">
				<div class="entry-header-standard-inner" data-100-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
					<div class="container">
						<?php if ( ($cortex_iframe !== '') && ($cortex_display == 'above') ) { ?>
							<figure class="audio-embed above">
								<div class="audio-embed-container"><?php echo $cortex_iframe; ?></div>
							</figure>
						<?php } ?>
						<span class="h5 accent-color-text hidden-xs"><?php cortex_posted_on(); ?></span>
						<h1 class="entry-title<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php the_title(); ?></h1>
						<div class="entry-meta hidden-xs">
							<?php cortex_author(); ?> / <?php cortex_post_categories(); ?>
						</div><!-- .entry-meta -->
						<?php if ( ($cortex_iframe !== '') && ($cortex_display == 'below') ) { ?>
							<figure class="audio-embed">
								<div class="audio-embed-container"><?php echo $cortex_iframe; ?></div>
							</figure>
						<?php } ?>
					</div><!--end container-->
				</div><!--end entry-header-standard-inner-->
			</div><!--end entry-header-standard-->
		</div><!--entry-header-standard-wrapper-->
	</header><!-- .entry-header -->
