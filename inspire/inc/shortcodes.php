<?php

/****************************
SHORTCODE MECHANICS

LOAD TINYMCE PLUGINS
FIX SHORTCODE EMPTY PARAGRAPHS (AUTOFORMATTING)

****************************/


/****************************
LOAD TINYMCE PLUGINS
****************************/

	add_action('init', 'canon_sc_addbuttons');
	function canon_sc_addbuttons() {
		add_filter("mce_external_plugins", "canon_sc_add_tinymce_plugin");
		add_filter('mce_buttons', 'canon_sc_register_button');
	}

	function canon_sc_add_tinymce_plugin($plugin_array) {
		global $wp_version;

		// if WP version < 3.9 then load the legacy script
		if (version_compare($wp_version, '3.9') >= 0) {
			$filename = "tinymce_scripts.js.php";
		} else {
			$filename = "tinymce_scripts_legacy.js.php";
		}

		$plugin_array['canon_tinymce_shortcodes_plugin'] = get_template_directory_uri()  . "/inc/" . $filename;
		return $plugin_array;
	}
		 
	function canon_sc_register_button($buttons) {
	   array_push($buttons,"canon_tinymce_shortcodes_select"); //"seperator" will make a short space between buttons
	   return $buttons;
	}
	 
/****************************
FIX SHORTCODE EMPTY PARAGRAPHS (AUTOFORMATTING)
****************************/

	add_filter('the_content', 'shortcode_empty_paragraph_fix');
    function shortcode_empty_paragraph_fix($content)
    {   
        $array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
        return $content;
    }


/****************************
THE SHORTCODES

BUTTON
BIGBUTTON
TABS
TAB
TOGGLE
ALERT
HIGHLIGHT
HIGHLIGHTDARK
DROPCAP
BLOCKQUOTE
COLUMNS
LOREM

*****************************/

/****************************
BUTTON
****************************/
add_shortcode('button', 'sc_button');
function sc_button ($atts, $content) {
	extract(shortcode_atts(			
		array (												
			'url' => '#',
			'color' => 'light',
			'content' 	=>  !empty($content) ? $content : 'Button'
		), $atts
	));
	$string = "<a href='$url' class='button $color'>$content</a>";
	return $string;						
}

/****************************
BIGBUTTON
****************************/
add_shortcode('bigbutton', 'sc_bigbutton');
function sc_bigbutton ($atts, $content) {
	extract(shortcode_atts(									
		array (												
			'url' => '#',
			'color' => 'light',
			'content' 	=>  !empty($content) ? $content : 'Button'
		), $atts
	));
	$string = "<a href='$url' class='button big $color'>$content</a>";
	return $string;						
}

/****************************
TABS
****************************/
add_shortcode('tabs', 'sc_tabs');
function sc_tabs ($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
	$string = "<div class='tabs_wrapper'>";
	$string .= "<ul class='tabs'>";
	foreach ($atts as $key => $val) {
		$string .= "<li><a href='#$key'>$val</a></li>";
	}
	$string .= "</ul>";

	$string .= '<div class="tabs_container">';
	$string .= do_shortcode($content);
	$string .= '</div>';

	$string .= "</div>";

	return $string;				
		
}

/****************************
TAB
****************************/
add_shortcode('tab', 'sc_tab');
function sc_tab ($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => 'debug'
	), $atts));

	$string = "<div id='tab$id' class='tab_content'>". do_shortcode($content) . "</div>";

	return $string;
}

/****************************
TOGGLE
****************************/
add_shortcode('toggle', 'sc_toggle');
function sc_toggle ($atts, $content = null) {
	extract(shortcode_atts(									
		array (												
			'title' => 'Toggle Title'
		), $atts
	));

	$string = "<div class='toggle_wrapper'>";
	$string .= "<h3 class='toggle'>$title</h3>";
	$string .= "<div class='toggle_content'>" . do_shortcode($content) . "</div>";
	$string .= "</div>";
	return $string;						
}

/****************************
ALERT
****************************/
add_shortcode('alert', 'sc_alert');
function sc_alert ($atts, $content = null) {
	extract(shortcode_atts(									
		array (												
			'color' => 'yellow'
		), $atts
	));

	$string = "<div class='alert $color'><p>$content</p></div>";
	return $string;						
}

/****************************
HIGHLIGHT
****************************/
add_shortcode('highlight', 'sc_highlight');
function sc_highlight ($atts, $content = null) {
	extract(shortcode_atts(array (), $atts));

	$string = "<span class='highlight'>".do_shortcode($content)."</span>";
	return $string;						
}

/****************************
HIGHLIGHTDARK
****************************/
add_shortcode('highlightdark', 'sc_highlightdark');
function sc_highlightdark ($atts, $content = null) {
	extract(shortcode_atts(array (), $atts));

	$string = "<span class='highlight2'>".do_shortcode($content)."</span>";
	return $string;						
}

