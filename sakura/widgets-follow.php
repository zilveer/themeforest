<?php


define('sakura_SMW_PLUGINPATH',get_option('siteurl').'/wp-content/themes/sakura/images/social/');
define('sakura_SMW_PLUGINDIR', ABSPATH.'/wp-content/themes/sakura/images/social/');

//$social=explode(" ", "yahoo facebook delicious icq skype lj myspace talk twitter youtube vimeo aim");
$social=array();
$images=array();

if ($handle = opendir(dirname(__FILE__)."/images/social/")) {

    while (false !== ($file = readdir($handle))) {
        $prev_file=$file;
        if (!preg_match('/\.png$/', $file)) continue;
        $file=str_replace('.png', '', $file);
        $file=str_replace('.', ' ', $file);
        $file=str_replace('_resize', '', $file);
        $social[]=$file;
        $images[$file]=$prev_file;
    }

    closedir($handle);
}

//$social=array_merge($social, $social, $social, $social, $social, $social, $social);

/* Function for CSS */

function sakura_Social_Widget_Scripts(){	
	$social_widget_path = sakura_SMW_PLUGINPATH; 
	return;
?>
<link rel="stylesheet" type="text/css" href="<?php echo $social_widget_path; ?>social_widget.css" />
<?php } 

/* Register the widget */
function sakura_socialwidget_load_widgets() {
	register_widget( 'sakura_Social_Widget' );
}

/* Begin Widget Class */
class sakura_Social_Widget extends WP_Widget {

