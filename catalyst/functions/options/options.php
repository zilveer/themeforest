<?php
$options = array (
	
array( "name" => __("General Settings"),
	"sectionID" => "main-section",
	"type" => "heading");

	array(
		"name" => __("Demo Panel"),
		"desc" => __("Used for displaying certain features of the theme. Only for demo purpose"),
		"id" => "mtheme_demopanel",
		"std" => 0,
		"type" => "checkbox"
	);
	
	array(  
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
	
	array(  
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
	
	array(  
		"name" => __("Email for Contact form"),
		"desc" => __("Email address for your contact form template provided with the theme. You'll need to create a Page and select the Contact template and publish. This will populate a contact form to the page. <p>Anything you type in the Contact Page contents area will be shown beside the form.</p>"),
		"id" => "email",
		"std" => "",
		"size" => '40',
		"type" => "text"
	);
	
array( "name" => "Theme Background",
	"sectionID" => "theme-skinsettings-section",
	"type" => "heading");

	array(  
		"name" => __("Background Pattern"),
		"desc" => __("Set a background for your theme. You can choose a Pattern or Texture to fill the background. The patterns are translucent and can be combined with your choice of color to generate interesting combinations. You can also set Pattern to None to generate a solid color."),
		"id" => "theme_bg_pattern",
		"std" => 'none',
		"options" => array(
			"none" => "None",
			"pattern1.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern1.png' width='24px' height='24px' /> Pattern 1",
			"pattern2.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern2.png' width='24px' height='24px' /> Pattern 2",
			"pattern3.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern3.png' width='24px' height='24px' /> Pattern 3",
			"pattern4.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern4.png' width='24px' height='24px' /> Pattern 4",
			"pattern5.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern5.png' width='24px' height='24px' /> Pattern 5",
			"pattern6.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern6.png' width='24px' height='24px' /> Pattern 6",
			"pattern7.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern7.png' width='24px' height='24px' /> Pattern 7",
			"pattern8.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern8.png' width='24px' height='24px' /> Pattern 8",
			"pattern9.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern9.png' width='24px' height='24px' /> Pattern 9",
			"pattern10.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern10.png' width='24px' height='24px' /> Pattern 10",
			"pattern11.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern11.png' width='24px' height='24px' /> Pattern 11",
			"pattern12.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern12.png' width='24px' height='24px' /> Pattern 12",
			"pattern13.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern13.png' width='24px' height='24px' /> Pattern 13",
			"pattern14.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern14.png' width='24px' height='24px' /> Pattern 14",
			"pattern15.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern15.png' width='24px' height='24px' /> Pattern 15",
			"pattern16.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern16.png' width='24px' height='24px' /> Pattern 16",
			"pattern17.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern17.png' width='24px' height='24px' /> Pattern 17",
			"pattern18.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern18.png' width='24px' height='24px' /> Pattern 18",
			"pattern19.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern19.png' width='24px' height='24px' /> Pattern 19",
			"pattern20.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern20.png' width='24px' height='24px' /> Pattern 20",
			"pattern21.png" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/pattern21.png' width='24px' height='24px' /> Pattern 21",
			"darkwood.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/darkwood.png' width='24px' height='24px' /> Darkwood",
			"wood.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/wood.png' width='24px' height='24px' /> Wood",
			"grains1.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/grains1.png' width='24px' height='24px' /> Grains",
			"rainbow.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/rainbow.png' width='24px' height='24px' /> Rainbow",
			"sand.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/sand.png' width='24px' height='24px' /> Sand",
			"metal1.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/metal1.png' width='24px' height='24px' /> Metal 1",
			"metal2.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/metal2.png' width='24px' height='24px' /> Metal 2",
			"paint1.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/paint1.png' width='24px' height='24px' /> Paint 1",
			"paint2.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/paint2.png' width='24px' height='24px' /> Paint 2",
			"paint3.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/paint3.png' width='24px' height='24px' /> Paint 3",
			"paint4.jpg" => "<img src='" . MTHEME_PATH . "/images/backgrounds/thumbnails/paint4.png' width='24px' height='24px' /> Paint 4",
		),
		"type" => "images"
	);
	

	array(
		"name" => __("Background Color"),
		"desc" => __("Set a background color for your theme. You can choose none for the Pattern to generate a solid colored background"),
		"id" => "theme_bg_color",
		"std" => "",
		"type" => "color"
	);
	
array( "name" => "Logo Settings",
	"sectionID" => "head-logo-section",
	"type" => "heading");

	array(
		"name" => __("Custom Logo"),
		"desc" => __("Upload a Logo image for your theme. You can upload and copy paste the image link url into the input field."),
		"id" => "logo",
		"std" => "",
		"type" => "upload"
	);
	
	array(
		"name" => __("Logo top space"),
		"desc" => __("Adjust left spacing for your logo."),
		"id" => "logo_top_spacing",
		"min" => "0",
		"max" => "100",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "50",
		"type" => "ranger"
	);
	
	array(
		"name" => __("Logo left space"),
		"desc" => __("Adjust left spacing for your logo."),
		"id" => "logo_left_spacing",
		"min" => "0",
		"max" => "100",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "40",
		"type" => "ranger"
	);
	
array( "name" => "Font Settings",
	"sectionID" => "head-font-section",
	"type" => "heading");

	array(
		"name" => __("Toggle Cufon font Substitution"),
		"desc" => __("Switch On and Off Cufon font substitutions throughout the theme. This removes cufon libraries, initializers and font loaders."),
		"id" => "cufon_status",
		"std" => 1,
		"type" => "checkbox"
	);

	array(
		"name" =>"Title Font",
		"desc" => __("Choose from a variety of Cufon fonts."),
		"id" => "theme_font",
		"std" => 'cabin',
		"options" => array(
			"cabin" => "Cabin <br/><img src='" . MTHEME_PATH . "/js/font/samples/cabin.png' /><hr/>",
			"pacifico" => "Pacifico <br/><img src='" . MTHEME_PATH . "/js/font/samples/pacifico.png' /><hr/>",
			"singlet" => "Singlet <br/><img src='" . MTHEME_PATH . "/js/font/samples/singlet.png' /><hr/>",
			"indieflower" => "Indie Flower <br/><img src='" . MTHEME_PATH . "/js/font/samples/indieflower.png' /><hr/>",
			"raleway" => "Raleway <br/><img src='" . MTHEME_PATH . "/js/font/samples/raleway.png' /><hr/>",
			"pt_sans" => "PT_Sans <br/><img src='" . MTHEME_PATH . "/js/font/samples/pt_sans.png' /><hr/>",
			"waitingforthesun" => "Waiting for the Sunrise <br/><img src='" . MTHEME_PATH . "/js/font/samples/waitingforthesun.png' /><hr/>",
			"playfair" => "Playfair Display <br/><img src='" . MTHEME_PATH . "/js/font/samples/playfair.png' /><hr/>",
			"holtwood" => "Holtwood One <br/><img src='" . MTHEME_PATH . "/js/font/samples/holtwood.png' /><hr/>",
			"open_sans" => "Open_Sans <br/><img src='" . MTHEME_PATH . "/js/font/samples/open_sans.png' /><hr/>",
			"artifika" => "Artifika <br/><img src='" . MTHEME_PATH . "/js/font/samples/artifika.png' /><hr/>",
			"paytone" => "Paytone One <br/><img src='" . MTHEME_PATH . "/js/font/samples/paytone.png' /><hr/>",
			"limelight" => "Limelight <br/><img src='" . MTHEME_PATH . "/js/font/samples/limelight.png' /><hr/>",
			"quicksand" => "Quicksand <br/><img src='" . MTHEME_PATH . "/js/font/samples/quicksand.png' /><hr/>",
			"imperator" => "Imperator <br/><img src='" . MTHEME_PATH . "/js/font/samples/imperator.png' /><hr/>",
			"titillium" => "Titillium <br/><img src='" . MTHEME_PATH . "/js/font/samples/titillium.png' /><hr/>",
			"vegur" => "Vegur <br/><img src='" . MTHEME_PATH . "/js/font/samples/vegur.png' /><hr/>",
			"luna" => "Luna <br/><img src='" . MTHEME_PATH . "/js/font/samples/luna.png' /><hr/>",
			"greyscale" => "Greyscale <br/><img src='" . MTHEME_PATH . "/js/font/samples/grayscale.png' /><hr/>",
			"chunkfive" => "Chunkfive <br/><img src='" . MTHEME_PATH . "/js/font/samples/chunkfive.png' /><hr/>",
			"sansation" => "Sansation <br/><img src='" . MTHEME_PATH . "/js/font/samples/sansation.png' /><hr/>",
			"oswald" => "Oswald <br/><img src='" . MTHEME_PATH . "/js/font/samples/oswald.png' /><hr/>",
			"segan" => "Segan <br/><img src='" . MTHEME_PATH . "/js/font/samples/segan.png' /><hr/>",
			"custom_font" => "Custom Font",
		),
		"type" => "radio"
	);
	
	array(  
		"name" => __("For custom Cufon JS font path"),
		"help" => __("You can use http://cufon.shoqolate.com/generate/ to generate your own cufon font for the theme. After you generate a cufon font you can upload and enter its path here."),
		"desc" => __("Full path to your Cufon font"),
		"id" => "custom_theme_font",
		"std" => "",
		"type" => "upload"
	);
	
array( "name" => "Header Social links",
	"sectionID" => "head-social-section",
	"type" => "heading");

	array(
		"name" => __("Display this section"),
		"help" => __("Toggle section On and Off from the homepage"),
		"desc" => __("Display this section from the home page"),
		"id" => "section_social_status",
		"std" => 1,
		"type" => "checkbox"
	);

	array(  
		"name" => __("Social Link 1"),
		"help" => __("Upload an image for the header social links , ideal dimensions are 16 pixel by 16 pixels. You can upload and copy paste the image link url into the input field. The tooltip text you enter in the Tool Tip input field will appear on hover over the icon. The Social link is the target link for your icon"),
		"desc" => __("<code>Paste URL</code> Icon image path #1 (16px x 16px recommended)"),
		"id" => "icon_image_1",
		"std" => MTHEME_PATH . "/images/socialheader/twitter.png",
		"type" => "upload"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Tool tip text #1"),
		"id" => "tooltip_text_1",
		"std" => "Twitter",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Target link path #1"),
		"id" => "target_link_1",
		"std" => "#",
		"size" => '80',
		"type" => "text"
	);
	
		array(  
			"name" => __("Social Link 2"),
			"desc" => __("<code>Paste URL</code> Icon image path #2 (16px x 16px recommended)"),
			"id" => "icon_image_2",
			"std" => "",
			"type" => "upload"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Tool tip text #2"),
			"id" => "tooltip_text_2",
			"std" => "",
			"size" => '40',
			"type" => "text"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Target link path #2"),
			"id" => "target_link_2",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	array(  
		"name" => __("Social Link 3"),
		"desc" => __("<code>Paste URL</code> Icon image path #3 (16px x 16px recommended)"),
		"id" => "icon_image_3",
		"std" => "",
		"type" => "upload"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Tool tip text #3"),
		"id" => "tooltip_text_3",
		"std" => "",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Target link path #3"),
		"id" => "target_link_3",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		array(  
			"name" => __("Social Link 4"),
			"desc" => __("<code>Paste URL</code> Icon image path #4 (16px x 16px recommended)"),
			"id" => "icon_image_4",
			"std" => "",
			"type" => "upload"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Tool tip text #4"),
			"id" => "tooltip_text_4",
			"std" => "",
			"size" => '40',
			"type" => "text"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Target link path #4"),
			"id" => "target_link_4",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	array(  
		"name" => __("Social Link 5"),
		"desc" => __("<code>Paste URL</code> Icon image path #5 (16px x 16px recommended)"),
		"id" => "icon_image_5",
		"std" => "",
		"type" => "upload"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Tool tip text #5"),
		"id" => "tooltip_text_5",
		"std" => "",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Target link path #5"),
		"id" => "target_link_5",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		array(  
			"name" => __("Social Link 6"),
			"desc" => __("<code>Paste URL</code> Icon image path #6 (16px x 16px recommended)"),
			"id" => "icon_image_6",
			"std" => "",
			"type" => "upload"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Tool tip text #6"),
			"id" => "tooltip_text_6",
			"std" => "",
			"size" => '40',
			"type" => "text"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Target link path #6"),
			"id" => "target_link_6",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	array(  
		"name" => __("Social Link 7"),
		"desc" => __("<code>Paste URL</code> Icon image path #7 (16px x 16px recommended)"),
		"id" => "icon_image_7",
		"std" => "",
		"type" => "upload"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Tool tip text #7"),
		"id" => "tooltip_text_7",
		"std" => "",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Target link path #7"),
		"id" => "target_link_7",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		array(  
			"name" => __("Social Link 8"),
			"desc" => __("<code>Paste URL</code> Icon image path #8 (16px x 16px recommended)"),
			"id" => "icon_image_8",
			"std" => "",
			"type" => "upload"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Tool tip text #8"),
			"id" => "tooltip_text_8",
			"std" => "",
			"size" => '40',
			"type" => "text"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Target link path #8"),
			"id" => "target_link_8",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	array(  
		"name" => __("Social Link 9"),
		"desc" => __("<code>Paste URL</code> Icon image path #9 (16px x 16px recommended)"),
		"id" => "icon_image_9",
		"std" => "",
		"type" => "upload"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Tool tip text #9"),
		"id" => "tooltip_text_9",
		"std" => "",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Target link path #9"),
		"id" => "target_link_9",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		array(  
			"name" => __("Social Link 10"),
			"desc" => __("<code>Paste URL</code> Icon image path #10 (16px x 16px recommended)"),
			"id" => "icon_image_10",
			"std" => "",
			"type" => "upload"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Tool tip text #10"),
			"id" => "tooltip_text_10",
			"std" => "",
			"size" => '40',
			"type" => "text"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Target link path #10"),
			"id" => "target_link_10",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
array( "name" => "Featured",
	"sectionID" => "featured-section",
	"type" => "heading");

	array(
		"name" => __("Display this section"),
		"help" => __("Toggle section On and Off from the homepage"),
		"desc" => __("Switch section On and Off from the home page"),
		"id" => "section_featured_status",
		"std" => 1,
		"type" => "checkbox"
	);

	array(  
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
	
array(  "name" => " - Showcase",
	"sectionID" => "featured-showcase",
	"type" => "heading");
	
	array(
		"name" => __("Autoplay"),
		"help" => __("Toggle section On and Off from the homepage"),
		"desc" => __("Set autoplay for showcase slides"),
		"id" => "featured_showcase_autoplay",
		"std" => 1,
		"type" => "checkbox"
	);
	
	array(  
		"name" => __("Thumbnail position"),
		"help" => __("Display thumbnails above or below the featured slides."),
		"desc" => __("Thumbnails position for slider"),
		"id" => "featured_showcase_thumbnail",
		"std" => 'outside-last',
		"options" => array(
			"outside-last" => "Bottom",
			"outside-first" => "Top",
		),
		"type" => "select"
	);
	
	array(
		"name" => __("Full image height"),
		"help" => __("Adjust height of the image. Set in pixels."),
		"desc" => __("Full image height for the showcase"),
		"id" => "featured_showcase_height",
		"min" => "400",
		"max" => "900",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "530",
		"type" => "ranger"
	);
	
	array(
		"name" => __("Display Arrows"),
		"help" => __("Display navigation arrows to scroll the slides."),
		"desc" => __("Display navigation Arrows"),
		"id" => "featured_showcase_arrows",
		"std" => 1,
		"type" => "checkbox"
	);
	
	array(
		"name" => __("Display Title"),
		"help" => __("Display title over the slides."),
		"desc" => __("Display titles"),
		"id" => "featured_showcase_title",
		"std" => 1,
		"type" => "checkbox"
	);
	
	array(
		"name" => __("Display Description"),
		"help" => __("Display descriptions over the slides."),
		"desc" => __("Display descriptions"),
		"id" => "featured_showcase_desc",
		"std" => 1,
		"type" => "checkbox"
	);
	
	array(  
		"name" => __("Transition Type"),
		"help" => __("Type of transition your want for the slide. Either horizontal, vertical or fade slide."),
		"desc" => __("Transition type for showcase"),
		"id" => "featured_showcase_transition",
		"std" => 'hslide',
		"options" => array(
			"hslide" => "Horizontal Slide",
			"vslide" => "Vertical Slide",
			"fade" => "Fade Slide",
		),
		"type" => "select"
	);
	
	array(
		"name" => __("Transition Speed"),
		"help" => __("Transition speed of the slides."),
		"desc" => __("Transition speed for slides"),
		"id" => "featured_showcase_transitionspeed",
		"min" => "200",
		"max" => "5000",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "500",
		"type" => "ranger"
	);
	
	array(
		"name" => __("Delay between transitions"),
		"help" => __("Delay between slides transition."),
		"desc" => __("Delay between transitions of the slides"),
		"id" => "featured_showcase_transitiondelay",
		"min" => "2500",
		"max" => "10000",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "3000",
		"type" => "ranger"
	);
	
array(  "name" => " - Nivo",
	"sectionID" => "featurednivo-section",
	"type" => "section");
	
	array(
		"name" => __("Autoplay"),
		"help" => __("Switch On / Off autoplay for Nivo featured slides."),
		"desc" => __("Set autoplay for nivo slides"),
		"id" => "featured_nivo_autoplay",
		"std" => 1,
		"type" => "checkbox"
	);
	
	array(
		"name" => __("Display titles"),
		"help" => __("Toggle titles on Nivo slides"),
		"desc" => __("Display titles"),
		"id" => "featured_nivo_title",
		"std" => 1,
		"type" => "checkbox"
	);
	
	array(
		"name" => __("Display descriptions"),
		"help" => __("Toggle descrriptions on Nivo Slides"),
		"desc" => __("Display descriptions"),
		"id" => "featured_nivo_desc",
		"std" => 1,
		"type" => "checkbox"
	);
	
	array(  
		"name" => __("Transition style"),
		"help" => __("Transition type for the nivo slides"),
		"desc" => __("Transition style for nivo"),
		"id" => "featured_nivo_transition_style",
		"std" => 'boxRain',
		"options" => array(
			"random" => "random",
			"sliceDown" => "sliceDown",
			"fold" => "fold",
			"fade" => "fade",
			"sliceUp" => "sliceUp",
			"sliceUpLeft" => "sliceUpLeft",
			"sliceUpDown" => "sliceUpDown",
			"sliceDownLeft" => "sliceDownLeft",
			"sliceUpDownLeft" => "sliceUpDownLeft",
			"slideInRight" => "slideInRight",
			"slideInLeft" => "slideInLeft",
			"boxRandom" => "boxRandom",
			"boxRain" => "boxRain",
			"boxRainReverse" => "boxRainReverse",
			"boxRainGrow" => "boxRainGrow",
			"boxRainGrowReverse" => "boxRainGrowReverse"
		),
		"type" => "select"
	);
	
	array(
		"name" => __("Transition Speed"),
		"help" => __("Transition speed from one slide to the other."),
		"desc" => __("Set transition speed for Nivo Slides"),
		"id" => "featured_nivo_transition_speed",
		"min" => "100",
		"max" => "1000",
		"step" => "100",
		"unit" => 'seconds',
		"std" => "500",
		"type" => "ranger"
	);
	
	array(
		"name" => __("Pause time"),
		"help" => __("Pause time until next transition. Active on autoplay."),
		"desc" => __("Nivo Slide pause time if autoplay is On"),
		"id" => "featured_nivo_pausetime",
		"min" => "2500",
		"max" => "10000",
		"step" => "500",
		"unit" => 'seconds',
		"std" => "5000",
		"type" => "ranger"
	);
	
	array(
		"name" => __("Nivo Slide Slices"),
		"help" => __("Number of slices for nivo slide transition."),
		"desc" => __("Nivo Slide slices"),
		"id" => "featured_nivo_slices",
		"min" => "5",
		"max" => "30",
		"step" => "1",
		"unit" => 'seconds',
		"std" => "15",
		"type" => "ranger"
	);
	
	array(
		"name" => __("Box Columns"),
		"help" => __("Number of box columns used in transition box effects"),
		"desc" => __("Nivo Box columns"),
		"id" => "featured_nivo_box_cols",
		"min" => "5",
		"max" => "30",
		"step" => "1",
		"unit" => 'seconds',
		"std" => "10",
		"type" => "ranger"
	);
	
	array(
		"name" => __("Box Rows"),
		"help" => __("Number of rows for box effect transitions."),
		"desc" => __("Nivo Box rows"),
		"id" => "featured_nivo_box_rows",
		"min" => "5",
		"max" => "30",
		"step" => "1",
		"unit" => 'seconds',
		"std" => "8",
		"type" => "ranger"
	);
	
	array(
		"name" => __("Nivo Slide height"),
		"help" => __("Nivo Slide height for the featured section"),
		"desc" => __("Nivo slideshow height"),
		"id" => "featured_nivo_height",
		"min" => "400",
		"max" => "900",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "610",
		"type" => "ranger"
	);
		
array(  "name" => " - Accordion",
	"sectionID" => "featuredaccordion-section",
	"type" => "heading");
	
	array(  
		"name" => __("Accordion slide amount"),
		"help" => __("This is the number of slides for the accordion. When you set the number of slides they will adjust the accordion slides fit the space."),
		"desc" => __("Select the number of slides for the accordion"),
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
	
	array(
		"name" => __("Accordion height"),
		"help" => __("Featured accordion slide height"),
		"desc" => __("Accordion height"),
		"id" => "featured_accordion_height",
		"min" => "400",
		"max" => "900",
		"step" => "0",
		"unit" => 'pixels',
		"std" => "600",
		"type" => "ranger"
	);
	
	array(
		"name" => __("Display titles"),
		"help" => __("Dsiplay titles for the accordion"),
		"desc" => __("Display titles"),
		"id" => "featured_accordion_title",
		"std" => 1,
		"type" => "checkbox"
	);
	
	array(
		"name" => __("Display descriptions"),
		"help" => __("Display descriptions from the accordion"),
		"desc" => __("Display descriptions"),
		"id" => "featured_accordion_desc",
		"std" => 1,
		"type" => "checkbox"
	);
	
array(  "name" => " - Static Video Block",
	"sectionID" => "featured-static-section",
	"type" => "heading");
	
	array(  
		"name" => __("Video embed code for Video static block"),
		"help" => __("You can provide embed code for the video in this section. Vimeo, youtube or other video sharing sites generates video embed codes. Copy paste the embed code here. The recommended width is 960 pixels and height can be anything."),
		"desc" => __("Recommended width 960 pixels and height 540 pixels"),
		"id" => "featured_video",
		"std" => "",
		"cols" => '70',
		"rows" => '10',
		"type" => "textarea"
	);
		
array( "name" => "Home Section A",
	"sectionID" => "home-section-a",
	"type" => "heading");

	array(
		"name" => __("Display this section"),
		"help" => __("Toggle section On and Off from the homepage. You can set the three step columns which are displayed just under the featured block from this section. Supply with an icon, title, description and link to target the title."),
		"desc" => __("Display this section from the home page"),
		"id" => "section_a_status",
		"std" => 1,
		"type" => "checkbox"
	);

	array(  
		"name" => __("Column A"),
		"desc" => __("<code>Paste URL</code> Icon path"),
		"id" => "sa_col_a_icon",
		"std" => MTHEME_PATH . "/images/numbers/step_one.png",
		"type" => "upload"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Title"),
		"id" => "sa_col_a_title",
		"std" => "Customize",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Description"),
		"id" => "sa_col_a_desc",
		"std" => "Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Target link"),
		"id" => "sa_col_a_link",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		array(  
			"name" => __("Column B"),
			"desc" => __("<code>Paste URL</code> Icon path"),
			"id" => "sa_col_b_icon",
			"std" => MTHEME_PATH . "/images/numbers/step_two.png",
			"type" => "upload"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Title"),
			"id" => "sa_col_b_title",
			"std" => "Extensible",
			"size" => '40',
			"type" => "text"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Description"),
			"id" => "sa_col_b_desc",
			"std" => "Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.",
			"cols" => '70',
			"rows" => '5',
			"type" => "textarea"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Target link"),
			"id" => "sa_col_b_link",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	array(  
		"name" => __("Column C"),
		"desc" => __("<code>Paste URL</code> Icon path"),
		"id" => "sa_col_c_icon",
		"std" => MTHEME_PATH . "/images/numbers/step_three.png",
		"type" => "upload"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Title"),
		"id" => "sa_col_c_title",
		"std" => "Support",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Description"),
		"id" => "sa_col_c_desc",
		"std" => "Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Target link"),
		"id" => "sa_col_c_link",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);

array( "name" => "Home Section B",
	"sectionID" => "home-section-b",
	"type" => "heading");

	array(
		"name" => __("Display this section"),
		"help" => __("Toggle this section On and Off from homepage. You can enter the Welcome text and button from the following."),
		"desc" => __("Display this section from the home page"),
		"id" => "section_b_status",
		"std" => 1,
		"type" => "checkbox"
	);

	array(  
		"name" => __("Welcome Title"),
		"help" => __("Welcome title for the mainpage. This can be the important greeting on the mainpage."),
		"desc" => __("Welcome text for the mainpage"),
		"id" => "welcome_title",
		"std" => "Catalyst premium is an powerful theme to showcase your portfolio",
		"size" => '80',
		"type" => "text"
	);
	
	array(  
		"name" => __("Welcome Subtitle"),
		"help" => __("Subtitle to go along with the Welcome title."),
		"desc" => __("Appears underneath the welcome title"),
		"id" => "welcome_subtitle",
		"std" => "Build and display your portfolio and creative works in a simple yet powerful theme",
		"size" => '80',
		"type" => "text"
	);
	
	array(  
		"name" => __("Button Text"),
		"help" => __("Text that will appear on the button"),
		"desc" => __("Enter text to display on the button"),
		"id" => "button_text",
		"std" => "Purchase",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __("Button Link"),
		"help" => __("Link for the button."),
		"desc" => __("Target link for you button"),
		"id" => "button_link",
		"std" => "#",
		"size" => '40',
		"type" => "text"
	);
	
array( "name" => "Home Section C",
	"sectionID" => "home-section-c",
	"type" => "heading");

	array(
		"name" => __("Display this section"),
		"help" => __("Toggle this section On and Off from homepage."),
		"desc" => __("Display this section from the home page"),
		"id" => "section_c_status",
		"std" => 1,
		"type" => "checkbox"
	);

	array(  
		"name" => __("Mainpage Image Carousel"),
		"help" => __("Choose either Pages or Categories of Posts to populate the mainpage carousel. If you choose Pages you will need a Page published with image attachments. You can follow the Help Guide provided with the theme to get more information on this. A Category of Posts can be any category of posts populated with featured images attached to the posts."),
		"desc" => __("Populate image carousel using Pages or Category of posts"),
		"id" => "sc_carousel_from",
		"std" => 'pages',
		"options" => array(
			"pages" => "Pages",
			"categories" => "Category of posts",
			"portfolio" => "Portfolio",
		),
		"type" => "select"
	);

	array(
		"name" => "Select Page",
		"help" => __("Select your Page with image attachments to populate the carousel."),
		"desc" => "Select Page to populate attachment images from",
		"id" => "sc_carousel_page",
		"target" => 'page',
		"std" => "",
		"prompt" => "Choose a page..",
		"type" => "select",
	);
	
	array(
		"name" => "Select Category",
		"help" => __("This will populate a category of posts. Each image is taken from the post featured image. If you link directly it'll link to the post. Otherwise a lightbox will display the featured image in full."),
		"desc" => "Select a category to populate the posts from",
		"id" => "sc_carousel_category",
		"target" => 'category',
		"std" => "",
		"prompt" => "Choose a category..",
		"type" => "select",
	);
	
	array(
		"name" => "Select Portfolio",
		"help" => __("This will populate a portfolio category. Each image is taken from the post featured image. If you link directly it'll link to the post. Otherwise a lightbox will display the featured image in full."),
		"desc" => "Select a portfolio to populate the posts from",
		"id" => "sc_carousel_portfolio",
		"target" => 'portfolio_category',
		"std" => "",
		"prompt" => "Choose a portfolio..",
		"type" => "select",
	);
	
	array(  
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
	
	array(  
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
	
array( "name" => "Home Section D",
	"sectionID" => "home-section-d",
	"type" => "heading");

	array(
		"name" => __("Display this section"),
		"help" => __("Toggle On / Off this section from the homepage"),
		"desc" => __("Display this section from the home page"),
		"id" => "section_d_status",
		"std" => 1,
		"type" => "checkbox"
	);
	
	array(
		"name" => __("Display the top row"),
		"help" => __("Switch off the top row leaving the bottom three blocks visible."),
		"desc" => __("Display top row of this section"),
		"id" => "sd_row_a_status",
		"std" => 1,
		"type" => "checkbox"
	);
	
	array(
		"name" => __("Display the bottom row"),
		"help" => __("Switch off the bottom row leaving the top three blocks visible."),
		"desc" => __("Display bottom row of this section"),
		"id" => "sd_row_b_status",
		"std" => 1,
		"type" => "checkbox"
	);

	array(  
		"name" => __("Column A (top left)"),
		"help" => __("Fill each of these blocks to display in the homepage. That is the 6 blocks which appear below the portfolio carousel"),
		"desc" => __("<code>Paste URL</code> Icon path"),
		"id" => "sd_col_a_icon",
		"std" => MTHEME_PATH . "/images/icons/leaf.png",
		"type" => "upload"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Title"),
		"id" => "sd_col_a_title",
		"std" => "Advanced Options",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Description"),
		"id" => "sd_col_a_desc",
		"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Target link"),
		"id" => "sd_col_a_link",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		array(  
			"name" => __("Column B (top mid)"),
			"desc" => __("<code>Paste URL</code> Icon path"),
			"id" => "sd_col_b_icon",
			"std" => MTHEME_PATH . "/images/icons/flask.png",
			"type" => "upload"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Title"),
			"id" => "sd_col_b_title",
			"std" => "Multiple Portfolios",
			"size" => '40',
			"type" => "text"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Description"),
			"id" => "sd_col_b_desc",
			"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
			"cols" => '70',
			"rows" => '5',
			"type" => "textarea"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Target link"),
			"id" => "sd_col_b_link",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
		
	array(  
		"name" => __("Column E (top right)"),
		"desc" => __("<code>Paste URL</code> Icon path"),
		"id" => "sd_col_extra_a_icon",
		"std" => MTHEME_PATH . "/images/icons/controls.png",
		"type" => "upload"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Title"),
		"id" => "sd_col_extra_a_title",
		"std" => "Content Objects",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Description"),
		"id" => "sd_col_extra_a_desc",
		"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Target link"),
		"id" => "sd_col_extra_a_link",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
		
		array(  
			"name" => __("Column C (bottom left)"),
			"desc" => __("<code>Paste URL</code> Icon path"),
			"id" => "sd_col_c_icon",
			"std" => MTHEME_PATH . "/images/icons/bulb.png",
			"type" => "upload"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Title"),
			"id" => "sd_col_c_title",
			"std" => "Post headers",
			"size" => '40',
			"type" => "text"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Description"),
			"id" => "sd_col_c_desc",
			"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
			"cols" => '70',
			"rows" => '5',
			"type" => "textarea"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Target link"),
			"id" => "sd_col_c_link",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);
	
	array(  
		"name" => __("Column D (bottom mid)"),
		"desc" => __("<code>Paste URL</code> Icon path"),
		"id" => "sd_col_d_icon",
		"std" => MTHEME_PATH . "/images/icons/recycle.png",
		"type" => "upload"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Title"),
		"id" => "sd_col_d_title",
		"std" => "Gui Shortcodes",
		"size" => '40',
		"type" => "text"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Description"),
		"id" => "sd_col_d_desc",
		"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
	array(  
		"name" => __(""),
		"desc" => __("Target link"),
		"id" => "sd_col_d_link",
		"std" => "",
		"size" => '80',
		"type" => "text"
	);
	
		array(  
			"name" => __("Column F (bottom right)"),
			"desc" => __("<code>Paste URL</code> Icon path"),
			"id" => "sd_col_extra_b_icon",
			"std" => MTHEME_PATH . "/images/icons/mouse.png",
			"type" => "upload"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Title"),
			"id" => "sd_col_extra_b_title",
			"std" => "Page Templates",
			"size" => '40',
			"type" => "text"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Description"),
			"id" => "sd_col_extra_b_desc",
			"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet. ",
			"cols" => '70',
			"rows" => '5',
			"type" => "textarea"
		);
		
		array(  
			"name" => __(""),
			"desc" => __("Target link"),
			"id" => "sd_col_extra_b_link",
			"std" => "",
			"size" => '80',
			"type" => "text"
		);

array( "name" => "Home Section E",
	"sectionID" => "home-section-e",
	"type" => "heading");

	array(
		"name" => __("Display this section"),
		"help" => __("Toggle this section On and Off from the homepage"),
		"desc" => __("Display this section from the home page"),
		"id" => "section_e_status",
		"std" => 1,
		"type" => "checkbox"
	);

	array(  
		"name" => __("Section F : Quote"),
		"help" => __("Quotation that appears at the lower most section of main page."),
		"desc" => __("Description"),
		"id" => "sf_quote",
		"std" => "Lorem ipsum dolor! Sit amet, consectetur adipiscing elit. Mauris varius pharetra esit commodo consectetur adipiscing elit var pharetra ipsum dolor sit amet.",
		"cols" => '70',
		"rows" => '5',
		"type" => "textarea"
	);
	
array(  "name" => "Blog",
	"sectionID" => "blog-section",
	"type" => "heading");

	array(  
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
	
	array(
		"name" => __("Display Author Info"),
		"help" => __("Display author info after blog posts. You'll need to fill in the user account information with an avatar and user bio to display author information. <p><strong>Note:</strong> Make sure the bio info for the user is filled. The author info generates with the bio text</p>"),
		"desc" => __("Display author info in blog posts"),
		"id" => "authorstatus",
		"std" => 0,
		"type" => "checkbox"
	);
	
	array(
		"name" => "Author Avatar Size",
		"help" => __("Size of avatar displayed beside the author info."),
		"desc" => "Avatar Size for Author Info",
		"id" => "author_avatar_size",
		"min" => "12",
		"max" => "256",
		"step" => "2",
		"unit" => 'pixels',
		"std" => "64",
		"type" => "ranger"
	);
	
	array(
		"name" => __("Display Related Posts"),
		"help" => __("Display related posts underneath the blog posts. Related posts are generated using tags from the currently active blog post"),
		"desc" => __("Displays related posts based on Tags"),
		"id" => "relatedposts",
		"std" => 0,
		"type" => "checkbox"
	);
	
	array(  
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

	array(  
		"name" => __("Read more text"),
		"help" => __("Read more text displayed just below the blog summary in Blog Summary mode."),
		"desc" => __("Read more text after post preview"),
		"id" => "readmore_link",
		"std" => "Continue Reading",
		"size" => '40',
		"type" => "text"
	);
	
	array(
		"name" => "Comment Avatar Size",
		"help" => __("Comment avatar size."),
		"desc" => "Avatar Size for comments",
		"id" => "avatar_size",
		"min" => "12",
		"max" => "256",
		"step" => "2",
		"unit" => 'pixels',
		"std" => "64",
		"type" => "ranger"
	);
	
array(  "name" => "Colors",
	"sectionID" => "color-section",
	"type" => "heading");

	array(
		"name" => __("Page"),
		"help" => __("Set page color and title colors from the following. You can use the color picker to set a color easily."),
		"desc" => __("Page color"),
		"id" => "page_color",
		"std" => "",
		"type" => "color"
	);

	array(
		"name" => __(""),
		"desc" => __("Page title color"),
		"id" => "page_title_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __("Mainpage"),
		"help" => __("Select color for Mainpage Welcome title, subtitle and quotation"),
		"desc" => __("Weclome title color"),
		"id" => "welcome_title_color",
		"std" => "",
		"type" => "color"
	);
	array(
		"name" => __(""),
		"desc" => __("Weclome subtitle color"),
		"id" => "welcome_subtitle_color",
		"std" => "",
		"type" => "color"
	);
	array(
		"name" => __(""),
		"desc" => __("Quotation color"),
		"id" => "quotation_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __("Menu"),
		"help" => __("Set menu colors, hover color, background and current page item menu colors."),
		"desc" => __("Menu top level link color"),
		"id" => "menu_dropdown_top_text_color",
		"std" => "",
		"type" => "color"
	),
	
	array(
		"name" => __(""),
		"desc" => __("Menu top level hover text color"),
		"id" => "menu_dropdown_top_hover_text_color",
		"std" => "",
		"type" => "color"
	),
	
	array(
		"name" => __(""),
		"desc" => __("Menu top level background hover color"),
		"id" => "menu_dropdown_top_hover_bg_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Menu dropdown background color"),
		"id" => "menu_background_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Menu current item background color"),
		"id" => "menu_dropdown_current_item_bg_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Menu current item link color"),
		"id" => "menu_dropdown_current_item_text_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Menu dropdown item link color"),
		"id" => "menu_dropdown_item_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Menu dropdown item link hover color"),
		"id" => "menu_dropdown_item_hover_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Menu dropdown background hover color"),
		"id" => "menu_dropdown_hover_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __("Heading"),
		"desc" => __("Change heading color of theme"),
		"id" => "title_link_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Heading hover color of theme"),
		"id" => "title_link_hover_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __("Post details"),
		"desc" => __("Post details ( Posted in categories non-links, date)"),
		"id" => "post_detail",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Post detail links ( Posted in categories links, comment amount)"),
		"id" => "post_detail_links",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Post detail hover links ( Posted in categories link hovers, comment amount)"),
		"id" => "post_detail_hover_links",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __("Readmore"),
		"desc" => __("Readmore link"),
		"id" => "readmore_link_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Readmore link hover"),
		"id" => "readmore_hover_link_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __("Sidebar"),
		"desc" => __("Sidebar title colors"),
		"id" => "sidebar_title_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Sidebar links"),
		"id" => "sidebar_link_color",
		"std" => "",
		"type" => "color"
	);
	
	array(
		"name" => __(""),
		"desc" => __("Sidebar hover links"),
		"id" => "sidebar_hover_link_color",
		"std" => "",
		"type" => "color"
	);
	
		
array(  "name" => "Footer Options",
	"sectionID" => "footer-section",
	"type" => "heading"),

	array(  
		"name" => "Show Footer widget spaces",
		"help" => __("This can collapse and display the footer widget spaces."),
		"desc" => "Show footer widgetized spaces",
		"id" => "footer_widget_status",
		"std" => 1,
		"type" => "checkbox"
	);

	array(  
		"name" => "Footer scripts",
		"help" => __("Footer scripts area can inject any scripts to the theme footer. This is ideal for scripts such as google analytics or any other scripts which require scripts to be just above the closing body tag."),
		"desc" => "Footer scripts such as Google Analytics code",
		"id" => "footer_scripts",
		"std" => "",
		"cols" => '70',
		"rows" => '10',
		"type" => "textarea"
	);
	
array( "type" => "close"),
array(  "name" => "RESET Options",
	"sectionID" => "reset",
	"type" => "section"),
array(  "type" => "open"),	
	array(
		"type" => "reset",
	),
array( "type" => "close")
);
?>