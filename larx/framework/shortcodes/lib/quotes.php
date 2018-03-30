<?php

// Block Quote

function th_blockquote($attrs,$content=false){
    extract(shortcode_atts(array(
        'el_class'=>'',
        'author'=>''
    ),$attrs));
	
    $author=strip_tags($author);
    $content=wpb_js_remove_wpautop($content);
    return '<blockquote class="text-left '.$el_class.'">
                <p>'.$content.'</p>
                <small>'.$author.'</small>
            </blockquote>';
}

remove_shortcode('blockquote');
add_shortcode('blockquote', 'th_blockquote');