<?php
/**
 * Theme Shortcodes Functions
*/


/* ==================================================================================================
   ==                                       ADMIN SETUP                                            ==
   ================================================================================================== */

add_filter('the_excerpt', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');		// Enable shortcodes in widgets

// Clear paragraph tags around shortcodes
if(!function_exists('shortcode_empty_paragraph_fix')) {
	add_filter('the_content', 'shortcode_empty_paragraph_fix');
	function shortcode_empty_paragraph_fix($content) {   
		$array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
}

// Show shortcodes list in admin editor
add_action('media_buttons','add_sc_select', 11);
function add_sc_select(){

	$shortcodes_list = '<select id="sc_select"><option value="">&nbsp;*Select Shortcode*&nbsp;</option>';

	$shortcodes_list .= '<option value="'
		. "[title style='1']Title text here[/title]"
		. '">Title</option>';
	$shortcodes_list .= '<option value="'
		. "[line style='solid' top='10' bottom='10' width='100%' height='1' color='']"
		. '">Line</option>';
	$shortcodes_list .= '<option value="'
		. "[infobox style='regular' static='1']Highlight text here[/infobox]"
		. '">Infobox</option>';
	$shortcodes_list .= '<option value="' 
		. "[image src='' width='190' height='145' title='' align='left' alt='']" 
		. '">Image</option>';
	$shortcodes_list .= '<option value="'
		. "[highlight color='white' backcolor='#ff0000']Highlighted text here[/highlight]"
		. '">Highlight</option>';
	$shortcodes_list .= '<option value="'
		. "[quote style='1' cite='']Quoted text here[/quote]"
		. '">Quote</option>';
	$shortcodes_list .= '<option value="'
		. "[tooltip title='Tooltip title']Marked text here[/tooltip]"
		. '">Tooltip</option>';
	$shortcodes_list .= '<option value="'
		. "[dropcaps style='1']Dropcaps paragraph text here[/dropcaps]"
		. '">Dropcaps</option>';
	$shortcodes_list .= '<option value="'
		. "[audio url='' controls='1']"
		. '">Audio</option>';
	$shortcodes_list .= '<option value="'
		. "[video url='' width='480' height='270']"
		. '">Video</option>';
	$shortcodes_list .= '<option value="' 
		. "[section style='']Section inner text here[/section]" 
		. '">Section</option>';
	$shortcodes_list .= '<option value="'
		. "[columns count='2']
		[column_item]Item 1 inner text here[/column_item]
		[column_item]Item 2 inner text here[/column_item]
		[/columns]"
		. '">Columns</option>';
	$shortcodes_list .= '<option value="' 
		. "[list style='regular']
		[list_item]List Item 1 inner text here[/list_item]
		[list_item]List Item 2 inner text here[/list_item]
		[list_item]List Item 3 inner text here[/list_item]
		[/list]"
		. '">List</option>';
	$shortcodes_list .= '<option value="'
		. "[tabs tab_names='Tab 1|Tab 2|Tab 3' style='1' initial='1']
		[tab]Tab 1 inner text here[/tab]
		[tab]Tab 2 inner text here[/tab]
		[tab]Tab 3 inner text here[/tab]
		[/tabs]"
		. '">Tabs</option>';
	$shortcodes_list .= '<option value="'
		. "[accordion style='1' initial='1']
		[accordion_item title='Title 1']Item 1 inner text here[/accordion_item]
		[accordion_item title='Title 2']Item 2 inner text here[/accordion_item]
		[accordion_item title='Title 3']Item 3 inner text here[/accordion_item]
		[/accordion]"
		. '">Accordion</option>';
	$shortcodes_list .= '<option value="'
		. "[toggles initial='1']
		[toggles_item title='Title 1']Item 1 inner text here[/toggles_item]
		[toggles_item title='Title 2']Item 2 inner text here[/toggles_item]
		[toggles_item title='Title 3']Item 3 inner text here[/toggles_item]
		[/toggles]"
		. '">Toggles</option>';
	$shortcodes_list .= '<option value="'
		. "[table]
		Paste here table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/ or http://html-tables.com/
		[/table]"
		. '">Table</option>';
	$shortcodes_list .= '<option value="'."[googlemap address='' width='400' height='240']".'">Google Map</option>';	
	$shortcodes_list .= '<option value="'."[contact_form title='Contact Form' description='']".'">Contact form</option>';	
	$shortcodes_list .= '<option value="'."[hide selector='']".'">Hide block</option>';
	$shortcodes_list .= '</select>';
	echo $shortcodes_list;
}

// Shortcodes list select handler
add_action('admin_head', 'button_js');
function button_js() {
	echo '<script type="text/javascript">
	jQuery(document).ready(function(){
	   jQuery("#sc_select").change(function() {
			  send_to_editor(jQuery("#sc_select :selected").val());
			  jQuery("#sc_select option:first-child").attr("selected", true);
        		  return false;
		});
	});
	</script>';
}	






/* ==================================================================================================
   ==                                       USERS SHORTCODES                                       ==
   ================================================================================================== */



// ---------------------------------- [title] ---------------------------------------


add_shortcode('title', 'sc_title');

/*
[title id="unique_id" style="1-6"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/title]
*/
function sc_title($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "1"
    ), $atts));
	$style = min(6, max(1, $style));
	return '<h' . $style . ($id ? ' id="' . $id . '"' : '') . ' class="sc_title sc_title_style_' . $style . '">' . do_shortcode($content) . '</h' . $style . '>';
}

