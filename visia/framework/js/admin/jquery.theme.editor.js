/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl,tinyMCE,switchEditors */

jQuery(document).ready(function($) {
	
	var editor_id = "pe_theme_embedded_editor";
	var editorBox = $("#wp-pe_theme_embedded_editor-wrap").hide();
	var otherBoxes = $("#side-sortables,#normal-sortables");
	var activeDialogs = [];
	var popup_id = editor_id + "_popup";
	var textarea;
	var popup = false;
	
	function closeDialogs() {
		var i,d,dialogs = $(".ui-dialog-content");
		activeDialogs = [];
		for (i=0;i<dialogs.length;i++) {
			d = $(dialogs[i]);
			if (d.dialog("isOpen")) {
				d.dialog("close");
				activeDialogs.push(d);
			}
		}
	}
	
	function openDialogs() {
		var d;
		while ((d = activeDialogs.shift())) {
			d.dialog("open");
		}
	}

	
	function showEditor(id) {
		textarea = $("#"+id);
		closeDialogs();
		editorBox.show();
		saveButton.show();
		otherBoxes.hide();
		switchEditors.go(editor_id,"tmce");
		tinyMCE.DOM.setStyle(tinyMCE.DOM.get(editor_id + '_ifr'), 'height', 300 + 'px');
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
		editorBox.hide();
		saveButton.hide();
		otherBoxes.show();
		openDialogs();
		textarea.focus();
		textarea.triggerHandler("change");
		return false;
	}
	
	function show(id) {
		showEditor(id);
		return false;
	}

	window.peThemeCustomEditor = {
		"show": show
	};
	
	var saveButton = $("#peEdit_insert_").click(save).parent().hide();
	
});
