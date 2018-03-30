(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global wp,jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl,tb_show */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peMetaboxGallery = {	
		conf: {
			api: true,
			tag: "gallery"
		} 
	};
	
	var workflow = false;
	
	function reset() {
		workflow.off("select");
	}
	
	var emtpyData = {
			link: ""	
		};
		
	function PeMetaboxGallery(target, conf) {
		var id= conf.id ? conf.id : target.parents(".postbox").attr("id")+"_";
		var galleryTagSlug = "gallery-"+target.attr("data-postID");
		var addControlMarkup = target.hasClass("pe_no_quick") ? "" : '<div class="pe_btn_container"><input type="button" id="pe_add" class="ob_button" value="Add"><p class="description">Add new images to the gallery from existing content in the "Media Library".</p></div>';
		var type=target.find("#%0_type_".format(id));
		//var mtags=target.find('input[id^="%0_media-tags_"]'.format(id));
		var mtags=target.find('input[id^="%0_tags_"]'.format(id));
		var sort=target.find('input[id^="%0_sort_"]'.format(id));
		var fieldPrefix = type.attr("name").replace(/\[\w+\]$/,"");
		var newThumb = '<div class="pe_thumb" id="%1"><div class="media"><div class="pe_icons"><a href="#" data-id="%1" class="edit"/><a href="#" data-id="%1" class="delete"/></div><img src="%0"/></div>%2<input type="hidden" name="'+fieldPrefix+'[order][]" value="%1"/></div>';
		
		var editFormFieldPrefix = fieldPrefix+"[data][%0]";
		var editForm = '<div class="fields"><textarea id="pe_gallery_fields_%0" name="'+editFormFieldPrefix+'">%1</textarea></div>';
		var mtagsBox = mtags.closest("div.option").css("padding-bottom",10);
		var upload = target.find("#%0_images_".format(id));
		var loading = false;
		var sortable = false;
		var tags;
		
		var output = $('<div class="pe_gallery"><h4 id="pe_collapse">Gallery Content</h4><div class="pe_collapse"><div class="pe_controls">'+addControlMarkup+'<div class="pe_btn_container"><input type="button" id="pe_reload" class="ob_button" value="Refresh"><p class="description">Reverts to the last saved thumbnail sequence, or if you wish to add  further images using new media tags, hitting "Refresh" will load these  new images.</p></div><div class="pe_btn_container"><input type="button" id="pe_save" class="ob_button" value="Save"><p class="description">Save Gallery changes.</p></div></div></div><div class="pe_sortable_container"><div class="pe_output ui-sortable"></div></div></div>');
		target.find(".contents").append(output);
		
		var editButton=$("#pe_edit_data").data("edit",false);
		var collapse = output.find(".pe_collapse");
		var addFromMedia = output.find("#pe_add").closest(".pe_btn_container");

		
		output.delegate("#pe_add,#pe_collapse,#pe_save,a,input[type=button]","click",clickHandler);

		output = output.find(".pe_output");
		
		target.find("#tab1").removeClass("ui-tabs-panel");
		
		function getValue(idx,el) {
			return el.value;
		}

		
		function typeChange() {
			var vtype = type.val();
			switch (vtype) {
			case "upload":
				mtagsBox.hide();
				upload.show();
				tags = galleryTagSlug;
				output.addClass("upload_type");
				addFromMedia.show();
				break;
				
			default:
				mtagsBox.show();
				upload.hide();
				tags = $.makeArray(mtags.filter(":checked").map(getValue));
				tags = tags.join(vtype === "any" ? "," : "+");
				output.removeClass("upload_type");
				addFromMedia.hide();

			}
			reload();
		}
		
		function reload(data) {
			if (loading) {
				return;
			}
			if (typeof tags != "null" && tags != '') {
				getData(tags,data);	
			} else {
				output.html("");
			}
		}
		
		function getData(tags,data) {
			if (loading) {
				return;
			}
			
			loading = true;
			
			var params = {
					action : "pe_theme_gallery_fetch",
					galleryID : target.attr("data-postID"),
					sort: sort.filter(":checked").val(),
					tags : tags
				};
			
			if (data) {
				params.data = data;
				params.action = "pe_theme_gallery_add";
			}
			
			jQuery.post(
				ajaxurl,
				params,
				refresh
			);
		}
		
		function addThumbs(data,prepend) {
			var baseurl = data.upload.baseurl+"/";
			data = data.images;
			var n = data.length;
			var image,thumb,src;
			for (var i=0;i<n;i++) {
				image = data[i];
				if (!image.data) {
					image.data = emtpyData;
				}
				src = image.meta.preview[0];
				//src = baseurl + image.meta.file.replace(/[^\/]*$/, '') + image.meta.sizes.thumbnail.file;
				output[prepend ? "prepend" : "append"](newThumb.format(src,image.ID,editForm.format(image.ID,JSON.stringify(image.data))));
			}
		}
		
		function sortchange(e) {
			sort.attr("checked",false).filter('[value="custom"]').attr("checked",true);
			sort.parent().buttonset("refresh");
		}

		
		
		function refresh(data) {
			output.html("");
			addThumbs(data);
			if (sortable) {
				output.sortable("refresh");
			} else {
				output.sortable({
					forcePlaceholderSize: true, 
					//axis:"x",
					tolerance: "pointer",
					items: '> .pe_thumb',
					cursor: 'move',
					handle: 'img',
					distance: 0,
					//opacity: 0.9,
					//grid: [143,113],
					containment: 'parent',
					placeholder: "pe_thumb ui-state-highlight",
					dropOnEmtpy:true
				});
				output.bind("sortchange",sortchange);
				output.disableSelection();				
			}
			loading = false;
		}
		
		function filesUploaded(e,up,file,response) {
			if (response.response) {
				addThumbs(response.response,true);				
			}
		}
		
		function uploadComplete(e,up,files) {
		}
		
		function addImages(data) {
			reload(data);
			return false;
		}
		
		function getAttachment(attachment) {
			attachment = attachment.toJSON(); 
			return {id:attachment.id,url:attachment.url};
		}
		
		function addImagesFromMedia() {
			workflow.off("select");
			addImages(workflow.state().get('selection').map(getAttachment));
		}
		
		function clickHandler(e) {
			var el = e.currentTarget,action,id;
			switch(el.id) {
			case "pe_collapse":
				collapse.toggle();
				break;
			case "pe_add":
				if (workflow) {
					workflow.on('select',addImagesFromMedia);
					workflow.open();					
				} else {
					window.peQuickImageCallback = addImages;
					tb_show('','media-upload.php?post_id=0&amp;type=image&amp;tab=pe_quick_media&amp;pe_multi&amp;pe_hide=1&amp;TB_iframe=1');					
				}
				break;
			case "pe_save":
				$("#publish").trigger("click");
				break;
			case "pe_reload":
				typeChange();
				break;
			case "pe_edit_data":
				var edit = !editButton.data("edit");
				editButton.data("edit",edit).val(edit ? "Grid" :"Edit");
				output.find(".pe_thumb").toggleClass("edit");
				break;
			case "pe_edit":
				location.href = "upload.php?media-tags=%0".format(tags);
				break;
			default:
				action = el.className;
				id = el.getAttribute("data-id");
				if (action === "delete") {
					$(el).closest(".pe_thumb").detach();
					output.append('<input type="hidden" name="%1" value="%0" />'.format(id,fieldPrefix+"[delete][]"));
				} else {
					Gallery.edit($("#pe_gallery_fields_%0".format(id)));
				}
				break;
			}
			return false;
		}

		
		// init function
		function start() {
			
			if (window.wp && window.wp.media) {
				if (!workflow) {
					
					workflow = wp.media({
						title: 'Select the images',
						multiple: 'add',
						button: { 
							text: 'Add selected images'
						},
						library: {
							type: 'image'
						}
					});
					
					workflow.on("escape",reset);
				}
			}
			
			upload.bind("filesuploaded.pixelentity",filesUploaded);
			upload.bind("uploadcomplete.pixelentity",uploadComplete);
			type.change(typeChange).triggerHandler("change");
		}
		
		function shortcode() {
			return '[%0 type]'.format(conf.tag);
		}

		
		$.extend(this, {
			// plublic API
			//shortcode:shortcode,
			destroy: function() {
				target.data("peMetaboxGallery", null);
				target = undefined;
			}
		});
		
		// initialize
		//start();
		$(start);
	}
	
	// jQuery plugin implementation
	$.fn.peMetaboxGallery = function(conf) {
		
		// return existing instance	
		var api = this.data("peMetaboxGallery");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peMetaboxGallery.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeMetaboxGallery(el, conf);
			el.data("peMetaboxGallery", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));

jQuery(document).ready(function($) {
	$(".pe_mbox_gallery").peMetaboxGallery();
});

