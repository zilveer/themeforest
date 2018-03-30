<?php
class Theme_Options_Page_Font extends Theme_Options_Page_With_Tabs {
	public $slug = 'font';
	public $cufon_fonts = false;
	public $fontface_fonts = false;

	function __construct(){
		if(isset($_GET['page']) && $_GET['page']=='theme_font'){
			add_filter('admin_head', array(&$this, 'add_scripts'));
		}
		$this->name = __('Font Settings','theme_admin');
		parent::__construct();
	}
	function add_scripts(){
		$http = (!empty($_SERVER['HTTPS'])) ? "https" : "http";
		wp_enqueue_script('WebFont',$http.'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js');
		wp_enqueue_script( 'cufon-yui', THEME_JS .'/cufon-yui.js');

		$fontface_string_array = array();
		$fontface_fonts = $this->get_fontface_fonts();
		if(!empty($fontface_fonts)){
			foreach($fontface_fonts as $value => $font){
				$fontface_string_array[$value] = '"'.$value.'":{name:"'.$font['name'].'",url:"'. $font['url'] .'"}';
			}
		}
		$fontface_string = implode(",",$fontface_string_array);

		$cufon_string_array = array();
		$cufon_fonts = $this->get_cufon_fonts();
		if(!empty($cufon_fonts)){
			foreach($cufon_fonts as $value => $font){
				$cufon_string_array[$value] = '"'.$value.'":{name:"'.$font['font_name'].'",url:"'. $font['url'] .'"}';
			}
		}
		$cufon_string = implode(",",$cufon_string_array);

		$fontface_used = theme_get_option_from_db('font','fontface_used');
		$fontface_used_url_array = array();
		$fontface_used_url_list = '[]';
		if(!empty($fontface_used)){
			foreach($fontface_used as $value){
				$font = $this->get_fontface_font($value);
				$fontface_used_url_array[] = "'".$font['url']."'";
			}
			$fontface_used_url_list = '['.implode(',', $fontface_used_url_array).']';
		}
		
		$cufon_used = theme_get_option_from_db('font','cufon_used');
		if(!empty($cufon_used)){
			foreach($cufon_used as $value){
				$font = $this->get_cufon_font($value);
				wp_enqueue_script($font['file_name'], $font['url'], array('cufon-yui'));
			}
		}
		

		$gfont_used = theme_get_option_from_db('font','gfont_used');
		$gfont_used_array = array();
		$gfont_used_list = '[]';
		if(!empty($gfont_used)){
			foreach($gfont_used as $value){
				$gfont_used_array[] = "'".$value."'";
			}
			$gfont_used_list = '['.implode(',', $gfont_used_array).']';
		}
		echo <<<SCRIPTS
<script>
var fontface_list = {
	{$fontface_string}
};
var cufon_list = {
	{$cufon_string}
};
var fontface_used_url_list = {$fontface_used_url_list};
var gfont_used_list = {$gfont_used_list};
jQuery(document).ready(function($) {
	jQuery.each(fontface_used_url_list,function(i,url){
		var wf = document.createElement("link");
		wf.href = url;
		wf.rel = "stylesheet";
		wf.type = "text/css";
		wf.async = "true";
		var s = document.getElementsByTagName("style")[0];
		s.parentNode.insertBefore(wf, s);
	});
	
	if(gfont_used_list.length != 0){
		WebFont.load({
			google: {
				families: gfont_used_list
			}
		});
	}
	
	jQuery(document).on('change','.toggle-default',function(){
		if(jQuery(this).is(':checked')){
			jQuery(this).closest('li').siblings().find('.toggle-default:checked').attr('checked', false).trigger('change');
		}
	});
	jQuery('.theme-font-cufon-preview').each(function(){
		var font = $(this).attr('data-font');
		Cufon.replace(this,{fontFamily: font});
	});
});
</script>
SCRIPTS;
	}
	function tabs(){
		$options = array(
			array(
				"slug" => 'general',
				"name" => __("General Settings",'theme_admin'),
				"desc" => sprintf(__("<h3>INTRODUCTION</h3>
<p>Striking MultiFlex has unparalleled choice of font display options for a website with approx 840 different fonts plus 400+ icons available via 5 different typography technologies: <br />
<br />
<b>1)</b> 9 Standard Web Fonts including Serif, Sans-Serif and Monospace fonts for use as the base body and descriptive font.<br />
<b>2)</b> 45 Cufon Font for use in custom & descriptive text replacement.<br />
<b>3)</b> 45 @font-face fonts for use in custom & descriptive text replacement.<br />
<b>4)</b> 738 Google fonts for use in custom & descriptive text replacement.<br />
<b>5)</b> Font Awesome Icon set for use in Navigation & Sub-Navigation, Buttons, Tab & Accordion Titles and via shortcode for general content usage.</p>
<h3>USAGE</h3>
<p>In this <b>General Settings Resource Tab</b> is the <b>Site Font Family</b> setting which allows one to choose from 9 common web safe fonts to act as the base font for the website. &nbsp;One does not need to do anything further after selecting the base site font -> choosing another font(s) for custom or descriptive text replacement is optional and depends on the degree of customization and individuality desired for website appearence.</p>
<p>Descriptive Font Replacement refers to substituting the base font with another font for various headers & titles used throughout the website including the navigation & sub-navigation, h1 to h6 headers, blog titles, portfolio titles, widget titles, etc.</p>
<p>Each of the custom font tabs has settings which allow for the choice of activating one or more members of a custom font family (each font can be a &#34;family&#34; with normal weight, bold, semi-bold, italics, narrow, latin, etc and what is offered in the family differs for every single font), a field for custom css to selectively replace only specific descriptive types or other custom usage, and an &#34;All-in-One&#34; setting which if activated sets one weight of a a custom font family techonology to be active in replacing all descriptive text appearences in the website.</p>
<p>The <b>Font Size</b> tab and the Striking <a href='%1s' target='_blank'>Striking -> Color</a> Panel have between them over 75 settings for customizing the size and color of individual font elements such as H tags, all titles, slider caption and description text, tab, accordion and toggles, widget titles and much more.  &nbsp;Thus in Striking MultiFlex one has the widest font variety and options to customize font usage in a website and most customization is easily accomplished using theme settings with no knowledge necessary of css, html or code in order to achive a unique and interesting website appearence.</p>
<h3>NOTES ON EMPLOYING MULTIPLE FONTS </h3>
<p>Given all the font selections it is easy to get carried away with custom font usage! &nbsp;However, there are some matters of which to be aware. &nbsp;First is that the more fonts activated the more impact it will have on the loading of website pages. &nbsp;More fonts active equates to more scripting burden. &nbsp;The recommendation is that one should not employ more then 2-4 custom fonts at the same time for descriptive/custom font replacement in a website.</p>
<p>Secondly, this premium theme is a rarity in that it allows more then one font technology to be active simultaneously for custom & descriptive replacement, but be advised depending on matters such as plugins in use, custom js & php employed in your site, and your host php version and settings it can lead to unpredictable website behaviour. &nbsp;Unless you are an advanced wordpress user with in-depth code and troubleshooting knowledge, it is recommended not to employ more then one custom font technology for replacement and we must <u>advise that any issues that arise from employing multiple font techonologies for font replacement simultaneously are not part of free product support for this theme.</u></p>
<h3>FONT AWESOME ICON FONT SET</h3>
<p>Font Awesome is scalable vector icons that <em>&#34;can be customized for size, color, frame, and anything that can be done with the power of CSS.&#34;</em> &nbsp;The name &#34;Font Awesome&#34; is somewhat misleading, as it has nothing to do with base fonts or descriptive & custom text but rather is all about providing icons (symbols, pictures, etc) for use as eye-catching typography in a website. More detail on font awesome can be found at its home at: <a href='http://fortawesome.github.io/Font-Awesome/' target='_blank'>Github</a> which provides visual examples of all the icons in the set, as well as some custom usage examples.</p>
<p>As one might expect of Striking, the theme provides for very extensive usage of the icon set:<br />
<br />
<b>a)</b> &nbsp;it is integrated into the Custom Menu individual navigation styles so that one can display an icon alongside the navigation text for each navigation menu item via a selector;<br />
<b>b)</b> &nbsp;it is integrated into the shortcodes for buttons, tabs and accordions so that one can easily display an icon in a button, and in tab titles and accordion titles;<br />
<b>c)</b> &nbsp;in the shortcode button under the typography shortcode group is the shortcode &#34;Icon Font&#34; which provides for selecting and manipulating by coloring, sizing, rotating, spinning, framing, and more an icon which can be placed almost anywhere in content.</p>
<p>As font awesome usage requires loading another css file, there is a setting for activing its usage -> the <b>Font Icons Integration</b> setting is found below. &nbsp;The reason for the setting is so that if one is not employing font awesome in the website, one is not hit with the css file loading burden to the site scripting (it is fairly minimal but as they say in webdesign (and physics!) <em>&#34;Every nanosecond counts... :)&#34;</em>.</p>
<h3>DEFAULT ICON FONT SETS</h3>
<p>Striking MultiFlex also employs a variety of open source icon sets for use in the <b>Icon Text</b> and <b>Icon Link</b> shortcodes and for the icons used in the social media and contact widgets. &nbsp;One can also import new social media icon sets for use in the social media widget and the settings for using them are found in this widget.</p>", 'theme_admin'),admin_url( 'admin.php?page=theme_color&tab=header')),
				"options" => array(
					array(
						"name" => __("Site Font family",'theme_admin'),
						"desc" => __("<p>This dropdown contains a list of 9 standard web fonts that are the core fonts for Striking.&nbsp;&nbsp;Whichever font selected will be the font employed throughout the entire website for both body text and descriptive text (such as headers, navigation labels, post titles, etc).</p><p>In Striking, one has the alternative of using one of the many custom Cufon, Fontface or Google fonts supplied for either custom replacement of specific descriptive and/or body text by way of custom css, or by enabling the custom font fully across all descriptive text types via the setting for this purpose found in the tab for each custom font technology.</p><p>BE ADVISED THAT if one enables a custom font for descriptive text in a site, all body text types such as standard paragraph text, slider description text, widget body text, etc will still be in the standard font chosen here, unless one choose to replace the standard body font with via custom css.</p>",'theme_admin'),	
						"id" => "font_family",
						"default" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"options" => array(
							"Arial,Helvetica,Garuda,sans-serif" => 'Arial,Helvetica,Garuda,sans-serif',
							"'Arial Black',Gadget,sans-serif" => '"Arial Black",Gadget,sans-serif',
							"Verdana,Geneva,Kalimati,sans-serif" => 'Verdana,Geneva,Kalimati,sans-serif',
							"'Lucida Sans Unicode','Lucida Grande',Garuda,sans-serif" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
							"Georgia,'Nimbus Roman No9 L',serif" => 'Georgia,"Nimbus Roman No9 L",serif',
							"'Palatino Linotype','Book Antiqua',Palatino,FreeSerif,serif" => '"Palatino Linotype","Book Antiqua",Palatino,FreeSerif,serif',
							"Tahoma,Geneva,Kalimati,sans-serif" => 'Tahoma,Geneva,Kalimati,sans-serif',
							"'Trebuchet MS',Helvetica,Jamrul,sans-serif" => '"Trebuchet MS",Helvetica,Jamrul,sans-serif',
							"'Times New Roman',Times,FreeSerif,serif" => '"Times New Roman",Times,FreeSerif,serif',
						),
						"type" => "select",
					),
					array(
						"name" => __("Line Height",'theme_admin'),
						"desc" => __("<p>Normally one does not need to adjust this setting unless one sets the <b>Page Body Text Size</b> setting found in the <b>Font Size Settings Tab</b> to a size of 16px-18px or larger (depends on the font employed).  &nbsp;The default body text size is 12px which is the standard size employed on the web for body font.</p>",'theme_admin'),	
						"id" => "line_height",
						"min" => "12",
						"max" => "30",
						"step" => "1",
						"unit" => 'px',
						"default" => "20",
						"type" => "range"
					),
					array(
						"name" => __("Enable Underline on Hover over Weblinks",'theme_admin'),
						"desc" => __("<p>Enabling this setting will cause all web links listed in body text to be underlined when a cursor hovers over them.</p>",'theme_admin'),	
						"id" => "link_underline",
						"default" => false,
						"type" => "toggle"
					),
					array(
						'name' => __('Activate Font Icons Integration', 'theme_admin'),
						"desc" => __("<p>Enabling this setting will allow for the <b>Icon Text</b> shortcode and all custom font icon settings involving Font Awesome found in other shortcodes to work. &nbsp;As the font awesome set does require loading of icon specific css files in the site scripting the setting enables this to be avoided if one is not using these icons in the site typography.</p>
<p>Other then the requirement to load separate CSS files, the font awesome icon set code is fully integrated into the Striking core theme files and in fact the theme has one of the most complete integrations of the various font awesome abilities available anywhere.</p><p>NOTE that Striking also has several other open source font icon sets in use in some shortcodes and the social icons and contact widgets which are fully integrated into the theme core files and thus do not require separate activation; thus this setting has no involvement with those default icon sets -> they are already available the moment the theme was activated.</p>",'theme_admin'),
						'id' => 'icons',
						'default' => 'awesome',
						'options' => array(
							'' => __('None', 'theme_admin'),
							'awesome' => __('Font Awesome', 'theme_admin'),
						),
						'type' => 'select',
					),
				),
			),
			array(
				"slug" => 'size',
				"name" => __("Font Size Settings",'theme_admin'),
				"desc" => sprintf(__("<h3>INTRODUCTION</h3>
<p>MultiFlex includes 30 settings below for adjusting different text types to a desired font size in the website. &nbsp;These settings are applied to that text type site wide.  &nbsp;However, if on any particular page one desires a font size setting to be different then the site setting, one can add some custom css in the custom css field in the <b>Page General Options Metabox/Page Design Settings Tab</b> found below the wp content editor in any page or post being edited. &nbsp;A benefit of this particular custom css field is that any css placed into it affects only that page or post being edited.</p>
<h3>CORRESPONDING TEXT COLORS</h3>
<p>In Striking MultiFlex, all the text types below have a corresponding theme color setting which can found in the <a href='%s' target='_blank'>Color Panel.</a> part of the array of over 145 theme color settings (all optional to adjust from their defaults) allowing for a unique font size and color palette for each website.",'theme_admin'),admin_url( 'admin.php?page=theme_color')),			
				"options" => array(
					array(
						"name" => __("Body Text Size",'theme_admin'),
						"desc" => __("<p>Body text includes text in a page or post body, widget body, description text of a slider item, normal text variations such as bold, sub and superscript, emphasized, etc.</p>",'theme_admin'),	
						"id" => "page",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "12",
						"type" => "range"
					),
					array(
						"name" => __("Breadcrumbs Text Size",'theme_admin'),
						"desc" =>  sprintf(__("<p>Breadcrumbs are the small text appearing in the upper right hand corner of the body content area - ie, just below the feature header. &nbsp;A typical breadcrumb string on a page might be  &#34;Home >> Blog >> All-about-Striking&#34; and each item in the breadcrumbs string will be an active link.</p><p> &nbsp;Breadcrumbs may have a slight SEO benefit as well, depending on the search engine. &nbsp;If the appearence of breadcrumbs does not suit the design you desire for your site  they can be turned off using the <a href='%s' target='_blank'>General Panel / Site Breadcrumbs Visibility</a> setting.",'theme_admin'),admin_url( 'admin.php?page=theme_general&tab=page')),		
						"id" => "breadcrumbs",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "11",
						"type" => "range"
					),
					array(
						"name" => sprintf(__("%s Size",'theme_admin'),'H1'),
						"desc" => "",
						"id" => "h1",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "36",
						"type" => "range"
					),
					array(
						"name" => sprintf(__("%s Size",'theme_admin'),'H2'),
						"desc" => "",
						"id" => "h2",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "30",
						"type" => "range"
					),
					array(
						"name" =>  sprintf(__("%s Size",'theme_admin'),'H3'),
						"desc" => "",
						"id" => "h3",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "24",
						"type" => "range"
					),
					array(
						"name" =>  sprintf(__("%s Size",'theme_admin'),'H4'),
						"desc" => "",
						"id" => "h4",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "18",
						"type" => "range"
					),
					array(
						"name" =>  sprintf(__("%s Size",'theme_admin'),'H5'),
						"desc" => "",
						"id" => "h5",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "14",
						"type" => "range"
					),
					array(
						"name" =>  sprintf(__("%s Size",'theme_admin'),'H6'),
						"desc" => "",
						"id" => "h6",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "12",
						"type" => "range"
					),
					array(
						"name" => __("Blog Post List Title Size",'theme_admin'),
						"desc" => __("<p>Controls the font size of the post title in a blog list created by the blog shortcode or in the blog list on a non-static blog page.</p>",'theme_admin'),
						"id" => "entry_title",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "36",
						"type" => "range"
					),
					array(
						"name" => __("Portfolio Post List Title Size",'theme_admin'),
						"desc" => __("<p>Controls the font size of the portfolio title in a portfolio list created by the portfolio shortcode.</p>",'theme_admin'),
						"id" => "portfolio_title",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "24",
						"type" => "range"
					),
					array(
						"name" => __("Portfolio Post Excerpt Description Text Size",'theme_admin'),
						"desc" => __("<p>Controls the font size of the excerpt content in a post list created by the blog or portfolio shortcode.</p>",'theme_admin'),
						"id" => "portfolio_desc",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "12",
						"type" => "range"
					),
					array(
						"name" => __("Logo Text Size",'theme_admin'),
						"desc" =>  sprintf(__("<p>Unless one loads a custom logo using the <a href='%s' target='_blank'>General Panel / Set a Custom Logo</a> setting, the site name will appear in the right side of the header area in enlarged text, and this setting controls the size of that text. &nbsp;The default logo text size is 40px, which can be adjusted in a size range of 1px - 60px.",'theme_admin'),admin_url( 'admin.php?page=theme_general&tab=header')),
						"id" => "site_name",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "40",
						"type" => "range"
					),
					array(
						"name" => __("Logo Tagline Text Size",'theme_admin'),
						"desc" => __("<p>The tagline is a &#34;secondary&#34; line of text found immediately below (subservient to) the Logo Text and often displays a short slogan or other marketing oriented very brief text. &nbsp;The theme default tagline text size is 11px which can be adjusted in a size range of 1px - 60px.</p> ",'theme_admin'),	
						"id" => "site_description",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "11",
						"type" => "range"
					),
					array(
						"name" => __("Select Navigation Menu Text Size",'theme_admin'),
						"desc" => __("<p>Controls the font size of the navigation text once the mobile menu is in view.</p>",'theme_admin'),
						"id" => "nav2select",
						"min" => "10",
						"max" => "30",
						"step" => "1",
						"unit" => 'px',
						"default" => "16",
						"type" => "range"
					),
					array(
						"name" => __("Top Level Navigation Menu Text Size",'theme_admin'),
						"desc" => __("<p>&#34;Top Level Navigation Menu Text&#34; is the main navgation text visible in the header area such as &#34;Home&#34;, &#34;Blog&#34;, &#34;About Us&#34;, &#34;Contact&#34;, etc. &nbsp;The theme default size is 17px and can be adjusted in a size range of 1px - 60px.</p> ",'theme_admin'),	
						"id" => "menu_top",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "17",
						"type" => "range"
					),
					array(
						"name" => __("Top Level Navigation Menu Sub-Title Text Size",'theme_admin'),
						"desc" =>  sprintf(__("<p>A custom theme feature is the ability to have sub-title text for top level menu items. &nbsp;&nbsp;Sub-title text is activate by the <a href='%1s' target='_blank'>Top Level Navigation Subtitle Option setting</a> in the General Panel/Navigation Menu Options Tab. &nbsp;There is also another setting in that tab to set the alignment of the sub-title underneath the main navigation text. &nbsp;AS is the case for the other navigation text types, the static, current and hover colors can also be set for the sub-titles in the <a href='%2s' target='_blank'>Color Panel/Header Elements Tab.</a> &nbsp;The default size of the subnav text is 10px which can be adjusted in a size range of 1px - 20px.</p>",'theme_admin'),admin_url( 'admin.php?page=theme_general&tab=navigation'),admin_url( 'admin.php?page=theme_color&tab=header')),
						"id" => "menu_top_sub",
						"min" => "1",
						"max" => "20",
						"step" => "1",
						"unit" => 'px',
						"default" => "10",
						"type" => "range"
					),
					array(
						"name" => __("Sub Level Navigation Menu Text Size",'theme_admin'),
						"desc" => __("<p>&#34;Sub Level Navigation Menu Text&#34; refers to the child pages listings found below a main navigation heading. &nbsp;The theme default size is 14px and can be adjusted in a size range of 1px - 60px.</p> ",'theme_admin'),	
						"id" => "menu_sub",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "14",
						"type" => "range"
					),
					array(
						"name" => __("Feature Header Title Size",'theme_admin'),
						"desc" => __("<p>On any page or post where one has set the <b>Feature Header Type</b> to &#34;Default&#34; the page or post title will then appear in the feature header area and this setting determines the size of the title text. &nbsp;The theme default size is 42px (this title is akin to a super H1 text size and is H1 tags in the theme php code for SEO purposes) and can be adjusted in a size range of 1px - 60px.</p> ",'theme_admin'),	
						"id" => "feature_header",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "42",
						"type" => "range"
					),
					array(
						"name" => __("Feature Header Custom Text Size",'theme_admin'),
						"desc" => __("<p>On any page or post where one has set the <b>Feature Header Type</b> to &#34;Custom Title&#34; the text entered into the <b>Custom Title</b> setting field will then appear in the feature header area and this setting determines the size of tha custom title text. &nbsp;The theme default size is 21px and can be adjusted in a size range of 1px - 60px.</p> ",'theme_admin'),	
						"id" => "feature_introduce",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "21",
						"type" => "range"
					),
					array(
						"name" => __("Sidebar Widget Title Size",'theme_admin'),
						"desc" => "",
						"id" => "widget_title",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "24",
						"type" => "range"
					),
					array(
						"name" => __("Toggle Title Size",'theme_admin'),
						"desc" => "",
						"id" => "toggle_title",
						"min" => "0",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "0",
						"type" => "range"
					),
					array(
						"name" => __("Nivo Slider Caption Text Size",'theme_admin'),
						"desc" => "",
						"id" => "nivo_caption",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "16",
						"type" => "range"
					),
					array(
						"name" => __("Accordion Slider Caption Text Size",'theme_admin'),
						"desc" => "",	
						"id" => "kwick_title",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "16",
						"type" => "range"
					),
					array(
						"name" => __("Accordion Slider Description Text Size",'theme_admin'),
						"desc" => __("<p>This setting allows one to adjust the size of the text for the Accordion Slider description.",'theme_admin'),	
						"id" => "kwick_desc",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "12",
						"type" => "range"
					),
					array(
						"name" => __("Roundabout Slider Title Size",'theme_admin'),
						"desc" => "",
						"id" => "roundabout_title",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "24",
						"type" => "range"
					),
					array(
						"name" => __("Roundabout Slider Desc Text Size",'theme_admin'),
						"desc" => "",
						"id" => "roundabout_desc",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "12",
						"type" => "range"
					),
					array(
						"name" => __("Footer Widget Title Size",'theme_admin'),
						"desc" => "",
						"id" => "footer_title",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "24",
						"type" => "range"
					),
					array(
						"name" => __("Footer Widget Text Size",'theme_admin'),
						"desc" => "",
						"id" => "footer_text",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "12",
						"type" => "range"
					),
					array(
						"name" => __("Copyright Text Size",'theme_admin'),
						"desc" => "",
						"id" => "copyright",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "14",
						"type" => "range"
					),
					array(
						"name" => __("Sub-Footer Widget Area - Footer Menu Text Size",'theme_admin'),
						"desc" => __("<p>This font size sets the size of navigation labels if one has enable the sub footer widget area for Navigation and created a footer menu in the Custom Menu function. &nbsp;The theme default size is 12px and can be adjusted in a size range of 1px - 60px.</p>",'theme_admin'),	
						"id" => "footer_menu",
						"min" => "1",
						"max" => "60",
						"step" => "1",
						"unit" => 'px',
						"default" => "12",
						"type" => "range"
					),
				),
			),
			array(
				"slug" => 'cufon',
				"name" => __("Cufon Settings",'theme_admin'),
				"desc" => __("<h3>INTRODUCTION</h3>
<p>Cufon is a font-replacement technique that uses vector graphics and javascript to write custom fonts from a font file (TTF, OTF or PFB) to your browser. &nbsp;Cufon is a text replacement system, and thus any text that is styled using it will not be able to be copied into the clipboard. &nbsp;To learn more about Cufon visit the main cufon information page at <a href='http://github.com/sorccu/cufon/wiki/About' target='_blank'>Gibhub Cufon.</a> &nbsp;Many interesting free and paid variations of Cufon are available and Striking includes 45 unique Cufon fonts.</p><p>Cufon was very popular at its commencement in 2007 but the cufon javascript core has not been updated in almost 2 years resulting in it&#180;s use falling out of favour although many unique fonts are available only via Cufon. &nbsp;If one is finding a selected Cufon font is rendering slowly or with issues it is suggested that one consider the @fontface font technology for an alternative. &nbsp;One advantage of Cufon fonts is that they are easier to generate then @font-face font kits.</p>
<h3>CUFON DELAY</h3>
<p>Sometimes one will experience, depending on the browser, what is commonly known as the <em>Cufon Delay.</em> &nbsp;In this situation a page loads, and as one of the very last steps in the page loading process when java scripting typically take place, the process of replacing the web font with Cufon vectors is executed, sometimes with a visible effect and margin of delay. &nbsp; Should this occur and you dislike it, the choice is to select a different Cufon or other font type for use in your site.</p>
<h3>USING YOUR OWN CUFON FONT</h3>
<p>The cufon fonts that are provided in Striking contain only the Latin-1 character set. &nbsp;Special characters such as some currency symbols and alphabets such as the cyrillic alphabet, russian alphabet etc, will not show correctly. &nbspOne can create a custom cufon font to address special character and alphabet needs:<br /><br />
<b>1.</b> Visit this <a href='http://cufon.shoqolate.com/generate/' target='_blank'>Cufon Generation</a> website.<br />
<b>2.</b> The next step is to convert the desired font on your computer to Cufon. &nbsp;Fields are provided for selecting regular, bold and italic typefaces.<br />
<b>3.</b> In the Glyphs section choose which glyphs should be included. &nbsp;Choosing All is NOT recommended because the JS file size will increase dramatically. Choose glyphs wisely. &nbsp;The list below is the Striking selection:<br />
- Uppercase<br />
- Lowercase<br />
- Numerals<br />
- Punctuation<br />
- WordPress punctuation<br />
- Basic Latin<br />
- Latin-1 Supplement<br />
<b>4.</b> It is optional as to whether you specifiy a specific domain in the Security section, and the final two sections can be left at their default values. &nbsp;Accept the terms, click on the &#34;Let's Do This&#34; button and save the generated script.<br />
<b>5.</b> Upload the generated font.js file to /wp-content/themes/striking/fonts folder through your
FTP Client.<br />
<b>6.</b> Refresh the Striking -> Font panel, and in the <b>Choose Cufon Font</b> selector one should see the custom cufon font in the list.</p>
<h3>PAID SUPPORT FOR CUSTOM FONT GENERATION AND CUSTOM CSS REPLACEMENT</h3>
<p>On a paid basis the Striking development team can undertake custom cufon font generation as well as creating custom cufon replacement in a site. &nbsp;Contact a support team member via the Striking Support Forum for more information on this service.</p>",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Enable Cufon Font",'theme_admin'),
						"desc" => __("<p>The purpose of this setting is to enable the potential for Cufon with this setting - you are turning on Cufon, but not yet making it active in replacement of any text within the site. &nbsp;&nbsp;<b>VERY IMPORTANT - SAVE THE PANEL AFTER THIS STEP.  &nbsp;DO NOT PROCEED TO ANY OF THE OTHER SETTINGS UNTIL YOU HAVE SAVED THE FONT PANEL AFTER TOGGLING &#34;ON&#34; THIS SETTING!</b></P>",'theme_admin'),		
						"id" => "cufon_enabled",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"id" => "cufon_used",
						"name" =>__('Choose Cufon Font',"theme_admin"),
						"desc" => __("<p>Click in the field with your cursor and choose a font.&nbsp;&nbsp;One may have more then one Cufon font active at the same time, each being used for various web font replacements as well as one being the default font for most descriptive replacement in that setting below.</p><p>Choose multiple fonts by holding down the Cntrl key on your keyboard while scrolling and clicking the fonts in the list, just as you would do to select multiple items on your desktop computer.</p> ",'theme_admin'),
						"default" => array(),
						"prompt" => __("Choose Cufon font..","theme_admin"),
						"type" => "fontchosen",
						"options"=> $this->get_cufon_fonts_list(),
						"preview_callback" => 'function(element, font){
	if(cufon_list[font.id] === undefined){
		return;
	}
	var url = cufon_list[font.id].url;
	var loaded = jQuery(element).data("loaded");
	if(loaded == undefined){
		loaded = [];
	}
	
	if(jQuery.inArray(url,loaded) < 0){
		loaded.push(url);
		
		var wf = document.createElement("script");
		wf.src = url;
		wf.type = "text/javascript";
		wf.async = "true";
		wf.onload = function(){
			Cufon.replace(element,{fontFamily: cufon_list[font.id].name});
		};
		var s = document.getElementsByTagName("script")[0];
		s.parentNode.insertBefore(wf, s);
		jQuery(element).data("loaded",loaded);
	}else{
		Cufon.replace(element,{fontFamily: cufon_list[font.id].name});
	}
};',
					),	
					array(
						"name" => __("Cufon Custom CSS Code Field",'theme_admin'),
						"desc" => __('<p>One can selectively replace any web text in Striking, although typically one is usually replacing descriptive text of some sort.</p><p>Here is an example of two replacements, and in this example, notice that two separate Cufon fonts are used - one would have to have enabled both of these fonts in the <b>Choose Cufon Font</b> setting above.  Take either or both code snippets and copy and paste into the field below, and then change the font names to the name of the Cufon font you have chosen.</p><p><code>Cufon.replace("h1,h2,h3,h4,h5", {fontFamily : "Vegur"});</code></p><p><code>Cufon.replace("#site_name", {fontFamily : "Segan", color: \'-linear-gradient(white, black)\'});</code></p><p>For more code tips go to official <a href="http://wiki.github.com/sorccu/cufon/styling">Cufon site.</a>  &nbsp;Because custom replacement code can be complex, the team supporting Striking offers paid cufon customization support and to obtain paid support please contact any team member at the Striking Support Forum.</p>','theme_admin'),							"id" => "cufon_code",
						"default" => '',
						"id" => "cufon_code",
						"rows" => '8',
						"type" => "textarea"
					),
					array(
						"id" => "cufon_default",
						"name" =>__('Enable Cufon Replacment for all Descriptive Text Types',"theme_admin"),
						"desc" => __("<p>All Cufon fonts you have chosen to make available via the <b>Choose Cufon Font</b> setting above will appear below.&nbsp;&nbsp;Set the toggle to the <em>On</em> position for one of the fonts below, and it will replace all descriptive text types in your site after saving.</p><p><b>WARNING:</b> &nbsp;&nbsp;Do not activate more then one font as the font for replacing all descriptive types as it can lead to extremely unpredictable behaviour, and crash both your site and your browser! (ie, Doing stupid things leads to bad consequences -> you have been warned! (James aka Websys)).</p><p>The following are replaced by the Cufon font when you have activated this setting - this is not the actual script but just the names of the elements that are replaced taken from it:<br /><br /><code>Site Name, Tagline, Widget & Footer Titles (which are h3 tags), Copyright Text, Dropcaps, Feature Header Title (h1 tag), Blog title, Portfolio Title, h1, h2, h3, h4, h5, h6, Top Level Navigation Text, & Child Navigation Text</code></p>",'theme_admin'),
						"layout" => false,
						"function" => "_option_cufon_fonts_function",
						"default" => '',
						"type" => "custom"
					),
				),
			),
			array(
				"slug" => 'fontface',
				"name" => __("@font-face Settings",'theme_admin'),
				"desc" => __("<h3>INTRODUCTION</h3>
<p>@font-face is a font-replacement technique that uses a CSS rule to enable the viewing of a font on a Web page even if that font is not installed on the user's computer. &nbsp;Font face has some excellent advantages versus either Cufon or Google fonts in that as it does not generate the same scripting burden on page load generated by either Cufon or Google text technologies, and it does not generate the outside api calls that google fonts generate which sometimes can result in a big impact on page loading time (the page loading delays or stalls while awaiting a response from the google api).  &nbsp;So it is generally the fastest and lightest of the three text font technologies, and highly recommended as the first choice for custom use.</p>
<p>Striking includes 45 of the most popular royalty free @font-face fonts for use in customizing the appearence of text in a website.</p>
<h3>USAGE</h3>
<p>The first step is to enable the fontface scripts within the theme via the <b>Enable @font-face</b> setting below.  &nbsp;With this setting - fontface is turned on, but not active in replacement of any text within the site.</p>
<p>Step 2 is to choose a fontface font in the <b>Choose @fontface Font</b> setting, which once one selects a fontface font makes it an available fontface font for replacing some of the web font usage, but still not actively replacing any text in the site as it has not been told what to replace.</p>
<p>Once one has made available a fontface font for replacement one has two choices:</p><p>1) Use custom css pasted into the <b>@fontface Custom CSS Code Field</b> below to selectively replace the regular web font where one desires (samples are provided in its help field), or</p><p>2) Turn <em>ON</em> the setting for <b>Enable @fontface Replacment for all Descriptive Text Types</b> (this field is ajaxed and only appears once one has chosen a font in Step 2 above)in which case the selected fontface font will replace the base theme web font for all the descriptive font usages in Striking (see help field for the list).</p>
<h3>ADDING A NEW @FONT-FACE FONT</h3>
<p>It is certainly possible to add additional @Font-Face fonts to the theme but it is a fairly complex process - the explanation below touches only on the very outline of the necessary steps but covering the process in detail is outside the scope of this theme documentation. &nbsp;Here is the outline of the steps:<br />
<br />
<b>1)</b> Go to: <a href='http://www.fontsquirrel.com/' target='_blank'>Fontsquirrel</a> and choose a font<br />
<b>2)</b> Download the @font-face kit from Fontsquirrel or generate a kit at <a href='http://www.fontsquirrel.com/' target='_blank'>Fontsquirrel Generator</a>
 (preferred)<br />
