<?php
global $shortname;
$shortname = 'cv';


// Sidebars array
$sidebars = array("sidebar-blog" => "Blog Page Sidebar");
$cnt = get_option($shortname.'_sidebars_count', 10);			// get_theme_option can't use - array not exists
for ($i=1; $i<=$cnt; $i++) {
	$sidebars['sidebar-custom-'.$i] = 'Custom sidebar '.$i;
}

$theme_options = array();

$fonts = getFontsList(false);

$resume_title = get_theme_option('resume_title') != '' ? get_theme_option('resume_title') : __('Resume', 'wpspace');
$portfolio_title = get_theme_option('portfolio_title') != '' ? get_theme_option('portfolio_title') : __('Portfolio', 'wpspace');
$testi_title = get_theme_option('testi_title') != '' ? get_theme_option('testi_title') : __('Testimonials', 'wpspace');
$contacts_title = get_theme_option('contacts_title') != '' ? get_theme_option('contacts_title') : __('Contacts', 'wpspace');
$sections_list = array(
	'resume' => $resume_title,
	'portfolio' => $portfolio_title,
	'testimonials' => $testi_title,
	'contacts' => $contacts_title
);
$custom_resume_title = get_theme_option('section_sort');

$temp_sort_array = array();

if(!empty($custom_resume_title)) {
	$custom_resume_title = explode(',', $custom_resume_title);
	foreach ($custom_resume_title as $key => $val) {
		$temp_sort_array[$val] = $sections_list[$val];
	}
	if(!empty($temp_sort_array)) {
		$sections_list = $temp_sort_array;	
	}
}

/*
###############################
#### General               #### 
###############################
*/
$theme_options[] = array( "name" => __('General', 'wpspace'),
			"type" => "heading");

$theme_options[] = array( "name" => __('Sections sorting','wpspace'),
			"desc" => __('Sorting homepage sections','wpspace'),
			"id" => $shortname . '_' . "section_sort",
			"std" => "",
			"type" => "sortable",
			"options" => $sections_list);
			
$theme_options[] = array( "name" => __('Use as homepage', 'wpspace'),
			"desc" => __('What page use as homepage', 'wpspace'),
			"id" => $shortname."_"."homepage",
			"std" => "resume",
			"type" => "select",
			"options" => array("resume"=>"Resume page", "blog"=>"Blog streampage"));
			
$theme_options[] = array( "name" => __('Theme style', 'wpspace'),
			"desc" => __('What style use for site decoration', 'wpspace'),
			"id" => $shortname."_"."theme_style",
			"std" => "dark",
			"type" => "select",
			"options" => array("light"=>"Light style", "dark"=>"Dark style"));
			
$theme_options[] = array( "name" => __('Show Theme style switcher', 'wpspace'),
			"desc" => __('Show theme style switcher', 'wpspace'),
			"id" => $shortname."_"."theme_style_switcher",
			"std" => "1",
			"type" => "radio",
			"options" => array("1"=>"Yes", "0"=>"No"));
			
$theme_options[] = array( "name" => __('Theme font', 'wpspace'),
   			"desc" => __('Select theme main font', 'wpspace'),
   			"id" => $shortname."_"."theme_font",
   			"std" => "Lato",
   			"type" => "select",
   			"options" => $fonts);
   
$theme_options[] = array( "name" => __('Favicon', 'wpspace'),
			"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. (<a href="http://www.favicon.cc/">www.favicon.cc</a>)</em>', 'wpspace'),
			"id" => $shortname."_"."favicon",
			"std" => "",
			"type" => "upload");

$theme_options[] = array( "name" => __('Portfolio posts per page',  'wpspace'),
			"desc" => "How many portfolio posts show on homepage",
			"id" => $shortname . '_' . "portfolio_ppp",
			"std" => "9",
			"type" => "list",
			"options" => array(3, 6, 9, 12, 15, 18, 21, 24, 27, 30));
			
$theme_options[] = array( "name" => __('Sorting type for resume section',  'wpspace'),
			"desc" => __("Choose sorting type for resume section (ASC or DESC)", "wpspace"),
			"id" => $shortname . '_' . "resume_sorting",
			"std" => "desc",
			"type" => "select",
			"options" => array('asc'=>'Ascending', 'desc'=>'Descending'));
			
$theme_options[] = array( "name" => __('Show Google map on contact page', 'wpspace'),
			"desc" => __('Show Google map in Contact section', 'wpspace'),
			"id" => $shortname."_"."google_map",
			"std" => "1",
			"type" => "radio",
			"options" => array("1"=>"Yes", "0"=>"No"));
			
