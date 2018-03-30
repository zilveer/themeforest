jQuery(document).ready(function($) {

    "use strict";


    if ( typeof houzezUserProfile !== "undefined" ) {

        var ajaxURL = houzezUserProfile.ajaxURL;
        var uploadNonce = houzezUserProfile.uploadNonce;
        var fileTypeTitle = houzezUserProfile.fileTypeTitle;
        var houzez_site_url = houzezUserProfile.houzez_site_url;
        var process_loader_refresh = houzezUserProfile.process_loader_refresh;
        var process_loader_spinner = houzezUserProfile.process_loader_spinner;
        var process_loader_circle = houzezUserProfile.process_loader_circle;
        var process_loader_cog = houzezUserProfile.process_loader_cog;
        var processing_text = houzezUserProfile.processing_text;

        /*-------------------------------------------------------------------
         *  Update Profile [user_profile.php]
         * ------------------------------------------------------------------*/
        $("#houzez_update_profile").click( function() {

            var firstname   = $("#firstname").val(),
                lastname    = $("#lastname").val(),
                useremail   = $('#prof_useremail').val(),
                title       = $("#title").val(),
                about       = $("#about").val(),
                userphone   = $("#userphone").val(),
                usermobile  = $("#usermobile").val(),
                userskype   = $("#userskype").val(),
                facebook    = $("#facebook").val(),
                twitter     = $("#twitter").val(),
                linkedin    = $("#linkedin").val(),
                instagram   = $("#instagram").val(),
                pinterest   = $("#pinterest").val(),
                youtube     = $("#youtube").val(),
                vimeo       = $("#vimeo").val(),
                googleplus  = $("#googleplus").val(),
                website     = $("#website").val(),
                profile_pic = $("#profile-pic-id").val(),

                securityprofile = $('#houzez-security-profile').val();

            $.ajax({
                type: 'POST',
                url: ajaxURL,
                data: {
                    'action'     : 'houzez_ajax_update_profile',
                    'firstname'  : firstname,
                    'lastname'   : lastname,
                    'useremail'  : useremail,
                    'title'      : title,
                    'about'      : about,
                    'userphone'  : userphone,
                    'usermobile' : usermobile,
                    'userskype'  : userskype,
                    'facebook'   : facebook,
                    'twitter'    : twitter,
                    'linkedin'   : linkedin,
                    'instagram'  : instagram,
                    'youtube'    : youtube,
                    'vimeo'      : vimeo,
                    'googleplus' : googleplus,
                    'pinterest'  : pinterest,
                    'website'    : website,
                    'profile_pic': profile_pic,
                    'houzez-security-profile'  : securityprofile,
                },
                success: function(data) {
                    $('#profile_message').empty().append('<div class="login-alert">' + data + '<div>');
                },
                error: function(errorThrown) {

                }
            });

        });

        /*-------------------------------------------------------------------
         *  Change Password [user-profile.php]
         * ------------------------------------------------------------------*/
        $("#houzez_change_pass").click( function() {
            var securitypassword, oldpass, newpass, confirmpass;

            oldpass          = $("#oldpass").val();
            newpass          = $("#newpass").val();
            confirmpass      = $("#confirmpass").val();
            securitypassword = $("#houzez-security-pass").val();

            $.ajax({
                type: 'POST',
                url:   ajaxURL,
                data: {
                    'action'      : 'houzez_ajax_password_reset',
                    'oldpass'     : oldpass,
                    'newpass'     : newpass,
                    'confirmpass' : confirmpass,
                    'houzez-security-pass' : securitypassword,
                },
                success: function(data) {
                    jQuery('#profile_pass').empty().append('<div class="login-alert">' + data + '<div>');
                    jQuery('#oldpass, #newpass, #confirmpass').val('');
                },
                error: function(errorThrown) {}
            });

        });

        $('#houzez_delete_account').click(function(e){

            var userID    = $('#houzez_account_id').val();

            var confirm = window.confirm("Are you sure!, you want to delete a account.");

            if ( confirm == true ) {

                $.ajax({
                    type: 'post',
                    url: ajaxURL,
                    dataType: 'json',
                    data: {
                        'action': 'houzez_delete_account',
                        'user_id': userID
                    },
                    beforeSend: function () {
                        profile_processing_modal(processing_text);
                    },
                    success: function( response ) {
                        if( response.success ) {
                            window.location.href = houzez_site_url;
                        }
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                    }
                });

            }

        });

        $( '#houzez_user_role' ).on( 'change', function() {
            var user_role = $( this ).val();
            var userID    = $('#houzez_account_id').val();

            $.ajax({
                type: 'post',
                url: ajaxURL,
                dataType: 'json',
                data: {
                    'action': 'houzez_change_user_role',
                    'user_id': userID,
                    'role': user_role
                },
                beforeSend: function () {
                    profile_processing_modal(processing_text);
                },
                success: function( response ) {
                    if( response.success ) {
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });
        });

        var profile_processing_modal = function ( msg ) {
            var process_modal ='<div class="modal fade" id="fave_modal" tabindex="-1" role="dialog" aria-labelledby="faveModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body houzez_messages_modal">'+msg+'</div></div></div></div></div>';
            jQuery('body').append(process_modal);
            jQuery('#fave_modal').modal();
        }

        var profile_processing_modal_close = function ( ) {
            jQuery('#fave_modal').modal('hide');
        }

        /*-------------------------------------------------------------------
         *  initialize uploader
         * ------------------------------------------------------------------*/
        var uploader = new plupload.Uploader({
            browse_button: 'select-profile-image',          // this can be an id of a DOM element or the DOM element itself
            file_data_name: 'favethemes_upload_file',
            container: 'plupload-container',
            multi_selection : false,
            url: ajaxURL + "?action=houzez_profile_image_upload&nonce=" + uploadNonce,
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
                    '<input type="hidden" class="profile-pic-id" id="profile-pic-id" name="profile-pic-id" value="' + response.attachment_id + '"/>';

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
            $('#houzez-edit-user').before( '<div class="ie9-message"><i class="fa fa-info-circle"></i>&nbsp; <strong>Current browser is not fully supported:</strong> Please update your browser or use a different one to enjoy all features on this page. </div>' );
        }

    }   // validate localized data

});