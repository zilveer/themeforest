<?php
/**
 * Image Frames
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_frame($atts, $content = null)
{
    extract(shortcode_atts(array('link' => '', 'target' => '_self', 'width' => '', 'height' => '', 'alt' => '', 'align' => '', 'src' => '', 'prettyphoto' => ''), $atts));

    if ($prettyphoto == 'true')
        return '<a href="' . $src . '" target="' . $target . '" data-rel="prettyPhoto" ><img class="frame_' . $align . ' preload" src="' . $src . '"  width="' . $width . '" height="' . $height . '" alt="' . $alt . '" /></a>';
    else
        return '<a href="' . $link . '" target="' . $target . '"><img class="frame_' . $align . '" src="' . $src . '"  width="' . $width . '" height="' . $height . '" alt="' . $alt . '"  /></a>';
}

$atts = array(
    'name' => __('Image Frame','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for this shortcode.','tfuse'),
    'category' => 1,
    'options' => array(
        array(
            'name' => __('Source','tfuse'),
            'desc' => __('Specifies the URL of an image','tfuse'),
            'id' => 'tf_shc_frame_src',
            'value' => 'http://themefuse.com/banners/125x125.png',
            'type' => 'text'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the URL of the page the link goes to','tfuse'),
            'id' => 'tf_shc_frame_link',
            'value' => 'http://themefuse.com/',
            'type' => 'text'
        ),
        array(
            'name' => __('Target','tfuse'),
            'desc' => __('Specifies where to open the linked shortcode','tfuse'),
            'id' => 'tf_shc_frame_target',
            'value' => '',
            'options' => array(
                '_self' => __('In the same frame as it was clicked','tfuse'),
                '_blank' => __('In a new window or tab','tfuse'),
                '_parent' => __('In the parent frame','tfuse'),
                '_top' => __('In the full body of the window','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Width','tfuse'),
            'desc' => __('Specifies the width of an image','tfuse'),
            'id' => 'tf_shc_frame_width',
            'value' => '125',
            'type' => 'text'
        ),
        array(
            'name' => __('Height','tfuse'),
            'desc' => __('Specifies the height of an image','tfuse'),
            'id' => 'tf_shc_frame_height',
            'value' => '125',
            'type' => 'text'
        ),
        array(
            'name' => __('Alt','tfuse'),
            'desc' => __('Specifies an alternate text for an image','tfuse'),
            'id' => 'tf_shc_frame_alt',
            'value' => 'Premium Wordpress Themes',
            'type' => 'text'
        ),
        array(
            'name' => __('Align','tfuse'),
            'desc' => __('Specifies the alignment of an image (left, center, right)','tfuse'),
            'id' => 'tf_shc_frame_align',
            'value' => 'left',
            'type' => 'text'
        ),
        array(
            'name' => __('prettyPhoto','tfuse'),
            'desc' => __('Open image with prettyphoto','tfuse'),
            'id' => 'tf_shc_frame_prettyphoto',
            'value' => '',
            'type' => 'checkbox'
        )
    )
);

tf_add_shortcode('frame', 'tfuse_frame', $atts);