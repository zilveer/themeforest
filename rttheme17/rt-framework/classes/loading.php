<?php
#-----------------------------------------
#	RT-Theme loading.php
#	version: 1.0
#-----------------------------------------

#
# 	Load the theme
#

class RTTheme{
	 
	//Cufon Font Files
	public $fonts=array(
				"Aller_Light_400.font"         =>  array("Aller Light","Aller Light"),
				"bebas-neue.cufonfonts"        =>  array("Bebas Neue","Bebas Neue"), 
				"Cicle_400.font"               => array("Cicle","Cicle"),
				"Comfortaa.font"               => array("Comfortaa","Comfortaa"),
				"ColaborateLight_400.font"     => array("ColaborateLight","Colaborate Light"), 
				"Diavlo.font"                  => array("Diavlo","Diavlo"),
				"Droid_Serif_400.font"         => array("Droid Serif","Droid Serif"),  
				"PT_Sans_400.font"             => array("PT Sans","PT Sans"),
				"Museo.font"                   => array("Museo","Museo Normal"),
				"Museo.light.font"             => array("Museo Light","Museo Light"),
				"Sansation.light.font"         => array("Sansation Light","Sansation Light"),
				"Sansation.font"               => array("Sansation","Sansation Normal"), 
				"TitilliumText22L_Lt_300.font" => array("TitilliumText22L Lt","Titillium Text"),
				"Vegur_300.font"               => array("Vegur-Light","Vegur Light"),  
				);
	
