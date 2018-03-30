// Porto Config Less File
// Created at <?php echo date("Y-m-d H:i:s") ?>

<?php
$b = porto_check_theme_options();
$dark = $b['css-type'] == 'dark'
?>

@dark: <?php echo $dark ? '1' : '0' ?>;

// Border radius
<?php if ($b['border-radius']) : ?>
    @border_base: 4px;
    @border_medium: 6px;
<?php else : ?>
    @border_base: 0;
    @border_medium: 0;
<?php endif ?>

// Button Style
@button_style_borders: <?php echo porto_get_button_style() == 'btn-borders' ? '1' : '0' ?>;
@button_style_3d: <?php echo porto_get_button_style() == 'btn-3d' ? '1' : '0' ?>;

// Skin
@skinColor: <?php echo $b['skin-color'] ?>;
@container_width: <?php echo $b['container-width'] ?>px;
@grid_gutter_width: <?php echo $b['grid-gutter-width'] ?>px;
@screen_large: <?php echo $b['container-width'] + ($b['grid-gutter-width'] - 1) ?>px;

// Color Variables
@color-primary: @skinColor;
@color-primary-inverse: <?php echo $b['skin-color-inverse'] ?>;

@color-secondary: <?php echo $b['secondary-color'] ?>;
@color-secondary-inverse: <?php echo $b['secondary-color-inverse'] ?>;

@color-tertiary: <?php echo $b['tertiary-color'] ?>;
@color-tertiary-inverse: <?php echo $b['tertiary-color-inverse'] ?>;

@color-quaternary: <?php echo $b['quaternary-color'] ?>;
@color-quaternary-inverse: <?php echo $b['quaternary-color-inverse'] ?>;

@color-dark: <?php echo $b['dark-color'] ?>;
@color-dark-inverse: <?php echo $b['dark-color-inverse'] ?>;

@color-light: <?php echo $b['light-color'] ?>;
@color-light-inverse: <?php echo $b['light-color-inverse'] ?>;

@social-color: <?php echo $b['social-color'] ? '1' : '0' ?>;

// Typography
@body_font_family: <?php echo $b['body-font']['font-family'] ?>;
@body_font_weight: <?php echo $b['body-font']['font-weight'] ?>;
@body_font_size: <?php echo $b['body-font']['font-size'] ?>;
@body_line_height: <?php echo $b['body-font']['line-height'] ?>;
@body_color: <?php echo $b['body-font']['color'] ?>;

@body_mobile_font_size_scale: <?php echo ((float)$b['body-font']['font-size'] == 0 || (float)$b['body-mobile-font']['font-size'] == 0) ? 1 : ((float)$b['body-mobile-font']['font-size'] / (float)$b['body-font']['font-size']) ?>;
@body_mobile_line_height_scale: <?php echo ((float)$b['body-font']['line-height'] == 0 || (float)$b['body-mobile-font']['line-height'] == 0) ? 1 : ((float)$b['body-mobile-font']['line-height'] / (float)$b['body-font']['line-height']) ?>;

@alt_font_family: <?php echo $b['alt-font']['font-family'] ?>;
@alt_font_weight: <?php echo $b['alt-font']['font-weight'] ?>;

@h1_font_family: <?php echo $b['h1-font']['font-family'] ?>;
@h1_font_weight: <?php echo $b['h1-font']['font-weight'] ?>;
@h1_font_size: <?php echo $b['h1-font']['font-size'] ?>;
@h1_line_height: <?php echo $b['h1-font']['line-height'] ?>;
@h1_color: <?php echo $b['h1-font']['color'] ?>;

@h2_font_family: <?php echo $b['h2-font']['font-family'] ?>;
@h2_font_weight: <?php echo $b['h2-font']['font-weight'] ?>;
@h2_font_size: <?php echo $b['h2-font']['font-size'] ?>;
@h2_line_height: <?php echo $b['h2-font']['line-height'] ?>;
@h2_color: <?php echo $b['h2-font']['color'] ?>;

@h3_font_family: <?php echo $b['h3-font']['font-family'] ?>;
@h3_font_weight: <?php echo $b['h3-font']['font-weight'] ?>;
@h3_font_size: <?php echo $b['h3-font']['font-size'] ?>;
@h3_line_height: <?php echo $b['h3-font']['line-height'] ?>;
@h3_color: <?php echo $b['h3-font']['color'] ?>;

