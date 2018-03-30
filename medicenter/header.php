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
		if(!function_exists('has_site_icon') || !has_site_icon())
		{
			?>
			<link rel="shortcut icon" href="<?php echo (empty($theme_options["favicon_url"]) ? esc_url(get_template_directory_uri()) . "/images/favicon.ico" : esc_url($theme_options["favicon_url"])); ?>" />
			<?php 
		}
		?>
		<?php
		wp_head();
		?>
		<?php
		mc_get_theme_file("/custom_colors.php");
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
		<div class="site_container<?php echo ($theme_options['layout']=="boxed" || (isset($_COOKIE['mc_layout']) && $_COOKIE['mc_layout']=="boxed") ? ' boxed' : ($theme_options['layout']=="fullwidth" || (isset($_COOKIE['mc_layout']) && $_COOKIE['mc_layout']=="fullwidth") ? ' fullwidth' : '')); ?>">
			<?php
			if(isset($_COOKIE['mc_header_sidebar']) && (int)$_COOKIE['mc_header_sidebar'])
			{
				?>
				<div class="header_top_sidebar_container">
				<div class="header_top_sidebar clearfix">
					<?php
					dynamic_sidebar('sidebar-header-top');
					$header_top_right_sidebar_visible = true;
					?>
				</div>
				</div>
				<?php
			}
			else if(!empty($theme_options["header_top_sidebar"]) && (!isset($_COOKIE['mc_header_sidebar']) || (int)$_COOKIE['mc_header_sidebar']))
			{
				?>
				<div class="header_top_sidebar_container">
				<?php
				$sidebar = get_post($theme_options["header_top_sidebar"]);
				if(!(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name)):
				?>
				<div class="header_top_sidebar clearfix">
					<?php
					dynamic_sidebar($sidebar->post_name);
					?>
				</div>
				<?php
				endif;
				?>
				</div>
				<?php
			}
			?>
			<!-- Header -->
			<?php
			$header_layout_type = (isset($_COOKIE['mc_header_type']) && (int)$_COOKIE['mc_header_type'] ? (int)$_COOKIE['mc_header_type'] : (isset($theme_options["header_layout_type"]) ? (int)$theme_options["header_layout_type"] : 1));
			?>
			<div class="header_container <?php echo (($header_layout_type==1 || $header_layout_type==4) && ((!empty($_COOKIE['mc_sticky_menu']) && (int)$_COOKIE['mc_sticky_menu']==1) || (!empty($theme_options["sticky_menu"]) && (int)$theme_options["sticky_menu"]==1 && (!isset($_COOKIE['mc_sticky_menu']) || (int)$_COOKIE['mc_sticky_menu']==1 ))) ? "sticky" : "")?>">
				<div class="header clearfix layout_<?php echo ($header_layout_type==3 ? $header_layout_type . ' layout_2' : $header_layout_type); ?>">
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
							<?php if($theme_options["logo_text"]!=""): ?>
							<span class="logo"><?php echo $theme_options["logo_text"]; ?></span>
							<?php 
							endif;
							?>
						</a>
						<?php
						$header_top_right_sidebar_visible = false;
						if($header_layout_type==2)
						{
							if(isset($_COOKIE['mc_header_sidebar_right']) && (int)$_COOKIE['mc_header_sidebar_right'])
							{
								?>
								<div class="header_top_right_sidebar_container">
								<div class="header_top_right_sidebar clearfix">
									<?php
									dynamic_sidebar('sidebar-header-top-right');
									$header_top_right_sidebar_visible = true;
									?>
								</div>
								</div>
								<?php
							}
							else if(isset($theme_options["header_top_right_sidebar"]) && $theme_options["header_top_right_sidebar"]!="")
							{
								?>
								<div class="header_top_right_sidebar_container">
								<?php
								$sidebar = get_post($theme_options["header_top_right_sidebar"]);
								if(!(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name)):
								?>
								<div class="header_top_right_sidebar clearfix">
									<?php
									dynamic_sidebar($sidebar->post_name);
									$header_top_right_sidebar_visible = true;
									?>
								</div>
								<?php
								endif;
								?>
								</div>
								<?php
							}
						}
						?>
					</div>
					<?php 
					if($header_layout_type!=2 && $header_layout_type!=3)
					{
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
								/*
								<select>
									<option value="-">-</option>
									<?php
									$menu_items = wp_get_nav_menu_items($main_menu_object->term_id);
									print_r($menu_items);
									foreach((array)$menu_items as $key => $menu_item ) 
									{
										?>
										<option value="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></option>
										<?php
									}
									echo count($menu_items);
									?>
								</select>*/
							}
						}
					}
					?>
				</div>
			</div>
			<?php
			if($header_layout_type==2 || $header_layout_type==3):
			?>
			<div class="header_separator<?php echo ($header_layout_type==2 && $header_top_right_sidebar_visible ? ' padding_top_15' : ''); ?>"></div>			
			<div class="header_container <?php echo ((!empty($_COOKIE['mc_sticky_menu']) && (int)$_COOKIE['mc_sticky_menu']==1) || (!empty($theme_options["sticky_menu"]) && (int)$theme_options["sticky_menu"]==1 && (!isset($_COOKIE['mc_sticky_menu']) || (int)$_COOKIE['mc_sticky_menu']==1)) ? "sticky" : "")?>">
				<div class="header clearfix padding_top_0 layout_<?php echo ($header_layout_type==3 ? $header_layout_type . ' layout_2' : $header_layout_type); ?>">
				<?php
				//Get menu object
				$locations = get_nav_menu_locations();
				if(isset($locations["main-menu"]))
				{
					$main_menu_object = get_term($locations["main-menu"], "nav_menu");
					if(has_nav_menu("main-menu") && $main_menu_object->count>0) 
					{
						wp_nav_menu(array(
							"theme_location" => "main-menu",
							"menu_class" => "sf-menu header_right",
							'walker'         => new Walker_Nav_Menu_Layout2()
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
					}
				}
				?>
				</div>
			</div>
			<?php
			endif;
			?>
		<!-- /Header -->