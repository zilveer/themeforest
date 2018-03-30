<?php

$blogPage = new QodeAdminPage("8", "Blog");
$qodeFramework->qodeOptions->addAdminPage("blogPage",$blogPage);

// Blog List and Single

$panel1 = new QodePanel("General","blog_list_single_panel" );
$blogPage->addChild("panel1",$panel1);
	
	$blog_disable_text_box = new QodeField("yesno","blog_disable_text_box","no","Disable Text Box","Enabling this option will disable box around posts text.", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_enable_blog_text_box_container", "dependence_show_on_yes" => ""));
	$panel1->addChild("blog_disable_text_box",$blog_disable_text_box);

	$enable_blog_text_box_container = new QodeContainer("enable_blog_text_box_container","blog_disable_text_box","yes");
	$panel1->addChild("enable_blog_text_box_container",$enable_blog_text_box_container);

		$blog_box_background_color = new QodeField("color","blog_box_background_color","","Box Background Color","Default color is #ffffff.");
		$enable_blog_text_box_container->addChild("blog_box_background_color",$blog_box_background_color);

		$blog_box_border_color = new QodeField("color","blog_box_border_color","","Box Border Color","Default color is trasparent.");
		$enable_blog_text_box_container->addChild("blog_box_border_color",$blog_box_border_color);

	$blog_ql_background_color = new QodeField("color","blog_ql_background_color","","Quote/Link Box Background Color","Default color is #ffffff.");
	$panel1->addChild("blog_ql_background_color",$blog_ql_background_color);

	$blog_ql_hover_background_color = new QodeField("color","blog_ql_hover_background_color","","Quote/Link Box Background Hover Color","Default color is #e6ae48.");
	$panel1->addChild("blog_ql_hover_background_color",$blog_ql_hover_background_color);

// Blog List

$panel2 = new QodePanel("Blog List", "blog_list_panel");
$blogPage->addChild("panel2",$panel2);

	$blog_style = new QodeField("select","blog_style","1","Archive and Category Layout","Choose a default blog layout for archived Blog Lists and Category Blog Lists", array(
		"1" => "Blog Large Image",
		"3" => "Blog Large Image Whole Post",
		"2" => "Blog Masonry",
		"5" => "Blog Masonry Full Width",
		"4" => "Blog Chequered",
		"6" => "Blog Animated",
		"7" => "Blog Centered",
		"8" => "Blog Pinterest Full Width"
      ));
	$panel2->addChild("blog_style",$blog_style);

	$category_blog_sidebar = new QodeField("select","category_blog_sidebar","default","Archive and Category Sidebar","Choose a sidebar layout for archived Blog Lists and Category Blog Lists", array( 
		"default" => "No Sidebar",
		"1" => "Sidebar 1/3 right",
		"2" => "Sidebar 1/4 right",
		"3" => "Sidebar 1/3 left",
		"4" => "Sidebar 1/4 left"
      ));
	$panel2->addChild("category_blog_sidebar",$category_blog_sidebar);

	$blog_hide_comments = new QodeField("yesno","blog_hide_comments","no","Hide Comments","Enabling this option will hide comments on Blog List");
	$panel2->addChild("blog_hide_comments",$blog_hide_comments);

	$blog_hide_author = new QodeField("yesno","blog_hide_author","no","Hide Author","Enabling this option will hide author name on Blog List and Blog Single");
	$panel2->addChild("blog_hide_author",$blog_hide_author);

	$qode_like = new QodeField("onoff","qode_like","on","Likes",'Enabling this option will turn on "Likes"');
	$panel2->addChild("qode_like",$qode_like);

	$wp_read_more = new QodeField("onoff","wp_read_more","off","Enable Wordpress Read More Tag",'Enabling this option will turn on WordPress read more functionality.');
	$panel2->addChild("wp_read_more",$wp_read_more);

	$disable_quote_link_mark = new QodeField("yesno","disable_quote_link_mark","no","Disable Quote/Link Icon","Enabling this option will disable icon mark for Quote and Link posts.");
	$panel2->addChild("disable_quote_link_mark",$disable_quote_link_mark);

	$blog_page_range = new QodeField("text","blog_page_range","","Pagination Page Range",'Enter the number of numerals to be displayed before the "..." (For example, enter "3" to get "1 2 3...")', array(), array("col_width" => 3));
	$panel2->addChild("blog_page_range",$blog_page_range);

	$number_of_chars = new QodeField("text","number_of_chars","45","Number of Words in Blog Listing",'Enter the number of words to be displayed per post in Blog List', array(), array("col_width" => 3));
	$panel2->addChild("number_of_chars",$number_of_chars);

	$number_of_chars_masonry = new QodeField("text","number_of_chars_masonry","","Number of Words in Masonry/Pinterest",'Enter the number of words to be displayed per post in "Masonry/Pinterest" Blog List (Note: this overrides "Word Number" above)', array(), array("col_width" => 3));
	$panel2->addChild("number_of_chars_masonry",$number_of_chars_masonry);

	$number_of_chars_large_image = new QodeField("text","number_of_chars_large_image","","Number of Words in Large Image",'Enter the number of words to be displayed per post in "Large Image" Blog List (Note: this overrides "Word Number" above)', array(), array("col_width" => 3));
	$panel2->addChild("number_of_chars_large_image",$number_of_chars_large_image);

	$number_of_chars_chequered = new QodeField("text","number_of_chars_chequered","","Number of Words in Chequered",'Enter the number of words to be displayed per post in "Chequered" Blog List (Note: this overrides "Word Number" above)', array(), array("col_width" => 3));
	$panel2->addChild("number_of_chars_chequered",$number_of_chars_chequered);

	$number_of_chars_animated = new QodeField("text","number_of_chars_animated","","Number of Words in Animated",'Enter the number of words to be displayed per post in "Animated" Blog List (Note: this overrides "Word Number" above)', array(), array("col_width" => 3));
	$panel2->addChild("number_of_chars_animated",$number_of_chars_animated);

	$number_of_chars_centered = new QodeField("text","number_of_chars_centered","","Number of Words in Centered",'Enter the number of words to be displayed per post in "Centered" Blog List (Note: this overrides "Word Number" above)', array(), array("col_width" => 3));
	$panel2->addChild("number_of_chars_centered",$number_of_chars_centered);

	$pagination = new QodeField("zeroone","pagination","1","Pagination","Enabling this option will display pagination on bottom of Blog List");
	$panel2->addChild("pagination",$pagination);

	$pagination_masonry = new QodeField("select","pagination_masonry","pagination","Pagination on Masonry",'Choose a pagination style for "Masonry" Blog List', array( 
		"pagination" => "Pagination",
		"load_more" => "Load More",
		"infinite_scroll" => "Infinite Scroll"
      ));
	$panel2->addChild("pagination_masonry",$pagination_masonry);

	$blog_masonry_filter = new QodeField("yesno","blog_masonry_filter","no","Show Category Filter on Masonry",'Enabling this option will display a Category Filter on "Masonry" Blog List');
	$panel2->addChild("blog_masonry_filter",$blog_masonry_filter);	

	$blog_masonry_article_overlay_color = new QodeField("color","blog_masonry_article_overlay_color","","Masonry Image Hover Color","Default color is #e6ae48.");
	$panel2->addChild("blog_masonry_article_overlay_color",$blog_masonry_article_overlay_color);

	$blog_masonry_article_overlay_transparency = new QodeField("text","blog_masonry_article_overlay_transparency","","Masonry Image Hover Color Transparnecy","Choose a transparency for image hover color for blog masonry list and latest posts shortcode boxes type (0 = fully transparent, 1 = opaque). Note: If image hover color has not been chosen, transparency will not be displayed", array(), array("col_width" => 3));
	$panel2->addChild("blog_masonry_article_overlay_transparency",$blog_masonry_article_overlay_transparency);

	$blog_masonry_icon_plus_color = new QodeField("color","blog_masonry_icon_plus_color","","Masonry Image Icon Color","Default color is #393939.");
	$panel2->addChild("blog_masonry_icon_plus_color",$blog_masonry_icon_plus_color);

	$blog_masonry_icon_plus_background_color = new QodeField("color","blog_masonry_icon_plus_background_color","","Masonry Image Icon Background Color","Default color is #fff.");
	$panel2->addChild("blog_masonry_icon_plus_background_color",$blog_masonry_icon_plus_background_color);

	$blog_loading_type = new QodeField("select","blog_loading_type","","Loading Type",'Choose a loading type  for "Masonry" and "Pinterest" Blog Lists (Note that Appear from Bottom loading type does not work with Infinite Scroll)', array(
		"" => "Default",
		"blog_appear_from_bottom" => "Appear from Bottom"
	));
	$panel2->addChild("blog_loading_type",$blog_loading_type);

// Blog Single

$panel3 = new QodePanel("Blog Single", "blog_single_panel");
$blogPage->addChild("panel3",$panel3);

	$blog_single_sidebar = new QodeField("select","blog_single_sidebar","default","Sidebar Layout","Choose a sidebar layout for Blog Single pages", array( 
		"default" => "No Sidebar",
		"1" => "Sidebar 1/3 right",
		"2" => "Sidebar 1/4 right",
		"3" => "Sidebar 1/3 left",
		"4" => "Sidebar 1/4 left"
      ));
	$panel3->addChild("blog_single_sidebar",$blog_single_sidebar);
	
	$custom_sidebars = array();
	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
		if(isUserMadeSidebar(ucwords($sidebar['name']))){
			$custom_sidebars[$sidebar['id']] = ucwords( $sidebar['name']);
		}
	}
	$blog_single_sidebar_custom_display = new QodeField("selectblank","blog_single_sidebar_custom_display","","Sidebar to Display","Choose a sidebar to display on Blog Single pages", $custom_sidebars);
	$panel3->addChild("blog_single_sidebar_custom_display",$blog_single_sidebar_custom_display);

	$blog_single_hide_date = new QodeField("yesno","blog_single_hide_date","no","Hide Date","Enabling this option will hide date on Blog Single posts");
	$panel3->addChild("blog_single_hide_date",$blog_single_hide_date);

	$blog_single_hide_category = new QodeField("yesno","blog_single_hide_category","no","Hide Category","Enabling this option will hide category/categories on Blog Single posts");
	$panel3->addChild("blog_single_hide_category",$blog_single_hide_category);

	$blog_author_info = new QodeField("yesno","blog_author_info","no","Show Blog Author","Enabling this option will display author name and descriptions on Blog Single pages", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_enable_blog_author_info_container"));
	$panel3->addChild("blog_author_info",$blog_author_info);

		$enable_blog_author_info_container = new QodeContainer("enable_blog_author_info_container","blog_author_info","no");
		$panel3->addChild("enable_blog_author_info_container",$enable_blog_author_info_container);

			$disable_author_info_email = new QodeField("yesno","disable_author_info_email","no","Hide Author Email","Enabling this option will hide author email");
			$enable_blog_author_info_container->addChild("disable_author_info_email",$disable_author_info_email);

	$blog_single_hide_comments = new QodeField("yesno","blog_single_hide_comments","no","Hide Comments","Enabling this option will hide comments on Blog Single posts");
	$panel3->addChild("blog_single_hide_comments",$blog_single_hide_comments);

	$blog_single_audio_style = new QodeField("select","blog_single_audio_style","no","Audio Bar Style","Select style for audio bar on Blog Single posts", array(
		"" 		=> "Default",
		"dark" 	=> "Dark"
	));
	$panel3->addChild("blog_single_audio_style",$blog_single_audio_style);

	$group1 = new QodeGroup("Elements Spacing","Define values for spacing between elements.");
	$panel3->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$blog_single_space_after_image = new QodeField("textsimple","blog_single_space_after_image","","Spacing after image (px)","This is some description");
			$row1->addChild("blog_single_space_after_image",$blog_single_space_after_image);

			$blog_single_space_after_title = new QodeField("textsimple","blog_single_space_after_title","","Spacing after title (px)","This is some description");
			$row1->addChild("blog_single_space_after_title",$blog_single_space_after_title);

			$blog_single_space_after_info = new QodeField("textsimple","blog_single_space_after_info","","Spacing after info (px)","This is some description");
			$row1->addChild("blog_single_space_after_info",$blog_single_space_after_info);

	$group2 = new QodeGroup("Social Share","Define social share layout.");
	$panel3->addChild("group2",$group2);

	$row1 = new QodeRow();
	$group2->addChild("row1",$row1);

		$blog_single_social_share_type = new QodeField("selectsimple","blog_single_social_share_type","no","Social Share Type","This is some description", array(
			"circle" 	=> "Circle",
			"regular" 	=> "Regular"
		));
		$row1->addChild("blog_single_social_share_type",$blog_single_social_share_type);

		$blog_single_space_before_share = new QodeField("textsimple","blog_single_space_before_share","","Spacing before social share (px)","This is some description");
		$row1->addChild("blog_single_space_before_share",$blog_single_space_before_share);
