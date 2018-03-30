<?php

######################################################################
# remove backend options by removing them from the config array
######################################################################
add_filter('woocommerce_general_settings','avia_woocommerce_general_settings_filter');
add_filter('woocommerce_page_settings','avia_woocommerce_general_settings_filter');
add_filter('woocommerce_catalog_settings','avia_woocommerce_general_settings_filter');
add_filter('woocommerce_inventory_settings','avia_woocommerce_general_settings_filter');
add_filter('woocommerce_shipping_settings','avia_woocommerce_general_settings_filter');
add_filter('woocommerce_tax_settings','avia_woocommerce_general_settings_filter');
add_filter('woocommerce_product_settings','avia_woocommerce_general_settings_filter');

function avia_woocommerce_general_settings_filter($options)
{  
	$remove   = array('woocommerce_enable_lightbox', 'woocommerce_frontend_css');
	//$remove = array('image_options', 'woocommerce_enable_lightbox', 'woocommerce_catalog_image', 'woocommerce_single_image', 'woocommerce_thumbnail_image', 'woocommerce_frontend_css');

	foreach ($options as $key => $option)
	{
		if( isset($option['id']) && in_array($option['id'], $remove) ) 
		{  
			unset($options[$key]); 
		}
	}

	return $options;
}



//on theme activation set default image size, disable woo lightbox and woo stylesheet. options are already hidden by previous filter function
function avia_woocommerce_set_defaults()
{
	global $avia_config;

	update_option('shop_catalog_image_size', $avia_config['imgSize']['shop_catalog']);
	update_option('shop_single_image_size', $avia_config['imgSize']['shop_single']);
	update_option('shop_thumbnail_image_size', $avia_config['imgSize']['shop_thumbnail']);

	//set custom
	
	update_option('avia_woocommerce_column_count', 3);
	update_option('avia_woocommerce_product_count', 24);
	
	//set blank
	$set_false = array('woocommerce_enable_lightbox', 'woocommerce_frontend_css');
	foreach ($set_false as $option) { update_option($option, false); }
	
	//set blank
	$set_no = array('woocommerce_single_image_crop');
	foreach ($set_no as $option) { update_option($option, 'no'); }

}

add_action( 'avia_backend_theme_activation', 'avia_woocommerce_set_defaults', 10);




//add new options to the catalog settings
add_filter('woocommerce_catalog_settings','avia_woocommerce_page_settings_filter');
add_filter('woocommerce_product_settings','avia_woocommerce_page_settings_filter');

function avia_woocommerce_page_settings_filter($options)
{  

	$options[] = array(
		'name' => 'Column and Product Count',
        'type' => 'title',
        'desc' => 'The following settings allow you to choose how many columns and items should appear on your default blog overview page and your product archive pages.<br/><small>Notice: These options are added by the <strong>'.THEMENAME.' Theme</strong> and wont appear on other themes</small>',
        'id'   => 'column_options'
	);
	
	$options[] = array(
			'name' => 'Column Count',
            'desc' => 'This controls how many columns should appear on overview pages.',
            'id' => 'avia_woocommerce_column_count',
            'css' => 'min-width:175px;',
            'std' => '3',
            'type' => 'select',
            'options' => array
                (
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'
                )
	);
	
	$itemcount = array('-1'=>'All');
	for($i = 3; $i<101; $i++) $itemcount[$i] = $i;	
	
		$options[] = array(
			'name' => 'Product Count',
            'desc' => 'This controls how many products should appear on overview pages.',
            'id' => 'avia_woocommerce_product_count',
            'css' => 'min-width:175px;',
            'std' => '24',
            'type' => 'select',
            'options' => $itemcount
	);
	
	$options[] = array(
        
            'type' => 'sectionend',
            'id' => 'column_options'
        );
	
	
	return $options;
}













