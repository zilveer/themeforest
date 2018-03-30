<?php require_once('inputs.php'); ?>

<div id="px-container" class="theme-settings">
	<input type="hidden" name="action" value="theme_save_options" />
	<div id="px-wrap">
		<!--Header-->
		<div id="px-head" class="clear-after">
			<div class="logo">
				<?php admin_img('logo.png', THEME_NAME); ?>
			</div>
			
			<ul class="support">
				<li><a href="http://support.pixflow.net/"><?php _e('Support', TEXTDOMAIN); ?></a></li>
				<li><div class="separator"></div></li>
				<li><a href="http://www.youtube.com/channel/UC8lRtcEk1ybb5Q-MoOM7PNg"><?php _e('Video Tutorial', TEXTDOMAIN); ?></a></li>
			</ul>
		</div>
		<!--End Header-->
		
		<!--Main-->
		<div class="clear-after">
			<div id="px-sidebar">
				<h5 class="heading"><?php _e('Theme Options', TEXTDOMAIN); ?></h5>
				<div id="px-sidebar-accordion">
					<h3><a href="#" class="active"><?php _e('Theme Settings', TEXTDOMAIN); ?></a></h3>
					<div>
						<ul class="px-tab">
              
							<li><a href="#general-settings" class="active"><?php _e('General', TEXTDOMAIN); ?></a></li>
							<li><a href="#skin-settings"><?php _e('Layout Managment', TEXTDOMAIN); ?></a></li>
							<li><a style="padding-left:65px;" href="#fullScreenSlider-skin-settings"><?php _e('Background Management', TEXTDOMAIN); ?></a></li>
							<li><a href="#header-settings"><?php _e('Header & Footer', TEXTDOMAIN); ?></a></li>
							<li><a href="#about-settings"><?php _e('About', TEXTDOMAIN); ?></a></li>
							<li><a href="#portfolio-settings"><?php _e('Portfolio', TEXTDOMAIN); ?></a></li>
							<li><a href="#resume-skill-settings"><?php _e('Resume', TEXTDOMAIN); ?></a></li>
							<li><a style="padding-left:65px;" href="#resume-skill-settings"><?php _e('Skill Achievement', TEXTDOMAIN); ?></a></li>
							<li><a style="padding-left:65px;" href="#resume-work-settings"><?php _e('work Experience', TEXTDOMAIN); ?></a></li>
							<li><a href="#blog-settings"><?php _e('Blog', TEXTDOMAIN); ?></a></li>
							<li><a href="#Map-settings"><?php _e('Map', TEXTDOMAIN); ?></a></li>
							<li><a href="#contact-settings"><?php _e('Contact', TEXTDOMAIN); ?></a></li>
							<li><a href="#Social-settings"><?php _e('Social Icons', TEXTDOMAIN); ?></a></li>
						</ul>
					</div>
					<h3><a href="#"><?php _e('Advanced Options', TEXTDOMAIN); ?></a></h3>
					<div>						
						<ul class="px-tab">
							<li><a href="#advanced-settings"><?php _e('Settings', TEXTDOMAIN); ?></a></li>
						</ul>
					</div>
					<h3><a href="#"><?php _e('Demo Content', TEXTDOMAIN); ?></a></h3>
					<div>
						<ul class="px-tab">
							<li><a href="#import-settings"><?php _e('Import Settings', TEXTDOMAIN); ?></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div id="px-main">
			
				<!--General Settings Panel-->
				<div id="general-settings" class="panel">
					<div class="content-head">
						<h3><?php _e('General Settings', TEXTDOMAIN); ?></h3>
						 <a href="#" class="save-button" ><span class="save">save</span>
							<div class="tooltip">
								<div><?php _e('SAVE', TEXTDOMAIN); ?></div>
							</div>
							<?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
						</a>
					</div>
					<!-- Favicon Upload -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('You can specify favicon url or upload new icon with upload button.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Custom Favicon', TEXTDOMAIN); ?></div>
						</div>
						<?php MediaInput('favicon', '', 'Upload Favicon', 'px-settings-favicon'); ?>
					</div>
					<!-- Favicon Upload End -->
				
					<!-- Enable Loader  -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('You can enable or disable Loader progress bar when your site loads.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Display Loader progress bar ', TEXTDOMAIN); ?></div>
						</div>
						
						<?php SwitchInput('loader_display', 'Disabled', 'Enabled'); ?>
					</div>
					<!-- Enable Loader End -->
					
                    
                    <!-- Opacity Effect -->
					<div class="section">

						<!-- Opacity Effect Easing -->				
						<div class="section-head">
						  <div class="section-tooltip">
							<?php _e('You can adjust main part opacity here', TEXTDOMAIN); ?>
						  </div>
						  <div class="label">
							<?php _e('Main Part Opacity', TEXTDOMAIN); ?>
						  </div>
						</div>
					
						<!-- Opacity Effect -->
						
						<?php RangeInput('opacity_effect', 0, 100, 1,  '%'); ?>
						
					</div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
					<!-- Enable Scroll  -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('You can enable or disable horizontal scrollbar.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Display horizontal scrollbar ', TEXTDOMAIN); ?></div>
						</div>
						
						<?php SwitchInput('scroll_display', 'Disabled', 'Enabled'); ?>
					</div>
					<!-- Enable Scroll End -->
			
					<!-- Scrolling -->
					<div class="section">

						<!-- Scrolling Easing -->				
						<div class="section-head">
						  <div class="section-tooltip">
							<?php _e('You can adjust scrolling speed here', TEXTDOMAIN); ?>
						  </div>
						  <div class="label">
							<?php _e('Scrolling Speed', TEXTDOMAIN); ?>
						  </div>
						</div>
					
						<!-- Scrolling Speed -->
						
						<?php RangeInput('scrolling_speed', 75, 1500, 50,  'ms'); ?>
						
					</div>

					<!-- Responsive Layout -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('You can enable or disable responsive layout.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Responsive Layout', TEXTDOMAIN); ?></div>
						</div>
						
						<?php SwitchInput('responsive_layout', 'Disabled', 'Enabled'); ?>
					</div>
					<!-- Responsive Layout End -->
					
					<!-- Google Font link -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Open Sans is Profession default google font, you can replace your desired google font with that by adding font name in following fields. NOTICE that font name must be exactly the way it is on google font website.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Google Font', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('google_font', 'Google Font Name', 'field-spacer'); ?>
						
						<div class="section-head">
							<div class="label"><?php _e('Google Font Family link', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('google_font_family', 'Google Font Family link', 'field-spacer'); ?>
						
					</div>
					<!-- Google Font link End -->

					 <!-- Pages Sidebar Position -->
					 <div class="section">
						<div class="section-head">
						  <div class="section-tooltip">
							<?php _e('Here you can add custome sidebar that can be used in external pages. You could also customize sidebar widgets in widgets panel.', TEXTDOMAIN); ?>
						  </div>
						  <div class="label">
							<?php _e('Pages Sidebar Position', TEXTDOMAIN); ?>
						  </div>
						</div>
						
						<?php ImageSelect('sidebar_position', array('none'=>0,'right-side'=>1), 'page-sidebar'); ?>
						
					 </div>
					 <!-- Pages Sidebar Position End -->
					 
					 <!-- Custom Sidebar -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Here you can add custome sidebar that later can be used in external pages. You could also customize sidebar widgets in widgets panel.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Custom Sidebar', TEXTDOMAIN); ?></div>
						</div>
						
						<?php CSVInput('custom_sidebars', 'Enter a sidebar name'); ?>
					</div>
					<!-- Custom Sidebar End -->

					<!-- Wordpress login Logo -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('upload your admin panel login Logo .( best size : 226px X 82px ) ( PNG ,  JPG , GIF  )', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Control Panel Login Logo', TEXTDOMAIN); ?></div>
						</div>
			
						<?php MediaInput('wp_login_logo', '', 'Upload login Logo', 'px-settings-loginlogo' , 'field-spacer'); ?>	
						
					</div>
					<!-- Wordpress login Logo -->

				</div>	
				<!--General Settings Panel End-->
				
				<!--Header And Footer Settings Panel-->
				<div id="header-settings" class="panel">
					<div class="content-head">
						<h3><?php _e('Header &  Footer Settings', TEXTDOMAIN); ?></h3>
						 <a href="#" class="save-button" ><span class="save">save</span>
							<div class="tooltip">
								<div><?php _e('SAVE', TEXTDOMAIN); ?></div>
							</div>
							<?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
						</a>
					</div>
					
					<!-- Header  -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Enter your name and your job title to be shown in header section here. also you can choose to have menu opened or closed here.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Header', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('title_name', 'Your Name', 'field-spacer'); ?>
						<?php TextInput('title_posotion', 'Job title', 'field-spacer'); ?>
						
						<div class="section-head">
							<div class="label"><?php _e('Menu Toggle', TEXTDOMAIN); ?></div>
						</div>
						
						<?php SwitchInput('menu_toggle', 'Close', 'Open'); ?>
						
					</div>
					<!-- Header End -->
					
					<!-- Footer  -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Enter your copyright text here.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Footer', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('footer_copyright', 'Copyright Text', 'field-spacer'); ?>

					</div>
					<!-- Footer End -->
					
					<!-- Footer  -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Choose header and Footer style.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Footer And Header Style', TEXTDOMAIN); ?></div>
						</div>
						<?php SwitchInput('HFColor', 'Dark', 'light'); ?>
					</div>
					<!-- Footer End -->
				</div>	
				<!--Header And Footer Settings Panel End-->
				
				<!-- Layout Managment Settings -->
				<div id="skin-settings" class="panel">
					<div class="content-head">
						<h3><?php _e('Layout Settings', TEXTDOMAIN); ?></h3>
						 <a href="#" class="save-button" ><span class="save">save</span>
							<div class="tooltip">
								<div><?php _e('SAVE', TEXTDOMAIN); ?></div>
							</div>
							<?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
						</a>
					</div>
			  
				  <!-- vertical template -->
				  <div class="section">
				  
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Choose your layout style here.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Template Style', TEXTDOMAIN); ?>
					  </div>
					</div>
						<?php SwitchInput('vertical_template', 'Horizontal', 'Vertical'); ?>
						</br>
					</div>
					<!-- vertical template End -->
					
				  <!-- column1 -->
				  <div class="section">
				  
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Choose your skin color from several ready to use skins here.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Theme Skin', TEXTDOMAIN); ?>
					  </div>
					</div>
					
						<?php ImageSelect(
								'theme_skin_color',
							   array('preset1'=>"skin_1", 'preset2'=>"skin_2", 'preset3'=>"skin_3", 'preset4'=>"skin_4"  ,
									 'preset5'=>"skin_5" , 'preset6'=>"skin_6" , 'preset7'=>"skin_7" , 'preset8'=>"skin_8",
									 'preset9'=>"skin_9" , 'preset10'=>"skin_10" , 'preset11'=>"skin_11" , 'preset12'=>"skin_12",
									 'preset13'=>"skin_13" , 'preset14'=>"skin_14" , 'preset15'=>"skin_15" , 'preset16'=>"skin_16"),
								'theme_skin_color'); ?>
						</br>
					</div>
					<!-- column 1 End -->

					<!-- Theme Supporting Color -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Theme general color is the main color of most theme graphical elements.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Theme General Color', TEXTDOMAIN); ?></div>
						</div>
						
						<?php ColorInput('theme_support_skin'); ?>
					</div>
					<!-- Theme Supporting Color -->
					
					<!-- About Part background _ Color-->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Change about section background color here', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('About Section Background Color', TEXTDOMAIN); ?></div>
						</div>
						
						<?php ColorInput('about_color'); ?>
					</div>
					<!-- About Part background _ Color -->
					
					<!-- portfolio Part background _ Color-->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Change portfolio section background color here', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Portfolio Section Background Color', TEXTDOMAIN); ?></div>
						</div>
						
						<?php ColorInput('portfolio_color'); ?>
					</div>
					<!-- portfolio Part background _ Color -->
					
					<!-- Resume Part background _ Color-->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Change resume section background color here', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Resume Section Background Color', TEXTDOMAIN); ?></div>
						</div>
						
						<?php ColorInput('resume_color'); ?>
					</div>
					<!-- Resume Part background _ Color -->
					
					<!-- contact Part background _ Color-->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Change contact section background color here', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Contact Section Background Color', TEXTDOMAIN); ?></div>
						</div>
						
						<?php ColorInput('contact_color'); ?>
					</div>
					<!-- portfolio Part background _ Color -->
					

					
					<!-- menu color -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Change Menu background color here', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Menu Background Color', TEXTDOMAIN); ?></div>
						</div>
						
						<?php ColorInput('menu_color'); ?>
					</div>
					<!-- menu color  -->
		
					<!-- Links Color -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Choose links color here.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Links Color', TEXTDOMAIN); ?></div>
						</div>
						
						<?php ColorInput('links_color'); ?>
					</div>
					<!-- Links Color End-->
					
					<!-- Links Hover Color -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Choose links hover when you move your mouse over it here.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Links Hover Color', TEXTDOMAIN); ?></div>
						</div>

						<?php ColorInput('links_hover_color'); ?>
					</div>
					<!-- Links Color End-->
					
					<!-- Text Selection Color -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Choose text selection color to override current skin color settings.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Text Selection Highlight Color', TEXTDOMAIN); ?></div>
						</div>
						
						<?php ColorInput('selection_color'); ?>
					</div>
					<!-- Text Selection Color End-->
					
				</div>	
				<!-- Skin Managment Settings End -->
				
				<!-- Layout Managment Settings -->
				<div id="fullScreenSlider-skin-settings" class="panel">
					<div class="content-head">
						<h3><?php _e('Background Settings', TEXTDOMAIN); ?></h3>
						 <a href="#" class="save-button" ><span class="save">save</span>
							<div class="tooltip">
								<div><?php _e('SAVE', TEXTDOMAIN); ?></div>
							</div>
							<?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
						</a>
					</div>
					
					<!-- FullSreen Color -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Choose background Color.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Background Color', TEXTDOMAIN); ?></div>
						</div>
						
						<?php ColorInput('backgroundColor'); ?>
					</div>
					<!-- FullSreen Color -->
					
					<!-- column1 -->
					<div class="section">
				  
						<div class="section-head">
						  <div class="section-tooltip">
							<?php _e('Choose your Texture from several ready to use here.', TEXTDOMAIN); ?>
						  </div>
						  <div class="label">
							<?php _e('Background Texture', TEXTDOMAIN); ?>
						  </div>
						</div>
					
						<?php ImageSelect(
								'theme_texture',
							   array('texture1'=>"texture1", 'texture2'=>"texture2", 'texture3'=>"texture3", 'texture4'=>"texture4"  ,
									 'texture5'=>"texture5" , 'texture6'=>"texture6" , 'texture7'=>"texture7" , 'texture8'=>"texture8"),
								'theme_texture'); ?>
						</br>
					</div>
					<!-- column 1 End -->
					
					<!-- FullSreen Slider -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('upload your admin panel login Logo .( best size : 226px X 82px ) ( PNG ,  JPG , GIF  )', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Background Slider', TEXTDOMAIN); ?></div>
						</div>
			
						<?php MediaInput('background_gallery_1', '', 'Upload Background Screen slider', 'px-settings-fullScreenSlider' , 'field-spacer'); ?>
						<?php MediaInput('background_gallery_2', '', 'Upload Background Screen slider', 'px-settings-fullScreenSlider' , 'field-spacer'); ?>						
						<?php MediaInput('background_gallery_3', '', 'Upload Background Screen slider', 'px-settings-fullScreenSlider' , 'field-spacer'); ?>
						<?php MediaInput('background_gallery_4', '', 'Upload Background Screen slider', 'px-settings-fullScreenSlider' , 'field-spacer'); ?>
						<?php MediaInput('background_gallery_5', '', 'Upload Background Screen slider', 'px-settings-fullScreenSlider' , 'field-spacer'); ?>
						<?php MediaInput('background_gallery_6', '', 'Upload Background Screen slider', 'px-settings-fullScreenSlider' , 'field-spacer'); ?>
						<?php MediaInput('background_gallery_7', '', 'Upload Background Screen slider', 'px-settings-fullScreenSlider' , 'field-spacer'); ?>
						<?php MediaInput('background_gallery_8', '', 'Upload Background Screen slider', 'px-settings-fullScreenSlider' , 'field-spacer'); ?>
						<?php MediaInput('background_gallery_9', '', 'Upload Background Screen slider', 'px-settings-fullScreenSlider' , 'field-spacer'); ?>
						<?php MediaInput('background_gallery_10', '', 'Upload Background Screen slider', 'px-settings-fullScreenSlider' , 'field-spacer'); ?>
					
					</div>
					<!-- FullSren Slider End -->
					

				</div>	
				<!-- Skin Managment Settings End -->
				
				<!-- Map Settings Panel -->
				<div id="Map-settings" class="panel">
				  <div class="content-head">
					<h3>
					  <?php _e('Map Settings', TEXTDOMAIN); ?>
					</h3>
					 <a href="#" class="save-button" ><span class="save">save</span>
					  <div class="tooltip">
						<div>
						  <?php _e('SAVE', TEXTDOMAIN); ?>
						</div>
					  </div>
					  <?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
					</a>
				  </div>
				  
				  <!-- Display Map -->
				  <div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Enable or disable map', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Map Display', TEXTDOMAIN); ?>
					  </div>
					</div>
                      
					<?php SwitchInput('location_display', 'Disabled', 'Enabled'); ?>
				  </div>
				  <!-- Display contact -->
                    
                    
                    
                    
                    
                     <!-- marker Upload -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('You can set a marker icon for your google map', TEXTDOMAIN);                             ?></div>
							<div class="label"><?php _e('Custom Marker', TEXTDOMAIN); ?></div>
						</div>
						<?php MediaInput('marker', '', 'Upload Map Marker', 'px-settings-marker'); ?>
					</div>
					<!-- marker Upload End --> 
                    
                    <!-- GMAPE API KEY -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Enter Your Google Map API Key', TEXTDOMAIN);                             ?></div>
							<div class="label"><?php _e('Your Gmap API Key', TEXTDOMAIN); ?></div>
						</div>
						<?php TextInput('gmap_api_key', 'Google Map API Key', 'field-spacer'); ?>

					</div>
					<!-- GMAPE API KEY --> 
                    
				  
				<!--Contact Form-->
				<div class="section">
					<div class="section-head">
						<div class="section-tooltip"><?php _e('You can choose between available map types to be shown in cotact section.', TEXTDOMAIN); ?></div>
						<div class="label"><?php _e('Map Style', TEXTDOMAIN); ?></div>
					</div>
					
					<?php SwitchInput('contact_map_custom', 'Light', 'Dark'); ?>
					
				</div>
				
					
				  <!--Map Info-->
				  <div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Enter your map address latitude & longitude and zoom levels. Zoom value can be from 1 to 19 where 19 is the greatest and 1 the smallest.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Map Properties', TEXTDOMAIN); ?>
					  </div>
					</div>

					<?php TextInput('contact_map_Latitude', 'Google Maps latitude', 'field-spacer'); ?>
					<?php TextInput('contact_map_Longitude', 'Google Maps longitude', 'field-spacer'); ?>

					<?php 
								for($i=1; $i<=19; $i++){ 
									$zoomArr[$i] = 'Zoom ' . $i;
								} 
								
								SelectTag('contact_map_zoom', $zoomArr );
								?>

				  </div>

				</div>
				<!-- Map Settings Panel End -->

				<!-- Contact Settings Panel -->
				<div id="contact-settings" class="panel">
					<div class="content-head">
						<h3><?php _e('Contact Settings', TEXTDOMAIN); ?></h3>
						 <a href="#" class="save-button" ><span class="save">save</span>
							<div class="tooltip">
								<div><?php _e('SAVE', TEXTDOMAIN); ?></div>
							</div>
							<?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
						</a>
					</div>
					
					<!-- contact form 7 Shortcode -->
					<div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Write contact form 7 Shortcode here', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Contact form 7 Shortcode', TEXTDOMAIN); ?>
					  </div>
					</div>
					
						<?php TextInput('contactform7_shortcode', 'ContactFrom7 Shortcode', 'field-spacer'); ?>
					
					</div>
					<!-- contact form 7 Shortcode End -->
					
					<!-- contact form info -->
					<div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Write your contact info here.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Contact info', TEXTDOMAIN); ?>
					  </div>
					</div>
						
						<?php TextInput('contact_info_1', 'Address', 'field-spacer'); ?>
						<?php TextInput('contact_info_2', 'Tel', 'field-spacer'); ?>
						<?php TextInput('contact_info_3', 'E-mail', 'field-spacer'); ?>
						<?php TextInput('contact_info_4', 'More Information', 'field-spacer'); ?>
						

					</div>
					<!-- contact form info  End -->
					
				</div>
				<!-- Contact Page Settings Panel End -->

				<!-- Portfolio Settings -->
				<div id="portfolio-settings" class="panel">
					<div class="content-head">
						<h3><?php _e('Portfolio Settings', TEXTDOMAIN); ?></h3>
						 <a href="#" class="save-button" ><span class="save">save</span>
							<div class="tooltip">
								<div><?php _e('SAVE', TEXTDOMAIN); ?></div>
							</div>
							<?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
						</a>
					</div>
					
					<!-- Portfolio Layout -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e(' Choose the initial number of portfolio items to be shown before clicking load more button.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Portfolios Post Per Page', TEXTDOMAIN); ?></div>
						</div>
						
						<?php RangeInput('portfolioposts_per_page', 1, 30); ?>
					</div>
					<!-- Portfolio Layout End -->
					
				</div>	
				<!-- Portfolio Settings End -->
				
				<!-- Blog Page Settings -->
				<div id="blog-settings" class="panel">
				  <div class="content-head">
					<h3>
					  <?php _e('Blog Page Settings', TEXTDOMAIN); ?>
					</h3>
					 <a href="#" class="save-button" ><span class="save">save</span>
					  <div class="tooltip">
						<div>
						  <?php _e('SAVE', TEXTDOMAIN); ?>
						</div>
					  </div>
					  <?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
					</a>
				  </div>
				
				  <!-- Blog Intro Text -->
				  <div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Enter blog label here. It will be shown on top of blog Page.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Blog label', TEXTDOMAIN); ?>
					  </div>
					</div>

					<?php TextInput('blog_label', 'blog label', 'blog-intro-title field-spacer'); ?>

				  </div>
				  <!-- Blog Intro Text End -->
				  
				  <!-- Blog Detail Layout -->
				  <div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Here you can disable the sidebar or choose the sidebar position in the blog detail.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Blog Detail Sidebar Position', TEXTDOMAIN); ?>
					  </div>
					</div>

					<?php ImageSelect('blog_sidebar_position', array('none'=>0,'right-side'=>1), 'page-sidebar'); ?>
				  </div>
				  <!-- Blog Detail Layout End -->

				</div>
				<!-- Blog Page Settings End -->


				<!-- Resume Skill Settings -->
				<div id="resume-skill-settings" class="panel">
				  <div class="content-head">
					<h3>
					  <?php _e('Resume Skills Settings', TEXTDOMAIN); ?>
					</h3>
					 <a href="#" class="save-button" ><span class="save">save</span>
					  <div class="tooltip">
						<div>
						  <?php _e('SAVE', TEXTDOMAIN); ?>
						</div>
					  </div>
					  <?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
					</a>
				  </div>
				 
				  <!-- Skill - Title -->
				  <div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Enter Pie chart section title here. for example "Skill Achievement"', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Pie chart section title', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('skill_title', 'Skill title', 'field-spacer'); ?>
					
				  </div>
				  <!-- Skill - Title - End  -->
				  
				  <!-- Skills -->
				  <div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Enter the skills name and completion percent for each skill here.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Skills', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('skill_name_1', 'Skill title 1', 'field-spacer'); ?>
					<?php TextInput('skill_percent_1', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_2', 'Skill title 2', 'field-spacer'); ?>
					<?php TextInput('skill_percent_2', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_3', 'Skill title 3', 'field-spacer'); ?>
					<?php TextInput('skill_percent_3', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_4', 'Skill title 4', 'field-spacer'); ?>
					<?php TextInput('skill_percent_4', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_5', 'Skill title 5', 'field-spacer'); ?>
					<?php TextInput('skill_percent_5', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_6', 'Skill title 6', 'field-spacer'); ?>
					<?php TextInput('skill_percent_6', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_7', 'Skill title 7', 'field-spacer'); ?>
					<?php TextInput('skill_percent_7', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_8', 'Skill title 8', 'field-spacer'); ?>
					<?php TextInput('skill_percent_8', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_9', 'Skill title 9', 'field-spacer'); ?>
					<?php TextInput('skill_percent_9', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_10', 'Skill title 10', 'field-spacer'); ?>
					<?php TextInput('skill_percent_10', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_11', 'Skill title 11', 'field-spacer'); ?>
					<?php TextInput('skill_percent_11', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					<br>
					<?php TextInput('skill_name_12', 'Skill title 12', 'field-spacer'); ?>
					<?php TextInput('skill_percent_12', 'completion percent', 'field-spacer', 'field-spacer'); ?>
					

				  </div>
				  <!-- Skills -->

				</div>
				<!-- Resume Skill Settings End -->

				<!-- Resume Work Experience Settings -->
				<div id="resume-work-settings" class="panel">
				  <div class="content-head">
					<h3>
					  <?php _e('Resume Work Experience Settings', TEXTDOMAIN); ?>
					</h3>
					 <a href="#" class="save-button" ><span class="save">save</span>
					  <div class="tooltip">
						<div>
						  <?php _e('SAVE', TEXTDOMAIN); ?>
						</div>
					  </div>
					  <?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
					</a>
				  </div>

				  <!-- Work Experience - Title -->
				  <div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Enter experiences section title here, for example "Work Experiences" ', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Work Experiences title', TEXTDOMAIN); ?>
					  </div>
					</div>

					<?php TextInput('work_experience_title', 'Work Experience title', 'field-spacer'); ?>
					
				  </div>
				  <!-- Work Experience -  Title - End  -->
				  
				  <!-- Work Experience -->
				  <div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Enter your experience title and subtitle to be shown in experience section. you can upload an image and write a text about it to be shown in a popup when you click on experience title', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Experience 1', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_1', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_1', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_1', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_1', 'Write something about this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Experience 2', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_2', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_2', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_2', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_2', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Experience 3', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_3', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_3', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_3', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_3', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Experience 4', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_4', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_4', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_4', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_4', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Experience 5', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_5', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_5', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_5', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_5', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Experience 6', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_6', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_6', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_6', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_6', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Experience 7', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_7', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_7', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_7', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_7', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Experience 8', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_8', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_8', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_8', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_8', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Experience 9', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_9', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_9', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_9', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_9', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Work Experience 10', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_10', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_10', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_10', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_10', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Work Experience 11', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_11', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_11', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_11', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_11', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
					<div class="section-head">
					  <div class="label">
						<?php _e('Work Experience 12', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('work_exp_title_12', 'Experience Title', 'field-spacer'); ?>
					<?php TextInput('work_exp_subtitle_12', 'Experience Subtitle', 'field-spacer', 'field-spacer'); ?>
					<?php MediaInput('work_exp_img_12', '', 'Upload Image', 'px-settings-work-Experience', 'field-spacer'); ?>
					<?php Textarea('work_exp_text_12', 'Write something this experience.', 'field-spacer'); ?>
					<br>
					
				  </div>
				  <!-- Skills -->

				</div>
				<!--  Resume Work Experience Settings End -->
				
				<!-- About Settings -->
				<div id="about-settings" class="panel">
				  <div class="content-head">
					<h3>
					  <?php _e('About Settings', TEXTDOMAIN); ?>
					</h3>
					 <a href="#" class="save-button" ><span class="save">save</span>
					  <div class="tooltip">
						<div>
						  <?php _e('SAVE', TEXTDOMAIN); ?>
						</div>
					  </div>
					  <?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
					</a>
				  </div>


					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Enable or Disable About Photo.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Display About Photo ', TEXTDOMAIN); ?></div>
						</div>

						<?php SwitchInput('about_photo_display', 'Disabled', 'Enabled'); ?>
					</div>
				
				  <!-- About - Your Photo -->
				  <div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Upload your photo here to be shown in About section.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Your photo', TEXTDOMAIN); ?>
					  </div>
					</div>   

					<?php MediaInput('about_photo', '', 'Upload your photo', 'px-settings-about-photo'); ?>
				  </div>
				  <!-- About - Your Photo End  -->
				
				 <!-- About Name -->
				  <div class="section">
				  
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Add Your Name Here.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Your Name', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('about_title', 'Add Your Name Here', 'field-spacer'); ?>
					
				  </div>
				  <!-- About Name End -->
				  
				   <!-- About position -->
				  <div class="section">
				  
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Add Your job title here.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Your Job', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php TextInput('about_position', 'Add Your Job Title Here', 'field-spacer'); ?>
					
				  </div>
				  <!-- About position End -->
				  
				  <!-- About Content -->
				  <div class="section">
				  
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Write something about yourself.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('About Content', TEXTDOMAIN); ?>
					  </div>
					</div>
					
					<?php Textarea('about_description', 'Write something about yourself.', 'field-spacer'); ?>

				  </div>
				  <!-- About Content End -->
				  
				  <!-- About - Your signature -->
				  <div class="section">
					<div class="section-head">
					  <div class="section-tooltip">
						<?php _e('Upload your signature (image) here to be shown in about section.', TEXTDOMAIN); ?>
					  </div>
					  <div class="label">
						<?php _e('Your Signature', TEXTDOMAIN); ?>
					  </div>
					</div>   

					<?php MediaInput('about_signature', '', 'Upload your signature', 'px-settings-about-signature'); ?>
				  </div>
				  <!-- About - Your signature End  -->

				</div>
				<!-- About Settings End -->
				
				<!-- Social Icons Settings -->
				<div id="Social-settings" class="panel">
					<div class="content-head">
						<h3><?php _e('Social Icons', TEXTDOMAIN); ?></h3>
						 <a href="#" class="save-button" ><span class="save">save</span>
							<div class="tooltip">
								<div><?php _e('SAVE', TEXTDOMAIN); ?></div>
							</div>
							<?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
						</a>
					</div>
					
					<!-- Social icon -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Enter your socail icons address here. You can clear the field to hide icon from social icons section.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Facebook Address', TEXTDOMAIN); ?></div>
						</div>
						
						<!-- Facebook URL -->
						<?php TextInput('social_facebook_address'); ?>
					
						<!-- Twitter URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Twitter Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_twitter_address'); ?>
					
						<!-- Dribbble URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Dribbble Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_dribbble_address'); ?>
						
						<!-- Vimeo URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Vimeo Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_vimeo_address'); ?>
				
						<!-- YouTube URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('YouTube Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_youtube_address'); ?>
					
						<!-- GooglePlus URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('GooglePlus Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_googleplus_address'); ?>
					
						<!-- instagram URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Instagram Address', TEXTDOMAIN); ?></div>
						</div>
							
						<?php TextInput('social_instagram_address'); ?>
                        
                        
                        <!-- pinterest URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Pinterest Address', TEXTDOMAIN); ?></div>
						</div>
							
						<?php TextInput('social_pinterest_address'); ?>
                        
                        <!-- flipboard URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Flipboard Address', TEXTDOMAIN); ?></div>
						</div>
							
						<?php TextInput('social_flipboard_address'); ?>
						
						<!-- Linkedin URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Linkedin Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_linkedin_address'); ?>
						
						<!-- yahoo URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Yahoo Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_yahoo_address'); ?>
					
						<!-- behance URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Behance Address', TEXTDOMAIN); ?></div>
						</div>
							
						<?php TextInput('social_behance_address'); ?>
						
						<!-- Rss URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('RSS Feed Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('rss_feed_address'); ?>
					
						<!-- deviantart URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Deviantart Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_deviantart_address'); ?>
					
						<!-- skype URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Skype Address', TEXTDOMAIN); ?></div>
						</div>
							
						<?php TextInput('social_skype_address'); ?>
						
						<!-- Flickr URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Flickr Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_flickr_address'); ?>
					
						<!-- lastFM URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('lastFM Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_lastFM_address'); ?>

						<!-- forrst URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Forrst Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_forrst_address'); ?>
					
						<!-- reddit URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Reddit Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_reddit_address'); ?>
						
						<!-- dingg URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Dingg Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_dingg_address'); ?>
					
						<!-- gowalla URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('gowalla Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_gowalla_address'); ?>
	
						<!-- orkut URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Orkut Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_orkut_address'); ?>
						
						<!-- zerply URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('zerply Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_zerply_address'); ?>
                        
                        
                        <!-- xing URL -->
						<br />
						<div class="section-head">
							<div class="label"><?php _e('Xing Address', TEXTDOMAIN); ?></div>
						</div>
						
						<?php TextInput('social_xing_address'); ?>
						
						
					</div>	
				</div>	
				<!-- Social Icons End -->

				<!-- Advanced Option -->
				<div id="advanced-settings" class="panel">
					<div class="content-head">
						<h3><?php _e('Advanced Settings', TEXTDOMAIN); ?></h3>
						 <a href="#" class="save-button" ><span class="save">save</span>
							<div class="tooltip">
								<div><?php _e('SAVE', TEXTDOMAIN); ?></div>
							</div>
							<?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
						</a>
					</div>
					<!-- Advanced JS Setting -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Enter your custom javascript codes here.(eg Google Analytics)', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Custom Javascript', TEXTDOMAIN); ?></div>
						</div>
						
						<?php Textarea('custom_javascript'); ?>
					</div>	
					<!-- Advanced JS Setting End -->
					<!-- Advanced CSS Setting -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('Enter your custom css codes here to override or add to the default stylesheet.', TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Custom CSS', TEXTDOMAIN); ?></div>
						</div>

						<?php Textarea('custom_css'); ?>
					</div>	
					<!-- Advanced CSS Setting End -->
				</div>	
				<!-- Advanced Option End -->

				<!-- Import Settings -->
				<div id="import-settings" class="panel">
					<div class="content-head">
						<h3><?php _e('Import Dummy Content', TEXTDOMAIN); ?></h3>
						 <a href="#" class="save-button" >save
							<div class="tooltip">
								<div><?php _e('SAVE', TEXTDOMAIN); ?></div>
							</div>
							<?php admin_img('loading24.gif', 'Loading', 'loading-icon'); ?>
						</a>
					</div>
					
					<!-- Enable Demo Content Import -->
					<div class="section">
						<div class="section-head">
							<div class="section-tooltip"><?php _e('If you are new to wordpress or have problems creating posts or pages that look like the theme preview you can import dummy posts and pages here that will definitley help to understand how those tasks are done. Please note that this will override theme options as well, so be careful.',TEXTDOMAIN); ?></div>
							<div class="label"><?php _e('Import Dummy Data',TEXTDOMAIN); ?></div>

						</div>
						
                        <?php
                           $dummyArray =  array(
                                'standard'  => 'Standard',
                                'rtl'  => 'Right To Left',
                            );
    
						    SelectTag('dummy_data_items', $dummyArray);
                            
						?>
                        
						<?php SwitchInput('import_dummy_data', 'Disabled', 'Import Data'); ?>
						<br /><hr /><hr />
						<p class="importer-description">After you have imported the demo content <br /><br />1- go to "WordPress dashboard > Appearance > menus" and set "Profession Menu" as primary.<br /><br />
							2 - go to "WordPress dashboard > settings > reading" and choose home page as your website's front page.</p>
						Also you can watch this video: <a href="https://www.youtube.com/watch?v=11woAGq4iV4&list=PL8E_YDRvzh5Nz-sYUh2JPpauOrOhwDIzi">Importing Demo</a>
						<hr /><hr />
					</div>
				</div>	
				
			</div>
		</div>
		<!--End Main-->
	</div>
</div>