<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

// Make sure the plugin is active
if( ! defined( 'YOUXI_POST_FORMAT_VERSION' ) ) {
	return;
}

if( ! function_exists( 'shiroi_youxi_post_format_gallery_metabox' ) ):

function shiroi_youxi_post_format_gallery_metabox( $metabox ) {

	if( is_array( $metabox ) && isset( $metabox['fields'] ) ) {
		$metabox['fields'] = array_merge( $metabox['fields'], array(
			'type' => array(
				'type' => 'radio', 
				'label' => __( 'Gallery Type', 'shiroi' ), 
				'description' => __( 'Choose the gallery type for this post.', 'shiroi' ), 
				'choices' => array(
					'slider' => __( 'Slider', 'shiroi' ), 
					'justified' => __( 'Justified Gallery', 'shiroi' )
				), 
				'std' => 'slider'
			), 
			'ftmNav' => array(
				'type' => 'select', 
				'label' => __( 'Slider: Navigation', 'shiroi' ), 
				'description' => __( 'Specify the slider navigation type.', 'shiroi' ), 
				'choices' => array(
					0 => __( 'None', 'shiroi' ), 
					'thumbs' => __( 'Thumbs', 'shiroi' ), 
					'dots' => __( 'Dots', 'shiroi' )
				), 
				'std' => 'thumbs', 
				'criteria' => 'type:is(slider)'
			), 
			'ftmFit' => array(
				'type' => 'select', 
				'label' => __( 'Slider: Image Scale Mode', 'shiroi' ), 
				'description' => __( 'Specify how the images are scaled in the slider.', 'shiroi' ), 
				'choices' => array(
					'none' => __( 'None', 'shiroi' ), 
					'cover' => __( 'Cover', 'shiroi' ), 
					'contain' => __( 'Contain', 'shiroi' )
				), 
				'std' => 'cover', 
				'criteria' => 'type:is(slider)'
			), 
			'ftmTransition' => array(
				'type' => 'select', 
				'label' => __( 'Slider: Transition', 'shiroi' ), 
				'description' => __( 'Specify the slider transition type.', 'shiroi' ), 
				'choices' => array(
					'slide' => __( 'Slide', 'shiroi' ), 
					'crossfade' => __( 'Cross Fade', 'shiroi' ), 
					'dissolve' => __( 'Dissolve', 'shiroi' )
				), 
				'std' => 'slide', 
				'criteria' => 'type:is(slider)'
			), 
			'ftmLoop' => array(
				'type' => 'switch', 
				'label' => __( 'Slider: Loop', 'shiroi' ), 
				'description' => __( 'Switch to allow the slider to go to the first from the last slide.', 'shiroi' ), 
				'std' => false, 
				'criteria' => 'type:is(slider)'
			), 
			'ftmTransitionDuration' => array(
				'type' => 'uislider', 
				'label' => __( 'Slider: Transition Duration', 'shiroi' ), 
				'description' => __( 'Specify the slider transition duration.', 'shiroi' ), 
				'widgetopts' => array(
					'min' => 300, 
					'max' => 5000, 
					'step' => 10
				), 
				'std' => 300, 
				'criteria' => 'type:is(slider)'
			), 
			'jst_margin' => array(
				'type' => 'uislider', 
				'label' => __( 'Justified: Margin', 'shiroi' ), 
				'description' => __( 'Specify the margin for the justified layout.', 'shiroi' ), 
				'widgetopts' => array(
					'min' => 0, 
					'max' => 45
				), 
				'std' => 4, 
				'criteria' => 'type:is(justified)'
			), 
			'jst_minwidth' => array(
				'type' => 'uislider', 
				'label' => __( 'Justified: Minimum Width', 'shiroi' ), 
				'description' => __( 'Specify the minimum grid width for the justified layout.', 'shiroi' ), 
				'widgetopts' => array(
					'min' => 100, 
					'max' => 720
				), 
				'std' => 160, 
				'criteria' => 'type:is(justified)'
			), 
			'jst_minheight' => array(
				'type' => 'uislider', 
				'label' => __( 'Justified: Minimum Height', 'shiroi' ), 
				'description' => __( 'Specify the minimum grid height for the justified layout.', 'shiroi' ), 
				'widgetopts' => array(
					'min' => 100, 
					'max' => 720
				), 
				'std' => 160, 
				'criteria' => 'type:is(justified)'
			)
		));
	}

	return $metabox;
}
endif;
add_filter( 'youxi_post_format_gallery_metabox', 'shiroi_youxi_post_format_gallery_metabox' );