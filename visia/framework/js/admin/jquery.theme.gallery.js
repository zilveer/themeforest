/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl,tinymce,JSON */

(function($) {
	
	var popup;
	var captions = {};
	var current;
	
	var mainTab,editTab,activeTab,captionManager;
	var fields,captionFields;
	var sc = $("body,html");
	var jwin = $(window);
	var target,data;
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	$.pixelentity.shortcodes = $.pixelentity.shortcodes || {};
	
	function edit(t) {
		target = t;
		data = JSON.parse(target.val()) || {};
		open();
	}
	
	function open(target) {
		if (popup) {
			setFieldsValue(fields,data);
			if (captionManager) {
				var names = [];
				if (data.captions) {
					//captions = data.captions;
					var i;
					for (i = 0;i<data.captions.length;i++) {
						names.push(data.captions[i].name);
						captions[data.captions[i].name] = data.captions[i].data;
					}
				} else {
					captions = {};
				}
				captionManager.peFieldSidebars().setData(names);	
			}
			popup.dialog("open");
			//$(".ui-widget-overlay").bind("click",close);
		} else {
			create();			
		}
		
	}
	
	function close() {
		popup.dialog("close");
		return false;
	}

	
	function create() {
		popup = $("#pe_captions_manager");
		
		if (popup.length === 0) {
			return;
		}
		
		popup.dialog({
			autoOpen: false,
			modal: true,
			width: 600,
			resizable: false,
			draggable: false,
			dialogClass: "wp-dialog",
			title: "Gallery Image Settings",
			position: ["center",50],
			zIndex: 90,
			close: reset,
			closeOnEscape: true
		});
		
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
		
		mainTab = $("#peCaptionManager_main");
		editTab = $("#peCaptionManager_edit");
		
		fields = getFields(mainTab.find('input[type="text"],select,textarea').not(".pe_field_links input"));
		captionFields = getFields(editTab.find('input[type="text"],select,textarea'));
		
		$("#peCaptionManager_saveCaption_").click(saveCurrentCaption);
		$("#peCaptionManager_save_").click(save);
		
		captionManager = $("#peCaptionManager_captions_");
		captionManager = (captionManager.length > 0) ? captionManager : false;
		
		if (captionManager) {
			captionManager
				.bind("add.pixelentity",addCaption)
				.bind("delete.pixelentity",deleteCaption)
				.delegate("a.edit-inline","click",editCaption);	
		}
		open();
	}
	
	function getFields(selector) {
		var f = {},el;
		var i = selector.length;
		while (i--) {
			el = $(selector[i]);
			f[el.attr("data-name")] = el;
		}
		return f;
	}

	
	function showTab(which) {
		activeTab = which;
		setTimeout(switchTab,100);
	}
	
	function reset() {
		activeTab = "main";
		switchTab(false);
	}

	
	function switchTab(noscroll) {
		if (activeTab === "edit") {
			mainTab.hide();
			editTab.show();
		} else {
			mainTab.show();
			editTab.hide();
		}
		if (noscroll === false) {
			return;
		}
		jwin.scrollTop(popup.offset().top-70);	
	}
	
	function getFieldsValue(fields) {
		var p;
		var values = {};
		for (p in fields) {
			if (typeof p === "string") {
				values[p] = fields[p].val();
			}
		}
		return values;
	}
	
	function setFieldsValue(fields,values) {
		var p;
		for (p in fields) {
			if (captionManager) {
				if (typeof p === "string" && typeof values[p] !== "undefined") {
					fields[p].val(values[p]).triggerHandler("change");
				}	
			} else {
				fields[p].val(values[p] || "").triggerHandler("change");
			}
			
		}
	}
	
	function saveCurrentCaption(e) {
		showTab("main");
		captions[current] = getFieldsValue(captionFields);
	}
	
	function save() {
		var values = getFieldsValue(fields);
		var captionsConf = [];
		if (captionManager) {
			var trs = captionManager.find("td.col-title");
			var i,name;
			for (i=0;i<trs.length;i++) {
				name = $(trs[i]).text();
				captionsConf.push({name:name,data:captions[name]});
			}
			values.captions = captionsConf;	
		} else {
			delete values.captions;
		}
		target.val(JSON.stringify(values));
		close();
	}

	
	function addCaption(e,data) {
		showTab("edit");
		current = data.value;
	}
	
	function deleteCaption(e,data) {
		delete captions[data.value];
		return false;
	}
	
	function editCaption(e) {
		var tr = popup.find(e.target).parents("tr");
		current = tr.find(".col-title").text();
		if (captions[current]) {
			setFieldsValue(captionFields,captions[current]);
			showTab("edit");			
		}
		
		return false;
	}
	
	window.Gallery = {
		edit: edit
	};
	
	/*
	setTimeout(function () {
		Gallery.edit($("#pe_gallery_fields_%0".format(574)));
	},1000);
	*/
}(jQuery));


