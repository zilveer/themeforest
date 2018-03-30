<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('NHP_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('NHP_Options')){
	require_once( dirname( __FILE__ ) . '/options/options.php' );
}

/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'nhp-opts'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'nhp-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');









/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){

	$google_fonts = array( 
		 'Abel' => "Abel",
		 'Abril+Fatface' => "Abril Fatface",
		 'Aclonica' => "Aclonica",
		 'Actor' => "Actor",
		 'Adamina' => "Adamina",
		 'Aguafina+Script' => "Aguafina Script",
		 'Aladin' => "Aladin",
		 'Aldrich' => "Aldrich",
		 'Alice' => "Alice",
		 'Alike+Angular' => "Alike Angular",
		 'Alike' => "Alike",
		 'Allan' => "Allan",
		 'Allerta+Stencil' => "Allerta Stencil",
		 'Allerta' => "Allerta",
		 'Amaranth' => "Amaranth",
		 'Amatic+SC' => "Amatic SC",
		 'Andada' => "Andada",
		 'Andika' => "Andika",
		 'Annie+Use+Your+Telescope' => "Annie Use Your Telescope",
		 'Anonymous+Pro' => "Anonymous Pro",
		 'Antic' => "Antic",
		 'Anton' => "Anton",
		 'Arapey' => "Arapey",
		 'Architects+Daughter' => "Architects Daughter",
		 'Arimo' => "Arimo",
		 'Artifika' => "Artifika",
		 'Arvo' => "Arvo",
		 'Asset' => "Asset",
		 'Astloch' => "Astloch",
		 'Atomic+Age' => "Atomic Age",
		 'Aubrey' => "Aubrey",
		 'Bangers' => "Bangers",
		 'Bentham' => "Bentham",
		 'Bevan' => "Bevan",
		 'Bigshot+One' => "Bigshot One",
		 'Bitter' => "Bitter",
		 'Black+Ops+One' => "Black Ops One",
		 'Bowlby+One+SC' => "Bowlby One SC",
		 'Bowlby+One' => "Bowlby One",
		 'Brawler' => "Brawler",
		 'Bubblegum+Sans' => "Bubblegum Sans",
		 'Buda' => "Buda",
		 'Butcherman+Caps' => "Butcherman Caps",
		 'Cabin+Condensed' => "Cabin Condensed",
		 'Cabin+Sketch' => "Cabin Sketch",
		 'Cabin' => "Cabin",
		 'Cagliostro' => "Cagliostro",
		 'Calligraffitti' => "Calligraffitti",
		 'Candal' => "Candal",
		 'Cantarell' => "Cantarell",
		 'Cardo' => "Cardo",
		 'Carme' => "Carme",
		 'Carter+One' => "Carter One",
		 'Caudex' => "Caudex",
		 'Cedarville+Cursive' => "Cedarville Cursive",
		 'Changa+One' => "Changa One",
		 'Cherry+Cream+Soda' => "Cherry Cream Soda",
		 'Chewy' => "Chewy",
		 'Chicle' => "Chicle",
		 'Chivo' => "Chivo",
		 'Coda+Caption' => "Coda Caption",
		 'Coda' => "Coda",
		 'Comfortaa' => "Comfortaa",
		 'Coming+Soon' => "Coming Soon",
		 'Contrail+One' => "Contrail One",
		 'Convergence' => "Convergence",
		 'Cookie' => "Cookie",
		 'Copse' => "Copse",
		 'Corben' => "Corben",
		 'Cousine' => "Cousine",
		 'Coustard' => "Coustard",
		 'Covered+By+Your+Grace' => "Covered By Your Grace",
		 'Crafty+Girls' => "Crafty Girls",
		 'Creepster+Caps' => "Creepster Caps",
		 'Crimson+Text' => "Crimson Text",
		 'Crushed' => "Crushed",
		 'Cuprum' => "Cuprum",
		 'Damion' => "Damion",
		 'Dancing+Script' => "Dancing Script",
		 'Dawning+of+a+New+Day' => "Dawning of a New Day",
		 'Days+One' => "Days One",
		 'Delius+Swash+Caps' => "Delius Swash Caps",
		 'Delius+Unicase' => "Delius Unicase",
		 'Delius' => "Delius",
		 'Devonshire' => "Devonshire",
		 'Didact+Gothic' => "Didact Gothic",
		 'Dorsa' => "Dorsa",
		 'Dr+Sugiyama' => "Dr Sugiyama",
		 'Droid+Sans+Mono' => "Droid Sans Mono",
		 'Droid+Sans' => "Droid Sans",
		 'Droid+Serif' => "Droid Serif",
		 'EB+Garamond' => "EB Garamond",
		 'Eater+Caps' => "Eater Caps",
		 'Expletus+Sans' => "Expletus Sans",
		 'Fanwood+Text' => "Fanwood Text",
		 'Federant' => "Federant",
		 'Federo' => "Federo",
		 'Fjord+One' => "Fjord One",
		 'Fondamento' => "Fondamento",
		 'Fontdiner+Swanky' => "Fontdiner Swanky",
		 'Forum' => "Forum",
		 'Francois+One' => "Francois One",
		 'Gentium+Basic' => "Gentium Basic",
		 'Gentium+Book+Basic' => "Gentium Book Basic",
		 'Geo' => "Geo",
		 'Geostar+Fill' => "Geostar Fill",
		 'Geostar' => "Geostar",
		 'Give+You+Glory' => "Give You Glory",
		 'Gloria+Hallelujah' => "Gloria Hallelujah",
		 'Goblin+One' => "Goblin One",
		 'Gochi+Hand' => "Gochi Hand",
		 'Goudy+Bookletter+1911' => "Goudy Bookletter 1911",
		 'Gravitas+One' => "Gravitas One",
		 'Gruppo' => "Gruppo",
		 'Hammersmith+One' => "Hammersmith One",
		 'Herr+Von+Muellerhoff' => "Herr Von Muellerhoff",
		 'Holtwood+One+SC' => "Holtwood One SC",
		 'Homemade+Apple' => "Homemade Apple",
		 'IM+Fell+DW+Pica+SC' => "IM Fell DW Pica SC",
		 'IM+Fell+DW+Pica' => "IM Fell DW Pica",
		 'IM+Fell+Double+Pica+SC' => "IM Fell Double Pica SC",
		 'IM+Fell+Double+Pica' => "IM Fell Double Pica",
		 'IM+Fell+English+SC' => "IM Fell English SC",
		 'IM+Fell+English' => "IM Fell English",
		 'IM+Fell+French+Canon+SC' => "IM Fell French Canon SC",
		 'IM+Fell+French+Canon' => "IM Fell French Canon",
		 'IM+Fell+Great+Primer+SC' => "IM Fell Great Primer SC",
		 'IM+Fell+Great+Primer' => "IM Fell Great Primer",
		 'Iceland' => "Iceland",
		 'Inconsolata' => "Inconsolata",
		 'Indie+Flower' => "Indie Flower",
		 'Irish+Grover' => "Irish Grover",
		 'Istok+Web' => "Istok Web",
		 'Jockey+One' => "Jockey One",
		 'Josefin+Sans' => "Josefin Sans",
		 'Josefin+Slab' => "Josefin Slab",
		 'Judson' => "Judson",
		 'Julee' => "Julee",
		 'Jura' => "Jura",
		 'Just+Another+Hand' => "Just Another Hand",
		 'Just+Me+Again+Down+Here' => "Just Me Again Down Here",
		 'Kameron' => "Kameron",
		 'Kelly+Slab' => "Kelly Slab",
		 'Kenia' => "Kenia",
		 'Knewave' => "Knewave",
		 'Kranky' => "Kranky",
		 'Kreon' => "Kreon",
		 'Kristi' => "Kristi",
		 'La+Belle+Aurore' => "La Belle Aurore",
		 'Lancelot' => "Lancelot",
		 'Lato' => "Lato",
		 'League+Script' => "League Script",
		 'Leckerli+One' => "Leckerli One",
		 'Lekton' => "Lekton",
		 'Lemon' => "Lemon",
		 'Limelight' => "Limelight",
		 'Linden+Hill' => "Linden Hill",
		 'Lobster+Two' => "Lobster Two",
		 'Lobster' => "Lobster",
		 'Lora' => "Lora",
		 'Love+Ya+Like+A+Sister' => "Love Ya Like A Sister",
		 'Loved+by+the+King' => "Loved by the King",
		 'Luckiest+Guy' => "Luckiest Guy",
		 'Maiden+Orange' => "Maiden Orange",
		 'Mako' => "Mako",
		 'Marck+Script' => "Marck Script",
		 'Marvel' => "Marvel",
		 'Mate+SC' => "Mate SC",
		 'Mate' => "Mate",
		 'Maven+Pro' => "Maven Pro",
		 'Meddon' => "Meddon",
		 'MedievalSharp' => "MedievalSharp",
		 'Megrim' => "Megrim",
		 'Merienda+One' => "Merienda One",
		 'Merriweather' => "Merriweather",
		 'Metrophobic' => "Metrophobic",
		 'Michroma' => "Michroma",
		 'Miltonian+Tattoo' => "Miltonian Tattoo",
		 'Miltonian' => "Miltonian",
		 'Miss+Fajardose' => "Miss Fajardose",
		 'Miss+Saint+Delafield' => "Miss Saint Delafield",
		 'Modern+Antiqua' => "Modern Antiqua",
		 'Molengo' => "Molengo",
		 'Monofett' => "Monofett",
		 'Monoton' => "Monoton",
		 'Monsieur+La+Doulaise' => "Monsieur La Doulaise",
		 'Montez' => "Montez",
		 'Mountains+of+Christmas' => "Mountains of Christmas",
		 'Mr+Bedford' => "Mr Bedford",
		 'Mr+Dafoe' => "Mr Dafoe",
		 'Mr+De+Haviland' => "Mr De Haviland",
		 'Mrs+Sheppards' => "Mrs Sheppards",
		 'Muli' => "Muli",
		 'Neucha' => "Neucha",
		 'Neuton' => "Neuton",
		 'News+Cycle' => "News Cycle",
		 'Niconne' => "Niconne",
		 'Nixie+One' => "Nixie One",
		 'Nobile' => "Nobile",
		 'Nosifer+Caps' => "Nosifer Caps",
		 'Nothing+You+Could+Do' => "Nothing You Could Do",
		 'Nova+Cut' => "Nova Cut",
		 'Nova+Flat' => "Nova Flat",
		 'Nova+Mono' => "Nova Mono",
		 'Nova+Oval' => "Nova Oval",
		 'Nova+Round' => "Nova Round",
		 'Nova+Script' => "Nova Script",
		 'Nova+Slim' => "Nova Slim",
		 'Nova+Square' => "Nova Square",
		 'Numans' => "Numans",
		 'Nunito' => "Nunito",
		 'Old+Standard+TT' => "Old Standard TT",
		 'Open+Sans+Condensed' => "Open Sans Condensed",
		 'Open+Sans' => "Open Sans",
		 'Orbitron' => "Orbitron",
		 'Oswald' => "Oswald",
		 'Over+the+Rainbow' => "Over the Rainbow",
		 'Ovo' => "Ovo",
		 'PT+Sans+Caption' => "PT Sans Caption",
		 'PT+Sans+Narrow' => "PT Sans Narrow",
		 'PT+Sans' => "PT Sans",
		 'PT+Serif+Caption' => "PT Serif Caption",
		 'PT+Serif' => "PT Serif",
		 'Pacifico' => "Pacifico",
		 'Passero+One' => "Passero One",
		 'Patrick+Hand' => "Patrick Hand",
		 'Paytone+One' => "Paytone One",
		 'Permanent+Marker' => "Permanent Marker",
		 'Petrona' => "Petrona",
		 'Philosopher' => "Philosopher",
		 'Piedra' => "Piedra",
		 'Pinyon+Script' => "Pinyon Script",
		 'Play' => "Play",
		 'Playfair+Display' => "Playfair Display",
		 'Podkova' => "Podkova",
		 'Poller+One' => "Poller One",
		 'Poly' => "Poly",
		 'Pompiere' => "Pompiere",
		 'Prata' => "Prata",
		 'Prociono' => "Prociono",
		 'Puritan' => "Puritan",
		 'Quattrocento+Sans' => "Quattrocento Sans",
		 'Quattrocento' => "Quattrocento",
		 'Questrial' => "Questrial",
		 'Quicksand' => "Quicksand",
		 'Radley' => "Radley",
		 'Raleway' => "Raleway",
		 'Rammetto+One' => "Rammetto One",
		 'Rancho' => "Rancho",
		 'Rationale' => "Rationale",
		 'Redressed' => "Redressed",
		 'Reenie+Beanie' => "Reenie Beanie",
		 'Ribeye+Marrow' => "Ribeye Marrow",
		 'Ribeye' => "Ribeye",
		 'Righteous' => "Righteous",
		 'Rochester' => "Rochester",
		 'Rock+Salt' => "Rock Salt",
		 'Rokkitt' => "Rokkitt",
		 'Rosario' => "Rosario",
		 'Ruslan+Display' => "Ruslan Display",
		 'Salsa' => "Salsa",
		 'Sancreek' => "Sancreek",
		 'Sansita+One' => "Sansita One",
		 'Satisfy' => "Satisfy",
		 'Schoolbell' => "Schoolbell",
		 'Shadows+Into+Light' => "Shadows Into Light",
		 'Shanti' => "Shanti",
		 'Short+Stack' => "Short Stack",
		 'Sigmar+One' => "Sigmar One",
		 'Signika+Negative' => "Signika Negative",
		 'Signika' => "Signika",
		 'Six+Caps' => "Six Caps",
		 'Slackey' => "Slackey",
		 'Smokum' => "Smokum",
		 'Smythe' => "Smythe",
		 'Sniglet' => "Sniglet",
		 'Snippet' => "Snippet",
		 'Sorts+Mill+Goudy' => "Sorts Mill Goudy",
		 'Special+Elite' => "Special Elite",
		 'Spinnaker' => "Spinnaker",
		 'Spirax' => "Spirax",
		 'Stardos+Stencil' => "Stardos Stencil",
		 'Sue+Ellen+Francisco' => "Sue Ellen Francisco",
		 'Sunshiney' => "Sunshiney",
		 'Supermercado+One' => "Supermercado One",
		 'Swanky+and+Moo+Moo' => "Swanky and Moo Moo",
		 'Syncopate' => "Syncopate",
		 'Tangerine' => "Tangerine",
		 'Tenor+Sans' => "Tenor Sans",
		 'Terminal+Dosis' => "Terminal Dosis",
		 'The+Girl+Next+Door' => "The Girl Next Door",
		 'Tienne' => "Tienne",
		 'Tinos' => "Tinos",
		 'Tulpen+One' => "Tulpen One",
		 'Ubuntu+Condensed' => "Ubuntu Condensed",
		 'Ubuntu+Mono' => "Ubuntu Mono",
		 'Ubuntu' => "Ubuntu",
		 'Ultra' => "Ultra",
		 'UnifrakturCook' => "UnifrakturCook",
		 'UnifrakturMaguntia' => "UnifrakturMaguntia",
		 'Unkempt' => "Unkempt",
		 'Unlock' => "Unlock",
		 'Unna' => "Unna",
		 'VT323' => "VT323",
		 'Varela+Round' => "Varela Round",
		 'Varela' => "Varela",
		 'Vast+Shadow' => "Vast Shadow",
		 'Vibur' => "Vibur",
		 'Vidaloka' => "Vidaloka",
		 'Volkhov' => "Volkhov",
		 'Vollkorn' => "Vollkorn",
		 'Voltaire' => "Voltaire",
		 'Waiting+for+the+Sunrise' => "Waiting for the Sunrise",
		 'Wallpoet' => "Wallpoet",
		 'Walter+Turncoat' => "Walter Turncoat",
		 'Wire+One' => "Wire One",
		 'Yanone+Kaffeesatz' => "Yanone Kaffeesatz",
		 'Yellowtail' => "Yellowtail",
		 'Yeseva+One' => "Yeseva One",
		 'Zeyada' => "Zeyada",
	);
	$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = true;

//google api key MUST BE DEFINED IF YOU WANT TO USE GOOGLE WEBFONTS
//$args['google_api_key'] = '***';

//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
//$args['intro_text'] = __('<p>Don\'t forget to save the settings!</p>', 'nhp-opts');

//Setup custom links in the footer for share icons
$args['share_icons']['facebook'] = array(
										'link' => 'http://www.facebook.com/finaldestiny16',
										'title' => 'My facebook account', 
										'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_320_facebook.png'
										);
$args['share_icons']['themeforest'] = array(
										'link' => 'http://themeforest.net/user/FinalDestiny',
										'title' => 'My themeforest account',
										'img' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_050_link.png'
										);
//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = 'tharsis';

$args['google_api_key'] = 'AIzaSyB0_zr4gsc6PkFl5UiHDj6ROiXtuYb7QBk';

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('Tharsis Options', 'nhp-opts');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Tharsis Theme Options', 'nhp-opts');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'tharsis_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 27;

$args['footer_credit'] = '';

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';

//Want to disable the sections showing as a submenu in the admin? uncomment this line
//$args['allow_sub_menu'] = false;
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-1',
							'title' => __('Theme Information 1', 'nhp-opts'),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'nhp-opts')
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-2',
							'title' => __('Theme Information 2', 'nhp-opts'),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'nhp-opts')
							);

