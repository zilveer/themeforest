<?php
get_header();
$sidebar_position = tfuse_sidebar_position();
?>
<div id="middle" <?php tfuse_class('middle'); ?>>
    <div class="container">
        <div class="row">
            <div <?php tfuse_class('content'); ?>>
                <?php tfuse_shortcode_content('before'); ?>
                <article class="post_details post_list clearfix">
                    <div class="entry">
                        <?php
                        if (have_posts())
                        {
                            $count = 0;
                            while (have_posts()) : the_post(); $count++;
                                get_template_part('listing', 'blog');
                            endwhile;
                        }
                        else { ?>
                            <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                            <?php } tfuse_pagination(); ?>
                    </div><!-- /.entry -->
                </article>
            </div><!-- /.content -->

            <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
            <div class="sidebar span4 clearfix">
                <?php get_sidebar(); ?>
            </div><!--/ .sidebar -->
            <?php endif; ?>
        </div><!--/ .row -->
    </div><!--/ .container -->
</div><!--/ #middle -->

<?php get_footer(); ?>