jQuery(document).ready(function() {
 
jQuery('.upload_image_button').click(function() {

 formfield = jQuery('.slide_src').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 return false;
});
 
window.send_to_editor = function(html, tatko) {

}
 
});