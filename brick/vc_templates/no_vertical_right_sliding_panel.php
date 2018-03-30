<?php
$html = "";

$html = "<div class='ms-right'>";
$html .= do_shortcode($content);
$html .= '</div>';

print $html;

