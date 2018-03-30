<?php

// Pricing Box

function th_pricing_box($atts, $content) {
	extract(shortcode_atts(array(
		"title" => '',
		"features" => '',
		"button_label" => 'Buy Now',
		"period" => 'per project',
		"price" => '$99',
		"button_url" => ''
	), $atts));


	$features_arr = explode(',',$features);	

	$output = '<div class="thumbnail price-table">
                    <div class="caption">
                        <h3>'.$title.'</h3>
                        <br>
                        <h1>'.$price.'</h1>
                        <small>'.$period.'</small>
                        <div class="space-bottom-2x"></div>';

    foreach($features_arr as $single_feature) {
        $output .= '<p>'.$single_feature.'</p>';
    }

    if(!$button_url) $button_url = '#';

    $output .= '<div class="space-bottom-2x"></div>
                        <a href="'.$button_url.'" class="btn gold-btn">'.$button_label.'</a>
                    </div>
                </div>';

	return $output;
	
}

remove_shortcode('pricing_box');
add_shortcode('pricing_box', 'th_pricing_box');  