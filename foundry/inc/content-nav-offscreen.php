<?php 
	$logo = get_option('custom_logo', EBOR_THEME_DIRECTORY . 'style/img/logo-dark.png'); 
	$logo_light = get_option('custom_logo_light', EBOR_THEME_DIRECTORY . 'style/img/logo-light.png');
?>

<div class="nav-container">
	<nav class="absolute transparent">
	
		<div class="nav-bar">
		
			<div class="module left">
				<a href="<?php echo esc_url(home_url('/')); ?>">
				    <img class="logo logo-light" alt="<?php echo esc_attr(get_bloginfo('title')); ?>" src="<?php echo esc_url($logo_light); ?>" />
				    <img class="logo logo-dark" alt="<?php echo esc_attr(get_bloginfo('title')); ?>" src="<?php echo esc_url($logo); ?>" />
				</a>
			</div>
			
			<div class="module widget-handle offscreen-toggle right">
				<i class="ti-menu"></i>
			</div>
			
		</div>
		
		<div class="offscreen-container bg-dark text-center">
		
			<div class="close-nav">
				<a href="#">
					<i class="ti-close"></i>
				</a>
			</div>
			
			<div class="v-align-transform text-center">
			
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img alt="<?php echo esc_attr(get_bloginfo('title')); ?>" class="image-xs mb40 mb-xs-24" src="<?php echo esc_url($logo_light); ?>" />
				</a>
				
				<?php
					if ( has_nav_menu( 'offscreen' ) ){
					    wp_nav_menu( 
					    	array(
						        'theme_location'    => 'offscreen',
						        'depth'             => 1,
						        'container'         => false,
						        'container_class'   => false,
						        'menu_class'        => 'mb40 mb-xs-24 offscreen-menu',
						        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						        'walker'            => new ebor_framework_medium_rare_bootstrap_navwalker()
					        )
					    );  
					} else {
						echo '<ul class="mb40 mb-xs-24"><li class="fade-on-hover"><a href="'. admin_url('nav-menus.php') .'"><h5 class="uppercase mb8">Set up a navigation menu now</h5></a></li></ul>';
					}
				?>
				
				<p class="fade-half">
					<?php echo wpautop(wp_kses(htmlspecialchars_decode(get_option('foundry_footer_copyright', 'Configure this message in "appearance" => "customize"')), ebor_allowed_tags())); ?>
				</p>
				
				<ul class="list-inline social-list">
					<?php echo ebor_header_social_items(); ?>
				</ul>
				
			</div>
			
		</div>
		
	</nav>
</div>