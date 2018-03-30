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
                    <div class="mkdf-post-image-inner-holder">
                        <a itemprop="url" class="mkdf-post-slide-link mkdf-post-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                        </a>
                    </div>
                </div>
            <?php } ?>
            <div class="mkdf-post-content-holder">
                <div class="mkdf-post-title-holder">
                    <h2 class="mkdf-post-title">
                        <a itemprop="url" class="mkdf-post-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo hashmag_mikado_get_title_substring(get_the_title(), '') ?></a>
                    </h2>
                </div>
                <?php the_content(); ?>
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