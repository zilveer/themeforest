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
		
		var dtgallery_width = document.getElementById('dtgallery_width').value;
		if ( dtgallery_width != '' ) shortcode_params = shortcode_params + ' width="'+dtgallery_width+'" ';
			
		var dtgallery_thumbwidth = document.getElementById('dtgallery_thumbwidth').value;
		if ( dtgallery_thumbwidth != '' ) shortcode_params = shortcode_params + ' thumbwidth="'+dtgallery_thumbwidth+'" ';	
		
		var dtgallery_thumbheight = document.getElementById('dtgallery_thumbheight').value;
		if ( dtgallery_thumbheight != '' ) shortcode_params = shortcode_params + ' thumbheight="'+dtgallery_thumbheight+'" ';						

		var dtgallery_rows = document.getElementById('dtgallery_rows').value;
		if ( dtgallery_rows != '' ) shortcode_params = shortcode_params + ' rows="'+dtgallery_rows+'" ';						

		var dtgallery_navigation = document.getElementById('dtgallery_navigation').value;
		if ( dtgallery_navigation != '' ) shortcode_params = shortcode_params + ' navigation="'+dtgallery_navigation+'" ';						
		
		var dtgallery_autoadvance = document.getElementById('dtgallery_autoadvance').value;
		if ( dtgallery_autoadvance != '' ) shortcode_params = shortcode_params + ' autoadvance="'+dtgallery_autoadvance+'" ';						
		
		var dtgallery_autoduration = document.getElementById('dtgallery_autoduration').value;
		if ( dtgallery_autoduration != '' ) shortcode_params = shortcode_params + ' autoduration="'+dtgallery_autoduration+'" ';						

		var dtgallery_autointerval = document.getElementById('dtgallery_autointerval').value;
		if ( dtgallery_autointerval != '' ) shortcode_params = shortcode_params + ' autointerval="'+dtgallery_autointerval+'" ';	
		
		var dtgallery_autopauseonhover = document.getElementById('dtgallery_autopauseonhover').value;
		if ( dtgallery_autopauseonhover != '' ) shortcode_params = shortcode_params + ' pauseonhover="'+dtgallery_autopauseonhover+'" ';								
		
		var dtgallery_images = document.getElementById('dtgallery_images').value;
		if ( dtgallery_images != '' ) shortcode_params = shortcode_params + 'urls="'+dtgallery_images+'"';
		
		var shortcode_content = '[dt-gallery'+shortcode_params+']';
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
        <h3 class="page-title">Insert a Duotive Gallery</h3>
		<div id="shorcode-manager" style="margin-bottom:10px;">
         	<div class="table-row"> 
                <label style="width:120px;">Width:</strong></label>
                <input type="text" id="dtgallery_width" style="width:280px;clear:none;" />
            </div>   
         	<div class="table-row table-row-alternative"> 
                <label style="width:120px;">Thumb width:</strong></label>
                <input type="text" id="dtgallery_thumbwidth" style="width:100px;clear:none;" />
            </div>                       
         	<div class="table-row"> 
                <label style="width:120px;">Thumb height:</strong></label>
                <input type="text" id="dtgallery_thumbheight" style="width:100px;clear:none;" />
            </div> 
         	<div class="table-row"> 
                <label style="width:120px;">Thumb rows:</strong></label>
                <input type="text" id="dtgallery_rows" style="width:100px;clear:none;" />
            </div>                                   
        	<div class="table-row table-row-alternative">
	            <label style="width:120px;">Navigation:</label>
                <select id="dtgallery_navigation">
                    <option value="true">Yes</option>
                    <option value="false">No</option>                    
                </select>            
            </div>
        	<div class="table-row">
	            <label style="width:120px;">Auto advance:</label>
                <select id="dtgallery_autoadvance">
                    <option value="true">Yes</option>
                    <option value="false">No</option>                    
                </select>            
            </div>
         	<div class="table-row table-row-alternative"> 
                <label style="width:120px;">Auto duration:</strong></label>
                <input type="text" id="dtgallery_autoduration" style="width:100px;clear:none;" />
            </div> 
         	<div class="table-row"> 
                <label style="width:120px;">Auto interval:</strong></label>
                <input type="text" id="dtgallery_autointerval" style="width:100px;clear:none;" />
            </div> 
        	<div class="table-row table-row-alternative">
	            <label style="width:120px;">Auto hover pause:</label>
                <select id="dtgallery_autopauseonhover">
                    <option value="true">Yes</option>
                    <option value="false">No</option>                    
                </select>            
            </div>                
                                            
         	<div class="table-row table-row-beforelast"> 
                <label style="width:100px;">Images:</strong></label>
                <textarea id="dtgallery_images" style="width:410px; height:120px;clear:both;"></textarea>
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
