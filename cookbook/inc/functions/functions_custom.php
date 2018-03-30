<?php 

/**************************************
INDEX OF FUNCTIONS

	function output_cmb_media_link ($cmb_media_link) {
	function mb_kses_plus ($source, $incl_allowedposttags, $tags = array()) {
	function mb_get_allowed_html_tags ($operator = "none", $custom_array = array()) {
	function mb_get_breadcrumbs($args = array()) {
	function mb_get_cat_string ($post_id, $separator) {
	function mb_has_feature ($post_id) {
	function mb_list_categories_of_consolidated_wp_gallery ($consolidated_wp_gallery_array) {
	function mb_get_excerpt ($post_id, $excerpt_len) {
	function mb_get_exclude_array ($meta_key) {
	function mb_get_exclude_string ($meta_key) {
	function mb_strip_wp_galleries_to_array ($string) {
	function mb_convert_wp_galleries_array_to_consolidated_wp_gallery_array ($wp_galleries_array) {
	function get_canon_theme_body_classes() {
	function mb_lcfirst($string) {	
	function mb_is_woocommerce_page() {	
	function mb_create_slug($string) {
	function mb_get_col_size_class_from_num($num, $default) {
	function mb_get_size_class_from_num($num, $default) {
	function mb_tag_search_string($content, $subject, $pretag, $posttag, $strict) {	//if $strict = true only string with same upper/lowercase as subject will get tagged
	function mb_hex_opacity_to_rgba($hex, $opacity) {
	function mb_rgb_to_hex($rgb) {
	function mb_hex_to_rgb($hex) {
	function mb_get_google_webfonts_link ($font_array) {
	function mb_get_css_from_google_webfonts_settings_array ($font_array) {
	function mb_build_delim_string_from_array($array, $delim, $prefix, $postfix) {
	function mb_add_value_to_delim_string($string, $add_value, $delim, $add_if_duplicate) {
	function mb_del_value_from_delim_string($string, $del_value, $delim) {
	function mb_is_value_in_delim_string($string, $check_value, $delim) {
	function mb_update_cookie_key_value ($cookie_name, $key, $value) {
	function mb_cookie_get_key_value ($cookie_name, $key) {
	function mb_localize_datetime($datetime) {
	function mb_show_admin_notice ($message, $class) {
	function format_datetime_str ($format_str, $datetime_str)
	function mb_make_excerpt($string, $maxlen, $by_word) {
	function mb_get_page_type () {
	function mb_get_latest_tweets ($twitter_screen_name) //returns an array of tweet objects. The content is in ->text or on error returns false with errorlog in transient
	function mb_filter_tweet ($tweet) {
	function mb_time_ago_tweet ($tweet_object) {
	function mb_get_twitter_count ($twitter_screen_name) {
	function mb_get_facebook_count ($facebook_page)
	function mb_get_rss_count ($feedburner_account) {
	function mb_update_post_views($post_id) {
	function mb_get_post_views($post_id) {
	function mb_update_post_views_single_check($post_id) {
	function mb_get_rating_percentage ($rating, $min_rating, $max_rating, $increment, $ignore_increment) {
	function mb_get_rating_color ($rating_percentage) {
	function mb_get_rating_label ($rating_percentage) {
	function mb_get_updated_order_array ($results_slider_posts) {
	function mb_get_updated_order_array_projects ($results_slider_posts) {

***************************************/




/**************************************
output_cmb_media_link
***************************************/


	function output_cmb_media_link ($cmb_media_link) {

		echo mb_kses_plus($cmb_media_link, true, array('iframe', 'source'));

	}



/**************************************
mb_kses_plus

performs kses on $source. 
if $incl_allowedposttags (true/false) is set to true then global $allowedposttags (same as used in wp_kses_post) will be used as base tag whitelist.
add predefined tags to $tags array and these will be added to the whitelist.
Known tags so far: 'iframe', 'source'
***************************************/


	function mb_kses_plus ($source, $incl_allowedposttags, $tags = array()) {

		$allowed_tags_array = array();

		if ($incl_allowedposttags === true) {
			global $allowedposttags;
			$allowed_tags_array = array_merge($allowed_tags_array, $allowedposttags);
		}

		// IFRAME
		if (in_array('iframe', $tags)) {
			$allowed_tags_array = array_merge($allowed_tags_array, array(
				'iframe' => array(
					'align' => true,
					'frameborder' => true,
					'height' => true,
					'longdesc' => true,
					'marginheight' => true,
					'marginwidth' => true,
					'name' => true,
					'sandbox' => true,
					'scrolling' => true,
					'seamless' => true,
					'src' => true,
					'srcdoc' => true,
					'width' => true,
					'allowFullScreen' => true,
					'webkitAllowFullScreen' => true,
					'mozallowfullscreen' => true,
				),
			));
				
		}
			
		// SOURCE	
		if (in_array('source', $tags)) {
			$allowed_tags_array = array_merge($allowed_tags_array, array(
				'source' => array(
					'src' => true,
					'type' => true,
				),
			));
				
		}
			
		ksort($allowed_tags_array, SORT_REGULAR);

		return wp_kses($source, $allowed_tags_array);

	}



/**************************************
mb_get_allowed_html_tags

$allowedposttags from wp-includes/kses.php. Mainly to be used with kses functions.
Use this function to return or modify the default $allowedposttags array.
If function is called without params mb_get_allowed_html_tags() it returns default allowed tags.
Or you can add two parameters mb_get_allowed_html_tags($operator, $custom_array)
$operator must be "modify" or "remove" and will add/modify or remove the $custom_array to/from the default $allowedposttags.
Often used with wp_kses("modify", mb_get_allowed_html_tags("modify", $custom_array)) where custom array for adding iframe to the allowed list would look like

		$custom_array = array(
			'iframe' => array(
				'align' => true,
				'frameborder' => true,
				'height' => true,
				'longdesc' => true,
				'marginheight' => true,
				'marginwidth' => true,
				'name' => true,
				'sandbox' => true,
				'scrolling' => true,
				'seamless' => true,
				'src' => true,
				'srcdoc' => true,
				'width' => true,
				'webkitAllowFullScreen' => true,
				'mozallowfullscreen' => true,
				'allowFullScreen' => true,
			),
		);

***************************************/


	function mb_get_allowed_html_tags ($operator = "none", $custom_array = array()) {
			
		global $allowedposttags;

		// if modify then start by deleting relevant keys
		if ( ($operator == "modify" || $operator == "remove") && !empty($custom_array) ) {
			foreach ($custom_array as $key => $value) {
					unset($allowedposttags[$key]);
				}	
		}

		// if add then add $custom_array to $allowedposttags
		if ( $operator == "modify" ) {
			$allowedposttags = array_merge($allowedposttags, $custom_array);
			ksort($allowedposttags, SORT_REGULAR);
		}

		return $allowedposttags;

	}


