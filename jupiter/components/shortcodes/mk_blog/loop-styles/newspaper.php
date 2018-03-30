<?php
global $mk_options;

switch ($view_params['column']) {
    case 1:
        $image_width = $image_width = round($mk_options['grid_width'] - 66);
        $mk_column_css = 'one-column';
        break;

    case 2:
        $image_width = $image_width = round($mk_options['grid_width'] / 2 - 46);
        $mk_column_css = 'two-column';
        break;

    case 3:
        $image_width = $mk_options['grid_width'] / 3 - 44;
        $mk_column_css = 'three-column';
        break;

    case 4:
        $image_width = $mk_options['grid_width'] / 4 - 36;
        $mk_column_css = 'four-column';
        break;

    default:
        $image_width = $mk_options['grid_width'] / 3 - 42;
        $mk_column_css = 'three-column';
        break;
}

$post_type = get_post_meta($post->ID, '_single_post_type', true);
$post_type = !empty($post_type) ? $post_type : 'image';

$output = '<article id="' . get_the_ID() . '" class="mk-blog-newspaper-item '.$post_type.'-post-type mk-isotop-item ' . $mk_column_css . '"><div class="blog-item-holder">';

$media_atts = array(
    'image_size' => $view_params['image_size'],
    'image_width' => $image_width,
    'image_height' => $view_params['grid_image_height'],
    'post_type' => $post_type,
    //'image_quality' => $view_params['image_quality']
);
$output.= mk_get_shortcode_view('mk_blog', 'components/featured-media', true, $media_atts);

$output.= '<div class="mk-blog-meta">';
$output.= mk_get_shortcode_view('mk_blog', 'components/title', true);
if ($view_params['disable_meta'] == 'true') {
    $output.= mk_get_shortcode_view('mk_blog', 'components/meta', true, ['author' => 'false', 'cats' => 'false']);
}
$output.= mk_get_shortcode_view('mk_blog', 'components/excerpt', true, ['excerpt_length' => $view_params['excerpt_length'], 'full_content' => $view_params['full_content']]);
$output.= '</div>';


$output.= '<div class="newspaper-item-footer"><div class="newspaper-item-footer-holder">';
$output.= mk_get_shortcode_view('mk_blog', 'components/read-more', true);
$output.= mk_get_shortcode_view('mk_blog', 'components/love-this', true);
if ($view_params['comments_share'] != 'false'):
    $output.= mk_get_shortcode_view('mk_blog', 'components/comments', true, ['post_type' => $post_type]);
    $output.= '<span class="newspaper-item-share">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-moon-share-2').'</span>';
endif;
$output.= '<div class="clearboth"></div>';
$output.= '</div>';


if ($view_params['comments_share'] != 'false') :

    $output.= mk_get_shortcode_view('mk_blog', 'components/newspaper-comments', true);

    $output.= '<ul class="newspaper-social-share">';
    $output.= '<li><a class="facebook-share" data-title="' . the_title_attribute(array('echo' => false)) . '" data-url="' . esc_url( get_permalink() ) . '" href="#">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-jupiter-icon-simple-facebook').'</a></li>';
    $output.= '<li><a class="twitter-share" data-title="' . the_title_attribute(array('echo' => false)) . '" data-url="' . esc_url( get_permalink() ) . '" href="#">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-jupiter-icon-simple-twitter').'</a></li>';
    $output.= '<li><a class="googleplus-share" data-title="' . the_title_attribute(array('echo' => false)) . '" data-url="' . esc_url( get_permalink() ) . '" href="#">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-jupiter-icon-simple-googleplus').'</a></li>';
    $output.= '<li><a class="pinterest-share" data-image="' . wp_get_attachment_image_src(get_post_thumbnail_id() , 'full', true) [0] . '" data-title="' . the_title_attribute(array('echo' => false)) . '" data-url="' . esc_url( get_permalink() ) . '" href="#">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-jupiter-icon-simple-pinterest').'</a></li>';
    $output.= '<li><a class="linkedin-share" data-desc="' . esc_attr(get_the_excerpt()) . '" data-title="' . the_title_attribute(array('echo' => false)) . '" data-url="' . esc_url( get_permalink() ) . '" href="#">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-jupiter-icon-simple-linkedin').'</a></li>';
    $output.= '</ul>';
endif;
$output.= '</div>';

$output.= '</div></article>' . "\n\n\n";

echo $output;
