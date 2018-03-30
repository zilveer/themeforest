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
	
	var isImage = /(^.*\.jpg|jpeg|png|gif|ico*)/gi;
	var getName = /\/([^\/]+)$/;
	var workflow = false;
	
	function reset() {
		workflow.off("select");
	}

	function PeFieldUpload(target, conf) {
		
		
		var id = target.attr("id");
		var previewOn = target.hasClass("pepreview");
		var box;
		var removeButton;
		var button = target.next("input.upload_button");
		if (button.length === 0) {
			button = target.next("a");
		}
				
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
		
		function setValue() {
			workflow.off('select');
			var url = workflow.state().get('selection').map(getAttachment)[0].url;
			if (conf.markup) {
				url = '<img src="'+url+'" />';
			}
			target.val(url);
			target.trigger("change");
			preview();
		}

		function click() {
			workflow.on('select',setValue);
			workflow.open();
			return false;
		}
		
		function remove() {
			target.val("");
			preview();
			return false;
		}
		
		function getAttachment(attachment) {
			return attachment.toJSON();
		}

		// init function
		function start() {
			
			if (!workflow) {
				workflow = wp.media({
					title:    'Select Media',
					multiple:  false,
					library: { type : 'image,video' },
					button : { text : 'Insert Media' }
				});
				
				workflow.on("escape",reset);
			}
						
			button.click(click);
			
			if (previewOn) {
				box = $('<div class="screenshot">').hide();
				removeButton = $('<a href="" class="remove">Remove</a>');
				target.parent().append(box);
				target.blur(preview);
				removeButton.click(remove);
				box.click(click);
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