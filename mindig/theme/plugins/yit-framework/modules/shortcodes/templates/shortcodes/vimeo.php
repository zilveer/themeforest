<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for embed the player vimeo video
 *
 * @package Yithemes
 * @author Francesco Grasso <francesco.grasso@yithemes.com>
 * @since 1.0.0
 */

$video_id = preg_replace('/[&|&amp;]feature=([\w\-]*)/', '', $video_id);

$shortcode_id = 'yit_video_' . mt_rand();

$placeholder = (isset($placeholder) && $placeholder != '') ? $placeholder : 'no';

if ($placeholder == 'no') {
    YIT_Video::vimeo("id=$video_id&width=$width&height=$height&echo=1");
} elseif ($placeholder == 'yes' && $placeholder_img != '') {
    ob_start();
    ?>
    <a class="yit_embedded_video" id="<?php echo $shortcode_id ?>" href="//player.vimeo.com/video/<?php echo $video_id ?>">
        <img src="<?php echo esc_url($placeholder_img) ?>"/>
    </a>
    <script>
        jQuery(document).ready(function ($) {
            $('#<?php echo $shortcode_id ?>').on('click', function (e) {
                e.preventDefault();
                var placeholder = $(this).find('img'),
                    video_w = placeholder.width(),
                    video_h = placeholder.height(),
                    video = '<iframe src="' + $(this).attr('href') + '?autoplay=1" width="' + video_w + '" height="' + video_h + '" frameborder="0" allowfullscreen></iframe>';
                $(this).replaceWith(video);
            });
        });

    </script>
    <?php
    echo ob_get_clean();

}