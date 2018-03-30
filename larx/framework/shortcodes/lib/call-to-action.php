<?php

// Call to action
function th_call_to_action($atts, $content = null)
{
    extract(shortcode_atts(array(
        'bg_image' => '',
        'th_is_overlay' => '',
        'h2' => 'Hey! I am first heading line feel free to change me',
        "type" => 'gold-btn',
        "label" => 'Text on the button',
        "url" => '',
        "target" => '_self',
        "align" => 'left',
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


	$bg_img ='';
    if($bg_image) {
        if (strpos($bg_image,'http') == false) {
            $bg_image = wp_get_attachment_image_src($bg_image, "fullsize");
            $bg_image = $bg_image[0];
        }
    }
    if($bg_image) $bg_img .= 'style="background-image:url('.$bg_image.');"';

    $overlay_class = '';
    if($th_is_overlay == 'yes'){
        $overlay_class = 'parallax-overlay';
    }

    $output = '';
    $output .= '<div '.$bg_img.' class="cta-section padding-top-x2 padding-bottom '.$overlay_class.'">
                    <div class="container text-center">
                        <div class="cta-title">
                            <h2>'.$h2.'</h2>
                            <div class="space-bottom-2x"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <p>'.$content.'</p>
                                <div class="space-bottom-2x"></div>
                                <a href="'.$url.'" target="'.$target.'" class="btn '.$btn_class_type.' '.$el_class.'">'.$label.'</a>
                            </div>
                        </div>
                    </div>
                </div>';

    return $output;
}

remove_shortcode('vc_cta_section');
add_shortcode('vc_cta_section', 'th_call_to_action');