<?php
/**
* MetaBoxes Options .
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

/**
* Page Options
******************************************************/
$post_options   = array();

/**
* Post Formats
********************************************************************/
/**
* Standard
*/
$post_options[] = array( "title"  => "Standard", "type" => "open");

	$post_options[] = array("type"  => "custom","code" => "<p style='display:block; text-align:center;'>Use the editor above to compose your post. </p>");

$post_options[] = array( "type"  => "close");     
/**
* image
*/
$post_options[] = array( "title"  => "Image", "type" => "open"); 

	$post_options[] = array("type"  => "custom","code" => "<p style='display:block; text-align:center;'>Set the featured image for your post. </p>");

$post_options[] = array( "type"  => "close");  
/**
* Gallery
*/
$post_options[] = array( "title"  => "Gallery", "type" => "open");   

	$post_options[] = array("type"  => "custom","code" => "<p style='display:block; text-align:center;'>Use the Add Media button to select or upload images for your gallery.</p>");

$post_options[] = array( "type"  => "close");   
/**
* Link
*/
$post_options[] = array( "title"  => "Link", "type" => "open");   

	$post_options[] = array("desc"  => "Add a link  URL","type"  => "text","id"     => "van_post_link");

$post_options[] = array( "type"  => "close");   
/**
* Video
*/
$post_options[] = array( "title"  => "Video", "type" => "open");  

	$post_options[] = array("type"  => "custom","code" => "<p style='display:block; text-align:center; font-weight:bold;'>Self Hosted Video ( You must fill at least one format ) .</p>");

	$post_options[] = array("desc"  => "MP4 File URL","type"  => "text","id"     => "van_video_mp4");

	$post_options[] = array("desc"  => "WEBM File URL","type"  => "text","id"     => "van_video_webm");  

	$post_options[] = array("desc"  => "OGV File URL","type"  => "text","id"     => "van_video_ogv");      

	$post_options[] = array("desc"  => "Video Poster","help"   => "or set the featured image","type"  => "text","id"     => "van_video_poster");

	$post_options[] = array("type"  => "custom","code" => "<p style='display:block; text-align:center; margin-top:10px;font-weight:bold;'>Embed Video From url.</p>");

	$post_options[] = array( "desc" => "Video URL","id"     => "van_video_url","help"  => "Paste a video url from : Youtube, Vimeo, Dailymotion or Blip.tv","type" => "text");

	$post_options[] = array("type"  => "custom","code" => "<p style='display:block; text-align:center;margin-top:10px; font-weight:bold;'>Custom Embed Code.</p>");

	$post_options[] = array( "desc" => "Video embed code","id"    => "van_video_embed_code","help" => "Paste a video embed code from other websites.","type" => "textarea");

$post_options[] = array( "type"  => "close");
/**
* Audio
*/
$post_options[] = array( "title"  => "Audio", "type" => "open"); 

	$post_options[] = array("type"  => "custom","code" => "<p style='display:block; text-align:center; font-weight:bold;'>Self Hosted Audio ( You must fill at least one format ) .</p>");

	$post_options[] = array("desc"  => "MP3 File URL","type"  => "text","id"     => "van_audio_mp3");

	$post_options[] = array("desc"  => "OGG File URL","type"  => "text","id"     => "van_audio_ogg");

	$post_options[] = array("desc"  => "WAV File URL","type"  => "text","id"     => "van_audio_wav");

	$post_options[] = array("type"  => "custom","code" => "<p style='display:block; text-align:center; margin-top:10px;font-weight:bold;'>Embed SoundCloud Audio .</p>");

	$post_options[] = array( "desc" => "SoundCloud URL","id"     => "van_soundcloud_url","type" => "text");

	$post_options[] = array("type"  => "custom","code" => "<p style='display:block; text-align:center; margin-top:10px;font-weight:bold;'>Custom Embed Code .</p>");

	$post_options[] = array( "desc" => "Audio embed code","id"    => "van_audio_embed_code","type" => "textarea");

$post_options[] = array( "type"  => "close");                     
/**
* Quote
*/
$post_options[] = array( "title"  => "Quote", "type" => "open");  

	$post_options[] = array("desc"  => "Quote source","type"  => "text", "id"     => "van_quote_source");

	$post_options[] = array("desc"  => "Quote source link", "type"  => "text","id"     => "van_quote_link");
	
	$post_options[] = array("desc"  => "Quote", "type"  => "textarea","id"     => "van_quote");

