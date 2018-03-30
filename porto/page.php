<?php get_header() ?>

<?php
global $porto_settings, $porto_layout;

$featured_images = porto_get_featured_images();
?>
    <div id="content" role="main">
        <?php /* The loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <article <?php post_class(); ?>>
                <?php if ( count($featured_images) && ! post_password_required() ) : ?>
                    <?php
                    // Slideshow
                    $featured_images = porto_get_featured_images();
                    $image_count = count($featured_images);

                    if ($image_count) : ?>
                        <div class="page-image<?php if ($image_count == 1) echo ' single'; ?>">
                            <div class="page-slideshow porto-carousel owl-carousel">
                                <?php
                                foreach ($featured_images as $featured_image) {
                                    $attachment = porto_get_attachment($featured_image['attachment_id']);
                                    if ($attachment) {
                                        ?>
                                        <div>
                                            <div class="img-thumbnail">
                                                <img class="owl-lazy img-responsive" width="<?php echo $attachment['width'] ?>" height="<?php echo $attachment['height'] ?>" data-src="<?php echo $attachment['src'] ?>" alt="<?php echo $attachment['alt'] ?>" />
                                                <?php if ($porto_settings['page-zoom']) : ?>
                                                    <span class="zoom" data-src="<?php echo $attachment['src']; ?>" data-title="<?php echo $attachment['caption']; ?>"><i class="fa fa-search"></i></span>
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
                    ?>
                <?php endif; ?>

                <?php
                $microdata = porto_get_meta_value('page_microdata');
                if ($porto_settings['rich-snippets'] && 'no' !== $microdata && ('yes' === $microdata || ('yes' !== $microdata && $porto_settings['page-microdata']))) {
                    porto_render_rich_snippets();
                }
                ?>

                <div class="page-content">
                    <?php
                    the_content();
                    wp_link_pages( array(
                        'before'      => '<div class="pagination" role="navigation">',
                        'after'       => '</div>'
                    ) );
                    ?>
                </div>
            </article>

            <div class="<?php if ($porto_layout === 'wide-left-sidebar' || $porto_layout === 'wide-right-sidebar') echo 'm-t-lg m-b-xl m-r-md m-l-md' ?>">
            <?php
            $share = porto_get_meta_value('page_share');
            if ($porto_settings['share-enable'] && 'no' !== $share && ('yes' === $share || ('yes' !== $share && $porto_settings['page-share']))) : ?>
                <div class="page-share<?php echo ($porto_layout == 'widewidth') ? ' container' : '' ?>">
                    <?php if ($porto_settings['post-title-style'] == 'without-icon') : ?>

                    <?php else : ?>
                        <h3><i class="fa fa-share"></i><?php _e('Share this post', 'porto') ?></h3>
                    <?php endif; ?>
                    <?php get_template_part('share') ?>
                </div>
            <?php endif; ?>

            <?php if ($porto_settings['page-comment']) : ?>
                <?php
                wp_reset_postdata();
                comments_template();
                ?>
            <?php endif; ?>
            </div>

        <?php endwhile; ?>

    </div>

<?php get_footer() ?>