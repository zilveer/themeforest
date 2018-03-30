/**
 * @KingSize 2011
 * For the configuration load into the Tinymce@ShortCodes V 1.0
 **/
function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

/// All shortcodes definition here to insert into the content editor
function insertkingsizeLink() {
	
	var tagtext;

	var style = document.getElementById('shortcode_panel');
	
		var styleid = document.getElementById('put_shortcode_select').value;
		
		if (styleid != 0) {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";
		}	

		if (styleid != 0 && styleid == 'one_third') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'one_third_last') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'two_thirds') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'two_thirds_last') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'img_floated_left') {
			tagtext = "["+ styleid + " src=\"#\" alt=\"\" ]";	
		}

		if (styleid != 0 && styleid == 'img_floated_right') {
			tagtext = "["+ styleid + " src=\"#\" alt=\"\" ]";	
		}

		if (styleid != 0 && styleid == 'button') {
			tagtext = "["+ styleid + " to=\"#\" color=\"\" target=\"\" ]Button Text[/" + styleid + "]";	
		}

		if (styleid != 0 && styleid == 'info_box') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'warning_box') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'error_box') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'download_box') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'blockquote') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'tooltip_link') {
			tagtext = "["+ styleid + " title=\"\" to=\"#\"]Insert your text here[/" + styleid + "] ";	
		}

		/* OWM V4 development*/
		if (styleid != 0 && styleid == 'accordion') {
			tagtext = "["+ styleid + " title=\"\" ]Insert your text here[/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'accordion_active') {
			tagtext = "["+ styleid + " title=\"\" ]Insert your text here[/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'toggle_basic') {
			tagtext = "["+ styleid + " title=\"\" ]Insert your text here[/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'toggle') {
			tagtext = "["+ styleid + " title=\"\" ]Insert your text here[/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'contact') {
			tagtext = "["+ styleid + " email=\"\" message=\"\" ][/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'tabs') {
			tagtext = "["+ styleid + "] [tab title=\"Title 1\"]Insert your text here[/tab] [tab title=\"Title 2\"]Insert your text here[/tab] [tab title=\"Title 3\"]Insert your text here[/tab] [/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'tabs_basic') {
			tagtext = "[tabs type=\"basic\"] [tab title=\"Title 1\"]Insert your text here[/tab] [tab title=\"Title 2\"]Insert your text here[/tab] [tab title=\"Title 3\"]Insert your text here[/tab] [/tabs] ";	
		}
		
		if (styleid != 0 && styleid == 'table') {
			tagtext = "["+ styleid + " type=\"\" ] Insert your table source here. [/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'googlemap') {
			tagtext = "["+ styleid + " width=\"\" height=\"\" src=\"\" ][/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'video') {
			tagtext = "["+ styleid + " name=\"\" url=\"\" width=\"100%\" height=\"415\" ][/" + styleid + "] ";	
		}
		
		//if (styleid != 0 && styleid == 'related_posts') {
			//tagtext = "["+ styleid + " limit=\"\" ][/" + styleid + "] ";	
		//}
		
		if (styleid != 0 && styleid == 'dropcap') {
			tagtext = "["+ styleid + "][/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'one_half_dropcaps') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'one_half_alt_last_dropcaps') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'my_highlight') {
			tagtext = "["+ styleid + " color=\"\" font=\"\" ][/" + styleid + "] ";		
		}

		
		if (styleid != 0 && styleid == 'img_gallery') {
			tagtext = "["+ styleid + " id=\"\" type=\"\" layout=\"\" orderby=\"\" order=\"\" description=\"\" ] ";	
		}

		if (styleid != 0 && styleid == 'blog') {
			tagtext = "["+ styleid + " cats=\"\" featured_images=\"true\" per_page=\"5\" orderby=\"date\" order=\"desc\" title=\"true\" meta_data=\"true\" pagination=\"true\" content_display=\"excerpt\" ] ";	
		}

		if (styleid != 0 && styleid == 'portfolio') {
			tagtext = "["+ styleid + " cats=\"\"  per_page=\"10\" orderby=\"date\" order=\"desc\" title=\"true\" description=\"true\" filter=\"false\" layout=\"2columns\" pagination=\"true\" ] ";	
		}

		if ( styleid == 0) {
			tinyMCEPopup.close();
		}
	
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		//window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		
		/* get the TinyMCE version to account for API diffs */
		var tmce_ver=window.tinyMCE.majorVersion;

		if (tmce_ver>="4") {
			window.tinyMCE.execCommand('mceInsertContent', false, tagtext);
		} else {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		}

		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
