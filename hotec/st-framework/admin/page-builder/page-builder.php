<?php 

include('page-builder-ajax-media.php');
include('page-builder-items-functions.php');
include('page-builder-items-generate-code.php');
include('page-builder-meta.php');


function st_page_builder_support($post_types=array()){
    $post_types = array('post','page','portfolio','event','room');
   return  $post_types;
}

add_filter('st_page_builder_support','st_page_builder_support');

/**
 * Add page builder to post type , support all post type
 */
function st_add_support_page_builder($settings = array()){
    
    $box = array(
        'box_name'=>'st_page_builder',
        'box_title'=>'Page builder',
        'context'=>'normal',
        'priority'=>'high',
        'settings'=>array(),
        'function_callback'=>'st_page_builder_box'
    );
    
    $post_types = apply_filters('st_page_builder_support', array());
    $box = apply_filters('st_page_builder_options',$box);
    if(is_array($post_types)){
     //echo  var_dump(function_exists($box['function_callback'])) ;
        foreach($post_types as $pt){
            add_meta_box($box['box_name'], $box['box_title'], $box['function_callback'], $pt , $box['context'], $box['priority'],$box['settings']);
        }
    }  
}



function st_builder_js(){
    global $ajax_nonce;

    wp_enqueue_script('jquery');
     wp_enqueue_script('page-builder',ST_ADMIN_URL.'/page-builder/page-builder.js',array('jquery'), '1.7', false);
     wp_localize_script('page-builder','STpb_options',array(
        'view_full_image'=> __('View full image','smooththemes'),
        'remove'=>__('Remove','smooththemes'),
        'seletc_image'=>__('Seletc Image','smooththemes'),
        'ajax_nonce'=>$ajax_nonce,
        'uploadID'=>''
    ));

}

function st_builder_css(){
      wp_enqueue_style('page-builder',ST_ADMIN_URL.'/page-builder/page-builder.css');
}

add_action("admin_print_styles-post-new.php","st_builder_css", 99);
add_action("admin_print_scripts-post-new.php","st_builder_js",99);
add_action("admin_print_styles-post.php","st_builder_css",99);
add_action("admin_print_scripts-post.php","st_builder_js", 99);


