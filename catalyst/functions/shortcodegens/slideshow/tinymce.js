function insertTypeShortcode() {
	
	var shortcodeText;
	var slide_width = document.getElementById('slideshow_width').value;
	var slide_height = document.getElementById('slideshow_height').value;
	var slide_type = document.getElementById('slideshow_type').value;
	var sampletext = "Sample text";
	
	switch (slide_type) {
		case 'galleria':
			shortcodeText = '<br />[galleria width="' + slide_width + '" height="' + slide_height + '"]<br />';
			break
		case 'nivo':
			shortcodeText = '<br />[nivoslides width="' + slide_width + '" height="' + slide_height + '"]<br />';
			break
	}
		
	if ( slide_width == 0 ){
			tinyMCEPopup.close();
		}	
	
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		//window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
