<?php
extract( shortcode_atts( array(
	'el_width' => '',
	'style' => '',
	'color' => '',
	'separator_arrow' => '',
	'separator_arrow_type'=>'',
	'arrow_color'=>'',
	'arrow_width' =>'12',
	'arrow_image' => '',
	'border_width'=>'1',
	'accent_color' => '',
	'icon_class'=>'',
	'icon_bg'=>'',
	'icon_width'=>'',
	'icon_height'=>'',
	'icon_border_color'=>'',
	'icon_border_style'=>'',
	'icon_border_width'=>'',
	'icon_border_radius'=>'',
	'separator_arrow_type_link' => '0',
	'separator_arrow_type_link_id' => '',
	'el_class' => ''
), $atts ) );

if($color == 'custom'){
	$color = $accent_color;
}

if(!$arrow_color){
	$arrow_color = $color;
}
$arrow = '';
if($separator_arrow == 'yes'){
    $arrow_style = ' style="z-index:1;';
    $arrow_style .= $arrow_color ? 'color:'.$arrow_color.';' : '';
    $arrow_style .= $icon_bg ? 'background-color:'.$icon_bg.';' : '';
    $arrow_style .= $arrow_width ? 'font-size:'.$arrow_width.';' : '';
    $arrow_style .= $icon_width ? 'width:'.$icon_width.';' : '';
    $arrow_style .= $icon_height ? 'height:'.$icon_height.';line-height:'.$icon_height.';' : '';
    $arrow_style .= $icon_border_color ? 'border-color:'.$icon_border_color.';' : '';
    $arrow_style .= $icon_border_style ? 'border-style:'.$icon_border_style.';' : '';
    $arrow_style .= $icon_border_width ? 'border-width:'.$icon_border_width.';' : '';
    $arrow_style .= $icon_border_radius ? 'border-radius:'.$icon_border_radius.';' : '';
    $arrow_style .= '"';
    switch ($separator_arrow_type){
        case 'icon':
            $arrow .= '<i class="arrow '.$icon_class.'"'.$arrow_style.'></i>';
            if($separator_arrow_type_link){
            	$arrow = '<a class="back_to_top" href="#'.$separator_arrow_type_link_id.'"><i class="arrow '.$icon_class.'"'.$arrow_style.'></i></a>';
            }
            break;
        case 'image':
            if($arrow_image){
                $arrow_image = wp_get_attachment_url($arrow_image);
                $arrow .= '<img class="arrow" src="'.$arrow_image.'" alt=""'.$arrow_style.'>';
            }
            if($separator_arrow_type_link){
            	$arrow = '<a class="back_to_top" href="#'.$separator_arrow_type_link_id.'"><img class="arrow" src="'.$arrow_image.'" alt=""'.$arrow_style.'></a>';
            }
            break;
        default:
            $arrow .= '<span class="arrow" style="border-width: '.$arrow_width.'px; border-color:'.$arrow_color.' transparent  transparent;"></span>';
            if($separator_arrow_type_link){
            	$arrow = '<a class="back_to_top" href="#'.$separator_arrow_type_link_id.'"><span class="arrow" style="border-width: '.$arrow_width.'px; border-color:'.$arrow_color.' transparent  transparent;"></span></a>';
            }
            break;
    }
}

$class = "vc_separator no-text wpb_content_element";
$class .= ($el_width!='') ? ' vc_el_width_'.$el_width : ' vc_el_width_100';
$border_style='';
if($style =='') $border_style = 'solid';
$inline_css = 'style="display:block; width:100%; border-style:'.$border_style.';border-color:'.esc_attr($color).';border-width: '.esc_attr($border_width).'px 0 0 0;"';

$class .= $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );
?>
<div class="<?php echo esc_attr(trim($css_class)); ?>">
	<span class="vc_sep_holder vc_sep_holder_l <?php if($separator_arrow == 'yes'){ echo 'separator_arrow'; } ?>">
		<span <?php echo $inline_css; ?> class="">
			<?php echo $arrow; ?>
		</span>
	</span>
</div>