function get_page_builder_items(){
    global $post;
    $items = array(  // stpb_toggle
        'stpb_accordion'=>array(
                'title'=>__('Accordions','smooththemes'),
                 'default_with'=>'1_2',
                'generate_func' =>'stpb_accordion_generate'
            ),
            
            
            
         'stpb_toggle'=>array(
                'title'=>__('Toggle','smooththemes'),
                 'default_with'=>'1_2',
                'generate_func' =>'stpb_toggle_generate'
            ),
         
            
         'stpb_tabs'=>array(
                'title'=>'Tabs',
                 'default_with'=>'1_2',
                 'generate_func' =>'stpb_tabs_generate'
            ),
            
        'stpb_banner'=>array(
                'title'=>__('Banner','smooththemes'),
                'generate_func' =>'stpb_banner_generate',
                'default_with'=>'1_3',
            ),
            
         'stpb_text'=>array(
            'title'=>'Text',
              'generate_func' =>'stpb_text_generate'
            ),
         
            
            'stpb_clients'=>array(
                 'title'=>'Clients',
                 'generate_func' =>'stpb_clients_generate'
            ),
            
            
            'stpb_testimonials'=>array(
                 'title'=>'Testimonials',
                 'generate_func' =>'stpb_testimonials_generate'
            ),
            
            /*
          'stpb_image_gallery'=>array(
                'title'=>__('Image Gallery','smooththemes'),
                'generate_func' =>'stpb_image_grid_generate'
            ),  
            */
            
            'stpb_post_gallery'=>array(
                'title'=>__('Gallery','smooththemes'),
                'generate_func' =>'stpb_post_gallery_generate'
            ),  
            
            /*
         'stpb_slider'=>array(
             'title'=>'Slider',
             'generate_func' =>'stpb_slider_generate'
            ),
            */
         /*
         'stpb_post_slider' => array(
                'title'=>__('Blog Post Slider','smooththemes'),
                'generate_func' =>'stpb_post_slider_generate'
         ),
         */
            
        /*
          'stpb_widget'=>array(
                'title'=>'Widget',
                'block'=>false,
                 'default_with'=>'1_4',
                'generate_func' =>'stpb_widget_generate'
            ),
            */
          
          'stpb_service'=>array(
                'title'=>'Service Column',
                'default_with'=>'1_3',
                'block'=>false,
                'generate_func' =>'stpb_text_generate' // stpb_service_generate
            ),
            
            
            'stpb_alert'=>array(
                'title'=>__('Alert','smooththemes'),
                'block'=>false,
                'generate_func' =>'stpb_alert_generate'
            ),
            
            'stpb_portfolio'=>array(
                'title'=>__('Portfolio','smooththemes'),
                'block'=>false,
                'generate_func' =>'stpb_portfolio_generate'
            ),
            
            'stpb_rooms'=>array(
                'title'=>__('Rooms','smooththemes'),
                'block'=>false,
                'generate_func' =>'stpb_rooms_generate'
            ),
            
            'stpb_events'=>array(
                'title'=>__('Events','smooththemes'),
                'block'=>false,
                'generate_func' =>'stpb_events_generate'
            ),
            
            'stpb_upcomming_events'=>array(
                'title'=>__('Upcoming events','smooththemes'),
                'block'=>false,
                'generate_func' =>'stpb_upcomming_events_generate'
            ),
            
             'stpb_events_calendar'=>array(
                'title'=>__('Events Calenadar','smooththemes'),
                'generate_func' =>'stpb_events_calendar_generate'
            ),  
            
             'stpb_contact_form'=>array(
                'title'=>__('Contact form','smooththemes'),
                'generate_func' =>'stpb_contact_form_generate'
            ),  
            
            'stpb_reservation_form'=>array(
                'title'=>__('Reservation form','smooththemes'),
                'generate_func' =>'stpb_reservation_form_generate'
            ),  
          

    );
    
    if($post->post_type=='page'){
            $items['stpb_blog'] = array(
               'title'=>'Blog Posts',
               'generate_func' =>'stpb_blog_generate'
            );
            
            
            $items['stpb_this_entry'] = array(
               'title'=>__('This Page entry','smooththemes'),
               'editable'=>false,
               'generate_func' =>'stpb_this_entry_generate'
            );
    }
    
    //woocommerce plugin
    if(st_is_woocommerce()){
        
        $items['stpb_WooCommerce_products'] = array(
               'title'=>__('WooCommerce Products','smooththemes'),
               'generate_func' =>'stpb_WooCommerce_products_generate'
        );
    }
    
    return apply_filters('get_page_builder_items',$items);
}


function st_page_builder_box($options= array()){
      global $post, $pagenow,  $wp_registered_sidebars;;
      $name ='_st_page_builder';
      echo '<input type="hidden" name="st_page_builder_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

     $values = get_page_builder_options($post->ID); 
     if(empty($values)  || !count($values)){
        $no_value = true;
     }else{
         $no_value = false;
     }
     
     if(!is_array($values)){
        $values = (array) $values;
     }
     
        do_action('st_builder_items',$name,$values,$post);
      ?>
       
        <?php do_action('st_builder_meta',$name,$values,$post); ?>
       
       </div><!-- end stpb_pd_w -->
        
       <?php
      
} // end st_page_builder


/** ============================================================== */

function  stpb_column_class($pbwith){
    $class ="";
    $w = explode('_',$pbwith);
    $w[0] = intval($w[0]);
    $w[1] = intval($w[1]);
     if( $w[0] ==0 or  $w[1] == 0){
        $n = 12;
     }else{
        $n= 12*($w[0]/$w[1]); // 12 columns
     }
    
   $class =stpb_number_to_text($n); 
    
    $class.=' columns';
    $class = apply_filters('stpb_column_class',$class,$n);
    return $class;
}



//  add meta post to post type
add_action('admin_init','st_add_support_page_builder',9,2);


/**
 *  save slider in meta _st_included_sliders
 */ 
function st_pb_maybe_import_slider($post_id,$builder_data){
    
    if(!isset($builder_data) || empty($builder_data) || !is_array($builder_data)){
        return ;
    }elseif(is_array($builder_data)){
         if(isset($builder_data['slider_type'])  && $builder_data['slider_type']!=''){
            $sliders =  get_post_meta($post_id,'_st_included_sliders',true);
            $sliders[$builder_data['slider_type']]=1;
            update_post_meta($post_id,'_st_included_sliders',$sliders);
            if(isset($builder_data['builder'])  && is_array($builder_data['builder'])){
                foreach($builder_data['builder'] as $k=> $item_data){
                      if(isset($item_data['slider_type'])  && $item_data['slider_type']!=''){ 
                             $sliders =  get_post_meta($post_id,'_st_included_sliders',true);
                             $sliders[$item_data['slider_type']]=1;
                             update_post_meta($post_id,'_st_included_sliders',$sliders);
                      }
                }
            } 
            return ;
        }
    }
 return ;
}


