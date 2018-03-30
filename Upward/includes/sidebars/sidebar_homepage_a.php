<?php

	global
		$st_Options;

		echo '<div id="sidebar"><div class="sidebar sidebar-homepage-a">';
	
			// Homepage Sidebar A
			if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Homepage Sidebar 1') );
	
			// Dummy data
			else { ?>
	
				<div class="widget">
	
					<h1><?php _e( 'Welcome to', 'strictthemes' ) ?> <?php echo $st_Options['general']['label']; ?>!</h1>
					<p><?php _e( 'For replacing this dummy info, please, drop a widget on "Homepage Sidebar 1" at Appearance > Widgets page.', 'strictthemes' ) ?></p>
		
					<h5>Getting started</h5>
					<ul>
						<li><a href="<?php echo $st_Options['general']['url-demo']; ?>"><?php _e( 'Live demo', 'strictthemes' ) ?></a></li>
						<li><a href="<?php echo $st_Options['general']['documentation']; ?>"><?php _e( 'Documentation', 'strictthemes' ) ?></a></li>
						<li><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=st-major-settings"><?php _e( 'Theme Panel', 'strictthemes' ) ?></a></li>
					</ul>
		
					<p><!-- --></p>
		
					<h5>Common steps</h5>
					<ul>
						<li><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=st-major-settings"><?php _e( 'Setup custom logo', 'strictthemes' ) ?></a></li>
						<li><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=st-major-settings"><?php _e( 'Setup Google Analytics', 'strictthemes' ) ?></a></li>
						<li><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=st-major-settings"><?php _e( 'Change blog template', 'strictthemes' ) ?></a></li>
						<li><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=st-layout-settings"><?php _e( 'Select footer scheme', 'strictthemes' ) ?></a></li>
						<li><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=st-fonts-settings"><?php _e( 'Use another font', 'strictthemes' ) ?></a></li>
						<li><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=st-style-settings"><?php _e( 'Tweak colors', 'strictthemes' ) ?></a></li>
						<li><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=st-projects-settings"><?php _e( 'Enable portfolio', 'strictthemes' ) ?></a></li>
					</ul>
	
				</div>
	
				<?php
			}
	
		echo '</div></div>';

?>