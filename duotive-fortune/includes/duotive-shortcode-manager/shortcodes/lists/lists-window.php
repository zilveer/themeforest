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
		var lists_value = document.getElementById('lists').value;
		var list_item_count = document.getElementById('list_item_count').value;	
		
		var i = 0;
		var list_items = '';
		for ( i = 0; i<list_item_count; i++)
		{
			list_items = list_items + '<li>list content goes here</li>';
		}
		if ( lists_value == '' || lists_value == 'dt-list-style-plus' || lists_value == 'dt-list-style-dash' || lists_value == 'dt-list-style-check' )
		{ 
			var shortcode_content = ' <ul class="'+lists_value+'">'+list_items+'</ul>';
		}
		else
		{
			var shortcode_content = ' <ol class="'+lists_value+'">'+list_items+'</ol>';
		}
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
                <select id="lists">
                    <option value="">Circle List</option>
                    <option value="dt-list-style-plus">Plus List</option>                    
                    <option value="dt-list-style-dash">Dash List</option>
                    <option value="dt-list-style-check">Check List</option> 
                    <option value="decimal">Decimal Ordered List</option>
                    <option value="dt-list-style-alpha">Alpha Ordered List</option>                    
                    <option value="dt-list-style-roman">Roman Ordered List</option>
                    <option value="dt-list-style-roman-upper">Roman Upper Ordered List</option>                                                                                                                                                               
                </select>            
            </div>
            <div class="table-row table-row-beforelast">
        		<label>Number of list items in a list:</label>
            	<input type="text" id="list_item_count" />	            
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