	/* Widget setup  */
	function sakura_Social_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'sakura_Social_Widget', 'description' => __('A widget that allows the user to display social media icons in their sidebar', 'smw') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 600, 'height' => 350, 'id_base' => 'sakura-social-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'sakura-social-widget', __('Sakura Theme Follow Me', 'smw'), $widget_ops, $control_ops );
	}

	/* Display the widget  */
	function widget( $args, $instance ) {
		extract( $args );
	
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$text = apply_filters( 'widget_text', $instance['text'], $instance );
		$imgcaption = $instance['imgcaption'];
		$facebook = $instance['facebook'];		
		$yahoo = $instance['yahoo'];		
		$twitter = $instance['twitter'];
		$myspace = $instance['myspace'];
		$friendfeed = $instance['friendfeed'];
		$orkut = $instance['orkut'];
		$hyves = $instance['hyves'];
		$linkedin = $instance['linkedin'];
		$asmallworld = $instance['asmallworld'];
		$flickr = $instance['flickr'];
		$youtube = $instance['youtube'];
		$skype = $instance['skype'];
		$digg = $instance['digg'];
		$reddit = $instance['reddit'];
		$delicious = $instance['delicious'];
		$stumble = $instance['stumble'];
		$tumblr = $instance['tumblr'];
		$buzz = $instance['buzz'];
		$vimeo = $instance['vimeo'];
		$blogger = $instance['blogger'];
		$wordpress = $instance['wordpress'];
		$yelp = $instance['yelp'];
		$lastfm = $instance['lastfm'];
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
		$etsy = $instance['etsy'];
		$bbb = $instance['bbb'];		
		$merchantcircle = $instance['merchantcircle'];
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
		
	   foreach ($GLOBALS['social'] as $v)
	   {
	      $$v=$instance[$v];
	   }
	
		/* Choose Icon Size if Value is 'default' */
		if($icon_size == 'default') {
			$icon_size = '32';
		}
		
		/* Choose icon opacity if Value is 'default' */
		if($icon_opacity == 'default') {
			$icon_opacity = '0.8';
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
			$newtab = "";
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
				$smw_path = sakura_SMW_PLUGINPATH;
				$smw_dir = sakura_SMW_PLUGINDIR;
			}

      echo '<div class="widget_block">
  <span class="widget-title _cf">'.$title.'</span>';
		
		
		echo '<ul class="widget-follow_me">';
			
		/* Display linked images to profiles from widget settings if one was input. */

      //echo $smw_dir;
      $c=1;
      
	   foreach ($GLOBALS['social'] as $v)
	   {
	      $f=$smw_dir.'/'.$GLOBALS['images'][$v];
	      $imgcaption=ucfirst($v);
	      //echo $f."<br />";
		   if ( $$v != '' && $$v != ' ' && file_exists($f)) {
		          
			   ?><li<?php if ($c++%6==0) echo ' class="no_6"'; ?>><a href="<?php echo $$v; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $smw_path; ?>/<?php echo $GLOBALS['images'][$v]; ?>" alt="<?php echo $imgcaption; ?>" title="<?php echo $imgcaption ?>" <?php if($animation == 'fade' || $animation == 'combo') { ?> <?php } ?>class="<?php echo $animation; ?>" /></a></li><?php 
		   } else {
			   echo ''; //If no URL inputed
		   }
	   }

		
		///////////////////////////////////////////////////////////////////////
		
		echo '  </ul>
</div>';

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
		$instance['imgcaption'] = strip_tags( $new_instance['imgcaption'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['yahoo'] = strip_tags( $new_instance['facebook'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['myspace'] = strip_tags( $new_instance['myspace'] );
		$instance['friendfeed'] = strip_tags( $new_instance['friendfeed'] );
		$instance['orkut'] = strip_tags( $new_instance['orkut'] );
		$instance['hyves'] = strip_tags( $new_instance['hyves'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['asmallworld'] = strip_tags( $new_instance['asmallworld'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );
		$instance['digg'] = strip_tags( $new_instance['digg'] );
		$instance['reddit'] = strip_tags( $new_instance['reddit'] );
		$instance['delicious'] = strip_tags( $new_instance['delicious'] );
		$instance['stumble'] = strip_tags( $new_instance['stumble'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		$instance['buzz'] = strip_tags( $new_instance['buzz'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		$instance['blogger'] = strip_tags( $new_instance['blogger'] );
		$instance['wordpress'] = strip_tags( $new_instance['wordpress'] );
		$instance['yelp'] = strip_tags( $new_instance['yelp'] );
		$instance['lastfm'] = strip_tags( $new_instance['lastfm'] );
		$instance['foursquare'] = strip_tags( $new_instance['foursquare'] );
		$instance['meetup'] = strip_tags( $new_instance['meetup'] );
		$instance['tungle'] = strip_tags( $new_instance['tungle'] );
		$instance['plancast'] = strip_tags( $new_instance['plancast'] );
		$instance['slideshare'] = strip_tags( $new_instance['slideshare'] );
		$instance['deviantart'] = strip_tags( $new_instance['deviantart'] );
		$instance['ping'] = strip_tags( $new_instance['ping'] );
		$instance['live365'] = strip_tags( $new_instance['live365'] );
		$instance['digitaltunes'] = strip_tags( $new_instance['digitaltunes'] );
		$instance['soundcloud'] = strip_tags( $new_instance['soundcloud'] );
		$instance['etsy'] = strip_tags( $new_instance['etsy'] );
		$instance['bbb'] = strip_tags( $new_instance['bbb'] );
		$instance['merchantcircle'] = strip_tags( $new_instance['merchantcircle'] );
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
		$instance['rss_url'] = strip_tags( $new_instance['rss_url'] );
		$instance['subscribe'] = strip_tags( $new_instance['subscribe'] );
		$instance['icon_size'] = $new_instance['icon_size'];
		$instance['icon_pack'] = $new_instance['icon_pack'];
		$instance['customiconsurl'] = strip_tags( $new_instance['customiconsurl'] );
		$instance['customiconspath'] = strip_tags( $new_instance['customiconspath'] );
		$instance['animation'] = $new_instance['animation'];
		$instance['icon_opacity'] = $new_instance['icon_opacity'];
		$instance['newtab'] = $new_instance['newtab'];
		$instance['nofollow'] = $new_instance['nofollow'];
		$instance['alignment'] = $new_instance['alignment'];
		
		foreach ($GLOBALS['social'] as $v)
		{
		   $instance[$v] = strip_tags( $new_instance[$v] );
		}
		
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
			'title' => __('Follow me here', 'smw'),
			'text' => '',
			'imgcaption' => __('Follow Me Here', 'smw'), 
			'yahoo' => __('http://pulse.yahoo.com/yourname'),
			'facebook' => __('http://www.facebook.com/your_name', 'smw'), 
			'twitter' => __('http://www.twitter.com/yourname', 'smw'),
			'myspace' => __('http://www.myspace.com/yourname', 'smw'),
			'friendfeed' => __('http://www.friendfeed.com/yourname', 'smw'),
			'orkut' => __('http://www.orkut.com/Main#Profile?uid=youruid', 'smw'),
			'hyves' => __('http://yourname.hyves.nl', 'smw'),
			'linkedin' => __('http://www.linkedin.com/in/yourname', 'smw'),
			'asmallworld' => __('', 'smw'),
			'flickr' => __('http://www.flickr.com/photos/yourname', 'smw'),
			'youtube' => __('http://www.youtube.com/user/yourname', 'smw'),
			'skype' => __('skype:yourusername?add', 'smw'),
			'digg' => __('http://www.digg.com/users/yourname', 'smw'),
			'reddit' => __('http://www.reddit.com/user/yourname', 'smw'),
			'delicious' => __('http://delicious.com/yourname', 'smw'),
			'stumble' => __('http://www.stumbleupon.com/stumbler/yourname', 'smw'),
			'tumblr' => __('http://yourname.tumblr.com', 'smw'),
			'buzz' => __('http://www.google.com/profiles/yourname#buzz', 'smw'),
			'vimeo' => __('http://www.vimeo.com/yourname', 'smw'),
			'icq' => 'http://www.icq.com/people/your_uin',
			'lj' => 'http://your_name.livejournal.com/',
			'talk' => 'http://www.gtalkprofile.com/your_profile',
			'aim' => 'http://buddyinfo.aim.com/your_profile',
			'blogger' => __('http://www.blogger.com/profile/youridnumber', 'smw'),
			'wordpress' => __('http://en.gravatar.com/yourname', 'smw'),
			'yelp' => __('http://yourname.yelp.com', 'smw'),
			'lastfm' => __('http://www.last.fm/user/yourname', 'smw'),
			'foursquare' => __('http://foursquare.com/user/yourname', 'smw'),
			'meetup' => __('http://www.meetup.com/your-group', 'smw'),
			'tungle' => __('', 'smw'),
			'plancast' => __('', 'smw'),
			'slideshare' => __('http://www.slideshare.net/nolimit2it/yourname', 'smw'),
			'deviantart' => __('http://yourname.deviantart.com/', 'smw'),
			'ping' => __('http://c.itunes.apple.com/WebObjects/MZConnections.woa/wa/viewProfile?userId=youruserid'),
			'live365' => __('', 'smw'),
			'digitaltunes' => __('http://www.digital-tunes.net/user_profile/yourname', 'smw'),
			'soundcloud' => __('http://www.soundcloud.com/your-name', 'smw'),
			'etsy' => __('http://www.etsy.com/people/yourname', 'smw'),
			'bbb' => __('http://www.bbb.org/location/business-reviews/service/yourname', 'smw'),
			'merchantcircle' => __('http://www.merchantcircle.com/business/Your.Name.Number', 'smw'),
			'custom1name' => __('', 'smw'),
			'custom1icon' => __('', 'smw'),
			'custom1url' => __('', 'smw'),
			'custom2name' => __('', 'smw'),
			'custom2icon' => __('', 'smw'),
			'custom2url' => __('', 'smw'),
			'custom3name' => __('', 'smw'),
			'custom3icon' => __('', 'smw'),
			'custom3url' => __('', 'smw'),
			'custom4name' => __('', 'smw'),
			'custom4icon' => __('', 'smw'),
			'custom4url' => __('', 'smw'),
			'custom5name' => __('', 'smw'),
			'custom5icon' => __('', 'smw'),
			'custom5url' => __('', 'smw'),
			'custom6name' => __('', 'smw'),
			'custom6icon' => __('', 'smw'),
			'custom6url' => __('', 'smw'),
			'rss_url' => __('http://www.yoursite.com/feed', 'smw'),
			'icon_size' => 'default',
			'icon_pack' => 'default',
			'customiconsurl' => __('http://wwww.yoursite.com/wordpress/wp-content/your-icons', 'smw'), 
			'customiconspath' => __('/path/to/your-icons', 'smw'), 
			'icon_opacity' => 'default',
			'newtab' => 'yes',
			'nofollow' => 'on',
			'alignment' => 'left');
			
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
		<em>Note: Make sure you include FULL URL (i.e. http://www.example.com)</em><br />
		If you do not want an icon to be visible, simply delete the supplied URL and leave the input blox blank.
		</p>
		<!-- Widget Title: Text Input -->
		<div style="width:48%; float: left;">
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:85%;" />
		</p>

		<!-- Image Caption: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'imgcaption' ); ?>"><?php _e('Icon Alt and Title Tag:', 'smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'imgcaption' ); ?>" name="<?php echo $this->get_field_name( 'imgcaption' ); ?>" value="<?php echo $instance['imgcaption']; ?>" style="width:85%;" />
		</p>

      <?php foreach ($GLOBALS['social'] as $v) { ?>
      
		<p>
			<label for="<?php echo $this->get_field_id( $v ); ?>"><?php _e(ucfirst($v).' URL:', 'smw'); ?></label>
			<input id="<?php echo $this->get_field_id( $v ); ?>" name="<?php echo $this->get_field_name( $v ); ?>" value="<?php echo $instance[$v]; ?>" style="width:85%;" />
		</p>
		
		<?php } ?>
		
		
	<!-- Type of Animation: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'animation' ); ?>"><?php _e('Type of Animation', 'smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'animation' ); ?>" name="<?php echo $this->get_field_name( 'animation' ); ?>">
			<option value="fade" <?php if($instance['animation'] == 'fade') { echo 'selected'; } ?>>Fade In</option>
			<option value="scale" <?php if($instance['animation'] == 'scale') { echo 'selected'; } ?>>Scale</option>
			<option value="bounce" <?php if($instance['animation'] == 'bounce') { echo 'selected'; } ?>>Bounce</option>
			<option value="combo" <?php if($instance['animation'] == 'combo') { echo 'selected'; } ?>>Combo</option>
			</select>
		</p>
		
	<!--Starting Icon Opacity: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_opacity' ); ?>"><?php _e('Default Icon Opacity', 'smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'icon_opacity' ); ?>" name="<?php echo $this->get_field_name( 'icon_opacity' ); ?>">
			<option value="0.5" <?php if($instance['icon_opacity'] == '0.5') { echo 'selected'; } ?>>50%</option>
			<option value="0.6" <?php if($instance['icon_opacity'] == '0.6') { echo 'selected'; } ?>>60%</option>
			<option value="0.7" <?php if($instance['icon_opacity'] == '0.7') { echo 'selected'; } ?>>70%</option>
			<option value="default" <?php if($instance['icon_opacity'] == 'default') { echo 'selected'; } ?>>Default (80%)</option>
			<option value="0.9" <?php if($instance['icon_opacity'] == '0.9') { echo 'selected'; } ?>>90%</option>
			<option value="1" <?php if($instance['icon_opacity'] == '1') { echo 'selected'; } ?>>100%</option>
			</select>
			<span style="color: #999;"><em>Only applies to Fade and Combo animations</em></span>
		</p>
	
	
		<!-- No Follow On or Off: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e('Use rel="nofollow" for links', 'smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>">
			<option value="on" <?php if($instance['nofollow'] == 'on') { echo 'selected'; } ?>>On</option>
			<option value="off" <?php if($instance['nofollow'] == 'off') { echo 'selected'; } ?>>Off</option>
			</select>
		</p>
		
		
		<!-- Open in new tab: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'newtab' ); ?>"><?php _e('Open in new tab?', 'smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'newtab' ); ?>" name="<?php echo $this->get_field_name( 'newtab' ); ?>">
			<option value="yes" <?php if($instance['newtab'] == 'yes') { echo 'selected'; } ?>>Yes</option>
			<option value="no" <?php if($instance['newtab'] == 'no') { echo 'selected'; } ?>>No</option>
			</select>
		</p>
		
		<!-- Alignment: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'alignment' ); ?>"><?php _e('Icon Alignment', 'smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'alignment' ); ?>" name="<?php echo $this->get_field_name( 'alignment' ); ?>">
			<option value="left" <?php if($instance['alignment'] == 'left') { echo 'selected'; } ?>>Left</option>
			<option value="centered" <?php if($instance['alignment'] == 'centered') { echo 'selected'; } ?>>Centered</option>
			<option value="right" <?php if($instance['alignment'] == 'right') { echo 'selected'; } ?>>Right</option>
			</select>
		</p>
		
		</div>
		<div style="clear: both;"></div>
		

	<?php
	}
}

/* Add scripts to header */
add_action('wp_head', 'sakura_Social_Widget_Scripts');

/* Load the widget */
add_action( 'widgets_init', 'sakura_socialwidget_load_widgets' );
?>
