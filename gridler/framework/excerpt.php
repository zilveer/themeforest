<?php

//Excerpt Function
function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
    add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
    add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
    }
	
	function wpe_excerptlength_blog($length) {
    return 40;
    }
	function wpe_excerptlength_portfolio($length) {
    return 18;
    }
    function wpe_excerptmore($more) {
    return '...';
    }
	function wpe_excerptcontinue($more) {
    return '... <p><a href="'.get_permalink($post->ID).'" class="readmore" rel="nofollow"><span>Continue Reading &raquo;</span></a></p>';
    }
							
?>