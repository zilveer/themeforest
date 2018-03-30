<?php

class textarea {

    public function register_shortcode($shortcodeName) {
        if (!function_exists("shortcode_textarea")) {
            function shortcode_textarea($atts, $content = null)
            {
                global $gt3_pbconfig;

                if (!isset($compile)) {
                    $compile = '';
                }

                extract(shortcode_atts(array(
                    'heading_size' => $gt3_pbconfig['default_heading_in_module'],
                    'heading_color' => '',
                    'heading_text' => '',
                    'module' => '',
                    'fullwidth_map' => 'no',
                    'text' => '',
                ), $atts));

                #heading
                if (strlen($heading_color) > 0) {
                    $custom_color = "color:#{$heading_color};";
                }
                if (strlen($heading_text) > 0) {
                    $compile .= "<div class='bg_title'><" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . "></div>";
                }

                if ($module == "map") {
                    $compile .= "
                <div class='module_content'>
                    <div class='" . (($fullwidth_map == "yes") ? "fullwidth_map" : "") . "'>
                        " . do_shortcode(breaksToBR($content)) . "
                    </div>
                </div>";
                } elseif ($module == "html") {
                    $compile .= "
                <div class='module_content'>
                    " . do_shortcode($content) . "
                </div>";
                } else {
                    $compile .= "
                <div class='module_content'>
                    " . do_shortcode(breaksToBR($content)) . "
                </div>";
                }

                return $compile;
            }
        }
        add_shortcode($shortcodeName, 'shortcode_textarea');
    }
}




#Shortcode name
$shortcodeName="textarea";


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
$shortcode_textarea = new textarea();
$shortcode_textarea->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['textarea'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>