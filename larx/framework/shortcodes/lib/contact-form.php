<?php

// Contact form

function th_contact_form7($attrs,$content=false){
    extract(shortcode_atts(array(
        'title'=>'',
        "id" => '21',
    ),$attrs));
function_exists('wpcf7_add_shortcodes') && wpcf7_add_shortcodes() || function_exists('wpcf7') && wpcf7();;
    $output = '<div id="contact">';
    $output .= do_shortcode('[contact-form-7 id="'.$id.'"]');
    $output .= '</div>';


    return $output;
}

remove_shortcode('th_contact_form7');
add_shortcode('th_contact_form7', 'th_contact_form7');