<?php
/**
 * @package WordPress
 * @subpackage Oswad Market
 * @since WD_Responsive
 */

/*=====================================================================================*/
/***** start archive product hook *****/

	// woocommerce_before_main_content hook
	

/***** end archive product hook *****/
/*=====================================================================================*/



/*=====================================================================================*/
/***** start single archive product hook *****/
	remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
	add_action( 'woocommerce_archive_description', 'wc_print_notices', 10 );
	
	add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 1 );
	//woocommerce_before_shop_loop_item_title hook
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	
	
	//woocommerce_after_shop_loop_item_title hook

	
	
	//woocommerce_after_shop_loop_item hook

	
	//default hook
	//add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	

/***** end single archive product hook *****/
/*=====================================================================================*/




/*=====================================================================================*/
/***** start single product hook *****/

	// woocommerce_before_single_product_summary hook
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	
	// woocommerce_single_product_summary hook
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

	
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 15 );
	
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 16 );
	
	
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	add_action( 'woocommerce_single_product_summary', 'wd_template_single_social_sharing', 35 );
	
	add_action( 'woocommerce_single_product_summary', 'wd_template_single_availability', 6 );
	add_action( 'woocommerce_single_product_summary', 'wd_template_single_review', 8 );
	
	function wd_template_single_social_sharing(){
	?>
		<div class="wd-social-share">
			<span><?php _e('Share ','wpdance'); ?></span>
			<div class="addthis_sharing_toolbox"></div>
		</div>
	<?php
	}
	
	add_action('wp_head', 'wd_addthis_script', 999);
	function wd_addthis_script(){
		if( is_single() || is_page_template('page-templates/blog-template.php') || is_category() || is_tag() ){
			?>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-547e8f2f2a326738" async="async"></script>
			<?php
		}
	}
	
	function wd_template_social_sharing(){
		global $post,$smof_data;
		?>
		<div class="wd-social-share">
			<span><?php _e('Share ','wpdance'); ?></span>
			<ul class="social-share">
				<?php if((int)$smof_data['wd_enable_facebook'] == 1): ?>
					<li class="icon-facebook"><a href="http://www.facebook.com/<?php echo trim($smof_data['wd_facebook_id']); ?>" target="_blank" title="<?php _e('Become our fan', 'wpdance'); ?>" ><i class="fa fa-facebook"></i></a></li>				
				<?php endif; ?>
				<?php if((int)$smof_data['wd_enable_twitter'] == 1): ?>
					<li class="icon-twitter"><a href="http://twitter.com/<?php echo trim($smof_data['wd_twitter_id']); ?>" target="_blank" title="<?php _e('Follow us', 'wpdance'); ?>" ><i class="fa fa-twitter"></i></a></li>
				<?php endif; ?>
				<?php if((int)$smof_data['wd_enable_flickr'] == 1): ?>
					<li class="icon-flickr"><a href="http://www.flickr.com/photos/<?php echo trim($smof_data['wd_flickr_id']); ?>" target="_blank" title="<?php _e('See Us', 'wpdance'); ?>" ><i class="fa fa-flickr"></i></a></li>
				<?php endif; ?>
				<?php if((int)$smof_data['wd_enable_google'] == 1): ?>
					<li class="icon-google"><a href="https://plus.google.com/<?php echo trim($smof_data['wd_google_id']); ?>" target="_blank" title="<?php _e('Join our circle', 'wpdance'); ?>"  ><i class="fa fa-google-plus"></i></a></li>
				<?php endif; ?>
				<?php if((int)$smof_data['wd_enable_rss'] == 1): ?>
					<li class="icon-rss"><a href="http://feeds.feedburner.com/<?php echo trim($smof_data['wd_rss_id']); ?>" target="_blank" title="<?php _e('Get updates', 'wpdance'); ?>" ><i class="fa fa-rss"></i></a></li>
				<?php endif; ?>
				<?php if((int)$smof_data['wd_enable_vimeo'] == 1): ?>
					<li class="icon-vimeo"><a href="http://vimeo.com/<?php echo trim($smof_data['wd_vimeo_id']); ?>" target="_blank" title="<?php _e('See Us', 'wpdance'); ?>" ><i class="fa fa-vimeo-square"></i></a></li>
				<?php endif; ?>
				<?php if( isset($smof_data['wd_custom_social_icon_class']) && strlen(trim($smof_data['wd_custom_social_icon_class'])) > 0 ): ?>
					<li class="icon-custom"><a href="<?php echo esc_url($smof_data['wd_custom_social_icon_link']); ?>" target="_blank" title="" ><i class="fa <?php echo $smof_data['wd_custom_social_icon_class']; ?>"></i></a></li>
				<?php endif; ?>
				<?php if( isset($smof_data['wd_custom_social_icon_class_2']) && strlen(trim($smof_data['wd_custom_social_icon_class_2'])) > 0 ): ?>
					<li class="icon-custom"><a href="<?php echo esc_url($smof_data['wd_custom_social_icon_link_2']); ?>" target="_blank" title="" ><i class="fa <?php echo $smof_data['wd_custom_social_icon_class_2']; ?>"></i></a></li>
				<?php endif; ?>
			</ul>
		</div>
		<?php
	}
	