$theme_options[] = array( "name" => __('Show Contact form on contact page', 'wpspace'),
			"desc" => __('Show form in Contact section', 'wpspace'),
			"id" => $shortname."_"."contact_form",
			"std" => "1",
			"type" => "radio",
			"options" => array("1"=>"Yes", "0"=>"No"));

$theme_options[] = array( "name" => __('Show post excerpt in portfolio preview', 'wpspace'),
			"desc" => __('Enable to show post content in portfolio section', 'wpspace'),
			"id" => $shortname."_"."portfolio_excerpt",
			"std" => "0",
			"type" => "radio",
			"options" => array("1"=>"Yes", "0"=>"No"));

$theme_options[] = array( "name" => __('Show "Print" and "Download" buttons in Resume section', 'wpspace'),
			"desc" => __('Enable to show resume buttons', 'wpspace'),
			"id" => $shortname."_"."resume_buttons",
			"std" => "1",
			"type" => "radio",
			"options" => array("1"=>"Yes", "0"=>"No"));

$theme_options[] = array( "name" => __('Resume file', 'wpspace'),
			"desc" => __('Upload a resume file (.pdf, .doc, etc)', 'wpspace'),
			"id" => $shortname."_"."resume",
			"std" => "",
			"type" => "upload");

$theme_options[] = array( "name" => __('Footer copyright text',  'wpspace'),
			"desc" => "Enter the text to be displayed in footer",
			"id" => $shortname . '_' . "footer_copyright",
			"std" => "WPSpace &copy; 2013 All Rights Reserved",
			"type" => "textarea");

$theme_options[] = array( "name" => __('Analytics tracking code',  'wpspace'),
			"desc" => "Insert Google Analytics tracking code here",
			"id" => $shortname . '_' . "tracking_code",
			"std" => "",
			"type" => "textarea");
			
$theme_options[] = array( "name" => __('Image dimensions', 'wpspace'),
			"desc" => __('What dimensions use for uploaded image: Original or "Retina ready" (twice enlarged)', 'wpspace'),
			"id" => $shortname."_"."retina_ready",
			"std" => "1",
			"type" => "select",
			"options" => array("1"=>"Original", "2"=>"Retina"));
			
$theme_options[] = array( "name" => __('Additional filters in admin panel', 'wpspace'),
			"desc" => __('Show additional filters (on post format and tags) in admin panel page "Posts"', 'wpspace'),
			"id" => $shortname."_"."admin_add_filters",
			"std" => "1",
			"type" => "radio",
			"options" => array("1"=>"Yes", "0"=>"No"));
			
$theme_options[] = array( "name" => __('Resume date format', 'wpspace'),
			"desc" => __('Choose resume date output format', 'wpspace'),
			"id" => $shortname."_"."resume_date_format",
			"std" => "m",
			"type" => "select",
			"options" => array("m"=>date('m'), 'M'=>date('M'), "F"=>date('F')));

$theme_options[] = array( "name" => __('Link resume title',  'wpspace'),
			"desc" => "Make the heading resume item a link",
			"id" => $shortname . '_' . "resume_title_link",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array("yes" => "Yes", "no" => "No"));

$theme_options[] = array( "name" => __('Show quote icon',  'wpspace'),
			"desc" => "Show quote icon in Testimonials section",
			"id" => $shortname . '_' . "quote_icon",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array("yes" => "Yes", "no" => "No"));

$theme_options[] = array( "name" => __('Profile section collapsed by default',  'wpspace'),
			"desc" => "Make profile section collapsed by default",
			"id" => $shortname . '_' . "profile_collapsed",
			"std" => "no",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array("yes" => "Yes", "no" => "No"));
/*
###############################
#### 	Section titles     #### 
###############################
*/
$theme_options[] = array( "name" => __('Section titles', 'wpspace'),
			"type" => "heading");
			
$theme_options[] = array( "name" => __('Section Expanded by Default', 'wpspace'),
			"desc" => __('Select the section that will be expanded by default', 'wpspace'),
			"id" => $shortname."_"."expanded_section",
			"std" => "-1",
			"type" => "select",
			"options" => array('-1'=>__('None','wpspace'), '0'=> '1', '1'=> '2', '2'=> '3', '3'=> '4', '4'=> '5'));

