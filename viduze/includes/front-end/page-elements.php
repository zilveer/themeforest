<?php

	/*
	*	CrunchPress Page Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Nasir Hayat
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each page item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/

	// Print the item size <div> with it's class
	function print_item_size($item_size, $addition_class=''){
		global $cp_item_row_size, $post;
		$cp_item_row_size = (empty($cp_item_row_size))? 0: $cp_item_row_size;
		if($cp_item_row_size >= 1){
			$cp_item_row_size = 0;
		}
		
		$sidebar = get_post_meta ( $post->ID, 'page-option-sidebar-template', true );
		
        $sidebar_class = '';
        if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
            $sidebar_class = "sidebar-included " . $sidebar;
        } else if ($sidebar == "both-sidebar") {
            $sidebar_class = "both-sidebar-included";
        }
        	$left_sidebar = get_post_meta ( $post->ID, "page-option-choose-left-sidebar", true );
			$right_sidebar = get_post_meta ( $post->ID, "page-option-choose-right-sidebar", true );
		
		switch($item_size){
			case 'element1-4':
				echo '<article class="span3 ' . $addition_class . ' ">';
				$cp_item_row_size += 1/4; 
				break;
			case 'element1-3':
				echo '<article class="span4 ' . $addition_class . '">';
				$cp_item_row_size += 1/3; 
				break;
			case 'element1-2':
				echo '<article class="span6 ' . $addition_class . '">';
				$cp_item_row_size += 1/2; 
				break;
			case 'element2-3':
				echo '<article class="span8' . $addition_class . '">';
				$cp_item_row_size += 2/3; 
				break;
			case 'element3-4':
				echo '<article class="span9' . $addition_class . '">';
				$cp_item_row_size += 3/4; 
				break;
			case 'element1-1':
				echo '<article class="span12 ' . $addition_class . '">';
				$cp_item_row_size += 1; 
				break;	
		}
		
	}
	
	/////////// Print Columns //////////
	
	function print_column_item($item_xml){
		echo do_shortcode(html_entity_decode(find_xml_value($item_xml,'column-text')));
	}

	if( $cp_is_responsive ){
		$gallery_div_size_num_class = array(
			'1/4' => array( 'class'=>'four columns', 'size'=>'390x250', 'size2'=>'390x250', 'size3'=>'390x250'),
			'1/3' => array( 'class'=>'one-third column', 'size'=>'300x150', 'size2'=>'300x150', 'size3'=>'300x150'),
			'1/2' => array( 'class'=>'eight columns', 'size'=>'460x390', 'size2'=>'460x390', 'size3'=>'460x390'),
			'1/16' => array( 'class'=>'gallery', 'size'=>'210x210', 'size2'=>'135x135', 'size3'=>'210x210'),
		); 	
	}else{
		$gallery_div_size_num_class = array(
			'1/4' => array( 'class'=>'four columns', 'size'=>'210x210', 'size2'=>'135x135', 'size3'=>'210x210'),
			'1/3' => array( 'class'=>'one-third column', 'size'=>'290x290', 'size2'=>'190x190', 'size3'=>'210x210'),
			'1/2' => array( 'class'=>'eight columns', 'size'=>'450x450', 'size2'=>'300x300', 'size3'=>'210x210'),
		); 			
	}
	
	
	/////////// Print Slider Items //////////
	
	function print_slider_item($item_xml){
		
		$xml_size = find_xml_value($item_xml, 'size');
		if( $xml_size == 'full-width' ){
			
		}else{
			echo '<div class="slider-wrapper">';
		}
		
		$slider_width = find_xml_value($item_xml, 'width');
		$slider_height = find_xml_value($item_xml, 'height');
		if( !empty($slider_width) && !empty($slider_height) ){
			$xml_size = $slider_width . 'x' . $slider_height;
		}else{
			$xml_size = '980x360';
		}

		switch(find_xml_value($item_xml,'slider-type')){
		
			case 'Nivo Slider': 
				print_nivo_slider(find_xml_node($item_xml,'slider-item'), $xml_size); 
				break;
			
			case 'Flex Slider': 
				print_flex_slider(find_xml_node($item_xml,'slider-item'), $xml_size); 
				break;
		}
		
		if( find_xml_value($item_xml, 'size') == 'full-width' ){
		
		}else{
		      echo "</div>";
		}
		
	}
	
	/////////// Print Content Item //////////
	
	function print_content_item($item_xml){
		wp_reset_query();
		
		if(have_posts()){
			while(have_posts()){
				the_post(); 
				the_content();
			}
		}
	}
	
	/////////// Print Accordions ////////// 
	
	function print_accordion_item($item_xml){
	
		$tab_xml = find_xml_node($item_xml, 'tab-item');

		$header = find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<div class="title-holder accordion-title "><h2>'.$header.'</h2></div>';
		}
		
		
		/*echo "<ul class='cp-accordion'>";*/
		echo '<div id="accordion2" class="accordion faq_accordion">';
		foreach($tab_xml->childNodes as $accordion){
			
	
			echo '
	
		
			<div class="accordion-group">
					<div class="accordion-heading">
					<a href="#'.str_replace(' ', '', find_xml_value($accordion, 'title')).'" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle inactive">
						 <span class="toggle_faq"><i class="icon-chevron-right"></i> </span>  <h3>	<strong> '.find_xml_value($accordion, 'title').' </strong> </h3>
					</a>
					</div>
					<div style="height: 0px;" class="accordion-body collapse" id="'.str_replace(' ', '', find_xml_value($accordion, 'title')).'">
						<div class="accordion-inner">
						<p> '.do_shortcode(html_entity_decode(find_xml_value($accordion, 'caption'))) .' </p>
						</div>
					</div>
				</div>
			
	';
	
		/*	echo "<li class='cp-divider'>";
			echo "<h2 class='accordion-head title-color cp-title'>";
			echo "<span class='accordion-head-image'></span>";
			echo find_xml_value($accordion, 'title') . "</h2>";
			echo "<div class='accordion-content' >";
			echo do_shortcode(html_entity_decode(find_xml_value($accordion, 'caption'))) . '</div>';
			echo "</li>";*/
			
		}
		echo '</div>';
		/*echo "</ul>";*/
	
	}
	
	/////////// Print Item Devider //////////
	
	function print_divider($item_xml){
		echo '<section class="row-fluid">';
	}
	
	/////////// Print Message Box //////////
	
	function print_message_box($item_xml){
		$box_color = find_xml_value($item_xml, 'color');
		$box_title = find_xml_value($item_xml, 'title');
		$box_content = html_entity_decode(find_xml_value($item_xml, 'content'));
		echo '<div class="message-box-wrapper ' . $box_color . '">';
		echo '<div class="message-box-title">' . $box_title . '</div>';
		echo '<div class="message-box-content">' . $box_content . '</div>';
		echo '</div>';
	}
	
	/////////// Print Toggles //////////
	
	function print_toggle_box_item($item_xml){
		$tab_xml = find_xml_node($item_xml, 'tab-item');
		$header = find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<h3 class="toggle-box-header-title title-color cp-title">' . $header . '</h3>';
		}
		echo "<ul class='cp-toggle-box'>";
		foreach($tab_xml->childNodes as $toggle_box){
			$active = find_xml_value($toggle_box, 'active');
			echo "<li class='cp-divider'>";
			echo "<h2 class='toggle-box-head title-color cp-title'>";
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
	}

	/////////// Print Tabs //////////
	function print_tab_item($item_xml){
	
		$tab_xml = find_xml_node($item_xml, 'tab-item');
		$tab_widget_title =  html_entity_decode(find_xml_value($item_xml,'tab-widget'));
		$num = 0;
		$tab_title = array();
		$tab_content = array();
		$tab_title[$num] = find_xml_value($item_xml, 'title');
		echo '<div class="tabbable abilities_tab">';
		if( !empty($tab_widget_title) ){
		echo '<div class="title-holder"><h3>';
		echo  $tab_widget_title;
		echo '</h3></div>';
		}
		foreach($tab_xml->childNodes as $toggle_box){
			$tab_title[$num] = find_xml_value($toggle_box, 'title');
			$tab_content[$num] = html_entity_decode(find_xml_value($toggle_box, 'caption'));
			$num++;
		}
		echo '<ul id="myTab" class="nav nav-tabs">';
		for($i=0; $i<$num; $i++){
			echo '<li class="';
			echo ( $i == 0 )? 'active':'';
			echo '">';
			echo'<a href="#'. str_replace(' ', '-', $tab_title[$i]).'" data-toggle="tab">' . $tab_title[$i] . '</a>';
			echo '</li>';
		}
		echo "</ul>";
	
		echo '<div class="tab-content">';
		for($i=0; $i<$num; $i++){
			echo '<div id="' . str_replace(' ', '-', $tab_title[$i]) . '" class="tab-pane fade ';
			echo ( $i == 0 )? 'active in':'';  
			echo '" ><p>' . do_shortcode($tab_content[$i]) . '</p></div>';
		}
		echo "</div>";	
	}
	
	/////////// Print Price Items //////////
	
	function print_price_item($item_xml){

		$price_item_number = find_xml_value($item_xml, 'item-number');
		$price_item_category = find_xml_value($item_xml, 'category');
		$price_item_category = ($price_item_category == 'All')? '': $price_item_category;
		$price_posts = get_posts(array('post_type'=>'price_table', 'price-table-category'=>$price_item_category, 
			'numberposts'=>$price_item_number));
		foreach($price_posts as $price_post){
			$best_price = get_post_meta( $price_post->ID, 'price-table-best-price', true );
			$best_price = ($best_price == 'Yes')? 'active': '';
			echo '<div class="cp-price-item span3">';
			echo '<div class="percent-column1-' . $price_item_number . ' cp-divider">';
			echo '<div class="price-item ' . $best_price . '">';
			echo '<div class="price-tag">' . sprintf(__('%s','crunchpress'), get_post_meta( $price_post->ID, 'price-table-price-tag', true ) ) . '</div>';

			echo '<div class="price-title">' . $price_post->post_title . '</div>';
			
			echo '<div class="price-content">';
			echo do_shortcode( $price_post->post_content );
			echo '</div>';
			
			$price_url = sprintf(__('%s','crunchpress'), get_post_meta( $price_post->ID, 'price-table-option-url', true ) ) ;
			if( !empty($price_url) ){
				echo '<div class="price-button">';
				echo '<a class="cp-button" href="' . $price_url . '">' . __('Read More','cp_front_end') . '</a>';
				echo '</div>';
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	}
	
	/////////// Print Services Column //////////
	
	function print_column_service($item_xml){
		$column_service_img_id = find_xml_value($item_xml, 'image');
		$column_service_image = wp_get_attachment_image_src($column_service_img_id, 'full');
		$column_service_title = find_xml_value($item_xml, 'title');
		$column_service_link = find_xml_value($item_xml, 'morelink');
		$service_widget_style = find_xml_value($item_xml, 'service-widget-style');
		$column_service_caption = html_entity_decode(find_xml_value($item_xml, 'caption'));
		$alt_text = get_post_meta($column_service_img_id , '_wp_attachment_image_alt', true);
		if($service_widget_style == 'Style-1'){
		echo '<div class="column-service-content style-1">';
		echo '<h3 class="column-service-title cp-title">' . $column_service_title . '</h3>';
		if(!empty($column_service_image)){
			echo "<img src='" . $column_service_image[0] . "' alt='" . $alt_text ."' class='column-service-image'/>";
		}
		echo '<p>'.do_shortcode($column_service_caption).'';
		echo '</p>';
		if(!empty($column_service_link)){echo'<a class="txt-btn" href="'.$column_service_link.'">More+</a>';}
		echo '</div>';
		}else{
			echo '<div class="column-service-content style-2">';
		if(!empty($column_service_image)){
			echo "<img src='" . $column_service_image[0] . "' alt='" . $alt_text ."' class='column-service-image'/>";
		}
		echo '<h3 class="column-service-title cp-title">' . $column_service_title . '</h3>';
		echo '<p>'.do_shortcode($column_service_caption).'';
		echo '</p>';
		if(!empty($column_service_link)){echo'<a class="cp-button" href="'.$column_service_link.'">View More...</a>';}
		echo '</div>';
	
	    }
	}

	/////////// Print Contact From //////////
	
	function print_contact_form($item_xml){
		global $post;
		$cp_name_string = get_option(THEME_NAME_S.'_translator_name_contact_form', 'Name');
		$cp_name_error_string = get_option(THEME_NAME_S.'_translator_name_error_contact_form', 'Please enter your name');
		$cp_email_string = get_option(THEME_NAME_S.'_translator_email_contact_form', 'Email');
		$cp_email_error_string = get_option(THEME_NAME_S.'_translator_email_error_contact_form', 'Please enter a valid email address');
		$cp_message_string = get_option(THEME_NAME_S.'_translator_message_contact_form', 'Message');
		$cp_message_error_string = get_option(THEME_NAME_S.'_translator_message_error_contact_form', 'Please enter message');
		$cp_message_subject_string = get_option(THEME_NAME_S.'_translator_message_subject_contact_form', 'Subject');
		?>

<div class="contact-form-wrapper" id="cp-contact-form">

  <header class="header-style">
      <h2 class="h-style"><?php _e('Send us an email','crunchpress')?></h2>
  </header>
  <div class="widget-bg">
  
 <!-- <div class="form">
                <ul class="row-fluid">
                  <li class="span4">
                    <input type="text" placeholder="Name" class="input-block-level" id="name" name="name">
                  </li>
                  <li class="span4">
                    <input type="text" placeholder="E-mail" class="input-block-level" id="email" name="email">
                  </li>
                  <li class="span4">
                    <input type="text" placeholder="Website" class="input-block-level" id="website" name="website">
                  </li>
                </ul>
                <textarea placeholder="Comments" rows="" cols="" name="comments"></textarea>
                <button name="submit" class="form-btn hover-style">Submit</button>
              </div>-->
              
              
  <form id="cp-contact-form">
  <div class="forms">
  <ul class="row-fluid">
     <li class="span4">
        <input type="text" name="name" placeholder="<?php echo $cp_name_string; ?>" class="require-field name input-block-level" />
        <div class="error">* <?php echo $cp_name_error_string; ?></div>
      </li>
     <li class="span4">
        <input type="text" placeholder="<?php echo $cp_email_string; ?>" name="email" class="require-field email input-block-level" />
        <div class="error">* <?php echo $cp_email_error_string; ?></div>
      </li>
       <li class="span4">
        <input type="text" placeholder="<?php echo $cp_message_subject_string; ?>" name="subject" class="require-field subject input-block-level" />
      </li>
      <li class="textarea">
        <textarea  cols="10" rows="5" name="message" class="require-field" placeholder="<?php echo $cp_message_string; ?>"></textarea>
        <div class="error">* <?php echo $cp_message_error_string; ?></div>
      </li>
      <li>
        <input type="hidden" name="receiver" value="<?php echo find_xml_value($item_xml, 'email'); ?>">
      </li>
     <li class="sending-result" id="sending-result" ><div></div></li>
      <li class="buttons">
        <button type="submit" class="contact-submit button form-btn hover-style"><?php echo get_option(THEME_NAME_S.'_translator_submit_contact_form','Submit'); ?></button>
        <div class="contact-loading" id="contact-loading"></div>
      </li>
    </ul>
  </form>
  <div class="clearfix"></div>
</div>
</div>
<?php
		}
	
	/////////// Print Text Widget //////////
	
	function print_text_widget($item_xml){
		
		$title = find_xml_value($item_xml, 'title');
		$caption = html_entity_decode(find_xml_value($item_xml, 'caption'));
		$button_title =  find_xml_value($item_xml, 'button-title');
		echo '<h2>' . $title . '</h2>';
		echo '<P>' . do_shortcode($caption) . '</p>';
	}
	
	
	/////////// Print Testimonials //////////
	
	function print_testimonial($item_xml){
		
		$display_type = find_xml_value($item_xml, 'display-type');
		$header = find_xml_value($item_xml, 'header');
		if($display_type == 'Specific Testimonial'){
			echo '<div class="tastimonialcon">';
			if(!empty($header)){
				echo '<h3 class="testimonial-header-title title-color cp-title">' . $header . '</h3>';
			}
			$item_size = find_xml_value($item_xml, 'item-size');
			$header = find_xml_value($item_xml, 'header');
			$specific = find_xml_value($item_xml, 'specific');
			$posts = get_posts(array('post_type' => 'testimonial', 'name'=>$specific, 'numberposts'=> 1));
			global $cp_div_size_num_class;
			echo '<div class="' . $cp_div_size_num_class[$item_size] . '">';
			echo '<div class="testimonial-content">';
			echo '<div class="testimonial-icon"></div>';
			echo $posts[0]->post_content;
			echo '</div>';
			$position = printf(__('%s','crunchpress'), get_post_meta( $price_post->ID, 'testimonial-option-author-position', true ) );
			echo '<div class="testimonial-author cp-divider">';
			echo '<span class="testimonial-author-name">' . $posts[0]->post_title . '</span>';
			if( !empty( $position ) ){
				echo '<span class="testimonial-author-position">, '; 
				echo $position;
				echo '</span>';
			}
			echo '</div>';
			echo '</div>'; // columns (cp-div-size-num-class)
			echo '</div>';

		}else{
		
			global $cp_div_size_num_class, $item_size;
			
			echo $cp_div_size_num_class[$item_size];
			
			$item_size = find_xml_value($item_xml, 'item-size');
			$category = find_xml_value($item_xml, 'category');
			$category = ( $category == 'All' )? '': $category;
			$category_posts = get_posts(array('post_type'=>'testimonial', 'testimonial-category'=>$category, 'numberposts'=>100));
			
			echo '<figure class="testimonial">';
			if(!empty($header)){
				echo '<div class="title-holder"><h3>' . $header . '</h3></div>';
			}else{
				echo '<div class="title-holder"><h3>'.__('Testimonials','crunchpress').'</h3></div>';
			}
			echo '<ul class="testimonial_slider">';
			foreach( $category_posts as $category_post){ 
			  $item_size = '75x75';
			  $thumbnail_id = get_post_thumbnail_id( $category_post->ID );
			  $thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			  $alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			?>
            <li>
              <div class="testi-text">
                <p><?php echo $category_post->post_content; ?></p>
              </div>
              <div class="texti-author">
                <?php if (!empty ($thumbnail[0])) { echo '<img class="testimonail-logo" src="'. $thumbnail[0] .'" alt="'. $alt_text .'"/>';  } ?>
                <figure class="logo-text">
                  <p class="name"><?php echo '<a href="'.post_permalink().'">' .$category_post->post_title .'</a>'?></p>
                  <?php  printf(__('%s','crunchpress'), get_post_meta( $category_post->ID, 'testimonial-option-author-position', true ) );?>
                </figure>
              </div>
            </li>
<?php 
				}
			  echo '</ul></figure>';
			}
		}





	// Print nested page
	function print_page_item($item_xml){
		
		wp_reset_query();
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
		}else{
			$item_size = $port_div_size_num_class[$port_size]['size3'];
		}

		// get the page meta value
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');	

		// page header
		if(!empty($header)){
			echo '<h3 class="portfolio-header-title title-color cp-title">' . $header . '</h3>';
		}
		global $post;
		$post_temp = query_posts(array('post_type'=>'page', 'paged'=>$paged, 'post_parent'=>$post->ID, 'posts_per_page'=>$num_fetch ));
		// get the portfolio size
		$port_wrapper_size = $class_to_num[find_xml_value($item_xml, 'size')];
		$port_current_size = 0;
		$port_size =  $class_to_num[$port_size];
		
		$port_num_have_bottom = sizeof($post_temp) % (int)($port_wrapper_size/$port_size);
		$port_num_have_bottom = ( $port_num_have_bottom == 0 )? (int)($port_wrapper_size/$port_size): $port_num_have_bottom;
		$port_num_have_bottom = sizeof($post_temp) - $port_num_have_bottom;
		
		echo '<section id="portfolio-item-holder" class="portfolio-item-holder">';
		while( have_posts() ){
			the_post();
			// start printing data
			echo '<figure class="' . $item_class . ' mt0 pt25 portfolio-item">'; 
			$image_type = get_post_meta( $post->ID, 'post-option-featured-image-type', true);
			$image_type = empty($image_type)? "Link to Current Post": $image_type; 
			$thumbnail_id = get_post_thumbnail_id();
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			
			$hover_thumb = "hover-link";
			$pretty_photo = "";
			$permalink = get_permalink();
			

			if( !empty($thumbnail[0]) ){
				echo '<div class="portfolio-thumbnail-image">';
				echo '<div class="overflow-hidden">';
				echo '<a href="' . $permalink . '" ' . $pretty_photo . ' title="' . get_the_title() . '">';
				echo '<span class="portfolio-thumbnail-image-hover">';
				echo '<span class="' . $hover_thumb . '"></span>';
				echo '</span>';
				echo '</a>';
				echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				echo '</div>'; //overflow hidden
				echo '</div>'; //portfolio thumbnail image						
			}
			
			
			echo '<div class="portfolio-thumbnail-context">';
			// page title
			if( find_xml_value($item_xml, "show-title") == "Yes" ){
				echo '<h2 class="portfolio-thumbnail-title port-title-color cp-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			}
			// page excerpt
			if( find_xml_value($item_xml, "show-excerpt") == "Yes" ){			
				echo '<div class="portfolio-thumbnail-content">' . mb_substr( get_the_excerpt(), 0, $num_excerpt ) . '</div>';
			}
			// read more button
			if( find_xml_value($item_xml, "read-more") == "Yes" ){
				echo '<a href="' . get_permalink() . '" class="portfolio-read-more cp-button">' . __('Read More','cp_front_end') . '</a>';
			}
			echo '</div>';
			// print space if not last line
			if($port_current_size < $port_num_have_bottom){
				echo '<div class="portfolio-bottom"></div>';
				$port_current_size++;
			}
			echo '</figure>';

		}

		echo "</section>";
		echo '<div class="clearfix"></div>';
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}		
		
	}
	

function print_team_widget($item_xml) {
	$heading = find_xml_value($item_xml, 'team-widget-header');
	$subheading = find_xml_value($item_xml, 'team-widget-sub-header');
	$noitem = find_xml_value($item_xml, 'team-widget-num');	
	$teamcat = find_xml_value($item_xml, 'team-widget-category');		
 ?>
<section class="team_widget span12">
  <section class="feature_title mbtm2">
    <?php 
          	if(!empty($heading)){
				echo ' <h2>' . $heading . '<span> '.$subheading.' </span> </h2>';
			}
          ?>
  </section>
  <?php 
		  
			$category = find_xml_value($item_xml, 'category');
			$category = ( $category == 'All' )? '': $category;
			$category_posts = get_posts(array('post_type'=>'team', 'testimonial-category'=>$category, 'numberposts'=>100));
			
			echo '<ul class="team_widegt">';
			foreach( $category_posts as $category_post){ 
			  $thumbnail_id = get_post_thumbnail_id( $category_post->ID );
			  $thumbnail = wp_get_attachment_image_src( $thumbnail_id , '123x123' );
			  $alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			?>
              <li>
                <div class="span5 first">
                  <div class="m_img">
                    <?php if (!empty ($thumbnail[0])) { echo '<img src="'. $thumbnail[0] .'" alt="'. $alt_text .'"/>';  } ?>
                    <a href="#" id="email_ico"> Email </a> <a href="#" id="social_ico"> </a> </div>
                </div>
                <div class="m_n_desig span7">
                  <h3> <?php echo '<a href="'.post_permalink().'">' .$category_post->post_title .'</a>'?> </h3>
                  <span class="desig">
                  <?php  printf(__('%s','crunchpress'), get_post_meta( $category_post->ID, '_jobtitle', true ) );?>
                  </span> </div>
                <div class="social_team mttm2 span12 first">
                 <a href="<?php echo get_post_meta( $category_post->ID, '_facebook', true );?>" class="span4 first"><i class="icon-facebook"></i> </a>
                 <a href="<?php echo get_post_meta( $category_post->ID, '_skype', true );?>" class="span4"> <i class="icon-skype"></i> </a>
                 <a href="<?php echo get_post_meta( $category_post->ID, '_twitter', true );?>" class="span4"> <i class="icon-twitter"></i> </a> </div>
              </li>
              <?php 
				}
			  echo '</ul>';
		  ?>
</section>
<?php }

function print_timeline_item($item_xml) {   
    $heading = find_xml_value($item_xml, 'heading');
	$subheading = find_xml_value($item_xml, 'subheading');
	$noitem = find_xml_value($item_xml, 'noitem');
	$logoheading_1 = find_xml_value($item_xml, 'logo-1');	
    $logoheading_2 = find_xml_value($item_xml, 'logo-2');
	$image_logo_id_1 = find_xml_value($item_xml, 'image-logo-1');
	$image_logo_img_1 = wp_get_attachment_image_src($image_logo_id_1, 'full');
	$image_logo_id_2 = find_xml_value($item_xml, 'image-logo-2');
	$image_logo_img_2 = wp_get_attachment_image_src($image_logo_id_2, 'full');
			
 ?>

<!-- Start of timeline -->
<section class="span12">
  <section class="feature_title mbtm3">
    <?php if (!empty ($heading)){ echo '<h2>'.$heading . '<span> '.$subheading. '</span></h2>'; } ?>
  </section>
  <section class="time_line span9 first">
    <div class="span12">
      <section class="timeline">
        <div id="timeline">
          <div class="tl_bar"></div>
          <div class="tl_bar2"></div>
          <?php 	
						$mypost = array( 'post_type' => 'timeline_item');
						$loop = new WP_Query( $mypost );
					
						echo '  <ul class="tabAnchor">';
						while ( $loop->have_posts() ) : $loop->the_post();  
						$timeline_year=get_post_meta( get_the_ID(), 'timelineDate', true );
						echo "<li><a href='#".$timeline_year."'>".$timeline_year."</a></li>";
						endwhile; 
						echo ' </ul>'; 
						
						
						while ( $loop->have_posts() ) : $loop->the_post();  
						$thumbnail_id = get_post_thumbnail_id();
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full');
						$timeline_year=get_post_meta( get_the_ID(), 'timelineDate', true );
						
						
						echo '<div id="'.$timeline_year.'">';
						echo '<p class="tl_title"> <span class="cname">'.get_the_title().'</span></p>';
						echo '<p>' .the_content(). '</p>';
						endwhile; 
						
					?>
                            </div>
                          </section>
                        </div>
                      </section>
                      <section class="span3 first timeline-logos">
                        <div class="ico_list"> <?php if(!empty ($image_logo_img_1)) { echo  '<img src="'.$image_logo_img_1[0].'" alt="logo" />'; }else{echo '<div class="timeline-logo1"></div>';} ?>
                          <p><?php echo $logoheading_1 ?></p>
                        </div>
                        <div class="ico_list">  <?php if(!empty ($image_logo_img_2)) { echo  '<img src="'.$image_logo_img_2[0].'" alt="logo" />'; }else{echo '<div class="timeline-logo2"></div>';} ?>
                          <p> <?php echo $logoheading_2 ?> </p>
                        </div>
                      </section>
                    </section>
                    <!-- end of timeline -->

<?php } 


function print_client_logos($item_xml) {
	
	
	  $client_block_title = find_xml_value($item_xml, 'client-block-title');
	 
		$company_logo_img_id = find_xml_value($item_xml, 'image-2');		
		$company_logo_image = wp_get_attachment_image_src($company_logo_img_id, 'full');
		$company_logo_link = find_xml_value($item_xml, 'logo-link');
		
		$company_logo_img_id_2 = find_xml_value($item_xml, 'image-2');		
		$company_logo_image2 = wp_get_attachment_image_src($company_logo_img_id_2, 'full');
		$company_logo_link_2 = find_xml_value($item_xml, 'logo-link-2');
		
		$company_logo_img_id_3 = find_xml_value($item_xml, 'image-3');
		$company_logo_image3 = wp_get_attachment_image_src($company_logo_img_id_3, 'full');
		$company_logo_link_3 = find_xml_value($item_xml, 'logo-link-3');
		
		$company_logo_img_id_4 = find_xml_value($item_xml, 'image-4');
		$company_logo_image4 = wp_get_attachment_image_src($company_logo_img_id_4, 'full');
		$company_logo_link_4 = find_xml_value($item_xml, 'logo-link-4');
       
	    $company_logo_img_id_5 = find_xml_value($item_xml, 'image-5');
		$company_logo_image5 = wp_get_attachment_image_src($company_logo_img_id_5, 'full');
		$company_logo_link_5 = find_xml_value($item_xml, 'logo-link-5');
		$alt_text = get_post_meta($company_logo_img_id , '_wp_attachment_image_alt', true);
		
	echo '<section id="client_slider_Section" class="mbtm client_slider">';
    echo  '<section class="row-fluid">';
    echo '<section id="client_header">';
	echo '<h4> '.$client_block_title.' </h4>';
	echo '</section>';
		
		if(!empty($company_logo_image)){
			echo '<ul id="client_slider" class="client_slider_wrapper">';
			
			echo '<li><a href="'.$company_logo_link.'">';
			echo "<img class='grayscale' src='" . $company_logo_image[0] . "' alt='" . $alt_text ."' />";
			echo '</a></li>';
			
			echo '<li><a href="'.$company_logo_link_2.'">';
			echo "<img class='grayscale' src='" . $company_logo_image2[0] . "' alt='" . $alt_text ."' />";
			echo '</a></li>';
			
			echo '<li><a href="'.$company_logo_link_3.'">';
			echo "<img class='grayscale' src='" . $company_logo_image3[0] . "' alt='" . $alt_text ."' />";
			echo '</a></li>';
			
			echo '<li><a href="'.$company_logo_link_4.'">';
			echo "<img class='grayscale' src='" . $company_logo_image4[0] . "' alt='" . $alt_text ."' />";
			echo '</a></li>';
			
			echo '<li><a href="'.$company_logo_link_5.'">';
			echo "<img class='grayscale' src='" . $company_logo_image5[0] . "' alt='" . $alt_text ."' />";
			echo '</a></li>';
			echo '</ul>';
            echo '</section>';
    		echo '</section>';
		}	


	
 ?>
<?php }
function print_team_block($item_xml)	 {
?>
<section class="row-fluid">
  <?php $team_header = find_xml_value($item_xml, 'team-header');
		   if (!empty ($team_header)) {
		   echo '<div class="title-holder">';
			  echo '<h3>'.$team_header.'</h3>';
		   echo '</div>';
		   }
	        $team_num = find_xml_value($item_xml, 'team-num');
	   	    $category = find_xml_value($item_xml, 'team-category');
			$category = ( $category == 'All' )? '': $category;
			$category_posts = get_posts(array('post_type'=>'team', 'team-category'=>$category, 'numberposts'=>$team_num));
			echo '<section class="row-fluid">';
			foreach( $category_posts as $category_post){ 
			  $thumbnail_id = get_post_thumbnail_id( $category_post->ID );
			  $thumbnail = wp_get_attachment_image_src( $thumbnail_id , '277x199' );
			  $alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			?>
  <figure class="our-team span3">
    <div class="team-img">
      <?php if (!empty ($thumbnail[0])) { echo '<img class="greyScale" src="'. $thumbnail[0] .'" alt="'. $alt_text .'"/>';  } ?>
    </div>
    <div class="team-heading">
      <h4> <?php echo '<a href="'.post_permalink().'">' .$category_post->post_title .'</a>'?> </h4>
      <h5><?php  printf(__('%s','crunchpress'), get_post_meta( $category_post->ID, '_jobtitle', true ) );?></h5>
      <div class="hidden-phone socialicons_class">
        <?php 
		$facebook = get_post_meta( $category_post->ID, '_facebook', true );
		$linkedin = get_post_meta( $category_post->ID, '_linkedin', true );
		$twitter = get_post_meta( $category_post->ID, '_twitter', true );
		$youtube = get_post_meta( $category_post->ID, '_youtube', true );
		if(!empty($linkedin)) {
        echo '<a class="social_active social_linkedin" href="'.$linkedin.'" title="Visit Google Plus page"> <span class="da-animate da-slideFromLeft" style="display: inline;"></span></a>'; }
		if(!empty($facebook)) {
        echo '<a class="social_active social_facebook" href="'.$facebook.'" title="Visit Facebook page"> <span class="da-animate da-slideFromRight" style="display: block;"></span></a>';}
		if(!empty($twitter)) {
        echo '<a class="social_active social_twitter" href="'.$twitter.'" title="Visit Twitter page"> <span class="da-animate da-slideFromBottom" style="display: none;"></span></a>';}
		if(!empty($youtube)) {
        echo '<a class="social_active social_youtube" href="'.$youtube.'" title="Visit Youtube"> <span class="da-animate da-slideFromLeft" style="display: inline;"></span></a> </div>';}
		?>
    </div>
  </figure>
  <?php }?>
</section>
<?php } 
		
function print_service_widgets_1($item_xml) {
      $service_widget_col  = find_xml_value($item_xml, 'service-widget-col');
		
		if ($service_widget_col == "4 Column") {
		   $service_widget_class = "span3";
		   $service_widget_count = "4";
		} else {
		   $service_widget_class= "span4";
		   $service_widget_count = "3";
		}
		
        $column_service_img_id_1 = find_xml_value($item_xml, 'widget-image-1');
		$column_service_image_1 = wp_get_attachment_image_src($column_service_img_id_1, 'full');
		$column_service_title_1 = find_xml_value($item_xml, 'widget-widget-title-1');
		$column_service_content_1 = find_xml_value($item_xml, 'widget-content');
		$column_service_caption_1 = html_entity_decode(find_xml_value($item_xml, 'widget-caption-1'));
		$alt_text = get_post_meta($column_service_img_id_1 , '_wp_attachment_image_alt', true);
		
		if (!empty ($section_heading)) {
		echo '<div class="title-holder">';
        echo '<h2>'. $section_heading.'</h2>';
        echo'</div>';
		}
	    echo '<section id="feature_holder" class="mbtm">';
        echo '<section class="row-fluid">';
		for( $i=1 ; $i<=$service_widget_col; $i++ ){ 
		 $column_service_image = wp_get_attachment_image_src( find_xml_value($item_xml, 'widget-image-'.$i.'') , 'full');
		 if (!empty ($column_service_image)) {
		 echo ' <figure class="feature '.$service_widget_class.'">';
		 echo '<a href="'.find_xml_value($item_xml, 'morelink-'.$i.'').'"> ';
		 echo '<img src="'.$column_service_image[0].'" alt="image" class="service-item-img" />';
         echo ' <h4 class="service-widget-1-tile" >'.find_xml_value($item_xml, 'title-'.$i.'');'</h4>';
		 echo '</a>';
         echo '</figure>';
		 }
         }
        echo '</section>';
        echo '</section>';
		
		
	
	
} ?>
<?php function print_service_widgets_2($item_xml)  {
	    $service_widget_col  = find_xml_value($item_xml, 'service-widget-2-col');
		
		if ($service_widget_col == "4 Column") {
		   $service_widget_class = "span3";
		   $service_widget_count = "4";
		} else {
		   $service_widget_class= "span4";
		   $service_widget_count = "3";
		}
		
        $column_service_img_id_1 = find_xml_value($item_xml, 'widget-2-image-1');
		$column_service_image_1 = wp_get_attachment_image_src($column_service_img_id_1, 'full');
		$column_service_title_1 = find_xml_value($item_xml, 'widget-2-title-1');
		$column_service_content_1 = find_xml_value($item_xml, 'content');
		$column_service_caption_1 = html_entity_decode(find_xml_value($item_xml, 'widget-2-caption-1'));
		$alt_text = get_post_meta($column_service_img_id_1 , '_wp_attachment_image_alt', true);
		
	    $section_heading = find_xml_value($item_xml, 'heading');
		if (!empty ($section_heading)) {
		echo '<div class="title-holder">';
        echo '<h2>'. $section_heading.'</h2>';
        echo'</div>';
		}
		echo '<section class="mbtm" id="service_holder">';
        echo '<section class="row-fluid">';
			
		for( $i=1 ; $i<=$service_widget_col; $i++ ){ 
		 $column_service_image = wp_get_attachment_image_src( find_xml_value($item_xml, 'widget-2-image-'.$i.'') , 'full');
		 echo '<figure class="service-feature '.$service_widget_class.'">'; 
		 echo '<section class="service-container">';
		 if (!empty ($column_service_image)) {
		 echo '<img src="'.$column_service_image[0].'" alt="image" class="service-item-img" />';
		 }
         echo '<h4>';
		 echo  find_xml_value($item_xml, 'widget-2-title-'.$i.'');
		 echo '</h4>';
		 echo '<p>';
		 echo html_entity_decode(find_xml_value($item_xml, 'widget-2-caption-'.$i.''));
		 echo '</p>';
		 echo '</section>';
         echo '<a class="view_more" href="'.find_xml_value($item_xml, 'morewidget-2-link-'.$i.'').'">View More</a>';
	     echo '</figure>';
         }
				
        echo '</section>';
        echo '</section>';
	   
		

 } 
// Print gallery
	function print_gallery_item($item_xml){
	
		global $gallery_div_size_num_class;
		global $sidebar;		
		
		$gallery_div_size_num_class = array(
			'1/4' => array( 'class'=>'span3', 'size'=>'378x310', 'size2'=>'135x135', 'size3'=>'210x210'),
			'1/3' => array( 'class'=>'span4', 'size'=>'378x290', 'size2'=>'190x190', 'size3'=>'210x210'),
			'1/2' => array( 'class'=>'span6', 'size'=>'570x470', 'size2'=>'300x300', 'size3'=>'210x210'),
		); 	

		$header = find_xml_value($item_xml, 'header');
		$subheader = find_xml_value($item_xml, 'subheader');
	
		$gallery_page = find_xml_value($item_xml, 'gallery');
		$gallery_size = find_xml_value($item_xml, 'item-size');
		
		$gallery_class = $gallery_div_size_num_class[$gallery_size]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $gallery_div_size_num_class[$gallery_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $gallery_div_size_num_class[$gallery_size]['size2'];
		}else{
			$item_size = $gallery_div_size_num_class[$gallery_size]['size3'];
		}
		
		if(!empty($header)){
			echo '<div class="feature_title gallery-title">';
				echo '<h2>'. $header.'<span>'.$subheader.'</span></h2>';
			echo'</div>';
		}	
       
		$gallery_post = get_posts(array('posts_per_page' => 1, 'post_type' => 'gallery', 'name'=>$gallery_page, 'numberposts'=> 2));
		
		if ( is_home() || is_front_page() ) {$home_classes="img-holder slide-1";} else {$home_classes="";}
		
		
		echo '<div class="cp-gallery-item">';
		
		$slider_xml_string = get_post_meta($gallery_post[0]->ID,'post-option-gallery-xml', true);
		$slider_xml_dom = new DOMDocument();
		if( !empty( $slider_xml_string ) ){
			$slider_xml_dom->loadXML($slider_xml_string);	
			$count = 0;
			
			foreach( $slider_xml_dom->documentElement->childNodes as $slider ){
				$count++;
				
				if ($gallery_size == "1/4" ) {
				if ($count%4 == 1) { $first_class ="first"; } else { $first_class ="";} ;
				}elseif ($gallery_size == "1/2" ) {
				if ($count%2 == 1) { $first_class ="first"; } else { $first_class ="";} ;	
				}else {
				if ($count%3 == 1) { $first_class ="first"; } else { $first_class ="";} ;	
				}
				
				$link_type = find_xml_value($slider, 'linktype');	
				
				$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), $item_size);
				$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);	
    

				echo '<div class="' . $gallery_class . ' '.$first_class.' mt0 mb20" >';
				echo '<div class="gallery-thumbnail-image '.$home_classes.'">';
				if( $link_type == 'Link to URL' ){
					$link = find_xml_value( $slider, 'link');	
					echo '<a href="' . $link . '">';
					echo '<img class="cp-gallery-image " src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
					echo '</a>';
				}else if( $link_type == 'Lightbox' ){
					$image_full = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
					echo '<a data-rel="prettyPhoto[bkpGallery]" href="' . $image_full[0] . '"  title="">';
					echo '<img class="cp-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
					echo '<span class="gal-zoom"></span>';
					echo '</a>';
				}else{
					echo '<img class="cp-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
				}				
				echo '</div>'; // gallery-thumbnail-image
				echo '</div>';

			}
		}	
		
		
		echo '</div>';
	
}
function print_service_block($item_xml) {		
		
		$section_heading = find_xml_value($item_xml, 'block-heading');
		$service_widget_col  = find_xml_value($item_xml, 'service-widget-col');
		
		if (!empty ($section_heading)) {
		echo '<div class="title-holder">';
        echo '<h2>'. $section_heading.'</h2>';
        echo'</div>';
		}
	    echo '<section class="row-fluid">';
        echo '<figure class="service-product span4">';
        echo '
                 <ul>';

 	for( $i=1 ; $i<=6; $i++ ){ 
		 $column_service_image = wp_get_attachment_image_src( find_xml_value($item_xml, 'image-'.$i.'') , 'full');
		 echo '<li>';
		 echo '<section class="span2 offset1">'.find_xml_value($item_xml, 'icon-'.$i.'').'</section>';
		 echo '<section class="span9"><a  href="'.find_xml_value($item_xml, 'morelink-'.$i.'').'">'.find_xml_value($item_xml, 'title-'.$i.'').'</a>';
	     echo '<p>'.html_entity_decode(find_xml_value($item_xml, 'caption-'.$i.'')).'</p>';
		 echo '</section>';
		 echo ' </li>';
	     }
         echo '</ul>';
		 echo '</figure>';
         echo '</section>';
}
	
		
function print_portfolio2($item_xml) { 

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
		}else{
			$item_size = $port_div_size_num_class[$port_size]['size3'];
		}
		
		// get the portfolio meta value
		$header = find_xml_value($item_xml, 'header');
		$subheader = find_xml_value($item_xml, 'subheader');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category_val = ( $category == 'All' )? '': $category;
		
		
		 $port_size = find_xml_value($item_xml, 'item-size');
			$port_div_size_num_class = array(
			"1/4" => array("class"=>"four columns", "size"=>"210x121", "size2"=>"135x85", "size3"=>"210x135"), 
			"1/3" => array("class"=>"one-third column", "size"=>"290x180", "size2"=>"190x116", "size3"=>"210x135"), 
			"1/2" => array("class"=>"eight columns", "size"=>"450x290", "size2"=>"300x190", "size3"=>"210x135"), 
			"1/1" => array("class"=>"sixteen columns", "size"=>"620x225", "size2"=>"320x150", "size3"=>"180x135"));
			
		$item_class = $port_div_size_num_class[$port_size]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size2'];
		}else{
			$item_size = $port_div_size_num_class[$port_size]['size3'];
		}	
		
		if ($port_size  == "1/2" ) {
		    $port_col  = "two_col";
	    }elseif ($port_size  == "1/4" ) {
		    $port_col  = "four_col";
	    }else  {
		    $port_col  = "";
	    }
		
		
		
