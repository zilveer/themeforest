<?php
/*
 * Based on Plugin: Ajaxy Live Search - http://ajaxy.org
*/
define('WEBNUS_SEARCH_NO_IMAGE', get_template_directory_uri().'/images/no-image.gif');
class AjaxyLiveSearch {

	public static $woocommerce_taxonomies = array('product_cat', 'product_tag', 'product_shipping_class');
	public static $woocommerce_post_types = array('product', 'shop_order', 'shop_coupon');
	
	private $noimage = '';
	function __construct(){
		add_action( 'wp_head', array(&$this, 'head'));
		add_action( 'wp_ajax_ajaxy_sf', array(&$this, 'get_search_results'));
		add_action( 'wp_ajax_nopriv_ajaxy_sf', array(&$this, 'get_search_results'));
	}



	function get_image_from_content($content, $width_max, $height_max){
		//return false;
		$theImageSrc = false;
		preg_match_all ('/<img[^>]+>/i', $content, $matches);
		$imageCount = count ($matches);
		if ($imageCount >= 1) {
			if (isset ($matches[0][0])) {
				preg_match_all('/src=("[^"]*")/i', $matches[0][0], $src);
				if (isset ($src[1][0])) {
					$theImageSrc = str_replace('"', '', $src[1][0]);
				}
			}
		}
			set_time_limit(0);
			try{
				set_time_limit(1);
				list($width, $height, $type, $attr) = @getimagesize( $theImageSrc );
				if($width > 0 && $height > 0){
					if($width < $width_max && $height < $height_max){
						return array('src' => $theImageSrc, 'width' => $width, 'height' => $height);	
					}
					elseif($width > $width_max && $height > $height_max){
						$percent_width = $width_max * 100/$width;
						$percent_height = $height_max * 100/$height;
						$percent = ($percent_height < $percent_width ? $percent_height : $percent_width);
						return array('src' => $theImageSrc, 'width' => intval($width * $percent / 100), 'height' => intval($height * $percent / 100));	
					}
					elseif($width < $width_max && $height > $height_max){
						$percent = $height * 100/$height_max;
						return array('src' => $theImageSrc, 'width' => intval($width * $percent / 100), 'height' => intval($height * $percent / 100));		
					}
					else{
						$percent = $width * 100/$width_max;
						return array('src' => $theImageSrc, 'width' => intval($width * $percent / 100), 'height' => intval($height * $percent / 100));	
					}
				}
			}
			catch(Exception $e){
				set_time_limit(60);
				return array('src' => $theImageSrc, 'width' => 50 , 'height' => 50 );
			}
		return false;
	}
	function get_post_types()
	{
		$post_types = get_post_types(array('_builtin' => false),'objects');
		$post_types['post'] = get_post_type_object('post');
		$post_types['page'] = get_post_type_object('page');
		unset($post_types['wpsc-product-file']);
		return $post_types;
	}
	function get_excerpt_count()
	{
		return 10;
	}
	function get_taxonomies() {
		$args = array(
			'public'   => true,
			'_builtin' => false
		); 
		$output = 'objects'; // or objects
		$operator = 'or'; // 'and' or 'or'
		$taxonomies = get_taxonomies( $args, $output, $operator ); 
		if ( $taxonomies ) {
			return $taxonomies;
		}
		return null;
	}
	function get_search_objects($all = false, $objects = false, $specific_post_types = array(), $specific_taxonomies = array(), $specific_roles = array())
	{
		$search = array();
		$scat = (array)$this->get_setting('category');
		$arg_category_show = isset($_POST['show_category']) ? $_POST['show_category'] : 1;
		
		$search_taxonomies = false;
		
		if($scat['show'] == 1 && $arg_category_show == 1){
			$search_taxonomies = true;
		}
		$arg_post_category_show = isset($_POST['show_post_category']) ? $_POST['show_post_category'] : 1;
		
		$show_post_category = false;
		
		if($scat['ushow'] == 1 && $arg_post_category_show == 1){
			$show_post_category = true;
		}
		
		$arg_authors_show = isset($_POST['show_authors']) ? $_POST['show_authors'] : 1;
		
		$show_authors = false;
		
		if($show_authors == 1){
			$show_authors = true;
		}
		if(!$objects || $objects == 'post_type') {
			// get all post types that are ready for search
			$post_types = $this->get_post_types();
			foreach($post_types as $post_type)
			{		
				if(sizeof($specific_post_types) == 0) {	
					$setting = $this->get_setting($post_type->name);
					if($setting -> show == 1 || $all){
						$search[] = array(
							'order' => $setting->order, 
							'name' => $post_type->name, 
							'label' => 	(empty($setting->title) ? $post_type->label : $setting->title), 
							'type' => 	'post_type'
						);
					}
				}
				elseif(in_array($post_type->name, $specific_post_types)) {
					$setting = $this->get_setting($post_type->name);
					$search[] = array(
							'order' => $setting->order, 
							'name' => $post_type->name, 
							'label' => 	(empty($setting->title) ? $post_type->label : $setting->title), 
							'type' => 	'post_type'
					);
				}
			}
		}
		if((!$objects || $objects == 'taxonomy') && $search_taxonomies) {
			// override post_types from input

			$taxonomies = $this->get_taxonomies();
			foreach($taxonomies as $taxonomy)
			{		
				if(sizeof($specific_taxonomies) == 0) {	
					$setting = $this->get_setting($taxonomy->name);
					if($setting -> show == 1 || $all){
						$search[] = array(
							'order' => $setting->order, 
							'name' => $taxonomy->name, 
							'label' => 	(empty($setting->title) ? $taxonomy->label : $setting->title), 
							'type' => 	'taxonomy',
							'show_posts' => $show_post_category
						);
					}
				}
				elseif(in_array($taxonomy->name, $specific_taxonomies)) {
					$setting = $this->get_setting($taxonomy->name);
					$search[] = array(
							'order' => $setting->order, 
							'name' => $taxonomy->name, 
							'label' => 	(empty($setting->title) ? $taxonomy->label : $setting->title), 
							'type' => 	'taxonomy',
							'show_posts' => $show_post_category
						);
				}
			}
		}elseif((!$objects || $objects == 'taxonomy')) {
			// override post_types from input

			$taxonomies = $this->get_taxonomies();
			foreach($taxonomies as $taxonomy)
			{		
				if(sizeof($specific_taxonomies) == 0) {	
					$setting = $this->get_setting($taxonomy->name);
					if($setting -> show == 1 || $all){
						$search[] = array(
							'order' => $setting->order, 
							'name' => $taxonomy->name, 
							'label' => 	(empty($setting->title) ? $taxonomy->label : $setting->title), 
							'type' => 	'taxonomy',
							'show_posts' => $show_post_category
						);
					}
				}
				elseif(in_array($taxonomy->name, $specific_taxonomies)) {
					$setting = $this->get_setting($taxonomy->name);
					$search[] = array(
							'order' => $setting->order, 
							'name' => $taxonomy->name, 
							'label' => 	(empty($setting->title) ? $taxonomy->label : $setting->title), 
							'type' => 	'taxonomy',
							'show_posts' => $show_post_category
						);
				}
			}
		}
		if(!$objects || $objects == 'author') {

			global $wp_roles;
			$roles = $wp_roles->get_names();
			
			foreach($roles as $role => $label)
			{		
				if(sizeof($specific_roles) == 0) {	
					$setting = $this->get_setting('role_'.$role, false);
					if($setting -> show == 1 || $all){
						$search[] = array(
							'order' => $setting->order, 
							'name' => $role, 
							'label' => 	(empty($setting->title) ? $label : $setting->title), 
							'type' => 	'role'
						);
					}
				}
				elseif(in_array($role, $specific_roles)) {
					$setting = $this->get_setting('role_'.$role, false);
					$search[] = array(
						'order' => $setting->order, 
						'name' => $role, 
						'label' => 	(empty($setting->title) ? $label : $setting->title), 
						'type' => 	'role'
					);
				}
			}
		}
		uasort($search, array(&$this, 'sort_search_objects'));

		return $search;
	}
	function sort_search_objects($a, $b) {
		if ($a['order'] == $b['order']) {
			return 0;
		}
		return ($a['order'] < $b['order']) ? -1 : 1;
	}
	function set_templates($template, $html)
	{
		if(get_option('sf_template_'.$template) !== false)
		{
			update_option('sf_template_'.$template, stripslashes($html));
		}
		else
		{
			add_option('sf_template_'.$template, stripslashes($html));
		}
	}
	function set_setting($name, $value)
	{
		if(get_option('sf_setting_'.$name) !== false)
		{
			update_option('sf_setting_'.$name, json_encode($value));
		}
		else
		{
			add_option('sf_setting_'.$name, json_encode($value));
		}
	}
	function remove_setting($name){
		delete_option('sf_setting_'.$name);
	}
	function get_setting($name, $public = true)
	{
		$defaults = array(
						'title' => '', 
						'show' => 1,
						'ushow' => 0,
						'search_content' => 1,
						'limit' => 5,
						'order' => 0,
						'order_results' => false
						);
		if(!$public) {
			$defaults['show'] = 0;
		}
		if(get_option('sf_setting_'.$name) !== false)
		{
			$settings = json_decode(get_option('sf_setting_'.$name));
			foreach($defaults as $key => $value) {
				if(!isset($settings->{$key})){
					$settings->{$key} = $value;
				}
			}
			return $settings;
		}
		else
		{
			return (object)$defaults;
		}
	}
	function set_style_setting($name, $value)
	{
		update_option('sf_style_'.$name, $value);
	}
	function get_style_setting($name, $default = '')
	{
		if(get_option('sf_style_'.$name) !== false)
		{
			return get_option('sf_style_'.$name, $default);
		}
		else
		{
			return $default;
		}
	}
	function remove_style_setting($name)
	{
		return delete_option('sf_style_'.$name);
	}
	function remove_template($template)
	{
		delete_option('sf_template_'.$template);
	}
	function get_templates($template, $type='')
	{
		$template_post = "";
		switch($type) {
			case 'more':
				$template_post = get_option('sf_template_more');
				if(!$template_post) {
					$template_post = '<a href="{search_url_escaped}"><span class="sf_text">See more results</span><span class="sf_small">Displaying top {total} results</span></a>';
				}
				break;
			case 'taxonomy':
				$template_post = get_option('sf_template_'.$template);
				if(!$template_post) {
					$template_post = '<a href="{category_link}">{name}</a>';
				}
				break;
			case 'author':
			case 'role':
				$template_post = get_option('sf_template_'.$template);
				if(!$template_post) {
					$template_post = '<a href="{author_link}">{user_nicename}</a>';
				}
				break;
			case 'post_type':
				$template_post = get_option('sf_template_'.$template);
				if(!$template_post && in_array($template, self::$woocommerce_post_types)) {
					$template_post = '<a href="{post_link}">{post_image_html}<span class="sf_text">{post_title} - {price}</span><span class="sf_small">Posted by {post_author} on {post_date_formatted}</span></a>';
				}elseif(!$template_post){
					$template_post = '<a href="{post_link}">{post_image_html}<span class="sf_text">{post_title} </span><span class="sf_small">Posted by {post_author} on {post_date_formatted}</span></a>';
				}
				break;
			default:
				$template_post = get_option('sf_template_'.$template);
				if(!$template_post) {
					$template_post = '<a href="{post_link}">{post_image_html}<span class="sf_text">{post_title} </span><span class="sf_small">Posted by {post_author} on {post_date_formatted}</span></a>';
				}
				break;
		}
		return $template_post;
	}
	function category($name, $taxonomy = 'category', $show_category_posts = false, $limit = 5)
	{
		global $wpdb;

		$categories = array();
		$setting = (object)$this->get_setting($taxonomy);

		$excludes = "";
		$excludes_array = array();
		if(isset($setting->excludes) && sizeof($setting->excludes) > 0 && is_array($setting->excludes)){
			$excludes = " AND $wpdb->terms.term_id NOT IN (".implode(',', $setting->excludes).")";
			$excludes_array = $setting->excludes;
		}
		$results = null;
		
		$query = "
			SELECT 
				distinct($wpdb->terms.name)
				, $wpdb->terms.term_id
				, $wpdb->term_taxonomy.taxonomy 
			FROM 
				$wpdb->terms
				, $wpdb->term_taxonomy 
			WHERE 
				name LIKE '%%%s%%' 
				AND $wpdb->term_taxonomy.taxonomy = '$taxonomy' 
				AND $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id 
			$excludes 
			LIMIT 0, %d";
			
		$query = apply_filters("sf_category_query", $wpdb->prepare($query,  $name, $setting->limit), $name, $excludes_array, $setting->limit);

		$results = $wpdb->get_results($query);

		if(sizeof($results) > 0 && is_array($results) && !is_wp_error($results))
		{
			$unset_array = array('term_group', 'term_taxonomy_id', 'taxonomy', 'parent', 'count', 'cat_ID', 'cat_name', 'category_parent');
			foreach($results as $result)
			{
				$cat = get_term($result->term_id, $result->taxonomy);
				if($cat != null && !is_wp_error($cat))
				{	
					$cat_object = new stdclass();
					$category_link = get_term_link($cat);
					$cat_object->category_link = $category_link;
					
					$matches = array();
					$template = $this->get_templates( $taxonomy, 'taxonomy' );
					preg_match_all ("/\{.*?\}/", $template, $matches);
					
					foreach($matches[0] as $match){
						$match = str_replace(array('{', '}'), '', $match);
						if(isset($cat->{$match})) {
							$cat_object->{$match} = $cat->{$match};
						}
					}
					if($show_category_posts) {
						$limit = isset($setting->limit_posts) ? $setting->limit_posts : 5;
						$psts = $this->posts_by_term($cat->term_id, $taxonomy, $limit);
						if(sizeof($psts) > 0) {
							$categories[$cat->term_id] = array('name' => $cat->name,'posts' => $this->posts_by_term($cat->term_id, $limit)); 
						}
					}
					else {
						$categories[] = $cat_object; 
					}
				}
			}
		}
		return $categories;
	}	
	function author($name, $show_author_posts = false, $limit = 5)
	{
		global $wpdb;

		$authors = array();
	
		$results = null;
		
		$query = "
			SELECT 
				*
			FROM 
				$wpdb->users
			WHERE 
				ID IN (
					SELECT 	
						ID 
					FROM 
						$wpdb->usermeta 
					WHERE 
						(meta_key = 'first_name' AND meta_value LIKE '%%%s%%')
						OR (meta_key = 'last_name' AND meta_value LIKE '%%%s%%' )
						OR (meta_key = 'nickname' AND meta_value LIKE '%%%s%%' )
				)
		";	
		$query = apply_filters("sf_authors_query", $wpdb->prepare($query,  $name,  $name,  $name), $name);

		$results = $wpdb->get_results($query);
		
		if(sizeof($results) > 0 && is_array($results) && !is_wp_error($results))
		{
			foreach($results as $result)
			{
				$authors[] = new WP_User($result->ID);
			}
		}
		return $authors;
	}
	function filter_authors_by_role($authors, $role) {
		$users = array();
		$setting = (object)$this->get_setting('role_'.$role, false);

		$excludes = "";
		$excludes_array = array();
		if(isset($setting->excludes) && sizeof($setting->excludes) > 0 && is_array($setting->excludes)){
			$excludes_array = $setting->excludes;
		}
		$template = $this->get_templates( 'role_'.$role, 'author' );
		$matches = array();
		preg_match_all ("/\{.*?\}/", $template, $matches);
		if(sizeof($matches) > 0) {
			
			foreach($authors as $author) {
				if(in_array($role, $author->roles) && !in_array($author->ID,$excludes_array)) {
					$user = new stdClass();
					foreach($matches[0] as $match) {
						$match = str_replace(array('{', '}'), '', $match);
						$method = "get_".$match;
						if(method_exists ($author->data, $method)){
							$user->{$match} = call_user_func(array($author->data,$method));
						}elseif(method_exists ($author, $match)){
							$user->{$match} = call_user_func(array($author->data,$match));
						}elseif(property_exists ($author->data, $match)){
							$user->{$match} = $author->data->{$match};
						}
					}
					if(in_array('{author_link}', $matches[0])){
						$user->author_link = get_author_posts_url($author->ID);
					}
					$users[] = $user;
				}
			}
		}
		return $users;
	}
	function posts($name, $post_type='post', $term_id = false)
	{
		global $wpdb;
		$posts = array();
		$setting = (object)$this->get_setting($post_type);
		$excludes = "";
		$excludes_array = array();
		if(isset($setting->excludes) && sizeof($setting->excludes) > 0 && is_array($setting->excludes)){
			$excludes = " AND ID NOT IN (".implode(',', $setting->excludes).")";
			$excludes_array = $setting->excludes;
		}
		
		$order_results = ($setting->order_results ? " ORDER BY ".$setting->order_results : "");
		$results = array();
		
		$query = "
			SELECT 
				$wpdb->posts.ID 
			FROM 
				$wpdb->posts
			WHERE 
				(post_title LIKE '%%%s%%' ".($setting->search_content == 1 ? "or post_content LIKE '%%%s%%')":")")." 
				AND post_status='publish' 
				AND post_type='".$post_type."' 
				$excludes 
				$order_results 
			LIMIT 0, %d";
		/*
		$meta_query = "
			SELECT 
				project_id.post_id
				, height.height
				, width.width
			FROM 
				$wpdb->postmeta
			WHERE 
				meta_key = '$meta_key'
				AND meta_value LIKE '$meta_value'
			";
		*/
		$query = apply_filters("sf_posts_query", ($setting->search_content == 1 ? $wpdb->prepare($query, $name, $name, $setting->limit) :$wpdb->prepare($query, $name, $setting->limit)), $name, $post_type, $excludes_array, $setting->search_content, $order_results, $setting->limit);

