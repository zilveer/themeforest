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
		var number_of_tabs = document.getElementById('number_of_tabs').value;
		var type_of_tabs = document.getElementById('type_of_tabs').value;		
		var shortcode_content = '';
		
		if ( type_of_tabs == 'horizontal' ) shortcode_content = shortcode_content+'<div class="dt-tabs-shortcode tabs">';
		if ( type_of_tabs == 'vertical' ) shortcode_content = shortcode_content+'<div class="dt-tabs-vertical tabs">';		
			shortcode_content = shortcode_content+'<ul class="ui-tabs-nav">';
				var m = 0;
				for ( m = 0; m<number_of_tabs;m++)
				{
					shortcode_content = shortcode_content+'<li class="ui-state-default"><a href="#tabs-'+m+'">tab title</a></li>';
				}
			shortcode_content = shortcode_content+'</ul>';			
			var n = 0;
			for ( n = 0; n<number_of_tabs;n++)
			{
				shortcode_content = shortcode_content+'<div id="tabs-'+n+'" class="ui-tabs-panel"><p>tab content</p></div>';
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
        <h3 class="page-title">Insert tabs</h3>
		<div id="shorcode-manager">
            <div class="table-row"> 
                <label>Type of tabs:</label>
				<select id="type_of_tabs">
                	<option value="horizontal">Horizontal</option>
                	<option value="vertical">Vertical</option>                    
                </select>
            </div>        
            <div class="table-row table-row-beforelast"> 
                <label>Number of tabs:</label>
                <input type="text" id="number_of_tabs" />
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
