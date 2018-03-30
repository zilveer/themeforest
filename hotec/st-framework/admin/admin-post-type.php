<?php
/**
 * Images column for posr type
 */ 
 
 
function st_manage_post_type_columns($column_name, $id) {
    global $wpdb;
     $size ='st_small_thumb';
    switch ($column_name) {
       
    case 'images':
        $html ='';
             $st_page_options = get_page_builder_options($id);
           //  echo get_the_post_thumbnail($id,array(40,40));
           
            switch(strtolower($st_page_options['thumbnail_type'])){
            case 'video':
              
               $video = st_get_video($st_page_options['video_code'],$data);
                
                $html ='<span class="video-thumb" video="'.$data['type'].'" size='.$size.' video-id="'.$data['video_id'].'"></span>';
                     
            break;
            case 'slider':

                    if(count($st_page_options['thumbnails']['images'])){
                        foreach($st_page_options['thumbnails']['images'] as $img_id){
                             $thumb_image_url = wp_get_attachment_image_src( $img_id , $size);
                            $post_title = get_the_title($post_id);
                            $html .='  <img alt="'.esc_attr($post_title).'" src="'.$thumb_image_url[0].'" >';
                        }
                       
                    }

            break;
            default;
             
                 if ( has_post_thumbnail($post_id) ) {
                        $thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $size);
                        $post_title = get_the_title($post_id);
                        $html ='  <img alt="'.esc_attr($post_title).'" src="'.$thumb_image_url[0].'" >';
                     
                }else{
                      
                }
         } 
         
          echo $html;
             
             
        break;
    default:
        break;
    } // end switch
}   



function st_manage_post_type_gallery_columns($column_name, $id) {
    global $wpdb;
     $size ='st_small_thumb';
    switch ($column_name) {
       
    case 'images':
        $html ='';
             $image_data=  get_post_meta($id,'_st_gallery', true);
           //  echo get_the_post_thumbnail($id,array(40,40));

                    if(isset($image_data['images']) && count($image_data['images'])){
                        foreach($image_data['images'] as $img_id){
                             $thumb_image_url = wp_get_attachment_image_src( $img_id , $size);
                            $post_title = get_the_title($post_id);
                            $html .='  <img alt="'.esc_attr($post_title).'" src="'.$thumb_image_url[0].'" >';
                        }
                       
                    }
          echo $html;

        break;
    default:
        break;
    } // end switch
}   



function add_new_st_post_type_columns($columns) {
    
    $new_cols = array();
    $i=1;
    $insert_index = 3;
    foreach($columns as $k => $col){
        if($i==$insert_index){
            $new_cols['images'] = __('Images','smooththemes');
        }
        $new_cols[$k] = $col;
        $i++;
    }
    
    return $new_cols;
}
// Add to admin_init function

foreach( array('post','room_service','room','event', 'portfolio')  as $k=> $v ){
    add_action('manage_'.$v.'_posts_custom_column', 'st_manage_post_type_columns', 10, 2);
    add_filter('manage_edit-'.$v.'_columns', 'add_new_st_post_type_columns',10);
}

function st_add_list_posts_style(){
    wp_enqueue_style('st-list-posts',ST_ADMIN_URL."/css/list-posts.css");
}

add_action('admin_print_styles-post.php','st_add_list_posts_style');
add_action('admin_print_styles-edit.php','st_add_list_posts_style');

// for gallery 

add_action('manage_gallery_posts_custom_column', 'st_manage_post_type_gallery_columns', 10, 2);
add_filter('manage_edit-gallery_columns', 'add_new_st_post_type_columns',10);