/**************************************
mb_get_breadcrumbs
by Michael Bregnbak

Optional args
mb_get_breadcrumbs(array(
	"separator" => ">",
));

***************************************/


	function mb_get_breadcrumbs($args = array()) {

		global $post;
		extract($args);

		$output = "";
		$separator = (isset($separator)) ? $separator : "/";
		$separator_output = sprintf('<li><span class="canon_breadcrumbs_separator">%s</span></li>', $separator);

		$output .= '<ul class="canon_breadcrumbs">';

		// HOME
		$home_output = '<i class="fa fa-home"></i>';
		$output .= sprintf('<li><a href="%s">%s</a></li>', esc_url(home_url()), $home_output);

		// IF BLOG AND NOT BLOG AS FRONT PAGE
		if (is_home() && !is_front_page()) {
			$blog_output = __('Blog', 'loc_canon');
			$output .= $separator_output;
			$output .= sprintf('<li>%s</li>', $blog_output);
		}   

		// PAGE
		elseif (is_page() && !is_front_page()) {

			if($post->post_parent){
				$ancestor_ids = get_post_ancestors( $post->ID );
                $ancestor_ids = array_reverse($ancestor_ids);
				foreach ( $ancestor_ids as $ancestor_id ) {
					$output .= $separator_output;
					$output .= sprintf('<li><a href="%s" title="%s">%s</a></li>', esc_url(get_permalink($ancestor_id)), get_the_title($ancestor_id), get_the_title($ancestor_id));
				}
			}
			$output .= $separator_output;
			$output .= sprintf('<li>%s</li>', get_the_title());

		} 

		// CATEGORIES AND SINGLE
		elseif (is_category() || ( is_single() && get_post_type() =="post") ) {

			// THE CATEGORY OBJECT
			global $wp_query;

			$post_type = get_post_type();
			$category_slug = $wp_query->query_vars['category_name'];

			if (is_category() && get_category_by_slug($category_slug)) {
				$the_category_object = get_category_by_slug($category_slug);
			} else {
				$the_categories_array = get_the_category();
				if (!empty($the_categories_array)) { $the_category_object = $the_categories_array[0]; }
			}

			// ADD CATEGORIES
			if (isset($the_category_object)) {

				$category_lineage_array = array();
				$the_category_parent = $the_category_object->parent;

				//do this for all the category parents
				while ($the_category_parent !== 0) {

					$the_category_parent_object = get_category($the_category_parent);	
					array_unshift($category_lineage_array, $the_category_parent_object->term_id);
					$the_category_parent = $the_category_parent_object->parent;
				}

				// now add category parents to output
				foreach ($category_lineage_array as $key => $term_id) {
					$category_lineage_object = get_category($term_id);
					$category_lineage_object_link = get_category_link($term_id);;

					$output .= $separator_output;
					$output .= sprintf('<li><a href="%s">%s</a></li>', esc_url($category_lineage_object_link), $category_lineage_object->name);

				}

				// finally add the original category itself (wihtout link if category page)
				$output .= $separator_output;
				if (is_category()) {
					$output .= sprintf('<li>%s</li>', $the_category_object->name);
				} else {
					$the_category_object_link = get_category_link($the_category_object->term_id);
					$output .= sprintf('<li><a href="%s">%s</a></li>', esc_url($the_category_object_link), $the_category_object->name);
				}

			}

			// SINGLE
			if (is_single()) {
				$output .= $separator_output;
				$output .= sprintf('<li>%s</li>', get_the_title());
			}
				
		}

		// CUSTOM POST TYPES
		elseif ( is_post_type_archive() || is_tax() || (is_single() && get_post_type() != "post") ) {

			$post_type = get_post_type();
			$post_type_object = get_post_type_object($post_type);

			// FIRST ADD THE CUSTOM POST TYPE NAME/LABEL

			$output .= $separator_output;
			$post_type_object_link = get_post_type_archive_link($post_type);

			$output .= sprintf('<li><a href="%s">%s</a></li>', esc_attr($post_type_object_link), $post_type_object->label);


			// NEXT GET THE TERM OBJECT AND TERM TAXONOMY. IF THIS IS TAXONOMY PAGE YOU CAN GET DATA FROM QUERY IF SINGLE YOU WILL HAVE TO DETECT TERMS

			$the_term_object = null;
			$the_term_taxonomy = null;

			if (is_single()) {
				$taxonomies = get_object_taxonomies( $post_type, 'objects' );

				// get the first term of the first taxonomy
				foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

					// attempt to get terms
					$terms = get_the_terms( $post->ID, $taxonomy_slug );

					// if succesfull
					if ( !empty( $terms ) ) {

						foreach ( $terms as $term ) {
							if ($post_type == "product" && $term->name == "simple") { continue; }	// WooCommerce specific. WooCommerce first term is an internal use label with the name of simple. If detected skip and instead jump to next term which is first category.
							if (!isset($the_term_object)) { 
								$the_term_object = $term; 
								$the_term_taxonomy = $the_term_object->taxonomy;
							}
						}
					}
				}
					
			} elseif (is_tax()) {
					
				global $wp_query;

				$the_term_object = get_term($wp_query->queried_object->term_id,$wp_query->query_vars['taxonomy']);
				$the_term_taxonomy = $the_term_object->taxonomy;
			}

			// NEXT ADD THE CUSTOM POST TYPE TAXONOMIES

			// if this post has any terms
			if (isset($the_term_object)) {
				$term_lineage_array = array();
				array_unshift($term_lineage_array, $the_term_object->term_id);

				$the_term_parent = $the_term_object->parent;

				//do this for all the term parents
				while ($the_term_parent !== 0) {
					$the_term_parent_object = get_term($the_term_parent, $the_term_taxonomy);	
					array_unshift($term_lineage_array, $the_term_parent_object->term_id);
					$the_term_parent = $the_term_parent_object->parent;
				}

				// now add terms to output
				foreach ($term_lineage_array as $key => $term_id) {
					$term_lineage_object = get_term($term_id, $the_term_taxonomy);
					$term_lineage_object_link = get_term_link($term_id, $the_term_taxonomy);

					$output .= $separator_output;
					$output .= sprintf('<li><a href="%s">%s</a></li>', esc_url($term_lineage_object_link), $term_lineage_object->name);

				}
			}


			// // FINALLY ADD THE SINGLE NAME

			if (is_single()) {
				$output .= $separator_output;
				$output .= sprintf('<li>%s</li>', get_the_title());
			}

		}

		// DATE
		elseif (is_date()) {

			// DATE
			$archive_year  = get_the_time('Y'); 
			$archive_month = get_the_time('m'); 
			$archive_day   = get_the_time('d');

			// YEAR
			$year_link = get_year_link($archive_year);
			$output .= $separator_output;
			$output .= sprintf('<li><a href="%s">%s</a></li>', esc_url($year_link), $archive_year);

			// MONTH
			if ( is_month() || is_day()) {
				$month_link = get_month_link($archive_year, $archive_month);
				$output .= $separator_output;
				$output .= sprintf('<li><a href="%s">%s</a></li>', esc_url($month_link), mb_localize_datetime(get_the_time("F")));

			}

			if (is_day()) {
				// DAY
				$day_link = get_day_link($archive_year, $archive_month, $archive_day);
				$output .= $separator_output;
				$output .= sprintf('<li><a href="%s">%s</a></li>', esc_url($day_link), $archive_day);
			}

		}

		// TAG
		elseif (is_tag()) {
			$output .= $separator_output;
			$output .= sprintf('<li>%s: %s</li>', __('Tag', 'loc_canon'), single_tag_title('', false));
		}

		// AUTHOR
		elseif (is_author()) {
			$output .= $separator_output;
			$output .= sprintf('<li>%s: %s</li>', __('Author', 'loc_canon'), get_the_author_meta('display_name'));
		}

		// SEARCH
		elseif (is_search()) {
			$output .= $separator_output;
			$output .= sprintf('<li>%s: %s</li>', __('Search', 'loc_canon'), get_search_query());
		}

		// 404
		elseif (is_404()) {
			$output .= $separator_output;
			$output .= sprintf('<li>404</li>');
		}

		$output .= '</ul>';

		return wp_kses_post($output);
	}

