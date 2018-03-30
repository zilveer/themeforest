<?php
/*
 * Plugin Name: Facebook Like Box
 * Version: 2.2
 * Plugin URI: http://wordpress.org/extend/plugins/facebook-like-box-widget/
 * Description: Facebook Like Box Widget is a social plugin that enables Facebook Page owners to attract and gain Likes from their own website. The Like Box enables users to: see how many users already like this page, and which of their friends like it too, read recent posts from the page and Like the page with one click, without needing to visit the page.
 * Author: Sunento Agustiar Wu
 * Author URI: http://vivociti.com/component/option,com_remository/Itemid,40/
 * License: GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
class FacebookLikeBoxWidget extends WP_Widget
{
	/**
	* Declares the FacebookLikeBoxWidget class.
	*
	*/
	function FacebookLikeBoxWidget(){
		$widget_ops = array('classname' => 'widget_FacebookLikeBox', 'description' => __( "Facebook Like Box Widget is a social plugin that enables Facebook Page owners to attract and gain Likes from their own website. The Like Box enables users to: see how many users already like this page, and which of their friends like it too, read recent posts from the page and Like the page with one click, without needing to visit the page.") );
		$control_ops = array('width' => 300, 'height' => 300);
		parent::__construct('FacebookLikeBox', __('Facebook Like Box Widget'), $widget_ops, $control_ops);
	}
	
	/**
	* Displays the Widget
	*
	*/
	function widget($args, $instance){
		echo '<div class="gdl-likebox">';
		
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Facebook Like Box' : $instance['title']);
		
		$pluginDisplayType = empty($instance['pluginDisplayType']) ? 'like_box' : $instance['pluginDisplayType'];
		$layoutMode = empty($instance['layoutMode']) ? 'iframe' : $instance['layoutMode'];
                //example of Page URL : http://www.facebook.com/pages/VivoCiticom-Joomla-Wordpress-Blogger-Drupal-DNN-Community/119691288064264
		$pageURL = empty($instance['pageURL']) ? '' : $instance['pageURL'];
		$fblike_button_style = empty($instance['fblike_button_style']) ? 'standard' : $instance['fblike_button_style'];
		$fblike_button_showFaces = empty($instance['fblike_button_showFaces']) ? 'no' : $instance['fblike_button_showFaces'];
		$fblike_button_verb_to_display = empty($instance['fblike_button_verb_to_display']) ? 'recommend' : $instance['fblike_button_verb_to_display'];
		$fblike_button_font = empty($instance['fblike_button_font']) ? 'lucida grande' : $instance['fblike_button_font'];
		$fblike_button_width = empty($instance['fblike_button_width']) ? '292' : $instance['fblike_button_width'];
		$fblike_button_colorScheme = empty($instance['fblike_button_colorScheme']) ? 'light' : $instance['fblike_button_colorScheme'];
		
		//example of Page ID : 123961057630124
		$pageID = empty($instance['pageID']) ? '' : $instance['pageID'];
		$connection = empty($instance['connection']) ? '10' : $instance['connection'];
		$width = empty($instance['width']) ? '292' : $instance['width'];
		$height = empty($instance['height']) ? '255' : $instance['height'];
		$streams = empty($instance['streams']) ? 'yes' : $instance['streams'];
		$colorScheme = empty($instance['colorScheme']) ? 'light' : $instance['colorScheme'];
		$borderColor = empty($instance['borderColor']) ? 'AAAAAA' : $instance['borderColor'];
		$showFaces = empty($instance['showFaces']) ? 'yes' : $instance['showFaces'];
		$header = empty($instance['header']) ? 'yes' : $instance['header'];
		$creditOn = empty($instance['creditOn']) ? 'yes' : $instance['creditOn'];
		$sharePlugin = "http://vivociti.com";
		
		if ($fblike_button_showFaces == "yes") {
			$fblike_button_showFaces == "true";			
		} else {
			$fblike_button_showFaces == "false";
		}		
		if ($showFaces == "yes") {
			$showFaces = "true";			
		} else {
			$showFaces = "false";
		}
		if ($streams == "yes") {
			$streams = "true";
			$height = $height + 300;
		} else {
			$streams = "false";
		}
		if ($header == "yes") {
			$header = "true";
			$height = $height + 32;
		} else {
			$header = "false";
		}

		# Before the widget
		echo $before_widget;
		
		# The title
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}else if( strrpos($after_title, 'bkp-frame') > 0 ) {
			echo '<div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
		}
		
		//this is to check for backward compatibility, previous version all is using Page ID instead of Page URL
		//If Page URL is filled, we will use it
		$isUsingPageURL = false;
		if (strlen($pageURL) > 23) {	
			$isUsingPageURL = true;  //flag to be used for backward
			$like_box_iframe = "<iframe src=\"http://www.facebook.com/plugins/likebox.php?href=$pageURL&amp;width=$width&amp;colorscheme=$colorScheme&amp;border_color=$borderColor&amp;show_faces=$showFaces&amp;connections=$connection&amp;stream=$streams&amp;header=$header&amp;height=$height\" style=\"border:none; overflow:hidden; width:" . $width . "px; height:" . $height . "px;\" ></iframe>";
			$like_box_xfbml = "<script src=\"http://connect.facebook.net/en_US/all.js#xfbml=1\"></script><fb:like-box href=\"$pageURL\" width=\"$width\" show_faces=\"$showFaces\" border_color=\"$borderColor\" stream=\"$streams\" header=\"$header\"></fb:like-box>";
		} else {
			$like_box_iframe = "<iframe src=\"http://www.facebook.com/plugins/likebox.php?id=$pageID&amp;width=$width&amp;colorscheme=$colorScheme&amp;border_color=$borderColor&amp;show_faces=$showFaces&amp;connections=$connection&amp;stream=$streams&amp;header=$header&amp;height=$height\" style=\"border:none; overflow:hidden; width:" . $width . "px; height:" . $height . "px;\" ></iframe>";
			$like_box_xfbml = "<script src=\"http://connect.facebook.net/en_US/all.js#xfbml=1\"></script><fb:like-box id=\"$pageID\" width=\"$width\" show_faces=\"$showFaces\" border_color=\"$borderColor\" stream=\"$streams\" header=\"$header\"></fb:like-box>";		
		}
		$like_button_xfbml  = "<script src=\"http://connect.facebook.net/en_US/all.js#xfbml=1\"></script><fb:like layout=\"$fblike_button_style\" show_faces=\"$fblike_button_showFaces\" width=\"$fblike_button_width\" action=\"$fblike_button_verb_to_display\" font=\"$fblike_button_font\" colorscheme=\"$fblike_button_colorScheme\"></fb:like>";

		switch ($pluginDisplayType) {
			case 'like_box' :
				if (strcmp($layoutMode, "iframe") == 0) {
					$renderedHTML = $like_box_iframe;
				} else {
					$renderedHTML = $like_box_xfbml;
				}
				break;
			case 'like_button' :
				$renderedHTML = $like_button_xfbml;
				break;
			case 'both':
				if (strcmp($layoutMode, "iframe") == 0) {
					$renderedHTML = $like_box_iframe;
				} else {
					$renderedHTML = $like_box_xfbml;
				}
				$renderedHTML = $renderedHTML . "\n" . $like_button_xfbml;
				break;
		}
		echo $renderedHTML;

		# After the widget
		echo $after_widget;
		
		echo '</div>'; // gdl-likebox
	}
	
	/**
	* Saves the widgets settings.
	*
	*/
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['pageID'] = strip_tags(stripslashes($new_instance['pageID']));
		$instance['connection'] = strip_tags(stripslashes($new_instance['connection']));
		$instance['width'] = strip_tags(stripslashes($new_instance['width']));
		$instance['height'] = strip_tags(stripslashes($new_instance['height']));
		$instance['creditOn'] = strip_tags(stripslashes($new_instance['creditOn']));
		$instance['header'] = strip_tags(stripslashes($new_instance['header']));
		$instance['streams'] = strip_tags(stripslashes($new_instance['streams']));   //thanks to : Krzysztof Piech <chrisx29a@gmail.com>
		$instance['colorScheme'] = strip_tags(stripslashes($new_instance['colorScheme']));
		$instance['borderColor'] = strip_tags(stripslashes($new_instance['borderColor']));
		$instance['showFaces'] = strip_tags(stripslashes($new_instance['showFaces']));
		
		$instance['pluginDisplayType'] = strip_tags(stripslashes($new_instance['pluginDisplayType']));
		$instance['layoutMode'] = strip_tags(stripslashes($new_instance['layoutMode']));
		$instance['pageURL'] = strip_tags(stripslashes($new_instance['pageURL']));
		$instance['fblike_button_style'] = strip_tags(stripslashes($new_instance['fblike_button_style']));
		$instance['fblike_button_showFaces'] = strip_tags(stripslashes($new_instance['fblike_button_showFaces']));
		$instance['fblike_button_verb_to_display'] = strip_tags(stripslashes($new_instance['fblike_button_verb_to_display']));
		$instance['fblike_button_font'] = strip_tags(stripslashes($new_instance['fblike_button_font']));
		$instance['fblike_button_width'] = strip_tags(stripslashes($new_instance['fblike_button_width']));
		$instance['fblike_button_colorScheme'] = strip_tags(stripslashes($new_instance['fblike_button_colorScheme']));
		
		return $instance;
	}
	
	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'pageID'=>'119691288064264', 'height'=>'255', 'width'=>'237', 'connection'=>'10', 'streams'=>'yes', 'colorScheme'=>'light', 'showFaces'=>'yes', 'borderColor'=>'AAAAAA','header'=>'yes', 'creditOn'=>'yes', 'pluginDisplayType'=>'like_box', 'layoutMode'=>'iframe', 'pageURL'=>'http://www.facebook.com/pages/VivoCiticom-Joomla-Wordpress-Blogger-Drupal-DNN-Community/119691288064264', 'fblike_button_style'=>'standard', 'fblike_button_showFaces'=>'false','fblike_button_verb_to_display'=>'recommend','fblike_button_font'=>'arial', 'fblike_button_width'=>'237','fblike_button_colorScheme'=>'light') );
		
		
		$title = htmlspecialchars($instance['title']);		
		$pluginDisplayType = empty($instance['pluginDisplayType']) ? 'like_box' : $instance['pluginDisplayType'];
		$layoutMode = empty($instance['layoutMode']) ? 'iframe' : $instance['layoutMode'];
		$pageURL = empty($instance['pageURL']) ? 'http://www.facebook.com/pages/...' : $instance['pageURL'];
		$fblike_button_style = empty($instance['fblike_button_style']) ? 'standard' : $instance['fblike_button_style'];
		$fblike_button_showFaces = empty($instance['fblike_button_showFaces']) ? 'no' : $instance['fblike_button_showFaces'];
		$fblike_button_verb_to_display = empty($instance['fblike_button_verb_to_display']) ? 'recommend' : $instance['fblike_button_verb_to_display'];
		$fblike_button_font = empty($instance['fblike_button_font']) ? 'lucida grande' : $instance['fblike_button_font'];
		$fblike_button_width = empty($instance['fblike_button_width']) ? '237' : $instance['fblike_button_width'];
		$fblike_button_colorScheme = empty($instance['fblike_button_colorScheme']) ? 'light' : $instance['fblike_button_colorScheme'];		
		$pageID = empty($instance['pageID']) ? '' : $instance['pageID'];
		$connection = empty($instance['connection']) ? '10' : $instance['connection'];
		$width = empty($instance['width']) ? '237' : $instance['width'];
		$height = empty($instance['height']) ? '255' : $instance['height'];
		$streams = empty($instance['streams']) ? 'yes' : $instance['streams'];
		$colorScheme = empty($instance['colorScheme']) ? 'yes' : $instance['colorScheme'];
		$borderColor = empty($instance['borderColor']) ? 'AAAAAA' : $instance['borderColor'];
		$showFaces = empty($instance['showFaces']) ? 'yes' : $instance['showFaces'];
		$header = empty($instance['header']) ? 'yes' : $instance['header'];
		$creditOn = empty($instance['creditOn']) ? 'yes' : $instance['creditOn'];
		$sharePlugin = "http://vivociti.com";
		
		$pageID = htmlspecialchars($instance['pageID']);
		$connection = htmlspecialchars($instance['connection']);
		$streams = htmlspecialchars($instance['streams']);
		$colorScheme = htmlspecialchars($instance['colorScheme']);
		$borderColor = htmlspecialchars($instance['borderColor']);
		$showFaces = htmlspecialchars($instance['showFaces']);
		$header = htmlspecialchars($instance['header']);
		$creditOn = htmlspecialchars($instance['creditOn']);
		
		$pluginDisplayType = htmlspecialchars($instance['pluginDisplayType']);
		$layoutMode = htmlspecialchars($instance['layoutMode']);
		$pageURL = htmlspecialchars($instance['pageURL']);
		$fblike_button_style = htmlspecialchars($instance['fblike_button_style']);
		$fblike_button_showFaces = htmlspecialchars($instance['fblike_button_showFaces']);
		$fblike_button_verb_to_display = htmlspecialchars($instance['fblike_button_verb_to_display']);
		$fblike_button_font = htmlspecialchars($instance['fblike_button_font']);
		$fblike_button_width = htmlspecialchars($instance['fblike_button_width']);
		$fblike_button_colorScheme = htmlspecialchars($instance['fblike_button_colorScheme']);
		
		
				
		# Output the options
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
		# Fill Display Type Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('pluginDisplayType') . '">' . __('Display:') . ' <select name="' . $this->get_field_name('pluginDisplayType')  . '" id="' . $this->get_field_id('pluginDisplayType')  . '">"';