<b>3)</b> Using an FTP client to access your host web server, go to
wp-content/themes/striking-r/fontfaces directory.<br />
<b>4)</b> Move the unziped directory to your host server.<br />
<b>5)</b> Then refresh this tab, and one should see the font now appearing in the list of @font-face fonts available.</p>
<h3>PAID SUPPORT FOR CUSTOM FONT GENERATION AND CUSTOM CSS REPLACEMENT</h3>
<p>On a paid basis the Striking development team can undertake custom @font-face generation as well as creating custom replacement in a site. &nbsp;Contact a support team member via the Striking Support Forum for more information on this service.</p>
<p><b><u>At the Striking Support site there is a link to an additional fontface package for sale for a nominal cost, containing 35 new @font-face fonts</u></b>. &nbsp;This kit was developed by an outside party thus it is not part of the theme but it is highly recommended given the time necessary to create it.</b>
",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Enable @font-face",'theme_admin'),
						"desc" => __("<p>The purpose of this setting is to enable the potential for @font-face with this setting - you are turning it on but not yet making it active in replacement of any text within the site. &nbsp;&nbsp;<b>VERY IMPORTANT - SAVE THE PANEL AFTER THIS STEP.  &nbsp;DO NOT PROCEED TO ANY OF THE OTHER SETTINGS UNTIL YOU HAVE SAVED THE FONT PANEL AFTER TOGGLING &#34;ON&#34; THIS SETTING!</b></P>",'theme_admin'),		
						"id" => "fontface_enabled",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"id" => "fontface_used",
						"name" =>__('Choose @font-face Font',"theme_admin"),
						"desc" => __("Click in the field with your cursor and choose a font.&nbsp;&nbsp;One may have more then one fontface font active at the same time, each being used for various web font replacements as well as one being the default font for most descriptive replacement in that setting below.&nbsp;&nbsp;Choose multiple fonts by holding down the Cntrl key on your keyboard while scrolling and clicking the fonts in the list, just as you would do to select multiple items on your desktop computer.",'theme_admin'),
						"default" => array(),
						"prompt" => __("Choose fontface font..","theme_admin"),
						"chosen" => "true",
						"type" => "fontchosen",
						"preview_callback" => 'function(element, font){
	if(fontface_list[font.id] === undefined){
		return;
	}
	var url = fontface_list[font.id].url;
	var loaded = jQuery(element).data("loaded");
	if(loaded == undefined){
		loaded = [];
	}
	if(jQuery.inArray(url, loaded) < 0){
		loaded.push(url);
		
		var wf = document.createElement("link");
		wf.href = url;
		wf.rel = "stylesheet";
		wf.type = "text/css";
		wf.async = "true";
		var s = document.getElementsByTagName("style")[0];
		s.parentNode.insertBefore(wf, s);
		jQuery(element).data("loaded",loaded);
	}
	jQuery(element).css("font-family", "\'"+font.text+"\'");
};',
						"options"=> $this->get_fontface_fonts_list(),
					),
					array(
						"name" => __("@font-face Custom CSS Code Field",'theme_admin'),
						"desc" => __('One can selectively replace any web text in Striking, although typically one is usually replacing descriptive text of some sort.<br /><br />Here is an example of a replacement and you would take this code snippet and copy and paste into the field below, and then change the font name to the name of the fontface font you have chosen.<p><code>h1,h2,h3,h4,h5 { font-family:ColaborateLightRegular; }</code></p><p>For more code tips go to the official <a href="http://www.fontsquirrel.com/" target="_blank">fontface site.</a>','theme_admin'),	
						"id" => "fontface_code",
						"default" => '',
						"rows" => '8',
						"type" => "textarea"
					),
					array(
						"id" => "fontface_default",
						"name" =>__('Enable a @font-face Replacment for all Descriptive Text Types',"theme_admin"),
						"desc" => __("<p>All fontface fonts you have chosen to make available via the <b>Choose @font-face Font</b> setting above will appear below.&nbsp;&nbsp;Set the toggle to the <em>On</em> position for one of the fonts below, and it will replace all descriptive text types in your site after saving.</p><p><b>WARNING:</b> &nbsp;&nbsp;Do not activate more then one font as the font for replacing all descriptive types as it can lead to extremely unpredictable behaviour, and crash both your site and your browser! (ie, Doing stupid things leads to bad consequences -> you have been warned! (James aka Websys)).</p><p>The following are replaced by the fontface font when you have activated this setting - this is not the actual script but just the names of the elements that are replaced taken from it:<br /><br /><code>Site Name, Tagline, Widget & Footer Titles (which are h3 tags), Copyright Text, Dropcaps, Feature Header Title (h1 tag), Blog title, Portfolio Title, h1, h2, h3, h4, h5, h6, Top Level Navigation Text, & Child Navigation Text</code></p>",'theme_admin'),	
						"layout" => false,
						"function" => "_option_fontface_fonts_function",
						"default" => '',
						"type" => "custom"
					),
				),
			),
			array(
				"slug" => 'gfont',
				"name" => __("Google font Settings",'theme_admin'),
				"desc" => __("<h3>INTRODUCTION</h3>
<p>Striking MultiFlex supports the use of Google fonts, which is essentially a very easy way of using non-system fonts in a website.  &nbsp;Google fonts are a simplified way of using @font-face fonts with all of the font files being resident on the google servers rather then included in the theme core files. &nbsp;This provides the user access to a very large typeface library without the penalty of storage of the actual typeface files within their webhost.<p>
<p>The downside of google fonts are that the website generates external scripting actions to the google server, which adds to the page loading burden (and thus time to complete page load) and as one will find sometimes, cause a page to load very slowly or stall out due to a routing problem or heavy burden on the api at that exact moment (ie google server resources allocated to the font api). &nbsp;Another issue is that in some countries, access to the google api may be erratic or blocked which will then have a serious impact on the site appearence - something to keep in mind depending on the geographic focus of a website.</p>
<p>The big upside of google fonts is the library has grown over time and Striking MultiFlex offers 738 google fonts (the entire library at time of publication of the theme) and google manages all the licensing of these fonts eliminating this concern for the user.</p>
<h3>USAGE</h3>
<p>The 1st step is to enable the theme google oriented scripts via the <b>Enable Google Font</b> setting below.  &nbsp;With this setting the internal google scripting is turned on, but not yet active in replacement of any text within the site.</p>
<p>Once one has made available a Google font for replacement one has two choices:</p><p>1) Use custom css pasted into the <b>Google Font Custom CSS Code Field</b> below to selectively replace the regular web font where one desires (samples are provided in its help field), or</p><p>2) Turn <em>ON</em> the setting for <b>Enable a Google Font Replacment for all Descriptive Text Types</b> (this field is ajaxed and only appears once one has chosen a font in Step 1 above)in which case the selected Google font will replace the base theme web font for all the descriptive font usages in Striking (see help field for the list).</p>

