<?php
/**
 * Social Links for posts
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 1.01
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license **LICENSE**
 * @version 1.5.8
 */
if ( is_single() && (oxy_get_option( 'fb_show' ) == 'show' || oxy_get_option( 'twitter_show' ) == 'show' || oxy_get_option( 'google_show' ) == 'show' ) ) { ?>
    <div class="blog-social-buttons small-screen-center">
        <?php
        if( oxy_get_option( 'twitter_show' ) == 'show' ) {
            $tweet_text = oxy_get_option('twitter_text') == '' ? '' : 'data-text="' . oxy_get_option('twitter_text') . '"'; ?>
            <div class="blog-social-button">
                <a href="https://twitter.com/share" class="twitter-share-button" data-hashtag="<?php echo oxy_get_option( 'twitter_hashtags' ); ?>" data-url="<?php the_permalink(); ?>" data-count="<?php echo oxy_get_option( 'twitter_count_box' ); ?>" data-size="<?php echo oxy_get_option( 'twitter_size' ); ?>"  <?php echo $tweet_text; ?>>Tweet</a>
            </div>
        <?php
        }
        if( oxy_get_option( 'google_show' ) == 'show' ) { ?>
            <div class="blog-social-button">
                <div class="g-plusone" href="<?php the_permalink(); ?>" data-size="<?php echo oxy_get_option( 'google_size' ); ?>" data-annotation="<?php echo oxy_get_option( 'google_annotation' ); ?>" data-expandTo="<?php echo oxy_get_option( 'google_expandTo' ); ?>"></div>
            </div>
        <?php
        }
        if( oxy_get_option( 'fb_show' ) == 'show' ) { ?>
            <div class="blog-social-button">
                <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="<?php echo oxy_get_option( 'fb_show_send' ); ?>" data-layout="<?php echo oxy_get_option('fb_layout'); ?>" data-show-faces="<?php echo oxy_get_option( 'fb_show_faces' ); ?>" data-font="<?php echo oxy_get_option( 'fb_font' ); ?>" data-colorscheme="<?php echo oxy_get_option( 'fb_colour' ); ?>" data-action="<?php echo oxy_get_option( 'fb_action' ); ?>"></div>
            </div>
        <?php
        } ?>
    </div>
    <?php
}