@h4_font_family: <?php echo $b['h4-font']['font-family'] ?>;
@h4_font_weight: <?php echo $b['h4-font']['font-weight'] ?>;
@h4_font_size: <?php echo $b['h4-font']['font-size'] ?>;
@h4_line_height: <?php echo $b['h4-font']['line-height'] ?>;
@h4_color: <?php echo $b['h4-font']['color'] ?>;

@h5_font_family: <?php echo $b['h5-font']['font-family'] ?>;
@h5_font_weight: <?php echo $b['h5-font']['font-weight'] ?>;
@h5_font_size: <?php echo $b['h5-font']['font-size'] ?>;
@h5_line_height: <?php echo $b['h5-font']['line-height'] ?>;
@h5_color: <?php echo $b['h5-font']['color'] ?>;

@h6_font_family: <?php echo $b['h6-font']['font-family'] ?>;
@h6_font_weight: <?php echo $b['h6-font']['font-weight'] ?>;
@h6_font_size: <?php echo $b['h6-font']['font-size'] ?>;
@h6_line_height: <?php echo $b['h6-font']['line-height'] ?>;
@h6_color: <?php echo $b['h6-font']['color'] ?>;

@menu_font_family: <?php echo $b['menu-font']['font-family'] ?>;
@menu_font_weight: <?php echo $b['menu-font']['font-weight'] ?>;
@menu_font_size: <?php echo $b['menu-font']['font-size'] ?>;
@menu_line_height: <?php echo $b['menu-font']['line-height'] ?>;
@menu_md_font_size: <?php echo $b['menu-font-md']['font-size'] ?>;
@menu_md_line_height: <?php echo $b['menu-font-md']['line-height'] ?>;
@menu_text_transform: <?php echo $b['menu-text-transform'] ?>;

@menu_side_font_family: <?php echo $b['menu-side-font']['font-family'] ?>;
@menu_side_font_weight: <?php echo $b['menu-side-font']['font-weight'] ?>;
@menu_side_font_size: <?php echo $b['menu-side-font']['font-size'] ?>;
@menu_side_line_height: <?php echo $b['menu-side-font']['line-height'] ?>;

@menu_popup_font_family: <?php echo $b['menu-popup-font']['font-family'] ?>;
@menu_popup_font_weight: <?php echo $b['menu-popup-font']['font-weight'] ?>;
@menu_popup_font_size: <?php echo $b['menu-popup-font']['font-size'] ?>;
@menu_popup_line_height: <?php echo $b['menu-popup-font']['line-height'] ?>;

// Backgrounds
@body_bg_color: <?php echo $b['body-bg']['background-color'] ?>;
@body_bg_repeat: <?php echo $b['body-bg']['background-repeat'] ?>;
@body_bg_size: <?php echo $b['body-bg']['background-size'] ?>;
@body_bg_attachment: <?php echo $b['body-bg']['background-attachment'] ?>;
@body_bg_position: <?php echo $b['body-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['body-bg']['background-image'])
?>
@body_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['body-bg-gradient'] && $b['body-bg-gcolor']['from'] && $b['body-bg-gcolor']['to']) : ?>
    @body_bg_gradient: true;
    @body_bg_from: <?php echo $b['body-bg-gcolor']['from'] ?>;
    @body_bg_to: <?php echo $b['body-bg-gcolor']['to'] ?>;
<?php else : ?>
    @body_bg_gradient: false;
    @body_bg_from: <?php echo $b['body-bg']['background-color'] ?>;
    @body_bg_to: <?php echo $b['body-bg']['background-color'] ?>;
<?php endif ?>

@content_bg_color: <?php echo $b['content-bg']['background-color'] ?>;
@content_bg_repeat: <?php echo $b['content-bg']['background-repeat'] ?>;
@content_bg_size: <?php echo $b['content-bg']['background-size'] ?>;
@content_bg_attachment: <?php echo $b['content-bg']['background-attachment'] ?>;
@content_bg_position: <?php echo $b['content-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['content-bg']['background-image'])
?>
@content_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['content-bg-gradient'] && $b['content-bg-gcolor']['from'] && $b['content-bg-gcolor']['to']) : ?>
    @content_bg_gradient: true;
    @content_bg_from: <?php echo $b['content-bg-gcolor']['from'] ?>;
    @content_bg_to: <?php echo $b['content-bg-gcolor']['to'] ?>;
<?php else : ?>
    @content_bg_gradient: false;
    @content_bg_from: <?php echo $b['content-bg']['background-color'] ?>;
    @content_bg_to: <?php echo $b['content-bg']['background-color'] ?>;
