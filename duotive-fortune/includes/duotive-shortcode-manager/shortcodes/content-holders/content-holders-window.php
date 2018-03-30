<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Duotive Shortcodes - Insert content holders and separators</title>
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
		var content_holders_value = document.getElementById('content_holders').value;
		var shortcode_content = '';

		if ( content_holders_value == 1 ) shortcode_content = ' <div class="dt-message dt-message-notice">Note text goes here.</div> ';
		if ( content_holders_value == 2 ) shortcode_content = ' <div class="dt-message dt-message-success">Success text goes here.</div> ';		
		if ( content_holders_value == 3 ) shortcode_content = ' <div class="dt-message dt-message-error">Error text goes here.</div> ';				
		if ( content_holders_value == 4 ) shortcode_content = ' <div class="dt-message dt-message-info">Info text goes here.</div> ';						
		if ( content_holders_value == 5 ) shortcode_content = ' <div class="dt-message dt-message-paragraph">Simple box content goes here.</div> ';	
		if ( content_holders_value == 6 ) shortcode_content = ' <p class="dt-important-paragraph">Simple box content goes here.</p> ';										
		if ( content_holders_value == 7 ) shortcode_content = ' <div class="dt-quote">Quote text goes here</div> ';			
		if ( content_holders_value == 8 ) shortcode_content = ' <div class="dt-quote dt-quote-left">Quote text goes here</div> ';					
		if ( content_holders_value == 9 ) shortcode_content = ' <div class="dt-quote dt-quote-right">Quote text goes here</div> ';							
		if ( content_holders_value == 10 ) shortcode_content = ' <span class="dt-highlight">Highlighted text goes here</span> ';							
		if ( content_holders_value == 11 ) shortcode_content = ' <div class="dt-separator-top"><a class="scroll" href="#website-header">TOP</a></div> ';									
		if ( content_holders_value == 12 ) shortcode_content = ' [dt-image url="" width="100" height="100" align="left"] ';											
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
        <h3 class="page-title">Insert content shortcodes</h3>
		<div id="shorcode-manager">
        	<div class="table-row table-row-beforelast">     
				<label for="content_holders">Shortcode</label>
                <select id="content_holders">
                    <option value="1">Message - Note</option>
                    <option value="2">Message - Success</option>
                    <option value="3">Message - Error</option> 
                    <option value="4">Message - Info</option>
                    <option value="5">Message - Simple box</option>
                    <option value="6">Important paragraph</option>
                    <option value="7">Quote - Full width</option>
                    <option value="8">Quote - Left Aligned</option> 
                    <option value="9">Quote - Right Aligned</option>
                    <option value="10">Highlight text</option>
                    <option value="11">Separator + top link</option>                                                                                                                                                                                                                                                                       
                    <option value="12">Image</option>                     
                </select>
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
