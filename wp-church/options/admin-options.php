<?php
/*
 * Netstudio Admin Framework
 */


/*
 * Defining meta boxes
*/
$netstudio_options['general'][] = array(	"name" => "General",
					"id" => "ns_general_settings",
					"context" => "normal",
					"type" => "heading");

$netstudio_options['slideshow'][] = array(	"name" => "Slideshow",
					"id" => "ns_slide_settings",
					"context" => "normal",
					"type" => "heading");

$netstudio_options['map'][] = array(	"name" => "Google Maps",
					"id" => "ns_map_settings",
					"context" => "normal",
					"type" => "heading");

$netstudio_options['contact'][] = array(	"name" => "Contact Form",
					"id" => "ns_contactf_settings",
					"context" => "normal",
					"type" => "heading");

					
$netstudio_options['social'][] = array(	"name" => "Social",
					"id" => "ns_accounts_settings",
					"context" => "normal",
					"type" => "heading");

$netstudio_options['terms'][] = array(	"name" => "Special Terms",
					"id" => "ns_spect_settings",
					"context" => "normal",
					"type" => "heading");




/*
 * Special Terms
 */

$netstudio_options['terms'][] = array(	"name" => "Latest Message:",
					"desc" => "Term for latest message on frontpage",
					"id" => $shortname."_sptlatest",
					"std" => "Latest Message",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['terms'][] = array(	"name" => "Directions button:",
					"desc" => "Term for directions button",
					"id" => $shortname."_sptdir",
					"std" => "Get Directions",
					"type" => "text","options" => array(
"class" => ""));


$netstudio_options['terms'][] = array(	"name" => "Our next event:",
					"desc" => "Term in front of next event",
					"id" => $shortname."_sptnextev",
					"std" => "Our next event in",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['terms'][] = array(	"name" => "Key team members:",
					"desc" => "Term for key team members",
					"id" => $shortname."_sptteammem",
					"std" => "Key team members.",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['terms'][] = array(	"name" => "Dates not to miss:",
					"desc" => "Term for dates not to miss",
					"id" => $shortname."_sptnotmiss",
					"std" => "Dates not to miss....",
					"type" => "text","options" => array(
"class" => ""));



/*
 * Contact Form
 */

$netstudio_options['contact'][] = array(	"name" => "Disable",
					"desc" => "Select to disable contact form",
					"id" => $shortname."_disablecontact",
					"std" => "",
					"type" => "checkbox");	

$netstudio_options['contact'][] = array(	"name" => "Header title:",
					"desc" => "contact form header title",
					"id" => $shortname."_contacthead",
					"std" => "Contact Form",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['contact'][] = array(	"name" => "Success Message:",
					"desc" => "contact form success message",
					"id" => $shortname."_contactsuccess",
					"std" => "Your message was sent successfully",
					"type" => "text","options" => array(
"class" => ""));



/*
 * General Options
 */
 
$netstudio_options['general'][] = array(	"name" => "Upload Your Logo",
					"desc" => "Upload your logo here",
					"id" => $shortname."_themelogo",
					"std" => "",
					"type" => "uploader");

$netstudio_options['general'][] = array(	"name" => "Color Scheme",
					"desc" => "Theme Color Scheme.",
					"id" => $shortname."_colorscheme",
					"std" => "rust",
					"type" => "select", "options" => array("rust", "gold", "green", "teal","blue","purple"));

$netstudio_options['general'][] = array(	"name" => "Tag Line",
					"desc" => "Tagline goes here. Leave it empty if you do not want it",
					"id" => $shortname."_tagline",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));	

$netstudio_options['general'][] = array(	"name" => "Fonts",
					"desc" => "Custom Font Selection.",
					"id" => $shortname."_vfont",
					"std" => "Vollkorn",
					"type" => "select", "options" => array('None', 'Abel', 'Cantarell', 'Cardo', 'Carme', 'Crimson Text', 'Droid Sans', 'Droid Sans Mono', 'Droid Serif', 'IM Fell DW Pica', 'Inconsolata', 'Josefin Sans Std Light', 'Josefin Slab', 'Lobster', 'Molengo', 'Maiden Orange', 'Nobile', 'Open Sans Condensed', 'OFL Sorts Mill Goudy TT', 'Old Standard TT', 'Oswald', 'PT Sans Narrow', 'Reenie Beanie', 'Rokkitt', 'Tangerine', 'Vollkorn', 'Yanone Kaffeesatz', 'Cuprum', 'Neucha', 'Neuton', 'PT Sans', 'Philosopher', 'Allerta', 'Allerta Stencil', 'Arimo', 'Arvo', 'Bentham', 'Coda', 'Cousine', 'Covered By Your Grace', 'Geo', 'Just Me Again Down Here', 'Puritan', 'Raleway', 'Tinos', 'UnifrakturCook', 'UnifrakturMaguntia', 'Mountains of Christmas', 'Lato', 'Orbitron', 'Allan', 'Anonymous Pro', 'Copse', 'Kenia', 'Ubuntu', 'Vibur', 'Sniglet', 'Syncopate', 'Cabin', 'Merriweather', 'Just Another Hand', 'Kristi', 'Corben', 'Gruppo', 'Buda', 'Lekton', 'Luckiest Guy', 'Crushed', 'Chewy', 'Coming Soon', 'Crafty Girls', 'Fontdiner Swanky', 'Permanent Marker', 'Rock Salt', 'Sunshiney', 'Unkempt', 'Calligraffitti', 'Cherry Cream Soda', 'Homemade Apple', 'Irish Growler', 'Kranky', 'Schoolbell', 'Slackey', 'Walter Turncoat', 'Radley', 'Meddon', 'Kreon', 'Dancing Script', 'Goudy Bookletter 1911', 'PT Serif Caption', 'PT Serif', 'Astloch', 'Bevan', 'Anton', 'Expletus Sans', 'VT323', 'Pacifico', 'Candal', 'Architects Daughter', 'Indie Flower', 'League Script', 'Cabin Sketch', 'Quattrocento', 'Amaranth', 'Irish Grover'));


$netstudio_options['general'][] = array(	"name" => "Fonts Override",
					"desc" => "Add the google fonts code here to override built in Google Fonts",
					"id" => $shortname."_fontcode",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$netstudio_options['general'][] = array(	"name" => "Font Family override",
					"desc" => "Add the font family here to override fonts",
					"id" => $shortname."_fontfamily",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));



$netstudio_options['general'][] = array(	"name" => "Verses",
					"desc" => "Select to enable or disable bible verses.",
					"id" => $shortname."_bibverse",
					"std" => "enabled",
					"type" => "select", "options" => array('enabled', 'disabled'));
					
$netstudio_options['general'][] = array(	"name" => "Reassign Get directions",
					"desc" => "Type an address to use the get directions button as a normal button that links to a page.",
					"id" => $shortname."_reassdir",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));



$netstudio_options['general'][] = array(	"name" => "Comments in pages",
					"desc" => "Select to allow comments on pages",
					"id" => $shortname."_commpage",
					"std" => "",
					"type" => "ccheckbox");	

$netstudio_options['general'][] = array(	"name" => "Comments in calendars",
					"desc" => "Select to display comments on calendar entries",
					"id" => $shortname."_commcal",
					"std" => "",
					"type" => "ccheckbox");	

$netstudio_options['general'][] = array(	"name" => "Comments in messages",
					"desc" => "Select to display comments in messages",
					"id" => $shortname."_commmess",
					"std" => "",
					"type" => "ccheckbox");	

$netstudio_options['general'][] = array(	"name" => "Comments in groups",
					"desc" => "Select to display comments group entries",
					"id" => $shortname."_commgroup",
					"std" => "",
					"type" => "ccheckbox");	

$netstudio_options['general'][] = array(	"name" => "SEO Site Description",
					"desc" => "Add a Seo Description for your site",
					"id" => $shortname."_seodescr",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));

$netstudio_options['general'][] = array(	"name" => "Tracking code",
					"desc" => "Stats tracking code goes here",
					"id" => $shortname."_tracking",
					"std" => "",
					"type" => "textarea", "options" => array(
"rows" => "5",
"cols" => "64"));	

$netstudio_options['general'][] = array(	"name" => "Disable Countdown",
					"desc" => "Select to disable countdowntimer",
					"id" => $shortname."_countdown",
					"std" => "",
					"type" => "ccheckbox");


$netstudio_options['general'][] = array(	"name" => "Frontpage latest",
					"desc" => "Disable Latest message on frontpage.",
					"id" => $shortname."_latestmess",
					"std" => "false",
					"type" => "select", "options" => array("false", "true"));

$netstudio_options['general'][] = array(	"name" => "Calendar sidebar",
					"desc" => "Should the calendar show a normal sidebar or a special -not to miss- sidebar.",
					"id" => $shortname."_calside",
					"std" => "normal sidebar",
					"type" => "select", "options" => array("normal sidebar", "special sidebar"));


/*
 * Slideshow
 */


$netstudio_options['slideshow'][] = array(	"name" => "Transition time",
					"desc" => "Time between photos in seconds.",
					"id" => $shortname."_transtime",
					"std" => "14",
					"type" => "select", "options" => array("5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17"));
$netstudio_options['slideshow'][] = array(	"name" => "Effect",
					"desc" => "Type of effect to use.",
					"id" => $shortname."_transtype",
					"std" => "random",
					"type" => "select", "options" => array("random", "swirl", "rain", "straight"));
$netstudio_options['slideshow'][] = array(	"name" => "Next & Prev",
					"desc" => "Show next and previous buttons.",
					"id" => $shortname."_transprev",
					"std" => "true",
					"type" => "select", "options" => array("true", "false"));
$netstudio_options['slideshow'][] = array(	"name" => "Add Link",
					"desc" => "Link to an article if clicked.",
					"id" => $shortname."_translink",
					"std" => "true",
					"type" => "select", "options" => array("true", "false"));
$netstudio_options['slideshow'][] = array(	"name" => "Pause on hover",
					"desc" => "Pause slideshow if it is hovered",
					"id" => $shortname."_transpause",
					"std" => "true",
					"type" => "select", "options" => array("true", "false"));



/*
 * Map
 */

$netstudio_options['map'][] = array(	"name" => "Disable Maps",
					"desc" => "Click here to disable the maps",
					"id" => $shortname."_mapdisable",
					"std" => "false",
					"type" => "select", "options" => array("true", "false"));

$netstudio_options['map'][] = array(	"name" => "Measurements",
					"desc" => "Choose between metric and imperial",
					"id" => $shortname."_mapmetric",
					"std" => "metric",
					"type" => "select", "options" => array("metric", "imperial"));

$netstudio_options['map'][] = array(	"name" => "Disable streetview map",
					"desc" => "Choose to only show the streetviewmap",
					"id" => $shortname."_mapview",
					"std" => "false",
					"type" => "select", "options" => array("true", "false"));


$netstudio_options['map'][] = array(	"name" => "Physical address:",
					"desc" => "Physical address needed for driving directions.",
					"id" => $shortname."_physaddr",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "Page address:",
					"desc" => "Add the address of your get directions page here.",
					"id" => $shortname."_addraddr",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));



