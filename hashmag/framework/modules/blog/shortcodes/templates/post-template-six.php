<div class="mkdf-pt-six-item mkdf-post-item">
    <div class="mkdf-pt-six-item-inner">
        <?php if (has_post_thumbnail()) { ?>
            <div class="mkdf-pt-six-image-holder mkdf-bnl-image-holder">
                <?php
                hashmag_mikado_post_info_category(array(
                    'category' => $display_category
                )); ?>
                <a itemprop="url" class="mkdf-pt-six-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self" <?php hashmag_mikado_inline_style($image_style); ?>>
                    <?php
                    echo hashmag_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $custom_thumb_image_width, $custom_thumb_image_height);
                    ?>
                </a>
                <?php
                if ($display_share == 'yes') {
                    hashmag_mikado_post_info_share(array(
                        'share' => $display_share
                    ));
                }
                if($display_featured_icon == 'yes' && get_post_meta(get_the_ID(), "mkdf_show_featured_post", true) == "yes") {
                    ?>
                    <span class="mkdf-bnl-featured-icon"><span class="ion-flash"></span></span>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="mkdf-pt-six-content-holder">
            <div class="mkdf-pt-six-content-holder-inner">
                <div class="mkdf-pt-six-content-top-holder">
                    <<?php echo esc_html($title_tag) ?> class="mkdf-pt-six-title mkdf-pt-title">
                    <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self">
                        <?php echo hashmag_mikado_get_title_substring(get_the_title(), $title_length) ?>
                    </a>
                    </<?php echo esc_html($title_tag) ?>>
                    <?php if ($display_excerpt == 'yes') { ?>
                        <div class="mkdf-pt-six-excerpt <?php if (has_post_thumbnail()) { ?> mkdf-post-excerpt-with-margin <?php } ?>">
                            <?php hashmag_mikado_excerpt($excerpt_length); ?>
                        </div>
                    <?php } ?>
                </div>
                <?php if ($display_date == 'yes' || $display_author == 'yes' || $display_comments == 'yes' || $display_count == 'yes' || $display_like == 'yes') { ?>
                    <div class="mkdf-pt-info-section <?php if (has_post_thumbnail()) { ?> stick-to-bottom  <?php } ?>">
                        <?php hashmag_mikado_post_info_author(array(
                            'author' => $display_author
                        )) ?>
                        <?php hashmag_mikado_post_info_date(array(
                            'date' => $display_date,
                            'date_format' => $date_format
                        )) ?>
                        <?php hashmag_mikado_post_info_comments(array(
                            'comments' => $display_comments
                        )) ?>
                        <?php hashmag_mikado_post_info_count(array(
                            'count' => $display_count
                        )); ?>
                        <?php hashmag_mikado_post_info_like(array(
                            'like' => $display_like
                        )); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>