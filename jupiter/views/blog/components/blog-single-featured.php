<?php

/**
 * template part for blog single featured image/video/audio single.php. views/blog/components
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */

if(mk_get_blog_single_style() == 'bold') return false;

global $mk_options;

if ($mk_options['single_disable_featured_image'] == 'true' && get_post_meta($post->ID, '_disable_featured_image', true) != 'false'):

    $post_type = get_post_meta($post->ID, '_single_post_type', true);
    $post_type = !empty($post_type) ? $post_type : 'image';

    $media_atts = array(
        'single_post'   => true,
        'image_size'    => ($mk_options['blog_single_img_crop'] == 'true') ? 'crop' : 'full',
        'image_width'   => mk_count_content_width($post->ID),
        'image_height'  => $mk_options['single_featured_image_height'],
        'post_type'     => $post_type,
        'image_quality' => 1
    );
    echo  mk_get_shortcode_view('mk_blog', 'components/featured-media', true, $media_atts);


endif;
