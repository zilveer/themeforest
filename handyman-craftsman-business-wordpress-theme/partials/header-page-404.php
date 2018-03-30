<?php
/**
 *  Header section for Blog pages
 *  ( Single post, Post List, Archives, Blog Template)
 */
use \Handyman\Front as F;

// Get options

$tl_bg_color = F\tl_copt('header-404-bg-color');
$tl_bg_color = ($tl_bg_color != '') ? $tl_bg_color : '';

$tl_bg_image = (int) F\tl_copt('header-404-bg-image');
$tl_height   = (int) F\tl_copt('header-404-height', 0);

if(function_exists('layers_inline_styles')){

    $tl_params = array('min-height' => '200px');
    if($tl_height > 0){
        $tl_params['height'] = esc_attr($tl_height) . 'px';
    }
    layers_inline_styles('.static-header-image .overlay', array('css' => $tl_params));
}

$tl_teaser_size  = F\tl_copt('header-404-teaser-size');

$featured = F\tl_page_header_image(0, $tl_bg_image);
$bg_style = F\tl_render_inline_css(array('background'      => esc_attr($tl_bg_color) . " url('" . esc_url($featured) . "') no-repeat center center",
                                    'background-size' => 'cover'));

$tl_bg_darken = (F\tl_copt('header-404-bg-darken') == 1) ? ($featured ? 'darken' : '') : '';

if(get_post_type() == 'tl_service'){
    $tl_teaser_title = __('OUR SERVICES', TL_DOMAIN);
}elseif(get_post_type() == 'tl_portfolio'){
    $tl_teaser_title = __('OUR WORK', TL_DOMAIN);;
}elseif(get_post_type() == 'tl_testimonial'){
    $tl_teaser_title = __('TESTIMONIALS', TL_DOMAIN);
}elseif(get_post_type() == 'tl_team'){
    $tl_teaser_title = __('OUR TEAM', TL_DOMAIN);
}
?>
<section class="slide swiper-container single-slide static-header-image">
    <div class="swiper-wrapper">
        <div class="swiper-slide invert has-image image-top text-center" <?php echo $bg_style; ?>>
            <div class="overlay content <?php echo esc_attr($tl_bg_darken) ?>">
                <div class="copy-container-wrapper clearfix <?php echo ($tl_height > 400) ? 'vertical-align' : '' ?>">
                    <div class="copy-container">
                    <?php if($tl_teaser_title) : ?>
                        <div class="section-title <?php echo esc_attr($tl_teaser_size) ?>">
                            <h3 class="heading"><?php echo esc_html($tl_teaser_title) ?></h3>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div> <!-- .overlay -->
        </div>
    </div>
</section>
<?php if(!layers_get_theme_mod('header-show-primary-navigation', false)): ?>
<div class="widget widget_nav_menu">
     <?php wp_nav_menu(array('theme_location' => LAYERS_THEME_SLUG . '-primary',
                        'menu_class'     => 'menu',
                        'fallback_cb'    => '\Handyman\Front\tl_layers_menu_fallback'))
     ?>
</div>
<?php endif;?>