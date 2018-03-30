<?php

/** ************************************************* ADMIN generate code FUNCTiONS ********************************************************************* */

// for blog post
function stpb_blog_generate($data,$type=''){
    if(empty($data)){
        return '';
    }

    $r = wp_parse_args($data['data'],array(
        'title'=>'',
        'cats' => array(),
        'numpost'=>5,
        'exclude'=>'',
        'orderby'=>'ID',
        'order'=>'DESC',
        'display_type'=>1,
        'site_layout'=>'',
        'show_title'=>'n',
        'show_paging'=>'n'
    ));
    
    extract($r);
    
    if(!empty($cats) and is_array($cats)){
        $cats =  ' cats="'.join(',',$cats).'" ';
    }else{
        $cats ='';
    }
    
     $short_code = ' [blog_post site_layout="'.intval($data['site_layout']).'" pbwith="'.$data['pbwith'].'" show_paging="'.esc_attr($show_paging).'"  show_title ="'.esc_attr($show_title).'" type="'.esc_attr($display_type).'" order="'.esc_attr($order).'"  orderby="'.esc_attr($orderby).'" exclude="'.esc_attr(str_replace(' ','',$exclude)).'" title="'.str_replace('"','&quot;',esc_attr($title)).'" '.$cats.' numpost ="'.$numpost.'"] ';
     $short_code = apply_filters('stpb_blog_generate',$short_code,$data);
      
     return $short_code;
    
}

// for text items
function  stpb_banner_generate($data,$type=''){
     if(empty($data)){
        return '';
    }
    
    $r = wp_parse_args($data['data'],array(
        'title'=>'',
        'img'=>'',
        'url'=>'',
        'more_text'=>__('Read more','smooththemes')
    ));
    
  
    extract($r);
  
    if($url!='' ||  $more_text!='' ){
         $url= ($url!='') ? $url : '#';
         $more = '<a class="banner-more" href="'.esc_attr($url).'">'.esc_html($more_text).'</a>';
    }
    
    if($img!=''){
        $img = '<img alt="" src="'.esc_attr($img).'" class="banner-image">';
    }
    

    if($title!=''){
        $title ='<h3 class="banner-title">'.esc_html($title).'</h3>            ';
    }
    
    $html ='<div class="banner-item">
        <div class="banner-details">
            '.$title.$more.'
        </div>
         '.$img.'
    </div>';
    
    return $html;
    
}



// for text items
function  stpb_text_generate($data,$type=''){
    
     if(empty($data)){
        return '';
    }
    
    $function = $data['function'];
    $function = explode('_',$function);
    unset($function[0]);
    $function =join('-',$function);
    if($function==''){
        $function ='text';
    }
    
    $function= strtolower($function);
    
    $r = wp_parse_args($data['data'],array(
        'title'=>'',
        'content'=>'',
        'img'=>'',
        'url'=>'',
        'autop'=>false,
        'show_more'=>'',
        'img_pos'=>'',
        'site_layout'=>'',
        'more_text'=>'',
    ));
    
    extract($r);
    
    if($url!='' && ($show_more==1|| $show_more==true)){
        $more = '<div class="read-more"><a class="more btn small" title="'.esc_attr($title).'" href="'.esc_attr($url).'">'.esc_html($more_text).'</a></div>';
    }else{
        $more='';
    }

    
    $content = balanceTags($content);
    
    if($content !='' &&($autop ==1 || $autop==true )){
        $content = '<div class="content-txt">'.wpautop($content).'</div>';
    }
    
    
    if($function =='text'){
        if($img!=''){
             $img = '<img class="hotel-thumb" src="'.esc_attr($img).'" alt="'.esc_attr($title).'" />';
         }
           switch(strtolower($img_pos)){
               case 'top' :
                     $img = '<span class="img  top">'.$img.'</span>';
                     $content =  $img . $content;
               break;
               case 'right' :
                     $img = '<span class="img  right">'.$img.'</span>';
                     $content =  $img . $content;
               break;
               case 'bottom' :
                     $img = '<span class="img  bottom">'.$img.'</span>';
                     $content =  $content . $img ;
               break;
               
               default: 
                    $img = '<span class="img  left">'.$img.'</span>';
                     $content =  $img . $content;
           }
           
           $content .= '<div class="clear"></div>';
           
           if($title!=''){
                 $title ='
                 <div class="builder-title-wrapper clearfix">
                    <h3 class="builder-item-title">'.esc_html($title).'</h3>
                </div>';
            }
           
            $html  = '<div class="'.$function.'-wrapper builder-item-wrapper builder-editor">'.$title.$content.$more.'</div>';
           
    }elseif($img!=''){
        
        if($img!=''){
             $img = '<div class="b20 text-center"><img class="service-thumb " src="'.esc_attr($img).'" alt="'.esc_attr($title).'" /></div>';
         }
         if($content!=''){
            $content ='<div class="inner-c b10">'.$content.'</div>';
         }
         
          if($title!=''){
                 $title =' <h3 class="service-title  builder-it">'.esc_html($title).'</h3>';
            }
            
          $html  = '<div class="'.$function.'-wrapper builder-item-wrapper builder-editor">'.$img.$title.$content.$more.'</div>';
    }
    


    return $html;
    
}



