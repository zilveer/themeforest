<?php
get_header();
$sidebar_position = tfuse_sidebar_position();
?>
<div id="middle" <?php tfuse_class('middle'); ?>>
    <div class="container">
        <div class="row">
            <?php tfuse_category_ads(); tfuse_hook(); ?>
            <div <?php tfuse_class('content'); ?>>
                <?php tfuse_shortcode_content('before'); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="post_item post_service post_details no-bg">
                        <div class="title clearfix"><h2><?php the_title(); ?></h2></div>
                        <div class="post_desc clearfix">
                            <?php if(tfuse_page_options('thumbnail_image')!=''){ ?>
                                <div class="service_img service_single_img">
                                    <img src="<?php echo tfuse_page_options('thumbnail_image'); ?>" alt="<?php the_title(); ?>">
                                </div>
                            <?php } ?>
                            <?php the_content(); ?>
                        </div>
                        <?php if ( tfuse_page_options('enable_comments') && tfuse_options('enable_services_comments') ) tfuse_comments(); ?>
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