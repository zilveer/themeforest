<?php

global $porto_settings;

$post_layout = 'grid';

$columns = $porto_settings['grid-columns'];

global $porto_blog_columns, $porto_post_style;
if ($porto_blog_columns)
    $columns = $porto_blog_columns;

$post_style = $porto_post_style ? $porto_post_style : $porto_settings['post-style'];
$post_class = array();
$post_class[] = 'post post-' . $post_layout;
switch ($columns) {
    case '1': $post_class[] = ' col-sm-12'; break;
    case '2': $post_class[] = ' col-sm-6'; break;
    case '3': $post_class[] = ' col-sm-6 col-md-4'; break;
    case '4': $post_class[] = ' col-sm-6 col-md-4 col-lg-3'; break;
    default: $post_class[] = ' col-sm-6 col-md-4'; break;
}
if ($porto_settings['post-title-style'] == 'without-icon')
    $post_class[] = 'post-title-simple';
?>

<article <?php post_class($post_class); ?>>

    <?php
    if ($post_style == 'related') :
        get_template_part('content', 'post-item');
    else :
    ?>
        <div class="grid-box">
            <?php
            // Post Slideshow
            $slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);

            if (!$slideshow_type)
                $slideshow_type = 'images';

            if ($slideshow_type != 'none') : ?>
                <?php if ($slideshow_type == 'images') :
                    $featured_images = porto_get_featured_images();
                    $image_count = count($featured_images);

                    if ($image_count) :
                    ?>
                    <div class="post-image<?php if ($image_count == 1) echo ' single'; ?>">
                        <div class="post-slideshow porto-carousel owl-carousel">
                            <?php
                            foreach ($featured_images as $featured_image) {
                                $attachment = porto_get_attachment($featured_image['attachment_id']);
                                if ($attachment) {
                                    ?>
                                    <div>
                                        <div class="img-thumbnail">
                                            <img class="owl-lazy img-responsive" width="<?php echo $attachment['width'] ?>" height="<?php echo $attachment['height'] ?>" data-src="<?php echo $attachment['src'] ?>" alt="<?php echo $attachment['alt'] ?>" />
                                            <?php if ($porto_settings['post-zoom']) : ?>
                                                <span class="zoom" data-src="<?php echo $attachment['src'] ?>" data-title="<?php echo $attachment['caption']; ?>"><i class="fa fa-search"></i></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    endif;
                endif;
                ?>

                <?php
                if ($slideshow_type == 'video') {
                    $video_code = get_post_meta($post->ID, 'video_code', true);
                    if ($video_code) {
                        ?>
                        <div class="post-image single">
                            <div class="img-thumbnail fit-video">
                                <?php echo do_shortcode($video_code) ?>
                            </div>
                        </div>
                    <?php
                    }
                }
            endif;
            ?>

            <div class="post-content">

                <h4 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>

                <?php
                porto_render_rich_snippets( false );
                if ($porto_settings['blog-excerpt']) {
                    echo porto_get_excerpt( $porto_settings['blog-excerpt-length'], false );
                } else {
                    echo '<div class="entry-content">';
                    the_content();
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'porto' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'porto' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                    echo '</div>';
                }
                ?>

            </div>

            <?php if (in_array('date', $porto_settings['post-metas'])) : ?>
            <div class="post-meta">
                <span><i class="fa fa-calendar"></i> <?php echo get_the_date() ?></span>
            </div>
            <?php endif; ?>
            <div class="post-meta">
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
            <div class="clearfix">
                <a class="btn btn-xs btn-primary pt-right" href="<?php echo esc_url( apply_filters( 'the_permalink', get_permalink() ) ) ?>"><?php _e('Read more...', 'porto') ?></a>
            </div>
        </div>
    <?php endif; ?>

</article>