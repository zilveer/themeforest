<?php
	// Add button to visual editor
	add_action('init', 'add_shortcode_button');
	function add_shortcode_button(){
	
		if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') ){  
			 add_filter('mce_external_plugins', 'add_shortcode_plugin');  
			 add_filter('mce_buttons_3', 'register_shortcode_button');  
		   }  	
	
	}
	function register_shortcode_button($buttons){
		array_push($buttons, "column" , "separator");
		array_push($buttons, "accordion", "tab", "toggle_box", "price_item", "separator");
		array_push($buttons, "testimonial", "message_box", "button", "separator");
		array_push($buttons, "youtube", "vimeo", "gdl_gallery", "frame", "social", "separator");
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
	   $plugin_array['frame'] = GOODLAYERS_PATH . '/include/javascript/shortcode/frame.js';  
	   $plugin_array['button'] = GOODLAYERS_PATH . '/include/javascript/shortcode/button.js';  
	   $plugin_array['message_box'] = GOODLAYERS_PATH . '/include/javascript/shortcode/message-box.js';  
	   $plugin_array['list'] = GOODLAYERS_PATH . '/include/javascript/shortcode/list.js';  
	   $plugin_array['social'] = GOODLAYERS_PATH . '/include/javascript/shortcode/social.js';  
	   $plugin_array['quote'] = GOODLAYERS_PATH . '/include/javascript/shortcode/quote.js';  
	   $plugin_array['dropcap'] = GOODLAYERS_PATH . '/include/javascript/shortcode/dropcap.js';  
	   $plugin_array['testimonial'] = GOODLAYERS_PATH . '/include/javascript/shortcode/testimonial.js';  
	   return $plugin_array;  
	}

	// Slider caption shortcode
	add_shortcode('slider_caption', 'gdl_slider_caption_shortcode');
	function gdl_slider_caption_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array( 'top'=>'', 'left'=>'', 'right'=>'', 'bottom'=>'', 'size'=>'32', 'color'=>'#fff'), $atts) );	
		$caption = '<div style="position: absolute; left:' . $left . 'px; top:' . $top . 'px; right:' . $right . 'px; bottom:' . $bottom . 'px; ';
		$caption = $caption . 'font-size: ' . $size . 'px; color: ' . $color . '; ';
		$caption = $caption . '">' . do_shortcode($content) . '</div>';
		return $caption;
	}
	
	// Slider caption shortcode
	add_shortcode('slider_title', 'gdl_slider_title_shortcode');
	function gdl_slider_title_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array( 'top'=>'', 'left'=>'', 'right'=>'', 'bottom'=>'', 'size'=>'41', 'color'=>'#fff', 'shadow'=>'#000' ), $atts) );	
		$caption = '<div style="position: absolute; left:' . $left . 'px; top:' . $top . 'px; right:' . $right . 'px; bottom:' . $bottom . 'px; ';
		$caption = $caption . 'font-size: ' . $size . 'px; color:' . $color . '; '; 
		$caption = $caption . 'text-shadow: 4px 4px 1px ' . $shadow . '; '; 
		$caption = $caption . '">' . do_shortcode($content) . '</div>';
		return $caption;
	}	
	
	// shortcode for gallery 
	add_shortcode('gdl_gallery', 'gdl_gallery_shortcode');
	function gdl_gallery_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array('title'=>'', 'width'=>'200', 'height'=>'200', 'margin'=>'20', 
			'row_num'=>'100', 'type'=>'', 'galid'=>''), $atts) );
		$gdl_gallery = "";
		
		$row_num = intval($row_num);
		$current_num = 1;
		
		$gallery_post = get_posts(array('post_type' => 'gallery', 'name'=>$title, 'numberposts'=> 1));
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
					
					if($current_num % $row_num == 0){
						$gdl_gallery = $gdl_gallery . '<div class="gallery-thumbnail-image alignleft" style="margin-bottom: '. $margin .'px;">';
					}else{
						$gdl_gallery = $gdl_gallery . '<div class="gallery-thumbnail-image alignleft" style="margin-right: ' . $margin . 'px; margin-bottom: '. $margin .'px;">';
					}
					if( $link_type == 'Link to URL' ){
						$link = find_xml_value( $slider, 'link');	
						$gdl_gallery = $gdl_gallery . '<a href="' . $link . '">';
						$gdl_gallery = $gdl_gallery . '<img class="gdl-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
						$gdl_gallery = $gdl_gallery . '</a>';
					}else if( $link_type == 'Lightbox' ){
						$image_full = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
						$gdl_gallery = $gdl_gallery . '<a data-rel="prettyPhoto[bkpGallery' . $galid . ']" href="' . $image_full[0] . '"  title="">';
						$gdl_gallery = $gdl_gallery . '<img class="gdl-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
						$gdl_gallery = $gdl_gallery . '</a>';
					}else{
						$gdl_gallery = $gdl_gallery . '<img class="gdl-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
					}				
					$gdl_gallery = $gdl_gallery . '</div>'; // gallery-thumbnail-image
					
					$current_num++;
				}
				$gdl_gallery = $gdl_gallery . '<div class="clear"></div>';
				
			// Thumbnail gallery type
			}else{
				
				$thumbnail_id = get_post_thumbnail_id($gallery_post[0]->ID);
				$thumbnail_full = wp_get_attachment_image_src($thumbnail_id, 'full');
				$thumbnail_url = wp_get_attachment_image_src($thumbnail_id, $width . 'x' . $height );
				$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
				
				$gdl_gallery = $gdl_gallery . '<div class="gallery-thumbnail-image alignleft" style="margin-right: ' . $margin . 'px; margin-bottom: '. $margin .'px;">';
				$gdl_gallery = $gdl_gallery . '<a data-rel="prettyPhoto[bkpGallery' . $galid . ']" href="' . $thumbnail_full[0] . '" >';
				$gdl_gallery = $gdl_gallery . '<img src="' . $thumbnail_url[0] . '" alt="' . $alt_text . '" />';
				$gdl_gallery = $gdl_gallery . '</a>';
				
				foreach( $slider_xml_dom->documentElement->childNodes as $slider ){
					$image_full = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
					$gdl_gallery = $gdl_gallery . '<a data-rel="prettyPhoto[bkpGallery' . $galid . ']" href="' . $image_full[0] . '"  title=""></a>';
				}
				
				$gdl_gallery = $gdl_gallery . '</div>';
				
			}
			
		}
		
		return $gdl_gallery;
		
	}
	
	// shortcode for column
	add_shortcode('column', 'gdl_column_shortcode');
	function gdl_column_shortcode( $atts, $content = null ){

		extract( shortcode_atts(array("col" => '1/1'), $atts) );
	
		switch($col){
			case '1/4':
				return '<div class="shortcode1-4">' . do_shortcode($content) . '</div>';
			case '1/3':
				return '<div class="shortcode1-3">' . do_shortcode($content) . '</div>';
			case '1/2':
				return '<div class="shortcode1-2">' . do_shortcode($content) . '</div>';
			case '2/3':
				return '<div class="shortcode2-3">' . do_shortcode($content) . '</div>';
			case '3/4':
				return '<div class="shortcode3-4">' . do_shortcode($content) . '</div>';
			default : 
			case '1/1':
				return '<div class="shortcode1">' . do_shortcode($content) . '</div>';
		}			
		
	}

	// shortcode for accordion
	add_shortcode('accordion', 'gdl_accordion_shortcode');
	function gdl_accordion_shortcode( $atts, $content = null ){
		
		$accordion = "<ul class='gdl-accordion'>";
		$accordion = $accordion . do_shortcode($content);
		$accordion = $accordion . "</ul>";
		return $accordion;
		
	}
	add_shortcode('acc_item', 'gdl_acc_item_shortcode');
	function gdl_acc_item_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("title" => ''), $atts) );
		
		$acc_item = "<li class='gdl-divider'>";
		$acc_item = $acc_item . "<h2 class='accordion-head title-color gdl-title'>";
		$acc_item = $acc_item . "<span class='accordion-head-image'></span>"; 
		$acc_item = $acc_item . $title . "</h2>";
		$acc_item = $acc_item . "<div class='accordion-content'>" . do_shortcode($content) . "</div>";
		$acc_item = $acc_item . "</li>";
	
	
		return $acc_item;
	
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
		$toggle_item = "<li class='gdl-divider'>";
		$toggle_item = $toggle_item . "<h2 class='toggle-box-head title-color gdl-title'>";
		$toggle_item = $toggle_item . "<span class='toggle-box-head-image" . $active . "'></span>"; 
		$toggle_item = $toggle_item . $title . "</h2>";
		$toggle_item = $toggle_item . "<div class='toggle-box-content" . $active . "'>" . do_shortcode($content) . "</div>";
		$toggle_item = $toggle_item . "</li>";
	
	
		return $toggle_item;
	
	}	

	// shortcode for tab
	$gdl_tab_array = array();
	
	add_shortcode('tab', 'gdl_tab_shortcode');
	function gdl_tab_shortcode( $atts, $content = null ){

		global $gdl_tab_array;
		$gdl_tab_array = array();
		
		do_shortcode($content);
		
		$num = sizeOf($gdl_tab_array);
		
		$tab = "<ul class='tabs'>";

		for($i=0; $i<$num; $i++){
			$active = ( $i == 0 )? 'active':'';
			
			$tab = $tab . '<li><a data-href="tab-' . $i . '" class="gdl-title ';
			$tab = $tab . $active . '" >' . $gdl_tab_array[$i]["title"] . '</a></li>';
		}				
		
		$tab = $tab . "</ul>";
		$tab = $tab . "<ul class='tabs-content'>";

		for($i=0; $i<$num; $i++){
			$active = ( $i == 0 )? 'active':'';
			
			$tab = $tab . '<li data-href="tab-' . $i . '" class="';
			$tab = $tab . $active . '" >' . $gdl_tab_array[$i]["content"] . '</li>';
		}
		
		$tab = $tab . "</ul>";

		return $tab;
	}
	add_shortcode('tab_item', 'gdl_tab_item_shortcode');
	function gdl_tab_item_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(array("title" => ''), $atts) );
		
		global $gdl_tab_array;

		$gdl_tab_array[] = array("title" => $title , "content" => do_shortcode($content));
	
	}	
	
	// shortcode for divider
	add_shortcode('divider', 'gdl_divider_shortcode');
	function gdl_divider_shortcode( $atts ){
		
		extract( shortcode_atts(array("scroll_text" => ''), $atts) );	

		$divider = '<div class="divider"><div class="scroll-top">';	
		$divider = $divider . $scroll_text . '</div></div>';	
		return $divider;
	
	}
	
	// shortcode for space
	add_shortcode('space', 'gdl_space_shortcode');
	function gdl_space_shortcode( $atts ){
		
		extract( shortcode_atts(array("height" => '20'), $atts) );	
		
		return "<div style='clear:both; height:" . $height . "px' ></div>";
		
	}
	
	// shortcode for youtube
	add_shortcode('youtube', 'gdl_youtube_shortcode');
	function gdl_youtube_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("height" => '', "width" => ''), $atts) );
		
		preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $content, $id);
		
		/*
		$youtube = '<object type="application/x-shockwave-flash" data="http://www.youtube.com/v/' . $id[1] . '&hd=1" style="width:' . $width . 'px;height:' . $height . 'px">';
		$youtube = $youtube . '<param name="wmode" value="opaque"><param name="movie" value="http://www.youtube.com/v/' . $id[1] . '&hd=1" />';
		$youtube = $youtube . '</object>';
		*/
		$youtube = '<div style="max-width:' . $width . 'px;" >';
		$youtube = $youtube . '<iframe src="http://www.youtube.com/embed/' . $id[1] . '?wmode=transparent" width="' . $width . '" height="' . $height . '" ></iframe>';
		$youtube = $youtube . '</div>';
		
		return $youtube;
	
	}
	
	// shortcode for vimeo
	add_shortcode('vimeo', 'gdl_vimeo_shortcode');
	function gdl_vimeo_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("height" => '', "width" => ''), $atts) );
	
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $content, $id);
		
		$vimeo = '<div style="max-width:' . $width . 'px;" >';
		$vimeo = $vimeo . '<iframe src="http://player.vimeo.com/video/' . $id[1] . '?title=0&amp;byline=0&amp;portrait=0" width="' . $width . '" height="' . $height . '" ></iframe>';
		$vimeo = $vimeo . '</div>';
		
		return $vimeo;
	}
	
	// shortcode for button
	add_shortcode('button', 'gdl_button_shortcode');
	function gdl_button_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("color" => '', "background" => '', "size" => 'large', "src"=> '#', 'target'=>'_self'), $atts) );	
		
		$button_border = '';
		if( !empty( $background )){
			$button_border = '#' . hexDarker( substr( $background, 1), 5 );
		}
		
		return '<a href="' . $src . '" target="' . $target . '" class="gdl-button shortcode-' . $size . '-button" style="color:' . $color . '; background-color:' . $background . '; border-color:' . $button_border . '; ">' . $content . '</a>';
	}	
	
	add_shortcode('list', 'gdl_list_shortcode');
	function gdl_list_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("type" => 'check'), $atts) );	
		
		return '<div class="shortcode-list shortcode-list-' . $type . '">' . $content . '</div>';
	
	}
	
	add_shortcode('social', 'gdl_social_shortcode');
	function gdl_social_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("type" => 'facebook', "opacity"=>'dark'), $atts) );	
		
		$social = '<div class="shortcode-social social-icon"><a href="' . $content . '">';
		$social = $social . '<img class="no-preload" src="' . GOODLAYERS_PATH . '/images/icon/' . $opacity . '/social/' . $type . '.png' . '" alt="' . $type . '"></a></div>';
		return $social;
	
	}
	
	add_shortcode('quote', 'gdl_quote_shortcode');
	function gdl_quote_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(array("align" => 'center', 'color'=>'#999999'), $atts) );	
		
		return '<div class="shortcode-block-quote-' . $align . '" style="color:' . $color . '">' . $content . '</div>';
	
	}
	
	add_shortcode('dropcap', 'gdl_dropcap_shortcode');
	function gdl_dropcap_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(array("type" => '', "color" => '', "background"=> ''), $atts) );	
		
		return '<div class="shortcode-dropcap ' . $type . '" style="color:'. $color .'; background-color:' . $background . ';">' . $content . '</div>';
	
	}
	
	add_shortcode('testimonial', 'gdl_testimonial_shortcode');
	function gdl_testimonial_shortcode( $atts ){
	
		extract( shortcode_atts(array("title" => ''), $atts) );
		
		$posts = get_posts(array('post_type' => 'testimonial', 'name'=>$title, 'numberposts'=> 1));
		
		$testimonial = '<div class="testimonial-content">';
		$testimonial = $testimonial . '<div class="testimonial-icon"></div>';
		$testimonial = $testimonial . $posts[0]->post_content;
		$testimonial = $testimonial . '</div>';
			
		$testimonial = $testimonial . '<div class="testimonial-author gdl-divider">';
		$testimonial = $testimonial . '<span class="testimonial-author-name">' . $posts[0]->post_title . ', </span>';
		$testimonial = $testimonial . '<span class="testimonial-author-position">'; 
		$testimonial = $testimonial . get_post_meta($posts[0]->ID, 'testimonial-option-author-position', true);
		$testimonial = $testimonial . '</span>';
		$testimonial = $testimonial . '</div>';
		
		return $testimonial;
	}
	
	add_shortcode('message_box', 'gdl_message_box_shortcode');
	function gdl_message_box_shortcode( $atts, $content = null ){
	
		extract( shortcode_atts(array("title"=>'', "color"=>'red'), $atts) );
		
		$message_box =  '<div class="message-box-wrapper ' . $color . '">';
		$message_box =  $message_box . '<div class="message-box-title">' . $title . '</div>';
		$message_box =  $message_box . '<div class="message-box-content">' . do_shortcode($content) . '</div>';
		$message_box =  $message_box . '</div>';
	
		return $message_box;
	}
	
	add_shortcode('frame', 'gdl_frame_shortcode');
	function gdl_frame_shortcode( $atts ){
	
		extract( shortcode_atts(array("src"=>'#', "width"=>'auto', "height"=>'auto', "title"=>'', 'align'=>'none', 'lightbox'=>'on'), $atts) );
		
		$width = ( $width == "auto" )? "auto": $width.'px';
		$height = ( $height == "auto" )? "auto": $height.'px';
	
		$frame = "<img src='" . $src . "' style='width:" . $width . "; height:" . $height . ";' alt='' />";
	
		if( $lightbox == 'on' ){
			
			$frame = "<a href='" . $src . "' data-rel='prettyPhoto'  title='" . $title . "' >" . $frame . "</a>";
			
		}
		
		$frame = "<div class='gdl-image-frame shortcode-image-" . $align . "' style='max-width: 100%; float: " . $align . "; width: " . $width . "; height: " . $height . "; '>" . $frame . "</div>";
		
		return $frame;
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
	
	add_shortcode('column_service', 'gdl_column_service_shortcode');
	function gdl_column_service_shortcode( $atts, $content = null){
		extract( shortcode_atts(array('icon'=>'', 'title'=>'', 'alt'=>'icon', 'more_text'=>'Learn more', 'more'=>'' ), $atts) );
		
		$column_service = '<div class="column-service-wrapper">';
		
		if( !empty( $icon ) ){
			$column_service = $column_service . '<div class="column-service-image"><img src="' . $icon . '" alt="' . $alt . '" /></div>';
		}
		
		$column_service = $column_service . '<div class="column-service-content-wrapper">';
		$column_service = $column_service . '<h3 class="column-service-title">' . $title . '</h3>';
		$column_service = $column_service . '<div class="column-service-content">' . do_shortcode( $content ) . '</div>';
		
		if( !empty( $more ) ){
			$column_service = $column_service . '<a href="' . $more . '" class="column-service-read-more">' . $more_text . '</a>';
		}
		
		$column_service = $column_service . '</div>'; // content-wrapper
		
		$column_service = $column_service . '</div>'; // column-service-wrapper
		
		return $column_service;
	}
	
	add_shortcode('price-item', 'gdl_price_item_shortcode');
	function gdl_price_item_shortcode( $atts ){
		
		extract( shortcode_atts(array("item_number"=>'6', "category"=>'all'), $atts) );
	
		$price_item = '<div class="gdl-price-item">';
		$price_posts = get_posts(array('post_type'=>'price_table', 'price-table-category'=>$category, 
			'numberposts'=>$item_number));
		foreach($price_posts as $price_post){
			$best_price = get_post_meta( $price_post->ID, 'price-table-best-price', true );
			$best_price = ($best_price == 'Yes')? 'active': '';
			
			$price_item = $price_item . '<div class="percent-column1-' . $item_number . ' gdl-divider">';
			$price_item = $price_item . '<div class="price-item ' . $best_price . '">';
			$price_item = $price_item . '<div class="price-tag">' . get_post_meta( $price_post->ID, 'price-table-price-tag', true ) . '</div>';
			$price_item = $price_item . '<div class="price-title">' . $price_post->post_title . '</div>';
			
			$price_item = $price_item . '<div class="price-content">';
			$price_item = $price_item . do_shortcode( $price_post->post_content );
			$price_item = $price_item . '</div>';
			
			$price_url = get_post_meta( $price_post->ID, 'price-table-option-url', true );
			if( !empty($price_url) ){
				$price_item = $price_item . '<div class="price-button">';
				$price_item = $price_item . '<a class="gdl-button" href="' . $price_url . '">' . get_option(THEME_SHORT_NAME.'_translator_read_more_price','Read More') . '</a>';
				$price_item = $price_item . '</div>';
			}
			$price_item = $price_item . '</div>';
			$price_item = $price_item . '</div>';
			
		}
		$price_item = $price_item . "<div class='clear'></div>";	
		$price_item = $price_item . '</div>';
		
		return $price_item;	
	}
	
	//foreach($shortcode_tags as $key => $value){
	//	if( $key != 'code' ){
	//		echo "'$key' => '$value', ";
	//	}
	//}
	function fix_shortcodes($content){   
		global $shortcode_tags;
		
		// backup all shortcodes
		$orig_shortcode_tags = $shortcode_tags;

		// wrap p around non-autop shortcode
		$shortcode_tags = array(
			'slider_caption' => 'gdl_slider_caption_shortcode', 'slider_title' => 'gdl_slider_title_shortcode', 'gdl_gallery' => 'gdl_gallery_shortcode', 'column' => 'gdl_column_shortcode', 'accordion' => 'gdl_accordion_shortcode', 'acc_item' => 'gdl_acc_item_shortcode', 'toggle_box' => 'gdl_toggle_box_shortcode', 'toggle_item' => 'gdl_toggle_item_shortcode', 'tab' => 'gdl_tab_shortcode', 'tab_item' => 'gdl_tab_item_shortcode', 'divider' => 'gdl_divider_shortcode', 'space' => 'gdl_space_shortcode', 'youtube' => 'gdl_youtube_shortcode', 'vimeo' => 'gdl_vimeo_shortcode', 'button' => 'gdl_button_shortcode', 'list' => 'gdl_list_shortcode', 'social' => 'gdl_social_shortcode', 'quote' => 'gdl_quote_shortcode', 'dropcap' => 'gdl_dropcap_shortcode', 'testimonial' => 'gdl_testimonial_shortcode', 'message_box' => 'gdl_message_box_shortcode', 'frame' => 'gdl_frame_shortcode', 'column_service' => 'gdl_column_service_shortcode', 'price-item' => 'gdl_price_item_shortcode',
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