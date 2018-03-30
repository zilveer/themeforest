<?php


function avia_woocommerce_enabled()
{
	if ( class_exists( 'woocommerce' ) ){ return true; }
	return false;
}


global $avia_config;

//product thumbnails
$avia_config['imgSize']['shop_thumbnail'] 	= array('width'=>130, 'height'=>85);
$avia_config['imgSize']['shop_catalog'] 	= array('width'=>450, 'height'=>450);
$avia_config['imgSize']['shop_single'] 		= array('width'=>450, 'height'=>999, 'crop' => false);
avia_backend_add_thumbnail_size($avia_config);

include('admin-options.php');
include('admin-import.php');
include( 'woocommerce-mod-css-dynamic.php');

add_theme_support( 'woocommerce' );

//check if the plugin is enabled, otherwise stop the script
if(!avia_woocommerce_enabled()) { return false; }


//register my own styles, remove wootheme stylesheet
if(!is_admin()){
	add_action('init', 'avia_woocommerce_register_assets');
}



function avia_woocommerce_register_assets()
{
	wp_enqueue_style( 'avia-woocommerce-css', AVIA_BASE_URL.'config-woocommerce/woocommerce-mod.css');
	wp_enqueue_script( 'avia-woocommerce-js', AVIA_BASE_URL.'config-woocommerce/woocommerce-mod.js', array('jquery'), 1, true);
}

global $woocommerce;

if(version_compare($woocommerce->version, "2.1", "<"))
{
	define('WOOCOMMERCE_USE_CSS', false);
	$avia_config['woocommerce_version'] = "pre21";
}
else
{
	add_filter( 'woocommerce_enqueue_styles', 'avia_woocommerce_enqueue_styles' );
	function avia_woocommerce_enqueue_styles($styles)
	{
		global $woocommerce, $avia_config; 
	
		$avia_config['woocommerce_version'] = $woocommerce->version;
		$styles = array();
		return $styles;
	}
}


function avia_woocommerce_change_search()
{
	if(avia_get_option('header_search') == 'product')
	{
		echo '<input type="hidden" name="post_type" value="product">';
	}
							
}

add_action('avia_frontend_search_form', 'avia_woocommerce_change_search');

function avia_woocommerce_change_search_label($label)
{
	if(avia_get_option('header_search') == 'product')
	{
		$label = __('Search for products','avia_framework');
	}
		return $label;					
}

add_action('avia_frontend_search_form_label', 'avia_woocommerce_change_search_label');






######################################################################
# config
######################################################################

//add avia_framework config defaults

$avia_config['shop_overview_column']  = get_option('avia_woocommerce_column_count');  // columns for the overview page
$avia_config['shop_overview_products']= get_option('avia_woocommerce_product_count'); // products for the overview page

$avia_config['shop_single_column'] 	 = 4;			// columns for related products and upsells
$avia_config['shop_single_column_items'] 	 = 4;	// number of items for related products and upsells
$avia_config['shop_overview_excerpt'] = false;		// display excerpt

if(!$avia_config['shop_overview_column']) $avia_config['shop_overview_column'] = 3;


######################################################################
# Create the correct template html structure
######################################################################

//remove woo defaults
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_single_product', array($woocommerce, 'show_messages'), 10);



//add theme actions && filter
add_action( 'woocommerce_after_shop_loop_item_title', 'avia_woocommerce_overview_excerpt', 10);
add_filter( 'loop_shop_columns', 'avia_woocommerce_loop_columns');
add_filter( 'loop_shop_per_page', 'avia_woocommerce_product_count' );

//single page adds
add_action( 'avia_add_to_cart', 'woocommerce_template_single_add_to_cart', 30, 2 );



/*update woocommerce v2*/

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); /*remove result count above products*/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); /*remove woocommerce ordering dropdown*/
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); //remove rating
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); //remove woo pagination



######################################################################
# FUNCTIONS
######################################################################





