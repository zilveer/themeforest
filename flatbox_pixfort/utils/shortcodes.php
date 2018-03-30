<?php

// Allow shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Current Year
function the_year_shortcode( $atts ) {
	extract(shortcode_atts(array(
		'before' => '',
		'start' => '',
		'after' => ''
	),$atts));
	if( $before ) $before = esc_html( $before ) . ' ';
	if( $start ) $start = absint( $start ) . ' - ';
	if( $after ) $after = ' ' . esc_html( $after );
	return '<span class="the-year">' . $before . $start . date( 'Y' ) . $after . '</span>';
}
add_shortcode('the-year', 'the_year_shortcode');

// Blog Title
function blog_title_shortcode($atts, $content = null) {
	return get_bloginfo('name');
}
add_shortcode('blog-title', 'blog_title_shortcode');

// WP Link
function wp_link_shortcode() {
	return '<a href="http://wordpress.org" title="' . esc_attr__( 'This site is powered by WordPress', 'flatbox' ) . '">' . __( 'WordPress', 'flatbox' ) . '</a>';
}
add_shortcode('wp-link', 'wp_link_shortcode');

// Login/logout
function loginout_shortcode() {
    if( is_user_logged_in() )
        $return = '<a href="' . esc_url( wp_logout_url( site_url( $SERVER['REQUEST_URI'] ) ) ) . '" title="' . esc_attr__( 'Log out of this site', 'flatbox' ) . '">' . __( 'Log out', 'flatbox' ) . '</a>';
    else
        $return = '<a href="' . esc_url( wp_login_url( site_url( $SERVER['REQUEST_URI'] ) ) ) . '" title="' . esc_attr__( 'Log in to this site', 'flatbox' ) . '">' . __( 'Log in', 'flatbox' ) . '</a>';
    return $return;
}
add_shortcode('loginout-link', 'loginout_shortcode');

// Blog/site link
function site_link_shortcode() {
    return '<a href="' . home_url() . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a>';
}
add_shortcode('site-link', 'site_link_shortcode');
add_shortcode('blog-link', 'site_link_shortcode');

// Highlight
function highlight_shortcode($atts, $content = null) {
	return '<span class="highlight">'.$content.'</span>';
}
add_shortcode('highlight', 'highlight_shortcode');

// Tooltip
function tooltip_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('text' => ''),$atts));
	$text = ($text) ? ' data-tip="' . esc_attr($text) . '"' : '';
	return '<span class="tooltip"' . $text . '>' . $content . '</span>';
}
add_shortcode('tooltip', 'tooltip_shortcode');

// Box
function box_shortcode($atts, $content = null) {
	return '<div class="sep sep-big remove-bottom"></div><div class="box">'.$content.'</div>';
}
add_shortcode('box', 'box_shortcode');

// Alert
function alert_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('type' => ''),$atts));
	return '<div class="alert ' . esc_attr($type) . '">'.$content.'</div>';
}
add_shortcode('alert', 'alert_shortcode');

// Blockquotes
function blockquote_shortcode($atts, $content = null) {
	return '<blockquote>' . $content . '</blockquote>';
}
add_shortcode('blockquote','blockquote_shortcode');

// Blockquote Cite
function cite_shortcode($atts, $content = null) {
	return '<blockquote><cite>' . $content . '</cite></blockquote>';
}
add_shortcode('cite','cite_shortcode');

// Dropcap
function dropcap_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('style' => ''),$atts));
	return '<span class="dropcap '. esc_attr($style) .'">'.$content[0].'</span>'.substr($content,1);
}
add_shortcode('dropcap','dropcap_shortcode');

// List
function list_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('type' => 'ul','style' => ''),$atts));
	return '<' . strip_tags($type) . ' class="' . esc_attr($style) . '">' . $content . '</' . $type . '>';
}
add_shortcode('list', 'list_shortcode');

// Accordion
function accordion_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('type' => ''),$atts));
	return '<ul class="accordion ' . esc_attr($type) . '">' . do_shortcode($content) . '</ul>';
}
add_shortcode('accordion', 'accordion_shortcode');

// Accordion Item
function accordion_item_shortcode($atts, $content = null) {
	global $smof_data;
	extract(shortcode_atts(array(
		'opened' => '',
		'title' => 'Accordion title'
	),$atts));
	$active = ($opened) ? ' class="active"' : '';
	return '<li' . $active .'><h5 class="accordion-title' . $smof_data['css3_animation_class'] . '">' . esc_attr($title) . '</h5><div class="accordion-content">' . do_shortcode($content) . '</div></li>';
}
add_shortcode('accordion-item', 'accordion_item_shortcode');

