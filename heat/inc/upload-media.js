jQuery(document).ready(function() {	
	
	jQuery('.mega-custom-table .button').click(function() {
			var btn = jQuery(this);
			
			var post_id = jQuery("#post_ID").val();
			if( typeof post_id === 'undefined' ) post_id = '0';
			
		    window.send_to_editor = function(html) {
    			var imgurl = jQuery('img', html).attr('src');
    			var id = btn.attr('id').replace('_button', '');
    			jQuery('#'+ id).val(imgurl);
    			tb_remove();
    		}
    		
    		tb_show('', 'media-upload.php?post_id='+post_id+'&amp;type=image&amp;TB_iframe=true');
    		
	    return false;
	});

});