	//Google Font Files
	public $google_fonts=array(
				"Changa+One" => array("Changa One","Changa One"),
				"Dosis:700&subset=latin,latin-ext" => array("Dosis","Dosis"),
				"Open+Sans:400,400italic&subset=latin,latin-ext" => array("Open Sans","Open Sans - Latin"),
				"Open+Sans:400,400italic&subset=latin,latin-ext,greek-ex" => array("Open Sans","Open Sans - Greek"),
				"Open+Sans:400,400italic&subset=latin,latin-ext,cyrillic-ext"	 => array("Open Sans","Open Sans - Cyrillic"),
				"Open+Sans:400,400italic&subset=latin,latin-ext,vietnames" => array("Open Sans","Open Sans - Vietnames"), 
				"Open+Sans+Condensed:300,700,300italic&subset=latin,latin-ext" => array("Open Sans Condensed","Open Sans Condensed - Latin"),
				"Open+Sans+Condensed:300,700,300italic&subset=latin,latin-ext,greek-ex" => array("Open Sans Condensed","Open Sans Condensed- Greek"),
				"Open+Sans+Condensed:300,700,300italic&subset=latin,latin-ext,cyrillic-ext"	 => array("Open Sans Condensed","Open Sans Condensed- Cyrillic"),
				"Open+Sans+Condensed:300,700,300italic&subset=latin,latin-ext,vietnames" => array("Open Sans Condensed","Open Sans Condensed- Vietnames"), 
				"Lora"				 => array("Lora","Lora"),
				"Nunito"				 => array("Nunito","Nunito"),
				"Francois+One&subset=latin,latin-ext" => array("Francois One","Francois One"),
				"Play:400,700&subset=latin,latin-ext"				 => array("Play","Play - Latin"),
				"Play:400,700&subset=latin,latin-ext,greek-ext"				 => array("Play","Play - Greek"),
				"Play:400,700&subset=latin,latin-ext,cyrillic-ext"				 => array("Play","Play - Cyrillic"), 
				"Bitter:400,700,400italic&subset=latin,latin-ext"				 => array("Bitter","Bitter"),
				"Shadows+Into+Light"				 => array("Shadows Into Light","Shadows Into Light"),
				"Marck+Script&subset=latin,latin-ext"				 => array("Marck Script","Marck Script - Lation"),
				"Marck+Script&subset=latin,latin-ext,cyrillic-ext"				 => array("Marck Script","Marck Script - Cyrillic"),
				"Questrial"				 => array("Questrial","Questrial"),
				"Fredoka+One"				 => array("Fredoka One","Fredoka One"),
				"Righteous&subset=latin,latin-ext"				 => array("Righteous","Righteous"),
				"Ruda&subset=latin,latin-ext"	 => array("Ruda","Ruda"),
				"Squada+One"				 => array("Squada One","Squada One"),
				"Exo&subset=latin,latin-ext"   => array("Exo","Exo"),				
				"Cabin+Condensed"              => array("Cabin Condensed","Cabin Condensed"),
				"Cagliostro"                   => array("Cagliostro","Cagliostro"),
				"Lemon"                        => array("Lemon","Lemon"),
				"Aguafina+Script"              => array("Aguafina Script","Aguafina Script"),
				"Iceland"                      => array("Iceland","Iceland"),
				"Signika"                      => array("Signika","Signika"),
				"Prociono"                     => array("Prociono","Prociono"),
				"Arapey"                       => array("Arapey","Arapey"),
				"Convergence"                  => array("Convergence","Convergence"),
				"Rammetto+One"                 => array("Rammetto One","Rammetto One"),
				"Linden+Hill"                  => array("Linden Hill","Linden Hill"),
				"Dorsa"                        => array("Dorsa","Dorsa"),
				"Merienda+One"                 => array("Merienda One","Merienda One"),
				"Petrona"                      => array("Petrona","Petrona"),
				"Nova+Square"                  => array("Nova Square","Nova Square"),
				"Jockey+One"                   => array("Jockey One","Jockey One"),
				"Antic"                        => array("Antic","Antic"),
				"Abel"                         => array("Abel","Abel"),
				"Nova+Flat"                    => array("Nova Flat","Nova Flat"),
				"Sansita+One"                  => array("Sansita One","Sansita One"),
				"Marvel"                       => array("Marvel","Marvel"),
				"Ubuntu+Condensed"             => array("Ubuntu Condensed","Ubuntu Condensed"),
				"Rationale"                    => array("Rationale","Rationale"),
				"Anton"                        => array("Anton","Anton"),
				"Michroma"                     => array("Michroma","Michroma"),
				"Paytone+One"                  => array("Paytone One","Paytone One"), 
				"Expletus+Sans"                => array("Expletus Sans","Expletus Sans"),
				"Orbitron"                     => array("Orbitron","Orbitron"),
				"Gruppo"                       => array("Gruppo","Gruppo"),
				"Chewy"                        => array("Chewy","Chewy"),
				"Wire+One"                     => array("Wire One","Wire One"),
				"Aclonica"                     => array("Aclonica","Aclonica"),
				"Damion"                       => array("Damion","Damion"),
				"Swanky+and+Moo+Moo"           => array("Swanky and Moo Moo","Swanky and Moo Moo"),
				"News+Cycle"                   => array("News Cycle","News Cycle"),
				"Over+the+Rainbow"             => array("Over the Rainbow","Over the Rainbow"),
				"Wallpoet"                     => array("Wallpoet","Wallpoet"),
				"Special+Elite"                => array("Special Elite", "Special Elite"),
				"MedievalSharp"                => array("MedievalSharp","MedievalSharp"),
				"Waiting+for+the+Sunrise"      => array("Waiting for the Sunrise","Waiting for the Sunrise"),
				"Quattrocento+Sans"            => array("Quattrocento Sans","Quattrocento Sans"),
				"The+Girl+Next+Door"           => array("The Girl Next Door","The Girl Next Door"),
				"Nova+Slim"                    => array("Nova Slim","Nova Slim"),
				"Smythe"                       => array("Smythe","Smythe"),
				"Miltonian+Tattoo"             => array("Miltonian Tattoo","Miltonian Tattoo"),
				"Kristi"                       => array("Kristi","Kristi"),
				"Sue+Ellen+Francisco"          => array("Sue Ellen Francisco","Sue Ellen Francisco"),
				"Bangers"                      => array("Bangers","Bangers"),
				"Terminal+Dosis+Light"         => array("Terminal Dosis Light","Terminal Dosis Light"),
				"Annie+Use+Your+Telescope"     => array("Annie Use Your Telescope","Annie Use Your Telescope"),
				"EB+Garamond&subset=latin,latin-ext"              => array("EB Garamond","EB Garamond"),
				"EB+Garamond&subset=cyrillic,latin" 	=> array("EB Garamond","EB Garamond Cyrillic"),
				"Irish+Grover"                 => array("Irish Grover","Irish Grover"),
				"Dawning+of+a+New+Day"         => array("Dawning of a New Day","Dawning of a New Day"),
				"Crimson+Text"                 => array("Crimson Text","Crimson Text"),
				"Quattrocento"                 => array("Quattrocento","Quattrocento"),
				"Expletus+Sans"                => array("Expletus Sans","Expletus Sans"),
				"Maiden+Orange"                => array("Maiden Orange","Maiden Orange"),
				"Sniglet:800"                  => array("Sniglet","Sniglet"),
				"Astloch"                      => array("Astloch","Astloch"),
				"Pacifico"                     => array("Pacifico","Pacifico"),
				"Indie+Flower"                 => array("Indie Flower","Indie Flower"),
				"VT323"                        => array("VT323","VT323"),
				"Vollkorn"                     => array("Vollkorn","Vollkorn"),
				"Architects+Daughter"          => array("Architects Daughter","Architects Daughter"),
				"Michroma"                     => array("Michroma","Michroma"),
				"Anton"                        => array("Anton","Anton"),
				"Bevan"                        => array("Bevan","Bevan"),
				"Allan:bold"                   => array("Allan","Allan"),
				"Kenia"                        => array("Kenia","Kenia"),
				"Six+Caps"                     => array("Six Caps","Six Caps"),
				"Lekton"                       => array("Lekton","Lekton"),
				"UnifrakturMaguntia"           => array("UnifrakturMaguntia","UnifrakturMaguntia"),
				"Oswald&subset=latin,latin-ext"                    => array("Oswald","Oswald"),
				"League+Script"                => array("League Script","League Script"),
				"Orbitron"                     => array("Orbitron","Orbitron"),
				"Cuprum"                       => array("Cuprum","Cuprum"),
				"Cabin"                        => array("Cabin","Cabin"),
				"Philosopher"                  => array("Philosopher","Philosopher"),
				"Walter+Turncoat"              => array("Walter Turncoat","Walter Turncoat"),
				"Candal"                       => array("Candal","Candal"),
				"Cabin+Sketch:bold"            => array("Cabin Sketch","Cabin Sketch"),
				"Droid+Sans+Mono"              => array("Droid Sans Mono","Droid Sans Mono"),
				"Calligraffitti"               => array("Calligraffitti","Calligraffitti"),
				"Neucha"                       => array("Neucha","Neucha"),
				"Rock+Salt"                    => array("Rock Salt","Rock Salt"),
				"Lato"                         => array("Lato","Lato"),
				"Luckiest+Guy"                 => array("Luckiest Guy","Luckiest Guy"),
				"Mountains+of+Christmas"       => array("Mountains of Christmas","Mountains of Christmas"),
				"Raleway:100"                  => array("Raleway","Raleway"),
				"Geo"                          => array("Geo","Geo"),
				"Slackey"                      => array("Slackey","Slackey"),
				"Corben:bold"                  => array("Corben","Corben"),
				"Unkempt"                      => array("Unkempt","Unkempt"),
				"Droid+Sans:400,700&v2"        => array("Droid Sans","Droid Sans"),
				"Cherry+Cream+Soda"            => array("Cherry Cream Soda","Cherry Cream Soda"),
				"Vibur"                        => array("Vibur","Vibur"),
				"Gruppo"                       => array("Gruppo","Gruppo"),
				"Permanent+Marker"             => array("Permanent Marker","Permanent Marker"),
				"Coda:800"                     => array("Coda","Coda"),
				"Cousine"                      => array("Cousine","Cousine"),
				"Crafty+Girls"                 => array("Crafty Girls","Crafty Girls"),
				"Schoolbell"                   => array("Schoolbell","Schoolbell"),
				"Kranky"                       => array("Kranky","Kranky"),
				"Covered+By+Your+Grace"        => array("Covered By Your Grace","Covered By Your Grace"),
				"Syncopate"                    => array("Syncopate","Syncopate"),
				"PT+Serif"                     => array("PT Serif","PT Serif"),				
				"PT+Serif&subset=cyrillic,latin" => array("PT Serif","PT Serif Cyrillic"),
				"Josefin+Sans"                 => array("Josefin Sans","Josefin Sans"),
				"Homemade+Apple"               => array("Homemade Apple","Homemade Apple"),
				"Molengo"                      => array("Molengo","Molengo"),
				"Yanone+Kaffeesatz"            => array("Yanone Kaffeesatz","Yanone Kaffeesatz"),
				"Radley"                       => array("Radley","Radley"),
				"Chewy"                        => array("Chewy","Chewy"),
				"Neuton"                       => array("Neuton","Neuton"),
				"Tinos"                        => array("Tinos","Tinos"),
				"Tangerine"                    => array("Tangerine","Tangerine"),
				"Allerta"                      => array("Allerta","Allerta"),
				"PT+Sans:400,700,400italic"    => array("PT Sans","PT Sans"),
				"PT+Sans+Narrow&subset=cyrillic,latin" => array("PT Sans Narrow","PT Sans Narrow Cyrillic"),
				"Inconsolata"                  => array("Inconsolata","Inconsolata"),
				"Droid+Serif:400,400italic,700,700italic" => array("Droid Serif","Droid Serif"),
				"Sunshiney"                    => array("Sunshiney","Sunshiney"),
				"Bentham"                      => array("Bentham","Bentham"),
				"Just+Another+Hand"            => array("Just Another Hand","Just Another Hand"),
				"Cardo"                        => array("Cardo","Cardo"),
				"Cantarell"                    => array("Cantarell","Cantarell"),
				"OFL+Sorts+Mill+Goudy+TT"      => array("OFL Sorts Mill Goudy TT","OFL Sorts Mill Goudy TT"),
				"Ubuntu"                       => array("Ubuntu","Ubuntu"),
				"Ubuntu&subset=greek,latin"    => array("Ubuntu","Ubuntu Greek"),
				"Ubuntu&subset=cyrillic,latin" => array("Ubuntu","Ubuntu Cyrillic"),	
				"Reenie+Beanie"                => array("Reenie Beanie","Reenie Beanie"),
				"Arvo"                         => array("Arvo","Arvo"),
				"Coming+Soon"                  => array("Coming Soon","Coming Soon"),
				"Josefin+Slab"                 => array("Josefin Slab","Josefin Slab"),
				"Fontdiner+Swanky"             => array("Fontdiner Swanky","Fontdiner Swanky"),
				"Old+Standard+TT"              => array("Old Standard TT","Old Standard TT"),
				"Puritan"                      => array("Puritan","Puritan"),
				"Merriweather"                 => array("Merriweather","Merriweather"),
				"UnifrakturCook:bold"          => array("UnifrakturCook","UnifrakturCook"),
				"Crushed"                      => array("Crushed","Crushed"),
				"Buda:light"                   => array("Buda","Buda"),
				"IM+Fell+Great+Primer"         => array("IM Fell Great Primer","IM Fell Great Primer"),						
				"Goudy+Bookletter+1911"        => array("Goudy Bookletter 1911","Goudy Bookletter 1911"),
				"Nobile"                       => array("Nobile","Nobile"),
				"Copse"                        => array("Copse","Copse"),
				"Lobster"                      => array("Lobster","Lobster"),
				"Allerta+Stencil"              => array("Allerta Stencil","Allerta Stencil"),
				"Arimo"                        => array("Arimo","Arimo"),
				"Meddon"                       => array("Meddon","Meddon"),
				"Dancing+Script"               => array("Dancing Script","Dancing Script"),
				"Just+Me+Again+Down+Here"      => array("Just Me Again Down Here","Just Me Again Down Here"),
				"Amaranth"                     => array("Amaranth","Amaranth"),
				"Anonymous+Pro"                => array("Anonymous Pro","Anonymous Pro"),
				"Kreon"                        => array("Kreon","Kreon"),
				"Carter+One"                   => array("Carter One","Carter One")				
				);
	
