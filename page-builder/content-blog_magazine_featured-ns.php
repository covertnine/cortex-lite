<?php
$cortex_customClass     = esc_html( get_sub_field( 'custom_class' ) );
$cortex_title       = get_sub_field( 'title' );
$cortex_sub_title      = get_sub_field( 'sub_title' );
$cortex_filter_by_category    = get_sub_field( 'filter_by_category' );
$cortex_filter_by_format    = get_sub_field( 'filter_by_format' );
$cortex_number_of_posts_to_display  = get_sub_field( 'number_of_posts_to_display' );
$cortex_view_more_btn     = get_sub_field( 'view_more_btn' );
$cortex_view_more_button_link   = esc_url( get_sub_field( 'view_more_button_link' ) );
$cortex_display_date     = get_sub_field( 'display_date' );
$cortex_display_post_meta    = get_sub_field( 'display_post_meta' );
$cortex_display_post_excerpt   = get_sub_field( 'display_post_excerpt' );
$cortex_number_of_f_posts_to_display  = get_sub_field( 'number_of_featured_posts' );

?>
<section id="section-<?php echo $cortex_counter; ?>" class="magazine_latest magazine_latest_featured<?php if ( ! empty( $cortex_customClass ) ) { echo ' '.$cortex_customClass; } ?>">
	<div class="section-bg">

			<?php if ( ( ! empty( $cortex_title ) ) || ( ! empty( $cortex_sub_title ) ) ) { ?>
			<div class="row wow animated fadeInUp">
				<div class="magazine_latest_title col-md-12 mar30B">
					<?php if ( $cortex_title != '' ) { echo '<span class="h1 center mar10B">' . $cortex_title . '</span>';} ?>
					<?php if ( $cortex_sub_title != '' ) { echo '<span class="subtitle center mar10B">' . $cortex_sub_title . '</span>';} ?>
				</div>
			</div>
			<?php } ?>

			<div class="row">

				<?php
// build the non-featured query arguments based on selections
if ( ( empty( $cortex_filter_by_category ) ) && ( empty( $cortex_filter_by_format ) ) ) { // no filtering, output everything

	$args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'pagination'             => false,
		'orderby'     => 'date',
		'order'      => 'DESC',
		'posts_per_page'   => $cortex_number_of_f_posts_to_display,
	);

} elseif ( ( ! empty( $cortex_filter_by_category ) ) && ( empty( $cortex_filter_by_format ) ) ) { // filter by category

	$args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'category__in'    => $cortex_filter_by_category,
		'order'      => 'DESC',
		'orderby'     => 'date',
		'pagination'             => false,
		'posts_per_page'   => $cortex_number_of_f_posts_to_display,
	);

} elseif ( ( empty( $cortex_filter_by_category ) ) && ( ! empty( $cortex_filter_by_format ) ) ) { // filter by format

	$args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'tax_query'     => array(
			array(
				'taxonomy'   => 'post_format',
				'terms'   => $cortex_filter_by_format,
				'operator'   => 'IN',
			),
		),
		'order'      => 'DESC',
		'orderby'     => 'date',
		'pagination'             => false,
		'posts_per_page'   => $cortex_number_of_f_posts_to_display,
	);

} elseif ( ( ! empty( $cortex_filter_by_category ) ) && ( ! empty( $cortex_filter_by_format ) ) ) { // filter by category and format

	$args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'category__in'    => $cortex_filter_by_category,
		'tax_query'     => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'term_id',
				'terms'    => $cortex_filter_by_format,
				'operator' => 'IN',
			),
		),
		'order'      => 'DESC',
		'pagination'             => false,
		'posts_per_page'   => $cortex_number_of_f_posts_to_display,
	);

} //end of building the non featured


// The Query
$cortex_wp_featured_query = new WP_Query( $args );
?>

				<div class="col-md-12 magazine_latest_content" id="magazine-latest-<?php echo $cortex_counter; ?>">

					<div class="row">

					<?php

