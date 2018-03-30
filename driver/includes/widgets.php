<?php

/**
 * Custom Widgets
 *
 * Widgets :
 * - Iron_Widget_Radio
 * - Iron_Widget_Twitter
 * - Iron_Widget_Terms
 * - Iron_Widget_Posts
 * - Iron_Widget_Videos
 * - Iron_Widget_Events
 *
 * @link http://codex.wordpress.org/Function_Reference/register_widget
 */

$iron_widgets = array(
	  'Iron_Widget_Radio'           => IRON_WIDGET_PREFIX . _x('Radio Player', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Discography'     => IRON_WIDGET_PREFIX . _x('Discography', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Twitter'         => IRON_WIDGET_PREFIX . _x('Twitter', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Terms'           => IRON_WIDGET_PREFIX . _x('Terms', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Posts'    		=> IRON_WIDGET_PREFIX . _x('News', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Videos'   		=> IRON_WIDGET_PREFIX . _x('Videos', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Photos' 			=> IRON_WIDGET_PREFIX . _x('Photos', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Events'			=> IRON_WIDGET_PREFIX . _x('Events', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Newsletter' 		=> IRON_WIDGET_PREFIX . _x('Newsletter', 'Widget', IRON_TEXT_DOMAIN)
);


/**
 * Radio Widget Class
 *
 * @since 1.6.0
 * @todo  - Add options
 */

class Iron_Widget_Radio extends Iron_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;
	
	
	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_radio'
			, 'description' => _x('A simple radio that plays a list of songs from selected albums.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			, 'albums'     	 => array()
			, 'autoplay'	=> 0
			, 'show_playlist' => 0
			, 'action_title' => ''
			, 'action_obj_id'  => ''
			, 'action_ext_link'  => ''
		);

		if ( isset($_GET['load']) && $_GET['load'] == 'playlist.json' ) {
		
			add_action('init', array($this, 'print_playlist_json'));
		}

		parent::__construct('iron-radio', IRON_WIDGET_PREFIX . _x('Radio Player', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);

	}

	/**
	 * Front-end display of widget.
	 */

	public function widget ( $args, $instance )
	{
	
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );
		
		$args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
		$args['before_title'] = str_replace('h2','h3',$args['before_title']);
		$args['after_title'] = str_replace('h2','h3',$args['after_title']);
		/*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
		
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$albums = $instance['albums'];
		$show_playlist = (bool)$instance['show_playlist'];
		$autoplay = (bool)$instance['autoplay'];
		$action_title = apply_filters( 'iron_widget_action_title', $instance['action_title'], $instance, $this->id_base );
		$action_obj_id = apply_filters( 'iron_widget_action_obj_id', $instance['action_obj_id'], $instance, $this->id_base );
		$action_ext_link = apply_filters( 'iron_widget_action_ext_link', $instance['action_ext_link'], $instance, $this->id_base );
		/***/

		$action = $this->action_link( $action_obj_id, $action_ext_link, $action_title);

		$playlist = $this->get_playlist($albums, $title);
		if ( isset($playlist['tracks']) && ! empty($playlist['tracks']) )
			$player_message = _x('Loading tracks...', 'Widget', IRON_TEXT_DOMAIN);
		else
			$player_message = _x('No tracks founds...', 'Widget', IRON_TEXT_DOMAIN);

		/***/

		if ( ! $playlist )
			return;

		if($show_playlist) {
			$args['before_widget'] = str_replace("iron_widget_radio", "iron_widget_radio playlist_enabled", $args['before_widget']);
		}
		
		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo $args['before_title'] . esc_html($title) . $args['after_title'];
			if(!empty($title)){$this->get_title_divider();}

		if(is_array($albums)) {
			$albums = implode(',', $albums);
		}


		if($show_playlist) {

			$album_ids = explode(",", $albums);
			$all_tracks = array();
			foreach($album_ids as $aid) {
			
				$tracks = get_field('alb_tracklist', $aid);
				foreach($tracks as $track) {
					$all_tracks[] = $track;
				}

			}
			
			$store_buttons = array();
			$i = 0;
			foreach($all_tracks as $track) {
				
				if(!empty($track["track_store"])) {
					$store_buttons["$i"] = '<a style="display:none;" class="button" target="_blank" href="'.esc_url( $track['track_store'] ).'">'. __($track['track_buy_label'], IRON_TEXT_DOMAIN).'</a>';
				}else{
					$store_buttons["$i"] = '';
				}
				$i++;
			}

			$store_buttons = json_encode($store_buttons);
					
		}	
		
		echo '
			<div class="panel__body player-holder" id="'.$args["widget_id"].'" data-autoplay="'.$autoplay.'" data-url-playlist="' . home_url('?load=playlist.json&amp;title='.$title.'&amp;albums='.$albums.'') . '" data-storebuttons="'.base64_encode($store_buttons).'">
				<div class="info-box">
					<img class="poster-image" src="'.IRON_PARENT_URL.'/images/player-thumb.jpg" width="107" height="107" alt="">
					<div class="text player-title-box">'.$player_message.'</div>
					<!-- jplayer markup start -->
					<div id="audio-holder">
						<div class="jp-jplayer"></div>
						<!-- jp-audio player-box -->
						<div class="jp-audio player-box">
							<div class="jp-gui jp-interface">
								<!-- time-box -->
								<div class="time-box">
									<div class="jp-current-time"></div>
									<div class="jp-duration"></div>
								</div>
								<!-- jp-controls -->
								<ul class="jp-controls">
									<li><a href="javascript:;" class="jp-previous" tabindex="1"><i class="fa fa-backward" title="'.__("previous", IRON_TEXT_DOMAIN).'"></i></a></li>
									<li><a href="javascript:;" class="jp-play" tabindex="1"><i class="fa fa-play" title="'.__("play", IRON_TEXT_DOMAIN).'"></i></a></li>
									<li><a href="javascript:;" class="jp-pause" tabindex="1"><i class="fa fa-pause" title="'.__("pause", IRON_TEXT_DOMAIN).'"></i></a></li>
									<li><a href="javascript:;" class="jp-next" tabindex="1"><i class="fa fa-forward" title="'.__("next", IRON_TEXT_DOMAIN).'"></i></a></li>
								</ul>
								<!-- jp-progress -->
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
							</div>
							<div class="jp-type-playlist">
								<!-- jp-playlist hidden -->
								<div class="jp-playlist '.($show_playlist ? '' : 'hidden').'">
									<ul class="tracks-list">
										<li></li>
									</ul>
								</div>
								<!-- jp-no-solution -->
								<div class="jp-no-solution hidden">
									<span>'.__("Update Required", IRON_TEXT_DOMAIN).'</span>
									'.__("To play the media you will need to either update your browser to a recent version or update your", IRON_TEXT_DOMAIN).' <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>';
		echo $action;
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 */

	public function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = esc_attr( $instance['title'] );
		$albums = $instance['albums'];
		$show_playlist = (bool)$instance['show_playlist'];
		$autoplay = (bool)$instance['autoplay'];
		$action_title = $instance['action_title'];
		$action_obj_id = $instance['action_obj_id'];
		$action_ext_link = $instance['action_ext_link'];
		
		$all_albums = get_posts(array(
			  'post_type' => 'album'
			, 'posts_per_page' => -1
			, 'no_found_rows'  => true
		));


		if ( !empty($all_albums) ) :
?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _ex('Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Popular Songs', IRON_TEXT_DOMAIN); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('albums')); ?>"><?php _ex('Album:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('albums')); ?>" name="<?php echo esc_attr($this->get_field_name('albums')); ?>[]" multiple="multiple">
				<?php foreach($all_albums as $a): ?>
				
					<option value="<?php echo esc_attr($a->ID); ?>"<?php echo (in_array($a->ID, $albums) ? ' selected="selected"' : ''); ?>><?php echo esc_attr($a->post_title); ?></option>
				
				<?php endforeach; ?>
				</select>
			</p>

			<p>
				<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>"<?php checked( $autoplay ); ?> />
				<label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>"><?php _e( 'Auto Play' ); ?></label><br />
			</p>
			
<!--
			<p>
				<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('show_playlist')); ?>" name="<?php echo esc_attr($this->get_field_name('show_playlist')); ?>"<?php checked( $show_playlist ); ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_playlist')); ?>"><?php _e( 'Show Playlist' ); ?></label><br />
			</p>
-->	
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('action_title')); ?>"><?php _ex('Call To Action Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_title')); ?>" name="<?php echo esc_attr($this->get_field_name('action_title')); ?>" value="<?php echo esc_attr($action_title); ?>" placeholder="<?php _e('View More', IRON_TEXT_DOMAIN); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>"><?php _ex('Call To Call To Action Page:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>" name="<?php echo esc_attr($this->get_field_name('action_obj_id')); ?>">
					<?php echo $this->get_object_options($action_obj_id); ?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>"><?php _ex('Call To Action External Link:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>" name="<?php echo esc_attr($this->get_field_name('action_ext_link')); ?>" value="<?php echo esc_attr($action_ext_link); ?>" />
			</p>
						
			

<?php

		else :
			
				echo '<p>'. sprintf( _x('No albums have been created yet. <a href="%s">Create some</a>.', 'Widget', IRON_TEXT_DOMAIN), admin_url('edit.php?post_type=album') ) .'</p>';
			
		endif;


	}

	/**
	 * Sanitize widget form values as they are saved.
	 */

	public function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['albums'] = $new_instance['albums'];
		$instance['show_playlist']  = (bool)$new_instance['show_playlist'];
		$instance['autoplay']  = (bool)$new_instance['autoplay'];
		$instance['action_title']  = $new_instance['action_title'];
		$instance['action_obj_id']  = $new_instance['action_obj_id'];
		$instance['action_ext_link']  = $new_instance['action_ext_link'];
		
		return $instance;
	}
	
	
	function print_playlist_json() {
	
		header('Content-Type: application/json');
		$jsonData = array();
	
		$title = !empty($_GET["title"]) ? $_GET["title"] : null;
		$albums = !empty($_GET["albums"]) ? $_GET["albums"] : array();
		
		$playlist = $this->get_playlist($albums, $title);
	
		if(is_array($playlist) && ! empty($playlist['tracks'])) {
	
			$tracks = $playlist['tracks'];
	
			$i = 0;
			foreach ( $tracks as $track )
			{
				$jsonData[$i]['title'] = '<strong class="title">'.$track['album_title'].'</strong><span class="track-name">'.$track['track_title'].'</span>';
				$jsonData[$i]['poster']	= $track['album_poster'];
				$jsonData[$i]['mp3']	= $track['track_mp3'];
				$i++;
			}
	
		}
	
		echo 'var musicPlayList = '.json_encode($jsonData).';';
		die();
	}
	
	function get_playlist($album_ids = array(), $title = null) {
	
		global $post;
	
		$playlist = array();
		if(!is_array($album_ids)) {
			$album_ids = explode(",", $album_ids);
		}

		
		$albums = get_posts(array(
			  'post_type' => 'album'
			, 'post__in' => $album_ids	
		));

		$tracks = array();
		foreach($albums as $a) {
			
			$album_tracks = get_field('alb_tracklist', $a->ID);
			for($i = 0 ; $i < count($album_tracks) ; $i++) {
			
				$thumb_id = get_post_thumbnail_id($a->ID);
				$thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);

				$album_tracks[$i]["album_title"] = $a->post_title;
				$album_tracks[$i]["album_poster"] = $thumb_url[0];
			}
			$tracks = array_merge($tracks, $album_tracks);
			
		}
		
		$playlist['playlist_name'] = $title;
		if ( empty($playlist['playlist_name']) ) $playlist['playlist_name'] = "";
	
		$playlist['tracks'] = $tracks;
		if ( empty($playlist['tracks']) ) $playlist['tracks'] = array();
	
		return $playlist;
	}



} // class Iron_Widget_Discography


