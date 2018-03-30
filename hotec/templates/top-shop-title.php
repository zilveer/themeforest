<?php 

$title ='';

if(is_product_category() || is_product_tag()){
    $title = single_term_title('',false);
    
}elseif(is_product()){
   $title =  get_the_title();   
}else{
    $post_id  = st_get_shop_page();
    $st_page_options =  $st_page_builder = get_page_builder_options($post_id);
    if(empty($st_page_options) || (isset($st_page_options['show_title'])  &&  $st_page_options['show_title']==1)){
        $title =  get_the_title($post_id);
    }else{
        $title= '';
    }

}

    
if($title){
?>
<div class="row shop-title">
    <div class="twelve columns b0">
        
        <div class="page-title-wrapper">
            <h1 class="page-title left"><?php echo $title; ?></h1>
            <?php woocommerce_result_count(); ?>
            <div class="page-title-alt right"><?php woocommerce_catalog_ordering(); ?></div>
            <div class="clear"></div>
        </div>
          
    </div>
</div>
<?php
}