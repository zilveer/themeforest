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
		var slideshow_type = document.getElementById('slideshow_type').value;
		if ( slideshow_type != '' ) shortcode_params = shortcode_params + 'effect="'+slideshow_type+'" ';
		var slideshow_width = document.getElementById('slideshow_width').value;
		if ( slideshow_width != '' ) shortcode_params = shortcode_params + 'width="'+slideshow_width+'" ';		
		var slideshow_height = document.getElementById('slideshow_height').value;
		if ( slideshow_height != '' ) shortcode_params = shortcode_params + 'height="'+slideshow_height+'" ';		
		var slideshow_images = document.getElementById('slideshow_images').value;
		if ( slideshow_images != '' ) shortcode_params = shortcode_params + 'urls="'+slideshow_images+'" ';				
		var shortcode_content = '[dt-slideshow'+shortcode_params+']';
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
        <h3 class="page-title">Insert a Nivo slideshow</h3>
		<div id="shorcode-manager">
        	<div class="table-row table-row-alternative"> 
                <label>Slideshow effect:</strong></label>
                <select id="slideshow_type">
                    <option value="sliceDown">sliceDown</option>
                    <option value="sliceDownLeft">sliceDownLeft</option>
                    <option value="sliceUp">sliceUp</option>
                    <option value="sliceUpLeft">sliceUpLeft</option>
                    <option value="sliceUpDown">sliceUpDown</option>
                    <option value="sliceUpDownLeft">sliceUpDownLeft</option>
                    <option value="fold">fold</option>
                    <option value="fade">fade</option>
                    <option value="random">random</option>
                    <option value="slideInRight">slideInRight</option>
                    <option value="slideInLeft">slideInLeft</option>
                    <option value="boxRandom">boxRandom</option>
                    <option value="boxRain">boxRain</option>
                    <option value="boxRainReverse">boxRainReverse</option>
                    <option value="boxRainGrow">boxRainGrow</option>
                    <option value="boxRainGrowReverse">boxRainGrowReverse</option>                                                         
                </select>
            </div>
         	<div class="table-row table-row"> 
                <label>Slideshow width:</strong></label>
                <input type="text" id="slideshow_width" />
            </div>                        
         	<div class="table-row table-row-alternative"> 
                <label>Slideshow height:</strong></label>
                <input type="text" id="slideshow_height" />
            </div>
         	<div class="table-row table-row-beforelast"> 
                <label>Images:</strong></label>
                <textarea id="slideshow_images" style="width:450px; height:120px;clear:both;"></textarea>
                <small>Image urls separated by the sign | or empty to use the images attached.</small>
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