// Toggle Item
function toggle_shortcode($atts, $content = null) {
	global $smof_data;
	extract(shortcode_atts(array(
		'opened' => false,
		'title' => 'Toggle title'
	),$atts));
	$active = ($opened) ? ' class="active"' : '';
	return '<ul class="accordion"><li' . $active .'><h5 class="accordion-title' . $smof_data['css3_animation_class'] . '">' . esc_attr($title) . '</h5><div class="accordion-content">' . do_shortcode($content) . '</div></li></ul>';
}
add_shortcode('toggle', 'toggle_shortcode');

// Tab Container
function tabs_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'id' => 'number',
	),$atts));

	$GLOBALS['tab_count'] = 0;
	$tabid = 0;

	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ) {
		foreach( $GLOBALS['tabs'] as $tab ) {
			// Set up tabid based on the id defined above
			switch( $id ) {
				case "name":
					$tabid = sanitize_title( $tab['title'] );
					break;
				case "number":
					$tabid += 1;
					break;
				default:
					break;
			}
			$opened = ($tab['active']) ? ' class="active"' : '';
			$tabs[] = '<li' . $opened . '><a href="#tab-' . $tabid . '">' . $tab['title'] . '</a></li>';
			$panes[] = '<div id="tab-' . $tabid . '" class="tab_content">' . $tab['content'] . '</div>';
		}
		$return = '<div class="tab-container"><ul class="tabs clearfix">' . implode( "\n", $tabs ) . '</ul>' . "\n" . implode( "\n", $panes ) . '</div>' . "\n";
	}
	// Reset the variables in the event we use multiple tabs on single page
	$GLOBALS['tabs'] = null;
	$GLOBALS['tab_count'] = 0;
	return $return;
}
add_shortcode('tabs', 'tabs_shortcode');

// Tab Item
function tab_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'active' => false,
		'title' => 'Tab',
	),$atts));
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array(
		'title' => esc_attr(sprintf( $title, $GLOBALS['tab_count'])),
		'active' => $active,
		'content' => do_shortcode($content)
	);
	$GLOBALS['tab_count']++;
}
add_shortcode('tab', 'tab_shortcode');

// Image
function image_shortcode( $atts ) {
	extract(shortcode_atts(array(
		'src' => get_template_directory_uri() . '/img/480x320.gif',
		'width' => '',
		'height' => '',
		'alt' => '',
		'class' => 'scale',
	),$atts));
	if ($class) $attr = ' class="' . esc_attr( $class ) . '"';
	return '<img src="' . esc_url($src) . '"' . $attr . ' alt="' . esc_attr($alt) . '" />';
}
add_shortcode('image', 'image_shortcode');

function firasbox_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => get_template_directory_uri() . '/img/940x480.gif',
		'group' => '',
		'class' => '',
		'icon' => 'fullsize',
		'info' => true,
	),$atts));
	if ($class) $class = ' ' . esc_attr( $class );
	if ($group) $group = ' data-fancybox-group="' . esc_attr( $group ) . '"';
	if ($icon) $icon = esc_attr( $icon );
	global $smof_data;
	$animation = $smof_data['css3_animation_class'];
	$info = ($info) ? '<div class="info pattern"><a href="' . esc_url($link) . '" class="button-' . $icon . '"' . $group . '></a></div></div>' : '';
	return '<div class="thumb' . $animation . '"><a href="' . esc_url($link) . '" class="lightbox ' . $class . '">' . do_shortcode($content) . '</a>' . $info;
}
add_shortcode('firasbox', 'firasbox_shortcode');

// Lightbox
function light_box_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => get_template_directory_uri() . '/img/940x480.gif',
		'group' => '',
		'class' => '',
		'icon' => 'fullsize',
		'info' => true,
	),$atts));
	if ($class) $class = ' ' . esc_attr( $class );
	if ($group) $group = ' data-fancybox-group="' . esc_attr( $group ) . '"';
	if ($icon) $icon = esc_attr( $icon );
	global $smof_data;
	$animation = $smof_data['css3_animation_class'];
	$info = ($info) ? '<div class="info pattern"><a href="' . esc_url($link) . '" class="button-' . $icon . '"' . $group . '></a></div></div>' : '';
	return '<div class="thumb' . $animation . '"><a href="' . esc_url($link) . '" class="lightbox ' . $class . '">' . do_shortcode($content) . '</a>' . $info;
}
add_shortcode('light_box', 'light_box_shortcode');

