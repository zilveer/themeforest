<?php

//disable zoom icon if its disabled from shortcode options
if ($view_params['zoom_icon'] == 'false') return false;

//moves zoom icons to center if permalink icon is disabled
$single_icon_inview = $view_params['permalink_icon'] == 'false' ? 'move-to-right' : '';

$post_type = get_post_meta($post->ID, '_single_post_type', true);
$post_type = !empty($post_type) ? $post_type : 'image';

?>

<a class="mk-lightbox hover-icon from-right <?php echo $single_icon_inview; ?>" href="<?php echo mk_get_portfolio_lightbox_url($post_type); ?>" title="<?php the_title_attribute(); ?>" data-fancybox-group="portfolio-loop-item" ><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-plus-circle', 32); ?></a>
