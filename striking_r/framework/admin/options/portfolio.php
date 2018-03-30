<?php
class Theme_Options_Page_Portfolio extends Theme_Options_Page_With_Tabs {
	public $slug = 'portfolio';

	function __construct(){
		$this->name = __('Portfolio Settings','theme_admin');
		parent::__construct();
	}
	function tabs(){
		$options = array(
			array(
				"slug" => 'url',
				"name" => __("Custom Portfolio Breadcrumbs & URL Settings",'theme_admin'),
				"desc" => __("<h3 align='center'>Custom Portfolio Breadcrumbs & URL Settings</h3>
<p align='justify'>Wordpress does not provide at this time an automatic ability to create a static page for custom post types similar to the ability to designate a static blog page.  &nbsp;However, Striking is a unique theme in that it provides custom settings below allowing one to emulate the behavior of a static &#34;home&#34; page for portfolios by setting a custom breadcrumbs parent page, and rewrite url for portfolio items.</p> <p align='justify'>The settings below contain more information and examples in the help dialogues</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Set a Portfolio Breadcrumbs Parent Page",'theme_admin'),
						"desc" => __("<p align='justify'>Portfolio posts, as a custom post type, don&#180;t follow the normal blog post breadcrumbs convention. &nbsp;This setting can provide an alternative as it allows for selection of a page to be the breadcrumbs parent page for all portfolio items that are created for the website.</p>
<p align='justify'>An example usage with this feature is to have created a &#34;My Portfolio&#34; top level navigation page and then select it in the dropdown field below to act as the parent page for breadcrumbs. &nbsp;After saving, someone viewing any portfolio post in the site would see in the breadcrumbs string &#34;Home -> My Portfolios -> Portfolio Post&#34;. &nbsp;If no breadcrumb parent is set, then the breadcrumb string appearing in the single portfolio post webpage would be &#34;Home -> Portfolio Post&#34;.</p>
<p align='justify'>NOTE : &nbsp;&nbsp;As it is sometimes necessary to override this theme default setting, the Portfolio Metabox (found below each portfolio item content editor) has a similar breadcrumbs parent setting where a different parent page can be chosen when necessary for specific portfolio items.</p>",'theme_admin'),
						"id" => "breadcrumbs_page",
						"page" => 0,
						"default" => 0,
						"chosen" => "true",
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("Permalink Slug",'theme_admin'),
						"desc" => __("<p align='justify'>Similar to the breadcrumbs setting above, this permalink setting allows for creation of a custom url string to be invoked when a site user views a portfolio post webpage.</p>
<p align='justify'><u>If no value custom value is set, Striking is coded so that it will use &#34;portfolio&#34; for building the portfolio URL.</u> &nbsp;So when relying on the Striking default someone viewing any portfolio post in the site would see in the url string &#34;www.yoursite.com/portfolio/portfolioitemslugname&#34;. &nbsp;If a custom value is set below, then the url string would be &#34;www.yoursite.com/customvalue/portfolioitemslugname&#34;.</p>
<p align='justify'>HINT : &nbsp;&nbsp;If you create a a Portfolio page in your website, and post your main portfolio list(s) in it, then all outward bound links to individual portfolio items will reflect the portfolio url string and the custom portfolio page will appear to be a static page from the website viewer's perspective.</p> 
<p align='justify'>NOTE : &nbsp;&nbsp;Remember to avoid duplicate slugnames. &nbsp;Do not have a page named Portfolios, a portfolio category named Portfolios, or a tag called Portfolios, etc, as this will cause a malfunction in wordpress and elements of your site will cease working correctly. &nbsp;This duplicate slug rule is of course the same for blogs, pages, etc.  &nbsp;The title can be the same for each, but the slug should be customized so that it is never duplicated.</p>",'theme_admin'),
						"size" => 30,
						"id" => "permalink_slug",
						"default" => '',
						"process" => '_option_permalink_slug_process',
						"type" => "text",
					),
				),
			),
			array(
				"slug" => "single",
				"name" => __("Single Post -> Page Options",'theme_admin'),
				"desc" => __("<h3 align='center'>OPTIONAL ELEMENTS IN THE PORTFOLIO POST WEBPAGE</h3>
<p align='justify'>This admin tab has settings that are applicable to the display of different elements and post modules in the single portfolio webpage. &nbsp;These settings allow for choice of a default action for each element/module, which would be applied to all portfolio post webpages in the website.</p>
<p align='justify'>For example, if it is desired to have posts commentable by default, then the setting below for comments should be toggled on. &nbsp;The settings below allow for determining behaviours of  About the Author, Page Template, Comments, Post Navigation, and Related and Recent Posts Module.</p>
<p align='justify'>Most of the modules below will appear below the post body content. &nbsp;The post Layout and the Comments can be overridden on a post-by-post basis via settings found in the edit post metaboxes.</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Layout",'theme_admin'),
						"desc" => __("<p align='justify'>This setting determines the default layout for each portfolio post webpage: Full Width, Left Sidebar or Right Sidebar. &nbsp;When necessary, this default layout can be adjusted using the <b>Layout</b> setting found in the <b>Page General Options</b> metabox.</p>",'theme_admin'),
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
						"name" => __("Enable Previous & Next Portfolio Navigation Function",'theme_admin'),
						"desc" => __("<p align='justify'>This setting is to enable navigation between portfolio posts by way of a visual cue at the bottom of the single post webpage. &nbsp;The post title and a left or right arrow will appear as navigation cues for other portfolio posts available for viewing.</p>
<p align='justify'>This portfolio post navigation setting is an &#34;unrestricted&#34; navigation arrangement, as all portfolio items published for the website will be reachable by the previous & next type navigation. &nbsp;As this may not always be desirable, the other navigation settings below allow for restrictions in the navigation of portfolio items.</p>",'theme_admin'),
						"id" => "single_navigation",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Previous & Next Navigation Order",'theme_admin'),
						"desc" => __("<p align='justify'>There are two ordering options for the cycling of posts from one to the next in the post navigation.  &nbsp;The first option is to show the previous and next posts in respect of their Wordpress ID, which is assigned at the time of creation of the post. &nbsp;An easy way to see the id of each post is to hover the title of each post when viewing them in  the Portfolio Items menu.</p> 
<p align='justify'>Posts can also be given an order by use of the Attributes Metabox->Order field which is typically found to the right of the post content editor (normally above the Featued Image Metabox) and one can draw on that ordering for the post navigation by selecting the &#34;Assigned Order&#34; option in the field below.</p>",'theme_admin'),
						"id" => "single_navigation_order",
						"default" => 'post_data',
						"options" => array(
							"post_data" => __('Post ID','theme_admin'),
							"menu_order" => __('Assigned Order (&#34;Attributes&#34; Metabox)','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __(" Restrict Previous & Next Navigation by Portfolio Category",'theme_admin'),
						"desc" => __("<p align='justify'>This setting restricts the navigation cues at the bottom of the portfolio post webpage to displaying only items in the same portfolio category.</p>
<p align='justify'>The <b>Enable Previous & Next Portfolio Navigation Function</b> setting above must be &#34;ON&#34; in order for this restriction setting to be enabled.</p>",'theme_admin'),
						"id" => "single_navigation_category",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Restrict Navigation to Document Type Portfolio Items Only",'theme_admin'),
						"desc" => __("<p align='justify'>With this setting enabled, the navigation cues at the bottom of any portfolio post webpage will show and link only to Document type portfolio items.</p>",'theme_admin'),
						"id" => "single_doc_navigation",
						"default" => false,
						"type" => "toggle"
					),
					
					array(
						"name" => __("Enable Post Comments",'theme_admin'),
						"desc" => __("<p align='justify'>This setting is to show the Comments box at the bottom of the post. &nbsp;It appears below the post navigation (if that is enabled) and just above the footer area.</p>",'theme_admin'),
						"id" => "enable_comment",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Show the &#34;About Author Box&#34;",'theme_admin'),
						"desc" => __("<p align='justify'>This setting is to show the About the Author box, which will appear immediately following the post content. &nbsp;This is particularly popular feature for community based websites or websites which have a number of author level users contributing posts to the website.</p>",'theme_admin'),
						"id" => "author",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Related & Recent Module",'theme_admin'),
						"desc" => __("<p align='justify'>This setting is to show the Related & Recent Posts Module, which will appear below the About the Author module and above the navigation cues.</p>",'theme_admin'),
						"id" => "related_recent",
						"default" => false,
						"type" => "toggle"
					),
				),
			),
			array(
				"slug"=>'feature',
				"name" => __("Single Post -> Featured Image Options",'theme_admin'),
				"desc" => __("<h3 align='center'>FEATURED IMAGE BEHAVIOR IN THE PORTFOLIO POST WEBPAGE</h3>
<p align='justify'>This admin tab has settings applicable to the appearence of the post featured image in the single portfolio webpage. &nbsp;These settings allow for choice of a default action for each, which would be applied to all portfolio post webpages in the website.</p>
<p align='justify'>Striking provides a large number of options for post featured images so it is recommended the settings be reviewed carefully for applicability to the site design. &nbsp;Some of the settings below can be overridden either by a setting in the portfolio metabox, or in the portfolio shortcode ->if such exists it will be indicated in the setting help field.</p>
<h3>Featured Image Dimensions</h3>
<p align='justify'>There are only 2 featured image dimension for the single post page, as follows:<ul>
<li><b>1)</b> &nbsp;Full Width Featured Image = 958px wide x height</li>
<li><b>2)</b> &nbsp;Page with Sidebar Featured Image  = 628px wide x height</li>
<ul></p>
<p align='justify'>There are two settings below applicable to the height action of the featured image: adaptive height, and fixed height.</p>
<p align='justify'>It is not uncommon in a website for there to be no linking from a portfolio list to single post webpages in which case the options in this tab, and the <b>Single Post -> Page Options</b> Tab can be ignored. &nbsp;It is also common given the varying nature of portfolio items to have display of the featured image at the top of the single portfolio webpage turned off, and instead be using the Image Shortcode to place a customized version of the featured image into the post content.
", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Featured Image",'theme_admin'),
						"desc" => __("<p>If this setting is &#34;ON&#34;, the Featured Image will appear in Portfolio Item webpage just below the breadcrumbs string (if activated) and next after the feature header area (if no breadcrumbs).</p> 
<p>There is also a tritoggle setting in the Portfolio metabox which allows for override of this setting on post-by-post basis -> the benefit of the tritoggle is that if this setting is ON, the tritoggle has an OFF setting, and if this setting is OFF, the tritoggle has an ON setting, so no post is ever restricted to the theme default setting. &nbsp; The third position of the tritoggle is of course Default so that the post mimics the default behaviour of this setting.</p>",'theme_admin'),
						"id" => "featured_image",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Featured Image for Lightbox",'theme_admin'),
						"desc" => __("<p>If this option is ON, clicking on the Featured Image will open it in a lightbox. &nbsp;This is a popular setting when the actual image size is much larger then the alloted featured image space, and this setting combined with toggling OFF the <b>Restrict Image Lightbox Dimension</b> allows the image to open up in its full uploaded size in the lightbox for viewing.</p>  ",'theme_admin'),
						"id" => "featured_image_lightbox",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Featured Image Lightbox Fit To View",'theme_admin'),
						"id" => "featured_image_lightbox_fitToView",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Featured Image gallery for Lightbox",'theme_admin'),
						"desc" => __("<p>If this setting is ON, and the portfolio item is a portfolio gallery, the gallery images will open in the lightbox when a site user clicks on the Featured Image.</p>",'theme_admin'),
						"id" => "featured_image_lightbox_gallery",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Featured Image Effect",'theme_admin'),
						"desc" => "<p>The Effect when the user&#180;s cursor hovers over the Feature Image.</p>",
						"id" => "sinle_effect",
						"default" => 'none',
						"options" => array(
							"icon" => __("Icon",'theme_admin'),
							"grayscale" => __("Grayscale",'theme_admin'),
							"none" => __("None",'theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Adaptive Height",'theme_admin'),
						"desc" => __("<p>This is one of the 2 options for setting a height to the post featured image. &nbsp;If this option is ON, the Striking resizing script will have the height of the featured image depend on the scale of the image.</p>
<p>If uniformity of featured images from post to posts is not required (as adaptive height allows many images to be shown close to full size or at least in representative appearence) then this is a popular option. &nbsp;On the other hand if uniform height is desired, then the <b>Fixed Height</b> setting below should be used instead.</p>",'theme_admin'),
						"id" => "adaptive_height",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Fixed Height",'theme_admin'),
						"desc" => __("If the option above is off, it will take effect.",'theme_admin'),
						"id" => "fixed_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "250",
						"type" => "range"
					),
				),
			),
			array(
				"slug" => 'general',
				"name" => __("Portfolio Lists -> General Settings",'theme_admin'),
				"desc" => __("<h3 align='center'>INTRODUCTION</h3>
<p align='justify'>This admin tab contains settings for some elements which can appear with each portfolio item thumbnail in a portfolio list. &nbsp;These settings allow for choice of a default action for each element, which would be applied to all portfolio lists in the website.</p>
<p align='justify'>The porfolio shortcode duplicates the settings below for unique situations where it might be necessary to counteract the theme default for the appearence of the element. &nbsp; So the advantage of the theme defaults is &#34;set and forget&#34;, as well as allowing quicker shortcode setups when the defaults are acceptable.</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Display Portfolio Item Titles in Portfolio Lists",'theme_admin'),
						"desc" => __("<p align='justify'>Toggling this setting &#34;ON&#34; will cause teh portfolio item title to be displayed below the thumnbail image in all portfolio lists in the website.</p>",'theme_admin'),
						"id" => "display_title",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Display Portfolio Item Descriptions in Portfolio Lists",'theme_admin'),
						"desc" => __("<p align='justify'>Toggling this setting &#34;ON&#34; will cause the portfolio item editor content to be displayed below the thumbnail image. &nbsp;If there is content in the post <b>Excerpt</b> field, it will be displayed instead of the main editor content.</p>",'theme_admin'),
						"id" => "display_excerpt",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Display Read More Text in Portfolio Lists",'theme_admin'),
						"desc" => __("<p align='justify'>If there is an intent to use the portfolio list items as a lead to the single posts then this setting will cause hyperlinked text &#34;Read More&#34; to display along with the thumbnail image. &nbsp;As this text is a hyperlink, when the viewer clicks on it they will be taken to the single post webpage.</p>",'theme_admin'),
						"id" => "display_more_button",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Customize the Sorted &#34;Show&#34; Text",'theme_admin'),
						"desc" => __("<p align='justify'>When activating Sorted Tabbing in the portfolio shortcode, the tabs are preceded by the text &#34;Show:&#34; which is intended to prompt the viewer that clicking on any tab will show the portfolio items related to that subject.  &nbsp;The &#34;Show:&#34; text can be customized to some other wording using the field below, with a maximum of 30 alphanumeric characters.</p>",'theme_admin'),
						"id" => "show_text",
						"size" => 30,
						"default" => __('Show:','striking-r'),
						"type" => "text"
					),
				),
			),
			array(
				"slug" => 'thumbnail_height',
				"name" => __("Portfolio Lists -> Thumbnail Height Settings",'theme_admin'),
				"desc" => __("<h3 align='center'>FEATURED IMAGE SIZING FOR PORTFOLIO COLUMNS</h3>
<p align='justify'><ol>
<li>Striking allows for portfolio displays ranging from one to eight column arrays of images.</li> 
<li>Each column array may be placed in either a full width page or page with sidebar.</li>
<li>The featured image (thumbnail) width setting for each column array is fixed, and the height is adjustable.</li></ol> 
The width of the featured image has 16 different fixed sizes -> 8 column widths x 2 page types.  &nbsp;So it is important when creating any portfolio item that there be a clear idea of the column array it is going to be used in, since the change in column width from one column array to another is not proportionate (it cannot be since there are both even and odd number factorials involved).  &nbsp;If the intended thumbnail image for a poortfolio list is not sized correctly for the column array it will be distorted by the wp image resizing scripts - either cropped, or pixalated when magnified, or both.</p>
<p align='justify'><i>The result is that if the website being designed is portfolio oriented, it might be necessary to create more then one portfolio item using the same image, as each portfolio item might be using a different sized version of that image in order to fit correctly into the column array in which it is to appear</i>. &nbsp;Programs such as Adobe photoshop, Microsoft Paint or Gimp can all manage image adjustments when multiple sized versions of an image are necessary.</p> 
<p align='justify'>On installation, Striking has a default image width and height set for each column array.  &nbsp;The height settings below enable changing of the size to a new default which would apply to all shortcoded portfolio lists using that column array size. &nbsp;But it was recognized that there may be occasions where the default height is not suitable for a particular portfolio listing, so the portfolio shortcode has a setting for custom thumbnail height specific to that shortcode instance -> in that situation all the portfolio items would have to have a featured image size correctly to the custom height.</p>
<p align='justify'>The image widths per column for both a full page, and a page with sidebar are:<br /><br />
<b>FULL PAGE PORTFOLIO FEATURED IMAGE (FI) WIDTHS:</b><br /><br />
1 Column FI width = 600px<br />
2 Column FI width = 450px<br /> 
3 Column FI width = 292px<br />
4 Column FI width = 217px<br />
5 Column FI width = 170px<br />
6 Column FI width = 138px<br />
7 Column FI width = 118px<br />
8 Column FI width = &nbsp;&nbsp;97px<br />
<br />
<b>PAGE WITH SIDEBAR PORTFOLIO FEATURED IMAGE WIDTHS:</b><br /><br />
1 Column Page w/Sidebar FI width = 400px<br />
2 Column Page w/Sidebar FI width = 293px<br />
3 Column Page w/Sidebar FI width = 188px<br />
4 Column Page w/Sidebar FI width = 136px<br />
5 Column Page w/Sidebar FI width = 108px<br />
6 Column Page w/Sidebar FI width =  &nbsp;&nbsp;88px<br />
7 Column Page w/Sidebar FI width =  &nbsp;&nbsp;70px<br />
8 Column Page w/Sidebar FI width =  &nbsp;&nbsp;61px</p>
<p align='justify'>These image widths are also noted in the individual column help dialogues for your convenience.</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("One Column Portfolio Image Size Settings",'theme_admin'),
						"desc" => __("<p align='justify'>Full Width Page: FI width = 600px<br />Page w/Sidebar: FI width = 400px.<br />The default image height is set at 350px, and the max height one can set a portfolio image is 600px.</p>",'theme_admin'),
						"id" => "1_column_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "350",
						"type" => "range"
					),
					array(
						"name" => __("Two Column Portfolio Image Size Settings",'theme_admin'),
						"desc" => __("<p align='justify'>Full Width Page: FI width = 450px<br />Page w/Sidebar: FI width = 293px.<br />The default image height is set at 250px, and the max height one can set a portfolio image is 600px.</p>",'theme_admin'),
						"id" => "2_columns_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "250",
						"type" => "range"
					),
					array(
						"name" => __("Three Column Portfolio Image Size Settings",'theme_admin'),
						"desc" => __("<p align='justify'>Full Width Page: FI width = 292px<br />Page w/Sidebar: FI width = 188px.<br />The default image height is set at 180px, and the max height one can set a portfolio image is 600px.</p>",'theme_admin'),
						"id" => "3_columns_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "180",
						"type" => "range"
					),
					array(
						"name" => __("Four Column Portfolio Image Size Settings",'theme_admin'),
						"desc" => __("<p align='justify'>Full Width Page: FI width = 217px<br />Page w/Sidebar: FI width = 136px.<br />The default image height is set at 150px, and the max height one can set a portfolio image is 600px.</p>",'theme_admin'),
						"id" => "4_columns_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "150",
						"type" => "range"
					),
					array(
						"name" => __("Five Column Portfolio Image Size Settings",'theme_admin'),
						"desc" => __("<p align='justify'>Full Width Page: FI width = 170px<br />Page w/Sidebar: FI width = 108px.<br />The default image height is set at 120px, and the max height one can set a portfolio image is 600px.</p>",'theme_admin'),
						"id" => "5_columns_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "120",
						"type" => "range"
					),
					array(
						"name" => __("Six Column Portfolio Image Size Settings",'theme_admin'),
						"desc" => __("<p align='justify'>Full Width Page: FI width = 138px<br />Page w/Sidebar: FI width = 88px.<br />The default image height is set at 90px, and the max height one can set a portfolio image is 600px.</p>",'theme_admin'),
						"id" => "6_columns_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "90",
						"type" => "range"
					),
					array(
						"name" => __("Seven Column Portfolio Image Size Settings",'theme_admin'),
						"desc" => __("<p align='justify'>Full Width Page: FI width = 118px<br />Page w/Sidebar: FI width = 70px.<br />The default image height is set at 80px, and the max height one can set a portfolio image is 600px.</p>",'theme_admin'),
						"id" => "7_columns_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "80",
						"type" => "range"
					),
					array(
						"name" => __("Eight Column Portfolio Image Size Settings",'theme_admin'),
						"desc" => __("<p align='justify'>Full Width Page: FI width = 97px<br />Page w/Sidebar: FI width = 61px.<br />The default image height is set at 66px, and the max height one can set a portfolio image is 600px.</p>",'theme_admin'),
						"id" => "8_columns_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "66",
						"type" => "range"
					),
				),
			),
			array(
				"slug" => 'more',
				"name" => __("Portfolio Lists -> Read More Options",'theme_admin'),
				"desc" => __("<h3 align='center'>USAGE</h3>
<p align='justify'>The settings below are &#34;presets&#34; for two Read More options in any portfolio list created in the website. &nbsp;The portfolio shortcode has override options for each of the settings below when it is desired to have a different Read More behavior for a specific portfolio list. &nbsp;The portfolio shortcode also has the activator for Read More -> showing Read More is entirely optional in any portfolio list.</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Read More Text",'theme_admin'),
						"desc" => "",
						"size" => 30,
						"id" => "more_button_text",
						"default" => 'Read More &#187',
						"type" => "text",
					),
					array(
						"name" => __("Display Read More as button",'theme_admin'),
						"desc" => "",
						"id" => "read_more_button",
						"default" => false,
						"type" => "toggle"
					),
				),
			),
			array(
				"slug" => 'lightbox_dimension',
				"name" => __("Portfolio Lists -> Lightbox Dimensions",'theme_admin'),
				"desc" => __("<h3 align='center'>USAGE</h3>
<p align='justify'>Each video, lightbox type and doc type portfolio item has a thumbnail image which when clicked upon by the site viewer opens a lightbox containing the content. &nbsp;The settings below are presets for lightbox sizing for these portfolio types. &nbsp;However, the <b>Portfolio Metabox</b> contains in each portfolio type&#180;s admin tab an override of the settings below when it is desired to have a different lighbox size.</p>
<p align='justify'>So the settings in this tab are for convenience to save a little bit of time setting a lightbox size with each new portfolio item (a few users who had to make many portfolio items asked for all these default settings so......).</p>", 'theme_admin'),

				"options" => array(
					array(
						"name" => __("Video Type Width",'theme_admin'),
						"desc" => "",
						"id" => "video_width",
						"default" => "640",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Video Type Height",'theme_admin'),
						"desc" => "",
						"id" => "video_height",
						"default" => "480",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Lightbox Type Width",'theme_admin'),
						"desc" => "",
						"id" => "lightbox_width",
						"default" => "640",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Lightbox Type Height",'theme_admin'),
						"desc" => "",
						"id" => "lightbox_height",
						"default" => "480",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Google Doc Type Width",'theme_admin'),
						"desc" => "",
						"id" => "gdoc_width",
						"default" => "800",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Google Doc Type Height",'theme_admin'),
						"desc" => "",
						"id" => "gdoc_height",
						"default" => "600",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
				),
			),
			array(
				"slug" => 'video_audio',
				"name" => __("Portfolio Lists -> Video & Audio Play Options",'theme_admin'),
				"desc" => __("<h3 align='center'>USAGE</h3>
<p align='justify'>The settings below are play option &#34;presets&#34; for audio and video portfolio items. &nbsp;However, the <b>Portfolio Metabox</b> contains in each portfolio type&#180;s admin tab an override of the settings below when it is desired to have a different &#34;play&#34; outcome.</p>
<p align='justify'>So the settings in this tab are for convenience to save a little bit of time setting play options with each new portfolio item (a few users who had to make many portfolio items asked for all these default settings so......).</p>", 'theme_admin'),
				"options" => array(
					array(
						"name" => __("Video Autoplay",'theme_admin'),
						"id" => "video_autoplay",
						"desc" => __("Select this if you want the video to start playing as soon as the portfolio item is clicked.",'theme_admin'),
						"default" => 'false',
						"type" => "toggle"
					),
					array(
						"name" => __("Audio Autoplay",'theme_admin'),
						"id" => "audio_autoplay",
						"desc" => __("Select this if you want the audio to start playing as soon as the portfolio item is clicked.",'theme_admin'),
						"default" => 'false',
						"type" => "toggle"
					),
					array(
						"name" => __("Audio Loop",'theme_admin'),
						"id" => "audio_loop",
						"desc" => __("Select this if you want loop the audio when it ends .",'theme_admin'),
						"default" => 'false',
						"type" => "toggle"
					),
				),
			),
			array(
				"slug" => 'thumbnail',
				"name" => __("Portfolio Widgets -> Options for Widget Thumbnail",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Change the Theme Portfolio Widgets Thumbnail Size",'theme_admin'),
						"desc" => __("<p align='justify'>With this setting, one can change the size of the thumbnail image in portfolio widgets. &nbsp;The standard widget image size is 65px x 65px and the widget thumbnail is square.  &nbsp;This setting allows the size to be varied from 30px x 30px to 200px x 200px in size. All portfolio widget thumbnails will take on the new size.</p>",'theme_admin'),
						"id" => "widget_thumbnail_size",
						"min" => "1",
						"max" => "200",
						"step" => "1",
						"unit" => 'px',
						"default" => "65",
						"type" => "range"
					),
					array(
						"name" => __("Set a Default Widget Thumbnail for Posts with No Featured Image",'theme_admin'),
						"desc" => __("<p align='justify'>If this option is ON, it will display  the custom thumbnail image (loaded using the setting below) when there is no featured image assigned to the portfolio item.</p>
<p align='justify'>A situation where no individual post featured images are set might be when there is no intent of have portfolio lists in the site main content, but only to use portfolio widgets which link directly to single portfolio item webpages that contain any imagery embedded in the main body content. &nbsp;In this situation, one might choose to create a custom placeholder for the widget thumbnail, which can be loaded below.</p>",'theme_admin'),
						"id" => "display_default_thumbnail",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Load the Custom Widget Thumbnail Image",'theme_admin'),
						"id" => "default_thumbnail_custom",
						"default" => "",
						"type" => "upload"
					),
				),
			),
			array(
				"slug" => 'html',
				"name" => __("Portfolio Html Type",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Display Featured Image on Portfolio list",'theme_admin'),
						"id" => "html_image",
						"default" => false,
						"type" => "toggle",
					),
					array(
						"name" => __("Display Title on Portfolio list",'theme_admin'),
						"id" => "html_title",
						"default" => false,
						"type" => "toggle",
					),
					array(
						"name" => __("Display Read More on Portfolio list",'theme_admin'),
						"id" => "html_more",
						"default" => false,
						"type" => "toggle",
					),
				),
			),
		);
		return $options;
	}

	function _option_permalink_slug_process($option,$value) {
		if(theme_get_option('portfolio','permalink_slug') != $value){
			$this->_ajax_flush_rewrite_rules();
		}
		
		return $value;
	}

	function _ajax_flush_rewrite_rules(){
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
	var data = {
		action: 'theme-flush-rewrite-rules'
	};
	jQuery.post(ajaxurl, data, function(response) {
		
	});
});
</script>
<?php
	}
}
