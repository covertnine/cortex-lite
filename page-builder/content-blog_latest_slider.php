<?php
$cortex_background      = get_sub_field( 'custom_background' );
$cortex_backgroundColor    = get_sub_field( 'background_color' );
$cortex_backgroundImage    = esc_url( get_sub_field( 'background_image' ) );
$cortex_backgroundPattern    = esc_url( get_sub_field( 'background_pattern' ) );
$cortex_backgroundRepeat    = get_sub_field( 'background_pattern_repeat' );
$cortex_customClass     = esc_html( get_sub_field( 'custom_class' ) );
$cortex_sidebar      = get_sub_field( 'sidebar' );
$cortex_select_sidebar     = get_sub_field( 'select_sidebar' );
$cortex_title       = get_sub_field( 'title' );
$cortex_sub_title      = get_sub_field( 'sub_title' );
$cortex_filter_by_category    = get_sub_field( 'filter_by_category' );
$cortex_filter_by_format    = get_sub_field( 'filter_by_format' );
$cortex_number_of_posts_to_display  = get_sub_field( 'number_of_posts_to_display' );

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
<section id="section-<?php echo $cortex_counter; ?>" class="blog_latest blog_latest_slider<?php if ( ! empty( $cortex_customClass ) ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg" <?php if ( ! empty( $cortex_style ) ) { echo $cortex_style.'"'; } ?>>
		<div class="container">

			<?php if ( ( ! empty( $cortex_title ) ) || ( ! empty( $cortex_sub_title ) ) ) { ?>
			<div class="row wow animated fadeInUp">
				<div class="blog_latest_title col-md-12">
					<?php if ( $cortex_title != '' ) { echo '<h3>' . $cortex_title . '</h3>';} ?>
					<?php if ( $cortex_sub_title != '' ) { echo '<span class="subtitle">' . $cortex_sub_title . '</span>';} ?>
				</div>
			</div>
			<?php } ?>

			<div class="row">

				<?php
				if ( ( empty( $cortex_filter_by_category ) ) && ( empty( $cortex_filter_by_format ) ) ) { // no filtering, output everything

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'posts_per_page'   => $cortex_number_of_posts_to_display,
						'pagination'             => true,
					);

				} elseif ( ( ! empty( $cortex_filter_by_category ) ) && ( empty( $cortex_filter_by_format ) ) ) { // filter by category

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'posts_per_page'   => $cortex_number_of_posts_to_display,
						'category__in'    => $cortex_filter_by_category,
						'pagination'             => false,
					);

				} elseif ( ( empty( $cortex_filter_by_category ) ) && ( ! empty( $cortex_filter_by_format ) ) ) { // filter by format

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'posts_per_page'   => $cortex_number_of_posts_to_display,
						'tax_query'     => array(
							array(
								'taxonomy'   => 'post_format',
								'terms'   => $cortex_filter_by_format,
								'operator'   => 'IN',
							),
						),
						'pagination'             => false,
					);

				} elseif ( ( ! empty( $cortex_filter_by_category ) ) && ( ! empty( $cortex_filter_by_format ) ) ) { // filter by category and format

					$args = array(
						'post_type'              => 'post',
						'post_status'    => 'publish',
						'posts_per_page'   => $cortex_number_of_posts_to_display,
						'category__in'      => $cortex_filter_by_category,
						'tax_query'     => array(
							array(
								'taxonomy' => 'post_format',
								'field'    => 'term_id',
								'terms'    => $cortex_filter_by_format,
								'operator' => 'IN',
							),
						),
						'pagination'             => false,
					);

				}

				// The Query
				$cortex_query = new WP_Query( $args );

				// Pagination fix
				$temp_query = $wp_query;
				$wp_query   = null;
				$wp_query   = $cortex_query;

				switch ( $cortex_sidebar ) {
					case 'sidebar-right' :
					?>

					<div class="col-sm-7 col-md-9 blog_latest_content" id="blog-latest-<?php echo $cortex_counter; ?>">

					<?php

					if ( $wp_query->have_posts() ) {

				?>
					<div class="flexsliderposts">
						<ul class="slides">
					<?php

					while ( $wp_query->have_posts() ) {

						$wp_query->the_post();

						$cortex_format = get_post_format();
						if ( ( $cortex_format === false) || ($cortex_format == 'image') ) { $cortex_format = 'standard';}
				?>
						<li>
				<?php

						get_template_part( 'page-builder/format', $cortex_format );
				?>
						</li>
				<?php
					}//endwhile
				?>
							</ul>
				</div><!--end posts slider-->
				<?php

					} else {

						get_template_part( 'content', 'none' );

					} //endif

					wp_reset_query();
					?>

					</div><!-- end col-->
					<div class="col-sm-5 col-md-3 sidebar" id="sidebar-right">
						<?php
						if ( is_active_sidebar( $cortex_select_sidebar ) ) {
							dynamic_sidebar( $cortex_select_sidebar ); 
						} else {
							esc_html__( 'Sidebar must have widgets assigned to them!', 'cortex' );
						}
						?>					
				</div><!-- end sidebar-->

				<?php

					// Reset main query object
					$wp_query = null;
					$wp_query = $temp_query;

					break;
					case 'sidebar-left' :
					?>

					<div class="col-sm-5 col-md-3 sidebar" id="sidebar-left">
						<?php
						if ( is_active_sidebar( $cortex_select_sidebar ) ) {
							dynamic_sidebar( $cortex_select_sidebar ); 
						} else {
							esc_html__( 'Sidebar must have widgets assigned to them!', 'cortex' );
						}
						?>					
				</div>

				<div class="col-sm-7 col-md-9 blog_latest_content" id="blog-latest-<?php echo $cortex_counter; ?>">

					<?php

					if ( $wp_query->have_posts() ) {

				?>
					<div class="flexsliderposts">
						<ul class="slides">
					<?php

					while ( $wp_query->have_posts() ) {

						$wp_query->the_post();

						$cortex_format = get_post_format();
						if ( ( $cortex_format === false) || ($cortex_format == 'image') ) { $cortex_format = 'standard';}
				?>
						<li>
				<?php

						get_template_part( 'page-builder/format', $cortex_format );
				?>
						</li>
				<?php
					} //end while
				?>
						</ul>
					</div><!--end flex slider-->
					<?php

					} else {

						get_template_part( 'content', 'none' );

					} //endif

					wp_reset_query();
					?>
					</div><!--end col-->

					<?php

					// Reset main query object
					$wp_query = null;
					$wp_query = $temp_query;

					break;
					case 'sidebar-none' :
					?>

					<div class="col-md-12 blog_latest_content">

					<?php

					if ( $wp_query->have_posts() ) {

				?>
					<div class="flexsliderposts">
						<ul class="slides">
					<?php

					while ( $wp_query->have_posts() ) {

						$wp_query->the_post();

						$cortex_format = get_post_format();
						if ( ( $cortex_format === false) || ($cortex_format == 'image') ) { $cortex_format = 'standard';}
				?>
						<li>
				<?php

						get_template_part( 'page-builder/format', $cortex_format );
				?>
						</li>
				<?php
					} //end while
				?>
						</ul>
					</div><!--end flex slider-->
				</div><!--end col-->

						<?php

					} else { // no posts found

						get_template_part( 'content', 'none' );

					} //endif

						wp_reset_query();
					?>

					<?php

					// Reset main query object
					$wp_query = null;
					$wp_query = $temp_query;
					break;
					default:
				}
?>

			</div><!-- #row -->

		</div><!-- #container -->
	</div><!--section-bg-->
</section>
<?php $cortex_counter++;
unset( $cortex_backgroundImage, $cortex_backgroundColor, $cortex_backgroundPattern, $cortex_style, $cortex_background, $cortex_backgroundRepeat, $cortex_customClass, $cortex_sidebar, $cortex_select_sidebar, $cortex_title, $cortex_sub_title, $cortex_filter_by_category, $cortex_filter_by_format, $cortex_number_of_posts_to_display ); ?>
