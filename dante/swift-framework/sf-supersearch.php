<?php
	/*
	*
	*	Swift Super Search
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*	sf_super_search()
	*/

	/* SUPER SEARCH
	================================================== */ 
	if (!function_exists('sf_super_search')) {
		function sf_super_search() {
			
			global $sf_supersearchcount, $woocommerce;
			
			$options = get_option('sf_dante_options');
			$ss_final_text = $options['ss_final_text'];
			$ss_button_text = $options['ss_button_text'];
			$field1_text = $options['field1_text'];
			$field1_filter = $options['field1_filter'];
			$field1_default_text = $options['field1_default_text'];
			$field2_text = $options['field2_text'];
			$field2_filter = $options['field2_filter'];
			$field2_default_text = $options['field2_default_text'];
			$field3_text = $options['field3_text'];
			$field3_filter = $options['field3_filter'];
			$field3_default_text = $options['field3_default_text'];
			$field4_text = $options['field4_text'];
			$field4_filter = $options['field4_filter'];
			$field4_default_text = $options['field4_default_text'];
			$field5_text = $options['field5_text'];
			$field5_filter = $options['field5_filter'];
			$field5_default_text = $options['field5_default_text'];
			$field6_text = $options['field6_text'];
			$field6_filter = $options['field6_filter'];
			$field6_default_text = $options['field6_default_text'];
							
			$super_search = $search_text = $shop_page_url = "";
			
			if ( version_compare( WOOCOMMERCE_VERSION, "2.1.0" ) >= 0 ) {
				$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
			} else {
				$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
			}
						
			$search_btn_text = $ss_button_text;
			
			if ($field1_text != "") {
			$search_text .= '<span>'.$field1_text.'</span>';
			$search_text .= sf_super_search_dropdown(1, $field1_filter, $field1_default_text);
			}
			if ($field2_text != "") {
			$search_text .= '<span>'.$field2_text.'</span>';
			$search_text .= sf_super_search_dropdown(2, $field2_filter, $field2_default_text);
			}
			if ($field3_text != "") {
			$search_text .= '<span>'.$field3_text.'</span>';
			$search_text .= sf_super_search_dropdown(3, $field3_filter, $field3_default_text);
			}
			if ($field4_text != "") {
			$search_text .= '<span>'.$field4_text.'</span>';
			$search_text .= sf_super_search_dropdown(4, $field4_filter, $field4_default_text);
			}
			if ($field5_text != "") {
			$search_text .= '<span>'.$field5_text.'</span>';
			$search_text .= sf_super_search_dropdown(5, $field5_filter, $field5_default_text);
			}
			if ($field6_text != "") {
			$search_text .= '<span>'.$field6_text.'</span>';
			$search_text .= sf_super_search_dropdown(6, $field6_filter, $field6_default_text);
			}
			
			$search_text .= '<span>'.$ss_final_text.'</span>';
			
			if ($sf_supersearchcount == 0 || !$sf_supersearchcount) {
			$super_search .= '<div id="super-search" class="sf-super-search">';		
			} else {
			$super_search .= '<div id="super-search-'.$sf_supersearchcount.'" class="sf-super-search">';				
			}
			$super_search .= '<div class="container">';
			$super_search .= '<div class="row">';
			$super_search .= '<div class="search-options col-sm-9">';
			$super_search .= $search_text;
			$super_search .= '</div>';
			$super_search .= '<div class="search-go col-sm-3">';
			$super_search .= '<a href="#" class="super-search-go sf-button accent" data-home_url="'.get_home_url().'" data-shop_url="'.$shop_page_url.'"><span class="text">'.$search_btn_text.'</span></a>';
			$super_search .= '<a class="super-search-close" href="#"><i class="ss-delete"></i></a>';
			$super_search .= '</div>';
			$super_search .= '</div><!-- close .row -->';
			$super_search .= '</div><!-- close .container -->';
			$super_search .= '</div><!-- close #super-search -->';
			
			if ($sf_supersearchcount >= 0) {
				$sf_supersearchcount++;
			} else {
				$sf_supersearchcount = 0;
			}
			
			return $super_search;
		}
	}
	
	
	if (!function_exists('sf_super_search_dropdown')) {
		function sf_super_search_dropdown($index, $option, $text) {
		
			global $product;
			
			$option_id = $sf_ss_dropdown = $default_term_id = "";
			
			$option_id = $option;
			
			if ($option != "product_cat" && $option != "price") {
				$option = 'pa_' . $option;
			}
			
			$default_term = get_term_by('name', $text, $option);
			
			if ($default_term) {
				if ($option == "product_cat") {
				$default_term_id = $default_term->slug;			
				} else {
				$default_term_id = $default_term->term_id;
				}
			}
			
			$term_args = array(
			    'parent' => 0,
			);
			
			if ($option == "price") {
				
				global $wpdb, $woocommerce;
				
				$max = ceil( $wpdb->get_var(
					$wpdb->prepare('
						SELECT max(meta_value + 0)
						FROM %1$s
						LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
						WHERE meta_key = \'%3$s\'
						', $wpdb->posts, $wpdb->postmeta, '_price' )
				) );
					
				$sf_ss_dropdown .= '<input type="text" pattern="[0-9]*" id="ss-price-min" name="min_price" value="0" />';
				$sf_ss_dropdown .= '<span>&</span>';
				$sf_ss_dropdown .= '<input type="text" pattern="[0-9]*" id="ss-price-max" name="max_price" value="'.$max.'" />';
			
			} else {
			
				$terms = get_terms($option, $term_args);
				
				$sf_ss_dropdown .= '<div id="'.$option_id.'" class="ss-dropdown" tabindex="'.$index.'" data-attr_value="'.$default_term_id.'">';
				$sf_ss_dropdown .= '<span>'.$text.'</span>';
				$sf_ss_dropdown .= '<ul>';
				$sf_ss_dropdown .= '<li>';
				$sf_ss_dropdown .= '<a class="ss-option" href="#" data-attr_value="">'.__("Any", "swiftframework").'</a>';
				$sf_ss_dropdown .= '<i class="fa-check"></i>';
				$sf_ss_dropdown .= '</li>';	
				
				foreach ($terms as $term) {
					if ($term->slug == $default_term_id || $term->term_id == $default_term_id) {
						$sf_ss_dropdown .= '<li class="selected">';
					} else {
						$sf_ss_dropdown .= '<li>';
					}
					
					if ($option == "product_cat") {
						$sf_ss_dropdown .= '<a class="ss-option" href="#" data-attr_value="'.$term->slug.'">'.$term->name.'</a>';
					} else {
						$sf_ss_dropdown .= '<a class="ss-option" href="#" data-attr_value="'.$term->term_id.'">'.$term->name.'</a>';
					}
					
					$sf_ss_dropdown .= '<i class="fa-check"></i>';
					$sf_ss_dropdown .= '</li>';	
				}
			
				$sf_ss_dropdown .= '</ul>';
				$sf_ss_dropdown .= '</div>';
			
			}
			
			return $sf_ss_dropdown;
		}
	}
	
		
	function sf_custom_get_attribute_taxonomies() {
		$transient_name = 'wc_attribute_taxonomies';
		$attribute_taxonomies = "";
		
		if (sf_woocommerce_activated()) {
        
	        if ( false === ( $attribute_taxonomies = get_transient( $transient_name ) ) ) {
	
	            global $wpdb;
	
	            $attribute_taxonomies = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies" );
	
	            set_transient( $transient_name, $attribute_taxonomies );
	        }
        
        }

        return apply_filters( 'woocommerce_attribute_taxonomies', $attribute_taxonomies );
	}
	
	function sf_custom_get_attribute_taxonomy_name($name) {
		$taxonomy = $name;
		$taxonomy = strtolower( stripslashes( strip_tags( $taxonomy ) ) );
		$taxonomy = preg_replace( '/&.+?;/', '', $taxonomy ); // Kill entities
		$taxonomy = str_replace( array( '.', '\'', '"' ), '', $taxonomy ); // Kill quotes and full stops.
		$taxonomy = str_replace( array( ' ', '_' ), '-', $taxonomy ); // Replace spaces and underscores.
		return 'pa_' . $taxonomy;
	}	
?>