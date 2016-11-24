<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package cortex
 */

if ( ! is_active_sidebar( 'footer-top' ) ) {
	esc_html__('Footer Top Sidebar is not active', 'cortex');
} else {
?>
<div id="footer-top" class="wow animated fadeInUp">
	<div id="secondary-top" class="c9-footer-full-width widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-top' ); ?>
	</div><!-- #secondary -->
</div>
<?php } ?>