add_filter('loop_shop_per_page', 'wd_change_posts_per_page_category' );
function wd_change_posts_per_page_category(){
	global $smof_data;
    if( is_archive() ){
        if( isset($smof_data["wd_prod_cat_per_page"]) && (int)$smof_data["wd_prod_cat_per_page"] > 0){
            return (int)$smof_data["wd_prod_cat_per_page"];
        }
    }
}


	
	
	function wd_template_single_availability(){
		global $product;
		$_product_stock = get_product_availability($product);
	?>	
		<p class="availability stock <?php echo esc_attr($_product_stock['class']);?>"><?php _e('Availability','wpdance');?>: <span><?php echo esc_attr($_product_stock['availability']);?></span></p>	
	<?php		
	}	
	add_action( 'woocommerce_single_product_summary', 'wd_template_single_sku', 7 );
	function wd_template_single_sku(){
		global $product, $post;
		$sku_label = __("Sku:","wpdance");
		echo "<p class='wd_product_sku product_meta'>" . $sku_label . " <span class=\"product_sku sku\">" . esc_attr($product->get_sku()) . "</span></p>";
	}	
	//add_action( 'woocommerce_single_product_summary', 'wd_template_single_rating', 6);

	function wd_template_single_rating(){
		global $product, $post;
		if( function_exists('wd_get_rating_html') ){
			echo wd_get_rating_html();
		}
		else{
			echo $product->get_rating_html();
		}
	}

	//add_action( 'woocommerce_single_product_summary', 'button_add_to_card', 16);
	function wd_get_product_tags_categories(){
		echo '<div class="wd_product_tags_categoried">';
			product_tags_template();
			get_product_categories();
		echo '</div>';
	}
	add_action( 'woocommerce_single_product_summary', 'wd_get_product_tags_categories', 40);
	//add_action( 'woocommerce_single_product_summary', 'get_product_categories', 40);

	//add_action( 'woocommerce_single_product_summary', 'product_tags_template', 40);



	
	function wd_template_single_content() {
		global $product;
		echo '<div class="wd_product_content">';
		echo get_the_content($product->ID);
		echo '</div>';
	}
	
	
	function wd_template_loop_excerpt(){
		global $product, $post, $smof_data;
		$limit_grid = trim($smof_data['wd_prod_cat_word_disc_grid']);
		$limit_list = trim($smof_data['wd_prod_cat_word_disc_list']);
		
		if( $limit_grid != -1 )
			$limit_grid = absint( $limit_grid );
		if( $limit_list != -1 )
			$limit_list = absint( $limit_list );
		
		if( empty( $post->post_excerpt ) )
			return;
			
		$is_grid_list = true;
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if ( !in_array( "woocommerce-grid-list-toggle/grid-list-toggle.php", $_actived ) ) {
			$is_grid_list = false;
		}
	?>	
		<?php if( !(is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_post_type_archive( "product" )) ): ?>
			<div class="loop-short-description">
				<?php echo the_excerpt_max_words($limit_grid,'',false)." ..."; ?>
			</div>
		<?php else: ?>
			<?php if( (int)$smof_data['wd_prod_cat_disc_grid'] != 0 ): ?>
				<div class="loop-short-description short-description grid" <?php echo ($is_grid_list)?'style="display: none"':''; ?>>
					<?php echo the_excerpt_max_words($limit_grid,'',false)." ..."; ?>
				</div>
			<?php endif; ?>
			<?php if( (int)$smof_data['wd_prod_cat_disc_list'] != 0 ): ?>
				<div class="loop-short-description short-description list" style="display: none">
					<?php echo the_excerpt_max_words($limit_list,'',false)." ..."; ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php	
	}
	
	//woocommerce_after_single_product_summary hook
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

	//add_action( 'woocommerce_after_single_product_summary', 'wd_output_related_products', 16 );

		function wd_output_related_products() {
			woocommerce_related_products( array(5), false );
		}
		
	function wd_before_single_product_related(){
		wd_remove_shop_archive_control();
	}
	add_action('wd_before_single_product_related','wd_before_single_product_related',1);
	function wd_after_single_product_related(){
		wd_add_shop_archive_control();
	}
	add_action('wd_after_single_product_related','wd_after_single_product_related',1);
	
	function wd_before_single_product_up_sell(){
		wd_remove_shop_archive_control();
	}
	add_action('wd_before_single_product_up_sell','wd_before_single_product_up_sell',1);
	function wd_after_single_product_up_sell(){
		wd_add_shop_archive_control();
	}
	add_action('wd_after_single_product_up_sell','wd_after_single_product_up_sell',1);

	function wd_before_cross_sell(){
		wd_remove_shop_archive_control();
	}
	add_action('wd_before_cross_sell','wd_before_cross_sell',1);
	function wd_after_cross_sell(){
		wd_add_shop_archive_control();
	}
	add_action('wd_after_cross_sell','wd_after_cross_sell',1);
	
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );	
	//add_action( 'woocommerce_after_single_product_summary', 'wd_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'wd_upsell_related_display', 15 );

	function wd_upsell_display( $posts_per_page = '-1', $columns = 5, $orderby = 'rand' ){
		wc_get_template( 'single-product/up-sells.php', array(
					'posts_per_page'  => 15,
					'orderby'    => 'rand',
					'columns'    => 15
			) );
	}
	
	
