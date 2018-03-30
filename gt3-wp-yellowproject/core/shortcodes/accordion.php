<?php

#accordion_item
if (!function_exists("accordion_item")) {
    function accordion_item($atts, $content = null)
    {
        global $acctemmpi, $gt3_pbconfig;
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

        $compile .= "<h5 data-count='" . $acctemmpi . "' class='shortcode_accordion_item_title expanded_" . $expanded_state . "'>" . $title . "<span class='ico'></span></h5><div class='shortcode_accordion_item_body'><div class='ip'>" . $content . "</div></div>";

        $acctemmpi++;

        return $compile;
    }
}

add_shortcode('accordion_item', 'accordion_item');


class accordion_shortcode
{

    public function register_shortcode($shortcodeName)
    {
        if (!function_exists("shortcode_accordion_shortcode")) {
            function shortcode_accordion_shortcode($atts, $content = null)
            {
                global $gt3_pbconfig, $acctemmpi;
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

                $acctemmpi = 1;

                #heading
                if (strlen($heading_color) > 0) {
                    $custom_color = "color:#{$heading_color};";
                }
                if (strlen($heading_text) > 0) {
                    $compile .= "<" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
                }

                wp_enqueue_script('jquery-ui-accordion');

                $compile .= "
                <div class='shortcode_accordion_shortcode accordion'>" . do_shortcode($content) . "</div>
			";

                return $compile;
            }
        }

        add_shortcode($shortcodeName, 'shortcode_accordion_shortcode');
    }
}


#Shortcode name
$shortcodeName = "accordion_shortcode";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_" . $shortcodeName . "'>" . $defaultUI . "</div>";

#Your code
$compileShortcodeUI .= "
No parameters.

<script>
	function " . $shortcodeName . "_handler() {
	
		/* YOUR CODE HERE */
		var type = jQuery('." . $shortcodeName . "_type').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[" . $shortcodeName . "][accordion_item title=\"some title here\"]some text here[/accordion_item][/" . $shortcodeName . "]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_" . $shortcodeName . "').html(compileline);
	}
</script>

";


#Register shortcode & set parameters
$accordion_shortcode = new accordion_shortcode();
$accordion_shortcode->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['accordion_shortcode'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>