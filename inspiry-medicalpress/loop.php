<?php
/* Main loop */
if (have_posts()) :
    while (have_posts()) :
        the_post();

        $current_post_type = get_post_type($post->ID);
        if ($current_post_type == 'post') {
            get_template_part("template-parts/blog-post");
        } else {
            /* to display other post types */
            get_template_part("template-parts/common-excerpt");
        }

    endwhile;
    global $wp_query;
    inspiry_pagination($wp_query);
else :
    nothing_found(__('No Post Found!', 'framework'));
endif;
?>