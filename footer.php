<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package cortex
 */
global $cortex_options;
$cortex_theme_options 		= $cortex_options;
$cortex_custom_js     		= $cortex_theme_options['c9-custom-js'];
$cortex_footer_layout		= $cortex_theme_options['c9-footer-layout'];
$cortex_footer_headings		= $cortex_theme_options['c9-footer-headings'];
$cortex_copyright_field     = wp_kses_post( $cortex_theme_options['c9-footer-copyright'] );
$cortex_google_analytics    = str_replace( array('<p>','</p>','<br />'), '', $cortex_theme_options['c9-analytics-js'] );
?>
<div id="footer-bottom" class="footer-container">

	<div id="footer-scrolltop" class="c9-back-to-top wow animated fadeIn" data-wow-delay="2s">
		<a href="#page" title="<?php _e('Back To Top', 'cortex'); ?>" class="btn-scrolltop"><i class="fa fa-angle-up"></i></a>
	</div>

	<div class="<?php if ($cortex_theme_options['c9-footer-headings'] == true) { echo "with-heading"; } else { echo "no-heading"; } ?>">

	<?php
		switch ($cortex_footer_layout) {
			case 'layout1' :
				include( locate_template( 'parts/footer-layout1.php' ) );
			break;
			case 'layout2' :
				include( locate_template( 'parts/footer-layout2.php' ) );
			break;
			case 'layout3' :
				include( locate_template( 'parts/footer-layout3.php' ) );
			break;
			default :
				include( locate_template( 'parts/footer-layout1.php' ) );
			break;
		}
	?>

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container">
		<div class="row">
				<div class="site-info">
					<?php if ( ! empty( $cortex_copyright_field ) ) { echo $cortex_copyright_field; } else { esc_html__( '&copy; COMPANY NAME. Edit me on the Cortex Theme Options page. Wordpress Theme CORTEX by COVERT NINE.', 'cortex' ); } ?>
				</div><!-- .site-info -->
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!--end footer-container-->
</div><!-- #content -->
</div><!--end skrollr-body-->
</div><!-- #page -->
<?php include( 'inc/site-social.php' ); ?>
<?php include( 'inc/site-search.php' ); ?>
<?php wp_footer(); ?>
<?php if ( ! empty( $cortex_custom_js ) ) { ?>
<script type="text/javascript">
<?php echo $cortex_custom_js; ?>
</script>
<?php
}
?>
<?php
if ( ! empty( $cortex_google_analytics ) ) {
	echo $cortex_google_analytics;
}
?>
</body>
</html>