<?php endif ?>

@content_bottom_bg_color: <?php echo $b['content-bottom-bg']['background-color'] ?>;
@content_bottom_bg_repeat: <?php echo $b['content-bottom-bg']['background-repeat'] ?>;
@content_bottom_bg_size: <?php echo $b['content-bottom-bg']['background-size'] ?>;
@content_bottom_bg_attachment: <?php echo $b['content-bottom-bg']['background-attachment'] ?>;
@content_bottom_bg_position: <?php echo $b['content-bottom-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['content-bottom-bg']['background-image'])
?>
@content_bottom_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['content-bg-gradient'] && $b['content-bottom-bg-gcolor']['from'] && $b['content-bottom-bg-gcolor']['to']) : ?>
    @content_bottom_bg_gradient: true;
    @content_bottom_bg_from: <?php echo $b['content-bottom-bg-gcolor']['from'] ?>;
    @content_bottom_bg_to: <?php echo $b['content-bottom-bg-gcolor']['to'] ?>;
<?php else : ?>
    @content_bottom_bg_gradient: false;
    @content_bottom_bg_from: <?php echo $b['content-bottom-bg']['background-color'] ?>;
    @content_bottom_bg_to: <?php echo $b['content-bottom-bg']['background-color'] ?>;
<?php endif ?>

@content_bottom_padding_top: <?php echo porto_config_value($b['content-bottom-padding']['padding-top']) ?>px;
@content_bottom_padding_bottom: <?php echo porto_config_value($b['content-bottom-padding']['padding-bottom']) ?>px;

// Mobile Panel

@panel_bg_color: <?php echo $b['panel-bg-color'] ?>;
@panel_text_color: <?php echo $b['panel-text-color'] ?>;
@panel_link_color: <?php echo $b['panel-link-color']['regular'] ?>;
@panel_hover_color: <?php echo $b['panel-link-color']['hover'] ?>;

// Header Top
@header_top_bg_color: <?php echo $b['header-top-bg-color'] ?>;
@header_top_text_color: <?php echo $b['header-top-text-color'] ?>;
@header_top_link_color: <?php echo $b['header-top-link-color']['regular'] ?>;
@header_top_hover_color: <?php echo $b['header-top-link-color']['hover'] ?>;
@header_top_bottom_border_width: <?php echo $b['header-top-bottom-border']['border-top'] ?>;
@header_top_bottom_border_color: <?php echo $b['header-top-bottom-border']['border-color'] ?>;

// Header
@header_border_top_width: <?php echo $b['header-top-border']['border-top'] ?>;
@header_border_top_color: <?php echo $b['header-top-border']['border-color'] ?>;
@header_margin_top: <?php echo porto_config_value($b['header-margin']['margin-top']) ?>px;
@header_margin_bottom: <?php echo porto_config_value($b['header-margin']['margin-bottom']) ?>px;
<?php if (is_rtl()) : ?>
@header_margin_left: <?php echo porto_config_value($b['header-margin']['margin-right']) ?>px;
@header_margin_right: <?php echo porto_config_value($b['header-margin']['margin-left']) ?>px;
<?php else : ?>
@header_margin_right: <?php echo porto_config_value($b['header-margin']['margin-right']) ?>px;
@header_margin_left: <?php echo porto_config_value($b['header-margin']['margin-left']) ?>px;
<?php endif; ?>

@header_wrap_bg_color: <?php echo $b['header-wrap-bg']['background-color'] ?>;
@header_wrap_bg_repeat: <?php echo $b['header-wrap-bg']['background-repeat'] ?>;
@header_wrap_bg_size: <?php echo $b['header-wrap-bg']['background-size'] ?>;
@header_wrap_bg_attachment: <?php echo $b['header-wrap-bg']['background-attachment'] ?>;
@header_wrap_bg_position: <?php echo $b['header-wrap-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['header-wrap-bg']['background-image'])
?>
@header_wrap_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['header-wrap-bg-gradient'] && $b['header-wrap-bg-gcolor']['from'] && $b['header-wrap-bg-gcolor']['to']) : ?>
    @header_wrap_bg_gradient: true;
    @header_wrap_bg_from: <?php echo $b['header-wrap-bg-gcolor']['from'] ?>;
    @header_wrap_bg_to: <?php echo $b['header-wrap-bg-gcolor']['to'] ?>;