/**************************************
mb_get_cat_string
***************************************/


	function mb_get_cat_string ($post_id, $separator) {
			
		$cat_array = get_the_category($post_id);
		$cat_string = "";
		$cat_string_separator = $separator;
		if ($cat_array) {

			foreach ($cat_array as $key => $value) {
				$cat_string .= sprintf( '<a href="%s">%s</a>', esc_url(get_category_link($value->term_id)), esc_attr($value->name) );
				$cat_string .= $cat_string_separator;
			}
			$cat_string = trim($cat_string, $cat_string_separator);

		}

		return $cat_string;

	}


/**************************************
mb_has_feature
***************************************/

	function mb_has_feature ($post_id) {

		$has_feature = false;
		$cmb_feature = get_post_meta($post_id, 'cmb_feature', true);
		$cmb_media_link = get_post_meta($post_id, 'cmb_media_link', true);

		if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) { $has_feature = true; }
		if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && has_post_thumbnail($post_id) && get_post(get_post_thumbnail_id($post_id)) )  { $has_feature = true; }
		if ( ($cmb_feature == "image" || empty($cmb_feature)) && has_post_thumbnail($post_id) && get_post(get_post_thumbnail_id($post_id)) ) {  $has_feature = true; }

		return $has_feature;   

	}


/**************************************
mb_list_categories_of_consolidated_wp_gallery
***************************************/

	function mb_list_categories_of_consolidated_wp_gallery ($consolidated_wp_gallery_array) {
	
		// create cat_array
		$cat_array = array();
		foreach ($consolidated_wp_gallery_array as $key => $value) {
			foreach ($value['categories'] as $key => $value) {
			   $cat_array[$key] = $value;
			}
		}
		asort($cat_array);

		// output
		printf("<li class='cat-item-all'><a href='#'>%s</a></li>", __("All categories", "loc_canon"));
		foreach ($cat_array as $key => $value) {
			printf('<li class="cat-item %s"><a href="#" title="%s">%s</a></li>', esc_attr($key), esc_attr(__("View all posts filed under " . $value, "loc_canon")), esc_attr($value));
		}
			
	}


/**************************************
mb_get_excerpt
***************************************/

	function mb_get_excerpt ($post_id, $excerpt_len) {
		$this_post = get_post($post_id);
		if (!$this_post) { return false; }
		$excerpt = "";
		if (!empty($this_post->post_excerpt)) {
			$excerpt = do_shortcode($this_post->post_excerpt);	
		} elseif (strpos($this_post->post_content, "<!--more-->") !== false) {
			$content_explode = explode("<!--more-->", $this_post->post_content);
			$excerpt = do_shortcode($content_explode[0]) . "...";
		} else {
			if (!isset($excerpt_len)) { $excerpt_len = 200; }
			$excerpt = mb_make_excerpt($this_post->post_content, $excerpt_len, true);	
		}

		return $excerpt;

	}


/**************************************
mb_get_exclude_array
***************************************/

	function mb_get_exclude_array ($meta_key) {
		
		$exclude_array = array();   
		$results_exclude_posts = get_posts(array(
			'meta_key'          => $meta_key,
			'meta_value'        => 'checked',
			'post_type'         => 'any',
			'suppress_filters'  => false,
		));
		if (count($results_exclude_posts) > 0) {
			for ($i = 0; $i < count($results_exclude_posts); $i++) {  
				$exclude_array[] = $results_exclude_posts[$i]->ID;
			}   
		} 

		return $exclude_array;
			
	}

/**************************************
mb_get_exclude_string
***************************************/

	function mb_get_exclude_string ($meta_key) {
		
		$exclude_string = "";
		$separator = ",";
		$results_exclude_posts = get_posts(array(
			'numberposts'			=> -1,
			'meta_key'          	=> $meta_key,
			'meta_value'			=> 'checked',
			'orderby'				=> 'post_date',
			'order'					=> 'DESC',
			'post_type'				=> 'any',
		));
		if (count($results_exclude_posts) > 0) {
			$exclude_string = "";
			for ($i = 0; $i < count($results_exclude_posts); $i++) {  
				$exclude_string .= $results_exclude_posts[$i]->ID . $separator;
			}	
			$exclude_string = trim($exclude_string, $separator);
		} 

		return $exclude_string;
			
	}

/**************************************
mb_strip_wp_galleries_to_array
***************************************/

	function mb_strip_wp_galleries_to_array ($string) {
		$wp_galleries_array = array();
		$explode_array = explode('[gallery', $string);
		for ($i = 1; $i < count($explode_array); $i++) {    //notice index starts at 1 to exclude first explode piece
			$explode_array2 = explode(']',$explode_array[$i]);

			// assemble
			$single_gallery = '[gallery' . $explode_array2[0] . ']';
			array_push($wp_galleries_array, $single_gallery);
		}

		return $wp_galleries_array;

	}

