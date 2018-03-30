
<?php
global $post, $wp_query, $portfolio_options, $cs_portfolio_id;
$custom = get_post_custom($post->ID);
$portfolio_link = get_post_meta(get_the_ID(), 'cs_portfolio_link', true);

?>
<div class="cshero-portfolio-container" style="margin-right:<?php echo $item_margin; ?>;margin-bottom:<?php echo $item_margin; ?>;">
    <article <?php post_class(); ?>>
        <div class="cshero-portfolio-item-content">
            <?php
            if (has_post_thumbnail() and wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) {
                $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                if($crop_image){
                    $image_resize = mr_image_resize( $attachment_image[0], $width_image, $height_image, true, 'c', false );
                    echo '<img alt="" src="'. esc_url($image_resize) .'" />';
                }else{
                    echo '<img alt="" src="'. esc_attr($attachment_image[0]) .'" />';
                }
                $image_large = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
                $full_image = $image_large[0];
            } else{
                $no_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
                if($crop_image){
                    $image_resize = mr_image_resize( $no_image, $width_image, $height_image, true,'c', false );
                    echo '<img alt="" src="'. esc_url($image_resize) .'" />';
                }else{
                    echo '<img alt="" src="'. esc_attr($no_image) .'" />';
                }
                $full_image = $no_image;
            }
            ?>
            <div class="cshero-portfolio-content-wrap" style="background-color:<?php echo $item_bg_color; ?>;">
            <div class="cshero-portfolio-content-wrap-inner">
                <div class="cshero-portfolio-meta-box">
                    <?php
                    if ($show_title) {
                        echo '<h5 class="cshero-portfolio-title"><a style="color:'.$title_color.'!important;" title="' . esc_attr(get_the_title()) . '" href="' . esc_url(get_permalink(get_the_ID())) . '" >' . get_the_title() . '</a></h5>';
                    }

                    if ($show_category) {
                        echo '<div class="cshero-portfolio-category">' . get_the_term_list($wp_query->post->ID, 'portfolio_category', '', ', ', '') . '</div>';
                    }
                    ?>
                </div>

                <?php if ($show_description) { ?>
                    <div class="cshero-portfolio-content">
                        <div class="cshero-portfolio-content-inner">
                            <?php
                            if ($show_description) {
                                echo '<div class="cshero-portfolio-description" style="color:'.$description_color.';">';
                                if ($excerpt_length != -1) {
                                    echo cshero_content_max_charlength(strip_shortcodes(get_the_content()), (int) $excerpt_length);
                                } else {
                                    echo strip_shortcodes(get_the_content());
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($read_more || $zoom || $show_link) { ?>
                <div class="link-wrap <?php echo esc_attr($link_type); ?>">
                    <?php
                    if($link_type == 'button'){
                        $launch_link = '<a class="btn btn-default" href="' . esc_url($portfolio_link) . '" target="_blank">'.__($link_text,THEMENAME).'</a>';
                        $readmore_link = '<a class="btn btn-default" title="" href="' . esc_url(get_the_permalink())  . '" >'.__($read_more_text,THEMENAME).'</a>';
                        $zoom_link = '<a class="btn btn-default colorbox" href="'.esc_url($full_image).'" >'.__($zoom_text,THEMENAME).'</a>';
                    } elseif($link_type == 'text'){
                        $launch_link = '<a class="" href="' . esc_url($portfolio_link) . '" target="_blank">'.__($link_text,THEMENAME).'</a>';
                        $readmore_link = '<a class="" title="" href="' . esc_url(get_the_permalink())  . '" >'.__($read_more_text,THEMENAME).'</a>';
                        $zoom_link = '<a class="colorbox" href="'.esc_url($full_image).'" >'.__($zoom_text,THEMENAME).'</a>';
                    } else {
                        $launch_link = '<a class="icon-link" href="' . esc_url($portfolio_link) . '" title="'.__(get_the_title(),THEMENAME).'" target="_blank"><i class="'.$link_icon.'"></i></a>';
                        $readmore_link = '<a class="icon-link" title="'.__(get_the_title(),THEMENAME).'" href="' . esc_url(get_the_permalink())  . '" ><i class="'.$read_more_icon.'"></i></a>';
                        $zoom_link = '<a class="icon-link colorbox" title="'.__(get_the_title(),THEMENAME).'" href="'.esc_url($full_image).'" ><i class="'.$zoom_icon.'"></i></a>';
                    }

                    if($portfolio_link !='' && $show_link){
                        echo $launch_link;
                    }
                    if($read_more){
                        echo $readmore_link;
                    }
                    if($zoom){
                        echo $zoom_link;
                    }
                    ?>
                </div>
                <?php } ?>
            </div>
            </div>
        </div>
        <h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
    </article>
</div>