	//Available Social Media Icons
	public $social_media_icons=array(
				"RSS"         => "rss",
				"Email"       => "email_icon",
				"Twitter"     => "twitter",
				"Flickr"      => "flickr",
				"Facebook"    => "facebook", 
				"AIM"         => "aim",
				"Apple"       => "apple",
				"Appstore"    => "appstore",
				"Bing"        => "bing",
				"Blogger"     => "blogger",
				"Bookmark"    => "bookmark",
				"Delicious"   => "delicious",
				"Deviantart"  => "deviantart",
				"Digg"        => "digg",
				"Dribble"     => "dribble", 
				"Evernote"    => "evernote",
				"Feedburner"  => "feedburner",
				"Forrst"      => "forrst",
				"Friendfeed"  => "friendfeed",
				"Google Plus" => "googleplus",
				"Google"      => "google",
				"Google Buzz" => "googlebuzz",
				"GTalk"       => "gtalk",
				"Lastfm"      => "lastfm",
				"Linkedin"    => "linkedin",
				"Messenger"   => "messenger",
				"Myspace"     => "myspace",
				"Reddit"      => "reddit", 
				"Skype"       => "skype",
				"Technorati"  => "technorati", 
				"Vimeo"       => "vimeo",
				"Yahoo"       => "yahoo",
				"YouTube"     => "youtube",
				"Pinterest"   => "pinterest"
				);
				

