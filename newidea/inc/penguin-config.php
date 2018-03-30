<?php
/**
 * Penguin Framework Config for penguin framework.
 *
 * @package Penguin
 * @version 6.0
 */
	global $google_fonts, $options_custom_color;
	
	require_once("penguin/penguin.php");
	require_once("penguin/penguin-functions.php");
	
	$dir = get_template_directory_uri();
	
	/**
	 * Google Web Font now 676
	 * http://www.google.com/webfonts
	 * <link href='http://fonts.googleapis.com/css?family=...'rel='stylesheet' type='text/css'>
	 */
	$google_fonts =  'ABeeZee|Abel|Abril+Fatface|Aclonica|Acme|Actor|Adamina|Advent+Pro|Aguafina+Script|Akronim|Aladin|Aldrich|Alef|Alegreya|Alegreya+SC|Alegreya+Sans|Alegreya+Sans+SC|Alex+Brush|Alfa+Slab+One|Alice|Alike|Alike+Angular|Allan|Allerta|Allerta+Stencil|Allura|Almendra|Almendra+Display|Almendra+SC|Amarante|Amaranth|Amatic+SC|Amethysta|Amiri|Amita|Anaheim|Andada|Andika|Angkor|Annie+Use+Your+Telescope|Anonymous+Pro|Antic|Antic+Didone|Antic+Slab|Anton|Arapey|Arbutus|Arbutus+Slab|Architects+Daughter|Archivo+Black|Archivo+Narrow|Arimo|Arizonia|Armata|Artifika|Arvo|Arya|Asap|Asar|Asset|Astloch|Asul|Atomic+Age|Aubrey|Audiowide|Autour+One|Average|Average+Sans|Averia+Gruesa+Libre|Averia+Libre|Averia+Sans+Libre|Averia+Serif+Libre|Bad+Script|Balthazar|Bangers|Basic|Battambang|Baumans|Bayon|Belgrano|Belleza|BenchNine|Bentham|Berkshire+Swash|Bevan|Bigelow+Rules|Bigshot+One|Bilbo|Bilbo+Swash+Caps|Biryani|Bitter|Black+Ops+One|Bokor|Bonbon|Boogaloo|Bowlby+One|Bowlby+One+SC|Brawler|Bree+Serif|Bubblegum+Sans|Bubbler+One|Buda|Buenard|Butcherman|Butterfly+Kids|Cabin|Cabin+Condensed|Cabin+Sketch|Caesar+Dressing|Cagliostro|Calligraffitti|Cambay|Cambo|Candal|Cantarell|Cantata+One|Cantora+One|Capriola|Cardo|Carme|Carrois+Gothic|Carrois+Gothic+SC|Carter+One|Caudex|Cedarville+Cursive|Ceviche+One|Changa+One|Chango|Chau+Philomene+One|Chela+One|Chelsea+Market|Chenla|Cherry+Cream+Soda|Cherry+Swash|Chewy|Chicle|Chivo|Cinzel|Cinzel+Decorative|Clicker+Script|Coda|Coda+Caption|Codystar|Combo|Comfortaa|Coming+Soon|Concert+One|Condiment|Content|Contrail+One|Convergence|Cookie|Copse|Corben|Courgette|Cousine|Coustard|Covered+By+Your+Grace|Crafty+Girls|Creepster|Crete+Round|Crimson+Text|Croissant+One|Crushed|Cuprum|Cutive|Cutive+Mono|Damion|Dancing+Script|Dangrek|Dawning+of+a+New+Day|Days+One|Dekko|Delius|Delius+Swash+Caps|Delius+Unicase|Della+Respira|Denk+One|Devonshire|Dhurjati|Didact+Gothic|Diplomata|Diplomata+SC|Domine|Donegal+One|Doppio+One|Dorsa|Dosis|Dr+Sugiyama|Droid+Sans|Droid+Sans+Mono|Droid+Serif|Duru+Sans|Dynalight|EB+Garamond|Eagle+Lake|Eater|Economica|Eczar|Ek+Mukta|Electrolize|Elsie|Elsie+Swash+Caps|Emblema+One|Emilys+Candy|Engagement|Englebert|Enriqueta|Erica+One|Esteban|Euphoria+Script|Ewert|Exo|Exo+2|Expletus+Sans|Fanwood+Text|Fascinate|Fascinate+Inline|Faster+One|Fasthand|Fauna+One|Federant|Federo|Felipa|Fenix|Finger+Paint|Fira+Mono|Fira+Sans|Fjalla+One|Fjord+One|Flamenco|Flavors|Fondamento|Fontdiner+Swanky|Forum|Francois+One|Freckle+Face|Fredericka+the+Great|Fredoka+One|Freehand|Fresca|Frijole|Fruktur|Fugaz+One|GFS+Didot|GFS+Neohellenic|Gabriela|Gafata|Galdeano|Galindo|Gentium+Basic|Gentium+Book+Basic|Geo|Geostar|Geostar+Fill|Germania+One|Gidugu|Gilda+Display|Give+You+Glory|Glass+Antiqua|Glegoo|Gloria+Hallelujah|Goblin+One|Gochi+Hand|Gorditas|Goudy+Bookletter+1911|Graduate|Grand+Hotel|Gravitas+One|Great+Vibes|Griffy|Gruppo|Gudea|Gurajada|Habibi|Halant|Hammersmith+One|Hanalei|Hanalei+Fill|Handlee|Hanuman|Happy+Monkey|Headland+One|Henny+Penny|Herr+Von+Muellerhoff|Hind|Holtwood+One+SC|Homemade+Apple|Homenaje|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Iceberg|Iceland|Imprima|Inconsolata|Inder|Indie+Flower|Inika|Inknut+Antiqua|Irish+Grover|Istok+Web|Italiana|Italianno|Jacques+Francois|Jacques+Francois+Shadow|Jaldi|Jim+Nightshade|Jockey+One|Jolly+Lodger|Josefin+Sans|Josefin+Slab|Joti+One|Judson|Julee|Julius+Sans+One|Junge|Jura|Just+Another+Hand|Just+Me+Again+Down+Here|Kadwa|Kalam|Kameron|Kantumruy|Karla|Karma|Kaushan+Script|Kavoon|Kdam+Thmor|Keania+One|Kelly+Slab|Kenia|Khand|Khmer|Khula|Kite+One|Knewave|Kotta+One|Koulen|Kranky|Kreon|Kristi|Krona+One|Kurale|La+Belle+Aurore|Laila|Lakki+Reddy|Lancelot|Lateef|Lato|League+Script|Leckerli+One|Ledger|Lekton|Lemon|Libre+Baskerville|Life+Savers|Lilita+One|Lily+Script+One|Limelight|Linden+Hill|Lobster|Lobster+Two|Londrina+Outline|Londrina+Shadow|Londrina+Sketch|Londrina+Solid|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Lovers+Quarrel|Luckiest+Guy|Lusitana|Lustria|Macondo|Macondo+Swash+Caps|Magra|Maiden+Orange|Mako|Mallanna|Mandali|Marcellus|Marcellus+SC|Marck+Script|Margarine|Marko+One|Marmelad|Martel|Martel+Sans|Marvel|Mate|Mate+SC|Maven+Pro|McLaren|Meddon|MedievalSharp|Medula+One|Megrim|Meie+Script|Merienda|Merienda+One|Merriweather|Merriweather+Sans|Metal|Metal+Mania|Metamorphous|Metrophobic|Michroma|Milonga|Miltonian|Miltonian+Tattoo|Miniver|Miss+Fajardose|Modak|Modern+Antiqua|Molengo|Molle|Monda|Monofett|Monoton|Monsieur+La+Doulaise|Montaga|Montez|Montserrat|Montserrat+Alternates|Montserrat+Subrayada|Moul|Moulpali|Mountains+of+Christmas|Mouse+Memoirs|Mr+Bedfort|Mr+Dafoe|Mr+De+Haviland|Mrs+Saint+Delafield|Mrs+Sheppards|Muli|Mystery+Quest|NTR|Neucha|Neuton|New+Rocker|News+Cycle|Niconne|Nixie+One|Nobile|Nokora|Norican|Nosifer|Nothing+You+Could+Do|Noticia+Text|Noto+Sans|Noto+Serif|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Numans|Nunito|Odor+Mean+Chey|Offside|Old+Standard+TT|Oldenburg|Oleo+Script|Oleo+Script+Swash+Caps|Open+Sans|Open+Sans+Condensed|Oranienbaum|Orbitron|Oregano|Orienta|Original+Surfer|Oswald|Over+the+Rainbow|Overlock|Overlock+SC|Ovo|Oxygen|Oxygen+Mono|PT+Mono|PT+Sans|PT+Sans+Caption|PT+Sans+Narrow|PT+Serif|PT+Serif+Caption|Pacifico|Palanquin|Palanquin+Dark|Paprika|Parisienne|Passero+One|Passion+One|Pathway+Gothic+One|Patrick+Hand|Patrick+Hand+SC|Patua+One|Paytone+One|Peddana|Peralta|Permanent+Marker|Petit+Formal+Script|Petrona|Philosopher|Piedra|Pinyon+Script|Pirata+One|Plaster|Play|Playball|Playfair+Display|Playfair+Display+SC|Podkova|Poiret+One|Poller+One|Poly|Pompiere|Pontano+Sans|Poppins|Port+Lligat+Sans|Port+Lligat+Slab|Pragati+Narrow|Prata|Preahvihear|Press+Start+2P|Princess+Sofia|Prociono|Prosto+One|Puritan|Purple+Purse|Quando|Quantico|Quattrocento|Quattrocento+Sans|Questrial|Quicksand|Quintessential|Qwigley|Racing+Sans+One|Radley|Rajdhani|Raleway|Raleway+Dots|Ramabhadra|Ramaraja|Rambla|Rammetto+One|Ranchers|Rancho|Ranga|Rationale|Ravi+Prakash|Redressed|Reenie+Beanie|Revalia|Rhodium+Libre|Ribeye|Ribeye+Marrow|Righteous|Risque|Roboto|Roboto+Condensed|Roboto+Mono|Roboto+Slab|Rochester|Rock+Salt|Rokkitt|Romanesco|Ropa+Sans|Rosario|Rosarivo|Rouge+Script|Rozha+One|Rubik+Mono+One|Rubik+One|Ruda|Rufina|Ruge+Boogie|Ruluko|Rum+Raisin|Ruslan+Display|Russo+One|Ruthie|Rye|Sacramento|Sahitya|Sail|Salsa|Sanchez|Sancreek|Sansita+One|Sarala|Sarina|Sarpanch|Satisfy|Scada|Scheherazade|Schoolbell|Seaweed+Script|Sevillana|Seymour+One|Shadows+Into+Light|Shadows+Into+Light+Two|Shanti|Share|Share+Tech|Share+Tech+Mono|Shojumaru|Short+Stack|Siemreap|Sigmar+One|Signika|Signika+Negative|Simonetta|Sintony|Sirin+Stencil|Six+Caps|Skranji|Slabo+13px|Slabo+27px|Slackey|Smokum|Smythe|Sniglet|Snippet|Snowburst+One|Sofadi+One|Sofia|Sonsie+One|Sorts+Mill+Goudy|Source+Code+Pro|Source+Sans+Pro|Source+Serif+Pro|Special+Elite|Spicy+Rice|Spinnaker|Spirax|Squada+One|Sree+Krushnadevaraya|Stalemate|Stalinist+One|Stardos+Stencil|Stint+Ultra+Condensed|Stint+Ultra+Expanded|Stoke|Strait|Sue+Ellen+Francisco|Sumana|Sunshiney|Supermercado+One|Sura|Suranna|Suravaram|Suwannaphum|Swanky+and+Moo+Moo|Syncopate|Tangerine|Taprom|Tauri|Teko|Telex|Tenali+Ramakrishna|Tenor+Sans|Text+Me+One|The+Girl+Next+Door|Tienne|Tillana|Timmana|Tinos|Titan+One|Titillium+Web|Trade+Winds|Trocchi|Trochut|Trykker|Tulpen+One|Ubuntu|Ubuntu+Condensed|Ubuntu+Mono|Ultra|Uncial+Antiqua|Underdog|Unica+One|UnifrakturCook|UnifrakturMaguntia|Unkempt|Unlock|Unna|VT323|Vampiro+One|Varela|Varela+Round|Vast+Shadow|Vesper+Libre|Vibur|Vidaloka|Viga|Voces|Volkhov|Vollkorn|Voltaire|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Warnes|Wellfleet|Wendy+One|Wire+One|Yanone+Kaffeesatz|Yantramanav|Yellowtail|Yeseva+One|Yesteryear|Zeyada';
                     
	/**
	 * Option page content
	 */
	$page_content = array();
	
	/* General Page */
	$page_content[] = array(
			'section' 	=> 'general',
			'icon'		=> 'fa-cog',
			'name' => __('General','newidea'),
			'title' => __('General Setting','newidea'),
			'elements'	=> array(
					'theme_update'		=> array(
					'title' => __('Theme License Information &amp; Auto Update Setting','newidea'),
					'type' 	=> 'moreline',
					'moreline'	=> array(
						'envato_name'		=> array(
								'name'	=> __('Username','newidea'),
								'type'	=>	'input',
								'property'	=> 'theme-name',
								'desc'	=> __('Envato market username.','newidea')
							),
						'envato_purchase_code'		=> array(
								'name'	=> __('Purchase Code','newidea'),
								'type'	=>	'input',
								'property'	=> 'theme-purchase-code',
								'desc'	=> __('Download License Certificate will find Item Purchase Code.','newidea')
							),
						'envato_api'		=> array(
								'name'	=> __('Envato API','newidea'),
								'type'	=>	'input',
								'property'	=> 'theme-api',
								'desc'	=> __('To obtain your API Key, visit "My Settings" page on any of the Envato Marketplaces.','newidea')
							),
						'enable_auto'	=>	array(
								'name'	=> __('Theme Auto Update','newidea'),
								'type'	=>	'pc',
								'desc' => __('Turn on auto update when have new version.','newidea'),
								'property'	=> 'theme-update-enable'
							),
					)
				),
			'favicon'		=> array(
					'name'	=> __('Favicon','newidea'),
					'title'	=> __('Favicon','newidea'),
					'type'	=>	'upload',
					'property'	=> 'favicon',
					'show_thums'	=> 'yes'
				),
			'home_default_background'	=> array(
					'title'	=> __('Default Background Image','newidea'),
					'type'	=>	'moreline',
					'moreline'	=> array(
							'home-default-background' => array(
									'name'	=> __('Background image','newidea'),
									'type' 	=> 'upload',
									'property' => 'home-default-background',
									'show_thums'	=> 'yes',
									),
							'home-default-mobile-background' => array(
									'name'	=> __('Mobile Background image','newidea'),
									'type' 	=> 'upload',
									'property' => 'home-mobile-background',
									'show_thums'	=> 'yes',
									),
							'home-background-alpha' => array(
									'name'	=> __('Background Image Alpha','newidea'),
									'type' 	=> 'number',
									'property' => 'home-background-alpha',
									'desc' => __('0-100 for all background alpha','newidea'),
									),
							'home-background-overlay' => array(
									'name'	=> __('Background Image Overlay','newidea'),
									'type' 	=> 'radio_custom',
									'radios'	=> array(
											'radios_0' => '<div style="min-width:370px;margin-bottom:10px;" >'.__('No Overlay','newidea').'</div>',
											'radios_1' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/01.png'.');" ></div>'),
											'radios_2' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/02.png'.');" ></div>'),
											'radios_3' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/03.png'.');" ></div>'),
											'radios_4' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/04.png'.');" ></div>'),
											'radios_5' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/05.png'.');" ></div>'),
											'radios_6' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/06.png'.');" ></div>'),
											'radios_7' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/07.png'.');" ></div>'),
											'radios_8' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/08.png'.');" ></div>'),
											'radios_9' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/09.png'.');" ></div>'),
											'radios_10' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/10.png'.');" ></div>'),
											'radios_11' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/11.png'.');" ></div>'),
											'radios_12' => ('<div style="width:30px;height:20px;margin-bottom:5px;background:url('.$dir.'/js/vegas/overlays/12.png'.');" ></div>'),
										),
									'property' => 'home-background-overlay',
									'desc' => __('Background image overlay ','newidea'),
									),
								'home-background-overlay-alpha' => array(
									'name'	=> __('Background Overlay Image Alpha','newidea'),
									'type' 	=> 'number',
									'property' => 'home-background-overlay-alpha',
									'desc' => __('0-100 for background overlay alpha','newidea'),
									),
						)
		),
			'responsive'		=> array(
					'name'	=> __('Menus Title Of Bottom','newidea'),
					'title'	=> __('Responsive Setting (Mobile Phone)','newidea'),
					'type'	=>	'input',
					'property'	=> 'mobile-menu-title'
				),
			'emable_news_category'		=> array(
					'name'	=> __('News Category Show','newidea'),
					'title'	=> __('Enable News Category Show','newidea'),
					'type'	=>	'pc',
					'property'	=> 'news-show-category',
					'desc'	=> __('Check here enable show news category','newidea'),
				),
			'copyright'		=> array(
					'name'	=> __('Footer Copyright Setting','newidea'),
					'title'	=> __('Footer Copyright Setting','newidea'),
					'type'	=>	'textarea',
					'property'	=> 'footer-copyright-text',
				),
			'google_analytics'		=> array(
					'title'	=> __('Google Analytics','newidea'),
					'type'	=>	'moreline',
					'moreline'	=> array(
							'position' => array(
								'name'	=> __('Script position','newidea'),
								'type' 	=> 'radio',
								'property' => 'google_analytics-position',
								'radios'	=> array(
										'radios_1' => __('Header','newidea'),
										'radios_2' => __('Footer','newidea')
									)
								
								),
							'scripts' => array(
								'name'	=> __('Analytics script','newidea'),
								'type' 	=> 'textarea',
								'property' => 'google_analytics-content',
								'desc'	=> __('Paste your Google Analytics or other tracking code here.','newidea')
								)	
						)
				)
			)
		);
	
	/* Layout Page */
	$page_content[] = array(
			'section' => 'layout',
			'icon'	=> 'fa-tasks',
			'name' => __('Layout','newidea'),
			'title' => __('Layout Setting','newidea'),
			'elements'	=> array(
				'logo_custom'	=> array(
						'title' => __('Custom Logo','newidea'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
								'logo_image'	=> array(
									'name'	=> __('Logo Image URL','newidea'),
									'type' 	=> 'upload',
									'property' => 'logo-image',
									'show_thums'	=> 'yes'
									),
								'logo_image_width' => array(
									'name'	=> __('Logo Image Width','newidea'),
									'type' 	=> 'number',
									'property' => 'logo-image-width',
									'after'	=>	'px',
									),
								'logo_image_height' => array(
									'name'	=> __('Logo Image Height','newidea'),
									'type' 	=> 'number',
									'property' => 'logo-image-height',
									'after'	=>	'px',
									),
								'logo_image_position'	 => array(
									'name'	=> __('Logo Image Position','newidea'),
									'type' 	=> 'radio',
									'property' => 'logo-image-position',
									'radios'	=> array(
											'radios_1' => __('Top','newidea'),
											'radios_2' => __('Bottom','newidea')
										)
									),
								'logo_image_align'	 => array(
									'name'	=> __('Logo Image Align','newidea'),
									'type' 	=> 'radio',
									'property' => 'logo-image-align',
									'radios'	=> array(
											'radios_1' => __('Left','newidea'),
											'radios_2' => __('Center','newidea'),
											'radios_3' => __('Right','newidea'),
										)
									),
								'logo_padding_top' => array(
									'name'	=> __('Logo Padding From Top','newidea'),
									'type' 	=> 'number',
									'property' => 'logo-padding-top',
									'after'	=>	'px',
									),
								'logo_padding_left' => array(
									'name'	=> __('Logo Padding From Left','newidea'),
									'type' 	=> 'number',
									'property' => 'logo-padding-left',
									'after'	=>	'px',
									)
							)
					),
				'menu_custom'	=> array(
						'title' => __('Custom Menu','newidea'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
								'menu_image_position'	 => array(
									'name'	=> __('Menu Image Position','newidea'),
									'type' 	=> 'radio',
									'property' => 'menu-position',
									'radios'	=> array(
											'radios_1' => __('Top','newidea'),
											'radios_2' => __('Bottom','newidea')
										)
									),
								'menu_image_align'	 => array(
									'name'	=> __('Menu Image Align','newidea'),
									'type' 	=> 'radio',
									'property' => 'menu-align',
									'radios'	=> array(
											'radios_1' => __('Left','newidea'),
											'radios_2' => __('Center','newidea'),
											'radios_3' => __('Right','newidea'),
										)
									),
								'menu_padding_top' => array(
									'name'	=> __('Menu Padding From Top','newidea'),
									'type' 	=> 'number',
									'property' => 'menu-padding-top',
									'after'	=>	'px',
									),
								'menu_padding_left' => array(
									'name'	=> __('Menu Padding From Left','newidea'),
									'type' 	=> 'number',
									'property' => 'menu-padding-left',
									'after'	=>	'px',
									),
							)
					),
				'header'		=> array(
						'title' => __('Header','newidea'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
								'header_height' => array(
										'name'	=> __('Area Height','newidea'),
										'type'	=>	'number',
										'property'	=> 'header-height',
										'after'	=> 	'px'
									),
								'header_enable_background' => array(
										'name'	=> __('Enabled Background','newidea'),
										'type'	=>	'pc',
										'property'	=> 'header-enable-bg',
										'desc'	=> 	__('Visible background color or image!','newidea')
									),
								'header-background-alpha' => array(
										'name'	=> __('Background Alpha','newidea'),
										'type' 	=> 'number',
										'property' => 'header-background-alpha',
										'desc' => __('0-100 for all background alpha','newidea')
										),
								'header_color' => array(
									'name'	=> __('background Color','newidea'),
									'type' 	=> 'color',
									'property' => 'header-bg-color',
									'desc'	=> 'Header area background color'
									),
								'header_bg_image'		=> array(
										'name'	=> __('Background Image','newidea'),
										'type'	=>	'upload',
										'property'	=> 'header-bg-image',
										'show_thums'	=> 'yes'
									)
							)
					),
				'footer'		=> array(
						'title' => __('Footer Setting','newidea'),
						'type' 	=> 'moreline',
						'moreline'	=> array(
								'footer_height' => array(
										'name'	=> __('Area Height','newidea'),
										'type'	=>	'number',
										'property'	=> 'footer-height',
										'after'	=> 	'px'
									),
								'footer_enable_background' => array(
										'name'	=> __('Enabled Background','newidea'),
										'type'	=>	'pc',
										'property'	=> 'footer-enable-bg',
										'desc'	=> 	__('Visible background color or image!','newidea')
									),
								'footer_background_alpha' => array(
										'name'	=> __('Background Alpha','newidea'),
										'type' 	=> 'number',
										'property' => 'footer-background-alpha',
										'desc' => __('0-100 for all background alpha','newidea'),
										),
								'footer_color' => array(
									'name'	=> __('Background Color','newidea'),
									'type' 	=> 'color',
									'property' => 'footer-bg-color',
									'desc'	=> __('Footer area background color','newidea')
									),
								'footer_bg' => array(
										'name'	=> __('Background Image','newidea'),
										'type'	=>	'upload',
										'property'	=> 'footer-bg-image',
										'show_thums'	=> 'yes'
									),
							)
					),
			)
		);
	
	/* Custom Fonts */
	$page_content[] = array(
			'section' => 'font',
			'icon'	=>	'fa-text-width',
			'name' => __('Font','newidea'),
			'title' => __('Font Setting','newidea'),
			'elements'	=> array(
					'font_setting'	=> array(
						'title'	=> __('Theme Font Setting','newidea'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'general_font' => array(
									'name'	=> __('General Font','newidea'),
									'type' 	=> 'select',
									'property' => 'custom-general-font',
									'default_option'	=> 'Default: Helvetica Neue',
									'option_array'	=> $google_fonts,
									'desc'	=> __('Now have 676+ Google web font for u choose!<Br />Font sylte preview : http://google.com/webfonts','newidea')
									),
								'general_font_size' => array(
									'name'	=> __('General Font Size','newidea'),
									'type' 	=> 'number',
									'property' => 'custom-general-font-size',
									'after'	=>	'px',
									),
								'menu_font' => array(
									'name'	=> __('Menu Font','newidea'),
									'type' 	=> 'select',
									'property' => 'menu-font',
									'default_option'	=> 'Default: Ropa Sans',
									'option_array'	=> $google_fonts,
									),
								'menu_font_size' => array(
									'name'	=> __('Menu Size','newidea'),
									'type' 	=> 'number',
									'property' => 'menu-font-size',
									'after'	=>	'px',
									),
								'title_font' => array(
									'name'	=> __('Title (h1-h6) Font','newidea'),
									'type' 	=> 'select',
									'property' => 'custom-title-font',
									'default_option'	=> 'Default: Ropa Sans',
									'option_array'	=> $google_fonts
									),
								'footer_copyright_font' => array(
									'name'	=> __('Footer Copyright Font','newidea'),
									'type' 	=> 'select',
									'property' => 'footer-copyright-font',
									'default_option'	=> 'Default: Helvetica',
									'option_array'	=> $google_fonts,
									),
								'footer_copyright_font_size' => array(
									'name'	=> __('Footer Copyright Font Size','newidea'),
									'type' 	=> 'number',
									'property' => 'footer-copyright-font-size',
									'after'	=>	'px',
									)
							)
					),
				)
			);
	
	/* Custom Colors */
	$page_content[] = array(
			'section' => 'color',
			'icon'	=>	'fa-magic',
			'name' => __('Color','newidea'),
			'title' => __('Color Setting','newidea'),
			'elements'	=> array(
					'menu_color'		=> array(
						'title'	=> __('Menu Colors Setting','newidea'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'top_menu_text_color' => array(
									'name'	=> __('Text color','newidea'),
									'type' 	=> 'color',
									'property' => 'menu-color',
									'desc'	=> __('Menu color','newidea')
									),
								'top_menu_text_over_color' => array(
									'name'	=> __('Over Color','newidea'),
									'type' 	=> 'color',
									'property' => 'menu-over-color',
									'desc'	=> __('Menu text hover color','newidea')
									),
								'top_menu_text_active_color' => array(
									'name'	=> __('Active Color','newidea'),
									'type' 	=> 'color',
									'property' => 'menu-active-color',
									'desc'	=> __('Menu text active color','newidea')
									),
								'menu_bg_color' => array(
									'name'	=> __('Menu Hover Background Color','newidea'),
									'type' 	=> 'color',
									'property' => 'menu-bg-color',
									'desc'	=> __('Menu hover background color','newidea')
									),
								'menu_active_bg_color' => array(
									'name'	=> __('Menu Active Background Color','newidea'),
									'type' 	=> 'color',
									'property' => 'menu-active-bg-color',
									'desc'	=> __('Menu active background color','newidea')
									),
								'menu_area_bg_color' => array(
									'name'	=> __('Menu Area Background Color','newidea'),
									'type' 	=> 'color',
									'property' => 'menu-area-bg-color',
									'desc'	=> __('Menu Area background color','newidea')
									)
									
									
							)
						),
					'theme_color'		=> array(
						'title'	=> __('Theme Colors Setting','newidea'),
						'type'	=>	'moreline',
						'enabled-id'		=> 'pe_custom_color',
						'enable-group'	=> 'pe_custom_color_group',
						'moreline'	=> array(
								'theme_color' => array(
									'name'	=> __('Theme Color','newidea'),
									'type' 	=> 'color',
									'property' => 'theme-color'
									),
								'theme_background_color' => array(
									'name'	=> __('Theme Background Color','newidea'),
									'type' 	=> 'color',
									'property' => 'theme-bg-color',
									'desc'	=> __('Theme default background color','newidea')
									),
								'general_text_color' => array(
									'name'	=> __('General Text Color','newidea'),
									'type' 	=> 'color',
									'property' => 'custom-general-color',
									'desc'	=> __('General default text color for div,p,span,a color','newidea')
									),
								'links_color' => array(
									'name'	=> __('Links Color','newidea'),
									'type' 	=> 'color',
									'property' => 'custom-links-color',
									'desc'	=> __('Links color like a tag','newidea')
									),
								'links_hover_color' => array(
									'name'	=> __('Links Hover Color','newidea'),
									'type' 	=> 'color',
									'property' => 'custom-links-hover-color',
									'desc'	=> __('Links hover color like a tag','newidea')
									),
								'h_color' => array(
									'name'	=> __('H1-H6 Title Color','newidea'),
									'type' 	=> 'color',
									'property' => 'custom-title-color',
									'desc'	=> __('h1,h2,h3,h4,h5,h6 defalut color','newidea')
									),
								'theme_border_color' => array(
									'name'	=> __('Border Color','newidea'),
									'type' 	=> 'color',
									'property' => 'theme-border-color',
									'desc'	=> __('When what element use the color for element border','newidea')
									),
								'theme_border_over_color' => array(
									'name'	=> __('Border Over Color','newidea'),
									'type' 	=> 'color',
									'property' => 'theme-border-over-color',
									'desc'	=> __('When what element use the color for element border','newidea')
									),
								'theme_scroll_color' => array(
									'name'	=> __('Scroll Bar Color','newidea'),
									'type' 	=> 'color',
									'property' => 'custom-scroll-color',
									'desc'	=> __('Default scroll bar color','newidea')
									),
								'theme_scroll_over_color' => array(
									'name'	=> __('Scroll Bar Bg Color','newidea'),
									'type' 	=> 'color',
									'property' => 'custom-scroll-bg-color',
									'desc'	=> __('Default scroll bar bg color','newidea')
									),
								),
						)
			)
		);
		
	/* Custom CSS */
	$page_content[] = array(
			'section' => 'css',
			'icon'	=>	'fa-css3',
			'name' => __('CSS','newidea'),
			'title' => __('Custom CSS Setting','newidea'),
			'elements'	=> array(
					'css_setting'	=> array(
						'title'	=> __('CSS Setting','newidea'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'custom_css' => array(
									'name'	=> __('Custom CSS','newidea'),
									'title'	=> __('Custom CSS','newidea'),
									'type' 	=> 'textarea',
									'codetype' 	=> 'css',
									'property' => 'custom-css-content',
									'desc'	=>	__('Please enter css format content as your custom css','newidea')
									),
								'custom_mobile_css' => array(
									'name'	=> __('Responsive Mobile Phone Custom CSS','newidea'),
									'title'	=> __('Responsive Mobile CSS','newidea'),
									'type' 	=> 'textarea',
									'codetype' 	=> 'css',
									'property' => 'custom-mobile-css-content',
									'desc'	=>	__('Please enter css format content as your custom css','newidea')
									)
							)
							
						)
					)
			);
	
	/* Custom Scripts */
	$page_content[] = array(
			'section' => 'scripts',
			'icon'	=>	'fa-code',
			'name' => __('Scripts','newidea'),
			'title' => __('Custom Scripts Setting','newidea'),
			'elements'	=> array(
			'enable_custom_scripts'		=> array(
						'title'	=> __('Enable Custom Scripts','newidea'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'custom_scripts' => array(
									'name'	=> __('Custom Scripts','newidea'),
									'type' 	=> 'textarea',
									'codetype' 	=> 'javascript',
									'property' => 'custom-scripts-content',
									)
							)
						)
					)
			);
			
	/* Social Page */			
	$page_content[] = array(
			'section' => 'social',
			'icon'	=> 'fa-twitter',
			'name' => __('Socials','newidea'),
			'title' => __('Socials','newidea'),
			'elements'	=> array(
				'social_enable'	=> array(
						'title'	=> __('Social Enable Setting','newidea'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'social_enable'	=> array(
										'name'	=> __('Enable Social','newidea'),
										'type' 	=> 'pc',
										'property' => 'social-enable'
									),
								'social_position'	 => array(
									'name'	=> __('Social Position','newidea'),
									'type' 	=> 'radio',
									'property' => 'social-position',
									'radios'	=> array(
											'radios_1' => __('Top','newidea'),
											'radios_2' => __('Bottom','newidea')
										)
									),
								'social_align'	 => array(
									'name'	=> __('Social Align','newidea'),
									'type' 	=> 'radio',
									'property' => 'social-align',
									'radios'	=> array(
											'radios_1' => __('Left','newidea'),
											'radios_2' => __('Center','newidea'),
											'radios_3' => __('Right','newidea'),
										)
									),
								'social_padding_top' => array(
									'name'	=> __('Social Padding From Top','newidea'),
									'type' 	=> 'number',
									'property' => 'social-padding-top',
									'after'	=>	'px',
									),
								'social_padding_left' => array(
									'name'	=> __('Social Padding From Left','newidea'),
									'type' 	=> 'number',
									'property' => 'social-padding-left',
									'after'	=>	'px',
									),
							)
					),
					'social'	=> array(
						'title'	=> __('Social Account (Use http:// full link)','newidea'),
						'type'	=>	'moreline',
						'moreline'	=> array(
								'social_twitter'	=> array(
										'name'	=> __('Twitter','newidea'),
										'type' 	=> 'input',
										'property' => 'social-twitter'
									),
								'social_facebook'	=> array(
										'name'	=> __('Facebook','newidea'),
										'type' 	=> 'input',
										'property' => 'social-facebook'
									),
								'social_linkedin'	=> array(
										'name'	=> __('Linkedin','newidea'),
										'type' 	=> 'input',
										'property' => 'social-linkedin'
									),
								'social_dribbble'	=> array(
										'name'	=> __('Dribbble','newidea'),
										'type' 	=> 'input',
										'property' => 'social-dribbble'
									),
								'pinterest'	=> array(
										'name'	=> __('Pinterest','newidea'),
										'type' 	=> 'input',
										'property' => 'social-pinterest'
									),
								'social_google'	=> array(
										'name'	=> __('Googole Plus','newidea'),
										'type' 	=> 'input',
										'property' => 'social-google'
									),
								'social_flickr'	=> array(
										'name'	=> __('Flickr','newidea'),
										'type' 	=> 'input',
										'property' => 'social-flickr'
									),
								'social_forrst'	=> array(
										'name'	=> __('Forrst','newidea'),
										'type' 	=> 'input',
										'property' => 'social-forrst'
									),
								'social_picasa'	=> array(
										'name'	=> __('Picasa','newidea'),
										'type' 	=> 'input',
										'property' => 'social-picasa'
									),
								'social_youtube'	=> array(
										'name'	=> __('Youtube','newidea'),
										'type' 	=> 'input',
										'property' => 'social-youtube'
									),
								'social_instagram'	=> array(
										'name'	=> __('Instagram','newidea'),
										'type' 	=> 'input',
										'property' => 'social-instagram'
									),
								'social_behence'	=> array(
										'name'	=> __('Behence','newidea'),
										'type' 	=> 'input',
										'property' => 'social-behence'
									),
								'social_tumblr'	=> array(
										'name'	=> __('Tumblr','newidea'),
										'type' 	=> 'input',
										'property' => 'social-tumblr'
									),
								'social_vimeo'	=> array(
										'name'	=> __('Vimeo','newidea'),
										'type' 	=> 'input',
										'property' => 'social-vimeo'
									),
								'social_lastfm'	=> array(
										'name'	=> __('lastfm','newidea'),
										'type' 	=> 'input',
										'property' => 'social-lastfm'
									),
								'social_stumbleupon'	=> array(
										'name'	=> __('stumbleupon','newidea'),
										'type' 	=> 'input',
										'property' => 'social-stumbleupon'
									),
								'social_xing'	=> array(
										'name'	=> __('Xing','newidea'),
										'type' 	=> 'input',
										'property' => 'social-xing'
									)
									
							)
					)
			)
		);
		
	$page_content[] =  array('section' => 'update',	'icon'	=> 'fa-bullhorn','name' => __('Update Log','newidea') ,'title' => __('Update History', 'newidea'),'type'	=> 'update');
				
	$page_content[] =  array('section' => 'import',	'icon'	=> 'fa-retweet','name' => __('Import/Export','newidea') ,'title' => __('Import/Export Options', 'newidea'),'type'	=> 'import');
	
	$page_content[] =  array('section' => 'get_support','icon'	=> 'fa-question-circle','name' => __('Get Support','newidea'),'title' => 'link','type'	=> 'link',	'class'	=>	'light','pagecontent'	=> 'http://support.themefocus.co');
	
	/**
	 * Option Default Value
	 */
	$options_custom_general = array(
	
		'theme-name'			=>	'',
		'theme-purchase-code'	=>	'',
		'theme-api'				=>	'',
		'theme-update-enable'	=>	'',
		
		'favicon'				=>	$dir . '/images/favicon.png',
		
		'home-default-background'			=>	'',
		'home-mobile-background'			=>	'',
		'home-background-alpha'				=>	70,
		'home-background-overlay'			=>	0,
		'home-background-overlay-alpha'		=>	50,
		
		'mobile-menu-title'					=>	'MENU',
		'news-show-category'				=>	'off',
		'footer-copyright-text'				=>	'Design by <a href="http://themeforest.net/user/ThemeFocus">ThemeFocus</a> powered by WordPress.',
		'google_analytics-position'			=>	1,
		'google_analytics-content'			=>	'',
		
		'logo-image'						=> 	$dir . '/images/logo.png',
		'logo-image-width'					=> 	230,
		'logo-image-height'					=>	56,
		'logo-image-position' 				=>	1,
		'logo-image-align' 					=>	1,
		'logo-padding-top'					=>  55,
		'logo-padding-left' 				=>	0,
		
		'menu-position' 					=>	1,
		'menu-align' 						=>	1,
		'menu-padding-top' 					=>  10,
		'menu-padding-left' 				=>	0,

		'header-height'						=>	30,
		'header-enable-bg' 					=>	"off",
		'header-background-alpha'			=> '30',
		'header-bg-image' 					=>	"",
		'header-bg-color'					=> '000000',
		
		'footer-height'						=>	120,
		'footer-enable-bg' 					=>	"off",
		'footer-background-alpha'			=> '50',
		'footer-bg-image'					=>	'',
		'footer-bg-color'					=> '000000',
		
		'custom-general-font'				=>	0,
		'custom-general-font-size'			=>	12,
		'custom-title-font'					=>	0,
		
		'menu-font'							=>	0,
		'menu-font-size'					=>	16,
		
		'footer-copyright-font'				=>	0,
		'footer-copyright-font-size'		=>	10,
		
		'menu-color'						=>	'ffffff',
		'menu-over-color'					=>	'ffffff',
		'menu-active-color'					=>	'ffffff',
		'menu-bg-color'						=>	'cc2b00',
		'menu-area-bg-color'				=>	'FF3600',
		'menu-active-bg-color'				=>	'000000',
		
		'theme-color'						=>	'FF3600',
		'theme-bg-color'					=>	'000000',
		'theme-border-color'				=>	'E8E8E8',
		'theme-border-over-color'			=>	'FF3600',
		'custom-general-color'				=>	'ffffff',
		'custom-links-color'				=>	'FF3600',
		'custom-links-hover-color'			=>	'FFC700',
		'custom-title-color'				=>	'ffffff',
		'custom-scroll-color'				=>	'ffffff',
		'custom-scroll-bg-color'			=>	'000000',
		
		'custom-css-content'				=>	'',
		'custom-mobile-css-content'			=>	'',
		
		'custom-scripts-content'			=>	'',
		
		'social-enable'						=>	'off',
		'social-position'					=>	0,
		'social-align'						=>	2,
		'social-padding-left'				=>	0,
		'social-padding-top'				=>	0,
		
		'social-twitter'					=>	'',
		'social-facebook'					=>	'',
		'social-linkedin'					=>	'',
		'social-dribbble'					=>	'',
		'social-pinterest'					=>	'',
		'social-google'						=>	'',
		'social-flickr'						=>	'',
		'social-forrst'						=>	'',
		'social-youtube'					=>	'',
		'social-instagram'					=>	'',
		'social-behence'					=>	'',
		'social-tumblr'						=>	'',
		'social-vimeo'						=>	'',
		'social-xing'						=>	'',
		'social-stumbleupon'				=>	'',
		'social-lastfm'						=>	'',
		'social-picasa'						=>	''

	);
	
	/**
	 * Option Config
	 */
	$optionsConfig = array(
		/* type -> menu,submenu */
		/* page_title,menu_title,capability,menu_slug,function,icon_url,position from 100 */
		'menu'	=> array(
				'type'			=>	'menu',
				'option_name' 	=>	'newidea_options',
				'page_desc'		=>	'',
				'page_logo'		=>	'',
				'page_title' 	=>	'NewIdea Options',
				'menu_title' 	=>	'NewIdea',
				'capability' 	=>	'manage_options',
				'menu_slug'	 	=>	'newidea_setting_page',
				'icon_url'		=>	get_template_directory_uri().'/images/penguin/penguin-icon.png',
				'position'		=>	99,
				'fun'			=>	'',
				'admin_bar'		=>	true,
				'backpage'		=>	true
			),
		'submenu'	=> array(
				'type'			=> 'submenu',
				'parent_slug' 	=> 'newidea_setting_page',
				'option_name' 	=> 'newidea_options',
				'page_desc'		=> __('Welcome to setting New Idea theme style!','newidea'),
				'page_logo'		=>	get_template_directory_uri().'/images/penguin/penguin_logo.png',
				'page_logo_url'		=> 'http://themefocus.co/newidea/',
				'page_title' 	=> 'NewIdea Options',
				'menu_title' 	=> 'NewIdea Options',
				'capability' 	=> 'manage_options',
				'menu_slug'	 	=> 'newidea_setting_page',
				'pages'		 	=> $page_content,
				'pages_default_property'	=> $options_custom_general,
				'link'			=>	'http://support.themefocus.co',
				'pid'			=>	'3578858',
				'notifier'		=> "http://support.themefocus.co/notifier/newidea.xml",
				'update_history'		=> "http://support.themefocus.co/update/?theme=newidea",
				'update_opt'		=> "yes"
			)
	);
	
	// custom metas field
	$metasConfig = array();
	
	//page								
	$metasConfig[] = array(
			'id'		=>	'custom-page-setting',
			'type'		=>	'page',
			'priority'	=>	'high',
			'title' 	=>	__('Page Option Setting','newidea'),
			'page_elements'	=>	array(	
							'element-template' => array(	
										'id'	=>	'custom-post-template',
										'icon'	=>	'fa-puzzle-piece',
										'title'	=>	__('Template Options','newidea'),
										'fields'	=>	array(	
																//contact
																array(	'name' 	=> 'contact-map-image',
																		'title'	=> __('Map Image','newidea'),
																		'type'	=>	'upload',
																		'template'	=>	'page-contact',
																		'desc'	=>	__('Size:260*140','newidea'),
																),
																array(	'name' 	=> 'contact-address',
																		'title'	=> __('Contact Address','newidea'),
																		'template' => 'page-contact',
																		'type'	=>	'input'
																),
																array(	'name' 	=> 'contact-email',
																		'title'	=> __('Contact Email','newidea'),
																		'template' => 'page-contact',
																		'type'	=>	'input'
																),
																array(	'name' 	=> 'contact-phone',
																		'title'	=> __('Contact Phone','newidea'),
																		'template' => 'page-contact',
																		'type'	=>	'input'
																),
																array(	'name' 	=> 'contact-email-recipient',
																		'title'	=> __('Contact Form Email Recipient','newidea'),
																		'template' => 'page-contact',
																		'type'	=>	'input',
																		'desc'	=>	__('Email as contact form recipient','newidea'),
																),
																//slider
																array(	'name' 	=> 'slider-layer-slide',
																		'title'	=> __('Select Layer Slider','newidea'),
																		'type'	=>	'select',
																		'template' => 'page-slide',
																		'options' => newidea_get_layerslider()
																),
																//about
																array(	'name' 	=> 'about-testimonials-title',
																		'title'	=> __('Testimonials Title','newidea'),
																		'template' => 'page-about',
																		'type'	=>	'input'
																),
																array(	'name' 	=> 'about-testimonials-name',
																		'title'	=> __('Testimonials Name','newidea'),
																		'template' => 'page-about',
																		'type'	=>	'input'
																),
																array(	'name' 	=> 'about-testimonials-content',
																		'title'	=> __('Testimonials Content','newidea'),
																		'template' => 'page-about',
																		'type'	=>	'textarea'
																),
																//all
																array(	'name' 	=> 'default-image',
																		'title'	=> __('Page Background Image','newidea'),
																		'type'	=>	'upload'
																),
										)
							)
			)
		);
		
	//services
	$metasConfig[] = array(
			'id'		=>	'custom-services-setting',
			'type'		=>	'services',
			'priority'	=>	'high',
			'title' 	=>	__('Services Option Setting','newidea'),
			'page_elements'	=>	array(	
							'element-template' => array(	
										'id'	=>	'custom-post-template',
										'icon'	=>	'fa-puzzle-piece',
										'title'	=>	__('Services Options','newidea'),
										'fields'	=>	array(	
																array(	'name' 	=> 'gallery-images',
																		'title'	=> __('Gallery Images','newidea'),
																		'type'	=>	'gallery'
																)
										)
							)
				)
			);
			
	//portfolio
	$metasConfig[] = array(
			'id'		=>	'custom-portfolio-setting',
			'type'		=>	'portfolio',
			'priority'	=>	'high',
			'title' 	=>	__('Portfolio Option Setting','newidea'),
			'page_elements'	=>	array(	
							'element-template' => array(	
										'id'	=>	'custom-post-template',
										'icon'	=>	'fa-puzzle-piece',
										'title'	=>	__('Portfolio Options','newidea'),
										'fields'	=>	array(	
																array(	'name' 	=> 'portfolio-foramt',
																		'title'	=> __('Portfolio Type','newidea'),
																		'type'	=>	'radio',
																		'radios'	=>	array(__('Image','newidea'),__('Media','newidea' ),__('Link','newidea' )),
																		'enable-element' => 'yes',
																		'enable-id' => '1-portfolio_post_format_video:2-portfolio_post_format_link',
																		'enable-group'	=> 'portfolio_post_format'
																		
																),
																array(	'name' 	=> 'portfolio-preview-media',
																		'title'	=> __('Media Link','newidea'),
																		'type'	=>	'textarea',
																		'enabled-id' => 'portfolio_post_format_video',
																		'enable-group'	=> 'portfolio_post_format',
																		'desc'	=>	__('Media link example please view http://fancyapps.com/fancybox/#examples','newidea')
																),
																array(	'name' 	=> 'portfolio-preview-link',
																		'title'	=> __('Link','newidea'),
																		'type'	=>	'input',
																		'enabled-id' => 'portfolio_post_format_link',
																		'enable-group'	=> 'portfolio_post_format'
																),
																
										)
							)
				)
			);
	
	$postsConfig = array(
						'portfolio' => array(
											'id'					=>	'portfolio',
											'name'					=>	__('Portfolios','newidea'),
											'menu_name'				=>	__('Portfolios','newidea'),
											'singular_name'			=>	__('Portfolio','newidea'),
											'add_new'				=>	__('Add New','newidea'),
											'add_new_item'			=>	__('Add New','newidea'),
											'edit_item'				=>	__('Edit Portfolio','newidea'),
											'new_item'				=>	__('New Portfolio','newidea'),
											'all_items'				=>	__('All Portfolios','newidea'),
											'view_item'				=>	__('View Portfolio','newidea'),
											'search_items'			=>	__('Search Portfolio','newidea'),
											'not_found'				=>	__('No portfolio found','newidea'),
											'not_found_in_trash'	=>	__('No portfolio found in Trash','newidea'),
											'parent_item_colon'		=>	'',
											'menu_position'			=>	5,
											'rewrite'				=>	'portfolio',
											'rewrite_rule'			=>	'',
											'menu_icon'				=>	'\f180',
											'supports'				=>	array('title', 'editor' , 'thumbnail'),
											'categories'			=>	array(
																			'portfolio_cats'	=>	array(
																										'id'			=>	'portfolio_categories',
																										'name'			=>	__( 'Portfolio Categories' ,'newidea'),
																										'menu_name'		=>	__( 'Portfolio Categories' ,'newidea'),
																										'singular_name'	=>	__( 'Portfolio Categories' ,'newidea'),
																										'search_items'	=>	__( 'Search Portfolio Categories' ,'newidea'),
																										'all_items'		=>	__( 'All Portfolio Categories' ,'newidea'),
																										'parent_item'	=>	__( 'Parent Category' ,'newidea'),
																										'parent_item_colon'	=>	__( 'Parent Category:' ,'newidea'),
																										'edit_item'			=>	__( 'Edit Portfolio Category' ,'newidea'),
																										'update_item'		=>	__( 'Update Portfolio Category' ,'newidea'),
																										'add_new_item'		=>	__( 'Add Portfolio Category' ,'newidea'),
																										'new_item_name'		=>	__( 'New Portfolio Category' ,'newidea'),
																										'rewrite'			=>	'',
																										'hierarchical'		=>	true
																									)
																			
																		)
											
									),
						'services' => array(
											'id'					=>	'services',
											'name'					=>	__('Services','newidea'),
											'menu_name'				=>	__('Services','newidea'),
											'singular_name'			=>	__('Service','newidea'),
											'add_new'				=>	__('Add New','newidea'),
											'add_new_item'			=>	__('Add New','newidea'),
											'edit_item'				=>	__('Edit Service','newidea'),
											'new_item'				=>	__('New Service','newidea'),
											'all_items'				=>	__('All Services','newidea'),
											'view_item'				=>	__('View Service','newidea'),
											'search_items'			=>	__('Search Service','newidea'),
											'not_found'				=>	__('No service found','newidea'),
											'not_found_in_trash'	=>	__('No service found in Trash','newidea'),
											'parent_item_colon'		=>	'',
											'menu_position'			=>	5,
											'rewrite'				=>	'services',
											'rewrite_rule'			=>	'',
											'menu_icon'				=>	'\f175',
											'supports'				=>	array('title', 'editor' , 'thumbnail'),
									)
					);

	
	$postsColumnsConfig = array();
					
	// start penguin framework for them
	Penguin::$FRAMEWORK_PATH = "/inc/penguin";
	Penguin::$THEME_NAME = "newidea";
	
	Penguin::start($optionsConfig , $metasConfig , $postsConfig , $postsColumnsConfig, false);
	
	// theme plugins
	include_once('plugins-config.php');
	include_once( 'tax-portfolio-field.php' );

	// Disable LayerSlider auto-updates
	function penguin_layerslider_overrides() {
		$GLOBALS['lsAutoUpdateBox'] = false;
	}
	add_action('layerslider_ready', 'penguin_layerslider_overrides');
	
	// Generate options CSS
	add_action('admin_init', 'newidea_generate_options_css');
	
	// Theme License Notices
	function on_theme_license_notices(){
		global $pagenow;
		if($pagenow == "admin.php" && isset($_GET['page']) && $_GET['page'] == 'newidea_setting_page'){
			
		}else{
			$output = 'Hi! Please <a href="'.admin_url().'admin.php?page=newidea_setting_page">input your license information</a> of <strong>New Idea</strong> theme.';
			
			if(newidea_get_options_key('theme-purchase-code') != "" && newidea_get_options_key('theme-name') != "" && newidea_get_options_key('theme-api') != ""){
				$output = '';
			}
			if($output != ''){
			?>
			<div id="penguin-notice-message" style="display:none;" class="updated below-h2"><p><?php echo $output;?><a id="penguin-license-close" href="#" class="penguin-notice-close" style="float: right;"><strong>X</strong></a></p></div>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					jQuery('#wpbody-content .wrap').prepend(jQuery('#penguin-notice-message'));
					jQuery('#penguin-notice-message').show();
					jQuery('#penguin-license-close').click(function() {
						jQuery('#penguin-notice-message').hide();
						return false;
					});
				});
			</script>
			<?php
			}
		}
	}
	add_action('admin_notices', 'on_theme_license_notices');
	
	// Theme Upgrader
	function on_envato_init(){
		if(newidea_get_options_key('theme-update-enable') != "on" || newidea_get_options_key('theme-purchase-code') == "" || newidea_get_options_key('theme-name') == "" || newidea_get_options_key('theme-api') == ""){
			 return false;
		}
		
		// include the library
		include_once(get_template_directory().'/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');
		
                $theme_name = trim(newidea_get_options_key('theme-name'));
                $theme_api  = trim(newidea_get_options_key('theme-api'));

                $upgrader = new Envato_WordPress_Theme_Upgrader($theme_name , $theme_api );
        
		/*
		 *  Uncomment to check if the current theme has been updated
		 */
		 $upgrader->check_for_theme_update(); 
	
		/*
		 *  Uncomment to update the current theme
		 */
		 $upgrader->upgrade_theme();
	}
	add_action('admin_init', 'on_envato_init');
?>