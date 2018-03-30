<?php 
/**
 * Check Wordpress version compare
*/
if ( ! function_exists( 'st_check_wp_version' ) ) {
	function st_check_wp_version( $version = '3.5', $operator ='>=' ) {
		global $wp_version;
		if ( version_compare( $wp_version, $version, $operator  ) ) {
			return true;
		}
		return false;
	}
}


function st_function_false(){
    return false;
}
function st_function_true(){
    return true;
}

function st_set_html_content_type()
{
	return 'text/html';
}

/* Number To Text
--------------------------------------------------------------- */
function stpb_number_to_text($n){
     switch($n){
          case 1:
             $class ='one';
        break;
          case 2:
             $class ='two';
        break;
        case 3:
             $class ='three';
        break;
        case 4:
             $class ='four';
        break;
        case 5:
             $class ='five';
        break;
        case 6:
             $class ='six';
        break;
        case 7:
             $class ='seven';
        break;
        case 8:
          $class ='eight';
        break;
        case 9:
          $class ='nine';
        break;
        case 10:
          $class ='ten';
        break;
        case 10:
          $class ='eleven';
        break;
        
        default :
          $class ='twelve';
        
    }
    return $class;
}

function st_make_safe_name($string_name) {
		$regex = array('#(\.){2,}#', '#[^A-Za-z0-9\.\_]#', '#^\.#');
		return preg_replace($regex, '', $string_name);
}


/* Get WP title
--------------------------------------------------------------- */
function st_title(){
    global $page, $paged;
    wp_title( '|', true, 'right' );
    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
    echo " | $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
    echo ' | ' . sprintf( __( 'Page %s', 'smooththemes' ), max( $paged, $page ) );
}

/* Function Return Boxed or Full-Width Class
--------------------------------------------------------------- */
function st_boxed_class(){
  $bf_layout = st_get_setting("page_full_boxed",'b');
  if($bf_layout == 'f' or (isset($_REQUEST['layout']) && $_REQUEST['layout'] == 'fullwidth') ){
    $bf_layout = 'full-width-mode';
    } else {
    $bf_layout = 'boxed-mode';
  }
  return $bf_layout;
}


/* Function return substring
--------------------------------------------------------------- */
 function st_get_substr($str,$n=150,$more='...')
 {
    $str = strip_tags($str);
     if(strlen($str)<$n) return $str;
     $html = substr($str,0,$n);
     $html = substr($html,0,strrpos($html,' '));
     return $html.$more;
 }

/**
* Get full url of js file
*/
function st_js($file, $echo = false){
    $js = ST_THEME_URL.'assets/js/'.$file;
    if($echo){
        echo   $js;
    }else{
        return $js;
    }
}

/**
* Get full url of css file
*/
function st_css($file, $echo = false){
    $css = ST_THEME_URL.'assets/css/'.$file;
    if($echo){
        echo   $css;
    }else{
        return $css;
    }
}

/**
* Get full url of image file
*/
function st_img($file, $echo = false){
    $img = ST_THEME_URL.'assets/images/'.$file;
    if($echo){
        echo   $img;
    }else{
        return $img;
    }
}


/**
* Get file url from asset url
*/
function st_asset($file, $echo = false){
    $file = ST_THEME_URL.'assets/'.$file;
    if($echo){
        echo   $file;
    }else{
        return $file;
    }
}


/**
* return content from php file
*/

function st_get_content($file,$data= array(),$settings = array(),$html = false){
    if(!is_file($file)){ 
        return   false;
    }
    ob_start();
    $old_cont =  ob_get_contents();
    ob_end_clean();
    ob_start();
    include($file);
    $content = ob_get_contents();
    ob_end_clean();
    echo $old_cont;
   
    return $content;
}


/**
 *Get content from  function  
 */ 
function st_get_content_from_func($function,$data = array(),$settings = array()){
    if(!function_exists($function) || !is_string($function)){ 
        return   false;
    }
    
    ob_start();
    $old_cont =  ob_get_contents();
    ob_end_clean();
    ob_start();
       call_user_func($function,$data,$settings);
    $content = ob_get_contents();
    ob_end_clean();
    echo $old_cont;
    return $content;
    
}



