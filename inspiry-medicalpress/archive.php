<?php
get_header();

get_template_part('template-parts/banner');
?>
    <div class="page-top clearfix">
        <div class="container">
            <div class="row">
                <div class="<?php bc('9', '8', '7', ''); ?>">
                    <?php
                    $post = $posts[0]; // Hack. Set $post so that the_date() works.

                    if (is_category()) {
                        ?><h2 class="page-title"><?php _e('All Posts in Category:', 'framework');
                        echo ' ' . single_cat_title('', false); ?></h2><?php
                    } elseif (is_tag()) {
                        ?><h2 class="page-title"><?php _e('All Posts Tagged:', 'framework');
                        echo ' ' . single_tag_title('', false); ?></h2><?php
                    } elseif (is_day()) {
                        ?><h2 class="page-title"><?php _e('Archive for', 'framework') ?> <?php printf(__('%s', 'framework'), get_the_date()); ?></h2><?php
                    } elseif (is_month()) {
                        ?><h2 class="page-title"><?php _e('Archive for', 'framework') ?> <?php printf(__('%s', 'framework'), get_the_date('F Y')); ?></h2><?php
                    } elseif (is_year()) {
                        ?><h2 class="page-title"><?php _e('Archive for', 'framework') ?> <?php printf(__('%s', 'framework'), get_the_date('Y')); ?></h2><?php
                    } elseif (is_author()) {
                        $current_author = $wp_query->get_queried_object();
                        ?><h2 class="page-title"><?php _e('All posts by', 'framework') ?> <?php echo $current_author->display_name; ?></h2><?php
                    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
                        ?><h2 class="page-title"><?php _e('Blog', 'framework') ?> <?php _e('Archives', 'framework') ?></h2><?php
                    }
                    ?>
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