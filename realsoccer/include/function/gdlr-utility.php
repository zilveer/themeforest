<?php
	/*	
	*	Goodlayers Framework File
	*	---------------------------------------------------------------------
	*	This file contains utility function in the theme
	*	---------------------------------------------------------------------
	*/
	
	// page builder content/text filer to execute the shortcode	
	if( !function_exists('gdlr_content_filter') ){
		add_filter( 'gdlr_the_content', 'wptexturize'        ); add_filter( 'gdlr_the_content', 'convert_smilies'    );
		add_filter( 'gdlr_the_content', 'convert_chars'      ); add_filter( 'gdlr_the_content', 'wpautop'            );
		add_filter( 'gdlr_the_content', 'shortcode_unautop'  ); add_filter( 'gdlr_the_content', 'prepend_attachment' );	
		add_filter( 'gdlr_the_content', 'do_shortcode', 11 	 );
		function gdlr_content_filter( $content, $main_content = false ){
			if($main_content) return str_replace( ']]>', ']]&gt;', apply_filters('the_content', $content) );
			$content = str_replace("<br />", "\n", $content);
			return apply_filters('gdlr_the_content', $content);
		}		
	}
	if( !function_exists('gdlr_text_filter') ){
		add_filter( 'gdlr_text_filter', 'do_shortcode' );
		function gdlr_text_filter( $text ){
			return apply_filters('gdlr_text_filter', $text);
		}
	}	
	
	// filter shortcode out if the plugin is not activated
	if( !function_exists('gdlr_enable_shortcode_filter') ){
		add_filter( 'widget_text', 'gdlr_enable_shortcode_filter' );
		add_filter( 'the_content', 'gdlr_enable_shortcode_filter' ); 
		add_filter( 'gdlr_text_filter', 'gdlr_enable_shortcode_filter' ); 	
		add_filter( 'gdlr_the_content', 'gdlr_enable_shortcode_filter' ); 	
		function gdlr_enable_shortcode_filter( $text ){
			if( !function_exists('gdlr_add_tinymce_button') ){
				$text = preg_replace('#\[gdlr_[^\]]+]#', '', $text);
				$text = preg_replace('#\[/gdlr_[^\]]+]#', '', $text);
			}
			return $text;
		}
	}	
			
	// use for generating the option from admin panel
	if( !function_exists('gdlr_check_option_data_type') ){
		function gdlr_check_option_data_type( $value, $data_type = 'color' ){
			if( $data_type == 'color' || $data_type == 'rgba'){
				return (strpos($value, '#') === false)? '#' . $value: $value; 
			}else if( $data_type == 'text' ){
				return $value;
			}else if( $data_type == 'pixel' ){
				return (is_numeric($value))? $value . 'px': $value;
			}else if( $data_type == 'upload' ){
				if(is_numeric($value)){
					$image_src = wp_get_attachment_image_src($value, 'full');	
					return (!empty($image_src))? $image_src[0]: false;
				}else{
					return $value;
				}
			}else if( $data_type == 'font'){
				if( strpos($value, ',') === false ){
					return '"' . $value . '"';
				}
				return $value;
			}else if( $data_type == 'percent' ){
				return (is_numeric($value))? $value . '%': $value;
			}
		
		}
	}	
	if( !function_exists('gdlr_convert_rgba') ){
		function gdlr_convert_rgba($color){
			$color = str_replace('#', '', $color);
			if(strlen($color) == 3) {
				$r = hexdec(substr($color,0,1).substr($color,0,1));
				$g = hexdec(substr($color,1,1).substr($color,1,1));
				$b = hexdec(substr($color,2,1).substr($color,2,1));
			}else{
				$r = hexdec(substr($color,0,2));
				$g = hexdec(substr($color,2,2));
				$b = hexdec(substr($color,4,2));
			}
			return $r . ', ' . $g . ', ' . $b;
		}
	}
	
	// use for layouting the sidebar size
	if( !function_exists('gdlr_get_sidebar_class') ){
		function gdlr_get_sidebar_class( $sidebar = array() ){
			global $theme_option;
			
			if( $sidebar['type'] == 'no-sidebar' ){
				return array_merge($sidebar, array('right'=>'', 'outer'=>'twelve', 'left'=>'twelve', 'center'=>'twelve'));
			}else if( $sidebar['type'] == 'both-sidebar' ){
				if( $theme_option['both-sidebar-size'] == 3 ){
					return array_merge($sidebar, array('right'=>'three', 'outer'=>'nine', 'left'=>'four', 'center'=>'eight'));
				}else if( $theme_option['both-sidebar-size'] == 4 ){
					return array_merge($sidebar, array('right'=>'four', 'outer'=>'eight', 'left'=>'six', 'center'=>'six'));
				}
			}else{ 
			
				// determine the left/right sidebar size
				$size = ''; $center = '';
				switch ($theme_option['sidebar-size']){
					case 1: $size = 'one'; $center = 'eleven'; break;
					case 2: $size = 'two'; $center = 'ten'; break;
					case 3: $size = 'three'; $center = 'nine'; break;
					case 4: $size = 'four'; $center = 'eight'; break;
					case 5: $size = 'five'; $center = 'seven'; break;
					case 6: $size = 'six'; $center = 'six'; break;
				}

				if( $sidebar['type'] == 'left-sidebar'){
					$sidebar['outer'] = 'twelve';
					$sidebar['left'] = $size;
					$sidebar['center'] = $center;
					return $sidebar;
				}else if( $sidebar['type'] == 'right-sidebar'){
					$sidebar['outer'] = $center;
					$sidebar['right'] = $size;
					$sidebar['center'] = 'twelve';
					return $sidebar;			
				}
			}
		}
	}

	// retrieve all posts as a list
	if( !function_exists('gdlr_get_post_list') ){	
		function gdlr_get_post_list( $post_type ){
			$post_list = get_posts(array('post_type' => $post_type, 'numberposts'=>1000));

			$ret = array();
			if( !empty($post_list) ){
				foreach( $post_list as $post ){
					$ret[$post->post_name] = $post->post_title;
				}
			}
				
			return $ret;
		}	
	}	
	
	// retrieve all categories from each post type
	if( !function_exists('gdlr_get_term_list') ){	
		function gdlr_get_term_list( $taxonomy, $parent='' ){
			$term_list = get_categories( array('taxonomy'=>$taxonomy, 'hide_empty'=>0, 'parent'=>$parent) );

			$ret = array();
			if( !empty($term_list) && empty($term_list['errors']) ){
				foreach( $term_list as $term ){
					$ret[$term->slug] = $term->name;
				}
			}
				
			return $ret;
		}	
	}	
	
	// string to css class name
	if( !function_exists('gdlr_string_to_class') ){	
		function gdlr_string_to_class($string){
			$class = preg_replace('#[^\w\s]#','',strtolower(strip_tags($string)));
			$class = preg_replace('#\s+#', '-', trim($class));
			return 'gdlr-skin-' . $class;
		}
	}
	
	// calculate the size as a number ex "1/2" = 0.5
	if( !function_exists('gdlr_item_size_to_num') ){	
		function gdlr_item_size_to_num( $size ){
			if( preg_match('/^(\d+)\/(\d+)$/', $size, $size_array) )
			return $size_array[1] / $size_array[2];
			return 1;
		}	
	}		
	
	// get skin list
	if( !function_exists('gdlr_get_skin_list') ){	
		function gdlr_get_skin_list(){
			global $theme_option;
		
			$skin_list = array('no-skin'=>__('No Skin', 'gdlr_translate'));
			if( !empty($theme_option['skin-settings']) ){
				$skins = json_decode($theme_option['skin-settings'], true);
				if( !empty($skins) ){
					foreach( $skins as $skin ){
						$skin_list[gdlr_string_to_class($skin['skin-title'])] = $skin['skin-title'];
					}
				}
			}
			return $skin_list;
		}
	}
	
	// create pagination link
	if( !function_exists('gdlr_get_pagination') ){	
		function gdlr_get_pagination($max_num_page, $current_page, $format = 'paged'){
			if( $max_num_page <= 1 ) return '';
		
			$big = 999999999; // need an unlikely integer
			return 	'<div class="gdlr-pagination">' . paginate_links(array(
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'format' => '?' . $format . '=%#%',
				'current' => max(1, $current_page),
				'total' => $max_num_page,
				'prev_text'=> __('&lsaquo; Previous', 'gdlr_translate'),
				'next_text'=> __('Next &rsaquo;', 'gdlr_translate')
			)) . '</div>';
		}	
	}		
	if( !function_exists('gdlr_get_ajax_pagination') ){	
		function gdlr_get_ajax_pagination($max_num_page, $current_page){
			if( $max_num_page <= 1 ) return '';
		
			$ret  = '<div class="gdlr-pagination gdlr-ajax">';
			if($current_page > 1){ 
				$ret .= '<a class="prev page-numbers" data-paged="' . (intval($current_page) - 1) . '" >';
				$ret .= __('&lsaquo; Previous', 'gdlr_translate') . '</a> '; 
			}
			for($i=1; $i<=$max_num_page; $i++){
				if( $i == $current_page ){
					$ret .= '<span class="page-numbers current" data-paged="' . $i . '" >' . $i . '</span> ';
				}else{
					$ret .= '<a class="page-numbers" data-paged="' . $i . '" >' . $i . '</a> ';
				}
			}
			if($current_page < $max_num_page){ 
				$ret .= '<a class="next page-numbers" data-paged="' . (intval($current_page) + 1) . '" >';
				$ret .= __('Next &rsaquo;', 'gdlr_translate') . '</a> '; 
			}
			$ret .= '</div>';
			return $ret;
		}	
	}	

?>