var bfi;

(function($){
    
    bfi = {        
        upload : function(uploadHandlerUrl, uploadPath, btnUpload, btnLabel, txtInput) {
            var labelTimer;
            new AjaxUpload(btnUpload, {
                action: uploadHandlerUrl, // path to the upload handler php script
                name: 'uploadfile',  // name of the file input box
                onSubmit: function(file, ext) {
                    var dots = '.';
                    labelTimer = setInterval(function() {if (dots.length < 3) { dots += "."; } else { dots = "."; } btnLabel.text("Please wait"+dots); }, 750);
                    txtInput.trigger('start');
                },  
                onComplete: function(file, response) {
                    txtInput.trigger('stop');
                    clearTimeout(labelTimer);
                    btnLabel.text("Upload complete!");    
                    if(response!="error"){
                        txtInput.val(uploadPath+response);
                        txtInput.trigger('change');
                    } else{  
                        alert("Unable to upload image, please make sure this folder is writable: "+uploadPath+" and that the image you are uploading is less than 2MB. If it is more than 2MB, you might want to try uploading it manually using an FTP client to "+uploadPath+" then typing in the URL instead. You can also try asking your host on how to increase PHP's upload limit.");  
                    }  
                }  
            });
        }
    }
})(jQuery);

jQuery(document).ready(function(jQuery){
    vtip();
    // always hide the custom_fields per page load
    jQuery('#postcustom').addClass('closed');
    
    // pretty lists
    jQuery('ul, ol').each(function(i) {
        jQuery(this).children('li:first').addClass('first');
        jQuery(this).children('li:last').addClass('last');
    });
    
    jQuery('table tr:even').addClass('even');
    jQuery('table tbody').each(function(i) {
        jQuery(this).children('tr:first').addClass('first');
        jQuery(this).children('tr:last').addClass('last');
    });
    jQuery('table tr').each(function(i) {
        jQuery(this).children('td:first').addClass('first').next().addClass('second');
        jQuery(this).children('td:last').addClass('last');
        jQuery(this).children('th:first').addClass('first').next().addClass('second');
        jQuery(this).children('th:last').addClass('last');
    });
}); 