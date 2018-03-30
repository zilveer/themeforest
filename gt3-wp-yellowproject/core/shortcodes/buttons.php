<?php

class buttons_shortcode {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_button")) {
			function shortcode_button($atts, $content = null)
			{
				extract(shortcode_atts(array(
					'style' => 'btn_small_black',
					'href' => 'http://',
					'target' => '_self',
				), $atts));

				$content = strtr($content, array(
					'<p>' => '',
					'</p>' => '',
				));

				if ($target == "_blank") {
					$external_html = 'target="_blank"';
				} else {
					$external_html = '';
				}

				return '<a href="' . $href . '" ' . $external_html . ' class="shortcode_button ' . $style . '">' . $content . '</a>';
			}
		}
		add_shortcode($shortcodeName, 'shortcode_button');
	}
}




#Shortcode name
$shortcodeName="custom_button";

global $gt3_pbconfig;


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
Address url: <input style='width:160px;text-align:center;' value='' type='text' class='".$shortcodeName."_href' name='".$shortcodeName."_href'><br>
Style: 
<select name='".$shortcodeName."_style' class='".$shortcodeName."_style'>";
if (is_array($gt3_pbconfig['all_available_custom_buttons'])) {
    foreach ($gt3_pbconfig['all_available_custom_buttons'] as $buttonclass => $buttonCaption) {
    $compileShortcodeUI .= "<option value='".$buttonclass."'>".$buttonCaption."</option>";
    }
}
$compileShortcodeUI .= "</select><br>
Target:
<select name='".$shortcodeName."_target_state' class='".$shortcodeName."_target_state'>
    <option value='_self'>_self</option>
	<option value='_blank'>_blank</option>
</select>

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		
		var style = jQuery('.".$shortcodeName."_style').val();
		var href = jQuery('.".$shortcodeName."_href').val();
		var target_state = jQuery('.".$shortcodeName."_target_state').val();

		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." style=\"'+style+'\" href=\"'+href+'\" target=\"'+target_state+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$button = new buttons_shortcode();
$button->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
$shortcodesUI['shortcode_button'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>