#
# removes the default post image from shop overview pages and replaces it with this image
#
add_action( 'woocommerce_before_shop_loop_item_title', 'avia_woocommerce_thumbnail', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

function avia_woocommerce_thumbnail($asdf)
{
	global $product, $avia_config;
	$rating = $product->get_rating_html(); //get rating


	echo "<div class='thumbnail_container'>";
		echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog' );
		if(!empty($rating)) echo "<span class='rating_container'>".$rating."</span>";
		if($product->product_type == 'simple') echo "<span class='cart-loading'></span>";
	echo "</div>";
}






#
# add ajax cart / options buttons to the product
#

add_action( 'woocommerce_after_shop_loop_item', 'avia_add_cart_button', 6);
function avia_add_cart_button()
{
	global $product;

	if ($product->product_type == 'bundle' ){
		$product = new WC_Product_Bundle($product->id);
	}

	$extraClass  = "";

	ob_start();
	woocommerce_template_loop_add_to_cart();
	$output = ob_get_clean();

	if($product->product_type == 'variable' && empty($output))
	{
		$output = "<a class='add_to_cart_button button product_type_variable' href='".get_permalink($product->id)."'>".__('Select options','avia_framework')."</a>";
	}

	if($product->product_type == 'simple')
	{
		$output .= "<a class='button show_details_button' href='".get_permalink($product->id)."'>".__('Show Details','avia_framework')."</a>";
	}
	else
	{
		$extraClass  = "single_button";
	}


	if($output) echo "<div class='avia_cart_buttons $extraClass'><div class='inner_cart_button'>$output</div></div>";
}






#
# wrap products on overview pages into an extra div for improved styling options. adds "product_on_sale" class if prodct is on sale
#

add_action( 'woocommerce_before_shop_loop_item', 'avia_shop_overview_extra_div', 5);
function avia_shop_overview_extra_div()
{
	global $product;
	$product_class = $product->is_on_sale() ? "product_on_sale" : "";

	echo "<div class='inner_product wrapped_style $product_class'>";
}

add_action( 'woocommerce_after_shop_loop_item',  'avia_close_div', 1000);
function avia_close_div()
{
	echo "</div>";
}


#
# wrap product titles and sale number on overview pages into an extra div for improved styling options
#

add_action( 'woocommerce_before_shop_loop_item_title', 'avia_shop_overview_extra_header_div', 20);
function avia_shop_overview_extra_header_div()
{
	echo "<div class='inner_product_header'>";
}

add_action( 'woocommerce_after_shop_loop_item_title',  'avia_close_div', 1000);


#
# remove on sale badge from usual location and add it to the bottom of the product
#
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);


#
# create the shop navigation with account links, as well as cart and checkout, called as fallback function by the wp_nav_menu function in header.php
#
function avia_shop_nav($args)
{
	$output = "";
	$url = avia_collect_shop_urls();

	$output .= "<ul>";

	if( is_user_logged_in() )
	{
		global $woocommerce, $wp;
		
		
		$current = $sub1 = $sub2 = $sub3 = "";
		if(is_account_page()) $current = "current-menu-item";
		if(is_page(get_option('woocommerce_change_password_page_id'))) $sub1 = "current-menu-item";
		if(is_page(get_option('woocommerce_edit_address_page_id'))) $sub2 = "current-menu-item";
		if(is_page(get_option('woocommerce_view_order_page_id'))) $sub3 = "current-menu-item";
		
		
		//woo version 2.1+ determination of page
		if ( isset( $wp->query_vars['edit-account'] ) ) { $sub1 = "current-menu-item"; }
		if ( isset( $wp->query_vars['edit-address'] ) ) { $sub2 = "current-menu-item"; }
		if ( isset( $wp->query_vars['view-order'] ) )   { $sub3 = "current-menu-item"; }
		
	
		

		$output .= "<li class='$current account_overview_link'><a href='".$url['account_overview']."'>".__('My Account', 'avia_framework')."</a>";
			$output .= "<ul>";
			$output .= "<li class='$sub1 account_change_pw_link'><a href='".$url['account_change_pw']."'>".__('Change Password', 'avia_framework')."</a></li>";
			$output .= "<li class='$sub2 account_edit_adress_link'><a href='".$url['account_edit_adress']."'>".__('Edit Address', 'avia_framework')."</a></li>";
			$output .= "<li class='$sub3 account_view_order_link'><a href='".$url['account_view_order']."'>".__('View Order', 'avia_framework')."</a></li>";
			$output .= "</ul>";
		$output .= "</li>";
		$output .= "<li class='account_logout_link'><a href='".$url['logout']."'>".__('Log Out', 'avia_framework')."</a></li>";
	}
	else
	{
		$sub1 = $sub2 = "";
		if(is_page(get_option('woocommerce_myaccount_page_id')))
		{
			if(isset($_GET['account_visible']) && $_GET['account_visible'] == 'register') $sub1 = "current-menu-item";
			if(isset($_GET['account_visible']) && $_GET['account_visible'] == 'login') $sub2 = "current-menu-item";
		}

		$url_param = strpos($url['account_overview'], '?') === false ? "?" : "&";

		if (get_option('woocommerce_enable_myaccount_registration') =='yes')
		{
			$output .= "<li class='register_link $sub1'><a href='".$url['account_overview'].$url_param."account_visible=register'>".__('Register', 'avia_framework')."</a></li>";
		}

		$output .= "<li class='login_link $sub2'><a href='".$url['account_overview'].$url_param."account_visible=login'>".__('Log In', 'avia_framework')."</a></li>";
	}

	$output .= "</ul>";

	if($args['echo'] == true)
	{
		echo $output;
	}
	else
	{
		return $output;
	}
}


