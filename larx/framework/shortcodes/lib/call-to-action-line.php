<?php

// Call to action
function th_call_to_action_line($atts, $content = null)
{
    extract(shortcode_atts(array(
        'h2' => 'Hey! I am first heading line feel free to change me',
        "type" => 'gold-btn',
        "label" => 'Text on the button',
        "url" => '',
        "target" => '_self',
        "el_class" => '',
    ), $atts));


    switch ( $type ) {
        case 'gold-btn':
            $btn_class_type = 'gold-btn';
            break;

        case 'black-btn':
            $btn_class_type = 'black-btn';
            break;

        case 'black-btn':
            $btn_class_type = 'black-btn';
            break;

        case 'success-btn':
            $btn_class_type = 'btn-success';
            break;

        case 'info-btn':
            $btn_class_type = 'btn-info';
            break;

        case 'warning-btn':
            $btn_class_type = 'btn-warning';
            break;

        case 'danger-btn':
            $btn_class_type = 'btn-danger';
            break;

        case 'link-btn':
            $btn_class_type = 'btn-link';
            break;
    }
	
	

    $output = '';
    $output .= '<div class="cta-line">
					<div class="container">
						<div class="pull-left">
							<h2>'.$h2.'</h2>
						</div>
						<a href="'.$url.'" target="'.$target.'" class="btn cta_line_btn  '.$el_class.'">'.$label.' <i class="fa fa-angle-right"></i></a>
					</div>
				</div>';

    return $output;
}
			
remove_shortcode('cta_line');
add_shortcode('cta_line', 'th_call_to_action_line');