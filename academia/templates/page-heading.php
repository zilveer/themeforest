<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/2/2015
 * Time: 2:54 PM
 */
$g5plus_options = &G5Plus_Global::get_options();
$post_types =  get_post_type();
$prefix = 'g5plus_';
$show_page_title =  rwmb_meta($prefix.'show_page_title');

//Show Page Title
if (($show_page_title == -1) || ($show_page_title === '')) {
    if (is_singular('post')) {
        $show_page_title = isset($g5plus_options['show_single_blog_title']) ? $g5plus_options['show_single_blog_title'] : 1;
    }elseif(is_singular('product')){
        $show_page_title = isset($g5plus_options['show_single_product_title']) ? $g5plus_options['show_single_product_title'] : 1;
    }elseif(is_singular('tribe_events')){
        $show_page_title = isset($g5plus_options['show_single_event_title']) ? $g5plus_options['show_single_event_title'] : 1;
    }else {
        $show_page_title = isset($g5plus_options['show_page_title']) ? $g5plus_options['show_page_title'] : 1;
    }
}
if ($show_page_title == 0) return;

//Page Title Style
$page_title_style =  rwmb_meta($prefix.'style_page_title');
if($page_title_style == ""){
    if (is_singular('post')) {
        $page_title_style = isset($g5plus_options['style_single_blog_title']) ? $g5plus_options['style_single_blog_title'] : "";
    }elseif(is_singular('product')){
        $page_title_style = isset($g5plus_options['style_single_product_title']) ? $g5plus_options['style_single_product_title'] : "";
    }elseif(is_singular('tribe_events')){
        $page_title_style = isset($g5plus_options['style_single_event_title']) ? $g5plus_options['style_single_event_title'] : "";
    }else {
        $page_title_style = isset($g5plus_options['style_page_title']) ? $g5plus_options['style_page_title'] : "";
    }
}

// Page Title Text Align
$page_title_text_align = rwmb_meta($prefix . 'page_title_text_align');
if(!isset($page_title_text_align) || ($page_title_text_align == '') || ($page_title_text_align == '-1')) {
    if (is_singular('post')) {
        $page_title_text_align = isset($g5plus_options['single_blog_title_text_align']) ? $g5plus_options['single_blog_title_text_align'] : 'center';
    } elseif(is_singular('product')) {
        $page_title_text_align = isset($g5plus_options['single_product_title_text_align']) ? $g5plus_options['single_product_title_text_align'] : 'center';
    }elseif(is_singular('tribe_events')){
        $page_title_text_align = isset($g5plus_options['single_event_title_text_align']) ? $g5plus_options['single_event_title_text_align'] : 'center';
    } else {
        $page_title_text_align = isset($g5plus_options['page_title_text_align']) ? $g5plus_options['page_title_text_align'] : 'center';
    }
}
if($page_title_style == "pt-bottom"){
    $page_title_text_align = "";
}



$page_title = rwmb_meta($prefix.'page_title_custom');
if ($page_title === '') {
    $page_title = get_the_title();
}


$enable_custom_page_subtitle = rwmb_meta($prefix.'enable_custom_page_subtitle');
if ($enable_custom_page_subtitle == 1) {
    $page_sub_title = rwmb_meta($prefix.'page_subtitle_custom');
} else {
    if (is_singular('post')) {
        $page_sub_title = isset($g5plus_options['single_blog_sub_title']) ? $g5plus_options['single_blog_sub_title'] : '';
    } elseif(is_singular('product')) {
        $page_sub_title = isset($g5plus_options['single_product_sub_title']) ? $g5plus_options['single_product_sub_title'] : '';
    }elseif(is_singular('tribe_events')) {
        $page_sub_title = isset($g5plus_options['single_event_sub_title']) ? $g5plus_options['single_event_sub_title'] : '';
    }else {
        $page_sub_title = isset($g5plus_options['page_sub_title']) ? $g5plus_options['page_sub_title'] : '';
    }
}


$custom_styles = array();
$page_title_wrap_class = array();
$page_title_inner_class = array();

if (is_singular('post')) {
    $page_title_wrap_class[] = 'single-blog-title-wrap';
    $page_title_inner_class[] = 'single-blog-title-inner';
    $page_title_inner_class[] = $page_title_style;
} elseif(is_singular('product')) {
    $page_title_wrap_class[] = 'single-product-title-wrap';
    $page_title_inner_class[] = 'single-product-title-inner';
    $page_title_inner_class[] = $page_title_style;
}
elseif(is_singular('tribe_events')) {
    $page_title_wrap_class[] = 'single-event-title-wrap';
    $page_title_inner_class[] = 'single-event-title-inner';
    $page_title_inner_class[] = $page_title_style;
}
else {
    $page_title_wrap_class[] = 'page-title-wrap';
    $page_title_inner_class[] = 'page-title-inner';
    $page_title_inner_class[] = $page_title_style;
}

