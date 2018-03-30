<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');


if(!function_exists('et_page_config')) {
	function et_page_config() {
		$layout = array(
			'sidebar' => 'left',
			'sidebar-size' => 3,
			'content-size' => 9,
			'heading' => true,
			'slider' => false,
			'sidebar-name' => '',
			'breadcrumb' => 'default',
			'widgetarea' => ''
		);

		$page_id = et_get_page_id();

		// Get settings from Theme Options
		$layout['sidebar'] = etheme_get_option('blog_sidebar');
		$layout['breadcrumb'] = etheme_get_option('breadcrumb_type');

		if(class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag() || et_is_product_brand())) {
			$layout['sidebar'] = etheme_get_option('grid_sidebar');

			if(etheme_get_option('prodcuts_per_row') == 6 || etheme_get_option('shop_full_width')) {
				$layout['sidebar'] = 'without';
			}
		}


			// Get specific custom options from meta boxes for this $page_id

	        $page_breadcrumb = etheme_get_custom_field('breadcrumb_type', $page_id);
	        $page_sidebar = etheme_get_custom_field('sidebar_state', $page_id);
	        $sidebar_width = etheme_get_custom_field('sidebar_width', $page_id);
	        $widgetarea = etheme_get_custom_field('widget_area', $page_id);
	        $slider = etheme_get_custom_field('page_slider', $page_id);
	        $heading = etheme_get_custom_field('page_heading', $page_id);

			if(!empty($page_sidebar) && $page_sidebar != 'default') {
				$layout['sidebar'] = $page_sidebar;
			}
			
			if(!empty($sidebar_width) && $sidebar_width != 'default') {
				$layout['sidebar-size'] = $sidebar_width;
			}
			
			if(!empty($page_breadcrumb) && $page_breadcrumb != 'default') {
				$layout['breadcrumb'] = $page_breadcrumb;
			}
			
			if(!empty($widgetarea) && $widgetarea != 'default') {
				$layout['widgetarea'] = $widgetarea;
			}
			
			if(!empty($slider) && $slider != 'no_slider') {
				$layout['slider'] = $slider;
			}
			
			if(!empty($heading) && $heading != 'enable') {
				$layout['heading'] = $heading;
			}

			// Thats all about custom options for the particular page

		

		if(class_exists('WooCommerce') && is_singular( "product" ) ) {
			$layout['sidebar'] = etheme_get_option('single_sidebar');
		}

		
		if(!$layout['sidebar'] || $layout['sidebar'] == 'without' || $layout['sidebar'] == 'no_sidebar') {
			$layout['sidebar-size'] = 0;
		}

		if($layout['sidebar-size'] == 0) {
			$layout['sidebar'] == 'without';
		}


		$layout['content-size'] = 12 - $layout['sidebar-size'];

		$layout['sidebar-class'] = 'col-md-' . $layout['sidebar-size'];
		$layout['content-class'] = 'col-md-' . $layout['content-size'];

		if($layout['sidebar'] == 'left') {
			$layout['sidebar-class'] .= ' col-md-pull-' . $layout['content-size'];
			$layout['content-class'] .= ' col-md-push-' . $layout['sidebar-size'];
		}

		return apply_filters( 'et_page_config', $layout );
	}
}

if(!function_exists('et_get_page_id')) {
	function et_get_page_id() {
		global $post;

		$id = 0;

		if(isset($post->ID) && is_singular('page')) { 
			$id = $post->ID;
		} else if( is_home() ) {
			$id = get_option( 'page_for_posts' );
		} else if( get_post_type() == 'etheme_portfolio' || is_singular( 'etheme_portfolio' ) ) {
			$id = etheme_tpl2id( 'portfolio.php' );
		}

		if(class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag() || is_singular( "product" ) || et_is_product_brand())) {
			$id = get_option('woocommerce_shop_page_id');
		}

		return $id;
	}
}
// **********************************************************************// 
// ! Register Sidebars
// **********************************************************************// 

