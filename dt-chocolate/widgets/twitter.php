<?php

   function ago($time)
   {
      $periods = array(__("second", LANGUAGE_ZONE), __("minute", LANGUAGE_ZONE), __("hour", LANGUAGE_ZONE), __("day", LANGUAGE_ZONE), __("week", LANGUAGE_ZONE), __("month", LANGUAGE_ZONE), __("year", LANGUAGE_ZONE), __("decade", LANGUAGE_ZONE));
      $lengths = array("60","60","24","7","4.35","12","10");

      $now = time();

          $difference     = $now - $time;
          $tense         = "ago";

      for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
          $difference /= $lengths[$j];
      }

      $difference = round($difference);

      if($difference != 1) {
          $periods[$j].= "s";
      }

      return "$difference $periods[$j] ago ";
   }

	function widget_sakura_Twidget($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_sakura_Twidget');
		if ( !isset($options['account']) )
		{
		    $options = array(
		    'account' => '',
		    'title' => '',
		    'show' => '',
		    'upd' => '',
		    'last_upd' => '',
		    );
		}
		$account = $options['account'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$show = $options['show'];  // # of Updates to show
		$upd = $options['upd'];  // # of Updates to show
		
		if (!$account)
		   $account = "Reuters_Science";
		if (!$show)
		   $show = 4;
		if (!$title)
		   $title = __('Latest Tweets', LANGUAGE_ZONE);

        // Output
		echo $before_widget ;

		// start
		echo ''
              .$before_title.$title.$after_title;
		echo '';
		      
		$twitter_timeline='http://api.twitter.com/1/statuses/user_timeline.json?screen_name='.$account.'&trim_user=1&count='.$show.'';
		
		$cache=TMP_DIR.'twitter.cache';
		
		//echo $cache;
		
      if (!file_exists($cache) || time()-$options["last_upd"]>$upd)
      {
		   $options["last_upd"]=time();
		   $data=@file_get_contents($twitter_timeline);		   
		   $data=preg_replace('/(^\(|\);$)/', '', $data);
		   $file=@fopen($cache,"w+");
		   if ($file)
		   {
		      @fwrite($file, $data);
		      @fclose($file);
		   }
		   //echo $data;
      }
      else
      {
         //$data=fi le_get_contents($cache);
         $fh = @fopen($cache, 'r'); 
         $data = @fread($fh, @filesize($cache)); 
         @fclose($fh); 
      }
      
      update_option('widget_sakura_Twidget', $options);
      
	   $data=json_decode($data, true);

		//print_r($data);

		$c=0;

		if (is_array($data)) foreach ($data as $r)
		{

			$t = empty($r['text']) ? '' : $r['text'];
			$t = preg_replace('/(http:\/\/[a-z0-9\.A-Z\/\-\_]+)/', '<a href="\\1" target="_blank">\\1</a>', $t);
			$t = preg_replace('/\@([^ ]{3,})/', '@<a href="http://twitter.com/\\1">\\1</a>', $t);

			$w = empty($r['created_at']) ? '' : $r['created_at'];
			$w = preg_replace('/\+(\d+) /', '', $w);
			$w = strtotime($w);
			//$w=time()-$w;
			$w = ago($w);
			$c++;
			echo '<div class="post'.($c == 1 ? ' first' : '').'">'.$t.'<div class="goto_post"><span class="ico_link date">'.$w.'</span></div></div>';
		}

      echo '';
      
      //echo '<a href="http://twitter.com/'.$account.'" class="twitter-follow_me">follow me</a>';

		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_sakura_Twidget_control() {

		// Get options
		$options = get_option('widget_sakura_Twidget');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('account'=>'seanys', 'title'=>'Twitter Updates', 'show'=>'5', 'upd' => '60');

        // form posted?
		if ( isset($_POST['sakura_Twitter-submit']) && $_POST['sakura_Twitter-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['account'] = strip_tags(stripslashes($_POST['sakura_Twitter-account']));
			$options['title'] = strip_tags(stripslashes($_POST['sakura_Twitter-title']));
			$options['show'] = strip_tags(stripslashes($_POST['sakura_Twitter-show']));
			$options['upd'] = strip_tags(stripslashes($_POST['sakura_Twitter-upd']));
			update_option('widget_sakura_Twidget', $options);

         $cache=dirname(__FILE__).'/../../uploads/twitter.cache';
         @unlink($cache);
		}

		// Get options for form fields to show
		$account = htmlspecialchars($options['account'], ENT_QUOTES);
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$show = htmlspecialchars($options['show'], ENT_QUOTES);
		$upd = htmlspecialchars($options['upd'], ENT_QUOTES);

      if (!$upd) $upd=60;

		// The form fields
		echo '<p>
				<label for="Twitter-account">' . __('Account:', LANGUAGE_ZONE) . '<br />
				<input style="width: 100px;" id="Twitter-account" name="sakura_Twitter-account" type="text" value="'.$account.'" />
				</label></p>';
		echo '<p>
				<label for="Twitter-title">' . __('Title:', LANGUAGE_ZONE) . '<br />
				<input style="width: 100px;" id="Twitter-title" name="sakura_Twitter-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<p>
				<label for="Twitter-show">' . __('Show:', LANGUAGE_ZONE) . '<br />
				<input style="width: 100px;" id="Twitter-show" name="sakura_Twitter-show" type="text" value="'.$show.'" />
				</label></p>';
		echo '<p>
				<label for="Twitter-show2">' . __('Update interval (secs):', LANGUAGE_ZONE) . '<br />
				<input style="width: 100px;" id="Twitter-show2" name="sakura_Twitter-upd" type="text" value="'.$upd.'" />
				</label></p>';
		echo '<input type="hidden" id="sakura_Twitter-submit" name="sakura_Twitter-submit" value="1" />';
	}


   // wp_register_sidebar_widget(9002, (THEME_TITLE.' Twitter'), 'widget_sakura_Twidget');
   // wp_register_widget_control(9002, THEME_TITLE.' Twitter', "widget_sakura_Twidget_control");
   
?>
