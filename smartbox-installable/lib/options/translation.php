<?php

$designare_translation_options= array( array(
"name" => "Language Settings",
"type" => "title",
"img" => DESIGNARE_IMAGES_URL."icon_translate.png"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"general", "name"=>"General"), array("id"=>"projects", "name"=>"Projects"), array("id"=>"blog", "name"=>"Blog"), array("id"=>"comment", "name"=>"Comments"), array("id"=>"search", "name"=>"Search"), array("id"=>"contactform", "name"=>"Contact Form"))
),

/* ------------------------------------------------------------------------*
 * GENERAL TEXTS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'general'
),

array(
	"name" => "You are here text",
	"id" => DESIGNARE_SHORTNAME."_you_are_here",
	"type" => "text",
	"std" => "You are here:"
),

array(
	"name" => "Latest from Twitter",
	"id" => DESIGNARE_SHORTNAME."_latest_for_twitter",
	"type" => "text",
	"std" => "Latest from <span class=text_color>Twitter</span>"
),

array(
	"name" => "Open Menu",
	"id" => DESIGNARE_SHORTNAME."_open_menu",
	"type" => "text",
	"std" => "Open Menu"
),

array(
	"name" => "Mobile Menu Back Text",
	"id" => DESIGNARE_SHORTNAME."_mobile_menu_back_text",
	"type" => "text",
	"std" => "Back"
),


array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * PROJECTS TEXTS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'projects'
),

array(
"name" => "Filter by text",
"id" => DESIGNARE_SHORTNAME."_filter_by",
"type" => "text",
"std" => "Filter by"
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * BLOG TEXTS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'blog'
),

array(
"name" => "Read more text",
"id" => DESIGNARE_SHORTNAME."_read_more",
"type" => "text",
"std" => "read more"
),

array(
	"name" => "Previous Posts",
	"id" => DESIGNARE_SHORTNAME."_previous_text",
	"type" => "text",
	"std" => "Previous Posts"
),

array(
	"name" => "Next Posts",
	"id" => DESIGNARE_SHORTNAME."_next_text",
	"type" => "text",
	"std" => "Next Posts"
),

array(
"name" => "No posts available text",
"id" => DESIGNARE_SHORTNAME."_no_posts_available",
"type" => "text",
"std" => "No posts available"
),

array(
"name" => "By text",
"id" => DESIGNARE_SHORTNAME."_by_text",
"type" => "text",
"std" => "by"
),

array(
"name" => "In text",
"id" => DESIGNARE_SHORTNAME."_in_text",
"type" => "text",
"std" => "In"
),

array(
"name" => "Tags text",
"id" => DESIGNARE_SHORTNAME."_tags_text",
"type" => "text",
"std" => "Tags"
),

array(
"name" => "Load More Posts text",
"id" => DESIGNARE_SHORTNAME."_load_more_posts_text",
"type" => "text",
"std" => "Load More Posts"
),

array(
"name" => "No more posts text",
"id" => DESIGNARE_SHORTNAME."_no_more_posts_text",
"type" => "text",
"std" => "No more posts to load."
),

array(
"name" => "Loading Posts text",
"id" => DESIGNARE_SHORTNAME."_loading_posts_text",
"type" => "text",
"std" => "Loading posts..."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * COMMENTS TEXTS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'comment'
),


array(
"name" => "No comments text",
"id" => DESIGNARE_SHORTNAME."_no_comments_text",
"type" => "text",
"std" => "No comments"
),

array(
"name" => "Comment text",
"id" => DESIGNARE_SHORTNAME."_comment_text",
"type" => "text",
"std" => "comment"
),

array(
"name" => "Comments text",
"id" => DESIGNARE_SHORTNAME."_comments_text",
"type" => "text",
"std" => "comments"
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * SEARCH TEXTS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'search'
),

array(
"name" => "Search box text",
"id" => DESIGNARE_SHORTNAME."_search_box_text",
"type" => "text",
"std" => "Find what you want..."
),

array(
"name" => "Search results text",
"id" => DESIGNARE_SHORTNAME."_search_results_text",
"type" => "text",
"std" => "Search results for"
),

array(
"name" => "No results found text",
"id" => DESIGNARE_SHORTNAME."_no_results_text",
"type" => "text",
"std" => "No results found."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * CONTACT FORM
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'contactform'
),

array(
"name" => "Name text",
"id" => DESIGNARE_SHORTNAME."_cf_name",
"type" => "text",
"std" => "Name"
),

array(
"name" => "Email text",
"id" => DESIGNARE_SHORTNAME."_cf_email",
"type" => "text",
"std" => "Email"
),

array(
"name" => "Message text",
"id" => DESIGNARE_SHORTNAME."_cf_message",
"type" => "text",
"std" => "Message"
),

array(
"name" => "Send Button text",
"id" => DESIGNARE_SHORTNAME."_cf_send",
"type" => "text",
"std" => "Send"
),

array(
"type" => "close"),

array(
"type" => "close"));

designare_add_options($designare_translation_options);