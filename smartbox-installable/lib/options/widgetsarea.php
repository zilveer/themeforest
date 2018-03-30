<?php
	
	$designare_general_options= array( array(
		"name" => "Widgets Area",
		"type" => "title",
		"img" => DESIGNARE_IMAGES_URL."icon_general.png"
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"toppanel", "name"=>"Top Panel"), array("id"=>"footer", "name"=>"Footer"), array("id"=>"sidebars", "name"=>"Sidebars"))
	),
	
	
	/* ------------------------------------------------------------------------*
	 * Footer
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'footer'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Footer Settings</h3>"
	),
	
	array(
		"name" => "Number Columns",
		"id" => DESIGNARE_SHORTNAME."_footer_number_cols",
		"type" => "select",
		"options" => array(array("name"=>"One", "id"=>"one"), array("name"=>"Two", "id"=>"two"), array("name"=>"Three", "id"=>"three"), array("name"=>"Four", "id"=>"four")),
		"std" => 'one'
	),
	
	array(
		"name" => "Columns Order",
		"id" => DESIGNARE_SHORTNAME."_footer_columns_order",
		"type" => "select",
		"options" => array(array("name"=>"x | x | x", "id"=>"one_three"), array("name"=>"x | xx", "id"=>"one_two_three"), array("name"=>"xx | x", "id"=>"two_one_three")),
		"std" => "one_three"
	),
	
	array(
		"name" => "Columns Order",
		"id" => DESIGNARE_SHORTNAME."_footer_columns_order_four",
		"type" => "select",
		"options" => array(array("name"=>"x | x | x | x", "id"=>"one_four"), array("name"=>"x | xx | x", "id"=>"two_one_two_four"), array("name"=>"xxx | x", "id"=>"three_one_four"), array("name"=>"x | xxx", "id"=>"one_three_four")),
		"std" => "one_four"
	),
	
	
	array(
		"type" => "documentation",
		"text" => "<h3>Secondary Footer</h3>"
	),
	
	array(
		"name" => "Copyrights Left",
		"id" => DESIGNARE_SHORTNAME."_copyrights_left",
		"type" => "text",
		"desc" => "NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color > "
	),
	
	array(
		"name" => "Footer Right Content",
		"id" => DESIGNARE_SHORTNAME."_footer_right_content",
		"type" => "select",
		"options" => array(array("id"=>"none", "name"=>"None"), array("id"=>"text","name"=>"Text"), array("id"=>"menu","name"=>"Footer Menu"), array("id"=>"social", "name"=>"Social Icons")),
		"std" => "none"
	),
	
	array(
		"name" => "Footer Right Text",
		"id" => DESIGNARE_SHORTNAME."_footer_right_text",
		"type" => "text",
		"desc"=>"Only Available if <b>Text</b> selected above. <br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >"
	),
	
	array(
		"name" => "Footer Social Icons Style",
		"id" => DESIGNARE_SHORTNAME."_footer_social_icons_style",
		"type" => "select",
		"options" => array(array("id"=>"dark", "name"=>"Dark"), array("id"=>"light","name"=>"Light")),
		"std" => "dark",
		"desc"=>"Only Available if <b>Social Icons</b> selected above. <br/>"
	),
		
	array(
		"type" => "close"
	),
	
	
	/* ------------------------------------------------------------------------*
	 * Top Panel
	 * ------------------------------------------------------------------------*/
	array(
		"type" => "subtitle",
		"id"=>'toppanel'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Top Panel Settings</h3>"
	),
		
	array(
		"name" => "Enable Widgets Area",
		"id" => DESIGNARE_SHORTNAME."_enable_widgets_area",
		"type" => "checkbox",
		"std" => 'on'
	),
	
	array(
		"name" => "Number Columns",
		"id" => DESIGNARE_SHORTNAME."_toppanel_number_cols",
		"type" => "select",
		"options" => array(array("name"=>"One", "id"=>"one"), array("name"=>"Two", "id"=>"two"), array("name"=>"Three", "id"=>"three"), array("name"=>"Four", "id"=>"four")),
		"std" => 'one'
	),
	
	array(
		"name" => "Columns Order",
		"id" => DESIGNARE_SHORTNAME."_toppanel_columns_order",
		"type" => "select",
		"options" => array(array("name"=>"x | x | x", "id"=>"one_three"), array("name"=>"x | xx", "id"=>"one_two_three"), array("name"=>"xx | x", "id"=>"two_one_three")),
		"std" => "one_three"
	),
	
	array(
		"type" => "close"
	),
	
	/* ------------------------------------------------------------------------*
	 * Sidebars
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'sidebars'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Create New Sidebar</h3>"
	),
	
	array(
		"name"=>"Custom Sidebars",
		"id"=>'sidebar_name',
		"type"=>"custom",
		"button_text"=>'Add Sidebar',
		"fields"=>array(
			array('id'=>'des_sidebar_name_name', 'type'=>'text', 'name'=>'Name')
		),
		"desc"=>"Here you can create unlimited sidebars. After creating one you can customize its content in Appearance > Widgets and then use it wherever you want via shortcode (Shortcodes > Features > Custom Sidebar)."
	),
	
	
	array(
		"type" => "close"
	),
	
	/*close array*/
	
	array(
		"type" => "close"
	));
	
	designare_add_options($designare_general_options);
	
?>