// ---------------------------------- [/title] ---------------------------------------



// ---------------------------------- [line] ---------------------------------------


add_shortcode('line', 'sc_line');

/*
[line id="unique_id" style="none|solid|dashed|dotted|double|groove|ridge|inset|outset" top="margin_in_pixels" bottom="margin_in_pixels" width="width_in_pixels_or_percent" height="line_thickness_in_pixels" color="line_color's_name_or_#rrggbb"]
*/
function sc_line($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "solid",
		"color" => "",
		"width" => "-1",
		"height" => "-1",
		"top" => "-1",
		"bottom" => "-1"
    ), $atts));
	$ed = my_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$w = $width >= 0 ? 'width:' . $width . $ed . ';' : '';
	$h = $height >= 0 ? 'border-top-width:' . $height . 'px;' : '';
	$t = $top >= 0 ? 'margin-top:' . $top . 'px;' : '';
	$b = $bottom >= 0 ? 'margin-bottom:' . $bottom . 'px;' : '';
	$s = $style != '' ? 'border-top-style:' . $style . ';' : '';
	$c = $color != '' ? 'border-top-color:' . $color . ';' : '';
	$rez = $w . $h . $t . $b . $s .$c;
	$rez = $rez ? ' style="' . $rez . '"' : '';
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_line' . ($style != '' ? ' sc_line_style_' . $style : '') . '"' . $rez . '></div>';
}

// ---------------------------------- [/line] ---------------------------------------



// ---------------------------------- [infoboxes] ---------------------------------------


add_shortcode('infobox', 'sc_infobox');

/*
[infobox id="unique_id" style="regular|info|success|error|result" static="0|1"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/infobox]
*/
function sc_infobox($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "regular",
		"static" => "1"
    ), $atts));
	return '
		<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_infobox sc_infobox_style_' . $style . ($static==0 ? ' sc_infobox_closeable' : '') . '"' . ($static==0 ? ' style="cursor:pointer"' : '') . '>
			' . do_shortcode($content) . '
		</div>
		';
}

// ---------------------------------- [/infoboxes] ---------------------------------------



// ---------------------------------- [highlight] ---------------------------------------


add_shortcode('highlight', 'sc_highlight');

/*
[highlight id="unique_id" color="fore_color's_name_or_#rrggbb" backcolor="back_color's_name_or_#rrggbb"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/highlight]
*/
function sc_highlight($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"color" => "",
		"backcolor" => ""
    ), $atts));
	$c = $color != '' ? 'color:' . $color . ';' : '';
	$b = $backcolor != '' ? 'background-color:' . $backcolor . ';' : '';
	$rez = $c . $b;
	$rez = $rez ? ' style="' . $rez . '"' : '';
	return '<span' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_highlight"' . $rez . '>' . do_shortcode($content) . '</span>';
}

// ---------------------------------- [/highlight] ---------------------------------------





// ---------------------------------- [image] ---------------------------------------


add_shortcode('image', 'sc_image');

