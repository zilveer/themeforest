<li class="mkdf-pswt-slide-thumb mkdf-pt-three-item mkdf-post-item">
    <div class="mkdf-pt-three-item-inner">
        <div class="mkdf-pt-three-item-inner2">
            <?php if (has_post_thumbnail()) { ?>
                <div class="mkdf-pt-three-image-holder">
                    <a itemprop="url" class="mkdf-pt-three-link mkdf-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                        <?php
                            echo hashmag_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, '145', '110');
                        ?>
                    </a>
                </div>
            <?php } ?>
            <div class="mkdf-pt-three-content-holder">
                <div class="mkdf-pt-three-content-inner">
                    <h6 class="mkdf-pt-three-title mkdf-pt-title">
                        <a itemprop="url" class="mkdf-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo hashmag_mikado_get_title_substring(get_the_title(), '50') ?></a>
                    </h6>
                    <div class="mkdf-pt-info-section stick-to-bottom">
                        <?php hashmag_mikado_post_info_date(array(
                            'date' => 'yes',
                            'date_format' => 'F d'
                        )) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>