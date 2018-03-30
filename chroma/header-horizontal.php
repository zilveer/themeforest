	<nav class="menu" id="theMenu">
		<div class="menu-wrap">
      <?php 	
			if(has_nav_menu('primary-menu' )) {
				wp_nav_menu( 
					array( 
						'container' => '',
						'menu_class' => 'main-menu',
						'theme_location' 	=> 'primary-menu'
					) 
				); 
			} else {
				echo '<div class="notice">Please setup a "Main Menu" in <a href="'. admin_url('nav-menus.php') .'"><b>Wordpress Dashboard</b> > <b>Appearance</b> > <b>Menus</b></a></div>';
			}
  		?>
  		<?php t2t_social_links(); ?>
  		<?php
  		$copyright = get_theme_mod('t2t_customizer_copyright');
  		if(empty($copyright)) {
  			// default
  			$copyright = "&copy; " . __("Copyright", "framework") . " " . get_the_date("Y") . " " . get_bloginfo('name');
  		}
  		?>
  		<p class="copyright"><?php echo $copyright; ?></p>
		</div>
	</nav>

	<?php
		$is_fullscreen_template = false;

		$template_name = get_page_template_slug(); 
		if(strpos($template_name, "fullscreen") !== false) {
			$is_fullscreen_template = true;
		}
	?>
	<div class="page_wrap <?php if(get_theme_mod("t2t_customizer_page_background_repeat") == "stretch") { echo "backstretch"; } ?>" data-background-image="<?php echo get_theme_mod("t2t_customizer_page_background"); ?>">
	<header id="horizontal" class="<?php if(!$is_fullscreen_template) { if(get_theme_mod("t2t_customizer_page_header_background_repeat") == "stretch") { echo "backstretch"; } ?>" data-background-image="<?php echo get_theme_mod("t2t_customizer_page_header_background"); } ?>">
		<div class="wrapper">
			<div class="container">
				<div class="logo">
					<?php if ( get_theme_mod('t2t_customizer_logo') ) { ?>
						<a href="<?php echo home_url(); ?>">
							<?php if(get_theme_mod('t2t_customizer_retina_logo')) { ?>
								<img src="" data-src="<?php echo get_theme_mod('t2t_customizer_logo'); ?>" data-ret="<?php echo get_theme_mod('t2t_customizer_retina_logo'); ?>" alt="<?php the_title(); ?>" class="logo-retina" />
							<?php } else { ?>
								<img src="<?php echo get_theme_mod('t2t_customizer_logo'); ?>" alt="<?php the_title(); ?>" />
							<?php } ?>
						</a>
					<?php } else { ?>  
						<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
					<?php } ?>
				</div>

				<nav>	
					<?php         
						if(has_nav_menu('primary-menu' )) {
							wp_nav_menu( 
								array( 
									'container' => '',
									'menu_class' => 'main-menu',
									'theme_location'         => 'primary-menu'
								) 
							); 
						} else {
							echo '<div class="notice">Please setup a "Main Menu" in <a href="'. admin_url('nav-menus.php') .'"><b>Wordpress Dashboard</b> > <b>Appearance</b> > <b>Menus</b></a></div>';
						}
					?>
				</nav>

				<div id="menuToggle"><span class="foundation-align-justify"></span> Menu</div>

				<div class="clear"></div>
			</div>
		</div>
			<?php if(!$is_fullscreen_template) { ?>
			<div class="page_title">
				<h1>
					<?php
						// If frontpage is not set
						if(is_front_page() && get_option('page_for_posts', true) == 0 || get_post_type(get_the_ID()) == "post" && is_single()) {
							echo __('Blog', 'framework');
						}
						elseif(is_attachment()) {
							echo get_the_title($post->post_parent);
						}
						// Is page
						elseif(get_option('page_for_posts', true) == get_queried_object_id()) {
							echo get_the_title(get_option('page_for_posts', true));
						} 
						// Is woocommerce
						elseif(class_exists('woocommerce') && is_shop() && get_option('woocommerce_shop_page_id')) {
							echo get_the_title(get_option('woocommerce_shop_page_id'));
						} 
						// Is tag
						elseif(is_tag()) {
							echo single_tag_title(__("Tag", "framework") . ": ");
						}	
						// Is category
						elseif(is_category()) {
							echo single_cat_title(__("Category", "framework") . ": ");
						}	
						else {
							echo get_the_title();
						}
					?>
				</h1>
			</div>
			<?php } ?>
	</header>

