<?php 
global $mk_settings;

extract( shortcode_atts( array(
      'text' => '',
      'text_align' => 'left',
      'font_family' => '',
      'font_type' => '',
      'font_size' => '14',
      'font_weight' => 'inherit',
      'start_color' => $mk_settings['accent-color'],
      'end_color' => '#ccc',
      'gradient_style' => 'vertical',
      'el_class' =>'',
), $atts ) );

$style_id = Mk_Static_Files::shortcode_id();

$output = $style_orientation = $svg_height =  $align_styles =  '';


/* Styling */

$output .= mk_get_fontfamily( "#gradient-", $style_id, $font_family, $font_type );

$svg_height = $font_size + 10;

if($text_align == 'left'){
	$align_styles = 'x="0" style="text-anchor: start;"';
}else if($text_align == 'center'){
	$align_styles = 'x="50%" style="text-anchor: middle;"';
}else if($text_align == 'right'){
	$align_styles = 'x="100%" style="text-anchor: end;"';
}



/* SVG */
if($gradient_style == 'vertical'){
	$style_orientation = '
        <svg id="gradient-'.$style_id.'" height="'.$svg_height.'px">
		  <defs>
		    <linearGradient id="grad-'.$style_id.'" x1="0%" y1="0%" x2="0%" y2="100%">
		      <stop offset="0%" style="stop-color:'.$start_color.';stop-opacity:1" />
		      <stop offset="100%" style="stop-color:'.$end_color.';stop-opacity:1" />
		    </linearGradient>
		  </defs>
		  <text y="0.8em" '.$align_styles.' >'.$text.'</text>
		</svg>
    ';
}else if($gradient_style == 'horizontal'){
	$style_orientation = '
		<svg id="gradient-'.$style_id.'" height="'.$svg_height.'px">
		  <defs>
		    <linearGradient id="grad-'.$style_id.'" x1="0%" y1="0%" x2="100%" y2="0%">
		      <stop offset="0%" style="stop-color:'.$start_color.';stop-opacity:1" />
		      <stop offset="100%" style="stop-color:'.$end_color.';stop-opacity:1" />
		    </linearGradient>
		  </defs>
		  <text y="0.8em" '.$align_styles.'>'.$text.'</text>
		</svg>';
}else if($gradient_style == 'radial'){
	$style_orientation = '
		<svg id="gradient-'.$style_id.'" height="'.$svg_height.'px">
		  <defs>
		    <radialGradient id="grad-'.$style_id.'" cx="50%" cy="50%" r="100%" fx="50%" fy="50%">
		      <stop offset="0%" style="stop-color:'.$start_color.'; stop-opacity:0" />
		      <stop offset="100%" style="stop-color:'.$end_color.'; stop-opacity:1" />
		    </radialGradient>
		  </defs>
		  <text y="0.8em" '.$align_styles.'>'.$text.'</text>
		</svg>';
}

/* Styles */

Mk_Static_Files::addCSS('
    #gradient-'.$style_id.' {
        font-size:'.$font_size.'px;
        font-weight:'.$font_weight.';
        width:100%;
    }
    #gradient-'.$style_id.' text{
    	fill: url("#grad-'.$style_id.'");
    	alignment-baseline:central;
	}
', $style_id);

/* Html Output */
$output .= '<div class="mk-gradient-text gradient-'.$style_id.' '.$gradient_style.'-orientation '.$text_align.'-align '.$el_class.'">';
$output .= 		$style_orientation;
$output .= '</div>';



echo $output;