$netstudio_options['map'][] = array(	"name" => "Lat/Long:",
					"desc" => "Lattitude and Longitude from the map tool",
					"id" => $shortname."_latlong",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "Orientation:",
					"desc" => "Streetview Orientation",
					"id" => $shortname."_orien",
					"std" => "15",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "SV Zoom:",
					"desc" => "Streetview Zoom",
					"id" => $shortname."_strzoom",
					"std" => "1",
					"type" => "text","options" => array(
"class" => ""));

$netstudio_options['map'][] = array(	"name" => "Zoom:",
					"desc" => "Map Zoom",
					"id" => $shortname."_mapzoom",
					"std" => "8",
					"type" => "text","options" => array(
"class" => ""));




/*
 * Social Options
 */

 
$netstudio_options['social'][] = array(	"name" => "Facebook:",
					"desc" => "Facebook url",
					"id" => $shortname."_facebook_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_facebook_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_facebook_widgets",
					"std" => "false",
					"type" => "checkbox");	



 
$netstudio_options['social'][] = array(	"name" => "Twitter:",
					"desc" => "Twitter url",
					"id" => $shortname."_twitter_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_twitter_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_twitter_widgets",
					"std" => "false",
					"type" => "checkbox");					
 
 

 
$netstudio_options['social'][] = array(	"name" => "Stumble:",
					"desc" => "Stumble url",
					"id" => $shortname."_stumble_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_stumble_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_stumble_widgets",
					"std" => "false",
					"type" => "checkbox");

 
