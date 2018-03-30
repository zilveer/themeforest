function insertTypeShortcode() {
	
	var shortcodeText;
	var map_type = document.getElementById('map_type').value;
	var map_width = document.getElementById('map_width').value;
	var map_height = document.getElementById('map_height').value;
	var map_address = document.getElementById('map_address').value;
	var map_latitude = document.getElementById('map_latitude').value;
	var map_longitude = document.getElementById('map_longitude').value;
	var map_marker = document.getElementById('map_marker').value;
	var map_zoom = document.getElementById('map_zoom').value;
	var map_scroll = document.getElementById('map_scroll').value;
	var map_control = document.getElementById('map_control').value;
	var map_marker = document.getElementById('map_marker').value;
	var map_marker_image = document.getElementById('map_marker_image').value;
	var map_marker_text = document.getElementById('map_marker_text').value;
	
	var mtype = 'maptype="' + map_type + '"';
	var mscroll = ' scrollwheel="' + map_scroll + '"';
	var mcontrol = ' hidecontrols="' + map_control + '"';
	var mmarker = ' marker="' + map_marker + '"';
	
	var map_data = mtype + mscroll + mcontrol + mmarker;
	
	if (map_zoom !="" ) {  map_data += ' z="' + map_zoom + '"'; }
	if (map_height !="" ) {  map_data += ' h="' + map_height + '"'; }
	if (map_width !="" ) {  map_data += ' w="' + map_width + '"'; }
	if (map_address !="" ) {  map_data += ' address="' + map_address + '"'; }
	if (map_latitude !="" ) {  map_data += ' lat="' + map_latitude + '"'; }
	if (map_longitude !="" ) {  map_data += ' lon="' + map_longitude + '"'; }
	if (map_marker_image !="" ) {  map_data += ' markerimage="' + map_marker_image + '"'; }
	if (map_marker_text !="" ) {  map_data += ' infowindow="' + map_marker_text + '"'; }
	
	shortcodeText = '<br />[map ' + map_data +']<br />';
		
	if ( mtype == 0 ){
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