?>

<!-- Start of Feature Work Section -->
<section id="featured_work" class="mbtm">
  <section class="container">
    <?php if ( !empty($header)){
			echo '<section class="feature_title mbtm">';
			echo '<h2>'.$header.' <span> '.$subheader.'</span> </h2>';
			echo '</section>';
	    	}
		  
		 ?>
    <section class="row-fluid">
      <Section class="span3"> 
        <!-- Filteration -->
        <div id="filter" class="sidebar_widget">
          <?php 
		    $category_lists = get_category_list('portfolio-category', $category_val);
			$is_first = 'active';
		/*	$view_all_portfolio = find_xml_value($item_xml, 'view-all-portfolio');
			if($view_all_portfolio != 'No'){
				$view_all_portfolio_link = get_permalink( get_page_by_title( $view_all_portfolio ) );
				echo '<a class="view-all" href="' . $view_all_portfolio_link . '">' . __('View All','cp_front_end') . '</a>';
			}*/
			echo '<ul id="work-filter" class="category-list">';
			foreach($category_lists as $category_list){
				
				$category_term = get_term_by( 'name', $category_list , 'portfolio-category');
				if( !empty( $category_term ) ){
					$category_slug = '.'.$category_term->slug;
				}else{
					$category_slug = '*';
					$category_list = 'All Projects';
				}
				echo '<li class="' . $is_first . '"><a href="#"  data-filter="' . $category_slug . '">' . $category_list . '</a> </li>';
				
				$is_first  = '';
			}
			echo "</ul>";
		  ?>
        </div>
        <!-- end of Filteration -->
        
        <?php
		    $display_testi = find_xml_value($item_xml, 'testi-display');
			$category = find_xml_value($item_xml, 'category');
			$category = ( $category == 'All' )? '': $category;
			$category_posts = get_posts(array('post_type'=>'testimonial', 'testimonial-category'=>$category, 'numberposts'=>100));
			
			if ($display_testi == "Yes" ){
			echo '<figure class="testimonial sidebar_widget">';
			if(!empty($header)){
				echo '<div class="title-holder-1"><h4>' . $header . '</h4></div>';
			}else{
				echo '<div class="title-holder-1"><h4>'.__('What our clients say?','crunchpress').'</h3></div>';
			}
			echo '<ul class="testimonial_slider">';
			foreach( $category_posts as $category_post){ 
			  $thumbnail_id = get_post_thumbnail_id( $category_post->ID );
			  $thumbnail = wp_get_attachment_image_src( $thumbnail_id , '75x75' );
			  $alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			?>
        <li>
          <div class="testi-text"><?php echo '"' . substr($category_post->post_content,0,60); ?></div>
          <div class="texti-author">
            <?php if (!empty ($thumbnail[0])) { echo '<img class="testimonail-logo" src="'. $thumbnail[0] .'" alt="'. $alt_text .'"/>';  } ?>
            <figure class="logo-text">
              <p class="name"><?php echo '<a href="'.post_permalink().'">' .$category_post->post_title .'</a>'?></p>
              <?php  printf(__('%s','crunchpress'), get_post_meta( $category_post->ID, 'testimonial-option-author-position', true ) );?>
            </figure>
          </div>
        </li>
        <?php 
				}
			  echo '</ul></figure>';
			};
			?>
        <!-- Testimonial Widget -->
  
        <!-- end of Testimonial Widget --> 
      </section>
      <!-- Feature work Listing -->
      <Section class="span9">
        <ul class="work-list <?php echo $port_col; ?>">
          <?php // start fetching database
		global $post, $wp_query;
		
		  
		
		if( !empty($category_val) ){
			$category_term = get_term_by( 'name', $category_val , 'portfolio-category');
			$category_val = $category_term->slug;
		}
		
		$post_temp = query_posts(array('post_type'=>'portfolio', 'paged'=>$paged, 
			'portfolio-category'=>$category_val, 'posts_per_page'=>$num_fetch));
			
			while( have_posts() ){
			
			the_post();
			
		    	$thumbnail_types = get_post_meta( $post->ID, 'post-option-thumbnail-types', true);
				$image_type = get_post_meta( $post->ID, 'post-option-featured-image-type', true);
				$image_type = empty($image_type)? "Link to Current Post": $image_type; 
				$thumbnail_id = get_post_thumbnail_id();
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
				$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
				
				$item_categories = get_the_terms( $post->ID, 'portfolio-category' );
		     	$category_slug = " ";
			    if( !empty($item_categories) ){
				foreach( $item_categories as $item_category ){
					$category_slug = $category_slug . $item_category->slug . ' ';
				}
			}
			
			?>
          <li class="featurework <?php echo $category_slug; ?>">
            <figure>
              <div class="block_holder">
                <div class="hover_block flgallery"> <a href="#"><?php echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>'; ?></a>
                  <div class="row_1a box"></div>
                  <div class="row_1b box"></div>
                  <div class="row_1c box"></div>
                  <div class="row_1d box"></div>
                  <div class="row_1e box"></div>
                  <div class="row_2a box"></div>
                  <div class="row_2b box"></div>
                  <div class="row_2c box"></div>
                  <div class="row_2d box"></div>
                  <div class="row_2e box"></div>
                  <div class="row_3a box"></div>
                  <div class="row_3b box"></div>
                  <div class="row_3c box"></div>
                  <div class="row_3d box"></div>
                  <div class="row_3e box"></div>
                  <div class="row_4a box"></div>
                  <div class="row_4b box"></div>
                  <div class="row_4c box"></div>
                  <div class="row_4d box"></div>
                  <div class="row_4e box"></div>
                  <div class="hover_info">
                    <div class="mask">
                      <?php 			
						    $thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );	
								
					    ?>
                      <div class="gallery"> <a href="<?php echo $thumbnail_full[0]?>" data-gal="prettyPhoto[gallery1]">
                        <?php _e('SHOW GALLERY IN FULL SCREEN','crunchpress') ?>
                        </a> </div>
                      <?php echo '<p><a href="' . get_permalink() . '">' . get_the_title() . '</a></p>'; ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </figure>
          </li>
          <?php } ?>
        </ul>
        <!-- End of Feature work Listing -->
        <!--Portfolio Navigation-->
          <?php if( find_xml_value($item_xml, "pagination") == "Yes" ){	
		    echo '<div class="pagination blog-pager p-flio-pgr">';
				pagination();
			echo '</div>';
  		 } ?>
        <!--/Portfolio Navigation-->
      </section>
    </section>
  </section>
</section>
<!-- End of Feature Work Section -->

<?php } 