/***** end single product hook *****/
/*=====================================================================================*/


/*=====================================================================================*/
/***** start checkout hook *****/


/***** end checkout hook *****/


/***** single product image hook *****/
add_action( 'wd_before_product_image', 'woocommerce_show_product_sale_flash', 10 );
	
/***** widget cart filter *****/


/***** single product tab filter *****/


/***** add to cart text filter *****/
 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
//remove default hook
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );



remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


//todo : custom hook
function wd_list_template_loop_add_to_cart(){
	global $smof_data;
	if( isset($smof_data['wd_enable_catalog_mod']) && $smof_data['wd_enable_catalog_mod'] == 1 ){
		return;
	}
	echo "<div class='list_add_to_cart'>";
	woocommerce_template_loop_add_to_cart();
	echo "</div>";
}

if( !function_exists('wd_show_variation_product_same_price') ){
	function wd_show_variation_product_same_price($value, $object = null, $variation = null){
		if ($value['price_html'] == '') {
			$value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
		}
		return $value;
	}
}
add_filter('woocommerce_available_variation','wd_show_variation_product_same_price',10,3);

//add sale,featured and off save label
add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list',5);

//add sku to list first
add_action ('woocommerce_after_shop_loop_item','open_div_style',1);

add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 4 );
add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',5);
//add price and rating
add_action ('woocommerce_after_shop_loop_item', 'wd_template_loop_excerpt', 8 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 10002 );


add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart', 9999 );

if( class_exists('YITH_WCWL_UI') && class_exists('YITH_WCWL') ){
	function wd_add_wishlist_button_to_product_list(){
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}
	add_action( 'woocommerce_after_shop_loop_item', 'wd_add_wishlist_button_to_product_list', 10000 );
	// Custom position in Product detail page
	$_position = get_option( 'yith_wcwl_button_position' );
	if( $_position == 'add-to-cart' ){
		add_action( 'woocommerce_after_add_to_cart_button' , create_function('','echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );'), 2 );
		add_action( 'woocommerce_after_add_to_cart_button' , 'wd_remove_yith_wishlist_button', 3 );
	}
	
	function wd_remove_yith_wishlist_button(){
		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('body.woocommerce #content div.product .summary .yith-wcwl-add-to-wishlist').eq(1).remove();
			});
		</script>
		<?php
	}
}

