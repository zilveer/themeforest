<?php
global $porto_settings;

$post_layout = 'medium';
$featured_images = porto_get_featured_images();

$post_class = array();
$post_class[] = 'post-' . $post_layout;

if ($porto_settings['post-title-style'] == 'without-icon')
    $post_class[] = 'post-title-simple';
?>

<article <?php post_class($post_class); ?>>

    <div class="row">
        <?php
        // Post Slideshow
        $slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);
        $video_code = get_post_meta($post->ID, 'video_code', true);

        if (!$slideshow_type)
            $slideshow_type = 'images';

        $featured_images = porto_get_featured_images();
        $image_count = count($featured_images);

        if (($slideshow_type == 'images' && $image_count) || ($slideshow_type == 'video' && $video_code)) : ?>
        <div class="col-md-5">
            <?php if ($slideshow_type == 'images' && $image_count) : ?>
                <div class="post-image<?php if ($image_count == 1) echo ' single'; ?>">
                    <div class="post-slideshow porto-carousel owl-carousel">
                        <?php
                        foreach ($featured_images as $featured_image) {
                            $attachment_medium = porto_get_attachment($featured_image['attachment_id'], 'blog-medium');
                            $attachment = porto_get_attachment($featured_image['attachment_id']);
                            if ($attachment) {
                                ?>
                                <div>
                                    <div class="img-thumbnail">
                                        <img class="owl-lazy img-responsive" width="<?php echo $attachment_medium['width'] ?>" height="<?php echo $attachment_medium['height'] ?>" data-src="<?php echo $attachment_medium['src'] ?>" alt="<?php echo $attachment_medium['alt'] ?>" />
                                        <?php if ($porto_settings['post-zoom']) : ?>
                                            <span class="zoom" data-src="<?php echo $attachment['src'] ?>" data-title="<?php echo $attachment_medium['caption']; ?>"><i class="fa fa-search"></i></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            if ($slideshow_type == 'video' && $video_code) {
                ?>
                <div class="post-image single">
                    <div class="img-thumbnail fit-video">
                        <?php echo do_shortcode($video_code) ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="col-md-7">
            <?php else : ?>
            <div class="col-md-12">
                <?php endif; ?>

                <div class="post-content">
                    <?php if ($porto_settings['post-title']) : ?>
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                    <?php endif; ?>
                    <?php porto_render_rich_snippets( false ); ?>
                    <div class="entry-content">
                        <?php
                        the_content();
                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'porto' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'porto' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                        ) );
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="post-gap-small"></div>

        <div class="post-meta">
            <?php if (in_array('date', $porto_settings['post-metas'])) : ?><span><i class="fa fa-calendar"></i> <?php echo get_the_date() ?></span><?php endif; ?>
            <?php if (in_array('author', $porto_settings['post-metas'])) : ?><span><i class="fa fa-user"></i> <?php echo __('By', 'porto'); ?> <?php the_author_posts_link(); ?></span><?php endif; ?>
            <?php
            $cats_list = get_the_category_list(', ');
            if ($cats_list && in_array('cats', $porto_settings['post-metas'])) : ?>
                <span><i class="fa fa-folder-open"></i> <?php echo $cats_list ?></span>
            <?php endif; ?>
            <?php
            $tags_list = get_the_tag_list('', ', ');
            if ($tags_list && in_array('tags', $porto_settings['post-metas'])) : ?>
                <span><i class="fa fa-tag"></i> <?php echo $tags_list ?></span>
            <?php endif; ?>
            <?php if (in_array('comments', $porto_settings['post-metas'])) : ?><span><i class="fa fa-comments"></i> <?php comments_popup_link(__('0 Comments', 'porto'), __('1 Comment', 'porto'), '% '.__('Comments', 'porto')); ?></span><?php endif; ?>
            <?php
            if (function_exists('Post_Views_Counter') && Post_Views_Counter()->options['display']['position'] == 'manual') {
                $post_count = do_shortcode('[post-views]');
                if ($post_count) {
                    echo $post_count;
                }
            }
            ?>
        </div>

        <?php
        $share = porto_get_meta_value('post_share');
        if ($porto_settings['share-enable'] && 'no' !== $share && ('yes' === $share || ('yes' !== $share && $porto_settings['post-share']))) : ?>
            <div class="post-block post-share">
                <?php if ($porto_settings['post-title-style'] == 'without-icon') : ?>

                <?php else : ?>
                    <h3><i class="fa fa-share"></i><?php _e('Share this post', 'porto') ?></h3>
                <?php endif; ?>
                <?php get_template_part('share') ?>
            </div>
        <?php endif; ?>

        <?php if ($porto_settings['post-author']) : ?>
            <div class="post-block post-author clearfix">
                <?php if ($porto_settings['post-title-style'] == 'without-icon') : ?>
                    <h4><?php _e('Author', 'porto') ?></h4>
                <?php else : ?>
                    <h3><i class="fa fa-user"></i><?php _e('Author', 'porto') ?></h3>
                <?php endif; ?>
                <div class="img-thumbnail">
                    <?php echo get_avatar(get_the_author_meta('email'), '80'); ?>
                </div>
                <p><strong class="name"><?php the_author_posts_link(); ?></strong></p>
                <p><?php the_author_meta("description"); ?></p>
            </div>
        <?php endif; ?>

        <?php if ($porto_settings['post-comments']) : ?>
            <div class="post-gap-small"></div>
            <?php
            wp_reset_postdata();
            comments_template();
            ?>
        <?php endif; ?>

</article>