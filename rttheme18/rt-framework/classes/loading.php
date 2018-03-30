<?php
#-----------------------------------------
#	RT-Theme loading.php
#	version: 1.0
#-----------------------------------------

#
# 	Load the theme
#

class RTTheme{
 
	//Google Font Files
	public $rt_google_fonts=array(
			"Changa+One"=> array("Changa One","Changa One"),
			"Dosis:700&subset=latin,latin-ext"=> array("Dosis","Dosis"),
			"Open+Sans:400,400italic&subset=latin,latin-ext"=> array("Open Sans","Open Sans - Latin"),
			"Open+Sans:400,400italic&subset=latin,latin-ext,greek-ex" => array("Open Sans","Open Sans - Greek"),
			"Open+Sans:400,400italic&subset=latin,latin-ext,cyrillic-ext" => array("Open Sans","Open Sans - Cyrillic"),
			"Open+Sans:400,400italic&subset=latin,latin-ext,vietnames"=> array("Open Sans","Open Sans - Vietnames"), 
			"Open+Sans+Condensed:300,700,300italic&subset=latin,latin-ext"=> array("Open Sans Condensed","Open Sans Condensed - Latin"),
			"Open+Sans+Condensed:300,700,300italic&subset=latin,latin-ext,greek-ex" => array("Open Sans Condensed","Open Sans Condensed- Greek"),
			"Open+Sans+Condensed:300,700,300italic&subset=latin,latin-ext,cyrillic-ext" => array("Open Sans Condensed","Open Sans Condensed- Cyrillic"),
			"Open+Sans+Condensed:300,700,300italic&subset=latin,latin-ext,vietnames"=> array("Open Sans Condensed","Open Sans Condensed- Vietnames"), 
			"Lora"=> array("Lora","Lora"),
			"Nunito"=> array("Nunito","Nunito"),
			"Francois+One&subset=latin,latin-ext" => array("Francois One","Francois One"),
			"Play:400,700&subset=latin,latin-ext" => array("Play","Play - Latin"),
			"Play:400,700&subset=latin,latin-ext,greek-ext" => array("Play","Play - Greek"),
			"Play:400,700&subset=latin,latin-ext,cyrillic-ext"=> array("Play","Play - Cyrillic"), 
			"Bitter:400,700,400italic&subset=latin,latin-ext" => array("Bitter","Bitter"),
			"Shadows+Into+Light"=> array("Shadows Into Light","Shadows Into Light"),
			"Marck+Script&subset=latin,latin-ext" => array("Marck Script","Marck Script - Lation"),
			"Marck+Script&subset=latin,latin-ext,cyrillic-ext"=> array("Marck Script","Marck Script - Cyrillic"),
			"Questrial" => array("Questrial","Questrial"),
			"Fredoka+One" => array("Fredoka One","Fredoka One"),
			"Righteous&subset=latin,latin-ext"=> array("Righteous","Righteous"),
			"Ruda&subset=latin,latin-ext" => array("Ruda","Ruda"),
			"Squada+One"=> array("Squada One","Squada One"),
			"Exo&subset=latin,latin-ext"=> array("Exo","Exo"),				
			"Cabin+Condensed" => array("Cabin Condensed","Cabin Condensed"),
			"Cagliostro"=> array("Cagliostro","Cagliostro"),
			"Lemon" => array("Lemon","Lemon"),
			"Aguafina+Script" => array("Aguafina Script","Aguafina Script"),
			"Iceland" => array("Iceland","Iceland"),
			"Signika" => array("Signika","Signika"),
			"Prociono"=> array("Prociono","Prociono"),
			"Arapey"=> array("Arapey","Arapey"),
			"Convergence" => array("Convergence","Convergence"),
			"Rammetto+One"=> array("Rammetto One","Rammetto One"),
			"Linden+Hill" => array("Linden Hill","Linden Hill"),
			"Dorsa" => array("Dorsa","Dorsa"),
			"Merienda+One"=> array("Merienda One","Merienda One"),
			"Petrona" => array("Petrona","Petrona"),
			"Nova+Square" => array("Nova Square","Nova Square"),
			"Jockey+One"=> array("Jockey One","Jockey One"),
			"Antic" => array("Antic","Antic"),
			"Abel"=> array("Abel","Abel"),
			"Nova+Flat" => array("Nova Flat","Nova Flat"),
			"Sansita+One" => array("Sansita One","Sansita One"),
			"Marvel"=> array("Marvel","Marvel"),
			"Ubuntu+Condensed"=> array("Ubuntu Condensed","Ubuntu Condensed"),
			"Rationale" => array("Rationale","Rationale"),
			"Anton" => array("Anton","Anton"),
			"Michroma"=> array("Michroma","Michroma"),
			"Paytone+One" => array("Paytone One","Paytone One"), 
			"Expletus+Sans" => array("Expletus Sans","Expletus Sans"),
			"Orbitron"=> array("Orbitron","Orbitron"),
			"Gruppo"=> array("Gruppo","Gruppo"),
			"Chewy" => array("Chewy","Chewy"),
			"Wire+One"=> array("Wire One","Wire One"),
			"Aclonica"=> array("Aclonica","Aclonica"),
			"Damion"=> array("Damion","Damion"),
			"Swanky+and+Moo+Moo"=> array("Swanky and Moo Moo","Swanky and Moo Moo"),
			"News+Cycle"=> array("News Cycle","News Cycle"),
			"Over+the+Rainbow"=> array("Over the Rainbow","Over the Rainbow"),
			"Wallpoet"=> array("Wallpoet","Wallpoet"),
			"Special+Elite" => array("Special Elite", "Special Elite"),
			"MedievalSharp" => array("MedievalSharp","MedievalSharp"),
			"Waiting+for+the+Sunrise" => array("Waiting for the Sunrise","Waiting for the Sunrise"),
			"Quattrocento+Sans" => array("Quattrocento Sans","Quattrocento Sans"),
			"The+Girl+Next+Door"=> array("The Girl Next Door","The Girl Next Door"),
			"Nova+Slim" => array("Nova Slim","Nova Slim"),
			"Smythe"=> array("Smythe","Smythe"),
			"Miltonian+Tattoo"=> array("Miltonian Tattoo","Miltonian Tattoo"),
			"Kristi"=> array("Kristi","Kristi"),
			"Sue+Ellen+Francisco" => array("Sue Ellen Francisco","Sue Ellen Francisco"),
			"Bangers" => array("Bangers","Bangers"),
			"Terminal+Dosis+Light"=> array("Terminal Dosis Light","Terminal Dosis Light"),
			"Annie+Use+Your+Telescope"=> array("Annie Use Your Telescope","Annie Use Your Telescope"),
			"EB+Garamond&subset=latin,latin-ext"=> array("EB Garamond","EB Garamond"),
			"EB+Garamond&subset=cyrillic,latin" => array("EB Garamond","EB Garamond Cyrillic"),
			"Irish+Grover"=> array("Irish Grover","Irish Grover"),
			"Dawning+of+a+New+Day"=> array("Dawning of a New Day","Dawning of a New Day"),
			"Crimson+Text"=> array("Crimson Text","Crimson Text"),
			"Quattrocento"=> array("Quattrocento","Quattrocento"),
			"Expletus+Sans" => array("Expletus Sans","Expletus Sans"),
			"Maiden+Orange" => array("Maiden Orange","Maiden Orange"),
			"Sniglet:800" => array("Sniglet","Sniglet"),
			"Astloch" => array("Astloch","Astloch"),
			"Pacifico"=> array("Pacifico","Pacifico"),
			"Indie+Flower"=> array("Indie Flower","Indie Flower"),
			"VT323" => array("VT323","VT323"),
			"Vollkorn"=> array("Vollkorn","Vollkorn"),
			"Architects+Daughter" => array("Architects Daughter","Architects Daughter"),
			"Michroma"=> array("Michroma","Michroma"),
			"Anton" => array("Anton","Anton"),
			"Bevan" => array("Bevan","Bevan"),
			"Allan:bold"=> array("Allan","Allan"),
			"Kenia" => array("Kenia","Kenia"),
			"Six+Caps"=> array("Six Caps","Six Caps"),
			"Lekton"=> array("Lekton","Lekton"),
			"UnifrakturMaguntia"=> array("UnifrakturMaguntia","UnifrakturMaguntia"),
			"Oswald:300&subset=latin,latin-ext" => array("Oswald","Oswald Light","300"),
			"Oswald&subset=latin,latin-ext" => array("Oswald","Oswald Normal","400"),
			"Oswald:700&subset=latin,latin-ext" => array("Oswald","Oswald Bold","700"),
			"League+Script" => array("League Script","League Script"),
			"Orbitron"=> array("Orbitron","Orbitron"),
			"Cuprum"=> array("Cuprum","Cuprum"),
			"Cabin" => array("Cabin","Cabin"),
			"Philosopher" => array("Philosopher","Philosopher"),
			"Walter+Turncoat" => array("Walter Turncoat","Walter Turncoat"),
			"Candal"=> array("Candal","Candal"),
			"Cabin+Sketch:bold" => array("Cabin Sketch","Cabin Sketch"),
			"Droid+Sans+Mono" => array("Droid Sans Mono","Droid Sans Mono"),
			"Calligraffitti"=> array("Calligraffitti","Calligraffitti"),
			"Neucha"=> array("Neucha","Neucha"),
			"Rock+Salt" => array("Rock Salt","Rock Salt"),
			"Lato"=> array("Lato","Lato"),
			"Luckiest+Guy"=> array("Luckiest Guy","Luckiest Guy"),
			"Mountains+of+Christmas"=> array("Mountains of Christmas","Mountains of Christmas"),
			"Raleway:100" => array("Raleway","Raleway : Thin"),
			"Raleway:400" => array("Raleway","Raleway : Normal"),
			"Raleway:800" => array("Raleway","Raleway : Bold"),
			"Geo" => array("Geo","Geo"),
			"Slackey" => array("Slackey","Slackey"),
			"Corben:bold" => array("Corben","Corben"),
			"Unkempt" => array("Unkempt","Unkempt"),
			"Droid+Sans:400,700&v2" => array("Droid Sans","Droid Sans"),
			"Cherry+Cream+Soda" => array("Cherry Cream Soda","Cherry Cream Soda"),
			"Vibur" => array("Vibur","Vibur"),
			"Gruppo"=> array("Gruppo","Gruppo"),
			"Permanent+Marker"=> array("Permanent Marker","Permanent Marker"),
			"Coda:800"=> array("Coda","Coda"),
			"Cousine" => array("Cousine","Cousine"),
			"Crafty+Girls"=> array("Crafty Girls","Crafty Girls"),
			"Schoolbell"=> array("Schoolbell","Schoolbell"),
			"Kranky"=> array("Kranky","Kranky"),
			"Covered+By+Your+Grace" => array("Covered By Your Grace","Covered By Your Grace"),
			"Syncopate" => array("Syncopate","Syncopate"),
			"PT+Serif"=> array("PT Serif","PT Serif"),				
			"PT+Serif&subset=cyrillic,latin"=> array("PT Serif","PT Serif Cyrillic"),
			"Josefin+Sans"=> array("Josefin Sans","Josefin Sans"),
			"Homemade+Apple"=> array("Homemade Apple","Homemade Apple"),
			"Molengo" => array("Molengo","Molengo"),
			"Yanone+Kaffeesatz" => array("Yanone Kaffeesatz","Yanone Kaffeesatz"),
			"Radley"=> array("Radley","Radley"),
			"Chewy" => array("Chewy","Chewy"),
			"Neuton"=> array("Neuton","Neuton"),
			"Tinos" => array("Tinos","Tinos"),
			"Tangerine" => array("Tangerine","Tangerine"),
			"Allerta" => array("Allerta","Allerta"),
			"PT+Sans:400,400italic" => array("PT Sans","PT Sans Normal","400"),
			"PT+Sans:700,700italic" => array("PT Sans","PT Sans Bold","700"),
			"PT+Sans:400,400italic&subset=cyrillic-ext,cyrillic" => array("PT Sans","PT Sans Normal - Cyrillic","400"),
			"PT+Sans:700,700italic&subset=cyrillic-ext,cyrillic" => array("PT Sans","PT Sans Bold - Cyrillic","700"),
			"PT+Sans+Narrow&subset=latin,latin-ext"=> array("PT Sans Narrow","PT Sans Narrow"),
			"PT+Sans+Narrow&subset=cyrillic-ext,cyrillic"=> array("PT Sans Narrow","PT Sans Narrow - Cyrillic"), 
			"PT+Sans+Narrow:700&subset=latin,latin-ext"=> array("PT Sans Narrow","PT Sans Narrow Bold"),
			"PT+Sans+Narrow:700&subset=cyrillic-ext,cyrillic"=> array("PT Sans Narrow","PT Sans Narrow Bold - Cyrillic"),   
			"Inconsolata" => array("Inconsolata","Inconsolata"),
			"Droid+Serif:400,400italic,700,700italic" => array("Droid Serif","Droid Serif"),
			"Sunshiney" => array("Sunshiney","Sunshiney"),
			"Bentham" => array("Bentham","Bentham"),
			"Just+Another+Hand" => array("Just Another Hand","Just Another Hand"),
			"Cardo" => array("Cardo","Cardo"),
			"Cantarell" => array("Cantarell","Cantarell"),
			"OFL+Sorts+Mill+Goudy+TT" => array("OFL Sorts Mill Goudy TT","OFL Sorts Mill Goudy TT"),
			"Ubuntu"=> array("Ubuntu","Ubuntu"),
			"Ubuntu&subset=greek,latin" => array("Ubuntu","Ubuntu Greek"),
			"Ubuntu&subset=cyrillic,latin"=> array("Ubuntu","Ubuntu Cyrillic"),	
			"Reenie+Beanie" => array("Reenie Beanie","Reenie Beanie"),
			"Arvo"=> array("Arvo","Arvo"),
			"Coming+Soon" => array("Coming Soon","Coming Soon"),
			"Josefin+Slab"=> array("Josefin Slab","Josefin Slab"),
			"Fontdiner+Swanky"=> array("Fontdiner Swanky","Fontdiner Swanky"),
			"Old+Standard+TT" => array("Old Standard TT","Old Standard TT"),
			"Puritan" => array("Puritan","Puritan"),
			"Merriweather"=> array("Merriweather","Merriweather"),
			"UnifrakturCook:bold" => array("UnifrakturCook","UnifrakturCook"),
			"Crushed" => array("Crushed","Crushed"),
			"Buda:light"=> array("Buda","Buda"),
			"IM+Fell+Great+Primer"=> array("IM Fell Great Primer","IM Fell Great Primer"),						
			"Goudy+Bookletter+1911" => array("Goudy Bookletter 1911","Goudy Bookletter 1911"),
			"Nobile"=> array("Nobile","Nobile"),
			"Copse" => array("Copse","Copse"),
			"Lobster" => array("Lobster","Lobster"),
			"Allerta+Stencil" => array("Allerta Stencil","Allerta Stencil"),
			"Arimo" => array("Arimo","Arimo"),
			"Meddon"=> array("Meddon","Meddon"),
			"Dancing+Script"=> array("Dancing Script","Dancing Script"),
			"Just+Me+Again+Down+Here" => array("Just Me Again Down Here","Just Me Again Down Here"),
			"Amaranth"=> array("Amaranth","Amaranth"),
			"Anonymous+Pro" => array("Anonymous Pro","Anonymous Pro"),
			"Kreon" => array("Kreon","Kreon"),
			"Carter+One"=> array("Carter One","Carter One"), 
			"Roboto&subset=latin,latin-ext" => array("Roboto","Roboto"),
			"Source+Sans+Pro&subset=latin,latin-ext" => array("Source Sans Pro","Source Sans Pro"),
			"Roboto+Condensed&subset=latin,latin-ext" => array("Roboto Condensed","Roboto Condensed"),
			"Montserrat&subset=latin,latin-ext" => array("Montserrat","Montserrat"),
			"Oxygen&subset=latin,latin-ext" => array("Oxygen","Oxygen"),
			"Noto+Sans&subset=latin,latin-ext" => array("Noto Sans","Noto Sans"),
			"Titillium+Web&subset=latin,latin-ext" => array("Titillium Web","Titillium Web"),
			"Libre+Baskerville&subset=latin,latin-ext" => array("Libre Baskerville","Libre Baskerville"),
			"Roboto+Slab&subset=latin,latin-ext" => array("Roboto Slab","Roboto Slab"),
			"Rokkitt&subset=latin,latin-ext" => array("Rokkitt","Rokkitt"),
			"Fjalla+One&subset=latin,latin-ext" => array("Fjalla One","Fjalla One"),
			"Playfair+Display&subset=latin,latin-ext" => array("Playfair Display","Playfair Display"),
			"Merriweather+Sans&subset=latin,latin-ext" => array("Merriweather Sans","Merriweather Sans"),
			"Maven+Pro&subset=latin,latin-ext" => array("Maven Pro","Maven Pro"),
			"Asap&subset=latin,latin-ext" => array("Asap","Asap"),
			"Muli&subset=latin,latin-ext" => array("Muli","Muli"),
			"Archivo+Narrow&subset=latin,latin-ext" => array("Archivo Narrow","Archivo Narrow"),
			"Armata&subset=latin,latin-ext" => array("Armata","Armata"),
			"PT+Sans+Caption&subset=latin,latin-ext" => array("PT Sans Caption","PT Sans Caption"),
			"Quicksand&subset=latin,latin-ext" => array("Quicksand","Quicksand"),
			"Alegreya&subset=latin,latin-ext" => array("Alegreya","Alegreya"),
			"Istok+Web&subset=latin,latin-ext" => array("Istok Web","Istok Web"),
			"Varela+Round&subset=latin,latin-ext" => array("Varela Round","Varela Round"),
			"Comfortaa&subset=latin,latin-ext" => array("Comfortaa","Comfortaa"),
			"Bree+Serif&subset=latin,latin-ext" => array("Bree Serif","Bree Serif"),
			"Karla&subset=latin,latin-ext" => array("Karla","Karla"),
			"Black+Ops+One&subset=latin,latin-ext" => array("Black Ops One","Black Ops One"),
			"Gudea&subset=latin,latin-ext" => array("Gudea","Gudea"),
			"Hammersmith+One&subset=latin,latin-ext" => array("Hammersmith One","Hammersmith One"),
			"Playball&subset=latin,latin-ext" => array("Playball","Playball"),
			"Economica&subset=latin,latin-ext" => array("Economica","Economica"),
			"Noto+Serif&subset=latin,latin-ext" => array("Noto Serif","Noto Serif"),
			"Patua+One&subset=latin,latin-ext" => array("Patua One","Patua One"),
			"Voltaire&subset=latin,latin-ext" => array("Voltaire","Voltaire"),
			"Ropa+Sans&subset=latin,latin-ext" => array("Ropa Sans","Ropa Sans"),
			"Pontano+Sans&subset=latin,latin-ext" => array("Pontano Sans","Pontano Sans"),
			"Monda&subset=latin,latin-ext" => array("Monda","Monda"),
			"Cantata+One&subset=latin,latin-ext" => array("Cantata One","Cantata One"),
			"Gloria+Hallelujah&subset=latin,latin-ext" => array("Gloria Hallelujah","Gloria Hallelujah"),
			"Poiret+One&subset=latin,latin-ext" => array("Poiret One","Poiret One"),
			"Crete+Round&subset=latin,latin-ext" => array("Crete Round","Crete Round"),
			"Audiowide&subset=latin,latin-ext" => array("Audiowide","Audiowide"),
			"Varela&subset=latin,latin-ext" => array("Varela","Varela"),
			"Lobster+Two&subset=latin,latin-ext" => array("Lobster Two","Lobster Two"),
			"Amatic+SC&subset=latin,latin-ext" => array("Amatic SC","Amatic SC"),
			"Passion+One&subset=latin,latin-ext" => array("Passion One","Passion One"),
			"Pathway+Gothic+One&subset=latin,latin-ext" => array("Pathway Gothic One","Pathway Gothic One"),
			"Montserrat+Alternates&subset=latin,latin-ext" => array("Montserrat Alternates","Montserrat Alternates"),
			"BenchNine&subset=latin,latin-ext" => array("BenchNine","BenchNine"),
			"Telex&subset=latin,latin-ext" => array("Telex","Telex"),
			"Chivo&subset=latin,latin-ext" => array("Chivo","Chivo"),
			"Noticia+Text&subset=latin,latin-ext" => array("Noticia Text","Noticia Text"),
			"Patrick+Hand&subset=latin,latin-ext" => array("Patrick Hand","Patrick Hand"),
			"Satisfy&subset=latin,latin-ext" => array("Satisfy","Satisfy"),
			"Shadows+Into+Light+Two&subset=latin,latin-ext" => array("Shadows Into Light Two","Shadows Into Light Two"),
			"Signika+Negative&subset=latin,latin-ext" => array("Signika Negative","Signika Negative"),
			"Gentium+Book+Basic&subset=latin,latin-ext" => array("Gentium Book Basic","Gentium Book Basic"),
			"Sanchez&subset=latin,latin-ext" => array("Sanchez","Sanchez"),
			"Vidaloka&subset=latin,latin-ext" => array("Vidaloka","Vidaloka"),
			"Handlee&subset=latin,latin-ext" => array("Handlee","Handlee"),
			"Archivo+Black&subset=latin,latin-ext" => array("Archivo Black","Archivo Black"),
			"Oleo+Script&subset=latin,latin-ext" => array("Oleo Script","Oleo Script"),
			"Carme&subset=latin,latin-ext" => array("Carme","Carme"),
			"Pinyon+Script&subset=latin,latin-ext" => array("Pinyon Script","Pinyon Script"),
			"Source+Code+Pro&subset=latin,latin-ext" => array("Source Code Pro","Source Code Pro"),
			"Loved+by+the+King&subset=latin,latin-ext" => array("Loved by the King","Loved by the King"),
			"Share&subset=latin,latin-ext" => array("Share","Share"),
			"Actor&subset=latin,latin-ext" => array("Actor","Actor"),
			"Marmelad&subset=latin,latin-ext" => array("Marmelad","Marmelad"),
			"Kotta+One&subset=latin,latin-ext" => array("Kotta One","Kotta One"),
			"Didact+Gothic&subset=latin,latin-ext" => array("Didact Gothic","Didact Gothic"),
			"Nothing+You+Could+Do&subset=latin,latin-ext" => array("Nothing You Could Do","Nothing You Could Do"),
			"Overlock&subset=latin,latin-ext" => array("Overlock","Overlock"),
			"Kaushan+Script&subset=latin,latin-ext" => array("Kaushan Script","Kaushan Script"),
			"Leckerli+One&subset=latin,latin-ext" => array("Leckerli One","Leckerli One"),
			"Scada&subset=latin,latin-ext" => array("Scada","Scada"),
			"Doppio+One&subset=latin,latin-ext" => array("Doppio One","Doppio One"),
			"Enriqueta&subset=latin,latin-ext" => array("Enriqueta","Enriqueta"),
			"Rambla&subset=latin,latin-ext" => array("Rambla","Rambla"),
			"Antic+Slab&subset=latin,latin-ext" => array("Antic Slab","Antic Slab"),
			"Rancho&subset=latin,latin-ext" => array("Rancho","Rancho"),
			"Kameron&subset=latin,latin-ext" => array("Kameron","Kameron"),
			"Gentium+Basic&subset=latin,latin-ext" => array("Gentium Basic","Gentium Basic"),
			"Electrolize&subset=latin,latin-ext" => array("Electrolize","Electrolize"),
			"Great+Vibes&subset=latin,latin-ext" => array("Great Vibes","Great Vibes"),
			"Glegoo&subset=latin,latin-ext" => array("Glegoo","Glegoo"),
			"Abril+Fatface&subset=latin,latin-ext" => array("Abril Fatface","Abril Fatface"),
			"Arbutus+Slab&subset=latin,latin-ext" => array("Arbutus Slab","Arbutus Slab"),
			"Love+Ya+Like+A+Sister&subset=latin,latin-ext" => array("Love Ya Like A Sister","Love Ya Like A Sister"),
			"Alfa+Slab+One&subset=latin,latin-ext" => array("Alfa Slab One","Alfa Slab One"),
			"Aldrich&subset=latin,latin-ext" => array("Aldrich","Aldrich"),
			"Russo+One&subset=latin,latin-ext" => array("Russo One","Russo One"),
			"Ubuntu+Mono&subset=latin,latin-ext" => array("Ubuntu Mono","Ubuntu Mono"),
			"Chau+Philomene+One&subset=latin,latin-ext" => array("Chau Philomene One","Chau Philomene One"),
			"Sintony&subset=latin,latin-ext" => array("Sintony","Sintony"),
			"Viga&subset=latin,latin-ext" => array("Viga","Viga"),
			"Jura&subset=latin,latin-ext" => array("Jura","Jura"),
			"Rochester&subset=latin,latin-ext" => array("Rochester","Rochester"),
			"Domine&subset=latin,latin-ext" => array("Domine","Domine"),
			"Spirax&subset=latin,latin-ext" => array("Spirax","Spirax"),
			"Julius+Sans+One&subset=latin,latin-ext" => array("Julius Sans One","Julius Sans One"),
			"Sorts+Mill+Goudy&subset=latin,latin-ext" => array("Sorts Mill Goudy","Sorts Mill Goudy"),
			"Bad+Script&subset=latin,latin-ext" => array("Bad Script","Bad Script"),
			"Lusitana&subset=latin,latin-ext" => array("Lusitana","Lusitana"),
			"PT+Serif+Caption&subset=latin,latin-ext" => array("PT Serif Caption","PT Serif Caption"),
			"Cutive&subset=latin,latin-ext" => array("Cutive","Cutive"),
			"Trocchi&subset=latin,latin-ext" => array("Trocchi","Trocchi"),
			"Petit+Formal+Script&subset=latin,latin-ext" => array("Petit Formal Script","Petit Formal Script"),
			"Inder&subset=latin,latin-ext" => array("Inder","Inder"),
			"Judson&subset=latin,latin-ext" => array("Judson","Judson"),
			"Metrophobic&subset=latin,latin-ext" => array("Metrophobic","Metrophobic"),
			"Carrois+Gothic&subset=latin,latin-ext" => array("Carrois Gothic","Carrois Gothic"),
			"Metamorphous&subset=latin,latin-ext" => array("Metamorphous","Metamorphous"),
			"Rosario&subset=latin,latin-ext" => array("Rosario","Rosario"),
			"Coustard&subset=latin,latin-ext" => array("Coustard","Coustard"),
			"Happy+Monkey&subset=latin,latin-ext" => array("Happy Monkey","Happy Monkey"),
			"ABeeZee&subset=latin,latin-ext" => array("ABeeZee","ABeeZee"),
			"Magra&subset=latin,latin-ext" => array("Magra","Magra"),
			"Cinzel&subset=latin,latin-ext" => array("Cinzel","Cinzel"),
			"Exo+2&subset=latin,latin-ext" => array("Exo 2","Exo 2"),
			"Volkhov&subset=latin,latin-ext" => array("Volkhov","Volkhov"),
			"Orienta&subset=latin,latin-ext" => array("Orienta","Orienta"),
			"Boogaloo&subset=latin,latin-ext" => array("Boogaloo","Boogaloo"),
			"Prata&subset=latin,latin-ext" => array("Prata","Prata"),
			"Advent+Pro&subset=latin,latin-ext" => array("Advent Pro","Advent Pro"),
			"Fenix&subset=latin,latin-ext" => array("Fenix","Fenix"),	
			"Days+One&subset=latin" => array("Days One","Days One"),					
			"Armata&subset=latin,latin-ext" => array("Armata","Armata"),					
						
	);

