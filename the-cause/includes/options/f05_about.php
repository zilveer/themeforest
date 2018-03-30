<?php 

$themename = "The Cause";
$pageoptions = array('file' => basename(__FILE__), 'name' => 'About Us', 'child' => true);

$googleZoom = array();
$zoomIndex = 8;
while ($zoomIndex < 15) {
	$googleZoom["$zoomIndex"] = "$zoomIndex";
	$zoomIndex++;
}

// Options
$options = array();

// The Cause Biography
$options[] = array( "name" => "Candidate Biography", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Widget text", "desc" => "This text will be used if 'TB Candidate Biography' widget is activated", "id" => "tb_candidate_biography", "type" => "textarea", "std" => "");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Candidate Name", "desc" => "", "id" => "tb_candidate_name", "type" => "text", "std" => "John Smith Jr.");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Candidate Status", "desc" => "", "id" => "tb_candidate_status", "type" => "text", "std" => "Political Candidate");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Candidate photo", "desc" => "Add the full URI path to candidate photo. Dimensions - optimal ratio: 81*85.", "id" => "tb_candidate_photo", "type" => "upload", "std" => "");
$options[] = array( "type" => "close2");

// About Us
$options[] = array( "name" => "About Us", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Widget text", "desc" => "This text will be used if 'TB About Us' widget is activated", "id" => "tb_about_us", "type" => "textarea", "std" => "");
$options[] = array( "type" => "close2");

$options[] = array( "name" => "Contact Details", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Address", "desc" => "Please submit address of your company", "id" => "tb_address", "type" => "textarea", "std" => "12345 Street Name\nCity Name,\nState, Province, 12345 Zip Code\nCountry");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Phone - title", "desc" => "", "id" => "tb_phone_title", "type" => "text", "std" => "Phone");
$options[] = array( "name" => "Phone - number", "desc" => "", "id" => "tb_phone_number", "type" => "text", "std" => "(123) 456-789");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Email - title", "desc" => "", "id" => "tb_email_title", "type" => "text", "std" => "Office");
$options[] = array( "name" => "Email", "desc" => "This email will be used for main contact form.", "id" => "tb_email_email", "type" => "text", "std" => "office@example.com");
$options[] = array( "type" => "close2");

// Social Networks
$options[] = array( "name" => "Social Networks", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Facebook", "desc" => "", "id" => "tb_facebook", "type" => "text", "std" => "");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Twitter", "desc" => "Twitter URL", "id" => "tb_twitter", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Twitter", "desc" => "Twitter ID: it will be used for twitter activity plugin", "id" => "tb_twitter_id", "type" => "text", "std" => "");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "LinkedIn", "desc" => "", "id" => "tb_linked_in", "type" => "text", "std" => "");
$options[] = array( "type" => "close2");

// Connect with us - widget
$options[] = array( "name" => "Connect with us - widget", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Title 1", "desc" => "Leave blank if you don't want to use it", "id" => "tb_cwu_title1", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Text 1", "desc" => "", "id" => "tb_cwu_text1", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "URL 1", "desc" => "", "id" => "tb_cwu_url1", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Photo 1", "desc" => "Add the full URI path to the photo. Max dimensions: 50*50.", "id" => "tb_cwu_photo1", "type" => "upload", "std" => "");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Title 2", "desc" => "Leave blank if you don't want to use it", "id" => "tb_cwu_title2", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Text 2", "desc" => "", "id" => "tb_cwu_text2", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "URL 2", "desc" => "", "id" => "tb_cwu_url2", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Photo 2", "desc" => "Add the full URI path to the photo. Max dimensions: 50*50.", "id" => "tb_cwu_photo2", "type" => "upload", "std" => "");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Title 3", "desc" => "Leave blank if you don't want to use it", "id" => "tb_cwu_title3", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Text 3", "desc" => "", "id" => "tb_cwu_text3", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "URL 3", "desc" => "", "id" => "tb_cwu_url3", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Photo 3", "desc" => "Add the full URI path to the photo. Max dimensions: 50*50.", "id" => "tb_cwu_photo3", "type" => "upload", "std" => "");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Title 4", "desc" => "Leave blank if you don't want to use it", "id" => "tb_cwu_title4", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Text 4", "desc" => "", "id" => "tb_cwu_text4", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "URL 4", "desc" => "", "id" => "tb_cwu_url4", "type" => "text", "std" => "");
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Photo 4", "desc" => "Add the full URI path to the photo. Max dimensions: 50*50.", "id" => "tb_cwu_photo4", "type" => "upload", "std" => "");
$options[] = array( "type" => "close2");

// Google maps
$options[] = array( "name" => "Google Maps", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Latitude", "desc" => "Submit latitude", "id" => "tb_gmap_latitude", "type" => "text", "std" => "");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Longitude", "desc" => "Submit longitude", "id" => "tb_gmap_longitude", "type" => "text", "std" => "");
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Default zoom", "desc" => "Submit default zoom for maps", "id" => "tb_gmap_zoom", "type" => "select", "value" => $googleZoom, "std" => DEFAULT_GM_ZOOM);
$options[] = array( "type" => "close2");

$adminOptionsPage = new dashboardPages($options, $pageoptions);

?>