#
# helper function that collects all the necessary urls for the shop navigation
#

function avia_collect_shop_urls()
{
	global $woocommerce, $avia_config;

	$url['cart']				= $woocommerce->cart->get_cart_url();
	$url['checkout']			= $woocommerce->cart->get_checkout_url();
	$url['logout'] 				= wp_logout_url(home_url('/'));
	$url['account_overview'] 	= get_permalink(get_option('woocommerce_myaccount_page_id'));
	
	if($avia_config['woocommerce_version'] == "pre21")
	{
		$url['account_edit_adress']	= get_permalink(get_option('woocommerce_edit_address_page_id'));
		$url['account_view_order']	= get_permalink(get_option('woocommerce_view_order_page_id'));
		$url['account_change_pw'] 	= get_permalink(get_option('woocommerce_change_password_page_id'));
	}
	else
	{
		$order = new WC_Order(false);
		$url['account_edit_adress']	= wc_get_endpoint_url( 'edit-address', '', get_permalink( wc_get_page_id( 'myaccount' ) ) );
		$url['account_view_order']	= $order->get_view_order_url();
		$url['account_change_pw'] 	= wc_customer_edit_account_url();
	}

	return $url;
}




#
# check which page is displayed and if the automativ sidebar menu for subpages should be prevented
#
add_filter( 'avia_sidebar_menu_filter', 'avia_woocommerce_sidebar_filter');

function avia_woocommerce_sidebar_filter($menu)
{
	$id = avia_get_the_ID();
	if(is_cart() || is_checkout() || get_option('woocommerce_thanks_page_id') == $id){$menu = "";}
	return $menu;
}


function avia_add_to_cart($post, $product )
{
	echo "<div class='avia_cart avia_cart_".$product->product_type."'>";
	do_action( 'avia_add_to_cart', $post, $product );
	echo "</div>";
}



#
# replace thumbnail image size with full size image on single pages
#
/*

add_filter( 'single_product_small_thumbnail_size', 'avia_woocommerce_thumb_size');

function avia_woocommerce_thumb_size()
{
	return 'shop_single';
}
*/




#
# if we are viewing a woocommerce page modify the breadcrumb nav
#