if ( $cortex_wp_featured_query->have_posts() ) {

?>
						<div class="col-xs-12 col-sm-6 col-md-7 magazine_latest_featured_article">
					<?php
	while ( $cortex_wp_featured_query->have_posts() ) {

		$cortex_wp_featured_query->the_post();

		$cortex_format = get_post_format();
		if ( ( $cortex_format === false) || ($cortex_format == 'image') ) { $cortex_format = 'standard';}


?>
							<div class="wow animated fadeInUp magazine-article mar30B wow animated fadeInUp <?php echo $cortex_format; ?>">
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<figure class="magazine-image entry-image">
									<?php

		switch ( $cortex_format ) {
		case 'video':
			$cortex_iframe = get_field( 'video_link' );

			if ( $cortex_iframe !== '' ) {
				// use preg_match to find iframe src
				preg_match( '/src="(.+?)"/', $cortex_iframe, $matches );
				$src = $matches[1];


				// add extra params to iframe src
				$params = array(
					'controls'     => 1,
					'hd'           => 1,
					'autohide'     => 1,
					'showinfo'    => 0,
					'iv_load_policy'  => 3,
					'modestbranding'  => 1,
					'rel'     => 0,
					'byline'    => 0,
					'portrait'    => 0,
					'title'     => 0,
				);

				$new_src = add_query_arg( $params, $src );

				$cortex_iframe = str_replace( $src, $new_src, $cortex_iframe );
				$cortex_iframe = str_replace( 'frameborder="0"', '', $cortex_iframe );


				// check for SSL and appropriately re-embed the iframe with the proper source being http or https
				if ( ( ! empty( $_SERVER['HTTPS'] ) ) && ( $_SERVER['HTTPS'] != 'off' ) ) {

					// ssl connection
					$cortex_iframe = str_replace( 'http:', 'https:', $cortex_iframe );

				} else {

					// non-ssl connection
					$cortex_iframe = str_replace( 'https:', 'http:', $cortex_iframe );

				}
			}
?>
													<div class="embed-container"><?php echo $cortex_iframe; ?></div>
										<?php
			break;
		case 'audio':

			// get iframe HTML
			$cortex_iframe = get_field( 'audio_link' );
			$cortex_iframe = str_replace( 'frameborder="0"', '', $cortex_iframe );


			if ( has_post_thumbnail() ) {
?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?></a>
						<?php } ?>
							<div class="audio-embed-container mar20B"><?php echo $cortex_iframe; ?></div>
										<?php
			break;
		case 'quote':
			$cortex_person    = get_field( 'person' );
			$cortex_quote_text   = get_field( 'quote_text' );
			$cortex_quote_source = get_field( 'quote_source' );
			$cortex_quote_link   = esc_url( get_field( 'quote_link' ) );

			if ( has_post_thumbnail() ) {
?>
								 <div class="dark-overlay"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?></a><span class="h6 quote-source"><strong><?php echo $cortex_person; ?></strong></span></div><?php } ?>

										<?php
			break;
		default:

			if ( has_post_thumbnail() ) {
?>
								 <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?></a><?php } ?>
										<?php
			break;
		} //end format switch
?>
								</figure>
								<header class="entry-header">
									<?php
		if ( $cortex_format != 'quote' ) {
?>
										<div class="magazine-article-header">
											<?php if ( $cortex_display_date == true ) { ?>
											<div class="magazine-article-date"><span class="h5 alternate"><?php cortex_posted_on(); ?></span></div>
											<?php } ?>
											<h5 class="entry-title h3"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
											<?php if ( $cortex_display_post_meta == true ) { ?>
											<div class="entry-meta">
												<?php cortex_author(); ?> / <?php cortex_post_categories(); ?> <?php cortex_post_tags(); ?>
											</div><!-- .entry-meta -->
											<?php } ?>
										</div><!--end magazine-article-header-->
											<?php
		} else {
?>
										<div class="magazine-article-header">
											<h5 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
										</div>
										<?php
		}
?>
								</header><!-- .entry-header -->

								<?php if ( $cortex_format != 'quote' ) { // check for post quote type ?>

										<?php if ( $cortex_display_post_excerpt == true ) { // check if excerpt is to be displayed ?>

										<div class="entry-content magazine-article-content">
											<?php echo cortex_the_excerpt( 'Read more', 45, 1 ); ?>
										</div>

										<?php } ?>

									<?php } else { // it is a post quote so show the quote ?>

										<blockquote><?php echo $cortex_quote_text; ?></blockquote>
										<?php if ( $cortex_quote_source != '' ) { ?>

											<?php if ( $cortex_quote_link == '' ) { ?>
												<small><?php echo $cortex_quote_source; ?></small>
											<?php } else { ?>
												<a href="<?php echo $cortex_quote_link; ?>" target="_blank" title="<?php the_title_attribute(); ?>"><span class="small-link"><?php echo $cortex_quote_source; ?></span></a>
											<?php } ?>

										<?php } ?>
									<?php
		} //end of checking to see if it's a quote type
?>
							</article>
							</div>
						<?php } //end of while post for featured ?>
						</div><!--end column-->
							<?php
} else { // no posts were found

	get_template_part( 'content', 'none' );

} //endif

