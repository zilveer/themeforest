<?php

	$logo = get_option(THEME_NAME.'_logo');		
	$headerImage = get_option(THEME_NAME.'_header_image');		

	//social icons
	$social_header = get_option(THEME_NAME."_social_footer");
	$digg = get_option(THEME_NAME."_digg");
	$twitter = get_option(THEME_NAME."_twitter");
	$facebook = get_option(THEME_NAME."_facebook");
	$flickr = get_option(THEME_NAME."_flickr");
	$dribbble = get_option(THEME_NAME."_dribbble");
	$googleplus = get_option(THEME_NAME."_googleplus");
	
	///contact info
	$contacInfo = get_option(THEME_NAME."_contac_info_header");
	$contactPhone = get_option(THEME_NAME."_contac_phone_header");
	$contactMail = get_option(THEME_NAME."_contac_mail_header");
	
	//homepage slider
	$homeSlider = get_option(THEME_NAME."_slider_enable");
	$homeSliderId = get_option(THEME_NAME."_home_slider");
	if(!$homeSliderId) $homeSliderId = 1;
	
?>
<!-- Open layout -->
<div class="site-layout">

<!-- Header -->
<div id="header"<?php if($headerImage) { ?> style="background-image: url(<?php echo $headerImage;?>);"<?php } ?>>
<div class="header-inner">
	<div class="top-bar">
		<?php if($logo) { ?>
			<div id="logo">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>">
				</a>
			</div>
		<?php } ?>
		<?php if($contacInfo=="on") { ?>
			<div class="contact-info">
				<ul>
					<?php if($contactMail) { ?><li><a href="mailto:<?php echo $contactMail;?>"><i class="icon-envelope"></i><?php echo $contactMail;?></a></li><?php } ?>
					<?php if($contactPhone) { ?><li><i class="icon-phone"></i><?php echo $contactPhone;?></li><?php } ?>
				</ul>
			</div>
		<?php } ?>
    </div>    
    <div class="bottom-bar">
			<?php 
				
				if ( function_exists( 'register_nav_menus' )) {
					$args = array(
						'container' => '',
						'theme_location' => 'top-menu',
						"link_before" => '',
						"link_after" => '' ,
						'items_wrap' => '<ul id="menu" class="%2$s" ><li><a href="'.home_url().'"><i class="icon-home"></i><span style="display:none;" >'.__("Home",THEME_NAME).'</span></a></li>%3$s</ul>',
						'depth' => 3,
						"echo" => false
					);
										
					if(has_nav_menu('top-menu')) {
						echo add_menu_arrows(wp_nav_menu($args));		
					} else {
						echo "<ul id=\"menu\"><li class=\"navi-none\"><a href=\"".admin_url("nav-menus.php") ."\">Please set up ".THEME_FULL_NAME." menu!</a></li></ul>";
					}
				}
			?>
			<?php if($social_header=="on") { ?>
				<ul class="footer-social-icons">
					<?php if($digg) { ?><li class="footer-digg"><a href="<?php echo $digg;?>" target="_blank"></a></li><?php } ?>
					<?php if($dribbble) { ?><li class="footer-dribbble"><a href="<?php echo $dribbble;?>" target="_blank"></a></li><?php } ?>
					<?php if($facebook) { ?><li class="footer-facebook"><a href="<?php echo $facebook;?>" target="_blank"></a></li><?php } ?>
					<?php if($flickr) { ?><li class="footer-flickr"><a href="<?php echo $flickr;?>" target="_blank"></a></li><?php } ?>
					<?php if($twitter) { ?><li class="footer-twitter"><a href="<?php echo $twitter;?>" target="_blank"></a></li><?php } ?>
					<?php if($googleplus) { ?><li class="footer-googleplus"><a href="<?php echo $googleplus;?>" target="_blank"></a></li><?php } ?>
				</ul>
			<?php } ?>

    </div>
	<?php if (is_page_template ( 'template-homepage.php' ) && $homeSlider=="on") { ?>
		<!-- InstanceBeginEditable name="Slider" -->
		<div id="df-layerslider">
			<?php echo do_shortcode('[layerslider id="'.$homeSliderId.'"]');?>
		</div>
	<?php } ?>
</div>
</div>
<!-- End Header -->

<div class="container<?php if (is_page_template ( 'template-homepage.php' )) { echo " homepage"; } ?>">
	<?php if (!is_page_template ( 'template-homepage.php' )) { ?>
		<!-- Page header -->
		<div class="sixteen columns">
			<div class="page-header">
				<h3><?php echo news_page_title(df_page_id());?></h3>
				<?php echo wordpress_breadcrumbs();?>
			</div>
		</div>

	<?php } ?>
