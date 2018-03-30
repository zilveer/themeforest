<?php 
$lightbox_push_top = '';
$custom_links = $view_params['custom_links'];
$link = isset($custom_links[$view_params['i']]) ? $custom_links[$view_params['i']] : '';
$image_title     = get_the_title();
$alt             = esc_attr(get_post_meta($post->ID, '_wp_attachment_image_alt', true));
$caption             = $post->post_excerpt;
$image_title     = $view_params['collection_title'] ? $view_params['collection_title'] : $image_title;

if($view_params['hover_scenarios'] == 'none') { 

    if (isset($link) && $link != '') { ?>
        <a href="<?php echo $link; ?>" class="full-cover-link">&nbsp;</a>
    <?php } else { ?>
        <a href="<?php echo wp_get_attachment_image_src($post->ID, 'full', true)[0]; ?>" alt="<?php echo $alt; ?>" title="<?php the_title_attribute(); ?>" data-fancybox-group="gallery-<?php echo $view_params['id']; ?>" class="mk-lightbox full-cover-link">&nbsp;</a>
    <?php }
}
?>


<?php if($view_params['hover_scenarios'] != 'none') { ?>

    <div class="image-hover-overlay">
        <?php if($view_params['hover_scenarios'] === 'grayscale') {
            echo mk_get_shortcode_view('mk_gallery', 'components/image', true, array(
                        'style' => $view_params['style'], 
                        'column' => $view_params['column'], 
                        'height' => $view_params['height'], 
                        //'image_quality' => $view_params['image_quality'], 
                        'image_size' => $view_params['image_size']
                        )
            );   
        } ?>
    </div>
      
    <?php if ($view_params['hover_scenarios'] == "overlay_layer" || $view_params['disable_title'] != 'false' && !empty($image_title)) { ?>
        <div class="gallery-desc">
            <div class="gallery-title"><?php echo $image_title; ?></div>
            <div class="gallery-caption"><?php echo $caption; ?></div>
        </div>
        <?php $lightbox_push_top = 'lightbox-push-top';
    }


     if (isset($link) && $link != '') { ?>
        
        <a href="<?php echo $link; ?>" class="mk-image-lightbox">
            <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-plus-circle'); ?>
        </a>

    <?php } else { ?>

        <a href="<?php echo wp_get_attachment_image_src($post->ID, 'full', true)[0]; ?>" alt="<?php echo $alt; ?>" title="<?php the_title_attribute(); ?>" data-fancybox-group="gallery-<?php echo $view_params['id']; ?>" class="mk-lightbox <?php echo $lightbox_push_top; ?> mk-image-lightbox">
            <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-plus-circle'); ?>
        </a>

    <?php }
} ?>

