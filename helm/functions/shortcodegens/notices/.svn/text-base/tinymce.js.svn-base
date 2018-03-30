function insertTypeShortcode() {
	
	var shortcodeText;
	var shortcodeId = document.getElementById('notices_shortcode').value;
	var sampletext = "Sample text";
	
	
	shortcodeText = '<br />[notice type="' + shortcodeId + '"]<br />' + sampletext + '<br />[/notice]<br />';	
		
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
