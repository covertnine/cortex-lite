<div class="container">

	<div class="row">

		<div class="widget-area" role="complementary">
			<div class="c9-footer-layout2 wow animated fadeInUp">
				<div id="footer-a" class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<?php
					if ( ! is_active_sidebar( 'cortex-footer-a' ) ) {
						esc_html__('Footer A is not active', 'cortex');
					} else {
						dynamic_sidebar( 'cortex-footer-a' );
					}
					?>
				</div>
				<div id="footer-b" class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<?php
					if ( ! is_active_sidebar( 'cortex-footer-b' ) ) {
						esc_html__('Footer B is not active', 'cortex');
					} else {
						dynamic_sidebar( 'cortex-footer-b' );
					}
					?>
				</div>
				<div id="footer-c" class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<?php
					if ( ! is_active_sidebar( 'cortex-footer-c' ) ) {
						esc_html__('Footer C is not active', 'cortex');
					} else {
						dynamic_sidebar( 'cortex-footer-c' );
					}
					?>
				</div>
				<div id="footer-d" class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<?php
					if ( ! is_active_sidebar( 'cortex-footer-d' ) ) {
						esc_html__('Footer D is not active', 'cortex');
					} else {
						dynamic_sidebar( 'cortex-footer-d' );
					}
					?>
				</div>
			</div><!--end row-->
		</div><!--end c9-footer-layout1-->
	</div><!--end widget-area-->

	</div><!--end row-->

</div><!--end container-->