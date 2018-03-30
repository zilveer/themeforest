<?php
global $mk_options;
$output = '';

$post_type = get_post_meta(get_the_ID(), '_single_post_type', true);

if($post_type == 'blockquote' || $post_type == 'twitter' || $post_type == 'instagram') return false;

if ($mk_options['blog_single_comments'] == 'true'):
    if (get_post_meta($post->ID, '_disable_comments', true) != 'false') {
        ob_start();
        comments_number('0', '1', '%');
        $output.= '<a href="' . esc_url( get_permalink() ) . '#comments" class="blog-loop-comments">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-moon-bubble-13', 16).'<span>' . ob_get_contents() . '</span></a>';
        ob_end_clean();
    }
endif;

echo $output;
