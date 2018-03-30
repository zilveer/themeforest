<?php

$woocommercePage = new EdgeAdminPage("19", "WooCommerce", "fa fa-shopping-cart");
$edgtFramework->edgtOptions->addAdminPage("woocommerce",$woocommercePage);

// General
$panel3 = new EdgePanel("General","general_panel");
$woocommercePage->addChild("panel3",$panel3);

$text_input_field_subtitle = new EdgeTitle("text_input_field_subtitle", "Text Input Fields");
$panel3->addChild("text_input_field_subtitle", $text_input_field_subtitle);

$group1 = new EdgeGroup("Text Input Fields Text Style","Define text input fields style in Cart, Checkout, My Account");
$panel3->addChild("group1",$group1);

$row1 = new EdgeRow();
$group1->addChild("row1",$row1);

$woo_input_text_color = new EdgeField("colorsimple","woo_input_text_color","","Text Color","This is some description");
$row1->addChild("woo_input_text_color",$woo_input_text_color);

$woo_input_focus_text_color = new EdgeField("colorsimple","woo_input_focus_text_color","","Focus Text Color","This is some description");
$row1->addChild("woo_input_focus_text_color",$woo_input_focus_text_color);

$group16 = new EdgeGroup("Text Input Fields Background","Define text input fields background");
$panel3->addChild("group16",$group16);

$row1 = new EdgeRow();
$group16->addChild("row1",$row1);

$woo_input_background_color = new EdgeField("colorsimple","woo_input_background_color","","Background Color","This is some description");
$row1->addChild("woo_input_background_color",$woo_input_background_color);

$woo_input_focus_background_color = new EdgeField("colorsimple","woo_input_focus_background_color","","Focus Background Color","This is some description");
$row1->addChild("woo_input_focus_background_color",$woo_input_focus_background_color);


$group17 = new EdgeGroup("Text Input Fields Border","Define text input fields border");
$panel3->addChild("group17",$group17);

$row1 = new EdgeRow();
$group17->addChild("row1",$row1);

$woo_input_border_color = new EdgeField("colorsimple","woo_input_border_color","","Border Color","This is some description");
$row1->addChild("woo_input_border_color",$woo_input_border_color);

$woo_input_focus_border_color = new EdgeField("colorsimple","woo_input_focus_border_color","","Focus Border Color","This is some description");
$row1->addChild("woo_input_focus_border_color",$woo_input_focus_border_color);

$woo_input_border_width = new EdgeField("textsimple","woo_input_border_width","","Border Width (px)","This is some description");
$row1->addChild("woo_input_border_width",$woo_input_border_width);

//Button

$button_all_shop_pages = new EdgeTitle("button_all_shop_pages", "Buttons");
$panel3->addChild("button_all_shop_pages", $button_all_shop_pages);

$group8 = new EdgeGroup("Button Text Style","Define button text style for all shop pages");
$panel3->addChild("group8",$group8);

$row1 = new EdgeRow();
$group8->addChild("row1",$row1);

$woo_products_list_add_to_cart_color = new EdgeField("colorsimple","woo_products_list_add_to_cart_color","","Text Color","This is some description");
$row1->addChild("woo_products_list_add_to_cart_color",$woo_products_list_add_to_cart_color);

$woo_products_list_add_to_cart_font_size = new EdgeField("textsimple","woo_products_list_add_to_cart_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_list_add_to_cart_font_size",$woo_products_list_add_to_cart_font_size);

$woo_products_list_add_to_cart_line_height = new EdgeField("textsimple","woo_products_list_add_to_cart_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_list_add_to_cart_line_height",$woo_products_list_add_to_cart_line_height);

$woo_products_list_add_to_cart_text_transform = new EdgeField("selectblanksimple","woo_products_list_add_to_cart_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_products_list_add_to_cart_text_transform",$woo_products_list_add_to_cart_text_transform);

$row2 = new EdgeRow(true);
$group8->addChild("row2",$row2);

$woo_products_list_add_to_cart_font_family = new EdgeField("Fontsimple","woo_products_list_add_to_cart_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_products_list_add_to_cart_font_family",$woo_products_list_add_to_cart_font_family);

$woo_products_list_add_to_cart_font_style = new EdgeField("selectblanksimple","woo_products_list_add_to_cart_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_products_list_add_to_cart_font_style",$woo_products_list_add_to_cart_font_style);

$woo_products_list_add_to_cart_font_weight = new EdgeField("selectblanksimple","woo_products_list_add_to_cart_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_products_list_add_to_cart_font_weight",$woo_products_list_add_to_cart_font_weight);

$woo_products_list_add_to_cart_letter_spacing = new EdgeField("textsimple","woo_products_list_add_to_cart_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_products_list_add_to_cart_letter_spacing",$woo_products_list_add_to_cart_letter_spacing);

$row3 = new EdgeRow(true);
$group8->addChild("row3",$row3);

$woo_products_list_add_to_cart_hover_color = new EdgeField("colorsimple","woo_products_list_add_to_cart_hover_color","","Hover Text Color","This is some description");
$row3->addChild("woo_products_list_add_to_cart_hover_color",$woo_products_list_add_to_cart_hover_color);

$woo_products_list_add_to_cart_padding = new EdgeField("textsimple","woo_products_list_add_to_cart_padding","","Padding Left/Right (px)","This is some description");
$row3->addChild("woo_products_list_add_to_cart_padding",$woo_products_list_add_to_cart_padding);

$row4 = new EdgeRow(true);
$group8->addChild("row4",$row4);



$group14 = new EdgeGroup("Button Background","Define button background");
$panel3->addChild("group14",$group14);

$row1 = new EdgeRow();
$group14->addChild("row1",$row1);

$woo_products_list_add_to_cart_background_color = new EdgeField("colorsimple","woo_products_list_add_to_cart_background_color","","Background Color","This is some description");
$row1->addChild("woo_products_list_add_to_cart_background_color",$woo_products_list_add_to_cart_background_color);

$woo_products_list_add_to_cart_background_hover_color = new EdgeField("colorsimple","woo_products_list_add_to_cart_background_hover_color","","Hover Background Color","This is some description");
$row1->addChild("woo_products_list_add_to_cart_background_hover_color",$woo_products_list_add_to_cart_background_hover_color);


$group15 = new EdgeGroup("Button Border","Define button border");
$panel3->addChild("group15",$group15);

$row1 = new EdgeRow();
$group15->addChild("row1",$row1);

$woo_products_list_add_to_cart_border_color = new EdgeField("colorsimple","woo_products_list_add_to_cart_border_color","","Border Color","This is some description");
$row1->addChild("woo_products_list_add_to_cart_border_color",$woo_products_list_add_to_cart_border_color);

$woo_products_list_add_to_cart_border_hover_color = new EdgeField("colorsimple","woo_products_list_add_to_cart_border_hover_color","","Border Hover Color","This is some description");
$row1->addChild("woo_products_list_add_to_cart_border_hover_color",$woo_products_list_add_to_cart_border_hover_color);

$woo_products_list_add_to_cart_border_width = new EdgeField("textsimple","woo_products_list_add_to_cart_border_width","","Border Width (px)","This is some description");
$row1->addChild("woo_products_list_add_to_cart_border_width",$woo_products_list_add_to_cart_border_width);

$woo_products_list_add_to_cart_border_radius = new EdgeField("textsimple","woo_products_list_add_to_cart_border_radius","","Border radius (px)","This is some description");
$row1->addChild("woo_products_list_add_to_cart_border_radius",$woo_products_list_add_to_cart_border_radius);

$wocommerce_messages_style_title = new EdgeTitle("wocommerce_messages_style_title", "Message");
$panel3->addChild("wocommerce_messages_style_title", $wocommerce_messages_style_title);

$group9 = new EdgeGroup("Message Box Style","Define message box style for all shop pages");
$panel3->addChild("group9",$group9);

$row1 = new EdgeRow();
$group9->addChild("row1",$row1);

$woo_message_box_text_color = new EdgeField("colorsimple","woo_message_box_text_color","","Text Color","This is some description");
$row1->addChild("woo_message_box_text_color",$woo_message_box_text_color);

$woo_message_box_font_size = new EdgeField("textsimple","woo_message_box_font_size","","Font Size","This is some description");
$row1->addChild("woo_message_box_font_size",$woo_message_box_font_size);

$woo_message_box_background_color = new EdgeField("colorsimple","woo_message_box_background_color","","Background Color","This is some description");
$row1->addChild("woo_message_box_background_color",$woo_message_box_background_color);

$woo_message_box_border_color = new EdgeField("colorsimple","woo_message_box_border_color","","Border Color","This is some description");
$row1->addChild("woo_message_box_border_color",$woo_message_box_border_color);

//Product list styles

$panel1 = new EdgePanel("Product List","product_list_panel");
$woocommercePage->addChild("panel1",$panel1);

//Use full-width template

$woo_products_enable_full_width_template = new EdgeField("yesno","woo_products_enable_full_width_template","no","Enable Full Width Template","Enabling this option will enable full width template for shop page");
$panel1->addChild("woo_products_enable_full_width_template",$woo_products_enable_full_width_template);

//Use full-width template

$woo_products_disable_space_between_products = new EdgeField("yesno","woo_products_disable_space_between_products","no","Disable Space Between Products","Enabling this option will disable space between products");
$panel1->addChild("woo_products_disable_space_between_products",$woo_products_disable_space_between_products);


//Product per page

$woo_products_per_page = new EdgeField("text","woo_products_per_page","","Number Of Product Per Page", "Set number of products on shop page.",array(), array("col_width" => 3));
$panel1->addChild("woo_products_per_page",$woo_products_per_page);

$woo_products_list_margin_top = new EdgeField("text","woo_products_list_margin_top","","Product List Margin Top ", "Set margin top for product list.",array(), array("col_width" => 3));
$panel1->addChild("woo_products_list_margin_top",$woo_products_list_margin_top);