/*
[image id="unique_id" src="image_url" width="width_in_pixels" height="height_in_pixels" title="image's_title" align="left|right" alt=""]
*/
function sc_image($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"src" => "",
		"title" => "",
		"align" => "",
		"width" => "-1",
		"height" => "-1",
		"alt" => ""
    ), $atts));
	$w = $width > 0 ? 'width:' . $width . 'px;' : '';
	$h = $height > 0 ? 'height:' . $height . 'px;' : '';
	$a = $align != '' ? 'float:' . $align . ';' : '';
	$rez = $w . $h . $a;
	$rez = $rez ? ' style="' . $rez . '"' : '';
	return '
		<figure' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_image ' . ($align ? ' sc_image_align_' . $align : '') . '"' . $rez . '>
			<img src="' . $src . '" border="0"' . ($alt ? ' alt="' . $alt . '"' : '') . '/>
			' . (trim($title) ? '<figcaption>' . $title . '</figcaption>' : '') . '
		</figure>
	';
}

// ---------------------------------- [/image] ---------------------------------------





// ---------------------------------- [quote] ---------------------------------------


add_shortcode('quote', 'sc_quote');

/*
[quote id="unique_id" style="1|2" cite="url"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/quote]
*/
function sc_quote($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "1",
		"cite" => ""
    ), $atts));
	$cite = $cite != '' ? ' cite="' . $cite . '"' : '';
	$style = min(2, max(1, $style));
	return ($style == 1 ? '<blockquote' : '<q' ) . ($id ? ' id="' . $id . '"' : '') . $cite . ' class="sc_quote sc_quote_style_' . $style . '"' . '>' .($style == 1 ? '<span class="quotes icon-quote-left"></span>' : '').do_shortcode($content) . ($style == 1 ? '</blockquote>' : '</q>');
}

// ---------------------------------- [/quote] ---------------------------------------





// ---------------------------------- [tooltip] ---------------------------------------


add_shortcode('tooltip', 'sc_tooltip');

/*
[tooltip id="unique_id" title="Tooltip text here"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/tooltip]
*/
function sc_tooltip($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"title" => ""
    ), $atts));
	return '<span' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_tooltip_parent">' . do_shortcode($content) . '<span class="sc_tooltip">' . $title . '</span></span>';
}

// ---------------------------------- [/tooltip] ---------------------------------------


						


// ---------------------------------- [dropcaps] ---------------------------------------

add_shortcode('dropcaps', 'sc_dropcaps');

//[dropcaps id="unique_id" style="1-3"]paragraph text[/dropcaps]
function sc_dropcaps($atts, $content=null){
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "1"
    ), $atts));
	$style = min(3, max(1, $style));
	return '<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_dropcaps sc_dropcaps_style_' . $style . '">' 
		. do_shortcode('<span class="sc_dropcap">' . my_substr($content, 0, 1) . '</span>' . my_substr($content, 1))
		. '</div>';
}
// ---------------------------------- [/dropcaps] ---------------------------------------



// ---------------------------------- [audio] ---------------------------------------

add_shortcode("audio", "sc_audio");
						
//[audio id="unique_id" url="http://webglogic.com/audio/AirReview-Landmarks-02-ChasingCorporate.mp3" controls="0|1"]
function sc_audio($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => "",
		"controls" => "",
		"url" => '#'
	), $atts));
	
	return '<audio' . ($id ? ' id="' . $id . '"' : '') . ' src="' . $url . '" class="sc_audio" ' . ($controls == 1 ? ' controls="controls"' : '') . ' width="100%" height="60"></audio>';
}

// ---------------------------------- [/audio] ---------------------------------------
						


// ---------------------------------- [video] ---------------------------------------

add_shortcode("video", "sc_video");

//[video id="unique_id" url="http://player.vimeo.com/video/20245032?title=0&amp;byline=0&amp;portrait=0" width="" height=""]
function sc_video($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => "",
		"url" => '#',
		"width" => '612',
		"height" => '344'
	), $atts));
	$width = max(10, (int) $width);
	$height = max(10, (int) $height);
	$url = getVideoPlayerURL($url);
	return '<iframe' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_video" src="' . $url . '" width="' . $width . '" height="' . $height . '" frameborder="0" webkitAllowFullScreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowFullScreen="allowFullScreen"></iframe>';
}
// ---------------------------------- [/video] ---------------------------------------



// ---------------------------------- [section] ---------------------------------------


add_shortcode('section', 'sc_section');