$theme_options[] = array( "name" => __('Profile section title',  'wpspace'),
			"desc" => "",
			"id" => $shortname . '_' . "profile_title",
			"std" => "Profile",
			"type" => "text");

$theme_options[] = array( "name" => __('Resume section title',  'wpspace'),
			"desc" => "",
			"id" => $shortname . '_' . "resume_title",
			"std" => "Resume",
			"type" => "text");

$theme_options[] = array( "name" => __('Testimonials section title',  'wpspace'),
			"desc" => "",
			"id" => $shortname . '_' . "testi_title",
			"std" => "Testimonials",
			"type" => "text");

$theme_options[] = array( "name" => __('Portfolio section title',  'wpspace'),
			"desc" => "",
			"id" => $shortname . '_' . "portfolio_title",
			"std" => "Portfolio",
			"type" => "text");

$theme_options[] = array( "name" => __('Contacts section title',  'wpspace'),
			"desc" => "",
			"id" => $shortname . '_' . "contacts_title",
			"std" => "Contacts",
			"type" => "text");

/*
###############################
#### Profile               #### 
###############################
*/
$theme_options[] = array( "name" => __('Profile', 'wpspace'),
			"type" => "heading");

$theme_options[] = array( "name" => __('Lastname',  'wpspace'),
			"desc" => "Your lastname",
			"id" => $shortname . '_' . "user_lastname",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Firstname',  'wpspace'),
			"desc" => "Your firstname",
			"id" => $shortname . '_' . "user_firstname",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Photo',  'wpspace'),
			"desc" => "Your photo",
			"id" => $shortname . '_' . "user_photo",
			"std" => "",
			"type" => "upload");

$theme_options[] = array( "name" => __('Position',  'wpspace'),
			"desc" => "Your current position",
			"id" => $shortname . '_' . "user_position",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Birthday',  'wpspace'),
			"desc" => "Date of birth",
			"id" => $shortname . '_' . "user_birthday",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Address',  'wpspace'),
			"desc" => "Your post address. Example: 200 E, MAIN ST, PHOENIX, AZ, 85123, USA",
			"id" => $shortname . '_' . "user_address",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Phone',  'wpspace'),
			"desc" => "Phone number",
			"id" => $shortname . '_' . "user_phone",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Email',  'wpspace'),
			"desc" => "Your main email",
			"id" => $shortname . '_' . "user_email",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Contact form Email',  'wpspace'),
			"desc" => "Your contact form email",
			"id" => $shortname . '_' . "user_contact_email",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Website',  'wpspace'),
			"desc" => "Your website (if present)",
			"id" => $shortname . '_' . "user_website",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Company',  'wpspace'),
			"desc" => "Company name",
			"id" => $shortname . '_' . "user_company",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Description',  'wpspace'),
			"desc" => "Few words about you (to show on mainpage in profile section)",
			"id" => $shortname . '_' . "user_description",
			"std" => "",
			"cols" => 50,
			"rows" => 6,
			"type" => "textarea");

$theme_options[] = array( "name" => __('Profile enable',  'wpspace'),
			"desc" => "Do you want show profile page on your website?",
			"id" => $shortname . '_' . "profile_enable",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array("yes" => "Yes", "no" => "No"));
			
/*
###############################
#### Social                #### 
###############################
*/
$theme_options[] = array( "name" => __('Social', 'wpspace'),
			"type" => "heading");

$theme_options[] = array( "name" => __('Show social icons in header',  'wpspace'),
			"desc" => "Do you want show social networks links in header area on your site",
			"id" => $shortname . '_' . "social_links_in_header",
			"std" => "true",
			"type" => "checkbox");

$theme_options[] = array( "name" => __('Twitter',  'wpspace'),
			"desc" => "Link to your Twitter profile",
			"id" => $shortname . '_' . "social_links_twitter",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Skype',  'wpspace'),
			"desc" => "Your skype profile name",
			"id" => $shortname . '_' . "social_links_skype",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Facebook',  'wpspace'),
			"desc" => "Link to your Facebook profile",
			"id" => $shortname . '_' . "social_links_facebook",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Vimeo',  'wpspace'),
			"desc" => "Link to your Vimeo profile",
			"id" => $shortname . '_' . "social_links_vimeo",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Google Plus',  'wpspace'),
			"desc" => "Link to your gplus profile",
			"id" => $shortname . '_' . "social_links_gplus",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Dribbble',  'wpspace'),
			"desc" => "Link to your Dribbble profile",
			"id" => $shortname . '_' . "social_links_dribble",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('LinkedIn',  'wpspace'),
			"desc" => "Link to your LinkedIn profile",
			"id" => $shortname . '_' . "social_links_linkedin",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('RSS',  'wpspace'),
			"desc" => "Link to your RSS profile",
			"id" => $shortname . '_' . "social_links_rss",
			"std" => "",
			"type" => "text");
			
