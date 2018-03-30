/**
 * Scripts and handlers for the page Appearance -> Widgets
 */ 

jQuery(document).ready(function($){

    // upload button
    $(document).on('click', '.upload-image', function(){
        var yit_this_object = $(this).prev();
        
        tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');    
    
        window.send_to_editor = function(html) {
            imgurl = $('img', html).attr('src');
            yit_this_object.val(imgurl);
            
            tb_remove();
        }          
        
        return false;
    });
    
});