	function start($v){
		
		global $fonts,$google_fonts,$social_media_icons,$RTThemePageLayoutOptionsClass;
		$fonts 				= $this->fonts;
		$google_fonts 			= $this->google_fonts;
		$social_media_icons 	= $this->social_media_icons;

		// Load text domain
		load_theme_textdomain('rt_theme', get_template_directory().'/languages' );

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
		if( is_admin() ){		
			require_once (THEMEFRAMEWORKDIR.'/classes/admin.php'); 
			$RTadmin = new RTThemeAdmin();
			$RTadmin -> admin_init();

			//Save Default Options - First time loading or options resetted
			$this_page_url='http://'.$_SERVER['HTTP_HOST'].''.$_SERVER['SCRIPT_NAME'];
			$option_page_url=WPADMINURI.'admin.php'; 
			

			if( get_option(THEMESLUG.'_'.UTHEMENAME.'_defaults')!='saved' || ( isset($_GET['reset_settings']) && $_GET['reset_settings']=='true' ) && current_user_can( 'manage_options' ) ){ 
				
				//reset options
				$this->rt_save_defaults($RTadmin);

				//create default templates		
				$RTThemePageLayoutOptionsClass->rt_create_default_templates();

				if(isset($_GET['reset_settings']) && $_GET['reset_settings']=='true') add_action('admin_notices', array(&$this,'reset_message')); 		
			}
 
	 		//activate revslider 
			add_action( 'tgmpa_register', array(&$this,'activate_revslider'));		

		}

		//check woocommerce
		if ( class_exists( 'Woocommerce' ) ) {
			include(THEMEFRAMEWORKDIR . "/functions/woo-integration.php");
		}
		
		//Ajax Contact Form 
		add_action('wp_ajax_rt_ajax_contact_form', array(&$this,'rt_ajax_contact_form'));
		add_action('wp_ajax_nopriv_rt_ajax_contact_form', array(&$this,'rt_ajax_contact_form'));

		//Ajax Product Scroller 
		add_action('wp_ajax_rt_ajax_product_scroller', array(&$this,'rt_ajax_product_scroller'));
		add_action('wp_ajax_nopriv_rt_ajax_product_scroller', array(&$this,'rt_ajax_product_scroller'));
		 
	}
	
