function insertTypeShortcode() {
	
	var shortcodeText;
	var shortcodeId = document.getElementById('buttons_shortcode').value;
	var shortcodeText = document.getElementById('buttons_text').value;
	var shortcodeLink = document.getElementById('buttons_link').value;
	var shortcodeAlign = document.getElementById('buttons_align').value;
	var shortcodeSize = document.getElementById('buttons_size').value;
	var shortcodeTarget = document.getElementById('buttons_target').value;
	var sampletext = "Sample text";
	
	
	shortcodeText = '<br />[button size="' + shortcodeSize + '" type="' + shortcodeId + '" link="' + shortcodeLink + '" target="' + shortcodeTarget + '" align="' + shortcodeAlign + '"]' + shortcodeText + '[/button]<br />';
		
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
