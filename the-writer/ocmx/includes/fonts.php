<?php
/********************/
/* Add § options */
function ocmx_load_font_options(){
	global $theme_options, $ocmx_fonts;

	$theme_options["font_options"] = array("elements" =>
			array(
				array("label" => "General", "description" => "", "name" => "ocmx_general_font", "default" => "", "id" => "ocmx_general_font", "input_type" => "font", "elements" => "body"),
				array("label" => "Navigation", "description" => "", "name" => "ocmx_navigation_font", "default" => "", "id" => "ocmx_navigation_font", "input_type" => "font", "elements" => "ul#nav li a"),
				array("label" => "Page Title", "description" => "", "name" => "ocmx_page_title_font", "default" => "", "id" => "ocmx_page_title_font", "input_type" => "font", "elements" => ".title-block h2"),
				array("label" => "Post Meta", "description" => "", "name" => "ocmx_post_meta_font", "default" => "", "id" => "ocmx_post_meta_font", "input_type" => "font", "elements" => ".date"),
				array("label" => "Post Titles", "description" => "", "name" => "ocmx_post_titles_font", "default" => "", "id" => "ocmx_post_titles_font", "input_type" => "font", "elements" => ".post-title, .post-title a"),
				array("label" => "Post Copy", "description" => "", "name" => "ocmx_post_copy_font", "default" => "", "id" => "ocmx_post_copy_font", "input_type" => "font", "elements" => "p, .copy"),
				array("label" => "Widget Titles", "description" => "", "name" => "ocmx_widget_titles_font", "default" => "", "id" => "ocmx_widget_titles_font", "input_type" => "font", "elements" => ".widgettitle, .widgettitle a, .section-title, .section-title a"),
				array("label" => "Footer Widget Titles", "description" => "", "name" => "ocmx_widget_footer_titles_font", "default" => "", "id" => "ocmx_widget_footer_titles_font", "input_type" => "font", "elements" => ".footer-three-column .column h4, .footer-three-column .column h4 a")
			)
		);
	if(!isset($style))
		$style = "";
	$ocmx_fonts = array(
		array("label" => "Theme Default", "css" => get_option("ocmx_post_".$style."_font_style_default"), "type" => ""),
		array("label" => "Arial", "css" => "Arial, Helvetica, sans-serif", "type" => "Sans Serif"),
		array("label" => "Georgia", "css" => "Georgia, Times New Roman, serif", "type" => "Serif"),
		array("label" => "Droid Sans", "css" => "Droid Sans", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold&subset=latin"),
		array("label" => "Droid Serif", "css" => "Droid Serif", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic&subset=latin"),
		array("label" => "Nobile", "css" => "Nobile", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Nobile:regular,italic,bold,bolditalic&subset=latin"),
		array("label" => "Yanone Kaffeesatz", "css" => "Yanone Kaffeesatz", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:extralight,light,bold&subset=latin"),
		array("label" => "PT Sans", "css" => "PT Sans", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic&subset=latin"),
		array("label" => "Reenie Beanie", "css" => "Reenie Beanie", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Reenie+Beanie&subset=latin"),
		array("label" => "Tangerine", "css" => "Tangerine", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Tangerine:regular,bold&subset=latin"),
		array("label" => "OFL Sorts Mill Goudy TT", "css" => "OFL Sorts Mill Goudy TT", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT:regular,italic&subset=latin"),
		array("label" => "Molengo", "css" => "Molengo", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Molengo&subset=latin"),
		array("label" => "Vollkorn", "css" => "Vollkorn", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Vollkorn:regular,italic,bold,bolditalic&subset=latin"),
		array("label" => "Cantarell", "css" => "Cantarell", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Cantarell:regular,italic,bold,bolditalic&subset=latin"),
		array("label" => "Inconsolata", "css" => "Inconsolata", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Inconsolata&subset=latin"),
		array("label" => "Crimson Text", "css" => "Crimson Text", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Crimson+Text&subset=latin"),
		array("label" => "Arvo", "css" => "Arvo", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Arvo:regular,italic,bold,bolditalic&subset=latin"),
		array("label" => "Cardo", "css" => "Cardo", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Cardo&subset=latin"),
		array("label" => "Neucha", "css" => "Neucha", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Neucha&subset=latin"),
		array("label" => "Neuton", "css" => "Neuton", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Neuton&subset=latin"),
		array("label" => "Cuprum", "css" => "Cuprum", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Cuprum&subset=latin"),
		array("label" => "Droid Sans Mono", "css" => "Droid Sans Mono", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Droid+Sans+Mono&subset=latin"),
		array("label" => "Old Standard TT", "css" => "Old Standard TT", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Old+Standard+TT:regular,italic,bold&subset=latin"),
		array("label" => "Philosopher", "css" => "Philosopher", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Philosopher&subset=latin"),
		array("label" => "IM Fell English", "css" => "IM Fell English", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=IM+Fell+English:regular,italic&subset=latin"),
		array("label" => "Josefin Sans", "css" => "Josefin Sans", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Josefin+Sans:100,100italic,light,lightitalic,regular,regularitalic,600,600italic,bold,bolditalic&subset=latin"),
		array("label" => "Arimo", "css" => "Arimo", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Arimo:regular,italic,bold,bolditalic&subset=latin"),
		array("label" => "Tinos", "css" => "Tinos", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Tinos:regular,italic,bold,bolditalic&subset=latin"),
		array("label" => "Josefin Slab", "css" => "Josefin Slab", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Josefin+Slab:100,100italic,light,lightitalic,regular,regularitalic,600,600italic,bold,bolditalic&subset=latin"),
		array("label" => "Allerta", "css" => "Allerta", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Allerta&subset=latin"),
		array("label" => "Allerta Stencil", "css" => "Allerta Stencil", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Allerta+Stencil&subset=latin"),
		array("label" => "Geo", "css" => "Geo", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Geo&subset=latin"),
		array("label" => "Puritan", "css" => "Puritan", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Puritan:regular,italic,bold,bolditalic&subset=latin"),
		array("label" => "Bentham", "css" => "Bentham", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Bentham&subset=latin"),
		array("label" => "Cousine", "css" => "Cousine", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=Cousine:regular,italic,bold,bolditalic&subset=latin"),
		array("label" => "UnifrakturMaguntia", "css" => "UnifrakturMaguntia", "type" => "Serif", "stylesheetlink" => "http://fonts.googleapis.com/css?family=UnifrakturMaguntia&subset=latin")
	);
};
add_action("init", "ocmx_load_font_options" , 20);

/************************************/
/* Add colour Picker Script options */
function ocmx_font_script (){
	global $ocmx_fonts;
	if( is_array( $ocmx_fonts ) ) {
		foreach($ocmx_fonts as $font) :
			if(isset($font["stylesheetlink"])) :
				$font_slug = str_replace(" ", "-", $font["label"]);
				wp_enqueue_style($font_slug, $font["stylesheetlink"]);
			endif;
		endforeach;
	}
	wp_enqueue_script( "jquery-fonts", get_template_directory_uri()."/scripts/fonts.js", array('jquery', 'jquery-ui-core'));
	wp_enqueue_script( "interface" );
};
if(isset($_REQUEST["page"]) && $_REQUEST["page"] == "ocmx-fonts") :
	add_action("init", "ocmx_font_script");
endif;

/********************************/
/* Add it to the OCMX Interface */
function ocmx_font_options(){

	$ocmx_tabs = array(
					array(
						  "option_header" => "Typography",
						  "use_function" => "ocmx_font_form",
						  "function_args" => "font_options",
						  "ul_class" => "contained-forms-large clearfix"
					  ),
					array(
						  "option_header" => "Overview",
						  "use_function" => "ocmx_font_overview",
						  "function_args" => "",
						  "ul_class" => "contained-forms-large clearfix"
					  ),
				);
	$ocmx_container = new OCMX_Container();
	$ocmx_container->load_container("Font Customization ", $ocmx_tabs);
};

/*************************************/
/* Add font colours on the Front end */
function ocmx_load_fonts(){
	global $theme_options, $ocmx_fonts;
		$css = "";
		foreach($theme_options["font_options"]["elements"] as $font_option => $detail) :
			$option = $detail["name"];
			$color = $option."_color";
			$size = $option."_size";
			$typo =  $option."_style";
			$font_css = "";

			if(get_option($color) != "" && get_option($color."_default") != get_option($color)) :
				$font_css .= "color: ".get_option($color)."; ";
			endif;
			if(get_option($typo) != "" && get_option($typo."_default") != get_option($typo)) :
				$font_css .= "font-family: ".get_option($typo)."; ";
			endif;
			if(get_option($size) != "" && get_option($size) != "0" && get_option($size."_default") != get_option($size)) :
				$font_css .= "font-size: ".round(get_option($size), 0)."px; ";
			endif;
			if($font_css != "") :
				$font_css = $detail["elements"]."{".$font_css."} \n";
			endif;
			$css .= $font_css;
		endforeach;
		if($css != "") :
			echo "<style>".$css."</style>";
		endif;
}

function ocmx_remove_font_support(){
	delete_option("ocmx_font_support");
}

if(get_option("ocmx_font_support")) :
	add_action("wp_head", "ocmx_load_fonts");
	add_action("switch_theme", "ocmx_remove_font_support");
endif;

/****************************************************/
/* Add font stylesheet if we're using a Google Font */
function ocmx_font_stylesheet(){
	global $theme_options, $ocmx_fonts;
	if( is_array( $theme_options["font_options"]["elements"] ) ) {
		foreach($theme_options["font_options"]["elements"] as $font_option => $detail) :
			$option = $detail["name"];
			$color = $option."_color";
			$size = $option."_size";
			$typo =  $option."_style";
			foreach($ocmx_fonts as $font) :
				if(get_option($typo) == $font["css"] && (isset($font["stylesheetlink"]) && $font["stylesheetlink"] != "")) :
					$font_slug = str_replace(" ", "-", $font["label"]);
					wp_enqueue_style($font_slug, $font["stylesheetlink"]);
				endif;
			endforeach;
		endforeach;
	}
}
add_action("init", "ocmx_font_stylesheet", 30);