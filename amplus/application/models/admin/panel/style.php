<?php
class BFIAdminPanelStyleModel extends BFIAdminPanelModel implements iBFIAdminPanel {
	function __construct() {
		$this->priority = 9;
		$this->menuName = 'Style';
		$this->showSaveButtons = true;
		$this->additionalHTML = '';
		parent::__construct();
	}
	
	public function createOptions() {		 
		
		$this->addOption(array(
			"name" => "Table of Contents",
			"desc" => "Since there are a lot of settings which can be changed, here's a table of contents to help you navigate. Remember to save the changes you've made to apply your changes to the theme.",
			"type" => "toc",
			));
			
				// this is important since this is checked when generating the css file for proper caching
		$this->addOption(array(
			"id" => "css_last_save",
			"type" => "HiddenTimestamp",
			"std" => date("U"),
			));
		
		$this->addOption(array(
			"name" => "Additional CSS Settings",
			"top" => true,
			"type" => "heading",
			));
		
		$this->addOption(array(
			"name" => "Custom CSS",
			"type" => "textarea",
			"desc" => "Additional CSS rules can be placed here. If you've placed a CSS rule and it doesn't get followed, there is a possiblity that the theme is overwriting your CSS rule. If this happens, use the term <strong>!important</strong> (with the exclamation mark) at the end of your rule so that it becomes the highest priority rule. For example:<br><br><em>.myclass {<br>&nbsp; &nbsp; margin-left: 30px <strong>!important</strong>;<br>}</em>",
			"id" => "style_custom_css",
			"std" => "",
			));
		
		$this->addOption(array(
			"type" => "save",
			));
		
		$this->addOption(array(
			"name" => "Font Heading Settings",
			"top" => true,
			"type" => "heading",
			));
		
		$this->addOption(array(
			"name" => "Heading Font Type",
			"id" => "heading_font_type",
			"type" => "select",
			"options" => array("Google WebFonts", "Don't Use Any"),
			"values" => array("googlewebfont", "disabled"),
			"std" => "googlewebfont",
			"hasmore" => true
			));
			
		
		$this->addOption(array(
			"name" => "Google WebFont",
			"id" => "style_googlefont",
			"type" => "selectGoogleWebFont",
			"std" => "Titillium+Web:regular",
			"depends" => array("heading_font_type" => "googlewebfont"),
			));
			
		$this->addOption(array(
			"type" => "save",
			));




    	$this->addOption(array(
			"name" => "General Theme Color Settings",
			"type" => "heading",
			"top" => true,
			));
			
		$this->addOption(array(
			"name" => "Theme color",
			"type" => "colorpicker",
			"desc" => "This is the background of the various items in the theme such as menu borders and buttons",
			"id" => "style_cta_bg_color",
			"std" => "#3f94e4", //498FC1
			));

		$this->addOption(array(
			"name" => "Themed text color",
			"type" => "colorpicker",
			"desc" => "This is the text color of the various items in the theme such as button text. Select a color that contrasts with the <strong>theme color</strong>.",
			"id" => "style_cta_text_color",
			"std" => "#ffffff",
			));

		$this->addOption(array(
			"name" => "Theme Foreground Color",
			"type" => "colorpicker",
			"desc" => "",
			"id" => "style_foreground_color",
			"std" => "#dedede",
			));

		$this->addOption(array(
			"name" => "Default Pagemedia",
			"type" => "SelectPageMedia",
			"desc" => "This is the default page media to use for pages with no pagemedia (e.g. 404 page, search page, archives, etc).",
			"id" => "style_default_pagemedia",
			"std" => "none",
			));
			
			
			
		$this->addOption(array(
			"type" => "save",
			));	




		$this->addOption(array(
			"name" => "Top Menu Settings",
			"type" => "heading",
			"top" => true,
			));
			
		$this->addOption(array(
			"name" => "Top Menu Background Color",
			"type" => "colorpicker",
			"desc" => "The background color for the top menu bar (this is also the color of the bottom bar)",
			"id" => "style_topmenu_bg_color",
			"std" => "#000000",
			));
			
		$this->addOption(array(
			"name" => "Top Menu Text Color",
			"type" => "colorpicker",
			"desc" => "The text color for the top menu bar (this is also the color of the text of the bottom bar)",
			"id" => "style_topmenu_text_color",
			"std" => "#ffffff",
			));
			
		$this->addOption(array(
			"name" => "Top Menu Height",
			"type" => "number",
			"desc" => "The height of the top menu bar in pixels",
			"id" => "style_topmenu_height",
			"std" => "50",
			"placeholder" => "Height in pixels"
			));
        
		
    	$this->addOption(array(
    		"name" => "Top Menu bar opacity",
    		"type" => "number",
    		"desc" => "The opacity of the top menu bar. Value should be 0.0 to 1.0. If 0.0, the background color will be fully transparent",
    		"id" => "style_topmenu_opacity",
    		"std" => "1.0",
    		"placeholder" => "Opacity 0.0-1.0"
    		));

		$this->addOption(array(
			"type" => "save",
			));





		$this->addOption(array(
			"name" => "Background Settings",
			"type" => "heading",
			"top" => true,
			));
			
		$this->addOption(array(
			"name" => "Tip",
			"type" => "note",
			"desc" => "You can tint your background image by setting the <strong>background color</strong> then changing your <strong>background image opacity</strong> to a value below 1.0. You can also try ticking the <strong>invert background</strong> option for most library patterns.",
			));
			
		$this->addOption(array(
			"name" => "Background color",
			"type" => "colorpicker",
			"desc" => "The background color of the site. This can be hidden by the page media.",
			"id" => "style_background_color",
			"std" => "#54acf0",
			));
			
		$this->addOption(array(
			"name" => "Background gradient opacity",
			"type" => "number",
			"desc" => "The strength of the theme's dark gradient shadows",
			"id" => "style_background_gradient_opacity",
			"std" => "0.6",
			"placeholder" => "Opacity 0.0 to 1.0",
			));
			
		$this->addOption(array(
			"name" => "Background type",
			"type" => "select",
			"options" => array("Select a background pattern from the library", "Upload your own background"),
			"values" => array("library", "upload"),
			"desc" => "Choose whether to select a background pattern from the theme library, or to upload your own background image",
			"id" => "style_background",
			"std" => "library",
			"hasmore" => true,
			));
			
		$this->addOption(array(
			"depends" => array("style_background" => "library"),
			"name" => "Background Pattern",
			"type" => "select",
			"options" => array("BG Noise", "Bo Play Pattern", "Bright Squares", "Climpek", "Dark Denim 3", "Denim", "Diamond Upholstery", "Furley", "GPlay Pattern", "Graphy", "Grey", "Hexellence", "Inflicted", "Irongrip", "Light Honeycomb", "Light Noise Diagonal", "Light Wool", "Low Contrast Linen", "Noisy Grid", "Old Mathematics", "PX by Gre3g", "Subtle Zebra 3d", "Vichy", "Whitey", "Wood #1", "Wood #2", "Wood #3", "Wood #4", "Wood #5 (Dark)", "XV"),
			"values" => array("bgnoise_lg", "bo_play_pattern", "bright_squares", "climpek", "darkdenim3", "denim", "diamond_upholstery", "furley_bg", "gplaypattern", "graphy", "grey", "hexellence", "inflicted", "irongrip", "light_honeycomb", "light_noise_diagonal", "light_wool", "low_contrast_linen", "noisy_grid", "old_mathematics", "px_by_Gre3g", "subtle_zebra_3d", "vichy", "whitey", "purty_wood", "retina_wood", "tileable_wood_texture", "wood_pattern", "dark_wood", "xv"),
			"desc" => "Select a background pattern from the list.<bR><br><strong>Almost ALL of the background patterns are grayscale, you can add color to the patterns by selecting a <u>background color</u> above and setting the <u>opacity</u> below to less than 1.0</strong>",
			"id" => "style_background_pattern",
			"std" => "hexellence",
			"hasmore" => true,
			));
			
		$this->addOption(array(
			"depends" => array("style_background" => "library", "style_background_pattern" => array("bgnoise_lg", "bright_squares", "climpek", "diamond_upholstery", "furley_bg", "gplaypattern", "graphy", "grey", "hexellence", "inflicted", "light_honeycomb", "light_noise_diagonal", "light_wool", "low_contrast_linen", "noisy_grid", "old_mathematics", "px_by_Gre3g", "subtle_zebra_3d", "vichy", "whitey", "xv")),
			"name" => "Invert Background",
			"type" => "boolean",
			"desc" => "Inverting the pattern grayscale results in a different effect when adding color via the opacity option below, try enabling/disabling this option and see the changes.",
			"id" => "style_background_pattern_invert",
			"std" => true,
			));
			
		$this->addOption(array(
			"depends" => array("style_background" => "upload"),
			"name" => "Background image",
			"type" => "upload",
			"desc" => "Background image. This will be fixed behind the page.<br><br><strong><em>Be sure to upload an image that's at MOST 1024x768 AND less than 2MB</em></strong>",
			"id" => "style_background_image",
			"std" => "",
			));
			
		$this->addOption(array(
			"depends" => array("style_background" => "upload"),
			"name" => "Background image type",
			"type" => "select",
			"options" => array("Stretched Image", "Repeating Pattern"),
			"values" => array("stretch", "pattern"),
			"desc" => "Choose whether the background image will be stretched the whole width of the page, or if the image is a repeating pattern.",
			"id" => "style_background_type",
			"std" => "stretch",
			"hasmore" => true,
			));

        // $this->addOption(array(
        //          "depends" => array("style_background_type" => "stretch", "style_background" => "upload"),
        //          "name" => "Background image blur",
        //          "type" => "select",
        //          "options" => array("No blur", "5", "10", "15", "20", "30", "40", "60", "80", "100"),
        //          "values" => array(0, 5, 10, 15, 20, 30, 40, 60, 80, 100),
        //          "id" => "style_background_blur",
        //          "std" => "40",
        //          "desc" => "The amount of blur to apply to the background image.<br><br><strong><em>Changing this value will delay the loading time of the site ONCE, because the resizer will render it for the first time.</em></strong>",
        //          ));

        $this->addOption(array(
			"name" => "Background image opacity",
			"type" => "number",
			"id" => "style_background_opacity",
			"std" => "0.6",
			"placeholder" => "0.0 to 1.0",
			"desc" => "The opacity of the background image. Setting this less than 1.0 will show a bit of the background color.<br><br><em>This is helpful for adding a bit of tint on the image</em>",
			));
			
		$this->addOption(array(
			"type" => "save",
			));




			
		$this->addOption(array(
			"name" => "Footer Color Settings",
			"type" => "heading",
			"top" => true,
			));

		$this->addOption(array(
			"name" => "Footer widget headings color",
			"type" => "colorpicker",
			"desc" => "The color of footer headings in widgets on the footer",
			"id" => "style_footer_headings_color",
			"std" => "#363636",
			));

		$this->addOption(array(
			"name" => "Footer widget text color",
			"type" => "colorpicker",
			"desc" => "The color of footer text in widgets on the footer",
			"id" => "style_footer_text_color",
			"std" => "#525252",
			));

		$this->addOption(array(
			"name" => "Footer widget link color",
			"type" => "colorpicker",
			"desc" => "The color of links in widgets on the footer. <em>The hover color of the links is the normal text color.</em>",
			"id" => "style_footer_link_color",
			"std" => "#2a82d4",
			));

		$this->addOption(array(
			"name" => "Footer decor color",
			"type" => "colorpicker",
			"desc" => "The color of the decorations (lines, bullets, etc) on the footer",
			"id" => "style_footer_decor_color",
			"std" => "#3b3b3b",
			));

		$this->addOption(array(
			"name" => "Footer bar background color",
			"type" => "colorpicker",
			"desc" => "The background color of the copyright and social area",
			"id" => "style_footer_copyright_bg_color",
			"std" => "#111111",
			));

		$this->addOption(array(
			"name" => "Footer bar copyright text color",
			"type" => "colorpicker",
			"desc" => "The text color of the copyright and social area",
			"id" => "style_footer_copyright_text_color",
			"std" => "#ffffff",
			));
			
    	$this->addOption(array(
    		"name" => "Footer bar opacity",
    		"type" => "number",
    		"desc" => "The opacity of the footer bar. Value should be 0.0 to 1.0. If 0.0, the background color will be fully transparent",
    		"id" => "style_footer_bar_opacity",
    		"std" => "1.0",
    		"placeholder" => "Opacity 0.0-1.0"
    		));
	}
}
?>
