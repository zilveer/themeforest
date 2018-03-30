function insertTypeShortcode() {
	
	var shortcodeText;
	var thumbnail_type = document.getElementById('thumbnail_type').value;
	var thumbnail_page = document.getElementById('thumbnail_page').value;
	
	
	shortcodeText = '<br />[thumbnails pageid="'+ thumbnail_page +'" type="' + thumbnail_type + '"]<br />';	
		
	if ( thumbnail_type == 0 ){
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
