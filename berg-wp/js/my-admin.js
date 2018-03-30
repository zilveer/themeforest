(function($){
	"use strict";
	$(document).ready(function() {
			$('.remove-this-row').parent().parent().parent('tr').addClass('hide-important');
	});
})(jQuery);


(function( $ ) {
	"use strict";
	$(document).ready(function() {
		$('.add-collection-img-button').each(function(){
			var that = $(this);
			if(that.hasClass('widget-ready')) {
				return;
			} else {
				that.addClass('widget-ready');
			}
			that.on('click', function(){
				var img_frame;
				if (img_frame !== undefined) {
					img_frame.open();
					return;
				}

				img_frame = wp.media({
					multiple: false,
				});

				img_frame.on('select', function() {
					if(that.parent().find('.img-form').val() !== '') {
						that.parent().find('.img-form').val('');
						
						that.parent().find('.upload-img-id').remove();
					}
					
					var attachment = img_frame.state().get('selection').first();
					img_frame.close();
					var imgId = attachment.id;
					var imgURL = attachment.attributes.url;

					that.parent().find('.upload-img').attr('src',imgURL);
					that.parent().find('img').removeClass('hidden');
					that.parent().find('.delete-collection-img').removeClass('hidden');
					that.parent().find('.img-form').val(imgId);
				});

				img_frame.open();
			});
		});
		$('.delete-collection-img').each(function(){
			var that = $(this);
			if(that.hasClass('widget-ready')) {
				return;
				
			} else {
				that.addClass('widget-ready');
			}
			that.on('click', function(){
				that.parent().find('.img-form').val('');
				that.parent().find('.upload-img-id').remove();
				that.parent().find('img').addClass('hidden');
				that.addClass('hidden');
			});
		});
	});
})( jQuery );