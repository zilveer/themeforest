<?php



	$options = array(

array( "name" => "Fonts",
		"type" => "section",
		"icon" => "edit-size-up.png",
		"id" 	 => ""
),
array( "type" => "open",
"id" 	 => "",
"std" => ""
),


array("name" => "Fonts for h1, h2 and h3",
"id" => '',
"desc" => "",
"type" => "subheading",
"std" => ""
),


array(
	"name" => "Font rendering method",
	"desc" => "Select which font-rendering method to use for h1, h2 and h3",
	"id" => $shortname."_title_font_rendering",
	"type" => "radiogroup",
	"options" => array(
			"cufon" => "Cufon font replacement",
			//"fontface" => "@fontface",
			"google" => "Google fonts",
			"websafe" => "Web safe fonts"

	),
	"std" => ""
),



array("name" => "Select cufon font",
"id" => $shortname."_cufon_title_font",
"desc" => "If you want to add another cufon font, simply upload it to /library/fonts/cufon in you theme directory, and it will automatically appear in this list.",
"type" => "selectvalue",
"std" => "",
"options" => $epic_cufon_fonts
),


array("name" => "Google font",
"id" => $shortname."_google_title_font",
"type" => "text",
"desc" => "Paste stylesheet link here. You can get the link at http://www.google.com/webfonts. Select from hundreds of great fonts",
"std" => ""
),

array("name" => "Google font font-family",
"id" => $shortname."_google_title_fontfamily",
"type" => "text",
"desc" => "Enter the name of the font-family you have chosen, i.e. font-family: 'Stardos Stencil', cursive; ",
"std" => ""

),

array("name" => "Web safe fonts",
"id" => $shortname."_websafe_title_font",
"type" => "select",
"std" => "",
"desc" => "Select font",
"options" =>  $epic_fonts
),

array("type" => "subclose", "id" => ""),

array("name" => "Fonts for body and paragraph",
"id" => '',
"desc" => "",
"type" => "subheading",
"std" => ""
),

array(
	"name" => "Text rendering method",
	"desc" => "Select which font-rendering method to use for paragraph and body",
	"id" => $shortname."_body_font_rendering",
	"type" => "radiogroup",
	"options" => array(
			//"fontface" => "@fontface",
			"google" => "Google fonts",
			"websafe" => "Web safe fonts"

	),
	"std" => ""
),





array("name" => "Google font",
"id" => $shortname."_body_google_font",
"type" => "text",
"desc" => "Paste stylesheet link here. You can get the link at http://www.google.com/webfonts. Select from hundreds of great fonts",
"std" => ""
),

array("name" => "Google font font-family",
"id" => $shortname."_body_google_fontfamily",
"type" => "fontselect",
"options" => $epic_googlefont_library,
"desc" => "Select the font family you want to use ",
"std" => ""

),

array("name" => "Websafe fonts",
"id" => $shortname."_body_websafe_font",
"type" => "",
"std" => "",
"desc" => "Select websafefont for paragraph text and text in body.",
"options" =>  $epic_fonts
),

array("type" => "subclose", "id" => "", "std" => ""),


array("name" => "Font sizes",
"id" => '',
"desc" => "Here you can specify font sizes without touching any css. Some text in the theme may not be editable here, depending on the child themes stylesheet. ",
"type" => "subheading",
"std" => ""
),

array("name" => "H1 font size",
"desc" => "Select value",
"id" => $shortname."_h1_size",
"options" => $epic_fontsizes,
"std" => "",
"size" => "_tiny",
"type" => "select",
),

array("name" => "H2 font size",
"desc" => "Select value",
"id" => $shortname."_h2_size",
"options" => $epic_fontsizes,
"std" => "",
"size" => "_tiny",
"type" => "select"
),

array("name" => "H3 font size",
"desc" => "Select value",
"id" => $shortname."_h3_size",
"options" => $epic_fontsizes,
"std" => "",
"size" => "_tiny",
"type" => "select"),

array("name" => "H4 font size",
"desc" => "Select value",
"id" => $shortname."_h4_size",
"options" => $epic_fontsizes,
"std" => "",
"size" => "_tiny",
"type" => "select"),

array("name" => "H5 font size",
"desc" => "Select value",
"id" => $shortname."_h5_size",
"options" => $epic_fontsizes,
"std" => "",
"size" => "_tiny",
"type" => "select"),

array("name" => "H6 font size",
"desc" => "Select value",
"id" => $shortname."_h6_size",
"options" => $epic_fontsizes,
"std" => "",
"size" => "_tiny",
"type" => "select"),

array("name" => "Body font size",
"desc" => "Select value",
"id" => $shortname."_p_size",
"options" => $epic_fontsizes,
"std" => "",
"size" => "_tiny",
"type" => "select"),

array("type" => "subclose", "id" => ""),
	
	array( 
			"type" => "close",
			"id" 	 => "",
			"std" => ""

			
			),


);

return apply_filters('epic_theme_font_options', $options);	





?>