	//Web Safe Fonts
	public $rt_websafe_fonts=array(
			"Arial, Helvetica, sans-serif" => "Arial, Helvetica, sans-serif",
			"'Arial Black', Gadget, sans-serif" => "Arial Black, Gadget, sans-serif",
			"'Bookman Old Style', serif" => "Bookman Old Style, serif",
			"'Comic Sans MS', cursive" => "Comic Sans MS, cursive",
			"Courier, monospace" => "Courier, monospace", 
			"Garamond, serif" => "Garamond, serif",
			"Georgia, serif" => "Georgia, serif",
			"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
			"'Lucida Console', Monaco, monospace" => "Lucida Console, Monaco, monospace",
			"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "Lucida Sans Unicode, Lucida Grande, sans-serif",
			"'MS Sans Serif', Geneva, sans-serif" => "MS Sans Serif, Geneva, sans-serif",
			"'MS Serif', 'New York', sans-serif" => "MS Serif, New York, sans-serif",
			"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "Palatino Linotype, Book Antiqua, Palatino, serif",
			"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
			"'Times New Roman', Times, serif" => "Times New Roman, Times, serif",
			"'Trebuchet MS', Helvetica, sans-serif" => "Trebuchet MS, Helvetica, sans-serif",
			"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif",
			"Webdings, sans-serif" => "Webdings, sans-serif",
			"Wingdings, 'Zapf Dingbats', sans-serif" => "Wingdings, Zapf Dingbats, sans-serif"
	);

