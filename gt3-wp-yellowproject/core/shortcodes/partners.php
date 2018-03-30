<?php

class partners_shortcode
{
    public function register_shortcode($shortcodeName)
    {
        if (!function_exists("shortcode_partners")) {
            function shortcode_partners($atts, $content = null)
            {
                global $gt3_pbconfig;
                extract(shortcode_atts(array(
                    'heading_size' => $gt3_pbconfig['default_heading_in_module'],
                    'heading_color' => '',
                    'heading_text' => '',
                    'number' => '6',
                    'url' => '',
                ), $atts));

                #heading
                if (strlen($heading_color) > 0) {
                    $custom_color = "color:#{$heading_color};";
                } else {
                    $custom_color = '';
                }
                if (strlen($heading_text) > 0) {
                    echo "<" . $heading_size . " style='" . $custom_color . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
                }

                $wp_query = new WP_Query();
                $args = array(
                    'post_type' => 'partners',
                    'order' => 'DESC',
                    'posts_per_page' => -1,
                );

                $wp_query->query($args);

                $compile = '<div class="module_content carouselslider sponsors_works items' . $number . '" data-count="' . $number . '"><ul>';

                while ($wp_query->have_posts()) : $wp_query->the_post();
                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                    if (strlen($featured_image[0]) > 0) {
                        $featured_image_url = $featured_image[0];
                    } else {
                        $featured_image_url = IMGURL . '/wbg.jpg';
                    }

                    $partners_url = get_post_meta(get_the_ID(), "partners_url", true);

                    $compile .= '
                <li>
                    <div class="item">
                        ' . (strlen($partners_url) > 0 ? "<a href='{$partners_url}' target='_blank'>" : "") . '<img width="170" height="60" src="' . $featured_image_url . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" />' . (strlen($partners_url) > 0 ? "</a>" : "") . '
                    </div>
                </li>

            ';
                endwhile;

                $compile .= '</ul></div>';

                wp_reset_query();

                return $compile;
            }
        }

        add_shortcode($shortcodeName, 'shortcode_partners');
    }
}


#Shortcode name
$shortcodeName = "partners";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_" . $shortcodeName . "'>" . $defaultUI . "</div>";

#Your code
$compileShortcodeUI .= "
Type: 
<select name='" . $shortcodeName . "_partners_type' class='" . $shortcodeName . "_partners_type'>
	<option value='type1'>Low</option>
	<option value='type2'>Bold light</option>
	<option value='type3'>Bold colored</option>
	<option value='type4'>Bold dark</option>
</select>

<script>
	function " . $shortcodeName . "_handler() {
	
		/* YOUR CODE HERE */
		
		var partners_type = jQuery('." . $shortcodeName . "_partners_type').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[" . $shortcodeName . " type=\"'+partners_type+'\"][/" . $shortcodeName . "]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_" . $shortcodeName . "').html(compileline);
	}
</script>

";


#Register shortcode & set parameters
$partners = new partners_shortcode();
$partners->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['partners'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>