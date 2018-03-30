<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
    
  $google_fonts = 'ABeeZee+++Abel+++Abril Fatface+++Aclonica+++Acme+++Actor+++Adamina+++Advent Pro+++Aguafina Script+++Akronim+++Aladin+++Aldrich+++Alef+++Alegreya+++Alegreya Sans+++Alegreya Sans SC+++Alegreya SC+++Alex Brush+++Alfa Slab One+++Alice+++Alike+++Alike Angular+++Allan+++Allerta+++Allerta Stencil+++Allura+++Almendra+++Almendra Display+++Almendra SC+++Amarante+++Amaranth+++Amatic SC+++Amethysta+++Amiri+++Amita+++Anaheim+++Andada+++Andika+++Angkor+++Annie Use Your Telescope+++Anonymous Pro+++Antic+++Antic Didone+++Antic Slab+++Anton+++Arapey+++Arbutus+++Arbutus Slab+++Architects Daughter+++Archivo Black+++Archivo Narrow+++Arimo+++Arizonia+++Armata+++Artifika+++Arvo+++Arya+++Asap+++Asar+++Asset+++Astloch+++Asul+++Atomic Age+++Aubrey+++Audiowide+++Autour One+++Average+++Average Sans+++Averia Gruesa Libre+++Averia Libre+++Averia Sans Libre+++Averia Serif Libre+++Bad Script+++Balthazar+++Bangers+++Basic+++Battambang+++Baumans+++Bayon+++Belgrano+++Belleza+++BenchNine+++Bentham+++Berkshire Swash+++Bevan+++Bigelow Rules+++Bigshot One+++Bilbo+++Bilbo Swash Caps+++Biryani+++Bitter+++Black Ops One+++Bokor+++Bonbon+++Boogaloo+++Bowlby One+++Bowlby One SC+++Brawler+++Bree Serif+++Bubblegum Sans+++Bubbler One+++Buda+++Buenard+++Butcherman+++Butterfly Kids+++Cabin+++Cabin Condensed+++Cabin Sketch+++Caesar Dressing+++Cagliostro+++Calligraffitti+++Cambay+++Cambo+++Candal+++Cantarell+++Cantata One+++Cantora One+++Capriola+++Cardo+++Carme+++Carrois Gothic+++Carrois Gothic SC+++Carter One+++Catamaran+++Caudex+++Cedarville Cursive+++Ceviche One+++Changa One+++Chango+++Chau Philomene One+++Chela One+++Chelsea Market+++Chenla+++Cherry Cream Soda+++Cherry Swash+++Chewy+++Chicle+++Chivo+++Chonburi+++Cinzel+++Cinzel Decorative+++Clicker Script+++Coda+++Coda Caption+++Codystar+++Combo+++Comfortaa+++Coming Soon+++Concert One+++Condiment+++Content+++Contrail One+++Convergence+++Cookie+++Copse+++Corben+++Courgette+++Cousine+++Coustard+++Covered By Your Grace+++Crafty Girls+++Creepster+++Crete Round+++Crimson Text+++Croissant One+++Crushed+++Cuprum+++Cutive+++Cutive Mono+++Damion+++Dancing Script+++Dangrek+++Dawning of a New Day+++Days One+++Dekko+++Delius+++Delius Swash Caps+++Delius Unicase+++Della Respira+++Denk One+++Devonshire+++Dhurjati+++Didact Gothic+++Diplomata+++Diplomata SC+++Domine+++Donegal One+++Doppio One+++Dorsa+++Dosis+++Dr Sugiyama+++Droid Sans+++Droid Sans Mono+++Droid Serif+++Duru Sans+++Dynalight+++Eagle Lake+++Eater+++EB Garamond+++Economica+++Eczar+++Ek Mukta+++Electrolize+++Elsie+++Elsie Swash Caps+++Emblema One+++Emilys Candy+++Engagement+++Englebert+++Enriqueta+++Erica One+++Esteban+++Euphoria Script+++Ewert+++Exo+++Exo 2+++Expletus Sans+++Fanwood Text+++Fascinate+++Fascinate Inline+++Faster One+++Fasthand+++Fauna One+++Federant+++Federo+++Felipa+++Fenix+++Finger Paint+++Fira Mono+++Fira Sans+++Fjalla One+++Fjord One+++Flamenco+++Flavors+++Fondamento+++Fontdiner Swanky+++Forum+++Francois One+++Freckle Face+++Fredericka the Great+++Fredoka One+++Freehand+++Fresca+++Frijole+++Fruktur+++Fugaz One+++Gabriela+++Gafata+++Galdeano+++Galindo+++Gentium Basic+++Gentium Book Basic+++Geo+++Geostar+++Geostar Fill+++Germania One+++GFS Didot+++GFS Neohellenic+++Gidugu+++Gilda Display+++Give You Glory+++Glass Antiqua+++Glegoo+++Gloria Hallelujah+++Goblin One+++Gochi Hand+++Gorditas+++Goudy Bookletter 1911+++Graduate+++Grand Hotel+++Gravitas One+++Great Vibes+++Griffy+++Gruppo+++Gudea+++Gurajada+++Habibi+++Halant+++Hammersmith One+++Hanalei+++Hanalei Fill+++Handlee+++Hanuman+++Happy Monkey+++Headland One+++Henny Penny+++Herr Von Muellerhoff+++Hind+++Hind Siliguri+++Hind Vadodara+++Holtwood One SC+++Homemade Apple+++Homenaje+++Iceberg+++Iceland+++IM Fell Double Pica+++IM Fell Double Pica SC+++IM Fell DW Pica+++IM Fell DW Pica SC+++IM Fell English+++IM Fell English SC+++IM Fell French Canon+++IM Fell French Canon SC+++IM Fell Great Primer+++IM Fell Great Primer SC+++Imprima+++Inconsolata+++Inder+++Indie Flower+++Inika+++Inknut Antiqua+++Irish Grover+++Istok Web+++Italiana+++Italianno+++Itim+++Jacques Francois+++Jacques Francois Shadow+++Jaldi+++Jim Nightshade+++Jockey One+++Jolly Lodger+++Josefin Sans+++Josefin Slab+++Joti One+++Judson+++Julee+++Julius Sans One+++Junge+++Jura+++Just Another Hand+++Just Me Again Down Here+++Kadwa+++Kalam+++Kameron+++Kantumruy+++Karla+++Karma+++Kaushan Script+++Kavoon+++Kdam Thmor+++Keania One+++Kelly Slab+++Kenia+++Khand+++Khmer+++Khula+++Kite One+++Knewave+++Kotta One+++Koulen+++Kranky+++Kreon+++Kristi+++Krona One+++Kurale+++La Belle Aurore+++Laila+++Lakki Reddy+++Lancelot+++Lateef+++Lato+++League Script+++Leckerli One+++Ledger+++Lekton+++Lemon+++Libre Baskerville+++Life Savers+++Lilita One+++Lily Script One+++Limelight+++Linden Hill+++Lobster+++Lobster Two+++Londrina Outline+++Londrina Shadow+++Londrina Sketch+++Londrina Solid+++Lora+++Love Ya Like A Sister+++Loved by the King+++Lovers Quarrel+++Luckiest Guy+++Lusitana+++Lustria+++Macondo+++Macondo Swash Caps+++Magra+++Maiden Orange+++Mako+++Mallanna+++Mandali+++Marcellus+++Marcellus SC+++Marck Script+++Margarine+++Marko One+++Marmelad+++Martel+++Martel Sans+++Marvel+++Mate+++Mate SC+++Maven Pro+++McLaren+++Meddon+++MedievalSharp+++Medula One+++Megrim+++Meie Script+++Merienda+++Merienda One+++Merriweather+++Merriweather Sans+++Metal+++Metal Mania+++Metamorphous+++Metrophobic+++Michroma+++Milonga+++Miltonian+++Miltonian Tattoo+++Miniver+++Miss Fajardose+++Modak+++Modern Antiqua+++Molengo+++Molle+++Monda+++Monofett+++Monoton+++Monsieur La Doulaise+++Montaga+++Montez+++Montserrat+++Montserrat Alternates+++Montserrat Subrayada+++Moul+++Moulpali+++Mountains of Christmas+++Mouse Memoirs+++Mr Bedfort+++Mr Dafoe+++Mr De Haviland+++Mrs Saint Delafield+++Mrs Sheppards+++Muli+++Mystery Quest+++Neucha+++Neuton+++New Rocker+++News Cycle+++Niconne+++Nixie One+++Nobile+++Nokora+++Norican+++Nosifer+++Nothing You Could Do+++Noticia Text+++Noto Sans+++Noto Serif+++Nova Cut+++Nova Flat+++Nova Mono+++Nova Oval+++Nova Round+++Nova Script+++Nova Slim+++Nova Square+++NTR+++Numans+++Nunito+++Odor Mean Chey+++Offside+++Old Standard TT+++Oldenburg+++Oleo Script+++Oleo Script Swash Caps+++Open Sans+++Open Sans Condensed+++Oranienbaum+++Orbitron+++Oregano+++Orienta+++Original Surfer+++Oswald+++Over the Rainbow+++Overlock+++Overlock SC+++Ovo+++Oxygen+++Oxygen Mono+++Pacifico+++Palanquin+++Palanquin Dark+++Paprika+++Parisienne+++Passero One+++Passion One+++Pathway Gothic One+++Patrick Hand+++Patrick Hand SC+++Patua One+++Paytone One+++Peddana+++Peralta+++Permanent Marker+++Petit Formal Script+++Petrona+++Philosopher+++Piedra+++Pinyon Script+++Pirata One+++Plaster+++Play+++Playball+++Playfair Display+++Playfair Display SC+++Podkova+++Poiret One+++Poller One+++Poly+++Pompiere+++Pontano Sans+++Poppins+++Port Lligat Sans+++Port Lligat Slab+++Pragati Narrow+++Prata+++Preahvihear+++Press Start 2P+++Princess Sofia+++Prociono+++Prosto One+++PT Mono+++PT Sans+++PT Sans Caption+++PT Sans Narrow+++PT Serif+++PT Serif Caption+++Puritan+++Purple Purse+++Quando+++Quantico+++Quattrocento+++Quattrocento Sans+++Questrial+++Quicksand+++Quintessential+++Qwigley+++Racing Sans One+++Radley+++Rajdhani+++Raleway+++Raleway Dots+++Ramabhadra+++Ramaraja+++Rambla+++Rammetto One+++Ranchers+++Rancho+++Ranga+++Rationale+++Ravi Prakash+++Redressed+++Reenie Beanie+++Revalia+++Rhodium Libre+++Ribeye+++Ribeye Marrow+++Righteous+++Risque+++Roboto+++Roboto Condensed+++Roboto Mono+++Roboto Slab+++Rochester+++Rock Salt+++Rokkitt+++Romanesco+++Ropa Sans+++Rosario+++Rosarivo+++Rouge Script+++Rozha One+++Rubik+++Rubik Mono One+++Rubik One+++Ruda+++Rufina+++Ruge Boogie+++Ruluko+++Rum Raisin+++Ruslan Display+++Russo One+++Ruthie+++Rye+++Sacramento+++Sahitya+++Sail+++Salsa+++Sanchez+++Sancreek+++Sansita One+++Sarala+++Sarina+++Sarpanch+++Satisfy+++Scada+++Scheherazade+++Schoolbell+++Seaweed Script+++Sevillana+++Seymour One+++Shadows Into Light+++Shadows Into Light Two+++Shanti+++Share+++Share Tech+++Share Tech Mono+++Shojumaru+++Short Stack+++Siemreap+++Sigmar One+++Signika+++Signika Negative+++Simonetta+++Sintony+++Sirin Stencil+++Six Caps+++Skranji+++Slabo 13px+++Slabo 27px+++Slackey+++Smokum+++Smythe+++Sniglet+++Snippet+++Snowburst One+++Sofadi One+++Sofia+++Sonsie One+++Sorts Mill Goudy+++Source Code Pro+++Source Sans Pro+++Source Serif Pro+++Special Elite+++Spicy Rice+++Spinnaker+++Spirax+++Squada One+++Sree Krushnadevaraya+++Stalemate+++Stalinist One+++Stardos Stencil+++Stint Ultra Condensed+++Stint Ultra Expanded+++Stoke+++Strait+++Sue Ellen Francisco+++Sumana+++Sunshiney+++Supermercado One+++Sura+++Suranna+++Suravaram+++Suwannaphum+++Swanky and Moo Moo+++Syncopate+++Tangerine+++Taprom+++Tauri+++Teko+++Telex+++Tenali Ramakrishna+++Tenor Sans+++Text Me One+++The Girl Next Door+++Tienne+++Tillana+++Timmana+++Tinos+++Titan One+++Titillium Web+++Trade Winds+++Trocchi+++Trochut+++Trykker+++Tulpen One+++Ubuntu+++Ubuntu Condensed+++Ubuntu Mono+++Ultra+++Uncial Antiqua+++Underdog+++Unica One+++UnifrakturCook+++UnifrakturMaguntia+++Unkempt+++Unlock+++Unna+++Vampiro One+++Varela+++Varela Round+++Vast Shadow+++Vesper Libre+++Vibur+++Vidaloka+++Viga+++Voces+++Volkhov+++Vollkorn+++Voltaire+++VT323+++Waiting for the Sunrise+++Wallpoet+++Walter Turncoat+++Warnes+++Wellfleet+++Wendy One+++Wire One+++Work Sans+++Yanone Kaffeesatz+++Yantramanav+++Yellowtail+++Yeseva One+++Yesteryear+++Zeyada';
  $google_fonts = explode('+++',$google_fonts);
  foreach($google_fonts as $font_name){ 
	  $google_font_array[] = array('value' => str_replace(' ','+',$font_name), 'label' => $font_name, 'src' => ''); 
  }
  
  $countdown_lang = array(
  	'' => 'English',
  	'ar' => 'Arabic',
  	'bg' => 'Bulgarian',
  	'bn' => 'Bengali/Bangla',
  	'bs' => 'Bosnian Latin',
  	'ca' => 'Catalan',
  	'cs' => 'Czech',
  	'cy' => 'Welsh',
  	'da' => 'Danish',
  	'de' => 'German',
  	'el' => 'Greek',
  	'es' => 'Spanish',
  	'et' => 'Estonian',
  	'fa' => 'Persian',
  	'fi' => 'Finnish',
  	'fo' => 'Faroese',
  	'fr' => 'French',
  	'gl' => 'Galician',
  	'gu' => 'Gujarati',
  	'he' => 'Hebrew',
  	'hr' => 'Croatian',
  	'hu' => 'Hungarian',
  	'hy' => 'Armenian',
  	'id' => 'Indonesian',
  	'is' => 'Icelandic',
  	'it' => 'Italian',
  	'ja' => 'Japanese',
  	'kn' => 'Kannada',
  	'ko' => 'Korean',
  	'lt' => 'Lithuanian',
  	'lv' => 'Latvian',
  	'ml' => 'Malayalam/Indian',
  	'ms' => 'Malay',
  	'my' => 'Burmese',
  	'nb' => 'Norwegian',
  	'nl' => 'Dutch',
  	'pl' => 'Polish',
  	'pt-BR' => 'Brazilian',
  	'ro' => 'Romanian',
  	'ru' => 'Russian',
  	'sk' => 'Slovak',
  	'sl' => 'Slovenian',
  	'sq' => 'Albanian',
  	'sr-SR' => 'Serbian Latin',
  	'sr' => 'Serbian Cyrillic',
  	'sv' => 'Swedish',
  	'th' => 'Thai',
  	'tr' => 'Turkish',
  	'uk' => 'Ukrainian',
  	'ur' => 'Urdu',
  	'uz' => 'Uzbek',
  	'vi' => 'Vietnamese',
  	'zh-CN' => 'Simplified Chinese',
  	'zh-TW' => 'Traditional Chinese'
  );
  
  foreach($countdown_lang as $key => $lang):
  	$countdown_lang_array[] = array('value' => $key, 'label' => $lang, 'src' => '');
  endforeach;
   
  $custom_settings = array( 
    'contextual_help' => array( 
      'content'       => array( 
        array(
          'id'        => 'guides_and_support',
          'title'     => 'Guides &amp; Support',
          'content'   => '<ol>
	<li>Check out the <a href="http://boxystudio.com/documentation/espresso">documentation</a> ...</li>
	<li>... or get <a>support here</a>.</li>
</ol>'
        )
      ),
      'sidebar'       => 'Need some help with this theme?'
    ),
    'sections'        => array( 
      array(
        'id'          => 'general_styling',
        'title'       => 'General Styling'
      ),
      array(
        'id'          => 'header',
        'title'       => 'Header'
      ),
      array(
      	'id'		=> 'mobile_options',
      	'title'		=> 'Mobile Options'
      ),
      array(
        'id'          => 'colors',
        'title'       => 'Colors'
      ),
      array(
        'id'          => 'footer_settings',
        'title'       => 'Footer Settings'
      ),
      array(
        'id'          => 'social_links',
        'title'       => 'Socials &amp; Search'
      ),
      array(
        'id'          => 'twitter_settings',
        'title'       => 'Twitter Settings'
      ),
      array(
        'id'          => 'facebook_settings',
        'title'       => 'Facebook Settings'
      ),
      array(
        'id'          => 'miscellaneous',
        'title'       => 'Miscellaneous'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'logo_type',
        'label'       => 'Logo Type',
        'desc'        => 'Do you want a text-based or image-based logo?',
        'std'         => 'text',
        'type'        => 'radio',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'text',
            'label'       => 'Text-based logo',
            'src'         => ''
          ),
          array(
            'value'       => 'image',
            'label'       => 'Image-based logo',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'logo_text',
        'label'       => 'Logo Text (for text-based logos)',
        'desc'        => 'Enter some text for your logo.',
        'std'         => 'ESPRESSO',
        'type'        => 'text',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition' => 'logo_type:is(text)'
      ),
      array(
        'id'          => 'logo_typography',
        'label'       => 'Logo Typography',
        'desc'        => '',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition' => 'logo_type:is(text)'
      ),
      array(
        'id'          => 'logo_image',
        'label'       => 'Logo Image (for image-based logos)',
        'desc'        => 'Choose an image to replace your logo.',
        'std'         => get_template_directory_uri().'/images/logo.png',
        'type'        => 'upload',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => 'logo_type:is(image)',
      ),
      array(
        'id'          => 'logo_image_rt',
        'label'       => 'Retina Logo Image (for image-based logos)',
        'desc'        => 'Choose an image for Retina displays (twice the size of your standard logo image).',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => 'logo_type:is(image)',
      ),
      array(
        'id'          => 'logo_padding',
        'label'       => 'Padding around logo (top and bottom)',
        'desc'        => '',
        'std'         => 0,
        'type'        => 'select',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(
	        array(
            	'value'       => 0,
				'label'       => 'None'
			),
			array(
            	'value'       => 10,
				'label'       => '10px'
			),
			array(
            	'value'       => 20,
				'label'       => '20px'
			),
			array(
            	'value'       => 30,
				'label'       => '30px'
			),
			array(
            	'value'       => 40,
				'label'       => '40px'
			),
			array(
            	'value'       => 50,
				'label'       => '50px'
			),
			array(
            	'value'       => 60,
				'label'       => '60px'
			),
			array(
            	'value'       => 70,
				'label'       => '70px'
			),
			array(
            	'value'       => 80,
				'label'       => '80px'
			),
			array(
            	'value'       => 90,
				'label'       => '90px'
			),
			array(
            	'value'       => 100,
				'label'       => '100px'
			),
        ),
      ),
      array(
        'id'          => 'header_style',
        'label'       => 'Header Style',
        'desc'        => 'Which header style do you want to use?',
        'std'         => 'default',
        'type'        => 'radio-image',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'label'       => 'Default',
            'src'         => get_template_directory_uri().'/_theme_settings/images/header-default.jpg'
          ),
          array(
            'value'       => 'alternative',
            'label'       => 'Alternative',
            'src'         => get_template_directory_uri().'/_theme_settings/images/header-alt.jpg'
          )
        ),
      ),
      array(
        'id'          => 'address',
        'label'       => 'Address (optional)',
        'desc'        => 'Enter your address.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'phone',
        'label'       => 'Phone Number (optional)',
        'desc'        => 'Enter your phone number.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      
      array(
        'id'          => 'custom_font',
        'label'       => 'Choose a Google Font',
        'desc'        => '<a href="http://www.google.com/fonts">Check out all of the Google Fonts here</a>',
        'std'         => 'Lato',
        'type'        => 'select',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => $google_font_array
      ),
      
      array(
        'id'          => 'countdown_lang',
        'label'       => 'Event Countdown Language',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => $countdown_lang_array
      ),
      array(
        'id'          => 'blur_slider_style',
        'label'       => 'Blur Slider Options',
        'desc'        => 'On some server setups, the blur slider doesn\'t work properly. In these cases you will need to use the "Alternative" style.',
        'std'         => 'blur',
        'type'        => 'select',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(
        	array(
        		'value'=>'blur',
        		'label'=>'Blurred Image (Default)',
        		'src'=>''),
        	array(
        		'value'=>'alt',
        		'label'=>'Alternative',
        		'src'=>''))
      ),
      array(
        'id'          => 'default_page_type',
        'label'       => 'Default Sidebar Style (if nothing is chosen yet)',
        'desc'        => '',
        'std'         => 'full',
        'type'        => 'select',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(array('value'=>'full','label'=>'No Sidebar (Full Width)','src'=>''),array('value'=>'right','label'=>'Left Sidebar','src'=>''),array('value'=>'left','label'=>'Right Sidebar','src'=>''))
      ),
      array(
        'id'          => 'archive_page_type',
        'label'       => 'Archive Sidebar Style (author archive, search results, etc.)',
        'desc'        => '',
        'std'         => 'full',
        'type'        => 'select',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(array('value'=>'full','label'=>'No Sidebar (Full Width)','src'=>''),array('value'=>'right','label'=>'Left Sidebar','src'=>''),array('value'=>'left','label'=>'Right Sidebar','src'=>''))
      ),
      array(
        'id'          => 'disable_title_lines',
        'label'       => 'Page/Section Titles - Disable the Lines',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Yes, disable the lines behind the page/section titles.',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'disable_fb_black_white',
        'label'       => 'Feature Blocks - Disable the Black &amp; White Effect',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Yes, disable the black &amp; white effect on the feature block images.',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'disable_blog_black_white',
        'label'       => 'Blog Posts - Disable the Black &amp; White Effect',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Yes, disable the black &amp; white effect on the blog post images.',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hide_wc_cart',
        'label'       => 'Hide the cart in the header?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Yes, hide the cart.',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'disable_breadcrumbs',
        'label'       => 'Hide Breadcrumbs',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Yes, hide all breadcrumbs throughout the site.',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'boxed_style',
        'label'       => 'Boxed Style',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
	        'id'		  => 'boxed_style_active',
            'value'       => 'true',
            'label'       => 'Yes, apply the "boxed" style.',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'features_no_overlap',
        'label'       => 'Disable Feature Blocks Overlap',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Yes, disable the overlap style of the feature blocks.',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'sticky_navigation',
        'label'       => 'Sticky Navigation',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Yes, apply the "sticky navigation" style.',
            'src'         => ''
          )
        ),
        'condition'   => 'header_style:is(default)',
      ),
      
      array(
        'id'          => 'woo_circle_style',
        'label'       => 'WooCommerce Circle Style',
        'desc'        => 'Do you want to change the WooCommerce circles (product images, etc.) to something else?',
        'std'         => 'circles',
        'type'        => 'radio',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'circles',
            'label'       => 'Circles',
            'src'         => ''
          ),
          array(
            'value'       => 'roundedSquares',
            'label'       => 'Semi-Rounded Squares',
            'src'         => ''
          ),
          array(
            'value'       => 'sharpSquares',
            'label'       => 'Sharp Squares',
            'src'         => ''
          )
        ),
      ),
      
      
      array(
        'id'          => 'background_color',
        'label'       => 'Background Body Color (Boxed Style)',
        'desc'        => 'The default color is #fff',
        'std'         => '#fff',
        'type'        => 'colorpicker',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'background_image',
        'label'       => 'Background Image (Boxed Style)',
        'desc'        => 'Choose an image for your boxed background.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'background_image_position',
        'label'       => 'Background Image Position',
        'desc'        => '',
        'std'         => 'center top',
        'type'        => 'select',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'left top',
            'label'       => 'Left Top',
            'src'         => ''
          ),
          array(
            'value'       => 'center top',
            'label'       => 'Center Top',
            'src'         => ''
          ),
          array(
            'value'       => 'right top',
            'label'       => 'Right Top',
            'src'         => ''
          ),
          array(
            'value'       => 'left center',
            'label'       => 'Left Center',
            'src'         => ''
          ),
          array(
            'value'       => 'center center',
            'label'       => 'Center Center',
            'src'         => ''
          ),
          array(
            'value'       => 'right center',
            'label'       => 'Right Center',
            'src'         => ''
          ),
          array(
            'value'       => 'left bottom',
            'label'       => 'Left Bottom',
            'src'         => ''
          ),
          array(
            'value'       => 'center bottom',
            'label'       => 'Center Bottom',
            'src'         => ''
          ),
          array(
            'value'       => 'right bottom',
            'label'       => 'Right Bottom',
            'src'         => ''
          ),
        ),
      ),
      array(
        'id'          => 'background_image_repeat',
        'label'       => 'Background Image Repeat',
        'desc'        => '',
        'std'         => 'no-repeat',
        'type'        => 'select',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'no-repeat',
            'label'       => 'No Repeat',
            'src'         => ''
          ),
          array(
            'value'       => 'repeat',
            'label'       => 'Repeat',
            'src'         => ''
          ),
          array(
            'value'       => 'repeat-x',
            'label'       => 'Repeat X',
            'src'         => ''
          ),
          array(
            'value'       => 'repeat-y',
            'label'       => 'Repeat Y',
            'src'         => ''
          ),
        ),
      ),
      array(
        'id'          => 'background_image_attachment',
        'label'       => 'Background Image Attachment',
        'desc'        => '',
        'std'         => 'static',
        'type'        => 'select',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'static',
            'label'       => 'Static',
            'src'         => ''
          ),
          array(
            'value'       => 'fixed',
            'label'       => 'Fixed',
            'src'         => ''
          ),
        ),
      ),
      
      array(
        'id'          => 'espresso_favicon',
        'label'       => 'Favicon Replacement',
        'desc'        => 'Upload a 16x16 "ico" file to replace your Favicon. Use <a href="http://www.favicon.cc/">Favicon.cc</a> to generate one if you need to.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_styling',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      
      array(
        'id'          => 'disable_responsive',
        'label'       => 'Responsive Toggle',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'mobile_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Disable the responsiveness (Show full site on mobile)',
            'src'         => ''
          )
        ),
      ),
            
      array(
        'id'          => 'hide_on_mobile',
        'label'       => '"Hide on Mobile" Elements',
        'desc'        => 'Choose which elements you want to hide on mobile. (minimum width is set below)',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'mobile_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '#mobile-cart',
            'label'       => 'Shopping Cart (if WooCommerce enabled)',
            'src'         => ''
          ),
          array(
            'value'       => '.mobile-nav-holder',
            'label'       => 'Navigation Bar (will also hide shopping cart)',
            'src'         => ''
          ),
          array(
            'value'       => '#top .shell section.left',
            'label'       => 'Top Bar Left',
            'src'         => ''
          ),
          array(
            'value'       => '#top .shell section.right',
            'label'       => 'Top Bar Right',
            'src'         => ''
          ),
          array(
            'value'       => 'footer section.left',
            'label'       => 'Footer Left',
            'src'         => ''
          ),
          array(
            'value'       => 'footer section.right',
            'label'       => 'Footer Right',
            'src'         => ''
          ),
          array(
            'value'       => 'header#header',
            'label'       => 'Header',
            'src'         => ''
          ),
          array(
            'value'       => '#slider-wrap',
            'label'       => 'Slider',
            'src'         => ''
          ),
          array(
            'value'       => '#page-post aside',
            'label'       => 'Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => '#ctas',
            'label'       => 'Feature Blocks',
            'src'         => ''
          ),
          array(
            'value'       => '#homepage-events',
            'label'       => 'Event Block',
            'src'         => ''
          ),
          array(
            'value'       => '#homepage-countdown',
            'label'       => 'Single Event Countdown Block',
            'src'         => ''
          ),
          array(
            'value'       => '#parallax_page_section',
            'label'       => 'Parallax Block',
            'src'         => ''
          ),
          array(
            'value'       => '#homepage-recent-posts',
            'label'       => 'Recent Posts Block',
            'src'         => ''
          ),
          array(
            'value'       => '#recent-tweets',
            'label'       => 'Tweets Block',
            'src'         => ''
          ),
          array(
            'value'       => '#widget-block',
            'label'       => 'Page Widgets',
            'src'         => ''
          ),
          array(
            'value'       => '#footer-widgets',
            'label'       => 'Footer',
            'src'         => ''
          ),
        ),
      ),
      
      array(
        'id'          => 'hide_on_mobile_width',
        'label'       => '"Hide on Mobile" Width',
        'desc'        => 'The checkboxes above will hide certain elements below the width (in pixels) you choose here.',
        'std'         => '600',
        'type'        => 'numeric_slider',
        'section'     => 'mobile_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '400,1200,5',
        'class'       => ''
      ),

      
      array(
        'id'          => 'general_desc',
        'label'       => '',
        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; width: 590px; color: #2F9ACC; margin:0 0 5px !important">General Color Options</p><p style="font-size:16px; line-height:24px; margin: 0 0 -10px !important; width: 590px; color: #888;">The first two color options below are the only required colors. If you want to override any of the individual colors, you can use all of the color fields below.</p>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'main_color',
        'label'       => 'Main Color (sidebar, links, etc.)',
        'desc'        => 'The default color is #2f9acc',
        'std'         => '#2f9acc',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'dark_color',
        'label'       => 'Alternative Color (navigation, top bar, footer bar)',
        'desc'        => 'The default color is #222222',
        'std'         => '#222222',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      
      array(
        'id'          => 'override_page_colors_desc',
        'label'       => '',
        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; margin: 0 0 5px !important; width: 590px; color: #2F9ACC;">Page Text Color Options</p><p style="font-size:16px; line-height:24px; margin: 0 0 -10px !important; width: 590px; color: #888;">If you want to override any of the page/post text colors, you can use all of the color fields below.</p>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'main_font_color',
        'label'       => 'Main (on pages/posts) Text Color',
        'desc'        => 'The default color is #000',
        'std'         => '#000',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_h1_color',
        'label'       => 'H1 (Page Titles on pages/posts) Text Color',
        'desc'        => 'The default color is #000',
        'std'         => '#000',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_h2_color',
        'label'       => 'H2 (on pages/posts) Text Color',
        'desc'        => 'The default color is #000',
        'std'         => '#000',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_h3_color',
        'label'       => 'H3 (on pages/posts) Text Color',
        'desc'        => 'The default color is #2f9acc',
        'std'         => '#2f9acc',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_h4_color',
        'label'       => 'H4 (on pages/posts) Text Color',
        'desc'        => 'The default color is #000',
        'std'         => '#000',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_h5_color',
        'label'       => 'H5 (on pages/posts) Text Color',
        'desc'        => 'The default color is #000',
        'std'         => '#000',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_h6_color',
        'label'       => 'H6 (on pages/posts) Text Color',
        'desc'        => 'The default color is #aaa',
        'std'         => '#aaa',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_blockquote_color',
        'label'       => 'Blockquote (on pages/posts) Text Color',
        'desc'        => 'The default color is #aaa',
        'std'         => '#aaa',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      
      array(
        'id'          => 'override_header_desc',
        'label'       => '',
        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; margin: 0 0 5px !important; width: 590px; color: #2F9ACC;">Header Color Options</p><p style="font-size:16px; line-height:24px; margin: 0 0 -10px !important; width: 590px; color: #888;">If you want to override any of the individual header colors, you can use all of the color fields below.</p>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_header_color',
        'label'       => 'Header Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_header_background_image',
        'label'       => 'Header Background Image',
        'desc'        => 'Choose an image for your header background. It will fill the space horizontally.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_header_text',
        'label'       => 'Header Text Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_topbar_color',
        'label'       => 'Top Bar Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'header_style:is(alternative)',
      ),
      
      
      
      array(
        'id'          => 'override_nav_desc',
        'label'       => '',
        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; margin: 0 0 5px !important; width: 590px; color: #2F9ACC;">Navigation Color Options</p><p style="font-size:16px; line-height:24px; margin: 0 0 -10px !important; width: 590px; color: #888;">If you want to override any of the individual navigation colors, you can use all of the color fields below.</p>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_nav_color',
        'label'       => 'Navigation Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'header_style:is(default)',
      ),
      array(
        'id'          => 'custom_nav_text',
        'label'       => 'Navigation Text Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'header_style:is(default)',
      ),
      array(
        'id'          => 'custom_nav_hover',
        'label'       => 'Navigation Hover Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_nav_text_hover',
        'label'       => 'Navigation Hover Text Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_nav_dropdown',
        'label'       => 'Navigation Dropdown Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_nav_dropdown_text',
        'label'       => 'Navigation Dropdown Text Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'header_style:is(default)',
      ),
      array(
        'id'          => 'custom_nav_dropdown_hover',
        'label'       => 'Navigation Dropdown Hover Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_nav_dropdown_text_hover',
        'label'       => 'Navigation Dropdown Hover Text Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      
      
      array(
        'id'          => 'override_featured_desc',
        'label'       => '',
        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; margin: 0 0 5px !important; width: 590px; color: #2F9ACC;">Feature Blocks Color Options</p><p style="font-size:16px; line-height:24px; margin: 0 0 -10px !important; width: 590px; color: #888;">If you want to override any of the individual feature block colors, you can use all of the color fields below.</p>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_fb_container_bg_color',
        'label'       => 'Feature Blocks - Container Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_fb_background_image',
        'label'       => 'Feature Blocks - Container Background Image',
        'desc'        => 'Choose an image for your feature blocks container background. It will fill the space horizontally.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_fb_title_bg_color',
        'label'       => 'Feature Blocks - Title Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_fb_title_text_color',
        'label'       => 'Feature Blocks - Title Text Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_fb_button_bg_color',
        'label'       => 'Feature Blocks - Button Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_fb_button_text_color',
        'label'       => 'Feature Blocks - Button Text Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_fb_button_bg_color_hover',
        'label'       => 'Feature Blocks - Button Background Color on Hover',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_fb_button_text_color_hover',
        'label'       => 'Feature Blocks - Button Text Color on Hover',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_fb_block_bg_color',
        'label'       => 'Feature Blocks - Block Background Color (default is #ffffff)',
        'desc'        => '',
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_fb_block_text_color',
        'label'       => 'Feature Blocks - Block Text Color (default is #222222)',
        'desc'        => '',
        'std'         => '#222222',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      
      
      array(
        'id'          => 'override_tweets_desc',
        'label'       => '',
        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; margin: 0 0 5px !important; width: 590px; color: #2F9ACC;">Recent Tweets Color Options</p><p style="font-size:16px; line-height:24px; margin: 0 0 -10px !important; width: 590px; color: #888;">If you want to override any of the individual recent tweet row colors, you can use all of the color fields below.</p>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_tweets_bg_color',
        'label'       => 'Recent Tweets - Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_tweets_text_color',
        'label'       => 'Recent Tweets - Text Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      
      array(
        'id'          => 'override_footer_widget_desc',
        'label'       => '',
        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; margin: 0 0 5px !important; width: 590px; color: #2F9ACC;">Footer Widgets Color Options</p><p style="font-size:16px; line-height:24px; margin: 0 0 -10px !important; width: 590px; color: #888;">If you want to override any of the individual footer widget row colors, you can use all of the color fields below.</p>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_widget_bg_color',
        'label'       => 'Footer Widgets - Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_widget_bg_image',
        'label'       => 'Footer Widget - Background Image',
        'desc'        => 'Choose an image for your footer background. It will fill the space horizontally.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_widget_text_color',
        'label'       => 'Footer Widgets - Text Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_widget_link_color',
        'label'       => 'Footer Widgets - Link Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      
      array(
        'id'          => 'override_bottom_desc',
        'label'       => '',
        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; margin: 0 0 5px !important; width: 590px; color: #2F9ACC;">Bottom Bar Color Options</p><p style="font-size:16px; line-height:24px; margin: 0 0 -10px !important; width: 590px; color: #888;">If you want to override any of the individual bottom bar colors, you can use all of the color fields below.</p>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_bottom_bg_color',
        'label'       => 'Bottom Bar Background Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_bottom_text_color',
        'label'       => 'Bottom Bar Text Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      
      
      
      
      
      array(
        'id'          => 'js_footer_widget_layout',
        'label'       => 'Footer Widget Columns',
        'desc'        => '',
        'std'         => '3',
        'type'        => 'select',
        'section'     => 'footer_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => 'None',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'One Column',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => 'Two Columns',
            'src'         => ''
          ),
          array(
            'value'       => '3',
            'label'       => 'Three Columns',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hide_espresso_footer',
        'label'       => 'Hide the Footer Bar',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'footer_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Yes, hide the footer bar completely.',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'footer_left_content',
        'label'       => 'Left Side Content Type',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'footer_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'text',
            'label'       => 'Text',
            'src'         => ''
          ),
          array(
            'value'       => 'address_phone',
            'label'       => 'Address/Phone',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'footer_left_text',
        'label'       => 'Left Side Text (if selected)',
        'desc'        => 'Enter [year] to display the current year. HTML is also allowed.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'footer_settings',
        'rows'        => '2',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_right_content',
        'label'       => 'Right Side Content Type',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'footer_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'text',
            'label'       => 'Text',
            'src'         => ''
          ),
          array(
            'value'       => 'socials_search',
            'label'       => 'Socials/Search',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'footer_right_text',
        'label'       => 'Right Side Text (if selected)',
        'desc'        => 'Enter [year] to display the current year. HTML is also allowed.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'footer_settings',
        'rows'        => '2',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'facebook',
        'label'       => 'Facebook',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter',
        'label'       => 'Twitter',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'googleplus',
        'label'       => 'Google Plus',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'foursquare',
        'label'       => 'Foursquare',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'yelp',
        'label'       => 'Yelp',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'linkedin',
        'label'       => 'LinkedIn',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'vimeo',
        'label'       => 'Vimeo',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'flickr',
        'label'       => 'Flickr',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'youtube',
        'label'       => 'YouTube',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'instagram',
        'label'       => 'Instagram',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'tripadvisor',
        'label'       => 'Trip Advisor',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'pinterest',
        'label'       => 'Pinterest',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'feed',
        'label'       => 'RSS Feed',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'activate_search',
        'label'       => 'Activate the Search Button (next to the social icons)',
        'desc'        => '',
        'std'         => 'true',
        'type'        => 'checkbox',
        'section'     => 'social_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Yes, activate the search button.',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'instructions',
        'label'       => '',
        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; width: 590px; color: #2F9ACC; margin:0 0 5px !important">Instructions</p><p><strong>All of the Twitter functionality in this theme requires a Twitter application for communication with 3rd party sites. Here are the steps for creating and setting up a Twitter application:</strong></p>
<ol>
	<li>Go to <a href="https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a> and log in, if necessary.</li>
	<li>Supply the necessary required fields, accept the TOS, and solve the CAPTCHA. Callback URL field may be left empty.</li>
	<li>Submit the form.</li>
	<li>On the next screen scroll down to "Your access token" section and click the "Create my access token" button.</li>
	<li>Copy the following fields: <strong>Access Token</strong>, <strong>Access Token Secret</strong>, <strong>Consumer Key</strong>, <strong>Consumer Secret</strong> to the fields below.</li>
</ol>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'twitter_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter_oauth_access_token',
        'label'       => 'Twitter Oauth Access Token',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'twitter_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter_oauth_access_token_secret',
        'label'       => 'Twitter Oauth Access Token Secret',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'twitter_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter_consumer_key',
        'label'       => 'Twitter Consumer Key',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'twitter_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter_consumer_secret',
        'label'       => 'Twitter Consumer Secret',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'twitter_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'instructions',
        'label'       => '',
        'desc'        => '<p style="font-weight:bold; font-size:20px; line-height:30px; width: 590px; color: #2F9ACC; margin:0 0 5px !important">Instructions</p><p><strong>All of the Facebook functionality in this theme requires a Facebook application for communication with 3rd party sites. Here are the steps for creating and setting up a Facebook application:</strong></p>
<ol>
	<li>Go to <a href="https://developers.facebook.com/apps/?action=create">https://developers.facebook.com/apps/?action=create</a> and log in, if necessary.</li>
	<li>Supply the necessary required fields, and solve the CAPTCHA.</li>
	<li>Submit the form.</li>
	<li>On the next screen scroll down to "Your access token" section and click the "Create my access token" button.</li>
	<li>Copy the <strong>App ID</strong> and <strong>App Secret Secret</strong> to the fields below.</li>
</ol>',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'facebook_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'facebook_app_id',
        'label'       => 'Facebook App ID',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'facebook_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'facebook_app_secret',
        'label'       => 'Facebook App Secret',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'facebook_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'js_404_content',
        'label'       => '404 Page Content',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'miscellaneous',
        'rows'        => '4',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'espresso_google_analytics',
        'label'       => 'Google Analytics Code',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'miscellaneous',
        'rows'        => '4',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'espresso_custom_css',
        'label'       => 'Custom CSS',
        'desc'        => '',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'miscellaneous',
        'rows'        => '4',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'js_disable_page_comments',
        'label'       => 'Disable the Page Comments?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'miscellaneous',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'js_disable_post_comments',
        'label'       => 'Disable the Post Comments?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'miscellaneous',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}