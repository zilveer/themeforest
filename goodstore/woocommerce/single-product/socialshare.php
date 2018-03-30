<?php
global $post;
ob_start();

$title = urlencode(get_the_title());
$link = urlencode(get_permalink());
$media = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large-size');
$media = urlencode($media[0]);
$desc = urlencode($post->post_excerpt);
?>
<ul class="socialshare-icon">
    <?php if (jwOpt::get_option('product_share_fb', '1') == '1') { ?>
        <li>
            <a class="link-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>&t=<?php echo $title; ?>">
                <span class="icon-facebook4"></span>
            </a>
        </li>
    <?php } ?>
    <?php if (jwOpt::get_option('product_share_tw', '1') == '1') { ?>
        <li>
            <a class="link-twitter" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo $link; ?>&text=<?php echo $title; ?>&url=<?php echo $link; ?>">
                <span class="icon-twitter3"></span>
            </a>
        </li>
    <?php } ?>
    <?php if (jwOpt::get_option('product_share_g', '1') == '1') { ?>
        <li>
            <a class="link-google" target="_blank" href="https://plus.google.com/share?url=<?php echo $link; ?>">
                <span class="icon-google-plus4"></span>
            </a>
        </li>
    <?php } ?>
    <?php if (jwOpt::get_option('product_share_pi', '1') == '1') { ?>
        <li>
            <a class="link-pinterest" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo $link; ?>&media=<?php echo $media ?>&description=<?php echo $desc; ?>">
                <span class="icon-pinterest"></span>
            </a>
        </li>
    <?php } ?>
    <?php if (jwOpt::get_option('product_share_mail', '1') == '1') { ?>
        <li>
            <a class="link-email" target="_blank" href="mailto:<?php echo jwOpt::get_option('product_share_mail_content', 'youremail@addresshere.com'); ?>?subject=<?php echo urldecode($title); ?>&body=<?php echo strip_tags(urldecode($desc)) . ' Link: ' . $link; ?>">
                <span class="icon-mail4 "></span>
            </a>
        </li> 
    <?php } ?>

</ul>
<?php
$buf = ob_get_clean();
echo $buf;
