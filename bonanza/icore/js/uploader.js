jQuery(document).ready(function() {
 	
	// iris color picker from core wp
	jQuery('.color-picker').wpColorPicker();
	
	// Uploader
    jQuery('.st_upload_button').click(function() {
         targetfield = jQuery(this).prev('.upload-url');
		 description = jQuery(this).next('.description');
		 imgpreview = jQuery(description).next('.upload-img-preview');
         tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
         return false;
    });
 
    window.send_to_editor = function(html) {
         imgurl = jQuery('img',html).attr('src');
         jQuery(targetfield).val(imgurl);
		 jQuery(imgpreview).html('<img class="upload-img-preview" src='+imgurl+' /> <a class="removeupload">Delete Image</a>');
         tb_remove();
    }


	// Slider Option Uploader
	uploadid = "";
	jQuery("#slideshow_list").on("click",".upbutton", function () {

		uploadid = jQuery(this).prev();
		id = jQuery(this).prev().attr("id");
		description = jQuery(this).next('.description');
		imgpreview = jQuery(this).parents(".slide").find('.upload-img-preview');

		window.send_to_editor = function (html) {
			imgurl = jQuery("img", html).attr("src");
			jQuery(uploadid).parent().find(".src").val(imgurl);
			jQuery(imgpreview).html('<img class="upload-img-preview" src='+imgurl+' />');
			tb_remove();
		}

		tb_show('', 'media-upload.php?type=image&amp;post_id=0&amp;TB_iframe=true');
		return false;
	});
	
	
	jQuery('.removeupload').live( "click", function(){
		image = jQuery(this).parent('.upload-img-preview');
		imageSrc = jQuery(image).parent('td').find('.upload-url');
		jQuery(image).html('');
		jQuery(imageSrc).val('');
		
	});
	
	// Dependent Options
	// hide all the options with dependencies
	jQuery('.pid').parent().parent().hide();


	// Dependent Options
	// when checkbox is clicked
	jQuery('.checkbox').click(function(){
		var pidclass = jQuery(this).attr("id");
		if(jQuery(this).is(":checked")){
			jQuery("."+pidclass).each(function(){
				jQuery(this).parent().parent().slideDown('fast');
			});
		} else {
			jQuery("."+pidclass).each(function(){
				jQuery(this).parent().parent().slideUp('fast');
			});
		}
	});

	// Dependent Options
	// onload
	jQuery('.checkbox').each(function(){
		var pidclass = jQuery(this).attr("id");
		if(jQuery(this).is(":checked")){
			jQuery("."+pidclass).each(function(){
				jQuery(this).parent().parent().show();
			});
		} else {
			jQuery("."+pidclass).each(function(){
				jQuery(this).parent().parent().hide();
			});
		}
	});
	
	
	// Dependent Options
	// hide all the options with dependencies
	jQuery('.pid').parent().parent().hide();

	
	// Dependent Options
	// when checkbox is clicked
	jQuery('.slider_type').change(function(){
		
		var pidclass = jQuery(this).find('option:selected').attr("class");
			
		jQuery(".pid").each(function(){
			jQuery(this).parent().parent().slideUp('fast');
		});
		
		jQuery("."+pidclass).each(function(){
			jQuery(this).parent().parent().slideDown('fast');
		});

	});

	// Dependent Options
	// onload
	jQuery('.slider_type').each(function(){
		var pidclass = jQuery(this).find('option:selected').attr("class");
		
		jQuery("."+pidclass).each(function(){
			jQuery(this).parent().parent().show();
		});
		
	});

});
