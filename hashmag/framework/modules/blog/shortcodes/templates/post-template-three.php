<div class="mkdf-pt-three-item mkdf-post-item">
    <div class="mkdf-pt-three-item-inner">
        <div class="mkdf-pt-three-item-inner2">
            <?php if (has_post_thumbnail()) { ?>
                <div class="mkdf-pt-three-image-holder">
                    <a itemprop="url" class="mkdf-pt-three-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                        <?php
                        if ($thumb_image_size != 'custom_size') {
                            echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                        } elseif ($thumb_image_width != '' && $thumb_image_height != '') {
                            echo hashmag_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $thumb_image_width, $thumb_image_height);
                        }
                        ?>
                    </a>
                </div>
            <?php } ?>
            <div class="mkdf-pt-three-content-holder">
                <div class="mkdf-pt-three-content-inner">
                    <?php
                    hashmag_mikado_post_info_category(array(
                        'category' => $display_category
                    )); ?>
                    <<?php echo esc_html($title_tag) ?> class="mkdf-pt-three-title mkdf-pt-title">
                    <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo hashmag_mikado_get_title_substring(get_the_title(), $title_length) ?></a>
                </<?php echo esc_html($title_tag) ?>>
                <?php if ($display_excerpt == 'yes') { ?>
                    <div class="mkdf-pt-three-excerpt">
                        <?php hashmag_mikado_excerpt($excerpt_length); ?>
                    </div>
                <?php } ?>
                <?php if ($display_date == 'yes' || $display_author == 'yes' || $display_comments == 'yes' || $display_count == 'yes' || $display_like == 'yes') { ?>
                    <div class="mkdf-pt-info-section stick-to-bottom">
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
</div>