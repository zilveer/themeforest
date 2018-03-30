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


$extra_class_1column = "";

if ($columns == 1) {
    $extra_class_1column = "span6";
}
?>

<div class="cs-portfolio-container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="cs-portfolio-content <?php echo $extra_class_1column; ?>">
            <?php
            if (has_post_thumbnail()) {
                $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                if($crop_image == true || $crop_image == 1){

                    $image_resize = matthewruddy_image_resize( $attachment_image[0], $width_image, $height_image, true, false );
                    echo '<img alt="" class="attachment-featuredImageCropped" src="'. esc_attr($image_resize['url']) .'" />';
                }else{
                   echo '<img alt="" src="'. esc_attr($attachment_image[0]) .'" />';
                }
                $image_large = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
            }
            ?>
            
            <div class="cs-portfolio-details <?php echo esc_attr($extra_class_1column); ?>">
                <?php
                if($read_more != '-1' || $view_online != '-1'){
                    echo '<div class="cs-read-more-button">';
                        if ($read_more != '-1') {
                            echo '<a class="cs-read-more" title="' . esc_attr($read_more) . '" href="' . esc_url(get_permalink(get_the_ID())) . '" rel=""><i class="ion-plus-round"></i></a>';
                        }
                    echo '</div>';
                }
                ?>
            </div>
            
        </div>
    </article>
</div>