if(!function_exists('avia_woocommerce_breadcrumb'))
{
	add_filter('avia_breadcrumbs_trail','avia_woocommerce_breadcrumb');

	function avia_woocommerce_breadcrumb($trail)
	{
		global $avia_config;

		if(is_woocommerce())
		{

			$home 		= $trail[0];
			$last 		= array_pop($trail);
			$shop_id 	= woocommerce_get_page_id('shop');
			$taxonomy 	= "product_cat";

			// on the shop frontpage simply display the shop name, rather than shop name + "All Products"
			if(is_shop())
			{
				if(!empty($shop_id) && $shop_id  != -1)  $trail = array_merge( $trail, avia_breadcrumbs_get_parents( $shop_id ) );
				$last = "";

				if(is_search())
				{
					$last = __('Search results for: ','avia_framework').esc_attr($_GET['s']);
				}
			}

			// on the product page single page modify the breadcrumb to read [home] [if available:parent shop pages] [shop] [if available:parent categories] [category] [title]
			if(is_product())
			{
				//fetch all product categories and search for the ones with parents. if none are avalaible use the first category found
				$product_category = $parent_cat = array();
				$temp_cats = get_the_terms(get_the_ID(), $taxonomy);

				if(!empty($temp_cats))
				{
					foreach($temp_cats as $key => $cat)
					{
						if($cat->parent != 0 && !in_array($cat->term_taxonomy_id, $parent_cat))
						{
							$product_category[] = $cat;
							$parent_cat[] = $cat->parent;
						}
					}

					//if no categories with parents use the first one
					if(empty($product_category)) $product_category[] = reset($temp_cats);

				}
				//unset the trail and build our own
				unset($trail);

				$trail[0] = $home;
				if(!empty($shop_id) && $shop_id  != -1)    $trail = array_merge( $trail, avia_breadcrumbs_get_parents( $shop_id ) );
				if(!empty($parent_cat)) $trail = array_merge( $trail, avia_breadcrumbs_get_term_parents( $parent_cat[0] , $taxonomy ) );
				if(!empty($product_category)) $trail[] = '<a href="' . get_term_link( $product_category[0]->slug, $taxonomy ) . '" title="' . esc_attr( $product_category[0]->name ) . '">' . $product_category[0]->name . '</a>';

			}


			// add the [shop] trail to category/tag pages: [home] [if available:parent shop pages] [shop] [if available:parent categories] [category/tag]
			if(is_product_category() || is_product_tag())
			{
				if(!empty($shop_id) && $shop_id  != -1)
				{
					$shop_trail = avia_breadcrumbs_get_parents( $shop_id ) ;
					array_splice($trail, 1, 0, $shop_trail);
				}
			}

			if(is_product_tag())
			{
				$last = __("Tag",'avia_framework').": ".$last;
			}


			if(!empty($last)) $trail[] = $last;
		}

		return $trail;
	}

}



#
# creates the avia framework container arround the shop pages
#
add_action( 'woocommerce_before_main_content', 'avia_woocommerce_before_main_content', 10);


function avia_woocommerce_before_main_content()
{
	global $avia_config;

	if(!isset($avia_config['shop_overview_column'])) $avia_config['shop_overview_column'] = "auto";
	if($new = avia_post_meta( get_option('woocommerce_shop_page_id'), 'layout'))
	{
		 //split up result
	 	 $results = explode(' : ', $new);
	 	 foreach($results as $result)
	 	 {
	 	 	$result = explode('|', $result);
	 	 	$avia_config[$result[0]] = $result[1];
	 	 }

	 	 $avia_config['layout'] = apply_filters('avia_layout_filter',  $avia_config['layout']);
	}

	$title_args = array();

	if(is_woocommerce())
	{
		$t_link = "";

		if(is_shop()) $title  = get_option('woocommerce_shop_page_title');

		$shop_id = woocommerce_get_page_id('shop');
		if($shop_id && $shop_id != -1)
		{
			if(empty($title)) $title = get_the_title($shop_id);
			$t_link = get_permalink($shop_id);
		}

		if(!$title) $title  = __("Shop",'avia_framework');

		if(is_product_category() || is_product_tag())
        {
            global $wp_query;
            $tax = $wp_query->get_queried_object();
            $title = $tax->name;
            $t_link = '';
        }

		$title_args = array('title' => $title, 'link' => $t_link);
	}

	echo avia_title($title_args);

	echo "<div class='container_wrap main_color ".avia_layout_class( 'main' , false )." template-shop shop_columns_".$avia_config['shop_overview_column']."'>";

		echo "<div class='container'>";

		if(!is_singular()) { $avia_config['overview'] = true; }
}

#
# closes the avia framework container arround the shop pages
#

add_action( 'woocommerce_after_main_content', 'avia_woocommerce_after_main_content', 10);
function avia_woocommerce_after_main_content()
{
	global $avia_config;
	$avia_config['currently_viewing'] = "shop";

			//reset all previous queries
			wp_reset_query();

			//get the sidebar
			if(!is_singular())
			get_sidebar();

		echo "</div>"; // end container
	echo "</div>"; // end tempate-shop content
}




