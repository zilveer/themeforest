<?php

// remove elements
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_button");
vc_remove_element("vc_flickr");
vc_remove_element("vc_gallery");
vc_remove_element("vc_images_carousel");
vc_remove_element("vc_tour");
vc_remove_element("vc_round_chart");
vc_remove_element("vc_line_chart");

vc_remove_element("woocommerce_cart");
vc_remove_element("woocommerce_checkout");
vc_remove_element("woocommerce_order_tracking");
vc_remove_element("woocommerce_my_account");
vc_remove_element("recent_products");
vc_remove_element("featured_products");
vc_remove_element("products");
vc_remove_element("add_to_cart_url");
vc_remove_element("product_page");
vc_remove_element("product_category");
vc_remove_element("sale_products");
vc_remove_element("best_selling_products");
vc_remove_element("top_rated_products");
vc_remove_element("product_attribute");

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "hide_in_vc_editor",
	"admin_label" => true,
	"heading" => "Row Type",
	"param_name" => "type",
	"description" => "[Deprecated Option] Use 'Row Stretch' instead (scroll above).",
	"value" => array(
		"Full Width" => "full_width",
		"Boxed" => "boxed"
	)
));

vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "hide_in_vc_editor",
	"admin_label" => true,
	"heading" => "Row Type",
	"param_name" => "type",
	"description" => "[Deprecated Option]",
	"value" => array(
		"Full Width" => "full_width",
		"Boxed" => "boxed"
	)
));