global  $st_post_meta;

/**
 * Get option of post meta
 */
function st_get_post_meta($post_id,$meta_name,$key='',$default= false){
    global $st_post_meta;
    $mt = false;
    if(empty($st_post_meta[$post_id][$meta_name])){
        //cache query to global $st_post_meta
      $st_post_meta[$post_id][$meta_name] =  get_post_meta($post_id,$meta_name, true);
    }
    if($key==''){
        return (!empty($st_post_meta[$post_id][$meta_name])) ?  $st_post_meta[$post_id][$meta_name] : $default; 
    }
    return (!empty($st_post_meta[$post_id][$meta_name][$key])) ?  $st_post_meta[$post_id][$meta_name][$key] : $default; 
}

/**
 * get Setting option
 */ 
function st_get_setting($name,$default= false){
    global $st_options;
    return (isset($st_options[$name])  && !empty($st_options[$name])) ?  $st_options[$name] :  $default;
}

/**
* Get settings from page builder
*/
function  get_page_builder_options($post_id,$cache=true){
    
    // check if cache
    $cache_key ='_st_page_builder_'.$post_id;
    if($cache){ 
          if($values = wp_cache_get( $cache_key ) ) {
                 return $values;
          }
     }
     
    $values = get_post_meta($post_id,'_st_page_builder',true);
    if(!is_array($values) &&  !is_object($values)){
        $values =  maybe_unserialize(base64_decode($values));
    }
    
    $values= st_stripslashes($values);
    $values = apply_filters('st_page_builder_options',$values);
    if($cache){ // cache to WP
         wp_cache_add( $cache_key, $values );
    }

    return $values;
}


/**
* Get content from page builder generated
*/
function  get_page_builder_content($post_id){
    $values =  get_post_meta($post_id,'_st_page_builder_content',true);
    return apply_filters('st_page_builder_content',$values);
}

/**
 * Include Template part
 * Include file from them folder/templates/$file
*/

function st_get_template($file,$data = array()){
    $file = ST_DIR.'/templates/'.$file;
    if(file_exists($file)){
         include($file); return true;
    }
    return false;
}


/**
 *  Display page pagination
 */
 function st_post_pagination($pages = '', $range = 2, $echo = true)
{  
     $showitems = ($range * 2)+1;  
     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
     
     $html ='';

     if(1 != $pages)
     {
         $html .= "<ul class='st-pagination'>";
   //      echo '<li><span class="all_page">Page '.$paged." of ".$pages."</span></li>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
            $html .= "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         if($paged > 1 && $showitems < $pages) 
            $html .= "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 $html .= ($paged == $i)? "<li><a href=\"#\" class='page-current'>".$i."</a></li>" : "<li><a href='".get_pagenum_link($i)."'  >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) 
            $html .= "'<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
              $html .= "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
         $html .= "</ul>\n";
     }
     
     if($echo){
         echo $html;
     }
     return $html;
     
} 


