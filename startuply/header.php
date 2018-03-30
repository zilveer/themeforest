<?php
/**
 * The Header
 * @version 2.2
 *
 */
?><!DOCTYPE html>
<!--[if IE 6]><html class="ie ie6 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="ie ie7 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<!-- WordPress header -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
	<?php if (!startuply_option('responsive_on')) : ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
	<?php else: ?>
		<meta name="viewport" content="width=1200" />
	<?php endif; ?>

	<!-- Startuply favicon -->
	<?php
	$site_favicon = startuply_option('vivaco_favicon');
	if (!$site_favicon) {
		$site_favicon = get_template_directory_uri().'/images/favicon.ico';
	}
	if(!isset($is_home)) {$is_home = '';};
	$options = startuply_get_all_option();

	?>
	<link rel="shortcut icon" href="<?php echo esc_attr($site_favicon); ?>">

	<!-- Wordpress head functions -->
	<?php wp_head(); ?>
</head>

<body id="landing-page" <?php body_class(); ?>>

	<div id="mask">

	<?php if (empty($options['loading_gif'])) { ?>
		<div class="preloader"><div class="spin base_clr_brd"><div class="clip left"><div class="circle"></div></div><div class="gap"><div class="circle"></div></div><div class="clip right"><div class="circle"></div></div></div></div>
		<?php
		} else {
			$loading_gif = isset($options['loading_gif']) ? $options['loading_gif'] : '';
		?>
		<div id="custom_loader"><img src="<?php echo esc_attr($loading_gif); ?>" alt="loading"/></div>
	<?php } ?>

	</div>

	<header>

		<?php if (startuply_option('sub_menu_on') == '1') { ?>
		<div id="sub-menu" class="sub-menu">
			<div class="container">
				<div class="row">
				<?php

					$layout_sub_menu = array(6,6);
					$widget_number = 1;
					$class_prefix = 'col-sm-';
					$active_widgets = 0;
					foreach ($layout_sub_menu as $col) {
						echo '<div class="'.$class_prefix.$col.'">';

						if(is_active_sidebar("sidebar_sub_menu_$widget_number")) {
							dynamic_sidebar("sidebar_sub_menu_$widget_number");
							$active_widgets++;
						} else {
							echo "&nbsp;";
						}
						echo '</div>';
					$widget_number++;
					}
					if ($active_widgets < 1){
						echo '<div class=col-sm-12 text-center" style="margin-top:-20px;"><p class="text-center">Please assign some widgets to sub menu through Appearance -> Widgets or disable it</p></div>';
					}
					
					?>

				</div>


			</div>
		</div>
		<?php } ?>
		<nav class="navigation navigation-header <?php echo $is_home;?> <?php startuply_menu_style(get_the_ID());?>" role="navigation">
			<div class="container">
				<div class="navigation-brand">
					<div class="brand-logo">
						<a href="<?php echo home_url(); ?>" class="logo">
							<?php 
								//get theme or page logo
								startuply_theme_logo(get_the_ID()); 
							?>
						</a>
						<span class="sr-only"><?php echo bloginfo( 'name' ); ?></span>
					</div>
					<button class="navigation-toggle visible-xs" type="button" data-target=".navbar-collapse">
						<span class="icon-bar base_clr_bg"></span>
						<span class="icon-bar base_clr_bg"></span>
						<span class="icon-bar base_clr_bg"></span>
					</button>
				</div>
				<div class="navbar-collapse collapsed">
					<div class="menu-wrapper">
						<!-- Left menu -->
						<?php wp_nav_menu( array( 'theme_location' => 'left_menu', 'menu_class' => 'navigation-bar navigation-bar-left', 'fallback_cb' => 'startuply_default_menu', 'items_wrap' => startuply_edd_cart_wrap(), 'walker' => new wp_bootstrap_navwalker() ) ); ?>
						<!-- Right menu -->
						<div class="right-menu-wrap">

						<?php $registration_instead_right_menu_on = startuply_option('registration_instead_right_menu_on', -1);
						if ( $registration_instead_right_menu_on != 1 && (!current_user_can('manage_options') && $user_ID ) ) : // Not register, or Super Admin or Administator only  ?>

							<ul id="menu-demo-menu" class="navigation-bar">
								<li class="menu-item featured">
									<a class="user-profile base_clr_txt" href="<?php echo get_permalink( get_page_by_title( 'User login & control panel' ) ); ?>"><?php _e('My Account','vivaco'); ?></a>
								</li>
								<li class="menu-item">
									<?php wp_loginout(); ?>
								</li>
							</ul>

						<?php else: ?>

							<?php wp_nav_menu( array( 'theme_location' => 'right_menu', 'menu_class' => 'navigation-bar navigation-bar-right', 'fallback_cb' => false, 'walker' => new wp_bootstrap_navwalker() ) ); ?>

						<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
