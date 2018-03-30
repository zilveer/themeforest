function embedshortcode() {
	
	var shortcodetext;
	var style = document.getElementById('shortcode_panel');
	

	if (style.className.indexOf('current') != -1) {
		var selected_shortcode = document.getElementById('style_shortcode').value;
		
		
		
// -----------------------------
// 	LAYOUT SHORTCODES
// -----------------------------		
if (selected_shortcode == 'two_columns'){
	shortcodetext = "[one_half]<br />Your content here...<br />[/one_half]<br /><br />[one_half_last]<br />Your content here...<br />[/one_half_last]<br />";	
}

if (selected_shortcode == 'three_columns'){
	shortcodetext = "[one_third]<br />Your content here...<br />[/one_third]<br /><br />[one_third]<br />Your content here...<br />[/one_third]<br /><br />[one_third_last]<br />Your content here...<br />[/one_third_last]<br />";	
}

if (selected_shortcode == 'four_columns'){
	shortcodetext = "[one_fourth]<br />Your content here...<br />[/one_fourth]<br /><br />[one_fourth]<br />Your content here...<br />[/one_fourth]<br /><br />[one_fourth]<br />Your content here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />Your content here...<br />[/one_fourth_last]<br />";	
}

if (selected_shortcode == 'five_columns'){
	shortcodetext = "[one_fifth]<br />Your content here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Your content here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Your content here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Your content here...<br />[/one_fifth]<br /><br />[one_fifth_last]<br />Your content here...<br />[/one_fifth_last]<br />";	
}

if (selected_shortcode == 'six_columns'){
	shortcodetext = "[one_sixth]<br />Your content here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Your content here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Your content here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Your content here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Your content here...<br />[/one_sixth]<br /><br />[one_sixth_last]<br />Your content here...<br />[/one_sixth_last]<br />";	
}

if (selected_shortcode == 'one_fourth_three_fourth_columns'){
	shortcodetext = "[one_fourth]<br />Your content here...<br />[/one_fourth]<br /><br />[three_fourth_last]<br />Your content here...<br />[/three_fourth_last]<br />";	
}

if (selected_shortcode == 'three_fourth_one_fourth_columns'){
	shortcodetext = "[three_fourth]<br />Your content here...<br />[/three_fourth]<br /><br />[one_fourth_last]<br />Your content here...<br />[/one_fourth_last]<br />";	
}

if (selected_shortcode == 'two_thirds_one_third_columns'){
	shortcodetext = "[two_thirds]<br />Your content here...<br />[/two_thirds]<br /><br />[one_third_last]<br />Your content here...<br />[/one_third_last]<br />";	
}

if (selected_shortcode == 'one_third_two_thirds_columns'){
	shortcodetext = "[one_third]<br />Your content here...<br />[/one_third]<br /><br />[two_third_last]<br />Your content here...<br />[/two_third_last]<br />";	
}


// -----------------------------
// 	BUTTON SHORTCODES
// -----------------------------
if (selected_shortcode == 'black_button'){
	shortcodetext = "[button size=\"small,medium,large\" color=\"black\" link=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'gray_button'){
	shortcodetext = "[button size=\"small,medium,large\" color=\"gray\" link=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'red_button'){
	shortcodetext = "[button size=\"small,medium,large\" color=\"red\" link=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'orange_button'){
	shortcodetext = "[button size=\"small,medium,large\" color=\"orange\" link=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'magneta_button'){
	shortcodetext = "[button size=\"small,medium,large\" color=\"magneta\" link=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'yellow_button'){
	shortcodetext = "[button size=\"small,medium,large\" color=\"yellow\" link=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'blue_button'){
	shortcodetext = "[button size=\"small,medium,large\" color=\"blue\" link=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'pink_button'){
	shortcodetext = "[button size=\"small,medium,large\" color=\"pink\" link=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'green_button'){
	shortcodetext = "[button size=\"small,medium,large\" color=\"green\" link=\"http://www.\" ]Button Text[/button]";	
}
if (selected_shortcode == 'rosy_button'){
	shortcodetext = "[button size=\"small,medium,large\" color=\"rosy\" link=\"http://www.\" ]Button Text[/button]";	
}


// -----------------------------
// 	Dividers
// -----------------------------

if (selected_shortcode == 'basic_divider'){
	shortcodetext = "[divider]";	
}
if (selected_shortcode == 'top_divider'){
	shortcodetext = "[divider_top]";	
}



// -----------------------------
// 	HEADINGS
// -----------------------------

if (selected_shortcode == 'heading_h2'){
	shortcodetext = "[h2]Heading 2[/h2]";	
}
if (selected_shortcode == 'heading_h3'){
	shortcodetext = "[h3]Heading 3[/h3]";	
}
if (selected_shortcode == 'heading_h4'){
	shortcodetext = "[h4]Heading 4[/h4]";	
}
if (selected_shortcode == 'heading_h5'){
	shortcodetext = "[h5]Heading 5[/h5]";	
}
if (selected_shortcode == 'heading_h6'){
	shortcodetext = "[h6]Heading 6[/h6]";	
}


// -----------------------------
// 	TYPOGRAPHY SHORTCODES
// -----------------------------

if (selected_shortcode == 'dropcap1'){
	shortcodetext = "[dropcap1]L[/dropcap1]orum sit amet leo urna, a varius tellus.";	
}
if (selected_shortcode == 'dropcap2'){
	shortcodetext = "[dropcap2]L[/dropcap2]orum sit amet leo urna, a varius tellus.";	
}
if (selected_shortcode == 'pullquote_left'){
	shortcodetext = "[pullquote_left]Lorum sit amet leo urna, a varius tellus. Curabitur  non magna nunc, sed  pretium elit.[/pullquote_left]";	
}
if (selected_shortcode == 'pullquote_right'){
	shortcodetext = "[pullquote_right]Lorum sit amet leo urna, a varius tellus. Curabitur  non magna nunc, sed  pretium elit.[/pullquote_right]";	
}
if (selected_shortcode == 'highlight'){
	shortcodetext = "Etiam convallis, sem molestie  bibendum dictum, ipsum diam  scelerisque   arcu, ac [highlight]adipiscing elit tellus[/highlight]  quis arcu.";	
}
if (selected_shortcode == 'callout'){
	shortcodetext = "[callout]Hey there, this is a callout![/callout]";	
}
if (selected_shortcode == 'callout_button'){
	shortcodetext = "[callout button=\"true\" button_size=\"medium\" button_color=\"black\" button_align=\"right\" button_text=\"Find Out More\" button_link=\"http://swishthemes.com\"]Horizon is a clean, modern stylish WordPress theme stuffed with fantastic features. [/callout]";	
}
	 
	 
// -----------------------------
// 	NOTIFICATION SHORTCODES
// -----------------------------

if (selected_shortcode == 'notif_success'){
	shortcodetext = "[notification_success]Etiam convallis, sem molestie  bibendum dictum, ipsum diam  scelerisque   arcu, ac adipiscing elit tellus  quis arcu.[/notification_success]";	
}
if (selected_shortcode == 'notif_error'){
	shortcodetext = "[notification_error]Etiam convallis, sem molestie  bibendum dictum, ipsum diam  scelerisque   arcu, ac adipiscing elit tellus  quis arcu.[/notification_error]";	
}
if (selected_shortcode == 'notif_warning'){
	shortcodetext = "[notification_warning]Etiam convallis, sem molestie  bibendum dictum, ipsum diam  scelerisque   arcu, ac adipiscing elit tellus  quis arcu.[/notification_warning]";	
}
if (selected_shortcode == 'notif_info'){
	shortcodetext = "[notification_info]Etiam convallis, sem molestie  bibendum dictum, ipsum diam  scelerisque   arcu, ac adipiscing elit tellus  quis arcu.[/notification_info]";	
}
if (selected_shortcode == 'notif_tip'){
	shortcodetext = "[notification_tip]Etiam convallis, sem molestie  bibendum dictum, ipsum diam  scelerisque   arcu, ac adipiscing elit tellus  quis arcu.[/notification_tip]";	
}


// -----------------------------
// 	LISTING SHORTCODES
// -----------------------------

if (selected_shortcode == 'list_bullet'){
	shortcodetext = "[bulletlist]<ul><li>Item One</li><li>Item Two</li><li>Item Three</li></ul>[/bulletlist]";	
}
if (selected_shortcode == 'list_circle'){
	shortcodetext = "[circlelist]<ul><li>Item One</li><li>Item Two</li><li>Item Three</li></ul>[/circlelist]";	
}
if (selected_shortcode == 'list_arrow'){
	shortcodetext = "[arrowlist]<ul><li>Item One</li><li>Item Two</li><li>Item Three</li></ul>[/arrowlist]";	
}
if (selected_shortcode == 'list_cross'){
	shortcodetext = "[crosslist]<ul><li>Item One</li><li>Item Two</li><li>Item Three</li></ul>[/crosslist]";	
}
if (selected_shortcode == 'list_star'){
	shortcodetext = "[starlist]<ul><li>Item One</li><li>Item Two</li><li>Item Three</li></ul>[/starlist]";	
}


// -----------------------------
// 	MISC SHORTCODES
// -----------------------------
if (selected_shortcode == 'toggle'){
	shortcodetext = "[toggle title=\"Step One\"]Morbi ac ante quam, a lobortis  arcu. Vestibulum elementum elit sit amet  quam varius adipiscing.[/toggle][toggle title=\"Step Two\"]Morbi ac ante quam, a lobortis  arcu. Vestibulum elementum elit sit amet  quam varius adipiscing.[/toggle][toggle title=\"Step Three\"]Morbi ac ante quam, a lobortis  arcu. Vestibulum elementum elit sit amet  quam varius adipiscing.[/toggle]";	
}
if (selected_shortcode == 'twitter_feed'){
	shortcodetext = "[twitter_feed id=\"envato\" count=\"2\"]";	
}
if (selected_shortcode == 'testimonial'){
	shortcodetext = "[testimonial author=\"Colis\" image=\"http://a2.twimg.com/profile_images/1091916646/Facebook_normal.jpg\" location=\"Envato HQ\"] I've only got one word to say about this theme. AWESOME![/testimonial]";	
}
if (selected_shortcode == 'styled_table'){
	shortcodetext = "[styled_table]<table><thead><tr><th scope=\"col\">Header 1</th><th scope=\"col\">Header 2</th><th scope=\"col\">Header 3</th><th scope=\"col\">Header 4</th><th scope=\"col\">Header 5</th></tr></thead><tfoot><tr><td colspan=\"5\">The foot text for this table</td></tr></tfoot><tbody><tr><td>Cell 1</td><td>Cell 2</td><td>Cell 3</td><td>Cell 4</td><td>Cell 5</td></tr></tbody></table>[/styled_table]";	
}

		
		

	if ( selected_shortcode == 0 ){tinyMCEPopup.close();}}
	if(window.tinyMCE) {
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodetext);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}return;
}