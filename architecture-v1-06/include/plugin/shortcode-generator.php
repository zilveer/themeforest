<?php
	$accordion_active = '';
	// shortcode for accordion
	add_shortcode('accordion', 'gdl_accordion_shortcode');
	function gdl_accordion_shortcode( $atts, $content = null ){
		global $accordion_active;
		$accordion_active = 'class="active"';
		
		$accordion = "<ul class='gdl-accordion'>";
		$accordion = $accordion . do_shortcode($content);
		$accordion = $accordion . "</ul>";
		return $accordion;
	}
	add_shortcode('acc_item', 'gdl_acc_item_shortcode');
	function gdl_acc_item_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("title" => ''), $atts) );
		
		global $accordion_active;
		
		$acc_item = '<li ' . $accordion_active . '>';
		$acc_item = $acc_item . "<h2 class='accordion-title'>" . $title . "</h2>";
		$acc_item = $acc_item . "<div class='accordion-content'>" . do_shortcode($content) . "</div>";
		$acc_item = $acc_item . "</li>";
	
		$accordion_active = '';
		return $acc_item;
	}
	
	// block quote
	add_shortcode('quote', 'gdl_quote_shortcode');
	function gdl_quote_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("align" => 'center'), $atts) );	
		
		return '<blockquote class="' . $align . '">' . $content . '</blockquote>';
	}	

	// shortcode for button
	add_shortcode('button', 'gdl_button_shortcode');
	function gdl_button_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("color" => '', "background" => '', "size" => 'large', "src"=> '#', 'target'=>'_self'), $atts) );	
		
		$css_attr = (!empty($color))? 'color:' . $color . '; ': '';
		$css_attr = (!empty($color))? $css_attr . 'background-color:' . $background . '; ': $css_attr;
		
		return '<a href="' . $src . '" target="' . $target . '" class="gdl-button ' . $size . '" style="' . $css_attr . '">' . $content . '</a>';
	}	
	
	// for code section
	add_shortcode('code', 'gdl_hilighter_shortcode');
	function gdl_hilighter_shortcode( $atts, $content = null){
		extract( shortcode_atts(array("item_number"=>'6', "category"=>'all'), $atts) );

		$content = str_replace('<pre class="gdlr_rp">', '', $content);
		$content = str_replace('gdlr_rp</pre>', '', $content);
		$content = wpautop($content);
		
		$hilighter = "<div class='gdl-code'>";
		$hilighter = $hilighter . $content;
		$hilighter = $hilighter . "</div>";
		
		return $hilighter;
	}		
	
	// shortcode for column
	add_shortcode('column', 'gdl_column_shortcode');
	function gdl_column_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("col" => '1/1', 'last'=>false), $atts) );
		if( $last && $last != 'false' ){
			$last = 'last';
			$clear = '<div class="clear"></div>';
		}else{
			$last = '';
			$clear = '';
		}
		
		return '<div class="shortcode' . str_replace('/', '-', $col) . ' ' . $last . '">' . do_shortcode($content) . '</div>' . $clear;
		switch($col){
			case '1/4': return '<div class="shortcode1-4 ' . $last . '">' . do_shortcode($content) . '</div>' . $clear;
			case '1/3': return '<div class="shortcode1-3 ' . $last . '">' . do_shortcode($content) . '</div>' . $clear;
			case '1/2': return '<div class="shortcode1-2 ' . $last . '">' . do_shortcode($content) . '</div>' . $clear;
			case '2/3': return '<div class="shortcode2-3 ' . $last . '">' . do_shortcode($content) . '</div>' . $clear;
			case '3/4': return '<div class="shortcode3-4 ' . $last . '">' . do_shortcode($content) . '</div>' . $clear;
			case '1/1': return '<div class="shortcode1">' . do_shortcode($content) . '</div>';				
			default : return;
		}			
	}	

	// shortcode for divider
	add_shortcode('divider', 'gdl_divider_shortcode');
	function gdl_divider_shortcode( $atts ){
		extract( shortcode_atts(array("scroll_text" => ''), $atts) );	
		
		$divider = '<div class="clear"></div>';
		$divider = $divider . '<div class="gdl-divider">';
		$divider = $divider . '<div class="scroll-top">' . $scroll_text . '</div>';	
		$divider = $divider . '</div>';	
		
		return $divider;
	}	
	
	// dropcap shortcode
	add_shortcode('dropcap', 'gdl_dropcap_shortcode');
	function gdl_dropcap_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("type" => '', "color" => '', "background"=> ''), $atts) );	
		
		return '<div class="shortcode-dropcap ' . $type . '" style="color:'. $color .'; background-color:' . $background . ';">' . $content . '</div>';
	}	

	// shortcode for gallery 
	add_shortcode('gdl_gallery', 'gdl_gallery_shortcode');
	function gdl_gallery_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array('title'=>'', 'width'=>'200', 'height'=>'200', 'type'=>''), $atts) );
		
		global $gdl_element_id;
		
		$gdl_gallery = "";
		$gallery_post = get_posts(array('post_type' => 'gdl-gallery', 'name'=>$title, 'numberposts'=> 1));
		$slider_xml_string = get_post_meta($gallery_post[0]->ID,'post-option-gallery-xml', true);
		$slider_xml_dom = new DOMDocument();
		if( !empty( $slider_xml_string ) ){
			$slider_xml_dom->loadXML($slider_xml_string);	
			
			// Normal gallery type
			if( empty($type) ){ 
				foreach( $slider_xml_dom->documentElement->childNodes as $slider ){
					$link_type = find_xml_value($slider, 'linktype');				
					$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), $width . 'x' . $height );
					$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);	
					
					$gdl_gallery = $gdl_gallery . '<div class="gdl-gallery-image shortcode">';
					if( $link_type == 'Link to URL' ){
						$link = find_xml_value( $slider, 'link');	
						$gdl_gallery = $gdl_gallery . '<a href="' . $link . '" title="' . $link . '" target="_blank" >';
						$gdl_gallery = $gdl_gallery . '<img class="gdl-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
						$gdl_gallery = $gdl_gallery . '</a>';
					}else if( $link_type == 'Lightbox' ){
						$image_full = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
						$gdl_gallery = $gdl_gallery . '<a data-rel="fancybox" data-fancybox-group="gal' . $gdl_element_id . '" href="' . $image_full[0] . '"  title="' . $alt_text . '">';
						$gdl_gallery = $gdl_gallery . '<img class="gdl-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
						$gdl_gallery = $gdl_gallery . '</a>';
					}else{
						$gdl_gallery = $gdl_gallery . '<img class="gdl-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
					}				
					$gdl_gallery = $gdl_gallery . '</div>'; // gallery-thumbnail-image
				}
				$gdl_gallery = $gdl_gallery . '<div class="clear"></div>';
				
			// Thumbnail gallery type
			}else{
				$thumbnail_id = get_post_thumbnail_id($gallery_post[0]->ID);
				$thumbnail_full = wp_get_attachment_image_src($thumbnail_id, 'full');
				$thumbnail_url = wp_get_attachment_image_src($thumbnail_id, $width . 'x' . $height );
				$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
				
				$gdl_gallery = $gdl_gallery . '<div class="gdl-gallery-image shortcode">';
				$gdl_gallery = $gdl_gallery . '<a data-rel="fancybox" data-fancybox-group="gal' . $gdl_element_id . '" href="' . $thumbnail_full[0] . '" title="' . $alt_text . '" >';
				$gdl_gallery = $gdl_gallery . '<img src="' . $thumbnail_url[0] . '" alt="' . $alt_text . '" />';
				$gdl_gallery = $gdl_gallery . '</a>';
				
				foreach( $slider_xml_dom->documentElement->childNodes as $slider ){
					$thumbnail_id = find_xml_value($slider, 'image');
					$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
					$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
					$gdl_gallery = $gdl_gallery . '<a data-rel="fancybox" data-fancybox-group="gal' . $gdl_element_id . '" href="' . $image_full[0] . '"  title="' . $alt_text . '"></a>';
				}
				
				$gdl_gallery = $gdl_gallery . '</div>';
			}
			$gdl_element_id++;
		}
		
		return $gdl_gallery;
	}
	
	// list shortcode
	add_shortcode('list', 'gdl_list_shortcode');
	function gdl_list_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("type" => 'check'), $atts) );	
		
		return '<div class="shortcode-list ' . $type . '">' . $content . '</div>';
	}
	
	// message box shortcode
	add_shortcode('message_box', 'gdl_message_box_shortcode');
	function gdl_message_box_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("title"=>'', "color"=>'red'), $atts) );
		
		$message_box =  '<div class="message-box-wrapper ' . $color . '">';
		$message_box =  $message_box . '<div class="message-box-title">' . $title . '</div>';
		$message_box =  $message_box . '<div class="message-box-content">' . do_shortcode($content) . '</div>';
		$message_box =  $message_box . '</div>';
	
		return $message_box;
	}	
	
	// personnel shortcode
	add_shortcode('personnel', 'gdl_personnal_shortcode');
	function gdl_personnal_shortcode( $atts ){
		extract( shortcode_atts(array("size"=>'1/4', 'num_fetch'=>4, "category"=>''), $atts) );
		
		global $personnal_div_size_num_class, $sidebar_type;
		$personnal = '';
		$personnal_row_size = 0;
		$item_size = $personnal_div_size_num_class[$size][$sidebar_type];
		
		$post_temp = query_posts(array('post_type'=>'personnal',
			'personnal-category'=>$category, 'posts_per_page'=>$num_fetch));		
			
		$personnal = $personnal . '<div class="personnal-item-holder">';
		while( have_posts() ){ the_post();	
		
			$ret_size = return_item_size($size, $personnal_row_size, 'personnal-item-wrapper');
			$personnal_row_size = $ret_size['row-size'];
			$personnal = $personnal . $ret_size['return'];
			$personnal = $personnal . '<div class="personnal-item">';

			$personnal = $personnal . '<div class="personnal-title">';
			$personnal = $personnal . get_the_title();
			$personnal = $personnal . '</div>';			

			$position = get_post_meta( get_the_ID(), 'personnal-option-position', true );
			if( !empty($position) ){
				$personnal = $personnal . '<div class="personnal-position">' . $position . "</div>";
			}
			
			$thumbnail_id = get_post_thumbnail_id();
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
				$personnal = $personnal . '<div class="personnal-thumbnail"><img src="' . $thumbnail[0] . '" alt="' . $alt_text . '"></div>';			
			}

			$personnal = $personnal . '<div class="personnal-content">';
			$personnal = $personnal . do_shortcode( get_the_content() );
			$personnal = $personnal . '</div>';
			
			$personnal = $personnal . '<div class="clear"></div>';
			$personnal = $personnal . '</div>'; // personnal item
			$personnal = $personnal . '</div>'; //close print_item_size
		}
		$personnal = $personnal . '<div class="clear"></div>';
		$personnal = $personnal . '</div>'; //close row
		$personnal = $personnal . '</div>';		
		
		wp_reset_query();
		
		return $personnal;
	}
	
	// price item shortcode
	add_shortcode('price-item', 'gdl_price_item_shortcode');
	function gdl_price_item_shortcode( $atts ){
		extract( shortcode_atts(array("item_number"=>'6', "category"=>''), $atts) );
		
		global $gdl_admin_translator;
		
		$price_item_row_size = 0;
		if( $gdl_admin_translator == 'enable' ){
			$translator_read_more = get_option(THEME_SHORT_NAME.'_translator_read_more_price', 'Read More');
		}else{
			$translator_read_more = __('Read More','gdl_front_end');
		}	

		$price_posts = get_posts(array('post_type'=>'price_table', 'price-table-category'=>$category, 
			'numberposts'=>$item_number));

		$price_item = '<div class="price-table-wrapper">';
		foreach($price_posts as $price_post){	
			$best_price = get_post_meta( $price_post->ID, 'price-table-best-price', true );
			$best_price = ($best_price == 'Yes')? ' best-price':'';		
		
			$ret_size = return_item_size('1/' . $item_number, $price_item_row_size, 'price-item-wrapper wrapper mb0' . $best_price);
			$price_item_row_size = $ret_size['row-size'];
			$price_item = $price_item . $ret_size['return'];
			$price_item = $price_item . '<div class="price-item">';
			$price_item = $price_item . '<div class="price-title">' . $price_post->post_title . '</div>';
			
			$price_item = $price_item . '<div class="price-tag">';
			$price_item = $price_item . __(get_post_meta( $price_post->ID, 'price-table-price-tag', true ), 'gdl_front_end');
			
			$suffix = __(get_post_meta( $price_post->ID, 'price-table-price-suffix', true ), 'gdl_front_end');
			if( !empty($suffix) ){ 
				$price_item = $price_item . '<span class="price-suffix">' . $suffix . '</span>'; 
			}
			
			$price_item = $price_item . '</div>';

			$price_item = $price_item . '<div class="price-content">';
			$price_item = $price_item . do_shortcode( $price_post->post_content );
			$price_item = $price_item . '</div>';
			
			$price_url = __(get_post_meta( $price_post->ID, 'price-table-option-url', true ), 'gdl_front_end');
			if( !empty($price_url) ){
				$price_item = $price_item . '<div class="price-button-wrapper">';
				$price_item = $price_item . '<a class="price-button" target="_blank" href="' . $price_url . '" ' . $price_style . '>' . $translator_read_more . '</a>';
				$price_item = $price_item . '</div>';
			}
			
			$price_item = $price_item . '<div class="clear"></div>';
			$price_item = $price_item . '</div>'; // price item
			$price_item = $price_item . '</div>'; // print item size

		}
		$price_item = $price_item .  '<div class="clear"></div>';
		$price_item = $price_item . '</div>'; // end row
		$price_item = $price_item . '</div>'; // price table wrapper
		
		return $price_item;	
	}
	
	// social shortcode
	add_shortcode('social', 'gdl_social_shortcode');
	function gdl_social_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("type" => 'facebook'), $atts) );	
		
		$social = '<div class="social-icon"><a href="' . $content . '">';
		$social = $social . '<img class="no-preload" src="' . GOODLAYERS_PATH . '/images/icon/social-icon-m/' . $type . '.png' . '" alt="' . $type . '"></a></div>';
		return $social;
	}
	
	// shortcode for space
	add_shortcode('space', 'gdl_space_shortcode');
	function gdl_space_shortcode( $atts ){
		extract( shortcode_atts(array("height" => '20'), $atts) );	
		
		return '<div class="clear" style=" height:' . $height . 'px;" ></div>';
	}

	// shortcode for tab
	$gdl_tab_array = array();
	add_shortcode('tab', 'gdl_tab_shortcode');
	function gdl_tab_shortcode( $atts, $content = null ){
		global $gdl_tab_array;
		$gdl_tab_array = array();
		
		do_shortcode($content);
		
		$num = sizeOf($gdl_tab_array);
		$tab = '<div class="gdl-tab">';
		
		// tab title
		$tab = $tab . '<ul class="gdl-tab-title">';
		for($i=0; $i<$num; $i++){
			$active = ( $i == 0 )? 'class="active" ' : '';
		
			$tab = $tab . '<li><a data-tab="tab-' . $i  . '" ' . $active;
			$tab = $tab . '>' . $gdl_tab_array[$i]["title"] . '</a></li>';
		}				
		$tab = $tab . '</ul>';
		
		// tab content
		$tab = $tab . '<div class="clear"></div>';
		$tab = $tab . '<ul class="gdl-tab-content">';
		for($i=0; $i<$num; $i++){
			$active = ( $i == 0 )? 'class="active" ' : '';

			$tab = $tab . '<li data-tab="tab-' . $i . '" ' . $active;
			$tab = $tab . '>' . $gdl_tab_array[$i]["content"] . '</li>';
		}
		$tab = $tab . "</ul>"; // gdl-tab-content
		
		$tab = $tab . "</div>"; // gdl-tab

		return $tab;
	}
	add_shortcode('tab_item', 'gdl_tab_item_shortcode');
	function gdl_tab_item_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("title" => ''), $atts) );
		
		global $gdl_tab_array;

		$gdl_tab_array[] = array("title" => $title , "content" => do_shortcode($content));
	}	
	
	// testimonial shortcode
	add_shortcode('testimonial', 'gdl_testimonial_shortcode');
	function gdl_testimonial_shortcode( $atts ){
		extract( shortcode_atts(array('category' => '', 'type'=>'static', 'size'=>'1/1'), $atts) );
		
		$temp = '';
		$testimonial_row_size = 0;
		$testimonials = get_posts(array('post_type' => 'testimonial', 'testimonial-category'=>$category,
			'numberposts'=> 100));
		
		if( $type == 'static' ){
			$temp = '<div class="gdl-static-testimonial">';
			foreach( $testimonials as $testimonial ){
				$return_size = return_item_size($size, $testimonial_row_size, 'mb20');
				$testimonial_row_size = $return_size['row-size'];
				
				$temp = $temp . $return_size['return'];
				$temp = $temp . '<div class="testimonial-item">';
				
				// testimonial content
				$temp = $temp . '<div class="testimonial-content">';
				$temp = $temp . do_shortcode( $testimonial->post_content );
				$temp = $temp . '</div>';
				
				// testimonial author
				$author = $testimonial->post_title;
				$position = get_post_meta( $testimonial->ID, "testimonial-option-author-position", true );
				$temp = $temp . '<div class="testimonial-info">';
				$temp = $temp . '<span class="testimonial-author">' . $author . '</span>';
				if( !empty($position) ){
					$temp = $temp . '<span class="testimonial-position">, ' . $position . '</span>';
				}
				$temp = $temp . '</div>';
				
				$temp = $temp . '</div>'; // testimonial item
				$temp = $temp . '</div>'; // clost print item size
			}
			$temp = $temp . '<div class="clear"></div>';
			$temp = $temp . '</div>'; // close row
			$temp = $temp . '</div>'; // gdl-static-testimonial	
		}else{
			$temp = $temp . '<div class="gdl-carousel-testimonial gdl-shortcode">';
			
			// navigation
			$temp = $temp . '<div class="testimonial-navigation">';
			$temp = $temp . '<a class="testimonial-prev"></a>';
			$temp = $temp . '<a class="testimonial-next"></a>';
			$temp = $temp . '</div>';
			
			// content
			$temp = $temp . '<div class="testimonial-item-wrapper">';
			foreach( $testimonials as $testimonial ){
				$temp = $temp . '<div class="testimonial-item">';
				
				// testimonial content
				$temp = $temp . '<div class="testimonial-content">';
				$temp = $temp . do_shortcode( $testimonial->post_content );
				$temp = $temp . '</div>';
				
				// testimonial author
				$author = $testimonial->post_title;
				$position = get_post_meta( $testimonial->ID, "testimonial-option-author-position", true );
				$temp = $temp . '<div class="testimonial-info">';
				$temp = $temp . '<span class="testimonial-author">- ' . $author . '</span>';
				if( !empty($position) ){
					$temp = $temp . '<span class="testimonial-position">, ' . $position . '</span>';
				}
				$temp = $temp . '</div>';
				
				$temp = $temp . '</div>'; // testimonial item
			}	
			$temp = $temp . '</div>'; //testimonial-item-wrapper
			$temp = $temp . '</div>';		
			
			wp_deregister_script('jquery-cycle');
			wp_register_script('jquery-cycle', GOODLAYERS_PATH.'/javascript/jquery.cycle.js', false, '1.0', true);
			wp_enqueue_script('jquery-cycle');					
		}
		
		return $temp;
	}
	
	// shortcode for toggle box
	add_shortcode('toggle_box', 'gdl_toggle_box_shortcode');
	function gdl_toggle_box_shortcode( $atts, $content = null ){
		$toggle_box = "<ul class='gdl-toggle-box'>";
		$toggle_box = $toggle_box . do_shortcode($content);
		$toggle_box = $toggle_box . "</ul>";
		return $toggle_box;
	}
	add_shortcode('toggle_item', 'gdl_toggle_item_shortcode');
	function gdl_toggle_item_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("title" => '', "active" => 'false'), $atts) );
		
		$active = ( $active == "true" )? " active": '';
		$toggle_item = "<li class='" . $active . "'>";
		$toggle_item = $toggle_item . "<h2 class='toggle-box-title'>" . $title . "</h2>";
		$toggle_item = $toggle_item . "<div class='toggle-box-content'>" . do_shortcode($content) . "</div>";
		$toggle_item = $toggle_item . "</li>";

		return $toggle_item;
	}	

	// shortcode for vimeo
	add_shortcode('vimeo', 'gdl_vimeo_shortcode');
	function gdl_vimeo_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("height" => '', "width" => ''), $atts) );
		
		$vimeo = '<div style="max-width:' . $width . 'px;" >';
		$vimeo = $vimeo . get_vimeo($content, $width, $height, true);
		$vimeo = $vimeo . '</div>';
		
		return $vimeo;
	}
	
	// shortcode for youtube
	add_shortcode('youtube', 'gdl_youtube_shortcode');
	function gdl_youtube_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("height" => '', "width" => ''), $atts) );	
	
		$youtube = '<div style="max-width:' . $width . 'px;" >';
		$youtube = $youtube . get_youtube($content, $width, $height, 'youtube', true);
		$youtube = $youtube . '</div>';
		
		return $youtube;
	}

	// JW Player shortcode for supporting the JW Player in the page builder
	add_shortcode('jwplayer', 'gdl_jw_player_shortcode');
	function gdl_jw_player_shortcode( $atts ){
		$jw_shortcode = '[jwplayer ';
		foreach( $atts as $key => $value ){
			$jw_shortcode = $jw_shortcode . $key . '="' . $value . '" ';
		}
		$jw_shortcode = $jw_shortcode . ']';
		
		if(function_exists('jwplayer_tag_callback')){
			return jwplayer_tag_callback($jw_shortcode);
		}
		return '';
	}	
	
	// Add button to visual editor
	add_action('init', 'add_shortcode_button');
	function add_shortcode_button(){
	
		if ( current_user_can('edit_posts') ||  current_user_can('edit_pages') ){  
			 add_filter('mce_external_plugins', 'add_shortcode_plugin');  
			 add_filter('mce_buttons_3', 'register_shortcode_button');  
		   }  	
	
	}
	function register_shortcode_button($buttons){
		array_push($buttons, "column" , "separator");
		array_push($buttons, "accordion", "tab", "toggle_box", "price_item", "separator");
		array_push($buttons, "testimonial", "message_box", "button", "separator");
		array_push($buttons, "youtube", "vimeo", "gdl_gallery", "social", "separator");
		array_push($buttons, "list", "quote", "dropcap", "separator");
		array_push($buttons, "divider", "space", "separator");

		return $buttons;
	}
	function add_shortcode_plugin($plugin_array) {  
	   $plugin_array['column'] = GOODLAYERS_PATH . '/include/javascript/shortcode/column.js';  
	   $plugin_array['accordion'] = GOODLAYERS_PATH . '/include/javascript/shortcode/accordion.js';  
	   $plugin_array['toggle_box'] = GOODLAYERS_PATH . '/include/javascript/shortcode/toggle-box.js';  
	   $plugin_array['price_item'] = GOODLAYERS_PATH . '/include/javascript/shortcode/price-item.js';  
	   $plugin_array['tab'] = GOODLAYERS_PATH . '/include/javascript/shortcode/tab.js';  
	   $plugin_array['divider'] = GOODLAYERS_PATH . '/include/javascript/shortcode/divider.js';  
	   $plugin_array['space'] = GOODLAYERS_PATH . '/include/javascript/shortcode/space.js';  
	   $plugin_array['youtube'] = GOODLAYERS_PATH . '/include/javascript/shortcode/youtube.js';  
	   $plugin_array['vimeo'] = GOODLAYERS_PATH . '/include/javascript/shortcode/vimeo.js';  
	   $plugin_array['gdl_gallery'] = GOODLAYERS_PATH . '/include/javascript/shortcode/gdl-gallery.js';  
	   $plugin_array['button'] = GOODLAYERS_PATH . '/include/javascript/shortcode/button.js';  
	   $plugin_array['message_box'] = GOODLAYERS_PATH . '/include/javascript/shortcode/message-box.js';  
	   $plugin_array['list'] = GOODLAYERS_PATH . '/include/javascript/shortcode/list.js';  
	   $plugin_array['social'] = GOODLAYERS_PATH . '/include/javascript/shortcode/social.js';  
	   $plugin_array['quote'] = GOODLAYERS_PATH . '/include/javascript/shortcode/quote.js';  
	   $plugin_array['dropcap'] = GOODLAYERS_PATH . '/include/javascript/shortcode/dropcap.js';  
	   $plugin_array['testimonial'] = GOODLAYERS_PATH . '/include/javascript/shortcode/testimonial.js';  
	   return $plugin_array;  
	}
	
	// foreach($shortcode_tags as $key => $value){
	// 	if( $key != 'code' ){
	// 		echo "'$key' => '$value', ";
	// 	}
	// }
	function fix_shortcodes($content){   
		global $shortcode_tags;
		
		// backup all shortcodes
		$orig_shortcode_tags = $shortcode_tags;

		// wrap p around non-autop shortcode
		$shortcode_tags = array(
			'accordion' => 'gdl_accordion_shortcode', 'acc_item' => 'gdl_acc_item_shortcode', 'quote' => 'gdl_quote_shortcode', 'button' => 'gdl_button_shortcode', 'column' => 'gdl_column_shortcode', 'divider' => 'gdl_divider_shortcode', 'dropcap' => 'gdl_dropcap_shortcode', 'gdl_gallery' => 'gdl_gallery_shortcode', 'list' => 'gdl_list_shortcode', 'message_box' => 'gdl_message_box_shortcode', 'personnel' => 'gdl_personnal_shortcode', 'price-item' => 'gdl_price_item_shortcode', 'social' => 'gdl_social_shortcode', 'space' => 'gdl_space_shortcode', 'tab' => 'gdl_tab_shortcode', 'tab_item' => 'gdl_tab_item_shortcode', 'testimonial' => 'gdl_testimonial_shortcode', 'toggle_box' => 'gdl_toggle_box_shortcode', 'toggle_item' => 'gdl_toggle_item_shortcode', 'vimeo' => 'gdl_vimeo_shortcode', 'youtube' => 'gdl_youtube_shortcode', 'jwplayer' => 'gdl_jw_player_shortcode',
		);
		$pattern = '/' . get_shortcode_regex() . '/s';
		$content = preg_replace($pattern, '<pre class="gdlr_rp">${0}gdlr_rp</pre>', $content);
		
		// return all shortcodes
		$shortcode_tags = $orig_shortcode_tags;
		
	    return $content;
    }
	function gdlr_fix_shortcodes_callback($content){
		$content = str_replace('<pre class="gdlr_rp">', '', $content);
		$content = str_replace('gdlr_rp</pre>', '', $content);
		return $content;
	}	
    add_filter('the_content', 'fix_shortcodes', 7);
	add_filter('the_content', 'gdlr_fix_shortcodes_callback', 11);
	
?>