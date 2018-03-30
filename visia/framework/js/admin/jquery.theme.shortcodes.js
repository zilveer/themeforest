/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl,tinymce */

(function($) {
	
	var editor;
	var popup;
	var popupURL = ajaxurl+"?action=pe_theme_shortcode_manager";
	var selected;
	var inputs;
	var shortcode;
	var content;
	var scBlocks;
	var multipleValues;
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	$.pixelentity.shortcodes = $.pixelentity.shortcodes || {};
	
	function init(ed) {
		editor = ed;
		open();
	}
	
	function open() {
		if (popup) {
			popup.dialog("open").dialog("moveToTop");
			$(".ui-widget-overlay").bind("click",close);
		} else {
			popup = $("<div id=\"peSCM\"></div>");
			$("body").append(popup);		
			popup.load(popupURL,{},loaded);
			
		}
	}
	
	function close() {
		popup.dialog("close");
		return false;
	}

	
	function loaded() {
		popup.dialog({
			autoOpen: false,
			modal: true,
			width: 600,
			resizable: false,
			draggable: true,
			dialogClass: "wp-dialog",
			title: "Select a Shortcode",
			position: ["center",50],
			zIndex: 90,
			closeOnEscape: true
		});
		selected = $("#peSCM_select_");
		$("#peSCM_insert_").click(insert);
		inputs = popup.find("input,select,textarea");
		scBlocks = $(".peThemeSC");
		selected.change(change).triggerHandler("change");
		open();
		popup.tooltip({
			tooltipClass: 'pe-theme-admin-tooltip',
			items: 'span.help[title]',
			show: { effect: "fadeIn", delay: 200, duration: 200 },
			hide: { effect: "fadeOut", duration: 0 },
			content: function () { return $(this).attr("title"); },
			position: {
				my: "left-166 bottom-20",
				at: "left top",
				collision: "none",
				using: function( position, feedback ) {
					$(this).css(position);
					$( "<div>" )
						.addClass( "arrow" )
						.addClass( feedback.vertical )
						.addClass( feedback.horizontal )
						.appendTo( this );
				}
			}
		});
	}
	
	function sendToEditor() {
		editor.selection.setContent(shortcode);
		close();
		return false;
	}
	
	function insert() {
		var name = selected.val();
		var api = $.pixelentity.shortcodes[name];
		
		if (typeof api !== "undefined" && typeof api.shortcode === "function") {
			// shortcode is bound to a js plugin, so we use its api to get the value
			shortcode = api.shortcode();
			//shortcode = shortcode.replace(/\]\[/g,"]\n[");
		} else {
			// normal shortcode, build from fields
			content = false;
			multipleValues = {};
			shortcode = "["+name;
			inputs.filter('[name^="'+name+'["]').each(addAttribute);
			
			for (var attr in multipleValues) {
				shortcode += " %0=\"%1\"".format(attr,multipleValues[attr].join(","));
			}
			
			shortcode += "]";
			
			// add content, if any
			if (content !== false) {
				shortcode += "%0[/%1]".format(content,name);
			}
			
		}
		return sendToEditor();
	}
	
	function change() {
		var name = selected.val();
		scBlocks.hide();
		scBlocks.filter("#%0".format(name)).show();
	}
	
	function addAttribute(idx,element) {
		var input = inputs.filter(element);
		var name = input.attr("name").match(/\[([^\]]+)\]/)[1];
		var checkbox = input.attr("type") === "checkbox";
		var radio = input.attr("type") === "radio";
		var multiple = checkbox;
		
		if (name.indexOf("ignore") >= 0 || input.data("ignore")) {
			return;
		}
		var value = input.val();
		if (name === "content") {
			content = value;
			return;
		}
		if (name === "shortcode") {
			shortcode = value;
		} else {
			if (multiple) {
				if (checkbox && !input.is(":checked")) {
					return;
				}
				if (multipleValues[name]) {
					multipleValues[name].push(value);
				} else {
					multipleValues[name] = [value];
				}
			} else {
				if (value !== "" && (!radio || input.is(":checked")) ) {
					shortcode += " %0=\"%1\"".format(name,value);					
				}
			}
		}
	}

	
	tinymce.create('tinymce.plugins.peThemeShortcodeManager', {
		
		init : function(ed, url) {
			ed.addButton('peSCM', {
				title : 'Shortcodes',
				onclick : function (e) {
					init(ed);
				}
			});
			
		},

		getInfo : function() {
			return {
				longname : 'WP Fullscreen',
				author : 'WordPress',
				authorurl : 'http://wordpress.org',
				infourl : '',
				version : '1.0'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('peThemeShortcodeManager', tinymce.plugins.peThemeShortcodeManager);
}(jQuery));


