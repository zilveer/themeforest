<?php

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
         $cloud_products_array[$cp['id']] = $cp['name'];
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
?>

