<?php 
/**
 * Right Sidebar layout
 */ 
 

  $post_id    = st_get_shop_page();
  $st_page_builder =  get_page_builder_options($post_id);
  
   $wc_sidebar = '';

if(is_product_category() || is_product_tag()){
     $wc_sidebar = isset($st_page_builder['shop_tax_right_sb']) ?  $st_page_builder['shop_tax_right_sb'] : null;
}elseif(is_product()){
    $wc_sidebar = isset($st_page_builder['shop_single_right_sb']) ?  $st_page_builder['shop_single_right_sb'] : null;
}else{
    $wc_sidebar = isset($st_page_builder['right_sidebar']) ?  $st_page_builder['right_sidebar'] : null ;
}
?>

<div class="main-outer-wrapper <?php echo main_outer_wrapper_class(); ?> woocommerce-layout">
   <div class="main-wrapper container">
   
        <div class="row row-wrapper">
            <div class="page-outer-wrapper">
             
                <div class="page-wrapper twelve columns left-sidebar b0">
                    <?php do_action('st_top_page_template'); ?>
                    <div class="row">
                    
                    <div class="content-wrapper eight columns b0">
                             <?php
                                   woocommerce_content();
                             ?>
                         </div>
                    
                     <div class="right-sidebar-wrapper four columns b0">
                        <div class="right-sidebar sidebar">
                            <?php 
                              do_action('st_sidebar',$wc_sidebar,'right');
                            ?>
                            <div class="clear"></div>
                        </div>
                        </div>

                         <div class="clear"></div>
                    </div>
               
                    
                     <?php do_action('st_bottom_page_template'); ?>
         </div><!-- END .page-wrapper -->
         
       <div class="clear"></div>
       
       </div><!-- page-outer-wrapper -->
       
    </div><!-- END .row-wrapper -->
    
    <div class="clear"></div>
    
    </div><!-- main-wrapper  -->
     <?php do_action('st_bottom_main_wrapper'); ?>
</div><!-- END .main-outer-wrapper  -->