if( class_exists('YITH_Woocompare_Frontend') && defined( 'YITH_WOOCOMPARE' ) ){
	global $yith_woocompare;
	$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
	if( $yith_woocompare->is_frontend() || $is_ajax ) {
		if( $is_ajax ){
			$yith_woocompare->obj = new YITH_Woocompare_Frontend();
		}
		if ( get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ){
			remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
			function wd_add_compare_button_to_product_list(){
				if( wp_is_mobile() )
					return;
				global $yith_woocompare;
				echo '<div class="wd_compare_wrapper">';
				$yith_woocompare->obj->add_compare_link();
				echo '</div>';
			}
			add_action( 'woocommerce_after_shop_loop_item', 'wd_add_compare_button_to_product_list', 10001 );
		}
		//Custom position in Product detail page
		if ( get_option('yith_woocompare_compare_button_in_product_page') == 'yes' ){
			remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
			function wd_add_compare_button_to_product_detail(){
				if( wp_is_mobile() )
					return;
				global $yith_woocompare;
				echo '<div class="wd_compare_wrapper">';
				$yith_woocompare->obj->add_compare_link();
				echo '</div>';
			}
			add_action( 'woocommerce_after_add_to_cart_button' , 'wd_add_compare_button_to_product_detail', 3 );
		}
	}
}
function wd_add_style_yith_compare(){
	global $smof_data;

	$css_file = get_template_directory_uri() .'/css/yith_compare.css';
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.$css_file.'" />';
	$js_file =  get_template_directory_uri() .'/js/yith_compare.js';
	echo '<script type="text/javascript" src="'.$js_file.'"></script>';
	
	if( isset($smof_data['wd_enable_right_to_left']) && $smof_data['wd_enable_right_to_left'] == 1 ){
		$css_file_rtl = get_template_directory_uri() .'/css/wd-rtl.css';
		echo '<link rel="stylesheet" type="text/css" media="all" href="'.$css_file_rtl.'" />';
	}
	
	wd_add_dynamic_css_header(true);
	
	wd_load_google_font_yith_compare("Advent+Pro");
	global $smof_data;
	$body_font = esc_attr( str_replace( " ", "+", $smof_data['wd_body_font_googlefont'] ) );
	$body_second_font = esc_attr( str_replace( " ", "+", $smof_data['wd_body_second_font_googlefont'] ) );
	$menu_font = esc_attr( str_replace( " ", "+", $smof_data['wd_menu_font_googlefont'] ) );
	$sub_menu_font = esc_attr( str_replace( " ", "+", $smof_data['wd_sub_menu_font_googlefont'] ) );
	$price_font = esc_attr( str_replace( " ", "+", $smof_data['wd_price_font_googlefont'] ) );
	
	if( absint($smof_data['wd_body_font_googlefont_enable']) == 0 && strcmp($body_font,'none') != 0 )
		wd_load_google_font_yith_compare(trim($body_font));
	if( absint($smof_data['wd_body_second_font_googlefont_enable']) == 0 && strcmp($body_second_font,'none') != 0 )
		wd_load_google_font_yith_compare(trim($body_second_font));
	if( absint($smof_data['wd_menu_font_googlefont_enable']) == 0 && strcmp($menu_font,'none') != 0 )
		wd_load_google_font_yith_compare(trim($menu_font));
	if( absint($smof_data['wd_sub_menu_font_googlefont_enable']) == 0 && strcmp($sub_menu_font,'none') != 0 )
		wd_load_google_font_yith_compare(trim($sub_menu_font));
	if( absint($smof_data['wd_price_font_googlefont_enable']) == 0 && strcmp($price_font,'none') != 0 )
		wd_load_google_font_yith_compare(trim($price_font));
	
}
function wd_load_google_font_yith_compare($wd_font_name){
	if( isset($wd_font_name) && strlen( $wd_font_name ) > 0 ){
		$font_name_id = str_replace('+', '_', strtolower($wd_font_name));
		$protocol = is_ssl() ? 'https' : 'http';
		$link = $protocol.'://fonts.googleapis.com/css?family='.$wd_font_name;
		echo '<link rel="stylesheet" type="text/css" id="oswad_market_'.$font_name_id.'" media="all" href="'.$link.'" />';	
	}
}
if( isset($_GET['action']) && $_GET['action'] == 'yith-woocompare-view-table' )
	add_action('wp_head','wd_add_style_yith_compare');

function wd_open_div_list_add_to_cart(){
	echo "<div class=\"list_add_to_cart_wrapper\">";
}
add_action( 'woocommerce_after_shop_loop_item', 'wd_open_div_list_add_to_cart', 9998 );
function wd_close_div_list_add_to_cart(){
	echo "</div>";
}
add_action( 'woocommerce_after_shop_loop_item', 'wd_close_div_list_add_to_cart', 10003 );