if(function_exists('register_sidebar')) {

	if(!function_exists('et_fw_sidebars')) {
	
		add_action('after_setup_theme', 'et_fw_sidebars');
		
		function et_fw_sidebars(){
		    register_sidebar(array(
		        'name' => __('Main Sidebar', ET_DOMAIN),
		        'id' => 'main-sidebar',
		        'description' => __('The main sidebar area', ET_DOMAIN),
		        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		        'after_widget' => '</div><!-- //sidebar-widget -->',
		        'before_title' => '<h4 class="widget-title"><span>',
		        'after_title' => '</span></h4>',
		    ));
			
		    register_sidebar(array(
		        'name' => __('Left side top bar area', ET_DOMAIN),
		        'id' => 'languages-sidebar',
		        'description' => __('Can be used for placing languages switcher of some contacts information.', ET_DOMAIN),
		        'before_widget' => '<div id="%1$s" class="topbar-widget %2$s">',
		        'after_widget' => '</div><!-- //topbar-widget -->',
		        'before_title' => '<h4 class="widget-title"><span>',
		        'after_title' => '</span></h4>',
		    ));
		    
		    register_sidebar(array(
		        'name' => __('Right side top bar area', ET_DOMAIN),
		        'id' => 'top-bar-right',
		        'before_widget' => '<div id="%1$s" class="topbar-widget %2$s">',
		        'after_widget' => '</div><!-- //topbar-widget -->',
		        'before_title' => '<h4 class="widget-title"><span>',
		        'after_title' => '</span></h4>',
		    ));
		    
		    if(class_exists('WooCommerce')) {
			    register_sidebar(array(
			        'name' => __('Shop Sidebar', ET_DOMAIN),
			        'id' => 'shop-sidebar',
			        'description' => __('Shop page widget area', ET_DOMAIN),
			        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			        'after_widget' => '</div><!-- //sidebar-widget -->',
			        'before_title' => '<h4 class="widget-title"><span>',
			        'after_title' => '</span></h4>',
			    ));
			    register_sidebar(array(
			        'name' => __('Single product page Sidebar', ET_DOMAIN),
			        'id' => 'single-sidebar',
			        'description' => __('Single product page widget area', ET_DOMAIN),
			        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			        'after_widget' => '</div><!-- //sidebar-widget -->',
			        'before_title' => '<h4 class="widget-title"><span>',
			        'after_title' => '</span></h4>',
			    ));

			    register_sidebar(array(
			        'name' => __('Above the products', ET_DOMAIN),
			        'id' => 'shop-filters-sidebar',
			        'description' => __('Widget area that appears above the products on Shop page', ET_DOMAIN),
			        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			        'after_widget' => '</div><!-- //sidebar-widget -->',
			        'before_title' => '<h4 class="widget-title"><span>',
			        'after_title' => '</span></h4>',
			    ));
		    }


		    
		    register_sidebar(array(
		        'name' => __('Pre Footer Area', ET_DOMAIN),
		        'id' => 'prefooter',
		        'description' => __('The prefooter footer area', ET_DOMAIN),
		        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		        'after_widget' => '</div><!-- //sidebar-widget -->',
		        'before_title' => '<h4 class="widget-title"><span>',
		        'after_title' => '</span></h4>',
		    ));
		    
		    register_sidebar(array(
		        'name' => __('Footer Area', ET_DOMAIN),
		        'id' => 'footer10',
		        'description' => __('The main footer area', ET_DOMAIN),
		        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		        'after_widget' => '</div><!-- //sidebar-widget -->',
		        'before_title' => '<h4 class="widget-title"><span>',
		        'after_title' => '</span></h4>',
		    ));
		}
	}

}


/**
*   Function for adding sidebar (AJAX action) 
*/

if(!function_exists('etheme_add_sidebar')) {
	function etheme_add_sidebar(){
	    if (!wp_verify_nonce($_GET['_wpnonce_etheme_widgets'],'etheme-add-sidebar-widgets') ) die( 'Security check' );
	    if($_GET['etheme_sidebar_name'] == '') die('Empty Name');
	    $option_name = 'etheme_custom_sidebars';
	    if(!get_option($option_name) || get_option($option_name) == '') delete_option($option_name); 
	    
	    $new_sidebar = $_GET['etheme_sidebar_name'];    
	    
	    
	    if(get_option($option_name)) {
	        $et_custom_sidebars = etheme_get_stored_sidebar();
	        $et_custom_sidebars[] = trim($new_sidebar);
	        $result = update_option($option_name, $et_custom_sidebars);
	    }else{
	        $et_custom_sidebars[] = $new_sidebar;
	        $result2 = add_option($option_name, $et_custom_sidebars);
	    }
	    
	    
	    if($result) die('Updated');
	    elseif($result2) die('added');
	    else die('error');
	}
}


