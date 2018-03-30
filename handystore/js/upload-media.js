// Uploading files
jQuery(document).ready(function($){
  "use strict";

  var mediaUploader;

  $('.pt_upload_image_button').on('click', function(e) {
    e.preventDefault();

    var button = $(this);
    var id = button.attr('id').replace('_button', '');

    // If the uploader object has already been created, reopen the dialog
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    // Extend the wp.media object
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
        text: 'Choose Image'},
      multiple: false // Set to true to allow multiple files to be selected
    });

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader.on('select', function() {
      var attachment = mediaUploader.state().get('selection').first().toJSON();
      // Do something with attachment.id and/or attachment.url here
      var input_field = button.parent().find('#' + id);
      input_field.val(attachment.url);
      $('.custom_logo_image').attr('src', attachment.url).css('display', 'block')
    });
    // Open the uploader dialog
    mediaUploader.open();
  });

});
