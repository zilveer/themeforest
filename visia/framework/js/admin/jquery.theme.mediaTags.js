/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl */

jQuery(document).ready(function($) {
	// extra check, just to be sure
	if (!$("body").hasClass("upload-php")) {
		return;
	}
	
	var tags = $('<input type="text" name="edit-media-tags"/>');
	var select = $('select[name^="action"]');
	var actionButton = $("#doaction");
	
	function change(e) {
		var el = select.filter(e.currentTarget);
		switch (el.val()) {
		case "bulk_pe_mediaTag_edit":
		case "bulk_pe_mediaTag_add":
			tags.detach().insertAfter(el);
			break;
		default:
			tags.detach();
		}
		
	}

	
	//function check(e) {
		//return false;
	//}
	
	select.find('option:last-child')
		.before('<option value="bulk_pe_mediaTag_add">%0</option>'.format("Add Media Tags"))
		.before('<option value="bulk_pe_mediaTag_edit">%0</option>'.format("Set Media Tags"))
		.before('<option value="bulk_pe_mediaTag_clear">%0</option>'.format("Clear Media Tags"))
		.end()
		.change(change);
	//actionButton.click(check);
	
});
