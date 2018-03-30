jQuery(document).ready(function () {
	/**
	*  Navigation Menu
	*/
  	var $navigationCon  = jQuery("#vanPanelContainer #panelNavigation ul");
  	var $navigationLink = jQuery("#vanPanelContainer #panelNavigation ul a");
  	var $panelContent   = jQuery("#vanPanelContainer #panelContent");
	$navigationCon.find("a:first").addClass('van-active');
	$panelContent.find(".section:first").addClass('van-active');
	$navigationLink.on('click', function () {
		var index  = $navigationLink.index(this);
		var active = $navigationCon.find('a.van-active');

		if ($navigationLink.index(active) !== index) {
			active.removeClass('van-active');
			jQuery(this).addClass('van-active');
			$panelContent.find(".section.van-active").hide().removeClass('van-active');
			$panelContent.find('.section:eq(' + index + ')').fadeIn().addClass('van-active');
		}
	});
	/**
	* Uploader
	*/
        jQuery(".upload-btn").click(function(event){
                  event.preventDefault();
                  var $vanUploader = jQuery(this).parent();
                  var $patch           = jQuery('.uploader-patch',$vanUploader);
                  var $preview        = jQuery('.uploader-preview',$vanUploader);
                  var uploader = wp.media({
                           title : 'Upload image',
                           button : {
                                   text : 'Choose a image'
                           },
                           multiple : false,
                  }).on('select', function(){
                           var selection    = uploader.state().get('selection');
                           var item           = selection.first().toJSON();
                           $patch.val(item.url);
                           $preview.show();
                           jQuery('img' , $preview).attr('src' , item.url);
                  }).open();
        });
        jQuery('.uploader-patch').change(function() {
                  var $vanUploader = jQuery(this).parent();
                  var $preview        = jQuery('.uploader-preview',$vanUploader);
                  var $value            =  jQuery(this).val();
                  $preview.show();
                 jQuery('img' , $preview).attr('src' , $value);
         });
        jQuery(".img-delete").live("click", function () {
                  var $vanUploader = jQuery(this).parent().parent().parent();
                  var $patch           = jQuery('.uploader-patch',$vanUploader);
                  var $preview        = jQuery('.uploader-preview',$vanUploader);
                  $patch.val('');
                  jQuery($preview).fadeOut(function () {
                        jQuery('img' , this).attr('src' , '');
                 });
        });

	/**
	*  input Radio Change hide & show
	*/
	van_radio_change("input#logo-setting", "logo", "#custom-image");

	van_radio_change("input#ab-art-banner-type", "image", "#article-banner-image");
	van_radio_change("input#ab-art-banner-type", "ads_code", "#article-ads-code");
	van_radio_change("input#short-banner-type", "image", "#shortcode-banner-image");
	van_radio_change("input#short-banner-type", "ads_code", "#shortcode-ads-code");
	van_radio_change("input#bg-type", "pattern", "#choose-pattern");
	van_radio_change("input#bg-type", "custom", '#custom-background');

	/**
	* input Chekbox Change hide & show
	*/
	van_checkbox_change("input#share-post", "#share-post-settings");

	/**
	*  input Radio to thumb
	*/
        jQuery(".radio-img input:checked").parent().parent().addClass("selected");
        jQuery(".radio-img input").live("change", function () {
                 var $container = jQuery(this).parent().parent().parent(); 
                 var $li             = jQuery("li",  $container);
                 var $input        = jQuery(":radio", $container);
                 $li.removeClass("selected");
                 $input.removeAttr("checked");
                 jQuery(this).parent().parent().addClass("selected");
                 jQuery(this).attr("checked","checked");
        });
	/**
	*  CheckBox on/off
	*/
        jQuery(".switch-checkbox input:checked").parent().parent().addClass("selected");
        jQuery(".switch-checkbox input").live("change", function () {
                 var $container = jQuery(this).parent().parent();
                 if ( jQuery(this).is(":checked") ) {
                 		$container.addClass("selected");
                 }else{
                 		$container.removeClass("selected");
                 }
        });
	/**
	*  Radio Change Style
	*/
        jQuery(".van-radio-rounded input:checked").parent().parent().addClass("selected");
        jQuery(".van-radio-rounded input").live("change", function () {
                 var $container = jQuery(this).parent().parent().parent(); 
                 var $inCon       = jQuery(".van-radio-rounded",  $container); 
                 var $input       = jQuery(":radio", $container);
                 $inCon.removeClass("selected");
                 $input.removeAttr("checked");
                 jQuery(this).parent().parent().addClass("selected");
                 jQuery(this).attr("checked","checked");

        });
	/**
	* Sidebar
	*/
	jQuery("#addsidebar").click(function() {
	    var sidebar = jQuery('#add_sidebar').val();
	    if(sidebar !== ""){
	        jQuery('.sidebars-list').append('<div class="sidebar-title">'+sidebar+'<a class="del-sidebar"></a><input id="van_sidebars" name="van_options[van_sidebars][]" type="hidden" value="'+sidebar+'" /></div>');
	        jQuery('#home_sidebar, #article_sidebar, #page_sidebar, #archives_sidebar').append('<option value="'+sidebar+'" >'+sidebar+'</option>');
	    
	    }
	    jQuery('#add_sidebar').attr('value','');

	});
	jQuery(".del-sidebar").live("click", function () {
	    var sidebar_val = jQuery(this).parent().find("input").val();
	    jQuery('#home_sidebar, #article_sidebar, #page_sidebar, #archives_sidebar').find('option[value="'+sidebar_val+'"]').remove();
	    jQuery(this).parent().fadeOut(function () {
	        jQuery(this).remove();
	    });
	});

	/**
	* Ajax Save
	*/
          jQuery('form#vanform').submit(function() {
                     jQuery("#van-saved").fadeIn();
                     var data = jQuery(this).serialize();
                     jQuery.post(ajaxurl, data, function(response) {
                     //	alert(response);
                                if(response == 1) {
                                          show_message(1);
                                          t = setTimeout('fade_message()', 1000);
                                }
                               else if( response == 2 ){
                                          location.reload();
                                }
                               else {
                                        show_message(2);
                                        t = setTimeout('fade_message()', 1000);
                               }
                     });
                     return false;
          });

});
/*  Functions
------------------------------------------------*/
/**
* Ajax Save
*/
function show_message(msg) {
            if(msg == 1) {
                jQuery('#van-saved').addClass('van-success').show();
            } 
            else {
                jQuery('#van-saved').addClass('van-error').show();
            }
} 
function fade_message() {
           jQuery('#van-saved').fadeOut(1000,function(){
                jQuery('#van-saved').removeClass('van-success').removeClass('van-error');
           }); 
           clearTimeout(t);
}
/**
*   input Radio Change Hide & show 
*/

function van_radio_change(element, value, log) {
	var elementvalue = jQuery(element + ":checked").val();
	if (elementvalue == value) {
		jQuery(log).show();
	} else {
		jQuery(log).hide();
	}
	jQuery(element).change(function () {
		var elementvalue = jQuery(element + ":checked").val();
		if (elementvalue == value) {
			jQuery(log).fadeIn();
		} else {
			jQuery(log).hide();
		}
	});
}

/**
* input Chekbox Change
*/

function van_checkbox_change(checkbox, log) {
	if (jQuery(checkbox).is(":checked")) {
		jQuery(log).show();
	} else {
		jQuery(log).hide();
	}
	jQuery(checkbox).change(function () {
		if (jQuery(checkbox).is(":checked")) {
			jQuery(log).fadeIn();
		} else {
			jQuery(log).fadeOut();
		}
	});
}