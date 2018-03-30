(function($){
	
	$.fn.gdlrAddSidebar = function(options){

        var settings = $.extend({
			title: 'Create New Sidebar',
			nonce: '',
			ajax: '',
			action: ''
        }, options);	

		var gdlr_form = $(' <form action="#" > \
								<input type="text" name="sidebar-name" /> \
								<input type="submit" value="+" /> \
							</form>');
		
		var gdlr_object = $('<div class="gdlr-sidebar-generator" id="gdlr-sidebar-generator"></div>');
		gdlr_object.append('<span class="gdlr-title">' + settings.title + '</span>');
		gdlr_object.append(gdlr_form);

		$(this).append('<div class="clear" style="height: 15px;" ></div>');
		$(this).append(gdlr_object);
		
		gdlr_form.submit(function(){
			
			// check if the name is empty
			var sidebar_name = $(this).children('input[name="sidebar-name"]').val();
			if( sidebar_name.length <= 0 ){ 

				$('body').gdlr_alert({
					text: '<span class="head">Sidebar Name Is Blank</span>', 
					status: 'failed',
					duration: 1000
				});			
				return false; 
			}
			
			// if not empty add the new sidebar to the theme
			$.ajax({
				type: 'POST',
				url: settings.ajax,
				data: { 'security': settings.nonce, 'action': settings.action, 'sidebar_name': sidebar_name  },
				dataType: 'json',
				error: function(a, b, c){
					console.log(a, b, c);
					$('body').gdlr_alert({
						text: '<span class="head">Sending Error</span> Please refresh the page and try this again.', 
						status: 'failed'
					});
				},
				success: function(data){
					if( data.status == 'success' ){
						location.reload();
					}else if( data.status == 'failed' ){
						$('body').gdlr_alert({
							text: data.message, 
							status: data.status
						});					
					}
				},
				
			});		
			
			return false;
		});		
		
	};
	
	// add and bind the delete sidebar button
	$.fn.gdlrDeleteSidebar = function(options){
        var settings = $.extend({
			nonce: '',
			ajax: '',
			action: ''
        }, options);	
		
		var delete_button = $('<div class="delete-sidebar-button"></div>');
		var widget_right = $(this);
		
		delete_button.click(function(){

			var current_widget = $(this).parents('.sidebar-gdlr-dynamic');
			var sidebar_name = $(this).siblings('h3, h2').html();			
			
			// create confirm button
			$('body').gdlr_confirm({ 
				
				success: function(){
					
					// execute ajax command after user confirm the action
					$.ajax({
						type: 'POST',
						url: settings.ajax,
						data: { 'security': settings.nonce, 'action': settings.action, 'sidebar_name': sidebar_name },
						dataType: 'json',
						error: function(a, b, c){
							console.log(a, b, c);
							$('body').gdlr_alert({
								text: '<span class="head">Deleting Error</span> Please refresh the page and try this again.', 
								status: 'failed'
							});
						},
						success: function(data){
							if( data.status == 'success' ){
								current_widget.slideUp(function(){
								
									$(this).find('.widget-control-remove').trigger('click')
									$(this).remove();
									
									widget_right.find('.widgets-holder-wrap .widgets-sortables').each(function(i){
										$(this).attr('id','sidebar-' + (i + 1));
									});
									
									wpWidgets.saveOrder();							
								});
							}else if( data.status == 'failed' ){
								$('body').gdlr_alert({
									text: data.message, 
									status: data.status
								});					
							}
						},
						
					}); // ajax
					
				} // success
			});
			
			return false;
		});
		
		$(this).find('.sidebar-gdlr-dynamic .sidebar-name').append(delete_button);

	}
	
	// execute the script when document is ready
	$(document).ready(function(){
	
		// bind the add sidebar function
		$('#widgets-right').gdlrAddSidebar({
			title: gdlr_title,
			nonce: gdlr_nonce,
			ajax: gdlr_ajax,
			action: 'gdlr_add_sidebar'
		});
		
		// bind the delete sidebar function
		$('#widgets-right').gdlrDeleteSidebar({
			nonce: gdlr_nonce,
			ajax: gdlr_ajax,
			action: 'gdlr_remove_sidebar'		
		});
	});

})(jQuery);