<?php
    $counter =0;
    while ($wp_query->have_posts()) : $wp_query->the_post();
    $counter++;
    if($rows == 1){
            echo '<div class="cs-client-carousel-item-wrap">';
        }else{
            if($counter % $rows == 1){
                echo '<div class="cs-client-carousel-item-wrap">';
            }
        }
    ?>
    <div class="cs-carousel-item" <?php if(!$counter % $rows == 0) echo 'style="margin-bottom:'.esc_attr($margin_item).'px;"'; ?>>
       <div <?php  post_class(); ?>>
           <div class="cs-carousel-container">
                <?php
                $custom = get_post_custom($post->ID);
                $client_link = "#";
                if(get_post_meta($post->ID, 'cs_client_link', true)){
                    $client_link = get_post_meta($post->ID, 'cs_client_link', true);
                }
                if (has_post_thumbnail() and wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) {
                    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                    if($crop_image ){
                        $image_resize = mr_image_resize( $attachment_image[0], $width_image, $height_image, true, 'c', false );
                        if($show_link ){
                            echo   '<a href="' . esc_url($client_link) . '">
                                    <img alt="" src="'. esc_attr($image_resize) .'" />
                                    </a>';
                        }else{
                            echo '<img alt="" src="'. esc_attr($image_resize) .'" />';
                        }
                    }else{
                        if($show_link){
                            echo '<a href="' . esc_url($client_link) . '"><img alt="" src="' . esc_attr($attachment_image[0]) . '" /></a>';
                        }else{
                            echo '<img alt="" src="' . esc_attr($attachment_image[0]) . '" />';
                        }
                    }
                } else {
                    $no_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
                    if($crop_image ){
                        $image_resize = mr_image_resize( $no_image, $width_image, $height_image, true, 'c', false );
                        if($show_link ){
                            echo   '<a href="' . esc_url($client_link) . '">
                                    <img alt=""  src="'. esc_attr($image_resize) .'" />
                                    </a>';
                        }else{
                            echo '<img alt="" src="'. esc_attr($image_resize) .'" />';
                        }
                    }else{
                        if($show_link){
                            echo '<a href="' . esc_url($client_link) . '"><img alt="" src="' . esc_attr($no_image) . '" /></a>';
                        }else{
                            echo '<img alt="" src="' . esc_attr($no_image) . '" />';
                        }
                    }
                }
                ?>
                <?php if($show_client_title) :?>
                    <<?php echo $client_title_size; ?> class="cshero-client-title <?php echo $client_title_align;?>" <?php echo $client_title_style;?>>
                        <?php if($show_link ){ echo   '<a href="' . esc_url($client_link) . '" '.$client_title_style.'>'; }?>
                            <?php the_title(); ?>
                        <?php if($show_link ){ echo   '</a>'; } ?>
                    </<?php echo $client_title_size; ?>>
                <?php endif; ?>
            </div>
       </div>
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