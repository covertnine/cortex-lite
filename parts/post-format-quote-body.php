<?php
$cortex_person    = get_field( 'person' );
$cortex_quote_text   = get_field( 'quote_text' );
$cortex_quote_source = get_field( 'quote_source' );
$cortex_quote_link   = esc_url( get_field( 'quote_link' ) );
?>
<div class="entry-content-quote wow animated fadeInUp">
	<blockquote><?php echo $cortex_quote_text; ?><span class="quote-source"><strong><?php echo $cortex_person; ?></strong></span></blockquote>
	<?php if ( $cortex_quote_source != '' ) { ?>

		<?php if ( $cortex_quote_link == '' ) { ?>
			<small><?php echo $cortex_quote_source; ?></small>
		<?php } else { ?>
			<a href="<?php echo $cortex_quote_link; ?>" target="_blank" title="<?php the_title_attribute(); ?>"><span class="small-link third-color-text"><?php echo $cortex_quote_source; ?></span></a>
		<?php } ?>

	<?php } ?>
</div>
<div class="entry-content-quote-editor mar60T mar60B">
	<?php the_content(); ?>
</div>
