<?php


function getPageModules(){

	$sortables = array(
	
	'module-header' 		=> 'Header',
	'module-page-title' 	=> 'Page title',
	'module-page-content' 	=> 'Page content',
	'module-footer'			=> 'Footer',
	'module-slideshow' 		=> 'Slideshow',
	'module-teaser-1' 		=> 'Teaser 1',
	'module-teaser-2' 		=> 'Teaser 2',
	'module-teaser-3' 		=> 'Teaser 3',
	'module-blog'		 	=> 'Blog',
	'module-teaser-pages' 	=> 'Teaser-pages',
	'module-featured-pages' => 'Featured pages',
	'module-highlights' 	=> 'Highlightss',
	//'module-featured-pages-2' => 'Highlights',
	'module-portfolio' 		=> 'Portfolio',
	'module-widgets' 		=> 'Widgets',
	'module-video' 			=> 'Video',
	'module-socialmedia' 	=> 'Social media',
	//'module-testimonials' 	=> 'Testimonials',
	//'module-ticker'			=> 'News ticker',
	//'module-search'			=> 'Search module',
	'module-twitter'		=> 'Twitter module',
	//'module-signup'			=> 'Sign-up module'
	
	
	);
	
	return apply_filters('epic_home_modules',$sortables);

}


function getGoogleFonts(){

	$epic_google_fonts = array(
		// A
		"Advent Pro" 			=>	":400,700",
		"Alfa Slab One" 		=>	":400,700",
		"Allura" 				=>	":400,700",
		"Amethysta"				=> ":400,700",
		"Andada"				=> ":400,700",
		"Arvo" 					=> ":400,700",
		"Average" 				=> ":400,700",
		"Averia Serif Libre" 	=>	":400,700",
		"Antic Slab" 			=> ":400,700",
		
		// B
		"Bad Script" 	=> ":400,700",
		"Balthazar"		=> ":400,700",
		"Belgrano"		=> ":400,700",
		"Bevan"			=> ":400,700",
		"Bitter"		=> ":400,700",
		"Brawler"		=> ":400,700",
		"Bree Serif"	=> ":400,700",
		"Buenard"		=> ":400,700",
		// C
		"Calligraffitti" 	=> ":400,700",
		"Cantata One" 		=> ":400,700",
		"Copse" 			=> ":400,700",
		"Coustard"			=> ":400,700",
		"Crafty Girls" 		=> ":400,700",
		"Crete Round" 		=> ":400,700",
		"Crimson Text"		=> ":400,700",
		"Cutive" 			=> ":400,700",
		// D
		"Doppio One" 		=> ":400,700",
		"Dosis" 			=> ":400,700",
		"Droid Sans" 		=> ":400,700",
		"Droid Serif" 		=> ":400,700",
		// E
		"Economica" 		=> ":400,700",
		"Exo" 				=> ":400,700",
		// G
		"Graduate" => "",
		// H
		"Habibi"			=> ":400,700",
		// I
		"Imprima" 			=> ":400,700",
		"Inika" 			=> ":400,700",
		// J
		"Junge" 			=> ":400,700",
		// K
		"Kameron"			=> ":400,700",
		"Karla" => "",
		"Kreon"				=> ":400,700",
		// L
		"Ledger"			=> ":400,700",
		"Lobster" 			=> ":400,700",
		"Lusitana"			=> ":400,700",
			"Lustria" 		=> ":400,700",
		// M	
		"Marko One" 		=> ":400,700",
		"Montserrat" 		=> ":400,700",
		// N
		"Nobile" 			=> ":400,700",
		"Noticia Text" 		=> ":400,700",
		// O
		"Oldenburg" 		=> ":400,700",
		"Open Sans" 		=> ":300,600",
		"Oswald" => "",
		// P
		"Pacifico" 			=> ":400,700",
		"Poly"				=> ":400,700",
		"Pontano Sans" 		=> ":400,700",
		"Port Lligat Slab" 	=> ":400,700",
		"PT Sans" 			=> ":400,700",
		"PT Serif"			=> ":400,700",
		// Q
		"Quattrocento" 		=> ":400,700",
		// R
		"Raleway"			=> ":400,700",
		"Reenie Beanie" 	=> ":400,700",
		"Rock Salt" 		=> ":400,700",
		
		// S
		"Shadows Into Light" => ":400,700",
		// T
		"Tangerine" 		=> ":400,700",
		// U
		"Ubuntu" 			=> ":400,700",
		// V
		// X
		// Y
		"Yanone Kaffeesatz" => ":300,700",
		
				
		
		
			
		
		
		
		
		
		
		
		
		
		
		"Seaweed" 		=>	"",
				"Noticia Text" 	=>	":slab-serif",
		
		
		
		
		
		
		"Ropa Sans" 	=>	"",
		"Spinnaker" 	=>	""
	);

	return apply_filters('epic_googlefont_library',$epic_google_fonts);

	}
	
	$epic_googlefont_library = getGoogleFonts();


$shortname = "epic";

