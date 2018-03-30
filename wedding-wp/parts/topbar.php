<?php
GLOBAL $webnus_options;

/** Check topbar enabled **/
$topbar_enabled = $webnus_options->webnus_header_topbar_enable();
$topbar_leftcontent = $webnus_options->webnus_header_topbar_leftcontent();
$topbar_rightcontent = $webnus_options->webnus_header_topbar_rightcontent();
if($topbar_enabled){
?>

<section class="top-bar">
<div class="container"><?php 

		/***********************************/
		/***		TOPBAR Left Side
		/***********************************/
 
?><div class="<?php echo ( 3 == $topbar_leftcontent )? 'socialfollow' : 'top-links'; ?> lftflot"><?php

 switch($topbar_leftcontent)
 {
 	case 1:
		if(has_nav_menu('header-top-menu')){
			$menuParameters = array(
				'theme_location'=>'header-top-menu',
				'container'       => false,
				'echo'            => false,
				'items_wrap'      => '%3$s',
				'depth'           => 0,
			);
			echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
		}
	break;
	case 2:
	?>
	<h6><i class="fa-envelope-o"></i> <?php echo $webnus_options->webnus_header_email(); ?></h6> <h6><i class="fa-phone"></i> <?php echo $webnus_options->webnus_header_phone();?></h6>
	<?php
	break;
	case 3:
		if($webnus_options->webnus_top_social_icons_facebook())
			echo '<a href="'. $webnus_options->webnus_facebook_ID() .'" class="facebook" target="_blank"><i class="fa-facebook"></i></a>';
		if($webnus_options->webnus_top_social_icons_twitter())
			echo '<a href="'. $webnus_options->webnus_twitter_ID() .'" class="twitter" target="_blank"><i class="fa-twitter"></i></a>';
		if($webnus_options->webnus_top_social_icons_dribbble())
			echo '<a href="'. $webnus_options->webnus_dribbble_ID().'" class="dribble" target="_blank"><i class="fa-dribbble"></i></a>';
		if($webnus_options->webnus_top_social_icons_pinterest())
			echo '<a href="'. $webnus_options->webnus_pinterest_ID() .'" class="pinterest" target="_blank"><i class="fa-pinterest"></i></a>';
		if($webnus_options->webnus_top_social_icons_vimeo())
			echo '<a href="'. $webnus_options->webnus_vimeo_ID() .'" class="vimeo" target="_blank"><i class="fa-vimeo-square"></i></a>';
		if($webnus_options->webnus_top_social_icons_youtube())
			echo '<a href="'. $webnus_options->webnus_youtube_ID() .'" class="youtube" target="_blank"><i class="fa-youtube"></i></a>';	
		if($webnus_options->webnus_top_social_icons_google())
			echo '<a href="'. $webnus_options->webnus_google_ID() .'" class="google" target="_blank"><i class="fa-google"></i></a>';	
		if($webnus_options->webnus_top_social_icons_linkedin())
			echo '<a href="'. $webnus_options->webnus_linkedin_ID() .'" class="linkedin" target="_blank"><i class="fa-linkedin"></i></a>';	
		if($webnus_options->webnus_top_social_icons_rss())
			echo '<a href="'. $webnus_options->webnus_rss_ID() .'" class="rss" target="_blank"><i class="fa-rss-square"></i></a>';
		if($webnus_options->webnus_top_social_icons_instagram())
			echo '<a href="'. $webnus_options->webnus_instagram_ID() .'" class="instagram" target="_blank"><i class="fa-instagram"></i></a>';	
		if($webnus_options->webnus_top_social_icons_flickr())
			echo '<a href="'. $webnus_options->webnus_flickr_ID() .'" class="other-social" target="_blank"><i class="fa-flickr"></i></a>';	
		if($webnus_options->webnus_top_social_icons_reddit())
			echo '<a href="'. $webnus_options->webnus_reddit_ID() .'" class="other-social" target="_blank"><i class="fa-reddit"></i></a>';
		if($webnus_options->webnus_top_social_icons_delicious())
			echo '<a href="'. $webnus_options->webnus_delicious_ID() .'" class="other-social" target="_blank"><i class="fa-delicious"></i></a>';	
		if($webnus_options->webnus_top_social_icons_lastfm())
			echo '<a href="'. $webnus_options->webnus_lastfm_ID() .'" class="other-social" target="_blank"><i class="fa-lastfm-square"></i></a>';
		if($webnus_options->webnus_top_social_icons_tumblr())
			echo '<a href="'. $webnus_options->webnus_tumblr_ID() .'" class="other-social" target="_blank"><i class="fa-tumblr-square"></i></a>';
		if($webnus_options->webnus_top_social_icons_skype())
			echo '<a href="'. $webnus_options->webnus_skype_ID() .'" class="other-social" target="_blank"><i class="fa-skype"></i></a>'; 
	break;
	case 4:
		$left_tagline = $webnus_options->webnus_top_left_tagline();
		if(!empty($left_tagline)) 
			echo $left_tagline;
	break;
	case 5:		
		do_action('icl_language_selector');
	break;
 }
?></div>
<?php
		/***********************************/
		/***		TOPBAR Right Side
		/***********************************/
?>
<div class="<?php echo ( 3 == $topbar_rightcontent )? 'socialfollow' : 'top-links'; ?> rgtflot"><?php
 switch($topbar_rightcontent)
 {
 	case 1:
		if(has_nav_menu('header-top-menu')){
			$menuParameters = array(
				'theme_location'=>'header-top-menu',
				'container'       => false,
				'echo'            => false,
				'items_wrap'      => '%3$s',
				'depth'           => 0,
			);
			echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
		}
	break;
	case 2:
	?>
	<h6><i class="fa-envelope-o"></i> <?php echo $webnus_options->webnus_header_email(); ?></h6> <h6><i class="fa-phone-2"></i> <?php echo $webnus_options->webnus_header_phone();?></h6>
	<?php
	break;
	case 3:
		if($webnus_options->webnus_top_social_icons_facebook())
			echo '<a href="'. $webnus_options->webnus_facebook_ID() .'" class="facebook" target="_blank"><i class="fa-facebook"></i></a>';
		if($webnus_options->webnus_top_social_icons_twitter())
			echo '<a href="'. $webnus_options->webnus_twitter_ID() .'" class="twitter" target="_blank"><i class="fa-twitter"></i></a>';
		if($webnus_options->webnus_top_social_icons_dribbble())
			echo '<a href="'. $webnus_options->webnus_dribbble_ID().'" class="dribble" target="_blank"><i class="fa-dribbble"></i></a>';
		if($webnus_options->webnus_top_social_icons_pinterest())
			echo '<a href="'. $webnus_options->webnus_pinterest_ID() .'" class="pinterest" target="_blank"><i class="fa-pinterest"></i></a>';
		if($webnus_options->webnus_top_social_icons_vimeo())
			echo '<a href="'. $webnus_options->webnus_vimeo_ID() .'" class="vimeo" target="_blank"><i class="fa-vimeo-square"></i></a>';
		if($webnus_options->webnus_top_social_icons_youtube())
			echo '<a href="'. $webnus_options->webnus_youtube_ID() .'" class="youtube" target="_blank"><i class="fa-youtube"></i></a>';		
		if($webnus_options->webnus_top_social_icons_google())
			echo '<a href="'. $webnus_options->webnus_google_ID() .'" class="google" target="_blank"><i class="fa-google"></i></a>';	
		if($webnus_options->webnus_top_social_icons_linkedin())
			echo '<a href="'. $webnus_options->webnus_linkedin_ID() .'" class="linkedin" target="_blank"><i class="fa-linkedin"></i></a>';	
		if($webnus_options->webnus_top_social_icons_rss())
			echo '<a href="'. $webnus_options->webnus_rss_ID() .'" class="rss" target="_blank"><i class="fa-rss-square"></i></a>';
		if($webnus_options->webnus_top_social_icons_instagram())
			echo '<a href="'. $webnus_options->webnus_instagram_ID() .'" class="instagram" target="_blank"><i class="fa-instagram"></i></a>';		
		if($webnus_options->webnus_top_social_icons_flickr())
			echo '<a href="'. $webnus_options->webnus_flickr_ID() .'" class="other-social" target="_blank"><i class="fa-flickr"></i></a>';	
		if($webnus_options->webnus_top_social_icons_reddit())
			echo '<a href="'. $webnus_options->webnus_reddit_ID() .'" class="other-social" target="_blank"><i class="fa-reddit"></i></a>';	
		if($webnus_options->webnus_top_social_icons_delicious())
			echo '<a href="'. $webnus_options->webnus_delicious_ID() .'" class="other-social" target="_blank"><i class="fa-delicious"></i></a>';	
		if($webnus_options->webnus_top_social_icons_lastfm())
			echo '<a href="'. $webnus_options->webnus_lastfm_ID() .'" class="other-social" target="_blank"><i class="fa-lastfm-square"></i></a>';
		if($webnus_options->webnus_top_social_icons_tumblr())
			echo '<a href="'. $webnus_options->webnus_tumblr_ID() .'" class="other-social" target="_blank"><i class="fa-tumblr-square"></i></a>';
		if($webnus_options->webnus_top_social_icons_skype())
			echo '<a href="'. $webnus_options->webnus_skype_ID() .'" class="other-social" target="_blank"><i class="fa-skype"></i></a>';    
	break;
	case 4:
		$right_tagline = $webnus_options->webnus_top_right_tagline();
		if(!empty($right_tagline)) 
			echo $right_tagline;
	case 5:
		do_action('icl_language_selector');
	break;
	}
?></div>
</div>
</section>
<?php
} 
/******/
/* Topbar Enabled End
/******/
?>