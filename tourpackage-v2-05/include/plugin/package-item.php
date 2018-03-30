<?php
	// Print package
	function print_package_item($item_xml){
		$header = find_xml_value($item_xml, 'header');
		print_item_header( $header, '', '', find_xml_value($item_xml, 'icon-class') );
		
		global $paged, $sidebar_type, $package_div_size_num_class;
		if(empty($paged)){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }
		
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		$pagination = find_xml_value($item_xml, 'pagination');
		
		$item_type = find_xml_value($item_xml, 'item-size');
		$item_class = $package_div_size_num_class[$item_type]['class'];
		$item_size = $package_div_size_num_class[$item_type][$sidebar_type];
		
		$category = find_xml_value($item_xml, 'category', false);
		$category = ( $category == 'All' )? '': $category;

		$order = find_xml_value($item_xml, 'order');
		$orderby = find_xml_value($item_xml, 'orderby');

		// start fetching database
		query_posts(array('post_type'=>'package', 'paged'=>$paged, 'order'=>$order, 'orderby'=>$orderby,
			 'package-category'=>$category, 'posts_per_page'=>$num_fetch  ));
		echo '<div class="package-item-holder">'; 
		if( $item_type == '1/4 Grid Style' || $item_type == '1/3 Grid Style' || 
			$item_type == '1/2 Grid Style' || $item_type == '1/1 Grid Style'){

			print_widget_package($item_class, $item_size, $item_type, $num_excerpt);
		}else if( $item_type == '1/4 Grid 2nd Style' || $item_type == '1/3 Grid 2nd Style' || 
			$item_type == '1/2 Grid 2nd Style' || $item_type == '1/1 2nd Grid Style'){

			print_grid2_package($item_class, $item_size, $item_type, $num_excerpt);
		}else if( $item_type == '1/1 Medium Thumbnail' ){
			print_medium_package($item_class, $item_size, $num_excerpt);
		}
		echo '</div>';
		
		echo '<div class="clear"></div>';
		if( $pagination == "Yes" ){	
			pagination();
		}	
		
		wp_reset_query();
	}
	
	function get_package_date($start_date, $end_date, $date_format){
		$return_date = '';
		
		if( !empty($start_date) ){
			$date_otime = strtotime($start_date);
			$return_date = date_i18n($date_format, $date_otime);
		}
		
		if( !empty($end_date) ){
			$date_otime = strtotime($end_date);
			
			if( !empty($return_date) ){
				$return_date .= ' - ' . date_i18n($date_format, $date_otime);
			}else{
				$return_date .= date_i18n($date_format, $date_otime);
			}
		}		
		
		return $return_date;	
	}
	
	function print_package_thumbnail( $post_id, $item_size, $last_minute = 'normal-type', $last_text = 'Read More' ){
		$thumbnail_id = get_post_thumbnail_id( $post_id );
		$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
		$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
		if( !empty($thumbnail) ){
			echo '<div class="package-media-wrapper gdl-image">';
			
			echo '<a href="' . get_permalink() . '">';
			echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
			
			if( !empty($last_minute) && !empty($last_text) ){
				echo '<div class="package-ribbon-wrapper">';
				echo '<div class="package-type ' . $last_minute . '">';
				echo $last_text;
				echo '</div>';
				echo '<div class="clear"></div>';
				echo '<div class="package-type-gimmick"></div>';
				echo '<div class="clear"></div>';
				echo '</div>';
			}
			echo '</a>';
			
			echo '</div>';	// package-media-wrapper
		}	
	}

	function print_single_package_thumbnail( $post_id, $item_size, $last_minute = 'normal-type', $last_text = 'Read More'  ){
		$thumbnail_id = get_post_meta( $post_id, 'post-option-inside-thumbnail', true );
		$thumbnail_link = get_post_meta( $post_id, 'post-option-inside-thumbnail-link', true );
		$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
		$thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );
		$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
		if( !empty($thumbnail) ){
			echo '<div class="package-media-wrapper gdl-image">';
			
			if( !empty($thumbnail_link) ){
				echo '<a href="' . $thumbnail_link . '" >';
			}else{
				echo '<a href="' . $thumbnail_full[0] . '" data-rel="fancybox" title="' . get_the_title() . '">';
			}
			echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';

			if( !empty($last_minute) && !empty($last_text) ){
				echo '<div class="package-ribbon-wrapper">';
				echo '<div class="package-type ' . $last_minute . '">';
				echo $last_text;
				echo '</div>';
				echo '<div class="clear"></div>';
				echo '<div class="package-type-gimmick"></div>';
				echo '<div class="clear"></div>';
				echo '</div>';
			}			
			echo '</a>';
			
			echo '</div>';	// package-media-wrapper
		}	
	}
	
	function print_widget_package($item_class, $item_size, $item_type, $num_excerpt){
		global $gdl_admin_translator, $post, $gdl_date_format;

		if( $gdl_admin_translator == 'enable' ){
			$translator_learn_more = get_option(THEME_SHORT_NAME.'_translator_read_more_package', 'Learn More');
			$translator_last_minute = get_option(THEME_SHORT_NAME.'_translator_last_minute_package', 'Last Minute');
		}else{
			$translator_learn_more = __('Learn More','gdl_front_end');
			$translator_last_minute = __('Last Minute','gdl_front_end');
		}		
		
		$package_row_size = 0;
		$package_size = str_replace(' Grid Style', '', $item_type);
		
		while( have_posts() ){
			the_post();
			
			$package_row_size = print_item_size($package_size, $package_row_size, $item_class);

			// package content
			echo '<div class="package-content-wrapper">';

			$package_type = get_post_meta(get_the_ID(), 'package-type', true);
			if($package_type == 'Last Minute'){
				$package_ribbon = 'last-minute';
				$package_type_text = '<span class="head">' . $translator_last_minute . '</span>';
				$package_type_text .= '<span class="discount-text">';
				$package_type_text .= get_post_meta(get_the_ID(), 'package-type-text', true);
				$package_type_text .= '</span>';
			}else if($package_type == 'None'){
				$package_ribbon = '';
				$package_type_text = '';
			}else{
				$package_ribbon = 'normal-type';
				$package_type_text = $translator_learn_more;
			}
			
			// package thumbnail
			print_package_thumbnail( get_the_ID(), $item_size, $package_ribbon, $package_type_text );			
			
			echo '<h2 class="package-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

			// package information
			$date_type = get_post_meta( get_the_ID(), 'package-date-type', true );
			if( $date_type == 'Fixed' ){
				$start_date = get_post_meta( get_the_ID(), 'package-start-date', true );
				$end_date = get_post_meta( get_the_ID(), 'package-end-date', true ); 			
				
				echo '<div class="package-date"><i class="icon-time"></i>';
				echo get_package_date($start_date, $end_date, $gdl_date_format);
				echo '</div>';
			}else if( $date_type == 'Duration' ){
				echo '<div class="package-date"><i class="icon-time"></i>';
				echo get_post_meta( get_the_ID(), 'package-duration', true );
				echo '</div>';			
			}
			
			echo '<div class="package-content">';
			if( !empty($post->post_excerpt) ){
				echo do_shortcode( get_the_excerpt() );
			}else{
				echo gdl_get_excerpt( $num_excerpt, '... ' );		
			}		
			echo '</div>'; // package content

			print_book_now_button();
			
			// package price
			if($package_type == 'Learn More' || $package_type == 'None'){
				$price = get_post_meta(get_the_ID(), 'package-price',true);
				if(!empty($price)){
					echo '<div class="package-info"><i class="icon-tag"></i>';
					echo '<span class="package-price">';
					echo __(do_shortcode($price), 'gdl_front_end');
					echo '</span>';
					echo '</div>';			
				}
			}else if($package_type == 'Last Minute'){
				$price = get_post_meta(get_the_ID(), 'package-price',true);
				if(!empty($price)){
					echo '<div class="package-info last-minute"><i class="icon-tag"></i>';
					echo '<div class="package-info-inner">';
					echo '<span class="normal-price">';
					echo __(do_shortcode($price), 'gdl_front_end');
					echo '</span>';
					
					echo '<span class="discount-price">';
					echo get_post_meta(get_the_ID(), 'package-last-minute-widget-text', true);
					echo '</span>';
					echo '</div>';		
					echo '</div>';	//package-info-inner	
				}
			}		
			echo '<div class="clear"></div>';
			echo '</div>'; // package content wrapper
			
			echo '</div>'; // item_class
		}
		echo '<div class="clear"></div>';
		echo '</div>'; // close row		
	}
	
	function print_grid2_package($item_class, $item_size, $item_type, $num_excerpt){
		global $gdl_admin_translator, $post, $gdl_date_format;

		if( $gdl_admin_translator == 'enable' ){
			$translator_learn_more = get_option(THEME_SHORT_NAME.'_translator_read_more_package', 'Learn More');
			$translator_book_now = get_option(THEME_SHORT_NAME.'_translator_book_now_package', 'Book Now!');
			$translator_last_minute = get_option(THEME_SHORT_NAME.'_translator_last_minute_package', 'Last Minute');
		}else{
			$translator_learn_more = __('Learn More','gdl_front_end');
			$translator_book_now = __('Book Now!','gdl_front_end');
			$translator_last_minute = __('Last Minute','gdl_front_end');
		}		
		
		$package_row_size = 0;
		$package_size = str_replace(' Grid 2nd Style', '', $item_type);
		
		while( have_posts() ){
			the_post();
			
			$package_row_size = print_item_size($package_size, $package_row_size, $item_class);

			// package content
			echo '<div class="package-content-wrapper">';

			$package_type = get_post_meta(get_the_ID(), 'package-type', true);
			if($package_type == 'Last Minute'){
				$package_ribbon = 'last-minute';
				$package_type_text = '<span class="head">' . $translator_last_minute . '</span>';
				$package_type_text .= '<span class="discount-text">';
				$package_type_text .= get_post_meta(get_the_ID(), 'package-type-text', true);
				$package_type_text .= '</span>';
			}else if($package_type == 'None'){
				$package_ribbon = '';
				$package_type_text = '';
			}else{
				$package_ribbon = 'normal-type';
				$package_type_text = $translator_learn_more;
			}
			
			// package thumbnail
			echo '<div class="package-thumbnail-outer-wrapper" >';
			print_package_thumbnail( get_the_ID(), $item_size, $package_ribbon, $package_type_text );			
			
			echo '<div class="package-title-wrapper" >';
			echo '<div class="package-title-overlay"></div>';
			echo '<h2 class="package-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

			// package price
			if($package_type == 'Learn More' || $package_type == 'None'){
				$price = get_post_meta(get_the_ID(), 'package-price',true);
				if(!empty($price)){
					echo '<div class="package-info"><i class="icon-tag"></i>';
					echo '<span class="package-price">';
					echo __(do_shortcode($price), 'gdl_front_end');
					echo '</span>';
					echo '</div>';			
				}
			}else if($package_type == 'Last Minute'){
				$price = get_post_meta(get_the_ID(), 'package-price',true);
				if(!empty($price)){
					echo '<div class="package-info last-minute"><i class="icon-tag"></i>';
					echo '<span class="discount-price">';
					echo get_post_meta(get_the_ID(), 'package-last-minute-widget-text', true);
					echo '</span>';	
					echo '</div>';	//package-info-inner	
				}
			}
			
			echo '</div>'; // package-title-wrapper
			echo '</div>'; // package-thumbnail-outer-wrapper
			
			// package information
			$date_type = get_post_meta( get_the_ID(), 'package-date-type', true );
			if( $date_type == 'Fixed' ){
				$start_date = get_post_meta( get_the_ID(), 'package-start-date', true );
				$end_date = get_post_meta( get_the_ID(), 'package-end-date', true ); 			
				
				echo '<div class="package-date"><i class="icon-time"></i>';
				echo get_package_date($start_date, $end_date, $gdl_date_format);
				echo '</div>';
			}else if( $date_type == 'Duration' ){
				echo '<div class="package-date"><i class="icon-time"></i>';
				echo get_post_meta( get_the_ID(), 'package-duration', true );
				echo '</div>';			
			}
					
			echo '</div>'; // package content wrapper
			
			echo '</div>'; // item_class
		}
		echo '<div class="clear"></div>';
		echo '</div>'; // close row	
	}	
	
	function print_medium_package($item_class, $item_size, $num_excerpt){
		global $gdl_admin_translator, $post, $gdl_date_format, $package_id;

		if( $gdl_admin_translator == 'enable' ){
			$translator_learn_more = get_option(THEME_SHORT_NAME.'_translator_read_more_package', 'Learn More');
			$translator_book_now = get_option(THEME_SHORT_NAME.'_translator_book_now_package', 'Book Now!');
			$translator_last_minute = get_option(THEME_SHORT_NAME.'_translator_last_minute_package', 'Last Minute');
		}else{
			$translator_learn_more = __('Learn More','gdl_front_end');
			$translator_book_now = __('Book Now!','gdl_front_end');
			$translator_last_minute = __('Last Minute','gdl_front_end');
		}	
		
		while( have_posts() ){
			the_post();

			echo '<div class="' . $item_class . '">'; 

			$package_type = get_post_meta(get_the_ID(), 'package-type', true);
			if($package_type == 'Last Minute'){
				$package_ribbon = 'last-minute';
				$package_type_text = '<span class="head">' . $translator_last_minute . '</span>';
				$package_type_text .= '<span class="discount-text">';
				$package_type_text .= get_post_meta(get_the_ID(), 'package-type-text', true);
				$package_type_text .= '</span>';
			}else if($package_type == 'None'){
				$package_ribbon = '';
				$package_type_text = '';
			}else{
				$package_ribbon = 'normal-type';
				$package_type_text = $translator_learn_more;
			}
			
			// package thumbnail
			print_package_thumbnail( get_the_ID(), $item_size, $package_ribbon, $package_type_text );	
			
			echo '<div class="package-content-wrapper">';
			
			// package title
			echo '<h2 class="package-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

			// package information
			$date_type = get_post_meta( get_the_ID(), 'package-date-type', true );
			if( $date_type == 'Fixed' ){
				$start_date = get_post_meta( get_the_ID(), 'package-start-date', true );
				$end_date = get_post_meta( get_the_ID(), 'package-end-date', true ); 			
				
				echo '<div class="package-date"><i class="icon-time"></i>';
				echo get_package_date($start_date, $end_date, $gdl_date_format);
				echo '</div>';
			}else if( $date_type == 'Duration' ){
				echo '<div class="package-date"><i class="icon-time"></i>';
				echo get_post_meta( get_the_ID(), 'package-duration', true );
				echo '</div>';			
			}
			
			// package content
			echo '<div class="package-content">';
			if( !empty($post->post_excerpt) ){
				echo do_shortcode( get_the_excerpt() );
			}else{
				echo gdl_get_excerpt( $num_excerpt, '... ' );		
			}
			echo '</div>';
			
			// package price
			if($package_type == 'Learn More' || $package_type == 'None'){
				$price = get_post_meta(get_the_ID(), 'package-price',true);
				if(!empty($price)){
					echo '<div class="package-info"><i class="icon-tag"></i>';
					echo '<span class="package-price">';
					echo __(do_shortcode($price), 'gdl_front_end');
					echo '</span>';
					echo '</div>';			
				}
			}else if($package_type == 'Last Minute'){
				$price = get_post_meta(get_the_ID(), 'package-price',true);
				if(!empty($price)){
					echo '<div class="package-info last-minute"><i class="icon-tag"></i>';
					echo '<span class="normal-price">';
					echo __(do_shortcode($price), 'gdl_front_end');
					echo '</span>';
					
					echo '<span class="discount-price">';
					echo get_post_meta(get_the_ID(), 'package-last-minute-widget-text', true);
					echo '</span>';	
					echo '</div>';	//package-info-inner	
				}
			}	
			
			print_book_now_button();
			echo '<div class="clear"></div>';
			echo '</div>'; // blog-context-wrapper
			echo '<div class="clear"></div>';
			echo '</div>'; // package-item
		
		}
	}
	
	// Print package search
	function print_package_search_item($item_xml){
		$header = find_xml_value($item_xml, 'header');
		print_item_header( $header, '', '', find_xml_value($item_xml, 'icon-class') );
		
		global $gdl_admin_translator, $post, $gdl_date_format;

		if( $gdl_admin_translator == 'enable' ){
			$translator_key_words = get_option(THEME_SHORT_NAME.'_translator_key_words_package', 'Key Words');
			$translator_location = get_option(THEME_SHORT_NAME.'_translator_search_location_package', 'Location');
			$translator_departure = get_option(THEME_SHORT_NAME.'_translator_departure_package', 'Departure Date');
			$translator_arrival = get_option(THEME_SHORT_NAME.'_translator_arrival_package', 'Arrival Date');
			$translator_max_budget = get_option(THEME_SHORT_NAME.'_translator_budget_package', 'Max Budget (USD)');
			$translator_package_search = get_option(THEME_SHORT_NAME.'_translator_search_package', 'Search');
			$translator_trip_type = get_option(THEME_SHORT_NAME.'_translator_trip_type', 'Trip Type');
		}else{
			$translator_key_words = __('Key Words','gdl_front_end');
			$translator_location = __('Location','gdl_front_end');
			$translator_departure = __('Departure Date','gdl_front_end');
			$translator_arrival = __('Arrival Date','gdl_front_end');
			$translator_max_budget = __('Max Budget (USD)','gdl_front_end');		
			$translator_package_search = __('Search','gdl_front_end');
			$translator_trip_type = __('Trip Type','gdl_front_end');
		}	
		
		
		echo '<div class="package-search-wrapper">';
		echo '<form role="search" method="get" id="package-searchform" action="' . home_url( '/' ) . '">';
		
		// Search Text
		echo '<div class="package-search-input">';
		echo '<input type="text" name="s" id="package-search" value="' . $translator_key_words . '" data-default="' . $translator_key_words . '" />';
		echo '</div>';
		
		// Destination
		echo '<div class="package-search-input">';
		echo '<input type="text" name="location" id="location" value="' . $translator_location . '" data-default="' . $translator_location . '" />';	
		echo '</div>';
				
		// Trip Type
		echo '<div class="package-search-select">';
		echo '<select name="package-type" >';
		echo '<option>' . $translator_trip_type . '</option>';
		
		$get_category = get_categories( array( 'taxonomy' => 'package-tag', 'hide_empty' => 0	));
		if( !empty($get_category) ){
			foreach( $get_category as $category ){
				echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
			}
		}		

		echo '</select>';
		echo '</div>';	
		
		// Departure Date
		echo '<div class="package-search-input">';
		echo '<input type="text" name="departure-date" id="departure-date" class="gdl-date-picker" value="' . $translator_departure . '" data-default="' . $translator_departure . '" />';
		echo '<label for="departure-date"><i class="icon-calendar" ></i></label>';
		echo '</div>';
		
		// Arrival Date
		echo '<div class="package-search-input">';
		echo '<input type="text" name="arrival-date" id="arrival-date" class="gdl-date-picker" value="' . $translator_arrival . '" data-default="' . $translator_arrival . '" />';
		echo '<label for="arrival-date"><i class="icon-calendar" ></i></label>';
		echo '</div>';
		
		// Max Budget
		echo '<div class="package-search-input">';
		echo '<input type="text" name="max-budget" id="max-budget" value="' . $translator_max_budget . '" data-default="' . $translator_max_budget . '" />';	
		echo '</div>';
		
		// Submit
		echo '<input type="hidden" name="posttype" value="package" />';
		echo '<input type="submit" id="package-searchsubmit" value="' . $translator_package_search . '" />';
		
		echo '</form>'; 
		echo '</div>'; // package search input
	
	}
	
	// book now button
	function print_book_now_button(){
		$available = get_post_meta(get_the_ID(), 'post-option-available-num',true);
		if($available == 'zero' ){ return; }
	
		global $package_id, $gdl_admin_translator;
		if( empty($package_id) ){ $package_id = 1; }else{ $package_id++; }
		if( $gdl_admin_translator == 'enable' ){
			$translator_book_now = get_option(THEME_SHORT_NAME.'_translator_book_now_package', 'Book Now!');
		}else{
			$translator_book_now = __('Book Now!','gdl_front_end');
		}	
		
		$book_now = get_post_meta(get_the_ID(), 'post-option-book-now-link', true);	
		if( empty($book_now) ){
			$book_now = get_option(THEME_SHORT_NAME.'_booknow_contact_shortcode');
		}
			
		if( !empty($book_now) && strpos($book_now, 'http') === 0 ){
			echo '<a class="package-book-now-button gdl-button large" href="' . $book_now . '" > ';
			echo $translator_book_now;
			echo '</a>';	
		}else if( !empty($book_now) ){
			echo '<div class="book-now-contact hidden" id="gdl-booknow-' . $package_id . '">';
			echo do_shortcode($book_now);
			echo '</div>';	

			echo '<a class="package-book-now-button gdl-button large various" ';
			echo ' href="#gdl-booknow-' . $package_id . '" data-fancybox-type="inline" data-rel="fancybox" ';
			echo ' data-title="' . get_the_title() . '" data-url="' . get_permalink() . '" >';
			echo $translator_book_now;
			echo '</a>';			
		}	
	}
?>