?>
		<option value="like_box" <?php if ($pluginDisplayType == 'like_box') echo 'selected="yes"'; ?> >Like Box</option>
		<option value="like_button" <?php if ($pluginDisplayType == 'like_button') echo 'selected="yes"'; ?> >Like Button</option>			 
		<option value="both" <?php if ($pluginDisplayType == 'both') echo 'selected="yes"'; ?> >Like Box &amp; Button</option>			 
<?php
		echo '</select></label>';
		# Fill Layout Mode Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('layoutMode') . '">' . __('Render Mode:') . ' <select name="' . $this->get_field_name('layoutMode')  . '" id="' . $this->get_field_id('layoutMode')  . '">"';
?>
		<option value="iframe" <?php if ($layoutMode == 'iframe') echo 'selected="yes"'; ?> >IFRAME</option>
		<option value="xfbml" <?php if ($layoutMode == 'xfbml') echo 'selected="yes"'; ?> >XFBML</option>		
<?php
		echo '</select></label>';
		echo '<hr/><p style="text-align:left;"><b>Like Box Setting</b></p>';
		echo '<p style="text-align:left;"><i>Fill Page ID Or Page URL below:</i></p>';
		# Fill Page ID
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('pageID') . '">' . __('Facebook Page ID:') . ' <input style="width: 150px;" id="' . $this->get_field_id('pageID') . '" name="' . $this->get_field_name('pageID') . '" type="text" value="' . $pageID . '" /></label></p>';
		# Fill Page URL
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('pageURL') . '">' . __('Facebook Page URL:') . ' <input style="width: 150px;" id="' . $this->get_field_id('pageURL') . '" name="' . $this->get_field_name('pageURL') . '" type="text" value="' . $pageURL . '" /></label></p>';
		
		# Connection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('connection') . '">' . __('Connections:') . ' <input style="width: 100px;" id="' . $this->get_field_id('connection') . '" name="' . $this->get_field_name('connection') . '" type="text" value="' . $connection . '" /></label></p>';
		# Width
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('width') . '">' . __('Width:') . ' <input style="width: 100px;" id="' . $this->get_field_id('width') . '" name="' . $this->get_field_name('width') . '" type="text" value="' . $width . '" /></label></p>';
		# Height
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('height') . '">' . __('Height:') . ' <input style="width: 100px;" id="' . $this->get_field_id('height') . '" name="' . $this->get_field_name('height') . '" type="text" value="' . $height . '" /></label></p>';		
		# Fill Streams Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('streams') . '">' . __('Streams:') . ' <select name="' . $this->get_field_name('streams')  . '" id="' . $this->get_field_id('streams')  . '">"';
