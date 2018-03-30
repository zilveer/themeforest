<?php
if (!function_exists('register_button')){
	function register_button( $buttons ){
		array_push( $buttons, "|", "qode_shortcodes" );
		return $buttons;
	}
}

if (!function_exists('add_plugin')){
	function add_plugin( $plugin_array ) {
		$plugin_array['qode_shortcodes'] = get_template_directory_uri() . '/includes/shortcodes/qode_shortcodes.js';
		return $plugin_array;
	}
}

if (!function_exists('qode_shortcodes_button')){
	function qode_shortcodes_button(){
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}

		if ( get_user_option('rich_editing') == 'true' ) {
			add_filter( 'mce_external_plugins', 'add_plugin' );
			add_filter( 'mce_buttons', 'register_button' );
		}
	}
}
add_action('after_setup_theme', 'qode_shortcodes_button');


if (!function_exists('num_shortcodes')){
	function num_shortcodes($content){
		$columns = substr_count( $content, '[pricing_cell' );
		return $columns;
	}
}

/* Call To Action shortcode */

if (!function_exists('call_to_action')) {
	function call_to_action($atts, $content = null) {
		$args = array(
			"type"						        => "normal",
			"full_width"                        => "yes",
			"content_in_grid"                   => "yes",
			"icon_pack"                     	=> "",
			"fa_icon"                       	=> "",
			"fe_icon"                       	=> "",
			"linear_icon"                       => "",
			"icon_size"					        => "",
			"icon_color"				        => "",
			"custom_icon"				        => "",
			"background_color"                  => "",
			"border_color"                      => "",
			"box_padding"                       => "",
			"show_button"                       => "yes",
			"button_size"                       => "",
			"button_link"                       => "",
			"button_text"                       => "",
			"button_target"                     => "",
			"button_text_color"                 => "",
			"button_hover_text_color"           => "",
			"button_background_color"           => "",
			"button_hover_background_color"     => "",
			"button_border_color"               => "",
			"button_hover_border_color"         => "",
			"text_color"                        => "", //used only when shortcode is called from call to action widget
			"text_size"                         => ""
		);

		extract(shortcode_atts($args, $atts));

		$html                   = '';
		$action_classes         = '';
		$action_styles          = '';
		$text_wrapper_classes   = '';
		$button_styles          = '';
		$icon_styles			= '';
		$data_attr              = '';
		$content_styles         = '';

		if($show_button == 'yes') {
			$text_wrapper_classes   .= 'column1';
		}

		if($background_color != '') {
			$action_styles .= 'background-color: '.$background_color.';';
		}
		$action_classes .= $type;
		if($border_color != '') {
			$action_styles .= 'border-top: 1px solid '.$border_color.';';
		}
		if($box_padding != '') {
			$action_styles .= 'padding: '.$box_padding.';';
		}

		if($button_text_color != '') {
			$button_styles .= 'color:'.$button_text_color.';';
		}
		if($icon_color != "") {
			$icon_styles .= " color:".$icon_color . ";";
		}

		if($icon_size != '') {
			$icon_styles .= 'font-size:'.$icon_size.'px;';
		}

		if($button_border_color != '') {
			$button_styles .= 'border-color:'.$button_border_color.';';
		}

		if($button_background_color != '') {
			$button_styles .= "background-color: {$button_background_color};";

		}

		if($button_hover_background_color != "") {
			$data_attr .= " data-hover-background-color=".$button_hover_background_color." ";
		}

		if($button_hover_border_color != "") {
			$data_attr .= " data-hover-border-color=".$button_hover_border_color." ";
		}

		if($button_hover_text_color != "") {
			$data_attr .= " data-hover-color=".$button_hover_text_color;
		}

		if($full_width == "no") {
			$html .= '<div class="container_inner">';
		}

		$html.=  '<div class="call_to_action '.$action_classes.'" style="'.$action_styles.'">';

		if($content_in_grid == 'yes' && $full_width == 'yes') {
			$html .= '<div class="container_inner">';
		}

		if($show_button == 'yes') {
			$html .= '<div class="two_columns_75_25 clearfix">';
		}

		if($text_size != '') {
			$big_large .= 'font-size:'. $text_size.'px;';
		}

		if($text_color != '') {
			$content_styles .= 'color:'.$text_color.';';
		}

		$html .= '<div class="text_wrapper '.$text_wrapper_classes.'">';

		if($type == "with_icon"){
			$html .= '<div class="call_to_action_icon_holder">';
			$html .= '<div class="call_to_action_icon">';
			$html .= '<div class="call_to_action_icon_inner">';
			if($custom_icon != "") {
				if(is_numeric($custom_icon)) {
					$custom_icon_src = wp_get_attachment_url( $custom_icon );
				} else {
					$custom_icon_src = $custom_icon;
				}

				$html .= '<img src="' . $custom_icon_src . '" alt="">';
			} elseif($icon_pack == 'font_awesome' && $fa_icon != '') {
				$html .= '<i class="call_to_action_icon fa '.$fa_icon.'" style="'.$icon_styles.'"></i>';
			} elseif($icon_pack == 'font_elegant' && $fe_icon != '') {
				$html .= '<span class="call_to_action_icon q_font_elegant_icon '.$fe_icon.'" aria-hidden="true" style="'.$icon_styles.'"></span>';
			} elseif($icon_pack == 'linear_icons' && $linear_icon != '') {
				$html .= '<i class="call_to_action_icon q_linear_icons_icon lnr '.$linear_icon.'"  style="'.$icon_styles.'"></i>';
			}

			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		}

		$html .= '<div class="call_to_action_text" style="'.$content_styles.'">'.do_shortcode($content).'</div>';
		$html .= '</div>'; //close text_wrapper

		if($show_button == 'yes') {
			$button_link = ($button_link != '') ? $button_link : 'javascript: void(0)';
			if($button_target == ""){
				$button_target = "_self";
			}

			$html .= '<div class="button_wrapper column2">';
			$html .= '<a href="'.$button_link.'" class="qbutton '. $button_size . '" target="'.$button_target.'" style="'.$button_styles.'"'. $data_attr . '>'.$button_text.'</a>';
			$html .= '</div>';//close button_wrapper
		}

		if($show_button == 'yes') {
			$html .= '</div>'; //close two_columns_75_25 if opened
		}

		if($content_in_grid == 'yes' && $full_width == 'yes') {
			$html .= '</div>'; // close .container_inner if oppened
		}

		$html .= '</div>';//close .call_to_action

		if($full_width == 'no') {
			$html .= '</div>'; // close .container_inner if oppened
		}

		return $html;
	}
}
add_shortcode('call_to_action', 'call_to_action');

/* Accordion shortcode */

if (!function_exists('accordion')) {
	function accordion($atts, $content = null) {
		extract(shortcode_atts(array("accordion_type"=>""), $atts));
		return "<div class='q_accordion_holder $accordion_type clearfix'>" . $content . "</div>";
	}
}
add_shortcode('accordion', 'accordion');

/* Accordion item shortcode */

if (!function_exists('accordion_item')) {
	function accordion_item($atts, $content = null) {
		extract(shortcode_atts(array("caption"=>"","title_color"=>"","icon"=>"","icon_color"=>"","background_color"=>""), $atts));
		$html           = '';
		$heading_styles = '';
		$no_icon        = '';

		if($icon == "") {
			$no_icon = 'no_icon';
		}

		if($title_color != "") {
			$heading_styles .= "color: ".$title_color.";";
		}

		if($background_color != "") {
			$heading_styles .= " background-color: ".$background_color.";";
		}

		$html .= "<h5 style='".$heading_styles."'>";
		if($icon != "") {
			$html .= '<div class="icon-wrapper"><i class="fa '.$icon.'" style="color: '.$icon_color.';"></i></div>';
		}
		$html .= "<div class='accordion_mark'></div><span class='tab-title'>".$caption."</span><span class='accordion_icon_mark'></span></h5><div class='accordion_content ".$no_icon."'><div class='accordion_content_inner'>" . $content . "</div></div>";

		return $html;
	}
}
add_shortcode('accordion_item', 'accordion_item');


/* Blockquote item shortcode */

if (!function_exists('blockquote')) {
	function blockquote($atts, $content = null) {
		$args = array(
			"text"              => "",
			"text_color"        => "",
			"title_tag"	        => "h3",
			"width"             => "",
			"line_height"       => "",
			"background_color"  => "",
			"border_color"      => "",
			"quote_icon_color"  => "",
			"show_quote_icon"   => "",
			"quote_icon_size"   => ""
		);

		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		//init variables
		$html               = "";
		$blockquote_styles  = "";
		$blockquote_classes = array();
		$heading_styles     = "";
		$quote_icon_styles  = array();

		if($show_quote_icon == 'yes') {
			$blockquote_classes[]= 'with_quote_icon';
		} else {
			$blockquote_classes[]= ' without_quote_icon';
		}

		if($width != "") {
			$blockquote_styles .= "width: ".$width."%;";
		}

		if($border_color != "") {
			$blockquote_styles .= "border-left-color: ".$border_color.";";
			$blockquote_classes[] = 'with_border';
		}

		if($background_color != "") {
			$blockquote_styles .= "background-color: ".$background_color.";";
			$blockquote_classes[] = 'with_background';
		}

		if($text_color != "") {
			$heading_styles .= "color: ".$text_color.";";
		}

		if($line_height != "") {
			$heading_styles .= " line-height: ".$line_height."px;";
		}

		if($quote_icon_color != "") {
			$quote_icon_styles[] = "color: ".$quote_icon_color;
		}

		if($quote_icon_size != '') {
			$quote_icon_styles[] = 'font-size: '.$quote_icon_size.'px';
		}

		$html .= "<blockquote class='".implode(' ', $blockquote_classes)."' style='".$blockquote_styles."'>"; //open blockquote
		if($show_quote_icon == 'yes') {
			$html .= "<span class='icon_quotations_holder'>";
			$html .= "<i class='q_font_elegant_icon icon_quotations' style='".implode(';', $quote_icon_styles)."'></i>";
			$html .= "</span>";
		}

		$html .= "<".$title_tag." class='blockquote_text' style='".$heading_styles."'>";
		$html .= "<span>".$text."</span>";
		$html .= "</".$title_tag.">";
		$html .= "</blockquote>"; //close blockquote
		return $html;
	}
}
add_shortcode('blockquote', 'blockquote');

/* Button shortcode */

if (!function_exists('button')) {
	function qbutton($atts, $content = null) {
		global $qode_options;

		$args = array(
			"size"                      => "",
			"style"                     => "",
			"text"                      => "",
			"icon_pack"              	=> "",
			"fa_icon"                	=> "",
			"fe_icon"                	=> "",
			"linear_icon"               => "",
			"icon_color"                => "",
			"icon_size"                 => "",
			"link"                      => "",
			"target"                    => "_self",
			"color"                     => "",
			"hover_color"               => "",
			"background_color"			=> "",
			"hover_background_color"    => "",
			"border_color"              => "",
			"hover_border_color"        => "",
			"font_size"                 => "",
			"font_style"                => "",
			"font_weight"               => "",
			"text_align"                => "",
			"margin"					=> "",
			"border_radius"				=> "",
			'hover_animation'			=> ""
		);

		extract(shortcode_atts($args, $atts));

		if($target == ""){
			$target = "_self";
		}

		//init variables
		$html  = "";
		$button_classes = "qbutton ";
		$icon_classes 	= "";
		$button_styles  = "";
		$add_icon       = "";
		$data_attr      = "";

		if($size != "") {
			$button_classes .= " {$size}";
		}

		if($text_align != "") {
			$button_classes .= " {$text_align}";
		}

		if($hover_animation != "") {
			$button_classes .= " {$hover_animation}";
		}

		if($style == "white") {
			$button_classes .= " {$style}";
		}
		if($color != ""){
			$button_styles .= 'color: '.$color.'; ';
		}

		if($border_color != ""){
			$button_styles .= 'border-color: '.$border_color.'; ';
		}

		if($font_style != ""){
			$button_styles .= 'font-style: '.$font_style.'; ';
		}

		if($font_weight != ""){
			$button_styles .= 'font-weight: '.$font_weight.'; ';
		}

		if($font_size != ""){
			$button_styles .= 'font-size: '.$font_size.'px; ';
		}

		if($icon_pack != ""){
			$icon_style = "";
			$button_classes .= " qbutton_with_icon";
			if($icon_color != ""){
				$icon_style .= 'color: '.$icon_color.';';
			}

			if($icon_size != ""){
				$icon_style .= 'font-size: '.$icon_size.'px;';
				$icon_classes .= " custom_icon_size";
			}

			if($icon_pack == 'font_awesome' && $fa_icon != '')
				$add_icon .= '<i class="button_icon ' . $icon_classes . ' fa '.$fa_icon.'" style="'.$icon_style.'"></i>';
			elseif ($icon_pack == 'font_elegant' && $fe_icon != ''){
				$add_icon .= '<span class="button_icon ' . $icon_classes . ' q_font_elegant_icon '.$fe_icon.'" aria-hidden="true" style="'.$icon_style.'"></span>';
			}
			else if($icon_pack == 'linear_icons' && $linear_icon != '') {
				$add_icon .= '<i class="button_icon ' . $icon_classes . ' q_linear_icons_icon lnr '.$linear_icon.'" style="'.$icon_style.'"></i>';
			}
		}

		if($margin != ""){
			$button_styles .= 'margin: '.$margin.'; ';
		}

		if($border_radius != ""){
			$button_styles .= 'border-radius: '.$border_radius.'px;-moz-border-radius: '.$border_radius.'px;-webkit-border-radius: '.$border_radius.'px; ';
		}

		if($background_color != "" ) {
			$button_styles .= "background-color: {$background_color};";
		}

		if($hover_background_color != "") {
			$data_attr .= "data-hover-background-color=".$hover_background_color." ";
		}

		if($hover_border_color != "") {
			$data_attr .= "data-hover-border-color=".$hover_border_color." ";
		}

		if($hover_color != "") {
			$data_attr .= "data-hover-color=".$hover_color;
		}

		$html .=  '<a href="'.$link.'" target="'.$target.'" '.$data_attr.' class="'.$button_classes.'" style="'.$button_styles.'">'.$text.$add_icon.'</a>';

		return $html;
	}
}
add_shortcode('qbutton', 'qbutton');

/* Counter shortcode */

if (!function_exists('counter')) {
	function counter($atts, $content = null) {
		$args = array(
			"type"              		=> "",
			"box"               		=> "",
			"box_border_color"  		=> "",
			"position"          		=> "",
			"digit"             		=> "",
			"font_size"         		=> "",
			"font_weight"       		=> "",
			"font_color"        		=> "",
			"text"              		=> "",
			"text_size"         		=> "",
			"text_font_weight"  		=> "",
			"text_transform"    		=> "",
			"text_color"        		=> "",
			"separator"         		=> "",
			"separator_color"   		=> "",
			"separator_border_style"   	=> ""
		);

		extract(shortcode_atts($args, $atts));

		//init variables
		$html                   = "";
		$counter_holder_classes = "";
		$counter_holder_styles  = "";
		$counter_classes        = "";
		$counter_styles         = "";
		$text_styles            = "";
		$separator_styles       = "";

		if($position != "") {
			$counter_holder_classes .= " ".$position;
		}

		if($box == "yes") {
			$counter_holder_classes .= " boxed_counter";
		}

		if($box_border_color != "") {
			$counter_holder_styles .= "border-color: ".$box_border_color.";";
		}

		if($type != "") {
			$counter_classes .= " ".$type;
		}

		if($font_color != "") {
			$counter_styles .= "color: ".$font_color.";";
		}

		if($font_size != "") {
			$counter_styles .= "font-size: ".$font_size."px;";
		}
		if($font_weight != "") {
			$counter_styles .= "font-weight: ".$font_weight.";";
		}
		if($text_size != "") {
			$text_styles .= "font-size: ".$text_size."px;";
		}
		if($text_font_weight != "") {
			$text_styles .= "font-weight: ".$text_font_weight.";";
		}
		if($text_transform != "") {
			$text_styles .= "text-transform: ".$text_transform.";";
		}

		if($text_color != "") {
			$text_styles .= "color: ".$text_color.";";
		}

		if($separator_color != "") {
			$separator_styles .= "border-color: ".$separator_color.";";
		}

		if($separator_border_style != "") {
			$separator_styles .= "border-bottom-style: ".$separator_border_style.';';
		}

		$html .= '<div class="q_counter_holder '.$counter_holder_classes.'" style="'.$counter_holder_styles.'">';
		$html .= '<span class="counter '.$counter_classes.'" style="'.$counter_styles.'">'.$digit.'</span>';

		if($separator == "yes") {
			$html .= '<span class="separator small" style="'.$separator_styles.'"></span>';
		}

		$html .= $content;

		if($text != "") {
			$html .= '<p class="counter_text" style="'.$text_styles.'">'.$text.'</p>';
		}

		$html .= '</div>'; //close q_counter_holder

		return $html;
	}
}
add_shortcode('counter', 'counter');

/* Countdown shortcode */

/* Counter shortcode */

if (!function_exists('countdown')) {
	function countdown($atts, $content = null) {
		$args = array(
			'year' => '',
			'month' => '',
			'day' => '',
			'hour' => '',
			'minute' => '',
			'month_label' => 'Months',
			'day_label' => 'Days',
			'hour_label' => 'Hours',
			'minute_label' => 'Minutes',
			'second_label' => 'Seconds',
			'digit_font_size' => '',
			'label_font_size' => '',
			'digit_color' => ''
		);

		extract(shortcode_atts($args, $atts));

		$id = mt_rand(1000, 9999);

		//Get HTML from template
		$html = "";

		$html .= '<div class="qode-countdown" id="countdown' . esc_html($id) . '"';
		$html .= 'data-year="' . esc_attr($year) . '"';
		$html .= 'data-month="' . esc_attr($month) . '"';
		$html .= 'data-day="' . esc_attr($day) . '"';
		$html .= 'data-hour="' . esc_attr($hour) . '"';
		$html .= 'data-minute="' . esc_attr($minute) . '"';
		$html .= 'data-timezone="' . get_option('gmt_offset') . '"';
		$html .= 'data-month-label="' . esc_attr($month_label) . '"';
		$html .= 'data-day-label="' . esc_attr($day_label) . '"';
		$html .= 'data-hour-label="' . esc_attr($hour_label) . '"';
		$html .= 'data-minute-label="' . esc_attr($minute_label) . '"';
		$html .= 'data-second-label="' . esc_attr($second_label) . '"';
		$html .= 'data-digit-size="' . esc_attr($digit_font_size) . '"';
		$html .= 'data-digit-color="' . esc_attr($digit_color) . '"';
		$html .= 'data-label-size="' . esc_attr($label_font_size) . '"';
		$html .= '></div>';

		return $html;
	}
}
add_shortcode('countdown', 'countdown');

/* Custom font shortcode */

if (!function_exists('custom_font')) {
	function custom_font($atts, $content = null) {
		$args = array(
			"font_family"       => "",
			"font_size"         => "",
			"line_height"       => "",
			"font_style"        => "",
			"font_weight"       => "",
			"color"             => "",
			"text_decoration"   => "",
			"text_shadow"       => "",
			"letter_spacing"    => "",
			"background_color"  => "",
			"padding"           => "",
			"margin"            => "",
			"text_align"        => "left"
		);
		extract(shortcode_atts($args, $atts));

		$html = '';
		$html .= '<div class="custom_font_holder" style="';
		if($font_family != "") {
			$html .= 'font-family: '.$font_family.';';
		}

		if($font_size != "") {
			$html .= ' font-size: '.$font_size.'px;';
		}

		if($line_height != "") {
			$html .= ' line-height: '.$line_height.'px;';
		}

		if($font_style != "") {
			$html .= ' font-style: '.$font_style.';';
		}

		if($font_weight != "") {
			$html .= ' font-weight: '.$font_weight.';';
		}

		if($color != ""){
			$html .= ' color: '.$color.';';
		}

		if($text_decoration != "") {
			$html .= ' text-decoration: '.$text_decoration.';';
		}

		if($text_shadow == "yes") {
			$html .= ' text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);';
		}

		if($letter_spacing != "") {
			$html .= ' letter-spacing: '.$letter_spacing.'px;';
		}

		if($background_color != "") {
			$html .= ' background-color: '.$background_color.';';
		}

		if($padding != "") {
			$html .= ' padding: '.$padding.';';
		}

		if($margin != "") {
			$html .= ' margin: '.$margin.';';
		}

		$html .= ' text-align: ' . $text_align . ';';
		$html .= '"><span>'.$content.'</span></div>';
		return $html;
	}
}
add_shortcode('custom_font', 'custom_font');

/* Cover Boxes shortcode */

if (!function_exists('cover_boxes')) {
	function cover_boxes($atts, $content = null) {
		$args = array(
			"active_element"    			=> "1",
			"title_tag"    					=> "h4",
			"title1"            			=> "",
			"title_color1"      			=> "",
			"text1"             			=> "",
			"text_color1"       			=> "",
			"image1"            			=> "",
			"link1"             			=> "",
			"link_label1"       			=> "",
			"link_target1"      			=> "",
			"title2"            			=> "",
			"title_color2"      			=> "",
			"text2"             			=> "",
			"text_color2"       			=> "",
			"image2"            			=> "",
			"link2"             			=> "",
			"link_label2"       			=> "",
			"link_target2"      			=> "",
			"title3"            			=> "",
			"title_color3"      			=> "",
			"text3"             			=> "",
			"text_color3"       			=> "",
			"image3"            			=> "",
			"link3"             			=> "",
			"link_label3"       			=> "",
			"link_target3"      			=> "",
			"read_more_button_style"      	=> ""
		);
		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		$html = "";
		$html .= "<div class='cover_boxes' data-active-element='".$active_element."'><ul class='clearfix'>";

		$html .= "<li>";
		$html .= "<div class='box'>";
		if($link_target1 != ""){
			$target1 = $link_target1;
		}else{
			$target1 = "_self";
		}
		if(is_numeric($image1)) {
			$image_src1 = wp_get_attachment_url( $image1 );
		}else {
			$image_src1 = $image1;
		}
		if(is_numeric($image2)) {
			$image_src2 = wp_get_attachment_url( $image2 );
		}else {
			$image_src2 = $image2;
		}
		if(is_numeric($image3)) {
			$image_src3 = wp_get_attachment_url( $image3 );
		}else {
			$image_src3 = $image3;
		}
		$html .= "<a class='thumb' href='".$link1."' target='".$target1."'><img alt='".$title1."' src='".$image_src1."' /></a>";
		if($title_color1 != ""){
			$color1 = " style='color:".$title_color1."''";
		}else{
			$color1 = "";
		}
		if($text_color1 != ""){
			$t_color1 = " style='color:".$text_color1."''";
		}else{
			$t_color1 = "";
		}
		$html .= "<div class='box_content'><".$title_tag." ".$color1." class='cover_box_title'>".$title1."</".$title_tag.">";
		$html .= "<p ".$t_color1.">".$text1."</p>";

		$button_class = "";
		$button_class_wrapper_open = "";
		$button_class_wrapper_close = "";
		if($read_more_button_style != "no"){
			$button_class = "qbutton small";
		}else {
			$button_class = "cover_boxes_read_more";
			$button_class_wrapper_open = "<h5>";
			$button_class_wrapper_close = "</h5>";
		}

		if($link_label1 != "") {
			$html .= $button_class_wrapper_open . "<a class='".$button_class."' href='".$link1."' target='".$target1."'>".$link_label1."</a>" . $button_class_wrapper_close;
		}

		$html .= "</div></div>";
		$html .= "</li>";

		$html .= "<li>";
		$html .= "<div class='box'>";
		if($link_target2 != ""){
			$target2 = $link_target2;
		}else{
			$target2 = "_self";
		}
		$html .= "<a class='thumb' href='".$link2."' target='".$target2."'><img alt='".$title2."' src='".$image_src2."' /></a>";
		if($title_color2 != ""){
			$color2 = " style='color:".$title_color2."''";
		}else{
			$color2 = "";
		}
		if($text_color2 != ""){
			$t_color2 = " style='color:".$text_color2."''";
		}else{
			$t_color2 = "";
		}
		$html .= "<div class='box_content'><".$title_tag." ".$color2." class='cover_box_title'>".$title2."</".$title_tag.">";
		$html .= "<p ".$t_color2.">".$text2."</p>";

		if($link_label2 != "") {
			$html .= $button_class_wrapper_open . "<a class='".$button_class."' href='".$link2."' target='".$target2."'>".$link_label2."</a>" . $button_class_wrapper_close;
		}

		$html .= "</div></div>";
		$html .= "</li>";

		$html .= "<li>";
		$html .= "<div class='box'>";
		if($link_target3 != ""){
			$target3 = $link_target3;
		}else{
			$target3 = "_self";
		}
		$html .= "<a class='thumb' href='".$link3."' target='".$target3."'><img alt='".$title3."' src='".$image_src3."' /></a>";
		if($title_color3 != ""){
			$color3 = " style='color:".$title_color3."''";
		}else{
			$color3 = "";
		}
		if($text_color3 != ""){
			$t_color3 = " style='color:".$text_color3."''";
		}else{
			$t_color3 = "";
		}
		$html .= "<div class='box_content'><".$title_tag." ".$color3." class='cover_box_title'>".$title3."</".$title_tag.">";
		$html .= "<p ".$t_color3.">".$text3."</p>";

		if($link_label3 != "") {
			$html .= $button_class_wrapper_open . "<a class='".$button_class."' href='".$link3."' target='".$target3."'>".$link_label3."</a>" . $button_class_wrapper_close;
		}

		$html .= "</div></div>";
		$html .= "</li>";

		$html .= "</ul></div>";
		return $html;
	}
}
add_shortcode('cover_boxes', 'cover_boxes');

/* Dropcaps shortcode */

if (!function_exists('dropcaps')) {
	function dropcaps($atts, $content = null) {
		$args = array(
			"color"             => "",
			"background_color"  => "",
			"border_color"      => "",
			"type"              => ""
		);
		extract(shortcode_atts($args, $atts));

		$html = "<span class='q_dropcap ".$type."' style='";
		if($background_color != ""){
			$html .= "background-color: $background_color;";
		}
		if($color != ""){
			$html .= " color: $color;";
		}
		if($border_color != ""){
			$html .= " border-color: $border_color;";
		}
		$html .= "'>" . $content  . "</span>";

		return $html;
	}
}
add_shortcode('dropcaps', 'dropcaps');

/* Highlights shortcode */

if (!function_exists('highlight')) {
	function highlight($atts, $content = null) {
		extract(shortcode_atts(array("color"=>"","background_color"=>""), $atts));
		$html =  "<span class='highlight'";
		if($color != "" || $background_color != ""){
			$html .= " style='color: ".$color."; background-color:".$background_color.";'";
		}
		$html .= ">" . $content . "</span>";
		return $html;
	}
}
add_shortcode('highlight', 'highlight');