add_action ('woocommerce_after_shop_loop_item','close_div_style',20000);


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );			
add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );	

	function add_short_content(){
		global $product;
		$content = get_the_content($product);
		$rs = '';
		$rs .= '<div class="product_short_content">';
		$rs .= substr($content,0,60);
		$rs .= '</div>';
		echo $rs;
	}
	function get_product_categories(){
		global $product;
		$categories_label = __("Categories : ","wpdance");
		$rs = '';
		$rs .= '<div class="wd_product_categories"><span>'.$categories_label.'</span>';
		$product_categories = wp_get_post_terms(get_the_ID($product),'product_cat');
		$count = count($product_categories);
		if ( $count > 0 ){
			foreach ( $product_categories as $term ) {
			$rs.= '<a href="'.get_term_link($term->slug,$term->taxonomy).'">'.$term->name . "</a>, ";

			}
			$rs = substr($rs,0,-2);
		}
		$rs .= '</div>';
		echo $rs;
	}

	
	

	function wd_template_loop_product_thumbnail(){
		
		global $product, $post, $smof_data;
		$has_back_image = (isset($smof_data["wd_effect_product"]) && (int)$smof_data["wd_effect_product"] == 1)?true:false;
		$_prod_galleries = $product->get_gallery_attachment_ids();
		
		$_front_classes = "product-image-front";
		if ( !has_post_thumbnail() ){
			$_front_classes = $_front_classes . " default-thumb";
		}	
		
		echo "<div class='{$_front_classes}'>";
		echo woocommerce_get_product_thumbnail();
		echo '</div>';
		if( $has_back_image && is_array($_prod_galleries) && count($_prod_galleries) > 0 ){
			echo "<div class='product-image-back'>";
			echo wp_get_attachment_image( $_prod_galleries[0],'shop_catalog' );
			echo '</div>';
		}
	}


	//open a div to wrap all product meta
	function open_div_style(){
		echo "<div class=\"product-meta-wrapper\">";
	}
	//close div product meta wrapper
	function close_div_style(){
		echo "</div>";
	}

	function add_product_title(){
		global $smof_data, $post, $product,$product_datas;
		$_uri = esc_url(get_permalink($post->ID));
		$show_label = true;
		if( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_post_type_archive( "product" ) ){
			if( !(int)$smof_data['wd_prod_cat_title_label'] )
				$show_label = false;
		}
		echo "<h3 class=\"heading-title product-title\">";
		//Show label before title
		if( $show_label ){
			$label_class="";
			$label_text = "";
			if($product->is_featured()){
				$label_class = "lb_feature";
				$label_text = __("feature","wpdance");
			}
			if($product->is_on_sale()){
				$label_class = "lb_onsale";
				$label_text = __("save off","wpdance");
			}
			$now = strtotime( date("Y-m-d H:i:s") );
			$post_date = strtotime( $post->post_date );
			$num_day = (int)(($now-$post_date)/(3600*24));
			if( $num_day < 30 ){
				$label_class = "lb_new";
				$label_text = __("new","wpdance");
			}
			if($product->is_featured() && $product->is_on_sale()){
				$label_class = "lb_hot";
				$label_text = __("hot","wpdance");
			}
			echo '<span class="'.$label_class.' label_title">'.$label_text.'</span>';
		}
		
		echo "<a href='{$_uri}'>". esc_attr(get_the_title()) ."</a>";
		echo "</h3>";
	}


	function add_label_to_product_list(){
		global $post, $product,$product_datas;
		echo '<div class="product_label">';
		
		$now = strtotime( date("Y-m-d H:i:s") );
		$post_date = strtotime( $post->post_date );
		$num_day = (int)(($now-$post_date)/(3600*24));
		if( $num_day < 30 ){
			echo "<span class=\"new product_label\">".__( 'New','wpdance' )."</span>";
		}
		
		if ($product->is_on_sale()){ 
			if( $product->regular_price > 0 ){
				$_off_percent = (1 - round($product->get_price() / $product->regular_price, 2))*100;
				$_off_price = round($product->regular_price - $product->get_price(), 0);
				$_price_symbol = get_woocommerce_currency_symbol();
				echo "<span class=\"onsale show_off product_label\">".__( 'Save off','wpdance' )."<span class=\"off_number\">-{$_price_symbol}{$_off_price}</span></span>";	
			}else{
				echo "<span class=\"onsale product_label\">".__( 'Save off','wpdance' )."</span>";
			}
		}
		if ($product->is_featured()){
			echo "<span class=\"featured product_label\">".__( 'Feature','wpdance' )."</span>";
		}
		echo "</div>";
	}

	function add_sku_to_product_list(){
		global $product, $woocommerce_loop;
		echo "<span class=\"product_sku\">" . esc_attr($product->get_sku()) . "</span>";
	}


	function custom_product_thumbnail(){
		global $product,$post;
		$thumb = get_post_thumbnail_id($post->ID);
		$_prod_galleries = $product->get_gallery_attachment_ids( );					
		?>
			<div class="product-image-front">			
				<?php 
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('custom_prod_thumb',array('class' => 'big_layout') ); 
					} 				 
				?>
			</div>		
		<?php
			if( is_array($_prod_galleries) && count($_prod_galleries) > 0 ):
				$_image_src = wp_get_attachment_image_src( $_prod_galleries[0],'full' );
		?>	
				<div class="product-image-back">
					<?php 
						echo wp_get_attachment_image( $_prod_galleries[0], 'custom_prod_thumb', false, array('class' => 'big_layout') );
					?>
				</div>
		<?php		
			endif;
		?>	
		<?php					
	}
	
