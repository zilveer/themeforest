jQuery(document).ready(function() {
	
	/*reset inputs when page is reloaded*/
	resetBoxSettings();
	
	jQuery('#box_type').change(function() {
		jQuery('#box_sample h5 span').attr('class','icon-'+ jQuery(this).val());
        jQuery('p#box_sample').attr('class','cosmo-box '+ jQuery(this).val());
	});
	
	
	jQuery('#box_text_size').change(function() {
		jQuery('#box_sample').css('font-size',jQuery(this).val());
	});

    jQuery('#box_color , #box_style').change(function() {
        jQuery( 'option' , this ).each(function(){
            var $div_fr = jQuery('#box_sample div.fr');
            var classname = jQuery( this ).attr( 'value' );
            if( $div_fr.hasClass( classname ) ){
                $div_fr.removeClass( classname );
            }
        });

		jQuery('#box_sample div.fr').addClass( jQuery( this ) . val() );
	});



    var title;
    var content;
    var rtitle;
    var rcontent;
    var url;
    var color;
    var style;

    var result;

	jQuery('.box-text').keyup(function() {
        result = '';
        var rdescription;
        if( jQuery('#box_title').val() == '' ){
            title = 'Box title';
        }else{
            title = jQuery('#box_title').val();
        }

		if( jQuery('#box_content').val() == '' ){
            content = 'Box content';
		}else{
			content = jQuery('#box_content').val();
		}

        if( jQuery('#box_right_title').val() == '' ){
            rtitle = 'Box Right Title';
		}else{
			rtitle = jQuery('#box_right_title').val();
		}

        if( jQuery('#box_right_description').val() == '' ){
            rdescription = 'Box Right Description';
		}else{
			rdescription = jQuery('#box_right_description').val();
		}

        if( jQuery('#box_url').val() == '' ){
            url = '';
		}else{
			url = jQuery('#box_url').val();
		}

                
        result += '<div class="fl">';
        //result += '<span class="cosmo-ico"></span>';
        result += '<h5><span class="icon-'+jQuery('#box_type').val()+'"></span>' + title + '</h5>';
        result += '<p>' + content + '</p>';
        result += '</div>';
        result += '<div class="fr ">';
        result += '<a href="' + url + '">' + rtitle + '<span class="desc">' + rdescription + '</span><a>';
        result += '</div>';

        jQuery('#box_sample').html( result );
	});
	
});

function insertBox(){
    var title;
    var rtitle;
    var	result = '[box type="'+jQuery('#box_type').val()+'" size="'+jQuery('#box_text_size').val()+'"';
    var content;
    var url;

    if( jQuery('#box_title').val() == '' ){
        title = 'Box title';
    }else{
        title = jQuery('#box_title').val();
    }

    if( jQuery('#box_content').val() == '' ){
        content = 'Box content';
    }else{
        content = jQuery('#box_content').val();
    }

    if( jQuery('#box_right_title').val() == '' ){
        rtitle = 'Box Right Title';
    }else{
        rtitle = jQuery('#box_right_title').val();
    }

    if( jQuery('#box_right_description').val() == '' ){
        rdescription = 'Box Right Description';
    }else{
        rdescription = jQuery('#box_right_description').val();
    }

    if( jQuery('#box_url').val() == '' ){
        url = '';
    }else{
        url = jQuery('#box_url').val();
    }

    result += ' title="' + title + '" right_title="' + rtitle + '" right_description="' + rdescription + '" url="' + url + '" ]' + content + '[/box]';
	
	Editor.AddText( "content" , "\n" + result + "\n");
	showNotify();
}

function resetBoxSettings(){
	jQuery('#box_content').val('');
	jQuery('#box_type option:first').prop('selected','selected');
	jQuery('#box_size option:first').prop('selected','selected');
	jQuery('#box_sample').prop('class','cosmo-box default');
	jQuery('#box_sample').html( '<span class="cosmo-ico"></span>'+'Box content.' );
}