/**
* @return return the slider data for dunction st_slider
*/
function st_get_setup_post_slider_data($get_posts_args= array()){
    if(empty($get_posts_args)){
        return array();
    }
    
     $r = wp_parse_args($get_posts_args,array(
        'cats' =>'',
        'numpost'=>5,
        'exclude'=>'',
        'orderby'=>'ID',
        'order'=>'DESC'
    ));
    
    extract($r);
    
      if($numpost<=0){
        $numpost =5;
      }
    
      
      if(!is_array($cats)){
        $cats = explode(',',$cats);
      }

    /**
    * @Since ver 1.3
    */ 
    $args = array( 'posts_per_page' => $numpost );
     if($exclude!=''){
        $exclude= explode(',',$exclude);
        $args['post__not_in'] = $exclude;
    }
    
     if($cats){
            $args['category__in'] =  $cats;
     }
     
     
    $args['meta_key'] 		 = '_thumbnail_id';
    $args['meta_query'] = array(
		array(
			'key' => '_thumbnail_id',
			'value' => 0,
			'type' => 'numeric',
			'compare' => '>'
		)
	);
    
    $args['orderby'] = $orderby;
    $args['order'] = $order;
    $args['post_status'] = 'publish';
  
    if(st_is_wpml() ){
            
             if(is_admin()){ // this function calling in admin page
                 global $post;
                 $lang_data = wpml_get_language_information($post->ID);
                //  echo var_dump($lang_data,$post->ID); die();
                  $args['language'] = $lang_data['locale'];
             }else{
                  $args['language'] = get_bloginfo('language');
             }
        
         $args['sippress_filters'] = true;
    }
    
    
    // echo var_dump($args);
    
    $new_query = new WP_Query($args);
    $myposts =  $new_query->posts;
    
    $data['images'] = array();
    $data['meta'] = array();
    if(count($myposts)){
        
        $i = 0;
        foreach($myposts as $post){
          
            $id = get_post_thumbnail_id( $post->ID );
            if($id>0){
                $data['images'][$i]= $id;
                $data['meta'][$i]['title'] =  get_the_title($post->ID);
                $data['meta'][$i]['url'] = get_permalink($post->ID);
                $data['meta'][$i]['date'] =  mysql2date('M j, Y', $post->post_date);
                $content ='';
               	if ( preg_match('/<!--more(.*?)?-->/', $post->post_content, $matches) ) {
	               	$content = explode($matches[0], $post->post_content, 2);
                    $content = $content[0];
                    
                }else{
                    
                    $content =  st_get_substr(strip_tags($post->post_content),st_get_setting("limit_char",70),'');
                }
               
                if($content!=''){
                    $content.=st_excerpt_more();
                } 
                    
                 $data['meta'][$i]['caption'] = $content;
                $i++;
            }
        }
    }
    return $data;
}


function st_get_video($url,&$return=array()){
	$url_lower = strtolower($url);
    
		if(strpos($url_lower,'youtube')){		
                preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$url,$id);
                $return['type']='youtube';
                $return['video_id']=$id[1];
                if($id[1]==''){
                    return '';
                }
                return '<iframe src="http://www.youtube.com/embed/'.$id[1].'?wmode=transparent"  frameborder="0"></iframe>';
		}else if(strpos($url_lower,'youtu.be') ){
		      preg_match('/youtu.be\/([^\\?\\&]+)/', $url, $id);
              $return['type']='youtube';
              $return['video_id']=$id[1];
              if($id[1]==''){
                    return '';
                }
              return '<iframe src="http://www.youtube.com/embed/'.$id[1].'?wmode=transparent"   frameborder="0"></iframe>';
			
		}else if(strpos($url_lower,'vimeo.com') ){
			preg_match('/http:\/\/vimeo.com\/(\d+)$/', $url, $id);
            $return['type']='vimeo';
            $return['video_id']=$id[1];
            if($id[1]==''){
                    return '';
            }
            return '<iframe src="http://player.vimeo.com/video/'.$id[1].'?title=0&amp;byline=0&amp;portrait=0"  frameborder="0"></iframe>';
		}
		 return '';
	}


