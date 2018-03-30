<?php

/******************* DEFAULT DATA *******************/
/* Override this function in child theme to change image sizes */

if(!function_exists('plsh_images_sizes'))
{
	function plsh_images_sizes()
	{
		return array(
			'blog_thumb_single_small' => array( 640, 300, true ),
			'blog_thumb_single_medium' => array( 970, 350, true ),
			'blog_thumb_single_large' => array( 1920, 500, true ),
			'blog_thumb_single_mobile' => array( 750, 350, true ),
			'blog_thumb_list_small' => array( 180, 180, true ),
			'blog_thumb_list_large' => array( 640, 280, true ),
			'blog_featured_small' => array( 691, 967, true ),
			'mosaic_small' => array( 690, 400, true ),
			'mosaic_large' => array( 690, 400, true ),
			'post-list-1-item' => array( 119, 120, true ),
			'post-list-1-slider-item' => array( 691, 774, true ),
			'post-list-1-slider-item-thumb' => array( 55, 55, true ),
			'post-list-2-item-featured' => array( 750, 491, true ),
			'post-list-2-item-regular' => array( 70, 70, true ),
			'dropdown-featured-post-item-large' => array( 500, 308, true ),
			'dropdown-featured-post-item-small' => array( 200, 308, true ),
			'post-slider-image' => array( 630, 571, true ),
			'gallery-thumb-one-fourth' => array( 114, 114, true ),
			'gallery-large' => array( 810, 607, false ),
		);
	}
}

$auto_pages = array(
	'home' => array(
		'name' => 'Homepage',
		'slug' => 'homepage',        
        'content' => '[vc_row][vc_column width="1/1"][mosaic][/vc_column][/vc_row][vc_row][vc_column width="1/1"][slider title="Featured articles" count="8" url="||" interval="0"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][post_list_1 title="Latest news" count="4" timeout="0"][banner468 banner="default"][vc_row_inner][vc_column_inner width="1/2"][post_list_2 count="4" url="||" title="Latest news"][/vc_column_inner][vc_column_inner width="1/2"][post_list_2 title="Latest news" count="4"][/vc_column_inner][/vc_row_inner][post_list_3 title="Latest news" count="3"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="default_sidebar"][banner300 banner="default"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][latest_galleries title="Latest galleries" count="8" interval="0"][banner728][/vc_column][/vc_row]',
		'id' => '',
		'role' => 'front_page'
	),
	'blog' => array(
		'name' => 'Blog',
		'slug' => 'blog',
		'content' => '',
		'id' => '',
		'role' => 'posts'
	),
);

$sidebars = array(
    array(
        'name' => __('Default', 'goliath'),
        'id'   => 'default_sidebar',
        'description' => __('Default Sidebar', 'goliath'),
        'class' => '',
        'before_widget' => '<div id="%1$s" class="sidebar-item clearfix %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="title-default"><span class="active">',
        'after_title'   => '</span></div><div class="widget-content">'
    ),
    array(
        'name' => __('Footer', 'goliath'),
        'id'   => 'footer_sidebar',
        'description' => __('Footer Sidebar', 'goliath'),
        'class' => '',
        'before_widget' => '<div id="%1$s" class="sidebar-item footer-item widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="title-default"><span class="active">',
        'after_title'   => '</span></div><div class="widget-content">'
    ),
);

$page_types = array(
    'blog' => 'Blog',
    'single_post' => 'Single post',
    'categories' => 'Categories',
    'search' => 'Search Results',
    'archives' => 'Archives',
    'page' => 'Page',
    'shop' => 'Shop Catalog',
    'product' => 'Single product',
    'forum' => 'Forum (bbPress)'
);

$post_categories = array('' => 'None');
$cat_objects = get_categories(array('type' => 'post'));
foreach($cat_objects as $cat)
{
    $post_categories[$cat->cat_ID] = $cat->name;
}

$custom_fonts = array(
    'general_font',
    'logo_font',
    'menu_font',
    'content_block_title_font'
);

