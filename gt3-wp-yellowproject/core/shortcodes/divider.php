<?php

class divider_shortcode {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_divider")) {
			function shortcode_divider($atts, $content = null)
			{
				extract(shortcode_atts(array(
					'divider_color' => '',
					'divider_type' => 'type1',
				), $atts));

				return '<hr class="' . $divider_color . ' ' . $divider_type . '">';
			}
		}
		add_shortcode($shortcodeName, 'shortcode_divider');
	}
}

#Shortcode name
$shortcodeName="divider";

#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
Type: 
<select name='".$shortcodeName."_divider_type' class='".$shortcodeName."_divider_type'>";

if (is_array($gt3_pbconfig['all_available_dividers'])) {
    foreach ($gt3_pbconfig['all_available_dividers'] as $value => $caption) {
        $compileShortcodeUI .= "<option value='".$value."'>".$caption."</option>";
    }
}

$compileShortcodeUI .= "</select>

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		
		var divider_type = jQuery('.".$shortcodeName."_divider_type').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." divider_type=\"'+divider_type+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$divider = new divider_shortcode();
$divider->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
$shortcodesUI['divider'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>