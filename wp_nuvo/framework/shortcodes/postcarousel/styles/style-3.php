<?php
    $same_height=($same_height)?"true":"false";
    $onload = "if(".$same_height."){ sameHeight();}";
?>
<div id="cs_carousel_post<?php echo esc_attr($date); ?>" class="cs-carousel-post cs-carousel-style-3 <?php echo esc_attr($cl_show).' '.esc_attr($el_class); ?> <?php echo $same_height?'sameheight':'';?>">
    <div class="cs-header">
        <?php if ($title != "" || $description != "") { ?>
            <?php if ($title != "") { ?>
                <<?php echo $heading_size; ?> class="cs-title" <?php echo $_title_color; ?>><?php echo esc_attr($title); ?></<?php echo $heading_size; ?>>
            <?php } ?>
            <?php if ($subtitle !=""){ ?>
                <<?php echo $subtitle_heading_size; ?> class="cs-subtitle"><?php echo esc_attr($subtitle); ?></<?php echo $subtitle_heading_size; ?>>
            <?php }?>
            <?php if ($description != "") { ?>
                <p class="cs-desc"><?php echo esc_attr($description); ?></p>
            <?php } ?>
        <?php } ?>
    </div>
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
                                    <?php
                                    $attachment_full_image = "";
                                    if (has_post_thumbnail()) {
                                        $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                                        $attachment_full_image = $attachment_image[0];
                                        if($crop_image == true || $crop_image == 1){
                                            $image_resize = matthewruddy_image_resize( $attachment_image[0], $width_image, $height_image, true, false );
                                            echo '<img alt="" class="attachment-featuredImageCropped" src="'. esc_attr($image_resize['url']) .'" />';
                                        }else{
                                           echo get_the_post_thumbnail($post->ID);
                                        }
                                    }
                                    ?>
                                    <div class="cs-carousel-header-feature">
                                        <?php if ($show_title == "true" || $show_title == '1') : ?>
                                            <h3><?php the_title(); ?></h3>
                                        <?php endif; ?>
                                        <?php
                                    	$categories = get_the_category($post->ID);
                                    	$separator = '/ ';
                                    	$output = ''; ?>
                                    	<?php if(!empty($categories)): ?>
                                    	<span class="cs-category">
                                    		<?php
            								foreach($categories as $category) {
            									$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s",'wp_nuvo'), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
            								}
                							echo trim($output, $separator);
                    						?>
                                    	</span>
                                    	<?php endif; ?>
                                    </div>
                                    <?php if(get_post_meta($post->ID, 'cs_post_icon', true)): ?>
                                        <div class="cs-carousel-post-icon">
                                            <span><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" ><i class="<?php echo esc_attr(get_post_meta($post->ID, 'cs_post_icon', true)); ?>"></i></a><span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="cs-carousel-body">
                                    <?php if(get_post_meta($post->ID, 'cs_post_icon', true)): ?>
                                        <div class="cs-carousel-post-icon">
                                            <span><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" ><i class="<?php echo esc_attr(get_post_meta($post->ID, 'cs_post_icon', true)); ?>"></i></a><span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="cs-carousel-inner">
                                        <div class="cs-carousel-post-meta">
                                            <div class="cs-carousel-post-title">
                                                <h3><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" ><?php echo esc_attr(get_post_meta($post->ID, 'cs_sub_title', true)); ?></a></h2>
                                            </div>
                                        </div>
                                        <?php if ($show_description== true || $show_description == 1 || $read_more != '') { ?>
                                        <div class="cs-carousel-post-description">
                                            <?php
                                            if($show_description== true || $show_description == 1){
                                                if ($excerpt_length != -1) {
                                            ?>
                                                <p><?php echo cshero_content_max_charlength(get_the_excerpt(), $excerpt_length); ?></p>
                                            <?php } else { ?>
                                                <p><?php the_content(); ?></p>
                                            <?php }
                                            }
                                            ?>
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