	//font list for select box
	public $rt_font_list = array();

	//rt_themeilable Social Media Icons
	public $rt_social_media_icons=array(  
			"RSS"         => "rss", 
			"Email"       => "mail", 
			"Twitter"     => "twitter", 
			"Facebook"    => "facebook", 
			"Flickr"      => "flickr", 
			"Google +"    => "gplus", 
			"Pinterest"   => "pinterest", 
			"Tumblr"      => "tumblr", 
			"Linkedin"    => "linkedin", 
			"Dribbble"    => "dribbble", 
			"Skype"       => "skype", 
			"Behance"     => "behance", 
			"Github"      => "github", 
			"Vimeo"       => "vimeo", 
			"StumbleUpon" => "stumbleupon", 
			"Lastfm"      => "lastfm", 
			"Spotify"     => "spotify", 
			"Instagram"   => "instagram", 
			"Dropbox"     => "dropbox", 
			"Evernote"    => "evernote", 
			"Flattr"      => "flattr", 
			"Paypal"      => "paypal", 
			"Picasa"      => "picasa", 
			"Vkontakte"   => "vkontakte", 
			"YouTube"     => "youtube-play", 
			"SoundCloud"  => "soundcloud",
			"Foursquare"  => "foursquare",
			"Delicious"   => "delicious",
			"Forrst"      => "forrst",
			"eBay"	      => "ebay",
			"Android"	  => "android", 
			"Xing"	      => "xing",
			"Reddit"	  => "reddit",
			"Digg"        => "digg",
			"Apple App Store" => "macstore",
			"MySpace"     => "myspace",
			"Stack Overflow"=> "stackoverflow" 
	);
				