function st_post_thumbnail($post_id='', $size ='st_small_thumb',$small_video_thumb = false, $video_shadow = false ){
    
     $st_page_options = get_page_builder_options($post_id);
     
      if(!isset($st_page_options['thumbnail_type'])){
            $st_page_options['thumbnail_type'] ='';
        }
        
        $shadow = ( (boolean) $video_shadow ==true )? '<div class="video-shadow"></div>' : '';
     
     $html ='';
            switch(strtolower($st_page_options['thumbnail_type'])){
            case 'video':
              
               $video = st_get_video($st_page_options['video_code'],$data);
                if(($size=='st_small_thumb' || $small_video_thumb ) && !empty($data)){
                      $html ='<span class="video-thumb" video="'.$data['type'].'" size='.$size.' video-id="'.$data['video_id'].'"></span>';
                     
                }else{
                    $html = $video.$shadow ;
                }
                
            break;
            case 'slider':
               
                if(count($st_page_options['thumbnails']['images'])){
                    
                    $slider_data  = array_merge( array('slider_items'=> $st_page_options['thumbnails'] ), array('show_caption'=>'no','class'=>'blog-thumb-wrapper','size'=>$size));
                    $slider_data['show_slider'] = 1;
                    $slider_data['slider_type']= 'flexslider';
                    $html =  st_get_content_from_func('st_the_slider', $slider_data );

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
         return apply_filters('st_post_thumbnail',$html, $post_id);
}


function st_post_small_thumbnail($post_id='', $size ='st_small_thumb'){
    
     $st_page_options = get_page_builder_options($post_id);
     
      if(!isset($st_page_options['thumbnail_type'])){
            $st_page_options['thumbnail_type'] ='';
        }
     
     $html ='';
            switch(strtolower($st_page_options['thumbnail_type'])){
            case 'video':
              
               $video = st_get_video($st_page_options['video_code'],$data);
               $html ='<span class="video-thumb" video="'.$data['type'].'" size='.$size.' video-id="'.$data['video_id'].'"></span>';
                     
                
                
            break;
            
            case 'slider':
                    if(count($st_page_options['thumbnails']['images'])){
                        $thumb_image_url = wp_get_attachment_image_src( $st_page_options['thumbnails']['images'][0], $size);
                        $post_title = get_the_title($post_id);
                        $html ='  <img alt="'.esc_attr($post_title).'" src="'.$thumb_image_url[0].'" >';
                    }

            break;
            default;
             
                 if ( has_post_thumbnail($post_id) ) {
                        $thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $size);
                        $post_title = get_the_title($post_id);
                        $html ='  <img alt="'.esc_attr($post_title).'" src="'.$thumb_image_url[0].'" >';
                     
                }
         } 
         
         return apply_filters('st_post_thumbnail',$html, $post_id);
}




function st_portfolio_thumbnail($post_id='', $size ='st_small_thumb',$rand_if_slider= false,$small_video_thumb = false){
     $st_page_options = get_page_builder_options($post_id);
     $html ='';
            switch(strtolower($st_page_options['thumbnail_type'])){
            case 'video':
              
               $video = st_get_video($st_page_options['video_code'],$data);
               // echo var_dump($data);
                if(($size=='st_small_thumb' || $small_video_thumb ) && !empty($data)){
                      $html ='<span class="video-thumb" video="'.$data['type'].'" size='.$size.' video-id="'.$data['video_id'].'"></span>';
                     
                }else{
                    $html = $video ;
                    if($html==''){
                        $html =  '<span class="video-thumb no-thumb"></span>';
                    }
                }
                
            break;
            case 'slider':
              
                if(count($st_page_options['thumbnails']['images'])){
                    if($rand_if_slider===true || $size =='st_small_thumb'){ // show rand image
                       $rand_key = array_rand($st_page_options['thumbnails']['images'], 1);
                       $thumb_image_url = wp_get_attachment_image_src( $st_page_options['thumbnails']['images'][$rand_key],$size);
                      
                     
                         $title = 'title="'. esc_attr (sprintf(__( 'Permalink to %s', 'smooththemes' ) , get_the_title($post_id) ) ). '"  rel="bookmark" ';
                           $html = '<span class="had-thumb">
    						<a href="'.get_permalink($post_id).'" '.$title.'><img alt="" src="'.$thumb_image_url[0].'" ></a>                           		
                            </span>';
                      
  
                    }else{
                        
                        $slider_data  = array_merge( array('slider_items'=> $st_page_options['thumbnails'] ), array('show_caption'=>'no','class'=>'portfolio-slider-wrapper','size'=>$size));
                        $slider_data['show_slider'] = 1;
                         $slider_data['slider_type']= 'flexslider';
                        $html =  st_get_content_from_func('st_the_slider', $slider_data );
                    
                    }
                }else{
                    $html = ' <span class="no-thumb no-slider"></span>';
                }
               

            break;
            default;
                 if ( has_post_thumbnail($post_id) ) {
                     $thumb_id = get_post_thumbnail_id($post_id);
                      $thumb_image_url = wp_get_attachment_image_src( $thumb_id, $size);
                       $full_img = wp_get_attachment_image_src( $thumb_id, 'full');
                       $ptitle =  get_the_title($post_id);
                        $title = 'title="'. esc_attr (sprintf(__( 'Permalink to %s', 'smooththemes' ) , $ptitle ) ). '"  rel="bookmark" ';
                     
                        $html ='
                                <a href="'.$full_img[0].'" rel="prettyPhoto"  title="'.esc_html($ptitle).'">
                                    <span class="portfolio-thumb-hover"></span>
                                    <span class="hover-lightbox-image"></span>
                                </a>
                                <img src="'.$thumb_image_url[0].'" alt="'.esc_html($ptitle).'">
                            ';    
                     
      
                }else{
                    $html = ' <span class="no-thumb"></span>';
            }
         } 
         return apply_filters('st_portfolio_thumbnail',$html, $post_id);
}




function st_post_thumbnail_gallery($post_id='', $size ='st_medium'){
    
    if(empty($size) || $size==''){
        $size = 'st_medium';
    }
    
     $st_page_options = get_page_builder_options($post_id);
     
     $html ='';
     $title = esc_attr ( get_the_title($post_id)  );    
     $link = get_permalink($post_id);
     
            switch(strtolower($st_page_options['thumbnail_type'])){
            case 'video':
              
               $html = st_get_video($st_page_options['video_code'],$data);
               
                
            break;
            case 'slider':
            
                if(count($st_page_options['thumbnails']['images'])){
                        $first_img = '';
                        $list_img =  array();
                        $gallery_id =  'gl'.uniqid();
                        
                        $i = 0;
                        $img_0 = '';
                        foreach($st_page_options['thumbnails']['images'] as $thumb_id){
                             
                             if($i==0){
                                 $thumb_image_url_0 = wp_get_attachment_image_src($thumb_id,$size);
                                 $img_0=  $thumb_image_url_0[0];
                             }
                             
                             // for light box
                             $thumb_image_url = wp_get_attachment_image_src($thumb_id,'full');
                             $list_img[] =  $thumb_image_url[0];
                             
                             $i++;
                        }
                        
                         $html = '';
                        if($list_img){
                            $html ='<img src="'.$img_0.'" alt="">
                                <div class="thumb-control-wrapper">
                                    <ul class="thumb-control clearfix">
                                        <li><a title="'.__('View Detail','smooththemes').'" href="'.$link.'" class="go-detail">'.__('Open Detail','smooththemes').'</a></li>
                                        <li><a rel="prettyPhoto['.$gallery_id.']" title="'.$title.'" href="'.$list_img[0].'" class="go-gallery">'.__('Open Gallery','smooththemes') .'</a></li>
                                        ';
                                        
                                    unset($list_img[0]);
                                    if(count($list_img)){
                                        $html .='<div style="display:none">';
                                            foreach($list_img as $src){
                                                $html .='<a rel="prettyPhoto['.$gallery_id.']" title="'.$title.'" href="'.$src.'"></a>';
                                            }
                                        $html .='</div>';
                                    }    
 
                                 $html .=  '</ul>
                                </div>';
                        }

                }
               
            break;
            default;
             
                 if ( has_post_thumbnail($post_id) ) {
                        $thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $size);
                  
                        $thumb_image_url=   $thumb_image_url[0];
                        $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'full');
                        $full_image_url =  $full_image_url[0];
                          
                        $html  ='<img src="'.$thumb_image_url.'" alt="">
                            <div class="thumb-control-wrapper">
                                <ul class="thumb-control clearfix">
                                    <li><a title="View Detail" href="'.$link.'" class="go-detail">'.__('Open Detail' ,'smooththemes').'</a></li>
                                    <li><a rel="prettyPhoto" title="'.$title.'" href="'.$full_image_url.'" class="go-gallery">'.__('Open Gallery','smooththemes').'</a></li>
                                </ul>
                            </div>';
                     
            }
         } 
         return apply_filters('st_post_thumbnail_gallery',$html, $post_id, $size);
}



