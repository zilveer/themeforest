<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Duotive Shortcodes</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php
		//GET THE CURRENT WORDPRESS INSTALL LOCATION
        $url_with_file = $_SERVER['HTTP_REFERER'];
        $file_pos = strpos($url_with_file,"/wp-admin");
        $url = substr($url_with_file, 0,$file_pos);
    ?>    
    <!-- GET THE NECESARY JAVASCRIPT AND CSS -->
    <link rel="stylesheet" type="text/css" href="../../duotive_shortcode_style.css" />
	<script language="javascript" type="text/javascript" src="<?php echo $url; ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $url; ?>/wp-includes/js/jquery/jquery.js?ver=1.4.2"></script>
	<script language="javascript" type="text/javascript">
	function insertShortcode() {
		var button_type = document.getElementById('button_type').value;
		var url_behaivour = document.getElementById('url_behaivour').value;		
		var button_url = document.getElementById('button_url').value;
		var button_text = document.getElementById('button_text').value;	
		var button_extra = '';
		
		if ( url_behaivour == '2' ) button_extra = 'target="_blank"';
		if ( url_behaivour == '3' ) button_extra = 'rel="modal-window"';		
		
		
		if ( button_type == 'simple' ) var shortcode_content = '<a class="dt-button" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'read-more' ) var shortcode_content = '<a class="dt-more-link" href="'+button_url+'" '+button_extra+'><span><span>'+button_text+'</span></span></a>';					
		if ( button_type == 'large' ) var shortcode_content = '<a class="dt-button dt-button-large" href="'+button_url+'" '+button_extra+'><span>'+button_text+'</span></a>';	
		if ( button_type == 'larger' ) var shortcode_content = '<a class="dt-button dt-button-x-large" href="'+button_url+'" '+button_extra+'><span>'+button_text+'</span></a>';			
		if ( button_type == 'download' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-download" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'photo' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-photo" href="'+button_url+'" '+button_extra+'><span> </span>'+button_text+'</a>';
		if ( button_type == 'pdf' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-pdf" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'word' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-word" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'music' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-music" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'video' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-video" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'checkmark' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-checkmark" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'favourite' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-favourite" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'mail' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-mail" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'play' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-play" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'cart' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-cart" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'comment' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-comment" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'home' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-home" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'print' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-print" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if ( button_type == 'star' ) var shortcode_content = '<a class="dt-button dt-button-icon dt-button-icon-star" href="'+button_url+'" '+button_extra+'><span>&nbsp;</span>'+button_text+'</a>';
		if(window.tinyMCE) {
			window.tinyMCE.execCommand('mceInsertContent', false, shortcode_content);
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	</script>
</head>
<body>
	<form action="#">
        <h3 class="page-title">Insert image with frame</h3>
		<div id="shorcode-manager">
        	<div class="table-row table-row-alternative">
	            <label>Bullet type:</label>
                <select id="button_type">
                    <option value="simple">simple</option>
                    <option value="read-more">read more</option>                                                            
                    <option value="large">large</option>     
                    <option value="larger">even larger</option>                                        
                    <option value="download">download</option>                    
                    <option value="photo">photo</option>                    
                    <option value="pdf">pdf</option>
                    <option value="word">word</option>
                    <option value="music">music</option>
                    <option value="video">video</option>
                    <option value="checkmark">checkmark</option>
                    <option value="favourite">favourite</option>
                    <option value="mail">mail</option>
                    <option value="play">play</option>
                    <option value="cart">cart</option>
                    <option value="comment">comment</option>
                    <option value="home">home</option>
                    <option value="print">print</option>
                    <option value="star">star</option>                                     
                </select>            
            </div>
            <div class="table-row">
        		<label>How to open the link:</label>
            	<select id="url_behaivour">
                	<option value="1">Open in same window</option>
                	<option value="2">Open in a new window</option>
                	<option value="3">Open in a modal window</option>                                        
                </select>
            </div>
            <div class="table-row table-row-alternative">
        		<label>Button url:</label>
            	<input type="text" id="button_url" size="40" />
            </div> 
            <div class="table-row table-row-beforelast">
        		<label>Button text:</label>
            	<input type="text" id="button_text" size="40" />
            </div>                        
            <div class="table-row table-row-last">            
                <input type="button" value="Close" onclick="tinyMCEPopup.close();" />
                <input type="submit" value="Insert" onclick="insertShortcode();" />                 
            </div>             
        </div>    
	</form>
</body>
</html>
<?php

?>