?>
		<option value="yes" <?php if ($streams == 'yes') echo 'selected="yes"'; ?> >Yes</option>
		<option value="no" <?php if ($streams == 'no') echo 'selected="yes"'; ?> >No</option>			 
<?php
		echo '</select></label>';
# Fill Color Scheme Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('colorScheme') . '">' . __('Color Scheme:') . ' <select name="' . $this->get_field_name('colorScheme')  . '" id="' . $this->get_field_id('colorScheme')  . '">"';
?>
		<option value="light" <?php if ($colorScheme == 'light') echo 'selected="yes"'; ?> >Light</option>
		<option value="dark" <?php if ($colorScheme == 'dark') echo 'selected="yes"'; ?> >Dark</option>			 
<?php
		echo '</select></label>';
		# Border Color
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('borderColor') . '">' . __('Border Color:') . ' <input style="width: 100px;" id="' . $this->get_field_id('borderColor') . '" name="' . $this->get_field_name('borderColor') . '" type="text" value="' . $borderColor . '" /></label></p>';
# Fill Show Faces Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('showFaces') . '">' . __('Show Faces:') . ' <select name="' . $this->get_field_name('showFaces')  . '" id="' . $this->get_field_id('showFaces')  . '">"';
?>
		<option value="yes" <?php if ($showFaces == 'yes') echo 'selected="yes"'; ?> >Yes</option>
		<option value="no" <?php if ($showFaces == 'no') echo 'selected="yes"'; ?> >No</option>			 
