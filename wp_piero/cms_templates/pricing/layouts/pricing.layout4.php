 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="cs-transform-wrap">
        <div class="cs-image-wrap">
            <?php if ( $custom['price'][0] != ''  ): ?>
                <div class="price-wrap">
                    <span class="price">$<?php echo $custom['price'][0] ?></span>
                </div>    
            <?php endif; ?>
            
            <?php if ( $show_image ) : ?>
                <div class="image-wrap">
                    <img src=" <?php echo esc_url($attachment_image[0]); ?> " alt="<?php echo get_the_title(); ?>">
                </div>
            <?php endif; ?>  
        </div>
        
        <div class="cs-pricing-description">
            <h3 class="cs-pricing-title" style="background: <?php echo ($custom['is_feature'][0] == 1) ? $content_background_pricing_color : $title_background_pricing_color; ?>; color: <?php echo $title_pricing_color; ?>"><?php echo get_the_title(); ?></h3>
            <dl class="loaded">
                <dt style="display:none;"></dt> <?php /* add this element for fix w3c validator */?>
                <?php if($custom['price'][0] != '' || $custom['per_time'][0] != '') { ?>
                
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
    </div>
    <div class="cs-pricing-button">
        <a <?php if($custom['is_feature'][0] == 1) { echo 'style="background:'.$button_background_pricing_color.';color:'.$button_font_pricing_color.';"'; } ?> title="<?php get_the_title() ?>" href="<?php echo esc_url($custom['button_link'][0]); ?>" rel="" class="btn <?php echo $button_type;?>"><?php echo $custom['button_text'][0]; ?></a>
    </div>
</article>
                