<?php

class frame {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_frame")) {
			function shortcode_frame($atts, $content = null)
			{
				extract(shortcode_atts(array(
					'style' => 'alignleft',
					'width' => '250',
					'height' => '176',
					'lightbox' => 'yes',
					'url' => '',
					'title' => "Title",
				), $atts));

				$compile = '
                <img data-href="' . $url . '" width="' . $width . '" height="' . $height . '" alt="" src="' . $url . '" class="grey_img ' . $style . ' wrapped_zoomer" title="' . $title . '">
            ';


				return $compile;
			}
		}
		add_shortcode($shortcodeName, 'shortcode_frame');
	}
}




#Shortcode name
$shortcodeName="frame";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
Float: 
<select style='' name='".$shortcodeName."_style' class='".$shortcodeName."_style'>
	<option value='alignleft'>Left</option>
	<option value='alignright'>Right</option>
	<option value='alignnone'>None</option>
</select><br>
<div style='float:left;clear:both;line-height:27px;'>Preview width:</div> <input style='width:60px;text-align:center;' value='124' type='text' class='".$shortcodeName."_width' name='".$shortcodeName."_width'> (px)
<div style='clear:both;'></div>
<div style='float:left;clear:both;line-height:27px;'>Preview height:</div> <input style='width:60px;text-align:center;' value='124' type='text' class='".$shortcodeName."_height' name='".$shortcodeName."_height'> (px)
<div style='clear:both;'></div>
<div style='float:left;clear:both;line-height:27px;'>Title:</div> <input style='width:60px;text-align:center;' value='' type='text' class='".$shortcodeName."_title' name='".$shortcodeName."_title'>
<div style='clear:both;'></div>
Image: <input style='width:223px;text-align:center;' value='' type='text' class='".$shortcodeName."_url' name='".$shortcodeName."_url'>

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		var style = jQuery('.".$shortcodeName."_style').val();
		/*var lightbox = jQuery('.".$shortcodeName."_lightbox').val();*/
		var url = jQuery('.".$shortcodeName."_url').val();
		var title = jQuery('.".$shortcodeName."_title').val();
		var width = jQuery('.".$shortcodeName."_width').val();
		var height = jQuery('.".$shortcodeName."_height').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." style=\"'+style+'\" title=\"'+title+'\" width=\"'+width+'\" height=\"'+height+'\" url=\"'+url+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$frame = new frame();
$frame->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
$shortcodesUI['frame'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>