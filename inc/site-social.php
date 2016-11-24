<?php
/*
 * Template for the output of the fixed social media icons
 */
global $cortex_options;
$cortex_theme_options = $cortex_options;
$cortex_icon_color 	  = $cortex_theme_options['c9-icon-color'];
$cortex_icon_type	  = sanitize_html_class( $cortex_theme_options['c9-icon-type'] );
$cortex_icon_position = sanitize_html_class( $cortex_theme_options['c9-icon-position'] );
?>
<?php if ( $cortex_theme_options['c9-enable-social'] == true ) { // social icons are enabled ?>
<div id="social-media-icons" class="hidden-xs cortex-social-media<?php if ( $cortex_icon_color == 'dark' ) { echo ' darki'; } ?>">
	<div class="cortex-social-media-container widget_cortex_subscribe_widget<?php if ( ! empty($cortex_icon_position) ) { echo ' '.$cortex_icon_position; } ?>">
		<ul>
<?php
if ( ! empty( $cortex_theme_options['c9-icon-facebook'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-facebook'] ) . '" target="_blank" title="Facebook" class="cortex-susbcribe icon-facebook-' . $cortex_icon_type .'"><span class="hide">Facebook</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-twitter'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-twitter'] ) . '" target="_blank" title="Twitter" class="cortex-susbcribe icon-twitter-' . $cortex_icon_type .'"><span class="hide">Twitter</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-instagram'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-instagram'] ) . '" target="_blank" title="Instagram" class="cortex-susbcribe icon-instagram-' . $cortex_icon_type .'"><span class="hide">Instagram</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-flickr'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-flickr'] ) . '" target="_blank" title="Flickr" class="cortex-susbcribe icon-flickr-' . $cortex_icon_type .'"><span class="hide">Flickr</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-googleplus'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-googleplus'] ) . '" target="_blank" title="Google+" class="cortex-susbcribe icon-googleplus-' . $cortex_icon_type .'"><span class="hide">Google+</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-email'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-email'] ) . '" target="_blank" title="Email" class="cortex-susbcribe icon-email-' . $cortex_icon_type .'"><span class="hide">Email Newsletter</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-youtube'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-youtube'] ) . '" target="_blank" title="YouTube" class="cortex-susbcribe icon-youtube-' . $cortex_icon_type .'"><span class="hide">Youtube</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-tumblr'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-tumblr'] ) . '" target="_blank" title="Tumblr" class="cortex-susbcribe icon-tumblr-' . $cortex_icon_type .'"><span class="hide">Tumblr</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-yelp'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-yelp'] ) . '" target="_blank" title="Yelp" class="cortex-susbcribe icon-yelp-' . $cortex_icon_type .'"><span class="hide">Yelp</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-lastfm'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-lastfm'] ) . '" target="_blank" title="Last.fm" class="cortex-susbcribe icon-lastfm-' . $cortex_icon_type .'"><span class="hide">Last.fm</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-pinterest'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-pinterest'] ) . '" target="_blank" title="Pinterest" class="cortex-susbcribe icon-pinterest-' . $cortex_icon_type .'"><span class="hide">Pinterest</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-reddit'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-reddit'] ) . '" target="_blank" title="Reddit" class="cortex-susbcribe icon-reddit-' . $cortex_icon_type .'"><span class="hide">Reddit</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-linkedin'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-linkedin'] ) . '" target="_blank" title="Linkedin" class="cortex-susbcribe icon-linkedin-' . $cortex_icon_type .'"><span class="hide">LinkedIn</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-map'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-map'] ) . '" target="_blank" title="Google Maps" class="cortex-susbcribe icon-map-' . $cortex_icon_type .'"><span class="hide">Google Map</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-github'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-github'] ) . '" target="_blank" title="Git Hub" class="cortex-susbcribe icon-github-' . $cortex_icon_type .'"><span class="hide">Git Hub</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-soundcloud'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-soundcloud'] ) . '" target="_blank" title="SoundCloud" class="cortex-susbcribe icon-soundcloud-' . $cortex_icon_type .'"><span class="hide">Sound Cloud</span></a></li>';
}
if ( ! empty( $cortex_theme_options['c9-icon-deviantart'] ) ) {
	echo '<li><a href="' . esc_url( $cortex_theme_options['c9-icon-deviantart'] ) . '" target="_blank" title="Deviant Art" class="cortex-susbcribe icon-deviantart-' . $cortex_icon_type .'"><span class="hide">Deviant Art</span></a></li>';
}
?>
		</ul>
	</div>
</div><!--end cortex-social-media-->
	<?php } ?>