function  stpb_alert_generate($data,$type=''){
     if(empty($data)){
        return '';
    }
    $r = wp_parse_args($data['data'],array(
        'title'=>'',
        'content'=>'',
        'img'=>'',
        'url'=>'',
        'autop'=>false,
        'alert_type'=>'',
    ));
    
    extract($r);
    
    $title = stripslashes($title);

    $content = balanceTags(stripcslashes($content));

    if($content !='' &&($autop ==1 || $autop==true )){
        
        $content = '<div class="alert-content" >'.wpautop($content).'</div>';
    }elseif($content!=''){
         $content = '<div class="alert-content">'.$content.'</div>';
    }else{
        $content ='';
    }
    
    if($img!=''){
        $img = '<div class="img"><img src="'.esc_attr($img).'" alt="'.esc_attr($title).'" /></div>';
    }
    
    if($title!=''){
         $title ='
         <div class="builder-title-wrapper clearfix">
            <h3 class="builder-item-title">'.esc_html($title).'</h3>
         </div>
         ';
        
    }else{
        $title= '';
    }
    if($alert_type!=''){
        $alert_type =' alert-'.$alert_type;
    }
    $html  = '<div class="alert'.$alert_type.' builder-item-wrapper"><button type="button" class="close">'.esc_html(__('&#215;','smooththemes')).'</button>'.$title.$img.$content.'<div class="clear"></div></div>';
    return $html;
    
}

function stpb_image_grid_generate($data){
    
    if(empty($data['images'])){
        return '';
    }
    
    $images = $data['images'];
    $meta = $data['meta'];
    $num_col = intval($data['settings']['col']);
    $is_gallery = intval($data['settings']['is_gallery'])==1 ? 1 : 0; 
    
    if($num_col<=0){
        $num_col =4;
    }
    
    if($num_col>6){
        $num_col = 6; // max 6 col
    }
    $title ='';
    if($data['settings']['title']!=''){
         $title .='
         <div class="builder-title-wrapper clearfix">
                <h3 class="builder-item-title">'.esc_html(stripslashes($data['settings']['title'])).'</h3>
            </div>';
    }
    $shorcode = '<div class="content-wrapper image_grid col-'.$num_col.'">'.$title.'  %1$s  </div>';
    
    $class=  stpb_number_to_text(round(12*(1/$num_col)));
    $string_shortcode = array();
    
    $rows = array();
    
    $c = 0;
    $i =0;
    $str_cols ='';
    $format = "<div class=\"row builder-item-wrapper\"> \n".'%1$s'."\n</div>";
    
    foreach($images as $n=> $img){
        $col = array();
        $col['img'] = $img;
        $col['meta'] =$meta[$n];
      
      $str_cols = ' <div class="'.$class.' columns b30 "> [st_img img_id="'.esc_attr($col['img']).'" is_gallery="'.$is_gallery.'" title="'.esc_attr($col['meta']['title']).'" url="'.esc_attr($col['meta']['url']).'" ] caption="'.esc_attr($col['meta']['caption']).'" [/st_img] </div>';
    
      $rows[$c][] =  $str_cols ;
      if($i>=$num_col-1){
        $c++;
        $i=0;
      }else{
         $i++;
      }        
    }
    
    $item=array();
    foreach($rows  as  $cols){
        // $item[] =  sprintf($format,join("\n",$cols));
         $item[] =   sprintf($format,join("\n",$cols).'<div class="clear"></div>');
    }
    
    $shorcode = sprintf($shorcode,join("\n",$item).'').'<div class="clear"></div>';
    
    return  $shorcode;
   // extract($r);  
}