/**
 * Discography Widget Class
 *
 * @since 1.6.0
 * @todo  - Add options
 */

class Iron_Widget_Discography extends Iron_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;
	
	
	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_discography'
			, 'description' => _x('A grid view of your selected albums.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			, 'albums'     	 => array()
			, 'action_title' => ''
			, 'action_obj_id'  => ''
			, 'action_ext_link'  => ''
		);

		parent::__construct('iron-discography', IRON_WIDGET_PREFIX . _x('Discography', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);

	}

	/**
	 * Front-end display of widget.
	 */

	public function widget ( $args, $instance )
	{		
		global $post, $widget;
		
		$args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
		$args['before_title'] = str_replace('h2','h3',$args['before_title']);
		$args['after_title'] = str_replace('h2','h3',$args['after_title']);
		/*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
		extract($args);
	
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$albums = $instance['albums'];
		if(!is_array($albums)) {
			$albums = explode(",", $albums);
		}
		
		$query_args = array(
			  'post_type'           => 'album'
			, 'posts_per_page'      => -1
			, 'no_found_rows'       => true
			, 'post_status'         => 'publish'
			, 'ignore_sticky_posts' => true
			, 'post__in' => $albums	
		);
	
		$r = new WP_Query( apply_filters( 'iron_widget_posts_args', $query_args));

			
		if ( $r->have_posts() ) :


			$action_title = apply_filters( 'iron_widget_action_title', $instance['action_title'], $instance, $this->id_base );
			$action_obj_id = apply_filters( 'iron_widget_action_obj_id', $instance['action_obj_id'], $instance, $this->id_base );
			$action_ext_link = apply_filters( 'iron_widget_action_ext_link', $instance['action_ext_link'], $instance, $this->id_base );
	
			/***/
	
			$action = $this->action_link( $action_obj_id, $action_ext_link, $action_title);

			echo $before_widget;

			if ( ! empty( $title ) )
				echo sprintf( $before_title, $action ) . $title . $after_title;
				if(!empty($title)){$this->get_title_divider();}

?>
				<div id="albums-list" class="two_column_album">

<?php
				$widget = true;
				$permalink_enabled = (bool) get_option('permalink_structure');
				while ( $r->have_posts() ) : $r->the_post();
					get_template_part('items/album');
				endwhile;
?>
				<?php echo $action; ?>
				</div>

<?php
			
			echo $after_widget;
			//echo $action;

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;
		wp_reset_query();
	}

	/**
	 * Back-end widget form.
	 */

	public function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = esc_attr( $instance['title'] );
		$albums = $instance['albums'];
		$action_title = $instance['action_title'];
		$action_obj_id = $instance['action_obj_id'];
		$action_ext_link = $instance['action_ext_link'];
		
		$all_albums = get_posts(array(
			  'post_type' => 'album'
			, 'posts_per_page' => -1
			, 'no_found_rows'  => true
		));


		if ( !empty($all_albums) ) :
