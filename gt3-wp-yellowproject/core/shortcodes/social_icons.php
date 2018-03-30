<?php

class social_icons_shortcode {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_social_icon")) {
			function shortcode_social_icon($atts, $content = null)
			{
				extract(shortcode_atts(array(
					'style' => 'btn_small_black',
					'href' => 'http://',
					'type' => 'type1',
				), $atts));

				$content = strtr($content, array(
					'<p>' => '',
					'</p>' => '',
				));

				return '<a href="' . $href . '" class="shortcode_social_icon ico_socialize ' . $style . ' ' . $type . '">' . $content . '</a>';
			}
		}
		add_shortcode($shortcodeName, 'shortcode_social_icon');
	}
}




#Shortcode name
$shortcodeName="social_icon";

global $gt3_pbconfig;


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
Address url: <input style='width:160px;text-align:center;' value='' type='text' class='".$shortcodeName."_href' name='".$shortcodeName."_href'><br>

Type: <select name='".$shortcodeName."_type' class='".$shortcodeName."_type'>";
if (is_array($gt3_pbconfig['all_available_social_icons_type'])) {
    foreach ($gt3_pbconfig['all_available_social_icons_type'] as $social_type_value => $social_type_Caption) {
        $compileShortcodeUI .= "<option value='".$social_type_value."'>".$social_type_Caption."</option>";
    }
}
$compileShortcodeUI .= "</select><br>
Style: 
<select name='".$shortcodeName."_style' class='".$shortcodeName."_style'>";
if (is_array($gt3_pbconfig['all_available_social_icons'])) {
    foreach ($gt3_pbconfig['all_available_social_icons'] as $social_iconclass => $social_iconCaption) {
    $compileShortcodeUI .= "<option value='".$social_iconclass."'>".$social_iconCaption."</option>";
    }
}
$compileShortcodeUI .= "</select>

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		
		var style = jQuery('.".$shortcodeName."_style').val();
		var href = jQuery('.".$shortcodeName."_href').val();
		var type = jQuery('.".$shortcodeName."_type').val();

		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." style=\"'+style+'\" href=\"'+href+'\" type=\"'+type+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$social_icon = new social_icons_shortcode();
$social_icon->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
$shortcodesUI['shortcode_social_icon'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>