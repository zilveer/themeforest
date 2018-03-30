<?php

add_action('init', 'of_options');

if (!function_exists('of_options')) {
function of_options() {

// Background Images Reader
$bg_images_path = get_template_directory() . '/images/patterns/'; // change this to where you store your bg images
$bg_images_url = get_template_directory_uri() . '/images/patterns/'; // change this to where you store your bg images
$bg_images = array();
if ( is_dir($bg_images_path) ) {
	if ($bg_images_dir = opendir($bg_images_path) ) { 
		while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
			if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
				$bg_images[] = $bg_images_url . $bg_images_file;
			}
		}
	}
}
asort($bg_images);

// Google Fonts
$google_fonts = royalgold_google_fonts();

// Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages( 'parent=0' );
foreach ( $of_pages_obj as $of_page ) {
	$of_pages[$of_page->post_name] = $of_page->post_title;
}
$of_pages_tmp = array_unshift( $of_pages, '' );

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array(
	"name" => __('General Settings','royalgold'),
	"class" => "generalsettings",
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Logo', 'royalgold'),
	"desc" => __('Select a graphic logo to be used instead of the text version. (it will get resized to fit the design and have retina display support)', 'royalgold'),
	"id" => "custom_logo",
	"std" => '',
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Custom CSS', 'royalgold'),
	"desc" => __('Quickly add some CSS to your theme by adding it into this block - it will be inserted after the theme style, so it can override any element. This avoids tweaking the core files directly and it\'s the recommanded way to apply personal style to your site.', 'royalgold'),
	"id" => "custom_css",
	"options" => array("rows" => 12),
	"std" => "",
	"type" => "textarea"
);

// Style
$of_options[] = array(
	"name" => __('Style Settings','royalgold'),
	"class" => "stylesettings",
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Base Color','royalgold'),
	"desc" => __('Select the main color of the theme (leave field empty for default theme color).', 'royalgold'),
	"id" => "color_base",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Link Color','royalgold'),
	"desc" => __('Select the color of the links in the content area (leave field empty for default theme color).', 'royalgold'),
	"id" => "color_link",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Background Color','royalgold'),
	"desc" => __('Select the page background color of the theme (leave field empty for default theme color).', 'royalgold'),
	"id" => "color_background",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Background Pattern','royalgold'),
	"desc" => __('Select the background pattern of the theme. <br />If you want to add more images just drop them in the <strong>images/patterns</strong> folder in the theme.', 'royalgold'),
	"id" => "bg_pattern",
	"type" => "tiles",
	"options" 	=> $bg_images,
);

$of_options[] = array(
	"name" => __('Body Text Google Font','royalgold'),
	"desc" => __('Select the body text font of the theme. For more fonts use a plugin like', 'royalgold') .' <a href="http://wordpress.org/plugins/wp-google-fonts/">' . __('WP Google Fonts', 'royalgold') . '</a>',
	"id" => "font_body",
	"std" => '',
	"type" => "select_google_font",
	"preview" => array(
		"text" => __('The quick brown fox jumps over the lazy dog.', 'royalgold'),
		"size" => "22px"
	),
	"options" => $google_fonts
);

$of_options[] = array(
	"name" => __('Headers Google Font','royalgold'),
	"desc" => __('Select the font used for all the headers (h1, h2, h3, h4, h5). For more fonts use a plugin like', 'royalgold') .' <a href="http://wordpress.org/plugins/wp-google-fonts/">' . __('WP Google Fonts', 'royalgold') . '</a>',
	"id" => "font_headers",
	"std" => "Oswald",
	"type" => "select_google_font",
	"preview" => array(
		"text" => __('The quick brown fox jumps over the lazy dog.', 'royalgold'),
		"size" => "22px"
	),
	"options" => $google_fonts
);

$of_options[] = array(
	"name" => __('Google Fonts Subset', 'royalgold'),
	"desc" => __('Set the subset used for the imported Google Fonts (ex: latin,cyrillic)', 'royalgold'),
	"id" => "google_fonts_subset",
	"std" => "latin",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Default Fallback Background Image', 'royalgold'),
	"desc" => __("Upload a background image that will be used as a fallback display for all pages and posts.", 'royalgold'),
	"id" => "background_fallback",
	"std" => '',
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Menu Extra Space', 'royalgold'),
	"desc" => __('This field extends the width for a bigger, larger logo and menu.', 'royalgold'),
	"id" => "extra_space_menu",
	"type" => "sliderui",
	"min" => 0,
	"max" => 80,
	"std" => 0,
	"step" => 1
);

$of_options[] = array(
	"name" => __('Main Content Extra Space', 'royalgold'),
	"desc" => __('This field extends the width for a bigger, larger content section.', 'royalgold'),
	"id" => "extra_space_content",
	"type" => "sliderui",
	"min" => 0,
	"max" => 180,
	"std" => 0,
	"step" => 5
);

