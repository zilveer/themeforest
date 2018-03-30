<?php

extract( shortcode_atts( array(
			'el_class' => '',
			'icon' => '',
			'divider_width' => 'full_width',
			'custom_width' => 10,
			'align' => 'center',
			'style' => 'single',
			'divider_color' => '',
			'margin_top' => 20,
			'thickness' => 2,
			'margin_bottom' => 20,

		), $atts ) );
$output = $custom_css = $align_css = '';

$custom_css = $divider_width == 'custom_width' ? 'width:'.$custom_width.'px;' : '';

if($align == 'left'){
	$align_css = '';
}else if ($align == 'center') {
	$align_css = 'margin: 0 auto;';	
}else{
	$align_css = 'margin: 0 0 0 auto;';
}

$style_id = Mk_Static_Files::shortcode_id();


if($style == 'single'){
	
	Mk_Static_Files::addCSS('
        #divider-'.$style_id.' .divider-inner{
            border-width:'.$thickness.'px;
            height:'.$thickness.'px;
            '.$custom_css.'
            '.$align_css.'
        }
    ', $style_id);	

}else{

	Mk_Static_Files::addCSS('
        #divider-'.$style_id.' .divider-inner{
            '.$custom_css.'
            '.$align_css.'
        }
    ', $style_id);

}

$output .= '<div id="divider-'.$style_id.'" style="padding: '.$margin_top.'px 0 '.$margin_bottom.'px;" class="mk-divider divider_'.$divider_width.' divider-'.$style.' '.$el_class.'">';

	$border_color = (!empty($divider_color)) ? (' style="border-color:'.$divider_color.'"') : '';
	$output .= '<div'.$border_color.' class="divider-inner"></div>';
$output .= '</div><div class="clearboth"></div>';


echo $output;

