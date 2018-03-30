/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl,tinymce,JSON,QTags */

(function($) {
	
	var dataType;
	var postMboxes;
	var viewMboxes;
	var settingsMboxes;
	var captionMboxes;
	var layoutMbox;
	var linkMbox;
	var galleryMbox;
	var captionsSupport = window.pe_theme_view.captions;
	var linksSupport = window.pe_theme_view.links;
	var taxonomies = window.pe_theme_view.taxonomies;
	var taxSelects;
	
	function layout() {
		postMboxes.hide();
		viewMboxes.hide();
		settingsMboxes.hide();
		var data = dataType.val();
		var view,viewInput = viewMboxes.filter("#pe_theme_meta_view-%0".format(data));
		viewInput[viewInput.find("input").length > 1 ? "show" : "hide"]();
		view = viewInput.find("input:checked").val();
		if (!view) {
			view = viewInput.find("input:first").val();
		}
		settingsMboxes.filter("#pe_theme_meta_settings-%0".format(view)).show();
		var type;
		switch (data) {
		case "gallery":
			type = false;
			allowTax(taxonomies.attachment);
			break;
		default:
			type = data.replace("post-","");
			allowTax(taxonomies[type]);
			break;
		}
		if (type) {
			postMboxes.filter("#pe_theme_meta_post-%0".format(type)).show();
		}
		if (captionsSupport[view] && data != "post-slide") {
			captionMboxes.hide();
			captionMboxes.filter("#pe_theme_meta_caption-%0".format(data == "gallery" ? "gallery" : "post")).show();

		} else {
			captionMboxes.hide();
		}
		if (linksSupport[view]) {
			linkMbox.show();
		} else {
			linkMbox.hide();
		}
		galleryMbox[data == "gallery" ? "show" : "hide"]();
		layoutMbox[data == "layout" ? "show" : "hide"]();
	}
	
	function allowTax(allowed) {
		taxSelects.each(function () {
			var select = taxSelects.filter(this);
			select.find("option").each(function () {
				var option = taxSelects.find(this);
				var value = option.val();
				if (!value || ($.inArray(value,allowed)) != -1) {
					option.show();
					option.removeAttr("disabled");
				} else {
					option.hide();
					option.attr("disabled","disabled");
					if (option.is(":selected")) {
						select.find("option:first").prop("selected",true);
						select.triggerHandler("change");
					}
				}
				//option[($.inArray(option.val(),allowed)) != -1 ? "show" : "hide"]();
			});
		});
	}

	
	function init() {
		dataType = $("#pe_theme_meta_data__type_");
		postMboxes = $("div.postbox[id^=pe_theme_meta_post-]");
		viewMboxes = $("div.postbox[id^=pe_theme_meta_view-]");
		layoutMbox = $("div.postbox[id^=pe_theme_meta_layout]");
		settingsMboxes = $("div.postbox[id^=pe_theme_meta_settings-]");
		captionMboxes = $("div.postbox[id^=pe_theme_meta_caption-]");
		//linkMbox = $("div.postbox[id^=pe_theme_meta_caption]");
		taxSelects = $("select[data-datatype='taxonomies']");
		galleryMbox = $("#pe_theme_meta_gallery");
		linkMbox = $("#pe_theme_meta_link");
		dataType.change(layout);
		viewMboxes.find("input").click(layout);
		layout();
	}
	
	$(init);

}(jQuery));


