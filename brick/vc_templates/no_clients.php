<?php

$args = array(
    "columns"         => "four_columns",
	"client_borders"  => "yes",
	"space_between_clients" => "no"
);

$html = "";

extract(shortcode_atts($args, $atts));

$clients_style="";

if($client_borders == 'yes') {
    $clients_style   .= 'with_borders';
}

$spacing = "";
if ($space_between_clients == 'yes') {
	$spacing = "clients_space";
}

$html = '<div class="qode_clients clearfix '.$columns.' '.$clients_style.' '.$spacing.'">';

$html .= do_shortcode($content);

$html .= '</div>';

print $html;