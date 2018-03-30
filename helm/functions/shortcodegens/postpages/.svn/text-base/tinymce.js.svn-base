function insertTypeShortcode() {
	
	var shortcodeText;
	var shortcodeId = document.getElementById('postpages_shortcode').value;
	var sampletext = "Sample text";
	
	switch (shortcodeId) {
		case 'posts':
		shortcodeText = '<br />[posts num="10"]<br />';
		break;
		case 'pages':
		shortcodeText = '<br />[pages childof="parent-ID"]<br />';
		break;
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
