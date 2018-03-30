<?php op_panel_tab_open( __( 'General Settings', 'openframe' ) ); ?>
	
	<h3><?php _e( 'Site Icon', 'openframe'); ?></h3>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Bookmark icon', 'openframe' ) ); ?>
		
		<?php op_panel_opt_media( 'bookmark-icon' ); ?>
				
	<?php op_panel_group_close(); ?>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'iOS Home icon', 'openframe' ) ); ?>
		
		<?php op_panel_opt_media( 'apple-touch-icon' ); ?>
		
		<p><?php _e( 'The icon displayed in the &quot;Home Screen&quot; of Apple iOS Devices.', 'openframe' ); ?></p>
				
	<?php op_panel_group_close(); ?>

	<h3><?php _e( 'Home Page Listing', 'openframe'); ?></h3>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Articles per Section', 'openframe' ) ); ?>
		
		<?php op_panel_opt_select( 'article-number', array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8' ) ); ?>
		
		<p><?php _e( 'The number of articles to display on Home page Article sections.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>		

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Portfolio items per Section', 'openframe' ) ); ?>
		
		<?php op_panel_opt_select( 'portfolio-number', array( '4' => '4', '8' => '8', '12' => '12', '16' => '16', '20' => '20', '24' => '24', '28' => '28', '32' => '32' ) ); ?>
		
		<p><?php _e( 'The number of portfolio items to display on Home page Portfolio sections.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>	

	<h3><?php _e( 'Blog Sidebar', 'openframe'); ?></h3>
		
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Hide sidebar on Blog pages', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'hide-sidebar-blog-page' ); ?>
		
		<p><?php _e( 'Tick this option if you don&rsquo;t want to display the sidebar on blog pages.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>	

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Hide sidebar on Blog Post pages', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'hide-sidebar-blog-single' ); ?>
		
		<p><?php _e( 'Tick this option if you don&rsquo;t want to display the sidebar on blog post pages.', 'openframe' ); ?></p>
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Hide sidebar on Portfolio Item pages', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'hide-sidebar-portfolio-single' ); ?>
		
		<p><?php _e( 'Tick this option if you don&rsquo;t want to display the sidebar on portfolio item pages.', 'openframe' ); ?></p>
				
	<?php op_panel_group_close(); ?>	

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Hide sidebar on Pages', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'hide-sidebar-page' ); ?>
		
		<p><?php _e( 'Tick this option if you don&rsquo;t want to display the on static pages.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>	

	<h3><?php _e( 'Loader', 'openframe'); ?></h3>
		
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Show loader on the Home Page', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'show-loader' ); ?>
		
		<p><?php _e( 'Tick this option if you wish to display a loader on the Home Page while images are loading.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>			
	
	<h3><?php _e( 'Analytics', 'openframe' ); ?></h3>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Javascript code', 'openframe' ) ); ?>
		
		<?php op_panel_opt_textarea( 'analytics', '&lt;script&gt; ... &lt;/script&gt;' ); ?>
		
		<p><?php _e( 'The tracking code of your favorite Analytics web service.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>
	
<?php op_panel_tab_open_close(); ?>


<?php op_panel_tab_open( __( 'Header', 'openframe' ) ); ?>
	
	<h3><?php _e( 'Header Settings', 'openframe'); ?></h3>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Disable fixed header', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'disable-fixed' ); ?>
		
		<p><?php _e( 'Tick this option if you don&rsquo;t want the header stick at the top of the window.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Header Background Color', 'openframe' ) ); ?>
		
		<?php op_panel_opt_picker( 'header-bg-color', '#7AC0C0' ); ?>
							
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Light menu links', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'light-menu' ); ?>
		
		<p><?php _e( 'Tick this option if you wish to use a light color for menu elements.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Header links size' ); ?>
		
		<?php op_panel_opt_text( 'links-size', '100%' ); ?>

		<p><?php _e( 'Set a new header links size. Default size is 100%.', 'openframe' ); ?></p>		
				
	<?php op_panel_group_close(); ?>				

	<h3><?php _e( 'Logo', 'openframe'); ?></h3>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Logo image', 'openframe' ) ); ?>
		
		<?php op_panel_opt_media( 'logo-image' ); ?>

		<p><?php _e( 'Recommended image size: 150x150px', 'openframe' ); ?></p>

						
	<?php op_panel_group_close(); ?>
		
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Retina logo image' ); ?>
		
		<?php op_panel_opt_media( 'logo-image-x2' ); ?>

		<p><?php _e( 'Recommended image size: 300x300px', 'openframe' ); ?></p>
						
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Push logo to the left', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'logo-left' ); ?>
		
		<p><?php _e( 'Tick this option if you wish to force logo position to the left. It may be useful in case of odd menu elements.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>	

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Move up logo on scroll', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'logo-up' ); ?>
		
		<p><?php _e( 'Tick this option if you wish to move up the logo when scrolling.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>		
		
<?php op_panel_tab_open_close(); ?>

<?php op_panel_tab_open( __( 'Slider', 'openframe' ) ); ?>
	
	<h3><?php _e( 'Slider Settings', 'openframe'); ?></h3>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Speed transition', 'openframe' ) ); ?>
		
		<?php op_panel_opt_text( 'slider-speed', '500' ); ?>

		<p><?php _e( 'Transition speed is 500 ms (milliseconds) by default. Set a new value in ms to change it (ex: &quot;1000&quot; stands for 1 second).', 'openframe' ); ?></p>		
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Pause time', 'openframe' ) ); ?>
		
		<?php op_panel_opt_text( 'slider-pause-time', '4000' ); ?>

		<p><?php _e( 'The amount of time between each auto transition is 4000 ms (milliseconds) by default. Set a new value in ms to change it (ex: &quot;6000&quot; stands for 6 second).', 'openframe' ); ?></p>		
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Auto sliding', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'slider-auto-sliding' ); ?>

		<p><?php _e( 'Tick this option if you want slides to automatically transition.', 'openframe' ); ?></p>			
				
	<?php op_panel_group_close(); ?>		

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Pause on hover', 'openframe' ) ) ; ?>
		
		<?php op_panel_opt_check( 'slider-pause-hover' ); ?>

		<p><?php _e( 'Tick this option if you wish to pause when mouse cursor is over the slider.', 'openframe' ); ?></p>			
				
	<?php op_panel_group_close(); ?>				
		
<?php op_panel_tab_open_close(); ?>

<?php op_panel_tab_open( __( 'Styling', 'openframe' ) ); ?>
	
	<h3><?php _e( 'Fonts', 'openframe' ); ?></h3>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Headings font', 'openframe' ) ); ?>
		
		<?php op_panel_opt_select( 'fonts-headings', array( 'BazarMedium' => __( 'Bazar Medium', 'openframe' ), 'BebasNeueRegular' => __( 'Bebas Neue Regular', 'openframe' ) ) ); ?>
		
		<p><?php _e( 'The font that will be used in the headings (Menu links, Section titles, Slider captions, etc).', 'openframe' ); ?></p>
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Body font', 'openframe' ) ); ?>
		
		<?php op_panel_opt_text( 'google-fonts-body', 'http://fonts.googleapis.com/css?family= ...' ); ?>
		
		<p><?php _e( 'The url to the font that will be used in the layout. The url to the Font must be single &ndash; make sure to not enter the address to a Fonts collection.', 'openframe' ); ?></p>
				
	<?php op_panel_group_close(); ?>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Secondary font', 'openframe' ) ); ?>
		
		<?php op_panel_opt_text( 'google-fonts-secondary', 'http://fonts.googleapis.com/css?family= ...' ); ?>
		
		<p><?php _e( 'The url to the secondary font that will be used for section sublines, widget titles, etc. The url to the Font must be single &ndash; make sure to not enter the address to a Fonts collection.', 'openframe' ); ?></p>
					
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Multiple borders', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'multiple-borders' ); ?>
		
		<p><?php _e( 'Tick this option if you wish to enable 3D effect on Section and Pages Titles.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>

<?php op_panel_tab_open_close(); ?>

<?php op_panel_tab_open( __( 'Social', 'openframe' ) ); ?>
	
	<h3><?php _e( 'Mail Form', 'openframe' ); ?></h3>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Send messages to', 'openframe' ) ); ?>
		
		<?php op_panel_opt_text( 'send-to', get_option( 'admin_email' ) ); ?>
		
		<p><?php _e( 'The address that will receive messages sent through the mail form. If not set, messages will be sent to the admin email.', 'openframe' ); ?></p>
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Disable Human Verification', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'human-off' ); ?>
		
		<p><?php _e( 'Tick this option if you wish to disable the anti-spam Human Verification field.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>	
	
	<h3><?php _e( 'Social Networks', 'openframe' ); ?></h3>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Show Social Networks', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'show-social' ); ?>
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<strong><?php op_panel_opt_title( __( 'Label', 'openframe' ) ); ?></strong>
		
		<?php op_panel_opt_text( 'social-label', 'I am social' ); ?>
		
		<p><?php _e( 'The title to display above the social links.', 'openframe' ); ?></p>
				
	<?php op_panel_group_close(); ?>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Twitter' ); ?>
		
		<?php op_panel_opt_text( 'twitter', 'https://twitter.com/ ...' ); ?>
				
	<?php op_panel_group_close(); ?>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Facebook' ); ?>
		
		<?php op_panel_opt_text( 'facebook', 'http://facebook.com/ ...' ); ?>
				
	<?php op_panel_group_close(); ?>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Google Plus' ); ?>
		
		<?php op_panel_opt_text( 'google-plus', 'https://plus.google.com/ ...' ); ?>
				
	<?php op_panel_group_close(); ?>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Pinterest' ); ?>
		
		<?php op_panel_opt_text( 'pinterest', 'http://pinterest.com/ ...' ); ?>
				
	<?php op_panel_group_close(); ?>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Linkedin' ); ?>
		
		<?php op_panel_opt_text( 'linkedin', 'https://linkedin.com/ ...' ); ?>
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Dribbble' ); ?>
		
		<?php op_panel_opt_text( 'dribbble', 'https://dribbble.com/ ...' ); ?>
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Flickr' ); ?>
		
		<?php op_panel_opt_text( 'flickr', 'https://www.flickr.com/ ...' ); ?>
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Youtube' ); ?>
		
		<?php op_panel_opt_text( 'youtube', 'https://www.youtube.com/ ...' ); ?>
				
	<?php op_panel_group_close(); ?>	

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Tumblr' ); ?>
		
		<?php op_panel_opt_text( 'tumblr', 'http://yourtumblr.tumblr.com/' ); ?>
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Instagram' ); ?>
		
		<?php op_panel_opt_text( 'instagram', 'http://instagram.com/ ...' ); ?>
				
	<?php op_panel_group_close(); ?>	

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Skype' ); ?>
		
		<?php op_panel_opt_text( 'skype', 'skype:username?call' ); ?>
				
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Dropbox' ); ?>
		
		<?php op_panel_opt_text( 'dropbox', 'https://www.dropbox.com/ ...' ); ?>
				
	<?php op_panel_group_close(); ?>						
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Github' ); ?>
		
		<?php op_panel_opt_text( 'github', 'https://github.com/ ...' ); ?>
								
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Behance' ); ?>
		
		<?php op_panel_opt_text( 'behance', 'https://www.behance.net/ ...' ); ?>
								
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( 'Vimeo' ); ?>
		
		<?php op_panel_opt_text( 'vimeo', 'https://vimeo.com/ ...' ); ?>
								
	<?php op_panel_group_close(); ?>

	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Open Social Links in a New Window', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'social-link-new-window' ); ?>
				
	<?php op_panel_group_close(); ?>

<?php op_panel_tab_open_close(); ?>

<?php op_panel_tab_open( __( 'Extras', 'openframe' ) ); ?>
	
	<h3><?php _e( 'Custom Code', 'openframe' ); ?></h3>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'CSS code', 'openframe' ) ); ?>
		
		<?php op_panel_opt_textarea( 'css-code', '.postid-' . rand( 0, 100 ) . ' .hentry-title { text-transform: uppercase; }' ); ?>
				
	<?php op_panel_group_close(); ?>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'jQuery code', 'openframe' ) ); ?>
		
		<?php op_panel_opt_textarea( 'jquery-code', '$(".postid-' . rand( 0, 100 ) . ' .hentry-title").hide().slideDown( 2000 );' ); ?>
			
	<?php op_panel_group_close(); ?>
	
	<h3><?php _e( 'Theme', 'openframe' ); ?></h3>
	
	<?php op_panel_group_open(); ?>
		
		<?php op_panel_opt_title( __( 'Check for updates', 'openframe' ) ); ?>
		
		<?php op_panel_opt_check( 'update-check' ); ?>
		
		<p><?php _e( 'Tick this option if you wish to be notified when a new version of this theme becomes available. The notification will be available under the &quot;Dashboard&quot; section.', 'openframe' ); ?></p>
		
	<?php op_panel_group_close(); ?>
	
<?php op_panel_tab_open_close(); ?>