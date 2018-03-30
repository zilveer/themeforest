var theme = {
	uploaderInit : function(){
		jQuery('.theme-upload-button').each(function(){

		});
	},

        optionSuperlink : function() {
                var wrap = jQuery(".superlink-wrap");
                wrap.each(function(){
                        var field = jQuery(this).siblings('input:hidden');
                        var selector = jQuery(this).siblings('select');
                        var name = field.attr('name');
                        var items = jQuery(this).children();
                        selector.change(function(){
                                items.hide();
                                jQuery("#"+name+"_"+jQuery(this).val()).show();
                                field.val('');
                        });
                        items.change(function(){
                                field.val(selector.val()+'||'+jQuery(this).val());
                        })
                })


        },
	themeOptionGetImage : function(attachment_id){

		jQuery.post(ajaxurl, {
			action:'theme-option-get-image',
			id: attachment_id,
			cookie: encodeURIComponent(document.cookie)
		}, function(src){
			if ( src == '0' ) {
				alert( 'Could not use this image. Try a different attachment.' );
			} else {
				
				var target=jQuery(".add").attr("id");
							
				jQuery("#"+target).val(src);
				
				jQuery("#"+target+"_preview").html('<a class="thickbox" href="'+src+'?"><img src="'+src+'"/></a>');
				
				
				
			}
		});
	}
}

jQuery(document).ready( function($) {
	jQuery('.meta-box-item a.switch').click(function(event){
		jQuery(this).parent().siblings('.description').toggle();
		
		event.preventDefault();
	});
	theme.uploaderInit();
	theme.optionSuperlink();
	
	
	
	
});