<?php
		echo '</select></label>';
	# Fill header Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('header') . '">' . __('Header:') . ' <select name="' . $this->get_field_name('header')  . '" id="' . $this->get_field_id('header')  . '">"';
?>
		<option value="yes" <?php if ($header == 'yes') echo 'selected="yes"'; ?> >Yes</option>
		<option value="no" <?php if ($header == 'no') echo 'selected="yes"'; ?> >No</option>			 
<?php
		echo '</select></label>';	
		echo '<hr/><p style="text-align:left;"><b>Like Button Setting</b></p>';
		# Fill Like Button Style Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('fblike_button_style') . '">' . __('Button Style:') . ' <select name="' . $this->get_field_name('fblike_button_style')  . '" id="' . $this->get_field_id('fblike_button_style')  . '">"';
?>
		<option value="standard" <?php if ($fblike_button_style == 'standard') echo 'selected="yes"'; ?> >standard</option>
		<option value="button_count" <?php if ($fblike_button_style == 'button_count') echo 'selected="yes"'; ?> >button_count</option>		
		<option value="box_count" <?php if ($fblike_button_style == 'box_count') echo 'selected="yes"'; ?> >box_count</option>		
<?php
		echo '</select></label>';
		# Fill Verb To Display Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('fblike_button_verb_to_display') . '">' . __('Verb To Display:') . ' <select name="' . $this->get_field_name('fblike_button_verb_to_display')  . '" id="' . $this->get_field_id('fblike_button_verb_to_display')  . '">"';
