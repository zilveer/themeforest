<?php
	$force_regenerate_url = 'http://wordpress.org/plugins/force-regenerate-thumbnails/';
?>
<div class="thb-highlighted-section">
	<div class="thb-col full section-heading center">
		<h2 class="section-title">Setup your theme</h2>
		<p class="section-desc">If you're new to WordPress, please follow these steps in order to get your website up and running in style.</p>
	</div>

	<div class="thb-col full first">
		<div class="thb-shortcode thb-tabs horizontal" data-open="0">
			<ul class="thb-tabs-nav">
				<li><a href="#tab-0"><span class="number">1</span> Upload your logo</a></li>
				<li><a href="#tab-1"><span class="number">2</span> Create and assign a menu</a></li>
				<li><a href="#tab-2"><span class="number">3</span> Define a static page</a></li>
				<li><a href="#tab-3"><span class="number">4</span> Customize the style</a></li>
			</ul>

			<div class="thb-tabs-contents">
				<div class="thb-tab-content">
					<img src="<?php echo THB_ADMIN_CSS_URL ?>/i/welcome/welcome-logo.jpg" alt="" class="align-left">
					<p>From the <strong>Logo &amp; Images</strong> tab in the <strong>Theme options</strong> page, you can upload a graphic logo<span class="note-mark">*</span>.</p>
					<p>If you just want a simple text logo, instead, leave the upload field empty, and your website's title and description (optional) will be displayed. You can customize their appearance via the WordPress Customizer.</p>
					<p class="note"><span class="note-mark">*</span>Please remember to unload a properly dimensioned one.</p>
					<a href="<?php echo thb_system_admin_url('thb-theme-options', array('tab' => 'general_images')); ?>" class="thb-btn thb-btn-standard margin-top" target="_blank">Upload your logo</a>
				</div>
				<div class="thb-tab-content">
					<img src="<?php echo THB_ADMIN_CSS_URL ?>/i/welcome/welcome-menu.jpg" alt="" class="align-left">
					<p>After the theme has been activated and the dummy content has been imported, you need to manually assign a menu to one of the locations available for the theme. You can do so from the <strong>"Appearance > Menus"</strong> options panel.</p>
					<p>You can read more about this on the <a href="http://codex.wordpress.org/Appearance_Menus_Screen" target="_blank">WordPress Codex</a>.</p>
					<a href="<?php echo admin_url('nav-menus.php'); ?>" class="thb-btn thb-btn-standard margin-top" target="_blank">Define a menu</a>
				</div>
				<div class="thb-tab-content">
					<img src="<?php echo THB_ADMIN_CSS_URL ?>/i/welcome/welcome-staticpage.jpg" alt="" class="align-left">
					<p>In order to define a page as the home of your website, head over to the <strong>"Settings > Reading"</strong> options panel, then choose your new front-page from the <strong>"A static page"</strong> select option.</p>
					<p>Please note that for a correct pagination we suggest to leave the "Posts page" select empty.</p>
					<p>You can read more about this on the <a href="http://codex.wordpress.org/Settings_Reading_Screen" target="_blank">WordPress Codex</a>.</p>
					<a href="<?php echo admin_url('options-reading.php'); ?>" class="thb-btn thb-btn-standard margin-top" target="_blank">Set a static page</a>
				</div>
				<div class="thb-tab-content">
					<img src="<?php echo THB_TEMPLATE_URL; ?>/css/i/welcome/welcome-customizer.jpg" alt="" class="align-left">
					<p>You can start to customizing the theme's look &amp; feel, from colors to fonts, from the <strong>"Appearance > Customize"</strong> section.</p>
					<a href="<?php echo admin_url('customize.php'); ?>" class="thb-btn thb-btn-standard margin-top" target="_blank">Customize the theme</a>
				</div>
			</div>
		</div>

	</div>
</div>

<?php thb_get_template_part( 'config/video_tutorials' ); ?>

<span class="thb-divider blank"></span>
<span class="thb-divider blank"></span>

<div class="thb-col full section-heading center">
	<h2 class="section-title">Frequently asked questions</h2>
	<p class="section-desc">Here you can find some of the most frequently asked questions that will help with the setup of your new website with our theme.</p>
