<?php

$template_type = hashmag_mikado_options()->getOptionValue('blog_list_type');


$params = array();

if ($template_type == "type1") {

    $template_type_layout = 'post-template-one';

    $template_classes = "mkdf-pl-one-holder mkdf-post-columns-1";

    $params['title_tag'] = 'h3';
    $params['title_length'] = '';
    $params['display_date'] = 'yes';
    $params['date_format'] = 'F d';
    $params['display_category'] = 'yes';
    $params['display_author'] = 'yes';
    $params['display_comments'] = 'yes';
    $params['display_excerpt'] = 'yes';
    $params['excerpt_length'] = '20';
    $params['thumb_image_size'] = '';
    $params['thumb_image_width'] = '';
    $params['thumb_image_height'] = '';
    $params['display_post_type_icon'] = 'no';
    $params['display_share'] = 'yes';
    $params['display_count'] = 'no';
    $params['display_like'] = 'no';
    $params['display_featured_icon'] = 'no';

} else if ($template_type == "type2") {

    $template_type_layout = 'post-template-six';

    $template_classes = "mkdf-pl-six-holder mkdf-post-columns-1";

    $params['title_tag'] = 'h2';
    $params['title_length'] = '';
    $params['display_date'] = 'yes';
    $params['display_author'] = 'no';
    $params['display_comments'] = 'yes';
    $params['display_count'] = 'no';
    $params['date_format'] = 'F d';
    $params['display_excerpt'] = 'yes';
    $params['excerpt_length'] = '20';
    $params['custom_thumb_image_width'] = '374';
    $params['custom_thumb_image_height'] = '249';
    $params['display_like'] = 'no';
    $params['display_category'] = 'no';
    $params['custom_thumb_image_width'] = '374';
    $params['image_style'] = '';
    $params['display_featured_icon'] = 'no';

} else if ($template_type == "type3") {

    $template_type_layout = 'post-template-one';

    $template_classes = "mkdf-pl-one-holder mkdf-post-columns-2";

    $params['title_tag'] = 'h3';
    $params['title_length'] = '';
    $params['display_date'] = 'yes';
    $params['date_format'] = 'F d';
    $params['display_category'] = 'yes';
    $params['display_author'] = 'yes';
    $params['display_comments'] = 'yes';
    $params['display_excerpt'] = 'yes';
    $params['excerpt_length'] = '20';
    $params['thumb_image_size'] = '';
    $params['thumb_image_width'] = '';
    $params['thumb_image_height'] = '';
    $params['display_post_type_icon'] = 'no';
    $params['display_share'] = 'yes';
    $params['display_count'] = 'no';
    $params['display_like'] = 'no';
    $params['display_featured_icon'] = 'no';

} else if ($template_type == "type4") {

    $template_type_layout = 'post-template-one';

    $template_classes = "mkdf-pl-one-holder mkdf-post-columns-3";

    $params['title_tag'] = 'h3';
    $params['title_length'] = '';
    $params['display_date'] = 'yes';
    $params['date_format'] = 'F d';
    $params['display_category'] = 'yes';
    $params['display_author'] = 'yes';
    $params['display_comments'] = 'yes';
    $params['display_excerpt'] = 'yes';
    $params['excerpt_length'] = '20';
    $params['thumb_image_size'] = '';
    $params['thumb_image_width'] = '';
    $params['thumb_image_height'] = '';
    $params['display_post_type_icon'] = 'no';
    $params['display_share'] = 'yes';
    $params['display_count'] = 'no';
    $params['display_like'] = 'no';
    $params['display_featured_icon'] = 'no';

}

?>

    <div class="mkdf-unique-type clearfix">
        <?php
        if ($blog_query->have_posts()) { ?>
            <div class="mkdf-bnl-holder <?php echo esc_attr($template_classes); ?>">
                <div class="mkdf-bnl-outer">
                    <div class="mkdf-bnl-inner">
                        <?php
                        while ($blog_query->have_posts()) : $blog_query->the_post();
                            echo hashmag_mikado_get_list_shortcode_module_template_part($template_type_layout, 'templates', '', $params);
                        endwhile;
                        ?>
                    </div>
                </div>
            </div>
            <?php
        } else {
            hashmag_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
        }
        ?>
    </div>
<?php
if (hashmag_mikado_options()->getOptionValue('pagination') == 'yes') {
    hashmag_mikado_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
}
?>