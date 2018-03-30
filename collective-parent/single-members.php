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
                    <div class="post_title"><h2><?php the_title(); ?></h2></div>
                    <?php
                    if(tfuse_page_options('thumbnail_image','',$post->ID) !=''){
                        $image = new TF_GET_IMAGE();
                        $img = $image->width(300)->height(300)->properties(array('class'=>'alignleft'))->src(tfuse_page_options('thumbnail_image','',$post->ID))->get_img();
                        echo $img;
                    } ?>
                    <div class="post_desc clearfix"><?php the_content(); ?></div>
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