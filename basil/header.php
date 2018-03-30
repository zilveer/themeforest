<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<?php $disable_responsive = ot_get_option('to_disable_responsive',false);
  	if ($disable_responsive != 'yes') :
		echo '<meta name="viewport" content="width=device-width" />';
	else :
		echo '<meta name="viewport" content="width=1050" />';
	endif;
	?>
	
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php
	
	// Custom CSS
	$custom_css = ot_get_option('to_basil_custom_css');
	
	// Custom CSS
	if ($custom_css) {
		echo '<style type="text/css">';
			echo $custom_css.' ';
		echo '</style>';
	}
	
	if (is_singular()): wp_enqueue_script( 'comment-reply' ); endif;
	
	$header_height = ot_get_option('to_header_height','105');
	$slider_height_diff = $header_height - 105;
	$slider_height = 674 + $slider_height_diff;
	$recipe_slider_height = 430 + $slider_height_diff;
	$slider_nav_height = 837 + ($slider_height_diff * 2);

	?><style type="text/css">

	body.transparent .basilSlider,
	body.floating .basilSlider,
	body.transparent .basilSlider .basilImageSlider,
	body.floating .basilSlider .basilImageSlider,
	body.transparent .basilSlider .basilImageSlider .basilSlide,
	body.floating .basilSlider .basilImageSlider .basilSlide { height:<?php echo $slider_height; ?>px; }
	
	body.transparent .basilSlider .basilRecipeSlider,
	body.floating .basilSlider .basilRecipeSlider,
	body.transparent .basilSlider .basilRecipeSliderBG,
	body.floating .basilSlider .basilRecipeSliderBG { top:<?php echo $recipe_slider_height; ?>px; }
	
	body.transparent .basilSlider .basilSliderNav,
	body.floating .basilSlider .basilSliderNav { height:<?php echo $slider_nav_height; ?>px; }

</style><?php
	
	wp_head(); ?>
	
</head>

<body <?php body_class(array(ot_get_option('to_layout_style','full'),ot_get_option('to_header_style','full'))); ?>><?php

// Google Analytics
$google_analytics = ot_get_option('to_basil_google_analytics');
if ($google_analytics) {
	echo $google_analytics;
} ?>

<div id="basilWrapper">

		<?php
		$header_style = ot_get_option('to_header_style','full');
		switch($header_style){
			case 'full' :
				$header_class = '';
			break;
			case 'floating' :
				$header_class = 'basilHeaderOver';
			break;
			case 'transparent' :
				$header_class = 'basilHeaderTransparent';
			break;
			
		} ?>
		
		<!-- HEADER -->
		<header id="basilHeader"<?php if ($header_class): ?> class="<?php echo $header_class; ?>"<?php endif; ?>>
		
			<?php // Get the logo image
			
			$logo_id = ot_get_option('to_header_logo',false);
			$logo_rt_id = ot_get_option('to_header_logo_rt',false);
			
			if (!$logo_id){
				$logo_url = get_template_directory_uri().'/images/logo.png';
				$logo_rt_url = get_template_directory_uri().'/images/logo-rt.png';
				$logo_width = 314;
				$logo_height = 65;
			} else {
				$logo_src = wp_get_attachment_image_src( $logo_id,'full' );
				$logo_url = $logo_src[0];
				$logo_rt_src = wp_get_attachment_image_src( $logo_rt_id,'full' );
				$logo_rt_url = $logo_rt_src[0];
				$logo_width = $logo_src[1];
				$logo_height = $logo_src[2];
			} ?>
			
			<!-- TOP HEADER -->
			<section id="basilHeaderTop">
				<div class="basilShell clearfix">
					<div class="basilLeft" style="width:<?php echo $logo_width; ?>px; max-width:<?php echo $logo_width; ?>px; height:<?php echo $logo_height; ?>px; position:absolute; top:50%; margin-top:-<?php echo round($logo_height/2); ?>px;">
						<a href="<?php echo home_url(); ?>" id="basilLogo"><img src="<?php echo ($logo_rt_url ? $logo_rt_url : $logo_url); ?>" alt="<?php bloginfo('name'); ?>" style="height:<?php echo $logo_height; ?>px;" /></a>
					</div>
					<div class="basilRight"><?php
					
						$top_right_content = ot_get_option('to_header_top_right','button');
						switch($top_right_content){
							
							case 'profile' :
								$profile_page = get_option('cp_profile_page');
								if ($profile_page):
									if (is_user_logged_in()):
										?><a href="<?php echo get_permalink($profile_page); ?>" class="basilButton bgColor-2"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php _e('Your Profile','basil'); ?></a>
										&nbsp;&nbsp;<a href="<?php echo wp_logout_url(site_url()); ?>" class="basilButton bgColor-3"><?php _e('Sign Out','basil'); ?></a><?php
									else :
										?><a href="<?php echo get_permalink($profile_page); ?>" class="basilButton bgColor-2"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php _e('Sign In','basil'); ?></a><?php
									endif;
								else :
									_e('Choose a <em>Profile</em> page from <em>Recipes > Settings</em>','basil');
								endif;
							break;
							
							case 'button' :
								$recipes_page = get_option('cp_recipes_list_view_page');
								if ($recipes_page):
									?><a href="<?php echo get_permalink($recipes_page); ?>" class="basilButton bgColor-2"><i class="fa fa-search"></i>&nbsp;&nbsp;<?php _e('Browse All Recipes','basil'); ?></a><?php
								else :
									_e('Choose a <em>Browse Recipes</em> page from <em>Recipes > Settings</em>','basil');
								endif;
							break;
							
							case 'text' :
								echo do_shortcode(ot_get_option('to_header_top_right_text'));
							break;
							
						}

					?></div>
				</div>
			</section>
			
			<?php
			
			$nav_right_content = ot_get_option('to_nav_bar_right','socials');
			ob_start();
			switch($nav_right_content){
				
				case 'socials' :
					?><div class="basilSocials basilRight">
						<ul>
							<?php basil_render_socials(); ?>
						</ul>
					</div><?php
				break;
				
				case 'search' :
					?><div class="basilRight">
						<?php get_search_form(); ?>
					</div><?php
				break;
				
				case 'recipe-search' :
					?><div class="basilRight">
						<?php basil_recipe_search_form(); ?>
					</div><?php
				break;
				
				case 'text' :
					?><div class="basilRight">
						<?php echo wpautop(ot_get_option('to_nav_bar_right_text')); ?>
					</div><?php
				break;
				
			}
			$nav_right_content = ob_get_clean();
			
			// Mobile Navigation Location (Below)
			echo '<div class="mobile-nav-wrapper">';
				echo '<div id="mobileSlickNav"></div>';
				if (has_nav_menu('mobile-menu')){
			    	wp_nav_menu(array('container' => false, 'menu_id' => 'mobileNav', 'fallback_cb' => false, 'theme_location' => 'mobile-menu'));
				} else {
					wp_nav_menu(array('container' => false, 'menu_id' => 'mobileNav', 'fallback_cb' => false, 'theme_location' => 'main-menu'));
				}
				
				echo '<div class="basilMobileNavContent">'.$nav_right_content.'</div>';
				
			echo '</div>';
			
			?>
			
			<!-- NAVIGATION -->
			<nav id="basilNavBar">
				<div class="basilShell">
					<?php wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'items_wrap'     => '<ul id="%1$s" class="basilNav basilLeft %2$s">%3$s</ul>',
						'fallback_cb'	 => 'basil_menu_message'
					));
					
					echo $nav_right_content;

					?>
				</div>
			</nav>
			
		</header>