?>
		<option value="like" <?php if ($fblike_button_verb_to_display == 'like') echo 'selected="yes"'; ?> >like</option>
		<option value="recommend" <?php if ($fblike_button_verb_to_display == 'recommend') echo 'selected="yes"'; ?> >recommend</option>				
<?php
		echo '</select></label>';
		# Like Button Width
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('fblike_button_width') . '">' . __('Width:') . ' <input style="width: 100px;" id="' . $this->get_field_id('fblike_button_width') . '" name="' . $this->get_field_name('fblike_button_width') . '" type="text" value="' . $fblike_button_width . '" /></label></p>';
		# Fill Like Button Color Scheme Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('fblike_button_colorScheme') . '">' . __('Color Scheme:') . ' <select name="' . $this->get_field_name('fblike_button_colorScheme')  . '" id="' . $this->get_field_id('fblike_button_colorScheme')  . '">"';
?>
		<option value="light" <?php if ($fblike_button_colorScheme == 'light') echo 'selected="yes"'; ?> >Light</option>
		<option value="dark" <?php if ($fblike_button_colorScheme == 'dark') echo 'selected="yes"'; ?> >Dark</option>			 
<?php
		echo '</select></label>';
# Fill Like Button Show Faces Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('fblike_button_showFaces') . '">' . __('Show Faces:') . ' <select name="' . $this->get_field_name('fblike_button_showFaces')  . '" id="' . $this->get_field_id('fblike_button_showFaces')  . '">"';
?>
		<option value="yes" <?php if ($fblike_button_showFaces == 'yes') echo 'selected="yes"'; ?> >Yes</option>
		<option value="no" <?php if ($fblike_button_showFaces == 'no') echo 'selected="yes"'; ?> >No</option>			 
