<?php
$cortex_background    				= get_sub_field( 'custom_background' );
$cortex_backgroundColor     		= get_sub_field( 'background_color' );
$cortex_backgroundImage     		= esc_url( get_sub_field( 'background_image' ) );
$cortex_limit       				= get_sub_field( 'limit_by_category' );
$cortex_category       				= get_sub_field( 'project_category' );
$cortex_orderBy      				= get_sub_field( 'order_by' );
$cortex_backgroundPattern    		= esc_url( get_sub_field( 'background_pattern' ) );
$cortex_backgroundRepeat    		= get_sub_field( 'background_pattern_repeat' );
$cortex_backgroundParallax    		= get_sub_field( 'background_image_parallax' );
$cortex_projects_title      		= get_sub_field( 'title' );
$cortex_projects_sub_title    		= get_sub_field( 'sub_title' );
$cortex_projects_container_width  	= sanitize_html_class( get_sub_field( 'width' ) );
$cortex_columns      				= sanitize_html_class( get_sub_field( 'columns' ) );
$cortex_customClass					= get_sub_field( 'custom_class' );

/*check to see if the background color or background images are set and add in any css to a $cortex_style variable*/
if ( $cortex_background != 'none' ) {

	if ( ( $cortex_backgroundColor != '' ) || ( $cortex_backgroundImage != '' ) || ( $cortex_backgroundPattern != '' ) ) {
		$cortex_style    = 'style="';
	}
	if ( $cortex_backgroundColor != '' ) {
		$cortex_style  .= "background-color: $cortex_backgroundColor; ";
	}
	if ( ( $cortex_backgroundImage != '' ) && ( $cortex_background == 'image' ) ) {
		$cortex_style  .= "background-image: url($cortex_backgroundImage); background-size: cover; background-repeat: no-repeat; background-position: center center;";
	}
	if ( ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'pattern' ) ) || ( ( $cortex_backgroundPattern != '' ) && ( $cortex_background == 'color_pattern' ) ) ) {
		$cortex_style  .= "background-image: url($cortex_backgroundPattern); background-repeat: $cortex_backgroundRepeat;";
	}
} //end checking for custom background
?>
<section id="section-<?php echo $cortex_counter; ?>" class="project-listing section-bg masonry_project<?php if ( $cortex_customClass != '' ) { echo ' '.sanitize_html_class( $cortex_customClass ); } ?>">
	<div class="section-bg" <?php if ( $cortex_backgroundParallax == 'yes' ) { echo "data-bottom-top=\"background-position: 0px 0px;\" data-top-bottom=\"background-position: 0% -200%;\" data-anchor-target=\"#section-$cortex_counter\""; } ?> <?php if ( ! empty( $cortex_style ) ) { echo $cortex_style.'"'; } ?>>
		<div class="<?php if ( ! empty( $cortex_projects_container_width ) ) { echo $cortex_projects_container_width;
} else { echo 'container'; } ?>">
			<?php if ( ( ! empty( $cortex_projects_title )) || ( ! empty( $cortex_projects_sub_title )) ) { ?>
			<div class="<?php if ( $cortex_projects_container_width == 'container-fluid' ) { echo 'container';
} else { echo 'projects_container';} ?>">
				<span class="h1 center mar20B">
				<?php echo $cortex_projects_title; ?>
				</span>
				<span class="center project_masonry_description subtitle mar30B"><?php echo $cortex_projects_sub_title; ?></span>
				</div>
			<?php
}

// WP_Query arguments
if ( $cortex_limit == false ) { // query all portfolios
	$args = array(
		'post_type'              => 'project',
		'post_status'    => 'publish',
		'order'                  => 'ASC',
		'orderby'                => $cortex_orderBy,
	);
} else { // a specific category is needed

	$args = array(
		'post_type'              => 'project',
		'post_status'    => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => 'projects-category',
				'terms'		=> $cortex_category,
			),
		),
		'order'                  => 'ASC',
		'orderby'                => $cortex_orderBy,
	);
}

// The Query
$cortex_query = new WP_Query( $args );

if ( $cortex_query->have_posts() ) { ?>
			<div class="masonry_projects">
	         	<div class="project-listing grid-tiles isotope c9-project-caption">

				<?php
				while ( $cortex_query->have_posts() ) {
					$cortex_query->the_post();
					$cortex_image   = get_the_post_thumbnail( get_the_id(), 'large' );
					$cortex_heading  = get_field( 'project_name' );
					$cortex_sub_heading = get_field( 'project_sub_heading' );

			?>
						<article id="post-<?php the_ID(); ?>" class="tile isotope-item <?php if ( ! empty( $cortex_columns ) ) { echo $cortex_columns;
} else { echo 'cm50'; } ?>">
								<?php if ( ! empty( $cortex_image ) ) { ?>
								<figure class="img_project">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php echo $cortex_image; ?>
									</a>
									<figcaption>

												<?php if ( ! empty( $cortex_sub_heading ) ) { ?>
												<span class="masonry_project_sub_heading"><?php echo $cortex_sub_heading; ?></span>
												<?php } ?>

												<?php if ( ! empty( $cortex_heading ) ) { ?>
												<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="masonry_project_heading"><?php echo $cortex_heading; ?></span></a></h3>
												<?php } ?>
												<?php if ( ( $cortex_columns == 'cm50' ) || ( $cortex_columns == 'cm100' ) ) { ?>
												<div class="project-description"><?php the_excerpt();?></div>
												<?php } ?>
												<?php edit_post_link( __( 'Edit', 'cortex' ), '<span class="edit-link">', '</span>' ); ?>

									</figcaption>
								</figure>
								<?php } else { ?>
								<figure class="img_container">
									<img src="http://placehold.it/720x480" alt="" />
								</figure>
								<?php } ?>

							</article><!-- #post-## -->
			<?php
				} //endwhile

				wp_reset_postdata();
?>
						</div><!-- .project-listing -->
			</div><!--end masonry_projects-->
						<?php } else { ?>

				      	<div class="project-listing grid-tiles">
							<?php esc_html_e( 'No projects were found.', 'cortex' ); ?>
						</div>

						<?php } //endif ?>

		</div><!-- #container -->
	</div><!--end section-bg-->
</section>
<?php $cortex_counter++;
unset( $cortex_backgroundImage, $cortex_backgroundColor, $cortex_backgroundPattern, $cortex_style, $cortex_customClass ); // reset variables that are used on other page builder layouts ?>