//Products list type

$woo_products_list_type = new EdgeField("select","woo_products_list_type","type1","Product List Style","Choose layout for displaying product listing", array(
	"type1" => "Simple",
	"type2" => "Long Description",
	"type5" => "Info on Hover",
),
	array("dependence" => true,
		  "hide" => array(
			  "type2"=>"#edgtf_woo_products_enable_item_borders_container",
			  "type5"=>"#edgtf_woo_products_enable_item_borders_container"),
		  "show" => array(
			  "type1"=>"#edgtf_woo_products_enable_item_borders_container")
	));
$panel1->addChild("woo_products_list_type",$woo_products_list_type);

$woo_products_enable_item_borders_container = new EdgeContainer("woo_products_enable_item_borders_container","woo_products_list_type","");
$panel1->addChild("woo_products_enable_item_borders_container",$woo_products_enable_item_borders_container);

$woo_products_enable_item_borders = new EdgeField("yesno","woo_products_enable_item_borders","no","Enable Borders Around Item","Enable this option and choose to display borders around item's box or image",array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_woo_products_item_borders_container"));
$woo_products_enable_item_borders_container->addChild("woo_products_enable_item_borders",$woo_products_enable_item_borders);

$woo_products_item_borders_container = new EdgeContainer("woo_products_item_borders_container","woo_products_enable_item_borders","no");
$woo_products_enable_item_borders_container->addChild("woo_products_item_borders_container",$woo_products_item_borders_container);

$woo_products_item_borders_style = new EdgeField("select","woo_products_item_borders_style","around_item","Display Borders Around","Choose to display borders around the item's box or image", array(
	"around_item" => "Item Box",
	"around_image" => "Image"

));
$woo_products_item_borders_container->addChild("woo_products_item_borders_style",$woo_products_item_borders_style);

$woo_products_item_borders_color = new EdgeField("color","woo_products_item_borders_color","","Border Color","Choose a color for the item borders");
$woo_products_item_borders_container->addChild("woo_products_item_borders_color",$woo_products_item_borders_color);

$woo_products_enable_lighbox_icon = new EdgeField("yesno","woo_products_enable_lighbox_icon","yes","Enable Lightbox Icon","Enabling this option will show lighbox icon on product list",array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_woo_products_item_lightbox_icon_container"));
$woo_products_enable_item_borders_container->addChild("woo_products_enable_lighbox_icon",$woo_products_enable_lighbox_icon);

$woo_products_item_lightbox_icon_container = new EdgeContainer("woo_products_item_lightbox_icon_container","woo_products_enable_lighbox_icon","no");
$woo_products_enable_item_borders_container->addChild("woo_products_item_lightbox_icon_container",$woo_products_item_lightbox_icon_container);

$woo_products_lightbox_icon_color = new EdgeField("color","woo_products_lightbox_icon_color","","Lightbox Icon Color","Define color for lightbox icon");
$woo_products_item_lightbox_icon_container->addChild("woo_products_lightbox_icon_color",$woo_products_lightbox_icon_color);

$woo_products_hover_list_type = new EdgeField("select","woo_products_hover_list_type","type1","Product Hover Style","Choose hover style for products in products list", array(
	"hover_type1" => "Add to cart button",
	"hover_type2" => "Add to cart icon"
),
	array("dependence" => true,
		  "hide" => array(
			  "hover_type2"=>"#edgtf_woo_products_enable_button_icons_container"),
		  "show" => array(
			  "hover_type1"=>"#edgtf_woo_products_enable_button_icons_container")
	));
$panel1->addChild("woo_products_hover_list_type",$woo_products_hover_list_type);

$woo_products_enable_button_icons_container = new EdgeContainer("woo_products_enable_button_icons_container","woo_products_hover_list_type","");
$panel1->addChild("woo_products_enable_button_icons_container",$woo_products_enable_button_icons_container);

$woo_products_enable_button_icons = new EdgeField("yesno","woo_products_enable_button_icons","no","Enable Icons in Add to Cart Button","Enabling this option will display icons in Add to Cart button");
$woo_products_enable_button_icons_container->addChild("woo_products_enable_button_icons",$woo_products_enable_button_icons);

$woo_products_list_number = new EdgeField("select","woo_products_list_number","columns-3","Product List and Related Products Columns Number","Choose number of columns for product listing and related products on single product", array(
	"columns-3" => "3 Columns (2 with sidebar)",
	"columns-4" => "4 Columns (3 with sidebar)"
));

$panel1->addChild("woo_products_list_number",$woo_products_list_number);

//Product box
$woo_products_box_text_align = new EdgeField("select","woo_products_box_text_align","left","Product Info Text Alignment","Specify products text alignment in product listing", array(
	"left" => "Left",
	"center" => "Center",
	"right" => "Right"
));
$panel1->addChild("woo_products_box_text_align",$woo_products_box_text_align);

$woo_products_item_info_box_background_color = new EdgeField("color","woo_products_item_info_box_background_color","","Product Info Background Color","Define background color for product info box");
$panel1->addChild("woo_products_item_info_box_background_color",$woo_products_item_info_box_background_color);

$woo_products_item_info_box_padding = new EdgeField("text","woo_products_item_info_box_padding","","Product Info Box Padding","Please insert padding in format (top right bottom left) i.e. 5px 5px 5px 5px", array(), array("col_width" => 3));
$panel1->addChild("woo_products_item_info_box_padding",$woo_products_item_info_box_padding);

$woo_products_item_shader_color = new EdgeField("color","woo_products_item_shader_color","","Shader Background Color","Choose a background color for the shader of hovered item");
$panel1->addChild("woo_products_item_shader_color",$woo_products_item_shader_color);

$woo_products_item_shader_opacity = new EdgeField("text","woo_products_item_shader_opacity","","Shader Background Opacity","Choose a transparency for the shader background color (0 = fully transparent, 1 = opaque)",array(), array("col_width" => 3));
$panel1->addChild("woo_products_item_shader_opacity",$woo_products_item_shader_opacity);

//Product category
$woo_products_category_hide_category = new EdgeField("yesno","woo_products_category_hide_category","no","Hide Product Category","Enabling this option will hide product category.", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf_woo_products_hide_category_container", "dependence_show_on_yes" => ""));
$panel1->addChild("woo_products_category_hide_category",$woo_products_category_hide_category);

$woo_products_hide_category_container = new EdgeContainer("woo_products_hide_category_container","woo_products_category_hide_category","yes");
$panel1->addChild("woo_products_hide_category_container",$woo_products_hide_category_container);

$group2 = new EdgeGroup("Product Category Text Style","Define product category text style");
$woo_products_hide_category_container->addChild("group2",$group2);

$row1 = new EdgeRow();
$group2->addChild("row1",$row1);

$woo_products_category_color = new EdgeField("colorsimple","woo_products_category_color","","Text Color","This is some description");
$row1->addChild("woo_products_category_color",$woo_products_category_color);

$woo_products_category_font_size = new EdgeField("textsimple","woo_products_category_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_category_font_size",$woo_products_category_font_size);

$woo_products_category_line_height = new EdgeField("textsimple","woo_products_category_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_category_line_height",$woo_products_category_line_height);

$woo_products_category_text_transform = new EdgeField("selectblanksimple","woo_products_category_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_products_category_text_transform",$woo_products_category_text_transform);

$row2 = new EdgeRow();
$group2->addChild("row2",$row2);

$woo_products_category_font_family = new EdgeField("Fontsimple","woo_products_category_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_products_category_font_family",$woo_products_category_font_family);

$woo_products_category_font_style = new EdgeField("selectblanksimple","woo_products_category_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_products_category_font_style",$woo_products_category_font_style);

$woo_products_category_font_weight = new EdgeField("selectblanksimple","woo_products_category_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_products_category_font_weight",$woo_products_category_font_weight);

$woo_products_category_letter_spacing = new EdgeField("textsimple","woo_products_category_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_products_category_letter_spacing",$woo_products_category_letter_spacing);


$woo_products_title_separator_hide_title_separator = new EdgeField("yesno","woo_products_title_separator_hide_title_separator","no","Hide Separator in Product Title ","Enabling this option will hide product title separator", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf_woo_products_hide_title_separator_container", "dependence_show_on_yes" => ""));
$panel1->addChild("woo_products_title_separator_hide_title_separator",$woo_products_title_separator_hide_title_separator);

$woo_products_hide_title_separator_container = new EdgeContainer("woo_products_hide_title_separator_container","woo_products_title_separator_hide_title_separator","yes");
$panel1->addChild("woo_products_hide_title_separator_container",$woo_products_hide_title_separator_container);

$group10 = new EdgeGroup("Separator Styles","Define style for product title separator ");
$woo_products_hide_title_separator_container->addChild("group10",$group10);

$row1 = new EdgeRow();
$group10->addChild("row1",$row1);

$woo_products_title_separator_color = new EdgeField("colorsimple","woo_products_title_separator_color","","Color","This is some description");
$row1->addChild("woo_products_title_separator_color",$woo_products_title_separator_color);

$woo_products_title_separator_style = new EdgeField("selectsimple","woo_products_title_separator_style","solid","Style","This is some description",array(
	"solid" => "Solid",
	"dashed" => "Dashed",
	"dotted" => "Dotted"
));
$row1->addChild("woo_products_title_separator_style",$woo_products_title_separator_style);

//Product title

$group3 = new EdgeGroup("Product Title","Define product title text style");
$panel1->addChild("group3",$group3);

$row1 = new EdgeRow();
$group3->addChild("row1",$row1);

$woo_products_title_color = new EdgeField("colorsimple","woo_products_title_color","","Text Color","This is some description");
$row1->addChild("woo_products_title_color",$woo_products_title_color);

$woo_products_title_font_size = new EdgeField("textsimple","woo_products_title_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_title_font_size",$woo_products_title_font_size);

$woo_products_title_line_height = new EdgeField("textsimple","woo_products_title_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_title_line_height",$woo_products_title_line_height);

$woo_products_title_text_transform = new EdgeField("selectblanksimple","woo_products_title_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_products_title_text_transform",$woo_products_title_text_transform);

$row2 = new EdgeRow(true);
$group3->addChild("row2",$row2);

$woo_products_title_font_family = new EdgeField("Fontsimple","woo_products_title_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_products_title_font_family",$woo_products_title_font_family);

$woo_products_title_font_style = new EdgeField("selectblanksimple","woo_products_title_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_products_title_font_style",$woo_products_title_font_style);

$woo_products_title_font_weight = new EdgeField("selectblanksimple","woo_products_title_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_products_title_font_weight",$woo_products_title_font_weight);

$woo_products_title_letter_spacing = new EdgeField("textsimple","woo_products_title_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_products_title_letter_spacing",$woo_products_title_letter_spacing);

$row3 = new EdgeRow(true);
$group3->addChild("row3",$row3);

$woo_products_title_hover_color = new EdgeField("colorsimple","woo_products_title_hover_color","","Hover Text Color","This is some description");
$row3->addChild("woo_products_title_hover_color",$woo_products_title_hover_color);

$woo_products_title_line_margin_bottom = new EdgeField("textsimple","woo_products_title_line_margin_bottom","","Margin Bottom (px)","This is some description");
$row3->addChild("woo_products_title_line_margin_bottom",$woo_products_title_line_margin_bottom);

//Product price

$group4 = new EdgeGroup("Product Price","Define product price text style");
$panel1->addChild("group4",$group4);

$row1 = new EdgeRow();
$group4->addChild("row1",$row1);

$woo_products_price_color = new EdgeField("colorsimple","woo_products_price_color","","Text Color","This is some description");
$row1->addChild("woo_products_price_color",$woo_products_price_color);

$woo_products_price_font_size = new EdgeField("textsimple","woo_products_price_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_price_font_size",$woo_products_price_font_size);

$woo_products_price_line_height = new EdgeField("textsimple","woo_products_price_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_price_line_height",$woo_products_price_line_height);

$woo_products_price_text_transform = new EdgeField("selectblanksimple","woo_products_price_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_products_price_text_transform",$woo_products_price_text_transform);

$row2 = new EdgeRow(true);
$group4->addChild("row2",$row2);

$woo_products_price_font_family = new EdgeField("Fontsimple","woo_products_price_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_products_price_font_family",$woo_products_price_font_family);

$woo_products_price_font_style = new EdgeField("selectblanksimple","woo_products_price_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_products_price_font_style",$woo_products_price_font_style);

$woo_products_price_font_weight = new EdgeField("selectblanksimple","woo_products_price_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_products_price_font_weight",$woo_products_price_font_weight);

$woo_products_price_letter_spacing = new EdgeField("textsimple","woo_products_price_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_products_price_letter_spacing",$woo_products_price_letter_spacing);

$row3 = new EdgeRow(true);
$group4->addChild("row3",$row3);

$woo_products_price_old_font_size = new EdgeField("textsimple","woo_products_price_old_font_size","","Old Price Font Size (px)","This is some description");
$row3->addChild("woo_products_price_old_font_size",$woo_products_price_old_font_size);

$woo_products_price_old_color = new EdgeField("colorsimple","woo_products_price_old_color","","Old Price Color","This is some description");
$row3->addChild("woo_products_price_old_color",$woo_products_price_old_color);

//Product sale

$group5 = new EdgeGroup("Product Sale","Define product sale text style");
$panel1->addChild("group5",$group5);

$row1 = new EdgeRow();
$group5->addChild("row1",$row1);

$woo_products_sale_color = new EdgeField("colorsimple","woo_products_sale_color","","Text Color","This is some description");
$row1->addChild("woo_products_sale_color",$woo_products_sale_color);

$woo_products_sale_font_size = new EdgeField("textsimple","woo_products_sale_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_sale_font_size",$woo_products_sale_font_size);

$woo_products_sale_line_height = new EdgeField("textsimple","woo_products_sale_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_sale_line_height",$woo_products_sale_line_height);

$woo_products_sale_text_transform = new EdgeField("selectblanksimple","woo_products_sale_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_products_sale_text_transform",$woo_products_sale_text_transform);

$row2 = new EdgeRow(true);
$group5->addChild("row2",$row2);

$woo_products_sale_font_family = new EdgeField("Fontsimple","woo_products_sale_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_products_sale_font_family",$woo_products_sale_font_family);

$woo_products_sale_font_style = new EdgeField("selectblanksimple","woo_products_sale_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_products_sale_font_style",$woo_products_sale_font_style);

$woo_products_sale_font_weight = new EdgeField("selectblanksimple","woo_products_sale_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_products_sale_font_weight",$woo_products_sale_font_weight);

$woo_products_sale_letter_spacing = new EdgeField("textsimple","woo_products_sale_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_products_sale_letter_spacing",$woo_products_sale_letter_spacing);

$row3 = new EdgeRow(true);
$group5->addChild("row3",$row3);

$woo_products_sale_background_color = new EdgeField("colorsimple","woo_products_sale_background_color","","Background Color","This is some description");
$row3->addChild("woo_products_sale_background_color",$woo_products_sale_background_color);

$woo_products_sale_border_radius = new EdgeField("textsimple","woo_products_sale_border_radius","","Border Radius (px)","This is some description");
$row3->addChild("woo_products_sale_border_radius",$woo_products_sale_border_radius);

$woo_products_sale_top_position = new EdgeField("textsimple","woo_products_sale_top_position","","Top Position (px)","This is some description");
$row3->addChild("woo_products_sale_top_position",$woo_products_sale_top_position);

$woo_products_sale_left_position = new EdgeField("textsimple","woo_products_sale_left_position","","Left Position (px)","This is some description");
$row3->addChild("woo_products_sale_left_position",$woo_products_sale_left_position);

$row4 = new EdgeRow(true);
$group5->addChild("row4",$row4);

$woo_products_sale_right_position = new EdgeField("textsimple","woo_products_sale_right_position","","Right Position (px)","This is some description");
$row4->addChild("woo_products_sale_right_position",$woo_products_sale_right_position);

$woo_products_sale_width = new EdgeField("textsimple","woo_products_sale_width","","Width (px)","This is some description");
$row4->addChild("woo_products_sale_width",$woo_products_sale_width);

$woo_products_sale_height = new EdgeField("textsimple","woo_products_sale_height","","Height (px)","This is some description");
$row4->addChild("woo_products_sale_height",$woo_products_sale_height);

//Product out of stock

$group6 = new EdgeGroup('Product "Out Of Stock"',"Define 'Out Of Stock' text style");
$panel1->addChild("group6",$group6);

$row1 = new EdgeRow();
$group6->addChild("row1",$row1);

$woo_products_out_of_stock_color = new EdgeField("colorsimple","woo_products_out_of_stock_color","","Text Color","This is some description");
$row1->addChild("woo_products_out_of_stock_color",$woo_products_out_of_stock_color);

$woo_products_out_of_stock_font_size = new EdgeField("textsimple","woo_products_out_of_stock_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_out_of_stock_font_size",$woo_products_out_of_stock_font_size);

$woo_products_out_of_stock_line_height = new EdgeField("textsimple","woo_products_out_of_stock_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_out_of_stock_line_height",$woo_products_out_of_stock_line_height);

$woo_products_out_of_stock_text_transform = new EdgeField("selectblanksimple","woo_products_out_of_stock_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_products_out_of_stock_text_transform",$woo_products_out_of_stock_text_transform);

$row2 = new EdgeRow(true);
$group6->addChild("row2",$row2);

$woo_products_out_of_stock_font_family = new EdgeField("Fontsimple","woo_products_out_of_stock_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_products_out_of_stock_font_family",$woo_products_out_of_stock_font_family);

$woo_products_out_of_stock_font_style = new EdgeField("selectblanksimple","woo_products_out_of_stock_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_products_out_of_stock_font_style",$woo_products_out_of_stock_font_style);

$woo_products_out_of_stock_font_weight = new EdgeField("selectblanksimple","woo_products_out_of_stock_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_products_out_of_stock_font_weight",$woo_products_out_of_stock_font_weight);

$woo_products_out_of_stock_letter_spacing = new EdgeField("textsimple","woo_products_out_of_stock_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_products_out_of_stock_letter_spacing",$woo_products_out_of_stock_letter_spacing);

$row3 = new EdgeRow(true);
$group6->addChild("row3",$row3);

$woo_products_out_of_stock_background_color = new EdgeField("colorsimple","woo_products_out_of_stock_background_color","","Background Color","This is some description");
$row3->addChild("woo_products_out_of_stock_background_color",$woo_products_out_of_stock_background_color);

$woo_products_out_of_stock_border_radius = new EdgeField("textsimple","woo_products_out_of_stock_border_radius","","Border Radius (px)","This is some description");
$row3->addChild("woo_products_out_of_stock_border_radius",$woo_products_out_of_stock_border_radius);

$woo_products_out_of_stock_top_position = new EdgeField("textsimple","woo_products_out_of_stock_top_position","","Top Position (px)","This is some description");
$row3->addChild("woo_products_out_of_stock_top_position",$woo_products_out_of_stock_top_position);

$woo_products_out_of_stock_left_position = new EdgeField("textsimple","woo_products_out_of_stock_left_position","","Left Position (px)","This is some description");
$row3->addChild("woo_products_out_of_stock_left_position",$woo_products_out_of_stock_left_position);

$row4 = new EdgeRow(true);
$group6->addChild("row4",$row4);

$woo_products_out_of_stock_right_position = new EdgeField("textsimple","woo_products_out_of_stock_right_position","","Right Position (px)","This is some description");
$row4->addChild("woo_products_out_of_stock_right_position",$woo_products_out_of_stock_right_position);

$woo_products_out_of_stock_width = new EdgeField("textsimple","woo_products_out_of_stock_width","","Width (px)","This is some description");
$row4->addChild("woo_products_out_of_stock_width",$woo_products_out_of_stock_width);

$woo_products_out_of_stock_height = new EdgeField("textsimple","woo_products_out_of_stock_height","","Height (px)","This is some description");
$row4->addChild("woo_products_out_of_stock_height",$woo_products_out_of_stock_height);

//Pricing Filter

$group9 = new EdgeGroup("Price Filter Colors","Define colors in price filter");
$panel1->addChild("group9",$group9);

$row1 = new EdgeRow();
$group9->addChild("row1",$row1);

$woo_products_price_filter_background_color = new EdgeField("colorsimple","woo_products_price_filter_background_color","","In Price Range","This is some description");
$row1->addChild("woo_products_price_filter_background_color",$woo_products_price_filter_background_color);

$woo_products_price_filter_background_active_color = new EdgeField("colorsimple","woo_products_price_filter_background_active_color","","Out Price Range","This is some description");
$row1->addChild("woo_products_price_filter_background_active_color",$woo_products_price_filter_background_active_color);

$woo_products_price_filter_arrows_color = new EdgeField("colorsimple","woo_products_price_filter_arrows_color","","Handles","This is some description");
$row1->addChild("woo_products_price_filter_arrows_color",$woo_products_price_filter_arrows_color);


$group7 = new EdgeGroup('"Number of Results" Text Style',"Define style for text showing the number of results in product list");
$panel1->addChild("group7",$group7);

$row1 = new EdgeRow();
$group7->addChild("row1",$row1);

$woo_products_sorting_result_color = new EdgeField("colorsimple","woo_products_sorting_result_color","","Text Color","This is some description");
$row1->addChild("woo_products_sorting_result_color",$woo_products_sorting_result_color);

$woo_products_sorting_result_font_size = new EdgeField("textsimple","woo_products_sorting_result_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_sorting_result_font_size",$woo_products_sorting_result_font_size);

$woo_products_sorting_result_line_height = new EdgeField("textsimple","woo_products_sorting_result_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_sorting_result_line_height",$woo_products_sorting_result_line_height);

$woo_products_sorting_result_text_transform = new EdgeField("selectblanksimple","woo_products_sorting_result_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_products_sorting_result_text_transform",$woo_products_sorting_result_text_transform);

$row2 = new EdgeRow(true);
$group7->addChild("row2",$row2);

$woo_products_sorting_result_font_family = new EdgeField("Fontsimple","woo_products_sorting_result_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_products_sorting_result_font_family",$woo_products_sorting_result_font_family);

$woo_products_sorting_result_font_style = new EdgeField("selectblanksimple","woo_products_sorting_result_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_products_sorting_result_font_style",$woo_products_sorting_result_font_style);

$woo_products_sorting_result_font_weight = new EdgeField("selectblanksimple","woo_products_sorting_result_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_products_sorting_result_font_weight",$woo_products_sorting_result_font_weight);

$woo_products_sorting_result_letter_spacing = new EdgeField("textsimple","woo_products_sorting_result_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_products_sorting_result_letter_spacing",$woo_products_sorting_result_letter_spacing);

//Products add to cart button

$products_add_to_cart_subtitle = new EdgeTitle("products_add_to_cart_subtitle", '"Add to cart" button');
$panel1->addChild("products_add_to_cart_subtitle", $products_add_to_cart_subtitle);

$group14 = new EdgeGroup("Button Text Style","Define Add To Cart button text style");
$panel1->addChild("group14",$group14);

$row1 = new EdgeRow();
$group14->addChild("row1",$row1);

$woo_products_add_to_cart_color = new EdgeField("colorsimple","woo_products_add_to_cart_color","","Text Color","This is some description");
$row1->addChild("woo_products_add_to_cart_color",$woo_products_add_to_cart_color);

$woo_products_add_to_cart_hover_color = new EdgeField("colorsimple","woo_products_add_to_cart_hover_color","","Hover Text Color","This is some description");
$row1->addChild("woo_products_add_to_cart_hover_color",$woo_products_add_to_cart_hover_color);

$woo_products_add_to_cart_font_size = new EdgeField("textsimple","woo_products_add_to_cart_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_add_to_cart_font_size",$woo_products_add_to_cart_font_size);

$woo_products_add_to_cart_line_height = new EdgeField("textsimple","woo_products_add_to_cart_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_add_to_cart_line_height",$woo_products_add_to_cart_line_height);

$row2 = new EdgeRow(true);
$group14->addChild("row2",$row2);

$woo_products_add_to_cart_text_transform = new EdgeField("selectblanksimple","woo_products_add_to_cart_text_transform","","Text Transform","This is some description",$options_texttransform);
$row2->addChild("woo_products_add_to_cart_text_transform",$woo_products_add_to_cart_text_transform);

$woo_products_add_to_cart_font_family = new EdgeField("Fontsimple","woo_products_add_to_cart_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_products_add_to_cart_font_family",$woo_products_add_to_cart_font_family);

$woo_products_add_to_cart_font_style = new EdgeField("selectblanksimple","woo_products_add_to_cart_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_products_add_to_cart_font_style",$woo_products_add_to_cart_font_style);

$woo_products_add_to_cart_font_weight = new EdgeField("selectblanksimple","woo_products_add_to_cart_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_products_add_to_cart_font_weight",$woo_products_add_to_cart_font_weight);

$row3 = new EdgeRow(true);
$group14->addChild("row3",$row3);

$woo_products_add_to_cart_letter_spacing = new EdgeField("textsimple","woo_products_add_to_cart_letter_spacing","","Letter Spacing (px)","This is some description");
$row3->addChild("woo_products_add_to_cart_letter_spacing",$woo_products_add_to_cart_letter_spacing);

$group27 = new EdgeGroup('Button Background','Define "Add To Cart" Button Background');
$panel1->addChild("group27",$group27);

$row1 = new EdgeRow();
$group27->addChild("row1",$row1);

$woo_products_add_to_cart_background_color = new EdgeField("colorsimple","woo_products_add_to_cart_background_color","","Background Color","This is some description");
$row1->addChild("woo_products_add_to_cart_background_color",$woo_products_add_to_cart_background_color);

$woo_products_add_to_cart_background_hover_color = new EdgeField("colorsimple","woo_products_add_to_cart_background_hover_color","","Hover Background Color","This is some description");
$row1->addChild("woo_products_add_to_cart_background_hover_color",$woo_products_add_to_cart_background_hover_color);

$group28 = new EdgeGroup('Button Border','Define "Add To Cart" border');
$panel1->addChild("group28",$group28);

$row1 = new EdgeRow();
$group28->addChild("row1",$row1);

$woo_products_add_to_cart_border_color = new EdgeField("colorsimple","woo_products_add_to_cart_border_color","","Border Color","This is some description");
$row1->addChild("woo_products_add_to_cart_border_color",$woo_products_add_to_cart_border_color);

$woo_products_add_to_cart_border_hover_color = new EdgeField("colorsimple","woo_products_add_to_cart_border_hover_color","","Border Hover Color","This is some description");
$row1->addChild("woo_products_add_to_cart_border_hover_color",$woo_products_add_to_cart_border_hover_color);

$woo_products_add_to_cart_border_width = new EdgeField("textsimple","woo_products_add_to_cart_border_width","","Border Width (px)","This is some description");
$row1->addChild("woo_products_add_to_cart_border_width",$woo_products_add_to_cart_border_width);

$woo_products_add_to_cart_border_radius = new EdgeField("textsimple","woo_products_add_to_cart_border_radius","","Border radius (px)","This is some description");
$row1->addChild("woo_products_add_to_cart_border_radius",$woo_products_add_to_cart_border_radius);


//Sorting Product List

$product_sorting = new EdgeTitle("product_sorting", "Product Sorting Select Box");
$panel1->addChild("product_sorting", $product_sorting);

$group8 = new EdgeGroup("Select Box Text Style","Define product sorting text style");
$panel1->addChild("group8",$group8);

$row1 = new EdgeRow();
$group8->addChild("row1",$row1);

$woo_products_sorting_color = new EdgeField("colorsimple","woo_products_sorting_color","","Text Color","This is some description");
$row1->addChild("woo_products_sorting_color",$woo_products_sorting_color);

$woo_products_sorting_hover_color = new EdgeField("colorsimple","woo_products_sorting_hover_color","","Text Hover Color","This is some description");
$row1->addChild("woo_products_sorting_hover_color",$woo_products_sorting_hover_color);



// Sorting Background

$group12 = new EdgeGroup("Select Box Background","Define product sorting select box background");
$panel1->addChild("group12",$group12);

$row1 = new EdgeRow();
$group12->addChild("row1",$row1);

$woo_products_sorting_background_color = new EdgeField("colorsimple","woo_products_sorting_background_color","","Background Color","This is some description");
$row1->addChild("woo_products_sorting_background_color",$woo_products_sorting_background_color);

$woo_products_sorting_dropdown_background_color = new EdgeField("colorsimple","woo_products_sorting_dropdown_background_color","","Dropdown Background Color","This is some description");
$row1->addChild("woo_products_sorting_dropdown_background_color",$woo_products_sorting_dropdown_background_color);

// Sorting Border Style

$group13 = new EdgeGroup("Select Box Border","Define product sorting select box border");
$panel1->addChild("group13",$group13);

$row1 = new EdgeRow();
$group13->addChild("row1",$row1);

$woo_products_sorting_border_color = new EdgeField("colorsimple","woo_products_sorting_border_color","","Border Color","This is some description");
$row1->addChild("woo_products_sorting_border_color",$woo_products_sorting_border_color);

$woo_products_sorting_border_width = new EdgeField("textsimple","woo_products_sorting_border_width","","Box Border Width (px)","This is some description");
$row1->addChild("woo_products_sorting_border_width",$woo_products_sorting_border_width);

//Show Number of Results text


//Product single styles

$panel2 = new EdgePanel("Product Single","product_single_panel");
$woocommercePage->addChild("panel2",$panel2);

//Product single title

$product_text_style= new EdgeTitle("product_text_style", "Product Text Style");
$panel2->addChild("product_text_style", $product_text_style);

$group1 = new EdgeGroup("Product Single Title","Define Product Single Title Style");
$panel2->addChild("group1",$group1);

$row1 = new EdgeRow();
$group1->addChild("row1",$row1);

$woo_product_single_title_color = new EdgeField("colorsimple","woo_product_single_title_color","","Text Color","This is some description");
$row1->addChild("woo_product_single_title_color",$woo_product_single_title_color);

$woo_product_single_title_hover_color = new EdgeField("colorsimple","woo_product_single_title_hover_color","","Hover Text Color","This is some description");
$row1->addChild("woo_product_single_title_hover_color",$woo_product_single_title_hover_color);

$woo_product_single_title_font_size = new EdgeField("textsimple","woo_product_single_title_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_product_single_title_font_size",$woo_product_single_title_font_size);

$woo_product_single_title_line_height = new EdgeField("textsimple","woo_product_single_title_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_product_single_title_line_height",$woo_product_single_title_line_height);

$row2 = new EdgeRow(true);
$group1->addChild("row2",$row2);

$woo_product_single_title_text_transform = new EdgeField("selectblanksimple","woo_product_single_title_text_transform","","Text Transform","This is some description",$options_texttransform);
$row2->addChild("woo_product_single_title_text_transform",$woo_product_single_title_text_transform);

$woo_product_single_title_font_family = new EdgeField("Fontsimple","woo_product_single_title_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_product_single_title_font_family",$woo_product_single_title_font_family);

$woo_product_single_title_font_style = new EdgeField("selectblanksimple","woo_product_single_title_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_product_single_title_font_style",$woo_product_single_title_font_style);

$woo_product_single_title_font_weight = new EdgeField("selectblanksimple","woo_product_single_title_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_product_single_title_font_weight",$woo_product_single_title_font_weight);

$row3 = new EdgeRow(true);
$group1->addChild("row3",$row3);

$woo_product_single_title_letter_spacing = new EdgeField("textsimple","woo_product_single_title_letter_spacing","","Letter Spacing (px)","This is some description");
$row3->addChild("woo_product_single_title_letter_spacing",$woo_product_single_title_letter_spacing);

//Product single meta title

$group2 = new EdgeGroup("Product Single Meta Title","Define Product Single Meta Title Style");
$panel2->addChild("group2",$group2);

$row1 = new EdgeRow();
$group2->addChild("row1",$row1);

$woo_product_single_meta_title_color = new EdgeField("colorsimple","woo_product_single_meta_title_color","","Text Color","This is some description");
$row1->addChild("woo_product_single_meta_title_color",$woo_product_single_meta_title_color);

$woo_product_single_meta_title_font_size = new EdgeField("textsimple","woo_product_single_meta_title_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_product_single_meta_title_font_size",$woo_product_single_meta_title_font_size);

$woo_product_single_meta_title_line_height = new EdgeField("textsimple","woo_product_single_meta_title_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_product_single_meta_title_line_height",$woo_product_single_meta_title_line_height);

$woo_product_single_meta_title_text_transform = new EdgeField("selectblanksimple","woo_product_single_meta_title_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_product_single_meta_title_text_transform",$woo_product_single_meta_title_text_transform);

$row2 = new EdgeRow(true);
$group2->addChild("row2",$row2);

$woo_product_single_meta_title_font_family = new EdgeField("Fontsimple","woo_product_single_meta_title_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_product_single_meta_title_font_family",$woo_product_single_meta_title_font_family);

$woo_product_single_meta_title_font_style = new EdgeField("selectblanksimple","woo_product_single_meta_title_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_product_single_meta_title_font_style",$woo_product_single_meta_title_font_style);

$woo_product_single_meta_title_font_weight = new EdgeField("selectblanksimple","woo_product_single_meta_title_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_product_single_meta_title_font_weight",$woo_product_single_meta_title_font_weight);

$woo_product_single_meta_title_letter_spacing = new EdgeField("textsimple","woo_product_single_meta_title_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_product_single_meta_title_letter_spacing",$woo_product_single_meta_title_letter_spacing);

//Product single meta title

$group3 = new EdgeGroup("Product Single Meta Info","Define Product Single Meta Info Style");
$panel2->addChild("group3",$group3);

$row1 = new EdgeRow();
$group3->addChild("row1",$row1);

$woo_product_single_meta_info_color = new EdgeField("colorsimple","woo_product_single_meta_info_color","","Text Color","This is some description");
$row1->addChild("woo_product_single_meta_info_color",$woo_product_single_meta_info_color);

$woo_product_single_meta_info_font_size = new EdgeField("textsimple","woo_product_single_meta_info_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_product_single_meta_info_font_size",$woo_product_single_meta_info_font_size);

$woo_product_single_meta_info_line_height = new EdgeField("textsimple","woo_product_single_meta_info_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_product_single_meta_info_line_height",$woo_product_single_meta_info_line_height);

$woo_product_single_meta_info_text_transform = new EdgeField("selectblanksimple","woo_product_single_meta_info_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_product_single_meta_info_text_transform",$woo_product_single_meta_info_text_transform);

$row2 = new EdgeRow(true);
$group3->addChild("row2",$row2);

$woo_product_single_meta_info_font_family = new EdgeField("Fontsimple","woo_product_single_meta_info_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_product_single_meta_info_font_family",$woo_product_single_meta_info_font_family);

$woo_product_single_meta_info_font_style = new EdgeField("selectblanksimple","woo_product_single_meta_info_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_product_single_meta_info_font_style",$woo_product_single_meta_info_font_style);

$woo_product_single_meta_info_font_weight = new EdgeField("selectblanksimple","woo_product_single_meta_info_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_product_single_meta_info_font_weight",$woo_product_single_meta_info_font_weight);

$woo_product_single_meta_info_letter_spacing = new EdgeField("textsimple","woo_product_single_meta_info_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_product_single_meta_info_letter_spacing",$woo_product_single_meta_info_letter_spacing);

//Product single price

$group4 = new EdgeGroup("Product Single Price","Define Product Single Price Style");
$panel2->addChild("group4",$group4);

$row1 = new EdgeRow();
$group4->addChild("row1",$row1);

$woo_product_single_price_color = new EdgeField("colorsimple","woo_product_single_price_color","","Text Color","This is some description");
$row1->addChild("woo_product_single_price_color",$woo_product_single_price_color);

$woo_product_single_price_font_size = new EdgeField("textsimple","woo_product_single_price_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_product_single_price_font_size",$woo_product_single_price_font_size);

$woo_product_single_price_line_height = new EdgeField("textsimple","woo_product_single_price_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_product_single_price_line_height",$woo_product_single_price_line_height);

$woo_product_single_price_text_transform = new EdgeField("selectblanksimple","woo_product_single_price_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_product_single_price_text_transform",$woo_product_single_price_text_transform);

$row2 = new EdgeRow(true);
$group4->addChild("row2",$row2);

$woo_product_single_price_font_family = new EdgeField("Fontsimple","woo_product_single_price_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_product_single_price_font_family",$woo_product_single_price_font_family);

$woo_product_single_price_font_style = new EdgeField("selectblanksimple","woo_product_single_price_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_product_single_price_font_style",$woo_product_single_price_font_style);

$woo_product_single_price_font_weight = new EdgeField("selectblanksimple","woo_product_single_price_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_product_single_price_font_weight",$woo_product_single_price_font_weight);

$woo_product_single_price_letter_spacing = new EdgeField("textsimple","woo_product_single_price_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_product_single_price_letter_spacing",$woo_product_single_price_letter_spacing);

$row3 = new EdgeRow(true);
$group4->addChild("row3",$row3);

$woo_product_single_price_old_font_size = new EdgeField("textsimple","woo_product_single_price_old_font_size","","Old Price Font Size (px)","This is some description");
$row3->addChild("woo_product_single_price_old_font_size",$woo_product_single_price_old_font_size);

$woo_product_single_price_old_color = new EdgeField("colorsimple","woo_product_single_price_old_color","","Old Price Color","This is some description");
$row3->addChild("woo_product_single_price_old_color",$woo_product_single_price_old_color);


$woo_product_single_show_social_share = new EdgeField("yesno","woo_product_single_show_social_share","no","Show Share","Enabling this option will show share on Single Product", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_woo_product_single_share_options_container"));
$panel2->addChild("woo_product_single_show_social_share",$woo_product_single_show_social_share);

$woo_product_single_share_options_container = new EdgeContainer("woo_product_single_share_options_container","woo_product_single_show_social_share","no");
$panel2->addChild("woo_product_single_share_options_container",$woo_product_single_share_options_container);

$woo_product_single_select_share_option = new EdgeField("select","woo_product_single_select_share_option","dropdown","Social Share Style","Choose Social Share Style for Single Product",array(
	"dropdown" => "Social Share Dropdown",
	"list" => "Social Share List"
));
$woo_product_single_share_options_container->addChild("woo_product_single_select_share_option",$woo_product_single_select_share_option);

//Product single tabs/accordions

$woo_products_info_style = new EdgeField("select","woo_products_info_style","accordions","Product Info Display Style","Choose to display product info with accordions right from product image or with vertical tabs below product image", array(
	"accordions" => "Accordions",
	"vertical_tabs" => "Vertical Tabs"

));

$panel2->addChild("woo_products_info_style",$woo_products_info_style);


//Product single accordions

$group10 = new EdgeGroup("Product Single Accordions","Define Product Single Accordions Style");
$panel2->addChild("group10",$group10);

$row1 = new EdgeRow();
$group10->addChild("row1",$row1);

$woo_product_single_tabs_color = new EdgeField("colorsimple","woo_product_single_tabs_color","","Header Background Color","This is some description");
$row1->addChild("woo_product_single_tabs_color",$woo_product_single_tabs_color);

$woo_product_single_tabs_hover_color = new EdgeField("colorsimple","woo_product_single_tabs_hover_color","","Header Hover Background Color","This is some description");
$row1->addChild("woo_product_single_tabs_hover_color",$woo_product_single_tabs_hover_color);

$woo_product_single_tabs_border_color = new EdgeField("colorsimple","woo_product_single_tabs_border_color","","Header Border Color","This is some description");
$row1->addChild("woo_product_single_tabs_border_color",$woo_product_single_tabs_border_color);

$woo_product_single_tabs_border_hover_color = new EdgeField("colorsimple","woo_product_single_tabs_border_hover_color","","Header Hover Border Color","This is some description");
$row1->addChild("woo_product_single_tabs_border_hover_color",$woo_product_single_tabs_border_hover_color);

$row2 = new EdgeRow();
$group10->addChild("row2",$row2);

$woo_product_single_tabs_text_color = new EdgeField("colorsimple","woo_product_single_tabs_text_color","","Text Color","This is some description");
$row2->addChild("woo_product_single_tabs_text_color",$woo_product_single_tabs_text_color);

$woo_product_single_tabs_text_hover_color = new EdgeField("colorsimple","woo_product_single_tabs_text_hover_color","","Text Hover Color","This is some description");
$row2->addChild("woo_product_single_tabs_text_hover_color",$woo_product_single_tabs_text_hover_color);

$woo_product_single_tabs_font_size = new EdgeField("textsimple","woo_product_single_tabs_font_size","","Font Size (px)","This is some description");
$row2->addChild("woo_product_single_tabs_font_size",$woo_product_single_tabs_font_size);

$woo_product_single_tabs_line_height = new EdgeField("textsimple","woo_product_single_tabs_line_height","","Line Height (px)","This is some description");
$row2->addChild("woo_product_single_tabs_line_height",$woo_product_single_tabs_line_height);

$row3 = new EdgeRow(true);
$group10->addChild("row3",$row3);

$woo_product_single_tabs_text_transform = new EdgeField("selectblanksimple","woo_product_single_tabs_text_transform","","Text Transform","This is some description",$options_texttransform);
$row3->addChild("woo_product_single_tabs_text_transform",$woo_product_single_tabs_text_transform);

$woo_product_single_tabs_font_family = new EdgeField("Fontsimple","woo_product_single_tabs_font_family","-1","Font Family","This is some description");
$row3->addChild("woo_product_single_tabs_font_family",$woo_product_single_tabs_font_family);

$woo_product_single_tabs_font_style = new EdgeField("selectblanksimple","woo_product_single_tabs_font_style","","Font Style","This is some description",$options_fontstyle);
$row3->addChild("woo_product_single_tabs_font_style",$woo_product_single_tabs_font_style);

$woo_product_single_tabs_font_weight = new EdgeField("selectblanksimple","woo_product_single_tabs_font_weight","","Font Weight","This is some description",$options_fontweight);
$row3->addChild("woo_product_single_tabs_font_weight",$woo_product_single_tabs_font_weight);

$row4 = new EdgeRow(true);
$group10->addChild("row4",$row4);

$woo_product_single_tabs_letter_spacing = new EdgeField("textsimple","woo_product_single_tabs_letter_spacing","","Letter Spacing (px)","This is some description");
$row4->addChild("woo_product_single_tabs_letter_spacing",$woo_product_single_tabs_letter_spacing);


//Product single tabs


$group11 = new EdgeGroup("Product Single Tabs","Define Product Single Tabs Style");
$panel2->addChild("group11",$group11);

$row1 = new EdgeRow();
$group11->addChild("row1",$row1);

$woo_product_single_vertical_tabs_text_color = new EdgeField("colorsimple","woo_product_single_vertical_tabs_text_color","","Text Color","This is some description");
$row1->addChild("woo_product_single_vertical_tabs_text_color",$woo_product_single_vertical_tabs_text_color);

$woo_product_single_vertical_tabs_text_hover_color = new EdgeField("colorsimple","woo_product_single_vertical_tabs_text_hover_color","","Text Hover Color","This is some description");
$row1->addChild("woo_product_single_vertical_tabs_text_hover_color",$woo_product_single_vertical_tabs_text_hover_color);

$woo_product_single_vertical_tabs_border_color = new EdgeField("colorsimple","woo_product_single_vertical_tabs_border_color","","Border Color","This is some description");
$row1->addChild("woo_product_single_vertical_tabs_border_color",$woo_product_single_vertical_tabs_border_color);

$woo_product_single_vertical_tabs_border_width = new EdgeField("textsimple","woo_product_single_vertical_tabs_border_width","","Border Width (px)","This is some description");
$row1->addChild("woo_product_single_vertical_tabs_border_width",$woo_product_single_vertical_tabs_border_width);

$row2 = new EdgeRow();
$group11->addChild("row2",$row2);

$woo_product_single_vertical_tabs_font_size = new EdgeField("textsimple","woo_product_single_vertical_tabs_font_size","","Font Size (px)","This is some description");
$row2->addChild("woo_product_single_vertical_tabs_font_size",$woo_product_single_vertical_tabs_font_size);

$woo_product_single_vertical_tabs_line_height = new EdgeField("textsimple","woo_product_single_vertical_tabs_line_height","","Line Height (px)","This is some description");
$row2->addChild("woo_product_single_vertical_tabs_line_height",$woo_product_single_vertical_tabs_line_height);

$woo_product_single_vertical_tabs_text_transform = new EdgeField("selectblanksimple","woo_product_single_vertical_tabs_text_transform","","Text Transform","This is some description",$options_texttransform);
$row2->addChild("woo_product_single_vertical_tabs_text_transform",$woo_product_single_vertical_tabs_text_transform);

$woo_product_single_vertical_tabs_font_family = new EdgeField("Fontsimple","woo_product_single_vertical_tabs_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_product_single_vertical_tabs_font_family",$woo_product_single_vertical_tabs_font_family);

$row3 = new EdgeRow(true);
$group11->addChild("row3",$row3);


$woo_product_single_vertical_tabs_font_style = new EdgeField("selectblanksimple","woo_product_single_vertical_tabs_font_style","","Font Style","This is some description",$options_fontstyle);
$row3->addChild("woo_product_single_vertical_tabs_font_style",$woo_product_single_vertical_tabs_font_style);

$woo_product_single_vertical_tabs_font_weight = new EdgeField("selectblanksimple","woo_product_single_vertical_tabs_font_weight","","Font Weight","This is some description",$options_fontweight);
$row3->addChild("woo_product_single_vertical_tabs_font_weight",$woo_product_single_vertical_tabs_font_weight);

$woo_product_single_vertical_tabs_letter_spacing = new EdgeField("textsimple","woo_product_single_vertical_tabs_letter_spacing","","Letter Spacing (px)","This is some description");
$row3->addChild("woo_product_single_vertical_tabs_letter_spacing",$woo_product_single_vertical_tabs_letter_spacing);


//Related Products Title

$group5 = new EdgeGroup("Related Products Title","Define Related Products Title Style");
$panel2->addChild("group5",$group5);

$row1 = new EdgeRow();
$group5->addChild("row1",$row1);

$woo_product_single_related_color = new EdgeField("colorsimple","woo_product_single_related_color","","Text Color","This is some description");
$row1->addChild("woo_product_single_related_color",$woo_product_single_related_color);

$woo_product_single_related_font_size = new EdgeField("textsimple","woo_product_single_related_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_product_single_related_font_size",$woo_product_single_related_font_size);

$woo_product_single_related_line_height = new EdgeField("textsimple","woo_product_single_related_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_product_single_related_line_height",$woo_product_single_related_line_height);

$woo_product_single_related_text_transform = new EdgeField("selectblanksimple","woo_product_single_related_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("woo_product_single_related_text_transform",$woo_product_single_related_text_transform);

$row2 = new EdgeRow(true);
$group5->addChild("row2",$row2);

$woo_product_single_related_font_family = new EdgeField("Fontsimple","woo_product_single_related_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_product_single_related_font_family",$woo_product_single_related_font_family);

$woo_product_single_related_font_style = new EdgeField("selectblanksimple","woo_product_single_related_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_product_single_related_font_style",$woo_product_single_related_font_style);

$woo_product_single_related_font_weight = new EdgeField("selectblanksimple","woo_product_single_related_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_product_single_related_font_weight",$woo_product_single_related_font_weight);

$woo_product_single_related_letter_spacing = new EdgeField("textsimple","woo_product_single_related_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("woo_product_single_related_letter_spacing",$woo_product_single_related_letter_spacing);

//Add to cart button

$add_to_cart_subtitle = new EdgeTitle("add_to_cart_subtitle", '"Add to cart" button');
$panel2->addChild("add_to_cart_subtitle", $add_to_cart_subtitle);

$group6 = new EdgeGroup('Button Text Style','Define "Add To Cart" button text style');
$panel2->addChild("group6",$group6);

$row1 = new EdgeRow();
$group6->addChild("row1",$row1);

$woo_products_single_add_to_cart_color = new EdgeField("colorsimple","woo_products_single_add_to_cart_color","","Text Color","This is some description");
$row1->addChild("woo_products_single_add_to_cart_color",$woo_products_single_add_to_cart_color);

$woo_products_single_add_to_cart_hover_color = new EdgeField("colorsimple","woo_products_single_add_to_cart_hover_color","","Hover Text Color","This is some description");
$row1->addChild("woo_products_single_add_to_cart_hover_color",$woo_products_single_add_to_cart_hover_color);

$woo_products_single_add_to_cart_font_size = new EdgeField("textsimple","woo_products_single_add_to_cart_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_single_add_to_cart_font_size",$woo_products_single_add_to_cart_font_size);

$woo_products_single_add_to_cart_line_height = new EdgeField("textsimple","woo_products_single_add_to_cart_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_single_add_to_cart_line_height",$woo_products_single_add_to_cart_line_height);

$row2 = new EdgeRow(true);
$group6->addChild("row2",$row2);

$woo_products_single_add_to_cart_text_transform = new EdgeField("selectblanksimple","woo_products_single_add_to_cart_text_transform","","Text Transform","This is some description",$options_texttransform);
$row2->addChild("woo_products_single_add_to_cart_text_transform",$woo_products_single_add_to_cart_text_transform);

$woo_products_single_add_to_cart_font_family = new EdgeField("Fontsimple","woo_products_single_add_to_cart_font_family","-1","Font Family","This is some description");
$row2->addChild("woo_products_single_add_to_cart_font_family",$woo_products_single_add_to_cart_font_family);

$woo_products_single_add_to_cart_font_style = new EdgeField("selectblanksimple","woo_products_single_add_to_cart_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("woo_products_single_add_to_cart_font_style",$woo_products_single_add_to_cart_font_style);

$woo_products_single_add_to_cart_font_weight = new EdgeField("selectblanksimple","woo_products_single_add_to_cart_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("woo_products_single_add_to_cart_font_weight",$woo_products_single_add_to_cart_font_weight);

$row3 = new EdgeRow(true);
$group6->addChild("row3",$row3);

$woo_products_single_add_to_cart_letter_spacing = new EdgeField("textsimple","woo_products_single_add_to_cart_letter_spacing","","Letter Spacing (px)","This is some description");
$row3->addChild("woo_products_single_add_to_cart_letter_spacing",$woo_products_single_add_to_cart_letter_spacing);

$woo_products_single_add_to_cart_margin_left = new EdgeField("textsimple","woo_products_single_add_to_cart_margin_left","","Margin left (px)","This is some description");
$row3->addChild("woo_products_single_add_to_cart_margin_left",$woo_products_single_add_to_cart_margin_left);


$group18 = new EdgeGroup('Button Background','Define "Add To Cart" Button Background');
$panel2->addChild("group18",$group18);

$row1 = new EdgeRow();
$group18->addChild("row1",$row1);

$woo_products_single_add_to_cart_background_color = new EdgeField("colorsimple","woo_products_single_add_to_cart_background_color","","Background Color","This is some description");
$row1->addChild("woo_products_single_add_to_cart_background_color",$woo_products_single_add_to_cart_background_color);

$woo_products_single_add_to_cart_background_hover_color = new EdgeField("colorsimple","woo_products_single_add_to_cart_background_hover_color","","Hover Background Color","This is some description");
$row1->addChild("woo_products_single_add_to_cart_background_hover_color",$woo_products_single_add_to_cart_background_hover_color);

$group19 = new EdgeGroup('Button Border','Define "Add To Cart" border');
$panel2->addChild("group19",$group19);

$row1 = new EdgeRow();
$group19->addChild("row1",$row1);

$woo_products_single_add_to_cart_border_color = new EdgeField("colorsimple","woo_products_single_add_to_cart_border_color","","Border Color","This is some description");
$row1->addChild("woo_products_single_add_to_cart_border_color",$woo_products_single_add_to_cart_border_color);

$woo_products_single_add_to_cart_border_hover_color = new EdgeField("colorsimple","woo_products_single_add_to_cart_border_hover_color","","Border Hover Color","This is some description");
$row1->addChild("woo_products_single_add_to_cart_border_hover_color",$woo_products_single_add_to_cart_border_hover_color);

$woo_products_single_add_to_cart_border_width = new EdgeField("textsimple","woo_products_single_add_to_cart_border_width","","Border Width (px)","This is some description");
$row1->addChild("woo_products_single_add_to_cart_border_width",$woo_products_single_add_to_cart_border_width);

$woo_products_single_add_to_cart_border_radius = new EdgeField("textsimple","woo_products_single_add_to_cart_border_radius","","Border radius (px)","This is some description");
$row1->addChild("woo_products_single_add_to_cart_border_radius",$woo_products_single_add_to_cart_border_radius);


//Quantity buttons

$quantity_subtitle = new EdgeTitle("quantity_subtitle", 'Quantity Buttons');
$panel2->addChild("quantity_subtitle", $quantity_subtitle);

$group27 = new EdgeGroup('Buttons Width','Define width for buttons');
$panel2->addChild("group27",$group27);

$row1 = new EdgeRow();
$group27->addChild("row1",$row1);

$woo_products_single_quantity_width = new EdgeField("textsimple","woo_products_single_quantity_width","","Width (px)","This is some description");
$row1->addChild("woo_products_single_quantity_width",$woo_products_single_quantity_width);

$group20 = new EdgeGroup('Buttons Text Style','Define Quantity buttons text style');
$panel2->addChild("group20",$group20);

$row1 = new EdgeRow();
$group20->addChild("row1",$row1);

$woo_products_single_quantity_color = new EdgeField("colorsimple","woo_products_single_quantity_color","","Text Color","This is some description");
$row1->addChild("woo_products_single_quantity_color",$woo_products_single_quantity_color);

$woo_products_single_quantity_hover_color = new EdgeField("colorsimple","woo_products_single_quantity_hover_color","","Hover Text Color","This is some description");
$row1->addChild("woo_products_single_quantity_hover_color",$woo_products_single_quantity_hover_color);

$woo_products_single_quantity_font_size = new EdgeField("textsimple","woo_products_single_quantity_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_single_quantity_font_size",$woo_products_single_quantity_font_size);

$woo_products_single_quantity_line_height = new EdgeField("textsimple","woo_products_single_quantity_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_single_quantity_line_height",$woo_products_single_quantity_line_height);


$group21 = new EdgeGroup('Buttons Background','Define Quantity buttons background');
$panel2->addChild("group21",$group21);

$row1 = new EdgeRow();
$group21->addChild("row1",$row1);

$woo_products_single_quantity_background_color = new EdgeField("colorsimple","woo_products_single_quantity_background_color","","Background Color","This is some description");
$row1->addChild("woo_products_single_quantity_background_color",$woo_products_single_quantity_background_color);

$woo_products_single_quantity_background_hover_color = new EdgeField("colorsimple","woo_products_single_quantity_background_hover_color","","Hover Background Color","This is some description");
$row1->addChild("woo_products_single_quantity_background_hover_color",$woo_products_single_quantity_background_hover_color);

$group22 = new EdgeGroup('Buttons Border','Define Quantity buttons border');
$panel2->addChild("group22",$group22);

$row1 = new EdgeRow();
$group22->addChild("row1",$row1);

$woo_products_single_quantity_border_color = new EdgeField("colorsimple","woo_products_single_quantity_border_color","","Border Color","This is some description");
$row1->addChild("woo_products_single_quantity_border_color",$woo_products_single_quantity_border_color);

$woo_products_single_quantity_border_hover_color = new EdgeField("colorsimple","woo_products_single_quantity_border_hover_color","","Border Hover Color","This is some description");
$row1->addChild("woo_products_single_quantity_border_hover_color",$woo_products_single_quantity_border_hover_color);

$woo_products_single_quantity_border_width = new EdgeField("textsimple","woo_products_single_quantity_border_width","","Border Width (px)","This is some description");
$row1->addChild("woo_products_single_quantity_border_width",$woo_products_single_quantity_border_width);

$woo_products_single_quantity_border_radius = new EdgeField("textsimple","woo_products_single_quantity_border_radius","","Border radius (px)","This is some description");
$row1->addChild("woo_products_single_quantity_border_radius",$woo_products_single_quantity_border_radius);

//Quantity input field

$quantity_input_subtitle = new EdgeTitle("quantity_input_subtitle", 'Quantity Input Field');
$panel2->addChild("quantity_input_subtitle", $quantity_input_subtitle);

$group26 = new EdgeGroup('Input Field Width','Define width for input field');
$panel2->addChild("group26",$group26);

$row1 = new EdgeRow();
$group26->addChild("row1",$row1);

$woo_products_single_quantity_input_width = new EdgeField("textsimple","woo_products_single_quantity_input_width","","Width (px)","This is some description");
$row1->addChild("woo_products_single_quantity_input_width",$woo_products_single_quantity_input_width);

$group23 = new EdgeGroup('Input Text Style','Define Quantity Input Field text style');
$panel2->addChild("group23",$group23);

$row1 = new EdgeRow();
$group23->addChild("row1",$row1);

$woo_products_single_quantity_input_color = new EdgeField("colorsimple","woo_products_single_quantity_input_color","","Text Color","This is some description");
$row1->addChild("woo_products_single_quantity_input_color",$woo_products_single_quantity_input_color);

$woo_products_single_quantity_input_hover_color = new EdgeField("colorsimple","woo_products_single_quantity_input_hover_color","","Focus Text Color","This is some description");
$row1->addChild("woo_products_single_quantity_input_hover_color",$woo_products_single_quantity_input_hover_color);

$woo_products_single_quantity_input_font_size = new EdgeField("textsimple","woo_products_single_quantity_input_font_size","","Font Size (px)","This is some description");
$row1->addChild("woo_products_single_quantity_input_font_size",$woo_products_single_quantity_input_font_size);

$woo_products_single_quantity_input_line_height = new EdgeField("textsimple","woo_products_single_quantity_input_line_height","","Line Height (px)","This is some description");
$row1->addChild("woo_products_single_quantity_input_line_height",$woo_products_single_quantity_input_line_height);


$group24 = new EdgeGroup('Input Background','Define Quantity Input Field background');
$panel2->addChild("group24",$group24);

$row1 = new EdgeRow();
$group24->addChild("row1",$row1);

$woo_products_single_quantity_input_background_color = new EdgeField("colorsimple","woo_products_single_quantity_input_background_color","","Background Color","This is some description");
$row1->addChild("woo_products_single_quantity_input_background_color",$woo_products_single_quantity_input_background_color);

$woo_products_single_quantity_input_background_hover_color = new EdgeField("colorsimple","woo_products_single_quantity_input_background_hover_color","","Focus Background Color","This is some description");
$row1->addChild("woo_products_single_quantity_input_background_hover_color",$woo_products_single_quantity_input_background_hover_color);

$group25 = new EdgeGroup('Input Border','Define Quantity Input Field border');
$panel2->addChild("group25",$group25);

$row1 = new EdgeRow();
$group25->addChild("row1",$row1);

$woo_products_single_quantity_input_border_color = new EdgeField("colorsimple","woo_products_single_quantity_input_border_color","","Border Color","This is some description");
$row1->addChild("woo_products_single_quantity_input_border_color",$woo_products_single_quantity_input_border_color);

$woo_products_single_quantity_input_border_hover_color = new EdgeField("colorsimple","woo_products_single_quantity_input_border_hover_color","","Border Focus Color","This is some description");
$row1->addChild("woo_products_single_quantity_input_border_hover_color",$woo_products_single_quantity_input_border_hover_color);

$woo_products_single_quantity_input_border_width = new EdgeField("textsimple","woo_products_single_quantity_input_border_width","","Border Width (px)","This is some description");
$row1->addChild("woo_products_single_quantity_input_border_width",$woo_products_single_quantity_input_border_width);

$woo_products_single_quantity_input_border_radius = new EdgeField("textsimple","woo_products_single_quantity_input_border_radius","","Border radius (px)","This is some description");
$row1->addChild("woo_products_single_quantity_input_border_radius",$woo_products_single_quantity_input_border_radius);

//Product single styles

$panel4 = new EdgePanel("Widget","product_widget");
$woocommercePage->addChild("panel4",$panel4);

$group1 = new EdgeGroup("Product Title","Define styles for product title in widget. This option works for Products, Recently Viewed Products and Top Rated Products widget");
$panel4->addChild("group1",$group1);
$row1 = new EdgeRow();
$group1->addChild("row1",$row1);
$sidebar_product_title_color = new EdgeField("colorsimple","sidebar_product_title_color","","Color","This is some description");
$row1->addChild("sidebar_product_title_color",$sidebar_product_title_color);

$sidebar_product_title_font_size = new EdgeField("textsimple","sidebar_product_title_font_size","","Font Size (px)","This is some description");
$row1->addChild("sidebar_product_title_font_size",$sidebar_product_title_font_size);

$sidebar_product_title_line_height = new EdgeField("textsimple","sidebar_product_title_line_height","","Line Height (px)","This is some description");
$row1->addChild("sidebar_product_title_line_height",$sidebar_product_title_line_height);

$sidebar_product_title_text_transform = new EdgeField("selectblanksimple","sidebar_product_title_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("sidebar_product_title_text_transform",$sidebar_product_title_text_transform);

$row2 = new EdgeRow(true);
$group1->addChild("row2",$row2);
$sidebar_product_title_font_family = new EdgeField("Fontsimple","sidebar_product_title_font_family","-1","Font Family","This is some description");
$row2->addChild("sidebar_product_title_font_family",$sidebar_product_title_font_family);

$sidebar_product_title_font_style = new EdgeField("selectblanksimple","sidebar_product_title_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("sidebar_product_title_font_style",$sidebar_product_title_font_style);

$sidebar_product_title_font_weight = new EdgeField("selectblanksimple","sidebar_product_title_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("sidebar_product_title_font_weight",$sidebar_product_title_font_weight);

$sidebar_product_title_letter_spacing = new EdgeField("textsimple","sidebar_product_title_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("sidebar_product_title_letter_spacing",$sidebar_product_title_letter_spacing);

$row3 = new EdgeRow();
$group1->addChild("row3",$row3);
$sidebar_product_title_hover_color = new EdgeField("colorsimple","sidebar_product_title_hover_color","","Hover Color","This is some description");
$row3->addChild("sidebar_product_title_hover_color",$sidebar_product_title_hover_color);

$group2 = new EdgeGroup("Product Price","Define product price text style in widget. This option works for Products, Recently Viewed Products and Top Rated Products widget");
$panel4->addChild("group2",$group2);

$row1 = new EdgeRow();
$group2->addChild("row1",$row1);

$sidebar_product_price_color = new EdgeField("colorsimple","sidebar_product_price_color","","Text Color","This is some description");
$row1->addChild("sidebar_product_price_color",$sidebar_product_price_color);

$sidebar_product_price_font_size = new EdgeField("textsimple","sidebar_product_price_font_size","","Font Size (px)","This is some description");
$row1->addChild("sidebar_product_price_font_size",$sidebar_product_price_font_size);

$sidebar_product_price_line_height = new EdgeField("textsimple","sidebar_product_price_line_height","","Line Height (px)","This is some description");
$row1->addChild("sidebar_product_price_line_height",$sidebar_product_price_line_height);

$sidebar_product_price_text_transform = new EdgeField("selectblanksimple","sidebar_product_price_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("sidebar_product_price_text_transform",$sidebar_product_price_text_transform);

$row2 = new EdgeRow(true);
$group2->addChild("row2",$row2);

$sidebar_product_price_font_family = new EdgeField("Fontsimple","sidebar_product_price_font_family","-1","Font Family","This is some description");
$row2->addChild("sidebar_product_price_font_family",$sidebar_product_price_font_family);

$sidebar_product_price_font_style = new EdgeField("selectblanksimple","sidebar_product_price_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("sidebar_product_price_font_style",$sidebar_product_price_font_style);

$sidebar_product_price_font_weight = new EdgeField("selectblanksimple","sidebar_product_price_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("sidebar_product_price_font_weight",$sidebar_product_price_font_weight);

$sidebar_product_price_letter_spacing = new EdgeField("textsimple","sidebar_product_price_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("sidebar_product_price_letter_spacing",$sidebar_product_price_letter_spacing);

$row3 = new EdgeRow(true);
$group2->addChild("row3",$row3);

$sidebar_product_price_old_color = new EdgeField("colorsimple","sidebar_product_price_old_color","","Old Price Color","This is some description");
$row3->addChild("sidebar_product_price_old_color",$sidebar_product_price_old_color);

//WooCommerce Dropdown Cart
$woo_drop_cart_type = new EdgeField("select","woo_drop_cart_type","with_icon","WooCommerce Dropdown Cart Widget Style","Choose style for woocommerce dropdown cart widget in header", array(
	"with_icon" => "With Icon",
	"with_icon_label" => "With Icon and Label"
));
$panel4->addChild("woo_drop_cart_type",$woo_drop_cart_type);


$group3 = new EdgeGroup("Cart Text Style","Define cart text style in header");
$panel4->addChild("group3",$group3);

$row1 = new EdgeRow();
$group3->addChild("row1",$row1);

$header_cart_text_color = new EdgeField("colorsimple","header_cart_text_color","","Text Color","This is some description");
$row1->addChild("header_cart_text_color",$header_cart_text_color);

$header_cart_text_hover_color = new EdgeField("colorsimple","header_cart_text_hover_color","","Text Hover Color","This is some description");
$row1->addChild("header_cart_text_hover_color",$header_cart_text_hover_color);

$header_cart_text_font_size = new EdgeField("textsimple","header_cart_text_font_size","","Font Size (px)","This is some description");
$row1->addChild("header_cart_text_font_size",$header_cart_text_font_size);

$header_cart_text_line_height = new EdgeField("textsimple","header_cart_text_line_height","","Line Height (px)","This is some description");
$row1->addChild("header_cart_text_line_height",$header_cart_text_line_height);

$row2 = new EdgeRow(true);
$group3->addChild("row2",$row2);

$header_cart_text_text_transform = new EdgeField("selectblanksimple","header_cart_text_text_transform","","Text Transform","This is some description",$options_texttransform);
$row2->addChild("header_cart_text_text_transform",$header_cart_text_text_transform);

$header_cart_text_font_family = new EdgeField("Fontsimple","header_cart_text_font_family","-1","Font Family","This is some description");
$row2->addChild("header_cart_text_font_family",$header_cart_text_font_family);

$header_cart_text_font_style = new EdgeField("selectblanksimple","header_cart_text_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("header_cart_text_font_style",$header_cart_text_font_style);

$header_cart_text_font_weight = new EdgeField("selectblanksimple","header_cart_text_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("header_cart_text_font_weight",$header_cart_text_font_weight);

$row3 = new EdgeRow(true);
$group3->addChild("row3",$row3);

$header_cart_text_letter_spacing = new EdgeField("textsimple","header_cart_text_letter_spacing","","Letter Spacing (px)","This is some description");
$row3->addChild("header_cart_text_letter_spacing",$header_cart_text_letter_spacing);


$group4 = new EdgeGroup("Cart Icon Style","Define cart icon style in header.");
$panel4->addChild("group4",$group4);

$row1 = new EdgeRow();
$group4->addChild("row1",$row1);

$header_cart_icon_color = new EdgeField("colorsimple","header_cart_icon_color","","Icon Color","This is some description");
$row1->addChild("header_cart_icon_color",$header_cart_icon_color);

$header_cart_icon_hover_color = new EdgeField("colorsimple","header_cart_icon_hover_color","","Icon Hover Color","This is some description");
$row1->addChild("header_cart_icon_hover_color",$header_cart_icon_hover_color);

$header_cart_icon_count_color = new EdgeField("colorsimple","header_cart_icon_count_color","","Count Color","This is some description");
$row1->addChild("header_cart_icon_count_color",$header_cart_icon_count_color);

$header_cart_icon_count_hover_color = new EdgeField("colorsimple","header_cart_icon_count_hover_color","","Count Hover Color","This is some description");
$row1->addChild("header_cart_icon_count_hover_color",$header_cart_icon_count_hover_color);

$row2 = new EdgeRow();
$group4->addChild("row2",$row2);

$header_cart_icon_size = new EdgeField("textsimple","header_cart_icon_size","","Icon Size (px)","This is some description");
$row2->addChild("header_cart_icon_size",$header_cart_icon_size);




