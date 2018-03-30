<?php

	/*	Get Social Media Links	*/
	if(of_get_option('sociallink_digg')) {
	$sociallink_digg = of_get_option('sociallink_digg');	
	} else {
	$sociallink_digg = 'http://www.digg.com/submit?phase=2&amp;url=[get_permalink]&amp;title=[get_the_title]';	
	}
	
	if(of_get_option('sociallink_fb')) {
	$sociallink_fb = of_get_option('sociallink_fb');	
	} else {
	$sociallink_fb = 'http://www.facebook.com/sharer.php?u=[get_permalink]&amp;t=[get_the_title]';	
	}
	
	if(of_get_option('sociallink_linkedin')) {
	$sociallink_linkedin = of_get_option('sociallink_linkedin');	
	} else {
	$sociallink_linkedin = 'http://www.linkedin.com/shareArticle?mini=true&url=[get_permalink]&title=[get_the_title]&source=[get_blogurl]';	
	}
	
	if(of_get_option('sociallink_deli')) {
	$sociallink_deli = of_get_option('sociallink_deli');	
	} else {
	$sociallink_deli = 'http://del.icio.us/post?url=[get_permalink]&amp;title=[get_the_title]';	
	}
	
	if(of_get_option('sociallink_reddit')) {
	$sociallink_reddit = of_get_option('sociallink_reddit');	
	} else {
	$sociallink_reddit = 'http://www.reddit.com/submit?url=[get_permalink]';	
	}
	
	if(of_get_option('sociallink_stumble')) {
	$sociallink_stumble = of_get_option('sociallink_stumble');	
	} else {
	$sociallink_stumble = 'http://www.stumbleupon.com/submit?url=[get_permalink]&amp;title=[get_the_title]';	
	}
	
	if(of_get_option('sociallink_twitter')) {
	$sociallink_twitter = of_get_option('sociallink_twitter');	
	} else {
	$sociallink_twitter = 'http://twitter.com/share?text=[get_the_title]&amp;url=[get_permalink]';	
	}
	
	if(of_get_option('sociallink_google')) {
	$sociallink_google = of_get_option('sociallink_google');	
	} else {
	$sociallink_google = 'https://m.google.com/app/plus/x/?v=compose&content=[get_the_title] - [get_permalink]';	
	}
	
	
	if(of_get_option('sociallink_rss')) {
	$sociallink_rss = of_get_option('sociallink_rss');	
	} else {
	$sociallink_rss = '[get_permalink]feed/rss/';	
	}
	
	if(of_get_option('sociallink_youtube')) {
	$sociallink_youtube = of_get_option('sociallink_youtube');	
	} else {
	$sociallink_youtube = 'http://www.youtube.com/user/';	
	}
	
	if(of_get_option('sociallink_vimeo')) {
	$sociallink_vimeo = of_get_option('sociallink_vimeo');	
	} else {
	$sociallink_vimeo = 'http://vimeo.com/';	
	}
	
	if(of_get_option('sociallink_pinterest')) {
	$sociallink_pinterest = of_get_option('sociallink_pinterest');	
	} else {
	$sociallink_pinterest = 'http://pinterest.com/';	
	}
	
	if(of_get_option('sociallink_email')) {
	$sociallink_email = of_get_option('sociallink_email');	
	} else {
	$sociallink_email = 'mailto:example@email.com';	
	}
	
	if(of_get_option('sociallink_soundcloud')) {
	$sociallink_soundcloud = of_get_option('sociallink_soundcloud');	
	} else {
	$sociallink_soundcloud = 'http://soundcloud.com';	
	}
	
	if(of_get_option('sociallink_instagram')) {
	$sociallink_instagram = of_get_option('sociallink_instagram');	
	} else {
	$sociallink_instagram = 'http://instagram.com';	
	}

	if(of_get_option('sociallink_flickr')) {
	$sociallink_flickr = of_get_option('sociallink_flickr');	
	} else {
	$sociallink_flickr = 'http://flickr.com';	
	}	