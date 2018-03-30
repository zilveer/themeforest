<?php
/**
 * Plugin Name: Social Media Widget
 * Description: Adds links to all of your social media and sharing site profiles. Tons of icons come in 3 sizes, 4 icon styles, and 4 animations.
 * Version: 2.9.4
 * Author: Brian Freytag
 **/


/* Check to see if locations are changed in wp-config */

	define('SMW_PLUGINPATH',get_template_directory_uri());
	define('SMW_PLUGINDIR',dirname(__FILE__));

/* Function for CSS */

function Social_Widget_Scripts(){	
	$social_widget_path = SMW_PLUGINPATH; 
?>
<?php } 

/* Register the widget */
function socialwidget_load_widgets() {
	register_widget( 'Social_Widget' );
}

/* Begin Widget Class */
class Social_Widget extends WP_Widget {

	/* Widget setup  */
	function Social_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Social_Widget', 'description' => __('A widget that allows the user to display social media icons in their sidebar' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 850, 'height' => 350, 'id_base' => 'social-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'social-widget', __('Social Media Widget' ), $widget_ops, $control_ops );
	}

	/* Display the widget  */
	function widget( $args, $instance ) {
		extract( $args );
	
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$text = apply_filters( 'widget_text', $instance['text'], $instance );
		$imgcaption = $instance['imgcaption'];
		$facebook = $instance['facebook'];
		$googleplus = $instance['googleplus'];
		$twitter = $instance['twitter'];
		$myspace = $instance['myspace'];
		$friendfeed = $instance['friendfeed'];
		$orkut = $instance['orkut'];
		$hyves = $instance['hyves'];
		$linkedin = $instance['linkedin'];
		$asmallworld = $instance['asmallworld'];
		$flickr = $instance['flickr'];
		$picasa = $instance['picasa'];
		$pinterest = $instance['pinterest'];
		$youtube = $instance['youtube'];
		$skype = $instance['skype'];
		$digg = $instance['digg'];
		$reddit = $instance['reddit'];
		$delicious = $instance['delicious'];
		$stumble = $instance['stumble'];
		$tumblr = $instance['tumblr'];
		$buzz = $instance['buzz'];
		$talk = $instance['talk'];
		$vimeo = $instance['vimeo'];
		$blogger = $instance['blogger'];
		$wordpress = $instance['wordpress'];
		$yelp = $instance['yelp'];
		$lastfm = $instance['lastfm'];
		$pandora = $instance['pandora'];
		$ustream = $instance['ustream'];
		$imdb = $instance['imdb'];
		$hulu = $instance['hulu'];
		$flixster = $instance['flixster'];
		$foursquare = $instance['foursquare'];
		$meetup = $instance['meetup'];
		$tungle = $instance['tungle'];
		$plancast = $instance['plancast'];
		$slideshare = $instance['slideshare'];
		$deviantart = $instance['deviantart'];
		$ping = $instance['ping'];
		$live365 = $instance['live365'];
		$digitaltunes = $instance['digitaltunes'];
		$soundcloud = $instance['soundcloud'];
		$bandcamp = $instance['bandcamp'];
		$etsy = $instance['etsy'];
		$bbb = $instance['bbb'];		
		$merchantcircle = $instance['merchantcircle'];
		$ebay = $instance['ebay'];
		$steam = $instance['steam'];
		$rss = $instance['rss_url'];
		$subscribe = $instance['subscribe'];
		$icon_size = $instance['icon_size'];
		$icon_pack = $instance['icon_pack'];
		$customiconsurl = $instance['customiconsurl'];
		$customiconspath = $instance['customiconspath'];
		$animation = $instance['animation'];
		$icon_opacity = $instance['icon_opacity'];
		$newtab = $instance['newtab'];
		$nofollow = $instance['nofollow'];
		$alignment = $instance['alignment'];
		$custom1icon = $instance['custom1icon'];
		$custom2icon = $instance['custom2icon'];
		$custom3icon = $instance['custom3icon'];
		$custom4icon = $instance['custom4icon'];
		$custom5icon = $instance['custom5icon'];
		$custom6icon = $instance['custom6icon'];
		$custom1name = $instance['custom1name'];
		$custom2name = $instance['custom2name'];
		$custom3name = $instance['custom3name'];
		$custom4name = $instance['custom4name'];
		$custom5name = $instance['custom5name'];
		$custom6name = $instance['custom6name'];
		$custom1url = $instance['custom1url'];
		$custom2url = $instance['custom2url'];
		$custom3url = $instance['custom3url'];
		$custom4url = $instance['custom4url'];
		$custom5url = $instance['custom5url'];
		$custom6url = $instance['custom6url'];
		
	
		/* Choose Icon Size if Value is 'default' */
		if($icon_size == 'default') {
			$icon_size = '32';
		}
		
		/* Choose icon opacity if Value is 'default' */
		if($icon_opacity == 'default') {
			$icon_opacity = '1';
		}
		
		/* Need to make opacity a whole number for IE styling filter() */
		$icon_ie = $icon_opacity * 100;
		
		/* Check to see if nofollow is set or not */
		if ($nofollow == 'on') {
			$nofollow = "rel=\"nofollow\"";
			} else {
			$nofollow = '';
			}
	
			
		/* Check to see if New Tab is set to yes */
		if ($newtab == 'yes') {
			$newtab = "target=\"_blank\"";
			} else {
			$newtab = '';
			}
		
		/* Set alignment */
		if ($alignment == 'centered') {
			$alignment = 'smw_center';
			} elseif ($alignment == 'right') {
				$alignment = 'smw_right';
				} else {
					$alignment = 'smw_left';
				}
				
		/* Get Plugin Path */
		if($icon_pack == 'custom') {
				$smw_path = $customiconsurl;
				$smw_dir = $customiconspath;
			} else {
				$smw_path = SMW_PLUGINPATH . '/includes/social-media-widget/images/' . $icon_pack. '/' . $icon_size;
				$smw_dir = SMW_PLUGINDIR . '/images/' . $icon_pack. '/' . $icon_size;
			}

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		
		
		
		echo "<div class=\"socialmedia-buttons ".$alignment."\">";
		/* Display short description */
		
		if ( $text )
			echo "<div class=\"socialmedia-text\>" . $instance['filter'] ? wpautop($text) : $text . '</div>';
			
		/* Display linked images to profiles from widget settings if one was input. */

		// Facebook
		if ( $facebook != '' && $facebook != ' ' && file_exists($smw_dir.'/facebook.png')) {
			?><a href="<?php echo $facebook; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/facebook.png" alt="<?php echo $imgcaption; ?> Facebook" title="<?php echo $imgcaption ?> Facebook" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php 
		} else {
			echo ''; //If no URL inputed
		}
		
		// Google Plus
		if ( $googleplus != '' && $googleplus != ' ' && file_exists($smw_dir.'/googleplus.png')) {
			?><a href="<?php echo $googleplus; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/googleplus.png" alt="<?php echo $imgcaption; ?> Google+" title="<?php echo $imgcaption ?> Google+" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php 
		} else {
			echo ''; //If no URL inputed
		}
		
		// Twitter
		if ( $twitter != '' && $twitter != ' ' && file_exists($smw_dir.'/twitter.png')) {
			?><a href="<?php echo $twitter; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/twitter.png" alt="<?php echo $imgcaption; ?> Twitter" title="<?php echo $imgcaption; ?> Twitter" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}

		
		// MySpace
		if ( $myspace != '' && $myspace != ' ' && file_exists($smw_dir.'/myspace.png')) {
			?><a href="<?php echo $myspace; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/myspace.png" alt="<?php echo $imgcaption; ?> MySpace" title="<?php echo $imgcaption; ?> MySpace" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// FriendFeed
		if ( $friendfeed != '' && $friendfeed != ' ' && file_exists($smw_dir.'/friendfeed.png')) {
			?><a href="<?php echo $friendfeed; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/friendfeed.png" alt="<?php echo $imgcaption; ?> FriendFeed" title="<?php echo $imgcaption; ?> FriendFeed" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>"" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Orkut
		if ( $orkut != '' && $orkut != ' ' && file_exists($smw_dir.'/orkut.png')) {
			?><a href="<?php echo $orkut; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/orkut.png" alt="<?php echo $imgcaption; ?> Orkut" title="<?php echo $imgcaption; ?> Orkut" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Hyves
		if ( $hyves != '' && $hyves != ' ' && file_exists($smw_dir.'/hyves.png')) {
			?><a href="<?php echo $hyves; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/hyves.png" alt="<?php echo $imgcaption; ?> Hyves" title="<?php echo $imgcaption; ?> Hyves" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// LinkedIN
		if ( $linkedin != '' && $linkedin != ' ' && file_exists($smw_dir.'/linkedin.png')) {
			?><a href="<?php echo $linkedin; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/linkedin.png" alt="<?php echo $imgcaption; ?> LinkedIn" title="<?php echo $imgcaption; ?> LinkedIn" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// aSmallWorld
		if ( $asmallworld != '' && $asmallworld != ' ' && file_exists($smw_dir.'/asmallworld.png')) {
			?><a href="<?php echo $asmallworld; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/asmallworld.png" alt="<?php echo $imgcaption; ?> aSmallWorld" title="<?php echo $imgcaption; ?> aSmallWorld" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Flickr
		if ( $flickr != '' && $flickr != ' ' && file_exists($smw_dir.'/flickr.png')) {
			?><a href="<?php echo $flickr; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/flickr.png" alt="<?php echo $imgcaption; ?> Flickr" title="<?php echo $imgcaption; ?> Flickr" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Picasa
		if ( $picasa != '' && $picasa != ' ' && file_exists($smw_dir.'/picasa.png')) {
			?><a href="<?php echo $picasa; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/picasa.png" alt="<?php echo $imgcaption; ?> Picasa" title="<?php echo $imgcaption; ?> Picasa" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Pinterest
		if ( $pinterest != '' && $pinterest != ' ' && file_exists($smw_dir.'/pinterest.png')) {
			?><a href="<?php echo $pinterest; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/pinterest.png" alt="<?php echo $imgcaption; ?> Pinterest" title="<?php echo $imgcaption; ?> Pinterest" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If No URL Inputed
		}
			
		// YouTube
		if ( $youtube != '' && $youtube != ' ' && file_exists($smw_dir.'/youtube.png')) {
			?><a href="<?php echo $youtube; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/youtube.png" alt="<?php echo $imgcaption; ?> YouTube" title="<?php echo $imgcaption; ?> YouTube" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If No URL Inputed
		}
		
		// Skype
		if ( $skype != '' && $skype != ' ' && file_exists($smw_dir.'/skype.png')) {
			?><a href="<?php echo $skype; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/skype.png" alt="<?php echo $imgcaption; ?> Skype" title="<?php echo $imgcaption; ?> Skype" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If No URL Inputed
		}
		
		// Digg
		if ( $digg != '' && $digg != ' ' && file_exists($smw_dir.'/digg.png')) {
			?><a href="<?php echo $digg; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/digg.png" alt="<?php echo $imgcaption; ?> Digg" title="<?php echo $imgcaption; ?> Digg" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Reddit 
		if ( $reddit != '' && $reddit != ' ' && file_exists($smw_dir.'/reddit.png')) {
			?><a href="<?php echo $reddit; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/reddit.png" alt="<?php echo $imgcaption; ?> Reddit" title="<?php echo $imgcaption; ?> Reddit" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Delicious 
		if ( $delicious != '' && $delicious != ' ' && file_exists($smw_dir.'/delicious.png')) {
			?><a href="<?php echo $delicious; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/delicious.png" alt="<?php echo $imgcaption; ?> Delicious" title="<?php echo $imgcaption; ?> Delicious" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// StumbleUpon 
		if ( $stumble != '' && $stumble != ' ' && file_exists($smw_dir.'/stumble.png')) {
			?><a href="<?php echo $stumble; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/stumble.png" alt="<?php echo $imgcaption; ?> StumbleUpon" title="<?php echo $imgcaption; ?> StumbleUpon" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Tumblr 
		if ( $tumblr != '' && $tumblr != ' ' && file_exists($smw_dir.'/tumblr.png')) {
			?><a href="<?php echo $tumblr; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/tumblr.png" alt="<?php echo $imgcaption; ?> Tumblr" title="<?php echo $imgcaption; ?> Tumblr" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Google Buzz
		if ( $buzz != '' && $buzz != ' ' && file_exists($smw_dir.'/buzz.png')) {
			?><a href="<?php echo $buzz; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/buzz.png" alt="<?php echo $imgcaption; ?> Buzz" title="<?php echo $imgcaption; ?> Buzz" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Google Talk
		if ( $talk != '' && $talk != ' ' && file_exists($smw_dir.'/talk.png')) {
			?><a href="<?php echo $talk; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/talk.png" alt="<?php echo $imgcaption; ?> Google Talk" title="<?php echo $imgcaption; ?> Google Talk" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Vimeo
		if ( $vimeo != '' && $vimeo != ' ' && file_exists($smw_dir.'/vimeo.png')) {
			?><a href="<?php echo $vimeo; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/vimeo.png" alt="<?php echo $imgcaption; ?> Vimeo" title="<?php echo $imgcaption; ?> Vimeo" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Blogger
		if ( $blogger != '' && $blogger != ' ' && file_exists($smw_dir.'/blogger.png')) {
			?><a href="<?php echo $blogger; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/blogger.png" alt="<?php echo $imgcaption; ?> Blogger" title="<?php echo $imgcaption; ?> Blogger" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If No URL Inputed
		}
		
		// Wordpress
		if ( $wordpress != '' && $wordpress != ' ' && file_exists($smw_dir.'/wordpress.png')) {
			?><a href="<?php echo $wordpress; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/wordpress.png" alt="<?php echo $imgcaption; ?> Wordpress" title="<?php echo $imgcaption; ?> Wordpress" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If No URL Inputed
		}
		
		// Yelp
		if ( $yelp != '' && $yelp != ' ' && file_exists($smw_dir.'/yelp.png')) {
			?><a href="<?php echo $yelp; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/yelp.png" alt="<?php echo $imgcaption; ?> Yelp" title="<?php echo $imgcaption; ?> Yelp" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If No URL Inputed
		}

		// Last.fm
		if ( $lastfm != '' && $lastfm != ' ' && file_exists($smw_dir.'/lastfm.png')) {
			?><a href="<?php echo $lastfm; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/lastfm.png" alt="<?php echo $imgcaption; ?> Last.fm" title="<?php echo $imgcaption; ?> Last.fm" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Pandora
		if ( $pandora != '' && $pandora != ' ' && file_exists($smw_dir.'/pandora.png')) {
			?><a href="<?php echo $pandora; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/pandora.png" alt="<?php echo $imgcaption; ?> Pandora" title="<?php echo $imgcaption; ?> Pandora" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Ustream
		if ( $ustream != '' && $ustream != ' ' && file_exists($smw_dir.'/ustream.png')) {
			?><a href="<?php echo $ustream; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/ustream.png" alt="<?php echo $imgcaption; ?> UStream" title="<?php echo $imgcaption; ?> UStream" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// IMDb
		if ( $imdb != '' && $imdb != ' ' && file_exists($smw_dir.'/imdb.png')) {
			?><a href="<?php echo $imdb; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/imdb.png" alt="<?php echo $imgcaption; ?> IMDb" title="<?php echo $imgcaption; ?> IMDb" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Hulu
		if ( $hulu != '' && $hulu != ' ' && file_exists($smw_dir.'/hulu.png')) {
			?><a href="<?php echo $hulu; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/hulu.png" alt="<?php echo $imgcaption; ?> hulu" title="<?php echo $imgcaption; ?> hulu" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Flixster
		if ( $flixster != '' && $flixster != ' ' && file_exists($smw_dir.'/flixster.png')) {
			?><a href="<?php echo $flixster; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/flixster.png" alt="<?php echo $imgcaption; ?> Flixster" title="<?php echo $imgcaption; ?> Flixster" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Foursquare
		if ( $foursquare != '' && $foursquare != ' ' && file_exists($smw_dir.'/foursquare.png')) {
			?><a href="<?php echo $foursquare; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/foursquare.png" alt="<?php echo $imgcaption; ?> Foursquare" title="<?php echo $imgcaption; ?> Foursquare" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Meetup
		if ( $meetup != '' && $meetup != ' ' && file_exists($smw_dir.'/meetup.png')) {
			?><a href="<?php echo $meetup; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/meetup.png" alt="<?php echo $imgcaption; ?> Meetup" title="<?php echo $imgcaption; ?> Meetup" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Tungle.me
		if ( $tungle != '' && $tungle != ' ' && file_exists($smw_dir.'/tungle.png')) {
			?><a href="<?php echo $tungle; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/tungle.png" alt="<?php echo $imgcaption; ?> Tungle" title="<?php echo $imgcaption; ?> Tungle" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// PlanCast
		if ( $plancast != '' && $plancast != ' ' && file_exists($smw_dir.'/plancast.png')) {
			?><a href="<?php echo $plancast; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/plancast.png" alt="<?php echo $imgcaption; ?> PlanCast" title="<?php echo $imgcaption; ?> PlanCast" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Hyves
		if ( $slideshare != '' && $slideshare != ' ' && file_exists($smw_dir.'/slideshare.png')) {
			?><a href="<?php echo $slideshare; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/slideshare.png" alt="<?php echo $imgcaption; ?> SlideShare" title="<?php echo $imgcaption; ?> SlideShare" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// DeviantArt
		if ( $deviantart != '' && $deviantart != ' ' && file_exists($smw_dir.'/deviantart.png')) {
			?><a href="<?php echo $deviantart; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/deviantart.png" alt="<?php echo $imgcaption; ?> DeviantArt" title="<?php echo $imgcaption; ?> DeviantArt" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// iTunes Ping
		if ( $ping != '' && $ping != ' ' && file_exists($smw_dir.'/ping.png')) {
			?><a href="<?php echo $ping; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/ping.png" alt="<?php echo $imgcaption; ?> iTunes Ping" title="<?php echo $imgcaption; ?> iTunes Ping" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Live365
		if ( $live365 != '' && $live365 != ' ' && file_exists($smw_dir.'/live365.png')) {
			?><a href="<?php echo $live365; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/live365.png" alt="<?php echo $imgcaption; ?> Live365" title="<?php echo $imgcaption; ?> Live365" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Digital Tunes
		if ( $digitaltunes != '' && $digitaltunes != ' ' && file_exists($smw_dir.'/digitaltunes.png')) {
			?><a href="<?php echo $digitaltunes; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/digitaltunes.png" alt="<?php echo $imgcaption; ?> Digital Tunes" title="<?php echo $imgcaption; ?> Digital Tunes" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Soundcloud
		if ( $soundcloud != '' && $soundcloud != ' ' && file_exists($smw_dir.'/soundcloud.png')) {
			?><a href="<?php echo $soundcloud; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/soundcloud.png" alt="<?php echo $imgcaption; ?> Soundcloud" title="<?php echo $imgcaption; ?> Soundcloud" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// BandCamp
		if ( $bandcamp != '' && $bandcamp != ' ' && file_exists($smw_dir.'/bandcamp.png')) {
			?><a href="<?php echo $bandcamp; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/bandcamp.png" alt="<?php echo $imgcaption; ?> Bandcamp" title="<?php echo $imgcaption; ?> Bandcamp" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Etsy
		if ( $etsy != '' && $etsy != ' ' &&  file_exists($smw_dir.'/etsy.png')) {
			?><a href="<?php echo $etsy; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/etsy.png" alt="<?php echo $imgcaption; ?> Etsy" title="<?php echo $imgcaption; ?> Etsy" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Better Business Bureau
		if ( $bbb != '' && $bbb != ' ' && file_exists($smw_dir.'/bbb.png')) {
			?><a href="<?php echo $bbb; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/bbb.png" alt="<?php echo $imgcaption; ?> Better Business Bureau" title="<?php echo $imgcaption; ?> Better Business Bureau" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Merchant Circle
		if ( $merchantcircle != '' && $merchantcircle != ' ' && file_exists($smw_dir.'/merchantcircle.png')) {
			?><a href="<?php echo $merchantcircle; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/merchantcircle.png" alt="<?php echo $imgcaption; ?> Merchant Circle" title="<?php echo $imgcaption; ?> Merchant Circle" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Ebay
		if ( $ebay != '' && $ebay != ' ' && file_exists($smw_dir.'/ebay.png')) {
			?><a href="<?php echo $ebay; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/ebay.png" alt="<?php echo $imgcaption; ?> Ebay" title="<?php echo $imgcaption; ?> Ebay" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Steam
		if ( $steam != '' && $steam != ' ' && file_exists($smw_dir.'/steam.png')) {
			?><a href="<?php echo $steam; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/steam.png" alt="<?php echo $imgcaption; ?> Steam" title="<?php echo $imgcaption; ?> Steam" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; //If no URL Inputed
		}
		
		// Custom Icon 1
		if ( $custom1url != '' && $custom1name != '' && $custom1icon != '' ) {
			?><a href="<?php echo $custom1url; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $custom1icon; ?>" alt="<?php echo $imgcaption; ?> <?php echo $custom1name; ?>" title="<?php echo $imgcaption; ?> <?php echo $custom1name; ?>" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" width="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" height="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Custom Icon 2
		if ( $custom2url != '' && $custom2name != '' && $custom2icon != '' ) {
			?><a href="<?php echo $custom2url; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $custom2icon; ?>" alt="<?php echo $imgcaption; ?> <?php echo $custom2name; ?>" title="<?php echo $imgcaption; ?> <?php echo $custom2name; ?>" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" width="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" height="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Custom Icon 3
		if ( $custom3url != '' && $custom3name != '' && $custom3icon != '' ) {
			?><a href="<?php echo $custom3url; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $custom3icon; ?>" alt="<?php echo $imgcaption; ?> <?php echo $custom3name; ?>" title="<?php echo $imgcaption; ?> <?php echo $custom3name; ?>" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" width="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" height="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Custom Icon 4
		if ( $custom4url != '' && $custom4name != '' && $custom4icon != '' ) {
			?><a href="<?php echo $custom4url; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $custom4icon; ?>" alt="<?php echo $imgcaption; ?> <?php echo $custom4name; ?>" title="<?php echo $imgcaption; ?> <?php echo $custom4name; ?>" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" width="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" height="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Custom Icon 5
		if ( $custom5url != '' && $custom5name != '' && $custom5icon != '' ) {
			?><a href="<?php echo $custom5url; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $custom5icon; ?>" alt="<?php echo $imgcaption; ?> <?php echo $custom5name; ?>" title="<?php echo $imgcaption; ?> <?php echo $custom5name; ?>" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" width="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" height="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// Custom Icon 6
		if ( $custom6url != '' && $custom6name != '' && $custom6icon != '' ) {
			?><a href="<?php echo $custom6url; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $custom6icon; ?>" alt="<?php echo $imgcaption; ?> <?php echo $custom6name; ?>" title="<?php echo $imgcaption; ?> <?php echo $custom6name; ?>" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" width="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" height="<?php if ( $instance['icon_pack'] == 'kabuki' ) { echo '24'; } else { echo $icon_size; } ?>" /></a><?php
		} else {
			echo ''; //If no URL inputed
		}
		
		// RSS
		if ( $rss != '' && $rss != ' ' && file_exists($smw_dir.'/rss.png')) {
			?><a href="<?php echo $rss; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/rss.png" alt="<?php echo $imgcaption ?> RSS" title="<?php echo $imgcaption ?> RSS" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo '';// If no URL Inputed
		}
		
		// E-mail Subscription -- If Newsletter or Mailing List available
		if ( $subscribe != '' && $subscribe != ' ' && file_exists($smw_dir.'/email.png')) {
			?><a href="<?php echo $subscribe; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img  src="<?php echo $smw_path; ?>/email.png" alt="<?php echo $imgcaption ?> E-mail" title="<?php echo $imgcaption ?> E-mail" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" /></a><?php
		} else {
			echo ''; // If no URL Inputed
		}
		
		/* After widget (defined by themes). */
		echo "</div>";
		
		echo $after_widget;
	}

	/* Update the widget settings  */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip Tags For Text Boxes */
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['imgcaption'] = $new_instance['imgcaption'];
		$instance['icon_size'] = $new_instance['icon_size'];
		$instance['icon_pack'] = $new_instance['icon_pack'];
		$instance['animation'] = $new_instance['animation'];
		$instance['icon_opacity'] = $new_instance['icon_opacity'];
		$instance['newtab'] = $new_instance['newtab'];
		$instance['nofollow'] = $new_instance['nofollow'];
		$instance['alignment'] = $new_instance['alignment'];
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['myspace'] = strip_tags( $new_instance['myspace'] );
		$instance['orkut'] = strip_tags( $new_instance['orkut'] );
		$instance['hyves'] = strip_tags( $new_instance['hyves'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['asmallworld'] = strip_tags( $new_instance['asmallworld'] );
		$instance['foursquare'] = strip_tags( $new_instance['foursquare'] );
		$instance['meetup'] = strip_tags( $new_instance['meetup'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['picasa'] = strip_tags( $new_instance['picasa'] );
		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
		$instance['deviantart'] = strip_tags( $new_instance['deviantart'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['hulu'] = strip_tags( $new_instance['hulu'] );
		$instance['ustream'] = strip_tags( $new_instance['ustream'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		$instance['flixster'] = strip_tags( $new_instance['flixster'] );
		$instance['imdb'] = strip_tags( $new_instance['imdb'] );
		$instance['steam'] = strip_tags( $new_instance['steam'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );
		$instance['talk'] = strip_tags( $new_instance['talk'] );
		$instance['digg'] = strip_tags( $new_instance['digg'] );
		$instance['reddit'] = strip_tags( $new_instance['reddit'] );
		$instance['delicious'] = strip_tags( $new_instance['delicious'] );
		$instance['stumble'] = strip_tags( $new_instance['stumble'] );
		$instance['buzz'] = strip_tags( $new_instance['buzz'] );
		$instance['friendfeed'] = strip_tags( $new_instance['friendfeed'] );
		$instance['rss_url'] = strip_tags( $new_instance['rss_url'] );
		$instance['subscribe'] = strip_tags( $new_instance['subscribe'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		$instance['blogger'] = strip_tags( $new_instance['blogger'] );
		$instance['wordpress'] = strip_tags( $new_instance['wordpress'] );
		$instance['yelp'] = strip_tags( $new_instance['yelp'] );
		$instance['slideshare'] = strip_tags( $new_instance['slideshare'] );
		$instance['bbb'] = strip_tags( $new_instance['bbb'] );
		$instance['merchantcircle'] = strip_tags( $new_instance['merchantcircle'] );
		$instance['etsy'] = strip_tags( $new_instance['etsy'] );
		$instance['ebay'] = strip_tags( $new_instance['ebay'] );
		$instance['lastfm'] = strip_tags( $new_instance['lastfm'] );
		$instance['pandora'] = strip_tags( $new_instance['pandora'] );
		$instance['ping'] = strip_tags( $new_instance['ping'] );
		$instance['live365'] = strip_tags( $new_instance['live365'] );
		$instance['digitaltunes'] = strip_tags( $new_instance['digitaltunes'] );
		$instance['soundcloud'] = strip_tags( $new_instance['soundcloud'] );
		$instance['bandcamp'] = strip_tags( $new_instance['bandcamp'] );
		$instance['tungle'] = strip_tags( $new_instance['tungle'] );
		$instance['plancast'] = strip_tags( $new_instance['plancast'] );
		$instance['custom1name'] = strip_tags( $new_instance['custom1name'] );
		$instance['custom1icon'] = strip_tags( $new_instance['custom1icon'] );
		$instance['custom1url'] = strip_tags( $new_instance['custom1url'] );
		$instance['custom2name'] = strip_tags( $new_instance['custom2name'] );
		$instance['custom2icon'] = strip_tags( $new_instance['custom2icon'] );
		$instance['custom2url'] = strip_tags( $new_instance['custom2url'] );
		$instance['custom3name'] = strip_tags( $new_instance['custom3name'] );
		$instance['custom3icon'] = strip_tags( $new_instance['custom3icon'] );
		$instance['custom3url'] = strip_tags( $new_instance['custom3url'] );
		$instance['custom4name'] = strip_tags( $new_instance['custom4name'] );
		$instance['custom4icon'] = strip_tags( $new_instance['custom4icon'] );
		$instance['custom4url'] = strip_tags( $new_instance['custom4url'] );
		$instance['custom5name'] = strip_tags( $new_instance['custom5name'] );
		$instance['custom5icon'] = strip_tags( $new_instance['custom5icon'] );
		$instance['custom5url'] = strip_tags( $new_instance['custom5url'] );
		$instance['custom6name'] = strip_tags( $new_instance['custom6name'] );
		$instance['custom6icon'] = strip_tags( $new_instance['custom6icon'] );
		$instance['custom6url'] = strip_tags( $new_instance['custom6url'] );
		$instance['customiconsurl'] = strip_tags( $new_instance['customiconsurl'] );
		$instance['customiconspath'] = strip_tags( $new_instance['customiconspath'] );
		
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => __('Follow Us!' ),
			'text' => '',
			'imgcaption' => __('Follow Us on' ), 
			'icon_size' => 'default',
			'icon_pack' => 'kabuki',
			'animation' => 'Fade',
			'icon_opacity' => 'default',
			'newtab' => 'yes',
			'nofollow' => 'on',
			'alignment' => 'left',
			'facebook' => '', 
			'googleplus' => '',
			'twitter' => '',
			'myspace' => '',
			'orkut' => '',
			'hyves' => '',
			'linkedin' => '',
			'asmallworld' => '',
			'foursquare' => '',
			'meetup' => '',			
			'flickr' => '',
			'picasa' => '',
			'pinterest' => '',
			'deviantart' => '',
			'youtube' => '',
			'hulu' => '',
			'ustream' => '',
			'vimeo' => '',
			'flixster' => '',
			'imdb' => '',
			'steam' => '',
			'skype' => '',
			'talk' => '',
			'digg' => '',
			'reddit' => '',
			'delicious' => '',
			'stumble' => '',
			'buzz' => '',
			'friendfeed' => '',
			'rss_url' => '',
			'subscribe' => '',
			'tumblr' => '',
			'blogger' => '',
			'wordpress' => '',
			'yelp' => '',
			'slideshare' => '',
			'bbb' => '',
			'merchantcircle' => '',
			'etsy' => '',
			'ebay' => '',
			'lastfm' => '',
			'pandora' => '',
			'ping' => '',
			'live365' => '',
			'digitaltunes' => '',
			'soundcloud' => '',
			'bandcamp' => '',
			'tungle' => '',
			'plancast' => '',
			'custom1name' => '',
			'custom1icon' => '',
			'custom1url' => '',
			'custom2name' => '',
			'custom2icon' => '',
			'custom2url' => '',
			'custom3name' => '',
			'custom3icon' => '',
			'custom3url' => '',
			'custom4name' => '',
			'custom4icon' => '',
			'custom4url' => '',
			'custom5name' => '',
			'custom5icon' => '',
			'custom5url' => '',
			'custom6name' => '',
			'custom6icon' => '',
			'custom6url' => '',
			'customiconsurl' => __('http://wwww.yoursite.com/wordpress/wp-content/your-icons' ), 
			'customiconspath' => __('/path/to/your-icons' ));
			
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
		<em>Note: Make sure you include FULL URL (i.e. http://www.example.com)</em><br />
		If you do not want an icon to be visible, simply delete the supplied URL and leave the input blox blank.
		</p>
		
		<div style="width:32%; float: left;">
		<h3>General Settings</h3>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:85%;" />
		</p>

		<!-- Widget Text: Textarea -->
		<p>
			<label for"<?php echo $this->get_field_id( 'text' ); ?>"><?php _e('Widget Text:' ); ?></label>
			<textarea id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="8" cols="20" style="width:85%;" ><?php echo $instance['text']; ?></textarea>
		</p>

		<!-- Image Caption: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'imgcaption' ); ?>"><?php _e('Icon Alt and Title Tag:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'imgcaption' ); ?>" name="<?php echo $this->get_field_name( 'imgcaption' ); ?>" value="<?php echo $instance['imgcaption']; ?>" style="width:85%;" />
		</p>
		
		<!-- Choose Icon Size: Dropdown -->
	
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_size' ); ?>"><?php _e('Icon Size' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'icon_size' ); ?>" name="<?php echo $this->get_field_name( 'icon_size' ); ?>">
			<option value="16" <?php if($instance['icon_size'] == '16') { echo 'selected'; } ?>>16px</option>
			<option value="default" <?php if($instance['icon_size'] == 'default') { echo 'selected'; } ?>>Default (32px)</option>
			<option value="64" <?php if($instance['icon_size'] == '64') { echo 'selected'; } ?>>64px</option>
			</select>
		</p>
		
	<!-- Choose Icon Pack: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_pack' ); ?>"><?php _e('Icon Pack' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'icon_pack' ); ?>" name="<?php echo $this->get_field_name( 'icon_pack' ); ?>">
			<option value="cutout" <?php if($instance['icon_pack'] == 'cutout') { echo 'selected'; } ?>>Cutout Icons</option>
			<option value="heart" <?php if($instance['icon_pack'] == 'heart') { echo 'selected'; } ?>>Heart Icons</option>
			<option value="default" <?php if($instance['icon_pack'] == 'default') { echo 'selected'; } ?>>Default Icons (Web2.0)</option>
			<option value="sketch" <?php if($instance['icon_pack'] == 'sketch') { echo 'selected'; } ?>>Sketch Icons</option>
			<option value="kabuki" <?php if($instance['icon_pack'] == 'kabuki') { echo 'selected'; } ?>>Kabuki Theme Icons</option>
			<option value="custom" <?php if($instance['icon_pack'] == 'custom') { echo 'selected'; } ?>>Custom Icons</option>
			</select>
		</p>
		
	<!-- Type of Animation: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'animation' ); ?>"><?php _e('Type of Animation' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'animation' ); ?>" name="<?php echo $this->get_field_name( 'animation' ); ?>">
			<option value="fade" <?php if($instance['animation'] == 'fade') { echo 'selected'; } ?>>Fade In</option>
			<option value="scale" <?php if($instance['animation'] == 'scale') { echo 'selected'; } ?>>Scale</option>
			<option value="bounce" <?php if($instance['animation'] == 'bounce') { echo 'selected'; } ?>>Bounce</option>
			<option value="combo" <?php if($instance['animation'] == 'combo') { echo 'selected'; } ?>>Combo</option>
			</select>
		</p>
		
	<!--Starting Icon Opacity: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_opacity' ); ?>"><?php _e('Default Icon Opacity' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'icon_opacity' ); ?>" name="<?php echo $this->get_field_name( 'icon_opacity' ); ?>">
			<option value="0.5" <?php if($instance['icon_opacity'] == '0.5') { echo 'selected'; } ?>>50%</option>
			<option value="0.6" <?php if($instance['icon_opacity'] == '0.6') { echo 'selected'; } ?>>60%</option>
			<option value="0.7" <?php if($instance['icon_opacity'] == '0.7') { echo 'selected'; } ?>>70%</option>
			<option value="0.8" <?php if($instance['icon_opacity'] == '0.8') { echo 'selected'; } ?>>80%</option>
			<option value="0.9" <?php if($instance['icon_opacity'] == '0.9') { echo 'selected'; } ?>>90%</option>
			<option value="default" <?php if($instance['icon_opacity'] == 'default') { echo 'selected'; } ?>>Default (100%)</option>
			</select>
			<span style="color: #999;"><em>Only applies to Fade and Combo animations</em></span>
		</p>
	
	
		<!-- No Follow On or Off: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e('Use rel="nofollow" for links' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>">
			<option value="on" <?php if($instance['nofollow'] == 'on') { echo 'selected'; } ?>>On</option>
			<option value="off" <?php if($instance['nofollow'] == 'off') { echo 'selected'; } ?>>Off</option>
			</select>
		</p>
		
		
		<!-- Open in new tab: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'newtab' ); ?>"><?php _e('Open in new tab?' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'newtab' ); ?>" name="<?php echo $this->get_field_name( 'newtab' ); ?>">
			<option value="yes" <?php if($instance['newtab'] == 'yes') { echo 'selected'; } ?>>Yes</option>
			<option value="no" <?php if($instance['newtab'] == 'no') { echo 'selected'; } ?>>No</option>
			</select>
		</p>
		
		<!-- Alignment: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'alignment' ); ?>"><?php _e('Icon Alignment' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'alignment' ); ?>" name="<?php echo $this->get_field_name( 'alignment' ); ?>">
			<option value="left" <?php if($instance['alignment'] == 'left') { echo 'selected'; } ?>>Left</option>
			<option value="centered" <?php if($instance['alignment'] == 'centered') { echo 'selected'; } ?>>Centered</option>
			<option value="right" <?php if($instance['alignment'] == 'right') { echo 'selected'; } ?>>Right</option>
			</select>
		</p>
		
		<h3>Social Networking</h3>
		<!-- Facebook URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" style="width:85%;" />
		</p>
		
		<!-- Google Plus URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e('Google+ URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" value="<?php echo $instance['googleplus']; ?>" style="width:85%;" />
		</p>
		
		<!-- Twitter URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" style="width:85%;" />
		</p>

		<!-- MySpace URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'myspace' ); ?>"><?php _e('MySpace URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'myspace' ); ?>" name="<?php echo $this->get_field_name( 'myspace' ); ?>" value="<?php echo $instance['myspace']; ?>" style="width:85%;" />
		</p>

		<!-- LinkedIn URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('LinkedIn URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" style="width:85%;" />
		</p>
		
		<!-- Foursquare URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'foursquare' ); ?>"><?php _e('Foursquare URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'foursquare' ); ?>" name="<?php echo $this->get_field_name( 'foursquare' ); ?>" value="<?php echo $instance['foursquare']; ?>" style="width:85%;" />
		</p>
		
		</div>
		<div style="width:32%; float: left; padding-left: 10px; border-left: 1px solid #000">
	
		<h3>Social News & Feeds</h3>
		<!-- Digg URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'digg' ); ?>"><?php _e('Digg URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'digg' ); ?>" name="<?php echo $this->get_field_name( 'digg' ); ?>" value="<?php echo $instance['digg']; ?>" style="width:85%;" />
		</p>
		
 		
		<!-- Delicious URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'delicious' ); ?>"><?php _e('Delicious URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'delicious' ); ?>" name="<?php echo $this->get_field_name( 'delicious' ); ?>" value="<?php echo $instance['delicious']; ?>" style="width:85%;" />
		</p>

		<!-- StumpleUpon URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'stumble' ); ?>"><?php _e('StumbleUpon URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'stumble' ); ?>" name="<?php echo $this->get_field_name( 'stumble' ); ?>" value="<?php echo $instance['stumble']; ?>" style="width:85%;" />
		</p>
		
		<!-- RSS URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'rss_url' ); ?>"><?php _e('RSS URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'rss_url' ); ?>" name="<?php echo $this->get_field_name( 'rss_url' ); ?>" value="<?php echo $instance['rss_url']; ?>" style="width:85%;" />
		</p>
		
		<!-- Subscribe URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'subscribe' ); ?>"><?php _e('E-mail URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'subscribe' ); ?>" name="<?php echo $this->get_field_name( 'subscribe' ); ?>" value="<?php echo $instance['subscribe'] ?>" style="width:85%;" />
		</p>
		
		<h3>Blogging</h3>
		<!-- Tumblr URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e('Tumblr URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" value="<?php echo $instance['tumblr']; ?>" style="width:85%;" />
		</p>
		
	
		<h3>Music & Audio</h3>
		<!-- Last.fm URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'lastfm' ); ?>"><?php _e('Last.fm URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'lastfm' ); ?>" name="<?php echo $this->get_field_name( 'lastfm' ); ?>" value="<?php echo $instance['lastfm']; ?>" style="width:85%;" />
		</p>
		
				<h3>Images and Video</h3>
		<!-- Flickr URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('Flickr URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" style="width:85%;" />
		</p>
		
		<!-- Picasa URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'picasa' ); ?>"><?php _e('Picasa Web URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'picasa' ); ?>" name="<?php echo $this->get_field_name( 'picasa' ); ?>" value="<?php echo $instance['picasa']; ?>" style="width:85%;" />
		</p>
		
		<!-- Pinterest URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('Pinterest URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" style="width:85%;" />
		</p>
		
		<!-- YouTube URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('YouTube URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" style="width:85%;" />
		</p>
		
		<!-- Vimeo URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('Vimeo URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" style="width:85%;" />
		</p>
		
		
		</div>
		<div style="width: 30%; float: left; border-left: 1px solid #000; padding-left: 10px;">
		
		<p><em>Here you can input 5 custom icons. Make sure you input FULL urls to the icon (including http://). The images will resize both width and height to the icon size chosen.</em><br />	
		</p>
		<strong>Custom Services</strong>
		<!-- Custom Service 1: Text Input -->
		
		<p>
			<label for="<?php echo $this->get_field_id( 'custom1name' ); ?>"><?php _e('Custom Service 1 Name:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom1name' ); ?>" name="<?php echo $this->get_field_name( 'custom1name' ); ?>" value="<?php echo $instance['custom1name']; ?>" style="width:85%;" />
			<label for="<?php echo $this->get_field_id( 'custom1icon' ); ?>"><?php _e('Custom Service 1 Icon URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom1icon' ); ?>" name="<?php echo $this->get_field_name( 'custom1icon' ); ?>" value="<?php echo $instance['custom1icon']; ?>" style="width:85%;" />
			<label for="<?php echo $this->get_field_id( 'custom1url' ); ?>"><?php _e('Custom Service 1 Profile URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom1url' ); ?>" name="<?php echo $this->get_field_name( 'custom1url' ); ?>" value="<?php echo $instance['custom1url']; ?>" style="width:85%;" />
		</p>
		
		<!-- Custom Service 2: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'custom2name' ); ?>"><?php _e('Custom Service 2 Name:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom2name' ); ?>" name="<?php echo $this->get_field_name( 'custom2name' ); ?>" value="<?php echo $instance['custom2name']; ?>" style="width:85%;" />
			<label for="<?php echo $this->get_field_id( 'custom2icon' ); ?>"><?php _e('Custom Service 2 Icon URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom2icon' ); ?>" name="<?php echo $this->get_field_name( 'custom2icon' ); ?>" value="<?php echo $instance['custom2icon']; ?>" style="width:85%;" />
			<label for="<?php echo $this->get_field_id( 'custom2url' ); ?>"><?php _e('Custom Service 2 Profile URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom2url' ); ?>" name="<?php echo $this->get_field_name( 'custom2url' ); ?>" value="<?php echo $instance['custom2url']; ?>" style="width:85%;" />
		</p>
		
		<!-- Custom Service 3: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'custom3name' ); ?>"><?php _e('Custom Service 3 Name:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom3name' ); ?>" name="<?php echo $this->get_field_name( 'custom3name' ); ?>" value="<?php echo $instance['custom3name']; ?>" style="width:85%;" />
			<label for="<?php echo $this->get_field_id( 'custom3icon' ); ?>"><?php _e('Custom Service 3 Icon URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom3icon' ); ?>" name="<?php echo $this->get_field_name( 'custom3icon' ); ?>" value="<?php echo $instance['custom3icon']; ?>" style="width:85%;" />
			<label for="<?php echo $this->get_field_id( 'custom3url' ); ?>"><?php _e('Custom Service 3 Profile URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom3url' ); ?>" name="<?php echo $this->get_field_name( 'custom3url' ); ?>" value="<?php echo $instance['custom3url']; ?>" style="width:85%;" />
		</p>
		
		<!-- Custom Service 4: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'custom4name' ); ?>"><?php _e('Custom Service 4 Name:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom4name' ); ?>" name="<?php echo $this->get_field_name( 'custom4name' ); ?>" value="<?php echo $instance['custom4name']; ?>" style="width:85%;" />
			<label for="<?php echo $this->get_field_id( 'custom4icon' ); ?>"><?php _e('Custom Service 4 Icon URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom4icon' ); ?>" name="<?php echo $this->get_field_name( 'custom4icon' ); ?>" value="<?php echo $instance['custom4icon']; ?>" style="width:85%;" />
			<label for="<?php echo $this->get_field_id( 'custom4url' ); ?>"><?php _e('Custom Service 4 Profile URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom4url' ); ?>" name="<?php echo $this->get_field_name( 'custom4url' ); ?>" value="<?php echo $instance['custom4url']; ?>" style="width:85%;" />
		</p>
		
		<!-- Custom Service 5: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'custom5name' ); ?>"><?php _e('Custom Service 5 Name:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom5name' ); ?>" name="<?php echo $this->get_field_name( 'custom5name' ); ?>" value="<?php echo $instance['custom5name']; ?>" style="width:85%;" />
			<label for="<?php echo $this->get_field_id( 'custom5icon' ); ?>"><?php _e('Custom Service 5 Icon URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom5icon' ); ?>" name="<?php echo $this->get_field_name( 'custom5icon' ); ?>" value="<?php echo $instance['custom5icon']; ?>" style="width:85%;" />
			<label for="<?php echo $this->get_field_id( 'custom5url' ); ?>"><?php _e('Custom Service 5 Profile URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom5url' ); ?>" name="<?php echo $this->get_field_name( 'custom5url' ); ?>" value="<?php echo $instance['custom5url']; ?>" style="width:85%;" />
		</p>
		
	<p><em>If you selected "Custom Icon Pack" from the beginning of this form, input the URL and path to those icons in the following boxes. See the README.txt for more information on how to use this.</em><br />
	</p>
	
	<!-- Custom Icon Pack URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'customiconsurl' ); ?>"><?php _e('Custom Icons URL:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'customiconsurl' ); ?>" name="<?php echo $this->get_field_name( 'customiconsurl' ); ?>" value="<?php echo $instance['customiconsurl']; ?>" style="width:85%;" />
		</p>
		
	<!-- Custom Icon Pack Path: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'customiconspath' ); ?>"><?php _e('Custom Icons Path:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'customiconspath' ); ?>" name="<?php echo $this->get_field_name( 'customiconspath' ); ?>" value="<?php echo $instance['customiconspath']; ?>" style="width:85%;" />
		</p>
		
		
	
		
		</div>
		<div style="clear: both;"></div>
		

		

	<?php
	}
}

/* Add scripts to header */
add_action('wp_head', 'Social_Widget_Scripts');

/* Load the widget */
add_action( 'widgets_init', 'socialwidget_load_widgets' );
?>
