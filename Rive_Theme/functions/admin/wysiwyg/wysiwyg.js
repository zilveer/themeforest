function embedshortcode() {
	
	var shortcodetext;
	var style = document.getElementById('shortcode_panel');
	

	if (style.className.indexOf('current') != -1) {
		var selected_shortcode = document.getElementById('style_shortcode').value;
	
		/* Column Layouts */		
		if (selected_shortcode == 'two_columns') {
			shortcodetext = "[one_half]<br />Content goes here...<br />[/one_half]<br /><br />[one_half_last]<br />Content goes here...<br />[/one_half_last]<br />";
		}

		if (selected_shortcode == 'three_columns') {
			shortcodetext = "[one_third]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />Content goes here...<br />[/one_third_last]<br />";
		}

		if (selected_shortcode == 'four_columns') {
			shortcodetext = "[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />Content goes here...<br />[/one_fourth_last]<br />";
		}

		if (selected_shortcode == 'five_columns') {
			shortcodetext = "[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth_last]<br />Content goes here...<br />[/one_fifth_last]<br />";
		}

		if (selected_shortcode == 'six_columns') {
			shortcodetext = "[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth_last]<br />Content goes here...<br />[/one_sixth_last]<br />";
		}

		if (selected_shortcode == 'one_fourth_three_fourth_columns') {
			shortcodetext = "[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[three_fourths_last]<br />Content goes here...<br />[/three_fourths_last]<br />";
		}

		if (selected_shortcode == 'three_fourth_one_fourth_columns') {
			shortcodetext = "[three_fourths]<br />Content goes here...<br />[/three_fourths]<br /><br />[one_fourth_last]<br />Content goes here...<br />[/one_fourth_last]<br />";
		}

		if (selected_shortcode == 'two_thirds_one_third_columns') {
			shortcodetext = "[two_thirds]<br />Content goes here...<br />[/two_thirds]<br /><br />[one_third_last]<br />Content goes here...<br />[/one_third_last]<br />";
		}

		if (selected_shortcode == 'one_third_two_thirds_columns') {
			shortcodetext = "[one_third]<br />Content goes here...<br />[/one_third]<br /><br />[two_thirds_last]<br />Content goes here...<br />[/two_thirds_last]<br />";
		}


		/* Layout Elements */
		if (selected_shortcode == 'accordion') {
			shortcodetext = "[accordions one_opened_item=\"true\"]<br />[accordion title=\"title 1\"]accordion content 1[/accordion]<br />[accordion title=\"title 2\"]accordion content 2[/accordion]<br />[accordion title=\"title 3\"]accordion content 3[/accordion]<br />[/accordions]<br />";
		}

		if (selected_shortcode == 'toggle') {
			shortcodetext = "[toggle title=\"title 1\" hidden=\"false\"]accordion content 1[/toggle]<br />[toggle title=\"title 2\" hidden=\"true\"]toggle content 2[/toggle]<br />[toggle title=\"title 3\" hidden=\"true\"]toggle content 3[/toggle]<br />";
		}

		if (selected_shortcode == 'tabs') {
			shortcodetext = "[tabs bgcolor=\"azure\"]<br />[tab title=\"title 1\"]tab 1 content[/tab]<br /><br />[tab]tab 2 content[/tab]<br />[/tabs]<br />";
		}

		if (selected_shortcode == 'table') {
			shortcodetext = "[custom_table]<table border=\"\"><thead><tr><th>Column 1</th><th>Column 2</th><th>Column 3</th><th>Column 4</th></tr></thead><tbody><tr><td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vitae libero nulla, sed sagittis tortor. Praesent tempus sollicitudin tellus. Donec leo ipsum, consequat a scelerisque vitae, interdum in elit.</td><td>Nunc cursus iaculis lorem, non hendrerit eros ultrices sed. Donec vitae euismod arcu. Duis at enim et elit porta adipiscing. Ut id turpis orci, laoreet elementum dolor.</td><td>Nunc nec lobortis leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</td><td>Fusce turpis neque, fringilla id porta vel, <strong>tempus sit amet purus.</strong> Cras aliquet augue ut nunc laoreet semper.</td></tr><tr><td>Mauris aliquet pellentesque quam fringilla dignissim.</td><td>Donec et elit id nunc fringilla consectetur ut et dui.</td><td>Nam congue, leo sit amet ultrices accumsan, sapien dui viverra augue, ac egestas turpis ante a libero</td><td>Nullam vitae diam dolor, at bibendum erat. Nullam consequat auctor varius. Sed at libero vitae ipsum pretium vestibulum.</td></tr></tbody><tfoot><tr><td colspan=\"4\">Table footer</td></tr></tfoot></table>[/custom_table]<br />";	
		}

		if (selected_shortcode == 'youtube_video') {
			shortcodetext = "[video type=\"youtube\" clip_id=\"Your video id goes here...\"]Some text under video[/video]<br />";
		}

		if (selected_shortcode == 'dailymotion_video') {
			shortcodetext = "[video type=\"dailymotion\" clip_id=\"Your video id goes here...\"]Some text under video[/video]<br />";
		}

		if (selected_shortcode == 'vimeo_video') {
			shortcodetext = "[video type=\"vimeo\" clip_id=\"Your video id goes here...\"]Some text under video[/video]<br />";
		}

		if (selected_shortcode == 'html5_video') {
			shortcodetext = "[video type=\"html5\" src=\"Your video URL goes here...\"]Some text under video[/video]<br />";
		}
		

		/* Staff members */
		if (selected_shortcode == 'staff') {
			shortcodetext = "[staff count=\"5\" paged=\"\" post_id=\"\" parent=\"\" paging=\"true\"]<br />";
		}
		

		/* Causes */
		if (selected_shortcode == 'cause') {
			shortcodetext = "[cause count=\"5\" paged=\"\" post_id=\"\" parent=\"\" paging=\"true\"]<br />";
		}


		/* Latest Blog Posts */
		if (selected_shortcode == 'blog_posts') {
			shortcodetext = "[blog count=\"5\" category=\"\" show_image=\"true\" layout=\"with_full_image\" paging=\"true\"]<br />";
		}

		if (selected_shortcode == 'blog_posts_without') {
			shortcodetext = "[blog count=\"5\" category=\"\" show_image=\"false\" paging=\"true\"]<br />";
		}

		/* Text Styling */
		if (selected_shortcode == 'dropcaps') {
			shortcodetext = "[dropcap color=\"#97c95d\"]A[/dropcap]Content goes here...<br />";
		}

		if (selected_shortcode == 'highlight') {
			shortcodetext = "Sociis natoque, nascetur ridiculus mus. [label]This is a label[/label].<br />";	
		}

		if (selected_shortcode == 'badge') {
			shortcodetext = "Sociis natoque, nascetur ridiculus mus. [badge]This is a label[/badge].<br />";	
		}

		if (selected_shortcode == 'text_h1') {
			shortcodetext = "[h1]Content goes here...[/h1]<br />";
		}

		if (selected_shortcode == 'text_h2') {
			shortcodetext = "[h2]Content goes here...[/h2]<br />";
		}

		if (selected_shortcode == 'text_h3') {
			shortcodetext = "[h3]Content goes here...[/h3]<br />";
		}

		if (selected_shortcode == 'text_h4') {
			shortcodetext = "[h4]Content goes here...[/h4]<br />";
		}

		if (selected_shortcode == 'text_h5') {
			shortcodetext = "[h5]Content goes here...[/h5]<br />";
		}

		if (selected_shortcode == 'text_h6') {
			shortcodetext = "[h6]Content goes here...[/h6]<br />";
		}

		/* Lists */
		if (selected_shortcode == 'add_document') {
			shortcodetext = "[list type=\"add-document\"]<ul><li>Item 1...</li><li>Item 2...</li><li>Item 3...</li></ul>[/list]<br />";
		}

		if (selected_shortcode == 'alert_list') {
			shortcodetext = "[list type=\"alert\"]<ul><li>Item 1...</li><li>Item 2...</li><li>Item 3...</li></ul>[/list]<br />";
		}

		if (selected_shortcode == 'check_list') {
			shortcodetext = "[list type=\"check\"]<ul><li>Item 1...</li><li>Item 2...</li><li>Item 3...</li></ul>[/list]<br />";
		}

		if (selected_shortcode == 'info_list') {
			shortcodetext = "[list type=\"info\"]<ul><li>Item 1...</li><li>Item 2...</li><li>Item 3...</li></ul>[/list]<br />";
		}
			
		/* Message boxes */
		if (selected_shortcode == 'quote_box') {
			shortcodetext = "[quote author=\"John Doe\" position=\"CEO of Company\"]Content goes here...[/quote]<br />";	
		}

		if (selected_shortcode == 'info_box') {
			shortcodetext = "[alert-info]Content goes here...[/alert-info]<br />";	
		}

		if (selected_shortcode == 'success_box') {
			shortcodetext = "[alert-success]Content goes here...[/alert-success]<br />";
		}

		if (selected_shortcode == 'warning_box') {
			shortcodetext = "[alert-message]Content goes here...[/alert-message]<br />";
		}

		if (selected_shortcode == 'error_box') {
			shortcodetext = "[alert-error]Content goes here...[/alert-error]<br />";
		}

		if (selected_shortcode == 'custom_box') {
			shortcodetext = "[custom_message width=\"20%\" height=\"30px\" color=\"#575757\" align=\"left\" bgcolor=\"#F4F4F4\" border=\"#E3E3E3\"]Content goes here... Content goes here...[/custom_message]<br />";
		}

		/* Buttons */
		if (selected_shortcode == 'default_button') {
			shortcodetext = "[button href=\"http://\" ]Content goes here...[/button]<br />";	
		}

		if (selected_shortcode == 'btn-primary') {
			shortcodetext = "[button href=\"http://\" target=\"_self\" size=\"btn-small\" class=\"btn-primary\" type=\"button\"]Content goes here...[/button]<br />";
		}

		if (selected_shortcode == 'btn-info') {
			shortcodetext = "[button href=\"http://\" target=\"_self\" size=\"btn-small\" class=\"btn-info\" type=\"button\"]Content goes here...[/button]<br />";
		}

		if (selected_shortcode == 'btn-success') {
			shortcodetext = "[button href=\"http://\" target=\"_self\" size=\"btn-small\" class=\"btn-success\" type=\"button\"]Content goes here...[/button]<br />";
		}

		if (selected_shortcode == 'btn-warning') {
			shortcodetext = "[button href=\"http://\" target=\"_self\" size=\"btn-small\" class=\"btn-warning\" type=\"button\"]Content goes here...[/button]<br />";
		}

		if (selected_shortcode == 'btn-danger') {
			shortcodetext = "[button href=\"http://\" target=\"_self\" size=\"btn-small\" class=\"btn-danger\" type=\"button\"]Content goes here...[/button]<br />";
		}

		if (selected_shortcode == 'btn-inverse') {
			shortcodetext = "[button href=\"http://\" target=\"_self\" size=\"btn-small\" class=\"btn-inverse\" type=\"button\"]Content goes here...[/button]<br />";
		}

		if (selected_shortcode == 'custom_button') {
			shortcodetext = "[button href=\"http://\" id=\"\" class=\"\" target=\"_self\" size=\"btn-small\" color=\"#ffffff\" type=\"button\"]Content goes here...[/button]<br />";
		}

		/* Dividers */
		if (selected_shortcode == 'basic_divider') {
			shortcodetext = "[divider type=\"type_1\"]<br />";	
		}

		if (selected_shortcode == 'shadow_divider') {
			shortcodetext = "[divider type=\"type_2\"]<br />";	
		}

		/* Gallery */
		if (selected_shortcode == 'small_gallery') {
			shortcodetext = "[gallery size=\"gallery-small\" link=\"file\" order=\"DESC\" columns=\"8\"]<br />";
		}

		if (selected_shortcode == 'medium_gallery') {
			shortcodetext = "[gallery size=\"gallery-medium\" link=\"file\" order=\"DESC\" columns=\"6\"]<br />";
		}

		if (selected_shortcode == 'large_gallery') {
			shortcodetext = "[gallery size=\"gallery-large\" link=\"file\" order=\"DESC\" columns=\"3\"]<br />";
		}

		if (selected_shortcode == 'standard_gallery') {
			shortcodetext = "[gallery size=\"gallery-medium\" type=\"standard-gallery\" include=\"\" exclude=\"\" link=\"file\" order=\"DESC\" orderby=\"menu_order ID\" columns=\"6\"]<br />";	
		}

		if ( selected_shortcode == 0 ) {
			if (tinymce.majorVersion ==  '4') {
				tinyMCE.activeEditor.windowManager.close();
			} else {
				tinyMCEPopup.close();
			}
 		}
	}
	if(window.tinyMCE) {
		if (tinymce.majorVersion ==  '4') {
			tinyMCE.activeEditor.insertContent(shortcodetext);
			tinyMCE.activeEditor.windowManager.close();
		} else {
			window.tinyMCE.execCommand('mceInsertContent',false,shortcodetext);
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
	}
	return;
}