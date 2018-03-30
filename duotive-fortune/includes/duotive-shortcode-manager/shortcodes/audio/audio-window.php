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
		var shortcode_params = ' ';
		var audio_title = document.getElementById('audio_title').value;
		if ( audio_title != '' ) shortcode_params = shortcode_params + 'title="'+audio_title+'" ';		
		var audio_mp3 = document.getElementById('audio_mp3').value;
		if ( audio_mp3 != '' ) shortcode_params = shortcode_params + 'mp3="'+audio_mp3+'" ';
		
		var shortcode_content = '[dt-audio '+shortcode_params+']';
		
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
        <h3 class="page-title">Insert HTML 5 audio</h3>
		<div id="shorcode-manager">
            <div class="table-row table-row-alternative">
                <label>MP3 title:</label>        
                <input type="text" id="audio_title" size="60" />            
            </div>                                     
            <div class="table-row table-row-alternative">
                <label>MP3 url:</label>        
                <input type="text" id="audio_mp3" size="60" />            
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
