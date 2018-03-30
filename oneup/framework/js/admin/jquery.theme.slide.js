/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl,tinymce,JSON,QTags */

(function($) {
	
	
	var w = 940;
	var h = 300;
	var radio;
	var richedit;
	var preview,iframe;
	var img;
	
	var mainTab, editTab;
	var activeTab;
	var jwin = $(window);
	var selected;
	var items;
	var autoSave = false;
	var needSave = false;
	var captions;
	var needUpdate = false;
	var timer = 0;
	var focused = false;
	var dragging = false;
	var mbox;
	var useAnimations = false;
	var layout;
	
	function format() {
		if (radio.filter(":checked").val() != "normal") {
			richedit.hide();
			mbox.show();
		} else {
			richedit.show();
			mbox.hide();
		}
	}
	
	function evHandler(e) {
		switch (e.type) {
		case "mousemove":
			if (dragging) {
				//console.log(e.pageX,e.pageY);
				//console.log(selected.attr("data-id"));
				dragging.item.css({
					left: dragging.x + e.pageX,
					top: dragging.y + e.pageY
				});
				//pos(e.pageX,e.pageY,true);	
			}
			break;
		case "click":
			if (dragging) {
				pos(dragging.x + e.pageX,dragging.y + e.pageY,true);
				dragging = false;
			}
			
			/*
			if (e.shiftKey) {
				pos(e.pageX,e.pageY,true);
				return false;
			}
			*/
			break;
		case "keydown":
			if (!focused) {
				return true;
			}
			switch (e.keyCode) {
			case 37:
				// left
				pos(e.shiftKey ? -10 : -1,false);
				return false;
			case 38:
				// up
				pos(false,e.shiftKey ? -10 : -1);
				return false;
			case 39:
				// right
				pos(e.shiftKey ? +10 : +1,false);
				return false;
			case 40:
				// down
				pos(false,e.shiftKey ? +10 : +1);
				return false;
			case 72:
				// h
				var layer = preview.find(".peCaptionLayer[data-id='%0']".format(selected.attr("data-id")));
				pos((w-layer.outerWidth(true)) >> 1,false,true);
				return false;
			case 86:
				// v
				var layer = preview.find(".peCaptionLayer[data-id='%0']".format(selected.attr("data-id")));
				pos(false,(h-layer.outerHeight(true)) >> 1,true);
				return false;
			}
		}
	}
	
	function focusHandler(e) {
		focused = (e.type === "mouseenter");
		if (!focused && dragging) {
			dragging = false;
			previewCaptions();
		}
	}

	
	function pos(x,y,absolute) {
		if (selected) {
			var xf = selected.find('input[data-name="x"]');
			var yf = selected.find('input[data-name="y"]');
			if (absolute) {
				if (x !== false) xf.val(x);
				if (y !== false) yf.val(y);
			} else if (y === false) {
				xf.val(parseInt(xf.val(),10)+x);
			} else if (x === false) {
				yf.val(parseInt(yf.val(),10)+y);
			}
			previewCaptions();
		}
	}
	
	function itemsHandler(e,data) {
		dirty();
		switch (e.type) {
		case "add":
			edit(data.el);
			previewCaptions();
			break;
		case "delete":
			if (selected && (data.el.attr("data-id") == selected.attr("data-id"))) {
				selected = false;
				edit(items.find(".pe_fields_item_item:first-child"));
			} else {
				edit(selected);
			}
			if (!selected) {
				showTab("main");
			}

		}
		return false;
	}
	
	function scaleImage() {
		var iw,ih,scaler;
		
		iw = img[0].naturalWidth || img.attr("width");
		ih = img[0].naturalHeight || img.attr("height");
		img.css("max-width","none");
		scaler = $.pixelentity.Geom.getScaler("fillmax","center","top",1920,h,iw,ih);
		img.transform(scaler.ratio,scaler.offset.w-((1920-w) >> 1),scaler.offset.h,iw,ih,true);
	}

	
	function refreshImage(data) {
		var url = false;
		try {
			url = data.resized[0];
			img.data("url",data.orig);
		} catch (x) {}
		if (url) {
			img.attr("src",url).show();
			if (layout.filter(":checked").val() !== "boxed") {
				img.one("load",scaleImage);
			}
		}
	}

	
	function previewImage(url,isID) {
		if (url) {
			if (!img) {
				img = $('<img class="pe_layer_builder_background"/>');
				preview.append(img);
			}
			
			img.attr("style","");
			
			var boxed = layout.filter(":checked").val() === "boxed";
			
			jQuery.post(
				ajaxurl,
				{
					action : "pe_theme_image_resize",
					w:boxed ? w : 10000,
					h:boxed ? h : 10000,
					isID: isID,
					img : url
				},
				refreshImage
			);	
			//img.attr("src",url);
		} 
	}
	
	function previewCaptions(animated) {
		needUpdate = true;
		useAnimations = animated === true;
		clearTimeout(timer);
		timer = setTimeout(renderCaptions,50);
	}
	
	function renderCaptions() {
		if (!needUpdate) {
			return;
		}
		needUpdate = false;
		var i,f,field,fields,caption,captions_data = items.find(".pe_fields_item_item");
		var output = preview.find("div.peVolo");
		var template = '<div class="peCaptionLayer %0 %4 %5 %7" data-id="%8" style="-moz-user-select: none;-webkit-user-select: none;cursor:pointer;position:absolute;width:auto;left:%1px;top:%2px;%6">%3</div>';
		if (output.length === 0) {
			output = $('<div class="peVolo peSlider"></div>');
			output.css({
				"overflow" : "hidden",
				"position" : "absolute",
				"top": 0,
				"left": 0
			});
			output.width(w).height(h);
			preview.append(output);
			output.append('<div class="peCaption"></div>');
		} 
		output = output.find("> div.peCaption");
		output.width(w).height(h);
		output.empty();
		captions = [];
		
		for (i=0;i<captions_data.length;i++) {
			fields = items.find(captions_data[i]);
			caption = {id: fields.attr("data-id")};
			fields = fields.find("input,textarea,select");
			for (f=0;f<fields.length;f++) {
				field = items.find(fields[f]);
				caption[field.attr("data-name")] = field.val();
			}
			captions.push(caption);
			var style = "";
			
			if (caption.color) {
				style = "color:%0;".format(caption.color);
			}
			
			if (caption.bgcolor && caption.bgcolorAlpha) {
				var color = new window.Color(caption.bgcolor);
				color = color.toRgb();
				style += "background-color:%0;background-color:rgba(%1,%2,%3,%4)".format(caption.bgcolor,color.r,color.g,color.b,caption.bgcolorAlpha);
			}
			
			if (caption.custom) {
				style += ";%0;".format(caption.custom.replace(/"/g,"'"));
			}
			
			if (useAnimations) {
				style += ";-webkit-animation-delay:%0s".format(caption.delay);
				style += ";-moz-animation-delay:%0s".format(caption.delay);
				style += ";animation-delay:%0s".format(caption.delay);
				style += ";-webkit-animation-duration:%0s".format(caption.duration);
				style += ";-moz-animation-duration:%0s".format(caption.duration);
				style += ";animation-duration:%0s".format(caption.duration);
			}
			
			output.append(template.format(
				useAnimations ? caption.transition+" animated" : "",
				caption.x,
				caption.y,
				caption.content,
				caption.style,
				caption.size,
				style,
				caption.classes,
				caption.id
			));
		}
		output.css({
			"opacity": 1,
			"background-image": "none",
			"background-color": "transparent",
			"max-width": "none"
		});
		output.parent().removeClass("peVolo peSlider").addClass("peVolo peSlider");
		useAnimations = false;
	}
	
	function removeFeaturedImage() {
		if (img) {
			img.hide();
		}
	}

	
	function applyStyles(data) {
		iframe
			.contents()
			.find("head")
			.append($(data).filter("link[rel='stylesheet'], style").not("#admin-bar-css"))
			.append('<style>html { margin-top: 0px !important} * html body { margin-top: 0px !important; }</style>');
		
		preview.width(w).height(h);
		preview.css({
			background: "#888",
			overflow: "hidden"
		});
				
		iframe.contents().find("body").css({margin: 0,padding: 0}).append(preview);
		
		previewImage(iframe.attr("data-img"));
		/*
		featuredField = $("input[name='thumbnail_id']");
		if (featuredField.length > 0) {
			console.log("here");
			// wp 3.5 and above
			setInterval(monitorFeatured,500);
		}
		*/
		$("#select-featured-image a.remove, #remove-post-thumbnail").click(removeFeaturedImage);
		
		preview.bind("click",evHandler);
		preview.bind("mousemove",evHandler);
		
		
		$(document).bind("keydown",evHandler);
		iframe.contents().bind("keydown",evHandler);
		
		previewCaptions();
	}

	function showTab(which) {
		activeTab = which;
		switchTab();
		//setTimeout(switchTab,100);
	}
	
	function switchTab(noscroll) {
		
		if (activeTab === "edit") {
			mainTab.width(540);
			editTab.css("min-height",mainTab.find(".pe_field_items").height()-73);
			editTab.removeClass("ui-tabs-hide");
			//mainTab.addClass("ui-tabs-hide");
		} else {
			editTab.addClass("ui-tabs-hide");
			mainTab.width(w);
			mainTab.removeClass("ui-tabs-hide");
		}
		if (noscroll === false) {
			return;
		}
		
	}
	
	function findRow(el) {
		return mainTab.find(el).closest(".pe_fields_item_item");
	}

	function editItem(el) {
		autoSave = false;
		var i,editField,field,fields = el.find("input,select,textarea");
		for (i=0;i<fields.length;i++) {
			field = el.find(fields[i]);
			editField = editTab.find('[data-name="%0"]'.format(field.attr("data-name")));
			if (editField.length > 0) {
				editField.val(field.val()).triggerHandler("change");
			}
		}
		autoSave = true;
	}
	
	function saveItem(el) {
		autoSave = false;
		var saved = false;
		var i,oldV,newV,editField,field,fields = editTab.find("input,select,textarea");
		for (i=0;i<fields.length;i++) {
			editField = editTab.find(fields[i]);
			field = el.find('[data-name="%0"]'.format(editField.attr("data-name")));
			if (field.length > 0) {
				oldV = field.val();
				newV = editField.val();
				field.val(newV);
				if (newV != oldV) {
					saved = true;
					field.triggerHandler("change");
				}
			}
		}
		if (saved) {
			dirty();
			previewCaptions();
		}
		autoSave = true;
	}
	
	function edit(el) {
		if (!el || el.length === 0) {
			return false;
		}
		mainTab.find(".pe_fields_item_item").removeClass("pe_item_active");
		if (selected) {
			saveItem(selected);
		}
		selected = findRow(el).addClass("pe_item_active");
		editItem(selected);
		
		showTab("edit");
		return false;
	}
	
	function editHandler(e) {
		edit(e.currentTarget);
		return false;
	}
	
	function layoutHandler() {
		if (img) {
			previewImage(img.data("url"));
		}
		/*
		if (layout.filter(":checked").val() !== "boxed") {
			img.one("load",scaleImage);
		}
		*/
	}

	
	function saveHandler(e) {
		if (!autoSave || !selected) {
			return;
		}
		save();
		previewCaptions();
	}
	
	function save() {
		//console.log(selected);
		if (selected) {
			saveItem(selected);
		}
		return false;
	}
	
	function buttonsHandler(e) {
		var btn = $(e.currentTarget); 
		if (btn.hasClass("pe-run-preview")) {
			previewCaptions(true);
		} else if (btn.hasClass("pe-save")) {
			$("#publish").trigger("click");
		} else {
			featuredImage();
		}
		return false;

	}

	
	function featuredImage(e) {
		$("#set-post-thumbnail, #select-featured-image a.choose").trigger("click");
		return false;
	}
	
	function ajaxComplete(event, xhr, settings) {
		var req = settings.data,id;
		if (req && req.search('action=set-post-thumbnail') != -1) {
			if ((id = req.match(/thumbnail_id=([^&]*)/))) {
				id = id[1];
				if (id != "-1") {
					previewImage(id,true);
				} else {
					removeFeaturedImage();					
				}
			}
		}
	}
	
	function findCaption(e) {
		var jel = $(e.currentTarget);
		var layer = items.find(".pe_fields_item_item[data-id='%0']".format(jel.attr("data-id")));
		edit(layer);
		if (e.shiftKey) {
			dragging = {
				item: jel,
				x: parseInt(layer.find("input[data-name='x']").val(),10) - e.pageX,
				y: parseInt(layer.find("input[data-name='y']").val(),10) - e.pageY
			};
			e.preventDefault();
			e.stopImmediatePropagation();
		}
	}
	
	function scroll() {
		var st = jwin.scrollTop();
		var it = iframe.parent().offset().top;
		var offset = jQuery("#wpadminbar").height() || 0;
		if (st >= (it-offset)) {
			iframe.css("position","fixed").css("top",offset);
		} else {
			iframe.css("position","absolute").css("top",0);
		}
	}
	
	function dirty() {
		needSave = true;
		window.onbeforeunload = function(){
			return needSave ? window.autosaveL10n.saveAlert : true;
		};
	}
	
	function init() {
		$('label[for="post-format-gallery"]').text("Layers");
		richedit = $("#postdivrich");
		mbox = $("#pe_theme_meta_layers");
		radio = $("#pe_theme_meta_format input");
		
		layout=mbox.find("input[id^=%0_layout_]".format("pe_theme_meta_layers_"));
		layout.change(layoutHandler);
		
		iframe = $("#pe_layer_builder_iframe").css("overflow","hidden");
		w = parseInt(iframe.attr("data-w"),10);
		h = parseInt(iframe.attr("data-h"),10);
		iframe.width(w).height(h);
		iframe.css("border","1px dotted gray");
		iframe.parent().width(Math.max(940,w)).height(h);
		iframe.parent().height(h);
		iframe.next().css("margin-top",h+16);
		iframe.css("position","absolute").css("z-index",1);
		iframe.parent().find("input.ob_button").click(buttonsHandler);
		
		preview = $("<div class=\"pe_layer_builder_preview\"/>");
		$.get(iframe.attr("data-home"),applyStyles);
		//$("#post-formats-select").change(layout).triggerHandler("change");
		radio.change(format).triggerHandler("change");
		
		$("#pe_theme_meta_layers__tab_preview").addClass("ui-tabs-panel");
		mainTab = $("#pe_theme_meta_layers__tab_main");
		editTab = $("#pe_theme_meta_layers__tab_edit");
		
		$("#pe_theme_meta_layers__tab_preview").css({"padding-bottom": 0});
		
		//mainTab.css({"padding-top": 0,"width": w}).addClass("ui-tabs-panel");
		//editTab.css({"padding-top": 0,"width": w}).addClass("ui-tabs-panel");
		mainTab.css({"padding-top": 0}).addClass("ui-tabs-panel");
		editTab.css({"padding-top": 0}).addClass("ui-tabs-panel");
		
		mainTab.delegate("a.edit-inline","click",editHandler);
		
		preview.delegate(".peCaptionLayer","click",findCaption);
		
		$("#pe_theme_meta_layers__saveCaption_").click(save);
		
		showTab("main");	
		
		items = $("#pe_theme_meta_layers__captions_").bind("add.pixelentity delete.pixelentity",itemsHandler);
		items.bind("sorted.pixelentity",previewCaptions);
		edit(items.find(".pe_fields_item_item:first-child"));
		editTab.find("input,select,textarea").bind("change focusout keydown",saveHandler);
		//mainTab.find("input,select,textarea").bind("change focusout keydown",previewCaptions);
		mainTab.delegate("input,select,textarea","change focusout keydown",previewCaptions);
		//editTab.closest(".postbox").bind("mouseenter mouseleave",focusHandler);
		$("#pe_theme_meta_layers__tab_preview").bind("mouseenter mouseleave",focusHandler);
		//previewCaptions();
		$(document).ajaxComplete(ajaxComplete);
		
		// sticky preview
		//jwin.bind("scroll",scroll);
		
		setInterval(save,500);
		
	}
	
	$(init);

}(jQuery));


