<?php

	function widget_sakura_Search($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_sakura_Search');
		$curtag = $options['curtag'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$show = $options['show'];  // # of Updates to show
		$upd = $options['upd'];  // # of Updates to show

        // Output
		echo $before_widget ;

      if (!$title) $title="Search";

		// start
              
      ?>
     <div class="header"><?php echo $title; ?>:</div>
     <form method="get" class="c_search" action="<?php echo home_url('/'); ?>" >
       <input name="s" type="text" value="<?php the_search_query(); ?>" />
       <a href="#" onclick="$('.c_search').submit(); return false;"></a>
     </form>
      
      <?php

		// echo widget closing tag
		echo $after_widget;
	}

	function widget_sakura_Search_control() {

		// Get options
		$options = get_option('widget_sakura_Search');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('title'=>'Search');

        // form posted?
		if ( $_POST['sakura_Twitter2000-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['title'] = strip_tags(stripslashes($_POST['sakura_Twitter2000-title']));
			update_option('widget_sakura_Search', $options);
		}

		// Get options for form fields to show
		$title = htmlspecialchars($options['title'], ENT_QUOTES);

      if (!$upd) $upd=60;

		// The form fields
		echo '<p>
				<label for="Twitter-title">' . __('Title:') . '<br />
				<input style="width: 100px;" id="Twitter-title" name="sakura_Twitter2000-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<input type="hidden" id="sakura_Twitter-submit" name="sakura_Twitter2000-submit" value="1" />';
	}

	// Register widget for use
	wp_register_sidebar_widget(9010, ('Sakura Theme Search'), 'widget_sakura_Search');

   wp_register_widget_control(9010, "Sakura Theme Search", "widget_sakura_Search_control");

	// Register settings for use, 300x200 pixel form
	//register_widget_control(array('sakura Categories, Archives, Tags', 'widgets'), 'widget_sakura_Search_control', 250, 200);  
   
?>
