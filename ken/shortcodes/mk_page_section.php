<?php
$output  = $backgroud_image_alter = $color_mask_css = $parallax_scroll = $video_output = $page_intro_class = '';
extract( shortcode_atts( array(
			'el_class' => '',
			'layout_structure' => 'full',
			'bg_color' => '',
			'border_color' => '',
			'bg_image' => '',
			'bg_repeat' => 'repeat',
			'section_id' => '',
			'bg_stretch' => 'false',
			'attachment' => 'scroll',
			'bg_position' => 'left top',
			'parallax' => 'false',
			'padding' => 20,
			'mask_opacity' => 0.6,
			'full_height' => 'false',
    		'intro_effect' => 'false',
			'bg_video' => 'no',
			'mp4' => '',
			'webm' => '',
			'ogv' => '',
			'poster_image' => '',
			'mask' => 'false',
			'parallax_direction' => 'vertical',
			'full_width' => 'false',
			'color_mask' => '',
			'visibility' => '',
			'expandable' => 'false',
			'expandable_txt' => '',
			'expandable_txt_align' => 'center',
			'expandable_txt_color' => '#ccc',
			'expandable_txt_size'=> 16,
			'expandable_icon' => 'mk-theme-icon-plus',
			'expandable_icon_size' => 16,
			'expandable_image' => ''
		), $atts ) );

global $post;


$id = Mk_Static_Files::shortcode_id();

wp_enqueue_script( 'wpb_composer_front_js' );


$bg_stretch_class = ( $bg_stretch == 'true' ) ? 'mk-background-stretch ' : '';

$backgroud_image = !empty( $bg_image ) ? 'background-image:url('.$bg_image.'); ' : '';

if( $attachment == 'fixed' ) {
	$data_attachement = 'fixed';
} else {
	$data_attachement = 'scroll';
}

if($parallax_direction == 'horizontal' || $parallax_direction == 'vertical') {
	$attachment = 'scroll';
}

// Default fixed layer
if( $attachment == 'fixed' ) {
	$backgroud_image_alter = '<div class="fixed-layer '.$bg_stretch_class.'" style="'.$backgroud_image.'"></div>';
}

// if($expandable != 'true'){
	if($layout_structure == 'full') {

	/**
	 * Video Background
	 */
	if ( $bg_video == 'yes') {
		if(!empty($poster_image)) { $video_output .= '<div style="background-image:url('.$poster_image.');" class="mk-video-section-touch"></div>'; }

		$video_output .= '<div class="mk-section-video">';
		$video_output .= '<video poster="'.$poster_image.'" muted="muted" preload="auto" loop="true" autoplay="true">';
		if (!empty($mp4)) { $video_output .= '<source type="video/mp4" src="'.$mp4.'" />'; }
		if (!empty($webm)) { $video_output .= '<source type="video/webm" src="'.$webm.'" />'; }
		if (!empty($ogv)) { $video_output .= '<source type="video/ogg" src="'.$ogv.'" />'; }
		$video_output .= '</video>';
		$video_output .= '</div>';
	}


		if ($parallax_direction == 'both_axis_mouse' ) {
			$backgroud_image_alter = '<div class="mk-mouse-parallax parallax-both-axis parallax-layer '.$attachment.'-layer '.$bg_stretch_class.'" style="'.$backgroud_image.'"></div>';
			$backgroud_image = '';

		} else if($parallax_direction == 'vertical_mouse'){
			$backgroud_image_alter = '<div class="mk-mouse-parallax parallax-y-axis parallax-layer '.$attachment.'-layer '.$bg_stretch_class.'" style="'.$backgroud_image.'"></div>';
			$backgroud_image = '';

		} else if($parallax_direction == 'horizontal_mouse') {
			$backgroud_image_alter = '<div class="mk-mouse-parallax parallax-x-axis parallax-layer '.$attachment.'-layer '.$bg_stretch_class.'" style="'.$backgroud_image.'"></div>';
			$backgroud_image = '';

		} else if($parallax_direction == 'vertical') {

			$parallax_scroll = ($parallax == 'true') ? ' data-center="background-position: 50% 0px;" data-bottom-top="background-position: 50% 200px;" data-top-bottom="background-position: 50% -200px;"' : '';
			$backgroud_image_alter = '<div class="'.$attachment.'-layer '.$bg_stretch_class.'" style="'.$backgroud_image.'" '.$parallax_scroll.' css-attach="'.$data_attachement.'" data-attach="scroll"></div>';
			$backgroud_image = '';

		} else if($parallax_direction == 'horizontal') {

			$parallax_scroll = ($parallax == 'true') ? 'data-bottom-top="background-position: 0px 50%" data-top-bottom="background-position: 3000px 50%;"' : '';
			$backgroud_image_alter = '<div class="'.$attachment.'-layer '.$bg_stretch_class.'" style="'.$backgroud_image.'" '.$parallax_scroll.'  data-attach="'.$data_attachement.'"></div>';
			$backgroud_image = '';
		} 
	} else {
			$backgroud_image = '';
	}
