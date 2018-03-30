<?php
class Theme_Metabox_PageGeneral extends Theme_Metabox_With_Tabs {
	public $slug = 'page_general';
	public function config(){
		return array(
			'title' => __('Page General Options','theme_admin'),
			'post_types' => theme_get_option('advanced','page_general'),
			'callback' => '',
			'context' => 'normal',
			'priority' => 'high',
		);
	}

	public function tabs(){
		$options =  array(
			array(
				"name" => __("General Page Setup",'theme_admin'),
				"options" => array(
					array(
						"name" => __(" Change the Post Layout",'theme_admin'),
						"desc" => __("There is a default setting for the blog and portfolio post layouts in their respective MultiFlex Panels (Single Post resource tabs). &nbsp;Use this setting when you wish to use an alternate layout for a post.",'theme_admin'),
						"id" => "_layout",
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
						"name" => __("Breadcrumbs Visibility",'theme_admin'),
						"desc" => __('This setting provides the ability to control the visibility of breadcrumbs on this specific page/post.&nbsp;&nbsp;It is a tri-toggle selector, and the &#34;ON&#34; and &#34;OFF&#34; options in the tri-toggle act the opposite of the theme wide breadcrumbs setting found at <b>General Panel/General Page Layout Settings/Disable Breadcrumbs Site Wide Setting</b>. &nbsp;For example, if one has set breadcrumbs to display in the site, and does not want breadcrumbs to display on this page/post, set the tri-toggle to &#34;OFF&#34;.&nbsp;&nbsp;The default position is that this page level setting will mimic the theme setting for breadcrumbs.','theme_admin'),
						"id" => "_breadcrumb",
						"label" => "Check to disable breadcrumbs on this post",
						"default" => "",
						"type" => "tritoggle"
					),
					array(
						"name" => __("Sticky Footer",'theme_admin'),
						"desc" => __("<p>This setting provides the ability to control the sticky footer function on this specific page/post.&nbsp;&nbsp;It is a tri-toggle selector, and the &#34;ON&#34; and &#34;OFF&#34; options in the tri-toggle act the opposite of the theme wide sticky footer setting found at <b>Footer Panel / Footer General Settings / Sticky Footer Setting</b>. &nbsp;For example, if one sticky footer off for the site (typical in a site where all of the pages have substantial content), and needs it for this page, set the tri-toggle to &#34;ON&#34;.</p><p><I>REMINDER:</I> &nbsp;&nbsp; The sticky footer attaches the footer area to the bottom of the screen when total page content is less then screen height.&nbsp;&nbsp;Otherwise, in Wordpress, the footer floats up to the middle of the page.</p>",'theme_admin'),
						"id" => "_sticky_footer",
						"default" => "",
						"type" => "tritoggle"
					),
					array(
						"name" => __("Set a Custom Sidebar",'theme_admin'),
						"desc" => __("<p>This setting enables a custom sidebar as the default sidebar for this page&rsquo;s sidebar area. &nbsp;One first has to create a custom sidebar in Sidebar option panel and then populate it with widgets in the widget panel before it will show any content when viewing the webpage. </p><p> <i>NOTE:</i>&nbsp;&nbsp; If one has created a custom sidebar in the theme Sidebar panel and assigned it as the default sidebar for pages, or posts, one will have to go to every page created prior to creation of the custom sidebar and assign the sidebar manually using this setting.  &nbsp;&nbsp;The automatic assigment only works for pages created subsequent to the creation of the custom sidebar.</p>",'theme_admin'),
						"id" => "_sidebar",
						"prompt" => __("Choose one..",'theme_admin'),
						"default" => theme_get_sidebar_default(),
						"options" => theme_get_sidebar_options(),
						"type" => "select",
					),
					array(
						"name" => __("Footer Display",'theme_admin'),
						"desc" => __('If you don&#180;t want display footer, switch to &#34;OFF&#34; to disable.','theme_admin'),
						"id" => "_footer",
						"label" => "Check to disable footer on this webpage",
						"default" => "",
						"type" => "tritoggle"
					),		
					array(
						"name" => __("Sub Footer Display",'theme_admin'),
						"desc" => __('If you don&#180;t want display the sub footer, switch to &#34;OFF&#34; to disable','theme_admin'),
						"id" => "_subfooter",
						"label" => "Check to disable subfooter on this webpage",
						"default" => "",
						"type" => "tritoggle"
					),						
				),
			),
			array(
				"name" => __("Feature Header Settings",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Feature Header Type",'theme_admin'),
						"desc" => __("This setting allows you to determine the appearence of the Feature Header per webpage.  There are 8 possible setttings, including a custom content option where neither the page title or a slideshow are automatically filtered into it, and instead it shows entirely customized content, which is created in the <i>Custom Content</i> setting below (there is a wp editor including option buttons in the setting).<br /><br />The <i>Default</i> option shows the page title, and if you choose one of the other options, use the settings below to create the titles, content, and slideshow source & type. The final option is to completely remove the feature header area.",'theme_admin'),
						"id" => "_introduce_text_type",
						"options" => array(
							"default" => "Default",
							"title" => "Custom Title only",
							"custom" => "Custom Content only",
							"title_custom" => "Custom Title & Custom Content",
							"slideshow" => "SlideShow",
							"title_slideshow" => "Custom Title & SlideShow",
							"custom_slideshow" => "Custom Content & SlideShow",
							"disable" => "Turn Off and Remove the Feature Header Area",
						),
						"default" => "default",
						"type" => "radios"
					),
					array(
						"name" => __("Feature Header Custom Title",'theme_admin'),
						"desc" => __('Use this setting to create a custom heading in the feature header area.','theme_admin'),
						"id" => "_custom_title",
						"default" => "",
						"class" => 'full',
						"htmlspecialchars" => true,
						"type" => "text"
					),
					array(
						"name" => __("Feature Header Custom Content",'theme_admin'),
						"desc" => __('This setting allows you to create your own content to go within the feature header area. &nbsp;The editor below is the standard wp editor, including option buttons, and the theme shortcode generator.<br /><br />Everything that can be done in the regular webpage content area can also be done in the feature header when in custom content mode. &nbsp;Layouts and columns, images, shortcoded sliders, text and all other shortcodes can be combined to display whatever desired in this area.','theme_admin'),
						"id" => "_custom_introduce_text",
						"rows" => "2",
						"default" => "",
						"htmlspecialchars" => true,
						"type" => "editor",
						"settings" => array(
						),
					),
					array(
						"name" => __("Choose a SlideShow Source",'theme_admin'),
						"desc" => __("Select which Slidershow Source to use. &nbsp;This setting is only applicable if you chose one of the 3 Feature Header Type options which includes displaying the slideshow.<br /><br />The slideshow source options for all sliders other then the Revolution Slider (which are set in the plugin itself) are Self Gallery, Slideshow, Blog and Portfolio Categories.",'theme_admin'),
						"id" => "_slideshow_category",
						"default" => "{s}",
						"options" => array(
							"g" => __('Self Gallery','theme_admin'),
						),
						"chosen" => true,
						"chosen_order" => true,
						"prompt" => __("Select Source..",'theme_admin'),
						"function" => "theme_slideshow_category",
						'target' => 'slideshow_source',
						'process' => 'theme_slidershow_source_process',
						'prepare' => 'theme_slidershow_source_prepare',
						"type" => "multiselect"
					),
					array(
						"name" => __("SlideShow Number",'theme_admin'),
						"desc" => __("Number of Slides to display. If left at &#34;0&#34; it will display all the slides in the category (max 20) so &#34;0&#34; is the default value for &#34;All&#34;.",'theme_admin'),
						"id" => "_slideshow_number",
						"min" => "0",
						"max" => "20",
						"step" => "1",
						"default" => "0",
						"type" => "range"
					),
					array(
						"name" => __("SlideShow Type",'theme_admin'),
						"desc" => __("Select which slider type to use. &nbsp;If you have created custom presets for a slider, they will all show in this selector.<br /><br />Part of the Revolution Slider plugin integration is that it is also filtered into this setting.  &nbsp;So if you have created a slideshow in the plugin, select Revolution Slider in the field below, and then go down to the next setting and choose the specific Revolution Slider you wish to display.",'theme_admin'),
						"id" => "__slideshow_type",
						"default" => 'nivo_default',
						"chosen" => true,
						"chosen_order" => true,
						"prompt" => __("Select Type..",'theme_admin'),
						'target' => 'slideshow_type',
						"type" => "select",
					),
					array(
						"name" => __("Revolution Sliders",'theme_admin'),
						"desc" => __("Select which Revolution Sliders to show. &nbsp;You create these in the Revolution Slider Plugin pages.",'theme_admin'),
						"id" => "_slideshow_rev",
						"type" => "select",
						"prompt" => __("Select Sliders..",'theme_admin'),
						"default" => '',
						'target' => 'revslider',
					),
				),
			),
			array(
				"name" => __("Page Design Settings",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Header Background Color",'theme_admin'),
						"desc" => __("If you specify a color below, this will override the global configuration. Set empty to disable this.",'theme_admin'),
						"id" => "_header_background_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Feature Header Title Color",'theme_admin'),
						"desc" => __("If you specify a color below, this will override the global configuration. Set empty to disable this.",'theme_admin'),
						"id" => "_feature_title_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Feature Header Custom Text Color",'theme_admin'),
						"desc" => __("If you specify a color below, this will override the global configuration. Set empty to disable this.",'theme_admin'),
						"id" => "_feature_introduce_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Feature Header Background Color",'theme_admin'),
						"desc" => __("If you specify a color below, this will override the global configuration. Set empty to disable this.",'theme_admin'),
						"id" => "_introduce_background_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page Background Color",'theme_admin'),
						"desc" => __("If you specify a color below, this will override the global configuration. Set empty to disable this.",'theme_admin'),
						"id" => "_page_background_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page Inner Background Color",'theme_admin'),
						"desc" => __("If you specify a color below, this will override the global configuration. Set empty to disable this.",'theme_admin'),
						"id" => "_page_inner_background_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Page Text Color",'theme_admin'),
						"desc" => __("If you specify a color below, this will override the global configuration. Set empty to disable this.",'theme_admin'),
						"id" => "_page_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Footer Background Color",'theme_admin'),
						"desc" => __("If you specify a color below, this will override the global configuration. Set empty to disable this.",'theme_admin'),
						"id" => "_footer_background_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Footer Text Color",'theme_admin'),
						"desc" => __("If you specify a color below, this will override the global configuration. Set empty to disable this.",'theme_admin'),
						"id" => "_footer_color",
						"default" => "",
						"type" => "color"
					),
					array(
						"name" => __("Footer Widget Title Color",'theme_admin'),
						"desc" => __("If you specify a color below, this will override the global configuration. Set empty to disable this.",'theme_admin'),
						"id" => "_footer_title_color",
						"default" => "",
						"type" => "color"
					),
				),
			),
			array(
				"name" => __("Background Settings",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Feature Header Background Custom Image",'theme_admin'),
						"id" => "_feature_background_image",
						"default" => "",
						"type" => "upload"
					),
					array(
						"name" => __("Feature Header Background Position X",'theme_admin'),
						"desc" => "",
						"id" => "_feature_background_position_x",
						"default" => 'center',
						"options" => array(
							"left" => __('Left','theme_admin'),
							"center" => __('Center','theme_admin'),
							"right" => __('Right','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Feature Header Background Position Y",'theme_admin'),
						"desc" => "",
						"id" => "_feature_background_position_y",
						"default" => 'top',
						"options" => array(				
							"top" => __('Top','theme_admin'),
							"center" => __('Center','theme_admin'),
							"bottom" => __('Bottom','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Feature Header Background Repeat",'theme_admin'),
						"desc" => "",
						"id" => "_feature_background_repeat",
						"default" => 'no-repeat',
						"options" => array(
							"no-repeat" => __('No Repeat','theme_admin'),
							"repeat" => __('Tile','theme_admin'),
							"repeat-x" => __('Tile Horizontally','theme_admin'),
							"repeat-y" => __('Tile Vertically','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Feature Header Background Attachment",'theme_admin'),
						"desc" => "",
						"id" => "_feature_background_attachment",
						"default" => 'scroll',
						"options" => array(
							"scroll" => __('Scroll','theme_admin'),
							"fixed" => __('Fixed','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Feature Header Background Size",'theme_admin'),
						"id" => "_feature_background_size",
						"default" => '100% auto',
						"options" => array(
							"auto" => __('auto','theme_admin'),
							"100% auto" => __('100% auto','theme_admin'),
							"cover" => __('cover','theme_admin'),
							"contain" => __('contain','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Body/Header/Page/Footer Background Custom Image",'theme_admin'),
						"desc" => __("This setting enables the placement of a background image in one of the other page sections, either the body, header, page or footer.  It can only be used once in a webpage.",'theme_admin'),
						"id" => "_page_background_image",
						"default" => "",
						"type" => "upload"
					),
					array(
						"name" => __("Target Container",'theme_admin'),
						"desc" => "",
						"id" => "_page_background_target",
						"default" => '#page',
						"options" => array(
							"body" => __('Body','theme_admin'),
							"#header" => __('Header','theme_admin'),
							"#page" => __('Page','theme_admin'),
							"#footer" => __('Footer','theme_admin'),
							),
						"type" => "select",
						),
					array(
						"name" => __("Background Position X",'theme_admin'),
						"desc" => "",
						"id" => "_page_background_position_x",
						"default" => 'center',
						"options" => array(
							"left" => __('Left','theme_admin'),
							"center" => __('Center','theme_admin'),
							"right" => __('Right','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Background Position Y",'theme_admin'),
						"desc" => "",
						"id" => "_page_background_position_y",
						"default" => 'top',
						"options" => array(				
							"top" => __('Top','theme_admin'),
							"center" => __('Center','theme_admin'),
							"bottom" => __('Bottom','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Background Repeat",'theme_admin'),
						"desc" => "",
						"id" => "_page_background_repeat",
						"default" => 'no-repeat',
						"options" => array(
							"no-repeat" => __('No Repeat','theme_admin'),
							"repeat" => __('Tile','theme_admin'),
							"repeat-x" => __('Tile Horizontally','theme_admin'),
							"repeat-y" => __('Tile Vertically','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Background Attachment",'theme_admin'),
						"desc" => "",
						"id" => "_page_background_attachment",
						"default" => 'scroll',
						"options" => array(
							"scroll" => __('Scroll','theme_admin'),
							"fixed" => __('Fixed','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Background Size",'theme_admin'),
						"id" => "_page_background_size",
						"default" => '100% auto',
						"options" => array(
							"auto" => __('auto','theme_admin'),
							"100% auto" => __('100% auto','theme_admin'),
							"cover" => __('cover','theme_admin'),
							"contain" => __('contain','theme_admin'),
						),
						"type" => "select",
					),
				),
			),						
			array(
				"name" => __("CSS & JavaScript Settings",'theme_admin'),
				"options" => array(

					array(
						"name" => __("Custom CSS",'theme_admin'),
						"desc" => __("This field is where one can post any custom css to override the default css of the theme.&nbsp;&nbsp;The Striking default css is found in the screen.css file in the CSS folder (Striking/CSS/screen.css) and you can open that file with an editor such as Notepad ++ or Dreamweaver to review it. &nbsp;&nbsp;One can also use browser tools such as Firebug and Web Developer to detect all the individual code elements of a webpage, and these tools allow for live editing > you can take that custom code from the live editing and paste it in this field to duplicate the effect achieved.",'theme_admin'),	
						"id" => "_custom_css",
						"default" => "",
						'rows' => '10',
						"type" => "textarea"
					),
					array(
						"name" => __("Custom JS",'theme_admin'),
						"desc" => sprintf(__('This field has the same type of ability as the above CSS field, and again code in here is stored in the database, and unaffected by theme updates. The code input here will display on the footer of the page. Sample: <br/><code>&lt;script type=&quot;text/javascript&quot; src=&quot;%s/wp-content/themes/striking/js/yourscript.js&quot;&gt;&lt;/script&gt;</code><br/>
<code>&lt;script type=&quot;text/javascript&quot;&gt;alert("hello world");&lt;/script&gt;</code>','theme_admin'),get_option('siteurl')),
						"id" => "_custom_js",
						"default" => "",
						'rows' => '10',
						"type" => "textarea"
					),					
				),
			),			
		);

		return $options;
	}
}