",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Update Available Google Fonts",'theme_admin'),
						'desc'=>__('<p>If the google fonts at google list a font that is not available in the Google fonts listed below then enable this setting and save the settings. The theme will retrieve and update the list of available fonts from Google. You will then be able to select the new font(s) from the drop down list below. Note: Sometimes it might require  this setting to be applied twice to download the new font list from Google.</p>','theme_admin'),
						"id" => "clear_google_fonts",
						"default" => false,
						"process" => "_option_clear_google_fonts_cache_process",
						"type" => "toggle"
					),
					array(
						"id" => "gfont_used",
						"name" =>__('Enable Google Font',"theme_admin"),
						'desc' =>__('<p>Below is a dropdown selectior with a list of Google fonts for use in your site.&nbsp;&nbsp;If the font you desire is not in this list then go to <a href="http://www.google.com/webfonts" target="_blank">Google webfonts library</a> to check on the availability of the font from Google.</p>',"theme_admin"),
						"default" => array('Abel'),
						"prompt" => __("Choose google font..","theme_admin"),
						"chosen" => "true",
						"type" => "fontchosen",
						"preview_callback" => 'function(element, font){
	var pos = font.id.indexOf(":");
	var family;
	var variant;
	if(pos != -1){
		family = font.id.substr(0, pos);
		variant = font.id.substr(pos+1);
		jQuery(element).css("font-weight", variant.replace(/italic/,""));
	}else{
		family = font.id;
		jQuery(element).css("font-weight", "");
	}
	jQuery(element).css("font-family", "\'"+family+"\'");

	if(font.id.indexOf("italic")!= -1){
		jQuery(element).css("font-style", "italic");
	}else{
		jQuery(element).css("font-style", "");
	}

	var loaded = jQuery(element).data("loaded");
	if(loaded == undefined){
		loaded = [];
	}
	if(jQuery.inArray(font.id, loaded) < 0){
		loaded.push(font.id);
		WebFont.load({
			google: {
				families: [font.id]
			}
		});
		jQuery(element).data("loaded",loaded);
	}
};',
						"options"=> $this->get_google_fonts(),
					),
					array(
						"name" => __("Google Font Custom CSS","theme_admin"),
						"desc" => __('<p align="justify">It is not recommended that one employ more then 2-4 custom google fonts at any one time as more active can lead to a larger increase in site loading time.  &nbsp;There are only two font styles: normal and italics. &nbsp;The default font style is always normal, so one does not need to specify it in a css rule if &#8220;normal&#8221; appears in the font name. &nbsp;&nbsp;If the font name has the text &#8220;italic&#8221; in it, you should add <code>font-style: italic;</code> to the css rules.</p>
<p>The nomenclature is as follows for <u>font weight</u>:<ul>
<li>Ultra-Light 100 =>  font weight:100</li>
<li>Light 200 => font weight:200</li>
<li>Book 300 => font weight:300</li>
<li>Normal 400 => font weight:400</li>
<li>Medium 500 => font weight:500</li>
<li>Semi-Bold 600 => font weight:600</li>
<li>Bold 700 => font weight:700</li>
<li>Extra-Bold 800 => font weight:800</li>
<li>Ultra-Bold 900 => font weight:900</li>
<li>regular => font weight:400</li>
<ul></p>
<p align="justify">Thus if a font has in its name &#8220;Book&#8221; or &#8220;Semi-Bold&#8221; these are just descriptors we have added to the font name so that you have a visual representation of the &#8220;weight&#8221; of the font. &nbsp;&nbsp;They have no meaning as far as writing a css rule. &nbsp;&nbsp;So if a font that you wish to use for some font replacement is &#8220;Semi-Bold 600&#8221;, all you need in the css rule is <code>font-weight: 600;</code> as part of the specification in the custom font rule you are creating.</p>
<p>Here are some sample code snippets for substitution and you can copy and paste any of these into the custom css field below to give you a starting point for creating your own rule, changing the element and attribute as appropriate:</p>
<p><ul> 
<li><code>h1, h2 {<br/>font-family:"Open Sans", serif;<br/>
font-weight: 700;<br/>
font-style: normal;<br/>
text-shadow: 4px 4px 4px #aaa;<br/>
}</code></li>
<li><code>h4 {font-family:"Averia Sans Libre"}</code></li>
<li><code>#navigation a {<br/>font-family:"Advent Pro", sans;<br/>
font-weight: 200;<br/>
font-style: normal;<br/>
}</code></li>
</ul>
Notice that to a couple of the rules we added &#8220;serif&#8221; and &#8220;sans&#8221; - this is so that if a browser does not recognize the custom font it has a fallback.  &nbsp;&nbsp;In the first rule, we also added some text shadowing, just one of the many special effects one can add to a font.</p>',"theme_admin"),
						"id" => "gfont_code",
						"default" => '',
						"rows" => '8',
						"type" => "textarea"
					),
					array(
						"id" => "gfont_default",
						"name" =>__('Enable a Google Font Replacement for all Descriptive Text Types',"theme_admin"),
						"desc" => __("<p>All Google fonts you have chosen to make available via the <b>Choose Google Font</b> setting above will appear below.&nbsp;&nbsp;Set the toggle to the <em>On</em> position for one of the fonts below, and it will replace all descriptive text types in your site after saving.</p><p><b>WARNING:</b> &nbsp;&nbsp;Do not activate more then one font as the font for replacing all descriptive types as it can lead to extremely unpredictable behaviour, and crash both your site and your browser! (ie, Doing stupid things leads to bad consequences -> you have been warned! (James aka Websys)).</p><p>The following are replaced by the Google font when you have activated this setting - this is not the actual script but just the names of the elements that are replaced taken from it:<br /><br /><code>Site Name, Tagline, Widget & Footer Titles (which are h3 tags), Copyright Text, Dropcaps, Feature Header Title (h1 tag), Blog title, Portfolio Title, h1, h2, h3, h4, h5, h6, Top Level Navigation Text, & Child Navigation Text</code></p>",'theme_admin'),
						"layout" => false,
						"function" => "_option_google_fonts_function",
						"default" => 'Abel',
						"process" => '_option_google_fonts_process',
						"type" => "custom"
					),
				),
			),
		);
		return $options;
	}
	function _option_fontface_fonts_function($item, $default) {
		$fonts =  theme_get_option('font','fontface_used');
		if(empty($fonts)){
			return;
		}
		echo '<li class="theme-option theme-font-set-default">';
		echo '<h4 class="theme-option-title"><label for="'.$item['id'].'">' . $item['name'] . '</label></h4>';
		if(!empty($item['desc'])){
			echo '<a class="theme-option-more" href=""><i></i></a>'.
				'<div class="theme-option-desc">' . $item['desc'] . '</div>';
		}
		
		echo '<div class="theme-option-content">';
		echo '<ul class="theme-font-set-default-list">';
		$count = 1;
		foreach($fonts as $font){
			if($font == $default){
				$checked = ' checked="checked"';
			}else{
				$checked = '';
			}
			$font_array = $this->get_fontface_font($font);
			echo '<li>';
			echo '<input type="checkbox" name="'.$item['id'].'" class="toggle-button toggle-default" value="'.$font.'"'.$checked.'/>';
			echo '<div class="theme-font-set-default-preview">';
			echo '<textarea rows="1" style="font-family:'.$font_array['name'].'">'.$font_array['name'].'</textarea>';
			echo '</div>';
			echo '</li>';
			$count ++;
		}
		echo '</ul>';
		echo '</div>';
		echo '</li>';
	}
	function _option_cufon_fonts_function($item, $default) {
		$fonts =  theme_get_option('font','cufon_used');
		if(empty($fonts)){
			return;
		}
		echo '<li class="theme-option theme-font-set-default">';
		echo '<h4 class="theme-option-title"><label for="'.$item['id'].'">' . $item['name'] . '</label></h4>';
		if(!empty($item['desc'])){
			echo '<a class="theme-option-more" href=""><i></i></a>'.
				'<div class="theme-option-desc">' . $item['desc'] . '</div>';
		}
		
		echo '<div class="theme-option-content">';
		echo '<ul class="theme-font-set-default-list">';
		$count = 1;
		foreach($fonts as $font){
			if($font == $default){
				$checked = ' checked="checked"';
			}else{
				$checked = '';
			}
			echo '<li>';
			$font_array = $this->get_cufon_font($font);
			echo '<input type="checkbox" name="'.$item['id'].'" class="toggle-button toggle-default" value="'.$font.'"'.$checked.'/>';
			echo '<div class="theme-font-set-default-preview">';
			echo '<div class="theme-font-cufon-preview" data-font="'.$font_array['font_name'].'">'.$font_array['font_name'].'</div>';
			echo '</div>';
			echo '</li>';
			$count ++;
		}
		echo '</ul>';
		echo '</div>';
		echo '</li>';
	}

	function _option_google_fonts_process($item, $data){
		if(isset($_POST['gfonts_subsets'])){
			$gfonts_subsets = $_POST['gfonts_subsets'];
			if(is_array($gfonts_subsets) && !empty($gfonts_subsets)){
				foreach($gfonts_subsets as $font => $subsets){
					theme_set_google_font_subsets($font, $subsets);
				}
			}
		}
		return $data;
	}

	function _option_google_fonts_function($item, $default) {
		$fonts =  theme_get_option('font','gfont_used');
		if(empty($fonts)){
			return;
		}
		echo '<li class="theme-option theme-font-set-default">';
		echo '<h4 class="theme-option-title"><label for="'.$item['id'].'">' . $item['name'] . '</label></h4>';
		if(!empty($item['desc'])){
			echo '<a class="theme-option-more" href=""><i></i></a>'.
				'<div class="theme-option-desc">' . $item['desc'] . '</div>';
		}
		
		echo '<div class="theme-option-content">';
		echo '<ul class="theme-font-set-default-list">';
		$count = 1;
		global $google_fonts;

		foreach($fonts as $font){
			$font_obj = $google_fonts->font($font);
			if($font_obj){
				if($font == $default){
					$checked = ' checked="checked"';
				}else{
					$checked = '';
				}
				echo '<li>';
				echo '<input type="checkbox" name="'.$item['id'].'" class="toggle-button toggle-default" value="'.$font.'"'.$checked.'/>';
				echo '<div class="theme-font-set-default-preview">';
				$font_name='';
				$styles = array();
				$styles[] = "font-family:'".$font_obj->_family."'";
				$font_name='font-family:"'.$font_obj->_family.'";';

				if($font_obj->weight!== '400'){
					$styles[] = "font-weight:".$font_obj->weight;
				}
				if($font_obj->italic == true){
					$styles[] = "font-style: italic";
				}
				echo '<textarea rows="1" style="'.implode(';',$styles).'">'.$font_obj->name.'</textarea>';
				echo '<textarea rows="1">'.$font_name.'</textarea>';
				echo '<ul class="theme-font-set-subsets">';
				$selected_subsets = theme_get_google_font_subsets($font);
				foreach ($font_obj->subsets as $subset) {
					echo '<li>';
					if(in_array($subset, $selected_subsets)){
						$checked = ' checked="checked"';
					}else{
						$checked = '';
					}

					echo '<input type="checkbox" id="gfonts_subsets_'.esc_html($font).$subset.'" name="gfonts_subsets['.esc_html($font).'][]" value="'.$subset.'"'.$checked.'>';
					echo '<label for="gfonts_subsets_'.esc_html($font).$subset.'">'.$subset.'</label>';
					echo '</li>';
				}
				echo '</ul>';
				echo '</div>';
				echo '</li>';
				$count ++;
			}
		}
		echo '</ul>';
		echo '</div>';
		echo '</li>';
	}

	function _option_fonts_function($value, $default) {
		$fonts = $this->get_fontface_fonts();
		echo '<select class="font-selector">';
		foreach($fonts as $value => $font){
			echo '<option value="'.$value.'">'.$font['name'].'</option>';
		}
		echo '</select>';
		echo '<div class="font-tester-container"><textarea class="font-tester" rows="1"> This is Preview for the font. 0123456789</textarea></div>';
	}

	function get_google_fonts(){
		global $google_fonts;
		if(!$google_fonts){
			$familys = get_option('theme_google_fonts_familys');
			if(empty($familys)){
				global $google_fonts;
				require_once (THEME_PLUGINS . '/google_font/google_font.php');
				$google_fonts = new Theme_google_fonts();
				$familys = $google_fonts->familys();
			}
		} else {
			$familys = $google_fonts->familys();
		}
				
		return $familys;
	}

	function get_fontface_fonts(){
		if($this->fontface_fonts){
			return $this->fontface_fonts;
		}
		$fonts = array();
		$font_dirs = array_filter(glob(THEME_FONTFACE_DIR.'/*'), 'is_dir');
		
		foreach($font_dirs as $dir){
			$stylesheet = $dir.'/stylesheet.css';
			if(file_exists($stylesheet)){
				$file_content = file_get_contents($stylesheet);
				if( preg_match_all("/@font-face\s*{.*?font-family\s*:\s*('|\")(.*?)\\1.*?}/is", $file_content, $matchs) ){
					foreach($matchs[0] as $index => $css){
						$font_folder = basename($dir);
						$fonts[$font_folder.'|'.$matchs[2][$index]] = array(
							'folder' => $font_folder,
							'name' => $matchs[2][$index],
							'css' => $css,
							'dir' => THEME_FONTFACE_DIR. '/'.$font_folder.'/stylesheet.css',
							'url' => THEME_FONTFACE_URI. '/'.$font_folder.'/stylesheet.css',
						);
					}
					
				}
			}
		}
		$fonts = apply_filters('theme_fontface_fonts',$fonts);
		$this->fontface_fonts = $fonts;
		return $fonts;
	}

	function get_google_font_name($font){
		$fonts = $this->get_google_fonts();
		if(is_string($font) && $font !== '' && array_key_exists($font,$fonts)){
			return $fonts[$font];
		}else{
			return false;
		}
	}
	
	function get_fontface_font($font){
		$fonts = $this->get_fontface_fonts();
		if(is_string($font) && $font !== '' && array_key_exists($font,$fonts)){
			return $fonts[$font];
		}else{
			return false;
		}
	}
	
	function get_cufon_font($font){
		$fonts = $this->get_cufon_fonts();
		if(is_string($font) && $font !== '' && array_key_exists($font,$fonts)){
			return $fonts[$font];
		}else{
			return false;
		}
	}

	function get_fontface_fonts_list(){
		$fonts = $this->get_fontface_fonts();
		$list = array();
		foreach($fonts as $value=>$font){
			$list[$value] = $font['name'];
		}
		return $list;
	}

	function get_cufon_fonts(){
		if($this->cufon_fonts){
			return $this->cufon_fonts;
		}
		$fonts = array();
		$font_files = glob(THEME_FONT_DIR."/*.js");
		if(!empty($font_files)){
			foreach($font_files as $font_file){
				$file_content = file_get_contents($font_file);
				if(preg_match('/font-family":"(.*?)"/i',$file_content,$match)){
					$file_name = basename($font_file);
					$fonts[$file_name] = array(
						'font_name' => $match[1],
						'file_name' => $file_name,
						'url' => THEME_FONT_URI.'/'.$file_name
					);
				}
			}
		}
		$fonts = apply_filters('theme_cufon_fonts',$fonts);
		$this->cufon_fonts = $fonts;
		return $fonts;
	}

	function get_cufon_fonts_list(){
		$fonts = $this->get_cufon_fonts();
		$list = array();
		foreach($fonts as $value=>$font){
			$list[$value] = $font['font_name'];
		}
		return $list;
	}
	function _option_clear_google_fonts_cache_process($option,$data) {
		if($data == true){
			delete_option('theme_google_fonts');
			delete_option('theme_google_fonts_familys');
		}
		return false;
	}
}
