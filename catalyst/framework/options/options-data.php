<?php
/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Pull all Google Fonts using API into an array
	require ( MTHEME_PARENTDIR . '/framework/options/google-fonts.php');
	//$fontArray = unserialize($fontsSeraliazed);
	$google_font_array = json_decode ($google_api_output,true) ;
	//print_r( json_decode ($google_api_output) );
	
	$items = $google_font_array['items'];

	$home_b1_status=" - (empty)";
	$home_b2_status=" - (empty)";
	$home_b3_status=" - (empty)";
	$home_b4_status=" - (empty)";
	if (of_get_option('home_custom_block1')!="" ) $home_b1_status ="";
	if (of_get_option('home_custom_block2')!="" ) $home_b2_status ="";
	if (of_get_option('home_custom_block3')!="" ) $home_b3_status ="";
	if (of_get_option('home_custom_block4')!="" ) $home_b4_status ="";
	
	$sidebar_message="Enter a name to active sidebar";
	
	$options_fonts=array();
	array_push($options_fonts, "Default Font");
	$fontID = 0;
	foreach ($items as $item) {
		$fontID++;
		$variants='';
		$variantCount=0;
		foreach ($item['variants'] as $variant) {
			$variantCount++;
			if ($variantCount>1) { $variants .= '|'; }
			$variants .= $variant;
		}
		$variantText = ' (' . $variantCount . ' Varaints' . ')';
		if ($variantCount <= 1) $variantText = '';
		$options_fonts[ $item['family'] . ':' . $variants ] = $item['family']. $variantText;
	}

	
	// Pull all the categories into an array
	$options_categories = array(); 
	array_push($options_categories, "All Categories");
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	if ($options_pages_obj) {
		foreach ($options_pages_obj as $page) {
			$options_pages[$page->ID] = $page->post_title;
		}
	}
	
	// Pull all the Featured into an array
	$featured_pages = get_posts('post_type=mtheme_featured&orderby=title&numberposts=-1&order=ASC');
	if ($featured_pages) {
		foreach($featured_pages as $key => $list) {
			$custom = get_post_custom($list->ID);
			if ( isset($custom["fullscreen_type"][0]) ) { 
				$slideshow_type=' ('.$custom["fullscreen_type"][0].')'; 
			} else {
			$slideshow_type="";
			}
			$options_featured[$list->ID] = $list->post_title . $slideshow_type;
		}
	} else {
		$options_featured[0]="Featured pages not found.";
	}
	
	// Pull all the Featured into an array
	$bg_slideshow_pages = get_posts('post_type=mtheme_featured&orderby=title&numberposts=-1&order=ASC');
	if ($bg_slideshow_pages) {
		foreach($bg_slideshow_pages as $key => $list) {
			$custom = get_post_custom($list->ID);
			if ( isset($custom["fullscreen_type"][0]) ) { 
				$slideshow_type=$custom["fullscreen_type"][0]; 
			} else {
			$slideshow_type="";
			}
			if ($slideshow_type<>"Fullscreen-Video") {
				$options_bgslideshow[$list->ID] = $list->post_title;
			}
		}
	} else {
		$options_bgslideshow[0]="Featured pages not found.";
	}
	
	// Pull all the Portfolio into an array
	$portfolio_pages = get_posts('post_type=mtheme_portfolio&orderby=title&numberposts=-1&order=ASC');
	if ($portfolio_pages) {
		foreach($portfolio_pages as $key => $list) {
			$custom = get_post_custom($list->ID);
			$portfolio_list[$list->ID] = $list->post_title;
		}
	}

	// Pull all the Portfolio Categories into an array
	$the_list = get_categories('taxonomy=types&title_li=');
	
	if ($the_list) {
		$portfolio_categories=array();
		$portfolio_categories[0]="All the items";
		foreach($the_list as $key => $list) {
			$portfolio_categories[$list->slug] = $list->name;
		}
	} else {
		$portfolio_categories[0]="Portfolio Categories not found.";
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/framework/options/images/';
	$theme_imagepath =  get_template_directory_uri() . '/images/';
		
	$options = array();
		
$options[] = array( "name" => __("General Settings"),
	"sectionID" => "main-section",
	"type" => "heading");
	
	$options[] = array(  
		"name" => __("Theme Style"),
		"desc" => __("Select type of theme, either dark or light."),
		"id" => "theme_style",
		"std" => 'default',
		"options" => array(
			"light" => "Light",
			"dark" => "Dark",
		),
		"type" => "select"
	);
	
	$options[] = array(  
		"name" => __("Mainpage Type"),
		"desc" => __("Type of Mainpage you'd like for the layout. Bloglist will give you the featured slides along with a list of blog posts below the featured slides. You can over-ride this and use one of the Mainpage templates provided with the theme. For this you'll need to Creat a Page using one of the mainpage templates and Set the page as a Static Front page.<p>Please refer to the Help Guide in creating Page Templates. The Catalyst demo shows the mainpage styles listed under the Home dropdown menu.</p>"),
		"id" => "mainpage_type",
		"std" => 'default',
		"options" => array(
			"default" => "Default",
			"bloglist" => "Bloglist",
		),
		"type" => "select"
	);
	
	$options[] = array(  
		"name" => __("Email for Contact form"),
		"desc" => __("Email address for your contact form template provided with the theme. You'll need to create a Page and select the Contact template and publish. This will populate a contact form to the page. <p>Anything you type in the Contact Page contents area will be shown beside the form.</p>"),
		"id" => "email",
		"std" => "",
		"size" => '40',
		"type" => "text"
	);
	
$options[] = array( "name" => "Theme Background",
	"sectionID" => "theme-skinsettings-section",
	"type" => "heading");

	$options[] = array(  
		"name" => __("Background Pattern"),
		"desc" => __("Set a background for your theme. You can choose a Pattern or Texture to fill the background. The patterns are translucent and can be combined with your choice of color to generate interesting combinations. You can also set Pattern to None to generate a solid color."),
		"id" => "theme_bg_pattern",
		"std" => 'none',
		"options" => array(
			"none" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/none.png',
			"pattern1.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern1.png',
			"pattern2.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern2.png',
			"pattern3.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern3.png',
			"pattern4.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern4.png',
			"pattern5.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern5.png',
			"pattern6.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern6.png',
			"pattern7.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern7.png',
			"pattern8.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern8.png',
			"pattern9.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern9.png',
			"pattern10.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern10.png',
			"pattern11.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern11.png',
			"pattern12.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern12.png',
			"pattern13.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern13.png',
			"pattern14.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern14.png',
			"pattern15.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern15.png',
			"pattern16.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern16.png',
			"pattern17.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern17.png',
			"pattern18.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern18.png',
			"pattern19.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern19.png',
			"pattern20.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern20.png',
			"pattern21.png" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/pattern21.png',
			"darkwood.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/darkwood.png',
			"wood.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/wood.png',
			"grains1.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/grains1.png',
			"rainbow.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/rainbow.png',
			"sand.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/sand.png',
			"metal1.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/metal1.png',
			"metal2.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/metal2.png',
			"paint1.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/paint1.png',
			"paint2.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/paint2.png',
			"paint3.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/paint3.png',
			"paint4.jpg" =>  MTHEME_PATH . '/images/backgrounds/thumbnails/paint4.png',
		),
		"type" => "images"
	);
	

	$options[] = array(
		"name" => __("Background Color"),
		"desc" => __("Set a background color for your theme. You can choose none for the Pattern to generate a solid colored background"),
		"id" => "theme_bg_color",
		"std" => "",
		"type" => "color"
	);
	
$options[] = array( "name" => "Logo Settings",
	"sectionID" => "head-logo-section",
	"type" => "heading");

	$options[] = array(
		"name" => __("Custom Logo"),
		"desc" => __("Upload a Logo image for your theme."),
		"id" => "logo",
		"std" => "",
		"type" => "upload"
	);
	
	$options[] = array(
		"name" => __("Logo top space"),
		"desc" => __("Adjust left spacing for your logo."),
		"id" => "logo_top_spacing",
		"min" => "0",
		"max" => "100",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "50",
		"type" => "text"
	);
	
	$options[] = array(
		"name" => __("Logo left space"),
		"desc" => __("Adjust left spacing for your logo."),
		"id" => "logo_left_spacing",
		"min" => "0",
		"max" => "100",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "40",
		"type" => "text"
	);
	
$options[] = array( "name" => "Font Settings",
	"sectionID" => "head-font-section",
	"type" => "heading");

	$options[] = array(
		"name" => __("Toggle Cufon font Substitution"),
		"desc" => __("Switch On and Off Cufon font substitutions throughout the theme. This removes cufon libraries, initializers and font loaders."),
		"id" => "cufon_status",
		"std" => 1,
		"type" => "checkbox"
	);

	$options[] = array(
		"name" =>"Title Font",
		"desc" => __("Choose from a variety of Cufon fonts."),
		"id" => "theme_font",
		"std" => 'cabin',
		"options" => array(
			"cabin" => MTHEME_PATH . "/js/font/samples/cabin.png",
			"pacifico" => MTHEME_PATH . "/js/font/samples/pacifico.png",
			"singlet" => MTHEME_PATH . "/js/font/samples/singlet.png",
			"indieflower" => MTHEME_PATH . "/js/font/samples/indieflower.png",
			"raleway" => MTHEME_PATH . "/js/font/samples/raleway.png",
			"pt_sans" =>  MTHEME_PATH . "/js/font/samples/pt_sans.png",
			"waitingforthesun" => MTHEME_PATH . "/js/font/samples/waitingforthesun.png",
			"playfair" => MTHEME_PATH . "/js/font/samples/playfair.png",
			"holtwood" => MTHEME_PATH . "/js/font/samples/holtwood.png",
			"open_sans" =>  MTHEME_PATH . "/js/font/samples/open_sans.png",
			"artifika" =>  MTHEME_PATH . "/js/font/samples/artifika.png",
			"paytone" => MTHEME_PATH . "/js/font/samples/paytone.png",
			"limelight" => MTHEME_PATH . "/js/font/samples/limelight.png",
			"quicksand" => MTHEME_PATH . "/js/font/samples/quicksand.png",
			"imperator" => MTHEME_PATH . "/js/font/samples/imperator.png",
			"titillium" => MTHEME_PATH . "/js/font/samples/titillium.png",
			"vegur" => MTHEME_PATH . "/js/font/samples/vegur.png",
			"luna" => MTHEME_PATH . "/js/font/samples/luna.png",
			"greyscale" => MTHEME_PATH . "/js/font/samples/grayscale.png",
			"chunkfive" => MTHEME_PATH . "/js/font/samples/chunkfive.png",
			"sansation" => MTHEME_PATH . "/js/font/samples/sansation.png",
			"oswald" => MTHEME_PATH . "/js/font/samples/oswald.png",
			"segan" => MTHEME_PATH . "/js/font/samples/segan.png",
			"custom_font" => MTHEME_PATH . "/js/font/samples/custom.png",
		),
		"type" => "images"
	);
	
	$options[] = array(  
		"name" => __("For custom Cufon JS font path"),
		"desc" => __("You can use http://cufon.shoqolate.com/generate/ to generate your own cufon font for the theme. After you generate a cufon font you can upload and enter its path here."),
		"id" => "custom_theme_font",
		"std" => "",
		"type" => "upload"
	);
	
$options[] = array( "name" => "Header Social links",
	"sectionID" => "head-social-section",
	"type" => "heading");

	$options[] = array(
		"name" => __("Display this section"),
		"desc" => __("Toggle section On and Off from the homepage"),
		"id" => "section_social_status",
		"std" => 1,
		"type" => "checkbox"
	);

	$options[] = array(  
		"name" => __("Social Link 1"),
		"desc" => __("Upload an image for the header social links , ideal dimensions are 16 pixel by 16 pixels. The tooltip text you enter in the Tool Tip input field will appear on hover over the icon. The Social link is the target link for your icon"),
		"id" => "icon_image_1",
		"std" => MTHEME_PATH . "/images/socialheader/twitter.png",
		"type" => "upload"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Tool tip text #1"),
		"id" => "tooltip_text_1",
		"std" => "Twitter",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Target link path #1"),
		"id" => "target_link_1",
		"std" => "#",
		"size" => '80',
		"type" => "text"
	);
	
		$options[] = array(  
			"name" => __("Social Link 2"),
			"desc" => __("Icon image path #2 (16px x 16px recommended)"),
			"id" => "icon_image_2",
			"std" => "",
			"type" => "upload"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Tool tip text #2"),
			"id" => "tooltip_text_2",
			"std" => "",
			"size" => '40',
			"type" => "text"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Target link path #2"),
			"id" => "target_link_2",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	$options[] = array(  
		"name" => __("Social Link 3"),
		"desc" => __("Icon image path #3 (16px x 16px recommended)"),
		"id" => "icon_image_3",
		"std" => "",
		"type" => "upload"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Tool tip text #3"),
		"id" => "tooltip_text_3",
		"std" => "",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Target link path #3"),
		"id" => "target_link_3",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		$options[] = array(  
			"name" => __("Social Link 4"),
			"desc" => __("Icon image path #4 (16px x 16px recommended)"),
			"id" => "icon_image_4",
			"std" => "",
			"type" => "upload"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Tool tip text #4"),
			"id" => "tooltip_text_4",
			"std" => "",
			"size" => '40',
			"type" => "text"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Target link path #4"),
			"id" => "target_link_4",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	$options[] = array(  
		"name" => __("Social Link 5"),
		"desc" => __("Icon image path #5 (16px x 16px recommended)"),
		"id" => "icon_image_5",
		"std" => "",
		"type" => "upload"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Tool tip text #5"),
		"id" => "tooltip_text_5",
		"std" => "",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Target link path #5"),
		"id" => "target_link_5",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		$options[] = array(  
			"name" => __("Social Link 6"),
			"desc" => __("Icon image path #6 (16px x 16px recommended)"),
			"id" => "icon_image_6",
			"std" => "",
			"type" => "upload"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Tool tip text #6"),
			"id" => "tooltip_text_6",
			"std" => "",
			"size" => '40',
			"type" => "text"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Target link path #6"),
			"id" => "target_link_6",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	$options[] = array(  
		"name" => __("Social Link 7"),
		"desc" => __("Icon image path #7 (16px x 16px recommended)"),
		"id" => "icon_image_7",
		"std" => "",
		"type" => "upload"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Tool tip text #7"),
		"id" => "tooltip_text_7",
		"std" => "",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Target link path #7"),
		"id" => "target_link_7",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		$options[] = array(  
			"name" => __("Social Link 8"),
			"desc" => __("Icon image path #8 (16px x 16px recommended)"),
			"id" => "icon_image_8",
			"std" => "",
			"type" => "upload"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Tool tip text #8"),
			"id" => "tooltip_text_8",
			"std" => "",
			"size" => '40',
			"type" => "text"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Target link path #8"),
			"id" => "target_link_8",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	$options[] = array(  
		"name" => __("Social Link 9"),
		"desc" => __("Icon image path #9 (16px x 16px recommended)"),
		"id" => "icon_image_9",
		"std" => "",
		"type" => "upload"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Tool tip text #9"),
		"id" => "tooltip_text_9",
		"std" => "",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Target link path #9"),
		"id" => "target_link_9",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		$options[] = array(  
			"name" => __("Social Link 10"),
			"desc" => __("Icon image path #10 (16px x 16px recommended)"),
			"id" => "icon_image_10",
			"std" => "",
			"type" => "upload"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Tool tip text #10"),
			"id" => "tooltip_text_10",
			"std" => "",
			"size" => '40',
			"type" => "text"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Target link path #10"),
			"id" => "target_link_10",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
$options[] = array( "name" => "Featured",
	"sectionID" => "featured-section",
	"type" => "heading");

	$options[] = array(
		"name" => __("Display this section"),
		"help" => __("Toggle section On and Off from the homepage"),
		"id" => "section_featured_status",
		"std" => 1,
		"type" => "checkbox"
	);

	$options[] = array(  
		"name" => __("Featured Slideshow Type"),
		"desc" => __("Select your featured slide style to display in the homepage"),
		"id" => "featured_slide_type",
		"std" => 'showcase',
		"options" => array(
			"showcase" => "Showcase Slider",
			"nivoslides" => "Nivo Slider",
			"accordion" => "Accordion",
			"video" => "Video block",
			"image" => "Static image",
		),
		"type" => "select"
	);
	
$options[] = array(  "name" => " - Showcase",
	"sectionID" => "featured-showcase",
	"type" => "heading");
	
	$options[] = array(
		"name" => __("Autoplay"),
		"desc" => __("Toggle section On and Off from the homepage"),
		"desc" => __("Set autoplay for showcase slides"),
		"id" => "featured_showcase_autoplay",
		"std" => 1,
		"type" => "checkbox"
	);
	
	$options[] = array(  
		"name" => __("Thumbnail position"),
		"desc" => __("Display thumbnails above or below the featured slides."),
		"id" => "featured_showcase_thumbnail",
		"std" => 'outside-last',
		"options" => array(
			"outside-last" => "Bottom",
			"outside-first" => "Top",
		),
		"type" => "select"
	);
	
	$options[] = array(
		"name" => __("Full image height"),
		"desc" => __("Adjust height of the image. Set in pixels."),
		"id" => "featured_showcase_height",
		"min" => "400",
		"max" => "900",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "530",
		"type" => "text"
	);
	
	$options[] = array(
		"name" => __("Display Arrows"),
		"desc" => __("Display navigation arrows to scroll the slides."),
		"id" => "featured_showcase_arrows",
		"std" => 1,
		"type" => "checkbox"
	);
	
	$options[] = array(
		"name" => __("Display Title"),
		"desc" => __("Display title over the slides."),
		"id" => "featured_showcase_title",
		"std" => 1,
		"type" => "checkbox"
	);
	
	$options[] = array(
		"name" => __("Display Description"),
		"desc" => __("Display descriptions over the slides."),
		"id" => "featured_showcase_desc",
		"std" => 1,
		"type" => "checkbox"
	);
	
	$options[] = array(  
		"name" => __("Transition Type"),
		"desc" => __("Type of transition your want for the slide. Either horizontal, vertical or fade slide."),
		"id" => "featured_showcase_transition",
		"std" => 'hslide',
		"options" => array(
			"hslide" => "Horizontal Slide",
			"vslide" => "Vertical Slide",
			"fade" => "Fade Slide",
		),
		"type" => "select"
	);
	
	$options[] = array(
		"name" => __("Transition Speed"),
		"desc" => __("Transition speed of the slides."),
		"id" => "featured_showcase_transitionspeed",
		"min" => "200",
		"max" => "5000",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "500",
		"type" => "text"
	);
	
	$options[] = array(
		"name" => __("Delay between transitions"),
		"help" => __("Delay between slides transition."),
		"desc" => __("Delay between transitions of the slides"),
		"id" => "featured_showcase_transitiondelay",
		"min" => "2500",
		"max" => "10000",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "3000",
		"type" => "text"
	);
	
$options[] = array(  "name" => " - Nivo",
	"sectionID" => "featurednivo-section",
	"type" => "heading");
	
	$options[] = array(
		"name" => __("Autoplay"),
		"help" => __("Switch On / Off autoplay for Nivo featured slides."),
		"desc" => __("Set autoplay for nivo slides"),
		"id" => "featured_nivo_autoplay",
		"std" => 1,
		"type" => "checkbox"
	);
	
	$options[] = array(
		"name" => __("Display titles"),
		"help" => __("Toggle titles on Nivo slides"),
		"desc" => __("Display titles"),
		"id" => "featured_nivo_title",
		"std" => 1,
		"type" => "checkbox"
	);
	
	$options[] = array(
		"name" => __("Display descriptions"),
		"help" => __("Toggle descrriptions on Nivo Slides"),
		"desc" => __("Display descriptions"),
		"id" => "featured_nivo_desc",
		"std" => 1,
		"type" => "checkbox"
	);
	
	$options[] = array(  
		"name" => __("Transition style"),
		"help" => __("Transition type for the nivo slides"),
		"desc" => __("Transition style for nivo"),
		"id" => "featured_nivo_transition_style",
		"std" => 'boxRain',
		"options" => array(
			"random" => "random",
			"fold" => "fold",
			"fade" => "fade",
			"sliceUpLeft" => "sliceUpLeft",
			"sliceUpDown" => "sliceUpDown",
			"sliceDownLeft" => "sliceDownLeft",
			"sliceUpDownLeft" => "sliceUpDownLeft",
			"slideInRight" => "slideInRight",
			"slideInLeft" => "slideInLeft",
			"boxRandom" => "boxRandom",
			"boxRainGrow" => "boxRainGrow",
			"boxRainGrowReverse" => "boxRainGrowReverse"
		),
		"type" => "select"
	);
	
	$options[] = array(
		"name" => __("Transition Speed"),
		"help" => __("Transition speed from one slide to the other."),
		"desc" => __("Set transition speed for Nivo Slides"),
		"id" => "featured_nivo_transition_speed",
		"min" => "100",
		"max" => "1000",
		"step" => "100",
		"unit" => 'seconds',
		"std" => "500",
		"type" => "text"
	);
	
	$options[] = array(
		"name" => __("Pause time"),
		"help" => __("Pause time until next transition. Active on autoplay."),
		"desc" => __("Nivo Slide pause time if autoplay is On"),
		"id" => "featured_nivo_pausetime",
		"min" => "2500",
		"max" => "10000",
		"step" => "500",
		"unit" => 'seconds',
		"std" => "5000",
		"type" => "text"
	);
	
	$options[] = array(
		"name" => __("Nivo Slide Slices"),
		"help" => __("Number of slices for nivo slide transition."),
		"desc" => __("Nivo Slide slices"),
		"id" => "featured_nivo_slices",
		"min" => "5",
		"max" => "30",
		"step" => "1",
		"unit" => 'seconds',
		"std" => "15",
		"type" => "text"
	);
	
	$options[] = array(
		"name" => __("Box Columns"),
		"help" => __("Number of box columns used in transition box effects"),
		"desc" => __("Nivo Box columns"),
		"id" => "featured_nivo_box_cols",
		"min" => "5",
		"max" => "30",
		"step" => "1",
		"unit" => 'seconds',
		"std" => "10",
		"type" => "text"
	);
	
	$options[] = array(
		"name" => __("Box Rows"),
		"help" => __("Number of rows for box effect transitions."),
		"desc" => __("Nivo Box rows"),
		"id" => "featured_nivo_box_rows",
		"min" => "5",
		"max" => "30",
		"step" => "1",
		"unit" => 'seconds',
		"std" => "8",
		"type" => "text"
	);
	
	$options[] = array(
		"name" => __("Nivo Slide height"),
		"desc" => __("Nivo Slide height for the featured section"),
		"id" => "featured_nivo_height",
		"min" => "400",
		"max" => "900",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "610",
		"type" => "text"
	);
		
$options[] = array(  "name" => " - Accordion",
	"sectionID" => "featuredaccordion-section",
	"type" => "heading");
	
	$options[] = array(  
		"name" => __("Accordion slide amount"),
		"desc" => __("This is the number of slides for the accordion. When you set the number of slides they will adjust the accordion slides fit the space."),
		"id" => "featured_accordion_qty",
		"std" => '4',
		"options" => array(
			"2" => "2",
			"3" => "3",
			"4" => "4",
			"5" => "5",
			"6" => "6",
		),
		"type" => "select"
	);
	
	$options[] = array(
		"name" => __("Accordion height"),
		"desc" => __("Featured accordion slide height"),
		"id" => "featured_accordion_height",
		"min" => "400",
		"max" => "900",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "600",
		"type" => "text"
	);
	
	$options[] = array(
		"name" => __("Display titles"),
		"help" => __("Dsiplay titles for the accordion"),
		"desc" => __("Display titles"),
		"id" => "featured_accordion_title",
		"std" => 1,
		"type" => "checkbox"
	);
	
	$options[] = array(
		"name" => __("Display descriptions"),
		"help" => __("Display descriptions from the accordion"),
		"desc" => __("Display descriptions"),
		"id" => "featured_accordion_desc",
		"std" => 1,
		"type" => "checkbox"
	);
	
$options[] = array(  "name" => " - Static Video Block",
	"sectionID" => "featured-static-section",
	"type" => "heading");
	
	$options[] = array(  
		"name" => __("Video embed code for Video static block"),
		"desc" => __("You can provide embed code for the video in this section. Vimeo, youtube or other video sharing sites generates video embed codes. The recommended width is 960 pixels and height can be anything."),
		"id" => "featured_video",
		"std" => "",
		"cols" => '70',
		"rows" => '10',
		"type" => "textarea"
	);
		
$options[] = array( "name" => "Home Section A",
	"sectionID" => "home-section-a",
	"type" => "heading");

	$options[] = array(
		"name" => __("Display this section"),
		"desc" => __("Toggle section On and Off from the homepage. You can set the three step columns which are displayed just under the featured block from this section. Supply with an icon, title, description and link to target the title."),
		"id" => "section_a_status",
		"std" => 1,
		"type" => "checkbox"
	);

	$options[] = array(  
		"name" => __("Column A"),
		"desc" => __("Icon path"),
		"id" => "sa_col_a_icon",
		"std" => MTHEME_PATH . "/images/numbers/step_one.png",
		"type" => "upload"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Title"),
		"id" => "sa_col_a_title",
		"std" => "Customize",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Description"),
		"id" => "sa_col_a_desc",
		"std" => "Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Target link"),
		"id" => "sa_col_a_link",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		$options[] = array(  
			"name" => __("Column B"),
			"desc" => __("Icon path"),
			"id" => "sa_col_b_icon",
			"std" => MTHEME_PATH . "/images/numbers/step_two.png",
			"type" => "upload"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Title"),
			"id" => "sa_col_b_title",
			"std" => "Extensible",
			"size" => '40',
			"type" => "text"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Description"),
			"id" => "sa_col_b_desc",
			"std" => "Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.",
			"cols" => '70',
			"rows" => '5',
			"type" => "textarea"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Target link"),
			"id" => "sa_col_b_link",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	$options[] = array(  
		"name" => __("Column C"),
		"desc" => __("Icon path"),
		"id" => "sa_col_c_icon",
		"std" => MTHEME_PATH . "/images/numbers/step_three.png",
		"type" => "upload"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Title"),
		"id" => "sa_col_c_title",
		"std" => "Support",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Description"),
		"id" => "sa_col_c_desc",
		"std" => "Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Target link"),
		"id" => "sa_col_c_link",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);

$options[] = array( "name" => "Home Section B",
	"sectionID" => "home-section-b",
	"type" => "heading");

	$options[] = array(
		"name" => __("Display this section"),
		"desc" => __("Toggle this section On and Off from homepage. You can enter the Welcome text and button from the following."),
		"id" => "section_b_status",
		"std" => 1,
		"type" => "checkbox"
	);

	$options[] = array(  
		"name" => __("Welcome Title"),
		"desc" => __("Welcome title for the mainpage. This can be the important greeting on the mainpage."),
		"id" => "welcome_title",
		"std" => "Catalyst premium is an powerful theme to showcase your portfolio",
		"size" => '80',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __("Welcome Subtitle"),
		"desc" => __("Subtitle to go along with the Welcome title."),
		"id" => "welcome_subtitle",
		"std" => "Build and display your portfolio and creative works in a simple yet powerful theme",
		"size" => '80',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __("Button Text"),
		"help" => __("Text that will appear on the button"),
		"desc" => __("Enter text to display on the button"),
		"id" => "button_text",
		"std" => "Purchase",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __("Button Link"),
		"help" => __("Link for the button."),
		"desc" => __("Target link for you button"),
		"id" => "button_link",
		"std" => "#",
		"size" => '40',
		"type" => "text"
	);
	
$options[] = array( "name" => "Home Section C",
	"sectionID" => "home-section-c",
	"type" => "heading");

	$options[] = array(
		"name" => __("Display this section"),
		"help" => __("Toggle this section On and Off from homepage."),
		"desc" => __("Display this section from the home page"),
		"id" => "section_c_status",
		"std" => 1,
		"type" => "checkbox"
	);

	$options[] = array(  
		"name" => __("Mainpage Image Carousel"),
		"desc" => __("Choose either Pages or Categories of Posts to populate the mainpage carousel. If you choose Pages you will need a Page published with image attachments. You can follow the Help Guide provided with the theme to get more information on this. A Category of Posts can be any category of posts populated with featured images attached to the posts."),
		"id" => "sc_carousel_from",
		"std" => 'pages',
		"options" => array(
			"pages" => "Pages",
			"categories" => "Category of posts",
			"portfolio" => "Portfolio",
		),
		"type" => "select"
	);

	$options[] = array(
		"name" => "Select Page",
		"desc" => __("Select your Page with image attachments to populate the carousel."),
		"id" => "sc_carousel_page",
		"target" => 'page',
		"std" => "",
		"options" => $options_pages,
		"type" => "select",
	);
	
	$options[] = array(
		"name" => "Select Category",
		"desc" => __("This will populate a category of posts. Each image is taken from the post featured image. If you link directly it'll link to the post. Otherwise a lightbox will display the featured image in full."),
		"id" => "sc_carousel_category",
		"target" => 'category',
		"std" => "",
		"options" => $options_categories,
		"type" => "select",
	);
	
	$options[] = array(
		"name" => "Select Portfolio",
		"desc" => __("This will populate a portfolio category. Each image is taken from the post featured image. If you link directly it'll link to the post. Otherwise a lightbox will display the featured image in full."),
		"id" => "sc_carousel_portfolio",
		"target" => 'portfolio_category',
		"std" => "",
		"options" => $portfolio_categories,
		"type" => "select",
	);
	
	$options[] = array(  
		"name" => __("Limit images"),
		"help" => __("Limit the image displayed in the carousel as selected here."),
		"desc" => __("Set a limit to the number of images shown"),
		"id" => "sc_carousel_limit",
		"std" => '-1',
		"options" => array(
			"-1" => "Unlimited",
			"1" => "1",
			"2" => "2",
			"3" => "3",
			"4" => "4",
			"5" => "5",
			"6" => "6",
			"7" => "7",
			"8" => "8",
			"9" => "9",
			"10" => "10",
			"11" => "11",
			"12" => "12",
			"13" => "13",
			"14" => "14",
			"15" => "15",
			"20" => "20",
			"30" => "30",
		),
		"type" => "select"
	);
	
	$options[] = array(  
		"name" => __("Link Images"),
		"help" => __("Display the linked images to either the lightbox or link directly to the respective post or page."),
		"desc" => __("How to display the images"),
		"id" => "sc_carousel_link",
		"std" => 'lightbox',
		"options" => array(
			"lightbox" => "Lightbox",
			"direct" => "Direct",
		),
		"type" => "select"
	);
	
$options[] = array( "name" => "Home Section D",
	"sectionID" => "home-section-d",
	"type" => "heading");

	$options[] = array(
		"name" => __("Display this section"),
		"help" => __("Toggle On / Off this section from the homepage"),
		"desc" => __("Display this section from the home page"),
		"id" => "section_d_status",
		"std" => 1,
		"type" => "checkbox"
	);
	
	$options[] = array(
		"name" => __("Display the top row"),
		"help" => __("Switch off the top row leaving the bottom three blocks visible."),
		"desc" => __("Display top row of this section"),
		"id" => "sd_row_a_status",
		"std" => 1,
		"type" => "checkbox"
	);
	
	$options[] = array(
		"name" => __("Display the bottom row"),
		"help" => __("Switch off the bottom row leaving the top three blocks visible."),
		"desc" => __("Display bottom row of this section"),
		"id" => "sd_row_b_status",
		"std" => 1,
		"type" => "checkbox"
	);

	$options[] = array(  
		"name" => __("Column A (top left)"),
		"help" => __("Fill each of these blocks to display in the homepage. That is the 6 blocks which appear below the portfolio carousel"),
		"desc" => __("Icon path"),
		"id" => "sd_col_a_icon",
		"std" => MTHEME_PATH . "/images/icons/leaf.png",
		"type" => "upload"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Title"),
		"id" => "sd_col_a_title",
		"std" => "Advanced Options",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Description"),
		"id" => "sd_col_a_desc",
		"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Target link"),
		"id" => "sd_col_a_link",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		$options[] = array(  
			"name" => __("Column B (top mid)"),
			"desc" => __("Icon path"),
			"id" => "sd_col_b_icon",
			"std" => MTHEME_PATH . "/images/icons/flask.png",
			"type" => "upload"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Title"),
			"id" => "sd_col_b_title",
			"std" => "Multiple Portfolios",
			"size" => '40',
			"type" => "text"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Description"),
			"id" => "sd_col_b_desc",
			"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
			"cols" => '70',
			"rows" => '5',
			"type" => "textarea"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Target link"),
			"id" => "sd_col_b_link",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	$options[] = array(  
		"name" => __("Column E (top right)"),
		"desc" => __("Icon path"),
		"id" => "sd_col_extra_a_icon",
		"std" => MTHEME_PATH . "/images/icons/controls.png",
		"type" => "upload"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Title"),
		"id" => "sd_col_extra_a_title",
		"std" => "Content Objects",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Description"),
		"id" => "sd_col_extra_a_desc",
		"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Target link"),
		"id" => "sd_col_extra_a_link",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
		
		$options[] = array(  
			"name" => __("Column C (bottom left)"),
			"desc" => __("Icon path"),
			"id" => "sd_col_c_icon",
			"std" => MTHEME_PATH . "/images/icons/bulb.png",
			"type" => "upload"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Title"),
			"id" => "sd_col_c_title",
			"std" => "Post headers",
			"size" => '40',
			"type" => "text"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Description"),
			"id" => "sd_col_c_desc",
			"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
			"cols" => '70',
			"rows" => '5',
			"type" => "textarea"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Target link"),
			"id" => "sd_col_c_link",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
	
	$options[] = array(  
		"name" => __("Column D (bottom mid)"),
		"desc" => __("Icon path"),
		"id" => "sd_col_d_icon",
		"std" => MTHEME_PATH . "/images/icons/recycle.png",
		"type" => "upload"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Title"),
		"id" => "sd_col_d_title",
		"std" => "Gui Shortcodes",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Description"),
		"id" => "sd_col_d_desc",
		"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
	$options[] = array(  
		"name" => __(""),
		"desc" => __("Target link"),
		"id" => "sd_col_d_link",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		$options[] = array(  
			"name" => __("Column F (bottom right)"),
			"desc" => __("Icon path"),
			"id" => "sd_col_extra_b_icon",
			"std" => MTHEME_PATH . "/images/icons/mouse.png",
			"type" => "upload"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Title"),
			"id" => "sd_col_extra_b_title",
			"std" => "Page Templates",
			"size" => '40',
			"type" => "text"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Description"),
			"id" => "sd_col_extra_b_desc",
			"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
			"cols" => '70',
			"rows" => '5',
			"type" => "textarea"
		);
		
		$options[] = array(  
			"name" => __(""),
			"desc" => __("Target link"),
			"id" => "sd_col_extra_b_link",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);

$options[] = array( "name" => "Home Section E",
	"sectionID" => "home-section-e",
	"type" => "heading");

	$options[] = array(
		"name" => __("Display this section"),
		"help" => __("Toggle this section On and Off from the homepage"),
		"desc" => __("Display this section from the home page"),
		"id" => "section_e_status",
		"std" => 1,
		"type" => "checkbox"
	);

	$options[] = array(  
		"name" => __("Section F : Quote"),
		"help" => __("Quotation that appears at the lower most section of main page."),
		"desc" => __("Description"),
		"id" => "sf_quote",
		"std" => "Lorem ipsum dolor! Sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet.",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
$options[] = array(  "name" => "Blog",
	"sectionID" => "blog-section",
	"type" => "heading");

	$options[] = array(  
		"name" => __("List type"),
		"help" => __("Show full posts or summary in blog lists"),
		"desc" => __("How to display the post list"),
		"id" => "blog_list_type",
		"std" => 'summary',
		"options" => array(
			"summary" => "Summary",
			"full" => "Full post",
		),
		"type" => "select"
	);
	
	$options[] = array(
		"name" => __("Display Author Info"),
		"help" => __("Display author info after blog posts. You'll need to fill in the user account information with an avatar and user bio to display author information. <p><strong>Note:</strong> Make sure the bio info for the user is filled. The author info generates with the bio text</p>"),
		"desc" => __("Display author info in blog posts"),
		"id" => "authorstatus",
		"std" => 0,
		"type" => "checkbox"
	);
	
	$options[] = array(
		"name" => "Author Avatar Size",
		"help" => __("Size of avatar displayed beside the author info."),
		"desc" => "Avatar Size for Author Info",
		"id" => "author_avatar_size",
		"min" => "12",
		"max" => "256",
		"step" => "2",
		"unit" => 'pixels',
		"std" => "64",
		"type" => "text"
	);
	
	$options[] = array(
		"name" => __("Display Related Posts"),
		"help" => __("Display related posts underneath the blog posts. Related posts are generated using tags from the currently active blog post"),
		"desc" => __("Displays related posts based on Tags"),
		"id" => "relatedposts",
		"std" => 0,
		"type" => "checkbox"
	);
	
	$options[] = array(  
		"name" => __("Time format for Posts"),
		"help" => __("Time format for your blog posts. Either Human or Traditional. Human time will give you a date such as '12 Days ago'.<p>The traditional date structure can be modified according to your country or region from WordPress admin, otherwise default time format applies.</p>"),
		"desc" => __("Traditional or Human"),
		"id" => "mtheme_datetime",
		"std" => 'Human',
		"options" => array(
			"Human" => "Human",
			"Traditional" => "Traditional",
		),
		"type" => "select"
	);

	$options[] = array(  
		"name" => __("Read more text"),
		"help" => __("Read more text displayed just below the blog summary in Blog Summary mode."),
		"desc" => __("Read more text after post preview"),
		"id" => "readmore_link",
		"std" => "Continue Reading",
		"size" => '40',
		"type" => "text"
	);
	
	$options[] = array(
		"name" => "Comment Avatar Size",
		"help" => __("Comment avatar size."),
		"desc" => "Avatar Size for comments",
		"id" => "avatar_size",
		"min" => "12",
		"max" => "256",
		"step" => "2",
		"unit" => 'pixels',
		"std" => "64",
		"type" => "text"
	);
	
$options[] = array(  "name" => "Colors",
	"sectionID" => "color-section",
	"type" => "heading");

	$options[] = array(
		"name" => __("Page"),
		"help" => __("Set page color and title colors from the following. You can use the color picker to set a color easily."),
		"desc" => __("Page color"),
		"id" => "page_color",
		"std" => "",
		"type" => "color"
	);

	$options[] = array(
		"name" => __(""),
		"desc" => __("Page title color"),
		"id" => "page_title_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __("Mainpage"),
		"help" => __("Select color for Mainpage Welcome title, subtitle and quotation"),
		"desc" => __("Weclome title color"),
		"id" => "welcome_title_color",
		"std" => "",
		"type" => "color"
	);
	$options[] = array(
		"name" => __(""),
		"desc" => __("Weclome subtitle color"),
		"id" => "welcome_subtitle_color",
		"std" => "",
		"type" => "color"
	);
	$options[] = array(
		"name" => __(""),
		"desc" => __("Quotation color"),
		"id" => "quotation_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __("Menu"),
		"help" => __("Set menu colors, hover color, background and current page item menu colors."),
		"desc" => __("Menu top level link color"),
		"id" => "menu_dropdown_top_text_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Menu top level hover text color"),
		"id" => "menu_dropdown_top_hover_text_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Menu top level background hover color"),
		"id" => "menu_dropdown_top_hover_bg_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Menu dropdown background color"),
		"id" => "menu_background_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Menu current item background color"),
		"id" => "menu_dropdown_current_item_bg_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Menu current item link color"),
		"id" => "menu_dropdown_current_item_text_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Menu dropdown item link color"),
		"id" => "menu_dropdown_item_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Menu dropdown item link hover color"),
		"id" => "menu_dropdown_item_hover_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Menu dropdown background hover color"),
		"id" => "menu_dropdown_hover_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __("Heading"),
		"desc" => __("Change heading color of theme"),
		"id" => "title_link_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Heading hover color of theme"),
		"id" => "title_link_hover_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __("Post details"),
		"desc" => __("Post details ( Posted in categories non-links, date)"),
		"id" => "post_detail",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Post detail links ( Posted in categories links, comment amount)"),
		"id" => "post_detail_links",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Post detail hover links ( Posted in categories link hovers, comment amount)"),
		"id" => "post_detail_hover_links",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __("Readmore"),
		"desc" => __("Readmore link"),
		"id" => "readmore_link_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Readmore link hover"),
		"id" => "readmore_hover_link_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __("Sidebar"),
		"desc" => __("Sidebar title colors"),
		"id" => "sidebar_title_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Sidebar links"),
		"id" => "sidebar_link_color",
		"std" => "",
		"type" => "color"
	);
	
	$options[] = array(
		"name" => __(""),
		"desc" => __("Sidebar hover links"),
		"id" => "sidebar_hover_link_color",
		"std" => "",
		"type" => "color"
	);
	
		
$options[] = array(  "name" => "Footer Options",
	"sectionID" => "footer-section",
	"type" => "heading");

	$options[] = array(  
		"name" => "Show Footer widget spaces",
		"help" => __("This can collapse and display the footer widget spaces."),
		"desc" => "Show footer widgetized spaces",
		"id" => "footer_widget_status",
		"std" => 1,
		"type" => "checkbox"
	);

	$options[] = array(  
		"name" => "Footer scripts",
		"desc" => __("Footer scripts area can inject any scripts to the theme footer. This is ideal for scripts such as google analytics or any other scripts which require scripts to be just above the closing body tag."),
		"id" => "footer_scripts",
		"std" => "",
		"cols" => '70',
		"rows" => '10',
		"type" => "textarea"
	);

$options[] = array( "name" => "Export",
					"type" => "heading");

	$options[] = array( "name" => "Export Options ( Copy this ) Readonly.",
						"desc" => "Select All, copy and store your theme options backup. You can use these value to import theme options settings.",
						"id" => "exportpack",
						"std" => '',
						"class" => "big",
						"type" => "textarea");

$options[] = array( "name" => "Import Options",
					"type" => "heading",
					"subheading" => 'exportpack');

	$options[] = array( "name" => "Import Options ( Paste and Save )",
						"desc" => "CAUTION: Copy and Paste the Export Options settings into the window and Save to apply theme options settings.",
						"id" => "importpack",
						"std" => '',
						"class" => "big",
						"type" => "textarea");

	return $options;
}

?>