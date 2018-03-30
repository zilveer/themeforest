<?php

class float {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_float")) {
			function shortcode_float($atts, $content = null)
			{
				extract(shortcode_atts(array(
					'style' => 'left',
				), $atts));

				return "<div class='shortcode_float' style='float:" . $style . ";'>" . do_shortcode($content) . "</div>";
			}
		}
		add_shortcode($shortcodeName, 'shortcode_float');
	}
}

#Shortcode name
$shortcodeName="float";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
Float: 
<select style='' name='".$shortcodeName."_style' class='".$shortcodeName."_style'>
	<option value='left'>Left</option>
	<option value='right'>Right</option>
</select>

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		var style = jQuery('.".$shortcodeName."_style').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." style=\"'+style+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$float = new float();
$float->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
$shortcodesUI['float'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>