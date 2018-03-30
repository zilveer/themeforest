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
add_action('init', 'qode_shortcodes_button');


if (!function_exists('num_shortcodes')){
function num_shortcodes($content){ 
    $columns = substr_count( $content, '[pricing_cell' );
	return $columns;
}
}

/* Action shortcode */

if (!function_exists('action')) {
    function action($atts, $content = null) {
        $args = array(
            "type"						=> "normal",
            "icon"						=> "",
            "icon_size"					=> "fa-2x",
            "icon_color"				=> "",
            "custom_icon"				=> "",
            "background_color"          => "",
            "border_color"              => "",
            "show_button"               => "yes",
            "button_link"               => "",
            "button_text"               => "",
            "button_target"             => "",
            "button_text_color"              => "",
            "button_top_gradient"       => "",
            "button_bottom_gradient"    => "",
            "button_border_color"       => ""
        );

        extract(shortcode_atts($args, $atts));

        $html                   = '';
        $action_classes         = '';
        $action_styles          = '';
        $text_wrapper_classes   = '';
        $button_styles          = '';
		$icon_styles			= '';
        if($show_button == 'yes') {
            $text_wrapper_classes   .= 'column1';
        }

        if($background_color != '') {
            $action_styles .= 'background-color: '.$background_color.';';
        }
		$action_classes .= $type;
        if($border_color != '') {
            $action_styles .= 'border-color: '.$border_color.';';
        }

        if($button_text_color != '') {
            $button_styles .= 'color: '.$button_text_color.';';
        }
		 if($icon_color != "") {
				$icon_styles = " style='color: ".$icon_color . ";'";
		}
        if($button_border_color != '') {
            $button_styles .= 'border-color: '.$button_border_color.';';
        }

        if($button_top_gradient != '' && $button_bottom_gradient != '') {
            $button_styles .= "background: {$button_bottom_gradient};";
            $button_styles .= "background: {$button_top_gradient} -ms-linear-gradient(bottom, {$button_bottom_gradient} 0%, {$button_top_gradient} 100%);";
            $button_styles .= "background: {$button_top_gradient} -moz-linear-gradient(bottom, {$button_bottom_gradient} 0%, {$button_top_gradient} 100%);";
            $button_styles .= "background: {$button_top_gradient} -o-linear-gradient(bottom, {$button_bottom_gradient} 0%, {$button_top_gradient} 100%);";
            $button_styles .= "background: {$button_top_gradient} -webkit-gradient(linear, left bottom, left top, color-stop(0,{$button_bottom_gradient}), color-stop(1, {$button_top_gradient}));";
            $button_styles .= "background: {$button_top_gradient} -webkit-linear-gradient(bottom, {$button_bottom_gradient} 0%, {$button_top_gradient} 100%);";
            $button_styles .= "background: {$button_top_gradient} linear-gradient(to top, {$button_bottom_gradient} 0%, {$button_top_gradient} 100%);";
        }

        $html.=  '<div class="call_to_action '.$action_classes.'" style="'.$action_styles.'">';

        if($show_button == 'yes') {
            $html .= '<div class="two_columns_75_25 clearfix">';
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
			} else {
				$html .= "<i class='fa ".$icon." pull-left . ". $icon_size . "'".$icon_styles."></i>";
			}
			
			
			
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		}
	   
		$html .= '<div class="call_to_action_text">'.$content.'</div>';
        $html .= '</div>'; //close text_wrapper

        if($show_button == 'yes') {
            $button_link = ($button_link != '') ? $button_link : 'javascript: void(0)';

            $html .= '<div class="button_wrapper column2">';
            $html .= '<a href="'.$button_link.'" class="qbutton" target="'.$button_target.'" style="'.$button_styles.'">'.$button_text.'</a>';
            $html .= '</div>';//close button_wrapper
        }

        if($show_button == 'yes') {
            $html .= '</div>'; //close two_columns_75_25 if opened
        }

        $html .= '</div>';//close call_to_action



        return $html;
    }
}
add_shortcode('action', 'action');

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
        "width"             => "",
        "line_height"       => "", 
        "background_color"  => "",
        "border_color"      => "",
        "quote_icon_color"  => "",
        "show_quote_icon"   => ""
    );
    
    extract(shortcode_atts($args, $atts));

    //init variables
    $html               = "";
    $blockquote_styles  = "";
    $blockquote_classes = "";
    $heading_styles     = "";
    $quote_icon_styles  = "";

    if($show_quote_icon == 'yes') {
        $blockquote_classes .= ' with_quote_icon';
    }

    if($width != "") {
        $blockquote_styles .= "width: ".$width."%;";
    }

    if($border_color != "") {
        $blockquote_styles .= "border-left-color: ".$border_color.";";
    }
    
    if($background_color != "") {
        $blockquote_styles .= "background-color: ".$background_color.";";
    }
    
    if($text_color != "") {
        $heading_styles .= "color: ".$text_color.";";
    }

    if($line_height != "") {
        $heading_styles .= " line-height: ".$line_height."px;";
    }

    if($quote_icon_color != "") {
        $quote_icon_styles .= "color: ".$quote_icon_color.";";
    }

    $html .= "<blockquote class='".$blockquote_classes."' style='".$blockquote_styles."'>"; //open blockquote
    if($show_quote_icon == 'yes') {
        $html .= "<i class='fa fa-quote-right pull-left' style='".$quote_icon_styles."'></i>";
    }

    $html .= "<h5 class='blockquote-text' style='".$heading_styles."'>".$text."</h5>";
    $html .= "</blockquote>"; //close blockquote
    return $html;
}
}
add_shortcode('blockquote', 'blockquote');

/* Button shortcode */

if (!function_exists('button')) {
function button($atts, $content = null) {
	global $qode_options_theme13;
        
        $args = array(
            "size"                      => "",
            "text"                      => "",
            "icon"                      => "",
            "icon_size"                 => "",
            "icon_color"                => "",
            "link"                      => "",
            "target"                    => "_self",
            "color"                     => "",
            "top_gradient_color"        => "",
            "bottom_gradient_color"     => "",
            "border_color"              => "",
            "font_style"                => "",
            "font_weight"               => "",
            "text_align"                => "",
            "margin"					=> ""
        );
        
	extract(shortcode_atts($args, $atts));
        
	if($target == ""){
		$target = "_self";
	}
        
    //init variables
    $html  = "";
    $button_classes = "qbutton ";
    $button_styles  = "";
    $add_icon       = "";
    
    if($size != "") {
        $button_classes .= " {$size}";
    }

    if($text_align != "") {
        $button_classes .= " {$text_align}";
    }
    
    if($color != ""){
        $button_styles .= 'color: '.$color.'; ';
    }
    
    if($border_color != ""){
        $button_styles .= 'border: 1px solid '.$border_color.'; ';
    }
    
    if($font_style != ""){
        $button_styles .= 'font-style: '.$font_style.'; ';
    }

    if($font_weight != ""){
        $button_styles .= 'font-weight: '.$font_weight.'; ';
    }

    if($icon != ""){
        $icon_style = "";
        if($icon_color != ""){
            $icon_style .= 'color: '.$icon_color.';';
        }
        $add_icon .= '<i class="fa '.$icon.' '.$icon_size.'" style="'.$icon_style.'"></i>';
    }
	
	if($margin != ""){
        $button_styles .= 'margin: '.$margin.'; ';
    }
	
    if($top_gradient_color != "" && $bottom_gradient_color != "") {
        $button_styles .= "background: {$bottom_gradient_color};";
        $button_styles .= "background: {$top_gradient_color} -ms-linear-gradient(bottom, {$bottom_gradient_color} 0%, {$top_gradient_color} 100%);";
        $button_styles .= "background: {$top_gradient_color} -moz-linear-gradient(bottom, {$bottom_gradient_color} 0%, {$top_gradient_color} 100%);";
        $button_styles .= "background: {$top_gradient_color} -o-linear-gradient(bottom, {$bottom_gradient_color} 0%, {$top_gradient_color} 100%);";
        $button_styles .= "background: {$top_gradient_color} -webkit-gradient(linear, left bottom, left top, color-stop(0,{$bottom_gradient_color}), color-stop(1, {$top_gradient_color}));";
        $button_styles .= "background: {$top_gradient_color} -webkit-linear-gradient(bottom, {$bottom_gradient_color} 0%, {$top_gradient_color} 100%);";
        $button_styles .= "background: {$top_gradient_color} linear-gradient(to top, {$bottom_gradient_color} 0%, {$top_gradient_color} 100%);";
    }
            
    $html .=  '<a href="'.$link.'" target="'.$target.'" class="'.$button_classes.'" style="'.$button_styles.'">'.$text.$add_icon.'</a>';

    return $html;
}
}
add_shortcode('button', 'button');

/* Counter shortcode */

