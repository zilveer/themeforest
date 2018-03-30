<?php //processing for ajax user ratings

//this assumes your theme is not within a subfolder of your themes folder and goes all the way to the root of your WP install
//this file (rateit.php) should be in the following location on your server: wp-content/themes/made/functions/rateit.php
//that is why there are four ../ in a row, so it goes back four folders into your main WP install
//if rateit.php is not in this location, you may need to add an extra ../ or remove one, but 99.9% of the time this will work
$wordpress_location = "../../../../wp-load.php";

//grab WordPress functions
require_once($wordpress_location);

$postid=$_POST["id"];
$rating=$_POST["value"];

//get the user's ip address
$ip=$_SERVER['REMOTE_ADDR'];

//get the post info and meta value
$meta = get_post_meta($postid, "user_rating", $single = true);
if($meta=="") $addmeta=false;

//use comma to delimit rating from ip and semicolon to delimit user ratings
$meta.=$rating.','.$ip.";";

//figure out whether to add or update meta field
if($addmeta) {
	//add meta field
	add_post_meta($postid, 'user_rating', $meta);
} else { 
	//update meta field
	update_post_meta($postid, 'user_rating', $meta);
}
	
//update message
_e("you have rated this","made");

?>