<?php 
global $post;
the_post();
$st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
$builder_content = get_page_builder_content($post->ID) ;
$showTitle=   true;
 // echo $st_page_options['page_options']['show_title'];
if(empty($st_page_options['page_options']['show_title']) ||  $st_page_options['page_options']['show_title']==''){
        $showTitle =  false;
}
$showContent =  true; 
if(empty($st_page_options['page_options']['show_content']) ||  $st_page_options['page_options']['show_content']==''){
        $showContent =  false;
}

?>
<div class="content clearfix">
<div <?php post_class('text-content'); ?>>
    <?php 
    if($builder_content==''){
          the_content();
    }else{
         echo do_shortcode($builder_content) ; 
    }
    ?>
    </div>
</div>