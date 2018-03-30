<?php

// Block Quote

function th_alert($attrs,$content=false){
    extract(shortcode_atts(array(
        'el_class'=>'',
        'type'=>'danger',
        'effect'=>'fade in',
    ),$attrs));
    $content=do_shortcode($content);
    return "<div class=\"text-left alert alert-dismissible alert-$type $effect $el_class\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
                $content
            </div>";
}

remove_shortcode('alert');
add_shortcode('alert', 'th_alert');