//Icon shortcode
if(!function_exists('icons')) {
	function icons($atts, $content = null) {
		$default_atts = array(
			"icon_pack"            		=> "",
			"fa_size"              		=> "",
			"custom_size"          		=> "",
			"fa_icon"              		=> "",
			"fe_icon"              		=> "",
			"linear_icon"          		=> "",
			"type"                 		=> "",
			"position"             		=> "",
			"border_color"         		=> "",
			"border_hover_color"   		=> "",
			"border_width"         		=> "",
			"border_radius"				=> "",
			"icon_color"           		=> "",
			"icon_hover_color"     		=> "",
			"background_color"     		=> "",
			"background_hover_color"    => "",
			"margin"               		=> "",
			"icon_animation"       		=> "",
			"icon_animation_delay" 		=> "",
			"link"                 		=> "",
			"target"               		=> ""
		);

		extract(shortcode_atts($default_atts, $atts));

		$html = "";
		if($fa_icon != "" || $fe_icon != "" || $linear_icon != "") {

			if ($icon_pack == 'font_awesome' && $fa_icon != '')
				$size = $fa_size;

			//generate inline icon styles
			$icon_stack_classes    = '';
			$animation_delay_style = '';
			$icon_link_style       = '';

			//generate icon stack styles
			$icon_stack_style         = '';
			$icon_stack_circle_styles = '';
			$icon_stack_square_styles = '';
			$icon_stack_normal_style  = '';
			$icon_stack_font_size     = '';
			$data_attr              = "";

			if($background_hover_color != "") {
				$data_attr .= "data-hover-background-color=".$background_hover_color." ";
			}

			if($border_hover_color != "") {
				$data_attr .= "data-hover-border-color=".$border_hover_color." ";
			}

			if($icon_hover_color != "") {
				$data_attr .= "data-hover-color=".$icon_hover_color." ";
			}

			if($custom_size != "") {
				$icon_stack_normal_style .= 'font-size: '.$custom_size;

				if(($fe_icon != "" && $icon_pack == 'font_elegant') || ($linear_icon != "" && $icon_pack == 'linear_icons')){
					$icon_stack_circle_styles .= 'padding: 1.5em;';
					$icon_stack_square_styles .= 'padding: 1.5em;';
				} else {
					$icon_stack_circle_styles .= 'font-size: '.$custom_size;
					$icon_stack_square_styles .= 'font-size: '.$custom_size;
				}

				if(!strstr($custom_size, 'px') && $icon_pack != 'font_elegant' && $icon_pack != 'linear_icons') {
					$icon_stack_normal_style .= 'px;';
					$icon_stack_circle_styles .= 'px;';
					$icon_stack_square_styles .= 'px;';
				}

				if(!strstr($custom_size, 'px') && $icon_stack_normal_style != '') {
					$icon_stack_normal_style .= 'px;';
				}

				//generate inline icon styles
				if(($fe_icon != "" && $icon_pack == 'font_elegant') || ($linear_icon != "" && $icon_pack == 'linear_icons')) {
					$icon_stack_font_size	.= 'font-size: '.$custom_size.'px;';
				}
			}
			if($icon_color != "") {
				$icon_stack_normal_style .= 'color: '.$icon_color.';';
				$icon_stack_style .= 'color: '.$icon_color.';';
			}

			if($position != "") {
				$icon_stack_classes .= 'pull-'.$position;
			}

			if($background_color != "") {
				$icon_stack_style .= 'background-color: '.$background_color.';';
			}

			if($border_color != "") {
				$icon_stack_style .= 'border-color: '.$border_color.';';
			}

			if($border_width != "") {
				$icon_stack_style .= 'border-width: '.$border_width.'px;';
			}

			if($border_radius != "") {
				$icon_stack_square_styles .= 'border-radius: '.$border_radius.'px;';
			}

			if($icon_animation_delay != ""){
				$animation_delay_style .= 'transition-delay: '.$icon_animation_delay.'ms; -webkit-transition-delay: '.$icon_animation_delay.'ms; -moz-transition-delay: '.$icon_animation_delay.'ms; -o-transition-delay: '.$icon_animation_delay.'ms;';
			}

			if($margin != "") {
				$icon_stack_style .= 'margin: '.$margin.';';
				$icon_stack_normal_style .= 'margin: '.$margin.';';
			}

			switch ($type) {
				case 'circle':
					if($icon_pack == 'font_awesome' && $fa_icon != ''){

						$html = '<span class="fa-stack q_icon_shortcode circle q_font_awsome_icon_holder q_font_awsome_icon_circle '.$size.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_style.$icon_stack_circle_styles.' '.$animation_delay_style.'"'. $data_attr . '>';
						if($link != ""){
							$html .= '<a href="'.$link.'" target="'.$target.'">';
						}
						$html .= '<i class="fa '.$fa_icon.'"></i>';

					} elseif($icon_pack == 'font_elegant' && $fe_icon != ''){

						$html = '<span class="q_font_elegant_holder q_icon_shortcode '.$type.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_style.$icon_stack_circle_styles.' '.$animation_delay_style.'"'. $data_attr . '>';
						if($link != ""){
							$html .= '<a href="'.$link.'" target="'.$target.'">';
						}
						$html .= '<span class="q_font_elegant_icon '.$fe_icon.'" aria-hidden="true" style="'.$icon_stack_font_size.'"></span>';

					} elseif($icon_pack == 'linear_icons' && $linear_icon != ''){

						$html = '<span class="q_icon_shortcode q_linear_icons_holder '.$type.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_style.$icon_stack_circle_styles.' '.$animation_delay_style.'"'. $data_attr . '>';
						if($link != ""){
							$html .= '<a href="'.$link.'" target="'.$target.'">';
						}
						$html .= '<i class="lnr q_linear_icons_icon '.$linear_icon.'" style="'.$icon_stack_font_size.'"></i>';

					}
					break;
				case 'square':
					if($icon_pack == 'font_awesome' && $fa_icon != ''){

						$html = '<span class="fa-stack q_font_awsome_icon_holder q_icon_shortcode square q_font_awsome_icon_square '.$size.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_style.$icon_stack_square_styles.' '.$animation_delay_style.'"'. $data_attr . '>';
						if($link != ""){
							$html .= '<a href="'.$link.'" target="'.$target.'">';
						}
						$html .= '<i class="fa '.$fa_icon.'"></i>';

					} elseif($icon_pack == 'font_elegant' && $fe_icon != ''){

						$html = '<span class="q_font_elegant_holder q_icon_shortcode '.$type.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_style.$icon_stack_square_styles.' '.$animation_delay_style.'"'. $data_attr . '>';
						if($link != ""){
							$html .= '<a href="'.$link.'" target="'.$target.'">';
						}
						$html .= '<span class="q_font_elegant_icon '.$fe_icon.'" aria-hidden="true" style="'.$icon_stack_font_size.'"></span>';

					} elseif($icon_pack == 'linear_icons' && $linear_icon != ''){

						$html = '<span class="q_linear_icons_holder q_icon_shortcode '.$type.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_style.$icon_stack_square_styles.' '.$animation_delay_style.'"'. $data_attr . '>';
						if($link != ""){
							$html .= '<a href="'.$link.'" target="'.$target.'">';
						}
						$html .= '<i class="lnr q_linear_icons_icon '.$linear_icon.'"  style="'.$icon_stack_font_size.'"></i>';

					}
					break;
				default:
					if($icon_pack == 'font_awesome' && $fa_icon != ''){

						$html = '<span class="q_font_awsome_icon q_icon_shortcode normal q_font_awsome_icon_holder '.$size.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_normal_style.' '.$animation_delay_style.'"'. $data_attr . '>';
						if($link != ""){
							$html .= '<a href="'.$link.'" target="'.$target.'">';
						}
						$html .= '<i class="fa '.$fa_icon.'"></i>';

					} elseif($icon_pack == 'font_elegant' && $fe_icon != ''){

						$html = '<span class="q_font_elegant_holder q_icon_shortcode '.$type.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_normal_style.' '.$animation_delay_style.'"'. $data_attr . '>';
						if($link != ""){
							$html .= '<a href="'.$link.'" target="'.$target.'">';
						}
						$html .= '<span class="q_font_elegant_icon '.$fe_icon.'" aria-hidden="true" style="'.$icon_stack_font_size.'"></span>';

					} elseif($icon_pack == 'linear_icons' && $linear_icon != ''){

						$html = '<span class="q_font_elegant_holder q_icon_shortcode '.$type.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_normal_style.' '.$animation_delay_style.'"'. $data_attr . '>';
						if($link != ""){
							$html .= '<a href="'.$link.'" target="'.$target.'">';
						}
						$html .= '<i class="lnr q_linear_icons_icon '.$linear_icon.'"  style="'.$icon_stack_font_size.'"></i>';

					}
					break;
			}

			if($link != ""){
				$html .= '</a>';
			}

			$html.= '</span>';
		}
		return $html;
	}
}
add_shortcode('icons', 'icons');

/* Icon with text shortcode */

if(!function_exists('icon_text')) {
	function icon_text($atts, $content = null) {
		$default_atts = array(
			"icon_size"             		=> "",
			"custom_icon_size"      		=> "20",
			"text_left_padding"     		=> "86",
			"icon_pack"             		=> "",
			"fa_icon"               		=> "",
			"fe_icon"               		=> "",
			"linear_icon"              		=> "",
			"custom_icon_image"             => "",
			"icon_animation"        		=> "",
			"icon_animation_delay"  	 	=> "",
			"icon_type"             	 	=> "",
			"icon_border_width"       	 	=> "",
			"without_double_border_icon" 	=> "",
			"icon_position"         		=> "",
			"icon_border_color"     		=> "",
			"icon_margin"           		=> "",
			"icon_color"            		=> "",
			"icon_background_color" 		=> "",
			"box_type"              		=> "",
			"box_border"            		=> "",
			"box_border_color"      		=> "",
			"box_background_color"  		=> "",
			"title"                 		=> "",
			"title_tag"             		=> "h4",
			"title_color"           		=> "",
			"title_padding"         		=> "",
			"text"                  		=> "",
			"text_color"            		=> "",
			"link"                  		=> "",
			"link_text"             		=> "",
			"link_color"            		=> "",
			"target"                		=> ""
		);

		extract(shortcode_atts($default_atts, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		//init icon styles
		$style = '';
		$icon_stack_classes = '';

		//init icon stack styles
		$icon_margin_style       	= '';
		$icon_stack_square_style 	= '';
		$icon_stack_base_style   	= '';
		$icon_stack_style        	= '';
		$icon_stack_font_size       = '';
		$icon_holder_style          = '';
		$animation_delay_style   	= '';

		//generate inline icon styles
		if($custom_icon_size != "" && (($fe_icon != "" && $icon_pack == 'font_elegant') || ($linear_icon != "" && $icon_pack == 'linear_icons'))) {
			$icon_stack_style		.= 'font-size: '.$custom_icon_size.'px;';
			$icon_stack_font_size	.= 'font-size: '.$custom_icon_size.'px;';
		}

		if($icon_color != "") {
			$style .= 'color: '.$icon_color.';';
			$icon_stack_style .= 'color: '.$icon_color.';';
		}

		//generate icon stack styles
		if($icon_background_color != "") {
			$icon_stack_base_style .= 'background-color: '.$icon_background_color.';';
			$icon_stack_square_style .= 'background-color: '.$icon_background_color.';';
		}

		if($icon_border_width !== '') {
			$icon_stack_base_style .= 'border-width: '.$icon_border_width.'px;';
			$icon_holder_style .= 'border-width: '.$icon_border_width.'px;';
			$icon_stack_square_style .= 'border-width: '.$icon_border_width.'px;';
		}

		if($icon_border_color != "") {
			$icon_stack_style .= 'border-color: '.$icon_border_color.';';
			$icon_holder_style .= 'border-color: '.$icon_border_color.';';
		}

		if($icon_margin != "") {
			$icon_margin_style .= "margin: ".$icon_margin.";";
		}

		if($icon_animation_delay != "" && $icon_animation == "q_icon_animation"){
			$animation_delay_style .= 'transition-delay: '.$icon_animation_delay.'ms; -webkit-transition-delay: '.$icon_animation_delay.'ms; -moz-transition-delay: '.$icon_animation_delay.'ms; -o-transition-delay: '.$icon_animation_delay.'ms;';
		}

		$box_size = '';
		//generate icon text holder styles and classes

		//map value of the field to the actual class value

		if($icon_pack == 'font_awesome' && $fa_icon != ''){

			switch ($icon_size) {
				case 'large': //smallest icon size
					$box_size = 'tiny';
					break;
				case 'fa-2x':
					$box_size = 'small';
					break;
				case 'fa-3x':
					$box_size = 'medium';
					break;
				case 'fa-4x':
					$box_size = 'large';
					break;
				case 'fa-5x':
					$box_size = 'very_large';
					break;
				default:
					$box_size = 'tiny';
			}
		}

		$box_icon_type = '';
		switch ($icon_type) {
			case 'normal':
				$box_icon_type = 'normal_icon';
				break;
			case 'square':
				$box_icon_type = 'square';
				break;
			case 'circle':
				$box_icon_type = 'circle';
				break;
		}

		$html = "";
		$html_icon = "";
		$html_custom_icon = "";

		//genererate icon html
		switch ($icon_type) {
			case 'circle':
				//if custom icon size is set and if it is larger than large icon size
				if($custom_icon_size != "") {
					//add custom font class that has smaller inner icon font
					$icon_stack_classes .= ' custom-font';
				}

				if($icon_pack == 'font_awesome' && $fa_icon != ''){
					$html_icon .= '<span class="fa-stack '.$icon_size.' '.$icon_stack_classes.'" style="'.$icon_stack_style . $icon_stack_base_style .'">';
					$html_icon .= '<i class="icon_text_icon fa '.$fa_icon.' fa-stack-1x"></i>';
					$html_icon .= '</span>';
				}elseif($icon_pack == 'font_elegant' && $fe_icon != ''){
					$html_icon .= '<span class="q_font_elegant_holder '.$icon_type.' '.$icon_stack_classes.'" style="'.$icon_stack_style.$icon_stack_base_style.'">';
					$html_icon .= '<span class="icon_text_icon q_font_elegant_icon '.$fe_icon.'" aria-hidden="true" style="'.$icon_stack_font_size.'"></span>';
					$html_icon .= '</span>';
				}elseif($icon_pack == 'linear_icons' && $linear_icon != ''){
					$html_icon .= '<span class="q_linear_icons_holder '.$icon_type.' '.$icon_stack_classes.'" style="'.$icon_stack_style.$icon_stack_base_style.'">';
					$html_icon .= '<i class="icon_text_icon q_linear_icons_icon lnr '.$linear_icon.'" style="'.$icon_stack_font_size.'"></i>';
					$html_icon .= '</span>';
				}

				break;
			case 'square':
				//if custom icon size is set and if it is larget than large icon size
				if($custom_icon_size != "") {
					//add custom font class that has smaller inner icon font
					$icon_stack_classes .= ' custom-font';
				}

				if($icon_pack == 'font_awesome' && $fa_icon != ''){
					$html_icon .= '<span class="fa-stack '.$icon_size.' '.$icon_stack_classes.'" style="'.$icon_stack_style.$icon_stack_square_style.'">';
					$html_icon .= '<i class="icon_text_icon fa '.$fa_icon.' fa-stack-1x"></i>';
					$html_icon .= '</span>';
				}elseif($icon_pack == 'font_elegant' && $fe_icon != ''){
					$html_icon .= '<span class="q_font_elegant_holder '.$icon_type.' '.$icon_stack_classes.'" style="'.$icon_stack_style.$icon_stack_square_style.'">';
					$html_icon .= '<span class="icon_text_icon q_font_elegant_icon '.$fe_icon.'" aria-hidden="true" style="'.$icon_stack_font_size.'" ></span>';
					$html_icon .= '</span>';
				}elseif($icon_pack == 'linear_icons' && $linear_icon != ''){
					$html_icon .= '<span class="q_linear_icons_holder '.$icon_type.' '.$icon_stack_classes.'" style="'.$icon_stack_style.$icon_stack_square_style.'">';
					$html_icon .= '<span class="icon_text_icon lnr q_linear_icons_icon '.$linear_icon.'" style="'.$icon_stack_font_size.'" ></span>';
					$html_icon .= '</span>';
				}

				break;
			default:

				if($icon_pack == 'font_awesome' && $fa_icon != ''){
					$html_icon .= '<span style="'.$icon_stack_style.'" class="q_font_awsome_icon '.$icon_size.' '.$icon_stack_classes.'">';
					$html_icon .= '<i class="icon_text_icon fa '.$fa_icon.'"></i>';
					$html_icon .= '</span>';
				}elseif($icon_pack == 'font_elegant' && $fe_icon != ''){
					$html_icon .= '<span class="q_font_elegant_holder '.$icon_type.' '.$icon_stack_classes.'" style="'.$icon_stack_style.'">';
					$html_icon .= '<span class="icon_text_icon q_font_elegant_icon '.$fe_icon.'" aria-hidden="true" style="'.$icon_stack_font_size.'"></span>';
					$html_icon .= '</span>';
				}elseif($icon_pack == 'linear_icons' && $linear_icon != ''){
					$html_icon .= '<span class="q_linear_icons_holder '.$icon_type.' '.$icon_stack_classes.'" style="'.$icon_stack_style.'">';
					$html_icon .= '<i class="icon_text_icon lnr q_linear_icons_icon '.$linear_icon.'" aria-hidden="true" style="'.$icon_stack_font_size.'"></i>';
					$html_icon .= '</span>';
				}elseif($icon_pack == 'custom_icon' && $custom_icon_image != '') {
					$html_icon .= wp_get_attachment_image($custom_icon_image, 'full');
				}

				break;
		}

		$title_style = "";
		if($title_color != "") {
			$title_style .= "color: ".$title_color;
		}

		$text_style = "";
		if($text_color != "") {
			$text_style .= "color: ".$text_color;
		}

		$link_style = "";

		if($link_color != "") {
			$link_style .= "color: ".$link_color.";";
		}

		//generate normal type of a box html
		if($box_type == "normal") {

			//init icon text wrapper styles
			$icon_with_text_clasess = '';
			$icon_with_text_style   = '';
			$icon_text_inner_style  = '';
			$icon_text_holder_style = '';

			$icon_with_text_clasess .= $box_size;
			$icon_with_text_clasess .= ' '.$box_icon_type;

			if($box_border == "yes") {
				$icon_with_text_clasess .= ' with_border_line';
			}

			if($without_double_border_icon == 'yes') {
				$icon_with_text_clasess .= ' without_double_border';
			}

			if($text_left_padding != "" && ($icon_pack == 'font_elegant' || $icon_pack == 'linear_icons') && $icon_position == "left"){
				$icon_text_holder_style .= 'padding-left: '.$text_left_padding.'px';
			}

			if($box_border == "yes" && $box_border_color != "") {
				$icon_text_inner_style .= 'border-color: '.$box_border_color;
			}

			if($icon_position == "" || $icon_position == "top") {
				$icon_with_text_clasess .= " center";
			}
			if($icon_position == "left_from_title"){
				$icon_with_text_clasess .= " left_from_title";
			}
			if($icon_pack == 'custom_icon') {
				$icon_with_text_clasess .= " with_custom_icon";
			}

			$html .= "<div class='q_icon_with_title ".$icon_with_text_clasess."'>";
			if($icon_position != "left_from_title") {
				//generate icon holder html part with icon
				$html .= '<div class="icon_holder '.$icon_animation.'" style="'.$icon_margin_style.' '.$animation_delay_style.'">';
				$html .= '<div class="icon_holder_inner">';
				$html .= $html_icon;
				$html .= '</div>'; // close icon_holder_inner
				$html .= '</div>'; //close icon_holder
			}

			//generate text html
			$html .= '<div class="icon_text_holder" style="'.$icon_text_holder_style.'">';
			$html .= '<div class="icon_text_inner" style="'.$icon_text_inner_style.'">';
			if($icon_position == "left_from_title") {
				$html .= '<div class="icon_title_holder">'; //generate icon_title holder for icon from title
				//generate icon holder html part with icon
				$html .= '<div class="icon_holder '.$icon_animation.'" style="'.$icon_margin_style.' '.$animation_delay_style.'">';
				$html .= '<div class="icon_holder_inner">';
				$html .= $html_icon;
				$html .= '</div>'; //close icon_holder_inner
				$html .= '</div>'; //close icon_holder
			}
			$html .= '<'.$title_tag.' class="icon_title" style="'.$title_style.'">'.$title.'</'.$title_tag.'>';
			if($icon_position == "left_from_title") {
				$html .= '</div>'; //close icon_title holder for icon from title
			}
			$html .= "<p style='".$text_style."'>".$text."</p>";
			if($link != ""){
				if($target == ""){
					$target = "_self";
				}

				if($link_text == ""){
					$link_text = "READ MORE";
				}

				$html .= "<a class='icon_with_title_link' href='".$link."' target='".$target."' style='".$link_style."'>".$link_text."</a>";
			}
			$html .= '</div>';  //close icon_text_inner
			$html .= '</div>'; //close icon_text_holder

			$html.= '</div>'; //close icon_with_title
		} else {
			//init icon text wrapper styles
			$icon_with_text_clasess = '';
			$box_holder_styles = '';

			if($box_border_color != "") {
				$box_holder_styles .= 'border-color: '.$box_border_color.';';
			}

			if($box_background_color != "") {
				$box_holder_styles .= 'background-color: '.$box_background_color.';';
			}

			if($title_padding != ""){
				$valid_title_padding = (strstr($title_padding, 'px', true)) ? $title_padding : $title_padding.'px';
				$title_style .= 'padding-top: '.$valid_title_padding.';';
			}

			$icon_with_text_clasess .= $box_size;
			$icon_with_text_clasess .= ' '.$box_icon_type;

			if($without_double_border_icon == 'yes') {
				$icon_with_text_clasess .= ' without_double_border';
			}

			if($icon_pack == 'custom_icon') {
				$icon_with_text_clasess .= " with_custom_icon";
			}

			$html .= '<div class="q_box_holder with_icon" style="'.$box_holder_styles.'">';

			$html .= '<div class="box_holder_icon">';
			$html .= '<div class="box_holder_icon_inner '.$icon_with_text_clasess.' '.$icon_animation.'" style="'.$animation_delay_style.'">';
			$html .= '<div class="icon_holder_inner">';
			$html .= $html_icon;
			$html .= '</div>'; //close icon_holder_inner
			$html .= '</div>'; //close box_holder_icon_inner
			$html .= '</div>'; //close box_holder_icon

			//generate text html
			$html .= '<div class="box_holder_inner '.$box_size.' center">';
			$html .= '<'.$title_tag.' class="icon_title" style="'.$title_style.'">'.$title.'</'.$title_tag.'>';
			$html .= '<p style="'.$text_style.'">'.$text.'</p>';
			$html .= '</div>'; //close box_holder_inner

			$html .= '</div>'; //close box_holder
		}

		return $html;

	}
}
add_shortcode('icon_text', 'icon_text');

/* Image hover shortcode */

if (!function_exists('image_hover')) {

	function image_hover($atts, $content = null) {
		$args = array(	
			"image"             	=> "",
			"hover_image"       	=> "",
			"link"             		=> "",
			"target"            	=> "_self",
			"animation"         	=> "",
			"animation_speed"       => "",
			"transition_delay" 		=> ""
		);

		extract(shortcode_atts($args, $atts));

		//init variables
		$html               = "";
		$image_classes      = "";
		$image_src          = $image;
		$hover_image_src    = $hover_image;
		$image_alt          = "";
		$hover_image_alt    = "";
		$images_styles      = "";

		if($animation_speed != "") {
			$transition_property = "opacity ".$animation_speed."s ease-in-out";
			$images_styles .= " -webkit-transition: ".$transition_property."; -ms-transition:  ".$transition_property."; -moz-transition:  ".$transition_property."; -o-transition:  ".$transition_property."; transition:  ".$transition_property.";";
		}

		if (is_numeric($image)) {
			$image_src = wp_get_attachment_url($image);
			$image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
		}

		if (is_numeric($hover_image)) {
			$hover_image_src = wp_get_attachment_url($hover_image);
			$hover_image_alt = get_post_meta($hover_image, '_wp_attachment_image_alt', true);
		}

		if($hover_image_src != "") {
			$image_classes .= "active_image ";
		}

		$css_transition_delay = ($transition_delay != "" && $transition_delay > 0) ? $transition_delay / 1000 . "s" : "";

		$animate_class = ($animation == "yes") ? "hovered" : "";

		//generate output
		$html .= "<div class='image_hover {$animate_class}' style='' data-transition-delay='{$transition_delay}'>";
		$html .= "<div class='images_holder'>";

		if($link != "") {
			$html .= "<a href='{$link}' target='{$target}'>";
		}

		$html .= "<img class='{$image_classes}' src='{$image_src}' alt='{$image_alt}' style='{$images_styles}' />";
		$html .= "<img class='hover_image' src='{$hover_image_src}' alt='{$hover_image_alt}' style='{$images_styles}' />";

		if($link != "") {
			$html .= "</a>";
		}

		$html .= "</div>"; //close image_hover
		$html .= "</div>"; //close images_holder

		return $html;
	}

	add_shortcode('image_hover', 'image_hover');
}

/* Icon List Item shortcode */

if (!function_exists('icon_list_item')) {
	function icon_list_item($atts, $content = null) {
		$args = array(
			"icon_pack"                => "",
			"fa_icon"                  => "",
			"fe_icon"                  => "",
			"linear_icon"              => "",
			"icon_type"                => "",
			"icon_color"               => "",
			"border_type"              => "",
			"border_color"             => "",
			"title"                    => "",
			"title_color"              => "",
			"title_size"               => ""
		);

		extract(shortcode_atts($args, $atts));

		$html           = '';
		$icon_style     = "";
		$icon_classes   = "";
		$title_style    = "";

		$icon_classes .= $icon_type." ";

		if($icon_color != "") {
			$icon_style .= "color:".$icon_color.";";
		}

		if($border_color != "" && $border_type != "") {
			$icon_style .= "border-color: ".$border_color.";";
		}

		if($title_color != "") {
			$title_style .= "color:".$title_color.";";
		}

		if($title_size != "") {
			$title_style .= "font-size: ".$title_size."px;";
		}

		$html .= '<div class="q_icon_list">';
		if($icon_pack == 'font_awesome' && $fa_icon != ''){

			$html .= '<i class="fa '.$fa_icon.' '.$icon_classes.' '.$border_type.'" style="'.$icon_style.'"></i>';

		} elseif($icon_pack == 'font_elegant' && $fe_icon != ''){

			$html .= '<span class="q_font_elegant_icon '.$fe_icon.' '.$icon_classes.' '.$border_type.'" aria-hidden="true" style="'.$icon_style.'"></span>';

		} elseif($icon_pack == 'linear_icons' && $linear_icon != ''){

			$html .= '<i class="lnr q_linear_icons_icon '.$linear_icon.' '.$icon_classes.' '.$border_type.'" aria-hidden="true" style="'.$icon_style.'"></i>';
		}

		$html .= '<p class="'.$icon_classes.'" style="'.$title_style.'">'.$title.'</p>';
		$html .= '</div>';
		return $html;
	}
}
add_shortcode('icon_list_item', 'icon_list_item');

/* Image with text shortcode */

if (!function_exists('image_with_text')) {

	function image_with_text($atts, $content = null) {
		$args = array(
			"image" => "",
			"title" => "",
			"title_color" => "",
			"title_tag" => "h5"
		);
		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		$html      = '';
		$image_alt = '';
		$html .= '<div class="image_with_text">';
		if (is_numeric($image)) {
			$image_src = wp_get_attachment_url($image);
			$image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
		} else {
			$image_src = $image;
			$image_alt = $title;
		}
		$html .= '<img src="' . $image_src . '" alt="' . $image_alt . '" />';
		$html .= '<'.$title_tag.' ';
		if ($title_color != "") {
			$html .= 'style="color:' . $title_color . ';"';
		}
		$html .= '>' . $title . '</'.$title_tag.'>';
		$html .= '<span style="margin: 6px 0px;" class="separator transparent"></span>';
		$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}

	add_shortcode('image_with_text', 'image_with_text');
}

/* Image with text over shortcode */

if (!function_exists('interactive_banners')) {

	function interactive_banners($atts, $content = null) {
		$args = array(
			"layout_width"           => "",
			"image"                  => "",   
			"icon_pack"              => "",
			"fa_icon"                => "",
			"fe_icon"                => "",
			"linear_icon"            => "",
			"icon_custom_size"       => "45",
			"icon_color"             => "",
			"title"                  => "",
			"title_color"            => "",
			"title_size"             => "21",
			"title_tag"              => "h4",
			"subtitle"               => "",
			"subtitle_color"         => "",
			"subtitle_size"          => "17",
			"subtitle_tag"           => "h3",
			"link"                   => "",
			"link_text"              => "SEE MORE",
			"target"                 => "_self",
			"link_color"             => "",
			"link_border_color"      => "",
			"link_background_color"  => ""
		);

		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		//init variables
		$html            = "";
		$title_styles    = "";
		$subtitle_styles = "";
		$icon_styles     = "";
		$link_style      = "";
		$icon_font_style = "";
		$image_alt       = "";

		//generate styles
		if($title_color != "") {
			$title_styles .= "color: ".$title_color.";";
		}

		if($title_size != "") {
			$valid_title_size = (strstr($title_size, 'px', true)) ? $title_size : $title_size.'px';
			$title_styles .= "font-size: ".$valid_title_size.";";
		}

		if($subtitle_color != "") {
			$subtitle_styles .= "color: ".$subtitle_color.";";
		}

		if($subtitle_size != "") {
			$valid_title_size = (strstr($subtitle_size, 'px', true)) ? $subtitle_size : $subtitle_size.'px';
			$subtitle_styles .= "font-size: ".$valid_title_size.";";
		}

		$icon_styles .= "style='";

		if($icon_color != "") {
			$icon_styles .= "color: ".$icon_color.";";
		}

		if($icon_custom_size != "") {
			$icon_font_style .= ' font-size: '.$icon_custom_size;
			if(!strstr($icon_custom_size, 'px')) {
				$icon_font_style .= 'px;';
			}
			$icon_styles .= $icon_font_style;
		}

		$icon_styles .= "'";

		if (is_numeric($image)) {
			$image_src = wp_get_attachment_url($image);
			$image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
		} else {
			$image_src = $image;
			$image_alt = $title;
		}

		if($link_color != ""){
			$link_style .= "color: ".$link_color.";";
		}

		if($link_border_color != ""){
			$link_style .= "border-color: ".$link_border_color.";";
		}

		if($link_background_color != ""){
			$link_style .= "background-color: ".$link_background_color.";";
		}

		//generate output
		$html .= '<div class="q_image_with_text_over '.$layout_width.'">';
			$html .= '<div class="shader"></div>';

			$html .= '<img src="' . $image_src . '" alt="' . $image_alt . '" />';

			
				//title and subtitle html
				$html .= '<div class="front_holder"><div class="front_holder_inner"><div class="front_holder_inner2">';
					if($icon_pack == 'font_awesome' && $fa_icon != ""){
						$html .= '<i class="icon_holder fa '.$fa_icon.'" '.$icon_styles .'></i>';
					}elseif($icon_pack == 'font_elegant' && $fe_icon != ""){
						$html .= '<span class="icon_holder q_font_elegant_icon '.$fe_icon.'" aria-hidden="true" '.$icon_styles .'></span>';
					}elseif($icon_pack == 'linear_icons' && $linear_icon != ""){
						$html .= '<i class="icon_holder lnr q_linear_icons_icon '.$linear_icon.'" '.$icon_styles .'></i>';
					}
					$html .= '<'.$subtitle_tag.' class="front_subtitle" style="'.$subtitle_styles.'">'.$subtitle.'</'.$subtitle_tag.'>';
					$html .= '<'.$title_tag.' class="front_title" style="'.$title_styles.'">'.$title.'</'.$title_tag.'>';
				$html .= '</div></div></div>';

				//image description html which appears on mouse hover
				$html .= '<div class="back_holder"><div class="back_holder_inner"><div class="back_holder_inner2">';
					$html .= do_shortcode($content);

					if($link != ""){
						$html .= '<a class="qbutton medium" htef="'.$link.'" target="'.$target.'" style="'.$link_style.'">'.$link_text.'</a>';
					}
				$html .= '</div></div></div>';

			
		$html .= '</div>'; //close image_with_text_over

		return $html;
	}

	add_shortcode('interactive_banners', 'interactive_banners');
}

/* Latest posts shortcode */

if (!function_exists('latest_post')) {
	function latest_post($atts, $content = null) {
		$blog_hide_comments = "";
		if (isset($qode_options['blog_hide_comments'])) {
			$blog_hide_comments = $qode_options['blog_hide_comments'];
		}

		$qode_like = "on";
		if (isset($qode_options['qode_like'])) {
			$qode_like = $qode_options['qode_like'];
		}

		$args = array(
			"type"       			=> "boxes",
			"number_of_posts"       => "",
			"number_of_columns"     => "",
			"number_of_rows"        => "1",
			"rows"                  => "",
			"order_by"              => "",
			"order"                 => "",
			"category"              => "",
			"text_length"           => "",
			"title_tag"             => "h4",
			"display_category"    	=> "1",
			"display_date"          => "1",
			"display_author"		=> "1",
			"background_color"      => ""
		);

		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		//get proper number of posts based on type param
		$posts_number =$type != 'boxes' ? $number_of_posts : $number_of_columns*$number_of_rows;

		//run query to get posts
		$q = new WP_Query(array(
			'orderby' => $order_by,
			'order' => $order,
			'posts_per_page' => $posts_number,
			'category_name' => $category
		));

		//get number of columns class for boxes type
		$columns_number = "";
		if($type == 'boxes') {
			switch($number_of_columns) {
				case 1:
					$columns_number = 'one_column';
					break;
				case 2:
					$columns_number = 'two_columns';
					break;
				case 3:
					$columns_number = 'three_columns';
					break;
				case 4:
					$columns_number = 'four_columns';
					break;
				default:
					break;
			}
		}

		//get number of rows class for boxes type
		$rows_number = "";
		if($type == 'boxes') {
			switch($number_of_rows) {
				case 1:
					$rows_number = 'one_row';
					break;
				case 2:
					$rows_number = 'two_rows';
					break;
				case 3:
					$rows_number = 'three_rows';
					break;
				case 4:
					$rows_number = 'four_rows';
					break;
				case 5:
					$rows_number = 'five_rows';
					break;	
				default:
					break;
			}
		}

		$html = "";
		$html .= "<div class='latest_post_holder $type $columns_number $rows_number'>";
		$html .= "<ul>";

		while ($q->have_posts()) : $q->the_post();
			$li_classes = "";
			$box_style  = "";

			if($background_color != "" && $type == "boxes"){
				if($background_color == "transparent" || $background_color == "rgba(0,0,0,0.01)"){
					$box_style = "style='background-color: transparent; padding-right: 0; padding-left: 0;'";
				} else{
					$box_style = "style='background-color: ".$background_color.";'";
				}
			}

			$cat = get_the_category();

			$html .= '<li class="clearfix">';

				if($type == "boxes") {
					$html .= '<div class="boxes_image">';
						$html .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), 'portfolio-default').'<span class="latest_post_overlay"><i class="icon_plus" aria-hidden="true"></i></span></a>';
					$html .= '</div>';
				}

				$html .= '<div class="latest_post" '.$box_style.'>';

					if($type == "image_in_box") {
						$html .= '<div class="latest_post_image clearfix">';
							$html .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), 'latest_post_small_image').'</a>';
						$html .= '</div>';
					}

					$html .= '<div class="latest_post_text">';
						if($type == "boxes") {
							if($display_date == '1'){
								$html .= '<span class="date_holder post_info_section">';
									$html .= '<span class="date">' . get_the_time(get_option('date_format')) . '</span>';
								$html .= '</span>';//close date_hour_holder
							}


							if($display_category == '1'){
								$html .= '<div class="latest_post_categories post_info_section">';
									foreach ($cat as $categ) {
										$html .= '<a href="' . get_category_link($categ->term_id) . '">' . $categ->cat_name . ' </a> ';
									}
								$html .= '</div>'; //close span.latest_post_categories
							}
							
							if($display_author == '1'){
								$html .= '<div class="latest_post_author post_info_section">';
									$html .= '<span>'. __("By", "qode").'</span> <a class="post_author_link" href="'.get_author_posts_url( get_the_author_meta("ID") ).'"><span>'.get_the_author_meta("display_name").'</span></a>';
								$html .= '</div>'; //close span.latest_post_categories
							}
						}
						$html .= '<'.$title_tag.' class="latest_post_title "><a href="' . get_permalink() . '">' . get_the_title() . '</a></'.$title_tag.'>';

						if($type == "image_in_box") {
							$html .= '<div class="post_info_section_holder">';
								if($display_date == '1'){
									$html .= '<span class="date_holder post_info_section">';
										$html .= '<span class="date">' . get_the_time(get_option('date_format')) . '</span>';
									$html .= '</span>';//close date_hour_holder
								}


								if($display_category == '1'){
									$html .= '<div class="latest_post_categories post_info_section">';
										foreach ($cat as $categ) {
											$html .= '<a href="' . get_category_link($categ->term_id) . '">' . $categ->cat_name . ' </a> ';
										}
									$html .= '</div>'; //close span.latest_post_categories
								}
								
								if($display_author == '1'){
									$html .= '<div class="latest_post_author post_info_section">';
										$html .= '<span>'. __("By", "qode").'</span> <a class="post_author_link" href="'.get_author_posts_url( get_the_author_meta("ID") ).'"><span>'.get_the_author_meta("display_name").'</span></a>';
									$html .= '</div>'; //close span.latest_post_categories
								}
							$html .= '</div>';	
						}	

						if($text_length != '0' & $type == "boxes") {
							$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt();

							$html .= '<p class="excerpt">'.$excerpt.'...</p>';
						}

						if($display_author == '1' && $type == "boxes"){
							$html .= '<div class="post_author_holder">';
								$html .= '<div class="post_author">';
									$html .= '<span>'. __("By", "qode").'</span> <a class="post_author_link" href="'.get_author_posts_url( get_the_author_meta("ID") ).'"><span>'.get_the_author_meta("display_name").'</span></a>';
								$html .= '</div>';
							$html .= '</div>'; //close post_author_holder
						}
					$html .= '</div>'; //close latest_post_text
				$html .= '</div>'; //close latest_post
			$html .= '</li>';
		endwhile;
		wp_reset_query();

		$html .= "</ul></div>";
		return $html;
	}

	add_shortcode('latest_post', 'latest_post');
}

