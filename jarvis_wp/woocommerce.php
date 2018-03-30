<?php get_header(); ?> 

<?php
   get_template_part('menu_section'); 
   $main_shop_layout = (($smof_data['rnr_enable_wc_sidebar'])) ? 'twelve' : 'sixteen';
   $single_product_layout = (($smof_data['rnr_enable_wc_single_sidebar'])) ? 'twelve' : 'sixteen';   

  if($smof_data['rnr_enable_wc_sidebar']) { 
	add_filter('loop_shop_columns', 'loop_columns');	
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			return 3; // 3 products per row
		}
	} 
  }
  
?>

    <div class="section post-single woocommerce"><!-- SECTION -->
   
		<div class="container">	
           <div class="row">
           	<?php if(is_product()){ ?>
			<div class="<?php echo $single_product_layout; ?> columns">  
                 <?php woocommerce_content(); ?>
			</div><!-- END SIXTEEN COLUMNS --> 
            <?php if($smof_data['rnr_enable_wc_single_sidebar']) { 

			get_sidebar('woocommerce'); } ?> 
            
            <?php } //Main Shop page layout 
			else if(is_shop() || is_product_category() || is_product_tag()) { ?>
			<div class="<?php echo $main_shop_layout; ?> columns">  
                 <?php woocommerce_content(); ?>
			</div><!-- END SIXTEEN COLUMNS --> 
            <?php if($smof_data['rnr_enable_wc_sidebar']) { 
			
			get_sidebar('woocommerce'); } ?> 
            
			<?php } ?>
           </div><!-- END ROW -->         
          </div><!-- END CONTAINER -->       
  

    </div><!--END SECTION -->
    
        </div><!--END SECTION -->
<?php get_footer(); ?>