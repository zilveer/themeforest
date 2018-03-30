<?php
/**
 * @author Sa Hoang Truong
 * Email : shrimp2t@gmail.com 
 * 
 */ 



function st_get_images($postid=0, $size='thumbnail', $attributes='') {
global $post,  $current_user;

check_ajax_referer( $current_user->ID, 'ajax_nonce' );
        
$show = 20;
 $s=  $_REQUEST['s'];
// $count_product = wp_count_posts( 'product' ); 
$url =  trim($_REQUEST['url']);
if($url==''){
    $paged=  intval($_REQUEST['paged']);
    $paged = ($paged <= 0) ?  1 : $paged;
}else{
    
   
     if(strpos($urlm,$d)===false){
          $d= '&';
     }
     
    $url = explode($d,$url);
    unset($url[0]);
    $url=join($d,$url);

     parse_str($url,$request_data);
     $paged = intval($request_data['paged']);
     if($s==''){
        $s  = $request_data['s']; 
     }
   
}
    if(($s!='')){
         $order_by =   'title' ;
         $order = 'ASC';
    }else{
         $order_by =   'date';
         $order = 'DESC';
    }
 

$query = new WP_Query(
 array(
        'paged'=>$paged,
        'posts_per_page'=>$show,
        'post_type'=>'attachment',
       	'post_mime_type' => 'image',
        'post_status'=>'any',
        'orderby'=>$order_by,
        'order'=>$order,
        's'=>$s
    ) );
;


    $total_pages = ceil($query->found_posts/$show);
     if($paged>$total_pages ){
        $paged = $total_pages;
     }
    			  
     $page_links = paginate_links(array(  
            'base' => get_pagenum_link(1) . '%_%',  
            'format' => '&paged=%#%&s='.rawurlencode($s),  
            'current' => $paged,  
            'total' => $total_pages,  
            'end_size'     => 3,
            'mid_size'     => 3,
            'prev_next'    => true,
            'prev_text'    => __('&laquo; Previous','smooththemes'),
            'next_text'    => __('Next &raquo;','smooththemes'),
            'show_all' => false,
            'add_args'=>false
        )); 
        
    echo '<div class="paginate">
        <div class="s">
             <input type="text" class="st-s" value="'.esc_attr($s).'" /><input type="button" class="button-secondary st-s-btn" value="Search Images"/>
        </div>
        <div class="stp">
         '.$page_links.'
         </div>
         <div class="clear"></div>
    </div>';
    
    echo '<div class="st-js-images">';
    echo '<ul class="images">';
	while ( $query->have_posts() ) : $query->the_post();

			$attachment=wp_get_attachment_image_src($post->ID, 'medium');
            ?>
            <li  id-name="imageid_<?php echo $post->ID; ?>" img-id="<?php echo $post->ID; ?>" class="add_img">
                <div class="imw">
                     <img  src="<?php echo $attachment[0]; ?>"  width="<?php echo $attachment[1]; ?>" title="<?php echo esc_attr(the_title('','',false)); ?>" height="<?php echo $attachment[2]; ?>" />
                     <a href="#" class="st_edit st_img_tbtn">Edit</a>
                     <a href="#" class="st_delete st_img_tbtn">Del</a>
                     <input type="hidden" class="gtitle" value="" />
                     <input type="hidden" class="gcation" value="" />
                     <input type="hidden" class="gurl" value="" />
                </div>
            </li>
            <?php
   endwhile;
    echo '</ul>';
    echo '<div class="clear"></div>';
    echo '</div>';
  die();
}


add_action('wp_ajax_st_get_images', 'st_get_images');