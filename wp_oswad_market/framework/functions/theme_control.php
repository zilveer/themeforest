<?php
/**************************important hook**************************/
function custom_list_grid_disc() {
	global $smof_data;
	$custom_css = "";
	$custom_css = "ul.list .short-description.list{display: block !important;}";
	$custom_css .= "ul.grid .short-description.grid{display: block !important;}";
    wp_add_inline_style( 'base', $custom_css );
}



//add_filter( 'option_posts_per_page' , 'wd_change_posts_per_page'); //filter and change posts_per_page
add_action ('pre_get_posts','prepare_post_query',9); //hook into pre_get_posts to reset some querys

/*merge query post type function*/

function merge_post_type($query,$new_type = array()){
	$defaut_post_type = ( post_type_exists( 'portfolio' ) ? array('portfolio','post') : array('post') );
	$new_type = (is_array($new_type) && count($new_type) > 0) ? $new_type : $defaut_post_type;
	$default_post_type = $query->get('post_type');
	if(is_array($default_post_type)){
		$new_type = array_merge($default_post_type, $new_type);
	}else{
		$new_type = array_merge(array($default_post_type), $new_type);
	}
	return ( $new_type = array_unique($new_type) );
}
/*end merge query post type function*/

function remove_page_from_search_query($where_query){
	global $wpdb;
	$where_query .= " AND ".$wpdb->base_prefix."posts.post_type NOT IN ('page') ";
	return $where_query;
}

function add_a2z_query($where_query){
	global $wpdb;
	$_start_char = get_query_var('start_char');
	$_up_char = strtoupper($_start_char);
	$_down_char = strtolower($_start_char);
	$where_query .= " AND left(". $wpdb->base_prefix ."posts.post_title,1) IN ('{$_up_char}','{$_down_char}') ";
	return $where_query;
}


function prepare_post_query($query){
	
	global $page_datas,$post;
	$paged = (int)get_query_var('paged');
		
	
	if($paged>0){
		set_query_var('page',$paged);
	}
	if($query->is_tag()){
		$query->set('post_type',merge_post_type($query) );
	}
	if($query->is_search()){
		if( !is_admin() ){
			add_action( "posts_where", "remove_page_from_search_query", 10 );
		}
	}	
	if($query->is_date()){
		$query->set('post_type',merge_post_type($query) );
	}

	if($query->is_author()){
		$query->set('post_type',merge_post_type($query) );
	}
	return $query;
	
}

add_action( 'template_redirect', 'my_page_template_redirect' );

