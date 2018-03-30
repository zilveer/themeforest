<!DOCTYPE html>
<!--[if IE 6]><html class="ie ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9)  ]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<?php global $theme_prefix; ?>
	
	<!-- *********	PAGE TITLE	*********  -->
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<!-- *********	PAGE TOOLS	*********  -->

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="author" content="">

	<!-- *********	MOBILE TOOLS	*********  -->

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- *********	WORDPRESS TOOLS	*********  -->
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<!-- *********	FAVICON TOOLS	*********  -->
	
	<?php 

    if(empty($theme_prefix['favicon']['url'])){
		$theme_prefix['favicon']['url'] = "";
	}

	if(empty($theme_prefix['ipad_retina_icon']['url'])){
		$theme_prefix['ipad_retina_icon']['url'] = "";
	}

	if(empty($theme_prefix['iphone_icon_retina']['url'])){
		$theme_prefix['iphone_icon_retina']['url'] = "";
	}	

	if(empty($theme_prefix['ipad_icon']['url'])){
		$theme_prefix['ipad_icon']['url'] = "";
	}		

	if(empty($theme_prefix['iphone_icon']['url'])){
		$theme_prefix['iphone_icon']['url'] = "";
	}			

	if($theme_prefix['favicon']['url'] != "") { ?> <link rel="shortcut icon" href="<?php echo esc_attr($theme_prefix['favicon']['url']); ?>" /><?php } 
			else { ?> <link rel="shortcut icon" href="<?php echo THEMEROOT."/images/favicon.ico"; ?>" /> <?php } ?>
	
	<?php if($theme_prefix['ipad_retina_icon']['url'] != "")  { ?> <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo esc_attr($theme_prefix['ipad_retina_icon']['url']); ?>" /> <?php } ?>
	
	<?php if($theme_prefix['iphone_icon_retina']['url'] != "")  { ?> <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_attr($theme_prefix['iphone_icon_retina']['url']); ?>" /> <?php } ?>
	
	<?php if($theme_prefix['ipad_icon']['url'] != "")  { ?> <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_attr($theme_prefix['ipad_icon']['url']); ?>" /> <?php } ?>
	
	<?php if($theme_prefix['iphone_icon']['url'] != "")  { ?> <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo esc_attr($theme_prefix['iphone_icon']['url']); ?>" /> <?php } ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_header(); global $theme_prefix; ?>
	<?php if($theme_prefix['pre-header-visibility'] == "1"){ ?><!-- Pre-Header Start -->
	<div class="pre-header <?php echo esc_attr($theme_prefix['pre-header-style']); ?> clearfix">
		<div class="container">
			<div class="row"> 
				<div class="col-lg-12"> 
					<div class="pre-header-nav pull-left">
				        <?php if (has_nav_menu('pre-header-menu')) { ?><!-- Pre-Header Menu Start -->
					        <nav id="pre-header-menu">
					            <?php 
								 	wp_nav_menu(
								 		array(
								 		'theme_location' => 'pre-header-menu', 
								 		'container' => '', 
								 		'menu_class' => 'sf-menu navigate nav-collapse', 
								 		'menu_id' => 'nav',
								 		'walker' => new description_walker() 
										)
									);
					            ?>
					        </nav>
				        <?php } ?>	<!-- Pre-Header Menu Finish -->
			        </div>
			        <div class="social-media-search pull-right">
			        	<?php if($theme_prefix['header-social-media'] == "1"){ ?><!-- Social Media Start -->
			            <div class="header-social-media pull-left">
	                        <ul>
	                            <?php
	                            if ($theme_prefix['behance-header'] != "") { ?><li class="behance"><a title="<?php echo __("behance","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['behance-header']); ?>"><i class="fa fa-behance "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['deviantart-header'] != "") { ?><li class="deviantart"><a title="<?php echo __("deviantart","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['deviantart-header']); ?>"><i class="fa fa-deviantart "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['dribbble-header'] != "") { ?><li class="dribbble"><a title="<?php echo __("dribbble","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['dribbble-header']); ?>"><i class="fa fa-dribbble "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['facebook-header'] != "") { ?><li class="facebook"><a title="<?php echo __("Facebook","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['facebook-header']); ?>"><i class="fa fa-facebook "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['github-header'] != "") { ?><li class="github"><a title="<?php echo __("github","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['github-header']); ?>"><i class="fa fa-github "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['flickr-header'] != "") { ?><li class="flickr"><a title="<?php echo __("Flickr","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['flickr-header']); ?>"><i class="fa fa-flickr "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['foursquare-header'] != "") { ?><li class="foursquare"><a title="<?php echo __("Foursquare","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['foursquare-header']); ?>"><i class="fa fa-foursquare "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['google-plus-header'] != "") { ?><li class="google-plus"><a title="<?php echo __("Google +","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['google-plus-header']); ?>"><i class="fa fa-google-plus "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['instagram-header'] != "") { ?><li class="instagram"><a title="<?php echo __("Instagram","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['instagram-header']); ?>"><i class="fa fa-instagram "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['linkedin-header'] != "") { ?><li class="linkedin"><a title="<?php echo __("Linkedin","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['linkedin-header']); ?>"><i class="fa fa-linkedin "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['medium-header'] != "") { ?><li class="medium"><a title="<?php echo __("medium","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['medium-header']); ?>"><i class="fa fa-medium"></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['pinterest-header'] != "") { ?><li class="pinterest"><a title="<?php echo __("Pinterest","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['pinterest-header']); ?>"><i class="fa fa-pinterest "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['reddit-header'] != "") { ?><li class="reddit"><a title="<?php echo __("reddit","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['reddit-header']); ?>"><i class="fa fa-reddit "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['stumbleupon-header'] != "") { ?><li class="stumbleupon"><a title="<?php echo __("stumbleUpon","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['stumbleupon-header']); ?>"><i class="fa fa-stumbleupon "></i></li><?php } ?>
								<?php if ($theme_prefix['tumblr-header'] != "") { ?><li class="tumblr"><a title="<?php echo __("Tumblr","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['tumblr-header']); ?>"><i class="fa fa-tumblr "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['twitter-header'] != "") { ?><li class="twitter"><a title="<?php echo __("Twitter","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['twitter-header']); ?>"><i class="fa fa-twitter "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['vimeo-header'] != "") { ?><li class="vimeo"><a title="<?php echo __("Vimeo","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['vimeo-header']); ?>"><i class="fa fa-vimeo-square"></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['vine-header'] != "") { ?><li class="vine"><a title="<?php echo __("vine","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['vine-header']); ?>"><i class="fa fa-vine"></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['vk-header'] != "") { ?><li class="vk"><a title="<?php echo __("vk","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['vk-header']); ?>"><i class="fa fa-vk"></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['whatsapp-header'] != "") { ?><li class="whatsapp"><a title="<?php echo __("whatsapp","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['whatsapp-header']); ?>"><i class="fa fa-whatsapp"></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['wordpress-header'] != "") { ?><li class="wordpress"><a title="<?php echo __("wordpress","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['wordpress-header']); ?>"><i class="fa fa-wordpress"></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['youtube-header'] != "") { ?><li class="youtube"><a title="<?php echo __("Youtube","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['youtube-header']); ?>"><i class="fa fa-youtube "></i></a></li><?php } ?>
	                            <?php if ($theme_prefix['custom-site-name-1'] != "") { ?><li class="custom-logo custom-site-name-1"><a title="<?php echo __("custom-site-name-1","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['custom-site-url-1']); ?>"><img alt="<?php echo esc_attr($theme_prefix['custom-site-name-1']); ?>" src="<?php echo esc_attr($theme_prefix['custom-site-logo-1']['url']); ?>"></a></li><?php } ?>
	                            <?php if ($theme_prefix['custom-site-name-2'] != "") { ?><li class="custom-logo custom-site-name-2"><a title="<?php echo __("custom-site-name-2","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['custom-site-url-2']); ?>"><img alt="<?php echo esc_attr($theme_prefix['custom-site-name-2']); ?>" src="<?php echo esc_attr($theme_prefix['custom-site-logo-2']['url']); ?>"></a></li><?php } ?>
	                            <?php if ($theme_prefix['custom-site-name-3'] != "") { ?><li class="custom-logo custom-site-name-3"><a title="<?php echo __("custom-site-name-3","theme2035"); ?>" target="_blank" href="<?php echo esc_attr($theme_prefix['custom-site-url-3']); ?>"><img alt="<?php echo esc_attr($theme_prefix['custom-site-name-3']); ?>" src="<?php echo esc_attr($theme_prefix['custom-site-logo-3']['url']); ?>"></a></li><?php } ?>
	                        </ul> 		            
			            </div>
			            <?php } ?><!-- Social Media Finish -->
			            <?php if($theme_prefix['header-search'] == "1"){ ?><!-- Search Start -->
			            <div class="header-search pull-left">
			            	<?php get_search_form(); ?>
			            </div>
			            <?php } ?><!-- Search Finish -->
			        </div>	
				</div>
			</div>
		</div>
	</div>
	<?php } ?><!-- Pre-Header Finish -->
	<div class="main-header clearfix"><!-- Main Header Start -->
		<div id="event"><!-- Event Container Start -->
			<?php if($theme_prefix['event-visibility'] == "1"){ ?>
	    	<div id="event-details" class="event-back clearfix" style="background:url('<?php echo esc_attr($theme_prefix['event-background']['url']); ?>') no-repeat;">
	    		<div class="container event-close-container"><div class="event-close-button"><a href="#"><i class="fa fa-times"></i></a></div></div>
				<div class="mask">
				<div class="container">
					<fieldset>
						<legend><?php if($theme_prefix['event-title'] != ""){ ?><?php echo esc_attr($theme_prefix['event-title']); ?><?php } ?></legend>
						<ul>
							<?php if($theme_prefix['event-date'] != ""){ ?><li><p><i class="fa fa-calendar"></i><?php echo esc_attr($theme_prefix['event-date']); ?></p></li><?php } ?>
							<?php if($theme_prefix['event-period'] != ""){ ?><li><p><i class="fa fa-clock-o"></i><?php echo esc_attr($theme_prefix['event-period']); ?></p></li><?php } ?>
							<?php if($theme_prefix['event-address'] != ""){ ?><li><p><i class="fa fa-map-marker"></i><?php echo esc_attr($theme_prefix['event-address']); ?><?php } ?> <?php if($theme_prefix['event-location'] != ""){ ?><a href="<?php echo esc_attr($theme_prefix['event-location']); ?>"><?php echo __("See in Map","2035Themes-fm"); ?></a></p></li><?php } ?>
							<?php if($theme_prefix['event-desc'] != ""){ ?><li><p class="margint40 marginb30"><?php echo esc_attr($theme_prefix['event-desc']); ?></p></li><?php } ?>
							<?php if($theme_prefix['event-link'] != ""){ ?><li><a href="<?php echo esc_attr($theme_prefix['event-link']); ?>" class="third-font"><?php echo __("Read More","2035Themes-fm"); ?></a></li><?php } ?>
						</ul>
					</fieldset>
				</div>
				</div>
			</div>
			<?php } ?>
		    <div class="container">
		        <div class="row"> 
			        <div class="col-lg-12"> 
		                <div class="header-container">
		                	<?php if($theme_prefix['event-visibility'] == "1"){ ?>
		                	<div class="next-event clearfix">
		                		<a id="eventbox" href="#"><i class="fa fa-bookmark"></i><?php echo esc_attr($theme_prefix['event-text']); ?></a>
		                	</div>
		                	<?php } ?>
							<div class="logo pos-center"><!-- Logo Start -->
			                    <?php
			                    if($theme_prefix['logo-type'] == "image"){
			                    if(empty($theme_prefix['logo']['url'])){
			                    	$theme_prefix['logo']['url'] = "";
			                    }
			                    if($theme_prefix['logo']['url'] != "" ){ ?>
			                    	<a href="<?php echo esc_url(home_url('/')); ?>"><img alt="logo" src="<?php echo esc_attr($theme_prefix['logo']['url']); ?>"></a>
			                    <?php } else { ?>
			                    	<a href="<?php echo esc_url(home_url('/')); ?>"><img alt="logo" src="<?php echo THEMEROOT."/images/logo.png";?>" /></a>
			                    <?php } ?>
			                    <?php } else { ?> <!-- If you Dont want to use Image, Your Logo will be look Text -->
			                   		<div class="text-logo">
				                   		<h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php  bloginfo('name');  ?></a></h1>
				                   		<p><?php bloginfo('description'); ?></p> 
			                   		</div>
			                    <?php } ?>
							</div><!-- Logo Finish -->
		                </div>
		                <?php if (has_nav_menu('main-menu')) { ?><!-- Main Menu Start -->
		                <?php if(empty($theme_prefix['image-position'])) { $theme_prefix['image-position'] = "top"; } ?>
		                <div class="main-menu <?php echo esc_attr($theme_prefix['image-position']); ?> pos-center">
			                <nav id="main-menu">
			                    <?php 
								 	wp_nav_menu(
								 		array(
								 			'theme_location' => 'main-menu', 
								 			'container' => '', 
								 			'menu_class' => 'nav-collapse sf-menu', 
								 			'menu_id' => 'navmain',
								 			'walker' => new description_walker() 
								 		)
								 	);
			                    ?>
			                </nav>
		                </div>
		                <?php } ?><!-- Main Menu Finish -->
		            </div>
	            </div>
	        </div>
        </div><!-- Event Container Finish -->
    </div><!-- Main Header Finish -->