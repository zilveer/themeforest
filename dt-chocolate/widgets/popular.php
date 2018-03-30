<?php

	function widget_sakura_Popular($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_sakura_Popular');
		$curtag = $options['curtag'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$show = $options['show'];  // # of Updates to show
		$upd = $options['upd'];  // # of Updates to show

        // Output
		echo $before_widget ;

		// start
		echo ''
              .$before_title.$title.$after_title;
		echo '';
		     
$_tag=$options['curtag'];
$args = array(
   'category' => $_tag,
   'numberposts' => $show,
   'orderby' => 'date',
   'order' => 'DESC'
);
$posts_sl = get_posts($args);

$c=1;

foreach ($posts_sl as $post_item)
{

      $user_info = get_userdata($post_item->post_author);

      echo '<div class="post'.($c++==1 ? ' first' : '').'">
      <a href="'.get_permalink($post_item->ID).'">'.$post_item->post_title.'</a>
      ';
/*      
      ob_start();
      the_category(', ', 'single', $post_item->ID);
      $d=ob_get_clean();
      //$d=preg_replace('/<a[^>]+>([^<]+)<\/a>/', '\\1', $d);
      //echo $d;
*/      
      echo '<div class="goto_post">
      
       <a href="'.get_permalink($post_item->ID).'" class="ico_link date">'.get_the_time(get_option('date_format'), $post_item->ID).'</a>
       <a href="'.get_permalink($post_item->ID).'#comments" class="ico_link comments">';
       
       echo ($post_item->comment_count ? $post_item->comment_count : 'no')." comment".($post_item->comment_count>1 || $post_item->comment_count==0 ? "s" : "");
       
       echo '</a>
      
      ';
      
      echo '</div>
    </div>';
}


      echo '';

		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_sakura_Popular_control() {

		// Get options
		$options = get_option('widget_sakura_Popular');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('curtag'=>'', 'title'=>'Popular', 'show'=>'5', 'upd' => '60');

        // form posted?
		if ( isset($_POST['sakura_Twitter3-submit']) &&  $_POST['sakura_Twitter3-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['curtag'] = strip_tags(stripslashes($_POST['sakura_Twitter3-curtag']));
			$options['title'] = strip_tags(stripslashes($_POST['sakura_Twitter3-title']));
			$options['show'] = strip_tags(stripslashes($_POST['sakura_Twitter3-show']));
			$options['upd'] = strip_tags(stripslashes($_POST['sakura_Twitter3-upd']));
			update_option('widget_sakura_Popular', $options);
		}

		// Get options for form fields to show
		$curtag = htmlspecialchars($options['curtag'], ENT_QUOTES);
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$show = htmlspecialchars($options['show'], ENT_QUOTES);
		$upd = htmlspecialchars($options['upd'], ENT_QUOTES);

      if (!$upd) $upd=60;

		// The form fields
		echo '<p>
				<label for="Twitter-title">' . __('Title:', LANGUAGE_ZONE) . '<br />
				<input style="width: 100px;" id="Twitter-title" name="sakura_Twitter3-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<p>
				<label for="Twitter-account">' . __('Category:', LANGUAGE_ZONE) . '<br />
				<select style="width: 100px;" id="Twitter-curtag" name="sakura_Twitter3-curtag">
				   ';
				   foreach (get_categories() as $_tag)
				   {
				      echo '<option value="'.$_tag->cat_ID.'"'.($_tag->cat_ID==$curtag ? ' selected="selected"' : '').'>'.$_tag->name.'</option>';
				   }
				   echo '
				</select>
				</label></p>';
		echo '<p>
				<label for="Twitter-show">' . __('Show:', LANGUAGE_ZONE) . '<br />
				<input style="width: 100px;" id="Twitter-show" name="sakura_Twitter3-show" type="text" value="'.$show.'" />
				</label></p>';
		echo '<input type="hidden" id="sakura_Twitter-submit" name="sakura_Twitter3-submit" value="1" />';
	}
	
   wp_register_sidebar_widget(9006, (THEME_TITLE.' Popular Posts'), 'widget_sakura_Popular');
   wp_register_widget_control(9006, THEME_TITLE.' Popular Posts', "widget_sakura_Popular_control");
	
	//echo "?";
   
?>