// }



$padding = ( $full_height == 'true' && $expandable == 'false') ? 0 : $padding;

$full_height = ($expandable == 'false') ? $full_height : 'false';

$page_section_id = !empty( $section_id ) ? ( ' id="'.$section_id.'"' ) : '';

$border_css = ( empty( $bg_image ) && !empty( $border_color ) ) ? 'border:1px solid '.$border_color.';border-left:none;border-right:none;' : '';
$output .= '<div class="clearboth"></div></div></div></div>';

/* Fixes page section for blog single page */
if(is_singular('post')) {
	$output .= '</div>';
}



if($intro_effect != 'false' && $intro_effect != '') {
    $page_intro_class = 'intro-true ';
    wp_dequeue_script('SmoothScroll');
    $parallax = 'false';
}


$output .= '<div'.$page_section_id.'  data-intro-effect="' . $intro_effect . '" class="page-section-'.$id.' ' . $page_intro_class . ' expandable-'.$expandable.' fullwidth-'.$full_width.' section-expandable-'.$expandable.' full-height-'.$full_height.' '.$bg_stretch_class.' mk-video-holder mk-page-section parallax-'.$parallax.' '.$visibility.' '.$el_class.'" data-direction="'.$parallax_direction.'">';

$bg_layer  = '<div class="bg-layer clip">';
$bg_layer .= $video_output;
$bg_layer .= $backgroud_image_alter;
$bg_layer .= '</div>';
$output .= $bg_layer;


if ( $mask == 'true' && $layout_structure == 'full') {
	$output .= '<div class="mk-section-mask"></div>';
}
if ( !empty( $color_mask ) ) {
	$color_mask_css = ' style="background-color:'.$color_mask.';opacity:'.$mask_opacity.';"';
	$output .= '<div'.$color_mask_css.' class="mk-section-color-mask"></div>';
}


$output .= ($full_height == 'true' && $expandable == 'false') ? '<div class="mk-page-section-loader edge-slider-loading"><div class="mk-preloader"><div class="mk-loader"></div></div></div>' : '';


if($expandable == 'true') {
	$output .= '<div class="expandable-section-trigger"><div class="mk-expandable-wrapper"><div class="vc_col-sm-12  wpb_column column_container ">';

	$output .= (!empty($expandable_txt)) ? '<div class="mk-grid"><span class="align-'.$expandable_txt_align.'" style="color:'.$expandable_txt_color.';font-size:'.$expandable_txt_size.'px">'.$expandable_txt.'</span></div>' : '';
	if(empty($expandable_image)) {
		$output .= '<i style="color:'.$expandable_txt_color.';font-size:'.$expandable_icon_size.'px;margin-top:-'.($expandable_icon_size/2).'px;margin-left:-'.($expandable_icon_size/2).'px" class="'.$expandable_icon.'"></i>';
	} else {
		$output .= '<img title="'.get_the_title().'" title="'.get_the_title().'" class="expandable-section-image" src="'.$expandable_image.'">';
	}


	$output .= '</div></div></div>';
}



