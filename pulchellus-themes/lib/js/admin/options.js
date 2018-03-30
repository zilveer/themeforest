
		
	function loadUploader(element, pathToPhp, uploadsUrl) {
        var button = element;
        new AjaxUpload(button, {
            action: pathToPhp,
            name: 'orange_themes',
            onSubmit: function (file, ext) {

                this.disable();

            },
            onComplete: function (file, response) {
                imgUrl = uploadsUrl + '/' + response;
                button.siblings('input.upload')
                    .attr('value', imgUrl);
                this.enable()
            }
        })
    }

jQuery(window)
    .load(function () {
    if (jQuery('#saved_box')
        .length) {
        setTimeout('bordeaux.removeSavedMessage()', 3000)
    }
});

/*

  	jQuery('.widget-inside').live("hover", function(event){
		
		var btnID = jQuery(this).children().children().children().children().children().children(".btn-upload").attr("id");

		loadUploader(jQuery("#"+btnID), "http://noble.orange-themes.com/wp-content/themes/noble-theme/functions/upload-handler.php", "http://noble.orange-themes.com/wp-content/uploads/2012/11");
	});
*/


jQuery('#bulteno_video').change(function() {
	if(jQuery(this).val()!='') {
		jQuery('#image-size-post').hide(); 
	} else {
		jQuery('#image-size-post').show();
	}
	
});
if(jQuery('#bulteno_video').val()!='') {
	jQuery('#image-size-post').hide(); 
}