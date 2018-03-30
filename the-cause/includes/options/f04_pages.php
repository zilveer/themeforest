<?php 

$themename = "The Cause";
$pageoptions = array('file' => basename(__FILE__), 'name' => 'Pages and Categories', 'child' => true);

// Options
$options = array();

// Contact Details
$options[] = array( "name" => "Pages and Categories", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Donations", "desc" => "", "id" => "tb_page_donate", "type" => "select", "subType" => "page", "std" => "0");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Donations - External Link", "desc" => "", "id" => "tb_page_donate_external", "type" => "text", "std" => "");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Biography", "desc" => "", "id" => "tb_page_biography", "type" => "select", "subType" => "page", "std" => "0");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Blog", "desc" => "", "id" => "tb_page_blog", "type" => "select", "subType" => "page", "std" => "0");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Contact", "desc" => "", "id" => "tb_page_contact", "type" => "select", "subType" => "page", "std" => "0");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "About Us", "desc" => "", "id" => "tb_page_about_us", "type" => "select", "subType" => "page", "std" => "0");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Events", "desc" => "", "id" => "tb_page_events", "type" => "select", "subType" => "page", "std" => "0");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Media Page", "desc" => "", "id" => "tb_page_media", "type" => "select", "subType" => "page", "std" => "0");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Gallery", "desc" => "", "id" => "tb_page_gallery", "type" => "select", "subType" => "page", "std" => "0");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Video", "desc" => "", "id" => "tb_page_video", "type" => "select", "subType" => "page", "std" => "0");
$options[] = array( "type" => "close2");


$adminOptionsPage = new dashboardPages($options, $pageoptions);

?>