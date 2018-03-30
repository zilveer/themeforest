<?php

class colorblocks_shortcode {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_colorblocks")) {
			function shortcode_colorblocks($atts, $content = null)
			{
				extract(shortcode_atts(array(
					'heading_size' => $gt3_pbconfig['default_heading_in_module'],
					'heading_color' => '',
					'heading_text' => '',
					'title' => $title,
					'icon' => $icon,
					'last' => 'no',
					'hovered' => 'hovered',
					'type' => $type,
				), $atts));

				#heading
				if (strlen($heading_color) > 0) {
					$custom_color = "color:#{$heading_color};";
				}
				if (strlen($heading_text) > 0) {
					$compile .= "<" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
				}

				/*if ($last == "yes") {
                    $lastclass = "last";
                    $cb = "<div class='clear'></div>";
                }

                $compile .= "
                <div class='shortcode_colorblocks one_half color_block ".$lastclass." ".$hovered." ".$type."'>";
                if (strlen($title)>0) {$compile .= "<h5>".$title."</h5>"; }
                $compile .= $content."</div>";*/

				return $compile;

			}
		}
		add_shortcode($shortcodeName, 'shortcode_colorblocks');
	}
}






#Shortcode name
$shortcodeName="colorblocks";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
Title: <input style='width:232px;text-align:center;' value='' type='text' class='".$shortcodeName."_title' name='".$shortcodeName."_title'><br>
Type: 
<select name='".$shortcodeName."_type' class='".$shortcodeName."_type'>
	<option value='dark'>Dark</option>
	<option value='colored'>Colored</option>
	<option value='light'>Light</option>
	<option value='white'>White</option>
</select><br> <input type='checkbox' name='".$shortcodeName."_last' class='".$shortcodeName."_last'> Last<br>
<input type='checkbox' name='".$shortcodeName."_hovered' class='".$shortcodeName."_hovered'> Hovered

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		
		var title = jQuery('.".$shortcodeName."_title').val();
		var last = jQuery('.".$shortcodeName."_last').attr('checked');
		var hovered = jQuery('.".$shortcodeName."_hovered').attr('checked');
		var type = jQuery('.".$shortcodeName."_type').val();
		
		if (last!=='checked') {
			last='no';
		}
		if (last=='checked') {
			last='yes';
		}
		
		if (hovered!=='checked') {
			hovered='nohover';
		}
		if (hovered=='checked') {
			hovered='hovered';
		}
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." type=\"'+type+'\" title=\"'+title+'\" hovered=\"'+hovered+'\" last=\"'+last+'\"]Some text here[/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$colorblocks = new colorblocks_shortcode();
$colorblocks->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['colorblocks'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>