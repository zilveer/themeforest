<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
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
        <div class="page-wrapper">
            <div class="tittle-line margin-top-title">
                <h5><?php the_title();?></h5>
                <div class="divider-1 small">
                    <div class="divider-small"></div>
                </div>
            </div>

            <?php the_content();?>
        </div>
    <?php endwhile;

    // If comments are open, load up the comment template.
    if ( comments_open() || get_comments_number() ) {
        ?>
        <div class="comment-page-full clearfix">
            <?php comments_template(); ?>
        </div>
    <?php
    }
get_footer();