jQuery(document).ready(function(){
	/* attach event to  page attributes changed */ 
    if(jQuery("select#page_template").length > 0 ){
        jQuery( "select#page_template" ).on( "change", function() {
            if( jQuery.trim(jQuery( this ).find('option:selected').html()) == 'Portfolio Template'){
                jQuery("#page_config li.hide_portfolio").hide();
            } else {
                jQuery("#page_config li.hide_portfolio").show();
            }
        });
    }
	/* attach event to  page attributes changed */ 
    if(jQuery("select#page_template").length > 0 ){
        jQuery( "select#page_template" ).on( "change", function() {
			var option = jQuery.trim(jQuery( this ).find('option:selected').html());
			jQuery("#page_config ul.page_config_list li").show();
            if( option == 'Contact Template' || option == 'Sitemap Template' || option == 'Archive Template'){
                jQuery("#page_config").hide();
            } else if( option == 'Blog Template' || option == 'Portfolio Template'){
				jQuery("#page_config").show();
				jQuery("li.sub_layout").hide();
			} else if( option == 'Fullwidth Template' ){
				jQuery("#page_config").show();
				jQuery('select[name="page_layout"]').closest('li').hide();
				jQuery('select[name="page_column"]').closest('li').hide();
			}
			else {
                jQuery("#page_config").show();
				jQuery("li.sub_layout").show();
            }
			
        });
		
		jQuery( "select#page_template" ).trigger('change');
    }
	if(jQuery("select#page_layout").length > 0 ){
        jQuery( "select#page_layout" ).on( "change", function() {
            if( jQuery.trim(jQuery( this ).find('option:selected').html()) == 'Wide'){
				var option = jQuery.trim(jQuery( "select#page_template" ).find('option:selected').html());
				if( option != 'Blog Template' && option != 'Portfolio Template'){
					jQuery("li.sub_layout select").each(function(index, element){
                        jQuery(element).val(jQuery(element).find("option").eq(0).val());
                    });
					jQuery("li.sub_layout").show();
				}
            } else {
                jQuery("li.sub_layout").hide();
            }
        });
    }
	
	/* Post Gallery */
	var file_frame;
	var _this_button;
	jQuery('.post_gallery_wrapper .add_images').bind('click', function(){
		_this_button = jQuery(this);
        event.preventDefault();
			 
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        var _states = [new wp.media.controller.Library({
            filterable: 'uploaded',
            title: 'Select Images',
            multiple: true,
            priority:  20
        })];
			 
        file_frame = wp.media.frames.file_frame = wp.media({
            states: _states,
            button: {
                text: 'Insert URL'
            }
        });

        file_frame.on( 'select', function() {
			var curent_ids = _this_button.siblings('.attachment_ids').val();
			
			var object = file_frame.state().get('selection').toJSON();
			var ids = '';
			var img_html = '';
			if( object.length > 0 ){
				for( i = 0; i < object.length; i++ ){
					if( curent_ids.indexOf(object[i].id) === -1 ){ /* Not exists */
						ids += object[i].id+',';
						img_html += '<li class="image"><span class="del_image"></span><img src="'+object[i].url+'" alt="" data-id="'+object[i].id+'"/></li>';
					}
				}
			}
			
			if( curent_ids!='' ){
				ids = curent_ids +','+ ids;
			}
			
			if( ids.length > 0 ){
				ids = ids.substr(0, ids.length - 1);
			}
			
			_this_button.siblings('.post_gallery_wrapper_inner').find('.post_gallery_list').append(img_html);
			_this_button.siblings('.attachment_ids').val(ids);
			
        });
		 
        file_frame.open();
	});
	
	jQuery('.post_gallery_wrapper .del_image').live('click', function(){
		var item = jQuery(this).parent('.image');
		var id = item.find('img').attr('data-id');
		item.hide(300, function(){item.remove();});
		var container = jQuery(this).parents('.post_gallery_wrapper');
		var ids = container.find('.attachment_ids').val();
		ids = ids.replace(id, '');
		ids = ids.replace(',,', ',');
		if( ids.length > 0 && ids.substr(-1) == ',' ){
			ids = ids.substr(0, ids.length - 1);
		}
		if( ids.length > 0 && ids.substr(0, 1) == ',' ){
			ids = ids.substr(1, ids.length - 1);
		}
		container.find('.attachment_ids').val(ids);
	});
	
	
});