<?php
		echo '</select></label>';
		# Fill Like Button Font Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('fblike_button_font') . '">' . __('Font:') . ' <select name="' . $this->get_field_name('fblike_button_font')  . '" id="' . $this->get_field_id('fblike_button_font')  . '">"';
?>
		<option value="arial" <?php if ($fblike_button_font == 'arial') echo 'selected="yes"'; ?> >arial</option>
		<option value="lucida grande" <?php if ($fblike_button_font == 'lucida grande') echo 'selected="yes"'; ?>>lucida grande</option>	
		<option value="segoe ui" <?php if ($fblike_button_font == 'segoe ui') echo 'selected="yes"'; ?> >segoe ui</option>
		<option value="tahoma" <?php if ($fblike_button_font == 'tahoma') echo 'selected="yes"'; ?> >tahoma</option>	
		<option value="trebuchet ms" <?php if ($fblike_button_font == 'trebuchet ms') echo 'selected="yes"'; ?> >trebuchet ms</option>
		<option value="verdana" <?php if ($fblike_button_font == 'verdana') echo 'selected="yes"'; ?> >verdana</option>	
<?php
		echo '</select></label>';
		
		
		echo '<p style="text-align:left;"><a title="Join Us @Facebook" href="http://www.facebook.com/pages/VivoCiticom-Joomla-Wordpress-Blogger-Drupal-DNN-Community/119691288064264" target="_blank"><img src="http://vivociti.com/images/stories/facebook_16x16.png" border="0"></a>&nbsp;<a href="https://plus.google.com/100723813888588053339?prsrc=3" style="text-decoration:none;"><img src="https://ssl.gstatic.com/images/icons/gplus-16.png" alt="" style="border:0;width:16px;height:16px;"/></a>&nbsp;<a title="Follow Us @Twitter" href="http://twitter.com/vivociti" target="_blank"><img src="http://vivociti.com/images/stories/twitter_16x16.png" border="0"></a>&nbsp;<a title="Follow Us @Digg" href="http://digg.com/vivoc" target="_blank"><img src="http://vivociti.com/images/stories/digg_16x16.png" border="0"></a>&nbsp;<a title="Follow Us @StumbleUpon" href="http://www.stumbleupon.com/stumbler/vivociti/" target="_blank"><img src="http://vivociti.com/images/stories/stumbleupon_16x16.png" border="0"></a>&nbsp;<a title="Follow Our RSS" href="http://feeds2.feedburner.com/vivociti" target="_blank"><img src="http://vivociti.com/images/stories/feed_16x16.png" border="0"></a></p>';
		echo '<p/>';
		echo '<hr/>';
		# Fill Author Credit : option to select YEs or No 
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('creditOn') . '">' . __('Support Our Development by contributing money via PayPal at http://bit.ly/9Njzpo - No (Credit Author by small link)') . ' <select name="' . $this->get_field_name('creditOn')  . '" id="' . $this->get_field_id('creditOn')  . '">"';
?>
		<option value="no" <?php if ($creditOn == 'no') echo 'selected="yes"'; ?> >Yes</option>
		<option value="yes" <?php if ($creditOn == 'yes') echo 'selected="yes"'; ?> >No</option>			 
<?php
		echo '</select></label>';
		echo '<p style="text-align:left;">Our other Wordpress Widget you may like is:<br/>
		<ul>
		  <li><a title="Google +1 Button" href="http://wordpress.org/extend/plugins/google-1-recommend-button-for-wordpress/" target="_blank">Google +1 Button</a></li>
		  <li><a title="Twitter QR Code for Wordpress" href="http://wordpress.org/extend/plugins/twitter-qr-code-signatures/" target="_blank">Twitter QR Code Widget</a></li>
		  <li><a title="Twitter Signature for Wordpress" href="http://wordpress.org/extend/plugins/twitter-signature/" target="_blank">Twitter Signature for Wordpress</a></li>
		</ul></p>';
		
	
	} //end of form

}// END class
	
	/**
	* Register  widget.
	*
	* Calls 'widgets_init' action after widget has been registered.
	*/
	function FacebookLikeBoxInit() {
	register_widget('FacebookLikeBoxWidget');
	}	
	add_action('widgets_init', 'FacebookLikeBoxInit');
?>