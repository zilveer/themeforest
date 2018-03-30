<?php

global $edgtIconCollections;

$socialPage = new EdgeAdminPage("12", "Social", "fa fa-share-alt");
$edgtFramework->edgtOptions->addAdminPage("socialPage",$socialPage);

//Enable Social Share

$panel2 = new EdgePanel("Enable Social Share","social_sharing_panel");
$socialPage->addChild("panel2",$panel2);

$enable_social_share = new EdgeField("yesno","enable_social_share","no","Enable Social Share","Enabling this option will allow social share on networks of your choice", array(),
	array("dependence" => true,
		  "dependence_hide_on_yes" => "",
		  "dependence_show_on_yes" => "#edgtf_social_networks_panel,#edgtf_show_social_share_panel"));
$panel2->addChild("enable_social_share",$enable_social_share);

//Show Social Share

$panel3 = new EdgePanel("Show Social Share On","show_social_share_panel","enable_social_share","no");
$socialPage->addChild("panel3",$panel3);

$post_types_names_post = new EdgeField("flagpost","post_types_names_post","","Posts","Show Social Share on Blog Posts");
$panel3->addChild("post_types_names_post",$post_types_names_post);

$post_types_names_page = new EdgeField("flagpage","post_types_names_page","","Pages","Show Social Share on Pages");
$panel3->addChild("post_types_names_page",$post_types_names_page);

$post_types_names_attachment = new EdgeField("flagmedia","post_types_names_attachment","","Media","Show Social Share for Images and Videos");
$panel3->addChild("post_types_names_attachment",$post_types_names_attachment);

$post_types_names_portfolio_page = new EdgeField("flagportfolio","post_types_names_portfolio_page","","Portfolio Item","Show Social Share for Portfolio Items");
$panel3->addChild("post_types_names_portfolio_page",$post_types_names_portfolio_page);

if(edgt_is_woocommerce_installed()){
	$post_types_names_product = new EdgeField("flagproduct","post_types_names_product","","Product","Show Social Share for Product Items");
	$panel3->addChild("post_types_names_product",$post_types_names_product);
}

//Social Share Networks

$panel4 = new EdgePanel("Social Networks","social_networks_panel","enable_social_share","no");
$socialPage->addChild("panel4",$panel4);

//Facebook

$facebook_subtitle = new EdgeTitle("facebook_subtitle", "Share on Facebook");
$panel4->addChild("facebook_subtitle", $facebook_subtitle);

