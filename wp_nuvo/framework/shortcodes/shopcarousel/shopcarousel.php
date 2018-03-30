<?php
add_shortcode('cs-shop-carousel', 'cs_shop_carousel_render');

function cs_shop_carousel_render($atts) {
        extract(shortcode_atts(array(
        'title' => '',
        'heading_size'=>'',
        'heading_style'=>'',
        'title_align'=>'',
        'title_color'=>'',
        'subtitle'=>'',
        'subtitle_heading_size'=>'',
        'description' => '',
        'style' => 'layout-1',
        'category' => '',
        'width_item' => 150,
        'margin_item' => 20,
        'speed' => 500,
        'rows' => 1,
        'auto_scroll' => '1',
        'show_nav' => '1',
        'show_pager' => '1',
        'show_title' => '1',
        'item_title_color'=>'',
        'item_heading_size'=>'',
        'show_image'=>'1',
        'crop_image'=>'',
        'width_image'=>'',
        'height_image'=>'',
        'image_border'=>'',
        'show_category' => '1',
        'show_price' => '1',
        'show_add_to_cart' => '1',
        'posts_per_page' => -1,
        'morelink' => '',
        'moretext' => '',
        'orderby' => 'none',
        'order' => 'none'
                ), $atts));
        
        $args = array(
        		'posts_per_page' => $posts_per_page,
        		'orderby' => $orderby,
        		'order' => $order,
        		'post_type' => 'product',
        		'post_status' => 'publish'
        );
        
        if (isset($category) && $category != '') {
        
        	$cats = explode(',', $category);
        
        	$args['tax_query'] = array(
        			array(
        					'taxonomy' => 'product_cat',
        					'field' => 'term_id',
        					'terms' => $cats
        			)
        	);
        }

        $products = new WP_Query($args);

        ob_start();
        $date = time() . '_' . uniqid(true);

        wp_register_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', 'jquery', '1.0', TRUE);
        wp_register_script('jm-bxslider', get_template_directory_uri() . '/js/jquery.jm-bxslider.js', 'jquery', '1.0', TRUE);
        wp_enqueue_script('bxslider');
        wp_enqueue_script('jm-bxslider');

        $cl_show = '';
        if ($title != "" || $description != "") {
            $cl_show .= 'show-header';
        }
        if ($show_nav == '1') {
            $cl_show .= ' show-nav';
        }
        $$image_border ='';
        if($image_border !=''){
            $image_border = 'style="border-radius:'.$image_border.';-webkit-border-radius:'.$image_border.';-moz-border-radius:'.$image_border.';-ms-border-radius:'.$image_border.';-o-border-radius:'.$image_border.';';
        }
        ob_start();
        if ($products->have_posts()) {
            wp_enqueue_style("shop-$style", get_template_directory_uri()."/framework/shortcodes/shopcarousel/css/shop-$style.css");
            require get_template_directory()."/framework/shortcodes/shopcarousel/layouts/shop-$style.php";
        wp_reset_postdata();
        }
        return '<div class="woocommerce">' . ob_get_clean() . '</div>';
}