<?php

	function widget_sakura_PostTypes($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_sakura_Posts');
		$curtag = $options['curtag'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$text = $options['text'];  // # of Updates to show
		$upd = $options['upd'];  // # of Updates to show

        // Output
		echo $before_widget ;
		
		echo ''
              .$before_title.$title.$after_title;

		// start
		
		echo '<ul class="categories type">';
		
		$types = array(
		   "article",
		   "image",
		   "link",
		   "audio",
		   "video",
		   "quote"
		);
		
		$c=0;
		foreach ($types as $type)
		{
		   $_type = $type;
		   if ($_type == "article") 
		      $_type = "text";

		 $tumblog_items = array(	'article'	=> get_option('woo_articles_term_id'),
										'image' 	=> get_option('woo_images_term_id'),
										'audio' 	=> get_option('woo_audio_term_id'),
										'video' 	=> get_option('woo_video_term_id'),
										'quote'	=> get_option('woo_quotes_term_id'),
										'link' 	=> get_option('woo_links_term_id')
									);
		
    	$category_id = $tumblog_items[$type];
    	
    	$term = &get_term($category_id, 'tumblog');
    	// Get the URL of Articles Tumblog Taxonomy
    	$href = $category_link = get_term_link( $term, 'tumblog' );
    
		 
		   echo '
            <li class="'.($c++ < 2 ? "first " : "").$_type.'"><a href="'.$href.'">'.ucfirst($type).'</a></li>
		   ';
		}
		
		echo '</ul>';
              

		// echo widget closing tag
		echo $after_widget;
	}

	function widget_sakura_Posts_control() {

		// Get options
		$options = get_option('widget_sakura_Posts');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('title'=>'Post Types');

        // form posted?
		if ( $_POST['sakura_Twitter200-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['title'] = strip_tags(stripslashes($_POST['sakura_Twitter200-title']));
			update_option('widget_sakura_Posts', $options);
		}

		// Get options for form fields to show
		$title = htmlspecialchars($options['title'], ENT_QUOTES);

      if (!$upd) $upd=60;

		// The form fields
		echo '<p>
				<label for="Twitter-title">' . __('Title:') . '<br />
				<input style="width: 100px;" id="Twitter-title" name="sakura_Twitter200-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<input type="hidden" id="sakura_Twitter-submit" name="sakura_Twitter200-submit" value="1" />';
	}

	// Register widget for use
	wp_register_sidebar_widget(9006, ('Sakura Theme PostTypes'), 'widget_sakura_PostTypes');

   wp_register_widget_control(9006, "Sakura Theme PostTypes", "widget_sakura_Posts_control");
   
?>
