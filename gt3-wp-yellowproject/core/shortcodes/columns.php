<?php

class columns_shortcode {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_column")) {
			function shortcode_column($atts, $content = null)
			{
				extract(shortcode_atts(array(
					'type' => 'one_fourth',
					'last' => 'no',
				), $atts));

				if ($last == "yes") {
					$lastclass = "last";
					$cb = "<div class='clear'></div>";
				}


				return '<div class="shortcode_column ' . $type . ' ' . $lastclass . '">' . do_shortcode($content) . '</div>' . $cb;
			}
		}
		add_shortcode($shortcodeName, 'shortcode_column');
	}
}




#Shortcode name
$shortcodeName="column";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
Type: 
<select name='".$shortcodeName."_type' class='".$shortcodeName."_type'>
	<option value='one_fourth'>One Fourth</option>
	<option value='three_fourth'>Three Fourth</option>
	<option value='one_third'>One Third</option>
	<option value='one_half'>One Half</option>
</select> <input type='checkbox' name='".$shortcodeName."_last' class='".$shortcodeName."_last'> Last

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		
		var type = jQuery('.".$shortcodeName."_type').val();
		var last = jQuery('.".$shortcodeName."_last').attr('checked');

		if (last!=='checked') {
			last='no';
		}
		if (last=='checked') {
			last='yes';
		}
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." type=\"'+type+'\" last=\"'+last+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$column = new columns_shortcode();
$column->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['column'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>