<?php else : ?>
    @header_wrap_bg_gradient: false;
    @header_wrap_bg_from: <?php echo $b['header-wrap-bg']['background-color'] ?>;
    @header_wrap_bg_to: <?php echo $b['header-wrap-bg']['background-color'] ?>;
<?php endif ?>

@header_bg_color: <?php echo $b['header-bg']['background-color'] ?>;
@header_bg_repeat: <?php echo $b['header-bg']['background-repeat'] ?>;
@header_bg_size: <?php echo $b['header-bg']['background-size'] ?>;
@header_bg_attachment: <?php echo $b['header-bg']['background-attachment'] ?>;
@header_bg_position: <?php echo $b['header-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['header-bg']['background-image'])
?>
@header_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['header-bg-gradient'] && $b['header-bg-gcolor']['from'] && $b['header-bg-gcolor']['to']) : ?>
    @header_bg_gradient: true;
    @header_bg_from: <?php echo $b['header-bg-gcolor']['from'] ?>;
    @header_bg_to: <?php echo $b['header-bg-gcolor']['to'] ?>;
<?php else : ?>
    @header_bg_gradient: false;
    @header_bg_from: <?php echo $b['header-bg']['background-color'] ?>;
    @header_bg_to: <?php echo $b['header-bg']['background-color'] ?>;
<?php endif ?>

@sticky_header_bg_color: <?php echo $b['sticky-header-bg']['background-color'] ?>;
@sticky_header_bg_repeat: <?php echo $b['sticky-header-bg']['background-repeat'] ?>;
@sticky_header_bg_size: <?php echo $b['sticky-header-bg']['background-size'] ?>;
@sticky_header_bg_attachment: <?php echo $b['sticky-header-bg']['background-attachment'] ?>;
@sticky_header_bg_position: <?php echo $b['sticky-header-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['sticky-header-bg']['background-image'])
?>
@sticky_header_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['sticky-header-bg-gradient'] && $b['sticky-header-bg-gcolor']['from'] && $b['sticky-header-bg-gcolor']['to']) : ?>
    @sticky_header_bg_gradient: true;
    @sticky_header_bg_from: <?php echo $b['sticky-header-bg-gcolor']['from'] ?>;
    @sticky_header_bg_to: <?php echo $b['sticky-header-bg-gcolor']['to'] ?>;
<?php else : ?>
    @sticky_header_bg_gradient: false;
    @sticky_header_bg_from: <?php echo $b['sticky-header-bg']['background-color'] ?>;
    @sticky_header_bg_to: <?php echo $b['sticky-header-bg']['background-color'] ?>;
<?php endif ?>
@sticky_header_opacity: <?php echo ((int)$b['sticky-header-opacity']) ? (int)$b['sticky-header-opacity'] : 100 ?>%;

@header_text_color: <?php echo $b['header-text-color'] ?>;
@header_link_color: <?php echo $b['header-link-color']['regular'] ?>;
@header_hover_color: <?php echo $b['header-link-color']['hover'] ?>;

@header_opacity: <?php echo ((int)$b['header-opacity']) ? (int)$b['header-opacity'] : 80 ?>%;
@searchform_opacity: <?php echo ((int)$b['searchform-opacity']) ? (int)$b['searchform-opacity'] : 50 ?>%;
@menuwrap_opacity: <?php echo ((int)$b['menuwrap-opacity']) ? (int)$b['menuwrap-opacity'] : 30 ?>%;
@menu_opacity: <?php echo ((int)$b['menu-opacity']) ? (int)$b['menu-opacity'] : 30 ?>%;

// Side Social, Copyright
@side_social_bg_color: <?php echo $b['side-social-bg-color'] ?>;
@side_social_color: <?php echo $b['side-social-color'] ?>;
@side_copyright_color: <?php echo $b['side-copyright-color'] ?>;

// Switcher
@header_switcher_bg_color: <?php echo $b['switcher-bg-color'] ?>;
@header_switcher_hbg_color: <?php echo $b['switcher-hbg-color'] ?>;
@header_switcher_link_color: <?php echo $b['switcher-link-color']['regular'] ?>;
@header_switcher_hover_color: <?php echo $b['switcher-link-color']['hover'] ?>;

