<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = '';
extract( shortcode_atts( array(
	'target' => '_self',
	'href' => '',
	'title' => __( 'Text on the button', "js_composer" ),
	'btn_type' => '',
	'btn_size' => '',
	'btn_color' => '',
	'btn_border' => '',
	'btn_layout' => '',
	'btn_group' => '',
	'btn_use' => 'anchor',
	'btn_dis_ena' => '',
	'btn_block_just' => 'Simple'
), $atts ) );

if ( $target == 'same' || $target == '_self' ) {
	$target = '';
}
$target = ( $target != '' ) ? ' target="' . $target . '"' : '';
$size = $border = $blk = $enb_dis = '';
if($btn_size == 'large'){
	$size = 'btn-lg';
}elseif($btn_size == 'small'){
	$size = 'btn-sm';
}elseif($btn_size == 'mini'){
	$size = 'btn-xs';
}
if($btn_border == 'yes'){
	$border = 'btn-border';
}  
if($btn_layout == 'Large Radius'){
	$btn_layout = ' radius-lg';
}elseif($btn_layout == 'Larger Radius'){
	$btn_layout = ' radius-lger';
}elseif($btn_layout == 'Square'){
	$btn_layout = '';
}
if($btn_block_just == 'Block'){
	$blk = ' btn-block';
}
if($btn_dis_ena == 'Disable'){
	$enb_dis = 'disabled="disabled"';
}
if($btn_block_just == 'Simple' || $btn_block_just == 'Block'){
	if($btn_use == 'anchor'){
		if ( $href != '' ) {
			$output = '<a class="btn btn-'.$btn_type.$btn_layout.$blk.' '.$border.' '.$size.'" title="' . $title . '" href="' . $href . '"' . $target . ' '.$enb_dis.'>' . $title . '</a>';
		}else{
			$output = '<a class="btn btn-'.$btn_type.$btn_layout.$blk.' '.$border.' '.$size.'" title="' . $title . '" href="#"' . $target . ' '.$enb_dis.'>' . $title . '</a>';
		}
	}else{
		$output .= '<button type="button" class="btn btn-'.$btn_type.$btn_layout.' '.$border.' '.$size.'" '.$enb_dis.'>' . $title . '</button>';
	}
}else{
	if($btn_block_just == 'Justified'){
		$output = '<div class="btn-group btn-group-justified">';
	}else{
		$output = '<div class="btn-group">';
	}
	$title = explode(',',$title);
	$btn_group = explode(',',$btn_group);
	for($i=0;$i<count($btn_group);$i++){
		if(empty($title[$i])){
			$tl = 'empty';
		}else{
			$tl = $title[$i];
		}
		if($btn_use == 'anchor'){
			if ( $href != '' ) {
				$output .= '<a class="btn btn-'.$btn_group[$i].$btn_layout.' '.$border.' '.$size.'" title="' . $title . '" href="' . $href . '"' . $target . ' '.$enb_dis.'>' . $tl . '</a>';
			}else{
				$output .= '<a class="btn btn-'.$btn_group[$i].$btn_layout.' '.$border.' '.$size.'" title="' . $title . '" href="#"' . $target . ' '.$enb_dis.'>' . $tl . '</a>';
			}	
		}else{
			$output .= '<div class="btn-group"><button type="button" class="btn btn-'.$btn_group[$i].$btn_layout.' '.$border.' '.$size.'" '.$enb_dis.' >' . $tl . '</button></div>';
		}
	}
	$output .= '</div>';
}

echo $output . $this->endBlockComment( 'button' ) . "\n";