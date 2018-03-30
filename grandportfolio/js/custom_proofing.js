jQuery(window).load(function(){ 
	jQuery(document).ajaxStart(function() {
	  	jQuery('#gallery_proofing_status').val(1);
	});
	
	jQuery(document).ajaxStop(function() {
	  	jQuery('#gallery_proofing_status').val(0);
	});

	jQuery('.image_approve').click(function(){
		var imgID = jQuery(this).data('image');
		var galleryID = jQuery(this).data('gallery');
		
		if(jQuery('#gallery_proofing_status').val() == 0)
		{
			jQuery('#image'+imgID+'_wrapper').find('.loading').removeClass('hidden');
		
			jQuery.ajax({
		        url: tgAjax.ajaxurl,
		        type:'POST',
		        data: 'action=grandportfolio_image_proofing&method=approve&gallery_id='+galleryID+'&image_id='+imgID+'&tg_security='+tgAjax.ajax_nonce, 
		        success: function(html)
		        {
		 			jQuery('#image'+imgID+'_approve').addClass('hidden');
					jQuery('#image'+imgID+'_unapprove').removeClass('hidden');
					
					jQuery('#image'+imgID+'_wrapper').find('.onapprove').removeClass('hidden');  
					jQuery('#image'+imgID+'_wrapper').find('.loading').addClass('hidden');   
					
					jQuery('body').append(html);
		        }
		    });
		}
	});

	jQuery('.image_unapprove').click(function(){
		var imgID = jQuery(this).data('image');
		var galleryID = jQuery(this).data('gallery');
		
		if(jQuery('#gallery_proofing_status').val() == 0)
		{
			jQuery('#image'+imgID+'_wrapper').find('.loading').removeClass('hidden');
		
			jQuery.ajax({
		        url: tgAjax.ajaxurl,
		        type:'POST',
		        data: 'action=grandportfolio_image_proofing&method=unapprove&gallery_id='+galleryID+'&image_id='+imgID+'&tg_security='+tgAjax.ajax_nonce, 
		        success: function(html)
		        {
		 			jQuery('#image'+imgID+'_approve').removeClass('hidden');
					jQuery('#image'+imgID+'_unapprove').addClass('hidden');
					
					jQuery('#image'+imgID+'_wrapper').find('.onapprove').addClass('hidden');
					jQuery('#image'+imgID+'_wrapper').find('.loading').addClass('hidden');  	
		        }
		    });
		}
	});
});