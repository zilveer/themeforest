<?php
/* Include Header */
get_header();

/* Include Banner */
get_template_part('template-parts/banner');
?>

    <div class="page-top clearfix">
        <div class="container">
            <div class="row">
                <div class="<?php bc('9', '8', '7', ''); ?>">
                    <?php
                    $page_for_posts = get_option('page_for_posts');
                    if ($page_for_posts) {
                        $blog = get_post($page_for_posts);
                        ?><h1><?php echo $blog->post_title; ?></h1><?php
                    } else {
                        ?><h1><?php _e('Blog', 'framework'); ?></h1><?php
                    }
                    ?>
                    <nav class="bread-crumb">
                        <?php theme_breadcrumb(); ?>
                    </nav>
                </div>
                <div class="<?php bc('3', '4', '5', ''); ?>">
                    <?php get_template_part('search-form'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-page clearfix">
        <div class="container">
            <div class="row">
                <div class="<?php bc('9', '8', '12', ''); ?>">
                    <div class="blog-post-listing clearfix">
                        <?php get_template_part('loop'); ?>
                    </div>
                </div>
                <div class="<?php bc('3', '4', '12', ''); ?>">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>

<?php

/* Include Footer */
get_footer();

?>