?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _ex('Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Popular Albums', IRON_TEXT_DOMAIN); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('albums')); ?>"><?php _ex('Album:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('albums')); ?>" name="<?php echo esc_attr($this->get_field_name('albums')); ?>[]" multiple="multiple">
				<?php foreach($all_albums as $a): ?>
				
					<option value="<?php echo esc_attr($a->ID); ?>"<?php echo (in_array($a->ID, $albums) ? ' selected="selected"' : ''); ?>><?php echo esc_html($a->post_title); ?></option>
				
				<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('action_title')); ?>"><?php _ex('Call To Action Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_title')); ?>" name="<?php echo esc_attr($this->get_field_name('action_title')); ?>" value="<?php echo esc_attr($action_title); ?>" placeholder="<?php _e('View More', IRON_TEXT_DOMAIN); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>"><?php _ex('Call To Call To Action Page:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>" name="<?php echo esc_attr($this->get_field_name('action_obj_id')); ?>">
					<?php echo $this->get_object_options($action_obj_id); ?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>"><?php _ex('Call To Action External Link:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>" name="<?php echo esc_attr($this->get_field_name('action_ext_link')); ?>" value="<?php echo esc_attr($action_ext_link); ?>" />
			</p>
						
			

<?php

		else :
			
				echo '<p>'. sprintf( _x('No albums have been created yet. <a href="%s">Create some</a>.', 'Widget', IRON_TEXT_DOMAIN), admin_url('edit.php?post_type=album') ) .'</p>';
			
		endif;


	}

	/**
	 * Sanitize widget form values as they are saved.
	 */

	public function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['albums'] = $new_instance['albums'];

		$instance['action_title']  = $new_instance['action_title'];
		$instance['action_obj_id']  = $new_instance['action_obj_id'];
		$instance['action_ext_link']  = $new_instance['action_ext_link'];
		
		return $instance;
	}

} // class Iron_Widget_Discography




/**
 * Twitter Widget Class
 *
 * @since 1.6.0
 * @todo  - Add options
 */

class Iron_Widget_Twitter extends Iron_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;
	
	
	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_twitter'
			, 'description' => _x('The most recent tweet.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'           => ''
			, 'screen_name'     => ''
			//'count'           => 1
			//'exclude_replies' => true
			//'expand_media'    => true
			, 'action_title' => ''
			, 'action_obj_id'  => ''
			, 'action_ext_link'  => ''
		);

		parent::__construct('iron-recent-tweets', IRON_WIDGET_PREFIX . _x('Twitter', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);
	}

	/**
	 * Front-end display of widget.
	 */

	public function widget ( $args, $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );
		$args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
		$args['before_title'] = str_replace('h2','h3',$args['before_title']);
		$args['after_title'] = str_replace('h2','h3',$args['after_title']);
		/*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$username = str_replace('@', '', $instance['screen_name']);

		if ( ! $username )
			return;

		$action = $this->action_link( 'twitter', 0, 'https://twitter.com/' . $username );
		
		$action_title = apply_filters( 'iron_widget_action_title', $instance['action_title'], $instance, $this->id_base );
		$action_obj_id = apply_filters( 'iron_widget_action_obj_id', $instance['action_obj_id'], $instance, $this->id_base );
		$action_ext_link = apply_filters( 'iron_widget_action_ext_link', $instance['action_ext_link'], $instance, $this->id_base );

		/***/

		$action = $this->action_link( $action_obj_id, $action_ext_link, $action_title);
				

		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo $args['before_title'] . esc_html($title) . $args['after_title'];;
			if(!empty($title)){$this->get_title_divider();}

		echo '
			<div class="panel__body">
				<div class="twitter-center">
					<div class="twitter-logo"><i class="fa fa-twitter"></i></div>
					<div class="twitter-logo-small"><i class="fa fa-twitter"></i></div>
					<div id="twitter_'.$this->id.'" class="query" data-username="'.$username.'"></div>
					<div style="clear:both;"></div>
				</div>
			</div>';
		echo $action;
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 */

	public function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = esc_attr( $instance['title'] );
		$username = esc_attr( $instance['screen_name'] );
		$action_title = $instance['action_title'];
		$action_obj_id = $instance['action_obj_id'];
		$action_ext_link = $instance['action_ext_link'];

?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _ex('Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Live from Twitter', IRON_TEXT_DOMAIN); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('screen_name')); ?>"><?php _ex('Screen Name:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('screen_name')); ?>" name="<?php echo esc_attr($this->get_field_name('screen_name')); ?>" value="<?php echo esc_attr($username); ?>" placeholder="@IronTemplates" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_title')); ?>"><?php _ex('Call To Action Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_title')); ?>" name="<?php echo esc_attr($this->get_field_name('action_title')); ?>" value="<?php echo esc_attr($action_title); ?>" placeholder="<?php _e('View More', IRON_TEXT_DOMAIN); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>"><?php _ex('Call To Call To Action Page:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>" name="<?php echo esc_attr($this->get_field_name('action_obj_id')); ?>">
				<?php echo $this->get_object_options($action_obj_id); ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>"><?php _ex('Call To Action External Link:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>" name="<?php echo esc_attr($this->get_field_name('action_ext_link')); ?>" value="<?php echo esc_attr($action_ext_link); ?>" />
		</p>
			
<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 */

	public function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['screen_name'] = str_replace('@', '', strip_tags( stripslashes($new_instance['screen_name']) ));
		$instance['action_title']  = $new_instance['action_title'];
		$instance['action_obj_id']  = $new_instance['action_obj_id'];
		$instance['action_ext_link']  = $new_instance['action_ext_link'];
		return $instance;
	}

} // class Iron_Widget_Twitter


/**
 * Terms Widget Class
 *
 * @since 1.6.0
 */
class Iron_Widget_Terms extends Iron_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;
	
	
	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_terms'
			, 'description' => _x('A list or dropdown of terms', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			, 'taxonomy'     => 'category'
			, 'count'        => 0
			, 'hierarchical' => 0
			, 'dropdown'     => 0
		);

		parent::__construct('iron-terms', IRON_WIDGET_PREFIX . __('Terms'), $widget_ops);
	}

	function widget ( $args, $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );
		$args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
		$args['before_title'] = str_replace('h2','h3',$args['before_title']);
		$args['after_title'] = str_replace('h2','h3',$args['after_title']);
		/*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$taxonomy = $instance['taxonomy'];
		$c = $instance['count'];
		$h = $instance['hierarchical'];
		$d = $instance['dropdown'];

		echo $before_widget;
		if ( $title )
			echo sprintf( $before_title, '' ) . $title . $after_title;
			if(!empty($title)){$this->get_title_divider();}

		$term_args = array(
			  'taxonomy'           => $taxonomy
			, 'orderby'            => 'name'
			, 'order'              => 'ASC'
			, 'hide_empty'         => 1
			, 'show_count'         => $c
			, 'hierarchical'       => $h
			, 'title_li'           => false
			, 'depth'              => 0
			, 'style'              => 'list'
			, 'orderby'            => 'name'
			, 'use_desc_for_title' => 1
			, 'child_of'           => 0
			, 'exclude'            => ''
			, 'exclude_tree'       => ''
			, 'current_category'   => 0
		);

		$terms = get_terms( $taxonomy, array( 'orderby' => 'name', 'hierarchical' => $h ) );

		if ( $d ) :
			$term_args['show_option_none'] = __('Select Term');

?>
<select id="tax-<?php echo esc_attr($taxonomy); ?>" class="terms-dropdown" name="<?php echo esc_attr($this->get_field_name('taxonomy')); ?>">
	<option><?php echo esc_attr($term_args['show_option_none']); ?></option>
<?php
			foreach ( $terms as $term ) {
				echo '<option value="' . $term->term_id . '">'. $term->name . ( $c ? ' (' . $term->count . ')' : '' ) . '</option>';
			}
?>
</select>

<script>
/* <![CDATA[ */
	var dropdown = document.getElementById('tax-<?php echo esc_attr($taxonomy); ?>');
	function onCatChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			location.href = "<?php echo home_url(); ?>/?taxonomy=<?php echo esc_url($taxonomy); ?>&term="+dropdown.options[dropdown.selectedIndex].value;
		}
	}
	dropdown.onchange = onCatChange;
/* ]]> */
</script>