$theme_options[] = array( "name" => __('Pinterest',  'wpspace'),
			"desc" => "Link to your Pinterest profile",
			"id" => $shortname . '_' . "social_links_pinterest",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Xing',  'wpspace'),
			"desc" => "Link to your Xing profile",
			"id" => $shortname . '_' . "social_links_xing",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('SlideShare',  'wpspace'),
			"desc" => "Link to your SlideShare profile",
			"id" => $shortname . '_' . "social_links_slideshare",
			"std" => "",
			"type" => "text");

$theme_options[] = array( "name" => __('Additional social accout 1',  'wpspace'),
			"desc" => __( "Additional social network 1. Account url", 'wpspace' ),
			"id" => $shortname . '_' . "additional_account_url_1",
			"std" => "",
			"type" => "text");
			
$theme_options[] = array( "name" => __('Custom social network icon 1', 'wpspace'),
			"id" => $shortname."_"."additional_network_icon_1",
			"std" => "",
			"type" => "upload");

$theme_options[] = array( "name" => __('Additional social accout 2',  'wpspace'),
			"desc" => __( "Additional social network 2. Account url", 'wpspace' ),
			"id" => $shortname . '_' . "additional_account_url_2",
			"std" => "",
			"type" => "text");
			
$theme_options[] = array( "name" => __('Custom social network icon 2', 'wpspace'),
			"id" => $shortname."_"."additional_network_icon_2",
			"std" => "",
			"type" => "upload");

$theme_options[] = array( "name" => __('Additional social accout 3',  'wpspace'),
			"desc" => __( "Additional social network 3. Account url", 'wpspace' ),
			"id" => $shortname . '_' . "additional_account_url_3",
			"std" => "",
			"type" => "text");
			
$theme_options[] = array( "name" => __('Custom social network icon 3', 'wpspace'),
			"id" => $shortname."_"."additional_network_icon_3",
			"std" => "",
			"type" => "upload");

/*
###############################
#### Blog                  #### 
###############################
*/
$theme_options[] = array( "name" => __('Blog', 'wpspace'),
			"type" => "heading");

$theme_options[] = array( "name" => __('Blog enabled',  'wpspace'),
			"desc" => "Do you want show blog posts on your site?",
			"id" => $shortname . '_' . "blog_enable",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array("yes" => "Yes", "no" => "No"));
			
$theme_options[] = array( "name" => __('Show post author',  'wpspace'),
			"desc" => "Show post author information block in single post page",
			"id" => $shortname . '_' . "blog_show_post_author",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array("yes" => "Yes", "no" => "No"));

$theme_options[] = array( "name" => __('Show post social share',  'wpspace'),
			"desc" => "Show social share block in single post page",
			"id" => $shortname . '_' . "blog_show_post_share",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array("yes" => "Yes", "no" => "No"));

$theme_options[] = array( "name" => __('Show post tags',  'wpspace'),
			"desc" => "Show tags block in single post page",
			"id" => $shortname . '_' . "blog_show_post_tags",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array("yes" => "Yes", "no" => "No"));

$theme_options[] = array( "name" => __('Show related posts',  'wpspace'),
			"desc" => "Show related posts block in single post page",
			"id" => $shortname . '_' . "blog_show_related_posts",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array("yes" => "Yes", "no" => "No"));
			
$theme_options[] = array( "name" => __('Show full date',  'wpspace'),
			"desc" => "Enable to show full post date in post header",
			"id" => $shortname . '_' . "full_date",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array("yes" => "Yes", "no" => "No"));

$theme_options[] = array( "name" => __('Show teaser in full post',  'wpspace'),
			"desc" => "Show teaser content before the more text. ",
			"id" => $shortname . '_' . "show_teaser",
			"std" => false,
			"type" => "radio",
			"style" => "horizontal",
			"options" => array(false => "Yes", true => "No"));

$theme_options[] = array( "name" => __('Show "Scroll to Comment Form" button',  'wpspace'),
			"desc" => "Enable to show 'Scroll to Comment Form' button ",
			"id" => $shortname . '_' . "comment_button",
			"std" => true,
			"type" => "radio",
			"style" => "horizontal",
			"options" => array(true => "Yes", false => "No"));