/*
[section id="unique_id" style="class_name"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/section]
*/
function sc_section($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"class" => "",
		"style" => ""
    ), $atts));
	return '
		<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_section' . ($class ? $class : '') . '"' . ($style ?  ' style="' . $style . '"' : '') . '>
			' . do_shortcode($content) . '
		</div>
	';
}

// ---------------------------------- [/section] ---------------------------------------




// ---------------------------------- [columns] ---------------------------------------


add_shortcode('columns', 'sc_columns');

/*
[columns id="unique_id" count="number"]
	[column_item id="unique_id" span="2 - number_columns"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta, odio arcu vut natoque dolor ut, enim etiam vut augue. Ac augue amet quis integer ut dictumst? Elit, augue vut egestas! Tristique phasellus cursus egestas a nec a! Sociis et? Augue velit natoque, amet, augue. Vel eu diam, facilisis arcu.[/column_item]
	[column_item]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in. Magna eros hac montes, et velit. Odio aliquam phasellus enim platea amet. Turpis dictumst ultrices, rhoncus aenean pulvinar? Mus sed rhoncus et cras egestas, non etiam a? Montes? Ac aliquam in nec nisi amet eros! Facilisis! Scelerisque in.[/column_item]
	[column_item]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim. Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna.[/column_item]
	[column_item]Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna. Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim.[/column_item]
[/columns]
*/
$sc_columns_counter = 0;
function sc_columns($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"count" => "2"
    ), $atts));
	global $sc_columns_counter;
	$sc_columns_counter = 0;
	$count = max(1, min(5, (int) $count));
	return '
		<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_columns sc_columns_count_' . $count . '">
			' . do_shortcode($content).'
		</div>
	';
}


add_shortcode('column_item', 'sc_column_item');

//[column_item]
function sc_column_item($atts, $content=null) {
	extract(shortcode_atts( array(
		"id" => "",
		"span" => "1"
	), $atts));
	global $sc_columns_counter;
	$sc_columns_counter++;
	$span = max(1, min(4, (int) $span));
	return '
		<div' . ($id ? ' id="' . $id . '"' : '') . ' class="content' 
					. ($sc_columns_counter % 2 == 1 ? ' odd' : ' even') 
					. ($sc_columns_counter == 1 ? ' first' : '') 
					. ($span > 1 ? ' span_'.$span : '') 
					. '">
			' . do_shortcode($content) . '
		</div>
	';
}

// ---------------------------------- [/columns] ---------------------------------------



// ---------------------------------- [list] ---------------------------------------

add_shortcode('list', 'sc_list');

/*
[list id="unique_id" style="regular|check|bad|star"]
	[list_item id="unique_id" title="title_of_element"]Et adipiscing integer.[/list_item]
	[list_item]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in.[/list_item]
	[list_item]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer.[/list_item]
	[list_item]Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus.[/list_item]
[/list]
*/
$sc_list_counter = 0;
function sc_list($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "regular"
    ), $atts));
	global $sc_list_counter;
	$sc_list_counter = 0;
	if (trim($style) == '') $style = 'regular';
	return '
		<ul' . ($id ? ' id="' . $id . '"' : '') . ($style!='' && $style!='default' ? ' class="sc_list sc_list_style_' . $style . '"' : ''). '>
			' . do_shortcode($content) . '
		</ul>
		';
}


add_shortcode('list_item', 'sc_list_item');

//[list_item]
function sc_list_item($atts, $content=null) {
	extract(shortcode_atts( array(
		"id" => "",
		"title" => ""
	), $atts));
	global $sc_list_counter;
	$sc_list_counter++;
	return '
		<li' . ($id ? ' id="' . $id . '"' : '') . ' class="item' . ($sc_list_counter % 2 == 1 ? ' odd' : ' even') . ($sc_list_counter == 1 ? ' first' : '') . '"' . ($title ? ' title="' . $title . '"' : '') . '><span class="bullet"></span>
			' . do_shortcode($content) 
			. '
		</li>
	';
}

// ---------------------------------- [/list] ---------------------------------------








// ---------------------------------- [tabs] ---------------------------------------

add_shortcode("tabs", "sc_tabs");

