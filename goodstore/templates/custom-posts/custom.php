<?php
global $wp_query, $jaw_data, $post;

jaw_template_inc_counter('pagination');


if (!have_posts()) {
    ?>
    <div class="notice">
        <p class="bottom"><?php _e('We are sorry, no results were found. You can try to find some related posts using the search function.', 'jawtemplates'); ?></p>
    </div>
    <?php get_search_form();
    ?>	
<?php } ?>

<div class="row elements_iso jaw_paginated_<?php echo jaw_template_get_counter('pagination'); ?>">


    <?php


    while (have_posts()) {
        the_post();
        ?>

        <?php
        echo jaw_get_template_part('content-custom', 'custom-posts');

    }
    ?>

</div>                       

<div class="clear"></div>

<?php echo jwRender::pagination(jaw_template_get_var('pagination', jwOpt::get_option('blog_pagination', 'number'))); ?>





