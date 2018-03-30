<?php
if ( is_singular()) {
      
      $layout = get_post_meta(get_queried_object_id(), 'mom_page_layout', TRUE);
      if(function_exists('is_bbpress') && is_bbpress()) {
	if ($layout == '') { $layout = mom_option('bbpress_layout');}
      if(function_exists('is_buddypress') && is_buddypress()) {
	if (get_post_meta(get_queried_object_id(), 'mom_page_layout', true) == '') { $layout = mom_option('buddypress_layout');}
      }  

      } elseif(function_exists('is_buddypress') && is_buddypress()) {
	    if ($layout == '') { $layout = mom_option('buddypress_layout');}
      } else {
	if ($layout == '') { $layout = mom_option('posts_layout');}
	if ($layout == '') { $layout = mom_option('main_layout');}
      }

} elseif (function_exists('is_bbpress') && is_bbpress()) {
	$layout = mom_option('bbpress_layout');
}  elseif (function_exists('is_buddypress') && is_buddypress()) {
	$layout = mom_option('buddypress_layout');
	if ($layout == '') {
	    $layout = mom_option('main_layout');  
	}
	
} else {
      
      $layout = mom_option('main_layout');
      if (is_archive()) {
	    $layout = mom_option('cats_layout');
	    if ($layout == '') {$layout = mom_option('main_layout');}
      }
}
if ($layout == '') { $layout = mom_option('main_layout');}

      if(function_exists('is_woocommerce') && is_woocommerce()) {
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
	$layout = get_post_meta($woo_page_id, 'mom_page_layout', true);
	if ($layout == '') {
	  $layout = mom_option('main_layout'); 
	}

      }  
    
   if (strpos($layout,'both') !== false) {
?>
          <div class="sidebar secondary-sidebar">
            <?php if (is_singular()) {
		if(function_exists('is_bbpress') && is_bbpress()) {
		    $custom_sidebar = mom_option('bbpress_left_sidebar');
    		    if(function_exists('is_buddypress') && is_buddypress()) {
			$custom_sidebar = get_post_meta(get_queried_object_id(), 'mom_left_sidebar', TRUE);
			if ($custom_sidebar == '') {
			      $custom_sidebar = mom_option('buddypress_left_sidebar');
			}
		    }

		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'left-sidebar' );
		    }
		} elseif(function_exists('is_buddypress') && is_buddypress()) {
		   $custom_sidebar = get_post_meta(get_queried_object_id(), 'mom_left_sidebar', TRUE);
		   if ($custom_sidebar == '') {
		    $custom_sidebar = mom_option('buddypress_left_sidebar');
		   }
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'left-sidebar' );
		    }
		} else {
		  $custom_sidebar = get_post_meta(get_queried_object_id(), 'mom_left_sidebar', TRUE);
		    if (is_single()) {
			if ($custom_sidebar == '') {
			    $custom_sidebar = mom_option('post_left_sidebar');
			}
		    }
		  
		  if (!empty($custom_sidebar)) {
		      dynamic_sidebar($custom_sidebar);		    
		  } else {
		      dynamic_sidebar( 'left-sidebar' );
		  }
		}
	    } elseif (is_category()){
		$cat_data = get_option("category_".get_query_var('cat'));
		$custom_sidebar = isset($cat_data['sidebarl']) ? $cat_data['sidebarl'] :'';
		if ($custom_sidebar == '') {
		    $custom_sidebar = mom_option('cat_sidebarl');
		}
		if (!empty($custom_sidebar)) {
		    dynamic_sidebar($custom_sidebar);		    
		} else {
		    dynamic_sidebar( 'left-sidebar' );
		}
	    }  elseif (is_author()){
		    $custom_sidebar = mom_option('author_sidebarl');
		if (!empty($custom_sidebar)) {
		    dynamic_sidebar($custom_sidebar);		    
		} else {
		    dynamic_sidebar( 'left-sidebar' );
		}
	    } elseif(function_exists('is_bbpress') && is_bbpress()) {
		    $custom_sidebar = mom_option('bbpress_left_sidebar');
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'left-sidebar' );
		    }
	    } elseif(function_exists('is_buddypress') && is_buddypress()) {
		    $custom_sidebar = mom_option('buddypress_left_sidebar');
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'left-sidebar' );
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
		  $custom_sidebar = get_post_meta($woo_page_id, 'mom_left_sidebar', TRUE);
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'left-sidebar' );
		    }
	    } else {
		if ( is_active_sidebar( 'left-sidebar' ) ) {
		    dynamic_sidebar( 'left-sidebar' );
		}
	    } ?>

            </div> <!--main sidebar-->
            <div class="clear"></div>
<?php }