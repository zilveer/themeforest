jQuery(document).ready(function() {
	
	 // Slider images
     jQuery('#slide-img-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#slide-img-src').val(url);
             tb_remove();
        };
    	return false;
    });
    
    // Portfolio images
    jQuery('#portfolio-preview-img-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-preview-img').val(url);
             tb_remove();
        };
    	return false;
    });
    
    jQuery('#portfolio-image-1-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-image-1').val(url);
             tb_remove();
        };
    	return false;
    });
    
    jQuery('#portfolio-image-2-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-image-2').val(url);
             tb_remove();
        };
    	return false;
    });
    
    jQuery('#portfolio-image-3-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-image-3').val(url);
             tb_remove();
        };
    	return false;
    });
    
    jQuery('#portfolio-image-4-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-image-4').val(url);
             tb_remove();
        };
    	return false;
    });
    
    jQuery('#portfolio-image-5-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-image-5').val(url);
             tb_remove();
        };
    	return false;
    });
    
    jQuery('#portfolio-image-6-uploader').click(function() {    	
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-image-6').val(url);
             tb_remove();
        };
    	return false;
    });
    
    jQuery('#portfolio-image-7-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-image-7').val(url);
             tb_remove();
        };
    	return false;
    });
    
    jQuery('#portfolio-image-8-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-image-8').val(url);
             tb_remove();
        };
    	return false;
    });
    
    jQuery('#portfolio-image-9-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-image-9').val(url);
             tb_remove();
        };
    	return false;
    });
    
    jQuery('#portfolio-image-10-uploader').click(function() {
         tb_show('', 'media-upload.php?TB_iframe=true');
         
         //Change "Insert Into Post" to "Use This Image"
         tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
         
         window.send_to_editor = function(html) {
         	 // Clear interval for "Use this Image" so button text resets
         	 clearInterval(tbframe_interval);
         	 
             url = jQuery(html).attr('href');
             jQuery('#portfolio-image-10').val(url);
             tb_remove();
        };
    	return false;
    });
    
});