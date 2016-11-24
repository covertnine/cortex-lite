<?php
$cortex_customClass     = esc_html( get_sub_field('custom_class') );
$cortex_title       = get_sub_field('title');
$cortex_sub_title      = get_sub_field('sub_title');
$cortex_filter_by_category    = get_sub_field('filter_by_category');
$cortex_filter_by_format    = get_sub_field('filter_by_format');
$cortex_number_of_posts_to_display  = get_sub_field('number_of_posts_to_display');

?>
<section id="section-<?php echo $cortex_counter; ?>" class="blog_latest blog_latest_slider<?php if ( !empty($cortex_customClass) ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg" data-top="opacity: 1" data-top-bottom="opacity: 0" data-anchor-target="#section-<?php echo $cortex_counter; ?> .section-bg .container">
		<div class="container">
			<?php if ( ( !empty($cortex_title) ) || ( !empty($cortex_sub_title) ) ) { ?>
			<div class="row wow animated fadeInUp">
				<div class="blog_latest_title col-md-12">
					<?php if ( $cortex_title != '' ) { echo '<h3>' . $cortex_title . '</h3>';} ?>
					<?php if ( $cortex_sub_title != '' ) { echo '<span class="subtitle">' . $cortex_sub_title . '</span>';} ?>
				</div>
			</div>
			<?php } ?>

			<div class="row">

				<?php
if ( ( empty($cortex_filter_by_category) ) && ( empty($cortex_filter_by_format) ) ) { //no filtering, output everything

	$args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'posts_per_page'   => $cortex_number_of_posts_to_display,
		'pagination'             => true
	);

} elseif ( ( !empty($cortex_filter_by_category) ) && ( empty($cortex_filter_by_format) ) ) { //filter by category

	$args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'posts_per_page'   => $cortex_number_of_posts_to_display,
		'category__in'    => $cortex_filter_by_category,
		'pagination'             => false
	);

} elseif ( ( empty($cortex_filter_by_category) ) && ( !empty($cortex_filter_by_format ) ) ) { //filter by format

	$args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'posts_per_page'   => $cortex_number_of_posts_to_display,
		'tax_query'     => array(
			array(
				'taxonomy'   => 'post_format',
				'terms'   => $cortex_filter_by_format,
				'operator'   => 'IN'
			)
		),
		'pagination'             => false
	);

} elseif ( ( !empty($cortex_filter_by_category) ) && ( !empty($cortex_filter_by_format ) ) ) { //filter by category and format

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
				'operator' => 'IN'
			)
		),
		'pagination'             => false
	);

}

// The Query
$cortex_wp_query = new WP_Query( $args );
?>

				<div class="col-md-12 blog_latest_content">

					<?php

if ( $cortex_wp_query->have_posts() ) {

?>
					<div class="flexsliderposts">
						<ul class="slides">
					<?php

	while ( $cortex_wp_query->have_posts() ) {

		$cortex_wp_query->the_post();

		$cortex_format = get_post_format();
		if (($cortex_format === false) || ($cortex_format == 'image')) { $cortex_format = 'standard';}
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
					</div><!--end flex-->
				</div><!--end col-->
	<?php

} else {

	get_template_part( 'content', 'none' );

} //endif

wp_reset_query();
?>

			</div><!-- #row -->
		</div><!--end container-->
	</div><!--section-bg-->
</section>
<?php $cortex_counter++; unset($cortex_title, $cortex_sub_title, $cortex_filter_by_category, $cortex_filter_by_format, $cortex_number_of_posts_to_display, $cortex_customClass); ?>