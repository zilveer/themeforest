<?php

class blog_shortcode
{

    public function register_shortcode($shortcodeName) {
        if (!function_exists("shortcode_blog")) {
            function shortcode_blog($atts, $content = null)
            {
                global $gt3_pbconfig;
                if (!isset($compile)) {
                    $compile = '';
                }
                extract(shortcode_atts(array(
                    'heading_size' => $gt3_pbconfig['default_heading_in_module'],
                    'heading_color' => '',
                    'heading_text' => '',
                    'posts_per_page' => '10',
                    'category' => 'all',
                    'masonry_blog' => 'no',
                ), $atts));

                #heading
                if (strlen($heading_color) > 0) {
                    $custom_color = "color:#{$heading_color};";
                }
                if (strlen($heading_text) > 0) {
                    echo "<" . $heading_size . " style='" . $custom_color . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
                }

                global $wp_query_in_shortcodes, $paged;

                if (empty($paged)) {
                    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                }

                $wp_query_in_shortcodes = new WP_Query();
                $args = array(
                    'post_type' => 'post',
                    'paged' => $paged,
                    'posts_per_page' => $posts_per_page,
                );

                if ($category !== "all" && $category !== "") {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => $category
                        )
                    );
                }

                $wp_query_in_shortcodes->query($args);

                while ($wp_query_in_shortcodes->have_posts()) : $wp_query_in_shortcodes->the_post();

                    get_template_part("bloglisting");

                endwhile;

                get_pagination("10", "show_in_shortcodes");

                wp_reset_query();

                return $compile;
            }
        }
        add_shortcode($shortcodeName, 'shortcode_blog');
    }
}


#Shortcode name
$shortcodeName = "blog";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_" . $shortcodeName . "'>" . $defaultUI . "</div>";

#Your code
$compileShortcodeUI .= "
Type:
<select name='" . $shortcodeName . "_blog_type' class='" . $shortcodeName . "_blog_type'>
	<option value='type1'>Low</option>
	<option value='type2'>Bold light</option>
	<option value='type3'>Bold colored</option>
	<option value='type4'>Bold dark</option>
</select>

<script>
	function " . $shortcodeName . "_handler() {

		/* YOUR CODE HERE */

		var blog_type = jQuery('." . $shortcodeName . "_blog_type').val();

		/* END YOUR CODE */

		/* COMPILE SHORTCODE LINE */
		var compileline = '[" . $shortcodeName . " type=\"'+blog_type+'\"][/" . $shortcodeName . "]';

		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_" . $shortcodeName . "').html(compileline);
	}
</script>

";


#Register shortcode & set parameters
$blog = new blog_shortcode();
$blog->register_shortcode($shortcodeName);

#add shortcode to wysiwyg
#$shortcodesUI['blog'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>