/**
 * $image_data = array('meta'=> array(), 'images' )
*/
function st_images_thumb($image_data, $size ='st_medium', $custom_title=''){
    
    if(empty($size) || $size==''){
        $size = 'st_medium';
    }

     $html ='';
     $title = esc_attr ( get_the_title($post_id)  );    
     $link = get_permalink($post_id);

        if(count($image_data['images'])){
                        $first_img = '';
                        $list_img =  array();
                        $gallery_id =  'gl'.uniqid();
                        
                        $i = 0;
                        $img_0 = '';
                        foreach($image_data['images'] as $k=> $thumb_id){
                             
                             if($i==0){
                                 $thumb_image_url_0 = wp_get_attachment_image_src($thumb_id,$size);
                                 $img_0=  $thumb_image_url_0[0];
                             }
                             
                             // for light box
                             $thumb_image_url = wp_get_attachment_image_src($thumb_id,'full');
                             $list_img[$k]['src'] =  $thumb_image_url[0];
                             
                             $i++;
                        }
                        
                         $html = '';
                        if($list_img){
                            $html ='<img src="'.$img_0.'" alt="">
                                <div class="thumb-control-wrapper">
                                    <ul class="thumb-control clearfix">
                                        <li><a rel="prettyPhoto['.$gallery_id.']" title="'.$title.'" href="'.$list_img[0]['src'].'" class="go-gallery">'.__('Open Gallery','smooththemes') .'</a></li>
                                        ';
                                        
                                    unset($list_img[0]);
                                    if(count($list_img)){
                                        $html .='<div style="display:none">';
                                            foreach($list_img as $img){
                                                $html .='<a rel="prettyPhoto['.$gallery_id.']" title="'.$title.'" href="'.$img['src'].'"></a>';
                                            }
                                        $html .='</div>';
                                    }    
 
                                 $html .=  '</ul>
                                </div>';
                        }
  
                    
                }
               
            
          
  return apply_filters('st_images_thumb',$html,$image_data, $size ='st_medium');
}




