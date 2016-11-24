<div class="container">

	<div class="row">

		<div class="c9-footer-layout1 widget-area" role="complementary">
			<div class="c9-footer-layout1-top wow animated fadeInUp">
				<div id="footer-a" class="col-xs-12 col-sm-4 col-md-4">
					<?php
					if ( ! is_active_sidebar( 'cortex-footer-a' ) ) {
						esc_html__('Footer A is not active', 'cortex');
					} else {
						dynamic_sidebar( 'cortex-footer-a' );
					}
					?>
				</div>
				<div id="footer-b" class="col-xs-12 col-sm-4 col-md-4">
					<?php
					if ( ! is_active_sidebar( 'cortex-footer-b' ) ) {
						esc_html__('Footer B is not active', 'cortex');
					} else {
						dynamic_sidebar( 'cortex-footer-b' );
					}
					?>
				</div>
				<div id="footer-c" class="col-xs-12 col-sm-4 col-md-4">
					<?php
					if ( ! is_active_sidebar( 'cortex-footer-c' ) ) {
						esc_html__('Footer C is not active', 'cortex');
					} else {
						dynamic_sidebar( 'cortex-footer-c' );
					}
					?>
				</div>
			</div><!--end top part-->

		</div><!--end c9-footer-layout1 widget-area-->

	</div><!--end row-->

</div><!--end container-->

<div class="c9-footer-layout1-bottom">

	<div class="c9-footer-layout1 widget-area" role="complementary">

		<div id="footer-d" class="c9-footer-full-width">
			<?php
			if ( ! is_active_sidebar( 'cortex-footer-d' ) ) {
				esc_html__('Footer D is not active', 'cortex');
			} else {
				dynamic_sidebar( 'cortex-footer-d' );
			}
			?>
		</div>

	</div><!--end c9-footer-layout1 widget-area-->

</div><!--end c9-footer-layout1-bottom-->