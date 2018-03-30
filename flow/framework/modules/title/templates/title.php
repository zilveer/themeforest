<?php do_action('flow_elated_before_page_title'); ?>
<?php if($show_title_area) { ?>

    <div class="eltd-title <?php echo flow_elated_title_classes(); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <div class="eltd-title-image"><?php if($title_background_image_src != ""){ ?><img src="<?php echo esc_url($title_background_image_src); ?>" alt="<?php esc_html_e('Title','flow'); ?>" /> <?php } ?></div>
        <div class="eltd-title-holder" <?php flow_elated_inline_style($title_holder_height); ?>>
            <div class="eltd-container clearfix">
                <div class="eltd-container-inner">
                    <div class="eltd-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="eltd-title-subtitle-holder-inner">
                        <?php switch ($type){
                            case 'standard': ?>
                                <h1 <?php flow_elated_inline_style($title_color); ?>><span><?php flow_elated_title_text(); ?></span></h1>
                                <?php if($has_subtitle){ ?>
                                    <span class="eltd-subtitle" <?php flow_elated_inline_style($subtitle_color); ?>><span><?php flow_elated_subtitle_text(); ?></span></span>
                                <?php } ?>
                                <?php if($enable_breadcrumbs){ ?>
                                    <div class="eltd-breadcrumbs-holder"> <?php flow_elated_custom_breadcrumbs(); ?></div>
                                <?php } ?>
                            <?php break;
                            case 'breadcrumb': ?>
                                <div class="eltd-breadcrumbs-holder"> <?php flow_elated_custom_breadcrumbs(); ?></div>
                            <?php break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<?php do_action('flow_elated_after_page_title'); ?>