	function __construct(){
  
		ksort($this->rt_google_fonts);//sort google fonts by name

		//font list for select box
		$this->rt_font_list = array_merge(
							array("optgroup_start 1"=>__("Google Fonts",'rt_theme_admin')),
							$this->rt_google_fonts,
							array("optgroup_end 1"=>""),
							array("optgroup_start 2"=>__("Websafe Fonts",'rt_theme_admin')),
							$this->rt_websafe_fonts,
							array("optgroup_end 2"=>"")
						);		
	}

	function start($v){

		global $rt_websafe_fonts,$rt_google_fonts,$rt_social_media_icons,$RTThemePageLayoutOptionsClass,$RTThemePageLayouts;
		$rt_websafe_fonts 		= $this->rt_websafe_fonts;
		$rt_google_fonts 		= $this->rt_google_fonts;
		$rt_social_media_icons 	= apply_filters("rt_social_media_list", $this->rt_social_media_icons ); 

 
		// Load text domain
		if( ! is_admin() ){	
			load_theme_textdomain('rt_theme', get_template_directory().'/languages' );
		}

		//Call Theme Constants
		$this->theme_constants($v);	  

		//Load Classes
		$this->load_classes($v);
		
		//Load Widgets
		$this->load_widgets($v);		
		
		//Load Functions
		$this->load_functions($v);

		//Create Menus 
		add_action('init', array(&$this,'rt_create_menus'));
				
		//Theme Supports
		$this->theme_supports();

		//Admin Panel Jobs
		if(is_admin()){		
			require_once (RT_THEMEFRAMEWORKDIR.'/classes/admin.php'); 
			$RTadmin = new RTThemeAdmin();
			$RTadmin->admin_init(); 
 
			//activate revslider 
			add_action( 'tgmpa_register', array(&$this,'activate_plugins'));		

		}

		//check woocommerce
		if ( class_exists( 'Woocommerce' ) ) {
			include(RT_THEMEFRAMEWORKDIR . "/functions/woo-integration.php");
		}
		
		//Ajax Contact Form 
		add_action('wp_ajax_rt_ajax_contact_form', array(&$this,'rt_ajax_contact_form'));
		add_action('wp_ajax_nopriv_rt_ajax_contact_form', array(&$this,'rt_ajax_contact_form'));

		//Ajax Product Scroller 
		add_action('wp_ajax_rt_ajax_product_scroller', array(&$this,'rt_ajax_product_scroller'));
		add_action('wp_ajax_nopriv_rt_ajax_product_scroller', array(&$this,'rt_ajax_product_scroller'));		 
	}
 
