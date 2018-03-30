<?php 
function st_get_tpl_file_name(){

    $default = 'list-post';
    $file ='list-post';
  
    if(is_singular()){
    global $post;
    if($post->post_type!='page' && $post->post_type!='post'){
         $file = $post->post_type;
         if(!file_exists(ST_TEMPLATE_DIR.$file.'.php')){
            $file ='single';
         }
    }else{
         if(is_page()){
             $file = 'page';
         }else{
             $file = 'single';
         }
    }
    }elseif(is_author()){
       $file = 'author';
    }elseif(is_tag()){
        $file = 'tag';
    }elseif(is_tax()){
         $tax = get_queried_object();
         $file = 'taxonomy-'.$tax->taxonomy;
         if(file_exists(ST_TEMPLATE_DIR.$file.'.php')){
               return $file;
        }else{
            return 'taxonomy';
        }

    } elseif( (is_archive() || is_day() || is_date() || is_month() || is_year() || is_time()) && !is_category() ){
         $file = 'archive';
    }elseif(is_search() ){
         $file = 'search';
    }elseif(is_404() ){
        $file = '404';
    }
      
    if(file_exists(ST_TEMPLATE_DIR.$file.'.php')){
       return $file;
    }else{
        return $default;
    }
        
}

/**/
function st_page_titlebar_tempalte(){
    $file = ST_TEMPLATE_DIR.'titlebar.php';
    
    if(st_is_woocommerce()){
        if( function_exists('is_woocommerce')  &&  is_woocommerce()){
            $file = ST_TEMPLATE_DIR.'shop-titlebar.php';
        }
    }

    if(file_exists($file)){
        include($file);
    }
}

/**
 * hook : st_before_layout
*/
add_action('st_before_layout','st_page_titlebar_tempalte',10  ); // make sure this acrion always at bottom



/**
 *  @return class has-titlebar, has-slider, ...
 */ 
function main_outer_wrapper_class(){
    $class='';
    if(is_page() ||  (is_singular() && !is_singular('post') ) ){
       global $post;
        $st_page_builder = get_page_builder_options($post->ID);
        if(isset($st_page_builder['show_top_slider']) && $st_page_builder['show_top_slider']==1){
             if(isset($st_page_builder['slider_type'])  && in_array($st_page_builder['slider_type'],array('layerslider','revslider','flexslider'))){
                $class = 'has-slider';
             }else{
                $class ='has-titlebar';
             }
        }else{
            $class ='no-titlebar';
        }

    }elseif(is_singular('post') ||  is_tax() || is_category() || is_tag() || ( (is_home() ||  is_front_page()) && !is_page() )  ){
        if(st_get_setting('show_blog_titlebar','y')!='n'){
         $class ='has-titlebar';

        }
    }elseif(is_404()){
        $class ='has-titlebar';
    }

    // if installed WC plugin
    if(st_is_woocommerce() ){
        if(is_woocommerce()){
             $post_id  = get_option('woocommerce_shop_page_id');
             $st_page_builder =  get_page_builder_options($post_id);
             if(isset($st_page_builder['show_top_slider']) && $st_page_builder['show_top_slider']==1){
                 if(isset($st_page_builder['slider_type'])  && in_array($st_page_builder['slider_type'],array('layerslider','revslider','flexslider'))){
                    $class = 'has-slider';
                 }else{
                    $class ='has-titlebar';
                 }
             }else{
                $class ='no-titlebar';
             }
        }
    }
     return $class;
}


function st_page_title_tempalte(){
     $file = ST_TEMPLATE_DIR.'top-title.php'; // default
      if(st_is_woocommerce()){
          if( function_exists('is_woocommerce')  &&  is_woocommerce()){
             // if(is_shop() || is_product_category() ||  is_product_tag())
                $file = ST_TEMPLATE_DIR.'top-shop-title.php';
          }
      }
      
       if(file_exists($file)){
            include($file);
       }
}

/**
 * hook : st_page_title_tempalte
*/
add_action('st_top_page_template','st_page_title_tempalte',10  ); 



function st_subscribe_form(){
    if(st_get_setting('show_subcribe','y')!='n'){
        $file = ST_TEMPLATE_DIR.'forms/subscribe-form.php';
        if(file_exists($file)){
            include($file);
       }
    }
       
}

