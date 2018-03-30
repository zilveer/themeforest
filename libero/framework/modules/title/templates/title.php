<?php do_action('libero_mikado_before_page_title'); ?>
<?php if($show_title_area) { ?>

    <div class="mkd-title <?php echo libero_mikado_title_classes(); ?>" <?php libero_mikado_inline_style($title_style)?> data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <div class="mkd-title-image"><?php if($title_background_image_src != ""){ ?><img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;" /> <?php } ?></div>
        <div class="mkd-title-holder" <?php libero_mikado_inline_style($title_holder_height); ?>>
            <div class="mkd-container clearfix">
                <div class="mkd-container-inner">
                    <div class="mkd-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="mkd-title-subtitle-holder-inner">
                        <?php if ($enable_icon){ ?>
                            <div class="mkd-title-icon-holder">
                                <?php echo libero_mikado_execute_shortcode('mkd_icon',$icon_params);	?>
                            </div>
                        <?php } ?>
                        <?php switch ($type){
                            case 'standard': ?>
                                <h1 <?php libero_mikado_inline_style($title_text_style); ?>><span><?php libero_mikado_title_text(); ?></span></h1>
                                <?php if($has_subtitle){ ?>
                                    <span class="mkd-subtitle" <?php libero_mikado_inline_style($subtitle_color); ?>><span><?php libero_mikado_subtitle_text(); ?></span></span>
                                <?php } ?>
                                <?php if($enable_breadcrumbs){ ?>
                                    <div class="mkd-breadcrumbs-holder"> <?php libero_mikado_custom_breadcrumbs(); ?></div>
                                <?php } ?>
                            <?php break;
                            case 'breadcrumb': ?>
                                <div class="mkd-breadcrumbs-holder"> <?php libero_mikado_custom_breadcrumbs(); ?></div>
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
<?php do_action('libero_mikado_after_page_title'); ?>