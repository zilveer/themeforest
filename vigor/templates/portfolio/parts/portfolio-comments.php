<?php
global $edgt_options;

//get portfolio comment value
$portfolio_hide_comments = "";
if(get_post_meta(get_the_ID(), "edgt_portfolio-hide-comments", true) == "yes"){
	$portfolio_hide_comments = "yes";
} elseif (isset($edgt_options['portfolio_hide_comments'])){
	$portfolio_hide_comments = $edgt_options['portfolio_hide_comments'];
}

if($portfolio_hide_comments != "yes"){
	comments_template('', true); 
}