<article id="post-<?php echo the_ID() ?>" <?php  post_class('row'); ?>>
    <h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning wpb_animate_when_almost_visible wpb_left-to-right wpb_animate_when_almost_visible wpb_right-to-left */ ?>
    <div class="cshero-portfolio-image-large col-xs-12 col-sm-12 col-md-8 col-lg-8  nopaddingall <?php if($counter%2 != '1') echo 'right';?>">
        <?php if(get_post_meta(get_the_ID(), 'cs_portfolio_intro', true)){
            $img2 = wp_get_attachment_image_src(get_post_meta(get_the_ID(), 'cs_portfolio_intro', true), 'full');
             echo '<img alt="" class="" src="'. esc_url($img2[0])  .'"  />';
        } else {
            $no_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
            echo '<img alt="'.get_the_title().'" src="'.$no_image.'"/>';
        } ?>
    </div>
    <div class="cshero-portfolio-image-small col-xs-12 col-sm-12 col-md-4 col-lg-4 nopaddingall">
        <?php if (has_post_thumbnail()  and wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) { ?>
            <div class="cshero-portfolio-carousel-item-image">
                <?php if($crop_image == 1){
                    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                    $image_resize = mr_image_resize( $attachment_image[0], $width_image, $height_image, true, 'c', false );
                    echo '<img alt="" class="" src="'. esc_url($image_resize)  .'" '.$image_style.' />';
                }else{
                   //echo get_the_post_thumbnail($post->ID);
                    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                    echo '<img alt="" class="" src="'. esc_url($attachment_image[0])  .'" '.$image_style.' />';
                } ?>
                <?php if($show_read_more || $show_popup || $show_link) :?>
                <div class="overlay cshero-portfolio-carousel-overlay <?php echo esc_attr($overlay_appear); ?>" <?php echo $overlay_style;?>>
                    <div class="overlay-content cshero-portfolio-carousel-overlay-content-inner">
                        <div class="cshero-portfolio-link-wrap">
                            <div class="cshero-portfolio-link-inner">
                                <?php if($show_popup) :?>
                                    <a class="colorbox btn btn-small btn-primary-alt" title="<?php the_title(); ?>" href="<?php echo esc_url($attachment_full_image); ?>" >
                                        <?php echo $popup_text;?>
                                    </a>
                                <?php endif;?>
                                <?php if($show_read_more) :?>
                                    <a class="btn btn-small btn-primary-alt" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" >
                                        <?php echo $read_more;?>
                                    </a>
                                <?php endif;?>
                                <?php if($portfolio_link !='' && $show_link){ ?>
                                    <a class="btn btn-small btn-primary-alt" href="<?php echo  esc_url($portfolio_link); ?>" title="<?php the_title(); ?>" target="_blank">
                                        <?php echo $show_link_text;?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
        <?php } else { ?>
            <?php
                $no_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
                if($crop_image == 1){
                    $image_resize = mr_image_resize( $no_image, $width_image, $height_image, true, false );
                }
            ?>
            <div class="cshero-portfolio-carousel-item-image no-image">
                <?php if($crop_image == 1){ ?>
                    <img alt="" src="<?php echo $image_resize; ;?>" <?php echo $image_style; ?> />
                <?php } else { ?>
                    <img alt="" src="<?php echo $no_image; ;?>" <?php echo $image_style; ?> />
                <?php } ?>
                <?php if($show_read_more || $show_popup || $show_link) :?>
                <div class="overlay cshero-portfolio-carousel-overlay <?php echo esc_attr($overlay_appear); ?>" <?php echo $overlay_style;?>>
                    <div class="overlay-content cshero-portfolio-carousel-overlay-content-inner">
                        <div class="cshero-portfolio-link-wrap">
                            <div class="cshero-portfolio-link-inner">
                                <?php if($show_popup) :?>
                                    <a class="colorbox btn btn-small btn-primary-alt" title="<?php the_title(); ?>" href="<?php echo esc_url($attachment_full_image); ?>" >
                                        <?php echo $popup_text;?>
                                    </a>
                                <?php endif;?>
                                <?php if($show_read_more) :?>
                                    <a class="btn btn-small btn-primary-alt" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" >
                                        <?php echo $read_more;?>
                                    </a>
                                <?php endif;?>
                                <?php if($portfolio_link !='' && $show_link){ ?>
                                    <a class="btn btn-small btn-primary-alt" href="<?php echo  esc_url($portfolio_link); ?>" title="<?php the_title(); ?>" target="_blank">
                                        <?php echo $show_link_text;?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>   
        <?php } ?>
        <div class="cshero-portfolio-carousel-item-content" <?php echo $item_style;?>>
            <div class="cshero-portfolio-carousel-item-content-inner">
                <?php if ($show_title) { ?>
                    <<?php echo $item_heading_size; ?> class="cshero-title">
                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" <?php echo $item_title_style;?>>
                            <?php the_title(); ?>
                        </a>
                    </<?php echo $item_heading_size; ?>>
                <?php } ?>
                <?php if ($show_category) : ?>
                    <div class="cshero-carousel-post-category">
                        <?php echo strip_tags (get_the_term_list($post->ID, 'portfolio_category', '', ', ', '')); ?>
                    </div>
                <?php endif; ?>
                <?php if ($show_description) { ?>
                    <div class="cshero-carousel-post-description">
                        <?php if ($excerpt_length != -1) { ?>
                            <p><?php echo cshero_content_max_charlength(strip_tags(get_the_content()), $excerpt_length); ?></p>
                        <?php } else { ?>
                            <p><?php the_content(); ?></p>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</article>
                    