wp_reset_query();
?>
							<div class="col-xs-12 col-sm-6 col-md-5 magazine-recent-posts">
							<?php
// build the non-featured query arguments based on selections
if ( ( empty( $cortex_filter_by_category ) ) && ( empty( $cortex_filter_by_format )) ) { // no filtering, output everything

	$recent_args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'pagination'             => false,
		'offset'     => $cortex_number_of_f_posts_to_display,
		'orderby'     => 'date',
		'order'      => 'DESC',
		'posts_per_page'   => $cortex_number_of_posts_to_display,
		'ignore_sticky_posts' => true
	);

} elseif ( ( ! empty( $cortex_filter_by_category ) ) && ( empty( $cortex_filter_by_format )) ) { // filter by category

	$recent_args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'category__in'    => $cortex_filter_by_category,
		'order'      => 'DESC',
		'orderby'     => 'date',
		'pagination'             => false,
		'offset'     => $cortex_number_of_f_posts_to_display,
		'posts_per_page'   => $cortex_number_of_posts_to_display,
		'ignore_sticky_posts' => true
	);

} elseif ( (empty( $cortex_filter_by_category ) ) && ( ! empty( $cortex_filter_by_format )) ) { // filter by format

	$recent_args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'tax_query'     => array(
			array(
				'taxonomy'   => 'post_format',
				'terms'   => $cortex_filter_by_format,
				'operator'   => 'IN',
			),
		),
		'order'      => 'DESC',
		'orderby'     => 'date',
		'pagination'             => false,
		'offset'     => $cortex_number_of_f_posts_to_display,
		'posts_per_page'   => $cortex_number_of_posts_to_display,
		'ignore_sticky_posts' => true
	);

} elseif ( ( ! empty( $cortex_filter_by_category ) ) && ( ! empty( $cortex_filter_by_format )) ) { // filter by category and format

	$recent_args = array(
		'post_type'              => 'post',
		'post_status'    => 'publish',
		'category__in'    => $cortex_filter_by_category,
		'tax_query'     => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'term_id',
				'terms'    => $cortex_filter_by_format,
				'operator' => 'IN',
			),
		),
		'order'      => 'DESC',
		'orderby'     => 'date',
		'pagination'             => false,
		'offset'     => $cortex_number_of_f_posts_to_display,
		'posts_per_page'   => $cortex_number_of_posts_to_display,
		'ignore_sticky_posts' => true
	);

} //end of building the non featured query


// The Query for recent posts offset by 1 because we already pulled the most recent
$cortex_wp_query_recent = new WP_Query( $recent_args );

if ( $cortex_wp_query_recent->have_posts() ) {

	while ( $cortex_wp_query_recent->have_posts() ) {
		$cortex_wp_query_recent->the_post();
?>
						<div class="single-article-container wow animated fadeInUp">
							<article class="single-article mar20B">
								<?php if ( has_post_thumbnail() ) { ?>
								<figure class="single-article-image entry-image alignleft">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cortex-featured-audio', array( 'class' => 'img-responsive' ) ); ?></a>
								</figure>
								<?php } ?>
								<header class="single-article-title alignleft">
									<div class="magazine-article-date"><span class="h6 alternate"><?php cortex_posted_on(); ?></span></div>
									<h4 class="entry-title mar5T mar5B"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="mar0T h5"><?php the_title();?></span></a></h4>
								</header>
								<div class="clearfix"></div>
							</article>
						</div>


						<?php
	} //end of while post for recent items
} else { // no posts were found

	get_template_part( 'content', 'none' );

} //endif

wp_reset_query();
?>
							</div><!--end column-->

						</div><!--end row-->


						<?php if ( $cortex_view_more_btn == true ) { ?>
						<div class="row wow animated fadeInUp">
							<div class="col-md-12">
							<div class="view-more-btn center">
								<a class="btn btn-md btn-default secondary-color-bg" href="<?php echo $cortex_view_more_button_link; ?>"><?php esc_html_e( 'View All', 'cortex' ); ?></a>
							</div>
							</div>
						</div><!--end row-->
						<?php } ?>

				</div><!--end outside col for sidebar-->
			</div><!-- #row -->

	</div><!--section-bg-->
</section>
<?php $cortex_counter++;
unset( $cortex_backgroundImage, $cortex_backgroundColor, $cortex_backgroundPattern, $cortex_style, $cortex_view_more_button_link ); ?>