	#
	# Ajax product scroller
	#
	
	function rt_ajax_product_scroller()
	{
		global $args,$cotent_generator,$this_column_width_pixel,$content_width,$item_width,$layout;

			//page
			$list_orderby ="date";
			$list_order ="ascending";
			$item_per_page =3;
			$paged = 1;
			$categories = "";

			if(isset($_POST['paged'])) $paged = trim($_POST['paged']);
			if(isset($_POST['order'])) $list_order = trim($_POST['order']);
			if(isset($_POST['orderby'])) $list_orderby = trim($_POST['orderby']);
			if(isset($_POST['posts_per_page'])) $item_per_page = trim($_POST['posts_per_page']);
			if(isset($_POST['categories'])){
				if(strpos($_POST['categories'],",")){
					$categories = @explode(",", trim($_POST['categories']));
				}else{
					$categories = @trim($_POST['categories']);
				}
			}

			if(isset($_POST['layout']))  $layout = trim($_POST['layout']);
			if(isset($_POST['item_width']))  $item_width = trim($_POST['item_width']);
			if(isset($_POST['content_width']))  $content_width = trim($_POST['content_width']);
			if(isset($_POST['this_column_width_pixel']))  $this_column_width_pixel = trim($_POST['this_column_width_pixel']);
			if(isset($_POST['cotent_generator']))  $cotent_generator = trim($_POST['cotent_generator']); 

			//general query
			$args=array( 
				'post_status'    =>	'publish',
				'post_type'      =>	'products',
				'orderby'        =>	$list_orderby,
				'order'          =>	$list_order,
				'posts_per_page' =>	$item_per_page,
				'paged'          => $paged, 

				'tax_query' => array(
					array(
						'taxonomy' =>	'product_categories',
						'field'    =>	'id',
						'terms'    =>	 ($categories) ? $categories : '',
						'operator' => 	 ($categories) ? "IN" : "OR"
					)
				),
			); 

			get_template_part( 'product_loop', 'product_categories' );

		die();
	} 

