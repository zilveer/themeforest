
<article class="test-layout2 cshero_testimonial_content clearfix" style="<?php echo $content_style;?>">
    <?php if($show_image) { ?> 
    <div class="cshero-testimonial-image <?php echo $image_align;?>">
        <?php
        if (has_post_thumbnail() and wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)){
            $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
            if($crop_image){
                $image_resize = mr_image_resize( $attachment_image[0], $width_image, $height_image, true, 'c', false );
                echo '<img alt="" src="'. esc_url($image_resize) .'" class="'.$image_align.'" '.$image_style.' />';
            }else{
               echo '<img alt="" src="'. esc_attr($attachment_image[0]) .'" class="'.$image_align.'"  '.$image_style.' />';
            }
        } else { 
            $no_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
            if($crop_image){
                $image_resize = mr_image_resize( $no_image, $width_image, $height_image, true, false );
                echo '<img alt="" src="'. esc_url($image_resize) .'" class="'.$image_align.'"  '.$image_style.'  />';
            }else{
               echo '<img alt="" src="'. esc_attr($no_image) .'" class="'.$image_align.'"  '.$image_style.'  />';
            }

        } ?>
    </div>
    <?php } ?> 
    
    <?php if ($show_title || $show_category || $show_description || $show_readmore) { ?>
        <div class="cshero-testimonial-content <?php echo $content_align;?>" style="<?php echo $content_padding;?>">
            <?php if ($show_title) { ?>
                <<?php echo $item_title_heading; ?> class="cshero-testimonial-title" <?php echo 'style="color:'.$item_title_heading_color.'"'; ?>>
                    <?php the_title() ?>
                </<?php echo $item_title_heading; ?>>
            <?php } ?>
            <?php if ($show_category) { ?>
                <div class="cshero-testimonial-category"><?php echo strip_tags (get_the_term_list($post->ID, 'testimonial_category', '', ', ', '')); ?></div>
            <?php } ?>

            <?php if ($show_description) { ?>
                <div class="cshero-testimonial-description">
                    <div class="cshero-testimonial-text" <?php echo $desc_style; ?>>
                        <?php if($quotation_type == 'icon' && $quotation_left_icon!='-1') { ?>                     
                            <i class="fa <?php echo $quotation_left_icon;?> cshero-testimonial-icon" style="font-size:<?php echo $quotation_icon_size;?>;color:<?php echo $quotation_color;?>"></i>
                        <?php } if($quotation_type == 'text' && $quotation_left_text!='-1') {?>
                            <i class="cshero-testimonial-icon" style="font-size:<?php echo $quotation_icon_size;?>;color:<?php echo $quotation_color;?>"><?php echo $quotation_left_text;?></i>
                        <?php } ?><?php echo substr(get_the_content($read_more), 0, $excerpt_length); ?><?php if($quotation_type == 'icon' && $quotation_right_icon!='-1') { ?>
                            <i class="fa <?php echo $quotation_right_icon;?> cshero-testimonial-icon" style="font-size:<?php echo $quotation_icon_size;?>;color:<?php echo $quotation_color;?>"></i>
                         <?php } if($quotation_type == 'text' && $quotation_right_text!='-1') {?>
                            <i class="cshero-testimonial-icon" style="font-size:<?php echo $quotation_icon_size;?>;color:<?php echo $quotation_color;?>"><?php echo $quotation_right_text;?></i>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            

            <?php if($show_readmore) { ?>
            <div class="cshero-readmore <?php echo $content_align;?>">
                <a class="btn btn-default" href="<?php the_permalink(); ?>">
                    <?php echo __($read_more, THEMENAME) ; ?>
                </a>
            </div>
            <?php } ?>

        </div>
    <?php } ?>
    <h6 style="display:none;"><?php echo '&nbsp;';/* this tag for fix validator */ ?></h6>
</article>