$enable_facebook_share = new EdgeField("yesno","enable_facebook_share","no","Enable Share","Enabling this option will allow sharing via Facebook", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_facebook_share_container"));
$panel4->addChild("enable_facebook_share",$enable_facebook_share);

$enable_facebook_share_container = new EdgeContainer("enable_facebook_share_container","enable_facebook_share","no");
$panel4->addChild("enable_facebook_share_container",$enable_facebook_share_container);

$facebook_icon = new EdgeField("image","facebook_icon","","Upload Icon","");
$enable_facebook_share_container->addChild("facebook_icon",$facebook_icon);

//Twitter
$twitter_subtitle = new EdgeTitle("twitter_subtitle", "Share on Twitter");
$panel4->addChild("twitter_subtitle", $twitter_subtitle);

$enable_twitter_share = new EdgeField("yesno","enable_twitter_share","no","Enable Share","Enabling this option will allow sharing via Twitter", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_twitter_share_container"));
$panel4->addChild("enable_twitter_share",$enable_twitter_share);
$enable_twitter_share_container = new EdgeContainer("enable_twitter_share_container","enable_twitter_share","no");
$panel4->addChild("enable_twitter_share_container",$enable_twitter_share_container);
$twitter_icon = new EdgeField("image","twitter_icon","","Upload Icon","");
$enable_twitter_share_container->addChild("twitter_icon",$twitter_icon);
$twitter_via = new EdgeField("text","twitter_via","","Via","");
$enable_twitter_share_container->addChild("twitter_via",$twitter_via);

//Google Plus

$google_plus_subtitle = new EdgeTitle("google_plus_subtitle", "Share on Google Plus");
$panel4->addChild("google_plus_subtitle", $google_plus_subtitle);

$enable_google_plus = new EdgeField("yesno","enable_google_plus","no","Enable Share","Enabling this option will allow sharing via Google Plus", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_google_plus_container"));
$panel4->addChild("enable_google_plus",$enable_google_plus);
$enable_google_plus_container = new EdgeContainer("enable_google_plus_container","enable_google_plus","no");
$panel4->addChild("enable_google_plus_container",$enable_google_plus_container);
$google_plus_icon = new EdgeField("image","google_plus_icon","","Upload Icon","");
$enable_google_plus_container->addChild("google_plus_icon",$google_plus_icon);

//LinkedIn

$linkedin_subtitle = new EdgeTitle("linkedin_subtitle", "Share on LinkedIn");
$panel4->addChild("linkedin_subtitle", $linkedin_subtitle);

$enable_linkedin = new EdgeField("yesno","enable_linkedin","no","Enable Share","Enabling this option will allow sharing via LinkedIn", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_linkedin_container"));
$panel4->addChild("enable_linkedin",$enable_linkedin);
$enable_linkedin_container = new EdgeContainer("enable_linkedin_container","enable_linkedin","no");
$panel4->addChild("enable_linkedin_container",$enable_linkedin_container);
$linkedin_icon = new EdgeField("image","linkedin_icon","","Upload Icon","");
$enable_linkedin_container->addChild("linkedin_icon",$linkedin_icon);

//Tumblr

$tumblr_subtitle = new EdgeTitle("tumblr_subtitle", "Share on Tumblr");
$panel4->addChild("tumblr_subtitle", $tumblr_subtitle);

$enable_tumblr = new EdgeField("yesno","enable_tumblr","no","Enable Share","Enabling this option will allow sharing via Tumblr", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_tumblr_container"));
$panel4->addChild("enable_tumblr",$enable_tumblr);

$enable_tumblr_container = new EdgeContainer("enable_tumblr_container","enable_tumblr","no");
$panel4->addChild("enable_tumblr_container",$enable_tumblr_container);

$tumblr_icon = new EdgeField("image","tumblr_icon","","Upload Icon","");
$enable_tumblr_container->addChild("tumblr_icon",$tumblr_icon);

// Pinterest

$pinterest_subtitle = new EdgeTitle("pinterest_subtitle", "Share on Pinterest");
$panel4->addChild("pinterest_subtitle", $pinterest_subtitle);

$enable_pinterest = new EdgeField("yesno","enable_pinterest","no","Enable Share","Enabling this option will allow sharing via Pinterest", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_pinterest_container"));
$panel4->addChild("enable_pinterest",$enable_pinterest);
$enable_pinterest_container = new EdgeContainer("enable_pinterest_container","enable_pinterest","no");
$panel4->addChild("enable_pinterest_container",$enable_pinterest_container);
$pinterest_icon = new EdgeField("image","pinterest_icon","","Upload Icon","");
$enable_pinterest_container->addChild("pinterest_icon",$pinterest_icon);


//VK

$vk_subtitle = new EdgeTitle("vk_subtitle", "Share on VK");
$panel4->addChild("vk_subtitle", $vk_subtitle);

$enable_vk = new EdgeField("yesno","enable_vk","no","Enable Share","Enabling this option will allow sharing via VK", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_vk_container"));
$panel4->addChild("enable_vk",$enable_vk);
$enable_vk_container = new EdgeContainer("enable_vk_container","enable_vk","no");
$panel4->addChild("enable_vk_container",$enable_vk_container);
$vk_icon = new EdgeField("image","vk_icon","","Upload Icon","");
$enable_vk_container->addChild("vk_icon",$vk_icon);