/**************************************
mb_convert_wp_galleries_array_to_consolidated_wp_gallery_array
***************************************/

	function mb_convert_wp_galleries_array_to_consolidated_wp_gallery_array ($wp_galleries_array) {
		$consolidated_wp_gallery_array = array();

		foreach ($wp_galleries_array as $key => $this_wp_gallery_string) {
			// first create id array
			$id_explode_array = explode('ids="', $this_wp_gallery_string);
			$id_explode_array2 = explode('"',$id_explode_array[1]);
			$id_string = $id_explode_array2[0];
			$id_array = explode(',', $id_string);


			// get category
			$cat_explode_array = explode('category="', $this_wp_gallery_string);
			if (isset($cat_explode_array[1])) {
				$cat_explode_array2 = explode('"',$cat_explode_array[1]);
				$category_name = $cat_explode_array2[0];
				$category_slug = mb_create_slug($category_name);
			} else {
				$category_name = __("Category ", "loc_canon") . ($key+1);
				$category_slug = mb_create_slug($category_name);
			}

			//handle each id
			foreach ($id_array as $key => $id) {
				// first check if duplicate
				$duplicate = false;
				foreach ($consolidated_wp_gallery_array as $key => $value) {
					if ($value['id'] === $id) { 
						$duplicate = true;

						// if duplicate check if category exists and add if not add
						$duplicate_cat = false;
						foreach ($value['categories'] as $this_cat_slug => $this_cat_name) {
							if ($this_cat_name === $category_name) { $duplicate_cat = true; }
						}

						if ($duplicate_cat === false) {
							$cat_add_array = array(
								$category_slug => $category_name,
							);
							$consolidated_wp_gallery_array[$key]['categories'][$category_slug] = $category_name;
						}
					}
				}

				// add if not duplicate
				if ($duplicate === false) {
					$add_array = array(
						'id'            => $id,
						'categories'    => array(
							$category_slug  => $category_name,
						), 
					);
					array_push($consolidated_wp_gallery_array, $add_array);
				}

			}   // foreach id_array

		}   // foreach wp_gallery_array

		return $consolidated_wp_gallery_array;
	}


/**************************************
GET_CANON_THEME_BODY_CLASSES
***************************************/

	function get_canon_theme_body_classes() {

		// GET OPTIONS
		$canon_options = get_option('canon_options');
		$canon_options_frame = get_option('canon_options_frame');
		$canon_options_appearance = get_option('canon_options_appearance');

		// DEV_MODE
		if ($canon_options['dev_mode'] == "checked") {
			if (isset($_GET['use_boxed_design'])) { $canon_options['use_boxed_design'] = wp_filter_nohtml_kses($_GET['use_boxed_design']); }
		}

		// DEFAULTS
		if (!isset($canon_options['use_boxed_design'])) { $canon_options['use_boxed_design'] = "unchecked"; }
		if (!isset($canon_options_frame['use_sticky_header'])) { $canon_options_frame['use_sticky_header'] = "unchecked"; }
		if (!isset($canon_options_appearance['body_skin_class'])) { $canon_options_appearance['body_skin_class'] = ""; }

		$classes = "";

		// add boxed-page if boxed design and sticky header
		if ( ($canon_options['use_boxed_design'] == "checked") ) { $classes .= "boxed-page "; }

		// add body skin class
		if (!empty($canon_options_appearance['body_skin_class'])) { $classes .= $canon_options_appearance['body_skin_class']; }

		// trim trailing space
		$classes = trim($classes, " ");

		return $classes;

	}

/****************************************************
mb_array_replace

PHP's own array_replace() is compatible with PHP 5.3
mb_array_replace() does the same but is compatible with PHP 4 (NB: only takes 2 arrays whereas array_replace takes more arrays)
****************************************************/

	function mb_array_replace($array1, $array2) {	

		if (function_exists('array_replace')) {
			$array1 = array_replace($array1, $array2);
		} else {
			foreach ($array2 as $key => $value) {
				$array1[$key] = $value;
			}
		}

		return $array1;
	}	

/****************************************************
mb_lcfirst

PHP's own lcfirst() is compatible with PHP 5.3
mb_lcfirst() does the same but is compatible with PHP 4
****************************************************/

	function mb_lcfirst($string) {	

		$string = strtolower(substr($string,0,1)) . substr($string,1,strlen($string)-1);

		return $string;
	}	

/****************************************************
mb_is_woocommerce_page
****************************************************/

	function mb_is_woocommerce_page() {	

		$is_woocommerce = false;
		if (class_exists('Woocommerce')) {
			if (is_woocommerce()
				|| is_shop()
				|| is_product_category()
				|| is_product_taxonomy()
				|| is_product_tag()
				|| is_product()
				|| is_cart()
				|| is_checkout()
				|| is_order_received_page()
				|| is_account_page()
				|| is_ajax()
				) {
				$is_woocommerce = true;	
			}
		}

		return $is_woocommerce;
	}	

/****************************************************
mb_create_slug
****************************************************/

	function mb_create_slug($string) {

		$slug = strtolower($string);
		$slug = preg_replace("/[^ \w]+/", "", $slug);	//removes all non word and numbers signs
		$slug = str_replace(" ", "-", $slug);

		return $slug;
	}	


/****************************************************
mb_get_col_size_class_from_num
****************************************************/

	function mb_get_col_size_class_from_num($num, $default) {

		$size_class = "";

		switch ($num) {
			case 1:
				$size_class = "col-1-1";
				break;
			case 2:
				$size_class = "col-1-2";
				break;
			case 3:
				$size_class = "col-1-3";
				break;
			case 4:
				$size_class = "col-1-4";
				break;
			case 5:
				$size_class = "col-1-5";
				break;
			
			default:
				$size_class = $default;
				break;
		}

		return $size_class;
	}	

/****************************************************
mb_get_size_class_from_num
****************************************************/

	function mb_get_size_class_from_num($num, $default) {

		$size_class = "";

		switch ($num) {
			case 1:
				$size_class = "full";
				break;
			case 2:
				$size_class = "half";
				break;
			case 3:
				$size_class = "third";
				break;
			case 4:
				$size_class = "fourth";
				break;
			case 5:
				$size_class = "fifth";
				break;
			
			default:
				$size_class = $default;
				break;
		}

		return $size_class;
	}	


/****************************************************
mb_tag_search_string
****************************************************/

	function mb_tag_search_string($content, $subject, $pretag, $posttag, $strict) {	//if $strict = true only string with same upper/lowercase as subject will get tagged
		if ($strict === true) {
			$replace_string = $pretag . $subject . $posttag;
			$content = str_replace($subject, $replace_string, $content);
		} else {
			//first lowercase (must be first if pretag or posttag contains small letters otherwise pretag and posttag will also get highlighted)
			$subject = mb_lcfirst($subject);
			$replace_string = $pretag . $subject . $posttag;
			$content = str_replace($subject, $replace_string, $content);
			//then uppercase
			$subject = ucfirst($subject);
			$replace_string = $pretag . $subject . $posttag;
			$content = str_replace($subject, $replace_string, $content);
		}
		return $content;
	}	