/*
[tabs id="unique_id" tab_names="Planning|Development|Support" style="1|2" initial="1 - num_tabs"]
	[tab]Randomised words which don't look even slightly believable. If you are going to use a passage. You need to be sure there isn't anything embarrassing hidden in the middle of text established fact that a reader will be istracted by the readable content of a page when looking at its layout.[/tab]
	[tab]Fact reader will be distracted by the <a href="#" class="main_link">readable content</a> of a page when. Looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using content here, content here, making it look like readable English will uncover many web sites still in their infancy. Various versions have evolved over. There are many variations of passages of Lorem Ipsum available, but the majority.[/tab]
	[tab]Distracted by the  readable content  of a page when. Looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using content here, content here, making it look like readable English will uncover many web sites still in their infancy. Various versions have  evolved over.  There are many variations of passages of Lorem Ipsum available.[/tab]
[/tabs]
*/
$sc_tab_counter = 0;
function sc_tabs($atts, $content = null) {
    extract(shortcode_atts(array(
		"id" => "",
		"tab_names" => "",
		"style" => "1",
		"initial" => "1"
    ), $atts));

	global $sc_tab_counter;
	$sc_tab_counter = 0;
	$title_chunks = explode("|", $tab_names);
	$style = max(1, min(2, (int) $style));
	$initial = max(1, min(count($title_chunks), (int) $initial));
	
	$tabs_output = '
		<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_tabs sc_tabs_style_' . $style . '">
			<ul class="tab_names">';

	$titles_output = '';
	for ($i = 0; $i < count($title_chunks); $i++) {
		$classes = array('tab_name');
		if ($i == 0) $classes[] = 'first';
		else if ($i == count($title_chunks) - 1) $classes[] = 'last';
		$class_str = join(' ', $classes);
		$titles_output .= '
				<li' . ($class_str ? ' class="' . $class_str . '"' : '') . '><a href="#">' . $title_chunks[$i] . '</a></li>';
	}

	$tabs_output .= $titles_output.'
			</ul>
			' . do_shortcode($content) . '
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery(\'div' . ($id ? '#' . $id : '') . '.sc_tabs_style_' . $style. '\').tabs(\'div.content\', 
						{
							tabs: \'li.tab_name > a\',
							initialIndex : ' . ($initial - 1) . '
						}
					);
				});
			</script>
		</div>
	';
	return $tabs_output;
}


add_shortcode("tab", "sc_tab");

//[tab id="tab_id"]
function sc_tab($atts, $content = null) {
    extract(shortcode_atts(array(
		"id" => ""
    ), $atts));
	global $sc_tab_counter;
	$sc_tab_counter++;
	return '
			<div' . ($id ? ' id="' . $id . '"' : '') . ' class="content' . ($sc_tab_counter % 2 == 1 ? ' odd' : ' even') . ($sc_tab_counter == 1 ? ' first' : '') . '">
				' . do_shortcode($content) . '
			</div>
	';
}

// ---------------------------------- [/tabs] ---------------------------------------



// ---------------------------------- [accordion] ---------------------------------------


add_shortcode('accordion', 'sc_accordion');

/*
[accordion id="unique_id" style="1|2" initial="1 - num_elements"]
	[accordion_item title="Et adipiscing integer, scelerisque pid"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta, odio arcu vut natoque dolor ut, enim etiam vut augue. Ac augue amet quis integer ut dictumst? Elit, augue vut egestas! Tristique phasellus cursus egestas a nec a! Sociis et? Augue velit natoque, amet, augue. Vel eu diam, facilisis arcu.[/accordion_item]
	[accordion_item title="A pulvinar ut, parturient enim porta ut sed"]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in. Magna eros hac montes, et velit. Odio aliquam phasellus enim platea amet. Turpis dictumst ultrices, rhoncus aenean pulvinar? Mus sed rhoncus et cras egestas, non etiam a? Montes? Ac aliquam in nec nisi amet eros! Facilisis! Scelerisque in.[/accordion_item]
	[accordion_item title="Duis sociis, elit odio dapibus nec"]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim. Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna.[/accordion_item]
	[accordion_item title="Nec purus, cras tincidunt rhoncus"]Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna. Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim.[/accordion_item]
[/accordion]
*/
$sc_accordion_counter = 0;
function sc_accordion($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "1",
		"initial" => "1"
    ), $atts));
	global $sc_accordion_counter;
	$sc_accordion_counter = 0;
	$style = max(1, min(2, (int) $style));
	$initial = max(1, (int) $initial);
	return '
		<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_accordion sc_accordion_style_' . $style . '" >
			' . do_shortcode($content) . '
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(\'div' . ($id ? '#' . $id : '') . '.sc_accordion_style_' . $style . '\').tabs(\'div.item > div.content\', {
					tabs: \'h5.title > a\',
					effect : \'slide\',
					currentClose: true
					' . ($initial!='' ? ', initialIndex : ' . ($initial-1) : '') . '
				});
			});
		</script>		
	';
}


