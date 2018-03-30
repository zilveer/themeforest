<div class="mkdf-pb-three-item mkdf-post-item">
    <div class="mkdf-post-item-inner">
        <?php if (has_post_thumbnail()) { ?>
        <div class="mkdf-pb-three-image-holder mkdf-bnl-image-holder">
            <div class="mkdf-pb-three-image-inner-holder mkdf-bnl-image-holder-inner">
                <a itemprop="url" class="mkdf-pb-three-slide-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                    <?php
                    if ($thumb_image_size != 'custom_size') {
                        echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                    } elseif ($thumb_image_width != '' && $thumb_image_height != '') {
                        echo hashmag_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $thumb_image_width, $thumb_image_height);
                    } ?>
                </a>
            </div><!-- .mkdf-pb-three-image-inner-holder-->
            <div class="mkdf-pb-three-content-holder">
                <div class="mkdf-pb-three-content-holder-inner">
                    <div class="mkdf-pb-three-content-holder-inner2">
                        <?php
                        hashmag_mikado_post_info_category(array(
                            'category' => $display_category
                        )); ?>
                        <div class="mkdf-pb-three-title-holder">
                            <<?php echo esc_html($title_tag) ?> class="mkdf-pb-three-title">
                            <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()); ?>"
                                target="_self"><?php echo hashmag_mikado_get_title_substring(get_the_title(), $title_length) ?></a>
                        </<?php echo esc_html($title_tag) ?>>
                    </div>
                    <?php if ($display_excerpt == 'yes') { ?>
                        <div class="mkdf-pb-three-excerpt">
                            <?php hashmag_mikado_excerpt($excerpt_length); ?>
                        </div>
                    <?php } ?>
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
            </div><!-- .mkdf-pb-three-content-holder-inner -->
        </div><!-- .mkdf-pb-three-content-holder -->
        <?php hashmag_mikado_post_info_share(array(
            'share' => $display_share
        )) ?>
    </div>
    <?php } ?>
</div>
</div>