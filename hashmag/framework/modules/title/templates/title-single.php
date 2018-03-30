<?php do_action('hashmag_mikado_before_page_title'); ?>
<?php if($show_title_area) { ?>
    <div class="mkdf-title <?php echo hashmag_mikado_title_classes(); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <div class="mkdf-title-holder" <?php hashmag_mikado_inline_style($title_holder_height); ?>>
            <div class="mkdf-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                <div class="mkdf-title-subtitle-holder-inner">
                    <h1 class="mkdf-title-text" <?php hashmag_mikado_inline_style($title_color);?>><?php hashmag_mikado_title_text(); ?></h1>
                    <?php if (get_post_format(hashmag_mikado_get_page_id()) == 'quote' && get_post_meta(hashmag_mikado_get_page_id(), "mkdf_post_quote_author_meta", true) != ''){ ?>
                        <span class="mkdf-title-single-quote-name">-
                            <?php echo get_post_meta(hashmag_mikado_get_page_id(), "mkdf_post_quote_author_meta", true); ?>
                        </span>
                    <?php } ?>
                    <?php if ($display_author == 'yes' || $display_date == 'yes' || $display_comments == 'yes' || $display_like == "yes" || $display_count == 'yes'){ ?>
                        <div class="mkdf-title-post-info">
                            <div class="mkdf-pt-info-section clearfix" <?php hashmag_mikado_inline_style($title_info_color.$title_border_color); ?>>
                                <?php if ($display_author == 'yes'){ ?>
                                    <div class="mkdf-title-post-author-info">
                                        <div class="mkdf-title-post-author">
                                            <?php hashmag_mikado_post_info_author(array(
                                                'author' => $display_author
                                            )) ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php hashmag_mikado_post_info(array(
                                    'date' => $display_date,
                                    'comments' => $display_comments,
                                    'like' => $display_like,
                                    'count' => $display_count
                                )) ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php do_action('hashmag_mikado_after_page_title'); ?>