<?php 
  $post_id    = st_get_shop_page();
   $st_page_builder =  get_page_builder_options($post_id);

     if(empty($st_page_builder)){
        $st_page_builder['show_title']=1;
     }else{
         if(!isset($st_page_builder['show_title'])){
            $st_page_builder['show_title'] ='';
        }
     }
     
     st_the_slider($st_page_builder,false,true);
    
