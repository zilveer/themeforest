<?php
    $same_height=($same_height)?"true":"false";
    $onload = "if({$same_height}){ sameHeight();}";
?>
<div id="cs_carousel_post<?php echo esc_attr($date); ?>" class="cs-carousel-portfolio cs-carousel-portfolio-default2 cs-carousel-portfolio-agency  cs-nav-style2 <?php echo esc_attr($cl_show).' '.esc_attr($el_class); ?> <?php echo $same_height?'sameheight':'';?>">
    <?php if ($title != "" || $description != "") { ?>
        <div class="cs-header">
            <?php if ($title != "") { ?>
                <<?php echo $heading_size; ?> class="cs-title" <?php if($title_color){ echo 'style="color:'.$title_color.'!important;"'; }; ?>><span class="line"><?php echo esc_attr($title); ?></span></<?php echo $heading_size; ?>>
            <?php } ?>
            <?php if ($subtitle !=""){ ?>
                <<?php echo $subtitle_heading_size; ?> class="cs-subtitle"><?php echo esc_attr($subtitle); ?></<?php echo $subtitle_heading_size; ?>>
            <?php }?>
            <?php if ($description != "") { ?>
                <p class="cs-desc"><?php echo esc_attr($description); ?></p>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="cs-content">
        <div class="cs-carousel-list">
            <div id="cs_carousel_post_<?php echo esc_attr($date); ?>" data-moveslides="1" data-auto="<?php echo esc_attr($auto_scroll); ?>" data-prevselector="#cs_carousel_post<?php echo esc_attr($date); ?> .prev" data-nextselector="#cs_carousel_post<?php echo esc_attr($date); ?> .next" data-onsliderload="<?php echo esc_attr($onload);?>" data-touchenabled="1" data-controls="true" data-pager="false" data-pause="4000" data-infiniteloop="true" data-adaptiveheight="true" data-speed="500" data-autohover="true" data-slidemargin="<?php echo esc_attr($margin_item); ?>" data-maxslides="4" data-minslides="1" data-slidewidth="<?php echo esc_attr($width_item);?>" data-slideselector="" data-easing="swing" data-usecss="" data-resize="1" class="slider jm-bxslider">
                <?php
                $counter =0;
                while ($wp_query->have_posts()) : $wp_query->the_post();
                $counter++;
                if($rows == 1){
                        echo '<div class="cs-carousel-item-wrap">';
                    }else{
                        if($counter % $rows == 1){
                            echo '<div class="cs-carousel-item-wrap">';
                        }
                    }
                ?>
                    <div class="cs-carousel-item" <?php if(!$counter % $rows == 0) echo 'style="margin-bottom:'.esc_attr($margin_item).'px;"'; ?>>
                        <article id="post-<?php echo the_ID() ?>" <?php  post_class(); ?>>
                            <div class="cs-carousel-container">
                                <div class="cs-carousel-header">
                                    <div class="cs-carousel-meta">
                                        <?php if ($show_title == "true" || $show_title == '1') { ?>
                                        <div class="cs-carousel-post-title">
                                            <h3 class="cs-carousel-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel=""><?php the_title(); ?></a></h3>
                                        </div>
                                        <?php } ?>
                                        <div class="cs-carousel-category">
                                            <span>
                                            <?php
                                                $categorys = get_the_terms(get_the_ID(),'portfolio_category');
                                                $list_categorys = array();
                                                foreach ($categorys as $category){
                                                    $list_categorys[] = $category->name;
                                                }
                                                echo implode(', ', $list_categorys);
                                            ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="cs-carousel-thumbnail">
                                        <?php
                                            $attachment_full_image = "";
                                            if (has_post_thumbnail()) {
                                                $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                                                $attachment_full_image = $attachment_image[0];
                                                if($crop_image == true || $crop_image == 1){
                                                    $image_resize = matthewruddy_image_resize( $attachment_image[0], $width_image, $height_image, true, false );
                                                    echo '<img class="attachment-featuredImageCropped" src="'. esc_attr($image_resize['url']) .'" />';
                                                }else{
                                                   echo get_the_post_thumbnail($post->ID);
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="cs-more-meta">
                                        <span class="cs-meta-readmore"><i class="ion-ios7-redo-outline"></i><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel=""><?php esc_html_e("More",'wp_nuvo'); ?></a></span>
                                        <span class="cs-meta-zoom"><i class="ion-ios7-glasses-outline"></i><a href="<?php echo esc_url($attachment_full_image); ?>" class="colorbox"><?php esc_html_e("Zoom",'wp_nuvo'); ?></a></span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php
                if($rows == 1){
                    echo '</div>';
                }else{
                    if(($counter % $rows == 0)||($counter==$wp_query->post_count)){
                        echo '</div>';
                    }
                }
                endwhile;
                wp_reset_query();
                ?>
            </div>
        </div>
        <?php if($show_nav == true || $show_nav == 1){ ?>
            <div class="cs-nav">
                <ul>
                    <li class="prev"></li>
                    <li class="next"></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>