/****************************************************
mb_hex_opacity_to_rgba
****************************************************/

	function mb_hex_opacity_to_rgba($hex, $opacity) {
		$rgba_array = mb_hex_to_rgb($hex);
		$rgba_string = "rgba(" . implode(",", $rgba_array) . ",". $opacity . ")";
		return $rgba_string;
	}	

/****************************************************
mb_rgb_to_hex
****************************************************/
	function mb_rgb_to_hex($rgb) {		// input array(255,255,255);
	   $hex = "#";
	   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

	   return $hex; // returns the hex value including the number sign (#)
	}


/****************************************************
mb_hex_to_rgb
****************************************************/

	function mb_hex_to_rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}


/****************************************************
mb_get_google_webfonts_link
****************************************************/

	function mb_get_google_webfonts_link ($font_array) {
		//build vars
		$font_family = $font_array[0];
		$font_family = preg_replace('/\s/', '+', $font_family);
		$font_variant = $font_array[1];
		$font_subset = $font_array[2];


		//build google webfonts url
			//<link href='//fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		$google_webfonts_url = "<link href='//fonts.googleapis.com/css?family=";
		$google_webfonts_url .= $font_family;

		if ($font_variant != "regular") {
			$google_webfonts_url .= ":";
			$google_webfonts_url .= $font_variant;
		}

		if ($font_subset != "latin") {
			$google_webfonts_url .= "&subset=";
			$google_webfonts_url .= $font_subset;
		}

		$google_webfonts_url .= "' rel='stylesheet' type='text/css'>";

		return $google_webfonts_url;
			
	}


/****************************************************
mb_get_css_from_google_webfonts_settings_array
****************************************************/

	function mb_get_css_from_google_webfonts_settings_array ($font_array) {

		//build vars
		$css_string = '';
		$font_family = $font_array[0];
		$font_variant = $font_array[1];

		//font-family
		$css_string .= "font-family: \"$font_family\";\n";

		//font-style & font-weight
		if ($font_variant != "regular") {

			if (strpos($font_variant, 'italic') !== FALSE) {
				$css_string .= "font-style: italic;\n";
				$font_variant = str_replace("italic", "", $font_variant);
				if (!empty($font_variant)) { $css_string .= "font-weight: $font_variant;\n"; }
			} else {
				$css_string .= "font-style: normal;\n";
				$css_string .= "font-weight: $font_variant;\n";	
			}
				
		}

		return $css_string;
			
	}


/****************************************************
mb_build_delim_string_from_array
****************************************************/

	function mb_build_delim_string_from_array($array, $delim, $prefix, $postfix) {

		$return_string = "";
		foreach ($array as $key => $value) {
			$return_string .= $prefix . $key . $postfix . $delim;
		}
		$return_string = substr($return_string,0,strlen($return_string)-1);
		
		return $return_string;	
	}


/****************************************************
mb_add_value_to_delim_string
****************************************************/

	function mb_add_value_to_delim_string($string, $add_value, $delim, $add_if_duplicate) {
		$explode_arr = explode($delim, $string);	
		
		//check if duplicate
		$duplicate = false;
		foreach ($explode_arr as $key => $value) {
			if ($value == $add_value) $duplicate = true;			
		}

		//return $string untouched if not add on duplicate and duplicate found
		if ($add_if_duplicate == false && $duplicate == true) return $string;

		//in all other cases go ahead and update
		$string = $string . "," . $add_value;
		if (substr($string, 0, 1) == ",") $string = substr($string, 1, strlen($string)-1);

		return $string;
	}


/****************************************************
mb_del_value_to_delim_string
****************************************************/

	function mb_del_value_from_delim_string($string, $del_value, $delim) {
		$explode_arr = explode($delim, $string);
		$return_string = "";	
		
		//build return_string
		foreach ($explode_arr as $key => $value) {
			if ($value != $del_value) $return_string .= $value . ",";			
		}
		$return_string = substr($return_string, 0, strlen($return_string)-1);

		return $return_string;
	}


/****************************************************
mb_is_value_in_delim_string
****************************************************/

	function mb_is_value_in_delim_string($string, $check_value, $delim) {
		$explode_arr = explode($delim, $string);
		foreach ($explode_arr as $key => $value) {
			if ($value == $check_value) return true;	
		}
		return false;
	}


/****************************************************
mb_update_cookie_key_value
****************************************************/

	function mb_update_cookie_key_value ($cookie_name, $key, $value) {

		$cookie_string = $_COOKIE[$cookie_name];

		$key_value_array = explode('&', $cookie_string);
		$index_of_relevant_key_value_pair = -1;
		$pointer = 0;
		foreach ($key_value_array as $temp_key => $temp_value) {
			if (strpos($temp_value, $key) !== false) { $index_of_relevant_key_value_pair = $pointer; }
			$pointer++;
		}

		if ($index_of_relevant_key_value_pair == -1) {
			// key does not exist in cookie string
			$cookie_string .= "&" . $key . "=" . $value;	
		} else {
			// key exists in cookie string and must be updated
			$key_value_array[$index_of_relevant_key_value_pair] = $key . '=' . $value;
			// rebuild cookie_string
			$cookie_string = "";
			foreach ($key_value_array as $temp_key => $temp_value) {
				$cookie_string .= "&" . $temp_value;
			}
			if (substr($cookie_string, 0, 1) == "&") $cookie_string = substr($cookie_string, 1, strlen($cookie_string)-1);
		}


		// setcookie($cookie_name, "", time()+(60*60*24*365), COOKIEPATH, COOKIE_DOMAIN, false);
		setcookie($cookie_name, $cookie_string, time()+(60*60*24*365), COOKIEPATH, COOKIE_DOMAIN, false); 

		// important to also update global $_COOKIE var. This is only set at the start of a page request and is not updated with the setcookie function   
		$_COOKIE[$cookie_name] = $cookie_string;    
			
	}



/****************************************************
mb_cookie_get_key_value
****************************************************/

	//this function assumes your cookiestring is ordered like f.x. "likes=1,2,3,4,5&hates=none"
	//using mb_cookie_get_key_value('cookiename', 'likes') will return "1,2,3,4,5"

	function mb_cookie_get_key_value ($cookie_name, $key) {
		if (!isset($_COOKIE[$cookie_name])) return false;

		$cookiestring = $_COOKIE[$cookie_name];
		$explode_arr = explode($key . "=", $cookiestring);
		if (isset($explode_arr[1])) {
			$explode_arr = explode("&", $explode_arr[1]);
			return $explode_arr[0];
		} else {
			return "";	
		}
	}