function my_page_template_redirect(){
	global $wp_query,$post,$page_datas,$smof_data,$wd_custom_style_config;
	if($wp_query->is_page()){
		$page_datas = unserialize(get_post_meta($post->ID,THEME_SLUG.'page_configuration',true));
		$page_datas = wd_array_atts(array(	
											"page_layout" 				=> '0'
											,"page_column" 				=> '0-1-0'
											,"left_sidebar" 			=> 'primary-widget-area-left'
											,"right_sidebar" 			=> 'primary-widget-area-right'
											,"page_slider" 				=> 'none'
											,"page_revolution" 			=> ''
											,"page_layerslider" 		=> ''
											,"product_cat"				=> ''
											,"portfolio_columns" 		=> 1
											,"portfolio_filter"			=> 1
											,"hide_new_product" 		=> 1
											,"hide_breadcrumb" 			=> 0	
											,"hide_top_content" 		=> 1	
											,"hide_banner_top_content" 	=> 1	
											,"hide_title" 				=> 0
											,"hide_header" 				=> 0
											,"hide_footer" 				=> 0
											,"product_slider_columns"	=> 4	
											,"product_slider_title"		=> ''
										),$page_datas);		
		$smof_data['wd_layout_styles'] = strcmp($page_datas['page_layout'],'0') == 0 ? $smof_data['wd_layout_styles'] : $page_datas['page_layout'] ;
		
	
	}
	
	if( is_single() ){
		$post_options = unserialize(get_post_meta($post->ID,THEME_SLUG.'post_options',true));
		$post_options = wd_array_atts(array(	
									"post_column" 				=> '0-1-1'
									,"left_sidebar" 			=> 'blog-widget-area-left'
									,"right_sidebar" 			=> 'blog-widget-area-right'
									), $post_options);
							
		if( isset($post_options['post_column']) && $post_options['post_column'] != '0' ){
			$smof_data['wd_blog_details_layout'] =  $post_options['post_column'];
		}
		if( isset($post_options['left_sidebar']) && $post_options['left_sidebar'] != '0' ){
			$smof_data['wd_blog_details_left_sidebar'] =  $post_options['left_sidebar'];
		}
		if( isset($post_options['right_sidebar']) && $post_options['right_sidebar'] != '0' ){
			$smof_data['wd_blog_details_right_sidebar'] =  $post_options['right_sidebar'];
		}
											
	}
	
	if( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_post_type_archive( "product" ) ){
		global $wp_query,$category_prod_datas;
		if( isset($wp_query) && isset($wp_query->queried_object) ){
			$term = $wp_query->queried_object;
			if( isset($term->term_id) && (int)$term->term_id > 0 ){
				if( is_tax( 'product_cat' ) ){
					$_term_config = get_metadata( 'woocommerce_term', $term->term_id, "cat_config", true );
				}
				else{
					$_term_config = get_metadata( 'woocommerce_term', $term->term_id, "tag_config", true );
				}
			}
			else{
				$_term_config = "";
			}
		}
		else{
			$_term_config = "";
		}
		
		if( strlen($_term_config) > 0 ){
			$_term_config = unserialize($_term_config);	
			
			if( is_array($_term_config) && count($_term_config) > 0 ){
				if( is_tax( 'product_cat' ) ){
					$smof_data['wd_prod_cat_column'] = ( isset($_term_config['cat_columns']) && strlen($_term_config['cat_columns']) > 0 && (int)$_term_config['cat_columns'] != 0 ) ? $_term_config['cat_columns'] : $smof_data['wd_prod_cat_column'];
					$smof_data['wd_prod_cat_layout'] = ( isset($_term_config['cat_layout']) && strlen($_term_config['cat_layout']) > 0 && strcmp($_term_config["cat_layout"],'0') != 0 ) ? $_term_config['cat_layout'] : $smof_data['wd_prod_cat_layout'];
					$smof_data['wd_prod_cat_left_sidebar'] = ( isset($_term_config['cat_left_sidebar']) && strlen($_term_config['cat_left_sidebar']) > 0 && strcmp($_term_config["cat_left_sidebar"],'0') != 0 ) ? $_term_config['cat_left_sidebar'] : $smof_data['wd_prod_cat_left_sidebar'];
					$smof_data['wd_prod_cat_right_sidebar'] = ( isset($_term_config['cat_right_sidebar']) && strlen($_term_config['cat_right_sidebar']) > 0 && strcmp($_term_config["cat_right_sidebar"],'0') != 0 ) ? $_term_config['cat_right_sidebar'] : $smof_data['wd_prod_cat_right_sidebar'];
					$smof_data['wd_prod_cat_custom_content'] = ( isset($_term_config['cat_custom_content']) && strlen($_term_config['cat_custom_content']) > 0 ) ? $_term_config['cat_custom_content'] : "";
				}
				else{
					$smof_data['wd_prod_cat_column'] = ( isset($_term_config['tag_columns']) && strlen($_term_config['tag_columns']) > 0 && (int)$_term_config['tag_columns'] != 0 ) ? $_term_config['tag_columns'] : $smof_data['wd_prod_cat_column'];
					$smof_data['wd_prod_cat_layout'] = ( isset($_term_config['tag_layout']) && strlen($_term_config['tag_layout']) > 0 && strcmp($_term_config["tag_layout"],'0') != 0 ) ? $_term_config['tag_layout'] : $smof_data['wd_prod_cat_layout'];
					$smof_data['wd_prod_cat_left_sidebar'] = ( isset($_term_config['tag_left_sidebar']) && strlen($_term_config['tag_left_sidebar']) > 0 && strcmp($_term_config["tag_left_sidebar"],'0') != 0 ) ? $_term_config['tag_left_sidebar'] : $smof_data['wd_prod_cat_left_sidebar'];
					$smof_data['wd_prod_cat_right_sidebar'] = ( isset($_term_config['tag_right_sidebar']) && strlen($_term_config['tag_right_sidebar']) > 0 && strcmp($_term_config["tag_right_sidebar"],'0') != 0 ) ? $_term_config['tag_right_sidebar'] : $smof_data['wd_prod_cat_right_sidebar'];
					$smof_data['wd_prod_cat_custom_content'] = ( isset($_term_config['tag_custom_content']) && strlen($_term_config['tag_custom_content']) > 0 ) ? $_term_config['tag_custom_content'] : "";
				}
			}
			
		}
		
		add_action('woocommerce_before_shop_loop','wd_remove_shop_archive_control',1);
		add_action('woocommerce_after_shop_loop','wd_add_shop_archive_control',1);		
		
		if( isset($smof_data) && isset($smof_data['wd_prod_cat_disc_grid']) && isset($smof_data['wd_prod_cat_disc_list']) ){
			add_action( 'wp_enqueue_scripts', 'custom_list_grid_disc' );
		}
			
	}
	if ( is_singular('product') ) {
		global $smof_data,$post;
		/******************* Start Load Config On Single Post ******************/
		$_prod_config = get_post_meta($post->ID,THEME_SLUG.'custom_product_config',true);
		
		if( strlen($_prod_config) > 0 ){
			$_prod_config = unserialize($_prod_config);
			
			if( is_array($_prod_config) && count($_prod_config) > 0 ){
				
				$smof_data['wd_prod_layout'] = ( isset($_prod_config['layout']) && strlen($_prod_config['layout']) > 0 && strcmp($_prod_config["layout"],'0') != 0 ) ? $_prod_config['layout'] : $smof_data['wd_prod_layout'];
				$smof_data['wd_prod_left_sidebar'] = ( isset($_prod_config['left_sidebar']) && strlen($_prod_config['left_sidebar']) > 0 && strcmp($_prod_config["left_sidebar"],'0') != 0 ) ? $_prod_config['left_sidebar'] : $smof_data['wd_prod_left_sidebar'];
				$smof_data['wd_prod_right_sidebar'] = ( isset($_prod_config['right_sidebar']) && strlen($_prod_config['right_sidebar']) > 0 && strcmp($_prod_config["right_sidebar"],'0') != 0 ) ? $_prod_config['right_sidebar'] : $smof_data['wd_prod_right_sidebar'];
				if( ( strcmp( trim($_prod_config['left_sidebar']),"0" ) != 0 || strcmp( trim($_prod_config['right_sidebar']),"0" ) != 0 ) && strcmp($smof_data['wd_prod_layout'],'0-1-0') != 0 ){
					//we should replace the sidebar on product page if product have at least 1 sidebar
//					add_action( 'get_header',  'wd_init_sidebar_replacement' );
				}
				
			}
		}			
		
		/******************* End Config On Single Post ******************/
		global $wp_filter;

		if( !$smof_data['wd_prod_image']  )
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );	

		if( !$smof_data['wd_prod_label'] )
			remove_action( 'wd_before_product_image', 'woocommerce_show_product_sale_flash', 10 );

		if( !$smof_data['wd_prod_title'] )
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			
		if( !$smof_data['wd_prod_sku'] )
			remove_action( 'woocommerce_single_product_summary', 'wd_template_single_sku', 7 );
		
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		if( !$smof_data['wd_prod_review']  )
			remove_action( 'woocommerce_single_product_summary', 'wd_template_single_review', 8 );

		if( !$smof_data['wd_prod_availability'] )
			remove_action( 'woocommerce_single_product_summary', 'wd_template_single_availability', 6 );

		if( !$smof_data['wd_prod_cart']){
			remove_action( 'wd_single_product_summary_end', 'button_add_to_card', 16);	
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
			remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
			remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
			remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
		}

		if( !$smof_data['wd_prod_price'] ){
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 31 );
			remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
		}
		if( !$smof_data['wd_prod_shortdesc'] )
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 16 );
		if( !$smof_data['wd_prod_meta'] )	{
			remove_action( 'woocommerce_single_product_summary', 'wd_get_product_tags_categories', 40);
		}
		if( !$smof_data['wd_prod_related']){
			//remove_action( 'woocommerce_after_single_product_summary', 'wd_output_related_products', 9 );
			remove_action( 'wd_after_single_product_summary', 'wd_output_related_products', 9 );
			add_filter( "single_product_wrapper_class", "update_single_product_wrapper_class", 10);
		}else{
			global $post;
			$_product = wc_get_product($post);
			if ( sizeof( $_product->get_related() ) == 0 )
				add_filter( "single_product_wrapper_class", "update_single_product_wrapper_class", 10);
		}

		if( !$smof_data['wd_prod_share'] )
			remove_action( 'woocommerce_single_product_summary', 'wd_template_single_social_sharing', 35 );
			
		if( !$smof_data['wd_prod_ship_return'] )
			remove_action( 'woocommerce_after_single_product_summary', 'wd_template_shipping_return', 9 );

		if( !$smof_data['wd_prod_tabs'] )
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			
		if( !$smof_data['wd_prod_customtab'] ){
			remove_filter( 'woocommerce_product_tabs', 'wd_addon_custom_tabs',100 );
		}		
		if(isset($smof_data['wd_prod_related'], $smof_data['wd_prod_upsell'])){
			if(!$smof_data['wd_prod_related'] && !$smof_data['wd_prod_upsell'])
				remove_action( 'woocommerce_after_single_product_summary', 'wd_upsell_related_display', 15 );
		}
		
	}

	if( isset($smof_data['wd_enable_catalog_mod']) && $smof_data['wd_enable_catalog_mod'] ){
		remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
		remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
		/*remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
		remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
		remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
		remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );*/
	}
	
}

