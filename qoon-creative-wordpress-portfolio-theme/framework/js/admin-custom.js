jQuery.noConflict()(function($){
	$('*[id^="oi_p_"]').hide();
	$("#oi_p_"+$('#oi_ps').val() ).show();
	$('#oi_ps').change(function() {
		$('*[id^="oi_p_"]').hide();
		$("#oi_p_"+$(this).val() ).show();
	});
	
	$('*[id^="oi_admin_for_"]').hide();
	$('input[name=post_format]').each(function() {
		if ($(this).val()=='gallery'){
			arr = $('#upload_image.image').val().split(',');
			arr_url = $('#upload_image_url.image').val().split(',');
			console.log(arr_url);
			jQuery.each(arr, function(element) {
				if(this != ''){
					jQuery( "#upload_images.image" ).append( "<div id='image-"+this+"' style='width:200px; height:200px; display:inline-block; margin-right:10px;  background-size: cover;  background-image:url("+arr_url[element]+")'><a href='#' id='"+this+"' data-url='"+arr_url[element]+"' class='remove_image' style='background:#000; display:inline-block; color:#fff; text-decoration:none; padding:5px;'>DELETE</a></div>" )
				};
			});
			
			arr = $('#upload_image.image_fp').val().split(',');
			arr_url = $('#upload_image_url.image_fp').val().split(',');
			console.log(arr_url);
			jQuery.each(arr, function(element) {
				if(this != ''){
					jQuery( "#upload_images.image_fp" ).append( "<div id='image-"+this+"' style='width:200px; height:200px; display:inline-block; margin-right:10px;  background-size: cover;  background-image:url("+arr_url[element]+")'><a href='#' id='"+this+"' data-url='"+arr_url[element]+"' class='remove_image' style='background:#000; display:inline-block; color:#fff; text-decoration:none; padding:5px;'>DELETE</a></div>" )
				};
			});
			
		};
		if($(this).attr('checked') == 'checked'){
			$("#oi_admin_for_"+$(this).val() ).show();
		};
	});

	$('input[name=post_format]').each(function() {
		$(this).bind(
			"click",
			function() {
				$('*[id^="oi_admin_for_"]').hide();
				$("#oi_admin_for_"+$(this).val() ).show();
			});
	  });
	  
	
});
