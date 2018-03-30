jQuery(document).ready(function() {
		jQuery('html, body').animate({scrollTop:0},0);	
		jQuery('#predef_bg_wrapper a').click(function(event) {
		  event.preventDefault();
		});
		jQuery('#predef_bg_wrapper a').imgPreview({
			containerID: 'imgPreviewWithStyles',
			imgCSS: { width: 400 },
			preloadImages: false,
			containerLoadingClass :'imgPreviewLoading'
		});
		jQuery('#duotive-admin-panel img.hint-icon[title]').tooltip({ 'effect':'slide', 'offset':[-9, 0],'layout': '<div><span class="arrow"></span></div>'});									 
        jQuery('#dt_primaryColor,#dt_secondayColor,#dt_generalBackgroundColor').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                jQuery(el).val(hex);
                jQuery(el).ColorPickerHide();
            },
                onBeforeShow: function () {
                    jQuery(this).ColorPickerSetColor(this.value);
                }
            })
            .bind('keyup', function(){
            jQuery(this).ColorPickerSetColor(this.value);
        });
		jQuery("#general-settings div.table-row:even").addClass('table-row-alternative');
		jQuery("#single-settings div.table-row:even").addClass('table-row-alternative');
		jQuery("#single-project-settings div.table-row:even").addClass('table-row-alternative');				
		jQuery("#header-settings div.table-row:even").addClass('table-row-alternative');
		jQuery("#advanced-settings div.table-row:even").addClass('table-row-alternative');		
		jQuery("#footer-settings div.table-row:even").addClass('table-row-alternative');		
    	jQuery('#general-settings .table-row-last').prev('div').addClass('table-row-beforelast');
    	jQuery('#single-settings .table-row-last').prev('div').addClass('table-row-beforelast');
    	jQuery('#single-project-settings .table-row-last').prev('div').addClass('table-row-beforelast');				
    	jQuery('#header-settings .table-row-last').prev('div').addClass('table-row-beforelast');
    	jQuery('#advanced-settings .table-row-last').prev('div').addClass('table-row-beforelast');		
    	jQuery('#footer-settings .table-row-last').prev('div').addClass('table-row-beforelast');		
      	jQuery(".transform").jqTransform();
        jQuery("#duotive-admin-panel" ).tabs();
		
		jQuery('#dt_headerLogo_button').click(function() {
			 formfield = jQuery('#dt_headerLogo').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add-logo';			 
			 return false;
		});
		jQuery('#dt_FooterLogo_button').click(function() {
			 formfield = jQuery('#dt_FooterLogo').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add-footer-logo';			 
			 return false;
		});
		jQuery('#dt_favicon_button').click(function() {
			 formfield = jQuery('#dt_favicon').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add-dt_favicon';			 
			 return false;
		});	
		jQuery('#dt_generalBackground_button').click(function() {
			 formfield = jQuery('#dt_generalBackground').attr('name');
			 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			 destination = 'add-background';			 
			 return false;
		});				
		window.send_to_editor = function(html) {
			switch(destination)
			{ 
				case 'add-background':
					imgurl2 = jQuery('img',html).attr('src');
					jQuery('#dt_generalBackground').val(imgurl2);
				break;				
				case 'add-dt_favicon':
					imgurl2 = jQuery('img',html).attr('src');
					jQuery('#dt_favicon').val(imgurl2);
				break;			
				case 'add-logo':
					imgurl2 = jQuery('img',html).attr('src');
					jQuery('#dt_headerLogo').val(imgurl2);
				break;
				case 'add-footer-logo':
					imgurl2 = jQuery('img',html).attr('src');
					jQuery('#dt_FooterLogo').val(imgurl2);
				break;				
			}
			tb_remove();
		}
		
		jQuery( "#dt_headerLogoverticalslider" ).slider({
			range: 'min',
			value:jQuery( "#dt_headerLogovertical" ).val(),
			min: -30,
			max: 30,
			step: 1,
			slide: function( event, ui ) {
				jQuery( "#dt_headerLogovertical" ).val( ui.value );
			}
		});
		jQuery( "#dt_headerLogovertical" ).val(jQuery( "#dt_headerLogoverticalslider" ).slider( "value" ) );
		
		jQuery( "#dt_headerLogohorizontalslider" ).slider({
			range: 'min',
			value:jQuery( "#dt_headerLogohorizontal" ).val(),
			min: -30,
			max: 30,
			step: 1,
			slide: function( event, ui ) {
				jQuery( "#dt_headerLogohorizontal" ).val( ui.value );
			}
		});
		jQuery( "#dt_headerLogohorizontal" ).val(jQuery( "#dt_headerLogohorizontalslider" ).slider( "value" ) );	
		
		jQuery('.predef-color').click(function() {
			jQuery('.predef-color').removeClass('predef-color-active');
			jQuery(this).addClass('predef-color-active');
			jQuery('#dt_primaryColor').val(jQuery(this).attr('data-dtPrimaryColor'));
			jQuery('#dt_secondayColor').val(jQuery(this).attr('data-dtSecondaryColor'));		
			jQuery('#general-settings form').submit();
		});	
		
		jQuery('#predef_bg_wrapper .preview').click(function() {
			jQuery('#dt_predefinedBackground').val(jQuery(this).attr('data-id'));
			jQuery('#background-settings form').submit();
		});;
}); 

jQuery(document).ready(function($) {
	jQuery(window).bind("load", function() {
		if ( window.location.hash ) 
		{
			var target_offset = jQuery(window.location.hash).offset();
			var target_top = target_offset.top;
			jQuery('html, body').animate({scrollTop:target_top}, 500);	
		}
	});
});