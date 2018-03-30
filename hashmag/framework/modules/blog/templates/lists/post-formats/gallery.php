<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-item">
        <div class="mkdf-post-item-inner">
            <?php if (!has_post_thumbnail()) {
                hashmag_mikado_post_info_category(array(
                    'category' => $display_category
                ));
            } ?>
            <?php if (has_post_thumbnail()) { ?>
                <div class="mkdf-post-image-holder">
                    <?php
                    hashmag_mikado_post_info_category(array(
                        'category' => $display_category
                    )); ?>
                    <?php hashmag_mikado_get_module_template_part('templates/lists/parts/gallery', 'blog'); ?>
                </div>
            <?php } ?>
            <div class="mkdf-post-content-holder">
                <div class="mkdf-post-title-holder">
                    <h2 class="mkdf-post-title">
                        <a itemprop="url" class="mkdf-post-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo hashmag_mikado_get_title_substring(get_the_title(), '') ?></a>
                    </h2>
                </div>
                <div class="mkdf-post-excerpt-holder">
                    <?php hashmag_mikado_excerpt($excerpt_length); ?>
                </div>

                <?php
                $args_pages = array(
                    'before'           => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
                    'after'            => '</div></div>',
                    'link_before'      => '<span>',
                    'link_after'       => '</span>',
                    'pagelink'         => '%'
                );

                wp_link_pages($args_pages);
                ?>

                <?php if ($display_read_more) { ?>
                    <div class="mkdf-post-read-more-holder">
                        <?php hashmag_mikado_read_more_button(); ?>
                    </div>
                <?php } ?>
            </div>
            <?php if ($display_date == 'yes' || $display_author == 'yes' || $display_comments == 'yes' || $display_like == 'yes' || $display_share == 'yes') { ?>
                <div class="mkdf-post-info-section">
                    <?php hashmag_mikado_post_info_author(array(
                        'author' => $display_author
                    )) ?>
                    <?php hashmag_mikado_post_info_date(array(
                        'date' => $display_date,
                        'date_format' => get_option('date_format')
                    )) ?>
                    <?php hashmag_mikado_post_info_comments(array(
                        'comments' => $display_comments
                    )) ?>
                    <?php hashmag_mikado_post_info_like(array(
                        'like' => $display_like
                    )); ?>
                    <?php hashmag_mikado_post_info_share(array(
                        'share' => $display_share
                    ));
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php do_action('hashmag_mikado_before_blog_list_article_closed_tag'); ?>
</article>