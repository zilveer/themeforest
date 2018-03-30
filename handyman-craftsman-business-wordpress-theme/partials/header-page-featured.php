<?php
/**
 * Layers dynamic sidebar for all pages
 */
use \Handyman\Front as F;
use \Handyman\Extras as E;

global $post;

    /**
     * Include request handyman && google map on inner pages
     */
    if(is_archive() ||
        is_page_template('template-blog.php') ||
        (is_front_page() && is_home()) ||
        is_attachment() ||
        get_post_type() == 'post'
    ) {
        get_template_part('partials/header', 'page-blog');
    } elseif (is_page()) {
        /**
         * Header for pages created with custom Templates (Blog template does not count)
         */
        get_template_part('partials/header', 'page-static');
    } else {
        //get_template_part('partials/header', 'page-404');
        get_template_part('partials/header', 'page-blog');
    }