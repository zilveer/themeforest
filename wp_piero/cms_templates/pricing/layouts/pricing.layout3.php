
<?php if ( !$show_image ) : ?>
    <style type="text/css" scoped>
        #cs_pricing_<?php echo esc_attr($date); ?> .cs-pricing-item .jmprice:before {
            color: <?php echo $title_background_pricing_color; ?>;
            content: '\f0d7';
            font-family: FontAwesome;
            font-size: 30px;
            bottom: -16px;
            position: absolute;
            left: 50%;
            -webkit-transform: translate(-50%);
            -ms-transform: translate(-50%);
            -o-transform: translate(-50%);
            transform: translate(-50%);
        }
        #cs_pricing_<?php echo esc_attr($date); ?> .cs-pricing-item.cs-pricing-feature .jmprice:before {
            color: <?php echo $content_background_pricing_color; ?>; 
        }
        #cs_pricing_<?php echo esc_attr($date); ?> .hasBestValue:before{color:<?php echo $badge_color;?>;}

    </style>
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="cs-image-wrap <?php echo ( $show_image ) ? 'show-image' : 'no-show-image'; ?> " <?php echo $style; ?>>
        
        <?php if ( $show_image ) echo '<div class="overlay"></div>'; ?>
        <h3 class="cs-pricing-title" <?php echo $item_title_style;?>><?php echo get_the_title(); ?></h3>
        <div class="loaded">
            <div class="jmPrice jmprice">
                <?php if($custom['price'][0] != '') { ?>
                <div class="number" style="color: <?php echo $title_pricing_color; ?>">
                    <span class="currency">$</span>
                    <?php
                        $custom_price = explode('.', $custom['price'][0] );
                        echo '<span class="pri_pricing">'.$custom_price[0].'</span>';
                    ?>
                    <div class="second-pri-wrap" style="color: <?php echo $title_pricing_color; ?>">
                        <?php echo '<span class="secord_pricing">.'.$custom_price[1].'</span>';  ?>
                        <?php if($custom['value'][0] != '') { ?>
                            <span class="pri-value">/ <?php echo $custom['value'][0] ?></span>
                        <?php } ?>
                    </div>
                    
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if($show_video && ($video_file_webm || $video_file_ogg || $video_file_mp4)){  ?>
        <div class="pricing-video">
            <video class="pricing-content" width="auto" height="auto" <?php echo ''.$poster; ?>>
                <?php if($video_file_webm): ?>
                <source src="<?php echo ''.$video_file_webm; ?>" type="video/webm">
                <?php endif; ?>
                <?php if($video_file_ogg): ?>
                <source src="<?php echo ''.$video_file_ogg; ?>" type="video/ogg">
                <?php endif; ?>
                <?php if($video_file_mp4): ?>
                <source src="<?php echo ''.$video_file_mp4; ?>" type="video/mp4">
                <?php endif; ?>
            </video>
            <span class="pricing-video-play" onclick=""></span>
        </div>
    <?php } ?>
    
    <div class="cs-pricing-content-wrapper">
        <?php the_content(); ?>
    </div>
    
    <div class="cs-pricing-description">
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
    <div class="cs-pricing-button">
        <a <?php if($custom['is_feature'][0] == 1) { echo 'style="background:'.$button_background_pricing_color.';color:'.$button_font_pricing_color.';"'; } ?> title="<?php get_the_title() ?>" href="<?php echo esc_url($custom['button_link'][0]); ?>" rel="" class="btn <?php echo $button_type;?>"><?php echo $custom['button_text'][0]; ?></a>
    </div>
</article>
            