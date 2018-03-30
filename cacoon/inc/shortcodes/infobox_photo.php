<?php

function met_su_INFOBOX_PHOTO_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_infobox_photo'] = array(
		'name' => __( 'Infobox (Photo)', 'su' ),
		'type' => 'wrap',
		'group' => 'met',
		'atts' => array(
			'title' => array(
				'default' => '',
				'name' => __( 'Title', 'su' ),
			),
			'title_sub' => array(
				'default' => '',
				'name' => __( 'Title (Secondary)', 'su' ),
			),
			'image' => array(
				'type' => 'upload',
				'default' => '',
				'name' => __( 'Image', 'su' ),
			),
			'image_lightbox' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Image Lightbox?', 'su' ),
			),
			'contentbox_bg' => array(
				'type' => 'color',
				'default' => '#A4AEB9',
				'name' => __( 'ContentBox Background', 'su' ),
			),
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_infobox_photo_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_INFOBOX_PHOTO_shortcode_data' );


function met_su_infobox_photo_shortcode( $atts, $content = null ) {
	extract($atts);

	$widgetID = uniqid('met_info_knob_');

	if($image_lightbox == 'yes'){
		wp_enqueue_script('metcreative-magnific-popup');
		wp_enqueue_style('metcreative-magnific-popup');
	}

	$widgetID = uniqid('met_infobox_image_');
	$text = wpautop(do_shortcode(htmlspecialchars_decode($content)));

	if(!empty($image)){
		$boxImage = aq_resize($image,270,240,true);
		if(!$boxImage){
			$boxImage = $image;
		}
		$lbImage = $image;
	}else{
		$boxImage = 'http://placehold.it/270x240';
		$lbImage = 'http://placehold.it/800x600';
	}

	$output = '<div class="row-fluid">
			<div class="span12">
				<div id="'.$widgetID.'" class="met_img_with_text clearfix">

					<div class="met_img_with_text_preview">
						<img src="'.$boxImage.'" alt="'.$title.'">
						'.( ($image_lightbox == 'yes') ? '
						<div class="met_img_with_text_overlay met_bgcolor5_trans">
							<a href="'.$lbImage.'" rel="lb_'.$widgetID.'" class="met_portfolio_item_lb met_bgcolor5 met_color2"><i class="icon-search"></i></a>
						</div>' : '' ) .'

					</div>

					<article class="met_color2 met_bgcolor5" style="background-color: '.$contentbox_bg.'">
						<div>
							'.( (!empty($title)) ? '<h2 class="met_title_stack">'.$title.'</h2>' : '' ).'
							'.( (!empty($title_sub)) ? '<h3 class="met_title_stack met_bold_one">'.$title_sub.'</h3><br>' : '' ).'
							'.( (!empty($text)) ? '<p>'.htmlspecialchars_decode($text).'</p>' : '' ).'
						</div>
					</article>
				</div>
			</div>
		</div>
		<style>
			#'.$widgetID.' article.met_bgcolor5:before {
				border-color : transparent '.$contentbox_bg.' transparent transparent !important;
			}
		</style>';

	return $output;
}