add_filter('woocommerce_widget_cart_product_title','add_sku_after_title',100000000000000000000000000000,2);

function add_sku_after_title($title,$product){
	$prod_uri = "<a href='".get_permalink( $product->id )."'>";
	$_sku_string = "</a>{$prod_uri}<span class=\"product_sku\">{$product->get_sku()}</span>";
	return $title.$_sku_string;
}

function wd_upsell_related_display(){
		global $smof_data;
		$_wd_related = (int)$smof_data['wd_prod_related'];
		$_wd_upsell = (int) $smof_data['wd_prod_upsell'];
	?>
		<div class="products-tabs-wrapper" id="products-tabs-wrapper">

			<ul class="nav nav-tabs">
				<?php if( $_wd_related ):?>
				<li class="active">
					<a href="#related_products" data-toggle="tab">
						<h2 class="heading-title"><?php echo $_related_title = sprintf( __( '%s','wpdance' ), do_shortcode(stripslashes($smof_data['wd_prod_related_title'])) ); ?></h2>
					</a>
				</li>
				<?php endif; ?>
				<?php if( $_wd_upsell ): ?>
				<li class="<?php echo $_d_class = $_wd_related == 0 ? "active" : ""?>">
					<a href="#upsell_products" data-toggle="tab">
						<h2 class="heading-title"><?php echo $_upsell_title = sprintf( __( '%s','wpdance' ), do_shortcode(stripslashes($smof_data['wd_prod_upsell_title'])) ); ?></h2>
					</a>
				</li>
				<?php endif; ?>
			</ul>	
			
			<div class="tab-content">
				<?php if( $_wd_related ):?>
				<div class="tab-pane active" id="related_products">
					<?php
						woocommerce_related_products( array(12), false );	
					?>			

				</div>
				<?php endif; ?>
				<?php if( $_wd_upsell ): ?>
				<div class="tab-pane <?php echo $_d_class = $_wd_related == 0 ? "active" : ""?>" id="upsell_products">
					<?php
						wc_get_template( 'single-product/up-sells.php', array(
									'posts_per_page'  => 12,
									'orderby'    => 'rand',
									'columns'    => 4
							) );
					?>
				</div>
				<?php endif; ?>
			</div>	
		</div>	
			
	<?php		
	}

//add new tab to prod page
if( !is_admin() ){
	add_filter( 'woocommerce_product_tabs', 'wd_addon_product_tabs', 13 );
}

function wd_addon_product_tabs( $tabs = array() ){
		global $product, $post,$smof_data;
		
		// Description tab - shows product content
		if ( $post->post_excerpt )
			$tabs['description'] = array(
				'title'    => __( 'Descriptions', 'wpdance' ),
				'priority' => 10,
				'callback' => 'woocommerce_product_description_tab'
			);
		if( !$smof_data['wd_prod_desc_tab'] )
			unset($tabs['description']);
		
		// Reviews tab - shows comments
		if ( comments_open() )
			$tabs['reviews'] = array(
				'title'    => sprintf( __( 'Reviews (%d)', 'wpdance' ), get_comments_number( $post->ID ) ),
				'priority' => 90,
				'callback' => 'comments_template'
			);
		if( !$smof_data['wd_prod_review'] )
			unset($tabs['reviews']);
			
		/* Tags tab */	
		if( $smof_data['wd_prod_tags_tab'] )
			$tabs['tags'] = array(
					'title'    => sprintf( __( 'Tags', 'wpdance' ) ),
					'priority' => 80,
					'callback' => 'product_tags_template'
			);			
		
		if ( $product->has_attributes() || ( get_option( 'woocommerce_enable_dimension_product_attributes' ) == 'yes' && ( $product->has_dimensions() || $product->has_weight() ) ) )
			$tabs['additional_information'] = array(
				'title'    => __( 'Additional Information', 'wpdance' ),
				'priority' => 20,
				'callback' => 'woocommerce_product_additional_information_tab'
			);	
		if( !$smof_data['wd_prod_add_info_tab'] )
			unset($tabs['additional_information']);
			
		return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'wd_addon_custom_tabs',100 );
