<?php

function venue($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'address' => '',
        'content' => '',
        'button_text' => '',
        'link' => ''
    ), $atts));
    $results = '';
    $results .= '
	<div class="venue-address">
          <h2 class="uppercase" style="margin: 0 0 15px 0;">'.esc_html($title).'</h2>
          <p>'.esc_html($content).'</p>
          <p class="address"><i class="fa fa-2x fa-map-marker fa-inverse"></i>'.esc_html($address).'</p>
          <a class="button button-light" href="'.esc_attr($link).'">'.esc_html($button_text).'</a>
        </div>';

    return $section_mybtn = force_balance_tags($results);
}

add_shortcode("rms-venue", "venue");
