jQuery(document).ready(function($) {

    "use strict";

    if ( typeof editProfile !== "undefined" ) {

        var ajaxURL = editProfile.ajaxURL;
        var uploadNonce = editProfile.uploadNonce;
        var fileTypeTitle = editProfile.fileTypeTitle;

        /* Validate Edit Profile Form */
        if( jQuery().validate && jQuery().ajaxSubmit ){
            var form_loader = $('#form-loader');
            var form_message = $('#form-message');
            var errors_container = $( '#form-errors' );

            // Edit User Profile Form
            var edit_form_options = {
                url: editProfile.ajaxURL,
                type: 'post',
                dataType: 'json',
                timeout: 30000,
                beforeSubmit: function( formData, jqForm, options ){
                    form_loader.fadeIn();
                    form_message.empty().fadeOut();
                    errors_container.empty().fadeOut();
                },
                success: function( response, status, xhr, $form ){
                    form_loader.fadeOut();
                    if ( response.success ) {
                        form_message.html( response.message).fadeIn();
                    } else {
                        for( var i=0; i < response.errors.length; i++ ){
                            errors_container.append( '<li>' + response.errors[i] + '</li>' );
                        }
                        errors_container.fadeIn();
                    }
                }
            };

            $('#inspiry-edit-user').validate({
                submitHandler: function( form ) {
                    $( form ).ajaxSubmit( edit_form_options );
                }
            });
        }


        /* initialize uploader */
        var uploader = new plupload.Uploader({
            browse_button: 'select-profile-image',          // this can be an id of a DOM element or the DOM element itself
            file_data_name: 'inspiry_upload_file',
            multi_selection : false,
            url: ajaxURL + "?action=profile_image_upload&nonce=" + uploadNonce,
            filters: {
                mime_types : [
                    { title : fileTypeTitle, extensions : "jpg,jpeg,gif,png" }
                ],
                max_file_size: '2000kb',
                prevent_duplicates: true
            }
        });
        uploader.init();


        /* Run after adding file */
        uploader.bind('FilesAdded', function(up, files) {
            var html = '';
            var profileThumb = "";
            plupload.each(files, function(file) {
                profileThumb += '<div id="holder-' + file.id + '" class="profile-thumb">' + '' + '</div>';
            });
            document.getElementById('user-profile-img').innerHTML = profileThumb;
            up.refresh();
            uploader.start();
        });


        /* Run during upload */
        uploader.bind('UploadProgress', function(up, file) {
            document.getElementById( "holder-" + file.id ).innerHTML = '<span>' + file.percent + "%</span>";
        });


        /* In case of error */
        uploader.bind('Error', function( up, err ) {
            document.getElementById('errors-log').innerHTML += "<br/>" + "Error #" + err.code + ": " + err.message;
        });


        /* If files are uploaded successfully */
        uploader.bind('FileUploaded', function ( up, file, ajax_response ) {
            var response = $.parseJSON( ajax_response.response );

            if ( response.success ) {

                var profileThumbHTML = '<img src="' + response.url + '" alt="" />' +
                    '<input type="hidden" class="profile-image-id" name="profile-image-id" value="' + response.attachment_id + '"/>';

                document.getElementById( "holder-" + file.id ).innerHTML = profileThumbHTML;

            } else {
                // log response object
                console.log ( response );
            }
        });

        $('#remove-profile-image').click(function(event){
            event.preventDefault();
            document.getElementById('user-profile-img').innerHTML = '<div class="profile-thumb"></div>';
        });

        /* Check if IE9 - As image upload not works in ie9 */
        var ie = (function(){

            var undef,
                v = 3,
                div = document.createElement('div'),
                all = div.getElementsByTagName('i');

            while (
                div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
                    all[0]
                );

            return v > 4 ? v : undef;

        }());

        if ( ie <= 9 ) {
            $('#inspiry-edit-user').before( '<div class="ie9-message"><i class="fa fa-info-circle"></i>&nbsp; <strong>Current browser is not fully supported:</strong> Please update your browser or use a different one to enjoy all features on this page. </div>' );
        }

    }   // validate localized data

});