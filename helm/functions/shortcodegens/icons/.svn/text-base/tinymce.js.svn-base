function insertShortcode() {
	
	var shortcodeText;
	var shortcodeId = document.getElementById('icons_shortcode').value;
	var shortcodeColor = document.getElementById('icons_color').value;
	var shortcodeAlign = document.getElementById('icons_align').value;
	var sampletext = "Donec tristique augue id convallis rutrum nunc justo egestas magna eu aliquam eros lectus cursus lectus.";
	
	
	if (shortcodeId != 0 ){
		shortcodeText = '<br />[display_icon type="' + shortcodeId +'" color="' + shortcodeColor + '" alignment="' + shortcodeAlign + '"]<br />';	
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
