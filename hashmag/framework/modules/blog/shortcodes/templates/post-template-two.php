<div class="mkdf-pt-two-item mkdf-post-item">
    <div class="mkdf-pt-two-item-inner">
        <?php if (has_post_thumbnail()) { ?>
            <div class="mkdf-pt-two-image-holder">
                <a itemprop="url" class="mkdf-pt-two-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self" <?php hashmag_mikado_inline_style($image_style); ?>>
                    <?php
                    echo hashmag_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $custom_thumb_image_width, $custom_thumb_image_height);
                    ?>
                </a>
            </div>
        <?php } ?>
        <div class="mkdf-pt-two-content-holder">
            <div class="mkdf-pt-two-content-holder-inner">
                <div class="mkdf-pt-two-content-top-holder">
                    <?php
                    hashmag_mikado_post_info_category(array(
                        'category' => $display_category
                    )); ?>
                    <<?php echo esc_html($title_tag) ?> class="mkdf-pt-two-title mkdf-pt-title">
                    <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self">
                        <?php echo hashmag_mikado_get_title_substring(get_the_title(), $title_length) ?>
                    </a>
                </<?php echo esc_html($title_tag) ?>>
                <?php if ($display_excerpt == 'yes') { ?>
                    <div class="mkdf-pt-two-excerpt">
                        <?php hashmag_mikado_excerpt($excerpt_length); ?>
                    </div>
                <?php } ?>
            </div>
            <?php if ($display_date == 'yes' || $display_author == 'yes' || $display_comments == 'yes' || $display_count == 'yes' || $display_like == 'yes') { ?>
                <div class="mkdf-pt-info-section">
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