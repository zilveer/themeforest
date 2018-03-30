<?php

$google_fonts = des_get_all_google_fonts();
global $wpdb;

$table_name = $wpdb->prefix."revslider_sliders";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    //table is not created. plugin is yet to install.
    //$revs = array();
    $revsliders = array();
} else {
	$revsliders = array();
	$q = "SELECT * from ".$wpdb->prefix."revslider_sliders";
	$revs = $wpdb->get_results($q, ARRAY_A);
	
	if ( $revs ) {
		foreach($revs as $r) {
			array_push($revsliders, array('id'=>"revSlider_".$r['alias'], 'name'=>$r['title']));	
		}
	}	
}
/**
 * Load the patterns into arrays.
 */
$patterns=array();
$patterns[0]='none';
for($i=1; $i<=54; $i++){
	$patterns[]='pattern'.$i.'.jpg';
}

$colors = array('26ade4', '7AB317', 'F15A23', 'd63b33', 'e0aa16', 'FF005A', '9e4d9e', '5a7c96', '10b9b9', '709c3e', '91683d', '3691ad');

$designare_fonts_array = designare_fonts_array_builder();

$designare_styles_options=array( array(
"name" => "Style Editor",
"type" => "title",
"img" => DESIGNARE_IMAGES_URL.'icon_style.png'
),


array(
"type" => "open",
"subtitles"=>array(array("id"=>"general", "name"=>"General"), array("id"=>"body", "name"=>"Body"), array("id"=>"header","name"=>"Header & Top Contents"), array("id"=>"menu", "name" => "Menu"), array("id"=>"pagetitle", "name"=>"Page Title"), array("id"=>"footer", "name"=>"Footer"), array("id"=>"text", "name"=>"Typography"))
),

/* ------------------------------------------------------------------------*
 * GENERAL
 * ------------------------------------------------------------------------*/

array(
	"type" => "subtitle",
	"id" => 'general'
),

array(
	"name" => "General Templater",
	"id" => "des_current_general_template",
	"type" => "text"
),

array(
	"type" => "designareTemplater",
	"value" => "general"
),

array(
	"type" => "documentation",
	"text" => '<h3>Global Style Color</h3>'
),

array(
	"name" => "Suggested Color",
	"id" => DESIGNARE_SHORTNAME."_style_defcolor",
	"type" => "stylecolor",
	"options" => $colors
),

array(
	"name" => "Custom Style Color",
	"id" => DESIGNARE_SHORTNAME."_style_color",
	"type" => "color",
	"std" => "26ade4"
),

array(
	"type" => "close"
),

/* ------------------------------------------------------------------------*
 * BODY
 * ------------------------------------------------------------------------*/

array(
	"type" => "subtitle",
	"id" => 'body'
),

array(
	"name" => "Body Templater",
	"id" => "des_current_body_template",
	"type" => "text"
),

array(
	"type" => "designareTemplater",
	"value" => "body"
),

array(
	"type" => "documentation",
	"text" => '<h3>Body</h3>'
),

array(
	"name" => "Body Layout Type",
	"id" => DESIGNARE_SHORTNAME."_body_layout_type",
	"type" => "select",
	"options" => array(array('id'=>'full', 'name' => 'Full Width'), array('id'=>'boxed','name'=>'Boxed page')),
	"std" => 'full'
),

array(
	"name" => "Body Background Type",
	"id" => DESIGNARE_SHORTNAME."_body_type",
	"type" => "select",
	"options" => array(array('id'=>'image', 'name' => 'Image'), array('id'=>'color','name'=>'Color'), array('id'=>'pattern','name'=>'Pattern'), array('id'=>'custom_pattern','name'=>'Custom Pattern')),
	"std" => 'image',
	'desc' => 'Only available case Boxed Page selected'
),

array(
	"name" => "Image",
	"id" => DESIGNARE_SHORTNAME."_body_image",
	"type" => "upload",
	"desc" => 'Here you can choose the image for your body.'
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_body_color",
	"type" => "color",
	"std" => "C754C7"
),

array(
	"name" => "Pattern",
	"id" => DESIGNARE_SHORTNAME."_body_pattern",
	"type" => "pattern",
	"options" => $patterns,
	"desc" => 'Here you can choose the pattern for your body.'
),

array(
	"name" => "Custom Pattern",
	"id" => DESIGNARE_SHORTNAME."_header_body_pattern",
	"type" => "upload",
	"desc" => 'Here you can choose the custom pattern for your body. It will replace the pattern you choose above.'
),

array(
	"name" => "Body Shadow",
	"id" => DESIGNARE_SHORTNAME."_body_shadow",
	"type" => "checkbox",
	"std" => "on",
	"desc" => 'Set a shadow to the body. Only available on Boxed Layout.'
),

array(
	"name" => "Body Shadow Color",
	"id" => DESIGNARE_SHORTNAME."_body_shadow_color",
	"type" => "color",
	"std" => "666666"
),

array(
	"type" => "documentation",
	"text" => '<h3>Content</h3>'
),

array(
	"name" => "Background Type",
	"id" => DESIGNARE_SHORTNAME."_contentbg_type",
	"type" => "select",
	"options" => array(array('id'=>'color','name'=>'Color'), array('id'=>'image','name'=>'Image'), array('id'=>'pattern','name'=>'Pattern')),
	"std" => 'color'
),

array(
	"name" => "Image",
	"id" => DESIGNARE_SHORTNAME."_contentbg_image",
	"type" => "upload",
	"desc" => 'Here you can choose the image for your footer.'
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_contentbg_color",
	"type" => "color",
	"std" => 'ffffff'
),

array(
	"name" => "Pattern",
	"id" => DESIGNARE_SHORTNAME."_contentbg_pattern",
	"type" => "pattern",
	"options" => $patterns,
	"desc" => 'Here you can choose the pattern for your footer.'
),

array(
	"name" => "Custom Pattern",
	"id" => DESIGNARE_SHORTNAME."_contentbg_custom_pattern",
	"type" => "upload",
	"desc" => 'Here you can choose the custom pattern for your footer. It will replace the pattern you choose above.'
),

array(
	"name" => "Global Borders Color",
	"id" => DESIGNARE_SHORTNAME."_globalborders_bg_color",
	"type" => "color",
	"std" => "ededed"
),

array(
	"type" => "close"
),


/* ------------------------------------------------------------------------*
 * HEADER
 * ------------------------------------------------------------------------*/
array(
	"type" => "subtitle",
	"id" => "header"
),

array(
	"name" => "Header Templater",
	"id" => "des_current_header_template",
	"type" => "text"
),

array(
	"type" => "designareTemplater",
	"value" => "header"
),

array(
	"type" => "documentation",
	"text" => "<h3>Top Panel</h3>"
),

array(
	"name" => "Enable Top Panel",
	"id" => DESIGNARE_SHORTNAME."_enable_top_panel",
	"type" => "checkbox",
	"std" => 'off'
),


array(
	"name" => "Background Type",
	"id" => DESIGNARE_SHORTNAME."_toppanelbg_type",
	"type" => "select",
	"options" => array(array('id'=>'color','name'=>'Color'), array('id'=>'image','name'=>'Image'), array('id'=>'pattern','name'=>'Pattern')),
	"std" => 'color'
),

array(
	"name" => "Image",
	"id" => DESIGNARE_SHORTNAME."_toppanelbg_image",
	"type" => "upload",
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_toppanelbg_color",
	"type" => "color",
	"std" => '545454'
),

array(
	"name" => "Pattern",
	"id" => DESIGNARE_SHORTNAME."_toppanelbg_pattern",
	"type" => "pattern",
	"options" => $patterns,
),

array(
	"name" => "Custom Pattern",
	"id" => DESIGNARE_SHORTNAME."_toppanelbg_custom_pattern",
	"type" => "upload",
	"desc" => 'Here you can choose the custom pattern for your footer. It will replace the pattern you choose above.'
),

array(
	"name" => "Borders Color",
	"id" => DESIGNARE_SHORTNAME."_toppanel_borderscolor",
	"type" => "color",
	"std" => '666666'
),

array(
	"type" => "documentation",
	"text" => '<h5>Top Panel - Text Colors</h5>'
),

array(
	"name" => "Links Color",
	"id" => DESIGNARE_SHORTNAME."_toppanel_linkscolor",
	"type" => "color",
	"std" => '26ade4'
),

array(
	"name" => "Paragraphs Color",
	"id" => DESIGNARE_SHORTNAME."_toppanel_paragraphscolor",
	"type" => "color",
	"std" => 'ededed'
),

array(
	"name" => "Headings Color",
	"id" => DESIGNARE_SHORTNAME."_toppanel_headingscolor",
	"type" => "color",
	"std" => 'ffffff'
),


array(
	"type" => "documentation",
	"text" => "<h3>Top Info Bar</h3>"
),

array(
	"name" => "Enable Top Info Bar",
	"id" => DESIGNARE_SHORTNAME."_info_above_menu",
	"type" => "checkbox",
	"std" => 'on',
	"desc" => "Displays an above menu information container."
),

array(
	"name" => "WPML Widget",
	"id" => DESIGNARE_SHORTNAME."_wpml_menu_widget",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => "Displays the WPML widget if available."
),

array(
	"name" => "WooCommerce Menu",
	"id" => DESIGNARE_SHORTNAME."_woocommerce_menu",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => "Displays the WooCommerce Menu if available."
),

array(
	"name" => "WooCommerce Shopping Cart",
	"id" => DESIGNARE_SHORTNAME."_woocommerce_shopping_cart",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => "Displays the WooCommerce Shopping Cart if available."
),

array(
	"name" => "Display Top Bar Menu",
	"id" => DESIGNARE_SHORTNAME."_top_bar_menu",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => "Displays the Top Bar Menu."
),

array(
	"name" => "Text Color",
	"id" => DESIGNARE_SHORTNAME."_topbar_text_color",
	"type" => "color",
	"std" => "949ba1"
),

array(
	"name" => "Links Color",
	"id" => DESIGNARE_SHORTNAME."_topbar_links_color",
	"type" => "color",
	"std" => "949ba1"
),

array(
	"name" => "Links Hover Color",
	"id" => DESIGNARE_SHORTNAME."_topbar_links_hover_color",
	"type" => "color",
	"std" => "26ade4"
),

array(
	"name" => "Background Color",
	"id" => DESIGNARE_SHORTNAME."_topbar_bg_color",
	"type" => "color",
	"std" => "fdfdfd"
),

array(
	"name" => "Contents Border Color",
	"id" => DESIGNARE_SHORTNAME."_topbarborders_bg_color",
	"type" => "color",
	"std" => "f2f2f2"
),

array(
	"name" => "Social Icons Style",
	"id" => DESIGNARE_SHORTNAME."_social_icons_style",
	"type" => "select",
	"options" => array(array("id"=>"light","name"=>"Light"), array("id"=>"dark","name"=>"Dark")),
	"std" => "Dark"
),

array(
	"type" => "documentation",
	"text" => "<h3>Header</h3>"
),

array(
	"name" => "Background Type",
	"id" => DESIGNARE_SHORTNAME."_headerbg_type",
	"type" => "select",
	"options" => array(array('id'=>'color','name'=>'Color'), array('id'=>'image','name'=>'Image'), array('id'=>'pattern','name'=>'Pattern')),
	"std" => 'color'
),

array(
	"name" => "Image",
	"id" => DESIGNARE_SHORTNAME."_headerbg_image",
	"type" => "upload",
	"desc" => 'Here you can choose the image for your footer.'
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_headerbg_color",
	"type" => "color",
	"std" => 'ffffff'
),

array(
	"name" => "Pattern",
	"id" => DESIGNARE_SHORTNAME."_headerbg_pattern",
	"type" => "pattern",
	"options" => $patterns,
	"desc" => 'Here you can choose the pattern for your footer.'
),

array(
	"name" => "Custom Pattern",
	"id" => DESIGNARE_SHORTNAME."_headerbg_custom_pattern",
	"type" => "upload",
	"desc" => 'Here you can choose the custom pattern for your footer. It will replace the pattern you choose above.'
),

array(
	"name" => "Border Top",
	"id" => DESIGNARE_SHORTNAME."_header_bordertopcolor",
	"type" => "color",
	"std" => '444444'
),

array(
	"name" => "Border Bottom",
	"id" => DESIGNARE_SHORTNAME."_header_borderbottomcolor",
	"type" => "color",
	"std" => 'ededed'
),

array(
	"name" => "Search Border",
	"id" => DESIGNARE_SHORTNAME."_header_bordersearchcolor",
	"type" => "color",
	"std" => 'ededed'
),

array(
	"name" => "Display Header Shadow",
	"id" => DESIGNARE_SHORTNAME."_hide_headershadow",
	"type" => "checkbox",
	"std" => "on"
),

array(
	"name" => "Social Icons Style",
	"id" => DESIGNARE_SHORTNAME."_social_icons_style_four",
	"type" => "select",
	"options" => array(array("id"=>"light","name"=>"Light"), array("id"=>"dark","name"=>"Dark")),
	"std" => "dark"
),

array(
	"type" => "documentation",
	"text" => "<p>This option is only available for Header Type Style 4.</p>"
),

array(
	"type" => "documentation",
	"text" => "<h3>Enable / Disable Search</h3>"
),

array(
	"name" => "Search Widget",
	"id" => DESIGNARE_SHORTNAME."_search_menu_widget",
	"type" => "checkbox",
	"std" => 'on',
	"desc" => "Displays the search widget."
),


array(
	"type" => "close"
),




/* ------------------------------------------------------------------------*
 * MENU OPTIONS
 * ------------------------------------------------------------------------*/

array(
	"type" => "subtitle",
	"id"=>'menu'
),

array(
	"name" => "Menu Templater",
	"id" => "des_current_menu_template",
	"type" => "text"
),

array(
	"type" => "designareTemplater",
	"value" => "menu"
),

array(
	"type" => "documentation",
	"text" => '<h3>Menu Style</h3>'
),

array(
	"name" => "Font",
	"id" => DESIGNARE_SHORTNAME."_menu_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => "Helvetica Neue"
),

array(
	"name" => "Font Size",
	"id" => DESIGNARE_SHORTNAME."_menu_font_size",
	"type" => "slider",
	"std" => "12px",
	"desc" => "Change the size of your menu font."
),

array(
	"name" => "Font Color",
	"id" => DESIGNARE_SHORTNAME."_menu_color",
	"type" => "color",
	"std" => "6E787E"
),

array(
	"name" => "Text Uppercase",
	"id" => DESIGNARE_SHORTNAME."_menu_uppercase",
	"type" => "checkbox",
	"std" => "on"
),

array(
	"name" => "Background Color",
	"id" => DESIGNARE_SHORTNAME."_menu_background_color",
	"type" => "color",
	"std" => "292828"
),

array(
	"type" => "documentation",
	"text" => '<h3>Menu Margins & Paddings</h3>'
),

array(
	"name" => "Menu Side Margin",
	"id" => DESIGNARE_SHORTNAME."_menu_side_margin",
	"type" => "slider",
	"std" => "20px"
),

array(
	"name" => "Big Menu Margin Top",
	"id" => DESIGNARE_SHORTNAME."_big_menu_margin_top",
	"type" => "text",
	"std" => "20px"
),


array(
	"name" => "Big Menu Padding Bottom",
	"id" => DESIGNARE_SHORTNAME."_big_menu_padding_bottom",
	"type" => "text",
	"std" => "38px"
),

array(
	"name" => "Small Menu Margin Top",
	"id" => DESIGNARE_SHORTNAME."_small_menu_margin_top",
	"type" => "text",
	"std" => "0px"
),

array(
	"name" => "Small Menu Padding Bottom",
	"id" => DESIGNARE_SHORTNAME."_small_menu_padding_bottom",
	"type" => "text",
	"std" => "18px"
),

array(
	"type" => "close"
),


/* ------------------------------------------------------------------------*
 * Page Title
 * ------------------------------------------------------------------------*/

array(
	"type" => "subtitle",
	"id" => 'pagetitle'
),

array(
	"name" => "Page Title Templater",
	"id" => "des_current_pagetitle_template",
	"type" => "text"
),

array(
	"type" => "designareTemplater",
	"value" => "pagetitle"
),

array(
	"type" => "documentation",
	"text" => '<h3>Page Title Background</h3>'
),

array(
	"name" => "Background Type",
	"id" => DESIGNARE_SHORTNAME."_header_type",
	"type" => "select",
	"options" => array(array('id'=>'without', 'name'=>'Without Page Title'), array('id'=>'color','name'=>'Color'), array('id'=>'image','name'=>'Image'), array('id'=>'pattern','name'=>'Pattern'), array('id'=>'border','name'=>'Simple Border'), array('id' => 'banner', 'name' => 'Banner Slider')),
	"std" => 'border'
),

array(
	"name" => "Image",
	"id" => DESIGNARE_SHORTNAME."_header_image",
	"type" => "upload",
	"desc" => 'Here you can choose the image for your header.'
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_header_color",
	"type" => "color"
),

array(
	"name" => "Pattern",
	"id" => DESIGNARE_SHORTNAME."_header_pattern",
	"type" => "pattern",
	"options" => $patterns,
	"desc" => 'Here you can choose the pattern for your header.'
),

array(
	"name" => "Custom Pattern",
	"id" => DESIGNARE_SHORTNAME."_header_custom_pattern",
	"type" => "upload",
	"desc" => 'Here you can choose the custom pattern for your header. It will replace the pattern you choose above.'
),

array(
	"name" => "Banner Slider",
	"id" => DESIGNARE_SHORTNAME."_banner_slider",
	"type" => "select",
	"options" => $revsliders
),

array(
	"name" => "Shadow ?",
	"id" => DESIGNARE_SHORTNAME."_page_title_shadow",
	"type" => "checkbox",
	"std" => "off"
),

array(
	"name" => "Shadow Color",
	"id" => DESIGNARE_SHORTNAME."_page_title_shadow_color",
	"type" => "color",
	"std" => "ededed"
),

array(
	"name" => "Height",
	"id"=> DESIGNARE_SHORTNAME."_header_height",
	"type" => "text",
	"std" => "auto",
	"desc" => 'Value for the height must be set in pixels'
),

array(
	"type" => "documentation",
	"text" => '<h3>Primary Title</h3>'
),

array(
	"name" => "Display Title",
	"id" => DESIGNARE_SHORTNAME."_hide_pagetitle",
	"type" => "checkbox",
	"std" => "on"
),

array(
	"name" => "Primary Title Font",
	"id" => DESIGNARE_SHORTNAME."_header_text_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Helvetica Neue'
),

array(
	"name" => "Primary Title Color",
	"id" => DESIGNARE_SHORTNAME."_header_text_color",
	"type" => "color",
	"std" => "26aee4"
),

array(
	"name" => "Primary Title Size",
	"id" => DESIGNARE_SHORTNAME."_header_text_size",
	"type" => "slider",
	"std" => "16px"
),

array(
	"name" => "Primary Title Margin",
	"id" => DESIGNARE_SHORTNAME."_header_text_margin_top",
	"type" => "text",
	"std" => "20px"
),

array(
	"type" => "documentation",
	"text" => '<h3>Secondary Title</h3>'
),

array(
	"name" => "Display Title",
	"id" => DESIGNARE_SHORTNAME."_hide_sec_pagetitle",
	"type" => "checkbox",
	"std" => "on"
),

array(
	"name" => "Secondary Title Font",
	"id" => DESIGNARE_SHORTNAME."_secondary_title_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Helvetica Neue'
),

array(
	"name" => "Secondary Title Text Color",
	"id" => DESIGNARE_SHORTNAME."_secondary_title_text_color",
	"type" => "color",
	"std" => "828282"
),

array(
	"name" => "Secondary Title Text Size",
	"id" => DESIGNARE_SHORTNAME."_secondary_title_text_size",
	"type" => "slider",
	"std" => "12px"
),

array(
	"type" => "documentation",
	"text" => '<h3>Breadcrumbs</h3>'
),

array(
	"name" => "Breadcrumbs Margin",
	"id" => DESIGNARE_SHORTNAME."_breadcrumbs_text_margin_top",
	"type" => "text",
	"std" => "28px"
),

array(
	"name" => "Breadcrumbs",
	"id" => DESIGNARE_SHORTNAME."_breadcrumbs",
	"type" => "checkbox",
	"std" => "on"
),

array(
	"type" => "close"
),


/* ------------------------------------------------------------------------*
 * FOOTER
 * ------------------------------------------------------------------------*/

array(
	"type" => "subtitle",
	"id" => 'footer'
),

array(
	"name" => "Footer Templater",
	"id" => "des_current_footer_template",
	"type" => "text"
),

array(
	"type" => "designareTemplater",
	"value" => "footer"
),

array(
	"type" => "documentation",
	"text" => '<h3>Twitter & Newsletter Section</h3>'
),

array(
	"name" => "Show Twitter & Newsletter Section?",
	"id" => DESIGNARE_SHORTNAME."_show_twitter_newsletter_footer",
	"type" => "checkbox",
	"std" => 'off'
),

array(
	"name" => "Newsletter ?",
	"id" => DESIGNARE_SHORTNAME."_newsletter_enabled",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => "Enables the use and display of the Mail Chimp Subscription Form on Pages."
),

array(
	"name" => "Twitter Scroller ?",
	"id" => DESIGNARE_SHORTNAME."_show_twitter_scroller",
	"type" => "checkbox",
	"std" => 'off'
),

array(
	"name" => "Background Type",
	"id" => DESIGNARE_SHORTNAME."_twitter_newsletter_type",
	"type" => "select",
	"options" => array(array('id'=>'color','name'=>'Color'), array('id'=>'image','name'=>'Image'), array('id'=>'pattern','name'=>'Pattern')),
	"std" => 'image'
),

array(
	"name" => "Image",
	"id" => DESIGNARE_SHORTNAME."_twitter_newsletter_image",
	"type" => "upload",
	"desc" => 'Here you can choose the image for this section.',
	"std" => 'http://placehold.it/1490x450'
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_twitter_newsletter_color",
	"type" => "color",
	"std" => '00364D',
	"desc" => 'Here you can choose the color for this section.'
),

array(
	"name" => "Pattern",
	"id" => DESIGNARE_SHORTNAME."_twitter_newsletter_pattern",
	"type" => "pattern",
	"options" => $patterns,
	"desc" => 'Here you can choose the pattern for this section.'
),

array(
	"name" => "Custom Pattern",
	"id" => DESIGNARE_SHORTNAME."_twitter_newsletter_custom_pattern",
	"type" => "upload",
	"desc" => 'Here you can choose the custom pattern for this section. It will replace the pattern you choose above.'
),

array(
	"name" => "Borders Color",
	"id" => DESIGNARE_SHORTNAME."_twitter_newsletter_borderscolor",
	"type" => "color",
	"std" => '033f57'
),

array(
	"type" => "documentation",
	"text" => '<h3>Primary Footer</h3>'
),

array(
	"name" => "Show Primary Footer?",
	"id" => DESIGNARE_SHORTNAME."_show_primary_footer",
	"type" => "checkbox",
	"std" => 'on'
),

array(
	"name" => "Background Type",
	"id" => DESIGNARE_SHORTNAME."_footerbg_type",
	"type" => "select",
	"options" => array(array('id'=>'color','name'=>'Color'), array('id'=>'image','name'=>'Image'), array('id'=>'pattern','name'=>'Pattern')),
	"std" => 'color'
),

array(
	"name" => "Image",
	"id" => DESIGNARE_SHORTNAME."_footerbg_image",
	"type" => "upload",
	"desc" => 'Here you can choose the image for your footer.'
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_footerbg_color",
	"type" => "color",
	"std" => '033c55'
),

array(
	"name" => "Pattern",
	"id" => DESIGNARE_SHORTNAME."_footerbg_pattern",
	"type" => "pattern",
	"options" => $patterns,
	"desc" => 'Here you can choose the pattern for your footer.'
),

array(
	"name" => "Custom Pattern",
	"id" => DESIGNARE_SHORTNAME."_footerbg_custom_pattern",
	"type" => "upload",
	"desc" => 'Here you can choose the custom pattern for your footer. It will replace the pattern you choose above.'
),

array(
	"name" => "Borders Color",
	"id" => DESIGNARE_SHORTNAME."_footerbg_borderscolor",
	"type" => "color",
	"std" => '0C445C'
),

array(
	"type" => "documentation",
	"text" => '<h3>Primary Footer - Text Colors</h3>'
),

array(
	"name" => "Links Color",
	"id" => DESIGNARE_SHORTNAME."_footerbg_linkscolor",
	"type" => "color",
	"std" => '90b3c2'
),

array(
	"name" => "Paragraphs Color",
	"id" => DESIGNARE_SHORTNAME."_footerbg_paragraphscolor",
	"type" => "color",
	"std" => '6890A2'
),

array(
	"name" => "Headings Color",
	"id" => DESIGNARE_SHORTNAME."_footerbg_headingscolor",
	"type" => "color",
	"std" => 'ffffff'
),

array(
	"type" => "documentation",
	"text" => '<h3>Secondary Footer</h3>'
),

array(
	"name" => "Show Secondary Footer?",
	"id" => DESIGNARE_SHORTNAME."_show_sec_footer",
	"type" => "checkbox",
	"std" => 'on'
),

array(
	"name" => "Background Type",
	"id" => DESIGNARE_SHORTNAME."_sec_footerbg_type",
	"type" => "select",
	"options" => array(array('id'=>'color','name'=>'Color'), array('id'=>'image','name'=>'Image'), array('id'=>'pattern','name'=>'Pattern')),
	"std" => 'color'
),

array(
	"name" => "Image",
	"id" => DESIGNARE_SHORTNAME."_sec_footerbg_image",
	"type" => "upload",
	"desc" => 'Here you can choose the image for your footer.'
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_sec_footerbg_color",
	"type" => "color",
	"std" => 'ffffff'
),

array(
	"name" => "Pattern",
	"id" => DESIGNARE_SHORTNAME."_sec_footerbg_pattern",
	"type" => "pattern",
	"options" => $patterns,
	"desc" => 'Here you can choose the pattern for your footer.'
),

array(
	"name" => "Custom Pattern",
	"id" => DESIGNARE_SHORTNAME."_sec_footerbg_custom_pattern",
	"type" => "upload",
	"desc" => 'Here you can choose the custom pattern for your footer. It will replace the pattern you choose above.'
),

array(
	"name" => "Borders Color",
	"id" => DESIGNARE_SHORTNAME."_sec_footerbg_borderscolor",
	"type" => "color",
	"std" => '193541'
),

array(
	"type" => "documentation",
	"text" => '<h3>Secondary Footer - Text Colors</h3>'
),

array(
	"name" => "Links Color",
	"id" => DESIGNARE_SHORTNAME."_sec_footerbg_linkscolor",
	"type" => "color",
	"std" => '4d6670'
),

array(
	"name" => "Paragraphs Color",
	"id" => DESIGNARE_SHORTNAME."_sec_footerbg_paragraphscolor",
	"type" => "color",
	"std" => '666666'
),

array(
	"type" => "close"
),


/* ------------------------------------------------------------------------*
 * TYPOGRAPHY
 * ------------------------------------------------------------------------*/

array(
	"type" => "subtitle",
	"id"=>'text'
),

array(
	"name" => "Text Templater",
	"id" => "des_current_text_template",
	"type" => "text"
),

array(
	"type" => "designareTemplater",
	"value" => "text"
),

array(
	"type" => "documentation",
	"text" => "<h3>Links</h3>"
),

array(
	"name" => "Font",
	"id" => DESIGNARE_SHORTNAME."_links_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Helvetica'
),

/*
array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_links_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),
*/

array(
	"name" => "Size",
	"id" => DESIGNARE_SHORTNAME."_links_size",
	"type" => "slider",
	"std" => "13px",
	"desc" => "Choose the size of your &lt;a&gt; tag."
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_links_color",
	"type" => "color",
	"desc" => 'Select a custom color for your &lt;a&gt; tag.',
	"std" => "26ade4"
),

array(
	"name" => "Color (hover)",
	"id" => DESIGNARE_SHORTNAME."_links_color_hover",
	"type" => "color",
	"desc" => 'Select a custom color for your &lt;a&gt; tag hover state.',
	"std" => "333333"
),

array(
	"name" => "Background Color (hover)",
	"id" => DESIGNARE_SHORTNAME."_links_bg_color_hover",
	"type" => "color",
	"desc" => 'Select a custom color for the background of your &lt;a&gt; tag hover state.'
),

array(
	"type" => "documentation",
	"text" => "<h3>Paragraphs</h3>"
),

array(
	"name" => "Font",
	"id" => DESIGNARE_SHORTNAME."_p_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Helvetica'
),

/*
array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_p_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),
*/

array(
	"name" => "Size",
	"id" => DESIGNARE_SHORTNAME."_p_size",
	"type" => "slider",
	"std" => "13 px",
	"desc" => "Choose the size of your &lt;p&gt; tag."
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_p_color",
	"type" => "color",
	"desc" => 'Select a custom color for your &lt;p&gt; tag.',
	"std" => "687177"
),

array(
	"type" => "documentation",
	"text" => "<h3>Shortcodes Title</h3>"
),

array(
	"name" => "Font",
	"id" => DESIGNARE_SHORTNAME."_st_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Helvetica Neue'
),

/*
array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_st_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),
*/

array(
	"name" => "Size",
	"id" => DESIGNARE_SHORTNAME."_st_size",
	"type" => "slider",
	"std" => "13 px",
	"desc" => "Choose the size of your &lt;p&gt; tag."
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_st_color",
	"type" => "color",
	"desc" => 'Select a custom color for your &lt;p&gt; tag.',
	"std" => "575757"
),

array(
	"type" => "documentation",
	"text" => "<h3>H1 Tag</h3>"
),


array(
	"name" => "Font",
	"id" => DESIGNARE_SHORTNAME."_h1_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Helvetica Neue'
),

/*
array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_h1_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),
*/

array(
	"name" => "Size",
	"id" => DESIGNARE_SHORTNAME."_h1_size",
	"type" => "slider",
	"std" => "25 px",
	"desc" => "Choose the size of your H1 tag (pixels)."
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_h1_color",
	"type" => "color",
	"desc" => 'Select a custom color for your H1 tag.',
	"std"=> "575757"
),

array(
	"type" => "documentation",
	"text" => "<h3>H2 Tag</h3>"
),

array(
	"name" => "Font",
	"id" => DESIGNARE_SHORTNAME."_h2_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Helvetica Neue'
),

/*
array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_h2_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),
*/

array(
	"name" => "Size",
	"id" => DESIGNARE_SHORTNAME."_h2_size",
	"type" => "slider",
	"std" => "21 px",
	"desc" => "Choose the size of your H2 tag (pixels)."
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_h2_color",
	"type" => "color",
	"desc" => 'Select a custom color for your H2 tag.',
	"std" => "575757"
),

array(
	"type" => "documentation",
	"text" => "<h3>H3 Tag</h3>"
),

array(
	"name" => "Font",
	"id" => DESIGNARE_SHORTNAME."_h3_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Helvetica Neue'
),
/*

array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_h3_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),
*/

array(
	"name" => "Size",
	"id" => DESIGNARE_SHORTNAME."_h3_size",
	"type" => "slider",
	"std" => "24 px",
	"desc" => "Choose the size of your H3 tag (pixels)."
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_h3_color",
	"type" => "color",
	"desc" => 'Select a custom color for your H3 tag.',
	"std" => "444444"
),

array(
	"type" => "documentation",
	"text" => "<h3>H4 Tag</h3>"
),

array(
	"name" => "Font",
	"id" => DESIGNARE_SHORTNAME."_h4_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Helvetica Neue'
),

/*
array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_h4_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),
*/

array(
	"name" => "Size",
	"id" => DESIGNARE_SHORTNAME."_h4_size",
	"type" => "slider",
	"std" => "16 px",
	"desc" => "Choose the size of your H4 tag (pixels)."
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_h4_color",
	"type" => "color",
	"desc" => 'Select a custom color for your H4 tag.',
	"std"=> "575757"
),

array(
	"type" => "documentation",
	"text" => "<h3>H5 Tag</h3>"
),

array(
	"name" => "Font",
	"id" => DESIGNARE_SHORTNAME."_h5_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Helvetica Neue'
),
/*

array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_h5_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),
*/

array(
	"name" => "Size",
	"id" => DESIGNARE_SHORTNAME."_h5_size",
	"type" => "slider",
	"std" => "14 px",
	"desc" => "Choose the size of your H5 tag (pixels)."
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_h5_color",
	"type" => "color",
	"desc" => 'Select a custom color for your H5 tag.',
	"std" => "575757"
),

array(
	"type" => "documentation",
	"text" => "<h3>H6 Tag</h3>"
),

array(
	"name" => "Font",
	"id" => DESIGNARE_SHORTNAME."_h6_font",
	"type" => "select",
	"options" => $designare_fonts_array,
	"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
	"std" => 'Open Sans Light'
),

/*
array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_h6_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),
*/

array(
	"name" => "Size",
	"id" => DESIGNARE_SHORTNAME."_h6_size",
	"type" => "slider",
	"std" => "12 px",
	"desc" => "Choose the size of your H6 tag (pixels)."
),

array(
	"name" => "Color",
	"id" => DESIGNARE_SHORTNAME."_h6_color",
	"type" => "color",
	"desc" => 'Select a custom color for your H6 tag.',
	"std" => "999999"
),

array(
	"type" => "close"
),


array(
	"type" => "close"
)

);

designare_add_options($designare_styles_options);