$theme_options[] = array( "name" => __('Blog post title level', 'wpspace'),
			"desc" => __('Define html-tag for post title (SEO-option)', 'wpspace'),
			"id" => $shortname."_"."title_level",
			"std" => "2",
			"type" => "select",
			"options" => array("h1", "h2", "h3", "h4", "h5", "h6"));

/*
########################
####Sidebars Options#### 
########################
*/
$theme_options[] = array( "name" => __('Sidebars', 'wpspace'),
			"type" => "heading");
			
$theme_options[] = array( "name" => __('Additional sidebars count',  'wpspace'),
			"desc" => __('Select additional sidebars count (you can organize it in Theme Options - Widgets and use it in every page (post)',  'wpspace'),
			"id" => $shortname . "_" . "sidebars_count",
			"std" => "10",
			"type" => "list",
			"options" => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20));

$theme_options[] = array( "name" => __('Select sidebar for blog page',  'wpspace'),
			"desc" => __('Select default sidebar for blog page.',  'wpspace'),
			"id" => $shortname . "_" . "sidebar_current_blog",
			"std" => "sidebar-blog",
			"type" => "select",
			"options" => $sidebars);
			
$theme_options[] = array( "name" => __('Show sidebar on blog page',  'wpspace'),
			"desc" => __('Show or hide sidebar on blog page.',  'wpspace'),
			"id" => $shortname . '_' . 'sidebar_position_blog',
			"std" => "right",
			"type" => "select",
			"options" => array('right'=>'Show', 'fullwidth'=>'Hide'));

$theme_options[] = array( "name" => __('Select sidebar for single pages (posts)',  'wpspace'),
			"desc" => __('Select default sidebar for all single pages (posts). In each page (post) you can override this settings.',  'wpspace'),
			"id" => $shortname . "_" . "sidebar_current_single",
			"std" => "sidebar-blog",
			"type" => "select",
			"options" => $sidebars);
			
$theme_options[] = array( "name" => __('Show sidebar on single pages (posts)',  'wpspace'),
			"desc" => __('Show sidebar on single pages (posts). In each page (post) you can override this settings.',  'wpspace'),
			"id" => $shortname . '_' . 'sidebar_position_single',
			"std" => "right",
			"type" => "select",
			"options" => array('right'=>'Show', 'fullwidth'=>'Hide'));


/*
###############################
####Colors for each section#### 
###############################
*/
$theme_options[] = array( "name" => __('Colors', 'wpspace'),
			"type" => "heading");

$theme_options[] = array( "name" => __('Profile section color',  'wpspace'),
			"desc" => __('Color for Profile section tab',  'wpspace'),
			"id" => $shortname . "_" . "color_profile",
			"std" => "#019875",
			"type" => "color");

$theme_options[] = array( "name" => __('Resume section color',  'wpspace'),
			"desc" => __('Color for Resume section tab',  'wpspace'),
			"id" => $shortname . "_" . "color_resume",
			"std" => "#cb8d44",
			"type" => "color");

$theme_options[] = array( "name" => __('Download resume button color',  'wpspace'),
			"desc" => __('Color of download link',  'wpspace'),
			"id" => $shortname . "_" . "color_download",
			"std" => "#019875",
			"type" => "color");

$theme_options[] = array( "name" => __('Testimonials section color',  'wpspace'),
			"desc" => __('Color for Testimonials section tab',  'wpspace'),
			"id" => $shortname . "_" . "color_testi",
			"std" => "#C4D747",
			"type" => "color");

$theme_options[] = array( "name" => __('Portfolio section color',  'wpspace'),
			"desc" => __('Color for Portfolio section tab',  'wpspace'),
			"id" => $shortname . "_" . "color_portfolio",
			"std" => "#980101",
			"type" => "color");

$theme_options[] = array( "name" => __('Contacts section color',  'wpspace'),
			"desc" => __('Color for Contacts section tab',  'wpspace'),
			"id" => $shortname . "_" . "color_contacts",
			"std" => "#815b97",
			"type" => "color");

$theme_options[] = array( "name" => __('Go to Blog button color',  'wpspace'),
			"desc" => __('Color for "Go to Blog" button',  'wpspace'),
			"id" => $shortname . "_" . "color_blog_button",
			"std" => "#267ac8",
			"type" => "color");

$theme_options[] = array( "name" => __('Go to Profile button color',  'wpspace'),
			"desc" => __('Color for "Back to Profile" button',  'wpspace'),
			"id" => $shortname . "_" . "color_profile_button",
			"std" => "#019875",
			"type" => "color");

