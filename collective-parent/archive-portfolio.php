<?php
get_header();
$sidebar_position = tfuse_sidebar_position();
$columns = tfuse_get_portfolio_columns();
?>
<div id="middle" <?php tfuse_class('middle'); ?>>
    <div class="container">
        <div class="row">
            <?php tfuse_category_ads(); tfuse_hook(); ?>
            <div <?php tfuse_class('content'); ?>>
                <?php tfuse_shortcode_content('before'); ?>
                <article class="post_details clearfix">
                    <div class="entry">
                        <?php tfuse_show_filter(); ?>
                        <div class="portfolio_list clearfix border_bottom">
                            <div class="row">
                                <?php
                                if (have_posts())
                                {
                                    $count = 0;
                                    while (have_posts()) : the_post(); $count++;
                                        if($count==1 && $columns=='2') tfuse_featured_portfolio();
                                        else get_template_part('listing', 'portfolio');
                                    endwhile;
                                }
                                else { ?>
                                    <h5 class="sorry_title"><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                                    <?php } ?>
                            </div><!-- /.row -->
                        </div><!-- /.portfolio_list -->
                        <div class="text-center"><?php tfuse_pagination(); ?></div>
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