if(!empty($page_title_text_align)){
    $page_title_inner_class[] = 'text-' . $page_title_text_align;
}


$custom_inner_styles = array();

// Custom Page Title Padding
$page_title_padding_top = rwmb_meta($prefix.'page_title_padding_top');
if (($page_title_padding_top != '') && ($page_title_padding_top >= 0)) {
    $custom_inner_styles[] = 'padding-top:' . $page_title_padding_top . 'px';
}
$page_title_padding_bottom = rwmb_meta($prefix.'page_title_padding_bottom');
if (($page_title_padding_bottom != '') && ($page_title_padding_bottom >= 0)) {
    $custom_inner_styles[] = 'padding-bottom:' . $page_title_padding_bottom . 'px';
}

$page_title_color = rwmb_meta($prefix.'page_title_color');
if ($page_title_color != '') {
    $custom_inner_styles[] = 'color:' . $page_title_color ;
}
$custom_inner_style= '';
if ($custom_inner_styles) {
    $custom_inner_style = 'style="'. join(';',$custom_inner_styles).'"';
}

// Custom Page Title Background Color
$enable_custom_background_color = rwmb_meta($prefix.'enable_custom_background_color');
if ($enable_custom_background_color == 1) {
    $page_title_bg_color = rwmb_meta($prefix.'page_title_bg_color');
    $page_title_bg_color_opacity = rwmb_meta($prefix.'page_title_bg_color_opacity','type=slider') / 100;
    $page_title_bg_color_rgba = g5plus_hex2rgba($page_title_bg_color, $page_title_bg_color_opacity);
    if (!empty($page_title_bg_color_rgba)) {
        $custom_styles[] = 'background-color:' . $page_title_bg_color_rgba;
    }
}

// Custom Page Title Background Image
$page_title_bg_image_url = '';
$enable_custom_page_title_bg_image = rwmb_meta($prefix.'enable_custom_page_title_bg_image');
if ($enable_custom_page_title_bg_image == '1') {
    $page_title_bg_images = rwmb_meta($prefix.'page_title_bg_image','type=image&size=full');
    if ($page_title_bg_images) {
        $page_title_bg_image_id = g5plus_get_post_meta(get_the_ID(),$prefix.'page_title_bg_image',true);
        $page_title_bg_image = $page_title_bg_images[$page_title_bg_image_id];
    }
} else {
    if (is_singular('post')) {
        $page_title_bg_image = isset($g5plus_options['single_blog_title_bg_image']) ? $g5plus_options['single_blog_title_bg_image'] : '';
    } elseif(is_singular('product')) {
        $page_title_bg_image = isset($g5plus_options['single_product_title_bg_image']) ? $g5plus_options['single_product_title_bg_image'] : '';
    }elseif(is_singular('tribe_events')) {
        $page_title_bg_image = isset($g5plus_options['single_event_title_bg_image']) ? $g5plus_options['single_event_title_bg_image'] : '';
    }else {
        $page_title_bg_image = isset($g5plus_options['page_title_bg_image']) ?  $g5plus_options['page_title_bg_image'] : '';
    }

}
if (isset($page_title_bg_image) && isset($page_title_bg_image['url'])) {
    $page_title_bg_image_url = $page_title_bg_image['url'];
}



$custom_style= '';
if ($custom_styles) {
    $custom_style = 'style="'. join(';',$custom_styles).'"';
}


// Page Title Parallax
if (!empty($page_title_bg_image_url)) {
    $page_title_parallax = rwmb_meta($prefix.'page_title_parallax');
    if (!isset($page_title_parallax) || ($page_title_parallax == '') || ($page_title_parallax == '-1')) {
        if (is_singular('post')) {
            $page_title_parallax = isset($g5plus_options['single_blog_title_parallax']) ? $g5plus_options['single_blog_title_parallax'] : '0';
        } elseif(is_singular('product')) {
            $page_title_parallax = isset($g5plus_options['single_product_title_parallax']) ? $g5plus_options['single_product_title_parallax'] : '0';
        }elseif(is_singular('tribe_events')) {
            $page_title_parallax = isset($g5plus_options['single_event_title_parallax']) ? $g5plus_options['single_event_title_parallax'] : '0';
        }else {
            $page_title_parallax = isset($g5plus_options['page_title_parallax']) ? $g5plus_options['page_title_parallax'] : '0';
        }
    }

    if ($page_title_parallax == 1) {
        $page_title_parallax_position = rwmb_meta($prefix.'page_title_parallax_position');
        if (!isset($page_title_parallax_position) || ($page_title_parallax_position == '') || ($page_title_parallax_position == '-1')) {
            if (is_singular('post')) {
                $page_title_parallax_position = isset($g5plus_options['single_blog_title_parallax_position']) ? $g5plus_options['single_blog_title_parallax_position'] : 'center';
            } elseif(is_singular('product')) {
                $page_title_parallax_position = isset($g5plus_options['single_product_title_parallax_position']) ? $g5plus_options['single_product_title_parallax_position'] : 'center';
            }elseif(is_singular('tribe_events')) {
                $page_title_parallax_position = isset($g5plus_options['single_event_title_parallax_position']) ? $g5plus_options['single_event_title_parallax_position'] : 'center';
            }else {
                $page_title_parallax_position = isset($g5plus_options['page_title_parallax_position']) ? $g5plus_options['page_title_parallax_position'] : 'center';
            }
        }
    }
}


