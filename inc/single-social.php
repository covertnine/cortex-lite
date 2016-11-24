<?php
/**
 * Single Social Share buttons on posts
 *
 * @package Cortex
 **/
?>
<div class="single-box single-social wow animated fadeInUp">
	<h3 class="h5"><?php esc_html_e( 'Share', 'cortex' ); ?></h3>
    <ul class="single-social-share">
        <li class="share-facebook">
            <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php urlencode( get_the_title() ); ?>" target="_blank">
                <i class="icon-facebook-normal"></i>
                <span class="hide"><?php esc_html_e( 'Facebook', 'cortex' ); ?></span>
            </a>
        </li>
        <li class="share-twitter">
            <a href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php urlencode( get_the_title() ); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank">
				<i class="icon-twitter-normal"></i>
				<span class="hide"><?php esc_html_e( 'Twitter', 'cortex' ); ?></span>
            </a>
        </li>
        <li class="share-pinterest">
            <?php
			if ( has_post_thumbnail() ) {
				$pinimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
				$showpinimage = $pinimage[0];
			} elseif ( cortex_first_post_image() ) {
				$showpinimage = cortex_first_post_image();
			}
			?>
            <a href="//pinterest.com/pin/create/button/?url=<?php the_permalink();?><?php if ( ! empty( $showpinimage ) ) { echo '&amp;media='.$showpinimage; }?>&amp;description=<?php urlencode( get_the_title() ); ?>" target="_blank">
				<i class="icon-pinterest-normal"></i>
				<span class="hide"><?php esc_html_e( 'Pinterest', 'cortex' ); ?></span>
            </a>
        </li>
        <li class="share-gplus">
            <a href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank">
				<i class="icon-googleplus-normal"></i>
				<span class="hide"><?php esc_html_e( 'Google +', 'cortex' ); ?></span>
            </a>
        </li>
        <li class="share-linkedin">
            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php urlencode( get_the_title() ); ?>&amp;source=<?php urlencode( get_bloginfo( 'name' ) ); ?>">
                <i class="icon-linkedin-normal"></i>
                <span class="hide"><?php esc_html_e( 'LinkedIn', 'cortex' ); ?></span>
            </a>
       </li>
        <li class="share-mail">
            <a href="mailto:?subject=<?php urlencode( get_the_title() ); ?>&amp;body=<?php the_permalink(); ?>">
            	<i class="icon-email-normal"></i>
				<span class="hide"><?php esc_html_e( 'Email', 'cortex' ); ?></span>
            </a>
       </li>
    </ul>
</div><!-- social-box -->
