<?php
/**
 * Display social icons to share content
 */
    global $post, $tl_display_read_more;

    $featured_image_url = '';

    if (has_post_thumbnail( $post->ID ) ){
        $featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        $featured_image_url = $featured_image_url[0];
    }
?>
<footer>
    <?php if($tl_display_read_more): ?>

        <?php do_action('layers_before_list_read_more'); ?>
        <p><a href="<?php the_permalink(); ?>" class="button button-secondary-style"><?php _e( 'Read More' , 'layerswp' ); ?><i class="icon-ti-angle-double-right"></i></a></p>
        <?php do_action('layers_after_list_read_more'); ?>

    <?php endif; ?>

    <div class="social-share">
        <p>
            <span><?php _e('Share on:', TL_DOMAIN); ?></span>
            <a class="hvr-wobble-horizontal" href="https://twitter.com/home?status=<?php echo urlencode(the_permalink()); ?>"><?php _e('Twitter', TL_DOMAIN)?></a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
            <a class="hvr-wobble-horizontal" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>"><?php _e('Facebook', TL_DOMAIN); ?></a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
            <?php if($featured_image_url): ?>
            <a class="hvr-wobble-horizontal" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode (site_url()); ?>&amp;media=<?php echo urlencode($featured_image_url); ?>&amp;description=<?php echo urlencode(get_the_title()); ?>"><?php _e('Pinterest', TL_DOMAIN); ?></a>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
            <?php endif; ?>
            <a class="hvr-wobble-horizontal" href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>"><?php _e('Google+', TL_DOMAIN); ?></a>
        </p>
    </div>
</footer>