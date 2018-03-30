jQuery(document).ready(function() {
	var fileInput = '';
	jQuery('.upload_image_button').click(function() {
		fileInput = jQuery(this).parent().prev('input.uploadfield');
		formfield = jQuery('#upload_image').attr('name');
		post_id = jQuery('#post_ID').val();
		tb_show('', 'media-upload.php?post_ID=0&type=image&TB_iframe=true');
		return false;
	});
	jQuery('.upload_image_reset').click(function() {
		jQuery(this).parent().prev('input.uploadfield').val('');
	});
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){

		if (fileInput) {
			fileurl = jQuery('img',html).attr('src');
			fileInput.val(fileurl);
			tb_remove();
		} else {
			window.original_send_to_editor(html);
		}};
		
	jQuery("select.jq_select").sb();
	
	jQuery("#options-save, #options-reset").css({
		opacity: 1
    });
	
    jQuery("#options-save, #options-reset").hover(function() {
	jQuery(this).stop().animate({
		opacity: 0.7
	}, 100);
    },function() {
	jQuery(this).stop().animate({
		opacity: 1
	}, 300);
    });	
	
	jQuery(".tip").tipTip({maxWidth: "auto", edgeOffset: 10});
	
    });