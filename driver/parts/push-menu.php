	<div class="side-menu">
		<div class="menu-toggle-off"><i class="fa fa-long-arrow-right"></i></div>
		
		<a class="site-title" rel="home" href="<?php echo esc_url(home_url('/')); ?>">
		<?php if(get_iron_option('menu_logo') != ''): ?>
			<img class="logo-desktop regular" src="<?php echo esc_url( get_iron_option('menu_logo') ); ?>" data-at2x="<?php echo esc_url( get_iron_option('retina_menu_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
			<img class="logo-mobile regular" src="<?php echo esc_url( get_iron_option('menu_logo') ); ?>" data-at2x="<?php echo esc_url( get_iron_option('retina_menu_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
		<?php endif; ?>
		</a>
		
		
			<!-- panel -->
			<div class="panel">
				<a class="opener" href="#"><i class="icon-reorder"></i> <?php _e("Menu", IRON_TEXT_DOMAIN); ?></a>

				<!-- nav-holder -->
				<div class="nav-holder">

					<!-- nav -->
					<nav id="nav">
	<?php if ( get_iron_option('header_menu_logo_icon') != '') : ?>
						<a class="logo-panel" href="<?php echo home_url('/'); ?>">
							<img src="<?php echo esc_url( get_iron_option('header_menu_logo_icon') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
						</a>
	<?php endif; ?>
						<?php echo preg_replace('/>\s+</S', '><', wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'nav-menu', 'echo' => false, 'walker' => new iron_nav_walker() ))); ?>

					</nav>
					<div class="clear"></div>
					
					<div class="panel-networks">
						<?php get_template_part('parts/networks'); ?>
						<div class="clear"></div>
					</div>
					
				</div>
			</div>
		
	</div>