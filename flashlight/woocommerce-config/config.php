<?php


function avia_woocommerce_enabled()
{
	if ( class_exists( 'woocommerce' ) ){ return true; }
	return false;
}


global $avia_config;

//register my own styles, remove wootheme stylesheet
if(!is_admin()){
	add_action('init', 'avia_woo_frontend_js');
}

function avia_woo_frontend_js()
{
	wp_enqueue_style( 'avia-woocommerce-css', AVIA_BASE_URL.'woocommerce-config/woocommerce-mod.css');
	wp_enqueue_script( 'avia-woocommerce-js', AVIA_BASE_URL.'woocommerce-config/woocommerce-mod.js', array('jquery'), 1, true);
}

global $woocommerce;

if(is_object($woocommerce) && version_compare($woocommerce->version, "2.1", "<"))
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


add_theme_support( 'woocommerce' );

//product thumbnails
$avia_config['imgSize']['shop_thumbnail'] 	= array('width'=>80, 'height'=>80);
$avia_config['imgSize']['shop_catalog'] 	= array('width'=>200, 'height'=>140);
$avia_config['imgSize']['shop_single'] 		= array('width'=>350, 'height'=>350);
avia_backend_add_thumbnail_size($avia_config);

//change the admin options
include('admin-options.php');
include('admin-import.php');


######################################################################
# config
######################################################################

//add avia_framework config defaults

$avia_config['shop_overview_column']  = get_option('avia_woocommerce_column_count');  // columns for the overview page
$avia_config['shop_overview_products']= get_option('avia_woocommerce_product_count'); // products for the overview page


$avia_config['shop_single_column'] 	 = 3;			// columns for related products and upsells
$avia_config['shop_single_column_items'] 	 = 3;	// number of items for related products and upsells
$avia_config['shop_overview_excerpt'] = false;		// display excerpt



//check if the plugin is enabled, otherwise stop the script
if(!avia_woocommerce_enabled()) { return false; }



######################################################################
# Create the correct template html structure
######################################################################

//remove woo defaults
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );

//single page removes
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display');
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

/*update woocommerce v2*/

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); /*remove result count above products*/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); /*remove woocommerce ordering dropdown*/
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); //remove rating
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); //remove woo pagination


//add theme actions && filter
add_action( 'woocommerce_before_main_content', 'avia_woocommerce_before_main_content', 10);
add_action( 'woocommerce_after_main_content', 'avia_woocommerce_after_main_content', 10);
add_action( 'woocommerce_before_shop_loop', 'avia_woocommerce_before_shop_loop', 1);
add_action( 'woocommerce_after_shop_loop', 'avia_woocommerce_after_shop_loop', 10);
add_action( 'woocommerce_before_shop_loop_item', 'avia_woocommerce_thumbnail', 10);
add_action( 'woocommerce_after_shop_loop_item_title', 'avia_woocommerce_overview_excerpt', 10);
add_filter( 'loop_shop_columns', 'avia_woocommerce_loop_columns');
add_filter( 'loop_shop_per_page', 'avia_woocommerce_product_count' );

//single page adds

add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 50);
add_action( 'woocommerce_single_product_summary', 'avia_woocommerce_output_related_products', 60);
add_action( 'woocommerce_single_product_summary', 'avia_woocommerce_output_upsells', 70);
add_action( 'woocommerce_before_single_product_summary', 'avia_woocommerceproduct_prev_image_before', 1 );
add_action( 'woocommerce_single_product_summary', 'avia_image_append', 39 );
add_action( 'woocommerce_product_thumbnails', 'avia_woocommerceproduct_prev_image_after', 1000 );
add_filter( 'single_product_small_thumbnail_size', 'avia_woocommerce_thumb_size');
add_filter( 'avia_sidebar_menu_filter', 'avia_woocommerce_sidebar_filter');

######################################################################
# FUNCTIONS
######################################################################

add_action('wp_head','modify_layout', 20);

function modify_layout()
{
	global $avia_config;
	if(is_cart() || is_checkout() || is_account_page())
	{
		$avia_config['block_gallery'] = true;
		$avia_config['layout'] = "three_columns big_title";
		add_action( 'avia_page_title', 'avia_display_shop_menu' );
	}

	if(is_shop() || is_product_category() || is_product_tag())
	{
		$avia_config['real_ID'] = get_option('woocommerce_shop_page_id');
	}

}





#
# create the shop navigation with account links, as well as cart and checkout
#


function avia_shop_nav()
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
			$output .= "<li class='account_logout_link'><a href='".$url['logout']."'>".__('Log Out', 'avia_framework')."</a></li>";
			$output .= "</ul>";
		$output .= "</li>";
		
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
	
	$output .= "<li class='shopping_cart_link'><a href='".$url['cart']."'>".__('Shopping Cart', 'avia_framework')."</a></li>";
	$output .= "<li class='checkout_link'><a href='".$url['checkout']."'>".__('Checkout', 'avia_framework')."</a></li>";
	$output .= "</ul>";
	echo $output;
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
# check which page is displayed and if the sidebar menu should be prevented
#
function avia_woocommerce_sidebar_filter($menu)
{
	$id = avia_get_the_ID();
	if(is_cart() || is_checkout() || get_option('woocommerce_thanks_page_id') == $id){$menu = "";}
	return $menu;
}

