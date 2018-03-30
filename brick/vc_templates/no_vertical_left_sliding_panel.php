<?php
$html = "";

$html = "<div class='ms-left'>";
$html .= do_shortcode($content);
$html .= '</div>';

print $html;

