<?php
    $same_height=($same_height)?"true":"false";
    $onload = "if(".$same_height."){ sameHeight();}";
?>
<div id="cs_carousel_post<?php echo esc_attr($date); ?>" class="cs-carousel-event cs-carousel-event-style1 <?php echo esc_attr($cl_show).' '.esc_attr($el_class); ?>">
        <div class="cs-header">
            <?php if ($title != "" || $description != "") { ?>
                <?php if ($title != "") { ?>
                    <<?php echo $heading_size; ?> class="cs-title" <?php echo $title_color; ?>><?php echo esc_attr($title); ?></<?php echo $heading_size; ?>>
                <?php } ?>
                <?php if ($subtitle !=""){ ?>
                    <<?php echo $subtitle_heading_size; ?> class="cs-subtitle"><?php echo esc_attr($subtitle); ?></<?php echo $subtitle_heading_size; ?>>
                <?php }?>
                <?php if ($description != "") { ?>
                    <p class="cs-desc"><?php echo esc_attr($description); ?></p>
                <?php } ?>
            <?php } ?>
            <?php if($show_nav == true || $show_nav == 1){ ?>
                <div class="cs-nav">
                    <ul>
                        <li class="prev"></li>
                        <li class="next"></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
        <div class="cs-content">
            <div class="cs-carousel-list">
                <div id="cs_carousel_post_<?php echo esc_attr($date); ?>" data-moveslides="1" data-auto="<?php echo esc_attr($auto_scroll); ?>" data-prevselector="#cs_carousel_post<?php echo esc_attr($date); ?> .prev" data-nextselector="#cs_carousel_post<?php echo esc_attr($date); ?> .next" data-onsliderload="<?php echo esc_attr($onload);?>" data-touchenabled="1" data-controls="true" data-pager="false" data-pause="4000" data-infiniteloop="true" data-adaptiveheight="true" data-speed="500" data-autohover="true" data-slidemargin="<?php echo esc_attr($margin_item); ?>" data-maxslides="3" data-minslides="1" data-slidewidth="<?php echo esc_attr($width_item);?>" data-slideselector="" data-easing="swing" data-usecss="" data-resize="1" class="slider jm-bxslider">
                    <?php
                    $counter =0;
                    foreach ($_event->posts as $event):
                    $counter++;
                    if($rows == 1){
                            echo '<div class="cs-carousel-events-wrap">';
                        }else{
                            if($counter % $rows == 1){
                                echo '<div class="cs-carousel-events-wrap">';
                            }
                        }
                    ?>
                        <div class="cs-carousel-item-events" <?php if(!$counter % $rows == 0) echo 'style="margin-bottom:'.esc_attr($margin_item).'px;"'; ?>>
                            <article id="post-<?php echo $event->ID; ?>">
                                <div class="cs-carousel-events-container">
                                    <div class="cs-carousel-events-header">
                                        <?php
                                        $attachment_full_image = "";
                                        if (has_post_thumbnail($event->ID)) {
                                            $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($event->ID), 'full', false);
                                            $attachment_full_image = $attachment_image[0];
                                            if($crop_image == true || $crop_image == 1){
                                                $image_resize = matthewruddy_image_resize( $attachment_image[0], $width_image, $height_image, true, false );
                                                echo '<img alt="" class="attachment-featuredImageCropped" src="'. esc_attr($image_resize['url']) .'" />';
                                            }else{
                                               echo get_the_post_thumbnail($event->ID);
                                            }
                                        } else {
                                        	echo '<img alt="" src="'.get_template_directory_uri().'/images/demo_images/sample.png" />';
                                        }
                                        ?>
                                        <?php if (isset($show_date) && $show_date == true) { ?>
                                            <div class="cs-carousel-events-date">
                                                <span class="cs-day"><?php echo mysql2date( 'd', get_post_meta($event->ID, '_event_start_date', true)); ?></span>
                                                <span class="cs-month"><?php echo mysql2date( 'M', get_post_meta($event->ID, '_event_start_date', true)); ?></span>
                                            </div>
                                        <?php } ?>
                                        <div class="cs-carousel-events-body">
                                            <?php if ($show_title == true || $show_title == '1') { ?>
                                                <div class="cs-event-title">
                                                    <h3 class="cs-carousel-event-title"><a title="<?php echo $event->post_title; ?>" href="<?php echo get_permalink($event->ID); ?>" rel=""><?php echo $event->post_title; ?></a></h3>
                                                </div>
                                            <?php } ?>
                                            <?php if ($show_description== true || $show_description == 1 || $read_more != '') { ?>
                                            <div class="cs-carousel-events-description">
                                                <?php
                                                if($show_description== true || $show_description == 1){
                                                    if ($excerpt_length != -1) {
                                                ?>
                                                    <p><?php echo cshero_content_max_charlength(strip_tags($event->post_content), $excerpt_length); ?></p>
                                                <?php } else { ?>
                                                    <p><?php echo strip_tags($event->post_content) ; ?></p>
                                                <?php }
                                                }
                                                ?>
                                                <?php if($read_more): ?>
                                                    <div class="cs-carousel-events-read-more">
                                                        <a href="<?php echo get_permalink($event->ID); ?>" class="btn btn-default"><?php echo esc_attr($read_more); ?></a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php
                    if($rows == 1){
                        echo '</div>';
                    }else{
                        if($counter % $rows == 0){
                            echo '</div>';
                        }
                    }
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>