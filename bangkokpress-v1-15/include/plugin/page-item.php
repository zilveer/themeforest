<?php

	/*
	*	Goodlayers Page Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each page item due to 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/

	// Print the item size <div> with it's class
	function print_item_size($item_size, $addition_class=''){
		global $gdl_item_row_size;
		
		$gdl_item_row_size = (empty($gdl_item_row_size))? 0: $gdl_item_row_size;
		
		if($gdl_item_row_size >= 1){
		
			$gdl_item_row_size = 0;
			echo '<br class="clear">';
			
		}
		
		switch($item_size){
			case 'element1-4':
				echo '<div class="four columns ' . $addition_class . '">';
				$gdl_item_row_size += 1/4; 
				break;
			case 'element1-3':
				echo '<div class="one-third column ' . $addition_class . '">';
				$gdl_item_row_size += 1/3; 
				break;
			case 'element1-2':
				echo '<div class="eight columns ' . $addition_class . '">';
				$gdl_item_row_size += 1/2; 
				break;
			case 'element2-3':
				echo '<div class="two-thirds column ' . $addition_class . '">';
				$gdl_item_row_size += 2/3; 
				break;
			case 'element3-4':
				echo '<div class="twelve columns ' . $addition_class . '">';
				$gdl_item_row_size += 3/4; 
				break;
			case 'element1-1':
				echo '<div class="sixteen columns ' . $addition_class . '">';
				$gdl_item_row_size += 1; 
				break;	
		}
		
	}
	
	// Print Content Item
	function print_content_item($item_xml){
		wp_reset_query();
		
		if(have_posts()){
			while(have_posts()){
				echo '<div class="bkp-frame-wrapper">';
				echo '<div class="bkp-frame p20">';					
				the_post(); 
				the_content();
				echo '</div>';				
				echo '</div>';					
			}
		}
	}
	
	// Print column 
	function print_column_item($item_xml){
		echo "<div class='bkp-frame-wrapper'>";
		echo "<div class='bkp-frame p20'>";	
	
		echo do_shortcode(html_entity_decode(find_xml_value($item_xml,'column-text')));
		
		echo "</div>"; //bkp-frame-wrapper
		echo "</div>"; //bkp-frame			
	}
	
	// Print the gallery item
	$gallery_div_size_num_class = array(
		'1/4' => array( 'class'=>'four columns', 'size'=>'366x366' ,'size2'=>'366x366' ,'size3'=>'366x366'),
		'1/3' => array( 'class'=>'one-third column', 'size'=>'366x366' ,'size2'=>'366x366' ,'size3'=>'366x366'),
		'1/2' => array( 'class'=>'eight columns', 'size'=>'433x433' ,'size2'=>'433x433' ,'size3'=>'366x366'),
	); 
	function print_gallery_item($item_xml){
	
		global $gallery_div_size_num_class;
		global $page_background, $sidebar;	
	
		$gallery_type = find_xml_value($item_xml, 'gallery-type');
		$gallery_page = find_xml_value($item_xml, 'page');
		
		$gallery_size = find_xml_value($item_xml, 'item-size');
		
		$gallery_class = $gallery_div_size_num_class[$gallery_size]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $gallery_div_size_num_class[$gallery_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $gallery_div_size_num_class[$gallery_size]['size2'];
		}else if ( $sidebar == "both-sidebar" ){
			$item_size = $gallery_div_size_num_class[$gallery_size]['size3'];
		}		
		
		// Print Gallery Header
		$header = find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<div class="gallery-header-wrapper">';
			echo '<h3 class="gallery-header-title title-color gdl-title">' . $header . '</h3>';
			echo '<div class="header-gimmick"></div>';
			echo '<div class="clear"></div>';
			echo '</div>';				
		}
		
		$gallery_post = get_posts(array('post_type' => 'gallery', 'name'=>$gallery_page, 'numberposts'=> 1));
		
		$slider_xml_string = get_post_meta($gallery_post[0]->ID,'post-option-gallery-xml', true);
		$slider_xml_dom = new DOMDocument();

		if( $page_background == 'No' ){
			echo "<div class='sixteen columns'>";
		}			
		
		echo "<div class='page-bkp-frame-wrapper gallery'>";
		echo "<div class='page-bkp-frame'>";
		
		if( !empty( $slider_xml_string ) ){
			$slider_xml_dom->loadXML($slider_xml_string);	
			foreach( $slider_xml_dom->documentElement->childNodes as $slider ){
				$title = find_xml_value($slider, 'title');
				$link_type = find_xml_value($slider, 'linktype');				
				$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), $item_size);
				$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);		
				
				echo '<div class="' . $gallery_class  . '">';
				
				if( $link_type == 'Link to URL' ){
					$link = find_xml_value( $slider, 'link');	
					echo '<a href="' . $link . '">';
					echo '<img class="gdl-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
					echo '</a>';
				}else if( $link_type == 'Lightbox' ){
					$image_full = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
					echo '<a data-rel="prettyPhoto[bkpGallery]" href="' . $image_full[0] . '"  title="">';
					echo '<img class="gdl-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
					echo '</a>';
				}else{
					echo '<img class="gdl-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
				}
				
				
				echo '</div>';

			}
		}
		
		echo '<div class="clear"></div>';
		echo '</div>'; // bkp-frame
		echo '</div>'; // bkp-frame-wrapper
		
		if( $page_background == 'No' ){
			echo "</div>";
		}				
		
	}
	
	// Print the slider item
	$slider_div_size_num_class = array(
		"element1-4" => array("width"=>"220", "width2"=>"145", "width3"=>'220'),
		"element1-3" => array("width"=>"300", "width2"=>"200", "width3"=>'220'),
		"element1-2" => array("width"=>"460", "width2"=>"310", "width3"=>'220'),
		"element2-3" => array("width"=>"620", "width2"=>"420", "width3"=>'460'),
		"element3-4" => array("width"=>"700", "width2"=>"475", "width3"=>'460'),
		"element1-1" => array("width"=>"940", "width2"=>"640", "width3"=>'460'));
	function print_slider_item($item_xml){

		global $sidebar;
		global $slider_div_size_num_class;
	
		$xml_size = find_xml_value($item_xml, 'size');
		
		echo '<div class="slider-wrapper">';
		
		if( $sidebar == "no-sidebar" ){
			$slider_width = $slider_div_size_num_class[$xml_size]['width'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$slider_width = $slider_div_size_num_class[$xml_size]['width2'];
		}else if( $sidebar == "both-sidebar" ){
			$slider_width = $slider_div_size_num_class[$xml_size]['width3'];
		}
		
		$slider_height = find_xml_value($item_xml, 'height');
		if( !empty($slider_width) && !empty($slider_height) ){
			$xml_size = $slider_width . 'x' . $slider_height;
		}else{
			$xml_size = '940x500';
		}

		switch(find_xml_value($item_xml,'slider-type')){
		
			case 'Flex Slider': 
				print_flex_slider(find_xml_node($item_xml,'slider-item'), $xml_size); 
				break;		
				
			case 'Carousel Slider': 
				print_carousel_slider(find_xml_node($item_xml,'slider-item'), $xml_size); 
				break;
				
		}
		
		echo "</div>";
	}
	
	// Post Slider
	function print_post_slider_item($item_xml){
	
		wp_reset_query();
		
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		$show_caption = find_xml_value($item_xml, 'show-caption');
		
		$category = find_xml_value($item_xml, 'category');
		$category = ($category == 'All')? '': $category;
		
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'category' );
			$category = $category_term->slug;
		}	
		
		$postslider_xml = "<single-item><Post-Slider>";
		$postslider_xml = $postslider_xml . create_xml_tag('size', find_xml_value($item_xml, 'size'));
		$postslider_xml = $postslider_xml . create_xml_tag('height', find_xml_value($item_xml, 'height'));
		$postslider_xml = $postslider_xml . create_xml_tag('slider-type', find_xml_value($item_xml, 'slider-type'));
		$postslider_xml = $postslider_xml . "<slider-item>";

		query_posts(array('post_type'=>'post', 'category_name'=>$category, 'posts_per_page'=>$num_fetch, 'meta_key' => '_thumbnail_id' ));	
		
		while( have_posts() ){
			the_post();
			
			$postslider_xml = $postslider_xml . "<slider>";
			$postslider_xml = $postslider_xml . create_xml_tag('image', get_post_thumbnail_id(get_the_ID()) );
			$postslider_xml = $postslider_xml . create_xml_tag('linktype', 'Link to URL' );
			$postslider_xml = $postslider_xml . create_xml_tag('link', htmlspecialchars(get_permalink()) );
			if( $show_caption == "Yes" ){
				$postslider_xml = $postslider_xml . create_xml_tag('title', htmlspecialchars(get_the_title()) );
				$postslider_xml = $postslider_xml . create_xml_tag('caption', htmlspecialchars(mb_substr(get_the_excerpt(), 0, $num_excerpt)) );
			}
			$postslider_xml = $postslider_xml . "</slider>";
			
		}		
		
		$postslider_xml = $postslider_xml . "</slider-item>";
		$postslider_xml = $postslider_xml . "</Post-Slider></single-item>";
		
		$slider_xml_val = new DOMDocument();
		$slider_xml_val->loadXML($postslider_xml);
		foreach( $slider_xml_val->documentElement->childNodes as $slider_item_xml){
			print_slider_item($slider_item_xml);
		}
		
	}
	
	// Print Accordion
	function print_accordion_item($item_xml){
	
		$tab_xml = find_xml_node($item_xml, 'tab-item');

		$header = find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<div class="accordion-header-wrapper">';
			echo '<h3 class="accordion-header-title title-color gdl-title">' . $header . '</h3>';
			echo '<div class="header-gimmick mr0"></div>';
			echo '<div class="clear"></div>';
			echo '</div>';				
			
		}
		
		echo "<div class='bkp-frame-wrapper'>";
		echo "<div class='bkp-frame p20'>";
		
		echo "<ul class='gdl-accordion'>";
		
		foreach($tab_xml->childNodes as $accordion){
		
			echo "<li class='gdl-divider'>";
			echo "<h2 class='accordion-head title-color gdl-title'>";
			echo "<span class='accordion-head-image'></span>";
			echo find_xml_value($accordion, 'title') . "</h2>";
			echo "<div class='accordion-content' >";
			echo do_shortcode(html_entity_decode(find_xml_value($accordion, 'caption'))) . '</div>';
			echo "</li>";
			
		}
		
		echo "</ul>";

		echo "</div>"; //bkp-frame-wrapper
		echo "</div>"; //bkp-frame				
	}
	
	// Print Divider
	function print_divider($item_xml){
		$margin_top = find_xml_value($item_xml, 'margin-top');
		$margin_bottom = find_xml_value($item_xml, 'margin-bottom');
		
		echo '<div class="divider" style="margin-top:' . $margin_top . 'px; margin-bottom:' . $margin_bottom . 'px "; ></div>';
		
	}
	
	// Print Message Box
	function print_message_box($item_xml){
		$box_color = find_xml_value($item_xml, 'color');
		$box_title = find_xml_value($item_xml, 'title');
		$box_content = html_entity_decode(find_xml_value($item_xml, 'content'));
		echo '<div class="message-box-wrapper ' . $box_color . '">';
		echo '<div class="message-box-title">' . $box_title . '</div>';
		echo '<div class="message-box-content">' . do_shortcode($box_content) . '</div>';
		echo '</div>';
	}
	
	// Print Toggle Box
	function print_toggle_box_item($item_xml){
	
		$tab_xml = find_xml_node($item_xml, 'tab-item');
		
		$header = find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<div class="toggle-box-header-wrapper">';
			echo '<h3 class="toggle-box-header-title title-color gdl-title">' . $header . '</h3>';
			echo '<div class="header-gimmick mr0"></div>';
			echo '<div class="clear"></div>';
			echo '</div>';			
			
		}

		echo "<div class='bkp-frame-wrapper'>";
		echo "<div class='bkp-frame p20'>";
		
		echo "<ul class='gdl-toggle-box'>";
		
		foreach($tab_xml->childNodes as $toggle_box){
			
			$active = find_xml_value($toggle_box, 'active');
			
			echo "<li class='gdl-divider'>";
			echo "<h2 class='toggle-box-head title-color gdl-title'>";
			echo "<span class='toggle-box-head-image";
			echo ($active == 'Yes')? ' active':'';
			echo "' ></span>" . find_xml_value($toggle_box, 'title') . '</h2>';
			echo "<div class='toggle-box-content"; 
			echo ($active == 'Yes')? ' active': '';
			echo "' id='toggle-box-content' >";
			echo do_shortcode(html_entity_decode(find_xml_value($toggle_box, 'caption'))) . '</div>';
			echo "</li>";
		
		}
		
		echo "</ul>";

		echo "</div>"; //bkp-frame-wrapper
		echo "</div>"; //bkp-frame		
		
	}

	// Print Tab
	function print_tab_item($item_xml){
	
		$tab_xml = find_xml_node($item_xml, 'tab-item');
		$num = 0;
		$tab_title = array();
		$tab_content = array();
		
		foreach($tab_xml->childNodes as $toggle_box){
			$tab_title[$num] = find_xml_value($toggle_box, 'title');
			$tab_content[$num] = html_entity_decode(find_xml_value($toggle_box, 'caption'));
			$num++;
		}

		echo "<div class='bkp-frame-wrapper'>";
		echo "<div class='bkp-frame  p20'>";
		
		echo "<ul class='tabs gdl-divider'>";
		
		for($i=0; $i<$num; $i++){
			echo '<li><a data-href="tab-' . $i . '" class="gdl-title gdl-divider ';
			echo ( $i == 0 )? 'active':'';
			echo '" >' . $tab_title[$i] . '</a></li>';
		}
		
		echo "</ul>";
		echo "<ul class='tabs-content'>";
		
		for($i=0; $i<$num; $i++){
			echo '<li data-href="tab-' . $i . '" class="';
			echo ( $i == 0 )? 'active':'';  
			echo '" >' . do_shortcode($tab_content[$i]) . '</li>';
		}
		
		echo "</ul>";

		echo "</div>"; //bkp-frame-wrapper
		echo "</div>"; //bkp-frame		
		
	}
	
	// Print price item
	function print_price_item($item_xml){
	
		global $gdl_admin_translator;
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_read_more = get_option(THEME_SHORT_NAME.'_translator_read_more_price', 'Read More');
		}else{
			$translator_read_more = __('Read More','gdl_front_end');
		}	

		$price_item_number = find_xml_value($item_xml, 'item-number');
		$price_item_category = find_xml_value($item_xml, 'category');
		$price_item_category = ($price_item_category == 'All')? '': $price_item_category;
		
		$price_posts = get_posts(array('post_type'=>'price_table', 'price-table-category'=>$price_item_category, 
			'numberposts'=>$price_item_number));
			
		foreach($price_posts as $price_post){
			$best_price = get_post_meta( $price_post->ID, 'price-table-best-price', true );
			$best_price = ($best_price == 'Yes')? 'active': '';
			
			echo '<div class="percent-column1-' . $price_item_number . ' gdl-divider">';
			echo '<div class="price-item ' . $best_price . '">';
			echo '<div class="price-tag">' . get_post_meta( $price_post->ID, 'price-table-price-tag', true ) . '</div>';
			echo '<div class="price-title">' . $price_post->post_title . '</div>';
			
			echo '<div class="price-content">';
			echo do_shortcode( $price_post->post_content );
			echo '</div>';
			
			$price_url = get_post_meta( $price_post->ID, 'price-table-option-url', true );
			if( !empty($price_url) ){
				echo '<div class="price-button">';
				echo '<a class="gdl-button" href="' . $price_url . '">' . $translator_read_more . '</a>';
				echo '</div>';
			}
			echo '</div>';
			echo '</div>';
		}
	}

	// Print contact form
	function print_contact_form($item_xml){
		global $post;
		
		global $gdl_admin_translator;
		
		if( $gdl_admin_translator == 'enable' ){
			$gdl_name_string = get_option(THEME_SHORT_NAME.'_translator_name_contact_form', 'Name');
			$gdl_name_error_string = get_option(THEME_SHORT_NAME.'_translator_name_error_contact_form', 'Please enter your name');
			$gdl_email_string = get_option(THEME_SHORT_NAME.'_translator_email_contact_form', 'Email');
			$gdl_email_error_string = get_option(THEME_SHORT_NAME.'_translator_email_error_contact_form', 'Please enter a valid email address');
			$gdl_message_string = get_option(THEME_SHORT_NAME.'_translator_message_contact_form', 'Message');
			$gdl_message_error_string = get_option(THEME_SHORT_NAME.'_translator_message_error_contact_form', 'Please enter message');
			$gdl_submit_button = get_option(THEME_SHORT_NAME.'_translator_submit_contact_form','Submit');
		}else{
			$gdl_name_string = __('Name','gdl_front_end');
			$gdl_name_error_string =  __('Please enter your name','gdl_front_end');
			$gdl_email_string =  __('Email','gdl_front_end');
			$gdl_email_error_string =  __('Please enter a valid email address','gdl_front_end');
			$gdl_message_string =  __('Message','gdl_front_end');
			$gdl_message_error_string = __('Please enter message','gdl_front_end');
			$gdl_submit_button = __('Submit','gdl_front_end');
		}	

	?>
		<div class='bkp-frame-wrapper'>
		<div class='bkp-frame  p20'>
		
		<div class="contact-form-wrapper" id="gdl-contact-form">
			<form id="gdl-contact-form">
				<ol class="forms">
					<li><strong><?php echo $gdl_name_string; ?> *</strong>
						<input type="text" name="name" class="require-field" />
						<div class="error">* <?php echo $gdl_name_error_string; ?></div>
					</li>
					<li><strong><?php echo $gdl_email_string; ?> *</strong>
						<input type="text" name="email" class="require-field email" />
						<div class="error">* <?php echo $gdl_email_error_string; ?></div>
					</li>
					<li class="textarea"><strong><?php echo $gdl_message_string; ?> *</strong>
						<textarea name="message" class="require-field"></textarea>
						<div class="error">* <?php echo $gdl_message_error_string; ?></div> 
					</li>
					<li><input type="hidden" name="receiver" value="<?php echo find_xml_value($item_xml, 'email'); ?>"></li>
					<li class="sending-result" id="sending-result" ><div class="message-box-wrapper green"></div></li>
					<li class="buttons">
						<button type="submit" class="contact-submit button"><?php echo $gdl_submit_button; ?></button>
						<div class="contact-loading" id="contact-loading">
					</li>
				</ol>
			</form>
			<div class="clear"></div>
		</div>	
		
		</div> <!-- bkp-frame -->
		</div> <!-- bkp-frame-wrapper -->
	
	<?php
	}
	
	// Print stunning text
	function print_stunning_text($item_xml){
		
		$title = find_xml_value($item_xml, 'title');
		$caption = html_entity_decode(find_xml_value($item_xml, 'caption'));
		$button_title =  find_xml_value($item_xml, 'button-title');
		
		echo '<div class="bkp-frame-wrapper">';
		echo '<div class="bkp-frame">';
		
		echo '<div class="stunning-text-wrapper">';

		if( !empty($button_title) ){
			$button_margin = (int) find_xml_value($item_xml, 'button-top-margin');
			$button_margin = $button_margin;
			echo '<div class="stunning-text-button-wrapper" >';
			echo '<a class="stunning-text-button" style="margin-top:' . $button_margin . 'px;" href="' . find_xml_value($item_xml, 'button-link') . '" >';
			echo  $button_title . '</a>';
			echo '</div>'; 
		}
		
		echo '<div class="stunning-text-content-wrapper">';
		echo '<h1 class="stunning-text-title">' . $title . '</h1>';
		echo '<div class="stunning-text-caption">' . do_shortcode($caption) . '</div>';
		echo '</div>';
		
		echo '<div class="clear"></div>';
		
		echo '</div>'; // stunning text
		
		echo '</div>'; // bkp frame
		echo '</div>'; // bkp frame wrapper
	}
	
	$gdl_div_size_num_class = array("1/4" => "four columns", "1/3" => "one-third column", "1/2" => "eight columns", 
		"2/3" => "two-thirds column", "3/4" => "twelve columns", "1/1" => "sixteen columns");
	
	// Print Testimonial
	function print_testimonial($item_xml){
		
		$display_type = find_xml_value($item_xml, 'display-type');
		
		$header = find_xml_value($item_xml, 'header');
		
		if($display_type == 'Specific Testimonial'){
			if(!empty($header)){
				echo '<div class="testimonial-header-wrapper">';
				echo '<h3 class="testimonial-header-title title-color gdl-title">' . $header . '</h3>';
				echo '<div class="header-gimmick"></div>';
				echo '<div class="clear"></div>';
				echo '</div>';					
			}
		
			$header = find_xml_value($item_xml, 'header');
			$specific = find_xml_value($item_xml, 'specific');
			$posts = get_posts(array('post_type' => 'testimonial', 'name'=>$specific, 'numberposts'=> 1));

				
			echo '<div class="bkp-frame-wrapper">';
			echo '<div class="bkp-frame  p20">';
							
			echo '<div class="testimonial-content">';
			echo '<div class="testimonial-icon"></div>';
			echo $posts[0]->post_content;
			echo '</div>';
			
			echo '<div class="testimonial-author gdl-divider">';
			echo '<span class="testimonial-author-name">' . $posts[0]->post_title . ', </span>';
			echo '<span class="testimonial-author-position">'; 
			echo get_post_meta($posts[0]->ID, 'testimonial-option-author-position', true);
			echo '</span>';
			echo '</div>';
			
			echo "</div>"; //bkp-frame-wrapper
			echo "</div>"; //bkp-frame					

		}else{
		
			global $gdl_div_size_num_class;
		
			$item_size = find_xml_value($item_xml, 'item-size');
			$category = find_xml_value($item_xml, 'category');
			$category = ( $category == 'All' )? '': $category;
			$category_posts = get_posts(array('post_type'=>'testimonial', 'testimonial-category'=>$category, 'numberposts'=>100));
			
			echo '<div class="jcarousellite-nav"><div class="prev"></div><div class="next"></div></div>';
			
			if(!empty($header)){
				echo '<div class="testimonial-header-wrapper">';
				echo '<h3 class="testimonial-header-title title-color gdl-title">' . $header . '</h3>';
				echo '<div class="header-gimmick mr70"></div>';
				echo '<div class="clear"></div>';
				echo '</div>';						
			}else{
				echo '<div class="testimonial-no-header"></div>';
			}
			
			echo '<div class="jcarousellite"><ul>';
			
			foreach( $category_posts as $category_post){
				echo '<li class="four ' . $gdl_div_size_num_class[$item_size] .' mt0">';
				
				echo '<div class="bkp-frame-wrapper">';
				echo '<div class="bkp-frame p20">';
				
				echo '<div class="testimonial-content">';
				echo '<div class="testimonial-icon"></div>';
				echo $category_post->post_content;
				echo '</div>';
				
				echo '<div class="testimonial-author gdl-divider">';
				echo '<span class="testimonial-author-name">' . $category_post->post_title . ', </span>';
				echo '<span class="testimonial-author-position">';
				echo get_post_meta($category_post->ID, 'testimonial-option-author-position', true);
				echo '</span>';
				echo '</div>';
				
				echo "</div>"; //bkp-frame-wrapper
				echo "</div>"; //bkp-frame		
				
				echo '</li>';
			}
			
			echo '</ul></div>';
			
		}
		

	
	}

	// size is when no sidebar, side2 is use when 1 sidebar
	$port_div_size_num_class = array(
		"1/4" => array("class"=>"four columns", "size"=>"386x386", "size2"=>"386x386", "size3"=>"386x386"), 
		"1/3" => array("class"=>"one-third column", "size"=>"386x386", "size2"=>"386x386", "size3"=>"386x386"), 
		"1/2" => array("class"=>"eight columns", "size"=>"433x191", "size2"=>"426x188", "size3"=>"386x386"), 
		"1/1" => array("class"=>"sixteen columns", "size"=>"886x300", "size2"=>"586x198"));
		
	// Print portfolio
	function print_portfolio($item_xml){
		
		wp_reset_query();

		// Translator words
		global $gdl_admin_translator;	
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_read_more = get_option(THEME_SHORT_NAME.'_translator_read_more', '[...]');
		}else{
			$translator_read_more = __('[...]','gdl_front_end');
		}	
		
		global $paged;
		global $sidebar;
		global $port_div_size_num_class;
		global $class_to_num;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// get the item class and size from array
		$port_size = find_xml_value($item_xml, 'item-size');
		
		$item_class = $port_div_size_num_class[$port_size]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size2'];
		}else if( $sidebar == "both-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size3'];
		}
		
		// get the portfolio meta value
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category_val = ( $category == 'All' )? '': $category;
		
		$filterable = find_xml_value($item_xml, 'filterable');
		$filter_class = '';
		
		// portfolio header
		if(!empty($header)){
			echo '<div class="blog-header-wrapper">';
			echo '<h3 class="portfolio-header-title title-color gdl-title">' . $header . '</h3>';
			echo '<div class="header-gimmick"></div>';
			echo '<div class="clear"></div>';
			echo '</div>';			
		}

		// category list for filter
		if( $filterable == "Yes" ){
			$category_lists = get_category_list('portfolio-category', $category_val);
			echo '<ul id="portfolio-item-filter">';
			foreach($category_lists as $category_list){
				
				$category_term = get_term_by( 'name', $category_list , 'portfolio-category');
				$category_slug = $category_term->slug;
				echo '<li><a href="#" class="gdl-button" data-value="' . $category_slug . '">' . $category_list . '</a></li>';
			
			}
			echo '<br class="clear">';
			echo "</ul>";
		}
		
		// start fetching database
		global $post, $wp_query;
		
		if( !empty($category_val) ){
			$category_val = str_replace('&', '&amp;', $category_val);
			$category_term = get_term_by( 'name', $category_val , 'portfolio-category');
			$category_val = $category_term->slug;
		}
		
		$post_temp = query_posts(array('post_type'=>'portfolio', 'paged'=>$paged, 
			'portfolio-category'=>$category_val, 'posts_per_page'=>$num_fetch));
			
		echo '<div id="portfolio-item-holder" class="portfolio-item-holder">';
		while( have_posts() ){
			
			the_post();
					
			// get the category for filter
			$item_categories = get_the_terms( $post->ID, 'portfolio-category' );
			$category_slug = " ";
			if( !empty($item_categories) ){
				foreach( $item_categories as $item_category ){
					$category_slug = $category_slug . $item_category->slug . ' ';
				}
			}
			
			// start printing data
			echo '<div class="' . $item_class . $category_slug . ' portfolio-item">'; 
			echo '<div class="bkp-frame-wrapper">';
			echo '<div class="position-relative">';
			echo '<div class="bkp-frame">';
			$thumbnail_types = get_post_meta( $post->ID, 'post-option-thumbnail-types', true);
			
			if( $thumbnail_types == "Image" ){
				
				$image_type = get_post_meta( $post->ID, 'post-option-featured-image-type', true);
				$image_type = empty($image_type)? "Link to Current Post": $image_type; 
				$thumbnail_id = get_post_thumbnail_id();
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
				$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
				
				
				if( $image_type == "Link to Current Post" ){
					$hover_thumb = "hover-link";
					$pretty_photo = "";
					$permalink = get_permalink();
				}else if( $image_type == "Link to URL"){
					$hover_thumb = "hover-link";
					$pretty_photo = "";
					$permalink = get_post_meta( $post->ID, 'post-option-featured-image-url', true );
				}else if( $image_type == "Lightbox to Current Thumbnail" ){	
					$hover_thumb = "hover-zoom";
					$pretty_photo = ' data-rel="prettyPhoto" ';
					$permalink = wp_get_attachment_image_src( $thumbnail_id, 'full' );
					$permalink = $permalink[0];
				}else if( $image_type == "Lightbox to Picture" ){
					$hover_thumb = "hover-zoom";
					$pretty_photo = ' data-rel="prettyPhoto" ';
					$permalink = get_post_meta( $post->ID, 'post-option-featured-image-url', true );	
					$permalink = $permalink;
				}else{
					$hover_thumb = "hover-video";
					$pretty_photo = ' data-rel="prettyPhoto" ';
					$permalink = get_post_meta( $post->ID, 'post-option-featured-image-url', true );	
					$permalink = $permalink;				
				}
				
				
				echo '<div class="portfolio-thumbnail-image">';
				echo '<div class="overflow-hidden">';
				echo '<a href="' . $permalink . '" ' . $pretty_photo . ' title="' . get_the_title() . '">';
				echo '<span class="portfolio-thumbnail-image-hover">';
				echo '<span class="' . $hover_thumb . '"></span>';
				echo '</span>';
				echo '</a>';
								
				if( !empty($thumbnail[0]) ){
					echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				}
				echo '</div>';
				echo '</div>';
			
			}else if( $thumbnail_types == "Video" ){
				
				$video_link = get_post_meta( $post->ID, 'post-option-thumbnail-video', true); 
				echo '<div class="portfolio-thumbnail-video">';
				echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
				echo '</div>';
			
			}else if ( $thumbnail_types == "Slider" ){

				$slider_xml = get_post_meta( $post->ID, 'post-option-thumbnail-xml', true); 
				$slider_xml_dom = new DOMDocument();
				$slider_xml_dom->loadXML($slider_xml);
				
				echo '<div class="portfolio-thumbnail-slider">';
				echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
				echo '</div>';			
			
			}
			
			echo '<div class="portfolio-thumbnail-context">';
			// portfolio title
			if( find_xml_value($item_xml, "show-title") == "Yes" ){
				echo '<h2 class="portfolio-thumbnail-title port-title-color gdl-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			}
			
			// portfolio excerpt
			if( find_xml_value($item_xml, "show-excerpt") == "Yes" ){			
				echo '<div class="portfolio-thumbnail-content">' . mb_substr( get_the_excerpt(), 0, $num_excerpt );
				echo '<a class="blog-continue-reading" href="' . get_permalink() . '">' . $translator_read_more . '</a>';
				echo '</div>';
			}

			// portfolio info
			/*
			echo '<div class="portfolio-thumbnail-info post-info-color gdl-divider gdl-info">';
			
			echo '<div class="portfolio-thumbnail-date">' . get_the_time('d M Y') . '</div>';
			$portfolio_tag = get_the_term_list( $post->ID, 'portfolio-tag', '', ', ' , '' );		
			echo '<div class="portfolio-thumbnail-tag">';
			echo '<span class="portfolio-thumbnail-tag-title">' . __('Tag ','gdl_front_end') . '</span>' . $portfolio_tag;
			echo '</div>';		
			echo '<div class="clear"></div>';
			
			echo '</div>'; // portfolio info
			*/
			
			echo '<div class="clear"></div>';
			echo '</div>'; // thumbnail context
			
			
			echo '</div>'; // bkp frame wrapper
			echo '</div>'; // position relative
			echo '</div>'; // bkp frame
			
			echo '</div>'; // portfolio item
			
		}
		echo "</div>";
		echo '<div class="clear"></div>';
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}
		
	}

	// Print nested page
	function print_page_item($item_xml){
		
		wp_reset_query();

		// Translator words
		global $gdl_admin_translator;	
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_read_more = get_option(THEME_SHORT_NAME.'_translator_read_more', '[...]');
		}else{
			$translator_read_more = __('[...]','gdl_front_end');
		}	
		
		global $paged;
		global $sidebar;
		global $port_div_size_num_class;	
		global $class_to_num;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// get the item class and size from array
		$port_size = find_xml_value($item_xml, 'item-size');
		
		// get the item class and size from array
		$item_class = $port_div_size_num_class[$port_size]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size2'];
		}

		// get the page meta value
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');	

		// page header
		if(!empty($header)){
			echo '<div class="blog-header-wrapper">';
			echo '<h3 class="portfolio-header-title title-color gdl-title">' . $header . '</h3>';
			echo '<div class="header-gimmick"></div>';
			echo '<div class="clear"></div>';
			echo '</div>';			
		}
		
		global $post;
		
		$post_temp = query_posts(array('post_type'=>'page', 'paged'=>$paged, 'post_parent'=>$post->ID, 'posts_per_page'=>$num_fetch ));
		
		echo '<div id="portfolio-item-holder" class="portfolio-item-holder">';
		while( have_posts() ){
			
			the_post();
			
			// start printing data
			echo '<div class="' . $item_class . ' portfolio-item">'; 
			
			echo '<div class="bkp-frame-wrapper">';
			echo '<div class="position-relative">';
			echo '<div class="bkp-frame">';			

			$thumbnail_id = get_post_thumbnail_id();
			if( $thumbnail_id ){
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
				$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
				
				$hover_thumb = "hover-link";
				$permalink = get_permalink();
					
				echo '<div class="portfolio-thumbnail-image">';
				echo '<div class="overflow-hidden">';
				echo '<a href="' . $permalink . '" title="' . get_the_title() . '">';
				echo '<span class="portfolio-thumbnail-image-hover">';
				echo '<span class="' . $hover_thumb . '"></span>';
				echo '</span>';
				echo '</a>';
								
				if( !empty($thumbnail[0]) ){
					echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				}
				
				echo '</div>';
				echo '</div>';
			}
			echo '<div class="portfolio-thumbnail-context">';
			
			// page title
			if( find_xml_value($item_xml, "show-title") == "Yes" ){
				echo '<h2 class="portfolio-thumbnail-title port-title-color gdl-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';	
			}
			
			// page excerpt
			if( find_xml_value($item_xml, "show-excerpt") == "Yes" ){			
				echo '<div class="portfolio-thumbnail-content">' . mb_substr( get_the_excerpt(), 0, $num_excerpt );
				echo '<a class="blog-continue-reading" href="' . get_permalink() . '">' . $translator_read_more . '</a>';
				echo '</div>';			
			}
			
			echo '</div>';

			echo '</div>'; // bkp frame wrapper
			echo '</div>'; // position relative
			echo '</div>'; // bkp frame
			
			echo '</div>';

		}

		echo "</div>";
		echo '<div class="clear"></div>';
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}		
		
	}
?>