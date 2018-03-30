<?php

extract( shortcode_atts( array(
			'el_class' => '',
			'color' => '#393836',
			"size" => 14,
			'font_weight' => 'inherit',
			'text_transform' => '',
			'margin_top' => 10,
			'margin_bottom' => 10,
			"align" => 'left',
			"border_width" => 3,
			"border_color" => '',
			'animation' => '',
			"font_family" => '',
			'tag_name' => 'h3',
			"font_type" => '',
			'style'=> 'simple',
			'corner_style'=> 'pointed',
			'letter_spacing' => 0,
			'responsive_align' => 'center',
			'line_height' => 24
		), $atts ) );

$id = Mk_Static_Files::shortcode_id();


$output = $stroke_style_css = '';

$animation_css = ($animation != '') ? ' mk-animate-element ' . $animation . ' ' : '';

global $mk_accent_color, $mk_settings;

$color = ($color == $mk_settings['accent-color']) ? $mk_accent_color : $color;
$corner = $style == 'stroke' ? (!empty($corner_style)) ? $corner_style : 'pointed'  : 'pointed';

$output .= mk_get_fontfamily( "#fancy-title-", $id, $font_family, $font_type );

$line_height = ($line_height < $size) ? '100%' : ($line_height.'px');
$txt_transform = ($text_transform != '') ? ('text-transform:'.$text_transform.'; ') : '';

if($style == 'stroke') {
	$border_color = $border_color ? $border_color : $color;
	$stroke_style_css = 'style="border:'.$border_width.'px solid '.$border_color.';"';
}
$font_size_res = ($size > 36) ? ' fancy-title-responsive-title' : '';

$output .= '<'.$tag_name.'  style="font-size: '.$size.'px;text-align:'.$align.';line-height:'.$line_height.';letter-spacing:'.$letter_spacing.'px;color: '.$color.';font-weight:'.$font_weight.';margin-bottom:'.$margin_bottom.'px; margin-top:'.$margin_top.'px; '.$txt_transform.'" id="fancy-title-'.$id.'" class="mk-fancy-title responsive-align-'.$responsive_align.$font_size_res.' '.$style.'-title '.$align.'-align '.$animation_css.' '.$el_class.'"><span class="fancy-title-span '.$corner.'" '.$stroke_style_css.'>' . wpb_js_remove_wpautop( $content ). '</span></'.$tag_name.'>';


echo $output;

Mk_Static_Files::addCSS('
	#fancy-title-'.$id.' a{
		color: '.$color.';
	}'
, $id);


if($style == 'alt') {
	Mk_Static_Files::addCSS('
        #fancy-title-'.$id.':after{
            background-color:'.mk_convert_rgba($color, 0.4).';
            height:'.$border_width.'px !important;
        }
    ', $id);
}

if($style == 'avantgarde') {
	Mk_Static_Files::addCSS('
        #fancy-title-'.$id.':after, #fancy-title-'.$id.':before {
            background-color:'.mk_convert_rgba($color, 0.4).';
            height:'.$border_width.'px !important;
        }
	', $id);
}

if($style == 'standard') {
	Mk_Static_Files::addCSS('
		#fancy-title-'.$id.' span{
			border-color:'.$color.';
			border-width:'.$border_width.'px !important;
		}
        #fancy-title-'.$id.':after, #fancy-title-'.$id.':before {
	        background-color:'.$color.';
	        height:'.$border_width.'px !important;
	    }
	', $id);
}

if($style == 'stroke') {
	Mk_Static_Files::addCSS('
		#fancy-title-'.$id.' span.rounded{
			border-radius:3px;
		}
		#fancy-title-'.$id.' span.full_rounded{
			border-radius:50px;
		}
	', $id);
}

if($style == 'underline') {
	Mk_Static_Files::addCSS('
        #fancy-title-'.$id.' span:after{
            background-color:'.$color.';
            height:'.$border_width.'px !important;
        }
    ', $id);
}