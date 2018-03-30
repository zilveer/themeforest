<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "krown")
), $atts));

$output .= "\n\t\t\t" . '<section>';
    $output .= "\n\t\t\t\t" . '<h5>' .$title.'</h5>';
    $output .= "\n\t\t\t\t" . '<div class="content">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "krown") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</section> ';

echo $output;