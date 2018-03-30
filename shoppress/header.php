<!DOCTYPE html>
<!--[if !IE]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<!--[if IE 9]>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> class="no-js ie9">
<![endif]-->
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> class="no-js ie8">
<![endif]-->
<head>
<meta charset=<?php bloginfo('charset'); ?> />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php require(gp_inc . 'options.php'); ?>
<?php if ( file_exists( gp_child_inc . '/page-settings.php' ) ) {
	require_once( gp_child_inc . '/page-settings.php' );
} elseif ( file_exists( gp_inc . '/page-settings.php' ) ) {
	require_once( gp_inc . '/page-settings.php' );
} ?>
<?php if(get_option($dirname.'_responsive') == "0") { ?><meta name="viewport" content="width=device-width, initial-scale=1"><?php } ?>
<?php wp_head(); ?>
</head>

<?php global $dirname, $gp_settings, $woocommerce; ?>

<body <?php body_class($gp_settings['browser'].' '.$gp_settings['layout'].' '.$gp_settings['skin']); ?>>


<?php if(!is_page_template('blank-page.php')) { ?>


	<!-- BEGIN PAGE WRAPPER -->
	 
	<div id="page-wrapper">
	 
	 
		<!-- BEGIN HEADER -->
		
		<div id="header">
			
			
			<!-- BEGIN PAGE INNER -->
			
			<div class="page-inner">	
				
		
				<div id="dropdowncart-wrapper"><?php if(function_exists('woocommerce_content')) { echo gp_dropdown_cart(); } ?></div>
		
		
				<!-- BEGIN HEADER LEFT -->
	
				<div id="header-inner">
				
				
					<!-- BEGIN LOGO -->
					
					<<?php if($gp_settings['title'] == "Show") { ?>div<?php } else { ?>h1<?php } ?> id="logo" style="<?php if(get_option($dirname.'_logo_top')) { ?> margin-top: <?php echo get_option($dirname.'_logo_top'); ?>px;<?php } ?><?php if(get_option($dirname.'_logo_left')) { ?> margin-left: <?php echo get_option($dirname.'_logo_left'); ?>px;<?php } ?><?php if(get_option($dirname.'_logo_bottom')) { ?> margin-bottom: <?php echo get_option($dirname.'_logo_bottom'); ?>px;<?php } ?>">
						
						<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php if(get_option($dirname.'_logo')) { echo(get_option($dirname.'_logo')); } else { if($gp_settings['skin'] == "skin-light" OR $gp_settings['skin'] == "skin-light-wide") { echo get_template_directory_uri(); ?>/lib/images/logo-light.png<?php } else { echo get_template_directory_uri(); ?>/lib/images/logo-dark.png<?php }} ?>" width="<?php if(get_option($dirname.'_logo_width')) { echo get_option($dirname.'_logo_width'); } else { echo "286"; } ?>" height="<?php if(get_option($dirname.'_logo_height')) { echo get_option($dirname.'_logo_height'); } else { echo "75"; } ?>" alt="<?php bloginfo('name'); ?>" /></a>
						
					</<?php if($gp_settings['title'] == "Show") { ?>div<?php } else { ?>h1<?php } ?>>
					
					<!-- END LOGO -->
					
				
				</div>
				
				<!-- END HEADER LEFT -->
						
	
				<!-- BEGIN HEADER RIGHT -->
				
				<div id="header-right" style="<?php if(get_option($dirname.'_header_height')) { ?> height: <?php echo get_option($dirname.'_header_height'); ?>px;<?php } ?>">
			
					
					<!-- BEGIN HEADER NAV -->
					
					<div id="header-nav" class="nav">
									
						<?php if(function_exists('woocommerce_content')) { echo gp_dropdown_cart(); } ?>
									
						<?php wp_nav_menu('sort_column=menu_order&container=ul&theme_location=header-nav&fallback_cb=null'); ?>
											
					</div>
					
					<!-- END HEADER NAV -->
					
					
					<div class="clear"></div>
					
		
					<!-- BEGIN SEARCH FORM -->
					
					<?php if($gp_settings['search'] == "Show") { ?>
						<?php get_search_form(); ?>
					<?php } ?>
					
					<!-- END SEARCH FORM -->
							
							
					<!-- BEGIN SOCIAL ICONS -->
												
					<div id="social-icons">
					
						<?php if(get_option($dirname.'_rss_button') == "1") {} else { ?><a href="<?php if(get_option($dirname.'_rss')) { ?><?php echo(get_option($dirname.'_rss')); ?><?php } else { ?><?php bloginfo('rss2_url'); ?><?php } ?>" class="rss-icon" title="<?php _e('RSS Feed', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php if(get_option($dirname.'_twitter')) { ?><a href="<?php echo get_option($dirname.'_twitter'); ?>" class="twitter-icon" title="<?php _e('Twitter', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php if(get_option($dirname.'_facebook')) { ?><a href="<?php echo get_option($dirname.'_facebook'); ?>" class="facebook-icon" title="<?php _e('Facebook', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php if(get_option($dirname.'_digg')) { ?><a href="<?php echo get_option($dirname.'_digg'); ?>" class="digg-icon" title="<?php _e('Digg', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
					
						<?php if(get_option($dirname.'_delicious')) { ?><a href="<?php echo get_option($dirname.'_delicious'); ?>" class="delicious-icon" title="<?php _e('Delicious', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
			
						<?php if(get_option($dirname.'_dribbble')) { ?><a href="<?php echo get_option($dirname.'_dribbble'); ?>" class="dribbble-icon" title="<?php _e('Dribbble', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php if(get_option($dirname.'_youtube')) { ?><a href="<?php echo get_option($dirname.'_youtube'); ?>" class="youtube-icon" title="<?php _e('YouTube', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
			
						<?php if(get_option($dirname.'_vimeo')) { ?><a href="<?php echo get_option($dirname.'_vimeo'); ?>" class="vimeo-icon" title="<?php _e('Vimeo', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
		
						<?php if(get_option($dirname.'_linkedin')) { ?><a href="<?php echo get_option($dirname.'_linkedin'); ?>" class="linkedin-icon" title="<?php _e('LinkedIn', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php if(get_option($dirname.'_googleplus')) { ?><a href="<?php echo get_option($dirname.'_googleplus'); ?>" class="googleplus-icon" title="<?php _e('Google+', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
											
						<?php if(get_option($dirname.'_myspace')) { ?><a href="<?php echo get_option($dirname.'_myspace'); ?>" class="myspace-icon" title="<?php _e('MySpace', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
												
						<?php if(get_option($dirname.'_flickr')) { ?><a href="<?php echo get_option($dirname.'_flickr'); ?>" class="flickr-icon" title="<?php _e('Flickr', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
		
						<?php if(get_option($dirname.'_pinterest')) { ?><a href="<?php echo get_option($dirname.'_pinterest'); ?>" class="pinterest-icon" title="<?php _e('Pinterest', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
										
						<?php echo stripslashes(get_option($dirname.'_additional_social_icons')); ?>
		
					</div>
					
					<!-- END SOCIAL ICONS -->
					
												
				</div>
				
				<!-- END HEADER RIGHT -->
			
			
			</div>
			
			<!-- END PAGE INNER -->
		
		
		</div>
		
		<!-- END HEADER -->
		
		
		<div class="clear"></div>

		
		<!-- BEGIN PAGE OUTER -->
		
		<div class="page-outer">
		
		
			<!-- BEGIN PAGE INNER -->
			
			<div class="page-inner">
	
			
				<!-- BEGIN BODY NAV -->
				
				<div id="body-nav" class="nav">
				
					<?php wp_nav_menu('sort_column=menu_order&container=ul&theme_location=body-nav&fallback_cb=null'); ?>
					
					<?php if( has_nav_menu('header-nav') && has_nav_menu('body-nav') ) {
						wp_nav_menu(array('theme_location' => 'header-nav', 'items_wrap' => '<select class="mobile-menu">%3$s', 'container' => '', 'menu_class' => 'mobile-menu', 'sort_column' => 'menu_order', 'fallback_cb' => 'null', 'walker' => new gp_mobile_menu));
						wp_nav_menu(array('theme_location' => 'body-nav', 'items_wrap' => '%3$s</select>', 'container' => '', 'menu_class' => 'mobile-menu', 'sort_column' => 'menu_order', 'fallback_cb' => 'null', 'walker' => new gp_mobile_menu));
					} elseif( has_nav_menu('header-nav') ) {
						wp_nav_menu(array('theme_location' => 'header-nav', 'items_wrap' => '<select class="mobile-menu">%3$s</select>', 'container' => '', 'menu_class' => 'mobile-menu', 'sort_column' => 'menu_order', 'fallback_cb' => 'null', 'walker' => new gp_mobile_menu));
					} elseif( has_nav_menu('body-nav') ) {
						wp_nav_menu(array('theme_location' => 'body-nav', 'items_wrap' => '<select class="mobile-menu">%3$s</select>', 'container' => '', 'menu_class' => 'mobile-menu', 'sort_column' => 'menu_order', 'fallback_cb' => 'null', 'walker' => new gp_mobile_menu));						
					} ?>
										
				</div>
				
				<!-- END BODY NAV -->
				
														
				<!-- BEGIN CONTENT WRAPPER -->
				
				<div id="content-wrapper">


<?php } ?>				