#
# single page thumbnail and preview image modifications
#
function avia_woocommerceproduct_prev_image_before()
{
	global $avia_config;

			$image = "";
 			$titleClass = "";
 			if(is_single()) $titleClass = $avia_config['layout']." big_title";



		?>

		<h1 class='post-title <?php echo $titleClass; ?>'>
			<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','avia_framework')?> <?php the_title(); ?>"><?php the_title(); ?></a>
		</h1>

		<?php


		if(!post_password_required())
		{
			//embeded thumb gallery
			if(is_single() && strpos($avia_config['layout'],'thumb') !== false )
			{
					echo "<div class='hr_invisible '></div>";
					new avia_embed_images();
			}
			else if(! is_single())
			{
				$image = get_the_post_thumbnail( get_the_ID(), 'portfolio' );
                if(empty($image))
                {
                    $attachments = avia_post_meta(get_the_ID(), 'slideshow');
                    if(!empty($attachments))
                    {
                        $thumbid = $attachments[0][slideshow_image];
                        $image =  wp_get_attachment_image( $thumbid, 'portfolio' );
                    }
                }

	 	 		if($image)
	 	 		{
	 	 			$image = "<a class='preview_image external-link' href='".get_permalink()."' rel='bookmark' title='".__('Permanent Link:','avia_framework')." ".get_the_title()."'>".$image."</a>";
	 	 			echo $image;
	 	 		}
			}

			//embeded 3 column gallery
			if(is_single() && strpos($avia_config['layout'],'three_column') !== false )
			{
				new avia_three_column();
			}

			//embeded list gallery
			if(is_single() && strpos($avia_config['layout'],'attached_images') !== false )
			{
				new avia_embed_images();
			}

			//embeded list gallery
			if(is_single() && strpos($avia_config['layout'],'gallery_shortcode') !== false )
			{
				global $gallery_active;
                if(strpos($avia_config['layout'],'gallery_shortcode') !== false )
                {
                    global $gallery_active;

                    if(!$gallery_active)
                    {
                        $ids = array();
                        /* get slideshow images */
                        $attachments = avia_post_meta(get_the_ID(), 'slideshow');
                        if(!empty($attachments))
                        {
                            foreach($attachments as $attachment)
                            {
                                $ids[] = $attachment['slideshow_image'];
                            }
                        }

                        /* check for images in the wordpress gallery */
                        $args = array(
                            'post_type' => 'attachment',
                            'numberposts' => -1,
                            'post_status' =>'any',
                            'post_parent' => get_the_ID(),
                            'exclude' => $ids
                        );
                        $attachments = get_posts($args);
                        if ($attachments) {
                            foreach ( $attachments as $attachment ) {
                                $ids[] = $attachment->ID;
                            }
                        }

                        if(!empty($ids))
                        {
                            $ids = 'ids="' . implode(',', $ids) . '"';
                        }
                        else
                        {
                            $ids = '';
                        }
                        echo do_shortcode("[gallery $ids]");
                    }
                }
			}

			//embeded list gallery
			if(is_single() && strpos($avia_config['layout'],'masonry') !== false )
			{
				get_template_part( 'includes/loop', 'masonry' );
			}
		}

}

function avia_image_append()
{

}


function avia_woocommerceproduct_prev_image_after()
{
	global $avia_config;
	$avia_config['currently_viewing'] = "shop_single";
	$avia_config['layout'] = 'sidebar_left';

	//echo "</div>"; //end content
	wp_reset_query();
	get_sidebar();
}

function avia_woocommerce_thumb_size()
{
	return 'shop_single';
}


#
# creates the avia framework container arround the shop pages
#
function avia_woocommerce_before_main_content()
{
	global $avia_config;

	if(!isset($avia_config['layout'])) $avia_config['layout'] = "";
	if(!isset($avia_config['shop_overview_column'])) $avia_config['shop_overview_column'] = "auto";
	if(is_shop() && $new = avia_post_meta( get_option('woocommerce_shop_page_id'), 'page_layout')) $avia_config['layout'] = $new;
	$size = 3;
	if(is_singular() && is_product()) $size = 2;

	echo "<div id='main' class='container_wrap shop_columns_".$avia_config['shop_overview_column']."'>";
		if(is_singular() && is_product())
		{
			echo "<div class='container bit_title ".$avia_config['layout']."'>";
			echo '<div class="template-shop-single content portfolio-size-'.$size.'">';
		}
		else
		{
			echo "<div class='ajaxContainer container template-shop portfolio-size-$size'>";
			echo '<div class="template-portfolio-overview content portfolio-size-'.$size.'">';
		}


		echo "<div class='box'><div class='inner_box'>";
		avia_display_shop_menu();
		if(!is_singular())
		{
			$avia_config['overview'] = true;
			avia_woocommerce_advanced_title();
		}
}

