<?php
/**
 * Template Name: Visual Builder Template
 */
get_header();
//show inner banner
if(defined('FW'))
{
    //get inner banner
    $banner = fw_get_db_post_option($post->ID,'page_inner_banner');

    if($banner['enable-page-banner'] == 'yes')
    {
        $subtitle = $banner['yes']['page-subtitle'];
        $breadcrumbs = $banner['yes']['enable-page-breadcrumbs'];

        //show inner banner
        fw_show_inner_banner($banner['enable-page-banner'], get_the_title(), $subtitle, $breadcrumbs);
    }
}

    //show page content
    while ( have_posts() ) : the_post();?>
        <?php the_content();?>
    <?php endwhile;

    // If comments are open, load up the comment template.
    if ( comments_open() ) {
        ?>
        <div class="comment-page-full">
            <?php comments_template(); ?>
        </div>
    <?php
    }
get_footer();