$all_google_fonts = '["ABeeZee","Abel","Abril Fatface","Aclonica","Acme","Actor","Adamina","Advent Pro","Aguafina Script","Akronim","Aladin","Aldrich","Alef","Alegreya","Alegreya SC","Alegreya Sans","Alegreya Sans SC","Alex Brush","Alfa Slab One","Alice","Alike","Alike Angular","Allan","Allerta","Allerta Stencil","Allura","Almendra","Almendra Display","Almendra SC","Amarante","Amaranth","Amatic SC","Amethysta","Amiri","Amita","Anaheim","Andada","Andika","Angkor","Annie Use Your Telescope","Anonymous Pro","Antic","Antic Didone","Antic Slab","Anton","Arapey","Arbutus","Arbutus Slab","Architects Daughter","Archivo Black","Archivo Narrow","Arimo","Arizonia","Armata","Artifika","Arvo","Arya","Asap","Asset","Astloch","Asul","Atomic Age","Aubrey","Audiowide","Autour One","Average","Average Sans","Averia Gruesa Libre","Averia Libre","Averia Sans Libre","Averia Serif Libre","Bad Script","Balthazar","Bangers","Basic","Battambang","Baumans","Bayon","Belgrano","Belleza","BenchNine","Bentham","Berkshire Swash","Bevan","Bigelow Rules","Bigshot One","Bilbo","Bilbo Swash Caps","Biryani","Bitter","Black Ops One","Bokor","Bonbon","Boogaloo","Bowlby One","Bowlby One SC","Brawler","Bree Serif","Bubblegum Sans","Bubbler One","Buda","Buenard","Butcherman","Butterfly Kids","Cabin","Cabin Condensed","Cabin Sketch","Caesar Dressing","Cagliostro","Calligraffitti","Cambay","Cambo","Candal","Cantarell","Cantata One","Cantora One","Capriola","Cardo","Carme","Carrois Gothic","Carrois Gothic SC","Carter One","Caudex","Cedarville Cursive","Ceviche One","Changa One","Chango","Chau Philomene One","Chela One","Chelsea Market","Chenla","Cherry Cream Soda","Cherry Swash","Chewy","Chicle","Chivo","Cinzel","Cinzel Decorative","Clicker Script","Coda","Coda Caption","Codystar","Combo","Comfortaa","Coming Soon","Concert One","Condiment","Content","Contrail One","Convergence","Cookie","Copse","Corben","Courgette","Cousine","Coustard","Covered By Your Grace","Crafty Girls","Creepster","Crete Round","Crimson Text","Croissant One","Crushed","Cuprum","Cutive","Cutive Mono","Damion","Dancing Script","Dangrek","Dawning of a New Day","Days One","Dekko","Delius","Delius Swash Caps","Delius Unicase","Della Respira","Denk One","Devonshire","Dhurjati","Didact Gothic","Diplomata","Diplomata SC","Domine","Donegal One","Doppio One","Dorsa","Dosis","Dr Sugiyama","Droid Sans","Droid Sans Mono","Droid Serif","Duru Sans","Dynalight","EB Garamond","Eagle Lake","Eater","Economica","Ek Mukta","Electrolize","Elsie","Elsie Swash Caps","Emblema One","Emilys Candy","Engagement","Englebert","Enriqueta","Erica One","Esteban","Euphoria Script","Ewert","Exo","Exo 2","Expletus Sans","Fanwood Text","Fascinate","Fascinate Inline","Faster One","Fasthand","Fauna One","Federant","Federo","Felipa","Fenix","Finger Paint","Fira Mono","Fira Sans","Fjalla One","Fjord One","Flamenco","Flavors","Fondamento","Fontdiner Swanky","Forum","Francois One","Freckle Face","Fredericka the Great","Fredoka One","Freehand","Fresca","Frijole","Fruktur","Fugaz One","GFS Didot","GFS Neohellenic","Gabriela","Gafata","Galdeano","Galindo","Gentium Basic","Gentium Book Basic","Geo","Geostar","Geostar Fill","Germania One","Gidugu","Gilda Display","Give You Glory","Glass Antiqua","Glegoo","Gloria Hallelujah","Goblin One","Gochi Hand","Gorditas","Goudy Bookletter 1911","Graduate","Grand Hotel","Gravitas One","Great Vibes","Griffy","Gruppo","Gudea","Gurajada","Habibi","Halant","Hammersmith One","Hanalei","Hanalei Fill","Handlee","Hanuman","Happy Monkey","Headland One","Henny Penny","Herr Von Muellerhoff","Hind","Holtwood One SC","Homemade Apple","Homenaje","IM Fell DW Pica","IM Fell DW Pica SC","IM Fell Double Pica","IM Fell Double Pica SC","IM Fell English","IM Fell English SC","IM Fell French Canon","IM Fell French Canon SC","IM Fell Great Primer","IM Fell Great Primer SC","Iceberg","Iceland","Imprima","Inconsolata","Inder","Indie Flower","Inika","Irish Grover","Istok Web","Italiana","Italianno","Jacques Francois","Jacques Francois Shadow","Jaldi","Jim Nightshade","Jockey One","Jolly Lodger","Josefin Sans","Josefin Slab","Joti One","Judson","Julee","Julius Sans One","Junge","Jura","Just Another Hand","Just Me Again Down Here","Kalam","Kameron","Kantumruy","Karla","Karma","Kaushan Script","Kavoon","Kdam Thmor","Keania One","Kelly Slab","Kenia","Khand","Khmer","Khula","Kite One","Knewave","Kotta One","Koulen","Kranky","Kreon","Kristi","Krona One","Kurale","La Belle Aurore","Laila","Lakki Reddy","Lancelot","Lateef","Lato","League Script","Leckerli One","Ledger","Lekton","Lemon","Libre Baskerville","Life Savers","Lilita One","Lily Script One","Limelight","Linden Hill","Lobster","Lobster Two","Londrina Outline","Londrina Shadow","Londrina Sketch","Londrina Solid","Lora","Love Ya Like A Sister","Loved by the King","Lovers Quarrel","Luckiest Guy","Lusitana","Lustria","Macondo","Macondo Swash Caps","Magra","Maiden Orange","Mako","Mallanna","Mandali","Marcellus","Marcellus SC","Marck Script","Margarine","Marko One","Marmelad","Martel","Martel Sans","Marvel","Mate","Mate SC","Maven Pro","McLaren","Meddon","MedievalSharp","Medula One","Megrim","Meie Script","Merienda","Merienda One","Merriweather","Merriweather Sans","Metal","Metal Mania","Metamorphous","Metrophobic","Michroma","Milonga","Miltonian","Miltonian Tattoo","Miniver","Miss Fajardose","Modak","Modern Antiqua","Molengo","Molle","Monda","Monofett","Monoton","Monsieur La Doulaise","Montaga","Montez","Montserrat","Montserrat Alternates","Montserrat Subrayada","Moul","Moulpali","Mountains of Christmas","Mouse Memoirs","Mr Bedfort","Mr Dafoe","Mr De Haviland","Mrs Saint Delafield","Mrs Sheppards","Muli","Mystery Quest","NTR","Neucha","Neuton","New Rocker","News Cycle","Niconne","Nixie One","Nobile","Nokora","Norican","Nosifer","Nothing You Could Do","Noticia Text","Noto Sans","Noto Serif","Nova Cut","Nova Flat","Nova Mono","Nova Oval","Nova Round","Nova Script","Nova Slim","Nova Square","Numans","Nunito","Odor Mean Chey","Offside","Old Standard TT","Oldenburg","Oleo Script","Oleo Script Swash Caps","Open Sans","Open Sans Condensed","Oranienbaum","Orbitron","Oregano","Orienta","Original Surfer","Oswald","Over the Rainbow","Overlock","Overlock SC","Ovo","Oxygen","Oxygen Mono","PT Mono","PT Sans","PT Sans Caption","PT Sans Narrow","PT Serif","PT Serif Caption","Pacifico","Palanquin","Palanquin Dark","Paprika","Parisienne","Passero One","Passion One","Pathway Gothic One","Patrick Hand","Patrick Hand SC","Patua One","Paytone One","Peddana","Peralta","Permanent Marker","Petit Formal Script","Petrona","Philosopher","Piedra","Pinyon Script","Pirata One","Plaster","Play","Playball","Playfair Display","Playfair Display SC","Podkova","Poiret One","Poller One","Poly","Pompiere","Pontano Sans","Port Lligat Sans","Port Lligat Slab","Pragati Narrow","Prata","Preahvihear","Press Start 2P","Princess Sofia","Prociono","Prosto One","Puritan","Purple Purse","Quando","Quantico","Quattrocento","Quattrocento Sans","Questrial","Quicksand","Quintessential","Qwigley","Racing Sans One","Radley","Rajdhani","Raleway","Raleway Dots","Ramabhadra","Ramaraja","Rambla","Rammetto One","Ranchers","Rancho","Ranga","Rationale","Ravi Prakash","Redressed","Reenie Beanie","Revalia","Ribeye","Ribeye Marrow","Righteous","Risque","Roboto","Roboto Condensed","Roboto Mono","Roboto Slab","Rochester","Rock Salt","Rokkitt","Romanesco","Ropa Sans","Rosario","Rosarivo","Rouge Script","Rozha One","Rubik Mono One","Rubik One","Ruda","Rufina","Ruge Boogie","Ruluko","Rum Raisin","Ruslan Display","Russo One","Ruthie","Rye","Sacramento","Sail","Salsa","Sanchez","Sancreek","Sansita One","Sarina","Sarpanch","Satisfy","Scada","Scheherazade","Schoolbell","Seaweed Script","Sevillana","Seymour One","Shadows Into Light","Shadows Into Light Two","Shanti","Share","Share Tech","Share Tech Mono","Shojumaru","Short Stack","Siemreap","Sigmar One","Signika","Signika Negative","Simonetta","Sintony","Sirin Stencil","Six Caps","Skranji","Slabo 13px","Slabo 27px","Slackey","Smokum","Smythe","Sniglet","Snippet","Snowburst One","Sofadi One","Sofia","Sonsie One","Sorts Mill Goudy","Source Code Pro","Source Sans Pro","Source Serif Pro","Special Elite","Spicy Rice","Spinnaker","Spirax","Squada One","Sree Krushnadevaraya","Stalemate","Stalinist One","Stardos Stencil","Stint Ultra Condensed","Stint Ultra Expanded","Stoke","Strait","Sue Ellen Francisco","Sumana","Sunshiney","Supermercado One","Suranna","Suravaram","Suwannaphum","Swanky and Moo Moo","Syncopate","Tangerine","Taprom","Tauri","Teko","Telex","Tenali Ramakrishna","Tenor Sans","Text Me One","The Girl Next Door","Tienne","Timmana","Tinos","Titan One","Titillium Web","Trade Winds","Trocchi","Trochut","Trykker","Tulpen One","Ubuntu","Ubuntu Condensed","Ubuntu Mono","Ultra","Uncial Antiqua","Underdog","Unica One","UnifrakturCook","UnifrakturMaguntia","Unkempt","Unlock","Unna","VT323","Vampiro One","Varela","Varela Round","Vast Shadow","Vesper Libre","Vibur","Vidaloka","Viga","Voces","Volkhov","Vollkorn","Voltaire","Waiting for the Sunrise","Wallpoet","Walter Turncoat","Warnes","Wellfleet","Wendy One","Wire One","Yanone Kaffeesatz","Yellowtail","Yeseva One","Yesteryear","Zeyada"]';
$google_font_weights = ':400,700,900';

