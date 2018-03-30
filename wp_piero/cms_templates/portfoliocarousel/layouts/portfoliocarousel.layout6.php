<?php  $d = $counter;?>
<article id="post-<?php echo $d;?>" <?php post_class(); ?> style="background-color:<?php echo $item_bg_color;?>;">
    <style type="text/css" scoped>
    .portfoliocarousel-layout2 .cshero-portfolio-carousel-item .cshero-title-wrap:after{ background-color:<?php echo $item_title_color;?>;}
    </style>
    <?php if (has_post_thumbnail() and wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) { ?>
        <div class="cshero-portfolio-carousel-item-image no-padding-all nopaddingall <?php if($counter%2 != '1') echo 'right';?>">
            <?php if($crop_image == 1){
                $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                $image_resize = mr_image_resize( $attachment_image[0], $width_image, $height_image, true, 'c', false );
                echo '<img alt="" class="" src="'. esc_url($image_resize)  .'" '.$image_style.' />';
            }else{
               //echo get_the_post_thumbnail($post->ID);
                $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                echo '<img alt="" class="" src="'. esc_url($attachment_image[0])  .'" '.$image_style.' />';
            } ?>
        </div>
    <?php } else { ?>
        <?php
            $no_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
            if($crop_image == 1){
                $image_resize = mr_image_resize( $no_image, $width_image, $height_image, true, false );
            }
        ?>
        <div class="cshero-portfolio-carousel-item-image no-image no-padding-all nopaddingall">
            <?php if($crop_image == 1){ ?>
                <img alt="<?php the_title(); ?>" src="<?php echo $image_resize; ;?>" <?php echo $image_style; ?> />
            <?php } else { ?>
                <img alt="<?php the_title(); ?>" src="<?php echo $no_image; ;?>" <?php echo $image_style; ?> />
            <?php } ?>
        </div>
    <?php } ?>
    
    <div class="overlay <?php echo $overlay_appear; ?>" <?php echo $overlay_style; ?>>
        <div class="back_to_top on move-prev" data-id="#post-<?php echo $d-1;?>"><i class="pe-7s-angle-up"></i></div>
        <div class="overlay-content">
            <div class="cshero-portfolio-carousel-item-content" style="padding:<?php echo $content_padding;?>; color:<?php echo $item_content_color;?>;">
                <div class="cshero-portfolio-carousel-item-content-inner">
                    <div class="cshero-title-wrap">
                    <?php if ($show_title) { ?>
                        <<?php echo $item_heading_size; ?> class="cshero-title">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" <?php echo $item_title_style;?>>
                                <?php the_title(); ?>
                            </a>
                        </<?php echo $item_heading_size; ?>>
                    <?php } ?>
                    <?php if ($show_category) : ?>
                        <?php echo __('in ', THEMENAME); ?>
                        <span class="cshero-carousel-post-category">
                            <?php echo strip_tags (get_the_term_list($post->ID, 'portfolio_category', '', ', ', '')); ?>
                        </span>
                    <?php endif; ?>
                    </div>
                    <?php if ($show_description) { ?>
                        <div class="cshero-carousel-post-description">
                            <?php if ($excerpt_length != -1) { ?>
                                <p><?php echo cshero_content_max_charlength(strip_tags(get_the_content()), $excerpt_length); ?></p>
                            <?php } else { ?>
                                <p><?php the_content(); ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if($show_read_more || $show_popup || $portfolio_link!='') :?>
                        <div class="cshero-portfolio-link-wrap">
                            <div class="cshero-portfolio-link-inner">
                                <?php if($portfolio_link!='' && $show_link){ ?>
                                    <a class="btn btn-default-alt" href="<?php echo  esc_url($portfolio_link); ?>" title="<?php the_title(); ?>" target="_blank">
                                        <?php echo $show_link_text; ?>
                                    </a>
                                <?php } ?>
                                <?php if($show_read_more) :?>
                                    <a class="btn btn-default-alt" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" >
                                        <?php echo $read_more; ?>
                                    </a>
                                <?php endif;?>
                                <?php if($show_popup) :?>
                                    <a class="colorbox btn btn-default-alt" title="<?php the_title(); ?>" href="<?php echo esc_url($attachment_full_image); ?>" >
                                        <?php echo $popup_text; ?>
                                    </a>
                                <?php endif;?>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="back_to_top on move-next" data-id="#post-<?php echo $d+1;?>"><i class="pe-7s-angle-down"></i></div>
    </div>
    <h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
</article>