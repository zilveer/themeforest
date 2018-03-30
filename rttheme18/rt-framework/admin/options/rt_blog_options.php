<?php

$options = array (

	array(
	"name"    => __("Info",'rt_theme_admin'),
	"desc"    => __('The &#39;Blog options&#39; below only apply to post category, archive and single post pages. To have more control on how to display blog posts, customize the "<a href="admin.php?page=rt_template_options">Default Blog Template</a>" or create a new template in which you insert rows-, columns- & blog-modules or any other module your choice. Each module can be adjusted, and thus change its behaviour, by changing the in the module available settings. To learn more, go to the <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read the "How To Create A Blog" steps.','rt_theme_admin'),
	"type"    => "info"),				
			array(
					"name" => __("BLOG COLUMN LAYOUT",'rt_theme_admin'), 
					"type" => "heading"),				   			

			array(
					"name"    => __("Layout",'rt_theme_admin'),
					"desc"    => __("Select and set a default column layout for the Blog category & archive listing pages for each of the (single) post items listed within those pages.",'rt_theme_admin'),
					"id"      => RT_THEMESLUG."_blog_layout",
					"options" =>  array(
								"five" => "1/5", 
								"four" => "1/4",
								"three" => "1/3",
								"two" => "1/2",
								"one" => "1/1"
							  ),			
					"default" => "one", 
					"type"    => "select"),


	array(
	"name" => __("BLOG CONTENT LENGTH",'rt_theme_admin'), 
	"type" => "heading"),				   			

	array(
	"desc"    => __("As default the full blog content will be displayed on the blog listing pages and blog categories. 
					Enable the <a href=\"http://en.support.wordpress.com/splitting-content/excerpts/\">Excerpts</a> ( check the 'Use excerpts..' box below ) to minify the content automatically by using WordPress's excerpt option. 
					You can keep disabled and split your content manually by using <a href=\"http://en.support.wordpress.com/splitting-content/more-tag/\">The More Tag</a>",'rt_theme_admin'),
	"type"    => "info"),	

	array(
	"name"      => __("Use excerpts for listing pages and blog categories",'rt_theme_admin'),
	"desc"      => __("If enabled (checked) excerpts will be displayed for blog listing pages and categories instead of full post content.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_use_excerpts",
	"type"      => "checkbox2",
	"default"   => "on",
	),
 

	array(
	"name" => __("CUSTOMIZE",'rt_theme_admin'), 
	"type" => "heading"),		

	array(
	"name"      => __("Listing Style",'rt_theme_admin'),
	"desc"      => __('Select and set one of the three listing styles for the blog listing pages.','rt_theme_admin'),
	"id"      => RT_THEMESLUG."_blog_list_style",
	"options"   => array('style1'=>'Style One  ( Big Date Boxes )','style2'=>'Style Two ( Post Type Icons )','style3'=>'Style Three ( Classic ) '),					
	"hr"        => true,
	"default"   => "style1",
	"type"      => "select"),

	array(
	"name"    => __("Post Date Format",'rt_theme_admin'),
	"desc"      => __("Choose and set a date format as explained in the wordpress codex reference guide. <a href='http://codex.wordpress.org/Formatting_Date_and_Time' target='_blank'>Formatting Date and Time</a>",'rt_theme_admin'),
	"id"      => RT_THEMESLUG."_date_format",
	"default" => "F j, Y",
	"type"    => "text"),	 

	array(
	"name" => __("SINGLE POST PAGE",'rt_theme_admin'), 
	"type" => "heading"),	

	array(
	"name"    => __("Author info box under posts.",'rt_theme_admin'),
	"id"      => RT_THEMESLUG."_hide_author_info",
	"desc"    => 'If enabled (checked) a information box will appear under the posts displaying information about the author who wrote the post. Make sure to update your "Biographical Info" on your <a href="profile.php">profile page</a>.',
	"hr"		=> "true",
	"type"    => "checkbox2"), 

	array(
	"name"    => __("POST META INFORMATION BAR",'rt_theme_admin'), 
	"type"    => "heading"), 

	array(
	"name"      => __("Show the Author name in the meta information bar",'rt_theme_admin'),
	"desc"      => __("If enabled (checked) the author name is shown inside the blog list or single post item meta information bar.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_show_author",
	"type"      => "checkbox2",
	"default"   => "on",
	),

	array(
	"name"      => __("Show Categories in the meta information bar",'rt_theme_admin'),
	"desc"      => __("If enabled (checked) the post categories are shown inside the the blog list or single post item meta information bar.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_show_categories",
	"type"      => "checkbox2",
	"default"   => "on",
	), 		

	array(
	"name"      => __("Show Comment Numbers in the meta information bar",'rt_theme_admin'),
	"desc"      => __("If enabled (checked) the number of comments attached to the post is shown inside the blog list or single post item meta information bar.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_show_commnent_numbers",
	"type"      => "checkbox2"
	), 	

	array(
	"name"      => __("Show Small Dates in the meta information bar",'rt_theme_admin'),
	"desc"      => __("If enabled (checked) the date the blog post has been published / created is shown inside the blog list or single post item meta information bar.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_show_small_dates",
	"type"      => "checkbox2"
	), 		

	array(
			"name" => __("BREADCRUMBS PATH",'rt_theme_admin'), 
			"type" => "heading"
		),
	
	array(
			"name"    => __("Default Blog Page Breadcrumb Path",'rt_theme_admin'),
			"desc"    => __("Select and set a default Blog page to add to your breadcrumbs path. This page will be added to the breadcrumbs path in front of every single blog post item. <br /><br /><strong>Note</strong> : this only applies to the breadcrumbs path and will not have any influence on the permalink structure (the url) of the post.",'rt_theme_admin'),
			"id"      => RT_THEMESLUG."_blog_page",
			"options" =>  $this->rt_get_pages(), 			
			"default" => "", 
			"select"  => "select a page",
			"type"    => "select"),

	array(
	"name"    => __("DEFAULT BLOG LAYOUT",'rt_theme_admin'), 
	"type"    => "heading"), 

	array(
	"name"    => __("Default Layout for Blog Pages",'rt_theme_admin'),
	"desc"    => __('Select and set a default layout for your categories, archive and single post pages.','rt_theme_admin'),
	"id"      => RT_THEMESLUG."_sidebar_position_blog",
	"select"  => __("Select",'rt_theme_admin'),
				"options" =>  array(
				"right"   => 	"Content + Right Sidebar", 
				"left"    => 	"Content + Left Sidebar",
				"full"    => 	"Full Width - No Sidebar",
				),
	"hr"      => true,
	"default" => "right",
	"type"    => "select"),				

); 
?>