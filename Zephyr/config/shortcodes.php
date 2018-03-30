<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcodes config
 *
 * @var $config array Framework-based shortcodes config
 *
 * @filter us_config_shortcodes
 */

global $us_template_directory;

$config['vc_row']['atts']['columns_type'] = 'medium';
$config['vc_row_inner']['atts']['columns_type'] = 'medium';
$config['us_blog']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_blog.php';
$config['us_btn']['atts']['style'] = 'raised';
$config['us_btn']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_btn.php';
$config['us_cform']['atts']['button_style'] = 'raised';
$config['us_cform']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_cform.php';
$config['us_cta']['atts']['btn_style'] = 'raised';
$config['us_cta']['atts']['btn2_style'] = 'raised';
$config['us_cta']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_cta.php';
$config['us_iconbox']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_iconbox.php';
$config['us_image_slider']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_image_slider.php';
$config['us_logos']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_logos.php';
$config['us_person']['atts']['layout'] = 'card';
$config['us_person']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_person.php';
$config['us_portfolio']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_portfolio.php';
$config['us_pricing']['items_atts']['btn_style'] = 'raised';
$config['us_pricing']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_pricing.php';
$config['us_single_image']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_single_image.php';
$config['us_social_links']['atts']['style'] = 'colored';
$config['us_social_links']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_social_links.php';
$config['us_testimonial']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_testimonial.php';
$config['vc_tta_tabs']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/vc_tta_tabs.php';

unset( $config['us_contacts'] );

return $config;