<?php
		else :
			$taxonomy_object = get_taxonomy( $taxonomy );

			$term_args['show_option_all'] = $taxonomy_object->labels->all_items;

			$posts_page = ( 'page' == get_option('show_on_front') && get_option('page_for_posts') ) ? get_permalink( get_option('page_for_posts') ) : get_iron_option('page_for_' . $taxonomy_object->object_type[0] . 's');
			$posts_page = esc_url( $posts_page );
?>
		<ul class="terms-list">
			<li><a href="<?php echo esc_url($posts_page); ?>"><i class="fa fa-plus"></i> <?php echo esc_html($term_args['show_option_all']); ?></a></li>
<?php
			// wp_list_categories( apply_filters('widget_categories_args', $term_args) );
/*
			if ( $h )
				$depth = 0;
			else
				$depth = -1; // Flat.

			walk_category_tree( $categories, $depth, $r );
*/
			foreach ( $terms as $term ) {
				echo '<li><a href="' . get_term_link( $term, $taxonomy ) . '"><i class="fa fa-plus"></i> ' . $term->name . ( $c ? ' <small>(' . $term->count . ')</small>' : '' ) . '</a></li>';
			}
?>
		</ul>
<?php
		endif;

		echo $after_widget;
		echo esc_attr($action);
	}

	function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		// $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

		return $instance;
	}

	function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = esc_attr( $instance['title'] );
		$count = (bool) $instance['count'];
		// $hierarchical = (bool) $instance['hierarchical'];
		$dropdown = (bool) $instance['dropdown'];
		$taxonomy = esc_attr( $instance['taxonomy'] );

		# Get taxonomiues
		$taxonomies = get_taxonomies( array( 'public' => true ) );

		# If no taxonomies exists
		if ( ! $taxonomies ) {
			echo '<p>'. __('No taxonomies have been created yet.', IRON_TEXT_DOMAIN) .'</p>';
			return;
		}

?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Categories', IRON_TEXT_DOMAIN); ?>" /></p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>"><?php _e( 'Select Taxonomy:' ); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>" name="<?php echo esc_attr($this->get_field_name('taxonomy')); ?>">
		<?php
			foreach ( $taxonomies as $tax ) {
				$tax = get_taxonomy($tax);
				echo '<option value="' . $tax->name . '"' . selected( $taxonomy, $tax->name, false ) . '>'. $tax->label . '</option>';
			}
		?>
			</select>
		</p>

		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('dropdown')); ?>" name="<?php echo esc_attr($this->get_field_name('dropdown')); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('dropdown')); ?>"><?php _e( 'Display as dropdown' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php _e( 'Show post counts' ); ?></label><br />
<?php /*
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>" name="<?php echo esc_attr($this->get_field_name('hierarchical')); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
<?php
*/
	}

} // class Iron_Widget_Terms



/**
 * Posts Widget Class
 *
 * @since 1.6.0
 * @see   Iron_Widget_Posts
 * @todo  - Add advanced options
 */