/* Line graph shortcode */

if (!function_exists('line_graph')) {
	function line_graph($atts, $content = null) {
		global $qode_options;
		extract(shortcode_atts(array("type" => "rounded", "custom_color" => "", "labels" => "", "width" => "750", "height" => "350", "scale_steps" => "3", "scale_step_width" => "15"), $atts));
		$id = mt_rand(1000, 9999);
		if($type == "rounded"){
			$bezierCurve = "true";
		}else{
			$bezierCurve = "false";
		}

		$id = mt_rand(1000, 9999);
		$html = "<div class='q_line_graf_holder'><div class='q_line_graf'><canvas id='lineGraph".$id."' height='".$height."' width='".$width."'></canvas></div><div class='q_line_graf_legend'><ul>";
		$line_graph_array = explode(";", $content);
		for ($i = 0 ; $i < count($line_graph_array) ; $i = $i + 1){
			$line_graph_el = explode(",", $line_graph_array[$i]);
			$html .=  "<li><div class='color_holder' style='background-color: ".trim($line_graph_el[0]).";'></div><p style='color: ".$custom_color.";'>".trim($line_graph_el[1])."</p></li>";
		}
		$html .=  "</ul></div></div><script>var lineGraph".$id." = {labels : [";
		$line_graph_labels_array = explode(",", $labels);
		for ($i = 0 ; $i < count($line_graph_labels_array) ; $i = $i + 1){
			if ($i > 0) $html .= ",";
			$html .=  '"'.$line_graph_labels_array[$i].'"';
		}
		$html .= "],";
		$html .= "datasets : [";
		$line_graph_array = explode(";", $content);
		for ($i = 0 ; $i < count($line_graph_array) ; $i = $i + 1){
			$line_graph_el = explode(",", $line_graph_array[$i]);
			if ($i > 0) $html .= ",";
			$values = "";
			for ($j = 2 ; $j < count($line_graph_el) ; $j = $j + 1){
				if ($j > 2) $values .= ",";
				$values .= $line_graph_el[$j];
			}
			$color = qode_hex2rgb(trim($line_graph_el[0]));
			$html .=  "{fillColor: 'rgba(".$color[0].",".$color[1].",".$color[2].",0.7)',data:[".$values."]}";
		}
		if(!empty($qode_options['text_fontsize'])){
			$text_fontsize = $qode_options['text_fontsize'];
		}else{
			$text_fontsize = 15;
		}
		if(!empty($qode_options['text_color']) && $custom_color == ""){
			$text_color = $qode_options['text_color'];
		} else if(empty($qode_options['text_color']) && $custom_color != ""){
			$text_color = $custom_color;
		} else if(!empty($qode_options['text_color']) && $custom_color != ""){
			$text_color = $custom_color;
		}else{
			$text_color = '#818181';
		}
		$html .= "]};
			var \$j = jQuery.noConflict();
			\$j(document).ready(function() {
				if(\$j('.touch .no_delay').length){
					new Chart(document.getElementById('lineGraph".$id."').getContext('2d')).Line(lineGraph".$id.",{scaleOverride : true,
					scaleStepWidth : ".$scale_step_width.",
					scaleSteps : ".$scale_steps.",
					bezierCurve : ".$bezierCurve.",
					pointDot : false,
					scaleLineColor: '#505050',
					scaleFontColor : '".$text_color."',
					scaleFontSize : ".$text_fontsize.",
					scaleGridLineColor : '#e1e1e1',
					datasetStroke : false,
					datasetStrokeWidth : 0,
					animationSteps : 120,});
				}else{
					\$j('#lineGraph".$id."').appear(function() {
						new Chart(document.getElementById('lineGraph".$id."').getContext('2d')).Line(lineGraph".$id.",{scaleOverride : true,
						scaleStepWidth : ".$scale_step_width.",
						scaleSteps : ".$scale_steps.",
						bezierCurve : ".$bezierCurve.",
						pointDot : false,
						scaleLineColor: '#000000',
						scaleFontColor : '".$text_color."',
						scaleFontSize : ".$text_fontsize.",
						scaleGridLineColor : '#e1e1e1',
						datasetStroke : false,
						datasetStrokeWidth : 0,
						animationSteps : 120,});
					},{accX: 0, accY: -200});
				}						
			});
		</script>";
		return $html;
	}
}
add_shortcode('line_graph', 'line_graph');

/* Message shortcode */

if (!function_exists('message')) {
	function message($atts, $content = null) {
		global $qode_options;

		$args = array(
			"type"                  => "",
			"background_color"      => "",
			"border_color"          => "",
			"border_width"          => "",
			"icon_pack"             => "",
			"fa_icon"               => "",
			"fe_icon"               => "",
			"linear_icon"           => "",
			"icon_size"            	=> "fa-2x",
			"icon_custom_size"      => "",
			"icon_color"            => "",
			"icon_background_color" => "",
			"custom_icon"           => "",
			"close_button_color"    => ""
		);
		extract(shortcode_atts($args, $atts));

		//init variables
		$html               = "";
		$icon_html          = "";
		$message_classes    = "";
		$message_styles     = "";
		$icon_styles        = "";
		$close_button_style = "";

		if($type == "with_icon"){
			$message_classes .= " with_icon";
		}

		if($background_color != "") {
			$message_styles .= "background-color: ".$background_color.";";
		}

		if($border_color != "") {
			if($border_width != ""){
				$message_styles .= "border: ".$border_width."px solid ".$border_color.";";
			} else {
				$message_styles .= "border: 2px solid ".$border_color.";";
			}
		}

		if($icon_color != "") {
			$icon_styles .= "color: ".$icon_color . ";";
		}

		if($icon_background_color != "") {
			$icon_styles .= " background-color: ".$icon_background_color . ";";
		}

		if($icon_custom_size != "") {
			$icon_font_style = ' font-size: '.$icon_custom_size;
			if(!strstr($icon_custom_size, 'px')) {
				$icon_font_style .= 'px';
			}
			$icon_font_style .= ';';
			$icon_styles .= $icon_font_style;
		}

		if($close_button_color != "") {
			$close_button_style .= "color: ".$close_button_color . ";";
		}

		$html .= "<div class='q_message ".$message_classes."' style='".$message_styles."'>";
		$html .= "<div class='q_message_inner'>";
		if($type == "with_icon"){
			$icon_html .= '<div class="q_message_icon_holder"><div class="q_message_icon"><div class="q_message_icon_inner">';
			if($custom_icon != "") {
				if(is_numeric($custom_icon)) {
					$custom_icon_src = wp_get_attachment_url( $custom_icon );
				} else {
					$custom_icon_src = $custom_icon;
				}

				$icon_html .= '<img src="' . $custom_icon_src . '" alt="">';
			} elseif($icon_pack == 'font_awesome' && $fa_icon != "") {
				$icon_html .= "<i class='fa ".$fa_icon." ". $icon_size . "' style='".$icon_styles."'></i>";
			} elseif($icon_pack == 'font_elegant' && $fe_icon != ""){
				$icon_html .= "<span class='q_font_elegant_icon ".$fe_icon."' aria-hidden='true' style='".$icon_styles ."'></span>";
			} elseif($icon_pack == 'linear_icons' && $linear_icon != ""){
				$icon_html .= "<i class='lnr q_linear_icons_icon ".$linear_icon."' style='".$icon_styles ."'></i>";
			}
			$icon_html .= '</div></div></div>';
		}

		$html .= $icon_html;

		$html .= "<a href='#' class='close'>";
		$html .= "<i class='q_font_elegant_icon icon_close' style='".$close_button_style."'></i>";
		$html .= "</a>"; //close a.close

		$html .= "<div class='message_text_holder'><div class='message_text'><div class='message_text_inner'>".do_shortcode($content)."</div></div></div>";

		$html .= "</div></div>"; //close message text div
		return $html;
	}
}
add_shortcode('message', 'message');

/* Ordered List shortcode */

if (!function_exists('ordered_list')) {
	function ordered_list($atts, $content = null) {
		$html =  "<div class=ordered>" . $content . "</div>";
		return $html;
	}
}
add_shortcode('ordered_list', 'ordered_list');

/* Pie Chart shortcode */

if (!function_exists('pie_chart')) {

	function pie_chart($atts, $content = null) {
		$args = array(
			"title"                 => "",
			"title_color"           => "",
			"title_tag"             => "h5",
			"percent"               => "",
			"show_percent_mark"     => "with_mark",
			"percentage_color"      => "",
			"percent_font_size"     => "",
			"percent_font_weight"   => "",
			"active_color"          => "",
			"noactive_color"        => "",
			"chart_width"	        => "",
			"line_width"            => "",
			"text"                  => "",
			"text_color"            => ""
		);

		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
		$percent_style = '';
		$html = '';
		$html .= '<div class="q_pie_chart_holder"><div class="q_percentage" data-percent="' . $percent . '" data-linewidth="' . $line_width . '" data-chartwidth="' . $chart_width . '" data-active="' . $active_color . '" data-noactive="' . $noactive_color . '"';
		if ($percentage_color != "" || $percent_font_size != "" || $percent_font_weight != "") {
			$percent_style .= ' style="';

			if($percentage_color != ""){
				$percent_style .= 'color:'.$percentage_color.';';
			}
			if($percent_font_size != ""){
				$percent_style .= 'font-size:'.$percent_font_size.'px;';
			}
			if($percent_font_weight != ""){
				$percent_style .= 'font-weight:'.$percent_font_weight.';';
			}
			$percent_style .= '"';
		}
		$html .= '><span class="tocounter '.$show_percent_mark.'" ' .$percent_style . '>' . $percent . '</span>';
		$html .= '</div><div class="pie_chart_text">';
		if ($title != "") {
			$html .= '<'.$title_tag.' class="pie_title"';
			if ($title_color != "") {
				$html .= ' style="color: ' . $title_color . ';"';
			}
			$html .= '>' . $title . '</'.$title_tag.'>';
		}

		if ($text != "") {
			$html .= '<p';
			if($text_color != ""){
				$html .= ' style="color: '.$text_color.';"';
			}
			$html .= '>' . $text . '</p>';
		}
		$html .= "</div></div>";
		return $html;
	}

}
add_shortcode('pie_chart', 'pie_chart');

/* Pie Chart With Icon shortcode */

if (!function_exists('pie_chart_with_icon')) {

	function pie_chart_with_icon($atts, $content = null) {

		global $qode_options;

		$args = array(
			"percent"         => "",
			"active_color"    => "",
			"noactive_color"  => "",
			"chart_width"	  => "",
			"line_width"      => "",
			"icon_pack"       => "",
			"fa_icon"         => "",
			"fe_icon"         => "",
			"linear_icon"     => "",
			"icon_color"      => "",
			"title"           => "",
			"title_color"     => "",
			"title_tag"       => "h5",
			"text"            => "",
			"text_color"      => ""
		);

		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		$html = '';

		$html .= '<div class="q_pie_chart_with_icon_holder"><div class="q_percentage_with_icon" data-percent="'.$percent.'" data-linewidth="'.$line_width.'" data-chartwidth="'.$chart_width.'" data-active="'.$active_color.'" data-noactive="'.$noactive_color.'">';

		if($icon_pack == 'font_awesome' && $fa_icon != ""){
			$html .= '<i class="fa '.$fa_icon.'"';


			if ($icon_color != "") {
				$html .= ' style="color: ' . $icon_color . ';"';
			}
			$html .= '></i>';
		}

		elseif($icon_pack == 'font_elegant' && $fe_icon != ""){
			$html .= '<span class="q_font_elegant_icon '.$fe_icon.'"';


			if ($icon_color != "") {
				$html .= ' style="color: ' . $icon_color . ';"';
			}
			$html .= '></span>';
		}

		elseif($icon_pack == 'linear_icons' && $linear_icon != ""){
			$html .= '<i class="lnr q_linear_icons_icon '.$linear_icon.'"';


			if ($icon_color != "") {
				$html .= ' style="color: ' . $icon_color . ';"';
			}
			$html .= '></i>';
		}

		$html .= '</div><div class="pie_chart_text">';
		if ($title != "") {
			$html .= '<'.$title_tag.' class="pie_title"';
			if ($title_color != "") {
				$html .= ' style="color: ' . $title_color . ';"';
			}
			$html .= '>' . $title . '</'.$title_tag.'>';
		}

		if ($text != "") {
			$html .= '<p ';
			if ($text_color != "") {
				$html .= ' style="color: ' . $text_color . ';"';
			}
			$html .= '>' . $text . '</p>';
		}
		$html .= "</div></div>";
		return $html;
	}
}
add_shortcode('pie_chart_with_icon', 'pie_chart_with_icon');

/* Pie Chart Full shortcode */

if (!function_exists('pie_chart2')) {
	function pie_chart2($atts, $content = null) {
		extract(shortcode_atts(array("width" => "150", "height" => "150", "color" => ""), $atts));
		$id = mt_rand(1000, 9999);
		$html = "<div class='q_pie_graf_holder'><div class='q_pie_graf'><canvas id='pie".$id."' height='".$height."' width='".$width."'></canvas></div><div class='q_pie_graf_legend'><ul>";
		$pie_chart_array = explode(";", $content);
		for ($i = 0 ; $i < count($pie_chart_array) ; $i = $i + 1){
			$pie_chart_el = explode(",", $pie_chart_array[$i]);
			$html .= "<li><div class='color_holder' style='background-color: ".trim($pie_chart_el[1]).";'></div><p style='color: ".$color.";'>".trim($pie_chart_el[2])."</p></li>";
		}
		$html .= "</ul></div></div><script>var pie".$id." = [";
		$pie_chart_array = explode(";", $content);
		for ($i = 0 ; $i < count($pie_chart_array) ; $i = $i + 1){
			$pie_chart_el = explode(",", $pie_chart_array[$i]);
			if ($i > 0) $html .= ",";
			$html .= "{value: ".trim($pie_chart_el[0]).",color:'".trim($pie_chart_el[1])."'}";
		}
		$html .= "];
		var \$j = jQuery.noConflict();
		\$j(document).ready(function() {
			if(\$j('.touch .no_delay').length){
				new Chart(document.getElementById('pie".$id."').getContext('2d')).Pie(pie".$id.",{segmentStrokeColor : 'transparent',});
			}else{
				\$j('#pie".$id."').appear(function() {
					new Chart(document.getElementById('pie".$id."').getContext('2d')).Pie(pie".$id.",{segmentStrokeColor : 'transparent',});
				},{accX: 0, accY: -200});
			}
		});
	</script>";
		return $html;
	}
}
add_shortcode('pie_chart2', 'pie_chart2');


/* Pie Chart Doughnut shortcode */

if (!function_exists('pie_chart3')) {
	function pie_chart3($atts, $content = null) {
		extract(shortcode_atts(array("width" => "150", "height" => "150", "color" => ""), $atts));
		$id = mt_rand(1000, 9999);
		$html = "<div class='q_pie_graf_holder'><div class='q_pie_graf'><canvas id='pie".$id."' height='".$height."' width='".$width."'></canvas></div><div class='q_pie_graf_legend'><ul>";
		$pie_chart_array = explode(";", $content);
		for ($i = 0 ; $i < count($pie_chart_array) ; $i = $i + 1){
			$pie_chart_el = explode(",", $pie_chart_array[$i]);
			$html .= "<li><div class='color_holder' style='background-color: ".trim($pie_chart_el[1]).";'></div><p style='color: ".$color.";'>".trim($pie_chart_el[2])."</p></li>";
		}
		$html .= "</ul></div></div><script>var pie".$id." = [";
		$pie_chart_array = explode(";", $content);
		for ($i = 0 ; $i < count($pie_chart_array) ; $i = $i + 1){
			$pie_chart_el = explode(",", $pie_chart_array[$i]);
			if ($i > 0) $html .= ",";
			$html .= "{value: ".trim($pie_chart_el[0]).",color:'".trim($pie_chart_el[1])."'}";
		}
		$html .= "];
		var \$j = jQuery.noConflict();
		\$j(document).ready(function() {
			if(\$j('.touch .no_delay').length){
				new Chart(document.getElementById('pie".$id."').getContext('2d')).Doughnut(pie".$id.",{segmentStrokeColor : 'transparent',});
			}else{
				\$j('#pie".$id."').appear(function() {
					new Chart(document.getElementById('pie".$id."').getContext('2d')).Doughnut(pie".$id.",{segmentStrokeColor : 'transparent',});
				},{accX: 0, accY: -200});
			}							
		});
	</script>";
		return $html;
	}
}
add_shortcode('pie_chart3', 'pie_chart3');

