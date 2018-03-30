<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php //get theme options
global $oswc_front, $oswc_other, $oswc_ads, $oswc_misc, $oswcPostTypes;

//set theme options
$oswc_demo = $oswc_misc['demo'];
$oswc_background = $oswc_misc['background'];
$oswc_background_fixed = $oswc_misc['background_fixed'];
$oswc_logo = $oswc_misc['logo'];
$oswc_logo_iphone = $oswc_misc['logo_iphone'];
$oswc_logo_ipad = $oswc_misc['logo_ipad'];
$oswc_color_scheme = $oswc_misc['color_scheme'];
$oswc_logo_bar_image = $oswc_misc['logo_bar_image'];
$oswc_hide_logo_bar_bg = $oswc_misc['hide_logo_bar_bg'];
$oswc_top_widget_show = $oswc_misc['top_widget_show'];
$oswc_skin = $oswc_misc['skin'];
$oswc_dontmiss_hide = $oswc_misc['dontmiss_hide'];
$oswc_latest_hide = $oswc_misc['latest_hide'];
$oswc_search_show = $oswc_misc['search_show'];
$oswc_random_show = $oswc_misc['random_show'];
$oswc_latest_hide = $oswc_misc['latest_hide'];
$oswc_sub_menu_hide = $oswc_misc['sub_menu_hide'];
$oswc_header_ad_hide = $oswc_ads['header_ad_hide'];
$oswc_header_ad = $oswc_ads['header_ad'];
$oswc_menu_ad_hide = $oswc_ads['menu_ad_hide'];
$oswc_menu_ad = $oswc_ads['menu_ad'];
$oswc_latest_ad_hide = $oswc_ads['latest_ad_hide'];
$oswc_latest_ad = $oswc_ads['latest_ad'];
$oswc_shortcodeslider_duration = $oswc_front['shortcodeslider_duration'];
$oswc_archive_dontmiss_hide = $oswc_other['archive_dontmiss_hide'];
$oswc_search_dontmiss_hide = $oswc_other['search_dontmiss_hide'];
$oswc_author_dontmiss_hide = $oswc_other['author_dontmiss_hide'];
$oswc_404_dontmiss_hide = $oswc_other['404_dontmiss_hide'];
$oswc_archive_latest_hide = $oswc_other['archive_latest_hide'];
$oswc_search_latest_hide = $oswc_other['search_latest_hide'];
$oswc_author_latest_hide = $oswc_other['author_latest_hide'];
$oswc_404_latest_hide = $oswc_other['404_latest_hide'];
$oswc_rss_feed = $oswc_misc['rss_feed'];
$oswc_facebook_url = $oswc_misc['facebook_url'];
$oswc_twitter_url = 'http://twitter.com/'.$oswc_misc['twitter_name'];
$oswc_responsive_tablet = $oswc_misc['responsive_tablet'];
$oswc_responsive_phone = $oswc_misc['responsive_phone'];

//set the default color scheme
if($oswc_color_scheme == '') $oswc_color_scheme="#C32C0D";
//set the skin variable for use in the body_class function - this only matters if it's dark since light is the default
if($oswc_skin=="dark") $skin="dark-skin";

//check what kind of page is displayed to see if the latest slider should be shown
if(is_archive()) {
	$oswc_latest_hide = $oswc_archive_latest_hide;	
	$oswc_dontmiss_hide = $oswc_archive_dontmiss_hide;	
} elseif(is_search()) {
	$oswc_latest_hide = $oswc_search_latest_hide;
	$oswc_dontmiss_hide = $oswc_search_dontmiss_hide;
} elseif(is_page_template('template-authors.php')) {
	$oswc_latest_hide = $oswc_author_latest_hide;
	$oswc_dontmiss_hide = $oswc_author_dontmiss_hide;
} elseif(is_404()) {
	$oswc_latest_hide = $oswc_404_latest_hide;
	$oswc_dontmiss_hide = $oswc_404_dontmiss_hide;
}

