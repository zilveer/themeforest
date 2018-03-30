<?php
get_header();
$sidebar_position = tfuse_sidebar_position();
$meta_width = tfuse_meta_width('image');
$likes = get_post_meta($post->ID,'tfuse_love_it', 1);
$views = get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', 1);
?>
<div id="middle" <?php tfuse_class('middle'); ?>>
    <div class="container portfolio_single">
        <div class="row">
            <?php tfuse_category_ads(); tfuse_hook(); ?>
            <div <?php tfuse_class('content'); ?>>
                <?php tfuse_shortcode_content('before'); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="post_details clearfix">
                        <div class="entry">
                            <div class="portfolio_item">
                                <div class="portfolio_img"><?php tfuse_media(); ?></div>
                                <?php if(tfuse_page_options('enable_post_meta',true)){ ?>
                                    <div class="meta_info clearfix" <?php echo 'style="width:'.$meta_width.'px"'; ?>>
                                        <?php if(tfuse_page_options('enable_published_date',true)){ ?>
                                            <span class="meta_date"><?php echo get_the_date(); ?></span>
                                        <?php } ?>
                                        <?php if(tfuse_page_options('enable_author_post',true)){ ?>
                                            <span class="meta_author"><?php the_author_posts_link(); ?></span>
                                        <?php } ?>
                                        <?php if(tfuse_page_options('likes',true)){ ?>
                                            <?php tfuse_loveit($post->ID); ?>
                                            <span class="meta_like <?php tfuse_loveit_class($post->ID); ?>"><?php echo $likes; ?></span>
                                        <?php } ?>
                                        <?php if(tfuse_page_options('views',true)){ ?>
                                            <span class="meta_views"><?php echo $views; ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <div class="portfolio_title"><h2><?php the_title(); ?></h2></div>
                                <div class="portfolio_desc"><?php the_content(); ?></div>
                            </div><!-- /.portfolio_item-->
                            <?php if ( tfuse_page_options('enable_comments') && tfuse_options('enable_posts_comments') ) tfuse_comments(); ?>
                        </div><!-- /.entry -->
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