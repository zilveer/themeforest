<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "#content" div.
 *
 * @package WordPress
 * @subpackage mango
 * @since mango 1.0
 */
?>
<?php
		get_template_part('header/head');
		global $post, $mango_settings, $current_header ,$current_page;
		
		$current_page =  mango_current_page_id();
?>
<?php if(mango_load_wrapper()){ ?>
    <div id="wrapper" class="<?php echo mango_wrapper_class() ?>">
<?php } ?>
<?php  
	if ( class_exists( 'WC_Vendors' ) ){
	if(is_product()){
		if($mango_settings['mango_single_wcvendors_hide_header'])
		{
			get_template_part("header/load-header"); 
		}
	}else{
		get_template_part("header/load-header");
	}
	}else{
		get_template_part("header/load-header");
		
	}
	?>  
	 <section id="content" role="main">
	 <?php 
            mango_page_banner();
            mango_page_title_header();
      if(class_exists('WC_Vendors') ){
         ?> 
		 
		
		 <div class="container">
		 <?php 
		  mango_wc_vendor_header();
		 ?>
		 </div>
<?php } ?>