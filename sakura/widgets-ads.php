<?php

	function widget_sakura_Ads($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_sakura_Ads');
		$curtag = $options['curtag'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$show = $options['show'];  // # of Updates to show
		$upd = $options['upd'];  // # of Updates to show

        // Output
		echo $before_widget ;

		echo ''
              .$before_title.$title.$after_title;

      echo $show;

		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_sakura_Ads_control() {

		// Get options
		
		$s=get_option('siteurl').'/wp-content/themes/sakura/';
		
		//echo $s;
		
		$options = get_option('widget_sakura_Ads');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('curtag'=>'', 'title'=>'Sponsors', 'show'=>'<ul class="widget-ad125">
    <li><a href="#"><img src="'.$s.'images/widgets/ad125/ad125_01.jpg" width="125" height="125" alt="" /></a></li>
    <li class="no_2"><a href="#"><img src="'.$s.'images/widgets/ad125/ad125_02.jpg" width="125" height="125" alt="" /></a></li>
    <li><a href="#"><img src="'.$s.'images/widgets/ad125/ad125_03.jpg" width="125" height="125" alt="" /></a></li>
    <li class="no_2"><a href="#"><img src="'.$s.'images/widgets/ad125/ad125_04.jpg" width="125" height="125" alt="" /></a></li>
  </ul>', 'upd' => '60');

        // form posted?
		if ( $_POST['sakura_Twitter4-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['curtag'] = strip_tags(stripslashes($_POST['sakura_Twitter-curtag']));
			$options['title'] = strip_tags(stripslashes($_POST['sakura_Twitter4-title']));
			$options['show'] = stripslashes($_POST['sakura_Twitter4-show']);
			$options['upd'] = strip_tags(stripslashes($_POST['sakura_Twitter-upd']));
			update_option('widget_sakura_Ads', $options);
		}

		// Get options for form fields to show
		$curtag = htmlspecialchars($options['curtag'], ENT_QUOTES);
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$show = htmlspecialchars($options['show'], ENT_QUOTES);
		$upd = htmlspecialchars($options['upd'], ENT_QUOTES);

      if (!$upd) $upd=60;

		// The form fields
		echo '<p>
				<label for="Twitter-title">' . __('Title:') . '<br />
				<input style="width: 100px;" id="Twitter-title" name="sakura_Twitter4-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<p>
				<label for="Twitter-show">' . __('Code:') . '<br />
				<textarea style="width: 200px;" id="Twitter-show" name="sakura_Twitter4-show" rows="7">'.$show.'</textarea>
				</label></p>';
		echo '<input type="hidden" id="sakura_Twitter-submit" name="sakura_Twitter4-submit" value="1" />';
	}


	// Register widget for use
	wp_register_sidebar_widget(9005, ('Sakura Theme Ads'), 'widget_sakura_Ads');

	// Register settings for use, 300x200 pixel form
	wp_register_widget_control(9005, ('Sakura Theme Ads'), 'widget_sakura_Ads_control', 250, 200);  
   
?>
