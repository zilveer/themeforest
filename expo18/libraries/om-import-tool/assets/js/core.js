jQuery(function($){
	
	var attachments_per_query=3;
	
	$('.om_import_tool_start').click(function(e){
		e.preventDefault();
		
		$('.om_import_tool_start').unbind('click').attr('disabled','disabled');
		
		var import_attachments=$(this).data('import-attachments');
		
		$('#om_import_status').show();
		
		if(import_attachments) {
			
			$('#om_import_status_text').html('Importing media files...');
			
			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: {
					action: 'om_import_tool',
					om_action: 'start'
				},
				dataType: 'json'
			}).success(function(data){
			
				if(data.attachments) {
					var start_from=parseInt(data['last_attachment_index']) + 1;
					om_process_attachments(data, start_from, om_process_other);
				} else {
					om_process_other();
				}
				
			});
			
		} else {
			om_process_other();
		}
	});
	
	function om_process_attachments(data, start_from, finished_callback) {

		if(start_from < data.attachments.length) {
			
			$('#om_import_progress').show();
			var w=start_from > 0 ? start_from / data.attachments.length : 0;
			w*=100;
			$('#om_import_progress_bar').css('width', w + '%' );
			$('#om_import_progress_text').html(start_from + ' / ' + data.attachments.length);
			
			var last=start_from + attachments_per_query;
			if(last > data.attachments.length)
				last=data.attachments.length;
			var	attachments=data.attachments.slice(start_from, last);
			if(attachments.length) {
				
				$.ajax({
					type: "POST",
					url: ajaxurl,
					data: {
						action: 'om_import_tool',
						om_action: 'process_attachments',
						data: {
							common: data.common,
							attachments: attachments,
							first_attachment_index: start_from
						}
					},
					dataType: 'json'
				}).success(function(){
					om_process_attachments(data, start_from + attachments_per_query, finished_callback);
				});
				
			}
			
		} else {
			$('#om_import_progress').hide();
			
			finished_callback();
		}
		
	}
	
	function om_process_other() {
		
		$('#om_import_status_text').html('Importing posts, pages, menus, etc...');
		
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
				action: 'om_import_tool',
				om_action: 'process_other'
			},
			dataType: 'json'
		}).success(function(data){
			if(data.error == 0) {
				document.location=document.location+'&import_completed=true';
			} else {
				$('#om_import_status_text').html('An error has occured');
				$('#om_import_spinner').hide();
			}
		});
	}
		
});