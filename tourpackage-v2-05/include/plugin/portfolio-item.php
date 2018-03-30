<?php
	// Print portfolio
	function print_portfolio($item_xml){
		$header = find_xml_value($item_xml, 'header');
		$view_all_port = find_xml_value($item_xml, 'view-all-portfolio');
		if( !empty($view_all_port) && $view_all_port != 'None' ){
			global $gdl_admin_translator;	
			if( $gdl_admin_translator == 'enable' ){
				$translator_view = get_option(THEME_SHORT_NAME.'_translator_view_all_portfolio', 'View All Portfolio');
			}else{
				$translator_view = __('View All Portfolio','gdl_front_end');
			}		
		
			$additional_html = '<a href="' . get_permalink(get_page_by_path($view_all_port));
			$additional_html = $additional_html . '" class="view-all-projects">';
			$additional_html = $additional_html . $translator_view . '</a>';
		}		
		
		$portfolio_type = find_xml_value($item_xml, 'portfolio-type');
		if( $portfolio_type == 'Carousel Portfolio' ){
			$additional = 'navigation-on';
			print_item_header( $header, $additional, $additional_html, find_xml_value($item_xml, 'icon-class') );
		}else if( $portfolio_type == "Carousel Description Portfolio"){
		}else{
			$additional = '';
			print_item_header( $header, $additional, $additional_html, find_xml_value($item_xml, 'icon-class') );
		}

		global $paged, $gdl_element_id;
		$paged = (get_query_var('paged'))? get_query_var('paged') : get_query_var('page');
		$paged = ($paged) ? $paged : 1;

		//echo $paged;
		// get the portfolio meta value
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$port_size = find_xml_value($item_xml, 'item-size');
		$show_title = (find_xml_value($item_xml, "show-title") == "Yes")? true: false;
		$show_tag = (find_xml_value($item_xml, "show-tag") == "Yes")? true: false;		
		$num_excerpt = find_xml_value($item_xml, "num-excerpt");
		
		$category = find_xml_value($item_xml, 'category', false);
		$category = ( $category == 'All' )? '': $category;
		
		$filter_cat = empty($_GET['filter'])? $category: $_GET['filter'];
		
		$order = find_xml_value($item_xml, 'order');
		$orderby = find_xml_value($item_xml, 'orderby');

		query_posts(array('post_type'=>'portfolio', 'paged'=>$paged, 'order'=>$order, 'orderby'=>$orderby,
			'portfolio-category'=>$filter_cat, 'posts_per_page'=>$num_fetch));

		// get the item class and size from array
		if($portfolio_type == 'Portfolio'){
			print_normal_portfolio( $port_size, $show_title, $show_tag, $num_excerpt );
		}else if($portfolio_type == 'Filter Portfolio'){
			print_filter_portfolio( $port_size, $show_title, $show_tag, $category, $header, $num_excerpt);
		}else if($portfolio_type == 'jQuery Filter Portfolio'){
			print_jquery_filter_portfolio( $port_size, $show_title, $show_tag, $category, $header, $num_excerpt);
		}else if($portfolio_type == 'Carousel Portfolio'){
			print_carousel_portfolio( $port_size, $show_title, $show_tag, $num_excerpt );
		}else if($portfolio_type == 'Carousel Description Portfolio'){
			$description = find_xml_value($item_xml, 'column-description');
			print_carousel_description_portfolio( $header, $description, $port_size, $show_title, $show_tag, $num_excerpt, $view_all_port );
		}		

		echo '<div class="clear"></div>';
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			echo '<div class="portfolio-pagination">';
			pagination();
			echo '</div>';
		}
		
		$gdl_element_id++;
		wp_reset_query();
	}
	
	// Print portfolio thumbnail
	function print_portfolio_thumbnail( $post_id, $item_size ){
		global $gdl_element_id;
		
		$thumbnail_types = get_post_meta( $post_id, 'post-option-thumbnail-types', true);
		if( $thumbnail_types == "Image" ){
			$attribute = "";
			$thumbnail_id = get_post_thumbnail_id();
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			
			$image_type = get_post_meta( $post_id, 'post-option-featured-image-type', true);
			if( $image_type == "Link to Current Post" || empty($image_type) ){
				$hover_thumb = "hover-link";
				$permalink = get_permalink();
			}else if( $image_type == "Link to URL"){
				$hover_thumb = "hover-link";
				$attribute = ' target="_blank"';
				$permalink = __(get_post_meta( $post_id, 'post-option-featured-image-url', true ), 'gdl_front_end');
			}else if( $image_type == "Lightbox to Current Thumbnail" ){	
				$hover_thumb = "hover-zoom";
				$attribute = ' data-rel="fancybox" data-fancybox-group="gal' . $gdl_element_id . '" ';
				$permalink = wp_get_attachment_image_src( $thumbnail_id, 'full' );
				$permalink = $permalink[0];
			}else if( $image_type == "Lightbox to Picture" ){
				$hover_thumb = "hover-zoom";
				$attribute = ' data-rel="fancybox" data-fancybox-group="gal' . $gdl_element_id . '" ';
				$permalink = __(get_post_meta( $post_id, 'post-option-featured-image-url', true ), 'gdl_front_end');
			}else{
				$hover_thumb = "hover-video";
				$attribute = ' data-rel="fancybox" data-fancybox-type="iframe" ';
				$permalink = __(get_post_meta( $post_id, 'post-option-featured-image-url', true ), 'gdl_front_end');				
			}
			
			if( !empty($thumbnail[0]) ){
				echo '<div class="portfolio-media-wrapper gdl-image">';
				echo '<a class="hover-wrapper" href="' . $permalink . '" ' . $attribute . ' title="' . get_the_title() . '">';
				echo '<span class="portfolio-thumbnail-image-hover"></span>';
				echo '<span class="' . $hover_thumb . ' hover-icon"></span>';
				echo '</a>';
				echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				echo '</div>'; 				
			}
		}else if( $thumbnail_types == "Video" ){
			$video_link = get_post_meta( $post_id, 'post-option-thumbnail-video', true); 
			echo '<div class="portfolio-media-wrapper gdl-video">';
			echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
			echo '</div>';
		}else if ( $thumbnail_types == "Slider" ){
			$slider_xml = get_post_meta( $post_id, 'post-option-thumbnail-xml', true); 
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			echo '<div class="portfolio-media-wrapper gdl-slider">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';			
		}else if ( $thumbnail_types == "HTML5 Video" ){
			$video = get_post_meta( $post_id, 'post-option-thumbnail-html5-video', true); 
			echo '<div class="portfolio-media-wrapper gdl-html5-video">';
			echo get_html5_video($video);
			echo '</div>';	// blog-media-wrapper		
		}		
	}
	
	// print the port thumbnail
	function print_single_port_thumbnail( $post_id, $item_size ){
		$thumbnail_types = get_post_meta( $post_id, 'post-option-inside-thumbnail-types', true);
		
		if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
			$thumbnail_id = get_post_meta( $post_id, 'post-option-inside-thumbnial-image', true);
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
				echo '<div class="port-media-wrapper gdl-image">';
				echo '<a href="' . $thumbnail_full[0] . '" data-rel="fancybox" title="' . get_the_title() . '">';
				echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				echo '</a>';
				echo '</div>'; // port-media-wrapper
			}
		}else if( $thumbnail_types == "Video" ){
			$video_link = get_post_meta( $post_id, 'post-option-inside-thumbnail-video', true);
			echo '<div class="port-media-wrapper gdl-video">';
			echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
			echo '</div>';	// port-media-wrapper
		}else if ( $thumbnail_types == "Slider" ){
			$slider_xml = get_post_meta( $post_id, 'post-option-inside-thumbnail-xml', true);
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			echo '<div class="port-media-wrapper gdl-slider">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';	// port-media-wrapper
		}else if ( $thumbnail_types == "Stack Images" ){
			$slider_xml = get_post_meta( $post_id, 'post-option-inside-thumbnail-xml', true);
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			echo '<div class="port-media-wrapper gdl-stack-images">';
			echo print_stack_images($slider_xml_dom->documentElement, $item_size);
			echo '</div>';	// port-media-wrapper
		}else if ( $thumbnail_types == "HTML5 Video" ){
			$video = get_post_meta( $post_id, 'post-option-inside-thumbnail-html5-video', true); 
			echo '<div class="port-media-wrapper gdl-html5-video">';
			get_html5_video($video);
			echo '</div>';	// port-media-wrapper		
		}		
	}	
	
	// Print normal portfolio
	function print_normal_portfolio( $port_size = "1/4", $show_title = true, $show_tag = true, $num_excerpt = 0 ){
		global $port_div_size_num_class, $sidebar_type;
		global $gdl_admin_translator;
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Continue Reading');
		}else{
			$translator_continue_reading = __('Continue Reading ','gdl_front_end');
		}
		
		$portfolio_row_size = 0;
		$item_size = $port_div_size_num_class[$port_size][$sidebar_type];		
		
		echo '<div class="portfolio-item-holder row">';
		while( have_posts() ){
			the_post();		
			
			print_item_size($port_size, 0.1, 'portfolio-item mb40');
			
			print_portfolio_thumbnail( get_the_ID(), $item_size );
			
			// portfolio context
			if( $show_title || $show_tag ){
				echo '<div class="portfolio-context">';
				if( $show_title ){
					echo '<h2 class="portfolio-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
				}
				if( $show_tag ){			
					$portfolio_tag = get_the_term_list( get_the_ID(), 'portfolio-tag', '', ', ', '' );
					echo '<div class="portfolio-tag">';
					echo $portfolio_tag;			
					echo '</div>';
				}
				echo '<div class="port-bottom-border"></div>';
				echo '</div>'; // close portfolio context
				
				if( !empty($num_excerpt) ){			
					echo '<div class="portfolio-excerpt">';
					echo gdl_get_excerpt($num_excerpt);
					echo '<a class="port-continue-reading" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';
					echo '</div>';
				}				

			}
			echo '<div class="clear"></div>';
			echo '</div>'; // close print_item_size
		}
		echo '</div>'; // portfolio item holder
	}
	
	// Print filter portfolio
	function print_filter_portfolio( $port_size = "1/4", $show_title = true, $show_tag = true, $parent_category, $header, $num_excerpt = 0){
		global $port_div_size_num_class, $sidebar_type;
		global $gdl_admin_translator;	
		if( $gdl_admin_translator == 'enable' ){
			$translator_all = get_option(THEME_SHORT_NAME.'_translator_all', 'All');
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Continue Reading');
		}else{
			$translator_all = __('All','gdl_front_end');
			$translator_continue_reading = __('Continue Reading ','gdl_front_end');
		}
		
		$item_size = $port_div_size_num_class[$port_size][$sidebar_type];
		$current_filter = empty($_GET['filter'])? 'All': $_GET['filter'];		
		$active = empty($_GET['filter'])? 'active': '';
		
		// filter portfolio button
		$category_lists = get_category_list('portfolio-category', $parent_category);
		
		$has_header = !empty($header)? 'has-header': 'no-header';
		echo '<div class="portfolio-filter-wrapper ' . $has_header . '">';
		echo '<ul class="portfolio-item-filter">';
		foreach($category_lists as $category){
			if( $category == 'All'){
				if( $current_filter == $category ) $active = 'active';
				echo '<li><span> / </span><a href="' . get_permalink() . '" class="' . $active . '">' . $translator_all . '</a></li>';
			}else{
				if( $current_filter == $category ) $active = 'active';
				$current_cat = get_term_by('slug', $category, 'portfolio-category');
				echo '<li><span> / </span><a href="' . esc_url(add_query_arg(array('filter'=>$category), get_permalink())) . '" class="' . $active . '">'; 
				echo $current_cat->name;			
				echo '</a></li>';
			}
			$active = '';
		}
		echo "</ul>";
		echo '<div class="port-current-bar"></div>';
		echo '<div class="clear"></div>';
		echo '</div>';

		
		// start portfolio looping
		echo '<div class="portfolio-item-holder row">';
		while( have_posts() ){
			the_post();		

			print_item_size($port_size, 0.1, 'portfolio-item mb40');
			
			print_portfolio_thumbnail( get_the_ID(), $item_size );
			
			// portfolio context
			if( $show_title || $show_tag ){
				echo '<div class="portfolio-context">';
				if( $show_title ){
					echo '<h2 class="portfolio-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
				}
				if( $show_tag ){			
					$portfolio_tag = get_the_term_list( get_the_ID(), 'portfolio-tag', '', ', ', '' );
					echo '<div class="portfolio-tag">';
					echo $portfolio_tag;			
					echo '</div>';
				}
				echo '<div class="port-bottom-border"></div>';
				echo '</div>'; // close portfolio context
				
				if( !empty($num_excerpt) ){			
					echo '<div class="portfolio-excerpt">';
					echo gdl_get_excerpt($num_excerpt);
					echo '<a class="port-continue-reading" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';
					echo '</div>';
				}					
			}
			echo '<div class="clear"></div>';
			echo '</div>'; // close print_item_size - portfolio_item
		}
		echo '</div>'; // portfolio item holder 	
	}
	
	// Print jquery filter portfolio
	function print_jquery_filter_portfolio( $port_size = "1/4", $show_title = true, $show_tag = true, $parent_category, $header, $num_excerpt = 0){
		global $port_div_size_num_class, $sidebar_type;
		global $gdl_admin_translator;	
		if( $gdl_admin_translator == 'enable' ){
			$translator_all = get_option(THEME_SHORT_NAME.'_translator_all', 'All');
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Continue Reading');
		}else{
			$translator_all = __('All','gdl_front_end');
			$translator_continue_reading = __('Continue Reading ','gdl_front_end');
		}
		
		$item_size = $port_div_size_num_class[$port_size][$sidebar_type];	

		// filter portfolio button
		$category_lists = get_category_list('portfolio-category', $parent_category);
		$category_check = array();
		foreach( $category_lists as $category ){ $category_check[$category] = false; }
		if( empty( $parent_category) ){ 
			$category_check = array('All'=>$translator_all); 
		}else{
			$first_category = get_term_by('slug', $parent_category, 'portfolio-category');
			$category_check[$parent_category] = $first_category->name; 
		}

		while( have_posts() ){
			the_post();
			$post_categories = get_the_terms( get_the_ID(), 'portfolio-category' );
			if(!empty($post_categories)){
				foreach( $post_categories as $category ){ 
					$category_check[urldecode($category->slug)] = $category->name; 
				}
			}
		}
		$is_first = 'active';
		
		$has_header = !empty($header)? 'has-header': 'no-header'; 
		echo '<div class="portfolio-filter-wrapper ' . $has_header . '">';
		echo '<ul class="portfolio-item-filter">';
		foreach($category_lists as $category){
			if( empty($category_check[$category]) ) continue;
			if( $is_first ){ 
				$cat_name = 'All';
			}else{
				$cat_name = $category;
			}
			
			echo '<li><span> / </span><a href="#" class="' . $is_first . '" data-value="' . $cat_name . '">'; 
			echo $category_check[$category];
			echo '</a></li>';
			
			$is_first  = '';
		}
		echo "</ul>";
		echo '<div class="port-current-bar"></div>';
		echo '<div class="clear"></div>';
		echo '</div>';
		
		// start portfolio looping
		rewind_posts();
		echo '<div class="portfolio-item-holder row">';
		while( have_posts() ){
			the_post();		
			
			$portfolio_slug = "";
			$post_categories = get_the_terms( get_the_ID(), 'portfolio-category' );
			if(!empty($post_categories)){
				foreach( $post_categories as $category ){ 
					$portfolio_slug = $portfolio_slug . urldecode($category->slug) . ' '; 
				}
			}
			
			print_item_size($port_size, 0.1, 'portfolio-item mb40 ' . $portfolio_slug);
			
			print_portfolio_thumbnail( get_the_ID(), $item_size );
			
			// portfolio context
			if( $show_title || $show_tag ){
				echo '<div class="portfolio-context">';
				if( $show_title ){
					echo '<h2 class="portfolio-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
				}
				if( $show_tag ){			
					$portfolio_tag = get_the_term_list( get_the_ID(), 'portfolio-tag', '', ', ', '' );
					echo '<div class="portfolio-tag">';
					echo $portfolio_tag;			
					echo '</div>';
				}
				echo '<div class="port-bottom-border"></div>';
				echo '</div>'; // close portfolio context
				
				if( !empty($num_excerpt) ){			
					echo '<div class="portfolio-excerpt">';
					echo gdl_get_excerpt($num_excerpt);
					echo '<a class="port-continue-reading" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';
					echo '</div>';
				}					
			}
			echo '<div class="clear"></div>';
			echo '</div>'; // close print_item_size - portfolio_item
		}
		echo '</div>'; // portfolio item holder 
	}
	
	// Print carousel portfolio
	function print_carousel_portfolio( $port_size = "1/4", $show_title = true, $show_tag = true, $num_excerpt = 0 ){
		global $port_div_size_num_class, $sidebar_type;
		global $gdl_admin_translator;
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Continue Reading');
		}else{
			$translator_continue_reading = __('Continue Reading ','gdl_front_end');
		}		
	
		$portfolio_row_size = 0;
		$item_size = $port_div_size_num_class[$port_size][$sidebar_type];
		echo '<div class="portfolio-carousel-wrapper">';

		echo '<div class="port-nav-wrapper">';
		echo '<a class="port-nav left" ></a>';
		echo '<a class="port-nav right" ></a>';
		echo '</div>'; // port-nav-wrapper		
		
		echo '<div class="portfolio-item-holder row" data-index="0">';
		while( have_posts() ){
			the_post();		
			
			print_item_size($port_size, 0.1, 'portfolio-item mb0');
			
			print_portfolio_thumbnail( get_the_ID(), $item_size );
			
			// portfolio context
			if( $show_title || $show_tag ){
				echo '<div class="portfolio-context">';
				if( $show_title ){
					echo '<h2 class="portfolio-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
				}
				if( $show_tag ){			
					$portfolio_tag = get_the_term_list( get_the_ID(), 'portfolio-tag', '', ', ', '' );
					echo '<div class="portfolio-tag">';
					echo $portfolio_tag;			
					echo '</div>';
				}
				if( !empty($num_excerpt) ){			
					echo '<div class="portfolio-excerpt">';
					echo gdl_get_excerpt($num_excerpt);
					echo '<a class="port-continue-reading" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';
					echo '</div>';
				}					
				echo '<div class="port-bottom-border"></div>';
				echo '</div>'; // close portfolio context
			}
			echo '<div class="clear"></div>';
			echo '</div>'; // close print_item_size
		}
		echo '</div>'; // portfolio item holder

		echo '<div class="clear"></div>';
		echo '</div>'; // gdl-carousel-wrapper
	}	
	
	// Print carousel portfolio
	function print_carousel_description_portfolio( $title, $description, $port_size = "1/4", $show_title = true, $show_tag = true, $num_excerpt = 0, $view_all_port ){
		global $port_div_size_num_class, $sidebar_type, $gdl_div_size_num_class;
		global $gdl_admin_translator;
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Continue Reading');
		}else{
			$translator_continue_reading = __('Continue Reading ','gdl_front_end');
		}		
		
		
		echo '<div class="portfolio-carousel-description-row row">';
		echo '<div class="portfolio-carousel-description ' . $gdl_div_size_num_class[$port_size] . '">';
		echo '<h3 class="gdl-header-title">' . $title . '</h3>';
		echo '<div class="portfolio-carousel-description-caption">' . $description . '</div>';
		echo '<div class="port-nav-wrapper">';
		echo '<a class="port-nav left" ></a>';

		if( !empty($view_all_port) && $view_all_port != 'None' ){
			echo '<a href="' . get_permalink(get_page_by_path($view_all_port)) . '" class="view-all-projects"><i class="icon-th"></i></a>';
		}		
		
		echo '<a class="port-nav right" ></a>';
		echo '</div>'; // port-nav-wrapper			
		echo '</div>'; // portfolio-carousel-description
		
		$new_size = intval($port_size{2})-1 . '/' . $port_size{2};
		echo '<div class="portfolio-carousel-wrapper ' . $gdl_div_size_num_class[$new_size] . '">';
		
		$portfolio_row_size = 0;
		$item_size = $port_div_size_num_class[$port_size][$sidebar_type];
		echo '<div class="portfolio-item-holder row" data-index="0">';
		while( have_posts() ){
			the_post();		
			
			print_item_size($port_size, 0.1, 'portfolio-item mb0');
			
			print_portfolio_thumbnail( get_the_ID(), $item_size );
			
			// portfolio context
			if( $show_title || $show_tag ){
				echo '<div class="portfolio-context">';
				if( $show_title ){
					echo '<h2 class="portfolio-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
				}
				if( $show_tag ){			
					$portfolio_tag = get_the_term_list( get_the_ID(), 'portfolio-tag', '', ', ', '' );
					echo '<div class="portfolio-tag">';
					echo $portfolio_tag;			
					echo '</div>';
				}
				if( !empty($num_excerpt) ){			
					echo '<div class="portfolio-excerpt">';
					echo gdl_get_excerpt($num_excerpt);
					echo '<a class="port-continue-reading" href="' . get_permalink() . '">' . $translator_continue_reading . '</a>';
					echo '</div>';
				}					
				echo '<div class="port-bottom-border"></div>';
				echo '</div>'; // close portfolio context
			}
			echo '<div class="clear"></div>';
			echo '</div>'; // close print_item_size
		}
		echo '</div>'; // portfolio item holder

		echo '<div class="clear"></div>';
		echo '</div>'; // gdl-carousel-wrapper
		echo '</div>'; // portfolio-carousel-description-row
	}		
	
	// Print nested page
	function print_page_item($item_xml){
		print_item_header( find_xml_value($item_xml, 'header'), '', '', find_xml_value($item_xml, 'icon-class') );

		global $paged, $gdl_element_id, $port_div_size_num_class, $sidebar_type;
		
		if(empty($paged)){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }
		
		// get the page meta value
		$port_size = find_xml_value($item_xml, 'item-size');
		$item_size = $port_div_size_num_class[$port_size][$sidebar_type];	
		
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');		

		query_posts(array('post_type'=>'page', 'paged'=>$paged, 'orderby'=>'menu_order', 'order'=>'asc',
			'post_parent'=>get_the_ID(), 'posts_per_page'=>$num_fetch ));
		
		echo '<div class="portfolio-item-holder row">';
		while( have_posts() ){
			the_post();

			print_item_size($port_size, 0.1, 'portfolio-item mb40');
			
			$thumbnail_id = get_post_thumbnail_id();
			if( !empty($thumbnail_id) ){
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
				$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
				
				echo '<div class="portfolio-media-wrapper gdl-image">';
				echo '<a class="hover-wrapper" href="' . get_permalink() . '" >';
				echo '<span class="portfolio-thumbnail-image-hover">';
				echo '<span class="hover-link"></span>';
				echo '</span>';
				echo '</a>';
				echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				echo '</div>'; //portfolio thumbnail image						
			}
			
			$show_title = (find_xml_value($item_xml, "show-title") == "Yes")? true: false;
			$show_excerpt = (find_xml_value($item_xml, "show-excerpt") == "Yes")? true: false;
			if( $show_title || $show_excerpt ){
				echo '<div class="page-context">';
				if( $show_title){
					echo '<h2 class="page-item-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
				}
				if( $show_excerpt ){			
					echo '<div class="page-item-content">' . gdl_get_excerpt($num_excerpt) . '</div>';
				}
				echo '</div>'; // port-thumbnail-contxt
			}
			
			echo '<div class="clear"></div>';
			echo '</div>'; // close print_item_size

		}
		echo "</div>"; // portfolio-item-holder
		
		echo '<div class="clear"></div>';
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}		
		
		wp_reset_query();		
	}
?>