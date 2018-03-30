<?php

add_action('wp_enqueue_scripts', 'c66_add_scripts');
	function c66_add_scripts(){
    wp_enqueue_style( 'style-name', get_template_directory_uri() . '/cart66-cloud/styles.css');
}

function add_cart66_meta_boxes(array $meta_boxes)	{
	$prefix = '_dc_';

  $meta_boxes[] = array(
	  'id' => 'cart66_cloud_products',
	  'title' => __('Cart66 Cloud Product Options', 'designcrumbs'),
	  'pages' => array('products'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => false, // Show field names on the left
	  'fields' => array(

	    array(
       'name' => __('Select Product', 'designcrumbs'),
       'desc' => __('Select your Cloud product', 'designcrumbs'),
       'id' => $prefix.'product_id',
       'type' => 'select',
       'options' => build_cloud_product_select(),
      ),
	    array(
        'name' => __('Shortcode Attributes', 'designcrumbs'),
        'desc' => __('Enter the shortcode attributes for the shortcode. The default are <em>display=\'inline\' quantity=\'true\' price=\'true\'</em><br>Be sure to use single quotes around the values.', 'designcrumbs'),
        'id' => $prefix . 'product_shortcode_attr',
        'type' => 'text'
      ),
	  )
	);
	return $meta_boxes;
}


function cart66_cloud_get_my_products(){
  $cloud_products_array = array();
     if(class_exists('CC_Library')) {
       $library = new CC_Library();
       try {
         $cloud_products = $library->get_products();
       }
       catch(CC_Exception_API $e) {
         $cloud_products = CC_Common::unavailable_product_data();
       }
       if(is_array($cloud_products) && count($cloud_products) > 0) {
         foreach($cloud_products as $cp) {
           $cloud_products_array[$cp['id']] = $cp;
         }
       }
       else {
         $cloud_products_array[] = 'There are no available products';
       }
     }
     else {
       $cloud_products_array[] = 'There are no available products';
     }
     asort($cloud_products_array);
 return $cloud_products_array;
}
function build_cloud_product_select(){
  $products = cart66_cloud_get_my_products();
  $ouput=array();
  foreach($products as $id=>$product){
    $output[$product['name']] = array(
      'value' => $id,
      'name' => $product['name'] .' (sku: '.$product['sku'].')'
    );
  }
  ksort($output);
  return $output;
}
//add_filter( 'add_meta_boxes', 'build_cloud_product_select' );
function cart66_get_cloud_product($product_id=false){
	$cloud_products = array();
	$output = false;
	if(class_exists('CC_Library')) {
		$library = new CC_Library();
		try {
		 $cloud_products = $library->get_products();
		}
		catch(CC_Exception_API $e) {
		 $cloud_products = CC_Common::unavailable_product_data();
		}

		if($product_id) {
		  foreach($cloud_products as $p) {
		    if($p['id'] == $product_id) {
		      return $p;
		    }
		  }
		}
	}

	return $output;
}

function cart66_cloud_product_options() {
  include('product-meta-box.php');
}

add_filter( 'cmb_meta_boxes', 'add_cart66_meta_boxes' );

function cart66_get_product($product_id=false){
	$cloud_products = array();
	$output = false;
	if(class_exists('CC_Library')) {
		$library = new CC_Library();
		try {
		 $cloud_products = $library->get_products();
		}
		catch(CC_Exception_API $e) {
		 $cloud_products = CC_Common::unavailable_product_data();
		}

		if($product_id) {
		  foreach($cloud_products as $p) {
		    if($p['id'] == $product_id) {
		      return $p;
		    }
		  }
		}
	}

	return $output;
}