function stpb_widget_generate($data){
    
    if(empty($data)){
        return '';
    }
    
    $title ='';
    if($data['data']['title']!=''){
         $title .='<div class="builder-title-wrapper clearfix">
                <h3 class="builder-item-title">'.esc_html($data['data']['title']).'</h3>
                </div>';
    }
    
    return '<div class="content-wrapper widget col-'.$num_col.' builder-item-wrapper">'.$title.'  [st_widget id="'.esc_attr($data['data']['widget']).'"]  </div>';
   
}



function stpb_slider_generate($data){
    
    if(empty($data['images'])){
        return '';
    }

    $page_builder_data['slider_items']['images'] = $data['images'];
    $page_builder_data['slider_items']['meta'] = $data['meta'];
    $page_builder_data['show_slider'] = 1;
    if(empty($data['slider_type'])){
        $data['slider_type'] ='flexslider';
    }

    $page_builder_data['slider_type'] = $data['slider_type'];
    
   $page_builder_data = array_merge($data,$page_builder_data);
    
    $html = '<div class="blog-thumb-wrapper silder-wrap builder-item-wrapper">'.st_get_content_from_func('st_the_slider',$page_builder_data).'</div>';
    return  $html;
}


function stpb_carousel_generate($data){
    if(empty($data['images'])){
        return '';
    }
    $images = $data['images'];
    $meta = $data['meta'];
    $html = st_get_content_from_func('st_carousel',$data);
    return  $html;
}

/**
 * return  item html code
 */ 
function  stpb_ui_item_generate($data=array(),$tag ='li',$class='',$chil_class_prefix='item',$icon='', $item_id='',$is_tab = false){
    $data = wp_parse_args($data,array(
            'title'=>'',
            'content'=>'',
            'img'=>'',
            'url'=>'',
            'autop'=>false,
            'show_more'=>'',
            'item_type'=>'',
            'more_text'=>__('Read more','smooththemes')
        ));
        
        extract($data);
        $html ='';
        
        if($url!='' && ($show_more==1|| $show_more==true)){
            $more = '<div class="read-more"><a class="more" title="'.esc_attr($title).'" href="'.esc_attr($url).'">'.esc_html($more_text).'</a></div>';
        }else{
            $more='';
        }
        
         $content = balanceTags($content);
        if($content !='' &&($autop ==1 || $autop==true )){
            $content = '<div class="txt-content" >'.wpautop($content).'</div>';
        }elseif($content!=''){
             $content = '<div class="txt-content">'.$content.'</div>';
        }else{
            $content ='';
        }
        
        if($img!=''){
            $img = '<div class="img"><img src="'.esc_attr($img).'" alt="'.esc_attr($title).'" /></div>';
        }

       if($title!='' and !$is_tab){
          if($icon){
            $icon = '-'.$icon;
          }
          
          if($item_type=='toggle'){
                $icon_btn  = '<i class="ui-icon icon-plus"></i><i class="ui-icon icon'.$icon.'"></i>';
          }else{
              $icon_btn  = '<i class="ui-icon icon'.$icon.'"></i>';
          }
          
           
            $title =' <h3 class="'.esc_attr($chil_class_prefix).'-title">'.esc_html($title).$icon_btn.'</h3>';
            
        }else{
            $title= '';
        }
        
        if($class!=''){
            $class = ' class="'.esc_attr($class).'"';
        }
        
        if($item_id!=''){
            $item_id = '  id= "'.esc_attr($item_id).'" ';
        }
        
        if($is_tab){
            $html .= '<'.$tag.$item_id.$class.'>'.$img.$content.$more.'</'.$tag.'>'."\n";
        
        }else{
            $html .= '<'.$tag.$item_id.$class.'>'.$title.'<div class="'.esc_html($chil_class_prefix).'-content">'.$img.$content.$more.'</div></'.$tag.'>'."\n";
        
        }
        
        
        return $html;
}