	#
	# Ajax contact form
	#
	
	function rt_ajax_contact_form()
	{	
		load_theme_textdomain('rt_theme', get_template_directory().'/languages' );
		
		$errorMessage = $hasError = "";
		$your_web_site_name= trim(get_bloginfo('name')); 
		$your_email = sanitize_email(base64_decode($_POST['your_email']));
		
		//texts
		$text_1 = __('Thanks','rt_theme');
		$text_2 = __('Your email was successfully sent. We will be in touch soon.','rt_theme');
		$text_3 = __('There was an error submitting the form.','rt_theme');
		$text_4 = __('Please enter a valid email address!','rt_theme');
		$text_5 = __('Wrong answer for the security question! Please make sure that the sum of the two numbers is correct!','rt_theme');

		//If the form is submitted
		if(isset($_POST['name'])) {


			$math         = isset($_POST['math']) ? esc_attr($_POST['math']) : "" ;
			$rt_form_data = isset($_POST['rt_form_data']) ? base64_decode(esc_attr($_POST['rt_form_data'])) : "" ;
			$name         = isset($_POST['name']) ? esc_textarea($_POST['name']) : "" ;
			$email        = isset($_POST['email']) ? sanitize_email($_POST['email']) : "" ;
			$message      = isset($_POST['message']) ? esc_textarea($_POST['message']) : "" ;

			//Check the sum of the numbers
			if( $rt_form_data != "nosecurity" && $math != $rt_form_data )  {					
				$hasError = true;
				$errorMessage = $text_5;
			}

			//Check to make sure that the name field is not empty
			if( empty( $name ) ) {
				$hasError = true; 
			}
			
			//Check to make sure sure that a valid email address is submitted
			if( empty( $email ) || ! $email ) { 
				$hasError = true;
				$errorMessage = $text_4;
			}
 
			//Check to make sure comments were entered	
			if( empty( $message ) ) {
				$hasError = true; 
			}
	
			//If there is no error, send the email
			if(! $hasError ) {

				$subject = __('Contact Form Submission from' , 'rt_theme').' '.$name;
				
				//message body 
				$body  = __('Name' , 'rt_theme').": $name \n\n";
				$body .= __('Email' , 'rt_theme').": $email \n\n";
				$body .= __('Message' , 'rt_theme').": $message \n\n";
	
				$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
				
				wp_mail($your_email, $subject, $body, $headers); 
				$emailSent = true;
			}

			//dynamic form class
			if(isset($_POST['dynamic_class'])) $dynamic_class = trim( sanitize_text_field( $_POST['dynamic_class'] ) ); 		
		} 

		if( isset($emailSent) && $emailSent == true) {

			printf('
					<div class="info_box margin-b20 clearfix %1$s">
						<span class="icon-cancel"></span>
						<p class="%2$s">
						
							<b>%3$s, %4$s</b><br />
							%5$s
							<script>
								jQuery(document).ready(function(){ 
									jQuery(".%6$s").find("input,textarea").attr("disabled", "disabled");
									jQuery(".%6$s").find(".button").remove();
								});
							</script>							
						</p>
					</div>
				','ok','icon-thumbs-up-1',$text_1, $name, $text_2, $dynamic_class);
		}
		
		if( isset( $hasError ) && $hasError == true ) {
 

			printf('
				<div class="info_box margin-b20 clearfix %1$s">
					<span class="icon-cancel"></span>
					<p class="%2$s">					
						<b>%3$s</b><br />
						%4$s
					</p>
				</div>
			','attention','icon-attention',$text_3, $errorMessage);		

		}

		die();
	} 

	
	#
	#	Theme Constants
	#
	
	function theme_constants($v) {
		define('RT_THEMENAME', $v['theme']);
		define('RT_THEMESLUG', $v['slug']); // a unuque slugname for this theme
		define('RT_COMMON_THEMESLUG', "rttheme"); // a common slugnam for all rt-themes
		define('RT_THEMEVERSION', $v['version']); 
		define('RT_THEMEDIR', get_template_directory());
		define('RT_THEMEURI', get_template_directory_uri());
	
		if(function_exists('icl_get_home_url')){
		   define('RT_BLOGURL', icl_get_home_url());
		}else{
			define('RT_BLOGURL', home_url() );  
		}
	
		define('RT_FRAMEWORKSLUG', 'rt-framework'); 
		define('RT_THEMEFRAMEWORKDIR', get_template_directory().'/rt-framework'); 
		define('RT_THEMEADMINDIR', get_template_directory().'/rt-framework/admin');
		define('RT_THEMEADMINURI', get_template_directory_uri().'/rt-framework/admin');
		define('RT_WPADMINURI', get_admin_url());
		define('RT_BLOGPAGE', get_option(RT_THEMESLUG.'_blog_page'));
		define('RT_PRODUCTPAGE', get_option(RT_THEMESLUG.'_product_list'));
		define('RT_PORTFOLIOPAGE', get_option(RT_THEMESLUG.'_portf_page'));
		define('RT_THEMESTYLE', get_option(RT_THEMESLUG."_style"));

		define('RT_DEMOUPLOADSDIR', "http://rttheme18.demo-rt.com/wp-content/uploads/2014/02"); 

		// Constants for notifier
		define( 'RT_NOTIFIER_THEME_FOLDER_NAME', 'rttheme18' );  
		define( 'RT_NOTIFIER_XML_FILE', 'http://templatemints.com/theme_updates/rttheme18/notifier.xml' ); 
		define( 'RT_NOTIFIER_CACHE_INTERVAL', 21600 );
		
		//unique theme name for default settings
		define('RT_UTHEME_NAME', "RTTHEME18");
			
	}    
	
	#
	#	Load Functions
	#
	
	function load_functions($v) {
		include(RT_THEMEFRAMEWORKDIR . "/functions/common_functions.php");		
		include(RT_THEMEFRAMEWORKDIR . "/functions/rt_comments.php");
		include(RT_THEMEFRAMEWORKDIR . "/functions/custom_posts.php");
		include(RT_THEMEFRAMEWORKDIR . "/functions/theme_functions.php");
		include(RT_THEMEFRAMEWORKDIR . "/functions/rt_breadcrumb.php");
		include(RT_THEMEFRAMEWORKDIR . "/functions/rt_shortcodes.php");		
		include(RT_THEMEFRAMEWORKDIR . "/functions/wpml_functions.php");
		include(RT_THEMEFRAMEWORKDIR . "/functions/custom_styling.php");
		include(RT_THEMEFRAMEWORKDIR . "/functions/rt_resize.php");		
		include(RT_THEMEFRAMEWORKDIR . "/plugins/class-tgm-plugin-activation.php");	 
	}

	#
	#	Load Classes
	#
	
	function load_classes($v) {
		global $rt_sidebars_class;

		//Create Sidebars
		include(RT_THEMEFRAMEWORKDIR . "/classes/sidebar.php");  
		$rt_sidebars_class = new RTThemeSidebar(); 



		//is login or register page		
		$is_login = in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ));

		//Theme
		if(!is_admin() && !$is_login){
			require_once (RT_THEMEFRAMEWORKDIR.'/classes/theme.php'); 
			$RTThemeSite = new RTThemeSite();
			$RTThemeSite -> theme_init();

			//Navigation Walker
			include(RT_THEMEFRAMEWORKDIR . "/classes/navigation_walker.php");		
		} 

		//Common Classes
		include(RT_THEMEFRAMEWORKDIR . "/classes/common_classes.php");   
		
	}    	 

