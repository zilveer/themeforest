<?php
/**
Template Name: Sitemap
 * The template for displaying 404 pages (Not Found) and Sitemap.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $a13_empty_error_msg;
$not_styled_page = is_404() || isset($a13_empty_error_msg);
$title = '';


/* 404 or empty archive/search*/
if($not_styled_page){
    define('A13_NO_STYLED_PAGE', true);
    $title = isset($a13_empty_error_msg)? $a13_empty_error_msg : __( 'Error 404', 'fame' );
}
//sitemap
else{
    $title = get_the_title();
}
get_header(); ?>

<?php a13_title_bar($title); ?>

<article id="content" class="clearfix">

    <div id="col-mask">

        <div class="post-content">
            <?php $not_styled_page? false : a13_top_image_video(); ?>

            <div class="real-content">

                <div class="clear"></div>

                <?php get_template_part( 'no-content'); ?>

                <?php
                wp_link_pages( array(
                        'before' => '<div id="page-links">'.__('Pages: ', 'fame' ),
                        'after'  => '</div>')
                );
                ?>
            </div>

        </div>

        <?php get_sidebar(); ?>

    </div>

</article>

<?php get_footer(); ?>