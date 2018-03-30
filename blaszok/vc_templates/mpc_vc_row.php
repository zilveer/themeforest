<?php global $mpc_atts;

$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = '';
extract(shortcode_atts(array(
    'el_class'                => '',
    'bg_image'                => '',
    'bg_color'                => '',
    'bg_image_repeat'         => '',
    'font_color'              => '',
    'padding'                 => '',
    'margin_bottom'           => '',
    'overlay_color'           => '',
    'overlay_color_opacity'   => '',
    'overlay_pattern'         => '',
    'overlay_pattern_opacity' => '',
    'full_width'              => '',
    'full_page_width'         => '',
    'parallax'                => '',
    'bg_image_fb'             => '',
    'bg_image_repeat_fb'      => '',
    'toc_id'                  => '',
    'css_animation'           => '',
    'css'                     => ''
), $mpc_atts));

wp_enqueue_script('wpb_composer_front_js');

if (! empty($bg_image_fb))
    $bg_image = $bg_image_fb;
if (! empty($bg_image_repeat_fb))
    $bg_image_repeat = $bg_image_repeat_fb;

$el_class = $this->getExtraClass($el_class);

// $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . $el_class, $this->settings['base'], $atts);
$css_anim_class = isset( $css_animation ) ? $this->getCSSAnimation($css_animation) : '';

// $style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
$style_wrap = mpcBuildStyle('', $bg_color, '', $font_color, $padding, $margin_bottom);
$style_image = mpcBuildStyle($bg_image, '', $bg_image_repeat);

if ((string)(int)$overlay_color_opacity === $overlay_color_opacity)
    $overlay_color_opacity = max(min($overlay_color_opacity, 100), 0);
else
    $overlay_color_opacity = 1;

if ((string)(int)$overlay_pattern_opacity === $overlay_pattern_opacity)
    $overlay_pattern_opacity = max(min($overlay_pattern_opacity, 100), 0);
else
    $overlay_pattern_opacity = 1;

$output .= '<div '.($toc_id != '' ? 'id="'.$toc_id.'"' : '').' class="mpcth-vc-row-wrap '.
    ($full_width ? ' mpcth-vc-row-wrap-full-width ' : '').
    ($full_page_width ? ' mpcth-vc-row-wrap-full-page-width ' : '').
    ($parallax ? ' mpcth-vc-row-wrap-parallax ' : '').
    ($bg_image ? ' mpcth-vc-row-wrap-image ' : '').
    ($bg_color ? ' mpcth-vc-row-wrap-color ' : '').
    ($overlay_pattern || $overlay_color ? ' mpcth-vc-row-wrap-overlay ' : '').
    $css_anim_class.vc_shortcode_custom_css_class($css, ' ').'"'.$style_wrap.'>';
    // $css_anim_class.'"'.$style_wrap.'>';
    if ($bg_image)
        $output .= '<div class="mpcth-overlay mpcth-overlay-image" '.$style_image.'></div>';
    if ($overlay_pattern)
        $output .= '<div class="mpcth-overlay mpcth-overlay-pattern" style="background-image: url(' . wp_get_attachment_url($overlay_pattern) . '); opacity: ' . ($overlay_pattern_opacity / 100) . '; filter: alpha(opacity=' . $overlay_pattern_opacity . ');"></div>';
    if ($overlay_color)
        $output .= '<div class="mpcth-overlay mpcth-overlay-color" style="background-color: ' . $overlay_color . '; opacity: ' . ($overlay_color_opacity / 100) . '; filter: alpha(opacity=' . $overlay_color_opacity . ');"></div>';
    $output .= '<div class="'.$css_class.'">';
    $output .= wpb_js_remove_wpautop($content);
    $output .= '</div>'.$this->endBlockComment('row');
    if ($bg_image)
    	$output .= '<div class="mpcth-vc-row-wrap-arrow"></div>';
$output .= '</div>';

echo $output;