	#
	#	Load Widgets
	#
	
	function load_widgets($v) {

		if ( ! class_exists( 'Flickr_Widget' ) ) {
			//flickr
			include(RT_THEMEFRAMEWORKDIR . "/widgets/flickr.php");		
			register_widget('Flickr_Widget');
		}

		if ( ! class_exists( 'Latest_Posts' ) ) {
			//recent posts with thumbnails
			include(RT_THEMEFRAMEWORKDIR . "/widgets/latest_posts.php");		
			register_widget('Latest_Posts');
		}

		if ( ! class_exists( 'Latest_Posts_2' ) ) {
			//recent posts 2 with thumbnails
			include(RT_THEMEFRAMEWORKDIR . "/widgets/latest_posts_2.php");		
			register_widget('Latest_Posts_2');
		}

		if ( ! class_exists( 'Popular_Posts' ) ) {
			//popular posts
			include(RT_THEMEFRAMEWORKDIR . "/widgets/popular_posts.php");		
			register_widget('Popular_Posts');
		}

		if ( ! class_exists( 'Contact_Info' ) ) {			
			//contact info
			include(RT_THEMEFRAMEWORKDIR . "/widgets/contact_info.php");		
			register_widget('Contact_Info');
		}

		if ( ! class_exists( 'RT_Product_Categories' ) ) {			
			//contact info
			include(RT_THEMEFRAMEWORKDIR . "/widgets/product_categories.php");		
			register_widget('RT_Product_Categories');
		}

		if ( ! class_exists( 'RT_Portfolio_Categories' ) ) {			
			//contact info
			include(RT_THEMEFRAMEWORKDIR . "/widgets/portfolio_categories.php");		
			register_widget('RT_Portfolio_Categories');
		}

	}
	

	#
	#	Create WP Menus
	#

	function rt_create_menus() {
		
		register_nav_menu( 'rt-theme-main-navigation', __( 'RT Theme Main Navigation' , 'rt_theme_admin') ); 
		register_nav_menu( 'rt-theme-footer-navigation', __( 'RT Theme Footer Navigation' , 'rt_theme_admin' )); 
		register_nav_menu( 'rt-theme-top-navigation', __( 'RT Theme Top Navigation' , 'rt_theme_admin' )); 		
		
		wp_create_nav_menu( 'RT Theme Main Navigation Menu', array( 'slug' => 'rt-theme-main-navigation' ) );
		wp_create_nav_menu( 'RT Theme Footer Navigation Menu', array( 'slug' => 'rt-theme-footer-navigation') );
		wp_create_nav_menu( 'RT Theme Top Navigation Menu', array( 'slug' => 'rt-theme-top-navigation') );		
	
	}

	#
	#	Theme Supports
	#
	 
	function theme_supports(){
 
		 
		//Automatic Feed Links
		add_theme_support( 'automatic-feed-links' );

		//Let WordPress manage the document title.
		add_theme_support( 'title-tag' );		

		//post thumbnails
		add_theme_support( 'post-thumbnails' ); 

		//Supported Post Formats         
		global $wp_version;
		if (version_compare($wp_version,"3.5.1","<")){
			add_filter( 'enable_post_format_ui', '__return_false' );
		}
				
		remove_filter( 'the_content', 'post_formats_compat', 7 );

		//woocommerce support
		add_theme_support( 'woocommerce' );
	}	


	#
	#	Get Pages as array
	#

	public static function rt_get_pages(){
		  
		// Pages		
		$pages = query_posts('posts_per_page=-1&post_type=page&orderby=title&order=ASC');
		$rt_getpages = array();
		
		if(is_array($pages)){
			foreach ($pages as $page_list ) {
				$rt_getpages[$page_list->ID] = $page_list ->post_title;
			}
		}
		
		wp_reset_query();
		return $rt_getpages;
		
	}


	#
	#	Get Blog Categories - only post categories
	#

	public static function rt_get_categories(){

		// Categories
		$args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'category',
			'pad_counts'               => false
			);
		
		
		$categories = get_categories($args);
		$rt_getcat = array();
		
		if(is_array($categories)){
			foreach ($categories as $category_list ) {
				$rt_getcat[$category_list->cat_ID] = $category_list->cat_name;
			}
		}
	