$theme_options[] = array( "name" => __('Blog posts date section color',  'wpspace'),
			"desc" => __('Color for "Post date" tab for each posts type',  'wpspace'),
			"std" => 'In this section you can change default colors for each "Post date" tab',
			"type" => "info");

$theme_options[] = array( "name" => __('Standard post',  'wpspace'),
			"desc" => __('Color for "Post date" tab in Standard posts',  'wpspace'),
			"id" => $shortname . "_" . "color_post_date_standard",
			"std" => "#267ac8",
			"type" => "color");

$theme_options[] = array( "name" => __('Gallery post',  'wpspace'),
			"desc" => __('Color for "Post date" tab in Gallery posts',  'wpspace'),
			"id" => $shortname . "_" . "color_post_date_gallery",
			"std" => "#019875",
			"type" => "color");

$theme_options[] = array( "name" => __('Audio post',  'wpspace'),
			"desc" => __('Color for "Post date" tab in Audio posts',  'wpspace'),
			"id" => $shortname . "_" . "color_post_date_audio",
			"std" => "#cb8d44",
			"type" => "color");

$theme_options[] = array( "name" => __('Video post',  'wpspace'),
			"desc" => __('Color for "Post date" tab in Video posts',  'wpspace'),
			"id" => $shortname . "_" . "color_post_date_video",
			"std" => "#980101",
			"type" => "color");

$theme_options[] = array( "name" => __('Link post',  'wpspace'),
			"desc" => __('Color for "Post date" tab in Link posts',  'wpspace'),
			"id" => $shortname . "_" . "color_post_date_link",
			"std" => "#815b97",
			"type" => "color");

$theme_options[] = array( "name" => __('Status post',  'wpspace'),
			"desc" => __('Color for "Post date" tab in Status posts',  'wpspace'),
			"id" => $shortname . "_" . "color_post_date_status",
			"std" => "#ebb72c",
			"type" => "color");

$theme_options[] = array( "name" => __('Quote post',  'wpspace'),
			"desc" => __('Color for "Post date" tab in Quote posts',  'wpspace'),
			"id" => $shortname . "_" . "color_post_date_quote",
			"std" => "#33cccc",
			"type" => "color");

$theme_options[] = array( "name" => __('Comments scroll button color',  'wpspace'),
			"desc" => __('Background color for "scroll to comment form" button',  'wpspace'),
			"id" => $shortname . "_" . "comments_scroll_color",
			"std" => "#815b97",
			"type" => "color");


// Load current values for all theme options
load_all_theme_options();



/*-----------------------------------------------------------------------------------*/
/* Get all options array
/*-----------------------------------------------------------------------------------*/
function load_all_theme_options() {
	global $theme_options;
	foreach ($theme_options as $k => $item) {
		if (isset($item['id'])) {
			if (($val = get_option($item['id'], false)) !== false)
				$theme_options[$k]['val'] = $val;
			else
				$theme_options[$k]['val'] = $theme_options[$k]['std'];
		}
	}
}


/* ==========================================================================================
   ==  Get theme option. If not exists - try get site option. If not exist - return default
   ========================================================================================== */
function get_theme_option($option_name, $default = false) {
	global $shortname, $theme_options;
	$fullname = my_substr($option_name, 0, my_strlen($shortname.'_')) == $shortname.'_' ? $option_name : $shortname.'_'.$option_name;
	if (($val = get_option($fullname, false)) !== false) {
		return $val;
	} else {
		$val = false;
		foreach($theme_options as $option) {
			if (isset($option['id']) && $option['id'] == $fullname) {
				$val = $option['val'];
				break;
			}
		}
		if ($val === false) {
			if (($val = get_option($option_name, false)) !== false) {
				return $val;
			} else {
				return $default;
			}
		} else {
			return $val;
		}
	}
}


/* ==========================================================================================
   ==  Update theme option
   ========================================================================================== */
function update_theme_option($option_name, $value) {
	global $shortname, $theme_options;
	$fullname = my_substr($option_name, 0, my_strlen($shortname.'_')) == $shortname.'_' ? $option_name : $shortname.'_'.$option_name;
	foreach($theme_options as $k=>$option) {
		if (isset($option['id']) && $option['id'] == $fullname) {
			$theme_options[$k]['val'] = $value;
			update_option($fullname, $value);
			break;
		}
	}
}
?>