//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'nhp-opts');



$sections = array();

$sections[] = array(
				'title' => __('General Settings', 'nhp-opts'),
				'desc' => __('<p class="description">Here you can configure the general aspects of the theme.!</p>', 'nhp-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_062_attach.png',
				'fields' => array(
					array(
						'id' => 'logo_text',
						'type' => 'text',
						'title' => 'Logo text',
						'sub_desc' => 'This is the text used for the logo',
						'std' => 'Tharsis'
						),
					array(
						'id' => 'favicon',
						'type' => 'upload',
						'title' => 'Favicon',
						'sub_desc' => 'This is the little icon in the address bar for your website'
						),
					array(
						'id' => 'superadmin',
						'type' => 'text',
						'title' => 'Super admin username',
						'sub_desc' => '<strong>You can show the Theme options just for one admin user with this option! BE CAREFUL WITH THIS ONE!</strong>.',
						'std' => ''
						),
					array(
						'id' => 'email',
						'type' => 'text',
						'title' => 'Contact form e-mail',
						'sub_desc' => 'This is the e-mail where you\'ll receive all the messages from the contact page',
						'std' => get_bloginfo('admin_email')
						),
					array(
						'id' => 'wordpress_version',
						'type' => 'button_set',
						'options' => array('1' => 'Yes', '0' => 'No'),
						'title' => 'Show the wordpress version in your source code?',
						'std' => 1
						),
					array(
						'id' => 'blog_page',
						'type' => 'pages_multi_select',
						'title' => 'Page used for the blog page',
						'sub_desc' => 'If you don\'t setup any, the blog won\'t show up in the menu'
						),
					array(
						'id' => 'topheader_text',
						'type' => 'text',
						'title' => 'Top header text',
						'sub_desc' => 'This is the top header text, like Welcome on our demo.',
						'std' => 'Hello'
						),
					array(
						'id' => 'topheader_smalltext',
						'type' => 'text',
						'title' => 'Top header small text',
						'sub_desc' => 'This appears under the top header text above. Some little description about you here.',
						'std' => 'We are tharsis'
						),
					array(
						'id' => 'topheader_smallertext',
						'type' => 'text',
						'title' => 'Top header smaller text',
						'sub_desc' => 'This appears after the small text on the homepage, some more info about you here.',
						'std' => 'Let\'s blow this thing and go home!.'
						),
					array(
						'id' => 'phone',
						'type' => 'text',
						'title' => 'Phone',
						'sub_desc' => 'The phone shows up in the contact form.',
						'std' => ''
						),
					array(
						'id' => 'location',
						'type' => 'text',
						'title' => 'Location',
						'sub_desc' => 'The location shows up in the contact form.',
						'std' => ''
						),
					array(
						'id' => 'googlemaps',
						'type' => 'text',
						'title' => 'Google maps url',
						'sub_desc' => 'Used on the map in the contact form. Check the documentation if you\'re not sure what url to use.',
						'std' => ''
						),
					array(
						'id' => 'custom_css',
						'type' => 'textarea',
						'title' => 'Custom CSS',
						'sub_desc' => 'Include here any custom CSS you want, it will be kept when updating the theme'
						),
					array(
						'id' => 'contact_description',
						'type' => 'text',
						'title' => 'Header description on the contact page',
						'sub_desc' => 'Shows up under the Contact title on the homepage.'
						),
					array(
						'id' => 'facebook_url',
						'type' => 'text',
						'title' => 'Facebook URL',
						'sub_desc' => 'Shows up on the first page. Leave empty if not used.'
						),
					array(
						'id' => 'twitter_username',
						'type' => 'text',
						'title' => 'Twitter username',
						'sub_desc' => 'Shows up on the first page and is used in the twitter updates shortcode. Leave empty if not used.'
						),
					array(
						'id' => 'gplus_url',
						'type' => 'text',
						'title' => 'Google+ URL',
						'sub_desc' => 'Shows up on the first page. Leave empty if not used.'
						),
					array(
						'id' => 'dribble_url',
						'type' => 'text',
						'title' => 'Dribble URL',
						'sub_desc' => 'Shows up on the first page. Leave empty if not used.'
						),
					array(
						'id' => 'linkedin_url',
						'type' => 'text',
						'title' => 'Linkedin URL',
						'sub_desc' => 'Shows up on the first page. Leave empty if not used.'
						),
					array(
						'id' => 'skype_url',
						'type' => 'text',
						'title' => 'Skype URL',
						'sub_desc' => 'Shows up on the first page. Leave empty if not used.'
						),
					array(
						'id' => 'pinterest_url',
						'type' => 'text',
						'title' => 'Pinterest URL',
						'sub_desc' => 'Shows up on the first page. Leave empty if not used.'
						)
					)
				);

$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_150_check.png',
				'title' => __('Navigation', 'nhp-opts'),
				'desc' => __('<p class="description">This area controls the menu(if it\'s not setup in Appearance -> Menus and the Breadcrumbs section. </p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'pages_topmenu',
						'type' => 'pages_multi_select',
						'title' => __('Pages to include in the top menu', 'nhp-opts'), 
						'sub_desc' => __('It will be used if you don\'t setup the menu in Appearance -> Menus', 'nhp-opts'),
						)											
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_157_show_lines.png',
				'title' => __('Integration', 'nhp-opts'),
				'desc' => __('<p class="description">Use this to integrate google analytics code or to add any meta tag / html code you want.</p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'integration_footer',
						'type' => 'textarea',
						'title' => __('Code before the &lt;/body&gt; tag', 'nhp-opts'), 
						'sub_desc' => __('<strong>Use this one for google analytics for example.</strong>', 'nhp-opts'),
						'std' => ''
						),
					array(
						'id' => 'integration_header',
						'type' => 'textarea',
						'title' => __('The code will be added before the &lt;/head&gt; tag', 'nhp-opts'), 
						'sub_desc' => __('Use this one if you want to verify your site for google/bing/alexa/etc for example.', 'nhp-opts'),
						'std' => ''
						),
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_107_text_resize.png',
				'title' => __('Colorization & Fonts', 'nhp-opts'),
				'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'enable_colorization',
						'type' => 'button_set',
						'options' => array('1' => 'Yes', '0' => 'No'),
						'title' => 'Enable custom colorization & font changes?',
						'sub_desc' => '<strong>Please note that if you enable if, all the bottom settings will be used. For just some changes, use style.css.</strong>',
						'std' => 0
						),
					array(
						'id' => 'bg_image',
						'type' => 'upload',
						'title' => 'Background image',
						'sub_desc' => 'Use this only if you want a custom background image, different than the default one.'
						),
					array(
						'id' => 'separator_bg',
						'type' => 'upload',
						'title' => 'Separator background image',
						'sub_desc' => 'This is the image used in the page separators as the background imge..'
						),
					array(
						'id' => 'bg_color',
						'type' => 'color',
						'title' => 'Background color',
						'sub_desc' => 'This will override any background image that was used previously and use just a color.'
						),
					array(
						'id' => 'body_font',
						'title' => 'Font for the page titles:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the body text',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'body_size',
						'type' => 'text',
						'title' => 'The default font size for the body text',
						'sub_desc' => 'This is the default font-size used on the body text(use just numbers, without px)',
						'std' => '14',
						'validate' => 'numeric'
						),	
					array(
						'id' => 'body_color',
						'title' => 'Color for the body text:',
						'type' => 'color',
						'sub_desc' => 'The color used on the body text',
						'std' => '#737373'
						),
					array(
						'id' => 'top_headertext_size',
						'type' => 'text',
						'title' => 'Font-size for the top header text',
						'sub_desc' => 'This is the font-size of the first big text on the homepage. Use just numeric values without px',
						'std' => '90',
						'validate' => 'numeric'
						),		
					array(
						'id' => 'top_headertext_color',
						'type' => 'color',
						'title' => 'Color for the top header text',
						'sub_desc' => 'This is the color of the first big text on the homepage.',
						'std' => '#FFFFFF',
						),	
					array(
						'id' => 'top_smalltext_size',
						'type' => 'text',
						'title' => 'Font-size for the small header text',
						'sub_desc' => 'Font-size for the small text under the big one, on the first page. Use just numeric values without px',
						'std' => '80',
						'validate' => 'numeric'
						),		
					array(
						'id' => 'top_smalltext_color',
						'type' => 'color',
						'title' => 'Color for the small header text',
						'sub_desc' => 'This is the color of the small text in the header, under the big heading.',
						'std' => '#FFFFFF',
						),	
					array(
						'id' => 'top_smallertext_size',
						'type' => 'text',
						'title' => 'Font-size for the smaller header text',
						'sub_desc' => 'Font-size for the smaller text under the small text above, on the first page. Use just numeric values without px',
						'std' => '40',
						'validate' => 'numeric'
						),		
					array(
						'id' => 'top_smallertext_color',
						'type' => 'color',
						'title' => 'Color for the smaller header text',
						'sub_desc' => 'This is the color of the smaller text in the header, under the small text above.',
						'std' => '#FFFFFF',
						),		
					array(
						'id' => 'nav_color',
						'type' => 'color',
						'title' => 'The color for the navigation menu',
						'sub_desc' => 'The color used on the navigation menu',
						'std' => '#FFFFFF'
						),
					array(
						'id' => 'nav_hovercolor',
						'type' => 'color',
						'title' => 'The hover color for the navigation menu',
						'sub_desc' => 'The hover color used on the navigation menu',
						'std' => '#464646'
						),
					array(
						'id' => 'nav_size',
						'type' => 'text',
						'title' => 'The font-size for the navigation menu items',
						'sub_desc' => 'The font-size used on the navigation menu items',
						'std' => '14'
						),
					array(
						'id' => 'logo_color',
						'type' => 'color',
						'title' => 'The color for the logo letter',
						'sub_desc' => 'The color used on the logo letter',
						'std' => '#464646'
						),
					array(
						'id' => 'logo_size',
						'type' => 'text',
						'title' => 'The font-size for the logo letter',
						'sub_desc' => 'The font-size used on the logo letter',
						'std' => '36'
						),
					array(
						'id' => 'pagetitle_font',
						'title' => 'Font for the page titles:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on paragraphs',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'pagetitle_size',
						'type' => 'text',
						'title' => 'The default font size for the page titles',
						'sub_desc' => 'This is the default font-size used on the page titles(use just numbers, without px)',
						'std' => '38',
						'validate' => 'numeric'
						),	
					array(
						'id' => 'pagetitle_color',
						'title' => 'Color for the page titles:',
						'type' => 'color',
						'sub_desc' => 'The color used on the page titles',
						'std' => '#4F4F4F'
						),
					array(
						'id' => 'headline_font',
						'title' => 'Font for the page titles:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on paragraphs',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'headline_size',
						'type' => 'text',
						'title' => 'The default font size for the page titles',
						'sub_desc' => 'This is the default font-size used on the page titles(use just numbers, without px)',
						'std' => '14',
						'validate' => 'numeric'
						),		
					array(
						'id' => 'headline_color',
						'title' => 'Color for the headline on posts/pages:',
						'type' => 'color',
						'sub_desc' => 'The color used on the page titles',
						'std' => '#686868'
						),			
					array(
						'id' => 'h3_size',
						'type' => 'text',
						'title' => 'The default font size for the h3 heading',
						'sub_desc' => 'This is the default font-size used on the h3 headings(use just numbers, without px)',
						'std' => '24',
						'validate' => 'numeric'
						),					
					array(
						'id' => 'h3_font',
						'title' => 'The default font for the h3 heading:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the h3 headings',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'h4_size',
						'type' => 'text',
						'title' => 'The default font size for the h4 heading',
						'sub_desc' => 'This is the default font-size used on the h4 headings(use just numbers, without px)',
						'std' => '18',
						'validate' => 'numeric'
						),					
					array(
						'id' => 'h4_font',
						'title' => 'The default font for the h4 heading:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the h4 headings',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'testimonial_size',
						'type' => 'text',
						'title' => 'The default font size for the testimonials',
						'sub_desc' => 'This is the default font-size used on the testimonials(use just numbers, without px)',
						'std' => '14',
						'validate' => 'numeric'
						),					
					array(
						'id' => 'testimonial_font',
						'title' => 'The default font for the testimonials:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the testimonials',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'testimonial_color',
						'title' => 'The color for the testimonials',
						'type' => 'color',
						'std' => '#8C8C8C'
						),
					array(
						'id' => 'separator_size',
						'type' => 'text',
						'title' => 'The default font size for the separators',
						'sub_desc' => 'This is the default font-size used on the separators(use just numbers, without px)',
						'std' => '33',
						'validate' => 'numeric'
						),					
					array(
						'id' => 'separator_font',
						'title' => 'The default font for the separators:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the separators',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'separator_color',
						'title' => 'The color for the separators',
						'type' => 'color',
						'std' => '#ffffff'
						),
					array(
						'id' => 'footer_size',
						'type' => 'text',
						'title' => 'The default font size for the footer text',
						'sub_desc' => 'This is the default font-size used on the footer text(use just numbers, without px)',
						'std' => '14',
						'validate' => 'numeric'
						),					
					array(
						'id' => 'footer_font',
						'title' => 'The default font for the footer text:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the footer text',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'footer_color',
						'title' => 'The default color for the footer text:',
						'type' => 'color',
						'sub_desc' => 'The color of the footer text',
						'std' => '#FFFFFF'
						),
				)
			);				
				
	$tabs = array();
			
	if (function_exists('wp_get_theme')){
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data->get('ThemeURI');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');
	}else{
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data['ThemeURI'];
		$description = $theme_data['Description'];
		$author = $theme_data['Author'];
		$version = $theme_data['Version'];
		$tags = $theme_data['Tags'];
	}	

	$theme_info = '<div class="nhp-opts-section-desc">';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'nhp-opts').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'nhp-opts').$author.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'nhp-opts').$version.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-description">'.$description.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'nhp-opts').implode(', ', $tags).'</p>';
	$theme_info .= '</div>';



	$tabs['theme_info'] = array(
					'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_195_circle_info.png',
					'title' => __('Theme Information', 'nhp-opts'),
					'content' => $theme_info
					);
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
		$tabs['theme_docs'] = array(
						'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'nhp-opts'),
						'content' => nl2br(file_get_contents(trailingslashit(get_stylesheet_directory()).'README.html'))
						);
	}//if

	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>