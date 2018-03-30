(function($){
	
	// execute the script when document is ready
	$(document).ready(function(){
	
		// animate the admin menu
		$('#gdlr-admin-nav').each(function(){
			var admin_menu = $(this).children('ul');
			var content_area = $(this).siblings('#gdlr-admin-content').children('.gdlr-content-group');
			
			admin_menu.children('li').click(function(){
				$(this).children('ul').slideDown();
				$(this).siblings('li').children('ul').slideUp();
			})
			
			admin_menu.find('li.admin-sub-menu-list').click(function(){
				admin_menu.find('li.admin-sub-menu-list').removeClass('active');
				$(this).addClass('active');
				
				var selected_id = $(this).attr('data-id');
				content_area.children('.gdlr-content-section').css('display', 'none');
				content_area.children('#' + selected_id).fadeIn();
			});
		});
		
		// save admin menu
		$('#gdlr-admin-form').submit(function(){
			var admin_form = $(this);
		
			var ajax_url = admin_form.attr('data-ajax');
			var nonce = admin_form.attr('data-security');
			var action = admin_form.attr('data-action');

			$.ajax({
				type: 'POST',
				url: ajax_url,
				data: { 'security': nonce, 'action': action, 'option': jQuery(this).serialize() },
				dataType: 'json',
				beforeSend: function(){
					admin_form.find('.now-loading').animate({'opacity': 1}, 300);
				},
				error: function(a, b, c){
					console.log(a, b, c);
					$('body').gdlr_alert({
						text: '<span class="head">Sending Error</span> Please refresh the page and try this again.', 
						status: 'failed'
					});
				},
				success: function(data){
					$('body').gdlr_alert({text: data.message, status: data.status, duration: 1500});
				},
				complete: function(data){
					admin_form.find('.now-loading').animate({'opacity': 0}, 300);
				}
				
			});
			
			return false;
		});
		
		// export option
		$('#gdlr-export').click(function(){
			$(this).siblings('textarea').html($('#gdlr-admin-form').serialize());
		});
		
		// import option
		$('#gdlr-import').click(function(){
			var data = $(this).siblings('textarea').val();	
			if( data ){
				var admin_form = $('#gdlr-admin-form');
				var ajax_url = admin_form.attr('data-ajax');
				var nonce = admin_form.attr('data-security');
				var action = admin_form.attr('data-action');	

				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: { 'security': nonce, 'action': action, 'option': data },
					dataType: 'json',
					beforeSend: function(){
						admin_form.find('.now-loading').animate({'opacity': 1}, 300);
					},
					error: function(a, b, c){
						console.log(a, b, c);
						$('body').gdlr_alert({
							text: '<span class="head">Importing Error</span> Please make sure that the data is corrected.', 
							status: 'failed'
						});
					},
					success: function(data){
						location.reload();
					}
					
				});

			}else{
				$('body').gdlr_alert({'text': 'Please fill the exported data in the textarea.'});
			}
			
		});
	});

})(jQuery);