// check and include if $ slider_type isset
function st_page_builder_check_import_slider($post_id, $data= array()){
    st_pb_maybe_import_slider($post_id,$data);
}


function st_pb_remove_included_sliders($post_id){
    delete_post_meta($post_id,'_st_included_sliders');
} 

add_action('st_after_page_builder_save','st_page_builder_check_import_slider',10,2);
add_action('st_before_page_builder_save','st_pb_remove_included_sliders',10,1);

// Save data froms t_save_page_builder
function st_save_page_builder($post_id) {
    global $meta_box,$smooththemes_sidebar;
    
    // verify nonce
    if (!wp_verify_nonce($_POST['st_page_builder_nonce'], basename(__FILE__))) {
        
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
        
        $meta_name = '_st_page_builder';
      // save post meta to each box
        $old = get_post_meta($post_id, $meta_name, true);
        $new = $_POST[$meta_name];
       
      //  $new = apply_filters('st_page_builder_save',$new, $post_id);
        
        do_action('st_before_page_builder_save',$post_id,$_POST[$meta_name]);
        
        if(!is_array($new)){
            $new = (array) $new;
        }
        
        $str_new =  $new;
        
        $str_new  = maybe_serialize($str_new);
        
        
        // echo var_dump($new,$str_new); die();
        
        $str_new = base64_encode($str_new);
        
        $cache_key ='_st_page_builder_'.$post_id;
        wp_cache_delete($cache_key); // remove cache
        
         update_post_meta($post_id, '_st_page_builder', $str_new);
        
        
        
        do_action('st_after_page_builder_save',$post_id,$_POST[$meta_name]);
        

        $layout = $new['layout'];
        // save  as a string shortcode
        $builder = $new['builder'];
        
        if(empty($builder)){
            $builder = array();
        }

        $rows = array();
        
        $ri=$i=0;
        $n= count($builder);
       // $tmp_builder=  $builder;
        while($i<$n){
            
             $wc = $builder[$i]['pbwith'];
             $w=  explode('_',$wc);
             $t = intval($w[0]);
             $m = intval($w[1]);
             
             if($m>0 and $t>0){
                 $c = $t/$m;
             }else{
                $c=1;
             }
             
             if($rows[$ri]['total']+$c<=1){
                 $rows[$ri]['total'] += $c;
                 $rows[$ri]['cols'][] = $builder[$i];
             }else{
                $ri++;
                $rows[$ri]['total'] += $c;
                $rows[$ri]['cols'][] = $builder[$i];
             }
            $i++;
        }// end while
        
        $string_shortcode = array();
        
        $builder_items = get_page_builder_items();
       
        
        // generate code to display: maybe html or shortcode
        $nr = count($rows);
        $i=1;
        $row_index = 1;
        foreach($rows as  $row){
            $rc = ' r-index-'.$row_index;
           
            $i++;
            $format = "<div class=\"row{$rc}\">\n".'%1$s'."\n</div>";
            $str_cols =  array();
            foreach($row['cols'] as $data){
                
                $data['site_layout'] = $data['data']['site_layout'] = $layout;
                $data['row_index'] = $data['data']['row_index'] = $row_index;
                
                $item = $builder_items[$data['function']];
                if(function_exists($item['generate_func'])){
                   $str_cols[]="\t<div class=\"".stpb_column_class($data['pbwith'])."\">".call_user_func($item['generate_func'],$data)."</div>";
                }else{
                     $str_cols[]="\t<div class=\"".stpb_column_class($data['pbwith'])."\"> </div>";
                }
            }
            
            $str_cols= join("\n",$str_cols);
            $str_cols.='<div class="clear"></div>';
            $string_shortcode[] = sprintf($format,$str_cols);  
            $row_index++;
        }
        
        $string_shortcode = join("\n",$string_shortcode);
        
        if ($string_shortcode!='') {
            update_post_meta($post_id, '_st_page_builder_content', $string_shortcode);
        } else {
            delete_post_meta($post_id, '_st_page_builder_content');
        }
     
}

// save metabox data
//save_post();
add_action('save_post', 'st_save_page_builder',9999);
