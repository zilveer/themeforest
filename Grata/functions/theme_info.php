<?php

add_action('admin_menu', 'us_add_info_home_page', 10);

if ( ! function_exists('us_add_info_home_page'))
{
	function us_add_info_home_page()
	{
		add_menu_page( THEMENAME.': Home', THEMENAME, 'manage_options', 'us-home', 'us_page_info_home', NULL, 50 );
		add_submenu_page( 'us-home', THEMENAME.': Home', 'Home', 'manage_options', 'us-home', 'us_page_info_home' );
	}
}

if ( !function_exists('us_page_info_home'))
{
	function us_page_info_home()
	{
		?>
			<div class="wrap about-wrap us-body">
			
				<div class="us-header">
					<h1>Welcome to <strong><?php echo THEMENAME.' '.THEMEVERSION; ?></strong></h1>
					<div class="about-text"><?php echo THEMENAME; ?> is now installed! It is made for the artists in a broad sense. For those who want to express their ideas and meanings in a simple way. We hope you enjoy using it.</div>
				</div>
				
				<div class="changelog">
					<div class="feature-section col three-col">
						<div>
							<h4><i class="dashicons dashicons-download"></i>Import Demo Content</h4>
							<p>If you are installed this theme for the first time, you can import demo content. It will be a good start to build your site.</p>
							<a class="button us-button" href="<?php echo admin_url('admin.php?page=us-demo-import'); ?>">Go to Demo Import</a>
						</div>
						<div>
							<h4><i class="dashicons dashicons-admin-appearance"></i>Customize Appearance</h4>
							<p>If you're looking to customize the look and feel of your site (colors, layouts, display options), just go to the Theme Options panel.</p>
							<a class="button us-button" href="<?php echo admin_url('admin.php?page=us-optionsframework'); ?>">Go to Theme Options</a>
						</div>
						<div class="last-feature">
							<h4><i class="dashicons dashicons-admin-network"></i>Validate Your Theme</h4>
							<p>For more convenient work validate your theme, which unlocks automatic updates, additional extensions, and more.</p>
							<span class="us-feature-disabled">Coming Soon!</span>
							<!-- <a class="button us-button" href="<?php echo admin_url('admin.php?page=us-product-validation'); ?>">Go to Product Validation</a> -->
						</div>
					</div>
					<div class="feature-section col three-col">
						<div>
							<h4><i class="dashicons dashicons-editor-help"></i><?php echo THEMENAME; ?> Knowledge Base</h4>
							<p><?php echo THEMENAME; ?> has an extensive well structured documentation as a separate site, which is constantly being improved and replenished.</p>
							<a class="button us-button" href="https://help.us-themes.com/grata/" target="_blank">Go to Knowledge Base</a>
						</div>
						<div>
							<h4><i class="dashicons dashicons-sos"></i>Support Portal</h4>
							<p>If you need some help with the theme, just register at our support portal and create a ticket. We are really proud of our support.</p>
							<a class="button us-button" href="https://help.us-themes.com/grata/tickets/" target="_blank">Go to Support Portal</a>
						</div>
						<div class="last-feature">
							<h4><i class="dashicons dashicons-clock"></i>Theme Changelog</h4>
							<p>To see whats new the latest version has, go to the changelog page. Also it's a best way to see how the theme evolves from initial release.</p>
							<a class="button us-button" href="https://help.us-themes.com/grata/changelog/" target="_blank">View the Changelog</a>
						</div>
					</div>
				</div>
				
			</div>
		<?php
	}
}