class Iron_Widget_Posts extends Iron_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;
	
	

	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_posts'
			, 'description' => _x('The most recent posts on your site.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			, 'post_type'    => 'post'
			, 'view'		 => 'post'
			, 'category'	 => array()
			//'order'        => 'DESC'
			//'orderby'      => 'date'
			, 'number'       => get_option('posts_per_page')
			//'taxonomy'     => array()
			, 'show_date'    => true
			, 'enable_excerpts' => false
			//'thumbnails'   => true
			, 'action_title' => ''
			, 'action_obj_id'  => ''
			, 'action_ext_link'  => ''
		);

		parent::__construct('iron-recent-posts', IRON_WIDGET_PREFIX . __('News', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget ( $args, $instance )
	{
		global $show_date, $enable_excerpts;

		$cache = wp_cache_get('iron_widget_posts', 'widget');

		if ( ! is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		$args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
		$args['before_title'] = str_replace('h2','h3',$args['before_title']);
		$args['after_title'] = str_replace('h2','h3',$args['after_title']);
		/*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
		extract($args);

		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title      = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$post_type  = apply_filters( 'widget_post_type', $instance['post_type'], $instance, $this->id_base );
		$number     = $instance['number'];
		$category   = $instance['category'];
		$view     	= $instance['view'];
		$show_date  = (bool)$instance['show_date'];
		$enable_excerpts  = (bool)$instance['enable_excerpts'];

		// $thumbnails = $instance['thumbnails'];

		$query_args = array(
			  'post_type'           => $post_type
			, 'posts_per_page'      => $number
			, 'no_found_rows'       => true
			, 'post_status'         => 'publish'
			, 'ignore_sticky_posts' => true
		);

		if(!empty($category)) {

			if(is_array($category)) {
				$category = implode(",", $category);
			}
			$query_args["cat"] = $category;
		}
		
			
		$r = new WP_Query( apply_filters( 'iron_widget_posts_args', $query_args ) );

		if ( $r->have_posts() ) :

			$action_title = apply_filters( 'iron_widget_action_title', $instance['action_title'], $instance, $this->id_base );
			$action_obj_id = apply_filters( 'iron_widget_action_obj_id', $instance['action_obj_id'], $instance, $this->id_base );
			$action_ext_link = apply_filters( 'iron_widget_action_ext_link', $instance['action_ext_link'], $instance, $this->id_base );
	
			/***/
	
			$action = $this->action_link( $action_obj_id, $action_ext_link, $action_title);
		
/*
			switch ( $post_type ) {
				case 'post'  : $classname = ' responsive1'; break;
				case 'event'   : $classname = ' responsive2'; break;
				case 'video' : $classname = ' responsive3'; break;
				default      : $classname = ''; break;
			}
*/

			echo $before_widget;

			if ( ! empty( $title ) )
				echo sprintf( $before_title, $action ) . $title . $after_title;
				if(!empty($title)){$this->get_title_divider();}

?>
				<div class="recent-posts <?php echo esc_attr($view); ?>">
<?php				
				$permalink_enabled = (bool) get_option('permalink_structure');
				while ( $r->have_posts() ) : $r->the_post();
					
					get_template_part('items/'.$view);

				endwhile;
?>				
				<?php echo $action; ?>
				</div>

<?php

			echo $after_widget;
			//echo $action;

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('iron_widget_posts', $cache, 'widget');
	}

	function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['view'] = $new_instance['view'];
		$instance['category'] = $new_instance['category'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : true;
		$instance['enable_excerpts'] = isset( $new_instance['enable_excerpts'] ) ? (bool) $new_instance['enable_excerpts'] : true;

		$instance['action_title']  = $new_instance['action_title'];
		$instance['action_obj_id']  = $new_instance['action_obj_id'];
		$instance['action_ext_link']  = $new_instance['action_ext_link'];
				
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache ()
	{
		wp_cache_delete('iron_widget_posts', 'widget');
	}

	function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : true;
		$enable_excerpts = isset( $instance['enable_excerpts'] ) ? (bool) $instance['enable_excerpts'] : true;
		$view = $instance['view'];
		$category = $instance['category'];
		$action_title = $instance['action_title'];
		$action_obj_id = $instance['action_obj_id'];
		$action_ext_link = $instance['action_ext_link'];
?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Latest News', IRON_TEXT_DOMAIN); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>


		<p><input class="checkbox" type="checkbox" <?php checked( $enable_excerpts ); ?> id="<?php echo esc_attr($this->get_field_id( 'enable_excerpts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'enable_excerpts' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'enable_excerpts' )); ?>"><?php _e( 'Display excerpts?' ); ?></label></p>


		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php _e( 'Display post date?' ); ?></label></p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php _ex('Select one or multiple categories:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>[]" multiple="mutiple">
				<?php echo $this->get_taxonomy_options($category); ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'view' )); ?>"><?php _e( 'View As:' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('view')); ?>" name="<?php echo esc_attr($this->get_field_name('view')); ?>">
				<option <?php echo ($view == 'post' ? 'selected' : ''); ?> value="post"><?php _ex('List', 'Widget', IRON_TEXT_DOMAIN); ?></option>
				<option <?php echo ($view == 'post_grid' ? 'selected' : ''); ?> value="post_grid"><?php _ex('Grid', 'Widget', IRON_TEXT_DOMAIN); ?></option>
				<option <?php echo ($view == 'post_simple' ? 'selected' : ''); ?> value="post_simple"><?php _ex('Simple', 'Widget', IRON_TEXT_DOMAIN); ?></option>
			</select>						
		<p>
				
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_title')); ?>"><?php _ex('Call To Action Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_title')); ?>" name="<?php echo esc_attr($this->get_field_name('action_title')); ?>" value="<?php echo esc_attr($action_title); ?>" placeholder="<?php _e('View More', IRON_TEXT_DOMAIN); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>"><?php _ex('Call To Call To Action Page:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>" name="<?php echo esc_attr($this->get_field_name('action_obj_id')); ?>">
				<?php echo $this->get_object_options($action_obj_id); ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>"><?php _ex('Call To Action External Link:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>" name="<?php echo esc_attr($this->get_field_name('action_ext_link')); ?>" value="<?php echo esc_attr($action_ext_link); ?>" />
		</p>
					
<?php
	}
} // class Iron_Widget_Posts



/**
 * Videos Widget Class
 *
 * @since 1.6.0
 * @see   Iron_Widget_Posts
 * @todo  - Add advanced options
 */

class Iron_Widget_Videos extends Iron_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;
	
	
	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{	

		$widget_ops = array(
			  'classname'   => 'iron_widget_videos'
			, 'description' => _x('The most recent videos on your site.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			, 'post_type'    => 'video'
			, 'view'		 => 'video_list'
			, 'category'	 => array()
			, 'include'	 => array()
			, 'video_link_type'	 => ''
			//'order'        => 'DESC'
			//'orderby'      => 'date'
			, 'number'       => get_iron_option('videos_per_page')
			//'taxonomy'     => array()
			//'show_date'    => true
			//'thumbnails'   => true
			, 'action_title' => ''
			, 'action_obj_id'  => ''
			, 'action_ext_link'  => ''
		);

		parent::__construct('iron-recent-videos', IRON_WIDGET_PREFIX . __('Videos', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget ( $args, $instance )
	{

		$cache = wp_cache_get('iron_widget_videos', 'widget');

		if ( ! is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		$args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
		$args['before_title'] = str_replace('h2','h3',$args['before_title']);
		$args['after_title'] = str_replace('h2','h3',$args['after_title']);
		/*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
		extract($args);

		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title      = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$post_type  = apply_filters( 'widget_post_type', $instance['post_type'], $instance, $this->id_base );
		$number     = $instance['number'];
		$category   = $instance['category'];
		$include   = $instance['include'];
		$video_link_type = $instance['video_link_type'];
		$view     	= $instance['view'];
		// $show_date  = $instance['show_date'];
		// $thumbnails = $instance['thumbnails'];

		
		global $link_mode;


		$query_args = array(
			  'post_type'           => $post_type
			, 'posts_per_page'      => $number
			, 'no_found_rows'       => true
			, 'post_status'         => 'publish'
			, 'ignore_sticky_posts' => true
		);
		
		if(!empty($include)) {
		
			if(!is_array($include)) {
				$include = explode(",", $include);
			}
			$query_args["post__in"] = $include;
			
			$category = false;
			$number = false;
		}
			
			
		$tax_query = array();

		if(!empty($category)) {
				
			if(!is_array($category)) {
				$category = explode(",", $category);
			}			
	        $tax_query[] = array(
		        'taxonomy' => 'video-category',
		        'field' => 'id',
		        'terms' => $category,
		        'operator'=> 'IN'
		    );

		}
		
		if(!empty($tax_query))
			$query_args["tax_query"] = $tax_query;

		$r = new WP_Query( apply_filters( 'iron_widget_posts_args', $query_args ) );

		if ( $r->have_posts() ) :

			$action_title = apply_filters( 'iron_widget_action_title', $instance['action_title'], $instance, $this->id_base );
			$action_obj_id = apply_filters( 'iron_widget_action_obj_id', $instance['action_obj_id'], $instance, $this->id_base );
			$action_ext_link = apply_filters( 'iron_widget_action_ext_link', $instance['action_ext_link'], $instance, $this->id_base );
	
			/***/
	
			$action = $this->action_link( $action_obj_id, $action_ext_link, $action_title);

			echo $before_widget;

			if ( ! empty( $title ) )
				echo sprintf( $before_title, $action ) . $title . $after_title;
				if(!empty($title)){$this->get_title_divider();}


?>
				<div class="video-list <?php echo esc_attr($view); ?>">

<?php
				$permalink_enabled = (bool) get_option('permalink_structure');
				while ( $r->have_posts() ) : $r->the_post();
					$link_mode = $video_link_type;
					get_template_part('items/'.$view);

				endwhile;
?>
				<?php echo $action; ?>
				</div>

<?php

			echo $after_widget;
			//echo $action;

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;
		wp_reset_query();
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('iron_widget_videos', $cache, 'widget');
	}

	function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['view'] = $new_instance['view'];
		$instance['category'] = $new_instance['category'];
		$instance['include'] = $new_instance['include'];
		$instance['video_link_type'] = $new_instance['video_link_type'];
		$instance['action_title']  = $new_instance['action_title'];
		$instance['action_obj_id']  = $new_instance['action_obj_id'];
		$instance['action_ext_link']  = $new_instance['action_ext_link'];
		
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache ()
	{
		wp_cache_delete('iron_widget_videos', 'widget');
	}

	function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$view      = $instance['view'];
		$category   = $instance['category'];
		$include   = $instance['include'];
		$video_link_type  = $instance['video_link_type'];
		$action_title = $instance['action_title'];
		$action_obj_id = $instance['action_obj_id'];
		$action_ext_link = $instance['action_ext_link'];
?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Videos', IRON_TEXT_DOMAIN); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of videos to show (*apply only for categories):' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php _ex('Select one or multiple categories:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>[]" multiple="mutiple">
				<?php echo $this->get_taxonomy_options($category, 'video-category'); ?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('include')); ?>"><?php _ex('Or Manually Select Videos:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('include')); ?>" name="<?php echo esc_attr($this->get_field_name('include')); ?>[]" multiple="mutiple">
				<?php echo $this->get_object_options($include, 'video'); ?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'video_link_type' )); ?>"><?php _e( "What happens when you click the video's thumbnails ?" ); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('video_link_type')); ?>" name="<?php echo esc_attr($this->get_field_name('video_link_type')); ?>">
				<option <?php echo ($video_link_type == 'single' ? 'selected' : ''); ?> value="single"><?php _ex('Go to detailed video page', 'Widget', IRON_TEXT_DOMAIN); ?></option>
				<option <?php echo ($video_link_type == 'lightbox' ? 'selected' : ''); ?> value="lightbox"><?php _ex('Open video in a LightBox', 'Widget', IRON_TEXT_DOMAIN); ?></option>
				<option <?php echo ($video_link_type == 'inline' ? 'selected' : ''); ?> value="inline"><?php _ex('Replace image by video', 'Widget', IRON_TEXT_DOMAIN); ?></option>
			</select>						
		<p>
						
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'view' )); ?>"><?php _e( 'View As:' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('view')); ?>" name="<?php echo esc_attr($this->get_field_name('view')); ?>">
				<option <?php echo ($view == 'video_list' ? 'selected' : ''); ?> value="video_list"><?php _ex('List', 'Widget', IRON_TEXT_DOMAIN); ?></option>
				<option <?php echo ($view == 'video_grid' ? 'selected' : ''); ?> value="video_grid"><?php _ex('Grid', 'Widget', IRON_TEXT_DOMAIN); ?></option>
			</select>						
		<p>
				
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_title')); ?>"><?php _ex('Call To Action Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_title')); ?>" name="<?php echo esc_attr($this->get_field_name('action_title')); ?>" value="<?php echo esc_attr($action_title); ?>" placeholder="<?php _e('View More', IRON_TEXT_DOMAIN); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>"><?php _ex('Call To Call To Action Page:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>" name="<?php echo esc_attr($this->get_field_name('action_obj_id')); ?>">
				<?php echo $this->get_object_options($action_obj_id); ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>"><?php _ex('Call To Action External Link:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>" name="<?php echo esc_attr($this->get_field_name('action_ext_link')); ?>" value="<?php echo esc_attr($action_ext_link); ?>" />
		</p>
<?php
	}
} // class Iron_Widget_Videos


