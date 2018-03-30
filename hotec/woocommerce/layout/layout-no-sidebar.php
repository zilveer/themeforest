<?php 
/**
 * FULL layout no sidebar
 */ 
?>


<div class="main-outer-wrapper <?php echo main_outer_wrapper_class(); ?> woocommerce-layout">
   <div class="main-wrapper container">
   
        <div class="row row-wrapper">
            <div class="page-outer-wrapper">

                <div class="page-wrapper twelve columns left-sidebar b0">
                 <?php do_action('st_top_page_template'); ?>
                    <div class="row">
                    
                            <div class="content-wrapper twelve columns b0">
                              <?php
                                 woocommerce_content();
                              ?>
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