// Skins
function epic_theme_skins(){
	
	$colors = array(
				'light'				=> "Light",
				'dark' 				=> "Dark"
				);
			
		return apply_filters('epic_theme_skins',$colors);
	}

	$epic_colorschemes = epic_theme_skins();



// Sliders

function epic_theme_sliders(){

	$sliders = array(
		"cycle" => "Cycle slider",
		"accordion" => "Accordion slider"
		);
		
return apply_filters('epic_theme_sliders',$sliders);


}

$epic_sliders = epic_theme_sliders();





$pages_top_level = get_pages('sort_column=menu_order&depth=0');
$epic_gettoplevelpages = array();
foreach ($pages_top_level as $page_list ) {
	if ($page_list->post_parent == "0") {
       $epic_gettoplevelpages[$page_list ->ID] = $page_list ->post_title;
	}
}

$pageargs = array(
    'child_of' => 0,
    'sort_order' => 'ASC',
    'sort_column' => 'post_title',
    'hierarchical' => 0,
    'parent' => -1,
    'offset' => 0,
    'post_type' => 'page',
    'post_status' => 'publish'
);

$pages = get_pages($pageargs);
$epic_getpages = array();
foreach ($pages as $page ) {
	   
       $epic_getpages[$page ->ID] = $page -> post_title;
}

$epic_getteasers = array();

$args = array(  'post_type' => 'teaser', 'showposts' => -1);
query_posts($args);
if(have_posts()): while (have_posts()): the_post();

	$epic_getteasers[$post->ID] = $post -> post_title;
	
endwhile; endif;
wp_reset_query();



$categories = get_categories(array('hide_empty' => true, 'taxonomy' => 'category'));
$epic_getcat = array();
foreach ($categories as $category ) {
       $epic_getcat [$category -> cat_ID] = $category -> cat_name;
}

$categories_excluded = get_categories(array('hide_empty' => false, 'taxonomy' => 'category'));
$epic_getcat_exclude = array();
foreach ($categories_excluded as $category ) {
       $epic_getcat_exclude [$category -> cat_name] = $category -> cat_ID;
}




$slideshowTerms = get_terms('slideshow');
$epic_getSlideshowTerms = array();
	foreach ($slideshowTerms as $term) {
		$epic_getSlideshowTerms [$term->name] = $term->name;
}


$portfolioTerms = get_terms('portfoliocategory');
$epic_getPortfolioTerms = array();
	foreach ($portfolioTerms as $term) {
		$epic_getPortfolioTerms [$term->slug] = $term->name;
}


// Sidebars

$generatedSidebars = get_option('sbg_sidebars');
$autoSidebars = array(
				"default_sidebar"  => "Default Sidebar",
				);
$allsidebars = array_merge((array)$autoSidebars,(array)$generatedSidebars);




// Array of background images from directory

function get_backgroundtextures(){

if ($handle = opendir(TEMPLATEPATH.'/library/images/textures')) {
	
    $epic_backgroundimages =  array();
    
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
        
        	 $filename = str_replace('.css', '', $file);
             //$filename = ucfirst($filename);
             $epic_backgroundimages[] = $filename;
        }
    }
    closedir($handle);

	}
	
	return $epic_backgroundimages;

}
// Cycle slider effects
function epic_cycle_effects(){												
$epic_cycleeffects = array(
		"blindX"	=>	    "blindX",
		"blindY"	=>	    "blindY",
		"blindZ"	=>	    "blindZ",
		"cover"	=>	    "cover",
		"curtainX"	=>	    "curtainX",
		"curtainY"	=>	    "curtainY",
		"fade"	=>	    "fade",
		"fadeZoom"	=>	    "fadeZoom",
		"growX"	=>	    "growX",
		"growY"	=>	    "growY",
		"none"	=>	    "none",
		"scrollUp"	=>	    "scrollUp",
		"scrollDown"	=>	    "scrollDown",
		"scrollLeft"	=>	    "scrollLeft",
		"scrollRight"	=>	    "scrollRight",
		"scrollHorz"	=>	    "scrollHorz",
		"scrollVert"	=>	    "scrollVert",
		"shuffle"	=>	    "shuffle",
		"slideX"	=>	    "slideX",
		"slideY"	=>	    "slideY",
		"toss"	=>	    "toss",
		"turnUp"	=>	    "turnUp",
		"turnDown"	=>	    "turnDown",
		"turnLeft"	=>	    "turnLeft",
		"turnRight"	=>	    "turnRight",
		"uncover"	=>	    "uncover",
		"wipe"	=>	    "wipe",
		"zoom"	=>	    "zoom",
		);
		
		
		return $epic_cycleeffects;
}

// Predefined fontsizes