/* Content container */
if($layout_structure == 'full') {
	if ( $full_width == 'true' ) {
		$output .= '<div class="page-section-fullwidth vc_row-fluid page-section-content expandable-'.$expandable.'"><div class="mk-padding-wrapper">'.wpb_js_remove_wpautop( $content ).'</div><div class="clearboth"></div></div>';
	} else {
		$output .= '<div class="mk-grid vc_row-fluid page-section-content expandable-'.$expandable.'"><div class="mk-padding-wrapper">'.wpb_js_remove_wpautop( $content ).'</div><div class="clearboth"></div></div>';
	}
} else {
	$output .= '<div class="mk-half-layout '.$layout_structure.'_layout" style="background-image:url('.$bg_image.');">';
	$output .= $video_output;
	$output .= '</div>';

	$output .= '<div class="mk-half-layout-container page-section-content expandable-'.$expandable.' '.$layout_structure.'_layout">'.wpb_js_remove_wpautop( $content ).'</div><div class="clearboth"></div>';
}
$output .= '<div class="clearboth"></div></div>';



if( $attachment == 'fixed' ) { 
	Mk_Static_Files::addCSS('
		.page-section-'.$id.' .fixed-layer
			{
			    '.( $bg_color ? ( 'background-color:'.$bg_color.';' ) : '' ).'
			    background-position:'.$bg_position.';
			    background-repeat:'.$bg_repeat.';
			}
	', $id);
	
} else {
	Mk_Static_Files::addCSS('
		.page-section-'.$id.'
		{
		    '. $backgroud_image.'
		    '.( $bg_color ? ( 'background-color:'.$bg_color.';' ) : '' ).'
		    background-position:'.$bg_position.';
		    background-repeat:'.$bg_repeat.';
		}
	', $id);
}


Mk_Static_Files::addCSS('
	.page-section-'.$id.'
	{
	    '. $backgroud_image.'
	    background-attachment:'.$attachment.';
	    '.( $bg_color ? ( 'background-color:'.$bg_color.';' ) : '' ).'
	    background-position:'.$bg_position.';
	    background-repeat:'.$bg_repeat.';
	    '.$border_css.'
	}
	.page-section-'.$id.' .bg-layer .scroll-layer{
		background-attachment:'.$attachment.';
	    background-position:'.$bg_position.';
	    background-repeat:'.$bg_repeat.';
	}

	.page-section-'.$id.' .page-section-content.expandable-false,
	.page-section-'.$id.'.expandable-true {
	    padding:'.$padding.'px 0;	
	}
	.page-section-'.$id.' .alt-title span
	{
		'.( $bg_color ? ( 'background-color:'.$bg_color.';' ) : '' ).'
	}
	.page-section-'.$id. '.section-expandable-true:not(.active-toggle):hover .mk-section-color-mask {
			opacity:'.($mask_opacity + 0.2).' !important;
	}
', $id);


if(!$expandable_txt == 'true'){
	Mk_Static_Files::addCSS('
		.page-section-'.$id. ' .expandable-section-trigger i {
				'.( empty($expandable_txt) ? ( 'opacity:1;' ) : '' ).'
				top:0 !important;
			}
	', $id);
}
/**************************/


$layout = get_post_meta( $post->ID, '_layout', true );
$output .= '<div class="mk-main-wrapper-holder"><div class="theme-page-wrapper '.$layout.'-layout mk-grid vc_row-fluid no-padding">';
$output .= '<div class="theme-content no-padding">';

/* Fixes page section for blog single post */
if(is_singular('post')) {
	$output .= '<div class="single-content">';
}

echo $output;
