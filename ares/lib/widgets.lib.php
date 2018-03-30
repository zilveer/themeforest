<?php

/**
*	Begin Recent Posts Custom Widgets
**/

class Custom_Recent_Posts extends WP_Widget {
	function Custom_Recent_Posts() {
		$widget_ops = array('classname' => 'Custom_Recent_Posts', 'description' => 'The recent posts with thumbnails' );
		$this->WP_Widget('Custom_Recent_Posts', 'Custom Recent Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 3;
		}
		
		if(!empty($items))
		{
			pp_posts('recent', $items, TRUE);
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '') );
		$items = strip_tags($instance['items']);

?>
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 3): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Recent_Posts');

/**
*	End Recent Posts Custom Widgets
**/

/**
*	Begin Popular Posts Custom Widgets
**/

class Custom_Popular_Posts extends WP_Widget {
	function Custom_Popular_Posts() {
		$widget_ops = array('classname' => 'Custom_Popular_Posts', 'description' => 'The popular posts with thumbnails' );
		$this->WP_Widget('Custom_Popular_Posts', 'Custom Popular Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 3;
		}
		
		if(!empty($items))
		{
			pp_posts('popular', $items, TRUE);
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '') );
		$items = strip_tags($instance['items']);

?>
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 3): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Popular_Posts');

/**
*	End Popular Posts Custom Widgets
**/


/**
*	Begin Twitter Feed Custom Widgets
**/

