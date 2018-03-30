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
		var video_title = document.getElementById('video_title').value;
		if ( video_title != '' ) shortcode_params = shortcode_params + 'title="'+video_title+'" ';			
		var video_m4v = document.getElementById('video_m4v').value;
		if ( video_m4v != '' ) shortcode_params = shortcode_params + 'm4v="'+video_m4v+'" ';
		var video_ogv = document.getElementById('video_ogv').value;
		if ( video_ogv != '' ) shortcode_params = shortcode_params + 'ogv="'+video_ogv+'" ';
		var video_webmv = document.getElementById('video_webmv').value;
		if ( video_webmv != '' ) shortcode_params = shortcode_params + 'webmv="'+video_webmv+'" ';	
		var video_poster = document.getElementById('video_poster').value;
		if ( video_poster != '' ) shortcode_params = shortcode_params + 'poster="'+video_poster+'" ';			
		var video_width = document.getElementById('video_width').value
		if ( video_width != '' ) shortcode_params = shortcode_params + 'width="'+video_width+'" ';
		var video_height = document.getElementById('video_height').value;
		if ( video_height != '' ) shortcode_params = shortcode_params + 'height="'+video_height+'" ';
		
		var shortcode_content = '[dt-video'+shortcode_params+']';
		
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
        <h3 class="page-title">Insert HTML 5 video</h3>
		<div id="shorcode-manager">                              
            <div class="table-row table-row-alternative">
                <label>Title:</label>        
                <input type="text" id="video_title" size="80" />            
            </div>        
            <div class="table-row table-row-alternative">
                <label>Video M4V url:</label>        
                <input type="text" id="video_m4v" size="80" />            
            </div>
            <div class="table-row table-row-alternative">
                <label>Video OGV url:</label>        
                <input type="text" id="video_ogv" size="80" />            
            </div> 
            <div class="table-row table-row-alternative">
                <label>Video WEBMV url:</label>        
                <input type="text" id="video_webmv" size="80" />            
            </div> 
            <div class="table-row table-row-alternative">
                <label>Poster url:</label>        
                <input type="text" id="video_poster" size="80" />            
            </div>                                    
            <div class="table-row">
                <label>Video width:</label>        
                <input type="text" id="video_width" size="10" />            
            </div>
            <div class="table-row table-row-alternative">
                <label>Video height:</label>        
                <input type="text" id="video_height" size="10" />            
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
