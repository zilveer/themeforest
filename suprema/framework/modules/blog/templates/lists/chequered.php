<div class="qodef-blog-holder qodef-blog-type-chequered <?php echo esc_attr($blog_classes)?>"   data-blog-type="<?php echo esc_attr($blog_type)?>" <?php echo esc_attr(suprema_qodef_set_blog_holder_data_params()); ?> >
    <?php
    if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
        suprema_qodef_get_post_format_html($blog_type);
    endwhile;
    else:
        suprema_qodef_get_module_template_part('templates/parts/no-posts', 'blog');
    endif;
    ?>
    <?php
    if(suprema_qodef_options()->getOptionValue('pagination') == 'yes') {
        suprema_qodef_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
    }
    ?>
</div>
