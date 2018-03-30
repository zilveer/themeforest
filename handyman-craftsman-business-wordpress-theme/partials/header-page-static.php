<?php
use Handyman\Front as F;
use Handyman\Extras as E;

$header_title    = E\get_metadata($post->ID, '_tl_item_title');
$header_subtitle = E\get_metadata($post->ID, '_tl_item_subtitle');
$header_title    = isset($header_title)    ?  $header_title : '';
$header_subtitle = isset($header_subtitle) ?  $header_subtitle : '';

$teaser_size   = E\get_metadata($post->ID, '_tl_teaser_size', 'medium');
$header_height = (int) E\get_metadata($post->ID, '_tl_header_height', 0);
$header_bg_color = E\get_metadata($post->ID, '_tl_item_header_color', '#191e23');

$featured = F\tl_page_header_image($post->ID);
$bg_style = F\tl_render_inline_css(array('background'      => esc_attr($header_bg_color) . " url('" . esc_url($featured) . "') no-repeat center center",
                                    'background-size' => 'cover'));

$darker = E\get_metadata($post->ID, '_tl_darken_cb');
$darker = (isset($darker) && $darker != '0') ? ($featured ? 'darken' : '') : '';

if(function_exists('layers_inline_styles')){

    $tl_params = array('min-height' => '200px');
    if($header_height > 0){
        $tl_params['height'] = $header_height . 'px';
    }
    layers_inline_styles('.static-header-image .overlay', array('css' => $tl_params));
}
?>

<section class="slide swiper-container single-slide static-header-image cc-home-main-slider">

    <div class="swiper-wrapper">
        <div class="swiper-slide invert has-image image-top text-center" <?php echo $bg_style; ?>>

            <div class="overlay content <?php echo esc_attr($darker) ?>">

                <div class="copy-container-wrapper clearfix <?php echo ($header_height > 400) ? 'vertical-align' : '' ?>">
                    <div class="copy-container">
                    <?php if($header_title || $header_subtitle) : ?>
                        <div class="section-title <?php echo esc_attr($teaser_size) ?>">
                            <h3 class="heading"><?php echo esc_html($header_title); ?></h3>
                            <div class="excerpt">
                                <p><?php echo esc_html($header_subtitle) ?></p>
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
                            'menu_class'    => 'menu',
                            'fallback_cb' => '\Handyman\Front\tl_layers_menu_fallback'))
        ?>
</div>
<?php endif;?>