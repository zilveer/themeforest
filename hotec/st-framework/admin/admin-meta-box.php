<?php
/**
 * @author Sa Hoang Truong
 * Email : shrimp2t@gmail.com 
 * @see: http://codex.wordpress.org/Function_Reference/add_meta_box
 */ 



global $st_meta_boxs;

//include('settings-plugins/mtb-gallery.php');


/**
 * @param $pos_type string or array()
 * Add metabox to  $st_meta_boxs
 */ 
function st_add_metabox($pos_type,$box_name,$box_title,$settings){
    global $st_meta_boxs;
    
    if(is_array($pos_type)){
        
        foreach($pos_type as $pt){
             $st_meta_boxs[$pt.'_'.$name] = array(
                                'post_type'=>$pt,
                                'box_name'=>$box_name,
                                'box_title'=>$box_title,
                                'settings'=>$settings
                             );
        }
        
    }else{
         $st_meta_boxs[$pos_type.'_'.$name] = array(
                                'post_type'=>$pos_type,
                                'box_name'=>$box_name,
                                'box_title'=>$box_title,
                                'settings'=>$settings
                             );
    }
                                
}



// Add meta box
function st_add_post_metabox(){
	global $st_meta_boxs;
    
    if(function_exists('st_page_builder')){
        add_meta_box(__('Page Builder','smooththemes'), __('Page Builder','smooththemes'), 'st_page_builder', $box['post_type'] , $box['context'], $box['priority'],$box['settings']);
    
    }
    
    if(!is_array($st_meta_boxs)){
        return;
    }
    
    foreach($st_meta_boxs as $box){
        if(!is_array($box)){
            continue;
        }
         if($box['context']==''){
             $box['context']= 'normal';
         }
         
          if($box['priority']==''){
             $box['priority']= 'high';
         }
        
        add_meta_box($box['box_name'], $box['box_title'], 'st_show_meta_box', $box['post_type'] , $box['context'], $box['priority'],$box['settings']);
    }
	
}

//  add meta post to post type
add_action('admin_init','st_add_post_metabox',10,2);

function st_show_meta_box( $post, $args=array()){
	global $st_meta_boxs ,$post, $pagenow;
    // $st_meta_box_opts = $st_meta_boxs['post_type'][$post->post_type];
    $st_meta_box_opts = $args['args'];
     
   //  echo var_dump($st_meta_box_opts);
  
     if(empty($st_meta_box_opts)){
        return false;
     }

   
     echo '<input type="hidden" name="st_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
   
     echo '<div class="STpanel-tab-p st_meta_boxs" >';
      // display metabox options
      if(count($st_meta_box_opts)>1):
      echo '<div class="st_pt_tabs">';
      $i =1;
       foreach($st_meta_box_opts as $tab_id => $t){
         $class= ($i==1) ? ' active' : ''; $i++; // don't remove space before name of class
         echo '<a class="st_pt_tab'.$class.'" href="#" for-tab="'.esc_attr($tab_id).'">'.esc_html($t['tab_title']).'</a>';
       }
      echo '</div>';
       endif;
       
      // $name = $args['id'];
      $i =1;
      foreach($st_meta_box_opts as $tab_id => $tab){
        $name = $tab['name'];
         $class= ($i==1) ? ' active' : ' tab-hide';  $i++;
        $values  =  get_post_meta($post->ID, $name, true); 
        echo '<input type="hidden" name="st_meta_box_names[]" value="', esc_attr($name) , '" />';
        echo '<div class="st_pt_tab_cont '.$class.'" id="'.esc_attr($tab_id).'">';
         $tab_display = new admin_tabs_display($values,$name);
         $tab_display->display_tab_contents($tab['options']); 
        echo '</div>';
      }
       
     echo  '</div>';
}

// Save data from meta box
function st_save_meta_box_data($post_id) {
    global $meta_box,$smooththemes_sidebar;
    
    // verify nonce
    if (!wp_verify_nonce($_POST['st_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    
    $st_meta_box_names = $_POST['st_meta_box_names'];
    if(is_string($st_meta_box_names)){
        $st_meta_box_names[] = $st_meta_box_names;
    }elseif(!is_array($st_meta_box_names)){
        return $post_id;
    }
    
     if(empty($st_meta_box_names)){
        return $post_id;
     }
      
      // save post meta to each box
     foreach($st_meta_box_names as $meta_name){
        $old = get_post_meta($post_id, $meta_name, true);
        $new = $_POST[$meta_name];
        if ($new && $new != $old) {
            update_post_meta($post_id, $meta_name, $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $meta_name, $old);
        }
     }
    
}

// save metabox data
add_action('save_post', 'st_save_meta_box_data');