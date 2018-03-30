<?php
return array(
	"title" => __("Blog", "theme_admin"),
	"shortcode" => 'blog',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Number of Columns",'theme_admin'),
			"id" => "column",
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
			"name" => __("Grid Layout",'theme_admin'),
			"id" => "grid",
			"desc" => __("If the option is on, it will use grid layout for multiple column.",'theme_admin'),
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Frame",'theme_admin'),
			"desc" => __("MultiFlex provides the option to place each post within a frame, which has options for background color, border color, etc below.  The &#34;default&#34; option reverts to the Box Frame Layout setting in the Blog Panel->Static Blog Page Settings tab.",'theme_admin'),
			"id" => "frame",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Frame Background Color (Optional)&#x200E;",'theme_admin'),
			"id" => "frame_bgColor",
			"default" => '',
			"type" => "color"
		),
		array(
			"name" => __("Frame Border Color (Optional)&#x200E;",'theme_admin'),
			"id" => "frame_borderColor",
			"default" => '',
			"type" => "color"
		),
		array(
			"name" => __("Frame Border Thickness (Optional)&#x200E;",'theme_admin'),
			"id" => "frame_borderThickness",
			"default" => 1,
			"min" => 1,
			"max" => 20,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Divider Line Color (Optional)&#x200E;",'theme_admin'),
			"desc" => __("This is to set the color of the lines above and below the meta information",'theme_admin'),
			"id" => "divider_color",
			"default" => '',
			"type" => "color"
		),
		array(
			"name" => __("Post Count per Page",'theme_admin'),
			"desc" => __("Number of posts to show per page",'theme_admin'),
			"id" => "count",
			"default" => '3',
			"min" => 1,
			"max" => 50,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Category(s) (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Use this selector to select a category for the blog list one is showing in the page or post. &nbsp;If one desires to have more then one category to show in the bloglist, select other categories using this setting (not the Multiple Categories setting below).<br /><br />Note : &nbsp;In the content editor, the categories will show by their numeric id in the shortcode string, not their name.",'theme_admin'),
			"id" => "cat",
			"default" => '',
			"target" => 'cat',
			"chosen" => true,
			"prompt" => __("Select Categories..",'theme_admin'),
			"type" => "multiselect",
		),
		array(
			"name" => __("Multiple Categories (Optional)&#x200E;",'theme_admin'),
			"desc" => __("This setting is not for choosing to have multiple categories to display.  &nbsp;Instead, it is to choose posts which are assigned to more then one category, and only have those posts that are 'cross-listed' to multiple categories displaying in the blog list.",'theme_admin'),
			"id" => "category__and",
			"default" => '',
			"target" => 'cat',
			"chosen" => true,
			"prompt" => __("Select Categories..",'theme_admin'),
			"type" => "multiselect",
		),
		array(
			"name" => __("Exclude Categorie (Optional)&#x200E;",'theme_admin'),
			"id" => "category__not_in",
			"default" => '',
			"target" => 'cat',
			"chosen" => true,
			"prompt" => __("Select Categories..",'theme_admin'),
			"type" => "multiselect",
		),
		array(
			"name" => __("Choose Specific Posts (Optional)&#x200E;",'theme_admin'),
			"desc" => __("All your posts will show in the list below, and this is a multiselector - so hold down the ctrl key while using the mouse if wanting to select multiple posts.",'theme_admin'),
			"id" => "posts",
			"default" => array(),
			"chosen" => true,
			"target" => 'post',
			"prompt" => __("Select Posts..",'theme_admin'),
			"type" => "multiselect",
		),
		array(
			"name" => __("Select by Author (Optional)&#x200E;",'theme_admin'),
			"id" => "author",
			"default" => array(),
			"chosen" => true,
			"target" => 'author',
			"prompt" => __("Select Authors..",'theme_admin'),
			"type" => "multiselect",
		),
		array(
			"name" => __("Post Sorting Parameter",'theme_admin'),
			"desc" => __("For all the Post items chosen for this list, there are two sorting options for the order in which they display. &nbsp;This setting concerns the primary sorting parameter which include sorting by: date, author, wp id number, comment count, etc. &nbsp;There are 10 parameters in total. of course, some of the options below would not be applicable depending on what is being shown - for example if only displaying the posts of 1 author, the Order by Author filter is of course not relevant!",'theme_admin'),
			"id" => "orderby",
			"default" => 'date',
			"options" => array(
				"none" => __("No order",'theme_admin'),
				"ID" => __("Order by post id",'theme_admin'),
				"author" => __("Order by author",'theme_admin'),
				"title" => __("Order by title",'theme_admin'),
				"name" => __("Order by post name (post slug)",'theme_admin'),
				"date" => __("Order by date",'theme_admin'),
				"modified" => __("Order by last modified date",'theme_admin'),
				"parent" => __("Order by post/page parent id",'theme_admin'),
				"rand" => __("Random order",'theme_admin'),
				"comment_count" => __("Order by number of comments",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Display the Posts in Ascending or Descending Order",'theme_admin'),
			"desc" => __("In the above settings, the types of posts, and filters have been set (or not be applicable). This setting is to display those posts in ascending or descending order.  Ascending order is oldest first and descending order is newest post first.",'theme_admin'),
			"id" => "order",
			"default" => 'DESC',
			"options" => array(
				"ASC" => __("ASC (ascending order)",'theme_admin'),
				"DESC" => __("DESC (descending order)",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Display Featured Image",'theme_admin'),
			"id" => "image",
			"desc" => __("If the option is on, it will display Featured Image (or the &#34;Different Image&#34; if that setting was used) of each blog post in the list",'theme_admin'),
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Set the Image Orientation",'theme_admin'),
			"id" => "imageType",
			"default" => '',
			"options" => array(
				"default" => __("Default",'theme_admin'),
				"full" => __("Full Width",'theme_admin'),
				"left" => __("Left Float",'theme_admin'),
				"right" => __("Right Float",'theme_admin'),
				"below" => __('Below Title','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Effect",'theme_admin'),
			"desc" => __("Effect when hover the feature image.",'theme_admin'),
			"id" => "effect",
			"default" => 'default',
			"options" => array(
				"default" => __("Default",'theme_admin'),
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
			"name" => __("Image Width",'theme_admin'),
			"desc" => __("The width of Image.  Remember that in choosing the image size it should be of the same size, or larger but respecting the image ratio (width x height) or wordpress will distort the image when it resizes it to the list thumbnail by cropping and scaling. ",'theme_admin'),
			"id" => "width",
			"default" => '630',
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Height (Optional)&#x200E;",'theme_admin'),
			"desc" => __("The height of Feature image.",'theme_admin'),
			"id" => "height",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Display Post Titles",'theme_admin'),
			"id" => "title",
			"desc" => __("If the option is on, it will display Title of blog post",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Length of Title",'theme_admin'),
			"desc" => __("If it's set to 0, it will output the full title",'theme_admin'),
			"id" => "title_length",
			"default" => '0',
			"min" => 0,
			"max" => 200,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Title Font Size",'theme_admin'),
			"id" => "title_fontSize",
			"min" => "0",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "0",
			"type" => "range"
		),
		array(
			"name" => __("Meta Information",'theme_admin'),
			"id" => "meta",
			"desc" => __("If the option is ON, it will display Meta Information of blog post",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Description",'theme_admin'),
			"id" => "desc",
			"desc" => __("If the option is on, it will display Description of blog post",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Length of Description",'theme_admin'),
			"desc" => __("If it's set to 0, it will use default setting.  Please note that for this setting, it is number of words, not characters.",'theme_admin'),
			"id" => "desc_length",
			"default" => '0',
			"min" => 0,
			"max" => 200,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Display Read More",'theme_admin'),
			"id" => "read_more",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Read More Text",'theme_admin'),
			"id" => "read_more_text",
			"default" => theme_get_option('blog','read_more_text'),
			"type" => "text",
		),
		array(
			"name" => __("Display Read More as Button",'theme_admin'),
			"id" => "read_more_button",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Display Full Post",'theme_admin'),
			"id" => "full",
			"desc" => __("If the option is on, it will display all content of the post",'theme_admin'),
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Nopaging",'theme_admin'),
			"id" => "nopaging",
			"desc" => __("If the option is on, it will disable pagination",'theme_admin'),
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Offset",'theme_admin'),
			"desc" => __("Number of post to displace or pass over.",'theme_admin'),
			"id" => "offset",
			"default" => '0',
			"min" => 0,
			"max" => 10,
			"step" => "1",
			"type" => "range"
		),
	),
);
