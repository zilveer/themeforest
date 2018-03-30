<?php

#toggles_item
if (!function_exists("toggles_item")) {
    function toggles_item($atts, $content = null)
    {

        global $toggtemmpi, $gt3_pbconfig;
        if (!isset($compile)) {
            $compile = '';
        }

        extract(shortcode_atts(array(
            'heading_size' => $gt3_pbconfig['default_heading_in_module'],
            'heading_color' => '',
            'heading_text' => '',
            'title' => '',
            'expanded_state' => '',
        ), $atts));


        $compile .= "<h5 data-count='" . $toggtemmpi . "' class='shortcode_toggles_item_title expanded_" . $expanded_state . "'>" . $title . "<span class='ico'></span></h5><div class='shortcode_toggles_item_body'><div class='ip'>" . $content . "</div></div>";

        $toggtemmpi++;

        return $compile;

        //wp_enqueue_script('toggle', get_template_directory_uri() . '/js/toggle.js');

    }
}
add_shortcode('toggles_item', 'toggles_item');



class toggles_shortcode {

	public function register_shortcode($shortcodeName) {
        if (!function_exists("shortcode_toggles_shortcode")) {
            function shortcode_toggles_shortcode($atts, $content = null)
            {

                global $gt3_pbconfig, $toggtemmpi;
                if (!isset($compile)) {
                    $compile = '';
                }

                extract(shortcode_atts(array(
                    'heading_size' => $gt3_pbconfig['default_heading_in_module'],
                    'heading_color' => '',
                    'heading_text' => '',
                    'title' => '',
                ), $atts));

                $toggtemmpi = 1;

                #heading
                if (strlen($heading_color) > 0) {
                    $custom_color = "color:#{$heading_color};";
                }
                if (strlen($heading_text) > 0) {
                    $compile .= "<" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
                }

                $compile .= "<div class='shortcode_toggles_shortcode toggles'>" . do_shortcode($content) . "</div>";

                return $compile;
            }
        }
		add_shortcode($shortcodeName, 'shortcode_toggles_shortcode');
	}
}




#Shortcode name
$shortcodeName="toggles_shortcode";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
No parameters.

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		var type = jQuery('.".$shortcodeName."_type').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName."][toggles_item title=\"some title here\"]some text here[/toggles_item][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$toggles_shortcode = new toggles_shortcode();
$toggles_shortcode->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['toggles_shortcode'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>