<?php
	
	/* ALERT SHORTCODES
	================================================== */

	function sf_alert( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"type"			=> "info"
		), $atts));
	   return '<div class="alert '. $type .'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('alert', 'sf_alert');


	/* BUTTON SHORTCODES
	================================================== */
	
	function sf_button($atts, $content = null) {
		extract(shortcode_atts(array(
			"size"			=> "standard",
			"colour"		=> "",
			"type"			=> "",
			"link" 			=> "#",
			"target"		=> '_self',
			"extra_class"   => ''
		), $atts));
		
		if (($type == "squarearrow") || ($type == "slightlyroundedarrow") || ($type == "roundedarrow")) {
			return '<a class="sf-button '.$size.' '. $colour .' '. $type .' '. $extra_class .'" href="'.$link.'" target="'.$target.'"><span>' . do_shortcode($content) . '</span><span class="arrow"></span></a>';
		} else {
			return '<a class="sf-button '.$size.' '. $colour .' '. $type .' '. $extra_class .'" href="'.$link.'" target="'.$target.'"><span>' . do_shortcode($content) . '</span></a>';
		}
	}
	add_shortcode('button', 'sf_button');
	
	
	/* ICON SHORTCODES
	================================================== */
		
	function sf_icon($atts, $content = null) {
		extract(shortcode_atts(array(
			"size"			=> "",
			"image"			=> "",
			"cont" 			=> "",
			"float" 		=> ""
		), $atts));
		
		if ($cont == "yes") {
			return '<div class="sf-icon-cont cont-'.$size.' sf-icon-float-'.$float.'"><i class="icon-'.$image.' sf-icon icon-'.$size.'"></i></div>';
		} else {
			return '<i class="icon-'.$image.' sf-icon sf-icon-float-'.$float.' icon-'.$size.'"></i>';	
		}		
	}
	add_shortcode('icon', 'sf_icon');
	

	/* COLUMN SHORTCODES
	================================================== */

	function one_third( $atts, $content = null ) {
	   return '<div class="one_third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_third', 'one_third');

	function one_third_last( $atts, $content = null ) {
	   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_third_last', 'one_third_last');

	function two_third( $atts, $content = null ) {
	   return '<div class="two_third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_third', 'two_third');

	function two_third_last( $atts, $content = null ) {
	   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_third_last', 'two_third_last');

	function one_half( $atts, $content = null ) {
	   return '<div class="one_half">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_half', 'one_half');

	function one_half_last( $atts, $content = null ) {
	   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_half_last', 'one_half_last');

	function one_fourth( $atts, $content = null ) {
	   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'one_fourth');

	function one_fourth_last( $atts, $content = null ) {
	   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fourth_last', 'one_fourth_last');

	function three_fourth( $atts, $content = null ) {
	   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fourth', 'three_fourth');

	function three_fourth_last( $atts, $content = null ) {
	   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fourth_last', 'three_fourth_last');


	/* PERSON SHORTCODE
	================================================= */

	function person_widget($atts, $content = null) {
		extract(shortcode_atts(array(
			"name" => '',
			"role" => '',
			"src" => ''
		), $atts));

	   $person_html = '<div class="person-widget">';
	   if ($src != '') {
	   		$person_html = $person_html . '<figure class="author-img"><img src="'.$src.'" alt="'.$name.'"/></figure>';
	   }
	   $person_html = $person_html .'<h4>'.$name.'</h4><p class="role">'.$role.'</p><p>' . do_shortcode($content) . '</p></div>';
	   		
	   	return $person_html;
	}
	add_shortcode("person", "person_widget");

	function person_widget_last($atts, $content = null) {
		extract(shortcode_atts(array(
			"name" => '',
			"role" => '',
			"src" => ''
		), $atts));

	   $person_html = '<div class="person-widget">';
	   if ($src != '') {
	   		$person_html = $person_html . '<figure class="author-img"><img src="'.$src.'" alt="'.$name.'"/></figure>';
	   }
	   $person_html = $person_html .'<h4>'.$name.'</h4><p class="role">'.$role.'</p><p>' . do_shortcode($content) . '</p></div><div class="clearboth"></div>';
	   		
	   	return $person_html;
	}
	add_shortcode("person_last", "person_widget_last");


	/* CLIENT SHORTCODE
	================================================= */

	function client_box( $atts, $content = null ) {
	   return '<div class="client-box"><img src="'. do_shortcode($content) .'" /></div>';
	}
	add_shortcode('client_box', 'client_box');

	function client_box_last( $atts, $content = null ) {
	   return '<div class="client-box"><img src="'. do_shortcode($content) .'" /></div><div class="clearboth"></div>';
	}
	add_shortcode('client_box_last', 'client_box_last');


	/* ACCORDION SHORTCODES
	================================================= */

	function accordion_widget($atts, $content = null) {
			
		return '<div class="accordion">'. do_shortcode($content) .'</div>';
	}
	add_shortcode("accordion", "accordion_widget");

	function accordion_panel($atts, $content = null) {
		extract(shortcode_atts(array(
			"title" => ''
		), $atts));

		return '<div class="accordion-header">'.$title.'</div><div class="accordion-body">'. do_shortcode($content) .'</div>';
	}
	add_shortcode("panel", "accordion_panel");


	/* TABS SHORTCODES
	================================================= */

	// Setup a global int variable to enable unique tabbed content identities
	$i = 0;

	function tabbed_asset( $atts, $content = null ) {
		global $i;
		extract(shortcode_atts(array(), $atts));

		$output = '<div class="tabbed-asset">';		
		$output .= '<ul class="tabs">';
		foreach ($atts as $tab) {
			$tab_id = "tab-" . $i++;
			$output .= '<li><a href="#' . $tab_id . '" class="tab">' .$tab. '</a></li>';
		}
		$output .= '<li class="clear"></li></ul>';

		$output .= do_shortcode($content) .'</div>';
		
		return $output;
		
	}
	add_shortcode('tabs', 'tabbed_asset');

	// Setup a global int variable to enable unique tab identities
	$t = 0;

	function tabbed_tab( $atts, $content = null ) {
		global $t;
		extract(shortcode_atts(array(), $atts));
		$tab_id = "tab-" . $t++;
		$output = '<div id="' . $tab_id . '" class="tab-content">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('tab', 'tabbed_tab');
	
	
	/* TABLE SHORTCODES
	================================================= */
	
	function table_wrap( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"type" => ''
		), $atts));

		$output = '<table class="sf-table '.$type.'"><tbody>';
		$output .= do_shortcode($content) .'</tbody></table>';
		
		return $output;
		
	}
	add_shortcode('table', 'table_wrap');
	
	function table_row( $atts, $content = null ) {

		$output = '<tr>';
		$output .= do_shortcode($content) .'</tr>';
		
		return $output;
	}
	add_shortcode('trow', 'table_row');
	
	function table_column( $atts, $content = null ) {
	
		$output = '<td>';
		$output .= do_shortcode($content) .'</td>';
		
		return $output;
	}
	add_shortcode('tcol', 'table_column');

	function table_head( $atts, $content = null ) {

		$output = '<th>';
		$output .= do_shortcode($content) .'</th>';
		
		return $output;
	}
	add_shortcode('thcol', 'table_head');
	
	
	/* PRICING TABLE SHORTCODES
	================================================= */
	
	function pt_wrap( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"type" => '',
			"columns" => ''
		), $atts));

		$output = '<div class="pricing-table-wrap '.$type.' columns-'. $columns .'">' . do_shortcode($content) .'</div>';		
		return $output;
		
	}
	add_shortcode('pricing_table', 'pt_wrap');
	
	function pt_column( $atts, $content = null ) {
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
	add_shortcode('pt_column', 'pt_column');
	
	function pt_price( $atts, $content = null ) {
			
		$output = '<div class="pricing-table-price">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('pt_price', 'pt_price');
	
	function pt_package( $atts, $content = null ) {
			
		$output = '<div class="pricing-table-package">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('pt_package', 'pt_package');
	
	function pt_details( $atts, $content = null ) {
			
		$output = '<div class="pricing-table-details">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('pt_details', 'pt_details');
	
	function pt_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"link" 			=> "#",
			"target"		=> '_self'
		), $atts));
			
		$output = '<br/>'.do_shortcode('[button link="'.$link.'" target="'.$target.'" type="slightlyroundedarrow" colour="accent"]' . $content .'[/button]');
		
		return $output;
	}
	add_shortcode('pt_button', 'pt_button');
	
	
	/* LABELLED PRICING TABLE SHORTCODES
	================================================= */
	
	function lpt_wrap( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"columns" => ''
		), $atts));

		$output = '<div class="pricing-table-wrap labelled-pricing-table columns-'. $columns .'">' . do_shortcode($content) .'</div>';		
		return $output;
		
	}
	add_shortcode('labelled_pricing_table', 'lpt_wrap');
	
	function lpt_label_column( $atts, $content = null ) {
		
		$output = '<div class="pricing-table-column label-column">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('lpt_label_column', 'lpt_label_column');
	
	function lpt_column( $atts, $content = null ) {
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
	add_shortcode('lpt_column', 'lpt_column');
	
	function lpt_price( $atts, $content = null ) {
			
		$output = '<div class="pricing-table-price">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('lpt_price', 'lpt_price');
	
	function lpt_package( $atts, $content = null ) {
			
		$output = '<div class="pricing-table-package">' . do_shortcode($content) .'</div>';
		
		return $output;
	}
	add_shortcode('lpt_package', 'pt_package');
	
	function lpt_row_label( $atts, $content = null ) {
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
	add_shortcode('lpt_row_label', 'lpt_row_label');
	
	function lpt_row( $atts, $content = null ) {
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
	add_shortcode('lpt_row', 'lpt_row');
			
	function lpt_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"link" 			=> "#",
			"target"		=> '_self'
		), $atts));
			
		$output = '<div class="lpt-button-wrap">'.do_shortcode('[button link="'.$link.'" target="'.$target.'" type="slightlyroundedarrow" colour="accent"]' . $content .'[/button]</div>');
		
		return $output;
	}
	add_shortcode('lpt_button', 'lpt_button');
	

	/* TYPOGRAPHY SHORTCODES
	================================================= */

	// Highlight Text
	function highlighted($atts, $content = null) {
	   return '<span class="highlighted">'. do_shortcode($content) .'</span>';
	}
	add_shortcode("highlight", "highlighted");
	
	// Decorative Ampersand
	function decorative_ampersand($atts, $content = null) {
	   return '<span class="decorative-ampersand">&</span>';
	}
	add_shortcode("decorative_ampersand", "decorative_ampersand");

	// Dropcap type 1
	function dropcap1($atts, $content = null) {
		return '<span class="dropcap1">'. do_shortcode($content) .'</span>';
	}
	add_shortcode("dropcap1", "dropcap1");
	
	// Dropcap type 2
	function dropcap2($atts, $content = null) {
		return '<span class="dropcap2">'. do_shortcode($content) .'</span>';
	}
	add_shortcode("dropcap2", "dropcap2");
	
	// Dropcap type 3
	function dropcap3($atts, $content = null) {
		return '<span class="dropcap3">'. do_shortcode($content) .'</span>';
	}
	add_shortcode("dropcap3", "dropcap3");
	
	// Dropcap type 4
	function dropcap4($atts, $content = null) {
		return '<span class="dropcap4">'. do_shortcode($content) .'</span>';
	}
	add_shortcode("dropcap4", "dropcap4");
	
	// Blockquote type 1
	function blockquote1($atts, $content = null) {
		return '<blockquote class="blockquote1">'. do_shortcode($content) .'</blockquote>';
	}
	add_shortcode("blockquote1", "blockquote1");

	// Blockquote type 2
	function blockquote2($atts, $content = null) {
		return '<blockquote class="blockquote2">'. do_shortcode($content) .'</blockquote>';
	}
	add_shortcode("blockquote2", "blockquote2");
	
	// Blockquote type 3
	function blockquote3($atts, $content = null) {
		return '<blockquote class="blockquote3">'. do_shortcode($content) .'</blockquote>';
	}
	add_shortcode("blockquote3", "blockquote3");
	
	// Blockquote type 4
	function pullquote($atts, $content = null) {
		return '<blockquote class="pullquote">'. do_shortcode($content) .'</blockquote>';
	}
	add_shortcode("pullquote", "pullquote");
		
	
	/* LISTS SHORTCODES
	================================================= */
	
	function sf_list( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"type" => ''
		), $atts));

		$output = '<ul class="sf-list list-'.$type.'">' . do_shortcode($content) .'</ul>';		
		return $output;		
	}
	add_shortcode('list', 'sf_list');
	
	function sf_list_item( $atts, $content = null ) {
		$output = '<li>' . do_shortcode($content) .'</li>';		
		return $output;		
	}
	add_shortcode('list_item', 'sf_list_item');
		

	/* DIVIDER SHORTCODE
	================================================= */

	function horizontal_break($atts, $content = null) {
	   return '<div class="horizontal-break"> </div>';
	}
	add_shortcode("hr", "horizontal_break");


	/* MAP SHORTCODE
	================================================= */

	function fn_googleMaps($atts, $content = null) {
	   extract(shortcode_atts(array(
	      "width" => '1170',
	      "height" => '400',
	      "src" => ''
	   ), $atts));
	   return '<div class="map"><iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed&iwloc=near"></iframe></div>';
	}
	add_shortcode("map", "fn_googleMaps");


	/* SOCIAL SHORTCODE
	================================================= */

	function social_icons($atts, $content = null) {
		extract(shortcode_atts(array(
		   "type" => '',
		   "size" => 'standard',
		   "style" => 'colour'
		), $atts));
		
		$options = get_option('sf_flexform_options');

		$twitter = $options['twitter_username'];
		$facebook = $options['facebook_page_url'];
		$dribbble = $options['dribbble_username'];
		$vimeo = $options['vimeo_username'];
		$tumblr = $options['tumblr_username'];
		$spotify = $options['spotify_username'];
		$skype = $options['skype_username'];
		$linkedin = $options['linkedin_page_url'];
		$lastfm = $options['lastfm_username'];
		$googleplus = $options['googleplus_page_url'];
		$flickr = $options['flickr_page_url'];
		$youtube = $options['youtube_username'];
		$behance = $options['behance_username'];
		$pinterest = $options['pinterest_username'];
		$instagram = $options['instagram_username'];
		$yelp = $options['yelp_url'];
		
		$social_icons = '';
		
		if ($type == '') {
		
			if ($twitter) {
				$social_icons .= '<li class="twitter"><a href="http://www.twitter.com/'.$twitter.'" target="_blank">Twitter</a></li>'."\n";
			}
			if ($facebook) {
				$social_icons .= '<li class="facebook"><a href="'.$facebook.'" target="_blank">Facebook</a></li>'."\n";
			}
			if ($dribbble) {
				$social_icons .= '<li class="dribbble"><a href="http://www.dribbble.com/'.$dribbble.'" target="_blank">Dribbble</a></li>'."\n";
			}
			if ($vimeo) {
				$social_icons .= '<li class="vimeo"><a href="http://www.vimeo.com/'.$vimeo.'" target="_blank">Vimeo</a></li>'."\n";
			}
			if ($tumblr) {
				$social_icons .= '<li class="tumblr"><a href="http://'.$tumblr.'.tumblr.com/" target="_blank">Tumblr</a></li>'."\n";
			}
			if ($spotify) {
				$social_icons .= '<li class="spotify"><a href="http://open.spotify.com/user/'.$spotify.'" target="_blank">Spotify</a></li>'."\n";
			}
			if ($skype) {
				$social_icons .= '<li class="skype"><a href="skype:'.$skype.'" target="_blank">Skype</a></li>'."\n";
			}
			if ($linkedin) {
				$social_icons .= '<li class="linkedin"><a href="'.$linkedin.'" target="_blank">LinkedIn</a></li>'."\n";
			}
			if ($lastfm) {
				$social_icons .= '<li class="lastfm"><a href="http://www.last.fm/user/'.$lastfm.'" target="_blank">Last.fm</a></li>'."\n";
			}
			if ($googleplus) {
				$social_icons .= '<li class="googleplus"><a href="'.$googleplus.'" target="_blank">Google+</a></li>'."\n";
			}
			if ($flickr) {
				$social_icons .= '<li class="flickr"><a href="'.$flickr.'" target="_blank">Flickr</a></li>'."\n";
			}
			if ($youtube) {
				$social_icons .= '<li class="youtube"><a href="http://www.youtube.com/user/'.$youtube.'" target="_blank">YouTube</a></li>'."\n";
			}
			if ($behance) {
				$social_icons .= '<li class="behance"><a href="http://www.behance.net/'.$behance.'" target="_blank">Behance</a></li>'."\n";
			}
			if ($pinterest) {
				$social_icons .= '<li class="pinterest"><a href="http://www.pinterest.com/'.$pinterest.'/" target="_blank">Pinterest</a></li>'."\n";
			}
			if ($instagram) {
				$social_icons .= '<li class="instagram"><a href="http://instagram.com/'.$instagram.'" target="_blank">Instagram</a></li>'."\n";
			}
			if ($yelp) {
				$social_icons .= '<li class="yelp"><a href="'.$yelp.'/" target="_blank">Yelp</a></li>'."\n";
			}
		
		} else {
		
			$social_type = explode(',', $type);
			foreach ($social_type as $id) {
				if ($id == "twitter") {
					$social_icons .= '<li class="twitter"><a href="http://www.twitter.com/'.$twitter.'" target="_blank">Twitter</a></li>'."\n";
				}
				if ($id == "facebook") {
					$social_icons .= '<li class="facebook"><a href="'.$facebook.'" target="_blank">Facebook</a></li>'."\n";
				}
				if ($id == "dribbble") {
					$social_icons .= '<li class="dribbble"><a href="http://www.dribbble.com/'.$dribbble.'" target="_blank">Dribbble</a></li>'."\n";
				}
				if ($id == "vimeo") {
					$social_icons .= '<li class="vimeo"><a href="http://www.vimeo.com/'.$vimeo.'" target="_blank">Vimeo</a></li>'."\n";
				}
				if ($id == "tumblr") {
					$social_icons .= '<li class="tumblr"><a href="http://'.$tumblr.'.tumblr.com/" target="_blank">Tumblr</a></li>'."\n";
				}
				if ($id == "spotify") {
					$social_icons .= '<li class="spotify"><a href="http://open.spotify.com/user/'.$spotify.'" target="_blank">Spotify</a></li>'."\n";
				}
				if ($id == "skype") {
					$social_icons .= '<li class="skype"><a href="skype:'.$skype.'" target="_blank">Skype</a></li>'."\n";
				}
				if ($id == "linkedin") {
					$social_icons .= '<li class="linkedin"><a href="'.$linkedin.'" target="_blank">LinkedIn</a></li>'."\n";
				}
				if ($id == "lastfm") {
					$social_icons .= '<li class="lastfm"><a href="http://www.last.fm/user/'.$lastfm.'" target="_blank">Last.fm</a></li>'."\n";
				}
				if ($id == "googleplus") {
					$social_icons .= '<li class="googleplus"><a href="'.$googleplus.'" target="_blank">Google+</a></li>'."\n";
				}
				if ($id == "flickr") {
					$social_icons .= '<li class="flickr"><a href="'.$flickr.'" target="_blank">Flickr</a></li>'."\n";
				}
				if ($id == "youtube") {
					$social_icons .= '<li class="youtube"><a href="http://www.youtube.com/user/'.$youtube.'" target="_blank">YouTube</a></li>'."\n";
				}
				if ($id == "behance") {
					$social_icons .= '<li class="behance"><a href="http://www.behance.net/'.$behance.'" target="_blank">Behance</a></li>'."\n";
				}
				if ($id == "pinterest") {
					$social_icons .= '<li class="pinterest"><a href="http://www.pinterest.com/'.$pinterest.'/" target="_blank">Pinterest</a></li>'."\n";
				}
				if ($id == "instagram") {
					$social_icons .= '<li class="instagram"><a href="http://instagram.com/'.$instagram.'" target="_blank">Instagram</a></li>'."\n";
				}
				if ($id == "yelp") {
					$social_icons .= '<li class="yelp"><a href="'.$yelp.'" target="_blank">Yelp</a></li>'."\n";
				}
			}
		}
		
		$output = '<ul class="social-icons '.$size.' '.$style.'">'."\n";
		$output .= $social_icons;
		$output .= '</ul>'."\n";
		
		return $output;
	}
	add_shortcode("social", "social_icons");
	
	
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
	
	function progress_bar($atts) {
		extract(shortcode_atts(array(
			"percentage" => '',
			"name" => '',
			"type" => '',
			"value" => '',
			"colour" => ''
		), $atts));
		
		if ($type == "") { $type = "standard"; }
		
		$service_bar_output = '';
		
		$service_bar_output .= '<div class="progress '.$type.'">'. "\n";
		if ($colour != "") {
		$service_bar_output .= '<div class="bar" data-value="'.$percentage.'" style="background-color:'.$colour.'!important;">'. "\n";
		} else {
		$service_bar_output .= '<div class="bar" data-value="'.$percentage.'">'. "\n";		
		}
		$service_bar_output .= '<div class="bar-text">'.$name.' <span>'.$value.'</span></div>'. "\n";
		$service_bar_output .= '</div>'. "\n";
		$service_bar_output .= '</div>'. "\n";
		
		global $has_progress_bar;
		$has_progress_bar = true;
		
		return $service_bar_output;
	}
	
	add_shortcode('progress_bar', 'progress_bar');
	
	
	/* CHART SHORTCODE
	================================================= */
	
	function chart($atts) {
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
		
		if ($size == "70") { $linewidth = "6"; }
		if ($size == "170") { $linewidth = "12"; }
		
		$chart_output .= '<div class="chart-shortcode chart-'.$size.' chart-'.$align.'" data-linewidth="'.$linewidth.'" data-percent="0" data-animatepercent="'.$percentage.'" data-size="'.$size.'" data-barcolor="'.$barcolour.'" data-trackcolor="'.$trackcolour.'">';
		if ($content != "") {
			if (strpos($content, 'icon') !== false) {
			    $chart_output .= '<span><i class="'.$content.'"></i></span>';
			} else {
			$chart_output .= '<span>'.$content.'</span>';
			}
		}
		$chart_output .= '</div>';
		
		global $has_chart;
		$has_chart = true;
		
		return $chart_output;
	}
	
	add_shortcode('chart', 'chart');
	
	
	/* TOOLTIP SHORTCODE
	================================================= */
	
	function tooltip($atts, $content = null) {
		extract(shortcode_atts(array(
			"title" => '',
			"link" => '#',
			"direction" => 'top'
		), $atts));
				
		$tooltip_output = '<a href="'.$link.'" rel="tooltip" data-original-title="'.$title.'" data-placement="'.$direction.'">'.do_shortcode($content).'</a>';

		return $tooltip_output;
	}
	
	add_shortcode('sf_tooltip', 'tooltip');
	
	
	/* MODAL SHORTCODE
	================================================= */
	
	function modal($atts, $content = null) {
		extract(shortcode_atts(array(
			"header" => '',
			"btn_type" => '',
			"btn_colour" => '',
			"btn_size" => '',
			"btn_text" => ''
		), $atts));
		
		global $modalCount;
		
		if ($modalCount >= 0) {
			$modalCount++;
		} else {
			$modalCount = 0;
		}
		
		$modal_output = "";
		
		if (($btn_type == "squarearrow") || ($btn_type == "slightlyroundedarrow") || ($btn_type == "roundedarrow")) {
			$modal_output .= '<a class="sf-button '.$btn_size.' '. $btn_colour .' '. $btn_type .'" href="#modal-'.$modalCount.'" role="button" data-toggle="modal"><span>'. $btn_text .'</span><span class="arrow"></span></a>';
		} else {
			$modal_output .= '<a class="sf-button '.$btn_size.' '. $btn_colour .' '. $btn_type .'" href="#modal-'.$modalCount.'" role="button" data-toggle="modal"><span>'. $btn_text .'</span></a>';
		}
		
		$modal_output .= '<div id="modal-'.$modalCount.'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="'.$header.'" aria-hidden="true">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h3 id="modal-label">'.$header.'</h3>
		  </div>
		  <div class="modal-body">
		  	'.do_shortcode($content).'
		  </div>
		</div>';
		
		return $modal_output;
	}
	
	add_shortcode('sf_modal', 'modal');	
	
	
	/* RESPONSIVE VISIBILITY SHORTCODE
	================================================= */
	
	function visibility($atts, $content = null) {
		extract(shortcode_atts(array(
			"class" => ''
		), $atts));
				
		$visibility_output = '<div class="'.$class.'">'.do_shortcode($content).'</div>';

		return $visibility_output;
	}
	
	add_shortcode('sf_visibility', 'visibility');
	

	/* YEAR SHORTCODE
	================================================= */

	function year_shortcode() {
		$year = date('Y');
		return $year;
	}

	add_shortcode('the-year', 'year_shortcode');


	/* WORDPRESS LINK SHORTCODE
	================================================= */

	function wordpress_link() {
		return '<a href="http://wordpress.org/" target="_blank">WordPress</a>';
	}

	add_shortcode('wp-link', 'wordpress_link');
	
?>