$post_options[] = array( "type"  => "close");            
/**
* Status
*/
$post_options[] = array( "title"  => "Status", "type" => "open");  

	$post_options[] = array("type"  => "custom","code" => "<p style='display:block; text-align:center;'>Use the editor to compose a status update. or embed a twitter status</p>");
	
	$post_options[] = array( "desc" => "Twitter status url","id"     => "van_twstatus","help"  => "Paste a status url from twitter","type" => "text");

$post_options[] = array( "type"  => "close");
/**
* Sidebars
*************************************************************************/
$post_options[] = array( "title" => "Sidebar Layout", "type" => "open");

	$post_options[] = array( "id"    => "van_sidebar", "type"  => "radioimg","opts"  => array( "default"=> ADMIN_IMG ."/sidebar-default.png" ,"right"  => ADMIN_IMG ."/sidebar-right.png" ,"full"   => ADMIN_IMG ."/full-width.png" ,"left"   => ADMIN_IMG ."/sidebar-left.png"));
	
	$post_options[] = array( "desc"  => "Choose sidebar :", "id" => "van_article_sidebar","type" => "select", "sidebarslist" => true);

$post_options[] = array( "type"  => "close");
/**
* Post Elements
********************************/
$post_options[] = array( "title" => "Post Elements", "type" => "open");

	$post_options[] = array( "id"    => "van_postmeta","desc"  => "Show Post Meta",  "type"  => "select", "opts"  => array(   "Default" => "" ,  "yes"  => "yes" ,  "no"   => "no" ));
	
	$post_options[] = array( "id"    => "van_ribbon","desc"  => "Show Post Ribbon",  "type"  => "select", "opts"  => array(   "Default" => "" ,  "yes"  => "yes" ,  "no"   => "no" ));

	$post_options[] = array( "id"    => "van_postags","desc"  => "Show Post tags",  "type"  => "select", "opts"  => array(   "Default" => "" ,  "yes"  => "yes" ,  "no"   => "no" ));

	$post_options[] = array( "id"    => "van_sharepost","desc"  => "Show social share","type"  => "select","opts"  => array("Default" => "" ,"yes"  => "yes" ,"no"   => "no" ));
	
	$post_options[] = array( "id"    => "van_postnav","desc"  => "Show Next/Prev Posts","type"  => "select","opts"  => array("Default" => "" ,"yes"  => "yes" ,"no"   => "no" ));
	
	$post_options[] = array( "id"    => "van_relatedpost","desc"  => "Show related posts","type"  => "select","opts"  => array("Default"     => "" ,"yes"  => "yes" ,"no"   => "no" ));

	$post_options[] = array( "id"    => "van_authorbox","desc"  => "Show author box","type"  => "select","opts"  => array("Default" => "" ,"yes"  => "yes" ,"no"   => "no" ));

	$post_options[] = array( "id"    => "van_hidebanner","desc"  => "Hide Post Banner","type"  => "checkbox");

$post_options[] = array( "type"  => "close");

/**
* Page Option
******************************************************/
$page_options   = array();

$page_options[] = array( "title" => "Sidebar Layout", "type" => "open");

	$page_options[] = array( "id"    => "van_pagesidebar","type"  => "radioimg","opts"  => array("default"=> ADMIN_IMG ."/sidebar-default.png" ,"right"  => ADMIN_IMG ."/sidebar-right.png" ,"full"   => ADMIN_IMG ."/full-width.png" ,"left"   => ADMIN_IMG ."/sidebar-left.png"));

	$page_options[] = array( "desc"  => "Choose sidebar :", "id" => "van_page_sidebar","type" => "select", "sidebarslist" => true);

$page_options[] = array( "type"  => "close");

$page_options[] = array( "title" => "Blog template Category", "type" => "open");

	$page_options[] = array( "desc"  => "Choose Category :", "id"   => "van_blogcats","help"=>"if you choose the Blog such as page template you need to insert a category of posts that you want","type" => "select","category" => true);

$page_options[] = array( "type"  => "close");