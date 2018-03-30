<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<?php global $theme_options; ?>
	<head>
		<!--meta-->
		<meta charset="<?php esc_attr(bloginfo("charset")); ?>" />
		<meta name="generator" content="WordPress <?php esc_attr(bloginfo("version")); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="description" content="<?php esc_attr(bloginfo('description')); ?>" />
		<meta name="format-detection" content="telephone=no" />
		<!--style-->
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php esc_url(bloginfo("rss2_url")); ?>" />
		<link rel="pingback" href="<?php esc_url(bloginfo("pingback_url")); ?>" />
		<?php
		if((!function_exists('has_site_icon') || !has_site_icon()) && !empty($theme_options["favicon_url"]))
		{
			?>
			<link rel="shortcut icon" href="<?php echo esc_url($theme_options["favicon_url"]); ?>"/>
			<?php 
		}
		wp_head(); 
		?>
		<?php gb_get_theme_file("/custom_colors.php"); ?>
		<?php
		if(!empty($theme_options['ga_tracking_code']))
		{				
			if(strpos($theme_options['ga_tracking_code'],'<script') !== false)					
				echo $theme_options['ga_tracking_code'];
			else
				echo "<script type='text/javascript'>" . $theme_options['ga_tracking_code'] . "</script>";
		}		
		?>
	</head>
	<body <?php body_class(); ?>>
		<div class="header_container">
			<div class="header clearfix">
				<?php
				if(is_active_sidebar('header-top')):
				?>
				<div class="header_top_sidebar clearfix">
				<?php
				get_sidebar('header-top');
				?>
				</div>
				<?php
				endif;
				?>
				<div class="header_left">
					<a href="<?php echo get_home_url(); ?>" title="<?php bloginfo("name"); ?>">
						<?php if($theme_options["logo_url"]!=""): ?>
						<img src="<?php echo $theme_options["logo_url"]; ?>" alt="logo" />
						<?php endif; ?>
						<?php if($theme_options["logo_first_part_text"]!=""): ?>
						<span class="logo_left"><?php echo $theme_options["logo_first_part_text"]; ?></span>
						<?php 
						endif;
						if($theme_options["logo_second_part_text"]!=""):
						?>
						<span class="logo_right"><?php echo $theme_options["logo_second_part_text"]; ?></span>
						<?php endif; ?>
					</a>
				</div>
				<?php
				if(is_active_sidebar('header-top-right')):
					?>
					<div class="header_top_right_sidebar clearfix">
					<?php
					get_sidebar('header-top-right');
					?>
					</div>
					<?php
				endif;
				//Get menu object
				$locations = get_nav_menu_locations();
				if(isset($locations["main-menu"]))
				{
					$main_menu_object = get_term($locations["main-menu"], "nav_menu");
					if(has_nav_menu("main-menu") && $main_menu_object->count>0) 
					{
						wp_nav_menu(array(
							"theme_location" => "main-menu",
							"menu_class" => "sf-menu header_right"
						));
						?>
						<div class="mobile_menu_container clearfix">
							<a href="#" class="mobile-menu-switch">
								<span class="line"></span>
								<span class="line"></span>
								<span class="line"></span>
							</a>
							<div class="mobile-menu-divider"></div>
							<?php
							wp_nav_menu(array(
								'container'			=> 'nav',
								'container_class'	=> 'mobile_menu' . (!isset($theme_options["collapsible_mobile_submenus"]) || (int)$theme_options["collapsible_mobile_submenus"] ? " collapsible-mobile-submenus" : ""),
								'theme_location'	=> 'main-menu',
								"walker" => (!isset($theme_options["collapsible_mobile_submenus"]) || (int)$theme_options["collapsible_mobile_submenus"] ? new Mobile_Menu_Walker_Nav_Menu() : '')
							));
							?>
						</div>
						<?php
						/*wp_nav_menu(array(
							'container_class' => 'mobile_menu',
							'theme_location' => 'main-menu', // your theme location here
							'walker'         => new Walker_Nav_Menu_Dropdown(),
							'items_wrap'     => '<select>%3$s</select>',
						));*/
					}
				}
				?>
			</div>
		</div>
	<!-- /Header -->