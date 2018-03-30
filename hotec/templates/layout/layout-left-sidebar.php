<?php 
/**
 * Left sidebar  layout
 */ 
 
 
   if(is_singular()):
        global $post;
          $st_page_builder =  get_page_builder_options($post->ID);
    else :
          //$st_page_builder = array();
          $page_for_posts = get_option( 'page_for_posts' );
          $st_page_builder = get_page_builder_options($page_for_posts); // default is Posts page
    endif;
    
     if(!isset($st_page_builder['left_sidebar']))
        $st_page_builder['left_sidebar'] ='';
?>

<div class="main-outer-wrapper <?php echo main_outer_wrapper_class(); ?>">
   <div class="main-wrapper container">
   
        <div class="row row-wrapper">
            <div class="page-outer-wrapper">
            
             
                <div class="page-wrapper twelve columns page-wrapper-left-sidebar b0">
                    <?php 
                    /**
                     * @hooked st_page_title_tempalte();
                     */ 
                    
                    do_action('st_top_page_template'); ?>
                    <div class="row">

                    
                         <div class="content-wrapper eight columns b0">
                             <?php
                                  do_action('st_page_template');
                             ?>
                         </div>

                        <div class="left-sidebar-wrapper four columns b0">
                            <div class="left-sidebar sidebar">
                                <?php

                                do_action('st_sidebar',$st_page_builder['left_sidebar'],'left');
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
