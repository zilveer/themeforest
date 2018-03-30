<?php
/**
 * Share template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 1.1.5
 */
?>

<div class="yith-wcwl-share">
    <h4 class="yith-wcwl-share-title"><?php echo $share_title ?></h4>
    <ul>
        <?php if( $share_facebook_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="facebook chaffle" data-lang="en" href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $share_link_title ?>&amp;p[url]=<?php echo $share_link_url ?>&amp;p[summary]=<?php echo $share_summary ?>&amp;p[images][0]=<?php echo $share_image_url ?>" title="<?php _e( 'Facebook', 'yit' ) ?>"><?php _e( 'Facebook', 'yit' ) ?></a>
            </li>
        <?php endif; ?>

        <?php if( $share_twitter_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="twitter chaffle" data-lang="en" href="https://twitter.com/share?url=<?php echo $share_link_url ?>&amp;text=<?php echo $share_twitter_summary ?>" title="<?php _e( 'Twitter', 'yit' ) ?>"><?php _e( 'Twitter', 'yit' ) ?></a>
            </li>
        <?php endif; ?>

        <?php if( $share_pinterest_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="pinterest chaffle" data-lang="en" href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link_url ?>&amp;description=<?php echo $share_summary ?>&media=<?php echo $share_image_url ?>" title="<?php _e( 'Pinterest', 'yit' ) ?>" onclick="window.open(this.href); return false;"><?php _e('Pinterest', 'yit') ?></a>
            </li>
        <?php endif; ?>

        <?php if( $share_googleplus_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="googleplus chaffle" data-lang="en" href="https://plus.google.com/share?url=<?php echo $share_link_url ?>&amp;title=<?php echo $share_link_title ?>" title="<?php _e( 'Google+', 'yit' ) ?>" onclick='javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'><?php _e('Google plus', 'yit') ?></a>
            </li>
        <?php endif; ?>

        <?php if( $share_email_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a class="email chaffle" data-lang="en" href="mailto:?subject=I wanted you to see this site&amp;body=<?php echo $share_link_url ?>&amp;title=<?php echo $share_link_title ?>" title="<?php _e( 'Email', 'yit' ) ?>"><?php _e('Email', 'yit'); ?></a>
            </li>
        <?php endif; ?>
    </ul>
</div>