/**
 * hook : st_page_title_tempalte
*/
add_action('st_bottom_main_wrapper','st_subscribe_form',10  ); 


/**
 * Include current template for  layout
*/
function st_page_template(){
       $default = 'list-post';
       // for title
       $file = $GLOBALS['st_template_file_name'];
       // for main content 
       if(file_exists(ST_TEMPLATE_DIR.$file.'.php')){
            include(ST_TEMPLATE_DIR.$file.'.php');
       }else{
            include(ST_TEMPLATE_DIR.$default.'.php');
       }   
}
/**
 * hook : st_page_template
*/
add_action('st_page_template','st_page_template');


/**
 * display sidebar depend each page
 */ 
function st_sidebar($sidebar ='',$positon ='right'){
    $sidebar ;
    
    $afterfix ='_r';
     if(strtolower($positon)=='left'){
        $afterfix='_l';
     }
    
    if(empty($sidebar)){
        if(is_category()){
            $sidebar = st_get_setting("sidebar_category".$afterfix,'sidebar_default'.$afterfix);
        }elseif(is_search()){
            $sidebar = st_get_setting("sidebar_search".$afterfix,'sidebar_default'.$afterfix);
        }
    }
    
     if(empty($sidebar) || $sidebar==''){
        $sidebar = 'sidebar_default'.$afterfix;
     }
     

    do_action('st_before_sidebar'.$afterfix,$sidebar);
    dynamic_sidebar($sidebar); 
    do_action('st_atter_sidebar'.$afterfix,$sidebar);
}
/**
 * hook st_sidebar
 */ 
add_action('st_sidebar','st_sidebar',10,2);



/**
 * Return laoyout file by number
*/
function st_get_layout($number =-1){
    if($number<1){
    
       if(is_singular()){
            global $post;
         
            $st_page_builder = get_page_builder_options($post->ID);
            $layout = (isset($st_page_builder['layout'])) ? intval($st_page_builder['layout']) : 0;
            
            if(in_array($layout,array(1,2,3,4))){
               $number = $layout  ;
            }
            
        }elseif(is_tax()){ // for default layout in admin page 
             $tax = get_queried_object();
             $number  =  intval(st_get_setting("{$tax->taxonomy}_layout",0));        
        }
        
        if($number<=0){
            $number  =  intval(st_get_setting("layout",2));  
        }
        
    } // end if number 
    
    
    switch(intval($number)){
        case  4 : 
            $l = 'layout-left-right-sidebar';
        break;
          case  3 : 
            $l =  'layout-left-sidebar';
        break;
        case  2 : 
            $l =  'layout-right-sidebar';
        break;
        case  1 : 
            $l =  'layout-no-sidebar';
        break;
        default :
          $l = 'layout-right-sidebar';
  }
  
  return  apply_filters('st_get_layout',$l,$number);
}




// this is call back for comments
function st_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="comment-item">
     
      <div class="comment-header">
  	 <?php echo get_avatar($comment->comment_author_email,$size='60',$default='' ); ?>
    
      <div class="comment-header-right">
            <p class="comment-date"><?php printf(__('%1$s','smooththemes'), get_comment_date()); ?></p>
            <a href="#" class="comment-author"><?php printf('<b class="author_name">%s</b>', get_comment_author_link()) ?></a>
            <?php edit_comment_link(__('(Edit)','smooththemes'),'  ','') ?>
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
      
        <div class="clear"></div>
      </div>
      
      <div class="clear"></div>
      
      <div class='comment-content'>
          <?php comment_text() ?>
          <?php if ($comment->comment_approved == '0') : ?>
            <br /> <em><?php _e('Your comment is awaiting moderation.','smooththemes') ?></em>
          <?php endif; ?>

      </div>
     </div>
<?php
}


