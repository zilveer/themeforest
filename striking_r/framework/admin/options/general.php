<?php
class Theme_Options_Page_General extends Theme_Options_Page_With_Tabs {
	public $slug = 'general';

	function __construct(){
		$this -> name = __('General Settings','theme_admin');
		parent::__construct();
	}
	
	function tabs(){
		return array(
			array(
				"slug" => 'header',
				"name" => __("General Header Settings",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Header Height",'theme_admin'),
						"desc" => sprintf(__('<p>The Header area is the very top portion of each webpage and initally contains the <strong>Site Title</strong> and <strong>Tagline</strong> which are defined in <a href="%s/wp-admin/options-general.php" target="_blank">Settings -> General</a> as well as the main navigation menu of the site.  &nbsp;&nbsp;One can also insert a custom logo into the header area, and activate a widget area up in the top right hand corner of the header area using the <strong>Header Widget Area</strong> setting found below.</p><p>The Striking header can be set to a height ranging from 60px to 300px, and can be adjusted the height to fit the logo size, navigation and the content one puts into the header widget area.</p>','theme_admin'),get_option('siteurl')),	
						"id" => "header_height",
						"min" => "60",
						"max" => "300",
						"step" => "1",
						"unit" => 'px',
						"default" => "90",
						"type" => "range"
					),
					array(
						"name" => __("Set A Custom Logo",'theme_admin'),
					"desc" => sprintf(__('<p> Set to <em>"On"</em> so that an image may be uploaded using the two <strong>Custom Logo Uploader</strong> settings below. &nbsp;&nbsp;The use of a site logo is optional - generally a logo is used as part of a marketing effort to create a brand identity. Once a logo is uploaded, the <strong>Site Title</strong> is automatically disabled from appearing in the header area.</p><p>If one does not use a logo, the <strong>Site Title</strong> and <strong>Site Tagline</strong> can still be customized in <a href="%1s/wp-admin/options-general.php" target="_blank">Settings -> General</a>. Furthermore, Striking allows for customizing the font sizes and colors of the site title and tagline using the settings found for each in the <a href="%2s" target="_blank">Striking -> Font</a> and <a href="%3s" target="_blank">Striking -> Color</a> panels so that if there is no logo, a unique "id" for the site may be created by styling the look of the site titles.<p> ','theme_admin'),get_option('siteurl'),admin_url( 'admin.php?page=theme_font&tab=size'),admin_url( 'admin.php?page=theme_color&tab=header')),	
						"id" => "display_logo",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Custom Logo Uploader",'theme_admin'),
						"desc" => __("<p>The logo uploader uses the default wp image uploading function, and once the image is visible in the wp image dialogue box after the upload, click on <em>Use This</em> at the bottom of the image dialogue box and the logo image will appear below. &nbsp;&nbsp;For quicker site page loading, it is suggested to use a jpeg image instead of a png image due to the lighter weight of jpegs. </p><p><em>HINT:</em>&nbsp;&nbsp;Do remember that if removing the current logo image for any reason, it will not be deleted from the media library unless one goes to the media library and deletes the image permanently.</p> ",'theme_admin'),
						"id" => "logo",
						"default" => "",
						"type" => "upload"
					),
					array(
						"name" => __("Custom Logo Uploader For Mobile Devices",'theme_admin'),
						"desc" => __("<p>In most instances, the full size logo may appear quite large in a mobile device so with this setting one can upload a second smaller version of the site custom logo. &nbsp;The logo will be displayed to mobile devices with a viewport smaller then 768px wide -> so it will display in viewports ranging from 320px - 767px in width.</p><p>Viewport detection and logo switching is automatic, all one need do is upload the logo.  &nbsp;As well, the logo will auto center in the screen.</p>",'theme_admin'),
						"id" => "mobile_logo",
						"default" => "",
						"type" => "upload"
					),
					array(
						"name" => __("Display Site Tagline",'theme_admin'),
						"desc" => sprintf(__('<p> The &#34;ON&#34; position of this setting activates display of a <a href="%s/wp-admin/options-general.php" target="_blank">Tagline</a> - an additional brief line of descriptive text often used for catchphrase or slogan purposes, that appears just below the Site Title.</p>','theme_admin'),get_option('siteurl')),		
						"id" => "display_site_desc",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Logo and/or Tagline Bottom Spacing",'theme_admin'),	
						"desc" => __(" <p>This setting is for creating the amount of gap between the bottom of the logo, and the navigation menu and feature header area below the logo.&nbsp;&nbsp;If there is no Tagline, the spacing starts from the bottom of the Site Title or Logo.&nbsp;&nbsp;If there is a Tagline, then the spacing starts from the bottom of it.</p><p>This setting is useful as once a main navigation menu becomes larger with more top level items, it will space out left towards the logo area (which is left aligned in the header area), and it will be necessary to adjust the bottom spacing in order for they not to infringe upon each other.</p>",'theme_admin'),		
						"id" => "logo_bottom",
						"min" => "-50",
						"max" => "80",
						"step" => "1",
						"unit" => 'px',
						"default" => "20",
						"type" => "range"
					),
					array(
						"name" => __("Header Top Area",'theme_admin'),
						"desc" => sprintf(__("<p>Striking provides the ability to have a widget area in the top right section of the header area. &nbsp;&nbsp; There are 3 choices:</p>
<p><strong>1 -</strong> <u>to show the wpml flags</u> if using the wordpress multi-language plugin ->Striking has auto language detection coded into it for wpml so that the wpml flag widget is not necessary if one chooses this option.<br /><br /><strong>2 -</strong> <u>to set it as a Widget Area</u> in which case after saving this panel go to <a href='%s/wp-admin/widgets.php' target='_blank'>Appearence -> Widgets</a> and a new Header Widget Area Sidebar will appear below the other sidebar areas to which widgets can be inserted.<br /><br /><strong>3 -</strong> <u>set the area to the html mode</u> in which case one can style the <b>Header Top Area Html Code</b> field below to hold whatever content and styling desired. &nbsp;&nbsp;The html mode was included into Striking at the request of designers who use the theme for their client sites, and is only recommended for users with a good understanding of html coding. &nbsp;&nbsp;However, there are a number of threads in the Striking support forum on styling the header widget area in html mode which may assist the novice coder on styling this area.</p><p><em>HINT 1:</em>&nbsp;&nbsp; If one wishes to have different widgets or content side by side in the header widget area, it should be set to html mode, and with use of divs, or column or layout shortcodes, and then place your content, and widget shortcodes into the columns.</p><p><em>HINT 2:</em>&nbsp;&nbsp; An easy way to build the content for this field when in HTML mode is to do so in a page content editor, and then cut and paste it into this field.</p>",'theme_admin'),get_option('siteurl')),
						"id" => "top_area_type",
						"default" => '',
						"options" => array(
							"html" => __('Html','theme_admin'),
							"wpml_flags" => __('Wpml Flags','theme_admin'),
							"widget" => __('Widget Area','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Header Top Area Html Code",'theme_admin'),
						"desc" => __("<p>In html mode this area accepts Striking shortcodes and html.&nbsp;&nbsp; An easy way to use this area is to create the content in the wp editor on a test page or post and then cut and paste it into this field. &nbsp;&nbsp;Use either layout or column shortcodes, or divs, to space out the content horizontally.</p><p>Remember that one usually does not want to enlarge the header height too much as it pushed the main content area further down the page, so this area is typically most suitable for compact items such as social icons, a search field, extra navigation links, multi-language flags, etc.</p>",'theme_admin'),		
						"id" => "top_area_html",
						"default" => "",
						'rows' => '3',
						"type" => "textarea"
					),
					array(
						"name" => __("Sticky Header",'theme_admin'),
						"desc" => __("<p>The &#34;ON&#34; position of this setting &#34;sticks&#34; the header area including the navigation menu to the top of the url window so that as one scrolls down the page, the header remains fixed to the top of the page view and always remains in sight.</p>",'theme_admin'),
						"id" => "sticky_header",
						"default" => false,
						"type" => "toggle"
					),
				),
			),
			array(
				"slug" => 'navigation',
				"name" => __("Navigation Menu Options",'theme_admin'),	
				"options" => array(
					array(
						"name" => __("Exclude Pages from the Striking Menu",'theme_admin'),
						"desc" => __("<p>If one is using the default Striking &#34;Built-in&#34; menu for site menu display, but wants to hide certain pages from appearing in the navigation, one selects the pages to exclude below. &nbsp;&nbsp;Hold down the Ctrl key on the keyboard while using a mouse to select multiple items (similar to how one would select multiple items on a desktop).</p>",'theme_admin'),	
						"id" => "excluded_pages",
						"default" => array(),
						"page" => '0',
						"prompt" => __("Click here to choose pages to exclude..",'theme_admin'),
						"chosen" => "true",
						"type" => "multiselect",
					),
					array(
						"name" => __("Activate Wordpress Custom Menu Functionality",'theme_admin'),
						"desc" => sprintf(__("<p>If this option is <em>ON</em>, the site's menus can be customized  using the <a href='http://codex.wordpress.org/Appearance_Menus_Screen' target='_blank'>WordPress Custom Navigation Menu</a> features, which provide the ability to do drag and drop menu ordering, custom titles for navigation elements, use the custom theme Sub-Title feature, hide selected pages, add categories, tags and other items to menus, and more. </p><p> Striking allows for a custom navigation menu for Main Navigation, and another for the Sub-Footer via the <a href='%1s' target='_blank'>Sub-Footer Widget Area Type</a> set to <em>Menu</em>.</p> <p>HINT:&nbsp;&nbsp; One can create an unlimited number of other custom menus and display them using the Custom Navigation widget. &nbsp;&nbsp;Go here to start creating custom menus: <a href='%2s/wp-admin/nav-menus.php' target='_blank'>Custom Menu Creation</a> </p>",'theme_admin'),admin_url( 'admin.php?page=theme_footer&tab=sub'),get_option('siteurl')),	
						"id" => "enable_nav_menu",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Button Style for Top Level Navigation",'theme_admin'),
						"desc" => sprintf(__('<p>This setting creates a button type look for the top level navigation (the navigation which one sees in the header). &nbsp;&nbsp;To be effective one also has to go to the <a href="%1s" target="_blank">Striking -> Color</a> Panel and give the <strong>Top Level Menu Background Color</strong> a color.</p><p>  <em>BONUS:</em> &nbsp;&nbsp; Striking includes a complete array of Call-To-Action active hover scripting for navigation, thus the navigation buttons can be given a separate color when a cursor hovers over them using the <a href="%2s" target="_blank">Top Level Menu Hover Background Color</a> setting. &nbsp;&nbsp;Striking also provides color optinos for the text in both hover and non-hover states, color options for the sub-navigation (dropdown menu items) and more in the Color Panel - Header Settings.</p>','theme_admin'),admin_url( 'admin.php?page=theme_color&tab=header'),admin_url( 'admin.php?page=theme_color&tab=header')),	
						"id" => "nav_button",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Top Level Navigation Arrows ",'theme_admin'),
						"desc" => __("<p>If this setting is toggled <em>ON</em>, the navigation will display a arrow pointing down on the right side of the top level menu text if there are sub-navigation children. &nbsp;&nbsp;So each arrow provide a visual cue to the site viewer that there are child pages for a top level navigation item.</p><p>NOTE:&nbsp;&nbsp; This feature can be used together with the Navigation Button setting above, but it cannot be used at the same time as the <strong>Top Level Navigation Arrow</strong> setting below.</p>",'theme_admin'),	
						"id" => "nav_arrow",
						"default" => false,
						"type" => "toggle"
					),
				
					array(
						"name" => __("Top Level Navigation Subtitle Option",'theme_admin'),
						"desc" => sprintf(__('<p>This custom theme feature is the ability to have sub-title text for top level menu items. &nbsp;&nbsp;Activate by toggling to <em>ON</em>.</p> <p><em>INFO:</em>&nbsp;&nbsp;Of course, when Striking provides a new feature like this, it typically provides as much granular control as possible, and so with this new sub-title feature, one can also customize the <a href="%1s" target="_blank">Top Level Navigation Menu Sub Title Text Size</a> and the non-active and active hover colors using the <a href="%2s" target="_blank">Sub Title Color Settings</a> in the Striking Color Panel/Header Settings section.</p><p>NOTE:&nbsp;&nbsp; This feature cannot be used at the same time as the <strong>Top Level Navigation Arrow</strong> setting.</p>','theme_admin'),admin_url( 'admin.php?page=theme_font&tab=size'),admin_url( 'admin.php?page=theme_color&tab=header')),
						"id" => "enable_nav_subtitle",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Subtitles Alignment",'theme_admin'),
						"desc" => __("<p>Use this to set the alignment of the sub-navigation title under the top level title as desired. &nbsp;&nbsp;The choices are left aligned, centered and right aligned. &nbsp;&nbsp;The theme default alignment is in the centered position.</p>",'theme_admin'),
						"id" => "nav_subtitle_align",
						"default" => 'center',
						"options" => array(
							"center" => __('Centered','theme_admin'),
							"right" => __('Right Aligned','theme_admin'),
							"left" => __('Left Aligned','theme_admin'),
						),
						"type" => "select",
					),
				),
			),
			array(
				"slug" => 'favicon',
				"name" => __("Custom Favicon Settings",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Normal Custom Favicon",'theme_admin'),
						"desc" => __("<p>Striking supports the favicon feature which is uploaded by using the Upload Icon button below. &nbsp;&nbsp;<u>Please note that while the WP default image uploading routine will give the option of selecting something from the media library, in fact the image always has to uploaded direct from your desktop - selecting something in the media library will not work for this Striking feature</u>. &nbsp;&nbsp;If you don't like the favicon you uploaded, use the Remove Image button to remove it, and upload another. </p><p>Be advised that if a favicon is removed, the image will still remain in the media library, so if one is cycling through a variety of potential favicons, one may wish to go to the media library and permanently delete the images not used in order to reduce media library clutter.</p><p><em>HINTS:</em>&nbsp;&nbsp;The standard favicon size is 16px by 16 px and there are many free web resources available for assisting in creating a favicon. &nbsp;&nbsp; The standard favicon works in Firefox, IE, Safari, Chrome but be advised some browsers do not support favicons.</p>",'theme_admin'),
						"id" => "custom_favicon",
						"default" => '',
						"button" => 'Upload Icon',
						"type" => 'upload',
						"imagewidth" => '16',
					),
					array(
						"name" => __("Apple Touch Custom Favicon 57X57 (Optional)&#x200E;",'theme_admin'),
						"desc" => __("<p>The apple touch icon works on all apple iOS devices (iPhone, iPad, iTouch, etc). and &#34;sometimes&#34; works on certain Android and Blackberry devices. &nbsp;&nbsp;The 57 x 57 size is for non-retina non-Retina iPhone and iPod Touch, and other mobile displays.</p><p>Upload the icon by using the Upload Icon button below. &nbsp;&nbsp;<u>Please note that while the WP default image uploading routine will give the option of selecting something from the media library, in fact the favicon image always has to be uploaded from your desktop</u> - selecting something in the media library will not work for this Striking feature. &nbsp;&nbsp;If you don't like the favicon you uploaded, use the Remove Image button to remove it, and upload another.</p><p>Be advised that if a favicon image is removed, the image will still remain in the media library, so if one is cycling through a variety of potential favicons, one may wish to go to the media library and permanently delete the images not used in order to reduce media library clutter.</p><p><em>INFO:</em>&nbsp;&nbsp;The iOS devices will automaticly turn the favicon image into a &#34;button&#34; with rounded corners, shine effect, and dropshadow.</p><p><em>HINT:</em>&nbsp;&nbsp;If one wants Android support for the apple touch icon one must specify &#34;pre-composed &#34; in the png file name -> &#34;apple-touch-icon-57x57-precomposed.png&#34;. &nbsp;&nbsp;However, using a pre-composed file will automatically disable the apple shine effect so if one desires that effect it should be added to the image when it is constructed.</p>",'theme_admin'),
						"id" => "custom_favicon_57",
						"default" => '',
						"button" => 'Upload Icon',
						"type" => 'upload',
						"imagewidth" => '57',
					),
					array(
						"name" => __("Apple Touch Custom Favicon 72X72 (optional)&#x200E;",'theme_admin'),
					"desc" => __("<p>The apple touch icon works on all apple iOS devices (iPhone, iPad, iTouch, etc). and &#34;sometimes&#34; works on certain Android and Blackberry devices. &nbsp;&nbsp;The 72 x 72 size is for iPads without a high-resolution display (the first two generations).</p><p>Upload the icon by using the Upload Icon button below. &nbsp;&nbsp;<u>Please note that while the WP default image uploading routine will give the option of selecting something from the media library, in fact the favicon image always has to be uploaded from your desktop</u> - selecting something in the media library will not work for this Striking feature. &nbsp;&nbsp;If you don't like the favicon you uploaded, use the Remove Image button to remove it, and upload another.</p><p>Be advised that if a favicon image is removed, the image will still remain in the media library, so if one is cycling through a variety of potential favicons, one may wish to go to the media library and permanently delete the images not used in order to reduce media library clutter.</p><p><em>INFO:</em>&nbsp;&nbsp;The iOS devices will automaticly turn the favicon image into a &#34;button&#34; with rounded corners, shine effect, and dropshadow. </p><p><em>HINT:</em>&nbsp;&nbsp;If one wants Android support for the apple touch icon one must specify &#34;pre-composed &#34; in the png file name -> &#34;apple-touch-icon-72x72-precomposed.png&#34;. &nbsp;&nbsp;However, using a pre-composed file will automatically disable the apple shine effect so if one desires that effect it should be added to the image when it is constructed.</p>",'theme_admin'),	
						"id" => "custom_favicon_72",
						"default" => '',
						"button" => 'Upload Icon',
						"type" => 'upload',
						"imagewidth" => '72',
					),
					array(
						"name" => __("Apple Touch Custom Favicon 114X114 (Optional)&#x200E;",'theme_admin'),
					"desc" => __("<p>The apple touch icon works on all apple iOS devices (iPhone, iPad, iTouch, etc). and &#34;sometimes&#34; works on certain Android and Blackberry devices. &nbsp;&nbsp;The 114 x 114 size is for iPhone 4+ (with Retina Display).</p><p>Upload the icon by using the Upload Icon button below. &nbsp;&nbsp;<u>Please note that while the WP default image uploading routine will give the option of selecting something from the media library, in fact the favicon image always has to be uploaded from your desktop</u> - selecting something in the media library will not work for this Striking feature. &nbsp;&nbsp;If you don't like the favicon you uploaded, use the Remove Image button to remove it, and upload another.</p><p>Be advised that if a favicon image is removed, the image will still remain in the media library, so if one is cycling through a variety of potential favicons, one may wish to go to the media library and permanently delete the images not used in order to reduce media library clutter.</p><p><em>INFO:</em>&nbsp;&nbsp;The iOS devices will automaticly turn the favicon image into a &#34;button&#34; with rounded corners, shine effect, and dropshadow.</p><p> <em>HINT:</em>&nbsp;&nbsp;If one wants Android support for the apple touch icon one must specify &#34;pre-composed &#34; in the png file name -> &#34;apple-touch-icon-114x114-precomposed.png&#34;. &nbsp;&nbsp;However, using a pre-composed file will automatically disable the apple shine effect so if one desires that effect it should be added to the image when it is constructed.</p>",'theme_admin'),	
						"id" => "custom_favicon_114",
						"default" => '',
						"button" => 'Upload Icon',
						"type" => 'upload',
						"imagewidth" => '114',
					),
					array(
						"name" => __("Apple Touch Custom Favicon 144X144 (Optional)&#x200E;",'theme_admin'),
						"desc" => __("<p>The apple touch icon works on all apple iOS devices (iPhone, iPad, iTouch, etc). and &#34;sometimes&#34; works on certain Android and Blackberry devices. The 144 x 144 size is for iPad 3+ (with Retina Display);.</p><p>Upload the icon by using the Upload Icon button below. &nbsp;&nbsp;<u>Please note that while the WP default image uploading routine will give the option of selecting something from the media library, in fact the favicon image always has to be uploaded from your desktop</u> - selecting something in the media library will not work for this Striking feature. &nbsp;&nbsp;If you don't like the favicon you uploaded, use the Remove Image button to remove it, and upload another.</p><p>Be advised that if a favicon image is removed, the image will still remain in the media library, so if one is cycling through a variety of potential favicons, one may wish to go to the media library and permanently delete the images not used in order to reduce media library clutter.</p><p><em>INFO:</em>&nbsp;&nbsp;The iOS devices will automaticly turn the favicon image into a &#34;button&#34; with rounded corners, shine effect, and dropshadow.</p><p> <em>HINT:</em>&nbsp;&nbsp;If one wants Android support for the apple touch icon one must specify &#34;pre-composed &#34; in the png file name -> &#34;apple-touch-icon-144x144-precomposed.png&#34;. &nbsp;&nbsp;However, using a pre-composed file will automatically disable the apple shine effect so if one desires that effect it should be added to the image when it is constructed.</p>",'theme_admin'),	
						"id" => "custom_favicon_144",
						"default" => '',
						"button" => 'Upload Icon',
						"type" => 'upload',
						"imagewidth" => '144',
					),
				),
			),
			array(
				"slug" => 'page',
				"name" => __("General Page Layout Settings",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Boxed Layout Appearence Option",'theme_admin'),
						"desc" =>__("<p>This setting converts the site to a boxed layout type appearence, where the header and footer areas are constrained to the same width as the page body area, resulting in a top-to-bottom &#34;column&#34; look for the site.</p><p><em>NOTE:</em> &nbsp;&nbsp;&nbsp;&nbsp;In box mode the site content width is 1000px.</p><p><em>HINT:</em> &nbsp;&nbsp;Striking features many specific settings for the box mode including settings in the Striking Background panel and Striking Color panel specific to boxed layout usage. &nbsp;A new feature is a collection of 39 selectable backgrounds for the box mode via the <b>Box Mode Subtle Pattern</b> setting in the Background Panel.</p>",'theme_admin'),
						"id" => "enable_box_layout",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Set a Default Page Layout",'theme_admin'),
						"desc" => "<p>Striking has 3 page layouts that can be set as the &#34;default&#34; page automaticaly when creating a new page :</p><p>1 - Full Width <br />2 - Left Sidebar<br />3 - Right Sidebar</p><p>Although one can always select the page layout on a page-by-page basis using the <strong>Template</strong> setting, setting a default page template saves one having to set the layout everytime one creates a page.</p><p>Of course in Striking one can always override the default template by selecting another in the drop down selector in the <strong>Template</strong> Setting each time one creates or edits a page, so one is never restricted in page layout choice. &nbsp;&nbsp;This <strong>Set a Default Page Layout</strong> ability is provided to reduce the amount of work in page creation and editing.</p>",
						"id" => "layout",
						"default" => 'right',
						"options" => array(
							"full" => __('Full Width','theme_admin'),
							"right" => __('Right Sidebar','theme_admin'),
							"left" => __('Left Sidebar','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Enable the Striking Feature Header Site Wide",'theme_admin'),
						"desc" => __("<p>If this option is set to ON, you'll globally enable your website's Feature Header Area which is the area just below the navigation typically used for display of media (such as the big slider) or information.&nbsp;&nbsp;So the default position for this setting is such that normally the Featured Header Area is not showing.&nbsp;&nbsp;The default is this way as Striking also allows for the determination of the Feature Header area on a per page/post basis and the setting to do this is found in the <strong>Striking General Page Options</strong> metabox which is one of the metaboxes found below the wp content editor.</p><p>This is a legacy setting as Striking has since over time introduced a wide variety of settings allowing for full control and manipulation of the feature header area by way of the various options in the <strong>Feature Header Type</strong> setting found in the Striking Page General Options metabox -> Feature Header Settings tab.</p>",'theme_admin'),
						"id" => "introduce",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Site Breadcrumbs Visibility",'theme_admin'),
						"desc" => __("<p>Striking has built into its core code the very well known <em>Breadcrumbs Plus</em> plugin -> so it is not necessary to load this plugin or any other for breadcrumbs function in the theme. &nbsp;&nbsp;This setting controls themewide breadcrumbs visibility. &nbsp;&nbsp;<em>ON</em> enables breadcrumbs throughout the site and <em>OFF</em> disables them site wide.</p><p><em>NOTE</em> - The theme also has a tri-toggle setting in the page editing options (Page Options Metabox/General Page Options Tab/Breadcrumbs Visibility Setting below the WP content editor) for every page to enable or disable breadcrumbs specific to that page.&nbsp;&nbsp;An example of when this is helpful -->some forum plugins have their own breadcrumbs script which can conflict with the theme breadcrumbs.&nbsp;&nbsp;In such as situation, turn off the theme breadcrumbs, but use the page override breadcrumbs setting to activate breadcrumbs on every non-forum sitepage.</p><p><em>OTHER INFO</em> - Breadcrumbs do not appear on the homepage of a site, and the breadcrumb string will depend on how one has set the site permalinks.&nbsp;&nbsp;The breadcrumb placement in Striking is in the upper left hand corner of the page body section of all other pages and posts.&nbsp;&nbsp;Typically each navigation layer other then the present page is a clickable link in the breadcrumb string.</p><p><em>YOAST BREADCRUMBS</em> - a unique feature of the theme is that it has automatic Yoast SEO Plugin breadcrumbs support --> if one has activated the breadcrumbs setting in the Yoast plugin then the theme  defaults to the Yoast breadcrumbs and deactivates the theme breadcrumbs automatically.&nbsp;&nbsp;<u>Thus one does not need to activate this setting at all for the Yoast breadcrumbs, it is managed internally by the theme code.</u></p>",'theme_admin'),
						"id" => "breadcrumb",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Enable Default Lightbox for All Images Sitewide",'theme_admin'),
						"desc" => __("<p>It is suggested that this setting usually be left &#34;OFF&#34; - its default position. &nbsp;&nbsp;However, if one typically uses the wordpress Add Media function to put an image into content (rather then using the Striking Image Shortcode), and wants the images to automatically open in a lightbox then it should be toggled &#34;ON&#34;.</p>",'theme_admin'),
						"id" => "lightbox_rel_replace",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Scroll to Top ",'theme_admin'),
						"desc" => __("<p>If this option is <em>ON</em>, a nice scroll to top button will appear at the bottom right corner of site pages and posts as one starts scrolling down the url window. &nbsp;&nbsp;This feature is very useful if one has lengthy site pages due to content or long sidebars. &nbsp;&nbsp;The <strong>Scroll to Top Style</strong> setting below allows one to choose the look of the button.</p>",'theme_admin'),
						"id" => "scroll_to_top",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Scroll to Top Button Style - &#34;<span class='theme_new_feature'>NEW FEATURE</span>&#34;",'theme_admin'),
						"desc" =>  sprintf(__("<p>Use this setting to choose the look of the scroll button.&nbsp;&nbsp;The options are a circle or a square button appearence.&nbsp;&nbsp;One can also choose the color and hover color of the scroll button in the <a href='%s' target='_blank'>Color Panel/Scroll to Top Tab</a> section.</p>",'theme_admin'),admin_url( 'admin.php?page=theme_color&tab=scrolltop')),
							"id" => "scroll_to_top_style",
						"default" => 'circle',
						"options" => array(
							"circle" => __('Circle','theme_admin'),
							"square" => __('Square','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Sticky Sidebar",'theme_admin'),
						"desc" => __("<p>This function fixes the sidebar area so that as one scrolls down the page, the sidebar remains fixed to the top of the page and remains in sight.</p>",'theme_admin'),
						"id" => "sticky_sidebar",
						"default" => false,
						"type" => "toggle"
					),
				),
			),	
			array(
				"slug" => 'analytics',
				"name" => __("Google Analytics Code Settings",'theme_admin'),
				"options"=> array(
					array(
						"name" => __("Tracing Id (optional)",'theme_admin'),
						"desc" => __("The Google Analytics tracking code will be installed on your site automatically if you fill the tracing id here. You can get the id from <a href='http://www.google.com/analytics/' target='_blank'>here</a>. E.g. <code>UA-XXXXXXXX-X</code>.",'theme_admin'),	
						"id" => "analytics_id",
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __("Google Analytics Code (optional)",'theme_admin'),
						"desc" => __("<p>Paste the <a href='http://www.google.com/analytics/' target='_blank'>analytics code</a> here, and it will get applied to each page in the site automatically.</p>",'theme_admin'),
						"id" => "analytics",
						"default" => "",
						"type" => "textarea"
					),
					array(
						"name" => __("Choose where to load the Google Analytics Javascript",'theme_admin'),
						"desc" => __("<p>This setting provides the choice to have the google analytics code loaded either in the header or the footer area.&nbsp;&nbsp;Typically a site has it load in the header per google recommendations but there are certain exceptions where it is more desirable for it to be loaded in the footer.</p>",'theme_admin'),
						"id" => "analytics_position",
						"default" => 'bottom',
						"options" => array(
							"header" => __('Header','theme_admin'),
							"bottom" => __('Bottom','theme_admin'),
						),
						"type" => "select",
					),
				),
			),
			
			array(
				"slug" => 'custom',
				"name" => __("Custom CSS & JS Fields",'theme_admin'),
				"options"=> array(
					array(
						"name" => __("Custom CSS",'theme_admin'),
					"desc" => __("<p>This field is where one can post any custom css to override the default css of the theme.&nbsp;&nbsp;The Striking default css is found in the screen.css in the CSS folder (Striking/CSS/screen.css) and most responsive related css is found in responsive.css file. &nbsp;&nbsp;One can open that file with an editor such as Notepad ++ or Dreamweaver to review it. &nbsp;&nbsp;Browser tools such as Firebug and Web Developer can also be used to detect all the individual code elements of a webpage, and these tools allow for live editing > one can take that custom code from the live editing and paste it in this field to duplicate the effect achieved.</p><p>The Striking Support Forum has thousands of threads containing simple custom css snippets that allow one to change the appearence and position of many elements in an advanced way, beyond what is practical for a traditional theme setting.&nbsp;&nbsp;Take those snippets from the forum and copy and paste them into the field below.</p><p><strong>The content of the field below is stored in the site database, and so it is unaffected by Striking theme updates.</strong> &nbsp;&nbsp;So <u>the use of this field for custom css eliminates the need for hardcoding css changes in theme files, and also makes use of a child theme unnecessary if only creating custom CSS.</u></p><p> However, it is always a good idea to have pasted the content below into a text document and store this on a home computer or somewhere else other then the website host so that there is an independent backup, since a database can be compromised due to other circumstances.</p>",'theme_admin'),	
						"id" => "custom_css",
						"default" => "",
						'rows' => '15',
						"type" => "textarea"
					),
					array(
						"name" => __("Custom JS",'theme_admin'),
						"desc" => sprintf(__('<p>This field has the same type of ability as the above CSS field, and again code in here is stored in the database, and unaffected by theme updates. &nbsp;The code input here will display on the footer of the page. Samples: </p><p><code>&lt;script type=&quot;text/javascript&quot; src=&quot;%s/wp-content/themes/striking_r/js/yourscript.js&quot;&gt;&lt;/script&gt;</code><br/>
<code>&lt;script type=&quot;text/javascript&quot;&gt;alert("hello world");&lt;/script&gt;</code></p>','theme_admin'),get_option('siteurl')),
						"id" => "custom_js",
						"default" => "",
						'rows' => '10',
						"type" => "textarea"
					),
				),
			),
		);
	}
}