// Searchform
@searchform_bg_color: <?php echo $b['searchform-bg-color'] ?>;
@searchform_border_color: <?php echo $b['searchform-border-color'] ?>;
@searchform_popup_border_color: <?php echo $b['searchform-popup-border-color'] ?>;
@searchform_text_color: <?php echo $b['searchform-text-color'] ?>;
@searchform_hover_color: <?php echo $b['searchform-hover-color'] ?>;
@sticky_searchform_popup_border_color: <?php echo $b['sticky-searchform-popup-border-color'] ?>;
@sticky_searchform_toggle_text_color: <?php echo $b['sticky-searchform-toggle-text-color'] ?>;
@sticky_searchform_toggle_hover_color: <?php echo $b['sticky-searchform-toggle-hover-color'] ?>;

// Mini Cart
@minicart_icon_color: <?php echo $b['minicart-icon-color'] ?>;
@minicart_item_color: <?php echo $b['minicart-item-color'] ?>;
@minicart_border_color: <?php echo $b['minicart-border-color'] ?>;
@minicart_bg_color: <?php echo $b['minicart-bg-color'] ?>;
@minicart_popup_border_color: <?php echo $b['minicart-popup-border-color'] ?>;
@sticky_minicart_icon_color: <?php echo $b['sticky-minicart-icon-color'] ?>;
@sticky_minicart_item_color: <?php echo $b['sticky-minicart-item-color'] ?>;
@sticky_minicart_border_color: <?php echo $b['sticky-minicart-border-color'] ?>;
@sticky_minicart_bg_color: <?php echo $b['sticky-minicart-bg-color'] ?>;
@sticky_minicart_popup_border_color: <?php echo $b['sticky-minicart-popup-border-color'] ?>;

// Main Menu
@main_menu_wrapper_bg_color: <?php echo $b['mainmenu-wrap-bg-color'] ?>;
<?php if (is_rtl()) : ?>
@main_menu_wrapper_padding: <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-top']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-left']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-bottom']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-right']) ?>px;
<?php else : ?>
@main_menu_wrapper_padding: <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-top']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-right']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-bottom']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-left']) ?>px;
<?php endif ?>
@main_menu_bg_color: <?php echo $b['mainmenu-bg-color'] ?>;
@main_menu_popup_border: <?php echo $b['mainmenu-popup-border'] ? '1' : '0' ?>;
@main_menu_popup_border_color: <?php echo $b['mainmenu-popup-border-color'] ?>;
@main_menu_popup_bg_color: <?php echo $b['mainmenu-popup-bg-color'] ?>;
@main_menu_popup_heading_color: <?php echo $b['mainmenu-popup-heading-color'] ?>;
@main_menu_popup_link_color: <?php echo $b['mainmenu-popup-text-color']['regular'] ?>;
@main_menu_popup_hover_color: <?php echo $b['mainmenu-popup-text-color']['hover'] ?>;
@main_menu_popup_link_hbg_color: <?php echo $b['mainmenu-popup-text-hbg-color'] ?>;
@main_menu_level1_link_color: <?php echo $b['mainmenu-toplevel-link-color']['regular'] ?>;
@main_menu_level1_hover_color: <?php echo $b['mainmenu-toplevel-link-color']['hover'] ?>;
@main_menu_level1_active_color: <?php echo $b['mainmenu-toplevel-config-active'] ? $b['mainmenu-toplevel-alink-color'] : $b['mainmenu-toplevel-link-color']['hover'] ?>;
@main_menu_level1_hbg_color: <?php echo $b['mainmenu-toplevel-hbg-color'] ?>;
@main_menu_level1_abg_color: <?php echo $b['mainmenu-toplevel-config-active'] ? $b['mainmenu-toplevel-abg-color'] : $b['mainmenu-toplevel-hbg-color'] ?>;
<?php if (is_rtl()) : ?>
@main_menu_level1_padding1_right: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-left']) ?>px;
@main_menu_level1_padding1_left: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-right']) ?>px;
<?php else : ?>
@main_menu_level1_padding1_left: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-left']) ?>px;
@main_menu_level1_padding1_right: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-right']) ?>px;
<?php endif ?>
@main_menu_level1_padding1_top: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-top']) ?>px;
@main_menu_level1_padding1_bottom: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-bottom']) ?>px;
<?php if (is_rtl()) : ?>
@main_menu_level1_padding2_right: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-left']) ?>px;
@main_menu_level1_padding2_left: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-right']) ?>px;
<?php else : ?>
@main_menu_level1_padding2_left: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-left']) ?>px;
@main_menu_level1_padding2_right: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-right']) ?>px;
<?php endif ?>
@main_menu_level1_padding2_top: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-top']) ?>px;
@main_menu_level1_padding2_bottom: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-bottom']) ?>px;
@main_menu_narrow_type: <?php echo isset($b['mainmenu-popup-narrow-type']) && $b['mainmenu-popup-narrow-type'] ? '1' : '0' ?>;
@main_menu_tip_bg_color: <?php echo $b['mainmenu-tip-bg-color'] ?>;
@main_menu_custom_text_color: <?php echo $b['menu-custom-text-color'] ?>;
@main_menu_custom_link_color: <?php echo $b['menu-custom-link']['regular'] ?>;
@main_menu_custom_link_hcolor: <?php echo $b['menu-custom-link']['hover'] ?>;
@sticky_menu_bg_color: <?php if ($b['mainmenu-bg-color'] && $b['mainmenu-bg-color'] != 'transparent') echo $b['mainmenu-bg-color']; else if ($b['mainmenu-wrap-bg-color'] && $b['mainmenu-wrap-bg-color'] != 'transparent') echo $b['mainmenu-wrap-bg-color']; else echo $b['sticky-header-bg']['background-color'] ?>;