#
# wrap an empty product search into extra div
#
add_action( 'woocommerce_before_main_content', 'avia_woocommerce_404_search', 9111);
function avia_woocommerce_404_search()
{
	global $wp_query;

	if( (is_search() || is_archive()) && empty($wp_query->found_posts) )
	{
		echo "<div class='template-page template-search template-search-none content ".avia_layout_class( 'content', false )." units'>";
		echo "<div class='entry entry-content' id='search-fail'>";
			  get_template_part('includes/error404');
		echo "</div>";
	}
}

add_action( 'woocommerce_after_main_content', 'avia_woocommerce_404_search_close', 1);
function avia_woocommerce_404_search_close()
{
	global $wp_query;
	if( is_search() && empty($wp_query->found_posts) ){ echo "</div>";}
}




#
# modifies the class of a page so we can display single login and single register
#
add_filter( 'avia_layout_class_filter_main', 'avia_register_login_class');

function avia_register_login_class($layout)
{
	if(isset($_GET['account_visible']))
	{
		if($_GET['account_visible'] == 'register') $layout .= " template-register";
		if($_GET['account_visible'] == 'login') $layout .= " template-login";
	}

	return $layout;
}







#
# creates the avia framework content container arround the shop loop
#
add_action( 'woocommerce_before_shop_loop', 'avia_woocommerce_before_shop_loop', 1);

function avia_woocommerce_before_shop_loop()
{

	global $avia_config;
	if(isset($avia_config['dynamic_template'])) return;
	echo "<div class='template-shop content ".avia_layout_class( 'content' , false)." units'>";

}

#
# closes the avia framework content container arround the shop loop
#
add_action( 'woocommerce_after_shop_loop', 'avia_woocommerce_after_shop_loop', 10);

function avia_woocommerce_after_shop_loop()
{
			global $avia_config;
			if(isset($avia_config['dynamic_template'])) return;
			if(isset($avia_config['overview'] )) echo avia_pagination();
			echo "</div>"; //end content
}



#
# echo the excerpt
#
function avia_woocommerce_overview_excerpt()
{
	global $avia_config;

	if(!empty($avia_config['shop_overview_excerpt']))
	{
		echo "<div class='product_excerpt'>";
		the_excerpt();
		echo "</div>";
	}
}



#
# creates the preview images based on page/category image
#
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_product_archive_description', 'woocommerce_product_archive_description', 10 );

add_action( 'woocommerce_before_shop_loop', 'avia_woocommerce_overview_banner_image', 10);
add_action( 'woocommerce_before_shop_loop', 'woocommerce_taxonomy_archive_description', 11 );
//add_action( 'woocommerce_before_shop_loop', 'woocommerce_product_archive_description', 12 ); //causes warning


function avia_woocommerce_overview_banner_image()
{
	global $avia_config;
	if(avia_is_dynamic_template() || is_paged() || is_search() ) return false;

	$image_size = "featured_small";

	if(is_shop())
	{
		$shop_id 	= woocommerce_get_page_id('shop');
		if($shop_id != -1)
		{
			$slider = new avia_slideshow($shop_id);
			$slider -> setImageSize($image_size);
			echo $slider->display();
		}
	}

	if(is_product_category())
	{
		global $wp_query;
		$image	= "";
		if(isset($wp_query->query_vars['taxonomy']))
		{
			$term 			= get_term_by( 'slug', get_query_var($wp_query->query_vars['taxonomy']), $wp_query->query_vars['taxonomy']);
			
			if(!empty($term->term_id))
			{
				$attachment_id 	= get_woocommerce_term_meta($term->term_id, 'thumbnail_id');
	
				if(!empty($attachment_id))
				{
					$image = wp_get_attachment_image( $attachment_id, $image_size, false, array('class'=>'category_thumb'));
					if($image) echo '<div class="slideshow_container  slide_container_big"><ul class="slideshow fade_slider preloading"><li>'.$image.'</li></ul></div>';
				}
			}
		}
	}

}







