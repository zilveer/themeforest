<?php

/* Define the custom box */

add_action( 'add_meta_boxes', 'st_add_room_settings_box' );

add_action( 'save_post', 'st_room_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function st_add_room_settings_box() {
    $screens = array('room');
    foreach ($screens as $screen) {
        add_meta_box(
            'st_room_box_id',
            __( 'Room Settings', 'smooththemes' ),
            'st_room_settings_box_content',
            $screen
        );
    }
}

/* Prints the box content */
function st_room_settings_box_content( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'st_room_noncename' );
  
  $remove_txt = __('Remove','smooththemes');
  
    
     $args = array( 'posts_per_page' => '-1' );
     $args['post_type'] = 'room_service';
     $args['orderby'] = 'post_title';
     $args['order'] = 'ASC';
     $args['post_status'] = 'publish';
    // added in ver 1.3
    if(st_is_wpml()){
      $args['sippress_filters'] = true;
      $args['language'] = ICL_LANGUAGE_CODE;
     }
     
  $new_query = new WP_Query($args);
  $room_services =  $new_query->posts;
  
 // $room_services = get_posts($args);
    
    
    $meta_name = '_st_services_included';
    
    $services_included =  get_post_meta($post->ID,$meta_name, true);
    if(empty($services_included)){
        $services_included = array();
    }
  
 ?>
 <style type="text/css">
     .services-available, .services-included{ width:  45%; }
     .services-available{ float: left;}
      .services-included{ float:  right; }
     .st-room-services .services-item li img{ max-width: 36px; max-height: 36px; margin-right: 5px;}
     .st-room-services .services-item li{
            background: none repeat scroll 0 0 #F9F9F9;
            border: 1px solid #DFDFDF;
            border-radius: 3px 3px 3px 3px;
            box-shadow: 0 1px 0 #FFFFFF inset;
            display: block;
            padding: 7px;
            margin: 5px 0px;
        }
        .st-room-services .services-item li .action{ float: right; }
        
 </style>
 
 <script type="text/javascript">
      jQuery(document).ready(function(){
            var s_meta_name =<?php echo json_encode($meta_name); ?>;
            var s_remove_txt =<?php echo json_encode($remove_txt); ?>;
            jQuery('.services-included-items').sortable();
         // for add new
           jQuery('.services-available-items li a').click(function(){
                var li = jQuery(this).parents('li');
                var sID=  li.attr('service-id');
                var html =  li.html();
                 html = '<li id="svincid-'+sID+'" service-id="'+sID+'">'+html+'<input type="hidden" name="'+s_meta_name+'['+sID+']" value="'+sID+'"/></li>';
                
               var c =  jQuery('.services-included-items').append(html);
               jQuery('.action',c).html(s_remove_txt);
                
                li.hide();
                return false;
           });
           
           // for remove
            jQuery('.services-included-items li a').live('click',function(){
                var li = jQuery(this).parents('li');
                var sID =  li.attr('service-id');
                jQuery('.services-available-items li#svaid-'+sID).show();
                li.remove();
                return false;
           });
           
      });
 
 </script>

 <div class="stpb_pd_w st-room-services">
        <div>
             <h4><?php _e('Room price','smooththemes'); ?></h4>
             <input type="text" name="_room_price" value="<?php echo esc_attr(get_post_meta($post->ID,'_room_price',true)); ?>"  />
        </div>
 
        <div class="services-available">
            <h4><?php _e('Services available','smooththemes'); ?></h4>
            <ul class="services-item services-available-items">
                <?php 
                
                foreach($room_services as $s): 
                $thumb_url='';
                if(has_post_thumbnail($s->ID)){
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($s->ID), 'thumbnail_size' );
                    $thumb_url = $thumb['0'];
                }
                $style ='';
                if($services_included[$s->ID]!=''){
                    $style = ' style="display: none;"';
                }
                ?>
                    <li id="svaid-<?php echo $s->ID ; ?>" service-id="<?php echo $s->ID ; ?>"<?php echo $style; ?>>
                        <span class="room-service">
                        <?php if($thumb_url): ?>
                        <img src="<?php echo $thumb_url; ?>" alt="icon" />
                        <?php endif; ?>
                        <?php echo apply_filters('the_title',$s->post_title); ?></span>
                        
                         <a href="#" class="action"><?php _e('Add','smooththemes'); ?></a>
                        <div class="clear"></div>
                    </li>
                <?php endforeach; ?>
               
            </ul>
            <p><a href="<?php echo admin_url('post-new.php?post_type=room_service'); ?>" target="_blank"><?php _e('Add more service','smooththemes'); ?></a></p>
        </div>
        
        <div class="services-included">
             <h4><?php _e('Services Included','smooththemes'); ?></h4>
               <ul class="services-item services-included-items">
                    <?php 
                
                foreach($room_services as $s): 
                $thumb_url='';
                if(has_post_thumbnail($s->ID)){
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($s->ID), 'thumbnail_size' );
                    $thumb_url = $thumb['0'];
                }
                $style ='';
                if($services_included[$s->ID]!=''){

                ?>
                    <li id="svincid-<?php echo $s->ID ; ?>" service-id="<?php echo $s->ID ; ?>"<?php echo $style; ?>>
                        <span class="room-service">
                        <?php if($thumb_url): ?>
                        <img src="<?php echo $thumb_url; ?>" alt="icon" />
                        <?php endif; ?>
                        <?php echo apply_filters('the_title',$s->post_title); ?></span>
                        
                         <a href="#" class="action"><?php  echo $remove_txt;  ?></a>
                        <div class="clear"></div>
                        <input type="hidden" name="<?php echo $meta_name.'['.$s->ID.']'; ?>" value="<?php echo $s->ID  ; ?>"/>
                    </li>
                <?php 
                }
                
                 endforeach; ?>
               </ul>
             <p><em><?php _e('Drag items to sort','smooththemes'); ?></em></p>
        </div>
        
 

   <div style="clear: both;"></div>
  </div><!-- stpb_pd_w -->

 <?php
}

/* When the post is saved, saves our custom data */
function st_room_save_postdata( $post_id ) {

  // First we need to check if the current user is authorised to do this action. 
  if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['st_room_noncename'] ) || ! wp_verify_nonce( $_POST['st_room_noncename'], plugin_basename( __FILE__ ) ) )
      return;

 
$_st_services_included = isset($_POST['_st_services_included']) ? $_POST['_st_services_included'] : array();
 // for event meta 
 update_post_meta($post_id,'_st_services_included',$_st_services_included);
 
 $_room_price = isset($_POST['_room_price']) ?  $_POST['_room_price'] : '';
 
 update_post_meta($post_id,'_room_price',$_room_price);
 
 
  // or a custom table (see Further Reading section below)
}