function wd_remove_shop_archive_control(){

		global $smof_data;
		
		$show_label = (int) $smof_data['wd_prod_cat_label'];
		if( $show_label == 0 )
			remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );
		
		$show_rating = (int) $smof_data['wd_prod_cat_rating'];
		if( $show_rating == 0 )
			remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_rating',10002);
			
		$show_categories = (int) $smof_data['wd_prod_cat_categories'];
		if( $show_categories == 0 )
			remove_action('woocommerce_after_shop_loop_item','get_product_categories',2);
		
		$show_title = (int) $smof_data['wd_prod_cat_title'];
		if( $show_title == 0 )
			remove_action('woocommerce_after_shop_loop_item','add_product_title',3);
			
		$show_price = (int) $smof_data['wd_prod_cat_price'];
		if( $show_price == 0 )
			remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_price',4);
		
		$show_sku = (int) $smof_data['wd_prod_cat_sku'];
		if( $show_sku == 0 )
			remove_action('woocommerce_after_shop_loop_item','add_sku_to_product_list',5);
		
		$show_add_to_cart = (int) $smof_data['wd_prod_cat_add_to_cart'];
		if( $show_add_to_cart == 0)
			remove_action('woocommerce_after_shop_loop_item','wd_list_template_loop_add_to_cart',9999);
			
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5); /* Grid list toogle plugin */
		
}