/****************************************************
mb_localize_datetime
****************************************************/

	function mb_localize_datetime($datetime) {
		$datetime = str_replace('January', __('January', 'loc_canon'), $datetime);
		$datetime = str_replace('February', __('February', 'loc_canon'), $datetime);
		$datetime = str_replace('March', __('March', 'loc_canon'), $datetime);
		$datetime = str_replace('April', __('April', 'loc_canon'), $datetime);
		$datetime = str_replace('May', __('May', 'loc_canon'), $datetime);
		$datetime = str_replace('June', __('June', 'loc_canon'), $datetime);
		$datetime = str_replace('July', __('July', 'loc_canon'), $datetime);
		$datetime = str_replace('August', __('August', 'loc_canon'), $datetime);
		$datetime = str_replace('September', __('September', 'loc_canon'), $datetime);
		$datetime = str_replace('October', __('October', 'loc_canon'), $datetime);
		$datetime = str_replace('November', __('November', 'loc_canon'), $datetime);
		$datetime = str_replace('December', __('December', 'loc_canon'), $datetime);

		$datetime = str_replace('Jan', __('Jan', 'loc_canon'), $datetime);
		$datetime = str_replace('Feb', __('Feb', 'loc_canon'), $datetime);
		$datetime = str_replace('Mar', __('Mar', 'loc_canon'), $datetime);
		$datetime = str_replace('Apr', __('Apr', 'loc_canon'), $datetime);
		$datetime = str_replace('May', __('May', 'loc_canon'), $datetime);
		$datetime = str_replace('Jun', __('Jun', 'loc_canon'), $datetime);
		$datetime = str_replace('Jul', __('Jul', 'loc_canon'), $datetime);
		$datetime = str_replace('Aug', __('Aug', 'loc_canon'), $datetime);
		$datetime = str_replace('Sep', __('Sep', 'loc_canon'), $datetime);
		$datetime = str_replace('Oct', __('Oct', 'loc_canon'), $datetime);
		$datetime = str_replace('Nov', __('Nov', 'loc_canon'), $datetime);
		$datetime = str_replace('Dec', __('Dec', 'loc_canon'), $datetime);

		$datetime = str_replace('Monday', __('Monday', 'loc_canon'), $datetime);
		$datetime = str_replace('Tuesday', __('Tuesday', 'loc_canon'), $datetime);
		$datetime = str_replace('Wednesday', __('Wednesday', 'loc_canon'), $datetime);
		$datetime = str_replace('Thursday', __('Thursday', 'loc_canon'), $datetime);
		$datetime = str_replace('Friday', __('Friday', 'loc_canon'), $datetime);
		$datetime = str_replace('Saturday', __('Saturday', 'loc_canon'), $datetime);
		$datetime = str_replace('Sunday', __('Sunday', 'loc_canon'), $datetime);

		$datetime = str_replace('Mon', __('Mon', 'loc_canon'), $datetime);
		$datetime = str_replace('Tue', __('Tue', 'loc_canon'), $datetime);
		$datetime = str_replace('Wed', __('Wed', 'loc_canon'), $datetime);
		$datetime = str_replace('Thu', __('Thu', 'loc_canon'), $datetime);
		$datetime = str_replace('Fri', __('Fri', 'loc_canon'), $datetime);
		$datetime = str_replace('Sat', __('Sat', 'loc_canon'), $datetime);
		$datetime = str_replace('Sun', __('Sun', 'loc_canon'), $datetime);

		return $datetime;
			
	}
	


/****************************************************
mb_show_admin_notice
****************************************************/

	// show notice in the admin area. Classe: updated (yellow), error (red)
	function mb_show_admin_notice ($message, $class) {
		echo "<div class=$class>$message</div>";		
	}
	
/****************************************************
format_datetime_str
****************************************************/

	//format_str as shown in http://php.net/manual/en/function.date.php, datetime_str: mysql datetime like "2012-10-28 07:51:42", returns a formatted string.
	function format_datetime_str ($format_str, $datetime_str) {

		$timestamp = strtotime($datetime_str);
		$return_str = date($format_str, $timestamp);
		return $return_str;
	}

/****************************************************
mb_make_excerpt
****************************************************/

	//returns a string excerpt of length = $maxlen with "..." attached to the end if $by_word is set to true then will try to split by word looking back for a max of $search_len characters
	function mb_make_excerpt($string, $maxlen, $by_word) {

		$search_len = 10;

		$string = strip_shortcodes($string);
		$string = strip_tags($string);

		if (strlen($string)>$maxlen) {
			if ($by_word === true) {
				$string = substr($string, 0, $maxlen);
				for ($i = 1; $i < $search_len; $i++) {
					if (substr($string, $maxlen-$i, 1) == " ") {
						$string = substr($string, 0, $maxlen-$i) . " ...";
						return	$string;
					} 
				}
				//only gets here if a space haven't been found for during search_len
				$string = substr($string, 0, $maxlen-3) . "..."; 
			} else {
				$string = substr($string, 0, $maxlen-3) . "..."; 
			}
		}	

		return $string;
	}

/****************************************************
mb_get_page_type
****************************************************/

	//return the type of page/post/loop you're on. Returns false if called from environments with no type. Look here for more: http://codex.wordpress.org/Conditional_Tags
	function mb_get_page_type () {
		global $post;
		$type = false;	
		if (is_category()) { $type = 'category'; }
		if (is_time() ) { $type = 'time'; }
		if (is_day()) { $type = 'day'; }
		if (is_month()) { $type = 'month'; }
		if (is_year()) { $type = 'year'; }
		if (is_author()) { $type = 'author'; }
		if (is_tag()) { $type = 'tag'; }
		if (is_home()) { $type = 'home'; }
		if (is_admin()) { $type = 'admin'; }
		if (is_single()) { $type = 'single'; }
		if (is_page()) { $type = 'page'; }
		if (is_tax()) { $type = 'tax'; }
		if (is_search()) { $type = 'search'; }
		if (is_404()) { $type = '404'; }

		return $type;
	}

