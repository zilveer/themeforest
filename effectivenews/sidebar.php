            <div class="sidebar main-sidebar">
            <?php if (is_singular()) {
		if(function_exists('is_bbpress') && is_bbpress()) {
		    $custom_sidebar = mom_option('bbpress_right_sidebar');
    		    if(function_exists('is_buddypress') && is_buddypress()) {
			$custom_sidebar = get_post_meta(get_queried_object_id(), 'mom_right_sidebar', TRUE);
			if ($custom_sidebar == '') {
			      $custom_sidebar = mom_option('buddypress_right_sidebar');
			}
		    }
		    
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'right-sidebar' );
		    }
		} elseif(function_exists('is_buddypress') && is_buddypress()) {
		   $custom_sidebar = get_post_meta(get_queried_object_id(), 'mom_right_sidebar', TRUE);
		   if ($custom_sidebar == '') {
		    $custom_sidebar = mom_option('buddypress_right_sidebar');
		   }
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'right-sidebar' );
		    }
		} else {
		    global $post;
		    $custom_sidebar = get_post_meta(get_queried_object_id(), 'mom_right_sidebar', TRUE);
		    if (is_single()) {
			if ($custom_sidebar == '') {
			    $custom_sidebar = mom_option('post_right_sidebar');
			}
		    }
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'right-sidebar' );
		    }
		}
	    } elseif (is_category()){
		$cat_data = get_option("category_".get_query_var('cat'));
		$custom_sidebar = isset($cat_data['sidebar']) ? $cat_data['sidebar'] :'';
		if ($custom_sidebar == '') {
		    $custom_sidebar = mom_option('cat_sidebar');
		}
		if (!empty($custom_sidebar)) {
		    dynamic_sidebar($custom_sidebar);		    
		} else {
		    dynamic_sidebar( 'right-sidebar' );
		}
	    }  elseif (is_author()){
		    $custom_sidebar = mom_option('author_sidebar');
		if (!empty($custom_sidebar)) {
		    dynamic_sidebar($custom_sidebar);		    
		} else {
		    dynamic_sidebar( 'right-sidebar' );
		}
	    } elseif(function_exists('is_bbpress') && is_bbpress()) {
		    $custom_sidebar = mom_option('bbpress_right_sidebar');
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'right-sidebar' );
		    }
		} elseif(function_exists('is_buddypress') && is_buddypress()) {
		    $custom_sidebar = mom_option('buddypress_right_sidebar');
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'right-sidebar' );
		    }
		} elseif(function_exists('is_woocommerce') && is_woocommerce()) {
		  $woo_page_id = '';
		  if (is_shop()) {
		      $woo_page_id = get_option('woocommerce_shop_page_id');
		  } elseif (is_cart()) {
		      $woo_page_id = get_option('woocommerce_cart_page_id');
		  } elseif (is_checkout()) {
		      $woo_page_id = get_option('woocommerce_checkout_page_id');
		  } elseif (is_account_page()) {
		      $woo_page_id = get_option('woocommerce_myaccount_page_id');
		  } else {
		      $woo_page_id = get_option('woocommerce_shop_page_id');
		  }
		  $custom_sidebar = get_post_meta($woo_page_id, 'mom_right_sidebar', TRUE);
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'right-sidebar' );
		    }
	    } else {
		if ( is_active_sidebar( 'right-sidebar' ) ) {
		    dynamic_sidebar( 'right-sidebar' );
		}
	    } ?>

            </div> <!--main sidebar-->
            <div class="clear"></div>