add_shortcode('accordion_item', 'sc_accordion_item');

//[accordion_item]
function sc_accordion_item($atts, $content=null) {
	extract(shortcode_atts( array(
		"id" => "",
		"title" => ""
	), $atts));
	global $sc_accordion_counter;
	$sc_accordion_counter++;
	return '
		<div' . ($id ? ' id="' . $id . '"' : '') . ' class="item' . ($sc_accordion_counter % 2 == 1 ? ' odd' : ' even') . ($sc_accordion_counter == 1 ? ' first' : '') . '">
			<h5 class="title"><a href="#"><span class="button"></span>'	. $title . '</a></h5>
			<div class="content">
				' . do_shortcode($content) . '
			</div>
		</div>
	';
}

// ---------------------------------- [/accordion] ---------------------------------------



// ---------------------------------- [toggles] ---------------------------------------


add_shortcode('toggles', 'sc_toggles');

/*
[toggles id="unique_id" initial="1 - num_elements"]
	[toggles_item title="Et adipiscing integer, scelerisque pid"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta, odio arcu vut natoque dolor ut, enim etiam vut augue. Ac augue amet quis integer ut dictumst? Elit, augue vut egestas! Tristique phasellus cursus egestas a nec a! Sociis et? Augue velit natoque, amet, augue. Vel eu diam, facilisis arcu.[/toggles_item]
	[toggles_item title="A pulvinar ut, parturient enim porta ut sed"]A pulvinar ut, parturient enim porta ut sed, mus amet nunc, in. Magna eros hac montes, et velit. Odio aliquam phasellus enim platea amet. Turpis dictumst ultrices, rhoncus aenean pulvinar? Mus sed rhoncus et cras egestas, non etiam a? Montes? Ac aliquam in nec nisi amet eros! Facilisis! Scelerisque in.[/toggles_item]
	[toggles_item title="Duis sociis, elit odio dapibus nec"]Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim. Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna.[/toggles_item]
	[toggles_item title="Nec purus, cras tincidunt rhoncus"]Nec purus, cras tincidunt rhoncus proin lacus porttitor rhoncus, vut enim habitasse cum magna. Duis sociis, elit odio dapibus nec, dignissim purus est magna integer eu porta sagittis ut, pid rhoncus facilisis porttitor porta, et, urna parturient mid augue a, in sit arcu augue, sit lectus, natoque montes odio, enim.[/toggles_item]
[/toggles]
*/
$sc_toggle_counter = 0;
function sc_toggles($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"initial" => ""
    ), $atts));
	global $sc_toggle_counter;
	$sc_toggle_counter = 0;
	$initial = max(1, (int) $initial);
	return '
		<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_toggles">
			'
			. do_shortcode($content)
			. '
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(\'div' . ($id ? '#' . $id : '') . '.sc_toggles\').tabs(\'div.item > div.content\', {
					tabs: \'h5.title > a\',
					effect : \'slide\',
					currentClose: true,
					anotherClose: false
					' . ($initial!='' ? ', initialIndex : ' . ($initial-1) : '') . '
				});
			});
		</script>		
	';
}


add_shortcode('toggles_item', 'sc_toggles_item');

//[toggles_item]
function sc_toggles_item($atts, $content=null) {
	extract(shortcode_atts( array(
		"id" => "",
		"title" => ""
	), $atts));
	global $sc_toggle_counter;
	$sc_toggle_counter++;
	return '
		<div' . ($id ? ' id="' . $id . '"' : '') . ' class="item' . ($sc_toggle_counter % 2 == 1 ? ' odd' : ' even') . ($sc_toggle_counter == 1 ? ' first' : '') . '">
			<h5 class="title"><a href="#"><span class="button"></span>' . $title . '</a></h5>
			<div class="content">
				' . do_shortcode($content) . '
			</div>
		</div>
	';
}

// ---------------------------------- [/toggles] ---------------------------------------



// ---------------------------------- [table] ---------------------------------------


add_shortcode('table', 'sc_table');