// Remove Margin Bottom
$page_title_remove_margin_bottom = rwmb_meta($prefix.'page_title_remove_margin_bottom');
if ($page_title_remove_margin_bottom != '1') {
    if (is_singular('post')) {
        $page_title_wrap_class[] = 'single-blog-title-margin';
    } elseif(is_singular('product')) {
        $page_title_wrap_class[] = 'single-product-title-margin';
    }
    elseif(is_singular('tribe_events')){
        $page_title_wrap_class[] = 'single-event-title-margin';
    } else {
        $page_title_wrap_class[] = 'page-title-margin';
    }

}

// Breadcrumbs
$breadcrumbs_class = array('breadcrumbs-wrap');

?>
<section id="page-title" class="<?php echo join(' ', $page_title_wrap_class); ?>" <?php echo wp_kses_post($custom_style); ?>>
    <?php if (!empty($page_title_bg_image_url)) :?>
        <?php if ($page_title_parallax == 1) : ?>
            <div data-stellar-background-image="<?php echo esc_url($page_title_bg_image_url); ?>" data-stellar-background-position="<?php echo esc_attr($page_title_parallax_position); ?>" data-stellar-background-ratio="0.5" class="page-title-parallax" style="background-image: url('<?php echo esc_url($page_title_bg_image_url); ?>');background-position:center <?php echo esc_attr($page_title_parallax_position); ?>;"></div>
         <?php else: ?>
            <div class="page-title-wrap-bg" style="background-image: url('<?php echo esc_attr($page_title_bg_image_url); ?>');"></div>
         <?php endif; ?>
    <?php endif; ?>
    <div class="container">
        <div class="<?php echo join(' ',$page_title_inner_class); ?>" <?php echo wp_kses_post($custom_inner_style); ?>>
            <div class="m-title">
                <?php if($page_title_style == "pt-bottom"):?>
                    <?php if($post_types =='product'): ?>
                        <h1 class="p-font"><?php esc_html_e('Course','g5plus-academia'); ?></h1>
                    <?php elseif($post_types =='tribe_events'): ?>
                        <h1 class="p-font"><?php esc_html_e('Events','g5plus-academia'); ?></h1>
                    <?php elseif ($post_types != 'page'): ?>
                        <h1 class="p-font"><?php
                            if(!empty($post_types)) {
                                if($post_types == G5PLUS_OURTEACHER_POST_TYPE){
                                    $post_type_slug = get_option('g5plus-academia-' . G5PLUS_OURTEACHER_POST_TYPE . '-config');
                                    if (!isset($post_type_slug) || !is_array($post_type_slug)) {
                                        echo  'Our Teacher';
                                    } else {
                                        echo esc_html($post_type_slug['name']);
                                    }
                                }else{
                                    echo esc_html($post_types);
                                }

                            }else{
                                esc_html_e('Page not found','g5plus-academia');
                            }
                            ?></h1>
                    <?php elseif ($post_types == "page"):?>
                        <h1 class="p-font"><?php echo esc_html($page_title); ?></h1>
                    <?php endif;?>
                <?php endif; if($page_title_style == "pt-center"):?>
                    <h1 class="p-font"><?php echo esc_html($page_title); ?></h1>
                <?php endif;?>
                <?php if ($page_sub_title != '') : ?>
                    <p class="s-font"><?php echo esc_html($page_sub_title) ?></p>
                <?php endif; ?>
            </div>
            <div class="<?php echo join(' ',$breadcrumbs_class); ?>">
                <div class="breadcrumbs-inner text-left">
                    <?php g5plus_the_breadcrumb(); ?>
                </div>
            </div>
        </div>
    </div>
</section>


