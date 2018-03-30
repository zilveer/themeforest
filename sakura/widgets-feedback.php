<?php

	function widget_sakura_Feedback($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_sakura_Feedback');
		$curtag = $options['curtag'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$text = $options['text'];  // # of Updates to show
		$upd = $options['upd'];  // # of Updates to show

        // Output
		echo $before_widget ;
		
		echo ''
              .$before_title.$title.$after_title;

		// start
              
      ?>
      
        <p><?php echo $text; ?></p> 
      <form class="uniform get_in_touch" id="f_f" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>"> 
<input name="send_f" type="hidden" id="send_f" value="send_f">
<input type="hidden" name="send_contacts" value="1">
        <div class="i_h"><div class="l"><input id="your_name" name="f_name" type="text" placeholder="Your name" value="" class="validate[required]" /></div></div> 
        <div class="i_h"><div class="r"><input id="email" name="f_email" type="text" placeholder="E-mail" value="" class="validate[required,custom[email]" /></div></div> 
        <div class="t_h"><textarea id="message" name="f_comment" placeholder="Message" class="validate[required]"></textarea></div> 
        <a href="#" class="go_submit" title="Submit"></a> 
        <a href="#" class="do_clear">Clear</a> 
      </form> 

            
      <?php

		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_sakura_Feedback_control() {

		// Get options
		$options = get_option('widget_sakura_Feedback');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('curtag'=>'', 'title'=>'Get in touch!', 'text' => '');

        // form posted?
		if ( $_POST['sakura_Twitter70-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['title'] = strip_tags(stripslashes($_POST['sakura_Twitter40-title']));
			$options['text'] = strip_tags(stripslashes($_POST['sakura_Twitter40-show']));
			update_option('widget_sakura_Feedback', $options);
		}

		// Get options for form fields to show
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$text = htmlspecialchars($options['text'], ENT_QUOTES);

		// The form fields
		echo '<p>
				<label for="Twitter-title">' . __('Title:') . '<br />
				<input style="width: 100px;" id="Twitter-title" name="sakura_Twitter40-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<p>
				<label for="Twitter-show">' . __('Text:') . '<br />
				<textarea style="width: 200px;" id="Twitter-show" name="sakura_Twitter40-show" rows="7">'.$text.'</textarea>
				</label></p>';
		echo '<input type="hidden" id="sakura_Twitter0-submit" name="sakura_Twitter70-submit" value="1" />';
	}


	// Register widget for use
	wp_register_sidebar_widget(9007, ('Sakura Theme Feedback'), 'widget_sakura_Feedback');

	// Register settings for use, 300x200 pixel form
	wp_register_widget_control(9007, ('Sakura Theme Feedback'), 'widget_sakura_Feedback_control', 250, 200);  
   
?>
