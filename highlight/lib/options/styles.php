<?php


/**
 * Load the patterns into arrays.
 */
$patterns=array();
$patterns[0]='none';
for($i=1; $i<=35; $i++){
	$patterns[]='pattern'.$i.'.png';
}


$pexeto_styles_options=array(array(
"name" => "Style settings",
"type" => "title",
"img" => PEXETO_IMAGES_URL.'icon_style.png'
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"general", "name"=>"General"), array("id"=>"logo", "name"=>"Logo"), array("id"=>"text", "name"=>"Text Styles"), array("id"=>"bg", "name"=>"Backgrounds"), array("id"=>"fonts", "name"=>"Fonts"))
),

/* ------------------------------------------------------------------------*
 * GENERAL
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id" => 'general'
),

array(
"name" => "Predefined Skins",
"id" => PEXETO_SHORTNAME."_skin",
"type" => "stylecolor",
"options" => array( "237792","34687E", "195b6c",
    "6792a1","41667D","1d4a63",
    "46995c","328181","247475",
    "859140","456b25","3a4d34",
    "577266","3e545e","164e55",
    "73626E","565a78","4a3d64",
    "8b416c","8c3d52","6E344D",
    "8f2b2b","762828","542437",
    "696758","595959","4b4b4b"),
"std" => '195b6c',
"desc" => 'You can either select a predefined skin or pick your custom color below.'
),

array(
"name" => "Custom Theme Color",
"id" => PEXETO_SHORTNAME."_custom_skin",
"type" => "color",
"desc" => 'You can select a custom color for your theme. This field has priority over the "Predefined Skins" one. '
),

array(
"name" => "Theme Pattern",
"id" => PEXETO_SHORTNAME."_pattern",
"type" => "pattern",
"options" => $patterns,
"desc" => 'You can either select one of the default patterns here or upload your own in the Custom Pattern field below.'
),

array(
"name" => "Custom Pattern",
"id" => PEXETO_SHORTNAME."_custom_pattern",
"type" => "upload",
"desc" => 'You can upload your custom pattern image here.'
),



array(
"name" => "Main body text size",
"id" => PEXETO_SHORTNAME."_body_text_size",
"type" => "text",
"desc" => "The main body font size in pixels. Default: 12"
),

array(
"name" => "Additional CSS styles",
"id" => PEXETO_SHORTNAME."_additional_styles",
"type" => "textarea",
"desc" => "You can insert some more additional CSS code here."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * LOGO OPTIONS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'logo'
),

array(
"name" => "Logo image",
"id" => PEXETO_SHORTNAME."_logo_image",
"type" => "upload",
"desc" => "If you wouldn't like to use the uploader: if the image is located within the images folder you can just insert images/image-name.jpg, otherwise
you have to insert the full path to the image, for example: http://site.com/image-name.jpg"
),

array(
"name" => "Logo image width",
"id" => PEXETO_SHORTNAME."_logo_width",
"type" => "text",
"desc" => "The logo image width in pixels- default:160"
),


array(
"name" => "Logo Container Height",
"id" => PEXETO_SHORTNAME."_logo_height",
"type" => "text",
"desc" => "This is the height of the whole header containing the logo and should be changed when the logo image is higher or smaller than the original one."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * TEXT STYLES
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'text',
),

array(
"name" => "Main body text color",
"id" => PEXETO_SHORTNAME."_body_color",
"type" => "color",
"desc" => "This setting will change the main content and sidebar text color."
),

array(
"name" => "Headings color",
"id" => PEXETO_SHORTNAME."_heading_color",
"type" => "color"
),

array(
"name" => "Header text color",
"id" => PEXETO_SHORTNAME."_subtitle_color",
"type" => "color",
"desc" => "The color of the text in the header, such as page subtitle and content slider text."
),

array(
"name" => "Links color",
"id" => PEXETO_SHORTNAME."_link_color",
"type" => "color"
),

array(
"name" => "Menu links color",
"id" => PEXETO_SHORTNAME."_menu_link_color",
"type" => "color"
),

array(
"name" => "Menu links hover color",
"id" => PEXETO_SHORTNAME."_menu_link_hover",
"type" => "color",
"desc" => "This is the color of the menu links when the mouse cursor gets positioned over the link"
),

array(
"name" => "Footer text color",
"id" => PEXETO_SHORTNAME."_footer_text_color",
"type" => "color"
),

array(
"name" => "Footer copyright text color",
"id" => PEXETO_SHORTNAME."_copyright_text",
"type" => "color"
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * BACKGROUNDS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id" => 'bg'
),

array(
"name" => "Body background color",
"id" => PEXETO_SHORTNAME."_body_bg",
"type" => "color"
),

array(
"name" => "Lines and borders color",
"id" => PEXETO_SHORTNAME."_border_color",
"type" => "color"
),


array(
"name" => "Comments background color",
"id" => PEXETO_SHORTNAME."_comments_bg",
"type" => "color"
),

array(
"name" => "Footer background color",
"id" => PEXETO_SHORTNAME."_footer_bg",
"type" => "color"
),

array(
"name" => "Footer copyright section background color",
"id" => PEXETO_SHORTNAME."_copyright_bg",
"type" => "color"
),

array(
"name" => "Footer lines color",
"id" => PEXETO_SHORTNAME."_footer_lines_color",
"type" => "color"
),


array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * FONTS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id" => 'fonts'
),

array(
"name" => "Enable Cufon for headings",
"id" => PEXETO_SHORTNAME."_enable_cufon",
"type" => "checkbox",
"desc" => "If it is enabled, you will be able to use another custom fonts for the headings. You will be able to
either select one of the default fonts that the theme comes with or upload your own font below."
),

array(
"name" => "Heading Cufon Font",
"id" => PEXETO_SHORTNAME."_cufon_font",
"type" => "select",
"options" => array(array('id'=>'andika.js','name'=>'Andika Basic'),array('id'=>'caviar_dreams.js','name'=>'Caviar Dreams'),array('id'=>'charis_sil.js','name'=>'Charis'),array('id'=>'chunk_five.js','name'=>'Chunk Five'),array('id'=>'comfortaa.js','name'=>'Comfortaa'),array('id'=>'droid_serif.js','name'=>'Droid Serif'), array('id'=>'kingthings_exeter.js','name'=>'Kingthings Exeter'), array('id'=>'luxy_sans.js','name'=>'Luxy Sans'), array('id'=>'sling.js','name'=>'Sling'), array('id'=>'vegur.js','name'=>'Vegur')),
"desc" => 'You can select one of the fonts that the theme goes with. In order the font to replace the default one
the "Enable Cufon" field above should be enabled.'
),

array(
"name" => "Custom Heading Font",
"id" => PEXETO_SHORTNAME."_custom_cufon_font",
"type" => "upload",
"desc" => 'You can upload your custom JavaScript font file here. You can generate the font here: http://cufon.shoqolate.com/generate/'
),

array(
"type" => "close"),


array(
"type" => "close"));

pexeto_add_options($pexeto_styles_options);