/**
*   Function for deleting sidebar (AJAX action) 
*/

if(!function_exists('etheme_delete_sidebar')) {
	function etheme_delete_sidebar(){
	    $option_name = 'etheme_custom_sidebars';
	    $del_sidebar = trim($_GET['etheme_sidebar_name']);
	        
	    if(get_option($option_name)) {
	        $et_custom_sidebars = etheme_get_stored_sidebar();
	        
	        foreach($et_custom_sidebars as $key => $value){
	            if($value == $del_sidebar)
	                unset($et_custom_sidebars[$key]);
	        }
	        
	        
	        $result = update_option($option_name, $et_custom_sidebars);
	    }
	    
	    if($result) die('Deleted');
	    else die('error');
	}
}

/**
*   Function for registering previously stored sidebars
*/

if(!function_exists('etheme_register_stored_sidebar')) {
	function etheme_register_stored_sidebar(){
	    $et_custom_sidebars = etheme_get_stored_sidebar();
	    if(is_array($et_custom_sidebars)) {
	        foreach($et_custom_sidebars as $name){
	            register_sidebar( array(
	                'name' => ''.$name.'',
	                'id' => $name,
	                'class' => 'etheme_custom_sidebar',
	                'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	                'after_widget' => '</div>',
	                'before_title' => '<h3 class="widget-title"><span>',
	                'after_title' => '</span></h3>',
	            ) );
	        }
	    }
	}
}

/**
*   Function gets stored sidebar array
*/

if(!function_exists('etheme_get_stored_sidebar')) {
	function etheme_get_stored_sidebar(){
	    $option_name = 'etheme_custom_sidebars';
	    return get_option($option_name);
	}
}


/**
*   Add form after all widgets
*/

if(!function_exists('etheme_sidebar_form')) {
	function etheme_sidebar_form(){
	    ?>
	    
	    <form action="<?php echo admin_url( 'widgets.php' ); ?>" method="post" id="etheme_add_sidebar_form">
	        <h2>Custom Sidebar</h2>
	        <?php wp_nonce_field( 'etheme-add-sidebar-widgets', '_wpnonce_etheme_widgets', false ); ?>
	        <input type="text" name="etheme_sidebar_name" id="etheme_sidebar_name" />
	        <button type="submit" class="button-primary" value="add-sidebar">Add Sidebar</button>
	    </form>
	    <script type="text/javascript">
	        var sidebarForm = jQuery('#etheme_add_sidebar_form');
	        var sidebarFormNew = sidebarForm.clone();
	        sidebarForm.remove();
	        jQuery('#widgets-right').append('<div style="clear:both;"></div>');
	        jQuery('#widgets-right').append(sidebarFormNew);
	        
	        sidebarFormNew.submit(function(e){
	            e.preventDefault();
	            var data =  {
	                'action':'etheme_add_sidebar',
	                '_wpnonce_etheme_widgets': jQuery('#_wpnonce_etheme_widgets').val(),
	                'etheme_sidebar_name': jQuery('#etheme_sidebar_name').val(),
	            };
	            //console.log(data);
	            jQuery.ajax({
	                url: ajaxurl,
	                data: data,
	                success: function(response){
	                    console.log(response);
	                    window.location.reload(true);
	                    
	                },
	                error: function(data) {
	                    console.log('error');
	                    
	                }
	            });
	        });
	        
	    </script>
	    <?php
	}
}
add_action( 'sidebar_admin_page', 'etheme_sidebar_form', 30 );
add_action('wp_ajax_etheme_add_sidebar', 'etheme_add_sidebar');
add_action('wp_ajax_etheme_delete_sidebar', 'etheme_delete_sidebar');
add_action( 'widgets_init', 'etheme_register_stored_sidebar' );