</div>

<div class="thb-col two-thirds centered">

	<div class="thb-shortcode thb-accordion">
		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">How to update the theme <span class="badge important">important</span></h5>

			<div class="thb-toggle-content">
				<p class="highlighted"><strong>Important</strong>: before beginning the update procedure, make sure to <strong>make a backup</strong> of the theme folder inside your WordPress themes folder, located in /wp-content/themes/your-theme.</p>
				<p class="highlighted"><strong>Tip</strong>: We suggest to use a plugin like <a href="https://wordpress.org/plugins/easy-theme-and-plugin-upgrades" target="_blank">Easy theme and plugin upgrades</a> that can upgrade easily your theme and optionally make a backup.</p>
				<p>Also, before downloading the updated package, make sure to read the version changelog and the list of changed files.</p>
				<p>To update the your theme, re-download the theme, extract the zip file's contents, find the extracted theme folder, and upload it using a FTP client to the /wp-content/themes/your-theme folder in your server. Beware: <strong>this will overwrite the old files</strong>! That's why it's important to backup any changes you've made to the theme files beforehand.</p>
				<p>If you didn't make any changes to the theme files, you are free to overwrite them with the new files without risk of losing theme settings, pages, posts, etc. Backwards compatibility is guaranteed.</p>
				<p>If you have made changes to the theme files, you will need to compare your changed files to the new files listed in the changelog below and merge them together.</p>
				<p>We strongly suggest to use the provided <strong>child theme</strong>, as it would not break the theme compatibility with future updates.</p>
				<p>When updating, or when switching from a previous WordPress installation, we warmly recommend that you <strong>regenerate the theme's Media Library items thumbnails</strong>: you can do that automatically, using a plugin like "<a href="<?php echo $force_regenerate_url; ?>" target="_blank">Force Regenerate thumbnails</a>". Unused image sizes will also be cleared from your media library.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">How to update our plugins <span class="badge important">important</span></h5>

			<div class="thb-toggle-content">
				<p>In order to update a plugin bundled with our theme (for example "THB Portfolio") you've to follow these steps:</p>
				<ol>
					<li>Go to "Plugins > Installed plugins"</li>
					<li>Deactivate the plugin (for example "THB Portfolio")</li>
					<li>Delete the plugin</li>
					<li>Go to "Appearance > Install plugins" and install the required plugin (for example "THB Portfolio")</li>
					<li>Activate the plugin</li>
				</ol>
				<p>You can then check that the version number has changed in the "Plugins > Installed plugins" page.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">How to find and modify an elment via CSS</h5>

			<div class="thb-toggle-content">
				<p>To find and style an element on your page via CSS, you need to find the appropriate CSS selector and then apply some CSS style on it. E.g.</p>
				<p><code class="css">selector { color: red; }</code></p>
				<p>You can use the <strong>"Custom frontend CSS"</strong> textarea under <strong>"Theme Options > Appearance"</strong> tab or via a child theme in its style.css file.</p>
				<p>You can easily find CSS elements by using your browser inspector or <strong>Firebug</strong>, or view a quick guide <a href="http://sixrevisions.com/tools/firebug-guide-web-designers/" target="_blank">here</a>.
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">How to show the home page link in the WordPress menu</h5>

			<div class="thb-toggle-content">
				<p>In order to add a home link to menus that you create via the menus admin area go to the WordPress Menu section, from the Pages box click the "View All" tab, then "Home" will appear, check the box and click "add to menu".</p><br />
				<img src="<?php echo THB_ADMIN_CSS_URL ?>/i/faq/faq-homemenu.png" alt="">
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">How to install the demo content</h5>

			<div class="thb-toggle-content">
				<p>To load the demo content in your website, make sure to install the official <a href="http://wordpress.org/plugins/wordpress-importer/">WordPress Importer</a> plugin. After the plugin has been installed, go to the <strong>"Tools > Import > WordPress"</strong> page, and upload the dummy content XML file provided in the theme package.</p>
				<p>After the dummy content has been uploaded, you'll need to associate a menu to the theme defined menu locations.</p>
				<p>You can then set a static page to be your website's home: head over to the <strong>"Settings > Reading"</strong> options panel, then choose your new front-page from the <strong>"A static page"</strong> select option.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">My page displays a 404 error</h5>

			<div class="thb-toggle-content">
				<p>If any of the theme's pages display a 404 error instead of their actual content, it's very likely that you'll have to rebuild your permalink structure.</p>
				<p>You can do so by accessing the <strong>"Settings > Permalinks"</strong> page in the WordPress admin area, selecting your desired structure, and save the changes.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">Disable the WordPress comments on a page</h5>

			<div class="thb-toggle-content">
				<p>In order to disable comments on pages just open the "Screen options" panel in the upper right hand corner, and check the "Discussion" checkbox.</p>
				<p>You'll find a "Discussion" box in the page editing screen: make sure to have the <strong>"Allow comments"</strong> checkbox unchecked.</p><br>
				<img src="<?php echo THB_ADMIN_CSS_URL ?>/i/faq/faq-comments.jpg" alt="">
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">My images don't look good</h5>

			<div class="thb-toggle-content">
				<p>If your images don't look good (e.g. too pixelated or stretched) you probably need to regenerate your thumbnails. You can do so using a plugin like "<a href="<?php echo $force_regenerate_url; ?>" target="_blank">Force Regenerate thumbnails</a>" that will clear your media library unused image sizes and create the new ones used from our theme.</p>
				<p>This issue may occur when you install the theme over an existing WordPress installation.</p>
				<p>If you feel like images are pixelated, you might want to modify the images size. To do so, you can open the "config/config-general.php" file and look for the "add_image_size" string. Each image size has a name, which you shouldn't modify, and a width and an height. If the height is left to "null", the image won't be cropped and it's proportions will be used, according to the specified width.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">How to create a font face kit on Fontsquirrel</h5>

			<div class="thb-toggle-content">
				<p>In order to create a custom font package to upload on our <a href="<?php echo thb_system_admin_url('thb-theme-options', array('tab' => 'custom_fonts')); ?>" target="_blank">"Custom font"</a> section you've to go to <a href="http://www.fontsquirrel.com/tools/webfont-generator" target="_blank">Fontsquirrel Web Font Generator</a> and follow the page instructions on how to create a package.</p>
				<p>When you've downloaded the package with your custom font you've to upload to our <a href="<?php echo thb_system_admin_url('thb-theme-options', array('tab' => 'custom_fonts')); ?>" target="_blank">"Custom fonts"</a> section, then you'll find your custom font at the bottom of the the Font Family select on the <a href="<?php echo admin_url('customize.php'); ?>" target="_blank">WordPress Customizer</a>.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">How to export theme options and skins</h5>

			<div class="thb-toggle-content">
				<p>You can always backup your Customizer preferences or all the options defined in the <strong>"Theme options"</strong> section from the <strong><a href="<?php echo thb_system_admin_url('thb-framework_settings', array('tab' => 'export')); ?>" target="_blank">"Framework Settings > Export"</a></strong> page.</p>
				<p>Upon clicking on the Export button, the browser will prompt you to save a file with a .thb-backup extension which will contain your settings, encrypted.</p>
				<p>You can also save individually skins or theme options.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">How can I translate the theme</h5>

			<div class="thb-toggle-content">
				<p>The default locale for our themes is <strong>en_US</strong>. If you want to change a translatable string in the theme without changing the theme locale, you must make a copy of the languages/default.po file, and rename it following the locale convention (e.g. en_US.po for english, etc.).</p>
				<p>If you want to localize the theme, you should edit the wp-config.php file and change the WPLANG constant value to something different (e.g. de_DE for german), and create a new .po file in the aforementioned folder as explained above.</p>
				<p>If you're using a translation plugin instead, such as <a href="http://wpml.org/" target="_blank">WPML</a>, make sure to always create .po files according to the languages that have been enabled.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">I need to alter some pages markup or functionality <span class="badge advanced">advanced</span></h5>

			<div class="thb-toggle-content">
				<p class="highlighted">Please note that by heavily editing complex files like javascript or framework files you can break some theme functionalities.</p>
				<p>Working with the child theme provided is always the right way to work, as it would not break the theme compatibility with future updates and keep the update experience as smooth as possible.</p>
				<p>You can start by installing the child theme provided and copy over the files you need to customize from the main parent theme. You can read more about child themes on the <a href="http://codex.wordpress.org/Child_Themes" target="_blank">official WordPress Codex page</a>.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">Theme configuration <span class="badge advanced">advanced</span></h5>

			<div class="thb-toggle-content">
				<p class="highlighted">Please note that by heavily editing complex files like javascript or framework files you can break some theme functionalities.</p>
				<p>There are four different theme configuration files, located in the config folder, each one entitled to do specific things. This is the order in which they're imported:</p>
				<ul>
					<li>
						<strong>config-general.php</strong>: As long with a varied of options of general relevance, in this file frontend styles and scripts are added, and image sizes and menus are defined.
					</li>
					<li>
						<strong>config-custom.php</strong>: This file contains functions and hooks that are pertinent to the theme only. For example, most of the theme <em>body classes</em> are added here and the hook to which the Layout builder is specified in this file.
					</li>
					<li>
						<strong>config-functionalities.php</strong>: This file store the configuration of common modules implemented by the theme and theme templates. It also includes a link to activate the theme customizer.
					</li>
					<li>
						<strong>config-options.php</strong>: Theme specific options that end up in the theme options panel (e.g. social links options);
					</li>
				</ul>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">How can I add a new page template to the theme? <span class="badge advanced">advanced</span></h5>

			<div class="thb-toggle-content">
				<p class="highlighted">Please note that by heavily editing complex files like javascript or framework files you can break some theme functionalities.</p>
				<p>In the "config/config-general.php" file, you'll find a function named "thb_get_theme_templates". Inside such function, there's an array, so what you want to do is basically add your template file name to that array everywhere you find the 'default' page template.</p>
				<p>To unlock sidebars and slideshow in that template, you'll then need to open the "config/config-functionalities.php" file, and again look for the 'default' string, and similarly add your template file name there too.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">Theme-hooks <span class="badge advanced">advanced</span></h5>

			<div class="thb-toggle-content">
				<p>All of our themes come with the ability to inject additional markup and functionalities in specific parts of the template to allow your custom-built functions to hook into the layout. For more info about WordPress actions, please refer to the <a href="http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters" target="_blank">Codex page</a>.</p>
			</div>
		</div>

		<div class="thb-shortcode thb-toggle">
			<h5 class="thb-toggle-trigger">Customize the backend look &amp; feel <span class="badge advanced">advanced</span></h5>

			<div class="thb-toggle-content">
				<p>From the <strong>"Admin customization"</strong> tab in the <strong>"Framework settings"</strong> options page you can extend the theme customization also on the admin area, uploading a custom login logo or adding custom CSS in your admin area or login page.</p>
			</div>
		</div>

	</div>
</div>

<span class="thb-divider"></span>

<div class="thb-col full first last">
	<h2 class="section-title">How to ask for support</h2>
	<div class="thb-col two-thirds first">
		<p>In order to keep valuable information organized, and to provide a better service to our users, please note that support is offered on the <strong>Support Forums only</strong>. Support requests submitted via either comments on the item's page on ThemeForest, or via email, will all be redirected to the forum.</p>
		<p>Support is intended to be for <strong>bugs only</strong>, and we do not offer guidance for theme modifications, WordPress or plugin related stuff.</p>
		<a class="thb-btn thb-btn-standard margin-top" href="http://thbthemes.com" target="_blank">Go to the support page</a>
	</div>

	<div class="thb-col one-third last thb-feature-box highlighted">
		<h3>Please note</h3>
		<p>Before opening a report please make sure to read our policy about <a href="http://thbthemes.com/support-policy/" target="_blank">"How to ask for support"</a>, then go through the <strong><?php echo thb_get_theme_name(); ?> forum</strong>, and click on the green "Report a bug" button.</p>
	</div>
</div>