if (!function_exists('counter')) {
function counter($atts, $content = null) {
    $args = array(
        "type"              => "",
        "box"               => "",
        "box_border_color"  => "",
        "position"          => "",
        "digit"             => "",
        "font_size"         => "",
        "font_color"        => "",
        "text"              => "",
        "text_size"         => "",
        "text_color"        => "",
        "separator"         => "",
        "separator_color"   => ""
    );

	extract(shortcode_atts($args, $atts));

    //init variables
    $html                   = "";
    $counter_holder_classes = "";
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

    if($type != "") {
        $counter_classes .= " ".$type;
    }

    if($font_color != "") {
        $counter_styles .= "color: ".$font_color.";";
    }

    if($font_size != "") {
        $counter_styles .= "font-size: ".$font_size."px;";
    }

    if($text_size != "") {
        $text_styles .= "font-size: ".$text_size."px;";
    }

    if($text_color != "") {
        $text_styles .= "color: ".$text_color.";";
    }

    if($separator_color != "") {
        $separator_styles .= "background-color: ".$separator_color.";";
    }

    $html .= '<div class="q_counter_holder '.$counter_holder_classes.'">';
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

/* Custom font shortcode */

if (!function_exists('custom_font')) {
function custom_font($atts, $content = null) {
	extract(shortcode_atts(array("font_family"=>"","font_size"=>"","line_height"=>"","font_style"=>"","font_weight"=>"","color"=>"","text_decoration"=>"","text_shadow"=>"","background_color"=>"","padding"=>"","margin"=>"","text_align"=>"left"), $atts));
    $html = '';  
	$html .= '<span class="custom_font_holder" style="';
	if($font_family != ""){
		$html .= 'font-family: '.$font_family.';';
	}
	if($font_size != ""){
		$html .= ' font-size: '.$font_size.'px;';
	}
	if($line_height != ""){
		$html .= ' line-height: '.$line_height.'px;';
	}
	if($font_style != ""){
		$html .= ' font-style: '.$font_style.';';
	}
	if($font_weight != ""){
		$html .= ' font-weight: '.$font_weight.';';
	}
	if($color != ""){
		$html .= ' color: '.$color.';';
	}
	if($text_decoration != ""){
		$html .= ' text-decoration: '.$text_decoration.';';
	}
	if($text_shadow == "yes"){
		$html .= ' text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);';
	}
	if($background_color != ""){
		$html .= ' background-color: '.$background_color.';';
	}
	if($padding != ""){
		$html .= ' padding: '.$padding.';';
	}
	if($margin != ""){
		$html .= ' margin: '.$margin.';';
	}
	$html .= ' text-align: ' . $text_align . ';';
	$html .= '">'.$content.'</span>';
    return $html;
}
}
add_shortcode('custom_font', 'custom_font');

/* Cover Boxes shortcode */

if (!function_exists('cover_boxes')) {
function cover_boxes($atts, $content = null) {
    extract(shortcode_atts(array("title1" => "", "title_color1"=>"", "text1"=>"", "text_color1"=>"", "image1" => "", "link1" => "", "link_label1" => "", "link_target1" => "", "title2" => "", "title_color2"=>"", "text2"=>"", "text_color2"=>"", "image2" => "", "link2" => "", "link_label2" => "", "link_target2" => "", "title3" => "", "title_color3"=>"", "text3"=>"", "text_color3"=>"", "image3" => "", "link3" => "", "link_label3" => "", "link_target3" => ""), $atts));

    $html = "";
    $html .= "<div class='cover_boxes'><ul class='clearfix'>";
    
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
    $html .= "<div class='box_content'><h3 ".$color1.">".$title1."</h3>";
    $html .= "<p ".$t_color1.">".$text1."</p>";
    $html .= "<a class='qbutton tiny' href='".$link1."' target='".$target1."'>".$link_label1."</a>";
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
    $html .= "<div class='box_content'><h3 ".$color2.">".$title2."</h3>";
    $html .= "<p ".$t_color2.">".$text2."</p>";
    $html .= "<a class='qbutton tiny' href='".$link2."' target='".$target2."'>".$link_label2."</a>";
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
    $html .= "<div class='box_content'><h3 ".$color3.">".$title3."</h3>";
    $html .= "<p ".$t_color3.">".$text3."</p>";
    $html .= "<a class='qbutton tiny' href='".$link3."' target='".$target3."'>".$link_label3."</a>";
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
            "size"                 => "", 
            "custom_size"          => "", 
            "icon"                 => "", 
            "type"                 => "", 
            "position"             => "",
            "border"               => "", 
            "border_color"         => "", 
            "border_color"         => "", 
            "icon_color"           => "", 
            "background_color"     => "",
            "margin"               => "",
            "icon_animation"       => "",
            "icon_animation_delay" => "",
            "link"                 => "",
            "target"               => ""
        );
        
        extract(shortcode_atts($default_atts, $atts));
        
        $html = "";
        if($icon != "") {
        
            //generate inline icon styles
            $style = '';
            $style_normal = '';
            $icon_stack_classes = '';
            $animation_delay_style = '';
            
            //generate icon stack styles
            $icon_stack_style = '';
            $icon_stack_base_style = '';
            $icon_stack_circle_styles = '';
            $icon_stack_square_styles = '';
            $icon_stack_normal_style  = '';

            if($custom_size != "") {
                $style .= 'font-size: '.$custom_size;
                $icon_stack_circle_styles .= 'font-size: '.$custom_size;
                $icon_stack_square_styles .= 'font-size: '.$custom_size;
                
                if(!strstr($custom_size, 'px')) {
                    $style .= 'px;';
                    $icon_stack_circle_styles .= 'px;';
                    $icon_stack_square_styles .= 'px;';
                }
            }

            if($icon_color != "") {
                $style .= 'color: '.$icon_color.';';
            }

            if($position != "") {
                $icon_stack_classes .= 'pull-'.$position;
            }   

            if($background_color != "") {
                $icon_stack_base_style .= 'color: '.$background_color.';';
                $icon_stack_style .= 'background-color: '.$background_color.';';
                $icon_stack_square_styles .= 'background-color: '.$background_color.';';
            }

            if($border == 'yes' && $border_color != "") {
                $icon_stack_style .= 'border: 1px solid '.$border_color.';';
            }

            if($icon_animation_delay != ""){
                $animation_delay_style .= 'transition-delay: '.$icon_animation_delay.'ms; -webkit-transition-delay: '.$icon_animation_delay.'ms; -moz-transition-delay: '.$icon_animation_delay.'ms; -o-transition-delay: '.$icon_animation_delay.'ms;';
            }
            
            if($margin != "") {
                $icon_stack_style .= 'margin: '.$margin.';';
                $icon_stack_circle_styles .= 'margin: '.$margin.';';
                $icon_stack_normal_style .= 'margin: '.$margin.';';
            }

            switch ($type) {
                case 'circle':
                    $html = '<span class="fa-stack q_font_awsome_icon_stack '.$size.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_circle_styles.' '.$animation_delay_style.'">';
                    if($link != ""){
                        $html .= '<a href="'.$link.'" target="'.$target.'">';
                    }
                    $html .= '<i class="fa fa-circle fa-stack-base fa-stack-2x" style="'.$icon_stack_base_style.'"></i>';
                    $html .= '<i class="fa '.$icon.' fa-stack-1x" style="'.$style.'"></i>';
                    break;
                case 'square':
                    $html = '<span class="fa-stack q_font_awsome_icon_square '.$size.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_style.$icon_stack_square_styles.' '.$animation_delay_style.'">';
                    if($link != ""){
                        $html .= '<a href="'.$link.'" target="'.$target.'">';
                    }
                    $html .= '<i class="fa '.$icon.'" style="'.$style.'"></i>';
                    break;
                default:
                    $html = '<span class="q_font_awsome_icon '.$size.' '.$icon_stack_classes.' '.$icon_animation.'" style="'.$icon_stack_normal_style.' '.$animation_delay_style.'">';
                    if($link != ""){
                        $html .= '<a href="'.$link.'" target="'.$target.'">';
                    }
                    $html .= '<i class="fa '.$icon.'" style="'.$style.'"></i>';
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
            "icon_size"             => "", 
            "custom_icon_size"      => "", 
            "icon"                  => "",
            "icon_animation"        => "",
            "icon_animation_delay"  => "",
            "image"                 => "",
            "icon_type"             => "", 
            "icon_position"         => "",
            "icon_border_color"     => "", 
            "icon_margin"           => "",
            "icon_color"            => "", 
            "icon_background_color" => "",
            "box_type"              => "",
            "box_border"            => "",
            "box_border_color"      => "",
            "box_background_color"  => "",
            "title"                 => "",
            "title_tag"             => "h4",
            "title_color"           => "",
            "text"                  => "",
            "text_color"            => "",
            "link"                  => "",
            "link_text"             => "",
            "link_color"            => "",
            "target"                => ""
        );
        
        extract(shortcode_atts($default_atts, $atts));
        
        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
                
        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
                                
        //init icon styles
        $style = '';
        $icon_stack_classes = '';
        
        
        //init icon stack styles
        $icon_margin_style       = '';
        $icon_stack_square_style = '';
        $icon_stack_base_style   = '';
        $icon_stack_style   = '';
        $img_styles              = '';
        $animation_delay_style   = '';

        //generate inline icon styles
        if($custom_icon_size != "") {
            $icon_stack_style .= 'font-size: '.$custom_icon_size.'px;';
        } 

        if($icon_color != "") {
            $style .= 'color: '.$icon_color.';';
        }

        //generate icon stack styles
        if($icon_background_color != "") {
            $icon_stack_base_style .= 'background-color: '.$icon_background_color.';';
            $icon_stack_square_style .= 'background-color: '.$icon_background_color.';';
        } 

        if($icon_border_color != "") {
            $icon_stack_style .= 'border: 1px solid '.$icon_border_color.';';
        }
        
        if($icon_margin != "") {
            $icon_margin_style .= "margin: ".$icon_margin.";";
            $img_styles       .= "margin: ".$icon_margin.";";
        }

        if($icon_animation_delay != ""){
            $animation_delay_style .= 'transition-delay: '.$icon_animation_delay.'ms; -webkit-transition-delay: '.$icon_animation_delay.'ms; -moz-transition-delay: '.$icon_animation_delay.'ms; -o-transition-delay: '.$icon_animation_delay.'ms;';
        }
                
        $box_size = '';
        //generate icon text holder styles and classes
        
        //map value of the field to the actual class value
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
        
        if($image != "") {
            $icon_type = 'image';
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
            case 'image':
                if($box_type == 'normal') {
                    $box_icon_type = 'icon_image';
                } else {
                    $box_icon_type = 'image';
                }
                break;
        }
        
        $html = "";
        $html_icon = "";
        
        if($image == "") {
            //genererate icon html
            switch ($icon_type) {
                case 'circle':
                    //if custom icon size is set and if it is larger than large icon size
                    if($custom_icon_size != "" && $custom_icon_size > 52) {
                        //add custom font class that has smaller inner icon font
                        $icon_stack_classes .= ' custom-font';
                    } 
                    
                    $html_icon .= '<span class="fa-stack '.$icon_size.' '.$icon_stack_classes.'" style="'.$icon_stack_style . $icon_stack_base_style .'">';
                   // $html_icon .= '<i class="fa fa-circle fa-stack-base fa-stack-2x" style="'.$icon_stack_base_style.'"></i>';
                    $html_icon .= '<i class="fa '.$icon.' fa-stack-1x" style="'.$style. '"></i>';
                    $html_icon .= '</span>';
                    break;
                case 'square':
                    //if custom icon size is set and if it is larget than large icon size
                    if($custom_icon_size != "" && $custom_icon_size > 52) {
                        //add custom font class that has smaller inner icon font
                        $icon_stack_classes .= ' custom-font';
                    } 
                    
                    $html_icon .= '<span class="fa-stack '.$icon_size.' '.$icon_stack_classes.'" style="'.$icon_stack_style.$icon_stack_square_style.'">';
                    $html_icon .= '<i class="fa '.$icon.'" style="'.$style.'"></i>';
                    $html_icon .= '</span>';
                    break;
                default:
                    $html_icon .= '<span style="'.$icon_stack_style.'" class="q_font_awsome_icon '.$icon_size.' '.$icon_stack_classes.'">';
                    $html_icon .= '<i class="fa '.$icon.'" style="'.$style.'"></i>';
                    $html_icon .= '</span>';
                    break;
            }    
        } else {
            if(is_numeric($image)) {
                $image_src = wp_get_attachment_url( $image ); 
            }else {
                $image_src = $image; 
            }
            $html_icon = '<img style="'.$img_styles.'" src="'.$image_src.'" alt="">';
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
            $icon_text_inner_style = '';
            
            $icon_with_text_clasess .= $box_size;
            $icon_with_text_clasess .= ' '.$box_icon_type;
            
            if($box_border == "yes") {
                $icon_with_text_clasess .= ' with_border_line';
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
            $html .= "<div class='q_icon_with_title ".$icon_with_text_clasess."'>";
            if($icon_position != "left_from_title") {
				//generate icon holder html part with icon
				$html .= '<div class="icon_holder '.$icon_animation.'" style="'.$icon_margin_style.' '.$animation_delay_style.'">';
				$html .= $html_icon;
				$html .= '</div>'; //close icon_holder
			}
            //generate text html
            $html .= '<div class="icon_text_holder">';
            $html .= '<div class="icon_text_inner" style="'.$icon_text_inner_style.'">';
			 if($icon_position == "left_from_title") {
				$html .= '<div class="icon_title_holder">'; //generate icon_title holder for icon from title
				//generate icon holder html part with icon
				$html .= '<div class="icon_holder '.$icon_animation.'" style="'.$icon_margin_style.' '.$animation_delay_style.'">';
				$html .= $html_icon;
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
                    $link_text = "Read More";
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
            
            $icon_with_text_clasess .= $box_size;
            $icon_with_text_clasess .= ' '.$box_icon_type;
            
            $html .= '<div class="q_box_holder with_icon" style="'.$box_holder_styles.'">';
            
            $html .= '<div class="box_holder_icon">';
            $html .= '<div class="box_holder_icon_inner '.$icon_with_text_clasess.' '.$icon_animation.'" style="'.$animation_delay_style.'">';
            $html .= $html_icon;
            $html .= '</div>'; //close box_holder_icon_inner
            $html .= '</div>'; //close box_holder_icon
            
            //generate text html
            $html .= '<div class="box_holder_inner '.$box_size.' center">';
            $html .= '<'.$title_tag.' class="icon_title" style="'.$title_style.'">'.$title.'</'.$title_tag.'>';
            $html .= '<span class="separator transparent" style="margin: 8px 0;"></span>';
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
            "image"             => "",
            "hover_image"       => "",
            "link"              => "",
            "target"            => "_self",
            "animation"         => "",
            "transition_delay"  => ""
        );

        extract(shortcode_atts($args, $atts));
                
        //init variables
        $html               = "";
        $image_classes      = "";
        $image_src          = $image;
        $hover_image_src    = $hover_image;
        $images_styles      = "";
                                        
        if (is_numeric($image)) {
            $image_src = wp_get_attachment_url($image);
        }
                        
        if (is_numeric($hover_image)) {
            $hover_image_src = wp_get_attachment_url($hover_image);
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
        
        $html .= "<img class='{$image_classes}' src='{$image_src}' alt='' style='{$images_styles}' />";
        $html .= "<img class='hover_image' src='{$hover_image_src}' alt='' style='{$images_styles}' />";
        
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
        "icon"                                  => "",
        "icon_type"                             => "",
        "icon_color"                            => "",
        "icon_bottom_gradient_background_color" => "",
        "icon_top_gradient_background_color"    => "",
        "icon_border_color"                     => "",
        "title"                                 => "",
        "title_color"                           => "",
        "title_size"                            => ""
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

    if($icon_bottom_gradient_background_color != "" && $icon_top_gradient_background_color) {
        $icon_style .= "background: {$icon_bottom_gradient_background_color};";
        $icon_style .= "background: -ms-linear-gradient(bottom, {$icon_bottom_gradient_background_color} 0%, {$icon_top_gradient_background_color} 100%);";
        $icon_style .= "background: -moz-linear-gradient(bottom, {$icon_bottom_gradient_background_color} 0%, {$icon_top_gradient_background_color} 100%);";
        $icon_style .= "background: -o-linear-gradient(bottom, {$icon_bottom_gradient_background_color} 0%, {$icon_top_gradient_background_color} 100%);";
        $icon_style .= "background: -webkit-gradient(linear, left bottom, left top, color-stop(0,{$icon_bottom_gradient_background_color}), color-stop(1, {$icon_top_gradient_background_color}));";
        $icon_style .= "background: -webkit-linear-gradient(bottom, {$icon_bottom_gradient_background_color} 0%, {$icon_top_gradient_background_color} 100%);";
        $icon_style .= "background: linear-gradient(to top, {$icon_bottom_gradient_background_color} 0%, {$icon_top_gradient_background_color} 100%);";
    }

    if($icon_border_color != "") {
        $icon_style .= "border-color:".$icon_border_color.";";
    }

    if($title_color != "") {
        $title_style .= "color:".$title_color.";";
    }

    if($title_size != "") {
        $title_style .= "font-size: ".$title_size."px;";
    }

    $html .= '<div class="q_icon_list">';
    $html .= '<i class="fa '.$icon.' pull-left '.$icon_classes.'" style="'.$icon_style.'"></i>';
    $html .= '<p style="'.$title_style.'">'.$title.'</p>';
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
            "title_tag" => "h3"
        );
        extract(shortcode_atts($args, $atts));

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
        
        $html = '';
        $html .= '<div class="image_with_text">';
        if (is_numeric($image)) {
            $image_src = wp_get_attachment_url($image);
        } else {
            $image_src = $image;
        }
        $html .= '<img src="' . $image_src . '" alt="' . $title . '" />';
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

if (!function_exists('image_with_text_over')) {

    function image_with_text_over($atts, $content = null) {
        $args = array(
            "layout_width"  => "",
            "image"         => "",
            "icon"          => "",
            "icon_size"     => "",
            "icon_color"    => "",
            "title"         => "",
            "title_color"   => "",
            "title_size"    => "",
            "title_tag"     => "h2"
        );

        extract(shortcode_atts($args, $atts));

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
        
        //init variables
        $html            = "";
        $title_styles    = "";
        $subtitle_styles = "";
        $line_styles     = "";
        $no_icon         = "";
        $icon_styles     = "";
        
        //generate styles
        if($title_color != "") {
            $title_styles .= "color: ".$title_color.";";
        }
        
        if($title_size != "") {
            $valid_title_size = (strstr($title_size, 'px', true)) ? $title_size : $title_size.'px';
            $title_styles .= "font-size: ".$valid_title_size.";";
        }
        
        if($icon_color != "") {
            $bcolor = qode_hex2rgb($icon_color);
            $icon_styles .= "style='color: ".$icon_color."; border-color: rgba(".$bcolor[0].",".$bcolor[1].",".$bcolor[2].",0.6);'";
        }
        
        if (is_numeric($image)) {
            $image_src = wp_get_attachment_url($image);
        } else {
            $image_src = $image;
        }

        if($icon == ""){
            $no_icon = "no_icon";
        }
        
        //generate output
        $html .= '<div class="q_image_with_text_over '.$layout_width.'">';
        $html .= '<div class="shader"></div>';
        
        $html .= '<img src="' . $image_src . '" alt="' . $title . '" />';
        $html .= '<div class="text">';
        
        //title and subtitle table html
        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<td>';
        if($icon != ""){
            $html .= '<i class="icon_holder fa '.$icon.' '.$icon_size.' fa-border" '.$icon_styles .'></i>';
        }
        $html .= '<'.$title_tag.' class="caption '.$no_icon.'" style="'.$title_styles.'">'.$title.'</'.$title_tag.'>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        
        //image description table html which appears on mouse hover
        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<td>';
        $html .= '<div class="desc">' . do_shortcode($content) . '</div>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        
        $html .= '</div>'; //close text div
        $html .= '</div>'; //close image_with_text_over

        return $html;
    }
    
    add_shortcode('image_with_text_over', 'image_with_text_over');
}

/* Latest post shortcode */

if (!function_exists('latest_post')) {
    function latest_post($atts, $content = null) {
        $blog_hide_comments = "";
        if (isset($qode_options_theme13['blog_hide_comments'])) {
            $blog_hide_comments = $qode_options_theme13['blog_hide_comments'];
        }

        $qode_like = "on";
        if (isset($qode_options_theme13['qode_like'])) {
            $qode_like = $qode_options_theme13['qode_like'];
        }

        $args = array(
            "type"       			=> "date_in_box",
            "number_of_posts"       => "",
            "number_of_colums"      => "",
            "rows"                  => "",
            "order_by"              => "",
            "order"                 => "",
            "category"              => "",
            "text_length"           => "",
            "title_tag"             => "h5",
            "display_category"    	=> "1",
            "display_time"          => "1",
            "display_comments"      => "1",
            "display_like"          => "1",
            "display_share"         => "1",
        );

        extract(shortcode_atts($args, $atts));

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

        if($type != "boxes"){
            $q = new WP_Query(
                array('orderby' => $order_by, 'order' => $order, 'posts_per_page' => $number_of_posts, 'category_name' => $category)
            );
        } else {
            $q = new WP_Query(
                array('orderby' => $order_by, 'order' => $order, 'posts_per_page' => $number_of_colums, 'category_name' => $category)
            );
        }

        $columns_number = "";
        if($number_of_colums == 2){
            $columns_number = "two_columns";
        } else if ($number_of_colums == 3) {
            $columns_number = "three_columns";
        } else if ($number_of_colums == 4) {
            $columns_number = "four_columns";
        }

        $html = "";
        $html .= "<div class='latest_post_holder $type $columns_number'>";
        $html .= "<ul>";

        while ($q->have_posts()) : $q->the_post();
            $li_classes = "";

            $cat = get_the_category();

            $html .= '<li class="clearfix">';
			if($type == "date_in_box") {
				$html .= '<div class="latest_post_date">';
				$html .= '<div class="post_publish_day">'.get_the_time('d').'</div>';
				$html .= '<div class="post_publish_month">'.get_the_time('M').'</div>';
				$html .= '</div>';
			}

            if($type == "boxes"){
                $html .= '<div class="boxes_image">';
                $html .= get_the_post_thumbnail(get_the_ID(), 'latest_post_boxes');
                $html .= '</div>';
            }

            $html .= '<div class="latest_post">';
			if($type == "image_in_box") {
				 $html .= '<div class="latest_post_image clearfix">';
				 $featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
				 $html .= '<img src="'. $featured_image_array[0] .'" alt="" />';
				 $html .= '</div>';
			}
            $html .= '<div class="latest_post_text">';
			$html .= '<div class="latest_post_inner">';
            $html .= '<div class="latest_post_text_inner">';
			if($type != "minimal") {
				$html .= '<'.$title_tag.' class="latest_post_title "><a href="' . get_permalink() . '">' . get_the_title() . '</a></'.$title_tag.'>';
			}
            if($type == "boxes") {
                $excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt();

                $html .= '<p class="boxes_excerpt">'.$excerpt.'...</p>';
            }
            $html .= '<span class="post_infos">';
			if($display_time == '1'){           
				$html .= '<span class="date_hour_holder">';
					if($type != 'date_in_box'){
						$html .= '<i class="fa fa-calendar-o"></i>';
						$html .= '<span class="date">' . get_the_time('d F, Y') . '</span>';
					} else {
						$html .= '<i class="fa fa-clock-o"></i>';
						$html .= '<span class="date">' . get_the_time('g:h') . 'h</span>';
					}
					
				$html .= '</span>';//close date_hour_holder
			}
			if($display_category == '1'){    
				$html .= '<span class="latest-vert-separator"> '.__("in", "qode").'</span>';
				foreach ($cat as $categ) {
					$html .=' <a href="' . get_category_link($categ->term_id) . '">' . $categ->cat_name . ' </a> ';
				}
			}
            //generate comments part of description
            if ($blog_hide_comments != "yes" && $display_category == "1") {
                $comments_count = get_comments_number();

                switch ($comments_count) {
                    case 0:
                        $comments_count_text = __('No comment', 'qode');
                        break;
                    case 1:
                        $comments_count_text = $comments_count . ' ' . __('Comment', 'qode');
                        break;
                    default:
                        $comments_count_text = $comments_count . ' ' . __('Comments', 'qode');
                        break;
                }
                $html .= '<a class="post_comments" href="' . get_comments_link() . '">';
                $html .= '<i class="fa fa-comment-o"></i>';
                $html .= $comments_count_text;
                $html .= '</a>';//close post_comments
            }
			
            if($qode_like == "on" && function_exists('qode_like')) {
				if($display_like == '1'){    
					$html .= '<span class="blog_like">'.qode_like_latest_posts().'</span>';
				}
			}
			if($display_share == '1'){ 
				$html .= do_shortcode('[social_share]');
			}
            $html .= '</span>'; //close post_infos span
			if($type == "minimal") {
				$html .= '<'.$title_tag.' class="latest_post_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></'.$title_tag.'>';
			}
			$html .= '</div>'; //close latest_post_text_inner span
            $html .= '</div>'; //close latest_post_inner div
			if($type == "date_in_box") {
				$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt();

				$html .= '<p>'.$excerpt.'...</p>';
			}
            $html .= '</div>'; //close latest_post_text div
            $html .= '</div>'; //close latest_post div

        endwhile;
        wp_reset_query();

        $html .= "</ul></div>";
        return $html;
    }

}
add_shortcode('latest_post', 'latest_post');

/* Line graph shortcode */

if (!function_exists('line_graph')) {
function line_graph($atts, $content = null) {
	global $qode_options_theme13;
	extract(shortcode_atts(array("type" => "rounded", "custom_color" => "", "labels" => "", "width" => "750", "height" => "350", "scale_steps" => "6", "scale_step_width" => "20"), $atts));
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
	if(!empty($qode_options_theme13['text_fontsize'])){
		$text_fontsize = $qode_options_theme13['text_fontsize'];
	}else{
		$text_fontsize = 15;
	}
	if(!empty($qode_options_theme13['text_color']) && $custom_color == ""){
		$text_color = $qode_options_theme13['text_color'];
	} else if(empty($qode_options_theme13['text_color']) && $custom_color != ""){
		$text_color = $custom_color;
	} else if(!empty($qode_options_theme13['text_color']) && $custom_color != ""){
		$text_color = $custom_color;
	}else{
		$text_color = '#626262';
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
					scaleLineColor: '#000000',
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
	global $qode_options_theme13;
        
        $args = array(
            "type"                  => "", 
            "background_color"      => "",
            "border_color"          => "", 
            "icon"                  => "", 
            "icon_size"            	=> "fa-2x", 
            "icon_color"            => "",
            "icon_background_color" => "",
            "custom_icon"           => "",
            "close_button_style"    => ""
        );
        extract(shortcode_atts($args, $atts));
        
        //init variables
	$html               = ""; 
        $icon_html          = "";
        $message_classes    = "";
        $message_styles     = "";
        $icon_styles        = "";
        
	if($type == "with_icon"){
        $message_classes .= " with_icon";
	}
        
    if($background_color != "") {
        $message_styles .= "background-color: ".$background_color.";";
    }
    
    if($border_color != "") {
        $message_styles .= "border-color: ".$border_color.";";
    }
    
    if($icon_color != "") {
        $icon_styles .= "color: ".$icon_color;
    }

    if($icon_background_color != "") {
        $icon_styles .= " background-color: ".$icon_background_color;
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
        } else {
            $icon_html .= "<i class='fa ".$icon." ". $icon_size . "' style='".$icon_styles."'></i>";
        }
		$icon_html .= '</div></div></div>';
	}
        
    $html .= $icon_html;
        
	$html .= "<a href='#' class='close'>";
        $html .= "<i class='fa fa-times ".$close_button_style."'></i>";
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
            "title_tag"             => "h4",
            "percent"               => "",
            "percentage_color"      => "",
            "active_color"          => "",
            "noactive_color"        => "",
            "line_width"            => "",
            "text"                  => "",
            "text_color"            => ""
        );

        extract(shortcode_atts($args, $atts));

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

        $html = '';
        $html .= '<div class="q_pie_chart_holder"><div class="q_percentage" data-percent="' . $percent . '" data-linewidth="' . $line_width . '" data-active="' . $active_color . '" data-noactive="' . $noactive_color . '"';
        if ($percentage_color != "") {
            $html .= ' style="color: ' . $percentage_color . ';"';
        }
        $html .= '><span class="tocounter">' . $percent . '</span> %';
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
        $args = array(
            "percent" => "",
            "active_color" => "",
            "noactive_color" => "",
            "line_width" => "",
            "icon" => "",
            "icon_size" => "",
            "icon_color" => "",
            "title" => "",
            "title_color" => "",
            "title_tag" => "h3",
            "text" => "",
            "text_color" => ""
        );

        extract(shortcode_atts($args, $atts));

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
        
        $html = '';
        $html .= '<div class="q_pie_chart_with_icon_holder"><div class="q_percentage_with_icon" data-percent="' . $percent . '" data-linewidth="' . $line_width . '" data-active="' . $active_color . '" data-noactive="' . $noactive_color . '">';
        $html .= '<i class="fa '.$icon.' '.$icon_size.'"';
        if ($icon_color != "") {
            $html .= ' style="color: ' . $icon_color . ';"';
        }
        $html .= '></i>';
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
	extract(shortcode_atts(array("width" => "120", "height" => "120", "color" => ""), $atts));
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
    extract(shortcode_atts(array("width" => "120", "height" => "120", "color" => ""), $atts));
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

/* Portfolio shortcode */

if (!function_exists('portfolio_list')) {

    function portfolio_list($atts, $content = null) {

        global $wp_query;
        global $portfolio_project_id;
        global $qode_options_theme13;
        $portfolio_qode_like = "on";
        if (isset($qode_options_theme13['portfolio_qode_like'])) {
            $portfolio_qode_like = $qode_options_theme13['portfolio_qode_like'];
        }
        
        $args = array(
            "type"                  => "standard", 
            "columns"               => "3", 
            "order_by"              => "menu_order", 
            "order"                 => "ASC", 
            "number"                => "-1", 
            "filter"                => "no", 
            "lightbox"              => "yes", 
            "category"              => "", 
            "selected_projects"     => "", 
            "show_load_more"        => "yes",
            "title_tag"             => "h5"
        );
        
        extract(shortcode_atts($args, $atts));

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
        
        $html = "";
		
		$_type_class = '';
        $_portfolio_space_class = '';
        if ($type == "hover_text") {
            $_type_class = " hover_text";
            $_portfolio_space_class = "portfolio_with_space";
        } elseif ($type == "standard"){
            $_type_class = " standard";
            $_portfolio_space_class = "portfolio_with_space";
        } elseif ($type == "standard_no_space"){
            $_type_class = " standard_no_space";
            $_portfolio_space_class = "portfolio_no_space";
        } elseif ($type == "hover_text_no_space"){
            $_type_class = " hover_text no_space";
            $_portfolio_space_class = "portfolio_no_space";
        }
	
        $html .= "<div class='projects_holder_outer v$columns $_portfolio_space_class'>";
        if ($filter == "yes") {
			$page_template = get_page_template_slug();
			
			if($page_template == "full_width.php" && $_portfolio_space_class == "portfolio_no_space") { 
				$html .= "<div class='container'><div class='container_inner clearfix'>";
			}
			$html .= "<div class='filter_outer'>";
            $html .= "<div class='filter_holder'>
						<ul>
						<li class='label'><span data-label='". __('Filter','qode') ."'>". __('Filter','qode') ."</span><i class='fa fa-angle-down'></i>
						</li>
						<li class='filter' data-filter='all'><span>" . __('All', 'qode') . "</span></li>";
            if ($category == "") {
                $args = array(
                    'parent' => 0
                );
                $portfolio_categories = get_terms('portfolio_category', $args);
            } else {
                $top_category = get_term_by('slug', $category, 'portfolio_category');
                $term_id = '';
                if (isset($top_category->term_id))
                    $term_id = $top_category->term_id;
                $args = array(
                    'parent' => $term_id
                );
                $portfolio_categories = get_terms('portfolio_category', $args);
            }
            foreach ($portfolio_categories as $portfolio_category) {
                $html .= "<li class='filter' data-filter='$portfolio_category->slug'><span>$portfolio_category->name</span>";
                $args = array(
                    'child_of' => $portfolio_category->term_id
                );
                $html .= '</li>';
            }
            $html .= "</ul></div>";
			$html .= "</div>";
			if($page_template == "full_width.php" && $_portfolio_space_class == "portfolio_no_space") { 
				$html .= "</div></div>";
			}
			
        }
        
        $html .= "<div class='projects_holder clearfix v$columns$_type_class'>\n";
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
                    $html .= "$term->slug ";
                }

                $title = get_the_title();
                $featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail'); //original size  
                $large_image = $featured_image_array[0];
                $slug_list_ = "pretty_photo_gallery";

                $html .="'>";

                $html .= "<div class='image_holder'>";
                    $html .= "<a class='portfolio_link_for_touch' href='".get_permalink()."' target='_self'>";
                        $html .= "<span class='image'>";
        					$html .= get_the_post_thumbnail(get_the_ID(), 'full');
                        $html .= "</span>";
                    $html .= "</a>";

                    if ($type == "standard" || $type == "standard_no_space") {
                        $html .= "<span class='text_holder'>";
                        $html .= "<span class='text_outer'>";
                        $html .= "<span class='text_inner'>";
						$html .= "<span class='feature_holder'>";
                            $html .= '<span class="feature_holder_icons">';
                            if ($lightbox == "yes") {
                                $html .= "<a class='lightbox' title='" . $title . "' href='" . $large_image . "' data-rel='prettyPhoto[" . $slug_list_ . "]'><i class='fa fa-search fa-2x'></i></a>";
                            }
                            $html .= "<a class='preview' href='" . get_permalink() . "'><i class='fa fa-link fa-2x'></i></a>";
                            if ($portfolio_qode_like == "on") {
                                $html .= "<span class='portfolio_like'>";
                                $portfolio_project_id = get_the_ID();

                                if (function_exists('qode_like_portfolio_list')) {
                                    $html .= qode_like_portfolio_list();
                                }
                                $html .= "</span>";
                            }
                            $html .= "</span>";
                        $html .= "</span></span></span></span>";
						

                    } else if ($type == "hover_text" || $type == "hover_text_no_space") {
					
						$html .= "<span class='text_holder'>";
                        $html .= "<span class='text_outer'>";
                        $html .= "<span class='text_inner'>";
						$html .= '<div class="hover_feature_holder_title"><div class="hover_feature_holder_title_inner">';
                            $html .= '<'.$title_tag.' class="portfolio_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></'.$title_tag.'>';
							$html .= '<span class="separator"></span>';
                            $html .= '<span class="project_category">';
                            $k = 1;
                            foreach ($terms as $term) {
                                $html .= "$term->name";
                                if (count($terms) != $k) {
                                    $html .= ', ';
                                }
                                $k++;
                            }
                            $html .= '</span></div></div>';
						$html .= "<span class='feature_holder'>";
                            $html .= '<span class="feature_holder_icons">';
                            if ($lightbox == "yes") {
                                $html .= "<a class='lightbox' title='" . $title . "' href='" . $large_image . "' data-rel='prettyPhoto[" . $slug_list_ . "]'><i class='fa fa-search fa-2x'></i></a>";
                            }
                            $html .= "<a class='preview' href='" . get_permalink() . "'><i class='fa fa-link fa-2x'></i></a>";
                            if ($portfolio_qode_like == "on") {
                                $html .= "<span class='portfolio_like'>";
                                $portfolio_project_id = get_the_ID();

                                if (function_exists('qode_like_portfolio_list')) {
                                    $html .= qode_like_portfolio_list();
                                }
                                $html .= "</span>";
                            }
                            $html .= "</span>";
                        $html .= "</span></span></span></span>";
			 
 
                    }
					$html .= "</div>";
					if ($type == "standard" || $type == "standard_no_space") {
						$html .= "<div class='portfolio_description'>";
						$html .= '<'.$title_tag.' class="portfolio_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></'.$title_tag.'>';
						$html .= '<span class="separator"></span>';
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
            }
        }
        $html .= "</div>";
        wp_reset_query();
        return $html;
    }

}
add_shortcode('portfolio_list', 'portfolio_list');

/* Portfolio Slider shortcode */

if (!function_exists('portfolio_slider')) {
function portfolio_slider( $atts, $content = null ) {

    global $portfolio_project_id;
    global $qode_options_theme13;
    $portfolio_qode_like = "on";
    if (isset($qode_options_theme13['portfolio_qode_like'])) {
        $portfolio_qode_like = $qode_options_theme13['portfolio_qode_like'];
    }

    $args = array(
            "order_by" => "menu_order",
            "order" => "ASC",
            "number" => "-1",
            "category" => "",
            "selected_projects" => "",
            "lightbox" => "",
            "title_tag" => "h5"
        );
    extract(shortcode_atts($args, $atts));

    $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

    //get correct heading value. If provided heading isn't valid get the default one
    $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

    $html = "";
    
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
        $featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
        $large_image = $featured_image_array[0];

        $html .= "<li>";

            $html .= "<div class='image_holder'>";
                $html .= "<span class='image'><span class='image_pixel_hover'></span><a href='" . get_permalink() . "'>";
                    $html .= "<img src='".$large_image."' alt='".$title."'>";
                $html .= "</a></span>";

                $html .= "<div class='hover_feature_holder'>";
                    $html .= '<span class="hover_feature_holder_icons"><span class="hover_feature_holder_icons_inner">';
                    if ($lightbox == "yes") {
                        $html .= "<a class='lightbox' title='" . $title . "' href='" . $large_image . "' data-rel='prettyPhoto[portfolio_slider]'><i class='fa fa-search fa-2x'></i></a>";
                    }
                    $html .= "<a class='preview' href='" . get_permalink() . "'><i class='fa fa-link fa-2x'></i></a>";
                    if ($portfolio_qode_like == "on") {
                        $html .= "<span class='portfolio_like'>";
                        $portfolio_project_id = get_the_ID();

                        if (function_exists('qode_like_portfolio_list')) {
                            $html .= qode_like_portfolio_list();
                        }
                        $html .= "</span>";
                    }
                    $html .= "</span></span>";

                    $html .= '<div class="hover_feature_holder_outer"><div class="hover_feature_holder_inner">';
                    $html .= '<'.$title_tag.' class="portfolio_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></'.$title_tag.'>';
					$html .= '<span class="separator"></span>';
                    $html .= '<span class="project_category">';
                    $k = 1;
                    foreach ($terms as $term) {
                        $html .= "$term->name";
                        if (count($terms) != $k) {
                            $html .= ', ';
                        }
                        $k++;
                    }
                    $html .= '</span></div></div>';
                $html .= "</div>";
            $html .= "</div>";

        $html .= "</li>";

        $postCount++;

    endwhile;

    else:
        $html .= __('Sorry, no posts matched your criteria.','qode');
    endif;

    wp_reset_query();

    $html .= "</ul></div></div>";
    
    return $html;
}
}
add_shortcode('portfolio_slider', 'portfolio_slider');

/* Pricing table column shortcode */

if (!function_exists('pricing_column')) {
	function pricing_column($atts, $content = null) {
        $args = array(
            "title"         => "",
            "subtitle"      => "",
            "price"         => "0",
            "currency"      => "$",
            "price_period"  => "monthly",
            "link"          => "",
            "target"        => "_self",
            "button_text"   => "View more",
            "active"        => "",
			"link2"      	=> "",
            "button_text2"  => "Purchase",
            "active2"       => "",
            "target2"       => "_self"
        );
	        
		extract(shortcode_atts($args, $atts));
	        
	    $html = ""; 
	        
        if($target == ""){
            $target = "_self";
        }
        if($target2 == ""){
            $target2 = "_self";
        }
        $html .= "<div class='q_price_table'>";
        
        if($active == "yes"){
            $html .= "<div class='price_table_inner active_price'>";
        } else {
            $html .= "<div class='price_table_inner'>";
        }

        $html .= "<ul>";
        $html .= "<li class='cell table_title'><h3 class='title_content'>".$title."</h3>";
        if($subtitle != "") {
			$html .= "<span>".$subtitle."</span></li>";
		}
        $html .= "<li class='prices'>";
        $html .= "<div class='price_in_table'>";
        $html .= "<sup class='value'>".$currency."</sup>";
        $html .= "<span class='price'>".$price."</span>";
        $html .= "<span class='mark'>".$price_period."</span>";
        $html .= "</div>";
        $html .= "</li>"; //close price li wrapper

        $html .= "<li class='pricing_table_content'>";
	    $html .= do_shortcode($content); //append pricing table content
        $html .= "</li>";
	    
	    $html .="<li class='price_button'>";
		$html .= "<a class='qbutton green small' href='$link' target='$target'>".$button_text."</a>";
	    $html .= "<a class='qbutton small' href='$link2' target='$target2'>".$button_text2."</a>";
	    $html .= "</li>"; //close button li wrapper
	    
	    $html .= "</ul>";
	    $html .= "</div>"; //close price_table_inner
	    $html .="</div>"; //close price_table
	    
	    return $html;
	}
}
add_shortcode('pricing_column', 'pricing_column');

/* Progress bar horizontal shortcode */

if (!function_exists('progress_bar')) {

    function progress_bar($atts, $content = null) {
        $args = array(
            "title"                     => "",
            "title_color"               => "",
            "title_tag"                 => "h6",
            "percent"                   => "",
            "percent_color"             => "",
            "active_background_color"   => "",
            "active_border_color"       => "",
            "noactive_background_color" => "",
            "height"                    => ""
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

        if ($percent_color != "") {
            $number_styles .= "color: " . $percent_color . ";";
        }

        if ($height != "") {
            $valid_height = (strstr($height, 'px', true)) ? $height : $height . "px";
            $outer_progress_styles .= "height: " . $valid_height . ";";
            $percentage_styles .= "height: " . $valid_height . ";";
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
        $html .= "<span class='progress_title'>";
        $html .= "<span>$title</span>";
        $html .= "</span>"; //close progress_title

        $html .= "<span class='progress_number' style='{$number_styles}'>";
        $html .= "<span>0</span>%</span>";
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
            "title"                             => "",
            "title_color"                       => "",
            "title_tag"                         => "h4",
            "title_size"                        => "",
            "percent"                           => "100",
            "percentage_text_size"              => "",
            "percent_color"                     => "",
            "bar_top_gradient_color"            => "",
            "bar_bottom_gradient_color"         => "",
            "bar_border_color"                  => "",
            "background_top_gradient_color"     => "",
            "background_bottom_gradient_color"  => "",
            "text"                              => ""
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
        if($background_top_gradient_color != "" && $background_bottom_gradient_color != "") {
            $bar_holder_styles .= "background: " . $background_bottom_gradient_color . ";";
            $bar_holder_styles .= "background: -ms-linear-gradient(bottom, ".$background_bottom_gradient_color." 0%, ".$background_top_gradient_color." 100%);";
            $bar_holder_styles .= "background: -moz-linear-gradient(bottom, ".$background_bottom_gradient_color." 0%, ".$background_top_gradient_color." 100%);";
            $bar_holder_styles .= "background:  -o-linear-gradient(bottom, ".$background_bottom_gradient_color." 0%, ".$background_top_gradient_color." 100%);";
            $bar_holder_styles .= "background:  -webkit-gradient(linear, left bottom, left top, color-stop(0,".$background_bottom_gradient_color."), color-stop(1, ".$background_top_gradient_color."));";
            $bar_holder_styles .= "background:  -webkit-linear-gradient(bottom, ".$background_bottom_gradient_color." 0%, ".$background_top_gradient_color." 100%);";
            $bar_holder_styles .= "background:  linear-gradient(to top, ".$background_bottom_gradient_color." 0%, ".$background_top_gradient_color." 100%);";
        }

        //generate bar gradient styles
        if($bar_top_gradient_color != "" && $bar_bottom_gradient_color != "") {
            $bar_styles .= "background: " . $bar_bottom_gradient_color . ";";
            $bar_styles .= "background: -ms-linear-gradient(bottom, ".$bar_bottom_gradient_color." 0%, ".$bar_top_gradient_color." 100%);";
            $bar_styles .= "background: -moz-linear-gradient(bottom, ".$bar_bottom_gradient_color." 0%, ".$bar_top_gradient_color." 100%);";
            $bar_styles .= "background:  -o-linear-gradient(bottom, ".$bar_bottom_gradient_color." 0%, ".$bar_top_gradient_color." 100%);";
            $bar_styles .= "background:  -webkit-gradient(linear, left bottom, left top, color-stop(0,".$bar_bottom_gradient_color."), color-stop(1, ".$bar_top_gradient_color."));";
            $bar_styles .= "background:  -webkit-linear-gradient(bottom, ".$bar_bottom_gradient_color." 0%, ".$bar_top_gradient_color." 100%);";
            $bar_styles .= "background:  linear-gradient(to top, ".$bar_bottom_gradient_color." 0%, ".$bar_top_gradient_color." 100%);";
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
        $html .= "<span class='progress_number' style='".$percentage_styles."'>";
        $html .= "<span>$percent</span>%";
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
	extract(shortcode_atts(array("icons_number" => "","active_number" => "","type"=>"","icon" => "","size" => "","custom_size" => "","icon_color"=>"","icon_active_color"=>"","background_color"=>"","background_active_color"=>"","border_color"=>"","border_active_color"=>""), $atts));
    $html =  "<div class='q_progress_bars_icons_holder'><div class='q_progress_bars_icons'><div class='q_progress_bars_icons_inner $type ";
    if($custom_size != ""){
    	$html .= "custom_size";
    } else {
    	$html .= "$size";
    }
    $html .= " clearfix' data-number='".$active_number."'";
    if($custom_size != ""){
    	$html .= " data-size='".$custom_size."'";
    }
    $html .= ">";
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

		$html .= "<i class='fa fa-stack-1x ".$icon."'";
		if($icon_active_color != ""){
			$html .= " style='color: ".$icon_active_color.";'";
		}
		$html .= "></i></span><span class='bar_active fa-stack ";
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

		$html .= "<i class='fa ".$icon." fa-stack-1x'";
		if($icon_color != ""){
			$html .= " style='color: ".$icon_color.";'";
		}
		$html .= "></i></span></div>";
		$i++;
	}
    $html .= "</div></div></div>";
    return $html;
}
}
add_shortcode('progress_bar_icon', 'progress_bar_icon');

/* Services shortcode */

if (!function_exists('service')) {

    function service($atts, $content = null) {
        $args = array(
            "type"      => "top", 
            "title"     => "", 
            "color"     => "", 
            "link"      => "", 
            "target"    => "",
            "animate"   => ""
        );
        
        extract(shortcode_atts($args, $atts));
        
        //init variables
        $html            = "";
        $service_classes = "circle_item circle_{$type}";
        $service_styles  = "";
        
        //generate service classes
        if($animate == "yes") {
            $service_classes .= " fade_in_circle_holder";
        }
        
        //generate service styles
        if($color != "") {
            $service_styles .= "color: ".$color.";";
        }
        
        //generate output
        $html .= '<div class="'.$service_classes.'">'; //open service div
        
        if ($link == "") {
            $html .= '<div class="circle fade_in_circle" style="'.$service_styles.'">'; //open circle div
            $html .= '<div>' . $title . '</div>';
            $html .= '</div>'; //close circle div
        } else {
            $html .= '<div class="circle hover fade_in_circle">'; //open circle div
            $html .= '<a href="' . $link . '" target="' . $target . '" style="'.$service_styles.'">';
            $html .= '<div>' . $title . '</div>';
            $html .= '</a>'; //close circle link
            $html .= '</div>'; //close circle div
        }
        
        $html .= '<div class="text">';
        $html .= $content;
        $html .= '</div>'; //close text div
        $html .= '</div>'; //close service div

        return $html;
    }

    add_shortcode('service', 'service');
}

/* Social Icons shortcode */

if (!function_exists('social_icons')) {
function social_icons($atts, $content = null) {
    $args = array(
        "type"                              => "",
        "icon"                              => "",
        "link"                              => "",
        "target"                            => "",
        "size"                              => "",
        "icon_color"                        => "",
        "top_gradient_background_color"     => "",
        "bottom_gradient_background_color"  => "",
        "border_color"                      => ""
    );

    extract(shortcode_atts($args, $atts));

    $html               = "";
    $fa_stack_styles    = "";
    $icon_styles        = "";

    if($top_gradient_background_color != "" && $bottom_gradient_background_color != ""){
        $fa_stack_styles .= "background: {$bottom_gradient_background_color};";
        $fa_stack_styles .= "background: {$top_gradient_background_color} -ms-linear-gradient(bottom, {$bottom_gradient_background_color} 0%, {$top_gradient_background_color} 100%);";
        $fa_stack_styles .= "background: {$top_gradient_background_color} -moz-linear-gradient(bottom, {$bottom_gradient_background_color} 0%, {$top_gradient_background_color} 100%);";
        $fa_stack_styles .= "background: {$top_gradient_background_color} -o-linear-gradient(bottom, {$bottom_gradient_background_color} 0%, {$top_gradient_background_color} 100%);";
        $fa_stack_styles .= "background: {$top_gradient_background_color} -webkit-gradient(linear, left bottom, left top, color-stop(0,{$bottom_gradient_background_color}), color-stop(1, {$top_gradient_background_color}));";
        $fa_stack_styles .= "background: {$top_gradient_background_color} -webkit-linear-gradient(bottom, {$bottom_gradient_background_color} 0%, {$top_gradient_background_color} 100%);";
        $fa_stack_styles .= "background: {$top_gradient_background_color} linear-gradient(to top, {$bottom_gradient_background_color} 0%, {$top_gradient_background_color} 100%);";
    }

    if($border_color != "") {
        $fa_stack_styles .= "border-color: ".$border_color.";";
    }

    if($icon_color != ""){
        $icon_styles .= "color: ".$icon_color.";";
    }

    $html .= "<span class='q_social_icon_holder'>";

    if($link != ""){
    	$html .= "<a href='".$link."' target='".$target."'>";
    }

        if($type == "normal_social"){
            $html .= "<i class='fa ".$icon." ".$size." simple_social' style='".$icon_styles."'></i>";    
        } else {
            $html .= "<span class='fa-stack ".$size."' style='".$fa_stack_styles."'>";
            $html .= "<i class='fa ".$icon."' style='".$icon_styles."'></i>";
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
	global $qode_options_theme13;

    if(isset($_SERVER["https"])) {
        $count_char = 23;
    } else{
        $count_char = 22;
    }

    if(isset($qode_options_theme13['twitter_via']) && !empty($qode_options_theme13['twitter_via'])) {
		$twitter_via = " via " . $qode_options_theme13['twitter_via'] . " ";
	} else {
		$twitter_via = 	"";
	}
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
    $html = "";  
	if(isset($qode_options_theme13['enable_social_share']) && $qode_options_theme13['enable_social_share'] == "yes") { 
		$post_type = get_post_type();
		if(isset($qode_options_theme13["post_types_names_$post_type"])) {
			if($qode_options_theme13["post_types_names_$post_type"] == $post_type) {
			if($post_type == "portfolio_page") {
				$html .= '<div class="portfolio_share">';
			} elseif($post_type == "post") {
				$html .= '<div class="blog_share">';
			} elseif($post_type == "page") {
				$html .= '<div class="page_share">';
			}
			$html .= '<div class="social_share_holder">';
				$html .= '<a href="javascript:void(0)" target="_self"><span class="social_share_icon"></span>';
                    if($post_type == "post" || is_singular('portfolio_page')) {
                        $html .= '<span class="social_share_title">'.  __('Share','qode') .'</span>';
                    } 
                    $html .= '</a>';
					$html .= '<div class="social_share_dropdown"><div class="inner_arrow"></div><div class="inner_arrow2"></div><ul>';
					if(isset($qode_options_theme13['enable_facebook_share']) &&  $qode_options_theme13['enable_facebook_share'] == "yes") { 
						$html .= '<li class="facebook_share">';
    						$html .= '<a href="#" onclick="window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]=' . esc_attr(get_the_title()) . '&amp;p[summary]=' . esc_attr(get_the_excerpt()) . '&amp;p[url]=' . urlencode(get_permalink()) . '&amp;&p[images][0]=';
        						if(function_exists('the_post_thumbnail')) {
        							$html .=  wp_get_attachment_url(get_post_thumbnail_id());
        						}
        						$html .='\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');" href="javascript: void(0)">';
        						if(!empty($qode_options_theme13['facebook_icon'])) {
        							$html .= '<img src="' . $qode_options_theme13["facebook_icon"] . '" alt="" />';
        						} else { 
        							$html .= '<i class="fa fa-facebook"></i>';
        						} 
        						$html .= "<span class='share_text'>" . __("Facebook","qode") . "</span>";
    						$html .= "</a>";
						$html .= "</li>";
					} 
						
					if($qode_options_theme13['enable_twitter_share'] == "yes") { 
						$html .= '<li class="twitter_share">';
                            $html .= '<a href="#" onclick="popUp=window.open(\'http://twitter.com/home?status=' . urlencode(the_excerpt_max_charlength($count_char) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;">';
								if(!empty($qode_options_theme13['twitter_icon'])) { 
									$html .= '<img src="' . $qode_options_theme13["twitter_icon"] . '" alt="" />';
								 } else { 
									$html .= '<i class="fa fa-twitter"></i>';
								 }
								$html .= "<span class='share_text'>" . __("Twitter", 'qode') . "</span>";
							$html .= "</a>";
						$html .= "</li>";
					} 
                    if($qode_options_theme13['enable_google_plus'] == "yes") { 
                        $html .= '<li  class="google_share">';
                            $html .= '<a href="#" onclick="popUp=window.open(\'https://plus.google.com/share?url=' . urlencode(get_permalink()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
                        		if(!empty($qode_options_theme13['google_plus_icon'])) { 
                        			$html .= '<img src="' . $qode_options_theme13['google_plus_icon'] . '" alt="" />';
                        		} else { 
                        			$html .= '<i class="fa fa-google-plus"></i>';
                        		 } 
                        		$html .= "<span class='share_text'>" . __("Google+","qode") . "</span>";
                        	$html .= "</a>";
                        $html .= "</li>";
                    }
					if(isset($qode_options_theme13['enable_linkedin']) && $qode_options_theme13['enable_linkedin'] == "yes") { 
						$html .= '<li  class="linkedin_share">';
                            $html .= '<a href="#" onclick="popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()). '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
								if(!empty($qode_options_theme13['linkedin_icon'])) { 
									$html .= '<img src="' . $qode_options_theme13['linkedin_icon'] . '" alt="" />';
								} else { 
									$html .= '<i class="fa fa-linkedin"></i>';
								 } 
								$html .= "<span class='share_text'>" . __("LinkedIn","qode") . "</span>";
							$html .= "</a>";
						$html .= "</li>";
					}
					if(isset($qode_options_theme13['enable_tumblr']) && $qode_options_theme13['enable_tumblr'] == "yes") { 
						$html .= '<li  class="tumblr_share">';
					       	$html .= '<a href="#" onclick="popUp=window.open(\'http://www.tumblr.com/share/link?url=' . urlencode(get_permalink()). '&amp;name=' . urlencode(get_the_title()) .'&amp;description='.urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
								if(!empty($qode_options_theme13['tumblr_icon'])) { 
									$html .= '<img src="' . $qode_options_theme13['tumblr_icon'] . '" alt="" />';
								} else { 
									$html .= '<i class="fa fa-tumblr"></i>';
								 } 
								$html .= "<span class='share_text'>" . __("Tumblr","qode") . "</span>";
							$html .= "</a>";
						$html .= "</li>";
					}
					if(isset($qode_options_theme13['enable_pinterest']) && $qode_options_theme13['enable_pinterest'] == "yes") { 
						$html .= '<li  class="pinterest_share">';
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                            $html .= '<a href="#" onclick="popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()). '&amp;description=' . esc_attr(get_the_title()) .'&amp;media='.urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
								if(!empty($qode_options_theme13['pinterest_icon'])) { 
									$html .= '<img src="' . $qode_options_theme13['pinterest_icon'] . '" alt="" />';
								} else { 
									$html .= '<i class="fa fa-pinterest"></i>';
								 } 
								$html .= "<span class='share_text'>" . __("Pinterest","qode") . "</span>";
							$html .= "</a>";
						$html .= "</li>";
					}
					if(isset($qode_options_theme13['enable_vk']) && $qode_options_theme13['enable_vk'] == "yes") { 
						$html .= '<li  class="vk_share">';
							$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
							$html .= '<a href="#" onclick="popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode(get_permalink()). '&amp;title=' . urlencode(get_the_title()) .'&amp;description=' . urlencode(get_the_excerpt()) .'&amp;image='.urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
								if(!empty($qode_options_theme13['vk_icon'])) { 
									$html .= '<img src="' . $qode_options_theme13['vk_icon'] . '" alt="" />';
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

/* Steps shortcode */

if (!function_exists('steps')) {

    function steps($atts, $content = null) {
        $args = array(
            "number_of_steps"   => "4",
            "background_color" => "",
            "number_color" => "",
            "title_color" => "",
            "circle_wrapper_border_color" => "",

            "title_1" => "",
            "step_number_1" => "",
            "step_description_1" => "",
            "step_link_1" => "",
            "step_link_target_1" => "_blank",

            "title_2" => "",
            "step_number_2" => "",
            "step_description_2" => "",
            "step_link_2" => "",
            "step_link_target_2" => "_self",

            "title_3" => "",
            "step_number_3" => "",
            "step_description_3" => "",
            "step_link_3" => "",
            "step_link_target_3" => "_self",

            "title_4" => "",
            "step_number_4" => "",
            "step_description_4" => "",
            "step_link_4" => "",
            "step_link_target_4" => "_self"
        );

        extract(shortcode_atts($args, $atts));

        $steps_array = array();

        //for the number of steps
        for ($i = 1; $i <= $number_of_steps; $i++) {
            //generate object for each step that  holds that steps data
            $step_object = new stdClass();

            $step_object->title = ${"title_".$i};
            $step_object->step_number = ${"step_number_".$i};
            $step_object->step_description = ${"step_description_".$i};
            $step_object->step_link = ${"step_link_".$i};
            $step_object->step_link_target = ${"step_link_target_".$i};

            //push object to steps array
            $steps_array[] = $step_object;
        }

        //init variables
        $html                   = "";
        $number_styles          = "";
        $title_styles           = "";
        $circle_styles          = "";
        $circle_wrapper_styles  = "";

        if($number_color != "") {
            $number_styles .= "color: ".$number_color.";";
        }

        if($title_color != "") {
            $title_styles .= "color: ".$title_color.";";
        }

        if($background_color != "") {
            $circle_styles .= "background-color: ".$background_color.";";
        }

        if($circle_wrapper_border_color != "") {
            $circle_wrapper_styles .= "border-top-color: ".$circle_wrapper_border_color.";";
        }

        if(is_array($steps_array) && count($steps_array)) {
            $html .= "<div class='q_steps_holder'>";
            $html .= "<div class='steps_holder_inner'>";


            for($i = 1; $i <= count($steps_array); $i++) {
                $step = $steps_array[$i - 1];
                $html .= "<div class='circle_small_holder step{$i}'>";
                $html .= "<div class='circle_small_holder_inner'>";
                $html .= "<div class='circle_small_wrapper' style='{$circle_wrapper_styles}'>";
                $html .= "<div class='circle_small' style='{$circle_styles}'>";

                if($step->step_link != "") {
                    $html .= "<a href='{$step->step_link}' target='{$step->step_link_target}' class='circle_small_inner'>";

                    if($step->step_number != "") {
                        $html .= "<span style='{$number_styles}'>{$step->step_number}</span>";
                    }

                    $html .= "<p class='step_title' style='{$title_styles}'>{$step->title}</p>";
                    $html .= "</a>"; //close circle_small_inner
                } else {
                    $html .= "<div class='circle_small_inner'>";

                    if($step->step_number != "") {
                        $html .= "<span style='{$number_styles}'>{$step->step_number}</span>";
                    }

                    $html .= "<p class='step_title' style='{$title_styles}'>{$step->title}</p>";
                    $html .= "</div>"; //close circle_small_inner
                }

                $html .= "</div>"; //close circle_small
                $html .= "</div>"; //close circle_small_wrapper

                $html .= "</div>"; //close circle_small_holder_inner
                $html .= "<p>{$step->step_description}</p>";
                $html .= "</div>"; //close circle_small_holder
            }

            $html .= "</div>"; //close steps_holder_inner
            $html .= "</div>"; //close steps_holder
        }

        return $html;

    }
}
add_shortcode('steps', 'steps');


/* Team shortcode */

if (!function_exists('q_team')) {
function q_team($atts, $content = null) {
    $args = array(
		"team_image"				=> "",
		"team_name"					=> "",
		"team_position"				=> "",
		"team_description"			=> "",
		"team_social_icon_1"		=> "",
		"team_social_icon_1_link"	=> "",
		"team_social_icon_1_target"	=> "",
		"team_social_icon_2"		=> "",
		"team_social_icon_2_link"	=> "",
		"team_social_icon_2_target"	=> "",
		"team_social_icon_3"		=> "",
		"team_social_icon_3_link"	=> "",
		"team_social_icon_3_target"	=> "",
		"team_social_icon_4"		=> "",
		"team_social_icon_4_link"	=> "",
		"team_social_icon_4_target"	=> "",
		"team_social_icon_5"		=> "",
		"team_social_icon_5_link"	=> "",
		"team_social_icon_5_target"	=> "",
		"title_tag"					=> "h5"
    );
        
    extract(shortcode_atts($args, $atts));
      $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
                
		//get correct heading value. If provided heading isn't valid get the default one
		$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
	if(is_numeric($team_image)) {
		$team_image_src = wp_get_attachment_url( $team_image );
	} else {
		$team_image_src = $team_image;
	}
 
    
    $html =  "<div class='q_team'>";
		$html .=  "<div class='q_team_inner'>";
			if($team_image != "") {
				$html .=  "<div class='q_team_image'>";
					$html .=  "<img src='$team_image_src' alt='' />";
				$html .=  "</div>";
			}
			$html .=  "<div class='q_team_text'>";
				$html .=  "<div class='q_team_text_inner'>";
					$html .=  "<div class='q_team_title_holder'>";
						$html .=  "<$title_tag class='q_team_name'>";
							$html .= $team_name;
						$html .=  "</$title_tag>";
						if($team_position != "") {
							$html .= "<span>" . $team_position . "</span>";
						}
					$html .=  "</div>";
					$html .=  "<p>" . $team_description . "</p>";
				$html .=  "</div>";
				$html .=  "<div class='q_team_social_holder'>";
				if($team_social_icon_1 != "") {
					$html .=  do_shortcode('[social_icons icon="'. $team_social_icon_1 .'" size="fa-lg" link="' . $team_social_icon_1_link . '" target="' . $team_social_icon_1_target . '"]');
				}
				if($team_social_icon_2 != "") {
					$html .=  do_shortcode('[social_icons icon="'. $team_social_icon_2 .'" size="fa-lg" link="' . $team_social_icon_2_link . '" target="' . $team_social_icon_2_target . '"]');
				}
				if($team_social_icon_3 != "") {
					$html .=  do_shortcode('[social_icons icon="'. $team_social_icon_3 .'" size="fa-lg" link="' . $team_social_icon_3_link . '" target="' . $team_social_icon_3_target . '"]');
				}
				if($team_social_icon_4 != "") {
					$html .=  do_shortcode('[social_icons icon="'. $team_social_icon_4 .'" size="fa-lg" link="' . $team_social_icon_4_link . '" target="' . $team_social_icon_4_target . '"]');
				}
				if($team_social_icon_5 != "") {
					$html .=  do_shortcode('[social_icons icon="'. $team_social_icon_5 .'" size="fa-lg" link="' . $team_social_icon_5_link . '" target="' . $team_social_icon_5_target . '"]');
				}
				
				$html .=  "</div>";
			$html .=  "</div>";
		$html .=  "</div>";
	$html .=  "</div>";
    return $html;
}
}
add_shortcode('q_team', 'q_team');


/* Testimonials shortcode */

if (!function_exists('testimonials')) {

    function testimonials($atts, $content = null) {
        $deafult_args = array(
            "number"                => "-1", 
            "type"                	=> "standard",
			"content_in_grid"       => "0", 			
            "category"              => "",
            "text_color"            => "",
            "background_color"      => "",
            "border_color"          => "",
            "author_image"          => ""
        );
        
        extract(shortcode_atts($deafult_args, $atts));
        
        $html                           = "";
        $testimonial_text_inner_styles  = "";
        $testimonial_name_styles        = "";
		$p_color						= "";
        
        if($text_color != "") {
            $testimonial_text_inner_styles  .= "color: ".$text_color.";";
            $testimonial_name_styles        .= "color: ".$text_color.";";
			$p_color = ' style="color:'.$text_color.';"';
        }
		if($background_color != ''){
			$testimonial_text_inner_styles .= "background-color: ".$background_color.';';
		}
		if($border_color != ''){
			$testimonial_text_inner_styles .= "border-color: ".$border_color.';';
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
        
        $html .= "<div class='testimonials_holder $type clearfix'>";
        $html .= '<div class="testimonials testimonials_carousel">';
        $html .= '<ul class="slides">';
        
        query_posts($args);
        if (have_posts()) :
            while (have_posts()) : the_post();
                $author = get_post_meta(get_the_ID(), "qode_testimonial-author", true);
                $website = get_post_meta(get_the_ID(), "qode_testimonial_website", true);
                $company_position = get_post_meta(get_the_ID(), "qode_testimonial-company_position", true);
                $text = get_post_meta(get_the_ID(), "qode_testimonial-text", true);
                $html .= '<li id="testimonials' . get_the_ID() . '" class="testimonial_content">';
                $html .= '<div class="testimonial_content_inner"';

				$html .= '>';
                $html .= '<div class="testimonial_text_holder">';
                $html .= '<div class="testimonial_text_inner" style="'.$testimonial_text_inner_styles.'">';
				if($type == "full_width" && $content_in_grid == '1') { 
					$html .= '<div class="container">';
					$html .= '<div class="container_inner clearfix">';
					
				}
					$html .= '<p'. $p_color .'>' . trim($text) . '</p>';
					if($type == "full_width") {
						$html .= '<h5>' . $author;
						if($company_position != "") {
							$html .= ', ' . $company_position;
						}
						if($website != "") {
							$html .= ', ' . $website;
						}
						$html .= '</h5>';
					}
				if($type == "full_width" && $content_in_grid == '1') { 
					
					$html .= '</div>';
					$html .= '</div>';
				}
				if($type == "full_width") { 
					if($author_image == 'yes') {
						$html .= '<div class="image_holder">'.get_the_post_thumbnail(get_the_ID()).'</div>';
					}
				}
				
                $html .= '</div>'; //close testimonial_text_inner
				if($type != "full_width") {
					$html .= '<span class="testimonial_arrow"';
					
					if($background_color != '' || $border_color != ''){
						$html .= ' style="background-color: '.$background_color.'; border-color: '.$border_color.';"';
					}
					$html .= '></span>';
				}
				$html .= '</div>'; //close testimonial_text_holder
				if($type != "full_width") {
				$html .= '<div class="author_image_holder clearfix">';
				if($author_image == 'yes') {
                   $html .= '<div class="image_holder">'.get_the_post_thumbnail(get_the_ID()).'</div>';
                }
                $html .= '<div class="testimonial_author">';
				
					$html .= '<h4><span class="testimonial_name" style="'.$testimonial_name_styles.'">' . $author .'</span>';
					if($company_position != "") {
						$html .= '<span class="company_position" style="'.$testimonial_name_styles.'">, ' . $company_position .'</span>';
					}
					$html .= '</h4>';
					if($website != "") {
						$html .= '<span class="company_website">' . $website .'</span>';
					}
				$html .= '</div>'; //close testimonial_author
				$html .= '</div>';//close author_image_holder
				}
				$html .= '</div>'; //close content_inner
				$html .= '</li>'; //close testimonials
            endwhile;
        else:
            $html .= __('Sorry, no posts matched your criteria.', 'qode');
        endif;

        wp_reset_query();
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

/* Qode Slider shortcode */

if (!function_exists('qode_slider')) {
function qode_slider( $atts, $content = null ) {
	global $qode_options_theme13;
	extract(shortcode_atts(array("slider"=>"", "height"=>"", "background_color"=>"", "auto_start"=>"", "slide_animation"=>"6000"), $atts));
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
		
		$slider_thumbs =  $slider_meta['slider_thumbs'];
		if($slider_thumbs == 'yes'){
			$slider_thumbs_class = 'slider_thumbs';
		}else{
			$slider_thumbs_class = '';
		}
		
		if($height == "" || $height == "0"){ 
			$full_screen_class = "full_screen";
			$slide_height = "";
		}else{
			$full_screen_class = "";
			$slide_height = "height: ".$height."px;";
		}
		
		$slider_transparency_class = "header_not_transparent";
		if(isset($qode_options_theme13['header_background_transparency_initial']) && $qode_options_theme13['header_background_transparency_initial'] != "1" && $qode_options_theme13['header_background_transparency_initial'] != ""){
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
		
		/**************** Count positioning of navigation arrows and preloader depending on header transparency and layout - START ****************/
		
		global $wp_query; 
		
		$page_id = $wp_query->get_queried_object_id();
		$header_height_padding = 0;
		if((get_post_meta($page_id, "qode_header_color_transparency_per_page", true) == "" || get_post_meta($page_id, "qode_header_color_transparency_per_page", true) == "1") && ($qode_options_theme13['header_background_transparency_initial'] == "" || $qode_options_theme13['header_background_transparency_initial'] == "1")){
			if (!empty($qode_options_theme13['header_height'])) {
				$header_height = $qode_options_theme13['header_height'];
			} else {
				$header_height = 86;
			}
			if($qode_options_theme13['header_bottom_appearance'] == 'stick menu_bottom'){
				$menu_bottom = '46';
				if(is_active_sidebar('header_fixed_right')){
					$menu_bottom = $menu_bottom + 22;
				}
			} else {
				$menu_bottom = 0;
			}

			$header_top = 0;
			if(isset($qode_options_theme13['header_top_area']) && $qode_options_theme13['header_top_area'] == "yes"){
				$header_top = 34;	
			}
			$header_height_padding = $header_height + $menu_bottom + $header_top;
			if (isset($qode_options_theme13['center_logo_image']) && $qode_options_theme13['center_logo_image'] == "yes") { 
				if(isset($qode_options_theme13['logo_image'])){
							$logo_width = 0;
							$logo_height = 0;
							if (!empty($qode_options_theme13['logo_image'])) {
								$logo_url_obj = parse_url($qode_options_theme13['logo_image']); 
								list($logo_width, $logo_height, $logo_type, $logo_attr) = getimagesize($_SERVER['DOCUMENT_ROOT'].$logo_url_obj['path']);  
							} 
						}
				$header_height_padding = $logo_height + 30 + $menu_bottom + $header_top; // 30 is top and bottom margin of centered logo
			}
		}
		if($header_height_padding != 0){ 
			$navigation_margin_top = 'style="margin-top:'. ($header_height_padding/2 - 30).'px;"'; // 30 is top and bottom margin of centered logo
			$loader_margin_top = 'style="margin-top:'. ($header_height_padding/2).'px;"';
		}
		else { 
			$navigation_margin_top = ''; 
			$loader_margin_top = ''; 
		}
		
		/**************** Count positioning of navigation arrows and preloader depending on header transparency and layout - END ****************/
		
		
		$html .= '<div id="qode-'.$slider.'" class="carousel slide '.$full_screen_class.' '.$auto_start_class.' '.$header_effect_class.' '.$slider_thumbs_class.' '.$slider_transparency_class.'" '.$slide_animation.' style="'.$slide_height.' '.$background_color.'"><div class="qode_slider_preloader"><div class="ajax_loader_slider" '.$loader_margin_top.'><div class="ajax_loader_1"><div class="ajax_loader_html"></div></div></div></div>';
		$html .= '<div class="carousel-inner" data-start="transform: translateY(0px);" data-1440="transform: translateY(-500px);">';
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
				$thumbnail = get_post_meta(get_the_ID(), "qode_slide-thumbnail", true);
				$thumbnail_animation = get_post_meta(get_the_ID(), "qode_slide-thumbnail-animation", true);
				
				$video_webm = get_post_meta(get_the_ID(), "qode_slide-video-webm", true);
				$video_mp4 = get_post_meta(get_the_ID(), "qode_slide-video-mp4", true);
				$video_ogv = get_post_meta(get_the_ID(), "qode_slide-video-ogv", true);
				$video_image = get_post_meta(get_the_ID(), "qode_slide-video-image", true);
				$video_overlay = get_post_meta(get_the_ID(), "qode_slide-video-overlay", true);
				$video_overlay_image = get_post_meta(get_the_ID(), "qode_slide-video-overlay-image", true);
				
				$title_color = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-title-color", true) != ""){
					$title_color .= "color: ". get_post_meta(get_the_ID(), "qode_slide-title-color", true) . ";";
				}
				$title_font_size = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-title-font-size", true) != ""){
					$title_font_size .= "font-size: ". get_post_meta(get_the_ID(), "qode_slide-title-font-size", true) . "px;";
				}
				$title_line_height = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-title-line-height", true) != ""){
					$title_line_height .= "line-height: ". get_post_meta(get_the_ID(), "qode_slide-title-line-height", true) . "px;";
				}
				$title_font_family = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-title-font-family", true) != ""){
					$title_font_family .= "font-family: ". str_replace('+', ' ', get_post_meta(get_the_ID(), "qode_slide-title-font-family", true)) . ";";
				}
				$title_font_style = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-title-font-style", true) != ""){
					$title_font_style .= "font-style: ". get_post_meta(get_the_ID(), "qode_slide-title-font-style", true) . ";";
				}
				$title_font_weight = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-title-font-weight", true) != ""){
					$title_font_weight .= "font-weight: ". get_post_meta(get_the_ID(), "qode_slide-title-font-weight", true) . ";";
				}
				$text_shadow = "";
				if(get_post_meta(get_the_ID(), "qode_slide-hide-shadow", true) == true){
					$text_shadow = "text-shadow: none;";
				}
				
				$text_color = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-text-color", true) != ""){
					$text_color = "color: ". get_post_meta(get_the_ID(), "qode_slide-text-color", true) . ";";
				}
				$text_font_size = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-text-font-size", true) != ""){
					$text_font_size = "font-size: ". get_post_meta(get_the_ID(), "qode_slide-text-font-size", true) . "px;";
				}
				$text_line_height = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-text-line-height", true) != ""){
					$text_line_height = "line-height: ". get_post_meta(get_the_ID(), "qode_slide-text-line-height", true) . "px;";
				}
				$text_font_family = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-text-font-family", true) != ""){
					$text_font_family = "font-family: ". str_replace('+', ' ', get_post_meta(get_the_ID(), "qode_slide-text-font-family", true)) . ";";
				}
				$text_font_style = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-text-font-style", true) != ""){
					$text_font_style = "font-style: ". get_post_meta(get_the_ID(), "qode_slide-text-font-style", true) . ";";
				}
				$text_font_weight = "";					
				if(get_post_meta(get_the_ID(), "qode_slide-text-font-weight", true) != ""){
					$text_font_weight = "font-weight: ". get_post_meta(get_the_ID(), "qode_slide-text-font-weight", true) . ";";
				}
				
				$graphic_alignment = get_post_meta(get_the_ID(), "qode_slide-graphic-alignment", true);
				$content_alignment = get_post_meta(get_the_ID(), "qode_slide-content-alignment", true);
				
				$separate_text_graphic = get_post_meta(get_the_ID(), "qode_slide-separate-text-graphic", true);
				
				if(get_post_meta(get_the_ID(), "qode_slide-content-width", true) != ""){
					$content_width = "width:".get_post_meta(get_the_ID(), "qode_slide-content-width", true)."%;";
				}else{
					$content_width = "width:50%;";
				}
				if(get_post_meta(get_the_ID(), "qode_slide-content-left", true) != ""){
					$content_xaxis= "left:".get_post_meta(get_the_ID(), "qode_slide-content-left", true)."%;";
				}else{
					if(get_post_meta(get_the_ID(), "qode_slide-content-right", true) != ""){
						$content_xaxis = "right:".get_post_meta(get_the_ID(), "qode_slide-content-right", true)."%;";
					}else{
						$content_xaxis = "left: 25%;";
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
						$content_yaxis_start = "top: 20%;";
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
						$graphic_yaxis_start = "top: 20%;";
						$graphic_yaxis_end = "top: 10%;";
					}
				}
				
				$header_style = "";
				if(get_post_meta(get_the_ID(), "qode_slide-header-style", true) != ""){
					$header_style = get_post_meta(get_the_ID(), "qode_slide-header-style", true);
				}
				
				$navigation_color = "";
				if(get_post_meta(get_the_ID(), "qode_slide-navigation-color", true) != ""){
					$navigation_color = 'data-navigation-color="'.get_post_meta(get_the_ID(), "qode_slide-navigation-color", true).'"';
				}
				
        $title = get_the_title();
				
				$html .= '<div class="item '.$header_style.'" '.$navigation_color.' style="'.$slide_height.'">';
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
					$html .= '</div>';
				}
				
				$html_thumb = "";
				if($thumbnail != ""){
					$html_thumb .= '<div class="thumb '.$thumbnail_animation.'">';
					$html_thumb .= '<img src="'.$thumbnail.'" alt="'.$title.'">';
					$html_thumb .= '</div>';
				}
				$html_text = "";
				$html_text .= '<div class="text">';
				if(get_post_meta(get_the_ID(), "qode_slide-hide-title", true) != true){
					$html_text .= '<h2 style="'.$title_color.$title_font_size.$title_line_height.$title_font_family.$title_font_style.$title_font_weight.$text_shadow.'"><span>'.get_the_title().'</span></h2>';
				}
				if(get_post_meta(get_the_ID(), "qode_slide-text", true) != ""){
					$html_text .= '<p style="'.$text_color.$text_font_size.$text_line_height.$text_font_family.$text_font_style.$text_font_weight.$text_shadow.'"><span>'.get_post_meta(get_the_ID(), "qode_slide-text", true).'</span></p>';
				}
				if(get_post_meta(get_the_ID(), "qode_slide-button-label", true) != "" && get_post_meta(get_the_ID(), "qode_slide-button-link", true) != ""){
					$html_text .= '<a class="qbutton small dark" href="'.get_post_meta(get_the_ID(), "qode_slide-button-link", true).'">'.get_post_meta(get_the_ID(), "qode_slide-button-label", true).'</a>';
				}
				if(get_post_meta(get_the_ID(), "qode_slide-button-label2", true) != "" && get_post_meta(get_the_ID(), "qode_slide-button-link2", true) != ""){
					$html_text .= '<a class="qbutton small green" href="'.get_post_meta(get_the_ID(), "qode_slide-button-link2", true).'">'.get_post_meta(get_the_ID(), "qode_slide-button-label2", true).'</a>';
				}
				$html_text .= '</div>';
				$html .= '<div class="slider_content_outer">';
				
				if($separate_text_graphic != 'yes'){
					$html .= '<div class="slider_content '.$content_alignment.'" style="'.$content_width.$content_xaxis.$content_yaxis_start.'" data-start="'.$content_width.' opacity:1; '.$content_xaxis.' '.$content_yaxis_start.'" data-300="opacity: 0; '.$content_xaxis.' '.$content_yaxis_end.'">';
					$html .= $html_thumb;
					$html .= $html_text;
					$html .= '</div>';
				}else{
					$html .= '<div class="slider_content '.$graphic_alignment.'" style="'.$graphic_width.$graphic_xaxis.$graphic_yaxis_start.'" data-start="'.$graphic_width.' opacity:1; '.$graphic_xaxis.' '.$graphic_yaxis_start.'" data-300="opacity: 0; '.$graphic_xaxis.' '.$graphic_yaxis_end.'">';
					$html .= $html_thumb;
					$html .= '</div>';
					$html .= '<div class="slider_content '.$content_alignment.'" style="'.$content_width.$content_xaxis.$content_yaxis_start.'" data-start="'.$content_width.' opacity:1; '.$content_xaxis.' '.$content_yaxis_start.'" data-300="opacity: 0; '.$content_xaxis.' '.$content_yaxis_end.'">';
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
			$html .= '<ol class="carousel-indicators" data-start="opacity: 1;" data-300="opacity:0;">';
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
			$html .= '<a class="left carousel-control" href="#qode-'.$slider.'" data-slide="prev" data-start="opacity: 0.2;" data-300="opacity:0;"><span class="prev_nav" '.$navigation_margin_top.'><i class="fa fa-angle-left"></i></span><span class="thumb_holder" '.$navigation_margin_top.'><span class="thumb_top clearfix"><span class="arrow_left"><i class="fa fa-angle-left"></i></span><span class="numbers"><span class="prev"></span> / '.$postCount.'</span></span><span class="img_outer"><span class="img"></span></span></span></a>';
			$html .= '<a class="right carousel-control" href="#qode-'.$slider.'" data-slide="next" data-start="opacity: 0.2;" data-300="opacity:0;"><span class="next_nav" '.$navigation_margin_top.'><i class="fa fa-angle-right"></i></span><span class="thumb_holder" '.$navigation_margin_top.'><span class="thumb_top clearfix"><span class="numbers"> <span class="next"></span> / '.$postCount.'</span><span class="arrow_right"><i class="fa fa-angle-right"></i></span></span><span class="img_outer"><span class="img"></span></span></span></a>';
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
            "carousel" => "",
            "orderby"  => "date",
            "order"    => "ASC",
            "control_style" => "control_style"
        );
    extract(shortcode_atts($args, $atts));

    $html = "";
    
    if ($carousel != "") {

        $html .= "<div class='qode_carousels_holder clearfix'><div class='qode_carousels ".$control_style."'><ul class='slides'>";

        $q = array('post_type'=> 'carousels', 'carousels_category' => $carousel, 'orderby' => $orderby, 'order' => $order, 'posts_per_page' => '-1');

        query_posts($q);

        if ( have_posts() ) : $postCount = 0; while ( have_posts() ) : the_post(); 

            if(get_post_meta(get_the_ID(), "qode_carousel-image", true) != ""){
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

            $html .= "<li>";

            if($link != ""){
                $html .= "<a href='".$link."' target='".$target."'>";
            }

            if($image != ""){
                $html .= "<span class='first_image_holder ".$has_hover_image."'><img src='".$image."' alt='".$title."'></span>";
            }

            if($hover_image != ""){
                $html .= "<span class='second_image_holder ".$has_hover_image."'><img src='".$hover_image."' alt='".$title."'></span>";
            }
            
            if($link != ""){
                $html .= "</a>";
            }

            $html .= "</li>";

            $postCount++;

        endwhile;

        else:
            $html .= __('Sorry, no posts matched your criteria.','qode');
        endif;

        wp_reset_query();

        $html .= "</ul></div></div>";
        
    }
    
    return $html;
}
}
add_shortcode('qode_carousel', 'qode_carousel');