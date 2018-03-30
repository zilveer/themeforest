<?php
/**
 * Featured Post
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_featured_post($atts, $content = null)
{
    extract( shortcode_atts(array('title' => '','id' => ''), $atts) );
    $link = get_permalink($id);
    $featured_post = get_post($id);
    $src = tfuse_page_options('thumbnail_image','single_image',$id);
    $image = TF_GET_IMAGE::get_src_link($src, 235, 202);
    $img = '<img src="'.$image.'">';
    $html = '<div class="span6 mobile featured">';
    if($title != '') $html .= '<div class="title clearfix"><h2>'.$title.'</h2></div>';
    $html .= '<div class="item_post clearfix">
        <div class="item_meta alignleft">'.$img.'
            <div class="meta_info clearfix">
                <span class="meta_date">'.date("M j, Y", strtotime($featured_post->post_date)).'</span><span class="meta_author">'.get_the_author().'</span><a class="link_more" href="'.$link.'"></a>
            </div>
        </div>
        <div class="item_entry clearfix">
            <h3 class="item_title"><a href="'.$link.'">'.get_the_title($id).'</a></h3>'.$featured_post->post_excerpt.'
        </div><a href="'.$link.'" class="link_read">'.__('Read more','tfuse').'</a>
    </div></div>';

    return $html;
}
$atts = array(
    'name' => __('Featured Post','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Text to display above the box','tfuse'),
            'id' => 'tf_shc_featured_post_title',
            'value' => 'Featured',
            'type' => 'text'
        ),
        array(
            'name' => __('Select the featured post','tfuse'),
            'desc' => __('Select the featured post','tfuse'),
            'id' => 'tf_shc_featured_post_id',
            'value' => '0',
            'options' => tfuse_list_posts(),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('featured_post', 'tfuse_featured_post', $atts);