$netstudio_options['social'][] = array(	"name" => "RSS:",
					"desc" => "RSS url",
					"id" => $shortname."_rss_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_rss_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_rss_widgets",
					"std" => "false",
					"type" => "checkbox");


 
$netstudio_options['social'][] = array(	"name" => "Email:",
					"desc" => "Email address",
					"id" => $shortname."_email_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_email_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_email_widgets",
					"std" => "false",
					"type" => "checkbox");	

 
$netstudio_options['social'][] = array(	"name" => "Blogger:",
					"desc" => "Blogger address",
					"id" => $shortname."_blogger_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_blogger_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_blogger_widgets",
					"std" => "false",
					"type" => "checkbox");								

 
$netstudio_options['social'][] = array(	"name" => "Digg:",
					"desc" => "Digg address",
					"id" => $shortname."_digg_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_digg_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_digg_widgets",
					"std" => "false",
					"type" => "checkbox");								
 	
	
					
$netstudio_options['social'][] = array(	"name" => "Delicious",
					"desc" => "",
					"std" => "",
					"type" => "sub_heading");	
 
$netstudio_options['social'][] = array(	"name" => "Delicious:",
					"desc" => "Delicious address",
					"id" => $shortname."_delicious_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_delicious_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_delicious_widgets",
					"std" => "false",
					"type" => "checkbox");								
 	
 
					
