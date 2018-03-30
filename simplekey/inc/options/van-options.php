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
	
	$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'SimpleKey'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'SimpleKey'),
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
	
	$google_webfonts = array( 
		 'league_gothic'=>"League Gothic",
		 'infinity'=>"infinity",
		 'nexa_boldregular'=>"Nexa Bold",
		 'nexa_lightregular'=>"Nexa Light",
		 'Abel' => "Abel",
		 'Abril+Fatface' => "Abril Fatface",
		 'Aclonica' => "Aclonica",
		 'Actor' => "Actor",
		 'Adamina' => "Adamina",
		 'Aguafina+Script' => "Aguafina Script",
		 'Aladin' => "Aladin",
		 'Aldrich' => "Aldrich",
		 'Alegreya+Sans+SC' => "Alegreya Sans SC",
		 'Alice' => "Alice",
		 'Alike+Angular' => "Alike Angular",
		 'Alike' => "Alike",
		 'Allan' => "Allan",
		 'Allerta+Stencil' => "Allerta Stencil",
		 'Allerta' => "Allerta",
		 'Armata' => "Armata",
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
		 'Elsie+Swash+Caps' => "Elsie Swash Caps",
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
		 'Julius+Sans+One'=>'Julius Sans One',
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
		 'Londrina+Outline' => "Londrina Outline",
		 'Love+Ya+Like+A+Sister' => "Love Ya Like A Sister",
		 'Loved+by+the+King' => "Loved by the King",
		 'Luckiest+Guy' => "Luckiest Guy",
		 'Lusitana' => "Lusitana",
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
		 'Montserrat' >"Montserrat",
		 'Montez' => "Montez",
		 'Mountains+of+Christmas' => "Mountains of Christmas",
		 'Mr+Bedford' => "Mr Bedford",
		 'Mr+Dafoe' => "Mr Dafoe",
		 'Mr+De+Haviland' => "Mr De Haviland",
		 'Mrs+Sheppards' => "Mrs Sheppards",
		 'Muli' => "Muli",
		 'Museo' => "Museo",
		 'Museo+Sans' => "Museo Sans",
		 'Museo+Slab' => "Museo Slab",
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
		 'Share' => "Share",
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
		 'Source+Sans+Pro' => "Source Sans Pro",
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
$args['dev_mode'] = false;

//google api key MUST BE DEFINED IF YOU WANT TO USE GOOGLE WEBFONTS
//$args['google_api_key'] = '***';

//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
$args['intro_text'] = __('', 'SimpleKey');

//Setup custom links in the footer for share icons
$args['share_icons']['twitter'] = array(
										'link' => 'http://twitter.com/themevan',
										'title' => 'Follow us on Twitter', 
										'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_322_twitter.png'
										);
$args['share_icons']['facebook'] = array(
										'link' => 'http://facebook.com/themevan',
										'title' => 'Follow us on Facebook', 
										'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_320_facebook.png'
										);
$args['share_icons']['Rss'] = array(
										'link' => 'http://www.themevan.com',
										'title' => 'Subscribe our website', 
										'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_327_rss.png'
										);

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = 'van';

//Custom menu icon
//$args['menu_icon'] = '';

//Google API Key
//$args['google_api_key']='';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('SimpleKey Options', 'SimpleKey');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('SimpleKey Theme Options', 'SimpleKey');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'SimpleKey_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 49;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';

//Want to disable the sections showing as a submenu in the admin? uncomment this line
$args['allow_sub_menu'] = false;
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-1',
							'title' => __('Theme Information 1', 'SimpleKey'),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'SimpleKey')
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-2',
							'title' => __('Theme Information 2', 'SimpleKey'),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'SimpleKey')
							);

//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'SimpleKey');



$sections = array();

