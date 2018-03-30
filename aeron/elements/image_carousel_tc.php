<?php

/*********** Shortcode: Image Carousel *********************************************************/
$tcvpb_elements['image_carousels_tc'] = array(
	'name'         => esc_html__('Image Carousel', 'ABdev_aeron' ),
	'type'         => 'block',
	'icon'         => 'pi-image-carousel',
	'category'     => esc_html__('Media', 'ABdev_aeron' ),
	'child'        => 'image_carousel_tc',
	'child_button' => esc_html__('New Image', 'ABdev_aeron'),
	'child_title'  => esc_html__('Image', 'ABdev_aeron'),
	'attributes'   => array(
		'lightbox' => array(
			'description' => esc_html__('Lightbox', 'ABdev_aeron'),
			'type'        => 'checkbox',
		),
		'items' => array(
			'description' => esc_html__('Items', 'ABdev_aeron'),
			'info'        => esc_html__('The number of items you want to see on the screen.', 'ABdev_aeron'),
			'default' => '3',
			'type'    => 'select',
			'values'  => array(
				'1' => esc_html__('1 Column', 'ABdev_aeron'),
				'2' => esc_html__('2 Column', 'ABdev_aeron'),
				'3' => esc_html__('3 Column', 'ABdev_aeron'),
				'4' => esc_html__('4 Column', 'ABdev_aeron'),
				'5' => esc_html__('5 Column', 'ABdev_aeron'),
				'6' => esc_html__('6 Column', 'ABdev_aeron'),
				'7' => esc_html__('7 Column', 'ABdev_aeron'),
			),
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'margin' => array(
			'description' => esc_html__('Margin', 'ABdev_aeron'),
			'info'        => esc_html__('margin-right(px) on item.', 'ABdev_aeron'),
			'default' => '0',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'stagepadding' => array(
			'description' => esc_html__('Padding', 'ABdev_aeron'),
			'info' 	      => esc_html__('Padding left and right on stage (can see neighbours).', 'ABdev_aeron'),
			'default' => '0',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'center' => array(
			'description' => esc_html__('Center', 'ABdev_aeron'),
			'info' 	      => esc_html__('Center item. Works well with even an odd number of items.', 'ABdev_aeron'),
			'default'     => '0',
			'type'        => 'checkbox',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'startposition' => array(
			'description' => esc_html__('Start Position', 'ABdev_aeron'),
			'info' 	      => esc_html__('Start position, type in number', 'ABdev_aeron'),
			'default'     => '0',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'loop' => array(
			'description' => esc_html__('Loop', 'ABdev_aeron'),
			'info' 	      => esc_html__('Inifnity loop. Duplicate last and first items to get loop illusion.', 'ABdev_aeron'),
			'default'     => '0',
			'type'        => 'checkbox',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
			'divider'     => 'true',
		),
		'navigation' => array(
			'description' => esc_html__('Navigation', 'ABdev_aeron'),
			'info' 	      => esc_html__('Show next/prev buttons.', 'ABdev_aeron'),
			'default'     => '0',
			'type'        => 'checkbox',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'navigation_icon_left' => array(
			'description'  => esc_html__('Navigation Icon Left', 'ABdev_aeron'),
			'type'         => 'icon',
			'tab'          => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'navigation_icon_right' => array(
			'description' => esc_html__('Navigation Icon Right', 'ABdev_aeron'),
			'type'        => 'icon',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'navigation_left_text' => array(
			'description' => esc_html__('Navigation Left Text', 'ABdev_aeron'),
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'navigation_right_text' => array(
			'description' => esc_html__('Navigation Right Text', 'ABdev_aeron'),
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'navrewind' => array(
			'description' => esc_html__('Navigation Rewind', 'ABdev_aeron'),
			'info' 	      => esc_html__('Go to first/last.', 'ABdev_aeron'),
			'default'     => '0',
			'type'        => 'checkbox',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
			'divider'     => 'true',
		),
		'slideby' => array(
			'description' => esc_html__('Slide by', 'ABdev_aeron'),
			'info' 	      => esc_html__('Navigation slide by x. page string can be set to slide by page.', 'ABdev_aeron'),
			'default'     => '1',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'dots' => array(
			'description' => esc_html__('Dots', 'ABdev_aeron'),
			'info' 	      => esc_html__('Show dots navigation.', 'ABdev_aeron'),
			'default'     => '0',
			'type'        => 'checkbox',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'dotseach' => array(
			'description' => esc_html__('Dots Each', 'ABdev_aeron'),
			'info' 	      => esc_html__('Show dots each x item.', 'ABdev_aeron'),
			'default'     => '0',
			'type'        => 'checkbox',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
			'divider'     => 'true',
		),
		'autoplay' => array(
			'description' => esc_html__('Autoplay', 'ABdev_aeron'),
			'default'     => '0',
			'type'        => 'checkbox',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'autoplaytimeout' => array(
			'description' => esc_html__('Autoplay Timeout', 'ABdev_aeron'),
			'info' 	      => esc_html__('Autoplay interval timeout.', 'ABdev_aeron'),
			'default'     => '1200',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'autoplayhoverpause' => array(
			'description' => esc_html__('Autoplay Pause', 'ABdev_aeron'),
			'info' 	      => esc_html__('Pause on mouse hover.', 'ABdev_aeron'),
			'type'        => 'checkbox',
			'default'     => '0',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'autoplayspeed' => array(
			'description' => esc_html__('Autoplay Speed', 'ABdev_aeron'),
			'default'     => '800',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'navspeed' => array(
			'description' => esc_html__('Navigation Speed', 'ABdev_aeron'),
			'default'     => '800',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'dotsspeed' => array(
			'description' => esc_html__('Pagination Speed', 'ABdev_aeron'),
			'default'     => '800',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'dragendspeed' => array(
			'description' => esc_html__('Drag end speed', 'ABdev_aeron'),
			'default'     => '800',
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
			'divider'     => 'true',
		),
		'animateout' => array(
			'description' => esc_html__('Animate Out', 'ABdev_aeron'),
			'info' 	      => esc_html__('CSS3 animation out.', 'ABdev_aeron'),
			'default'     => '',
			'type'        => 'select',
			'values'      => array(
				''	=> esc_html__('None', 'ABdev_aeron'),
				'bounce'	=> esc_html__('bounce', 'ABdev_aeron'),
				'flash'	=> esc_html__('flash', 'ABdev_aeron'),
				'pulse'	=> esc_html__('pulse', 'ABdev_aeron'),
				'rubberBand'	=> esc_html__('rubberBand', 'ABdev_aeron'),
				'shake'	=> esc_html__('shake', 'ABdev_aeron'),
				'swing'	=> esc_html__('swing', 'ABdev_aeron'),
				'tada'	=> esc_html__('tada', 'ABdev_aeron'),
				'wobble'	=> esc_html__('wobble', 'ABdev_aeron'),
				'jello'	=> esc_html__('jello', 'ABdev_aeron'),
				'bounceIn'	=> esc_html__('bounceIn', 'ABdev_aeron'),
				'bounceInDown'	=> esc_html__('bounceInDown', 'ABdev_aeron'),
				'bounceInLeft'	=> esc_html__('bounceInLeft', 'ABdev_aeron'),
				'bounceInRight'	=> esc_html__('bounceInRight', 'ABdev_aeron'),
				'bounceInUp'	=> esc_html__('bounceInUp', 'ABdev_aeron'),
				'bounceOut'	=> esc_html__('bounceOut', 'ABdev_aeron'),
				'bounceOutDown'	=> esc_html__('bounceOutDown', 'ABdev_aeron'),
				'bounceOutLeft'	=> esc_html__('bounceOutLeft', 'ABdev_aeron'),
				'bounceOutRight'	=> esc_html__('bounceOutRight', 'ABdev_aeron'),
				'bounceOutUp'	=> esc_html__('bounceOutUp', 'ABdev_aeron'),
				'fadeIn'	=> esc_html__('fadeIn', 'ABdev_aeron'),
				'fadeInDown'	=> esc_html__('fadeInDown', 'ABdev_aeron'),
				'fadeInDownBig'	=> esc_html__('fadeInDownBig', 'ABdev_aeron'),
				'fadeInLeft'	=> esc_html__('fadeInLeft', 'ABdev_aeron'),
				'fadeInLeftBig'	=> esc_html__('fadeInLeftBig', 'ABdev_aeron'),
				'fadeInRight'	=> esc_html__('fadeInRight', 'ABdev_aeron'),
				'fadeInRightBig'	=> esc_html__('fadeInRightBig', 'ABdev_aeron'),
				'fadeInUp'	=> esc_html__('fadeInUp', 'ABdev_aeron'),
				'fadeInUpBig'	=> esc_html__('fadeInUpBig', 'ABdev_aeron'),
				'fadeOut'	=> esc_html__('fadeOut', 'ABdev_aeron'),
				'fadeOutDown'	=> esc_html__('fadeOutDown', 'ABdev_aeron'),
				'fadeOutDownBig'	=> esc_html__('fadeOutDownBig', 'ABdev_aeron'),
				'fadeOutLeft'	=> esc_html__('fadeOutLeft', 'ABdev_aeron'),
				'fadeOutLeftBig'	=> esc_html__('fadeOutLeftBig', 'ABdev_aeron'),
				'fadeOutRight'	=> esc_html__('fadeOutRight', 'ABdev_aeron'),
				'fadeOutRightBig'	=> esc_html__('fadeOutRightBig', 'ABdev_aeron'),
				'fadeOutUp'	=> esc_html__('fadeOutUp', 'ABdev_aeron'),
				'fadeOutUpBig'	=> esc_html__('fadeOutUpBig', 'ABdev_aeron'),
				'flip'	=> esc_html__('flip', 'ABdev_aeron'),
				'flipInX'	=> esc_html__('flipInX', 'ABdev_aeron'),
				'flipInY'	=> esc_html__('flipInY', 'ABdev_aeron'),
				'flipOutX'	=> esc_html__('flipOutX', 'ABdev_aeron'),
				'flipOutY'	=> esc_html__('flipOutY', 'ABdev_aeron'),
				'lightSpeedIn'	=> esc_html__('lightSpeedIn', 'ABdev_aeron'),
				'lightSpeedOut'	=> esc_html__('lightSpeedOut', 'ABdev_aeron'),
				'rotateIn'	=> esc_html__('rotateIn', 'ABdev_aeron'),
				'rotateInDownLeft'	=> esc_html__('rotateInDownLeft', 'ABdev_aeron'),
				'rotateInDownRight'	=> esc_html__('rotateInDownRight', 'ABdev_aeron'),
				'rotateInUpLeft'	=> esc_html__('rotateInUpLeft', 'ABdev_aeron'),
				'rotateInUpRight'	=> esc_html__('rotateInUpRight', 'ABdev_aeron'),
				'rotateOut'	=> esc_html__('rotateOut', 'ABdev_aeron'),
				'rotateOutDownLeft'	=> esc_html__('rotateOutDownLeft', 'ABdev_aeron'),
				'rotateOutDownRight'	=> esc_html__('rotateOutDownRight', 'ABdev_aeron'),
				'rotateOutUpLeft'	=> esc_html__('rotateOutUpLeft', 'ABdev_aeron'),
				'rotateOutUpRight'	=> esc_html__('rotateOutUpRight', 'ABdev_aeron'),
				'slideInUp'	=> esc_html__('slideInUp', 'ABdev_aeron'),
				'slideInDown'	=> esc_html__('slideInDown', 'ABdev_aeron'),
				'slideInLeft'	=> esc_html__('slideInLeft', 'ABdev_aeron'),
				'slideInRight'	=> esc_html__('slideInRight', 'ABdev_aeron'),
				'slideOutUp'	=> esc_html__('slideOutUp', 'ABdev_aeron'),
				'slideOutDown'	=> esc_html__('slideOutDown', 'ABdev_aeron'),
				'slideOutLeft'	=> esc_html__('slideOutLeft', 'ABdev_aeron'),
				'slideOutRight'	=> esc_html__('slideOutRight', 'ABdev_aeron'),
				'zoomIn'	=> esc_html__('zoomIn', 'ABdev_aeron'),
				'zoomInDown'	=> esc_html__('zoomInDown', 'ABdev_aeron'),
				'zoomInLeft'	=> esc_html__('zoomInLeft', 'ABdev_aeron'),
				'zoomInRight'	=> esc_html__('zoomInRight', 'ABdev_aeron'),
				'zoomInUp'	=> esc_html__('zoomInUp', 'ABdev_aeron'),
				'zoomOut'	=> esc_html__('zoomOut', 'ABdev_aeron'),
				'zoomOutDown'	=> esc_html__('zoomOutDown', 'ABdev_aeron'),
				'zoomOutLeft'	=> esc_html__('zoomOutLeft', 'ABdev_aeron'),
				'zoomOutRight'	=> esc_html__('zoomOutRight', 'ABdev_aeron'),
				'zoomOutUp'	=> esc_html__('zoomOutUp', 'ABdev_aeron'),
				'hinge'	=> esc_html__('hinge', 'ABdev_aeron'),
				'rollIn'	=> esc_html__('rollIn', 'ABdev_aeron'),
				'rollOut'	=> esc_html__('rollOut', 'ABdev_aeron'),
			),
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'animatein' => array(
			'description' => esc_html__('Animate In', 'ABdev_aeron'),
			'info' 	      => esc_html__('CSS3 animation in.', 'ABdev_aeron'),
			'default'     => '',
			'type'        => 'select',
			'values'      => array(
				''	=> esc_html__('None', 'ABdev_aeron'),
				'bounce'	=> esc_html__('bounce', 'ABdev_aeron'),
				'flash'	=> esc_html__('flash', 'ABdev_aeron'),
				'pulse'	=> esc_html__('pulse', 'ABdev_aeron'),
				'rubberBand'	=> esc_html__('rubberBand', 'ABdev_aeron'),
				'shake'	=> esc_html__('shake', 'ABdev_aeron'),
				'swing'	=> esc_html__('swing', 'ABdev_aeron'),
				'tada'	=> esc_html__('tada', 'ABdev_aeron'),
				'wobble'	=> esc_html__('wobble', 'ABdev_aeron'),
				'jello'	=> esc_html__('jello', 'ABdev_aeron'),
				'bounceIn'	=> esc_html__('bounceIn', 'ABdev_aeron'),
				'bounceInDown'	=> esc_html__('bounceInDown', 'ABdev_aeron'),
				'bounceInLeft'	=> esc_html__('bounceInLeft', 'ABdev_aeron'),
				'bounceInRight'	=> esc_html__('bounceInRight', 'ABdev_aeron'),
				'bounceInUp'	=> esc_html__('bounceInUp', 'ABdev_aeron'),
				'bounceOut'	=> esc_html__('bounceOut', 'ABdev_aeron'),
				'bounceOutDown'	=> esc_html__('bounceOutDown', 'ABdev_aeron'),
				'bounceOutLeft'	=> esc_html__('bounceOutLeft', 'ABdev_aeron'),
				'bounceOutRight'	=> esc_html__('bounceOutRight', 'ABdev_aeron'),
				'bounceOutUp'	=> esc_html__('bounceOutUp', 'ABdev_aeron'),
				'fadeIn'	=> esc_html__('fadeIn', 'ABdev_aeron'),
				'fadeInDown'	=> esc_html__('fadeInDown', 'ABdev_aeron'),
				'fadeInDownBig'	=> esc_html__('fadeInDownBig', 'ABdev_aeron'),
				'fadeInLeft'	=> esc_html__('fadeInLeft', 'ABdev_aeron'),
				'fadeInLeftBig'	=> esc_html__('fadeInLeftBig', 'ABdev_aeron'),
				'fadeInRight'	=> esc_html__('fadeInRight', 'ABdev_aeron'),
				'fadeInRightBig'	=> esc_html__('fadeInRightBig', 'ABdev_aeron'),
				'fadeInUp'	=> esc_html__('fadeInUp', 'ABdev_aeron'),
				'fadeInUpBig'	=> esc_html__('fadeInUpBig', 'ABdev_aeron'),
				'fadeOut'	=> esc_html__('fadeOut', 'ABdev_aeron'),
				'fadeOutDown'	=> esc_html__('fadeOutDown', 'ABdev_aeron'),
				'fadeOutDownBig'	=> esc_html__('fadeOutDownBig', 'ABdev_aeron'),
				'fadeOutLeft'	=> esc_html__('fadeOutLeft', 'ABdev_aeron'),
				'fadeOutLeftBig'	=> esc_html__('fadeOutLeftBig', 'ABdev_aeron'),
				'fadeOutRight'	=> esc_html__('fadeOutRight', 'ABdev_aeron'),
				'fadeOutRightBig'	=> esc_html__('fadeOutRightBig', 'ABdev_aeron'),
				'fadeOutUp'	=> esc_html__('fadeOutUp', 'ABdev_aeron'),
				'fadeOutUpBig'	=> esc_html__('fadeOutUpBig', 'ABdev_aeron'),
				'flip'	=> esc_html__('flip', 'ABdev_aeron'),
				'flipInX'	=> esc_html__('flipInX', 'ABdev_aeron'),
				'flipInY'	=> esc_html__('flipInY', 'ABdev_aeron'),
				'flipOutX'	=> esc_html__('flipOutX', 'ABdev_aeron'),
				'flipOutY'	=> esc_html__('flipOutY', 'ABdev_aeron'),
				'lightSpeedIn'	=> esc_html__('lightSpeedIn', 'ABdev_aeron'),
				'lightSpeedOut'	=> esc_html__('lightSpeedOut', 'ABdev_aeron'),
				'rotateIn'	=> esc_html__('rotateIn', 'ABdev_aeron'),
				'rotateInDownLeft'	=> esc_html__('rotateInDownLeft', 'ABdev_aeron'),
				'rotateInDownRight'	=> esc_html__('rotateInDownRight', 'ABdev_aeron'),
				'rotateInUpLeft'	=> esc_html__('rotateInUpLeft', 'ABdev_aeron'),
				'rotateInUpRight'	=> esc_html__('rotateInUpRight', 'ABdev_aeron'),
				'rotateOut'	=> esc_html__('rotateOut', 'ABdev_aeron'),
				'rotateOutDownLeft'	=> esc_html__('rotateOutDownLeft', 'ABdev_aeron'),
				'rotateOutDownRight'	=> esc_html__('rotateOutDownRight', 'ABdev_aeron'),
				'rotateOutUpLeft'	=> esc_html__('rotateOutUpLeft', 'ABdev_aeron'),
				'rotateOutUpRight'	=> esc_html__('rotateOutUpRight', 'ABdev_aeron'),
				'slideInUp'	=> esc_html__('slideInUp', 'ABdev_aeron'),
				'slideInDown'	=> esc_html__('slideInDown', 'ABdev_aeron'),
				'slideInLeft'	=> esc_html__('slideInLeft', 'ABdev_aeron'),
				'slideInRight'	=> esc_html__('slideInRight', 'ABdev_aeron'),
				'slideOutUp'	=> esc_html__('slideOutUp', 'ABdev_aeron'),
				'slideOutDown'	=> esc_html__('slideOutDown', 'ABdev_aeron'),
				'slideOutLeft'	=> esc_html__('slideOutLeft', 'ABdev_aeron'),
				'slideOutRight'	=> esc_html__('slideOutRight', 'ABdev_aeron'),
				'zoomIn'	=> esc_html__('zoomIn', 'ABdev_aeron'),
				'zoomInDown'	=> esc_html__('zoomInDown', 'ABdev_aeron'),
				'zoomInLeft'	=> esc_html__('zoomInLeft', 'ABdev_aeron'),
				'zoomInRight'	=> esc_html__('zoomInRight', 'ABdev_aeron'),
				'zoomInUp'	=> esc_html__('zoomInUp', 'ABdev_aeron'),
				'zoomOut'	=> esc_html__('zoomOut', 'ABdev_aeron'),
				'zoomOutDown'	=> esc_html__('zoomOutDown', 'ABdev_aeron'),
				'zoomOutLeft'	=> esc_html__('zoomOutLeft', 'ABdev_aeron'),
				'zoomOutRight'	=> esc_html__('zoomOutRight', 'ABdev_aeron'),
				'zoomOutUp'	=> esc_html__('zoomOutUp', 'ABdev_aeron'),
				'hinge'	=> esc_html__('hinge', 'ABdev_aeron'),
				'rollIn'	=> esc_html__('rollIn', 'ABdev_aeron'),
				'rollOut'	=> esc_html__('rollOut', 'ABdev_aeron'),
			),
			'tab'         => esc_html__('Carousel', 'ABdev_aeron'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info'        => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab'         => esc_html__('Advanced', 'ABdev_aeron'),
		),
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info'        => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab'         => esc_html__('Advanced', 'ABdev_aeron'),
		),
	),
);


function tcvpb_image_carousels_tc_shortcode( $attributes, $content = null ) {
	global $lightbox_out;
	extract(shortcode_atts(tcvpb_extract_attributes('image_carousels_tc'), $attributes));

	$lightbox_out = $lightbox;

	$classes[] = 'tcvpb-image-carousel';
	$classes[] = $class;
	$classes_out = implode(' ', $classes);

	$nav = '';
	if($navigation == 1){
		$nav = '<div class="tcvpb-image-carousel_prev">
					<i class="'.esc_attr($navigation_icon_left).'"></i>
					<span class="prev_text">'.esc_attr($navigation_left_text).'</span>
				</div>
				<div class="tcvpb-image-carousel_next">
					<span class="next_text">'.esc_attr($navigation_right_text).'</span>
					<i class="'.esc_attr($navigation_icon_right).'"></i>
				</div>';
	}

	return '<div '.(($id!='') ? 'id="'.esc_attr($id).'"' : '').' class="'.$classes_out.'" data-items="'.esc_attr($items).'" data-margin="'.esc_attr($margin).'" data-loop="'.esc_attr($loop).'" data-center="'.esc_attr($center).'" data-stagepadding="'.esc_attr($stagepadding).'" data-startposition="'.esc_attr($startposition).'" data-navigation="'.esc_attr($navigation).'" data-navrewind="'.esc_attr($navrewind).'" data-slideby="'.esc_attr($slideby).'" data-dots="'.esc_attr($dots).'" data-dotseach="'.esc_attr($dotseach).'" data-autoplay="'.esc_attr($autoplay).'" data-autoplaytimeout="'.esc_attr($autoplaytimeout).'" data-autoplayhoverpause="'.esc_attr($autoplayhoverpause).'" data-autoplayspeed="'.esc_attr($autoplayspeed).'" data-navspeed="'.esc_attr($navspeed).'" data-dotsspeed="'.esc_attr($dotsspeed).'" data-dragendspeed="'.esc_attr($dragendspeed).'" data-animateout="'.esc_attr($animateout).'" data-animatein="'.esc_attr($animatein).'">
				<div class="tcvpb-image-carousel-wrapper">
					'.do_shortcode($content).'
				</div>
				'.$nav.'
			</div>';
}

$tcvpb_elements['image_carousel_tc'] = array(
	'name'       => esc_html__('Single image section', 'ABdev_aeron' ),
	'hidden'     => '1',
	'type'       => 'child',
	'icon'       => 'pi-customize',
	'attributes' => array(
		'url' => array(
			'type'        => 'image',
			'description' => esc_html__('Select Image', 'ABdev_aeron'),
		),
		'link' => array(
			'description' => esc_html__('Link', 'ABdev_aeron'),
			'type'        => 'url',
		),
		'target' => array(
			'description' => esc_html__('Target', 'ABdev_aeron'),
			'default'     => '_self',
			'type'        => 'select',
			'values'      => array(
				'_self'  => esc_html__('Self', 'ABdev_aeron'),
				'_blank' => esc_html__('Blank', 'ABdev_aeron'),
			),
		),
	),
);
function tcvpb_image_carousel_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('image_carousel_tc'), $attributes));
	global $lightbox_out;

	$img_id = ABdev_aeron_get_image_id($url);
	$img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
	$img_title = get_the_title($img_id);

	$out = '';
	$out .= '<li>';
		if($lightbox_out == 1) {
			$out .= '<a href="'.esc_url($url).'" data-lightbox="image-carousel" data-title="'.esc_attr($img_title).'"><img src="'.esc_url($url).'" alt="'.esc_attr($img_alt).'"></a>';
		} else if($link != '') {
			$out .= '<a href="'.esc_url($link).'" target="'.esc_attr($target).'"><img src="'.esc_url($url).'" alt="'.esc_attr($img_alt).'"></a>';
		} else{
			$out .= '<img src="'.esc_url($url).'" alt="'.esc_attr($img_alt).'">';
		}
	$out .= '</li>';

	$return = ''.$out.'';

	return $return;
}


