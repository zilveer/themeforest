function embedshortcode() {
	
	var shortcodetext;
	var style = document.getElementById('shortcode_panel');
	

	if (style.className.indexOf('current') != -1) {
		var selected_shortcode = document.getElementById('style_shortcode').value;
		
		
		
// -----------------------------
// 	LAYOUT SHORTCODES
// -----------------------------		
if (selected_shortcode == 'two_columns'){
	shortcodetext = "[row][col_half]Your content here...[/col_half][col_half]Your content here...[/col_half][/row]";
}

if (selected_shortcode == 'three_columns'){
	shortcodetext = "[row][col_third]Your content here...[/col_third][col_third]Your content here...[/col_third][col_third]Your content here...[/col_third][/row]";	
}

if (selected_shortcode == 'four_columns'){
	shortcodetext = "[row][col_fourth]Your content here...[/col_fourth][col_fourth]Your content here...[/col_fourth][col_fourth]Your content here...[/col_fourth][col_fourth]Your content here...[/col_fourth][/row]";
}




// -----------------------------
// 	BUTTON SHORTCODES
// -----------------------------
if (selected_shortcode == 'btn_grey'){
	shortcodetext = "[button size=\"large,small,mini\" url=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'btn_black'){
	shortcodetext = "[button size=\"large,small,mini\" color=\"black\" url=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'btn_blue'){
	shortcodetext = "[button size=\"large,small,mini\" color=\"blue\" url=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'btn_green'){
	shortcodetext = "[button size=\"slarge,small,mini\" color=\"green\" url=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'btn_red'){
	shortcodetext = "[button size=\"large,small,mini\" color=\"red\" url=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'btn_purple'){
	shortcodetext = "[button size=\"large,small,mini\" color=\"purple\" url=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'btn_teal'){
	shortcodetext = "[button size=\"large,small,mini\" color=\"teal\" url=\"http://www.\" ]Button Text[/button]";	
}

// -----------------------------
// 	NOTIFICATION SHORTCODES
// -----------------------------

if (selected_shortcode == 'alert'){
	shortcodetext = "[alert]Etiam convallis, sem molestie  bibendum dictum, ipsum diam  scelerisque   arcu, ac adipiscing elit tellus  quis arcu.[/alert]";	
}
if (selected_shortcode == 'alert_success'){
	shortcodetext = "[alert style=\"success\"]Etiam convallis, sem molestie  bibendum dictum, ipsum diam  scelerisque   arcu, ac adipiscing elit tellus  quis arcu.[/alert]";	
}
if (selected_shortcode == 'alert_danger'){
	shortcodetext = "[alert style=\"danger\"]Etiam convallis, sem molestie  bibendum dictum, ipsum diam  scelerisque   arcu, ac adipiscing elit tellus  quis arcu.[/alert]";	
}
if (selected_shortcode == 'alert_info'){
	shortcodetext = "[alert style=\"info\"]Etiam convallis, sem molestie  bibendum dictum, ipsum diam  scelerisque   arcu, ac adipiscing elit tellus  quis arcu.[/alert]";	
}

// -----------------------------
// 	MISC SHORTCODES
// -----------------------------
if (selected_shortcode == 'toggle'){
	shortcodetext = "[toggle title=\"Hey click me\"]This should appear magically[/toggle]";	
}
if (selected_shortcode == 'tab'){
	shortcodetext = "[tabs][tab title=\"Tab One\"]Here is tab one content.[/tab][tab title=\"Tab Two\"]and here is tab two. Pretty neat![/tab][/tabs]";	
}
if (selected_shortcode == 'tab_left'){
	shortcodetext = "[tabs style=\"tabs-left\"][tab title=\"Tab One\"]<h3>Heading One</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>[/tab][tab title=\"Tab Two\"]<h3>Heading Two</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>[/tab][/tabs]";	
}
if (selected_shortcode == 'tab_right'){
	shortcodetext = "[tabs style=\"tabs-right\"][tab title=\"Tab One\"]<h3>Heading One</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>[/tab][tab title=\"Tab Two\"]<h3>Heading Two</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>[/tab][/tabs]";	
}
if (selected_shortcode == 'accordion'){
	shortcodetext = "[accordion][accordion_block title=\"Accordion 1\"]Accordion 1 Content[/accordion_block][accordion_block title=\"Accordion 2\"]Accordion 2 Content[/accordion_block][accordion_block title=\"Accordion 3\"]Accordion 3 Content[/accordion_block][/accordion]";	
}
		
		

	if ( selected_shortcode == 0 ){tinyMCEPopup.close();}}
	if(window.tinyMCE) {
		//version check for correct command
		if(tinyMCE.majorVersion>3){
		window.tinyMCE.activeEditor.insertContent(shortcodetext);
		} else {
		window.tinyMCE.execCommand('content', 'mceInsertContent', false, shortcodetext);
		}
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}return;
}