function wd_addon_custom_tabs ( $tabs = array() ){
	global $smof_data;
	if($smof_data['wd_prod_customtab']) {
		$tabs['wd_custom'] = array(
			'title'    =>  sprintf( __( '%s','wpdance' ), stripslashes(esc_html($smof_data['wd_prod_customtab_title'])) )
			,'priority' => 70
			,'callback' => "print_custom_tabs"
		);
	}
	return $tabs; 
}

function print_custom_tabs(){
	global $smof_data;
	echo do_shortcode(stripslashes(htmlspecialchars_decode($smof_data['wd_prod_customtab_content'])));
}


function product_tags_template(){
	global $product, $post;
	$_terms = wp_get_post_terms( $product->id, 'product_tag');
	$tags_label = __("Tags","wpdance");
	echo '<div class="tagcloud">';
	
	$_include_tags = '';
	if( count($_terms) > 0 ){
		echo '<span class="tag_heading">'.$tags_label.'</span>';
		foreach( $_terms as $index => $_term ){
			$_include_tags .= ( $index == 0 ? "{$_term->term_id}" : ",{$_term->term_id}" ) ;
		}
		wp_tag_cloud( array('taxonomy' => 'product_tag', 'include' => $_include_tags, 'separator'=>'' ) );
	}
	
	echo "</div>\n";	
	
}

/// end new tabs

function wd_template_single_review(){
	global $product,$smof_data;

	if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
		return;	
	if( function_exists('wd_get_rating_html') ){
		$rating_html = wd_get_rating_html();
	}
	else{
		$rating_html = $product->get_rating_html();
	}
	if ( $rating_html ) {
		echo "<div class=\"review_wrapper\">";
		if($smof_data['wd_prod_rating']){
			echo "<div class='rating_wrapper'>";
			echo '<span class="review_count">'.$product->get_rating_count()." ";
			_e("Review(s)",'wpdance');
			echo "</span>";
			echo $rating_html;
			echo "</div>";
		}
		echo '<span class="add_new_review"><a href="#reviews" class="inline show_review_form woocommerce-review-link" title="Review for '. esc_attr($product->get_title()) .' ">' . __( 'Write review for this product', 'wpdance' ) . '</a></span>';
		echo "</div>";
	}else{
		echo '<p><span class="add_new_review"><a href="#reviews" class="inline show_review_form woocommerce-review-link" title="Review for '. esc_attr($product->get_title()) .' ">' . __( 'Be the first to review this product', 'wpdance' ) . '</a></span></p>';

	}

	
}


//add_action( 'woocommerce_product_thumbnails', 'wd_template_shipping_return', 30 );
add_action( 'woocommerce_after_single_product_summary', 'wd_template_shipping_return', 9 );
function wd_template_shipping_return(){
	global $smof_data;
?>
	<div class="return-shipping">
        <div class="title-quick">
            <h6 class="title-quickshop">
				<?php 
					echo $title = sprintf( __( '%s','wpdance' ), stripslashes(esc_attr($smof_data['wd_prod_ship_return_title'])) );
				?>
			</h6>
        </div>
        <div class="content-quick">
            <?php echo stripslashes($smof_data['wd_prod_ship_return_content']);?>
        </div>
	</div>
<?php
}

/* END PRODUCT DETAIL */

if( !class_exists('WD_Quickshop') ){
	function wd_add_hidden_product_id(){
		global $product;
		echo "<input type='hidden' value='{$product->id}' class='hidden_product_id product_hidden_{$product->id}'>";
	}
	add_action('woocommerce_after_shop_loop_item', 'wd_add_hidden_product_id', 100000000000 );
}



remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
//add_action( 'wd_before_main_content', 'dimox_shop_breadcrumbs', 10, 0 );


