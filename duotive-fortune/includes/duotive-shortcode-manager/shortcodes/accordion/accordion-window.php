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
		var number_of_accordions = document.getElementById('number_of_accordions').value;
		var shortcode_content = '';
		
		shortcode_content = shortcode_content+'<div class="dt-accordion accordion">';
			var i = 0;
			for ( i = 0; i<number_of_accordions;i++)
			{	
				first_class = '';
				if ( i == 0 ) first_class = ' ui-accordion-header-first-child';
				shortcode_content = shortcode_content+'<h3 class="ui-accordion-header'+first_class+'"><span class="ui-icon">&nbsp;</span><a href="#">accordion title goes here</a></h3>';
				shortcode_content = shortcode_content+'<div class="ui-accordion-content"><p>accordion content goes here</p></div>';				
			}
		shortcode_content = shortcode_content+'</div>';		
		
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
		<h3 class="page-title">Insert Accordion</h3>    		
    	<div id="shorcode-manager">
            <div class="table-row table-row-beforelast">
                <label>Number of accordion elements:</label>        
                <input type="text" id="number_of_accordions" size="3" />            
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