/**
 * Featured_Photos Widget Class
 *
 * @since 1.6.0
 * @see   Iron_Widget_Photos
 * @todo  - Add advanced options
 */

class Iron_Widget_Photos extends Iron_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;
	
	
	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_photos'
			, 'description' => _x('Feature album photos on your site.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			, 'albums'     	 => array()
			, 'gallery_layout' => ''
			, 'gallery_height' => ''
			, 'action_title' => ''
			, 'action_obj_id'  => ''
			, 'action_ext_link'  => ''
		);

		parent::__construct('iron-featured-photos', IRON_WIDGET_PREFIX . __('Photos', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	/**
	 * Front-end display of widget.
	 */

	public function widget ( $args, $instance )
	{
	
		global $widget_photos, $gallery_layout, $gallery_height;
		
		$cache = wp_cache_get('iron_widget_featured_photos', 'widget');

		if ( ! is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		
		
		ob_start();
		$args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
		$args['before_title'] = str_replace('h2','h3',$args['before_title']);
		$args['after_title'] = str_replace('h2','h3',$args['after_title']);
		/*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
		extract($args);
		
		
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$albums = $instance['albums'];
		$gallery_layout = $instance['gallery_layout'];
		$gallery_height = (int)$instance['gallery_height'];
		$action_title = apply_filters( 'iron_widget_action_title', $instance['action_title'], $instance, $this->id_base );
		$action_obj_id = apply_filters( 'iron_widget_action_obj_id', $instance['action_obj_id'], $instance, $this->id_base );
		$action_ext_link = apply_filters( 'iron_widget_action_ext_link', $instance['action_ext_link'], $instance, $this->id_base );

		/***/

		$action = $this->action_link( $action_obj_id, $action_ext_link, $action_title);

		$widget_photos = $this->get_photos($albums);

		/***/

		if ( empty($widget_photos ))
			return;

		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo $args['before_title'] . esc_html($title) . $args['after_title'];;
			if(!empty($title)){$this->get_title_divider();}
		
		?>
		
		<?php get_template_part('parts/gallery'); ?>
		<?php echo $action; ?>
			
		<?php

		echo $args['after_widget'];
		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('iron_widget_featured_photos', $cache, 'widget');
		
	}

	/**
	 * Back-end widget form.
	 */

	public function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = esc_attr( $instance['title'] );
		$albums = $instance['albums'];
		$gallery_layout = $instance['gallery_layout'];
		$gallery_height = $instance['gallery_height'];
		$action_title = $instance['action_title'];
		$action_obj_id = $instance['action_obj_id'];
		$action_ext_link = $instance['action_ext_link'];
		
		$all_albums = get_posts(array(
			  'post_type' => 'photo-album'
			, 'posts_per_page' => -1
			, 'no_found_rows'  => true
		));


		if ( !empty($all_albums) ) :
?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _ex('Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Popular Songs', IRON_TEXT_DOMAIN); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('albums')); ?>"><?php _ex('Album:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('albums')); ?>" name="<?php echo esc_attr($this->get_field_name('albums')); ?>[]" multiple="multiple">
				<?php foreach($all_albums as $a): ?>
				
					<option value="<?php echo esc_attr($a->ID); ?>"<?php echo (in_array($a->ID, $albums) ? ' selected="selected"' : ''); ?>><?php echo esc_attr($a->post_title); ?></option>
				
				<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'gallery_layout' )); ?>"><?php _e( 'Gallery Layout:' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('gallery_layout')); ?>" name="<?php echo esc_attr($this->get_field_name('gallery_layout')); ?>">
					<option <?php echo ($gallery_layout == 'window_height' ? 'selected' : ''); ?> value="past"><?php _ex('Fit photos within window height (Gallery bottom will be flat, some photos might be hidden)', 'Widget', IRON_TEXT_DOMAIN); ?></option>
					<option <?php echo ($gallery_layout == 'custom_height' ? 'selected' : ''); ?> value="past"><?php _ex('Fit photos within custom height (Gallery bottom will be flat, manually adjust gallery height)', 'Widget', IRON_TEXT_DOMAIN); ?></option>
					<option <?php echo ($gallery_layout == 'show_all' ? 'selected' : ''); ?> value="upcoming"><?php _ex('Show all photos (Gallery bottom might not be flat)', 'Widget', IRON_TEXT_DOMAIN); ?></option>
				</select>						
			<p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'gallery_height' )); ?>"><?php _e( 'Gallery Height' ); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'gallery_height' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'gallery_height' )); ?>" type="text" value="<?php echo esc_attr($gallery_height); ?>" size="3" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('action_title')); ?>"><?php _ex('Call To Action Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_title')); ?>" name="<?php echo esc_attr($this->get_field_name('action_title')); ?>" value="<?php echo esc_attr($action_title); ?>" placeholder="<?php _e('View More', IRON_TEXT_DOMAIN); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>"><?php _ex('Call To Call To Action Page:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>" name="<?php echo esc_attr($this->get_field_name('action_obj_id')); ?>">
					<?php echo $this->get_object_options($action_obj_id); ?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>"><?php _ex('Call To Action External Link:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>" name="<?php echo esc_attr($this->get_field_name('action_ext_link')); ?>" value="<?php echo esc_attr($action_ext_link); ?>" />
			</p>
		

<?php

		else :
			
				echo '<p>'. sprintf( _x('No photo albums have been created yet. <a href="%s">Create some</a>.', 'Widget', IRON_TEXT_DOMAIN), admin_url('edit.php?post_type=photo-album') ) .'</p>';
			
		endif;


	}

	/**
	 * Sanitize widget form values as they are saved.
	 */

	public function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['albums'] = $new_instance['albums'];
		$instance['gallery_layout'] = $new_instance['gallery_layout'];
		$instance['gallery_height'] = $new_instance['gallery_height'];

		$instance['action_title']  = $new_instance['action_title'];
		$instance['action_obj_id']  = $new_instance['action_obj_id'];
		$instance['action_ext_link']  = $new_instance['action_ext_link'];
		
		return $instance;
	}

	function get_photos($album_ids = array()) {
	
		global $post;
	
		$photos = array();
		
		if(!is_array($album_ids)) {
			$album_ids = explode(",", $album_ids);
		}
		
		$albums = get_posts(array(
			  'post_type' => 'photo-album'
			, 'post__in' => $album_ids	
		));


		foreach($albums as $a) {
			
			$album_photos = get_field('album_photos', $a->ID);
			foreach($album_photos as $photo) {
				$photos[] = $photo;
			}

		}

		return $photos;
	}

	function flush_widget_cache ()
	{
		wp_cache_delete('iron_widget_featured_photos', 'widget');
	}
		

} // class Iron_Widget_Photos




/**
 * Iron_Widget_Ios_Slider Class
 *
 * @since 1.6.0
 * @see   Iron_Widget_Ios_Slider
 */

