<?php 
global $is_tf_blog_page;
get_header();
if ($is_tf_blog_page) die();
$sidebar_position = tfuse_sidebar_position();
?>
<div id="middle" <?php tfuse_class('middle'); ?>>
    <div class="container">
        <div class="row">
            <?php tfuse_category_ads(); tfuse_hook(); ?>
            <div <?php tfuse_class('content'); ?>>
                <?php tfuse_shortcode_content('before'); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="post_details clearfix">
                        <div class="entry">
                            <?php the_content(); ?>
                        </div><!--/ .entry -->
                    </article>
                <?php endwhile; // end of the loop. ?>
                <?php if ( tfuse_page_options('enable_comments') && tfuse_options('enable_posts_comments') ) tfuse_comments(); ?>
            </div><!--/ .content -->

            <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                <div class="sidebar span4 clearfix">
                    <?php get_sidebar(); ?>
                </div><!--/ .sidebar -->
            <?php endif; ?>
        </div><!--/ .row -->
    </div><!--/ .container -->
</div><!--/ .middle -->

<?php get_footer(); ?>