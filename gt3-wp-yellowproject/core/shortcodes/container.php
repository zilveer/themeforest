<?php

class container {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_container")) {
			function shortcode_container($atts, $content = null)
			{
				extract(shortcode_atts(array(
					'bg' => 'yes',
					'w' => '50%',
					'float' => 'left',
					'p' => '0px',
				), $atts));

				if ($bg == "yes") {
					$contbg = "contbg";
				}
				if ($float == "none") {
					$cb = "clear:both;";
				}

				return "<div class='shortcode_container' style='width:" . $w . ";float:" . $float . "; " . $cb . "'><div style='padding:" . $p . ";'>" . do_shortcode($content) . "</div></div>";
			}
		}
		add_shortcode($shortcodeName, 'shortcode_container');
	}
}




#Shortcode name
$shortcodeName="container";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
<div style='float:left;clear:both;line-height:27px;'>Float: </div>
<select style='float:left;' name='".$shortcodeName."_float' class='".$shortcodeName."_float'>
	<option value='left'>LEFT</option>
	<option value='right'>RIGHT</option>
	<option value='none'>NONE</option>
</select>
<div style='float:left;clear:both;line-height:27px;'>Width: </div> <input style='width:50px;text-align:left;float:left;' value='50%' type='text' class='".$shortcodeName."_w' name='".$shortcodeName."_w'>
<div style='clear:both;'></div>
<div style='float:left;clear:both;line-height:27px;'>Padding: </div> <input style='width:50px;text-align:left;float:left;' value='0px' type='text' class='".$shortcodeName."_p' name='".$shortcodeName."_p'>
<div style='clear:both;'></div>

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		var w = jQuery('.".$shortcodeName."_w').val();
		var float = jQuery('.".$shortcodeName."_float').val();
		var padding = jQuery('.".$shortcodeName."_p').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." w=\"'+w+'\" float=\"'+float+'\" p=\"'+padding+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";

#Register shortcode & set parameters
$container = new container();
$container->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['container'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>