function wd_add_shop_archive_control(){
	add_action('woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );
	add_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_rating',10002);
	add_action('woocommerce_after_shop_loop_item','get_product_categories',2);
	add_action('woocommerce_after_shop_loop_item','add_product_title',3);
	add_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_price',4);
	add_action('woocommerce_after_shop_loop_item','add_sku_to_product_list',5);
	add_action('woocommerce_after_shop_loop_item','woocommerce_template_single_excerpt',5); /* Grid list toogle plugin */
	add_action('woocommerce_after_shop_loop_item','wd_list_template_loop_add_to_cart',9999);
}

function wd_change_posts_per_page($option_posts_per_page){
	global $wp_query;
	if($wp_query->is_search()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_search') > 0 ? (int)get_option(THEME_SLUG.'num_post_search') : $option_posts_per_page );
        return $posts_per_page;
	}
	//if($wp_query->is_front_page() || $wp_query->is_home()){
	if( $wp_query->is_home() ){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_home') > 0 ? (int)get_option(THEME_SLUG.'num_post_home') : $option_posts_per_page );
        return $posts_per_page;
	}
	//if( is_page_template('page-templates/blog-template.php') ){
	if( $wp_query->is_page() ){
		$blog_template_array = array('blog-template.php','blogtemplate.php','portfolio.php');
		//$template_name = get_post_meta( $wp_query->queried_object_id, '_wp_page_template', true );
		$template_name = get_post_meta( $wp_query->query_vars['page_id'], '_wp_page_template', true );
		if(in_array($template_name,$blog_template_array)){
			$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_blog_page') > 0 ? (int)get_option(THEME_SLUG.'num_post_blog_page') : $option_posts_per_page );
			return $posts_per_page;
		}
	}

	if($wp_query->is_single()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_related') > 0 ? (int)get_option(THEME_SLUG.'num_post_related') : $option_posts_per_page );
        return $posts_per_page;
	}
	if($wp_query->is_category()){
		
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_cat') > 0 ? (int)get_option(THEME_SLUG.'num_post_cat') : $option_posts_per_page );
        return $posts_per_page;
	}
	if($wp_query->is_tag()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_tag') > 0 ? (int)get_option(THEME_SLUG.'num_post_tag') : $option_posts_per_page );
        return $posts_per_page;
	}
    if ($wp_query->is_category() ) {
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_cat') > 0 ? (int)get_option(THEME_SLUG.'num_post_cat') : $option_posts_per_page );
        return $posts_per_page;
    }
	if($wp_query->is_archive()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_archive') > 0 ? (int)get_option(THEME_SLUG.'num_post_archive') : $option_posts_per_page );
        return $posts_per_page;
	}
    return $option_posts_per_page;
}
if( !function_exists('wd_is_woocommerce') ){
	function wd_is_woocommerce(){
		if( in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' )  ) ) ){
			return true;
		}
		return false;
	}
}

/**************************end the hook**************************/

?>