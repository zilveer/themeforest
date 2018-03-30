<?php

$pexeto_translation_options= array( array(
"name" => "Translation",
"type" => "title",
"img" => "icon-microphone"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"settings", "name"=>"Settings"), array("id"=>"blog", "name"=>"Blog"), array("id"=>"comment", "name"=>"Comments"), array("id"=>"portfolio", "name"=>"Portfolio"), array("id"=>"search", "name"=>"Search"), array("id"=>"other", "name"=>"Other"))
),

/* ------------------------------------------------------------------------*
 * BLOG TEXTS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'settings'
),

array(
"name" => "Enable multilanguage translation",
"id" => PEXETO_SHORTNAME."_enable_translation",
"type" => "checkbox",
"std" => 'off',
"desc" => 'Enable this option when you set your installation in multiple languages, so you can use .mo files for the translation. 
When a single language is set, keep this option disabled and use the options from the "Translation" section to translate the default texts. If you would like to enable an additional language, you can use an additional .mo file for this language. For more
information please refer to the "Translation" section of the documentation.'
),

array(
"name" => "Default locale",
"id" => PEXETO_SHORTNAME."_def_locale",
"type" => "text",
"std" => "en_US",
"desc" => 'This is the default language locale. If the default selected language is different than English (US), you
have to insert the locale name here. The default language can be changed here in the "Translation" section, the additional
language texts should be set in a .mo file. For more information please refer to the "Translation" section of the documentation.'
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
"id" => PEXETO_SHORTNAME."_read_more",
"type" => "text",
"std" => "Read More"
),


array(
"name" => "Previous page text",
"id" => PEXETO_SHORTNAME."_previous_text",
"type" => "text",
"std" => "Previous"
),

array(
"name" => "Next page text",
"id" => PEXETO_SHORTNAME."_next_text",
"type" => "text",
"std" => "Next"
),

array(
"name" => "Learn more text",
"id" => PEXETO_SHORTNAME."_learn_more",
"type" => "text",
"std" => "Learn More"
),

array(
"name" => "No posts available text",
"id" => PEXETO_SHORTNAME."_no_posts_available",
"type" => "text",
"std" => "No posts available"
),

array(
"name" => "By text",
"id" => PEXETO_SHORTNAME."_by_text",
"type" => "text",
"std" => "Posted by"
),

array(
"name" => "At text",
"id" => PEXETO_SHORTNAME."_at_text",
"type" => "text",
"std" => "At"
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
"id" => PEXETO_SHORTNAME."_no_comments_text",
"type" => "text",
"std" => "No comments"
),


array(
"name" => "One omment text",
"id" => PEXETO_SHORTNAME."_one_comment_text",
"type" => "text",
"std" => "One comment"
),



array(
"name" => "Comments text",
"id" => PEXETO_SHORTNAME."_comments_text",
"type" => "text",
"std" => "comments"
),

array(
"name" => "Comment text",
"id" => PEXETO_SHORTNAME."_comment_text",
"type" => "text",
"std" => "comment"
),

array(
"name" => "Leave a comment text",
"id" => PEXETO_SHORTNAME."_leave_comment_text",
"type" => "text",
"std" => "Leave a comment"
),



array(
"name" => "Name text",
"id" => PEXETO_SHORTNAME."_comment_name_text",
"type" => "text",
"std" => "Name"
),

array(
"name" => "Email text",
"id" => PEXETO_SHORTNAME."_email_text",
"type" => "text",
"std" => "Email(will not be published)"
),

array(
"name" => "Website text",
"id" => PEXETO_SHORTNAME."_website_text",
"type" => "text",
"std" => "Website"
),

array(
"name" => "Your comment text",
"id" => PEXETO_SHORTNAME."_your_comment_text",
"type" => "text",
"std" => "Your comment"
),

array(
"name" => "Submit comment text",
"id" => PEXETO_SHORTNAME."_submit_comment_text",
"type" => "text",
"std" => "Submit Comment"
),

array(
"name" => "Reply to comment text",
"id" => PEXETO_SHORTNAME."_reply_text",
"type" => "text",
"std" => "Reply"
),

array(
"name" => "Leave a reply to text",
"id" => PEXETO_SHORTNAME."_leave_reply_to_text",
"type" => "text",
"std" => "Leave a reply to"
),

array(
"name" => "Cancel Reply",
"id" => PEXETO_SHORTNAME."_cancel_reply_text",
"type" => "text",
"std" => "Cancel Reply"
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * PORTFOLIO TEXTS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'portfolio'
),


array(
"name" => "All text",
"id" => PEXETO_SHORTNAME."_all_text",
"type" => "text",
"std" => "All"
),

array(
"name" => "Filter text",
"id" => PEXETO_SHORTNAME."_filter_text",
"type" => "text",
"std" => "Filter"
),

array(
"name" => "Load more text",
"id" => PEXETO_SHORTNAME."_load_more_text",
"type" => "text",
"std" => "Load More"
),

array(
"name" => "Back to gallery text",
"id" => PEXETO_SHORTNAME."_back_to_gallery_text",
"type" => "text",
"std" => "Back to gallery"
),

array(
"name" => "Info text",
"id" => PEXETO_SHORTNAME."_info_text",
"type" => "text",
"std" => "Info"
),

array(
"name" => "Share text",
"id" => PEXETO_SHORTNAME."_share_text",
"type" => "text",
"std" => "Share"
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
"id" => PEXETO_SHORTNAME."_search_text",
"type" => "text",
"std" => "Search..."
),

array(
"name" => "Search results text",
"id" => PEXETO_SHORTNAME."_search_results_text",
"type" => "text",
"std" => "Search results for"
),

array(
"name" => "No results found text",
"id" => PEXETO_SHORTNAME."_no_results_text",
"type" => "text",
"std" => "No results found. Try a different search?"
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * OTHER TEXTS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'other'
),

array(
"name" => "404 Page not found text",
"id" => PEXETO_SHORTNAME."_404_text",
"type" => "text",
"std" => "The requested page has not been found"
),

array(
"name" => "Footer Copyright text",
"id" => PEXETO_SHORTNAME."_copyright_text",
"type" => "text",
"std" => "Copyright &copy; Photolux by Pexeto"
),

array(
"name" => "Menu",
"id" => PEXETO_SHORTNAME."_menu_text",
"type" => "text",
"std" => "Menu"
),

array(
"name" => "Hide Menu",
"id" => PEXETO_SHORTNAME."_hide_menu_text",
"type" => "text",
"std" => "Hide Menu"
),

array(
"name" => "Show Menu",
"id" => PEXETO_SHORTNAME."_show_menu_text",
"type" => "text",
"std" => "Show Menu"
),


array(
"type" => "close"),

array(
"type" => "close"));

pexeto_add_options($pexeto_translation_options);