// Google Maps
function gmap_shortcode($atts, $content = null) {
	extract(shortcode_atts(array("url" => ''),$atts));
	return '<div class="video-container"><div class="video-wrapper"><iframe width="640" height="480" frameborder="0" src="' . esc_url( $url ) . '&amp;output=embed"></iframe></div></div>';
}
add_shortcode("gmap", "gmap_shortcode");

// Responsive Video
function responsive_video_shortcode($atts, $content = null) {
	return '<div class="video-container"><div class="video-wrapper">' . do_shortcode($content) . '</div></div>';
}
add_shortcode("responsive-video", "responsive_video_shortcode");

// Pricing Table
function pricing_table_shortcode($atts, $content = null) {
	return '<div class="pricing-table">' . do_shortcode($content) . '</div>';
}
add_shortcode("pricing-table", "pricing_table_shortcode");

// Pricing Column
function pricing_column_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'Column',
		"cost" => '$0',
		"cost_after" => '/ mo',
		"highlight" => false
	),$atts));
	$class = ($highlight) ? ' special' : '';
	return '<div class="price-item' . $class . '"><h3 class="price-title bold">' . esc_attr($title) . '</h3><div class="price-tag">' . $cost . ' <span>' . $cost_after . '</span></div>' . do_shortcode($content) . '</div>';
}
add_shortcode("pricing-column", "pricing_column_shortcode");

// Button
function button_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"size" => '',
		"color" => '',
		'target' => '',
		'rel' => '',
		'id' => ''
	), $atts));

	switch ($target) {
		case "_blank":
		case "blank":
			$target = ' target="_blank" ';
			break;
		default:
			$target = '';
			break;
	}

	// Properly escape our data
	if ($rel)
		$rel = ' rel="' . esc_attr( $rel ) . '"';
	if ($size)
		$size = ' ' . esc_attr( $size );
	if ($color)
		$color = ' ' . esc_attr( $color );
	if ($id)
		$id = ' id="' . esc_attr( $id ) . '"';
	global $smof_data;
	$animation = $smof_data['css3_animation_class'];

	return '<a' . $id . ' class="button' . $size . $color . $animation . '" href="'.$url.'"'. $rel . $target .'>'.$content.'</a>';
}
add_shortcode('button', 'button_shortcode');

// Social Link
function social_link_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'type' => 'twitter',
		'url' => '',
		'title' => '',
		'target' => 'blank',
	), $atts));

	switch ($target) {
		case "_blank":
		case "blank":
			$target = ' target="_blank" ';
			break;
		default:
			$target = '';
			break;
	}

	global $smof_data;
	$animation = $smof_data['css3_animation_class'];

	// Properly escape our data
	if ($url)
		$url = ' href="' . esc_url( $url ) . '"';
	else {
		$url = ($smof_data['social_' . $type]) ? $smof_data['social_' . $type] : '#';
		$url = ' href="' . esc_url( $url ) . '"';
	}
	// Properly escape our data
	if ($title) {
		$title = ' data-tip="' . esc_attr($title) . '"';
		$tooltip_class = ' tooltip';
	} else {
		$tooltip_class = '';
	}

	return '<a class="social-link social-' . esc_attr($type) . $tooltip_class . $animation . '"' . $url . $title . $target .'>'.$content.'</a>';
}
add_shortcode('social-link', 'social_link_shortcode');


// Social Link 2
function social_link_shortcode2($atts, $content = null) {
	extract(shortcode_atts(array(
		'type' => 'facebook',
		'url' => '',
		'title' => '',
		'target' => 'blank',
	), $atts));

	switch ($target) {
		case "_blank":
		case "blank":
			$target = ' target="_blank" ';
			break;
		default:
			$target = '';
			break;
	}

	global $smof_data;
	$animation = $smof_data['css3_animation_class'];

	// Properly escape our data
	if ($url)
		$url = ' href="' . esc_url( $url ) . '"';
	else {
		$url = ($smof_data['social_' . $type]) ? $smof_data['social_' . $type] : '#';
		$url = ' href="' . esc_url( $url ) . '"';
	}
	// Properly escape our data
	if ($title) {
		$title = ' data-tip="' . esc_attr($title) . '"';
		$tooltip_class = ' tooltip';
	} else {
		$tooltip_class = '';
	}

	return '<a class="footer_social2 '. esc_attr($type) .'-c"' . $url . $title . $target .'>'.$content.'
	<img src="' . get_template_directory_uri() .'/social/'. esc_attr($type) .'.png">
	</a>';
}
add_shortcode('social-link2', 'social_link_shortcode2');


