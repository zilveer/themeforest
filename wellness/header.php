<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
	<?php
	//$stylesheet_dir = get_stylesheet_directory_uri();
	?>
	<title><?php bloginfo('name'); ?> <?php $p_title = wp_title('',false,''); if($p_title !="") echo ' - '.$p_title; if (is_front_page()) {
		         echo ' - '; bloginfo('description'); } ?></title>
	
	<link rel="shortcut icon" href="<?php echo bwthemes_option('favicon');?>" type="image/x-icon" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); 
	wp_head(); 
	//Custom Skin CSS
	if (bwthemes_option('color_radio')== 'choice5') {
		$topval = get_option('header_color_top');
		$botval = get_option('header_color_bot');
		$linkcolor = get_option('bw_link_color');
		$bodval = get_option('bw_bg_color');
		$footval = get_option('bw_footerlink_color');
	echo '<style type="text/css">';
	echo 'body {background: '.$bodval.' url("'.get_template_directory_uri().'/images/customskin-bg.png") no-repeat center 5px;} ';
	echo 'input.headersearch {background-color: '.$topval.';} ';
	echo 'input.headersearch:hover, .ui-datepicker-header, #sidebar .widget h3 {background-color: '.$botval.';} ';
	echo '.contentwrapper a, .contentwrapper1 a, .postwrapper1 h2 a:hover, #sidebar a:hover, #sidebar .tagcloud a:hover{color:'.$linkcolor.';} ';
	echo '.copyright a, .footercontent a:hover, .footercontent .tagcloud a:hover, .copyrighttext a  {color: '.$footval.';} ';
	echo 'div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a{background: -webkit-gradient(linear, 0% 0%, 0% 100%, from('.$topval.'), to('.$botval.')); background: -webkit-linear-gradient(top, '.$topval.', '.$botval.'); background: -moz-linear-gradient(top, '.$topval.', '.$botval.'); background: -ms-linear-gradient(top, '.$topval.', '.$botval.'); background: -o-linear-gradient(top, '.$topval.', '.$botval.');filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$topval.'", endColorstr="'.$botval.'",GradientType=0 )} ';
	echo '</style>';
	}
	
	
	//Custom CSS Overrides
	echo '<style type="text/css">';
	echo bwthemes_option('bw_custom_css');
	echo '</style>';
	?>
</head>
<!-- Body Wrapper-->
<body <?php body_class(); ?>>
	<div class="wrapper">
	
	   <div class="header-wrapper">
	   		<div class="header">
	   			 <?php  //Display Logo Background if option is checked
					if ( bwthemes_option( 'logobg_checkbox' ) ) {
						echo '<div class="logowrapper">';
						}
					else
						{
						echo '<div class="nologowrapper">';
						} ?>	
						
						<!--Website logo-->
						<a id="custom_logo" href="<?php echo home_url(); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo bloginfo('description'); ?>" /></a>
						</div>
				 
				 <!-- Social Icons Selection -->
				 <div class="social_container">
				 <div class="sitesearch"><?php get_search_form();?></div>
				 <div class="socialicons">
				 <ul class="socialicons_ul">
				 <?php if (bwthemes_option('twitter_url') != '') { ?>
						<li><a href="<?php echo bwthemes_option('twitter_url'); ?>" class="social_twitter"></a></li>
				 <?php }; ?>
				 <?php if (bwthemes_option('facebook_url') != '') { ?>
						<li><a href="<?php echo bwthemes_option('facebook_url'); ?>" class="social_facebook"></a></li>
				 <?php }; ?>
				 <?php if (bwthemes_option('linkedin_url') != '') { ?>
						<li><a href="<?php echo bwthemes_option('linkedin_url'); ?>" class="social_linkedin"></a></li>
				 <?php }; ?>
				 <?php if (bwthemes_option('youtube_url') != '') { ?>
						<li><a href="<?php echo bwthemes_option('youtube_url'); ?>" class="social_youtube"></a></li>
				 <?php }; ?>
				 <?php if (bwthemes_option('googleplus_url') != '') { ?>
						<li><a href="<?php echo bwthemes_option('googleplus_url'); ?>" class="social_googleplus"></a></li>
				 <?php }; ?>
				 <?php if (bwthemes_option('pinterest_url') != '') { ?>
						<li><a href="<?php echo bwthemes_option('pinterest_url'); ?>" class="social_pinterest"></a></li>
				 <?php }; ?>
				  <?php if (bwthemes_option('instagram_url') != '') { ?>
						<li><a href="<?php echo bwthemes_option('instagram_url'); ?>" class="social_instagram"></a></li>
				 <?php }; ?>
				 <?php if (bwthemes_option( 'rss_checked' ) ) { ?>
						<li><a href="<?php echo bloginfo('rss2_url'); ?>" class="social_rss"></a></li>
				 <?php }; ?>
				 </ul>
				 </div>
				 
	    		 
				 </div><!-- End Social Container -->
				 
	   		</div><!-- header -->
			
	   		<div class="mainmenu">
			<!--Regular Main Menu-->
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'sf-menu','container_class' => 'fullmenu' ) ); ?>
			<!--Mobile Menu-->
			<a href="#" class="menu-toggle"></a>
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu','container_class' => 'menu-mobile-container',  'menu_class' => 'mobile-menu', 'depth' => '0' ) ); ?>	
		
	   <?php  //Display Phone Number if option is checked 
			if ( bwthemes_option( 'phone_checkbox' ) ) {
				echo '<div class="phonenumber">';
				echo bwthemes_option('phone_number');
				echo '</div>';
				}
			else				
		?>		
		</div>  
	   </div><!-- mainmenu -->	   
	   <!-- header-wrapper -->