class Custom_Twitter extends WP_Widget {
	function Custom_Twitter() {
		$widget_ops = array('classname' => 'Custom_Twitter', 'description' => 'Display your recent Twitter feed' );
		$this->WP_Widget('Custom_Twitter', 'Custom Twitter', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$twitter_username = empty($instance['twitter_username']) ? ' ' : apply_filters('widget_title', $instance['twitter_username']);
		$title = $instance['title'];
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		$consumer_key = $instance['consumer_key'];
		$consumer_secret = $instance['consumer_secret'];
		$access_token = $instance['access_token'];
		$access_token_secret = $instance['access_token_secret'];
		
		if(!is_numeric($items))
		{
			$items = 5;
		}
		
		if(empty($title))
		{
			$title = 'Recent Tweets';
		}
		
		if(!empty($items) && !empty($twitter_username))
		{
			// Begin get user timeline
			include_once (TEMPLATEPATH . "/lib/twitter.lib.php");
			$obj_twitter = new Twitter($twitter_username); 
			$obj_twitter->consumer_key = $consumer_key;
			$obj_twitter->consumer_secret = $consumer_secret;
			$obj_twitter->access_token = $access_token;
			$obj_twitter->access_token_secret = $access_token_secret;
			
			$tweets = $obj_twitter->get($items);
			/*echo '<pre>';
			print_r($tweets);
			echo '</pre>';*/

			if(!empty($tweets))
			{
				echo '<h2 class="widgettitle">'.$title.'</h2>';
				echo '<ul class="twitter">';
				
				foreach($tweets as $tweet)
				{
					echo '<li>';
					
					if(isset($tweet['text']))
					{
						echo $tweet['text'];
					}
					
					echo '</li>';
				}
				
				echo '</ul>';
			}
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['twitter_username'] = strip_tags($new_instance['twitter_username']);
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['consumer_key'] = esc_attr($new_instance['consumer_key']);
		$instance['consumer_secret'] = esc_attr($new_instance['consumer_secret']);
		$instance['access_token'] = esc_attr($new_instance['access_token']);
		$instance['access_token_secret'] = esc_attr($new_instance['access_token_secret']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'twitter_username' => '', 'title' => '', 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '') );
		$items = strip_tags($instance['items']);
		$twitter_username = strip_tags($instance['twitter_username']);
		$title = strip_tags($instance['title']);
		$consumer_key = esc_attr( $instance[ 'consumer_key' ] );
		$consumer_secret = esc_attr( $instance[ 'consumer_secret' ] );
		$access_token = esc_attr( $instance[ 'access_token' ] );
		$access_token_secret = esc_attr( $instance[ 'access_token_secret' ] );

?>
			<p>
				<label for="<?php echo $this->get_field_id('twitter_username'); ?>">Twitter Username: <input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo esc_attr($twitter_username); ?>" /></label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('items'); ?>">Items (default 5): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>">Consumer Key :</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" type="text" value="<?php echo $consumer_key; ?>" />
			</p>
	
			<p>
				<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>">Consumer Secret :</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" type="text" value="<?php echo $consumer_secret; ?>" />
			</p>
	
			<p>
				<label for="<?php echo $this->get_field_id( 'access_token' ); ?>">Access Token :</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" type="text" value="<?php echo $access_token; ?>" />
			</p>
	
			<p>
				<label for="<?php echo $this->get_field_id( 'access_token_secret' ); ?>">Access Token Secret</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" type="text" value="<?php echo $access_token_secret; ?>" />
			</p>
<?php
	}
}

register_widget('Custom_Twitter');

/**
*	End Twitter Feed Custom Widgets
**/


/**
*	Begin Flickr Feed Custom Widgets
**/

class Custom_Flickr extends WP_Widget {
	function Custom_Flickr() {
		$widget_ops = array('classname' => 'Custom_Flickr', 'description' => 'Display your recent Flickr photos' );
		$this->WP_Widget('Custom_Flickr', 'Custom Flickr', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$flickr_id = empty($instance['flickr_id']) ? ' ' : apply_filters('widget_title', $instance['flickr_id']);
		$title = $instance['title'];
		$items = $instance['items'];
		
		if(!is_numeric($items))
		{
			$items = 9;
		}
		
		if(empty($title))
		{
			$title = 'Photostream';
		}
		
		if(!empty($items) && !empty($flickr_id))
		{
			$photos_arr = get_flickr(array('type' => 'user', 'id' => $flickr_id, 'items' => $items));
			
			if(!empty($photos_arr))
			{
				echo '<h2 class="widgettitle"><span>'.$title.'</span></h2>';
				echo '<ul class="flickr">';
				
				foreach($photos_arr as $photo)
				{
					echo '<li>';
					echo '<a href="'.$photo['url'].'" title="'.$photo['title'].'"><img class="frame" src="'.$photo['thumb_url'].'" alt="" /></a>';
					echo '</li>';
				}
				
				echo '</ul>';
			}
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'flickr_id' => '', 'title' => '') );
		$items = strip_tags($instance['items']);
		$flickr_id = strip_tags($instance['flickr_id']);
		$title = strip_tags($instance['title']);

?>
			<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>">Flickr ID <a href="http://idgettr.com/">Find your Flickr ID here</a>: <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo esc_attr($flickr_id); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 9): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Flickr');

/**
*	End Flickr Feed Custom Widgets
**/


/**
*	Begin Photo in News Custom Widgets
**/

class Custom_Photos_News extends WP_Widget {
	function Custom_Photos_News() {
		$widget_ops = array('classname' => 'Custom_Photos_News', 'description' => 'Display Photos in News' );
		$this->WP_Widget('Custom_Photos_News', 'Custom Photo in News', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? 0 : $instance['title'];
		$items = empty($instance['items']) ? 0 : $instance['items'];
		
		if(empty($title))
		{
			$title = __('Photo in News', THEMEDOMAIN); 
		}
		
		if(empty($items))
		{
			$items = 9;
		}

		pp_photos_in_news($items, $title);

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'items' => '') );
		$title = strip_tags($instance['title']);
		$items = strip_tags($instance['items']);

?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 9): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Photos_News');

/**
*	End Photo in News Custom Widgets
**/


/**
*	Begin Category Posts Custom Widgets
**/

class Custom_Cat_Posts extends WP_Widget {
	function Custom_Cat_Posts() {
		$widget_ops = array('classname' => 'Custom_Cat_Posts', 'description' => 'Display category\'s post' );
		$this->WP_Widget('Custom_Cat_Posts', 'Custom Category Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$cat_id = empty($instance['cat_id']) ? 0 : $instance['cat_id'];
		$items = empty($instance['items']) ? 0 : $instance['items'];
		
		if(empty($items))
		{
			$items = 5;
		}
		
		if(!empty($cat_id))
		{
			pp_cat_posts($cat_id, $items);
		}

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['cat_id'] = strip_tags($new_instance['cat_id']);
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'cat_id' => '', 'items' => '') );
		$cat_id = strip_tags($instance['cat_id']);
		$items = strip_tags($instance['items']);
		
		$categories = get_categories('hide_empty=0&orderby=name');
		$wp_cats = array(
			0		=> "Choose a category"
		);
		foreach ($categories as $category_list ) {
			$wp_cats[$category_list->cat_ID] = $category_list->cat_name;
		}

?>
			
			<p><label for="<?php echo $this->get_field_id('cat_id'); ?>">Category: 
				<select  id="<?php echo $this->get_field_id('cat_id'); ?>" name="<?php echo $this->get_field_name('cat_id'); ?>">
				<?php
					foreach($wp_cats as $wp_cat_id => $wp_cat)
					{
				?>
						<option value="<?php echo $wp_cat_id; ?>" <?php if(esc_attr($cat_id) == $wp_cat_id) { echo 'selected="selected"'; } ?>><?php echo $wp_cat; ?></option>
				<?php
					}
				?>
				</select>
			</label></p>
			
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 5): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Cat_Posts');

/**
*	End Category Posts Custom Widgets
**/

/**
*	Begin Facebook Page Custom Widgets
**/

class Custom_Facebook_Page extends WP_Widget {
	function Custom_Facebook_Page() {
		$widget_ops = array('classname' => 'Custom_Facebook_Page', 'description' => 'Facebook page like box' );
		$this->WP_Widget('Custom_Facebook_Page', 'Custom Facebook Page', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$fb_page_url = $instance['fb_page_url'];
		
		if(!empty($fb_page_url))
		{
			if(isset($_SESSION['pp_menu_style']))
			{
				$pp_menu_style = $_SESSION['pp_menu_style'];
			}
			else
			{
				$pp_menu_style = get_option('pp_menu_style');
			}
			
			$fb_skin = 'light';
			$fb_border = 'ffffff';
			if($pp_menu_style != 3 && $pp_menu_style != 6)
			{
				$fb_skin = 'light';
				$fb_border = 'ffffff';
			}
			else
			{
				$fb_skin = 'dark';
				$fb_border = '191919';
			}
?>
<h2 class="widgettitle">Find us on Facebook</h2>
<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($fb_page_url); ?>&amp;width=270&amp;height=258&amp;colorscheme=<?php echo $fb_skin; ?>&amp;show_faces=true&amp;border_color=%23<?php echo $fb_border; ?>&amp;stream=false&amp;header=false&amp;appId=268239076529520" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:270px; height:258px;" allowTransparency="true"></iframe>
<?php
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['fb_page_url'] = strip_tags($new_instance['fb_page_url']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'fb_page_url' => '') );
		$fb_page_url = strip_tags($instance['fb_page_url']);

?>
			<p><label for="<?php echo $this->get_field_id('fb_page_url'); ?>">Facebook Page URL: <input class="widefat" id="<?php echo $this->get_field_id('fb_page_url'); ?>" name="<?php echo $this->get_field_name('fb_page_url'); ?>" type="text" value="<?php echo esc_attr($fb_page_url); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Facebook_Page');

/**
*	End Facebook Page Custom Widgets
**/

?>