// Footer

@footer_bg_color: <?php echo $b['footer-bg']['background-color'] ?>;
@footer_bg_repeat: <?php echo $b['footer-bg']['background-repeat'] ?>;
@footer_bg_size: <?php echo $b['footer-bg']['background-size'] ?>;
@footer_bg_attachment: <?php echo $b['footer-bg']['background-attachment'] ?>;
@footer_bg_position: <?php echo $b['footer-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['footer-bg']['background-image'])
?>
@footer_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['footer-bg-gradient'] && $b['footer-bg-gcolor']['from'] && $b['footer-bg-gcolor']['to']) : ?>
    @footer_bg_gradient: true;
    @footer_bg_from: <?php echo $b['footer-bg-gcolor']['from'] ?>;
    @footer_bg_to: <?php echo $b['footer-bg-gcolor']['to'] ?>;
<?php else : ?>
    @footer_bg_gradient: false;
    @footer_bg_from: <?php echo $b['footer-bg']['background-color'] ?>;
    @footer_bg_to: <?php echo $b['footer-bg']['background-color'] ?>;
<?php endif ?>

@footer_main_bg_color: <?php echo $b['footer-main-bg']['background-color'] ?>;
@footer_main_bg_repeat: <?php echo $b['footer-main-bg']['background-repeat'] ?>;
@footer_main_bg_size: <?php echo $b['footer-main-bg']['background-size'] ?>;
@footer_main_bg_attachment: <?php echo $b['footer-main-bg']['background-attachment'] ?>;
@footer_main_bg_position: <?php echo $b['footer-main-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['footer-main-bg']['background-image'])
?>
@footer_main_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['footer-main-bg-gradient'] && $b['footer-main-bg-gcolor']['from'] && $b['footer-main-bg-gcolor']['to']) : ?>
    @footer_main_bg_gradient: true;
    @footer_main_bg_from: <?php echo $b['footer-main-bg-gcolor']['from'] ?>;
    @footer_main_bg_to: <?php echo $b['footer-main-bg-gcolor']['to'] ?>;
<?php else : ?>
    @footer_main_bg_gradient: false;
    @footer_main_bg_from: <?php echo $b['footer-main-bg']['background-color'] ?>;
    @footer_main_bg_to: <?php echo $b['footer-main-bg']['background-color'] ?>;
<?php endif ?>

@footer_heading_color: <?php echo $b['footer-heading-color'] ?>;
@footer_text_color: <?php echo $b['footer-text-color'] ?>;
@footer_link_color: <?php echo $b['footer-link-color']['regular'] ?>;
@footer_link_hcolor: <?php echo $b['footer-link-color']['hover'] ?>;
@footer_ribbon_bg_color: <?php echo $b['footer-ribbon-bg-color'] ?>;
@footer_ribbon_text_color: <?php echo $b['footer-ribbon-text-color'] ?>;

@footer_top_bg_color: <?php echo $b['footer-top-bg']['background-color'] ?>;
@footer_top_bg_repeat: <?php echo $b['footer-top-bg']['background-repeat'] ?>;
@footer_top_bg_size: <?php echo $b['footer-top-bg']['background-size'] ?>;
@footer_top_bg_attachment: <?php echo $b['footer-top-bg']['background-attachment'] ?>;
@footer_top_bg_position: <?php echo $b['footer-top-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['footer-top-bg']['background-image'])
?>
@footer_top_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['content-bg-gradient'] && $b['footer-top-bg-gcolor']['from'] && $b['footer-top-bg-gcolor']['to']) : ?>
    @footer_top_bg_gradient: true;
    @footer_top_bg_from: <?php echo $b['footer-top-bg-gcolor']['from'] ?>;
    @footer_top_bg_to: <?php echo $b['footer-top-bg-gcolor']['to'] ?>;
