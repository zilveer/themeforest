<?php $text_align =''; if($counter%2 != '1') $text_align = 'right'; else $text_align = 'left'; ?>
<article <?php post_class(); ?>>
    <div class="cshero-carousel-container row">
        <?php if($show_image) { ?>
        <div class="cshero-carousel-image clearfix col-sx-12 col-sm-12 col-mid-6 col-lg-6 nopaddingleft nopaddingright <?php if($counter%2 != '1') echo 'right';?>" <?php echo $crop_image_size;?>>
            <?php
            if (has_post_thumbnail() and wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)){
                $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                $full_image = $attachment_image[0];
                if($crop_image){
                    $image_resize = mr_image_resize( $attachment_image[0], $width_image, $height_image, true, 'c', false );
                    echo '<img alt=""  src="'. $image_resize .'" '.$image_style.' />';
                }else{
                   echo '<img alt src="'. esc_attr($attachment_image[0]) .'"   '.$image_style.'  />';
                }
            } else {
                $attachment_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
                $full_image = $attachment_image;
                if($crop_image == '1'){
                    $image_resize = mr_image_resize( $attachment_image, $width_image, $height_image, true, false );
                    echo '<img alt="" src="'. $image_resize .'"   '.$image_style.' />';
                }else{
                    echo '<img alt="" src="'. $attachment_image .'"  '.$image_style.' />';
                }

            } ?>
            <?php if($show_read_more || $show_popup): ?>
                <div class="overlay <?php echo $overlay_appear;?>" <?php echo $overlay_style; ?>>
                    <div class="overlay-content">
                        <div class="link-wrap">
                        <?php if($show_read_more) { ?>
                            <a class="btn btn-primary-alt btn-small btn-no-radius" title="" href="<?php echo esc_url(get_the_permalink());?>">
                                <?php echo __($read_more,THEMENAME);?>
                            </a>
                        <?php } ?>
                        <?php if($show_popup) { ?>
                            <a class="btn btn-primary-alt btn-small btn-no-radius" href="<?php echo esc_url($full_image);?>">
                                <?php echo __($popup_text,THEMENAME);?>
                            </a>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="cshero-carousel-body col-sx-12 col-sm-12 col-mid-6 col-lg-6" style="<?php echo 'color:'.$content_color.'; text-align:'.$text_align.';background-color:'.$content_bg_color.';padding:'.$content_padding.';';?>">
            <div class="cshero-carousel-inner clearfix" style="padding-<?php echo $text_align;?>:60px;">
                <?php if($show_date || $show_category || $show_comment || $show_author): ?>
                <div class="cshero-carousel-meta clearfix">
                    <?php if($show_date) :?>
                    <span class="cshero-carousel-date" <?php echo $date_style;?>><?php if($date_format=='time'){echo tp_relative_time(get_the_date('Y-m-d H:i'));} else{
                        
                        $date = explode(' ', get_the_date($date_format));
                        $date_part1 = array_shift($date);
                        $date_part2 = join(' ', $date);
                        echo '<span class="first-word">'.$date_part1.'</span>';
                        echo '<span class="last-word">'.$date_part2.'</span>';
                        }?></span>
                    <?php endif; ?>
                    <?php if ($show_category) : ?>
                        <span class="cshero-carousel-category">
                            <?php echo _e("in",THEMENAME).' '; echo strip_tags (get_the_term_list($post->ID, 'category', '', ', ', '')); ?>
                        </span>
                    <?php endif; ?>
                    <?php if($show_comment) :?>
                    <span class="cshero-carousel-comment">
                        <?php
                        $comments = (int)get_comments_number();
                        if($comments > 0){
                            echo $comments." Comments";
                        }
                        else {
                            echo _e("No Comments",THEMENAME);
                        }
                        ?>
                    </span>
                    <?php endif; ?>
                    <?php if($show_author) :?>
                    <span class="cshero-carousel-author"><?php the_author(); ?></span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if ($show_title) { ?>
                    <<?php echo $item_heading_size; ?> class="cshero-carousel-title">
                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="" <?php echo $item_title_style;?>>
                            <?php the_title(); ?>
                        </a>
                    </<?php echo $item_heading_size; ?>>
                <?php } ?>
                
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
        <?php } else {?>
            <div class="cshero-carousel-body col-sx-12 col-sm-12 col-mid-12 col-lg-12" style="<?php echo 'color:'.$content_color.'; text-align:'.$text_align.';background-color:'.$content_bg_color.';padding:'.$content_padding.';';?>">
                <div class="cshero-carousel-inner clearfix">
                    <?php if($show_date || $show_comment || $show_author): ?>
                    <div class="cshero-carousel-meta clearfix">
                        <?php if($show_date) :?>
                        <span class="cshero-carousel-date" <?php echo $date_style;?>><?php 
                        if($date_format=='time'){
                            echo tp_relative_time(get_the_date('Y-m-d H:i'));
                        }
                        else{
                            echo get_the_date($date_format);
                        }
                        ?></span>
                        <?php endif; ?>
                        <?php if ($show_category) : ?>
                            <span class="cshero-carousel-category">
                                <?php echo _e("in",THEMENAME).' '; echo strip_tags (get_the_term_list($post->ID, 'category', '', ', ', '')); ?>
                            </span>
                        <?php endif; ?>
                        <?php if($show_comment) :?>
                        <span class="cshero-carousel-comment">
                            <?php
                            $comments = (int)get_comments_number();
                            if($comments > 0){
                                echo $comments." Comments";
                            }
                            else {
                                echo _e("No Comments",THEMENAME);
                            }
                            ?>
                        </span>
                        <?php endif; ?>
                        <?php if($show_author) :?>
                        <span class="cshero-carousel-author"><?php the_author(); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if ($show_title) { ?>
                        <<?php echo $item_heading_size; ?> class="cshero-carousel-title">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="" <?php echo $item_title_style;?>>
                                <?php the_title(); ?>
                            </a>
                        </<?php echo $item_heading_size; ?>>
                    <?php } ?>
                    
                    <?php if ($show_description) { ?>
                    <div class="cshero-carousel-post-description">
                        <?php if ($excerpt_length != -1) { ?>
                            <p><?php echo cshero_content_max_charlength(strip_tags(get_the_content()), $excerpt_length); ?></p>
                        <?php } else { ?>
                            <p><?php the_content(); ?></p>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <?php if($show_read_more || $show_popup): ?>
                        <div class="link-wrap">
                        <?php if($show_read_more) echo $readmore_link; ?>
                        <?php if($show_popup) echo $popup_link; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
</article>
