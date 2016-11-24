<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package cortex
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	esc_html__('Sidebar is not active', 'cortex');
} else {
?>
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
<?php } ?>