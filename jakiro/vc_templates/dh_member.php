<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$description = vc_value_from_safe($description);

$el_class  = !empty($el_class) ? ' '.esc_attr( $el_class ) : '';
switch ($visibility) {
	case 'hidden-phone':
		$el_class .= ' hidden-xs';
		break;
	case 'hidden-tablet':
		$el_class .= ' hidden-sm hidden-md';
		break;
	case 'hidden-pc':
		$el_class .= ' hidden-lg';
		break;
	case 'visible-phone':
		$el_class .= ' visible-xs-inline';
		break;
	case 'visible-tablet':
		$el_class .= ' visible-sm-inline visible-md-inline';
		break;
	case 'visible-pc':
		$el_class .= ' visible-lg-inline';
		break;
}


$output .='<div class="team-member team-member-'.$style.$el_class.'">';
if(!empty($avatar)){
	$img = wpb_getImageBySize( array( 'attach_id' => $avatar, 'thumb_size' => array(600,600)));
	if ( $img == NULL ) $img['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
	
	$avatar_image = $img['thumbnail'];//wp_get_attachment_image_src($avatar,'dh-thumbnail-square');
	//$avatar_url = $avatar_image[0];
	$output .='<div class="member-avatar"'.(($style=='right') ? ' style="background-image:url('.wp_get_attachment_url($avatar).')"':'').'>';
	if($style!='right'){
		$output .=$avatar_image;
		$output .='<div class="overlay"></div>';
	}
	if($style == 'below' && (!empty($facebook) || !empty($twitter) || !empty($google) || !empty($linkedin))){
		$output .='<div class="member-meta">';
		if(!empty($facebook)){
			$output .='<span class="facebook">';
			$output .='<a href="'.esc_url($facebook).'" title="'.esc_html__('Facebook','jakiro').'" target="_blank"><i class="fa fa-facebook"></i></a>';
			$output .='</span>';
		}
		if(!empty($twitter)){
			$output .='<span class="twitter">';
			$output .='<a href="'.esc_url($twitter).'" title="'.esc_html__('Twitter','jakiro').'" target="_blank"><i class="fa fa-twitter"></i></a>';
			$output .='</span>';
		}
		if(!empty($google)){
			$output .='<span class="google">';
			$output .='<a href="'.esc_url($google).'" title="'.esc_html__('Google +','jakiro').'" target="_blank"><i class="fa fa-google"></i></a>';
			$output .='</span>';
		}
		if(!empty($linkedin)){
			$output .='<span class="linkedin">';
			$output .='<a href="'.esc_url($linkedin).'" title="'.esc_html__('Linked In','jakiro').'" target="_blank"><i class="fa fa-linkedin"></i></a>';
			$output .='</span>';
		}
		$output .='</div>';
	}
	$output .='</div>';
}
$output .='<div class="member-info">';
$output .='<div class="member-info-wrap">';
$output .='<div class="member-name">';
$output .='<h4>'.$name.'</h4>';
$output .='</div>';
if(!empty($job)){
	$output .='<div class="member-job">';
	$output .=$job;
	$output .='</div>';
}
if(!empty($description) && ($style == 'below' || $style=='right')){
	$output .='<div class="member-desc">';
	$output .=$description;
	$output .='</div>';
}
if(($style == 'overlay' ||  $style=='right') && (!empty($facebook) || !empty($twitter) || !empty($google) || !empty($linkedin))){
	$output .='<div class="member-meta">';
	if(!empty($facebook)){
		$output .='<span class="facebook">';
		$output .='<a href="'.esc_url($facebook).'" title="'.esc_html__('Facebook','jakiro').'" target="_blank"><i class="fa fa-facebook"></i></a>';
		$output .='</span>';
	}
	if(!empty($twitter)){
		$output .='<span class="twitter">';
		$output .='<a href="'.esc_url($twitter).'" title="'.esc_html__('Twitter','jakiro').'" target="_blank"><i class="fa fa-twitter"></i></a>';
		$output .='</span>';
	}
	if(!empty($google)){
		$output .='<span class="google">';
		$output .='<a href="'.esc_url($google).'" title="'.esc_html__('Google +','jakiro').'" target="_blank"><i class="fa fa-google"></i></a>';
		$output .='</span>';
	}
	if(!empty($linkedin)){
		$output .='<span class="linkedin">';
		$output .='<a href="'.esc_url($linkedin).'" title="'.esc_html__('Linked In','jakiro').'" target="_blank"><i class="fa fa-linkedin"></i></a>';
		$output .='</span>';
	}
	$output .='</div>';
}
$output .='</div>';
$output .='</div>';
$output .='</div>';
echo $output;
