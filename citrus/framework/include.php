<?php

require_once IAMD_TD.'/framework/social_media.php';
require_once IAMD_TD.'/framework/google_fonts.php';
require_once IAMD_TD.'/framework/theme_features.php';
require_once IAMD_TD.'/framework/admin_utils.php';
require_once IAMD_TD.'/framework/register_admin.php';
require_once IAMD_TD.'/framework/register_public.php';
require_once IAMD_TD.'/framework/register_media_uploader.php';
require_once IAMD_TD.'/framework/utils.php';

require_once IAMD_TD.'/framework/sociable_shortcodes.php';

##Metaboxes
require_once IAMD_TD.'/framework/theme_metaboxes/post_metabox.php';
require_once IAMD_TD.'/framework/theme_metaboxes/page_metabox.php';
require_once IAMD_TD.'/framework/theme_metaboxes/seo_metabox.php';

#TGM Plugins
require_once IAMD_TD.'/framework/class-tgm-plugin-activation.php';
require_once IAMD_TD.'/framework/register_plugins.php';

##Register Widgets
require_once IAMD_TD.'/framework/register_widgets.php';

##Register Widget Areas
require_once IAMD_TD.'/framework/register_widget_areas.php';

##Include Theme options
require_once IAMD_TD.'/framework/theme_options/menu.php';

##MegaMenu
require_once IAMD_TD.'/framework/register_custom_attributes_in_menu.php';

#Woocommerce
if(dttheme_is_plugin_active('woocommerce/woocommerce.php'))
	require_once(IAMD_TD.'/framework/woocommerce/index.php');
	
?>