$netstudio_options['social'][] = array(	"name" => "Buzz",
					"desc" => "",
					"std" => "",
					"type" => "sub_heading");	
 
$netstudio_options['social'][] = array(	"name" => "Buzz:",
					"desc" => "Buzz address",
					"id" => $shortname."_buzz_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_buzz_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_buzz_widgets",
					"std" => "false",
					"type" => "checkbox");								
 	
 

					
$netstudio_options['social'][] = array(	"name" => "Technorati",
					"desc" => "",
					"std" => "",
					"type" => "sub_heading");	
 
$netstudio_options['social'][] = array(	"name" => "Technorati:",
					"desc" => "Technorati address",
					"id" => $shortname."_technorati_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_technorati_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_technorati_widgets",
					"std" => "false",
					"type" => "checkbox");								
 	
 

					
$netstudio_options['social'][] = array(	"name" => "Reddit",
					"desc" => "",
					"std" => "",
					"type" => "sub_heading");	
 
$netstudio_options['social'][] = array(	"name" => "Reddit:",
					"desc" => "Reddit address",
					"id" => $shortname."_reddit_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_reddit_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_reddit_widgets",
					"std" => "false",
					"type" => "checkbox");								
 	

	
	
$netstudio_options['social'][] = array(	"name" => "Blinklist",
					"desc" => "",
					"std" => "",
					"type" => "sub_heading");	
 
$netstudio_options['social'][] = array(	"name" => "Blinklist:",
					"desc" => "Blinklist address",
					"id" => $shortname."_blinklist_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_blinklist_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_blinklist_widgets",
					"std" => "false",
					"type" => "checkbox");								
 
	
$netstudio_options['social'][] = array(	"name" => "Designfloat",
					"desc" => "",
					"std" => "",
					"type" => "sub_heading");	
 
$netstudio_options['social'][] = array(	"name" => "Designfloat:",
					"desc" => "Designfloat address",
					"id" => $shortname."_designfloat_url",
					"std" => "",
					"type" => "text","options" => array(
"class" => ""));	

$netstudio_options['social'][] = array(	"name" => "Posts",
					"desc" => "Add to posts.",
					"id" => $shortname."_designfloat_posts",
					"std" => "false",
					"type" => "checkbox");

$netstudio_options['social'][] = array(	"name" => "Widget",
					"desc" => "Add to widget.",
					"id" => $shortname."_designfloat_widgets",
					"std" => "false",
					"type" => "checkbox");								
  
  
 
 

?>