function  stpb_accordion_generate($data){
    $actitle = '';
    if($data['settings']['title']!=''){
        $actitle = '
            <div class="builder-title-wrapper clearfix">
                <h3 class="builder-item-title">'.esc_html($data['settings']['title']).'</h3>
            </div>';
    }
    $html ='';
    if($data['ui_data'])
    foreach($data['ui_data'] as $k => $d){
        $html .=stpb_ui_item_generate($d,'li','accordion-item','acc','chevron-down');
    }
    
    $html = '<div class="accordion-wrap builder-item-wrapper">
            '.$actitle.'
            <ul class="st-accordion">
                '.$html.'
            </ul>
        </div>';
    return $html;
}


function  stpb_toggle_generate($data){
    $actitle = '';
    if($data['settings']['title']!=''){
         $actitle = '
            <div class="builder-title-wrapper clearfix">
                <h3 class="builder-item-title">'.esc_html($data['settings']['title']).'</h3>
            </div>';
    }
    $html ='';
     if($data['ui_data'])
    foreach($data['ui_data'] as $k => $d){
        $d['item_type'] ='toggle';
        $html .=stpb_ui_item_generate($d,'li','toggle-item','toggle','minus');
    }
    
    $html = '<div class="toggle-wrap builder-item-wrapper">
            '.$actitle.'
            <ul class="st-toggle">
                '.$html.'
            </ul>
        </div>';
    return $html;
}




function  stpb_tabs_generate($data){
    $mtitle = '';
    if($data['settings']['title']!=''){
        $mtitle = '<div class="builder-title-wrapper clearfix">
            <h3 class="builder-item-title">'.esc_html($data['settings']['title']).'</h3>
        </div>';
    }
    $content  ='';
    $tab_titles = '';
    $i = 0;
    $id = 'tab-'.uniqid();
    if($data['ui_data'])
    foreach($data['ui_data'] as $k => $d){

        $tab_titles.='<li'.$class.' tab-id="'.$id.$k.'"><span>'.esc_html($d['title']).'</span></li>'."\n";
        $content .=stpb_ui_item_generate($d,'div','tab-content','','',$id.$k,true);
        $i++;
    }
    
    $html = '<div class="tabs-wrap builder-item-wrapper">
            '.$mtitle.'
            <div class="st-tabs b0">
                    <ul class="tab-title">
                        '.$tab_titles.'
                    </ul>
                    <div class="tab-content-wrapper">
                        '.$content.'
                    </div>
                </div>
        </div>';
    return $html;
}






function  stpb_post_slider_generate($data){
    if(empty($data)){
        return '';
    }
    //st_slider()
    $html ='';
    if(trim($data['data']['title'])!=''){
        $html .= '
        <div class="builder-title-wrapper clearfix">
            <h3 class="builder-item-title">'.esc_html($data['data']['title']).'</h3>
        </div>
        ';
    }
    

    $data['data']['pbwith'] = isset($data['pbwith']) ? $data['pbwith'] :  null;
    $data['data']['site_layout'] = isset($data['site_layout']) ? $data['site_layout'] :  null;
   
     $html .='[st_slider '.st_shortcode_attr($data['data']).']';
   // wp_reset_query();
    return '<div class="builder-item-wrapper">'.$html.'</div>';

}

