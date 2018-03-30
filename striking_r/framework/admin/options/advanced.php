<?php
class Theme_Options_Page_Advanced extends Theme_Options_Page_With_Tabs {
	public $slug = 'advanced';

	function __construct(){
		$this->name = __('Advanced Settings','theme_admin');
		parent::__construct();
	}

	function tabs(){
		$options = array(
			array(
				"slug" => 'general',
				"name" => __("Admin Options",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Demo Type to Import",'theme_admin'),
						"id" => "demotype",
						"default" => 'large',
						"desc" => __('Select the demo content of your choice to import before starting the import function.','theme_admin'),
						"options" => array(
							"large" => __('Original Demo Content','theme_admin'),
							"small" => __('Small Demo Content','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Install MultiFlex Demo Data Set",'theme_admin'),
						"id" => "install_dummy_datainstall_dummy_data",
						"desc" => __('Use this button to install the demo data set. &nbsp;Please be aware that the demo data comprises a significant amount of content (about 120 pages), and we suggest this demo data be installed in a local host (ie home or work computer using a program such as WAMP or MAMP which allow one to run server type software: apache/php/curl, on a windows or apple computer in order to replicate a server environment) not in the online site.','theme_admin'),
						"default" => false,
						"function" => "_option_install_dummy_data_function",
						"type" => "custom"
					),
					array(
						"name" => __("Clear Cache - VERY IMPORTANT SETTING AFTER UPDATES AND UPGRADES!",'theme_admin'),
						'desc'=>__('<p>Striking creates multiple images for use in different resizing situations every time one loads new imagery, and it also creates a temporary ongoing file which stores all the striking settings for use on the fly for page transitions (it also creates a permanent file of those settings as well, found below in the <b>Import & Export</b> field so you can export the settings for backup purposes).&nbsp;&nbsp; After each update of Striking one should come to this setting and and toggle it <em>ON</EM> and then save this Striking Advanced Panel. &nbsp;&nbsp;Subsequently one should go to any of the skin panels such as the Color or Font Panel and save it again to rewrite the temporary skin file of settings for the on-the-fly use.</p><p>Anytime one encounters a situation after an upgrade in which featured and slide images are not showing, one should always use this setting.</p><p>NOTE: &nbsp;&nbsp;After saving this Advanced Panel this setting will revert to the off status again - but as long it was toggled on prior to saving the panel it will have performed the task of flushing the image cache and temporary skin settings.</p>','theme_admin'),
						"id" => "clear_cache",
						"default" => false,
						"process" => "_option_clear_cache_process",
						"type" => "toggle"
					),
					array(
						"name" => __("Show Striking MultiFlex Panel Menu in the WP Admin Bar",'theme_admin'),
						"desc" => __("This option inserts the Striking MultiFlex panel menu into the WP admin bar to the right of the &#34;New&#34; menu group.",'theme_admin'),
						"id" => "admin_bar_menu",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Gmap Api Key",'theme_admin'),
						"desc" => __('Set a Gmap Api Key. You can generate one here : <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Generate Gmap Api</a>','theme_admin'),
						"id" => "gmap_api_key",
						"default" => '',
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Move Js To Bottom",'theme_admin'),
						"desc" => __("<p>As of 2014, the MultiFlex core files are already minimized and combined where possible on page loading. &nbsp;However, it is the choice of the user as to whether they wish to load the js files before or after the page content. &nbsp;The old Combine CSS and Combine JS settings are removed from Striking as the MultiFlex release now does these functions automatically.</p> ",'theme_admin'),
						"id" => "move_bottom",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Allow Shortcode Support in Comment Fields",'theme_admin'),
						"desc" => __("<p>Normally left off but if running a community site with many users that have author/editor/administrator permissions and thus knowledge of shortcodes, this setting provides the option to enable shortcode support in the comments field.</p>",'theme_admin'),
						"id" => "shortcode_comment",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Reset a Theme Panel to Default",'theme_admin'),
						"id" => "rest",
						"default" => array(),
						"desc" => __('If you want reset a theme option to default, please check the item below and save. &nbsp;One can reset any number of panels at the same time, and as often/whenever necessary.','theme_admin'),
						"options" => array(
							"general" => __('General','theme_admin'),
							"background" => __('Background','theme_admin'),
							"color" => __('Color','theme_admin'),
							"font" => __('Font','theme_admin'),
							"slideshow" => __('SlideShow','theme_admin'),
							"sidebar" => __('Sidebar','theme_admin'),
							"image" => __('Image','theme_admin'),
							"media" => __('Media','theme_admin'),
							"homepage" => __('Homepage','theme_admin'),
							"blog" => __('Blog','theme_admin'),
							"portfolio" => __('Portfolio','theme_admin'),
							"footer" => __('Footer','theme_admin'),
							"advanced" => __('Advanced','theme_admin'),
						),
						"process" =>"_option_reset_options_process",
						"type" => "checkboxes",
					),
				),
			),
			array(
				"slug" => 'update',
				"name" => __("Update Your Striking Theme",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Usage and Item Purchase Code",'theme_admin'),
						"id" => "item_purchase_code",
						'desc' => __('<p>Striking includes an internal update ability.&nbsp;&nbsp;Instead of having to visit Themforest to download the latest update and install by ftp, one can usually use this internal updating function to update when a notice has appeared in the Dashboard that a new build is available.&nbsp;&nbsp;</p><p>It is a two step process ot updating:</p>
<p>Step 1 - Enter your Item Purchase code into this field, and then save this panel.  DO NOT attempt to update without first having saved after completing the purchase code field.&nbsp;&nbsp;If you enter your purchase code and then skip saving the update will fail, and possibly crash your site!!&nbsp;&nbsp;So enter, save, and then proceed to the <b>Update</b> setting below.&nbsp;&nbsp; The license purchase code is found in the license certificate which accompanys your purchase and this link shows one where to <a href="http://kaptinlin.com/support/page/get_code.html" target="_blank">obtain the license certificate</a> in your Themeforest account.</p><p>Step 2 is to go to the <b>Update</b> setting below and trigger the update.</p><p>IMPORTANT!! - Accompanying every build release is a new thread at the Striking Support forum advising on any special procedures for updating and you should review it carefully and completely.</p><p><b>CHILD THEME USERS CANNOT UPDATE USING THIS SETTING AND MUST REVIEW THE CORRECT PROCEDURES AT THE FORUM FOR UPDATING - UPDATING SHOULD BE DONE BY FTP USING THE DOWNLOAD FROM THEMEFOREST, AND ALSO INCLUDE INSTITUTING THE LATEST CHILD VERSION.  FAILURE BY A CHILD USER TO FOLLOW THE CORRECT PROCEDURES WILL LIKELY CRASH THE SITE, MAKE THE ADMIN INACCESSIBLE, AND POSSIBLY REQUIRE RESTORATION FROM A BACKUP.</b></p><p>Only experienced professionals should use the default Child theme in most circumstances, and <u>any help required by the Striking Team for a site rescue will have an accompanying charge of no less then 250USD, paid in advance.</u>&nbsp;&nbsp;If one had a site created by a professional, check with them to determine if they used the child theme and if in doubt, contact Striking support for assistance prior to attempting to update.</p>','theme_admin'),
						"default" => '',
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Enable Notification",'theme_admin'),
						"id" => "update_notification",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Update",'theme_admin'),
						"id" => "updating_theme",
						"desc" => __('<p>Use this setting to commence updating Striking to the latest version. &nbsp;&nbsp;One will also see the option to review the build features and code changes, file additions, and deletions, and also download the build so that one has a backup copy of it saved.</p><p>WHAT TO DO IF UPDATE FAILS - for a variety of reasons the update may fail.&nbsp;&nbsp;Most often it turns out that the web host has security permissions in place that prevent the Striking update api from connecting and loading the update.&nbsp;&nbsp;Some users have security measures from security plugins, or modifications in the .htaccess file, which have a similar affect.&nbsp;&nbsp;If the internal update does not work then one can simply update by ftp - it will take 5 minutes longer, but is the traditional method of updating up until recently in any case and is the default fallback method for updating.when the internal function does not work.</p>','theme_admin'),	
						"default" => false,
						"function" => "_option_update_theme_function",
						"type" => "custom"
					),
				),
			),
			array(
				"slug" => 'responsive',
				"name" => __("Responsive & Header / Navigation Viewport Options",'theme_admin'),
				"desc" => __("<p>This resource group contains a setting for controlling the overall responsive ability of Striking MultiFlex, and a group of settings for controlling the display of various header elements and the sticky footer in different responsive viewports. &nbsp;The individual settings have more detailed help dialogs to guide on usage.</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Turn ON/OFF Theme Responsive Ability",'theme_admin'),
						"desc" => __('If for some reason it is necessary to turn off the responsive ability of the theme then toggle this setting to the <b>Off</b> position.','theme_admin'),
						"id" => "responsive",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Enable Pinch function on a mobile device",'theme_admin'),
						"desc" => __('Responsive sites normally do not have a pinch functionality for when a site viewer wishes to resize a screen on their mobile device (as the content has resized and repositioned for the mobile device).  This setting enables you to restore pinch functionality for mobile devices.','theme_admin'),
						"id" => "user_scalable",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Enable Auto Resize function when responsive",'theme_admin'),
						"id" => "responsive_resize",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Choose the Viewports for the Header Top Area to Display",'theme_admin'),
						"desc" => __('This setting allows for choosing the viewports for which the Header Top Area will display.','theme_admin'),
						"id" => "top_area_target",
						"default" => '768',
						"options" => array(
							"320" => __('All','theme_admin'),
							"480" => __('> 480 (480, 568, 768, 980)','theme_admin'),
							"568" => __('> 568 (568, 768, 980)','theme_admin'),
							"768" => __('> 768 (768, 980)','theme_admin'),
							"980" => __('> 980','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Viewport for Navigation to Switch to Mobile Menu Format",'theme_admin'),
						"desc" => __('<p>The default is that the menu will switch to the mobile format once the viewport is smaller then 980px (so it turns mobile on a 10 inch tablet). &nbsp;If one has only a few top level navigation items, it may be possible to have the full menu show in lessor viewports, which is the purpose of this setting.  &nbsp;Please note the menu is always in mobile format for the 320 (mobile phone portrait mode) viewport.</p>','theme_admin'),
						"id" => "nav2select",
						"default" => '980',
						"options" => array(
							"480" => __('< 480 (320)','theme_admin'),
							"568" => __('< 568 (480, 320)','theme_admin'),
							"768" => __('< 768 (568, 480, 320)','theme_admin'),
							"980" => __('< 980 (768, 568, 480, 320)','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Sticky Header Auto-Off Viewport",'theme_admin'),
						"desc" => __('<p>This setting is for setting the viewport at which the sticky header, if enabled, automatically turns off. &nbsp;The theme default is below 768.</p>','theme_admin'),
						"id" => "sticky_header_target",
						"default" => '768',
						"options" => array(
							"320" => __('All','theme_admin'),
							"480" => __('> 480 (480, 568, 768, 980)','theme_admin'),
							"568" => __('> 568 (568, 768, 980)','theme_admin'),
							"768" => __('> 768 (768, 980)','theme_admin'),
							"980" => __('> 980','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Sticky Footer Auto-Off Viewport",'theme_admin'),
						"desc" => __('<p>This setting is for setting the viewport at which the sticky footer, if enabled, automatically turns off. &nbsp;The theme default is below 768.</p>','theme_admin'),
						"id" => "sticky_footer_target",
						"default" => '768',
						"options" => array(
							"320" => __('All','theme_admin'),
							"480" => __('> 480 (480, 568, 768, 980)','theme_admin'),
							"568" => __('> 568 (568, 768, 980)','theme_admin'),
							"768" => __('> 768 (768, 980)','theme_admin'),
							"980" => __('> 980','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Viewport for Sub Footer Copyright & Widget Area Split",'theme_admin'),
						"id" => "subfooter_responsive",
						"default" => '980',
						"options" => array(
							"480" => __('< 480 (320)','theme_admin'),
							"568" => __('< 568 (480, 320)','theme_admin'),
							"768" => __('< 768 (568, 480, 320)','theme_admin'),
							"980" => __('< 980 (768, 568, 480, 320)','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Customize the Mobile Menu Navigation Text",'theme_admin'),
						"desc" => __('<p>Once the mobile menu becomes active, a dropdown selector will show for the navigation.  &nbsp;The text showing to prompt the website viewer to use the dropdown field is <i>Navigate to...</i> but it can be changed to any other text, including special characters. &nbsp;The maximum number of characters, including spaces, is 40. &nbsp;Just delete the text in the field below and input alternative navigation text (and Save!).</p>','theme_admin'),
						"id" => "nav2select_defaultText",
						"default" => __("Navigate to...",'striking-r'),
						"htmlspecialchars" => true,
						"size" => "40",
						"type" => "text"
					),
					array(
						"name" => __("Customize the Mobile Menu Item Indent String",'theme_admin'),
						"desc" => __('<p>A nice little unique MultiFlex feature - the various items appearing in the mobile menu dropdown will have a dash in front of them by default, but it can be customized to any other alphanumeric characters. &nbsp;Just delete the dash in the field below and type in other characters.</p>','theme_admin'),
						"id" => "nav2select_indentString",
						"default" => __("&ndash;",'striking-r'),
						"type" => "text"
					),
				),
			),
			array(
				"slug" => 'woocommerce',
				"name" => __("WooCommerce Options",'theme_admin'),
				"desc" => __("This theme has a number of special functions designed for use with the Woocommerce plugin. &nbsp;Below is a list of some functions and abilities of which to be aware:<br /><br />
<b>1)</b> &nbsp;As of version 1.0.2 the theme has been able to amend the woo image function so that you can set a custom height for the various image types in the Woo Settings.  This accomodates articles which are rectangular in shape.  The theme continues to use our more feature filled lightbox function rather then the default Woo function. &nbsp;So you should now go to  Woocommerce/Settings/Catalogue/Image Options to set the height for images. &nbsp;The width setting is fixed per the chart values below and if a custom height value is entered into the woo settings it will be ignored. &nbsp;Below are the image size settings for the Catalogue Image, Single Product Image and Product Thumbnails, for full width and sidebar pages:<br /><br />
<em>FULL WIDTH PAGE</em>:<br />
Catalogue image - 219px x custom height<br />
Single Pr image - 294px x custom height<br />
Thumbnail image -  91px x custom height<br />
<br />
<em>SIDEBAR PAGE</em>:<br />
Catalogue image - 137px x custom height<br />
Single Pr image - 193px x custom height<br />
Thumbnail image -  59px x custom height<br />
<br />
<i>IMPORTANT NOTES:</i>&nbsp; The minimum size of featured image one should load is 550x550 due to the fact in some mobile viewports, on resizing (example tablets) the responsive layout will feature a larger Single Product Image then noted above. &nbsp;As long as the image ratio is respected, any size image can be loaded. &nbsp;If the image uploaded doe not respect the setting ratio, hard cropping of the image will occur.
<br /><br />
Since the theme lightbox function is used, one can go to the Lightbox tab and select from the Fancybox or default theme skin for the lightbox appearence. &nbsp;One can also enable lightbox thumbnails if so desired should one have a Product Gallery for a product.<br />
<br />
<b>2)</b> &nbsp;In the Edit Product Panel is a new metabox &#34;Image Display Options&#34; which provides some image effects for hover over the product image in the Shop page.
<br /><br />
<b>3)</b> &nbsp;When the WooCommerce setting is enabled below, one should investigate the:<br /><br /><ul><li><u>Advance Panel</u> -> Search Tab, the Custom Post Type Archive Featured Header Text Tab and Custom Taxonomy Featured Header Text Tab</li>
<li><u>Sidebar Panel</u> -> Custom Post Sidebar tab, Custom Post Type Archives Sidebar Tab & Custom Taxonomies Sidebar Tab</li></ul>
as upon activation of the plugin and the woocommerce activation setting, all of these tabs will contain new options for custom Woo headers and sidebars for various page and archive types on a global basis.  &nbsp;One can also create custom sidebars and assign them to individual product pages using the Custom Sidebar Setting in the Page General Options Metabox/General Page Setup tab found below the content editor in the Edit Product Panel.
<br /><br />
<b>4)</b> &nbsp;One can use all of the Page General Options settings to customize any individual Product post, and any of the default Woo Shop pages one auto created using the Woocommerce/Settings/Pages panel. &nbsp;As well, any autogenerated Shop type page, although it will automatically have a woo shortcode in it, will also accept any other content you add to it including theme shortcodes.
<br /><br />
<b>5)</b> &nbsp;Besides the ability to set global custom headers and sidebars, the feature header of any page can be customized using the Header Type setting in the Page General Options metabox, including slideshows.  &nbsp;Even the Self-Galley slideshow option works, but it is best used in a correctly sized slider by shortcode in the Custom Text Area Header Option.
<br /><br />
<b>6)</b> &nbsp;The theme modifies the Single Product Page layout to a cleaner look without shadows, full frames around images, a more modern look for tabs, and a different &#34;side-by-side&#34; layout for the product image/gallery and the accompanying short description and tabs. &nbsp;The Reviews tab layout is also modernized with full lightweight frame and the stars being given their traditional gold color vs the Woo default grayblack color.<br /><br />
The catalogue thumbnail layout has been similarly modified to a cleaner design.<br /><br />
<b>7)</b> &nbsp;MultiFlex has a new ecommerce product carousel, which can select individual products to display, with each image linking to the specific product. &nbsp;This provides an opportunity to provide a nice related product or featured product carousel on any single product post, or any other content desired. &nbsp;More then one product carousel can be inserted into any content.<br /><br />
<b>8)</b> &nbsp;Coding enabling parsing of custom breadcrumb functions from WP SEO onto Woo pages.<br /><br />
<b>9)</b> &nbsp;Added auto RTL support for Woo in Striking MultiFlex<br /><br />
<strong>Together the theme options and customizing abilities provide for unlimited ability to display varied content and appearence for a store built using Woo, with unique colors, backgrounds, sliders, and any particular content desired to reinforce the product story and sales process.<br /><br />Check out the theme support forum for the Woo section which ncludes a list of compatible woo plugins, most of which are known to work in the theme.</strong>", 'theme_admin'),
				"options" => array(
					array(
						'name' => __("Use Complex CSS Class - FOR WOO-COMMERCE PLUGIN USERS",'theme_admin'),
						'desc'=>__('<p>The purpose of this setting is to activate an alternative css file called screen_complex.css (found in the CSS folder) in Striking that amends the Striking theme classes to avoid class name conflict with Woo-Commerce as that plugin uses css classes that are traditionally used for theme builders, in their plugin.</p><p>The css classes covered include <code>button, code, pre, tabs, mini_tabs, pane, panes, tab, accordion, info, success, error, error_msg, notice, note, note_title, note_content</code> and each class is pre-pended with <em>theme</em> in order to amend the class name.&nbsp;&nbsp; <br>For example: <code>button</code> become <code>theme_button</code>.</p><p>This is the only purpose of this setting although Striking users have also indicated that in rare situations where another plugin is encroaching on traditional theme classes this setting has helped alleviate them.</p><p>Anytime one is using a more advanced plugin that includes many css settings for active styling, such as an ecommerce plugin, it is always a good idea to do a quick review of the css of both the theme and the plugin to see if the latter encroaches on theme css.&nbsp;&nbsp;One has always to remember that almost all plugins are designed for the default WP themes shipped with the wordpress core, which contain minimal css classes, not premium themes as robust as Striking, which contain much more advanced css, and so the potential for css (and js conflict if diff js and jquery versions are in use) becomes much greater.&nbsp;&nbsp;Striking is the framework to which the plugin is attempting to fit, so it is incumbent upon the plugin developer to write clean non-conflicting code, not the theme.&nbsp;&nbsp;Nonetheless, Striking goes the extra distance to try and bridge situations where this is not the case, and this setting is one such example.</p>','theme_admin'),
						"id" => "complex_class",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Activate Theme WooCommerce functions",'theme_admin'),
						"id" => "woocommerce",
						"desc"=>__("Enable this setting to declare WooCommerce compatibility and enable the theme Woo related settings.  &nbsp;VERY IMPORTANT: Please scroll to the General Tab above and enable the 'Use Complex CSS Class' setting as the Woo Plugin uses css styling and classes normally reserved for themebuilders, and so this setting activates an alternate group of css classes so that there are no theme/plugin styling clashes.",'theme_admin'),
						"process" =>"_option_woocommerce_process",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Activate Theme Spinners",'theme_admin'),
						"id" => "woocommerce_spinners",
						"desc"=>__('Enable this setting to activate the theme plus/minus quantity spinners. If disabled one can use the default woocommerce spinners that come with the plugin or the quantity spinner from the Woocommerce plugin : <a href="https://wordpress.org/plugins/woocommerce-quantity-increment/" target="_blank">Woocommerce Quantity Increment </a>.','theme_admin'),
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("WooCommerce Shop Pages Layout",'theme_admin'),
						"desc"=>__("Use this setting to determine whether your standard Woocommerce &#34;Shop&#34; type pages (Shop, Cart, Checkout, etc) in the site will have a full width, left sidebar or right sidebar layout.",'theme_admin'),
						"id" => "woocommerce_layout",
						"default" => 'right',
						"options" => array(
							"full" => __('Full Width','theme_admin'),
							"right" => __('Right Sidebar','theme_admin'),
							"left" => __('Left Sidebar','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("WooCommerce Product Page Layout",'theme_admin'),
						"desc"=>__("Use this setting to determine whether your standard Woocommerce single product pages in the site will have a full width, left sidebar or right sidebar layout.",'theme_admin'),
						"id" => "woocommerce_product_layout",
						"default" => 'right',
						"options" => array(
							"full" => __('Full Width','theme_admin'),
							"right" => __('Right Sidebar','theme_admin'),
							"left" => __('Left Sidebar','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("WooCommerce Product Page - Desciption/Reviews Tab Position",'theme_admin'),
						"desc"=>__("In the single product page, Woo has a set of tabs containing an expanded description, reviews, etc.  This setting provides the choice of having these tabs be placed full width below the product images/buttons or aside the images (they will still be underneatht the buttons/excerpt but more or less inline vertically). &nbsp;This setting is most useful if the single product page is set to full width, as it allows you to have a full width span for the tabs as well.",'theme_admin'),
						"id" => "woocommerce_desciption_Position",
						"default" => 'below',
						"options" => array(
							"below" => __('Below Images','theme_admin'),
							"aside" => __('Aside Images','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("WooCommerce Product Page Related Products",'theme_admin'),
						"desc"=>__("In the single product page, Woo has standard a related products grid. &nbsp;With this setting, you can turn that grid off or you can instead show the related products using the MultiFlex Product Carousel - which provides a more interesting visual experience to your site viewer.",'theme_admin'),
						"id" => "woocommerce_product_related",
						"default" => 'enable',
						"options" => array(
							"disable" => __('Disable','theme_admin'),
							"enable" => __('Enable','theme_admin'),
							"carousel" => __('Show as carousel','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Number of Related Products",'theme_admin'),
						"desc" => __("Number of Related Products to display.",'theme_admin'),
						"id" => "woocommerce_related_products_number",
						"min" => "0",
						"max" => "60",
						"step" => "1",
						"default" => "4",
						"type" => "range",
					),
					array(
						"name" => __("Cross sells & Cart Totals full width",'theme_admin'),
						"id" => "woocommerce_cross_sell_width",
						"desc"=>__("Enable this settings and the cross sell products will appear above the cart totals in the cart page otherwise they will be presented side by side.",'theme_admin'),
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Enable Feature Header For WooCommerce Archives Page",'theme_admin'),
						"desc" => __("<p>This tri-toggle has 3 setting positions.</p><p><b>Middle Position</b> - If left in the middle, this setting will default to the setting for diplaying the Striking featured header as per how it is set in the <b>Striking General Panel/General Page Layout Settings/Enable the Striking Feature Header Site Wide.</b> setting</p><p><b>On Position</b> - If one has globally set the Featured Header to <em>OFF</em> in the Striking General Panel sot that it does not display anywhere, and you want to show featured headers on Woo archive pages, then you should toggle this <b>Enable Feature Header For WooCommerce Archives Page</b> to <em>ON</em>.</p><p><b>Off Position</b> - If one has globally set the Featured Header to <em>ON</em> in the Striking General Panel so that it is displaying on site pages, and one do not want the featured headers to appear on Woo archive pages, then one should toggle this Enable Feature Header For WooCommerce Archives Page to <em>OFF</em>.</p><p>IMPORTANT NOTE - this setting only applies to Woo Archive type pages (these are autogenerated pages by wordpress) and not to regular Woo site pages such as Cart and My Account which use the Woo shortcode to determine what they display.&nbsp;&nbsp;Pages such as Cart are regular site type pages and one can manipulate the featured header display using the Striking Page General Option metabox settings just as one would for any other page in a site.",'theme_admin'),
						"id" => "woocommerce_introduce",
						"default" => '',
						"type" => "tritoggle",
					),
					array(
						"name" => __("Breadcrumbs For WooCommerce Archives Page",'theme_admin'),
						"desc" => __("<p>Striking has built into its core code the very well known <em>Breadcrumbs Plus</em> plugin -> so it is not necessary to load this plugin separately in order to obtain full breadcrumb ability in Striking.</p><p>This tri-toggle has 3 setting positions.</p><br /><p><b>Middle Position</b> - If left in the middle, this setting will default to the setting for diplaying the Striking breadcrumbs as per how it is set in the <b>Striking General Panel/General Page Layout Settings/Breadcrumbs Site Wide.</b> setting</p><p><b>On Position</b> - If one has globally set the breadcrumbs setting to <em>On</em> in the Striking General Panel so that they <u>display</u> everywhere, and you want to turn off breadcrumbs on Woo archive pages, then you should toggle this <b>Breadcrumbs For WooCommerce Archives Page</b> to <em>OFF</em>.</p><p><b>Off Position</b> - If one has globally set the breadcrumbs to <em>Off</em> in the Striking General Panel so <u>that they are turned off on site pages</u>, and one wants the breadcrumbs to appear on Woo archive pages, then one should toggle this Breadcrumbs For WooCommerce Archives Page to <em>ON</em> so that it counteracts the site wide setting.</p><p>IMPORTANT NOTE - this setting only applies to Woo Archive type pages (these are autogenerated pages by wordpress) and not to regular Woo site pages such as Cart and My Account which use the Woo shortcode to determine what they display.&nbsp;&nbsp;Pages such as Cart are regular site type pages and one can manipulate the breadcrumbs display using the Striking Page General Option metabox settings just as one would for any other page in a site. &nbsp;The breadcrumb placement in Striking is in the upper left hand corner of the page body section of all other pages and posts. &nbsp;&nbsp;Typically each navigation layer other then the present page is a clickable link in the breadcrumb string.</p>",'theme_admin'),
						"id" => "woocommerce_breadcrumb",
						"default" => '',
						"type" => "tritoggle"
					),
					array(
						"name" => __("WooCommerce Primary button Background Color",'theme_admin'),
						"desc" => "",
						"id" => "woocommerce_button_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("WooCommerce Primary button Text Color",'theme_admin'),
						"desc" => "",
						"id" => "woocommerce_button_text_color",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("WooCommerce Secondary button Background Color",'theme_admin'),
						"desc" => "",
						"id" => "woocommerce_button_secondary_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("WooCommerce Secondary button Text Color",'theme_admin'),
						"desc" => "",
						"id" => "woocommerce_button_secondary_text_color",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("WooCommerce Shop Sidebar",'theme_admin'),
						"desc" => sprintf(__("Select the custom sidebar that you'd like to be displayed on Shop page.<br />Note: you will need to <a href=\"%s\">create a custom sidebar</a> first.",'theme_admin'),admin_url( 'admin.php?page=theme_sidebar')),
						"id" => "woocommerce_shop_sidebar",
						"prompt" => __("Choose one..",'theme_admin'),
						"default" => '',
						"options" => theme_get_sidebar_options(),
						"type" => "select",
					),
					array(
						"name" => __("WooCommerce Product Sidebar",'theme_admin'),
						"desc" => __("Select the custom sidebar that you'd like to be displayed on Product page.",'theme_admin'),
						"id" => "woocommerce_product_sidebar",
						"prompt" => __("Choose one..",'theme_admin'),
						"default" => '',
						"options" => theme_get_sidebar_options(),
						"type" => "select",
					),
					array(
						"name" => __("WooCommerce Product Category Sidebar",'theme_admin'),
						"desc" => __("Select the custom sidebar that you'd like to be displayed on Product Category page.",'theme_admin'),
						"id" => "woocommerce_cat_sidebar",
						"prompt" => __("Choose one..",'theme_admin'),
						"default" => '',
						"options" => theme_get_sidebar_options(),
						"type" => "select",
					),
					array(
						"name" => __("WooCommerce Product Tag Sidebar",'theme_admin'),
						"desc" => __("Select the custom sidebar that you'd like to be displayed on Product Tag page.",'theme_admin'),
						"id" => "woocommerce_tag_sidebar",
						"prompt" => __("Choose one..",'theme_admin'),
						"default" => '',
						"options" => theme_get_sidebar_options(),
						"type" => "select",
					),
				),
			),
			array(
				"slug" => 'BBPress',
				"name" => __("BBPress Options",'theme_admin'),
				"desc" => __("<p>Striking MultiFlex provides some customization for bbpress which extends the bbpress plugin:</p>
<p><u><em>THE bbPress FORUM LISTING PAGE</em></u>:<br />
- The listing page can now have a sidebar layout or be full width<br />
- It can be assigned a custom sidebar<br />
- Feature header area can have custom content<br />
- custom content can be inserted into the page body before or after the forums list, and this content can be set to show only on the listing page, or on all forum pages.</p>
<p><u><em>INDIVIDUAL FORUM PAGES (whether forum or category type)</em></u>:<br />
- the MultiFlex Page General Options Metabox can be active now on the Edit Forum panel, allowing for all the individual post customization a Striking user has always enjoyed, on a bbpress forum page.<br />
- This includes control over page layout, feature header content, breadcrumbs, footer/subfooter, custom sidebars, all page colors, backgrounds, page specific CSS and JS and more.</p>
<p><u><em>BREADCRUMBS</em></u>:<br />
- a very annoying facet of bbpress is that it inserts its own breadcrumbs string into the forum pages, which are not editable.  You can now turn the plugin breadcrumbs off defaulting to the theme breadcrumbs style. &nbsp;Either way the duplicate breadcrumbs issue that is often reported on the web when users have bbpress installed in a theme that supports breadcrumbs is eliminated in Striking MultiFlex.</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __(" Change the BBPress Listing Page Layout",'theme_admin'),
						"desc" => __("<p>By default, the bbPress listing page, which contains a master list of all forums on the site,  is full width and not adjustable to any other layout. &nbsp;This custom theme setting allows a choice of layout for the bbPress Listing Page instead of being restricted to only the default full width layout of the plugin.</p><p>If you set it to a sidebar, by default the bbPress listing page shows the Blog Widget Area sidebar (as bbpress is a custom post type plugin).  &nbsp;But in MultiFlex, you can create a custom sidebar in the Sidebar Panel, and assign it to the listing page. After creating the custom sidebar, while in the Sidebar Panel go to the <b>Custom Post Type Archives Sidebar</b> tab, and use the <b>Forums's Archive Page Sidebar</b> setting to assign the sidebar (the Forums Archive Page = the listing page).</p><p><b>TIP:</b> &nbsp;&nbsp;Although the listing page is an slug and thus not an editable page, you can create a custom feature header title and content, using <b>Forum Archives Title and Forum Archives Text</b> settings found in the <b>Custom Post Type Archive Featured Header Text</b> admin tab which is part of this Advanced Panel. &nbsp;Please be aware that this admin tab only shows up once the plugin is active -> the theme autodetects the custom post categories and taxonomies, and creates a new admin tab with settings allowing you to edit, but if the plugin is not active, there is nothing to detect and so no admin tab will show!!",'theme_admin'),
						"id" => "bbpress_layout",
						"default" => 'full',
						"options" => array(
							"full" => __('Full Width','theme_admin'),
							"right" => __('Right Sidebar','theme_admin'),
							"left" => __('Left Sidebar','theme_admin'),
						),
						"type" => "select",
					),
					array(
						'name' => __("BBPress Breadcrumbs",'theme_admin'),
						'desc'=>__('<p>Turn ON/OFF the bbpress breadcrumbs. Turning it ON turns OFF the striking breadcrumbs automatically in all BBPress pages.</p>','theme_admin'),
						"id" => "bbpress_breadcrumbs",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Info Panel Before BBpress Content ",'theme_admin'),
						"desc" => __("The panel below is where you create content for the Bbpress listing page before the Topic List. It accepts all html and shortcodes.",'theme_admin'),
						"id" => "bbpress_info_before",
						"default" => "",
						"type" => "editor",
						"settings" => array(),
					),
					array(
						"name" => __("Info Panel After BBPress Content",'theme_admin'),
						"desc" => __("The panel below is where you create content for the Bbpress listing page after the Topic List. It accepts all html and shortcodes.",'theme_admin'),
						"id" => "bbpress_info_after",
						"default" => "",
						"type" => "editor",
						"settings" => array(),
					),	
					array(
						'name' => __("Before Info Panel On All Pages",'theme_admin'),
						'desc'=>__('<p>Turn ON/OFF the Before Info Panel on all BBPress pages.</p>','theme_admin'),
						"id" => "bbpress_info_before_all",
						"default" => false,
						"type" => "toggle"
					),
					array(
						'name' => __("After Info Panel On All Pages",'theme_admin'),
						'desc'=>__('<p>Turn ON/OFF the After Info Panel on all BBPress pages.</p>','theme_admin'),
						"id" => "bbpress_info_after_all",
						"default" => false,
						"type" => "toggle"
					),
				),
			),
			array(
				"slug" => 'lightbox',
				"name" => __("Global Lightbox Settings", 'theme_admin'),
				"desc" => __("<p>Striking
				 MultiFlex uses the Fancybox script for implementing the lightbox ability in the theme. &nbsp;The settings below are all optional to adjust, for when one desires to customize the aspects of lightbox in MultiFlex.</p>
<p>The settings allow one to to choose the style of the lightbox, the size, the placement of the caption, thumbnails, navigation cues, and much more. &nbsp;MultiFlex supports a very wide array of the fancybox options, and you are encouraged to experiment (patience is advised!) as your comfort level with image functionality progresses. &nbsp;Some of the settings also have individual overrides in either a shortcode, or a metabox.</p>
<p>2 important settings to bring to your attention:<br /><br />
<b>A)</b> &nbsp;There is a setting to turn off the lightbox script completely if one is implementing an alternative script.<br /><br />
<b>B)</b> &nbsp;Another setting <b>Fit To View</b> when toggled OFF will allow all images to show full size when displayed in the lightbox. &nbsp;See the setting for more information.</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Disable Striking Lightbox Script - aka Fancybox",'theme_admin'),
						"desc" => __("<p>If you enable this option, the lightbox script in Striking MultiFlex - known as Fancybox, will be disabled and the default lightbox functions in Striking will not work.&nbsp;&nbsp;Normally, this setting would be used by someone either using an alternative lightbox plugin and experiencing some lightbox script conflicts or through use of a child theme with custom php or lightbox scripts.</p><p>If examining a plugin for lightbox ability, check to see what lightbox script it is using - many use fancybox, and MultiFlex already incorporates almost every fancybox option and ability, so the plugin will likely not provide any benefit, other then the potential for conflict due to duplicate scripts attempting to operate when a function is called</p>.",'theme_admin'),
						"id" => "no_fancybox",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Fancybox Skin",'theme_admin'),
						"desc" => __("<p>The &#34;Skin&#34; is simply the appearence of the border and caption section of the lightbox.  &nbsp;There are two options, the custom theme skin (a square lightbox with a thin white border and a lightgray caption background with white text), and the standard Fancybox skin (rounded corners with a thick white border, and a dark caption background with white caption text. &nbsp;The default skin is the custom theme skin.</p>",'theme_admin'),
						"id" => "fancybox_skin",
						"default" => "theme",
						"options" => array(
							'theme' => __("Theme",'theme_admin'),
							'fancybox' => __("Fancybox", 'theme_admin')
						),
						"type" => "select"
					),
					array(
						"name" => __("Fancybox Caption Option",'theme_admin'),
						"desc" => __("<p>This setting is for choosing the location of the lighbox caption. &nbsp;The theme default is the classic float appearence where the caption appears in a ballon field below the lightbox.  &nbsp;The other three options are all Fancybox generated: &#34;Inside&#34; places the caption within the white border at the bottom of the image, &#34;Outside&#34;places the caption outside the lightbox with no background to the text, and &#34;Over&#34; lays the caption over the bottom portion of the image. &nbsp;The 3 Fancybox generated captions are all left aligned by default.</p>",'theme_admin'),
						"id" => "fancybox_title_type",
						"default" => "float",
						"options" => array(
							'float' => __("Float",'theme_admin'),
							'inside' => __("Inside",'theme_admin'),
							'outside' => __("Outside",'theme_admin'),
							'over' => __("Over", 'theme_admin')
						),
						"type" => "select"
					),
					array(
						"name" => __("Fit To View",'theme_admin'),
						"desc" => __("<p>The purpose of this setting is resize the lightbox to fit inside viewport before opening. &nbsp;This means that the lightbox is always constrained by the viewport and so large images will not show in their full size. &nbsp;Almost all image related shortcodes possess an override so that for any individual instance, the content of the lightbox can display in full size. </p><p><b>NOTE:</b> &nbsp;&nbsp;this setting works in isolation of the various size settings below. &nbsp;An example is that if one has set the default lightbox size to 800 x 800, but the viewer is on a phone, and the actual image size is 1000 x 1000, and the Fit To View is Off, then the lighbox will exceed the phone screen size and scrolling will be necessary, irrespective of any other setting below. &nbsp;In summary, when Fit to View is toggled OFF, whether globally, or using the override in a specific instance, then the lightbox will always show the content in its full size.</p>",'theme_admin'),
						"id" => "fancybox_fitToView",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Fancybox Width",'theme_admin'),
						"desc" => __("<p>Default width for 'iframe' and 'swf' content in the website. &nbsp;Most shortcodes and some metabox post settings for individual post types contain an ability to customize on a case by case basis.</p>",'theme_admin'),
						"id" => "fancybox_width",
						"min" => "50",
						"max" => "1600",
						"step" => "1",
						"unit" => 'px',
						"default" => "800",
						"type" => "range"
					),
					array(
						"name" => __("Fancybox Height",'theme_admin'),
						"desc" => __("<p>Default width for 'iframe' and 'swf' content. &nbsp;Most shortcodes and some metabox post settings for individual post types contain an ability to customize on a case by case basis.</p> ",'theme_admin'),
						"id" => "fancybox_height",
						"min" => "50",
						"max" => "1600",
						"step" => "1",
						"unit" => 'px',
						"default" => "600",
						"type" => "range"
					),
					array(
						"name" => __("Fancybox AutoSize",'theme_admin'),
						"desc" => __("If you enable this option, then sets both autoHeight and autoWidth to true.",'theme_admin'),
						"id" => "fancybox_autoSize",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Fancybox AutoHeight",'theme_admin'),
						"desc" => __("If you enable this option, for 'inline', 'ajax' and 'html' type content width is auto determined. &nbsp;If no dimensions set this may give unexpected results.",'theme_admin'),
						"id" => "fancybox_autoHeight",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Fancybox AutoWidth",'theme_admin'),
						"desc" => __("If you enable this option, for 'inline', 'ajax' and 'html' type content height is auto determined. &nbsp;If no dimensions set this may give unexpected results.",'theme_admin'),
						"id" => "fancybox_autoWidth",
						"default" => false,
						"type" => "toggle"
					),
					// array(
					// 	"name" => __("Fit To View only for small screen",'theme_admin'),
					// 	"desc" => __("If you enable this option, fancyBox fit to view option will only works for the viewport that is smaller then 980",'theme_admin'),
					// 	"id" => "fancybox_fitToView_mode",
					// 	"default" => false,
					// 	"type" => "toggle"
					// ),
					array(
						"name" => __("Fancybox Aspect Ratio",'theme_admin'),
						"desc" => __("If you enable this option, resizing is constrained by the original aspect ratio (images always keep ratio).",'theme_admin'),
						"id" => "fancybox_aspectRatio",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Fancybox Navigation",'theme_admin'),
						"desc" => __("If you enable this option, navigation arrows will be displayed.",'theme_admin'),
						"id" => "fancybox_arrows",
						"default" => true,
						"type" => "toggle"
					),
					array (
						"name" => __("Fancybox Display Close Button",'theme_admin'),
						"desc" => __("If you enable this option, close button will be displayed.",'theme_admin'),
						"id" => "fancybox_closeBtn",
						"default" => true,
						"type" => "toggle"
					),
					array (
						"name" => __("Fancybox close Click",'theme_admin'),
						"desc" => __("If you enable this option, fancyBox will be closed when user clicks the content.",'theme_admin'),
						"id" => "fancybox_closeClick",
						"default" => false,
						"type" => "toggle"
					),
					array (
						"name" => __("Fancybox next Click",'theme_admin'),
						"desc" => __("If you enable this option, will navigate to next gallery item when user clicks the content.",'theme_admin'),
						"id" => "fancybox_nextClick",
						"default" => false,
						"type" => "toggle"
					),
					array (
						"name" => __("Fancybox autoPlay",'theme_admin'),
						"desc" => __("If you enable this option, slideshow will start after opening the first gallery item.",'theme_admin'),
						"id" => "fancybox_autoPlay",
						"default" => false,
						"type" => "toggle"
					),
					array (
						"name" => __("Fancybox playSpeed",'theme_admin'),
						"desc" => __("Slideshow speed in milliseconds.",'theme_admin'),
						"id" => "fancybox_playSpeed",
						"default" => '3000',
						"min" => "0",
						"max" => "10000",
						"step" => "200",
						"unit" => 'ms',
						"type" => "range"
					),
					array (
						"name" => __("Fancybox preload",'theme_admin'),
						"desc" => __("Number of gallery images to preload.",'theme_admin'),
						"id" => "fancybox_preload",
						"default" => '3',
						"min" => "0",
						"max" => "20",
						"step" => "1",
						"type" => "range"
					),
					array (
						"name" => __("Fancybox loop",'theme_admin'),
						"desc" => __("If you enable this option, it enables cyclic navigation. This means, if you click 'next' after you reach the last element, first element will be displayed (and vice versa).",'theme_admin'),
						"id" => "fancybox_loop",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Display Lightbox Thumbnails",'theme_admin'),
						"desc" => __("If you enable this option, fancyBox will show a thumbnail bar if it's gallery view.",'theme_admin'),
						"id" => "fancybox_thumbnail",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Lightbox Thumbnail Width",'theme_admin'),
						"desc" => __("The width for fancybox thumbnail item.",'theme_admin'),
						"id" => "fancybox_thumbnail_width",
						"min" => "10",
						"max" => "300",
						"step" => "1",
						"unit" => 'px',
						"default" => "50",
						"type" => "range"
					),
					array(
						"name" => __("Lightbox Thumbnail Height",'theme_admin'),
						"desc" => __("The height for fancybox thumbnail item.",'theme_admin'),
						"id" => "fancybox_thumbnail_height",
						"min" => "10",
						"max" => "300",
						"step" => "1",
						"unit" => 'px',
						"default" => "50",
						"type" => "range"
					),
					array(
						"name" => __("Lightbox Thumbnail Position",'theme_admin'),
						"id" => "fancybox_thumbnail_position",
						"default" => "bottom",
						"options" => array(
							'top' => __("Top",'theme_admin'),
							'bottom' => __("Bottom", 'theme_admin')
						),
						"type" => "select"
					),
				),
			),
			array(
				"slug" => 'twitter',
				"name" => __("Twitter Widget Setup",'theme_admin'),
				"desc" => __("Striking MultiFlex includes a Twitter widget in the widget panel. &nbsp;However, for the widget to actually display tweets Twitter has now (June 2013) made it necessary to go through an authentication process. &nbsp;This page at twitter: <a href='https://dev.twitter.com/docs/auth/tokens-devtwittercom' target='_blank'>Twitter Instructions for for creating tokens</a> has a walkthrough of the process from Twitter. &nbsp;We have created a much more comprehensive (and understandable) walkthrough in the following thread at the forum: <a href='http://kaptinlin.com/support/discussion/8807/twitter-widget-tutorial' target='_blank'>Striking Twitter Tutorial</a> which details step by step the process of creating the twitter authentications necessary to import into the below fields so that your tweets can be displayed in the website using the included widget.<br /><br /><em>NOTES</EM> -&nbsp;&nbsp;At this time it is only possible to display a timeline of tweets from one&#180;s own account using the Striking Twitter function.", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Consumer Key",'theme_admin'),
						"id" => "twitter_consumerKey",
						"default" => "",
						"size" => "60",
						"type" => "text"
					),
					array(
						"name" => __("Consumer Secret",'theme_admin'),
						"id" => "twitter_consumerSecret",
						"default" => "",
						"size" => "60",
						"type" => "text"
					),
					array(
						"name" => __("Access Token",'theme_admin'),
						"id" => "twitter_accessToken",
						"default" => "",
						"size" => "60",
						"type" => "text"
					),
					array(
						"name" => __("Access Token Secret",'theme_admin'),
						"id" => "twitter_accessTokenSecret",
						"default" => "",
						"size" => "60",
						"type" => "text"
					),
				)
			),
			array(
				"slug" => '404',
				"name" => __("404 Page Options",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Layout",'theme_admin'),
						"desc" => "",
						"id" => "404_layout",
						"default" => 'default',
						"options" => array(
							"default" => __('Default','theme_admin'),
							"full" => __('Full Width','theme_admin'),
							"right" => __('Right Sidebar','theme_admin'),
							"left" => __('Left Sidebar','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Choose a Custom Sidebar",'theme_admin'),
						"desc" => __("MultiFlex has a default search sidebar which contains a search widget in it. &nbsp;However, you can create a custom sidebar in the Sidebar Panel, place in it (in the Widget Panel), and then assign the sidebar to the 404 page using this setting - the custom sidebars will show in the dropdown list below once they have been created in the Sidebar Panel.",'theme_admin'),
						"id" => "404_sidebar",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("Default",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("404 Page Feature Header Title",'theme_admin'),
						"desc" => '',
						"id" => "404_title",
						"default" => __('404 - Not Found','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("404 Page Feature Header Text",'theme_admin'),
						"id" => "404_text",
						"default" => __("Looks like the page you're looking for isn't here anymore. Try using the search box or sitemap below.",'striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("404 Page Sitemap Items",'theme_admin'),
						"desc" => "",
						"id" => "404_items",
						"default" => array('pages','categories','posts'),
						"options" => array(
							'pages'=>__('Pages','theme_admin'),
							'categories'=>__('Category Archives','theme_admin'),
							'tags'=>__('Tags Archives','theme_admin'),
							'posts'=>__('Blog Posts','theme_admin'),
						),
						'enable_text' => __('Enabled','theme_admin'),
						'disable_text' => __('Disabled','theme_admin'),
						"type" => "ddmultiselect"
					),
					array(
						"name" => __("404 Page Content",'theme_admin'),
						"id" => "404_content",
						"default" => '',
						'rows' => '4',
						"type" => "textarea"
					),
				),
			),
			array(
				"slug" => 'search',
				"name" => __("Site Search Options",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Layout",'theme_admin'),
						"desc" => "",
						"id" => "search_layout",
						"default" => 'right',
						"options" => array(
							"default" => __('Default','theme_admin'),
							"full" => __('Full Width','theme_admin'),
							"right" => __('Right Sidebar','theme_admin'),
							"left" => __('Left Sidebar','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Sidebar",'theme_admin'),
						"id" => "search_sidebar",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("Choose Custom Sidebar",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("Display Full Blog Posts",'theme_admin'),
						"desc" => __("This option determinate whether to display full blog posts in search result page.",'theme_admin'),
						"id" => "search_display_full",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Search Page Title",'theme_admin'),
						"desc" => '',
						"id" => "search_title",
						"default" => __('Search','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Search Page Text",'theme_admin'),
						"desc" => "Default: <code>Search Results for: '%s'</code><br> <code>%s</code> will be replaced with the search text.",
						"id" => "search_text",
						"default" => __("Search Results for: '%s'",'striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("Nothing Found Text",'theme_admin'),
						"desc" => 'eg: <code>Nothing found matching the searchcriteria.</code>. ',
						"id" => "search_nothing_found",
						"default" => '',
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("Exclude From Search",'theme_admin'),
						"desc" => __("This setting can be used to exclude one of the post types noted below from the results of a search using a search widget",'theme_admin'),
						"id" => "exclude_from_search",
						"default" => array(),
						"target" => 'public_post_types',
						"type" => "checkboxes",
					),
				),
			),
			array(
				"slug" => 'header_text',
				"name" => __("Archive Feature Header Content",'theme_admin'),
				"desc" => __("<p>Striking MultiFlex supports the generation of wordpress archives. &nbsp;This means that Multiflex supports the display of archive pages for blog filters such as by category, tag, date, and taxonomy. &nbsp;Automatically, WP would just generate a title at the top of the page (in the Feature Header) of an archive page. &nbsp;However, MultiFlex gives you the ability to instead customize the title and descriptive content appearing in the feature header. &nbsp;Both fields support simple html tags, and and the Text field also supports MultiFlex shortcodes.</p>
<p><b>HINT:</b> &nbsp;&nbsp;Combining the options below with the ability to assign each archive a custom sidebar (settings for this are found in the Sidebar Panel) will allow each website to provide for targeted and customized content by archive type.</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Category Archive Title",'theme_admin'),
						"desc" => '',
						"id" => "category_title",
						"default" => __('Archives','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Category Archive Text",'theme_admin'),
						"desc" => "Default: <code>Category Archive for: '%s'</code><br> <code>%s</code> will be replaced with the category name.",
						"id" => "category_text",
						"default" => __("Category Archive for: '%s'",'striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("Tag Archive Title",'theme_admin'),
						"desc" => '',
						"id" => "tag_title",
						"default" => __('Archives','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Tag Archive Text",'theme_admin'),
						"desc" => "Default: <code>Tag Archive for: '%s'</code><br> <code>%s</code> will be replaced with the tag name.",
						"id" => "tag_text",
						"default" => __("Tag Archive for: '%s'",'striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("Daily Archive Title",'theme_admin'),
						"desc" => '',
						"id" => "daily_title",
						"default" => __('Archives','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Daily Archive Text",'theme_admin'),
						"desc" => "Default: <code>Daily Archive for: '%s'</code><br> <code>%s</code> will be replaced with the day number.",
						"id" => "daily_text",
						"default" => __("Daily Archive for: '%s'",'striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("Monthly Archive Title",'theme_admin'),
						"desc" => '',
						"id" => "monthly_title",
						"default" => __('Archives','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Monthly Archive Text",'theme_admin'),
						"desc" => "Default: <code>Monthly Archive for: '%s'</code><br> <code>%s</code> will be replaced with the month number.",
						"id" => "monthly_text",
						"default" => __("Monthly Archive for: '%s'",'striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("Weekly Archive Title",'theme_admin'),
						"desc" => '',
						"id" => "weekly_title",
						"default" => __('Archives','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Weekly Archive Text",'theme_admin'),
						"desc" => "Default: <code>Weekly Archive for: '%s'</code><br> <code>%s</code> will be replaced with the year number.",
						"id" => "weekly_text",
						"default" => __("Weekly Archive for: '%s'",'striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("Yearly Archive Title",'theme_admin'),
						"desc" => '',
						"id" => "yearly_title",
						"default" => __('Archives','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Yearly Archive Text",'theme_admin'),
						"desc" => "Default: <code>Yearly Archive for: '%s'</code><br> <code>%s</code> will be replaced with the year number.",
						"id" => "yearly_text",
						"default" => __("Yearly Archive for: '%s'",'striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("Author Archive Title",'theme_admin'),
						"desc" => '',
						"id" => "author_title",
						"default" => __('Archives','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Author Archive Text",'theme_admin'),
						"desc" => "Default: <code>Author Archive for: '%s'</code><br> <code>%s</code> will be replaced with the author name.",
						"id" => "author_text",
						"default" => __("Author Archive for: '%s'",'striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("Blog Archives Title",'theme_admin'),
						"desc" => '',
						"id" => "blog_title",
						"default" => __('Archives','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Blog Archive Text",'theme_admin'),
						"desc" => 'Default: <code>Blog Archives</code>',
						"id" => "blog_text",
						"default" => __('Blog Archives','striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
					array(
						"name" => __("Taxonomy Archives Title",'theme_admin'),
						"desc" => '',
						"id" => "taxonomy_title",
						"default" => __('Archives','striking-r'),
						"size" => 50,
						"type" => "text"
					),
					array(
						"name" => __("Taxonomy Archive Text",'theme_admin'),
						"desc" => "Default: <code>Archive for: '%s'</code><br> <code>%s</code> will be replaced with the taxonomy name.",
						"id" => "taxonomy_text",
						"default" => __("Archive for: '%s'",'striking-r'),
						'rows' => '2',
						"type" => "textarea"
					),
				),
			),
		);
		if(function_exists('is_post_type_archive')){
			$archives = get_post_types(array(
			  'public'   => true,
			  '_builtin' => false,
			  'show_ui'=> true,
			),'objects');
			if ($archives) {
				if(array_key_exists('portfolio',$archives)){
					unset($archives['portfolio']);
				}
				if(!empty($archives)){
					$tab = array(
						"slug" => "custom_header_text",
						"name" => "Custom Post Type Archive Featured Header Text",
						"options" => array(),
					);
					foreach ($archives  as $archive ) {
						if($archive->name != 'portfolio'){
							$tab['options'][] = array(
								"name" => sprintf(__("%s Archives Title",'theme_admin'),$archive->labels->name),
								"desc" => '',
								"id" => "archive_".$archive->name."_title",
								"default" => __('Archives','striking-r'),
								"size" => 50,
								"type" => "text"
							);
							$tab['options'][] = array(
								"name" => sprintf(__("%s Archives Text",'theme_admin'),$archive->labels->name),
								"desc" => "Default: <code>Archives for: '%s'</code><br> <code>%s</code> will be replaced with the post type name.",
								"id" => "archive_".$archive->name."_text",
								"default" => __("Archives for: '%s'",'striking-r'),
								'rows' => '2',
								"type" => "textarea"
							);
						}
					}
					$options[] = $tab;
				}
			}
		}
		$taxonomies=get_taxonomies(array(
			'public'   => true,
			'_builtin' => false,
			'show_ui'=> true,
		),'objects'); 
		if ($taxonomies && !empty($taxonomies)) {
			$tab = array(
				"slug" => "custom_tax_header_text",
				"name" => "Custom Taxonomy Featured Header Text",
				"options" => array(),
			);
			foreach ($taxonomies  as $taxonomy ) {
				$tab['options'][] = array(
					"name" => sprintf(__("%s Archives Title",'theme_admin'),$taxonomy->labels->name),
					"desc" => '',
					"id" => "taxonomy_".$taxonomy->name."_title",
					"default" => __('Archives','striking-r'),
					"size" => 50,
					"type" => "text"
				);
				$tab['options'][] = array(
					"name" => sprintf(__("%s Archives Text",'theme_admin'),$taxonomy->labels->name),
					"desc" => __("Default: <code>Archives for: '%s'</code><br> <code>%s</code> will be replaced with the taxonomy name.",'theme_admin'),
					"id" => "taxonomy_".$taxonomy->name."_text",
					"default" => __("Archives for: '%s'",'striking-r'),
					'rows' => '2',
					"type" => "textarea"
				);
			}
			$options[] = $tab;
		}
		$options = array_merge($options , array(
			array(
				"slug" => 'metabox',
				"name" => __("Post Type Metabox Setting",'theme_admin'),
				"desc" => __("<p>The Page General Options Metabox is one of the most important features of Striking MultiFlex, and to the best of our knowledge a unique feature in the wordpress world.  &nbsp;Containing 30 settings, it provides the user the ability to customize most page level aspects of webpage display on a post by post basis.</p><p>Typically most other themes lock the theme level appearence settings across the website, but this metabox allows for every page in a website to express a unique appearence if desired, or accomodate any specific design imperative for a particular webpage. &nbsp;It is automatically enabled for all post types, including custom post types if an ecommerce or gallery plugin is active, other then the slideshow type post (which has no individual post page for viewing). </p><p>Given the power of this metabox, we normally recommend it be enabled for every other edit panel.</p>",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Page General Options",'theme_admin'),
						"id" => "page_general",
						"default" => array('post','page','portfolio','product'),
						"target" => 'post_types',
						"type" => "checkboxes",
					),
					array(
						"name" => __("Post Single Options",'theme_admin'),
						"id" => "post_single",
						"default" => array('post'),
						"target" => 'public_custom_post_types',
						"type" => "checkboxes",
					),
				),
			),
			array(
				"slug" => 'import_export',
				"name" => __("Save or Import Theme Settings",'theme_admin'),
				"options" => array(
					array(
						"name" => sprintf(__("Import %s Options Data",'theme_admin'),THEME_NAME),
						"id" => "import",
						"desc" => __('To import the values of your theme options copy and paste what appears to be a random string of alpha numeric characters into this textarea and press the "Save Changes" button below.','theme_admin'),
						"function" => "_option_import_function",
						"process" => "_option_import_process",
						"type" => "custom"
					),
					array(
						"name" => sprintf(__("Export %s Options Data",'theme_admin'),THEME_NAME),
						"id" => "export",
						"desc" => __("Export your saved Theme Options data by highlighting this text and doing a copy/paste into a blank .txt file.",'theme_admin'),
						"function" => "_option_export_function",
						"process" => "_option_export_process",
						"type" => "custom"
					),
				),
			),
		));
		

		return $options;
	}
	function _option_install_dummy_data_function($value, $default) {
		$nonce = wp_create_nonce('install-demo-'.THEME_SLUG);

		echo <<<HTML
	<div class="theme-option-content">
	<a class="button" href="#" id="install_button">Install demo data</a>
	<span class="install-demo-response"></span>
	</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#install_button').on('click',function() {
		var check = confirm("Are you sure installing demo data?  Please be aware that the demo data comprises a significant amount of content, and we suggest this demo data be installed in a local host (ie home or work computer using wamp or mamp) not in the online site.");
		if (check==false){
			return false;
		}
		var button = this;
		if (jQuery(this).hasClass('is_disabled')) {
			return false;
		}
		var loading = $('<span class="theme-install-loading">loading</span>').insertAfter(button);
		var demo_type=document.getElementById("demotype");
		var demotype= demo_type.options[demo_type.selectedIndex].value;
		$.post(ajaxurl, {
			action: 'theme-install-demo-data',
			type: demotype,
			nonce: '{$nonce}'
		}, function(response) {
			jQuery('.install-demo-response').html('').hide();
			jQuery('.install-demo-response').append(response);
			loading.remove();
			$('<span class="theme-install-done">done!</span>').insertAfter(button);
		});

		return false; 	
	});
});
</script>
HTML;
	}
	function _option_update_theme_function($value, $default) {
		require_once (THEME_ADMIN_FUNCTIONS . '/upgrade.php');

		$has_update =  upgradeHelper::check();
		$url = 'update-core.php?action='.THEME_SLUG.'_theme_update';
		$url = wp_nonce_url($url, 'upgrade-'.THEME_SLUG);
		$url = network_admin_url($url);
		$theme = THEME_SLUG;
		$package = upgradeHelper::getPackage();
		$updateInfo = upgradeHelper::getUpdateInfo();
		if($has_update){
			wp_print_scripts('jquery-download');
			global $wp_version;
			$referer = home_url();
			if(theme_get_option('advanced','item_purchase_code')==''){
				$is_purchase_code_empty = 'true';
			}else{
				$is_purchase_code_empty = 'false';
			}
			echo <<<HTML
	<div class="theme-option-content">
	<span id="update"></span>
	<a class="button-primary" id="upgrade_button" href="{$url}">Upgrade to version {$has_update}</a>
	<a class="button" href="#" id="nightly_build_download">Download nightly build</a>
	<a href="{$updateInfo}" target="_blank">View Changes</a>
	<script type="text/javascript">
		document.getElementById('upgrade_button').onclick = function(){
			if({$is_purchase_code_empty}){
				alert('Please enter your purchase code, then click "Save Changes" button.');
				return false;
			}else{
				return confirm("Are you sure you want to upgrade your {$theme} to version {$has_update}?\\nMake sure backup your files if you had made change on the theme files.");
			}
		};

		jQuery(document).ready(function(){
			jQuery('#nightly_build_download').click(function(){
				jQuery.download('{$package}','wp_version={$wp_version}&referer={$referer}','post');
				return false;
			})

		});
	</script>
	</div>
HTML;
		} else {
			$url = admin_url( 'admin.php?page=theme_advanced&tab=update&check=true#update');
			echo  <<<HTML
		<div class="theme-option-content">
You are using the latest version. 
	<a class="button" href="{$url}">Check for updates</a>
	<span id="update"></span>
	</div>
HTML;
		}
	}
	function _option_clear_cache_process($option,$data) {
		if($data == true){
			theme_check_image_folder();
			theme_clear_cache();
		}
		return false;
	}
	
	function _option_updating_portfolio_more_process($option,$data){
		if($data == true){
			$entries = get_posts('post_type=portfolio&meta_key=_more&meta_value=-1');
			foreach($entries as $entry) {
				update_post_meta($entry->ID, '_more', 'false');
			}
			
			$entries = get_posts('post_type=portfolio&meta_key=_more&meta_value=true');
			foreach($entries as $entry) {
				update_post_meta($entry->ID, '_more', '');
			}
		}
		return false;
	}
	
	function _option_updating_disable_breadcrumbs_process($option,$data){
		if($data == true){
			$entries = get_posts('meta_key=_disable_breadcrumb&meta_value=-1');
			foreach($entries as $entry) {
				update_post_meta($entry->ID, '_disable_breadcrumb', '');
			}
		}
		return false;
	}

	function _option_reset_options_process($option,$data) {
		if(is_array($data)){
			foreach($data as $page){
				delete_option( 'theme_' . $page);
			}
			if(in_array('advanced', $data)){
				return true;
			}
		}

		return false;
	}

	function _option_import_function($value, $default) {
		$rows = isset($value['rows']) ? $value['rows'] : '5';
		echo '<div class="theme-option-content">';
		echo '<textarea id="'.$value['id'].'" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '">';
		echo $default;
		echo '</textarea>';
		echo '</div>';
	}

	function _option_export_function($value, $default) {
		global $theme_options;
		$rows = isset($value['rows']) ? $value['rows'] : '5';
		echo '<div class="theme-option-content">';
		echo '<textarea id="'.$value['id'].'" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '">';
		echo base64_encode(serialize($theme_options));
		echo '</textarea>';
		echo '</div>';
	}

	function _option_export_process($option,$data) {
		return '';
	}

	function _option_import_process($option,$data) {
		if($data != ''){
			
			$options_array = unserialize( base64_decode( $data ) );
			if(is_array($options_array)){
				foreach($options_array as $name => $options){
					update_option('theme_' . $name, $options);
				}
			}
		}
		return '';
	}

	function _option_woocommerce_process($option,$data) {
		if(theme_get_option('advanced','woocommerce') == false && $data == true){
			global $theme_options;
			if(isset($theme_options['advanced']['page_general']) && !in_array('product', $theme_options['advanced']['page_general'])){
				if(isset($_POST['page_general']) && is_array($_POST['page_general']) && !in_array('product', $_POST['page_general'])){
					$_POST['page_general'][] = 'product';
				}
			}
		}
		return $data;
	}
}
