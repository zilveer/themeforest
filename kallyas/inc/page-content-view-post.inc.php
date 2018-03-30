<?php if(! defined('ABSPATH')){ return; }
/**
 * Displays the layout for the post type POST, inside page.php
 * @internal
 * @see page-content-template.inc.php
 */

/* DISPLAY POST CONTENT */
global $zn_config;

// Check if PB Element has style selected, if not use Blog style option. If no blog style option, use Global site skin.
$blog_style_global = zget_option( 'blog_style', 'blog_options', false, '' ) != '' ? zget_option( 'blog_style', 'blog_options', false, '' ) : zget_option( 'zn_main_style', 'color_options', false, 'light' );
$blog_style = isset($zn_config['blog_style']) && $zn_config['blog_style'] != '' ? $zn_config['blog_style'] : $blog_style_global;

// Get multiple columns option
$blog_multi_columns = isset($zn_config['blog_multicolumns']) && $zn_config['blog_multicolumns'] != '' ? $zn_config['blog_multicolumns'] : zget_option( 'sbo_multicolumns', 'blog_options', false, '1' );

$blog_layout = zget_option('sg_layout', 'blog_options', false, 'classic');

$sb_use_full_image = zget_option('sb_use_full_image', 'blog_options', false, 'no');

$post_format    = get_post_format() ? get_post_format() : 'standard';
$current_post   = zn_setup_post_data( $post_format );

$link_post_img = zget_option('sb_link_post_img', 'blog_options', false, 'no') == 'yes' ? 'kl-blog-link-images' : '';

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('kl-single-layout--'.$blog_layout); ?>>

    <?php echo $current_post['before_head']; ?>

    <div class="itemView clearfix eBlog kl-blog kl-blog-list-wrapper kl-blog--style-<?php echo $blog_style; ?> <?php echo $link_post_img; ?>">

        <?php

        // Load single header details
        include(locate_template( 'components/blog/default-single-'. $blog_layout .'/single-main.php' ));

        ?>
    </div>
    <!-- End Item Layout -->
</div>
