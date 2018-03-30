<?php
/**
 * prettyPhoto
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * title:
 * link:
 * type: link/button
 * gallery:
 * style:
 * class:
 * 
 * http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
 */

function tfuse_prettyPhoto($atts, $content = null)
{
    extract(shortcode_atts(array('title' => '',	'link' => '', 'thumb' => '','type' => 'image', 'gallery' => '', 'style' => '', 'class' => ''), $atts));

    if (empty($gallery))
        $gallery = 'p_' . rand(1, 1000);
    if (!empty($style))
        $style = 'style="' . $style . '"';
    $template_directory = get_template_directory_uri();
    if ( $type == 'button' )
        return '<a href="' . $link . '" class="button prettyPhoto ' . $class . '" ' . $style . ' data-rel="prettyPhoto[' . $gallery . ']" title="' . $title . '"><span>' . $content . '</span></a>';
    else if ( $type == 'image' )
        return '<a href="' . $link . '" class=" prettyPhoto" ' . $style . ' data-rel="prettyPhoto[' . $gallery . ']" title="' . $title . '" > <img src="'.$thumb.'" alt="" class="frame_box"> </a>&nbsp;';
    else if ( $type == 'youtube' )
        return '<a href="' . $link . '" class=" prettyPhoto" ' . $style . ' data-rel="prettyPhoto[' . $gallery . ']" title="' . $title . '" > <img src="'.$template_directory.'/images/youtube_logo.png" width="60"> </a>&nbsp;';
    else if ( $type == 'vimeo' )
        return '<a href="' . $link . '" class=" prettyPhoto" ' . $style . ' data-rel="prettyPhoto[' . $gallery . ']" title="' . $title . '" > <img src="'.$template_directory.'/images/vimeo_logo.png" width="60"> </a>&nbsp;';
    else
        return '<a href="' . $link . '" class="' . $class . ' prettyPhoto" ' . $style . ' data-rel="prettyPhoto[' . $gallery . ']" title="' . $title . '" >' . $content . '</a>';
}

$atts = array(
    'name' => __('PrettyPhoto','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 5,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title','tfuse'),
            'id' => 'tf_shc_prettyPhoto_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the URL of an image','tfuse'),
            'id' => 'tf_shc_prettyPhoto_link',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Thumbnail','tfuse'),
            'desc' => __('Specifies the URL of the thumbnaii image','tfuse'),
            'id' => 'tf_shc_prettyPhoto_thumb',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Specify the type for an shortcode','tfuse'),
            'id' => 'tf_shc_prettyPhoto_type',
            'value' => 'image',
            'options' => array(
                'link' => __('Link','tfuse'),
                'button' => __('Button','tfuse'),
                'image' => __('Image','tfuse'),
                'youtube' => __('Youtube','tfuse'),
                'vimeo' => __('Vimeo','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Gallery','tfuse'),
            'desc' => __('Specify the name, if you want display images in gallery prettyPhoto','tfuse'),
            'id' => 'tf_shc_prettyPhoto_gallery',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Style','tfuse'),
            'desc' => __('Specify an inline style for an shortcode','tfuse'),
            'id' => 'tf_shc_prettyPhoto_style',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode. To specify multiple classes,<br /> separate the class names with a space, e.g. <b>"left important"</b>.','tfuse'),
            'id' => 'tf_shc_prettyPhoto_class',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter prettyPhoto Content','tfuse'),
            'id' => 'tf_shc_prettyPhoto_content',
            'value' => 'Open image with prettyPhoto',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('prettyPhoto', 'tfuse_prettyPhoto', $atts);