#
# creates the title + description for overview pages
#
function avia_woocommerce_advanced_title()
{
	global $wp_query;
	$titleClass 	= "";
	$image		 	= "";


	if(!empty($attachment_id))
	{
		$titleClass .= "title_container_image ";
		$image		= wp_get_attachment_image( $attachment_id, 'thumbnail', false, array('class'=>'category_thumb'));
	}

	echo "<div class='extralight-border title_container shop_title_container $titleClass'>";
	//echo avia_breadcrumbs();
	woocommerce_catalog_ordering();
	echo $image;
}


function avia_woocommerce_cart_dropdown()
{
	global $woocommerce;
	$cart_subtotal = $woocommerce->cart->get_cart_subtotal();
	$link = $woocommerce->cart->get_cart_url();


	$output = "";
	$output .= "<ul class = 'cart_dropdown' data-success='".__('Product added', 'avia_framework')."'><li class='cart_dropdown_first'>";
	$output .= "<a class='cart_dropdown_link' href='".$link."'>".__('Cart', 'avia_framework')." - </a><span class='cart_subtotal'>".$cart_subtotal."</span>";
	$output .= "<div class='dropdown_widget dropdown_widget_cart'>";
	$output .= '<div class="widget_shopping_cart_content"><p class="avia_empty_cart">'.__('No products in your shopping cart.','avia_framework').'</p></div>';
	$output .= "</div>";
	$output .= "</li></ul>";

	return $output;
}



#
# modify shop overview column count
#
function avia_woocommerce_loop_columns()
{
	global $avia_config;
	return $avia_config['shop_overview_column'];
}


#
# modify shop overview product count
#

function avia_woocommerce_product_count()
{
	global $avia_config;
	return $avia_config['shop_overview_products'];
}



#
# display tabs and related items within the summary wrapper
#
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action(    'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 1 );



#
# display upsells and related products within dedicated div with different column and number of products
#
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'avia_woocommerce_output_related_products', 20);

function avia_woocommerce_output_related_products()
{
	global $avia_config;
	$output = "";

	ob_start();
	woocommerce_related_products(array('posts_per_page'=>$avia_config['shop_single_column_items'], 'columns'=>$avia_config['shop_single_column'])); // X products, X columns
	$content = ob_get_clean();
	if($content)
	{
		$output .= "<div class='product_column product_column_".$avia_config['shop_single_column']."'>";
		//$output .= "<h3>".(__('Related Products', 'avia_framework'))."</h3>";
		$output .= $content;
		$output .= "</div>";
	}

	$avia_config['woo_related'] = $output;

}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display',10);
add_action( 'woocommerce_after_single_product_summary', 'avia_woocommerce_output_upsells', 21); // needs to be called after the "related product" function to inherit columns and product count

function avia_woocommerce_output_upsells()
{
	global $avia_config;

	$output = "";

	ob_start();
	woocommerce_upsell_display($avia_config['shop_single_column_items'],$avia_config['shop_single_column']); // 4 products, 4 columns
	$content = ob_get_clean();
	if($content)
	{
		$output .= "<div class='product_column product_column_".$avia_config['shop_single_column']."'>";
		//$output .= "<h3>".(__('You may also like', 'avia_framework'))."</h3>";
		$output .= $content;
		$output .= "</div>";
	}

	$avia_config['woo_upsells'] = $output;

}

add_action( 'woocommerce_after_single_product_summary', 'avia_woocommerce_display_output_upsells', 30); //display the related products and upsells

function avia_woocommerce_display_output_upsells()
{
	global $avia_config;

	echo $avia_config['woo_upsells'];
	echo $avia_config['woo_related'];
}



#
# wrap single product image in an extra div
#
add_action( 'woocommerce_before_single_product_summary', 'avia_add_image_div', 2);
add_action( 'woocommerce_before_single_product_summary',  'avia_close_image_div', 20);
function avia_add_image_div()
{
	echo "<div class='four units single-product-main-image alpha'>";
}

function avia_close_image_div()
{
	global $avia_config;
	$avia_config['currently_viewing'] = "shop_single";
	get_sidebar();
	echo "</div>";
}