//see if we're on a review page. if so, create the reviewtype object and set a boolean review variable to true
$reviewPage = false;
$taxonomyPage = false;
$postTypeName = oswc_get_review_meta($post->ID);
$postTypeId = get_post_type(); //setup the posttypeid object, which is used below to determine which post type we're on
//review listing page
if(!empty($postTypeName) && ($oswcPostTypes->has_type($postTypeName) || $oswcPostTypes->has_type(strtolower($postTypeName)))){
	$reviewPage = true;	
	$reviewType = $oswcPostTypes->get_type_by_name($postTypeName); //get the review type object	
	$reviewDontmissEnabled=$reviewType->dontmiss_enabled;	
}
//review taxonomy page
if(is_tax()) {
	$reviewPage = true;
	$taxonomyPage = true; //this is a taxonomy page	
	$reviewType = $oswcPostTypes->get_type_by_id($postTypeId); //get the review type object
	$reviewDontmissEnabled=$reviewType->tax_dontmiss_enabled;	
} 
//single review page
if (is_single() && $oswcPostTypes->has_type($postTypeId, true)) {
	$reviewPage = true;
	$singlePage = true; //this is a single review page
	$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);	
	$reviewDontmissEnabled=$reviewType->single_dontmiss_enabled;	
}
if(empty($reviewType)) { //this is a taxonomy page for a taxonomy that doesn't have any posts
	$reviewPage = false;
	$taxonomyPage = false;
	$reviewDontmissEnabled=$reviewType->tax_dontmiss_enabled;	
}
//invert boolean dont-miss variable - i know this is nasty, don't hate...
if($reviewPage) {
	if($reviewDontmissEnabled) {
		$oswc_dontmiss_hide = false;
	} else {
		$oswc_dontmiss_hide = true;
	}
}

// use variables from page custom fields instead of made options page (if they exist)
if(!is_front_page() && !is_archive() && !is_search() && !is_page_template('template-authors.php') && !is_404()) {
	$override = get_post_meta($post->ID, "Hide Don't Miss", $single = true);
	if($override!="" && $override!="null") {
		$oswc_dontmiss_hide=$override;
		if($oswc_dontmiss_hide=="false") {
			$oswc_dontmiss_hide=false;	
		} else {
			$oswc_dontmiss_hide=true;
		}
	}
	$override = get_post_meta($post->ID, "Hide Latest", $single = true);
	if($override!="" && $override!="null") {
		$oswc_latest_hide=$override;
		if($oswc_latest_hide=="false") {
			$oswc_latest_hide=false;	
		} else {
			$oswc_latest_hide=true;
		}
	}
	$override = get_post_meta($post->ID, "Hide Header Ad", $single = true);
	if($override!="" && $override!="null") {
		$oswc_header_ad_hide=$override;
		if($oswc_header_ad_hide=="false") {
			$oswc_header_ad_hide=false;	
		} else {
			$oswc_header_ad_hide=true;
		}
	}
	$override = get_post_meta($post->ID, "Hide Menu Ad", $single = true);
	if($override!="" && $override!="null") {
		$oswc_menu_ad_hide=$override;
		if($oswc_menu_ad_hide=="false") {
			$oswc_menu_ad_hide=false;	
		} else {
			$oswc_menu_ad_hide=true;
		}
	}
	$override = get_post_meta($post->ID, "Hide Latest Ad", $single = true);
	if($override!="" && $override!="null") {
		$oswc_latest_ad_hide=$override;
		if($oswc_latest_ad_hide=="false") {
			$oswc_latest_ad_hide=false;	
		} else {
			$oswc_latest_ad_hide=true;
		}
	}	
	$override = get_post_meta($post->ID, "Background Image URL", $single = true);
	if($override!="" && $override!="null") {
		$oswc_background=$override;	 //set this variable so the css block below actually runs	
	}	
} else {
	$usemainbg=true;
}
?>

