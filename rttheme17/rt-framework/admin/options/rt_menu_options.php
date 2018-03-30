<?php
$options = array (
	
	array(
	"name"        => __("Info",'rt_theme_admin'),
	"desc"        => __('Use these options to customize the main navigation menu. You can also find related options for the typography of the menu in <a href="admin.php?page=rt_typography_options">Typography Options</a>. If you would like to revert your changes, delete color value, save options and reload this page.','rt_theme_admin'),
	"type"        => "info"),		
	
	array(
	"name"        => __("MENU ITEM FONT COLORS",'rt_theme_admin'), 
	"type"        => "heading"
	),
	
	array(
	"name"        => __("Custom Menu Font Color - First Level",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_font_color",
	"hr"          => "true",
	"default"     => "#949494",
	"dont_save"   => "true",	 				   
	"type"        => "colorpicker"),

	array(
	"name"        => __("Custom Menu Font Color - First Level (mouse over states)",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_font_color_hover",
	"hr"          => "true",
	"default"     => "#ffffff",
	"dont_save"   => "true",	 				   
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("Custom Menu Font Color - Sub Levels",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_font_sub_color",
	"hr"          => "true",
	"default"     => "#ffffff",
	"dont_save"   => "true",	 
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("Custom Menu Font Color - Sub Levels (mouse hover states)",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_font_color_sub_hover",
	"default"     => "#ffffff",
	"dont_save"   => "true",
	"type"        => "colorpicker"),

	array(
	"name"        => __("MENU ITEM BACKGROUND COLORS",'rt_theme_admin'), 
	"type"        => "heading"
	),

		array(
		 
		"desc"        => __('Use these options to customize; background colors, mouse over states and active menu item states of the menu items. If you have already selected a custom primary color via <a href="admin.php?page=rt_styling_options">Styling Options</a>, theme is going to use the primary color as the menu item\'s background colors until you select a different one by using these fields below. <br />  <br /> ','rt_theme_admin'),
		"hr"          => "true",
		"type"        => "info_text"),	

	array(
	"name"        => __("Custom Menu Background Color - First Level",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_background_color",
	"hr"          => "true",	 				   
	"type"        => "colorpicker"
	),
	
	array(
	"name"        => __("Custom Menu Background Color - Sub Levels",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_sub_background_color",
	"hr"          => "true", 				   
	"type"        => "colorpicker"
	),
);

 
?>