/**
 * parse Font
 * @return array
*/
function st_parse_font($font_url){
    $font_url  = urldecode($font_url);
    $args =  parse_url($font_url);
    $return = array('is_g_font'=> false, 'name'=>$font_url,'link'=>'');
    
    $args = wp_parse_args($args, array(
        'host'=>'',
        'query'=>''
    ));
    
    $font_data = wp_parse_args($args['query'], array('family'=>'','subset'=>''));
    
    if($args['host']=='fonts.googleapis.com' && $font_data['family']!='' ){
      //  echo var_dump($args) ; die();
        
        if(strpos($font_data['family'],':')!==false){
            $font_data['family'] = explode(':',$font_data['family']);
            $font_data['family'] =  (isset($font_data['family'][0])  && $font_data['family'][0]!='') ? $font_data['family'][0]  : '';
        }else{
            
        }
        
        if($font_data['family']!=''){
            $return['name'] = $font_data['family'];
              $return['is_g_font'] = true;
              $return['link'] = $font_url;   
        }
    }
        
  return $return;  
}


/**
 * make font style
 * Only use for header.php file
*/
function st_make_font_style($font,$css_selector,$show_font_size= true){
    
  
    
if($font['font-family']!=''){
    $font_data = st_parse_font($font['font-family']);
    
//$is_not_gfont = key_exists($font['font-family'],st_get_normal_fonts()); 
?>
<?php if($font_data['is_g_font']==true) : ?>
<link href='<?php echo  $font_data['link'] ?>' rel='stylesheet' type='text/css'>
<?php endif; ?>

<style type="text/css">

<?php echo $css_selector; ?>{ 
    font-family: '<?php echo $font_data['name']; ?>'; 
    <?php if(isset($font['font-style']) && $font['font-style']): ?>
    font-style: <?php echo $font['font-style']; ?>;
    <?php endif; ?>
    <?php if(isset($font['font-style']) && $font['font-style']): ?>
    font-style: <?php echo $font['font-style']; ?>;
    <?php endif; ?>
    <?php if(isset($font['font-weight']) && $font['font-weight']): ?>
    font-weight: <?php echo $font['font-weight']; ?>;
    <?php endif; ?>
    <?php if(isset($font['font-size']) && $font['font-size']): ?>
    font-size: <?php echo intval($font['font-size']); ?>px;
    <?php endif; ?>
    <?php if(isset($font['line-height']) && $font['line-height']): ?>
    line-height: <?php echo intval($font['line-height']); ?>px;
    <?php endif; ?>
    <?php if(isset($font['color'])  && $font['color']): ?>
    color: #<?php echo $font['color']; ?>;
    <?php endif; ?>
    
}
</style>
<?php
     }
}




/** ************* ST Theme ads ********************/
/**
 *  auto add ads to hooks
*/
function st_auto_ads(){
    $ads = st_get_setting("ads");
    if(is_array($ads)){
        foreach($ads as $ad){
            if($ad['hook']!=''&& $ad['content']!=''){
                $ad['content'] = stripslashes($ad['content']);
                $ad['content']=  str_replace("'","\'",  $ad['content']);
                $new_func = create_function('$c=""',' echo  \''.$ad['content'].'\' ; ');
                add_action($ad['hook'],$new_func);
            }
        }
    }
    
}
st_auto_ads(); // auto run


function st_background_sytle($bg_color='',$bg_img='',$bg_positon='',$bg_repreat='',$bg_fixed='n'){
    $bd_style ='';
     if($bg_color!='' ||  $bg_positon!='' || $bg_img!=''){
        
      if($bg_color!=''){
          $bd_style .= ' #'.$bg_color; 
      }   
       if($bg_img!=''){
          $bd_style .= ' url('.$bg_img.') '; 
         
              switch(strtolower($bg_positon)){
                    case 'tl':
                        $bd_style.=' top left ';
                    break;
                    
                    case 'tr':
                        $bd_style.=' top right ';
                    break;
                    
                    case 'tc':
                        $bd_style.=' top center ';
                    break;
                    
                    case 'cc':
                        $bd_style.=' center center';
                    break;
                    case 'bl':
                        $bd_style.=' bottom left ';
                    break;
                     case 'br':
                        $bd_style.=' bottom right ';
                    break;
                     case 'bc':
                        $bd_style.=' bottom center ';
                    break;
              }
              
           switch(strtolower($bg_repreat)){
                    case 'x':
                        $bd_style.=' repeat-x ';
                    break;
                    case 'y':
                        $bd_style.=' repeat-y ';
                    break;
                    case 'n':
                        $bd_style.=' no-repeat ';
                    break;
           }
           
           if($bg_fixed=='y'){
                $bd_style.=' fixed ';
           }
      } 
  }
  
  return $bd_style ;
}


