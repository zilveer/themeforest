<?php
class Theme_Options_Page_Color extends Theme_Options_Page_With_Tabs {
	public $slug = 'color';

	function __construct(){
		$this->name = __('Color Settings','theme_admin');
		parent::__construct();
	}
	function tabs(){
		$options = array(
			array(
				"slug" => 'flatdesign',
				"name" => __("Flat Design",'theme_admin'),
				"desc" => __("<h3 align='center'>MODIFIED FLAT DESIGN OPTION</h3>
<p>Striking employs a complex shadow and gradient appearence by default providing for a texturized appearence to every webpage. &nbsp;But if building a site with a &#34;clean/minimalist&#34; design  philosophy, the settings below will allow removal of the shadowing and gradients that appear for transitions between major sections of the webpages (ie gradient between Feature Header and Body Content, Content and Sidebar, etc). &nbsp;This is a principal step towards what is known as a &#34;Modified&#34; or &#34;Almost&#34; Flat Design and is further facilitated by settings throughout the various theme functions for optional hover actions on specific style elements.</p>
<p>The final element towards achieving a flat design would be using the custom css functions of Striking MultiFlex to remove color gradients and shadows in styled elements such as buttons and images. &nbsp;As Striking provides custom css fields for both theme wide use (General Panel) and for specific webpages (Page General Options Metabox) the user has the ability to decide when they might want to flatten elements such as section background colors, buttons and images, such flattening can be page/post specific or theme wide. &nbsp;Furthermore, all the Styled Box shortcodes and the Button Shortcode have class fields so they can easily be assigned a class created for flat design purposes.</p>
<p>Flat design is in fact a very old ability &#34;rediscovered&#34; principally by google which incorporated flat design into its homepage appearence in mid 2012. &nbsp;This immediately popularized this old ability (at the start of the web all sites were flat design!) but within a short period of time Google reverted to an Almost Flat Design appearence with some gradients and shadows restored, because frankly full flat design is really not very user friendly. &nbsp;So we suggest that flat design consideration be but an element of a site, which is why Multiflex provides the ability to remove the macro gradient and shadow elements, but keeps the minor ones that assist in interpretation of content.</p>", 'theme_admin'),
				"options" => array(
					array(
						'name' => __("Page Shadowing Effects",'theme_admin'),
						"id" => "has_shadow",
						"desc" => __("<p>This setting enables one to have light, dark or no shadowing appear in the various page elements such as the feature header, footer and sidebar containers. &nbsp;&nbsp;Use of this setting along with the <strong>Gradient</strong> setting below and the <strong>Sidebar Border Color</strong> setting found in the <em>Page Elements & Tags</em> Tab will allow one to have either a complex shadowed look in a site, or set it up for a &#34;Minimalist/Clean Design&#34; appearence wherein many elements appear to float on the page.</p>",'theme_admin'),	
						"default" => 'light',
						"options" => array(
							"none" => __('No shadow','theme_admin'),
							"light" => __('light shadow ','theme_admin'),
							"dark" => __('dark shadow','theme_admin'),
						),
						"type" => "select",
					),
					array(
						'name' => __("Page Gradient Effects",'theme_admin'),
						"desc" => __("<p>This setting enables one to remove the gradients appearing in the various page elements such as the feature header, footer and sidebar containers. &nbsp;Use of this setting along with the <strong>Page Shadowing Effects</strong> setting above, the <strong>Sub Footer Gradient</strong> and <strong>Sidebar Border Color</strong> settings below will allow one to have either a complex shadowed look in a site, or set it up for a &#34;Minimalist/Clean Design&#34; flat appearence.</p>",'theme_admin'),
						"id" => "has_gradient",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Sidebar Border Color (only for use when Gradient setting is &#34;OFF&#34;)",'theme_admin'),
						"desc" => __("<p>Upon removing the main element shadow and gradient effects, a 1 px border line will still be in place vertically between the page content and sidebar for the Left and Right Sidebar Page Templates.  Use this setting to assign that border a color, or make it transparent so that it is removed -> which depending on backgrounds/colors may result in the content and widget elements appearing to float in the page.</p>",'theme_admin'),
						"id" => "sidebar_border",
						"default" => "#eee",
						"type" => "color"
					),
					array(
						"name" => __("Sub Footer Gradient",'theme_admin'),
						"desc" => __("<p>If this option is off, it will remove the background gradient for the sub footer.</p>",'theme_admin'),
						"id" => "sub_footer_gradient",
						"default" => true,
						"type" => "toggle"
					),	
				),
			),		
			array(
				"slug" => 'general',
				"desc" => __("<h3 align='center'>BODY ELEMENTS</h3>
<p>This admin tab is for setting the colors to the main webpage elements. &nbsp;The color settings in this panel (other then the sub-footer color) allow for setting site default colors for each noted element. &nbsp;Striking has settings in the <strong>Page General Options -> Page Design Tab</strong> below each content editor to override the color settings below if desiring to customize colors by webpage.</p>", 'theme_admin'),
				"name" => __("Body Elements",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Body Background Color",'theme_admin'),
						"desc" => __('<p>If you have chosen to set a default color to the body element be aware of the following. The theme has two layout settings. Box mode and normal mode. To see this color in normal mode you have to set the colors of the various area&#39;s the theme uses  (header, featured header, page, footer) to transparent or a background-color with transparency. In Box mode this color will be visible in the outer area around the box. If you choose to set an image for the body background, you should empty out this body background color.</p>','theme_admin'),
						"id" => "box_bg",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Header Background Color",'theme_admin'),
						"desc" => "",
						"id" => "header_bg",
						"default" => "#fefefe",
						"type" => "color"
					),
					array(
						"name" => __("Feature Header Background Color",'theme_admin'),
						"desc" => "",
						"id" => "feature_bg",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page Background Color",'theme_admin'),
						"desc" => "",
						"id" => "page_bg",
						"default" => "#fefefe",
						"type" => "color"
					),
					array(
						"name" => __("Footer Background Color",'theme_admin'),
						"desc" => "",
						"id" => "footer_bg",
						"default" => "#000000",
						"type" => "color"
					),
					array(
						"name" => __("Sub Footer Background Color",'theme_admin'),
						"desc" => "",
						"id" => "sub_footer_bg",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Detail Elements Primary Color",'theme_admin'),
						"desc" => __("<p>Use this to choose a custom default color for all the following elements:</p>
<ol>
<li>Top Level Menu Hover Color</li>
<li>Feature Header Background Color</li>
<li>Button Primary Color</li>
<li>Page Link Hover Color</li>
<li>Sidebar Link Hover Color</li>
<li>Footer Link Hover Color</li>
<li>Footer Menu Hover Color</li>
<li>Breadcrumb Hover Color</li>
<li>Post Title Link Hover Color</li>
<li>Post Meta Link Hover Color</li>
<li>Milestone Number Color</li>
<li>Process Step Icon Hover Color</li>
<li>Progress Bar Color</li>
<li>Pie Progress Bar Color</li>
<li>Woocommerce Primary Button Color</li>
</ol>",'theme_admin'),
						"id" => "primary",
						"default" => "#3cabce",
						"type" => "color"
					),
					array(
						"name" => __("Text Selection Background Color",'theme_admin'),
						"desc" => __("<p>This setting is for when one anticipates a user may highlight certain text in a webpage with the intent of right clicking to copy and paste to their desktop. &nbsp;Use this setting to give the selected text a unique background color while the user's cursor is selecting it. &nbsp;Use the <strong>Text Selection Color</strong> below to give the selected text a separate color from the balance of text in the webpage.</p>",'theme_admin'),	
						"id" => "selection_bg",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Text Selection Color",'theme_admin'),
						"desc" => __("<p>This setting is for when one anticipates a user may highlight certain text in a webpage with the intent of right clicking to copy and paste to their desktop. &nbsp;Use this setting to give the selected text a separate color from the balance of text in the webpage.<p>",'theme_admin'),
						"id" => "selection",
						"default" => "#ffffff",
						"type" => "color"
					),
				),
			),
			array(
				"slug" => 'header',
				"name" => __("Header Elements",'theme_admin'),
				"desc" => __("<h3 align='center'>HEADER COLORS</h3>
<p>The majority of colors in this admin tab are for items in the main theme navigation. &nbsp;Here is a guide to the elements:</p>
<p><strong>Top Level</strong> - refers to the visible navigation links in the header area when landing on a webpage.  These would typically be links such as Home, About, Contact Us, Blog, etc.</p>
<p><strong>Sub Level</strong> - refers to the navigation links which are childs of the visible Top Level navigation links. So these navigation items are only visible once a user hovers over the top level navigation links, and then a dropdown will show for the sub level items. &nbsp;Separate colors can be set for sub level items.</p>
<p>For both Top Level and Sub Level navigation items, one can set alternate <strong>Current</strong> and <strong>Hover</strong> colors. The Current color is a visual cue which denotes the page the user is actually on at the time. &nbsp;Hover is the color action for when a cursor slides over a navigation item.</p>
<p>As Striking provides significantly more navigation settings (button look, dropdown arrow, Font Icons, Sub-Titles) and color options then typically found in wordpress themes you are encouraged to experiment with the color settings as a highly customized, unique navigation appearence can be obtained for every website.</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Logo Text Color",'theme_admin'),
						"desc" => "",
						"id" => "site_name",
						"default" => "#444444",
						"type" => "color"
					),
					array(
						"name" => __("Logo Description Text Color",'theme_admin'),
						"desc" => "",
						"id" => "site_description",
						"default" => "#444444",
						"type" => "color"
					),
					array(
						"name" => __("Top Level Menu Text Color",'theme_admin'),
						"desc" => __("<p>This setting enables one to choose a color for the text appearing in the top level navigation menu. &nbsp;&nbsp;The color chosen will apply to all top level navigation text other then the navigation text for the &#34;Current&#34; page (the page one is viewing), which is set separately via the &#34;Current&#34; Menu color setting found below.</p> ",'theme_admin'),	
						"id" => "menu_top",
						"default" => "#000000",
						"type" => "color"
					),
					array(
						"name" => __("Top Level Menu Current Text Color",'theme_admin'),
					"desc" => __("<p>Striking  allows one to select a separate color for the top level navigation text of the &#34;Current&#34; (active) page. &nbsp;&nbsp; Thus color chosen using this setting will apply only to the top level navigation text of the page one is actively viewing, and as one surfs to different pages in a site, the top level navigation text color will change accordingly. &nbsp;&nbsp;If a viewer surfs to a subpage, the appropriate top level navigation text will reflect the &#34;Current&#34; color chosen</p>",'theme_admin'),	
						"id" => "menu_top_current",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Top Level Menu Sub Title Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_top_subtitle",
						"default" => "#000000",
						"type" => "color"
					),
					array(
						"name" => __("Top Level Menu Background Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_top_background",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Top Level Menu Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_top_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Top Level Menu Sub Title Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_top_subtitle_active",
						"default" => "#000000",
						"type" => "color"
					),
					array(
						"name" => __("Top Level Menu Hover Background Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_top_active_background",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Top Level Menu Sub Title Current Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_top_subtitle_current",
						"default" => "#000000",
						"type" => "color"
					),
					array(
						"name" => __("Top Level Current Menu Background Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_top_current_background",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Sub Level Menu Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_sub",
						"default" => "#000000",
						"type" => "color"
					),
					array(
						"name" => __("Sub Level Menu Background Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_sub_background",
						"default" => "#fcfcfc",
						"type" => "color"
					),
					array(
						"name" => __("Sub Level Menu Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_sub_active",
						"default" => "#000000",
						"type" => "color"
					),
					array(
						"name" => __("Sub Level Menu Hover Background Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_sub_hover_background",
						"default" => "#eeeeee",
						"type" => "color"
					),
					array(
						"name" => __("Sub Level Current Menu Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_sub_current",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Sub Level Current Menu Background Color",'theme_admin'),
						"desc" => "",
						"id" => "menu_sub_current_background",
						"default" => "",
						"type" => "color"
					),
				),
			),
			array(
				"slug" => 'feature',
				"name" => __("Feature Header Elements",'theme_admin'),
				"desc" => __("<h3 align='center'>COLORS FOR CUSTOM HEADER SETTINGS</h3>
<p>The two settings below are for a theme wide custom color when employing a custom title and/or custom text options in the <strong>Feature Header Type</strong> setting for any page or post.</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Feature Header Title Color",'theme_admin'),
						"desc" => "",
						"id" => "feature_header",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Feature Header Custom Text Color",'theme_admin'),
						"desc" => "",
						"id" => "feature_introduce",
						"default" => "#ffffff",
						"type" => "color"
					),
				),
			),
			array(
				"slug" => 'slideshow',
				"name" => __("Slideshow Elements",'theme_admin'),
				"options" => array(
//					array(
//						"name" => __("Nivo Slider Loading Background Color",'theme_admin'),
//						"desc" => "",
//						"id" => "nivo_loading_bg",
//						"default" => "#ffffff",
//						"type" => "color"
//					),
					array(
						"name" => __("Nivo Slider Caption Text Color",'theme_admin'),
						"desc" => "",
						"id" => "nivo_caption_text",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Nivo Slider Caption Background Color",'theme_admin'),
						"desc" => "",
						"id" => "nivo_caption_bg",
						"default" => "rgba(0,0,0,0.8)",
						"type" => "color"
					), 
					array(
						"name" => __("KenBurner Slider Border Color",'theme_admin'),
						"desc" => "",
						"id" => "kenburner_bg",
						"default" => "rgba(50,50,50,0.8)",
						"type" => "color"
					),
					array(
						"name" => __("KenBurner Slider Desc Text Color",'theme_admin'),
						"desc" => "",
						"id" => "kenburner_desc_text",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("KenBurner Slider Desc Background Color",'theme_admin'),
						"desc" => "",
						"id" => "kenburner_desc_bg",
						"default" => "rgba(0,0,0,0.3)",
						"type" => "color"
					), 
					array(
						"name" => __("KenBurner Slider Thumbnail Border Color",'theme_admin'),
						"desc" => "",
						"id" => "kenburner_thumbnail_bg",
						"default" => "rgba(50,50,50,0.8)",
						"type" => "color"
					),

					array(
						"name" => __("Accordion Slider Caption Text Color",'theme_admin'),
						"desc" => "",
						"id" => "unleash_caption_text",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Accordion Slider Desc Text Color",'theme_admin'),
						"desc" => "",
						"id" => "unleash_desc_text",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Accordion Slider Caption Background Color",'theme_admin'),
						"desc" => "",
						"id" => "unleash_caption_bg",
						"default" => "rgba(1,1,1,0.4)",
						"type" => "color"
					), 
					array(
						"name" => __("Roundabout Slider Caption Text Color",'theme_admin'),
						"desc" => "",
						"id" => "roundabout_title_text",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Roundabout Slider Desc Text Color",'theme_admin'),
						"desc" => "",
						"id" => "roundabout_desc_text",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Roundabout Slider Caption Background Color",'theme_admin'),
						"desc" => "",
						"id" => "roundabout_caption_bg",
						"default" => "rgba(1,1,1,0.4)",
						"type" => "color"
					),
					array(
						"name" => __("Fotorama Fullscreen Background Color",'theme_admin'),
						"desc" => "",
						"id" => "fotorama_fullscreen_bg",
						"default" => "rgb(0,0,0)",
						"type" => "color"
					), 
					array(
						"name" => __("Fotorama Caption Background Color",'theme_admin'),
						"desc" => "",
						"id" => "fotorama_caption_bg",
						"default" => "rgba(255,255,255,0.9)",
						"type" => "color"
					),
					array(
						"name" => __("Fotorama Caption Text Color",'theme_admin'),
						"desc" => "",
						"id" => "fotorama_caption_text",
						"default" => "#303030",
						"type" => "color"
					), 
				),
			),
			array(
				"slug" => 'page',
				"name" => __("Page Elements & Tags",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Page Text Color",'theme_admin'),
						"desc" => "",
						"id" => "page",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("Page Header Color",'theme_admin'),
						"desc" => "",
						"id" => "page_header",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("Page H1 Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h1",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H2 Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h2",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H3 Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h3",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H4 Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h4",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H5 Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h5",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H6 Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h6",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H1 Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h1_link_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H2 Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h2_link_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H3 Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h3_link_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H4 Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h4_link_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H5 Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h5_link_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page H6 Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "page_h6_link_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page Link Color",'theme_admin'),
						"desc" => "",
						"id" => "page_link",
						"default" => "#666666",
						"type" => "color"
					),
					array(
						"name" => __("Page Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "page_link_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Sidebar Widget Title",'theme_admin'),
						"desc" => "",
						"id" => "widget_title",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("Sidebar Link Color",'theme_admin'),
						"desc" => "",
						"id" => "sidebar_link",
						"default" => "#666666",
						"type" => "color"
					),
					array(
						"name" => __("Sidebar Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "sidebar_link_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Breadcrumbs Text Color",'theme_admin'),
						"desc" => "",
						"id" => "breadcrumbs",
						"default" => "#999999",
						"type" => "color"
					),
					array(
						"name" => __("Breadcrumbs Link Color",'theme_admin'),
						"desc" => "",
						"id" => "breadcrumbs_link",
						"default" => "#999999",
						"type" => "color"
					),
					array(
						"name" => __("Breadcrumbs Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "breadcrumbs_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Button Primary Color",'theme_admin'),
						"desc" => __("<p>The button shortcode allows for setting a unique set of colors per button. &nbsp;And the <strong>Detail Elements Primary Color</strong> (Body Elements tab) setting includes a default button color in its coverage. &nbsp;But if you want to set a distinct custom default button color, then this is the setting for that purpose!</p>", 'theme_admin'),
						"id" => "button_primary",
						"default" => "",
						"type" => "color",
						"format" => 'hex',
					),
					array(
						"name" => __("Divider Line Color",'theme_admin'),
						"desc" => "",
						"id" => "divider_line",
						"default" => "#eeeeee",
						"type" => "color"
					),
					array(
						"name" => __("Text Field Color",'theme_admin'),
						"desc" => "",
						"id" => "input_text",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("Milestone Number Color",'theme_admin'),
						"desc" => "",
						"id" => "milestone_number_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Milestone Icon Number Color",'theme_admin'),
						"desc" => "",
						"id" => "milestone_icon_number_color",
						"default" => "#444444",
						"type" => "color"
					),
					array(
						"name" => __("Milestone Subject Color",'theme_admin'),
						"desc" => "",
						"id" => "milestone_subject_color",
						"default" => "#666666",
						"type" => "color"
					),
					array(
						"name" => __("Milestone Icon Color",'theme_admin'),
						"desc" => "",
						"id" => "milestone_icon_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Toggle Icon Color",'theme_admin'),
						"desc" => "",
						"id" => "toggle_icon_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Carousel Title Color",'theme_admin'),
						"desc" => "",
						"id" => "carousel_title_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Carousel Nav Color",'theme_admin'),
						"desc" => "",
						"id" => "carousel_nav_color",
						"default" => "#b8b8b8",
						"type" => "color"
					),
					array(
						"name" => __("Carousel Nav Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "carousel_nav_active_color",
						"default" => "#8d8d8d",
						"type" => "color"
					),
					array(
						"name" => __("Icon Color",'theme_admin'),
						"desc" => "",
						"id" => "iconfont_color",
						"default" => "#8d8d8d",
						"type" => "color"
					),
					array(
						"name" => __("Icon Font Background Color",'theme_admin'),
						"desc" => "",
						"id" => "iconfont_bg_color",
						"default" => "transparent",
						"type" => "color"
					),
					array(
						"name" => __("Icon Font Border Color",'theme_admin'),
						"desc" => "",
						"id" => "iconfont_border_color",
						"default" => "#e5e5e5",
						"type" => "color"
					),
					array(
						"name" => __("Icon Font Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "iconfont_active_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Icon Font Hover Background Color",'theme_admin'),
						"desc" => "",
						"id" => "iconfont_active_bg_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Icon Font Hover Border Color",'theme_admin'),
						"desc" => "",
						"id" => "iconfont_active_border_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Icon Box Icon Color",'theme_admin'),
						"desc" => "",
						"id" => "iconbox_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Process Step Icon Color",'theme_admin'),
						"desc" => "",
						"id" => "process_step_icon_color",
						"default" => "#AAAAAA",
						"type" => "color"
					),
					array(
						"name" => __("Process Step Icon Background Color",'theme_admin'),
						"desc" => "",
						"id" => "process_step_icon_bg_color",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Process Step Icon Border Color",'theme_admin'),
						"desc" => "",
						"id" => "process_step_border_color",
						"default" => "#e5e5e5",
						"type" => "color"
					),
					array(
						"name" => __("Process Step Icon Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "process_step_icon_active_color",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Process Step Icon Hover Background Color",'theme_admin'),
						"desc" => "",
						"id" => "process_step_icon_active_bg_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Process Step Icon Hover Border Color",'theme_admin'),
						"desc" => "",
						"id" => "process_step_active_border_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Masonry Title Color",'theme_admin'),
						"desc" => "",
						"id" => "masonry_title_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Masonry Desc Color",'theme_admin'),
						"desc" => "",
						"id" => "masonry_desc_color",
						"default" => "#777777",
						"type" => "color"
					),
					array(
						"name" => __("Masonry Overlay Background Color",'theme_admin'),
						"desc" => "",
						"id" => "masonry_overlay_bg_color",
						"default" => "#000000",
						"type" => "color"
					),
					array(
						"name" => __("Masonry Overlay Icon Color",'theme_admin'),
						"desc" => "",
						"id" => "masonry_overlay_icon_color",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Progress Text Color",'theme_admin'),
						"id" => "progress_text_color",
						"default" => "#ffffff",
						"type" => "color",
						"format" => 'hex',
					),
					array(
						"name" => __("Progress Bar Color",'theme_admin'),
						"id" => "progress_bar_color",
						"default" => "",
						"type" => "color",
						"format" => 'hex',
					),
					array(
						"name" => __("Progress Track Color",'theme_admin'),
						"id" => "progress_track_color",
						"default" => "#e5e5e5",
						"type" => "color",
						"format" => 'hex',
					),
					array(
						"name" => __("Pie Progress Icon Color",'theme_admin'),
						"id" => "pie_progress_icon_color",
						"default" => "#bbbbbb",
						"type" => "color",
						"format" => 'hex',
					),
					array(
						"name" => __("Pie Progress Bar Color",'theme_admin'),
						"id" => "pie_progress_bar_color",
						"default" => "",
						"type" => "color",
						"format" => 'hex',
					),
					array(
						"name" => __("Pie Progress Track Color",'theme_admin'),
						"id" => "pie_progress_track_color",
						"default" => "#e5e5e5",
						"type" => "color",
						"format" => 'hex',
					),
				),
			),
			array(
				"slug" => 'blog',
				"name" => __("Blog Specific Elements ",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Blog Post Title Color",'theme_admin'),
						"desc" => "",
						"id" => "entry_title",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("Blog Post Title Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "entry_title_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Blog Meta Link Color",'theme_admin'),
						"desc" => "",
						"id" => "blog_meta_link",
						"default" => "#666666",
						"type" => "color"
					),
					array(
						"name" => __("Blog Meta Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "blog_meta_link_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Blog Read More Button Background Color",'theme_admin'),
						"id" => "read_more_bg",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("Blog Read More Button Text Color",'theme_admin'),
						"id" => "read_more_text",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Blog Read More Button Hover Background Color",'theme_admin'),
						"id" => "read_more_active_bg",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("Blog Read More Button Hover Text Color",'theme_admin'),
						"id" => "read_more_active_text",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Blog Frame Background Color",'theme_admin'),
						"id" => "blog_frame_bg",
						"default" => '',
						"type" => "color"
					),
					array(
						"name" => __("Blog Frame Border Color",'theme_admin'),
						"id" => "blog_frame_border_color",
						"default" => '',
						"type" => "color"
					),
					array(
						"name" => __("Blog Divider Line Color",'theme_admin'),
						"id" => "blog_divider_color",
						"default" => '',
						"type" => "color"
					),
				),
			),
			array(
				"slug" => 'portfolio',
				"name" => __("Portfolio Specific Elements",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Portfolio Sortable Header Background Color",'theme_admin'),
						"desc" => "",
						"id" => "portfolio_header_bg",
						"default" => "#eeeeee",
						"type" => "color"
					),
					array(
						"name" => __("Portfolio Sortable Header Text Color",'theme_admin'),
						"desc" => "",
						"id" => "portfolio_header_text",
						"default" => "#666666",
						"type" => "color"
					),
					array(
						"name" => __("Portfolio Sortable Header Hover Background Color",'theme_admin'),
						"desc" => "",
						"id" => "portfolio_header_active_bg",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Portfolio Sortable Header Hover Text Color",'theme_admin'),
						"desc" => "",
						"id" => "portfolio_header_active_text",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Portfolio Title Text Color",'theme_admin'),
						"desc" => "",
						"id" => "portfolio_title",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("Portfolio Read More Button Background Color",'theme_admin'),
						"id" => "portfolio_read_more_bg",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("Portfolio Read More Button Text Color",'theme_admin'),
						"id" => "portfolio_read_more_text",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Portfolio Read More Button Hover Background Color",'theme_admin'),
						"id" => "portfolio_read_more_active_bg",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("Portfolio Read More Button Hover Text Color",'theme_admin'),
						"id" => "portfolio_read_more_active_text",
						"default" => "#ffffff",
						"type" => "color"
					),
				),
			),
			array(
				"slug" => 'scrolltop',
				"name" => __("Scroll to Top Button",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Scroll to Top Square Type Background Color",'theme_admin'),
						"desc" => "",
						"id" => "scroll_to_top_bg",
						"default" => "#555555",
						"type" => "color"
					),
					array(
						"name" => __("Scroll to Top Square Type Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "scroll_to_top_hover",
						"default" => "#eeeeee",
						"type" => "color"
					),
				),
			),
			array(
				"slug" => 'tabs',
				"name" => __("Tab & Accordion Color Options",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Tab Border Line Color",'theme_admin'),
						"desc" => "",
						"id" => "tab_border",
						"default" => "#e5e5e5",
						"type" => "color"
					),
					array(
						"name" => __("Tab Inner Highlight Line Color",'theme_admin'),
						"desc" => "",
						"id" => "tab_inner",
						"default" => "transparent",
						"type" => "color"
					),
					array(
						"name" => __("Tab Title Bg Color",'theme_admin'),
						"desc" => "",
						"id" => "tab_bg",
						"default" => "#fafafa",
						"type" => "color"
					),
					array(
						"name" => __("Tab Title Text Color",'theme_admin'),
						"desc" => "",
						"id" => "tab_text",
						"default" => "#777777",
						"type" => "color"
					),
					array(
						"name" => __("Tab Current Bg Color",'theme_admin'),
						"desc" => "",
						"id" => "tab_current_bg",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Tab Current Text Color",'theme_admin'),
						"desc" => "",
						"id" => "tab_current_text",
						"default" => "#444444",
						"type" => "color"
					),
					array(
						"name" => __("Tab Content Bg Color",'theme_admin'),
						"desc" => "",
						"id" => "tab_content_bg",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Tab Content Text Color",'theme_admin'),
						"desc" => "",
						"id" => "tab_content_text",
						"default" => "#333333",
						"type" => "color"
					),
					array(
						"name" => __("MiniTab Border Line Color",'theme_admin'),
						"desc" => "",
						"id" => "minitab_border",
						"default" => "#e5e5e5",
						"type" => "color"
					),
					array(
						"name" => __("MiniTab Inner highlight Line Color",'theme_admin'),
						"desc" => "",
						"id" => "minitab_inner",
						"default" => "transparent",
						"type" => "color"
					),
					array(
						"name" => __("MiniTab Title Bg Color",'theme_admin'),
						"desc" => "",
						"id" => "minitab_bg",
						"default" => "#fafafa",
						"type" => "color"
					),
					array(
						"name" => __("MiniTab Title Text Color",'theme_admin'),
						"desc" => "",
						"id" => "minitab_text",
						"default" => "#777777",
						"type" => "color"
					),
					array(
						"name" => __("MiniTab Current Bg Color",'theme_admin'),
						"desc" => "",
						"id" => "minitab_current_bg",
						"default" => "#fefefe",
						"type" => "color"
					),
					array(
						"name" => __("MiniTab Current Text Color",'theme_admin'),
						"desc" => "",
						"id" => "minitab_current_text",
						"default" => "#444444",
						"type" => "color"
					),
					array(
						"name" => __("Vertical Tab Border Line Color",'theme_admin'),
						"desc" => "",
						"id" => "verticaltab_border",
						"default" => "#e5e5e5",
						"type" => "color"
					),
					array(
						"name" => __("Vertical Tab Inner highlight Line Color",'theme_admin'),
						"desc" => "",
						"id" => "verticaltab_inner",
						"default" => "transparent",
						"type" => "color"
					),
					array(
						"name" => __("Vertical Tab Title Bg Color",'theme_admin'),
						"desc" => "",
						"id" => "verticaltab_bg",
						"default" => "#fafafa",
						"type" => "color"
					),
					array(
						"name" => __("Vertical Tab Title Text Color",'theme_admin'),
						"desc" => "",
						"id" => "verticaltab_text",
						"default" => "#777777",
						"type" => "color"
					),
					// array(
					// 	"name" => __("Vertical Tab Current Bg Color",'theme_admin'),
					// 	"desc" => "",
					// 	"id" => "verticaltab_current_bg",
					// 	"default" => "#ffffff",
					// 	"type" => "color"
					// ),
					array(
						"name" => __("Vertical Tab Current Text Color",'theme_admin'),
						"desc" => "",
						"id" => "verticaltab_current_text",
						"default" => "#444444",
						"type" => "color"
					),
					array(
						"name" => __("Accordion Border Line Color",'theme_admin'),
						"desc" => "",
						"id" => "accordion_border",
						"default" => "#e5e5e5",
						"type" => "color"
					),
					array(
						"name" => __("Accordion Inner highlight Line Color",'theme_admin'),
						"desc" => "",
						"id" => "accordion_inner",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Accordion Title Bg Color",'theme_admin'),
						"desc" => "",
						"id" => "accordion_bg",
						"default" => "#fafafa",
						"type" => "color"
					),
					array(
						"name" => __("Accordion Title Text Color",'theme_admin'),
						"desc" => "",
						"id" => "accordion_text",
						"default" => "#777777",
						"type" => "color"
					),
					array(
						"name" => __("Accordion Current Bg Color",'theme_admin'),
						"desc" => "",
						"id" => "accordion_current_bg",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Accordion Current Text Color",'theme_admin'),
						"desc" => "",
						"id" => "accordion_current_text",
						"default" => "#444444",
						"type" => "color"
					),
				),
			),
			array(
				"slug" => 'footer',
				"name" => __("Footer Elements",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Footer Text Color",'theme_admin'),
						"desc" => "",
						"id" => "footer_text",
						"default" => "#e5e5e5",
						"type" => "color"
					),
					array(
						"name" => __("Footer Widget Title Color",'theme_admin'),
						"desc" => "",
						"id" => "footer_title",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Footer Link Color",'theme_admin'),
						"desc" => "",
						"id" => "footer_link",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Footer Link Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "footer_link_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Copyright Text Color",'theme_admin'),
						"desc" => "",
						"id" => "copyright",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Footer Menu Text Color",'theme_admin'),
						"desc" => "",
						"id" => "footer_menu",
						"default" => "#ffffff",
						"type" => "color"
					),
					array(
						"name" => __("Footer Menu Hover Color",'theme_admin'),
						"desc" => "",
						"id" => "footer_menu_active",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Footer Text Field Color",'theme_admin'),
						"desc" => "",
						"id" => "footer_text_field_color",
						"default" => "#ffffff",
						"type" => "color"
					),
				),
			),
		);
		return $options;
	}
}
