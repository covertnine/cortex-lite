<?php
$cortex_images      = get_field( 'gallery_photos' );
$cortex_heading     = get_field( 'heading' );
$cortex_post_sub_heading   = get_field( 'subheading' );

if ( empty( $cortex_images ) ) { $cortex_images = get_field( 'images' ); }
?>
	<header class="entry-header entry-header-default entry-header-flex-gallery<?php if ( ! empty($cortex_enable_overlay) ) { echo $cortex_enable_overlay; } ?>">
		<div class="entry-header-standard-wrapper">
			<div class="entry-header-standard">
				<div class="entry-header-standard-inner" data--100-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target=".entry-header-standard-inner .container">
					<div class="container">
						<?php if ( $cortex_images ) { ?>

						<div class="flexslider">
						  <ul class="slides">
							<?php foreach ( $cortex_images as $cortex_image ) :  ?>
						    <li class="img_container">
						    	<a href="<?php echo esc_url($cortex_image['url']); ?>">
									<img src="<?php echo esc_url($cortex_image['sizes']['large']); ?>" alt="<?php echo esc_html($cortex_image['alt']); ?>" data-no-retina />
						    	</a>
						    </li>
							<?php endforeach; ?>
						  </ul>
						</div>

						<?php } ?>

						<?php if ( get_post_type() != 'portfolio' ) { ?>
							<span class="h5 accent-color-text"><?php cortex_posted_on(); ?></span>
						<?php } ?>
						<h1 class="entry-title h5<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php if ( empty( $cortex_heading ) ) { the_title();
} else { echo $cortex_heading;
}; ?></h1>

						<?php if ( get_post_type() != 'portfolio' ) { ?>
						<div class="entry-meta">
							<h3 class="h6 mar30B<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php echo $cortex_post_sub_heading; ?></h3>
							<?php cortex_author(); ?> / <?php cortex_post_categories(); ?> <?php cortex_post_tags(); ?>
						</div><!-- .entry-meta -->
						<?php } else { ?>
							<h3 class="h6 mar30B<?php if ( ! empty( $cortex_color_switch ) ) { echo $cortex_color_switch;} ?>"><?php echo $cortex_sub_heading; ?></h3>
						<?php } ?>
					</div><!--end container-->
				</div><!--end entry-header-standard-inner-->
			</div><!--end entry-header-standard-->
		</div><!--entry-header-standard-wrapper-->
	</header><!-- .entry-header -->
