<?php
get_header();
$sidebar_position = tfuse_sidebar_position();
?>
<div id="middle">
    <div class="container">
        <div class="row">
            <?php tfuse_category_ads(); tfuse_hook(); ?>
            <div <?php tfuse_class('content'); ?>>
                <?php  tfuse_shortcode_content('before'); ?>
                <div class="service_list">
                    <div class="row">
                        <?php
                        if (have_posts())
                        {
                            $count = 0;
                            while (have_posts()) : the_post(); $count++;
                                get_template_part('listing', 'services');
                                if($count%3==0) echo '<div class="clear"></div>';
                            endwhile;
                        }
                        else
                        { ?>
                            <h5 class="sorry_title"><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                        <?php } ?>
                    </div>
                    <div class="text-center"><?php tfuse_pagination(); ?></div>
                </div>
            </div>
            <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
            <div class="sidebar span4 clearfix">
                <?php get_sidebar(); ?>
            </div><!--/ .sidebar -->
            <?php endif; ?>
        </div><!--/ .row -->
    </div><!--/ .container -->
</div><!--/ .middle -->

<?php get_footer();?>