function  stpb_post_carousel_generate($data){
    if(empty($data)){
        return '';
    }
    //st_slider()
    $html ='';
    if(trim($data['data']['title'])!=''){
        $html .= '<h3 class="carousel-title item-title">'.esc_html($data['data']['title']).'</h3>';
    }
    //$html  .=  st_get_content_from_func('st_carousel',st_get_setup_post_slider_data($data['data']), array('class'=>'posts-carousel'));
     $html .='[st_carousel '.st_shortcode_attr($data['data']).']';
    return  '<div class="builder-item-wrapper">'.$html.'</div>';;

}




function stpb_portfolio_generate($data,$type=''){
    if(empty($data)){
        return '';
    }
    
     $short_code = ' [portfolio '.st_shortcode_attr($data['data']).'] ';
     $short_code = apply_filters('stpb_portfolio_generate',$short_code,$data);
      
     return $short_code;
}



function stpb_this_entry_generate($data,$type=''){
    return '<div class="builder-editor text-wrapper builder-item-wrapper"> [this_entry] </div>';
}

function stpb_events_calendar_generate($data,$type=''){
    
    $title = (trim($data['data']['title'])!='') ? '<div class="builder-title-wrapper clearfix">
            <h3 class="builder-item-title">'.esc_html($data['data']['title']).'</h3>
         </div>' : '';
    
    return '<div class="builder-item-wrapper events-calendar">'.$title.'[events_calendar] </div>';
}


function stpb_clients_generate($data,$type=''){
    $actitle = '';
    if($data['settings']['title']!=''){
        $actitle = '
        <div class="builder-title-wrapper clearfix">
            <h3 class="builder-item-title">'.esc_html($data['settings']['title']).'</h3>
         </div>
        ';
    }
    
    $target ='';
    
    if($data['settings']['target']!=''){
        if($data['settings']['target']=='_self' || $data['settings']['target'] =='_blank'){
            $target = ' target="'.$data['settings']['target'].'" ';
        }
    }
    
    $html ='';
    $items = '';
    
    $num_col  = (isset($data['settings']['num_col'])  && intval($data['settings']['num_col'])>0) ? intval($data['settings']['num_col']) : 4 ;
    
    $class_name=stpb_number_to_text(12/$num_col);
    
    $i =1;
    if($data['ui_data'])
    foreach($data['ui_data'] as $k => $d){
        
        $item = '';
        if($d['img']!=''){
           $item = '<img src="'.esc_url($d['img']).'" alt="'.esc_attr($d['title']).'"/>'; 
        }
        
        if($d['url']!=''){
            $item=' <a href="'.esc_url($d['url']).'" '.$target.' title="'.esc_attr($d['title']).'">'.$item.'</a>';
        }
        if($item!=''){
            $items .='<div class="'.$class_name.' item columns b10'.( ($i==1) ? ' start' : ($i==$num_col ? ' end' :'') ).'">'.$item.'</div>';
        }
        
        if($i==$num_col){
            $items.='<div class="clear"></div>';
            $i=1;
        }else{
            $i++;
        }
        
        
    }
    
    $id =  uniqid();
    $html = '<div class="clients-wrap  builder-item-wrapper">
            '.$actitle.'
            <div class="st-clients" id="caro-'.$id.'">
                '.$items.'
                <div class="clear"></div>
            </div>
        </div>';
    return $html;
}


