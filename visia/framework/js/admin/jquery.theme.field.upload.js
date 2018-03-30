(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global wp,jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,tb_show,tb_remove */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldUpload = {	
		conf: {
			api: false,
			markup: false,
			text: 'Add to Option'
		} 
	};
	
	var origSendToEditor;
	var mediaUploader = false;
	
	function killTheDamnUnloadEvent(e) {
		if (e.type != "tb_unload") {
			e.stopPropagation();
			e.stopImmediatePropagation();			
		}
		window.send_to_editor = origSendToEditor;
		return false;
	}
	
	
	var isImage = /(^.*\.jpg|jpeg|png|gif|ico*)/gi;
	var getName = /\/([^\/]+)$/;
	
	function PeFieldUpload(target, conf) {
		
		var id = target.attr("id");
		var previewOn = target.hasClass("pepreview");
		var box;
		var removeButton;
		var button = target.next("input.upload_button");
		if (button.length === 0) {
			button = target.next("a");
		}
		var tbframe_interval = 0;
				
		function preview() {
			if (!previewOn) {
				return;
			}
			var value = target.val();
			if (!value) {
				box.hide();
				return;
			}

			var content;
			var name;
			var image = true;
			if (value.match(isImage)) {
				content = '<img src="'+value+'" alt="" />';
			} else {
				image = false;
				name = value.match(getName);
				name = name ? name[1] : value;
				content = '<a href="'+value+'">'+name+'</a>';
				content = '<div class="no_image">'+content+'</div>';
			}
			removeButton.detach();
			box.html(content);
			if (image) {
				box.append(removeButton);
			} else {
				box.find("div").append(removeButton);
			}
			box.show();
		}
		
		function setValue(url) {
			if (mediaUploader) {
				mediaUploader.send.attachment = origSendToEditor;
			} else {
				clearInterval(tbframe_interval);
				tb_remove();
				window.send_to_editor = origSendToEditor;
				window.peQuickImageCallback = false;
			}
			if (conf.markup) {
				url = '<img src="'+url+'" />';
			}
			target.val(url);
			target.triggerHandler("change");
			preview();
		}

		
		function mediaUploaderSend(props,attachment) {
			//console.log(props,attachment);
			setValue(attachment.url);
		}
		
		function sendToEditor(html) {
			window.send_to_editor = origSendToEditor;
			html = $(html);
			var url = html.find("img").attr("src");
			url = url ? url : html.attr("href");
			setValue(url);
			return false;
		}
		
		function getFromQuickImage(data) {
			setValue(data.url);
		}
		
		function message() {
			jQuery('#TB_iframeContent').contents().find('.savesend .button').val(conf.text);
			return false;
		}	
		
		function reset() {
			this.off("escape insert",reset);
			wp.media.editor.send.attachment = origSendToEditor;
		}
		
		function click() {
			if (mediaUploader) {
				// set our own function
				mediaUploader.send.attachment = mediaUploaderSend;
				var view = mediaUploader.open("myinstance");
				view.on("escape insert",reset,view);
			} else {
				tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=1');
				// prevent "unload" event from firing when tb_window is closed
				$("#TB_window,#TB_overlay,#TB_HideSelect").one("unload tb_unload",killTheDamnUnloadEvent);
				tbframe_interval = setInterval(message,2000);
				window.send_to_editor = sendToEditor;
				window.peQuickImageCallback = getFromQuickImage;	
			}
			return false;
		}
		
		function remove() {
			target.val("");
			preview();
			return false;
		}
		
		// init function
		function start() {
			
			try {
				mediaUploader = window.wp.media.editor;
				origSendToEditor = mediaUploader.send.attachment;
			} catch (e) {
				origSendToEditor = window.send_to_editor;
				mediaUploader = false;
			}
			
			button.click(click);
			if (previewOn) {
				box = $('<div class="screenshot">').hide();
				removeButton = $('<a href="" class="remove">Remove</a>');
				target.parent().append(box);
				target.blur(preview);
				removeButton.click(remove);
			}
			preview();
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peFieldUpload", null);
				target = undefined;
			}
		});
		
		// initialize
		$(start);
		//start();
	}
	
	// jQuery plugin implementation
	$.fn.peFieldUpload = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldUpload");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldUpload.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldUpload(el, conf);
			el.data("peFieldUpload", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));