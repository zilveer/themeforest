<?php
class Theme_Options_Page_Blog extends Theme_Options_Page_With_Tabs {
	public $slug = 'blog';

	function __construct(){
		$this->name = __('Blog Settings','theme_admin');
		parent::__construct();
	}
	
	function tabs(){
		$options = array(
			array(
				"slug" => 'general',
				"name" => __("Static Blog Page Settings",'theme_admin'),
				"desc" => __("<h3 align='center'>Static Blogpage Settings</h3>
<p><u>The first thing you should know is you don't need any of these settings!!</u> &nbsp;What? &nbsp;Say again? &nbsp;Nope, you don't need any of them, really: they are included here because most wp users come from a background or with the idea that in order to have a blog in a website, one needs to set a static page in order for the theme to parse the blog post type. &nbsp;This is how the Wordpress default themes work, as well as 99% of all other wordpress themes in existence, including premium themes at Themeforest and other theme marketplaces.</p>
<p><b><span style='color:#0c4892'>But in Striking MultiFlex, we set you free.</span></b> &nbsp;No need to set a static blog page ever. &nbsp;The MultiFlex blog shortcode has every setting necessary for creating a bloglist, by any blog filter, with any blog option, anywhere.  &nbsp;Anywhere! &nbsp;Well, anywhere in page or post main body content, custom feature header, or text widget. &nbsp;That&#180;s pretty much everywhere worthwhile to display a blog post or list.</p>
<p>However, sometimes a user still wants an old fashioned static blogpage, and the settings in this resource tab (other then the Featured Image on Feeds which just sort of got lumped here) are for that purpose. &nbsp;But, if you don't intend to set a static blog page, then the settings below (other then the featured image on feeds setting) can be left alone.</p>
<p><b>WP SEO NOTE:</b> &nbsp;&nbsp;If you are using WP SEO plugin to customize the blog breadcrumbs trail, then you would need to set a static blog page.</p>",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Blog Page",'theme_admin'),
						"desc" => __("The page you choose here will display the blog",'theme_admin'),
						"id" => "blog_page",
						"page" => 0,
						"chosen" => true,
						"default" => '',
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
						"process" => "_option_blog_page_process"
					),
					array(
						"name" => __("Layout",'theme_admin'),
						"desc" => "",
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
						"name" => __("Column Layout",'theme_admin'),
						"id" => "columns",
						"default" => '1',
						"options" => array(
							"1" => sprintf(__("%d Column",'theme_admin'),1),
							"2" => sprintf(__("%d Columns",'theme_admin'),2),
							"3" => sprintf(__("%d Columns",'theme_admin'),3),
							"4" => sprintf(__("%d Columns",'theme_admin'),4),
							"5" => sprintf(__("%d Columns",'theme_admin'),5),
							"6" => sprintf(__("%d Columns",'theme_admin'),6),
						),
						"type" => "select",
					),
					array(
						"name" => __("Box Frame Layout",'theme_admin'),
						"id" => "frame",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Featured Image",'theme_admin'),
						"desc" => __("If this option is on, Featured Image will appear in Blog Archives page.",'theme_admin'),
						"id" => "index_featured_image",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Featured Image Type",'theme_admin'),
						"desc" => "",
						"id" => "featured_image_type",
						"default" => 'full',
						"options" => array(
							"full" => __('Full Width','theme_admin'),
							"left" => __('Left Float','theme_admin'),
							"right" => __('Right Float','theme_admin'),
							"below" => __('Below Title','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Featured Image for Lightbox",'theme_admin'),
						"desc" => __("If this option is on, the full image will open in the lightbox when click on Featured Image.",'theme_admin'),
						"id" => "index_featured_image_lightbox",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Show Featured Image on Feeds",'theme_admin'),
						"id" => "show_post_thumbnail_on_feed",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Title",'theme_admin'),
						"id" => "title",
						"desc" => __("If the option is on, it will display Title of blog post",'theme_admin'),
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Meta Information",'theme_admin'),
						"id" => "meta",
						"desc" => __("If the option is on, it will display Meta Information of blog post",'theme_admin'),
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Description",'theme_admin'),
						"id" => "desc",
						"desc" => __("If the option is on, it will display Description of blog post",'theme_admin'),
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Length of Description",'theme_admin'),
						"id" => "desc_length",
						"desc" => __("If it's set to 0, it will use default setting",'theme_admin'),
						"default" => '55',
						"min" => 0,
						"max" => 200,
						"step" => "1",
						"type" => "range"
					),
					array(
						"name" => __("Display Full Blog Posts",'theme_admin'),
						"desc" => __("This option determinate whether to display full blog posts in index page.",'theme_admin'),
						"id" => "display_full",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Enable shortcode for the excerpt",'theme_admin'),
						"desc" => __("If this option is on, it will enable shortcode support for the excerpt.",'theme_admin'),
						"id" => "excerpt_shortcode",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Exclude Categories for blog page",'theme_admin'),
						"desc" => __("The blog Page usually displays all Categorys, since sometimes you want to exclude some of these categories. You can exclude multiple categories here:",'theme_admin'),
						"id" => "exclude_categorys_for_blog_page",
						"default" => array(),
						"target" => "cat",
						"chosen" => "true",
						"prompt" => __("Choose category..",'theme_admin'),
						"type" => "multiselect"
					),
					array(
						"name" => __("Exclude Categories for whole site",'theme_admin'),
						"desc" => __("The posts with the categories you selected here will not show on the any archive pages and any posts widget.",'theme_admin'),
						"id" => "exclude_categorys",
						"default" => array(),
						"target" => "cat",
						"chosen" => "true",
						"prompt" => __("Choose category..",'theme_admin'),
						"type" => "multiselect"
					),
					array(
						"name" => __("Gap Between Posts",'theme_admin'),
						"desc" => "",
						"id" => "posts_gap",
						"min" => "0",
						"max" => "200",
						"step" => "1",
						"unit" => 'px',
						"default" => "80",
						"type" => "range"
					),
					array(
						"name" => __("Featured Image Effect",'theme_admin'),
						"desc" => "Effect when hover feature image of blog archives page.",
						"id" => "effect",
						"default" => 'icon',
						"options" => array(
							"icon" => __("Icon",'theme_admin'),
							"grayscale" => __("Grayscale",'theme_admin'),
							"blur" => __("Blur",'theme_admin'),
							"zoom" => __("Zoom",'theme_admin'),
							"rotate" => __("Rotate",'theme_admin'),
							"morph" => __("Morph",'theme_admin'),
							"tilt" => __("Tilt",'theme_admin'),
							"none" => __("None",'theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Author link to website",'theme_admin'),
						"id" => "author_link_to_website",
						"default" => 'website',
						"options" => array(
							"website" => __("Website filed that set in the user profile page",'theme_admin'),
							"archive" => __("The author's posts page",'theme_admin'),
							"none" => __("None",'theme_admin'),
						),
						"type" => "select",
					),
				),
			),
			array(
				"slug" => 'single',
				"name" => __("Single Blog Post Settings",'theme_admin'),
				"desc" => __("<h3 align='center'>Single Blog Post Settings</h3>
<p>The settings in this resource tab apply to how any single blog post page will appear to the viewer. &nbsp;These are global default settings, and in most instances, the Blog Metabox (found below the WP content editor) contains duplicate settings to provide an override of the defaults below for those instances where a different appearence is required.</p>",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Post Page Layout",'theme_admin'),
						"desc" => "",
						"id" => "single_layout",
						"default" => 'right',
						"options" => array(
							"full" => __('Full Width','theme_admin'),
							"right" => __('Right Sidebar','theme_admin'),
							"left" => __('Left Sidebar','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Feature Header Default Type",'theme_admin'),
						"desc" => "",
						"id" => "single_header",
						"default" => 'single',
						"options" => array(
							"single" => __('Use the Single Post settings','theme_admin'),
							"blog" => __('Use Static Blog page settings','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Display Post Featured Image",'theme_admin'),
						"desc" => __("If this option is ON, the Featured Image will appear in Single Blog page just below the Featured Header and Breadcrumbs (if these are active).",'theme_admin'),
						"id" => "featured_image",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Featured Image Type",'theme_admin'),
						"desc" => __("There are 4 featured image positions: Full Width, Left Float, Right Float, and Below Title. &nbsp;Below Title refers to the post title and the meta appearing first, with the featured image below this information. &nbsp;Please see the demo for an example of this appearence.",'theme_admin'),
						"id" => "single_featured_image_type",
						"default" => 'full',
						"options" => array(
							"full" => __('Full Width','theme_admin'),
							"left" => __('Left Float','theme_admin'),
							"right" => __('Right Float','theme_admin'),
							"below" => __('Below Title','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Open Featured Image in Lightbox",'theme_admin'),
						"desc" => __("If this option is ON, then a viewer clicking on the featured image in the post body would result in the image opening in a lightbox, useful if the full size of the image is larger.",'theme_admin'),
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
						"name" => __("Featured Image Gallery for Lightbox",'theme_admin'),
						"desc" => __("If this option is ON, then any images that have been attached to the post will also show in the lightbox when a viewer clicks on the post featured image. &nbsp;In Wordpress one can assign images to any post or page in a site (theme has to support), and they do not need to be in a gallery shortcode in the post body (although of course they can be).  &nbsp;As long as they are attached to the post (this is a media panel function) the MultiFlex coding will detect them and display them in the lightbox and the viewer would use the lightbox navigation to view the images.",'theme_admin'),
						"id" => "featured_image_lightbox_gallery",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Featured Image Hover Effect",'theme_admin'),
						"desc" => "The effect when when a cursor hovers over the post featured image. &nbsp;Please note MultiFlex uses CSS3 implementation of grayscale, which is not supported by some browsers.",
						"id" => "single_effect",
						"default" => 'none',
						"options" => array(
							"icon" => __("Icon",'theme_admin'),
							"grayscale" => __("Grayscale",'theme_admin'),
							"none" => __("None",'theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Show Blog Title and Meta in the Feature Header Area",'theme_admin'),
						"desc" => __("Turned on the Blogtitle and meta info will show in feature header area. &nbsp;Turned OFF the Blogtitle and meta info will be shown below the featured image in the post body. Note : If the Featured Header area for single blog posts is set to show the Feature Header area of the blog listing page & the Featured Header Area type is set to 'default' then the Title and Meta Data will show in the page content. Similar applies when the Featured Header Area of the single post item is set to Type Slider, type Slider with title or Type Slider with custom text. The Title & Meta Data setting is then ignored and will show in the page content at the normal location.",'theme_admin'),
						"id" => "show_in_header",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Display the About Author Box",'theme_admin'),
						"desc" => __("This setting is to show the About the Author box, which will appear immediately following the post content. &nbsp;This is particularly popular feature for community based websites or websites which have a number of author level users contributing posts to the website.",'theme_admin'),
						"id" => "author",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Display the Related & Popular Post Module",'theme_admin'),
						"desc" => __("This setting is to show the Related & Recent Posts Module, which will appear below the About the Author module and above the navigation cues.",'theme_admin'),
						"id" => "related_popular",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Related Post Base (Criteria)",'theme_admin'),
						"desc" => __("If the related/popular post module above is active, then there is a choice for the selection criteria of what are shown as related posts: based on tags, or category.",'theme_admin'),
						"id" => "related_base_on",
						"default" => 'tags',
						"options" => array(
							'categories'=>__('Same Categories','theme_admin'),
							'tags'=>__('Same Tags','theme_admin'),
						),
						"type" => "select"
					),
					array(
						"name" => __("Previous & Next Navigation",'theme_admin'),
						"desc" => "",
						"id" => "entry_navigation",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __(" Previous & Next Navigation for Category",'theme_admin'),
						"desc" => "If the previous option is ON, and this option is ON, the Previous & Next Navigation will only show the portfolio items with the same Category.",
						"id" => "single_navigation_category",
						"default" => false,
						"type" => "toggle"
					),
				),
			),
			array(
				"slug" => 'meta',
				"name" => __("Meta Information Selections",'theme_admin'),
				"options" => array(
					array(
						"name" => __("For Blog list",'theme_admin'),
						"desc" => "",
						"id" => "meta_items",
						"default" => array('category','date','comment'),
						"options" => array(
							'category'=>__('Category','theme_admin'),
							'tags'=>__('Tags','theme_admin'),
							'author'=>__('Author','theme_admin'),
							'date'=>__('Date','theme_admin'),
							'comment'=>__('Comment','theme_admin'),
						),
						'enable_text' => __('Enabled','theme_admin'),
						'disable_text' => __('Disabled','theme_admin'),
						"type" => "ddmultiselect"
					),
					array(
						"name" => __("For Single Post Page",'theme_admin'),
						"desc" => "",
						"id" => "single_meta_items",
						"default" => array('date','category','comment'),
						"options" => array(
							'category'=>__('Category','theme_admin'),
							'tags'=>__('Tags','theme_admin'),
							'author'=>__('Author','theme_admin'),
							'date'=>__('Date','theme_admin'),
							'comment'=>__('Comment','theme_admin'),
						),
						'enable_text' => __('Enabled','theme_admin'),
						'disable_text' => __('Disabled','theme_admin'),
						"type" => "ddmultiselect"
					),
				),
			),
			array(
				"slug" => 'more',
				"name" => __("Read More Options - Post Lists",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Display &#34;Read More&#34; Text",'theme_admin'),
						"desc" => "",
						"id" => "read_more",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Display &#34;Read More&#34; Text in a Button",'theme_admin'),
						"desc" => "",
						"id" => "read_more_button",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Customize the &#34;Read More&#34; Text",'theme_admin'),
						"id" => "read_more_text",
						"default" => __("Read more &raquo;",'striking-r'),
						"type" => "text",
					),
				),
			),
			array(
				"slug" => 'full_featured_image',
				"name" => __("Full Width Featured Image Size Options",'theme_admin'),
				"desc" => __("<h3 align='center'>Full Width Height Settings</h3>
<p>The settings in this resource tab apply to Full Width and Below Title (which is a full width image) featured image orientations.</p>
<p><b>Adaptive Height</b> - The adaptive height setting controls both post list and the single post images. &nbsp;If it is used, the other two settings below are not applicable.</p>
<p><b>Image Widths</b> - The image width for a full width page is 960px. &nbsp;The width for a feature image in a sidebar page is 630px.</p>
<p><b>Image Scaling</b> - the featured image can be larger then the width x height, but it should respect the ratio of width to height or it will be cropped by wordpress automatically, usually with unpleasant results. &nbsp;For example, if using a full width single post page (therefore the image width per above is 960px) and the height has been set at 300px, the ratio is 960 to 300 (3.2:1).  &nbsp;The featured image loaded in this situation can be larger then 960 x 300, but if it deviates from the ratio, it will be cropped (and if it is smaller it will be scaled up which is also unpleasant). &nbsp;It is very common for the image loaded to be larger, and the featured image lightbox setting enabled (Single Post Options Settings tab above) so that a site visitor can view the image in its full size.</p>
<p><b>Blog Shortcode Width Options</b> - the MultiFlex Blog Shortcode contains both featured image orientation and width and height settings.  &nbsp;Thus irrespective of the default values below, posts lists with a custom image size and orientation can be implemented at will within a website - you are never restricted to the default template!</p>",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Adaptive Height",'theme_admin'),
						"desc" => __("If this option is ON, the height of the featured image will depend on the scale of the image. &nbsp;This setting is for both post lists and the single post page.",'theme_admin'),
						"id" => "adaptive_height",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Fixed Height Option for Post List Featured Image",'theme_admin'),
						"desc" => __("If the Adaptive Height option above is OFF, this setting will take effect -> the height of all post list featured images will be as set below. &nbsp;The default value is 250px and can be up to 600px in height.",'theme_admin'),
						"id" => "fixed_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "250",
						"type" => "range"
					),
					array(
						"name" => __("Fixed Height For Single Post Featured Image (Optional)&#x200E;",'theme_admin'),
						"desc" => __("If the Adaptive Height setting option above is OFF, then one can set a different default height for the featured image in a post page, vs the post list height.  &nbsp;If set to 0, the single post featured image height will be as per the Post List Height Size in the above setting. &nbsp;The range is from 50px to 600px in height.",'theme_admin'),
						"id" => "single_fixed_height",
						"min" => "50",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "0",
						"type" => "range"
					),
				),
			),
			array(
				"slug" => 'left_featured_image',
				"name" => __("Left & Right Float Featured Image Size",'theme_admin'),
				"desc" => __("The featured image size set below will apply to both Left and Right Float  Images, and for both post lists and single post pages.",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"id" => "left_width",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "200",
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"id" => "left_height",
						"min" => "1",
						"max" => "600",
						"step" => "1",
						"unit" => 'px',
						"default" => "200",
						"type" => "range"
					),
				),
			),
			array(
				"slug" => 'thumbnail',
				"name" => __("Widget Options for Featured Image Thumbnail",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Change the Theme Blog Widgets Thumbnail Size",'theme_admin'),
						"desc" => __("<p align='justify'>With this setting, one can change the size of the thumbnail image in blog widgets. &nbsp;The standard widget image size is 65px x 65px and the widget thumbnail is square.  &nbsp;This setting allows the size to be varied from 30px x 30px to 200px x 200px in size. All blog widget thumbnails will take on the new size.</p>",'theme_admin'),
						"id" => "widget_thumbnail_size",
						"min" => "30",
						"max" => "200",
						"step" => "1",
						"unit" => 'px',
						"default" => "65",
						"type" => "range"
					),
					array(
						"name" => __("Set a Default Widget Thumbnail for Posts with No Featured Image",'theme_admin'),
						"desc" => __("<p align='justify'>If this option is ON, it will display  the custom thumbnail image (loaded using the setting below) when there is no featured image assigned to the blog item.</p>
<p align='justify'>A situation where no individual post featured images are set might be when there is no intent of have blog lists or a static blog page in the website, and are using blog widgets which link directly to single blog webpages that contain any imagery embedded in the main body content. &nbsp;In this situation, one might choose to create a custom placeholder for the widget thumbnail, which can be loaded below.</p>",'theme_admin'),
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
		);
		return $options;
	}

	function _option_blog_page_process($option,$value) {
		if(!empty($value)){
			//update_option( 'page_for_posts', $value );
		}
		return $value;
	}
}