/****************************
DROPCAP
****************************/
add_shortcode('dropcap', 'sc_dropcap');
function sc_dropcap ($atts, $content = null) {
	extract(shortcode_atts(array (
		'style' => 'simple'
	), $atts));

	$string = "<span class='dropcap $style'>$content</span>";
	return $string;						
}

/****************************
BLOCKQUOTE
****************************/
add_shortcode('blockquote', 'sc_blockquote');
function sc_blockquote ($atts, $content = null) {
	extract(shortcode_atts(array (), $atts));

	$string = "<blockquote>$content</blockquote>";
	return $string;						
}

/****************************
COLUMNS
****************************/

add_shortcode('column', 'sc_column');
function sc_column ($atts, $content = null) {
	extract(shortcode_atts(array (
		'size' 	=> 'one_half',
		'last'	=> 'no'
	), $atts));

	if ($last == 'yes') {
		$string = "<div class='$size last'>" . do_shortcode($content) . "</div>";
		$string .= "<div class='clearboth'></div>";
	} else {
		$string = "<div class='$size'>" . do_shortcode($content) . "</div>";
	}

	return $string;						
}

/****************************
LOREM
****************************/

add_shortcode('lorem', 'sc_lorem');
function sc_lorem ($atts, $content = null) {
	extract(shortcode_atts(array (
		'paragraphs' => 5
	), $atts));

	$fulltext = "
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed lorem a libero condimentum euismod ornare et turpis. Integer posuere ornare nulla, cursus viverra risus lobortis ullamcorper. Maecenas ut diam nec quam volutpat sollicitudin egestas et nulla. Suspendisse aliquam dolor egestas eros placerat porttitor. Nam dictum ultrices elit eu ullamcorper. Duis auctor sem a felis vulputate lobortis. Praesent auctor nunc nulla, a blandit lacus. Proin molestie volutpat facilisis. Pellentesque accumsan, elit quis lobortis eleifend, sem nisl ultrices velit, placerat vulputate purus neque et eros. Nullam elit dui, mollis id euismod id, pretium sed augue. Integer tristique tincidunt sem sed faucibus. Praesent commodo pulvinar mollis. Nulla mollis convallis nulla vitae tincidunt. Phasellus in dictum urna.
	\x00	 
		Pellentesque tincidunt feugiat ipsum, non aliquet nisl scelerisque at. Integer aliquam vehicula bibendum. Ut vitae dui at eros volutpat hendrerit. In euismod nisl luctus elit tempor semper. Maecenas semper congue mi vitae tristique. In vitae lacinia ipsum. Maecenas elementum interdum enim, feugiat interdum odio volutpat sed. Ut in nisi turpis. Cras elit nibh, scelerisque vel auctor semper, malesuada id eros. Duis pellentesque hendrerit tortor a facilisis. Maecenas aliquam tempor diam eleifend rutrum. Donec sed orci sapien, eu fermentum tellus. Nullam cursus metus quis arcu feugiat auctor id sit amet dui. Etiam et lectus ut mi tristique bibendum ac et libero. Quisque tellus odio, congue non mollis id, iaculis id lorem.
	\x00		 
		Ut molestie, ante lacinia imperdiet tincidunt, ligula nibh feugiat lacus, ac tempor velit neque ut diam. Aliquam magna felis, suscipit et varius nec, tincidunt ac tellus. Nunc diam mi, tristique nec convallis id, congue eget eros. Aenean euismod eros vel tortor pellentesque semper. Morbi vitae turpis nunc, id rutrum purus. Aenean in lacus a dui malesuada pretium sed feugiat metus. Mauris vel turpis erat, ullamcorper hendrerit nunc. Sed rhoncus leo id purus egestas semper. Nulla sed quam dui. Cras in convallis tortor.
	\x00		 
		Morbi faucibus pretium pellentesque. Cras pretium auctor ligula ac venenatis. Pellentesque at justo orci, pharetra cursus turpis. Aliquam erat volutpat. Vestibulum orci felis, cursus eu ultricies viverra, iaculis eu enim. Mauris sagittis mauris posuere odio commodo non molestie sem sollicitudin. Nullam a fringilla sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum viverra, justo eu tincidunt aliquam, enim leo dictum libero, at tincidunt nisi est eu elit. Fusce quis urna tortor, vel vulputate libero. Proin venenatis sem eget est pretium lobortis. Maecenas luctus fermentum nibh, ac laoreet felis gravida ac.
	\x00		 
		Nunc lectus arcu, lacinia nec sollicitudin eu, pretium at leo. Mauris leo arcu, congue nec mollis at, venenatis eu neque. Quisque augue magna, laoreet vitae blandit non, suscipit vel metus. Mauris congue viverra mollis. Etiam eget augue vitae felis dapibus rhoncus at a quam. Nam placerat vehicula venenatis. Cras nec odio at metus euismod molestie. Cras nec orci nec leo ultrices pulvinar ac vitae arcu. Fusce blandit, quam a facilisis faucibus, risus sapien ultrices leo, id sagittis magna enim non urna. Vestibulum fringilla, lorem eu bibendum sollicitudin, risus magna porttitor lectus, in porttitor justo urna a nisl. Ut eget libero nec enim scelerisque cursus ac nec justo. Nunc tellus mauris, consequat non viverra quis, pharetra ut ipsum.
	\x00		 
		Fusce nec lectus turpis, sed sodales lorem. Integer tristique lacinia tellus, a dictum elit lobortis et. Ut dictum, lectus eu commodo lacinia, diam ante congue ligula, sit amet placerat lectus ligula hendrerit massa. In hac habitasse platea dictumst. Vestibulum turpis ante, rutrum at consectetur at, feugiat sed mauris. Pellentesque scelerisque ultrices libero ultrices lacinia. Pellentesque id enim id mi ultricies dictum id vitae ante. Nam pulvinar molestie purus vel rhoncus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam placerat lacus quis enim auctor malesuada. Etiam eget mauris ut augue vulputate imperdiet. Sed dapibus libero consectetur sem sodales mollis. Ut ornare eleifend lectus at gravida. Morbi mollis scelerisque feugiat. Cras commodo, purus ac eleifend posuere, est nunc laoreet quam, a elementum sapien eros sed quam. Vestibulum vitae erat eu purus auctor vulputate.
	\x00		 
		Mauris purus nisl, dapibus vel volutpat sit amet, lobortis non justo. Duis mollis consectetur sem ac lacinia. In hac habitasse platea dictumst. Maecenas ut purus turpis, eu volutpat sapien. Vestibulum dolor orci, congue sit amet pulvinar in, adipiscing at urna. Nunc condimentum tincidunt quam in pulvinar. Nam non tellus dui, eu tincidunt massa. Sed lacus lorem, consequat nec mattis a, posuere at augue. Nullam lacinia suscipit lorem ac faucibus. Duis sollicitudin porta nisi, at aliquam neque congue nec. Maecenas luctus, ligula quis sagittis placerat, sapien mauris sagittis quam, non faucibus ipsum mauris accumsan nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus tempus risus quam. Pellentesque mollis tellus quis justo egestas viverra. Vestibulum molestie tortor at ipsum consequat eu laoreet mi volutpat. Curabitur suscipit posuere libero, id adipiscing nisl imperdiet sed.
	\x00		 
		Fusce varius porta dictum. Duis lobortis mi vitae purus sagittis id rutrum nisi semper. Suspendisse varius luctus eros quis scelerisque. Curabitur dictum condimentum augue eget elementum. Pellentesque magna lorem, auctor vitae venenatis in, hendrerit non mi. Nunc sit amet justo in elit volutpat consectetur. Nulla aliquet pellentesque laoreet. Morbi ut nunc ante, sit amet fringilla leo. Nullam non est dolor, vitae rhoncus turpis.
	\x00		 
		Quisque et sapien magna, at cursus mauris. Nam quis massa nec lacus scelerisque malesuada vel ut nulla. Sed quis quam non justo pellentesque sagittis. Aliquam a arcu ac urna vehicula hendrerit. Morbi leo ligula, tincidunt semper tincidunt sit amet, condimentum non ante. Ut non arcu sit amet eros mollis accumsan. Vestibulum iaculis, purus eget sagittis molestie, odio nisi tincidunt ipsum, sed pulvinar tortor magna a odio. Quisque viverra viverra nibh sed sollicitudin. Maecenas gravida, augue ut elementum accumsan, metus tellus posuere libero, id scelerisque ante urna at odio. Nam faucibus libero eget arcu elementum iaculis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
	\x00		 
		Suspendisse risus neque, pulvinar id sagittis nec, viverra eget mi. Proin vel leo sed risus tempor porttitor eu eu velit. Praesent placerat arcu ac lorem varius vitae dapibus est varius. Vestibulum auctor diam quis dolor laoreet sit amet porta libero molestie. Maecenas quis sapien non mi venenatis molestie eget nec ipsum. Donec et nibh et leo aliquet rhoncus id nec sapien. Nullam vulputate urna et nisi egestas sagittis. Donec magna elit, molestie non placerat lobortis, ullamcorper elementum purus. Quisque venenatis, justo at dignissim sagittis, nibh purus tristique augue, ut gravida augue dolor quis nisl. Duis at enim a nunc porttitor commodo eget quis mauris. Fusce hendrerit eleifend lectus at blandit. Fusce pharetra mauris quis justo porta eget consequat tortor aliquam. Sed eu enim id est lobortis luctus. Praesent rhoncus pulvinar enim sed mattis. Nulla vitae dolor at orci porta imperdiet eu sagittis velit. Sed porttitor turpis quis turpis tempus fringilla.
 	";

 	$fulltext_array = explode("\x00", $fulltext);
 	$string = "";
 	
 	for ($i = 0; $i < $paragraphs; $i++) {  
 		$string .= $fulltext_array[$i];
 	}

	return $string;						
}