$sections[] = array(
				'title' => __('General Setting', 'SimpleKey'),
				'desc' => __('<p class="description">Configure and initialize the general setting of theme.</p>', 'SimpleKey'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_019_cogwheel.png',
				'fields' => array(
				    array(
						'id' => 'logo',
						'type' => 'upload',
						'title' => __('Custom LOGO','SimpleKey'),
						'sub_desc' => __('Customize your own LOGO, the best size: 170X65px','SimpleKey')
						),
						
					array(
						'id' => 'high_logo',
						'type' => 'upload',
						'title' => __('Retina(HiDPI) LOGO','SimpleKey'),
						'sub_desc' => __('If the logo file name is "logo.png", then rename your retina logo file to "logo@2x.png"','SimpleKey')
						),
						
				    array(
						'id' => 'favicon',
						'type' => 'upload',
						'title' => __('Favicon','SimpleKey'),
						'sub_desc' => __('Setting your favicon in the brower address bar for your website','SimpleKey')
						),
					
					 array(
						'id' => 'sticky_top',
						'type' => 'textarea',
						'title' => __('Custom Content Of Sticky Top Area. ','SimpleKey'),
						'validate' => 'html',
						'sub_desc' => __('You can add your custom content or HTML codes in this field, it will displayed above the top menu bar.','SimpleKey'),
						'std' => ''
						),
					
					 array(
						'id' => 'home_revslider',
						'type' => 'text',
						'title' => __('Revolution Slider Shortcode','SimpleKey'),
						'sub_desc' => __('Enter the shortcode revolution slider, it will show up in the front page.','SimpleKey'),
						'std' => ''
						),
					
					 array(
						'id' => 'home_top_height',
						'type' => 'text',
						'title' => __('The Height of Home Top Section','SimpleKey'),
						'desc' => __('Don\'t forget the unit - px','SimpleKey'),
						'sub_desc' => __('Please enter the height value which you set for the top slider in Revolution Slider setting page.','SimpleKey'),
						'std' => '400'
						),
                
				    array(
						'id' => 'pages_navi',
						'type' => 'pages_multi_select',
						'title' => __('Pages included in the top primary navigation.','SimpleKey'), 
						'sub_desc' => __('Choose what pages you want it to displayed in the primary navigation if you are not set custom menu and make it to be anchor point.','SimpleKey'),
						'args' => '',
						'std' => ''
						),
					
				  array(
						'id' => 'portfolio_columns',
						'type' => 'select',
						'title' => __('The column number of the portfolios in Portfolios Archive Page','SimpleKey'), 
						'sub_desc' => __('This option is effect on the sub page which you have select "Portfolios Archives" template.','SimpleKey'),
						'options' => array(3=>'3',4=>'4',5=>'5'),
						'std' => '3'
						),

                   array(
						'id' => 'copyright',
						'type' => 'text',
						'title' => __('Copyright Info','SimpleKey'),
						'validate' => 'html',
						'sub_desc' => __('HTML Allowed','SimpleKey'),
						'std' => __('Copyright 2013. All right reserved','SimpleKey')
						),
					
				   array(
						'id' => 'theme_credit',
						'type' => 'button_set',
						'options' => array('1' => 'Yes', '0' => 'No'),
						'title' => __('Show Theme Credit?','SimpleKey'),
						'sub_desc' => __('If you choose NO,"Theme designed by ThemeVan" text will be remove from footer,of course we hope your support.','SimpleKey'),
						'std' => 1
						),
					
				  array(
						'id' => 'top_social',
						'type' => 'button_set',
						'options' => array('1' => 'Yes', '0' => 'No'),
						'title' => __('Hide the social icons from the top bar.','SimpleKey'),
						'sub_desc' => __('The top social icons will be hidden on mobile by default.','SimpleKey'),
						'std' => 0
						),	
				  
						
				   array(
						'id' => 'show_mobile_logo',
						'type' => 'button_set',
						'options' => array('1' => 'Yes', '0' => 'No'),
						'title' => __('Show LOGO on Mobile Phone','SimpleKey'),
						'sub_desc' => '',
						'std' => 1
						),	
					
				        array(
						'id' => 'isLoad',
						'type' => 'button_set',
						'options' => array('1' => 'No', '0' => 'Yes'),
						'title' => __('Disable The Preloading Process','SimpleKey'),
						'sub_desc' => '',
						'std' => 1
						),
					
					array(
						'id' => 'isParallax',
						'type' => 'button_set',
						'options' => array('1' => 'No', '0' => 'Yes'),
						'title' => __('Disable Parallax Effect','SimpleKey'),
						'sub_desc' => __('If you don\'t want the background image of section moved, please disable the parallax effect. ','SimpleKey'),
						'std' => 1
						),
					
					array(
						'id' => 'isNiceScroll',
						'type' => 'button_set',
						'options' => array('1' => 'No', '0' => 'Yes'),
						'title' => __('Disable Nice Scroll Plugin','SimpleKey'),
						'sub_desc' => __('Just use native scroll bar after you disabled','SimpleKey'),
						'std' => 1
						),
					
					array(
						'id' => 'isResponsive',
						'type' => 'button_set',
						'options' => array('1' => 'No', '0' => 'Yes'),
						'title' => __('Disable Responsive','SimpleKey'),
						'sub_desc' => __('If you selected Yes, the website will be displayed as desktop version on your smartphone and iPad','SimpleKey'),
						'std' => 1
						),
					
					array(
						'id' => 'blogSidebar',
						'type' => 'button_set',
						'options' => array('1' => 'No', '0' => 'Yes'),
						'title' => __('Enable the sidebar in single post page','SimpleKey'),
						'sub_desc' => '',
						'std' => 1
						),
					
					array(
						'id' => 'hide_contact',
						'type' => 'button_set',
						'options' => array('1' => 'No', '0' => 'Yes'),
						'title' => __('Remove the contact area from page bottom','SimpleKey'),
						'sub_desc' => '',
						'std' => 1
						),
					array(
						'id' => 'hide_foot',
						'type' => 'button_set',
						'options' => array('1' => 'No', '0' => 'Yes'),
						'title' => __('Remove the footer from page bottom','SimpleKey'),
						'sub_desc' => '',
						'std' => 1
						),
					array(
						'id' => 'hide_backtoTop',
						'type' => 'button_set',
						'options' => array('1' => 'No', '0' => 'Yes'),
						'title' => __('Hide Back To Top Button','SimpleKey'),
						'sub_desc' => '',
						'std' => 1
						),
				  )
				);	

		
$sections[] = array(
				'title' => __('Contact section', 'SimpleKey'),
				'desc' => __('<p class="description">Fill in your Email,telphone number,fax and other contact page setting,they will be displayed at the bottom of pages.</p>', 'SimpleKey'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_121_message_empty.png',
				'fields' => array(	
				   array(
						'id' => 'enable_captcha',
						'type' => 'button_set',
						'options' => array('1' => 'Yes', '0' => 'No'),
						'title' => __('Enable captcha for contact form','SimpleKey'),
						'sub_desc' => '',
						'std' => 0
						),	
						
				  array(
						'id' => 'contact_custom',
						'type' => 'textarea',
						'title' => __('Custom Content','SimpleKey'),
						'validate' => 'html',
						'sub_desc' => __('If you add your custom content here, it will instead of the value of following fields.','SimpleKey'),
						'desc' => __('HTML Tags allowed','SimpleKey'),
						'std' => ''
						),
				
				   array(
						'id' => 'name',
						'type' => 'text',
						'title' => __('Your name','SimpleKey'),
						'sub_desc' => __('','SimpleKey'),
						'std' => get_bloginfo('name').' Administrator'
						),
				
                    array(
						'id' => 'email',
						'type' => 'text',
						'title' => __('E-mail','SimpleKey'),
						'validate' => 'email',
						'msg' => __('The email address is invalid,please check it again.','SimpleKey'),
						'sub_desc' => __('You will use this email to receive the customer message via the contact page','SimpleKey'),
						'std' => get_bloginfo('admin_email')
						),
					array(
						'id' => 'phone',
						'type' => 'text',
						'title' => __('Telphone','SimpleKey'),
						'sub_desc' => __('','SimpleKey'),
						'std' => ''
						),
					array(
						'id' => 'skype',
						'type' => 'text',
						'title' => __('Skype','SimpleKey'),
						'sub_desc' => __('','SimpleKey'),
						'std' => ''
						),
					array(
						'id' => 'fax',
						'type' => 'text',
						'title' => __('Fax','SimpleKey'),
						'sub_desc' => __('','SimpleKey'),
						'std' => ''
						),
					array(
						'id' => 'address',
						'type' => 'text',
						'title' => __('Address','SimpleKey'),
						'sub_desc' => __('','SimpleKey'),
						'std' => ''
						),
					array(
						'id' => 'contact_title',
						'type' => 'text',
						'title' => __('Page main title','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' => __('','SimpleKey'),
						'std' => 'Contact us'
						),
					array(
						'id' => 'contact_sub_title',
						'type' => 'text',
						'title' => __('Page subtitle','SimpleKey'),
						'validate' => 'html',
						'sub_desc' => __('','SimpleKey'),
						'std' => 'Using the contact form to send us email at below'
						),
					array(
						'id' => 'contact_intro_title',
						'type' => 'text',
						'title' => __('Introduction title','SimpleKey'),
						'validate' => 'html',
						'sub_desc' => __('','SimpleKey'),
						'std' => '<strong>Keep in touch</strong> with us'
						),
                    array(
						'id' => 'contact_content',
						'type' => 'textarea',
						'title' => __('Page content','SimpleKey'),
						'validate' => 'html',
						'sub_desc' => __('','SimpleKey'),
						'desc' => __('HTML Tags allowed','SimpleKey'),
						'std' => 'You can use the following information to contact us if you wanna join us or anything need to communicate.'
						),
						
					array(
						'id' => 'subscribe_intro_title',
						'type' => 'text',
						'title' => __('Subscribe title','SimpleKey'),
						'validate' => 'html',
						'sub_desc' => __('','SimpleKey'),
						'std' => 'You can <strong>subscribe to us</strong>'
						),
					
					array(
						'id' => 'subscribe_form',
						'type' => 'textarea',
						'title' => __('Subscribe Form code','SimpleKey'),
						'sub_desc' =>  __('First,go to <a href="http://mailchimp.com/" target="_blank">mailchimp</a> and get the form code, then replace URL of the form action property to yours.','SimpleKey'),
						'desc' => __('Leave empty if you want to remove it','SimpleKey'),
						'std' => '<form action="http://themevan.us6.list-manage2.com/subscribe/post?u=2740080adc389393d6694082d&amp;id=0eb745d701" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>'.PHP_EOL.'<input type="text" id="mce-EMAIL" name="EMAIL" class="subscribe-input" value="" placeholder="Submit your Email" required />'.PHP_EOL.'<button type="submit" name="submit" id="mc-embedded-subscribe" class="large_btn subscribe-btn">Subscribe</button>'.PHP_EOL.'</form>'
						),
					
				  )
				);

$sections[] = array(
				'title' => __('Social Network', 'SimpleKey'),
				'desc' => __('<p class="description">Add image or text for top cover page</p>', 'SimpleKey'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_003_user.png',
				'fields' => array(
                    array(
						'id' => 'facebook',
						'type' => 'text',
						'title' => __('Facebook URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' => '',
						'std' => ''
						),
				    array(
						'id' => 'twitter',
						'type' => 'text',
						'title' => __('Twitter URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'googlplus',
						'type' => 'text',
						'title' => __('Google+ URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'deviantart',
						'type' => 'text',
						'title' => __('Deviantart URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'flickr',
						'type' => 'text',
						'title' => __('Flicker URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'tumblr',
						'type' => 'text',
						'title' => __('Tumblr URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'behance',
						'type' => 'text',
						'title' => __('Behance URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'dribbble',
						'type' => 'text',
						'title' => __('Dribbble URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'pinterest',
						'type' => 'text',
						'title' => __('Pinterest URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'youtube',
						'type' => 'text',
						'title' => __('Youtube URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'vimeo',
						'type' => 'text',
						'title' => __('Vimeo URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'linkedIn',
						'type' => 'text',
						'title' => __('linkedIn URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'myspace',
						'type' => 'text',
						'title' => __('My Space URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'github',
						'type' => 'text',
						'title' => __('GitHub URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'soundCloud',
						'type' => 'text',
						'title' => __('SoundCloud URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'hearthis',
						'type' => 'text',
						'title' => __('Hearthis URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'blogger',
						'type' => 'text',
						'title' => __('Blogger URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),					
				    array(
						'id' => 'myemail',
						'type' => 'text',
						'title' => __('Email','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'aim',
						'type' => 'text',
						'title' => __('AIM ID','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'yahooim',
						'type' => 'text',
						'title' => __('Yahoo IM ID','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'instagram',
						'type' => 'text',
						'title' => __('Tnstagram URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'meetup',
						'type' => 'text',
						'title' => __('Meetup URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),

					array(
						'id' => 'fivehundreds',
						'type' => 'text',
						'title' => __('500px URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
						
					array(
						'id' => 'xing',
						'type' => 'text',
						'title' => __('Xing URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'klout',
						'type' => 'text',
						'title' => __('Klout URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
						),
					array(
						'id' => 'houzz',
						'type' => 'text',
						'title' => __('Houzz URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
					),
					array(
						'id' => 'vk',
						'type' => 'text',
						'title' => __('VK URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
					),
					array(
						'id' => 'yelp',
						'type' => 'text',
						'title' => __('Yelp URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => ''
					),
					array(
						'id' => 'rss',
						'type' => 'text',
						'title' => __('RSS URL','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' =>'',
						'std' => home_url().'/feed'
						),
				  )
				);
$sections[] = array(
				'title' => __('Custom Styles', 'SimpleKey'),
				'desc' => __('<p class="description">Customize color or font for elements</p>', 'SimpleKey'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_086_display.png',
				'fields' => array(
				    array(
						'id' => 'enable_custom',
						'type' => 'button_set',
						'options' => array('1' => 'Yes', '0' => 'No'),
						'title' => __('Enable Custom Styles','SimpleKey'),
						'sub_desc' => '',
						'std' => 0
						),
				
				    array(
						'id' => 'global_link',
						'type' => 'color',
						'title' => __('Global Link Color', 'SimpleKey'), 
						'sub_desc' => __('Customize global link color', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#f26c4f'
						),
					
					array(
						'id' => 'global_link_hover',
						'type' => 'color',
						'title' => __('Global Hover Link Color', 'SimpleKey'), 
						'sub_desc' => __('Customize global hover link color', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#232527'
						),
					
					array(
						'id' => 'selection_color',
						'type' => 'color',
						'title' => __('Selection Color', 'SimpleKey'), 
						'sub_desc' => __('Customize the background color when you selected the text', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#83b350'
						),
					
					array(
						'id' => 'sticky_top_bg',
						'type' => 'color',
						'title' => __('Background Color of Extra Top Bar ', 'SimpleKey'), 
						'sub_desc' => __('Customize background color for the extra top bar which is above the top menu.', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#222222'
						),
				
					array(
						'id' => 'navi_bg',
						'type' => 'color',
						'title' => __('Navigation Background Color', 'SimpleKey'), 
						'sub_desc' => __('Customize background color for the navigation menu', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#000000'
						),
					
					array(						
					    'id' => 'navi_link_font',
						'title' => __('Navigation Link Font:'),
						'type' => 'select',
						'options' => $google_webfonts,
						'sub_desc' => __('Change the navigation link font,it is not act on mobile Phone device.','SimpleKey'),
						'desc'=>__('Preview the font in <a href="http://www.google.com/webfonts" target="_blank">google fonts</a>','SimpleKey'),
						'std' => 'nexa_boldregular'
						),
					
					array(						
					    'id' => 'navi_link_size',
						'title' => __('The Font Size of Navigation Link:','SimpleKey'),
						'type' => 'text',
						'sub_desc' =>'',
						'desc'=> __('px'),
						'std' => '14'
						),
					
					array(
						'id' => 'navi_link',
						'type' => 'color',
						'title' => __('Navigation Link Color', 'SimpleKey'), 
						'sub_desc' => __('Customize the color for the navigation link', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#ffffff'
						),
					
					array(
						'id' => 'navi_link_hover',
						'type' => 'color',
						'title' => __('Navigation link hover color', 'SimpleKey'), 
						'sub_desc' => __('Customize the hover color for the navigation link', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#999999'
						),
					
					array(
						'id' => 'navi_link_bghover',
						'type' => 'color',
						'title' => __('Navigation link hover background color', 'SimpleKey'), 
						'sub_desc' => __('Customize the hover background color for the navigation link', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#111111'
						),
					
					array(
						'id' => 'navi_link_active',
						'type' => 'color',
						'title' => __('Navigation link active color', 'SimpleKey'), 
						'sub_desc' => __('Customize the active color for the navigation link', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#f26c4f'
						),
					
					array(
						'id' => 'footer_bg_color',
						'type' => 'color',
						'title' => __('Footer Background Color', 'SimpleKey'), 
						'sub_desc' => __('Customize the footer background color', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#1d1d1d'
						),

				   array(
						'id' => 'footer_text_color',
						'type' => 'color',
						'title' => __('Footer Text Color', 'SimpleKey'), 
						'sub_desc' => __('Customize the footer text color', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => ''
						),
						
					array(
						'id' => 'footer_link',
						'type' => 'color',
						'title' => __('Footer Link Color', 'SimpleKey'), 
						'sub_desc' => __('Customize the footer link color', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#898989'
						),
					
					array(
						'id' => 'footer_link_hover',
						'type' => 'color',
						'title' => __('Footer Link Hover Color', 'SimpleKey'), 
						'sub_desc' => __('Customize the footer link hover color', 'SimpleKey'),
						'desc' => __('Pick a color.', 'SimpleKey'),
						'std' => '#ffffff'
						),
					
					
					array(						
					    'id' => 'section_heading_font',
						'title' => __('Sections Font Head Title:','SimpleKey'),
						'type' => 'select',
						'options' => $google_webfonts,
						'sub_desc' => __('Change the sections head title font,it is not act on mobile Phone device.','SimpleKey'),
						'desc'=>__('Preview the font in <a href="http://www.google.com/webfonts" target="_blank">google fonts</a>','SimpleKey'),
						'std' => 'nexa_boldregular'
						),
					
					array(						
					    'id' => 'section_heading_size',
						'title' => __('The Font Size of Sections Head Title:','SimpleKey'),
						'type' => 'text',
						'sub_desc' => __('','SimpleKey'),
						'desc'=> __('px'),
						'std' => '48'
						),
					
					array(						
					    'id' => 'section_subtitle_font',
						'title' => __('Sections Sub Title Font:','SimpleKey'),
						'type' => 'select',
						'options' => $google_webfonts,
						'sub_desc' => __('Change the sections sub title font,it is not act on mobile Phone device.','SimpleKey'),
						'desc'=>__('Preview the font in <a href="http://www.google.com/webfonts" target="_blank">google fonts</a>','SimpleKey'),
						'std' => 'nexa_lightregular'
						),
					
				   array(						
					    'id' => 'section_subtitle_size',
						'title' => __('The Font Size of Sections Sub Title:','SimpleKey'),
						'type' => 'text',
						'sub_desc' => __('','SimpleKey'),
						'desc'=> __('px'),
						'std' => '18'
						),
					
					array(
						'id' => 'contact_background_color',
						'type' => 'color',
						'title' => __('Background Color of Contact Section','SimpleKey'),
						'sub_desc' => __('Pick a color.','SimpleKey'),
						'std' => '#313131'
						),
					
					array(
						'id' => 'contact_background',
						'type' => 'text',
						'title' => __('Background Image of Contact Section','SimpleKey'),
						'validate' => 'no_html',
						'sub_desc' => __('Fill in the background image URL','SimpleKey'),
						'std' => ''
						),
					
					array(
						'id' => 'contact_text_color',
						'type' => 'color',
						'title' => __('Text Color of Contact Section','SimpleKey'),
						'sub_desc' => __('Pick a color.','SimpleKey'),
						'std' => '#ffffff'
						),
						
					array(
						'id' => 'contact_input_background',
						'type' => 'color',
						'title' => __('Background of Contact Form Field','SimpleKey'),
						'sub_desc' => __('Pick a color.','SimpleKey'),
						'std' => '#454545'
						),
					
					array(
						'id' => 'contact_input_text',
						'type' => 'color',
						'title' => __('Text Color of Contact Form Field','SimpleKey'),
						'sub_desc' => __('Pick a color.','SimpleKey'),
						'std' => '#8c8c8c'
						),
						
					array(
						'id' => 'contact_btn_background',
						'type' => 'color',
						'title' => __('Background Color of Contact Form Button','SimpleKey'),
						'sub_desc' => __('Pick a color.','SimpleKey'),
						'std' => '#9f6248'
						),
						
					array(
						'id' => 'contact_btn_text',
						'type' => 'color',
						'title' => __('Text Color of Contact Form Button','SimpleKey'),
						'sub_desc' => __('Pick a color.','SimpleKey'),
						'std' => '#4c2d20'
						),
				  )
				);
$sections[] = array(
				'title' => __('Additionals', 'SimpleKey'),
				'desc' => __('<p class="description">Additional options.</p>', 'SimpleKey'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_030_pencil.png',
				'fields' => array(
                    array(
						'id' => 'additional_code',
						'type' => 'textarea',
						'title' => __('Additional Codes','SimpleKey'),
						'sub_desc' => __('You can add some CSS,Javascript,Statistics code or META infomation inside head tag','SimpleKey'),
						'std' => ''
						),
				     array(
						'id' => 'footer_code',
						'type' => 'textarea',
						'title' => __('Footer Code','SimpleKey'),
						'sub_desc' => __('You can add some CSS,Javascript,Statistics code at the end of HTML document.','SimpleKey'),
						'std' => ''
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
		$theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()).'style.css');
		$theme_uri = $theme_data['URI'];
		$description = $theme_data['Description'];
		$author = $theme_data['Author'];
		$version = $theme_data['Version'];
		$tags = $theme_data['Tags'];
	}	

	$theme_info = '<div class="nhp-opts-section-desc">';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'SimpleKey').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'SimpleKey').$author.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'SimpleKey').$version.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-description">'.$description.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'SimpleKey').implode(', ', $tags).'</p>';
	$theme_info .= '</div>';



	$tabs['theme_info'] = array(
					'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_195_circle_info.png',
					'title' => __('Theme Information', 'SimpleKey'),
					'content' => $theme_info
					);
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
		$tabs['theme_docs'] = array(
						'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'SimpleKey'),
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