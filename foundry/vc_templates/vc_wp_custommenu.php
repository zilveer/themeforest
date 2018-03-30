<?php
$output = $title = $el_class = $nav_menu = '';
extract( shortcode_atts( array(
	'title' => '',
	'nav_menu' => '',
	'el_class' => ''
), $atts ) );
$el_class = $this->getExtraClass( $el_class );

$type = 'WP_Nav_Menu_Widget';
$args = array(
	'before_title' => '<h4>',
	'after_title' => '</h4>',
	'before_widget' => '',
	'after_widget' => ''
);

ob_start();
the_widget( $type, $atts, $args );
$output = ob_get_clean();
echo htmlspecialchars_decode($output);