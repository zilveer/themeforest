<?php
extract(shortcode_atts(array(
     'post_type'              => 'post',
     'style'                  => 'modern',
     'column'                 => 3,
     'exclude_post_format'    => '',
     'disable_meta'           => 'true',
     'full_content'           => 'false',
     'grid_image_height'      => 350,
     'post_count'             => 10,
     'post_offset'            => 0,
     'count'                  => false, // deprecated will be removed in v5.5
     'offset'                 => false, // deprecated will be removed in v5.5
     'cat'                    => '',
     'posts'                  => '',
     'author'                 => '',
     'comments_share'         => 'true',
     'pagination'             => 'true',
     'pagination_style'       => '1',
     'image_size'             => 'crop',
     'orderby'                => 'date',
     'order'                  => 'DESC',
     'excerpt_length'         => 200,
     'thumbnail_align'        => 'left',
     'magazine_strcutre'      => '1',
     'el_class'               => '',
     'transparent_border'     => 'false',
), $atts));

// Added for backward compatibility and will be removed in v5.5
$count = (!empty($post_count) && $post_count != 10) ? $post_count : $count;
$offset = (!empty($post_offset) && $post_offset != 0) ? $post_offset : $offset;


Mk_Static_Files::addAssets('mk_blog');
Mk_Static_Files::addAssets('mk_button'); 
Mk_Static_Files::addAssets('mk_audio');
Mk_Static_Files::addAssets('mk_swipe_slideshow');