/****************************************************
mb_get_latest_tweets
****************************************************/

	//return latest tweets
	function mb_get_latest_tweets ($twitter_screen_name) //returns an array of tweet objects. The content is in ->text or on error returns false with errorlog in transient
	{
		$latest_tweets_data = get_transient('latest_tweets_data');		//returns object

		if ($latest_tweets_data === false || $twitter_screen_name != $latest_tweets_data->screen_name) {			//runs the actual function if there is no cached data or the username has changed
			//echo "NEW RUN!<br>";
			$latest_tweets = wp_remote_get("http://api.twitter.com/1/statuses/user_timeline.json?screen_name=" . $twitter_screen_name);

			if ($latest_tweets['response']['code']  == '200') {
				$latest_tweets = json_decode($latest_tweets['body']);

				$latest_tweets_data = new stdClass();
				$latest_tweets_data->screen_name = $twitter_screen_name;
				$latest_tweets_data->tweets = $latest_tweets;

				set_transient('latest_tweets_data', $latest_tweets_data, 60*20);
					
			} else {
				$latest_tweets = json_decode($latest_tweets['body']);
				if (isset($latest_tweets->error)) {
					$latest_tweets_error = $latest_tweets->error;	
				} elseif (isset($latest_tweets->errors[0]->message)) {
					$latest_tweets_error = $latest_tweets->errors[0]->message;
				} else {
					$latest_tweets_error = "Unknown error";
				}

				delete_transient('latest_tweets_data');
				set_transient('latest_tweets_error', $latest_tweets_error, 60*20);
				return false;								
			}
					
		}

		return $latest_tweets_data->tweets;
	}

/****************************************************
mb_filter_tweet
****************************************************/

	//filter a tweet and replace links with working links
	function mb_filter_tweet ($tweet) {
		$tweet = preg_replace ('/(http[^\s]+)/im','<a href="$1" target="_blank">$1</a>', $tweet);
		$tweet = preg_replace ('/@([^\s]+)/i','<a href="http://twitter.com/$1" target="_blank">@$1</a>', $tweet);
		$tweet = preg_replace ('/#([^\s\.\!]+)/i','<a href="https://twitter.com/search?q=%23$1&src=hash" target="_blank">#$1</a>', $tweet);

		return $tweet;
	}

/****************************************************
mb_time_ago_tweet
****************************************************/

	function mb_time_ago_tweet ($tweet_object) {

		$twitter_date = $tweet_object->created_at;
		$twitter_date_pieces = explode(" ", $twitter_date);
		$twitter_date_parsable = $twitter_date_pieces[2] . " " . $twitter_date_pieces[1] . " " . $twitter_date_pieces[5] . " " . $twitter_date_pieces[3];
		$twitter_date_timestamp = strtotime($twitter_date_parsable);
		$readable_time_diff = human_time_diff($twitter_date_timestamp);

		return $readable_time_diff;
	}

/****************************************************
mb_get_twitter_count
****************************************************/

	//returns num of followers on twitter
	function mb_get_twitter_count ($twitter_screen_name) {
		
		$twitter_count = get_transient('twitter_count');

		if ($twitter_count === false) {
			//echo "NEW RUN!<br>";
			if (!empty($twitter_screen_name)) {
				$tweets = wp_remote_get("http://api.twitter.com/1/users/show.json?screen_name=" . $twitter_screen_name);
				if ($tweets['response']['code']  == '200') {
					$tweets = json_decode($tweets['body']);
					$twitter_count = $tweets->followers_count;
					set_transient('twitter_count', $twitter_count, 60*20);
				} else {
					$tweets = json_decode($tweets['body']);
					$tweets = $tweets->errors[0]->message;
					return $tweets;
				}
			} else {
				$twitter_count = 0;
				set_transient('twitter_count', $twitter_count, 60*20);
			}
		}
		return $twitter_count;
	}


/****************************************************
mb_get_facebook_count
****************************************************/

	//returns num of likes on facebook
	function mb_get_facebook_count ($facebook_page) {
		
		$facebook_count = get_transient('facebook_count');

		if (!$facebook_count) {
			if (!empty($facebook_page)) {
				$facebook_data = wp_remote_get("http://graph.facebook.com/" . $facebook_page);
				$facebook_data = json_decode($facebook_data['body']);

				if (isset($facebook_data->likes)) {
					$facebook_count = $facebook_data->likes;
					set_transient('facebook_count', $facebook_count, 60*20);
				} else {
					$facebook_count = false;
				}
			} else {
				$facebook_count = 0;
				set_transient('facebook_count', $facebook_count, 60*20);
			}
		}

		return $facebook_count;
	}


/****************************************************
mb_get_rss_count
****************************************************/

	//returns num of subscribers to rss feed
	//WARNING: THE FEEDBURNER API IS DEFUNCT AS OF OCTOBER 2012. This means that the function is no longer working.	
	function mb_get_rss_count ($feedburner_account) {
		
		$rss_count = get_transient('rss_count');

		if (!$rss_count) {				//is local widget feedburner account set
			if(!empty($feedburner_account)) {
				$rss_data = wp_remote_get("http://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=" . $feedburner_account);
				$rss_data_body = simplexml_load_string($rss_data['body']);
				if ($rss_data_body->err || $rss_data['response']['code'] == '401' ) {			//notice feedburner returns (at least) two different kind of errors and does not have a general error handle
					$rss_count = false;
				} else {
					$rss_count = (int)$rss_data_body->feed->entry->attributes()->circulation;
					set_transient('rss_count', $rss_count, 60*20);
				}
			} else {
				$rss_count = 0;
				set_transient('rss_count', $rss_count, 60*20);
			}
		}
		return $rss_count;
	}


/****************************************************
mb_update_post_views
****************************************************/

	//update post views
	function mb_update_post_views($post_id) {
		$meta_key_views = 'post_views';
		$views = get_post_meta($post_id, $meta_key_views, true);
		if ($views == '') {
			$views = 1;
			delete_post_meta($post_id, $meta_key_views)	;
			update_post_meta($post_id, $meta_key_views, $views);
		} else {
			$views++;
			update_post_meta($post_id, $meta_key_views, $views);
		}

		return $views;
	}

/****************************************************
mb_get_post_views
****************************************************/

	//get post views
	function mb_get_post_views($post_id) {
		$meta_key_views = 'post_views';
		$views = get_post_meta($post_id, $meta_key_views, true);
		if ($views == '') {
			$views = 1;
			delete_post_meta($post_id, $meta_key_views);
			update_post_meta($post_id, $meta_key_views, $views);
		}
		return $views;
	}

/****************************************************
mb_update_post_views_single_check
****************************************************/

	// add the add_action to your functions.php if you want this function to run on wp_head action.
	// add_action('wp_head', 'mb_update_post_views_single_check' );
	function mb_update_post_views_single_check($post_id) {
		if (!is_single()) return;
		if (empty($post_id)) {
			global $post;
			$post_id = 	$post->ID;
		}
		mb_update_post_views($post_id);
	}


