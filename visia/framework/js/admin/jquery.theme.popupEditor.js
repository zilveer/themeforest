/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl,tinyMCE,switchEditors */

jQuery(document).ready(function($) {
	
	var editor_id = "pe_theme_embedded_editor";
	var popup_id = editor_id + "_popup";
	var textarea;
	var popup = false;
	
	function loadEditor(e) {
		popup = $("#%0".format(popup_id));
		tinyMCE.execCommand('mceRemoveControl', false, editor_id);
		popup.dialog({
			autoOpen: false,
			modal: true,
			width: 900,
			resizable: false,
			draggable: true,
			dialogClass: "wp-dialog",
			title: "Content Editor",
			position: ["center",50],
			zIndex: 90,
			closeOnEscape: true
		});
	}
	
	function showEditor(id) {
		textarea = $("#"+id);
		
		//tinyMCE.execCommand('mceAddControl', false, id);
		//return;
		if (!popup) {
			loadEditor();
		}
		popup.dialog("open").dialog("moveToTop");
		switchEditors.go(editor_id,"tmce");
		try {
			tinyMCE.execCommand('mceFocus', false, editor_id);	
		} catch (e) {}
		tinyMCE.get(editor_id).setContent(textarea.val());
	}
	
	function save() {
		if (textarea) {
			var ed = tinyMCE.get(editor_id);
			textarea.val(ed.isHidden() ? $("#%0".format(editor_id)).val() : ed.getContent());			
		}
		popup.dialog("close");
		return false;
	}
	
	function show(id) {
		showEditor(id);
		return false;
	}

	window.peThemeCustomEditor = {
		"show": show
	};
	
	$("#peEdit_insert_").click(save);
	
});
