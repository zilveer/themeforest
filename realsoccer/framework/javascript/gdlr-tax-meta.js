(function($){
	$(document).ready(function(){

		// animate upload button
		$('.gdlr-option-input .gdlr-upload-box-input').change(function(){		
			$(this).siblings('.gdlr-upload-box-hidden').val($(this).val());
			if( $(this).val() == '' ){ 
				$(this).siblings('.gdlr-upload-img-sample').hide(); 
			}else{
				$(this).siblings('.gdlr-upload-img-sample').attr('src', $(this).val()).removeClass('blank');
			}
		});
		$('.gdlr-upload-media').click(function(){
			var upload_button = $(this);
		
			var custom_uploader = wp.media({
				title: upload_button.attr('data-title'),
				button: { text: upload_button.attr('data-button') },
				library : { type : 'image' },
				multiple: false
			}).on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				
				upload_button.siblings('.gdlr-preview').attr('src', attachment.url).show();
				upload_button.siblings('.gdlr-upload-box-input').val(attachment.url);
				upload_button.siblings('.gdlr-upload-box-hidden').val(attachment.id);
			}).open();			
		});	
		
		// datepicker
		$('.gdlr-date-picker').datepicker({
			dateFormat : 'yy-mm-dd'
		});		
	
	});
})(jQuery);