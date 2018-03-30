function insertTypeShortcode() {
	
	var shortcodeText;
	var shortcodeId = document.getElementById('accordiontabs_shortcode').value;
	var sampletext1 = "Lorem ipsum dolor sit amet vestibulum amet ut sit nisl. Odio donec sem tincidunt amet rhoncus aliquam pede libero cursus duis eu aliquam velit et nibh. Facilisis amet dignissim cursus non elit duis. Nibh et tortor augue nibh magna nibh.";
	var sampletext2 = "Vestibulum aliquet convallis placerat. Quisque eu metus ut dolor ornare rutrum nec hendrerit tellus. Phasellus fringilla dignissim varius. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris egestas ipsum placerat semper varius diam tortor vestibulum justo nec porttitor purus libero iaculis nisi.";
	var sampletext3 = "Lorem ipsum dolor sit amet vestibulum amet ut sit nisl. Odio donec sem tincidunt amet rhoncus aliquam pede libero cursus duis eu aliquam velit et nibh. Facilisis amet dignissim cursus non elit duis. Nibh et tortor augue nibh magna nibh.";
	
	if (shortcodeId != 0 && shortcodeId == 'accordion' ){
		shortcodeText = '<br />[accordions active=-1]<br />[accordion title="Accordion Title 1"]<br />Setting active=-1 will start accordion with all tabs closed<br />[/accordion]<br />[accordion title="Accordion Title 2"]<br />' + sampletext2 + '<br />[/accordion]<br />[accordion title="Accordion Title 3"]<br />' + sampletext3 + '<br />[/accordion]<br />[/accordions]<br />';	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'tabs' ){
		shortcodeText = '<br />[tabs]<br />[tab title="Tab1"]<br />' + sampletext1 + '<br />[/tab]<br />[tab title="Tab2"]<br />' + sampletext2 + '<br />[/tab]<br />[tab title="Tab3"]<br />' + sampletext3 + '<br />[/tab]<br />[/tabs]<br />';	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'toggle' ){
		shortcodeText = '<br />[toggle title="The Title"]<br />' + sampletext1 + '<br />[/toggle]<br />';	
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
