<?php
/*
	Based on Plugin : Ajaxy Live Search | http://ajaxy.org
*/

define('TIE_SEARCH_NO_IMAGE', get_stylesheet_directory_uri().'/images/no-image.png');
	
class TieLiveSearch {

	public static $woocommerce_taxonomies = array('product_cat', 'product_tag', 'product_shipping_class');
	public static $woocommerce_post_types = array('product', 'shop_order', 'shop_coupon');
	
	function __construct(){
		add_action( 'wp_head', array(&$this, 'head'));		
		add_action( 'wp_ajax_ajaxy_sf', array(&$this, 'get_search_results'));
		add_action( 'wp_ajax_nopriv_ajaxy_sf', array(&$this, 'get_search_results'));
	}

// GET POST Types
	function get_post_types(){
		//$post_types = get_post_types(array('_builtin' => false),'objects');
		$post_types['post'] = get_post_type_object('post');
		//$post_types['page'] = get_post_type_object('page');
		unset($post_types['wpsc-product-file']);
		unset($post_types['tie_slider']);
		unset($post_types['shop_order']);
		unset($post_types['shop_coupon']);
		return $post_types;
	}

// GET TAXONOMIES
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
	
// SEARCH OBJECTS
	function get_search_objects($all = false, $objects = false, $specific_post_types = array(), $specific_taxonomies = array(), $specific_roles = array()){
		$search = array();
		
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
		return $search;
	}
	
// GET SETTINGS
	function get_setting($name, $public = true){
		$defaults = array(
						'title' => '', 
						'show' => 1,
						'ushow' => 0,
						'search_content' => 0,
						'limit' => 3,
						'order' => 0,
						'order_results' => false
						);
		if(!$public) {
			$defaults['show'] = 0;
		}
		return (object)$defaults;
	}
	
// TEMPLATES
	function get_templates($template, $type='')
	{
		$template_post = "";
		switch($type) {
			case 'more':
					$template_post = '<a href="{search_url_escaped}">'.__ti( 'View All Results', 'tie' ).'</a>';
				break;
			case 'taxonomy':
					$template_post = '<a href="{category_link}">{name}</a>';
				break;
			case 'author':
			case 'role':
					$template_post = '<a href="{author_link}">{user_nicename}</a>';
				break;
			case 'post_type':
				if(in_array($template, self::$woocommerce_post_types)) {
					$template_post = '<a href="{post_link}">{post_image_html}<span class="live-search_text">{post_title} - {price}</span><span class="live-search_small">Posted by {post_author} on {post_date_formatted}</span></a>';
				}else{
					$template_post = '<a href="{post_link}">{post_image_html}<span class="live-search_text">{post_title} </span><p class="post-meta"><span class="post-meta-author"><i class="fa fa-user"></i> {post_author}</span><span class="tie-date"><i class="fa fa-clock-o"></i> {post_date_formatted}</span></p></a>';
				}
				break;
			default:
					$template_post = '<a href="{post_link}">{post_image_html}<span class="live-search_text">{post_title} </span><p class="post-meta"><span class="post-meta-author"><i class="fa fa-user"></i> {post_author}</span><span class="tie-date"><i class="fa fa-clock-o"></i> {post_date_formatted}</span></p></a>';
				break;
		}
		return $template_post;
	}
	
// POSTS
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
	
// POST OBJECTS
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
		$size = array( 'height' => 150 , 'width' => 150 );
		if($post != null)
		{
			$post_object = new stdclass();
			$post_link = get_permalink($post->ID);

			if(in_array('{post_image}', $matches) || in_array('{post_image_html}', $matches)) {
				$post_thumbnail_id = get_post_thumbnail_id( $post->ID);
				if( $post_thumbnail_id > 0)
				{
					$thumb = wp_get_attachment_image_src( $post_thumbnail_id, 'tie-small' );
					$post_object->post_image =  (trim($thumb[0]) == "" ? TIE_SEARCH_NO_IMAGE : $thumb[0]);
					if(in_array('{post_image_html}', $matches)) {
						$post_object->post_image_html = '<div class="post-thumbnail"><img src="'.$post_object->post_image.'" width="'.$size['width'].'" height="'.$size['height'].'" alt="" /></div>';
					}
				}
				else{
					$post_object->post_image_html = '<div class="post-thumbnail"><img src="'.TIE_SEARCH_NO_IMAGE.'" width="'.$size['width'].'" height="'.$size['height'].'" alt="" /></div>';
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
									$post_object->{$match} = '<span class="live-search_list live-search_'.$match.'">'.$term_list.'</span>';
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
				$post_object->post_content = $this->get_text_words(apply_filters('the_content', $post->post_content) , 10 );
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
	
// REMOVE HTML AND SHORTCODES FROM TEXT
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
	
// HEAD
	function head()	{
		
		wp_register_script( 'tie-search', get_template_directory_uri() . '/js/search.js', array( 'jquery' ), false, true );  
		wp_enqueue_script( 'tie-search' );
	
		$settings = array(
			'label' => 'Search' ,
			'expand' => false
		);
		
		$live_search_settings = json_encode(
			array(
				'expand' => $settings['expand']
				,'searchUrl' =>  home_url().'/?s=%s'
				,'text' => $settings['label']
				,'delay' =>  500
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
				var sf_input = '.search-live';
				jQuery(document).ready(function(){
					jQuery(sf_input).ajaxyLiveSearch(<?php echo $live_search_settings; ?>);
					jQuery(".live-search_ajaxy-selective-input").keyup(function() {
						var width = jQuery(this).val().length * 8;
						if(width < 50) {
							width = 50;
						}
						jQuery(this).width(width);
					});
					jQuery(".live-search_ajaxy-selective-search").click(function() {
						jQuery(this).find(".live-search_ajaxy-selective-input").focus();
					});
					jQuery(".live-search_ajaxy-selective-close").click(function() {
						jQuery(this).parent().remove();
					});
				});
			/* ]]> */
		</script>
		<?php
	}
	
// GET AJAX URL
	function get_ajax_url(){
		if(defined('ICL_LANGUAGE_CODE')){
			return admin_url('admin-ajax.php').'?lang='.ICL_LANGUAGE_CODE;
		}
		if(function_exists('qtrans_getLanguage')){

			return admin_url('admin-ajax.php').'?lang='.qtrans_getLanguage();
		}
		return admin_url('admin-ajax.php');
	}
	
// GET SEARCH RESULTS
	function get_search_results(){
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
						$results[$object['name']][0]['class_name'] = 'live-search_item'.(in_array($object['name'], self::$woocommerce_post_types) ? ' woocommerce': '');
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
									$results[$object['name']][$cnt]['class_name'] = 'live-search_category';
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
							$results[$object['name']][0]['class_name'] = 'live-search_category';
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
						$results[$object['name']][0]['class_name'] = 'live-search_category';
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

add_filter('sf_posts_query', 'TieLiveSearch_posts_query', 5, 10);
function TieLiveSearch_posts_query($query, $search, $post_type, $excludes, $search_content, $order_results, $limit){
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
$TieLiveSearch = new TieLiveSearch();


?>