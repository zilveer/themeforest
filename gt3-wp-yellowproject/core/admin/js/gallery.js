(function($){
	$(function(){
		// ---
		if (typeof post_id != 'undefined'){
			$('.add_image_popup').colorbox({
				href: 'media-upload.php?post_id=' + post_id + '&type=image&pg=gallery',
				iframe: true,
				innerWidth: 660,
				innerHeight: 500,
				onClosed: function(){
					$.post(ajaxurl, {
						action: 'mix_ajax_gallery_action',
						type: 'get_images',
						id: post_id
					}, function(data){
						$('.post_gallery_images').html(data);
					}, 'text');
				}
			});
			
			$('.sort_images_popup').colorbox({
				href: 'media-upload.php?post_id=' + post_id + '&tab=gallery&pg=sort',
				iframe: true,
				innerWidth: 660,
				innerHeight: 500,
				onClosed: function(){
					$.post(ajaxurl, {
						action: 'mix_ajax_gallery_action',
						type: 'get_images',
						id: post_id
					}, function(data){
						$('.post_gallery_images').html(data);
					}, 'text');
				}
			});
		};
		
		$('.post_gallery_images').delegate('.gi_delete', 'click', function(){
			var $this = $(this),
				id = $this.data('id');
			if (!confirm('Delete this image?')) {
				return false;
			};
			
			$.post(ajaxurl, {
				action: 'mix_ajax_gallery_action',
				type: 'image_delete',
				id: id
			}, function(data){
				$this.parent().remove();
			}, 'json');
		});
		// ---
	});
})(jQuery);