$selected_google_fonts = array(
    'Raleway' => array(
        'slug'		=> 'Raleway',
        'name'		=> 'Raleway',
        'url'		=> 'Raleway' . $google_font_weights,
		'status'	=> _x( 'on', 'Raleway font: on or off', 'goliath' )
    ),
    'Roboto'		=> array(
        'slug'		=> 'Roboto',
        'name'		=> 'Roboto',
        'url'		=> 'Roboto'  . $google_font_weights,
		'status'	=> _x( 'on', 'Roboto font: on or off', 'goliath' )
    ),
    'Source+Sans+Pro'  => array(
        'slug'		=> 'Source+Sans+Pro',
        'name'		=> 'Source Sans Pro',
        'url'		=> 'Source Sans Pro'  . $google_font_weights,
		'status'	=> _x( 'on', 'Source Sans Pro font: on or off', 'goliath' )
    ),
    'Varela+Round'  => array(
        'slug'		=> 'Varela+Round',
        'name'		=> 'Varela Round',
        'url'		=> 'Varela Round'  . $google_font_weights,
		'status'	=> _x( 'on', 'Varela Round font: on or off', 'goliath' )
    ),
    'Roboto+Slab'	=> array(
        'slug'		=> 'Roboto+Slab',
        'name'		=> 'Roboto Slab',
        'url'		=> 'Roboto Slab'  . $google_font_weights,
		'status'	=> _x( 'on', 'Roboto Slab font: on or off', 'goliath' )
    ),
    'Noto+Sans'		=> array(
        'slug'		=> 'Noto+Sans',
        'name'		=> 'Noto Sans',
        'url'		=> 'Noto Sans' . $google_font_weights,
		'status'	=> _x( 'on', 'Noto Sans font: on or off', 'goliath' )
    ),
    'Average+Sans'  => array(
        'slug'		=> 'Average+Sans',
        'name'		=> 'Average Sans',
        'url'		=> 'Average+Sans' . $google_font_weights,
		'status'	=> _x( 'on', 'Average Sans font: on or off', 'goliath' )
    ),
    'Arbutus+Slab'  => array(
        'slug'		=> 'Arbutus+Slab',
        'name'		=> 'Arbutus Slab',
        'url'		=> 'Arbutus Slab'  . $google_font_weights,
		'status'	=> _x( 'on', 'Arbutus Slab font: on or off', 'goliath' )
    ),
    'Donegal+One'	=> array(
        'slug'		=> 'Donegal+One',
        'name'		=> 'Donegal One',
        'url'		=> 'Donegal One' . $google_font_weights,
		'status'	=> _x( 'on', 'Donegal One font: on or off', 'goliath' )
    ),
    'Averia+Serif+Libre'  => array(
        'slug'		=> 'Averia+Serif+Libre',
        'name'		=> 'Averia Serif Libre',
        'url'		=> 'Averia Serif Libre' . $google_font_weights,
		'status'	=> _x( 'on', 'Averia Serif Libre font: on or off', 'goliath' )
    ),
    'Fjalla+One'	=> array(
        'slug'		=> 'Fjalla+One',
        'name'		=> 'Fjalla One',
        'url'		=> 'Fjalla One' . $google_font_weights,
		'status'	=> _x( 'on', 'Fjalla One font: on or off', 'goliath' )
    ),
    'Habibi'		=> array(
        'slug'		=> 'Habibi',
        'name'		=> 'Habibi',
        'url'		=> 'Habibi' . $google_font_weights,
		'status'	=> _x( 'on', 'Habibi font: on or off', 'goliath' )
    ),
    'Alegreya'  => array(
        'slug'		=> 'Alegreya',
        'name'		=> 'Alegreya',
        'url'		=> 'Alegreya' . $google_font_weights,
		'status'	=> _x( 'on', 'Alegreya font: on or off', 'goliath' )
    ),
    'Alegreya+SC'  => array(
        'slug'		=> 'Alegreya+SC',
        'name'		=> 'Alegreya SC',
        'url'		=> 'Alegreya SC' . $google_font_weights,
		'status'	=> _x( 'on', 'Alegreya SC font: on or off', 'goliath' )
    ),
    'Andada'  => array(
        'slug'		=> 'Andada',
        'name'		=> 'Andada',
        'url'		=> 'Andada' . $google_font_weights,
		'status'	=> _x( 'on', 'Andada font: on or off', 'goliath' )
    ),
    'Playfair+Display'  => array(
        'slug'		=> 'Playfair+Display',
        'name'		=> 'Playfair Display',
        'url'		=> 'Playfair Display' . $google_font_weights,
		'status'	=> _x( 'on', 'Playfair Display font: on or off', 'goliath' )
    ),
    'Domine'  => array(
        'slug'		=> 'Domine',
        'name'		=> 'Domine',
        'url'		=> 'Domine' . $google_font_weights,
		'status'	=> _x( 'on', 'Domine font: on or off', 'goliath' )
    ),
    'Vidaloka'  => array(
        'slug'		=> 'Vidaloka',
        'name'		=> 'Vidaloka',
        'url'		=> 'Vidaloka' . $google_font_weights,
		'status'	=> _x( 'on', 'Vidaloka font: on or off', 'goliath' )
    ),
    'Trocchi'  => array(
        'slug'		=> 'Trocchi',
        'name'		=> 'Trocchi',
        'url'		=> 'Trocchi' . $google_font_weights,
		'status'	=> _x( 'on', 'Trocchi font: on or off', 'goliath' )
    ),
    'Vollkorn'  => array(
        'slug'		=> 'Vollkorn',
        'name'		=> 'Vollkorn',
        'url'		=> 'Vollkorn' . $google_font_weights,
		'status'	=> _x( 'on', 'Vollkorn font: on or off', 'goliath' )
    ),
    'Lato'  => array(
        'slug'		=> 'Lato',
        'name'		=> 'Lato',
        'url'		=> 'Lato' . $google_font_weights,
		'status'	=> _x( 'on', 'Lato font: on or off', 'goliath' )
    ),
    'Francois+One'  => array(
        'slug'		=> 'Francois+One',
        'name'		=> 'Francois One',
        'url'		=> 'Francois One' . $google_font_weights,
		'status'	=> _x( 'on', 'Francois One font: on or off', 'goliath' )
    ),
    'Alike'  => array(
        'slug'		=> 'Alike',
        'name'		=> 'Alike',
        'url'		=> 'Alike' . $google_font_weights,
		'status'	=> _x( 'on', 'Alike font: on or off', 'goliath' )
    ),
    'Ultra'  => array(
        'slug'		=> 'Ultra',
        'name'		=> 'Ultra',
        'url'		=> 'Ultra' . $google_font_weights,
		'status'	=> _x( 'on', 'Ultra font: on or off', 'goliath' )
    ),
    'Arimo'  => array(
        'slug'		=> 'Arimo',
        'name'		=> 'Arimo',
        'url'		=> 'Arimo' . $google_font_weights,
		'status'	=> _x( 'on', 'Arimo font: on or off', 'goliath' )
    ),
    'Archivo+Black'  => array(
        'slug'		=> 'Archivo+Black',
        'name'		=> 'Archivo Black',
        'url'		=> 'Archivo Black' . $google_font_weights,
		'status'	=> _x( 'on', 'Archivo Black font: on or off', 'goliath' )
    ),
    'Cutive'  => array(
        'slug'		=> 'Cutive',
        'name'		=> 'Cutive',
        'url'		=> 'Cutive' . $google_font_weights,
		'status'	=> _x( 'on', 'Cutive font: on or off', 'goliath' )
    ),
    'Days+One' => array(
        'slug'		=> 'Days+One',
        'name'		=> 'Days One',
        'url'		=> 'Days One ' . $google_font_weights,
		'status'	=> _x( 'on', 'Days One font: on or off', 'goliath' )
    ),
    'Open+Sans' => array(
        'slug'		=> 'Open+Sans',
        'name'		=> 'Open Sans',
        'url'		=> 'Open Sans' . $google_font_weights,
		'status'	=> _x( 'on', 'Open Sans font: on or off', 'goliath' )
    ),
);

