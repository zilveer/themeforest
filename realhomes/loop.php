<?php
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        get_template_part("template-parts/article-for-listing");
    endwhile;
    theme_pagination( $wp_query->max_num_pages);
else :
    ?><p class="nothing-found"><?php _e('No Posts Found!', 'framework'); ?></p><?php
endif;
?>