$epic_fontsizes = array(
			'' 	 => 'Default size',	
			'10' => '10 pixels',
			'11' => '11 pixels',
			'12' => '12 pixels',
			'13' => '13 pixels',
			'14' => '14 pixels',
			'15' => '15 pixels',
			'16' => '16 pixels',
			'17' => '17 pixels',
			'18' => '18 pixels',
			'19' => '19 pixels',
			'20' => '20 pixels',
			'21' => '21 pixels',
			'22' => '22 pixels',
			'23' => '23 pixels',
			'24' => '24 pixels',
			'25' => '25 pixels',
			'26' => '26 pixels',
			'27' => '27 pixels',
			'28' => '28 pixels',
			'29' => '29 pixels',
			'30' => '30 pixels',
			'31' => '31 pixels',
			'32' => '32 pixels',
			'33' => '33 pixels',
			'34' => '34 pixels',
			'35' => '35 pixels',
			'36' => '36 pixels',
			'37' => '37 pixels',
			'38' => '38 pixels',
			'39' => '39 pixels',
			'40' => '40 pixels',
			
			);
			
/* Header modules */
function epic_header_modules(){

	$headerelements = array(
			'secondary-menu'		=> "Secondary-menu",
			'primary-menu' 			=> "Primary-menu",
			'logo' 					=> "Logo",
			'searchform' 			=> "Searchform",
			'social-media-links' 	=> "Social media icons",
			'textbox' 				=> "Textbox"
			);

	return apply_filters('epic_theme_header_modules',$headerelements);
	
	}		
			
// Home page modules			
function epic_homepage_modules(){
	
	$epic_homepage_modules = array(
	'module-slideshow' 		=> 'Slideshow module',
	'module-teaser-1' 		=> 'Teaser 1',
	'module-teaser-2' 		=> 'Teaser 2',
	'module-teaser-3' 		=> 'Teaser 3',
	'module-blog'		 	=> 'Blog module',
	'module-teaser-pages' 	=> 'Teaser-pages',
	'module-featured-pages' => 'Featured pages',
	'module-widgets' 		=> 'Widgets module',
	'module-video' 			=> 'Video module'
	);
	
	return apply_filters('epic_page_modules', $epic_homepage_modules);

}

$epic_pageelements = epic_homepage_modules();




$epic_backgroundrepeat = array(
			"background-repeat: repeat !important;"		=> "Repeat horizontally and vertically",
			"background-repeat: repeat-x !important;"	=> "Repeat horizontally",
			"background-repeat: repeat-y !important;"	=> "Repeat vertically",
			"background-repeat: no-repeat !important;" 	=> "Do not repeat/tile",
			 );
			 
$epic_backgroundposition = array(
			"background-position:center top !important;"		=> "Center horizontally - align to top",
			"background-position:center center !important;"	=> "Center horizontally - Center vertically",
			"background-position:center bottom !important;" 	=> "Center horizontally - align to bottom",
			"background-position:left top !important;"			=> "Align left - align to top",
			"background-position:left bottom !important;"		=> "Align left - Center vertically",
			"background-position:left center !important;" 		=> "Align left - align to bottom",
			"background-position:right top !important;"		=> "Align right - align to top",
			"background-position:right bottom !important;"		=> "Align right - Center vertically",
			"background-position:right center !important;" 	=> "Align right - align to bottom",
			 );


// Websafe font list

$epic_fonts =  array(
			'Verdana, Geneva, Helvetica, sans serif' => "Verdana, Geneva, sans serif",
			'Georgia, Times New Roman, Times, serif' => "Georgia, Times New Roman, Times, serif",
			'Courier New, Courier, monospace' => "Courier New, Courier, monospace",
			'Arial, Helvetica, sans serif' => "Arial, Helvetica, sans serif",
			'Tahoma, Geneva, Helvetica,sans serif' => "Tahoma, Geneva, sans serif",
			'Trebuchet MS, Arial, Helvetica, sans serif' => "Trebuchet MS, Arial, Helvetica, sans serif",
			'Lucida Sans Unicode, Lucida Grande, Helvetica, sans serif' => "Lucida Sans Unicode, Lucida Grande, sans serif",
			);
			


// List of @fontface  css-files
/*  
if ($handle = opendir(TEMPLATEPATH.'/library/css/fontface')) {
    
    $epic_fontface =  array();
    
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
        
        	 $filename = str_replace('.css', '', $file);
             //$filename = ucfirst($filename);
             $epic_fontface[] = $filename;
        }
    }
    closedir($handle);
}
*/

// List of cufon font files

if ($handle = opendir(TEMPLATEPATH.'/library/fonts/cufon')) {
    
    $epic_cufon_fonts =  array();
    
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
             
             $filename = str_replace('.js', '', $file);
             //$filename = ucfirst($filename);
			            
             $epic_cufon_fonts[] = $filename;
        }
    }
    closedir($handle);
}


// Hook options from child theme

function get_childoptions(){		
	
	$options = array();
	
	return apply_filters('epic_child_options', $options);
	
}
	
$childoptions =  get_childoptions();


// Include optionspages 

$globaloptions = require_once(EPIC_ADMIN.'/options/global_options.php');
$portfoliooptions = require_once(EPIC_ADMIN.'/options/portfolio_options.php');
$appearanceoptions = require_once(EPIC_ADMIN.'/options/appearance_options.php');
$imagesoptions = require_once(EPIC_ADMIN.'/options/images_options.php');
$socialmediaoptions = require_once(EPIC_ADMIN.'/options/socialmedia_options.php');




$options =  array_merge($globaloptions,  $socialmediaoptions,  $imagesoptions);



?>