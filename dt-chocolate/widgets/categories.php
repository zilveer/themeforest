<?php

	function widget_sakura_Cats($args) {

		extract($args);

		// These are our own options
		$options = get_option('widget_sakura_Cats');
//		$curtag = $options['curtag'];  // Your Twitter account name
		$title = isset($options['title'])?$options['title']:"Categories";  // Title in sidebar for widget
//		$show = $options['show'];  // # of Updates to show
//		$upd = $options['upd'];  // # of Updates to show
		$cols = isset($options['cols'])?$options['cols']:1;  // # of Updates to show
//		if (!$cols) $cols = "1";

        // Output
		echo $before_widget ;

		// start
		
		echo $before_title . $title . $after_title;
              
      ?>
  
  <ul class="categories<?php if ($cols == '2') echo ' col_2'; ?>">
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
			$options = array('curtag'=>'', 'title'=>'Categories', 'show'=>'5', 'upd' => '60', 'cols' => '1');

        // form posted?
		if ( isset($_POST['sakura_Twitter2-submit']) && $_POST['sakura_Twitter2-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['curtag'] = strip_tags(stripslashes($_POST['sakura_Twitter-curtag']));
			$options['title'] = strip_tags(stripslashes($_POST['sakura_Twitter2-title']));
			$options['cols'] = strip_tags(stripslashes($_POST['sakura_Twitter322-title']));
			$options['show'] = strip_tags(stripslashes($_POST['sakura_Twitter-show']));
			$options['upd'] = strip_tags(stripslashes($_POST['sakura_Twitter-upd']));
			update_option('widget_sakura_Cats', $options);
		}

		// Get options for form fields to show
		$curtag = htmlspecialchars($options['curtag'], ENT_QUOTES);
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$show = htmlspecialchars($options['show'], ENT_QUOTES);
		$upd = htmlspecialchars($options['upd'], ENT_QUOTES);
		$cols = htmlspecialchars($options['cols'], ENT_QUOTES);

      if (!$upd) $upd=60;

		// The form fields
		if (1)
		   echo '<p>
				   <label for="Twitter-title">' . __('Title:', LANGUAGE_ZONE) . '<br />
				   <input style="width: 100px;" id="Twitter-title" name="sakura_Twitter2-title" type="text" value="'.$title.'" />
				   </label></p>';
		echo '<p>
				<label for="Twitter-title222">' . __('Columns:', LANGUAGE_ZONE) . '<br />
				<select style="width: 100px;" id="Twitter-title222" name="sakura_Twitter322-title">
				   <option value="1"'.($cols == "1" ? ' selected="selected"': '').'>1</option>
				   <option value="2"'.($cols == "2" ? ' selected="selected"': '').'>2</option>
				</select>
				</label></p>';
		echo '<input type="hidden" id="sakura_Twitter-submit" name="sakura_Twitter2-submit" value="1" />';
	}	
	
   wp_register_sidebar_widget(9001, (THEME_TITLE.' Categories'), 'widget_sakura_Cats');
   wp_register_widget_control(9001, (THEME_TITLE.' Categories'), 'widget_sakura_Cats_control');
   
?>