$of_options[] = array(
	"name" => __('Menu Text Case', 'royalgold'),
	"desc" => __("Determine if the menu items get an uppercase effect.", 'royalgold'),
	"on" => __("Uppercase", 'royalgold'),
	"off" => __("Normal", 'royalgold'),
	"id" => "menu_text_case",
	"std" => 1,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Auto Expand Submenu', 'royalgold'),
	"desc" => __("Determine if a parent menu is auto-expanded if it has a selected sub-menu item.", 'royalgold'),
	"on" => __("Expand", 'royalgold'),
	"off" => __("Default", 'royalgold'),
	"id" => "menu_auto_expand_childs",
	"std" => 1,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Menu Toggle Button', 'royalgold'),
	"desc" => __("Determine if the header area contains a button that can toggle the visibility of the menu.", 'royalgold'),
	"on" => __("Visible", 'royalgold'),
	"off" => __("Hidden", 'royalgold'),
	"id" => "toggle_menu",
	"std" => 1,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Menu Toggle Button State', 'royalgold'),
	"desc" => __("Determine if the menu is hidden by default (can still be expanded to full view with user interaction).", 'royalgold'),
	"id" => "toggle_menu_state",
	"std" => 0,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Custom Scrollbars', 'royalgold'),
	"desc" => __("Determine if the pages have a thin black custom scrollbars instead of the default operating system scrollbars.", 'royalgold'),
	"id" => "custom_scrollbars",
	"std" => 0,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Supersized Gallery Options', 'royalgold'),
	"desc" => __("Modify options used for the full-page supersized gallery.", 'royalgold'),
	"id" => "supersized_view_options",
	"on" => __("Show", 'royalgold'),
	"off" => __("Hide", 'royalgold'),
	"std" => 0,
	"folds" => 1,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Supersized Gallery Autoplay', 'royalgold'),
	"desc" => __("Determines whether slideshow begins playing when page is loaded.", 'royalgold'),
	"id" => "supersized_autoplay",
	"fold" => "supersized_view_options",
	"std" => 1,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Supersized Gallery Slide Interval', 'royalgold'),
	"desc" => __("Time between slide changes in seconds (if autoplay is enabled).", 'royalgold'),
	"id" => "supersized_slide_interval",
	"fold" => "supersized_view_options",
	"type" => "sliderui",
	"min" => 1,
	"max" => 30,
	"std" => 6,
	"step" => 1
);

$supersized_transition = array(
	'none' => __('None', 'royalgold'),
	'fade' => __('Fade', 'royalgold'),
	'slideTop' => __('Slide in from the top', 'royalgold'),
	'slideRight' => __('Slide in from right', 'royalgold'),
	'slideBottom' => __('Slide in from bottom', 'royalgold'),
	'slideLeft' => __('Slide in from left', 'royalgold'),
	'carouselRight' => __('Carousel from right to left', 'royalgold'),
	'carouselLeft' => __('Carousel from left to right', 'royalgold'),
);
$of_options[] = array(
	"name" => __('Supersized Gallery Transition', 'royalgold'),
	"desc" => __("Controls which effect is used to transition between slides.", 'royalgold'),
	"id" => "supersized_transition",
	"fold" => "supersized_view_options",
	"type" => "select",
	"options" => $supersized_transition,
	"std" => 'fade',
);

$of_options[] = array(
	"name" => __('Supersized Gallery Transition Speed', 'royalgold'),
	"desc" => __("Time between slide changes in seconds (if a transition is enabled).", 'royalgold'),
	"id" => "supersized_transition_speed",
	"fold" => "supersized_view_options",
	"type" => "sliderui",
	"min" => 100,
	"max" => 2000,
	"step" => 50,
	"std" => 500,
);

$supersized_performance = array(
	'perf_0' => __('No adjustments', 'royalgold'),
	'perf_1' => __('Hybrid', 'royalgold'),
	'perf_2' => __('Higher image quality', 'royalgold'),
	'perf_3' => __('Faster transition speed, lower image quality', 'royalgold')
);
$of_options[] = array(
	"name" => __('Supersized Gallery Performance', 'royalgold'),
	"desc" => __("Uses image rendering options in Firefox and Internet Explorer to adjust image quality. This can speed up/slow down transitions. Webkit does not yet support these options.", 'royalgold'),
	"id" => "supersized_performance",
	"fold" => "supersized_view_options",
	"type" => "select",
	"options" => $supersized_performance,
	"std" => 'perf_1',
);

// Journal Settings
$of_options[] = array(
	"name" => __('Journal Page', 'royalgold'),
	"class" => "journalpage",
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Journal Page', 'royalgold'),
	"desc" => __('Select the journal page used to get back to all posts (used in single item post as return address to all items).', 'royalgold'),
	"id" => "journal_page",
	"type" => "select",
	"options" => $of_pages
);

