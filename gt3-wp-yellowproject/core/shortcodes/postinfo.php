<?php

class postinfo_shortcode {

	public function register_shortcode($shortcodeName) {
        if (!function_exists("shortcode_postinfo")) {
            function shortcode_postinfo($atts, $content = null)
            {
                global $gt3_pbconfig, $post;
                if (!isset($compile)) {
                    $compile = '';
                }
                extract(shortcode_atts(array(
                    'heading_size' => $gt3_pbconfig['default_heading_in_module'],
                    'heading_color' => '',
                    'heading_text' => '',
                    'proj_option_title1' => '',
                    'proj_option_desc1' => '',
                    'proj_option_title2' => '',
                    'proj_option_desc2' => '',
                    'project_date' => '',
                    'project_time_spent' => '',
                    'view_type' => '',
                    'show_categories' => 'yes',
                    'show_share_buttons' => 'yes'
                ), $atts));

                #heading
                if (strlen($heading_color) > 0) {
                    $custom_color = "color:#{$heading_color};";
                }
                if (strlen($heading_text) > 0) {
                    $compile .= "<" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
                }

                $pf = get_post_format();
                if (empty($pf)) $pf = "text";
                $show_cat = false;

                $compile .= '
            <div class="' . $view_type . '">
                <div class="portfolio_date portfolio_info_item">
                    <span class="post_type post_type_' . $pf . '"></span>' . $project_date . '
                </div>';

                if ($show_categories == "yes") {

                    if (get_post_type($post->ID) == "port") {
                        $terms = get_the_terms($post->ID, 'portcat');
                        if ($terms && !is_wp_error($terms)) {
                            $draught_links = array();
                            foreach ($terms as $term) {
                                $draught_links[] = '<a href="' . get_term_link($term->slug, "portcat") . '">' . $term->name . '</a>';
                            }
                            $on_draught = join(", ", $draught_links);
                            $show_cat = true;
                        }
                    }
                    if ($show_cat == true) {
                        $compile .= '<div class="portfolio_categ portfolio_info_item"><span>Categories: </span>' . $on_draught . '</div>';
                    }
                }

                if (strlen($proj_option_title1) > 0 || strlen($proj_option_desc1) > 0) {
                    $compile .= '
                <div class="portfolio_skills portfolio_info_item"><span>' . $proj_option_title1 . ' </span>' . $proj_option_desc1 . '</div>
                ';
                }

                if (strlen($proj_option_title2) > 0 || strlen($proj_option_desc2) > 0) {
                    $compile .= '
                <div class="portfolio_url portfolio_info_item"><span>' . $proj_option_title2 . ' </span>' . $proj_option_desc2 . '</div>
                ';
                }

                if (strlen($project_time_spent) > 0) {
                    $compile .= '
                <div class="portfolio_skills portfolio_info_item"><span>Time spent: </span>' . $project_time_spent . '</div>
                ';
                }

                if ($show_share_buttons == "yes") {
                    $compile .= '
                    <div class="portfolio_share">
                        <a href="http://www.facebook.com/share.php?u=' . get_permalink() . '" class="ico_socialize_facebook2 ico_socialize type2"></a>
                        <a href="https://twitter.com/intent/tweet?url=' . get_permalink() . '" class="ico_socialize_twitter2 ico_socialize type2"></a>
                        <a href="https://plus.google.com/share?url=' . get_permalink() . '" class="ico_socialize_google2 ico_socialize type2"></a>
                        <a href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '" class="ico_socialize_pinterest ico_socialize type2"></a>
                        <div class="clear"><!-- ClearFix --></div>
                    </div>
                    ';
                }

                $compile .= '
                <div class="clear"><!-- ClearFIX --></div>
            </div>
            ';

                return $compile;
            }
        }
		add_shortcode($shortcodeName, 'shortcode_postinfo');  
	}
}




#Shortcode name
$shortcodeName="postinfo";

#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#This function is executed each time when you click "Insert" shortcode button.
$compileShortcodeUI .= "
This shortocode comes with no parameters.

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName."][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";




#Register shortcode & set parameters
$postinfo = new postinfo_shortcode();
$postinfo->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['postinfo'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);


?>