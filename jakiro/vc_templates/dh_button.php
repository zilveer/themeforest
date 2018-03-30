<?php
$output = '';
extract( shortcode_atts( array(
	'title' 				=> esc_html__( 'Button', 'jakiro' ),
	'href' 					=> '',
	'target'				=>'_self',
	'style'					=>'',
	'size'					=>'',
	'font_size'				=>'14',
	'border_width'			=>'1',
	'padding_top'			=>'6',
	'padding_right'			=>'30',
	'padding_bottom'		=>'6',
	'padding_left'			=>'30',
	'color'					=>'default',
	'background_color'		=>'',
	'border_color'			=>'',
	'text_color'			=>'',
	'hover_background_color'=>'',
	'hover_border_color'	=>'',
	'hover_text_color'		=>'',
	'block_button'			=>'',
	'icon'                  =>'',
	'icon_position'			=>'left',
	'alignment'				=>'left',
	'tooltip'				=>'',
	'tooltip_position'		=>'top',
	'tooltip_title'			=>'',
	'tooltip_content'		=>'',
	'tooltip_trigger'		=>'hover',
	'visibility'			=>'',
	'el_class'				=>'',
), $atts ) );

$el_class  = !empty($el_class) ? ' '.esc_attr( $el_class ) : '';
$el_class .= dh_visibility_class($visibility);

if ( $target == 'same' || $target == '_self' ) {
	$target = '';
}
$target = ( $target != '' ) ? ' target="' . $target . '"' : '';
$inline_style = '';
$btn_size = '';
if($size == 'custom'){
	$inline_style .= 'padding:'.$padding_top.'px '.$padding_right.'px '.$padding_bottom.'px '.$padding_left.'px;border-width:'.$border_width.'px;font-size:'.$font_size.'px;';
}elseif(!empty($size)){
	$btn_size = ' btn-'.$size;
}
$btn_color = '';
$data_cusotom_color='';
$btn_style = ($style=="outline" && $color == 'default' ? ' btn-outline ':'');
$btn_effect = '';

if($color == 'custom'){
	$inline_style .='background-color:'.$background_color.';border-color:'.$border_color.';color:'.$text_color;
	$btn_color = ' btn-custom-color';
	$hover_background_color = dh_format_color($hover_background_color);
	$hover_border_color = dh_format_color($hover_border_color);
	$hover_text_color = dh_format_color($hover_text_color);
	$data_cusotom_color .= ' data-hover-background-color="'.$hover_background_color.'" data-hover-border-color="'.$hover_border_color.'" data-hover-color="'.$hover_text_color.'"';
}else{
	if($style=="outline"){
		$btn_color = ' btn-'.$color.'-outline';
	}else{
		$btn_color = ' btn-'.$color;
	}
	
}
$btn_class = '';
if($style == 'link'){
	$btn_class = ' btn-link ';
	$btn_class .= ' text-'.$color;
	
	if(empty($href))
		$href='#';
	
} else if($style == 'half_bg'){
	
		$btn_class = ' btn-half-bg ';
		$btn_class .= ' text-'.$color;
		
		if(empty($href))
			$href='#';

}else{
	$btn_class = 'btn'.$btn_color;
}
$btn_class .= (!empty($text_uppercase) ? ' btn-uppercase':'').(!empty($block_button)?' btn-block':'').$btn_size.$btn_style.$btn_effect.(empty($block_button) ? ' btn-align-'.$alignment: '') ;
$data_el = '';
$data_toggle ='';
$data_target='';
if(!empty($tooltip)){
	$data_toggle = $tooltip;
	$data_el = ' data-container="body" data-original-title="'.($tooltip === 'tooltip' ? esc_attr($tooltip_content) : esc_attr($tooltip_title)).'" data-trigger="'.$tooltip_trigger.'" data-placement="'.$tooltip_position.'" '.($tooltip === 'popover'?' data-content="'.esc_attr($tooltip_content).'"':'').'';
}
if(!empty($data_toggle)){
	$data_toggle = ' data-toggle="'.$data_toggle.'"';
}

$btn_content = '<span>'.$title.'</span>' ;
if(!empty($icon)){
	$el_class .= ' btn-has-icon ';
	$btn_content = ($icon_position == 'right' ? $btn_content.'<i class="'.$icon.'"></i>' : '<i class="'.$icon.'"></i>'.$btn_content );
}
if($href != ''){
	$output .='<a'.$data_el.$data_toggle.$data_target.' class="'.$btn_class.$el_class.'" href="'.esc_url($href).'" '.$target.$data_cusotom_color.''.(!empty($inline_style) ? ' style="'.$inline_style.'"': '').'>';
	$output .= $btn_content;
	$output .='</a>';
}else{
	$output .='<button'.$data_el.$data_toggle.$data_target.' class="'.$btn_class.$el_class.'" '.$data_cusotom_color.' type="button"'.(!empty($inline_style) ? ' style="'.$inline_style.'"': '').'>';
	$output .= $btn_content;
	$output .='</button>';
}

echo $output."\n";