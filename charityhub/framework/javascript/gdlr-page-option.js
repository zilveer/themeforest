(function($){
	
	// do action when the document is ready
	$(document).ready(function(){
		
		$('#publish, #preview-action a, #save-post').click(function(){

			var page_option = $('.gdlr-page-option-wrapper');
			
			// save each page option to the hidden textarea
			page_option.each(function(){
			
				// jquery object that contains each option value
				var page_option = new Object();
				
				$(this).find('[data-slug]').each(function(){
				
					// input type = text
					if( $(this).attr('type') == 'text' || $(this).attr('type') == 'hidden' ){
						page_option[$(this).attr('data-slug')] = $(this).val();
						
					// input type = checkbox
					}else if( $(this).attr('type') == 'checkbox' ){
						if( $(this).attr('checked') ){
							page_option[$(this).attr('data-slug')] = 'enable';
						}else{
							page_option[$(this).attr('data-slug')] = 'disable'
						}
						
					// input type = radio
					}else if( $(this).attr('type') == 'radio' ){
						if( $(this).attr('checked') ){
							page_option[$(this).attr('data-slug')] = $(this).val();
						}
						
					// input type = combobox
					}else if( $(this).is('select') ){
						page_option[$(this).attr('data-slug')] = $(this).val();
						
					// input type = textarea
					}else if( $(this).is('textarea') ){
						page_option[$(this).attr('data-slug')] = $(this).val();
					}

				});
			
				$(this).children('textarea.gdlr-input-hidden').val(JSON.stringify(page_option));
			});

		});
		
		// load page builder meta
		$('#gdlr-load-demo-wrapper').each(function(){
			var post_id = $(this).attr('data-id');
			var ajax_url = $(this).attr('data-ajax');
			var action = $(this).attr('data-action');	
			
			$(this).children('input[type="button"]').click(function(){
				var button_slug = $(this).attr('data-slug');
				$('body').gdlr_confirm({ success: function(){
					$.ajax({
						type: 'POST',
						url: ajax_url,
						data: {'action': action, 'post_id':post_id , 'slug': button_slug},
						dataType: 'json',
						error: function(a, b, c){
							console.log(a, b, c);
							$('body').gdlr_alert({
								text: '<span class="head">Loading Error</span> Please refresh the page and try this again.', 
								status: 'failed'
							});
						},
						success: function(data){
							location.reload();
						}
					});	
				}});	
			});
		});

	});

})(jQuery);