/* Portfolio list shortcode */

if (!function_exists('portfolio_list')) {

	function portfolio_list($atts, $content = null) {

		global $wp_query;
		global $qode_options;
		$portfolio_qode_like = "on";
		if (isset($qode_options['portfolio_qode_like'])) {
			$portfolio_qode_like = $qode_options['portfolio_qode_like'];
		}

		$portfolio_list_hide_category = false;
		if (isset($qode_options['portfolio_list_hide_category']) && $qode_options['portfolio_list_hide_category'] == "yes") {
			$portfolio_list_hide_category = true;
		}

		$portfolio_filter_class = "";
		if (isset($qode_options['portfolio_filter_disable_separator']) && !empty($qode_options['portfolio_filter_disable_separator'])) {
			if($qode_options['portfolio_filter_disable_separator'] == "yes"){
				$portfolio_filter_class = "without_separator";
			} else {
				$portfolio_filter_class = "";
			}
		}

		$args = array(
			"type"                  	=> "standard",
			"masonry_space"             => "no",
			"pinterest_space"             => "no",
			"hover_type"            	=> "default_hover",
			"pinterest_hover_type"		=> "",
			"portfolio_loading_type"	=> "",
			"parallax_item_speed" 		=> "0.3",
			"parallax_item_offset" 		=> "0",
			"box_border"            	=> "",
			"box_background_color" 		=> "",		
			"box_border_color"      	=> "",
			"box_border_width"      	=> "",
			"columns"               	=> "3",
			"image_size"            	=> "",
			"order_by"              	=> "date",
			"order"                 	=> "ASC",
			"number"                	=> "-1",
			"filter"                	=> "no",
			"filter_order_by"           => "name",
			"disable_filter_title"      => "no",
			"filter_align"          	=> "left_align",
			"disable_link"          	=> "no",
			"lightbox"             		=> "yes",
			"show_like"             	=> "yes",
			"category"              	=> "",
			"selected_projects"     	=> "",
			"show_load_more"        	=> "yes",
			"title_tag"             	=> "h4",
			"title_font_size"       	=> "",
			"text_align"            	=> "",
			"row_height"                        => "",
			"justify_last_row"                  => "nojustify",
			"justify_threshold"                 => 0.75
		);

		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];


		$html = "";

		$_type_class = '';
		$_portfolio_space_class = '';
		$_portfolio_masonry_with_space_class = '';
		$_portfolio_masonry_class = '';
		$_loading_class = '';

		if ($type == "hover_text") {
			$_type_class = " hover_text";
			$_portfolio_space_class = "portfolio_with_space portfolio_with_hover_text";
		} elseif ($type == "standard" || $type == "masonry_with_space"){
			$_type_class = " standard";
			$_portfolio_space_class = "portfolio_with_space portfolio_standard";
			if($type == "masonry_with_space"){
				$_portfolio_masonry_with_space_class = ' masonry_with_space';
			}
			if($pinterest_space == "yes" && $type == "masonry_with_space"){
				$_portfolio_masonry_with_space_class = 'masonry_with_space pinterest_space';
			}
		} elseif ($type == "standard_no_space"){
			$_type_class = " standard_no_space";
			$_portfolio_space_class = "portfolio_no_space portfolio_standard";
		} elseif ($type == "hover_text_no_space"){
			$_type_class = " hover_text no_space";
			$_portfolio_space_class = "portfolio_no_space portfolio_with_hover_text";
		} elseif ($type == "justified_gallery"){
			$_type_class = " justified_gallery";
			$_portfolio_space_class = "portfolio_no_space";
		}

		if ($type == 'justified_gallery') {
			$hover_type = " justified_gallery_hover ";
		}

		if ($portfolio_loading_type != ""){
			$_loading_class =  $portfolio_loading_type;
		}

		if ($type == 'masonry_with_space' && $pinterest_hover_type=="info_on_hover") {
			$hover_type = " pinterest_info_on_hover ";
		}

		if($masonry_space == 'yes') {
			$_portfolio_masonry_class .= 'masonry_extended';
		}

		$portfolio_box_style = "";
		$portfolio_description_class = "";

		if($box_border == "yes" || $box_background_color != ""){

			$portfolio_box_style .= "style=";
			if($box_border == "yes"){
				$portfolio_box_style .= "border-style:solid;";
				if($box_border_color != "" ){
					$portfolio_box_style .= "border-color:" . $box_border_color . ";";
				}
				if($box_border_width != "" ){
					$portfolio_box_style .= "border-width:" . $box_border_width . "px;";
				} else {
					$portfolio_box_style .= "border-width: 1px;";
				}
			}
			if($box_background_color != ""){
				$portfolio_box_style .= "background-color:" . $box_background_color . ";";
			}
			$portfolio_box_style .= "'";

			$portfolio_description_class .= 'with_padding';

			$_portfolio_space_class = ' with_description_background';

		}

		if($text_align !== '') {
			$portfolio_description_class .= ' text_align_'.$text_align;
		}




		if($type == 'masonry') {
			if ($filter == "yes") {
				$html .= "<div class='filter_outer ".$filter_align."'>";
				$html .= "<div class='filter_holder ".$portfolio_filter_class."'><ul>";
				if($disable_filter_title != "yes"){
					$html .= "<li class='filter_title'><span>".__('Sort Portfolio:', 'qode')."</span></li>";
				}
				$html .= "<li class='filter' data-filter='*'><span>" . __('All', 'qode') . "</span></li>";
				if ($category == "") {
					$args = array(
						'parent' => 0,
						'orderby' => $filter_order_by
					);
					$portfolio_categories = get_terms('portfolio_category', $args);
				} else {
					$top_category = get_term_by('slug', $category, 'portfolio_category');
					$term_id = '';
					if (isset($top_category->term_id))
						$term_id = $top_category->term_id;
					$args = array(
						'parent' => $term_id,
						'orderby' => $filter_order_by
					);
					$portfolio_categories = get_terms('portfolio_category', $args);
				}
				foreach ($portfolio_categories as $portfolio_category) {
					$html .= "<li class='filter' data-filter='.portfolio_category_$portfolio_category->term_id'><span>$portfolio_category->name</span>";
					$args = array(
						'child_of' => $portfolio_category->term_id
					);
					$html .= '</li>';
				}
				$html .= "</ul></div>";
				$html .= "</div>";


			}
			$html .= "<div class='projects_masonry_holder $_loading_class $_portfolio_masonry_class' data-parallax_item_speed='".$parallax_item_speed."' data-parallax_item_offset='".$parallax_item_offset."'>";
			if (get_query_var('paged')) {
				$paged = get_query_var('paged');
			} elseif (get_query_var('page')) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}
			if ($category == "") {
				$args = array(
					'post_type' => 'portfolio_page',
					'orderby' => $order_by,
					'order' => $order,
					'posts_per_page' => $number,
					'paged' => $paged
				);
			} else {
				$args = array(
					'post_type' => 'portfolio_page',
					'portfolio_category' => $category,
					'orderby' => $order_by,
					'order' => $order,
					'posts_per_page' => $number,
					'paged' => $paged
				);
			}
			$project_ids = null;
			if ($selected_projects != "") {
				$project_ids = explode(",", $selected_projects);
				$args['post__in'] = $project_ids;
			}
			query_posts($args);
			if (have_posts()) : while (have_posts()) : the_post();
				$terms = wp_get_post_terms(get_the_ID(), 'portfolio_category');
				$featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); //original size
				$portfolio_subtitle='';
				if(get_post_meta(get_the_ID(), 'qode_portfolio_subtitle', true) != ""){
					$portfolio_subtitle = get_post_meta(get_the_ID(), 'qode_portfolio_subtitle', true);
				}

				if(get_post_meta(get_the_ID(), 'qode_portfolio-lightbox-link', true) != ""){
					$large_image = get_post_meta(get_the_ID(), 'qode_portfolio-lightbox-link', true);
				} else {
					$large_image = $featured_image_array[0];
				}

				$masonry_parallax_class = "";
				$masonry_parallax = get_post_meta(get_the_ID(), "qode_portfolio_masonry_parallax", true);
				if($masonry_parallax == "yes"){
					$masonry_parallax_class = " parallax_item";
				}

				$custom_portfolio_link = get_post_meta(get_the_ID(), 'qode_portfolio-external-link', true);
				$portfolio_link = $custom_portfolio_link != "" ? $custom_portfolio_link : get_permalink();
				if(get_post_meta(get_the_ID(), 'qode_portfolio-external-link-target', true) != ""){
					$custom_portfolio_link_target = get_post_meta(get_the_ID(), 'qode_portfolio-external-link-target', true);
				} else {
					$custom_portfolio_link_target = '_blank';
				}

				$target = $custom_portfolio_link != "" ? $custom_portfolio_link_target : '_self';


				$masonry_size = "default";
				$masonry_size =  get_post_meta(get_the_ID(), "qode_portfolio_type_masonry_style", true);

				$image_size = "";
				if($masonry_size == "large_width"){
					$image_size = "portfolio_masonry_wide";
				}elseif($masonry_size == "large_height"){
					$image_size = "portfolio_masonry_tall";
				}elseif($masonry_size == "large_width_height"){
					$image_size = "portfolio_masonry_large";
				} else{
					$image_size = "portfolio_masonry_regular";
				}

				if($type == "masonry_with_space"){
					$image_size = "portfolio_masonry_with_space";
				}

				$slug_list_ = "pretty_photo_gallery";
				$title = get_the_title();
				$html .= "<article class='portfolio_masonry_item ";

				foreach ($terms as $term) {
					$html .= "portfolio_category_$term->term_id ";
				}

				$html .= " " . $masonry_size;
				$html .= " " . $masonry_parallax_class;
				$html .= "'>";

				$html .= "<div class='image_holder ".$hover_type."'>";
				$html .= "<span class='image'>";
				$html .= get_the_post_thumbnail(get_the_ID(), $image_size);
				$html .= "</span>"; //close span.image

				if($disable_link != "yes"){
					$html .= "<a class='portfolio_link_class' href='" . $portfolio_link . "' target='".$target."'></a>";
				}

				if($hover_type == 'move_from_left'){
					$html .= '<div class="holder-move">';
				}

				$html .= '<div class="portfolio_shader"></div>';

				$html .= '<div class="text_holder">';
				if($hover_type == "elegant_hover"){
					$html .= '<div class="text_holder_inner"><div class="text_holder_inner2">';
				}

				if($hover_type == "default_hover" && !$portfolio_list_hide_category){
					$html .= '<span class="project_category">';
					$html .= '<span>'. __('In ', 'qode') .'</span>';
					$k = 1;
					foreach ($terms as $term) {
						$html .= "$term->name";
						if (count($terms) != $k) {
							$html .= ' / ';
						}
						$k++;
					}
					$html .= '</span>';
				}

				$title_style = '';
				if($title_font_size != ""){
					$title_style = 'style="font-size: '.$title_font_size.'px;"';
				}

				$html .= '<'.$title_tag.' class="portfolio_title" '.$title_style.'>' . get_the_title() . '</'.$title_tag.'>';

				$html .= '<h6 class="portfolio_subtitle">' . $portfolio_subtitle . '</h6>';


				if($hover_type != "default_hover" && !$portfolio_list_hide_category){
					$html .= '<span class="project_category">';
					$html .= '<span>'. __('In ', 'qode') .'</span>';
					$k = 1;
					foreach ($terms as $term) {
						$html .= "$term->name";
						if (count($terms) != $k) {
							$html .= ' / ';
						}
						$k++;
					}
					$html .= '</span>';
				}

				if($hover_type == "elegant_hover"){
					$html .= '</div></div>';
				}
				$html .= "</div>";

				if($hover_type != "elegant_hover"){
					$html .= '<div class="icons_holder"><div class="icons_holder_inner">';
					if ($lightbox == "yes") {
						$html .= "<a class='portfolio_lightbox' title='" . $title . "' href='" . $large_image . "' data-rel='prettyPhoto[" . $slug_list_ . "]'></a>";
					}

					if ($portfolio_qode_like == "on" && $show_like == "yes") {
						if (function_exists('qode_like_portfolio_list')) {
							$html .= qode_like_portfolio_list(get_the_ID());
						}
					}
					$html .= "</div></div>";
				}

				if($hover_type == 'move_from_left'){
					$html .= '</div>';
				}
				$html .= "</div>"; //close div.image_holder
				$html .= "</article>";

			endwhile;
			else:
				?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'qode'); ?></p>
				<?php
			endif;
			wp_reset_query();
			$html .= "</div>";
		}

		else if($type == 'justified_gallery') {
			$html .= "<div class='projects_holder_outer portfolio_justified_gallery'>";

			if ($filter == "yes") {
				$html .= "<div class='filter_outer ".$filter_align."'>";
				$html .= "<div class='filter_holder ".$portfolio_filter_class."'><ul>";
				if($disable_filter_title != "yes"){
					$html .= "<li class='filter_title'><span>".__('Sort Portfolio:', 'qode')."</span></li>";
				}

				$html .= "<li class='filter' data-filter='*'><span>" . __('All', 'qode') . "</span></li>";

				if ($category == "") {
					$args = array(
						'parent' => 0,
						'orderby' => $filter_order_by
					);
					$portfolio_categories = get_terms('portfolio_category', $args);
				} else {
					$top_category = get_term_by('slug', $category, 'portfolio_category');
					$term_id = '';
					if (isset($top_category->term_id))
						$term_id = $top_category->term_id;
					$args = array(
						'parent' => $term_id,
						'orderby' => $filter_order_by
					);
					$portfolio_categories = get_terms('portfolio_category', $args);
				}
				foreach ($portfolio_categories as $portfolio_category) {
					$html .= "<li class='filter' data-filter='.portfolio_category_$portfolio_category->term_id'><span>$portfolio_category->name</span>";
					$args = array(
						'child_of' => $portfolio_category->term_id
					);
					$html .= '</li>';
				}
				$html .= "</ul></div>";
				$html .= "</div>";
			}

			$html .= "<div class='projects_holder clearfix' data-spacing='10'  ".($row_height != '' ? "data-row-height='$row_height'" : "")." ".($justify_last_row != "" ? "data-last-row='$justify_last_row'" : "")." ".($justify_threshold != '' ? "data-justify-threshold='$justify_threshold'" : "").">\n";

			if (get_query_var('paged')) {
				$paged = get_query_var('paged');
			} elseif (get_query_var('page')) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}

			if ($category == "") {
				$args = array(
					'post_type' => 'portfolio_page',
					'orderby' => $order_by,
					'order' => $order,
					'posts_per_page' => $number,
					'paged' => $paged
				);
			} else {
				$args = array(
					'post_type' => 'portfolio_page',
					'portfolio_category' => $category,
					'orderby' => $order_by,
					'order' => $order,
					'posts_per_page' => $number,
					'paged' => $paged
				);
			}

			$project_ids = null;
			if ($selected_projects != "") {
				$project_ids = explode(",", $selected_projects);
				$args['post__in'] = $project_ids;
			}

			query_posts($args);

			if (have_posts()) : while (have_posts()) : the_post();
				$terms = wp_get_post_terms(get_the_ID(), 'portfolio_category');
				$html .= "<article class='";
				foreach ($terms as $term) {
					$html .= "portfolio_category_$term->term_id ";
				}

				$title = get_the_title();
				$featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); //original size


				if(get_post_meta(get_the_ID(), 'qode_portfolio-lightbox-link', true) != ""){
					$large_image = get_post_meta(get_the_ID(), 'qode_portfolio-lightbox-link', true);
				} else {
					$large_image = $featured_image_array[0];
				}

				$slug_list_ = "pretty_photo_gallery";

				$custom_portfolio_link = get_post_meta(get_the_ID(), 'qode_portfolio-external-link', true);
				$portfolio_link = $custom_portfolio_link != "" ? $custom_portfolio_link : get_permalink();

				if(get_post_meta(get_the_ID(), 'qode_portfolio-external-link-target', true) != ""){
					$custom_portfolio_link_target = get_post_meta(get_the_ID(), 'qode_portfolio-external-link-target', true);
				} else {
					$custom_portfolio_link_target = '_blank';
				}

				$target = $custom_portfolio_link != "" ? $custom_portfolio_link_target : '_self';

				$html .="'>";

				if($disable_link != "yes"){
					$html .= "<a class='portfolio_jg_image_link image_holder' href='" . $portfolio_link . "' target='".$target."'>";
				}
				else {
					$html .= "<span class='portfolio_jg_image_link image_holder'>";
				}

				$html .= get_the_post_thumbnail(get_the_ID(), 'full');
				if($disable_link != "yes"){
					$html .= "</a>";
				}
				else {
					$html .= "</span>";
				}
				if($disable_link != "yes"){
					$html .= "<a class='portfolio_shader' href='" . $portfolio_link . "' target='".$target."'></a>";
				}
				else {
					$html .= '<div class="portfolio_shader"></div>';
				}

				$html .= '<div class="icons_holder"><div class="icons_holder_inner">';
				if ($lightbox == "yes") {
					$html .= "<a class='portfolio_lightbox' title='" . $title . "' href='" . $large_image . "' data-rel='prettyPhoto[" . $slug_list_ . "]'></a>";
				}

				if ($portfolio_qode_like == "on" && $show_like == "yes") {
					if (function_exists('qode_like_portfolio_list')) {
						$html .= qode_like_portfolio_list(get_the_ID());
					}
				}
				$html .= "</div></div>";
				$html .= "</article>\n";
			endwhile;
			else:
				?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'qode'); ?></p>
				<?php
			endif;

			$html .= "</div>";
			if (get_next_posts_link()) {
				if ($show_load_more == "yes" || $show_load_more == "") {
					$html .= '<div class="portfolio_paging"><span rel="' . $wp_query->max_num_pages . '" class="load_more">' . get_next_posts_link(__('Show more', 'qode')) . '</span></div>';
					$html .= '<div class="portfolio_paging_loading"><a href="javascript: void(0)" class="qbutton">'.__('Loading...', 'qode').'</a></div>';
				}
			}
			$html .= "</div>";
			wp_reset_query();
		}

		else {
			$html .= "<div class='projects_holder_outer v$columns $_portfolio_space_class $_portfolio_masonry_with_space_class'>";
			if ($filter == "yes") {
				$html .= "<div class='filter_outer ".$filter_align."'>";
				$html .= "<div class='filter_holder ".$portfolio_filter_class."'><ul>";
				if($disable_filter_title != "yes"){
					$html .= "<li class='filter_title'><span>".__('Sort Portfolio:', 'qode')."</span></li>";
				}
				if($type == 'masonry_with_space'){
					$html .= "<li class='filter' data-filter='*'><span>" . __('All', 'qode') . "</span></li>";
				} else {
					$html .= "<li class='filter' data-filter='all'><span>" . __('All', 'qode') . "</span></li>";
				}

				if ($category == "") {
					$args = array(
						'parent' => 0,
						'orderby' => $filter_order_by
					);
					$portfolio_categories = get_terms('portfolio_category', $args);
				} else {
					$top_category = get_term_by('slug', $category, 'portfolio_category');
					$term_id = '';
					if (isset($top_category->term_id))
						$term_id = $top_category->term_id;
					$args = array(
						'parent' => $term_id,
						'orderby' => $filter_order_by
					);
					$portfolio_categories = get_terms('portfolio_category', $args);
				}
				foreach ($portfolio_categories as $portfolio_category) {
					if($type == 'masonry_with_space'){
						$html .= "<li class='filter' data-filter='.portfolio_category_$portfolio_category->term_id'><span>$portfolio_category->name</span>";
					} else {
						$html .= "<li class='filter' data-filter='portfolio_category_$portfolio_category->term_id'><span>$portfolio_category->name</span>";
					}
					$args = array(
						'child_of' => $portfolio_category->term_id
					);
					$html .= '</li>';
				}
				$html .= "</ul></div>";
				$html .= "</div>";
			}

			$thumb_size_class = "";
			//get proper image size
			switch($image_size) {
				case 'landscape':
					$thumb_size_class = 'portfolio_landscape_image';
					break;
				case 'portrait':
					$thumb_size_class = 'portfolio_portrait_image';
					break;
				case 'square':
					$thumb_size_class = 'portfolio_square_image';
					break;
				case 'full':
					$thumb_size_class = 'portfolio_full_image';
					break;
				default:
					$thumb_size_class = 'portfolio_default_image';
					break;
			}

			$html .= "<div class='projects_holder clearfix v$columns$_type_class $thumb_size_class $_loading_class'>\n";
			if (get_query_var('paged')) {
				$paged = get_query_var('paged');
			} elseif (get_query_var('page')) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}
			if ($category == "") {
				$args = array(
					'post_type' => 'portfolio_page',
					'orderby' => $order_by,
					'order' => $order,
					'posts_per_page' => $number,
					'paged' => $paged
				);
			} else {
				$args = array(
					'post_type' => 'portfolio_page',
					'portfolio_category' => $category,
					'orderby' => $order_by,
					'order' => $order,
					'posts_per_page' => $number,
					'paged' => $paged
				);
			}
			$project_ids = null;
			if ($selected_projects != "") {
				$project_ids = explode(",", $selected_projects);
				$args['post__in'] = $project_ids;
			}
			query_posts($args);
			if (have_posts()) : while (have_posts()) : the_post();
				$terms = wp_get_post_terms(get_the_ID(), 'portfolio_category');
				$html .= "<article class='mix ";
				foreach ($terms as $term) {
					$html .= "portfolio_category_$term->term_id ";
				}

				$title = get_the_title();
				$featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); //original size
				$portfolio_subtitle='';
				if(get_post_meta(get_the_ID(), 'qode_portfolio_subtitle', true) != ""){
					$portfolio_subtitle = get_post_meta(get_the_ID(), 'qode_portfolio_subtitle', true);
				}

				if(get_post_meta(get_the_ID(), 'qode_portfolio-lightbox-link', true) != ""){
					$large_image = get_post_meta(get_the_ID(), 'qode_portfolio-lightbox-link', true);
				} else {
					$large_image = $featured_image_array[0];
				}

				$slug_list_ = "pretty_photo_gallery";

				//get proper image size
				switch($image_size) {
					case 'landscape':
						$thumb_size = 'portfolio-landscape';
						break;
					case 'portrait':
						$thumb_size = 'portfolio-portrait';
						break;
					case 'square':
						$thumb_size = 'portfolio-square';
						break;
					case 'full':
						$thumb_size = 'full';
						break;
					default:
						$thumb_size = 'portfolio-default';
						break;
				}

				if($type == "masonry_with_space"){
					$thumb_size = 'portfolio_masonry_with_space';
				}

				$custom_portfolio_link = get_post_meta(get_the_ID(), 'qode_portfolio-external-link', true);
				$portfolio_link = $custom_portfolio_link != "" ? $custom_portfolio_link : get_permalink();

				if(get_post_meta(get_the_ID(), 'qode_portfolio-external-link-target', true) != ""){
					$custom_portfolio_link_target = get_post_meta(get_the_ID(), 'qode_portfolio-external-link-target', true);
				} else {
					$custom_portfolio_link_target = '_blank';
				}

				$target = $custom_portfolio_link != "" ? $custom_portfolio_link_target : '_self';

				$html .="'>";

				$html .= "<div class='image_holder ".$hover_type."'>";
				$html .= "<span class='image'>";
				$html .= get_the_post_thumbnail(get_the_ID(), $thumb_size);
				$html .= "</span>";

				if ($type == "standard" || $type == "standard_no_space" || $type == "masonry_with_space") {

					if($type=="masonry_with_space" && $pinterest_hover_type == "info_on_hover"){
						$html .= "<div class='pinterest_info_hover_holder'>";
						$html .= "<div class='pinterest_info_hover_inner'>";
						$html .= "<div class='pinterest_info_hover_cell'>";
					}

					if($disable_link != "yes"){
						$html .= "<a class='portfolio_link_class' href='" . $portfolio_link . "' target='".$target."'></a>";
					}

					$html .= '<div class="portfolio_shader"></div>';



					$html .= '<div class="icons_holder"><div class="icons_holder_inner">';
					if ($lightbox == "yes") {
						$html .= "<a class='portfolio_lightbox' title='" . $title . "' href='" . $large_image . "' data-rel='prettyPhoto[" . $slug_list_ . "]'></a>";
					}

					if ($portfolio_qode_like == "on" && $show_like == "yes") {
						if (function_exists('qode_like_portfolio_list')) {
							$html .= qode_like_portfolio_list(get_the_ID());
						}
					}

					$html .= "</div></div>";


					//pinterest info on hover
					if($type=="masonry_with_space" && $pinterest_hover_type == "info_on_hover"){

						$title_style = '';
						if($title_font_size != ""){
							$title_style = 'style="font-size: '.$title_font_size.'px;"';
						}

						if($disable_link != "yes"){
							$html .= '<'.$title_tag.' class="portfolio_title" '.$title_style.'><a href="' . $portfolio_link . '" target="'.$target.'">' . get_the_title() . '</a></'.$title_tag.'>';
						} else {
							$html .= '<'.$title_tag.' class="portfolio_title" '.$title_style.'>' . get_the_title() . '</'.$title_tag.'>';
						}

						$html .= '<h6 class="portfolio_subtitle">' . $portfolio_subtitle . '</h6>';

						if(!$portfolio_list_hide_category){
							$html .= '<span class="project_category">';
							$k = 1;
							foreach ($terms as $term) {
								$html .= "$term->name";
								if (count($terms) != $k) {
									$html .= ', ';
								}
								$k++;
							}
							$html .= '</span>';
						}
					}

					if($type=="masonry_with_space" && $pinterest_hover_type == "info_on_hover"){
						$html .= "</div></div></div>";
					}

				} else if ($type == "hover_text" || $type == "hover_text_no_space") {

					if($disable_link != "yes"){
						$html .= "<a class='portfolio_link_class' href='" . $portfolio_link . "' target='".$target."'></a>";
					}


					if($hover_type == 'move_from_left'){
						$html .= '<div class="holder-move">';
					}


					$html .= '<div class="portfolio_shader"></div>';

					$html .= '<div class="text_holder">';

					if($hover_type == "elegant_hover"){
						$html .= '<div class="text_holder_inner"><div class="text_holder_inner2">';
					}

					if($hover_type == "default_hover" && !$portfolio_list_hide_category){
						$html .= '<span class="project_category">';
						$html .= '<span>'. __('In ', 'qode') .'</span>';
						$k = 1;
						foreach ($terms as $term) {
							$html .= "$term->name";
							if (count($terms) != $k) {
								$html .= ' / ';
							}
							$k++;
						}
						$html .= '</span>';
					}

					$title_style = '';
					if($title_font_size != ""){
						$title_style = 'style="font-size: '.$title_font_size.'px;"';
					}

					$html .= '<'.$title_tag.' class="portfolio_title" '.$title_style.'>' . get_the_title() . '</'.$title_tag.'>';
					$html .= '<h6 class="portfolio_subtitle">' . $portfolio_subtitle . '</h6>';

					if($hover_type != "default_hover" && !$portfolio_list_hide_category){
						$html .= '<span class="project_category">';
						$html .= '<span>'. __('In ', 'qode') .'</span>';
						$k = 1;
						foreach ($terms as $term) {
							$html .= "$term->name";
							if (count($terms) != $k) {
								$html .= ' / ';
							}
							$k++;
						}
						$html .= '</span>';
					}

					if($hover_type == "elegant_hover"){
						$html .= '</div></div>';
					}
					$html .= "</div>";

					if($hover_type != "elegant_hover"){
						$html .= '<div class="icons_holder"><div class="icons_holder_inner">';
						if ($lightbox == "yes") {
							$html .= "<a class='portfolio_lightbox' title='" . $title . "' href='" . $large_image . "' data-rel='prettyPhoto[" . $slug_list_ . "]'></a>";
						}

						if ($portfolio_qode_like == "on" && $show_like == "yes") {
							if (function_exists('qode_like_portfolio_list')) {
								$html .= qode_like_portfolio_list(get_the_ID());
							}
						}
						$html .= "</div></div>";
					}

					if($hover_type == 'move_from_left'){
						$html .= '</div>'; //close holder-move
					}
				}

				$html .= "</div>";

				if (($type == "standard" || $type == "standard_no_space" || $type == "masonry_with_space") && ($pinterest_hover_type != "info_on_hover")) {
					$html .= "<div class='portfolio_description ".$portfolio_description_class."'". $portfolio_box_style .">";

					$title_style = '';
					if($title_font_size != ""){
						$title_style = 'style="font-size: '.$title_font_size.'px;"';
					}

					if($disable_link != "yes"){
						$html .= '<'.$title_tag.' class="portfolio_title" '.$title_style.'><a href="' . $portfolio_link . '" target="'.$target.'">' . get_the_title() . '</a></'.$title_tag.'>';
					} else {
						$html .= '<'.$title_tag.' class="portfolio_title" '.$title_style.'>' . get_the_title() . '</'.$title_tag.'>';
					}

					$html .= '<h6 class="portfolio_subtitle">' . $portfolio_subtitle . '</h6>';

					if(!$portfolio_list_hide_category){
						$html .= '<span class="project_category">';
						$html .= '<span>'. __('In ', 'qode') .'</span>';
						$k = 1;
						foreach ($terms as $term) {
							$html .= "$term->name";
							if (count($terms) != $k) {
								$html .= ', ';
							}
							$k++;
						}
						$html .= '</span>';
					}
					$html .= '</div>';
				}

				$html .= "</article>\n";

			endwhile;

				$i = 1;
				while ($i <= $columns) {
					$i++;
					if ($columns != 1) {
						$html .= "<div class='filler'></div>\n";
					}
				}

			else:
				?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'qode'); ?></p>
				<?php
			endif;


			$html .= "</div>";
			if (get_next_posts_link()) {
				if ($show_load_more == "yes" || $show_load_more == "") {
					$html .= '<div class="portfolio_paging"><span rel="' . $wp_query->max_num_pages . '" class="load_more">' . get_next_posts_link(__('Show more', 'qode')) . '</span></div>';
					$html .= '<div class="portfolio_paging_loading"><a href="javascript: void(0)" class="qbutton">'.__('Loading...', 'qode').'</a></div>';
				}
			}
			$html .= "</div>";
			wp_reset_query();
		}

		return $html;
	}

}
add_shortcode('portfolio_list', 'portfolio_list');

