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
                <h1><?php _e('Search Results for:', 'framework');
                    echo ' ';
                    the_search_query(); ?></h1>
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

<?php get_footer(); ?>