<?php else : ?>
    @footer_top_bg_gradient: false;
    @footer_top_bg_from: <?php echo $b['footer-top-bg']['background-color'] ?>;
    @footer_top_bg_to: <?php echo $b['footer-top-bg']['background-color'] ?>;
<?php endif ?>

@footer_top_padding_top: <?php echo porto_config_value($b['footer-top-padding']['padding-top']) ?>px;
@footer_top_padding_bottom: <?php echo porto_config_value($b['footer-top-padding']['padding-top']) ?>px;

@footer_bottom_bg_color: <?php echo $b['footer-bottom-bg']['background-color'] ?>;
@footer_bottom_bg_repeat: <?php echo $b['footer-bottom-bg']['background-repeat'] ?>;
@footer_bottom_bg_size: <?php echo $b['footer-bottom-bg']['background-size'] ?>;
@footer_bottom_bg_attachment: <?php echo $b['footer-bottom-bg']['background-attachment'] ?>;
@footer_bottom_bg_position: <?php echo $b['footer-bottom-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['footer-bottom-bg']['background-image'])
?>
@footer_bottom_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['footer-bottom-bg-gradient'] && $b['footer-bottom-bg-gcolor']['from'] && $b['footer-bottom-bg-gcolor']['to']) : ?>
    @footer_bottom_bg_gradient: true;
    @footer_bottom_bg_from: <?php echo $b['footer-bottom-bg-gcolor']['from'] ?>;
    @footer_bottom_bg_to: <?php echo $b['footer-bottom-bg-gcolor']['to'] ?>;
<?php else : ?>
    @footer_bottom_bg_gradient: false;
    @footer_bottom_bg_from: <?php echo $b['footer-bottom-bg']['background-color'] ?>;
    @footer_bottom_bg_to: <?php echo $b['footer-bottom-bg']['background-color'] ?>;
<?php endif ?>

@footer_bottom_text_color: <?php echo $b['footer-bottom-text-color'] ?>;
@footer_bottom_link_color: <?php echo $b['footer-bottom-link-color']['regular'] ?>;
@footer_bottom_link_hcolor: <?php echo $b['footer-bottom-link-color']['hover'] ?>;
@footer_opacity: <?php echo ((int)$b['footer-opacity']) ? (int)$b['footer-opacity'] : 80 ?>%;
@footer_social_bg_color: <?php echo $b['footer-social-bg-color'] ?>;
@footer_social_link_color: <?php echo $b['footer-social-link-color'] ?>;

// Breadcrumbs

