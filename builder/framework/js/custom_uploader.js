jQuery(document).ready(function() {
	var media_frame;
	var formlabel = 0;
	var fileInput = '';
	var fileInput_url = '';
	
 
 jQuery('.upload_image_button').click(function(e) {
     e.preventDefault();
     fileInput = jQuery('#upload_image');
	 fileInput_url  = jQuery('#upload_image_url');
		if ( media_frame ) {
			  media_frame.open();
			  return;
		}
		media_frame = wp.media.frames.media_frame = wp.media({
			  className: 'media-frame new-media-frame',
			  frame: 'select',
			  multiple: false,
			  library: {
			  type: 'image'
			  },
		});
		media_frame.on('select', function(){
			var media_attachment = media_frame.state().get('selection').first().toJSON();
			var new_val = media_attachment.id;
			var str = fileInput.val();
			var cur_val = fileInput.val();
			if(cur_val){fileInput.val(cur_val + "," + new_val);}else{fileInput.val(new_val)}
			
			var new_val_url = media_attachment.url;
			var str_url = fileInput_url.val();
			var cur_val_url = fileInput_url.val();
			if(cur_val_url){fileInput_url.val(cur_val_url + "," + new_val_url);}else{fileInput_url.val(new_val_url)}
			
			jQuery( "#upload_images" ).append( "<div id='image-"+media_attachment.id+"' style='width:200px; height:200px; display:inline-block; margin-right:10px;  background-size: cover;  background-image:url("+media_attachment.url+")'><a href='#' id='"+media_attachment.id+"' data-url='"+media_attachment.url+"' class='remove_image' style='background:#000; display:inline-block; color:#fff; text-decoration:none; padding:5px;'>DELETE</a></div>" )
		});
	
		media_frame.open();
 });
 
	jQuery('#upload_images').on('click', '.remove_image', function() {
		var str = jQuery('#upload_image').val();
		var id = jQuery(this).attr('id');
		var url = jQuery(this).attr('data-url');
		jQuery('#image-'+id).remove();
		arr = str.split(',');
		arr.splice( jQuery.inArray(id, arr), 1 );
		jQuery('#upload_image').val(arr.toString());
		
		var str_url = jQuery('#upload_image_url').val();
		arr_url = str_url.split(',');
		arr_url.splice( jQuery.inArray(url, arr_url), 1 );
		jQuery('#upload_image_url').val(arr_url.toString());
		
		return false;
	});
});