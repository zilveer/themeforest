

(function (){

	"use strict";

	var shortcodes = {};
	if(typeof AitShortcodesList !== 'undefined'){
		shortcodes = AitShortcodesList;
	}else{
		shortcodes['button'] = 'Button';
		shortcodes['lists'] = 'Lists';
		shortcodes['notification'] = 'Notification';
		shortcodes['raw'] = 'Raw';
		shortcodes['rule'] = 'Horizontal rule';
		shortcodes['modal-link'] = 'Modal Window Link';
		shortcodes['modal-content'] = 'Modal Window Content';
	}


	var menu = [];

	tinymce.each(shortcodes, function(value, key){
		var shortcode = {};

		shortcode.text = value;

		if(key !== 'none'){
			shortcode.onclick = function(){
				ait.admin.shortcodes.storage.save({
					activeTab: "#ait-shortcode-" + key + "-panel",
					currentShortcode: key
				});

				if(typeof ait !== 'undefined' && ait.admin && ait.admin.shortcodes && ait.admin.shortcodes.Generator)
					ait.admin.shortcodes.Generator.open(key);


				return false;
			};
		}

		menu.push(shortcode);
	});

	tinymce.PluginManager.add('aitShortcodesButton', function( editor, url ) {
		editor.addButton('aitShortcodesButton', {
			type: "menubutton",
			title: "Insert Shortcode",
			menu: menu,
			onclick: function() {
				// ensure current tinymce has focus!
				editor.focus();
			}
		});
	});



	// add aitShortcodes plugin
	//tinymce.PluginManager.add("aitShortcodesButton", tinymce.plugins.aitShortcodesButton);
})();
