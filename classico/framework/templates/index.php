<?php 
/**
 * The main template file.
 *
 */
    get_header();
?>
<?php 

    $l = et_page_config();

    $content_layout = etheme_get_option('blog_layout');

    $full_width = false;

    if($content_layout == 'mosaic') {
        $full_width = etheme_get_option('blog_full_width');
    }

    if($content_layout == 'mosaic') {
        $content_layout = 'grid';
    }
?>

<?php do_action( 'et_page_heading' ); ?>

<div class="<?php echo (!$full_width) ? 'container' : 'blog-full-width'; ?>">
    <div class="sidebar-position-<?php esc_attr_e( $l['sidebar'] ); ?>">
        <div class="row">
            <div class="content <?php esc_attr_e( $l['content-class'] ); ?>">
        
                <div class="<?php if ($content_layout == 'grid'): ?>blog-masonry row<?php endif ?>">
                    <?php if(have_posts()): 
                        while(have_posts()) : the_post(); ?>

                            <?php get_template_part('content', $content_layout); ?>

                        <?php endwhile; ?>
                    <?php else: ?>

                        <h1><?php _e('No posts were found!', ET_DOMAIN) ?></h1>

                    <?php endif; ?>
                </div>

                <div class="articles-nav">
                    <div class="left"><?php next_posts_link(__('&larr; Older Posts', ET_DOMAIN)); ?></div>
                    <div class="right"><?php previous_posts_link(__('Newer Posts &rarr;', ET_DOMAIN)); ?></div>
                    <div class="clear"></div>
                </div>

            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
    get_footer();
?>