/* Portfolio Slider shortcode */

if (!function_exists('portfolio_slider')) {
	function portfolio_slider( $atts, $content = null ) {

		global $qode_options;
		$portfolio_qode_like = "on";
		if (isset($qode_options['portfolio_qode_like'])) {
			$portfolio_qode_like = $qode_options['portfolio_qode_like'];
		}

		$args = array(
			"order_by"          =>  "menu_order",
			"order"             =>  "ASC",
			"number"            =>  "-1",
			"category"          =>  "",
			"selected_projects" =>  "",
			"disable_link"      => "no",
			"lightbox"          => "yes",
			"show_like"         => "yes",
			"title_tag"         =>  "h5",
			"image_size"        =>  "portfolio-square",
			"enable_navigation" =>  ""
		);
		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		$portfolio_list_hide_category = false;
		if (isset($qode_options['portfolio_list_hide_category']) && $qode_options['portfolio_list_hide_category'] == "yes") {
			$portfolio_list_hide_category = true;
		}



		$html = "";
		$lightbox_slug = 'portfolio_slider_'.rand();


		$html .= "<div class='portfolio_slider_holder clearfix'><div class='portfolio_slider'><ul class='portfolio_slides'>";

		if ($category == "") {
			$q = array(
				'post_type' => 'portfolio_page',
				'orderby' => $order_by,
				'order' => $order,
				'posts_per_page' => $number
			);
		} else {
			$q = array(
				'post_type' => 'portfolio_page',
				'portfolio_category' => $category,
				'orderby' => $order_by,
				'order' => $order,
				'posts_per_page' => $number
			);
		}

		$project_ids = null;
		if ($selected_projects != "") {
			$project_ids = explode(",", $selected_projects);
			$q['post__in'] = $project_ids;
		}

		query_posts($q);

		if ( have_posts() ) : $postCount = 0; while ( have_posts() ) : the_post();

			$title = get_the_title();
			$terms = wp_get_post_terms(get_the_ID(), 'portfolio_category');

			//get proper image size
			switch($image_size) {
				case 'landscape':
					$thumb_size = 'portfolio-landscape';
					break;
				case 'portrait':
					$thumb_size = 'portfolio-portrait';
					break;
				case 'square':
					$thumb_size = 'portfolio-square';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
				default:
					$thumb_size = 'portfolio-default';
					break;
			}

			$featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumb_size);
			
			if(get_post_meta(get_the_ID(), 'qode_portfolio-lightbox-link', true) != ""){
				$large_image = get_post_meta(get_the_ID(), 'qode_portfolio-lightbox-link', true);
			} else {
				$large_image = $featured_image_array[0];
			}

			$custom_portfolio_link = get_post_meta(get_the_ID(), 'qode_portfolio-external-link', true);
			$portfolio_link = $custom_portfolio_link != "" ? $custom_portfolio_link : get_permalink();
			if(get_post_meta(get_the_ID(), 'qode_portfolio-external-link-target', true) != ""){
				$custom_portfolio_link_target = get_post_meta(get_the_ID(), 'qode_portfolio-external-link-target', true);
			} else {
				$custom_portfolio_link_target = '_blank';
			}

			$target = $custom_portfolio_link != "" ? $custom_portfolio_link_target : '_self';

			$html .= "<li class='item'>";
				$html .= "<div class='image_holder'>";
					$html .= "<span class='image'>";
						$html .= get_the_post_thumbnail(get_the_ID(), $thumb_size);
					$html .= "</span>"; /* close span.image */

					if($disable_link != "yes"){
						$html .= "<a class='portfolio_link_class' href='" . $portfolio_link . "' target='".$target."'></a>";
					}
					
					$html .= '<div class="portfolio_shader"></div>';

					$html .= '<div class="text_holder">';
						if(!$portfolio_list_hide_category){
							$html .= '<span class="project_category">';
								$html .= '<span>'. __('In ', 'qode') .'</span>';
								$k = 1;
								foreach ($terms as $term) {
									$html .= "$term->name";
									if (count($terms) != $k) {
										$html .= '/ ';
									}
									$k++;
								}
							$html .= '</span>';
						}
						
						$html .= '<'.$title_tag.' class="portfolio_title">' . get_the_title() . '</'.$title_tag.'>';

					$html .= "</div>";

					$html .= '<div class="icons_holder"><div class="icons_holder_inner">';
						if ($lightbox == "yes") {
							$html .= "<a class='portfolio_lightbox' title='" . $title . "' href='" . $large_image . "' data-rel='prettyPhoto[" . $lightbox_slug . "]'></a>";
						}

						if ($portfolio_qode_like == "on" && $show_like == "yes") {
							if (function_exists('qode_like_portfolio_list')) {
								$html .= qode_like_portfolio_list(get_the_ID());
							}
						}
					$html .= "</div></div>";
				$html .= "</div>"; /* close div.image_holder */
			$html .= "</li>";

			$postCount++;

		endwhile;

		else:
			$html .= __('Sorry, no posts matched your criteria.','qode');
		endif;

		wp_reset_query();

		$html .= "</ul>";
		if($enable_navigation){
			$html .= '<ul class="caroufredsel-direction-nav"><li><a id="caroufredsel-prev" class="caroufredsel-prev" href="#"><span class="arrow_carrot-left"></span></a></li><li><a class="caroufredsel-next" id="caroufredsel-next" href="#"><span class="arrow_carrot-right"></span></a></li></ul>';
		}
		$html .= "</div></div>";

		return $html;
	}
}
add_shortcode('portfolio_slider', 'portfolio_slider');

/* Progress bar horizontal shortcode */

if (!function_exists('progress_bar')) {

	function progress_bar($atts, $content = null) {
		$args = array(
			"title"                     => "",
			"title_color"               => "",
			"title_tag"                 => "h4",
			"title_custom_size"         => "",
			"percent"                   => "",
			"show_percent_mark"         => "with_mark",
			"percent_color"             => "",
			"percent_font_size"         => "",
			"percent_font_weight"       => "",
			"active_background_color"   => "",
			"active_border_color"       => "",
			"noactive_background_color" => "",
			"height"                    => "",
			"border_radius"            	=> ""
		);

		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		//init variables
		$html                           = "";
		$progress_title_holder_styles   = "";
		$number_styles                  = "";
		$outer_progress_styles          = "";
		$percentage_styles              = "";

		//generate styles
		if ($title_color != "") {
			$progress_title_holder_styles .= "color: " . $title_color . ";";
		}

		if($title_custom_size != "") {
			$progress_title_holder_styles .= "font-size: ".$title_custom_size."px;";
		}

		if ($percent_color != "") {
			$number_styles .= "color: " . $percent_color . ";";
		}

		if ($percent_font_size != "") {
			$number_styles .= "font-size: " . $percent_font_size . "px;";
		}
		if ($percent_font_weight != "") {
			$number_styles .= "font-weight: " . $percent_font_weight . ";";
		}
		if ($height != "") {
			$valid_height = (strstr($height, 'px', true)) ? $height : $height . "px";
			$outer_progress_styles .= "height: " . $valid_height . ";";
			$percentage_styles .= "height: " . $valid_height . ";";
		}

		if ($border_radius != "") {
			$border_radius = (strstr($height, 'px', true)) ? $border_radius : $border_radius . "px";
			$outer_progress_styles .= "border-radius: " . $border_radius . ";-moz-border-radius: " . $border_radius . ";-webkit-border-radius: " . $border_radius . ";";
		}

		if ($noactive_background_color != "") {
			$outer_progress_styles .= "background-color: " . $noactive_background_color . ";";
		}

		if ($active_background_color != "") {
			$percentage_styles .= "background-color: " . $active_background_color . ";";
		}

		if($active_border_color) {
			$percentage_styles .= "border-color: " . $active_border_color . ";";
		}

		$html .= "<div class='q_progress_bar'>";
		$html .= "<{$title_tag} class='progress_title_holder clearfix' style='{$progress_title_holder_styles}'>";
		$html .= "<span class='progress_title'>$title</span>"; //close progress_title

		$html .= "<span class='progress_number ".$show_percent_mark."' style='{$number_styles}'><span>0</span></span>";
		$html .= "</{$title_tag}>"; //close progress_title_holder

		$html .= "<div class='progress_content_outer' style='{$outer_progress_styles}'>";
		$html .= "<div data-percentage='" . $percent . "' class='progress_content' style='{$percentage_styles}'>";
		$html .="</div>"; //close progress_content
		$html .= "</div>"; //close progress_content_outer

		$html .= "</div>"; //close progress_bar
		return $html;
	}

	add_shortcode('progress_bar', 'progress_bar');
}

/* Progress bar vertical shortcode */

if (!function_exists('progress_bar_vertical')) {

	function progress_bar_vertical($atts, $content = null) {
		$args = array(
			"title"                     => "",
			"title_color"               => "",
			"title_tag"                 => "h5",
			"title_size"                => "",
			"percent"                   => "100",
			"show_percent_mark"         => "with_mark",
			"percentage_text_size"      => "",
			"percent_color"             => "",
			"bar_color"                 => "",
			"bar_border_color"          => "",
			"background_color"          => "",
			"border_radius"     	    => "",
			"text"                      => ""
		);

		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		//init variables
		$html               = "";
		$title_styles       = "";
		$bar_styles         = "";
		$percentage_styles  = "";
		$bar_holder_styles  = "";

		//generate styles
		if($title_color != "") {
			$title_styles .= "color:".$title_color.";";
		}

		if($title_size != "") {
			$title_styles .= "font-size:".$title_size."px;";
		}

		//generate bar holder gradient styles
		if($background_color != "") {
			$bar_holder_styles .= "background-color: " . $background_color . ";";
		}

		if($border_radius != "") {
			$bar_holder_styles .= "border-radius: " . $border_radius . "px " . $border_radius . "px 0 0;border-radius: " . $border_radius . "px " . $border_radius . "px 0 0;border-radius: " . $border_radius . "px " . $border_radius . "px 0 0;";
		}

		//generate bar gradient styles
		if($bar_color != "") {
			$bar_styles .= "background-color: " . $bar_color . ";";
		}

		if($bar_border_color != "") {
			$bar_styles .= "border-color: ".$bar_border_color;
		}

		if($percentage_text_size != "") {
			$percentage_styles .= "font-size: ".$percentage_text_size."px;";
		}

		if($percent_color != "") {
			$percentage_styles .= "color: ".$percent_color.";";
		}

		$html .= "<div class='q_progress_bars_vertical'>";
		$html .= "<div class='progress_content_outer' style='".$bar_holder_styles."'>";
		$html .= "<div data-percentage='$percent' class='progress_content' style='".$bar_styles."'></div>";
		$html .= "</div>"; //close progress_content_outer
		$html .= "<{$title_tag} class='progress_title' style='".$title_styles."'>$title</{$title_tag}>";
		$html .= "<span class='progress_number ".$show_percent_mark."' style='".$percentage_styles."'>";
		$html .= "<span>$percent</span>";
		$html .= "</span>"; //close progress_number
		$html .= "<span class='progress_text'>".$text."</span>"; //close progress_number
		$html .= "</div>"; //close progress_bars_vertical

		return $html;
	}

}
add_shortcode('progress_bar_vertical', 'progress_bar_vertical');

/* Progress bars icon shortcode */

if (!function_exists('progress_bar_icon')) {
	function progress_bar_icon($atts, $content = null) {

		$args =  array(
			"icons_number"              => "",
			"active_number"             => "",
			"type"                      => "",
			"icon_pack"                 => "",
			"fa_icon"                   => "",
			"fe_icon"                   => "",
			"linear_icon"               => "",
			"size"                      => "",
			"icon_color"                => "",
			"icon_active_color"         => "",
			"background_color"          => "",
			"background_active_color"   => "",
			"border_color"              => "",
			"border_active_color"       => ""
		);

		extract(shortcode_atts($args, $atts));
		$html =  "<div class='q_progress_bars_icons_holder'><div class='q_progress_bars_icons'><div class='q_progress_bars_icons_inner ".$type." ".$size;

		$html .= " clearfix' data-number='".$active_number."'>";

		$i = 0;
		while ($i < $icons_number) {
			$html .= "<div class='bar'><span class='bar_noactive fa-stack ";
			if($size != ""){
				if($size == "tiny"){
					$html .= "fa-lg";
				} else if($size == "small"){
					$html .= "fa-2x";
				} else if($size == "medium"){
					$html .= "fa-3x";
				} else if($size == "large"){
					$html .= "fa-4x";
				} else if($size == "very_large"){
					$html .= "fa-5x";
				}
			}
			$html .= "'";
			if($type == "circle" || $type == "square"){
				if($background_active_color != "" || $border_active_color != ""){
					$html .= " style='";
					if($background_active_color != ""){
						$html .= "background-color: ".$background_active_color.";";
					}
					if($border_active_color != ""){
						$html .= " border-color: ".$border_active_color.";";
					}
					$html .= "'";
				}
			}
			$html .= ">";

			if($icon_pack == 'font_awesome' && $fa_icon != ''){
				$html .= "<i class='fa fa-stack-1x ".$fa_icon."'";

				if($icon_active_color != ""){
					$html .= " style='color: ".$icon_active_color.";'";
				}

				$html .= "></i>";
			} elseif($icon_pack == 'font_elegant' && $fe_icon != ''){
				$html .= "<span class='q_font_elegant_icon ".$fe_icon."'";

				if($icon_active_color != ""){
					$html .= " style='color: ".$icon_active_color.";'";
				}

				$html .= "></span>";
			} elseif($icon_pack == 'linear_icons' && $linear_icon != ''){
				$html .= "<i class='lnr q_linear_icons_icon ".$linear_icon."'";

				if($icon_active_color != ""){
					$html .= " style='color: ".$icon_active_color.";'";
				}

				$html .= "></i>";
			}

			$html .= "</span><span class='bar_active fa-stack ";
			if($size != ""){
				if($size == "tiny"){
					$html .= "fa-lg";
				} else if($size == "small"){
					$html .= "fa-2x";
				} else if($size == "medium"){
					$html .= "fa-3x";
				} else if($size == "large"){
					$html .= "fa-4x";
				} else if($size == "very_large"){
					$html .= "fa-5x";
				}
			}
			$html .= "'";
			if($type == "circle" || $type == "square"){
				if($background_color != "" || $border_color != ""){
					$html .= " style='";
					if($background_color != ""){
						$html .= "background-color: ".$background_color.";";
					}
					if($border_color != ""){
						$html .= " border-color: ".$border_color.";";
					}
					$html .= "'";
				}
			}
			$html .= ">";

			if($icon_pack == 'font_awesome' && $fa_icon != ''){
				$html .= "<i class='fa ".$fa_icon." fa-stack-1x'";

				if($icon_color != ""){
					$html .= " style='color: ".$icon_color.";'";
				}

				$html .= "></i>";
			} elseif($icon_pack == 'font_elegant' && $fe_icon != ''){
				$html .= "<span class='q_font_elegant_icon ".$fe_icon."'";

				if($icon_color != ""){
					$html .= " style='color: ".$icon_color.";'";
				}

				$html .= "></span>";
			} elseif($icon_pack == 'linear_icons' && $linear_icon != ''){
				$html .= "<i class='lnr q_linear_icons_icon ".$linear_icon."'";

				if($icon_active_color != ""){
					$html .= " style='color: ".$icon_active_color.";'";
				}

				$html .= "></i>";
			}

			$html .= "</span></div>";


			$i++;
		}
		$html .= "</div></div></div>";
		return $html;
	}
}
add_shortcode('progress_bar_icon', 'progress_bar_icon');

/* Social Icon shortcode */

if (!function_exists('social_icons')) {
	function social_icons($atts, $content = null) {
		$args = array(
			"type"                   => "",
			"icon_pack"              => "",
			"fa_icon"                => "",
			"fe_icon"                => "",
			"link"                   => "",
			"target"                 => "",
			"size"                   => "",
			"icon_color"             => "",
			"background_color"       => "",
			"border_color"           => "",
			"icon_hover_color"       => "",
			"background_hover_color" => "",
			"border_hover_color"     => ""
		);

		extract(shortcode_atts($args, $atts));

		$html            		= "";
		$fa_stack_styles 		= "";
		$icon_styles     		= "";
		$icon_holder_classes 	= array();
		$data_attr              = "";

		if($link != "") {
			$icon_holder_classes[] = "with_link";
		}

		if($type != "") {
			$icon_holder_classes[] = $type;
		}

		if($icon_color != ""){
			$icon_styles .= "color: ".$icon_color.";";
		}

		if($background_color != ""){
			$fa_stack_styles .= "background-color: {$background_color};";
		}

		if($border_color != ""){
			$fa_stack_styles .= "border: 1px solid {$border_color};";
		}

		if($background_hover_color != "") {
            $data_attr .= "data-hover-background-color=".$background_hover_color." ";
        }

        if($border_hover_color != "") {
            $data_attr .= "data-hover-border-color=".$border_hover_color." ";
        }

        if($icon_hover_color != "") {
            $data_attr .= "data-hover-color=".$icon_hover_color;
        }

		$html .= "<span class='q_social_icon_holder ".implode(' ', $icon_holder_classes)."' $data_attr>";

		if($link != ""){
			$html .= "<a href='".$link."' target='".$target."'>";
		}

		if($type == "normal_social"){

			if($icon_pack == 'font_awesome' && $fa_icon != ""){
				$html .= "<i class='social_icon fa ".$fa_icon." ".$size." simple_social' style='".$icon_styles."'></i>";
			}
			elseif($icon_pack == 'font_elegant' && $fe_icon != ""){
				$html .= "<span class='social_icon ".$fe_icon." ".$size." simple_social' style='".$icon_styles."'></span>";
			}

		} else {

			$html .= "<span class='fa-stack ".$size." ".$type."' style='".$icon_styles.$fa_stack_styles."'>";

			if($icon_pack == 'font_awesome' && $fa_icon != ""){
				$html .= "<i class='social_icon fa ".$fa_icon."'></i>";
			} elseif($icon_pack == 'font_elegant' && $fe_icon != ""){
				$html .= "<span class='social_icon ".$fe_icon."'></span>";
			}

			$html .= "</span>"; //close fa-stack
		}

		if($link != ""){
			$html .= "</a>";
		}

		$html .= "</span>"; //close q_social_icon_holder
		return $html;
	}
}
add_shortcode('social_icons', 'social_icons');

/* Social Share shortcode */