#
# wrap single product summary in an extra div
#
add_action( 'woocommerce_before_single_product_summary', 'avia_add_summary_div', 25);
add_action( 'woocommerce_after_single_product_summary',  'avia_close_div', 3);
function avia_add_summary_div()
{
	echo "<div class='eight units single-product-summary'>";
}


//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );







#
# displays a front end interface for modifying the shoplist query parameters like sorting order, product count etc
#
if(!function_exists('avia_woocommerce_frontend_search_params'))
{
	add_action( 'woocommerce_before_shop_loop', 'avia_woocommerce_frontend_search_params', 20);

	function avia_woocommerce_frontend_search_params()
	{
		global $avia_config;

		if(!empty($avia_config['woocommerce']['disable_sorting_options'])) return false;

		$product_order['default'] 	= __("Default Order",'avia_framework');
		$product_order['title'] 	= __("Name",'avia_framework');
		$product_order['price'] 	= __("Price",'avia_framework');
		$product_order['date'] 		= __("Date",'avia_framework');

		$product_sort['asc'] 		= __("Click to order products ascending",  'avia_framework');
		$product_sort['desc'] 		= __("Click to order products descending",  'avia_framework');

		$per_page_string 		 	= __("Products per page",'avia_framework');


		$per_page 		 		 	= get_option('avia_woocommerce_product_count');
		if(!$per_page) $per_page 	= get_option('posts_per_page');
		if(!empty($avia_config['woocommerce']['default_posts_per_page'])) $per_page = $avia_config['woocommerce']['default_posts_per_page'];


		parse_str($_SERVER['QUERY_STRING'], $params);

		$po_key = !empty($avia_config['woocommerce']['product_order']) ? $avia_config['woocommerce']['product_order'] : 'default';
		$ps_key = !empty($avia_config['woocommerce']['product_sort'])  ? $avia_config['woocommerce']['product_sort'] : 'asc';
		$pc_key = !empty($avia_config['woocommerce']['product_count']) ? $avia_config['woocommerce']['product_count'] : $per_page;

		$ps_key = strtolower($ps_key);

		//generate markup
		$output  = "";
		$output .= "<div class='product-sorting'>";
		$output .= "    <ul class='sort-param sort-param-order'>";
		$output .= "    	<li><span class='currently-selected'>".__("Sort by",'avia_framework')." <strong>".$product_order[$po_key]."</strong></span>";
		$output .= "    	<ul>";
		$output .= "    	<li".avia_woo_active_class($po_key, 'default')."><a href='".avia_woo_build_query_string($params, 'product_order', 'default')."'>	<span class='avia-bullet'></span>".$product_order['default']."</a></li>";
		$output .= "    	<li".avia_woo_active_class($po_key, 'title')."><a href='".avia_woo_build_query_string($params, 'product_order', 'title')."'>	<span class='avia-bullet'></span>".$product_order['title']."</a></li>";
		$output .= "    	<li".avia_woo_active_class($po_key, 'price')."><a href='".avia_woo_build_query_string($params, 'product_order', 'price')."'>	<span class='avia-bullet'></span>".$product_order['price']."</a></li>";
		$output .= "    	<li".avia_woo_active_class($po_key, 'date')."><a href='".avia_woo_build_query_string($params, 'product_order', 'date')."'>	<span class='avia-bullet'></span>".$product_order['date']."</a></li>";
		$output .= "    	</ul>";
		$output .= "    	</li>";
		$output .= "    </ul>";

		$output .= "    <ul class='sort-param sort-param-sort'>";
		$output .= "    	<li>";
		if($ps_key == 'desc') 	$output .= "    		<a title='".$product_sort['asc']."' class='sort-param-asc'  href='".avia_woo_build_query_string($params, 'product_sort', 'asc')."'>".$product_sort['desc']."</a>";
		if($ps_key == 'asc') 	$output .= "    		<a title='".$product_sort['desc']."' class='sort-param-desc' href='".avia_woo_build_query_string($params, 'product_sort', 'desc')."'>".$product_sort['asc']."</a>";
		$output .= "    	</li>";
		$output .= "    </ul>";

		$output .= "    <ul class='sort-param sort-param-count'>";
		$output .= "    	<li><span class='currently-selected'>".__("Display",'avia_framework')." <strong>".$pc_key." ".$per_page_string."</strong></span>";
		$output .= "    	<ul>";
		$output .= "    	<li".avia_woo_active_class($pc_key, $per_page).">  <a href='".avia_woo_build_query_string($params, 'product_count', $per_page)."'>		<span class='avia-bullet'></span>".$per_page." ".$per_page_string."</a></li>";
		$output .= "    	<li".avia_woo_active_class($pc_key, $per_page*2)."><a href='".avia_woo_build_query_string($params, 'product_count', $per_page * 2)."'>	<span class='avia-bullet'></span>".($per_page * 2)." ".$per_page_string."</a></li>";
		$output .= "    	<li".avia_woo_active_class($pc_key, $per_page*3)."><a href='".avia_woo_build_query_string($params, 'product_count', $per_page * 3)."'>	<span class='avia-bullet'></span>".($per_page * 3)." ".$per_page_string."</a></li>";
		$output .= "    	</ul>";
		$output .= "    	</li>";
		$output .= "	</ul>";



		$output .= "</div>";
		echo $output;
	}
}

