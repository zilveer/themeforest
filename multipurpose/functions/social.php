<?php

function multipurpose_get_social_links() {

	$socials = array('facebook', 'twitter', 'googleplus', 'pinterest', 'rss', 'instagram', 'skype', 'tumblr', 'linkedin', 'flickr', 'vimeo', 'blogger', 'behance', 'youtube', 'dribble', 'picasa', 'github', 'stumbleupon', 'lastfm', 'email');
    $socials_names = array('Facebook', 'Twitter', 'Google+', 'Pinterest', 'RSS', 'Instagram', 'Skype', 'Tumblr', 'LinkedIn', 'Flickr', 'Vimeo', 'Blogger', 'Behance', 'YouTube', 'Dribble', 'Picasa', 'GitHub', 'StumbleUpon', 'Last.fm', 'E-mail');

	$social_links = array();
	foreach ($socials as $k=>$v) {
		if($v == 'rss' && !get_theme_mod('show_rss')){
			$link = new stdClass;
			$link->name = $socials_names[$k];
			$link->url = get_bloginfo('rss2_url');
			$link->class = $v;
			$social_links[] = $link;
		} else {
			$url = get_theme_mod('social_' . $v);
			if($url) {
				$link = new stdClass;
				$link->name = $socials_names[$k];
				$link->url = $url;
				$link->class = $v;
				$social_links[] = $link;
			}
		}
	}
	return $social_links; 
}