#
# creates the title + description for overview pages
#
function avia_woocommerce_advanced_title()
{
	echo '<div class="post-title big_title bg_gallery cufon_headings">';

}



#
# creates the avia framework content container arround the shop loop
#
function avia_woocommerce_before_shop_loop()
{

			global $avia_config;

			if(isset($avia_config['dynamic_template'])) return;

			ob_start();
			if (!empty($avia_config['overview'])) { echo "</div>";} // end title_container


			echo "<div class='template-shop content'>";
			$content = ob_get_clean();
			echo $content;
			ob_start();
}

#
# closes the avia framework content container arround the shop loop
#
function avia_woocommerce_after_shop_loop()
{
			global $avia_config;
			if(isset($avia_config['dynamic_template'])) return;
			if(isset($avia_config['overview'] )) echo avia_pagination();
			echo "</div>"; //end content


}





#
# closes the avia framework container arround the shop pages
#
function avia_woocommerce_after_main_content()
{
	global $avia_config;
	$avia_config['currently_viewing'] = "shop";

			//reset all previous queries
			wp_reset_query();

		echo "</div></div></div>"; // end box + innerbox

	if(is_single())
	{
		$avia_config['currently_viewing'] = "shop_single";
	}

	//get the sidebar
	get_sidebar();


	echo "</div>"; // end container
	echo "</div>"; // end tempate-shop content
}




#
# creates the post image for each post
#
function avia_woocommerce_thumbnail()
{
	//circumvent the missing post and product parameter in the loop_shop template
	global $post;
	$product = get_product( $post->ID );
	//$rating = $product->get_rating_html(); //rating is removed for now since the current implementation requires wordpress to do 2 queries for each post which is not that cool on overview pages
	ob_start();
	if($product->product_type != 'external')
	{
		woocommerce_template_loop_add_to_cart($post, $product);
	}
	$link = ob_get_clean();
	$extraClass  = empty($link) ? "single_button" :  "" ;

	echo "<div class='thumbnail_container'>";
	echo "<div class='thumbnail_container_inner'>";
		$image = get_the_post_thumbnail( get_the_ID(), 'shop_catalog' );
        if(empty($image))
        {
            $attachments = avia_post_meta(get_the_ID(), 'slideshow');
            if(!empty($attachments))
            {
                $thumbid = $attachments[0][slideshow_image];
                $image =  wp_get_attachment_image( $thumbid, 'shop_catalog' );
            }
        }
        echo $image;
		echo $link;
		echo "<a class='button show_details_button $extraClass' href='".get_permalink($post->ID)."'>".__('Show Details','avia_framework')."</a>";
		if(!empty($rating)) echo "<span class='rating_container'>".$rating."</span>";

		echo "</div>";
	echo "</div>";
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
# shopping cart dropdown in the main menu
#

function avia_woocommerce_cart_dropdown()
{
	global $woocommerce;
	$cart_subtotal = $woocommerce->cart->get_cart_subtotal();
	$link = $woocommerce->cart->get_cart_url();

	ob_start();
    the_widget('WC_Widget_Cart', '', array('widget_id'=>'cart-dropdown',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<span class="hidden">',
        'after_title' => '</span>'
    ));
    $widget = ob_get_clean();

	$output = "";
	$output .= "<ul class = 'cart_dropdown' data-success='".__('Product added', 'avia_framework')."'><li class='cart_dropdown_first'>";
	$output .= "<a class='cart_dropdown_link' href='".$link."'>".__('Cart', 'avia_framework')."</a><span class='cart_subtotal'>".$cart_subtotal."</span>";
	$output .= "<div class='dropdown_widget dropdown_widget_cart'>";
	$output .= $widget;
	$output .= "</div>";
	$output .= "</li></ul>";

	return $output;
}

function avia_display_shop_menu()
{
	echo "<div class='sub_menu'>";
	$args = array('theme_location'=>'avia2', 'fallback_cb' => '');
	if(avia_woocommerce_enabled()) $args['fallback_cb'] ='avia_shop_nav';
	wp_nav_menu($args);
	echo "</div>";
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
# display upsells and related products
#
function avia_woocommerce_output_related_products()
{
	global $avia_config;

	echo "<div class='product_column product_column_".$avia_config['shop_single_column']."'>";
	woocommerce_related_products(array('posts_per_page'=>$avia_config['shop_single_column_items'], 'columns'=>$avia_config['shop_single_column'])); // X products, X columns
	echo "</div>";
}

function avia_woocommerce_output_upsells()
{
	global $avia_config;

	echo "<div class='product_column product_column_".$avia_config['shop_single_column']."'>";
	woocommerce_upsell_display($avia_config['shop_single_column_items'],$avia_config['shop_single_column']); // 4 products, 4 columns
	echo "</div>";
}


//Fix for search results page with no entries
add_action( 'woocommerce_after_main_content', 'avia_woocommerce_404_search_close', 1);
function avia_woocommerce_404_search_close()
{
    global $wp_query;
    if( is_search() && empty($wp_query->found_posts) ){ echo "</div>";}
}
