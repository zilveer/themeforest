<?php

// [{dividerName}]
// Generates dividers
// {dividerName} - hor, hor2, horDashed, horDouble, horShadow, starHor
function tb_divider($atts, $content = "", $shortcodename = "") {
	
	$class = $shortcodename;	
	
	$output = '<div class="' . $class . '"></div>';
	
	return $output;
}

add_shortcode('hor', 'tb_divider');
add_shortcode('hor2', 'tb_divider');
add_shortcode('horDashed', 'tb_divider');
add_shortcode('horDouble', 'tb_divider');
add_shortcode('starHor', 'tb_divider');

// [clear height={height}]: Clears floating.
// {height} - int type
function tb_clear( $atts, $content = ""){
   extract(shortcode_atts(array(
		'height' => '0'
		), $atts)
	);
	
	if ($height > 0) {$style = 'style="height: ' . $height . 'px;"';}
	$output = '<div class="clear" ' . $style . '></div>';
	
	return $output;
}
add_shortcode('clear', 'tb_clear');

// [top title={title} float={float} round={round}]
// It will make a link which scrolls page to the top.
// {title} - string type
// {float} - left:right:none
// {round} = normal:round:roundX
function tb_top( $atts, $content = ""){
   extract(shortcode_atts(array(
		'title' => 'Top',
		'float' => 'none',
		'round' => ''
		), $atts)
	);
	
	$class = 'tinyButton';
	
	if ($float == 'left' || $float == 'right') {$class .= ' ' . $float;}

	if ($round == 'round') $class .= ' roundButton';
	if ($round == 'roundX') $class .= ' roundButtonX';
	
	$output = '<div class="overflow10"><a href="#top" class="' . $class . ' scroll">' . $title . '</a></div>';
	
	return $output;
}
add_shortcode('top', 'tb_top');

// [button size={size} url={url} float={float} round={round}]{content}[/button]
// This shortcode generates a button;
// {content} - string type
// {size} - normal:big:tiny
// {url} - URL
// {float} - left:right:none
// {round} - normal:round:roundX
function tb_button( $atts, $content = ""){
   extract(shortcode_atts(array(
		'float' => 'none',
		'size' => 'normal',
		'round' => '',
		'url' => '#'
		), $atts)
	);
	
	if ($size == 'big') {
		$class = 'bigButton';
	} elseif ($size == 'tiny') {
		$class = 'tinyButton';
	} else {
		$class = 'button';
	}
	
	if ($url != '#') $url = esc_url($url);
	
	if ($float == 'left' || $float == 'right') {$class .= ' ' . $float;}
	
	if ($round == 'round') $class .= ' roundButton';
	if ($round == 'roundX') $class .= ' roundButtonX';
	
	$output = '<div class="overflow10"><a href="' . $url . '" class="' . $class . ' scroll">' . $content . '</a></div>';
	
	return $output;
}
add_shortcode('button', 'tb_button');

// [box color={color}]{content}[/box]
// This shortcode generates an info box;
// {content} - string type
// {color} - green|red|yellow|blue
function tb_box( $atts, $content = ""){
   extract(shortcode_atts(array(
		'color' => 'blue'
		), $atts)
	);
	
	if ($color != 'red' && $color != 'green' && $color != 'yellow') {$color = 'blue';}
	
	$output = '<div class="infoBox ' . $color . 'Box">' . $content . '</div>';
	
	return $output;
}
add_shortcode('box', 'tb_box');


// [{column} {first|last}]{content}[/{column}]
// Generates columns based on grid960 system
// {column} - COLUMN NAME - grid_1:grid_2:grid_3:grid_4:grid_5:grid_6:grid_7:grid_8:grid_9:grid_10:grid_11:grid_12
// {first|last} - optional. If you put both of params, only the first one will be used.
function tb_column($atts, $content = "", $shortcodename = "") {
	
	if ($atts[0] == 'first') {
		$fl = ' alpha';
	} elseif ($atts[0] == 'last') {
		$fl = ' omega';
	} else {
		$fl = '';
	}
	
	$class = $shortcodename . $fl;	
	
	$output = '<div class="' . $class . '">' . do_shortcode(wpautop($content)) . '</div>';
	
	return $output;
}

add_shortcode('grid_1', 'tb_column');
add_shortcode('grid_2', 'tb_column');
add_shortcode('grid_3', 'tb_column');
add_shortcode('grid_4', 'tb_column');
add_shortcode('grid_5', 'tb_column');
add_shortcode('grid_6', 'tb_column');
add_shortcode('grid_7', 'tb_column');
add_shortcode('grid_8', 'tb_column');
add_shortcode('grid_9', 'tb_column');
add_shortcode('grid_10', 'tb_column');
add_shortcode('grid_11', 'tb_column');
add_shortcode('grid_12', 'tb_column');

?>