//helper function to create the active list class
if(!function_exists('avia_woo_active_class'))
{
	function avia_woo_active_class($key1, $key2)
	{
		if($key1 == $key2) return " class='current-param'";
	}
}


//helper function to build the query strings for the catalog ordering menu
if(!function_exists('avia_woo_build_query_string'))
{
	function avia_woo_build_query_string($params = array(), $overwrite_key, $overwrite_value)
	{
		$params[$overwrite_key] = $overwrite_value;
		$paged = (array_key_exists('product_count', $params)) ? 'paged=1&' : '';
		return "?" . $paged . http_build_query($params);
	}
}

//function that actually overwrites the query parameters
if(!function_exists('avia_woocommerce_overwrite_catalog_ordering'))
{
	add_action( 'woocommerce_get_catalog_ordering_args', 'avia_woocommerce_overwrite_catalog_ordering', 20);

	function avia_woocommerce_overwrite_catalog_ordering($args)
	{

		global $avia_config;

		//check the folllowing get parameters and session vars. if they are set overwrite the defaults
		$check = array('product_order', 'product_count', 'product_sort');
		if(empty($avia_config['woocommerce'])) $avia_config['woocommerce'] = array();
	
		foreach($check as $key)
		{
			if(isset($_GET[$key]) ) $_SESSION['avia_woocommerce'][$key] = esc_attr($_GET[$key]);
			if(isset($_SESSION['avia_woocommerce'][$key]) ) $avia_config['woocommerce'][$key] = $_SESSION['avia_woocommerce'][$key];
		}
		
		
		// is user wants to use new product order remove the old sorting parameter
		if(isset($_GET['product_order']) && !isset($_GET['product_sort']) && isset($_SESSION['avia_woocommerce']['product_sort']))
		{
			unset($_SESSION['avia_woocommerce']['product_sort'], $avia_config['woocommerce']['product_sort']);
		}

		extract($avia_config['woocommerce']);

		// set the product order
		if(!empty($product_order))
		{
			switch ( $product_order ) {
				case 'date'  : $orderby = 'date'; $order = 'desc'; $meta_key = '';  break;
				case 'price' : $orderby = 'meta_value_num'; $order = 'asc'; $meta_key = '_price'; break;
				case 'title' : $orderby = 'title'; $order = 'asc'; $meta_key = ''; break;
				case 'default':
				default : 	   $orderby = 'menu_order title'; $order = 'asc'; $meta_key = ''; break;
			}
		}

		// set the product count
		if(!empty($product_count) && is_numeric($product_count))
		{
			$avia_config['shop_overview_products'] = (int) $product_count;
		}

		//set the product sorting
		if(!empty($product_sort))
		{
			switch ( $product_sort ) {
				case 'desc' : $order = 'desc'; break;
				case 'asc' : $order = 'asc'; break;
				default : $order = 'asc'; break;
			}
		}


		if(isset($orderby)) $args['orderby'] = $orderby;
		if(isset($order)) 	$args['order'] = $order;
		if (!empty($meta_key))
		{
			$args['meta_key'] = $meta_key;
		}
	

		$avia_config['woocommerce']['product_sort'] = $args['order'];
		return $args;
	}


}



