<div class="mkdf-post-item-holder">
    <div class="mkdf-pt-five-item mkdf-post-item">
        <div class="mkdf-pt-five-item-inner">
            <?php if (has_post_thumbnail()) { ?>
                <div class="mkdf-pt-five-image-holder mkdf-bnl-image-holder">
                    <div class="mkdf-pt-five-image-inner-holder mkdf-bnl-image-holder-inner">
                        <a itemprop="url" class="mkdf-pt-five-slide-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                            <?php
                                echo hashmag_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $custom_thumb_image_width, $custom_thumb_image_height);
                            ?>
                        </a>
                    </div>
                </div>
            <?php } ?>
            <div class="mkdf-pt-five-content-holder">
                <div class="mkdf-pt-five-title-holder">
                    <<?php echo esc_html($title_tag) ?> class="mkdf-pt-five-title mkdf-pt-title">
                        <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo hashmag_mikado_get_title_substring(get_the_title(), $title_length) ?></a>
                    </<?php echo esc_html($title_tag) ?>>
                </div>
            </div>
        </div>
    </div>
</div>