if ( ! function_exists( 'dimox_shop_breadcrumbs' ) ) {

	/**
	 * Output the WooCommerce Breadcrumb
	 *
	 * @access public
	 * @return void
	 */
	function dimox_shop_breadcrumbs( $args = array() ) {

		$defaults = apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => '<span class="brn_arrow">&#47;</span>',
			'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'wpdance' ),
		) );

		$args = wp_parse_args( $args, $defaults );

		wc_get_template( 'shop/breadcrumb.php', $args );
	}
}

add_filter( "single_add_to_cart_text", "update_add_to_cart_text", 10, 1 );


function update_add_to_cart_text( $button_text ){
	return $button_text = __('Add to Cart','wpdance');
}
function update_single_product_wrapper_class( $_wrapper_class ){
	return $_wrapper_class = "without_related";
}


add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

/* Fix pagination WooCommerce 2.2.10 and Wordpress 4.1 */
add_filter('woocommerce_pagination_args', 'wd_fix_pagination_woocommerce');
function wd_fix_pagination_woocommerce($navi_data = array()){
	if( defined('WC_VERSION') && strnatcmp(WC_VERSION, '2.2.10') >= 0 && get_bloginfo('version') == '4.1' && isset($navi_data['base']) ){
		$navi_data['base'] = htmlspecialchars_decode($navi_data['base']);
	}
	return $navi_data;
}

//User contact method
if( !function_exists('wd_custom_contact_method') ){
	add_filter('user_contactmethods', 'wd_custom_contact_method');
	function wd_custom_contact_method( $user_contact ){
		$user_contact['twitter'] = __('Twitter ID','wpdance'); 
		return $user_contact;
	}
}

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'wd_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );


	add_action( 'woocommerce_before_checkout_registration_form', 'wd_checkout_fields_form', 10 );
	if ( ! function_exists( 'wd_checkout_fields_form' ) ) {
		function wd_checkout_fields_form($checkout){
			$checkout->checkout_fields['account']    = array(
				'account_username' => array(
										'type' => 'text',
										'label' => __('Account username', 'wpdance'),
										'placeholder' => _x('Username', 'placeholder', 'wpdance')
									),
				'account_password' => array(
										'type' => 'password',
										'label' => __('Account password', 'wpdance'),
										'placeholder' => _x('Password', 'placeholder', 'wpdance'),
									),
				'confirm_account_password' => array(
										'type' => 'password',
										'label' => __('Confirm account password', 'wpdance'),
										'placeholder' => _x('Password', 'placeholder', 'wpdance'),
									)
			);
		}
	}

/* Remove Cart Totals */	
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

//add_action( 'woocommerce_review_order_before_submit', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_after_checkout_form', 'wd_checkout_add_on_js', 10 );
if ( ! function_exists( 'wd_checkout_add_on_js' ) ) {
	function wd_checkout_add_on_js(){
?>
	<script type='text/javascript'>
			jQuery(document).ready(function() {
				"use strict";
				
				jQuery('input.checkout-method').live('change',function(event){
					if( jQuery(this).val() == 'account' && jQuery(this).is(":checked") ){
						jQuery('.accordion-createaccount').removeClass('hidden');
						jQuery('#collapse-login-regis').find('input.next_co_btn').attr('rel','accordion-account');
						jQuery('._old_counter').addClass('hidden');
						jQuery('._new_counter').removeClass('hidden');
						
					}else{
						jQuery('.accordion-createaccount').addClass('hidden');
						jQuery('#collapse-login-regis').find('input.next_co_btn').attr('rel','accordion-billing');
						jQuery('._old_counter').removeClass('hidden');
						jQuery('._new_counter').addClass('hidden');					
					}
				});
				jQuery('input.checkout-method').trigger('change');
				
				jQuery('.next_co_btn').live('click',function(){
					var _next_id = '#'+jQuery(this).attr('rel');
					jQuery('.accordion-group').not(_next_id).find('.accordion-body').each(function(index,value){
						if( jQuery(value).hasClass('in') )
							jQuery(value).siblings('.accordion-heading').children('a.accordion-toggle').trigger('click');
					});
					if( !jQuery(_next_id).find('.accordion-body').hasClass('in') ){	
						jQuery(_next_id).find('.accordion-body').siblings('.accordion-heading').children('a.accordion-toggle').trigger('click');
					}
				});
				
			});
		</script>
<?php	
	}
}
/* Custom Hook for bbPress forum */
if( class_exists('bbPress') ){
	add_filter('bbp_no_breadcrumb',create_function('','return true;'),999);
}
?>