		return $rt_getcat;
	}


	#
	#	Get Woo Product Categories 
	#

	public static function rt_get_woo_product_categories(){

		// Product Categories		
		$product_args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'product_cat',
			'pad_counts'               => false
			);
		
		
		$product_categories = get_categories($product_args);
		$rt_product_getcat = array();
		
		if(is_array($product_categories)){
			foreach ($product_categories as $category_list ) {
				@$rt_product_getcat[$category_list->slug] = @$category_list->cat_name;
			}
		}
		
		return $rt_product_getcat;
		
	}


	#
	#	Get Product Categories - only product categories with slugs
	#

	public static function rt_get_product_categories_with_slugs(){

		// Product Categories		
		$product_args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'product_categories',
			'pad_counts'               => false
			);
		
		
		$product_categories = get_categories($product_args);
		$rt_product_getcat = array();
		
		if(is_array($product_categories)){
			foreach ($product_categories as $category_list ) {
				@$rt_product_getcat[$category_list->slug] = @$category_list->cat_name;
			}
		}
		
		return $rt_product_getcat;
		
	}


	#
	#	Get Product Categories - only product categories with cat IDs
	#

	public static function rt_get_product_categories(){

		// Product Categories		
		$product_args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'product_categories',
			'pad_counts'               => false
			);
		
		
		$product_categories = get_categories($product_args);
		$rt_product_getcat = array();
		
		if(is_array($product_categories)){
			foreach ($product_categories as $category_list ) {
				$rt_product_getcat[$category_list->cat_ID] = @$category_list->cat_name;
			}
		}
		
		return $rt_product_getcat;
		
	}

	#
	#	Get Portfolio Categories
	#

	public static function rt_get_portfolio_categories(){

		// Product Categories		
		$product_args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'portfolio_categories',
			'pad_counts'               => false
			);
		
		
		$portfolio_categories = get_categories($product_args);
		$rt_portfolio_getcat = array(); 
		
		if(is_array($portfolio_categories)){
			foreach ($portfolio_categories as $category_list ) {
				$rt_portfolio_getcat[$category_list->cat_ID] = $category_list->cat_name;
			}
		}
		
		return $rt_portfolio_getcat;
		
	}


	#
	#	Get Products
	#

	public static function rt_get_products(){

		
		$products  = query_posts('posts_per_page=-1&post_type=products&orderby=title&order=ASC'); // Products 
		$rt_get_product= array();

		if(is_array($products)){
			foreach ($products as $post_list ) {	// add product posts to the list
				$rt_get_product[$post_list->ID] = $post_list ->post_title;
			}
		}
		
		wp_reset_query();
		return $rt_get_product;
		
	}
	

	#
	#	Get Layer Slider Contents
	#

	public static function rt_get_slidercontents(){

		$slider_arg=array(
			'post_type'=> 'slider',
			'post_status'=> 'publish',
			'ignore_sticky_posts'=>1,
			'showposts' => 1000,
			'orderby'=> 'date',
			'order' => 'ASC',
			'cat' => -0,
		);
	
		
		$slider_contents  = query_posts($slider_arg);

		$rt_get_slidercontents= array();
		
		if(is_array($rt_get_slidercontents)){
			foreach ($slider_contents as $spost_list ) {	// add product posts to the list
				$rt_get_slidercontents[$spost_list->ID] = $spost_list ->post_title;
			}
		}

		wp_reset_query();
		return $rt_get_slidercontents;
		
	}

	#
	#	Get Staff List
	#

	public static function rt_get_staff_list(){
		
		$staff_query  = query_posts('posts_per_page=-1&post_type=staff&orderby=title&order=ASC'); // Products 
		$staff_array = array();

		if(is_array($staff_array)){
			foreach ($staff_query as $staff ) {	// add product posts to the list
				$staff_array[$staff->ID] = $staff->post_title;
			}
		}
		
		wp_reset_query();
		return $staff_array;
		
	}


	#
	#	Get Testimonial List
	#

	public static function rt_get_testimonial_list(){
		
		$testimonial_query  = query_posts('posts_per_page=-1&post_type=testimonial&orderby=title&order=ASC'); // Products 
		$testimonial_array = array();

		if(is_array($testimonial_array)){
			foreach ($testimonial_query as $testimonial ) {	// add product posts to the list
				$testimonial_array[$testimonial->ID] = __("Testimonial","rt_theme_admin") . ' - ' . $testimonial->ID;
			}
		}
		
		wp_reset_query();
		return $testimonial_array;
		
	}



	#
	#	Include plugins
	#

	function activate_plugins() { 
 
		//activate revslider 
				$plugins = array(
			  
					array(
						'name'                  => 'LayerSlider WP', // The plugin name
						'slug'                  => 'LayerSlider', // The plugin slug (typically the folder name)
						'source'                => RT_THEMEFRAMEWORKDIR . '/plugins/packages/layerslider.zip', // The plugin source
						'required'              => true, // If false, the plugin is only 'recommended' instead of required
						'version'               => '5.6.9', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
						'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
						'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
						'external_url'          => '', // If set, overrides default API URL and points to an external URL
					),

					array(
						'name'                  => 'Slider Revolution', // The plugin name
						'slug'                  => 'revslider', // The plugin slug (typically the folder name)
						'source'                => RT_THEMEFRAMEWORKDIR . '/plugins/packages/revslider.zip', // The plugin source
						'required'              => false, // If false, the plugin is only 'recommended' instead of required
						'version'               => '5.2.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
						'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
						'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
						'external_url'          => '', // If set, overrides default API URL and points to an external URL
					), 					 



				);
			 
				// Change this to your theme text domain, used for internationalising strings
				$theme_text_domain = 'rt_theme';
			 
				/**
				 * Array of configuration settings. Amend each line as needed.
				 * If you want the default strings to be rt_themeilable under your own theme domain,
				 * leave the strings uncommented.
				 * Some of the strings are added into a sprintf, so see the comments at the
				 * end of each line for what each argument will be.
				 */

				$config = array(
					'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
					'default_path' => '',                      // Default absolute path to bundled plugins.
					'menu'         => 'tgmpa-install-plugins', // Menu slug.
					'parent_slug'  => 'themes.php',            // Parent menu slug.
					'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
					'has_notices'  => true,                    // Show admin notices or not.
					'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
					'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
					'is_automatic' => false,                   // Automatically activate plugins after installation or not.
					'message'      => '',                      // Message to output right before the plugins table.
					'strings'           => array(
						'page_title'                                => esc_html_x( 'Install Required Plugins', 'Admin Panel','rt_theme' ),
						'menu_title'                                => esc_html_x( 'Install Plugins', 'Admin Panel','rt_theme' ),
						'installing'                                => esc_html_x( 'Installing Plugin: %s', 'Admin Panel','rt_theme' ), // %1$s = plugin name
						'oops'                                      => esc_html_x( 'Something went wrong with the plugin API.', 'Admin Panel','rt_theme' ),
						'notice_can_install_required'               => _nx_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'Admin Panel','rt_theme' ), // %1$s = plugin name(s)
						'notice_can_install_recommended'            => _nx_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'Admin Panel','rt_theme' ), // %1$s = plugin name(s)
						'notice_cannot_install'                     => _nx_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'Admin Panel','rt_theme' ), // %1$s = plugin name(s)
						'notice_can_activate_required'              => _nx_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'Admin Panel','rt_theme' ), // %1$s = plugin name(s)
						'notice_can_activate_recommended'           => _nx_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'Admin Panel','rt_theme' ), // %1$s = plugin name(s)
						'notice_cannot_activate'                    => _nx_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'Admin Panel','rt_theme' ), // %1$s = plugin name(s)
						'notice_ask_to_update'                      => _nx_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'Admin Panel','rt_theme' ), // %1$s = plugin name(s)
						'notice_cannot_update'                      => _nx_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'Admin Panel','rt_theme' ), // %1$s = plugin name(s)
						'install_link'                              => _nx_noop( 'Begin installing plugin', 'Begin installing plugins', 'Admin Panel','rt_theme' ),
						'activate_link'                             => _nx_noop( 'Activate installed plugin', 'Activate installed plugins', 'Admin Panel','rt_theme' ),
						'return'                                    => esc_html_x( 'Return to Required Plugins Installer', 'Admin Panel','rt_theme' ),
						'plugin_activated'                          => esc_html_x( 'Plugin activated successfully.', 'Admin Panel','rt_theme' ),
						'complete'                                  => esc_html_x( 'All plugins installed and activated successfully. %s', 'Admin Panel','rt_theme' ) // %1$s = dashboard link
					)
				);
			 
				tgmpa( $plugins, $config );
	}

 
 
}


?>