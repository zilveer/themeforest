<?php get_header(); ?>

<?php
global $wp_query;
$curauth = $wp_query->get_queried_object();
?>

<div id="content" class="<?php echo implode(' ', jwLayout::content_width()); ?> builder-section" role="main">

    <div id="admin_info" role="main" class="">
        <div class="about_author">
            <div class="author_name">
                <h2><?php echo $curauth->nickname; ?></h2>
            </div>
            <div class="author_link"><a href="<?php echo get_author_posts_url($curauth->ID); ?>"><?php _e('About the author', 'jawtemplates'); ?></a></div>
            <div class="clear"></div>
        </div>

        <div class="author_info">
            <div class="author_image">

                <?php echo get_avatar($curauth->ID); ?>

            </div>
            <div class="author_desc">
                <p><?php echo $curauth->description; ?></p>
                <div class="share_post">
                    <?php jwRender::get_author_social_icons($curauth->ID); ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>

    </div><!-- End Content row -->	
    <?php $content_width = jwLayout::content_width(); ?> 
    <div class="builder-section  <?php echo implode(' ', $content_width) . ' ' . jwLayout::content_layout(); ?>">
        <?php
        $wp_query->type = jwOpt::get_option('boxes_type', 'default');
        $wp_query->letter_excerpt = jwOpt::get_option('letter_excerpt_blog', 300);
        $wp_query->letter_excerpt_title = jwOpt::get_option('letter_title_blog', -1);
        $wp_query->element_blog_dateformat = jwOpt::get_option('element_blog_dateformat', 'M j, Y');
        $wp_query->pagination = jwOpt::get_option('blog_pagination', 'number');

        $wp_query->blog_metadate = jwOpt::get_option('blog_metadate', '1');
        $wp_query->blog_ratings = jwOpt::get_option('blog_ratings', '1');

        $wp_query->blog_meta_type_icon = jwOpt::get_option('blog_meta_type_icon', '1');
        $wp_query->blog_meta_author = jwOpt::get_option('blog_meta_author', '1');
        $wp_query->blog_comments_count = jwOpt::get_option('blog_comments_count', '1');
        $wp_query->blog_meta_category = jwOpt::get_option('blog_meta_category', '1');
        $wp_query->box_size = jwLayout::parseColWidth();

        jaw_template_set_data($wp_query);
        echo jaw_get_template_part('blog');
        ?>
    </div> 
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>