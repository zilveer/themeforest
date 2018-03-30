function embedshortcode() {
	var shortcodetext;
	var style = document.getElementById('shortcode_panel');
	if (style.className.indexOf('current') != -1) {
		var selected_shortcode = document.getElementById('style_shortcode').value;

		
// -----------------------------
// 	COLUMN LAYOUTS
// -----------------------------		
if (selected_shortcode == 'two_columns'){
	shortcodetext = "[one_half]<br />Content goes here...<br />[/one_half]<br /><br />[one_half_last]<br />Content goes here...<br />[/one_half_last]<br />"; }
if (selected_shortcode == 'three_columns'){
	shortcodetext = "[one_third]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />Content goes here...<br />[/one_third_last]<br />"; }
if (selected_shortcode == 'four_columns'){
	shortcodetext = "[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />Content goes here...<br />[/one_fourth_last]<br />"; }
if (selected_shortcode == 'five_columns'){
	shortcodetext = "[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth_last]<br />Content goes here...<br />[/one_fifth_last]<br />"; }
if (selected_shortcode == 'six_columns'){
	shortcodetext = "[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth_last]<br />Content goes here...<br />[/one_sixth_last]<br />"; }
if (selected_shortcode == 'one_fourth_three_fourth_columns'){
	shortcodetext = "[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[three_fourth_last]<br />Content goes here...<br />[/three_fourth_last]<br />"; }
if (selected_shortcode == 'three_fourth_one_fourth_columns'){
	shortcodetext = "[three_fourth]<br />Content goes here...<br />[/three_fourth]<br /><br />[one_fourth_last]<br />Content goes here...<br />[/one_fourth_last]<br />"; }
if (selected_shortcode == 'two_thirds_one_third_columns'){
	shortcodetext = "[two_thirds]<br />Content goes here...<br />[/two_thirds]<br /><br />[one_third_last]<br />Content goes here...<br />[/one_third_last]<br />"; }
if (selected_shortcode == 'one_third_two_thirds_columns'){
	shortcodetext = "[one_third]<br />Content goes here...<br />[/one_third]<br /><br />[two_thirds_last]<br />Content goes here...<br />[/two_thirds_last]<br />"; }


// -----------------------------
// 	LISTS
// -----------------------------
if (selected_shortcode == 'arrow_list'){
	shortcodetext = "[arrow_list]<br><br>[list_item]Item 1...[/list_item]<br><br>[list_item]Item 2...[/list_item]<br><br>[list_item]Item 3...[/list_item]<br><br>[/arrow_list]<br />"; }
if (selected_shortcode == 'star_list'){
	shortcodetext = "[star_list]<br><br>[list_item]Item 1...[/list_item]<br><br>[list_item]Item 2...[/list_item]<br><br>[list_item]Item 3...[/list_item]<br><br>[/star_list]<br />"; }
if (selected_shortcode == 'circle_list'){
	shortcodetext = "[circle_list]<br><br>[list_item]Item 1...[/list_item]<br><br>[list_item]Item 2...[/list_item]<br><br>[list_item]Item 3...[/list_item]<br><br>[/circle_list]<br />"; }
if (selected_shortcode == 'check_mark_list'){
	shortcodetext = "[check_list]<br><br>[list_item]Item 1...[/list_item]<br><br>[list_item]Item 2...[/list_item]<br><br>[list_item]Item 3...[/list_item]<br><br>[/check_list]<br />"; }
if (selected_shortcode == 'caret_list'){
	shortcodetext = "[caret_list]<br><br>[list_item]Item 1...[/list_item]<br><br>[list_item]Item 2...[/list_item]<br><br>[list_item]Item 3...[/list_item]<br><br>[/caret_list]<br />"; }
if (selected_shortcode == 'plus_list'){
	shortcodetext = "[plus_list]<br><br>[list_item]Item 1...[/list_item]<br><br>[list_item]Item 2...[/list_item]<br><br>[list_item]Item 3...[/list_item]<br><br>[/plus_list]<br />"; }
if (selected_shortcode == 'double_angle_list'){
	shortcodetext = "[double_angle_list]<br><br>[list_item]Item 1...[/list_item]<br><br>[list_item]Item 2...[/list_item]<br><br>[list_item]Item 3...[/list_item]<br><br>[/double_angle_list]<br />"; }
if (selected_shortcode == 'full_arrow_list'){
	shortcodetext = "[full_arrow_list]<br><br>[list_item]Item 1...[/list_item]<br><br>[list_item]Item 2...[/list_item]<br><br>[list_item]Item 3...[/list_item]<br><br>[/full_arrow_list]<br />"; }


// -----------------------------
// 	SHORTCODE ELEMENTS
// -----------------------------
if (selected_shortcode == 'businesscontact'){
	shortcodetext = "[business_contact phone_number=\"\" fax_number=\"\" skype_username=\"\" skype_label=\"Skype\" email_address=\"\" directions_url=\"\" directions_label=\"get driving directions\"]"; }


if (selected_shortcode == 'single_accordion'){
	shortcodetext = "[accordion class='accord1']<br />[slide name=\"title1\"]slide content 1[/slide]<br />[slide name=\"title2\"]slide content 2[/slide]<br />[slide name=\"title3\"]slide content 3[/slide]<br />[/accordion]<br />";	}


if (selected_shortcode == 'multiple_accordion'){
	shortcodetext = "[accordion class='accord1' active='1']<br />[slide name=\"Accordion 1 title 1\"]You can make this slide open by default by using active='1'[/slide]<br />[slide name=\"title 2\"]slide content 2[/slide]<br />[slide name=\"title 3\"]slide content 3[/slide]<br />[/accordion]<br />[accordion class='accord2' active='2']<br />[slide name=\"Accordion 2 title 1\"]slide content 1[/slide]<br />[slide name=\"title 2\"]You can make this slide open by default by using active='2'[/slide]<br />[slide name=\"title 3\"]slide content 3[/slide]<br />[/accordion]<br />"; }


if (selected_shortcode == 'tabs'){
	shortcodetext = "[tabset tab1=\"tab 1 title\" tab2=\"tab 2 title\"]<br />[tab]tab 1 content[/tab]<br /><br />[tab]tab 2 content[/tab]<br />[/tabset]<br />"; }


if (selected_shortcode == 'testimonials'){
	shortcodetext = "[testimonial_wrap]<br />[testimonial]Content goes here...[client_name]John Doe, Company Name[/client_name][/testimonial]<br />[testimonial]Content goes here...[client_name]John Doe, Company Name[/client_name][/testimonial]<br />[testimonial]Content goes here...[client_name]John Doe, Company Name[/client_name][/testimonial]<br />[/testimonial_wrap]<br />";	}


if (selected_shortcode == 'team_members'){
	shortcodetext = "[team_member members_name=\"\" members_title=\"\" style=\"modern\" image_path=\"\" link_to_page=\"\" description=\"\"]<br /><h4>John Doe, CEO</h4><p>Insert Bio Here</p><br />[/team_member]"; }


if (selected_shortcode == 'related_posts'){ shortcodetext = "[related_posts limit=\"5\" title=\"Related Posts\"]<br />"; }
if (selected_shortcode == 'latest_tweets'){ shortcodetext = "[latest_tweets user=\"your_user_name_here\" num=\"3\"]<br />";	}


if (selected_shortcode == 'layouts_video_left'){
	shortcodetext = "[video_left][video_frame]<br />[iframe url=\"URL to video here...\" width=\"572\" height=\"312\"]<br />[/video_frame]<br /><br />[video_text]<br />[h2]Title goes here...[/h2]<br />Content goes here...<br />[/video_text][/video_left]<br />"; }


if (selected_shortcode == 'layouts_video_right'){
	shortcodetext = "[video_right][video_frame]<br />[iframe url=\"URL to video here...\" width=\"572\" height=\"312\"]<br />[/video_frame]<br /><br />[video_text]<br />[h2]Title goes here...[/h2]<br />Content goes here...<br />[/video_text][/video_right]<br />";	}	


if (selected_shortcode == 'fontawesome'){
	shortcodetext = "[tt_vector icon=\"\" size=\"fa-3x\" border=\"false\" pull=\"\" color=\"\"]"; }
	
	
if (selected_shortcode == 'fontawesome_iconbox'){
	shortcodetext = "[tt_vector_box icon=\"\" size=\"fa-4x\" color=\"\" link_to_page=\"\" target=\"\" description=\"\"]<br />[h3]Title goes here...[/h3]<br />Content goes here...<br />[/tt_vector_box]"; }


if (selected_shortcode == 'social_vector'){shortcodetext = "[social style=\"vector\" show_title=\"true\" target=\"_self\" rss=\"\" twitter=\"\" facebook=\"\" email=\"\" flickr=\"\" youtube=\"\" linkedin=\"\" pinterest=\"\" instagram=\"\" foursquare=\"\" delicious=\"\" digg=\"\" google=\"\" dribbble=\"\" skype=\"\" rss_title=\"RSS\" twitter_title=\"Twitter\" facebook_title=\"Facebook\" email_title=\"Email\" flickr_title=\"Flickr\" youtube_title=\"YouTube\" linkedin_title=\"Linkedin\" pinterest_title=\"Pinterest\" instagram_title=\"Instagram\" foursquare_title=\"FourSquare\" delicious_title=\"Delicious\" digg_title=\"Digg\" google_title=\"Google +\" dribbble_title=\"Dribbble\" skype_title=\"Skype\"]"; }


if (selected_shortcode == 'social_vector_color'){shortcodetext = "[social style=\"vector_color\" show_title=\"true\" target=\"_self\" rss=\"\" twitter=\"\" facebook=\"\" email=\"\" flickr=\"\" youtube=\"\" linkedin=\"\" pinterest=\"\" instagram=\"\" foursquare=\"\" delicious=\"\" digg=\"\" google=\"\" dribbble=\"\" skype=\"\" rss_title=\"RSS\" twitter_title=\"Twitter\" facebook_title=\"Facebook\" email_title=\"Email\" flickr_title=\"Flickr\" youtube_title=\"YouTube\" linkedin_title=\"Linkedin\" pinterest_title=\"Pinterest\" instagram_title=\"Instagram\" foursquare_title=\"FourSquare\" delicious_title=\"Delicious\" digg_title=\"Digg\" google_title=\"Google +\" dribbble_title=\"Dribbble\" skype_title=\"Skype\"]"; }

if (selected_shortcode == 'gap_it_up'){
	shortcodetext = "[gap size=\"50px\"]"; }


// -----------------------------
// 	INDIVIDUAL IMAGE FRAMES
// -----------------------------
if (selected_shortcode == 'image_frame_banner_large'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"banner_full\"]<br />"; }
if (selected_shortcode == 'image_frame_full_2col'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"two_col_large\"]<br />";	}
if (selected_shortcode == 'image_frame_full_3col'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_large\"]<br />"; }
if (selected_shortcode == 'image_frame_full_3col_square'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_square\"]<br />"; }
if (selected_shortcode == 'image_frame_full_4col'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />"; }
if (selected_shortcode == 'image_frame_portrait_large'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"portrait_full\"]<br />";	}
if (selected_shortcode == 'image_frame_portrait_small'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"portrait_thumb\"]<br />"; }
if (selected_shortcode == 'image_frame_banner_medium'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"banner_regular\"]<br />"; }
if (selected_shortcode == 'image_frame_sidenav_2col'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"two_col_small\"]<br />";	}
if (selected_shortcode == 'image_frame_sidenav_3col'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_small\"]<br />"; }
if (selected_shortcode == 'image_frame_sidenav_4col'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_small\"]<br />"; }
if (selected_shortcode == 'image_frame_banner_small'){
	shortcodetext = "[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"banner_small\"]<br />"; }


// -----------------------------
// 	DIVIDERS
// -----------------------------
if (selected_shortcode == 'basic_divider'){ shortcodetext = "[hr]<br />"; }
if (selected_shortcode == 'shadow_divider'){ shortcodetext = "[hr_shadow]<br />"; }
if (selected_shortcode == 'toplink_divider'){ shortcodetext = "[top_link]text for link[/top_link]<br />"; }


// -----------------------------
// 	BUTTONS
// -----------------------------
if (selected_shortcode == 'AlphaGreen_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"alphagreen\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Autumn_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"autumn\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Black_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"black\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'BlueGrey_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"bluegrey\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'BuoyRed_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"buoyred\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Cherry_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"cherry\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'CoolBlue_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"coolblue\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Coffee_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"coffee\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'ForestGreen_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"forestgreen\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'FrenchGreen_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"frenchgreen\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Fire_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"fire\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Golden_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"golden\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Grey_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"grey\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'LimeGreen_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"limegreen\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Orange_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"orange\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Periwinkle_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"periwinkle\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Pink_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"pink\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'PoliticalBlue_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"politicalblue\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Purple_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"purple\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'RoyalBlue_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"royalblue\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'SaffronBlue_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"saffronblue\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'SkyBlue_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"skyblue\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'SteelGreen_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"steelgreen\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Silver_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"silver\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Teal_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"teal\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'TufGreen_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"tufgreen\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'TealGrey_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"tealgrey\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'Violet_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"violet\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'VistaBlue_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"vistablue\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }
if (selected_shortcode == 'YogiGreen_button'){
	shortcodetext = "[button url=\"http://\" target=\"\" size=\"small\" style=\"yogigreen\" icon=\"\" popup=\"\" title=\"\"]Content goes here...[/button]<br />"; }

// -----------------------------
// 	TEXT STYLING
// -----------------------------
if (selected_shortcode == 'heading_horizontal'){ shortcodetext = "[heading_horizontal type=\"h6\" margin_top=\"20px\" margin_bottom=\"20px\"]Text goes here...[/heading_horizontal]<br />"; }
if (selected_shortcode == 'text_callout1'){ shortcodetext = "[callout1]Content goes here...[/callout1]<br />"; }
if (selected_shortcode == 'text_callout2'){ shortcodetext = "[callout2]Content goes here...[/callout2]<br />"; }
if (selected_shortcode == 'text_h1'){ shortcodetext = "[h1]Text goes here...[/h1]<br />"; }
if (selected_shortcode == 'text_h2'){ shortcodetext = "[h2]Text goes here...[/h2]<br />"; }
if (selected_shortcode == 'text_h3'){ shortcodetext = "[h3]Text goes here...[/h3]<br />"; }
if (selected_shortcode == 'text_h4'){ shortcodetext = "[h4]Text goes here...[/h4]<br />"; }
if (selected_shortcode == 'text_h5'){ shortcodetext = "[h5]Text goes here...[/h5]<br />"; }
if (selected_shortcode == 'text_h6'){ shortcodetext = "[h6]Text goes here...[/h6]<br />"; }


// -----------------------------
// 	NOTIFY BOXES
// -----------------------------
if (selected_shortcode == 'callout_green'){  shortcodetext = "[notify_box font_size=\"13px\" style=\"green\"]Content goes here...[/notify_box]<br />"; }
if (selected_shortcode == 'callout_blue'){   shortcodetext = "[notify_box font_size=\"13px\" style=\"blue\"]Content goes here...[/notify_box]<br />";}
if (selected_shortcode == 'callout_red'){    shortcodetext = "[notify_box font_size=\"13px\" style=\"red\"]Content goes here...[/notify_box]<br />";}
if (selected_shortcode == 'callout_yellow'){ shortcodetext = "[notify_box font_size=\"13px\" style=\"yellow\"]Content goes here...[/notify_box]<br />";}


// -----------------------------
// 	CALLOUT BOXES
// -----------------------------
if (selected_shortcode == 'color_callout_AlphaGreen'){    shortcodetext = "[callout font_size=\"13px\" style=\"alphagreen\"]Content goes here...[/callout]<br />";}
if (selected_shortcode == 'color_callout_Autumn'){        shortcodetext = "[callout font_size=\"13px\" style=\"autumn\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Black'){         shortcodetext = "[callout font_size=\"13px\" style=\"black\"]Content goes here...[/callout]<br />";}
if (selected_shortcode == 'color_callout_BlueGrey'){      shortcodetext = "[callout font_size=\"13px\" style=\"bluegrey\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_BuoyRed'){       shortcodetext = "[callout font_size=\"13px\" style=\"buoyred\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Cherry'){        shortcodetext = "[callout font_size=\"13px\" style=\"cherry\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_CoolBlue'){      shortcodetext = "[callout font_size=\"13px\" style=\"coolblue\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Coffee'){        shortcodetext = "[callout font_size=\"13px\" style=\"coffee\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_ForestGreen'){   shortcodetext = "[callout font_size=\"13px\" style=\"forestgreen\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_FrenchGreen'){   shortcodetext = "[callout font_size=\"13px\" style=\"frenchgreen\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Fire'){          shortcodetext = "[callout font_size=\"13px\" style=\"fire\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Golden'){        shortcodetext = "[callout font_size=\"13px\" style=\"golden\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Grey'){          shortcodetext = "[callout font_size=\"13px\" style=\"grey\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_LimeGreen'){     shortcodetext = "[callout font_size=\"13px\" style=\"limegreen\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Orange'){        shortcodetext = "[callout font_size=\"13px\" style=\"orange\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Periwinkle'){    shortcodetext = "[callout font_size=\"13px\" style=\"periwinkle\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Pink'){          shortcodetext = "[callout font_size=\"13px\" style=\"pink\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_PoliticalBlue'){ shortcodetext = "[callout font_size=\"13px\" style=\"politicalblue\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Purple'){        shortcodetext = "[callout font_size=\"13px\" style=\"purple\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_RoyalBlue'){     shortcodetext = "[callout font_size=\"13px\" style=\"royalblue\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_SaffronBlue'){   shortcodetext = "[callout font_size=\"13px\" style=\"saffronblue\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_SkyBlue'){       shortcodetext = "[callout font_size=\"13px\" style=\"skyblue\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_SteelGreen'){    shortcodetext = "[callout font_size=\"13px\" style=\"steelgreen\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Silver'){        shortcodetext = "[callout font_size=\"13px\" style=\"silver\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Teal'){          shortcodetext = "[callout font_size=\"13px\" style=\"teal\"]Content goes here...[/callout]<br />";	
}
if (selected_shortcode == 'color_callout_TufGreen'){      shortcodetext = "[callout font_size=\"13px\" style=\"tufgreen\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_TealGrey'){      shortcodetext = "[callout font_size=\"13px\" style=\"tealgrey\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_Violet'){        shortcodetext = "[callout font_size=\"13px\" style=\"violet\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_VistaBlue'){     shortcodetext = "[callout font_size=\"13px\" style=\"vistablue\"]Content goes here...[/callout]<br />"; }
if (selected_shortcode == 'color_callout_YogiGreen'){     shortcodetext = "[callout font_size=\"13px\" style=\"yogigreen\"]Content goes here...[/callout]<br />"; }


// -----------------------------
// 	HOMEPAGE LAYOUTS
// -----------------------------
if (selected_shortcode == 'homepage_layout_4_columns'){
	shortcodetext = "[callout1]Callout Content goes here...[/callout1]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth_last]<br /><br />";	}
if (selected_shortcode == 'homepage_layout_3_columns'){
	shortcodetext = "[callout1]Callout Content goes here...[/callout1]<br /><br />[one_third]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_large\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_large\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_large\"]<br />Content goes here...<br />[/one_third_last]<br /><br />"; }
if (selected_shortcode == 'homepage_layout_video_left'){
	shortcodetext = "[video_left][video_frame]<br />[iframe url=\"URL to video here...\" width=\"572\" height=\"312\"]<br />[/video_frame]<br /><br />[video_text]<br />[h2]Title goes here...[/h2]<br />Content goes here...<br />[/video_text][/video_left]<br /><br />[callout1]Callout Content goes here...[/callout1]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth_last]<br /><br />"; }
if (selected_shortcode == 'homepage_layout_video_right'){
	shortcodetext = "[video_right][video_frame]<br />[iframe url=\"URL to video here...\" width=\"572\" height=\"312\"]<br />[/video_frame]<br /><br />[video_text]<br />[h2]Title goes here...[/h2]<br />Content goes here...<br />[/video_text][/video_right]<br /><br />[callout1]Callout Content goes here...[/callout1]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth_last]<br /><br />"; }


// -----------------------------
// 	COLUMNS WITH IMAGES
// -----------------------------
if (selected_shortcode == 'layouts_full_2col_images'){
	shortcodetext = "[one_half]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\"  size=\"two_col_large\"]<br />Content goes here...<br />[/one_half]<br /><br />[one_half_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"two_col_large\"]<br />Content goes here...<br />[/one_half_last]<br /><br />"; }
if (selected_shortcode == 'layouts_full_3col_images'){
	shortcodetext = "[one_third]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_large\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_large\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_large\"]<br />Content goes here...<br />[/one_third_last]<br /><br />";	}
if (selected_shortcode == 'layouts_full_3col_images_square'){
	shortcodetext = "[one_third]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_square\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_square\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_square\"]<br />Content goes here...<br />[/one_third_last]<br /><br />";	}
if (selected_shortcode == 'layouts_full_3col_portrait_images'){
	shortcodetext = "[one_third]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"portrait_thumb\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"portrait_thumb\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"portrait_thumb\"]<br />Content goes here...<br />[/one_third_last]<br /><br />";	}
if (selected_shortcode == 'layouts_full_4col_images'){
	shortcodetext = "[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth_last]<br /><br />"; }
if (selected_shortcode == 'layouts_sidenav_2col_images'){
	shortcodetext = "[one_half]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"two_col_small\"]<br />Content goes here...<br />[/one_half]<br /><br />[one_half_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"two_col_small\"]<br />Content goes here...<br />[/one_half_last]<br /><br />"; }
if (selected_shortcode == 'layouts_sidenav_3col_images'){
	shortcodetext = "[one_third]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_small\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_small\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"three_col_small\"]<br />Content goes here...<br />[/one_third_last]<br /><br />"; }
if (selected_shortcode == 'layouts_sidenav_4col_images'){
	shortcodetext = "[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_small\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_small\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_small\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />[frame style=\"modern\" image_path=\"\" link_to_page=\"\" target=\"\" description=\"\" float=\"\" lightbox=\"\" lightbox_group=\"\" size=\"four_col_small\"]<br />Content goes here...<br />[/one_fourth_last]<br /><br />"; }


// -----------------------------
// 	TRUETHEMES LATEST POSTS
// -----------------------------
if (selected_shortcode == 'blog_posts'){
	shortcodetext = "[blog_posts count=\"4\" post_category=\"\" title=\"From the Blog\" link_text=\"Read More\" character_count=\"115\" layout=\"default\" excluded_cat=\"\"]<br />"; }
if (selected_shortcode == 'blog_posts_full_2_column'){
	shortcodetext = "[blog_posts count=\"2\" post_category=\"\" title=\"From the Blog\" link_text=\"Read More\" character_count=\"115\" layout=\"two_col_large\" style=\"modern\" excluded_cat=\"\"]<br />"; }
if (selected_shortcode == 'blog_posts_full_3_column'){
	shortcodetext = "[blog_posts count=\"3\" post_category=\"\" title=\"From the Blog\" link_text=\"Read More\" character_count=\"115\" layout=\"three_col_large\" style=\"modern\" excluded_cat=\"\"]<br />"; }
if (selected_shortcode == 'blog_posts_full_4_column'){
	shortcodetext = "[blog_posts count=\"4\" post_category=\"\" title=\"From the Blog\" link_text=\"Read More\" character_count=\"115\" layout=\"four_col_large\" style=\"modern\" excluded_cat=\"\"]<br />"; }
if (selected_shortcode == 'blog_posts_side_2_column'){
	shortcodetext = "[blog_posts count=\"2\" post_category=\"\" title=\"From the Blog\" link_text=\"Read More\" character_count=\"115\" layout=\"two_col_small\" style=\"modern\" excluded_cat=\"\"]<br />"; }
if (selected_shortcode == 'blog_posts_side_3_column'){
	shortcodetext = "[blog_posts count=\"3\" post_category=\"\" title=\"From the Blog\" link_text=\"Read More\" character_count=\"115\" layout=\"three_col_small\" style=\"modern\" excluded_cat=\"\"]<br />"; }
if (selected_shortcode == 'blog_posts_side_4_column'){
	shortcodetext = "[blog_posts count=\"4\" post_category=\"\" title=\"From the Blog\" link_text=\"Read More\" character_count=\"115\" layout=\"four_col_small\" style=\"modern\" excluded_cat=\"\"]<br />";	}
	

// -----------------------------
// 	DEPRECATED SINCE KARMA 4.0
// -----------------------------
/* 
// 	INDIVIDUAL LIGHTBOXES
if (selected_shortcode == 'lightbox_full_2col'){
	shortcodetext = "[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"two_col_large\"]<br />"; }
if (selected_shortcode == 'lightbox_full_3col'){
	shortcodetext = "[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"three_col_large\"]<br />"; }
if (selected_shortcode == 'lightbox_full_4col'){
	shortcodetext = "[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"four_col_large\"]<br />"; }
if (selected_shortcode == 'lightbox_full_portrait_large'){
	shortcodetext = "[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"portrait_full\"]<br />"; }
if (selected_shortcode == 'lightbox_full_portrait_small'){
	shortcodetext = "[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"portrait_thumb\"]<br />"; }
if (selected_shortcode == 'lightbox_sidenav_2col'){
	shortcodetext = "[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"two_col_small\"]<br />"; }
if (selected_shortcode == 'lightbox_sidenav_3col'){
	shortcodetext = "[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"three_col_small\"]<br />"; }
if (selected_shortcode == 'lightbox_sidenav_4col'){
	shortcodetext = "[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"four_col_small\"]<br />"; }
// -------------------------	
// 	COLUMNS WITH LIGHTBOXES
// -------------------------
if (selected_shortcode == 'lightboxes_full_2col_images'){
	shortcodetext = "[one_half]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"two_col_large\"]<br />Content goes here...<br />[/one_half]<br /><br />[one_half_last]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"two_col_large\"]<br />Content goes here...<br />[/one_half_last]<br /><br />";	}
if (selected_shortcode == 'lightboxes_full_3col_images'){
	shortcodetext = "[one_third]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"three_col_large\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"three_col_large\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"three_col_large\"]<br />Content goes here...<br />[/one_third_last]<br /><br />";	}
if (selected_shortcode == 'lightboxes_full_3col_portrait_images'){
	shortcodetext = "[one_third]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"portrait_thumb\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"portrait_thumb\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"portrait_thumb\"]<br />Content goes here...<br />[/one_third_last]<br /><br />";	}
if (selected_shortcode == 'lightboxes_full_4col_images'){
	shortcodetext = "[one_fourth]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"four_col_large\"]<br />Content goes here...<br />[/one_fourth_last]<br /><br />"; }
if (selected_shortcode == 'lightboxes_sidenav_2col_images'){
	shortcodetext = "[one_half]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"two_col_small\"]<br />Content goes here...<br />[/one_half]<br /><br />[one_half_last]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"two_col_small\"]<br />Content goes here...<br />[/one_half_last]<br /><br />"; }
if (selected_shortcode == 'lightboxes_sidenav_3col_images'){
	shortcodetext = "[one_third]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"three_col_small\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"three_col_small\"]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"three_col_small\"]<br />Content goes here...<br />[/one_third_last]<br /><br />";	}
if (selected_shortcode == 'lightboxes_sidenav_4col_images'){
	shortcodetext = "[one_fourth]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"four_col_small\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"four_col_small\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"four_col_small\"]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />[lightbox style=\"modern\" image_path=\"\" popup=\"\" link_to_page=\"\" target=\"\" description=\"\" size=\"four_col_small\"]<br />Content goes here...<br />[/one_fourth_last]<br /><br />"; }
*/


if ( selected_shortcode == 0 ){tinyMCEPopup.close();}}
if(window.tinyMCE) {
window.tinyMCE.execCommand('mceInsertContent', false, shortcodetext);
tinyMCEPopup.editor.execCommand('mceRepaint');
tinyMCEPopup.close();
}return;
}
