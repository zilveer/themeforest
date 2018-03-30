function insertTypeShortcode() {
	
	var shortcodeText;
	var shortcodeId = document.getElementById('typography_shortcode').value;
	var sampletext = "Sample text";
	
	
	if (shortcodeId != 0 && shortcodeId == 'dropcap1' ){
		shortcodeText = "<br />[" + shortcodeId +"]S[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'dropcap2' ){
		shortcodeText = "<br />[" + shortcodeId +"]S[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'pullquote_left' ){
		shortcodeText = "<br />[pullquote align=left]<br />" + sampletext + "<br />[/pullquote]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'pullquote_right' ){
		shortcodeText = "<br />[pullquote align=right]<br />" + sampletext + "<br />[/pullquote]<br />";
		}
	
	if (shortcodeId != 0 && shortcodeId == 'pullquote_center' ){
		shortcodeText = "<br />[pullquote align=center]<br />" + sampletext + "<br />[/pullquote]<br />";
		}
		
	if (shortcodeId != 0 && shortcodeId == 'pre' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />" + sampletext + "<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'code' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />" + sampletext + "<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'check_list' ){
		shortcodeText = "<br />[list type=check]<br /><ul><li>Item 1</li><li>Item 2</li><li>Item 3 ( add more items below )</li></ul>[/list]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'star_list' ){
		shortcodeText = "<br />[list type=star]<br /><ul><li>Item 1</li><li>Item 2</li><li>Item 3 ( add more items below )</li></ul>[/list]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'play_list' ){
		shortcodeText = "<br />[list type=play]<br /><ul><li>Item 1</li><li>Item 2</li><li>Item 3 ( add more items below )</li></ul>[/list]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'note_list' ){
		shortcodeText = "<br />[list type=note]<br /><ul><li>Item 1</li><li>Item 2</li><li>Item 3 ( add more items below )</li></ul>[/list]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'bullet_list' ){
		shortcodeText = "<br />[list type=bullet]<br /><ul><li>Item 1</li><li>Item 2</li><li>Item 3 ( add more items below )</li></ul>[/list]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'link_list' ){
		shortcodeText = "<br />[list type=link]<br /><ul><li>Item 1</li><li>Item 2</li><li>Item 3 ( add more items below )</li></ul>[/list]<br />";	
		}
		
		
	if (shortcodeId != 0 && shortcodeId == 'highlight' ){
		shortcodeText = "[" + shortcodeId + "]" + sampletext + "[/" + shortcodeId +"]";	
		}		
		
	if ( shortcodeId == 0 ){
			tinyMCEPopup.close();
		}	
	
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
