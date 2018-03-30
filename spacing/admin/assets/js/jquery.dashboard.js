jQuery(document).ready(function() {

	jQuery(".post-type-radios :radio:eq(2)").click(function(){
		jQuery("#external-url").show();
	});
	
	jQuery(".post-type-radios :radio:eq(0),.post-type-radios :radio:eq(1)").click(function(){
		jQuery("#external-url").hide();
	});	
	
	jQuery(".video-post-radios :radio:eq(1)").click(function(){
		jQuery(".video-lightbox-height").show();
	});	
	
	jQuery(".video-post-radios :radio:eq(0)").click(function(){
		jQuery(".video-lightbox-height").hide();
	});	
	
	jQuery(".video-type-radios :radio:eq(2)").click(function(){
		jQuery(".video-file-id").hide();
		jQuery(".video-file-url").show();
	});
	
	jQuery(".video-type-radios :radio:eq(0),.video-type-radios :radio:eq(1)").click(function(){
		jQuery(".video-file-id").show();
		jQuery(".video-file-url").hide();
	});		
	
	if (jQuery(".disable-radio").is(":checked")) {
		jQuery(".to-disable").attr('disabled', '');
		jQuery(".to-check").attr('checked', '');
	}
	
	if (jQuery(".disable-radios").is(":checked")) {
		jQuery(".to-disable").attr('disabled', '');
		jQuery(".to-check").attr('disabled', '');
	}
	
	jQuery(".disable-radio").click(function(){
		jQuery(".to-disable").attr('disabled', '');
		jQuery(".to-check").attr('checked', '');
		jQuery(".to-check").removeAttr('disabled');
	});		
	
	jQuery(".disable-radios").click(function(){
		jQuery(".to-disable").attr('disabled', '');
		jQuery(".to-check").attr('disabled', '');	   
	});	
	
	
	jQuery(".enable-radio").click(function(){
		jQuery(".to-disable").removeAttr('disabled');
	});	
	
	//Masked Inputs (images as radio buttons)
	jQuery('.of-radio-img-img').click(function(){
		jQuery(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		jQuery(this).addClass('of-radio-img-selected');
	});
	jQuery('.of-radio-img-label').hide();
	jQuery('.of-radio-img-img').show();
	jQuery('.of-radio-img-radio').hide();
	
	jQuery(".layout-both").click(function(){
		jQuery(".second-sidebar").show();
	});
	
	jQuery(".layout-other").click(function(){
		jQuery(".second-sidebar").hide();
		jQuery(".primary-sidebar").show();
	});
	
	jQuery(".layout-fullwidth").click(function(){
		jQuery(".second-sidebar").hide();
		jQuery(".primary-sidebar").hide();
	});
	
});