/*
[table id="unique_id" style="regular"]
Table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/
[/table]
*/
function sc_table($atts, $content=null){	
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "regular"
    ), $atts));
	$content = str_replace(
				array('<p><table', 'table></p>', '><br />'),
				array('<table', 'table>', '>'),
				html_entity_decode($content, ENT_COMPAT, 'UTF-8'));
	return '
		<div' . ($id ? ' id="' . $id . '"' : '') . ' class="sc_table sc_table_style_' . $style . '">
			' . do_shortcode($content) . '
		</div>
	';
}

// ---------------------------------- [/table] ---------------------------------------



// ---------------------------------- [Google maps] ---------------------------------------

add_shortcode("googlemap", "sc_google_map");

//[googlemap id="unique_id" address="your_address" width="width_in_pixels_or_percent" height="height_in_pixels"]
function sc_google_map($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => "sc_googlemap",
		"width" => "100%",
		"height" => "170",
		"address" => ""
	), $atts));

	$ed = my_substr($width, -1)=='%' ? '%' : 'px';
	if ((int) $width < 100 && $ed != '%') $width='100%';
	if ((int) $height < 50) $height='100';
	$width = (int) str_replace('%', '', $width);
	$w = $width >= 0 ? 'width:' . $width . $ed . ';' : '';
	$h = $height >= 0 ? 'height:' . $height . 'px;' : '';
	$rez = $w . $h;
	$rez = $rez ? ' style="' . $rez . '"' : '';
	$prot = is_ssl()? 'https' : 'http'; 
	wp_enqueue_script( 'googlemap', $prot.'://maps.google.com/maps/api/js?sensor=false', array(), '1.0.0', true );
	wp_enqueue_script( 'googlemap_init', get_template_directory_uri().'/js/googlemap_init.js', array(), '1.0.0', true );
	return '
	    <script type="text/javascript">
	    	jQuery(document).ready(function(){
				googlemap_init(jQuery("#' . $id . '").get(0), "' . $address . '");
	    	});
		</script>
		<div id="' . $id . '"' . $rez . ' class="sc_googlemap"></div>
	';
}
// ---------------------------------- [/Google maps] ---------------------------------------





// ---------------------------------- [Contact form] ---------------------------------------

add_shortcode("contact_form", "sc_contact_form");