function stpb_testimonials_generate($data,$type=''){
    
   //  echo var_dump($data); die();
    $actitle = '';
    if($data['settings']['title']!=''){
        $actitle = '<div class="builder-title-wrapper clearfix">
            <h3 class="builder-item-title">'.esc_html($data['settings']['title']).'</h3>
        </div>';
    }
    
    $html ='';
    $items = '';
    if(is_array($data['ui_data']))
    foreach($data['ui_data'] as $k => $d){
        //$html .=stpb_ui_item_generate($d,'li','toggle-item','toggle','minus');
       $author = $img  =  $postion = $title = '';
        if($d['img']!=''){ // now is avatar
           $img = '<img src="'.esc_url($d['img']).'" class="t-avt" alt="'.esc_attr($d['title']).'"  title ="'.esc_attr($d['title']).'"/>'; 
        }else{
            
        }

        $author ='
        <div class="t-autor">
            <span class="t-avt">'.$img.'</span>
            <div class="t-a-m">
                <div class="t-a-name">'.esc_html($d['title']).'</div>
                <div class="t-a-positon">'.esc_html($d['url']).'</div>
            </div>
            <div class="clear"></div>
        </div>';
        
        $content = $d['content'];
     
         
      if($content!=''){
             $content = '<div class="test-c">'.esc_html($content).'</div>';
        }else{
            $content ='';
        }
        
        $content ='<div class="test-c-w">'.$content.'<div class="arr"></div></div>';
        
        $items .='<div class="carou-item "><div class="test-w ">'.$content.$author.'</div></div>';
        
    }
    
    
    $id =  uniqid();
    
    $html = '<div class="testimonials-wrap list_carousel builder-item-wrapper">
            '.$actitle.'
            <div class="st-testimonials carou" id="test-'.$id.'">
                '.$items.'
            </div>
            <a id="prev-test-'.$id.'" class="prev" href="#"><i class="icon-chevron-left"></i></a>
            <a id="next-test-'.$id.'" class="next" href="#"><i class="icon-chevron-right"></i></a>
        </div>';
    return $html;
}


function stpb_rooms_generate($data,$type=''){
    if(empty($data)){
        return '';
    }
    
     $short_code = ' [rooms '.st_shortcode_attr($data['data']).'] ';
     $short_code = apply_filters('stpb_rooms_generate',$short_code,$data);
      
     return $short_code;
}


function stpb_events_generate($data,$type=''){
    if(empty($data)){
        return '';
    }
     $short_code = ' [events '.st_shortcode_attr($data['data']).'] ';
     $short_code = apply_filters('stpb_events_generate',$short_code,$data);
      
     return $short_code;
}

function stpb_upcomming_events_generate($data,$type=''){
    if(empty($data)){
        return '';
    }
     $short_code = ' [upcomming_events '.st_shortcode_attr($data['data']).'] ';
     $short_code = apply_filters('stpb_upcomming_events_generate',$short_code,$data);
      
     return $short_code;
}


function stpb_post_gallery_generate($data,$type=''){
    if(empty($data)){
        return '';
    }
    
     $short_code = ' [post_gallery '.st_shortcode_attr($data['data']).'] ';
     $short_code = apply_filters('stpb_post_gallery_generate',$short_code,$data);
      
     return $short_code;
}

function  stpb_contact_form_generate($data,$type=''){
    if($data['data']['title']!=''){
        $actitle = '<div class="builder-title-wrapper clearfix">
            <h3 class="builder-item-title">'.esc_html($data['data']['title']).'</h3>
        </div>';
    }else{
        $actitle ='';
    }
    
    return  '<div class="builder-item-wrapper">'.$actitle.'[contact_form '.st_shortcode_attr($data['data']).']</div>';
}


function  stpb_reservation_form_generate($data,$type=''){
    if($data['data']['title']!=''){
        $actitle = '<div class="builder-title-wrapper clearfix">
            <h3 class="builder-item-title">'.esc_html($data['data']['title']).'</h3>
        </div>';
    }else{
        $actitle ='';
    }
    
    return  '<div class="builder-item-wrapper">'.$actitle.'[reservation_form '.st_shortcode_attr($data['data']).']</div>';
}



/** ===================== for WooCommerce ==============================*/

function stpb_WooCommerce_products_generate($data,$type=''){
    
     if(empty($data)){
        return '';
    }
    
     $short_code = ' [st_products site_layout="'.intval($data['site_layout']).'" pbwith="'.$data['pbwith'].'" '.st_shortcode_attr($data['data']).']';
     $short_code = apply_filters('stpb_blog_generate',$short_code,$data);
      
     return $short_code;
    
}

