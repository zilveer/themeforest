<?php
/*
* This file consist of hooks available within the framework.
* @since version 2.6
*
*/

/*
* Located in header.php within <head> for use in hooking <meta> tags.
* @since version 2.6
*/
function truethemes_meta_hook(){

do_action('truethemes_meta_hook');

}

/*
* Located in header.php within <div class="top-holder"> before "Top Toolbar Menu" 
* @since version 2.6
* Will not be available if "Toolbar" is disabled in Site Option 
*/

function truethemes_before_top_toolbar_menu_hook(){

do_action('truethemes_before_top_toolbar_menu_hook');

}

/*
* Located in header.php within <div class="top-holder"> after "Toolbar- Right Side"
* since version 2.6 
* Will not be available if "Toolbar" is disabled in Site Option 
*/

function truethemes_after_top_toolbar_menu_hook(){

do_action('truethemes_after_top_toolbar_menu_hook');

}


/*
* Located in header.php before <div class="header-holder"> 
* @since 2.6
*/

function truethemes_before_header_holder_hook(){

do_action('truethemes_before_header_holder_hook');

}

/*
* Located in header.php before "Main Menu"
* @since 2.6
*/

function truethemes_before_primary_navigation_hook(){

do_action('truethemes_before_primary_navigation_hook');

}


/*
* Located in header.php after "Main Menu"
* @since 2.6
*/

function truethemes_after_primary_navigation_hook(){

do_action('truethemes_after_primary_navigation_hook');

}

/*
* Located in "document body" templates before <div id="main">
* @since 2.6
*/

function truethemes_before_main_hook(){

do_action('truethemes_before_main_hook');

}

/*
* Located in "document body" templates and in tools.php within <div class="frame">
* @since version 2.6
* Will not be available if "Utility Panel" is disabled in Site Option 
*/

function truethemes_before_article_title_hook(){

do_action('truethemes_before_article_title_hook');

}


/*
* Located in "document body" templates and in tools.php within <div class="frame">
* @since version 2.6
* Will not be available if "Utility Panel" is disabled in Site Option 
*/

function truethemes_after_searchform_hook(){

do_action('truethemes_after_searchform_hook');

}


/*
* Located in content-blog.php at the beginning of <div class="post_title">
* @since version 2.6
*/

function truethemes_begin_post_title_hook(){

do_action('truethemes_begin_post_title_hook');

}


/*
* Located in content-blog.php at the end of <div class="post_title">
* @since version 2.6
*/

function truethemes_end_post_title_hook(){

do_action('truethemes_end_post_title_hook');

}

/*
* Located in content-blog.php at the beginning of <div class="post_content">
* @since version 2.6
*/

function truethemes_begin_post_content_hook(){

do_action('truethemes_begin_post_content_hook');

}


/*
* Located in content-blog.php at the end of <div class="post_content">
* @since version 2.6
*/

function truethemes_end_post_content_hook(){

do_action('truethemes_end_post_content_hook');

}

/*
* Located in content-blog.php at the beginning of <div class="post_footer">
* @since version 2.6
*/

function truethemes_begin_post_footer_hook(){

do_action('truethemes_begin_post_footer_hook');

}


/*
* Located in content-blog.php at the end of <div class="post_footer">
* @since version 2.6
*/

function truethemes_end_post_footer_hook(){

do_action('truethemes_end_post_footer_hook');

}


//

/*
* Located in content-blog-single.php at the beginning of <div class="post_title">
* @since version 2.6
*/

function truethemes_begin_single_post_title_hook(){

do_action('truethemes_begin_single_post_title_hook');

}


/*
* Located in content-blog-single.php at the end of <div class="post_title">
* @since version 2.6
*/

function truethemes_end_single_post_title_hook(){

do_action('truethemes_end_single_post_title_hook');

}

/*
* Located in content-blog-single.php at the beginning of <div class="post_content">
* @since version 2.6
*/

function truethemes_begin_single_post_content_hook(){

do_action('truethemes_begin_single_post_content_hook');

}


/*
* Located in content-blog-single.php at the end of <div class="post_content">
* @since version 2.6
*/

function truethemes_end_single_post_content_hook(){

do_action('truethemes_end_single_post_content_hook');

}

/*
* Located in content-blog-single.php at the beginning of <div class="post_footer">
* @since version 2.6
*/

function truethemes_begin_single_post_footer_hook(){

do_action('truethemes_begin_single_post_footer_hook');

}


/*
* Located in content-blog-single.php at the end of <div class="post_footer">
* @since version 2.6
*/

function truethemes_end_single_post_footer_hook(){

do_action('truethemes_end_single_post_footer_hook');

}


/*
* Located in footer.php at the top of the file for use in wp-activate.php
* @since version 4.0
*/

function truethemes_before_footer_top(){

do_action('truethemes_before_footer_top');

}


/*
* Located in footer.php at the beginning of <div id="footer">
* @since version 2.6
*/

function truethemes_begin_footer_hook(){

do_action('truethemes_begin_footer_hook');

}


/*
* Located in footer.php at the beginning of <div id="foot_left">
* @since version 2.6
*/

function truethemes_begin_footer_left_hook(){

do_action('truethemes_begin_footer_left_hook');

}


/*
* Located in footer.php at the end of <div id="foot_right">
* @since version 2.6
*/

function truethemes_end_footer_right_hook(){

do_action('truethemes_end_footer_right_hook');

}
?>