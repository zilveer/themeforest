<?php

	function widget_sakura_Cats($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_sakura_Cats');
		$curtag = $options['curtag'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$show = $options['show'];  // # of Updates to show
		$upd = $options['upd'];  // # of Updates to show

        // Output
		echo $before_widget ;

      if (!$title) $title="Categories";

		// start
		
		echo $before_title . $title . $after_title;
              
      ?>
  
  <ul class="categories">
   <?php
      ob_start();
      wp_list_categories('orderby=name');
      $ret=ob_get_clean();
      preg_match_all('/(<a[^>]+>[^<]+<\/a>)/', $ret, $m);
      $c=1;
      foreach ($m[1] as $s)
      {
         echo '<li'.($c++ < 3 ? ' class="first"' : '').'>'.$s.'</li>'."\n";
      }
   ?>
  </ul>
      
      <?php

		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_sakura_Cats_control() {

		// Get options
		$options = get_option('widget_sakura_Cats');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('title'=>'Categories');

        // form posted?
		if ( $_POST['sakura_Twitter20-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['title'] = strip_tags(stripslashes($_POST['sakura_Twitter20-title']));
			update_option('widget_sakura_Cats', $options);
		}

		// Get options for form fields to show
		$title = htmlspecialchars($options['title'], ENT_QUOTES);

      if (!$upd) $upd=60;

		// The form fields
		echo '<p>
				<label for="Twitter-title">' . __('Title:') . '<br />
				<input style="width: 100px;" id="Twitter-title" name="sakura_Twitter20-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<input type="hidden" id="sakura_Twitter-submit" name="sakura_Twitter20-submit" value="1" />';
	}


	// Register widget for use
	wp_register_sidebar_widget(9011, ('Sakura Theme Categories'), 'widget_sakura_Cats');
   wp_register_widget_control(9011, "Sakura Theme Categories", "widget_sakura_Cats_control");

	// Register settings for use, 300x200 pixel for
   
?>