/****************************************************
mb_get_rating_percentage
****************************************************/

	function mb_get_rating_percentage ($rating, $min_rating, $max_rating, $increment, $ignore_increment) {
		//$ignore_increment (boolean) should usually be set to true. This is not mathematically correct when calculating rating %, but it is more easily understood by the end user.

		if ($ignore_increment === true) $increment = 1;
		$scale_resolution = ($max_rating - ($min_rating - $increment)) / $increment;
		$rel_rating = ($rating - ($min_rating - $increment)) / $increment;
		$rating_percentage = ($rel_rating / $scale_resolution) * 100;

		return $rating_percentage;
	}

/****************************************************
mb_get_rating_color
****************************************************/

	function mb_get_rating_color ($rating_percentage) {
		if ($rating_percentage >= 0) $rating_color = 'red';
		if ($rating_percentage >= 20) $rating_color = 'darkred';
		if ($rating_percentage >= 40) $rating_color = 'yellow';
		if ($rating_percentage >= 60) $rating_color = 'darkgreen';
		if ($rating_percentage >= 80) $rating_color = 'green';

		return $rating_color;
	}

/****************************************************
mb_get_rating_label
****************************************************/

	function mb_get_rating_label ($rating_percentage) {
		$megamag_options_post = get_option('megamag_options_post');
		$rating_label = 'n/a';

		for ($i = 0; $i < 101; $i=$i+10) {  
			$index = "review_label_" . $i;
			if ($rating_percentage >= $i) if (!empty($megamag_options_post[$index])) $rating_label = $megamag_options_post[$index];
		}
		return $rating_label;
	}

/****************************************************
mb_get_updated_order_array
****************************************************/

	/*************************************************
	This function updates the slider order
	It is called in these places:
	- options_homepage.php
	- template_slider.php

	it returns $order_array

	**************************************************/

	function mb_get_updated_order_array ($results_slider_posts) {

		$timedrop_options_hp = get_option('timedrop_options_hp');

		//update slider order so it matches cmb_slider_feature posts

		//init variables
		$slider_array = array();
		$order_array = array();

		//build our two arrays for comparison. First slider_array
		foreach ($results_slider_posts as $slider_post) $slider_array[] = $slider_post->ID;

		//the order_array
		if (!empty($timedrop_options_hp['slider_order'])) {
			$order_array = explode (',', $timedrop_options_hp['slider_order']);
		} else {
			for ($i = 0; $i < count($results_slider_posts); $i++) {  
				$order_array[$i] = $results_slider_posts[$i]->ID;
			}	
		}

		if (count($slider_array) != count($order_array)) {						//something is up, the two arrays are not same length
			if (count($slider_array) > count($order_array)) {					//posts have been added - update order
				$diff_array = array_diff($slider_array, $order_array);			//array diff nb: the sequence of arrays is important.
				$new_order_array = array_merge($order_array, $diff_array);
				$order_string = "";
				foreach ($new_order_array as $new) {
					$order_string .= $new . ",";
				}
				$order_string = substr($order_string, 0, strlen($order_string)-1);

			} elseif (count($slider_array) < count($order_array)) {				//posts have been removed - update order
				$diff_array = array_diff($order_array, $slider_array);
				$new_order_array = array_diff($order_array, $diff_array);
				$order_string = "";
				foreach ($new_order_array as $new) {
					$order_string .= $new . ",";
				}
				$order_string = substr($order_string, 0, strlen($order_string)-1);
			}	

			//save and update
			$timedrop_options_hp['slider_order']	= $order_string;
			update_option('timedrop_options_hp', $timedrop_options_hp);
			$timedrop_options_hp = get_option('timedrop_options_hp'); 

			//and build new order array
			if (!empty($timedrop_options_hp['slider_order'])) {
				$order_array = explode (',', $timedrop_options_hp['slider_order']);
			} else {
				for ($i = 0; $i < count($results_slider_posts); $i++) {  
					$order_array[$i] = $results_slider_posts[$i]->ID;
				}	
			}
		}

		return $order_array;

	}		//end function

/****************************************************
mb_get_updated_order_array_projects
****************************************************/

	/*************************************************
	This function updates the slider order
	It is called in these places:
	- options_homepage.php
	- template_slider.php

	it returns $order_array

	**************************************************/

	function mb_get_updated_order_array_projects ($results_slider_posts) {

		$timedrop_options_hp = get_option('timedrop_options_hp');

		//update slider order so it matches cmb_slider_feature posts

		//init variables
		$slider_array = array();
		$order_array = array();

		//build our two arrays for comparison. First slider_array
		foreach ($results_slider_posts as $slider_post) $slider_array[] = $slider_post->ID;

		//the order_array
		if (!empty($timedrop_options_hp['slider_order_projects'])) {
			$order_array = explode (',', $timedrop_options_hp['slider_order_projects']);
		} else {
			for ($i = 0; $i < count($results_slider_posts); $i++) {  
				$order_array[$i] = $results_slider_posts[$i]->ID;
			}	
		}

		if (count($slider_array) != count($order_array)) {						//something is up, the two arrays are not same length
			if (count($slider_array) > count($order_array)) {					//posts have been added - update order
				$diff_array = array_diff($slider_array, $order_array);			//array diff nb: the sequence of arrays is important.
				$new_order_array = array_merge($order_array, $diff_array);
				$order_string = "";
				foreach ($new_order_array as $new) {
					$order_string .= $new . ",";
				}
				$order_string = substr($order_string, 0, strlen($order_string)-1);

			} elseif (count($slider_array) < count($order_array)) {				//posts have been removed - update order
				$diff_array = array_diff($order_array, $slider_array);
				$new_order_array = array_diff($order_array, $diff_array);
				$order_string = "";
				foreach ($new_order_array as $new) {
					$order_string .= $new . ",";
				}
				$order_string = substr($order_string, 0, strlen($order_string)-1);
			}	

			//save and update
			$timedrop_options_hp['slider_order_projects']	= $order_string;
			update_option('timedrop_options_hp', $timedrop_options_hp);
			$timedrop_options_hp = get_option('timedrop_options_hp'); 

			//and build new order array
			if (!empty($timedrop_options_hp['slider_order_projects'])) {
				$order_array = explode (',', $timedrop_options_hp['slider_order_projects']);
			} else {
				for ($i = 0; $i < count($results_slider_posts); $i++) {  
					$order_array[$i] = $results_slider_posts[$i]->ID;
				}	
			}
		}

		return $order_array;

	}		//end function


/****************************************************
mb_get_key_from_order_array_by_index
****************************************************/

	function mb_get_key_from_order_array_by_index ($i) {
		$megamag_options_post = get_option('megamag_options_post');
		$rating_label = 'n/a';

		for ($i = 0; $i < 101; $i=$i+10) {  
			$index = "review_label_" . $i;
			if ($rating_percentage >= $i) if (!empty($megamag_options_post[$index])) $rating_label = $megamag_options_post[$index];
		}
		return $rating_label;
	}