$theme = wp_get_theme();
$version = $theme->get('Version');

/******************* STATIC *******************/

$_settings_static = array(
	'theme_name' => 'Goliath',
	'theme_slug' => 'goliath',
	'theme_version' => $version,
	'theme_homepage' => '',
	'sync_url' => '',
    'image_sizes' => plsh_images_sizes(),
    'page_types' => $page_types,
    'support_url' => 'http://planetshine.net/redirect.php?theme=goliath-wp&v=' . $version
);


/******************* HIDDEN SETTINGS *******************/

$_settings_hidden = array(
	'auto_pages' => $auto_pages,
    'sidebars'  => $sidebars,
    'fonts' => plsh_get_all_google_fonts(),
    'custom_fonts' => $custom_fonts,
    'page_sidebars' => array(
        array(
            'name' => __('Default', 'goliath'),
            'id'   => 'default_sidebar',
            'description' => __('Default Sidebar', 'goliath'),
            'class' => '',
            'before_widget' => '<div id="%1$s" class="sidebar-item clearfix %2$s">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<div class="title-default"><span class="active">',
            'after_title'   => '</span></div><div class="widget-content">'
        ),
    ),
    'presets' => array(
        'default' => array(
            'visual_colors' => array('regular_text_color' => '#252525', 'regular_link_color' => '#252525', 'primary_special_color' => '#ff5732', 'secondary_special_color' => '#e7e7e7', 'menu_bar_background' => '#252525', 'menu_bar_text_color' => '#fff', 'menu_dropdown_background' => '#333', 'border_shadow_color' => '#e4e4e4', 'secondary_border_color' => '#d9d9d9', 'content_block_heading_color' => '#ff5732', 'block_background_color' => '#fff', 'footer_background_color' => '#252525', 'footer_heading_color' => '#ff5732', 'post_overlay_color' => '#252525', 'post_overlay_text_color' => '#ffffff', 'form_field_background' => '#fff', 'form_field_text_color' => '#252525'),
            'visual_background' => array('background_image' => '', 'background_repeat' => 'repeat', 'background_attachment' => 'scroll', 'background_color' => '#efefef', 'content_background_color' => '#f7f7f7', 'content_box_border_color' => '#e8e8e8', 'enable_particle_background' => '', 'particle_color' => '#e3e3e3', 'content_box_opacity' => '1'),
            'visual_fonts' => array('general_font' => 'Raleway', 'logo_font' => 'Raleway', 'menu_font' => 'Raleway', 'content_block_title_font' => 'Raleway')
        ),
        'dark' => array(
            'visual_colors' => array('regular_text_color' => '#c7c7c7', 'regular_link_color' => '#f8f8f8', 'primary_special_color' => '#ff5732', 'secondary_special_color' => '#585858', 'menu_bar_background' => '#0e0e0e', 'menu_bar_text_color' => '#ffffff', 'menu_dropdown_background' => '#333333', 'border_shadow_color' => '#333333', 'secondary_border_color' => '#585858', 'content_block_heading_color' => '#ff5732', 'block_background_color' => '#151515', 'footer_background_color' => '#0e0e0e', 'footer_heading_color' => '#ff5732', 'post_overlay_color' => '#f8f8f8', 'post_overlay_text_color' => '#252525', 'form_field_background' => '#151515', 'form_field_text_color' => '#c7c7c7'),
            'visual_background' => array('background_image' => '', 'background_repeat' => 'repeat', 'background_attachment' => 'scroll', 'background_color' => '#161616', 'content_background_color' => '#232323', 'content_box_border_color' => '#121212', 'enable_particle_background' => '', 'particle_color' => '#e3e3e3', 'content_box_opacity' => '1'),
            'visual_fonts' => array('general_font' => 'Raleway', 'logo_font' => 'Raleway', 'menu_font' => 'Raleway', 'content_block_title_font' => 'Raleway')            
        ),
        'black_white' => array(
            'visual_colors' => array('regular_text_color' => '#252525', 'regular_link_color' => '#252525', 'primary_special_color' => '#cccccc', 'secondary_special_color' => '#e7e7e7', 'menu_bar_background' => '#333333', 'menu_bar_text_color' => '#ffffff', 'menu_dropdown_background' => '#333', 'border_shadow_color' => '#cccccc', 'secondary_border_color' => '#cccccc', 'content_block_heading_color' => '#252525', 'block_background_color' => '#f1f1f1', 'footer_background_color' => '#333333', 'footer_heading_color' => '#ccc', 'post_overlay_color' => '#252525', 'post_overlay_text_color' => '#ffffff', 'form_field_background' => '#fff', 'form_field_text_color' => '#252525'),
            'visual_background' => array('background_image' => '', 'background_repeat' => 'repeat', 'background_attachment' => 'scroll', 'background_color' => '#ffffff', 'content_background_color' => '#ffffff', 'content_box_border_color' => '#ffffff', 'enable_particle_background' => '', 'particle_color' => '#e3e3e3', 'content_box_opacity' => '1'),
            'visual_fonts' => array('general_font' => 'Raleway', 'logo_font' => 'Raleway', 'menu_font' => 'Raleway', 'content_block_title_font' => 'Raleway')            
        ),
        'blue_white' => array(
            'visual_colors' => array('regular_text_color' => '#252525', 'regular_link_color' => '#252525', 'primary_special_color' => '#0070e3', 'secondary_special_color' => '#e7e7e7', 'menu_bar_background' => '#252525', 'menu_bar_text_color' => '#ffffff', 'menu_dropdown_background' => '#333333', 'border_shadow_color' => '#e4e4e4', 'secondary_border_color' => '#d9d9d9', 'content_block_heading_color' => '#0070e3', 'block_background_color' => '#f7f7f7', 'footer_background_color' => '#252525', 'footer_heading_color' => '#0070e3', 'post_overlay_color' => '#252525', 'post_overlay_text_color' => '#ffffff', 'form_field_background' => '#ffffff', 'form_field_text_color' => '#252525'),
            'visual_background' => array('background_image' => '', 'background_repeat' => 'repeat', 'background_attachment' => 'scroll', 'background_color' => '#14273a', 'content_background_color' => '#ffffff', 'content_box_border_color' => '#e8e8e8', 'enable_particle_background' => '', 'particle_color' => '#18579a', 'content_box_opacity' => '1'),
            'visual_fonts' => array('general_font' => 'Raleway', 'logo_font' => 'Raleway', 'menu_font' => 'Raleway', 'content_block_title_font' => 'Raleway')            
        ),
    ),
);


/***************** ADMIN SETTINGS *****************/