// Progress 1
function progress1_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'percent' => '1',
		'color' => '#313a43',
		'title' => 'FlatBox',
	), $atts));

	return	'<div class="progress-bar prog_col" data-percent="'. $percent .'" data-color="'. $color .'">
                	<div></div>
                    <span class="progress-title">'. $title .'</span>
         </div>';
}
add_shortcode('progress1', 'progress1_shortcode');

// Progress 2
function progress2_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'percent' => '1',
		'color' => '#313a43',
		'title' => 'FlatBox',
	), $atts));


    return '<div class="col" >
    <div class="circular-bar-green donutalign firaschart" data-percent="'. $percent .'" data-color="'. $color .'"></div>
                <p class="textcenter med_text">'. $title .'</p>
                </div>';
}
add_shortcode('progress2', 'progress2_shortcode');

// Note
function note_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'text' => '',
		'title' => '',
		'color' => '#0bb697',
		'button' => '',
		'link' => '',
	), $atts));

	if ($button){
		return	'<div class="short_note" style="background: url(' . get_template_directory_uri() .'/img/corner.png) no-repeat top right '. $color .';">
			<h2>'. $title .'</h2>
			<p>'. $text .'</p>
			<a href="'. $link .'">'. $button .'</a>
		</div>';
	}else{
	return	'<div class="short_note" style="background: url(' . get_template_directory_uri() .'/img/corner.png) no-repeat top right '. $color .';">
			<h2>'. $title .'</h2>
			<p>'. $text .'</p>
		</div>';
	}

}
add_shortcode('note', 'note_shortcode');


function chart_function( $atts ) {
	extract(shortcode_atts(array(
		'data' => '',
		'chart_type' => 'pie',
		'title' => 'Chart',
		'labels' => '',
		'size' => '640x480',
		'background_color' => 'FFFFFF',
		'colors' => '',
	), $atts));

	switch ($chart_type) {
		case 'line' :
			$chart_type = 'lc';
			break;
		case 'pie' :
			$chart_type = 'p3';
			break;
		default :
			break;
	}

	$attributes = '';
	$attributes .= '&chd=t:'.$smof_data.'';
	$attributes .= '&chtt='.urlencode($title).'';
	$attributes .= '&chl='.$labels.'';
	$attributes .= '&chs='.$size.'';
	$attributes .= '&chf='.$background_color.'';
	$attributes .= '&chco='.$colors.'';

	return '<img src="http://chart.apis.google.com/chart?cht='.$chart_type.''.$attributes.'" class="scale" title="' . $title . '" alt="' . $title . '" />';
}
add_shortcode('chart', 'chart_function');

// Separator
function sep_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('size' => 'small'),$atts));
	return '<div class="sep sep-' . esc_attr($size) . '"></div>';
}
add_shortcode('sep', 'sep_shortcode');

function cooler_grid_row( $atts, $content = null ) {
	return '<div class="row">' . do_shortcode($content) . '</div>';
}
add_shortcode('gridrow', 'cooler_grid_row');

function cooler_grid1( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid1 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid1', 'cooler_grid1');

function cooler_grid2( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid2 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid2', 'cooler_grid2');
add_shortcode('one_fourth', 'cooler_grid2');

function cooler_grid3( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid3 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid3', 'cooler_grid3');

function cooler_grid4( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid4 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid4', 'cooler_grid4');
add_shortcode('one_third', 'cooler_grid4');

function cooler_grid5( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid5 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid5', 'cooler_grid5');

function cooler_grid6( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid6 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid6', 'cooler_grid6');
add_shortcode('one_half', 'cooler_grid6');

function cooler_grid7( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid7 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid7', 'cooler_grid7');

function cooler_grid8( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid8 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid8', 'cooler_grid8');
add_shortcode('two_third', 'cooler_grid8');
add_shortcode('three_fourth', 'cooler_grid8');

function cooler_grid9( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid9 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid9', 'cooler_grid9');

function cooler_grid10( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid10 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid10', 'cooler_grid10');

function cooler_grid11( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid11 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid11', 'cooler_grid11');

function cooler_grid12( $atts, $content = null ) {
	extract(shortcode_atts(array('first' => false, 'last' => false),$atts));
	$class = ($first) ? ' alpha' : '';
	$class .= ($last) ? ' omega' : '';
	return '<div class="grid12 col' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid12', 'cooler_grid12');
add_shortcode('one_full', 'cooler_grid12');

// Clear Grid
function clear_shortcode($atts, $content = null) {
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'clear_shortcode');

?>