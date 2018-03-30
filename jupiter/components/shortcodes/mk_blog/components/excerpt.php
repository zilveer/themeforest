<?php
if ($view_params['full_content'] == 'true') {
    $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
    $output = $content;
} 
else {
    if ($view_params['excerpt_length'] != 0) {
        ob_start();
        mk_excerpt_max_charlength($view_params['excerpt_length']);
        $output = ob_get_clean();
    }
}
if(isset($output) && !empty($output)) {
	echo '<div class="the-excerpt"><p>' . $output . '</p></div>';	
}

