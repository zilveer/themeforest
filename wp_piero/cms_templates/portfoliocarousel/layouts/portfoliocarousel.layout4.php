<article id="post-<?php echo the_ID() ?>" <?php  post_class(); ?>>
    <h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
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

            <div class="cshero-portfolio-carousel-meta-wrap">
                <div class="cshero-portfolio-carousel-meta-wrap-inner">
                    <?php if($show_popup) :?>
                        <a class="colorbox popup-image" style="color:<?php echo $item_content_color;?>" title="<?php the_title(); ?>" href="<?php echo esc_url($attachment_full_image); ?>" >
                            <i class="fa fa-search"></i>
                        </a>
                    <?php endif;?>
                </div>   
            </div>
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
                <img alt="<?php the_title(); ?>" src="<?php echo $image_resize; ;?>" <?php echo $image_style; ?> />
            <?php } else { ?>
                <img alt="<?php the_title(); ?>" src="<?php echo $no_image; ;?>" <?php echo $image_style; ?> />
            <?php } ?>
            
            <div class="cshero-portfolio-carousel-meta-wrap">
                <div class="cshero-portfolio-carousel-meta-wrap-inner">
                    <div class="cshero-portfolio-carousel-meta">
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
                    </div>   
                    <?php if($show_popup) :?>
                        <a class="colorbox popup-image" style="color:<?php echo $item_content_color;?>" title="<?php the_title(); ?>" href="<?php echo esc_url($attachment_full_image); ?>" >
                            <i class="fa fa-search"></i>
                        </a>
                    <?php endif;?>
                </div>   
            </div>
        </div>   
    <?php } ?>

    <div class="cshero-portfolio-carousel-item-content" <?php echo $item_style;?>>
        <div class="cshero-portfolio-carousel-meta">
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
        </div>  
        <div class="cshero-portfolio-carousel-item-content-inner">
            <?php if ($show_description) { ?>
                <div class="cshero-carousel-post-description">
                    <?php if ($excerpt_length != -1) { ?>
                        <p><?php echo cshero_content_max_charlength(strip_tags(get_the_content()), $excerpt_length); ?></p>
                    <?php } else { ?>
                        <p><?php the_content(); ?></p>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if($show_read_more || $show_popup || $portfolio_link !='') :?>
                <div class="cshero-portfolio-link-wrap">
                    <div class="cshero-portfolio-link-inner">
                        <?php if($portfolio_link !='' && $show_link){ ?>
                            <a class="btn btn-primary" style="color:<?php echo $item_content_color;?>" href="<?php echo  esc_url($portfolio_link); ?>" title="<?php the_title(); ?>" target="_blank">
                                <i class="fa fa-external-link"></i>
                            </a>
                        <?php } ?>
                        <?php if($show_read_more) :?>
                            <a class="btn btn-primary" style="color:<?php echo $item_content_color;?>" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" >
                                <i class="fa fa-link"></i>
                            </a>
                        <?php endif;?>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</article>
                    