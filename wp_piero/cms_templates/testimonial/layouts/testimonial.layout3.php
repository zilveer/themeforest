<?php
    if($quotation_left_icon) $margin_left = $quotation_icon_size+10; $content_style .= 'margin-left:'.$margin_left.'px;';
    if($quotation_right_icon) $margin_right = $quotation_icon_size+10;   $content_style .= 'margin-right:'.$margin_right.'px;';
?>

<article id="post-<?php the_ID() ?>"  class="cshero_testimonial_content clearfix" style="<?php echo $content_style;?>">
    <?php if($show_image) { ?> 
    <div class="cshero-testimonial-image <?php echo $image_align;?>">
        <?php
        if (has_post_thumbnail() and wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)){
            $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
            if($crop_image){
                $image_resize = mr_image_resize( $attachment_image[0], $width_image, $height_image, true, 'c', false );
                echo '<img alt="" src="'. esc_url($image_resize) .'" '.$image_style.' />';
            }else{
               echo '<img alt="" src="'. esc_attr($attachment_image[0]) .'" '.$image_style.' />';
            }
        } else { 
            $no_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
            if($crop_image){
                $image_resize = mr_image_resize( $no_image, $width_image, $height_image, true, false );
                echo '<img alt="" src="'. esc_url($image_resize) .'" '.$image_style.'  />';
            }else{
               echo '<img alt="" src="'. esc_attr($no_image) .'" '.$image_style.'  />';
            }

        } ?>

        <?php if ($show_title || $show_category ): ?>
            <div class="author-infoo-wrap">
                <?php if ($show_title) { ?>
                    <<?php echo $item_title_heading; ?> class="cshero-testimonial-title">
                        <?php the_title() ?>
                    </<?php echo $item_title_heading; ?>>
                <?php } ?>
                <?php if ($show_category) { ?>
                    <div class="cshero-testimonial-category"><?php echo strip_tags (get_the_term_list($post->ID, 'testimonial_category', '', ', ', '')); ?></div>
                <?php } ?>
            </div>
        <?php endif ?>
    </div>
    <?php } ?> 
    
    <?php if ( $show_description || $show_readmore) { ?>
        
        <div class="cshero-testimonial-content <?php echo $content_align;?>" style="<?php echo $content_padding;?>">
            <?php if ($show_description) { ?>
                <div class="cshero-testimonial-description">
                    <div class="cshero-testimonial-text" <?php echo $desc_style; ?>>
                        <?php if ($quotation_left_icon!='-1') :?>
                            <i class="fa <?php echo $quotation_left_icon;?> cshero-testimonial-icon" style="font-size:<?php echo $quotation_icon_size;?>;color:<?php echo $quotation_color;?>"></i>
                        <?php endif;?>
                        <?php echo substr(get_the_content($read_more), 0, $excerpt_length); ?>
                        <?php if ($quotation_right_icon!='-1') :?>
                            <i class="fa <?php echo $quotation_right_icon;?> cshero-testimonial-icon" style="font-size:<?php echo $quotation_icon_size;?>;color:<?php echo $quotation_color;?>"></i>
                        <?php endif;?>
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