@breadcrumbs_bg_color: <?php echo $b['breadcrumbs-bg']['background-color'] ?>;
@breadcrumbs_bg_repeat: <?php echo $b['breadcrumbs-bg']['background-repeat'] ?>;
@breadcrumbs_bg_size: <?php echo $b['breadcrumbs-bg']['background-size'] ?>;
@breadcrumbs_bg_attachment: <?php echo $b['breadcrumbs-bg']['background-attachment'] ?>;
@breadcrumbs_bg_position: <?php echo $b['breadcrumbs-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['breadcrumbs-bg']['background-image'])
?>
@breadcrumbs_bg_image: <?php echo $image != 'none'?'url('.esc_url($image).')':$image ?>;

<?php if ($b['breadcrumbs-bg-gradient'] && $b['breadcrumbs-bg-gcolor']['from'] && $b['breadcrumbs-bg-gcolor']['to']) : ?>
    @breadcrumbs_bg_gradient: true;
    @breadcrumbs_bg_from: <?php echo $b['breadcrumbs-bg-gcolor']['from'] ?>;
    @breadcrumbs_bg_to: <?php echo $b['breadcrumbs-bg-gcolor']['to'] ?>;
<?php else : ?>
    @breadcrumbs_bg_gradient: false;
    @breadcrumbs_bg_from: <?php echo $b['breadcrumbs-bg']['background-color'] ?>;
    @breadcrumbs_bg_to: <?php echo $b['breadcrumbs-bg']['background-color'] ?>;
<?php endif ?>

@breadcrumbs_border_top_width: <?php echo $b['breadcrumbs-top-border']['border-top'] ?>;
@breadcrumbs_border_top_color: <?php echo $b['breadcrumbs-top-border']['border-color'] ?>;
@breadcrumbs_border_bottom_width: <?php echo $b['breadcrumbs-bottom-border']['border-top'] ?>;
@breadcrumbs_border_bottom_color: <?php echo $b['breadcrumbs-bottom-border']['border-color'] ?>;
@breadcrumbs_text_color: <?php echo $b['breadcrumbs-text-color'] ?>;
@breadcrumbs_link_color: <?php echo $b['breadcrumbs-link-color'] ?>;
@breadcrumbs_title_color: <?php echo $b['breadcrumbs-title-color'] ?>;
@breadcrumbs_subtitle_color: <?php echo $b['breadcrumbs-subtitle-color'] ?>;
<?php if (is_rtl()) : ?>
@breadcrumbs_padding: <?php echo porto_config_value($b['breadcrumbs-padding']['padding-top']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-left']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-bottom']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-right']) ?>px;
@breadcrumbs_padding_right: <?php echo porto_config_value($b['breadcrumbs-padding']['padding-left']) ?>px;
@breadcrumbs_padding_left: <?php echo porto_config_value($b['breadcrumbs-padding']['padding-right']) ?>px;
<?php else : ?>
@breadcrumbs_padding: <?php echo porto_config_value($b['breadcrumbs-padding']['padding-top']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-right']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-bottom']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-left']) ?>px;
@breadcrumbs_padding_left: <?php echo porto_config_value($b['breadcrumbs-padding']['padding-left']) ?>px;
@breadcrumbs_padding_right: <?php echo porto_config_value($b['breadcrumbs-padding']['padding-right']) ?>px;
<?php endif ?>
<?php if (is_rtl()) : ?>
    @breadcrumbs_subtitle_margin: <?php echo porto_config_value($b['breadcrumbs-subtitle-margin']['margin-top']) ?>px <?php echo porto_config_value($b['breadcrumbs-subtitle-margin']['margin-left']) ?>px <?php echo porto_config_value($b['breadcrumbs-subtitle-margin']['margin-bottom']) ?>px <?php echo porto_config_value($b['breadcrumbs-subtitle-margin']['margin-right']) ?>px;
<?php else : ?>
    @breadcrumbs_subtitle_margin: <?php echo porto_config_value($b['breadcrumbs-subtitle-margin']['margin-top']) ?>px <?php echo porto_config_value($b['breadcrumbs-subtitle-margin']['margin-right']) ?>px <?php echo porto_config_value($b['breadcrumbs-subtitle-margin']['margin-bottom']) ?>px <?php echo porto_config_value($b['breadcrumbs-subtitle-margin']['margin-left']) ?>px;
<?php endif ?>

// Container Width
@calc_banner_width: <?php echo ($b['header-bg']['background-color'] == 'transparent' && $b['header-bg']['background-image'] == 'none') && ($b['content-bg']['background-color'] != 'transparent' || $b['content-bg']['background-image'] != 'none') ? '1' : '0' ?>;
@calc_breadcrumbs_width: <?php echo ($b['header-bg']['background-color'] == 'transparent' && $b['header-bg']['background-image'] == 'none') && ($b['breadcrumbs-bg']['background-color'] != 'transparent' || $b['breadcrumbs-bg']['background-image'] != 'none') ? '1' : '0' ?>;
@calc_content_width: <?php echo ($b['header-bg']['background-color'] == 'transparent' && $b['header-bg']['background-image'] == 'none') && ($b['content-bg']['background-color'] != 'transparent' || $b['content-bg']['background-image'] != 'none') ? '1' : '0' ?>;
@calc_footer_width: <?php echo ($b['header-bg']['background-color'] == 'transparent' && $b['header-bg']['background-image'] == 'none') && ($b['footer-bg']['background-color'] != 'transparent' || $b['footer-bg']['background-image'] != 'none') ? '1' : '0' ?>;

// Shop
@color-wishlist: <?php echo $b['wishlist-color'] ?>;
@color-wishlist-inverse: <?php echo $b['wishlist-color-inverse'] ?>;
@color-quickview: <?php echo $b['quickview-color'] ?>;
@color-quickview-inverse: <?php echo $b['quickview-color-inverse'] ?>;
@color-hot: <?php echo $b['hot-color'] ?>;
@color-hot-inverse: <?php echo $b['hot-color-inverse'] ?>;
@color-sale: <?php echo $b['sale-color'] ?>;
@color-sale-inverse: <?php echo $b['sale-color-inverse'] ?>;