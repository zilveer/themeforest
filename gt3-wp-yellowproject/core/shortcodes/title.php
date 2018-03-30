<?php

class title {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_title")) {
			function shortcode_title($atts, $content = null)
			{
				extract(shortcode_atts(array(
					'heading_size' => 'h3',
					'heading_color' => '',
				), $atts));

				if (strlen($heading_color) > 0) {
					$custom_color = "color:#" . $heading_color . ";";
				}

				return "<" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>" . $content . "</" . $heading_size . ">";
			}
		}
		add_shortcode($shortcodeName, 'shortcode_title');
	}
}




#Shortcode name
$shortcodeName="title";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
<div style='float:left;clear:both;line-height:27px;width: 60px;'>Header: </div>
<select style='' name='".$shortcodeName."_heading_size' class='".$shortcodeName."_heading_size'>
	<option value='h1'>H1</option>
	<option value='h2'>H2</option>
	<option value='h3'>H3</option>
	<option value='h4'>H4</option>
	<option value='h5'>H5</option>
</select>

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		var heading_size = jQuery('.".$shortcodeName."_heading_size').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." heading_size=\"'+heading_size+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";

#Register shortcode & set parameters
$shortcode_title = new title();
$shortcode_title->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['title'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>