<?php

if(!function_exists('st_event_get_date')){
    function  st_event_get_date($array_date ){
        $date ='';
        $now = current_time('timestamp');
        
        if(isset($array_date['date']) && !empty($array_date['date'])){
            if(preg_match('/^[\d]{4}-[\d]{1,2}-[\d]{1,2}$/',$array_date['date'])){
                
                $date = $array_date['date'];
                
                // check hour
                if( 
                
                 (isset($array_date['h']) ||  !empty($array_date['h']) ) 
                 && ($array_date['h']!='' && intval($array_date['h']) >=0 && intval($array_date['h']) <=24   )
                
                ){
                     $date .=' '.$array_date['h'];
                }else{
                	
                     $date .=' 00';
                }
                
                // check minute
                if( (isset($array_date['m']) ||  !empty($array_date['m']) )  
                      
                    && ( $array_date['m']!='' &&  intval($array_date['m']) >=0 && intval($array_date['m']) <=60   )
                     ){

                     $date .=':'.$array_date['m'];
                }else{

                     $date .=':00';
                }

                $date.=':'.date('00');
                
            }
  
        }
        
        return $date;
    }
    
}


/* Define the custom box */

add_action( 'add_meta_boxes', 'st_add_event_settings_box' );

add_action( 'save_post', 'st_event_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function st_add_event_settings_box() {
    $screens = array('event');
    foreach ($screens as $screen) {
        add_meta_box(
            'st_event_box_id',
            __( 'Event Settings', 'smooththemes' ),
            'st_event_settings_box_content',
            $screen,'side','core'
        );
    }
}

/* Prints the box content */
function st_event_settings_box_content( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'st_event_noncename' );
  
    $start_date = get_post_meta($post->ID,'_st_event_start_date',true);
    
    if($start_date!=''){
        $start_date = strtotime($start_date);
    }
    
    $end_date = get_post_meta($post->ID,'_st_event_end_date',true);
    if($end_date!=''){
        $end_date = strtotime($end_date);
    }


 ?>
 <style type="text/css">
     .date-label{ float: left; width: 120px;}
    .st_date_event input{ border-radius: 3px; border: 1px solid #DFDFDF; }
     .st_date_event .lw{width: 100%; }
     .st_date_event textarea.lw{ height: 100%;}
 </style>
 
 <div class="stpb_pd_w st_date_event">
 

  <div class="st-date">
     <label class="date-label"><?php _e('Start Date:','smooththemes'); ?></label><br />
     <input class="st_datepicker"  maxlength="10" size="10"  autocomplete="off" name="_st_event_start_date[date]" value="<?php  echo ($start_date!='') ? date_i18n('Y-m-d',$start_date) : ''; ?>" /> @
     <input  autocomplete="off" name="_st_event_start_date[h]" maxlength="2" size="2" value="<?php  echo ($start_date!='') ? date_i18n('H', $start_date) : ''; ?>" /> :
     <input  autocomplete="off" name="_st_event_start_date[m]" maxlength="2" size="2" value="<?php  echo ($start_date!='') ? date_i18n('i',$start_date) : ''; ?>" />
     <div  class="clear"></div>
  </div>
  
  <div class="st-date">
    <label class="date-label"><?php _e('End Date:','smooththemes'); ?></label><br />
    <input class="st_datepicker" maxlength="10" size="10" autocomplete="off" name="_st_event_end_date[date]" value="<?php  echo ($end_date!='') ? date_i18n('Y-m-d',$end_date) : ''; ?>" /> @
    <input  autocomplete="off" name="_st_event_end_date[h]"  maxlength="2" size="2" value="<?php  echo ($end_date!='') ? date_i18n('H', $end_date) : ''; ?>"  /> :
    <input  autocomplete="off" name="_st_event_end_date[m]" maxlength="2" size="2"  value="<?php  echo ($end_date!='') ? date_i18n('i', $end_date) : ''; ?>"  />
    <div  class="clear"></div>
  </div>
  
  
  <div class="stdive"></div>
  
  <div class="st-date">
     <label class="date-label"><?php _e('Price:','smooththemes'); ?></label>
      <input type="text" name="_st_event_meta[price]"  class="lw" value="<?php echo esc_attr(get_post_meta($post->ID,'_st_event_meta_price',true)); ?>" />
     <div  class="clear"></div>
  </div>
   
    <div class="stdive"></div> 
    
  <div class="st-date">
     <label class="date-label"><?php _e('Address:','smooththemes'); ?></label>
    
      <textarea rows="10" name="_st_event_meta[address]" class="lw"><?php echo esc_attr(get_post_meta($post->ID,'_st_event_meta_address',true)); ?></textarea>
     <div  class="clear"></div>
  </div>
  
  </div><!-- stpb_pd_w -->

 <?php
}

/* When the post is saved, saves our custom data */
function st_event_save_postdata( $post_id ) {

  // First we need to check if the current user is authorised to do this action. 
  if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['st_event_noncename'] ) || ! wp_verify_nonce( $_POST['st_event_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // Thirdly we can save the value to the database

  //if saving in a custom table, get post_ID
  $post_ID = $_POST['post_ID'];
  //sanitize user input
 // $mydata = sanitize_text_field( $_POST['myplugin_new_field'] );
 
   $start_date = st_event_get_date($_POST['_st_event_start_date']);
   $end_date   =   st_event_get_date($_POST['_st_event_end_date']);
 
 // date_i18n
  // Do something with $mydata 
  // either using 
 update_post_meta($post_id, '_st_event_start_date', $start_date);
 update_post_meta($post_id, '_st_event_end_date', $end_date);
 
 
 // for event meta 
 
 if(isset($_POST['_st_event_meta']) && is_array($_POST['_st_event_meta'])){
     foreach($_POST['_st_event_meta'] as $k=> $v){
         update_post_meta($post_id, '_st_event_meta_'.$k, $v);
     }
 }
 
  // or a custom table (see Further Reading section below)
}
