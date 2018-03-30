<?php

	function widget_sakura_Recent($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_sakura_Recent');
		$curtag = $options['curtag'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget

      if (!$title) $title = "Recent posts";

		$show = $options['show'];  // # of Updates to show
		$upd = $options['upd'];  // # of Updates to show

        // Output
		echo $before_widget ;

		// start
              
      ?>
      
  <ul class="widget-cat_sw">
    <li class="act"><a href="#" rel="posts">Recent Posts</a></li>
    <li><a href="#" rel="comments">Recent Comments</a></li>
  </ul>
  
  <div id="w_posts">
  <ul class="widget-show_cat2 widget-popular">
    <?php
    $posts_sl = get_posts('numberposts='.$show.'&order=DESC&orderby=date&category='.EX_CATS_SM);
    $c=1;
    foreach($posts_sl as $post_item) {
      //setup_postdata($post);
      //print_r($post);

      $user_info = get_userdata($post_item->post_author);

      echo '<li'.($c++==count($posts_sl) ? ' class="last"' : '').'>
      <a href="'.get_permalink($post_item->ID).'">'.$post_item->post_title.'</a>
      <span>by <a href="#">'.$user_info->user_login.'</a> on '.get_the_time(get_option('date_format'), $post_item->ID).' in ';
      
      ob_start();
      the_category(', ', 'single', $post_item->ID);
      $d=ob_get_clean();
      //$d=preg_replace('/<a[^>]+>([^<]+)<\/a>/', '\\1', $d);
      echo $d;
      
      echo ' <br />
      <a href="'.get_permalink($post_item->ID).'#comments">';
      echo ($post_item->comment_count ? $post_item->comment_count : 'no')." comment".($post_item->comment_count>1 || $post_item->comment_count==0 ? "s" : "");
      echo '</a></span>
    </li>';

    } ?>
  </ul>
  </div>
  
  <div style="display: none;" id="w_comments">
  <ul class="widget-show_cat2 widget-comments">
   <?php
      if (!function_exists('get_recent_comments')) {
         include_once dirname(__FILE__).'/widgets-function-comments.php';
      }
      get_recent_comments();
   ?>
  </ul>
  </div>
      
      <?php

		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_sakura_Recent_control() {

		// Get options
		$options = get_option('widget_sakura_Recent');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('curtag'=>'', 'title'=>'Popular', 'show'=>'5', 'upd' => '60');

        // form posted?
		if ( $_POST['sakura_Twitter7-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['curtag'] = strip_tags(stripslashes($_POST['sakura_Twitter-curtag']));
			$options['title'] = strip_tags(stripslashes($_POST['sakura_Twitter2-title']));
			$options['show'] = strip_tags(stripslashes($_POST['sakura_Twitter7-show']));
			$options['upd'] = strip_tags(stripslashes($_POST['sakura_Twitter-upd']));
			update_option('widget_sakura_Recent', $options);
		}

		// Get options for form fields to show
		$curtag = htmlspecialchars($options['curtag'], ENT_QUOTES);
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$show = htmlspecialchars($options['show'], ENT_QUOTES);
		$upd = htmlspecialchars($options['upd'], ENT_QUOTES);


      include_once dirname(__FILE__).'/widgets-function-comments.php';

      kjgrc_invalidate_cache();

      $kjgrc_options = get_option("kjgrc_options");
      $kjgrc_options['grc_format']="<li><a class=\"author\" href=\"%comment_link\" title=\"%post_title, %post_date\">%comment_author</a>: <a href=\"%comment_link\" title=\"%post_title, %post_date\" class=\"content\">%comment_excerpt</a> on <a href=\"%post_link\" class=\"title\">%post_title</a></li>";
      $kjgrc_options['grc_max_comments']=$options['show'];
      update_option('kjgrc_options',$kjgrc_options);

		//kjgrc_invalidate_cache();

      if (!$upd) $upd=60;

		// The form fields
		echo '<p>
				<label for="Twitter-title">' . __('Number of items to show:') . '<br />
				<input style="width: 100px;" id="Twitter-title" name="sakura_Twitter7-show" type="text" value="'.$show.'" />
				</label></p>';
		echo '<input type="hidden" id="sakura_Twitter-submit" name="sakura_Twitter7-submit" value="1" />';
	}


	// Register widget for use
	wp_register_sidebar_widget(9002, 'Sakura Theme Recent Posts & Comments', 'widget_sakura_Recent');

	// Register settings for use, 300x200 pixel form
	wp_register_widget_control(9002, 'Sakura Theme Recent Posts & Comments', 'widget_sakura_Recent_control', 250, 200);  
   
?>