function st_get_normal_fonts(){
   return  array(
                'Arial'=>'', //  array('value', font_url)
                'Arial Black'=>'',
                'Arial Narrow'=>'',
                'Courier New'=>'',
                'Georgia'=>'',
                'Times New Roman'=>'',
                'Trebuchet MS'=>'',
                'Verdana'=>'',
                'Andale Mono'=>'',
                'Baskerville'=>'',
                'Bookman Old Style'=>'',
                'Calibri'=>'',
                'Cambria'=>'',
                'Candara'=>'',
                'Century Gothic'=>'',
                'Century Schoolbook'=>'',
                'Consolas'=>'',
                'Constantia'=>'',
                'Corbel'=>'',
                'Franklin Gothic'=>'',
                'Garamond'=>'',
                'Gill Sans'=>'',
                'Helvetica'=>'',
                'Hoefler'=>'',
                'Lucida Bright'=>'',
                'Lucida Grande'=>'',
                'Palatino'=>'',
                'Rockwell'=>'',
                'Tahoma'=>''
            );
}

function st_shortcode_attr($array){
    if(!is_array($array)){
        return '';
    }
     $attr = array();
     foreach($array as $k=> $v){
        if(is_array($v)){
            $attr[] = $k.'="'.htmlspecialchars(join(',',$v)).'"';
        }else{
            $attr[] = $k.'="'.htmlspecialchars($v).'"';
        }
        
     }
     
      return join(' ',$attr);
}


/**
 * Return number
*/
function  st_get_paging_in_home(){
       global $wp_rewrite;
       if($wp_rewrite->permalink_structure!=''){
             @preg_match('/^(.*?)page\/([0-9]+)\/?$/',$_SERVER['REQUEST_URI'],$matches);
             if(isset($matches[2])){
                 return $matches[2];
             }
       }
       return 1;
} 


function st_get_upcomming_events($numpost = 5){
     $args = array( 'posts_per_page' => $numpost );
        $args['meta_key']	 =  '_st_event_start_date';
        
        $args['meta_query'] = array(
    		array(
    			'key' => '_st_event_start_date',
                'value'=>date('Y-m-d H:i:s',current_time('timestamp')),
                'compare'=>'>=',
    			'type' => 'DATETIME',
    		)
    	);
        
        $args['orderby'] = 'meta_value';
        $args['order'] = 'ASC';
        $args['post_type'] = 'event';
        
        // added in ver 1.3
        if(st_is_wpml()){
              $args['sippress_filters'] = true;
              $args['language'] = get_bloginfo('language');
         }

     $new_query = new WP_Query($args);
     $myposts =  $new_query->posts;
     
     return $myposts;
}












