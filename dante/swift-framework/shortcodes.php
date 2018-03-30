<?php
	
	/*
	*
	*	Swift Shortcodes & Generator Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*/
	
	
	/* ==================================================
	
	SHORTCODE GENERATOR SETUP
	
	================================================== */
	
	// Create TinyMCE's editor button & plugin for Swift Framework Shortcodes
	add_action('init', 'sf_sc_button'); 
	
	function sf_sc_button() {  
	   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
	   {  
	     add_filter('mce_external_plugins', 'sf_add_tinymce_plugin');  
	     add_filter('mce_buttons', 'sf_register_shortcode_button');  
	   }  
	} 
	
	function sf_register_shortcode_button($button) {  
	    array_push($button, 'separator', 'swiftframework_shortcodes' );  
	    return $button;  
	}
	
	function sf_add_tinymce_plugin($plugins) {  
	    $plugins['swiftframework_shortcodes'] = get_template_directory_uri() . '/swift-framework/sf-shortcodes/tinymce.editor.plugin.js';  
	    return $plugins;  
	} 
	
	function sf_custom_mce_styles( $args ) {
				
		$style_formats = array (
		    array( 'title' => 'Impact Text', 'selector' => 'p', 'classes' => 'impact-text' ),
		    array( 'title' => 'Impact Text Large', 'selector' => 'p', 'classes' => 'impact-text-large' )
		);
		
		$args['style_formats'] = json_encode( $style_formats );
		
		return $args;
	}
	 
	add_filter('tiny_mce_before_init', 'sf_custom_mce_styles');
	
	function sf_mce_add_buttons( $buttons ){
	    array_splice( $buttons, 1, 0, 'styleselect' );
	    return $buttons;
	}
	add_filter( 'mce_buttons_2', 'sf_mce_add_buttons' );
	
	function sf_add_editor_styles() {
	    add_editor_style( '/css/editor-style.css' );
	}
	add_action( 'init', 'sf_add_editor_styles' );	
	
	
	/* ==================================================
	
	SHORTCODES OUTPUT
	
	================================================== */
	
	
	/* ALERT SHORTCODE
	================================================== */

	function sf_alert( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"type"			=> "info"
		), $atts));
	   return '<div class="alert '. $type .'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('alert', 'sf_alert');


	/* BUTTON SHORTCODE
	================================================== */
	
	function sf_button($atts, $content = null) {
		extract(shortcode_atts(array(
			"size"			=> "standard",
			"colour"		=> "",
			"type"			=> "",
			"link" 			=> "#",
			"target"		=> '_self',
			"dropshadow"    => '',
			"icon"			=> '',
			"extraclass"   => ''
		), $atts));
		
		$button_output = "";
		$button_class = 'sf-button '.$size.' '. $colour .' '. $type .' '. $extraclass;
				
		if ($dropshadow == "yes") {
		$button_class .= " dropshadow";
		}
		
		if ($type == "sf-icon-reveal" || $type == "sf-icon-stroke") {
			$button_output .= '<a class="'.$button_class.'" href="'.$link.'" target="'.$target.'">';
			$button_output .= '<i class="'.$icon.'"></i>';
			$button_output .= '<span class="text">'. do_shortcode($content) .'</span>';
			$button_output .= '</a>';
		} else {
			$button_output .= '<a class="'.$button_class.'" href="'.$link.'" target="'.$target.'"><span class="text">' . do_shortcode($content) . '</span></a>';
		}
		
		return $button_output;
	}
	add_shortcode('sf_button', 'sf_button');
	
	
	/* ICON SHORTCODE
	================================================== */
		
	function sf_icon($atts, $content = null) {
		extract(shortcode_atts(array(
			"size"			=> "",
			"image"			=> "",
			"character"		=> "",
			"cont" 			=> "",
			"float" 		=> "",
			"color"			=> "",
			"link"			=> "",
			"target"		=> "_self",
		), $atts));
		
		if (strlen($character) > 1) {
			$character = substr($character, 0, 1);
		}
		
		$icon_output = "";
		
		if ($cont == "yes") {
			if ($character != "") {
				$icon_output = '<div class="sf-icon-cont cont-'.$size.' sf-icon-float-'.$float.' sf-icon-'.$color.'"><span class="sf-icon-character sf-icon sf-icon-'.$size.'">'.$character.'</span></div>';
			} else {
				$icon_output = '<div class="sf-icon-cont cont-'.$size.' sf-icon-float-'.$float.' sf-icon-'.$color.'"><i class="'.$image.' sf-icon sf-icon-'.$size.'"></i></div>';
			}
		} else {
			if ($character != "") {
				$icon_output = '<span class="sf-icon-character sf-icon sf-icon-float-'.$float.' sf-icon-'.$size.' sf-icon-'.$color.'">'.$character.'</span>';
			} else {
				$icon_output = '<i class="'.$image.' sf-icon sf-icon-float-'.$float.' sf-icon-'.$size.' sf-icon-'.$color.'"></i>';	
			}
		}
		
		if ($link != "") {
			$icon_output = '<a href="'.$link.'" target="'.$target.'" class="linked-icon">'.$icon_output.'</a>';
		}
		
		return $icon_output;
	}
	add_shortcode('icon', 'sf_icon');
	
	
	/* ICON BOX SHORTCODE
	================================================== */
	
	function sf_iconbox($atts, $content = null) {
		extract(shortcode_atts(array(
			"type"			=> "",
			"image"			=> "",
			"character"		=> "",
			"color"			=> "",
			"title" 		=> "",
			"animation" 	=> "",
			"animation_delay"	=> "",
			"link"			=> "",
			"target"		=> "_self",
		), $atts));
		
		$icon_box = "";
		
		if ($animation != "" && $type != "animated") {
		$icon_box .= '<div class="sf-icon-box sf-icon-box-'.$type.' sf-animation sf-icon-'.$color.'" data-animation="'.$animation.'" data-delay="'.$animation_delay.'">';		
		} else {
		$icon_box .= '<div class="sf-icon-box sf-icon-box-'.$type.'">';		
		}
				
		if ($type == "animated") {
			if ($link != "") {
				$icon_box .= '<a class="box-link" href="'.$link.'" target="'.$target.'"></a>';
			}
			$icon_box .= '<div class="inner">';
			$icon_box .= '<div class="front">';
			$icon_box .= do_shortcode('[icon size="large" image="'.$image.'" character="'.$character.'" float="none" cont="no" color="'.$color.'"]');
		}
		
		if ($type == "left-icon-alt") {
			$icon_box .= do_shortcode('[icon size="medium" image="'.$image.'" character="'.$character.'" float="none" cont="no" color="'.$color.'" link="'.$link.'" target="'.$target.'"]');		
		} else if ($type != "boxed-two" && $type != "boxed-four" && $type != "standard-title" && $type != "animated") {
			$icon_box .= do_shortcode('[icon size="small" image="'.$image.'" character="'.$character.'" float="none" cont="yes" color="'.$color.'" link="'.$link.'" target="'.$target.'"]');
		}
		
		$icon_box .= '<div class="sf-icon-box-content-wrap clearfix">';
		
		if ($type == "boxed-two") {
			$icon_box .= do_shortcode('[icon size="medium" image="'.$image.'" character="'.$character.'" float="none" cont="no" color="'.$color.'" link="'.$link.'" target="'.$target.'"]');
		}
		
		if ($type == "boxed-four" || $type == "standard-title") {
			
			if ($link != "") {
				$title = '<a href="'.$link.'" target="'.$target.'">' . $title . '</a>';
			}
			
			if ($character != "") {
				$icon_box .= '<h3><span class="sf-icon-character sf-icon-'.$color.'">'.$character.'</span> '.$title.'</h3>';	
			} else {
				$icon_box .= '<h3><i class="'.$image.' sf-icon-'.$color.'"></i> '.$title.'</h3>';	
			}
		} else {
			
			if ($link != "" && $type != "animated") {
				$title = '<a href="'.$link.'" target="'.$target.'">' . $title . '</a>';
			}
			
			$icon_box .= '<h3>'.$title.'</h3>';	
		}
		
		if ($type == "standard") {
		$icon_box .= '<div class="sf-icon-box-hr sf-icon-'.$color.'"></div>';
		}
		if ($type != "animated") {
		$icon_box .= '<div class="sf-icon-box-content">'.do_shortcode($content).'</div>';
		}
		
		$icon_box .= '</div>';
		
		if ($type == "animated") {
			$icon_box .= '</div>';
			$icon_box .= '<div class="back sf-icon-'.$color.'"><table>';
			$icon_box .= '<tbody><tr>';
			$icon_box .= '<td>';
			$icon_box .= '<h3>'.$title.'</h3>';	
			$icon_box .= '<div class="sf-icon-box-content">'.do_shortcode($content).'</div>';
			$icon_box .= '</td>';
			$icon_box .= '</tr>';
			$icon_box .= '</tbody></table></div>';
			$icon_box .= '</div>';
		}
		
		$icon_box .= '</div>';	
			
		return $icon_box;
		
	}
	add_shortcode('sf_iconbox', 'sf_iconbox');
	
	
	/* IMAGE BANNER SHORTCODE
	================================================== */
	
	function sf_imagebanner($atts, $content = null) {
		extract(shortcode_atts(array(
			"image"			=> "",
			"animation" 	=> "fade-in",
			"contentpos"	=> "center",
			"textalign"	=> "center",
			"extraclass"	=> ""
		), $atts));
		
		$image_banner = "";
		
		$image_banner .= '<div class="sf-image-banner '.$extraclass.'">';	
		
		$image_banner .= '<div class="image-banner-content sf-animation content-'.$contentpos.' text-'.$textalign.'" data-animation="'.$animation.'" data-delay="200">';	
		$image_banner .= do_shortcode($content);
		$image_banner .= '</div>';
		
		$image_banner .= '<img src="'.$image.'" alt="" />';
		
		$image_banner .= '</div>';	
		
		global $sf_has_imagebanner;
		$sf_has_imagebanner = true;
			
		return $image_banner;
		
	}
	add_shortcode('sf_imagebanner', 'sf_imagebanner');
	
	
	/* COLUMN SHORTCODES
	================================================== */

	function sf_one_third( $atts, $content = null ) {
	   return '<div class="one_third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_third', 'sf_one_third');

	function sf_one_third_last( $atts, $content = null ) {
	   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_third_last', 'sf_one_third_last');

	function sf_two_third( $atts, $content = null ) {
	   return '<div class="two_third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_third', 'sf_two_third');

	function sf_two_third_last( $atts, $content = null ) {
	   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_third_last', 'sf_two_third_last');

	function sf_one_half( $atts, $content = null ) {
	   return '<div class="one_half">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_half', 'sf_one_half');

	function sf_one_half_last( $atts, $content = null ) {
	   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_half_last', 'sf_one_half_last');

	function sf_one_fourth( $atts, $content = null ) {
	   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'sf_one_fourth');

	function sf_one_fourth_last( $atts, $content = null ) {
	   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fourth_last', 'sf_one_fourth_last');

	function sf_three_fourth( $atts, $content = null ) {
	   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fourth', 'sf_three_fourth');

	function sf_three_fourth_last( $atts, $content = null ) {
	   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fourth_last', 'sf_three_fourth_last');
	
	
	/* TABLE SHORTCODES
	================================================= */
	
	function sf_table_wrap( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"type" => ''
		), $atts));

		$output = '<table class="sf-table '.$type.'"><tbody>';
		$output .= do_shortcode($content) .'</tbody></table>';
		
		return $output;
		
	}
	add_shortcode('table', 'sf_table_wrap');
	
	function sf_table_row( $atts, $content = null ) {

		$output = '<tr>';
		$output .= do_shortcode($content) .'</tr>';
		
		return $output;
	}
	add_shortcode('trow', 'sf_table_row');
	
	function sf_table_column( $atts, $content = null ) {
	
		$output = '<td>';
		$output .= do_shortcode($content) .'</td>';
		
		return $output;
	}
	add_shortcode('tcol', 'sf_table_column');

	function sf_table_head( $atts, $content = null ) {

		$output = '<th>';
		$output .= do_shortcode($content) .'</th>';
		
		return $output;
	}
	add_shortcode('thcol', 'sf_table_head');
	
	
	/* PRICING TABLE SHORTCODES
	================================================= */
	
	function sf_pt_wrap( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"type" => '',
			"columns" => ''
		), $atts));

		$output = '<div class="pricing-table-wrap '.$type.' columns-'. $columns .'">' . do_shortcode($content) .'</div>';		
		return $output;
		
	}
	add_shortcode('pricing_table', 'sf_pt_wrap');
	
	function sf_pt_column( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"highlight" => ''
		), $atts));
		
		if ($highlight == "yes") {
			$output = '<div class="pricing-table-column column-highlight">' . do_shortcode($content) .'</div>';
		} else {
			$output = '<div class="pricing-table-column">' . do_shortcode($content) .'</div>';
		}
		
		return $output;
	}
	add_shortcode('pt_column', 'sf_pt_column');
	
	function sf_pt_price( $atts, $content = null ) {
			
		$output = '<div class="pricing-table-price">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('pt_price', 'sf_pt_price');
	
	function sf_pt_package( $atts, $content = null ) {
			
		$output = '<div class="pricing-table-package">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('pt_package', 'sf_pt_package');
	
	function sf_pt_details( $atts, $content = null ) {
			
		$output = '<div class="pricing-table-details">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('pt_details', 'sf_pt_details');
	
	function sf_pt_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"link" 			=> "#",
			"target"		=> '_self'
		), $atts));
			
		$output = '<br/>'.do_shortcode('[sf_button link="'.$link.'" target="'.$target.'" type="standard" colour="accent"]' . $content .'[/sf_button]');
		
		return $output;
	}
	add_shortcode('pt_button', 'sf_pt_button');
	
	
	/* LABELLED PRICING TABLE SHORTCODES
	================================================= */
	
	function sf_lpt_wrap( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"columns" => ''
		), $atts));

		$output = '<div class="pricing-table-wrap labelled-pricing-table columns-'. $columns .'">' . do_shortcode($content) .'</div>';		
		return $output;
		
	}
	add_shortcode('labelled_pricing_table', 'sf_lpt_wrap');
	
	function sf_lpt_label_column( $atts, $content = null ) {
		
		$output = '<div class="pricing-table-column label-column">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('lpt_label_column', 'sf_lpt_label_column');
	
	function sf_lpt_column( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"highlight" => ''
		), $atts));
		
		if ($highlight == "yes") {
			$output = '<div class="pricing-table-column column-highlight">' . do_shortcode($content) .'</div>';
		} else {
			$output = '<div class="pricing-table-column">' . do_shortcode($content) .'</div>';
		}
		
		return $output;
	}
	add_shortcode('lpt_column', 'sf_lpt_column');
	
	function sf_lpt_price( $atts, $content = null ) {
			
		$output = '<div class="pricing-table-price">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('lpt_price', 'sf_lpt_price');
	
	function sf_lpt_package( $atts, $content = null ) {
			
		$output = '<div class="pricing-table-package">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('lpt_package', 'sf_pt_package');
	
	function sf_lpt_row_label( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"alt" 			=> "",
		), $atts));
		
		if ($alt == "yes") {
			$output = '<div class="pricing-table-label-row alt-row">' . do_shortcode($content) .'</div>';
		} else {
			$output = '<div class="pricing-table-label-row">' . do_shortcode($content) .'</div>';
		}
		
		return $output;
	}
	add_shortcode('lpt_row_label', 'sf_lpt_row_label');
	
	function sf_lpt_row( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"alt" 			=> "",
		), $atts));
		
		if ($alt == "yes") {
			$output = '<div class="pricing-table-row alt-row">' . do_shortcode($content) .'</div>';
		} else {
			$output = '<div class="pricing-table-row">' . do_shortcode($content) .'</div>';
		}
				
		return $output;
	}
	add_shortcode('lpt_row', 'sf_lpt_row');
			
	function sf_lpt_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"link" 			=> "#",
			"target"		=> '_self'
		), $atts));
			
		$output = '<div class="lpt-button-wrap">'.do_shortcode('[sf_button link="'.$link.'" target="'.$target.'" type="standard" colour="accent"]' . $content .'[/sf_button]</div>');
		
		return $output;
	}
	add_shortcode('lpt_button', 'sf_lpt_button');
	

	/* TYPOGRAPHY SHORTCODES
	================================================= */

	// Highlight Text
	function sf_highlighted($atts, $content = null) {
	   return '<span class="highlighted">'. do_shortcode($content) .'</span>';
	}
	add_shortcode("highlight", "sf_highlighted");
	
	// Decorative Ampersand
	function sf_decorative_ampersand($atts, $content = null) {
	   return '<span class="decorative-ampersand">&</span>';
	}
	add_shortcode("decorative_ampersand", "sf_decorative_ampersand");

	// Dropcap type 1
	function sf_dropcap1($atts, $content = null) {
		return '<span class="dropcap1">'. do_shortcode($content) .'</span>';
	}
	add_shortcode("dropcap1", "sf_dropcap1");
	
	// Dropcap type 2
	function sf_dropcap2($atts, $content = null) {
		return '<span class="dropcap2">'. do_shortcode($content) .'</span>';
	}
	add_shortcode("dropcap2", "sf_dropcap2");
	
	// Dropcap type 3
	function sf_dropcap3($atts, $content = null) {
		return '<span class="dropcap3">'. do_shortcode($content) .'</span>';
	}
	add_shortcode("dropcap3", "sf_dropcap3");
	
	// Dropcap type 4
	function sf_dropcap4($atts, $content = null) {
		return '<span class="dropcap4">'. do_shortcode($content) .'</span>';
	}
	add_shortcode("dropcap4", "sf_dropcap4");
	
	// Blockquote type 1
	function sf_blockquote1($atts, $content = null) {
		return '<blockquote class="blockquote1">'. do_shortcode($content) .'</blockquote>';
	}
	add_shortcode("blockquote1", "sf_blockquote1");

	// Blockquote type 2
	function sf_blockquote2($atts, $content = null) {
		return '<blockquote class="blockquote2">'. do_shortcode($content) .'</blockquote>';
	}
	add_shortcode("blockquote2", "sf_blockquote2");
	
	// Blockquote type 3
	function sf_blockquote3($atts, $content = null) {
		return '<blockquote class="blockquote3">'. do_shortcode($content) .'</blockquote>';
	}
	add_shortcode("blockquote3", "sf_blockquote3");
	
	// Blockquote type 4
	function sf_pullquote($atts, $content = null) {
		return '<blockquote class="pullquote">'. do_shortcode($content) .'</blockquote>';
	}
	add_shortcode("pullquote", "sf_pullquote");
		
	
	/* LISTS SHORTCODES
	================================================= */
	
	function sf_list( $atts, $content = null ) {
		$output = '<ul class="sf-list">' . do_shortcode($content) .'</ul>';		
		return $output;		
	}
	add_shortcode('list', 'sf_list');
	
	function sf_list_item( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"icon" => ''
		), $atts));
		$output = '<li><i class="'.$icon.'"></i><span>' . do_shortcode($content) .'</span></li>';		
		return $output;		
	}
	add_shortcode('list_item', 'sf_list_item');
		

	/* DIVIDER SHORTCODE
	================================================= */

	function sf_horizontal_break($atts, $content = null) {
	   return '<div class="horizontal-break"> </div>';
	}
	add_shortcode("hr", "sf_horizontal_break");


	/* SOCIAL SHORTCODE
	================================================= */
	if (!function_exists('sf_social_icons')) {
		function sf_social_icons($atts, $content = null) {
			extract(shortcode_atts(array(
			   "type" => '',
			   "size" => 'standard',
			   "style" => ''
			), $atts));
			
			$options = get_option('sf_dante_options');
	
			$twitter = $options['twitter_username'];
			$facebook = $options['facebook_page_url'];
			$dribbble = $options['dribbble_username'];
			$vimeo = $options['vimeo_username'];
			$tumblr = $options['tumblr_username'];
			$skype = $options['skype_username'];
			$linkedin = $options['linkedin_page_url'];
			$googleplus = $options['googleplus_page_url'];
			$flickr = $options['flickr_page_url'];
			$youtube = $options['youtube_url'];
			$pinterest = $options['pinterest_username'];
			$foursquare = $options['foursquare_url'];
			$instagram = $options['instagram_username'];
			$github = $options['github_url'];
			$xing = $options['xing_url'];
			$rss = $options['rss_url'];
			$behance = $options['behance_url'];
			$soundcloud = $options['soundcloud_url'];
			$deviantart = $options['deviantart_url'];
			
			$social_icons = '';
			
			if ($type == '') {
				if ($twitter) {
					$social_icons .= '<li class="twitter"><a href="http://www.twitter.com/'.$twitter.'" target="_blank"><i class="fa-twitter"></i><i class="fa-twitter"></i></a></li>'."\n";
				}
				if ($facebook) {
					$social_icons .= '<li class="facebook"><a href="'.$facebook.'" target="_blank"><i class="fa-facebook"></i><i class="fa-facebook"></i></a></li>'."\n";
				}
				if ($dribbble) {
					$social_icons .= '<li class="dribbble"><a href="http://www.dribbble.com/'.$dribbble.'" target="_blank"><i class="fa-dribbble"></i><i class="fa-dribbble"></i></a></li>'."\n";
				}
				if ($youtube) {
					$social_icons .= '<li class="youtube"><a href="'.$youtube.'" target="_blank"><i class="fa-youtube"></i><i class="fa-youtube"></i></a></li>'."\n";
				}	
				if ($vimeo) {
					$social_icons .= '<li class="vimeo"><a href="http://www.vimeo.com/'.$vimeo.'" target="_blank"><i class="fa-vimeo-square"></i><i class="fa-vimeo-square"></i></a></li>'."\n";
				}
				if ($tumblr) {
					$social_icons .= '<li class="tumblr"><a href="http://'.$tumblr.'.tumblr.com/" target="_blank"><i class="fa-tumblr"></i><i class="fa-tumblr"></i></a></li>'."\n";
				}
				if ($skype) {
					$social_icons .= '<li class="skype"><a href="skype:'.$skype.'" target="_blank"><i class="fa-skype"></i><i class="fa-skype"></i></a></li>'."\n";
				}
				if ($linkedin) {
					$social_icons .= '<li class="linkedin"><a href="'.$linkedin.'" target="_blank"><i class="fa-linkedin"></i><i class="fa-linkedin"></i></a></li>'."\n";
				}
				if ($googleplus) {
					$social_icons .= '<li class="googleplus"><a href="'.$googleplus.'" target="_blank"><i class="fa-google-plus"></i><i class="fa-google-plus"></i></a></li>'."\n";
				}
				if ($flickr) {
					$social_icons .= '<li class="flickr"><a href="'.$flickr.'" target="_blank"><i class="fa-flickr"></i><i class="fa-flickr"></i></a></li>'."\n";
				}
				if ($pinterest) {
					$social_icons .= '<li class="pinterest"><a href="http://www.pinterest.com/'.$pinterest.'/" target="_blank"><i class="fa-pinterest"></i><i class="fa-pinterest"></i></a></li>'."\n";
				}
				if ($foursquare) {
					$social_icons .= '<li class="foursquare"><a href="'.$foursquare.'" target="_blank"><i class="fa-foursquare"></i><i class="fa-foursquare"></i></a></li>'."\n";
				}
				if ($instagram) {
					$social_icons .= '<li class="instagram"><a href="http://instagram.com/'.$instagram.'" target="_blank"><i class="fa-instagram"></i><i class="fa-instagram"></i></a></li>'."\n";
				}
				if ($github) {
					$social_icons .= '<li class="github"><a href="'.$github.'" target="_blank"><i class="fa-github"></i><i class="fa-github"></i></a></li>'."\n";
				}
				if ($xing) {
					$social_icons .= '<li class="xing"><a href="'.$xing.'" target="_blank"><i class="fa-xing"></i><i class="fa-xing"></i></a></li>'."\n";
				}
				if ($behance) {
					$social_icons .= '<li class="behance"><a href="'.$behance.'" target="_blank"><i class="fa-behance"></i><i class="fa-behance"></i></a></li>'."\n";
				}
				if ($deviantart) {
					$social_icons .= '<li class="deviantart"><a href="'.$deviantart.'" target="_blank"><i class="fa-deviantart"></i><i class="fa-deviantart"></i></a></li>'."\n";
				}
				if ($soundcloud) {
					$social_icons .= '<li class="soundcloud"><a href="'.$soundcloud.'" target="_blank"><i class="fa-soundcloud"></i><i class="fa-soundcloud"></i></a></li>'."\n";
				}
				if ($rss) {
					$social_icons .= '<li class="rss"><a href="'.$rss.'" target="_blank"><i class="fa-rss"></i><i class="fa-rss"></i></a></li>'."\n";
				}
			} else {
			
				$social_type = explode(',', $type);
				foreach ($social_type as $id) {
					if ($id == "twitter") {
						$social_icons .= '<li class="twitter"><a href="http://www.twitter.com/'.$twitter.'" target="_blank"><i class="fa-twitter"></i><i class="fa-twitter"></i></a></li>'."\n";
					}
					if ($id == "facebook") {
						$social_icons .= '<li class="facebook"><a href="'.$facebook.'" target="_blank"><i class="fa-facebook"></i><i class="fa-facebook"></i></a></li>'."\n";
					}
					if ($id == "dribbble") {
						$social_icons .= '<li class="dribbble"><a href="http://www.dribbble.com/'.$dribbble.'" target="_blank"><i class="fa-dribbble"></i><i class="fa-dribbble"></i></a></li>'."\n";
					}
					if ($id == "youtube") {
						$social_icons .= '<li class="youtube"><a href="'.$youtube.'" target="_blank"><i class="fa-youtube"></i><i class="fa-youtube"></i></a></li>'."\n";
					}
					if ($id == "vimeo") {
						$social_icons .= '<li class="vimeo"><a href="http://www.vimeo.com/'.$vimeo.'" target="_blank"><i class="fa-vimeo-square"></i><i class="fa-vimeo-square"></i></a></li>'."\n";
					}
					if ($id == "tumblr") {
						$social_icons .= '<li class="tumblr"><a href="http://'.$tumblr.'.tumblr.com/" target="_blank"><i class="fa-tumblr"></i><i class="fa-tumblr"></i></a></li>'."\n";
					}
					if ($id == "skype") {
						$social_icons .= '<li class="skype"><a href="skype:'.$skype.'" target="_blank"><i class="fa-skype"></i><i class="fa-skype"></i></a></li>'."\n";
					}
					if ($id == "linkedin") {
						$social_icons .= '<li class="linkedin"><a href="'.$linkedin.'" target="_blank"><i class="fa-linkedin"></i><i class="fa-linkedin"></i></a></li>'."\n";
					}
					if ($id == "googleplus" || $id == "google-plus" || $id == "google+") {
						$social_icons .= '<li class="googleplus"><a href="'.$googleplus.'" target="_blank"><i class="fa-google-plus"></i><i class="fa-google-plus"></i></a></li>'."\n";
					}
					if ($id == "flickr") {
						$social_icons .= '<li class="flickr"><a href="'.$flickr.'" target="_blank"><i class="fa-flickr"></i><i class="fa-flickr"></i></a></li>'."\n";
					}
					if ($id == "pinterest") {
						$social_icons .= '<li class="pinterest"><a href="http://www.pinterest.com/'.$pinterest.'/" target="_blank"><i class="fa-pinterest"></i><i class="fa-pinterest"></i></a></li>'."\n";
					}
					if ($id == "foursquare") {
						$social_icons .= '<li class="foursquare"><a href="'.$foursquare.'" target="_blank"><i class="fa-foursquare"></i><i class="fa-foursquare"></i></a></li>'."\n";
					}
					if ($id == "instagram") {
						$social_icons .= '<li class="instagram"><a href="http://instagram.com/'.$instagram.'" target="_blank"><i class="fa-instagram"></i><i class="fa-instagram"></i></a></li>'."\n";
					}
					if ($id == "github") {
						$social_icons .= '<li class="github"><a href="'.$github.'" target="_blank"><i class="fa-github"></i><i class="fa-github"></i></a></li>'."\n";
					}
					if ($id == "xing") {
						$social_icons .= '<li class="xing"><a href="'.$xing.'" target="_blank"><i class="fa-xing"></i><i class="fa-xing"></i></a></li>'."\n";
					}
					if ($id == "behance") {
						$social_icons .= '<li class="behance"><a href="'.$behance.'" target="_blank"><i class="fa-behance"></i><i class="fa-behance"></i></a></li>'."\n";
					}
					if ($id == "deviantart") {
						$social_icons .= '<li class="deviantart"><a href="'.$deviantart.'" target="_blank"><i class="fa-deviantart"></i><i class="fa-deviantart"></i></a></li>'."\n";
					}
					if ($id == "soundcloud") {
						$social_icons .= '<li class="soundcloud"><a href="'.$soundcloud.'" target="_blank"><i class="fa-soundcloud"></i><i class="fa-soundcloud"></i></a></li>'."\n";
					}
					if ($id == "rss") {
						$social_icons .= '<li class="rss"><a href="'.$rss.'" target="_blank"><i class="fa-rss"></i><i class="fa-rss"></i></a></li>'."\n";
					}
				}
			}
			
			$output = '<ul class="social-icons '.$size.' '.$style.'">'."\n";
			$output .= $social_icons;
			$output .= '</ul>'."\n";
			
			return $output;
		}
		add_shortcode("social", "sf_social_icons");
	}
	
	
	/* SITEMAP SHORTCODE
	================================================= */
	
	function sf_sitemap($params = array()) {  
	    // default parameters  
	    extract(shortcode_atts(array(  
	        'title' => 'Site map',  
	        'id' => 'sitemap',  
	        'depth' => 2  
	    ), $params));  
	    // create sitemap
	    
	    $sitemap = '<div class="sitemap-wrap clearfix">';
	    
	        $sitemap .= '<div class="sitemap-col">';
	            
	            $sitemap .= '<h3>'.__("Pages", "swiftframework").'</h3>';
	              
	            $page_list = wp_list_pages("title_li=&depth=$depth&sort_column=menu_order&echo=0");  
	            if ($page_list != '') {  
	                $sitemap .= '<ul>'.$page_list.'</ul>';  
	            }
	        
	        $sitemap .= '</div>';
	        
	        $sitemap .= '<div class="sitemap-col">';
	        	
	        	$sitemap .= '<h3>'.__("Posts", "swiftframework").'</h3>';
	        	  
	        	$post_list = wp_get_archives('type=postbypost&limit=20&echo=0');
	        	if ($post_list != '') {  
	        	    $sitemap .= '<ul>'.$post_list.'</ul>';  
	        	}	  	
	        	
	        $sitemap .= '</div>';
	        	
	    	$sitemap .= '<div class="sitemap-col">';
	        	
	        	$sitemap .= '<h3>'.__("Categories", "swiftframework").'</h3>';
	        	  
	        	$category_list = wp_list_categories('sort_column=name&title_li=&depth=1&number=10&echo=0');
	        	if ($category_list != '') {  
	        	    $sitemap .= '<ul>'.$category_list.'</ul>';  
	        	}		
	        	
	        	$sitemap .= '<h3>'.__("Archives", "swiftframework").'</h3>';
	        	  
	        	$archive_list =  wp_get_archives('type=monthly&limit=12&echo=0');
	        	if ($archive_list != '') {  
	        	    $sitemap .= '<ul>'.$archive_list.'</ul>';  
	        	}
	        	
	    	$sitemap .= '</div>';
	    	
	    $sitemap .= '</div>';
	    
	    return $sitemap;  
	    
	}  
	add_shortcode('sf_sitemap', 'sf_sitemap');  
	
	
	/* SERVICES PROGRESS BAR SHORTCODE
	================================================= */
	
	function sf_progress_bar($atts) {
		extract(shortcode_atts(array(
			"percentage" => '',
			"name" => '',
			"type" => '',
			"value" => '',
			"colour" => ''
		), $atts));
		
		if ($type == "") { $type = "standard"; }
		
		$service_bar_output = '';
		
		$service_bar_output .= '<div class="progress-bar-wrap progress-'.$type.'">'. "\n";
		if ($colour != "") {
		$service_bar_output .= '<div class="bar-text"><span class="bar-name">'.$name.':</span> <span class="progress-value" style="color:'.$colour.'!important;">'.$value.'</span></div>'. "\n";
		$service_bar_output .= '<div class="progress '.$type.'">'. "\n";
		$service_bar_output .= '<div class="bar" data-value="'.$percentage.'" style="background-color:'.$colour.'!important;">'. "\n";
		} else {
		$service_bar_output .= '<div class="bar-text"><span class="bar-name">'.$name.':</span> <span class="progress-value">'.$value.'</span></div>'. "\n";
		$service_bar_output .= '<div class="progress '.$type.'">'. "\n";
		$service_bar_output .= '<div class="bar" data-value="'.$percentage.'">'. "\n";		
		}
		$service_bar_output .= '</div>'. "\n";
		$service_bar_output .= '</div>'. "\n";
		$service_bar_output .= '</div>'. "\n";
		
		global $sf_has_progress_bar;
		$sf_has_progress_bar = true;
		
		return $service_bar_output;
	}
	
	add_shortcode('progress_bar', 'sf_progress_bar');
	
	
	/* CHART SHORTCODE
	================================================= */
	
	function sf_chart($atts) {
		extract(shortcode_atts(array(
			"percentage" => '50',
			"size" => '70',
			"barcolour" => '',
			"trackcolour" => '',
			"content" => '',
			"align" => ''
		), $atts));
		
		$chart_output = $linewidth = '';
				
		if ($barcolour == "") { $barcolour = get_option('accent_color', '#fb3c2d'); }
		if ($trackcolour == "") { $trackcolour = '#f2f2f2'; }
		
		if ($size == "70") { $linewidth = "5"; }
		if ($size == "170") { $linewidth = "5"; }
		
		$chart_output .= '<div class="chart-shortcode chart-'.$size.' chart-'.$align.'" data-linewidth="'.$linewidth.'" data-percent="0" data-animatepercent="'.$percentage.'" data-size="'.$size.'" data-barcolor="'.$barcolour.'" data-trackcolor="'.$trackcolour.'">';
		if ($content != "") {
			if (strpos($content, 'fa-') !== false || strpos($content, 'ss-') !== false) {
			    $chart_output .= '<span><i class="'.$content.'"></i></span>';
			} else {
			$chart_output .= '<span>'.$content.'</span>';
			}
		}
		$chart_output .= '</div>';
		
		global $sf_has_chart;
		$sf_has_chart = true;
		
		return $chart_output;
	}
	
	add_shortcode('chart', 'sf_chart');
	
	
	/* TOOLTIP SHORTCODE
	================================================= */
	
	function sf_tooltip($atts, $content = null) {
		extract(shortcode_atts(array(
			"title" => '',
			"link" => '#',
			"direction" => 'top'
		), $atts));
				
		$tooltip_output = '<a href="'.$link.'" rel="tooltip" data-original-title="'.$title.'" data-placement="'.$direction.'">'.do_shortcode($content).'</a>';

		return $tooltip_output;
	}
	
	add_shortcode('sf_tooltip', 'sf_tooltip');
	
	
	/* MODAL SHORTCODE
	================================================= */
	
	function sf_modal($atts, $content = null) {
		extract(shortcode_atts(array(
			"header" => '',
			"btn_type" => '',
			"btn_colour" => '',
			"btn_size" => '',
			"btn_icon" => '',
			"btn_text" => ''
		), $atts));
		
		global $sf_modalCount;
		
		if ($sf_modalCount >= 0) {
			$sf_modalCount++;
		} else {
			$sf_modalCount = 0;
		}
		
		$modal_output = "";
		
		$button_class = 'sf-button '.$btn_size.' '. $btn_colour .' '. $btn_type;
		
		if ($btn_type == "sf-icon-reveal" || $btn_type == "sf-icon-stroke") {
			$modal_output .= '<a class="'.$button_class.'" href="#modal-'.$sf_modalCount.'" role="button" data-toggle="modal">';
			$modal_output .= '<i class="'.$btn_icon.'"></i>';
			$modal_output .= '<span class="text">'. $btn_text .'</span>';
			$modal_output .= '</a>';
		} else {
			$modal_output .= '<a class="'.$button_class.'" href="#modal-'.$sf_modalCount.'" role="button" data-toggle="modal"><span class="text">' . $btn_text . '</span></a>';
		}
		
		$modal_output .= '<div id="modal-'.$sf_modalCount.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="'.$header.'" aria-hidden="true">';
		$modal_output .= '<div class="modal-dialog">';
		$modal_output .= '<div class="modal-content">';
		$modal_output .= '<div class="modal-header">';
		$modal_output .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="ss-delete"></i></button>';
		$modal_output .= '<h3 id="modal-label">'.$header.'</h3>';
		$modal_output .= '</div>';
		$modal_output .= '<div class="modal-body">'.do_shortcode($content).'</div>';
		$modal_output .= '</div>';
		$modal_output .= '</div>';
		$modal_output .= '</div>';
			
		return $modal_output;
	}
	
	add_shortcode('sf_modal', 'sf_modal');	
	
	
	/* FULLSCREEN VIDEO SHORTCODE
	================================================= */
	
	function sf_fullscreen_video($atts, $content = null) {
		extract(shortcode_atts(array(
			"type" => '',
			"imageurl" => '',
			"btntext" => '',
			"videourl" => '',
			"extraclass" => ''
		), $atts));
		
		$fw_video_output = "";
		
		$video_embed_url = sf_get_embed_src($videourl);
		
		if ($type == "image-button") {
			
			$fw_video_output .= '<a href="#" class="fw-video-link fw-video-link-image '.$extraclass.'" data-video="'.$video_embed_url.'">';
			
			$fw_video_output .= '<i class="ss-play"></i>';
			
			$fw_video_output .= '<img src="'.$imageurl.'" alt="'.$btntext.'" />';
			
			$fw_video_output .= '</a>';
					
		} else if ($type == "text-button") {
			
			$fw_video_output .= '<a href="#" class="fw-video-link fw-video-link-text sf-button sf-icon-stroke accent '.$extraclass.'" data-video="'.$video_embed_url.'">';
			
			$fw_video_output .= '<i class="ss-play"></i>';
			$fw_video_output .= '<span class="text">'.$btntext.'</span>';
			
			$fw_video_output .= '</a>';
			
		} else {
			
			$fw_video_output .= '<a href="#" class="fw-video-link fw-video-link-icon '.$extraclass.'" data-video="'.$video_embed_url.'">';
			
			$fw_video_output .= '<i class="ss-play"></i>';
			
			$fw_video_output .= '</a>';
		}

		return $fw_video_output;
	}
	
	add_shortcode('sf_fullscreenvideo', 'sf_fullscreen_video');
	
	
	/* RESPONSIVE VISIBILITY SHORTCODE
	================================================= */
	
	function sf_visibility($atts, $content = null) {
		extract(shortcode_atts(array(
			"class" => ''
		), $atts));
				
		$visibility_output = '<div class="'.$class.'">'.do_shortcode($content).'</div>';

		return $visibility_output;
	}
	
	add_shortcode('sf_visibility', 'sf_visibility');
	

	/* YEAR SHORTCODE
	================================================= */

	function sf_year_shortcode() {
		$year = date('Y');
		return $year;
	}

	add_shortcode('the-year', 'sf_year_shortcode');


	/* WORDPRESS LINK SHORTCODE
	================================================= */

	function sf_wordpress_link() {
		return '<a href="http://wordpress.org/" target="_blank">WordPress</a>';
	}

	add_shortcode('wp-link', 'sf_wordpress_link');
	
	
	/* COUNT SHORTCODE
	================================================= */
	
	function sf_count($atts) {
		extract(shortcode_atts(array(
			"speed" => '2000',
			"refresh" => '25',
			"from" => '0',
			"to" => '',
			"prefix" => '',
			"suffix" => '',
			"commas" => 'false',
			"subject" => '',
			"textstyle" => ''
		), $atts));
		
		$count_output = '';
		
		if ($speed == "") {$speed = '2000'; }
		if ($refresh == "") {$refresh = '25'; }
				
		$count_output .= '<div class="sf-count-asset">';		
		$count_output .= '<div class="count-number" data-from="'.$from.'" data-to="'.$to.'" data-speed="'.$speed.'" data-refresh-interval="'.$refresh.'" data-prefix="'.$prefix.'" data-suffix="'.$suffix.'" data-with-commas="'.$commas.'"></div>';
		$count_output .= '<div class="count-divider"><span></span></div>';
		if ($textstyle == "h3") {
		$count_output .= '<h3 class="count-subject">'.$subject.'</h3>';		
		} else if ($textstyle == "h6") {
		$count_output .= '<h6 class="count-subject">'.$subject.'</h6>';		
		} else {
		$count_output .= '<div class="count-subject">'.$subject.'</div>';
		}
		$count_output .= '</div>';
		
		return $count_output;
	}
	
	add_shortcode('sf_count', 'sf_count');
	
	
	/* COUNTDOWN SHORTCODE
	================================================= */
	
	function sf_countdown($atts) {
		extract(shortcode_atts(array(
			"year" => '',
			"month" => '',
			"day" => '',
			"hour" => '0',
			"type" => 'countdown',
			"fontsize" => 'large',
			"displaytext" => ''
		), $atts));
		
		$countdown_output = '';
				
		$countdown_output .= '<div class="sf-countdown text-'.$fontsize.'" data-year="'.$year.'" data-month="'.$month.'" data-day="'.$day.'" data-hour="'.$hour.'" data-type="'.$type.'"></div>';
		if ($displaytext != "") {
		$countdown_output .= '<h3 class="countdown-subject">'.$displaytext.'</h3>';
		}
		
		global $sf_has_countdown;
		$sf_has_countdown = true;
		
		return $countdown_output;
	}
	
	add_shortcode('sf_countdown', 'sf_countdown');
	
	
	/* SOCIAL SHARE SHORTCODE
	================================================= */

	function sf_social_share() {
		
		global $post;
		
		$title = get_the_title();
		$permalink = get_permalink();
		$image = wp_get_attachment_url(get_post_thumbnail_id());
		$excerpt = strip_tags(get_the_excerpt());
		
		$share_output = "";
		
		$share_output .= '<div class="share-links curved-bar-styling clearfix">';
		$share_output .= '<div class="share-text">'.__("Share this:", "swiftframework").'</div>';
		$share_output .= '<ul class="social-icons">';
		$share_output .= '<li class="facebook"><a href="http://www.facebook.com/sharer.php?u='.$permalink.'" class="post_share_facebook" onclick="javascript:window.open(this.href,
			      \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600\');return false;"><i class="fa-facebook"></i><i class="fa-facebook"></i></a></li>';
		$share_output .= '<li class="twitter"><a href="https://twitter.com/share?url='.$permalink.'" onclick="javascript:window.open(this.href,
			      \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600\');return false;" class="product_share_twitter"><i class="fa-twitter"></i><i class="fa-twitter"></i></a></li>  '; 
		$share_output .= '<li class="googleplus"><a href="https://plus.google.com/share?url='.$permalink.'" onclick="javascript:window.open(this.href,
			      \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;"><i class="fa-google-plus"></i><i class="fa-google-plus"></i></a></li>';
		$share_output .= '<li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url='.$permalink.'&media='.$image.'&description='.$title.'" onclick="javascript:window.open(this.href,
		  \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=320,width=600\');return false;"><i class="fa-pinterest"></i><i class="fa-pinterest"></i></a></li>';
		$share_output .= '<li class="mail"><a href="mailto:?subject='.urlencode($title).'&body='.$excerpt.' '.$permalink.'" class="product_share_email"><i class="ss-mail"></i><i class="ss-mail"></i></a></li>';
		$share_output .= '</ul>';			
		$share_output .= '</div>';
			
		return $share_output;
	}

	add_shortcode('sf_social_share', 'sf_social_share');
	
	
	/* SWIFT SUPER SEARCH SHORTCODE
	================================================= */
	
	function sf_supersearch() {
	
		return sf_super_search();
		
	}
	add_shortcode('sf_supersearch', 'sf_supersearch');
	
	
	/* EMAIL ENCODE SHORTCODE
	================================================== */
	function sf_email_encode_function( $atts, $content ){
	    return '<a href="'.antispambot("mailto:".$content).'">'.antispambot($content).'</a>';
	}
	add_shortcode( 'email', 'sf_email_encode_function' );
	
	
	/* SWIFT GALLERY SHORTCODE
	================================================= */
	
	$options = get_option('sf_dante_options');
	$disable_sfgallery = false;
	if (isset($options['disable_sfgallery']) && $options['disable_sfgallery'] == 1) {
	$disable_sfgallery = true;
	}
	
	if (!$disable_sfgallery) {
	// Remove built in shortcode
	remove_shortcode('gallery', 'gallery_shortcode');
	
	// Replace with custom shortcode
	function sf_gallery($attr) {
		$post = get_post();
		
		static $instance = 0;
		$instance++;
		
		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) ) {
				$attr['orderby'] = 'post__in';
				$attr['include'] = $attr['ids'];
			}	
		}
		
		// Allow plugins/themes to override the default gallery template.
		$output = apply_filters('post_gallery', '', $attr);
		if ( $output != '' ) {
			return $output;
		}
		
		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
		}
		
		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'size'       => 'large',
			'include'    => '',
			'exclude'    => ''
		), $attr, 'gallery'));
		
		$id = intval($id);
		if ( 'RAND' == $order ) {
			$orderby = 'none';
		}
		
		if ( !empty($include) ) {
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
		
		if ( empty($attachments) ) {
			return '';
		}
		
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}
		
		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$icontag = tag_escape($icontag);
		$valid_tags = wp_kses_allowed_html( 'post' );
		if ( ! isset( $valid_tags[ $itemtag ] ) ) {
			$itemtag = 'dl';
		}
		if ( ! isset( $valid_tags[ $captiontag ] ) ) {
			$captiontag = 'dd';
		}
		if ( ! isset( $valid_tags[ $icontag ] ) ) {
			$icontag = 'dt';
		}
		
		$columns = intval($columns);
		$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
		$float = is_rtl() ? 'right' : 'left';
		
		$selector = "gallery-{$instance}";
		
		$gallery_style = '';
		$size_class = sanitize_html_class( $size );
		$output = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
		
		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
		
			$image_output = '<figure class="animated-overlay">';

			$image_file_url = wp_get_attachment_image_src( $id, $size );
			$image_file_lightbox_url = wp_get_attachment_url( $id, "full" );
			$image_caption = wptexturize($attachment->post_excerpt);
			$image_meta  = wp_get_attachment_metadata( $id ); 
			$image_alt = sf_get_post_meta($id, '_wp_attachment_image_alt', true);
			
			$image_output .= '<img src="'.$image_file_url[0].'" alt="'.$image_alt.'" />';
			
			if ( ! empty( $attr['link'] ) && 'file' === $attr['link'] ) {
				$image_output .= '<a href="'.$image_file_lightbox_url.'" class="lightbox" data-rel="ilightbox['.$selector.']" title="'.$image_alt.'"></a>';
			} elseif ( ! empty( $attr['link'] ) && 'none' === $attr['link'] ) {
			} else {
				$image_output .= '<a href="'.get_attachment_link( $id ).'"></a>';
			}

			if ($captiontag && trim($attachment->post_excerpt) && $columns <= 3) {
			$image_output .= '<figcaption><div class="thumb-info">';						
			$image_output .= '<h4 itemprop="name headline">'.wptexturize($attachment->post_excerpt).'</h4>';
			} else {
			$image_output .= '<figcaption><div class="thumb-info thumb-info-alt">';									
			}			
			
			$image_output .= '<i class="ss-search"></i>';
			$image_output .= '</div></figcaption>';			
			$image_output .= '</figure>';
									
			$orientation = '';
			if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
				$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
			}
			
			$output .= "<{$itemtag} class='gallery-item'>";
			$output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
			$image_output
			</{$icontag}>";
			$output .= "</{$itemtag}>";
		}
		
		$output .= "
		<br style='clear: both;' />
		</div>\n";
		
		return $output;
	}
	add_shortcode('gallery', 'sf_gallery');
	}
?>