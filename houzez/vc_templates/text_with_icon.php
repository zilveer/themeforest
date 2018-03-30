<?php
$args = array(
	"icon_type"						=> "",
	"font_awesome_icon"				=> "",
	"custom_icon"					=> "",
	"title"							=> "",
    "text"							=> "",
    "read_more_text"				=> "",
    "read_more_link"				=> ""
);

extract(shortcode_atts($args, $atts));

echo '<div class="module-item">';
	echo '<div class="service-block">';
		echo '<div class="block-icon">';
			if( $icon_type == "fontawesome_icon" ) {
				echo '<i class="fa fa-'.esc_attr( $font_awesome_icon ).'"></i>';
			} else {
				echo wp_get_attachment_image( $custom_icon );
			}
		echo '</div>';
		echo '<div class="block-content">';
		echo '<h3>'.esc_attr( $title ).'</h3>';
			echo '<p>'.wp_kses_post($text).'</p>';
		if( $read_more_link != '' ) {
			echo '<a href="' . esc_url($read_more_link) . '" class="find">' . esc_attr( $read_more_text ). '</a>';
		}
		echo '</div>';
	echo '</div>';
echo '</div>';