if (!function_exists('social_share')) {
	function social_share($atts, $content = null) {
		global $qode_options;
		if(isset($qode_options['twitter_via']) && !empty($qode_options['twitter_via'])) {
			$twitter_via = " via " . $qode_options['twitter_via'] . " ";
		} else {
			$twitter_via = 	"";
		}
		if(isset($_SERVER["https"])) {
			$count_char = 23;
		} else{
			$count_char = 22;
		}
		$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		$html = "";
		if(isset($qode_options['enable_social_share']) && $qode_options['enable_social_share'] == "yes") {
			$post_type = get_post_type();
			if(isset($qode_options["post_types_names_$post_type"])) {
				if($qode_options["post_types_names_$post_type"] == $post_type) {
					if($post_type == "portfolio_page") {
						$html .= '<div class="portfolio_share">';
					} elseif($post_type == "post") {
						$html .= '<div class="blog_share">';
					} elseif($post_type == "page") {
						$html .= '<div class="page_share">';
					}
					$html .= '<div class="social_share_holder">';
					$html .= '<a href="javascript:void(0)" target="_self"><i class="social_share social_share_icon"></i>';
					$html .= '<span class="social_share_title">'.  __('Share','qode') .'</span>';
					$html .= '</a>';
					$html .= '<div class="social_share_dropdown"><ul>';
					if(isset($qode_options['enable_facebook_share']) &&  $qode_options['enable_facebook_share'] == "yes") {
						$html .= '<li class="facebook_share">';
                        if(wp_is_mobile()) {
                            $html .= '<a href="javascript:void(0)" onclick="window.open(\'http://m.facebook.com/sharer.php?u=' . urlencode(get_permalink());
                        }
                        else {
                            $html .= '<a href="javascript:void(0)" onclick="window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]=' . urlencode(qode_addslashes(get_the_title())) . '&amp;p[url]=' . urlencode(get_permalink()) . '&amp;p[images][0]=';
                            if (function_exists('the_post_thumbnail')) {
                                $html .= wp_get_attachment_url(get_post_thumbnail_id());
                            }
                        }
                        $html .= '&amp;p[summary]=' . urlencode(qode_addslashes(get_the_excerpt()));
						$html .='\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');">';
						if(!empty($qode_options['facebook_icon'])) {
							$html .= '<img src="' . $qode_options["facebook_icon"] . '" alt="" />';
						} else {
							$html .= '<span class="social_network_icon social_facebook_circle"></span>';
						}
						$html .= "<span class='share_text'>" . __("Facebook","qode") . "</span>";
						$html .= "</a>";
						$html .= "</li>";
					}

					if($qode_options['enable_twitter_share'] == "yes") {
						$html .= '<li class="twitter_share">';
                        if(wp_is_mobile()) {
                            $html .= '<a href="#" onclick="popUp=window.open(\'https://twitter.com/intent/tweet?text=' . urlencode(the_excerpt_max_charlength($count_char) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;">';
                        }
                        else {
                            $html .= '<a href="#" onclick="popUp=window.open(\'http://twitter.com/home?status=' . urlencode(the_excerpt_max_charlength($count_char) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;">';
                        }
						if(!empty($qode_options['twitter_icon'])) {
							$html .= '<img src="' . $qode_options["twitter_icon"] . '" alt="" />';
						} else {
							$html .= '<span class="social_network_icon social_twitter_circle"></span>';
						}
						$html .= "<span class='share_text'>" . __("Twitter", 'qode') . "</span>";
						$html .= "</a>";
						$html .= "</li>";
					}
					if($qode_options['enable_google_plus'] == "yes") {
						$html .= '<li  class="google_share">';
						$html .= '<a href="#" onclick="popUp=window.open(\'https://plus.google.com/share?url=' . urlencode(get_permalink()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
						if(!empty($qode_options['google_plus_icon'])) {
							$html .= '<img src="' . $qode_options['google_plus_icon'] . '" alt="" />';
						} else {
							$html .= '<span class="social_network_icon social_googleplus_circle"></span>';
						}
						$html .= "<span class='share_text'>" . __("Google+","qode") . "</span>";
						$html .= "</a>";
						$html .= "</li>";
					}
					if(isset($qode_options['enable_linkedin']) && $qode_options['enable_linkedin'] == "yes") {
						$html .= '<li  class="linkedin_share">';
						$html .= '<a href="#" onclick="popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()). '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
						if(!empty($qode_options['linkedin_icon'])) {
							$html .= '<img src="' . $qode_options['linkedin_icon'] . '" alt="" />';
						} else {
							$html .= '<span class="social_network_icon social_linkedin_circle"></span>';
						}
						$html .= "<span class='share_text'>" . __("LinkedIn","qode") . "</span>";
						$html .= "</a>";
						$html .= "</li>";
					}
					if(isset($qode_options['enable_tumblr']) && $qode_options['enable_tumblr'] == "yes") {
						$html .= '<li  class="tumblr_share">';
						$html .= '<a href="#" onclick="popUp=window.open(\'http://www.tumblr.com/share/link?url=' . urlencode(get_permalink()). '&amp;name=' . urlencode(get_the_title()) .'&amp;description='.urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
						if(!empty($qode_options['tumblr_icon'])) {
							$html .= '<img src="' . $qode_options['tumblr_icon'] . '" alt="" />';
						} else {
							$html .= '<span class="social_network_icon social_tumblr_circle"></span>';
						}
						$html .= "<span class='share_text'>" . __("Tumblr","qode") . "</span>";
						$html .= "</a>";
						$html .= "</li>";
					}
					if(isset($qode_options['enable_pinterest']) && $qode_options['enable_pinterest'] == "yes") {
						$html .= '<li  class="pinterest_share">';
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
						$html .= '<a href="#" onclick="popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()). '&amp;description=' . qode_addslashes(get_the_title()) .'&amp;media='.urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
						if(!empty($qode_options['pinterest_icon'])) {
							$html .= '<img src="' . $qode_options['pinterest_icon'] . '" alt="" />';
						} else {
							$html .= '<span class="social_network_icon social_pinterest_circle"></span>';
						}
						$html .= "<span class='share_text'>" . __("Pinterest","qode") . "</span>";
						$html .= "</a>";
						$html .= "</li>";
					}
                    if(isset($qode_options['enable_vk']) && $qode_options['enable_vk'] == "yes") {
                        $html .= '<li  class="vk_share">';
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $html .= '<a href="#" onclick="popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode(get_permalink()). '&amp;title=' . urlencode(get_the_title()) .'&amp;description=' . urlencode(get_the_excerpt()) .'&amp;image='.urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
                        if(!empty($qode_options['vk_icon'])) {
                           $html .= '<img src="' . $qode_options['vk_icon'] . '" alt="" />';
                        } else {
                           $html .= '<i class="fa fa-vk"></i>';
                        }
                        $html .= "<span class='share_text'>" . __("VK","qode") . "</span>";
                        $html .= "</a>";
                        $html .= "</li>";
                    }
					$html .= "</ul></div>";
					$html .= "</div>";

					if($post_type == "portfolio_page" || $post_type == "post" || $post_type == "page") {
						$html .= '</div>';
					}
				}
			}
		}
		return $html;
	}
}
add_shortcode('social_share', 'social_share');

/* Social Share List shortcode */

if (!function_exists('social_share_list')) {
	function social_share_list($atts, $content = null) {
		$args = array(
			"list_type"    => "circle"
		);
		extract(shortcode_atts($args, $atts));
		global $qode_options;
		if(isset($qode_options['twitter_via']) && !empty($qode_options['twitter_via'])) {
			$twitter_via = " via " . $qode_options['twitter_via'] . " ";
		} else {
			$twitter_via = 	"";
		}
		$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		$html = "";
		if(isset($qode_options['enable_social_share']) && $qode_options['enable_social_share'] == "yes") {
			$post_type = get_post_type();

			if(isset($qode_options["post_types_names_$post_type"])) {
				if($qode_options["post_types_names_$post_type"] == $post_type) {
					$html .= '<div class="social_share_list_holder ' . $list_type . '">';
					$html .= '<ul>';

					if(isset($qode_options['enable_facebook_share']) &&  $qode_options['enable_facebook_share'] == "yes") {
						$html .= '<li class="facebook_share">';
                        if(wp_is_mobile()) {
                            $html .= '<a title="'.__("Share on Facebook","qode").'" href="javascript:void(0)" onclick="window.open(\'http://m.facebook.com/sharer.php?u=' . urlencode(get_permalink());
                        }
                        else {
                            $html .= '<a title="'.__("Share on Facebook","qode").'" href="javascript:void(0)" onclick="window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]=' . urlencode(qode_addslashes(get_the_title())) . '&amp;p[url]=' . urlencode(get_permalink()) . '&amp;p[images][0]=';
                            if(function_exists('the_post_thumbnail')) {
                                $html .=  wp_get_attachment_url(get_post_thumbnail_id());
                            }
                        }

                        $html .= '&amp;p[summary]=' . urlencode(qode_addslashes(strip_tags(get_the_excerpt())));
						$html .='\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');">';
						if(!empty($qode_options['facebook_icon'])) {
							$html .= '<img src="' . $qode_options["facebook_icon"] . '" alt="" />';
						} else {
							if($list_type == 'circle') {
								$html .= '<i class="social_facebook_circle"></i>';
							}
							else {
								$html .= '<i class="social_facebook"></i>';
							}
						}
						$html .= "</a>";
						$html .= "</li>";
					}

					if($qode_options['enable_twitter_share'] == "yes") {
						$html .= '<li class="twitter_share">';
                        if(wp_is_mobile()) {
                            $html .= '<a href="#" title="'.__("Share on Twitter", 'qode').'" onclick="popUp=window.open(\'http://twitter.com/intent/tweet?text=' . urlencode(the_excerpt_max_charlength(mb_strlen(get_permalink())) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;">';
                        }
                        else {
                            $html .= '<a href="#" title="'.__("Share on Twitter", 'qode').'" onclick="popUp=window.open(\'http://twitter.com/home?status=' . urlencode(the_excerpt_max_charlength(mb_strlen(get_permalink())) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;">';
                        }
						if(!empty($qode_options['twitter_icon'])) {
							$html .= '<img src="' . $qode_options["twitter_icon"] . '" alt="" />';
						} else {
							if($list_type == 'circle') {
								$html .= '<i class="social_twitter_circle"></i>';
							}
							else {
								$html .= '<i class="social_twitter"></i>';
							}
						}

						$html .= "</a>";
						$html .= "</li>";
					}
					if($qode_options['enable_google_plus'] == "yes") {
						$html .= '<li  class="google_share">';
						$html .= '<a href="#" title="'.__("Share on Google+","qode").'" onclick="popUp=window.open(\'https://plus.google.com/share?url=' . urlencode(get_permalink()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
						if(!empty($qode_options['google_plus_icon'])) {
							$html .= '<img src="' . $qode_options['google_plus_icon'] . '" alt="" />';
						} else {
							if($list_type == 'circle') {
								$html .= '<i class="social_googleplus_circle"></i>';
							}
							else {
								$html .= '<i class="social_googleplus"></i>';
							}
						}

						$html .= "</a>";
						$html .= "</li>";
					}
					if(isset($qode_options['enable_linkedin']) && $qode_options['enable_linkedin'] == "yes") {
						$html .= '<li  class="linkedin_share">';
						$html .= '<a href="#" class="'.__("Share on LinkedIn","qode").'" onclick="popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()). '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
						if(!empty($qode_options['linkedin_icon'])) {
							$html .= '<img src="' . $qode_options['linkedin_icon'] . '" alt="" />';
						} else {
							if($list_type == 'circle') {
								$html .= '<i class="social_linkedin_circle"></i>';
							}
							else {
								$html .= '<i class="social_linkedin"></i>';
							}
						}

						$html .= "</a>";
						$html .= "</li>";
					}
					if(isset($qode_options['enable_tumblr']) && $qode_options['enable_tumblr'] == "yes") {
						$html .= '<li  class="tumblr_share">';
						$html .= '<a href="#" title="'.__("Share on Tumblr","qode").'" onclick="popUp=window.open(\'http://www.tumblr.com/share/link?url=' . urlencode(get_permalink()). '&amp;name=' . urlencode(get_the_title()) .'&amp;description='.urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
						if(!empty($qode_options['tumblr_icon'])) {
							$html .= '<img src="' . $qode_options['tumblr_icon'] . '" alt="" />';
						} else {
							if($list_type == 'circle') {
								$html .= '<i class="social_tumblr_circle"></i>';
							}
							else {
								$html .= '<i class="social_tumblr"></i>';
							}
						}

						$html .= "</a>";
						$html .= "</li>";
					}
					if(isset($qode_options['enable_pinterest']) && $qode_options['enable_pinterest'] == "yes") {
						$html .= '<li  class="pinterest_share">';
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
						$html .= '<a href="#" title="'.__("Share on Pinterest","qode").'" onclick="popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()). '&amp;description=' . qode_addslashes(get_the_title()) .'&amp;media='.urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
						if(!empty($qode_options['pinterest_icon'])) {
							$html .= '<img src="' . $qode_options['pinterest_icon'] . '" alt="" />';
						} else {
							if($list_type == 'circle') {
								$html .= '<i class="social_pinterest_circle"></i>';
							}
							else {
								$html .= '<i class="social_pinterest"></i>';
							}
						}

						$html .= "</a>";
						$html .= "</li>";
					}
                   if(isset($qode_options['enable_vk']) && $qode_options['enable_vk'] == "yes") {
                       $html .= '<li  class="vk_share">';
                       $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                       $html .= '<a href="#" title="'.__("Share on VK","qode").'" onclick="popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode(get_permalink()). '&amp;title=' . urlencode(get_the_title()) .'&amp;description=' . urlencode(get_the_excerpt()) .'&amp;image='.urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
                       if(!empty($qode_options['vk_icon'])) {
                           $html .= '<img src="' . $qode_options['vk_icon'] . '" alt="" />';
                       } else {
                           $html .= '<i class="fa fa-vk"></i>';
                       }

                       $html .= "</a>";
                       $html .= "</li>";
                   }

					$html .= '</ul>'; //close ul
					$html .= '</div>'; //close div.social_share_list_holder
				}
			}
		}
		return $html;
	}

	add_shortcode('social_share_list', 'social_share_list');
}

/* Team shortcode */

if (!function_exists('q_team')) {
	function q_team($atts, $content = null) {
		$args = array(
			"team_type"									=> "",
			"team_image"								=> "",
			"team_image_hover_color"					=> "",
			"team_name"									=> "",
			"team_name_tag"							    => "h4",
			"team_name_color"							=> "",
			"team_name_font_size"						=> "",
			"team_name_font_weight"						=> "",
			"team_name_text_transform"                  => "",
			"team_position"								=> "",
			"team_position_color"						=> "",
			"team_position_font_size"					=> "",
			"team_position_font_weight"					=> "",
			"team_position_text_transform"              => "",
			"team_description"							=> "",
			"team_description_color"					=> "",
			"text_align"                                => "",
			"background_color"							=> "",
			"box_border"								=> "",
			"box_border_width"							=> "",
			"box_border_color"							=> "",

			"team_social_icon_pack"     				=> "",
			"team_social_icon_type"     				=> "circle_social",
			"team_social_icon_color"    				=> "",
			"team_social_icon_background_color"    		=> "",
			"team_social_icon_border_color"	    		=> "",
			"team_social_icon_hover_color"              => "",
			"team_social_background_hover_color"        => "",
			"team_social_border_hover_color"            => "",

			"team_social_fa_icon_1"						=> "",
			"team_social_fe_icon_1"						=> "",
			"team_social_icon_1_link"					=> "",
			"team_social_icon_1_target"					=> "",

			"team_social_fa_icon_2"						=> "",
			"team_social_fe_icon_2"						=> "",
			"team_social_icon_2_link"					=> "",
			"team_social_icon_2_target"					=> "",

			"team_social_fa_icon_3"						=> "",
			"team_social_fe_icon_3"						=> "",
			"team_social_icon_3_link"					=> "",
			"team_social_icon_3_target"					=> "",

			"team_social_fa_icon_4"						=> "",
			"team_social_fe_icon_4"						=> "",
			"team_social_icon_4_link"					=> "",
			"team_social_icon_4_target"					=> "",

			"team_social_fa_icon_5"     				=> "",
			"team_social_fe_icon_5"     				=> "",
			"team_social_icon_5_link"   				=> "",
			"team_social_icon_5_target" 				=> "",

			"show_skills"								=> "no",
			"skills_title_size"							=> "",
			"skill_title_1"								=> "",
			"skill_percentage_1"						=> "",
			"skill_title_2"								=> "",
			"skill_percentage_2"						=> "",
			"skill_title_3"								=> "",
			"skill_percentage_3"						=> "",
		);

		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$team_name_tag = (in_array($team_name_tag, $headings_array)) ? $team_name_tag : $args['team_name_tag'];
		
		if(is_numeric($team_image)) {
			$team_image_src = wp_get_attachment_url( $team_image );
		} else {
			$team_image_src = $team_image;
		}

		$q_team_holder_classes = array();

		if($background_color != "" || ($box_border != "")) {
			$q_team_holder_classes[] = "with_padding";
		}

		if($team_type == "info_hover") {
			$q_team_holder_classes[] = "info_hover";
		}

		$q_team_style = "";
		if($background_color != ""){
			$q_team_style .= " style='";
			$q_team_style .= 'background-color:' . $background_color . ';';
			$q_team_style .= "'";
		}

		$q_team_image_hover_style = "";
		if($team_image_hover_color != ""){
			$q_team_image_hover_style .= " style='";
			$q_team_image_hover_style .= 'background-color:' . $team_image_hover_color . ';';
			$q_team_image_hover_style .= "'";
		}

		$qteam_box_style = "";
		if($box_border == "yes"){

			$qteam_box_style .= "style=";

			$qteam_box_style .= "border-style:solid;";
			if($box_border_color != "" ){
				$qteam_box_style .= "border-color:" . $box_border_color . ";";
			}
			if($box_border_width != "" ){
				$qteam_box_style .= "border-width:" . $box_border_width . "px;";
			}

			$qteam_box_style .= "'";

		}

		$q_team_name_style_array = array();
		$q_team_name_style 		 = '';

		if($team_name_color != '') {
			$q_team_name_style_array[] = 'color: '.$team_name_color;
		}

		if($team_name_font_size != '') {
			$q_team_name_style_array[] = 'font-size: '.$team_name_font_size.'px';
		}

		if($team_name_font_weight != '') {
			$q_team_name_style_array[] = 'font-weight: '.$team_name_font_weight;
		}

		if($team_name_text_transform != '') {
			$q_team_name_style_array[] = 'text-transform: '.$team_name_text_transform;
		}

		if(is_array($q_team_name_style_array) && count($q_team_name_style_array)) {
			$q_team_name_style = 'style ="'.implode(';', $q_team_name_style_array).'"';
		}

		$q_team_position_style_array = array();
		$q_team_position_style 		 = '';

		if($team_position_color != '') {
			$q_team_position_style_array[] = 'color: '.$team_position_color;
		}

		if($team_position_font_size != '') {
			$q_team_position_style_array[] = 'font-size: '.$team_position_font_size.'px';
		}

		if($team_position_font_weight != '') {
			$q_team_position_style_array[] = 'font-weight: '.$team_position_font_weight;
		}

		if($team_position_text_transform != '') {
			$q_team_position_style_array[] = 'text-transform: '.$team_position_text_transform;
		}

		if(is_array($q_team_position_style_array) && count($q_team_position_style_array)) {
			$q_team_position_style = 'style ="'.implode(';', $q_team_position_style_array).'"';
		}

		$q_team_description_style_array  = array();
		$q_team_description_style 		 = '';

		if($team_description_color != '') {
			$q_team_description_style_array[] = 'color: '.$team_description_color;
		}
		
		if(is_array($q_team_description_style_array) && count($q_team_description_style_array)) {
			$q_team_description_style = 'style ="'.implode(';', $q_team_description_style_array).'"';
		}

			$html =  "<div class='q_team ".implode(' ', $q_team_holder_classes)."'". $q_team_style .">";
			$html .=  "<div class='q_team_inner'>";
			if($team_image != "") {
				$html .=  "<div class='q_team_image'>";
				$html .= "<img src='$team_image_src' alt='team_image' />";
				$html .=  "<div class='q_team_social_holder' ".$q_team_image_hover_style.">";
				$html .=  "<div class='q_team_social'>";
				$html .=  "<div class='q_team_social_inner'>";


				if($team_type == 'info_hover'){
					// html for info hover type
					$html .=  "<div class='q_team_title_holder'>";
					$html .=  "<$team_name_tag class='q_team_name' ".$q_team_name_style.">";
					$html .= $team_name;
					$html .=  "</$team_name_tag>";
					if($team_position != "") {
						$html .= "<h6 class='q_team_position' ".$q_team_position_style.">" . $team_position . "</h6>";
					}
					$html .=  "</div>"; //close div.q_team_title_holder
				}

				//generate social icons html
				$team_social_icon_type_label = ''; //used in generating shortcode parameters based on icon pack
				$team_social_icon_param_label = ''; //used in generating shortcode parameters based on icon pack

				//is font awesome icon pack chosen?
				if($team_social_icon_pack == 'font_awesome') {
					$team_social_icon_type_label = 'team_social_fa_icon';
					$team_social_icon_param_label = 'fa_icon';
				} else {
					$team_social_icon_type_label = 'team_social_fe_icon';
					$team_social_icon_param_label = 'fe_icon';
				}

				if($team_type == 'info_hover'){ $html .=  "<div class='q_team_social_on_hover'>"; }

				//for each of available icons
				for($i = 1; $i <= 5; $i++) {
					$team_social_icon 		= ${$team_social_icon_type_label.'_'.$i};
					$team_social_link 		= ${'team_social_icon_'.$i.'_link'};
					$team_social_target		= ${'team_social_icon_'.$i.'_target'};

					if($team_social_icon != "") {
						$social_icons_param_array = array();

						$social_icons_param_array[] = $team_social_icon_param_label."='".$team_social_icon."'";

						if($team_social_link !== '') {
							$social_icons_param_array[] = "link='".$team_social_link."'";
						}

						if($team_social_target !== '') {
							$social_icons_param_array[] = "target='".$team_social_target."'";
						} else {
							$social_icons_param_array[] = "target='_self'";
						}

						if($team_social_icon_type !== '') {
							$social_icons_param_array[] = "type='".$team_social_icon_type."'";
						}

						if($team_social_icon_color !== '') {
							$social_icons_param_array[] = "icon_color='".$team_social_icon_color."'";
						}

						if($team_social_icon_background_color !== '') {
							$social_icons_param_array[] = "background_color='".$team_social_icon_background_color."'";
						}

						if($team_social_icon_border_color !== '') {
							$social_icons_param_array[] = "border_color='".$team_social_icon_border_color."'";
						}

						if($team_social_icon_hover_color !== ''){
							$social_icons_param_array[] = "icon_hover_color='".$team_social_icon_hover_color."'";
						}

						if($team_social_background_hover_color !== ''){
							$social_icons_param_array[] = "background_hover_color='".$team_social_background_hover_color."'";
						}

						if($team_social_border_hover_color !== ''){
							$social_icons_param_array[] = "border_hover_color='".$team_social_border_hover_color."'";
						}


							$html .=  do_shortcode('[social_icons icon_pack="'.$team_social_icon_pack.'" '.implode(' ', $social_icons_param_array).']');

					}

				}

				if($team_type == 'info_hover'){ $html .=  "</div>"; }

				$html .=  "</div></div></div>"; //close div.q_team_social_holder
				$html .=  "</div>"; //close div.q_team_image
			}
			if(($team_type == 'info_hover' && ($team_description != '' || $show_skills == 'yes')) || $team_type == '') {
				$html .=  "<div class='q_team_text ".$text_align."' ". $qteam_box_style .">";
				$html .=  "<div class='q_team_text_inner'>";


				if($team_type != 'info_hover') {
					$html .= "<div class='q_team_title_holder'>";
					if ($team_position != "") {
						$html .= "<h6 class='q_team_position' " . $q_team_position_style . ">" . $team_position . "</h6>";
					}
					$html .= "<$team_name_tag class='q_team_name' " . $q_team_name_style . ">";
					$html .= $team_name;
					$html .= "</$team_name_tag>";
					$html .= "</div>"; //close div.q_team_title_holder
				}

				if($team_description != "") {

					$html .= "<div class='q_team_description'>";
					$html .= "<p ".$q_team_description_style.">".$team_description."</p>";
					$html .= "</div>"; // close div.q_team_description
				}

				if($show_skills == 'yes') {
					$html .= '<div class="q_team_skills_holder">';

					for($i = 1; $i <=3; $i++) {
						$skill_title = ${"skill_title_".$i};
						$skill_percentage = ${"skill_percentage_".$i};

						if($skill_title != '' && $skill_percentage != '') {

							$skills_param_array = array(
								'title ="'.$skill_title.'"',
								'percent = '.$skill_percentage
							);

							if($skills_title_size != '') {
								$skills_param_array[] = 'title_custom_size = '.$skills_title_size;
							}

							$html .= do_shortcode('[progress_bar '.implode(' ', $skills_param_array).']');
						}
					}

					$html .= '</div>';
				}

				$html .=  "</div>"; //close div.q_team_text_inners
				$html .=  "</div>"; //close div.q_team_text
			}

			$html .=  "</div>"; //close div.q_team_inner
			$html .=  "</div>"; //close div.q_team

		return $html;
	}
}
add_shortcode('q_team', 'q_team');


/* Testimonials shortcode */

if (!function_exists('testimonials')) {

	function testimonials($atts, $content = null) {
		$deafult_args = array(
			"type"						=> "",
			"number"					=> "-1",
			"category"					=> "",
			"show_author_image"			=> "",
			"show_title"				=> "",
			"text_color"				=> "",
			"text_font_size"			=> "",
			"author_text_color"			=> "",
			"show_author_job_position"	=> "",
			"text_align"                => "left_align",
			"show_navigation"			=> "",
			"navigation_style"			=> "",
			"auto_rotate_slides"		=> "",
			"animation_type"			=> "",
			"animation_speed"			=> ""
		);

		extract(shortcode_atts($deafult_args, $atts));

		$html                           = "";
		$testimonial_p_style			= "";
		$navigation_button_radius		= "";
		$testimonial_name_styles        = "";

		if($text_font_size != "" || $text_color != ""){
			$testimonial_p_style = " style='";
			if($text_font_size != ""){
				$testimonial_p_style .= "font-size:". $text_font_size . "px;";
			}
			if($text_color != ""){
				$testimonial_p_style .= "color:". $text_color . ";";
			}
			$testimonial_p_style .= "'";
		}

		if($author_text_color != "") {
			$testimonial_name_styles .= "color: ".$author_text_color.";";
		}

		$args = array(
			'post_type' => 'testimonials',
			'orderby' => "date",
			'order' => "DESC",
			'posts_per_page' => $number
		);

		if ($category != "") {
			$args['testimonials_category'] = $category;
		}

		$html .= "<div class='testimonials_holder clearfix " . $navigation_style . " " . $type . "'>";
		$html .= '<div class="testimonials testimonials_carousel" data-show-navigation="'.$show_navigation.'" data-animation-type="'.$animation_type.'" data-animation-speed="'.$animation_speed.'" data-auto-rotate-slides="'.$auto_rotate_slides.'">';
		$html .= '<ul class="slides">';
		$i = 0;
		$opened = false;
		query_posts($args);
		if (have_posts()) :
			while (have_posts()) : the_post();
				$author = get_post_meta(get_the_ID(), "qode_testimonial-author", true);
				$text = get_post_meta(get_the_ID(), "qode_testimonial-text", true);
				$job = get_post_meta(get_the_ID(), "qode_testimonial-job", true);
				if($type == 'grouped') {
					$i++;
					if($i%3 == 1){
						$html .= '<li id="testimonials' . get_the_ID() . '" class="testimonial_content">';
						$opened = true;
					}
					$html .= '<div class="testimonial_content_grouped_item">';
					$html .= '<div class="testimonial_content_inner">';
					$html .= '<div class="testimonial_text_holder '.$text_align.'">';
					$html .= '<div class="testimonial_text_inner">';
					if($show_author_image == 'yes') {
						$html .= '<div class="testimonial_image_holder">';
						$html .= get_the_post_thumbnail(get_the_ID());
						$html .= '</div>';
					}
					$html .= '<p'. $testimonial_p_style .'>' . trim($text) . '</p>';

					$html .= '<p class="testimonial_author" style="'.$testimonial_name_styles.'">- ' . $author;
					if($show_author_job_position == 'yes') {
						$html .= '<span class="testimonial_author_job">' . $job . '</span>';
					}
					$html .= '</p>';
					$html .= '</div>'; //close testimonial_text_inner
					$html .= '</div>'; //close testimonial_text_holder

					$html .= '</div>'; //close testimonial_content_inner
					$html .= '</div>'; //close testimonial_content_grouped_item

					if($i%3 == 0) {
						$html .= '</li>';
						$opened = false;
					}

				}
				else {
					$html .= '<li id="testimonials' . get_the_ID() . '" class="testimonial_content">';
					$html .= '<div class="testimonial_content_inner">';
					$html .= '<div class="testimonial_text_holder '.$text_align.'">';
					$html .= '<div class="testimonial_text_inner">';
					if($show_author_image == 'yes') {
						$html .= '<div class="testimonial_image_holder">';
						$html .= get_the_post_thumbnail(get_the_ID());
						$html .= '</div>';
					}
					if($show_title == 'yes') {
						$html .= '<p class="testimonial_title">' . get_the_title(get_the_ID()) . '</p>';
					}
					$html .= '<p'. $testimonial_p_style .'>' . trim($text) . '</p>';

					$html .= '<p class="testimonial_author" style="'.$testimonial_name_styles.'">- ' . $author;
					if($show_author_job_position == 'yes') {
						$html .= '<span class="testimonial_author_job">' . $job . '</span>';
					}
					$html .= '</p>';
					$html .= '</div>'; //close testimonial_text_inner
					$html .= '</div>'; //close testimonial_text_holder

					$html .= '</div>'; //close testimonial_content_inner
					$html .= '</li>'; //close testimonials
				}

			endwhile;
		else:
			$html .= __('Sorry, no posts matched your criteria.', 'qode');
		endif;

		wp_reset_query();
		if($type == 'grouped' && $opened) {
			$html .= '</li>';
		}
		$html .= '</ul>';//close slides
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}

}
add_shortcode('testimonials', 'testimonials');

/* Unordered List shortcode */

if (!function_exists('unordered_list')) {
	function unordered_list($atts, $content = null) {
		$args = array(
			"style"         => "",
			"animate"       => "",
			'number_type'   => "",
			"font_weight"   => ""
		);

		extract(shortcode_atts($args, $atts));

		$list_item_classes = "";

		if($style != "") {
			$list_item_classes .= "{$style}";
		}

		if($number_type != "") {
			$list_item_classes .= " {$number_type}";
		}

		if($font_weight != "") {
			$list_item_classes .= " {$font_weight}";
		}

		$html =  "<div class='q_list $list_item_classes";
		if($animate == "yes"){
			$html .= " animate_list'>" . $content . "</div>";
		} else {
			$html .= "'>" . $content . "</div>";
		}
		return $html;
	}
}
add_shortcode('unordered_list', 'unordered_list');

/* Service table shortcode */

if (!function_exists('service_table')) {
	function service_table($atts, $content = null) {
		global $qode_options;
		$args = array(
			"title"                    	=> "",
			"title_tag"                	=> "h4",
			"title_color"              	=> "",
			"title_background_type"    	=> "",
			"title_background_color"   	=> "",
			"background_image"         	=> "",
			"background_image_height"  	=> "",
			"icon_pack"              	=> "",
			"fa_icon"                	=> "",
			"fe_icon"                	=> "",
			"linear_icon"              	=> "",
			"custom_size"              	=> "",
			"border"					=> "",
			"border_width"              => "",
			"border_color"              => "",
			"content_background_color" 	=> ""
		);

		extract(shortcode_atts($args, $atts));

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

		//init variables
		$html = "";
		$title_holder_style = "";
		$title_style = "";
		$title_classes = "";
		$icon_style = "";
		$content_style = "";
		$service_table_holder_style = "";
		$service_table_style = "";
		$background_image_src = "";

		if($title_background_type == "background_color_type"){
			if($title_background_color != ""){
				$title_holder_style .= "background-color: ".$title_background_color.";";
			}

		} else {
			if(is_numeric($background_image)) {
				$background_image_src = wp_get_attachment_url( $background_image );
			} else {
				$background_image_src = $background_image;
			}

			if(!empty($qode_options['first_color'])){
				$service_table_style = $qode_options['first_color'];
			} else {
				$service_table_style = "#00c6ff";
			}

			if($background_image != ""){
				$title_holder_style .= "background-image: url(".$background_image_src.");";
			}

			if($background_image_height != ""){
				$title_holder_style .= "height: ".$background_image_height."px;";
			}
		}
		if($border == "yes"){
			$service_table_holder_style .= " style='border-style:solid;";
			if($border_width != ""){
				$service_table_holder_style .= "border-width:". $border_width . "px;";
			}
			if($border_color != ""){
				$service_table_holder_style .= "border-color:". $border_color . ";";
			}
			$service_table_holder_style .="'";
		}
		if($title_color != ""){
			$title_style .= "color: ".$title_color.";";

			$title_holder_style .= "color: ".$title_color.";";
		}

		$title_classes .= $title_background_type;

		if($custom_size != ""){
			$icon_style .= "font-size: ".$custom_size."px;";
		}

		if($content_background_color != ""){
			$content_style .= "background-color: ".$content_background_color.";";
		}

		$html .= "<div class='service_table_holder'". $service_table_holder_style ."><ul class='service_table_inner'>";

		$html .= "<li class='service_table_title_holder ".$title_classes."' style='".$title_holder_style."'>";

		$html .= "<div class='service_table_title_inner'><div class='service_table_title_inner2'>";

		if($title != ""){
			$html .= "<".$title_tag." class='service_title' style='".$title_style."'>".$title."</".$title_tag.">";
		}
		
		$html .= "</div></div>";

		$html .= "</li>";

		$html .= "<li class='service_icon' style='".$content_style."'>";
		
		if ($icon_pack == 'font_awesome' && $fa_icon != ''){
			if($fa_icon != ""){
				$html .= "<i class='service_table_icon fa ".$fa_icon."' style='".$icon_style."'></i>";
			}
		} elseif ($icon_pack == 'font_elegant' && $fe_icon != ''){
			if($fe_icon != ""){
				$html .= "<span class='service_table_icon ".$fe_icon."' style='".$icon_style."'></span>";
			}
		} elseif ($icon_pack == 'linear_icons' && $linear_icon != ''){
			if($linear_icon != ""){
				$html .= "<i class='service_table_icon lnr ".$linear_icon."' style='".$icon_style."'></i>";
			}
		}

		$html .= "</li>";

		$html .= "<li class='service_table_content' style='".$content_style."'>";

		$html .= do_shortcode($content);

		$html .= "</li>";

		$html .= "</ul></div>";

		return $html;
	}
}
add_shortcode('service_table', 'service_table');

/* Qode Slider shortcode */

if (!function_exists('qode_slider')) {
	function qode_slider( $atts, $content = null ) {
		global $qode_options;
		extract(shortcode_atts(array("slider"=>"", "height"=>"", "responsive_height"=>"", "background_color"=>"", "auto_start"=>"", "animation_type"=>"", "slide_animation"=>"6000", "anchor" => "", "show_navigation" => "yes", "show_control" => "yes", "control_position" => "center"), $atts));
		$html = "";

		if ($slider != "") {
			$args = array(
				'post_type'=> 'slides',
				'slides_category' => $slider,
				'orderby' => "menu_order",
				'order' => "ASC",
				'posts_per_page' => -1
			);

			$slider_id = get_term_by('slug',$slider,'slides_category')->term_id;
			$slider_meta = get_option( "taxonomy_term_".$slider_id );
			$slider_header_effect =  $slider_meta['header_effect'];
			if($slider_header_effect == 'yes'){
				$header_effect_class = 'header_effect';
			}else{
				$header_effect_class = '';
			}

			$slider_css_position_class = '';
			$slider_parallax = 'yes';
			if(isset($slider_meta['slider_parallax_effect'])){
				$slider_parallax = $slider_meta['slider_parallax_effect'];
			}
			if($slider_parallax == 'no' || (isset($qode_options['paspartu']) && $qode_options['paspartu'] == 'yes')){
				$data_parallax_effect = 'data-parallax="no"';
				$slider_css_position_class = 'relative_position';
			}else{
				$data_parallax_effect = 'data-parallax="yes"';
			}

			$slider_thumbs =  'no';
			if($slider_thumbs == 'yes'){
				$slider_thumbs_class = 'slider_thumbs';
			}else{
				$slider_thumbs_class = '';
			}

			if($height == "" || $height == "0"){
				$full_screen_class = "full_screen";
				$responsive_height_class = "";
				$slide_height = "";
				$data_height = "";
			}else{
				$full_screen_class = "";
				if($responsive_height == "yes"){
					$responsive_height_class = "responsive_height";
				}else{
					$responsive_height_class = "";
				}
				$slide_height = "height: ".$height."px;";
				$data_height = "data-height='".$height."'";
			}

			$anchor_data = '';
			if($anchor != "") {
				$anchor_data .= 'data-q_id = "#'.$anchor.'"';
			}

			$slider_transparency_class = "header_not_transparent";
			if(isset($qode_options['header_background_transparency_initial']) && $qode_options['header_background_transparency_initial'] != "1" && $qode_options['header_background_transparency_initial'] != ""){
				$slider_transparency_class = "";
			}

			if($background_color != ""){
				$background_color = 'background-color:'.$background_color.';';
			}

			$auto = "true";
			if($auto_start != ""){
				$auto = $auto_start;
			}

			if($auto == "true"){
				$auto_start_class = "q_auto_start";
			} else {
				$auto_start_class = "";
			}

			if($slide_animation != ""){
				$slide_animation = 'data-slide_animation="'.$slide_animation.'"';
			} else {
				$slide_animation = 'data-slide_animation=""';
			}

			if($animation_type == 'fade'){
				$animation_type_class = 'fade';
			}else{
				$animation_type_class = '';
			}

			/**************** Count positioning of navigation arrows and preloader depending on header transparency and layout - START ****************/

			global $wp_query;

			$page_id = $wp_query->get_queried_object_id();
			$header_height_padding = 0;
			if((get_post_meta($page_id, "qode_header_color_transparency_per_page", true) == "" || get_post_meta($page_id, "qode_header_color_transparency_per_page", true) == "1") && ($qode_options['header_background_transparency_initial'] == "" || $qode_options['header_background_transparency_initial'] == "1") && $qode_options['header_bottom_appearance'] != "regular" && ($qode_options['enable_content_top_margin'] != "yes" && get_post_meta($page_id, "qode_enable_content_top_margin", true) != "yes")){

                $header_bottom_appearance = "";
                if (isset($qode_options['header_bottom_appearance'])) {
                    $header_bottom_appearance = $qode_options['header_bottom_appearance'];
                }

                $header_top = 0;
                if(isset($qode_options['header_top_area']) && $qode_options['header_top_area'] == "yes"){
                    $header_top = 33;
                }

                if (!empty($qode_options['header_height']) && $header_bottom_appearance != "fixed_hiding") {
                    $header_height = $qode_options['header_height'];
                } elseif(!empty($qode_options['header_height']) && $header_bottom_appearance == "fixed_hiding"){
                    $header_height = $qode_options['header_height'] + 50; // 50 is logo height for fixed advanced header type
                } elseif((isset($qode_options['center_logo_image']) && $qode_options['center_logo_image'] == "yes" && $header_bottom_appearance != "stick") || $header_bottom_appearance == "fixed_hiding") {
                    $header_height = 190;
                } else {
                    $header_height = 100;
                }
                if (!empty($qode_options['header_bottom_border_color'])) {
                    $header_height = $header_height + 1;
                }
                if($header_bottom_appearance == "stick menu_bottom") {
                    $menu_bottom = 60; // border 1px
                    if ($qode_options['center_logo_image'] == "yes") {
                        if(is_active_sidebar('header_fixed_right')){
                            $menu_bottom = $menu_bottom + 26; // 26 is for right widget in header bottom (line height of text)
                        }
                    }
                } else {
                    $menu_bottom = 0;
                }

                $header_height_padding = $header_height + $menu_bottom + $header_top;

                if (isset($qode_options['center_logo_image']) && $qode_options['center_logo_image'] == "yes") {
                    if(isset($qode_options['logo_image'])){
                        $logo_width = 0;
                        $logo_height = 0;
                        if (!empty($qode_options['logo_image'])) {
                            $logo_url_obj = parse_url($qode_options['logo_image']);
                            list($logo_width, $logo_height, $logo_type, $logo_attr) = getimagesize($_SERVER['DOCUMENT_ROOT'].$logo_url_obj['path']);
                        }
                    }
                    if($header_bottom_appearance == "stick menu_bottom") {
                        $header_height_padding = $logo_height + $menu_bottom + $header_top + 20; // 20 is top and bottom margin of centered logo
                    } else {
                        $header_height_padding = $header_height + $logo_height + $header_top + 20; // 20 is top and bottom margin of centered logo
                    }
                }
			}
			if($header_height_padding != 0){
				$navigation_margin_top = 'style="margin-top:'. ($header_height_padding/2 - 25).'px;"'; // 25 is half height of arrow
				$loader_margin_top = 'style="margin-top:'. ($header_height_padding/2).'px;"';
			}
			else {
				$navigation_margin_top = '';
				$loader_margin_top = '';
			}

			/**************** Count positioning of navigation arrows and preloader depending on header transparency and layout - END ****************/


			$html .= '<div id="qode-'.$slider.'" '.$anchor_data.' class="carousel slide '.$animation_type_class.' '.$full_screen_class.' '.$responsive_height_class.' '.$auto_start_class.' '.$header_effect_class.' '.$slider_thumbs_class.' '.$slider_transparency_class.'" '.$slide_animation.' '.$data_height.' '.$data_parallax_effect.' style="'.$slide_height.' '.$background_color.'"><div class="qode_slider_preloader"><div class="ajax_loader" '.$loader_margin_top.'><div class="ajax_loader_1">'.qode_loading_spinners(true).'</div></div></div>';
			$html .= '<div class="carousel-inner '.$slider_css_position_class.'" data-start="transform: translateY(0px);" data-1440="transform: translateY(-500px);">';
			query_posts( $args );


			$found_slides =  $wp_query->post_count;

			if ( have_posts() ) : $postCount = 0; while ( have_posts() ) : the_post();
				$active_class = '';
				if($postCount == 0){
					$active_class = 'active';
				}else{
					$active_class = 'inactive';
				}

				$slide_type = get_post_meta(get_the_ID(), "qode_slide-background-type", true);

				$image = get_post_meta(get_the_ID(), "qode_slide-image", true);
				$image_overlay_pattern = get_post_meta(get_the_ID(), "qode_slide-overlay-image", true);
				$thumbnail = get_post_meta(get_the_ID(), "qode_slide-thumbnail", true);
				$thumbnail_animation = get_post_meta(get_the_ID(), "qode_slide-thumbnail-animation", true);

				$thumbnail_link = "";
                if(get_post_meta(get_the_ID(), "qode_slide-thumbnail-link", true) != ""){
                    $thumbnail_link = get_post_meta(get_the_ID(), "qode_slide-thumbnail-link", true);
                }

				$video_webm = get_post_meta(get_the_ID(), "qode_slide-video-webm", true);
				$video_mp4 = get_post_meta(get_the_ID(), "qode_slide-video-mp4", true);
				$video_ogv = get_post_meta(get_the_ID(), "qode_slide-video-ogv", true);
				$video_image = get_post_meta(get_the_ID(), "qode_slide-video-image", true);
				$video_overlay = get_post_meta(get_the_ID(), "qode_slide-video-overlay", true);
				$video_overlay_image = get_post_meta(get_the_ID(), "qode_slide-video-overlay-image", true);

				$content_animation = get_post_meta(get_the_ID(), "qode_slide-content-animation", true);
				$content_parallax_animation = get_post_meta(get_the_ID(), "qode_slide-contnet-fading-out", true);

				$slide_content_style = "";
				if(get_post_meta(get_the_ID(), "qode_slide-content-background-color", true) != ""){
					$slide_content_style .= "background-color: ". get_post_meta(get_the_ID(), "qode_slide-content-background-color", true) . ";";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-content-text-padding", true) != ""){
					$slide_content_style .= "padding: ". get_post_meta(get_the_ID(), "qode_slide-content-text-padding", true) . ";";
				}

				$slide_title_style = "";
				if(get_post_meta(get_the_ID(), "qode_slide-title-color", true) != ""){
					$slide_title_style .= "color: ". get_post_meta(get_the_ID(), "qode_slide-title-color", true) . ";";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-title-font-size", true) != ""){
					$slide_title_style .= "font-size: ". get_post_meta(get_the_ID(), "qode_slide-title-font-size", true) . "px;";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-title-line-height", true) != ""){
					$slide_title_style .= "line-height: ". get_post_meta(get_the_ID(), "qode_slide-title-line-height", true) . "px;";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-title-font-family", true) !== "" && get_post_meta(get_the_ID(), "qode_slide-title-font-family", true) !== "-1"){
					$slide_title_style .= "font-family: '". str_replace('+', ' ', get_post_meta(get_the_ID(), "qode_slide-title-font-family", true)) . "';";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-title-font-style", true) != ""){
					$slide_title_style .= "font-style: ". get_post_meta(get_the_ID(), "qode_slide-title-font-style", true) . ";";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-title-font-weight", true) != ""){
					$slide_title_style .= "font-weight: ". get_post_meta(get_the_ID(), "qode_slide-title-font-weight", true) . ";";
				}
				if(get_post_meta(get_the_ID(), 'qode_slide-title-letter-spacing', true) !== '') {
					$slide_title_style .= 'letter-spacing: '.get_post_meta(get_the_ID(), 'qode_slide-title-letter-spacing', true).'px;';
				}
				if(get_post_meta(get_the_ID(), 'qode_slide-title-text-transform', true) !== '') {
					$slide_title_style .= 'text-transform: '.get_post_meta(get_the_ID(), 'qode_slide-title-text-transform', true).';';
				}

                if(get_post_meta(get_the_ID(), 'qode_slide-hide-shadow', true) == 'yes'){
                    $slide_title_style .= 'text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);';
                }

				if(get_post_meta(get_the_ID(), 'qode_slide-title-bottom-margin', true) !== '') {
					$slide_title_style .= 'margin-bottom: '.get_post_meta(get_the_ID(), 'qode_slide-title-bottom-margin', true).'px;';
				}

				if(get_post_meta(get_the_ID(), 'qode_slide-title-background-color', true) !== '') {
					$original_color = get_post_meta(get_the_ID(), 'qode_slide-title-background-color', true);
					$color = qode_hex2rgb($original_color);
					if(get_post_meta(get_the_ID(), 'qode_slide-title-background-opacity', true) !== '') {
						$opacity = get_post_meta(get_the_ID(), 'qode_slide-title-background-opacity', true);
						$slide_title_style .= 'background-color: rgba('. $color[0] . ',' . $color[1] . ',' . $color[2] . ',' . $opacity . ')';
					}
					else {
						$slide_title_style .= 'background-color: rgba('. $color[0] . ',' . $color[1] . ',' . $color[2] . ')';
					}
				}

				$slide_subtitle_style = "";
				if(get_post_meta(get_the_ID(), "qode_slide-subtitle-color", true) != ""){
					$slide_subtitle_style .= "color: ". get_post_meta(get_the_ID(), "qode_slide-subtitle-color", true) . ";";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-subtitle-font-size", true) != ""){
					$slide_subtitle_style .= "font-size: ". get_post_meta(get_the_ID(), "qode_slide-subtitle-font-size", true) . "px;";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-subtitle-line-height", true) != ""){
					$slide_subtitle_style .= "line-height: ". get_post_meta(get_the_ID(), "qode_slide-subtitle-line-height", true) . "px;";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-subtitle-font-family", true) !== "" && get_post_meta(get_the_ID(), "qode_slide-subtitle-font-family", true) !== "-1"){
					$slide_subtitle_style .= "font-family: '". str_replace('+', ' ', get_post_meta(get_the_ID(), "qode_slide-subtitle-font-family", true)) . "';";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-subtitle-font-style", true) != ""){
					$slide_subtitle_style .= "font-style: ". get_post_meta(get_the_ID(), "qode_slide-subtitle-font-style", true) . ";";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-subtitle-font-weight", true) != ""){
					$slide_subtitle_style .= "font-weight: ". get_post_meta(get_the_ID(), "qode_slide-subtitle-font-weight", true) . ";";
				}
				if(get_post_meta(get_the_ID(), 'qode_slide-subtitle-letter-spacing', true) !== '') {
					$slide_subtitle_style .= 'letter-spacing: '.get_post_meta(get_the_ID(), 'qode_slide-subtitle-letter-spacing', true).'px;';
				}
				if(get_post_meta(get_the_ID(), 'qode_slide-subtitle-text-transform', true) !== '') {
					$slide_subtitle_style .= 'text-transform: '.get_post_meta(get_the_ID(), 'qode_slide-subtitle-text-transform', true).';';
				}

				if(get_post_meta(get_the_ID(), 'qode_slide-hide-shadow', true) == 'yes'){
                    $slide_subtitle_style .= 'text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);';
                }

				if(get_post_meta(get_the_ID(), 'qode_slide-subtile-bottom-margin', true) !== '') {
					$slide_subtitle_style .= 'margin-bottom: '.get_post_meta(get_the_ID(), 'qode_slide-subtile-bottom-margin', true).'px;';
				}

				$slide_text_style = "";
				$button_style = "";
				if(get_post_meta(get_the_ID(), "qode_slide-text-color", true) != ""){
					$slide_text_style .= "color: ". get_post_meta(get_the_ID(), "qode_slide-text-color", true) . ";";
					$button_style = " style='border-color:". get_post_meta(get_the_ID(), "qode_slide-text-color", true) . ";color:". get_post_meta(get_the_ID(), "qode_slide-text-color", true) . ";'";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-text-font-size", true) != ""){
					$slide_text_style .= "font-size: ". get_post_meta(get_the_ID(), "qode_slide-text-font-size", true) . "px;";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-text-line-height", true) != ""){
					$slide_text_style .= "line-height: ". get_post_meta(get_the_ID(), "qode_slide-text-line-height", true) . "px;";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-text-font-family", true) !== "" && get_post_meta(get_the_ID(), "qode_slide-text-font-family", true) !== "-1"){
					$slide_text_style .= "font-family: '". str_replace('+', ' ', get_post_meta(get_the_ID(), "qode_slide-text-font-family", true)) . "';";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-text-font-style", true) != ""){
					$slide_text_style .= "font-style: ". get_post_meta(get_the_ID(), "qode_slide-text-font-style", true) . ";";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-text-font-weight", true) != ""){
					$slide_text_style .= "font-weight: ". get_post_meta(get_the_ID(), "qode_slide-text-font-weight", true) . ";";
				}
				if(get_post_meta(get_the_ID(), 'qode_slide-text-letter-spacing', true) !== '') {
					$slide_text_style .= 'letter-spacing: '.get_post_meta(get_the_ID(), 'qode_slide-text-letter-spacing', true).'px;';
				}
				if(get_post_meta(get_the_ID(), 'qode_slide-text-text-transform', true) !== '') {
					$slide_text_style .= 'text-transform: '.get_post_meta(get_the_ID(), 'qode_slide-text-text-transform', true).';';
				}

				if(get_post_meta(get_the_ID(), 'qode_slide-hide-shadow', true) == 'yes'){
                    $slide_text_style .= 'text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);';
                }

				if(get_post_meta(get_the_ID(), 'qode_slide-text-bottom-margin', true) !== '') {
					$slide_text_style .= 'margin-bottom: '.get_post_meta(get_the_ID(), 'qode_slide-text-bottom-margin', true).'px;';
				}

				$graphic_alignment = get_post_meta(get_the_ID(), "qode_slide-graphic-alignment", true);
				$content_alignment = get_post_meta(get_the_ID(), "qode_slide-content-alignment", true);

				$separate_text_graphic = get_post_meta(get_the_ID(), "qode_slide-separate-text-graphic", true);

				if(get_post_meta(get_the_ID(), "qode_slide-content-width", true) != ""){
					$content_width = "width:".get_post_meta(get_the_ID(), "qode_slide-content-width", true)."%;";
				}else{
					$content_width = "width:80%;";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-content-left", true) != ""){
					$content_xaxis= "left:".get_post_meta(get_the_ID(), "qode_slide-content-left", true)."%;";
				}else{
					if(get_post_meta(get_the_ID(), "qode_slide-content-right", true) != ""){
						$content_xaxis = "right:".get_post_meta(get_the_ID(), "qode_slide-content-right", true)."%;";
					}else{
						$content_xaxis = "left: 10%;";
					}
				}
				if(get_post_meta(get_the_ID(), "qode_slide-content-top", true) != ""){
					$content_yaxis_start = "top:".get_post_meta(get_the_ID(), "qode_slide-content-top", true)."%;";
					$content_yaxis_end = "top:".(get_post_meta(get_the_ID(), "qode_slide-content-top", true)-10)."%;";
				}else{
					if(get_post_meta(get_the_ID(), "qode_slide-content-bottom", true) != ""){
						$content_yaxis_start = "bottom:".get_post_meta(get_the_ID(), "qode_slide-content-bottom", true)."%;";
						$content_yaxis_end = "bottom:".(get_post_meta(get_the_ID(), "qode_slide-content-bottom", true)+10)."%;";
					}else{
						$content_yaxis_start = "top: 35%;";
						$content_yaxis_end = "top: 10%;";
					}
				}

				if(get_post_meta(get_the_ID(), "qode_slide-graphic-width", true) != ""){
					$graphic_width = "width:".get_post_meta(get_the_ID(), "qode_slide-graphic-width", true)."%;";
				}else{
					$graphic_width = "width:50%;";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-graphic-left", true) != ""){
					$graphic_xaxis= "left:".get_post_meta(get_the_ID(), "qode_slide-graphic-left", true)."%;";
				}else{
					if(get_post_meta(get_the_ID(), "qode_slide-graphic-right", true) != ""){
						$graphic_xaxis = "right:".get_post_meta(get_the_ID(), "qode_slide-graphic-right", true)."%;";
					}else{
						$graphic_xaxis = "left: 25%;";
					}
				}
				if(get_post_meta(get_the_ID(), "qode_slide-graphic-top", true) != ""){
					$graphic_yaxis_start = "top:".get_post_meta(get_the_ID(), "qode_slide-graphic-top", true)."%;";
					$graphic_yaxis_end = "top:".(get_post_meta(get_the_ID(), "qode_slide-graphic-top", true)-10)."%;";
				}else{
					if(get_post_meta(get_the_ID(), "qode_slide-graphic-bottom", true) != ""){
						$graphic_yaxis_start = "bottom:".get_post_meta(get_the_ID(), "qode_slide-graphic-bottom", true)."%;";
						$graphic_yaxis_end = "bottom:".(get_post_meta(get_the_ID(), "qode_slide-graphic-bottom", true)+10)."%;";
					}else{
						$graphic_yaxis_start = "top: 30%;";
						$graphic_yaxis_end = "top: 10%;";
					}
				}

				$header_style = "";
				if(get_post_meta(get_the_ID(), "qode_slide-header-style", true) != ""){
					$header_style = get_post_meta(get_the_ID(), "qode_slide-header-style", true);
				}

                $vertical_alignment_class = '';
                if(get_post_meta(get_the_ID(), "qode_slide-vertical-alignment", true) == "yes"){
                    $vertical_alignment_class = ' vertical_align_middle';
                }

                if($header_height_padding !== 0 && get_post_meta(get_the_ID(), "qode_slide-vertical-alignment", true) == "yes"){
                    $vertical_alignment_top_padding_style = "padding-top:".$header_height_padding."px;";
                } else {
                    $vertical_alignment_top_padding_style = "";
                }

                $content_bottom_right_alignment = '';
                if(get_post_meta(get_the_ID(), "qode_slide-bottom-right-alignment", true) == "yes"){
                    $content_bottom_right_alignment = ' content_bottom_right_alignment';
                }

				$title = get_the_title();

				$html .= '<div class="item '.$header_style.$vertical_alignment_class.'" style="'.$slide_height.'">';
				if($slide_type == 'video'){

					$html .= '<div class="video"><div class="mobile-video-image" style="background-image: url('.$video_image.')"></div><div class="video-overlay';
					if($video_overlay == "yes"){
						$html .= ' active';
					}
					$html .= '"';
					if($video_overlay_image != ""){
						$html .= ' style="background-image:url('.$video_overlay_image.');"';
					}
					$html .= '>';
					if($video_overlay_image != ""){
						$html .= '<img src="'.$video_overlay_image.'" alt="" />';
					}else{
						$html .= '<img src="'.get_template_directory_uri().'/css/img/pixel-video.png" alt="" />';
					}
					$html .= '</div><div class="video-wrap">
									
									<video class="video" width="1920" height="800" poster="'.$video_image.'" controls="controls" preload="auto" loop autoplay muted>';
					if(!empty($video_webm)) { $html .= '<source type="video/webm" src="'.$video_webm.'">'; }
					if(!empty($video_mp4)) { $html .= '<source type="video/mp4" src="'.$video_mp4.'">'; }
					if(!empty($video_ogv)) { $html .= '<source type="video/ogg" src="'. $video_ogv.'">'; }
					$html .='<object width="320" height="240" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/js/flashmediaelement.swf">
													<param name="movie" value="'.get_template_directory_uri().'/js/flashmediaelement.swf" />
													<param name="flashvars" value="controls=true&file='.$video_mp4.'" />
													<img src="'.$video_image.'" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
											</object>
									</video>		
							</div></div>';
				}else{
					$html .= '<div class="image" style="background-image:url('.$image.');">';
						if($slider_thumbs == 'no'){
							$html .= '<img src="'.$image.'" alt="'.$title.'">';
						}

						if($image_overlay_pattern !== ""){
							$html .= '<div class="image_pattern" style="background: url('.$image_overlay_pattern.') repeat 0 0;"></div>';
						}
					$html .= '</div>';
				}

				$html_thumb = "";
				if($thumbnail != ""){
                    $html_thumb .= '<div class="thumb '.$thumbnail_animation.'">';
                        if($thumbnail_link != ""){
                            $html_thumb .= '<a href="'.$thumbnail_link.'" target="_self">';
                        }

                            $html_thumb .= '<img src="'.$thumbnail.'" alt="'.$title.'">';

                        if($thumbnail_link != ""){
                            $html_thumb .= '</a>';
                        }
                    $html_thumb .= '</div>';
                }
				$html_text = "";
				$title_class = "";
				if(get_post_meta(get_the_ID(), "qode_slide-title-background-color", true) != '') {
					$title_class .= ' with_bg_color';
				}
				$html_text .= '<div class="text '.$content_animation.'" style="'.$slide_content_style.'">';

					if(get_post_meta(get_the_ID(), "qode_slide-subtitle", true) != ""){
						$html_text .= '<h3 class="q_slide_subtitle" style="'.$slide_subtitle_style.'"><span>'.get_post_meta(get_the_ID(), 'qode_slide-subtitle', true).'</span></h3>';
					}

					if(get_post_meta(get_the_ID(), "qode_slide-hide-title", true) != true){
						$html_text .= '<h2 class="q_slide_title' . $title_class . '" style="'.$slide_title_style.'"><span>'.get_the_title().'</span></h2>';
					}

					if(get_post_meta(get_the_ID(), "qode_slide-text", true) != ""){
						$html_text .= '<h3 class="q_slide_text" style="'.$slide_text_style.'"><span>'.get_post_meta(get_the_ID(), "qode_slide-text", true).'</span></h3>';
					}

					//check if first button should be displayed
					$is_first_button_shown = get_post_meta(get_the_ID(), "qode_slide-button-label", true) != "" && get_post_meta(get_the_ID(), "qode_slide-button-link", true) != "";

					//check if second button should be displayed
					$is_second_button_shown = get_post_meta(get_the_ID(), "qode_slide-button-label2", true) != "" && get_post_meta(get_the_ID(), "qode_slide-button-link2", true) != "";

					//does any button should be displayed?
					$is_any_button_shown = $is_first_button_shown || $is_second_button_shown;

					if($is_any_button_shown) {
						$html_text .= '<div class="slide_buttons_holder">';
					}
						$slide_button_target = "_self";
						if(get_post_meta(get_the_ID(), "qode_slide-button-target", true) != ""){
							$slide_button_target = get_post_meta(get_the_ID(), "qode_slide-button-target", true);
						}

						$slide_button_target2 = "_self";
						if(get_post_meta(get_the_ID(), "qode_slide-button-target2", true) != ""){
							$slide_button_target2 = get_post_meta(get_the_ID(), "qode_slide-button-target2", true);
						}

						if($is_first_button_shown){
							$html_text .= '<a class="qbutton" href="'.get_post_meta(get_the_ID(), "qode_slide-button-link", true).'" target="'.$slide_button_target.'">'.get_post_meta(get_the_ID(), "qode_slide-button-label", true).'</a>';
						}
						if($is_second_button_shown){
							$html_text .= '<a class="qbutton white"' . $button_style . 'href="'.get_post_meta(get_the_ID(), "qode_slide-button-link2", true).'" target="'.$slide_button_target2.'">'.get_post_meta(get_the_ID(), "qode_slide-button-label2", true).'</a>';
						}

					if($is_any_button_shown) {
						$html_text .= '</div>'; //close div.slide_button_holder
					}

					if(get_post_meta(get_the_ID(), "qode_slide-anchor-button", true) !== '') {
	                    $slide_anchor_style = array();
	                    if(get_post_meta(get_the_ID(), "qode_slide-text-color", true) !== '') {
	                        $slide_anchor_style[] = "color: " . get_post_meta(get_the_ID(), "qode_slide-text-color", true);
	                    }

	                    if($slide_anchor_style !== '') {
	                        $slide_anchor_style = 'style="'. implode(';', $slide_anchor_style).'"';
	                    }

	                    $html_text .= '<div class="slide_anchor_holder"><a '.$slide_anchor_style.' class="slide_anchor_button anchor" href="'.get_post_meta(get_the_ID(), "qode_slide-anchor-button", true).'"><i class="fa fa-angle-down"></i></a></div>';
	                }

				$html_text .= '</div>';
				$html .= '<div class="slider_content_outer '.$content_bottom_right_alignment.'">';

					if($separate_text_graphic != 'yes' || get_post_meta(get_the_ID(), "qode_slide-vertical-alignment", true) == "yes"){
						if($content_parallax_animation == "fading_out_off"){
							$html .= '<div class="slider_content '.$content_alignment.'" style="'.$content_width.$content_xaxis.$content_yaxis_start.$vertical_alignment_top_padding_style.'">';
						} else {
							$html .= '<div class="slider_content '.$content_alignment.'" style="'.$content_width.$content_xaxis.$content_yaxis_start.$vertical_alignment_top_padding_style.'" data-start="'.$content_width.' opacity:1; '.$content_xaxis.' '.$content_yaxis_start.'" data-300="opacity: 0; '.$content_xaxis.' '.$content_yaxis_end.'">';
						}
								$html .= $html_thumb;
								$html .= $html_text;
							$html .= '</div>';
					}else{
						if($content_parallax_animation == "fading_out_off"){
							$html .= '<div class="slider_content '.$graphic_alignment.'" style="'.$graphic_width.$graphic_xaxis.$graphic_yaxis_start.'">';
						} else {
							$html .= '<div class="slider_content '.$graphic_alignment.'" style="'.$graphic_width.$graphic_xaxis.$graphic_yaxis_start.'" data-start="'.$graphic_width.' opacity:1; '.$graphic_xaxis.' '.$graphic_yaxis_start.'" data-300="opacity: 0; '.$graphic_xaxis.' '.$graphic_yaxis_end.'">';
						}
							$html .= $html_thumb;
						$html .= '</div>';
						
						if($content_parallax_animation == "fading_out_off"){
							$html .= '<div class="slider_content '.$content_alignment.'" style="'.$content_width.$content_xaxis.$content_yaxis_start.'">';
						} else {
							$html .= '<div class="slider_content '.$content_alignment.'" style="'.$content_width.$content_xaxis.$content_yaxis_start.'" data-start="'.$content_width.' opacity:1; '.$content_xaxis.' '.$content_yaxis_start.'" data-300="opacity: 0; '.$content_xaxis.' '.$content_yaxis_end.'">';
						}
							$html .= $html_text;
						$html .= '</div>';
					}

				$html .= '</div>';
				$html .= '</div>';

				$postCount++;
			endwhile;
			else:
				$html .= __('Sorry, no slides matched your criteria.','qode');
			endif;
			wp_reset_query();

			$html .= '</div>';
			if($found_slides > 1){
				if($show_control == "yes"){
					if($content_parallax_animation == "fading_out_off"){
						$html .= '<ol class="carousel-indicators">';
					} else {
						$html .= '<ol class="carousel-indicators" data-start="opacity: 1;" data-300="opacity:0;">';
					}
				
						query_posts( $args );
						if ( have_posts() ) : $postCount = 0; while ( have_posts() ) : the_post();

							$html .= '<li data-target="#qode-'.$slider.'" data-slide-to="'.$postCount.'"';
							if($postCount == 0){
								$html .= ' class="active"';
							}
							$html .= '></li>';

							$postCount++;
						endwhile;
						else:
							$html .= __('Sorry, no posts matched your criteria.','qode');
						endif;

						wp_reset_query();
					$html .= '</ol>';
				}

				if($show_navigation == "yes"){
					if($content_parallax_animation == "fading_out_off"){
						$html .= '<a class="left carousel-control" href="#qode-'.$slider.'" data-slide="prev"><span class="prev_nav" '.$navigation_margin_top.'><span class="arrow_carrot-left"></span></span></a>';
						$html .= '<a class="right carousel-control" href="#qode-'.$slider.'" data-slide="next"><span class="next_nav" '.$navigation_margin_top.'><span class="arrow_carrot-right"></span></span></a>';
					} else {
						$html .= '<a class="left carousel-control" href="#qode-'.$slider.'" data-slide="prev" data-start="opacity: 1;" data-300="opacity:0;"><span class="prev_nav" '.$navigation_margin_top.'><span class="arrow_carrot-left"></span></span></a>';
						$html .= '<a class="right carousel-control" href="#qode-'.$slider.'" data-slide="next" data-start="opacity: 1;" data-300="opacity:0;"><span class="next_nav" '.$navigation_margin_top.'><span class="arrow_carrot-right"></span></span></a>';
					}	
				}				
			}
			$html .= '</div>';
		}
		return $html;
	}
}
add_shortcode('qode_slider', 'qode_slider');

/* Qode Carousel shortcode */

if (!function_exists('qode_carousel')) {
	function qode_carousel( $atts, $content = null ) {
		$args = array(
			"carousel" 			=> "",
			"items_visible" 	=> "5",
			"orderby"  			=> "date",
			"order"    			=> "ASC",
			"show_navigation"	=> "",
			"show_in_two_rows" 	=> "",
			"space_between" 	=> "no",
			"hover_effect" 		=> "second_image",
			"on_click" 			=> "open_link",
			"carousel_type"		=> ""
		);

		extract(shortcode_atts($args, $atts));

		$html = "";
		$data = "";


		if ($carousel != "") {
			$carousel_holder_classes = array();
			$carousel_type_classes = "";

			if ($carousel_type == "carousel_owl") {
				$carousel_type_classes = 'carousel_owl';
			}

			if ($show_in_two_rows == 'yes') {
				$carousel_holder_classes[] = 'two_rows';
			}

			if ($items_visible != "") {
				$data .= 'data-number_of_items = ' . $items_visible;
			}

			if ($space_between == 'yes') {
				$carousel_holder_classes[] = 'with_space';
			}

			if ($hover_effect == 'second_image') {
				$carousel_holder_classes[] = 'hover_second_image';
			} else if ($hover_effect == 'overlay') {
				$carousel_holder_classes[] = 'hover_overlay';
			}



			if ($carousel_type == "carousel_owl") {

				$html .= "<div class='qode_carousels_holder clearfix ".implode(' ', $carousel_holder_classes)."'><div class='qode_carousels " .$carousel_type_classes. "'><div class='slides'>";

				$q = array('post_type'=> 'carousels', 'carousels_category' => $carousel, 'orderby' => $orderby, 'order' => $order, 'posts_per_page' => '-1');

				$pretty_rel_random = ' data-rel="prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']"';

				query_posts($q);
				$have_posts = false;

				if ( have_posts() ) : $post_count = 1; $have_posts = true; while ( have_posts() ) : the_post();

					if(get_post_meta(get_the_ID(), "qode_carousel-image", true) != "") {
						$image = get_post_meta(get_the_ID(), "qode_carousel-image", true);
					} else {
						$image = "";
					}

					if(get_post_meta(get_the_ID(), "qode_carousel-hover-image", true) != ""){
						$hover_image = get_post_meta(get_the_ID(), "qode_carousel-hover-image", true);
						$has_hover_image = "has_hover_image";
					} else {
						$hover_image = "";
						$has_hover_image = "";
					}

					if(get_post_meta(get_the_ID(), "qode_carousel-item-link", true) != ""){
						$link = get_post_meta(get_the_ID(), "qode_carousel-item-link", true);
					} else {
						$link = "";
					}

					if(get_post_meta(get_the_ID(), "qode_carousel-item-target", true) != ""){
						$target = get_post_meta(get_the_ID(), "qode_carousel-item-target", true);
					} else {
						$target = "_self";
					}

					$title = get_the_title();

					//is current item not on even position in array and two rows option is chosen?
					if($post_count % 2 !== 0 && $show_in_two_rows == 'yes') {
						$html .= "<div class='item'>";
					} elseif($show_in_two_rows == '') {
						$html .= "<div class='item'>";
					}

					$html .= '<div class="carousel_item_holder">';

					if($link != "" && $on_click == 'open_link'){
						$html .= "<a href='".$link."' target='".$target."'>";
					}
					else if ($on_click == 'prettyphoto') {
						$html .= "<a class='prettyphoto' href='" . $image . "'" . $pretty_rel_random . ">";
					}

					if($image != ""){
						$html .= "<span class='first_image_holder ".$has_hover_image."'><img src='".$image."' alt='".$title."'></span>";
					}

					if($hover_image != "" && $hover_effect == 'second_image'){
						$html .= "<span class='second_image_holder ".$has_hover_image."'><img src='".$hover_image."' alt='".$title."'></span>";
					}

					else if($hover_effect == 'overlay') {
						$html .= "<span class='carousel_image_overlay'></span>";
					}

					if($link != "" || $on_click == 'prettyphoto'){
						$html .= "</a>";
					}

					$html .= '</div>';

					//is current item on even position in array and two rows option is chosen?
					if($post_count % 2 == 0 && $show_in_two_rows == 'yes') {
						$html .= "</div>";
					} elseif($show_in_two_rows == '') {
						$html .= "</div>";
					}

					$post_count++;

				endwhile;

				else:
					$html .= __('Sorry, no posts matched your criteria.','qode');
				endif;

				wp_reset_query();

				$html .= "</div>";

				$html .= "</div></div>";

			} else {

				$html .= "<div class='qode_carousels_holder clearfix " . implode(' ', $carousel_holder_classes) . "'><div class='qode_carousels " . $carousel_type_classes . "' " . $data . "><ul class='slides'>";

				$q = array('post_type' => 'carousels', 'carousels_category' => $carousel, 'orderby' => $orderby, 'order' => $order, 'posts_per_page' => '-1');

				$pretty_rel_random = ' data-rel="prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']"';

				query_posts($q);
				$have_posts = false;

				if (have_posts()) : $post_count = 1;
					$have_posts = true;
					while (have_posts()) : the_post();

						if (get_post_meta(get_the_ID(), "qode_carousel-image", true) != "") {
							$image = get_post_meta(get_the_ID(), "qode_carousel-image", true);
						} else {
							$image = "";
						}

						if (get_post_meta(get_the_ID(), "qode_carousel-hover-image", true) != "") {
							$hover_image = get_post_meta(get_the_ID(), "qode_carousel-hover-image", true);
							$has_hover_image = "has_hover_image";
						} else {
							$hover_image = "";
							$has_hover_image = "";
						}

						if (get_post_meta(get_the_ID(), "qode_carousel-item-link", true) != "") {
							$link = get_post_meta(get_the_ID(), "qode_carousel-item-link", true);
						} else {
							$link = "";
						}

						if (get_post_meta(get_the_ID(), "qode_carousel-item-target", true) != "") {
							$target = get_post_meta(get_the_ID(), "qode_carousel-item-target", true);
						} else {
							$target = "_self";
						}

						$title = get_the_title();

						//is current item not on even position in array and two rows option is chosen?
						if ($post_count % 2 !== 0 && $show_in_two_rows == 'yes') {
							$html .= "<li class='item'>";
						} elseif ($show_in_two_rows == '') {
							$html .= "<li class='item'>";
						}

						$html .= '<div class="carousel_item_holder">';

						if ($link != "" && $on_click == 'open_link') {
							$html .= "<a href='" . $link . "' target='" . $target . "'>";
						} else if ($on_click == 'prettyphoto') {
							$html .= "<a class='prettyphoto' href='" . $image . "'" . $pretty_rel_random . ">";
						}

						if ($image != "") {
							$html .= "<span class='first_image_holder " . $has_hover_image . "'><img src='" . $image . "' alt='" . $title . "'></span>";
						}

						if ($hover_image != "" && $hover_effect == 'second_image') {
							$html .= "<span class='second_image_holder " . $has_hover_image . "'><img src='" . $hover_image . "' alt='" . $title . "'></span>";
						} else if ($hover_effect == 'overlay') {
							$html .= "<span class='carousel_image_overlay'></span>";
						}

						if ($link != "" || $on_click == 'prettyphoto') {
							$html .= "</a>";
						}

						$html .= '</div>';

						//is current item on even position in array and two rows option is chosen?
						if ($post_count % 2 == 0 && $show_in_two_rows == 'yes') {
							$html .= "</li>";
						} elseif ($show_in_two_rows == '') {
							$html .= "</li>";
						}

						$post_count++;

					endwhile;

				else:
					$html .= __('Sorry, no posts matched your criteria.', 'qode');
				endif;

				wp_reset_query();

				$html .= "</ul>";

				if ($show_navigation != 'no' && $have_posts) {
					//generate navigation html
					$html .= '<ul class="caroufredsel-direction-nav">';

					$html .= '<li class="caroufredsel-prev-holder">';

					$html .= '<a id="caroufredsel-prev" class="qode_carousel_prev caroufredsel-navigation-item caroufredsel-prev" href="javascript: void(0)">';

					$html .= '<span class="arrow_carrot-left"></span>';

					$html .= '</a>';

					$html .= '</li>'; //close li.caroufredsel-prev-holder

					$html .= '<li class="caroufredsel-next-holder">';
					$html .= '<a class="qode_carousel_next caroufredsel-next caroufredsel-navigation-item" id="caroufredsel-next" href="javascript: void(0)">';

					$html .= '<span class="arrow_carrot-right"></span>';

					$html .= '</a>';

					$html .= '</li>'; //close li.caroufredsel-next-holder

					$html .= '</ul>'; //close ul.caroufredsel-direction-nav
				}
				$html .= "</div></div>";

			}
		}

		return $html;
	}
}
add_shortcode('qode_carousel', 'qode_carousel');

/* Select Image Slider with no space shortcode */

if (!function_exists('image_slider_no_space')) {
    function image_slider_no_space($atts, $content = null) {
        global $qode_options;
        $args = array(
            "images"    				=> "",
            "height"    				=> "",
			"on_click"  				=> "",
			"custom_links" 				=> "",
			"custom_links_target" 		=> "",
			"navigation_style"			=> "",
			"highlight_active_image" 	=> "",
			"link_all_items"			=> ""
        );

        extract(shortcode_atts($args, $atts));

        //init variables
        $html = "";
		$image_gallery_holder_styles 	= '';
		$image_gallery_holder_classes 	= '';
		$image_gallery_item_styles   	= '';
		$custom_links_array			 	= array();
		$using_custom_links			 	= false;

		//is height for the slider set?
		if($height !== '') {
			$image_gallery_holder_styles .= 'height: '.$height.'px;';
			$image_gallery_item_styles .= 'height: '.$height.'px;';
		}

		//are we using custom links and is custom links field filled?
		if($on_click == 'use_custom_links' && $custom_links !== '') {
			//create custom links array
			$custom_links_array = explode(',', strip_tags($custom_links));
		}

		if($navigation_style !== '') {
			$image_gallery_holder_classes = $navigation_style;
		}

		if($highlight_active_image == 'yes') {
			$image_gallery_holder_classes .= ' highlight_active';
		}

		if($link_all_items == 'yes') {
			$image_gallery_holder_classes .= ' link_all';
		}

        $html .= "<div class='qode_image_gallery_no_space ".$image_gallery_holder_classes."'><div class='qode_image_gallery_holder' style='".$image_gallery_holder_styles."'><ul>";



        if($images != '' ) {
            $images_gallery_array = explode(',',$images);
        }

		//are we using prettyphoto?
		if($on_click == 'prettyphoto') {
			//generate random rel attribute
			$pretty_photo_rel = 'prettyPhoto[rel-'.rand().']';
		}


		//are we using custom links and is target for those elements chosen?
		if($on_click == 'use_custom_links' && in_array($custom_links_target, array('_self', '_blank'))) {
			//generate target attribute
			$custom_links_target = 'target="'.$custom_links_target.'"';
		}

        if(isset($images_gallery_array) && count($images_gallery_array) != 0) {
			$i = 0;
            foreach($images_gallery_array as $gimg_id) {
				$current_item_custom_link = '';

                $gimage_src = wp_get_attachment_image_src($gimg_id,'full',true);
                $gimage_alt = get_post_meta($gimg_id, '_wp_attachment_image_alt', true);

				$image_src    = $gimage_src[0];
				$image_width  = $gimage_src[1];
				$image_height = $gimage_src[2];

				//is height set for the slider?
				if($height !== '') {
					//get image proportion that will be used to calculate image width
					$proportion = $height / $image_height;

					//get proper image widht based on slider height and proportion
					$image_width = ceil($image_width * $proportion);
				}

                $html .= '<li><div style="'.$image_gallery_item_styles.' width:'.$image_width.'px;">';

				//is on click event chosen?
				if($on_click !== '') {
					switch($on_click) {
						case 'prettyphoto':
							$html .= '<a class="prettyphoto" rel="'.$pretty_photo_rel.'" href="'.$image_src.'">';
							break;
						case 'use_custom_links':
							//does current image has custom link set?
							if(isset($custom_links_array[$i])) {
								//get custom link for current image
								$current_item_custom_link = $custom_links_array[$i];

								if($current_item_custom_link !== '') {
									$html .= '<a '.$custom_links_target.' href="'.$current_item_custom_link.'">';
								}
							}
							break;
						case 'new_tab':
							$html .= '<a href="'.$image_src.'" target="_blank">';
							break;
						default:
							break;
					}
				}

				$html .= '<img src="'.$image_src.'" alt="'.$gimage_alt.'" />';

				//are we using prettyphoto or new tab click event or is custom link for current image set?
				if(in_array($on_click, array('prettyphoto', 'new_tab')) || ($on_click == 'use_custom_links' && $current_item_custom_link !== '')) {
					//if so close opened link
					$html .= '</a>';
				}

				$html .= '</div></li>';

				$i++;
            }
        }

        $html .= "</ul>";
        $html .= '</div>';
        $html .= '<div class="controls">';
        $html .= '<a class="prev-slide" href="#"><span class="arrow_carrot-left"></span></a>';
        $html .= '<a class="next-slide" href="#"><span class="arrow_carrot-right"></span></a>';
        $html .= '</div></div>';

        return $html;
    }

	add_shortcode('image_slider_no_space', 'image_slider_no_space');
}

/* Product list shortcode */
if (!function_exists('qode_product_list')) {
	function qode_product_list($atts, $content = null)
	{
		global $qode_options;
		$args = array(
			'type' => 'standard',
			'columns' => '4',
			'items_number' => '-1',
			'order_by' => 'date',
			'sort_order' => 'desc',
			'taxonomy_to_display' => 'category',
			'taxonomy_values' => '',
			'display_categories' => 'yes'
		);

		extract(shortcode_atts($args, $atts));
		$params = array();
		$params['display_categories'] = $display_categories;
		if($type == 'standard') {
			do_action('qode_pl_standard_initial_setup', $params);
		}
		else if($type == 'simple') {
			do_action('qode_pl_simple_initial_setup');
		}

		$html = '';

		/* Get query args */
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby' => $order_by,
			'order' => $sort_order,
			'posts_per_page' => $items_number,
			'meta_query' => WC()->query->get_meta_query()
		);

		if ($taxonomy_to_display != '' && $taxonomy_to_display == 'category') {
			$args['product_cat'] = $taxonomy_values;
		}

		if ($taxonomy_values != '' && $taxonomy_values == 'tag') {
			$args['product_tag'] = $taxonomy_values;
		}

		if ($taxonomy_to_display != '' && $taxonomy_to_display == 'id') {
			$idArray = $taxonomy_values;
			$ids = explode(',', $idArray);
			$args['post__in'] = $ids;
		}

		$products = new \WP_Query($args);
		$html .= '<div class="qodef-product-list-holder">';
		$html .= '<div class="woocommerce columns-' . $columns . '">';
		$html .= '<ul class="products ' . $type . '">';
		ob_start();
		if ($products->have_posts()) :
			while ($products->have_posts()) : $products->the_post();
				$html .= get_template_part('templates/product-list/'.$type.'-loop');
			endwhile;
		endif;
		$output = ob_get_contents();
		ob_end_clean();
		$html .= $output;

		woocommerce_reset_loop();
		wp_reset_postdata();

		$html .= '</ul>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;

	}
	add_shortcode('qode_product_list', 'qode_product_list');
}

/* Product list shortcode */
if (!function_exists('qode_shop_category_showcase')) {
	function qode_shop_category_showcase($atts, $content = null) {

		$args = array(
			'cat_slug' => '',
			'product_id' => '',
			'product_id_2' => '',
			'products_position' => ''
		);

		extract(shortcode_atts($args, $atts));

		$html = '';
		$cat1_html = $cat1_img = $cat1_href = '';
		$products_html = '';
		$classes = '';
		$cat1 = false;

		if($products_position != ''  && $products_position == 'left') {
			$classes .= 'cat_and_products_33_66';
		}
		else if($products_position != ''  && $products_position == 'right') {
			$classes .= 'cat_and_products_66_33';
		}

		if($cat_slug != '') {
			$cat1 = get_term_by('slug',$cat_slug,'product_cat');
		}

		if($cat1) {
			$category_thumbnail = get_woocommerce_term_meta($cat1->term_id, 'thumbnail_id', true);
			$cat1_img =  wp_get_attachment_image_src($category_thumbnail, 'full');
			$cat1_href = get_term_link( $cat1->term_id, 'product_cat' );

			$cat1_html .= '<div class="qode_category_showcase_category_holder">';
			$cat1_html .= '<div class="qode_category_showcase_category_image">';
			$cat1_html .= '</div>';
			$cat1_html .= '<a class="qode_category_showcase_category_info" target="_self" href="' . $cat1_href . '" style="background-image: url(' . $cat1_img[0] . ')">';
			$cat1_html .= '<div class="qode_category_showcase_category_name">';
			$cat1_html .= '<span>' . $cat1->name . '</span>';
			$cat1_html .= '</div>';
			$cat1_html .= '</a>';
			$cat1_html .= '</div>';
		}

		if($product_id != '') {
			$product = wc_get_product($product_id);
			if($product) {
				$image_id = $product->get_image_id();
				$products_html .= '<div class="qode_category_showcase_product_holder">'; 			// open product holder
				$products_html .= '<div class="qode_category_showcase_product_holder_inner">'; 		// open product holder inner
				$products_html .= '<div class="qode_category_showcase_product_image_holder">'; 		// open image holder
				$products_html .= '<div class="qode_category_showcase_product_shader"></div>'; 		// image shader
				$products_html .=  wp_get_attachment_image($image_id, 'full');
				$products_html .= '</div>';															// close image holder
				$products_html .= '<a class="qode_category_showcase_product_info_holder" ';			// open info holder
				$products_html .= 'target="_self" href="' . $product->get_permalink() . '">';
				$products_html .= '<div class="qode_category_showcase_product_info_holder_inner">';	// open info holder inner
				$products_html .= '<div class="qode_category_showcase_product_info_wrapper">';		// open info wrapper
				$products_html .= '<div class="qode_category_showcase_product_title">';				// open product title
				$products_html .= '<span>' . $product->get_title() . '</span>';
				$products_html .= '</div>';															// close product title
				$products_html .= '<div class="qode_category_showcase_product_price">';				// open product price
				$products_html .=  $product->get_price_html();
				$products_html .= '</div>';															// close product price
				$products_html .= '</div>';															// close info holder inner
				$products_html .= '</div>';															// close info wrapper
				$products_html .= '</a>'; 															// close info holder
				$products_html .= '</div>'; 														// close product holder inner
				$products_html .= '</div>';
			}
			if($product_id_2 == '') {
				$classes .= ' showcase_single_product';
			}
		}

		if($product_id_2 != '') {
			$product = wc_get_product($product_id_2);
			if($product) {
				$image_id = $product->get_image_id();
				$products_html .= '<div class="qode_category_showcase_product_holder">'; 			// open product holder
				$products_html .= '<div class="qode_category_showcase_product_holder_inner">'; 		// open product holder inner
				$products_html .= '<div class="qode_category_showcase_product_image_holder">'; 		// open image holder
				$products_html .= '<div class="qode_category_showcase_product_shader"></div>'; 		// image shader
				$products_html .=  wp_get_attachment_image($image_id, 'full');
				$products_html .= '</div>';															// close image holder
				$products_html .= '<a class="qode_category_showcase_product_info_holder" ';			// open info holder
				$products_html .= 'target="_self" href="' . $product->get_permalink() . '">';
				$products_html .= '<div class="qode_category_showcase_product_info_holder_inner">';	// open info holder inner
				$products_html .= '<div class="qode_category_showcase_product_info_wrapper">';		// open info wrapper
				$products_html .= '<div class="qode_category_showcase_product_title">';				// open product title
				$products_html .= '<span>' . $product->get_title() . '</span>';
				$products_html .= '</div>';															// close product title
				$products_html .= '<div class="qode_category_showcase_product_price">';				// open product price
				$products_html .=  $product->get_price_html();
				$products_html .= '</div>';															// close product price
				$products_html .= '</div>';															// close info holder inner
				$products_html .= '</div>';															// close info wrapper
				$products_html .= '</a>'; 															// close info holder
				$products_html .= '</div>'; 														// close product holder inner
				$products_html .= '</div>'; 														// close product holder
			}
			if($product_id == '') {
				$classes .= ' showcase_single_product';
			}
		}

		$html .= '<div class="qode_shop_category_showcase ' .$classes . ' ">';

		$html .= '<div class="qode_shop_category_showcase_element element_left">';

		if($products_position == 'right') {
			$html .= $cat1_html;
		}
		else {
			$html .= $products_html;
		}
		$html .= '</div>';

		$html .= '<div class="qode_shop_category_showcase_element element_right">';
		if($products_position == 'left') {
			$html .= $cat1_html;
		}
		else {
			$html .= $products_html;
		}
		$html .= '</div>';

		$html .=  '</div>'; /* close qode_shop_category_showcase */
		return $html;
	}

	add_shortcode('qode_shop_category_showcase', 'qode_shop_category_showcase');
}