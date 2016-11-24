<?php
global $cortex_options;
if ( $cortex_options['c9-enable-search'] == true ) {
?>
<div id="search">
    <button type="button" class="search-close accent-color-bg"><i class="fa fa-close"></i><span class="sr-only"><?php _e('Close', 'cortex'); ?></span></button>
    <form role="search" method="get" id="fullscreen" action="<?php echo home_url( '/' ); ?>">
        <div>
	    	<span class="sr-only"><?php _e('Search for:', 'cortex'); ?></span>
			<input type="search" class="search-field" name="s" value="" placeholder="<?php _e('Search...', 'cortex'); ?>" />
			<button type="submit" class="btn"><?php _e('Search', 'cortex'); ?></button>
        </div>
    </form>
</div>
<?php } ?>