<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $zorka_data;
$sharing_facebook = isset($zorka_data['social-sharing']['sharing-facebook']) ? $zorka_data['social-sharing']['sharing-facebook'] : 0;
$sharing_twitter = isset($zorka_data['social-sharing']['sharing-twitter']) ? $zorka_data['social-sharing']['sharing-twitter'] : 0;
$sharing_google = isset($zorka_data['social-sharing']['sharing-google']) ? $zorka_data['social-sharing']['sharing-google'] : 0;
$sharing_linkedin = isset($zorka_data['social-sharing']['sharing-linkedin']) ? $zorka_data['social-sharing']['sharing-linkedin'] : 0;
$sharing_tumblr = isset($zorka_data['social-sharing']['sharing-tumblr']) ? $zorka_data['social-sharing']['sharing-tumblr'] : 0;
$sharing_pinterest = isset($zorka_data['social-sharing']['sharing-pinterest']) ? $zorka_data['social-sharing']['sharing-pinterest'] : 0;
$sharing_email = isset($zorka_data['social-sharing']['sharing-email']) ? $zorka_data['social-sharing']['sharing-email'] : 0;
$social_email_link = isset($zorka_data['social-email-link']) ? $zorka_data['social-email-link'] : '';


if (($sharing_facebook == 1) ||
($sharing_twitter == 1) ||
($sharing_linkedin == 1) ||
($sharing_tumblr == 1) ||
($sharing_google == 1) ||
($sharing_pinterest == 1) ||
($sharing_email == 1)
) :
?>
    <div class="single-product-share">
        <label><?php esc_html_e("Share this:","zorka"); ?></label>
        <?php if ($sharing_facebook == 1) : ?>
            <a onclick="window.open('https://www.facebook.com/sharer.php?s=100&p[url]=<?php echo esc_attr(urlencode(get_permalink()));?>','sharer', 'toolbar=0,status=0,width=620,height=280');" data-toggle="tooltip"  title="<?php esc_html_e('Share on Facebook','zorka');?>" href="javascript:;">
                <i class="fa fa-facebook"></i>
            </a>
        <?php endif; ?>

        <?php if ($sharing_twitter == 1) :  ?>
            <a onclick="popUp=window.open('http://twitter.com/home?status=<?php echo esc_attr(urlencode(get_the_title())); ?> <?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" data-toggle="tooltip"  title="<?php esc_html_e('Share on Twitter','zorka');?>"  href="javascript:;">
                <i class="fa fa-twitter"></i>
            </a>
        <?php endif; ?>

        <?php if ($sharing_google == 1) :  ?>
            <a data-toggle="tooltip" title="<?php echo esc_html_e('Share on Google +1','zorka');?>"  href="javascript:;" onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;">
                <i class="fa fa-google-plus"></i>
            </a>
        <?php endif; ?>

        <?php if ($sharing_linkedin == 1):?>
            <a data-toggle="tooltip" title="<?php esc_html_e('Share on Linkedin','zorka');?>"  onclick="popUp=window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;title=<?php echo esc_attr(urlencode(get_the_title())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                <i class="fa fa-linkedin"></i>
            </a>
        <?php endif; ?>

        <?php if ($sharing_tumblr == 1) :  ?>
            <a data-toggle="tooltip"  title="<?php esc_html_e('Share on Tumblr','zorka');?>" onclick="popUp=window.open('http://www.tumblr.com/share/link?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;name=<?php echo esc_attr(urlencode(get_the_title())); ?>&amp;description=<?php echo esc_attr(urlencode(get_the_excerpt())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;"">
                <i class="fa fa-tumblr"></i>
            </a>
        <?php endif; ?>

        <?php if ($sharing_pinterest == 1) :  ?>
            <a data-toggle="tooltip"  title="<?php esc_html_e('Share on Pinterest','zorka');?>" onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;description=<?php echo esc_attr(urlencode(get_the_title())); ?>&amp;media=<?php $arrImages = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo has_post_thumbnail() ? esc_attr($arrImages[0])  : "" ; ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;"">
                <i class="fa fa-pinterest"></i>
            </a>
        <?php endif; ?>

        <?php if ($sharing_email == 1) :  ?>
            <a data-toggle="tooltip" title="<?php esc_html_e('Share on Email','zorka');?>"  href="mailto:<?php echo esc_attr($social_email_link) ?>"">
                <i class="fa fa-envelope-o"></i>
            </a>
        <?php endif; ?>

    </div>
<?php endif; ?>