/**
 * Set back ground for header
 * hook wp_head
*/
function st_theme_header_bg(){
    
    if(st_get_setting('disable_header_custom','n')=='y'){
        return ;
    }
    
    $bd_style= '';
    $bg_color = $bg_img = $bg_positon =$bg_repreat = $bg_fixed ='';

    $bg_color = st_get_setting("header_bg_color",'');
    $bg_img     =  st_get_setting("header_bg_img",'');
    $bg_positon = st_get_setting("header_bg_positon",'');
    $bg_repreat = st_get_setting("header_bg_repreat",'');
    $bg_fixed   = st_get_setting('header_bg_fixed','n');
    
    $bd_style =  st_background_sytle($bg_color,$bg_img, $bg_positon, $bg_repreat,$bg_fixed);
    
    $link_color =  st_get_setting("header_link_color",'202020');
    $link_hover_color =  st_get_setting("header_link_hover_color",'80B500');
      if($bd_style!='' || $link_hover_color!='' ||  $link_color!=''){
         echo '<style type="text/css">' ; 
             if($bd_style!=''){
                 echo '#header .header-outer-wrapper{background: '.$bd_style.'; }';
             }
             
             if($link_color!=''){
                  echo '#header .header-outer-wrapper .primary-nav > ul > li > a{color: #'.$link_color.'; }';
             }
             
             if($link_hover_color!=''){
                  echo '#header .header-outer-wrapper .primary-nav  >ul > li > a:hover,
                  #header .header-outer-wrapper .primary-nav  >ul > li.current-menu-item > a,
                  #header .header-outer-wrapper .primary-nav  >ul > li.current-menu-parent > a {color: #'.$link_hover_color.'; }';
             }
             
             
        echo  '</style>';
      }
}



/**
 * Set back ground for body
 * hook  wp_head
*/
function st_theme_body_bg(){
// For background settings
    $bg_type  = st_get_setting("bg_type",'d');
    if($bg_type=='d'){
          $bg = st_get_setting("defined_bg",'background1.jpg');
          // large image with fixed
          if(in_array($bg,array('background1.jpg'))){
              $bg = ST_THEME_URL.'assets/images/patterns/'.$bg;
               $style ='background: url("'.$bg.'") no-repeat fixed center center / cover  transparent;';
          }else{
              $bg = ST_THEME_URL.'assets/images/patterns/'.$bg;
              $style ='background: url("'.$bg.'") repeat  center center ';
          }
          
          echo '<style type="text/css">body {'.$style.' }</style>';
         return ;
    }elseif($bg_type=='c'){
         $bg = st_get_setting("defined_bg_color");
         if($bg!=''){
             echo '<style type="text/css">body {background: #'.$bg.'; }</style>';
         }
         return ;
    }
    
    // if is custom background

     $bd_style= '';
     $bg_color = $bg_img = $bg_positon =$bg_repreat = $bg_fixed ='';

     $bg_color = st_get_setting("bg_color",'');
 
    $bg_img     =  st_get_setting("bg_img",'');
    $bg_positon = st_get_setting("bg_positon",'');
    $bg_repreat = st_get_setting("bg_repreat",'');
    $bg_fixed   = st_get_setting('bg_fixed','n');
    
    $bd_style =  st_background_sytle($bg_color,$bg_img, $bg_positon, $bg_repreat,$bg_fixed);
    
      if($bd_style!=''){
         echo '<style type="text/css">body {background: '.$bd_style.'; }</style>';
      }

}


