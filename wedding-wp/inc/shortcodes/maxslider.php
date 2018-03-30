<?php 
function  webnus_maxslider_shortcode($attributes, $content)
{


    extract(
            shortcode_atts(
                    array(  
            'slide1_img_url'=>'',
            'slide2_img_url'=>'',
            'slide3_img_url'=>'',
            'slide4_img_url'=>'',
            'slide5_img_url'=>'',
            'slide_img_pattern'=>'true',
            'slide_img_parallax'=>'true',
            'id'=>''
                         )
            , $attributes));
            
   
    if(is_numeric($slide1_img_url))
        $slide1_img_url = wp_get_attachment_url( $slide1_img_url );
    if(is_numeric($slide2_img_url))
        $slide2_img_url = wp_get_attachment_url( $slide2_img_url );
    if(is_numeric($slide3_img_url))
        $slide3_img_url = wp_get_attachment_url( $slide3_img_url );
    if(is_numeric($slide4_img_url))
        $slide4_img_url = wp_get_attachment_url( $slide4_img_url );
    if(is_numeric($slide5_img_url))
        $slide5_img_url = wp_get_attachment_url( $slide5_img_url );
        
        
    
    if(!empty($id))
     $out = '</div></section><section id="'.$id.'" class="max-hero maxslider">';
    else  
     $out = '</div></section><section class="max-hero maxslider">';
    $out .= '<div class="slides-control"><div class="slides-container';
    if( 'true' == $slide_img_pattern )
    $out .= ' spattern ';
    if( 'true' == $slide_img_parallax )
    $out .= ' sparallax';
    $out .= '">';
    if(!empty($slide1_img_url))
    $out .= '<div class="slide1 slide-image" style="background-image: url(\''.$slide1_img_url.'\')"></div>';
    if(!empty($slide2_img_url))
    $out .= '<div class="slide2 slide-image" style="background-image: url(\''.$slide2_img_url.'\')"></div>';
    if(!empty($slide3_img_url))  
    $out .= '<div class="slide3 slide-image" style="background-image: url(\''.$slide3_img_url.'\')"></div>';
    if(!empty($slide4_img_url))  
    $out .= '<div class="slide4 slide-image" style="background-image: url(\''.$slide4_img_url.'\')"></div>'; 
    if(!empty($slide5_img_url))  
    $out .= '<div class="slide5 slide-image" style="background-image: url(\''.$slide5_img_url.'\')"></div>';        
    $out .= '</div></div>'; 
    $out .= '<nav class="slides-navigation"><a href="#" class="next"></a><a href="#" class="prev"></a></nav>';
    $out .= '<div class="slides-content"><div class="container">';
    $out .= do_shortcode($content);
    $out .= '</div></div></section>'; 
    $out .= '<section class="container"><div class="row-wrapper-x">';
    
    return $out;
}
add_shortcode("maxslider", 'webnus_maxslider_shortcode');
?>