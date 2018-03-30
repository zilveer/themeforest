function insertTypeShortcode() {
	
	var shortcodeText;
	var videotype = document.getElementById('video_type').value;
	var videoid = document.getElementById('video_id').value;
	var flashurl = document.getElementById('video_url').value;
	var videoheight = document.getElementById('video_height').value;
	var videowidth = document.getElementById('video_width').value;
	
	var vtype = 'type="' + videotype + '"';
	var vID = ' clip_id="' + videoid + '"';
	var flashsrc = ' src="' + flashurl + '"';
	var vheight = ' height="' + videoheight + '"';
	var vwidth = ' width="' + videowidth + '"';
	
	switch (videotype) {
		case 'youtube':
			shortcodeText = '<br />[video ' + vtype + vID + vheight + vwidth + ']<br />';
			break;			
		case 'vimeo':
			shortcodeText = '<br />[video ' + vtype + vID + vheight + vwidth + ']<br />';	
			break;
		case 'dailymotion':
			shortcodeText = '<br />[video ' + vtype + vID + vheight + vwidth + ']<br />';	
			break;
		case 'flash':
			shortcodeText = '<br />[video ' + vtype + flashsrc + vheight + vwidth + ']<br />';	
			break;
	}
		
	if ( videotype == 0 ){
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