$of_options[] = array(
	"name" => __('Show meta data information', 'royalgold'),
	"desc" => __("Determine if the metadata information is displayed inside a post.", 'royalgold'),
	"on" => __("Show", 'royalgold'),
	"off" => __("Hide", 'royalgold'),
	"id" => "single_post_meta",
	"std" => 0,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Single Post Extra Information', 'royalgold'),
	"desc" => __('Introduce extra information after the text of the post. This is a good place to add widgets like sharing tools, shortcodes, etc.', 'royalgold'),
	"id" => "single_post_extra",
	"std" => '',
	"type" => "textarea"
);

// other settings
$of_options[] = array(
	"name" => __('Other Settings', 'royalgold'),
	"class" => "othersettings",
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Footer Copyright Text', 'royalgold'),
	"desc" => __('You can use the following shortcodes in your footer text: [wp-link] [loginout-link] [blog-title] [blog-link] [the-year]', 'royalgold'),
	"id" => "footer_right_side",
	"std" => __('&copy; [the-year] [blog-title]. All Rights Reserved.', 'royalgold'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Footer More Information Text', 'royalgold'),
	"desc" => __('You can use the following shortcodes in your footer text: [wp-link] [loginout-link] [blog-title] [blog-link] [the-year]', 'royalgold'),
	"id" => "footer_left_side",
	"std" => '[social-link type="icon-twitter" url="#" title="Twitter"][/social-link] [social-link type="icon-facebook" url="#" title="Facebook"][/social-link] [social-link type="icon-googleplus" url="#" title="Google+"]',
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('404 Text', 'royalgold'),
	"desc" => __('Input your error message that gets displayed on the 404 page not found template.', 'royalgold'),
	"id" => "404_text",
	"std" => __('The page you are looking for has vanished. Maybe it was never here or it was moved to a better place.', 'royalgold'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('404 Image', 'royalgold'),
	"desc" => __('Select an image to be used as a 404 page not found graphics.', 'royalgold'),
	"id" => "404_image",
	"std" => '',
	"type" => "media"
);

// Support
$of_options[] = array(
	"name" => __('Support', 'royalgold'),
	"class" => "support",
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Support', 'royalgold'),
	"id" => "updates_info",
	"std" => '<strong>' . __('When encountering any issue please consult the documentation of this theme (from main purchased file) and do a quick internet search related to the issue - it might be a WordPress issue and not theme related.', 'royalgold') . '</strong><br><br>' . __('If you have no luck then send me a message via ThemeForest so I can validate your purchase first - please include your preview URL or temporary access to your WordPress admin in order for me to take a look as quick as possible. I\'ll do my best to help out.', 'royalgold') . '<br><br> <a class="button-primary" href="http://themeforest.net/user/liviu_cerchez#content" target="_blank">' . __('Send me a private message', 'royalgold') . '</a>',
	"type" => "info"
);

// Backup Options
$of_options[] = array(
	"name" => __('Backup Options', 'royalgold'),
	"class" => "backupoptions",
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Backup and Restore Options', 'royalgold'),
	"id" => "of_backup",
	"std" => "",
	"type" => "backup",
	"desc" => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'royalgold'),
);

$of_options[] = array(
	"name" => __('Transfer Theme Options Data', 'royalgold'),
	"id" => "of_transfer",
	"std" => "",
	"type" => "transfer",
	"desc" => __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'royalgold'),
);

}