class Iron_Widget_Ios_Slider extends Iron_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;
	
	
	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_iosslider'
			, 'description' => _x('Touch Enabled, Responsive jQuery Horizontal Image Slider/Carousel.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			, 'id'     	 => ''
		);

		
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
		
		parent::__construct('iron-ios-slider', IRON_WIDGET_PREFIX . __('IOS Slider', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);

	}

	/**
	 * Front-end display of widget.
	 */

	public function widget ( $args, $instance )
	{
		$args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
		$args['before_title'] = str_replace('h2','h3',$args['before_title']);
		$args['after_title'] = str_replace('h2','h3',$args['after_title']);
		/*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
		extract($args);
		
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$id = $instance['id'];
		$uniqid = uniqid();

		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo $args['before_title'] . esc_html($title) . $args['after_title'];;
			if(!empty($title)){$this->get_title_divider();}
		
		if(empty($id))
			return;
			
			
		$height = get_field('slider_height', $id);		
		$photos = get_field('slider_photos', $id);

		if(empty($photos))
			return;
		?>

		<section class="iosSliderWrap" style="height:<?php echo esc_attr($height); ?>px">
				<div class="sliderContainer" style="max-height:<?php echo esc_attr($height); ?>px">
						
					<!-- slider container -->
					<div class="iosSlider" id="<?php echo esc_attr($uniqid); ?>">
					
						<!-- slider -->
						<div class="slider">
						
							<!-- slides -->
							<?php foreach($photos as $photo): ?>
							<div class="item">
								<?php 
								$link = null;
								$target = "_self";
								$link_type = $photo["slide_link_type"];
								
								if($link_type == 'internal' && !empty($photo["slide_link"])) {
								
									$link = $photo["slide_link"];
									$target = "_self";
									
								}else if($link_type == 'external' && !empty($photo["slide_link_external"])) {
								
									$link = $photo["slide_link_external"];
									$target = "_blank";
									
								}
								
								?>

								<div class="inner" style="background-image: url(<?php echo esc_url($photo["photo_file"]); ?>)">
									
									<div class="selectorShadow"></div>
									
									<?php if($link): ?>
									<a target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>">
									<?php endif; ?>
									
								
										<?php if(!empty($photo["photo_text_1"])) : ?>
										<div class="text1"><span><?php echo esc_html($photo["photo_text_1"]); ?></span></div>
										<?php endif; ?>
										<?php if(!empty($photo["photo_text_2"])) : ?>
										<div class="text2"><span><?php echo esc_html($photo["photo_text_2"]); ?></span></div>
										<?php endif; ?>
										
																	
									<?php if($link): ?>
									</a>
									<?php endif; ?>
								
								</div>
	
							</div>
							<?php endforeach; ?>
							
						</div>
					
					</div>
				</div>
		</section>		
									
		<script>
		
		jQuery(document).ready(function($) {
			/* some custom settings */
			$('.iosSlider#<?php echo esc_js($uniqid); ?>').iosSlider({
					desktopClickDrag: true,
					snapToChildren: true,
					infiniteSlider: true,
					snapSlideCenter: true,
					navSlideSelector: '.sliderContainer .slideSelectors .item',
					navPrevSelector: '.sliderContainer .slideSelectors .prev',
					navNextSelector: '.sliderContainer .slideSelectors .next',
					onSlideComplete: slideComplete,
					onSliderLoaded: sliderLoaded,
					onSlideChange: slideChange,
					autoSlide: true,
					scrollbar: true,
					scrollbarContainer: '.sliderContainer .scrollbarContainer',
					scrollbarMargin: '0',
					scrollbarBorderRadius: '0',
					keyboardControls: true
				});
			
			function slideChange(args) {
						
				$('.sliderContainer .slideSelectors .item').removeClass('selected');
				$('.sliderContainer .slideSelectors .item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');
			
			}
			
			function slideComplete(args) {
				
				if(!args.slideChanged) return false;
				
				$(args.sliderObject).find('.text1, .text2').attr('style', '');
				
				$(args.currentSlideObject).find('.text1').animate({
					right: '100px',
					opacity: '0.8'
				}, 400, 'easeOutQuint');
				
				$(args.currentSlideObject).find('.text2').delay(200).animate({
					right: '50px',
					opacity: '0.8'
				}, 400, 'easeOutQuint');
				
			}
			
			function sliderLoaded(args) {
					
				$(args.sliderObject).find('.text1, .text2').attr('style', '');
				
				$(args.currentSlideObject).find('.text1').animate({
					right: '100px',
					opacity: '0.8'
				}, 400, 'easeOutQuint');
				
				$(args.currentSlideObject).find('.text2').delay(200).animate({
					right: '50px',
					opacity: '0.8'
				}, 400, 'easeOutQuint');
				
				slideChange(args);
				
			}
			
		});
		</script>
		<?php

		echo $args['after_widget'];
		
	}

	/**
	 * Back-end widget form.
	 */

	public function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = esc_attr( $instance['title'] );
		$id = $instance['id'];
		
		$all_sliders = get_posts(array(
			  'post_type' => 'iosslider'
			, 'posts_per_page' => -1
			, 'no_found_rows'  => true
		));


		if ( !empty($all_sliders) ) :
?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _ex('Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Popular Songs', IRON_TEXT_DOMAIN); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('id')); ?>"><?php _ex('IOS Sliders:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('id')); ?>" name="<?php echo esc_attr($this->get_field_name('id')); ?>">
				<?php foreach($all_sliders as $s): ?>
				
					<option value="<?php echo esc_attr($s->ID); ?>"<?php echo (($s->ID == $id) ? ' selected="selected"' : ''); ?>><?php echo esc_attr($s->post_title); ?></option>
				
				<?php endforeach; ?>
				</select>
			</p>


<?php

		else :
			
				echo '<p>'. sprintf( _x('No photo albums have been created yet. <a href="%s">Create some</a>.', 'Widget', IRON_TEXT_DOMAIN), admin_url('edit.php?post_type=photo-album') ) .'</p>';
			
		endif;


	}

	/**
	 * Sanitize widget form values as they are saved.
	 */

	public function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['id'] = $new_instance['id'];

		return $instance;
	}
	
	function enqueue_scripts() {

		if ( is_admin() || iron_is_login_page() ) return;
	
		iron_enqueue_script('iosslider', IRON_PARENT_URL.'/js/jquery.iosslider.min.js', array('jquery'), null, true);

	}


} // class Iron_Widget_Ios_Slider





/**
 * Events Widget Class
 *
 * @since 1.6.0
 * @see   Iron_Widget_Posts
 * @todo  - Add advanced options
 *        - Merge Videos, and Posts
 */

class Iron_Widget_Events extends Iron_Widget
{

	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;
	
	
	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_events'
			, 'description' => _x('List upcoming or past events on your site.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			, 'post_type'    => 'event'
			//'order'        => 'DESC'
			//'orderby'      => 'date'
			, 'filter'		 => ''
			, 'number'       => get_iron_option('events_per_page')
			, 'filter'		 => 'upcoming' 
			//'taxonomy'     => array()
			//'thumbnails'   => true
			, 'action_title' => ''
			, 'action_obj_id'  => ''
			, 'action_ext_link'  => ''
		);

