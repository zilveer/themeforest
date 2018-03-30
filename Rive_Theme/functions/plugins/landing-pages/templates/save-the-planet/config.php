<?php
/**
* WordPress Landing Page Config File
* Template Name: Save the Planet
*
* @package  WordPress Landing Pages
* @author 	Cohhe
*/

lp_global_config(); // The lp_global_config function is for global code added by 3rd party extensions

//gets template directory name to use as identifier - do not edit - include in all template files
$key = lp_get_parent_directory(dirname(__FILE__));

//EDIT - START - defines template information - helps categorizae template and provides additional popup information
$lp_data[$key]['category']    = "Promo";
$lp_data[$key]['version']     = "1.0";
$lp_data[$key]['description'] = "Save the Planet Template";
/*$lp_data[$key]['features'][]  = lp_list_feature("Demo Link","http://demo.inboundnow.com/go/countdown-lander-preview/");*/
$lp_data[$key]['features'][]  = lp_list_feature("The 'Save the Planet' template is for promotion.");
$lp_data[$key]['thumbnail']   = LANDINGPAGES_URLPATH.'templates/'.$key.'/save_the_planet.jpg';

//DO NOT EDIT - adds template to template selection dropdown
$lp_data[$key]['value'] = $key;
$lp_data[$key]['label'] = ucwords(str_replace('-',' ',$key));


//************************************************
// Add User Options to Your Landing Page Template
//************************************************


// Add a text input field to the landing page options panel
$lp_data[$key]['options'][] =
	lp_add_option($key,"text","text-1","It's destroying the planet","Frame 1","Text for frame 1", $options=null);

$lp_data[$key]['options'][] =
	lp_add_option($key,"text","text-2","It's mass, mechanized murder","Frame 2","Text for frame 2", $options=null);

$lp_data[$key]['options'][] =
	lp_add_option($key,"text","text-3","It's destroying the planet","Frame 3","Text for frame 3", $options=null);

$lp_data[$key]['options'][] =
	lp_add_option($key,"text","text-4","It's destroying the planet","Frame 4","Text for frame 4", $options=null);

$lp_data[$key]['options'][] =
	lp_add_option($key,"text","text-5-1","It's destroying the planet","Frame 5 (1)","Text for frame 5 (text 1)", $options=null);

$lp_data[$key]['options'][] =
	lp_add_option($key,"text","text-5-2","It's destroying the planet","Frame 5 (2)","Text for frame 5 (text 2)", $options=null);

$lp_data[$key]['options'][] =
	lp_add_option($key,"text","text-5-3","It's destroying the planet","Frame 5 (3)","Text for frame 5 (text 3)", $options=null);

$lp_data[$key]['options'][] =
	lp_add_option($key,"text","help-us-text","Help Us","'Help us' text","Text for button which will lead to your desired page", $options=null);

$lp_data[$key]['options'][] =
	lp_add_option($key,"text","website-url","http://www.example.com","Your website url","This is page to which user will be sent after pressing 'Help Us' link.", $options=null);

// Add Colorpicker
$lp_data[$key]['options'][] =
	lp_add_option($key,"colorpicker","text-color","ffffff","Text Color","Use this setting to change the template's text color", $options=null);

// Add Colorpicker
$lp_data[$key]['options'][] =
	lp_add_option($key,"colorpicker","bg-color","310404","Page Background Color","Use this setting to change the template's background color.", $options=null);

// Add Colorpicker
$lp_data[$key]['options'][] =
	lp_add_option($key,"colorpicker","submit-button-bg-color","ffffff","Submit Button Background Color","Use this setting to change the template's submit button background color.", $options=null);

// Add Colorpicker
$lp_data[$key]['options'][] =
	lp_add_option($key,"colorpicker","submit-button-color","310404","Submit Button Text Color","Use this setting to change the template's submit button text color.", $options=null);

// Add a radio button option to your theme's options panel.
$options = array('on' => 'on','off'=>'off');
$lp_data[$key]['options'][] =
	lp_add_option($key,"radio","music-on","on","Play music in background?","Toggle this on to play music in background.", $options);

// Add a media uploader field to your landing page options
$lp_data[$key]['options'][] =
	lp_add_option($key,"media","bg-image","","Background Image","Enter an URL or upload an image for the background.", $options=null);

// Add a media uploader field to your landing page options
$lp_data[$key]['options'][] =
	lp_add_option($key,"media","planet-image","","Planet Image","Enter an URL or upload an image for the image that will zoom in.", $options=null);

// Add a media uploader field to your landing page options
$lp_data[$key]['options'][] =
	lp_add_option($key,"media","bg-music","","Background Music","Enter an URL or upload an music for the background.", $options=null);

// Radio Button Example
// Add a radio button option to your theme's options panel.
$options = array('1' => 'on','0'=>'off');
$lp_data[$key]['options'][] =
	lp_add_option($key,"radio","display-social","1","Display Social Media Share Buttons","Toggle social sharing on and off", $options);