$_settings_admin_head = array(
    'general' => array(
		'name'     => 'General',
		'slug'     => 'general',
        'type'     => 'plsh_option_list',
        'icon'     => 'cog',
        'children' => array(
            'logo_fav' => array(
                'name' => 'Logo & Favicon',
                'slug' => 'logo_fav'
            ),
            'header' => array(
                'name' => 'Header',
                'slug' => 'header'
            ),
            'footer' => array(
                'name' => 'Footer',
                'slug' => 'footer'
            ),
            'blog' => array(
                'name' => 'Blog',
                'slug' => 'blog'
            ),
            'post' => array(
                'name' => 'Post',
                'slug' => 'post'
            ),
            'gallery' => array(
                'name' => 'Gallery',
                'slug' => 'gallery'
            ),
            'shop' => array(
                'name' => 'Shop',
                'slug' => 'shop'
            ),
            'social' => array(
                'name' => 'Social Networks',
                'slug' => 'social'
            ),
            'custom_code' => array(
                'name' => 'Custom Code',
                'slug' => 'custom_code'
            ),
        ),
	),
    'visual_editor' => array(
		'name'     => 'Visual Editor',
		'slug'     => 'visual_editor',
        'type'     => 'plsh_visual_editor',
        'icon'     => 'adjust',
        'link'     => get_admin_url() . 'customize.php?return=' . get_admin_url() . 'admin.php?page=' . $_settings_static['theme_slug'] . '-admin',
        'children' => array(
            'visual_background' => array(
                'name' => 'Background',
                'slug' => 'visual_background',
                'priority' => 5
            ),
            'visual_fonts' => array(
                'name' => 'Fonts',
                'slug' => 'visual_fonts',
                'priority' => 6
            ),
            'visual_colors' => array(
                'name' => 'Colors',
                'slug' => 'visual_colors',
                'priority' => 7
            ),
        ),
    ),
    'ads_manager' => array(
        'name'     => 'Advertisement',
		'slug'     => 'ads_manager',
        'type'     => 'plsh_ads_manager',
        'icon'     => 'picture-o',
        'children' => array(
            'ads_manager' => array(
                'name' => 'Manage',
                'slug' => 'ads_manager',
                'children' => array(
                    '728x90' => array(
                        'name' => '728x90px',
                        'slug' => '728x90',
                    ),
                    '468x60' => array(
                        'name' => '468x60px',
                        'slug' => '468x60',
                    ),
                    '300x250' => array(
                        'name' => '300x250px',
                        'slug' => '300x250',
                    ),
                    '150x125' => array(
                        'name' => '150x125px (x4)',
                        'slug' => '150x125',
                    ),
                ),
            ),
            'ad_locations' => array(
                'name' => 'Locations',
                'slug' => 'ad_locations',
                'children' => array(
                    'header_add' => array(
                        'name' => 'Header',
                        'slug' => 'header_add',
                    ),
                    'blog_ad' => array(
                        'name' => 'Blog index',
                        'slug' => 'blog_ad',
                    ),
                    'post_ad' => array(
                        'name' => 'Blog Post',
                        'slug' => 'post_ad',
                    ),
                    'gallery_ad' => array(
                        'name' => 'Gallery index',
                        'slug' => 'gallery_ad',
                    ),
                    'single_gallery_ad' => array(
                        'name' => 'Gallery item',
                        'slug' => 'single_gallery_ad',
                    ),                    
                ),
            ),
        )
    ),
    'sidebar_manager' => array(
		'name'     => 'Sidebar Manager',
		'slug'     => 'sidebar_manager',
        'type'     => 'plsh_sidebar_manager',
        'icon'     => 'cube',
        'children' => array(
            'all_sidebars' => array(
                'name' => 'All sidebars',
                'slug' => 'all_sidebars',
            ),
            'create_sidebar' => array(
                'name' => 'Create sidebar',
                'slug' => 'create_sidebar',
            ),
            'manage_sidebars' => array(
                'name' => 'Manage sidebars',
                'slug' => 'manage_sidebars',
            )
        )
    ),
	'google_fonts' => array(
		'name'     => 'Google Fonts',
		'slug'     => 'google_fonts',
        'type'     => 'plsh_google_fonts',
        'icon'     => 'font',
    ),
    'backup_reset' => array(
		'name'     => 'Backup & Reset',
		'slug'     => 'backup_reset',
        'type'     => 'plsh_backup_reset',
        'icon'     => 'wrench',
        'children' => array(
            'backup_settings' => array(
                'name' => 'Backup Settings',
                'slug' => 'backup_settings'
            ),
            'import_settings' => array(
                'name' => 'Import Settings',
                'slug' => 'import_settings'
            ),
            'reset_settings' => array(
                'name' => 'Reset Settings',
                'slug' => 'reset_settings'
            ),
        ),
	),
    'help_support' => array(
		'name'     => 'Help & Support',
		'slug'     => 'help_support',
        'type'     => 'plsh_support_iframe',
        'icon'     => 'info-circle',
        'children' => array()
    )
);


