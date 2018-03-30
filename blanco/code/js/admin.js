jQuery(document).ready(function(){

	/* Promo banner in admin panel */
	
	jQuery('.promo-text-wrapper .close-btn').click(function(){
		
		var confirmIt = confirm('Are you sure?');
		
		if(!confirmIt) return;
		
		var widgetBlock = jQuery(this).parent();
	
		var data =  {
			'action':'et_close_promo',
			'close': widgetBlock.attr('data-etag')
		};
		
		widgetBlock.hide();
		
		jQuery.ajax({
			url: ajaxurl,
			data: data,
			success: function(response){
				widgetBlock.remove();
			},
			error: function(data) {
				alert('Error while deleting');
				widgetBlock.show();
			}
		});
	});
	
    var theme_settings = jQuery('#prima-theme-settings');
    // Only show the background color input when the background color option type is Color (Hex)
    jQuery('.background-option-types').each(function() {
        showHideHexColor(jQuery(this));
        jQuery(this).change( function() {
            showHideHexColor( jQuery(this) ) 
        });
    });
    // Add color picker to color input boxes.
    jQuery('input.color-picker').each(function (i) {
        jQuery(this).after('<div id="picker-' + i + '" style="z-index: 100; background: #EEE; border: 1px solid #CCC; position: absolute; display: block;"></div>');
        jQuery('#picker-' + i).hide().farbtastic(jQuery(this));
    })
    .focus(function() {
        jQuery(this).next().show();
        if (jQuery(this).val() == '') {
            jQuery(this).val('#');
        }
    })
    .blur(function() {
        jQuery(this).next().hide();
        if (jQuery(this).val() == '#') {
            jQuery(this).val('');
        }
    });
    // Show or hide the hex color input.
    function showHideHexColor(selectElement) {
        // Use of hide() and show() look bad, as it makes it display:block before display:none / inline.
        selectElement.next().css('display','none');
        if (selectElement.val() == 'hex') {
            selectElement.next().css('display', 'inline');
        }
    }
});


/**
 * Upload Option
 * Allows window.send_to_editor to function properly using a private post_id
 * Dependencies: jQuery, Media Upload, Thickbox
 * Credits: OptionTree
 */
(function ($) {
  uploadOption = {
    init: function () {
      var formfield,
          formID,
          btnContent = true;
      // On Click
      $('.upload_button').live("click", function () {
        formfield = $(this).prev('input').attr('id');
        formID = $(this).attr('rel');
        // Display a custom title for each Thickbox popup.
        var prima_title = '';
        prima_title = $(this).prev().prev('.upload_title').text();
        tb_show( prima_title, 'media-upload.php?post_id='+formID+'&type=image&amp;TB_iframe=1');
        return false;
      });
            
      window.original_send_to_editor = window.send_to_editor;
      window.send_to_editor = function(html) {
        if (formfield) {
          if ( $(html).html(html).find('img').length > 0 ) {
          	itemurl = $(html).html(html).find('img').attr('src');
          } 
		  else {
          	var htmlBits = html.split("'");
          	itemurl = htmlBits[1];
          	var itemtitle = htmlBits[2];
          	itemtitle = itemtitle.replace( '>', '' );
          	itemtitle = itemtitle.replace( '</a>', '' );
          }
          var image = /(^.*\.jpg|jpeg|png|gif|ico*)/gi;
          var document = /(^.*\.pdf|doc|docx|ppt|pptx|odt*)/gi;
          var audio = /(^.*\.mp3|m4a|ogg|wav*)/gi;
          var video = /(^.*\.mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2*)/gi;
          if (itemurl.match(image)) {
            btnContent = '<img src="'+itemurl+'" alt="" /><a href="#" class="remove etheme">Remove Image</a>';
          } else {
            btnContent = '<div class="no_image">'+html+'<a href="#" class="remove etheme">Remove</a></div>';
          }
          $('#' + formfield).val(itemurl);
          $('#' + formfield).next().next('div').slideDown().html(btnContent);
          tb_remove();
        } else {
          window.original_send_to_editor(html);
        }
      }
    }
  };
  $(document).ready(function () {
	  uploadOption.init();
      // Remove Uploaded Image
      $('.remove').live('click', function(event) { 
        $(this).hide();
        $(this).parents().prev().prev('.upload').attr('value', '');
        $(this).parents('.screenshot').slideUp();
      });
  })
})(jQuery);