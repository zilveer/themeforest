<?php
/**
 *  Header section for Blog pages
 *  ( Single post, Post List, Archives, Blog Template)
 */
use \Handyman\Front as F;

// Get options

$tl_archive_bg_color = F\tl_copt('header-archive-bg-color');
$tl_archive_bg_color = ($tl_archive_bg_color != '') ? $tl_archive_bg_color : '';

$tl_archive_bg_image = (int) F\tl_copt('header-archive-bg-image');
$tl_archive_height   = (int) F\tl_copt('header-archive-height', 0);

if(function_exists('layers_inline_styles')){

    $tl_params = array('min-height' => '200px');
    if($tl_archive_height > 0){
        $tl_params['height'] = $tl_archive_height . 'px';
    }

    layers_inline_styles('.static-header-image .overlay', array('css'=> $tl_params));
}

$tl_archive_teaser_title   = F\tl_copt('header-archive-teaser-title');
$tl_archive_teaser_excerpt = F\tl_copt('header-archive-teaser-excerpt');

$tl_archive_teaser_size = F\tl_copt('header-archive-teaser-size');


$featured = F\tl_page_header_image(0, $tl_archive_bg_image);
$bg_style = F\tl_render_inline_css(array('background'      => esc_attr($tl_archive_bg_color) . " url('" . esc_url($featured) . "') no-repeat center center",
                                    'background-size' => 'cover'));

$tl_archive_bg_darken = (F\tl_copt('header-archive-bg-darken') == 1) ? ($featured ? 'darken' : '') : '';

?>
<section class="slide swiper-container single-slide static-header-image">
    <div class="swiper-wrapper">
        <div class="swiper-slide invert has-image image-top text-center" <?php echo $bg_style; ?>>
            <div class="overlay content <?php echo esc_attr($tl_archive_bg_darken) ?>">
                <div class="copy-container-wrapper clearfix <?php echo ($tl_archive_height > 400) ? 'vertical-align' : '' ?>">
                    <div class="copy-container">
                    <?php if($tl_archive_teaser_title || $tl_archive_teaser_excerpt) : ?>
                        <div class="section-title <?php echo esc_attr($tl_archive_teaser_size) ?>">
                            <h3 class="heading"><?php echo esc_html($tl_archive_teaser_title) ?></h3>
                            <div class="excerpt">
                                <p><?php echo esc_html($tl_archive_teaser_excerpt) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div> <!-- .overlay -->
        </div>
    </div>
</section>
<?php if(!layers_get_theme_mod('header-show-primary-navigation', false)):?>
<div class="widget widget_nav_menu">
        <?php wp_nav_menu(array('theme_location' => LAYERS_THEME_SLUG . '-primary',
                           'menu_class'     => 'menu',
                           'fallback_cb' => '\Handyman\Front\tl_layers_menu_fallback')) ?>
</div>
<?php endif;?>