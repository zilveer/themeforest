<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();



$svg_icon = Mk_SVG_Icons::get_svg_icon_by_class_name(false, $icon, $icon_size);
$icon_output = empty($svg_icon) ? '<i style="font-size:'.$icon_size.'px" class="'.$icon.'"></i>' : $svg_icon;

$output = $app_styles = '';

$output .= '<div id="mk-icon-box-'.$id.'" class="mk-box-icon-2 '.$el_class.' box-align-'.$align.' '.get_viewport_animation_class($animation).'">';
if ($icon_type == 'icon'){
	$app_styles = '
		#mk-icon-box-'.$id.' .mk-box-icon-2-icon {
		    '.($icon_color ? ('color:'.$icon_color.'!important;') : '').($icon_background_color ? ('background-color:'.$icon_background_color.';') : '').($icon_border_color ? ('border:1px solid '.$icon_border_color.';') : '').'
		}
		#mk-icon-box-'.$id.' .mk-box-icon-2-icon a {
		    '.($icon_color ? ('color:'.$icon_color.'!important;') : '').';
		}
		#mk-icon-box-'.$id.' .mk-box-icon-2-icon:hover{
		    '.($icon_hover_color ? ('color:'.$icon_hover_color.' !important;') : '').($icon_hover_background_color ? ('background-color:'.$icon_hover_background_color.';') : '').($icon_hover_border_color ? ('border:1px solid '.$icon_hover_border_color.';') : '').'
		}
		#mk-icon-box-'.$id.' .mk-box-icon-2-icon:hover a {
		    '.($icon_hover_color ? ('color:'.$icon_hover_color.'!important;') : '').';
		}
	';

	$output .= '    <div class="mk-box-icon-2-icon size-'.$icon_size.'">';
	$output .= !empty( $read_more_url ) ? '<a href="'.$read_more_url.'" target="'.$link_target.'">' : '';
	$output .= '        '.$icon_output.' ';
	$output .= !empty( $read_more_url ) ? '</a>' : '';
	$output .= '    </div>';
}else{
	$icon_size = ($icon_size !='inherit') ? ('width:'.$icon_size.'px;') : '';
	$output .= '    <div class="mk-box-icon-2-image" style="'.$icon_size.'">';
	$output .= !empty( $read_more_url ) ? '<a href="'.$read_more_url.'" target="'.$link_target.'">' : '';
	$output .= '        <img src="'.$icon_image.'" alt="'.$title.'" />';
	$output .= !empty( $read_more_url ) ? '</a>' : '';
	$output .= '    </div>';
}

	$output .= !empty( $read_more_url ) ? '<a href="'.$read_more_url.'" target="'.$link_target.'">' : '';
	$output .= '    <h3 class="mk-box-icon-2-title">'.$title.'</h3>';
	$output .= !empty( $read_more_url ) ? '</a>' : '';
	$output .= '    <p class="mk-box-icon-2-content">'.$content.'</p>';
	$output .= '</div>';

$app_styles .= '
	#mk-icon-box-'.$id.' .mk-box-icon-2-title {
		font-weight:'.$title_weight.';
		font-size:'.$title_size.'px;
		color:'.$title_color.'; 
		padding:'.$title_top_padding.'px 0 '.$title_bottom_padding.'px 0;
	}
	#mk-icon-box-'.$id.' .mk-box-icon-2-content {
		color:'.$description_color.'; 
	}
';

Mk_Static_Files::addCSS($app_styles, $id);

echo $output;
