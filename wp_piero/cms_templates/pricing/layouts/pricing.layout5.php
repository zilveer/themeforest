<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h3 class="cs-pricing-title" style="background: <?php echo $title_background_pricing_color; ?>; color: <?php echo $title_pricing_color; ?>"><?php echo get_the_title(); ?></h3>
    <div class="cs-pricing-description">
        <dl class="loaded" <?php if($custom['is_feature'][0] == 1) { echo 'style="background:'.$content_background_pricing_color.';"'; } ?>>
            <dt style="display:none;"></dt> <?php /* add this element for fix w3c validator */?>
            <?php if($custom['price'][0] != '' || $custom['per_time'][0] != '') { ?>
            <dt class="jmPrice" <?php echo $style; ?>>
                <div class="cs-pricing-wrap">
                    <div class="cs-pricing-inner">
                        <?php if($custom['price'][0] != '') { ?>
                            <div class="number"><span>$</span><?php echo $custom['price'][0] ?></div>
                        <?php } ?>
                        <?php if($custom['value'][0] != '') { ?>
                            <small>/per <?php echo $custom['value'][0] ?></small>
                        <?php } ?>
                    </div>
                </div>
            </dt>
            <?php } ?>
            <?php if($custom['option_1'][0] != '') { ?>
            <dd class="odd"><?php echo $custom['option_1'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_2'][0] != '') { ?>
            <dd class="retail"><?php echo $custom['option_2'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_3'][0] != '') { ?>
            <dd class="odd"><?php echo $custom['option_3'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_4'][0] != '') { ?>
            <dd class="retail"><?php echo $custom['option_4'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_5'][0] != '') { ?>
            <dd class="cs-option-5"><?php echo $custom['option_5'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_6'][0] != '') { ?>
            <dd class="cs-option-6"><?php echo $custom['option_6'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_7'][0] != '') { ?>
            <dd class="cs-option-7"><?php echo $custom['option_7'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_8'][0] != '') { ?>
            <dd class="cs-option-8"><?php echo $custom['option_8'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_9'][0] != '') { ?>
            <dd class="cs-option-9"><?php echo $custom['option_9'][0] ?></dd>
            <?php } ?>
            <?php if($custom['option_10'][0] != '') { ?>
            <dd class="cs-option-10"><?php echo $custom['option_10'][0] ?></dd>
            <?php } ?>
        </dl>
    </div>
    <div class="cs-pricing-button" <?php if($custom['is_feature'][0] == 1) { echo 'style="background:'.$content_background_pricing_color.';"'; } ?>>
        <a <?php if($custom['is_feature'][0] == 1) { echo 'style="background:'.$button_background_pricing_color.';color:'.$button_font_pricing_color.';"'; } ?> title="<?php get_the_title() ?>" href="<?php echo esc_url($custom['button_link'][0]); ?>" rel="" class="btn <?php echo $button_type;?>"><?php echo $custom['button_text'][0]; ?></a>
    </div>
</article>