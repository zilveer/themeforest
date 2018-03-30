// Uploading files
var file_frame;
var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
var set_to_post_id = 10; // Set this
jQuery('.upload_image_button').on('click', function(event) {
    event.preventDefault();
    var $this = jQuery(this);
    this_class = $this.attr('class');
    meta_key = this_class.match(/metakey-\S+/g)[0].substring(8);console.log(meta_key);
    field_key = this_class.match(/fieldkey-\S+/g)[0].substring(9);console.log(field_key);


    // If the media frame already exists, reopen it.
    if (file_frame) {
        // Set the post ID to what we want
        file_frame.uploader.uploader.param('post_id', set_to_post_id);
        // Open frame
        file_frame.open();
        return;
    } else {
        // Set the wp.media post id so the uploader grabs the ID we want when initialised
        wp.media.model.settings.post.id = set_to_post_id;
    }
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
        title: jQuery(this).data('uploader_title'),
        button: {
            text: jQuery(this).data('uploader_button_text'),
        },
        multiple: false // Set to true to allow multiple files to be selected
    });
    // When an image is selected, run a callback.
    file_frame.on('select', function() {
        // We set multiple to false so only get one image from the uploader
        attachment = file_frame.state().get('selection').first().toJSON();
        // Do something with attachment.id and/or attachment.url here
        //console.log(attachment);
        //console.log(window.parent);
        //window.parent.addMediaValue(meta_key+"["+field_key+"][id]",meta_key+"["+field_key+"][url]",attachment.id,attachment.url);
        // jQuery("#"+meta_key+"["+field_key+"][url]").val(attachment.url);
        // jQuery("#"+meta_key+"["+field_key+"][id]").val(attachment.id);
        jQuery("input[id='"+meta_key+"["+field_key+"][id]"+"']").val(attachment.id);
        jQuery("input[id='"+meta_key+"["+field_key+"][url]"+"']").val(attachment.url);
        jQuery("img[id='"+meta_key+"["+field_key+"][preview]"+"']").attr('src',attachment.url).css('display','block');

        $this.next('.remove_image_button').show();
        // Restore the main post ID
        wp.media.model.settings.post.id = wp_media_post_id;
    });
    // Finally, open the modal
    file_frame.open();
});
jQuery('.remove_image_button').on('click', function(event) {
    event.preventDefault();
    var $this = jQuery(this);
    this_class = $this.attr('class');
    meta_key = this_class.match(/metakey-\S+/g)[0].substring(8);//console.log(meta_key);
    field_key = this_class.match(/fieldkey-\S+/g)[0].substring(9);//console.log(field_key);
    //field_key = this_class.match(/fieldkey-\S+/g)[0].substring(9);//console.log(field_key);

    jQuery("input[id='"+meta_key+"["+field_key+"][id]"+"']").val('');
    jQuery("input[id='"+meta_key+"["+field_key+"][url]"+"']").val('');
    jQuery("img[id='"+meta_key+"["+field_key+"][preview]"+"']").attr('src','').css('display','none');

    $this.hide();

    //$this.removeClass('remove_image_button button-secondary').addClass('upload_image_button button-primary').text('Upload Image');

});
// Restore the main ID when the add media button is pressed
jQuery('a.add_media').on('click', function() {
    wp.media.model.settings.post.id = wp_media_post_id;
});

function addMediaValue(id_field,url_field,id_value,url_value){
  jQuery("input[id='"+id_field+"']").val(id_value);
  jQuery("input[id='"+url_field+"']").val(url_value);
}