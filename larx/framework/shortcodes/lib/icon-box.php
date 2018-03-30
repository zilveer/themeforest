<?php

// Icon Box Shortcode

function th_icon_box($atts, $content = null) {
    extract(shortcode_atts(array(
		"icon_box_style" => 'style1',
        "icon" => 'heart-o',
        "title" => 'Hey! I am title',
        "text" => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus.',
    ), $atts));

    $icon = str_replace('fa-','',$icon);

	if($icon_box_style =="style2"){		
		$output = '<div class="features-item elements-features-item text-center">
						<div class="features-icon">
							<span class="fa fa-'.$icon.'"></span>
						</div>
						<h3 class="features-title">'.$title.'</h3>
						<div class="features-descr">'.$text.'</div>
					</div>';
	}
	else{
		$output = '<div class="about-caption text-left">
                <div class="col-sm-2">
                    <i class="fa fa-'.$icon.' fa-2x"></i>
                </div>
                <div class="col-sm-10">
                    <h3>'.$title.'</h3>
                    <p>'.$text.'</p>
                </div>
            </div>';
	}	

	return $output;
}

remove_shortcode('icon_box');
add_shortcode('icon_box', 'th_icon_box');