<?php

function  bloxdark_shortcode($attributes, $content)
{

    extract(
            shortcode_atts(
                    array(  
                        "img" => '',
                        "height" => '',
                        'padding_top'  => 0,
                        'padding_bottom'  => 0,
						'bg_attachment' =>'false',
						'bg_position' =>'center center',
						'bgcover'=>'true',
						'repeat'=>'no-repeat',
						'dark'=>'false',
						'class'=>'',
						'bgcolor'=>'',
						'row_color'=>'',				
						'id'=>''
                         )
            , $attributes));
			
		
	if(is_numeric($img)){
		
		$img = wp_get_attachment_url( $img );
		
	}
	
   
	
	$fixed = ($bg_attachment == 'true')? 'fixed' : '';
	$background_style = !empty($img)?" background: url('{$img}') {$repeat} {$fixed}; background-position: {$bg_position}":'';
	$background_size = 	($bgcover=='true')? 'background-size: cover;':''; 
	
	$w_height = ltrim ($height);
	if(substr($w_height,-2,2)=="px")
		$height_style = " min-height:{$w_height}; ";
	else
		$height_style = " min-height:{$w_height}px; ";
	
	$padding_top = ltrim ($padding_top);
	$padding_top = (substr($padding_top,-2,2)=="px")? $padding_top : $padding_top.'px';

	$padding_bottom = ltrim ($padding_bottom);
	$padding_bottom = (substr($padding_bottom,-2,2)=="px")? $padding_bottom : $padding_bottom.'px';
	
	$padding_style= " padding-top:{$padding_top}; padding-bottom:{$padding_bottom}; ";
	
	if(!empty($bgcolor))
		$bgcolor = 'background-color:' . $bgcolor . ';';
    
	$is_dark = ( 'true' == $dark )? ' dark ' : '';
	if(!empty($id))
   		$out = '</div></section><section id="'.$id.'" class="blox dark '.$is_dark.$class .'" style="'.$padding_style.$background_style.$background_size.$height_style.$bgcolor.'"><div class="max-overlay"></div><div class="wpb_row vc_row-fluid full-row"><div class="container">';
	else
		$out = '</div></section><section class="blox dark '.$is_dark.$class .'" style="'.$padding_style.$background_style.$background_size.$height_style.$bgcolor.'"><div class="max-overlay"></div><div class="wpb_row vc_row-fluid full-row"><div class="container">';
    $out .= do_shortcode($content); 
    $out .= '</div></div></section><section class="container"><div class="row-wrapper-x">';
	
    return $out;
}
add_shortcode("bloxdark", 'bloxdark_shortcode');




function  blox_shortcode($attributes, $content)
{


    extract(
            shortcode_atts(
                    array(  
                        "img" => '',
                        "height" => '',
                        'padding_top'  => 0,
                        'padding_bottom'  => 0,
						'bg_attachment' =>'false',
						'bg_position' =>'center center',
						'bgcover'=>'true',
						'repeat'=>'no-repeat',
						'dark'=>'false',
						'class'=>'',
						'bgcolor'=>'',
						'row_pattern'=>'',
						'row_color'=>'',
						'id'=>''
                         )
            , $attributes));
			
		
	
		if(is_numeric($img)){
		
		$img = wp_get_attachment_url( $img );
		
	}
   
	
	$fixed = ($bg_attachment == 'true')? 'fixed' : '';
	$background_style = !empty($img)?" background: url('{$img}') {$repeat} {$fixed}; background-position: {$bg_position};":'';
	$background_size = 	($bgcover=='true')? 'background-size: cover;':'';
	
	$w_height = ltrim ($height);
	if(substr($w_height,-2,2)=="px")
		$height_style = " min-height:{$w_height}; ";
	else
		$height_style = " min-height:{$w_height}px; ";
	
	$padding_top = ltrim ($padding_top);
	$padding_top = (substr($padding_top,-2,2)=="px")? $padding_top : $padding_top.'px';

	$padding_bottom = ltrim ($padding_bottom);
	$padding_bottom = (substr($padding_bottom,-2,2)=="px")? $padding_bottom : $padding_bottom.'px';
	
	$padding_style= " padding-top:{$padding_top}; padding-bottom:{$padding_bottom}; ";
	
	if(!empty($bgcolor))
		$bgcolor = ' background-color:' . $bgcolor . ';';
    
	$is_dark = ( 'true' == $dark )? ' dark ' : '';
	
	
	
	$color_overlay = 'background-color:' . $row_color;

	if(!empty($id))
    $out = '</div></section><section id="'.$id.'" class="blox '.$is_dark.$class.' '.$row_pattern .'" style="'.$padding_style.$background_style.$background_size.$height_style.$bgcolor.'"><div class="max-overlay" style="'.  $color_overlay .'"></div><div class="wpb_row vc_row-fluid full-row"><div class="container">';
	else
    $out = '</div></section><section class="blox '.$is_dark.$class.' '.$row_pattern .'" style="'.$padding_style.$background_style.$background_size.$height_style.$bgcolor.'"><div class="max-overlay" style="'.  $color_overlay .'"></div><div class="wpb_row vc_row-fluid full-row"><div class="container">';
    $out .= do_shortcode($content); 
    $out .= '</div></div></section><section class="container"><div class="row-wrapper-x">';
	
    return $out;
}
add_shortcode("blox", 'blox_shortcode');