<?php

add_action('admin_enqueue_scripts',	'basil_admin_enqueues' );
function basil_admin_enqueues(){

	$template_dir = get_template_directory_uri();
	
	wp_enqueue_style( 'admin_styling', $template_dir . '/css/admin_styles.css', array(), '1.0', 'all' );
	//wp_enqueue_script( 'admin_scripts', $template_dir . '/js/admin-functions.js' , array('jquery'), '1.0', true );
	
}

add_action('admin_init', 'basil_theme_options');
function basil_theme_options() {
	
	/**
	 * Get a copy of the saved settings array. 
	 */
	$saved_settings = get_option( ot_settings_id(), array() );
	
	$google_fonts = 'ABeeZee+++Abel+++Abril Fatface+++Aclonica+++Acme+++Actor+++Adamina+++Advent Pro+++Aguafina Script+++Akronim+++Aladin+++Aldrich+++Alef+++Alegreya+++Alegreya SC+++Alegreya Sans+++Alegreya Sans SC+++Alex Brush+++Alfa Slab One+++Alice+++Alike+++Alike Angular+++Allan+++Allerta+++Allerta Stencil+++Allura+++Almendra+++Almendra Display+++Almendra SC+++Amarante+++Amaranth+++Amatic SC+++Amethysta+++Anaheim+++Andada+++Andika+++Angkor+++Annie Use Your Telescope+++Anonymous Pro+++Antic+++Antic Didone+++Antic Slab+++Anton+++Arapey+++Arbutus+++Arbutus Slab+++Architects Daughter+++Archivo Black+++Archivo Narrow+++Arimo+++Arizonia+++Armata+++Artifika+++Arvo+++Asap+++Asset+++Astloch+++Asul+++Atomic Age+++Aubrey+++Audiowide+++Autour One+++Average+++Average Sans+++Averia Gruesa Libre+++Averia Libre+++Averia Sans Libre+++Averia Serif Libre+++Bad Script+++Balthazar+++Bangers+++Basic+++Battambang+++Baumans+++Bayon+++Belgrano+++Belleza+++BenchNine+++Bentham+++Berkshire Swash+++Bevan+++Bigelow Rules+++Bigshot One+++Bilbo+++Bilbo Swash Caps+++Bitter+++Black Ops One+++Bokor+++Bonbon+++Boogaloo+++Bowlby One+++Bowlby One SC+++Brawler+++Bree Serif+++Bubblegum Sans+++Bubbler One+++Buda+++Buenard+++Butcherman+++Butterfly Kids+++Cabin+++Cabin Condensed+++Cabin Sketch+++Caesar Dressing+++Cagliostro+++Calligraffitti+++Cambo+++Candal+++Cantarell+++Cantata One+++Cantora One+++Capriola+++Cardo+++Carme+++Carrois Gothic+++Carrois Gothic SC+++Carter One+++Caudex+++Cedarville Cursive+++Ceviche One+++Changa One+++Chango+++Chau Philomene One+++Chela One+++Chelsea Market+++Chenla+++Cherry Cream Soda+++Cherry Swash+++Chewy+++Chicle+++Chivo+++Cinzel+++Cinzel Decorative+++Clicker Script+++Coda+++Coda Caption+++Codystar+++Combo+++Comfortaa+++Coming Soon+++Concert One+++Condiment+++Content+++Contrail One+++Convergence+++Cookie+++Copse+++Corben+++Courgette+++Cousine+++Coustard+++Covered By Your Grace+++Crafty Girls+++Creepster+++Crete Round+++Crimson Text+++Croissant One+++Crushed+++Cuprum+++Cutive+++Cutive Mono+++Damion+++Dancing Script+++Dangrek+++Dawning of a New Day+++Days One+++Delius+++Delius Swash Caps+++Delius Unicase+++Della Respira+++Denk One+++Devonshire+++Didact Gothic+++Diplomata+++Diplomata SC+++Domine+++Donegal One+++Doppio One+++Dorsa+++Dosis+++Dr Sugiyama+++Droid Sans+++Droid Sans Mono+++Droid Serif+++Duru Sans+++Dynalight+++EB Garamond+++Eagle Lake+++Eater+++Economica+++Electrolize+++Elsie+++Elsie Swash Caps+++Emblema One+++Emilys Candy+++Engagement+++Englebert+++Enriqueta+++Erica One+++Esteban+++Euphoria Script+++Ewert+++Exo+++Exo 2+++Expletus Sans+++Fanwood Text+++Fascinate+++Fascinate Inline+++Faster One+++Fasthand+++Fauna One+++Federant+++Federo+++Felipa+++Fenix+++Finger Paint+++Fjalla One+++Fjord One+++Flamenco+++Flavors+++Fondamento+++Fontdiner Swanky+++Forum+++Francois One+++Freckle Face+++Fredericka the Great+++Fredoka One+++Freehand+++Fresca+++Frijole+++Fruktur+++Fugaz One+++GFS Didot+++GFS Neohellenic+++Gabriela+++Gafata+++Galdeano+++Galindo+++Gentium Basic+++Gentium Book Basic+++Geo+++Geostar+++Geostar Fill+++Germania One+++Gilda Display+++Give You Glory+++Glass Antiqua+++Glegoo+++Gloria Hallelujah+++Goblin One+++Gochi Hand+++Gorditas+++Goudy Bookletter 1911+++Graduate+++Grand Hotel+++Gravitas One+++Great Vibes+++Griffy+++Gruppo+++Gudea+++Habibi+++Hammersmith One+++Hanalei+++Hanalei Fill+++Handlee+++Hanuman+++Happy Monkey+++Headland One+++Henny Penny+++Herr Von Muellerhoff+++Holtwood One SC+++Homemade Apple+++Homenaje+++IM Fell DW Pica+++IM Fell DW Pica SC+++IM Fell Double Pica+++IM Fell Double Pica SC+++IM Fell English+++IM Fell English SC+++IM Fell French Canon+++IM Fell French Canon SC+++IM Fell Great Primer+++IM Fell Great Primer SC+++Iceberg+++Iceland+++Imprima+++Inconsolata+++Inder+++Indie Flower+++Inika+++Irish Grover+++Istok Web+++Italiana+++Italianno+++Jacques Francois+++Jacques Francois Shadow+++Jim Nightshade+++Jockey One+++Jolly Lodger+++Josefin Sans+++Josefin Slab+++Joti One+++Judson+++Julee+++Julius Sans One+++Junge+++Jura+++Just Another Hand+++Just Me Again Down Here+++Kameron+++Kantumruy+++Karla+++Kaushan Script+++Kavoon+++Kdam Thmor+++Keania One+++Kelly Slab+++Kenia+++Khmer+++Kite One+++Knewave+++Kotta One+++Koulen+++Kranky+++Kreon+++Kristi+++Krona One+++La Belle Aurore+++Lancelot+++Lato+++League Script+++Leckerli One+++Ledger+++Lekton+++Lemon+++Libre Baskerville+++Life Savers+++Lilita One+++Lily Script One+++Limelight+++Linden Hill+++Lobster+++Lobster Two+++Londrina Outline+++Londrina Shadow+++Londrina Sketch+++Londrina Solid+++Lora+++Love Ya Like A Sister+++Loved by the King+++Lovers Quarrel+++Luckiest Guy+++Lusitana+++Lustria+++Macondo+++Macondo Swash Caps+++Magra+++Maiden Orange+++Mako+++Marcellus+++Marcellus SC+++Marck Script+++Margarine+++Marko One+++Marmelad+++Marvel+++Mate+++Mate SC+++Maven Pro+++McLaren+++Meddon+++MedievalSharp+++Medula One+++Megrim+++Meie Script+++Merienda+++Merienda One+++Merriweather+++Merriweather Sans+++Metal+++Metal Mania+++Metamorphous+++Metrophobic+++Michroma+++Milonga+++Miltonian+++Miltonian Tattoo+++Miniver+++Miss Fajardose+++Modern Antiqua+++Molengo+++Molle+++Monda+++Monofett+++Monoton+++Monsieur La Doulaise+++Montaga+++Montez+++Montserrat+++Montserrat Alternates+++Montserrat Subrayada+++Moul+++Moulpali+++Mountains of Christmas+++Mouse Memoirs+++Mr Bedfort+++Mr Dafoe+++Mr De Haviland+++Mrs Saint Delafield+++Mrs Sheppards+++Muli+++Mystery Quest+++Neucha+++Neuton+++New Rocker+++News Cycle+++Niconne+++Nixie One+++Nobile+++Nokora+++Norican+++Nosifer+++Nothing You Could Do+++Noticia Text+++Noto Sans+++Noto Serif+++Nova Cut+++Nova Flat+++Nova Mono+++Nova Oval+++Nova Round+++Nova Script+++Nova Slim+++Nova Square+++Numans+++Nunito+++Odor Mean Chey+++Offside+++Old Standard TT+++Oldenburg+++Oleo Script+++Oleo Script Swash Caps+++Open Sans+++Open Sans Condensed+++Oranienbaum+++Orbitron+++Oregano+++Orienta+++Original Surfer+++Oswald+++Over the Rainbow+++Overlock+++Overlock SC+++Ovo+++Oxygen+++Oxygen Mono+++PT Mono+++PT Sans+++PT Sans Caption+++PT Sans Narrow+++PT Serif+++PT Serif Caption+++Pacifico+++Paprika+++Parisienne+++Passero One+++Passion One+++Pathway Gothic One+++Patrick Hand+++Patrick Hand SC+++Patua One+++Paytone One+++Peralta+++Permanent Marker+++Petit Formal Script+++Petrona+++Philosopher+++Piedra+++Pinyon Script+++Pirata One+++Plaster+++Play+++Playball+++Playfair Display+++Playfair Display SC+++Podkova+++Poiret One+++Poller One+++Poly+++Pompiere+++Pontano Sans+++Port Lligat Sans+++Port Lligat Slab+++Prata+++Preahvihear+++Press Start 2P+++Princess Sofia+++Prociono+++Prosto One+++Puritan+++Purple Purse+++Quando+++Quantico+++Quattrocento+++Quattrocento Sans+++Questrial+++Quicksand+++Quintessential+++Qwigley+++Racing Sans One+++Radley+++Raleway+++Raleway Dots+++Rambla+++Rammetto One+++Ranchers+++Rancho+++Rationale+++Redressed+++Reenie Beanie+++Revalia+++Ribeye+++Ribeye Marrow+++Righteous+++Risque+++Roboto+++Roboto Condensed+++Roboto Slab+++Rochester+++Rock Salt+++Rokkitt+++Romanesco+++Ropa Sans+++Rosario+++Rosarivo+++Rouge Script+++Ruda+++Rufina+++Ruge Boogie+++Ruluko+++Rum Raisin+++Ruslan Display+++Russo One+++Ruthie+++Rye+++Sacramento+++Sail+++Salsa+++Sanchez+++Sancreek+++Sansita One+++Sarina+++Satisfy+++Scada+++Schoolbell+++Seaweed Script+++Sevillana+++Seymour One+++Shadows Into Light+++Shadows Into Light Two+++Shanti+++Share+++Share Tech+++Share Tech Mono+++Shojumaru+++Short Stack+++Siemreap+++Sigmar One+++Signika+++Signika Negative+++Simonetta+++Sintony+++Sirin Stencil+++Six Caps+++Skranji+++Slackey+++Smokum+++Smythe+++Sniglet+++Snippet+++Snowburst One+++Sofadi One+++Sofia+++Sonsie One+++Sorts Mill Goudy+++Source Code Pro+++Source Sans Pro+++Special Elite+++Spicy Rice+++Spinnaker+++Spirax+++Squada One+++Stalemate+++Stalinist One+++Stardos Stencil+++Stint Ultra Condensed+++Stint Ultra Expanded+++Stoke+++Strait+++Sue Ellen Francisco+++Sunshiney+++Supermercado One+++Suwannaphum+++Swanky and Moo Moo+++Syncopate+++Tangerine+++Taprom+++Tauri+++Telex+++Tenor Sans+++Text Me One+++The Girl Next Door+++Tienne+++Tinos+++Titan One+++Titillium Web+++Trade Winds+++Trocchi+++Trochut+++Trykker+++Tulpen One+++Ubuntu+++Ubuntu Condensed+++Ubuntu Mono+++Ultra+++Uncial Antiqua+++Underdog+++Unica One+++UnifrakturCook+++UnifrakturMaguntia+++Unkempt+++Unlock+++Unna+++VT323+++Vampiro One+++Varela+++Varela Round+++Vast Shadow+++Vibur+++Vidaloka+++Viga+++Voces+++Volkhov+++Vollkorn+++Voltaire+++Waiting for the Sunrise+++Wallpoet+++Walter Turncoat+++Warnes+++Wellfleet+++Wendy One+++Wire One+++Yanone Kaffeesatz+++Yellowtail+++Yeseva One+++Yesteryear+++Zeyada';
	$google_fonts = explode('+++',$google_fonts);
	foreach($google_fonts as $font_name){  
		$google_font_array[] = array('value' => str_replace(' ','+',$font_name), 'label' => $font_name, 'src' => '');
	}
	
	if (class_exists('cooked_plugin')):
		$header_right_choices[] = array('id' => 'profile','label' => __('Display the &ldquo;Profile/Log Out&rdquo; Buttons', 'basil'),'value' => 'profile');
		$header_right_choices[] = array('id' => 'button','label' => __('Display the &ldquo;Recipe Browser&rdquo; Button', 'basil'),'value' => 'button');
	endif;
	$header_right_choices[] = array('id' => 'text','label' => __('Display Text', 'basil'),'value' => 'text');
  
	/**
	 * Custom settings array that will eventually be 
	 * passes to the OptionTree Settings API Class.
	 */
	$theme_options_settings = array(
		'sections' => array(
			array( # General
				'id'    => 'to_general',
				'title' => __('General', 'basil'),
			),
			array( # Header
				'id'    => 'to_header',
				'title' => __('Header', 'basil'),
			),
			array( # Colors
				'id'    => 'to_formatting',
				'title' => __('Formatting', 'basil'),
			),
			array( # Colors
				'id'    => 'to_colors',
				'title' => __('Colors', 'basil'),
			),
			array( # Socials
				'id'    => 'to_socials',
				'title' => __('Socials', 'basil'),
			),
			array( # Footer
				'id'    => 'to_footer',
				'title' => __('Footer', 'basil'),
			),
			array( # Twitter
				'id'    => 'to_twitter',
				'title' => __('Twitter', 'basil'),
			),
			array( # Facebook
				'id'    => 'to_facebook',
				'title' => __('Facebook', 'basil'),
			),
			array( # Misc
				'id'    => 'to_misc',
				'title' => __('Miscellaneous', 'basil'),
			)
		),
		'settings' => array_merge(
			array(
				/**
				 * General
				 */
				array( # Favicon
					'id'    => 'to_general_favicon',
					'label' => __('Upload Favicon', 'basil'),
					'type'  => 'upload',
					'std'	=> '',
					'class'   => 'ot-upload-attachment-id',
					'section' => 'to_general',
				),
				array( # Layout Style
					'id'          => 'to_layout_style',
					'label'       => 'Layout Style',
					'std'         => 'full',
					'type'        => 'select',
					'section'     => 'to_general',
					'choices'     => array(
						array(
							'id'    => 'full',
							'label' => __('Full Width', 'basil'),
							'value' => 'full',
						),
						array(
							'id'    => 'boxed',
							'label' => __('Boxed', 'basil'),
							'value' => 'boxed',
						),
					)
				),
				array( # WooCommerce Products Per Page
					'id'          => 'to_wc_products_per_page',
					'label'       => 'WooCommerce Products Per Page',
					'std'         => 8,
					'type'        => 'select',
					'section'     => 'to_general',
					'choices'     => array(
						array(
							'id'    => '3',
							'label' => '3',
							'value' => 3,
						),
						array(
							'id'    => '4',
							'label' => '4',
							'value' => 4,
						),
						array(
							'id'    => '5',
							'label' => '5',
							'value' => 5,
						),
						array(
							'id'    => '6',
							'label' => '6',
							'value' => 6,
						),
						array(
							'id'    => '7',
							'label' => '7',
							'value' => 7,
						),
						array(
							'id'    => '8',
							'label' => '8',
							'value' => 8,
						),
						array(
							'id'    => '9',
							'label' => '9',
							'value' => 9,
						),
						array(
							'id'    => '10',
							'label' => '10',
							'value' => 10,
						),
						array(
							'id'    => '11',
							'label' => '11',
							'value' => 11,
						),
						array(
							'id'    => '12',
							'label' => '12',
							'value' => 12,
						),
						array(
							'id'    => '13',
							'label' => '13',
							'value' => 13,
						),
						array(
							'id'    => '14',
							'label' => '14',
							'value' => 14,
						),
						array(
							'id'    => '15',
							'label' => '15',
							'value' => 15,
						),
						array(
							'id'    => '16',
							'label' => '16',
							'value' => 16,
						),
						array(
							'id'    => '17',
							'label' => '17',
							'value' => 17,
						),
						array(
							'id'    => '18',
							'label' => '18',
							'value' => 18,
						),
						array(
							'id'    => '19',
							'label' => '19',
							'value' => 19,
						),
						array(
							'id'    => '20',
							'label' => '20',
							'value' => 20,
						),
						array(
							'id'    => '21',
							'label' => '21',
							'value' => 21,
						),
						array(
							'id'    => '22',
							'label' => '22',
							'value' => 22,
						),
						array(
							'id'    => '23',
							'label' => '23',
							'value' => 23,
						),
						array(
							'id'    => '24',
							'label' => '24',
							'value' => 24,
						),
						array(
							'id'    => '25',
							'label' => '25',
							'value' => 25,
						),
						array(
							'id'    => '26',
							'label' => '26',
							'value' => 26,
						),
						array(
							'id'    => '27',
							'label' => '27',
							'value' => 27,
						),
						array(
							'id'    => '28',
							'label' => '28',
							'value' => 28,
						),
						array(
							'id'    => '29',
							'label' => '29',
							'value' => 29,
						),
						array(
							'id'    => '30',
							'label' => '30',
							'value' => 30,
						),
						array(
							'id'    => '31',
							'label' => '31',
							'value' => 31,
						),
						array(
							'id'    => '32',
							'label' => '32',
							'value' => 32,
						),
					)
				),
				array( # Disable Post Meta
					'id'          => 'to_disable_post_meta',
					'label'       => 'Disable Post Meta (date, author, categories, tags, comment count, etc.)',
					'std'         => 'no',
					'type'        => 'select',
					'section'     => 'to_general',
					'choices'     => array(
						array(
							'id'    => 'yes',
							'label' => __('Yes', 'basil'),
							'value' => 'yes',
						),
						array(
							'id'    => 'no',
							'label' => __('No', 'basil'),
							'value' => 'no',
						),
					)
				),
				array( # Disable Post Comments
					'id'          => 'to_disable_post_comments',
					'label'       => 'Disable Post Comments',
					'std'         => 'no',
					'type'        => 'select',
					'section'     => 'to_general',
					'choices'     => array(
						array(
							'id'    => 'yes',
							'label' => __('Yes', 'basil'),
							'value' => 'yes',
						),
						array(
							'id'    => 'no',
							'label' => __('No', 'basil'),
							'value' => 'no',
						),
					)
				),
				array( # Disable Page Comments
					'id'          => 'to_disable_page_comments',
					'label'       => 'Disable Page Comments',
					'std'         => 'yes',
					'type'        => 'select',
					'section'     => 'to_general',
					'choices'     => array(
						array(
							'id'    => 'yes',
							'label' => __('Yes', 'basil'),
							'value' => 'yes',
						),
						array(
							'id'    => 'no',
							'label' => __('No', 'basil'),
							'value' => 'no',
						),
					)
				),
				array(
					'id'          => 'to_general_blog_style',
					'label'       => 'Blog Style',
					'desc'        => 'You can choose between a standard Post List view or a trendy Post Panels view.',
					'std'         => 'List',
					'type'        => 'select',
					'section'     => 'to_general',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'choices'     => array(
						array(
							'id'    => 'list',
							'label' => __('Post List', 'basil'),
							'value' => 'List',
						),
						array(
							'id'    => 'panels',
							'label' => __('Post Panels', 'basil'),
							'value' => 'Panels',
						),
					)
				),
				
			),

			# Socials
			basil_get_ot_to_socials(),

			array(
				/**
				 * Header
				 */
				array( # Header Style
					'id'          => 'to_header_style',
					'label'       => 'Homepage Header Style',
					'std'         => 'full',
					'type'        => 'select',
					'section'     => 'to_header',
					'choices'     => array(
						array(
							'id'    => 'full',
							'label' => __('Full Width', 'basil'),
							'value' => 'full',
						),
						array(
							'id'    => 'floating',
							'label' => __('Floating', 'basil'),
							'value' => 'floating',
						),
					)
				),
				array( # Header Logo
					'id'      => 'to_header_logo',
					'label'   => __('Logo', 'basil'),
					'desc'    => wpautop(
						__(
							'Here you can choose a logo that will be displayed in the header on all pages. <strong>Keep it at or under 300 x 90 pixels for best results.</strong>',
							'basil'
						)
					),
					'type'    => 'upload',
					'std'	  => '',
					'section' => 'to_header',
					'class'   => 'ot-upload-attachment-id',
				),
				
				array( # Header Retina Logo
					'id'      => 'to_header_logo_rt',
					'label'   => __('Retina Logo', 'basil'),
					'desc'    => wpautop(
						__(
							'Upload a logo to be used for Retina displays. Be sure to upload a logo that is twice the size of your normal logo for best results.',
							'basil'
						)
					),
					'type'    => 'upload',
					'std'	  => '',
					'section' => 'to_header',
					'class'   => 'ot-upload-attachment-id',
				),
				
				array( # Header Height
					'id'      => 'to_header_height',
					'label'   => __('Header Height', 'basil'),
					'desc'	  => 'Your logo and right text/button will be centered vertically.',
					'std'     => '120',
					'min_max_step' => '100,300,1',
					'type'    => 'numeric-slider',
					'section' => 'to_header',
				),
				array( # Header Top Right Content
					'id'      => 'to_header_top_right',
					'label'   => __('Header Top Right', 'basil'),
					'std'     => 'text',
					'type'    => 'radio',
					'section' => 'to_header',
					'choices' => $header_right_choices
				),
				array( # Header Bottom Left Text
					'id'        => 'to_header_top_right_text',
					'label'     => __('Header Top Right Text', 'basil'),
					'std'     	=> '',
					'type'      => 'text',
					'section'   => 'to_header',
					'condition' => 'to_header_top_right:is(text)',
					'operator'  => 'and',
				),
				array( # Navigation Bar Right Content
					'id'      => 'to_nav_bar_right',
					'label'   => __('Navigation Bar Right Content', 'basil'),
					'std'     => 'socials',
					'type'    => 'radio',
					'section' => 'to_header',
					'choices' => array(
						array(
							'id'    => 'socials',
							'label' => __('Display Socials', 'basil'),
							'value' => 'socials',
						),
						array(
							'id'    => 'search',
							'label' => __('Display Search', 'basil'),
							'value' => 'search',
						),
						array(
							'id'    => 'recipe-search',
							'label' => __('Display Recipe Search', 'basil'),
							'value' => 'recipe-search',
						),
						array(
							'id'    => 'text',
							'label' => __('Display Text', 'basil'),
							'value' => 'text',
						),
					),
				),
				array( # Header Bottom Right Text
					'id'        => 'to_nav_bar_right_text',
					'label'     => __('Navigation Bar Right Text', 'basil'),
					'type'      => 'text',
					'section'   => 'to_header',
					'condition' => 'to_nav_bar_right:is(text)',
					'operator'  => 'and',
				),

				/**
				 * Footer Tab Fields
				 */
				array( # Footer Bottom Left Content
					'id'      => 'to_footer_bottom_left',
					'label'   => __('Footer Bottom Left', 'basil'),
					'std'     => 'text',
					'type'    => 'radio',
					'section' => 'to_footer',
					'choices' => array(
						array(
							'id'    => 'text',
							'label' => __('Display Text', 'basil'),
							'value' => 'text',
						),
						array(
							'id'    => 'socials',
							'label' => __('Display Socials', 'basil'),
							'value' => 'socials',
						),
					),
				),
				array( # Footer Bottom Left Text
					'id'        => 'to_footer_bottom_left_text',
					'label'     => __('Footer Bottom Left Text', 'basil'),
					'std'     	=> '',
					'desc'  	=> 'You can use the [year] shortcode to display the current year.',
					'type'      => 'text',
					'section'   => 'to_footer',
					'condition' => 'to_footer_bottom_left:is(text)',
					'operator'  => 'and',
				),
				array( # Footer Bottom Right Content
					'id'      => 'to_footer_bottom_right',
					'label'   => __('Footer Bottom Right', 'basil'),
					'std'     => 'text',
					'type'    => 'radio',
					'section' => 'to_footer',
					'choices' => array(
						array(
							'id'    => 'text',
							'label' => __('Display Text', 'basil'),
							'value' => 'text',
						),
						array(
							'id'    => 'socials',
							'label' => __('Display Socials', 'basil'),
							'value' => 'socials',
						),
					),
				),
				array( # Footer Bottom Right Text
					'id'        => 'to_footer_bottom_right_text',
					'label'     => __('Footer Bottom Right Text', 'basil'),
					'type'      => 'text',
					'desc'  	=> 'You can use the [year] shortcode to display the current year.',
					'std'     	=> 'Bottom right text',
					'section'   => 'to_footer',
					'condition' => 'to_footer_bottom_right:is(text)',
					'operator'  => 'and',
				),
			),
			
			array(
				array(
					'id'          => 'to_general_custom_font',
					'label'       => 'Default Font',
					'desc'        => '<a href="http://www.google.com/fonts">Check out all of the Google Fonts here</a>',
					'std'         => 'Lato',
					'type'        => 'select',
					'section'     => 'to_formatting',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'choices'     => $google_font_array
				),
				array(
					'id'          => 'to_defaut_formatting_style',
					'label'       => 'Default Formatting',
					'desc'        => 'This applies to Paragraphs, Lists, Comments, etc.',
					'type'        => 'typography',
					'std'		  => array(
										'font-color' => '#555555',
										'font-size' => '15px',
										'font-style' => 'normal',
										'font-weight' => 'normal',
										'letter-spacing' => '0em',
										'line-height' => '24px',
										'text-decoration' => 'none',
										'text-transform' => 'none',
									 ),
					'section'     => 'to_formatting',
				),
				array(
					'id'          => 'to_h1_custom_font',
					'label'       => 'H1 Font',
					'desc'        => '',
					'std'         => 'Lato',
					'type'        => 'select',
					'section'     => 'to_formatting',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'choices'     => $google_font_array
				),
				array(
					'id'          => 'to_h1_formatting_style',
					'label'       => 'H1 Formatting',
					'desc'        => '',
					'type'        => 'typography',
					'std'		  => array(
										'font-color' => '#555555',
										'font-size' => '35px',
										'font-style' => 'normal',
										'font-weight' => '400',
										'letter-spacing' => '0em',
										'line-height' => '45px',
										'text-decoration' => 'none',
										'text-transform' => 'none',
									 ),
					'section'     => 'to_formatting',
				),
				array(
					'id'          => 'to_h2_custom_font',
					'label'       => 'H2 Font',
					'desc'        => '',
					'std'         => 'Lato',
					'type'        => 'select',
					'section'     => 'to_formatting',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'choices'     => $google_font_array
				),
				array(
					'id'          => 'to_h2_formatting_style',
					'label'       => 'H2 Formatting',
					'desc'        => '',
					'type'        => 'typography',
					'std'		  => array(
										'font-color' => '#555555',
										'font-size' => '25px',
										'font-style' => 'normal',
										'font-weight' => '300',
										'letter-spacing' => '0em',
										'line-height' => '35px',
										'text-decoration' => 'none',
										'text-transform' => 'uppercase',
									 ),
					'section'     => 'to_formatting',
				),
				array(
					'id'          => 'to_h3_custom_font',
					'label'       => 'H3 Font',
					'desc'        => '',
					'std'         => 'Lato',
					'type'        => 'select',
					'section'     => 'to_formatting',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'choices'     => $google_font_array
				),
				array(
					'id'          => 'to_h3_formatting_style',
					'label'       => 'H3 Formatting',
					'desc'        => '',
					'type'        => 'typography',
					'std'		  => array(
										'font-color' => '#555555',
										'font-size' => '20px',
										'font-style' => 'normal',
										'font-weight' => '400',
										'letter-spacing' => '0em',
										'line-height' => '30px',
										'text-decoration' => 'none',
										'text-transform' => 'none',
									 ),
					'section'     => 'to_formatting',
				),
				array(
					'id'          => 'to_h4_custom_font',
					'label'       => 'H4 Font',
					'desc'        => '',
					'std'         => 'Lato',
					'type'        => 'select',
					'section'     => 'to_formatting',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'choices'     => $google_font_array
				),
				array(
					'id'          => 'to_h4_formatting_style',
					'label'       => 'H4 Formatting',
					'desc'        => '',
					'type'        => 'typography',
					'std'		  => array(
										'font-color' => '#555555',
										'font-size' => '17px',
										'font-style' => 'normal',
										'font-weight' => '600',
										'letter-spacing' => '0em',
										'line-height' => '27px',
										'text-decoration' => 'none',
										'text-transform' => 'none',
									 ),
					'section'     => 'to_formatting',
				),
				array(
					'id'          => 'to_h5_custom_font',
					'label'       => 'H5 Font',
					'desc'        => '',
					'std'         => 'Lato',
					'type'        => 'select',
					'section'     => 'to_formatting',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'choices'     => $google_font_array
				),
				array(
					'id'          => 'to_h5_formatting_style',
					'label'       => 'H5 Formatting',
					'desc'        => '',
					'type'        => 'typography',
					'std'		  => array(
										'font-color' => '#555555',
										'font-size' => '13px',
										'font-style' => 'normal',
										'font-weight' => '400',
										'letter-spacing' => '0em',
										'line-height' => '18px',
										'text-decoration' => 'none',
										'text-transform' => 'none',
									 ),
					'section'     => 'to_formatting',
				),
				array(
					'id'          => 'to_h6_custom_font',
					'label'       => 'H6 Font',
					'desc'        => '',
					'std'         => 'Lato',
					'type'        => 'select',
					'section'     => 'to_formatting',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'choices'     => $google_font_array
				),
				array(
					'id'          => 'to_h6_formatting_style',
					'label'       => 'H6 Formatting',
					'desc'        => '',
					'type'        => 'typography',
					'std'		  => array(
										'font-color' => '#555555',
										'font-size' => '11px',
										'font-style' => 'normal',
										'font-weight' => '400',
										'letter-spacing' => '0em',
										'line-height' => '16px',
										'text-decoration' => 'none',
										'text-transform' => 'none',
									 ),
					'section'     => 'to_formatting',
				),
			),
			
			array(
				array( # Disable Post Comments
					'id'          => 'to_disable_responsive',
					'label'       => 'Disable Responsiveness',
					'std'         => 'no',
					'type'        => 'select',
					'section'     => 'to_colors',
					'choices'     => array(
						array(
							'id'    => 'yes',
							'label' => __('Yes', 'basil'),
							'value' => 'yes',
						),
						array(
							'id'    => 'no',
							'label' => __('No', 'basil'),
							'value' => 'no',
						),
					)
				),
				array(
					'id'    => 'to_color_body_bg_color',
					'type'  => 'colorpicker',
					'label' => __('Body Background (for boxed layout)', 'basil'),
					'std'	=> '#000000',
					'section' => 'to_colors',
				),
				array(
					'id'    => 'to_color_body_bg_image',
					'type'  => 'upload',
					'label' => __('Body Background Image (for boxed layout)', 'basil'),
					'std'	=> '',
					'section' => 'to_colors',
				),
				array( # Background Image Attachment
					'id'          => 'to_color_body_bg_position',
					'label'       => 'Body Background Image Position',
					'std'         => 'top center',
					'type'        => 'select',
					'section' => 'to_colors',
					'choices'     => array(
						array(
							'id'    => 'top_left',
							'label' => __('Top Left', 'basil'),
							'value' => 'top left',
						),
						array(
							'id'    => 'top_center',
							'label' => __('Top Center', 'basil'),
							'value' => 'top center',
						),
						array(
							'id'    => 'top_right',
							'label' => __('Top Right', 'basil'),
							'value' => 'top right',
						),
						array(
							'id'    => 'center_center',
							'label' => __('Center Center', 'basil'),
							'value' => 'center center',
						),
						array(
							'id'    => 'bottom_left',
							'label' => __('Bottom Left', 'basil'),
							'value' => 'bottom left',
						),
						array(
							'id'    => 'bottom_center',
							'label' => __('Bottom Center', 'basil'),
							'value' => 'bottom center',
						),
						array(
							'id'    => 'bottom_right',
							'label' => __('Bottom Right', 'basil'),
							'value' => 'bottom right',
						),
					)
				),
				array( # Background Image Repeat
					'id'          => 'to_color_body_bg_repeat',
					'label'       => 'Body Background Image Repeat',
					'std'         => 'no-repeat',
					'type'        => 'select',
					'section' => 'to_colors',
					'choices'     => array(
						array(
							'id'    => 'no_repeat',
							'label' => __('No Repeat', 'basil'),
							'value' => 'no-repeat',
						),
						array(
							'id'    => 'repeat',
							'label' => __('Repeat', 'basil'),
							'value' => 'repeat',
						),
						array(
							'id'    => 'repeat_x',
							'label' => __('Repeat X', 'basil'),
							'value' => 'repeat-x',
						),
						array(
							'id'    => 'repeat_y',
							'label' => __('Repeat Y', 'basil'),
							'value' => 'repeat-y',
						),
					)
				),
				array( # Background Image FIxed
					'id'          => 'to_color_body_bg_fixed',
					'label'       => 'Body Background Fixed Image?',
					'std'         => 'scroll',
					'type'        => 'select',
					'section' 	  => 'to_colors',
					'choices'     => array(
						array(
							'id'    => 'static',
							'label' => __('Not Fixed', 'basil'),
							'value' => 'scroll',
						),
						array(
							'id'    => 'fixed',
							'label' => __('Fixed', 'basil'),
							'value' => 'fixed',
						),
					)
				),
				
			),
			
			# Colors
			basil_get_to_color_options(),

			# Twitter
			array(
				array(
					'id'    => 'textblock',
					'label' => '',
					'desc'  => '<div id="ot-instructions-wrapper"><p style="font-weight:600; font-size:17px; line-height:1.7; width:100%; color: #0085BA; margin:0 0 10px !important">Instructions</p><p><strong>The Twitter API requires an application for communication with 3rd party sites. Here are the steps for creating and setting up a Twitter application:</strong></p>
<ol>
	<li>Go to <a href="https://dev.twitter.com/apps/new" target="_blank">https://dev.twitter.com/apps/new</a> and log in, if necessary</li>
	<li>Supply the necessary required fields, accept the Terms of Service, and solve the CAPTCHA. Callback URL field may be left empty</li>
	<li>Submit the form</li>
	<li>On the next screen scroll down to <strong>Your access token</strong> section and click the <strong>Create my access token</strong> button</li>
	<li>Copy the following fields: Access token, Access token secret, Consumer key, Consumer secret to the below fields</li>
</ol></div>',
					'type' => 'textblock',
					'section' => 'to_twitter',
				),
				array(
					'id'    => 'twitter_oauth_access_token',
					'label' => __('Twitter OAuth Access Token', 'basil'),
					'type'  => 'text',
					'section' => 'to_twitter',
				),
				array(
					'id'    => 'twitter_oauth_access_token_secret',
					'label' => __('Twitter OAuth Access Token Secret', 'basil'),
					'type'  => 'text',
					'section' => 'to_twitter',
				),
				array(
					'id'    => 'twitter_consumer_key',
					'label' => __('Twitter Consumer Key', 'basil'),
					'type'  => 'text',
					'section' => 'to_twitter',
				),
				array(
					'id'    => 'twitter_consumer_secret',
					'label' => __('Twitter Consumer Secret', 'basil'),
					'type'  => 'text',
					'section' => 'to_twitter',
				)
			),

			# Facebook
			array(
				array(
		        'id'          => 'instructions',
		        'label'       => '',
		        'desc'        => '<div id="ot-instructions-wrapper"><p style="font-weight:600; font-size:17px; line-height:1.7; width:100%; color: #0085BA; margin:0 0 10px !important">Instructions</p><p><strong>The Facebook API requires an application for communication with 3rd party sites. Here are the steps for creating and setting up a Facebook application:</strong></p>
<ol>
	<li><a target="_blank" href="https://developers.facebook.com/apps/">' . __('Click here', 'basil') . '</a> ' . __('to create a new Facebook app.', 'basil') . '</li>
	<li>' . __('Click the green <strong>+ Create new app</strong> button at the top right.', 'basil') . '</li>
	<li>' . __('In the popup window, enter a <em>Display Name</em> and choose a <em>Category</em>. Then click <strong>Create App</strong>.', 'basil') . '</li>
	<li>' . __('Fill in the required captcha and click <strong>Submit</strong>.', 'basil') . '</li>
	<li>' . __('On the next page, click the <strong>Settings</strong> tab on the left.', 'basil') . '</li>
	<li>' . __('Click the <strong>+ Add Platform</strong> button under the fields.', 'basil') . '</li>
	<li>' . __('Choose <em>Website</em> and enter the URL of the website where Cooked is installed. Click <strong>Save Changes</strong>.', 'basil') . '</li>
	<li>' . __('Enter the same URL in the <em>App Domains</em> field above. Click <strong>Save Changes</strong> again.', 'basil') . '</li>
	<li>' . __('Now you can copy and paste the <em>App ID</em> at the top into the field on this page.', 'basil') . '</li>
</ol></div>',
		        'std'         => '',
		        'type'        => 'textblock-titled',
		        'section'     => 'to_facebook',
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
		        'section'     => 'to_facebook',
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
		        'section'     => 'to_facebook',
		        'rows'        => '',
		        'post_type'   => '',
		        'taxonomy'    => '',
		        'min_max_step'=> '',
		        'class'       => ''
		      ),
			),

			/* Miscellaneous */
			array(
				
				array( # Custom CSS
			        'id'          => 'to_basil_custom_css',
			        'label'       => __('Custom CSS','basil'),
			        'desc'        => '',
			        'std'         => '',
			        'type'        => 'css',
			        'section'     => 'to_misc',
			        'rows'        => '10',
			        'post_type'   => '',
			        'taxonomy'    => '',
			        'min_max_step'=> '',
					'class'       => ''
			    ),
			    array( # Google Analytics
			        'id'          => 'to_basil_google_analytics',
			        'label'       => __('Google Analytics Code','basil'),
			        'desc'        => '',
			        'std'         => '',
			        'type'        => 'textarea-simple',
			        'section'     => 'to_misc',
			        'rows'        => '6',
			        'post_type'   => '',
			        'taxonomy'    => '',
			        'min_max_step'=> '',
			        'class'       => ''
			    ),
			    array( # 404 Page Content
			        'id'          => 'to_basil_404_content',
			        'label'       => __('404 Page Content','basil'),
			        'desc'        => '',
			        'std'         => '',
			        'type'        => 'textarea',
			        'section'     => 'to_misc',
			        'rows'        => '9',
			        'post_type'   => '',
			        'taxonomy'    => '',
			        'min_max_step'=> '',
			        'class'       => ''
				),
			    
				
				/*array( # Mobile Settings
				'id'      => 'to_hidden_mobile_elements',
				'label'   => __('Hide Elements on Mobile (small devices)', 'basil'),
				'std'     => '',
				'type'    => 'checkbox',
				'section' => 'to_misc',
				'choices' => array(
					array(
						'id'    => 'hide_top_bar_left',
						'label' => __('Hide Top Bar - Left', 'basil'),
						'value' => true,
					),
					array(
						'id'    => 'hide_top_bar_right',
						'label' => __('Hide Top Bar - Right', 'basil'),
						'value' => true,
					),
					array(
						'id'    => 'hide_bottom_bar_left',
						'label' => __('Hide Bottom Bar - left', 'basil'),
						'value' => true,
					),
					array(
						'id'    => 'hide_bottom_bar_right',
						'label' => __('Hide Bottom Bar - Right', 'basil'),
						'value' => true,
					),
					array(
						'id'    => 'hide_banner',
						'label' => __('Hide Banner', 'basil'),
						'value' => true,
					),
				)
			)*/
		)
	));
	
	
  
  /* allow settings to be filtered before saving */
  $theme_options_settings = apply_filters( ot_settings_id() . '_args', $theme_options_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $theme_options_settings ) {
	update_option( ot_settings_id(), $theme_options_settings ); 
  }
  
}