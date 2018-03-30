<?php
/**
* All Theme OpTions
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

	$options   = array();
/*
*   General Settings
*******************************************/
	$options[] = array( 'title'     => 'General Settings','type'      => 'open');

	$options[] = array( "title"=> "Favicon","desc"=> "Custom Favicon","id" => "favicon","type"=> "upload","itemstyle" => true);

	$options[] = array( 'title' => 'Apple Icons','type'  => 'openitem' );

		$options[] = array( 'desc' => 'IPhone icon', 'id'    => 'iphone_icon', 'help' => '57x57 icon for appel iphone' ,'type' => 'text' );
		
		$options[] = array( 'desc' => 'IPhone retina icon','id'   => 'iphone_retina_icon', 'help' => '120x120 icon for appel iphone retina' ,'type' => 'text');    

		$options[] = array( 'desc' => 'IPad icon','id'   => 'ipad_icon', 'help' => '72x72 icon for appel ipad' ,'type' => 'text');     
		
		$options[] = array( 'desc' => 'IPad retina icon', 'id' => 'ipad_retina_icon', 'help' => '144x144 icon for appel ipad retina' ,'type' => 'text' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( "title"=> "Custom Gravatar","desc"=> "Custom Gravatar","id" => "gravatar","type"=> "upload","itemstyle" => true);

	$options[] = array( 'title'  => 'Display breadcrumb','desc'  => 'Display breadcrumb','id'    => 'breadcrumb','type'  => 'checkbox','itemstyle'=> true );

	$options[] = array( 'title' => 'Disable Responsive','desc'  => 'Disable Responsive','id'    => 'disable_responsive','type'  => 'checkbox','itemstyle'=> true );    

	$options[] = array( 'title' => 'Update Notifier','desc'  => 'Enable','id'    => 'update_notifier','type'  => 'checkbox','itemstyle'=> true );
	
	$options[] = array( 'title' => 'Contact us page template email','desc'  => 'Contact us page template email','id'    => 'contact_email','type'  => 'text','help'=>'Default is admin email','itemstyle'=> true );

	$options[] = array( 'title'=> 'Header Code','help'=> 'The following code will add to the <head> tag. Useful if you need to add additional scripts such as CSS or JS.','id'=> 'header-code','type'=> 'textarea',"itemstyle" => true );

	$options[] = array( 'title'=> 'Footer Code','help'=> 'The following code will add to the footer before the closing </body> tag. Useful if you need to Javascript or tracking code.','id'=> 'footer-code','type'=> 'textarea',"itemstyle" => true );

	$options[] = array( 'type'=> 'close' );
/*
*   Default Layouts
*******************************************/
	$options[] = array( 'title'     => 'Default Layouts','type'      => 'open');

	$options[] = array( 'title' => 'Default Layouts (Home, archive, category, search, etc...)','type'  => 'openitem');

	$options[] = array('desc'  => 'Posts Layout',
				  'id'     => 'post_layout',
				  'opts'  =>  array( '1 column with sidebar'  => 'one_col_sid',
				  			 '2 culumns with sidebar' => 'two_col_sid',
				  			 '2 culumns full width' => 'two_col_full',
				  			 '3 culumns full width' => 'three_col_full' ),
				  'type'  => 'radio' );

	$options[] = array('desc'  => 'Display Content',
				  'id'     => 'display_content',
				  'opts'  =>  array( 'Excerpt' => 'excerpt','Full Content ( You should insert More tag in your post to display read more link )'=> 'full','None'=> 'none' ),
				  'type'  => 'radio' );

	$options[] = array( 'desc' => 'Excerpt Length',
				   'id'    => 'excerpt_length',
				   'help' => 'default is 31 words', 
				   'type' => 'text' );

	$options[] = array( 'desc' => 'Hide Post Ribbon', 'id' => 'ribbon','type' => 'checkbox' );
	
	$options[] = array( 'desc' => 'Hide Post Meta', 'id' => 'post_meta','type' => 'checkbox' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title' => 'Post Meta & Post ribbon Settings', 'type'  => 'openitem' );
	
	$options[] = array( 'desc' => 'Display format icon', 'id'    => 'format_icon','type' => 'checkbox' );
	$options[] = array( 'desc' => 'Display Post Date', 'id'    => 'meta_date', 'type'  => 'checkbox' ); 
	$options[] = array( 'desc' => 'Display Post Author','id'    => 'meta_author','type'  => 'checkbox' );
	$options[] = array( 'desc' => 'Display Post Category','id'    => 'meta_cat','type'  => 'checkbox' );
	$options[] = array( 'desc' => 'Display Comments Number','id'    => 'meta_comments','type'  => 'checkbox' );
	$options[] = array( 'desc' => 'Display Post views', 'id'    => 'meta_views','type'  => 'checkbox' );
	$options[] = array( 'desc' => 'Display Post likes', 'id'    => 'meta_likes', 'type'  => 'checkbox' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title' => 'Posts Navigation', 'type'  => 'openitem' );

		$options[] = array('desc'  => 'Posts Navigation type',
					  'id'     => 'pagination',
					  'opts'  =>  array( 'Ajax Load More' => 'ajax','Simple Navigation'=> 'simple' ),
					  'type'  => 'radio' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'type'      => 'close');

/*
*  Single Post
*******************************************/
	$options[] = array( 'title' => 'Single Post Settings','type'  => 'open' );

	$options[] = array( 'title' => 'Single Post Settings','type'  => 'openitem' );

		$options[] = array( 'desc' => 'Show Featured image in single post ( for standard post format )', 'id'    => 'featured_img','type' => 'checkbox' );
		
		$options[] = array( 'desc' => 'Show Post Navigation','id'   => 'post_nav','type' => 'checkbox');    

		$options[] = array( 'desc' => 'Show author Box','id'   => 'author_box','type' => 'checkbox');     
		
		$options[] = array( 'desc' => 'Hide Post Ribbon', 'id' => 'single_ribbon','type' => 'checkbox' );
		
		$options[] = array( 'desc' => 'Hide Post Meta', 'id' => 'single_meta','type' => 'checkbox' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title' => 'Post Meta & Post ribbon Settings', 'type'  => 'openitem' );
	
		$options[] = array( 'desc' => 'Display format icon', 'id'    => 'single_format_icn','type' => 'checkbox' );
		$options[] = array( 'desc' => 'Display Post Date','id'    => 'single_date','type'  => 'checkbox' );
		$options[] = array( 'desc' => 'Display Comments Number','id'    => 'single_comments','type'  => 'checkbox' );
		$options[] = array( 'desc' => 'Display Post Author','id'    => 'single_author','type'  => 'checkbox' );
		$options[] = array( 'desc' => 'Display Post Category','id'    => 'single_cat','type'  => 'checkbox' );
		$options[] = array( 'desc' => 'Display Post views','id'    => 'single_views','type'  => 'checkbox' );
		$options[] = array( 'desc' => 'Display Post likes','id'    => 'single_likes','type'  => 'checkbox' );
		$options[] = array( 'title' => 'Display Meta Tags','desc'  => 'Display Meta Tags','id'    => 'single_tag','type'  => 'checkbox' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title'  =>'Share post','desc'  => 'Share post','id'    => 'share_post','type'  => 'checkbox','itemstyle' => true );

	$options[] = array( 'title'  => 'Share post settings','type'   => 'openitem' );

		$options[] = array( 'desc'  => 'Facebook Like Button','id'    => 'fb_button','type'  => 'checkbox' );

		$options[] = array( 'desc'  => 'Tweet Button','id'    => 'tweet_button','type'  => 'checkbox' );

		$options[] = array( 'desc'  => 'Google+ Button','id'    => 'google_button','type'  => 'checkbox' );

		$options[] = array( 'desc'  => 'Linkedin button','id'    => 'linkedin_button','type'  => 'checkbox' );

		$options[] = array( 'desc'  => 'Stumbleupon button','id'    => 'stumbleupon_button','type'  => 'checkbox' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title'  => 'Related Posts Settings','type'   => 'openitem' );

		$options[] = array( 'desc'  => 'Enable','id'    => 'related_posts','type'  => 'checkbox' );

		$options[] = array( 'desc'  => 'Related Title','id'    => 'related_title','type'  => 'text', 'help' => 'default is < Related Articles >' );
		
		$options[] = array( 'desc'  => 'Number of posts','id'    => 'related_number','smallinput' => true,'type'  => 'text' );

		$options[] = array( 'desc'  => 'Related By:','id'    => 'related_by','opts'  =>  array( 'Tag' => 'tag', 'Category' => 'category','Author'   => 'author' ),'type'  => 'radio'  );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'type'  => 'close' );

/**
*	Home Carousel Settings
**********************************************/
	$options[] = array( 'title' => 'Home Carousel','type'  => 'open' );

	$options[] = array( 'title'     => 'Home Carousel Settings', 'type'      => 'openitem');

		$options[] = array( 'desc'  => 'Enable home carousel', 'id'    => 'home_carousel', 'type'  => 'checkbox' );
		
		$options[] = array( 'desc' => 'Number of posts', 'id'    => 'carousel_number', 'type'  => 'text', 'smallinput' => true );

		$options[] = array( "desc" => "Posts order by","id"    => "carousel_by","type"  => "select", "opts"  => array("Recent"=>"date","Popular by comments"=>"comment_count","Random"=>"rand","Popular by views"=>"views","Popular by likes"=>"likes"));
		
		$options[] = array( "desc" => "Category","id"    => "carousel_cats","type"  => "select", "category" => true , "emp_val" => true ,"empty_name" => "All" ,"help" => "default is all");
	
		$options[] = array( 'desc'  => 'Hide carousel post meta', 'id'    => 'hide_carousel_meta', 'type'  => 'checkbox' );

		$options[] = array( 'desc'  => 'Hide carousel post format icon', 'id'    => 'hide_carousel_format', 'type'  => 'checkbox' );

	$options[] = array( 'type'      => 'closeitem');

	$options[] = array( 'type'  => 'close' );

/*
* Header Settings
*******************************************/
	$options[] = array( 'title'  => 'Header Settings','type'   => 'open');

	$options[] = array( 'title'  => 'Header Settings','type'  => 'openitem');

		$options[] = array( 'desc'=> 'Logo Setting','id'=> 'logo-setting','opts'=> array('Custom Image Logo'  => 'logo','Display Site Title' => 'title' ),'type'=> 'radio' );

	$options[] = array( "type"  => "closeitem" );

	$options[] = array( 'title'  => 'Custom Logo Image','type'  => 'openitem');

		$options[] = array( "desc"=> "Logo image","id"=> "logo-img","help"=> "Upload a logo for your theme, or specify the image url of your online logo.","type"=> "upload");
		
		$options[] = array( "desc"=> "Logo image for retina display (optional)","id"=> "retina_logo","type"=> "upload");
	
	$options[] = array( "type"  => "closeitem" );

	$options[] = array( 'title'  => 'Top Bar Settings','type'  => 'openitem');

		$options[] = array( 'desc'=> 'Enable website description','id'=> 'sitedesc','type'=> 'checkbox');
		$options[] = array( 'desc'=> 'Enable Social icons','id'=> 'header_social','type'=> 'checkbox');

	$options[] = array( "type"  => "closeitem" );	

	$options[] = array( 'title'  => 'Navigation Menu settings','type'  => 'openitem');

		$options[] = array( 'desc'=> 'Enable Navigation search','id'=> 'nav_search','type'=> 'checkbox');
		$options[] = array( 'desc'=> 'Enable Sticky Navigation','id'=> 'sticky_nav','type'=> 'checkbox');

	$options[] = array( "type"  => "closeitem" );

	$options[] = array( 'type'  => 'close' );

/*
* Footer Settings
*******************************************/
	$options[] = array( 'title' => 'Footer Settings','type'  => 'open' );

	$options[] = array( "title"     => "Disable Footer Widgets",  "desc"     => "Disable Footer Widgets","id"=> "dsb_ft_widget","type"      => "checkbox","itemstyle" => true);

	$options[] = array( 'title'     => 'Footer settings', 'type'      => 'openitem');

		$options[] = array( 'title' => 'Back to Top icon', 'desc'  => 'Back to Top icon', 'id'    => 'back-to-Top', 'type'  => 'checkbox' );

		$options[] = array( 'desc' => 'Footer menu','id'    => 'footer_menu','type'  => 'checkbox');
	
	$options[] = array( 'type'      => 'closeitem');

		$options[] = array( 'title' => 'Footer Copyright','id'    => 'footer-copyright','type'  => 'textarea','itemstyle' => true );

	$options[] = array( 'type'  => 'close' );

/*
*  archives settings
*******************************************/
    $options[] = array( 'title' => 'Archives Settings', 'type'  => 'open' );

    $options[] = array( 'title' => 'Rss Feed icon',
                                 'desc'   => 'Enable Rss Feed icon',
                                 'id'      => 'archives_rss',
                                 'type'  => 'checkbox',
                                 'itemstyle' => true );    

    $options[] = array( 'title' => 'Category Page Description',
                                 'desc'   => 'Enable/Disable',
                                 'id'      => 'cat_desc',
                                 'type'  => 'checkbox',
                                 'itemstyle' => true );


    $options[] = array( 'type'  => 'close' );

/*
*  Sidebars Settings
*******************************************/
	$options[] = array( 'title' => 'Sidebars Settings','type'  => 'open' );

	$options[] = array( "title"     => "Sidebar Layout",
	                              "desc"      => "Sidebar Layout",
	                              "id"        => "sidebar",
	                              "type"      => "radioimg",
	                              "opts"      => array( 'right'  => ADMIN_IMG . '/sidebar-right.png' ,
	                                                            'left'   => ADMIN_IMG . '/sidebar-left.png'),
	                              "itemstyle" => true);

	$options[] = array( "title"     => "Add sidebars","type"      => "openitem");

		$options[] = array( 'id'    => 'add_sidebar','button'=> 'addsidebar','type'  => 'text' );

	$options[] = array( "type"      => "closeitem");

	$options[] = array( "title"     => "Custom sidebars settings","type"      => "openitem");

	    $options[] = array( "desc"      => "Home Page Sidebar","id" => "home_sidebar",   "type"=> "select","sidebarslist" => true);    

	    $options[] = array( "desc"      => "Single Post Sidebar",  "id"        => "article_sidebar",  "type"      => "select","sidebarslist" => true);     
	                        
	    $options[] = array( "desc"      => "Page Sidebar","id"=> "page_sidebar",   "type"=> "select","sidebarslist" => true);  

	    $options[] = array( "desc"      => "Archives Sidebar",  "id"=> "archives_sidebar", "type"=> "select",    "sidebarslist" => true); 

	$options[] = array( "type"      => "closeitem");

	$options[] = array( 'type'  => 'close' );
/*
*    Single Post Banners
*****************************************/

	$options[] = array( "title" => "Single Post Banners",  "type"  => "open");

	$options[] = array( "title"=> "Article Banner settings","type"=> "openitem");

		$options[] = array( "desc"=> "Enable","id"=> "ab_art_banner", "type"=> "checkbox");

		$options[] = array( "desc"=> "Banner type","id"=> "ab_art_banner_type","opts"=> array("Image" => "image","ads code" => "ads_code"),  "type"=> "radio");

	$options[] = array( "type"=> "closeitem");   

	$options[] = array( "title"=> "Article Banner image","type"=> "openitem");

		$options[] = array( "desc"=> "Banner Image","id"=> "ab_art_banner_img","type"=> "upload");

		$options[] = array( "desc"=> "Banner link","id"=> "ab_art_banner_link","type"=> "text");

		$options[] = array( "desc"=> "Open link in new tab","id"=> "ab_art_banner_tab","type"=> "checkbox");

	$options[] = array( "type"=> "closeitem");

	$options[] = array( "title"=> "Article ads code","type"=> "openitem");

		$options[] = array( "id"=> "ab_art_banner_ads","type"=> "textarea");

	$options[] = array( "type"=> "closeitem");

	$options[] = array( "title"=> "Shortcode ads","type"=> "openitem");

		$options[] = array( "desc"=> "ads type","id"=> "short_banner_type","help"=> "You can set this ads from your editor","opts"      => array("Image" => "image","ads code" => "ads_code"),   "type"      => "radio");

	$options[] = array( "type"=> "closeitem");   

	$options[] = array( "title"=> "Shortcode Banner image","type"      => "openitem");

		$options[] = array( "desc"=> "Banner Image","id"=> "short_banner_img","type"=> "upload");

		$options[] = array( "desc"=> "Banner link","id"=> "short_banner_link","type"=> "text");

		$options[] = array( "desc"=> "Open link in new tab","id"=> "short_banner_tab","type"=> "checkbox");

	$options[] = array( "type"=> "closeitem");

	$options[] = array( "title"=> "Shortcode ads code","type"=> "openitem");

		$options[] = array( "id"=> "short_banner_ads","type"=> "textarea");

	$options[] = array( "type"=> "closeitem");

	$options[] = array( "type" => "close");
/*
*    Social networks
*****************************************/
	$options[] = array( 'title' => 'Social networks','type'  => 'open' );

	$options[] = array( "title"  => "Social url's", "type"   => "openitem");

		$options[] = array( 'desc'      => 'Custom Feed URL','id'        => 'feed-url','help'      => 'e.g. http://feedburner.com/userid','type'      => 'text');

		$options[] = array( "desc"=> "Facebook","id"=> "facebook_url", "type"=> "text");

		$options[] = array( "desc"=> "Twitter","id"=> "twitter_url","type"=> "text");

		$options[] = array( "desc"=> "Youtube","id"=> "youtube_url","type"=> "text");

		$options[] = array( "desc"=> "Google+","id"=> "g_plus_url","type"=> "text");

		$options[] = array( "desc"=> "Dribbble","id"=> "dribbble_url","type"=> "text");

		$options[] = array( "desc"=> "Stumbleupon","id"=> "stumbleupon_url","type"=> "text");    

		$options[] = array( "desc"=> "Tumblr","id"=> "tumblr_url","type"=> "text");    

		$options[] = array( "desc"=> "Pinterest","id"=> "pinterest_url","type"=> "text");    

		$options[] = array( "desc"=> "Flickr","id"=> "flickr_url","type"=> "text");    

		$options[] = array( "desc"=> "Vimeo","id"=> "vimeo_url","type"=> "text");

		$options[] = array( "desc"=> "Instagram","id"=> "instagram_url","type"=> "text"); 

		$options[] = array( "desc"=> "Linkedin","id"=> "linkedin_url","type"=> "text");    

		$options[] = array( "desc"=> "Behance","id"=> "behance_url","type"=> "text");   

		$options[] = array( "desc"=> "Skype","id"=> "skype_url","type"=> "text");    
		
		$options[] = array( "desc"=> "Github","id"=> "github_url","type"=> "text");    

	$options[] = array( "type"=> "closeitem");

	$options[] = array( 'type'  => 'close' );

/*
*    Styling
*****************************************/
	$options[] = array( 'title'=> 'Styling', 'type'=> 'open');

	$options[] = array( 'title' => 'Choose predefined theme color',
	                        'id'    => 'skin',
	                        'opts'  => array("default"=>  ADMIN_IMG . '/skins/default.png',
	                                         "blue"  =>  ADMIN_IMG . '/skins/blue.png',
	                                         "red"    =>  ADMIN_IMG . '/skins/red.png',
	                                         "orange" =>  ADMIN_IMG . '/skins/orange.png',
	                                         "yellow"   =>  ADMIN_IMG . '/skins/yellow.png',
	                                         "gray"   =>  ADMIN_IMG . '/skins/gray.png',
	                                         "purple" =>  ADMIN_IMG . '/skins/purple.png',
	                                         "pink" =>    ADMIN_IMG . '/skins/pink.png',
	                                         "brown" =>   ADMIN_IMG . '/skins/brown.png'
	                                         ),
	                        'type'  => 'radioimg',
	                        'itemstyle' => true );

	$options[] = array( 'title' => 'Custom Theme Color','desc'  => 'Select Theme Color', 'id'=> 'theme_color', 'type'  => 'colorpicker', 'itemstyle' => true );

	$options[] = array( 'title' => 'background settings','desc'  => 'Background Type','id'    => 'bg_type','opts'  => array('Choose Pattern' => 'pattern','Custom background' => 'custom','Default' => ''),'type'  => 'radio','itemstyle' => true);
	
	$options[] = array( 'title' => 'Choose Pattern', 'type'  => 'openitem' );

		$options[] = array('id'    => 'pattern',
		                        'opts'  => array(
		                                        'pattern1_102x78'  => ADMIN_IMG . '/patterns/pattern1.png',
		                                        'pattern2_160x160'  => ADMIN_IMG . '/patterns/pattern2.png',
		                                        'pattern3_46x29'  => ADMIN_IMG . '/patterns/pattern3.png',
		                                        'pattern4_46x29'  => ADMIN_IMG . '/patterns/pattern4.png',
		                                        'pattern5_410x410'  => ADMIN_IMG . '/patterns/pattern5.png',
		                                        'pattern6_16x16'  => ADMIN_IMG . '/patterns/pattern6.png',
		                                        'pattern7_46x23'  => ADMIN_IMG . '/patterns/pattern7.png',
		                                        'pattern8_188x188'  => ADMIN_IMG . '/patterns/pattern8.png',
		                                        'pattern9_512x512'  => ADMIN_IMG . '/patterns/pattern9.png',
		                                        'pattern10_25x25' => ADMIN_IMG . '/patterns/pattern10.png',
		                                        'pattern11_200x200' => ADMIN_IMG . '/patterns/pattern11.png',
		                                        'pattern12_200x200' => ADMIN_IMG . '/patterns/pattern12.png',
		                                        'pattern13_100x100' => ADMIN_IMG . '/patterns/pattern13.png',
		                                        'pattern14_500x500' => ADMIN_IMG . '/patterns/pattern14.png',
		                                        'pattern15_188x178' => ADMIN_IMG . '/patterns/pattern15.png',
		                                        'pattern16_397x322' => ADMIN_IMG . '/patterns/pattern16.png',
		                                        'pattern17_350x259' => ADMIN_IMG . '/patterns/pattern17.png',
		                                        'pattern18_149x139' => ADMIN_IMG . '/patterns/pattern18.png',
		                                        'pattern19_150x150' => ADMIN_IMG . '/patterns/pattern19.png',
		                                        'pattern20_8x8' => ADMIN_IMG . '/patterns/pattern20.png'),
		                        'type'  => 'radioimg');

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title' => 'Custom background', 'type'  => 'openitem' );

		$options[] = array( 'desc'  => 'Background image', 'id'=> 'custom_bg','type'  => 'upload' );

		$options[] = array( 'desc'  => 'full screen background','id'=> 'full_screen_bg','type'  => 'checkbox' );

		$options[] = array( 'desc'  => 'background-color','id'    => 'bg_color', 'type'  => 'colorpicker' );

		$options[] = array( 'desc'  => 'background-repeat','id'    => 'bg_repeat', 'opts'  => array(""=>"","repeat"=>"repeat","no-repeat"=>"no-repeat","repeat-x"=>"repeat-x","repeat-y"=>"repeat-y"),'type'  => 'select' );

		$options[] = array( 'desc'  => 'background-attachment','id'    => 'bg_attachment','opts'  => array(""=>"", "fixed"=>"fixed","scroll"=>"scroll"), 'type'  => 'select' );

		$options[] = array( 'desc'  => 'background-position horizontal','id'    => 'bg_pos_x', 'opts'  => array(""=>"","left"=>"left","right"=>"right","center"=>"center"),'type'  => 'select' );

		$options[] = array( 'desc'  => 'background-position vertical','id'    => 'bg_pos_y', 'opts'  => array(""=>"","top"=>"top","bottom"=>"bottom","center"=>"center"),'type'  => 'select' );

	$options[] = array( 'type'  => 'closeitem' );	

	$options[] = array( 'title' => 'links styling', 'type'  => 'openitem' );

		$options[] = array( 'desc'  => 'links color', 'id'    => 'links_color','type'  => 'colorpicker' );

		$options[] = array( 'desc'  => 'links hover color', 'id'    => 'links_hover','type'  => 'colorpicker' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title' => 'Header styling','type'  => 'openitem' );

		$options[] = array( 'desc'  => 'Top bar background color','id'    => 'top_br_bg','type'  => 'colorpicker' );

		$options[] = array( 'desc'  => 'Top bar Social icons color','id'    => 'top_br_social_color','type'  => 'colorpicker' );
		
		$options[] = array( 'desc'  => 'Top bar Social icons on hover color','id'    => 'top_br_social_hover','type'  => 'colorpicker' );

		$options[] = array( 'desc'  => 'Main Navigation Background','id'    => 'nav_bg','type'  => 'colorpicker' );
		
		$options[] = array( 'desc'  => 'Navigation Search icon color','id'    => 'nav_search_color','type'  => 'colorpicker' );
		
		$options[] = array( 'desc'  => 'Main Navigation Links Color','id'    => 'nav_links_color','type'  => 'colorpicker' );

		$options[] = array( 'desc'  => 'Main Navigation Links on Hover Color','id'    => 'nav_links_hover','type'  => 'colorpicker' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title' => 'Container Styling','type'  => 'openitem' );

		$options[] = array( 'desc'  => 'Content background color','id'    => 'content_bg','type'  => 'colorpicker' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title' => 'Footer Styling','type'  => 'openitem' );

		$options[] = array( 'desc'  => 'Footer widgets background color','id'    => 'footer_bg','type'  => 'colorpicker' );

		$options[] = array( 'desc'  => 'Footer widgets title color','id'    => 'footer_title','type'  => 'colorpicker' );    

		$options[] = array( 'desc'  => 'footer widgets text color','id'    => 'footer_text','type'  => 'colorpicker' );
		
		$options[] = array( 'desc'  => 'footer widgets links color','id'    => 'footer_links','type'  => 'colorpicker' );

		$options[] = array( 'desc'  => 'footer widgets links hover color','id'    => 'footer_hover','type'  => 'colorpicker' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title' => 'Footer bottom Styling','type'  => 'openitem' );

		$options[] = array( 'desc'  => 'Footer bottom background color','id'    => 'footer_bottom_bg','type'  => 'colorpicker' );

		$options[] = array( 'desc'  => 'Footer bottom text color','id'    => 'footer_bottom_text','type'  => 'colorpicker' );    

		$options[] = array( 'desc'  => 'Footer bottom links color','id'    => 'footer_bottom_links','type'  => 'colorpicker' );

		$options[] = array( 'desc'  => 'Footer bottom links hover color','id'    => 'footer_bottom_hover','type'  => 'colorpicker' );

	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'type'  => 'close' );

/*
*    Typography
*****************************************/
	$options[] = array( 'title'=> 'Typography', 'type' => 'open');

	$options[] = array( 'title'=> 'Character sets', 'type' => 'openitem');

			$options[] = array( "desc"=> "Cyrillic Extended (cyrillic-ext)","id"=> "cyrillic_ext","type"=> "checkbox");	
			$options[] = array( "desc"=> "Greek Extended (greek-ext)","id"=> "greek_ext","type"=> "checkbox");	
			$options[] = array( "desc"=> "Greek (greek)","id"=> "greek","type"=> "checkbox");	
			$options[] = array( "desc"=> "Vietnamese (vietnamese)","id"=> "vietnamese","type"=> "checkbox");	
			$options[] = array( "desc"=> "Latin Extended (latin-ext)","id"=> "latin_ext","type"=> "checkbox");	
			$options[] = array( "desc"=> "Cyrillic (cyrillic)","id"=> "cyrillic","type"=> "checkbox");	
		
	$options[] = array( 'type'  => 'closeitem' );

	$options[] = array( 'title'=> 'General','id'   => 'general','type' => 'webfonts','itemstyle'=> true);

	$options[] = array( 'title'=> 'Main Navigation','id'   => 'header_ty_menu','type' => 'webfonts','itemstyle'=> true);

	$options[] = array( 'title'=> 'Post title','id'   => 'post_title','type' => 'webfonts','itemstyle'=> true);

	$options[] = array( 'title'=> 'Sidebar widgets title','id'   => 'sidebar_title','type' => 'webfonts','itemstyle'=> true);

	$options[] = array( 'title'=> 'Sections title (Author info, related posts, etc ...)','id'   => 'boxes_title','type' => 'webfonts','itemstyle'=> true);

	$options[] = array( 'title'=> 'Footer widgets title','id'   => 'foot_title','type' => 'webfonts','itemstyle'=> true);

	$options[] = array( 'title'=> 'Archives page title','id'   => 'archives_title','type' => 'webfonts','itemstyle'=> true);

	$options[] = array( 'title'=> 'Single post title','id'   => 'single_post_title','type' => 'webfonts','itemstyle'=> true);

	$options[] = array( 'title'=> 'Entry Meta','id'   => 'entry_meta','type' => 'webfonts','itemstyle'=> true);

	$options[] = array( 'title'=> 'Entry content','id'   => 'entry_content','type' => 'webfonts','itemstyle'=> true);

	$options[] = array( 'title' => 'Post Headings','type'  => 'openitem');

		$options[] = array( 'desc'=> 'Heading 1 (H1)','id'   => 'heading1','type' => 'webfonts');

		$options[] = array( 'desc'=> 'Heading 2 (H2)','id'   => 'heading2','type' => 'webfonts');

		$options[] = array( 'desc'=> 'Heading 3 (H3)','id'   => 'heading3','type' => 'webfonts');

		$options[] = array( 'desc'=> 'Heading 4 (H4)','id'   => 'heading4','type' => 'webfonts');

		$options[] = array( 'desc'=> 'Heading 5 (H5)','id'   => 'heading5','type' => 'webfonts');   

		$options[] = array( 'desc'=> 'Heading 6 (H6)','id'   => 'heading6','type' => 'webfonts');

	$options[] = array( 'type' => 'closeitem');

	$options[] = array( 'type' => 'close');

/**
*    Custom css
*****************************************/
	$options[] = array( 'title'=> 'Custom Css', 'type'=> 'open');

	$options[] = array( 'title'=> 'Global CSS','id'=> 'global_css','type'=> 'textarea','itemstyle'=> true);

	$options[] = array( 'title'=> 'Custom for tablets','id'=> 'tablets_css','type'=> 'textarea','itemstyle'=> true);

	$options[] = array( 'title'=> 'Custom for Phones','id'=> 'phone_css','type'=> 'textarea','itemstyle'=> true);

	$options[] = array( 'title'=> 'Custom for Wide Phones','id'=> 'wide_css','type'=> 'textarea','itemstyle'=> true);

	$options[] = array( 'type'  => 'close' );
/*
*    SEO
*****************************************/
$options[] = array( 'title'=> 'SEO','type'    => 'open');

	$options[] = array( 'title'=> 'Meta Description','id'=> 'meta_desc','type'=> 'textarea','help' => 'If you use a SEO plugin like (WordPress SEO by Yoast plugin), you don\'t need to use this option ','itemstyle'=> true);
	
	$options[] = array( 'title'=> 'Meta Keywords','id'=> 'meta_key','type'=> 'textarea','help' => 'If you use a SEO plugin like (WordPress SEO by Yoast plugin), you don\'t need to use this option ','itemstyle'=> true);

	$options[] = array( "title"  => "Social Metadata", "type"   => "openitem");

		$options[] = array('desc'=> 'Enable Twitter Metadata. ','help' => 'If you use a SEO plugin like (WordPress SEO by Yoast plugin), you don\'t need to use this option ','id'=> 'twitter_md','type'=> 'checkbox');
		
		$options[] = array('desc'=> 'Enable Facebook Metadata.','help' => 'If you use a SEO plugin like (WordPress SEO by Yoast plugin), you don\'t need to use this option ','id'=> 'facebook_md','type'=> 'checkbox');

	$options[] = array(  "type"   => "closeitem");


$options[] = array( 'type'=> 'close' );
/**
*	Twitter Settings
*******************************************/
	$options[] = array( 'title'=> 'Twitter Settings','type'    => 'open');

	$options[] = array( "title"  => "twitter settings", "type"   => "openitem");

		$options[] = array( "desc"=> "Twitter Username","id" => "twitter_username","type"=> "text");

		$options[] = array( "desc"=> "Consumer key","id" => "twitter_consumer_key","type"=> "text");

		$options[] = array( "desc"=> "Consumer secret","id" => "twitter_consumer_secret","type"=> "text");

	$options[] = array(  "type"   => "closeitem");

	$options[] = array( 'type'=> 'close' );

/*
*   Backup
*****************************************/
	$options[] = array( 'title'=> 'Backup','type'    => 'open');

	$options[] = array( 'title'=> 'Export','id'=> 'export','type'=> 'textarea','itemstyle'=> true);

	$options[] = array( 'title'=> 'Import','id'=> 'import','type'=> 'textarea','itemstyle'=> true);

	$options[] = array( 'type'=> 'close' );