		$results = $wpdb->get_results( $query );
		
		
		if(sizeof($results) > 0 && is_array($results) && !is_wp_error($results))
		{
			$template = $this->get_templates( $post_type, 'post_type' );
			$matches = array();
			preg_match_all ("/\{.*?\}/", $template, $matches);
			if(sizeof($matches) > 0) {
				foreach($results as $result)
				{
					$pst = $this->post_object($result->ID, $term_id, $matches[0]);
					if($pst){
						$posts[] = $pst; 
					}
				}
			}
		}
		return $posts;
	}
	function posts_by_term($term_id, $taxonomy, $limit = 5){
		$posts = array();
		$args = array( 
				'showposts' => $limit,
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'terms' => $term_id,
						'field' => 'term_id',
					)
				),
				'orderby' => 'date',
				'order' => 'DESC' 
			);
		$term_query = new WP_Query( $args );
		if($term_query->have_posts()) :
			$psts = apply_filters('sf_pre_term_posts', $term_query->posts);
			if(sizeof($psts) > 0) {
				foreach($psts as $p) {
					$matches = array();
					$template = $this->get_templates( $p->post_type, 'post_type' );
					preg_match_all ("/\{.*?\}/", $template, $matches);
					$posts[] = $this->post_object($p->ID, false, $matches[0]);
				}
			}
			$posts = apply_filters('sf_term_posts', $posts);
		endif;
		return $posts;
	}
	function post_object($id, $term_id = false, $matches = false) {
		$unset_array = array('post_date_gmt', 'post_status', 'comment_status', 'ping_status', 'post_password', 'post_content_filtered', 'to_ping', 'pinged', 'post_modified', 'post_modified_gmt', 'post_parent', 'guid', 'menu_order', 'post_mime_type', 'comment_count', 'ancestors', 'filter');
		global $post;
		$date_format = get_option( 'date_format' );
		$post = get_post($id);
		if($term_id) {	
			if(!in_category($term_id, $post->ID)){
				return false;
			}
		}
		$size = array('height' => 50, 'width' => 50);
		if($post != null)
		{
			$post_object = new stdclass();
			$post_link = get_permalink($post->ID);

			if(in_array('{post_image}', $matches) || in_array('{post_image_html}', $matches)) {
				$post_thumbnail_id = get_post_thumbnail_id( $post->ID);
				if( $post_thumbnail_id > 0)
				{
					$thumb = wp_get_attachment_image_src( $post_thumbnail_id, array($size['height'], $size['width']) );
					$post_object->post_image =  (trim($thumb[0]) == "" ? WEBNUS_SEARCH_NO_IMAGE : $thumb[0]);
					if(in_array('{post_image_html}', $matches)) {
						$post_object->post_image_html = '<img src="'.$post_object->post_image.'" width="'.$size['width'].'" height="'.$size['height'].'"/>';
					}
				}
				else
				{
					if($src = $this->get_image_from_content($post->post_content, $size['height'], $size['width'])){
						$post_object->post_image = $src['src'] ? $src['src'] : WEBNUS_SEARCH_NO_IMAGE;
						if(in_array('{post_image_html}', $matches)) {
							$post_object->post_image_html = '<img src="'.$post_object->post_image.'" width="'.$src['width'].'" height="'.$src['height'].'" />';
						}
					}
					else{
						$post_object->post_image = WEBNUS_SEARCH_NO_IMAGE;
						if(in_array('{post_image_html}', $matches)) {
							$post_object->post_image_html = '';
						}
					}
				}
			}
			if($post->post_type == "wpsc-product"){
				if(function_exists('wpsc_calculate_price')){
					if(in_array('{wpsc_price}', $matches)){
						$post_object->wpsc_price = wpsc_the_product_price();
					}if(in_array('{wpsc_shipping}', $matches)){
						$post_object->wpsc_shipping = strip_tags(wpsc_product_postage_and_packaging());	
					}if(in_array('{wpsc_image}', $matches)){
						$post_object->wpsc_image = wpsc_the_product_image($size['height'], $size['width']);
					}
				}
			}
			if($post->post_type == 'product' && class_exists('WC_Product_Factory')) {
				$product_factory = new WC_Product_Factory();
				global $product;
				$product = $product_factory->get_product($post);
				if($product->is_visible()) {
					foreach($matches as $match) {
						$match = str_replace(array('{', '}'), '', $match);
						if(in_array($match, array('categories', 'tags'))) {
							$method = "get_".$match;
							if(method_exists ($product, $method)){
								$term_list = call_user_func(array($product, $method), '');
								if($term_list){
									$post_object->{$match} = '<span class="sf_list sf_'.$match.'">'.$term_list.'</span>';
								}else{
									$post_object->{$match} = "";
								}
							}
						}elseif($match == 'add_to_cart_button'){
							ob_start();
							do_action( 'woocommerce_' . $product->product_type . '_add_to_cart'  );
							$post_object->{$match} = '<div class="product">'.ob_get_contents().'</div>';
							ob_end_clean();
						}else{
							$method = "get_".$match;
							if(method_exists ($product, $method)){
								$post_object->{$match} = call_user_func(array($product, $method));
							}elseif(method_exists ($product, $match)){
								$post_object->{$match} = call_user_func(array($product, $match));
							}
						}
					}
				}
				/*
				$post->sku = $product->get_sku();
				$post->sale_price = $product->get_sale_price();
				$post->regular_price = $product->get_regular_price();
				$post->price = $product->get_price();
				$post->price_including_tax = $product->get_price_including_tax();
				$post->price_excluding_tax = $product->get_price_excluding_tax();
				$post->price_suffix = $product->get_price_suffix();
				$post->price_html = $product->get_price_html();
				$post->price_html_from_text = $product->get_price_html_from_text();
				$post->average_rating = $product->get_average_rating();
				$post->rating_count = $product->get_rating_count();
				$post->rating_html = $product->get_rating_html();
				$post->dimensions = $product->get_dimensions();
				$post->shipping_class = $product->get_shipping_class();
				$post->add_to_cart_text = $product->add_to_cart_text();
				$post->single_add_to_cart_text = $product->single_add_to_cart_text();
				$post->add_to_cart_url = $product->add_to_cart_url();
				$post->title = $product->get_title();
				*/
			}
			$post_object->ID = $post->ID;
			$post_object->post_title = get_the_title($post->ID);
			
			if(in_array('{post_excerpt}', $matches)) {
				$post_object->post_excerpt = $post->post_excerpt;
			}if(in_array('{post_author}', $matches)) {
				$post_object->post_author = get_the_author_meta('display_name', $post->post_author);
			}if(in_array('{post_link}', $matches)) {
				$post_object->post_link = $post_link;
			}if(in_array('{post_content}', $matches)) {
				$post_object->post_content = $this->get_text_words(apply_filters('the_content', $post->post_content) ,(int)$this->get_excerpt_count());
			}if(in_array('{post_date_formatted}', $matches)) {
				$post_object->post_date_formatted = date($date_format,  strtotime( $post->post_date) );
			}

			
			
			foreach($matches as $match) {
				$match = str_replace(array('{', '}'), '', $match);

				if(strpos($match, 'custom_field_') !== false){
					$key =  str_replace('custom_field_', '', $match);
					$custom_field = get_post_meta($post->ID, $key, true);
					if ( is_array($custom_field) ) {
						$cf_name = 'custom_field_'.$key;
						$post_object->{$cf_name} = apply_filters('sf_post_custom_field', $custom_field[0], $key, $post);
					}else{
						$cf_name = 'custom_field_'.$key;
						$post_object->{$cf_name} = apply_filters('sf_post_custom_field', $custom_field, $key, $post);
					}
				}
			}

			$post_object = apply_filters('sf_post', $post_object);
			return $post_object;
		}
		return false;
	}
	function get_text_words($text, $count)
	{
		$tr = explode(' ', strip_tags(strip_shortcodes($text)));
		$s = "";
		for($i = 0; $i < $count && $i < sizeof($tr); $i++)
		{
			$s[] = $tr[$i];
		}
		return implode(' ', $s);
	}

	function head()
	{
		wp_register_script('live-search', get_template_directory_uri() . '/js/live-search.js', null, null, true	);
		wp_enqueue_script('live-search' );
		
		
		$settings = array(
			'label' => __('Search','webnus_framework'),
			'expand' => false
		);
		
		$live_search_settings = json_encode(
			array(
				'expand' => $settings['expand']
				,'searchUrl' =>  home_url().'/?s=%s'
				,'text' => $settings['label']
				,'delay' => 500
				,'iwidth' => 180 
				,'width' => 315
				,'ajaxUrl' => $this->get_ajax_url()
				,'rtl' => 0
			)
		);
		?>
		<script type="text/javascript">
			/* <![CDATA[ */
				var sf_position = '0';
				var sf_templates = <?php echo json_encode($this->get_templates('more', 'more')); ?>;
				var sf_input = '.live-search';
				jQuery(document).ready(function(){
					jQuery(sf_input).ajaxyLiveSearch(<?php echo $live_search_settings; ?>);
					jQuery(".sf_ajaxy-selective-input").keyup(function() {
						var width = jQuery(this).val().length * 8;
						if(width < 50) {
							width = 50;
						}
						jQuery(this).width(width);
					});
					jQuery(".sf_ajaxy-selective-search").click(function() {
						jQuery(this).find(".sf_ajaxy-selective-input").focus();
					});
					jQuery(".sf_ajaxy-selective-close").click(function() {
						jQuery(this).parent().remove();
					});
				});
			/* ]]> */
		</script>
		<?php
	}
	function get_ajax_url(){
		if(defined('ICL_LANGUAGE_CODE')){
			return admin_url('admin-ajax.php').'?lang='.ICL_LANGUAGE_CODE;
		}
		if(function_exists('qtrans_getLanguage')){

			return admin_url('admin-ajax.php').'?lang='.qtrans_getLanguage();
		}
		return admin_url('admin-ajax.php');
	}

	function get_search_results()
	{
		$results = array();
		$sf_value = apply_filters('sf_value', $_POST['sf_value']);
		if(!empty($sf_value))
		{
			//filter taxonomies if set
			$arg_taxonomies = isset($_POST['taxonomies']) && trim($_POST['taxonomies']) != "" ? explode(',', trim($_POST['taxonomies'])) : array();
			// override post_types from input
			$arg_post_types = isset($_POST['post_types']) && trim($_POST['post_types']) != "" ? explode(',', trim($_POST['post_types'])) : array();
			
			$search = $this->get_search_objects(false, false, $arg_post_types, $arg_taxonomies);
			$author_searched = false;
			$authors = array();
			foreach($search as $key => $object)
			{
				if($object['type'] == 'post_type') {
					$posts_result = $this->posts($sf_value, $object['name']);
					if(sizeof($posts_result) > 0) {
						$results[$object['name']][0]['all'] = $posts_result;
						$results[$object['name']][0]['template'] = $this->get_templates($object['name'], 'post_type');
						$results[$object['name']][0]['title'] = $object['label'];
						$results[$object['name']][0]['class_name'] = 'sf_item'.(in_array($object['name'], self::$woocommerce_post_types) ? ' woocommerce': '');
					}
				}
				elseif($object['type'] == 'taxonomy') {
					if($object['show_posts']) {
						$taxonomy_result = $this->category($sf_value, $object['name'], $object['show_posts']);
						if(sizeof($taxonomy_result) > 0) {
							$cnt = 0;
							foreach($taxonomy_result as $key => $val) {
								if(sizeof($val['posts']) > 0) {
									$results[$object['name']][$cnt]['all'] = $val['posts'];
									$results[$object['name']][$cnt]['template'] = $this->get_templates($object['name'], 'taxonomy');
									$results[$object['name']][$cnt]['title'] = $object['label'];
									$results[$object['name']][$cnt]['class_name'] = 'sf_category';
									$cnt ++;
								}
							}
						}
					}else{
						$taxonomy_result = $this->category($sf_value, $object['name']);
						if(sizeof($taxonomy_result) > 0) {
							$results[$object['name']][0]['all'] = $taxonomy_result;
							$results[$object['name']][0]['template'] = $this->get_templates($object['name'], 'taxonomy');
							$results[$object['name']][0]['title'] = $object['label'];
							$results[$object['name']][0]['class_name'] = 'sf_category';
						}
					}
				}elseif($object['type'] == 'role') {
					$users = array();
					if(!$author_searched) {
						$authors = $this->author($sf_value, $object['name']);
						$users = $this->filter_authors_by_role($authors, $object['name']);
						$author_searched = true;
					}else{
						$users = $this->filter_authors_by_role($authors, $object['name']);
					}
					if(sizeof($users) > 0) {
						$results[$object['name']][0]['all'] = $users;
						$results[$object['name']][0]['template'] = $this->get_templates($object['name'], 'author');
						$results[$object['name']][0]['title'] = $object['label'];
						$results[$object['name']][0]['class_name'] = 'sf_category';
					}
				}
			}
			$results = apply_filters('sf_results', $results);
			echo json_encode($results);
		}
		do_action( 'sf_value_results', $sf_value, $results);
		exit;
	}
		

}
add_filter('sf_category_query', 'sf_category_query', 4, 10);
function sf_category_query($query, $search, $excludes, $limit){
	global $wpdb;
	$wpml_lang_code = (defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE: false);
	if(	$wpml_lang_code ) {
		if(sizeof($excludes) > 0){
			$excludes = " AND $wpdb->terms.term_id NOT IN (".implode(",", $excludes).")";
		}
		else{
			$excludes = "";
		}
		$query = "select * from (select distinct($wpdb->terms.name), $wpdb->terms.term_id,  $wpdb->term_taxonomy.taxonomy,  $wpdb->term_taxonomy.term_taxonomy_id from $wpdb->terms, $wpdb->term_taxonomy where name like '%%%s%%' and $wpdb->term_taxonomy.taxonomy<>'link_category' and $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id $excludes limit 0, ".$limit.") as c, ".$wpdb->prefix."icl_translations as i where c.term_taxonomy_id = i.element_id and i.language_code = %s and SUBSTR(i.element_type, 1, 4)='tax_' group by c.term_id";
		$query = $wpdb->prepare($query,  $search, $wpml_lang_code);
		return $query;
	}
	return $query;
}
add_filter('sf_posts_query', 'sf_posts_query', 5, 10);
function sf_posts_query($query, $search, $post_type, $excludes, $search_content, $order_results, $limit){
	global $wpdb;
	$wpml_lang_code = (defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE: false);
	if(	$wpml_lang_code ) {
		if(sizeof($excludes) > 0){
			$excludes = " AND $wpdb->posts.ID NOT IN (".implode(",", $excludes).")";
		}
		else{
			$excludes = "";
		}
		//$order_results = (!empty($order_results) ? " order by ".$order_results : "");
		$query = $wpdb->prepare("select * from (select $wpdb->posts.ID from $wpdb->posts where (post_title like '%%%s%%' ".($search_content == true ? "or post_content like '%%%s%%')":")")." and post_status='publish' and post_type='".$post_type."' $excludes $order_results limit 0,".$limit.") as p, ".$wpdb->prefix."icl_translations as i where p.ID = i.element_id and i.language_code = %s group by p.ID",  ($search_content == true ? array($search, $search, $wpml_lang_code): array($search, $wpml_lang_code)));
		return $query;
	}
	return $query;
}
global $AjaxyLiveSearch;
$AjaxyLiveSearch = new AjaxyLiveSearch();


?>