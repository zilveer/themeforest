(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,tb_show,tb_remove,plupload */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldDropUpload = {	
		conf: {
			api: false,
			plupload: {}
		} 
	};
	
	var origSendToEditor;
	
	function PeFieldDropUpload(target, conf) {
		
		var id = target.attr("id");
		var uploader;
		var popup = false;
		var errors = 0;
		
		function dragOver() {
			target.addClass('drag-over');
		}
		
		function dragLeave() {
			target.removeClass('drag-over');
		}

		function init(up) {
			var dragArea = target.find(".pe_drag_drop");
			
			if(up.features.dragdrop){
				target.addClass('drag-drop');
				dragArea
					.bind('dragover.wp-uploader', dragOver)
					.bind('dragleave.wp-uploader, drop.wp-uploader', dragLeave);
				
			} else {
				target.removeClass('drag-drop');
				dragArea.unbind('.wp-uploader');
			}
			
		}
		
		function logger() {
			if (popup) {
				popup.dialog("open");
			} else {
				popup = $('<div id="%0_popup"><div class="pe_theme"><div class="pe_theme_wrap"></div></div></div>'.format(id));
				$("body").append(popup);
				popup.dialog({
					autoOpen: false,
					modal: true,
					width: 600,
					resizable: false,
					draggable: true,
					dialogClass: "wp-dialog pe_dialog",
					title: "Progress",
					position: ["center","center"],
					zIndex: 90,
					close: dialogClosed,
					closeOnEscape: true
				});
				popup.dialog("open");
			}
			
		}
		
		function dialogClosed() {
			popup.find(".pe_theme_wrap").html("");
			errors = 0;
		}

		
		function addLogEntry(id,name,percent) {
			if ($("#%0".format(id)).length > 0) {
				// entry already exists
				return;
			}
			var item = '<div class="pe_info"><span>%0</span><span class="pe_message">%1</span></div>';
			var entry = $('<div id="%0" class="pe_file"></div>'.format(id));
			if (typeof percent === "string") {
				entry.append(item.format(name,percent));
				popup.find(".pe_theme_wrap").append(entry.addClass("ko"));
			} else {
				entry.append(item.format(name,""));
				entry.append('<div id="%0_progress"></div>'.format(id));
				popup.find(".pe_theme_wrap").append(entry);
				$("#%0_progress".format(id)).progressbar({
					value: percent
				});				
			}			
		}
		
		function updateLogEntry(id,loaded,message) {
			var entry = $('#%0'.format(id));
			var bar = $("#%0_progress".format(id));
			if (loaded >= 100) {
				if (message == "uploaded") {
					entry.removeClass("crunch").addClass("ok");
					entry.find(".pe_info .pe_message").html("OK");
				} else if (!entry.hasClass("crunch")) {
					bar.hide();
					entry.addClass("crunch");
					entry.find(".pe_info .pe_message").html("CRUNCHING");
				}
			} else {
				bar.progressbar({
					value: loaded
				});				
			}
			
		}

		
		
		
		function error(up,err) {
			logger();
			errors++;
			addLogEntry(err.file.id,err.file.name,err.message);
			target.triggerHandler("error.pixelentity",[up,err]);
			up.refresh();
		}
		
		function filesAdded(up,files) {
			target.triggerHandler("filesadded.pixelentity",[up,files]);
			logger();
			var file;
			for (var i=0;i<files.length;i++) {
				file = files[i];
				addLogEntry(file.id,file.name,file.percent);
			}
			up.refresh();
			up.start();
		}
		
		function uploadProgress(up,file) {
			target.triggerHandler("uploadprogress.pixelentity",[up,file]);
			updateLogEntry(file.id,file.percent);
		}

		function filesUploaded(up,file,response) {
			updateLogEntry(file.id,file.percent,"uploaded");
			if (response.response) {
				response.response = $.parseJSON(response.response); 
			}
			target.triggerHandler("filesuploaded.pixelentity",[up,file,response]);			
		}
		
		function uploadComplete(up,files) {
			if (errors === 0) {
				popup.dialog("close");
			}
			target.triggerHandler("uploadcomplete.pixelentity",[up,files]);
		}
		
		function start() {
			
			uploader = new plupload.Uploader(conf.plupload);
			// checks if browser supports drag and drop upload, makes some css adjustments if necessary
			uploader.bind('Init', init);
			uploader.init();
			
			//uploader.settings.multipart_params.tag = "Gallery";
			
			uploader.bind("FilesAdded",filesAdded);
			uploader.bind("UploadProgress",uploadProgress);
			uploader.bind('FileUploaded', filesUploaded);
			uploader.bind('UploadComplete', uploadComplete);
			uploader.bind('Error', error);
			
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peFieldDropUpload", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peFieldDropUpload = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldDropUpload");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldDropUpload.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldDropUpload(el, conf);
			el.data("peFieldDropUpload", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));