<?php if ( ! isset( $content_width ) ) $content_width = 960; ?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    
    <?php if($oswc_responsive_tablet || $oswc_responsive_phone) { ?><meta name="viewport" content="width=device-width" /><?php } ?>
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		<?php //Print the <title> tag based on what is being viewed         
        global $page, $paged;         
        wp_title( '|', true, 'right' );         
        // Add the blog name.         
        bloginfo( 'name' );         
        // Add the blog description for the home/front page.         
        $site_description = get_bloginfo( 'description', 'display' );         
        if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";         
        // Add a page number if necessary:         
        if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'made' ), max( $paged, $page ) );         
        ?>
	</title>
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" /> <!-- the main structure and main page elements style --> 
    
    <?php if($oswc_responsive_tablet) { ?><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive-tablet.css" type="text/css" media="screen" /> <!-- tablet responsive styles --><?php } ?>
    
    <?php if($oswc_responsive_phone) { ?><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive-phone.css" type="text/css" media="screen" /> <!-- phone responsive styles --><?php } ?>
    
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/js.css" type="text/css" media="screen" /> <!-- styles for the various jquery plugins -->
    <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" />
    <![endif]-->
    
    <!--[if IE 8]>
            <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" />
    <![endif]-->
    
    <!--[if gt IE 8]>
            <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie9.css" />
    <![endif]-->
    
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/custom.css" type="text/css" /> <!-- custom css for users to edit instead of built-in stylesheets -->
    
    <?php if($oswc_background_fixed) { ?>    
    	<style type="text/css">		
			body { background-attachment:fixed !important; }		
		</style>    
    <?php } ?>
    
    <?php //this style hack is necessary because of the custom function that adds the ancestor css attribute based
	//on the custom menu item title attribute. if this wasn't here, any menu item with a child would appear
	//as if it was the current active page ancestor.
	if(is_front_page()) { ?>
    	<style type="text/css">	
			#top-menu ul li.current_page_ancestor a, 
			#top-menu ul li.current_page_parent a {background:none;color: #DCE6EE;}
			#top-menu ul li a:hover, #top-menu ul li:hover a, #top-menu ul li.over a {background: #FFF;color: #000;}
    		.cat-menu ul li.current_page_ancestor a, 
			.cat-menu ul li.current_page_parent a {background:none;}
			.cat-menu ul li a:hover, .cat-menu ul li:hover a, .cat-menu ul li.over a {background: url(<?php echo get_template_directory_uri(); ?>/images/cat-menu-highlight.png) repeat-x 0px 0px;}
		</style>
    <?php } ?>
    
    <?php if($oswc_background!="" && $oswc_background!="none.png") { ?>  
    	<?php $specific_background = get_post_meta($post->ID, "Background Image URL", $single = true); ?>  
    	<style type="text/css">		
			body { background-position:center top;			
			<?php if($specific_background!="" && $specific_background!="null" && $usemainbg!=true) { ?>
				background-image:url(<?php echo $specific_background; ?>) !important;
			<?php } else { ?>
				background-image:url(<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-<?php echo $oswc_background; ?>);
			<?php } ?>
			<?php if(strpos($oswc_background,'stripe')!==false || strpos($oswc_background,'texture')!==false) { ?> 
				background-repeat:repeat;
			<?php } else { ?>
				background-repeat:no-repeat;
			<?php } ?>
			}
			#page-highlight {display:none;} /*only looks good with light bg, so just don't show it*/
			#top-menu-shadow {background:none;} /*still want the height of the element, just don't show it*/ }		
		</style>    
    <?php } ?>

	<!-- color scheme -->
	<style type="text/css">
        #logo-bar-wrapper {<?php if($oswc_logo_bar_image!='') { ?>background:url(<?php echo $oswc_logo_bar_image; ?>) no-repeat 0px 0px;<?php } ?>background-color:#<?php echo $oswc_color_scheme; ?>;}
		<?php if($oswc_hide_logo_bar_bg && !$reviewPage) { ?>
			#logo-bar-wrapper {background:none !important;}
			#top-menu-wrapper .ribbon-shadow-left, #top-menu-wrapper .ribbon-shadow-right {display:none;} /*ribbon shadows don't look right if logo bar has no bg*/
			#top-menu-wrapper {width:100%;} /*looks better with a full-width top bar if there is no logo bar bg*/
			#top-menu {margin:0px auto;}
			#logo-bar-shadow {display:none;} /*don't need the logo bar shadow anymore since it's transparent*/	
			#cat-menu {-moz-border-radius-topleft: 5px;border-top-left-radius: 5px;-moz-border-radius-topright: 5px;border-top-right-radius: 5px;margin-top:10px;} /*round the corners of the cat menu*/
		<?php } ?>
        #dontmiss-header {color:#<?php echo $oswc_color_scheme; ?>;}
    </style>
    
    <?php
	//this is a review page
	if($reviewPage){	
		$enabled = $reviewType->enabled; //this review type is enabled		
		$reviewColor = "#".$reviewType->color; //get the review color
		$reviewSkin = $reviewType->skin; //get the review skin
		if($reviewSkin=="dark") {
			$skin="dark-skin";
		} else {
			$skin="";
		}
		$logoBarImage =  $reviewType->logo_bar_image; //get the logobar background image
		$hideLogoBarBg = $reviewType->hide_logo_bar_bg; //completely hide the background of the logo bar
		$linkColor = "#".$reviewType->link_color; //get the review link color
		$bgColor = "#".$reviewType->bg_color; //get the background color if one is specified	
		$bgImage = $reviewType->bg_image; //get the background image if one is specified	
		$bgAttach = $reviewType->bg_attach; //get the background attachment
		$headerAdShow = $reviewType->header_ad_show; //get the unique header ad		
		$headerAd = $reviewType->header_ad; //get the unique header ad		
		$bgUnique = false; //variable to hold whether we should change the body bg at all
		$logo = $reviewType->logo; //get the logo for this review type
		$logo_iphone = $reviewType->logo_iphone; //get the logo for this review type - iphone responsive
		$logo_ipad = $reviewType->logo_ipad; //get the logo for this review type - iphone ipad
		$override = get_post_meta($post->ID, "Background Image URL", $single = true); //need to overwrite review type bg image with post or page-specific one
		if($override!="" && $override!="null") {$bgImage=$override;}
		if(!empty($logo)) {$oswc_logo=$logo;} //if a logo was specified, replace the default logo
		if(!empty($logo_iphone)) {$oswc_logo_iphone=$logo_iphone;} //if a logo was specified, replace the default logo
		if(!empty($logo_ipad)) {$oswc_logo_ipad=$logo_ipad;} //if a logo was specified, replace the default logo
		if(!empty($bgColor) || !empty($bgImage)) {$bgUnique=true;}	 //if we have a new bg color or image, set to true	
		if($headerAdShow==false) {$oswc_header_ad_hide=true;} //if header ad is not shown for this review type, set variable to hide it
		if(!empty($headerAd)) {$oswc_header_ad=$headerAd;} //if a header ad was specified, replace the default ad		
		$primaryTaxonomy = $reviewType->get_primary_taxonomy(); //get the primary taxonomy for this review type				
		//change css colors dynamically 		
		?>                
		<style type="text/css">	
			<?php if($bgUnique) { ?>			
				body {
					background-color:<?php if(!empty($bgColor)) { echo $bgColor.' !important'; } ?>; /*override the bg color*/
					background-image:<?php if(!empty($bgImage)) { 
						if($bgImage=="none") { ?> /*don't display a bg image*/
							none
						<?php } else { ?> 
							url(<?php echo $bgImage; ?>) !important /*override the bg image*/
						<?php } ?>
					<?php } elseif(!empty($bgColor)) {?>
						none
					<?php } ?>;
					background-position:center top;
					<?php if(strpos($bgImage,'stripe')!==false || strpos($bgImage,'texture')!==false || $bgImage=='') { ?> 
						background-repeat:repeat;
					<?php } else { ?>
						background-repeat:no-repeat;
					<?php } ?>
					background-attachment:<?php echo $bgAttach; ?> !important;}
				#page-highlight {display:none;} /*only looks good with light bg, so just don't show it*/
				#top-menu-shadow {background:none;} /*still want the height of the element, just don't show it*/
			<?php } ?>	
			<?php if(!empty($linkColor)) { ?>
				a:link, a:visited { color:<?php echo $linkColor; ?>; }
				a:hover {color:#999;}
			<?php } ?>	
			#logo-bar-wrapper {<?php if($logoBarImage!='') { ?>background:url(<?php echo $logoBarImage; ?>) no-repeat 0px 0px;<?php } else { ?>background:url(<?php echo get_template_directory_uri(); ?>/images/logo-bar-bg.png) repeat-x 0px 0px;<?php } ?>background-color:<?php echo $reviewColor; ?>;}
			<?php if($hideLogoBarBg) { ?>
				#logo-bar-wrapper {background:none !important;}
				#top-menu-wrapper .ribbon-shadow-left, #top-menu-wrapper .ribbon-shadow-right {display:none;} /*ribbon shadows don't look right if logo bar has no bg*/
				#top-menu-wrapper {width:100%;} /*looks better with a full-width top bar if there is no logo bar bg*/
				#logo-bar-shadow {display:none;} /*don't need the logo bar shadow anymore since it's transparent*/
				#top-menu {margin:0px auto;} /*make the top menu full width so it looks better*/
				#cat-menu {-moz-border-radius-topleft: 5px;border-top-left-radius: 5px;-moz-border-radius-topright: 5px;border-top-right-radius: 5px;margin-top:10px;} /*round the corners of the cat menu*/
			<?php } ?>
			.cat-menu ul li.current_page_item a, 
			.cat-menu ul li.current_page_ancestor a, 
			.cat-menu ul li.current_page_parent a {background:<?php echo $reviewColor; ?> url(<?php echo get_template_directory_uri(); ?>/images/cat-menu-current-highlight.png) repeat-x 0px 0px;border-top:1px solid <?php echo $reviewColor; ?>;}	
			/*if review mini-site front page is in a sub menu instead of being a main menu item, need to force review color as menu item bg color*/
			.cat-menu ul li.current_page_ancestor a, 
			.cat-menu ul li.current_page_parent a {background-color:<?php echo $reviewColor; ?>;}
			/*don't give sub menu items a new top border*/
			.cat-menu ul li.current_page_item li a, 
			.cat-menu ul li.current_page_ancestor li a, 
			.cat-menu ul li.current_page_parent li a {border-top:1px solid #2D2D2D;}	
			#dontmiss-header {color: <?php echo $reviewColor; ?>;}
			.review .overview .summary {background:<?php echo $reviewColor; ?> url(<?php echo get_template_directory_uri(); ?>/images/review-summary-bg.png) repeat-x 0px bottom;border:1px solid <?php echo $reviewColor; ?>;}
			.review .overview .positive-wrapper {border-bottom:1px solid <?php echo $reviewColor; ?>;}			
		</style>                
	<?php } ?>
    
    <?php 
	//set the default logo image
	if($oswc_logo_ipad == "") $oswc_logo_ipad = $oswc_logo;
	if($oswc_logo_iphone == "") $oswc_logo_iphone = $oswc_logo;
	?>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
    
    <?php wp_enqueue_script("jquery"); //load jquery ?>
    
	<?php wp_head(); ?>
	
</head>

<body <?php body_class($skin); ?>>

	<?php oswc_get_template_part('demo-panel'); ?>

	<div id="top-menu-wrapper"> <!-- begin top menu -->
    	
        <div class="ribbon-shadow-left">&nbsp;</div>
    
    	<div id="top-menu">
            
            <div class="container<?php if(!$oswc_search_show && !$oswc_top_widget_show) { ?> wide<?php } elseif($oswc_search_show) { ?> mid<?php } ?>">
            
            	<div id="top-menu-full">
            
					<?php //title attribute gets in the way - remove it
                    $menu = wp_nav_menu( array( 'theme_location' => 'top-menu', 'container' => 'div', 'fallback_cb' => false, 'container_class' => 'menu', 'echo' => '0' ) );
                    $menu = preg_replace('/title=\"(.*?)\"/','',$menu);
                    echo $menu;
                    ?>
                    
                    &nbsp;
                    
                </div>
                
                <div id="top-menu-compact">
                
					<?php //get a separate drop down menu for responsive
                    $menu_name = 'top-menu';
                    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
                        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                    
                        $menu_items = wp_get_nav_menu_items($menu->term_id);
                    
                        $menu_list = '<select id="select-menu-' . $menu_name . '"><option>'.__( 'Page Navigation','made').'</option>';
                    
                        foreach ( (array) $menu_items as $key => $menu_item ) {						
                            $title = $menu_item->title;
                            $url = $menu_item->url;
                            $parentid = $menu_item->menu_item_parent;
                            $indent = '';
                            if($parentid!=0) { //see if this item needs to be indented
                                $indent .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';							
                            }
                            $objectid = $menu_item->object_id;
                            $selected = '';
                            $selectedoption = '';
                            if(is_tax() || is_category() || is_tag()) { //see if this is the currently displayed taxonomy/category/tag listing
                                $termid = get_queried_object()->term_id;
                                if($termid == $objectid) {
                                    $selected = "selected";
                                    $selectedoption = 'selected="selected"';
                                }
                            } elseif($objectid == $post->ID) { //see if this is the currently displayed page
                                $selected = "selected";
                                $selectedoption = 'selected="selected"';
                            }
                            
                            $menu_list .= '<option ';
                            if($selectedoption!='') {
                                $menu_list .= $selectedoption;
                            }
                            $menu_list .= ' ';
                            if($selected!='') {
                                $menu_list .= 'class="' . $selected . '"';
                            }
                            $menu_list .= ' value="' . $url . '">' . $indent . $title . '</option>';
                        }
                        $menu_list .= '</select>';
                    } else {
                        $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
                    }
                    
                    echo $menu_list;
                    ?>
                    
                </div>
                
            </div>
            
            <?php if($oswc_top_widget_show) { ?> <!-- social widget by default -->
            
            	<div id="top-widget">
                
                	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Top Widget') ) : else : ?>
                        
                        <div class="top-social">
                        
                        	<a href="<?php echo $oswc_rss_feed; ?>" class="rss">&nbsp;</a>
                            
                            <a href="<?php echo $oswc_facebook_url; ?>" class="facebook">&nbsp;</a>
                            
                            <a href="<?php echo $oswc_twitter_url; ?>" class="twitter">&nbsp;</a>
                        
                        </div>
                    
                    <?php endif; ?>
                
                </div>
            
            <?php } ?>
            
            <?php if($oswc_search_show) { ?>
            
                <div id="search">
                
                    <div class="wrapper">
                    
                        <div class="inner">
                
                            <!-- SEARCH -->  
                            <form method="get" id="searchformtop" action="<?php echo home_url(); ?>/">                             
                                <input type="text" value="<?php _e( 'search', 'made' ); ?>" onfocus="if (this.value == '<?php _e( 'search', 'made' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'search', 'made' ); ?>';}" name="s" id="s" />          
                            </form>                       
                            
                        </div>
                        
                    </div>
                
                </div>
                
            <?php } ?>
            
            <br class="clearer" />
        
        </div>
        
        <div class="ribbon-shadow-right">&nbsp;</div>
    
    </div>
	
	<div id="page-wrapper"> <!-- everything below the top menu should be inside the page wrapper div -->
    
    	<div id="logo-bar-wrapper">  <!--begin the main header logo area-->

            <div id="logo-bar">
            
                <div id="logo-wrapper">
                
                    <div id="logo"><!--logo and section header area-->
            
                        <?php if($oswc_logo != "") { ?>
                            <a href="<?php echo home_url(); ?>/">
                                <img id="site-logo" alt="<?php bloginfo('name'); ?>" src="<?php echo $oswc_logo; ?>" /> 
                                <img id="site-logo-iphone" alt="<?php bloginfo('name'); ?>" src="<?php echo $oswc_logo_iphone; ?>" />
                                <img id="site-logo-ipad" alt="<?php bloginfo('name'); ?>" src="<?php echo $oswc_logo_ipad; ?>" />                               
                            </a>
                        <?php } else { ?>     
                            <h1><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></h1>
                        <?php } ?>
                        
                    </div>
                    
                    <br class="clearer" />
                    
                    <div class="subtitle<?php echo $subtitleclass; ?>"><?php bloginfo('description'); ?></div>
                    
                </div>  
                
                <?php if(!$oswc_header_ad_hide) { ?>
                    <div id="ad-header">  <!--header ad--> 
                        <?php echo do_shortcode($oswc_header_ad); // ad ?>        
                    </div>
                <?php } ?>
                
                <br class="clearer" />
                
            </div>
            
            <div id="logo-bar-shadow">&nbsp;</div>
            
        </div> <!--end the logo area -->
            
        <div id="cat-menu" class="cat-menu">
        
        	<div id="cat-menu-full">
        
                <a class="home-link" href="<?php echo home_url(); ?>">&nbsp;</a>
        
                <?php 
                //title attribute gets in the way - remove it
                $menu = wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => '0', 'fallback_cb' => 'fallback_categories', 'echo' => '0' ) );
                $menu = preg_replace('/title=\"(.*?)\"/','',$menu);
                echo $menu;
                ?> 
                
            </div>
            
            <div id="cat-menu-compact">
            
				<?php //get a separate drop down menu for responsive
                $menu_name = 'main-menu';
                if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
                    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                
                    $menu_items = wp_get_nav_menu_items($menu->term_id);
                
                    $menu_list = '<select id="select-menu-' . $menu_name . '"><option>'.__( 'Category Navigation','made').'</option>';
                
                    foreach ( (array) $menu_items as $key => $menu_item ) {
                        $title = $menu_item->title;
                        $url = $menu_item->url;
                        $parentid = $menu_item->menu_item_parent;
                        $indent = '';
                        if($parentid!=0) { //see if this item needs to be indented
                            $indent .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';							
                        }
                        $objectid = $menu_item->object_id;
                        $type = $menu_item->type;
                        $selected = '';
                        $selectedoption = '';
                        if((is_tax() || is_category() || is_tag()) && $type=='taxonomy') { //see if this is the currently displayed taxonomy
                            $termid = get_queried_object()->term_id;
                            if($termid == $objectid) {
                                $selected = "selected";
                                $selectedoption = 'selected="selected"';
                            }
                        } elseif($objectid == $post->ID && ($type == 'post_type')) { //see if this is the currently displayed page/post
                            $selected = "selected";
                            $selectedoption = 'selected="selected"';
                        }
                        
                        $menu_list .= '<option ';
                        if($selectedoption!='') {
                            $menu_list .= $selectedoption;
                        }
                        $menu_list .= ' ';
                        if($selected!='') {
                            $menu_list .= 'class="' . $selected . '"';
                        }
                        $menu_list .= ' value="' . $url . '">' . $indent . $title . '</option>';
                    }
                    $menu_list .= '</select>';
                } else {
                    $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
                }
                
                echo $menu_list;
                ?>  
                
            </div>                          
            
            <?php //random article button
            if ($oswc_random_show) { 
				$post_type = array('post');
				foreach($oswcPostTypes->postTypes as $postType) {
					array_push($post_type, $postType->id);
				}
				$args = array('posts_per_page' => 1, 'orderby' => 'rand', 'ignore_sticky_posts' => 1, 'post_type' => $post_type);
                $rand_loop = new WP_Query($args);
                if ($rand_loop->have_posts()) : while ($rand_loop->have_posts()) : $rand_loop->the_post();	
                    ?>
                
                    <div id="random-article">
                
                        <a title="<?php _e( 'Random Article', 'made' ); ?>" href="<?php the_permalink(); ?>"><img alt="<?php _e( 'Random Article', 'made' ); ?>" src="<?php echo get_template_directory_uri(); ?>/images/random-article.png" width="22" height="22" /></a>
                    
                    </div>
                    
                <?php endwhile; 
                endif; 
                wp_reset_query();?> 
                
            <?php } ?>
        
        </div> 
        
        <br class="clearer hide-responsive-small" />
        
        <?php
        //show taxonomy menu if this is a review page								
        if($reviewPage && $enabled){
            //get list of all terms in the primary taxononmy for this review type
            //we do not want to hide empty just in case the user only selects children and does
            //not select the parent taxonomy when creating posts. If one of the taxonomies
            //is never actually assigned to any posts but rather only its children are assigned,
            //then, if we hid empty taxonomies, the parent taxonomy would never show in the menu
            //even though there are posts inside of it (assigned to its children)												
            $terms = get_terms($primaryTaxonomy->id, array('parent' => 0, 'hide_empty' => 0));							
            if ($taxonomyPage) {
                //for taxonomy pages we use get_term_by to find the current term name
                $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                $current_term_name = $current_term->name;
                //echo "current term name=".$current_term_name;
                //echo "<br />primary tax=".$primaryTaxonomy->id;
                //echo "<br />current tax=".get_query_var( 'taxonomy' );
                
                //get top parent of the current taxonomy
                //only if the current taxonomy matches the primary taxonomy
                if($primaryTaxonomy->id==get_query_var( 'taxonomy' )) {
                    $top_parent = get_term_top_most_parent($current_term->term_id, $primaryTaxonomy->id); 
                    $top_parent_name = $top_parent->name;
                }
            } elseif ($singlePage) {
                //for single pages we use wp_get_object_terms to get all assigned terms for this page
                //and then just use the first one in case there are several assigned
                $current_terms = wp_get_object_terms($post->ID,$primaryTaxonomy->id);
                $current_term_name = $current_terms[0]->name;							
            }
            
            $count = count($terms);						
            if ( $count > 0 ){ ?> 
                             
                <div class="cat-menu tax">
                    <ul>
                        <?php foreach ( $terms as $term ) { 
                            $term_name = $term->name;
                            $term_slug = $term->slug;
                            $term_link = get_term_link($term_slug, $primaryTaxonomy->id);
                            $current_page_item=false;
                            //is this the current top level term?
                            if($singlePage) { //for single pages, look at all assigned terms and highlight all of them											
                                foreach ($current_terms as $current_term) {
                                    //echo "current_term_name=".$current_term->name;
                                    $top_parent = get_term_top_most_parent($current_term->term_id, $primaryTaxonomy->id); 
                                    $top_parent_name = $top_parent->name;
                                    if($term_name==$current_term->name || $term_name==$top_parent_name) {
                                        $current_page_item=true;
                                    }
                                }
                            } else { //for taxonomy pages, there can be only one selected current term to highlight
                                if($term_name==$current_term_name || $term_name==$top_parent_name) {
                                    $current_page_item=true;
                                }
                            }
                            ?>
                            <li <?php if($current_page_item) { ?>class="current_page_item"<?php } ?>>
                                <a href="<?php echo $term_link; ?>"><?php echo $term_name; ?></a>
                            </li>							
                        <?php } ?>
                    </ul>
                </div>
                
                <br class="clearer hide-responsive-small" />
                
            <?php } else { ?>
            	<div class="cat-menu tax">
                    <ul>
                    	<li><a href="#"><?php _e('You have not yet created any primary taxonomy items for this review type (or you have but they are empty).','made'); ?></a></li>
                    </ul>
                </div>
                
                <br class="clearer hide-responsive-small" />
                
            <?php }
        } elseif (!$oswc_sub_menu_hide) { ?>
        
        	<div class="cat-menu tax">
                <?php 
				//title attribute gets in the way - remove it
				$menu = wp_nav_menu( array( 'theme_location' => 'sub-menu', 'container' => '0', 'fallback_cb' => 'fallback_footer_menu', 'echo' => '0' ) );
				$menu = preg_replace('/title=\"(.*?)\"/','',$menu);
				echo $menu;
				?> 
            </div>
            
            <br class="clearer hide-responsive-small" />
			
		<?php } ?>
        
        <?php if(!$oswc_dontmiss_hide) { ?>
        
            <?php oswc_get_template_part('dont-miss'); ?>
        
        <?php } ?>
        
        <div id="main-wrapper">
        
        <div id="main-wrapper-dark"> <!-- this is only used for the dark skin since it already uses an image for the background texture and light does not -->
        
			<?php if(!$oswc_menu_ad_hide) { //the ad below the category menu ?>
            
                <div class="full-width-ad" id="menu-ad">  
                
                    <?php echo do_shortcode($oswc_menu_ad); ?>
                    
                </div>
            
            <?php } ?>
            
            <?php if(!$oswc_latest_hide) { ?>
            
                <?php oswc_get_template_part('latest'); ?>
            
            <?php } ?>
            
            <?php if(!$oswc_latest_ad_hide) { //the ad below the latest slider ?>
            
                <div class="full-width-ad" id="latest-ad">  
                
                    <?php echo do_shortcode($oswc_latest_ad); ?>
                    
                </div>                
            
            <?php } ?>              