<?php 

/**
 * Display slider as type
 * 
 *  'layerslider'=>"Layer slider",
    'revslider'=>'Revolution Slider',
    'elasticslideshow'=>'Elastic Slide show', 
    'nivo'=>'Nivo Slider',
    'flexslider'=>'Flex Slider'
 * 
 */
function st_the_slider($page_builder_data, $must_show = false, $is_top_slider = false){
    // if empty data 
     if(!isset($page_builder_data) || empty($page_builder_data)){
        return ;
     }
     // if not show  slider
    
     if( (boolean) $must_show== false){
        if( (!isset($page_builder_data['show_top_slider'])  || $page_builder_data['show_top_slider']!=1) &&  (!isset($page_builder_data['show_slider']) || $page_builder_data['show_slider']!=1 ) ){
         return ;
        }
     }
     
    $img_size = (isset($page_builder_data['size'])  && $page_builder_data['size']!='' ) ? $page_builder_data['size']  : false;
    

     $img_size = ($img_size) ?  $img_size : 'st_medium';

    if(isset($page_builder_data['slider_full_w'])  && $page_builder_data['slider_full_w']==1 ){
        $class="slider-no-boxed";
        
    }elseif(in_array($page_builder_data['slider_type'], array('flexslider','titlebar','statichtml' )) ) {
        $class="slider-boxed";
    }
    
    $class = (!$is_top_slider) ? $class.='-in' : $class;
    
     echo ($is_top_slider) ? ' <div class="slider-outer-wrapper '.$class.'">  <div class="main_slider">' : '';
    
    switch(strtolower($page_builder_data['slider_type'])){
          case  'layerslider' :
              $id = intval($page_builder_data['layerslider']);
              if($id>0){
                   echo  do_shortcode('[layerslider id="'.$id.'"]');
              }
          break;
          
          case  'revslider' :
              echo '<div class="'.$class.'">';
              $id = $page_builder_data['revslider'];
              if($id!=''){
                   echo  do_shortcode('[rev_slider '.$id.']');
              }
               echo '</div>';
          break;
          
          case 'nivo':
                $data= $page_builder_data;
                 echo '<div class="'.$class.'">';
                if(is_file(ST_TEMPLATE_DIR.'/sliders/nivo.php')){
                    include(ST_TEMPLATE_DIR.'/sliders/nivo.php');
                }
                 echo '</div>';
          break;
          
          case 'elasticslideshow':
                $data= $page_builder_data;
                echo '<div class="'.$class.'">';
                if(is_file(ST_TEMPLATE_DIR.'/sliders/elastic.php')){
                    include(ST_TEMPLATE_DIR.'/sliders/elastic.php');
                }
                echo '</div>';
          break;
          
           case 'flexslider':
             $img_size ='';
           
                if($is_top_slider){
                    $class .=' top-page-flexslider';
                    $img_size ='full';
                    $settings['show_caption']='yes';
                }
                
                echo '<div class="'.$class.'">' ;
                
                $data= $page_builder_data;
                if(is_file(ST_TEMPLATE_DIR.'/sliders/flex.php')){
                    include(ST_TEMPLATE_DIR.'/sliders/flex.php');
                }
                
                echo  '</div>' ;
          break;
          
          
          case 'titlebar':
                  $data = (isset($page_builder_data['titlebar'] )) ?  $page_builder_data['titlebar'] : array('img'=>'','title'=>'','desc'=>'');
                   echo '<div class="'.$class.' titlebar-wrap">';
                      if(is_file(ST_TEMPLATE_DIR.'/sliders/titlebar.php')){
                            include(ST_TEMPLATE_DIR.'/sliders/titlebar.php');
                        }
                   echo '</div>';
          break;
          
          case 'statichtml':
                   echo '<div class="'.$class.'">';
                       echo '<div class="statichtml statichtml-slider">'."\n";
                       echo stripcslashes($page_builder_data['statichtml']);
                       echo '</div>'."\n";
                   echo '</div>';
          break;
           
    }
    
     echo  ($is_top_slider)  ? ' </div>  <div class="shadow-box"></div> </div>' : '';
        
}
