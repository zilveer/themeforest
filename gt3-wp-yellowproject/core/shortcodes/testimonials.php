<?php

class testimonials_shortcode
{

    public function register_shortcode($shortcodeName)
    {
        if (!function_exists("shortcode_testimonials")) {
            function shortcode_testimonials($atts, $content = null)
            {

                global $gt3_pbconfig;
                if (!isset($compile)) {
                    $compile = '';
                }

                extract(shortcode_atts(array(
                    'heading_size' => $gt3_pbconfig['default_heading_in_module'],
                    'heading_color' => '',
                    'heading_text' => '',
                    'display_type' => 'type1',
                    'width' => '',
                    'float' => 'none',
                    'number_of_testimonials' => 1,
                    'sorting_type' => "new",
                ), $atts));

                #heading
                if (strlen($heading_color) > 0) {
                    $custom_color = "color:#{$heading_color};";
                }
                if (strlen($heading_text) > 0) {
                    $compile .= "<" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
                }

                #types converter
                switch ($display_type) {
                    case "type1":
                        $echotype = "dark_type";
                        break;
                    case "type2":
                        $echotype = "light_type";
                        break;
                }

                #sort converter
                switch ($sorting_type) {
                    case "new":
                        $sort_type = "post_date";
                        break;
                    case "random":
                        $sort_type = "rand";
                        break;
                }

                $compile .= "
			<div class='module_content blockquote testimonials_list items1 carouselslider' data-count='1'>
			    <ul>";
                $args = array(
                    'post_type' => "testimonials",
                    'orderby' => $sort_type,
                    'numberposts' => $number_of_testimonials,
                    'post_status' => 'publish');

                $posts = get_posts($args);
                if (is_array($posts)) {
                    foreach ($posts as $post) {
                        $testimonials_author = get_post_meta($post->ID, "testimonials_author", true);
                        $testimonials_position = get_post_meta($post->ID, "testimonials_position", true);
                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');

                        if (strlen($testimonials_position) > 0) {
                            $coma = ",";
                        } else {
                            $coma = "";
                        }

                        $compile .= "
                            <li>
                                <div class='item'>
                                    <div class='testimonials_photo'>
                                        " . (strlen($featured_image[0]) > 0 ? "<img src='" . aq_resize($featured_image[0], 80, 80, true, true, true) . "' class='testimonials_ava grey_img'>" : "<img src='" . IMGURL . "/core/testimonials.jpg'  class='testimonials_ava grey_img'>") . "
                                    </div>
									<div class='testimonials_text'>
									    <h6>" . (strlen($testimonials_author) > 0 ? "{$testimonials_author}" : "") . (strlen($testimonials_position) > 0 ? ", <span class='text_light'>{$testimonials_position}</span>" : "") . "</h6>
										" . $post->post_content . "
									</div>
                                </div>
                            </li>
                        ";
                    }
                }

                $compile .= "    </ul>
			</div>";

                return $compile;

            }
        }

        add_shortcode($shortcodeName, 'shortcode_testimonials');
    }
}


#Shortcode name
$shortcodeName = "testimonials";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_" . $shortcodeName . "'>" . $defaultUI . "</div>";

#Your code
$compileShortcodeUI .= "
Container width: <input style='width:60px;text-align:center;' value='50%' type='text' class='" . $shortcodeName . "_width' name='" . $shortcodeName . "_width'> (% or px).<br>
Float: 
<select style='' name='" . $shortcodeName . "_float' class='" . $shortcodeName . "_float'>
	<option value='left'>Left</option>
	<option value='right'>Right</option>
</select><br>
Author: <input value='' type='text' class='" . $shortcodeName . "_author' name='" . $shortcodeName . "_author'>
<br>
Author position: <input value='' type='text' class='" . $shortcodeName . "_author_position' name='" . $shortcodeName . "_author_position'>


<script>
	function " . $shortcodeName . "_handler() {
	
		/* YOUR CODE HERE */
		
		var author = jQuery('." . $shortcodeName . "_author').val();
		var width = jQuery('." . $shortcodeName . "_width').val();
		var float = jQuery('." . $shortcodeName . "_float').val();
		var author_position = jQuery('." . $shortcodeName . "_author_position').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[" . $shortcodeName . " author=\"'+author+'\" author_position=\"'+author_position+'\" width=\"'+width+'\" float=\"'+float+'\"][/" . $shortcodeName . "]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_" . $shortcodeName . "').html(compileline);
	}
</script>

";


#Register shortcode & set parameters
$testimonials = new testimonials_shortcode();
$testimonials->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['testimonials'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>