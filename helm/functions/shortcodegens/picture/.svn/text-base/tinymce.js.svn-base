function insertTypeShortcode() {
	
	var shortcodeText;
	var picture_imageurl = document.getElementById('picture_imageurl').value;
	var picture_title = document.getElementById('picture_title').value;
	var picture_lightbox = document.getElementById('picture_lightbox').value;
	var picture_width = document.getElementById('picture_width').value;
	var picture_height = document.getElementById('picture_height').value;
	var picture_link = document.getElementById('picture_link').value;
	var picture_align = document.getElementById('picture_align').value;
	var sampletext = "Sample text";
	
	
	shortcodeText = '<br />[pictureframe image="' + picture_imageurl + '" align="' + picture_align + '" lightbox="' + picture_lightbox + '" title="' + picture_title + '" link="' + picture_link + '" width="' + picture_width + '" height="' + picture_height + '"]';	
		
	if ( picture_imageurl == 0 ){
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