//[contact_form id="unique_id" title="Contact Form" description="Mauris aliquam habitasse magna a arcu eu mus sociis? Enim nunc? Integer facilisis, et eu dictumst, adipiscing tempor ultricies, lundium urna lacus quis."]
function sc_contact_form($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => "",
		"title" => "Contact Form",
		"description" => ""
	), $atts));
	global $ajax_nonce, $ajax_url;
	return '
			<div ' . ($id ? ' id="' . $id . '"' : '') . 'class="sc_contact_form">
				'
				. ($title ? '<h3 class="title">' . $title . '</h3>' : '')
				. ($description ? '<span class="description">' . $description . '</span>' : '')
				. 
				'
				<form' . ($id ? ' id="' . $id . '"' : '') . ' method="post" action="' . $ajax_url . '">
					<div class="field">
						<label for="sc_contact_form_username" class="required">' . __('Name', 'wpspace') . '</label>
						<input type="text" id="sc_contact_form_username" name="username">
                    </div>
					<div class="field">
						<label for="sc_contact_form_email" class="required">' . __('Email', 'wpspace') . '</label>
						<input type="text" id="sc_contact_form_email" name="email">
                    </div>
					<div class="field message">
						<label for="sc_contact_form_message" class="required">' . __('Your Message', 'wpspace') . '</label>
						<textarea id="sc_contact_form_message" name="message"></textarea>
                    </div>
					<div class="button">
						<a href="#" class="enter"><span>' . __('Submit', 'wpspace') . '</span></a>
                    </div>
				</form>
				<div class="result sc_infobox"></div>
				<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery(".sc_contact_form .enter").click(function(e){
							userSubmitForm();
							e.preventDefault();
							return false;
						});
					});
					function userSubmitForm(){
						
						var error = formValidate(jQuery(".sc_contact_form form"), {
							error_message_show: true,
							error_message_time: 5000,
							error_message_class: "sc_infobox sc_infobox_style_error",
							error_fields_class: "error_fields_class",
							exit_after_first_error: false,
							rules: [
								{
									field: "username",
									min_length: { value: 1,	 message: empt },
									max_length: { value: 160, message: to_lng}
								},
								{
									field: "email",
									min_length: { value: 7,	 message: empt_mail },
									max_length: { value: 60, message: to_lng_mail},
									mask: { value: "^([a-zA-Z0-9_\\-]+\\\.)*[a-zA-Z0-9_\\\-]+@[a-zA-Z0-9_\\-]+(\\\.[a-zA-Z0-9_\\-]+)*\\\.[a-zA-Z]{2,6}$", message: incor}
								},
								{
									field: "message",
									min_length: { value: 1,  message: mes_empt },
									max_length: { value: 1600, message: to_lng_mes}
								}
							]
						});
						if (!error) {
							var user_name  = jQuery(".sc_contact_form #sc_contact_form_username").val();
							var user_email = jQuery(".sc_contact_form #sc_contact_form_email").val();
							var user_site  = jQuery(".sc_contact_form #sc_contact_form_site").val();
							var user_msg   = jQuery(".sc_contact_form #sc_contact_form_message").val();
							var data = {
								action: "submit_contact_form",
								nonce: "' . $ajax_nonce . '",
								user_name: user_name,
								user_email: user_email,
								user_site: user_site,
								user_msg: user_msg
							};
							jQuery.post("' . $ajax_url . '", data, userSubmitFormResponse, "text");
						}
					}
					
					function userSubmitFormResponse(response) {
						var rez = JSON.parse(response);
						jQuery(".sc_contact_form .result")
							.toggleClass("sc_infobox_style_error", false)
							.toggleClass("sc_infobox_style_success", false);
						if (rez.error == "") {
							jQuery(".sc_contact_form .result").addClass("sc_infobox_style_success").html("' . __('Your message has been sent.', 'wpspace') . '");
							setTimeout("jQuery(\'.sc_contact_form .result\').fadeOut(); jQuery(\'.sc_contact_form form\').get(0).reset();", 3000);
						} else {
							jQuery(".sc_contact_form .result").addClass("sc_infobox_style_error").html("' . __('Transmit failed!', 'wpspace').' " + rez.error);
						}
						jQuery(".sc_contact_form .result").fadeIn();
					}
				</script>
			</div>
	';
}



// Submit contact form
add_action('wp_ajax_submit_contact_form', 'submit_contact_form_callback');
add_action('wp_ajax_nopriv_submit_contact_form', 'submit_contact_form_callback');

function submit_contact_form_callback() {
	global $_REQUEST;

	if ( !wp_verify_nonce( $_REQUEST['nonce'], 'ajax_nonce' ) )
		die();

	$response = array('error'=>'');

	$user_name = my_substr($_REQUEST['user_name'], 0, 20);
	$user_email = my_substr($_REQUEST['user_email'], 0, 40);
	$user_msg = getShortString($_REQUEST['user_msg'], 1000);

	if (!($contact_email = get_theme_option('user_contact_email')))
		$contact_email = get_theme_option('user_email');	
	
	if (trim($contact_email)!='') {
		$subj = sprintf(__('Site %s - Contact form message from %s', 'wpspace'), get_bloginfo('site_name'), $user_name);
		$msg = "
Name: $user_name
E-mail: $user_email

Message: $user_msg

............ " . get_bloginfo('site_name') . " (" . home_url() . ") ............";
	
		$head = "Content-Type: text/plain; charset=\"utf-8\"\n"
			. "X-Mailer: PHP/" . phpversion() . "\n"
			. "Reply-To: $user_email\n"
			. "To: $contact_email\n"
			. "From: $user_email\n"
			. "Subject: $subj\n";
	
		if (!@mail($contact_email, $subj, $msg, $head)) {
			$response['error'] = 'Error send message!';
		}
	} else 
			$response['error'] = 'Error send message!';

	echo json_encode($response);
	die();
}
// ---------------------------------- [/Contact form] ---------------------------------------



// ---------------------------------- [hide] ---------------------------------------


add_shortcode('hide', 'sc_hide');

/*
[hide selector="unique_id"]
*/
function sc_hide($atts, $content=null){	
    extract(shortcode_atts(array(
		"selector" => ""
    ), $atts));
	$selector = trim(chop($selector));
	return $selector == '' ? '' : '
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("' . $selector . '").hide();
			});
		</script>		
	';
}
// ---------------------------------- [/hide] ---------------------------------------
?>