		parent::__construct('iron-events', IRON_WIDGET_PREFIX . __('Events', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget ( $args, $instance )
	{
		global $post;
		
		$cache = wp_cache_get('iron_widget_events', 'widget');

		if ( ! is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		$args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
		$args['before_title'] = str_replace('h2','h3',$args['before_title']);
		$args['after_title'] = str_replace('h2','h3',$args['after_title']);
		/*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
		extract($args);

		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title      = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$post_type  = apply_filters( 'widget_post_type', $instance['post_type'], $instance, $this->id_base );
		$number     = $instance['number'];
		$filter 	= $instance['filter'];

		// $show_date  = $instance['show_date'];
		// $thumbnails = $instance['thumbnails'];

		$r = new WP_Query( apply_filters( 'iron_widget_events_args', array(
			  'post_type'           => $post_type
			, 'filter'      		=> $filter
			, 'posts_per_page'      => $number
			, 'no_found_rows'       => true
			, 'post_status'         => 'publish'
			, 'ignore_sticky_posts' => true
		) ) );

	

			$action_title = apply_filters( 'iron_widget_action_title', $instance['action_title'], $instance, $this->id_base );
			$action_obj_id = apply_filters( 'iron_widget_action_obj_id', $instance['action_obj_id'], $instance, $this->id_base );
			$action_ext_link = apply_filters( 'iron_widget_action_ext_link', $instance['action_ext_link'], $instance, $this->id_base );
	
			/***/
	
			$action = $this->action_link( $action_obj_id, $action_ext_link, $action_title);



			echo $before_widget;

			if ( ! empty( $title ) )
				echo sprintf( $before_title, $action ) . $title . $after_title;
				if(!empty($title)){$this->get_title_divider();}

?>
				<ul id="post-list" class="concerts-list">

<?php
				
				$permalink_enabled = (bool) get_option('permalink_structure');
				while ( $r->have_posts() ) : $r->the_post();
					$post->filter = $filter;
					get_template_part('items/event');

				endwhile;
				
				if(!$r->have_posts()): 
				?>
				
					<li class="nothing-found">
					<?php 
					if($filter == 'upcoming')
						echo __("No upcoming events scheduled yet. Stay tuned!", IRON_TEXT_DOMAIN); 
					else
						echo __("No events scheduled yet. Stay tuned!", IRON_TEXT_DOMAIN); 	
					?>
					</li>

				<?php endif; ?>
				

				<li><?php echo $action; ?></li>
				</ul>

<?php

			echo $after_widget;
			//echo $action;

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();


		wp_reset_query();
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('iron_widget_events', $cache, 'widget');
	}

	function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['filter']  = $new_instance['filter'];
		$instance['action_title']  = $new_instance['action_title'];
		$instance['action_obj_id']  = $new_instance['action_obj_id'];
		$instance['action_ext_link']  = $new_instance['action_ext_link'];

		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache ()
	{
		wp_cache_delete('iron_widget_events', 'widget');
	}

	function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$filter    = $instance['filter'];
		$action_title = $instance['action_title'];
		$action_obj_id = $instance['action_obj_id'];
		$action_ext_link = $instance['action_ext_link'];
?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Upcoming Events', IRON_TEXT_DOMAIN); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of events to show:' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'filter' )); ?>"><?php _e( 'Filter By:' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>">
				<option <?php echo ($filter == 'upcoming' ? 'selected' : ''); ?> value="upcoming"><?php _ex('Upcoming Events', 'Widget', IRON_TEXT_DOMAIN); ?></option>
				<option <?php echo ($filter == 'past' ? 'selected' : ''); ?> value="past"><?php _ex('Past Events', 'Widget', IRON_TEXT_DOMAIN); ?></option>
			</select>						
		<p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_title')); ?>"><?php _ex('Call To Action Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_title')); ?>" name="<?php echo esc_attr($this->get_field_name('action_title')); ?>" value="<?php echo esc_attr($action_title); ?>" placeholder="<?php _e('View More', IRON_TEXT_DOMAIN); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>"><?php _ex('Call To Call To Action Page:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('action_obj_id')); ?>" name="<?php echo esc_attr($this->get_field_name('action_obj_id')); ?>">
				<?php echo $this->get_object_options($action_obj_id); ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>"><?php _ex('Call To Action External Link:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('action_ext_link')); ?>" name="<?php echo esc_attr($this->get_field_name('action_ext_link')); ?>" value="<?php echo esc_attr($action_ext_link); ?>" />
		</p>

		
<?php
	}
} // class Iron_Widget_Events

	/**
	 * Newsletter Widget Class
	 *
	 * @since 1.6.0
	 * @todo  - Add options
	 */
	
	class Iron_Widget_Newsletter extends Iron_Widget
	{
	
		/**
		 * Widget Defaults
		 */
	
		public static $widget_defaults;
		
		
		/**
		 * Register widget with WordPress.
		 */
	
		function __construct ()
		{
			$widget_ops = array(
				  'classname'   => 'iron_widget_newsletter'
				, 'description' => _x('The IronBand newsletter or Mailchimp add-on.', 'Widget', IRON_TEXT_DOMAIN)
			);
	
			self::$widget_defaults = array(
				  'title'           => ''
				, 'fid' 			=> '' 
				, 'description'		=> ''
			);

			parent::__construct('iron-newsletter', IRON_WIDGET_PREFIX . _x('Newsletter', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);
		}
	
		/**
		 * Front-end display of widget.
		 */
	
		public function widget ( $args, $instance )
		{
			$instance = wp_parse_args( (array) $instance, self::$widget_defaults );
			$args['before_title'] = "<span class='heading-t3'></span>".$args['before_title'];
			$args['before_title'] = str_replace('h2','h3',$args['before_title']);
			$args['after_title'] = str_replace('h2','h3',$args['after_title']);
			/*$args['after_title'] = $args['after_title']."<span class='heading-b3'></span>";*/
			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			$fid = $instance['fid'];
			$description = $instance['description'];
			if(empty($fid))
				return;
			
			echo $args['before_widget'];
	
			$is_footer = ( did_action('before_ironband_footer_dynamic_sidebar') && ! did_action('after_ironband_footer_dynamic_sidebar') );
	
			if ( ! $is_footer )
			{
				if ( ! empty( $title ) )
					echo sprintf( $args['before_title'], '' ) . $title . $args['after_title'];
					if(!empty($title)){$this->get_title_divider();}
			}
	?>
	
	<?php
			if ( $is_footer ) :
	?>
						<div class="panel__heading"><h3 class="control-label" for="<?php echo esc_attr($args['widget_id']); ?>-email"><?php echo esc_html($title); ?></h3></div>
	<?php
			endif;
	?>
				
						<div class="control-append">
							<div class="newsletter-wrap">
							
								<?php if(!empty($description)): ?>
									<div class="control-description">
										<?php echo $description; ?>
									</div>
								<?php endif; ?>	
								
								<?php echo do_shortcode('[nm-mc-form fid="'.$fid.'"]'); ?>
							</div>
						</div>
	
	<?php
	
			echo $args['after_widget'];
		}
	
		function update ( $new_instance, $old_instance )
		{
			$instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );
	
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['fid'] = $new_instance['fid'];
			$instance['description'] = $new_instance['description'];
			
			return $instance;
		}
	
		function form ( $instance )
		{
			global $wpdb;
			$instance = wp_parse_args( (array) $instance, self::$widget_defaults );
	
			$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$fid = $instance['fid'];

	?>
			<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<p><label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php _e( 'Description:' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" type="text" value="<?php echo esc_attr($description); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id( 'fid' )); ?>"><?php _e( 'Newsletter Form:' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('fid')); ?>" name="<?php echo esc_attr($this->get_field_name('fid')); ?>">
				
	<?php
		
			$results = $wpdb->get_results('SELECT form_id, form_name FROM '.$wpdb->prefix.'nm_mc_forms ORDER BY form_name');
			$newsletters = array();
			foreach($results as $result) {
			
				$name = !empty($result->form_name) ? $result->form_name : $result->form_id;
				$id = $result->form_id;
			
				echo '<option '.(($fid == $id) ? 'selected' : '').' value="'.$id.'">'.esc_html($name).'</option>';
			}
	?>
			</select>
			
	<?php
		}
	} // class Iron_Widget_Newsletter
