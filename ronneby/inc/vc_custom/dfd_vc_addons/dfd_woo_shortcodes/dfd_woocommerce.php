<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists("Dfd_WooShortcodes")){
	class Dfd_WooShortcodes{
		var $module_dir;
		function __construct() {
			$this->module_dir = get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/modules/';
			add_action('admin_enqueue_scripts',array($this,'admin_scripts'));
			add_action('wp_enqueue_scripts',array($this,'front_scripts'));
			add_action('admin_init',array($this,'generate_shortcode_params'));
		} /* end constructor */
		function generate_shortcode_params(){
			/* Generate param type "woocomposer" */
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('woocomposer', array($this,'woo_query_builder'), get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/admin/js/mapping.js');
			}
			
			/* Generate param type "product_search" */
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('product_search', array($this,'woo_product_search'));
			}
			/* Generate param type "product_categories" */
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('product_categories', array($this,'woo_product_categories'));
			}
			
			/* Generate param type "number" */
			if ( function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('number' , array(&$this, 'number_settings_field' ) );
			}
		}
		/* Function generate param type "number" */
		function number_settings_field($settings, $value) {
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$step = isset($settings['step']) ? $settings['step'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<input type="number" min="'.esc_attr($min).'" max="'.esc_attr($max).'" step="'.esc_attr($step).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" value="'.esc_attr($value).'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
			return $output;
		}
		/* Function generate param type "number" */
		function woo_query_builder($settings, $value) {
			$output = $asc = $desc = $post_count = $shortcode_str = $cat_id = '';
			$labels = isset($settings['labels']) ? $settings['labels'] : ''; 
			$pattern = get_shortcode_regex();
			if($value !== ""){
				$shortcode = rawurldecode( base64_decode( strip_tags( $value ) ) );
				preg_match_all("/".$pattern."/",$shortcode,$matches);
				$shortcode_str = str_replace('"','',str_replace(" ","&",trim($matches[3][0])));
			}
			$short_atts = parse_str($shortcode_str);//explode("&",$shortcode_str);
			if(isset($matches[2][0])): $display_type = $matches[2][0]; else: $display_type = ''; endif;
			if(!isset($columns)): $columns = '4'; endif;
			if(!isset($per_page)): $post_count = '12'; else: $post_count = $per_page; endif;
			if(!isset($number)): $per_page = '12'; else: $post_count = $number; endif;
			if(!isset($order)): $order = 'asc'; endif;
			if(!isset($orderby)): $orderby = 'date'; endif;
			if(!isset($category)): $category = ''; endif;
			$catObj = get_term_by('name',$category,'product_cat');
			if(is_object($catObj)){ 
  				$cat_id = $catObj->term_id;
			}
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$module = isset($settings['module']) ? $settings['module'] : ''; 
			$displays = array(
				"Recent products" => "recent_products",
				"Featured Products" => "featured_products",
				"Top Rated Products" => "top_rated_products",
				"Product Category" => "product_category",
				"Product Categories" => "product_categories",
				"Products on Sale" => "sale_products",
				"Best Selling Products" => "best_selling_products",
			);
			$orderby_arr = array(
				"Date" => "date",
				"Title" => "title",
				"Product ID" => "ID",
				"Name" => "name",
				"Price" => "price",
				"Sales" => "sales",
				"Random" => "rand",
			);
			$output .= '<div class="display_type"><label for="display_type"><strong>'.$labels['products_from'].'</strong></label>';
			$output .='<select id="display_type">';
			foreach($displays as $title => $display){
				if($display == $display_type)
					$output .= '<option value="'.esc_attr($display).'" selected="selected">'.$title.'</option>';
				else
					$output .= '<option value="'.esc_attr($display).'">'.$title.'</option>';
			}
			$output .= '</select></div>';
			$output .= '<div class="per_page"><label for="per_page"><strong>'.$labels['per_page'].'</strong></label>';
			$output .= '<input type="number" min="2" max="1000" id="per_page" value="'.esc_attr($post_count).'"></div>';
			if($module == "grid"){
				$output .= '<div class="columns"><label for="columns"><strong>'.$labels['columns'].'</strong></label>';
				$output .= '<input type="number" min="2" max="4" id="columns" value="'.esc_attr($columns).'"></div>';
			}
			$output .= '<div class="orderby"><label for="orderby"><strong>'.$labels['order_by'].'</strong></label>';
			$output .= '<select id="orderby">';
				foreach($orderby_arr as $key => $val){
					if($orderby == $val)
						$output .= '<option value="'.$val.'" selected="selected">'.$key.'</option>';
					else
						$output .= '<option value="'.$val.'">'.$key.'</option>';
				}
			$output .= '</select></div>';
			$output .= '<div class="order"><label for="order"><strong>'.$labels['order'].'</strong></label>';
			$output .= '<select id="order">';
				if($order == "asc")
					$asc = 'selected="selected"';
				else
					$desc = 'selected="selected"';
				$output .= '<option value="asc" '.$asc.'>Ascending</option>';
				$output .= '<option value="desc" '.$desc.'>Descending</option>';
			$output .= '</select></div>';
			$output .= '<div class="cat"><label for="cat"><strong>'.$labels['category'].'</strong></label>';
			$output .= wp_dropdown_categories( array('taxonomy'=>'product_cat','selected'=>$cat_id,'echo' => false,)).'</div>';
			$output .= '<!-- '.$value.' -->';
			$output .= "<input type='hidden' name='".esc_attr($param_name)."' value='".esc_attr($value)."' class='wpb_vc_param_value ".esc_attr($param_name)." ".esc_attr($type)." ".esc_attr($class)."' id='shortcode'>";
			return $output;
		} /* end woo_query_builder */
		function woo_product_search($settings, $value){
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			
			$products_array = new WP_Query(array(
								'post_type' => 'product',
								'posts_per_page' => -1,
								'post_status' => 'publish'
							));
			$output = '';
			$output .= '<select id="products" name="'.esc_attr($param_name).'" class="wpb_vc_param_value '.esc_attr($param_name).' '.esc_attr($type).' '.esc_attr($class).'">';
					while ($products_array->have_posts()) : $products_array->the_post();
						if($value == get_the_ID()){
							$selected = "selected='selected'";
						} else {
							$selected = '';
						}
						$output .= '<option '.$selected.' value="'.esc_attr(get_the_ID()).'">'.get_the_title().'</option>';
					endwhile;
			$output .= '</select>';
			$output .= '<script type="text/javascript">
							jQuery("#products").select2({
								placeholder: "Select a Product",
								allowClear: true
							});
						</script>';
			return $output;
		} /* end woo_product_search */
		function woo_product_categories($settings, $value){
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$product_categories = get_terms( 'product_cat', '' );
			$output = $selected = $ids = '';
			if ( $value !== '' ) {
				$ids = explode( ',', $value );
				$ids = array_map( 'trim', $ids );
			} else {
				$ids = array();
			}
			$output .= '<select id="sel2_cat" multiple="multiple" style="min-width:200px;">';
			foreach($product_categories as $cat){
				if(in_array($cat->term_id, $ids)){
					$selected = 'selected="selected"';
				} else {
					$selected = '';
				}
				$output .= '<option '.$selected.' value="'.$cat->term_id.'">'. $cat->name .'</option>';
			}
			$output .= '</select>';
			
			$output .= "<input type='hidden' name='".esc_attr($param_name)."' value='".esc_attr($value)."' class='wpb_vc_param_value ".esc_attr($param_name)." ".esc_attr($type)." ".esc_attr($class)."' id='sel_cat'>";
			$output .= '<script type="text/javascript">
							jQuery("#sel2_cat").select2({
								placeholder: "Select Categories",
								allowClear: true
							});
							jQuery("#sel2_cat").on("change",function(){
								jQuery("#sel_cat").val(jQuery(this).val());
							});
						</script>';
			return $output;
			
		} /* end woo_product_categories*/
		function admin_scripts($hook)
		{
			if($hook == "post.php" || $hook == "post-new.php"){
				if(defined('WOOCOMMERCE_VERSION') && version_compare( '2.1.0', WOOCOMMERCE_VERSION, '<' )) {
					wp_enqueue_style("woocomposer-admin",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/admin/css/admin.css');
					wp_enqueue_style("woocomposer-select2-bootstrap",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/admin/css/select2-bootstrap.css');
					wp_enqueue_style("woocomposer-select2",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/admin/css/select2.css');
					wp_enqueue_script("woocomposer-select2-js",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/admin/js/select2.js',false,'',true);
					
					wp_enqueue_script("woocomposer-unveil",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/assets/js/unveil.js','jQuery','',true);
					wp_enqueue_script("woocomposer-js",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/assets/js/custom.js','jQuery','',true);
					wp_enqueue_script("woocomposer-slick",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/assets/js/slick.js','jQuery','',true);
				}
			}
		} /* end admin scripts */
		function front_scripts($post) {
			global $post;
			$count = 0;
			if(!empty($post) && is_object($post)) {
				$content = $post->post_content;
				$shortcodes = array('woocomposer_product','woocomposer_list','woocomposer_grid');
				foreach($shortcodes as $shortcode){
					if(has_shortcode($content, $shortcode)) {
						$count++;	
					}
				}
				if(defined('WOOCOMMERCE_VERSION') && version_compare( '2.1.0', WOOCOMMERCE_VERSION, '<' ) && $count !== 0) {
					wp_enqueue_style("woocomposer-front",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/assets/css/style.css', false, null);
					wp_enqueue_style("woocomposer-front-wooicon",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/assets/css/wooicon.css', false, null);
					wp_enqueue_style("woocomposer-front-slick",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/assets/css/slick.css', false, null);
					wp_enqueue_style("woocomposer-animate",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/assets/css/animate.min.css', false, null);

					wp_enqueue_script("woocomposer-unveil",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/assets/js/unveil.js','1.0','jQuery',true);
					wp_enqueue_script("woocomposer-js",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/assets/js/custom.js','1.0','jQuery',true);
					wp_enqueue_script("woocomposer-slick",get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/dfd_woo_shortcodes/assets/js/slick.js','1.0','jQuery',true);
				}
			}
		}/* end front_scripts */
	}
	new Dfd_WooShortcodes;
}

// check the current post for the existence of a short code
if(!function_exists("has_shortcode")){
	function has_shortcode($shortcode = '') {
		 
		$post_to_check = get_post(get_the_ID());
		 
		// false because we have to search through the post content first
		$found = false;
		 
		// if no short code was provided, return false
		if (!$shortcode) {
			return $found;
		}
		// check the post content for the short code
		if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
			// we have found the short code
			$found = true;
		}
		 
		// return our final results
		return $found;
	}
}