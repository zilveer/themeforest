jQuery(document).ready(function() {

jQuery('.upload_image_button').click(function() {
 formfield = jQuery(this).parent();
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 return false;
});

window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery(formfield).find('input.slide_src').val(imgurl);
 tb_remove();
}

});
