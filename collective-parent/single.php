<?php
    get_header();
    $sidebar_position = tfuse_sidebar_position();
    $post_type = tfuse_page_options('post_type','image');
    if($post_type == 'video') $class = 'post_video';
    elseif($post_type == 'gallery') $class = 'post_gallery';
    else $class = '';
?>
<div id="middle" <?php tfuse_class('middle'); ?>>
    <div class="container">
        <div class="row">
            <?php tfuse_category_ads(); tfuse_hook(); ?>
            <div <?php tfuse_class('content'); ?>>
                <?php tfuse_shortcode_content('before'); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="post_item post_details no-bg <?php echo $class; ?>">
                        <?php get_template_part('content','single'); ?>
                        <?php if ( tfuse_page_options('enable_comments') && tfuse_options('enable_posts_comments') ) tfuse_comments(); ?>
                    </article>
                <?php endwhile; // end of the loop. ?>
            </div><!--/ .content -->

            <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                <div class="span4 clearfix">
                    <?php get_sidebar(); ?>
                </div><!--/ .sidebar -->
            <?php endif; ?>
        </div><!--/ .row -->
    </div><!--/ .container -->
</div><!--/ .middle -->

<?php get_footer(); ?>