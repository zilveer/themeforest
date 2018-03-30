<?php
#Add featured image for posts
if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails', array('post', 'page', 'port', 'team', 'testimonials', 'partners', 'product'));
	add_theme_support('automatic-feed-links');
	add_theme_support( 'post-formats', array( 'image', 'video' ) );
}

#Support menus
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
		'main_menu' => 'Main menu',
		'footer_menu' => 'Footer menu'
		)
	);
}

#Enable shortcodes in sidebar
add_filter('widget_text', 'do_shortcode');


#add shortcode button to tinyMCE
function shortcode_button_reg($buttons) {
array_push($buttons, 'shortcodes');
return $buttons;
}
add_filter('mce_buttons', 'shortcode_button_reg', 0);

function shortcode_js_reg($plugin_array) {
$plugin_array['shortcodes'] = THEMEROOTURL.'/js/core/shortcodes.js';
return $plugin_array;
}
add_filter('mce_external_plugins', 'shortcode_js_reg');


/* MOOORE Excerpt length */
function custom_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


add_action('admin_head', 'for_title_and_caption_javascript');
function for_title_and_caption_javascript() {
    global $gt3_themeconfig;
?>
<script type="text/javascript" >

    <?php
        $compile = array();
        if ($gt3_themeconfig['custom_fonts'] == true) {
            if (is_array($gt3_themeconfig['custom_fonts_array'])) {
                foreach ($gt3_themeconfig['custom_fonts_array'] as $id => $font) {
                    array_push($compile, "'".$font['font_family']."'");
                }
                echo "var fontsarray = [".implode(",", $compile)."]";
            }
        } else {
            echo "var fontsarray = '';";
        }
    ?>

	jQuery('.gi_addtitle').live("click", function() { 
		var attach_id = jQuery(this).attr("attach_id");
		
		var data = {
			action: 'for_title_and_caption',
			post_id: post_id,
			attach_id: attach_id
		};

		jQuery.post(ajaxurl, data, function(response) {
			jQuery.colorbox({html:response});
		});
	});
</script>
<?php
}


#Set default values for home audio
$homeAudio = get_theme_option("mainSlider");
if (empty($homeAudio['1']['mp3']) && empty($homeAudio['1']['ogg'])) {
    $homeAudio['1']['mp3'] = "";
    $homeAudio['1']['ogg'] = "";
    update_theme_option("mainSlider", $homeAudio);
}


#ADD localization folder
add_action('init', 'enable_pomo_translation');
function enable_pomo_translation(){
    if( get_theme_option("translator_status") !== "enable" ){
        load_theme_textdomain( 'theme_localization', get_template_directory() . '/core/languages/' );
    }
}

?>