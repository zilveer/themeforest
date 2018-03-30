<?php
// migrate();

	$colorClass = '';

	$postLight = false;
	if(is_singular('post') && (YSettings::g('post_template') == 'post_template_2' || (YSettings::g('berg_post_template') == '2' && YSettings::g('post_template') == 'default' ))) {
		$postLight = true;
	}


	if(YSettings::g('navigation_text_color') != 'default' && YSettings::g('navigation_text_color') !='' ) {
		$colorClass = 'nav-'.YSettings::g('navigation_text_color');
	} else {
		if(berg_getIntro() !== false || is_page_template('team.php') || is_page_template('homepage2.php') || is_page_template('homepage.php') || is_page_template('restaurant.php') || is_page_template('contact2.php') || $postLight == true ) {
			$colorClass = 'nav-light';
		} else {
			$colorClass = 'nav-dark';
		}
	}

	$navId = 'main-navbar';
	$navType = YSettings::g('navigation_type');
	$depth = 2;
	if($navType == 2) {
		$depth = 3;
		// var_dump($navType);
		$navId = 'main-navbar-home';
		$colorClass .= ' second-navbar nav-alt';
	}
?>
	<nav id="<?php echo $navId; ?>" class="hidden-xs hidden-sm <?php echo $colorClass; ?>" >
		<div class="nav hidden-xs">
			
			<div class="main-reorder pull-right">
				<?php if($navId == 'main-navbar') : ?>
					<a href="#">
						<i class="fa fa-bars"></i>
					</a>
				<?php else: ?>
					<div class="burger-wrapper">
						<span class="burger-menu"><span></span></span>
					</div>
				<?php endif; ?>
			</div>	

			<?php if(!is_page_template('homepage2.php')) : ?>
			<div class="logo pull-left">

				<?php if($navId == 'main-navbar') : ?>
				<a href="<?php echo home_url(); ?>">
					<figure class="light-logo">
						<span class="spacer"></span>
						<?php
						$logoLight = YSettings::g('logo_image_light');
						if(isset($logoLight['url']) && $logoLight != '') : ?>
						<img src="<?php echo $logoLight['url']; ?>" class="" alt="<?php bloginfo('name'); ?>" />
						<?php endif;?>
					</figure>
					<figure class="dark-logo">
						<span class="spacer"></span>
						<?php
						$logoDark = YSettings::g('logo_image_dark');
						if(isset($logoDark['url']) && $logoDark != '') : ?>
						<img src="<?php echo $logoDark['url']; ?>" class="" alt="<?php bloginfo('name'); ?>" />
						<?php endif; ?>
					</figure>
				</a>
				<?php else : ?>

				<a href="<?php echo home_url(); ?>">
					<figure class="static-logo">
						<span class="spacer"></span>
						<?php

						if(YSettings::g('navigation_text_color') == 'default') {
							if(berg_getIntro() !== false || is_page_template('team.php') || is_page_template('homepage.php') || is_page_template('restaurant.php') || is_page_template('contact2.php') || $postLight == true) {
								$logo = YSettings::g('logo_image_light');
							} else {
								$logo = YSettings::g('logo_image_dark');	
							}
						} else {
							$logo = YSettings::g('logo_image_'.YSettings::g('navigation_text_color'));
						}
						if(isset($logo['url']) && $logo != '') : ?>
						<img src="<?php echo $logo['url']; ?>" class="" alt="<?php bloginfo('name'); ?>" />
						<?php endif; ?>
					</figure>
				</a>

				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php 
			if (has_nav_menu('primary')) {
				wp_nav_menu(array(
					'theme_location' => 'primary',
					'depth'=>$depth,
					'container_class' => 'main-nav bg-opacity-'.$classesNav,
					'walker' => new Child_Wrap(),
					'items_wrap' => '<ul id="%1$s" class="%2$s hidden-xs hidden-sm">%3$s'.$after.'</ul>',
				));
			}
		?>
		</div>
		<div class="clearfix"></div>
	</nav>

	<div id="mobile-nav" class="visible-xs visible-sm mobile-nav">
		<header>
			<div class="container-fluid">
				<ul class="menu-header">
					<li class="pull-left">
						<a href="<?php echo home_url(); ?>" class="logo">
							<figure>
								<?php
								$logoDark = YSettings::g('logo_image_dark');
								if(isset($logoDark['url']) && $logoDark != '') : ?>
								<img src="<?php echo $logoDark['url']; ?>" class="" alt="<?php bloginfo('name'); ?>" />
								<?php endif; ?>
							</figure>
						</a>
					</li>
					<!-- <li class="reorder pull-right"><a href="#" title=""><i class="fa fa-bars"></i></a></li> -->
					<li class="reorder pull-right">
						<a href="#" title="" class="burger-wrapper">
							<div class="burger-menu">
							<span></span>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</header>
		<?php
		if (has_nav_menu('mobile')) {
			$shop = '';
			if (class_exists('Woocommerce')) {
				if (function_exists('icl_object_id')) {
					$shopPageID = (int)icl_object_id(get_option('woocommerce_shop_page_id'), 'page', true);
				} else {
					$shopPageID = get_option('woocommerce_shop_page_id');
				}


				if (YSettings::g('woocommerce_show_in_navbar', 1) == 1) {
					$shop = '<li class="menu-item '. ((is_shop()) ? 'current-menu-item' : '') .'"><a href="'.get_permalink($shopPageID).'"><span><i class="icon-bag"></i> '.get_the_title($shopPageID).' </span></a></li>';
				}
			}
			wp_nav_menu( array( 'theme_location' => 'mobile', 'depth'=>3, 'container_class' => 'flyout-container', 'walker' => new Child_Wrapper(), 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s'.$shop.'</ul>',)); 
		}
		?>
	</div>