function st_theme_font(){
      $font_body = st_get_setting("body_font",array('font-family'=>'Roboto'));
      $heading_font = st_get_setting("headings_font",array('font-family'=>'Roboto'));
      st_make_font_style($font_body,'body');
      st_make_font_style($heading_font,'h1,h2,h3,h4,h5,h6, .subscribe_section label, .widget_calendar  caption');
      // Predefined Colors (pc) - Custom Color (cc)
      $pc   = st_get_setting("predefined_colors");
      $e_cc = st_get_setting("enable_custom_global_skin");
      $cc   =  st_get_setting("custom_global_skin");
      $skin ='';
      if($e_cc=='y'){
         $skin = ($cc!='') ?  $cc : $pc;
      }elseif($pc!=''){
          $skin = $pc;
      }
      
      $skin = str_replace('#','',esc_attr($skin));
      $skin = ($skin!='') ? $skin : 'bca474';
      
?>    
<style type="text/css">
/* CSS Skin */
a,.primary-nav ul li.current-menu-item a,.top-bar-right a:hover,.primary-nav ul li a:hover,.cpt-filters li a:hover,.cpt-filters li a.selected,
.blog-title a:hover,.sidebar .widget_nav_menu ul li a:hover,
.sidebar .widget_nav_menu ul li.current-menu-item a,.st-recent-posts ul li a:hover,.st-recent-posts .recent-date,.footer-social li a:hover,
.tab-title li.current,  .cpt-detail .cpt-title
{	
    color:#<?php echo $skin; ?>;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;

}

input[type="reset"], input[type="submit"], input[type="button"], button,.footer-social li a:hover,.btn_default,.acc-title-active,.toggle_current,
.st-pagination li a:hover,.ui-datepicker-calendar .ui-state-hover,.ui-datepicker-calendar .ui-state-active,.go-detail,.go-gallery,
.color ,  .st-pagination li a.page-current,   .st-pagination  li .page-numbers.current , table#wp-calendar thead > tr > th,  table#wp-calendar td#today,
.bg_color:hover,
.woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button,
.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
        background-color: #<?php echo $skin; ?>; 
        -o-transition:.5s;
        -ms-transition:.5s;
        -moz-transition:.5s;
        -webkit-transition:.5s;
}
  
<?php if(st_is_woocommerce()){ ?>
 .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle
    {	background: #<?php echo $skin; ?>;  }
<?php } ?>
  
.flickr_badge_image img:hover, .footer-sidebar .flickr_badge_image img:hover  { border-color:  #<?php echo $skin; ?>;}
<?php
    for($i=1; $i<=6; $i++){
         $h = st_get_setting("heading_".$i,array());
         if(intval($h['font-size'])>0){
            echo "h{$i}{ font-size: ".intval($h['font-size'])."px;} \n";
         }
    }
   ?>
</style>
<?php
}

// add to wp_head
add_action('wp_head','st_theme_font',90);
add_action('wp_head','st_theme_body_bg',91);
add_action('wp_head','st_theme_header_bg',92);

function st_header_tracking_code(){
    $code = st_get_setting('headder_tracking_code','');
    $code = stripslashes($code);
    if(is_string($code)){
         echo $code;
    }
}

function st_footer_tracking_code(){
    $code = st_get_setting('footer_tracking_code','');
    $code = stripslashes($code);
    if(is_string($code)){
         echo $code;
    }
}

add_action('wp_head','st_header_tracking_code',123);
add_action('wp_footer','st_footer_tracking_code',123);



/**
 * Display  Reservation Button 
*/
function st_head_reservation_btn($echo = true){
    $html = '';
    // if show this button
    if(st_get_setting("show_head_reservation_btn",'y')!='n'){
         $url = st_get_setting('reservation_btn_link','#');
         $text =st_get_setting('reservation_btn_txt',__('Reservation','smooththemes'));
         $skin = st_get_setting('reservation_btn_skin');
         $is_custom =  st_get_setting('reservation_btn_custom_skin','n');
         $custom_c = st_get_setting('reservation_btn_color');
         
         if($is_custom!='n'){
             $custom_c  =  ($custom_c!='') ?  $custom_c :  $skin;
         }else{
            $custom_c =  $skin;
         }
         
         $btn_attr =' class="btn btn_green" ';
         if($custom_c!=''){
             $btn_attr =' class="btn"  style="background-color: #'.esc_attr($custom_c).'; " ';
         }
         
         $html ='<span class="res-btn-w"><a'.$btn_attr.'href="'.$url.'"><i class="date_icon"></i> '.esc_html($text).'</a></span>';
         
    }
    
    if($echo){
         echo $html;
         return '';
    }else{
         return $html;
    }
    
}
    

/* Back to top buttn*/
 function st_back_totop(){
     echo '<div id="sttotop" class="bg_color"><i class="icon-angle-up"></i></div>';
 }
 add_action('wp_footer','st_back_totop');

