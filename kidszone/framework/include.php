<?php
$template_uri = get_template_directory().'/framework';

require_once $template_uri.'/social_media.php';
require_once $template_uri.'/google_fonts.php';
require_once $template_uri.'/theme_features.php';
require_once $template_uri.'/utils.php';
require_once $template_uri.'/admin_utils.php';
require_once $template_uri.'/register_admin.php';
require_once $template_uri.'/register_public.php';
require_once $template_uri.'/register_media_uploader.php';

##Metaboxes
require_once $template_uri.'/theme_metaboxes/post_metabox.php';
require_once $template_uri.'/theme_metaboxes/page_metabox.php';
require_once $template_uri.'/theme_metaboxes/seo_metabox.php';

#TGM Plugins
require_once $template_uri.'/class-tgm-plugin-activation.php';
require_once $template_uri.'/register_plugins.php';

##Register Widgets
require_once $template_uri.'/register_widgets.php';

##Register Widget Areas
require_once $template_uri.'/register_widget_areas.php';

##Include Theme options
require_once $template_uri.'/theme_options/menu.php';

##Include Theme shortcodes
require_once $template_uri.'/theme_shortcodes.php';

##Include Shop Woocommerce
if(dt_theme_is_plugin_active('woocommerce/woocommerce.php'))
	require_once($template_uri.'/woocommerce/index.php');
	
##MegaMenu
require_once $template_uri.'/register_custom_attributes_in_menu.php'; ?>