function royalgold_google_fonts() {
	return array(""=>"","ABeeZee"=>"ABeeZee","Abel"=>"Abel","Abril Fatface"=>"Abril Fatface","Aclonica"=>"Aclonica","Acme"=>"Acme","Actor"=>"Actor","Adamina"=>"Adamina","Advent Pro"=>"Advent Pro","Aguafina Script"=>"Aguafina Script","Akronim"=>"Akronim","Aladin"=>"Aladin","Aldrich"=>"Aldrich","Alef"=>"Alef","Alegreya"=>"Alegreya","Alegreya SC"=>"Alegreya SC","Alex Brush"=>"Alex Brush","Alfa Slab One"=>"Alfa Slab One","Alice"=>"Alice","Alike"=>"Alike","Alike Angular"=>"Alike Angular","Allan"=>"Allan","Allerta"=>"Allerta","Allerta Stencil"=>"Allerta Stencil","Allura"=>"Allura","Almendra"=>"Almendra","Almendra Display"=>"Almendra Display","Almendra SC"=>"Almendra SC","Amarante"=>"Amarante","Amaranth"=>"Amaranth","Amatic SC"=>"Amatic SC","Amethysta"=>"Amethysta","Anaheim"=>"Anaheim","Andada"=>"Andada","Andika"=>"Andika","Angkor"=>"Angkor","Annie Use Your Telescope"=>"Annie Use Your Telescope","Anonymous Pro"=>"Anonymous Pro","Antic"=>"Antic","Antic Didone"=>"Antic Didone","Antic Slab"=>"Antic Slab","Anton"=>"Anton","Arapey"=>"Arapey","Arbutus"=>"Arbutus","Arbutus Slab"=>"Arbutus Slab","Architects Daughter"=>"Architects Daughter","Archivo Black"=>"Archivo Black","Archivo Narrow"=>"Archivo Narrow","Arimo"=>"Arimo","Arizonia"=>"Arizonia","Armata"=>"Armata","Artifika"=>"Artifika","Arvo"=>"Arvo","Asap"=>"Asap","Asset"=>"Asset","Astloch"=>"Astloch","Asul"=>"Asul","Atomic Age"=>"Atomic Age","Aubrey"=>"Aubrey","Audiowide"=>"Audiowide","Autour One"=>"Autour One","Average"=>"Average","Average Sans"=>"Average Sans","Averia Gruesa Libre"=>"Averia Gruesa Libre","Averia Libre"=>"Averia Libre","Averia Sans Libre"=>"Averia Sans Libre","Averia Serif Libre"=>"Averia Serif Libre","Bad Script"=>"Bad Script","Balthazar"=>"Balthazar","Bangers"=>"Bangers","Basic"=>"Basic","Battambang"=>"Battambang","Baumans"=>"Baumans","Bayon"=>"Bayon","Belgrano"=>"Belgrano","Belleza"=>"Belleza","BenchNine"=>"BenchNine","Bentham"=>"Bentham","Berkshire Swash"=>"Berkshire Swash","Bevan"=>"Bevan","Bigelow Rules"=>"Bigelow Rules","Bigshot One"=>"Bigshot One","Bilbo"=>"Bilbo","Bilbo Swash Caps"=>"Bilbo Swash Caps","Bitter"=>"Bitter","Black Ops One"=>"Black Ops One","Bokor"=>"Bokor","Bonbon"=>"Bonbon","Boogaloo"=>"Boogaloo","Bowlby One"=>"Bowlby One","Bowlby One SC"=>"Bowlby One SC","Brawler"=>"Brawler","Bree Serif"=>"Bree Serif","Bubblegum Sans"=>"Bubblegum Sans","Bubbler One"=>"Bubbler One","Buda"=>"Buda","Buenard"=>"Buenard","Butcherman"=>"Butcherman","Butterfly Kids"=>"Butterfly Kids","Cabin"=>"Cabin","Cabin Condensed"=>"Cabin Condensed","Cabin Sketch"=>"Cabin Sketch","Caesar Dressing"=>"Caesar Dressing","Cagliostro"=>"Cagliostro","Calligraffitti"=>"Calligraffitti","Cambo"=>"Cambo","Candal"=>"Candal","Cantarell"=>"Cantarell","Cantata One"=>"Cantata One","Cantora One"=>"Cantora One","Capriola"=>"Capriola","Cardo"=>"Cardo","Carme"=>"Carme","Carrois Gothic"=>"Carrois Gothic","Carrois Gothic SC"=>"Carrois Gothic SC","Carter One"=>"Carter One","Caudex"=>"Caudex","Cedarville Cursive"=>"Cedarville Cursive","Ceviche One"=>"Ceviche One","Changa One"=>"Changa One","Chango"=>"Chango","Chau Philomene One"=>"Chau Philomene One","Chela One"=>"Chela One","Chelsea Market"=>"Chelsea Market","Chenla"=>"Chenla","Cherry Cream Soda"=>"Cherry Cream Soda","Cherry Swash"=>"Cherry Swash","Chewy"=>"Chewy","Chicle"=>"Chicle","Chivo"=>"Chivo","Cinzel"=>"Cinzel","Cinzel Decorative"=>"Cinzel Decorative","Clicker Script"=>"Clicker Script","Coda"=>"Coda","Coda Caption"=>"Coda Caption","Codystar"=>"Codystar","Combo"=>"Combo","Comfortaa"=>"Comfortaa","Coming Soon"=>"Coming Soon","Concert One"=>"Concert One","Condiment"=>"Condiment","Content"=>"Content","Contrail One"=>"Contrail One","Convergence"=>"Convergence","Cookie"=>"Cookie","Copse"=>"Copse","Corben"=>"Corben","Courgette"=>"Courgette","Cousine"=>"Cousine","Coustard"=>"Coustard","Covered By Your Grace"=>"Covered By Your Grace","Crafty Girls"=>"Crafty Girls","Creepster"=>"Creepster","Crete Round"=>"Crete Round","Crimson Text"=>"Crimson Text","Croissant One"=>"Croissant One","Crushed"=>"Crushed","Cuprum"=>"Cuprum","Cutive"=>"Cutive","Cutive Mono"=>"Cutive Mono","Damion"=>"Damion","Dancing Script"=>"Dancing Script","Dangrek"=>"Dangrek","Dawning of a New Day"=>"Dawning of a New Day","Days One"=>"Days One","Delius"=>"Delius","Delius Swash Caps"=>"Delius Swash Caps","Delius Unicase"=>"Delius Unicase","Della Respira"=>"Della Respira","Denk One"=>"Denk One","Devonshire"=>"Devonshire","Didact Gothic"=>"Didact Gothic","Diplomata"=>"Diplomata","Diplomata SC"=>"Diplomata SC","Domine"=>"Domine","Donegal One"=>"Donegal One","Doppio One"=>"Doppio One","Dorsa"=>"Dorsa","Dosis"=>"Dosis","Dr Sugiyama"=>"Dr Sugiyama","Droid Sans"=>"Droid Sans","Droid Sans Mono"=>"Droid Sans Mono","Droid Serif"=>"Droid Serif","Duru Sans"=>"Duru Sans","Dynalight"=>"Dynalight","EB Garamond"=>"EB Garamond","Eagle Lake"=>"Eagle Lake","Eater"=>"Eater","Economica"=>"Economica","Electrolize"=>"Electrolize","Elsie"=>"Elsie","Elsie Swash Caps"=>"Elsie Swash Caps","Emblema One"=>"Emblema One","Emilys Candy"=>"Emilys Candy","Engagement"=>"Engagement","Englebert"=>"Englebert","Enriqueta"=>"Enriqueta","Erica One"=>"Erica One","Esteban"=>"Esteban","Euphoria Script"=>"Euphoria Script","Ewert"=>"Ewert","Exo"=>"Exo","Expletus Sans"=>"Expletus Sans","Fanwood Text"=>"Fanwood Text","Fascinate"=>"Fascinate","Fascinate Inline"=>"Fascinate Inline","Faster One"=>"Faster One","Fasthand"=>"Fasthand","Fauna One"=>"Fauna One","Federant"=>"Federant","Federo"=>"Federo","Felipa"=>"Felipa","Fenix"=>"Fenix","Finger Paint"=>"Finger Paint","Fjalla One"=>"Fjalla One","Fjord One"=>"Fjord One","Flamenco"=>"Flamenco","Flavors"=>"Flavors","Fondamento"=>"Fondamento","Fontdiner Swanky"=>"Fontdiner Swanky","Forum"=>"Forum","Francois One"=>"Francois One","Freckle Face"=>"Freckle Face","Fredericka the Great"=>"Fredericka the Great","Fredoka One"=>"Fredoka One","Freehand"=>"Freehand","Fresca"=>"Fresca","Frijole"=>"Frijole","Fruktur"=>"Fruktur","Fugaz One"=>"Fugaz One","GFS Didot"=>"GFS Didot","GFS Neohellenic"=>"GFS Neohellenic","Gabriela"=>"Gabriela","Gafata"=>"Gafata","Galdeano"=>"Galdeano","Galindo"=>"Galindo","Gentium Basic"=>"Gentium Basic","Gentium Book Basic"=>"Gentium Book Basic","Geo"=>"Geo","Geostar"=>"Geostar","Geostar Fill"=>"Geostar Fill","Germania One"=>"Germania One","Gilda Display"=>"Gilda Display","Give You Glory"=>"Give You Glory","Glass Antiqua"=>"Glass Antiqua","Glegoo"=>"Glegoo","Gloria Hallelujah"=>"Gloria Hallelujah","Goblin One"=>"Goblin One","Gochi Hand"=>"Gochi Hand","Gorditas"=>"Gorditas","Goudy Bookletter 1911"=>"Goudy Bookletter 1911","Graduate"=>"Graduate","Grand Hotel"=>"Grand Hotel","Gravitas One"=>"Gravitas One","Great Vibes"=>"Great Vibes","Griffy"=>"Griffy","Gruppo"=>"Gruppo","Gudea"=>"Gudea","Habibi"=>"Habibi","Hammersmith One"=>"Hammersmith One","Hanalei"=>"Hanalei","Hanalei Fill"=>"Hanalei Fill","Handlee"=>"Handlee","Hanuman"=>"Hanuman","Happy Monkey"=>"Happy Monkey","Headland One"=>"Headland One","Henny Penny"=>"Henny Penny","Herr Von Muellerhoff"=>"Herr Von Muellerhoff","Holtwood One SC"=>"Holtwood One SC","Homemade Apple"=>"Homemade Apple","Homenaje"=>"Homenaje","IM Fell DW Pica"=>"IM Fell DW Pica","IM Fell DW Pica SC"=>"IM Fell DW Pica SC","IM Fell Double Pica"=>"IM Fell Double Pica","IM Fell Double Pica SC"=>"IM Fell Double Pica SC","IM Fell English"=>"IM Fell English","IM Fell English SC"=>"IM Fell English SC","IM Fell French Canon"=>"IM Fell French Canon","IM Fell French Canon SC"=>"IM Fell French Canon SC","IM Fell Great Primer"=>"IM Fell Great Primer","IM Fell Great Primer SC"=>"IM Fell Great Primer SC","Iceberg"=>"Iceberg","Iceland"=>"Iceland","Imprima"=>"Imprima","Inconsolata"=>"Inconsolata","Inder"=>"Inder","Indie Flower"=>"Indie Flower","Inika"=>"Inika","Irish Grover"=>"Irish Grover","Istok Web"=>"Istok Web","Italiana"=>"Italiana","Italianno"=>"Italianno","Jacques Francois"=>"Jacques Francois","Jacques Francois Shadow"=>"Jacques Francois Shadow","Jim Nightshade"=>"Jim Nightshade","Jockey One"=>"Jockey One","Jolly Lodger"=>"Jolly Lodger","Josefin Sans"=>"Josefin Sans","Josefin Slab"=>"Josefin Slab","Joti One"=>"Joti One","Judson"=>"Judson","Julee"=>"Julee","Julius Sans One"=>"Julius Sans One","Junge"=>"Junge","Jura"=>"Jura","Just Another Hand"=>"Just Another Hand","Just Me Again Down Here"=>"Just Me Again Down Here","Kameron"=>"Kameron","Karla"=>"Karla","Kaushan Script"=>"Kaushan Script","Kavoon"=>"Kavoon","Keania One"=>"Keania One","Kelly Slab"=>"Kelly Slab","Kenia"=>"Kenia","Khmer"=>"Khmer","Kite One"=>"Kite One","Knewave"=>"Knewave","Kotta One"=>"Kotta One","Koulen"=>"Koulen","Kranky"=>"Kranky","Kreon"=>"Kreon","Kristi"=>"Kristi","Krona One"=>"Krona One","La Belle Aurore"=>"La Belle Aurore","Lancelot"=>"Lancelot","Lato"=>"Lato","League Script"=>"League Script","Leckerli One"=>"Leckerli One","Ledger"=>"Ledger","Lekton"=>"Lekton","Lemon"=>"Lemon","Libre Baskerville"=>"Libre Baskerville","Life Savers"=>"Life Savers","Lilita One"=>"Lilita One","Lily Script One"=>"Lily Script One","Limelight"=>"Limelight","Linden Hill"=>"Linden Hill","Lobster"=>"Lobster","Lobster Two"=>"Lobster Two","Londrina Outline"=>"Londrina Outline","Londrina Shadow"=>"Londrina Shadow","Londrina Sketch"=>"Londrina Sketch","Londrina Solid"=>"Londrina Solid","Lora"=>"Lora","Love Ya Like A Sister"=>"Love Ya Like A Sister","Loved by the King"=>"Loved by the King","Lovers Quarrel"=>"Lovers Quarrel","Luckiest Guy"=>"Luckiest Guy","Lusitana"=>"Lusitana","Lustria"=>"Lustria","Macondo"=>"Macondo","Macondo Swash Caps"=>"Macondo Swash Caps","Magra"=>"Magra","Maiden Orange"=>"Maiden Orange","Mako"=>"Mako","Marcellus"=>"Marcellus","Marcellus SC"=>"Marcellus SC","Marck Script"=>"Marck Script","Margarine"=>"Margarine","Marko One"=>"Marko One","Marmelad"=>"Marmelad","Marvel"=>"Marvel","Mate"=>"Mate","Mate SC"=>"Mate SC","Maven Pro"=>"Maven Pro","McLaren"=>"McLaren","Meddon"=>"Meddon","MedievalSharp"=>"MedievalSharp","Medula One"=>"Medula One","Megrim"=>"Megrim","Meie Script"=>"Meie Script","Merienda"=>"Merienda","Merienda One"=>"Merienda One","Merriweather"=>"Merriweather","Merriweather Sans"=>"Merriweather Sans","Metal"=>"Metal","Metal Mania"=>"Metal Mania","Metamorphous"=>"Metamorphous","Metrophobic"=>"Metrophobic","Michroma"=>"Michroma","Milonga"=>"Milonga","Miltonian"=>"Miltonian","Miltonian Tattoo"=>"Miltonian Tattoo","Miniver"=>"Miniver","Miss Fajardose"=>"Miss Fajardose","Modern Antiqua"=>"Modern Antiqua","Molengo"=>"Molengo","Molle"=>"Molle","Monda"=>"Monda","Monofett"=>"Monofett","Monoton"=>"Monoton","Monsieur La Doulaise"=>"Monsieur La Doulaise","Montaga"=>"Montaga","Montez"=>"Montez","Montserrat"=>"Montserrat","Montserrat Alternates"=>"Montserrat Alternates","Montserrat Subrayada"=>"Montserrat Subrayada","Moul"=>"Moul","Moulpali"=>"Moulpali","Mountains of Christmas"=>"Mountains of Christmas","Mouse Memoirs"=>"Mouse Memoirs","Mr Bedfort"=>"Mr Bedfort","Mr Dafoe"=>"Mr Dafoe","Mr De Haviland"=>"Mr De Haviland","Mrs Saint Delafield"=>"Mrs Saint Delafield","Mrs Sheppards"=>"Mrs Sheppards","Muli"=>"Muli","Mystery Quest"=>"Mystery Quest","Neucha"=>"Neucha","Neuton"=>"Neuton","New Rocker"=>"New Rocker","News Cycle"=>"News Cycle","Niconne"=>"Niconne","Nixie One"=>"Nixie One","Nobile"=>"Nobile","Nokora"=>"Nokora","Norican"=>"Norican","Nosifer"=>"Nosifer","Nothing You Could Do"=>"Nothing You Could Do","Noticia Text"=>"Noticia Text","Noto Sans"=>"Noto Sans","Noto Serif"=>"Noto Serif","Nova Cut"=>"Nova Cut","Nova Flat"=>"Nova Flat","Nova Mono"=>"Nova Mono","Nova Oval"=>"Nova Oval","Nova Round"=>"Nova Round","Nova Script"=>"Nova Script","Nova Slim"=>"Nova Slim","Nova Square"=>"Nova Square","Numans"=>"Numans","Nunito"=>"Nunito","Odor Mean Chey"=>"Odor Mean Chey","Offside"=>"Offside","Old Standard TT"=>"Old Standard TT","Oldenburg"=>"Oldenburg","Oleo Script"=>"Oleo Script","Oleo Script Swash Caps"=>"Oleo Script Swash Caps","Open Sans"=>"Open Sans","Open Sans Condensed"=>"Open Sans Condensed","Oranienbaum"=>"Oranienbaum","Orbitron"=>"Orbitron","Oregano"=>"Oregano","Orienta"=>"Orienta","Original Surfer"=>"Original Surfer","Oswald"=>"Oswald","Over the Rainbow"=>"Over the Rainbow","Overlock"=>"Overlock","Overlock SC"=>"Overlock SC","Ovo"=>"Ovo","Oxygen"=>"Oxygen","Oxygen Mono"=>"Oxygen Mono","PT Mono"=>"PT Mono","PT Sans"=>"PT Sans","PT Sans Caption"=>"PT Sans Caption","PT Sans Narrow"=>"PT Sans Narrow","PT Serif"=>"PT Serif","PT Serif Caption"=>"PT Serif Caption","Pacifico"=>"Pacifico","Paprika"=>"Paprika","Parisienne"=>"Parisienne","Passero One"=>"Passero One","Passion One"=>"Passion One","Pathway Gothic One"=>"Pathway Gothic One","Patrick Hand"=>"Patrick Hand","Patrick Hand SC"=>"Patrick Hand SC","Patua One"=>"Patua One","Paytone One"=>"Paytone One","Peralta"=>"Peralta","Permanent Marker"=>"Permanent Marker","Petit Formal Script"=>"Petit Formal Script","Petrona"=>"Petrona","Philosopher"=>"Philosopher","Piedra"=>"Piedra","Pinyon Script"=>"Pinyon Script","Pirata One"=>"Pirata One","Plaster"=>"Plaster","Play"=>"Play","Playball"=>"Playball","Playfair Display"=>"Playfair Display","Playfair Display SC"=>"Playfair Display SC","Podkova"=>"Podkova","Poiret One"=>"Poiret One","Poller One"=>"Poller One","Poly"=>"Poly","Pompiere"=>"Pompiere","Pontano Sans"=>"Pontano Sans","Port Lligat Sans"=>"Port Lligat Sans","Port Lligat Slab"=>"Port Lligat Slab","Prata"=>"Prata","Preahvihear"=>"Preahvihear","Press Start 2P"=>"Press Start 2P","Princess Sofia"=>"Princess Sofia","Prociono"=>"Prociono","Prosto One"=>"Prosto One","Puritan"=>"Puritan","Purple Purse"=>"Purple Purse","Quando"=>"Quando","Quantico"=>"Quantico","Quattrocento"=>"Quattrocento","Quattrocento Sans"=>"Quattrocento Sans","Questrial"=>"Questrial","Quicksand"=>"Quicksand","Quintessential"=>"Quintessential","Qwigley"=>"Qwigley","Racing Sans One"=>"Racing Sans One","Radley"=>"Radley","Raleway"=>"Raleway","Raleway Dots"=>"Raleway Dots","Rambla"=>"Rambla","Rammetto One"=>"Rammetto One","Ranchers"=>"Ranchers","Rancho"=>"Rancho","Rationale"=>"Rationale","Redressed"=>"Redressed","Reenie Beanie"=>"Reenie Beanie","Revalia"=>"Revalia","Ribeye"=>"Ribeye","Ribeye Marrow"=>"Ribeye Marrow","Righteous"=>"Righteous","Risque"=>"Risque","Roboto"=>"Roboto","Roboto Condensed"=>"Roboto Condensed","Roboto Slab"=>"Roboto Slab","Rochester"=>"Rochester","Rock Salt"=>"Rock Salt","Rokkitt"=>"Rokkitt","Romanesco"=>"Romanesco","Ropa Sans"=>"Ropa Sans","Rosario"=>"Rosario","Rosarivo"=>"Rosarivo","Rouge Script"=>"Rouge Script","Ruda"=>"Ruda","Rufina"=>"Rufina","Ruge Boogie"=>"Ruge Boogie","Ruluko"=>"Ruluko","Rum Raisin"=>"Rum Raisin","Ruslan Display"=>"Ruslan Display","Russo One"=>"Russo One","Ruthie"=>"Ruthie","Rye"=>"Rye","Sacramento"=>"Sacramento","Sail"=>"Sail","Salsa"=>"Salsa","Sanchez"=>"Sanchez","Sancreek"=>"Sancreek","Sansita One"=>"Sansita One","Sarina"=>"Sarina","Satisfy"=>"Satisfy","Scada"=>"Scada","Schoolbell"=>"Schoolbell","Seaweed Script"=>"Seaweed Script","Sevillana"=>"Sevillana","Seymour One"=>"Seymour One","Shadows Into Light"=>"Shadows Into Light","Shadows Into Light Two"=>"Shadows Into Light Two","Shanti"=>"Shanti","Share"=>"Share","Share Tech"=>"Share Tech","Share Tech Mono"=>"Share Tech Mono","Shojumaru"=>"Shojumaru","Short Stack"=>"Short Stack","Siemreap"=>"Siemreap","Sigmar One"=>"Sigmar One","Signika"=>"Signika","Signika Negative"=>"Signika Negative","Simonetta"=>"Simonetta","Sintony"=>"Sintony","Sirin Stencil"=>"Sirin Stencil","Six Caps"=>"Six Caps","Skranji"=>"Skranji","Slackey"=>"Slackey","Smokum"=>"Smokum","Smythe"=>"Smythe","Sniglet"=>"Sniglet","Snippet"=>"Snippet","Snowburst One"=>"Snowburst One","Sofadi One"=>"Sofadi One","Sofia"=>"Sofia","Sonsie One"=>"Sonsie One","Sorts Mill Goudy"=>"Sorts Mill Goudy","Source Code Pro"=>"Source Code Pro","Source Sans Pro"=>"Source Sans Pro","Special Elite"=>"Special Elite","Spicy Rice"=>"Spicy Rice","Spinnaker"=>"Spinnaker","Spirax"=>"Spirax","Squada One"=>"Squada One","Stalemate"=>"Stalemate","Stalinist One"=>"Stalinist One","Stardos Stencil"=>"Stardos Stencil","Stint Ultra Condensed"=>"Stint Ultra Condensed","Stint Ultra Expanded"=>"Stint Ultra Expanded","Stoke"=>"Stoke","Strait"=>"Strait","Sue Ellen Francisco"=>"Sue Ellen Francisco","Sunshiney"=>"Sunshiney","Supermercado One"=>"Supermercado One","Suwannaphum"=>"Suwannaphum","Swanky and Moo Moo"=>"Swanky and Moo Moo","Syncopate"=>"Syncopate","Tangerine"=>"Tangerine","Taprom"=>"Taprom","Tauri"=>"Tauri","Telex"=>"Telex","Tenor Sans"=>"Tenor Sans","Text Me One"=>"Text Me One","The Girl Next Door"=>"The Girl Next Door","Tienne"=>"Tienne","Tinos"=>"Tinos","Titan One"=>"Titan One","Titillium Web"=>"Titillium Web","Trade Winds"=>"Trade Winds","Trocchi"=>"Trocchi","Trochut"=>"Trochut","Trykker"=>"Trykker","Tulpen One"=>"Tulpen One","Ubuntu"=>"Ubuntu","Ubuntu Condensed"=>"Ubuntu Condensed","Ubuntu Mono"=>"Ubuntu Mono","Ultra"=>"Ultra","Uncial Antiqua"=>"Uncial Antiqua","Underdog"=>"Underdog","Unica One"=>"Unica One","UnifrakturCook"=>"UnifrakturCook","UnifrakturMaguntia"=>"UnifrakturMaguntia","Unkempt"=>"Unkempt","Unlock"=>"Unlock","Unna"=>"Unna","VT323"=>"VT323","Vampiro One"=>"Vampiro One","Varela"=>"Varela","Varela Round"=>"Varela Round","Vast Shadow"=>"Vast Shadow","Vibur"=>"Vibur","Vidaloka"=>"Vidaloka","Viga"=>"Viga","Voces"=>"Voces","Volkhov"=>"Volkhov","Vollkorn"=>"Vollkorn","Voltaire"=>"Voltaire","Waiting for the Sunrise"=>"Waiting for the Sunrise","Wallpoet"=>"Wallpoet","Walter Turncoat"=>"Walter Turncoat","Warnes"=>"Warnes","Wellfleet"=>"Wellfleet","Wendy One"=>"Wendy One","Wire One"=>"Wire One","Yanone Kaffeesatz"=>"Yanone Kaffeesatz","Yellowtail"=>"Yellowtail","Yeseva One"=>"Yeseva One","Yesteryear"=>"Yesteryear","Zeyada"=>"Zeyada");
}

}