	#
	# Paging fix for custom post archives 
	#
	
	function fix_content( $content )
	{
		$content = str_replace('<p><br class="clear" /></p>', "<div class='clear'></div>", trim($content));
		$content = str_replace('<p></p>', "", trim($content));
		return $content;
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
		
		$your_web_site_name=trim(get_bloginfo('name')); 
		$your_email = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($your_web_site_name), base64_decode(trim($_POST['your_email'])), MCRYPT_MODE_CBC, md5(md5($your_web_site_name))), "\0");
		
		//texts
		$text_1 = __('Thanks','rt_theme');
		$text_2 = __('Your email was successfully sent. We will be in touch soon.','rt_theme');
		$text_3 = __('There was an error submitting the form.','rt_theme');
		$text_4 = __('Please enter a valid email address!','rt_theme');
		$text_5 = __('Are you human? quiz error: Please make sure that the sum of the two numbers is correct!','rt_theme');

		//If the form is submitted
		if(isset($_POST['name'])) {

			//Check the sum of the numbers
			if(isset($_SESSION['are_you_human_sum'])){
				if(trim($_POST['math']) != '' &&  ($_SESSION['are_you_human_sum'] !=  trim($_POST['math']))) {					
					$hasError = true;
					$errorMessage = $text_5;
				}
			}else{
					$hasError = true;
					$errorMessage = $text_5;
			}

			//Check to make sure that the name field is not empty
			if(trim($_POST['name']) === '') {
				$hasError = true;
			} else {
				$name = trim($_POST['name']);
			}
			
			//Check to make sure sure that a valid email address is submitted
			if(trim($_POST['email']) === '')  {
				$hasError = true;
			} else if (!preg_match('^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$^', trim($_POST['email']))) {
				$hasError = true;
				$errorMessage = $text_4;
			} else {
				$email = trim($_POST['email']);
			}
	
			//phone
			if(isset($_POST['phone'])) $phone = trim($_POST['phone']);
			
			//company name
			if(isset($_POST['company_name'])) $company_name = trim($_POST['company_name']);
	
			//company url
			if(isset($_POST['company_url'])) $company_url = trim($_POST['company_url']);		
				
			//Check to make sure comments were entered	
			if(trim($_POST['message']) === '') {
				$hasError = true;
			} else {
				if(function_exists('stripslashes')) {
					$comments = stripslashes(trim($_POST['message']));
				} else {
					$comments = trim($_POST['message']);
				}
			}
	
			//If there is no error, send the email
			if(!isset($hasError)) {
	
				$emailTo = $your_email;

				$subject = __('Contact Form Submission from' , 'rt_theme').' '.$name;
				
				//message body 
				$body  = __('Name' , 'rt_theme').": $name \n\n";
				$body .= __('Email' , 'rt_theme').": $email \n\n";
				if(isset($phone)) $body .= __('Phone' , 'rt_theme').": $phone \n\n"; 
				if(isset($company_name)) $body .= __('Company Name' , 'rt_theme').": $company_name \n\n"; 
				if(isset($company_url)) $body .= __('Company Url' , 'rt_theme').": $company_url \n\n";
				$body .= __('Message' , 'rt_theme').": $comments \n\n";
	
				$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
				
				wp_mail($emailTo, $subject, $body, $headers); 
				$emailSent = true;
			}

			//dynamic form class
			if(isset($_POST['dynamic_class'])) $dynamic_class = trim($_POST['dynamic_class']);			
		} 
		
		if(isset($emailSent) == true) {
		echo '
			<div class="ok_box">
				<h3>'.$text_1.', '.$name.'</h3>
				<p>'.$text_2.'</p>
				<script>
					jQuery(document).ready(function(){ 
						jQuery(".'.$dynamic_class.'").find("input,textarea").attr("disabled", "disabled");
						jQuery(".'.$dynamic_class.'").find(".button").remove();
					});
				</script>
			</div>
		';
		//reset sum
		unset($_SESSION['are_you_human']);
		}
		
		if(isset($hasError) ) {
		echo '
			<div class="error_box">
				'.$text_3.'
				<br />
				'.@$errorMessage.'
			</div>
		';
		}

		die();
	} 

	#
	# Frontend Ajax URL
	#

	function frontend_ajaxurl() {
		$admin_ajax_url = admin_url('admin-ajax.php');
		echo '<script type="text/javascript">';
		echo 'var ajaxurl = "'.$admin_ajax_url.'"; ';
		echo '</script>';
	} 


	#
	#	Messages
	#
	
	function reset_message(){
		echo '<div id="notice" class="error"><p>'.__('theme options has been resetted.', 'rt_theme_admin').'</p></div>';
	}   
    
    
	#
	#	Theme Constants
	#
    
	function theme_constants($v) {
		define('THEMENAME', $v['theme']);
		define('THEMESLUG', $v['slug']);
		define('THEMEVERSION', $v['version']); 
		define('THEMEDIR', get_template_directory());
		define('THEMEURI', get_template_directory_uri());
	
		if(function_exists('icl_get_home_url')){
		   define('BLOGURL', icl_get_home_url());
		}else{
		    define('BLOGURL', home_url() );  
		}
	
		define('FRAMEWORKSLUG', 'rt-framework'); 
		define('THEMEFRAMEWORKDIR', get_template_directory().'/rt-framework'); 
		define('THEMEADMINDIR', get_template_directory().'/rt-framework/admin');
		define('THEMEADMINURI', get_template_directory_uri().'/rt-framework/admin');
		define('WPADMINURI', get_admin_url());
		define('BLOGPAGE', get_option('rttheme_blog_page'));
		define('PRODUCTPAGE', get_option('rttheme_product_list'));
		define('PORTFOLIOPAGE', get_option('rttheme_portf_page'));
		define('CONTACTPAGE', get_option('rttheme_contact_page'));
		define('THEMESTYLE', get_option(THEMESLUG."_style"));

		// Constants for notifier
		define( 'NOTIFIER_THEME_FOLDER_NAME', 'rttheme17' );  
		define( 'NOTIFIER_XML_FILE', 'http://templatemints.com/theme_updates/rttheme17/notifier.xml' ); 
		define( 'NOTIFIER_CACHE_INTERVAL', 21600 );
		
		//unique theme name for default settings
		define('UTHEMENAME', "RTTHEME17");
			
	}    
    
	#
	#	Load Functions
	#
    
	function load_functions($v) {
		include(THEMEFRAMEWORKDIR . "/functions/common_functions.php");		
		include(THEMEFRAMEWORKDIR . "/functions/rt_comments.php");
		include(THEMEFRAMEWORKDIR . "/functions/custom_posts.php");
		include(THEMEFRAMEWORKDIR . "/functions/theme_functions.php");
		include(THEMEFRAMEWORKDIR . "/functions/rt_breadcrumb.php");
		include(THEMEFRAMEWORKDIR . "/functions/rt_shortcodes.php");		
		include(THEMEFRAMEWORKDIR . "/functions/wpml_functions.php");
		include(THEMEFRAMEWORKDIR . "/functions/custom_styling.php");
		include(THEMEFRAMEWORKDIR . "/plugins/vt_resize.php");		
		include(THEMEFRAMEWORKDIR . "/plugins/class-tgm-plugin-activation.php");				

		if(!function_exists('dropdown_menu')){		
			include(THEMEFRAMEWORKDIR . "/plugins/dropdown-menus.php");
		}
	}

	#
	#	Load Classes
	#
    
	function load_classes($v) {
		
		//Create Sidebars
		include(THEMEFRAMEWORKDIR . "/classes/sidebar_creator.php");  
		$createSidebars = new RT_Create_Sidebars(); 
		
		//is login or register page		
		$is_login = in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ));

		//Theme
		if(!is_admin() && !$is_login){
			require_once (THEMEFRAMEWORKDIR.'/classes/theme.php'); 
			$RTThemeSite = new RTThemeSite();
			$RTThemeSite -> theme_init();

			//Navigation Walker
			include(THEMEFRAMEWORKDIR . "/classes/navigation_walker.php");		
		} 

		//Common Classes
		include(THEMEFRAMEWORKDIR . "/classes/common_classes.php");   
		
	}    	 

	#
	#	Load Widgets
	#
    
	function load_widgets($v) { 

		if ( ! class_exists( 'Flickr_Widget' ) ) {
			//flickr
			include(THEMEFRAMEWORKDIR . "/widgets/flickr.php");		
			register_widget('Flickr_Widget');
		}

		if ( ! class_exists( 'Latest_Posts' ) ) {
			//recent posts with thumbnails
			include(THEMEFRAMEWORKDIR . "/widgets/latest_posts.php");		
			register_widget('Latest_Posts');
		}

		if ( ! class_exists( 'Popular_Posts' ) ) {
			//popular posts
			include(THEMEFRAMEWORKDIR . "/widgets/popular_posts.php");		
			register_widget('Popular_Posts');
		}

		if ( ! class_exists( 'Contact_Info' ) ) {			
			//contact info
			include(THEMEFRAMEWORKDIR . "/widgets/contact_info.php");		
			register_widget('Contact_Info');
		}

		if ( ! class_exists( 'Testimonials' ) ) {	
			//testimonials
			include(THEMEFRAMEWORKDIR . "/widgets/testimonials.php");		
			register_widget('Testimonials');
		}

		if ( ! class_exists( 'RT_Products' ) ) {	
			//testimonials
			include(THEMEFRAMEWORKDIR . "/widgets/products.php");		
			register_widget('RT_Products');
		}

	}
	
	
	#
	#	Save Default Values	
	#
	
	function rt_save_defaults($RTadmin) {
	
		if(is_array($RTadmin->panel_pages)){
			foreach($RTadmin->panel_pages  as $menu_slug => $page_title){
				
				if($menu_slug!="rt_sidebar_options" && $menu_slug!="rt_template_options" && $menu_slug!="rt_setup_assistant" ){			
					include(THEMEADMINDIR . "/options/$menu_slug.php");
		
					if(is_array($options)){
						foreach($options as $k => $v){
							if(@$v['default'] && @!$v['dont_save']) {
								update_option( @$v['id'], stripslashes(@$v['default']));
							}else{
								update_option( @$v['id'], '' );
							}
						}
					}
					
					update_option(THEMESLUG.'_'.UTHEMENAME.'_defaults','saved');
				}
			} 
		} 
	}
	
	#
	#	Create WP Menus
	#

	function rt_create_menus() {
		
		register_nav_menu( 'rt-theme-main-navigation', __( 'RT Theme Main Navigation' , 'rt_theme_admin') ); 
		register_nav_menu( 'rt-theme-footer-navigation', __( 'RT Theme Footer Navigation' , 'rt_theme_admin' )); 
		
		wp_create_nav_menu( 'RT Theme Main Navigation Menu', array( 'slug' => 'rt-theme-main-navigation' ) );
		wp_create_nav_menu( 'RT Theme Footer Navigation Menu', array( 'slug' => 'rt-theme-footer-navigation') );
 	
	}

	#
	#	Theme Supports
	#
	 
	function theme_supports(){
		//Featured Images
		add_theme_support( 'post-thumbnails', array('slider','home_page','page','product') );
		 
		//Automatic Feed Links
		add_theme_support( 'automatic-feed-links' );
		

		//Hide WP 3.6 Post Format UI
		global $wp_version;
		if (version_compare($wp_version,"3.5.1",">")){	
			add_filter( 'enable_post_format_ui', '__return_false' );
		}

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
		 

		$product_categories = get_terms( 'product_categories',  'order=ASC&orderby=name&hide_empty=0&hierarchical=1' );

		$rt_product_getcat = array();
		
		if(is_array($product_categories)){
			foreach ($product_categories as $category_list ) {
				@$rt_product_getcat[$category_list->term_id] = @$category_list->name;
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
				@$rt_portfolio_getcat[$category_list->cat_ID] = @$category_list->cat_name;
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
	#	Get Home Contents
	#

	public static function rt_get_homecontents(){

			$home_page=array(
			    'post_type'=> 'home_page',
			    'post_status'=> 'publish',
			    'ignore_sticky_posts'=>1,
			    'showposts' => 1000,
			    'orderby'=> 'date',
			    'order' => 'ASC',
			    'cat' => -0,
			);
		
		
		
		$home_contents  = query_posts($home_page);
		
		
		$rt_get_homepage_posts= array();
		
		if(is_array($rt_get_homepage_posts)){
			foreach ($home_contents as $spost_list ) {	// add product posts to the list
				$rt_get_homepage_posts[$spost_list->ID] = $spost_list ->post_title;
			}
		}

		wp_reset_query();
		return $rt_get_homepage_posts;
		
	}

	#
	#	Get Slider Contents
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
	#	Include RevSlider plugin
	#
	function activate_revslider() { 
 
		//activate revslider 
			    $plugins = array(
			  
			        array(
			            'name'                  => 'Revolution Slider', // The plugin name
			            'slug'                  => 'revslider', // The plugin slug (typically the folder name)
			            'source'                => THEMEFRAMEWORKDIR . '/plugins/packages/revslider.zip', // The plugin source
			            'required'              => true, // If false, the plugin is only 'recommended' instead of required
			            'version'               => '4.6.93', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			            'external_url'          => '', // If set, overrides default API URL and points to an external URL
			        ) 
			 
			    );
			 
			    // Change this to your theme text domain, used for internationalising strings
			    $theme_text_domain = 'rt_theme_admin';
			 
			    /**
			     * Array of configuration settings. Amend each line as needed.
			     * If you want the default strings to be available under your own theme domain,
			     * leave the strings uncommented.
			     * Some of the strings are added into a sprintf, so see the comments at the
			     * end of each line for what each argument will be.
			     */
			    $config = array(
			        'domain'            => 'rt_theme_admin',           // Text domain - likely want to be the same as your theme.
			        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
			        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
			        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
			        'menu'              => 'install-required-plugins',   // Menu slug
			        'has_notices'       => true,                         // Show admin notices or not
			        'is_automatic'      => true,            // Automatically activate plugins after installation or not
			        'message'           => '',               // Message to output right before the plugins table
			        'strings'           => array(
			            'page_title'                                => __( 'Install Required Plugins', 'rt_theme_admin' ),
			            'menu_title'                                => __( 'Install Plugins', 'rt_theme_admin' ),
			            'installing'                                => __( 'Installing Plugin: %s', 'rt_theme_admin' ), // %1$s = plugin name
			            'oops'                                      => __( 'Something went wrong with the plugin API.', 'rt_theme_admin' ),
			            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.<br /> Please check <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> / How to update Slider Revolution plugin? section to learn how to do it.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			            'return'                                    => __( 'Return to Required Plugins Installer', 'rt_theme_admin' ),
			            'plugin_activated'                          => __( 'Plugin activated successfully.', 'rt_theme_admin' ),
			            'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'rt_theme_admin' ) // %1$s = dashboard link
			        )
			    );
			 
			    tgmpa( $plugins, $config );
	}

 
}


?>