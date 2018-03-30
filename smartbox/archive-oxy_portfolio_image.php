<?php
/**
 * Displays the archive for oxy_portfolio_image custom post type
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

get_header();

$page = oxy_get_option( 'portfolio_archive_page' );
$allow_comments = oxy_get_option( 'site_comments' );
if( !empty( $page ) ) :

    global $post;
    $post = get_post($page);
    setup_postdata($post);
?>
<section class="section section-padded">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span9"><?php
                oxy_page_header( $post->ID );
                get_template_part('partials/content', 'page'); ?>
            </div>
            <aside class="span3 sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</section><?php
    wp_reset_postdata();

endif;

get_footer();