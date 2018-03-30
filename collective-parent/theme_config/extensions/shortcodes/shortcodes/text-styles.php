<?php
/**
 * Test Styles
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * name:
 * instance:
 * args:
 * 
 * http://codex.wordpress.org/Function_Reference/the_widget
 */

function tfuse_text_styles($atts, $content = null) {
    extract(shortcode_atts(array( 'type' => '','link' => '','target' => ''), $atts));
	$before = '';
	$after = '';
	switch(strtolower($type))
    {
		case 'link':
            $before = '<a href="'.$link.'" target="'.$target.'">';
            $after = '</a>';
            break;
	   case 'strong':
            $before = '<strong>';
            $after = '</strong>';
            break;
        case 'italic':
            $before = '<em>';
            $after = '</em>';
            break;
        case 'strike':
            $before = '<s>';
            $after = '</s>';
            break;
        case 'mark':
            $before = '<mark>';
            $after = '</mark>';
            break;
        case 'insert':
            $before = '<ins>';
            $after = '</ins>';
            break;
        case 'subscript':
            $before = '<sub>';
            $after = '</sub>';
            break;
        case 'superscript':
            $before = '<sup>';
            $after = '</sup>';
            break;
    }

    $return_html = $before . do_shortcode($content) . $after;
    
    return $return_html;
}

$atts = array(
    'name' => __('Text Styles','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
		array(
            'name' => __('Type','tfuse'),
            'desc' => __('Specify the type','tfuse'),
            'id' => 'tf_shc_text_styles_type',
            'value' => 'link',
            'options' => array(
				'link' => __('link','tfuse'),
                'strong' => __('strong','tfuse'),
                'italic' => __('italic','tfuse'),
                'strike' => __('strike','tfuse'),
                'mark' => __('mark','tfuse'),
                'insert' => __('insert','tfuse'),
                'subscript' => __('subscript','tfuse'),
                'superscript' => __('superscript','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_text_styles_content',
            'value' => '',
            'type' => 'textarea'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the URL of the page the link goes to','tfuse'),
            'id' => 'tf_shc_text_styles_link',
            'value' => '',
            'type' => 'text'
        ),
		array(
            'name' => __('Target','tfuse'),
            'desc' => __('Specifies the the of the site the link goes to,ex:_blank,_self,_parent,_top','tfuse'),
            'id' => 'tf_shc_text_styles_target',
            'value' => '',
            'type' => 'text'
        ),

    )
);

tf_add_shortcode('text_styles', 'tfuse_text_styles', $atts);