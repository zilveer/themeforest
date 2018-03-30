<?php 
if(is_singular()  && !is_singular('post')){
    global $post; 
    $st_page_builder = get_page_builder_options($post->ID);
    
     if(empty($st_page_builder)){
        $st_page_builder['show_title']=1;
     }else{
         if(!isset($st_page_builder['show_title'])){
            $st_page_builder['show_title'] ='';
        }
     }
     
     st_the_slider($st_page_builder,false,true);
    
}elseif(is_singular('post') ||  is_tax() || is_category() || is_tag() || ( (is_home() ||  is_front_page()) && !is_page() ) ){
    
    if(st_get_setting('show_blog_titlebar','y')!='n'){
        $st_page_builder = array();
        $st_page_builder['show_top_slider']=1;
        $st_page_builder['slider_type']='titlebar';
        
        $st_page_builder['titlebar']['title'] = st_get_setting('blog_titlebar','');
        $st_page_builder['titlebar']['desc'] = st_get_setting('blog_titlebar_desc','');
        $st_page_builder['titlebar']['img'] = st_get_setting('blog_titlebar_img','');
        $st_page_builder['slider_full_w']=1;
        
        st_the_slider($st_page_builder,false,true);
    }
     
}else{
        $st_page_builder = array();
        $st_page_builder['show_top_slider']=1;
        $st_page_builder['slider_type']='titlebar';
        
        $st_page_builder['titlebar']['title'] = '';
        $st_page_builder['titlebar']['desc'] = '';
        $st_page_builder['titlebar']['img'] = '';
        $st_page_builder['slider_full_w']=1;
        
        st_the_slider($st_page_builder,false,true);
}

