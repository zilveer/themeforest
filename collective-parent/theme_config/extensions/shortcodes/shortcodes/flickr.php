<?php
/**
 * Flickr
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * title:
 * flickr_id:
 * items:
 */

function tfuse_flickr($atts, $content)
{
    extract(shortcode_atts(array('items' => 9, 'flickr_id' => '', 'title'=>''), $atts));

    if( !empty($title) ) $title = '<div class="title clearfix"><h2>' . $title . '</h2></div>';
    return '<div class="flickr shortcode_flickr">' . $title . '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' . $items . '&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=' . $flickr_id . '"></script></div><div class="clear"></div>';
}

$atts = array(
    'name' => __('Flickr','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Text to display above the flickr','tfuse'),
            'id' => 'tf_shc_flickr_title',
            'value' => 'Flickr photostream',
            'type' => 'text'
        ),
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Enter the number of images','tfuse'),
            'id' => 'tf_shc_flickr_items',
            'value' => '6',
            'type' => 'text'
        ),
        array(
            'name' => __('Flickr ID','tfuse'),
            'desc' => __('Flickr Id <a href="http://idgettr.com/" target="_blank">idGettr</a>','tfuse'),
            'id' => 'tf_shc_flickr_flickr_id',
            'value' => '51362473@N05',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('flickr', 'tfuse_flickr', $atts);