<?php
global $post, $wp_query, $portfolio_options;
$show_title = $portfolio_options['show_title'];
$show_category = $portfolio_options['show_category'];
$show_description = $portfolio_options['show_description'];
$excerpt_length = $portfolio_options['excerpt_length'];
$columns = $portfolio_options['columns'];
$crop_image = $portfolio_options['crop_image'];
$width_image = $portfolio_options['width_image'];
$height_image = $portfolio_options['height_image'];
$enlarge = $portfolio_options['enlarge'];
$view_online = $portfolio_options['view_online'];
$read_more = $portfolio_options['read_more'];
$custom = get_post_custom($post->ID);
$portfolio_link = get_post_meta(get_the_ID(), 'cs_portfolio_link', true);
$url_view_online = get_post_meta(get_the_ID(), '_probusiness_portfolio_view_online', true);
$index = 0;
$count = 0;
$extra_class_1column = "";
if ($columns == 1) {
    $extra_class_1column = "span6";
}
?>
<div class="cs-portfolio-container style-3">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="cs-portfolio-header <?php echo $extra_class_1column; ?>">
           <?php if (($show_title == "true" || $show_title == 1 || $show_description == "true" || $show_description == 1)) { ?>
                <div class="cs-portfolio-content <?php echo esc_attr($extra_class_1column); ?>">
                    <div class="cs-portfolio-content-inner">
                        <?php
                        if ($show_title == "true") {
                            echo '<h4 class="cs-portfolio-title"><a title="' . esc_attr(get_the_title()) . '" href="' . esc_url($portfolio_link) . '" rel="">' . get_the_title() . '</a></h4>';
                        }
                        if ($show_category == "true") {
                            echo '<div class="cs-portfolio-category">' . get_the_term_list($wp_query->post->ID, 'portfolio_category', '', ', ', '') . '</div>';
                        }
                        if ($show_description == "true") {
                            echo '<div class="cs-portfolio-description">';
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
			<?php
            if (has_post_thumbnail()) {
                $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                if($crop_image == true || $crop_image == 1){
                    $image_resize = matthewruddy_image_resize( $attachment_image[0], $width_image, $height_image, true, false );
                    echo '<div class="cs-mainpage"><img alt="" class="attachment-featuredImageCropped" src="'. esc_attr($image_resize['url']) .'" /><a class="ion-plus-round" href="' . esc_url($portfolio_link) . '" target="_blank"></a></div>';
                }else{
                   echo '<div class="cs-mainpage"><img alt="" src="'. esc_attr($attachment_image[0]) .'" /><a class="ion-plus-round" href="' . esc_url($portfolio_link) . '" target="_blank"></a></div>';
                }
                $image_large = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
            }
            ?>
            <div class="cs-portfolio-footer">
                <?php
                    if($read_more == 'true'){
                        echo '<div class="cs-portfolio-readmore">';
                            echo '<a data-original-title="' . esc_attr($read_more) . '" class="cs-read-more" title="" href="' . esc_url($portfolio_link) . '" rel="tooltip"><i class="fa fa-share"></i></a>';
                        echo '</div>';
                  }
                ?>
            </div>
        </div>
    </article>
</div>
