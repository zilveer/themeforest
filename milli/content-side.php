<header id="main-header">
	
	<div id="menu-button"><i class="fa fa-bars"></i></div>
	
	<a class="brand" href="<?php echo home_url(); ?>">
		<?php if( get_option('custom_logo') ) : ?>
			<img src="<?php echo get_option('custom_logo'); ?>" alt="<?php echo get_option('custom_logo_alt_text'); ?>" class="retina" />
		<?php else : ?>
			<?php bloginfo('title'); ?>
		<?php endif; ?>
	</a>
	
	<?php echo '<span>' . get_bloginfo('description') . '</span>'; ?>
	
	<nav id="main-nav">
		<?php
			wp_nav_menu('theme_location=primary&menu_id=nav');
		?>
	</nav>
	
	<?php get_sidebar('header'); ?>
	
	<div class="clear"></div>

</header>