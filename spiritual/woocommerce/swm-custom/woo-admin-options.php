<?php 

// Create custom ptions in woocommerce general settings page

add_filter('woocommerce_general_settings','swm_woocommerce_page_settings_filter');

if (!function_exists('swm_woocommerce_page_settings_filter')) {

    function swm_woocommerce_page_settings_filter($options) { 

    	$swm_shortname = 'swm_';
    	for($i = 1; $i<101; $i++) { $swm_one_to_hundred_count[$i] = $i; }	

        $swm_two_to_five =  array (
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'
                );

        $swm_woo_shop_layout =  array(
            "layout-full-width" => __( 'Full Width', 'swmtranslate' ),
            "layout-sidebar-right" => __( 'Sidebar Right', 'swmtranslate' ),
            "layout-sidebar-left" => __( 'Sidebar Left', 'swmtranslate' )            
        );

    	$options[] = array(
    		'name' => __('Shop Featured Products Page Options', 'swmtranslate'),
            'type' => 'title',      
            'id'   => $swm_shortname.'woo_shop_page_options'
    	);

    	
        $options[] = array(
            'name' => __('Shop Layout', 'swmtranslate'),
            'desc' => '',
            'id' => $swm_shortname.'woo_shop_page_layout',
            'css' => 'min-width:175px;',
            'std' => 'full_width',
            'desc_tip' => __('Select layout for Shop page', 'swmtranslate'),
            'type' => 'select',
            'options' => $swm_woo_shop_layout           
        );

        $options[] = array(
    		'name' => __('How Many Products Per Page?', 'swmtranslate'),            
            'id' => $swm_shortname.'show_product_per_page',            
            'desc_tip' => __('Enter number of products to display per page', 'swmtranslate'),
            'std' => '12',
            'css' => 'width:50px;',
            'type' => 'text'            
    	);

        $options[] = array(
            'name' => __('Products Column', 'swmtranslate'),
            'desc' => '',
            'id' => $swm_shortname.'woo_shop_p_column',
            'css' => 'min-width:175px;',
            'std' => '4',
            'desc_tip' => __('Select column number to display products in shop page', 'swmtranslate'),
            'type' => 'select',
            'options' => $swm_two_to_five
        );

    	$options[] = array(    
            'type' => 'sectionend',
            'id' => 'shop_page_options'
        );

    	$options[] = array(
    		'name' => __('Product Single (Overview) Page Options', 'swmtranslate'),
            'type' => 'title',      
            'id'   => $swm_shortname.'woo_single_page_options'
    	);

        $options[] = array(
            'name' => __('Product Overview Layout', 'swmtranslate'),
            'desc' => '',
            'id' => $swm_shortname.'woo_product_page_layout',
            'css' => 'min-width:175px;',
            'std' => 'full_width',
            'desc_tip' => __('Select layout for product single page', 'swmtranslate'),
            'type' => 'select',
            'options' => $swm_woo_shop_layout           
        );	

        $options[] = array(
    			'name' => __('Display Next Previous links', 'swmtranslate'),
                'desc' => "",
                'id' => $swm_shortname.'woo_next_prev_links_options',            
                'desc' => __('Enable next previous arrows on right side beside product title', 'swmtranslate'),
                'std' => '1',
                'type' => 'checkbox'            
    	);

        $options[] = array(
                'name' => __('Gallery Images Column', 'swmtranslate'),
                'desc' => '',
                'id' => $swm_shortname.'woo_single_page_gallery_thumbnails',
                'css' => 'min-width:175px;',
                'std' => '5',
                'desc_tip' => __('Select column number to display thumanail images below large image', 'swmtranslate'),
                'type' => 'select',
                'options' => array(
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6'
                    )
        );

    	$options[] = array(
    			'name' => __('Related Products Column', 'swmtranslate'),
                'desc' => '',
                'id' => $swm_shortname.'woo_related_p_column',
                'css' => 'min-width:175px;',
                'std' => '4',
                'desc_tip' => __('Select column number to display Related products', 'swmtranslate'),
                'type' => 'select',
                'options' => $swm_two_to_five
    	);
    	
    	$options[] = array(
    			'name' => __('How Many Related Items?', 'swmtranslate'),
                'desc' => "",
                'id' => $swm_shortname.'woo_related_p_nos',
                'css' => 'min-width:175px;',
                'desc_tip' => __('How many related products you want to display in the page, below product description section?', 'swmtranslate'),
                'std' => '4',
                'type' => 'select',
                'options' => $swm_one_to_hundred_count
    	);

        $options[] = array(
                'name' => __('Up-Sells Products Column', 'swmtranslate'),
                'desc' => '',
                'id' => $swm_shortname.'woo_upsells_p_column',
                'css' => 'min-width:175px;',
                'std' => '4',
                'desc_tip' => __('Select column number to display Up-Sells products', 'swmtranslate'),
                'type' => 'select',
                'options' => $swm_two_to_five
        );
        
        $options[] = array(
                'name' => __('How Many Up-Sells Items?', 'swmtranslate'),
                'desc' => "",
                'id' => $swm_shortname.'woo_upsells_p_nos',
                'css' => 'min-width:175px;',
                'desc_tip' => __('How many Up-Sells products you want to display in the page, below product description section?', 'swmtranslate'),
                'std' => '4',
                'type' => 'select',
                'options' => $swm_one_to_hundred_count
        );
    	
    	$options[] = array(
            
                'type' => 'sectionend',
                'id' => 'column_options'
        );

        $options[] = array(
            'name' => __('Cart Page Options', 'swmtranslate'),
            'type' => 'title',      
            'id'   => $swm_shortname.'woo_cart_page_options'
        );

        $options[] = array(
                'name' => __('Cross-Sells Products Column', 'swmtranslate'),
                'desc' => '',
                'id' => $swm_shortname.'woo_cross_sells_p_column',
                'css' => 'min-width:175px;',
                'std' => '4',
                'desc_tip' => __('Select column number to display Cross-Sells products', 'swmtranslate'),
                'type' => 'select',
                'options' => $swm_two_to_five
        );
        
        $options[] = array(
                'name' => __('How Many Cross-Sells Items?', 'swmtranslate'),
                'desc' => "",
                'id' => $swm_shortname.'woo_cross_sells_p_nos',
                'css' => 'min-width:175px;',
                'desc_tip' => __('How many Cross-Sells products you want to display in the cart page, below Calculate Shipping and Order Total tables?', 'swmtranslate'),
                'std' => '4',
                'type' => 'select',
                'options' => $swm_one_to_hundred_count
        );

        $options[] = array(
            
                'type' => 'sectionend',
                'id' => 'column_options'
        );

        $options[] = array(
            'name' => __('Sale Badge Options', 'swmtranslate'),
            'type' => 'title',      
            'id'   => $swm_shortname.'woo_cart_page_options'
        );


        $options[] = array(
            'name' => __('Sale Badge Background Color', 'swmtranslate'),            
            'id' => $swm_shortname.'onsale_badge_background',            
            'desc_tip' => __('Select "sale" badge background color', 'swmtranslate'),
            'std' => '#b93a41',
            'css' => 'width:50px;',
            'type' => 'color'            
        );

        $options[] = array(
            'name' => __('Sale Badge Font Color', 'swmtranslate'),            
            'id' => $swm_shortname.'onsale_badge_font_color',            
            'desc_tip' => __('Select "sale" badge font color', 'swmtranslate'),
            'std' => '#ffffff',
            'css' => 'width:50px;',
            'type' => 'color'            
        );



        $options[] = array(
            
                'type' => 'sectionend',
                'id' => 'column_options'
        );
    	
    	
    	return $options;
    }

}
