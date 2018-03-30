<?php
/**
 * Theme Config
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
global $default_background, $pages_rel;

$default_background = newidea_get_options_key('home-default-background');
$mobile_background	= newidea_get_options_key('home-mobile-background');
$background_overlay = newidea_get_background_overlay();

?>
<!-- THEME background & color data -->
<input id="default_url" type="hidden" value="<?php echo get_template_directory_uri(); ?>" />
<input id="default_title" type="hidden" value="<?php echo get_bloginfo('name') . '-' . get_bloginfo('description'); ?>" />

<input id="default_background" type="hidden" value="<?php echo $default_background; ?>" />
<input id="mobile_background" type="hidden" value="<?php echo $mobile_background; ?>" />

<input id="background_overlay" type="hidden" value="<?php echo $background_overlay[0]; ?>" />
<input id="background_overlay_alpha" type="hidden" value="<?php echo $background_overlay[1]; ?>" />
<input id="theme_color" type="hidden" value="<?php echo newidea_get_options_key('theme-color').':'.newidea_get_options_key('theme-bg-color'); ?>" />