$_settings_admin_body = array(
	'general' => array(
        'logo_fav' => array(
            'use_image_logo' => array(
                'slug' => 'use_image_logo',
                'title' => 'Use logo image',
                'description' => 'Otherwise your site name will be displayed',
                'type' => 'switcher',
                'default' => '',
            ),
            'logo_image' => array(
                'slug' => 'logo_image',
                'title' => 'Upload logo image',
                'description' => '',
                'type' => 'fileupload',
                'default' => '',
                'dependant' => 'use_image_logo',
            ),
            'logo_image_alt' => array(
                'slug' => 'logo_image_alt',
                'title' => 'Logo image ALT text',
                'description' => '',
                'type' => 'textbox',
                'default' => '',
                'dependant' => 'use_image_logo',
            ),
            'favicon' => array(
                'slug' => 'favicon',
                'title' => 'Upload favicon image',
                'description' => 'What is favicon? Read <a href="https://en.wikipedia.org/wiki/Favicon" target="_blank">this</a>.',
                'type' => 'fileupload',
                'default' => '',
            ),
        ),
        'header' => array(
            'show_header_search' => array(
                'slug' => 'show_header_search',
                'title' => 'Show search in menu',
                'description' => '',
                'type' => 'checkbox',
                'default' => 'on',
            ),
            'show_trending' => array(
                'slug' => 'show_trending',
                'title' => 'Show trending news ticker',
                'description' => '',
                'type' => 'switcher',
                'default' => '',
            ),
            'trending_category' => array(
                'slug' => 'trending_category',
                'title' => 'Post category for news ticker',
                'description' => '',
                'type' => 'select',
                'data' => $post_categories,
                'default' => '',
                'dependant' => 'show_trending',
            ),
            'trending_title' => array(
                'slug' => 'trending_title',
                'title' => 'News ticker title',
                'description' => '',
                'type' => 'textbox',
                'default' => 'Trending',
                'dependant' => 'show_trending',
            ),
            'show_menu_new_items' => array(
                'slug' => 'show_menu_new_items',
                'title' => 'Show "staff picks" quick view in menu',
                'description' => '',
                'type' => 'switcher',
                'default' => '',
                'dependant' => '',
            ),
            'menu_new_items_count' => array(
                'slug' => 'menu_new_items_count',
                'title' => 'How many "staff picks" items to show',
                'description' => '',
                'type' => 'select',
                'data' => array(4 => 4, 6 => 6, 8 => 8, 10 => 10, 12 => 12, 14 => 14, 16 => 16),
                'default' => '10',
                'dependant' => 'show_menu_new_items',
            ),
            'menu_new_items_category' => array(
                'slug' => 'menu_new_items_category',
                'title' => 'Post category for "staff picks"',
                'description' => '',
                'type' => 'select',
                'data' => $post_categories,
                'default' => '',
                'dependant' => 'show_menu_new_items',
            ),
            'show_mosaic_overlay' =>  array(
                'slug' => 'show_mosaic_overlay',
                'title' => 'Fade out mosaic when opening the dropdown menu',
                'description' => 'Adjust the darkness for mosaic, so it does not interfere with the dropdown menu that\'s above it. Only happens if the mosaic actually is below the menu, for example in default homepage template.',
                'type' => 'checkbox',
                'default' => 'on',
            ),
            'show_header_social' => array(
                'slug' => 'show_header_social',
                'title' => 'Show header social icons',
                'description' => '',
                'type' => 'checkbox',
                'default' => '',
            ),
			'display_theme_og_tags' => array(
                'slug' => 'display_theme_og_tags',
                'title' => 'Use theme open graph tags',
                'description' => 'Used for social sharing',
                'type' => 'checkbox',
                'default' => 'on',
            ),	
        ),
        'footer' => array(
            'copyright' => array(
                'slug' => 'copyright',
                'title' => 'Copyright text',
                'description' => '',
                'type' => 'textbox',
                'default' => '',
            ),
            'show_footer_social' => array(
                'slug' => 'show_footer_social',
                'title' => 'Show footer social icons',
                'description' => '',
                'type' => 'checkbox',
                'default' => '',
            ),
        ),
        'blog' => array(
            'blog_title' => array(
                'slug' => 'blog_title',
                'title' => 'Blog title',
                'description' => '',
                'type' => 'textbox',
                'default' => 'Latest news',
            ),
            'blog_item_style' => array(
                'slug' => 'blog_item_style',
                'title' => 'Post item style',
                'description' => '',
                'type' => 'select',
                'data' => array('compact' => 'Compact', 'large' => 'Large' ),
                'default' => 'compact',
            ),
            'force_post_excerpt' =>  array(
                'slug' => 'force_post_excerpt',
                'title' => 'Use automatic post excerpts',
                'description' => 'If manual excerpt is not defined, theme will automatically cap articles at 50 words',
                'type' => 'checkbox',
                'default' => 'on',
            ),
            'sidebar_position' => array(
                'slug' => 'sidebar_position',
                'title' => 'Sidebar position',
                'description' => 'This setting also applies to sidebar position for blog posts and pages',
                'type' => 'select',
                'data' => array('left' => 'Left', 'right' => 'Right' ),
                'default' => 'right',
            ),
            'enable_sidebar_affix' =>  array(
                'slug' => 'enable_sidebar_affix',
                'title' => 'Enable smart (affixed) sidebar',
                'description' => 'If there is large sections of white space below sidebar, it will automatically follow along as you scroll.',
                'type' => 'checkbox',
                'default' => 'on',
            ),
            'show_featured_articles' =>  array(
                'slug' => 'show_featured_articles',
                'title' => 'Show featured articles',
                'description' => 'Theme will show the corresponding featured articles right above main blogroll',
                'type' => 'checkbox',
                'default' => '',
            ),
            'featured_article_size' => array(
                'slug' => 'featured_article_size',
                'title' => 'Featured article style',
                'description' => '',
                'type' => 'select',
                'data' => array('small' => 'Small - above blog posts', 'large' => 'Large - above both posts and sidebar' ),
                'default' => 'small',
                'dependant' => 'show_featured_articles'
            ),
            'blog_index_featured_type' => array(
                'slug' => 'blog_index_featured_type',
                'title' => 'Featured posts on blog index',
                'description' => 'Choose how should the featured posts be selected - by picking the latest 3 articles that were checked as featured or by loading posts that have a certain category',
                'type' => 'select',
                'data' => array('featured' => 'Select latest posts checked as featured', 'category' => 'Select by custom category' ),
                'default' => 'featured',
                'dependant' => 'show_featured_articles'
            ),
            'blog_index_featured_category' => array(
                'slug' => 'blog_index_featured_category',
                'title' => 'Blog index featured posts category',
                'description' => 'Pick a category from which to show featured articles on main blog page. <strong>Only needed if "Select by custom category" is selected above!</strong>',
                'type' => 'select',
                'data' => $post_categories,
                'default' => '',
                'dependant' => 'show_featured_articles blog_index_featured_type blog_index_featured_type=[category]',
            ),
            'blog_archive_featured_type' => array(
                'slug' => 'blog_archive_featured_type',
                'title' => 'Featured posts on blog archives',
                'description' => 'Blog archives are category, tag etc. pages.  Choose how should the featured posts be selected - by picking the latest 3 articles that where checked as featured or by loading posts that have a certain category',
                'type' => 'select',
                'data' => array('featured' => 'Select latest posts checked as featured', 'category' => 'Select by custom category' ),
                'default' => 'featured',
                'dependant' => 'show_featured_articles'
            ),
            'blog_archive_featured_category' => array(
                'slug' => 'blog_archive_featured_category',
                'title' => 'Blog archive featured posts category',
                'description' => 'Pick a category from which to show featured articles on blog archives. <strong>Only needed if "Select by custom category" is selected above!</strong>',
                'type' => 'select',
                'data' => $post_categories,
                'default' => '',
                'dependant' => 'show_featured_articles blog_archive_featured_type blog_archive_featured_type=[category]',
            ),  
        ),
        'post' => array(
            'show_post_quick_view' =>  array(
                'slug' => 'show_post_quick_view',
                'title' => 'Enable post quickview',
                'description' => 'Displays additional content on hovering the post item on homepage, sidebar etc.',
                'type' => 'checkbox',
                'default' => 'on',
            ),
            'show_post_read_progress' =>  array(
                'slug' => 'show_post_read_progress',
                'title' => 'Show reading progress bar',
                'description' => 'A fixed progress bar will appear above content and display how far along the post user is',
                'type' => 'checkbox',
                'default' => 'on',
            ),
            'post_style' => array(
                'slug' => 'post_style',
                'title' => 'Default Post style',
                'description' => 'You can alter this setting on post by post basis by editing settings in post editor',
                'type' => 'select',
                'data' => array('sidebar' => 'With sidebar', 'no-sidebar' => 'Full width' ),
                'default' => 'no-sidebar',
            ),
            'post_image_width' => array(
                'slug' => 'post_image_width',
                'title' => 'Post image size',
                'description' => '',
                'type' => 'select',
                'data' => array('text_width' => 'As wide as text', 'container_width' => 'As wide as site container (for posts with sidebar only)', 'full_screen' => 'Full screen width', 'no_image' => 'No image' ),
                'default' => 'text_width',
            ),
            'post_navigation' => array(
                'slug' => 'post_navigation',
                'title' => 'Content navigation bar',
                'description' => 'Show navigation for different post sections, comments etc.',
                'type' => 'select',
                'data' => array('enabled' => 'Enable for all', 'selected' => 'Enable for individual posts/pages', 'disabled' => 'Disable for all'),
                'default' => 'selected',
            ),
            'show_about_author' =>  array(
                'slug' => 'show_about_author',
                'title' => 'Show "about author" section',
                'description' => '',
                'type' => 'checkbox',
                'default' => 'on',
            ),
            'show_post_share' =>  array(
                'slug' => 'show_post_share',
                'title' => 'Show share buttons above post image',
                'description' => '',
                'type' => 'checkbox',
                'default' => 'on',
            ),
            'show_post_share_counter' =>  array(
                'slug' => 'show_post_share_counter',
                'title' => 'Show share counter below post',
                'description' => '',
                'type' => 'checkbox',
                'default' => 'on',
            ),
        ),
        'gallery' => array(
            'gallery_show_featured_articles' =>  array(
                'slug' => 'gallery_show_featured_articles',
                'title' => 'Show featured articles',
                'description' => 'Theme will show the corresponding featured articles below galleries',
                'type' => 'checkbox',
                'default' => '',
            ),
            'gallery_index_featured_type' => array(
                'slug' => 'gallery_index_featured_type',
                'title' => 'Featured post type',
                'description' => 'Choose how should the featured posts be selected - by picking the latest 3 articles that were checked as featured or by loading posts that have a certain category',
                'type' => 'select',
                'data' => array('featured' => 'Select latest posts checked as featured', 'category' => 'Select by custom category' ),
                'default' => 'featured',
                'dependant' => 'gallery_show_featured_articles'
            ),
            'gallery_index_featured_category' => array(
                'slug' => 'gallery_index_featured_category',
                'title' => 'Blog index featured posts category',
                'description' => 'Pick a category from which to show featured articles on main blog page. <strong>Only needed if "Select by custom category" is selected above!</strong>',
                'type' => 'select',
                'data' => $post_categories,
                'default' => '',
                'dependant' => 'gallery_show_featured_articles gallery_index_featured_type gallery_index_featured_type=[category]',
            ),
        ),
        'shop' => array(
            'show_shop_sidebar' => array(
                'slug' => 'show_shop_sidebar',
                'title' => 'Show sidebar in shop catalog',
                'description' => '',
                'type' => 'checkbox',
                'default' => '',
            ),
            'show_product_sidebar' => array(
                'slug' => 'show_product_sidebar',
                'title' => 'Show sidebar in single product view',
                'description' => '',
                'type' => 'checkbox',
                'default' => '',
            ),
        ),
        'social' => array(
            'social_facebook' => array(
                'slug' => 'social_facebook',
                'title' => 'Facebook profile URL',
                'description' => '',
                'type' => 'textbox',
                'default' => '',
            ),
            'social_twitter' => array(
                'slug' => 'social_twitter',
                'title' => 'Twitter account URL',
                'description' => '',
                'type' => 'textbox',
                'default' => '',
            ),
            'social_pinterest' => array(
                'slug' => 'social_pinterest',
                'title' => 'Pinterest account URL',
                'description' => '',
                'type' => 'textbox',
                'default' => '',
            ),
            'social_youtube' => array(
                'slug' => 'social_youtube',
                'title' => 'Youtube account URL',
                'description' => '',
                'type' => 'textbox',
                'default' => '',
            ),
            'social_gplus' => array(
                'slug' => 'social_gplus',
                'title' => 'Google plus account URL',
                'description' => '',
                'type' => 'textbox',
                'default' => '',
            ),
			'social_instagram' => array(
                'slug' => 'social_instagram',
                'title' => 'Instagram account URL',
                'description' => '',
                'type' => 'textbox',
                'default' => '',
            ),
			'social_linkedin' => array(
                'slug' => 'social_linkedin',
                'title' => 'LinkedIn account URL',
                'description' => '',
                'type' => 'textbox',
                'default' => '',
            ),
            'social_rss' => array(
                'slug' => 'social_rss',
                'title' => 'RSS URL',
                'description' => '',
                'type' => 'textbox',
                'default' => '',
            ),
        ),
        'custom_code' => array(
            'custom_css' => array(
                'slug' => 'custom_css',
                'title' => 'Custom CSS',
                'description' => 'If you want to modify the appearance of any elements on site, you can write the CSS code here.',
                'type' => 'textarea',
                'default' => '',
            ),
            'custom_js' => array(
                'slug' => 'custom_js',
                'title' => 'Custom Javascript',
                'description' => 'If you want add any extra Javascript to your site, like Google Analytics code, paste it here (no script tags needed).',
                'type' => 'textarea',
                'default' => '',
            )
        )
    ),
    'visual_editor' => array(
        'visual_background' => array(
            'background_image' => array(
                'slug' => 'background_image',
                'title' => 'Body background image',
                'description' => '',
                'type' => 'background',
                'default' => '',
            ),
            'background_repeat' => array(
                'slug' => 'background_repeat',
                'title' => 'Background image repeat',
                'description' => '',
                'type' => 'select',
                'data' => array('repeat' => 'Repeat', 'no-repeat' => 'No-repeat'),
                'default' => 'repeat',
            ),
            'background_attachment' => array(
                'slug' => 'background_attachment',
                'title' => 'Background image attachment',
                'description' => '',
                'type' => 'select',
                'data' => array('scroll' => 'Scrollable', 'fixed' => 'Fixed to top'),
                'default' => 'scroll',
            ),
            'background_color' => array(
                'slug' => 'background_color',
                'title' => 'Body background color (if no image is set)',
                'description' => '',
                'type' => 'color',
                'default' => '#efefef',
            ),
            'content_background_color' => array(
                'slug' => 'content_background_color',
                'title' => 'Content box background color',
                'description' => '',
                'type' => 'color',
                'default' => '#f7f7f7',
            ),
            'content_box_border_color' => array(
                'slug' => 'content_box_border_color',
                'title' => 'Content box border color',
                'description' => '',
                'type' => 'color',
                'default' => '#e8e8e8',
            ),
            'content_box_opacity' => array(
                'slug' => 'content_box_opacity',
                'title' => 'Content box opacity',
                'description' => '',
                'type' => 'select',
                'data' => array('0.1' => '10%', '0.2' => '20%', '0.3' => '30%', '0.4' => '40%', '0.5' => '50%', '0.6' => '60%', '0.7' => '70%', '0.8' => '80%', '0.9' => '90%', '1' => '100%'),
                'default' => '1',
            ),
            'enable_particle_background' => array(
                'slug' => 'enable_particle_background',
                'title' => 'Enable active particle background',
                'description' => '',
                'type' => 'checkbox',
                'default' => '',
            ),
            'particle_color' => array(
                'slug' => 'particle_color',
                'title' => 'Particle color',
                'description' => '',
                'type' => 'color',
                'default' => '#e3e3e3',
            ),
        ),
        'visual_fonts' => array(
            'general_font' => array(
                'slug' => 'general_font',
                'title' => 'General text font',
                'description' => 'Used for most texts in the theme',
                'type' => 'font_select',
                'data' => plsh_get_all_google_fonts(),
                'default' => 'Raleway',
            ),
            'logo_font' => array(
                'slug' => 'logo_font',
                'title' => 'Logo text font',
                'description' => '',
                'type' => 'font_select',
                'data' => plsh_get_all_google_fonts(),
                'default' => 'Raleway',
            ),            
            'menu_font' => array(
                'slug' => 'menu_font',
                'title' => 'Menu text font',
                'description' => '',
                'type' => 'font_select',
                'data' => plsh_get_all_google_fonts(),
                'default' => 'Raleway',
            ),
            'content_block_title_font' => array(
                'slug' => 'content_block_title_font',
                'title' => 'Block title font',
                'description' => '',
                'type' => 'font_select',
                'data' => plsh_get_all_google_fonts(),
                'default' => 'Raleway',
            ),            
        ),
        'visual_sidebar' => array(

        ),
        'visual_colors' => array(
            'regular_text_color' => array( //*******
                'slug' => 'regular_text_color',
                'title' => 'Regular text color',
                'description' => '',
                'type' => 'color',
                'default' => '#252525',
            ),
            'regular_link_color' => array(  //*******
                'slug' => 'regular_link_color',
                'title' => 'Regular link color',
                'description' => '',
                'type' => 'color',
                'default' => '#252525',
            ),
            'primary_special_color' => array(
                'slug' => 'primary_special_color',
                'title' => 'Primary special color',
                'description' => '',
                'type' => 'color',
                'default' => '#ff5732',
            ),
            'secondary_special_color' => array(
                'slug' => 'secondary_special_color',
                'title' => 'Secondary special color (buttons, icons etc.)',
                'description' => '',
                'type' => 'color',
                'default' => '#e7e7e7',
            ),
            'menu_bar_background' => array(
                'slug' => 'menu_bar_background',
                'title' => 'Menu bar background color',
                'description' => '',
                'type' => 'color',
                'default' => '#252525',
            ),
            'menu_bar_text_color' => array(
                'slug' => 'menu_bar_text_color',
                'title' => 'Menu item text color',
                'description' => '',
                'type' => 'color',
                'default' => '#fff',
            ),
            'menu_dropdown_background' => array(
                'slug' => 'menu_dropdown_background',
                'title' => 'Menu dropdown background color',
                'description' => '',
                'type' => 'color',
                'default' => '#333',
            ),
            'border_shadow_color' => array(
                'slug' => 'border_shadow_color',
                'title' => 'Primary border color (titles, blocks etc)',
                'description' => '',
                'type' => 'color',
                'default' => '#e4e4e4',
            ),
            'secondary_border_color' => array(
                'slug' => 'secondary_border_color',
                'title' => 'Secondary border color (buttons)',
                'description' => '',
                'type' => 'color',
                'default' => '#d9d9d9',
            ),
            'content_block_heading_color' => array(
                'slug' => 'content_block_heading_color',
                'title' => 'Content block heading color',
                'description' => '',
                'type' => 'color',
                'default' => '#ff5732',
            ),
            'block_background_color' => array(
                'slug' => 'block_background_color',
                'title' => 'Content block background color (widgets etc.)',
                'description' => '',
                'type' => 'color',
                'default' => '#fff',
            ),
            'footer_background_color' => array(
                'slug' => 'footer_background_color',
                'title' => 'Footer background color',
                'description' => '',
                'type' => 'color',
                'default' => '#252525',
            ),
            'footer_heading_color' => array(
                'slug' => 'footer_heading_color',
                'title' => 'Footer heading color',
                'description' => '',
                'type' => 'color',
                'default' => '#ff5732',
            ),
            'post_overlay_color' => array(
                'slug' => 'post_overlay_color',
                'title' => 'Post overlay color',
                'description' => '',
                'type' => 'color',
                'default' => '#252525',
            ),
            'post_overlay_text_color' => array(
                'slug' => 'post_overlay_text_color',
                'title' => 'Post overlay text color',
                'description' => '',
                'type' => 'color',
                'default' => '#ffffff',
            ),
            'form_field_background' => array(
                'slug' => 'form_field_background',
                'title' => 'Form field background color',
                'description' => '',
                'type' => 'color',
                'default' => '#fff',
            ),
            'form_field_text_color' => array(
                'slug' => 'form_field_text_color',
                'title' => 'Form field text color',
                'description' => '',
                'type' => 'color',
                'default' => '#252525',
            ),            
        ),
    ),
    'ads_manager' => array(
        'ads_manager' => array(
            '728x90' => array(
                'slug' => '728x90',
                'title' => '728x90px',
                'description' => '',
                'default' => array(array('ad_enabled' => 'on', 'ad_slug' => 'default', 'ad_title' => 'Default 728x90', 'ad_type' => 'banner', 'googlead_content' => '', 'ad_file' => PLSH_IMG_URL . 'banner-728x90.png', 'ad_link' => '', 'ad_iframe_src' => ''))
            ),
            '468x60' => array(
                'slug' => '468x60',
                'title' => '468x60px',
                'description' => '',
                'default' => array(array('ad_enabled' => 'on', 'ad_slug' => 'default', 'ad_title' => 'Default 468x60', 'ad_type' => 'banner', 'googlead_content' => '', 'ad_file' => PLSH_IMG_URL . 'banner-468x60.png', 'ad_link' => '', 'ad_iframe_src' => ''))
            ),
            '300x250' => array(
                'slug' => '300x250',
                'title' => '300x250px',
                'description' => '',
                'default' => array(array('ad_enabled' => 'on', 'ad_slug' => 'default', 'ad_title' => 'Default 300x250', 'ad_type' => 'banner', 'googlead_content' => '', 'ad_file' => PLSH_IMG_URL . 'banner-300x250.png', 'ad_link' => '', 'ad_iframe_src' => ''))
            ),
            '150x125' => array(
                'slug' => '150x125',
                'title' => '150x125 (group of 4)',
                'description' => '',
                'default' => array(array('ad_enabled' => 'on', 'ad_slug' => 'default', 'ad_title' => 'Default 150x125', 'ad_type' => 'banner', 'googlead_content:0' => '', 'googlead_content:1' => '', 'googlead_content:2' => '', 'googlead_content:3' => '', 'ad_file:0' => PLSH_IMG_URL . 'banner-150x125.png', 'ad_link:0' => '', 'ad_file:1' => PLSH_IMG_URL . 'banner-150x125.png', 'ad_link:1' => '', 'ad_file:2' => PLSH_IMG_URL . 'banner-150x125.png', 'ad_link:2' => '', 'ad_file:3' => PLSH_IMG_URL . 'banner-150x125.png', 'ad_link:3' => '', 'ad_iframe_src:0' => '', 'ad_iframe_src:1' => '', 'ad_iframe_src:2' => '', 'ad_iframe_src:3' => ''))
            ),
        ),
        'ad_locations' => array(
            'header_ad' => array(
                'slug' => 'header_ad',
                'title' => 'Header',
                'description' => 'The main site banner visible in header. Supports 728x90 or 468x60 ads',
                'supports' => array('728x90', '468x60'),
                'default' => array('ad_enabled' => 'on', 'ad_slug' => 'default', 'ad_size' => '728x90')
            ),
            'blog_ad' => array(
                'slug' => 'blog_ad',
                'title' => 'Blog index',
                'description' => 'Ad that is visible below the list of posts. Supports 468x60 ads',
                'supports' => array('468x60'),
                'default' => array('ad_enabled' => 'on', 'ad_slug' => 'default', 'ad_size' => '468x60')
            ),
            'post_ad' => array(
                'slug' => 'post_ad',
                'title' => 'Blog Post',
                'description' => 'Ad that is visible below the a post. Supports 468x60 ads',
                'supports' => array('468x60'),
                'default' => array('ad_enabled' => 'on', 'ad_slug' => 'default', 'ad_size' => '468x60')
            ),
            'gallery_ad' => array(
                'slug' => 'gallery_ad',
                'title' => 'Gallery index',
                'description' => 'Ad that is visible below list of galleries. Supports 728x90 or 468x60 ads',
                'supports' => array('728x90', '468x60'),
                'default' => array('ad_enabled' => 'on', 'ad_slug' => 'default', 'ad_size' => '728x90')
            ),
            'single_gallery_ad' => array(
                'slug' => 'single_gallery_ad',
                'title' => 'Gallery item',
                'description' => 'Ad that is visible below open gallery content. Supports 728x90 or 468x60 ads',
                'supports' => array('728x90', '468x60'),
                'default' => array('ad_enabled' => 'on', 'ad_slug' => 'default', 'ad_size' => '728x90')
            ),
        ),
    ),
);

/*

	'general_settings' => array(
		'general_textbox' => array(
			'slug' => 'general_textbox',
			'title' => 'Textbox example',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt',
			'default' => 'test',
			'type' => 'textbox'
		),
		'general_checkbox' => array(
			'slug' => 'general_checkbox',
			'title' => 'Checkbox example',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt',
			'type' => 'checkbox',
			'default' => '',
		),
		'general_select' => array(
			'slug' => 'general_select',
			'title' => 'Select example',
			'description' => 'Lorem ipsum dolor sit amet',
			'type' => 'select',
			'data' => $select_example,
			'default' => '--',
			'dependant' => 'general_checkbox'
		),
		'general_textarea' => array(
			'slug' => 'general_textarea',
			'title' => 'Textarea example',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing',
			'type' => 'textarea',
			'default' => '',
			'dependant' => 'general_checkbox'
		),
	)

*/

?>