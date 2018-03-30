
jQuery.noConflict();

jQuery(document).ready(function($) {
        
        $('#icon_fonts_upload_button').click(function(event) {
            chooseImageWithMediaUploader(event);
        });


        
        var udesign_iconfont_uploader;
        
	function chooseImageWithMediaUploader(event) {
            
            event.preventDefault();
            
         
            //Extend the wp.media object
            udesign_iconfont_uploader = wp.media.frames.file_frame = wp.media({
		// Set the title of the modal.
                title: 'Upload "zip" File',
                // Tell the modal to show only zip.
                library: {
                        type: 'application/zip'
                },
                // Customize the submit button.
                button: {
                    text: 'Choose File'
                },
                multiple: false // Set to true to allow multiple files to be selected
            });
            
            udesign_iconfont_uploader.on( 'ready', function() {
                $( '.media-modal' ).addClass( 'smaller sidebar-no-caption sidebar-no-description' );
            });
            
            //When a file is selected, grab the URL and set it as the text field's value
            udesign_iconfont_uploader.on('select', function() {
                attachment = udesign_iconfont_uploader.state().get('selection').first().toJSON();
                
                // set the 'attachment.url' to the proper options page element
                $("#fontello_zip_upload_file_id").val(attachment.id);
                $("#last_installed_fontello_filename").val(attachment.name);
                $("#fontello-zip-filename-display").html("...uploaded file: <span>" + attachment.filename + "</span>").css("display","none");
                // Deal with the submit form elements
                $("#fontello-submit").val("Install Fonts").css("display","block").removeClass('red-button');
                $(".remove-fontello-folder").css("display","none");
                
                return false;
            });
            
            udesign_iconfont_uploader.on( 'close', function() {
                $("#fontello-zip-filename-display").delay(200).fadeIn();
            });
            
            //Open the uploader dialog
            udesign_iconfont_uploader.open();
            
	}
        
});



jQuery(document).ready(function($) {
        // Confirm the reset
        $('#remove_fontello_folder').click(function() {
            if ( $(this).is(':checked') ) {
                this.checked = confirm("Are you sure you want to remove the fontello icon fonts?");
                $(this).trigger("change");
                if($(this).is(':checked')) {
                    $("#fontello-submit").val("Delete Fonts").delay(200).fadeIn().addClass('red-button');
                } else {
                    $("#fontello-submit").delay(100).fadeOut().val("Save Changes").removeClass('red-button');
                }
            } else {
                $("#fontello-submit").delay(100).fadeOut();
            }
        });
});



jQuery(document).ready(function ($) {
    $("#preview-fontello-fonts-section-wrapper #followingBallsG").delay(600).fadeIn().delay(1000).fadeOut();
    $("#preview-fontello-fonts-section-wrapper iframe").delay(2200).fadeIn();
});


